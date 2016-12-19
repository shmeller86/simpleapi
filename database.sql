/*
Navicat MySQL Data Transfer

Source Server         : bestamp
Source Server Version : 50173
Source Host           : 37.230.112.153:3306
Source Database       : xp0trade

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2016-12-19 20:10:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for test-comment
-- ----------------------------
DROP TABLE IF EXISTS `test-comment`;
CREATE TABLE `test-comment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `text` text,
  `data` datetime DEFAULT NULL,
  `feed_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for test-work
-- ----------------------------
DROP TABLE IF EXISTS `test-work`;
CREATE TABLE `test-work` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `pd` datetime NOT NULL,
  `ud` datetime NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=662 DEFAULT CHARSET=utf8;
