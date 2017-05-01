<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_admin`;");
E_C("CREATE TABLE `go_admin` (
  `uid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `mid` tinyint(3) unsigned NOT NULL,
  `username` char(15) NOT NULL,
  `userpass` char(32) NOT NULL,
  `useremail` varchar(100) DEFAULT NULL,
  `addtime` int(10) unsigned DEFAULT NULL,
  `logintime` int(10) unsigned DEFAULT NULL,
  `loginip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='管理员表'");
E_D("replace into `go_admin` values('1','0','admin','7fef6171469e80d32c0559f88b377245',NULL,NULL,'1470882172','127.0.0.1');");

require("../../inc/footer.php");
?>