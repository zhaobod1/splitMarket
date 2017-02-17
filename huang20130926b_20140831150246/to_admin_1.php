<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `to_admin`;");
E_C("CREATE TABLE `to_admin` (
  `id` int(11) NOT NULL auto_increment,
  `loginname` varchar(30) NOT NULL,
  `loginpass` varchar(30) NOT NULL,
  `group` int(5) default NULL,
  `logindate` datetime default NULL COMMENT '登录时间',
  `zq1` int(11) default '0' COMMENT '总权限1',
  `zq2` int(11) default '0' COMMENT '总权限2',
  `zq3` int(11) default '0' COMMENT '总权限3',
  `zq4` int(11) default '0',
  `zq5` int(11) default '0',
  `zq6` int(11) default '0',
  `zq7` int(11) default '0',
  `zq8` int(11) default '0',
  `zq9` int(11) default '0',
  `zq10` int(11) default '0',
  `q1` int(11) default '0' COMMENT '子权限',
  `q2` int(11) default '0',
  `q3` int(11) default '0',
  `q4` int(11) default '0',
  `q5` int(11) default '0',
  `q6` int(11) default '0',
  `q7` int(11) default '0',
  `q8` int(11) default '0',
  `q9` int(11) default '0',
  `q10` int(11) default '0',
  `q11` int(11) default '0',
  `q12` int(11) default '0',
  `q13` int(11) default '0',
  `q14` int(11) default '0',
  `q15` int(11) default '0',
  `q16` int(11) default '0',
  `q17` int(11) default '0',
  `q18` int(11) default '0',
  `q19` int(11) default '0',
  `q20` int(11) default '0',
  `q21` int(11) default '0',
  `q22` int(11) default '0',
  `q23` int(11) default '0',
  `q24` int(11) default '0',
  `q25` int(11) default '0',
  `q26` int(11) default '0',
  `q27` int(11) default '0',
  `q28` int(11) default '0',
  `q29` int(11) default '0',
  `q30` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8");
E_D("replace into `to_admin` values('1','admin','111111111','1','2014-04-19 14:44:21','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1');");
E_D("replace into `to_admin` values('2','admin8','18770074331lJ','0','2014-01-10 15:28:57','1','1','1','1','1','1','1','0','0','0','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','0','1','0','0','0','0','0','0','0');");

require("../../inc/footer.php");
?>