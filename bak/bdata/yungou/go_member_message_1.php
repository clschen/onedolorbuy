<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_member_message`;");
E_C("CREATE TABLE `go_member_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(1) DEFAULT '0' COMMENT '消息来源,0系统,1私信',
  `sendid` int(10) unsigned DEFAULT '0' COMMENT '发送人ID',
  `sendname` char(20) DEFAULT NULL COMMENT '发送人名',
  `content` varchar(255) DEFAULT NULL COMMENT '发送内容',
  `time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员消息表'");

require("../../inc/footer.php");
?>