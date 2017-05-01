<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_config`;");
E_C("CREATE TABLE `go_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `value` mediumtext,
  `zhushi` text,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8");
E_D("replace into `go_config` values('1','web_name','一元云购-惊喜无限','网站名');");
E_D("replace into `go_config` values('2','web_key','云购|一元云购|云购系统|购物|一元购物','网站关键字');");
E_D("replace into `go_config` values('3','web_des','1元云购是一种全新的购物方式,是时尚、潮流的风向标,能满足个性、年轻消费者的购物需求,由深圳市一元云购网络科技有限公司注入巨资打造的新型购物网。\n','网站介绍');");
E_D("replace into `go_config` values('4','web_path','http://bbs.52jscn.com

','网站地址');");
E_D("replace into `go_config` values('5','templates_edit','1','是否允许在线编辑模板');");
E_D("replace into `go_config` values('6','templates_name','yungou','当前模板方案');");
E_D("replace into `go_config` values('7','charset','utf-8','网站字符集');");
E_D("replace into `go_config` values('8','timezone','Asia/Shanghai','网站时区');");
E_D("replace into `go_config` values('9','error','1','1、保存错误日志到 cache/error_log.php | 0、在页面直接显示');");
E_D("replace into `go_config` values('10','gzip','0','是否Gzip压缩后输出,服务器没有gzip请不要启用');");
E_D("replace into `go_config` values('11','lang','zh-cn','网站语言包');");
E_D("replace into `go_config` values('12','cache','3600','默认缓存时间');");
E_D("replace into `go_config` values('13','web_off','1','网站是否开启');");
E_D("replace into `go_config` values('14','web_off_text','网站关闭。升级中....','关闭原因');");
E_D("replace into `go_config` values('15','tablepre','QCNf',NULL);");
E_D("replace into `go_config` values('16','index_name','index.php','隐藏首页文件名');");
E_D("replace into `go_config` values('17','expstr','/','url分隔符号');");
E_D("replace into `go_config` values('18','admindir','admin','后台管理文件夹');");
E_D("replace into `go_config` values('19','qq','15584633','qq');");
E_D("replace into `go_config` values('20','cell','13003795520','联系电话');");
E_D("replace into `go_config` values('21','web_logo','banner/20160623/23760588666504.png','logo');");
E_D("replace into `go_config` values('22','web_copyright','Copyright (c) 2011 - 2015, 版权所有 粤ICP备09213115号-1','版权');");
E_D("replace into `go_config` values('23','web_name_two','一元云购','短网站名');");
E_D("replace into `go_config` values('24','qq_qun','','QQ群');");
E_D("replace into `go_config` values('25','goods_end_time','180','开奖动画秒数(单位秒)');");
E_D("replace into `go_config` values('26','xianshi','1','手机端限时揭晓是否显示');");
E_D("replace into `go_config` values('27','web_verify','1','验证码是否开启');");
E_D("replace into `go_config` values('28','sendmobile','1','发货微信提醒');");

require("../../inc/footer.php");
?>