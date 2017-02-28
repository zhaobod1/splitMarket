<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ulevelup`;");
E_C("CREATE TABLE `ulevelup` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `nickname` varchar(30) default NULL,
  `username` varchar(255) default NULL,
  `ylevel` int(11) default NULL,
  `uplevel` int(11) default NULL,
  `bdid` int(11) default NULL,
  `bdname` varchar(30) default NULL,
  `udate` datetime default NULL,
  `issh` int(11) default '0',
  `cha` decimal(10,0) default NULL,
  `sid` int(11) default NULL,
  `snickname` varchar(30) default NULL,
  `susername` varchar(30) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");

require("../../inc/footer.php");
?>