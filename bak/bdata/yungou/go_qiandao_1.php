<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `go_qiandao`;");
E_C("CREATE TABLE `go_qiandao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id 值',
  `lianxu` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '连续签到天数',
  `sum` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '总计签到天数',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签到时间',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>