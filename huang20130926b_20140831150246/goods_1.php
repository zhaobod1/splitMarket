<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `goods`;");
E_C("CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `nickname` varchar(30) default '',
  `goodsname` varchar(30) default '',
  `price` decimal(9,2) NOT NULL default '0.00',
  `price2` decimal(9,2) default '0.00',
  `pv` decimal(9,2) NOT NULL default '0.00',
  `lx` int(11) NOT NULL default '0',
  `goodsimg` varchar(50) default '',
  `goodscontent` text,
  `gdate` datetime default NULL,
  `isdisplay` int(11) NOT NULL default '1',
  `kucun` int(11) default '0' COMMENT '存库',
  `sales` int(11) default '0' COMMENT '销量',
  `shunxu` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8");
E_D("replace into `goods` values('47','400','CN87762270','测试产品','1680.00','1680.00','0.00','2','1380328099.png','        测试产品	','2013-09-28 08:28:33','1','1994','6','2');");
E_D("replace into `goods` values('48','1','admin','测试产品2','1680.00','100.00','0.00','2','1363884969.jpg','    测试产品2	','2013-09-30 07:03:15','1','994','6','0');");
E_D("replace into `goods` values('49','0','','aaa','1680.00','1680.00','0.00','1','','123','2013-09-30 13:57:20','1','0','0','0');");
E_D("replace into `goods` values('50','0','','asasd','1680.00','1680.00','0.00','1','','asd','2013-09-30 16:21:37','1','0','0','0');");
E_D("replace into `goods` values('51','0','','aaa','123.00','100.00','0.00','3','','123','2013-09-30 16:44:35','1','117','6','3');");
E_D("replace into `goods` values('52','0','','asdasd','123123.00','13123.00','0.00','3','','123','2013-09-30 16:55:23','1','12312','0','2123');");

require("../../inc/footer.php");
?>