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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id ֵ',
  `lianxu` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '����ǩ������',
  `sum` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '�ܼ�ǩ������',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'ǩ��ʱ��',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '�û�id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>