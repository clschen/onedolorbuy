<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_fund`;");
E_C("CREATE TABLE `go_fund` (
  `id` int(10) unsigned NOT NULL,
  `fund_off` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `fund_money` decimal(10,2) unsigned NOT NULL,
  `fund_count_money` decimal(12,2) DEFAULT NULL COMMENT '云购基金',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");
E_D("replace into `go_fund` values('1','1','0.50','0.00');");

require("../../inc/footer.php");
?>