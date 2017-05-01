<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_egglotter_spoil`;");
E_C("CREATE TABLE `go_egglotter_spoil` (
  `spoil_id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) DEFAULT NULL,
  `spoil_name` text COMMENT '名称',
  `spoil_jl` int(11) DEFAULT NULL COMMENT '机率',
  `spoil_dj` int(11) DEFAULT NULL,
  `urlimg` varchar(200) DEFAULT NULL,
  `subtime` int(11) DEFAULT NULL COMMENT '提交时间',
  PRIMARY KEY (`spoil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8");
E_D("replace into `go_egglotter_spoil` values('1','1','洗衣粉','20','1',NULL,'1457761129');");
E_D("replace into `go_egglotter_spoil` values('2','1','游戏机','40','2',NULL,'1457761129');");
E_D("replace into `go_egglotter_spoil` values('3','1','手机','40','3',NULL,'1457761129');");

require("../../inc/footer.php");
?>