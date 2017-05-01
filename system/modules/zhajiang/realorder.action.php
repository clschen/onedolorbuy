<?php 

defined('G_IN_SYSTEM')or exit('');
System::load_app_class('admin', G_ADMIN_DIR, 'no');
class realorder extends admin {
	private $db;
	public function __construct(){		
		parent::__construct();		
        $this->db = $this->DB();
	}
	public function dingdan_lists(){
		$num=20;	
		$total=$this->db->GetCount("SELECT COUNT(*) FROM `@#_member_go_record` as a,`@#_member` as b where a.uid=b.uid AND b.auto_user =0");
		$page=System::load_sys_class('page');
		if(isset($_GET['p'])){$pagenum=$_GET['p'];}else{$pagenum=1;}	
		$page->config($total,$num,$pagenum,"0");
		$recordlist=$this->db->GetPage("SELECT a.*,b.auto_user FROM `@#_member_go_record` as a,`@#_member` as b where a.uid=b.uid AND b.auto_user =0 order by a.`time` DESC",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));	
		include $this->tpl(ROUTE_M,'realorder.dingdan');		
	}
}