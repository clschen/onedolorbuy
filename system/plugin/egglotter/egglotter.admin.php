<?php 

$this->mysql_model=System::load_sys_class('model');
System::load_app_class("admin",G_ADMIN_DIR,"no");
class egglotter extends admin {
	public function __construct() {	
		parent::__construct();
		$this->db=System::load_sys_class("model");
	}	
	public function init(){
		include "tpl/egglotter.admin.php";
	}
	
	public function listlotter(){
		$list=$this->db->GetList("SELECT * FROM `@#_egglotter_rule` WHERE 1");
		include "tpl/egglotter_list.admin.php";
	}
	public function update(){
		$id=$this->segment(6);
		$arr=$this->db->GetList("SELECT * FROM `@#_egglotter_rule` WHERE `rule_id`='$id'");
		$spoilarr=$this->db->GetList("SELECT * FROM `@#_egglotter_spoil` WHERE `rule_id`='$id'");
		//echo "<pre>";
		//print_r($spoilarr);
		//exit;
		
		include "tpl/egglotter_update.admin.php";
	}
	public function del(){
		$dellink=intval($this->segment(6));
		if($dellink){
			$this->db->Query("DELETE FROM `@#_egglotter_rule` WHERE `rule_id`='$dellink'");
			$this->db->Query("DELETE FROM `@#_egglotter_spoil` WHERE `rule_id`='$dellink'");
			if($this->db->affected_rows()){
				_message("删除成功");
			}else{
				_message("删除失败");
			}
		}
	}
	public function adminuser(){
		$curtime=time();
		$ruleinfo=$this->db->GetOne("select * from `@#_egglotter_rule` where `starttime`<='$curtime' and `endtime`>='$curtime' and `startusing`=1");          
        $rule_id=$ruleinfo['rule_id'];

		$spoilinfo=$this->db->GetList("select * from `@#_egglotter_spoil` where `rule_id`='$rule_id'"); 				
		$spoil_id=$spoilinfo[2]['spoil_id'];
		//分页
		$num=30;
		$total=$this->db->GetCount("select * from `@#_egglotter_award` where `spoil_id`!='$spoil_id' ");
		$page=System::load_sys_class('page');
		
		if(isset($_GET['p'])){
			$pagenum=$_GET['p'];
		}else{$pagenum=1;}			
		$page->config($total,$num,$pagenum,"0");
		if($pagenum>$page->page){
			$pagenum=$page->page;
		}			
		$award=$this->db->GetPage("select * from `@#_egglotter_award` where `spoil_id`!='$spoil_id'  order by `award_id` DESC",array("num"=>$num,"page"=>$pagenum,"type"=>1,"cache"=>0));

		
		
		$rule=$this->db->GetList("select * from `@#_egglotter_rule`");
		$slinfo=$this->db->GetList("select * from `@#_egglotter_spoil` ");
		$member=$this->db->GetList("select * from `@#_member`");
		//print_r($award);
		include "tpl/egglotter_user.adminuser.php";	
	}
	public function awarddel(){
		$dellink=intval($this->segment(6));
		if($dellink){
			$this->db->Query("DELETE FROM `@#_egglotter_award` WHERE `award_id`='$dellink'");
			if($this->db->affected_rows()){
				_message("删除成功");
			}else{
				_message("删除失败");
			}
		}
	}
	
	
}

$lotter=new egglotter();

$fun='init';
$urlfun='';
$urlfun=$this->segment(5);

if($urlfun!=''){
  $fun=$urlfun;
}
switch($fun){
    case 'init':
       $lotter -> init();
	   break;

    case 'listlotter':
       $lotter -> listlotter();
	   break; 
	case 'update':
       $lotter -> update();
	   break;
	case 'del':
       $lotter -> del();
	   break;
	case 'adminuser':
       $lotter -> adminuser();
	   break;
	case 'awarddel':
       $lotter -> awarddel();
	   break;
}



?>