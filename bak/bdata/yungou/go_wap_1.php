<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `go_wap`;");
E_C("CREATE TABLE `go_wap` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` char(100) DEFAULT '' COMMENT '广告描述',
  `link` char(255) DEFAULT '' COMMENT '链接地址',
  `img` text COMMENT '图片地址',
  `color` text COMMENT '我也不知道',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=gbk");
E_D("replace into `go_wap` values('4','手机ad3','#','banner/20160615/54619434004074.jpg','#df4f66');");

require("../../inc/footer.php");
?>