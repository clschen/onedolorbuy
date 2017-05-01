<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_cjcode`;");
E_C("CREATE TABLE `go_cjcode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` int(10) unsigned NOT NULL,
  `scenename` char(50) NOT NULL DEFAULT '' COMMENT '推广员或者渠道名称',
  `ticket` char(255) NOT NULL DEFAULT '' COMMENT '二维码ticket',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `total` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '总共的关注人数',
  `nownum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '扫描关注人数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=169 DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>