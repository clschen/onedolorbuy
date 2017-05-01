<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_weixin_keywords`;");
E_C("CREATE TABLE `go_weixin_keywords` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '消息类型',
  `contents` text NOT NULL,
  `pic` varchar(80) NOT NULL,
  `pic_tit` varchar(80) NOT NULL,
  `desc` text NOT NULL,
  `pic_url` varchar(80) NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=utf8");
E_D("replace into `go_weixin_keywords` values('90','帮助','help','1','乐儿：亲，如果想买【商品信息】里没有。\n输入【XX】XX表示您想购买东西的关键字\n如果您更喜欢传统的网页购物，请点击&lt;a href=&quot;http://oo17.cn&quot;&gt;触屏版购物&lt;/a&gt;\n--------其他帮助-------\n输入【积分规则】查看积分获取规则','','','','','166','1');");
E_D("replace into `go_weixin_keywords` values('109','帮助中文','帮助','1','乐儿：亲，如果想买【商品信息】里没有。\n输入【XX】XX表示您想购买东西的关键字\n如果您更喜欢传统的网页购物，请点击&lt;a href=&quot;http://oo17.cn&quot;&gt;触屏版购物&lt;/a&gt;\n--------其他帮助-------\n输入【积分规则】查看积分获取规则','','','','','2','1');");
E_D("replace into `go_weixin_keywords` values('91','你好','签到','1','乐儿：您好，我是聚天地之灵气，集万物之精华……（此处略去3万字）【乐儿发官方唯一客服】乐儿，有什们可以帮您的吗？\r\n','','','','','14','1');");
E_D("replace into `go_weixin_keywords` values('105','文本消息测试','text','1','您现在看到的公众号平台是我们独立设计完成的接口，完美对接网站现在已有的系统，实现了在微信中的各种功能的完美对接，购买咨询请联系QQ：525292105','','','','','105','1');");
E_D("replace into `go_weixin_keywords` values('110','聊天回复','聊天','1','乐儿：亲，您是要跟我聊天吗？这不好吧？我爸比(程序猿)跟我说：\"我是我们公司的唯一的客服，每个人都需要我的帮助，没时间跟亲聊天的呢！偷偷告诉亲呦，爸比说，如果我聊多了会显得爸比IQ很低的样子哦。\" 嘻嘻！','','','','','2','1');");

require("../../inc/footer.php");
?>