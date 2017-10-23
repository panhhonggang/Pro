/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : pubdata

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-10-23 09:57:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pub_vendors
-- ----------------------------
DROP TABLE IF EXISTS `pub_vendors`;
CREATE TABLE `pub_vendors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `user` varchar(32) NOT NULL COMMENT '供销商登陆的用户名',
  `name` varchar(32) NOT NULL COMMENT '供销商的名字',
  `password` varchar(32) NOT NULL COMMENT '供销商登陆的密码',
  `phone` varchar(11) NOT NULL COMMENT '供销商手机号码',
  `email` varchar(50) DEFAULT NULL COMMENT '供销商邮箱',
  `address` varchar(255) DEFAULT NULL COMMENT '供销商地址',
  `leavel` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '供销商级别：默认为“1”级',
  `pid` int(11) NOT NULL DEFAULT '1' COMMENT '经销商上级ID',
  `addtime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `user` (`user`,`name`,`password`,`email`,`phone`,`leavel`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pub_vendors
-- ----------------------------
INSERT INTO `pub_vendors` VALUES ('1', 'admin', '炒鸡管理员', '202cb962ac59075b964b07152d234b70', '13777771111', null, null, '1', '0', '0000-00-00 00:00:00');
