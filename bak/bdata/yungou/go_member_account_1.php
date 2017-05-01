<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_member_account`;");
E_C("CREATE TABLE `go_member_account` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(1) DEFAULT NULL COMMENT '充值1/消费-1',
  `pay` char(20) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL COMMENT '详情',
  `money` mediumint(8) NOT NULL DEFAULT '0' COMMENT '金额',
  `time` char(20) NOT NULL,
  KEY `uid` (`uid`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员账户明细'");

require("../../inc/footer.php");
?>