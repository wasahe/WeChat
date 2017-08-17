<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_czt_tushang_cash` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uid` int(10) unsigned NOT NULL,
`openid` varchar(50) NOT NULL DEFAULT '',
`uniacid` int(10) unsigned NOT NULL,
`fee` decimal(10,2) NOT NULL,
`amount` decimal(10,2) NOT NULL,
`trade_no` varchar(50) NOT NULL,
`payment_no` varchar(50) NOT NULL,
`status` tinyint(1) unsigned DEFAULT '0',
`create_time` int(10) unsigned NOT NULL,
`payment_time` int(10) unsigned NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_czt_tushang_image` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uniacid` int(10) unsigned NOT NULL,
`uid` int(10) unsigned NOT NULL,
`openid` varchar(50) NOT NULL,
`origin_openid` varchar(50) NOT NULL,
`title` varchar(50) NOT NULL DEFAULT '我珍藏的一张图片，快来看！',
`url` varchar(200) NOT NULL DEFAULT '',
`price` decimal(10,2) NOT NULL DEFAULT '1.00',
`up` int(10) unsigned NOT NULL DEFAULT '0',
`down` int(10) unsigned NOT NULL DEFAULT '0',
`status` tinyint(1) NOT NULL DEFAULT '0',
`review` tinyint(1) NOT NULL DEFAULT '0',
`qiniu_stat` tinyint(1) NOT NULL DEFAULT '0',
`create_time` int(10) unsigned NOT NULL,
`show_times` int(10) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_czt_tushang_record` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`relate_id` int(10) unsigned NOT NULL,
`uid` int(10) unsigned NOT NULL,
`uniacid` int(10) unsigned NOT NULL,
`openid` varchar(50) NOT NULL DEFAULT '',
`status` tinyint(1) NOT NULL DEFAULT '0',
`is_comment` tinyint(1) NOT NULL DEFAULT '0',
`create_time` int(10) unsigned NOT NULL,
`fee` decimal(10,2) NOT NULL,
`tid` varchar(50) NOT NULL,
`transaction_id` varchar(50) NOT NULL,
`out_refund_no` varchar(50) NOT NULL,
`type` tinyint(1) NOT NULL DEFAULT '1',
PRIMARY KEY (`id`),
UNIQUE KEY `tid` (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_czt_tushang_user` (
`uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uniacid` int(10) unsigned NOT NULL,
`openid` varchar(50) NOT NULL DEFAULT '',
`origin_openid` varchar(50) NOT NULL,
`nickname` varchar(50) NOT NULL DEFAULT '',
`headimgurl` varchar(256) NOT NULL DEFAULT '',
`update_time` int(10) unsigned NOT NULL,
`balance` decimal(10,2) NOT NULL DEFAULT '0.00',
`income` decimal(10,2) NOT NULL DEFAULT '0.00',
`status` tinyint(1) NOT NULL DEFAULT '1',
PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_czt_tushang_video` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uniacid` int(10) unsigned NOT NULL,
`uid` int(10) unsigned NOT NULL,
`openid` varchar(50) NOT NULL,
`origin_openid` varchar(50) NOT NULL,
`title` varchar(50) NOT NULL DEFAULT '我珍藏的一段视频，快来看！',
`url` varchar(200) NOT NULL DEFAULT '',
`thumb` varchar(200) NOT NULL DEFAULT '',
`duration` smallint(6) NOT NULL DEFAULT '0',
`price` decimal(10,2) NOT NULL DEFAULT '1.00',
`up` int(10) unsigned NOT NULL DEFAULT '0',
`down` int(10) unsigned NOT NULL DEFAULT '0',
`status` tinyint(1) NOT NULL DEFAULT '0',
`review` tinyint(1) NOT NULL DEFAULT '0',
`qiniu_stat` tinyint(1) unsigned NOT NULL DEFAULT '0',
`create_time` int(10) unsigned NOT NULL,
`show_times` int(10) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

");
