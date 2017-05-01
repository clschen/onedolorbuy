<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_weixin_bonus`;");
E_C("CREATE TABLE `go_weixin_bonus` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `type_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
E_D("replace into `go_weixin_bonus` values('1','13');");

require("../../inc/footer.php");
?>