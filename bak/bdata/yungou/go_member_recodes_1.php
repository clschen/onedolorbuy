<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_member_recodes`;");
E_C("CREATE TABLE `go_member_recodes` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(1) NOT NULL COMMENT '收取1//充值-2/提现-3',
  `content` varchar(255) NOT NULL COMMENT '详情',
  `shopid` int(11) DEFAULT NULL COMMENT '商品id',
  `money` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '佣金',
  `time` char(20) NOT NULL,
  `ygmoney` decimal(8,2) NOT NULL COMMENT '云购金额',
  `cashoutid` int(11) DEFAULT NULL COMMENT '申请提现记录表id',
  KEY `uid` (`uid`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员账户明细'");

require("../../inc/footer.php");
?>