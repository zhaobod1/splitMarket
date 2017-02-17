<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `systemparameters`;");
E_C("CREATE TABLE `systemparameters` (
  `id` int(11) NOT NULL auto_increment,
  `txbs` int(9) default NULL COMMENT '提现倍数',
  `txmix` decimal(11,0) default NULL COMMENT '提现最小金额',
  `txsl` decimal(10,0) default NULL COMMENT '提现手续费',
  `sl` decimal(10,0) default NULL COMMENT '奖金税收',
  `wlf` decimal(10,0) default NULL COMMENT '网络维护费',
  `xtkg` int(11) default NULL COMMENT '统系开关',
  `azkg` int(11) default NULL COMMENT '安置开关',
  `tjkg` int(11) default NULL COMMENT '推荐关系图开关',
  `bdbonus` int(11) default NULL COMMENT '服务中心查看奖金',
  `qq1` varchar(255) default NULL,
  `qq2` varchar(255) default NULL,
  `qq3` varchar(255) default NULL,
  `qq4` varchar(255) default NULL,
  `isb2` int(11) default NULL,
  `isb3` int(11) default NULL,
  `yeji` decimal(11,0) default NULL COMMENT '系统业绩',
  `jmf1` decimal(11,0) default NULL,
  `jmf2` decimal(11,0) default NULL,
  `ff` int(11) default NULL,
  `ms` int(11) default NULL,
  `d1` decimal(11,0) default NULL,
  `d2` decimal(10,0) default NULL,
  `d3` decimal(10,0) default NULL,
  `d4` decimal(10,0) default NULL,
  `d5` decimal(10,0) default NULL,
  `d6` decimal(10,0) default NULL,
  `d7` decimal(10,0) default NULL,
  `d8` decimal(10,0) default NULL,
  `d9` decimal(10,0) default NULL,
  `d10` decimal(10,0) default NULL,
  `ds1` decimal(10,0) default NULL,
  `ds2` decimal(10,0) default NULL,
  `ds3` decimal(10,0) default NULL,
  `ds4` decimal(10,0) default NULL,
  `ds5` decimal(10,0) default NULL,
  `ds6` decimal(10,0) default NULL,
  `ds7` decimal(10,0) default NULL,
  `ds8` decimal(10,0) default NULL,
  `ds9` decimal(10,0) default NULL,
  `ds10` decimal(10,0) default NULL,
  `dbl1` decimal(10,0) default NULL,
  `dbl2` decimal(10,0) default NULL,
  `dbl3` decimal(10,0) default NULL,
  `dbl4` decimal(10,0) default NULL,
  `dbl5` decimal(10,0) default NULL,
  `dbl6` decimal(10,0) default NULL,
  `dbl7` decimal(10,0) default NULL,
  `dbl8` decimal(10,0) default NULL,
  `dbl9` decimal(10,0) default NULL,
  `dbl10` decimal(10,0) default NULL,
  `lsbl` decimal(10,0) default NULL,
  `fxkc` decimal(10,0) default NULL,
  `fxlj` decimal(10,0) default NULL,
  `fxtzbl` decimal(10,0) default NULL,
  `jybl` decimal(10,0) default NULL,
  `password1` varchar(255) default NULL,
  `password2` varchar(255) default NULL,
  `ziliao` int(11) default NULL,
  `duanxinzhanghao` varchar(255) default NULL COMMENT '短信接口帐号',
  `duanxinmima` varchar(255) default NULL COMMENT '短信接口密码',
  `peprice` decimal(10,2) default NULL,
  `petcount` decimal(10,2) default NULL,
  `petallcount` decimal(10,2) default NULL,
  `ispe` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
E_D("replace into `systemparameters` values('1','100','100','10','0','0','1','1','1','1','123456','123456','123456','123456','1','1','1177500','0','0','1','1','1000000','2000000','4000000','8000000','16000000','32000000','64000000','128000000','256000000','512000000','1','2','3','4','5','6','7','8','9','10','10','9','8','7','6','5','4','3','2','1','50','10','1000','25','80','111111','222222','1','wld','wld888','0.21','259267.96','6259267.96','1');");

require("../../inc/footer.php");
?>