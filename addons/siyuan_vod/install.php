<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_siyuan_vod` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`title` varchar(100) NOT NULL DEFAULT '',
`blei` int(11),
`slei` int(11),
`thumb` varchar(300) NOT NULL DEFAULT '',
`displayorder` int(10) unsigned NOT NULL DEFAULT '0',
`weid` int(10) unsigned NOT NULL,
`pic` varchar(300),
`body` text,
`yuedu` int(20) NOT NULL DEFAULT '0',
`time` int(10),
`shuxing` varchar(20),
`lianzai` varchar(50),
`gx` varchar(500),
`play` int(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_bug` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL DEFAULT '0',
`vid` int(11) NOT NULL DEFAULT '0',
`title` varchar(200),
`openid` varchar(100),
`bug` int(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `indx_houseid` (`vid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_fenlei` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(10) unsigned NOT NULL DEFAULT '0',
`nid` int(10) unsigned NOT NULL DEFAULT '0',
`name` varchar(50) NOT NULL,
`thumb` varchar(200) NOT NULL,
`parentid` int(10) unsigned NOT NULL DEFAULT '0',
`displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
`enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_flash` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(10) unsigned NOT NULL,
`title` varchar(100) NOT NULL DEFAULT '',
`url` varchar(200) NOT NULL DEFAULT '',
`attachment` varchar(100) NOT NULL DEFAULT '',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_kv` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL DEFAULT '0',
`vid` int(11) NOT NULL DEFAULT '0',
`ji` varchar(512) NOT NULL DEFAULT '',
`url` varchar(512) NOT NULL DEFAULT '',
`displayorder` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `indx_houseid` (`vid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_menu` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(10) unsigned NOT NULL,
`title` varchar(100) NOT NULL DEFAULT '',
`url` varchar(200) NOT NULL DEFAULT '',
`displayorder` int(10) NOT NULL DEFAULT '0',
`thumb` varchar(100) NOT NULL DEFAULT '',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_play_set` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`videojj_key` varchar(100) NOT NULL,
`playm3u8_key` varchar(100) NOT NULL,
`playm3u8_host` varchar(100) NOT NULL,
`playm3u8_title` varchar(200) NOT NULL,
`playm3u8_url` varchar(150) DEFAULT 'http://www.playm3u8.com',
`playm3u8_site1` varchar(150) NOT NULL,
`playm3u8_site2` varchar(150) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_setting` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL DEFAULT '0',
`name` varchar(20),
`ad` varchar(50),
`logo` varchar(300),
`qr` varchar(300),
`top_logo` varchar(300),
`openid` varchar(100),
`color` varchar(10),
`ad_pic` varchar(200),
`ad_url` varchar(200),
`vod_xiaoxi` varchar(100),
`bug_xiaoxi` varchar(100),
`open` int(1) NOT NULL DEFAULT '0',
`time` int(10) NOT NULL DEFAULT '5000',
`bottom_name` varchar(50),
`bottom_ad` varchar(100),
`bottom_logo` varchar(300),
`bottom_qr` varchar(250),
`tishi` varchar(500),
`fengge` int(1) NOT NULL DEFAULT '0',
`video_key` varchar(20) NOT NULL,
`share_url` varchar(300) NOT NULL,
PRIMARY KEY (`id`),
KEY `indx_uniacid` (`weid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_so` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(10) unsigned NOT NULL,
`title` varchar(100) NOT NULL DEFAULT '',
`vid` varchar(200) NOT NULL DEFAULT '',
`displayorder` int(10) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

");
