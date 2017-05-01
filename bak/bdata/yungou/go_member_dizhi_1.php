<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_member_dizhi`;");
E_C("CREATE TABLE `go_member_dizhi` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` int(10) NOT NULL COMMENT '用户id',
  `sheng` varchar(15) DEFAULT NULL COMMENT '省',
  `shi` varchar(15) DEFAULT NULL COMMENT '市',
  `xian` varchar(15) DEFAULT NULL COMMENT '县',
  `jiedao` varchar(255) DEFAULT NULL COMMENT '街道地址',
  `youbian` mediumint(8) DEFAULT NULL COMMENT '邮编',
  `shouhuoren` varchar(15) DEFAULT NULL COMMENT '收货人',
  `mobile` char(11) DEFAULT NULL COMMENT '手机',
  `tell` varchar(15) DEFAULT NULL COMMENT '座机号',
  `default` char(1) DEFAULT 'N' COMMENT '是否默认',
  `time` int(10) unsigned NOT NULL,
  `qq` char(20) NOT NULL DEFAULT '' COMMENT 'QQ 号码',
  `shifoufahuo` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否发货！',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员地址表'");

require("../../inc/footer.php");
?>