<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `ulevel`;");
E_C("CREATE TABLE `ulevel` (
  `id` int(11) NOT NULL auto_increment,
  `ulevel` int(11) default NULL COMMENT '级别',
  `lvname` varchar(30) default NULL COMMENT '级别名称',
  `dan` int(11) default NULL COMMENT '单数',
  `lsk` decimal(9,0) default NULL COMMENT '投资金额',
  `isbd` int(11) default NULL COMMENT '申请报单中心资格',
  `yl1` decimal(9,0) default NULL COMMENT '奖金预留位置1',
  `yl2` decimal(9,0) default NULL,
  `yl3` decimal(9,0) default NULL,
  `yl4` decimal(9,0) default NULL,
  `yl5` decimal(9,0) default NULL,
  `yl6` decimal(9,0) default NULL,
  `yl7` decimal(9,0) default NULL,
  `yl8` decimal(9,0) default NULL,
  `yl9` decimal(9,0) default NULL,
  `yl10` decimal(9,0) default NULL,
  `yl11` decimal(9,0) default NULL,
  `yl12` decimal(9,0) default NULL,
  `yl13` decimal(9,0) default NULL,
  `yl14` decimal(9,0) default NULL,
  `yl15` decimal(9,0) default NULL,
  `yl16` decimal(9,0) default NULL,
  `yl17` decimal(9,0) default NULL,
  `yl18` decimal(9,0) default NULL,
  `yl19` decimal(9,0) default NULL,
  `yl20` decimal(9,0) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8");
E_D("replace into `ulevel` values('1','1','一级会员','1','500','0','10','8','5','4','3','2','1','3','5','80','0','0','0','0','0','0','0','0','0','0');");
E_D("replace into `ulevel` values('2','2','二级会员','3','1000','0','10','8','5','4','3','2','1','0','0','0','0','0','0','0','0','0','0','0','0','0');");
E_D("replace into `ulevel` values('3','3','三级会员','5','2000','0','10','8','5','4','3','2','1','0','0','0','0','0','0','0','0','0','0','0','0','0');");
E_D("replace into `ulevel` values('4','4','四级会员','10','3000','0','10','8','5','4','3','2','1','0','0','0','0','0','0','0','0','0','0','0','0','0');");

require("../../inc/footer.php");
?>