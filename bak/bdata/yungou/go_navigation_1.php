<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_navigation`;");
E_C("CREATE TABLE `go_navigation` (
  `cid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `type` char(10) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` char(1) DEFAULT 'Y' COMMENT '显示/隐藏',
  `order` smallint(6) unsigned DEFAULT '1',
  PRIMARY KEY (`cid`),
  KEY `status` (`status`),
  KEY `order` (`order`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8");
E_D("replace into `go_navigation` values('1','0','所有商品','index','/goods_list','Y','5');");
E_D("replace into `go_navigation` values('2','0','新手指南','foot','/single/newbie','Y','2');");
E_D("replace into `go_navigation` values('3','0','夺宝圈','foot','/group','Y','2');");
E_D("replace into `go_navigation` values('4','0','关于一元夺宝','foot','/help/1','Y','1');");
E_D("replace into `go_navigation` values('5','0','隐私声明','foot','/help/12','Y','1');");
E_D("replace into `go_navigation` values('6','0','合作专区','foot','/single/business','Y','1');");
E_D("replace into `go_navigation` values('7','0','友情链接','foot','/link','Y','1');");
E_D("replace into `go_navigation` values('8','0','联系我们','foot','/help/13','Y','1');");
E_D("replace into `go_navigation` values('10','0','晒单分享','index','/go/shaidan/','Y','1');");
E_D("replace into `go_navigation` values('13','0','邀请好友','index','/single/pleasereg','Y','1');");
E_D("replace into `go_navigation` values('14','0','限时揭晓','index','/go/autolottery','Y','3');");
E_D("replace into `go_navigation` values('15','0','幸运抽奖','index','/api/plugin/get/egglotter','Y','1');");
E_D("replace into `go_navigation` values('16','0','最新揭晓','index','/goods_lottery','Y','4');");
E_D("replace into `go_navigation` values('17','0','夺宝官方QQ群','foot','/group_qq','Y','2');");

require("../../inc/footer.php");
?>