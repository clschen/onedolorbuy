<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_card_pwd`;");
E_C("CREATE TABLE `go_card_pwd` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pwd` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pwd` (`pwd`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='卡密密码表'");
E_D("replace into `go_card_pwd` values('2','4297f44b13955235245b2497399d7a93');");

require("../../inc/footer.php");
?>