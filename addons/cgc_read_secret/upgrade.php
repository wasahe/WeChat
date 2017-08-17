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
if(pdo_tableexists('ims_cgc_read_secret')) {
	if(!pdo_fieldexists('ims_cgc_read_secret',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret')) {
	if(!pdo_fieldexists('ims_cgc_read_secret',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret')." ADD `uniacid` int(3) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret')) {
	if(!pdo_fieldexists('ims_cgc_read_secret',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret')." ADD `openid` varchar(100) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret')) {
	if(!pdo_fieldexists('ims_cgc_read_secret',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret')." ADD `nickname` varchar(200) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret')) {
	if(!pdo_fieldexists('ims_cgc_read_secret',  'headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret')." ADD `headimgurl` varchar(255) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret')) {
	if(!pdo_fieldexists('ims_cgc_read_secret',  'question')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret')." ADD `question` varchar(255) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret')) {
	if(!pdo_fieldexists('ims_cgc_read_secret',  'answer')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret')." ADD `answer` varchar(255) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret')) {
	if(!pdo_fieldexists('ims_cgc_read_secret',  'fee')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret')." ADD `fee` decimal(7,2) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret')) {
	if(!pdo_fieldexists('ims_cgc_read_secret',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret')." ADD `createtime` int(11);");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_fee')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_fee',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_fee')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_fee')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_fee',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_fee')." ADD `uniacid` int(3) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_fee')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_fee',  'fee')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_fee')." ADD `fee` decimal(7,2) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_fee')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_fee',  'desc')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_fee')." ADD `desc` varchar(100) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_fee')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_fee',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_fee')." ADD `createtime` int(11);");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `uniacid` int(3) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'secret_id')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `secret_id` int(10) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'secret_openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `secret_openid` varchar(100) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'secret_nickname')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `secret_nickname` varchar(100) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'secret_headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `secret_headimgurl` varchar(255) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `openid` varchar(100) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `nickname` varchar(200) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `headimgurl` varchar(255) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'payment')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `payment` decimal(7,2) NOT NULL DEFAULT '0.00';");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'pay_status')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `pay_status` int(1) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'order_sn')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `order_sn` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'wechat_no')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `wechat_no` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'sx_fee')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `sx_fee` decimal(9,2) DEFAULT '0.00';");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'pay_log')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `pay_log` varchar(255) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'pay_type')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `pay_type` varchar(20) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_record')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_record',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_record')." ADD `createtime` int(11);");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_user')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_user',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_user')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_user')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_user',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_user')." ADD `uniacid` int(3) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_user')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_user',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_user')." ADD `openid` varchar(100) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_user')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_user',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_user')." ADD `nickname` varchar(200) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_user')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_user',  'headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_user')." ADD `headimgurl` varchar(255) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_user')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_user',  'amount')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_user')." ADD `amount` decimal(9,2) DEFAULT '0.00';");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_user')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_user',  'pay_amount')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_user')." ADD `pay_amount` decimal(9,2) DEFAULT '0.00';");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_user')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_user',  'no_account_amount')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_user')." ADD `no_account_amount` decimal(9,2) DEFAULT '0.00';");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_user')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_user',  'total_amount')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_user')." ADD `total_amount` decimal(9,2) DEFAULT '0.00';");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_user')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_user',  'sx_fee')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_user')." ADD `sx_fee` decimal(9,2) DEFAULT '0.00';");
	}	
}
if(pdo_tableexists('ims_cgc_read_secret_user')) {
	if(!pdo_fieldexists('ims_cgc_read_secret_user',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_read_secret_user')." ADD `createtime` int(11);");
	}	
}
