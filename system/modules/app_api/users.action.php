<?php

defined('G_IN_SYSTEM')or exit("no");

class users extends SystemAction {
	//json获取获取栏目
	public function __construct(){		
		$this->db=System::load_sys_class('model');
	}
	public function index(){
		
		echo md5("xiang.2457");
	}
}

?>