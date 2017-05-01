<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_ad_data`;");
E_C("CREATE TABLE `go_ad_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` char(10) DEFAULT NULL COMMENT 'code,text,img',
  `content` text,
  `checked` tinyint(1) DEFAULT '0' COMMENT '1表示通过',
  `addtime` int(10) unsigned NOT NULL,
  `endtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='广告'");
E_D("replace into `go_ad_data` values('5','3','测试','couplet','admanage/20160328/44911418097639.jpg,admanage/20160328/48076565097647.jpg','0','1459094400','1522166400');");

require("../../inc/footer.php");
?>