/*
MySQL Data Transfer
Source Host: localhost
Source Database: huang20130926b
Target Host: localhost
Target Database: huang20130926b
Date: 2014/1/13 3:51:36
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for zengjianjilu
-- ----------------------------
CREATE TABLE `zengjianjilu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `nickname` varchar(30) DEFAULT '',
  `username` varchar(30) DEFAULT NULL,
  `jine` decimal(9,2) DEFAULT NULL,
  `jine2` decimal(9,2) NOT NULL DEFAULT '0.00',
  `cdate` datetime DEFAULT NULL,
  `sdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
