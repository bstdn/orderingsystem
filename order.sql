-- phpMyAdmin SQL Dump
-- version 3.4.11.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 09 月 30 日 06:17
-- 服务器版本: 5.5.43
-- PHP 版本: 5.5.27-1+deb.sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- 数据库: `order`
--

-- --------------------------------------------------------

--
-- 表的结构 `sc_attachment`
--

DROP TABLE IF EXISTS `sc_attachment`;
CREATE TABLE IF NOT EXISTS `sc_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间戳',
  `file_name` varchar(255) NOT NULL DEFAULT '' COMMENT '上传文件的文件名，包含后缀名',
  `file_size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小（单位 kb）',
  `is_image` tinyint(1) NOT NULL DEFAULT '0' COMMENT '文件是否为图片（1 = image. 0 = not.）',
  `image_width` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '图片宽度',
  `image_height` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '图片高度',
  `attachment` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
  PRIMARY KEY (`id`),
  UNIQUE KEY `dateline` (`dateline`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='附件';

-- --------------------------------------------------------

--
-- 表的结构 `sc_business`
--

DROP TABLE IF EXISTS `sc_business`;
CREATE TABLE IF NOT EXISTS `sc_business` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_name` varchar(255) NOT NULL DEFAULT '' COMMENT '商家名称',
  `use_num` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '使用数',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商家';

-- --------------------------------------------------------

--
-- 表的结构 `sc_man`
--

DROP TABLE IF EXISTS `sc_man`;
CREATE TABLE IF NOT EXISTS `sc_man` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '姓名',
  `use_num` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '使用数',
  `pass_order_id` int(10) NOT NULL DEFAULT '0' COMMENT '不下单id,-1总不下单',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='下单人';

-- --------------------------------------------------------

--
-- 表的结构 `sc_order`
--

DROP TABLE IF EXISTS `sc_order`;
CREATE TABLE IF NOT EXISTS `sc_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `starttime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
  `count` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '次数',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态:0正常,1结束',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单';

-- --------------------------------------------------------

--
-- 表的结构 `sc_orderlist`
--

DROP TABLE IF EXISTS `sc_orderlist`;
CREATE TABLE IF NOT EXISTS `sc_orderlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单id',
  `man_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单人id',
  `business_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商家id',
  `product_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '菜名id',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单列表';

-- --------------------------------------------------------

--
-- 表的结构 `sc_product`
--

DROP TABLE IF EXISTS `sc_product`;
CREATE TABLE IF NOT EXISTS `sc_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL DEFAULT '' COMMENT '产品名称',
  `use_num` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '使用数',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='产品';
