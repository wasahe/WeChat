<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_tiger_jifenbao_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `title` varchar(250) DEFAULT '0',
  `pic` varchar(250) DEFAULT '0',
  `url` varchar(250) DEFAULT '0',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiger_jifenbao_dborder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `uid` int(10) NOT NULL COMMENT '用户ID',
  `bizId` varchar(30) NOT NULL COMMENT '订单号',
  `orderNum` varchar(255) NOT NULL COMMENT '兑吧订单号',
  `credits` int(20) NOT NULL COMMENT '积分',
  `params` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `ip` varchar(15) NOT NULL COMMENT '客户端ip',
  `starttimestamp` int(10) DEFAULT NULL COMMENT '下单时间',
  `endtimestamp` int(10) DEFAULT NULL COMMENT '成功时间',
  `waitAudit` int(8) DEFAULT '0' COMMENT '是否审核',
  `Audit` int(1) DEFAULT '0' COMMENT '审核状态',
  `actualPrice` int(11) DEFAULT '0' COMMENT '扣除费用',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `facePrice` int(11) DEFAULT '0' COMMENT '市场价值',
  `itemCode` varchar(255) NOT NULL COMMENT '商品编码',
  `Audituser` varchar(255) NOT NULL COMMENT '审核员',
  `status` int(1) DEFAULT '0' COMMENT '订单状态',
  `createtime` int(10) DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`id`),
  KEY `indx_uniacid` (`uniacid`),
  KEY `indx_bizId` (`bizId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiger_jifenbao_dbrecord` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `nickname` varchar(200) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `orderNum` varchar(200) NOT NULL,
  `credits` varchar(200) NOT NULL,
  `params` varchar(255) NOT NULL,
  `type` varchar(200) NOT NULL,
  `ip` varchar(200) NOT NULL,
  `sign` varchar(255) NOT NULL,
  `timestamp` int(11) DEFAULT '0',
  `waitAudit` varchar(255) NOT NULL,
  `actualPrice` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `paramsTest4` varchar(255) NOT NULL,
  `facePrice` varchar(255) NOT NULL,
  `appKey` varchar(255) NOT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiger_jifenbao_dianyuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '0',
  `nickname` varchar(50) DEFAULT '0',
  `ename` varchar(50) DEFAULT '0',
  `tel` varchar(50) DEFAULT '0',
  `password` varchar(50) DEFAULT '0',
  `companyname` varchar(200) DEFAULT '0',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiger_jifenbao_goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `px` int(10) NOT NULL DEFAULT '0',
  `shtype` int(2) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `hot` varchar(50) NOT NULL,
  `hotcolor` varchar(50) NOT NULL,
  `leibei` varchar(10) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `appurl` varchar(300) DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `day_sum` int(11) NOT NULL DEFAULT '0',
  `cardid` varchar(200) NOT NULL,
  `deadline` datetime NOT NULL,
  `per_user_limit` int(11) NOT NULL DEFAULT '0',
  `starttime` varchar(12) DEFAULT NULL,
  `endtime` varchar(12) DEFAULT NULL,
  `cost` int(11) NOT NULL DEFAULT '0',
  `cost_type` int(11) NOT NULL DEFAULT '1' COMMENT '1系统积分 2会员积分 4,8等留作扩展',
  `price` decimal(10,2) NOT NULL DEFAULT '0.10' COMMENT '商品价格',
  `vip_require` int(10) NOT NULL DEFAULT '0' COMMENT '兑换最低VIP级别',
  `content` text NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '是否需要填写收货地址,1,实物需要填写地址,0虚拟物品不需要填写地址',
  `dj_link` varchar(255) NOT NULL,
  `wl_link` varchar(255) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiger_jifenbao_hexiao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `dianyanid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '0',
  `nickname` varchar(50) DEFAULT '0',
  `ename` varchar(50) DEFAULT '0',
  `companyname` varchar(200) DEFAULT '0',
  `goodname` varchar(200) DEFAULT '0',
  `goodid` int(11) DEFAULT '0',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiger_jifenbao_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `from_user` varchar(100) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `helpid` int(11) NOT NULL,
  `unionid` varchar(100) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `follow` tinyint(1) NOT NULL DEFAULT '0',
  `headimgurl` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `time` int(13) DEFAULT NULL,
  `enable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiger_jifenbao_paylog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `dwnick` varchar(255) DEFAULT NULL COMMENT '微信用户昵称',
  `dopenid` varchar(255) DEFAULT NULL COMMENT '微信用户openid',
  `dtime` int(11) DEFAULT NULL COMMENT '打款时间',
  `dcredit` int(11) DEFAULT NULL COMMENT '消耗积分',
  `dtotal_amount` int(11) DEFAULT NULL COMMENT '金额，分为单位',
  `dmch_billno` varchar(50) DEFAULT NULL COMMENT '生成的商户订单号',
  `dissuccess` tinyint(1) DEFAULT NULL COMMENT '是否打款成功',
  `dresult` varchar(255) DEFAULT NULL COMMENT '失败提示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiger_jifenbao_poster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `data` text,
  `createtime` varchar(12) DEFAULT NULL,
  `bg` varchar(200) DEFAULT NULL,
  `tzurl` varchar(250) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `doneurl` varchar(200) DEFAULT NULL,
  `tipsurl` varchar(200) DEFAULT NULL,
  `score` int(11) DEFAULT '0',
  `score2` int(11) DEFAULT '0',
  `cscore` int(11) DEFAULT '0',
  `cscore2` int(11) DEFAULT '0',
  `pscore` int(11) DEFAULT '0',
  `pscore2` int(11) DEFAULT '0',
  `scorehb` float DEFAULT '0',
  `cscorehb` float DEFAULT '0',
  `pscorehb` float DEFAULT '0',
  `mbfont` varchar(50) DEFAULT NULL,
  `gid` int(11) DEFAULT '0',
  `kdtype` tinyint(1) NOT NULL DEFAULT '0',
  `kword` varchar(20) DEFAULT NULL,
  `mtips` varchar(200) DEFAULT NULL,
  `sliders` text,
  `slideH` int(11) DEFAULT '0',
  `credit` int(1) DEFAULT '0',
  `winfo1` varchar(200) DEFAULT NULL,
  `winfo2` varchar(200) DEFAULT NULL,
  `winfo3` varchar(200) DEFAULT NULL,
  `sharekg` int(11) DEFAULT '0',
  `sharetitle` varchar(200) DEFAULT NULL,
  `sharegzurl` varchar(200) DEFAULT NULL,
  `sharedesc` varchar(200) DEFAULT NULL,
  `sharethumb` varchar(200) DEFAULT NULL,
  `stitle` text,
  `sthumb` text,
  `sdesc` text,
  `surl` text,
  `questions` text,
  `rid` int(11) DEFAULT '0',
  `rtype` int(1) DEFAULT '0',
  `ftips` text,
  `utips` text,
  `utips2` text,
  `wtips` text,
  `starttime` varchar(12) DEFAULT NULL,
  `endtime` varchar(12) DEFAULT NULL,
  `mbstyle` varchar(50) DEFAULT NULL,
  `mbcolor` varchar(50) DEFAULT NULL,
  `nostarttips` text,
  `endtips` text,
  `grouptips` text,
  `tztype` tinyint(1) NOT NULL DEFAULT '0',
  `groups` text,
  `rscore` int(11) DEFAULT '0',
  `rtips` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiger_jifenbao_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `openid` varchar(200) DEFAULT NULL,
  `score` int(11) DEFAULT '0',
  `surplus` int(11) DEFAULT '0',
  `createtime` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiger_jifenbao_request` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `from_user_realname` varchar(50) NOT NULL,
  `from_user` varchar(50) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `image` varchar(300) DEFAULT '0',
  `realname` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `residedist` varchar(200) NOT NULL,
  `alipay` varchar(200) NOT NULL,
  `note` varchar(200) NOT NULL,
  `goods_id` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` varchar(20) NOT NULL,
  `kuaidi` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiger_jifenbao_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `hbsum` int(1) DEFAULT NULL COMMENT '红包总金额',
  `hbtext` varchar(200) DEFAULT NULL COMMENT '红包兑换结束提示',
  PRIMARY KEY (`id`),
  KEY `idx_weid` (`weid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiger_jifenbao_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '0',
  `from_user` varchar(100) NOT NULL,
  `jqfrom_user` varchar(100) NOT NULL,
  `nickname` varchar(50) DEFAULT '0',
  `avatar` varchar(200) DEFAULT NULL,
  `score` int(11) DEFAULT '0',
  `cscore` int(11) DEFAULT '0',
  `pscore` int(11) DEFAULT '0',
  `pid` int(11) DEFAULT '0',
  `sceneid` int(11) DEFAULT '0',
  `ticketid` varchar(200) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `parentid` int(11) DEFAULT '0',
  `helpid` int(11) DEFAULT '0',
  `follow` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(1) DEFAULT '0',
  `hasdel` int(1) DEFAULT '0',
  `createtime` varchar(50) DEFAULT NULL,
  `updatetime` varchar(50) DEFAULT '0',
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `openid` (`pid`,`openid`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiger_jifenbao_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `ticket` varchar(255) DEFAULT '0',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_tiger_jifenbao_tixianlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `dwnick` varchar(255) DEFAULT NULL COMMENT '微信用户昵称',
  `dopenid` varchar(255) DEFAULT NULL COMMENT '微信用户openid',
  `dtime` int(11) DEFAULT NULL COMMENT '打款时间',
  `dcredit` int(11) DEFAULT NULL COMMENT '消耗积分',
  `dtotal_amount` int(11) DEFAULT NULL COMMENT '金额，分为单位',
  `dmch_billno` varchar(50) DEFAULT NULL COMMENT '生成的商户订单号',
  `dissuccess` tinyint(1) DEFAULT NULL COMMENT '是否打款成功',
  `dresult` varchar(255) DEFAULT NULL COMMENT '失败提示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
");
if(pdo_tableexists('tiger_jifenbao_ad')) {
	if(!pdo_fieldexists('tiger_jifenbao_ad',  'id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_ad')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_ad')) {
	if(!pdo_fieldexists('tiger_jifenbao_ad',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_ad')." ADD `weid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_ad')) {
	if(!pdo_fieldexists('tiger_jifenbao_ad',  'title')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_ad')." ADD `title` varchar(250)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_ad')) {
	if(!pdo_fieldexists('tiger_jifenbao_ad',  'pic')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_ad')." ADD `pic` varchar(250)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_ad')) {
	if(!pdo_fieldexists('tiger_jifenbao_ad',  'url')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_ad')." ADD `url` varchar(250)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_ad')) {
	if(!pdo_fieldexists('tiger_jifenbao_ad',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_ad')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `uniacid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'uid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `uid` int(10) NOT NULL   COMMENT '用户ID';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'bizId')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `bizId` varchar(30) NOT NULL   COMMENT '订单号';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'orderNum')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `orderNum` varchar(255) NOT NULL   COMMENT '兑吧订单号';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'credits')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `credits` int(20) NOT NULL   COMMENT '积分';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'params')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `params` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'type')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `type` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'ip')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `ip` varchar(15) NOT NULL   COMMENT '客户端ip';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'starttimestamp')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `starttimestamp` int(10)    COMMENT '下单时间';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'endtimestamp')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `endtimestamp` int(10)    COMMENT '成功时间';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'waitAudit')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `waitAudit` int(8)   DEFAULT 0 COMMENT '是否审核';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'Audit')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `Audit` int(1)   DEFAULT 0 COMMENT '审核状态';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'actualPrice')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `actualPrice` int(11)   DEFAULT 0 COMMENT '扣除费用';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'description')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `description` varchar(255) NOT NULL   COMMENT '描述';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'facePrice')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `facePrice` int(11)   DEFAULT 0 COMMENT '市场价值';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'itemCode')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `itemCode` varchar(255) NOT NULL   COMMENT '商品编码';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'Audituser')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `Audituser` varchar(255) NOT NULL   COMMENT '审核员';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'status')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `status` int(1)   DEFAULT 0 COMMENT '订单状态';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dborder')) {
	if(!pdo_fieldexists('tiger_jifenbao_dborder',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dborder')." ADD `createtime` int(10)   DEFAULT 0 COMMENT '时间';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `weid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'uid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `uid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `nickname` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `openid` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'orderNum')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `orderNum` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'credits')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `credits` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'params')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `params` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'type')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `type` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'ip')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `ip` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'sign')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `sign` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'timestamp')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `timestamp` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'waitAudit')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `waitAudit` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'actualPrice')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `actualPrice` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'description')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `description` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'paramsTest4')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `paramsTest4` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'facePrice')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `facePrice` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'appKey')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `appKey` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dbrecord')) {
	if(!pdo_fieldexists('tiger_jifenbao_dbrecord',  'status')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dbrecord')." ADD `status` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dianyuan')) {
	if(!pdo_fieldexists('tiger_jifenbao_dianyuan',  'id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dianyuan')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dianyuan')) {
	if(!pdo_fieldexists('tiger_jifenbao_dianyuan',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dianyuan')." ADD `weid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dianyuan')) {
	if(!pdo_fieldexists('tiger_jifenbao_dianyuan',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dianyuan')." ADD `openid` varchar(50)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dianyuan')) {
	if(!pdo_fieldexists('tiger_jifenbao_dianyuan',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dianyuan')." ADD `nickname` varchar(50)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dianyuan')) {
	if(!pdo_fieldexists('tiger_jifenbao_dianyuan',  'ename')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dianyuan')." ADD `ename` varchar(50)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dianyuan')) {
	if(!pdo_fieldexists('tiger_jifenbao_dianyuan',  'tel')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dianyuan')." ADD `tel` varchar(50)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dianyuan')) {
	if(!pdo_fieldexists('tiger_jifenbao_dianyuan',  'password')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dianyuan')." ADD `password` varchar(50)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dianyuan')) {
	if(!pdo_fieldexists('tiger_jifenbao_dianyuan',  'companyname')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dianyuan')." ADD `companyname` varchar(200)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_dianyuan')) {
	if(!pdo_fieldexists('tiger_jifenbao_dianyuan',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_dianyuan')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'goods_id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `goods_id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `weid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'px')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `px` int(10) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'shtype')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `shtype` int(2) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'title')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `title` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'hot')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `hot` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'hotcolor')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `hotcolor` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'leibei')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `leibei` varchar(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'logo')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `logo` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'appurl')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `appurl` varchar(300)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'amount')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `amount` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'day_sum')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `day_sum` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'cardid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `cardid` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'deadline')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `deadline` datetime NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'per_user_limit')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `per_user_limit` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'starttime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `starttime` varchar(12)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'endtime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `endtime` varchar(12)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'cost')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `cost` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'cost_type')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `cost_type` int(11) NOT NULL  DEFAULT 1 COMMENT '1系统积分 2会员积分 4,8等留作扩展';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'price')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `price` decimal(10,2) NOT NULL  DEFAULT 0.10 COMMENT '商品价格';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'vip_require')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `vip_require` int(10) NOT NULL  DEFAULT 0 COMMENT '兑换最低VIP级别';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'content')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `content` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'type')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `type` int(11) NOT NULL  DEFAULT 0 COMMENT '是否需要填写收货地址,1,实物需要填写地址,0虚拟物品不需要填写地址';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'dj_link')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `dj_link` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'wl_link')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `wl_link` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_goods')) {
	if(!pdo_fieldexists('tiger_jifenbao_goods',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_goods')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_hexiao')) {
	if(!pdo_fieldexists('tiger_jifenbao_hexiao',  'id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_hexiao')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_hexiao')) {
	if(!pdo_fieldexists('tiger_jifenbao_hexiao',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_hexiao')." ADD `weid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_hexiao')) {
	if(!pdo_fieldexists('tiger_jifenbao_hexiao',  'dianyanid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_hexiao')." ADD `dianyanid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_hexiao')) {
	if(!pdo_fieldexists('tiger_jifenbao_hexiao',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_hexiao')." ADD `openid` varchar(50)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_hexiao')) {
	if(!pdo_fieldexists('tiger_jifenbao_hexiao',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_hexiao')." ADD `nickname` varchar(50)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_hexiao')) {
	if(!pdo_fieldexists('tiger_jifenbao_hexiao',  'ename')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_hexiao')." ADD `ename` varchar(50)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_hexiao')) {
	if(!pdo_fieldexists('tiger_jifenbao_hexiao',  'companyname')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_hexiao')." ADD `companyname` varchar(200)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_hexiao')) {
	if(!pdo_fieldexists('tiger_jifenbao_hexiao',  'goodname')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_hexiao')." ADD `goodname` varchar(200)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_hexiao')) {
	if(!pdo_fieldexists('tiger_jifenbao_hexiao',  'goodid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_hexiao')." ADD `goodid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_hexiao')) {
	if(!pdo_fieldexists('tiger_jifenbao_hexiao',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_hexiao')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_member')) {
	if(!pdo_fieldexists('tiger_jifenbao_member',  'id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_member')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_member')) {
	if(!pdo_fieldexists('tiger_jifenbao_member',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_member')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_member')) {
	if(!pdo_fieldexists('tiger_jifenbao_member',  'from_user')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_member')." ADD `from_user` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_member')) {
	if(!pdo_fieldexists('tiger_jifenbao_member',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_member')." ADD `openid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_member')) {
	if(!pdo_fieldexists('tiger_jifenbao_member',  'helpid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_member')." ADD `helpid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_member')) {
	if(!pdo_fieldexists('tiger_jifenbao_member',  'unionid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_member')." ADD `unionid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_member')) {
	if(!pdo_fieldexists('tiger_jifenbao_member',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_member')." ADD `nickname` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_member')) {
	if(!pdo_fieldexists('tiger_jifenbao_member',  'sex')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_member')." ADD `sex` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_member')) {
	if(!pdo_fieldexists('tiger_jifenbao_member',  'follow')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_member')." ADD `follow` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_member')) {
	if(!pdo_fieldexists('tiger_jifenbao_member',  'headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_member')." ADD `headimgurl` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_member')) {
	if(!pdo_fieldexists('tiger_jifenbao_member',  'city')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_member')." ADD `city` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_member')) {
	if(!pdo_fieldexists('tiger_jifenbao_member',  'province')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_member')." ADD `province` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_member')) {
	if(!pdo_fieldexists('tiger_jifenbao_member',  'country')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_member')." ADD `country` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_member')) {
	if(!pdo_fieldexists('tiger_jifenbao_member',  'time')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_member')." ADD `time` int(13)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_member')) {
	if(!pdo_fieldexists('tiger_jifenbao_member',  'enable')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_member')." ADD `enable` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_paylog')) {
	if(!pdo_fieldexists('tiger_jifenbao_paylog',  'id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_paylog')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_paylog')) {
	if(!pdo_fieldexists('tiger_jifenbao_paylog',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_paylog')." ADD `uniacid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_paylog')) {
	if(!pdo_fieldexists('tiger_jifenbao_paylog',  'dwnick')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_paylog')." ADD `dwnick` varchar(255)    COMMENT '微信用户昵称';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_paylog')) {
	if(!pdo_fieldexists('tiger_jifenbao_paylog',  'dopenid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_paylog')." ADD `dopenid` varchar(255)    COMMENT '微信用户openid';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_paylog')) {
	if(!pdo_fieldexists('tiger_jifenbao_paylog',  'dtime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_paylog')." ADD `dtime` int(11)    COMMENT '打款时间';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_paylog')) {
	if(!pdo_fieldexists('tiger_jifenbao_paylog',  'dcredit')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_paylog')." ADD `dcredit` int(11)    COMMENT '消耗积分';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_paylog')) {
	if(!pdo_fieldexists('tiger_jifenbao_paylog',  'dtotal_amount')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_paylog')." ADD `dtotal_amount` int(11)    COMMENT '金额，分为单位';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_paylog')) {
	if(!pdo_fieldexists('tiger_jifenbao_paylog',  'dmch_billno')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_paylog')." ADD `dmch_billno` varchar(50)    COMMENT '生成的商户订单号';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_paylog')) {
	if(!pdo_fieldexists('tiger_jifenbao_paylog',  'dissuccess')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_paylog')." ADD `dissuccess` tinyint(1)    COMMENT '是否打款成功';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_paylog')) {
	if(!pdo_fieldexists('tiger_jifenbao_paylog',  'dresult')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_paylog')." ADD `dresult` varchar(255)    COMMENT '失败提示';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `weid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'title')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `title` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'type')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `type` int(1)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'data')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `data` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `createtime` varchar(12)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'bg')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `bg` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'tzurl')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `tzurl` varchar(250)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'city')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `city` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'doneurl')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `doneurl` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'tipsurl')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `tipsurl` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'score')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `score` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'score2')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `score2` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'cscore')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `cscore` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'cscore2')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `cscore2` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'pscore')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `pscore` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'pscore2')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `pscore2` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'scorehb')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `scorehb` float   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'cscorehb')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `cscorehb` float   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'pscorehb')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `pscorehb` float   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'mbfont')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `mbfont` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'gid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `gid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'kdtype')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `kdtype` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'kword')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `kword` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'mtips')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `mtips` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'sliders')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `sliders` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'slideH')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `slideH` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'credit')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `credit` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'winfo1')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `winfo1` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'winfo2')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `winfo2` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'winfo3')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `winfo3` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'sharekg')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `sharekg` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'sharetitle')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `sharetitle` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'sharegzurl')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `sharegzurl` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'sharedesc')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `sharedesc` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'sharethumb')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `sharethumb` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'stitle')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `stitle` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'sthumb')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `sthumb` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'sdesc')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `sdesc` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'surl')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `surl` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'questions')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `questions` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `rid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'rtype')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `rtype` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'ftips')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `ftips` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'utips')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `utips` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'utips2')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `utips2` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'wtips')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `wtips` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'starttime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `starttime` varchar(12)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'endtime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `endtime` varchar(12)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'mbstyle')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `mbstyle` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'mbcolor')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `mbcolor` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'nostarttips')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `nostarttips` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'endtips')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `endtips` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'grouptips')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `grouptips` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'tztype')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `tztype` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'groups')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `groups` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'rscore')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `rscore` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_poster')) {
	if(!pdo_fieldexists('tiger_jifenbao_poster',  'rtips')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_poster')." ADD `rtips` text    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_record')) {
	if(!pdo_fieldexists('tiger_jifenbao_record',  'id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_record')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_record')) {
	if(!pdo_fieldexists('tiger_jifenbao_record',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_record')." ADD `weid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_record')) {
	if(!pdo_fieldexists('tiger_jifenbao_record',  'pid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_record')." ADD `pid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_record')) {
	if(!pdo_fieldexists('tiger_jifenbao_record',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_record')." ADD `openid` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_record')) {
	if(!pdo_fieldexists('tiger_jifenbao_record',  'score')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_record')." ADD `score` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_record')) {
	if(!pdo_fieldexists('tiger_jifenbao_record',  'surplus')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_record')." ADD `surplus` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_record')) {
	if(!pdo_fieldexists('tiger_jifenbao_record',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_record')." ADD `createtime` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `weid` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'from_user_realname')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `from_user_realname` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'from_user')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `from_user` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `openid` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'image')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `image` varchar(300)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'realname')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `realname` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `mobile` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'residedist')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `residedist` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'alipay')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `alipay` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'note')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `note` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'goods_id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `goods_id` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `createtime` int(10) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'cost')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `cost` decimal(10,2) NOT NULL  DEFAULT 0.00 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'price')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `price` decimal(10,2) NOT NULL  DEFAULT 0.00 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'status')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `status` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_request')) {
	if(!pdo_fieldexists('tiger_jifenbao_request',  'kuaidi')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_request')." ADD `kuaidi` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_set')) {
	if(!pdo_fieldexists('tiger_jifenbao_set',  'id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_set')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_set')) {
	if(!pdo_fieldexists('tiger_jifenbao_set',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_set')." ADD `weid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_set')) {
	if(!pdo_fieldexists('tiger_jifenbao_set',  'hbsum')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_set')." ADD `hbsum` int(1)    COMMENT '红包总金额';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_set')) {
	if(!pdo_fieldexists('tiger_jifenbao_set',  'hbtext')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_set')." ADD `hbtext` varchar(200)    COMMENT '红包兑换结束提示';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `weid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `openid` varchar(50)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'from_user')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `from_user` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'jqfrom_user')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `jqfrom_user` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `nickname` varchar(50)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `avatar` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'score')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `score` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'cscore')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `cscore` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'pscore')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `pscore` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'pid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `pid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'sceneid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `sceneid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'ticketid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `ticketid` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'url')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `url` varchar(200)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'parentid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `parentid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'helpid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `helpid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'follow')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `follow` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'status')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `status` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'hasdel')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `hasdel` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `createtime` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'updatetime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `updatetime` varchar(50)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'province')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `province` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_share')) {
	if(!pdo_fieldexists('tiger_jifenbao_share',  'city')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_share')." ADD `city` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_ticket')) {
	if(!pdo_fieldexists('tiger_jifenbao_ticket',  'id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_ticket')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_ticket')) {
	if(!pdo_fieldexists('tiger_jifenbao_ticket',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_ticket')." ADD `weid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_ticket')) {
	if(!pdo_fieldexists('tiger_jifenbao_ticket',  'ticket')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_ticket')." ADD `ticket` varchar(255)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_ticket')) {
	if(!pdo_fieldexists('tiger_jifenbao_ticket',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_ticket')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_tixianlog')) {
	if(!pdo_fieldexists('tiger_jifenbao_tixianlog',  'id')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_tixianlog')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_tixianlog')) {
	if(!pdo_fieldexists('tiger_jifenbao_tixianlog',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_tixianlog')." ADD `uniacid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_tixianlog')) {
	if(!pdo_fieldexists('tiger_jifenbao_tixianlog',  'dwnick')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_tixianlog')." ADD `dwnick` varchar(255)    COMMENT '微信用户昵称';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_tixianlog')) {
	if(!pdo_fieldexists('tiger_jifenbao_tixianlog',  'dopenid')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_tixianlog')." ADD `dopenid` varchar(255)    COMMENT '微信用户openid';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_tixianlog')) {
	if(!pdo_fieldexists('tiger_jifenbao_tixianlog',  'dtime')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_tixianlog')." ADD `dtime` int(11)    COMMENT '打款时间';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_tixianlog')) {
	if(!pdo_fieldexists('tiger_jifenbao_tixianlog',  'dcredit')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_tixianlog')." ADD `dcredit` int(11)    COMMENT '消耗积分';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_tixianlog')) {
	if(!pdo_fieldexists('tiger_jifenbao_tixianlog',  'dtotal_amount')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_tixianlog')." ADD `dtotal_amount` int(11)    COMMENT '金额，分为单位';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_tixianlog')) {
	if(!pdo_fieldexists('tiger_jifenbao_tixianlog',  'dmch_billno')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_tixianlog')." ADD `dmch_billno` varchar(50)    COMMENT '生成的商户订单号';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_tixianlog')) {
	if(!pdo_fieldexists('tiger_jifenbao_tixianlog',  'dissuccess')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_tixianlog')." ADD `dissuccess` tinyint(1)    COMMENT '是否打款成功';");
	}	
}
if(pdo_tableexists('tiger_jifenbao_tixianlog')) {
	if(!pdo_fieldexists('tiger_jifenbao_tixianlog',  'dresult')) {
		pdo_query("ALTER TABLE ".tablename('tiger_jifenbao_tixianlog')." ADD `dresult` varchar(255)    COMMENT '失败提示';");
	}	
}
