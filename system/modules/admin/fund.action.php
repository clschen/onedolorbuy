<?php 



defined('G_IN_SYSTEM')or exit('');

System::load_app_class('admin','','no');

System::load_app_fun('global');

class fund extends admin {

	

	public function __construct(){

		parent::__construct();

		$this->db=System::load_sys_class('model');

	}



	public function fundset(){

		

		$config = $this->db->GetOne("select * from `@#_fund` LIMIT 1");

		if(isset($_POST['dosubmit'])){

			$off = intval($_POST['fund_off']);

			$money = floatval(substr(sprintf("%.3f",$_POST['fund_money']), 0, -1));

			if(isset($_POST['fund_count_money'])){

				$count_money = floatval(substr(sprintf("%.3f",$_POST['fund_count_money']), 0, -1));

			}else{

				$count_money = $config['fund_count_money'];

			}

			if($money<=0){

				_message("基金出资金额不正确");

			}

			$this->db->Query("UPDATE `@#_fund` SET `fund_off` = '$off',`fund_money` = '$money',`fund_count_money` = '$count_money'");

			_message("修改成功");

		}		

		$config = $this->db->GetOne("select * from `@#_fund` LIMIT 1");

		include $this->tpl(ROUTE_M,'fundset');

	}

	public function specify(){
		if(isset($_POST['dosubmit'])){
			$shopid = intval($_POST['shopid']);
			$userid = intval($_POST['userid']);
			$time = time();
			$appoint = $this->db->GetOne("SELECT * from `@#_appoint` WHERE `shopid` ='$shopid' LIMIT 1");
			$goods =  $this->db->GetOne("SELECT * from `@#_shoplist` WHERE `id` ='$shopid' LIMIT 1");
			$user =  $this->db->GetOne("SELECT * from `@#_member` WHERE `uid` ='$userid' LIMIT 1");
			$ex_info=$this->db->GetOne("select * from `@#_member_go_record` where `shopid` = '$shopid' and `uid`='{$userid}'");
			if(empty($user)){
				_message("指定中奖人不存在");
			}
			if(empty($ex_info)){
				_message("指定的中奖人未参与购买，不能指定该用户！");
			}
			if(!empty($appoint)){
				_message("该项目已经指定过中奖人，请删除后从新设置");
			}
			if(!empty($goods['q_uid'])){
				_message("该项目已经开奖完毕不能设置中奖人，请从新设置");
			}

			$res = $this->db->Query("INSERT INTO `@#_appoint` SET `shopid` = '$shopid',`userid` = '$userid',`time` = '$time'");
			$res1 = $this->db->Query("UPDATE `@#_shoplist` SET `zhiding` = '$userid' WHERE `id`='$shopid'");
			if($res>0 && $res1>0){
				_message("中奖人添加成功",G_ADMIN_PATH.'/fund/specifylist/');
			}else{
				_message("中奖人添加失败");
			}

		}
		include $this->tpl(ROUTE_M,'specify');
	}

	public function specifylist(){

		$num=20;

		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_appoint`  WHERE 1"); 

		$page=System::load_sys_class('page');

		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	

		$page->config($total,$num,$pagenum,"0");	

		$res=$this->db->GetPage("SELECT * FROM `@#_appoint` WHERE 1",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0)); 
		
		include $this->tpl(ROUTE_M,'specifylist');
	}


	//删除指定的人
	public function zddel(){
		$id=intval($this->segment(4));
		$appoint = $this->db->GetOne("SELECT * from `@#_appoint` WHERE `id` ='$id' LIMIT 1");
		//查询商品的sid
		$shopinfo = $this->db->GetOne("SELECT * from `@#_shoplist` WHERE `id` ='{$appoint['shopid']}' LIMIT 1");
		$res = $this->db->Query("DELETE FROM `@#_appoint` WHERE (`id`='$id') LIMIT 1");
		$res1 = $this->db->Query("UPDATE `@#_shoplist` SET `zhiding` = 0 WHERE `sid`='{$shopinfo['sid']}' AND `q_uid` is Null");
			if($res>0 && $res1>0){			
				_message("删除成功");
			}else{
				_message("删除失败");
			}
	}

}