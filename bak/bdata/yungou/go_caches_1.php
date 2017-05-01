<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_caches`;");
E_C("CREATE TABLE `go_caches` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8");
E_D("replace into `go_caches` values('1','member_name_key','admin,administrator,云购官方');");
E_D("replace into `go_caches` values('2','shopcodes_table','1');");
E_D("replace into `go_caches` values('3','goods_count_num','');");
E_D("replace into `go_caches` values('4','template_mobile_reg','尊敬的用户您好,你的注册验证码是:000000,请不要告诉任何人。');");
E_D("replace into `go_caches` values('5','template_mobile_shop','恭喜您成为商品获得者！请及时在个人中心填写收货地址并拔打服务热线，本次云购码：00000000');");
E_D("replace into `go_caches` values('6','template_email_reg','你好,请在24小时内激活注册邮件，点击连接激活邮件：{地址}');");
E_D("replace into `go_caches` values('7','template_email_shop','恭喜您：{用户名}，你在云购网够买的商品：{商品名称} 已中奖，中奖码是:{中奖码}');");
E_D("replace into `go_caches` values('8','pay_bank_type','yeepay');");

require("../../inc/footer.php");
?>