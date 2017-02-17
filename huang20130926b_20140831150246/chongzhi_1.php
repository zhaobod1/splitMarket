<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `chongzhi`;");
E_C("CREATE TABLE `chongzhi` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `nickname` varchar(30) default '',
  `username` varchar(30) default NULL,
  `jine` decimal(9,2) NOT NULL default '0.00',
  `lx` int(11) NOT NULL default '0',
  `cdate` datetime default NULL,
  `sdate` datetime default NULL,
  `isgrant` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8");
E_D("replace into `chongzhi` values('4','1','admin','默认数据','600000.00','0','2013-11-20 13:52:41','2013-11-20 13:52:41','1');");
E_D("replace into `chongzhi` values('5','359','CN32440','星晨','1420.00','0','2013-11-26 17:45:00','2013-11-26 17:45:00','1');");
E_D("replace into `chongzhi` values('9','405','CN47168','张海','2700.00','0','2013-12-04 20:56:08','2013-12-04 20:56:08','1');");
E_D("replace into `chongzhi` values('7','403','CN95573','陈建明','100.00','0','2013-12-03 09:45:34','2013-12-03 09:45:34','1');");
E_D("replace into `chongzhi` values('10','388','CN03954','大平','3000.00','0','2013-12-05 23:38:19','2013-12-05 23:38:19','0');");
E_D("replace into `chongzhi` values('11','403','CN95573','阿哥','780.00','0','2013-12-09 22:44:15','2013-12-09 22:44:15','1');");
E_D("replace into `chongzhi` values('12','403','CN95573','阿哥','390.00','0','2013-12-10 11:07:43','2013-12-10 11:07:43','1');");
E_D("replace into `chongzhi` values('13','403','CN95573','阿哥','850.00','0','2013-12-10 15:31:13','2013-12-10 15:31:13','1');");
E_D("replace into `chongzhi` values('14','405','CN47168','张海','130.00','0','2013-12-10 20:09:22','2013-12-10 20:09:22','1');");
E_D("replace into `chongzhi` values('15','433','CN11711','恒大','10.00','0','2013-12-11 15:47:34','2013-12-11 15:47:34','1');");
E_D("replace into `chongzhi` values('16','374','CN29224','刘姥姥','10.00','0','2013-12-11 16:20:30','2013-12-11 16:20:30','1');");
E_D("replace into `chongzhi` values('17','416','CN39271','朱孟可','90.00','0','2013-12-16 18:50:03','2013-12-16 18:50:03','0');");
E_D("replace into `chongzhi` values('18','403','CN95573','阿哥','270.00','0','2013-12-23 15:07:13','2013-12-23 15:07:13','1');");
E_D("replace into `chongzhi` values('19','551','CN26221','默认数据','222222.00','0','2013-12-27 11:49:41','2013-12-27 11:49:41','0');");
E_D("replace into `chongzhi` values('20','502','CN83715','zh','3000.00','0','2013-12-30 21:08:20','2013-12-30 21:08:20','0');");
E_D("replace into `chongzhi` values('21','403','CN95573','半夜唱情歌','270.00','0','2013-12-31 12:18:50','2013-12-31 12:18:50','1');");
E_D("replace into `chongzhi` values('22','403','CN95573','半夜唱情歌','760.00','0','2013-12-31 13:20:07','2013-12-31 13:20:07','1');");
E_D("replace into `chongzhi` values('23','403','CN95573','半夜唱情歌','162.00','0','2014-01-22 16:43:35','2014-01-22 16:43:35','0');");
E_D("replace into `chongzhi` values('24','403','CN95573','半夜唱情歌','1000.00','0','2014-01-23 09:51:08','2014-01-23 09:51:08','1');");
E_D("replace into `chongzhi` values('25','397','CN20830','梓郡主','2200.00','0','2014-02-10 12:26:23','2014-02-10 12:26:23','1');");
E_D("replace into `chongzhi` values('26','399','CN57376','老徐','3000.00','0','2014-02-12 13:15:32','2014-02-12 13:15:32','1');");
E_D("replace into `chongzhi` values('27','403','CN95573','半夜唱情歌','641.00','0','2014-02-13 11:27:01','2014-02-13 11:27:01','1');");
E_D("replace into `chongzhi` values('28','403','CN95573','半夜唱情歌','1260.00','0','2014-02-17 10:16:53','2014-02-17 10:16:53','1');");
E_D("replace into `chongzhi` values('29','645','CN28222','默认数据','1000.00','0','2014-02-17 11:38:47','2014-02-17 11:38:47','1');");
E_D("replace into `chongzhi` values('30','403','CN95573','半夜唱情歌','170.00','0','2014-02-17 11:44:33','2014-02-17 11:44:33','1');");
E_D("replace into `chongzhi` values('31','363','CN31310','北京海淀','3000.00','0','2014-02-17 13:15:07','2014-02-17 13:15:07','1');");
E_D("replace into `chongzhi` values('32','403','CN95573','半夜唱情歌','600.00','0','2014-02-17 16:15:54','2014-02-17 16:15:54','1');");
E_D("replace into `chongzhi` values('35','406','CN30721','白金芳','600.00','0','2014-02-17 21:14:50','2014-02-17 21:14:50','1');");
E_D("replace into `chongzhi` values('34','539','CN65236','美人姣','3500.00','0','2014-02-17 19:27:40','2014-02-17 19:27:40','1');");
E_D("replace into `chongzhi` values('36','645','CN28222','默认数据','1000.00','0','2014-02-18 11:59:17','2014-02-18 11:59:17','0');");
E_D("replace into `chongzhi` values('37','403','CN95573','半夜唱情歌','750.00','0','2014-02-21 12:52:55','2014-02-21 12:52:55','1');");
E_D("replace into `chongzhi` values('38','403','CN95573','半夜唱情歌','1640.00','0','2014-02-21 13:14:36','2014-02-21 13:14:36','1');");
E_D("replace into `chongzhi` values('39','403','CN95573','半夜唱情歌','30.00','0','2014-02-21 13:28:56','2014-02-21 13:28:56','1');");
E_D("replace into `chongzhi` values('40','403','CN95573','半夜唱情歌','340.00','0','2014-02-21 13:51:03','2014-02-21 13:51:03','1');");
E_D("replace into `chongzhi` values('41','535','CN22897','周','17000.00','0','2014-02-24 10:00:45','2014-02-24 10:00:45','0');");
E_D("replace into `chongzhi` values('42','535','CN22897','周','2742.00','0','2014-02-24 10:11:15','2014-02-24 10:11:15','1');");
E_D("replace into `chongzhi` values('43','416','CN39271','朱孟可','30.00','0','2014-02-24 12:44:20','2014-02-24 12:44:20','0');");
E_D("replace into `chongzhi` values('44','535','CN22897','周','2258.00','0','2014-02-26 13:02:41','2014-02-26 13:02:41','1');");

require("../../inc/footer.php");
?>