<?php

defined('G_IN_SYSTEM')or exit('no');
System::load_app_fun('global',G_ADMIN_DIR);
System::load_app_fun('my','go');
System::load_app_fun('user','go');
System::load_app_class("base","member","no");
System::load_app_class('response','apis','no');
System::load_sys_fun('user');
class shaidan extends base {
	public $db;
	public function __construct(){
		parent::__construct();
		$this->db=System::load_sys_class('model');

	}

	/*
	 *晒单列表
	 */

	public function shaidanlist()
	{
		/*$_POST =['parm'=>'new','page'=>1,'pagesize'=>2];*/
		if(empty($_POST['parm']) || empty($_POST['page']) || empty($_POST['pagesize'])){
			response::show(2001,'缺少参数');
		}
		$parm=htmlspecialchars($_POST['parm']);
		$end=$_POST['pagesize'];
		$star=($_POST['page']-1)*$_POST['pagesize'];

		if($parm=='new'){
			$sel='`sd_time`';
		}else if($parm=='renqi'){
			$sel='`sd_zhan`';
		}else if($parm=='pinglun'){
			$sel='`sd_ping`';
		}
		$count=$this->db->GetList("select * from `@#_shaidan` order by $sel DESC");
		$shaidan=$this->db->GetList("select * from `@#_shaidan` order by $sel DESC limit $star,$end");

		foreach($shaidan as $sd){
			$user[]=get_user_name($sd['sd_userid']);
			$time[]=date("Y-m-d H:i",$sd['sd_time']);
			$member=$this->db->GetOne("select * from `@#_member` where `uid`='$sd[sd_userid]'");
			if ($member['img']!='photo/member.jpg') {
				$pic[]="/statics/uploads/".$member['img'];
			}elseif ($member['headimg']!=''){
				$pic[]=$member['headimg'];
			}else{
				$pic[]="/statics/uploads/".$member['img'];
			}
			
		}
		for($i=0;$i<count($shaidan);$i++){
			$shaidan[$i]['user']=$user[$i];
			$shaidan[$i]['time']=$time[$i];
			$shaidan[$i]['pic']=$pic[$i];
		}
		$pagex=ceil(count($count)/$end);
		$shaidan['count'] = $pagex;
		if($shaidan['count'] >0){
			response::show(2000,'获取晒单信息成功',$shaidan);
		}else{
			response::show(2004,'查无晒单信息');
		}
	}

	/*
	 *晒单详情
	 */
	public function detail()
	{
	    if(empty($_POST['sd_id'])){
			response::show(2001,'缺少参数');
		}
		$sd_id=intval($_POST['sd_id']);
		$shaidan=$this->db->GetOne("select * from `@#_shaidan` where `sd_id`='$sd_id'");
		if(!$shaidan){
			response::show(2004,'信息获取失败');
		}
		$shaidanname=$this->db->GetOne("select * from `@#_member` where `uid`='$shaidan[sd_userid]'");
		if(!empty($shaidan['sd_shopid'])){
			$goods = $this->db->GetOne("select * from `@#_shoplist` where `sid` = '$shaidan[sd_shopid]' order by `qishu` DESC");
		}else{
			$goods = $this->db->GetOne("select * from `@#_jf_shoplist` where `sid` = '$shaidan[sd_shopid]' order by `qishu` DESC");
		}		
	
		$substr=substr($shaidan['sd_photolist'],0,-1);
		$sd_photolist=explode(";",$substr);
		$data = compact($shaidan,$shaidanname,$goods,$sd_photolist);
		if($data){
			response::show(2000,'信息获取成功',$data);
		}else{
			response::show(2004,'信息获取失败');
		}
	}

	/*
	 *最近晒单
	 */
	public function shaidannew()
	{
		$shaidannew=$this->db->GetList("select * from `@#_shaidan` order by `sd_id` DESC limit 5");
		if($shaidannew){
			response::show(2000,'获取信息成功',$shaidannew);
		}else{
			response::show(2004,'没有相关信息');
		}
	}

	/*
	 *晒单评论列表
	 */
	public function huifulist()
	{
		// $_POST['sd_id'] = 1;
		if(empty($_POST['sd_id'])){
			response::show(2001,'缺少参数');
		}
		$sd_id = $_POST['sd_id'];
		$shaidan_hueifu=$this->db->GetList("select * from `@#_shaidan_hueifu` where `sdhf_id`='$sd_id'");
		if($shaidan_hueifu){
			response::show(2000,'获取信息成功',$shaidan_hueifu);
		}else{
			response::show(2004,'没有相关信息');
		}
	}
	/*
	 *晒单回复
	 */
	public function plajax()
	{
		// $_POST = ['sd_id'=>1,'uid'=>6,'content'=>'sd'];
	    if(empty($_POST['sd_id']) || empty($_POST['uid']) || empty($_POST['content'])){
			response::show(2001,'缺少参数');
		}
		$sdhf_id=$_POST['sd_id'];
		$sdhf_userid=$_POST['uid'];
		$sdhf_content=$_POST['content'];
		$sdhf_time=time();
		$mem = $this->db->GetOne("select * from `@#_member` where `uid`='$uid'");
		$username = $mem['username'];
		$img = $mem['img'];
		$shaidan=$this->db->GetOne("select * from `@#_shaidan` where `sd_id`='$sdhf_id'");
		$this->db->Query("INSERT INTO `@#_shaidan_hueifu`(`sdhf_id`,`sdhf_userid`,`sdhf_content`,`sdhf_time`,`sdhf_username`,`sdhf_img`)VALUES
		('$sdhf_id','$sdhf_userid','$sdhf_content','$sdhf_time','$username','$img')");

		$sd_ping=$shaidan['sd_ping']+1;
		$shaidans = $this->db->Query("UPDATE `@#_shaidan` SET sd_ping='$sd_ping' where sd_id='$shaidan[sd_id]'");
		if($shaidans){
			$shaidan_hueifu=$this->db->GetList("select * from `@#_shaidan_hueifu` where `sdhf_id`='$sdhf_id'");
			response::show(2000,'回复成功',$shaidan_hueifu);
		}else{
			response::show(2004,'回复失败');
		}
	}
	/*
	 *点赞
	 */
	public function xianmu()
	{
		$_POST['sd_id'] = 1;
	    if(empty($_POST['sd_id'])){
			response::show(2001,'缺少参数');
		}
		$sd_id=$_POST['sd_id'];
		$shaidan=$this->db->GetOne("select * from `@#_shaidan` where `sd_id`='$sd_id'");
		$sd_zhan=$shaidan['sd_zhan']+1;
		$shaidans = $this->db->Query("UPDATE `@#_shaidan` SET sd_zhan='".$sd_zhan."' where sd_id='".$sd_id."'");
		
		if($shaidans){
			response::show(2000,'点赞成功',['sd_zhan'=>$sd_zhan]);
		}else{
			response::show(2004,'点赞失败');
		}
	}
}
