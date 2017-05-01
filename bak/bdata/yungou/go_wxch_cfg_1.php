<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_wxch_cfg`;");
E_C("CREATE TABLE `go_wxch_cfg` (
  `cfg_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `cfg_name` varchar(64) NOT NULL DEFAULT '',
  `cfg_value` text NOT NULL COMMENT '参数值',
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`cfg_id`),
  UNIQUE KEY `cfg_name` (`cfg_name`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8");
E_D("replace into `go_wxch_cfg` values('1','murl','mobile','yes');");
E_D("replace into `go_wxch_cfg` values('2','baseurl','http://m.52jscn.com
/','yes');");
E_D("replace into `go_wxch_cfg` values('3','imgpath','http://m.52jscn.com
/statics/uploads/','yes');");
E_D("replace into `go_wxch_cfg` values('4','plustj','false','yes');");
E_D("replace into `go_wxch_cfg` values('5','userpwd','1234567','yes');");
E_D("replace into `go_wxch_cfg` values('6','cxbd','','yes');");
E_D("replace into `go_wxch_cfg` values('8','oauth','true','yes');");
E_D("replace into `go_wxch_cfg` values('9','goods','','yes');");
E_D("replace into `go_wxch_cfg` values('11','reply','欢迎关注一元云购网站，我们是一个新型的购物平台，旨在提供更加优质的云购服务，是年轻人喜欢的一种购物形式。','yes');");
E_D("replace into `go_wxch_cfg` values('12','share','false','yes');");
E_D("replace into `go_wxch_cfg` values('13','money','0.1','yes');");
E_D("replace into `go_wxch_cfg` values('14','auto','a:10:{s:2:\"on\";i:1;s:2:\"uf\";i:848;s:2:\"ul\";i:1728;s:7:\"mintime\";i:4;s:7:\"maxtime\";i:6;s:6:\"shopid\";s:87:\"466-465-464-463-458-456-447-429-385-383-362-361-360-359-358-357-353-328-467-468-469-470\";s:7:\"autoadd\";i:1;s:5:\"mshop\";s:1:\"1\";s:10:\"timeperiod\";s:61:\"23-0-20-21-19-22-18-3-4-5-6-2-1-7-9-8-10-11-13-12-14-17-16-15\";s:7:\"runtime\";i:1470326638;}','yes');");
E_D("replace into `go_wxch_cfg` values('15','template_zj','-XAsDjl1OMW_GhxLMUkmJRpNDM5369AGF8ApBEpGvtk','yes');");
E_D("replace into `go_wxch_cfg` values('16','template_fh','GghMlORyOnw-aRI4MpeZ56A3JBJTkpWRwfBoTdKjgJo','yes');");

require("../../inc/footer.php");
?>