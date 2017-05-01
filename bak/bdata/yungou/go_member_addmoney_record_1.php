<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_member_addmoney_record`;");
E_C("CREATE TABLE `go_member_addmoney_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `code` char(20) NOT NULL,
  `money` decimal(10,2) unsigned NOT NULL,
  `pay_type` char(20) NOT NULL,
  `status` char(20) NOT NULL,
  `time` int(10) NOT NULL,
  `score` int(10) unsigned NOT NULL DEFAULT '0',
  `scookies` text COMMENT '购物车cookie',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8");
E_D("replace into `go_member_addmoney_record` values('2','1','C14709006078333316','10.00','云支付','未付款','1470900607','0','0');");

require("../../inc/footer.php");
?>