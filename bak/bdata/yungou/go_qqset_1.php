<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('latin1');
E_D("DROP TABLE IF EXISTS `go_qqset`;");
E_C("CREATE TABLE `go_qqset` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qq` text CHARACTER SET utf8,
  `name` text CHARACTER SET utf8,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `qqurl` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `full` char(10) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '???????',
  `province` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `county` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `subtime` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1");
E_D("replace into `go_qqset` values('14','890890','90???','???','http://qun.qq.com/','??','????','???','???','1470373798');");
E_D("replace into `go_qqset` values('15','89890890','80????','???','http://qun.qq.com/','??','??','???','?????','1440475061');");
E_D("replace into `go_qqset` values('16','8908089','70?QQ???','???','http://qun.qq.com/','??','??','???','?????','1440475055');");

require("../../inc/footer.php");
?>