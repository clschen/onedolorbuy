<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_recom`;");
E_C("CREATE TABLE `go_recom` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '推荐位id',
  `img` varchar(50) DEFAULT NULL COMMENT '推荐位图片',
  `title` varchar(30) DEFAULT NULL COMMENT '推荐位标题',
  `link` varchar(255) DEFAULT '' COMMENT '链接地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8");
E_D("replace into `go_recom` values('3','banner/20150823/88514901333105.png','首页跨栏广告','goods_lottery');");
E_D("replace into `go_recom` values('4','banner/20160328/31148918099700.jpg','美女圈','single/business');");

require("../../inc/footer.php");
?>