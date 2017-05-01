<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_brand`;");
E_C("CREATE TABLE `go_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cateid` int(10) unsigned DEFAULT NULL COMMENT '所属栏目ID',
  `status` char(1) DEFAULT 'Y' COMMENT '显示隐藏',
  `name` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `order` (`order`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COMMENT='品牌表'");
E_D("replace into `go_brand` values('1','13','Y','联想','16');");
E_D("replace into `go_brand` values('2','14','Y','诺基亚','1');");
E_D("replace into `go_brand` values('3','6','Y','苹果','1');");
E_D("replace into `go_brand` values('4','14','Y','三星','14');");
E_D("replace into `go_brand` values('6','14','Y','小米','1');");
E_D("replace into `go_brand` values('7','14','Y','oppo','1');");
E_D("replace into `go_brand` values('8','14','Y','HTC','15');");
E_D("replace into `go_brand` values('10','14','Y','苹果','1');");
E_D("replace into `go_brand` values('11','14','Y','三星','1');");
E_D("replace into `go_brand` values('12','14','Y','台电','13');");
E_D("replace into `go_brand` values('13','12','Y','大疆','3');");
E_D("replace into `go_brand` values('14','6','Y','台电','1');");
E_D("replace into `go_brand` values('15','12','Y','尼康','1');");
E_D("replace into `go_brand` values('16','14','Y','诺基亚','1');");
E_D("replace into `go_brand` values('17','14','Y','苹果','1');");
E_D("replace into `go_brand` values('18','14','Y','小米','1');");
E_D("replace into `go_brand` values('19','14','Y','oppo','1');");
E_D("replace into `go_brand` values('20','15','Y','海尔','1');");
E_D("replace into `go_brand` values('21','15','Y','美的','1');");
E_D("replace into `go_brand` values('22','14','Y','华为','1');");
E_D("replace into `go_brand` values('23','14','Y','魅族','1');");
E_D("replace into `go_brand` values('51','15','Y','汽车','1');");
E_D("replace into `go_brand` values('25','6','Y','VIVO','1');");
E_D("replace into `go_brand` values('28','6','Y','Lenovo','1');");
E_D("replace into `go_brand` values('29','6','Y','Cannon','1');");
E_D("replace into `go_brand` values('30','6','Y','NiKon','1');");
E_D("replace into `go_brand` values('31','6','Y','Leica','1');");
E_D("replace into `go_brand` values('32','6','Y','SONY','1');");
E_D("replace into `go_brand` values('33','6','Y','FUJIFILM','1');");
E_D("replace into `go_brand` values('34','6','Y','PENT','1');");
E_D("replace into `go_brand` values('35','6','Y','AXPENTAX','1');");
E_D("replace into `go_brand` values('36','6','Y','信礼坊','1');");
E_D("replace into `go_brand` values('37','6','Y','绿岭','1');");
E_D("replace into `go_brand` values('38','5','Y','欧米茄','1');");
E_D("replace into `go_brand` values('39','6','Y','礼意久久','1');");
E_D("replace into `go_brand` values('40','6','Y','安致儿','1');");
E_D("replace into `go_brand` values('41','6','Y','尚艺礼','1');");
E_D("replace into `go_brand` values('42','6','Y','梦之草','1');");
E_D("replace into `go_brand` values('43','6','Y','浪莎','1');");
E_D("replace into `go_brand` values('44','6','Y','红豆','1');");
E_D("replace into `go_brand` values('45','6','Y','屋里香','1');");
E_D("replace into `go_brand` values('46','6','Y','可蓝','1');");
E_D("replace into `go_brand` values('47','6','Y','佳柯','1');");
E_D("replace into `go_brand` values('48','6','Y','悠享','1');");
E_D("replace into `go_brand` values('49','6','Y','茂霖','1');");
E_D("replace into `go_brand` values('50','6','Y','绿岭味','1');");

require("../../inc/footer.php");
?>