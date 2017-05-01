<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_card_recharge`;");
E_C("CREATE TABLE `go_card_recharge` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned DEFAULT NULL COMMENT '用户id',
  `money` int(10) unsigned DEFAULT NULL COMMENT '卡密金额',
  `code` varchar(21) DEFAULT NULL COMMENT '卡号',
  `codepwd` varchar(20) DEFAULT NULL COMMENT '卡号密码',
  `isrepeat` varchar(1) DEFAULT 'N' COMMENT '是否一次性',
  `rechargecount` int(10) DEFAULT '0' COMMENT '充值次数',
  `maxrechargecout` int(10) DEFAULT '0' COMMENT '多最可重复多少次',
  `rechargetime` int(10) DEFAULT NULL COMMENT '充值期限',
  `time` int(10) DEFAULT NULL COMMENT '充值时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=190 DEFAULT CHARSET=utf8 COMMENT='卡密表'");

require("../../inc/footer.php");
?>