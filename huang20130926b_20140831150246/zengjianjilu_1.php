<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `zengjianjilu`;");
E_C("CREATE TABLE `zengjianjilu` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `nickname` varchar(30) default '',
  `username` varchar(30) default NULL,
  `jine` decimal(9,2) default NULL,
  `jine2` decimal(9,2) NOT NULL default '0.00',
  `cdate` datetime default NULL,
  `sdate` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8");
E_D("replace into `zengjianjilu` values('23','359','CN32440','星晨','0.00','1200.00','2014-01-14 19:01:00','2014-01-14 19:01:00');");
E_D("replace into `zengjianjilu` values('24','359','CN32440','星晨','0.00','2000.00','2014-01-15 20:36:10','2014-01-15 20:36:10');");
E_D("replace into `zengjianjilu` values('25','359','CN32440','星晨','0.00','2100.00','2014-01-17 11:25:27','2014-01-17 11:25:27');");
E_D("replace into `zengjianjilu` values('26','436','CN70732','荣荣','0.00','920.00','2014-01-17 16:24:40','2014-01-17 16:24:40');");
E_D("replace into `zengjianjilu` values('27','436','CN70732','荣荣','0.00','3000.00','2014-01-17 20:28:37','2014-01-17 20:28:37');");
E_D("replace into `zengjianjilu` values('28','359','CN32440','星晨','0.00','3000.00','2014-01-19 19:41:22','2014-01-19 19:41:22');");
E_D("replace into `zengjianjilu` values('29','359','CN32440','星晨','0.00','1000.00','2014-01-22 13:56:41','2014-01-22 13:56:41');");
E_D("replace into `zengjianjilu` values('30','436','CN70732','荣荣','0.00','400.00','2014-01-26 20:39:56','2014-01-26 20:39:56');");
E_D("replace into `zengjianjilu` values('31','436','CN70732','阿仔','0.00','3000.00','2014-02-11 11:22:46','2014-02-11 11:22:46');");
E_D("replace into `zengjianjilu` values('32','436','CN70732','阿仔','0.00','9000.00','2014-02-11 16:31:50','2014-02-11 16:31:50');");
E_D("replace into `zengjianjilu` values('33','436','CN70732','阿仔','0.00','1600.00','2014-02-12 14:39:06','2014-02-12 14:39:06');");
E_D("replace into `zengjianjilu` values('34','539','CN65236','美人姣','0.00','3000.00','2014-02-12 17:53:56','2014-02-12 17:53:56');");
E_D("replace into `zengjianjilu` values('35','539','CN65236','美人姣','0.00','12000.00','2014-02-13 19:25:54','2014-02-13 19:25:54');");
E_D("replace into `zengjianjilu` values('36','539','CN65236','美人姣','0.00','3000.00','2014-02-14 11:22:16','2014-02-14 11:22:16');");
E_D("replace into `zengjianjilu` values('37','539','CN65236','美人姣','0.00','3000.00','2014-02-14 16:12:31','2014-02-14 16:12:31');");
E_D("replace into `zengjianjilu` values('38','359','CN32440','星晨','0.00','3000.00','2014-02-17 02:39:44','2014-02-17 02:39:44');");
E_D("replace into `zengjianjilu` values('39','359','CN32440','星晨','0.00','3000.00','2014-02-17 06:51:17','2014-02-17 06:51:17');");
E_D("replace into `zengjianjilu` values('40','539','CN65236','美人姣','0.00','3000.00','2014-02-17 10:43:16','2014-02-17 10:43:16');");
E_D("replace into `zengjianjilu` values('41','539','CN65236','美人姣','0.00','3000.00','2014-02-17 11:12:19','2014-02-17 11:12:19');");
E_D("replace into `zengjianjilu` values('42','359','CN32440','星晨','0.00','3300.00','2014-02-17 11:43:30','2014-02-17 11:43:30');");
E_D("replace into `zengjianjilu` values('43','539','CN65236','美人姣','0.00','100.00','2014-02-17 19:59:13','2014-02-17 19:59:13');");
E_D("replace into `zengjianjilu` values('44','359','CN32440','星晨','0.00','1000.00','2014-02-18 12:36:54','2014-02-18 12:36:54');");
E_D("replace into `zengjianjilu` values('45','706','CN55118','默认数据','0.00','3000.00','2014-02-18 16:47:44','2014-02-18 16:47:44');");
E_D("replace into `zengjianjilu` values('46','539','CN65236','美人姣','0.00','1300.00','2014-02-18 21:07:06','2014-02-18 21:07:06');");
E_D("replace into `zengjianjilu` values('47','706','CN55118','默认数据','0.00','7677.00','2014-02-19 12:20:55','2014-02-19 12:20:55');");
E_D("replace into `zengjianjilu` values('48','372','CN39674','默认数据','0.00','4561.00','2014-02-19 21:32:38','2014-02-19 21:32:38');");
E_D("replace into `zengjianjilu` values('49','706','CN55118','默认数据','0.00','2550.00','2014-02-20 10:06:49','2014-02-20 10:06:49');");
E_D("replace into `zengjianjilu` values('50','539','CN65236','美人姣','0.00','10000.00','2014-02-20 10:12:46','2014-02-20 10:12:46');");
E_D("replace into `zengjianjilu` values('51','359','CN32440','星晨','0.00','30000.00','2014-02-20 20:01:44','2014-02-20 20:01:44');");
E_D("replace into `zengjianjilu` values('52','539','CN65236','美人姣','0.00','6000.00','2014-02-21 12:24:05','2014-02-21 12:24:05');");
E_D("replace into `zengjianjilu` values('53','539','CN65236','美人姣','0.00','10000.00','2014-02-22 18:11:57','2014-02-22 18:11:57');");
E_D("replace into `zengjianjilu` values('54','362','CN22101','北京海淀','0.00','500.00','2014-02-26 15:53:35','2014-02-26 15:53:35');");

require("../../inc/footer.php");
?>