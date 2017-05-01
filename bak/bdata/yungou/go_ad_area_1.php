<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_ad_area`;");
E_C("CREATE TABLE `go_ad_area` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `width` smallint(6) unsigned DEFAULT NULL,
  `height` smallint(6) unsigned DEFAULT NULL,
  `des` varchar(255) DEFAULT NULL,
  `checked` tinyint(1) DEFAULT '0' COMMENT '1表示通过',
  PRIMARY KEY (`id`),
  KEY `checked` (`checked`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='广告位'");
E_D("replace into `go_ad_area` values('3','首页对联广告','150','300','首页对联广告','1');");

require("../../inc/footer.php");
?>