<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_acmanager` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `code` varchar(20) NOT NULL,
  `listorder` int(5) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL,
  `content` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `loupanid` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `link` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_assistant` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `lid` int(10) NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL,
  `realname` varchar(50) NOT NULL,
  `mobile` varchar(11) NOT NULL COMMENT '手机号码',
  `code` varchar(20) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `flag` tinyint(1) DEFAULT '0' COMMENT '0为销售员，1为经理',
  `mark` tinyint(1) DEFAULT '0' COMMENT '记录是否分配已',
  `content` text,
  `createtime` int(10) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_commission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `mid` int(10) unsigned NOT NULL COMMENT '经纪人ID',
  `lid` int(10) unsigned NOT NULL COMMENT '楼盘ID',
  `cid` int(10) unsigned DEFAULT NULL COMMENT '客户ID',
  `commission` decimal(10,2) NOT NULL DEFAULT '0.00',
  `content` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL,
  `flag` tinyint(1) DEFAULT '0',
  `ischeck` tinyint(1) DEFAULT '0',
  `tid` int(10) unsigned DEFAULT '0' COMMENT '团队成员ID',
  `opid` int(10) unsigned DEFAULT '0' COMMENT '操作员ID经理或销售或管理员',
  `opname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_complain` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `mid` int(10) NOT NULL,
  `realname` varchar(20) DEFAULT '',
  `mobile` varchar(11) DEFAULT '',
  `complain` text,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_counselor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `code` varchar(20) NOT NULL,
  `lid` int(10) unsigned NOT NULL DEFAULT '0',
  `listorder` int(5) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL,
  `content` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_credit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `mid` int(10) unsigned NOT NULL COMMENT '经纪人ID',
  `lid` int(10) unsigned NOT NULL COMMENT '楼盘ID',
  `cid` int(10) unsigned DEFAULT NULL COMMENT '客户ID',
  `credit` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL,
  `tid` int(10) unsigned DEFAULT '0' COMMENT '团队成员ID',
  `opid` int(10) unsigned DEFAULT '0' COMMENT '操作员ID经理或销售或管理员',
  `content` text,
  `opname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_creditlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `creditid` int(10) unsigned NOT NULL COMMENT '积分表ID',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `content` text,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_cusmat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `parentid` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `listorder` int(5) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL,
  `content` text,
  `flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为单选，1为多选，2为输入',
  `isopen` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_cusmatlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `cid` int(10) NOT NULL,
  `opid` varchar(50) NOT NULL COMMENT '操作员ID',
  `age` int(5) NOT NULL DEFAULT '0',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1男，2女',
  `area_location_p` varchar(20) DEFAULT '',
  `area_location_c` varchar(20) DEFAULT '',
  `area_location_a` varchar(20) DEFAULT '',
  `type` varchar(20) DEFAULT '' COMMENT '意向户型',
  `wantprice` decimal(10,2) DEFAULT '0.00' COMMENT '心理单价',
  `allprice` decimal(10,2) DEFAULT '0.00' COMMENT '总价预算',
  `cpf` int(5) NOT NULL DEFAULT '0' COMMENT '公积金情况',
  `live_location_p` varchar(20) DEFAULT '',
  `live_location_c` varchar(20) DEFAULT '',
  `live_location_a` varchar(20) DEFAULT '',
  `work_location_p` varchar(20) DEFAULT '',
  `work_location_c` varchar(20) DEFAULT '',
  `work_location_a` varchar(20) DEFAULT '',
  `buyreason` varchar(50) DEFAULT '' COMMENT '购房原因',
  `livecondition` int(5) DEFAULT '0' COMMENT '现居住情况',
  `homeformation` int(5) DEFAULT '0' COMMENT '家庭结构',
  `worknature` int(5) DEFAULT '0' COMMENT '工作单位性质',
  `worklevel` varchar(50) NOT NULL DEFAULT '' COMMENT '职务级别',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_cuspool` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `cusid` int(10) unsigned NOT NULL COMMENT '客户ID',
  `mobile` varchar(11) NOT NULL COMMENT '手机号码',
  `realname` varchar(50) NOT NULL,
  `loupan` int(10) unsigned NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL,
  `cuspri` int(5) NOT NULL DEFAULT '0' COMMENT '客户池优先级',
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_customer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL COMMENT '推荐人的openid',
  `identity` int(10) unsigned NOT NULL,
  `mobile` varchar(11) NOT NULL COMMENT '手机号码',
  `realname` varchar(50) NOT NULL,
  `loupan` int(10) unsigned NOT NULL,
  `successmoney` int(10) unsigned NOT NULL COMMENT '成交金额',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL,
  `createtime1` varchar(20) NOT NULL COMMENT '日期格式',
  `updatetime` int(10) DEFAULT NULL,
  `updatetime1` varchar(20) NOT NULL COMMENT '日期格式',
  `flag` tinyint(1) DEFAULT '0' COMMENT '0为推荐，1为预约',
  `isvalid` tinyint(1) DEFAULT '1' COMMENT '是否有效',
  `cid` int(10) unsigned DEFAULT '0' COMMENT '该客户从属于某销售员',
  `acid` int(10) unsigned DEFAULT '0' COMMENT '该客户谁分配的',
  `cuspri` int(5) NOT NULL DEFAULT '0' COMMENT '客户沉淀次数(客户池优先级)',
  `allottime` int(10) DEFAULT NULL COMMENT '分配时间',
  `indatetime` int(10) NOT NULL COMMENT '状态更新时间，记录有效期',
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_customerstatus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `displayorder` int(10) NOT NULL,
  `uniacid` int(10) NOT NULL,
  `title` varchar(20) DEFAULT '' COMMENT '会员名称',
  `indate` int(10) NOT NULL,
  `jjrcredit` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_experience` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `expname` varchar(20) NOT NULL COMMENT '经验名称',
  `mid` int(10) unsigned NOT NULL COMMENT '经纪人ID',
  `lid` int(10) unsigned NOT NULL COMMENT '楼盘ID',
  `cid` int(10) unsigned DEFAULT NULL COMMENT '客户ID',
  `exp` int(10) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL,
  `opid` int(10) unsigned DEFAULT '0' COMMENT '操作员ID经理或销售或管理员',
  `opname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_explevel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(20) NOT NULL COMMENT '分段名称',
  `min` int(10) unsigned NOT NULL,
  `max` int(10) unsigned NOT NULL,
  `levelicon` varchar(255) DEFAULT '' COMMENT '等级图标',
  `displayorder` int(10) unsigned DEFAULT '0' COMMENT '等级分段排序',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_idcommission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `lid` int(10) NOT NULL,
  `identityid` int(10) NOT NULL,
  `commission` varchar(20) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_identity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `identity_name` varchar(20) NOT NULL,
  `listorder` int(5) NOT NULL DEFAULT '0',
  `cuspri` int(5) NOT NULL DEFAULT '0' COMMENT '客户池优先级',
  `createtime` int(10) NOT NULL,
  `iscode` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否需要邀请码',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `lpid` int(10) unsigned NOT NULL,
  `photoid` int(10) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `item` varchar(1000) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `x` int(3) NOT NULL DEFAULT '0',
  `y` int(3) NOT NULL DEFAULT '0',
  `animation` varchar(20) NOT NULL DEFAULT '',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_photoid` (`photoid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_jjrcode` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `code` varchar(20) NOT NULL,
  `listorder` int(5) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL,
  `content` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `share_openid` varchar(50) DEFAULT NULL,
  `loupan` int(10) unsigned NOT NULL,
  `browser` varchar(200) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `createtime` int(10) NOT NULL COMMENT '时间戳格式',
  `createtime1` varchar(20) NOT NULL COMMENT '日期格式',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_logloupan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `lid` int(10) unsigned NOT NULL,
  `createtime` int(10) NOT NULL COMMENT '时间戳格式',
  `createtime1` varchar(20) NOT NULL COMMENT '日期格式',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_loupan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `icon` varchar(100) NOT NULL DEFAULT '',
  `share` varchar(100) NOT NULL DEFAULT '',
  `open` varchar(100) NOT NULL DEFAULT '',
  `ostyle` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `music` varchar(100) NOT NULL DEFAULT '',
  `mauto` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `mloop` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `content` varchar(1000) NOT NULL DEFAULT '',
  `displayorder` int(10) unsigned NOT NULL DEFAULT '0',
  `isloop` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isview` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `location_a` varchar(20) DEFAULT '',
  `location_c` varchar(20) DEFAULT '',
  `location_p` varchar(20) DEFAULT '',
  `address` varchar(255) DEFAULT '',
  `lng` varchar(12) DEFAULT '116.403694',
  `lat` varchar(12) DEFAULT '39.916042',
  `addr` varchar(255) DEFAULT NULL,
  `commission` varchar(20) DEFAULT NULL,
  `tjcredit` int(10) DEFAULT NULL COMMENT '推荐积分',
  `stacredit` int(10) DEFAULT NULL COMMENT '状态积分',
  `price` int(10) NOT NULL DEFAULT '0',
  `recnum` int(10) NOT NULL DEFAULT '0' COMMENT '推荐数',
  `sucnum` int(10) NOT NULL DEFAULT '0' COMMENT '成交数',
  `tel` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL COMMENT '投诉电话',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `iscity` tinyint(1) NOT NULL DEFAULT '0',
  `isautoallot` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `typekind` tinyint(2) NOT NULL DEFAULT '0',
  `jw_addr` varchar(255) NOT NULL DEFAULT '',
  `id_view` varchar(50) NOT NULL DEFAULT '' COMMENT '身份可见',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `tjmid` int(10) NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL,
  `media_id` varchar(100) NOT NULL,
  `media_time` int(10) unsigned NOT NULL,
  `headurl` varchar(250) NOT NULL,
  `identity_cardurl` varchar(250) NOT NULL,
  `identity_headurl` varchar(250) NOT NULL,
  `realname` varchar(50) NOT NULL,
  `mobile` varchar(11) NOT NULL COMMENT '手机号码',
  `bankcard` varchar(20) DEFAULT NULL,
  `banktype` varchar(20) DEFAULT NULL,
  `identity` int(10) unsigned NOT NULL,
  `code` varchar(20) NOT NULL DEFAULT '',
  `cardurltime` int(10) NOT NULL,
  `headurltime` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `createtime1` varchar(20) NOT NULL COMMENT '日期格式',
  `status` tinyint(1) DEFAULT '0',
  `commission` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ischange` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_photo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `lpid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `attachment` varchar(100) NOT NULL DEFAULT '',
  `ispreview` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `displayorder` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_lpid` (`lpid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_poster` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `bg` varchar(255) DEFAULT '',
  `data` text,
  `keyword` varchar(255) DEFAULT '',
  `waittext` varchar(50) DEFAULT '',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_promanager` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `code` varchar(20) NOT NULL,
  `listorder` int(5) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL,
  `content` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `loupanid` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_protect` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cname` varchar(50) NOT NULL DEFAULT '',
  `mobile` varchar(50) NOT NULL,
  `createtime` int(10) NOT NULL DEFAULT '0',
  `uniacid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `title` varchar(50) NOT NULL,
  `content` text,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `isopen` tinyint(1) unsigned DEFAULT '1',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '服务电话',
  `rule` text,
  `teams` text,
  `createtime` int(10) NOT NULL,
  `cpcredit` int(10) NOT NULL COMMENT '客户池积分',
  `teamcredit` int(10) NOT NULL COMMENT '下线积分',
  `gzurl` varchar(255) NOT NULL,
  `share_title` varchar(50) NOT NULL,
  `share_thumb` varchar(255) NOT NULL,
  `share_content` varchar(100) NOT NULL,
  `isopen` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isselect_city` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `teamfy` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_templatenews` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `CustomerFP` varchar(100) DEFAULT NULL,
  `CreditChange` varchar(100) DEFAULT NULL,
  `Commission` varchar(100) DEFAULT NULL,
  `StatusChange` varchar(100) DEFAULT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");
if(pdo_tableexists('hc_deluxejjr_acmanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_acmanager',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_acmanager')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_acmanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_acmanager',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_acmanager')." ADD `uniacid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_acmanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_acmanager',  'code')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_acmanager')." ADD `code` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_acmanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_acmanager',  'listorder')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_acmanager')." ADD `listorder` int(5) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_acmanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_acmanager',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_acmanager')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_acmanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_acmanager',  'content')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_acmanager')." ADD `content` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_acmanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_acmanager',  'status')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_acmanager')." ADD `status` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_acmanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_acmanager',  'loupanid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_acmanager')." ADD `loupanid` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_adv')) {
	if(!pdo_fieldexists('hc_deluxejjr_adv',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_adv')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_adv')) {
	if(!pdo_fieldexists('hc_deluxejjr_adv',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_adv')." ADD `uniacid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_adv')) {
	if(!pdo_fieldexists('hc_deluxejjr_adv',  'link')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_adv')." ADD `link` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_adv')) {
	if(!pdo_fieldexists('hc_deluxejjr_adv',  'thumb')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_adv')." ADD `thumb` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_adv')) {
	if(!pdo_fieldexists('hc_deluxejjr_adv',  'displayorder')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_adv')." ADD `displayorder` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_adv')) {
	if(!pdo_fieldexists('hc_deluxejjr_adv',  'enabled')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_adv')." ADD `enabled` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_assistant')) {
	if(!pdo_fieldexists('hc_deluxejjr_assistant',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_assistant')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_assistant')) {
	if(!pdo_fieldexists('hc_deluxejjr_assistant',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_assistant')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_assistant')) {
	if(!pdo_fieldexists('hc_deluxejjr_assistant',  'lid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_assistant')." ADD `lid` int(10) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_assistant')) {
	if(!pdo_fieldexists('hc_deluxejjr_assistant',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_assistant')." ADD `openid` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_assistant')) {
	if(!pdo_fieldexists('hc_deluxejjr_assistant',  'realname')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_assistant')." ADD `realname` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_assistant')) {
	if(!pdo_fieldexists('hc_deluxejjr_assistant',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_assistant')." ADD `mobile` varchar(11) NOT NULL   COMMENT '手机号码';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_assistant')) {
	if(!pdo_fieldexists('hc_deluxejjr_assistant',  'code')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_assistant')." ADD `code` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_assistant')) {
	if(!pdo_fieldexists('hc_deluxejjr_assistant',  'status')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_assistant')." ADD `status` tinyint(1)   DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_assistant')) {
	if(!pdo_fieldexists('hc_deluxejjr_assistant',  'flag')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_assistant')." ADD `flag` tinyint(1)   DEFAULT 0 COMMENT '0为销售员，1为经理';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_assistant')) {
	if(!pdo_fieldexists('hc_deluxejjr_assistant',  'mark')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_assistant')." ADD `mark` tinyint(1)   DEFAULT 0 COMMENT '记录是否分配已';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_assistant')) {
	if(!pdo_fieldexists('hc_deluxejjr_assistant',  'content')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_assistant')." ADD `content` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_assistant')) {
	if(!pdo_fieldexists('hc_deluxejjr_assistant',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_assistant')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_assistant')) {
	if(!pdo_fieldexists('hc_deluxejjr_assistant',  'pwd')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_assistant')." ADD `pwd` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_commission')) {
	if(!pdo_fieldexists('hc_deluxejjr_commission',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_commission')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_commission')) {
	if(!pdo_fieldexists('hc_deluxejjr_commission',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_commission')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_commission')) {
	if(!pdo_fieldexists('hc_deluxejjr_commission',  'mid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_commission')." ADD `mid` int(10) unsigned NOT NULL   COMMENT '经纪人ID';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_commission')) {
	if(!pdo_fieldexists('hc_deluxejjr_commission',  'lid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_commission')." ADD `lid` int(10) unsigned NOT NULL   COMMENT '楼盘ID';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_commission')) {
	if(!pdo_fieldexists('hc_deluxejjr_commission',  'cid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_commission')." ADD `cid` int(10) unsigned    COMMENT '客户ID';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_commission')) {
	if(!pdo_fieldexists('hc_deluxejjr_commission',  'commission')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_commission')." ADD `commission` decimal(10,2) NOT NULL  DEFAULT 0.00 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_commission')) {
	if(!pdo_fieldexists('hc_deluxejjr_commission',  'content')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_commission')." ADD `content` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_commission')) {
	if(!pdo_fieldexists('hc_deluxejjr_commission',  'status')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_commission')." ADD `status` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_commission')) {
	if(!pdo_fieldexists('hc_deluxejjr_commission',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_commission')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_commission')) {
	if(!pdo_fieldexists('hc_deluxejjr_commission',  'flag')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_commission')." ADD `flag` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_commission')) {
	if(!pdo_fieldexists('hc_deluxejjr_commission',  'ischeck')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_commission')." ADD `ischeck` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_commission')) {
	if(!pdo_fieldexists('hc_deluxejjr_commission',  'tid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_commission')." ADD `tid` int(10) unsigned   DEFAULT 0 COMMENT '团队成员ID';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_commission')) {
	if(!pdo_fieldexists('hc_deluxejjr_commission',  'opid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_commission')." ADD `opid` int(10) unsigned   DEFAULT 0 COMMENT '操作员ID经理或销售或管理员';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_commission')) {
	if(!pdo_fieldexists('hc_deluxejjr_commission',  'opname')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_commission')." ADD `opname` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_complain')) {
	if(!pdo_fieldexists('hc_deluxejjr_complain',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_complain')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_complain')) {
	if(!pdo_fieldexists('hc_deluxejjr_complain',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_complain')." ADD `uniacid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_complain')) {
	if(!pdo_fieldexists('hc_deluxejjr_complain',  'mid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_complain')." ADD `mid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_complain')) {
	if(!pdo_fieldexists('hc_deluxejjr_complain',  'realname')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_complain')." ADD `realname` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_complain')) {
	if(!pdo_fieldexists('hc_deluxejjr_complain',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_complain')." ADD `mobile` varchar(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_complain')) {
	if(!pdo_fieldexists('hc_deluxejjr_complain',  'complain')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_complain')." ADD `complain` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_complain')) {
	if(!pdo_fieldexists('hc_deluxejjr_complain',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_complain')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_counselor')) {
	if(!pdo_fieldexists('hc_deluxejjr_counselor',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_counselor')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_counselor')) {
	if(!pdo_fieldexists('hc_deluxejjr_counselor',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_counselor')." ADD `uniacid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_counselor')) {
	if(!pdo_fieldexists('hc_deluxejjr_counselor',  'code')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_counselor')." ADD `code` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_counselor')) {
	if(!pdo_fieldexists('hc_deluxejjr_counselor',  'lid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_counselor')." ADD `lid` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_counselor')) {
	if(!pdo_fieldexists('hc_deluxejjr_counselor',  'listorder')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_counselor')." ADD `listorder` int(5) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_counselor')) {
	if(!pdo_fieldexists('hc_deluxejjr_counselor',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_counselor')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_counselor')) {
	if(!pdo_fieldexists('hc_deluxejjr_counselor',  'content')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_counselor')." ADD `content` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_counselor')) {
	if(!pdo_fieldexists('hc_deluxejjr_counselor',  'status')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_counselor')." ADD `status` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_credit')) {
	if(!pdo_fieldexists('hc_deluxejjr_credit',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_credit')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_credit')) {
	if(!pdo_fieldexists('hc_deluxejjr_credit',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_credit')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_credit')) {
	if(!pdo_fieldexists('hc_deluxejjr_credit',  'mid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_credit')." ADD `mid` int(10) unsigned NOT NULL   COMMENT '经纪人ID';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_credit')) {
	if(!pdo_fieldexists('hc_deluxejjr_credit',  'lid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_credit')." ADD `lid` int(10) unsigned NOT NULL   COMMENT '楼盘ID';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_credit')) {
	if(!pdo_fieldexists('hc_deluxejjr_credit',  'cid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_credit')." ADD `cid` int(10) unsigned    COMMENT '客户ID';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_credit')) {
	if(!pdo_fieldexists('hc_deluxejjr_credit',  'credit')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_credit')." ADD `credit` int(10) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_credit')) {
	if(!pdo_fieldexists('hc_deluxejjr_credit',  'status')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_credit')." ADD `status` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_credit')) {
	if(!pdo_fieldexists('hc_deluxejjr_credit',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_credit')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_credit')) {
	if(!pdo_fieldexists('hc_deluxejjr_credit',  'tid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_credit')." ADD `tid` int(10) unsigned   DEFAULT 0 COMMENT '团队成员ID';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_credit')) {
	if(!pdo_fieldexists('hc_deluxejjr_credit',  'opid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_credit')." ADD `opid` int(10) unsigned   DEFAULT 0 COMMENT '操作员ID经理或销售或管理员';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_credit')) {
	if(!pdo_fieldexists('hc_deluxejjr_credit',  'content')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_credit')." ADD `content` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_credit')) {
	if(!pdo_fieldexists('hc_deluxejjr_credit',  'opname')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_credit')." ADD `opname` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_creditlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_creditlog',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_creditlog')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_creditlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_creditlog',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_creditlog')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_creditlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_creditlog',  'creditid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_creditlog')." ADD `creditid` int(10) unsigned NOT NULL   COMMENT '积分表ID';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_creditlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_creditlog',  'status')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_creditlog')." ADD `status` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_creditlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_creditlog',  'content')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_creditlog')." ADD `content` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_creditlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_creditlog',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_creditlog')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmat')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmat',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmat')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmat')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmat',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmat')." ADD `uniacid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmat')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmat',  'parentid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmat')." ADD `parentid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmat')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmat',  'title')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmat')." ADD `title` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmat')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmat',  'listorder')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmat')." ADD `listorder` int(5) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmat')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmat',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmat')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmat')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmat',  'content')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmat')." ADD `content` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmat')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmat',  'flag')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmat')." ADD `flag` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '0为单选，1为多选，2为输入';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmat')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmat',  'isopen')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmat')." ADD `isopen` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `uniacid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'cid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `cid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'opid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `opid` varchar(50) NOT NULL   COMMENT '操作员ID';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'age')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `age` int(5) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'sex')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `sex` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '1男，2女';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'area_location_p')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `area_location_p` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'area_location_c')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `area_location_c` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'area_location_a')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `area_location_a` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'type')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `type` varchar(20)    COMMENT '意向户型';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'wantprice')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `wantprice` decimal(10,2)   DEFAULT 0.00 COMMENT '心理单价';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'allprice')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `allprice` decimal(10,2)   DEFAULT 0.00 COMMENT '总价预算';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'cpf')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `cpf` int(5) NOT NULL  DEFAULT 0 COMMENT '公积金情况';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'live_location_p')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `live_location_p` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'live_location_c')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `live_location_c` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'live_location_a')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `live_location_a` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'work_location_p')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `work_location_p` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'work_location_c')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `work_location_c` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'work_location_a')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `work_location_a` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'buyreason')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `buyreason` varchar(50)    COMMENT '购房原因';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'livecondition')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `livecondition` int(5)   DEFAULT 0 COMMENT '现居住情况';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'homeformation')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `homeformation` int(5)   DEFAULT 0 COMMENT '家庭结构';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'worknature')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `worknature` int(5)   DEFAULT 0 COMMENT '工作单位性质';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'worklevel')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `worklevel` varchar(50) NOT NULL   COMMENT '职务级别';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cusmatlog')) {
	if(!pdo_fieldexists('hc_deluxejjr_cusmatlog',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cusmatlog')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cuspool')) {
	if(!pdo_fieldexists('hc_deluxejjr_cuspool',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cuspool')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cuspool')) {
	if(!pdo_fieldexists('hc_deluxejjr_cuspool',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cuspool')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cuspool')) {
	if(!pdo_fieldexists('hc_deluxejjr_cuspool',  'cusid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cuspool')." ADD `cusid` int(10) unsigned NOT NULL   COMMENT '客户ID';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cuspool')) {
	if(!pdo_fieldexists('hc_deluxejjr_cuspool',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cuspool')." ADD `mobile` varchar(11) NOT NULL   COMMENT '手机号码';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cuspool')) {
	if(!pdo_fieldexists('hc_deluxejjr_cuspool',  'realname')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cuspool')." ADD `realname` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cuspool')) {
	if(!pdo_fieldexists('hc_deluxejjr_cuspool',  'loupan')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cuspool')." ADD `loupan` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cuspool')) {
	if(!pdo_fieldexists('hc_deluxejjr_cuspool',  'status')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cuspool')." ADD `status` tinyint(3) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cuspool')) {
	if(!pdo_fieldexists('hc_deluxejjr_cuspool',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cuspool')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cuspool')) {
	if(!pdo_fieldexists('hc_deluxejjr_cuspool',  'cuspri')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cuspool')." ADD `cuspri` int(5) NOT NULL  DEFAULT 0 COMMENT '客户池优先级';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_cuspool')) {
	if(!pdo_fieldexists('hc_deluxejjr_cuspool',  'content')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_cuspool')." ADD `content` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `openid` varchar(50) NOT NULL   COMMENT '推荐人的openid';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'identity')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `identity` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `mobile` varchar(11) NOT NULL   COMMENT '手机号码';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'realname')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `realname` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'loupan')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `loupan` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'successmoney')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `successmoney` int(10) unsigned NOT NULL   COMMENT '成交金额';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'status')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `status` tinyint(3) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'createtime1')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `createtime1` varchar(20) NOT NULL   COMMENT '日期格式';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'updatetime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `updatetime` int(10)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'updatetime1')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `updatetime1` varchar(20) NOT NULL   COMMENT '日期格式';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'flag')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `flag` tinyint(1)   DEFAULT 0 COMMENT '0为推荐，1为预约';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'isvalid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `isvalid` tinyint(1)   DEFAULT 1 COMMENT '是否有效';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'cid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `cid` int(10) unsigned   DEFAULT 0 COMMENT '该客户从属于某销售员';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'acid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `acid` int(10) unsigned   DEFAULT 0 COMMENT '该客户谁分配的';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'cuspri')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `cuspri` int(5) NOT NULL  DEFAULT 0 COMMENT '客户沉淀次数(客户池优先级)';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'allottime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `allottime` int(10)    COMMENT '分配时间';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'indatetime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `indatetime` int(10) NOT NULL   COMMENT '状态更新时间，记录有效期';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customer')) {
	if(!pdo_fieldexists('hc_deluxejjr_customer',  'content')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customer')." ADD `content` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customerstatus')) {
	if(!pdo_fieldexists('hc_deluxejjr_customerstatus',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customerstatus')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customerstatus')) {
	if(!pdo_fieldexists('hc_deluxejjr_customerstatus',  'displayorder')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customerstatus')." ADD `displayorder` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customerstatus')) {
	if(!pdo_fieldexists('hc_deluxejjr_customerstatus',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customerstatus')." ADD `uniacid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customerstatus')) {
	if(!pdo_fieldexists('hc_deluxejjr_customerstatus',  'title')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customerstatus')." ADD `title` varchar(20)    COMMENT '会员名称';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customerstatus')) {
	if(!pdo_fieldexists('hc_deluxejjr_customerstatus',  'indate')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customerstatus')." ADD `indate` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customerstatus')) {
	if(!pdo_fieldexists('hc_deluxejjr_customerstatus',  'jjrcredit')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customerstatus')." ADD `jjrcredit` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_customerstatus')) {
	if(!pdo_fieldexists('hc_deluxejjr_customerstatus',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_customerstatus')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_experience')) {
	if(!pdo_fieldexists('hc_deluxejjr_experience',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_experience')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_experience')) {
	if(!pdo_fieldexists('hc_deluxejjr_experience',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_experience')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_experience')) {
	if(!pdo_fieldexists('hc_deluxejjr_experience',  'expname')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_experience')." ADD `expname` varchar(20) NOT NULL   COMMENT '经验名称';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_experience')) {
	if(!pdo_fieldexists('hc_deluxejjr_experience',  'mid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_experience')." ADD `mid` int(10) unsigned NOT NULL   COMMENT '经纪人ID';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_experience')) {
	if(!pdo_fieldexists('hc_deluxejjr_experience',  'lid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_experience')." ADD `lid` int(10) unsigned NOT NULL   COMMENT '楼盘ID';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_experience')) {
	if(!pdo_fieldexists('hc_deluxejjr_experience',  'cid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_experience')." ADD `cid` int(10) unsigned    COMMENT '客户ID';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_experience')) {
	if(!pdo_fieldexists('hc_deluxejjr_experience',  'exp')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_experience')." ADD `exp` int(10) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_experience')) {
	if(!pdo_fieldexists('hc_deluxejjr_experience',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_experience')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_experience')) {
	if(!pdo_fieldexists('hc_deluxejjr_experience',  'opid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_experience')." ADD `opid` int(10) unsigned   DEFAULT 0 COMMENT '操作员ID经理或销售或管理员';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_experience')) {
	if(!pdo_fieldexists('hc_deluxejjr_experience',  'opname')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_experience')." ADD `opname` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_explevel')) {
	if(!pdo_fieldexists('hc_deluxejjr_explevel',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_explevel')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_explevel')) {
	if(!pdo_fieldexists('hc_deluxejjr_explevel',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_explevel')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_explevel')) {
	if(!pdo_fieldexists('hc_deluxejjr_explevel',  'title')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_explevel')." ADD `title` varchar(20) NOT NULL   COMMENT '分段名称';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_explevel')) {
	if(!pdo_fieldexists('hc_deluxejjr_explevel',  'min')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_explevel')." ADD `min` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_explevel')) {
	if(!pdo_fieldexists('hc_deluxejjr_explevel',  'max')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_explevel')." ADD `max` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_explevel')) {
	if(!pdo_fieldexists('hc_deluxejjr_explevel',  'levelicon')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_explevel')." ADD `levelicon` varchar(255)    COMMENT '等级图标';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_explevel')) {
	if(!pdo_fieldexists('hc_deluxejjr_explevel',  'displayorder')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_explevel')." ADD `displayorder` int(10) unsigned   DEFAULT 0 COMMENT '等级分段排序';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_explevel')) {
	if(!pdo_fieldexists('hc_deluxejjr_explevel',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_explevel')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_idcommission')) {
	if(!pdo_fieldexists('hc_deluxejjr_idcommission',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_idcommission')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_idcommission')) {
	if(!pdo_fieldexists('hc_deluxejjr_idcommission',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_idcommission')." ADD `uniacid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_idcommission')) {
	if(!pdo_fieldexists('hc_deluxejjr_idcommission',  'lid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_idcommission')." ADD `lid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_idcommission')) {
	if(!pdo_fieldexists('hc_deluxejjr_idcommission',  'identityid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_idcommission')." ADD `identityid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_idcommission')) {
	if(!pdo_fieldexists('hc_deluxejjr_idcommission',  'commission')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_idcommission')." ADD `commission` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_idcommission')) {
	if(!pdo_fieldexists('hc_deluxejjr_idcommission',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_idcommission')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_identity')) {
	if(!pdo_fieldexists('hc_deluxejjr_identity',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_identity')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_identity')) {
	if(!pdo_fieldexists('hc_deluxejjr_identity',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_identity')." ADD `uniacid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_identity')) {
	if(!pdo_fieldexists('hc_deluxejjr_identity',  'identity_name')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_identity')." ADD `identity_name` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_identity')) {
	if(!pdo_fieldexists('hc_deluxejjr_identity',  'listorder')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_identity')." ADD `listorder` int(5) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_identity')) {
	if(!pdo_fieldexists('hc_deluxejjr_identity',  'cuspri')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_identity')." ADD `cuspri` int(5) NOT NULL  DEFAULT 0 COMMENT '客户池优先级';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_identity')) {
	if(!pdo_fieldexists('hc_deluxejjr_identity',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_identity')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_identity')) {
	if(!pdo_fieldexists('hc_deluxejjr_identity',  'iscode')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_identity')." ADD `iscode` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '是否需要邀请码';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_identity')) {
	if(!pdo_fieldexists('hc_deluxejjr_identity',  'status')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_identity')." ADD `status` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_item')) {
	if(!pdo_fieldexists('hc_deluxejjr_item',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_item')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_item')) {
	if(!pdo_fieldexists('hc_deluxejjr_item',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_item')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_item')) {
	if(!pdo_fieldexists('hc_deluxejjr_item',  'lpid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_item')." ADD `lpid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_item')) {
	if(!pdo_fieldexists('hc_deluxejjr_item',  'photoid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_item')." ADD `photoid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_item')) {
	if(!pdo_fieldexists('hc_deluxejjr_item',  'type')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_item')." ADD `type` tinyint(1) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_item')) {
	if(!pdo_fieldexists('hc_deluxejjr_item',  'item')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_item')." ADD `item` varchar(1000) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_item')) {
	if(!pdo_fieldexists('hc_deluxejjr_item',  'url')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_item')." ADD `url` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_item')) {
	if(!pdo_fieldexists('hc_deluxejjr_item',  'x')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_item')." ADD `x` int(3) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_item')) {
	if(!pdo_fieldexists('hc_deluxejjr_item',  'y')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_item')." ADD `y` int(3) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_item')) {
	if(!pdo_fieldexists('hc_deluxejjr_item',  'animation')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_item')." ADD `animation` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_item')) {
	if(!pdo_fieldexists('hc_deluxejjr_item',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_item')." ADD `createtime` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_jjrcode')) {
	if(!pdo_fieldexists('hc_deluxejjr_jjrcode',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_jjrcode')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_jjrcode')) {
	if(!pdo_fieldexists('hc_deluxejjr_jjrcode',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_jjrcode')." ADD `uniacid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_jjrcode')) {
	if(!pdo_fieldexists('hc_deluxejjr_jjrcode',  'code')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_jjrcode')." ADD `code` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_jjrcode')) {
	if(!pdo_fieldexists('hc_deluxejjr_jjrcode',  'listorder')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_jjrcode')." ADD `listorder` int(5) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_jjrcode')) {
	if(!pdo_fieldexists('hc_deluxejjr_jjrcode',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_jjrcode')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_jjrcode')) {
	if(!pdo_fieldexists('hc_deluxejjr_jjrcode',  'content')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_jjrcode')." ADD `content` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_jjrcode')) {
	if(!pdo_fieldexists('hc_deluxejjr_jjrcode',  'status')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_jjrcode')." ADD `status` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_log')) {
	if(!pdo_fieldexists('hc_deluxejjr_log',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_log')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_log')) {
	if(!pdo_fieldexists('hc_deluxejjr_log',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_log')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_log')) {
	if(!pdo_fieldexists('hc_deluxejjr_log',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_log')." ADD `openid` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_log')) {
	if(!pdo_fieldexists('hc_deluxejjr_log',  'share_openid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_log')." ADD `share_openid` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_log')) {
	if(!pdo_fieldexists('hc_deluxejjr_log',  'loupan')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_log')." ADD `loupan` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_log')) {
	if(!pdo_fieldexists('hc_deluxejjr_log',  'browser')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_log')." ADD `browser` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_log')) {
	if(!pdo_fieldexists('hc_deluxejjr_log',  'ip')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_log')." ADD `ip` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_log')) {
	if(!pdo_fieldexists('hc_deluxejjr_log',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_log')." ADD `createtime` int(10) NOT NULL   COMMENT '时间戳格式';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_log')) {
	if(!pdo_fieldexists('hc_deluxejjr_log',  'createtime1')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_log')." ADD `createtime1` varchar(20) NOT NULL   COMMENT '日期格式';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_logloupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_logloupan',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_logloupan')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_logloupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_logloupan',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_logloupan')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_logloupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_logloupan',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_logloupan')." ADD `openid` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_logloupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_logloupan',  'lid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_logloupan')." ADD `lid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_logloupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_logloupan',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_logloupan')." ADD `createtime` int(10) NOT NULL   COMMENT '时间戳格式';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_logloupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_logloupan',  'createtime1')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_logloupan')." ADD `createtime1` varchar(20) NOT NULL   COMMENT '日期格式';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'title')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `title` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'icon')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `icon` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'share')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `share` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'open')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `open` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'ostyle')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `ostyle` tinyint(1) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'music')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `music` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'mauto')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `mauto` tinyint(1) unsigned NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'mloop')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `mloop` tinyint(1) unsigned NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'thumb')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `thumb` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'content')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `content` varchar(1000) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'displayorder')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `displayorder` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'isloop')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `isloop` tinyint(1) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'isview')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `isview` tinyint(1) unsigned NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'type')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `type` tinyint(1) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'location_a')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `location_a` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'location_c')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `location_c` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'location_p')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `location_p` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'address')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `address` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'lng')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `lng` varchar(12)   DEFAULT 116.403694 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'lat')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `lat` varchar(12)   DEFAULT 39.916042 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'addr')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `addr` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'commission')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `commission` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'tjcredit')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `tjcredit` int(10)    COMMENT '推荐积分';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'stacredit')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `stacredit` int(10)    COMMENT '状态积分';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'price')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `price` int(10) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'recnum')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `recnum` int(10) NOT NULL  DEFAULT 0 COMMENT '推荐数';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'sucnum')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `sucnum` int(10) NOT NULL  DEFAULT 0 COMMENT '成交数';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'tel')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `tel` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'phone')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `phone` varchar(50)    COMMENT '投诉电话';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `createtime` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'iscity')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `iscity` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'isautoallot')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `isautoallot` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'status')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `status` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'typekind')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `typekind` tinyint(2) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'jw_addr')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `jw_addr` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_loupan')) {
	if(!pdo_fieldexists('hc_deluxejjr_loupan',  'id_view')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_loupan')." ADD `id_view` varchar(50) NOT NULL   COMMENT '身份可见';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'tjmid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `tjmid` int(10) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `openid` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'media_id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `media_id` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'media_time')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `media_time` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'headurl')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `headurl` varchar(250) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'identity_cardurl')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `identity_cardurl` varchar(250) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'identity_headurl')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `identity_headurl` varchar(250) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'realname')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `realname` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `mobile` varchar(11) NOT NULL   COMMENT '手机号码';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'bankcard')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `bankcard` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'banktype')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `banktype` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'identity')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `identity` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'code')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `code` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'cardurltime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `cardurltime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'headurltime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `headurltime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'createtime1')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `createtime1` varchar(20) NOT NULL   COMMENT '日期格式';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'status')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `status` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'commission')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `commission` decimal(10,2) NOT NULL  DEFAULT 0.00 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_member')) {
	if(!pdo_fieldexists('hc_deluxejjr_member',  'ischange')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_member')." ADD `ischange` tinyint(1) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_photo')) {
	if(!pdo_fieldexists('hc_deluxejjr_photo',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_photo')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_photo')) {
	if(!pdo_fieldexists('hc_deluxejjr_photo',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_photo')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_photo')) {
	if(!pdo_fieldexists('hc_deluxejjr_photo',  'lpid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_photo')." ADD `lpid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_photo')) {
	if(!pdo_fieldexists('hc_deluxejjr_photo',  'title')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_photo')." ADD `title` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_photo')) {
	if(!pdo_fieldexists('hc_deluxejjr_photo',  'url')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_photo')." ADD `url` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_photo')) {
	if(!pdo_fieldexists('hc_deluxejjr_photo',  'attachment')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_photo')." ADD `attachment` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_photo')) {
	if(!pdo_fieldexists('hc_deluxejjr_photo',  'ispreview')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_photo')." ADD `ispreview` tinyint(1) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_photo')) {
	if(!pdo_fieldexists('hc_deluxejjr_photo',  'displayorder')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_photo')." ADD `displayorder` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_photo')) {
	if(!pdo_fieldexists('hc_deluxejjr_photo',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_photo')." ADD `createtime` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_poster')) {
	if(!pdo_fieldexists('hc_deluxejjr_poster',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_poster')." ADD `id` int(10) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_poster')) {
	if(!pdo_fieldexists('hc_deluxejjr_poster',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_poster')." ADD `uniacid` int(11) unsigned   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_poster')) {
	if(!pdo_fieldexists('hc_deluxejjr_poster',  'title')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_poster')." ADD `title` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_poster')) {
	if(!pdo_fieldexists('hc_deluxejjr_poster',  'bg')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_poster')." ADD `bg` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_poster')) {
	if(!pdo_fieldexists('hc_deluxejjr_poster',  'data')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_poster')." ADD `data` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_poster')) {
	if(!pdo_fieldexists('hc_deluxejjr_poster',  'keyword')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_poster')." ADD `keyword` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_poster')) {
	if(!pdo_fieldexists('hc_deluxejjr_poster',  'waittext')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_poster')." ADD `waittext` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_poster')) {
	if(!pdo_fieldexists('hc_deluxejjr_poster',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_poster')." ADD `createtime` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_promanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_promanager',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_promanager')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_promanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_promanager',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_promanager')." ADD `uniacid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_promanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_promanager',  'code')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_promanager')." ADD `code` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_promanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_promanager',  'listorder')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_promanager')." ADD `listorder` int(5) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_promanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_promanager',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_promanager')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_promanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_promanager',  'content')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_promanager')." ADD `content` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_promanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_promanager',  'status')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_promanager')." ADD `status` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_promanager')) {
	if(!pdo_fieldexists('hc_deluxejjr_promanager',  'loupanid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_promanager')." ADD `loupanid` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_protect')) {
	if(!pdo_fieldexists('hc_deluxejjr_protect',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_protect')." ADD `id` int(10) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_protect')) {
	if(!pdo_fieldexists('hc_deluxejjr_protect',  'cname')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_protect')." ADD `cname` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_protect')) {
	if(!pdo_fieldexists('hc_deluxejjr_protect',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_protect')." ADD `mobile` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_protect')) {
	if(!pdo_fieldexists('hc_deluxejjr_protect',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_protect')." ADD `createtime` int(10) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_protect')) {
	if(!pdo_fieldexists('hc_deluxejjr_protect',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_protect')." ADD `uniacid` int(10) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_question')) {
	if(!pdo_fieldexists('hc_deluxejjr_question',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_question')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_question')) {
	if(!pdo_fieldexists('hc_deluxejjr_question',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_question')." ADD `uniacid` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '所属帐号';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_question')) {
	if(!pdo_fieldexists('hc_deluxejjr_question',  'title')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_question')." ADD `title` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_question')) {
	if(!pdo_fieldexists('hc_deluxejjr_question',  'content')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_question')." ADD `content` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_question')) {
	if(!pdo_fieldexists('hc_deluxejjr_question',  'displayorder')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_question')." ADD `displayorder` tinyint(3) unsigned NOT NULL  DEFAULT 0 COMMENT '排序';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_question')) {
	if(!pdo_fieldexists('hc_deluxejjr_question',  'isopen')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_question')." ADD `isopen` tinyint(1) unsigned   DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_question')) {
	if(!pdo_fieldexists('hc_deluxejjr_question',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_question')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_rule')) {
	if(!pdo_fieldexists('hc_deluxejjr_rule',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_rule')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_rule')) {
	if(!pdo_fieldexists('hc_deluxejjr_rule',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_rule')." ADD `uniacid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_rule')) {
	if(!pdo_fieldexists('hc_deluxejjr_rule',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_rule')." ADD `mobile` varchar(20) NOT NULL   COMMENT '服务电话';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_rule')) {
	if(!pdo_fieldexists('hc_deluxejjr_rule',  'rule')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_rule')." ADD `rule` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_rule')) {
	if(!pdo_fieldexists('hc_deluxejjr_rule',  'teams')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_rule')." ADD `teams` text    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_rule')) {
	if(!pdo_fieldexists('hc_deluxejjr_rule',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_rule')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_rule')) {
	if(!pdo_fieldexists('hc_deluxejjr_rule',  'cpcredit')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_rule')." ADD `cpcredit` int(10) NOT NULL   COMMENT '客户池积分';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_rule')) {
	if(!pdo_fieldexists('hc_deluxejjr_rule',  'teamcredit')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_rule')." ADD `teamcredit` int(10) NOT NULL   COMMENT '下线积分';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_rule')) {
	if(!pdo_fieldexists('hc_deluxejjr_rule',  'gzurl')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_rule')." ADD `gzurl` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_rule')) {
	if(!pdo_fieldexists('hc_deluxejjr_rule',  'share_title')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_rule')." ADD `share_title` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_rule')) {
	if(!pdo_fieldexists('hc_deluxejjr_rule',  'share_thumb')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_rule')." ADD `share_thumb` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_rule')) {
	if(!pdo_fieldexists('hc_deluxejjr_rule',  'share_content')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_rule')." ADD `share_content` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_rule')) {
	if(!pdo_fieldexists('hc_deluxejjr_rule',  'isopen')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_rule')." ADD `isopen` tinyint(1) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_rule')) {
	if(!pdo_fieldexists('hc_deluxejjr_rule',  'isselect_city')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_rule')." ADD `isselect_city` tinyint(1) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_rule')) {
	if(!pdo_fieldexists('hc_deluxejjr_rule',  'teamfy')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_rule')." ADD `teamfy` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_templatenews')) {
	if(!pdo_fieldexists('hc_deluxejjr_templatenews',  'id')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_templatenews')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_templatenews')) {
	if(!pdo_fieldexists('hc_deluxejjr_templatenews',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_templatenews')." ADD `uniacid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_templatenews')) {
	if(!pdo_fieldexists('hc_deluxejjr_templatenews',  'CustomerFP')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_templatenews')." ADD `CustomerFP` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_templatenews')) {
	if(!pdo_fieldexists('hc_deluxejjr_templatenews',  'CreditChange')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_templatenews')." ADD `CreditChange` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_templatenews')) {
	if(!pdo_fieldexists('hc_deluxejjr_templatenews',  'Commission')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_templatenews')." ADD `Commission` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_templatenews')) {
	if(!pdo_fieldexists('hc_deluxejjr_templatenews',  'StatusChange')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_templatenews')." ADD `StatusChange` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('hc_deluxejjr_templatenews')) {
	if(!pdo_fieldexists('hc_deluxejjr_templatenews',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('hc_deluxejjr_templatenews')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
