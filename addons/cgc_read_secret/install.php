<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_cgc_read_secret` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uniacid` int(3) NOT NULL,
`openid` varchar(100) NOT NULL,
`nickname` varchar(200) NOT NULL,
`headimgurl` varchar(255) NOT NULL,
`question` varchar(255) NOT NULL,
`answer` varchar(255) NOT NULL,
`fee` decimal(7,2) NOT NULL,
`createtime` int(11),
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_cgc_read_secret_fee` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uniacid` int(3) NOT NULL,
`fee` decimal(7,2) NOT NULL,
`desc` varchar(100) NOT NULL,
`createtime` int(11),
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_cgc_read_secret_record` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uniacid` int(3) NOT NULL,
`secret_id` int(10) NOT NULL,
`secret_openid` varchar(100) NOT NULL,
`secret_nickname` varchar(100) NOT NULL,
`secret_headimgurl` varchar(255) NOT NULL,
`openid` varchar(100) NOT NULL,
`nickname` varchar(200) NOT NULL,
`headimgurl` varchar(255) NOT NULL,
`payment` decimal(7,2) NOT NULL DEFAULT '0.00',
`pay_status` int(1) NOT NULL DEFAULT '0',
`order_sn` varchar(200) NOT NULL DEFAULT '',
`wechat_no` varchar(200) NOT NULL DEFAULT '',
`sx_fee` decimal(9,2) DEFAULT '0.00',
`pay_log` varchar(255) NOT NULL,
`pay_type` varchar(20) NOT NULL,
`createtime` int(11),
PRIMARY KEY (`id`),
KEY `cgc_read_secret_record_index1` (`uniacid`,`secret_openid`),
KEY `cgc_read_secret_record_index2` (`uniacid`,`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_cgc_read_secret_user` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uniacid` int(3) NOT NULL,
`openid` varchar(100) NOT NULL,
`nickname` varchar(200) NOT NULL,
`headimgurl` varchar(255) NOT NULL,
`amount` decimal(9,2) DEFAULT '0.00',
`pay_amount` decimal(9,2) DEFAULT '0.00',
`no_account_amount` decimal(9,2) DEFAULT '0.00',
`total_amount` decimal(9,2) DEFAULT '0.00',
`sx_fee` decimal(9,2) DEFAULT '0.00',
`createtime` int(11),
PRIMARY KEY (`id`),
KEY `uniacid_openid_index` (`uniacid`,`openid`),
KEY `uniacid_amount_index` (`uniacid`,`openid`,`amount`),
KEY `uniacid_total_amount_index` (`uniacid`,`openid`,`total_amount`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

");
