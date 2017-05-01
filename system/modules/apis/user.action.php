<?php

defined('G_IN_SYSTEM')or exit('No permission resources.');

System::load_app_class('base','member','no');
System::load_app_class('response','apis','no');
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_sys_fun('send');
System::load_sys_fun('user');
session_start();
class user extends base 
{
    private $Mcartlist;

    private $Mcartlist_jf;

	public function __construct(){

		parent::__construct();
		$this->db = System::load_sys_class('model');
		//查询购物车的信息
		$this->Cartlist = $_SESSION['Cartlist'];
		$this->Mcartlist=json_decode(stripslashes($Mcartlist),true);
		$this->Cartlist_jf = $_SESSION['Cartlist_jf'];
		$this->Mcartlist_jf=json_decode(stripslashes($Mcartlist_jf),true);
	}

	/*
	 *brand图
	 */

	public function slides()
	{
	  	$sql="select * from `@#_wap` where 1";
	  	$SlideList=$this->db->GetList($sql);

	  	if(!empty($SlideList)){
	    	foreach($SlideList as $key=>$val){

		  		// $shopid=explode("/",$val['link']);
		    	$slides[$key]['alt']=$val['color'];
		   		$slides[$key]['shopid']=ereg_replace('[^0-9]','',$val['link']);
		   		$slides[$key]['src']=G_WEB_PATH."/statics/uploads/".$val['img'];
			}
	  	}
	   	if($slides){
			response::show(2000,'获取信息成功',$slides);
		}else{
			response::show(2004,'获取信息失败');
		}
	}

//    /*
//     *今日揭晓商品
//     */
//     public function show_jrjxshop()
//     {
// 		$w_jinri_time = strtotime(date('Y-m-d'));
// 		$w_minri_time = strtotime(date('Y-m-d',strtotime("+1 day")));

// 		$jinri_shoplist = $this->db->GetList("select * from `@#_shoplist` where `xsjx_time` > '$w_jinri_time' and `xsjx_time` < '$w_minri_time' order by xsjx_time limit 0,3 ");

// 		if(!empty($jinri_shoplist)){
// 		   	response::show(2004,'获取信息失败');
// 		}else{
// 		   	response::show(2000,'获取信息成功',$jinri_shoplist);
// 		}
// 	}

	/*
	 *最新揭晓商品
	 */

	public function show_newjxshop()
	{
		$shopqishu=$this->db->GetList("select * from `@#_shoplist` where `q_end_time` !='' ORDER BY `q_end_time` DESC LIMIT 4");

		if(!empty($shopqishu)){
		   	response::show(2004,'获取信息失败');
		}else{
		   	response::show(2000,'获取信息成功',$shopqishu);
		}
	}



// 	//即将揭晓商品
// 	public function show_msjxshop()
// 	{
// 		//即将揭晓商品
// 	    $shoplist['listItems'][0]['codeID']=14;  //商品id
// 	    $shoplist['listItems'][0]['period']=3;  //商品期数
// 	    $shoplist['listItems'][0]['goodsSName']='苹果';  //商品名称
// 	    $shoplist['listItems'][0]['seconds']=10;  //商品名称
// 		$shoplist['errorCode']=0;

// 		if(!empty($shoplist)){
// 		   	response::show(2004,'获取信息失败');
// 		}else{
// 		   	response::show(2000,'获取信息成功',$shoplist);
// 		}
// 	}

//     /*
//      *购物车数量
//      */

// 	public function cartnum()
// 	{
// 	  	$Mcartlist=$this->Mcartlist;

// 	  	if(is_array($Mcartlist)){
// 	  	 	$cartnum['code']=0;
// 	     	$cartnum['num']=count($Mcartlist);
// 	  	}else{
// 	  	  	$cartnum['code']=1;
// 	      	$cartnum['num']=0;
// 	  	}

// 	  	if(!empty($cartnum)){
// 		   	response::show(2004,'获取信息失败');
// 		}else{
// 		   	response::show(2000,'获取信息成功',$cartnum);
// 		}

// 	}



// 	/*
// 	 *添加购物车
// 	 */

// 	public function addShopCart()
// 	{
// 		if(empty($_POST['shop_id']) || empty($_POST['shopnum'])){
// 			response::show(2001,'缺少参数');
// 		}
// 	  	$ShopId=safe_replace($_POST['shop_id']);
// 	  	$ShopNum=safe_replace($_POST['shopnum']);
// 	  	$cartbs=safe_replace($_POST['cartbs']);//标识从哪里加的购物车

// 	  	$shopis=0;          //0表示不存在  1表示存在

// 	  	$Mcartlist=$this->Mcartlist;

// 		if(is_array($Mcartlist)){

// 			foreach($Mcartlist as $key=>$val){
// 			   	if($key==$ShopId){
// 			      	if(isset($cartbs) && $cartbs=='cart'){
// 	                	$Mcartlist[$ShopId]['num']=$ShopNum;
// 				  	}else{
// 				    	$Mcartlist[$ShopId]['num']=$val['num']+$ShopNum;
// 				  	}
// 				  	$shopis=1;
// 			   	}else{
// 				  	$Mcartlist[$key]['num']=$val['num'];
// 			   	}
// 			}

// 		}else{
// 			  	$Mcartlist =array();
// 			  	$Mcartlist[$ShopId]['num']=$ShopNum;
// 		}

//         if($shopis==0){
// 		    $Mcartlist[$ShopId]['num']=$ShopNum;
// 		}

//        	$_SESSION['Cartlist'] = json_encode($Mcartlist);
// 		$cart['num']=count($Mcartlist);    //表示现在购物车有多少条记录
// 	  	if($cart){
// 		   	response::show(2000,'获取信息成功',$cart);
// 		}else{
// 		   	response::show(2004,'获取信息失败');
// 		}
// 	}

// 	/*
// 	 *添加购物车 积分
// 	 */

// 	public function jf_addShopCart()
// 	{
// 		if(empty($_POST['shop_id']) || empty($_POST['shopnum'])){
// 			response::show(2001,'缺少参数');
// 		}
// 	  	$ShopId=safe_replace($_POST['shop_id']);
// 	  	$ShopNum=safe_replace($_POST['shopnum']);
// 	  	$cartbs=safe_replace($_POST['cartbs']);//标识从哪里加的购物车
		
// 		$shopis=0;          //0表示不存在  1表示存在
// 		$Mcartlist=$this->Mcartlist_jf;

// 		if(is_array($Mcartlist)){

// 			foreach($Mcartlist as $key=>$val){
// 			   	if($key==$ShopId){
// 			      	if(isset($cartbs) && $cartbs=='cart'){
// 		            	$Mcartlist[$ShopId]['num']=$ShopNum;
// 				  	}else{
// 				    	$Mcartlist[$ShopId]['num']=$val['num']+$ShopNum;
// 				  	}
// 				  	$shopis=1;
// 			   	}else{
// 				  	$Mcartlist[$key]['num']=$val['num'];
// 			   	}
// 			}
// 	    }else{
// 			$Mcartlist =array();
// 			$Mcartlist[$ShopId]['num']=$ShopNum;
// 	    }
// 	    if($shopis==0){
// 	    	$Mcartlist[$ShopId]['num']=$ShopNum;
// 	    }
// 	    $_SESSION['Cartlist_jf'] = json_encode($Mcartlist);
// 		$cart['num']=count($Mcartlist);    //表示现在购物车有多少条记录
// 	  	if($cart){
// 		   	response::show(2000,'获取信息成功',$cart);
// 		}else{
// 		   	response::show(2004,'获取信息失败');
// 		}
// 	}

// 	/*
// 	 *购物车删除
// 	 */

// 	public function delCartItem()
// 	{
// 		if(empty($_POST['shop_id'])){
// 			response::show(2001,'缺少参数');
// 		}
// 	    $ShopId=safe_replace($_POST['shop_id']);
// 	   	$cartlist=$this->Mcartlist;

// 	   	if(is_array($cartlist)){
// 	      	if(count($cartlist)==1){
// 		     	foreach($cartlist as $key=>$val){
// 			   		if($key==$ShopId){
// 			   			$_SESSION['Cartlist'] = '';
// 			     		response::show(2000,'获取信息成功');
// 					}else{
// 			     		response::show(2004,'获取信息失败');
// 			   		}
// 			 	}
// 		  	}else{

// 			   	foreach($cartlist as $key=>$val){
// 					if($key==$ShopId){
// 					  	$cart['code']=0;
// 					}else{
// 					  	$Mcartlist[$key]['num']=$val['num'];
// 					}
// 				}
// 				$_SESSION['Cartlist'] = json_encode($Mcartlist);
// 			}
// 		}else{
// 		   	response::show(2004,'获取信息失败');
// 		}
// 	}

// 	/*
// 	 *购物车删除 积分
// 	 */
// 	public function delCartItem_jf()
// 	{
// 		if(empty($_POST['shop_id'])){
// 			response::show(2001,'缺少参数');
// 		}
// 	  	$ShopId=safe_replace($_POST['shop_id']);
// 	   	$cartlist=$this->Mcartlist_jf;

// 	   	if(is_array($cartlist)){
// 	      	if(count($cartlist)==1){
// 		     	foreach($cartlist as $key=>$val){
// 			   		if($key==$ShopId){
// 				    	$_SESSION['Cartlist_jf'] = '';
// 				    	response::show(2000,'获取信息成功');
// 					}else{
// 			     		response::show(2004,'获取信息失败');
// 			   		}
// 			 	}
// 		  	}else{
// 			   	foreach($cartlist as $key=>$val){
// 					if($key==$ShopId){
// 					  	$cart['code']=0;
// 					}else{
// 					  	$Mcartlist[$key]['num']=$val['num'];
// 					}
// 				}
// 				$_SESSION['Cartlist_jf'] = json_encode($Mcartlist);
// 			}
// 		}else{
// 		   	response::show(2004,'获取信息失败');
// 		}
// 	}

	/***********************************登录*********************************/
	/*
	 *微信登陆
	 */
	public function wxlogin()
  	{
  		if(!$_POST['wxid']){
			// if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
				header("Location: ".WEB_PATH."/api/wxlogin");exit;
			// }
		}else{
			$wxid = $_POST['wxid'];
			$mem=$this->db->GetOne("select * from `@#_member_band` where `b_code`='".$wxid."'");
			if (empty($mem)){
				response::show(2002,'未绑定');
			}
			$member=$this->db->GetOne("select * from `@#_member` where `uid`='".$mem['b_uid']."'");
			if($member){
				$data['uid'] = $memer['uid'];
				$data['img'] = G_UPLOAD_PATH.'/'.$memer['img'];
				$data['mobile'] = $memer['mobile'];
				$data['email'] = $memer['email'];
				$data['username'] = $memer['username'];
				$data['score'] = $memer['score'];
				$data['jingyan'] = $memer['jingyan'];
				$data['money'] = $memer['money'];
				$data['token'] = self::token($memer['uid']);
				response::show(2000,'微信登陆成功');
			}else{
				response::show(2004,'登陆失败');
			}
		}
  	}

  	/*
	 *绑定扣扣
	 */
  	public function qqlogin()
  	{
  		if(!$_POST['qqid']){
			// if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
				header("Location: ".WEB_PATH."/api/qqlogin?uid=".$this->uid);exit;
			// }
		}else{
			$qqid = $_POST['qqid'];
			$mem=$this->db->GetOne("select * from `@#_member_band` where `b_code`='".$qqid."'");
			if (empty($mem)){
				response::show(2002,'未绑定');
			}
			$member=$this->db->GetOne("select * from `@#_member` where `uid`='".$mem['b_uid']."'");
			if($member){
				$data['uid'] = $memer['uid'];
				$data['img'] = G_UPLOAD_PATH.'/'.$memer['img'];
				$data['mobile'] = $memer['mobile'];
				$data['email'] = $memer['email'];
				$data['username'] = $memer['username'];
				$data['score'] = $memer['score'];
				$data['jingyan'] = $memer['jingyan'];
				$data['money'] = $memer['money'];
				$data['token'] = self::token($memer['uid']);
				response::show(2000,'绑定成功');
			}else{
				response::show(2004,'绑定失败');
			}
		}
  	}
	/*
	 *用户登录接口
	 */
	public function login()
	{
		// $_POST = [
		// 'accident'=>'17744409214',
		// 'password'=>'111111'
		// ];
		if(empty($_POST['accident']) || empty($_POST['password'])){
			response::show(2001,'缺少参数');
		}
	    $username = safe_replace($_POST['accident']);
	    $password = md5(base64_decode(safe_replace($_POST['password'])));
		$logintype='';
		if(strpos($username,'@')==false){
			$logintype='mobile';//手机
		}else{
			$logintype='email';//邮箱
		}
		$mem = $this->db->GetOne("select * from `@#_member` where `$logintype`='$username'");
		if(!$mem){
			response::show(2002,'账号不存在！');
		}
		if($mem['password'] != $password){
			response::show(2004,'帐号或密码错误！');
		}
			
		if($mem[$logintype.'code'] != 1){
			response::show(2003,'账号未验证！');
		}
		$memberdj=$this->db->GetList("select * from `@#_member_group`");
		
        $jingyan=$mem['jingyan'];
        if(!empty($memberdj)){
            foreach($memberdj as $key=>$val){
                if($jingyan>=$val['jingyan_start'] && $jingyan<=$val['jingyan_end']){
                   $data['yungoudj']=$val['name'];
                }
            }
        }
		$data['uid'] = $mem['uid'];
		$data['img'] = G_UPLOAD_PATH.'/'.$mem['img'];
		$data['mobile'] = $mem['mobile'];
		$data['email'] = $mem['email'];
		$data['username'] = $mem['username'];
		$data['score'] = $mem['score'];
		$data['jingyan'] = $mem['jingyan'];
		$data['money'] = $mem['money'];
		$data['token'] = self::token($mem['uid']);
		response::show(2000,'登录成功！',$data);
	}

	// token生成
	public static function token($uid)
	{
		$token = md5($uid.time());
		//将token存入session中
		
		$_SESSION['user'.$uid] = $token;
		if($_SESSION['user'.$uid]){
			return $token;
		}	
	}

	/*
	 *用户退出接口
	 */
	public function loginout()
	{
		// $_POST = [
		// 'uid'=>'6',
		// 'token'=>'6f636d5c6bca163bbfde185c159632df'
		// ];
		if(empty($_POST['uid']) || empty($_POST['token'])){
			response::show(2001,'缺少参数');
		}
		$uid = $_POST['uid'];
		if($_SESSION['user'.$uid] == $_POST['token']){
			$_SESSION['user'.$uid] = null;
			response::show(2000,'成功退出！');
		}else{
			response::show(2004,'非法退出！');
		}		
	}

	/***********************************注册*********************************/
	/*
	 *用户注册接口
	 */
	public function register()
	{
		/*$_POST = [
		'accident'=>'18734820962',
		'password'=>'111111'
		];*/
		if(empty($_POST['accident']) || empty($_POST['password'])){
			response::show(2001,'缺少参数');
		}
		$name= $_POST['accident'];
		$config_email = System::load_sys_config("email");
		$config_mobile = System::load_sys_config("mobile");
		
		$regtype=null;
		if(_checkmobile($name)){
			$regtype='mobile';
			$cfg_mobile_type  = 'cfg_mobile_'.$config_mobile['cfg_mobile_on'];
			$config_mobile = $config_mobile[$cfg_mobile_type];
			if(empty($config_mobile['mid']) && empty($config_email['mpass'])){
				response::show(2002,'系统短信配置不正确');
			}
		}

		$member=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `mobile` = '$name' LIMIT 1");
		if(is_array($member)){

			if($member['mobilecode']==1 || $member['emailcode']==1){
				response::show(2003,'该账号已被注册');
			}else{
			  $sql="DELETE from`@#_member` WHERE `mobile` = '$name'";
			  $this->db->Query($sql);
			}
		}
		$pass= md5(base64_decode($_POST['password']));
		$decode= isset($_POST['decode'])? abs(intval($_POST['decode'])): '0';
		$time=time();
		//邮箱验证 -1 代表未验证， 1 验证成功 都不等代表等待验证

		$sql="INSERT INTO `@#_member`(`mobile`,password,img,emailcode,mobilecode,yaoqing,time)VALUES('$name','$pass','/photo/member.jpg','-1','-1','$decode','$time')";

		if($this->db->Query($sql)){		
			$user=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `mobile` = '$name' LIMIT 1");

			response::show(2000,'注册成功，及时去验证',['uid'=>$user['uid']]);
		}else{
			response::show(2004,'注册失败');
		}

	}


	/*
	 *手机验证接口
	 */

	public function mobileregsn()
	{
		/*$_POST = [
		'mobile'=>'18734820961',
		'code'=>'300500'
		];*/
		if(empty($_POST['mobile']) || empty($_POST['code'])){
			response::show(2001,'缺少参数');
		}
	    $mobile= $_POST['mobile'];
	    $checkcodes= $_POST['code'];

		$member=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `mobile` = '$mobile' LIMIT 1");
		if($member['mobilecode'] == 1){
			response::show(2002,'手机号已被注册或验证！');
		}
		if(!empty($member)){
			$usercode=explode("|",$member['mobilecode']);
			if($checkcodes!=$usercode[0]){
				response::show(2002,'验证码不正确');
			}
			if($this->db->Query("UPDATE `@#_member` SET mobilecode='1' where `uid`='$member[uid]'")){
				$mem=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `mobile` = '$mobile' LIMIT 1");
				$memberdj=$this->db->GetList("select * from `@#_member_group`");
		
		        $jingyan=$mem['jingyan'];
		        if(!empty($memberdj)){
		            foreach($memberdj as $key=>$val){
		                if($jingyan>=$val['jingyan_start'] && $jingyan<=$val['jingyan_end']){
		                   $data['yungoudj']=$val['name'];
		                }
		            }
		        }
				$data = [];
				if($mem){
					$data['uid'] = $mem['uid'];
					$data['img'] = G_UPLOAD_PATH.$mem['img'];
					$data['mobile'] = $mem['mobile'];
					$data['email'] = $mem['email'];
					$data['username'] = $mem['username'];
					$data['score'] = $mem['score'];
					$data['jingyan'] = $mem['jingyan'];
					$data['money'] = $mem['money'];
					$data['token'] = self::token($mem['uid']);
				}
				
				response::show(2000,'验证成功',$data);
			}
		}else{
			response::show(2003,'用户还未注册');
		}			
	}

	/*
	 *发送手机验证码
	 */

	public function sendmobile()
	{
		$_POST = array(
		'uid'=>'13',
		'mobile'=>'17744409214',
		);
		if(empty($_POST['mobile']) || empty($_POST['uid'])){
			response::show(2001,'缺少参数');
		}
		$name=$_POST['mobile'];
		$uid = $_POST['uid'];
		$member=$this->db->GetOne("SELECT * FROM `@#_member` WHERE `mobile` = '$name' AND `uid` = '$uid' LIMIT 1");

		if(strlen($member['mobilecode'])>10){

		    $checkcode=explode("|",$member['mobilecode']);

			$times=time()-$checkcode[1];

			if($times > 120){
				$sendok = send_mobile_reg_code($name,$uid);
				if($sendok[0]==1){
					response::show(2000,'发送成功注意查收');
				}else{
					response::show(2004,'发送失败');
				}

			}else{
				response::show(2003,'3分钟后方可新发送');
			}

	    }else{
	    	$sendok = send_mobile_reg_code($name,$uid);
			if($sendok[0]==1){
				response::show(2000,'发送成功注意查收');
			}else{
				response::show(2004,'发送失败');
			}
	    }
	}

// 	/*
// 	 *最新揭晓
// 	 */

// 	public function getLotteryList()
// 	{
// 		if(empty($_POST['page']) || empty($_POST['pagesize'])){
// 			response::show(2001,'缺少参数');
// 		}
// 	   	$FIdx=($_POST['page']-1)*$_POST['pagesize'];
// 	   	$EIdx=$_POST['pagesize'];

// 	   	$shopsum=$this->db->GetOne("SELECT count(*) AS total FROM `@#_shoplist` WHERE `q_uid` is not null AND `q_showtime` = 'N'");
// 	   //最新揭晓
// 		$shoplist['listItems']=$this->db->GetList("SELECT * FROM `@#_shoplist` WHERE `q_uid` is not null AND `q_showtime` = 'N' ORDER BY `q_end_time` DESC limit $FIdx,$EIdx");

// 		if(!empty($shoplist['listItems'])){

// 		 	foreach($shoplist['listItems'] as $key=>$val){
// 		 	//查询出购买次数
// 		   	$recodeinfo=$this->db->GetOne("select `gonumber` from `@#_member_go_record` where `uid` ='$val[q_uid]'  and `shopid`='$val[id]' ");

// 		   	$shoplist['listItems'][$key]['q_user']=get_user_name($val['q_uid']);
// 		   	$shoplist['listItems'][$key]['userphoto']=get_user_key($val['q_uid'],'img');
// 		   	$shoplist['listItems'][$key]['userphotow']=get_user_key($val['q_uid'],'headimg');
// 		   	$shoplist['listItems'][$key]['q_end_time']=microt($val['q_end_time']);
// 		   	$shoplist['listItems'][$key]['gonumber']=$recodeinfo['gonumber'];

// 		}
// 		$shoplist['count']=$shopsum['total'];
// 		if($shoplist){
// 			response::show(2000,'获取信息成功',$shoplist);
// 		}else{
// 			response::show(2004,'获取信息失败');
// 		}		
// 	}



// 	/*
// 	 *访问他人购买记录
// 	 */

// 	public function getUserBuyList()
// 	{
// 		if(empty($_POST['page']) || empty($_POST['pagesize']) || empty($_POST['uid']) || empty($_POST['types'])){
// 			response::show(2001,'缺少参数');
// 		}
// 		$FIdx=($_POST['page']-1)*$_POST['pagesize'];
// 	   	$EIdx=$_POST['pagesize'];
// 	   	$type=$_POST['types'];
// 	   	$uid=$_POST['uid'];

// 		if($type==0){

//           	//参与云购的商品 全部...
// 		  	$shoplist=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$uid' GROUP BY shopid ");

// 			$shop['listItems']=$this->db->GetList("select *,sum(gonumber) as gonumber from `@#_member_go_record` a left join `@#_shoplist` b on a.shopid=b.id where a.uid='$uid' GROUP BY shopid order by a.time desc limit $FIdx,$EIdx " );

// 		}elseif($type==1){
// 		   	//获得奖品
// 		    $shoplist=$this->db->GetList("select * from  `@#_shoplist`  where q_uid='$uid' " );

// 		    $shop['listItems']=$this->db->GetList("select * from  `@#_shoplist`  where q_uid='$uid' order by q_end_time desc limit $FIdx,$EIdx" );

// 		}elseif($type==2){
// 		   	//晒单记录
// 		    $shoplist=$this->db->GetList("select * from `@#_shaidan` a left join `@#_shoplist` b on a.sd_shopid=b.id where a.sd_userid='$uid' " );

// 		    $shop['listItems']=$this->db->GetList("select * from `@#_shaidan` a left join `@#_shoplist` b on a.sd_shopid=b.id where a.sd_userid='$uid' order by a.sd_time desc limit $FIdx,$EIdx" );

// 		}

// 		if(!empty($shop['listItems'])){

// 		   	foreach($shop['listItems'] as $key=>$val){
// 		      	if($val['q_end_time']!=''){
// 				    $shop['listItems'][$key]['codeState']=3;
// 				    $shop['listItems'][$key]['q_user']=get_user_name($val['q_uid']);
// 	                $shop['listItems'][$key]['q_end_time']=microt($val['q_end_time']);
// 			  	}

// 			  	if(isset($val['sd_time'])){
// 			   		$shop['listItems'][$key]['sd_time']=date('m月d日 H:i',$val['sd_time']);
// 			  	}
// 		   	}
// 		   	$shop['count']=count($shoplist);
// 		}

// 	  	if($shop){
// 			response::show(2000,'获取信息成功',$shop);
// 		}else{
// 			response::show(2004,'获取信息失败');
// 		}
// 	}



// 	/*
// 	 *查看计算结果
// 	 */

// 	public function getCalResult()
// 	{
// 		if(empty($_POST['itemid'])){
// 			response::show(2001,'缺少参数');
// 		}
// 	    $itemid=$_POST['itemid'];

// 		$item=$this->db->GetOne("select * from `@#_shoplist` where `id`='$itemid' and `q_end_time` is not null LIMIT 1");

// 		if($item['q_content']){
// 			$item['itemlist'] = unserialize($item['q_content']);
// 			foreach($item['itemlist'] as $key=>$val){

// 			  	$item['itemlist'][$key]['time']	=microt($val['time']);
// 				$h=date("H",$val['time']);
// 			    $i=date("i",$val['time']);
// 			    $s=date("s",$val['time']);
// 			    list($timesss,$msss) = explode(".",$val['time']);
// 				$item['itemlist'][$key]['timecode']=$h.$i.$s.$msss;
// 			}
// 			response::show(2000,'获取信息成功',$item);
// 		}else{
// 			response::show(2004,'获取信息失败');
// 		}
// 	}

// 	/*
// 	 *即将揭晓的商品
// 	 */

// 	public function GetStartRaffleAllList()
// 	{
// 		if(empty($_POST['itemid'])){
// 			response::show(2001,'缺少参数');
// 		}
// 		$maxSeconds = intval($_POST['itemid']);
// 		$result = array();
// 		$result['errorCode'] = 0;
// 		$result['maxSeconds'] = $maxSeconds;
// 		$result['listItems'] = array();

// 		$times = (int)System::load_sys_config('system','goods_end_time');
// 		$time = time();
// 		$list = $this->db->getlist("select qishu,xsjx_time,id,thumb,title,q_uid,q_user,q_end_time,money from `@#_shoplist` where `q_showtime` = 'Y' AND id > '$maxSeconds' order by `q_end_time` DESC");

// 		foreach($list as $item) {

// 			if ( $result['maxSeconds'] == $maxSeconds ) {
// 				$result['maxSeconds'] = $item['id'];
// 			}

// 			if($item['xsjx_time']){
// 				$item['q_end_time'] += $times;
// 			}

// 			$data = array();

// 			$data['id'] = $item['id'];
// 			$data['qishu'] = $item['qishu'];
// 			$data['title'] = $item['title'];
// 			$data['money'] = $item['money'];
// 			$data['thumb'] = $item['thumb'];
// 			$data['seconds'] = intval($item['q_end_time'] - $time);

// 			$result['listItems'][] = $data;
// 		}

// 		if($result){
// 			response::show(2000,'获取信息成功',$result);
// 		}else{
// 			response::show(2004,'获取信息失败');
// 		}
// 	}


// 	/*
// 	 *查看已开奖商品的中奖详情
// 	 */
// 	public function BarcodernoInfo()
// 	{
// 		if(empty($_POST['itemid'])){
// 			response::show(2001,'缺少参数');
// 		}
// 		$itemid = intval($_POST['itemid']);
// 		$res = $this->db->Query("UPDATE `@#_shoplist` SET `q_showtime`='N' where `id`= $itemid");
// 		$list = $this->db->GetOne("SELECT * FROM `@#_shoplist` WHERE `id`= $itemid");
// 		$num=$this->db->GetOne("SELECT `gonumber` FROM `@#_member_go_record` WHERE `uid` ='$list[q_uid]'  AND `shopid`='$list[id]'");
// 		$lists = $this->db->GetOne("SELECT * FROM `@#_member` WHERE `uid`='$list[q_uid]'");
// 		$result = array();
// 		if($res>0){
// 			$result['code'] = 0;
// 			$result['codeType']=0;
// 			$result['buyCount']=$num['gonumber'];
// 			$result['thumb']=$list['thumb'];
// 			$result['codeRNO'] = $list['q_user_code'];
// 			$result['codeRTime'] = microt($list['q_end_time']);
// 			$result['img'] =$lists['img'];
// 			$result['headimg'] =$lists['headimg'];
// 			$result['user'] =$lists['username'];
// 			response::show(2000,'获取信息成功',$result);
// 		}else{
// 			response::show(2004,'获取信息失败');
// 		}
// 	}

// 	/*
// 	 *微信支付
// 	 */
// 	public function paywx()
// 	{
// 		if(empty($_POST['tradeno'])){
// 			response::show(2001,'缺少订单号');
// 		}
		
// 		$tradeno = $_POST['tradeno'];
// 		$pay=System::load_app_class('pay','pay');
// 		if($pay->go_pay_wx($tradeno)){
// 			response::show(2000,'支付成功');
// 		}else{
// 			response::show(2004,'支付失败');
// 		}
// 	}
}

