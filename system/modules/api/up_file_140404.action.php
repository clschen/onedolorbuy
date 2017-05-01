<?php 

 class up_file_140404 extends SystemAction {
 
	public function init(){
		$db = System::load_sys_class("model");
		$q = $db->Query("		
			CREATE TABLE `@#_qqset` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `qq` varchar(11) DEFAULT NULL,
			  `name` varchar(50) DEFAULT NULL,
			  `type` varchar(20) DEFAULT NULL,
			  `province` varchar(50) DEFAULT NULL,
			  `city` varchar(50) DEFAULT NULL,
			  `county` varchar(50) DEFAULT NULL,
			  `qqurl` varchar(250) DEFAULT NULL,
			  `full` varchar(6) DEFAULT NULL COMMENT '是否已满',
			  `subtime` int(11) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
		");
		
		if($q){
			unlink(__FILE__);
			_message("升级成功");
		}
	
	}

 }

?>