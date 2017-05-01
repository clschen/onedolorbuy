<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_model`;");
E_C("CREATE TABLE `go_model` (
  `modelid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(10) NOT NULL,
  `table` char(20) NOT NULL,
  PRIMARY KEY (`modelid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='模型表'");
E_D("replace into `go_model` values('1','云购模型','shoplist');");
E_D("replace into `go_model` values('2','文章模型','article');");

require("../../inc/footer.php");
?>