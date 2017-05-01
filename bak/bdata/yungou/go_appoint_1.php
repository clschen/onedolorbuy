<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_appoint`;");
E_C("CREATE TABLE `go_appoint` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shopid` int(10) unsigned NOT NULL COMMENT '商品期数id',
  `userid` int(10) unsigned NOT NULL COMMENT '中奖用户',
  `time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `status` int(10) unsigned NOT NULL COMMENT '订单状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8");
E_D("replace into `go_appoint` values('1','443','786','1458568528','0');");
E_D("replace into `go_appoint` values('2','418','1741','1458906016','0');");

require("../../inc/footer.php");
?>