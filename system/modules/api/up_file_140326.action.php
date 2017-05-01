<?php 

@set_time_limit(0);
 class up_file_140326 extends SystemAction {
 
	private $db;
	public function init(){	
		$this->db = System::load_sys_class("model");	



		$q1 = $this->db->Query("alter table `@#_member_go_record` add `company` char(10) DEFAULT NULL after status");
		$q2 = $this->db->Query("alter table `@#_member_go_record` add `company_code` char(20) DEFAULT NULL after status");
		$q3 = $this->db->Query("alter table `@#_member_go_record` add `company_money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' after status");
		
		
		$lists = $this->db->GetList("SELECT id,status FROM `@#_member_go_record` where 1");
		$q4=true;
		foreach($lists as $key=>$val){			
			$vals = '';
			if($val['status'] == '已付款,未发货,'){
				$vals = '已付款,未发货,未完成';	
			}else if($val['status'] == '已付款,已发货'){
				$vals = '已付款,已发货,已完成';	
			}else{	
				$vals = $val['status'].',未完成';
			}
			$id = $val['id'];
			$q = $this->db->Query("UPDATE `@#_member_go_record` SET `status` = '$vals' WHERE `id` = '$id'");
			if(!$q){
				$q4 = false;
			}
		}
		
		if($q1 && $q2 && $q3 && $q4){
			
			unlink(__FILE__);
			_message("升级成功!");
		
		}
	}  
 
 }

?>