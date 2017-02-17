<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `huikuan`;");
E_C("CREATE TABLE `huikuan` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `nickname` varchar(30) default '',
  `username` varchar(255) default NULL,
  `bankcard` varchar(30) default '',
  `bankusername` varchar(30) default '',
  `jine` decimal(9,2) NOT NULL default '0.00',
  `sdate` datetime default NULL,
  `sid` int(11) NOT NULL default '0',
  `snickname` varchar(30) default '',
  `hdate` datetime default NULL,
  `qdate` datetime default NULL,
  `shuoming` varchar(50) default '',
  `isgrant` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>