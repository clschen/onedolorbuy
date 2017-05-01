<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_wechat_config`;");
E_C("CREATE TABLE `go_wechat_config` (
  `id` int(1) NOT NULL,
  `token` varchar(100) NOT NULL,
  `appid` char(18) NOT NULL,
  `appsecret` char(32) NOT NULL,
  `access_token` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  `menu` text NOT NULL COMMENT '菜单',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");
E_D("replace into `go_wechat_config` values('1','weixin1234567','wx55d4f12057157683','ba306c683b09b0a337b0efb146a6d1ba','fRcf5ImgIFEy4rOIhMMZgVn9urvz9zrtm1wGmRUSkwijviIuZPJF-boMCuyZel4t5avgBFKKbMMDWn5XYSXwoLEfrvdxUO4zV5KGAgLWsZDq3CESKllIMQkLS68Cff8fXFWgAFADLC','0','{\"button\":[{\"name\":\"最新商品\",\"sub_button\":[{\"type\":\"click\",\"name\":\"新品上市\",\"key\":\"new\"},{\"type\":\"click\",\"name\":\"热门推荐\",\"key\":\"tuijian\"},{\"type\":\"click\",\"name\":\"人气商品\",\"key\":\"renqi\"},{\"type\":\"click\",\"name\":\"最新活动\",\"key\":\"xinban\"},{\"type\":\"click\",\"name\":\"快递查询\",\"key\":\"kdcx\"}]},{\"name\":\"会员中心\",\"sub_button\":[{\"type\":\"click\",\"name\":\"积分查询\",\"key\":\"jfcx\"},{\"type\":\"click\",\"name\":\"订单查询\",\"key\":\"ddcx\"},{\"type\":\"click\",\"name\":\"领红包\",\"key\":\"zj\"},{\"type\":\"click\",\"name\":\"会员中心\",\"key\":\"member\"},{\"type\":\"click\",\"name\":\"签到\",\"key\":\"qiandao\"}]},{\"name\":\"更多\",\"sub_button\":[{\"type\":\"view\",\"name\":\"首页\",\"url\":\"http://cziyuan.com/\"},{\"type\":\"click\",\"name\":\"系统介绍\",\"key\":\"hot7\"},{\"type\":\"view\",\"name\":\"去购买\",\"url\":\"http://cziyuan.com/\"},{\"type\":\"click\",\"name\":\"文本消息\",\"key\":\"text\"},{\"type\":\"click\",\"name\":\"使用说明\",\"key\":\"help\"}]}]}');");

require("../../inc/footer.php");
?>