<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_template`;");
E_C("CREATE TABLE `go_template` (
  `template_name` char(25) NOT NULL,
  `template` char(25) NOT NULL,
  `des` varchar(100) DEFAULT NULL,
  KEY `template` (`template`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");
E_D("replace into `go_template` values('cart.cartlist.html','yungou','购物车列表');");
E_D("replace into `go_template` values('cart.pay.html','yungou','购物车付款');");
E_D("replace into `go_template` values('cart.paysuccess.html','yungou','购物车支付成功页面');");
E_D("replace into `go_template` values('group.index.html','yungou','圈子首页');");
E_D("replace into `go_template` values('group.list.html','yungou','圈子列表页');");
E_D("replace into `go_template` values('group.nei.html','yungou','圈子内容');");
E_D("replace into `go_template` values('group.right.html','yungou','圈子右边');");
E_D("replace into `go_template` values('help.help.html','yungou','帮助页面');");
E_D("replace into `go_template` values('index.autolottery.html','yungou','限时揭晓');");
E_D("replace into `go_template` values('index.buyrecord.html','yungou','夺宝记录');");
E_D("replace into `go_template` values('index.buyrecordbai.html','yungou','最新夺宝记录');");
E_D("replace into `go_template` values('index.dataserver.html','yungou','已揭晓商品');");
E_D("replace into `go_template` values('index.detail.html','yungou','晒单详情');");
E_D("replace into `go_template` values('index.footer.html','yungou','底部');");
E_D("replace into `go_template` values('index.glist.html','yungou','所有商品');");
E_D("replace into `go_template` values('index.header.html','yungou','头部');");
E_D("replace into `go_template` values('index.index.html','yungou','首页');");
E_D("replace into `go_template` values('index.item.html','yungou','商品展示页');");
E_D("replace into `go_template` values('index.lottery.html','yungou','最新揭晓');");
E_D("replace into `go_template` values('index.shaidan.html','yungou','晒单页面');");
E_D("replace into `go_template` values('link.link.html','yungou','友情链接');");
E_D("replace into `go_template` values('member.address.html','yungou','会员地址添加');");
E_D("replace into `go_template` values('member.cashout.html','yungou','提现申请');");
E_D("replace into `go_template` values('member.commissions.html','yungou','佣金明细');");
E_D("replace into `go_template` values('member.index.html','yungou','会员首页');");
E_D("replace into `go_template` values('member.invitefriends.html','yungou','邀请好友');");
E_D("replace into `go_template` values('member.joingroup.html','yungou','加入的圈子');");
E_D("replace into `go_template` values('member.left.html','yungou','会员中心左边页面');");
E_D("replace into `go_template` values('member.mailchecking.html','yungou','邮箱认证');");
E_D("replace into `go_template` values('member.mobilechecking.htm','yungou','手机认证');");
E_D("replace into `go_template` values('member.mobilesuccess.html','yungou','手机认证成功');");
E_D("replace into `go_template` values('member.modify.html','yungou','会员');");
E_D("replace into `go_template` values('member.orderlist.html','yungou','会员资料');");
E_D("replace into `go_template` values('member.password.html','yungou','会员修改密码');");
E_D("replace into `go_template` values('member.photo.html','yungou','会员修改头像');");
E_D("replace into `go_template` values('member.qqclock.html','yungou','会员QQ绑定');");
E_D("replace into `go_template` values('member.record.html','yungou','提现记录');");
E_D("replace into `go_template` values('member.sendsuccess.html','yungou','邮箱验证发送');");
E_D("replace into `go_template` values('member.sendsuccess2.html','yungou','邮箱验证发送2');");
E_D("replace into `go_template` values('member.shezhi.html','yungou','资料选项卡');");
E_D("replace into `go_template` values('member.singleinsert.html','yungou','会员添加晒单');");
E_D("replace into `go_template` values('member.singlelist.html','yungou','会员晒单');");
E_D("replace into `go_template` values('member.singleupdate.html','yungou','晒单修改');");
E_D("replace into `go_template` values('member.topic.html','yungou','圈子话题');");
E_D("replace into `go_template` values('member.userbalance.html','yungou','账户明细');");
E_D("replace into `go_template` values('member.userbuydetail.html','yungou','夺宝记录');");
E_D("replace into `go_template` values('member.userbuylist.html','yungou','夺宝记录');");
E_D("replace into `go_template` values('member.userfufen.html','yungou','会员福分');");
E_D("replace into `go_template` values('member.userrecharge.html','yungou','账户充值');");
E_D("replace into `go_template` values('search.search.html','yungou','搜索');");
E_D("replace into `go_template` values('single_web.business.html','yungou','单页_合作专区');");
E_D("replace into `go_template` values('single_web.fund.html','yungou','单页_云购基金');");
E_D("replace into `go_template` values('single_web.newbie.html','yungou','单页_新手指南');");
E_D("replace into `go_template` values('single_web.pleasereg.html','yungou','单页_邀请');");
E_D("replace into `go_template` values('single_web.qqgroup.html','yungou','单页_QQ');");
E_D("replace into `go_template` values('system.message.html','yungou','系统消息提示');");
E_D("replace into `go_template` values('us.index.html','yungou','个人主页');");
E_D("replace into `go_template` values('us.left.html','yungou','个人主页左边');");
E_D("replace into `go_template` values('us.tab.html','yungou','个人主页选项');");
E_D("replace into `go_template` values('us.userbuy.html','yungou','个人主页夺宝记录');");
E_D("replace into `go_template` values('us.userpost.html','yungou','个人主页夺宝记录');");
E_D("replace into `go_template` values('us.userraffle.html','yungou','个人主页夺宝记录');");
E_D("replace into `go_template` values('user.emailcheck.html','yungou','邮箱验证');");
E_D("replace into `go_template` values('user.emailok.html','yungou','邮箱验证成功');");
E_D("replace into `go_template` values('user.findemailcheck.html','yungou','找回密码');");
E_D("replace into `go_template` values('user.finderror.html','yungou','邮箱验证已过期');");
E_D("replace into `go_template` values('user.findmobilecheck.html','yungou','手机验证');");
E_D("replace into `go_template` values('user.findok.html','yungou','手机验证成功');");
E_D("replace into `go_template` values('user.findpassword.html','yungou','重置密码');");
E_D("replace into `go_template` values('user.login.html','yungou','会员登录');");
E_D("replace into `go_template` values('user.mobilecheck.html','yungou','手机验证');");
E_D("replace into `go_template` values('user.register.html','yungou','会员注册');");
E_D("replace into `go_template` values('vote.show.html','yungou','投票内容页');");
E_D("replace into `go_template` values('vote.show_total.html','yungou','投票列表');");
E_D("replace into `go_template` values('vote.vote.html','yungou','投票主页');");
E_D("replace into `go_template` values('cart.payend.html','yungou','');");
E_D("replace into `go_template` values('index.header1.html','yungou','');");
E_D("replace into `go_template` values('index.item_animation.html','yungou','');");
E_D("replace into `go_template` values('index.item_contents.html','yungou','');");
E_D("replace into `go_template` values('index.itemifram.html','yungou','');");
E_D("replace into `go_template` values('index.itemiframstory.html','yungou','');");
E_D("replace into `go_template` values('index.qq.html','yungou','');");
E_D("replace into `go_template` values('index.shaidan123.html','yungou','');");
E_D("replace into `go_template` values('member.mobilechecking.htm','yungou','');");
E_D("replace into `go_template` values('mobile','yungou','');");

require("../../inc/footer.php");
?>