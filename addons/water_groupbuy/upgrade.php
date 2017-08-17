<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_water_groupbuy_order` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`uniacid` int(11),
`orderno` varchar(50),
`type` varchar(20),
`themeid` int(11),
`fee` float,
`fansid` int(11),
`openid` varchar(300),
`nickname` varchar(300),
`headimgurl` varchar(300),
`addtime` datetime,
`paystate` int(2),
`paytime` datetime,
`workerid` int(11),
`msg` varchar(100),
`verify` int(2),
`state` int(2),
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_water_groupbuy_price` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`uniacid` int(11),
`pricegroupid` int(11),
`name` varchar(100),
`price` float,
`target` int(11),
`displayorder` tinyint(2),
`state` int(2),
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_water_groupbuy_pricegroup` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`uniacid` int(11),
`groupname` varchar(100),
`state` int(2),
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_water_groupbuy_share` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`uniacid` int(11),
`themeid` int(11),
`fansid` int(11),
`openid` varchar(300),
`sharetime` datetime,
`sharecount` int(10),
`workerid` int(11),
`verify` int(2),
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_water_groupbuy_theme` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`uniacid` int(11) NOT NULL,
`typeid` int(11),
`keyword` varchar(50),
`title` varchar(100) NOT NULL,
`target` int(11),
`payfee` float,
`desc` varchar(500),
`headlogo` varchar(300),
`centerimg` text,
`iconimg` varchar(300),
`verifigift` varchar(300),
`darkicon` varchar(300),
`lighticon` varchar(300),
`iconname` varchar(100),
`iconnum` int(2),
`icongiftsum` int(11),
`icongift` varchar(100),
`bottomlefttip` varchar(100),
`bottomshare` varchar(100),
`themelxr` varchar(50),
`themetel` varchar(100),
`tsupport` varchar(100),
`tsupporturl` varchar(100),
`imgs` text,
`content` text,
`fake` int(11),
`pricegroupid` int(11),
`begintime` datetime,
`endtime` datetime,
`displayorder` tinyint(2),
`scansum` int(11),
`state` int(2),
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

");
if(pdo_tableexists('ims_water_groupbuy_order')) {
	if(!pdo_fieldexists('ims_water_groupbuy_order',  'state')) {
		pdo_query("ALTER TABLE ".tablename('ims_water_groupbuy_order')." ADD `state` int(2);");
	}	
}
if(pdo_tableexists('ims_water_groupbuy_price')) {
	if(!pdo_fieldexists('ims_water_groupbuy_price',  'state')) {
		pdo_query("ALTER TABLE ".tablename('ims_water_groupbuy_price')." ADD `state` int(2);");
	}	
}
if(pdo_tableexists('ims_water_groupbuy_pricegroup')) {
	if(!pdo_fieldexists('ims_water_groupbuy_pricegroup',  'state')) {
		pdo_query("ALTER TABLE ".tablename('ims_water_groupbuy_pricegroup')." ADD `state` int(2);");
	}	
}
if(pdo_tableexists('ims_water_groupbuy_share')) {
	if(!pdo_fieldexists('ims_water_groupbuy_share',  'verify')) {
		pdo_query("ALTER TABLE ".tablename('ims_water_groupbuy_share')." ADD `verify` int(2);");
	}	
}
if(pdo_tableexists('ims_water_groupbuy_theme')) {
	if(!pdo_fieldexists('ims_water_groupbuy_theme',  'state')) {
		pdo_query("ALTER TABLE ".tablename('ims_water_groupbuy_theme')." ADD `state` int(2);");
	}	
}
