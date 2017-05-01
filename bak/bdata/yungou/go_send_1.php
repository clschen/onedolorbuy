<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_send`;");
E_C("CREATE TABLE `go_send` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned DEFAULT '0',
  `gid` int(11) unsigned DEFAULT '0' COMMENT '商品ID',
  `username` char(50) CHARACTER SET gbk DEFAULT '' COMMENT '用户名',
  `shoptitle` char(120) CHARACTER SET gbk DEFAULT '' COMMENT '商品名称',
  `send_type` tinyint(4) unsigned DEFAULT '0' COMMENT '发送类型',
  `send_time` int(10) unsigned DEFAULT '0' COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='中奖信息发送列表'");

require("../../inc/footer.php");
?>