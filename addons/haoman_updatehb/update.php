<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_haoman_updatehb_addad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) NOT NULL DEFAULT '0',
  `rulename` varchar(255) NOT NULL COMMENT '活动规则',
  `adlogo` varchar(255) NOT NULL DEFAULT '0' COMMENT '广告图片',
  `adtitle` varchar(255) NOT NULL DEFAULT '0' COMMENT '广告标题',
  `addetails` varchar(255) NOT NULL DEFAULT '0' COMMENT '广告简介',
  `adlink` varchar(255) NOT NULL DEFAULT '0' COMMENT '广告链接',
  `createtime` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0表示未投放，1表示投放',
  PRIMARY KEY (`id`),
  KEY `idx_id_rulename` (`id`,`rulename`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_haoman_updatehb_award` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `weid` int(10) NOT NULL,
  `rid` int(10) unsigned NOT NULL COMMENT '规则ID',
  `from_user` varchar(50) DEFAULT '0' COMMENT '用户ID',
  `nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '微信昵称',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '微信头像',
  `credit` int(10) NOT NULL,
  `prizetype` varchar(10) DEFAULT '' COMMENT '类型，0表示刷新红包，1表示转发得红包，2表示口令得红包，3表示扫码得红包',
  `status` tinyint(1) DEFAULT '0' COMMENT '1标示未提现，2标示已经提现，3标示被拒绝',
  `createtime` int(10) DEFAULT '0',
  `title` varchar(50) NOT NULL COMMENT '奖项',
  `total` int(11) NOT NULL COMMENT '数量',
  `probalilty` varchar(5) NOT NULL COMMENT '概率',
  `description` varchar(100) NOT NULL DEFAULT '' COMMENT '描述',
  `card_id` varchar(255) NOT NULL,
  `fansID` int(11) DEFAULT '0',
  `jifen` int(10) NOT NULL COMMENT '获得的积分',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '联系电话',
  `iszhuangyuan` tinyint(1) NOT NULL DEFAULT '0',
  `titleid` int(10) NOT NULL,
  `awardname` varchar(50) DEFAULT '' COMMENT '描述',
  `awardsimg` varchar(200) NOT NULL COMMENT '奖品图片',
  `prize` int(11) DEFAULT '0' COMMENT '奖品ID',
  `consumetime` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`),
  KEY `indx_from_user` (`from_user`),
  KEY `indx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_haoman_updatehb_baoming` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则id',
  `uniacid` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `from_user` varchar(50) NOT NULL DEFAULT '' COMMENT '用户openid',
  `realname` varchar(20) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '联系电话',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '联系地址',
  `createtime` int(10) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`),
  KEY `indx_from_user` (`from_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_haoman_updatehb_cardticket` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) DEFAULT NULL,
  `createtime` varchar(20) DEFAULT NULL,
  `ticket` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_haoman_updatehb_cash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `rid` int(11) DEFAULT '0',
  `fansID` int(11) DEFAULT '0',
  `from_user` varchar(50) DEFAULT '0' COMMENT '用户ID',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '微信头像',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '联系电话',
  `nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '微信昵称',
  `awardname` varchar(50) DEFAULT '' COMMENT '兑奖金额',
  `prizetype` varchar(10) DEFAULT '' COMMENT '类型',
  `awardsimg` varchar(200) NOT NULL COMMENT '奖品图片',
  `prize` int(11) DEFAULT '0' COMMENT '奖品ID',
  `credit` int(11) DEFAULT '0' COMMENT '奖品金额',
  `createtime` int(10) DEFAULT '0',
  `consumetime` int(10) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_haoman_updatehb_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则id',
  `uniacid` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `from_user` varchar(50) NOT NULL DEFAULT '' COMMENT '用户openid',
  `fromuser` varchar(50) NOT NULL DEFAULT '' COMMENT '分享人openid',
  `avatar` varchar(512) NOT NULL DEFAULT '' COMMENT '微信头像',
  `nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '微信昵称',
  `visitorsip` varchar(15) NOT NULL DEFAULT '' COMMENT '访问IP',
  `visitorstime` int(10) unsigned NOT NULL COMMENT '访问时间',
  `viewnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '查看次数',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`),
  KEY `indx_from_user` (`from_user`),
  KEY `indx_fromuser` (`fromuser`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_haoman_updatehb_fans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) DEFAULT '0',
  `uniacid` int(11) DEFAULT '0',
  `fansID` int(11) DEFAULT '0',
  `from_user` varchar(50) DEFAULT '' COMMENT '用户ID',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '微信头像',
  `nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '微信昵称',
  `realname` varchar(20) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '联系电话',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '联系地址',
  `hb_total` int(11) DEFAULT '0' COMMENT '刷新红包总金额',
  `share_total` int(11) DEFAULT '0' COMMENT '分享得红包总金额',
  `pw_total` int(11) DEFAULT '0' COMMENT '口令得红包总金额',
  `scan_total` int(11) DEFAULT '0' COMMENT '扫码得红包总金额',
  `isad` tinyint(1) DEFAULT '0' COMMENT '是否看过场景',
  `iscode` tinyint(1) DEFAULT '0' COMMENT '是否短信验证过',
  `istx_code` tinyint(1) DEFAULT '0' COMMENT '是否提现验证过',
  `isshare` tinyint(1) DEFAULT '0' COMMENT '是否分享过',
  `bbm_use_times` int(11) DEFAULT '0',
  `num` int(11) DEFAULT '0' COMMENT '短信验证次数',
  `totalnum` int(11) DEFAULT '0' COMMENT '已经提现金额',
  `createtime` int(10) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `today_most_times` int(11) DEFAULT '0' COMMENT '每日最多次数',
  `sharenum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分享量',
  `sharetime` int(10) DEFAULT '0' COMMENT '提现次数',
  `awardingid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '兑奖地址ID',
  `todaynum` int(11) DEFAULT '0',
  `is_closebg` int(11) DEFAULT '0' COMMENT '是否关闭背景音乐',
  `is_hbok` int(11) DEFAULT '0',
  `zy_times` int(11) DEFAULT '0',
  `xx_zy_times` int(11) DEFAULT '0',
  `daynum` int(11) DEFAULT '0',
  `jifen` int(10) NOT NULL COMMENT '总积分',
  `awardnum` int(11) DEFAULT '0',
  `last_time` int(10) DEFAULT '0',
  `zhongjiang` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_from_user` (`from_user`),
  KEY `indx_uniacid` (`uniacid`),
  KEY `indx_mobile` (`mobile`),
  KEY `indx_jifen` (`jifen`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_haoman_updatehb_hb` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL DEFAULT '0',
  `set` text,
  `mchid` varchar(100) NOT NULL DEFAULT '' COMMENT '商户号',
  `password` varchar(2550) NOT NULL DEFAULT '' COMMENT '商户密码',
  `appid` varchar(100) NOT NULL DEFAULT '' COMMENT '服务号ID',
  `secret` varchar(255) NOT NULL DEFAULT '' COMMENT '服务号secret',
  `ip` varchar(100) NOT NULL DEFAULT '' COMMENT '服务器IP',
  `sname` varchar(100) NOT NULL DEFAULT '' COMMENT '公众号名称',
  `wishing` varchar(100) NOT NULL DEFAULT '' COMMENT '祝福语',
  `actname` varchar(100) NOT NULL DEFAULT '' COMMENT '红包活动名称',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT 'logo',
  `hbwishing` varchar(100) DEFAULT '' COMMENT '红包祝福语',
  `hbactname` varchar(100) DEFAULT '' COMMENT '红包活动',
  `hbremark` varchar(150) DEFAULT '' COMMENT '红包描述',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_haoman_updatehb_jiequan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `appid` varchar(255) DEFAULT '',
  `appsecret` varchar(255) DEFAULT '',
  `appid_share` varchar(255) DEFAULT '',
  `appsecret_share` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_haoman_updatehb_password` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则id',
  `uniacid` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `from_user` varchar(50) NOT NULL DEFAULT '' COMMENT '用户openid',
  `pwid` varchar(50) NOT NULL DEFAULT '' COMMENT '口令ID',
  `avatar` varchar(512) NOT NULL DEFAULT '' COMMENT '微信头像',
  `nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '微信昵称',
  `visitorsip` varchar(15) NOT NULL DEFAULT '' COMMENT '访问IP',
  `visitorstime` int(10) unsigned NOT NULL COMMENT '访问时间',
  `viewnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_haoman_updatehb_pici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `rid` int(11) DEFAULT '0',
  `pici` varchar(10) DEFAULT '' COMMENT '批次',
  `rulename` varchar(50) DEFAULT NULL COMMENT '适用规则名称',
  `codenum` int(11) DEFAULT '0' COMMENT '口令数量',
  `is_qrcode` int(11) DEFAULT '0' COMMENT '是否生成二维码',
  `is_qrcode2` int(11) DEFAULT '0' COMMENT '是否生成永久二维码',
  `createtime` int(10) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`),
  KEY `indx_pici` (`pici`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_haoman_updatehb_prize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `rid` int(10) unsigned NOT NULL COMMENT '规则ID',
  `line1` int(10) NOT NULL COMMENT '所在区间1',
  `line2` int(10) NOT NULL COMMENT '所在区间2',
  `credit` int(10) NOT NULL COMMENT '增长区间1',
  `credit2` int(10) NOT NULL COMMENT '增长区间2',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_haoman_updatehb_pw` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `rid` int(10) unsigned NOT NULL COMMENT '规则ID',
  `pici` varchar(10) NOT NULL COMMENT '批次',
  `pwid` varchar(50) NOT NULL DEFAULT '' COMMENT '口令标示符',
  `title` varchar(35) DEFAULT NULL COMMENT '口令',
  `rulename` varchar(50) DEFAULT NULL COMMENT '适用规则名称',
  `iscqr` int(11) DEFAULT '0' COMMENT '是否生成二维码',
  `starttime` int(10) DEFAULT '0',
  `endtime` int(10) DEFAULT '0',
  `num` int(10) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_pwid` (`pwid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_haoman_updatehb_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned DEFAULT '0',
  `uniacid` int(11) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `picture` varchar(100) NOT NULL COMMENT '活动图片',
  `description` varchar(255) DEFAULT '',
  `starttime` int(10) DEFAULT '0',
  `endtime` int(10) DEFAULT '0',
  `rules` text NOT NULL COMMENT '规则',
  `gl_openid` varchar(300) DEFAULT '',
  `timenum` int(10) DEFAULT '0',
  `up_qrcode` varchar(255) DEFAULT '',
  `share_url` varchar(300) DEFAULT '',
  `share_gz` varchar(300) DEFAULT '',
  `share_type` tinyint(1) DEFAULT '0',
  `is_hbad` tinyint(1) DEFAULT '0',
  `hbtotal_top` int(11) DEFAULT '0',
  `hbtotal_top_dec` varchar(300) DEFAULT '',
  `is_sharetype` tinyint(1) DEFAULT '0' COMMENT '分享后赠送次数方式',
  `share_title` varchar(200) DEFAULT '',
  `share_desc` varchar(300) DEFAULT '',
  `share_imgurl` varchar(255) NOT NULL COMMENT '分享朋友或朋友圈图',
  `getip` tinyint(1) DEFAULT '0',
  `getip_addr` text NOT NULL COMMENT '限制地区ip',
  `noip_url` varchar(300) DEFAULT '',
  `allowip` text NOT NULL,
  `isallowip` tinyint(2) DEFAULT '0',
  `is_openbbm` tinyint(1) DEFAULT '0',
  `bbm_use_times` int(11) DEFAULT '0',
  `share_acid` int(10) DEFAULT '0',
  `tx_most` int(11) DEFAULT '0',
  `xf_condition` tinyint(1) DEFAULT '0',
  `number_times` int(11) DEFAULT '0',
  `share_topnum` int(11) DEFAULT '0' COMMENT '预留，分享朋友点击进来的上限预留',
  `share_credit` int(11) DEFAULT '0' COMMENT '预留，分享朋友或朋友圈点击进来的积分',
  `isshow` tinyint(1) DEFAULT '0',
  `isonce` tinyint(1) DEFAULT '0',
  `isonline` tinyint(1) DEFAULT '0',
  `copyright` varchar(20) DEFAULT '',
  `createtime` int(10) DEFAULT '0',
  `isappkey` tinyint(2) DEFAULT '0',
  `bd_key` varchar(50) DEFAULT '',
  `address_sf` text NOT NULL,
  `address_sq` text NOT NULL,
  `address_qx` text NOT NULL,
  `tx_code` tinyint(2) DEFAULT '0',
  `switch` tinyint(2) DEFAULT '0',
  `teladdr` tinyint(2) DEFAULT '0',
  `tellimit` int(10) DEFAULT '0',
  `appkey` varchar(200) DEFAULT '0',
  `secretKey` varchar(200) DEFAULT '0',
  `sign` varchar(200) DEFAULT '0',
  `sms_id` varchar(200) DEFAULT '0',
  `outtips` varchar(200) DEFAULT '0',
  `viewnum` int(11) DEFAULT '0' COMMENT '浏览次数',
  `fansnum` int(11) DEFAULT '0' COMMENT '参与人数',
  `scene` tinyint(1) DEFAULT '0',
  `out_scene_url` varchar(255) NOT NULL COMMENT '外链场景URL',
  `p1_bg` varchar(255) NOT NULL COMMENT '自带场景背景图',
  `p1_top` varchar(255) NOT NULL COMMENT '自带场景顶部图',
  `p1_bottom` varchar(255) NOT NULL COMMENT '自带场景底部图',
  `p2_bg` varchar(255) NOT NULL COMMENT '自带场景背景图',
  `p2_top` varchar(255) NOT NULL COMMENT '自带场景顶部图',
  `p2_bottom` varchar(255) NOT NULL COMMENT '自带场景底部图',
  `p3_bg` varchar(255) NOT NULL COMMENT '自带场景背景图',
  `p3_top` varchar(255) NOT NULL COMMENT '自带场景顶部图',
  `p3_isphone` tinyint(1) DEFAULT '0',
  `p3_phone` varchar(50) DEFAULT '0',
  `start_bg` varchar(250) DEFAULT '',
  `start_top` varchar(250) DEFAULT '',
  `start_dec` varchar(80) DEFAULT '',
  `start_music` varchar(250) DEFAULT '',
  `hb_time` int(11) DEFAULT '0',
  `hb_credit1` int(11) DEFAULT '0',
  `hb_credit2` int(11) DEFAULT '0',
  `hbtype` tinyint(1) DEFAULT '0',
  `hbtx_time` int(10) DEFAULT '0',
  `hb_local` tinyint(1) DEFAULT '0',
  `hb_localcredit1` int(11) DEFAULT '0',
  `hb_localcredit2` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");
if(pdo_tableexists('haoman_updatehb_addad')) {
	if(!pdo_fieldexists('haoman_updatehb_addad',  'id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_addad')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_addad')) {
	if(!pdo_fieldexists('haoman_updatehb_addad',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_addad')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_addad')) {
	if(!pdo_fieldexists('haoman_updatehb_addad',  'rulename')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_addad')." ADD `rulename` varchar(255) NOT NULL   COMMENT '活动规则';");
	}	
}
if(pdo_tableexists('haoman_updatehb_addad')) {
	if(!pdo_fieldexists('haoman_updatehb_addad',  'adlogo')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_addad')." ADD `adlogo` varchar(255) NOT NULL  DEFAULT 0 COMMENT '广告图片';");
	}	
}
if(pdo_tableexists('haoman_updatehb_addad')) {
	if(!pdo_fieldexists('haoman_updatehb_addad',  'adtitle')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_addad')." ADD `adtitle` varchar(255) NOT NULL  DEFAULT 0 COMMENT '广告标题';");
	}	
}
if(pdo_tableexists('haoman_updatehb_addad')) {
	if(!pdo_fieldexists('haoman_updatehb_addad',  'addetails')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_addad')." ADD `addetails` varchar(255) NOT NULL  DEFAULT 0 COMMENT '广告简介';");
	}	
}
if(pdo_tableexists('haoman_updatehb_addad')) {
	if(!pdo_fieldexists('haoman_updatehb_addad',  'adlink')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_addad')." ADD `adlink` varchar(255) NOT NULL  DEFAULT 0 COMMENT '广告链接';");
	}	
}
if(pdo_tableexists('haoman_updatehb_addad')) {
	if(!pdo_fieldexists('haoman_updatehb_addad',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_addad')." ADD `createtime` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_addad')) {
	if(!pdo_fieldexists('haoman_updatehb_addad',  'status')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_addad')." ADD `status` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '0表示未投放，1表示投放';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `uniacid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `weid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `rid` int(10) unsigned NOT NULL   COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'from_user')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `from_user` varchar(50)   DEFAULT 0 COMMENT '用户ID';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `nickname` varchar(50) NOT NULL   COMMENT '微信昵称';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `avatar` varchar(255) NOT NULL   COMMENT '微信头像';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'credit')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `credit` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'prizetype')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `prizetype` varchar(10)    COMMENT '类型，0表示刷新红包，1表示转发得红包，2表示口令得红包，3表示扫码得红包';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'status')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `status` tinyint(1)   DEFAULT 0 COMMENT '1标示未提现，2标示已经提现，3标示被拒绝';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `createtime` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'title')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `title` varchar(50) NOT NULL   COMMENT '奖项';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'total')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `total` int(11) NOT NULL   COMMENT '数量';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'probalilty')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `probalilty` varchar(5) NOT NULL   COMMENT '概率';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'description')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `description` varchar(100) NOT NULL   COMMENT '描述';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'card_id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `card_id` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'fansID')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `fansID` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'jifen')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `jifen` int(10) NOT NULL   COMMENT '获得的积分';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `mobile` varchar(20) NOT NULL   COMMENT '联系电话';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'iszhuangyuan')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `iszhuangyuan` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'titleid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `titleid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'awardname')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `awardname` varchar(50)    COMMENT '描述';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'awardsimg')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `awardsimg` varchar(200) NOT NULL   COMMENT '奖品图片';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'prize')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `prize` int(11)   DEFAULT 0 COMMENT '奖品ID';");
	}	
}
if(pdo_tableexists('haoman_updatehb_award')) {
	if(!pdo_fieldexists('haoman_updatehb_award',  'consumetime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_award')." ADD `consumetime` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_baoming')) {
	if(!pdo_fieldexists('haoman_updatehb_baoming',  'id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_baoming')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_baoming')) {
	if(!pdo_fieldexists('haoman_updatehb_baoming',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_baoming')." ADD `rid` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '规则id';");
	}	
}
if(pdo_tableexists('haoman_updatehb_baoming')) {
	if(!pdo_fieldexists('haoman_updatehb_baoming',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_baoming')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '公众号ID';");
	}	
}
if(pdo_tableexists('haoman_updatehb_baoming')) {
	if(!pdo_fieldexists('haoman_updatehb_baoming',  'from_user')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_baoming')." ADD `from_user` varchar(50) NOT NULL   COMMENT '用户openid';");
	}	
}
if(pdo_tableexists('haoman_updatehb_baoming')) {
	if(!pdo_fieldexists('haoman_updatehb_baoming',  'realname')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_baoming')." ADD `realname` varchar(20) NOT NULL   COMMENT '真实姓名';");
	}	
}
if(pdo_tableexists('haoman_updatehb_baoming')) {
	if(!pdo_fieldexists('haoman_updatehb_baoming',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_baoming')." ADD `mobile` varchar(20) NOT NULL   COMMENT '联系电话';");
	}	
}
if(pdo_tableexists('haoman_updatehb_baoming')) {
	if(!pdo_fieldexists('haoman_updatehb_baoming',  'address')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_baoming')." ADD `address` varchar(255) NOT NULL   COMMENT '联系地址';");
	}	
}
if(pdo_tableexists('haoman_updatehb_baoming')) {
	if(!pdo_fieldexists('haoman_updatehb_baoming',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_baoming')." ADD `createtime` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_baoming')) {
	if(!pdo_fieldexists('haoman_updatehb_baoming',  'status')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_baoming')." ADD `status` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cardticket')) {
	if(!pdo_fieldexists('haoman_updatehb_cardticket',  'id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cardticket')." ADD `id` int(10) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cardticket')) {
	if(!pdo_fieldexists('haoman_updatehb_cardticket',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cardticket')." ADD `weid` int(10)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cardticket')) {
	if(!pdo_fieldexists('haoman_updatehb_cardticket',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cardticket')." ADD `createtime` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cardticket')) {
	if(!pdo_fieldexists('haoman_updatehb_cardticket',  'ticket')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cardticket')." ADD `ticket` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `uniacid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `rid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'fansID')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `fansID` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'from_user')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `from_user` varchar(50)   DEFAULT 0 COMMENT '用户ID';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `avatar` varchar(255) NOT NULL   COMMENT '微信头像';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `mobile` varchar(20) NOT NULL   COMMENT '联系电话';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `nickname` varchar(50) NOT NULL   COMMENT '微信昵称';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'awardname')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `awardname` varchar(50)    COMMENT '兑奖金额';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'prizetype')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `prizetype` varchar(10)    COMMENT '类型';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'awardsimg')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `awardsimg` varchar(200) NOT NULL   COMMENT '奖品图片';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'prize')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `prize` int(11)   DEFAULT 0 COMMENT '奖品ID';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'credit')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `credit` int(11)   DEFAULT 0 COMMENT '奖品金额';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `createtime` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'consumetime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `consumetime` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_cash')) {
	if(!pdo_fieldexists('haoman_updatehb_cash',  'status')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_cash')." ADD `status` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_data')) {
	if(!pdo_fieldexists('haoman_updatehb_data',  'id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_data')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_data')) {
	if(!pdo_fieldexists('haoman_updatehb_data',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_data')." ADD `rid` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '规则id';");
	}	
}
if(pdo_tableexists('haoman_updatehb_data')) {
	if(!pdo_fieldexists('haoman_updatehb_data',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_data')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '公众号ID';");
	}	
}
if(pdo_tableexists('haoman_updatehb_data')) {
	if(!pdo_fieldexists('haoman_updatehb_data',  'from_user')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_data')." ADD `from_user` varchar(50) NOT NULL   COMMENT '用户openid';");
	}	
}
if(pdo_tableexists('haoman_updatehb_data')) {
	if(!pdo_fieldexists('haoman_updatehb_data',  'fromuser')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_data')." ADD `fromuser` varchar(50) NOT NULL   COMMENT '分享人openid';");
	}	
}
if(pdo_tableexists('haoman_updatehb_data')) {
	if(!pdo_fieldexists('haoman_updatehb_data',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_data')." ADD `avatar` varchar(512) NOT NULL   COMMENT '微信头像';");
	}	
}
if(pdo_tableexists('haoman_updatehb_data')) {
	if(!pdo_fieldexists('haoman_updatehb_data',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_data')." ADD `nickname` varchar(50) NOT NULL   COMMENT '微信昵称';");
	}	
}
if(pdo_tableexists('haoman_updatehb_data')) {
	if(!pdo_fieldexists('haoman_updatehb_data',  'visitorsip')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_data')." ADD `visitorsip` varchar(15) NOT NULL   COMMENT '访问IP';");
	}	
}
if(pdo_tableexists('haoman_updatehb_data')) {
	if(!pdo_fieldexists('haoman_updatehb_data',  'visitorstime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_data')." ADD `visitorstime` int(10) unsigned NOT NULL   COMMENT '访问时间';");
	}	
}
if(pdo_tableexists('haoman_updatehb_data')) {
	if(!pdo_fieldexists('haoman_updatehb_data',  'viewnum')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_data')." ADD `viewnum` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '查看次数';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `rid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `uniacid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'fansID')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `fansID` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'from_user')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `from_user` varchar(50)    COMMENT '用户ID';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `avatar` varchar(255) NOT NULL   COMMENT '微信头像';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `nickname` varchar(50) NOT NULL   COMMENT '微信昵称';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'realname')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `realname` varchar(20) NOT NULL   COMMENT '真实姓名';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `mobile` varchar(20) NOT NULL   COMMENT '联系电话';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'address')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `address` varchar(255) NOT NULL   COMMENT '联系地址';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'hb_total')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `hb_total` int(11)   DEFAULT 0 COMMENT '刷新红包总金额';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'share_total')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `share_total` int(11)   DEFAULT 0 COMMENT '分享得红包总金额';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'pw_total')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `pw_total` int(11)   DEFAULT 0 COMMENT '口令得红包总金额';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'scan_total')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `scan_total` int(11)   DEFAULT 0 COMMENT '扫码得红包总金额';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'isad')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `isad` tinyint(1)   DEFAULT 0 COMMENT '是否看过场景';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'iscode')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `iscode` tinyint(1)   DEFAULT 0 COMMENT '是否短信验证过';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'istx_code')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `istx_code` tinyint(1)   DEFAULT 0 COMMENT '是否提现验证过';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'isshare')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `isshare` tinyint(1)   DEFAULT 0 COMMENT '是否分享过';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'bbm_use_times')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `bbm_use_times` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'num')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `num` int(11)   DEFAULT 0 COMMENT '短信验证次数';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'totalnum')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `totalnum` int(11)   DEFAULT 0 COMMENT '已经提现金额';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `createtime` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'status')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `status` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'today_most_times')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `today_most_times` int(11)   DEFAULT 0 COMMENT '每日最多次数';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'sharenum')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `sharenum` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '分享量';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'sharetime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `sharetime` int(10)   DEFAULT 0 COMMENT '提现次数';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'awardingid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `awardingid` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '兑奖地址ID';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'todaynum')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `todaynum` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'is_closebg')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `is_closebg` int(11)   DEFAULT 0 COMMENT '是否关闭背景音乐';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'is_hbok')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `is_hbok` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'zy_times')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `zy_times` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'xx_zy_times')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `xx_zy_times` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'daynum')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `daynum` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'jifen')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `jifen` int(10) NOT NULL   COMMENT '总积分';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'awardnum')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `awardnum` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'last_time')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `last_time` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_fans')) {
	if(!pdo_fieldexists('haoman_updatehb_fans',  'zhongjiang')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_fans')." ADD `zhongjiang` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `uniacid` int(11) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'set')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `set` text    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'mchid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `mchid` varchar(100) NOT NULL   COMMENT '商户号';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'password')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `password` varchar(2550) NOT NULL   COMMENT '商户密码';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'appid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `appid` varchar(100) NOT NULL   COMMENT '服务号ID';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'secret')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `secret` varchar(255) NOT NULL   COMMENT '服务号secret';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'ip')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `ip` varchar(100) NOT NULL   COMMENT '服务器IP';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'sname')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `sname` varchar(100) NOT NULL   COMMENT '公众号名称';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'wishing')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `wishing` varchar(100) NOT NULL   COMMENT '祝福语';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'actname')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `actname` varchar(100) NOT NULL   COMMENT '红包活动名称';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'logo')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `logo` varchar(255) NOT NULL   COMMENT 'logo';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'hbwishing')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `hbwishing` varchar(100)    COMMENT '红包祝福语';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'hbactname')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `hbactname` varchar(100)    COMMENT '红包活动';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'hbremark')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `hbremark` varchar(150)    COMMENT '红包描述';");
	}	
}
if(pdo_tableexists('haoman_updatehb_hb')) {
	if(!pdo_fieldexists('haoman_updatehb_hb',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_hb')." ADD `createtime` int(11) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_jiequan')) {
	if(!pdo_fieldexists('haoman_updatehb_jiequan',  'id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_jiequan')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_jiequan')) {
	if(!pdo_fieldexists('haoman_updatehb_jiequan',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_jiequan')." ADD `uniacid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_jiequan')) {
	if(!pdo_fieldexists('haoman_updatehb_jiequan',  'appid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_jiequan')." ADD `appid` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_jiequan')) {
	if(!pdo_fieldexists('haoman_updatehb_jiequan',  'appsecret')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_jiequan')." ADD `appsecret` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_jiequan')) {
	if(!pdo_fieldexists('haoman_updatehb_jiequan',  'appid_share')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_jiequan')." ADD `appid_share` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_jiequan')) {
	if(!pdo_fieldexists('haoman_updatehb_jiequan',  'appsecret_share')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_jiequan')." ADD `appsecret_share` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_password')) {
	if(!pdo_fieldexists('haoman_updatehb_password',  'id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_password')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_password')) {
	if(!pdo_fieldexists('haoman_updatehb_password',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_password')." ADD `rid` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '规则id';");
	}	
}
if(pdo_tableexists('haoman_updatehb_password')) {
	if(!pdo_fieldexists('haoman_updatehb_password',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_password')." ADD `uniacid` int(10) unsigned NOT NULL   COMMENT '公众号ID';");
	}	
}
if(pdo_tableexists('haoman_updatehb_password')) {
	if(!pdo_fieldexists('haoman_updatehb_password',  'from_user')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_password')." ADD `from_user` varchar(50) NOT NULL   COMMENT '用户openid';");
	}	
}
if(pdo_tableexists('haoman_updatehb_password')) {
	if(!pdo_fieldexists('haoman_updatehb_password',  'pwid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_password')." ADD `pwid` varchar(50) NOT NULL   COMMENT '口令ID';");
	}	
}
if(pdo_tableexists('haoman_updatehb_password')) {
	if(!pdo_fieldexists('haoman_updatehb_password',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_password')." ADD `avatar` varchar(512) NOT NULL   COMMENT '微信头像';");
	}	
}
if(pdo_tableexists('haoman_updatehb_password')) {
	if(!pdo_fieldexists('haoman_updatehb_password',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_password')." ADD `nickname` varchar(50) NOT NULL   COMMENT '微信昵称';");
	}	
}
if(pdo_tableexists('haoman_updatehb_password')) {
	if(!pdo_fieldexists('haoman_updatehb_password',  'visitorsip')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_password')." ADD `visitorsip` varchar(15) NOT NULL   COMMENT '访问IP';");
	}	
}
if(pdo_tableexists('haoman_updatehb_password')) {
	if(!pdo_fieldexists('haoman_updatehb_password',  'visitorstime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_password')." ADD `visitorstime` int(10) unsigned NOT NULL   COMMENT '访问时间';");
	}	
}
if(pdo_tableexists('haoman_updatehb_password')) {
	if(!pdo_fieldexists('haoman_updatehb_password',  'viewnum')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_password')." ADD `viewnum` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '状态';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pici')) {
	if(!pdo_fieldexists('haoman_updatehb_pici',  'id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pici')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pici')) {
	if(!pdo_fieldexists('haoman_updatehb_pici',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pici')." ADD `uniacid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pici')) {
	if(!pdo_fieldexists('haoman_updatehb_pici',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pici')." ADD `rid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pici')) {
	if(!pdo_fieldexists('haoman_updatehb_pici',  'pici')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pici')." ADD `pici` varchar(10)    COMMENT '批次';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pici')) {
	if(!pdo_fieldexists('haoman_updatehb_pici',  'rulename')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pici')." ADD `rulename` varchar(50)    COMMENT '适用规则名称';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pici')) {
	if(!pdo_fieldexists('haoman_updatehb_pici',  'codenum')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pici')." ADD `codenum` int(11)   DEFAULT 0 COMMENT '口令数量';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pici')) {
	if(!pdo_fieldexists('haoman_updatehb_pici',  'is_qrcode')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pici')." ADD `is_qrcode` int(11)   DEFAULT 0 COMMENT '是否生成二维码';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pici')) {
	if(!pdo_fieldexists('haoman_updatehb_pici',  'is_qrcode2')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pici')." ADD `is_qrcode2` int(11)   DEFAULT 0 COMMENT '是否生成永久二维码';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pici')) {
	if(!pdo_fieldexists('haoman_updatehb_pici',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pici')." ADD `createtime` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pici')) {
	if(!pdo_fieldexists('haoman_updatehb_pici',  'status')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pici')." ADD `status` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_prize')) {
	if(!pdo_fieldexists('haoman_updatehb_prize',  'id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_prize')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_prize')) {
	if(!pdo_fieldexists('haoman_updatehb_prize',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_prize')." ADD `uniacid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_prize')) {
	if(!pdo_fieldexists('haoman_updatehb_prize',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_prize')." ADD `rid` int(10) unsigned NOT NULL   COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('haoman_updatehb_prize')) {
	if(!pdo_fieldexists('haoman_updatehb_prize',  'line1')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_prize')." ADD `line1` int(10) NOT NULL   COMMENT '所在区间1';");
	}	
}
if(pdo_tableexists('haoman_updatehb_prize')) {
	if(!pdo_fieldexists('haoman_updatehb_prize',  'line2')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_prize')." ADD `line2` int(10) NOT NULL   COMMENT '所在区间2';");
	}	
}
if(pdo_tableexists('haoman_updatehb_prize')) {
	if(!pdo_fieldexists('haoman_updatehb_prize',  'credit')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_prize')." ADD `credit` int(10) NOT NULL   COMMENT '增长区间1';");
	}	
}
if(pdo_tableexists('haoman_updatehb_prize')) {
	if(!pdo_fieldexists('haoman_updatehb_prize',  'credit2')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_prize')." ADD `credit2` int(10) NOT NULL   COMMENT '增长区间2';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pw')) {
	if(!pdo_fieldexists('haoman_updatehb_pw',  'id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pw')." ADD `id` int(10) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pw')) {
	if(!pdo_fieldexists('haoman_updatehb_pw',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pw')." ADD `uniacid` int(10)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pw')) {
	if(!pdo_fieldexists('haoman_updatehb_pw',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pw')." ADD `rid` int(10) unsigned NOT NULL   COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pw')) {
	if(!pdo_fieldexists('haoman_updatehb_pw',  'pici')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pw')." ADD `pici` varchar(10) NOT NULL   COMMENT '批次';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pw')) {
	if(!pdo_fieldexists('haoman_updatehb_pw',  'pwid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pw')." ADD `pwid` varchar(50) NOT NULL   COMMENT '口令标示符';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pw')) {
	if(!pdo_fieldexists('haoman_updatehb_pw',  'title')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pw')." ADD `title` varchar(35)    COMMENT '口令';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pw')) {
	if(!pdo_fieldexists('haoman_updatehb_pw',  'rulename')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pw')." ADD `rulename` varchar(50)    COMMENT '适用规则名称';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pw')) {
	if(!pdo_fieldexists('haoman_updatehb_pw',  'iscqr')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pw')." ADD `iscqr` int(11)   DEFAULT 0 COMMENT '是否生成二维码';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pw')) {
	if(!pdo_fieldexists('haoman_updatehb_pw',  'starttime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pw')." ADD `starttime` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pw')) {
	if(!pdo_fieldexists('haoman_updatehb_pw',  'endtime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pw')." ADD `endtime` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pw')) {
	if(!pdo_fieldexists('haoman_updatehb_pw',  'num')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pw')." ADD `num` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pw')) {
	if(!pdo_fieldexists('haoman_updatehb_pw',  'status')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pw')." ADD `status` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_pw')) {
	if(!pdo_fieldexists('haoman_updatehb_pw',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_pw')." ADD `createtime` int(11) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `rid` int(10) unsigned   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `uniacid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'title')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `title` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'picture')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `picture` varchar(100) NOT NULL   COMMENT '活动图片';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'description')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `description` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'starttime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `starttime` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'endtime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `endtime` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'rules')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `rules` text NOT NULL   COMMENT '规则';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'gl_openid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `gl_openid` varchar(300)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'timenum')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `timenum` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'up_qrcode')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `up_qrcode` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'share_url')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `share_url` varchar(300)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'share_gz')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `share_gz` varchar(300)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'share_type')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `share_type` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'is_hbad')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `is_hbad` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'hbtotal_top')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `hbtotal_top` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'hbtotal_top_dec')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `hbtotal_top_dec` varchar(300)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'is_sharetype')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `is_sharetype` tinyint(1)   DEFAULT 0 COMMENT '分享后赠送次数方式';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'share_title')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `share_title` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'share_desc')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `share_desc` varchar(300)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'share_imgurl')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `share_imgurl` varchar(255) NOT NULL   COMMENT '分享朋友或朋友圈图';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'getip')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `getip` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'getip_addr')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `getip_addr` text NOT NULL   COMMENT '限制地区ip';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'noip_url')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `noip_url` varchar(300)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'allowip')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `allowip` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'isallowip')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `isallowip` tinyint(2)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'is_openbbm')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `is_openbbm` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'bbm_use_times')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `bbm_use_times` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'share_acid')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `share_acid` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'tx_most')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `tx_most` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'xf_condition')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `xf_condition` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'number_times')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `number_times` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'share_topnum')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `share_topnum` int(11)   DEFAULT 0 COMMENT '预留，分享朋友点击进来的上限预留';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'share_credit')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `share_credit` int(11)   DEFAULT 0 COMMENT '预留，分享朋友或朋友圈点击进来的积分';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'isshow')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `isshow` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'isonce')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `isonce` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'isonline')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `isonline` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'copyright')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `copyright` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `createtime` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'isappkey')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `isappkey` tinyint(2)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'bd_key')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `bd_key` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'address_sf')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `address_sf` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'address_sq')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `address_sq` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'address_qx')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `address_qx` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'tx_code')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `tx_code` tinyint(2)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'switch')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `switch` tinyint(2)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'teladdr')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `teladdr` tinyint(2)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'tellimit')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `tellimit` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'appkey')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `appkey` varchar(200)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'secretKey')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `secretKey` varchar(200)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'sign')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `sign` varchar(200)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'sms_id')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `sms_id` varchar(200)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'outtips')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `outtips` varchar(200)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'viewnum')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `viewnum` int(11)   DEFAULT 0 COMMENT '浏览次数';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'fansnum')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `fansnum` int(11)   DEFAULT 0 COMMENT '参与人数';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'scene')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `scene` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'out_scene_url')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `out_scene_url` varchar(255) NOT NULL   COMMENT '外链场景URL';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'p1_bg')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `p1_bg` varchar(255) NOT NULL   COMMENT '自带场景背景图';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'p1_top')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `p1_top` varchar(255) NOT NULL   COMMENT '自带场景顶部图';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'p1_bottom')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `p1_bottom` varchar(255) NOT NULL   COMMENT '自带场景底部图';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'p2_bg')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `p2_bg` varchar(255) NOT NULL   COMMENT '自带场景背景图';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'p2_top')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `p2_top` varchar(255) NOT NULL   COMMENT '自带场景顶部图';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'p2_bottom')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `p2_bottom` varchar(255) NOT NULL   COMMENT '自带场景底部图';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'p3_bg')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `p3_bg` varchar(255) NOT NULL   COMMENT '自带场景背景图';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'p3_top')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `p3_top` varchar(255) NOT NULL   COMMENT '自带场景顶部图';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'p3_isphone')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `p3_isphone` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'p3_phone')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `p3_phone` varchar(50)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'start_bg')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `start_bg` varchar(250)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'start_top')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `start_top` varchar(250)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'start_dec')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `start_dec` varchar(80)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'start_music')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `start_music` varchar(250)    COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'hb_time')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `hb_time` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'hb_credit1')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `hb_credit1` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'hb_credit2')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `hb_credit2` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'hbtype')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `hbtype` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'hbtx_time')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `hbtx_time` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'hb_local')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `hb_local` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'hb_localcredit1')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `hb_localcredit1` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('haoman_updatehb_reply')) {
	if(!pdo_fieldexists('haoman_updatehb_reply',  'hb_localcredit2')) {
		pdo_query("ALTER TABLE ".tablename('haoman_updatehb_reply')." ADD `hb_localcredit2` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
