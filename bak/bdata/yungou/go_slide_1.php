<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_slide`;");
E_C("CREATE TABLE `go_slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(50) DEFAULT NULL COMMENT '幻灯片',
  `title` varchar(30) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `way` int(1) unsigned DEFAULT '0' COMMENT '手机端的轮播图',
  PRIMARY KEY (`id`),
  KEY `img` (`img`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='幻灯片表'");
E_D("replace into `go_slide` values('10','banner/20160328/88694467095510.jpg','ert','#','0');");

require("../../inc/footer.php");
?>