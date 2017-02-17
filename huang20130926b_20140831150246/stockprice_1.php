<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `stockprice`;");
E_C("CREATE TABLE `stockprice` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `price` decimal(11,2) default '0.00',
  `sdate` datetime default NULL,
  `num` decimal(20,2) default '0.00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=144 DEFAULT CHARSET=utf8");
E_D("replace into `stockprice` values('10','0.10','2013-11-20 14:35:37','1500000.00');");
E_D("replace into `stockprice` values('11','0.10','2013-11-23 10:53:38','0.00');");
E_D("replace into `stockprice` values('12','0.10','2013-11-24 20:00:50','0.00');");
E_D("replace into `stockprice` values('13','0.10','2013-11-25 00:25:36','66000.00');");
E_D("replace into `stockprice` values('14','0.10','2013-11-26 11:15:38','18000.00');");
E_D("replace into `stockprice` values('15','0.10','2013-11-27 00:01:13','40500.00');");
E_D("replace into `stockprice` values('16','0.10','2013-11-28 06:10:57','16000.00');");
E_D("replace into `stockprice` values('17','0.10','2013-11-29 13:01:47','94750.00');");
E_D("replace into `stockprice` values('18','0.10','2013-11-30 10:25:21','76250.00');");
E_D("replace into `stockprice` values('19','0.10','2013-12-01 09:21:05','43000.00');");
E_D("replace into `stockprice` values('20','0.10','2013-12-02 08:16:40','90500.00');");
E_D("replace into `stockprice` values('21','0.10','2013-12-03 08:28:03','64000.00');");
E_D("replace into `stockprice` values('22','0.10','2013-12-04 07:48:02','141250.00');");
E_D("replace into `stockprice` values('23','0.10','2013-12-05 09:13:03','105000.00');");
E_D("replace into `stockprice` values('24','0.10','2013-12-06 08:14:32','67750.00');");
E_D("replace into `stockprice` values('25','0.10','2013-12-07 00:21:39','252000.00');");
E_D("replace into `stockprice` values('26','0.10','2013-12-08 00:08:46','23000.00');");
E_D("replace into `stockprice` values('27','0.10','2013-12-09 06:55:54','223500.00');");
E_D("replace into `stockprice` values('28','0.10','2013-12-10 00:28:10','35250.00');");
E_D("replace into `stockprice` values('29','0.10','2013-12-11 00:28:07','141250.00');");
E_D("replace into `stockprice` values('30','0.10','2013-12-12 00:57:47','2000.00');");
E_D("replace into `stockprice` values('31','0.06','2013-12-13 00:18:11','15900.00');");
E_D("replace into `stockprice` values('32','0.06','2013-12-14 00:30:45','13733.00');");
E_D("replace into `stockprice` values('33','0.06','2013-12-15 08:02:13','0.00');");
E_D("replace into `stockprice` values('34','0.15','2013-12-16 08:08:28','79926.00');");
E_D("replace into `stockprice` values('35','0.15','2013-12-17 00:21:03','2541.00');");
E_D("replace into `stockprice` values('36','0.15','2013-12-18 01:09:19','49857.00');");
E_D("replace into `stockprice` values('37','0.15','2013-12-19 03:26:32','8855.00');");
E_D("replace into `stockprice` values('38','0.15','2013-12-20 00:35:55','13937.26');");
E_D("replace into `stockprice` values('39','0.15','2013-12-21 00:23:40','7224.00');");
E_D("replace into `stockprice` values('40','0.16','2013-12-22 06:10:00','10493.67');");
E_D("replace into `stockprice` values('41','0.20','2013-12-23 05:47:17','84398.07');");
E_D("replace into `stockprice` values('42','0.20','2013-12-24 05:19:01','39671.00');");
E_D("replace into `stockprice` values('43','0.21','2013-12-25 05:10:05','47154.00');");
E_D("replace into `stockprice` values('44','0.21','2013-12-26 01:30:02','40873.00');");
E_D("replace into `stockprice` values('45','0.21','2013-12-27 05:07:46','24821.95');");
E_D("replace into `stockprice` values('46','0.21','2013-12-28 00:00:26','0.00');");
E_D("replace into `stockprice` values('47','0.21','2013-12-29 00:45:29','0.00');");
E_D("replace into `stockprice` values('48','0.22','2013-12-30 00:01:22','81730.51');");
E_D("replace into `stockprice` values('49','0.22','2013-12-31 00:43:29','45267.54');");
E_D("replace into `stockprice` values('50','0.23','2014-01-01 04:07:19','12685.73');");
E_D("replace into `stockprice` values('51','0.23','2014-01-02 07:53:48','16423.06');");
E_D("replace into `stockprice` values('52','0.23','2014-01-03 00:25:33','17527.45');");
E_D("replace into `stockprice` values('53','0.23','2014-01-04 06:31:11','8587.65');");
E_D("replace into `stockprice` values('54','0.23','2014-01-05 00:02:52','0.00');");
E_D("replace into `stockprice` values('55','0.24','2014-01-06 00:10:41','14894.11');");
E_D("replace into `stockprice` values('56','0.24','2014-01-07 02:53:05','27135.00');");
E_D("replace into `stockprice` values('57','0.25','2014-01-08 00:15:06','74921.60');");
E_D("replace into `stockprice` values('58','0.25','2014-01-09 00:31:29','22801.85');");
E_D("replace into `stockprice` values('59','0.25','2014-01-10 00:36:45','7222.00');");
E_D("replace into `stockprice` values('60','0.25','2014-01-11 05:51:32','13125.00');");
E_D("replace into `stockprice` values('61','0.26','2014-01-12 06:18:04','9380.00');");
E_D("replace into `stockprice` values('62','0.26','2014-01-13 00:54:42','12498.00');");
E_D("replace into `stockprice` values('63','0.26','2014-01-14 01:41:38','11998.00');");
E_D("replace into `stockprice` values('64','0.27','2014-01-15 00:29:37','18387.00');");
E_D("replace into `stockprice` values('65','0.27','2014-01-16 02:32:15','2687.00');");
E_D("replace into `stockprice` values('66','0.27','2014-01-17 00:01:32','21834.00');");
E_D("replace into `stockprice` values('67','0.27','2014-01-18 01:00:04','2253.00');");
E_D("replace into `stockprice` values('68','0.28','2014-01-19 00:23:02','9759.00');");
E_D("replace into `stockprice` values('69','0.29','2014-01-20 06:19:09','10098.00');");
E_D("replace into `stockprice` values('70','0.29','2014-01-21 01:56:24','9013.00');");
E_D("replace into `stockprice` values('71','0.30','2014-01-22 02:41:53','35269.00');");
E_D("replace into `stockprice` values('72','0.30','2014-01-23 00:37:30','19101.00');");
E_D("replace into `stockprice` values('73','0.30','2014-01-24 04:32:41','9217.00');");
E_D("replace into `stockprice` values('74','0.30','2014-01-25 06:27:12','1318.00');");
E_D("replace into `stockprice` values('75','0.30','2014-01-26 00:06:30','0.00');");
E_D("replace into `stockprice` values('76','0.30','2014-01-27 08:05:12','5888.00');");
E_D("replace into `stockprice` values('77','0.30','2014-01-28 00:07:46','11025.00');");
E_D("replace into `stockprice` values('78','0.30','2014-01-29 00:53:26','3033.00');");
E_D("replace into `stockprice` values('79','0.30','2014-01-30 01:56:11','2340.00');");
E_D("replace into `stockprice` values('80','0.30','2014-01-31 00:39:06','3906.00');");
E_D("replace into `stockprice` values('81','0.30','2014-02-01 07:23:55','0.00');");
E_D("replace into `stockprice` values('82','0.30','2014-02-02 02:03:01','0.00');");
E_D("replace into `stockprice` values('83','0.30','2014-02-03 00:10:49','4063.00');");
E_D("replace into `stockprice` values('84','0.30','2014-02-04 04:12:02','1631.00');");
E_D("replace into `stockprice` values('85','0.30','2014-02-05 03:34:37','3088.00');");
E_D("replace into `stockprice` values('86','0.30','2014-02-06 02:08:28','1197.00');");
E_D("replace into `stockprice` values('87','0.30','2014-02-07 00:46:53','7915.00');");
E_D("replace into `stockprice` values('88','0.30','2014-02-08 00:06:15','7022.00');");
E_D("replace into `stockprice` values('89','0.30','2014-02-09 08:10:41','0.00');");
E_D("replace into `stockprice` values('90','0.30','2014-02-10 03:49:13','18312.00');");
E_D("replace into `stockprice` values('91','0.31','2014-02-11 00:07:18','100637.01');");
E_D("replace into `stockprice` values('92','0.32','2014-02-12 00:08:53','100644.05');");
E_D("replace into `stockprice` values('93','0.32','2014-02-13 00:17:38','76849.45');");
E_D("replace into `stockprice` values('94','0.32','2014-02-14 00:24:31','38951.00');");
E_D("replace into `stockprice` values('95','0.32','2014-02-15 00:46:31','6094.00');");
E_D("replace into `stockprice` values('96','0.32','2014-02-16 00:04:14','0.00');");
E_D("replace into `stockprice` values('97','0.09','2014-02-17 00:00:09','253032.00');");
E_D("replace into `stockprice` values('98','0.09','2014-02-18 03:08:51','123725.00');");
E_D("replace into `stockprice` values('99','0.10','2014-02-19 05:19:22','106500.00');");
E_D("replace into `stockprice` values('100','0.10','2014-02-20 06:34:14','153561.00');");
E_D("replace into `stockprice` values('101','0.11','2014-02-21 04:13:12','308963.00');");
E_D("replace into `stockprice` values('102','0.11','2014-02-22 04:42:59','148188.00');");
E_D("replace into `stockprice` values('103','0.11','2014-02-23 00:24:46','2188.00');");
E_D("replace into `stockprice` values('104','0.12','2014-02-24 04:46:52','172729.00');");
E_D("replace into `stockprice` values('105','0.12','2014-02-25 01:46:35','283000.00');");
E_D("replace into `stockprice` values('106','0.12','2014-02-26 03:30:33','275382.00');");
E_D("replace into `stockprice` values('107','0.12','2014-02-27 00:01:30','84586.00');");
E_D("replace into `stockprice` values('108','0.12','2014-02-28 00:23:36','0.00');");
E_D("replace into `stockprice` values('109','0.21','2014-03-19 15:40:19','300.00');");
E_D("replace into `stockprice` values('110','0.21','2014-03-28 17:18:20','0.00');");
E_D("replace into `stockprice` values('111','0.21','2014-03-30 12:12:32','0.00');");
E_D("replace into `stockprice` values('112','0.21','2014-03-31 15:07:37','0.00');");
E_D("replace into `stockprice` values('113','0.21','2014-04-01 07:10:20','0.00');");
E_D("replace into `stockprice` values('114','0.21','2014-04-02 01:28:19','0.00');");
E_D("replace into `stockprice` values('115','0.21','2014-04-03 15:23:00','0.00');");
E_D("replace into `stockprice` values('116','0.21','2014-04-04 09:32:33','0.00');");
E_D("replace into `stockprice` values('117','0.21','2014-04-05 18:32:53','0.00');");
E_D("replace into `stockprice` values('118','0.21','2014-04-07 12:24:59','0.00');");
E_D("replace into `stockprice` values('119','0.21','2014-04-08 14:24:33','0.00');");
E_D("replace into `stockprice` values('120','0.21','2014-04-09 10:52:11','0.00');");
E_D("replace into `stockprice` values('121','0.21','2014-04-10 22:30:15','0.00');");
E_D("replace into `stockprice` values('122','0.21','2014-04-14 19:18:21','0.00');");
E_D("replace into `stockprice` values('123','0.21','2014-04-15 20:31:34','0.00');");
E_D("replace into `stockprice` values('124','0.21','2014-04-22 09:37:01','0.00');");
E_D("replace into `stockprice` values('125','0.21','2014-04-24 10:10:55','0.00');");
E_D("replace into `stockprice` values('126','0.21','2014-04-25 11:18:43','0.00');");
E_D("replace into `stockprice` values('127','0.21','2014-04-26 07:07:31','0.00');");
E_D("replace into `stockprice` values('128','0.21','2014-04-29 18:12:55','0.00');");
E_D("replace into `stockprice` values('129','0.21','2014-05-02 14:10:40','0.00');");
E_D("replace into `stockprice` values('130','0.21','2014-05-04 11:48:17','0.00');");
E_D("replace into `stockprice` values('131','0.21','2014-05-05 08:06:59','0.00');");
E_D("replace into `stockprice` values('132','0.21','2014-05-07 06:31:11','0.00');");
E_D("replace into `stockprice` values('133','0.21','2014-05-09 08:57:30','0.00');");
E_D("replace into `stockprice` values('134','0.21','2014-05-10 23:30:06','0.00');");
E_D("replace into `stockprice` values('135','0.21','2014-05-13 09:03:55','0.00');");
E_D("replace into `stockprice` values('136','0.21','2014-05-16 11:13:17','0.00');");
E_D("replace into `stockprice` values('137','0.21','2014-07-18 15:51:37','0.00');");
E_D("replace into `stockprice` values('138','0.21','2014-08-11 18:28:42','0.00');");
E_D("replace into `stockprice` values('139','0.21','2014-08-15 15:59:43','0.00');");
E_D("replace into `stockprice` values('140','0.21','2014-08-16 16:00:29','0.00');");
E_D("replace into `stockprice` values('141','0.21','2014-08-17 11:45:32','0.00');");
E_D("replace into `stockprice` values('142','0.21','2014-08-18 09:18:28','0.00');");
E_D("replace into `stockprice` values('143','0.21','2014-08-23 10:58:48','0.00');");

require("../../inc/footer.php");
?>