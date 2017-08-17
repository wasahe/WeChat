<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hticket_activity` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`uniacid` int(10) unsigned NOT NULL,
`title` varchar(50) NOT NULL,
`description` varchar(100) NOT NULL,
`shareimg` varchar(100) NOT NULL,
`singleimg` varchar(100) NOT NULL,
`content` text NOT NULL,
`status` tinyint(1) unsigned DEFAULT '0',
`starttime` int(11) unsigned NOT NULL,
`endtime` int(11) unsigned NOT NULL,
`place` varchar(100) NOT NULL,
`createtime` int(11) unsigned NOT NULL,
`extype` tinyint(1) unsigned NOT NULL DEFAULT '0',
`proname` varchar(50) NOT NULL,
`tlimit` int(11) unsigned NOT NULL,
`scantimes` int(11) unsigned NOT NULL DEFAULT '1',
`buylimit` int(8) unsigned NOT NULL,
`fee` decimal(10,2) NOT NULL DEFAULT '0.00',
`author` varchar(50) NOT NULL,
`groups` varchar(200) NOT NULL,
`viewnums` int(11) unsigned NOT NULL,
`isseat` tinyint(2) unsigned NOT NULL,
`seatsets` text NOT NULL,
`usedseats` text NOT NULL,
`orderseats` text NOT NULL,
PRIMARY KEY (`id`),
KEY `uniacid` (`uniacid`),
KEY `status` (`status`),
KEY `isseat` (`isseat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_hticket_log` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`uniacid` int(10) unsigned NOT NULL,
`orderid` int(11) unsigned NOT NULL,
`actid` int(11) unsigned NOT NULL,
`scanown` varchar(50) NOT NULL,
`type` int(2) unsigned NOT NULL DEFAULT '1',
`remark` varchar(100) NOT NULL,
`createtime` int(11) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `uniacid` (`uniacid`),
KEY `orderid` (`orderid`),
KEY `actid` (`actid`),
KEY `scanown` (`scanown`),
KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_hticket_order` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`uniacid` int(10) unsigned NOT NULL,
`openid` varchar(50) NOT NULL,
`actid` int(11) unsigned NOT NULL,
`type` varchar(20) NOT NULL,
`fee` decimal(10,2) NOT NULL DEFAULT '0.00',
`status` tinyint(1) unsigned NOT NULL DEFAULT '0',
`scanown` varchar(50) NOT NULL,
`remark` varchar(50) NOT NULL,
`createtime` int(11) unsigned NOT NULL,
`paytime` int(11) unsigned NOT NULL,
`scantime` int(11) unsigned NOT NULL,
`closetime` int(11) unsigned NOT NULL,
PRIMARY KEY (`id`),
KEY `uniacid` (`uniacid`),
KEY `openid` (`openid`),
KEY `actid` (`actid`),
KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_hticket_seat` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`uniacid` int(10) unsigned NOT NULL,
`openid` varchar(50) NOT NULL,
`orid` int(11) unsigned NOT NULL,
`seats` text NOT NULL,
`ptime` varchar(50) NOT NULL,
`nums` int(11) unsigned NOT NULL DEFAULT '0',
`price` float NOT NULL,
`createtime` int(11) unsigned NOT NULL,
`remark` varchar(150) NOT NULL,
PRIMARY KEY (`id`),
KEY `uniacid` (`uniacid`),
KEY `openid` (`openid`),
KEY `orid` (`orid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

");
