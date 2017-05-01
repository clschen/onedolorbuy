<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_share`;");
E_C("CREATE TABLE `go_share` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8");
E_D("replace into `go_share` values('1','0','0');");
E_D("replace into `go_share` values('2','0','0');");
E_D("replace into `go_share` values('3','0','1');");
E_D("replace into `go_share` values('4','0','0');");
E_D("replace into `go_share` values('5','0','1');");
E_D("replace into `go_share` values('6','0','0');");
E_D("replace into `go_share` values('7','0','0');");
E_D("replace into `go_share` values('8','0','0');");
E_D("replace into `go_share` values('9','0','0');");
E_D("replace into `go_share` values('10','0','0');");
E_D("replace into `go_share` values('11','0','0');");
E_D("replace into `go_share` values('12','0','3600');");
E_D("replace into `go_share` values('13','0','1');");
E_D("replace into `go_share` values('14','0','0');");
E_D("replace into `go_share` values('15','0','0');");
E_D("replace into `go_share` values('16','0','0');");
E_D("replace into `go_share` values('17','0','0');");
E_D("replace into `go_share` values('18','0','0');");
E_D("replace into `go_share` values('19','0','1078119275');");
E_D("replace into `go_share` values('20','0','4006810039');");
E_D("replace into `go_share` values('21','0','0');");
E_D("replace into `go_share` values('22','0','0');");
E_D("replace into `go_share` values('23','0','0');");
E_D("replace into `go_share` values('24','0','123456');");
E_D("replace into `go_share` values('25','0','180');");
E_D("replace into `go_share` values('26','0','1');");
E_D("replace into `go_share` values('27','0','1');");

require("../../inc/footer.php");
?>