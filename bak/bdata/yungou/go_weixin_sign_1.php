<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `go_weixin_sign`;");
E_C("CREATE TABLE `go_weixin_sign` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id\r\n',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否领取过',
  `input_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '领取时间',
  `typeid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '红包类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=gbk COMMENT='回复关键字赠送现金活动'");
E_D("replace into `go_weixin_sign` values('2','271','1','1449579370','10');");
E_D("replace into `go_weixin_sign` values('3','281','1','1449650825','10');");
E_D("replace into `go_weixin_sign` values('4','274','1','1450004504','10');");
E_D("replace into `go_weixin_sign` values('5','304','1','1450006389','10');");
E_D("replace into `go_weixin_sign` values('6','306','1','1450022229','10');");
E_D("replace into `go_weixin_sign` values('7','308','1','1450175287','10');");
E_D("replace into `go_weixin_sign` values('8','333','1','1450267827','10');");
E_D("replace into `go_weixin_sign` values('9','336','1','1450273111','10');");
E_D("replace into `go_weixin_sign` values('10','321','1','1450289887','10');");
E_D("replace into `go_weixin_sign` values('11','350','1','1450599623','10');");
E_D("replace into `go_weixin_sign` values('12','345','1','1450699634','10');");
E_D("replace into `go_weixin_sign` values('13','357','1','1450723236','10');");
E_D("replace into `go_weixin_sign` values('14','361','1','1450775530','10');");
E_D("replace into `go_weixin_sign` values('15','356','1','1450777431','10');");
E_D("replace into `go_weixin_sign` values('16','364','1','1450855662','10');");
E_D("replace into `go_weixin_sign` values('17','360','1','1450870130','10');");
E_D("replace into `go_weixin_sign` values('18','367','1','1450875918','10');");
E_D("replace into `go_weixin_sign` values('19','411','1','1451890610','10');");
E_D("replace into `go_weixin_sign` values('20','421','1','1452069424','10');");
E_D("replace into `go_weixin_sign` values('21','423','1','1452080207','10');");
E_D("replace into `go_weixin_sign` values('22','424','1','1452086413','10');");
E_D("replace into `go_weixin_sign` values('23','407','1','1452144612','10');");
E_D("replace into `go_weixin_sign` values('24','432','1','1452164670','10');");
E_D("replace into `go_weixin_sign` values('25','448','1','1452398658','10');");
E_D("replace into `go_weixin_sign` values('26','452','1','1452439702','10');");
E_D("replace into `go_weixin_sign` values('27','457','1','1452506988','10');");
E_D("replace into `go_weixin_sign` values('28','460','1','1452527286','10');");
E_D("replace into `go_weixin_sign` values('29','461','1','1452583914','10');");
E_D("replace into `go_weixin_sign` values('30','467','1','1452661138','10');");
E_D("replace into `go_weixin_sign` values('31','425','1','1452748186','10');");
E_D("replace into `go_weixin_sign` values('32','489','1','1452871106','10');");
E_D("replace into `go_weixin_sign` values('33','375','1','1452885341','10');");
E_D("replace into `go_weixin_sign` values('34','513','1','1453171969','10');");
E_D("replace into `go_weixin_sign` values('35','511','1','1453362680','10');");
E_D("replace into `go_weixin_sign` values('36','535','1','1453466713','10');");
E_D("replace into `go_weixin_sign` values('37','536','1','1453547324','10');");
E_D("replace into `go_weixin_sign` values('38','548','1','1453720442','10');");
E_D("replace into `go_weixin_sign` values('39','553','1','1453813077','10');");
E_D("replace into `go_weixin_sign` values('40','557','1','1453971917','10');");
E_D("replace into `go_weixin_sign` values('41','440','1','1454062708','10');");
E_D("replace into `go_weixin_sign` values('42','580','1','1454514008','10');");
E_D("replace into `go_weixin_sign` values('43','586','1','1454892865','10');");
E_D("replace into `go_weixin_sign` values('44','588','1','1455523299','10');");
E_D("replace into `go_weixin_sign` values('45','587','1','1455525298','10');");
E_D("replace into `go_weixin_sign` values('46','595','1','1455848940','10');");
E_D("replace into `go_weixin_sign` values('47','597','1','1455887427','10');");
E_D("replace into `go_weixin_sign` values('48','592','1','1455890851','10');");

require("../../inc/footer.php");
?>