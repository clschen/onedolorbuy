<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `go_weixin_user`;");
E_C("CREATE TABLE `go_weixin_user` (
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
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8");
E_D("replace into `go_weixin_user` values('88','0','o9xy7t61JluKn93_aJHC1SKQYan4','乔','0','','','0','0','http://wx.qlogo.cn/mmopen/O3PqTRboYGC4ZD7OCHqOFEzz3p7mllMHVibL8gQa2FamAUsyLq9VW69ibdic4j36vAHFWSdDDuQD0Hia2EDJRSRlEvjeL13VrOmT/0','0','','3','乔','');");
E_D("replace into `go_weixin_user` values('87','0','o9xy7t2jXwd8UDJ4knaSBjRUHQhU','劉','0','','','0','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM64XEwfcuicn1FczIe9NfShibRUOHbFPIqaicncDwtVpM4otjvmic5YrDHKIE7XZIWSy0QlUOCno0ZMlQ/0','0','','3','劉','');");
E_D("replace into `go_weixin_user` values('84','0','o9xy7twhjjlpiMFDyMCqp42XFDTI','银明','0','','','0','0','http://wx.qlogo.cn/mmopen/Fl4XRkC8xdGRGOZ7LRpZCiaBjqRUib2OoNAW1YiatsaosvMGicK1ibeQ7Yic2YXgpH8XicGfiaUF7houPZYJVn3UQTMpnnDGRwp5nJ8I/0','0','','0','银明','');");
E_D("replace into `go_weixin_user` values('85','0','o9xy7t_yNt4kyTfXeb63ioMX8nBU','a.纳尼诗.林亮平','0','','','0','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM4ocJIJSRqgl0jHeq1BrxZxF3va7XgwfEItia3icq6IrnmsSjCPWgbufhia7QnxY6Uu82of7Q1r99dtOLdkaKomHsX5NJIuSjKZO4/0','0','','3','a.纳尼诗.林亮平','');");
E_D("replace into `go_weixin_user` values('86','0','o9xy7tyAq44fEihvlDXMOOdM8_rc','哈尔滨麦田科技','0','','','0','0','http://wx.qlogo.cn/mmopen/Fl4XRkC8xdEp7nRm3QSR0VBoUdgastuyQ6xlib4lP6ACHsicYcUwLJGGiah0EdIaqbCFD6mxuOZKpMMQNkkdIt1iaY9Bfeupb3Ts/0','0','','3','哈尔滨麦田科技','');");
E_D("replace into `go_weixin_user` values('89','0','o9xy7t_mJ5rcQev4gKaiXlhgXM_I','=_=::>困<::=_=','0','','','0','0','http://wx.qlogo.cn/mmopen/PiajxSqBRaEKUOEfRltwYkuHiaN83SGgxicnR1obMVibNasA6argJEhjfAOEQYSZorGmPhMvESiazshuwfc0nKnSOWg/0','0','','0','=_=::>困<::=_=','');");
E_D("replace into `go_weixin_user` values('90','0','o9xy7t6pR9sr1o-0F-SleJuZeb34','httpll:www.GU伟哲.com','0','','','0','0','http://wx.qlogo.cn/mmopen/ja6g2lJ0p0TLadIxhp8BD9at2eWYRLkDYRtJJ1ZpjxXQciaWTEf207of2jxYWgicmVysNSlweWkcSkSf2AbLYoXlpf81AtAIC3/0','0','','3','httpll:www.GU伟哲.com','');");
E_D("replace into `go_weixin_user` values('91','0','o9xy7tw-FygTHTllUBbCW_nkI_f4','xu Mr','0','','','0','0','http://wx.qlogo.cn/mmopen/ja6g2lJ0p0TLadIxhp8BDibkFZxgdwHWiaWCpDjFqncXtcXef7tbmrOY0dd3cyjMb9MeIl3HBo2wVArlIlHOfZ4z3R8deEEcah/0','0','','3','xu Mr','');");
E_D("replace into `go_weixin_user` values('92','0','o9xy7t6SFYJRMFm2O194iG47nvgI','iKuo','0','','','0','0','http://wx.qlogo.cn/mmopen/PiajxSqBRaEKxNdicQkwHrPCj3qp2VCFiazBfHP7r0Qf8CM1KHmaSlTteQq2JdjlCgFibegMCtB2TeiaKF67FVib2odQ/0','0','','3','iKuo','');");
E_D("replace into `go_weixin_user` values('93','0','o9xy7tzyA5odVKZ8J8GUxVB0kSbs','李智','0','','','0','0','http://wx.qlogo.cn/mmopen/PiajxSqBRaEKRiahACUQp8Y4nRHnM42Eg5JJ4gl0XVpWYmCEv331IcNab9UumjDwfaYMf0OxduEVNCQn3TVXZWxQ/0','0','','3','李智','');");
E_D("replace into `go_weixin_user` values('94','0','o9xy7t6WuTCH1wLhFKbTCtnciE54','肾肾','0','','','0','0','http://wx.qlogo.cn/mmopen/ajNVdqHZLLA19jUgBTqMPtvGibXHq0QYm3rDXk14uJ31zyCtiae4A4zJx5JT6gRuF6wTUH2T2ANxCEy8cmv9RnCw/0','0','','3','肾肾','');");
E_D("replace into `go_weixin_user` values('116','0','o9xy7t8-ihMXrHSAmm9guSmtBdhM','古董','0','','','0','0','http://wx.qlogo.cn/mmopen/O3PqTRboYGAuSdPhtBvERAXduAkUnPQSJdN5j8JrCib05NSWsc9qKiaWow2Qa11oRhHEiaRhINZrlZ9KKibGGOZxeyEkksOQYx7M/0','0','','3','古董','');");
E_D("replace into `go_weixin_user` values('96','0','o9xy7tyXsruu0PxyDU25Ff175t84','一直走，不停留','0','','','0','0','http://wx.qlogo.cn/mmopen/Fl4XRkC8xdGRGOZ7LRpZCk2vzzR97alrPSN7clL4ZfRVRicB3dBaV70xRpSMlgcTus6KOXzuGRKwc9s36asStvjX04SvplYlY/0','0','','3','一直走，不停留','');");
E_D("replace into `go_weixin_user` values('97','0','o9xy7txSkA6yWyZRrMH8BLf73aQA','V','0','','','0','0','http://wx.qlogo.cn/mmopen/ib1LuriadbNSosEnjvXsy8IZyGtYWb8G8UfbsNtt2snNSq1wcVVmtQp6NawcATMme5xEqZ4eh7zAuVnyMKhFxcELsCbfkQQKQL/0','0','','0','V','');");
E_D("replace into `go_weixin_user` values('98','0','o9xy7tzuTyq-0_Mv-pDGYLzNxsZc','烁珩','0','','','0','0','http://wx.qlogo.cn/mmopen/iaX0vrcQaiaKwbzs0g54udrTZnpbOIrmjSyNgXVHxoUZLA51aAo6Wjuhqv4rMTYpH6ETjXgV099OVLyzmvoDT1XD5yNAh4Y0Re/0','0','','1','烁珩','');");
E_D("replace into `go_weixin_user` values('100','0','o9xy7t_rcQ9_2ICpWdiHqQQhMdwc','追寻.以后','0','','','0','0','http://wx.qlogo.cn/mmopen/O3PqTRboYGC4ZD7OCHqOFMWtiaHNrRLc4R4ibaon97HYAE5dLf9W0mrc4gawS7m7Z4Rlia6G6JwccIxtfnny8gibeeInApTC9tZL/0','0','','3','追寻.以后','');");
E_D("replace into `go_weixin_user` values('101','0','o9xy7t0RULnkToQOQyMmyOxUXqkA','D.k','0','','','0','0','http://wx.qlogo.cn/mmopen/ja6g2lJ0p0QHvxFRCCYLLzEMDcAQHyFDb8veYTn2WKLGHI5ibVu9cpLquChPmHVqNAJQJOfU7H2k72B36lJecjTxBGDP97c1y/0','0','','1','D.k','');");
E_D("replace into `go_weixin_user` values('102','0','o9xy7t7Z5dnK0WJKrvLgqkhsdf_E','镇','0','','','0','0','http://wx.qlogo.cn/mmopen/O3PqTRboYGC4ZD7OCHqOFGv5NaJesXDo5FGdDawV5D04IVafYia7a0kc8XBksGcLzya2bDUWpB6FiboKV6VKk1yvVNAfpsUZ9J/0','0','','3','镇','');");
E_D("replace into `go_weixin_user` values('103','0','o9xy7t73eqeAW4h_8fJRYR6ejNXE','李希文','0','','','0','0','http://wx.qlogo.cn/mmopen/s9rGjPToqkPZgqDcV8YDicMLBSiasR6yJMLz5853p8zIHllkvv6DwUkEm43jiae7Lt0YaRIjDoKMibCBKrf87ToFWU1GlibgO9h9j/0','0','','3','李希文','');");
E_D("replace into `go_weixin_user` values('104','0','o9xy7t44x_BvJb8u_8X2WYPQU7A4','雨奇','0','','','0','0','http://wx.qlogo.cn/mmopen/Fl4XRkC8xdE9ic9yTtU18HBEg6mjaeBSZvKAUZUwgh6R5JTia07wtdxgEnwt5zXAQ9YoaqCZ3sun8QY873JwbYqZTTLR6w2UB5/0','0','','3','雨奇','');");
E_D("replace into `go_weixin_user` values('105','0','o9xy7t_uEAzk6KDHU8zZbrB8LzqQ','吴百万','0','','','0','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM4EzM2Ce56h7DeV6p1lNwOWuasEtw2QCQncgdhQxLeUfY9tEX1ibR5HloYnv1V9gtzpoyAQHVVhnzA/0','0','','3','吴百万','');");
E_D("replace into `go_weixin_user` values('106','0','o9xy7tx4zD3s55qu29FRW672NN9A','●郭仔141319','0','','','0','0','http://wx.qlogo.cn/mmopen/icFTnRoibgibpibFlSdo0GtN7jNjicg4web6fl4bQkbyluubmjcAXvlWToiaCy0SMd4s3fmxcpf27dFqs9WM8xUeTT1w/0','0','','3','●郭仔141319','');");
E_D("replace into `go_weixin_user` values('107','0','o9xy7t0gnjzFFM1uORUuuw5fPVek','宏伟','0','','','0','0','http://wx.qlogo.cn/mmopen/Fl4XRkC8xdGRGOZ7LRpZCg5C3iayVOCJ6U0Zevl8ckBkicv3OS9BeCWuqzTHyzvk4JCicXJvbgl2tA3TgfcEq2UFCY5EgR6r2db/0','0','','3','宏伟','');");
E_D("replace into `go_weixin_user` values('108','0','o9xy7t7TZuxWULUmra9oHJ5WweL4','始终如益༒ཻ࿆༄','0','','','0','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM73HCjWo4htw9lS7ibPqRAjJl215trop2mmTwoznSWStb5icJ0fs3PicNEopDFZ6L92neflYpwIEyWEQ/0','0','','1','始终如益༒ཻ࿆༄','');");
E_D("replace into `go_weixin_user` values('109','0','o9xy7twUWwnIbws0oMowxYF-7bXE','Дима-Lu','0','','','0','0','http://wx.qlogo.cn/mmopen/icFTnRoibgibpicZ2RLQo9jaHOibwpd8hlHibJ4DmMWgTHWiaPvPxGyRO3Os8s9uHTKBKcTfxibXHsqPIfDp1preyQcTcg/0','0','','3','Дима-Lu','');");
E_D("replace into `go_weixin_user` values('110','0','o9xy7t0QzG6kCPucM78WtYj7DN_s','土豆LSB','0','','','0','0','http://wx.qlogo.cn/mmopen/icFTnRoibgibp8VnjhroBPwug5xVNyh1lw4nzSXiciaKLDBTBDKDxUOSIkokic3TKKRpibYNrzc5hag0gST8VPMqLu4hyNaL6WPibFCn/0','0','','3','土豆LSB','');");
E_D("replace into `go_weixin_user` values('111','0','o9xy7t53IsJB1_pqeOZhbfmVFsXg','YYK服饰','0','','','0','0','http://wx.qlogo.cn/mmopen/Fl4XRkC8xdE9ic9yTtU18HJqGK39ribkEvnicGwBo2SolSmGRgTKYvRfnvhDFibUqNwcJfRZrT9XvTCM2hH59wNKOZ3BnWFX0pCG/0','0','','1','YYK服饰','');");
E_D("replace into `go_weixin_user` values('112','0','o9xy7t7Up9zrm3-6fz0wonWcZXEM','Geek','0','','','0','0','http://wx.qlogo.cn/mmopen/Q3auHgzwzM6lhcKREJHmFeT35JfWxH1nsBY88LDPGncbv93OVc1BcG1A8no1Oib5n0m6OFpY0JqAsaQ2TjKEzvA/0','0','','1','Geek','');");
E_D("replace into `go_weixin_user` values('113','0','o9xy7t1OjVvvO8sCseMyMj0WRfls','永远别给自己退路','0','','','0','0','http://wx.qlogo.cn/mmopen/Fl4XRkC8xdESYAt5g6878xGxTysUFLO1iciadTicWFEeiaOlsyQwv7WVswh56DRznbY4I8OcPd6PUffa9yKxRbicf2Lz7vK4CdSvy/0','0','','3','永远别给自己退路','');");
E_D("replace into `go_weixin_user` values('114','0','o9xy7t1PFdjBpxM0SqySAJUOQTTU','Tuib','0','','','0','0','http://wx.qlogo.cn/mmopen/icFTnRoibgibp8VnjhroBPwuq2pKOiaRMz5KJqkADHia7mJP27QL39oSy5JM84Ddicc5pFIaLZV3icS34K9ONGmGLChucbtkA99tybF/0','0','','1','Tuib','');");
E_D("replace into `go_weixin_user` values('115','0','o9xy7t-wk0NQVsuMxvBoAnbui7_4','一名丶','0','','','0','0','http://wx.qlogo.cn/mmopen/Fl4XRkC8xdGpUiasJe3qzabX49GCXo1Rtc9iaV97iau7SslNldEv79pCxWH88AZl9icq5tuyEEtvcQgJJAzOkRCmnhibIzibUibzbUI/0','0','','3','一名丶','');");
E_D("replace into `go_weixin_user` values('117','0','o9xy7t64_pjyGJBx2Z7TFmjHTH2c','大叔去哪儿','0','','','0','0','http://wx.qlogo.cn/mmopen/s9rGjPToqkPZgqDcV8YDicDtrjAUIFfyZmpmRYZsT6M2nMOKoyUpqaEXp0tV65iabYCEzwUNX5Ig6orW6kbfaDJAhn32iaS8NXU/0','0','','3','大叔去哪儿','');");
E_D("replace into `go_weixin_user` values('118','0','o9xy7tyZQ6QTMXM7-Xqodw8sp2is','老六','0','','','0','0','http://wx.qlogo.cn/mmopen/O3PqTRboYGAHqAiaRFBHy8IfAOuf0klOdq245FoQLNfmsa072QKiaEPALNfavPLYclHYWr7LA7v2j2o0ib8A1DCdZBicS88t40lu/0','0','','3','老六','');");
E_D("replace into `go_weixin_user` values('119','0','o9xy7t6SqIUQqdS3ZP6-HXx5NmHM','【尚通网络】王湧','0','','','0','0','http://wx.qlogo.cn/mmopen/ajNVdqHZLLCEADCQcb2uOtiac3Fx2ye9DOeGEwmqExiabs8qMm6QzYEliaYFuqILcGrOR9CVnqb6YqzIhOkkLenBw/0','0','','3','【尚通网络】王湧','');");
E_D("replace into `go_weixin_user` values('120','0','o9xy7t8CzztwJ0S6CQH21lYa9RZU','宝鸡金鼠电子商贸【金水商城】','0','','','0','0','http://wx.qlogo.cn/mmopen/ja6g2lJ0p0Su2ZrLhK0iapKYPZ6XZ2Z0c9hjpRGHwc2W6SJu5ctonQFyibtLLvzDgsuFrK1odFZ4DicaYxDiafAxx0Njia4hN7tkQ/0','0','','3','宝鸡金鼠电子商贸【金水商城】','');");
E_D("replace into `go_weixin_user` values('121','0','o9xy7t691v17pzl1woWswOvZ8OqU','丹青m','0','','','0','0','http://wx.qlogo.cn/mmopen/O3PqTRboYGC4ZD7OCHqOFLtkyVjaOqpEzOHK8tBtVFM0ZZuDicz7PG5TZf51esd5hNp6RfExUeuzSZjWX9X1ucPD7qtopMicAP/0','0','','3','丹青m','');");
E_D("replace into `go_weixin_user` values('122','0','o9xy7t_eTfv-Sim_iziAAdx9s-zk','超强','0','','','0','0','http://wx.qlogo.cn/mmopen/O3PqTRboYGAuSdPhtBvERFODHYWbh73Kv82NEH1iaWovaQhprvCYn2epzRVXpvAQId3c0icaCIh3ZtwickKhtqVLBfW1ibpkAag6/0','0','','3','超强','');");

require("../../inc/footer.php");
?>