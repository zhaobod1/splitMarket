<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `lsbd`;");
E_C("CREATE TABLE `lsbd` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `nickname` varchar(255) default NULL,
  `username` varchar(255) default NULL,
  `sid` int(11) default NULL,
  `snickname` varchar(255) default NULL,
  `susername` varchar(255) default NULL,
  `lsk` decimal(10,0) default NULL,
  `bdate` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>