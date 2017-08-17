<?php
pdo_query(
"DROP TABLE IF EXISTS `ims_truein_jiandu_ad`;

CREATE TABLE `ims_truein_jiandu_ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  `thumb` varchar(500) NOT NULL DEFAULT '',
  `share_num` int(10) DEFAULT '0' COMMENT '分享文章数',
  `weid` int(10) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL COMMENT '广告描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ims_truein_jiandu_logs` */

DROP TABLE IF EXISTS `ims_truein_jiandu_logs`;

CREATE TABLE `ims_truein_jiandu_logs` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `share_id` varchar(50) DEFAULT NULL COMMENT '分享记录id',
  `read_user` varchar(100) DEFAULT NULL COMMENT '阅读者openid',
  `headimgurl` varchar(200) DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `datetime` varchar(50) DEFAULT NULL COMMENT '阅读时间',
  `read` int(5) DEFAULT '0' COMMENT '是否阅读',
  `click` int(5) DEFAULT '0' COMMENT '是否点击',
  `share` int(5) DEFAULT '0' COMMENT '是否分享',
  `from_ip` varchar(50) DEFAULT NULL COMMENT '来源ip',
  `from_os` varchar(100) DEFAULT NULL COMMENT '来源操作系统',
  `from_container` varchar(100) DEFAULT NULL COMMENT '来源机型',
  `from_openid` varchar(200) DEFAULT NULL COMMENT '来源openid',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=430 DEFAULT CHARSET=utf8;

/*Table structure for table `ims_truein_jiandu_medies` */

DROP TABLE IF EXISTS `ims_truein_jiandu_medies`;

CREATE TABLE `ims_truein_jiandu_medies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `content` text,
  `share_desc` varchar(255) DEFAULT NULL COMMENT '分享摘要',
  `share_image` varchar(255) DEFAULT NULL COMMENT '分享图片',
  `datetime` varchar(50) DEFAULT NULL COMMENT '添加时间',
  `status` tinyint(2) DEFAULT '1' COMMENT '1正常 0禁止分享',
  `default_read` int(10) DEFAULT '0' COMMENT '默认阅读数',
  `default_praise` int(10) DEFAULT '0' COMMENT '默认点赞数',
  `tousu` int(5) DEFAULT '0' COMMENT '投诉人次',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

/*Table structure for table `ims_truein_jiandu_reply` */

DROP TABLE IF EXISTS `ims_truein_jiandu_reply`;

CREATE TABLE `ims_truein_jiandu_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `rid` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `starttime` int(10) NOT NULL DEFAULT '0',
  `endtime` int(10) NOT NULL DEFAULT '0',
  `aid` int(10) DEFAULT NULL COMMENT '编号',
  `appid` varchar(250) DEFAULT NULL COMMENT 'appid',
  `secret` varchar(250) DEFAULT NULL COMMENT 'secret',
  `needfollow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '强制关注',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `cover` varchar(255) DEFAULT NULL COMMENT '封面',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `weid` int(10) DEFAULT NULL,
  `gift` text COMMENT '奖励规则',
  `help` text COMMENT '帮助文档',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `ims_truein_jiandu_share` */

DROP TABLE IF EXISTS `ims_truein_jiandu_share`;

CREATE TABLE `ims_truein_jiandu_share` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `staffid` int(10) DEFAULT NULL COMMENT '用户id',
  `rid` int(10) DEFAULT NULL COMMENT '活动id',
  `uniacid` int(10) DEFAULT NULL COMMENT '公众号id',
  `mediaid` int(10) DEFAULT NULL COMMENT '文章id',
  `adid` int(10) DEFAULT NULL COMMENT '广告id',
  `sharecount` int(10) DEFAULT '0' COMMENT '分享次数',
  `readcount` int(10) DEFAULT '1' COMMENT '阅读数',
  `click` int(10) DEFAULT '0' COMMENT '广告点击数',
  `status` tinyint(2) DEFAULT '1',
  `datetime` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

/*Table structure for table `ims_truein_jiandu_staff` */

DROP TABLE IF EXISTS `ims_truein_jiandu_staff`;

CREATE TABLE `ims_truein_jiandu_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '' COMMENT '用户ID',
  `nickname` varchar(50) DEFAULT '',
  `headimgurl` varchar(500) DEFAULT '',
  `username` varchar(50) DEFAULT '',
  `mobile` varchar(50) DEFAULT '',
  `address` varchar(200) DEFAULT '',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '性别',
  `country` varchar(50) DEFAULT '',
  `province` varchar(50) DEFAULT '',
  `city` varchar(50) DEFAULT '',
  `qrcode` varchar(500) DEFAULT '',
  `is_vip` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1' COMMENT '是否禁用 0为禁用',
  `datetime` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;"
);
if(pdo_tableexists('ims_truein_jiandu_ad')) {
	if(!pdo_fieldexists('ims_truein_jiandu_ad',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_ad')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_ad')) {
	if(!pdo_fieldexists('ims_truein_jiandu_ad',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_ad')." ADD `uniacid` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_ad')) {
	if(!pdo_fieldexists('ims_truein_jiandu_ad',  'title')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_ad')." ADD `title` varchar(100) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_ad')) {
	if(!pdo_fieldexists('ims_truein_jiandu_ad',  'url')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_ad')." ADD `url` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_ad')) {
	if(!pdo_fieldexists('ims_truein_jiandu_ad',  'thumb')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_ad')." ADD `thumb` varchar(500) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_ad')) {
	if(!pdo_fieldexists('ims_truein_jiandu_ad',  'share_num')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_ad')." ADD `share_num` int(10) DEFAULT '0' COMMENT '分享文章数';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_ad')) {
	if(!pdo_fieldexists('ims_truein_jiandu_ad',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_ad')." ADD `weid` int(10) DEFAULT NULL;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_ad')) {
	if(!pdo_fieldexists('ims_truein_jiandu_ad',  'description')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_ad')." ADD `description` varchar(1000) DEFAULT NULL COMMENT '广告描述';");
	}	
}

if(pdo_tableexists('ims_truein_jiandu_logs')) {
	if(!pdo_fieldexists('ims_truein_jiandu_logs',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_logs')." ADD `id` int(15) NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_logs')) {
	if(!pdo_fieldexists('ims_truein_jiandu_logs',  'share_id')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_logs')." ADD `share_id` varchar(50) DEFAULT NULL COMMENT '分享记录id';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_logs')) {
	if(!pdo_fieldexists('ims_truein_jiandu_logs',  'read_user')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_logs')." ADD `read_user` varchar(100) DEFAULT NULL COMMENT '阅读者openid';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_logs')) {
	if(!pdo_fieldexists('ims_truein_jiandu_logs',  'headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_logs')." ADD `headimgurl` varchar(200) DEFAULT NULL;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_logs')) {
	if(!pdo_fieldexists('ims_truein_jiandu_logs',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_logs')." ADD `nickname` varchar(100) DEFAULT NULL;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_logs')) {
	if(!pdo_fieldexists('ims_truein_jiandu_logs',  'sex')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_logs')." ADD `sex` tinyint(1) DEFAULT NULL;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_logs')) {
	if(!pdo_fieldexists('ims_truein_jiandu_logs',  'datetime')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_logs')." ADD `datetime` tinyint(1) DEFAULT NULL;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_logs')) {
	if(!pdo_fieldexists('ims_truein_jiandu_logs',  'read')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_logs')." ADD `read` int(5) DEFAULT '0' COMMENT '是否阅读';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_logs')) {
	if(!pdo_fieldexists('ims_truein_jiandu_logs',  'click')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_logs')." ADD `click` int(5) DEFAULT '0' COMMENT '是否点击';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_logs')) {
	if(!pdo_fieldexists('ims_truein_jiandu_logs',  'share')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_logs')." ADD `share` int(5) DEFAULT '0' COMMENT '是否分享';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_logs')) {
	if(!pdo_fieldexists('ims_truein_jiandu_logs',  'from_ip')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_logs')." ADD `from_ip` int(5) varchar(50) DEFAULT NULL COMMENT '来源ip';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_logs')) {
	if(!pdo_fieldexists('ims_truein_jiandu_logs',  'from_os')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_logs')." ADD `from_os` varchar(100) DEFAULT NULL COMMENT '来源操作系统';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_logs')) {
	if(!pdo_fieldexists('ims_truein_jiandu_logs',  'from_container')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_logs')." ADD `from_container` varchar(100) DEFAULT NULL COMMENT '来源机型';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_logs')) {
	if(!pdo_fieldexists('ims_truein_jiandu_logs',  'from_openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_logs')." ADD `from_openid` varchar(200) DEFAULT NULL COMMENT '来源openid';");
	}	
}

if(pdo_tableexists('ims_truein_jiandu_medies')) {
	if(!pdo_fieldexists('ims_truein_jiandu_medies',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_medies')." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_medies')) {
	if(!pdo_fieldexists('ims_truein_jiandu_medies',  'title')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_medies')." ADD `title` varchar(255) DEFAULT NULL;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_medies')) {
	if(!pdo_fieldexists('ims_truein_jiandu_medies',  'url')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_medies')." ADD `url` varchar(1000) DEFAULT NULL;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_medies')) {
	if(!pdo_fieldexists('ims_truein_jiandu_medies',  'content')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_medies')." ADD `content` text;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_medies')) {
	if(!pdo_fieldexists('ims_truein_jiandu_medies',  'share_desc')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_medies')." ADD `share_desc` varchar(255) DEFAULT NULL COMMENT '分享摘要';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_medies')) {
	if(!pdo_fieldexists('ims_truein_jiandu_medies',  'share_image')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_medies')." ADD `share_image` varchar(255) DEFAULT NULL COMMENT '分享图片';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_medies')) {
	if(!pdo_fieldexists('ims_truein_jiandu_medies',  'datetime')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_medies')." ADD `datetime` varchar(50) DEFAULT NULL COMMENT '添加时间';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_medies')) {
	if(!pdo_fieldexists('ims_truein_jiandu_medies',  'status')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_medies')." ADD `status` tinyint(2) DEFAULT '1' COMMENT '1正常 0禁止分享';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_medies')) {
	if(!pdo_fieldexists('ims_truein_jiandu_medies',  'default_read')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_medies')." ADD `default_read` int(10) DEFAULT '0' COMMENT '默认阅读数';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_medies')) {
	if(!pdo_fieldexists('ims_truein_jiandu_medies',  'default_praise')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_medies')." ADD `default_praise` int(10) DEFAULT '0' COMMENT '默认阅读数';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_medies')) {
	if(!pdo_fieldexists('ims_truein_jiandu_medies',  'tousu')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_medies')." ADD `tousu` int(5) DEFAULT '0' COMMENT '投诉人次';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'uid')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `uid` int(11) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `rid` int(10) unsigned NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'status')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `status` tinyint(1) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'starttime')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `starttime` int(10) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'endtime')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `endtime` int(10) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'aid')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `aid` int(10) DEFAULT NULL COMMENT '编号';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'appid')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `appid` varchar(250) DEFAULT NULL COMMENT 'appid';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'secret')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `secret` varchar(250) DEFAULT NULL COMMENT 'secret';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'needfollow')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `needfollow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '强制关注';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'title')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `title` varchar(255) DEFAULT NULL COMMENT '标题';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'cover')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `cover` varchar(255) DEFAULT NULL COMMENT '封面';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'description')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `description` varchar(255) DEFAULT NULL COMMENT '描述';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `weid` int(10) DEFAULT NULL;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'gift')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `gift` text COMMENT '奖励规则';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_reply')) {
	if(!pdo_fieldexists('ims_truein_jiandu_reply',  'help')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_reply')." ADD `help` text COMMENT '帮助文档';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_share')) {
	if(!pdo_fieldexists('ims_truein_jiandu_share',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_share')." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_share')) {
	if(!pdo_fieldexists('ims_truein_jiandu_share',  'staffid')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_share')." ADD `staffid` int(10) DEFAULT NULL COMMENT '用户id';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_share')) {
	if(!pdo_fieldexists('ims_truein_jiandu_share',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_share')." ADD `rid` int(10) DEFAULT NULL COMMENT '活动id';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_share')) {
	if(!pdo_fieldexists('ims_truein_jiandu_share',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_share')." ADD `uniacid` int(10) DEFAULT NULL COMMENT '公众号id';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_share')) {
	if(!pdo_fieldexists('ims_truein_jiandu_share',  'mediaid')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_share')." ADD `mediaid` int(10) DEFAULT NULL COMMENT '文章id';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_share')) {
	if(!pdo_fieldexists('ims_truein_jiandu_share',  'adid')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_share')." ADD `adid` int(10) DEFAULT NULL COMMENT '广告id';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_share')) {
	if(!pdo_fieldexists('ims_truein_jiandu_share',  'sharecount')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_share')." ADD `sharecount` int(10) DEFAULT '0' COMMENT '分享次数';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_share')) {
	if(!pdo_fieldexists('ims_truein_jiandu_share',  'readcount')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_share')." ADD `readcount` int(10) DEFAULT '1' COMMENT '阅读数';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_share')) {
	if(!pdo_fieldexists('ims_truein_jiandu_share',  'click')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_share')." ADD `click` int(10) DEFAULT '0' COMMENT '广告点击数';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_share')) {
	if(!pdo_fieldexists('ims_truein_jiandu_share',  'status')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_share')." ADD `status` tinyint(2) DEFAULT '1';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_share')) {
	if(!pdo_fieldexists('ims_truein_jiandu_share',  'datetime')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_share')." ADD `datetime` varchar(50) DEFAULT NULL,;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `uniacid` int(11) DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `openid` varchar(50) DEFAULT '' COMMENT '用户ID';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `nickname` varchar(50) DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `headimgurl` varchar(500) DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'username')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `username` varchar(50) DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `mobile` varchar(50) DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'address')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `address` varchar(200) DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'sex')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `sex` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '性别';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'country')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `country` varchar(50) DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'province')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `province` varchar(50) DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'city')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `city` varchar(50) DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'qrcode')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `qrcode` varchar(500) DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'is_vip')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `is_vip` tinyint(1) DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'status')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `status` tinyint(1) DEFAULT '1' COMMENT '是否禁用 0为禁用';");
	}	
}
if(pdo_tableexists('ims_truein_jiandu_staff')) {
	if(!pdo_fieldexists('ims_truein_jiandu_staff',  'datetime')) {
		pdo_query("ALTER TABLE ".tablename('ims_truein_jiandu_staff')." ADD `datetime` varchar(20) DEFAULT NULL;");
	}	
}