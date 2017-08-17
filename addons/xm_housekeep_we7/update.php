<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_xm_housekeep_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `link` varchar(300) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `top` int(11) NOT NULL,
  `addtime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_xm_housekeep_base` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `yyopenid` varchar(100) DEFAULT NULL,
  `bili` float DEFAULT NULL,
  `lead` varchar(100) DEFAULT NULL,
  `sbili` float DEFAULT NULL,
  `comment1` varchar(500) DEFAULT NULL,
  `comment2` varchar(500) DEFAULT NULL,
  `comment3` varchar(500) DEFAULT NULL,
  `msg1` varchar(100) DEFAULT NULL,
  `hello1` varchar(500) DEFAULT NULL,
  `remark1` varchar(500) DEFAULT NULL,
  `msg2` varchar(100) DEFAULT NULL,
  `hello2` varchar(500) DEFAULT NULL,
  `remark2` varchar(500) DEFAULT NULL,
  `msg3` varchar(100) DEFAULT NULL,
  `hello3` varchar(500) DEFAULT NULL,
  `remark3` varchar(500) DEFAULT NULL,
  `msg4` varchar(100) DEFAULT NULL,
  `hello4` varchar(500) DEFAULT NULL,
  `remark4` varchar(500) DEFAULT NULL,
  `msg5` varchar(100) DEFAULT NULL,
  `hello5` varchar(500) DEFAULT NULL,
  `remark5` varchar(500) DEFAULT NULL,
  `share_title` varchar(500) DEFAULT NULL,
  `share_icon` varchar(100) DEFAULT NULL,
  `share_content` varchar(500) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_xm_housekeep_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT NULL,
  `openid` varchar(80) DEFAULT NULL,
  `staff_id` varchar(100) DEFAULT NULL,
  `xing` int(11) DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_xm_housekeep_cutlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `orderformid` int(11) DEFAULT NULL,
  `waiterid` int(11) DEFAULT NULL,
  `openid` varchar(100) DEFAULT NULL,
  `closemoney` float DEFAULT NULL,
  `cut` float DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `staff_openid` varchar(100) DEFAULT NULL,
  `staff_name` varchar(100) DEFAULT NULL,
  `staff_mobile` varchar(100) DEFAULT NULL,
  `flag` int(11) DEFAULT '0',
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_xm_housekeep_givecut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` varchar(80) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `openid` varchar(80) DEFAULT NULL,
  `staff_name` varchar(100) DEFAULT NULL,
  `cut` float DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_xm_housekeep_orderform` (
  `orderformid` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT NULL,
  `openid` varchar(80) DEFAULT NULL,
  `typeid` int(11) DEFAULT NULL,
  `ftime` datetime DEFAULT NULL,
  `address` varchar(120) DEFAULT NULL,
  `mark` varchar(500) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `state` int(11) DEFAULT '0',
  `addtime` datetime DEFAULT NULL,
  `waiterid` int(11) DEFAULT '0',
  `paitime` datetime DEFAULT NULL,
  `closemoney` float DEFAULT NULL,
  `closetime` datetime DEFAULT NULL,
  `xing` int(11) DEFAULT NULL,
  PRIMARY KEY (`orderformid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_xm_housekeep_power` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` varchar(80) DEFAULT NULL,
  `uid` varchar(80) DEFAULT NULL,
  `power` varchar(200) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_xm_housekeep_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type_id` int(11) NOT NULL,
  `jianjie` varchar(500) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `price` varchar(500) DEFAULT NULL,
  `price_con` varchar(8000) NOT NULL,
  `istop1` int(11) DEFAULT NULL,
  `istop2` int(11) DEFAULT NULL,
  `typeorder` int(11) DEFAULT NULL,
  `addtime` varchar(100) NOT NULL,
  `updatetime` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_xm_housekeep_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `content` varchar(8000) NOT NULL,
  `addtime` varchar(100) NOT NULL,
  `updatetime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_xm_housekeep_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `content` varchar(8000) NOT NULL,
  `addtime` varchar(100) NOT NULL,
  `updatetime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_xm_housekeep_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `sex` int(11) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `qrcode` varchar(200) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL,
  `ticket` varchar(200) DEFAULT NULL,
  `accept` int(11) DEFAULT '0',
  `cutmoney` float DEFAULT '0',
  `getmoney` float DEFAULT '0',
  `addtime` varchar(100) NOT NULL,
  `updatetime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_xm_housekeep_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `top` int(11) DEFAULT '0',
  `addtime` varchar(500) DEFAULT NULL,
  `updatetime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_xm_housekeep_userfrom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `openid` varchar(80) DEFAULT NULL,
  `fromopenid` varchar(80) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");
if(pdo_tableexists('xm_housekeep_adv')) {
	if(!pdo_fieldexists('xm_housekeep_adv',  'id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_adv')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_adv')) {
	if(!pdo_fieldexists('xm_housekeep_adv',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_adv')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_adv')) {
	if(!pdo_fieldexists('xm_housekeep_adv',  'name')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_adv')." ADD `name` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_adv')) {
	if(!pdo_fieldexists('xm_housekeep_adv',  'link')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_adv')." ADD `link` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_adv')) {
	if(!pdo_fieldexists('xm_housekeep_adv',  'pic')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_adv')." ADD `pic` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_adv')) {
	if(!pdo_fieldexists('xm_housekeep_adv',  'top')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_adv')." ADD `top` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_adv')) {
	if(!pdo_fieldexists('xm_housekeep_adv',  'addtime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_adv')." ADD `addtime` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'yyopenid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `yyopenid` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'bili')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `bili` float    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'lead')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `lead` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'sbili')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `sbili` float    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'comment1')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `comment1` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'comment2')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `comment2` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'comment3')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `comment3` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'msg1')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `msg1` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'hello1')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `hello1` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'remark1')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `remark1` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'msg2')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `msg2` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'hello2')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `hello2` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'remark2')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `remark2` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'msg3')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `msg3` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'hello3')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `hello3` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'remark3')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `remark3` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'msg4')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `msg4` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'hello4')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `hello4` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'remark4')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `remark4` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'msg5')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `msg5` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'hello5')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `hello5` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'remark5')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `remark5` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'share_title')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `share_title` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'share_icon')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `share_icon` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'share_content')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `share_content` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'link')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `link` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'addtime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `addtime` datetime    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_base')) {
	if(!pdo_fieldexists('xm_housekeep_base',  'updatetime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_base')." ADD `updatetime` datetime    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_comment')) {
	if(!pdo_fieldexists('xm_housekeep_comment',  'id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_comment')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_comment')) {
	if(!pdo_fieldexists('xm_housekeep_comment',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_comment')." ADD `weid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_comment')) {
	if(!pdo_fieldexists('xm_housekeep_comment',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_comment')." ADD `openid` varchar(80)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_comment')) {
	if(!pdo_fieldexists('xm_housekeep_comment',  'staff_id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_comment')." ADD `staff_id` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_comment')) {
	if(!pdo_fieldexists('xm_housekeep_comment',  'xing')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_comment')." ADD `xing` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_comment')) {
	if(!pdo_fieldexists('xm_housekeep_comment',  'comment')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_comment')." ADD `comment` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_comment')) {
	if(!pdo_fieldexists('xm_housekeep_comment',  'orderid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_comment')." ADD `orderid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_comment')) {
	if(!pdo_fieldexists('xm_housekeep_comment',  'addtime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_comment')." ADD `addtime` datetime    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_cutlog')) {
	if(!pdo_fieldexists('xm_housekeep_cutlog',  'id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_cutlog')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_cutlog')) {
	if(!pdo_fieldexists('xm_housekeep_cutlog',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_cutlog')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_cutlog')) {
	if(!pdo_fieldexists('xm_housekeep_cutlog',  'orderformid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_cutlog')." ADD `orderformid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_cutlog')) {
	if(!pdo_fieldexists('xm_housekeep_cutlog',  'waiterid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_cutlog')." ADD `waiterid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_cutlog')) {
	if(!pdo_fieldexists('xm_housekeep_cutlog',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_cutlog')." ADD `openid` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_cutlog')) {
	if(!pdo_fieldexists('xm_housekeep_cutlog',  'closemoney')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_cutlog')." ADD `closemoney` float    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_cutlog')) {
	if(!pdo_fieldexists('xm_housekeep_cutlog',  'cut')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_cutlog')." ADD `cut` float    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_cutlog')) {
	if(!pdo_fieldexists('xm_housekeep_cutlog',  'staff_id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_cutlog')." ADD `staff_id` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_cutlog')) {
	if(!pdo_fieldexists('xm_housekeep_cutlog',  'staff_openid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_cutlog')." ADD `staff_openid` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_cutlog')) {
	if(!pdo_fieldexists('xm_housekeep_cutlog',  'staff_name')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_cutlog')." ADD `staff_name` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_cutlog')) {
	if(!pdo_fieldexists('xm_housekeep_cutlog',  'staff_mobile')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_cutlog')." ADD `staff_mobile` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_cutlog')) {
	if(!pdo_fieldexists('xm_housekeep_cutlog',  'flag')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_cutlog')." ADD `flag` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_cutlog')) {
	if(!pdo_fieldexists('xm_housekeep_cutlog',  'addtime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_cutlog')." ADD `addtime` datetime    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_givecut')) {
	if(!pdo_fieldexists('xm_housekeep_givecut',  'id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_givecut')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_givecut')) {
	if(!pdo_fieldexists('xm_housekeep_givecut',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_givecut')." ADD `weid` varchar(80)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_givecut')) {
	if(!pdo_fieldexists('xm_housekeep_givecut',  'staff_id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_givecut')." ADD `staff_id` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_givecut')) {
	if(!pdo_fieldexists('xm_housekeep_givecut',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_givecut')." ADD `openid` varchar(80)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_givecut')) {
	if(!pdo_fieldexists('xm_housekeep_givecut',  'staff_name')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_givecut')." ADD `staff_name` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_givecut')) {
	if(!pdo_fieldexists('xm_housekeep_givecut',  'cut')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_givecut')." ADD `cut` float    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_givecut')) {
	if(!pdo_fieldexists('xm_housekeep_givecut',  'addtime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_givecut')." ADD `addtime` datetime    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_orderform')) {
	if(!pdo_fieldexists('xm_housekeep_orderform',  'orderformid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_orderform')." ADD `orderformid` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_orderform')) {
	if(!pdo_fieldexists('xm_housekeep_orderform',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_orderform')." ADD `weid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_orderform')) {
	if(!pdo_fieldexists('xm_housekeep_orderform',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_orderform')." ADD `openid` varchar(80)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_orderform')) {
	if(!pdo_fieldexists('xm_housekeep_orderform',  'typeid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_orderform')." ADD `typeid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_orderform')) {
	if(!pdo_fieldexists('xm_housekeep_orderform',  'ftime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_orderform')." ADD `ftime` datetime    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_orderform')) {
	if(!pdo_fieldexists('xm_housekeep_orderform',  'address')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_orderform')." ADD `address` varchar(120)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_orderform')) {
	if(!pdo_fieldexists('xm_housekeep_orderform',  'mark')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_orderform')." ADD `mark` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_orderform')) {
	if(!pdo_fieldexists('xm_housekeep_orderform',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_orderform')." ADD `mobile` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_orderform')) {
	if(!pdo_fieldexists('xm_housekeep_orderform',  'state')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_orderform')." ADD `state` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_orderform')) {
	if(!pdo_fieldexists('xm_housekeep_orderform',  'addtime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_orderform')." ADD `addtime` datetime    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_orderform')) {
	if(!pdo_fieldexists('xm_housekeep_orderform',  'waiterid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_orderform')." ADD `waiterid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_orderform')) {
	if(!pdo_fieldexists('xm_housekeep_orderform',  'paitime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_orderform')." ADD `paitime` datetime    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_orderform')) {
	if(!pdo_fieldexists('xm_housekeep_orderform',  'closemoney')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_orderform')." ADD `closemoney` float    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_orderform')) {
	if(!pdo_fieldexists('xm_housekeep_orderform',  'closetime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_orderform')." ADD `closetime` datetime    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_orderform')) {
	if(!pdo_fieldexists('xm_housekeep_orderform',  'xing')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_orderform')." ADD `xing` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_power')) {
	if(!pdo_fieldexists('xm_housekeep_power',  'id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_power')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_power')) {
	if(!pdo_fieldexists('xm_housekeep_power',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_power')." ADD `weid` varchar(80)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_power')) {
	if(!pdo_fieldexists('xm_housekeep_power',  'uid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_power')." ADD `uid` varchar(80)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_power')) {
	if(!pdo_fieldexists('xm_housekeep_power',  'power')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_power')." ADD `power` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_power')) {
	if(!pdo_fieldexists('xm_housekeep_power',  'addtime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_power')." ADD `addtime` datetime    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_project')) {
	if(!pdo_fieldexists('xm_housekeep_project',  'id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_project')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_project')) {
	if(!pdo_fieldexists('xm_housekeep_project',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_project')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_project')) {
	if(!pdo_fieldexists('xm_housekeep_project',  'name')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_project')." ADD `name` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_project')) {
	if(!pdo_fieldexists('xm_housekeep_project',  'type_id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_project')." ADD `type_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_project')) {
	if(!pdo_fieldexists('xm_housekeep_project',  'jianjie')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_project')." ADD `jianjie` varchar(500) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_project')) {
	if(!pdo_fieldexists('xm_housekeep_project',  'icon')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_project')." ADD `icon` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_project')) {
	if(!pdo_fieldexists('xm_housekeep_project',  'price')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_project')." ADD `price` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_project')) {
	if(!pdo_fieldexists('xm_housekeep_project',  'price_con')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_project')." ADD `price_con` varchar(8000) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_project')) {
	if(!pdo_fieldexists('xm_housekeep_project',  'istop1')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_project')." ADD `istop1` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_project')) {
	if(!pdo_fieldexists('xm_housekeep_project',  'istop2')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_project')." ADD `istop2` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_project')) {
	if(!pdo_fieldexists('xm_housekeep_project',  'typeorder')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_project')." ADD `typeorder` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_project')) {
	if(!pdo_fieldexists('xm_housekeep_project',  'addtime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_project')." ADD `addtime` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_project')) {
	if(!pdo_fieldexists('xm_housekeep_project',  'updatetime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_project')." ADD `updatetime` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_question')) {
	if(!pdo_fieldexists('xm_housekeep_question',  'id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_question')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_question')) {
	if(!pdo_fieldexists('xm_housekeep_question',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_question')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_question')) {
	if(!pdo_fieldexists('xm_housekeep_question',  'name')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_question')." ADD `name` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_question')) {
	if(!pdo_fieldexists('xm_housekeep_question',  'content')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_question')." ADD `content` varchar(8000) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_question')) {
	if(!pdo_fieldexists('xm_housekeep_question',  'addtime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_question')." ADD `addtime` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_question')) {
	if(!pdo_fieldexists('xm_housekeep_question',  'updatetime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_question')." ADD `updatetime` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_service')) {
	if(!pdo_fieldexists('xm_housekeep_service',  'id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_service')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_service')) {
	if(!pdo_fieldexists('xm_housekeep_service',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_service')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_service')) {
	if(!pdo_fieldexists('xm_housekeep_service',  'name')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_service')." ADD `name` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_service')) {
	if(!pdo_fieldexists('xm_housekeep_service',  'content')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_service')." ADD `content` varchar(8000) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_service')) {
	if(!pdo_fieldexists('xm_housekeep_service',  'addtime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_service')." ADD `addtime` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_service')) {
	if(!pdo_fieldexists('xm_housekeep_service',  'updatetime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_service')." ADD `updatetime` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_staff')) {
	if(!pdo_fieldexists('xm_housekeep_staff',  'id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_staff')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_staff')) {
	if(!pdo_fieldexists('xm_housekeep_staff',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_staff')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_staff')) {
	if(!pdo_fieldexists('xm_housekeep_staff',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_staff')." ADD `openid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_staff')) {
	if(!pdo_fieldexists('xm_housekeep_staff',  'name')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_staff')." ADD `name` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_staff')) {
	if(!pdo_fieldexists('xm_housekeep_staff',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_staff')." ADD `mobile` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_staff')) {
	if(!pdo_fieldexists('xm_housekeep_staff',  'sex')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_staff')." ADD `sex` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_staff')) {
	if(!pdo_fieldexists('xm_housekeep_staff',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_staff')." ADD `avatar` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_staff')) {
	if(!pdo_fieldexists('xm_housekeep_staff',  'qrcode')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_staff')." ADD `qrcode` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_staff')) {
	if(!pdo_fieldexists('xm_housekeep_staff',  'flag')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_staff')." ADD `flag` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_staff')) {
	if(!pdo_fieldexists('xm_housekeep_staff',  'ticket')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_staff')." ADD `ticket` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_staff')) {
	if(!pdo_fieldexists('xm_housekeep_staff',  'accept')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_staff')." ADD `accept` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_staff')) {
	if(!pdo_fieldexists('xm_housekeep_staff',  'cutmoney')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_staff')." ADD `cutmoney` float   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_staff')) {
	if(!pdo_fieldexists('xm_housekeep_staff',  'getmoney')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_staff')." ADD `getmoney` float   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_staff')) {
	if(!pdo_fieldexists('xm_housekeep_staff',  'addtime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_staff')." ADD `addtime` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_staff')) {
	if(!pdo_fieldexists('xm_housekeep_staff',  'updatetime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_staff')." ADD `updatetime` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_type')) {
	if(!pdo_fieldexists('xm_housekeep_type',  'id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_type')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_type')) {
	if(!pdo_fieldexists('xm_housekeep_type',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_type')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_type')) {
	if(!pdo_fieldexists('xm_housekeep_type',  'name')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_type')." ADD `name` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_type')) {
	if(!pdo_fieldexists('xm_housekeep_type',  'icon')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_type')." ADD `icon` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_type')) {
	if(!pdo_fieldexists('xm_housekeep_type',  'top')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_type')." ADD `top` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_type')) {
	if(!pdo_fieldexists('xm_housekeep_type',  'addtime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_type')." ADD `addtime` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_type')) {
	if(!pdo_fieldexists('xm_housekeep_type',  'updatetime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_type')." ADD `updatetime` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_userfrom')) {
	if(!pdo_fieldexists('xm_housekeep_userfrom',  'id')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_userfrom')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_userfrom')) {
	if(!pdo_fieldexists('xm_housekeep_userfrom',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_userfrom')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_userfrom')) {
	if(!pdo_fieldexists('xm_housekeep_userfrom',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_userfrom')." ADD `openid` varchar(80)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_userfrom')) {
	if(!pdo_fieldexists('xm_housekeep_userfrom',  'fromopenid')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_userfrom')." ADD `fromopenid` varchar(80)    COMMENT '';");
	}	
}
if(pdo_tableexists('xm_housekeep_userfrom')) {
	if(!pdo_fieldexists('xm_housekeep_userfrom',  'addtime')) {
		pdo_query("ALTER TABLE ".tablename('xm_housekeep_userfrom')." ADD `addtime` datetime    COMMENT '';");
	}	
}
