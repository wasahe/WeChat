<?php

$sql =<<<EOF
CREATE TABLE IF NOT EXISTS `ims_hc_deluxejjr_acmanager` (
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
EOF;
pdo_run($sql);
