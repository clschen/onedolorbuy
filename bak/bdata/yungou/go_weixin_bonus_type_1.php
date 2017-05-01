<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_weixin_bonus_type`;");
E_C("CREATE TABLE `go_weixin_bonus_type` (
  `type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(60) NOT NULL DEFAULT '',
  `type_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `send_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `send_start_date` int(11) NOT NULL DEFAULT '0',
  `send_end_date` int(11) NOT NULL DEFAULT '0',
  `total` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '红包总数',
  `getnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '领取数量',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8");
E_D("replace into `go_weixin_bonus_type` values('10','微信关注红包','10.00','1','1442764800','1506614400','100','54');");
E_D("replace into `go_weixin_bonus_type` values('13','新用户送红包啦~','6.00','1','1442073600','1443456000','5','5');");

require("../../inc/footer.php");
?>