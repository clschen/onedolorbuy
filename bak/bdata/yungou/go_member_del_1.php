<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_member_del`;");
E_C("CREATE TABLE `go_member_del` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL COMMENT '用户名',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '用户邮箱',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '用户手机',
  `password` char(32) DEFAULT NULL COMMENT '密码',
  `user_ip` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT 'photo/member.jpg' COMMENT '用户头像',
  `qianming` varchar(255) DEFAULT NULL COMMENT '用户签名',
  `groupid` tinyint(4) unsigned DEFAULT '1' COMMENT '用户权限组',
  `addgroup` varchar(255) DEFAULT NULL COMMENT '用户加入的圈子组1|2|3',
  `money` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '账户金额',
  `emailcode` char(21) DEFAULT '-1' COMMENT '邮箱认证码',
  `mobilecode` char(21) DEFAULT '-1' COMMENT '手机认证码',
  `othercode` tinyint(1) NOT NULL DEFAULT '0' COMMENT '其他认证方式 1为认证通过',
  `passcode` char(21) DEFAULT '-1' COMMENT '找会密码认证码-1,1,码',
  `reg_key` varchar(100) DEFAULT NULL COMMENT '注册参数',
  `score` int(10) unsigned NOT NULL DEFAULT '0',
  `jingyan` int(10) unsigned DEFAULT '0',
  `yaoqing` int(10) unsigned DEFAULT '0' COMMENT '邀请人数',
  `band` varchar(255) DEFAULT NULL,
  `time` int(10) DEFAULT NULL,
  `headimg` char(255) NOT NULL DEFAULT '' COMMENT '用户头像，快捷登陆时候的头像',
  `wxid` char(100) DEFAULT '' COMMENT '微信id',
  `typeid` int(10) unsigned DEFAULT '0' COMMENT '注册来源 0电脑端  1 手机端 2微信关注 3快捷登陆QQ 4 微信快捷',
  `auto_user` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员表'");

require("../../inc/footer.php");
?>