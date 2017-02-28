<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `email`;");
E_C("CREATE TABLE `email` (
  `id` int(11) NOT NULL auto_increment,
  `isstart` int(11) default NULL COMMENT '否是开启Email功能',
  `zchy` int(11) default NULL COMMENT '是否开启注册欢迎',
  `hytitle` text COMMENT '欢迎标题',
  `hycontent` text COMMENT '欢迎内容',
  `txtzhy` int(11) default NULL COMMENT '提现通知会员',
  `txtzadmin` int(11) default NULL COMMENT '提现通知管理员',
  `cztzadmin` int(11) default NULL,
  `hktzadmin` int(11) default NULL,
  `ddtzadmin` int(11) default NULL COMMENT '订单通知管理员',
  `emailuser` varchar(255) default NULL,
  `emailpass` varchar(255) default NULL,
  `emailname` varchar(255) default NULL,
  `emailsmtp` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
E_D("replace into `email` values('1','0','1','欢迎使用直销软件','欢迎您注册直销软件会员管理系统.\r\n','1','1','1','1','1','','','管理员','smtp.qq.com');");

require("../../inc/footer.php");
?>