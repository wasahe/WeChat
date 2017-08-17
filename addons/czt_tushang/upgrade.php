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
if(pdo_tableexists('ims_czt_tushang_cash')) {
	if(!pdo_fieldexists('ims_czt_tushang_cash',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_cash')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_cash')) {
	if(!pdo_fieldexists('ims_czt_tushang_cash',  'uid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_cash')." ADD `uid` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_cash')) {
	if(!pdo_fieldexists('ims_czt_tushang_cash',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_cash')." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_cash')) {
	if(!pdo_fieldexists('ims_czt_tushang_cash',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_cash')." ADD `uniacid` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_cash')) {
	if(!pdo_fieldexists('ims_czt_tushang_cash',  'fee')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_cash')." ADD `fee` decimal(10,2) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_cash')) {
	if(!pdo_fieldexists('ims_czt_tushang_cash',  'amount')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_cash')." ADD `amount` decimal(10,2) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_cash')) {
	if(!pdo_fieldexists('ims_czt_tushang_cash',  'trade_no')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_cash')." ADD `trade_no` varchar(50) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_cash')) {
	if(!pdo_fieldexists('ims_czt_tushang_cash',  'payment_no')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_cash')." ADD `payment_no` varchar(50) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_cash')) {
	if(!pdo_fieldexists('ims_czt_tushang_cash',  'status')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_cash')." ADD `status` tinyint(1) unsigned DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_cash')) {
	if(!pdo_fieldexists('ims_czt_tushang_cash',  'create_time')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_cash')." ADD `create_time` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_cash')) {
	if(!pdo_fieldexists('ims_czt_tushang_cash',  'payment_time')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_cash')." ADD `payment_time` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_image')) {
	if(!pdo_fieldexists('ims_czt_tushang_image',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_image')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_image')) {
	if(!pdo_fieldexists('ims_czt_tushang_image',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_image')." ADD `uniacid` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_image')) {
	if(!pdo_fieldexists('ims_czt_tushang_image',  'uid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_image')." ADD `uid` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_image')) {
	if(!pdo_fieldexists('ims_czt_tushang_image',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_image')." ADD `openid` varchar(50) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_image')) {
	if(!pdo_fieldexists('ims_czt_tushang_image',  'origin_openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_image')." ADD `origin_openid` varchar(50) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_image')) {
	if(!pdo_fieldexists('ims_czt_tushang_image',  'title')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_image')." ADD `title` varchar(50) NOT NULL DEFAULT '我珍藏的一张图片，快来看！';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_image')) {
	if(!pdo_fieldexists('ims_czt_tushang_image',  'url')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_image')." ADD `url` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_image')) {
	if(!pdo_fieldexists('ims_czt_tushang_image',  'price')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_image')." ADD `price` decimal(10,2) NOT NULL DEFAULT '1.00';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_image')) {
	if(!pdo_fieldexists('ims_czt_tushang_image',  'up')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_image')." ADD `up` int(10) unsigned NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_image')) {
	if(!pdo_fieldexists('ims_czt_tushang_image',  'down')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_image')." ADD `down` int(10) unsigned NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_image')) {
	if(!pdo_fieldexists('ims_czt_tushang_image',  'status')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_image')." ADD `status` tinyint(1) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_image')) {
	if(!pdo_fieldexists('ims_czt_tushang_image',  'review')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_image')." ADD `review` tinyint(1) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_image')) {
	if(!pdo_fieldexists('ims_czt_tushang_image',  'qiniu_stat')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_image')." ADD `qiniu_stat` tinyint(1) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_image')) {
	if(!pdo_fieldexists('ims_czt_tushang_image',  'create_time')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_image')." ADD `create_time` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_image')) {
	if(!pdo_fieldexists('ims_czt_tushang_image',  'show_times')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_image')." ADD `show_times` int(10) unsigned NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_record')) {
	if(!pdo_fieldexists('ims_czt_tushang_record',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_record')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_record')) {
	if(!pdo_fieldexists('ims_czt_tushang_record',  'relate_id')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_record')." ADD `relate_id` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_record')) {
	if(!pdo_fieldexists('ims_czt_tushang_record',  'uid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_record')." ADD `uid` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_record')) {
	if(!pdo_fieldexists('ims_czt_tushang_record',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_record')." ADD `uniacid` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_record')) {
	if(!pdo_fieldexists('ims_czt_tushang_record',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_record')." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_record')) {
	if(!pdo_fieldexists('ims_czt_tushang_record',  'status')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_record')." ADD `status` tinyint(1) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_record')) {
	if(!pdo_fieldexists('ims_czt_tushang_record',  'is_comment')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_record')." ADD `is_comment` tinyint(1) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_record')) {
	if(!pdo_fieldexists('ims_czt_tushang_record',  'create_time')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_record')." ADD `create_time` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_record')) {
	if(!pdo_fieldexists('ims_czt_tushang_record',  'fee')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_record')." ADD `fee` decimal(10,2) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_record')) {
	if(!pdo_fieldexists('ims_czt_tushang_record',  'tid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_record')." ADD `tid` varchar(50) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_record')) {
	if(!pdo_fieldexists('ims_czt_tushang_record',  'transaction_id')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_record')." ADD `transaction_id` varchar(50) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_record')) {
	if(!pdo_fieldexists('ims_czt_tushang_record',  'out_refund_no')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_record')." ADD `out_refund_no` varchar(50) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_record')) {
	if(!pdo_fieldexists('ims_czt_tushang_record',  'type')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_record')." ADD `type` tinyint(1) NOT NULL DEFAULT '1';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_user')) {
	if(!pdo_fieldexists('ims_czt_tushang_user',  'uid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_user')." ADD `uid` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_user')) {
	if(!pdo_fieldexists('ims_czt_tushang_user',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_user')." ADD `uniacid` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_user')) {
	if(!pdo_fieldexists('ims_czt_tushang_user',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_user')." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_user')) {
	if(!pdo_fieldexists('ims_czt_tushang_user',  'origin_openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_user')." ADD `origin_openid` varchar(50) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_user')) {
	if(!pdo_fieldexists('ims_czt_tushang_user',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_user')." ADD `nickname` varchar(50) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_user')) {
	if(!pdo_fieldexists('ims_czt_tushang_user',  'headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_user')." ADD `headimgurl` varchar(256) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_user')) {
	if(!pdo_fieldexists('ims_czt_tushang_user',  'update_time')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_user')." ADD `update_time` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_user')) {
	if(!pdo_fieldexists('ims_czt_tushang_user',  'balance')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_user')." ADD `balance` decimal(10,2) NOT NULL DEFAULT '0.00';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_user')) {
	if(!pdo_fieldexists('ims_czt_tushang_user',  'income')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_user')." ADD `income` decimal(10,2) NOT NULL DEFAULT '0.00';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_user')) {
	if(!pdo_fieldexists('ims_czt_tushang_user',  'status')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_user')." ADD `status` tinyint(1) NOT NULL DEFAULT '1';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `uniacid` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'uid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `uid` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `openid` varchar(50) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'origin_openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `origin_openid` varchar(50) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'title')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `title` varchar(50) NOT NULL DEFAULT '我珍藏的一段视频，快来看！';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'url')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `url` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'thumb')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `thumb` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'duration')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `duration` smallint(6) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'price')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `price` decimal(10,2) NOT NULL DEFAULT '1.00';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'up')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `up` int(10) unsigned NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'down')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `down` int(10) unsigned NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'status')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `status` tinyint(1) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'review')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `review` tinyint(1) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'qiniu_stat')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `qiniu_stat` tinyint(1) unsigned NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'create_time')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `create_time` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_czt_tushang_video')) {
	if(!pdo_fieldexists('ims_czt_tushang_video',  'show_times')) {
		pdo_query("ALTER TABLE ".tablename('ims_czt_tushang_video')." ADD `show_times` int(10) unsigned NOT NULL DEFAULT '0';");
	}	
}
