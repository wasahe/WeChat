<?php
pdo_query("
DROP TABLE IF EXISTS `ims_water_groupbuy_order`;
CREATE TABLE `ims_water_groupbuy_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `orderno` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL COMMENT '类别',
  `themeid` int(11) DEFAULT NULL,
  `fee` float DEFAULT '0' COMMENT '金额',
  `fansid` int(11) DEFAULT NULL,
  `openid` varchar(300) DEFAULT NULL,
  `nickname` varchar(300) DEFAULT NULL,
  `headimgurl` varchar(300) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL COMMENT '时间',
  `paystate` int(2) DEFAULT '0' COMMENT '支付状态',
  `paytime` datetime DEFAULT NULL,
  `workerid` int(11) DEFAULT '0',
  `msg` varchar(100) DEFAULT NULL,
  `verify` int(2) DEFAULT '0',
  `state` int(2) DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_water_groupbuy_price`;
CREATE TABLE `ims_water_groupbuy_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `pricegroupid` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` float DEFAULT '0',
  `target` int(11) DEFAULT '0',
  `displayorder` tinyint(2) DEFAULT '0',
  `state` int(2) DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_water_groupbuy_pricegroup`;
CREATE TABLE `ims_water_groupbuy_pricegroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `groupname` varchar(100) DEFAULT NULL,
  `state` int(2) DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_water_groupbuy_share`;
CREATE TABLE `ims_water_groupbuy_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `themeid` int(11) DEFAULT NULL,
  `fansid` int(11) DEFAULT NULL,
  `openid` varchar(300) DEFAULT NULL,
  `sharetime` datetime DEFAULT NULL,
  `sharecount` int(10) DEFAULT '0',
  `workerid` int(11) DEFAULT '0',
  `verify` int(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_water_groupbuy_theme`;
CREATE TABLE `ims_water_groupbuy_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `typeid` int(11) DEFAULT NULL,
  `keyword` varchar(50) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `target` int(11) DEFAULT NULL,
  `payfee` float DEFAULT '0',
  `desc` varchar(500) DEFAULT NULL,
  `headlogo` varchar(300) DEFAULT NULL,
  `centerimg` text,
  `iconimg` varchar(300) DEFAULT NULL,
  `verifigift` varchar(300) DEFAULT NULL,
  `darkicon` varchar(300) DEFAULT NULL,
  `lighticon` varchar(300) DEFAULT NULL,
  `iconname` varchar(100) DEFAULT NULL,
  `iconnum` int(2) DEFAULT NULL,
  `icongiftsum` int(11) DEFAULT NULL,
  `icongift` varchar(100) DEFAULT NULL,
  `bottomlefttip` varchar(100) DEFAULT NULL COMMENT '底部左侧分享提示',
  `bottomshare` varchar(100) DEFAULT NULL COMMENT '底部分享礼品名称',
  `themelxr` varchar(50) DEFAULT NULL,
  `themetel` varchar(100) DEFAULT NULL,
  `tsupport` varchar(100) DEFAULT NULL,
  `tsupporturl` varchar(100) DEFAULT NULL,
  `imgs` text,
  `content` text,
  `fake` int(11) DEFAULT '100',
  `pricegroupid` int(11) DEFAULT NULL COMMENT '对应的价格组',
  `begintime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `displayorder` tinyint(2) DEFAULT '0',
  `scansum` int(11) DEFAULT '0',
  `state` int(2) DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

");
