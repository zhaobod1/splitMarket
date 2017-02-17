<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `orders`;");
E_C("CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `ordersnumber` varchar(30) default '' COMMENT '订单编号',
  `logistics` varchar(30) default NULL,
  `logisticsno` varchar(30) default '' COMMENT '快递编号',
  `uid` int(11) NOT NULL default '0',
  `userid` varchar(30) default '',
  `username` varchar(30) default NULL,
  `usertel` varchar(30) default NULL,
  `useraddress` varchar(50) default '',
  `goods` text,
  `sgb` decimal(9,2) NOT NULL default '0.00',
  `gwb` decimal(9,2) NOT NULL default '0.00',
  `cdate` datetime default NULL,
  `sdate` datetime default NULL,
  `issend` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>