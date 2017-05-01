<?php 

class up_file_140329 extends SystemAction {



	function init(){
	
		$db = System::load_sys_class("model");
		$sql = "CREATE TABLE `@#_send` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `uid` int(10) unsigned NOT NULL,
			  `gid` int(10) unsigned NOT NULL,
			  `username` varchar(30) NOT NULL,
			  `shoptitle` varchar(200) NOT NULL,
			  `send_type` tinyint(4) NOT NULL,
			  `send_time` int(10) unsigned NOT NULL,
			  PRIMARY KEY (`id`),
			  KEY `uid` (`uid`),
			  KEY `gid` (`gid`),
			  KEY `send_type` (`send_type`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
		$q = $db->Query($sql);
		if($q){
			unlink(__FILE__);
			_message("数据库升级成功");
		}
		_message("数据库升级失败");
	}




}