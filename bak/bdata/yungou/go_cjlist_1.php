<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_cjlist`;");
E_C("CREATE TABLE `go_cjlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `wxid` char(255) NOT NULL DEFAULT '' COMMENT '推广员或者渠道名称',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `codeid` char(20) NOT NULL DEFAULT '' COMMENT '场景码',
  `come` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0是关注  1是扫描',
  `sum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '扫描或者关注次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=270 DEFAULT CHARSET=utf8 COMMENT='场景关注报表'");

require("../../inc/footer.php");
?>