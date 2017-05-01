<?php 
date_default_timezone_set("Asia/Shanghai");
System::load_app_fun("user","go");
class egglotter extends SystemAction{
     private $userid;
	 private $username;
	 private $mysql_model;
	 private $rule_id;
	 public $userinfo;
	 public $ruleinfo;
	 public $spoilinfo;
	 public $prize_arr;
	 
	public function __construct() {	
		$this->mysql_model=System::load_sys_class('model');
		$this->userid=intval(_encrypt(_getcookie("uid"),'DECODE'));
        
		//获取当前客户的基本信息 (积分、剩余金额等)
		$this->userinfo=$this->mysql_model->GetOne("SELECT * from `@#_member` where `uid` = '$this->userid'");		
		$curtime=time();
		/* if(!$this->userid){
			_message("你还未登录，无权限访问该页！",WEB_PATH."/member/user/login");
	    } */	
        //显示当前抽奖第几期
        $this->ruleinfo=$this->mysql_model->GetOne("select * from `@#_egglotter_rule` where `starttime`<='$curtime' and `endtime`>='$curtime' and `startusing`=1");         
		$this->username=$this->userinfo['username'];   
        $rule_id=$this->ruleinfo['rule_id'];
		if(!$this->ruleinfo){
			_message("没有设置游戏");
		}
        //产看当期奖品
		$this->spoilinfo=$this->mysql_model->GetList("select * from `@#_egglotter_spoil` where `rule_id`='$rule_id'"); 				
			
	}	
	public function init(){
		$title="砸金蛋，抽奖游戏";
	    $user_id=$this->userid;
		$user_name=$this->username;
		$ruleinfo=$this->ruleinfo;
		$spoilinfo=$this->spoilinfo;
		$spoil_id=$spoilinfo[2]['spoil_id'];
		$award=$this->mysql_model->GetList("select * from `@#_egglotter_award` where `spoil_id`!='$spoil_id' limit 20 ");
		$slinfo=$this->mysql_model->GetList("select * from `@#_egglotter_spoil` where `rule_id`='$ruleinfo[rule_id]'"); 				
        //查看有多少会员参与本次抽奖活动
		$awardwinner=$this->mysql_model->GetOne("select * from `@#_egglotter_award` where `rule_id`='$ruleinfo[rule_id]' and `user_id`='$user_id' ");
		$lotterdes='';//定义本次抽奖是按什么类型进行
		//计算该用户有几次抽奖机会
		if($ruleinfo['lotterytype']==1){
			//表示是按照积分抽奖        
			$lotterdes='积分不足！';            
			$lotter_opportunity=floor($this->userinfo['score']/$this->ruleinfo['lotterjb']);  		  
		}else{
		    //表示是按照每个会员有一次机会 
            $lotterdes='你没有抽奖机会了！';
			if($awardwinner){
				$subtime=time()-$awardwinner['subtime'];
				if($subtime>24*3600 || !$subtime){
					$lotter_opportunity=1;
				}else{
					$lotter_opportunity=0;
				}
			}else{
				$lotter_opportunity=1;
			}       
		} 
		include "tpl/egglotter.index.php";
		/* if($lotter_opportunity>0){
		    include "tpl/egglotter.index.php";		  
		}elseif($ruleinfo['lotterytype']==1){
		    _message("你的积分已不足！本次活动按积分抽奖<br/>每次消耗".$this->ruleinfo['lotterjb']."积分",WEB_PATH);   		  
		}elseif($ruleinfo['lotterytype']==2){	
            _message("你的金币已不足！本次活动按金币抽奖<br/>每次消耗".$this->ruleinfo['lotterjb']."金币",WEB_PATH);   
		}else{
		    _message("你没有抽奖机会了！",WEB_PATH);	  
		} */
	}
	public function add(){	
		if(!$this->userid){
			echo "你还未登录，还不能砸金蛋！";exit;
	    }
		$ruleinfo=$this->ruleinfo;     
		$rule_id=$this->ruleinfo['rule_id'];		 
		$user_id=$this->userid;
		$user_name=$this->username;
		$spoilinfo=$this->spoilinfo;
		$prize_arr=$this->prize_arr;
		$curtime=time(); 
		
		for($i=0;$i<count($this->spoilinfo);$i++){
		   $prize_arr[$i]['spoilid']=$this->spoilinfo[$i]['spoil_id'];
		   $prize_arr[$i]['id']=$this->spoilinfo[$i]['spoil_dj'];
		   $prize_arr[$i]['prize']=$this->spoilinfo[$i]['spoil_name'];
		   $prize_arr[$i]['v']=$this->spoilinfo[$i]['spoil_jl'];          			   
		} 			

		foreach ($prize_arr as $key => $val) {
			$arr[$val['id']] = $val['v'];
		}
		$rid = $this->getRand($arr); //根据概率获取奖项id
		//echo "<pre>";
		//print_r($spoilinfo[2]);
		
		$res['prize1']=$spoilinfo[0]['spoil_name'];
		$res['prize2']=$spoilinfo[1]['spoil_name'];
		$res['prize']=$spoilinfo[2]['spoil_name'];
		$spoil_resid=$spoilinfo[2]['spoil_id'];
		
		//将中奖数据保存到数据库
		//if($res['msg']!=-1){
		   $this->mysql_model->Query("INSERT INTO `@#_egglotter_award`(user_id,user_name,rule_id,spoil_id,subtime)
		   VALUES('$user_id','$user_name','$rule_id','$spoil_resid','$curtime')");
		//}		 
		//改变抽奖机会
		//修改一次成员表中的积分      
		if($ruleinfo['lotterytype']==1){
		    $score=$this->userinfo['score']-$this->ruleinfo['lotterjb'];
	        $this->mysql_model->Query("UPDATE `@#_member` SET `score`='$score' where `uid`='$user_id'");	 
	    } 
		
		
		echo json_encode($res);
		exit;//
		if($rid==$this->spoilinfo[count($this->spoilinfo)-1]['spoil_dj']){
			$res['msg']=-1;
		}else{		 
			$res['msg'] =$rid; 
		}
		$res['prize'] = $prize_arr[$rid-1]['prize']; //中奖项
		$spoil_resid=$prize_arr[$rid-1]['spoilid'];		
		
		//将中奖数据保存到数据库
		if($res['msg']!=-1){
		   $this->mysql_model->Query("INSERT INTO `@#_egglotter_award`(user_id,user_name,rule_id,spoil_id,subtime)
		   VALUES('$user_id','$user_name','$rule_id','$spoil_resid','$curtime')");
		}		 
		//改变抽奖机会
		//修改一次成员表中的金币或者积分      
        if($ruleinfo['lotterytype']==2){
		    $money=$this->userinfo['money']-$this->ruleinfo['lotterjb'];
	        $this->mysql_model->Query("UPDATE `@#_member` SET `money`='$money' where `uid`='$user_id'");	 
	    }elseif($ruleinfo['lotterytype']==1){
		    $score=$this->userinfo['score']-$this->ruleinfo['lotterjb'];
	        $this->mysql_model->Query("UPDATE `@#_member` SET `score`='$score' where `uid`='$user_id'");	 
	    }
		//返回抽奖页面显示抽奖结果
		echo json_encode($res);
		
	}
	//计算概率
	function getRand($proArr) {
		$result = '';
		//概率数组的总概率精度
		$proSum = array_sum($proArr);
		//概率数组循环
		foreach ($proArr as $key => $proCur) {
			$randNum = mt_rand(1, $proSum);
			if ($randNum <= $proCur) {
				$result = $key;
				break;
			} else {
				$proSum -= $proCur;
			}
		}
		unset ($proArr);

		return $result;
	}
	public function user(){
		$title="我的中奖信息";
		$ruleinfo=$this->ruleinfo;	
		$spoilinfo=$this->spoilinfo;
		$spoil_id=$spoilinfo[2]['spoil_id'];
		//分页
		$num=30;
		$total=$this->mysql_model->GetCount("select * from `@#_egglotter_award` where `user_id`='$this->userid' and `spoil_id`!='$spoil_id' ");
		$page=System::load_sys_class('page');
		
		if(isset($_GET['p'])){
			$pagenum=$_GET['p'];
		}else{$pagenum=1;}			
		$page->config($total,$num,$pagenum,"0");
		if($pagenum>$page->page){
			$pagenum=$page->page;
		}			
		$award=$this->mysql_model->GetPage("select * from `@#_egglotter_award` where `user_id`='$this->userid'  and `spoil_id`!='$spoil_id'  order by `award_id` DESC",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));

		
		//$award=$this->mysql_model->GetList("select * from `@#_egglotter_award` where `user_id`='$this->userid' ");
		$slinfo=$this->mysql_model->GetList("select * from `@#_egglotter_spoil` where `rule_id`='$ruleinfo[rule_id]'");
		$rule=$this->mysql_model->GetList("select * from `@#_egglotter_rule`");
		$member=$this->mysql_model->GetList("select * from `@#_member`");
		//print_r($award);
		include "tpl/egglotter.user.php";	
	}
}

$mysql_model=System::load_sys_class('model');
$lottrt = new egglotter();

//获取调用哪个函数值

$fun='init';
$urlfun='';
$urlfun=$this->segment(5);


 
if($urlfun!=''){
  $fun=$urlfun;
}
switch($fun){
    case 'init':
       $lottrt -> init();
	   break;

    case 'add':
       $lottrt -> add();
	   break;
	case 'user':
       $lottrt -> user();
	   break;

}





?>