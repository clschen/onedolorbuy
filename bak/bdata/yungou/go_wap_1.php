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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '����',
  `title` char(100) DEFAULT '' COMMENT '�������',
  `link` char(255) DEFAULT '' COMMENT '���ӵ�ַ',
  `img` text COMMENT 'ͼƬ��ַ',
  `color` text COMMENT '��Ҳ��֪��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=gbk");
E_D("replace into `go_wap` values('4','�ֻ�ad3','#','banner/20160615/54619434004074.jpg','#df4f66');");

require("../../inc/footer.php");
?>