-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- 主机: demo.52jscn.com:3306
-- 生成日期: 2016 年 08 月 08 日 16:18
-- 服务器版本: 5.1.28
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `ssc`
--

-- --------------------------------------------------------

--
-- 表的结构 `go_admin`
--

CREATE TABLE IF NOT EXISTS `go_admin` (
  `uid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `mid` tinyint(3) unsigned NOT NULL,
  `username` char(15) NOT NULL,
  `userpass` char(32) NOT NULL,
  `useremail` varchar(100) DEFAULT NULL,
  `addtime` int(10) unsigned DEFAULT NULL,
  `logintime` int(10) unsigned DEFAULT NULL,
  `loginip` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=8 ;

--
-- 导出表中的数据 `go_admin`
--

INSERT INTO `go_admin` (`uid`, `mid`, `username`, `userpass`, `useremail`, `addtime`, `logintime`, `loginip`) VALUES
(1, 0, 'admin', '7fef6171469e80d32c0559f88b377245', NULL, NULL, 1470666245, 'demo.52jscn.com');

-- --------------------------------------------------------

--
-- 表的结构 `go_ad_area`
--

CREATE TABLE IF NOT EXISTS `go_ad_area` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `width` smallint(6) unsigned DEFAULT NULL,
  `height` smallint(6) unsigned DEFAULT NULL,
  `des` varchar(255) DEFAULT NULL,
  `checked` tinyint(1) DEFAULT '0' COMMENT '1表示通过',
  PRIMARY KEY (`id`),
  KEY `checked` (`checked`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='广告位' AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `go_ad_area`
--

INSERT INTO `go_ad_area` (`id`, `title`, `width`, `height`, `des`, `checked`) VALUES
(3, '首页对联广告', 150, 300, '首页对联广告', 1);

-- --------------------------------------------------------

--
-- 表的结构 `go_ad_data`
--

CREATE TABLE IF NOT EXISTS `go_ad_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` char(10) DEFAULT NULL COMMENT 'code,text,img',
  `content` text,
  `checked` tinyint(1) DEFAULT '0' COMMENT '1表示通过',
  `addtime` int(10) unsigned NOT NULL,
  `endtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='广告' AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `go_ad_data`
--

INSERT INTO `go_ad_data` (`id`, `aid`, `title`, `type`, `content`, `checked`, `addtime`, `endtime`) VALUES
(5, 3, '测试', 'couplet', 'admanage/20160328/44911418097639.jpg,admanage/20160328/48076565097647.jpg', 0, 1459094400, 1522166400);

-- --------------------------------------------------------

--
-- 表的结构 `go_appoint`
--

CREATE TABLE IF NOT EXISTS `go_appoint` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shopid` int(10) unsigned NOT NULL COMMENT '商品期数id',
  `userid` int(10) unsigned NOT NULL COMMENT '中奖用户',
  `time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `status` int(10) unsigned NOT NULL COMMENT '订单状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `go_appoint`
--

INSERT INTO `go_appoint` (`id`, `shopid`, `userid`, `time`, `status`) VALUES
(1, 443, 786, 1458568528, 0),
(2, 418, 1741, 1458906016, 0);

-- --------------------------------------------------------

--
-- 表的结构 `go_article`
--

CREATE TABLE IF NOT EXISTS `go_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `cateid` char(30) NOT NULL COMMENT '文章父ID',
  `author` char(20) DEFAULT NULL,
  `title` char(100) NOT NULL COMMENT '标题',
  `title_style` varchar(100) DEFAULT NULL,
  `thumb` char(255) DEFAULT NULL,
  `picarr` text,
  `keywords` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` mediumtext COMMENT '内容',
  `hit` int(10) unsigned DEFAULT '0',
  `order` tinyint(3) unsigned DEFAULT NULL,
  `posttime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `cateid` (`cateid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 导出表中的数据 `go_article`
--

INSERT INTO `go_article` (`id`, `cateid`, `author`, `title`, `title_style`, `thumb`, `picarr`, `keywords`, `description`, `content`, `hit`, `order`, `posttime`) VALUES
(1, '2', 'author', '了解云购', '', '', 'a:2:{i:0;s:33:"photo/20130902/41484375056924.jpg";i:1;s:33:"photo/20130902/26578125056924.jpg";}', '了解一元云购|一元云购|云购|云购介绍|', '1元购买是一种新型的网购模式，只需1元就有可能买到一件商品。1元购买网把一件商品平分成若干“等份”出售，每份1元，当一件商品所有“等份”售出后抽出一名幸运者，该幸运者即可获得此商品。', '<p>	</p><p class="textindent" style="margin-top: 0px; margin-bottom: 0px; padding: 0px; text-indent: 2em; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; ">1元购买是一种新型的网购模式，只需1元就有可能买到一件商品。1元购买网把一件商品平分成若干“等份”出售，每份1元，当一件商品所有“等份”售出后抽出一名幸运者，该幸运者即可获得此商品。</p><h3 style="margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; ">规则：</h3><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; ">&nbsp;</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; ">1、每件商品参考市场价平分成相应“等份”，每份1元，1份对应1个购买码。</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; ">&nbsp;</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; ">2、同一件商品可以购买多次或一次购买多份。</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; ">&nbsp;</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; ">3、当一件商品所有“等份”全部售出后计算出“幸运云购码”，拥有“幸运购买码”者即可获得此商品。</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; ">&nbsp;</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; ">4、幸运云购码计算方式：</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; ">&nbsp;</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px 0px 0px 36px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; text-indent: -1em; ">1）取该商品最后购买时间前网站所有商品100条购买时间记录（限时揭晓商品取截止时间前网站所有商品100条购买时间记录）。</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; ">&nbsp;</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; text-indent: 1.6em; ">2）时间按时、分、秒、毫秒依次排列组成一组数值。</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; height: 10px; ">&nbsp;</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; text-indent: 1.6em; ">3）将这100组数值之和除以商品总需参与人次后取余数，余数加上10,000,001即为“幸运购买码”。</p><h3 style="margin: 30px 0px 0px; padding: 0px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; ">流程：</h3><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; "><strong style="margin: 0px; padding: 0px; ">1、挑选商品</strong></p><p style="margin-bottom: 15px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; ">分类浏览或直接搜索商品，点击“立即1元购买”。</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; "><strong style="margin: 0px; padding: 0px; ">2、支付1元</strong></p><p style="margin-bottom: 10px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; ">通过在线支付平台，支付1元即购买1人次，获得1个“购买码”。同一件商品可购买多次或一次购买多份，购买的“购买码”越多，获得商品的几率越大。</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; "><strong style="margin: 0px; padding: 0px; ">3、揭晓获得者</strong></p><p style="margin-bottom: 15px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; ">当一件商品达到总参与人次，抽出1名商品获得者，1元云购网会通过手机短信或邮件通知您领取商品。</p><h3 style="margin: 0px; padding: 0px 0px 0px 22px; font-size: 14px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; line-height: 30px; white-space: normal; ">注：</h3><p style="margin-bottom: 10px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; text-indent: 1.6em; ">1）商品揭晓后您可登录&quot;我的1元购买&quot;查询详情，未获得商品的用户不会收到短信或邮件通知；</p><p style="margin-bottom: 10px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; text-indent: 1.6em; ">2）商品揭晓后，请及时登录&quot;我的1元购买&quot;完善个人资料，以便我们能够准确无误地为您配送商品。</p><p style="margin-bottom: 10px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; text-indent: 1.6em; ">3）所有已揭晓商品均不给予退款</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; "><strong style="margin: 0px; padding: 0px; ">4、晒单分享</strong><br style="margin: 0px; padding: 0px; "/></p><p style="margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; ">晒出您收到的商品实物图片甚至您的靓照，说出您的云购心得，让大家一起分享您的快乐。</p><p style="margin-top: 0px; margin-bottom: 0px; padding: 0px; color: rgb(102, 102, 102); font-family: Tahoma, Arial, 宋体, Helvetica, sans-serif; font-size: 14px; line-height: 30px; white-space: normal; ">在您收到商品后，您只需登录网站完成晒单，并通过审核，即可获得1000福分奖励。在您成功晒单后，您的晒单会出现在网站&quot;晒单分享&quot;区，与大家分享喜悦。</p><p><br/></p>', 1, 1, 1375862513),
(2, '2', 'author', '常见问题', '', '', 'a:0:{}', '', '', '<p>	</p><p>567567234234</p>', 0, 3, 1375862591),
(3, '2', 'author', '服务协议', '', '', 'a:0:{}', '', '', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;	9 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 56 &nbsp; 56</p>', 0, 0, 1375862644),
(4, '3', 'author', '购保障体系', '', '', 'a:0:{}', '', '', '<p>	</p><p>欢迎使用云购系统!56456</p>', 0, 0, 1375862690),
(5, '3', 'author', '正品保障', NULL, NULL, 'a:0:{}', NULL, NULL, '', 0, 0, 1375862702),
(6, '3', 'author', '安全支付', NULL, NULL, 'a:0:{}', NULL, NULL, '', 0, 0, 1375862712),
(7, '4', 'author', '商品配送', NULL, NULL, 'a:0:{}', NULL, NULL, '', 0, 0, 1375862725),
(8, '4', 'author', '配送费用', NULL, NULL, 'a:0:{}', NULL, NULL, '', 0, 0, 1375862737),
(9, '4', 'author', '商品验货与签收', NULL, NULL, 'a:0:{}', NULL, NULL, '', 0, 0, 1375862747),
(10, '4', 'author', '长时间未收到商品', NULL, '', 'a:0:{}', NULL, NULL, '', 0, 0, 1375862760),
(12, '3', 'author', '隐私声明', '', '', 'a:0:{}', '', '', '<p>	</p><p>	</p><h1 style=" text-decoration: underline;">隐私声明</h1><p><br/>友邦保险控股有限公司及/或其附属公司（以下分别及统称为“友邦保险”）其中一项最重要的资产，就是客户对友邦保险能适当处理其信息的信赖和信任。客户及\n潜在客户期望我们准确维护其信息，保护信息免遭篡改和错误使用，失窃以及无未经客户授权泄露信息之虞。我们遵行适用的隐私相关法律和规章制度，以期为客户\n及潜在客户的个人资料提供安全保障，并确保员工遵守严格的安全及保密标准。</p><p><br/>本声明旨在您告知您我公司收集您个人资料的原因、资料可能的用途、可能获得您个人资料的第三方，有关您查阅、检查及修订您个人资料的方法，以及我们直接销\n售及使用Cookies（网络跟踪器）的政策。使用本网站即表示您接受本隐私声明中的惯例做法及政策。若您反对本声明中的任何惯例做法及政策，请不要使用\n本网站将个人资料提交给友邦保险。</p><p><br/>本网站仅提供一般资料。虽然我们已尽合理努力，确保本网站的资料准确，友邦保险概不保证资料绝对准确，亦概不为资料不准确或因任何错漏所产生的任何损失或损害而承担任何责任。如未得到友邦保险事前准许，不得复制（作为个人用途例外）或转发本网站所载的任何资料。</p><p><br/>友邦保险承认其负有有关收集、持有、处理或使用私人数据的责任。您提供个人资料，纯属自愿性质。您可选择不向我们提供所需的个人资料，但这样做会影响到我\n们为您提供服务的能力。友邦保险不会通过本网站收集任何可识别您身份的资料，除非直至您购买我们的产品或服务，登记成为客户或基于申请职位而提供个人资料\n起为始。</p><p><br/>若您处于限制我们分发资料或使用有关社交媒体平台的司法管辖区内，则不应使用本网站及我们的社交媒体平台。若此规定适用于您，我们建议您自行了解及遵从有关限制，友邦保险概不因此而承担任何责任。</p><h1><br/>收集资料的方法</h1><p><br/>我们将会收集及储存您在本网站输入的资料，或通过其他渠道向我们提供的资料。我们亦会从附属公司、商业伙伴及其他独立第三方资料来源，获取与您有关并合法收集的个人或非个人资料。在您到访本网站时，我们亦收集与您所用电脑或其他装置有关的某些资料。</p><p><br/>若您在本网站，我们所提供的应用程序或另行通过社交媒体供应商使用任何社交媒体功能或平台，我们可能通过有关社交媒体供应商，按照其有关政策查阅及收集与\n您有关的资料。在使用社交媒体功能时，我们可能会查阅及收集您于您的社交媒体个人账户选择提供并列入在内的资料，有关资料包括（但不限于）您的姓名、性\n别、出生日期、电邮地址、地址、地点等。您在有关社交媒体供应商所作的隐私设定，可限制或阻止我们对有关资料的查阅。</p><h1><br/>收集您个人资料的原因及可能用途</h1><p><br/>收集个人资料可作以下用途：</p><ul class=" list-paddingleft-2"><li><p>处理、实施、执行和实行在本网站上所提供的表格中或您可能不时交予我们的任何其他文件项下的要求或交易；</p></li><li><p>设计全新或加强目前我们所提供的产品及服务；</p></li><li><p>与您保持联繫，包括向您寄发有关您在我们公司任何账户或本隐私声明日后变动的通讯；</p></li><li><p>供友邦保险、金融服务业或我们的相关监管机构的统计或精算研究之用；</p></li><li><p>供我们作资料匹配，内部业务及管理之用；</p></li><li><p>协助执行法例、警方或其他政府或监管机构调查，以及遵守适用法律及规例所施行的规定，或其他向政府或监管机构承诺之义务；</p></li><li><p>将我们网站的外观个人化，提供相关产品的建议，以及在本网站或通过其他渠道进行目标广告活动；</p></li><li><p>在收集之时所通知的其他用途；及</p></li><li><p>与上述任何项目直接有关的其他用途。</p></li></ul><p><br/>若您提供个人资料予我们，即表示您接受，友邦保险将可因所需期限留存资料以履行有关用途，而就该等用途而言，有关资料乃在遵守适用相关法律及规定的情况下\n收集。友邦保险采用合理的保障措施，包括限制亲身查阅友邦保险系统内的数据及在转移敏感数据时进行加密处理，以防止未经许可或意外的查阅、处理、删除、丢\n失或使用情况。若不再需要用作上述任何用途，将会采取合理步骤删除或销毁有关资料。</p><p><br/>有关我们使用您个人资料作宣传或市场推广用途的政策，请参阅「使用个人资料作直接促销用途」一节。</p><h1><br/>谁会取得您的个人资料？</h1><p><br/>个人资料将保密处理，仅在法律许可且就符合收集个人资料用途或直接相关用途而披露是必须时，方可向以下各方提供相关个人资料（有关我们分发您个人资料作宣传或市场推广用途的政策，请参阅「使用个人资料作直接促销用途」一节。）：</p><ul class=" list-paddingleft-2"><li><p>获授权担任友邦保险代理且与分销友邦保险所提供之产品及服务有关的任何人士；</p></li><li><p>就友邦保险营运以及友邦保险向您提供服务相关而提供管理、数据处理、电讯、电脑、付款、收债或证券结算、技术外判、电话中心服务、邮寄及印刷服务的任何代理、承包商或第三方服务供应商（无论在友邦保险内或外）；</p></li><li><p>与提供或促销保险服务有关的友邦保险任何成员公司；</p></li><li><p>任何代理、承包商或第三方服务供应商（无论在友邦保险内或外），包括协助提供服务的公司，例如再保险公司、投资管理公司、索赔调查公司、业界协会或联盟；</p></li><li><p>协助收集您资料或与您联系的其他公司，例如研究调查公司及信贷评级机构，藉以加强我们向您所提供的服务；及</p></li><li><p>政府或监管机构或友邦保险公司：(a)根据在该司法管辖区适用于该友邦保险公司的法律及监管义务而必须对其披露的任何人士；或(b)依据该友邦保险公司与相关政府、监管机构或其他人士协议必须对其披露的任何人士。</p></li></ul><p><br/>就我们因在提供保险服务而收集的个人资料，该等个人资料将只会提供予上述人士作提供相关保险服务的用途。</p><p><br/>我们可不时购买业务或出售我们一项或多项业务（或其部分），而在法律许可的情况下，您的个人资料可作为该买卖或建议买卖的一部分予以转让或披露。若我们购买一项业务，就该业务所获得的个人资料将在其可行及允许的情况下根据本隐私声明处理。</p><p><br/><strong>若法律法规许可，可将您的个人资料提供予上述任何一方，有关各方可位于中国大陆境内或境外。</strong>您的资料，将可转移往中国\n大陆或任何友邦保险公司所在的司法管辖区，或第三方承包商所在的司法管辖区或第三方承包商于该处为我们提供服务的司法管辖区，并在中国大陆或有关司法管辖\n区储存及处理。若您向我们提供个人资料，或使用我们的服务或本网站或应用程式，即表示您同意将有关资料从您的司法管辖区转移至我们在其之外的设施，或如上\n文所载转移至我们与其分享有关资料的第三方。</p><h1><br/>查阅个人资料的权利</h1><p><br/>您有权：</p><ul class=" list-paddingleft-2"><li><p>核实友邦保险是否持有您的个人资料，并查阅任何该等资料；</p></li><li><p>要求友邦保险更正任何有关您的错误个人资料；及</p></li><li><p>就友邦保险有关个人资料的政策及惯例作出查询。</p></li></ul><p><br/>如欲查阅、更正您个人资料或有相关的其他要求，可致函至以下地址：</p><p>信息安全负责人<br/>上海市黄浦区中山东一路17号<br/>友邦保险中国区合规部</p><p><br/>友邦保险有权就因处理任何查阅个人资料的要求收取需要和直接相关的费用。</p><h1><br/>使用个人资料作直接销售用途</h1><p><br/>除上述用途外，在法律许可的情况下，友邦保险可使用您的姓名和联络资料作宣传或市场推广用途，包括向您寄发宣传资料及就以下产品、服务、建议、目的作直接\n销售及后续的保险服务然而，就友邦保险因在提供保险服务而收集的个人资料，该等个人资料将只会用作宣传或推广直接与保险相关的产品或服务。</p><p><br/>鉴于直接促销的用途，在法律许可的情况下，除因友邦保险在提供保险服务所收集的个人资料外，我们或会将您的个人资料提供予任何上述描述的促销标的类别、电\n话中心、市场推广或研究服务的提供商（无论在友邦保险内或外），从而他们可就其所提供的产品及服务向您寄发宣传资料及进行直接促销，有关资料可透过邮寄、\n电邮或其他方式送达予您。在法律许可的情况下，我们或会将您的个人资料提供予任何以上描述的促销标的类别的提供商（无论在友邦保险内或外）而得益。</p><p><br/>就本节用途使用或向本部分受让方提供您的个人资料前，我们可能受法律所规定要取得您的书面同意，且在该等情况下，仅会在取得有关书面同意后方就任何宣传或市场推广用途使用或提供您的个人资料。</p><p><br/>友邦保险会使用及提供作上述直接促销用途的个人资料为您的姓名和相关联络资料；然而，我们可管有更多的个人资料。</p><p><br/>如要求您同意，而您给予该等同意，您可于其后撤回对友邦保险使用并向第三者提供您的个人资料作直接促销用途的同意；此后，友邦保险须停止使用或提供该等资料作直接促销之用。</p><p><br/>如您已给予同意但又欲将其撤回，请以书面或电邮方式通知我们，书面通知可邮寄至「查阅个人资料的权利」一节所载地址，而电邮可发送至privacy.compliance@aia.com。任何有关请求应清楚列明该要求相关的个人资料详情。</p><h1><br/>使用Cookies</h1><p><br/>Cookies乃网络伺服器放置在您的电脑或其他装置的独一无二标识符，其载有资料，可在其后由向您发Cookies的伺服器解读。友邦保险亦可在其维持\n的网站使用Cookies。所收集的资料（包括（但不限于）您的IP位址（及网域名称）、浏览器软件、浏览器的类别及配置，语言设定、地理位置、作业系\n统、转介网站、所浏览网页及内容及到访期间）将用作编製访客怎样到达及浏览我们网站的总体统计数字，协助我们瞭解如何改善您到访我们网站的体验。有关资料\n将会以不具名方式收集，并不能识别您的身份，除非您以会员身份登入，则作别论。我们只会使用有关资料作增进及优化网站。Cookies亦让我们的网站就您\n及您的喜好留下记录，让我们可按您的需要，为您度身设定网站。广告Cookies亦可让我们的网站提供与您尽可能有关的广告，如为您甄选以兴趣为主的广\n告，或阻止不断向您展现同一广告等。</p><p><br/>大部份网页浏览器在最初已设定为可接受Cookies。若您不愿接收Cookies，可在您的浏览器设定中关闭有关功能。然而，如关闭功能，您将不能尽享我们网站的优点，而若干功能可能不可以正常运作。</p><h1><br/>外部链接</h1><p><br/>若本网站任何部分载有连接其他网站的链接，有关网站可能并非根据本隐私声明运作隐私，藉以瞭解其收集、使用、转移及披露个人资料的政策。</p><h1><br/>本隐私声明的修订</h1><p><br/>友邦保险保留权利可随时且在无须通知的情况下仅凭知会您有关修改、更新或修订，而增添、修改、更新或修订本隐私声明。倘我们决定修改我们的个人资料政策，\n我们将于我们的网站知会您有关修改，从而让您能得悉我们所收集的资料、我们如何使用该资料及在何种情况下会披露该资料。任何有关修改、更新或修订将在刊登\n后即时生效。</p><h1><br/>其他资料</h1><p><br/>如您对本隐私声明的任何部分有任何疑问或如欲知悉有关友邦保险的资料保密惯例的更多资料，请随时通过上述联络途径与我们联络。</p><p>&nbsp;</p><h1 style=" text-decoration: underline;">PRIVACY STATEMENT</h1><p><br/>Among the most important assets of AIA Group Limited and/or its\nsubsidiaries (individually and collectively referred to herein as “AIA”) is the trust and confidence placed to properly handle information.\nCustomers and potential customers expect us to maintain their\ninformation accurately, protected against manipulation and errors,\nsecure from theft and free from unwarranted disclosure. We protect the\ndata security of our customers and potential customers by complying with the Personal Data (Privacy) Ordinance, and all relevant local laws, and ensure compliance by our staff with strict standards of security and\nconfidentiality.</p><p><br/>This statement provides you with notice as to why your personal data is\ncollected, how it is intended to be used, to whom your personal data may be transferred to, how to access, review and amend your personal data,\nand our policies on direct marketing and the use of cookies. By using\nthis website, you are accepting the practices and policies in this\nprivacy statement. If you object to any practices and policies in this\nstatement, please do not use this website to submit your personal\ninformation to AIA.</p><p><br/>This website is for general information purpose only. While we use\nreasonable efforts to ensure the accuracy of the information on this\nwebsite, AIA does not warrant its absolute accuracy or accept any\nliability for any loss or damage resulting from any inaccuracy or\nomission. Without prior permission from AIA, no information contained on this website may be copied, except for personal use, or redistributed.</p><p><br/>AIA recognises its responsibilities in relation to the collection,\nholding, processing or use of personal data. The provision of your\npersonal data is voluntary. You may choose not to provide us with the\nrequested data, but failure to do so may inhibit our ability to do\nbusiness with or provide services to you. AIA will not collect any\ninformation that identifies you personally through this website unless\nand until you buy our products or services, register as a member, or\nsubmit personal information for job application purposes.</p><p><br/>This website, and our social media platforms are not intended for\npersons in jurisdictions that restrict the distribution of information\nby us or use of such social media platforms. If this is applicable to\nyou, we would advise you to inform yourself about and observe the\nrelevant restrictions, and AIA does not accept liability in this\nrespect.</p><h1><br/>How we collect data.</h1><p><br/>We will collect and store any information you enter on our website, or\nprovide to us through any other channel. We may also obtain lawfully\ncollected personal or non-personal information about you from affiliated entities, business partners and other independent third parties\nsources. We may also collect some information about your computer or\nother devices used when you visit this website.</p><p><br/>If you make use of any social media features or platforms, either on our website, an application we provide, or otherwise through a social media provider, we may access and collect information about you via that\nsocial media provider in accordance with their policies. When using a\nsocial media feature, we may access and collect information you have\nchosen to make available and to include in your social media profile or\naccount, including but not limited to your name, gender, birthday, email address, address, location etc. Our access to this information may be\nlimited or blocked based on your privacy settings with the relevant\nsocial media provider.</p><h1><br/>Why we collect your personal data and how it may be used?</h1><p><br/>Personal data is collected for the following purposes:</p><ul class=" list-paddingleft-2"><li><p>to process, administer, implement and effect the requests or\ntransactions contemplated by the forms available on our website or any\nother documents you may submit to us from time to time;</p></li><li><p>to design new or enhance existing products and services provided by us;</p></li><li><p>to communicate with you including to send you administrative\ncommunications about any account you may have with us or about future\nchanges to this privacy statement;</p></li><li><p>for statistical or actuarial research undertaken by AIA, the financial services industry or our respective regulators;</p></li><li><p>for data matching, internal business and administrative purposes;</p></li><li><p>to assist in law enforcement purposes, investigations by police or\nother government or regulatory authorities and to meet requirements\nimposed by applicable laws and regulations or other obligations\ncommitted to government or regulatory authorities;</p></li><li><p>to personalise the appearance of our websites, provide\nrecommendations of relevant products and provide targeted advertising on our website or through other channels;</p></li><li><p>other purposes as notified at the time of collection;and</p></li><li><p>other purposes directly relating to any of the above.</p></li></ul><p><br/>By providing your personal information to us, you accept that AIA may\nretain your information for as long as necessary, to fulfill the\npurpose(s) for which it is collected in compliance with applicable laws\nand regulations. AIA applies reasonable security measures to prevent\nunauthorised or accidental access, processing, erasure, loss or use\nincluding limiting physical access to data within AIA’s systems and\nencryption of sensitive data when transferring such data. Reasonable\nsteps will be taken to delete or destroy the information when it is no\nlonger necessary for any of the purpose above.</p><p><br/>For our policy on use of your personal data for promotional or marketing purposes, please see the section entitled “Use of Personal Data for\nDirect Marketing Purposes”.</p><h1><br/>Who may be provided with your personal data?</h1><p><br/>Personal data will be kept confidential but may, where permitted by law\nand where such disclosure is necessary to satisfy the purpose or a\ndirectly related purpose for which the personal data was collected,\nprovide such personal data to the following parties (for our policy on\nsharing of your personal data for promotional and marketing purposes,\nplease see the section entitled “Use of Personal Data for Direct\nMarketing Purposes”):</p><ul class=" list-paddingleft-2"><li><p>any person authorised to act as an agent of AIA in relation to the distribution of products and services offered by AIA;</p></li><li><p>any agent, contractor or third party service provider (within or\noutside AIA) who provides administration, data processing,\ntelecommunications, computer, payment, debt collection or securities\nclearing, technology outsourcing, call centre services, mailing and\nprinting services in connection with the operation of AIA’s business and AIA’s provision of services to you;</p></li><li><p>any member company of AIA in relation to the provision or marketing of insurance services;</p></li><li><p>any agent, contractor or third party service provider (within or\noutside AIA) including companies that help deliver our services, such as reinsurance companies, investment management companies, claims\ninvestigation companies, industry associations or federations;</p></li><li><p>other companies that help gather your information or communicate\nwith you, such as research companies and ratings agencies, in order to\nenhance the services we provide to you;and</p></li><li><p>government or regulatory bodies or any person to whom an AIA company must disclose data: (a) under a legal and/or regulatory obligation in\nthat jurisdiction applicable to that particular AIA company; or (b)\npursuant to an agreement between the AIA company and the relevant\ngovernment, regulatory body or other person.</p></li></ul><p><br/>In relation to any personal data collected by us whilst providing any\nservices in respect of our insurance plans, such personal data would\nonly be transferred to the above parties for the purpose of providing\nany insurance related services.</p><p><br/>From time to time, we may purchase a business or sell one or more of our businesses (or portions thereof) and where permitted by law your\npersonal data may be transferred or disclosed as a part of the purchase\nor sale or a proposed purchase or sale. In the event that we purchase a\nbusiness, the personal data received with that business would be treated in accordance with this privacy statement, if it is practicable and\npermissible to do so.</p><p><br/><strong>Where permitted by law, your personal data may be provided to\nany of the above parties who may be located in The mainland of China or\noutside of The mainland of China.</strong>Your information may be\ntransferred to, stored, and processed in The mainland of China or any\nother jurisdictions where any AIA company is located, or jurisdictions\nwhere a third party contractor is located or from which the third party\ncontractor provides us services. By providing us with your personal\ninformation or using our services or our website or applications, you\nconsent to the transfer of such information outside your jurisdiction to our facilities or to those third parties with whom we share it as\ndescribed above.</p><h1><br/>Access Rights to Personal Data</h1><p><br/>You have the right to:</p><ul class=" list-paddingleft-2"><li><p>verify whether AIA holds any personal data about you and to access any such data;</p></li><li><p>require AIA to correct any personal data relating to you which is inaccurate;and</p></li><li><p>enquire about AIA’s policies and practices in relation to personal data.</p></li></ul><p><br/>Requests for access, correction or other queries relating to your personal data should be addressed to:</p><p>The Data Protection Officer</p><p>AIA CHO Compliance<br/>No.17 Zhongshan Dong Yi Road<br/>Shanghai<br/>China</p><p>AIA has the right to charge costs which are directly related to and\nnecessary for the processing of any personal data access request.</p><h1><br/>Use of Personal Data for Direct Marketing purposes</h1><p><br/>In addition to the purposes set out above, where permitted by law, AIA\nmay use your name and contact details for promotional or marketing\npurposes including sending you promotional materials and conducting\ndirect marketing in relation to the insurance products, services, advice and subjects. However, in relation to any personal data collected by\nAIA whilst providing any services in respect of our insurance plans,\nsuch personal data would only be used for promoting or marketing any\nproducts or services that are directly related to our insurance plans.</p><p><br/>For the purposes of direct marketing, we may, where permitted by law,\nprovide your personal information (with the exception of any personal\ndata collected by AIA whilst providing any services in respect of our\nmandatory provident fund master trust schemes) to providers (whether\nwithin or outside of AIA) of any of the Classes of Marketing Subjects\ndescribed above and call centre, marketing or research services so that\nthey can send you promotional materials and conduct direct marketing in\nrelation to the products and services they offer (these materials may be sent to you by postal mail, email or other means). Where permitted by\nlaw, we may provide your personal data to providers (whether within or\noutside of AIA) of any of the Classes of Marketing Subjects for gain.</p><p><br/>Before using or providing your personal data for the purposes and to the transferees set out in this section, we may be required by law to\nobtain your written consent, and in such cases, only after having\nobtained such written consent, may we use and provide your personal data for any promotional or marketing purpose.</p><p><br/>The types of personal data that AIA would use and provide for direct\nmarketing purposes as described above are your name and relevant contact details, although we may possess additional personal data.</p><p><br/>If your consent is required, and you provide such consent, you may\nthereafter withdraw your consent to the use and provision to a third\nparty by AIA of your personal data for direct marketing purposes and\nthereafter AIA shall cease to use or provide such data for direct\nmarketing purposes.</p><p><br/>If you have provided consent and wish to withdraw it, please inform us\nby writing to the address in the section on “Access Rights to Personal\nData” or sending us an email to privacy.compliance@aia.com. Any such\nrequest should clearly state details of the personal data in respect of\nwhich the request is being made.</p><h1><br/>Use of Cookies</h1><p><br/>Cookies are unique identifiers placed on your computer or other device\nby a web server, which contains information that can later be read by\nthe server that issued the cookie to you. AIA may use cookies on various websites we maintain. The information collected (including but not\nlimited to: your IP addresses (and domain names), browser software,\ntypes and configurations of your browser, language settings,\ngeo-locations, operating systems, referring website, pages and content\nviewed, and durations of visit) will be used for compiling aggregate\nstatistics on how our visitors reach and browse our websites to help us\nunderstand how we can improve your experience on it. Such information is collected anonymously and you cannot be identified unless you have\nlogged on as a member. We use such data only for website enhancement and optimisation purposes. The cookies also enable our website to remember\nyou and your preferences, and tailor the website for your needs.\nAdvertising cookies will allow us to provide advertisements on our\nwebsites that are as relevant to you as possible, e.g. by selecting\ninterest-based advertisements for you, or preventing the same advisement from constantly reappearing to you.</p><p><br/>Most web browsers are initially set up to accept cookies. If you do not\nwant to receive cookies, you can disable this function in your browser\nsettings. However, by doing so you may not be able to fully enjoy the\nbenefits of our websites and certain features may not work properly.</p><h1><br/>External links</h1><p><br/>If any part of this website contains links to other websites, those\nsites may not operate under this privacy statement. You are advised to\ncheck the privacy statements on those websites to understand their\npolicies on the collection, usage, transferal and disclosure of personal data.</p><h1><br/>Amendments to this Privacy Statement</h1><p><br/>AIA reserves the right, at any time and without notice, to add to,\nchange, update or modify this privacy statement, simply by notifying you of such change, update or modification. If we decide to change our\npersonal data policy, those changes will be notified on our website so\nthat you are always aware of what information we collect, how we use the information and under what circumstances the information is disclosed.\nAny such change, update or modification will be effective immediately\nupon posting.</p><h1><br/>Additional Information</h1><p><br/>Should you have any questions on any part of this privacy statement or\nwould like additional information regarding AIA’s data privacy practices please do not hesitate to contact us by the contact details above.</p><p><br/></p>', 71, 1, 1378451819),
(13, '16', 'author', '基金的建立', '', '', 'a:0:{}', '基金的建立', '云购基金是YunGouCMS — 惊喜无线创始人发起成立的以公益事业为主要方向的爱心基金。云购基金本着“我为人人，人人为我”的社会责任，向需要帮助的困难人们提供爱心捐助。', '<p>云购基金是YunGouCMS — 惊喜无线创始人发起成立的以公益事业为主要方向的爱心基金。云购基金本着“我为人人，人人为我”的社会责任，向需要帮助的困难人们提供爱心捐助。</p>', 66, 1, 1440172419),
(14, '16', 'author', '基金的筹备办法', '', '', 'a:0:{}', '基金的筹备办法', '每位在YunGouCMS — 惊喜无线进行分享购物的朋友，您的每次参与都将是为我们的公益事业做出一份贡献。当您每参与1人次云购，将由1元云购出资为云购基金筹款0.01元，所筹款项将全部用于云购基金。', '<p>每位在YunGouCMS — 惊喜无线进行分享购物的朋友，您的每次参与都将是为我们的公益事业做出一份贡献。当您每参与1人次云购，将由1元云购出资为云购基金筹款0.01元，所筹款项将全部用于云购基金。</p>', 3, 1, 1440172459),
(15, '16', 'author', '基金的去向', '', '', 'a:0:{}', '基金的去向', '云购基金将会以第1种途径或第2种途径进行使用：\n1、YunGouCMS — 惊喜无线全体员工将组织向身边的公益事业进行捐赠与关怀活动。活动内容包括：资金、所需用品以及探望与协助等，每次捐赠与关怀活动结束后云购基金将公布活动详情以及基金详细使用报告。\n2、云购基金通过腾讯公益或壹基金等公益组织进行爱心捐赠。', '<p>云购基金将会以第1种途径或第2种途径进行使用：<br/>	1、YunGouCMS — 惊喜无线全体员工将组织向身边的公益事业进行捐赠与关怀活动。活动内容包括：资金、所需用品以及探望与协助等，每次捐赠与关怀活动结束后云购基金将公布活动详情以及基金详细使用报告。<br/>	2、云购基金通过腾讯公益或壹基金等公益组织进行爱心捐赠。</p>', 54, 1, 1440172564),
(17, '142', 'author', '关于世锦赛、大阅兵期间配送延迟公告', '', 'photo/20150920/66676293734257.jpg', 'a:4:{i:0;s:33:"photo/20150920/42197520734143.jpg";i:1;s:33:"photo/20150920/72957300734145.jpg";i:2;s:33:"photo/20150920/29439904734148.jpg";i:3;s:33:"photo/20150920/14400214734150.jpg";}', '关于世锦赛、大阅兵期间配送延迟公告', '', '<p>	</p><p><br/></p><p><br/></p><p><br/></p><p>亲爱的云友：<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n大家好！北京田径世锦赛及大阅兵活动将于8月22日至9月3日在京举办，为确保盛事的顺利进行，在此期间，华北部分区域会进行交通管制，部分快递将于8月\n20日暂停进京快件的收寄，如果您的订单出现延迟，请您耐心等待，我们会在快递恢复后的第一时间安排发货，给您带来的不便，敬请谅解！有疑问可直接致电\n400-850-8080，我们将竭诚为您解答！<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 田径世锦，激情赛场！北京阅兵，彰显自信！一起为祖国加油！<img src="http://skin.1yyg.com/Images/Emoticons/29.gif" alt=""/></p>', 81, 1, 1440172896),
(18, '142', 'author', '2015年1元云购端午放假通知', '', '', 'a:0:{}', '2015年1元云购端午放假通知', '亲爱的云友： 大家好！端午节终于来啦！根据国家法定节假日规定，1元云购2015年端午节放假安排如下： 6月20日（周六）至6月22日（周一）放假（共3天），6月23日（星期二）正常上班。 放假期间揭晓的商品，6月23日正式上班后第一时间安排发出，期间您若有疑问可直接致电400-850-8080，我们将竭诚为您解答。给您带来的不便，敬请谅解！ 亲爱的云友，五月五，是端阳，剥个粽子沾上糖，祝您节日愉快！ 1元云购 2015 年6月18日', '<p>亲爱的云友：<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;大家好！端午节终于来啦！<img src="http://skin.1yyg.com/Images/Emoticons/37.gif" alt=""/>根据国家法定节假日规定，1元云购2015年端午节放假安排如下：<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6月20日（周六）至6月22日（周一）放假（共3天），6月23日（星期二）正常上班。<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;放假期间揭晓的商品，6月23日正式上班后第一时间安排发出，期间您若有疑问可直接致电400-850-8080，我们将竭诚为您解答。给您带来的不便，敬请谅解！<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;亲爱的云友，五月五，是端阳，剥个粽子沾上糖，祝您节日愉快！<img src="http://skin.1yyg.com/Images/Emoticons/12.gif" alt=""/><br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1元云购<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2015\n年6月18日</p>', 65, 1, 1440172947),
(19, '142', 'author', '关于暴雨天气导致配送延迟公告', '', '', 'a:0:{}', '关于暴雨天气导致配送延迟公告', '亲爱的云友： 大家好！近期，由于大范围暴雨天气的影响，部分地区物流配送有所延迟，如果您在1元云购网获得的商品未能及时送达，请您耐心等待，我们会尽最大努力，尽快为您送达，有疑问也可致电400-850-8080，我们将竭诚为您解答！ 由此带来的不便，敬请谅解！ 感谢您一直以来的信任与支持，祝您好运！ 1元云购 2015年5月27日', '<p>亲爱的云友：<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;大家好！近期，由于大范围暴雨天气的影响，部分地区物流配送有所延迟，如果您在1元云购网获得的商品未能及时送达，请您耐心等待，我们会尽最大努力，尽快为您送达，有疑问也可致电400-850-8080，我们将竭诚为您解答！<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp; 由此带来的不便，敬请谅解！&nbsp;&nbsp;感谢您一直以来的信任与支持，祝您好运！<img src="http://skin.1yyg.com/Images/Emoticons/0.gif" alt=""/><br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1\n元云购<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2015年5月27日</p>', 74, 1, 1440173177),
(21, '146', '', '官方微信', '', '', 'a:0:{}', '', '', '<p style="text-align: center;"><img src="https://gqrcode.alicdn.com/img?type=cs&shop_id=103185355&seller_id=917336440&w=140&h=140&el=q&v=1" title="qrcode_for_gh_f4df33de90f2_430.jpg"/></p><p style="text-align: center;"><span style="color: rgb(255, 0, 0);"><strong><span style="font-size: 24px;">微信扫一扫即可关注我们哦！上微信送红包！</span></strong></span></p>', 93, 1, 1456038904);

-- --------------------------------------------------------

--
-- 表的结构 `go_brand`
--

CREATE TABLE IF NOT EXISTS `go_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cateid` int(10) unsigned DEFAULT NULL COMMENT '所属栏目ID',
  `status` char(1) DEFAULT 'Y' COMMENT '显示隐藏',
  `name` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `order` (`order`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='品牌表' AUTO_INCREMENT=51 ;

--
-- 导出表中的数据 `go_brand`
--

INSERT INTO `go_brand` (`id`, `cateid`, `status`, `name`, `order`) VALUES
(1, 5, 'Y', '联想', 16),
(2, 5, 'Y', '诺基亚', 1),
(3, 5, 'Y', '苹果', 1),
(4, 5, 'Y', '三星', 14),
(6, 5, 'Y', '小米', 1),
(7, 5, 'Y', 'oppo', 1),
(8, 5, 'Y', 'HTC', 15),
(10, 6, 'Y', '苹果', 1),
(11, 6, 'Y', '三星', 1),
(12, 6, 'Y', '台电', 13),
(13, 12, 'Y', '尼康', 3),
(14, 6, 'Y', '台电', 1),
(15, 13, 'Y', '尼康', 1),
(16, 5, 'Y', '诺基亚', 1),
(17, 6, 'Y', '苹果', 1),
(18, 6, 'Y', '小米', 1),
(19, 6, 'Y', 'oppo', 1),
(20, 6, 'Y', '海尔', 1),
(21, 6, 'Y', '美的', 1),
(22, 6, 'Y', '华为', 1),
(23, 6, 'Y', '魅族', 1),
(24, 6, 'Y', 'NOKIA', 1),
(25, 6, 'Y', 'VIVO', 1),
(26, 6, 'Y', 'HTC', 1),
(27, 6, 'Y', 'OPPO', 1),
(28, 6, 'Y', 'Lenovo', 1),
(29, 6, 'Y', 'Cannon', 1),
(30, 6, 'Y', 'NiKon', 1),
(31, 6, 'Y', 'Leica', 1),
(32, 6, 'Y', 'SONY', 1),
(33, 6, 'Y', 'FUJIFILM', 1),
(34, 6, 'Y', 'PENT', 1),
(35, 6, 'Y', 'AXPENTAX', 1),
(36, 6, 'Y', '信礼坊', 1),
(37, 6, 'Y', '绿岭', 1),
(38, 5, 'Y', '欧米茄', 1),
(39, 6, 'Y', '礼意久久', 1),
(40, 6, 'Y', '安致儿', 1),
(41, 6, 'Y', '尚艺礼', 1),
(42, 6, 'Y', '梦之草', 1),
(43, 6, 'Y', '浪莎', 1),
(44, 6, 'Y', '红豆', 1),
(45, 6, 'Y', '屋里香', 1),
(46, 6, 'Y', '可蓝', 1),
(47, 6, 'Y', '佳柯', 1),
(48, 6, 'Y', '悠享', 1),
(49, 6, 'Y', '茂霖', 1),
(50, 6, 'Y', '绿岭味', 1);

-- --------------------------------------------------------

--
-- 表的结构 `go_caches`
--

CREATE TABLE IF NOT EXISTS `go_caches` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 导出表中的数据 `go_caches`
--

INSERT INTO `go_caches` (`id`, `key`, `value`) VALUES
(1, 'member_name_key', 'admin,administrator,云购官方'),
(2, 'shopcodes_table', '1'),
(3, 'goods_count_num', ''),
(4, 'template_mobile_reg', '尊敬的用户您好,你的注册验证码是:000000,请不要告诉任何人。'),
(5, 'template_mobile_shop', '恭喜您成为商品获得者！请及时在个人中心填写收货地址并拔打服务热线，本次云购码：00000000'),
(6, 'template_email_reg', '你好,请在24小时内激活注册邮件，点击连接激活邮件：{地址}'),
(7, 'template_email_shop', '恭喜您：{用户名}，你在云购网够买的商品：{商品名称} 已中奖，中奖码是:{中奖码}'),
(8, 'pay_bank_type', 'yeepay');

-- --------------------------------------------------------

--
-- 表的结构 `go_card_pwd`
--

CREATE TABLE IF NOT EXISTS `go_card_pwd` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pwd` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pwd` (`pwd`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='卡密密码表' AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `go_card_pwd`
--

INSERT INTO `go_card_pwd` (`id`, `pwd`) VALUES
(2, '4297f44b13955235245b2497399d7a93');

-- --------------------------------------------------------

--
-- 表的结构 `go_card_recharge`
--

CREATE TABLE IF NOT EXISTS `go_card_recharge` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='卡密表' AUTO_INCREMENT=190 ;

--
-- 导出表中的数据 `go_card_recharge`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_category`
--

CREATE TABLE IF NOT EXISTS `go_category` (
  `cateid` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '栏目id',
  `parentid` smallint(6) DEFAULT NULL COMMENT '父ID',
  `channel` tinyint(4) NOT NULL DEFAULT '0',
  `model` tinyint(1) DEFAULT NULL COMMENT '栏目模型',
  `name` varchar(255) DEFAULT NULL COMMENT '栏目名称',
  `catdir` char(20) DEFAULT NULL COMMENT '英文名',
  `pic_url` char(200) NOT NULL DEFAULT '' COMMENT '分类图片url',
  `url` varchar(255) DEFAULT NULL,
  `info` text,
  `order` smallint(6) unsigned DEFAULT '1' COMMENT '排序',
  PRIMARY KEY (`cateid`),
  KEY `name` (`name`),
  KEY `order` (`order`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='栏目表' AUTO_INCREMENT=147 ;

--
-- 导出表中的数据 `go_category`
--

INSERT INTO `go_category` (`cateid`, `parentid`, `channel`, `model`, `name`, `catdir`, `pic_url`, `url`, `info`, `order`) VALUES
(1, 0, 0, 2, '帮助', 'help', '', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";N;s:7:"content";N;s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1),
(2, 1, 0, 2, '新手指南', 'xinshouzhinan', '', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";N;s:7:"content";N;s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1),
(3, 1, 0, 2, '云购保障', 'yunbaozhang', '', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:30:"司法所发射点发射得分";s:8:"template";N;s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1),
(4, 1, 0, 2, '商品配送', 'peisong', '', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";N;s:7:"content";N;s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1),
(5, 0, 0, 1, '女性时尚', 'nvxingshishang', 'cateimg/20150821/22411143158430.png', '', 'a:7:{s:5:"thumb";s:35:"cateimg/20150821/22411143158430.png";s:3:"des";s:24:"女性时尚钟表首饰";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:12:"钟表首饰";s:13:"meta_keywords";s:12:"钟表首饰";s:16:"meta_description";s:12:"钟表首饰";}', 2),
(6, 0, 0, 1, '饮食天地', 'yinshitiandi', 'cateimg/20150821/10514407158491.png', '', 'a:7:{s:5:"thumb";s:35:"cateimg/20150821/10514407158491.png";s:3:"des";s:12:"饮食天地";s:8:"template";N;s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 4),
(7, 0, 0, -1, '新手指南', 'newbie', '', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:22:"single_web.newbie.html";s:7:"content";s:16608:"PHA+e3djOnRlbXBsYXRlcyAmcXVvdDtpbmRleCZxdW90OywmcXVvdDtoZWFkZXImcXVvdDt9PC9wPjxwPiZsdDtsaW5rIHJlbD0mcXVvdDtzdHlsZXNoZWV0JnF1b3Q7IHR5cGU9JnF1b3Q7dGV4dC9jc3MmcXVvdDsgaHJlZj0mcXVvdDt7R19URU1QTEFURVNfU1RZTEV9L2Nzcy9uZXdiaWUuY3NzJnF1b3Q7LyZndDs8L3A+PHA+Jmx0O2RpdiBjbGFzcz0mcXVvdDtHdWlkZUNvbnRlbnQgY2xlYXJmaXgmcXVvdDsmZ3Q7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CTwvc3Bhbj4mbHQ7ZGl2IGNsYXNzPSZxdW90O0d1aWRlVyZxdW90OyZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4mbHQ7ZGl2IGNsYXNzPSZxdW90O0d1aWRlaGVhZCZxdW90OyZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQk8L3NwYW4+Jmx0O3AmZ3Q7Jmx0O2ltZyBzcmM9JnF1b3Q7e0dfVVBMT0FEX1BBVEh9L25ld2JpZS9HdWlkZV8xLmpwZyZxdW90OyBib3JkZXI9JnF1b3Q7MCZxdW90OyBhbHQ9JnF1b3Q7JnF1b3Q7Jmd0OyZsdDsvcCZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQk8L3NwYW4+Jmx0O3AmZ3Q7Jmx0O2ltZyBzcmM9JnF1b3Q7e0dfVVBMT0FEX1BBVEh9L25ld2JpZS9HdWlkZV8yLmpwZyZxdW90OyBib3JkZXI9JnF1b3Q7MCZxdW90OyBhbHQ9JnF1b3Q7JnF1b3Q7Jmd0OyZsdDsvcCZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4mbHQ7L2RpdiZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4mbHQ7ZGl2IGNsYXNzPSZxdW90O0d1aWRlYm9yIGNsZWFyZml4JnF1b3Q7Jmd0OzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCTwvc3Bhbj4mbHQ7dWwgY2xhc3M9JnF1b3Q7R3VpZGUtRXhwbGFpbiBjbGVhcmZpeCZxdW90OyZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQkJPC9zcGFuPiZsdDtsaSBjbGFzcz0mcXVvdDtFeHBsYWluLWwgRXhwbGFpbkEmcXVvdDsmZ3Q7Jmx0O3AmZ3Q76YCJ5oup5LiA5qy+5ZWG5ZOB77yM54K55Ye74oCc56uL5Y2zMeWFg+S6kei0reKAnSZsdDsvcCZndDsmbHQ7aW1nIHNyYz0mcXVvdDt7R19VUExPQURfUEFUSH0vbmV3YmllL0d1aWRlXzMuanBnJnF1b3Q7IGJvcmRlcj0mcXVvdDswJnF1b3Q7IGFsdD0mcXVvdDsmcXVvdDsmZ3Q7Jmx0Oy9saSZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQkJPC9zcGFuPiZsdDtsaSBjbGFzcz0mcXVvdDtFeHBsYWluLXIgRXhwbGFpbmltZyZxdW90OyZndDsmbHQ7aW1nIHNyYz0mcXVvdDt7R19VUExPQURfUEFUSH0vbmV3YmllL0d1aWRlXzQuanBnJnF1b3Q7IGJvcmRlcj0mcXVvdDswJnF1b3Q7IGFsdD0mcXVvdDsmcXVvdDsmZ3Q7Jmx0Oy9saSZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQk8L3NwYW4+Jmx0Oy91bCZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQk8L3NwYW4+Jmx0O2RpdiBjbGFzcz0mcXVvdDtHdWlkZS1TZXBhcmF0ZSZxdW90OyZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQkJPC9zcGFuPiZsdDtpbWcgc3JjPSZxdW90O3tHX1VQTE9BRF9QQVRIfS9uZXdiaWUvR3VpZGVfNS5qcGcmcXVvdDsgYm9yZGVyPSZxdW90OzAmcXVvdDsgYWx0PSZxdW90OyZxdW90OyZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQk8L3NwYW4+Jmx0Oy9kaXYmZ3Q7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJPC9zcGFuPiZsdDt1bCBjbGFzcz0mcXVvdDtHdWlkZS1FeHBsYWluIGNsZWFyZml4JnF1b3Q7Jmd0OzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCQk8L3NwYW4+Jmx0O2xpIGNsYXNzPSZxdW90O0V4cGxhaW4tbCBFeHBsYWluaW1nJnF1b3Q7Jmd0OyZsdDtpbWcgc3JjPSZxdW90O3tHX1VQTE9BRF9QQVRIfS9uZXdiaWUvR3VpZGVfNi5qcGcmcXVvdDsgYm9yZGVyPSZxdW90OzAmcXVvdDsgYWx0PSZxdW90OyZxdW90OyZndDsmbHQ7L2xpJmd0OzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCQk8L3NwYW4+Jmx0O2xpIGNsYXNzPSZxdW90O0V4cGxhaW4tciBFeHBsYWluQiZxdW90OyZndDsmbHQ7cCZndDvmlK/ku5gx5YWD77yM6LSt5LmwMeS6uuasoe+8jOiOt+W+lzHkuKrigJzkupHotK3noIHigJ0mbHQ7L3AmZ3Q7Jmx0O2ltZyBzcmM9JnF1b3Q7e0dfVVBMT0FEX1BBVEh9L25ld2JpZS9HdWlkZV83LmpwZyZxdW90OyBib3JkZXI9JnF1b3Q7MCZxdW90OyBhbHQ9JnF1b3Q7JnF1b3Q7Jmd0OyZsdDsvbGkmZ3Q7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJPC9zcGFuPiZsdDsvdWwmZ3Q7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJPC9zcGFuPiZsdDtkaXYgY2xhc3M9JnF1b3Q7R3VpZGUtU2VwYXJhdGUmcXVvdDsmZ3Q7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJCTwvc3Bhbj4mbHQ7aW1nIHNyYz0mcXVvdDt7R19VUExPQURfUEFUSH0vbmV3YmllL0d1aWRlXzUuanBnJnF1b3Q7IGJvcmRlcj0mcXVvdDswJnF1b3Q7IGFsdD0mcXVvdDsmcXVvdDsmZ3Q7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJPC9zcGFuPiZsdDsvZGl2Jmd0OzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCTwvc3Bhbj4mbHQ7dWwgY2xhc3M9JnF1b3Q7R3VpZGUtRXhwbGFpbiBjbGVhcmZpeCZxdW90OyZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQkJPC9zcGFuPiZsdDtsaSBjbGFzcz0mcXVvdDtFeHBsYWluLWwgRXhwbGFpbkMmcXVvdDsmZ3Q7Jmx0O3AmZ3Q75b2T5LiA5Lu25ZWG5ZOB6L6+5Yiw5oC75Y+C5LiO5Lq65qyh77yM5oq95Ye6MeWQjeWVhuWTgeiOt+W+l+iAhe+8myZsdDsvcCZndDsmbHQ7aW1nIHNyYz0mcXVvdDt7R19VUExPQURfUEFUSH0vbmV3YmllL0d1aWRlXzguanBnJnF1b3Q7IGJvcmRlcj0mcXVvdDswJnF1b3Q7IGFsdD0mcXVvdDsmcXVvdDsmZ3Q7Jmx0Oy9saSZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQkJPC9zcGFuPiZsdDtsaSBjbGFzcz0mcXVvdDtFeHBsYWluLXIgRXhwbGFpbmltZyZxdW90OyZndDsmbHQ7aW1nIHNyYz0mcXVvdDt7R19VUExPQURfUEFUSH0vbmV3YmllL0d1aWRlXzkuanBnJnF1b3Q7IGJvcmRlcj0mcXVvdDswJnF1b3Q7IGFsdD0mcXVvdDsmcXVvdDsmZ3Q7Jmx0Oy9saSZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQk8L3NwYW4+Jmx0Oy91bCZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQk8L3NwYW4+Jmx0O2RpdiBjbGFzcz0mcXVvdDtHdWlkZS1TZXBhcmF0ZSZxdW90OyZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQkJPC9zcGFuPiZsdDtpbWcgc3JjPSZxdW90O3tHX1VQTE9BRF9QQVRIfS9uZXdiaWUvR3VpZGVfNS5qcGcmcXVvdDsgYm9yZGVyPSZxdW90OzAmcXVvdDsgYWx0PSZxdW90OyZxdW90OyZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQk8L3NwYW4+Jmx0Oy9kaXYmZ3Q7Jm5ic3A7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJPC9zcGFuPiZsdDtkaXYgY2xhc3M9JnF1b3Q7UnVsZSBjbGVhcmZpeCZxdW90OyZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQkJPC9zcGFuPiZsdDtoMiZndDsmbHQ7aW1nIHNyYz0mcXVvdDt7R19VUExPQURfUEFUSH0vbmV3YmllL0d1aWRlXzEwLmpwZyZxdW90OyBib3JkZXI9JnF1b3Q7MCZxdW90OyBhbHQ9JnF1b3Q7JnF1b3Q7Jmd0OyZsdDsvaDImZ3Q7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJCTwvc3Bhbj4mbHQ7dWwgY2xhc3M9JnF1b3Q7UnVsZS1FeHAmcXVvdDsmZ3Q7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJCQk8L3NwYW4+Jmx0O2xpJmd0O+avj+S7tuWVhuWTgeWPguiAg+W4guWcuuS7t+W5s+WIhuaIkOebuOW6lOKAnOetieS7veKAne+8jOavj+S7vTHlhYPvvIwx5Lu95a+55bqUMeS4quS6kei0reeggeOAgiZsdDsvbGkmZ3Q7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJCQk8L3NwYW4+Jmx0O2xpJmd0O+WQjOS4gOS7tuWVhuWTgeWPr+S7pei0reS5sOWkmuasoeaIluS4gOasoei0reS5sOWkmuS7veOAgiZsdDsvbGkmZ3Q7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJCQk8L3NwYW4+Jmx0O2xpJmd0O+W9k+S4gOS7tuWVhuWTgeaJgOacieKAnOetieS7veKAneWFqOmDqOWUruWHuuWQjuiuoeeul+WHuuKAnOW5uOi/kOS6kei0reeggeKAne+8jOaLpeacieKAnOW5uOi/kOS6kei0reeggeKAneiAheWNs+WPr+iOt+W+l+atpOWVhuWTgeOAgiZsdDsvbGkmZ3Q7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJCTwvc3Bhbj4mbHQ7L3VsJmd0OzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCTwvc3Bhbj4mbHQ7L2RpdiZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQk8L3NwYW4+Jmx0O2RpdiBjbGFzcz0mcXVvdDtSdWxlIGNsZWFyZml4IFJ1bGVtYXQmcXVvdDsmZ3Q7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJCTwvc3Bhbj4mbHQ7aDImZ3Q7Jmx0O2ltZyBzcmM9JnF1b3Q7e0dfVVBMT0FEX1BBVEh9L25ld2JpZS9HdWlkZV8xMS5qcGcmcXVvdDsgYm9yZGVyPSZxdW90OzAmcXVvdDsgYWx0PSZxdW90OyZxdW90OyZndDsmbHQ7L2gyJmd0OzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCQk8L3NwYW4+Jmx0O3VsIGNsYXNzPSZxdW90O1J1bGUtRXhwJnF1b3Q7Jmd0OzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCQkJPC9zcGFuPiZsdDtsaSZndDvlj5bor6XllYblk4HmnIDlkI7otK3kubDml7bpl7TliY3nvZHnq5nmiYDmnInllYblk4ExMDDmnaHotK3kubDml7bpl7TorrDlvZXvvIjpmZDml7bmj63mmZPllYblk4Hlj5bmiKrmraLml7bpl7TliY3nvZHnq5nmiYDmnInllYblk4ExMDDmnaHotK3kubDml7bpl7TorrDlvZXvvInjgIImbHQ7L2xpJmd0OzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCQkJPC9zcGFuPiZsdDtsaSZndDvml7bpl7TmjInml7bjgIHliIbjgIHnp5LjgIHmr6vnp5Lkvp3mrKHmjpLliJfnu4TmiJDkuIDnu4TmlbDlgLzjgIImbHQ7L2xpJmd0OzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCQkJPC9zcGFuPiZsdDtsaSZndDvlsIbov5kxMDDnu4TmlbDlgLzkuYvlkozpmaTku6XllYblk4HmgLvpnIDlj4LkuI7kurrmrKHlkI7lj5bkvZnmlbDvvIzkvZnmlbDliqDkuIoxMCwwMDAsMDAx5Y2z5Li64oCc5bm46L+Q5LqR6LSt56CB4oCd44CCJmx0Oy9saSZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQkJPC9zcGFuPiZsdDsvdWwmZ3Q7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJPC9zcGFuPiZsdDsvZGl2Jmd0OzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCTwvc3Bhbj4mbHQ7ZGl2IGNsYXNzPSZxdW90O1J1bGUtbGluZSZxdW90OyZndDsmbHQ7L2RpdiZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQk8L3NwYW4+Jmx0O2RpdiBjbGFzcz0mcXVvdDtSdWxlLWJ1dHRvbiZxdW90OyZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQkJPC9zcGFuPiZsdDthIGhyZWY9JnF1b3Q7e1dFQl9QQVRIfSZxdW90OyB0YXJnZXQ9JnF1b3Q7X2JsYW5rJnF1b3Q7Jmd0OyZsdDtpbWcgc3JjPSZxdW90O3tHX1VQTE9BRF9QQVRIfS9uZXdiaWUvR3VpZGVfMTQuanBnJnF1b3Q7IGJvcmRlcj0mcXVvdDswJnF1b3Q7IGFsdD0mcXVvdDsmcXVvdDsmZ3Q7Jmx0Oy9hJmd0OzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCTwvc3Bhbj4mbHQ7L2RpdiZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4mbHQ7L2RpdiZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4mbHQ7ZGl2IGNsYXNzPSZxdW90O1J1bGUtQW5nbGViZyZxdW90OyZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4mbHQ7L2RpdiZndDs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4mbHQ7ZGl2IGNsYXNzPSZxdW90O2NsZWFyJnF1b3Q7Jmd0OyZsdDsvZGl2Jmd0OzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgk8L3NwYW4+Jmx0Oy9kaXYmZ3Q7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CTwvc3Bhbj4mbHQ7c2NyaXB0IHR5cGU9JnF1b3Q7dGV4dC9qYXZhc2NyaXB0JnF1b3Q7Jmd0OzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJPC9zcGFuPiQoJnF1b3Q7Lnl1X2ZmJnF1b3Q7KS5tb3VzZW92ZXIoZnVuY3Rpb24oKXs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4gJm5ic3A7JCgmcXVvdDsuaF8xeXlnX2VqZWN0JnF1b3Q7KS5zaG93KCk7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQk8L3NwYW4+fSk8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4kKCZxdW90Oy55dV9mZiZxdW90OykubW91c2VvdXQoZnVuY3Rpb24oKXs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4gJm5ic3A7JCgmcXVvdDsuaF8xeXlnX2VqZWN0JnF1b3Q7KS5oaWRlKCk7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQk8L3NwYW4+fSk8L3A+PHA+PGJyLz48L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQk8L3NwYW4+ICZuYnNwOyAmbmJzcDsgJCgmcXVvdDsjbV9hbGxfc29ydCZxdW90OykuaGlkZSgpOzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJPC9zcGFuPiAmbmJzcDsgJm5ic3A7ICQoJnF1b3Q7Lm1fbWVudV9hbGwmcXVvdDspLm1vdXNlZW50ZXIoZnVuY3Rpb24oKXs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCQkJPC9zcGFuPiAmbmJzcDsgJm5ic3A7JCgmcXVvdDsubV9hbGxfc29ydCZxdW90Oykuc2hvdygpOzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJPC9zcGFuPiAmbmJzcDsgJm5ic3A7IH0pPC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJPC9zcGFuPiAkKCZxdW90Oy5tX21lbnVfYWxsJnF1b3Q7KS5tb3VzZWxlYXZlKGZ1bmN0aW9uKCl7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJCTwvc3Bhbj4gJm5ic3A7ICZuYnNwOyQoJnF1b3Q7Lm1fYWxsX3NvcnQmcXVvdDspLmhpZGUoKTs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4gJm5ic3A7ICZuYnNwOyB9KTwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCTwvc3Bhbj4gJCgmcXVvdDsubV9hbGxfc29ydCZxdW90OykubW91c2VlbnRlcihmdW5jdGlvbigpezwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCQk8L3NwYW4+ICZuYnNwOyAmbmJzcDskKHRoaXMpLnNob3coKTs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4gJm5ic3A7ICZuYnNwOyB9KTwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCTwvc3Bhbj4gJCgmcXVvdDsubV9hbGxfc29ydCZxdW90OykubW91c2VsZWF2ZShmdW5jdGlvbigpezwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCQk8L3NwYW4+ICZuYnNwOyAmbmJzcDskKHRoaXMpLmhpZGUoKTs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4gJm5ic3A7ICZuYnNwOyB9KTwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJPC9zcGFuPiAmbmJzcDsgJm5ic3A7ICQoZnVuY3Rpb24oKXs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4gJm5ic3A7ICZuYnNwOyAmbmJzcDsgJCh3aW5kb3cpLnNjcm9sbChmdW5jdGlvbigpIHs8c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgk8L3NwYW4+PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQk8L3NwYW4+ICZuYnNwOyAmbmJzcDsgJm5ic3A7PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj48L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4gJm5ic3A7ICZuYnNwOyA8c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJPC9zcGFuPmlmKCQod2luZG93KS5zY3JvbGxUb3AoKSZndDs9MTMwJmFtcDsmYW1wOyQod2luZG93KS5zY3JvbGxUb3AoKSZsdDs9NTYwKXs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4gJm5ic3A7ICZuYnNwOyA8c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCTwvc3Bhbj4kKCZxdW90Oy5oZWFkX25hdiZxdW90OykuYWRkQ2xhc3MoJnF1b3Q7Zml4ZWROYXYmcXVvdDspOzxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CTwvc3Bhbj48L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4gJm5ic3A7ICZuYnNwOyA8c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCTwvc3Bhbj4kKCZxdW90OyNtX2FsbF9zb3J0JnF1b3Q7KS5mYWRlT3V0KCk7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQk8L3NwYW4+ICZuYnNwOyAmbmJzcDsgPHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj59ZWxzZSBpZigkKHdpbmRvdykuc2Nyb2xsVG9wKCkmZ3Q7NTYwKXs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4gJm5ic3A7ICZuYnNwOyA8c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJCTwvc3Bhbj4kKCZxdW90Oy5oZWFkX25hdiZxdW90OykuYWRkQ2xhc3MoJnF1b3Q7Zml4ZWROYXYmcXVvdDspOzwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJPC9zcGFuPiAmbmJzcDsgJm5ic3A7IDxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJPC9zcGFuPiQoJnF1b3Q7I21fYWxsX3NvcnQmcXVvdDspLmZhZGVPdXQoKTs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4gJm5ic3A7ICZuYnNwOyA8c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgk8L3NwYW4+fSBlbHNlIGlmKCQod2luZG93KS5zY3JvbGxUb3AoKSZsdDsxMzApezwvcD48cD48c3BhbiBjbGFzcz0iQXBwbGUtdGFiLXNwYW4iIHN0eWxlPSJ3aGl0ZS1zcGFjZTpwcmUiPgkJPC9zcGFuPiAmbmJzcDsgJm5ic3A7IDxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQkJPC9zcGFuPiQoJnF1b3Q7LmhlYWRfbmF2JnF1b3Q7KS5yZW1vdmVDbGFzcygmcXVvdDtmaXhlZE5hdiZxdW90Oyk7PC9wPjxwPjxzcGFuIGNsYXNzPSJBcHBsZS10YWItc3BhbiIgc3R5bGU9IndoaXRlLXNwYWNlOnByZSI+CQk8L3NwYW4+ICZuYnNwOyAmbmJzcDsgPHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JPC9zcGFuPn08L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4gJm5ic3A7ICZuYnNwOyAmbmJzcDsgJm5ic3A7ICZuYnNwOyB9KTs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JCTwvc3Bhbj4gJm5ic3A7ICZuYnNwOyB9KTs8L3A+PHA+PHNwYW4gY2xhc3M9IkFwcGxlLXRhYi1zcGFuIiBzdHlsZT0id2hpdGUtc3BhY2U6cHJlIj4JPC9zcGFuPiZsdDsvc2NyaXB0Jmd0OzwvcD48cD4mbHQ7L2RpdiZndDs8L3A+PHA+Jmx0OyEtLeaWsOaJi+aMh+WNl+e7k+adny0tJmd0OzwvcD48cD57d2M6dGVtcGxhdGVzICZxdW90O2luZGV4JnF1b3Q7LCZxdW90O2Zvb3RlciZxdW90O308L3A+PHA+PGJyLz48L3A+";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1),
(8, 0, 0, -1, '合作专区', 'business', '', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:24:"single_web.business.html";s:7:"content";s:6864:"PHA+e3djOnRlbXBsYXRlcyAmcXVvdDtpbmRleCZxdW90OywmcXVvdDtoZWFkZXImcXVvdDt9PC9wPjxwPjxpbWcgc3JjPSJ7R19URU1QTEFURVNfU1RZTEV9L2ltYWdlcy9CX3pzLWJhbm5lci5wbmciIHdpZHRoPSI4ODIiIGhlaWdodD0iMjU5Ii8+PC9wPjx1bCBjbGFzcz0iIGxpc3QtcGFkZGluZ2xlZnQtMiI+PGxpPjxwPjxhIGhyZWY9IiMwMSI+e3djOmZ1bjpfY2ZnKCZxdW90O3dlYl9uYW1lJnF1b3Q7KX3nroDku4s8L2E+PC9wPjwvbGk+PGxpPjxwPjxici8+PC9wPjwvbGk+PGxpPjxwPjxhIGhyZWY9IiMwMiI+e3djOmZ1bjpfY2ZnKCZxdW90O3dlYl9uYW1lJnF1b3Q7KX3nmoTmoLjlv4PkvJjlir88L2E+PC9wPjwvbGk+PGxpPjxwPjxici8+PC9wPjwvbGk+PGxpPjxwPjxhIGhyZWY9IiMwMyI+5ZCI5L2c5a+56LGhPC9hPjwvcD48L2xpPjxsaT48cD48YnIvPjwvcD48L2xpPjxsaT48cD48YSBocmVmPSIjMDMiPuWQiOS9nOaWueW8jzwvYT48L3A+PC9saT48bGk+PHA+PGJyLz48L3A+PC9saT48bGk+PHA+PGEgaHJlZj0iIzA0Ij7lkIjkvZzmtYHnqIs8L2E+PC9wPjwvbGk+PGxpPjxwPjxici8+PC9wPjwvbGk+PGxpPjxwPjxhIGhyZWY9IiMwNSI+5oub5ZWG6IGU57O7PC9hPjwvcD48L2xpPjwvdWw+PHA+Jm5ic3A7Jm5ic3A7e3djOmZ1bjpfY2ZnKCZxdW90O3dlYl9uYW1lJnF1b3Q7KX3vvIh7R19XRUJfUEFUSH3vvInmmK/kuIDnp43lhajmlrDnmoTkupLliqjotK3niankvZPpqozmlrnlvI/vvIzmmK/ml7blsJrjgIHmva7mtYHnmoTpo47lkJHmoIfvvIzog73mu6HotrPkuKrmgKfjgIHlubTovbvmtojotLnogIXnmoTotK3nianpnIDmsYLjgII8L3A+PHA+5LqR6LSt566A5LuLPGEgbmFtZT0iMDEiIGlkPSIwMSI+PC9hPjwvcD48cD4mbmJzcDsmbmJzcDvkupHotK3mmK/mjIfkuIDku7bllYblk4HooqvliIbmiJDoi6XlubLigJznrYnku73igJ3vvIzmgqjlj6rpnIDlh7rlhbbkuK3kuIDku73nmoTpkrHvvIgx5YWD77yJ77yM6I635b6X5LiA5Liq57yW5Y+377yM5b2T6L+Z5Lu25ZWG5ZOB5omA5pyJ4oCc562J5Lu94oCd6KKr5a6M5YWo5ZSu5Ye65ZCO77yM57O757uf6ZqP5py65oq95Y+W5LiA5Liq57yW5Y+35L2c5Li64oCc5bm46L+Q57yW5Y+34oCd77yM5q2k4oCc5bm46L+Q57yW5Y+34oCd55qE5oul5pyJ6ICF5Y2z5Y+v6I635b6X6L+Z5Lu25ZWG5ZOB44CCPGJyLz48YnIvPuS+i+Wmgu+8muS4gOmDqDQwMDDlhYNpUGhvbmU05omL5py677yM6L+Z6YOoaVBob25lNOWwhuiiq+KAnOWIhuKAneaIkDQwMDDku73lh7rllK7vvIzmr4/ku73igJzllK7ku7figJ0x5YWD44CC6IqxMeWFg+mSseWQjuWwhuS5sOi/m+S4gOS4que8luWPt++8jOW9k+i/mTQwMDDigJzku73igJ3lhajpg6jooqvljZbnqbrml7bvvIzns7vnu5/lsIbpmo/mnLrmir3lj5bkuIDkuKoNCiAmbmJzcDsgJm5ic3A7ICZuYnNwOyAmbmJzcDsgJm5ic3A7ICZuYnNwO+KAnOW5uOi/kOe8luWPt+KAne+8jOKAnOW5uOi/kOe8luWPt+KAneaLpeacieiAheWwseiDveiOt+W+l+i/memDqOaJi+acuuOAgjxici8+PC9wPjxwPnt3YzpmdW46X2NmZygmcXVvdDt3ZWJfbmFtZSZxdW90Oyl977yIe0dfV0VCX1BBVEh977yJ5piv5LiA56eN5YWo5paw55qE5LqS5Yqo6LSt54mp5L2T6aqM5pa55byP77yM5piv5pe25bCa44CB5r2u5rWB55qE6aOO5ZCR5qCH77yM6IO95ruh6Laz5Liq5oCn44CB5bm06L275raI6LS56ICF55qE6LSt54mp6ZyA5rGC77yM55Sx5rex5Zyz5biC5Lit5Yip5L+d5oqV6LWE566h55CG5pyJ6ZmQ5YWs5Y+45rOo5YWl5beo6LWE5omT6YCg55qE5paw5Z6L6LSt54mp572R44CCPGJyLz48YnIvPnt3YzpmdW46X2NmZygmcXVvdDt3ZWJfbmFtZSZxdW90Oyl95Lul4oCc5b+r5LmQ5LqR6LSt77yM5oOK5Zac5peg6ZmQ4oCd5Li65a6X5peo77yM5Yqb5rGC5omT6YCg5LiA5LiqMTAwJeWFrOW5s+WFrOato+OAgTEwMCXmraPlk4Hkv53pmpzjgIHlr4TlqLHkuZDkuI7otK3niankuIDkvZPljJbnmoTmlrDlnovotK3niannvZHnq5njgII8YnIvPumaj+edgOS6kuiBlOe9keeahOWPkeWxleWPiue9kei0rea2iOi0ueaooeW8j+eahOWkmuagt+WMlu+8jHt3YzpmdW46X2NmZygmcXVvdDt3ZWJfbmFtZSZxdW90Oyl95Yq/5b+F5oiQ5Li65Lit5Zu955S15a2Q5ZWG5Yqh572R56uZ5Lit5pyA5YW35rS75Yqb55qE55Sf5Yqb5Yab5Y+K572R5rCR5pyA54ix55qE6LSt54mp572R77yM5b+F5bCG6L+F6YCf5bSb6LW377yM5oiQ5Li65LqS6IGU572R5paw5pe25Luj55qE5L285L286ICF77yBPGJyLz48L3A+PHA+e3djOmZ1bjpfY2ZnKCZxdW90O3dlYl9uYW1lJnF1b3Q7KX3moLjlv4PkvJjlir88YSBuYW1lPSIwMiIgaWQ9IjAyIj48L2E+PC9wPjxwPjEuIHt3YzpmdW46X2NmZygmcXVvdDt3ZWJfbmFtZSZxdW90Oyl95piv5YWo55CD5qih5byP5Yib5paw44CB5Zu95YaF5pyA5YW35r2c6LSo55qE57u85ZCI5Z6LQjJD55S15a2Q5ZWG5Yqh5bmz5Y+w44CCPGJyLz4yLiB7d2M6ZnVuOl9jZmcoJnF1b3Q7d2ViX25hbWUmcXVvdDspfeaLpeaciea/gOaJrOeahOmdkuaYpeiInuWPsO+8jOi/memHjOa0i+a6ouedgOa/gOaDheS4juS4quaAp++8jOi/memHjOWFhea7oeedgOWIm+aEj+S4jueBteaEn++8geaIkeS7rOeri+W/l+aIkOS4uuS4gOWutuW/q+mAn+aIkOmVv+OAgeWFhea7oea0u+WKm+eahOWIm+S4muWFrOWPuO+8jOaIkeS7rOabtDxici8+Jm5ic3A7Jm5ic3A7Jm5ic3A7Jm5ic3A755+i5b+X5oiQ5Li65LiA5a625Lyf5aSn55qE44CB5aSH5Y+X56S+5Lya5bCK5pWs55qE5Z+65Lia6ZW/6Z2S55qE5LyB5Lia77yBPGJyLz4zLiB7d2M6ZnVuOl9jZmcoJnF1b3Q7d2ViX25hbWUmcXVvdDspfeWFt+aciemrmOerr+S/oeaBr+aKgOacr+aUr+aSkeeahOe9kee7nOi0reeJqeW5s+WPsO+8jOWPr+aUr+aMgTEwMDDkuIfnlKjmiLflkIzml7borr/pl67vvIzmr4/lpKnlj6/lpITnkIbkuIrkuIforqLljZXjgII8YnIvPjQuIOW8uuWkp+eahOS6kuiBlOe9keiQpemUgOiDveWKm++8jOmihuWFiOeahOeyvuWHhuiQpemUgOaJi+aute+8jOe6v+S4iue6v+S4i+a4oOmBk+eahOaXoOe8neaVtOWQiO+8jOW/q+mAn+WHhuehruWcsOWQkeeUqOaIt+S8oOmAkuacgOaWsOOAgeacgOeDreWVhuWTgeS/oeaBr+OAgjwvcD48cD7lkIjkvZzlr7nosaHkuI7lkIjkvZzmlrnlvI88YSBuYW1lPSIwMyIgaWQ9IjAzIj48L2E+PC9wPjxwPjxzdHJvbmc+MeOAgeWQiOS9nOWvueixoTwvc3Ryb25nPjxici8+PC9wPjxwIHN0eWxlPSJtYXJnaW46IDA7IHBhZGRpbmc6IDAgMCAwIDIwcHg7Ij4x77yJ5Zu95YaF5aSW5ZOB54mM5ZWG44CB57uP6ZSA5ZWG5oiW5pyJ5q2j6KeE6LSn5rqQ5Y+K5o6I5p2D55qE5rig6YGT5ZWG77yM5pyJ5ZCI5rOV5a6M5pW055qE5LyB5Lia6JCl5Lia5omn54Wn44CB5LyB5Lia56iO5Yqh55m76K6w6K+B44CB5ZOB54mM5o6I5p2D5Lmm77yI5oiW5ZWG5qCH5rOo5YaM6K+B77yJ77ybPC9wPjxwPjxzdHJvbmc+MuOAgeWQiOS9nOaWueW8jzwvc3Ryb25nPjxici8+PC9wPjxwIHN0eWxlPSJtYXJnaW46IDA7IHBhZGRpbmc6IDAgMCAwIDIwcHg7Ij4x77yJ5Luj6ZSAPGJyLz7ku6PplIDmqKHlvI/vvIzns7vmjIfkvpvlupTllYbkuI7mnKzlhazlj7jnrb7orqLku6PplIDlkIjlkIzkuYvlkI7vvIzmjInnhafmnKzlhazlj7jlhaXlupPpgJrnn6XkuabliJfmmI7nmoTllYblk4Hlnovlj7flkozmlbDph4/vvIzlsIbnm7jlhbPllYblk4Hov5DpgIHjgIHmlL7nva7kuo7mnKzlhazlj7jmjIflrprnmoTku5PlupPvvIzlubbnlLHmnKzlhazlj7jov5vooYzplIDllK7vvIzkuIDlrprlkajmnJ/lkI7vvIzmnKzlhazlj7jmjInnhaflrp7pmYXplIDllK7nmoTmlbDph4/jgIHkuovlhYjnuqblrprnmoTku6PplIDov5votKfku7fvvIzkuI7kvpvlupTllYbnu5PnrpfotKfmrL7nmoTkuqTmmJPov4fnqIvjgII8YnIvPjxici8+Mu+8iei0remUgO+8iOWQq+S5sOaWre+8iTxici8+6LSt6ZSA5qih5byP77yM57O75oyH5L6b5bqU5ZWG5LiO5pys5YWs5Y+4562+6K6i6LSt6ZSA5ZCI5ZCM5LmL5ZCO77yM5oyJ54Wn5pys5YWs5Y+45YWl5bqT6YCa55+l5Lmm5YiX5piO55qE5ZWG5ZOB5Z6L5Y+35ZKM5pWw6YeP77yM5bCG55u45YWz5ZWG5ZOB6L+Q6YCB44CB5pS+572u5LqO5pys5YWs5Y+45oyH5a6a55qE5LuT5bqT77yM5bm255Sx5pys5YWs5Y+46L+b6KGM6ZSA5ZSu77yM5pys5YWs5Y+45oyJ54Wn5a6e6ZmF6LSt5Lmw5YWl5bqT55qE5pWw6YeP44CB5LqL5YWI57qm5a6a55qE6YeH6LSt5Lu35LiO5L6b5bqU5ZWG57uT566X6LSn5qy+55qE5Lqk5piT6L+H56iL44CCPGJyLz7otK3plIDov4fnqIvkuK3vvIzotK3plIDllYblk4HnmoTmiYDmnInmnYPlnKjllYblk4HkuqTku5jnu5nmnKzlhazlj7jml7bvvIzku47kvpvlupTllYbovaznp7voh7PmnKzlhazlj7jjgII8YnIvPui0remUgOaooeW8j+S4i+eahOe7k+eul+eOr+iKgu+8jOeUseacrOWFrOWPuOS4juS+m+W6lOWVhuWFt+S9k+a0veWVhuWGs+WumuOAguWFt+S9k+iAjOiogO+8jOWPr+S7peeUseacrOWFrOWPuOWFiOihjOaUr+S7mOS4gOWumueahOmihOS7mOasvuaIluWumumHke+8jOiAjOWQjuS4gOWumuWRqOacn+WQjuWGjee7k+eul++8m+S5n+WPr+S7pea0veWVhuWFtuWug+abtOeBtea0u+eahOW9ouW8j+OAgjxici8+6LSt6ZSA5qih5byP5LiL77yM5pys5YWs5Y+45omA6YeH6LSt55qE5ZWG5ZOB5Lit77yM5rue6ZSA5ZOB5oiW5Zug6aG+5a6i6YCA5o2i6LSn6ICM5Lqn55Sf55qE5LiN6Imv5ZOB6IO95ZCm6YCA6L+Y5oiW6YOo5YiG6YCA6L+Y57uZ5L6b5bqU5ZWG77yM55Sx5pys5YWs5Y+45LiO5L6b5bqU5ZWG5ZWG5Yqh5rS96LCI5Yaz5a6a44CCPC9wPjxwPuWQiOS9nOaWueW8jzxhIG5hbWU9IjA0IiBpZD0iMDQiPjwvYT48L3A+PHA+PGltZyBzcmM9IntHX1RFTVBMQVRFU19TVFlMRX0vaW1hZ2VzL0JfbGNfcGljLmdpZiIgd2lkdGg9IjgzMyIgaGVpZ2h0PSIxOTUiLz48L3A+PHA+5oub5ZWG6IGU57O7PGEgbmFtZT0iMDUiIGlkPSIwNSI+PC9hPjwvcD48cD7ogZTns7vkurrvvJrllYblk4Hov5DokKXkuK3lv4M8YnIvPueUteivne+8mjEyMzQ1Njxici8+5Zyw5Z2A77yaPGJyLz7pgq7nvJbvvJo0MDIwMDA8YnIvPjwvcD48cD57d2M6dGVtcGxhdGVzICZxdW90O2luZGV4JnF1b3Q7LCZxdW90O2Zvb3RlciZxdW90O308L3A+";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1),
(9, 0, 0, -1, '公益基金', 'fund', '', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:20:"single_web.fund.html";s:7:"content";s:28:"<p>输入栏目内容...</p>";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1),
(10, 0, 0, -1, '云购QQ群', 'qqgroup', '', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:23:"single_web.qqgroup.html";s:7:"content";s:40:"PHA+6L6T5YWl5qCP55uu5YaF5a65Li4uPC9wPg==";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1),
(11, 0, 0, -1, '邀请注册', 'pleasereg', '', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:25:"single_web.pleasereg.html";s:7:"content";s:28:"<p>输入栏目内容...</p>";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1),
(12, 0, 0, 1, '数码影像', 'shumayingxiang', 'cateimg/20150821/83980735158378.png', '', 'a:7:{s:5:"thumb";s:35:"cateimg/20150821/83980735158378.png";s:3:"des";s:12:"数码相机";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:12:"数码相机";s:13:"meta_keywords";s:12:"数码相机";s:16:"meta_description";s:12:"数码相机";}', 3),
(13, 0, 0, 1, '电脑', 'diannao', 'cateimg/20150821/71565047158359.png', '', 'a:7:{s:5:"thumb";s:35:"cateimg/20150821/71565047158359.png";s:3:"des";s:6:"电脑";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:6:"电脑";s:13:"meta_keywords";s:6:"电脑";s:16:"meta_description";s:6:"电脑";}', 5),
(14, 0, 0, 1, '手机平板', 'shoujipingban', 'cateimg/20150821/93917600158092.png', '', 'a:7:{s:5:"thumb";s:35:"cateimg/20150821/93917600158092.png";s:3:"des";s:12:"手机平板";s:8:"template";N;s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 6),
(15, 0, 0, 1, '其他商品', 'qitashangpin', 'cateimg/20150821/81212741158754.png', '', 'a:7:{s:5:"thumb";s:35:"cateimg/20150821/81212741158754.png";s:3:"des";s:12:"其他商品";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:12:"其他商品";s:13:"meta_keywords";s:12:"其他商品";s:16:"meta_description";s:12:"其他商品";}', 9),
(16, 1, 0, 2, '云购基金', 'fund', '', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1),
(17, 0, 0, 1, '潮流新品', 'chaoliuxinpin', 'cateimg/20150821/77928723158582.png', '', 'a:7:{s:5:"thumb";s:35:"cateimg/20150821/77928723158582.png";s:3:"des";s:12:"潮流新品";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 7),
(18, 0, 0, 1, '综合购物', 'zonghegouwu', 'cateimg/20150821/22065264158707.png', '', 'a:7:{s:5:"thumb";s:35:"cateimg/20150821/22065264158707.png";s:3:"des";s:12:"综合购物";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 8),
(142, 0, 0, 2, '网站公告', 'wangzhangonggao', '', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:12:"网站公告";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:12:"网站公告";s:13:"meta_keywords";s:12:"网站公告";s:16:"meta_description";s:12:"网站公告";}', 1),
(145, 0, 0, -1, '测试单页', 'ceshi', 'cateimg/20151214/75614537058926.png', '', 'a:7:{s:5:"thumb";s:35:"cateimg/20151214/75614537058926.png";s:3:"des";s:0:"";s:8:"template";s:24:"single_web.business.html";s:7:"content";s:48:"PHA+6L6T5YWl5qCP55uu5YaF5a65Li4uMTM0NTQ0NDwvcD4=";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1),
(146, 1, 0, 2, '官方媒体', 'guanfangmeiti', '', '', 'a:7:{s:5:"thumb";s:0:"";s:3:"des";s:0:"";s:8:"template";s:0:"";s:7:"content";s:0:"";s:10:"meta_title";s:0:"";s:13:"meta_keywords";s:0:"";s:16:"meta_description";s:0:"";}', 1);

-- --------------------------------------------------------

--
-- 表的结构 `go_cjcode`
--

CREATE TABLE IF NOT EXISTS `go_cjcode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` int(10) unsigned NOT NULL,
  `scenename` char(50) NOT NULL DEFAULT '' COMMENT '推广员或者渠道名称',
  `ticket` char(255) NOT NULL DEFAULT '' COMMENT '二维码ticket',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `total` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '总共的关注人数',
  `nownum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '扫描关注人数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=169 ;

--
-- 导出表中的数据 `go_cjcode`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_cjlist`
--

CREATE TABLE IF NOT EXISTS `go_cjlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `wxid` char(255) NOT NULL DEFAULT '' COMMENT '推广员或者渠道名称',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `codeid` char(20) NOT NULL DEFAULT '' COMMENT '场景码',
  `come` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0是关注  1是扫描',
  `sum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '扫描或者关注次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='场景关注报表' AUTO_INCREMENT=270 ;

--
-- 导出表中的数据 `go_cjlist`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_config`
--

CREATE TABLE IF NOT EXISTS `go_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `value` mediumtext,
  `zhushi` text,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- 导出表中的数据 `go_config`
--

INSERT INTO `go_config` (`id`, `name`, `value`, `zhushi`) VALUES
(1, 'web_name', '一元云购-惊喜无限', '网站名'),
(2, 'web_key', '云购|一元云购|云购系统|购物|一元购物', '网站关键字'),
(3, 'web_des', '1元云购是一种全新的购物方式,是时尚、潮流的风向标,能满足个性、年轻消费者的购物需求,由深圳市一元云购网络科技有限公司注入巨资打造的新型购物网。\n', '网站介绍'),
(4, 'web_path', 'http://bbs.52jscn.com

', '网站地址'),
(5, 'templates_edit', '1', '是否允许在线编辑模板'),
(6, 'templates_name', 'yungou', '当前模板方案'),
(7, 'charset', 'utf-8', '网站字符集'),
(8, 'timezone', 'Asia/Shanghai', '网站时区'),
(9, 'error', '1', '1、保存错误日志到 cache/error_log.php | 0、在页面直接显示'),
(10, 'gzip', '0', '是否Gzip压缩后输出,服务器没有gzip请不要启用'),
(11, 'lang', 'zh-cn', '网站语言包'),
(12, 'cache', '3600', '默认缓存时间'),
(13, 'web_off', '1', '网站是否开启'),
(14, 'web_off_text', '网站关闭。升级中....', '关闭原因'),
(15, 'tablepre', 'QCNf', NULL),
(16, 'index_name', 'index.php', '隐藏首页文件名'),
(17, 'expstr', '/', 'url分隔符号'),
(18, 'admindir', 'admin', '后台管理文件夹'),
(19, 'qq', '15584633', 'qq'),
(20, 'cell', '13003795520', '联系电话'),
(21, 'web_logo', 'banner/20160623/23760588666504.png', 'logo'),
(22, 'web_copyright', 'Copyright (c) 2011 - 2015, 版权所有 粤ICP备09213115号-1', '版权'),
(23, 'web_name_two', '一元云购', '短网站名'),
(24, 'qq_qun', '', 'QQ群'),
(25, 'goods_end_time', '180', '开奖动画秒数(单位秒)'),
(26, 'xianshi', '1', '手机端限时揭晓是否显示'),
(27, 'web_verify', '1', '验证码是否开启'),
(28, 'sendmobile', '1', '发货微信提醒');

-- --------------------------------------------------------

--
-- 表的结构 `go_czk`
--

CREATE TABLE IF NOT EXISTS `go_czk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `czknum` varchar(12) NOT NULL COMMENT '充值卡号码',
  `password` varchar(12) NOT NULL COMMENT '充值卡密码',
  `mianzhi` int(11) NOT NULL COMMENT '面值',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '使用状态',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '充值类型 1一次性 2永久',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- 导出表中的数据 `go_czk`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_egglotter_award`
--

CREATE TABLE IF NOT EXISTS `go_egglotter_award` (
  `award_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `user_name` varchar(11) DEFAULT NULL COMMENT '用户名字',
  `rule_id` int(11) DEFAULT NULL COMMENT '活动ID',
  `subtime` int(11) DEFAULT NULL COMMENT '中奖时间',
  `spoil_id` int(11) DEFAULT NULL COMMENT '奖品等级',
  PRIMARY KEY (`award_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- 导出表中的数据 `go_egglotter_award`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_egglotter_rule`
--

CREATE TABLE IF NOT EXISTS `go_egglotter_rule` (
  `rule_id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_name` varchar(200) DEFAULT NULL,
  `starttime` int(11) DEFAULT NULL COMMENT '活动开始时间',
  `endtime` int(11) DEFAULT NULL COMMENT '活动结束时间',
  `subtime` int(11) DEFAULT NULL COMMENT '活动编辑时间',
  `lotterytype` int(11) DEFAULT NULL COMMENT '抽奖按币分类',
  `lotterjb` int(11) DEFAULT NULL COMMENT '每一次抽奖使用的金币',
  `ruledesc` text COMMENT '规则介绍',
  `startusing` tinyint(4) DEFAULT NULL COMMENT '启用',
  PRIMARY KEY (`rule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `go_egglotter_rule`
--

INSERT INTO `go_egglotter_rule` (`rule_id`, `rule_name`, `starttime`, `endtime`, `subtime`, `lotterytype`, `lotterjb`, `ruledesc`, `startusing`) VALUES
(1, '1', 1440259200, 1472054400, 1457761129, 1, 1, '三国6666', 1);

-- --------------------------------------------------------

--
-- 表的结构 `go_egglotter_spoil`
--

CREATE TABLE IF NOT EXISTS `go_egglotter_spoil` (
  `spoil_id` int(11) NOT NULL AUTO_INCREMENT,
  `rule_id` int(11) DEFAULT NULL,
  `spoil_name` text COMMENT '名称',
  `spoil_jl` int(11) DEFAULT NULL COMMENT '机率',
  `spoil_dj` int(11) DEFAULT NULL,
  `urlimg` varchar(200) DEFAULT NULL,
  `subtime` int(11) DEFAULT NULL COMMENT '提交时间',
  PRIMARY KEY (`spoil_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `go_egglotter_spoil`
--

INSERT INTO `go_egglotter_spoil` (`spoil_id`, `rule_id`, `spoil_name`, `spoil_jl`, `spoil_dj`, `urlimg`, `subtime`) VALUES
(1, 1, '洗衣粉', 20, 1, NULL, 1457761129),
(2, 1, '游戏机', 40, 2, NULL, 1457761129),
(3, 1, '手机', 40, 3, NULL, 1457761129);

-- --------------------------------------------------------

--
-- 表的结构 `go_fund`
--

CREATE TABLE IF NOT EXISTS `go_fund` (
  `id` int(10) unsigned NOT NULL,
  `fund_off` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `fund_money` decimal(10,2) unsigned NOT NULL,
  `fund_count_money` decimal(12,2) DEFAULT NULL COMMENT '云购基金',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `go_fund`
--

INSERT INTO `go_fund` (`id`, `fund_off`, `fund_money`, `fund_count_money`) VALUES
(1, 1, 0.50, 0.00);

-- --------------------------------------------------------

--
-- 表的结构 `go_link`
--

CREATE TABLE IF NOT EXISTS `go_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '友情链接ID',
  `type` tinyint(1) unsigned NOT NULL COMMENT '链接类型',
  `name` char(20) NOT NULL COMMENT '名称',
  `logo` varchar(250) NOT NULL COMMENT '图片',
  `url` varchar(50) NOT NULL COMMENT '地址',
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `go_link`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_member`
--

CREATE TABLE IF NOT EXISTS `go_member` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL DEFAULT '' COMMENT '用户名',
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
  `yaoqing` int(10) unsigned DEFAULT '0' COMMENT '邀请人',
  `band` varchar(255) DEFAULT NULL,
  `time` int(10) DEFAULT NULL,
  `headimg` char(255) NOT NULL DEFAULT '' COMMENT '用户头像，快捷登陆时候的头像',
  `wxid` char(255) DEFAULT '' COMMENT '微信id',
  `typeid` int(10) unsigned DEFAULT '0' COMMENT '注册来源 0电脑端  1 手机端 2微信关注 3快捷登陆QQ 4 微信快捷',
  `auto_user` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='会员表' AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `go_member`
--

INSERT INTO `go_member` (`uid`, `username`, `email`, `mobile`, `password`, `user_ip`, `img`, `qianming`, `groupid`, `addgroup`, `money`, `emailcode`, `mobilecode`, `othercode`, `passcode`, `reg_key`, `score`, `jingyan`, `yaoqing`, `band`, `time`, `headimg`, `wxid`, `typeid`, `auto_user`) VALUES
(1, '111', '111@qq.com', '15889311715', '96e79218965eb72c92a549dd5a330112', ',demo.52jscn.com', 'photo/member.jpg', '', 1, NULL, 1.00, '1', '1', 0, '-1', NULL, 111111, 1111111, 0, NULL, 1470579545, '', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `go_member_account`
--

CREATE TABLE IF NOT EXISTS `go_member_account` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(1) DEFAULT NULL COMMENT '充值1/消费-1',
  `pay` char(20) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL COMMENT '详情',
  `money` mediumint(8) NOT NULL DEFAULT '0' COMMENT '金额',
  `time` char(20) NOT NULL,
  KEY `uid` (`uid`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员账户明细';

--
-- 导出表中的数据 `go_member_account`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_member_addmoney_record`
--

CREATE TABLE IF NOT EXISTS `go_member_addmoney_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `code` char(20) NOT NULL,
  `money` decimal(10,2) unsigned NOT NULL,
  `pay_type` char(20) NOT NULL,
  `status` char(20) NOT NULL,
  `time` int(10) NOT NULL,
  `score` int(10) unsigned NOT NULL DEFAULT '0',
  `scookies` text COMMENT '购物车cookie',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `go_member_addmoney_record`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_member_band`
--

CREATE TABLE IF NOT EXISTS `go_member_band` (
  `b_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `b_uid` int(10) DEFAULT NULL COMMENT '用户ID',
  `b_type` char(10) DEFAULT NULL COMMENT '绑定登陆类型',
  `b_code` varchar(100) DEFAULT NULL COMMENT '返回数据1',
  `b_data` varchar(100) DEFAULT NULL COMMENT '返回数据2',
  `b_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`b_id`),
  KEY `b_uid` (`b_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `go_member_band`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_member_cashout`
--

CREATE TABLE IF NOT EXISTS `go_member_cashout` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `username` varchar(20) NOT NULL COMMENT '开户人',
  `bankname` varchar(255) NOT NULL COMMENT '银行名称',
  `branch` varchar(255) NOT NULL COMMENT '支行',
  `money` decimal(8,0) NOT NULL DEFAULT '0' COMMENT '申请提现金额',
  `time` char(20) NOT NULL COMMENT '申请时间',
  `banknumber` varchar(50) NOT NULL COMMENT '银行帐号',
  `linkphone` varchar(100) NOT NULL COMMENT '联系电话',
  `auditstatus` tinyint(4) NOT NULL COMMENT '1审核通过',
  `procefees` decimal(8,2) NOT NULL COMMENT '手续费',
  `reviewtime` char(20) NOT NULL COMMENT '审核通过时间',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `type` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员账户明细' AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `go_member_cashout`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_member_del`
--

CREATE TABLE IF NOT EXISTS `go_member_del` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员表' AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `go_member_del`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_member_dizhi`
--

CREATE TABLE IF NOT EXISTS `go_member_dizhi` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` int(10) NOT NULL COMMENT '用户id',
  `sheng` varchar(15) DEFAULT NULL COMMENT '省',
  `shi` varchar(15) DEFAULT NULL COMMENT '市',
  `xian` varchar(15) DEFAULT NULL COMMENT '县',
  `jiedao` varchar(255) DEFAULT NULL COMMENT '街道地址',
  `youbian` mediumint(8) DEFAULT NULL COMMENT '邮编',
  `shouhuoren` varchar(15) DEFAULT NULL COMMENT '收货人',
  `mobile` char(11) DEFAULT NULL COMMENT '手机',
  `tell` varchar(15) DEFAULT NULL COMMENT '座机号',
  `default` char(1) DEFAULT 'N' COMMENT '是否默认',
  `time` int(10) unsigned NOT NULL,
  `qq` char(20) NOT NULL DEFAULT '' COMMENT 'QQ 号码',
  `shifoufahuo` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否发货！',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员地址表' AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `go_member_dizhi`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_member_go_record`
--

CREATE TABLE IF NOT EXISTS `go_member_go_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(20) DEFAULT NULL COMMENT '订单号',
  `code_tmp` tinyint(3) unsigned DEFAULT NULL COMMENT '相同订单',
  `username` varchar(30) NOT NULL,
  `uphoto` varchar(255) DEFAULT NULL,
  `uid` int(10) unsigned NOT NULL COMMENT '会员id',
  `shopid` int(6) unsigned NOT NULL COMMENT '商品id',
  `shopname` varchar(255) NOT NULL COMMENT '商品名',
  `shopqishu` smallint(6) NOT NULL DEFAULT '0' COMMENT '期数',
  `gonumber` smallint(5) unsigned DEFAULT NULL COMMENT '购买次数',
  `goucode` longtext NOT NULL COMMENT '云购码',
  `moneycount` decimal(10,2) NOT NULL,
  `huode` char(50) NOT NULL DEFAULT '0' COMMENT '中奖码',
  `pay_type` char(10) DEFAULT NULL COMMENT '付款方式',
  `ip` varchar(255) DEFAULT NULL,
  `status` char(30) DEFAULT NULL COMMENT '订单状态',
  `time` char(21) NOT NULL COMMENT '购买时间',
  `company` char(18) NOT NULL COMMENT '快递单位',
  `company_code` char(20) NOT NULL COMMENT '快递单号',
  `company_money` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `shopid` (`shopid`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='云购记录表' AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `go_member_go_record`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_member_group`
--

CREATE TABLE IF NOT EXISTS `go_member_group` (
  `groupid` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(15) NOT NULL COMMENT '会员组名',
  `jingyan_start` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '需要的经验值',
  `jingyan_end` int(10) NOT NULL,
  `icon` varchar(255) DEFAULT NULL COMMENT '图标',
  `type` char(1) NOT NULL DEFAULT 'N' COMMENT '是否是系统组',
  PRIMARY KEY (`groupid`),
  KEY `jingyan` (`jingyan_start`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='会员权限组' AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `go_member_group`
--

INSERT INTO `go_member_group` (`groupid`, `name`, `jingyan_start`, `jingyan_end`, `icon`, `type`) VALUES
(1, '云购新手', 0, 500, NULL, 'N'),
(2, '云购小将', 501, 1000, NULL, 'N'),
(3, '云购中将', 1001, 3000, NULL, 'N'),
(4, '云购上将', 3001, 6000, NULL, 'N'),
(5, '云购大将', 6001, 20000, NULL, 'N'),
(6, '云购将军', 20001, 40000, NULL, 'N');

-- --------------------------------------------------------

--
-- 表的结构 `go_member_message`
--

CREATE TABLE IF NOT EXISTS `go_member_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(1) DEFAULT '0' COMMENT '消息来源,0系统,1私信',
  `sendid` int(10) unsigned DEFAULT '0' COMMENT '发送人ID',
  `sendname` char(20) DEFAULT NULL COMMENT '发送人名',
  `content` varchar(255) DEFAULT NULL COMMENT '发送内容',
  `time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员消息表' AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `go_member_message`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_member_recodes`
--

CREATE TABLE IF NOT EXISTS `go_member_recodes` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员账户明细';

--
-- 导出表中的数据 `go_member_recodes`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_model`
--

CREATE TABLE IF NOT EXISTS `go_model` (
  `modelid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(10) NOT NULL,
  `table` char(20) NOT NULL,
  PRIMARY KEY (`modelid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='模型表' AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `go_model`
--

INSERT INTO `go_model` (`modelid`, `name`, `table`) VALUES
(1, '云购模型', 'shoplist'),
(2, '文章模型', 'article');

-- --------------------------------------------------------

--
-- 表的结构 `go_navigation`
--

CREATE TABLE IF NOT EXISTS `go_navigation` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 导出表中的数据 `go_navigation`
--

INSERT INTO `go_navigation` (`cid`, `parentid`, `name`, `type`, `url`, `status`, `order`) VALUES
(1, 0, '所有商品', 'index', '/goods_list', 'Y', 5),
(2, 0, '新手指南', 'foot', '/single/newbie', 'Y', 2),
(3, 0, '夺宝圈', 'foot', '/group', 'Y', 2),
(4, 0, '关于一元夺宝', 'foot', '/help/1', 'Y', 1),
(5, 0, '隐私声明', 'foot', '/help/12', 'Y', 1),
(6, 0, '合作专区', 'foot', '/single/business', 'Y', 1),
(7, 0, '友情链接', 'foot', '/link', 'Y', 1),
(8, 0, '联系我们', 'foot', '/help/13', 'Y', 1),
(10, 0, '晒单分享', 'index', '/go/shaidan/', 'Y', 1),
(13, 0, '邀请好友', 'index', '/single/pleasereg', 'Y', 1),
(14, 0, '限时揭晓', 'index', '/go/autolottery', 'Y', 3),
(15, 0, '幸运抽奖', 'index', '/api/plugin/get/egglotter', 'Y', 1),
(16, 0, '最新揭晓', 'index', '/goods_lottery', 'Y', 4),
(17, 0, '夺宝官方QQ群', 'foot', '/group_qq', 'Y', 2);

-- --------------------------------------------------------

--
-- 表的结构 `go_pay`
--

CREATE TABLE IF NOT EXISTS `go_pay` (
  `pay_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pay_name` char(20) NOT NULL,
  `pay_class` char(20) NOT NULL,
  `pay_type` tinyint(3) NOT NULL,
  `pay_thumb` varchar(255) DEFAULT NULL,
  `pay_des` text,
  `pay_start` tinyint(4) NOT NULL,
  `pay_key` text,
  `pay_mobile` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 导出表中的数据 `go_pay`
--

INSERT INTO `go_pay` (`pay_id`, `pay_name`, `pay_class`, `pay_type`, `pay_thumb`, `pay_des`, `pay_start`, `pay_key`, `pay_mobile`) VALUES
(1, '财付通', 'tenpay', 1, 'photo/cft.gif', '腾讯财付通	', 0, 'a:2:{s:2:"id";a:2:{s:4:"name";s:19:"财付通商户号:";s:3:"val";s:0:"";}s:3:"key";a:2:{s:4:"name";s:16:"财付通密钥:";s:3:"val";s:0:"";}}', 0),
(2, '易宝支付', 'yeepay', 1, 'photo/20130929/93656812450898.jpg', '易宝支付', 1, 'a:2:{s:2:"id";a:2:{s:4:"name";s:16:"易宝商户号:";s:3:"val";s:8:"45646546";}s:3:"key";a:2:{s:4:"name";s:13:"易宝密钥:";s:3:"val";s:12:"456464131313";}}', 0),
(3, '汇潮支付', 'ecpss', 1, 'photo/20130929/ecpss.jpg', '汇潮支付', 0, 'a:2:{s:2:"id";a:2:{s:4:"name";s:16:"汇潮商户号:";s:3:"val";s:10:"1531456446";}s:3:"key";a:2:{s:4:"name";s:13:"汇潮密钥:";s:3:"val";s:10:"4536131313";}}', 0),
(4, '支付宝', 'alipay', 3, 'photo/20150817/30078855798842.jpg', '支付宝支付', 1, 'a:3:{s:2:"id";a:2:{s:4:"name";s:19:"支付宝商户号:";s:3:"val";s:16:"2088611087053070";}s:3:"key";a:2:{s:4:"name";s:16:"支付宝密钥:";s:3:"val";s:32:"4gnknh2v1vc3rjsjpukxuk6e1j22htso";}s:4:"user";a:2:{s:4:"name";s:16:"支付宝账号:";s:3:"val";s:17:"lnhome123@163.com";}}', 0),
(5, '手机支付宝支付', 'wapalipay', 1, 'photo/20150817/43563230798865.jpg', '支付宝转账接口\n', 0, 'a:3:{s:2:"id";a:2:{s:4:"name";s:19:"支付宝商户号:";s:3:"val";s:16:"2088611087053070";}s:3:"key";a:2:{s:4:"name";s:16:"支付宝密钥:";s:3:"val";s:32:"4gnknh2v1vc3rjsjpukxuk6e1j22htso";}s:4:"user";a:2:{s:4:"name";s:16:"支付宝账号:";s:3:"val";s:17:"lnhome123@163.com";}}', 1),
(6, '云通付', 'shan', 0, 'photo/20160714/59751787473210.png', '云通付', 1, 'a:3:{s:2:"id";a:2:{s:4:"name";s:3:"PID";s:3:"val";s:15:"418768743302445";}s:3:"key";a:2:{s:4:"name";s:3:"KEY";s:3:"val";s:32:"dHmZ2hgKKyp5v4jh8RQWG59rbagigTbd";}s:9:"seller_id";a:2:{s:4:"name";s:9:"商户号";s:3:"val";s:6:"746735";}}', 0),
(7, '云通付手机', 'shan', 0, 'photo/20160714/20235602473228.png', '云通付手机', 1, 'a:3:{s:2:"id";a:2:{s:4:"name";s:3:"PID";s:3:"val";s:0:"";}s:3:"key";a:2:{s:4:"name";s:3:"KEY";s:3:"val";s:0:"";}s:9:"seller_id";a:2:{s:4:"name";s:9:"商户号";s:3:"val";s:0:"";}}', 1),
(8, '微信扫码支付', 'weixin', 0, 'photo/weixin.gif', '微信扫码支付', 0, 'a:2:{s:2:"id";a:2:{s:4:"name";s:9:"商户号";s:3:"val";s:10:"1242516702";}s:3:"key";a:2:{s:4:"name";s:6:"密匙";s:3:"val";s:32:"e10adc3949ba59abbe56e057f20f883e";}}', 0),
(9, '微信支付微信端', 'wxpay_web', 0, 'photo/weixin.gif', '微信支付微信端', 0, 'a:4:{s:5:"APPID";a:2:{s:4:"name";s:5:"APPID";s:3:"val";s:18:"wx07574864e8d99da5";}s:5:"MCHID";a:2:{s:4:"name";s:11:"受理商ID";s:3:"val";s:10:"1254455601";}s:3:"KEY";a:2:{s:4:"name";s:9:"密钥Key";s:3:"val";s:32:"d41d8cd98f00b204e9810998eca8427e";}s:9:"APPSECRET";a:2:{s:4:"name";s:9:"APPSECRET";s:3:"val";s:32:"dc6f2e7e9d04221d0be35d9e8a427ff9";}}', 1),
(10, '银联在线支付', 'unionpay', 0, 'photo/ylzx.gif', '银联在线支付', 0, 'a:3:{s:2:"id";a:2:{s:4:"name";s:16:"银联商户号:";s:3:"val";s:36:"深圳市抢宝城贸易有限公司";}s:3:"key";a:2:{s:4:"name";s:13:"银联密钥:";s:3:"val";s:13:"rftyuikopfghj";}s:4:"user";a:2:{s:4:"name";s:13:"银联账号:";s:3:"val";s:20:"44201610900052519476";}}', 0),
(11, '银联手机在线支付', 'unionpay_web', 0, 'photo/ylzx.gif', '银联手机在线支付', 0, 'a:3:{s:2:"id";a:2:{s:4:"name";s:16:"银联商户号:";s:3:"val";s:36:"深圳市抢宝城贸易有限公司";}s:3:"key";a:2:{s:4:"name";s:13:"银联密钥:";s:3:"val";s:9:"tfgyhujik";}s:4:"user";a:2:{s:4:"name";s:13:"银联账号:";s:3:"val";s:20:"44201610900052519476";}}', 1),
(12, '盛付通', 'shengpay', 0, 'photo/shengpay.gif', '盛付通', 1, 'a:2:{s:2:"id";a:2:{s:4:"name";s:9:"商户号";s:3:"val";s:12:"sduisudiauso";}s:3:"key";a:2:{s:4:"name";s:6:"密匙";s:3:"val";s:18:"djusoaiudjoasdjaso";}}', 0),
(14, '云支付', 'yunpay', 0, 'photo/myun.png', '云支付', 1, 'a:3:{s:2:"id";a:2:{s:4:"name";s:19:"云支付商户号:";s:3:"val";s:14:"56061451458584";}s:3:"key";a:2:{s:4:"name";s:16:"云支付密钥:";s:3:"val";s:32:"3GsTejEaLsSwtsvMDXxfNT3HJVJ5Dq6b";}s:4:"user";a:2:{s:4:"name";s:16:"云支付账号:";s:3:"val";s:16:"623954006@qq.com";}}', 0),
(15, '云支付手机', 'yunpay', 0, 'photo/myun.png', '云支付手机', 1, 'a:3:{s:2:"id";a:2:{s:4:"name";s:19:"云支付商户号:";s:3:"val";s:14:"56061451458584";}s:3:"key";a:2:{s:4:"name";s:16:"云支付密钥:";s:3:"val";s:32:"3GsTejEaLsSwtsvMDXxfNT3HJVJ5Dq6b";}s:4:"user";a:2:{s:4:"name";s:16:"云支付账号:";s:3:"val";s:16:"623954006@qq.com";}}', 1);

-- --------------------------------------------------------

--
-- 表的结构 `go_position`
--

CREATE TABLE IF NOT EXISTS `go_position` (
  `pos_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pos_model` tinyint(3) unsigned NOT NULL,
  `pos_name` varchar(30) NOT NULL,
  `pos_num` tinyint(3) unsigned NOT NULL,
  `pos_maxnum` tinyint(3) unsigned NOT NULL,
  `pos_this_num` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `pos_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pos_id`),
  KEY `pos_id` (`pos_id`),
  KEY `pos_model` (`pos_model`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `go_position`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_position_data`
--

CREATE TABLE IF NOT EXISTS `go_position_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `con_id` int(10) unsigned NOT NULL,
  `mod_id` tinyint(3) unsigned NOT NULL,
  `mod_name` char(20) NOT NULL,
  `pos_id` int(10) unsigned NOT NULL,
  `pos_data` mediumtext NOT NULL,
  `pos_order` int(10) unsigned NOT NULL DEFAULT '1',
  `pos_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `go_position_data`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_qiandao`
--

CREATE TABLE IF NOT EXISTS `go_qiandao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id 值',
  `lianxu` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '连续签到天数',
  `sum` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '总计签到天数',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '签到时间',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk AUTO_INCREMENT=126 ;

--
-- 导出表中的数据 `go_qiandao`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_qqset`
--

CREATE TABLE IF NOT EXISTS `go_qqset` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qq` text CHARACTER SET utf8,
  `name` text CHARACTER SET utf8,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `qqurl` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `full` char(10) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '群是否已经满了',
  `province` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `county` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `subtime` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- 导出表中的数据 `go_qqset`
--

INSERT INTO `go_qqset` (`id`, `qq`, `name`, `type`, `qqurl`, `full`, `province`, `city`, `county`, `subtime`) VALUES
(14, '890890', '90后云购', '地方群', 'http://qun.qq.com/', '已满', '黑龙江省', '鹤岗市', '萝北县', '1470373798'),
(15, '89890890', '80后云购群', '直属群', 'http://qun.qq.com/', '未满', '省份', '地级市', '市、县级市', '1440475061'),
(16, '8908089', '70后QQ群添加', '直属群', 'http://qun.qq.com/', '未满', '省份', '地级市', '市、县级市', '1440475055');

-- --------------------------------------------------------

--
-- 表的结构 `go_quanzi`
--

CREATE TABLE IF NOT EXISTS `go_quanzi` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` char(15) NOT NULL COMMENT '标题',
  `img` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `chengyuan` mediumint(8) unsigned DEFAULT '0' COMMENT '成员数',
  `tiezi` mediumint(8) unsigned DEFAULT '0' COMMENT '帖子数',
  `guanli` mediumint(8) unsigned NOT NULL COMMENT '管理员',
  `jinhua` smallint(5) unsigned DEFAULT NULL COMMENT '精华帖',
  `jianjie` varchar(255) DEFAULT '暂无介绍' COMMENT '简介',
  `gongao` varchar(255) DEFAULT '暂无' COMMENT '公告',
  `jiaru` char(1) DEFAULT 'Y' COMMENT '申请加入',
  `glfatie` char(1) DEFAULT 'N' COMMENT '发帖权限',
  `time` int(11) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `go_quanzi`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_quanzi_hueifu`
--

CREATE TABLE IF NOT EXISTS `go_quanzi_hueifu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `tzid` int(11) DEFAULT NULL COMMENT '帖子ID匹配',
  `hueifu` text COMMENT '回复内容',
  `hueiyuan` varchar(255) DEFAULT NULL COMMENT '会员',
  `hftime` int(11) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- 导出表中的数据 `go_quanzi_hueifu`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_quanzi_tiezi`
--

CREATE TABLE IF NOT EXISTS `go_quanzi_tiezi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `qzid` int(10) unsigned DEFAULT NULL COMMENT '圈子ID匹配',
  `hueiyuan` varchar(255) DEFAULT NULL COMMENT '会员信息',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `neirong` text COMMENT '内容',
  `hueifu` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '回复',
  `dianji` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `zhiding` char(1) DEFAULT 'N' COMMENT '置顶',
  `jinghua` char(1) DEFAULT 'N' COMMENT '精华',
  `zuihou` varchar(255) DEFAULT NULL COMMENT '最后回复',
  `time` int(10) unsigned DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 导出表中的数据 `go_quanzi_tiezi`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_recom`
--

CREATE TABLE IF NOT EXISTS `go_recom` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '推荐位id',
  `img` varchar(50) DEFAULT NULL COMMENT '推荐位图片',
  `title` varchar(30) DEFAULT NULL COMMENT '推荐位标题',
  `link` varchar(255) DEFAULT '' COMMENT '链接地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `go_recom`
--

INSERT INTO `go_recom` (`id`, `img`, `title`, `link`) VALUES
(3, 'banner/20150823/88514901333105.png', '首页跨栏广告', 'goods_lottery'),
(4, 'banner/20160328/31148918099700.jpg', '美女圈', 'single/business');

-- --------------------------------------------------------

--
-- 表的结构 `go_send`
--

CREATE TABLE IF NOT EXISTS `go_send` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned DEFAULT '0',
  `gid` int(11) unsigned DEFAULT '0' COMMENT '商品ID',
  `username` char(50) CHARACTER SET gbk DEFAULT '' COMMENT '用户名',
  `shoptitle` char(120) CHARACTER SET gbk DEFAULT '' COMMENT '商品名称',
  `send_type` tinyint(4) unsigned DEFAULT '0' COMMENT '发送类型',
  `send_time` int(10) unsigned DEFAULT '0' COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='中奖信息发送列表' AUTO_INCREMENT=13 ;

--
-- 导出表中的数据 `go_send`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_shaidan`
--

CREATE TABLE IF NOT EXISTS `go_shaidan` (
  `sd_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '晒单id',
  `sd_userid` int(10) unsigned DEFAULT NULL COMMENT '用户ID',
  `sd_shopid` int(10) unsigned DEFAULT NULL COMMENT '商品ID',
  `sd_qishu` int(10) DEFAULT NULL COMMENT '商品期数',
  `sd_ip` varchar(255) DEFAULT NULL,
  `sd_title` varchar(255) DEFAULT '' COMMENT '晒单标题',
  `sd_thumbs` varchar(255) DEFAULT '' COMMENT '缩略图',
  `sd_content` text COMMENT '晒单内容',
  `sd_photolist` text COMMENT '晒单图片',
  `sd_zhan` int(10) unsigned DEFAULT '0' COMMENT '点赞',
  `sd_ping` int(10) unsigned DEFAULT '0' COMMENT '评论',
  `sd_time` int(10) unsigned DEFAULT NULL COMMENT '晒单时间',
  PRIMARY KEY (`sd_id`),
  KEY `sd_userid` (`sd_userid`),
  KEY `sd_shopid` (`sd_shopid`),
  KEY `sd_zhan` (`sd_zhan`),
  KEY `sd_ping` (`sd_ping`),
  KEY `sd_time` (`sd_time`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='晒单' AUTO_INCREMENT=36 ;

--
-- 导出表中的数据 `go_shaidan`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_shaidan_hueifu`
--

CREATE TABLE IF NOT EXISTS `go_shaidan_hueifu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sdhf_id` int(11) NOT NULL COMMENT '晒单ID',
  `sdhf_userid` int(11) DEFAULT NULL COMMENT '晒单回复会员ID',
  `sdhf_content` text COMMENT '晒单回复内容',
  `sdhf_time` int(11) DEFAULT NULL,
  `sdhf_username` char(20) DEFAULT NULL,
  `sdhf_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- 导出表中的数据 `go_shaidan_hueifu`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_share`
--

CREATE TABLE IF NOT EXISTS `go_share` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- 导出表中的数据 `go_share`
--

INSERT INTO `go_share` (`id`, `uid`, `time`) VALUES
(1, 0, 0),
(2, 0, 0),
(3, 0, 1),
(4, 0, 0),
(5, 0, 1),
(6, 0, 0),
(7, 0, 0),
(8, 0, 0),
(9, 0, 0),
(10, 0, 0),
(11, 0, 0),
(12, 0, 3600),
(13, 0, 1),
(14, 0, 0),
(15, 0, 0),
(16, 0, 0),
(17, 0, 0),
(18, 0, 0),
(19, 0, 1078119275),
(20, 0, 4006810039),
(21, 0, 0),
(22, 0, 0),
(23, 0, 0),
(24, 0, 123456),
(25, 0, 180),
(26, 0, 1),
(27, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `go_shopcodes_1`
--

CREATE TABLE IF NOT EXISTS `go_shopcodes_1` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_id` int(10) unsigned NOT NULL,
  `s_cid` smallint(5) unsigned NOT NULL,
  `s_len` smallint(5) DEFAULT NULL,
  `s_codes` text,
  `s_codes_tmp` text,
  PRIMARY KEY (`id`),
  KEY `s_id` (`s_id`),
  KEY `s_cid` (`s_cid`),
  KEY `s_len` (`s_len`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `go_shopcodes_1`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_shoplist`
--

CREATE TABLE IF NOT EXISTS `go_shoplist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `sid` int(10) unsigned NOT NULL COMMENT '同一个商品',
  `cateid` smallint(6) unsigned DEFAULT NULL COMMENT '所属栏目ID',
  `brandid` smallint(6) unsigned DEFAULT NULL COMMENT '所属品牌ID',
  `title` varchar(100) DEFAULT NULL COMMENT '商品标题',
  `title_style` varchar(100) DEFAULT NULL,
  `title2` varchar(100) DEFAULT NULL COMMENT '副标题',
  `keywords` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '金额',
  `yunjiage` decimal(4,2) unsigned DEFAULT '1.00' COMMENT '云购人次价格',
  `zongrenshu` int(10) unsigned DEFAULT '0' COMMENT '总需人数',
  `canyurenshu` int(10) unsigned DEFAULT '0' COMMENT '已参与人数',
  `shenyurenshu` int(10) unsigned DEFAULT NULL,
  `def_renshu` int(10) unsigned DEFAULT '0',
  `qishu` smallint(6) unsigned DEFAULT '0' COMMENT '期数',
  `maxqishu` smallint(5) unsigned DEFAULT '1' COMMENT ' 最大期数',
  `thumb` varchar(255) DEFAULT NULL,
  `picarr` text COMMENT '商品图片',
  `content` mediumtext COMMENT '商品内容详情',
  `codes_table` char(20) DEFAULT NULL,
  `xsjx_time` int(10) unsigned DEFAULT NULL,
  `pos` tinyint(4) unsigned DEFAULT NULL COMMENT '是否推荐',
  `renqi` tinyint(4) unsigned DEFAULT '0' COMMENT '是否人气商品0否1是',
  `time` int(10) unsigned DEFAULT NULL COMMENT '时间',
  `order` int(10) unsigned DEFAULT '1',
  `q_uid` int(10) unsigned DEFAULT NULL COMMENT '中奖人ID',
  `q_user` text NOT NULL COMMENT '中奖人信息',
  `q_user_code` char(20) DEFAULT NULL COMMENT '中奖码',
  `q_content` mediumtext COMMENT '揭晓内容',
  `q_counttime` char(20) DEFAULT NULL COMMENT '总时间相加',
  `q_end_time` char(20) DEFAULT NULL COMMENT '揭晓时间',
  `q_showtime` char(1) DEFAULT 'N' COMMENT 'Y/N揭晓动画',
  `zhiding` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '指定中奖人',
  PRIMARY KEY (`id`),
  KEY `renqi` (`renqi`),
  KEY `order` (`yunjiage`),
  KEY `q_uid` (`q_uid`),
  KEY `sid` (`sid`),
  KEY `shenyurenshu` (`shenyurenshu`),
  KEY `q_showtime` (`q_showtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品表' AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `go_shoplist`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_shoplist_del`
--

CREATE TABLE IF NOT EXISTS `go_shoplist_del` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `sid` int(10) unsigned NOT NULL COMMENT '同一个商品',
  `cateid` smallint(6) unsigned DEFAULT NULL COMMENT '所属栏目ID',
  `brandid` smallint(6) unsigned DEFAULT NULL COMMENT '所属品牌ID',
  `title` varchar(100) DEFAULT NULL COMMENT '商品标题',
  `title_style` varchar(100) DEFAULT NULL,
  `title2` varchar(100) DEFAULT NULL COMMENT '副标题',
  `keywords` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '金额',
  `yunjiage` decimal(4,2) unsigned DEFAULT '1.00' COMMENT '云购人次价格',
  `zongrenshu` int(10) unsigned DEFAULT '0' COMMENT '总需人数',
  `canyurenshu` int(10) unsigned DEFAULT '0' COMMENT '已参与人数',
  `shenyurenshu` int(10) unsigned DEFAULT NULL,
  `def_renshu` int(10) unsigned DEFAULT '0',
  `qishu` smallint(6) unsigned DEFAULT '0' COMMENT '期数',
  `maxqishu` smallint(5) unsigned DEFAULT '1' COMMENT ' 最大期数',
  `thumb` varchar(255) DEFAULT NULL,
  `picarr` text COMMENT '商品图片',
  `content` mediumtext COMMENT '商品内容详情',
  `codes_table` char(20) DEFAULT NULL,
  `xsjx_time` int(10) unsigned DEFAULT NULL,
  `pos` tinyint(4) unsigned DEFAULT NULL COMMENT '是否推荐',
  `renqi` tinyint(4) unsigned DEFAULT '0' COMMENT '是否人气商品0否1是',
  `time` int(10) unsigned DEFAULT NULL COMMENT '时间',
  `order` int(10) unsigned DEFAULT '1',
  `q_uid` int(10) unsigned DEFAULT NULL COMMENT '中奖人ID',
  `q_user` text NOT NULL COMMENT '中奖人信息',
  `q_user_code` char(20) DEFAULT NULL COMMENT '中奖码',
  `q_content` mediumtext COMMENT '揭晓内容',
  `q_counttime` char(20) DEFAULT NULL COMMENT '总时间相加',
  `q_end_time` char(20) DEFAULT NULL COMMENT '揭晓时间',
  `q_showtime` char(1) DEFAULT 'N' COMMENT 'Y/N揭晓动画',
  `zhiding` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '指定中奖人',
  PRIMARY KEY (`id`),
  KEY `renqi` (`renqi`),
  KEY `order` (`yunjiage`),
  KEY `q_uid` (`q_uid`),
  KEY `sid` (`sid`),
  KEY `shenyurenshu` (`shenyurenshu`),
  KEY `q_showtime` (`q_showtime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品表' AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `go_shoplist_del`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_slide`
--

CREATE TABLE IF NOT EXISTS `go_slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(50) DEFAULT NULL COMMENT '幻灯片',
  `title` varchar(30) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `way` int(1) unsigned DEFAULT '0' COMMENT '手机端的轮播图',
  PRIMARY KEY (`id`),
  KEY `img` (`img`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='幻灯片表' AUTO_INCREMENT=11 ;

--
-- 导出表中的数据 `go_slide`
--

INSERT INTO `go_slide` (`id`, `img`, `title`, `link`, `way`) VALUES
(10, 'banner/20160328/88694467095510.jpg', 'ert', '#', 0);

-- --------------------------------------------------------

--
-- 表的结构 `go_template`
--

CREATE TABLE IF NOT EXISTS `go_template` (
  `template_name` char(25) NOT NULL,
  `template` char(25) NOT NULL,
  `des` varchar(100) DEFAULT NULL,
  KEY `template` (`template`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `go_template`
--

INSERT INTO `go_template` (`template_name`, `template`, `des`) VALUES
('cart.cartlist.html', 'yungou', '购物车列表'),
('cart.pay.html', 'yungou', '购物车付款'),
('cart.paysuccess.html', 'yungou', '购物车支付成功页面'),
('group.index.html', 'yungou', '圈子首页'),
('group.list.html', 'yungou', '圈子列表页'),
('group.nei.html', 'yungou', '圈子内容'),
('group.right.html', 'yungou', '圈子右边'),
('help.help.html', 'yungou', '帮助页面'),
('index.autolottery.html', 'yungou', '限时揭晓'),
('index.buyrecord.html', 'yungou', '夺宝记录'),
('index.buyrecordbai.html', 'yungou', '最新夺宝记录'),
('index.dataserver.html', 'yungou', '已揭晓商品'),
('index.detail.html', 'yungou', '晒单详情'),
('index.footer.html', 'yungou', '底部'),
('index.glist.html', 'yungou', '所有商品'),
('index.header.html', 'yungou', '头部'),
('index.index.html', 'yungou', '首页'),
('index.item.html', 'yungou', '商品展示页'),
('index.lottery.html', 'yungou', '最新揭晓'),
('index.shaidan.html', 'yungou', '晒单页面'),
('link.link.html', 'yungou', '友情链接'),
('member.address.html', 'yungou', '会员地址添加'),
('member.cashout.html', 'yungou', '提现申请'),
('member.commissions.html', 'yungou', '佣金明细'),
('member.index.html', 'yungou', '会员首页'),
('member.invitefriends.html', 'yungou', '邀请好友'),
('member.joingroup.html', 'yungou', '加入的圈子'),
('member.left.html', 'yungou', '会员中心左边页面'),
('member.mailchecking.html', 'yungou', '邮箱认证'),
('member.mobilechecking.htm', 'yungou', '手机认证'),
('member.mobilesuccess.html', 'yungou', '手机认证成功'),
('member.modify.html', 'yungou', '会员'),
('member.orderlist.html', 'yungou', '会员资料'),
('member.password.html', 'yungou', '会员修改密码'),
('member.photo.html', 'yungou', '会员修改头像'),
('member.qqclock.html', 'yungou', '会员QQ绑定'),
('member.record.html', 'yungou', '提现记录'),
('member.sendsuccess.html', 'yungou', '邮箱验证发送'),
('member.sendsuccess2.html', 'yungou', '邮箱验证发送2'),
('member.shezhi.html', 'yungou', '资料选项卡'),
('member.singleinsert.html', 'yungou', '会员添加晒单'),
('member.singlelist.html', 'yungou', '会员晒单'),
('member.singleupdate.html', 'yungou', '晒单修改'),
('member.topic.html', 'yungou', '圈子话题'),
('member.userbalance.html', 'yungou', '账户明细'),
('member.userbuydetail.html', 'yungou', '夺宝记录'),
('member.userbuylist.html', 'yungou', '夺宝记录'),
('member.userfufen.html', 'yungou', '会员福分'),
('member.userrecharge.html', 'yungou', '账户充值'),
('search.search.html', 'yungou', '搜索'),
('single_web.business.html', 'yungou', '单页_合作专区'),
('single_web.fund.html', 'yungou', '单页_云购基金'),
('single_web.newbie.html', 'yungou', '单页_新手指南'),
('single_web.pleasereg.html', 'yungou', '单页_邀请'),
('single_web.qqgroup.html', 'yungou', '单页_QQ'),
('system.message.html', 'yungou', '系统消息提示'),
('us.index.html', 'yungou', '个人主页'),
('us.left.html', 'yungou', '个人主页左边'),
('us.tab.html', 'yungou', '个人主页选项'),
('us.userbuy.html', 'yungou', '个人主页夺宝记录'),
('us.userpost.html', 'yungou', '个人主页夺宝记录'),
('us.userraffle.html', 'yungou', '个人主页夺宝记录'),
('user.emailcheck.html', 'yungou', '邮箱验证'),
('user.emailok.html', 'yungou', '邮箱验证成功'),
('user.findemailcheck.html', 'yungou', '找回密码'),
('user.finderror.html', 'yungou', '邮箱验证已过期'),
('user.findmobilecheck.html', 'yungou', '手机验证'),
('user.findok.html', 'yungou', '手机验证成功'),
('user.findpassword.html', 'yungou', '重置密码'),
('user.login.html', 'yungou', '会员登录'),
('user.mobilecheck.html', 'yungou', '手机验证'),
('user.register.html', 'yungou', '会员注册'),
('vote.show.html', 'yungou', '投票内容页'),
('vote.show_total.html', 'yungou', '投票列表'),
('vote.vote.html', 'yungou', '投票主页'),
('cart.payend.html', 'yungou', ''),
('index.header1.html', 'yungou', ''),
('index.item_animation.html', 'yungou', ''),
('index.item_contents.html', 'yungou', ''),
('index.itemifram.html', 'yungou', ''),
('index.itemiframstory.html', 'yungou', ''),
('index.qq.html', 'yungou', ''),
('index.shaidan123.html', 'yungou', ''),
('member.mobilechecking.htm', 'yungou', ''),
('mobile', 'yungou', '');

-- --------------------------------------------------------

--
-- 表的结构 `go_vote_activer`
--

CREATE TABLE IF NOT EXISTS `go_vote_activer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `vote_id` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `ip` char(20) DEFAULT NULL,
  `subtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `go_vote_activer`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_vote_option`
--

CREATE TABLE IF NOT EXISTS `go_vote_option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `vote_id` int(11) DEFAULT NULL,
  `option_title` varchar(100) DEFAULT NULL,
  `option_number` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `go_vote_option`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_vote_subject`
--

CREATE TABLE IF NOT EXISTS `go_vote_subject` (
  `vote_id` int(11) NOT NULL AUTO_INCREMENT,
  `vote_title` varchar(100) DEFAULT NULL,
  `vote_starttime` int(11) DEFAULT NULL,
  `vote_endtime` int(11) DEFAULT NULL,
  `vote_sendtime` int(11) DEFAULT NULL,
  `vote_description` text,
  `vote_allowview` tinyint(1) DEFAULT NULL,
  `vote_allowguest` tinyint(1) DEFAULT NULL,
  `vote_interval` int(11) DEFAULT '0',
  `vote_enabled` tinyint(1) DEFAULT NULL,
  `vote_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`vote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `go_vote_subject`
--


-- --------------------------------------------------------

--
-- 表的结构 `go_wap`
--

CREATE TABLE IF NOT EXISTS `go_wap` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` char(100) DEFAULT '' COMMENT '广告描述',
  `link` char(255) DEFAULT '' COMMENT '链接地址',
  `img` text COMMENT '图片地址',
  `color` text COMMENT '我也不知道',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=8 ;

--
-- 导出表中的数据 `go_wap`
--

INSERT INTO `go_wap` (`id`, `title`, `link`, `img`, `color`) VALUES
(4, '手机ad3', '#', 'banner/20160615/54619434004074.jpg', '#df4f66');

-- --------------------------------------------------------

--
-- 表的结构 `go_wechat_config`
--

CREATE TABLE IF NOT EXISTS `go_wechat_config` (
  `id` int(1) NOT NULL,
  `token` varchar(100) NOT NULL,
  `appid` char(18) NOT NULL,
  `appsecret` char(32) NOT NULL,
  `access_token` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  `menu` text NOT NULL COMMENT '菜单',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `go_wechat_config`
--

INSERT INTO `go_wechat_config` (`id`, `token`, `appid`, `appsecret`, `access_token`, `dateline`, `menu`) VALUES
(1, 'weixin1234567', 'wx55d4f12057157683', 'ba306c683b09b0a337b0efb146a6d1ba', 'fRcf5ImgIFEy4rOIhMMZgVn9urvz9zrtm1wGmRUSkwijviIuZPJF-boMCuyZel4t5avgBFKKbMMDWn5XYSXwoLEfrvdxUO4zV5KGAgLWsZDq3CESKllIMQkLS68Cff8fXFWgAFADLC', 0, '{"button":[{"name":"最新商品","sub_button":[{"type":"click","name":"新品上市","key":"new"},{"type":"click","name":"热门推荐","key":"tuijian"},{"type":"click","name":"人气商品","key":"renqi"},{"type":"click","name":"最新活动","key":"xinban"},{"type":"click","name":"快递查询","key":"kdcx"}]},{"name":"会员中心","sub_button":[{"type":"click","name":"积分查询","key":"jfcx"},{"type":"click","name":"订单查询","key":"ddcx"},{"type":"click","name":"领红包","key":"zj"},{"type":"click","name":"会员中心","key":"member"},{"type":"click","name":"签到","key":"qiandao"}]},{"name":"更多","sub_button":[{"type":"view","name":"首页","url":"http://cziyuan.com/"},{"type":"click","name":"系统介绍","key":"hot7"},{"type":"view","name":"去购买","url":"http://cziyuan.com/"},{"type":"click","name":"文本消息","key":"text"},{"type":"click","name":"使用说明","key":"help"}]}]}');

-- --------------------------------------------------------

--
-- 表的结构 `go_weixin_bonus`
--

CREATE TABLE IF NOT EXISTS `go_weixin_bonus` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `type_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `go_weixin_bonus`
--

INSERT INTO `go_weixin_bonus` (`id`, `type_id`) VALUES
(1, 13);

-- --------------------------------------------------------

--
-- 表的结构 `go_weixin_bonus_type`
--

CREATE TABLE IF NOT EXISTS `go_weixin_bonus_type` (
  `type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(60) NOT NULL DEFAULT '',
  `type_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `send_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `send_start_date` int(11) NOT NULL DEFAULT '0',
  `send_end_date` int(11) NOT NULL DEFAULT '0',
  `total` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '红包总数',
  `getnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '领取数量',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 导出表中的数据 `go_weixin_bonus_type`
--

INSERT INTO `go_weixin_bonus_type` (`type_id`, `type_name`, `type_money`, `send_type`, `send_start_date`, `send_end_date`, `total`, `getnum`) VALUES
(10, '微信关注红包', 10.00, 1, 1442764800, 1506614400, 100, 54),
(13, '新用户送红包啦~', 6.00, 1, 1442073600, 1443456000, 5, 5);

-- --------------------------------------------------------

--
-- 表的结构 `go_weixin_keywords`
--

CREATE TABLE IF NOT EXISTS `go_weixin_keywords` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=120 ;

--
-- 导出表中的数据 `go_weixin_keywords`
--

INSERT INTO `go_weixin_keywords` (`id`, `name`, `keyword`, `type`, `contents`, `pic`, `pic_tit`, `desc`, `pic_url`, `count`, `status`) VALUES
(90, '帮助', 'help', 1, '乐儿：亲，如果想买【商品信息】里没有。\n输入【XX】XX表示您想购买东西的关键字\n如果您更喜欢传统的网页购物，请点击&lt;a href=&quot;http://oo17.cn&quot;&gt;触屏版购物&lt;/a&gt;\n--------其他帮助-------\n输入【积分规则】查看积分获取规则', '', '', '', '', 166, 1),
(109, '帮助中文', '帮助', 1, '乐儿：亲，如果想买【商品信息】里没有。\n输入【XX】XX表示您想购买东西的关键字\n如果您更喜欢传统的网页购物，请点击&lt;a href=&quot;http://oo17.cn&quot;&gt;触屏版购物&lt;/a&gt;\n--------其他帮助-------\n输入【积分规则】查看积分获取规则', '', '', '', '', 2, 1),
(91, '你好', '签到', 1, '乐儿：您好，我是聚天地之灵气，集万物之精华……（此处略去3万字）【乐儿发官方唯一客服】乐儿，有什们可以帮您的吗？\r\n', '', '', '', '', 14, 1),
(105, '文本消息测试', 'text', 1, '您现在看到的公众号平台是我们独立设计完成的接口，完美对接网站现在已有的系统，实现了在微信中的各种功能的完美对接，购买咨询请联系QQ：525292105', '', '', '', '', 105, 1),
(110, '聊天回复', '聊天', 1, '乐儿：亲，您是要跟我聊天吗？这不好吧？我爸比(程序猿)跟我说："我是我们公司的唯一的客服，每个人都需要我的帮助，没时间跟亲聊天的呢！偷偷告诉亲呦，爸比说，如果我聊多了会显得爸比IQ很低的样子哦。" 嘻嘻！', '', '', '', '', 2, 1);

-- --------------------------------------------------------

--
-- 表的结构 `go_weixin_point`
--

CREATE TABLE IF NOT EXISTS `go_weixin_point` (
  `point_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `point_name` varchar(64) NOT NULL DEFAULT '',
  `point_value` int(3) unsigned NOT NULL,
  `point_num` int(3) NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`point_id`),
  UNIQUE KEY `option_name` (`point_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 导出表中的数据 `go_weixin_point`
--

INSERT INTO `go_weixin_point` (`point_id`, `point_name`, `point_value`, `point_num`, `autoload`) VALUES
(1, 'new', 11, 1, 'yes'),
(2, 'best', 22, 1, 'yes'),
(3, 'hot', 33, 1, 'yes'),
(4, 'cxbd', 44, 1, 'no'),
(5, 'ddcx', 55, 1, 'no'),
(6, 'kdcx', 66, 1, 'no'),
(8, 'qiandao', 77, 1, 'yes');

-- --------------------------------------------------------

--
-- 表的结构 `go_weixin_point_record`
--

CREATE TABLE IF NOT EXISTS `go_weixin_point_record` (
  `pr_id` int(7) NOT NULL AUTO_INCREMENT,
  `wxid` char(28) NOT NULL,
  `point_name` varchar(64) NOT NULL,
  `num` int(5) NOT NULL,
  `lasttime` int(10) NOT NULL,
  `datelinie` int(10) NOT NULL,
  `total` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '总共签到次数',
  PRIMARY KEY (`pr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=277 ;

--
-- 导出表中的数据 `go_weixin_point_record`
--

INSERT INTO `go_weixin_point_record` (`pr_id`, `wxid`, `point_name`, `num`, `lasttime`, `datelinie`, `total`) VALUES
(65, 'o9xy7twhjjlpiMFDyMCqp42XFDTI', 'qiandao', 1, 1455603001, 1443180581, 20),
(76, 'o9xy7t_IssEufZ_YXkcaPmSil5Zs', 'new', 1, 1443612748, 1443612748, 1),
(66, 'o9xy7t-vQeysQ7eg7gcm0k3fSyD8', 'new', 1, 1443258702, 1443258702, 1),
(67, 'o9xy7t1irXD3ZP2EY5rFU48qY80Q', 'ddcx', 1, 1443258892, 1443258892, 1),
(68, 'o9xy7t1irXD3ZP2EY5rFU48qY80Q', 'new', 1, 1443258936, 1443258936, 1),
(69, 'o9xy7t7AEBh4i7a8lluLn045wkv8', 'kdcx', 0, 1444383356, 1443272980, 1),
(70, 'o9xy7t7AEBh4i7a8lluLn045wkv8', 'new', 1, 1444383356, 1443273035, 3),
(71, 'o9xy7t7AEBh4i7a8lluLn045wkv8', 'cxbd', 0, 1444383356, 1443273326, 1),
(72, 'o9xy7t7Lo3yjgpT2qWnMga6iOefM', 'new', 1, 1443278093, 1443278093, 1),
(73, 'o9xy7twhjjlpiMFDyMCqp42XFDTI', 'new', 0, 1455603001, 1443338528, 18),
(74, 'o9xy7twhjjlpiMFDyMCqp42XFDTI', 'ddcx', 0, 1455603001, 1443339039, 8),
(75, 'o9xy7t9JB177xJ9NyI2kI6Lf6hGs', 'new', 1, 1443346790, 1443346790, 1),
(77, 'o9xy7t1Y1NfTzkyEs2Mwys_xEelk', 'new', 1, 1443714737, 1443714737, 1),
(78, 'o9xy7t9ITw135a26zDSSKoc9bmZY', 'new', 1, 1444039980, 1444039980, 1),
(79, 'o9xy7t32i0kxKX-tN6ZJWlnp-_AU', 'new', 1, 1444041645, 1444041645, 1),
(80, 'o9xy7t32i0kxKX-tN6ZJWlnp-_AU', 'qiandao', 1, 1444041908, 1444041908, 1),
(81, 'o9xy7t2JVDfdndb03lx7wfKkKCn4', 'new', 1, 1444296222, 1444296222, 1),
(82, 'o9xy7t2JVDfdndb03lx7wfKkKCn4', 'qiandao', 1, 1444296257, 1444296257, 1),
(83, 'o9xy7t1ZMDRRW9pW0iz7bb-9ix2k', 'new', 1, 1444298273, 1444298273, 1),
(84, 'o9xy7tzGx9I3Gxz2505JvIrYDGh4', 'new', 1, 1444371067, 1444371067, 1),
(85, 'o9xy7t05zH6Zd-cTDrXNGQOnMK3s', 'qiandao', 1, 1444378298, 1444378298, 1),
(86, 'o9xy7t05zH6Zd-cTDrXNGQOnMK3s', 'cxbd', 1, 1444378321, 1444378321, 1),
(87, 'o9xy7t05zH6Zd-cTDrXNGQOnMK3s', 'new', 1, 1444378515, 1444378515, 1),
(101, 'o9xy7t73eqeAW4h_8fJRYR6ejNXE', 'new', 1, 1448376746, 1447852375, 3),
(88, 'o9xy7twR73w1YyJPmjs8FxFfy_PI', 'new', 1, 1444545458, 1444545458, 1),
(89, 'o9xy7t5H8f1gd3VWW0KLyCI0m3Fk', 'qiandao', 1, 1444564106, 1444564106, 1),
(90, 'o9xy7t2jXwd8UDJ4knaSBjRUHQhU', 'new', 1, 1445146480, 1444702135, 2),
(91, 'o9xy7t_mJ5rcQev4gKaiXlhgXM_I', 'new', 1, 1452154262, 1444740030, 3),
(92, 'o9xy7t_mJ5rcQev4gKaiXlhgXM_I', 'qiandao', 0, 1452154262, 1444741366, 1),
(93, 'o9xy7t6pR9sr1o-0F-SleJuZeb34', 'new', 1, 1444742847, 1444742847, 1),
(94, 'o9xy7tw-FygTHTllUBbCW_nkI_f4', 'new', 1, 1444744151, 1444744151, 1),
(95, 'o9xy7t6SFYJRMFm2O194iG47nvgI', 'new', 1, 1444744809, 1444744809, 1),
(96, 'o9xy7tzyA5odVKZ8J8GUxVB0kSbs', 'new', 1, 1445049260, 1444758806, 2),
(97, 'o9xy7t6WuTCH1wLhFKbTCtnciE54', 'new', 1, 1444806649, 1444806649, 1),
(98, 'o9xy7tyXsruu0PxyDU25Ff175t84', 'new', 1, 1445065334, 1445065334, 1),
(99, 'o9xy7tzuTyq-0_Mv-pDGYLzNxsZc', 'new', 1, 1446804844, 1446804844, 1),
(100, 'o9xy7tzuTyq-0_Mv-pDGYLzNxsZc', 'qiandao', 1, 1447567651, 1447567651, 1),
(102, 'o9xy7tx4zD3s55qu29FRW672NN9A', 'qiandao', 1, 1448013899, 1448013899, 1),
(103, 'o9xy7tx4zD3s55qu29FRW672NN9A', 'new', 1, 1448013905, 1448013905, 1),
(104, 'o9xy7t0RULnkToQOQyMmyOxUXqkA', 'new', 1, 1450777441, 1448116467, 2),
(105, 'o9xy7t0RULnkToQOQyMmyOxUXqkA', 'qiandao', 0, 1450777441, 1448116473, 1),
(106, 'o9xy7t0gnjzFFM1uORUuuw5fPVek', 'new', 1, 1448121085, 1448121085, 1),
(107, 'o9xy7t7TZuxWULUmra9oHJ5WweL4', 'new', 1, 1448248664, 1448248664, 1),
(108, 'o9xy7t7TZuxWULUmra9oHJ5WweL4', 'kdcx', 1, 1448270500, 1448270500, 1),
(109, 'o9xy7t7TZuxWULUmra9oHJ5WweL4', 'ddcx', 1, 1448270508, 1448270508, 1),
(110, 'o9xy7twUWwnIbws0oMowxYF-7bXE', 'new', 1, 1448369406, 1448369406, 1),
(111, 'o9xy7t0QzG6kCPucM78WtYj7DN_s', 'qiandao', 1, 1448438947, 1448438947, 1),
(112, 'o9xy7t0QzG6kCPucM78WtYj7DN_s', 'new', 1, 1448439090, 1448439090, 1),
(146, 'o9xy7t3TWMGyD0pRAjrgmWprdcpc', 'new', 1, 1452632830, 1450159725, 2),
(113, 'o9xy7t53IsJB1_pqeOZhbfmVFsXg', 'new', 1, 1451645751, 1448644845, 2),
(114, 'o9xy7t53IsJB1_pqeOZhbfmVFsXg', 'qiandao', 0, 1451645751, 1448653521, 1),
(115, 'o9xy7t7Up9zrm3-6fz0wonWcZXEM', 'new', 1, 1448680719, 1448680719, 1),
(116, 'o9xy7t7Up9zrm3-6fz0wonWcZXEM', 'qiandao', 1, 1448706805, 1448706805, 1),
(117, 'o9xy7t1OjVvvO8sCseMyMj0WRfls', 'new', 1, 1448774984, 1448774984, 1),
(118, 'o9xy7t1PFdjBpxM0SqySAJUOQTTU', 'new', 1, 1449831442, 1448864623, 2),
(119, 'o9xy7t1PFdjBpxM0SqySAJUOQTTU', 'qiandao', 0, 1449831442, 1448867887, 2),
(120, 'o9xy7t-wk0NQVsuMxvBoAnbui7_4', 'new', 1, 1449022894, 1449022894, 1),
(121, 'o9xy7t64_pjyGJBx2Z7TFmjHTH2c', 'new', 1, 1449325315, 1449325315, 1),
(122, 'o9xy7tyZQ6QTMXM7-Xqodw8sp2is', 'new', 1, 1449330419, 1449330419, 1),
(123, 'o9xy7t1PFdjBpxM0SqySAJUOQTTU', 'ddcx', 0, 1449831442, 1449486558, 1),
(124, 'o9xy7t6SqIUQqdS3ZP6-HXx5NmHM', 'qiandao', 1, 1450267817, 1449488404, 2),
(125, 'o9xy7t8CzztwJ0S6CQH21lYa9RZU', 'new', 1, 1449488467, 1449488467, 1),
(126, 'o9xy7t691v17pzl1woWswOvZ8OqU', 'new', 1, 1449496680, 1449496680, 1),
(127, 'o9xy7t_eTfv-Sim_iziAAdx9s-zk', 'new', 1, 1449897740, 1449544649, 2),
(128, 'o9xy7t_uWsSfopFCdKpS0a4V31p0', 'new', 1, 1449641299, 1449641299, 1),
(129, 'o9xy7t08UeDABwDgPZd3jpw6_1js', 'new', 1, 1449650809, 1449650809, 1),
(130, 'o9xy7t9y0lit-YSM7WDGnFfszj4Y', 'new', 1, 1449661099, 1449661099, 1),
(131, 'o9xy7twWxV8GhGv5rUA_xde4dQ24', 'new', 1, 1449732071, 1449732071, 1),
(132, 'o9xy7t6E01PcPk3MZzAzxYNjHzo4', 'new', 1, 1449735261, 1449735261, 1),
(133, 'o9xy7t3x4vlSPfVwl2ZCZJ6y-dGM', 'new', 1, 1449737501, 1449737501, 1),
(134, 'o9xy7t4NDygL8_dh5cxDlRiUyC7I', 'new', 1, 1449738344, 1449738344, 1),
(135, 'o9xy7t4NDygL8_dh5cxDlRiUyC7I', 'qiandao', 1, 1449739324, 1449739324, 1),
(136, 'o9xy7t_fwzKxWrEDIQpUB7zpr1Ag', 'new', 1, 1449846944, 1449846944, 1),
(137, 'o9xy7t_eTfv-Sim_iziAAdx9s-zk', 'qiandao', 1, 1449897764, 1449897764, 1),
(138, 'o9xy7twJBtwvpIrqyXEsUHvp8OwE', 'new', 1, 1450005130, 1450005130, 1),
(139, 'o9xy7t5Lib83t40bWkvopdEXSBaM', 'new', 1, 1450005276, 1450005276, 1),
(140, 'o9xy7t-ER77Nu2q_fw4mx7ygcTRg', 'new', 1, 1450006875, 1450006875, 1),
(141, 'o9xy7tylWanP2qJpqKDRSR6PADrg', 'new', 1, 1450018290, 1450018290, 1),
(142, 'o9xy7t5eD81bZrCjxdJSYO36CbmQ', 'new', 1, 1450062957, 1450062957, 1),
(143, 'o9xy7t8h0DYnZ_bcINT5B9lt0MII', 'qiandao', 1, 1450156439, 1450156439, 1),
(144, 'o9xy7t8h0DYnZ_bcINT5B9lt0MII', 'new', 1, 1450156447, 1450156447, 1),
(145, 'o9xy7txdy5A_daaBSFIXRQEpTZSM', 'new', 1, 1450159429, 1450159429, 1),
(165, 'o9xy7t2jBHCR3X9Vuktp_gJ17NDw', 'ddcx', 0, 1451123609, 1450801742, 1),
(147, 'o9xy7t-VU-RE5wkluKkva-0FP_8g', 'new', 1, 1450164983, 1450164983, 1),
(148, 'o9xy7t_fDDe2QX2U7F27Fv0BnpX0', 'new', 1, 1450262572, 1450262572, 1),
(149, 'o9xy7t4Sr0Pim8IUGramZ8SdvH4g', 'qiandao', 1, 1451388760, 1450273104, 2),
(150, 'o9xy7t4Sr0Pim8IUGramZ8SdvH4g', 'new', 1, 1451388715, 1450273120, 3),
(151, 'o9xy7t3TWMGyD0pRAjrgmWprdcpc', 'qiandao', 1, 1452633119, 1450280775, 2),
(152, 'o9xy7t_PC6-zeb-l2XQ_fTlmX-CQ', 'new', 1, 1450355551, 1450355551, 1),
(153, 'o9xy7t3zCayL3wjnUlGiH6FxYevY', 'new', 1, 1450699651, 1450452365, 2),
(154, 'o9xy7tzKgEVdAs_ue4vFxtw23J-g', 'new', 1, 1450532983, 1450532983, 1),
(155, 'o9xy7t2jBHCR3X9Vuktp_gJ17NDw', 'new', 1, 1451123609, 1450599602, 3),
(156, 'o9xy7t-1B8RW5rjcoeWLkLH8E3bk', 'new', 1, 1450693086, 1450693086, 1),
(157, 'o9xy7t3zCayL3wjnUlGiH6FxYevY', 'ddcx', 1, 1450700814, 1450700814, 1),
(158, 'o9xy7t_udKsQbG9U5KRNCUEn9lCc', 'new', 1, 1450700924, 1450700924, 1),
(159, 'o9xy7t2jBHCR3X9Vuktp_gJ17NDw', 'qiandao', 0, 1451123609, 1450720343, 1),
(160, 'o9xy7t1syaoAkP_TKWzAye37xrbU', 'qiandao', 1, 1450723247, 1450723247, 1),
(161, 'o9xy7t1syaoAkP_TKWzAye37xrbU', 'new', 1, 1450723264, 1450723264, 1),
(162, 'o9xy7txOnGLC9KWfCESGoGkecfqI', 'new', 1, 1450749787, 1450749787, 1),
(163, 'o9xy7t9gpx40b7FJU_V8Pni54XIE', 'new', 1, 1450750669, 1450750669, 1),
(164, 'o9xy7t8NlgujAimrIMfUubbCgTUY', 'new', 1, 1451147815, 1450759442, 3),
(166, 'o9xy7tyffqKjbnSmFgzkKwZK6VVA', 'new', 1, 1450844116, 1450844116, 1),
(167, 'o9xy7t8NlgujAimrIMfUubbCgTUY', 'qiandao', 1, 1451147848, 1450870138, 2),
(168, 'o9xy7twZ2skQDbea2O-A7TciDbAo', 'new', 1, 1450875101, 1450875101, 1),
(169, 'o9xy7t-nZtYKmJuFfh2diW7YnU4Q', 'new', 1, 1450875764, 1450875764, 1),
(170, 'o9xy7t-nZtYKmJuFfh2diW7YnU4Q', 'qiandao', 1, 1450875929, 1450875929, 1),
(171, 'o9xy7t958OTBcU4LMnH3SdDB73AM', 'new', 1, 1450920887, 1450920887, 1),
(172, 'o9xy7tzQBZS-9ssTDNs_l7ii2hTQ', 'qiandao', 1, 1450938349, 1450938349, 1),
(173, 'o9xy7t7T2rEq3HHNtJ5MpP4eGmKw', 'new', 1, 1450943565, 1450943565, 1),
(174, 'o9xy7t-DeesA7-Msl3I7lek-tkWo', 'new', 1, 1451106794, 1451106794, 1),
(175, 'o9xy7t9AhGj-WOxjJMso5HcLmCG4', 'new', 1, 1451148099, 1451148099, 1),
(176, 'o9xy7t6w9vZWzSWiIYYEypFgn29w', 'new', 1, 1451179371, 1451179371, 1),
(177, 'o9xy7t6w9vZWzSWiIYYEypFgn29w', 'qiandao', 1, 1451179864, 1451179864, 1),
(178, 'o9xy7t_g1kV4QHN_ey7leQPMu5Wo', 'new', 1, 1451190230, 1451190230, 1),
(179, 'o9xy7twMlOxRrgqGMBGeTLhP61oU', 'new', 1, 1452885332, 1451228187, 3),
(180, 'o9xy7t3UGCrRmYbMb9c0CJ7ZDz6s', 'new', 1, 1451286524, 1451286524, 1),
(181, 'o9xy7twMlOxRrgqGMBGeTLhP61oU', 'qiandao', 0, 1452885332, 1451288508, 1),
(182, 'o9xy7t7m8ZymNu7rS1ue8ctqLKbY', 'new', 1, 1451310066, 1451310066, 1),
(183, 'o9xy7t7m8ZymNu7rS1ue8ctqLKbY', 'qiandao', 1, 1451310155, 1451310155, 1),
(184, 'o9xy7t05wqNVSiRxle2Qy8bey1-s', 'qiandao', 1, 1451310452, 1451310452, 1),
(185, 'o9xy7t92OlzVQIVEyYDDbVSnW0fQ', 'new', 1, 1451458186, 1451360145, 2),
(186, 'o9xy7t_lf5NVyyzXV6ySR18qxYcM', 'new', 1, 1451633085, 1451367782, 2),
(187, 'o9xy7t_lf5NVyyzXV6ySR18qxYcM', 'qiandao', 1, 1451569681, 1451368011, 2),
(188, 'o9xy7t3NDUMIzDavncIE-hIdZBpc', 'new', 1, 1451372449, 1451372449, 1),
(189, 'o9xy7t4SIbip0YVQ6KdxI6QUZNK4', 'new', 1, 1451373327, 1451373327, 1),
(190, 'o9xy7t4Sr0Pim8IUGramZ8SdvH4g', 'ddcx', 1, 1451388743, 1451388743, 1),
(191, 'o9xy7t_g1kV4QHN_ey7leQPMu5Wo', 'qiandao', 1, 1451442379, 1451442379, 1),
(192, 'o9xy7t92OlzVQIVEyYDDbVSnW0fQ', 'qiandao', 0, 1451458186, 1451458162, 1),
(193, 'o9xy7t1Q1DVnLMUKRevtM7gsNJDs', 'new', 1, 1451458563, 1451458563, 1),
(194, 'o9xy7t5F6sf68lPY5dUBTuOvzZGo', 'new', 1, 1451489239, 1451489239, 1),
(197, 'o9xy7t8TC0D24Pd-cV89IbjUixvc', 'new', 1, 1451802468, 1451802468, 1),
(195, 'o9xy7t3IeLxHj5uR2bHOWKyk0CTo', 'new', 1, 1451633373, 1451633373, 1),
(196, 'o9xy7t4TAR7Nvu6CCazAv4keIPHc', 'new', 1, 1451637494, 1451637494, 1),
(198, 'o9xy7twTPYWfk9X-4SJS-A4f-LyI', 'new', 1, 1451818683, 1451818683, 1),
(199, 'o9xy7twYEbwsweb76BDmvO5Smuoc', 'qiandao', 1, 1451890674, 1451890674, 1),
(200, 'o9xy7twYEbwsweb76BDmvO5Smuoc', 'new', 1, 1451895866, 1451895866, 1),
(201, 'o9xy7t0_aBUU-aT7mw9j-7Pasbs8', 'new', 1, 1452086256, 1451901128, 2),
(202, 'o9xy7t39u3wTTqZKw89VVvIR6vjQ', 'qiandao', 1, 1451963930, 1451963930, 1),
(231, 'o9xy7t30MmbcS-K-PaG8MJngmtGk', 'new', 1, 1453976104, 1453059703, 3),
(203, 'o9xy7t8ASHLgmGkL1T9_IqJDJ1Dc', 'new', 1, 1452069375, 1452069375, 1),
(204, 'o9xy7t_B_KPUnHW-joNldLrZ6BXY', 'new', 1, 1452069883, 1452069883, 1),
(205, 'o9xy7t6vQkd4zSNhR1IFkr9zqGRM', 'new', 1, 1452080289, 1452080289, 1),
(206, 'o9xy7t6V3bbKR4AaaxhC5sCY5BsU', 'new', 1, 1452694616, 1452090447, 4),
(207, 'o9xy7t0pnYKw5uq-AFifBA7l8PT8', 'new', 1, 1452142854, 1452142854, 1),
(208, 'o9xy7t79rZK428QGk4wyHgx4j1g8', 'new', 1, 1452312489, 1452164774, 2),
(209, 'o9xy7t5RrNFAho2qgQR7gT9uM7vQ', 'new', 1, 1452188720, 1452188720, 1),
(210, 'o9xy7t3-nRYcu853jgzjWOnm8DAk', 'new', 1, 1452204208, 1452204208, 1),
(211, 'o9xy7twycCDXeVRPBF7pLVv6b5Rg', 'new', 1, 1452217210, 1452217210, 1),
(212, 'o9xy7t1Mp_vrYQ72mDydwLhI67Jo', 'new', 0, 1454062706, 1452230791, 1),
(213, 'o9xy7t1Mp_vrYQ72mDydwLhI67Jo', 'qiandao', 1, 1454062706, 1452230803, 2),
(214, 'o9xy7t0x8MajYBu-Hzd58Yn1vxv0', 'new', 1, 1452356956, 1452356956, 1),
(215, 'o9xy7t5vbEMw2qc4SLg_OlFOfiC0', 'new', 1, 1453733046, 1452391710, 2),
(216, 'o9xy7t5vbEMw2qc4SLg_OlFOfiC0', 'qiandao', 0, 1453733046, 1452398670, 1),
(217, 'o9xy7t6V3bbKR4AaaxhC5sCY5BsU', 'qiandao', 0, 1452694616, 1452487807, 1),
(218, 'o9xy7t4DZoKEMYiEmZnkWqY5oTqo', 'new', 1, 1452505676, 1452505676, 1),
(219, 'o9xy7t4DZoKEMYiEmZnkWqY5oTqo', 'qiandao', 1, 1452507026, 1452507026, 1),
(220, 'o9xy7tx9lhwwJJgaOdrEJaZFYnW4', 'new', 1, 1452511080, 1452511080, 1),
(221, 'o9xy7t4xA0FE0ee2Gg5vqJleTPNQ', 'new', 1, 1453690133, 1452565013, 2),
(222, 'o9xy7t3ChUh5Cfxuvog-IufSngQc', 'new', 1, 1452583909, 1452583909, 1),
(223, 'o9xy7txV7IXhEIGSdPvfgtOXIXNM', 'new', 1, 1452825571, 1452590750, 2),
(224, 'o9xy7t9qkQzwZdCjZFzpSC0ueiN8', 'qiandao', 1, 1452658374, 1452658374, 1),
(225, 'o9xy7t9qkQzwZdCjZFzpSC0ueiN8', 'new', 1, 1452658377, 1452658377, 1),
(226, 'o9xy7t1lPKC3EFuGScXp05nyxIsc', 'qiandao', 1, 1452743376, 1452743376, 1),
(227, 'o9xy7t_JVrWBvov5baI-dDEXhFcQ', 'new', 1, 1452744254, 1452744254, 1),
(228, 'o9xy7t_ijISyMn41j2AnqnygpI9M', 'new', 1, 1452783154, 1452783154, 1),
(229, 'o9xy7twtzsMHZKuEVAoCOOdkFzZE', 'new', 1, 1452858948, 1452858948, 1),
(230, 'o9xy7tyUHWmTMnt8ERWBEg5jrdGw', 'new', 1, 1453011138, 1453011138, 1),
(232, 'o9xy7t-6wxuSCUXXBvz2y-NLOp2A', 'new', 1, 1453145607, 1453145607, 1),
(233, 'o9xy7t-PocFoXIOZ-PflEIkc2lyo', 'qiandao', 1, 1453171974, 1453171974, 1),
(234, 'o9xy7t-PocFoXIOZ-PflEIkc2lyo', 'new', 1, 1453193238, 1453193238, 1),
(235, 'o9xy7t-PocFoXIOZ-PflEIkc2lyo', 'ddcx', 1, 1453206448, 1453206448, 1),
(236, 'o9xy7t0_aBUU-aT7mw9j-7Pasbs8', 'qiandao', 1, 1453214866, 1453214866, 1),
(237, 'o9xy7t0VTWO9CqRlvsJOmJQRgCPU', 'new', 1, 1454067085, 1453252216, 2),
(238, 'o9xy7ty3z_NfTuedIIQgQrhIU8N4', 'new', 1, 1453260215, 1453260215, 1),
(239, 'o9xy7t0zqo3S64o74sY1u28PGPw4', 'new', 1, 1453345913, 1453345913, 1),
(240, 'o9xy7t1hvqDLgNi_t-6n0tiuWkHA', 'new', 0, 1453697684, 1453362684, 1),
(241, 'o9xy7t1hvqDLgNi_t-6n0tiuWkHA', 'qiandao', 1, 1453697684, 1453363102, 2),
(242, 'o9xy7t1hvqDLgNi_t-6n0tiuWkHA', 'ddcx', 1, 1453697688, 1453363118, 2),
(243, 'o9xy7txSIrYMRrtXyZG2JHK4UUYw', 'new', 1, 1453466724, 1453466724, 1),
(244, 'o9xy7tw1U-3IL0so-TXxpPIVnvXw', 'new', 1, 1453471265, 1453471265, 1),
(245, 'o9xy7t8-ihMXrHSAmm9guSmtBdhM', 'new', 1, 1453531301, 1453531301, 1),
(246, 'o9xy7tw1U-3IL0so-TXxpPIVnvXw', 'qiandao', 1, 1453547333, 1453547333, 1),
(247, 'o9xy7t778dGXm6wBfmctLQKy-S4U', 'new', 1, 1453593934, 1453593934, 1),
(248, 'o9xy7t778dGXm6wBfmctLQKy-S4U', 'qiandao', 1, 1453593988, 1453593988, 1),
(249, 'o9xy7twFe29rEJzokTS3EqISiNCI', 'new', 1, 1453693146, 1453693146, 1),
(250, 'o9xy7t5xR8h04uMepZ9AMX9oHuqA', 'new', 1, 1453813056, 1453813056, 1),
(251, 'o9xy7t5xR8h04uMepZ9AMX9oHuqA', 'qiandao', 1, 1453813085, 1453813085, 1),
(252, 'o9xy7t8fQSXPjV4gHzEN38yypccQ', 'new', 1, 1453818827, 1453818827, 1),
(253, 'o9xy7t1lPKC3EFuGScXp05nyxIsc', 'new', 1, 1453870695, 1453870695, 1),
(254, 'o9xy7t7yY-ulqe5usw3LT7nfuG40', 'new', 1, 1453871717, 1453871717, 1),
(255, 'o9xy7t9oq-sFyU7w6_Qn4eVe_bPM', 'qiandao', 1, 1454830498, 1453971912, 3),
(256, 'o9xy7t0FIIgNWipqD75d0GuJDV0Y', 'new', 1, 1454209656, 1454209656, 1),
(257, 'o9xy7tyoROjfT_ZEh5q13-8U4NOc', 'qiandao', 1, 1454292397, 1454292397, 1),
(258, 'o9xy7t4bjVmx41rO0andC4P1lBWY', 'new', 1, 1454429092, 1454429092, 1),
(259, 'o9xy7t-TmAnuROEZZdCnF9PGXH24', 'new', 1, 1455031309, 1454513800, 2),
(260, 'o9xy7t-TmAnuROEZZdCnF9PGXH24', 'qiandao', 1, 1455031291, 1454513900, 2),
(261, 'o9xy7txv4AWbxG8aEjnitg3bR4qc', 'new', 1, 1455465518, 1454838464, 3),
(262, 'o9xy7txv4AWbxG8aEjnitg3bR4qc', 'qiandao', 0, 1455465518, 1454892700, 1),
(263, 'o9xy7t76KKlLKT8V929FQ6GqzE4g', 'new', 1, 1455004967, 1455004967, 1),
(264, 'o9xy7txAnMuWcQiD6SjTdzzW5wxo', 'new', 1, 1455444975, 1455018742, 2),
(265, 'o9xy7txAnMuWcQiD6SjTdzzW5wxo', 'qiandao', 1, 1455525316, 1455028664, 2),
(266, 'o9xy7t7dxMdn8Z2Idh8vd4DidQmQ', 'qiandao', 1, 1455848470, 1455523262, 2),
(267, 'o9xy7t8Z_kky0yHv7rXlec7Upw9s', 'new', 1, 1455612321, 1455612321, 1),
(268, 'o9xy7tzIIQOQUjgWWMmFHbrtQotk', 'new', 1, 1455890831, 1455687832, 2),
(269, 'o9xy7t7dxMdn8Z2Idh8vd4DidQmQ', 'new', 0, 1455848470, 1455848464, 1),
(270, 'o9xy7t570TnLT48xCt9J995ycMK0', 'new', 1, 1455848880, 1455848880, 1),
(271, 'o9xy7t1ueyg5pslekzwo9ZveTSfY', 'new', 1, 1455848946, 1455848946, 1),
(272, 'o9xy7tziHu9ygU4jCauWsNv7Sfnk', 'qiandao', 1, 1455887433, 1455887433, 1),
(273, 'o9xy7tziHu9ygU4jCauWsNv7Sfnk', 'new', 1, 1455887435, 1455887435, 1),
(274, 'o9xy7tzIIQOQUjgWWMmFHbrtQotk', 'qiandao', 1, 1455890864, 1455890864, 1),
(275, 'o9xy7t7ua68Kv5sfsNb9A9qqTb6c', 'qiandao', 1, 1455895600, 1455895600, 1),
(276, 'o9xy7t7ua68Kv5sfsNb9A9qqTb6c', 'new', 1, 1455895636, 1455895636, 1);

-- --------------------------------------------------------

--
-- 表的结构 `go_weixin_sign`
--

CREATE TABLE IF NOT EXISTS `go_weixin_sign` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id\r\n',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否领取过',
  `input_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '领取时间',
  `typeid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '红包类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk COMMENT='回复关键字赠送现金活动' AUTO_INCREMENT=49 ;

--
-- 导出表中的数据 `go_weixin_sign`
--

INSERT INTO `go_weixin_sign` (`id`, `uid`, `status`, `input_time`, `typeid`) VALUES
(2, 271, 1, 1449579370, 10),
(3, 281, 1, 1449650825, 10),
(4, 274, 1, 1450004504, 10),
(5, 304, 1, 1450006389, 10),
(6, 306, 1, 1450022229, 10),
(7, 308, 1, 1450175287, 10),
(8, 333, 1, 1450267827, 10),
(9, 336, 1, 1450273111, 10),
(10, 321, 1, 1450289887, 10),
(11, 350, 1, 1450599623, 10),
(12, 345, 1, 1450699634, 10),
(13, 357, 1, 1450723236, 10),
(14, 361, 1, 1450775530, 10),
(15, 356, 1, 1450777431, 10),
(16, 364, 1, 1450855662, 10),
(17, 360, 1, 1450870130, 10),
(18, 367, 1, 1450875918, 10),
(19, 411, 1, 1451890610, 10),
(20, 421, 1, 1452069424, 10),
(21, 423, 1, 1452080207, 10),
(22, 424, 1, 1452086413, 10),
(23, 407, 1, 1452144612, 10),
(24, 432, 1, 1452164670, 10),
(25, 448, 1, 1452398658, 10),
(26, 452, 1, 1452439702, 10),
(27, 457, 1, 1452506988, 10),
(28, 460, 1, 1452527286, 10),
(29, 461, 1, 1452583914, 10),
(30, 467, 1, 1452661138, 10),
(31, 425, 1, 1452748186, 10),
(32, 489, 1, 1452871106, 10),
(33, 375, 1, 1452885341, 10),
(34, 513, 1, 1453171969, 10),
(35, 511, 1, 1453362680, 10),
(36, 535, 1, 1453466713, 10),
(37, 536, 1, 1453547324, 10),
(38, 548, 1, 1453720442, 10),
(39, 553, 1, 1453813077, 10),
(40, 557, 1, 1453971917, 10),
(41, 440, 1, 1454062708, 10),
(42, 580, 1, 1454514008, 10),
(43, 586, 1, 1454892865, 10),
(44, 588, 1, 1455523299, 10),
(45, 587, 1, 1455525298, 10),
(46, 595, 1, 1455848940, 10),
(47, 597, 1, 1455887427, 10),
(48, 592, 1, 1455890851, 10);

-- --------------------------------------------------------

--
-- 表的结构 `go_weixin_user`
--

CREATE TABLE IF NOT EXISTS `go_weixin_user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subscribe` tinyint(1) unsigned NOT NULL,
  `wxid` char(28) NOT NULL,
  `nickname` varchar(200) NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '领取时间',
  `typeid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '红包的类型id',
  `headimgurl` varchar(200) NOT NULL,
  `subscribe_time` int(10) unsigned NOT NULL,
  `localimgurl` varchar(200) NOT NULL,
  `setp` smallint(2) unsigned NOT NULL,
  `uname` varchar(50) NOT NULL,
  `coupon` varchar(30) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=123 ;

--
-- 导出表中的数据 `go_weixin_user`
--

INSERT INTO `go_weixin_user` (`uid`, `subscribe`, `wxid`, `nickname`, `sex`, `city`, `country`, `time`, `typeid`, `headimgurl`, `subscribe_time`, `localimgurl`, `setp`, `uname`, `coupon`) VALUES
(88, 0, 'o9xy7t61JluKn93_aJHC1SKQYan4', '乔', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/O3PqTRboYGC4ZD7OCHqOFEzz3p7mllMHVibL8gQa2FamAUsyLq9VW69ibdic4j36vAHFWSdDDuQD0Hia2EDJRSRlEvjeL13VrOmT/0', 0, '', 3, '乔', ''),
(87, 0, 'o9xy7t2jXwd8UDJ4knaSBjRUHQhU', '劉', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/Q3auHgzwzM64XEwfcuicn1FczIe9NfShibRUOHbFPIqaicncDwtVpM4otjvmic5YrDHKIE7XZIWSy0QlUOCno0ZMlQ/0', 0, '', 3, '劉', ''),
(84, 0, 'o9xy7twhjjlpiMFDyMCqp42XFDTI', '银明', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/Fl4XRkC8xdGRGOZ7LRpZCiaBjqRUib2OoNAW1YiatsaosvMGicK1ibeQ7Yic2YXgpH8XicGfiaUF7houPZYJVn3UQTMpnnDGRwp5nJ8I/0', 0, '', 0, '银明', ''),
(85, 0, 'o9xy7t_yNt4kyTfXeb63ioMX8nBU', 'a.纳尼诗.林亮平', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/Q3auHgzwzM4ocJIJSRqgl0jHeq1BrxZxF3va7XgwfEItia3icq6IrnmsSjCPWgbufhia7QnxY6Uu82of7Q1r99dtOLdkaKomHsX5NJIuSjKZO4/0', 0, '', 3, 'a.纳尼诗.林亮平', ''),
(86, 0, 'o9xy7tyAq44fEihvlDXMOOdM8_rc', '哈尔滨麦田科技', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/Fl4XRkC8xdEp7nRm3QSR0VBoUdgastuyQ6xlib4lP6ACHsicYcUwLJGGiah0EdIaqbCFD6mxuOZKpMMQNkkdIt1iaY9Bfeupb3Ts/0', 0, '', 3, '哈尔滨麦田科技', ''),
(89, 0, 'o9xy7t_mJ5rcQev4gKaiXlhgXM_I', '=_=::>困<::=_=', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEKUOEfRltwYkuHiaN83SGgxicnR1obMVibNasA6argJEhjfAOEQYSZorGmPhMvESiazshuwfc0nKnSOWg/0', 0, '', 0, '=_=::>困<::=_=', ''),
(90, 0, 'o9xy7t6pR9sr1o-0F-SleJuZeb34', 'httpll:www.GU伟哲.com', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/ja6g2lJ0p0TLadIxhp8BD9at2eWYRLkDYRtJJ1ZpjxXQciaWTEf207of2jxYWgicmVysNSlweWkcSkSf2AbLYoXlpf81AtAIC3/0', 0, '', 3, 'httpll:www.GU伟哲.com', ''),
(91, 0, 'o9xy7tw-FygTHTllUBbCW_nkI_f4', 'xu Mr', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/ja6g2lJ0p0TLadIxhp8BDibkFZxgdwHWiaWCpDjFqncXtcXef7tbmrOY0dd3cyjMb9MeIl3HBo2wVArlIlHOfZ4z3R8deEEcah/0', 0, '', 3, 'xu Mr', ''),
(92, 0, 'o9xy7t6SFYJRMFm2O194iG47nvgI', 'iKuo', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEKxNdicQkwHrPCj3qp2VCFiazBfHP7r0Qf8CM1KHmaSlTteQq2JdjlCgFibegMCtB2TeiaKF67FVib2odQ/0', 0, '', 3, 'iKuo', ''),
(93, 0, 'o9xy7tzyA5odVKZ8J8GUxVB0kSbs', '李智', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEKRiahACUQp8Y4nRHnM42Eg5JJ4gl0XVpWYmCEv331IcNab9UumjDwfaYMf0OxduEVNCQn3TVXZWxQ/0', 0, '', 3, '李智', ''),
(94, 0, 'o9xy7t6WuTCH1wLhFKbTCtnciE54', '肾肾', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLA19jUgBTqMPtvGibXHq0QYm3rDXk14uJ31zyCtiae4A4zJx5JT6gRuF6wTUH2T2ANxCEy8cmv9RnCw/0', 0, '', 3, '肾肾', ''),
(116, 0, 'o9xy7t8-ihMXrHSAmm9guSmtBdhM', '古董', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/O3PqTRboYGAuSdPhtBvERAXduAkUnPQSJdN5j8JrCib05NSWsc9qKiaWow2Qa11oRhHEiaRhINZrlZ9KKibGGOZxeyEkksOQYx7M/0', 0, '', 3, '古董', ''),
(96, 0, 'o9xy7tyXsruu0PxyDU25Ff175t84', '一直走，不停留', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/Fl4XRkC8xdGRGOZ7LRpZCk2vzzR97alrPSN7clL4ZfRVRicB3dBaV70xRpSMlgcTus6KOXzuGRKwc9s36asStvjX04SvplYlY/0', 0, '', 3, '一直走，不停留', ''),
(97, 0, 'o9xy7txSkA6yWyZRrMH8BLf73aQA', 'V', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/ib1LuriadbNSosEnjvXsy8IZyGtYWb8G8UfbsNtt2snNSq1wcVVmtQp6NawcATMme5xEqZ4eh7zAuVnyMKhFxcELsCbfkQQKQL/0', 0, '', 0, 'V', ''),
(98, 0, 'o9xy7tzuTyq-0_Mv-pDGYLzNxsZc', '烁珩', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/iaX0vrcQaiaKwbzs0g54udrTZnpbOIrmjSyNgXVHxoUZLA51aAo6Wjuhqv4rMTYpH6ETjXgV099OVLyzmvoDT1XD5yNAh4Y0Re/0', 0, '', 1, '烁珩', ''),
(100, 0, 'o9xy7t_rcQ9_2ICpWdiHqQQhMdwc', '追寻.以后', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/O3PqTRboYGC4ZD7OCHqOFMWtiaHNrRLc4R4ibaon97HYAE5dLf9W0mrc4gawS7m7Z4Rlia6G6JwccIxtfnny8gibeeInApTC9tZL/0', 0, '', 3, '追寻.以后', ''),
(101, 0, 'o9xy7t0RULnkToQOQyMmyOxUXqkA', 'D.k', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/ja6g2lJ0p0QHvxFRCCYLLzEMDcAQHyFDb8veYTn2WKLGHI5ibVu9cpLquChPmHVqNAJQJOfU7H2k72B36lJecjTxBGDP97c1y/0', 0, '', 1, 'D.k', ''),
(102, 0, 'o9xy7t7Z5dnK0WJKrvLgqkhsdf_E', '镇', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/O3PqTRboYGC4ZD7OCHqOFGv5NaJesXDo5FGdDawV5D04IVafYia7a0kc8XBksGcLzya2bDUWpB6FiboKV6VKk1yvVNAfpsUZ9J/0', 0, '', 3, '镇', ''),
(103, 0, 'o9xy7t73eqeAW4h_8fJRYR6ejNXE', '李希文', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/s9rGjPToqkPZgqDcV8YDicMLBSiasR6yJMLz5853p8zIHllkvv6DwUkEm43jiae7Lt0YaRIjDoKMibCBKrf87ToFWU1GlibgO9h9j/0', 0, '', 3, '李希文', ''),
(104, 0, 'o9xy7t44x_BvJb8u_8X2WYPQU7A4', '雨奇', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/Fl4XRkC8xdE9ic9yTtU18HBEg6mjaeBSZvKAUZUwgh6R5JTia07wtdxgEnwt5zXAQ9YoaqCZ3sun8QY873JwbYqZTTLR6w2UB5/0', 0, '', 3, '雨奇', ''),
(105, 0, 'o9xy7t_uEAzk6KDHU8zZbrB8LzqQ', '吴百万', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/Q3auHgzwzM4EzM2Ce56h7DeV6p1lNwOWuasEtw2QCQncgdhQxLeUfY9tEX1ibR5HloYnv1V9gtzpoyAQHVVhnzA/0', 0, '', 3, '吴百万', ''),
(106, 0, 'o9xy7tx4zD3s55qu29FRW672NN9A', '●郭仔141319', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/icFTnRoibgibpibFlSdo0GtN7jNjicg4web6fl4bQkbyluubmjcAXvlWToiaCy0SMd4s3fmxcpf27dFqs9WM8xUeTT1w/0', 0, '', 3, '●郭仔141319', ''),
(107, 0, 'o9xy7t0gnjzFFM1uORUuuw5fPVek', '宏伟', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/Fl4XRkC8xdGRGOZ7LRpZCg5C3iayVOCJ6U0Zevl8ckBkicv3OS9BeCWuqzTHyzvk4JCicXJvbgl2tA3TgfcEq2UFCY5EgR6r2db/0', 0, '', 3, '宏伟', ''),
(108, 0, 'o9xy7t7TZuxWULUmra9oHJ5WweL4', '始终如益', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/Q3auHgzwzM73HCjWo4htw9lS7ibPqRAjJl215trop2mmTwoznSWStb5icJ0fs3PicNEopDFZ6L92neflYpwIEyWEQ/0', 0, '', 1, '始终如益', ''),
(109, 0, 'o9xy7twUWwnIbws0oMowxYF-7bXE', 'Дима-Lu', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/icFTnRoibgibpicZ2RLQo9jaHOibwpd8hlHibJ4DmMWgTHWiaPvPxGyRO3Os8s9uHTKBKcTfxibXHsqPIfDp1preyQcTcg/0', 0, '', 3, 'Дима-Lu', ''),
(110, 0, 'o9xy7t0QzG6kCPucM78WtYj7DN_s', '土豆LSB', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/icFTnRoibgibp8VnjhroBPwug5xVNyh1lw4nzSXiciaKLDBTBDKDxUOSIkokic3TKKRpibYNrzc5hag0gST8VPMqLu4hyNaL6WPibFCn/0', 0, '', 3, '土豆LSB', ''),
(111, 0, 'o9xy7t53IsJB1_pqeOZhbfmVFsXg', 'YYK服饰', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/Fl4XRkC8xdE9ic9yTtU18HJqGK39ribkEvnicGwBo2SolSmGRgTKYvRfnvhDFibUqNwcJfRZrT9XvTCM2hH59wNKOZ3BnWFX0pCG/0', 0, '', 1, 'YYK服饰', ''),
(112, 0, 'o9xy7t7Up9zrm3-6fz0wonWcZXEM', 'Geek', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/Q3auHgzwzM6lhcKREJHmFeT35JfWxH1nsBY88LDPGncbv93OVc1BcG1A8no1Oib5n0m6OFpY0JqAsaQ2TjKEzvA/0', 0, '', 1, 'Geek', ''),
(113, 0, 'o9xy7t1OjVvvO8sCseMyMj0WRfls', '永远别给自己退路', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/Fl4XRkC8xdESYAt5g6878xGxTysUFLO1iciadTicWFEeiaOlsyQwv7WVswh56DRznbY4I8OcPd6PUffa9yKxRbicf2Lz7vK4CdSvy/0', 0, '', 3, '永远别给自己退路', ''),
(114, 0, 'o9xy7t1PFdjBpxM0SqySAJUOQTTU', 'Tuib', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/icFTnRoibgibp8VnjhroBPwuq2pKOiaRMz5KJqkADHia7mJP27QL39oSy5JM84Ddicc5pFIaLZV3icS34K9ONGmGLChucbtkA99tybF/0', 0, '', 1, 'Tuib', ''),
(115, 0, 'o9xy7t-wk0NQVsuMxvBoAnbui7_4', '一名丶', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/Fl4XRkC8xdGpUiasJe3qzabX49GCXo1Rtc9iaV97iau7SslNldEv79pCxWH88AZl9icq5tuyEEtvcQgJJAzOkRCmnhibIzibUibzbUI/0', 0, '', 3, '一名丶', ''),
(117, 0, 'o9xy7t64_pjyGJBx2Z7TFmjHTH2c', '大叔去哪儿', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/s9rGjPToqkPZgqDcV8YDicDtrjAUIFfyZmpmRYZsT6M2nMOKoyUpqaEXp0tV65iabYCEzwUNX5Ig6orW6kbfaDJAhn32iaS8NXU/0', 0, '', 3, '大叔去哪儿', ''),
(118, 0, 'o9xy7tyZQ6QTMXM7-Xqodw8sp2is', '老六', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/O3PqTRboYGAHqAiaRFBHy8IfAOuf0klOdq245FoQLNfmsa072QKiaEPALNfavPLYclHYWr7LA7v2j2o0ib8A1DCdZBicS88t40lu/0', 0, '', 3, '老六', ''),
(119, 0, 'o9xy7t6SqIUQqdS3ZP6-HXx5NmHM', '【尚通网络】王湧', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLCEADCQcb2uOtiac3Fx2ye9DOeGEwmqExiabs8qMm6QzYEliaYFuqILcGrOR9CVnqb6YqzIhOkkLenBw/0', 0, '', 3, '【尚通网络】王湧', ''),
(120, 0, 'o9xy7t8CzztwJ0S6CQH21lYa9RZU', '宝鸡金鼠电子商贸【金水商城】', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/ja6g2lJ0p0Su2ZrLhK0iapKYPZ6XZ2Z0c9hjpRGHwc2W6SJu5ctonQFyibtLLvzDgsuFrK1odFZ4DicaYxDiafAxx0Njia4hN7tkQ/0', 0, '', 3, '宝鸡金鼠电子商贸【金水商城】', ''),
(121, 0, 'o9xy7t691v17pzl1woWswOvZ8OqU', '丹青m', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/O3PqTRboYGC4ZD7OCHqOFLtkyVjaOqpEzOHK8tBtVFM0ZZuDicz7PG5TZf51esd5hNp6RfExUeuzSZjWX9X1ucPD7qtopMicAP/0', 0, '', 3, '丹青m', ''),
(122, 0, 'o9xy7t_eTfv-Sim_iziAAdx9s-zk', '超强', 0, '', '', 0, 0, 'http://wx.qlogo.cn/mmopen/O3PqTRboYGAuSdPhtBvERFODHYWbh73Kv82NEH1iaWovaQhprvCYn2epzRVXpvAQId3c0icaCIh3ZtwickKhtqVLBfW1ibpkAag6/0', 0, '', 3, '超强', '');

-- --------------------------------------------------------

--
-- 表的结构 `go_wxch_cfg`
--

CREATE TABLE IF NOT EXISTS `go_wxch_cfg` (
  `cfg_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `cfg_name` varchar(64) NOT NULL DEFAULT '',
  `cfg_value` text NOT NULL COMMENT '参数值',
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`cfg_id`),
  UNIQUE KEY `cfg_name` (`cfg_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 导出表中的数据 `go_wxch_cfg`
--

INSERT INTO `go_wxch_cfg` (`cfg_id`, `cfg_name`, `cfg_value`, `autoload`) VALUES
(1, 'murl', 'mobile', 'yes'),
(2, 'baseurl', 'http://m.52jscn.com
/', 'yes'),
(3, 'imgpath', 'http://m.52jscn.com
/statics/uploads/', 'yes'),
(4, 'plustj', 'false', 'yes'),
(5, 'userpwd', '1234567', 'yes'),
(6, 'cxbd', '', 'yes'),
(8, 'oauth', 'true', 'yes'),
(9, 'goods', '', 'yes'),
(11, 'reply', '欢迎关注一元云购网站，我们是一个新型的购物平台，旨在提供更加优质的云购服务，是年轻人喜欢的一种购物形式。', 'yes'),
(12, 'share', 'false', 'yes'),
(13, 'money', '0.1', 'yes'),
(14, 'auto', 'a:10:{s:2:"on";i:1;s:2:"uf";i:848;s:2:"ul";i:1728;s:7:"mintime";i:4;s:7:"maxtime";i:6;s:6:"shopid";s:87:"466-465-464-463-458-456-447-429-385-383-362-361-360-359-358-357-353-328-467-468-469-470";s:7:"autoadd";i:1;s:5:"mshop";s:1:"1";s:10:"timeperiod";s:61:"23-0-20-21-19-22-18-3-4-5-6-2-1-7-9-8-10-11-13-12-14-17-16-15";s:7:"runtime";i:1470326638;}', 'yes'),
(15, 'template_zj', '-XAsDjl1OMW_GhxLMUkmJRpNDM5369AGF8ApBEpGvtk', 'yes'),
(16, 'template_fh', 'GghMlORyOnw-aRI4MpeZ56A3JBJTkpWRwfBoTdKjgJo', 'yes');
