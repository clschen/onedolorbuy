<?php 

defined('G_IN_SYSTEM')or exit('no');
System::load_app_fun('global',G_ADMIN_DIR);
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_app_class("base","member","no");
System::load_sys_fun('user');
class shaidan extends base {
	public $db;
	public function __construct(){	
		parent::__construct();
		$this->db=System::load_sys_class('model');		
		
	}
	
	//晒单分享
	public function init(){
		$title="晒单分享";
		$num=40;
		$total=$this->db->GetCount("select * from `@#_shaidan` where 1");
		$page=System::load_sys_class('page');		
		if(isset($_GET['p'])){
			$pagenum=$_GET['p'];
		}else{$pagenum=1;}			
		$page->config($total,$num,$pagenum,"0");
		if($pagenum>$page->page){
			$pagenum=$page->page;
		}	
		$shaidan=$this->db->GetPage("select * from `@#_shaidan` order by `sd_id` DESC",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));
		$lie=4;$sum=$num;
		$yushu=$total%$num;
		$yeshu=floor($total/$num)+1;
		if($yushu>0 && $yeshu==$pagenum){
			$sum=$yushu;
		}
		$sa_one=array();$sa_two=array();
		$sa_tree=array();$sa_for=array();		
		
		foreach($shaidan as $sk=>$sv){
			$shaidan[$sk]['sd_title'] = _htmtocode($shaidan[$sk]['sd_title']);		
		}
		if($shaidan){
			for($i=0;$i<$lie;$i++){
				$n=$i;			
				while($n<$sum){
					if($i==0){
						$sa_one[]=$shaidan[$n];
					}else if($i==1){
						$sa_two[]=$shaidan[$n];
					}else if($i==2){
						$sa_tree[]=$shaidan[$n];
					}else if($i==3){
						$sa_for[]=$shaidan[$n];
					}
					$n+=$lie;
				}
			}
		}
		
		
		include templates("index","shaidan");
	}//	
	
	public function detail(){					
		$member=$this->userinfo;	
		$sd_id=abs(intval($this->segment(4)));
		$shaidan=$this->db->GetOne("select * from `@#_shaidan` where `sd_id`='$sd_id'");
		$goods = $this->db->GetOne("select sid from `@#_shoplist` where `id` = '$shaidan[sd_shopid]'");
		$goods = $this->db->GetOne("select id,qishu,money,q_uid,maxqishu,thumb,title from `@#_shoplist` where `sid` = '$goods[sid]' order by `qishu` DESC");
			
		if(isset($_POST['submit'])){			
			$sdhf_id=$shaidan['sd_id'];
			$sdhf_userid=$member['uid'];
			$sdhf_content=$_POST['sdhf_content'];
			$sdhf_time=time();
			$sdhf_username = get_user_name($member);
			$sdhf_img = $member['img'];
			if($sdhf_content==null){
				_message("页面错误");
			}
				
			$this->db->Query("INSERT INTO `@#_shaidan_hueifu`(`sdhf_id`,`sdhf_userid`,`sdhf_content`,`sdhf_time`,`sdhf_username`,`sdhf_img`)VALUES
			('$sdhf_id','$sdhf_userid','$sdhf_content','$sdhf_time','$sdhf_username','$sdhf_img')");
			$sd_ping=$shaidan['sd_ping']+1;
			$this->db->Query("UPDATE `@#_shaidan` SET sd_ping='$sd_ping' where sd_id='$shaidan[sd_id]'");			
			_message("评论成功",WEB_PATH."/go/shaidan/detail/".$sd_id);
		}					
		$shaidannew=$this->db->GetList("select * from `@#_shaidan` order by `sd_id` DESC limit 5");
		$shaidan_hueifu=$this->db->GetList("select * from `@#_shaidan_hueifu` where `sdhf_id`='$sd_id'");
		
		foreach($shaidan_hueifu as $k=>$v){
			$shaidan_hueifu[$k]['sdhf_content'] = _htmtocode($shaidan_hueifu[$k]['sdhf_content']);
		}	
		if(!$shaidan){
			_message("页面错误");
		}
		$substr=substr($shaidan['sd_photolist'],0,-1);
		$sd_photolist=explode(";",$substr);
		$title = $shaidan['sd_title'] . "_" . _cfg("web_name");
		$keywords = $shaidan['sd_title'];
		$description ='晒单详情';
		if($shaidan['sd_content']){
			$shaidan['sd_content'] = stripslashes($shaidan['sd_content']);
		}

		include templates("index","detail");
	}
	
	
	public function xianmu(){
		$sd_id=$_POST['id'];
		$shaidan=$this->db->GetOne("select * from `@#_shaidan` where `sd_id`='$sd_id'");
		$sd_zhan=$shaidan['sd_zhan']+1;
		$this->db->Query("UPDATE `@#_shaidan` SET sd_zhan='".$sd_zhan."' where sd_id='".$sd_id."'");
		echo $sd_zhan;
	}
	
		
	//商品晒单列表当前期次
	public function itmeifram(){
	
		$itemid=safe_replace($this->segment(4));

		$item=$this->db->GetOne("select * from `@#_shoplist` where `id`='$itemid' LIMIT 1");

		$shop_sid=$this->db->GetList("select id from `@#_shoplist` where `sid`='$item[sid]' and `id` != '$itemid'");

		$shop_sid_str='';
		for($i=0;$i<count($shop_sid);$i++){
			$shop_sid_str.=$shop_sid[$i]['id'].',';
		}		
		$shop_sid_str=trim($shop_sid_str,',');
		if(!empty($shop_sid_str)){
				$error = 0;
				$page=System::load_sys_class('page');		
				$total=$this->db->GetCount("select * from `@#_shaidan` where `sd_shopid` in ($shop_sid_str)");
				if(isset($_GET['p'])){
					$pagenum=$_GET['p'];
				}else{
					$pagenum=1;
				}
				$num=10;
				$page->config($total,$num,$pagenum,"0");
				$shaidan=$this->db->GetPage("select * from `@#_shaidan` where `sd_shopid` in ($shop_sid_str) order by sd_id  asc",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));	
				foreach($shaidan as $key=>$val){
					$shaidan[$key]['sd_photolist'] = explode(';',rtrim($shaidan[$key]['sd_photolist'],';'));
					//组合字符串给前台
					$temp = '';
					foreach ($shaidan[$key]['sd_photolist'] as $v) {
						
						$temp.= '<li><img src="'.G_UPLOAD_PATH.'/'.$v.'" border=0 width="70px" /></li>';
					}
					$shaidan[$key]['photolist'] = $temp;
					unset($temp);
					$member_info=$this->db->GetOne("select * from `@#_member` where `uid`='$val[sd_userid]'");
					$member_img[$val['sd_id']]=$member_info['img'];
					$member_id[$val['sd_id']]=$member_info['uid'];
					$member_username[$val['sd_id']]=$member_info['username'];
				}		
		}else{
			$error = 1;
		}
		
	
		include templates("index","itemifram"); 
	}


	//商品晒单列表历史期次
	public function itemiframstory(){
	
		$itemid=safe_replace($this->segment(4));

		$item=$this->db->GetOne("select * from `@#_shoplist` where `id`='$itemid' LIMIT 1");
		$ids =  $item['id'];
		$qs = $item['qishu'];
		$shaidan=$this->db->GetList("select * from `@#_shaidan` where `sd_shopid`= $ids and  `sd_qishu`= $qs");
		if(!empty($shaidan)){
			$error = 0;
				foreach($shaidan as $key=>$val){
					$shaidan[$key]['sd_photolist'] = explode(';',rtrim($shaidan[$key]['sd_photolist'],';'));
					//组合字符串给前台
					$temp = '';
					foreach ($shaidan[$key]['sd_photolist'] as $v) {	
						$temp.= '<li><img src="'.G_UPLOAD_PATH.'/'.$v.'" border=0 width="70px" /></li>';
					}
					$shaidan[$key]['photolist'] = $temp;
					unset($temp);
					$member_info=$this->db->GetOne("select * from `@#_member` where `uid`='$val[sd_userid]'");
					$member_img[$val['sd_id']]=$member_info['img'];
					$member_id[$val['sd_id']]=$member_info['uid'];
					$member_username[$val['sd_id']]=$member_info['username'];
				}	
		}else{
			$error = 1;
		}
		
	
		include templates("index","itemiframstory"); 
	}



}
?>