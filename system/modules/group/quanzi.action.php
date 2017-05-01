<?php 

defined('G_IN_SYSTEM')or exit('');
System::load_app_class('admin',G_ADMIN_DIR,'no');
class quanzi extends admin {
	
	public function __construct(){
		parent::__construct();
		$this->ment=array(
			array("lists","圈子管理",ROUTE_M.'/'.ROUTE_C.""),
			array("addcate","添加圈子",ROUTE_M.'/'.ROUTE_C."/insert"),
			array("addcate","帖子查看",ROUTE_M.'/'.ROUTE_C."/tiezi"),
			array("addcate","帖子回复查看",ROUTE_M.'/'.ROUTE_C."/liuyan"),
		);
		$this->db=System::load_sys_class("model");
	} 
	//显示全部圈子
	public function init(){	
		$quanzi=$this->db->GetList("select * from `@#_quanzi` where 1");		
		include $this->tpl(ROUTE_M,'quanzi.list');		
	}
	//显示添加圈子
	public function insert(){
		if(isset($_POST["submit"]))
		{
			if($_POST['title']==null)_message("圈子名不能为空",null,3);
			$title= htmlspecialchars($_POST['title']);
			
			$guanli= htmlspecialchars($_POST['guanli']);
			$glfatie= htmlspecialchars($_POST['glfatie']);
			
			$checkemail=_checkemail($guanli);
			$checkemobile=_checkmobile($guanli);
			if($checkemail===false && $checkemobile===false){
				_message("圈子管理员信息填写错误");
			}
			$res=$this->db->GetOne("SELECT uid FROM `@#_member` WHERE `email`='$guanli' or `mobile`='$guanli'");
			if(empty($res)){
				_message("圈子管理员不存在");
			}else{
				$guanli=$res['uid'];
			}
			
			$jiaru= $_POST['jiaru'];
			$jianjie=htmlspecialchars($_POST['jianjie']);
			$gongao=htmlspecialchars($_POST['gongao']);
			$time= time();			
			$img = htmlspecialchars($_POST['img']);
			$this->db->Query("INSERT INTO `@#_quanzi`(title,img,guanli,jianjie,gongao,jiaru,time,glfatie)VALUES('$title','$img','$guanli','$jianjie','$gongao','$jiaru','$time','$glfatie')");
			_message("添加成功");
		}
		include $this->tpl(ROUTE_M,'quanzi.insert');
	}
	public function quanzi_update(){
		$id=intval($this->segment(4));
		$quanzi=$this->db->GetOne("select * from `@#_quanzi` where `id`='$id'");
		$member=$this->db->GetOne("select email,mobile from `@#_member` where `uid`='$quanzi[guanli]'");
		if(!$quanzi)_message("参数错误");
		
		if(isset($_POST["submit"])){
			if($_POST['title']==null)_message("圈子名不能为空");
			$title= htmlspecialchars($_POST['title']);
			$glfatie= htmlspecialchars($_POST['glfatie']);
			$guanli= htmlspecialchars($_POST['guanli']);
			$checkemail=_checkemail($guanli);
			$checkemobile=_checkmobile($guanli);
			if($checkemail===false && $checkemobile===false){
				_message("圈子管理员信息填写错误");
			}
			$res=$this->db->GetOne("SELECT uid FROM `@#_member` WHERE `email`='$guanli' or `mobile`='$guanli'");
			if(empty($res)){
				_message("圈子管理员不存在");
			}else{
				$guanli=$res['uid'];
			}
			
			$jiaru= $_POST['jiaru'];
			$jianjie=htmlspecialchars($_POST['jianjie']);
			$gongao=htmlspecialchars($_POST['gongao']);
			$time= time();
			$img = htmlspecialchars($_POST['img']);				
			$this->db->Query("UPDATE `@#_quanzi` SET title='$title',img='$img',glfatie='$glfatie',guanli='$guanli',jianjie='$jianjie',gongao='$gongao',jiaru='$jiaru',time='$time' where`id`='$id'");
			_message("修改成功");
		}		
				
		include $this->tpl(ROUTE_M,'quanzi.update');
	}
	//显示全部帖子
	public function tiezi(){
		$quanzi=$this->db->getlist("select * from `@#_quanzi` ");
		$num=20;
		$total=$this->db->GetCount("select * from `@#_quanzi_tiezi`"); 
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){
			$pagenum=$_GET['p'];
		}else{$pagenum=1;}		
		$page->config($total,$num,$pagenum,"0"); 
		if($pagenum>$page->page){
			$pagenum=$page->page;
		}	
		$tiezi=$this->db->GetPage("select * from `@#_quanzi_tiezi`",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));		
		include $this->tpl(ROUTE_M,'quanzi.tiezi');
	}
	public function tiezi_update(){
		$id=$this->segment(4);
		if(isset($_POST["submit"])){
			$title= htmlspecialchars($_POST['title']);
			$neirong= htmlspecialchars($_POST['neirong']);
			$zhiding= $_POST['zhiding'];
			if($title==null || $neirong==null){
				_message("不能为空");
			}
			$this->db->Query("UPDATE `@#_quanzi_tiezi` SET `title`='$title',`neirong`='$neirong',`zhiding`='$zhiding' where`id`='$id'");
			_message("修改成功",WEB_PATH."/group/quanzi/tiezi");
		}
		$tiezi=$this->db->GetOne("select * from `@#_quanzi_tiezi` where `id`='$id'");
		
		include $this->tpl(ROUTE_M,'quanzi.tiezi.update');
	}
	
	//删除帖子
	public function del_tiezi(){
		$id=$this->segment(4);
		$id=intval($id);
		if($id){
			$quanzix=$this->db->getlist("select * from `@#_quanzi_tiezi`  where `id`='$id' limit 1 ");
			if($quanzix){
				$this->db->Query("DELETE FROM `@#_quanzi_tiezi` where `id`='$id' ");
				_message("删除成功");
			}else{
				_message("参数错误");
			}
		}else{
			_message("参数错误");
		}
	}
	//显示全部留言
	public function liuyan(){
		$tiezi=$this->db->getlist("select * from `@#_quanzi_tiezi` ");
		$num=20;
		$total=$this->db->GetCount("select * from `@#_quanzi_hueifu`"); 
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){
			$pagenum=$_GET['p'];
		}else{$pagenum=1;}		
		$page->config($total,$num,$pagenum,"0"); 
		if($pagenum>$page->page){
			$pagenum=$page->page;
		}	
		$hueifu=$this->db->GetPage("select * from `@#_quanzi_hueifu`",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));		
		include $this->tpl(ROUTE_M,'quanzi.liuyan');
	}
	//删除圈子
	public function del(){
		$id=$this->segment(4);
		$id=intval($id);
		if($id){
			$quanzix=$this->db->getlist("select * from `@#_quanzi`  where `id`='$id' limit 1 ");
			if($quanzix){
				$this->db->Query("DELETE FROM `@#_quanzi` where `id`='$id' ");
				_message("删除成功");
			}else{
				_message("参数错误");
			}
		}else{
			_message("参数错误");
		}		
	}
}

?>