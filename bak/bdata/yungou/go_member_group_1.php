<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_member_group`;");
E_C("CREATE TABLE `go_member_group` (
  `groupid` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(15) NOT NULL COMMENT '会员组名',
  `jingyan_start` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '需要的经验值',
  `jingyan_end` int(10) NOT NULL,
  `icon` varchar(255) DEFAULT NULL COMMENT '图标',
  `type` char(1) NOT NULL DEFAULT 'N' COMMENT '是否是系统组',
  PRIMARY KEY (`groupid`),
  KEY `jingyan` (`jingyan_start`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='会员权限组'");
E_D("replace into `go_member_group` values('1','云购新手','0','500',NULL,'N');");
E_D("replace into `go_member_group` values('2','云购小将','501','1000',NULL,'N');");
E_D("replace into `go_member_group` values('3','云购中将','1001','3000',NULL,'N');");
E_D("replace into `go_member_group` values('4','云购上将','3001','6000',NULL,'N');");
E_D("replace into `go_member_group` values('5','云购大将','6001','20000',NULL,'N');");
E_D("replace into `go_member_group` values('6','云购将军','20001','40000',NULL,'N');");

require("../../inc/footer.php");
?>