<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_dayu_yuyue` (
  `reid` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(1000) NOT NULL,
  `content` text NOT NULL,
  `information` varchar(500) NOT NULL DEFAULT '',
  `thumb` varchar(200) NOT NULL DEFAULT '',
  `inhome` tinyint(4) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `starttime` int(10) NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `pretotal` int(10) unsigned NOT NULL DEFAULT '1',
  `accountsid` varchar(50) NOT NULL DEFAULT '',
  `tokenid` varchar(50) NOT NULL DEFAULT '',
  `appId` varchar(50) NOT NULL DEFAULT '',
  `templateId` varchar(50) NOT NULL DEFAULT '',
  `m_templateid` varchar(50) NOT NULL,
  `pay` int(11) NOT NULL DEFAULT '1' COMMENT '支付开关',
  `kaishi` int(11) NOT NULL DEFAULT '1',
  `jieshu` int(11) NOT NULL DEFAULT '22',
  `tianshu` int(11) NOT NULL DEFAULT '15',
  `xmshow` int(11) NOT NULL DEFAULT '0' COMMENT '项目显示方式',
  `xmname` varchar(50) NOT NULL DEFAULT '',
  `yuyuename` varchar(50) NOT NULL DEFAULT '',
  `kfirst` varchar(100) NOT NULL DEFAULT '',
  `kfoot` varchar(100) NOT NULL DEFAULT '',
  `mfirst` varchar(100) NOT NULL DEFAULT '',
  `mfoot` varchar(100) NOT NULL DEFAULT '',
  `share_url` varchar(100) NOT NULL DEFAULT '',
  `follow` tinyint(1) DEFAULT '0',
  `shangmen` tinyint(1) DEFAULT '0',
  `stime` int(2) NOT NULL,
  `etime` int(2) NOT NULL,
  `eday` int(2) NOT NULL,
  `card` tinyint(1) DEFAULT '0',
  `instore` tinyint(1) DEFAULT '0',
  `zhicheng` varchar(50) NOT NULL DEFAULT '',
  `mname` varchar(50) NOT NULL DEFAULT '',
  `skins` varchar(20) NOT NULL DEFAULT 'submit',
  PRIMARY KEY (`reid`),
  KEY `weid` (`weid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dayu_yuyue_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`weid`),
  KEY `indx_enabled` (`enabled`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dayu_yuyue_jishi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `telephone` varchar(20) NOT NULL DEFAULT '',
  `noticeemail` varchar(50) NOT NULL DEFAULT '',
  `content` varchar(1000) NOT NULL DEFAULT '',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `isshow` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `weid` (`weid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dayu_yuyue_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member` varchar(50) NOT NULL DEFAULT '',
  `mobile` varchar(50) NOT NULL DEFAULT '',
  `add` varchar(250) NOT NULL DEFAULT '',
  `weid` int(11) unsigned NOT NULL,
  `yid` int(11) NOT NULL,
  `xmid` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `jsid` int(11) NOT NULL,
  `yystarttime` int(10) NOT NULL DEFAULT '0',
  `yyendtime` int(10) unsigned NOT NULL,
  `yyfs` tinyint(1) NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `beizhu` text NOT NULL,
  `createtime` int(10) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL COMMENT '预约状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dayu_yuyue_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `reid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dayu_yuyue_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `reid` int(11) NOT NULL,
  `accountsid` varchar(50) NOT NULL DEFAULT '',
  `tokenid` varchar(50) NOT NULL DEFAULT '',
  `appId` varchar(50) NOT NULL DEFAULT '',
  `templateId` varchar(50) NOT NULL DEFAULT '',
  `k_templateid` varchar(50) NOT NULL DEFAULT '',
  `m_templateId` varchar(50) NOT NULL DEFAULT '',
  `kfid` varchar(50) NOT NULL DEFAULT '',
  `kfirst` varchar(100) NOT NULL COMMENT '客服模板页头',
  `kfoot` varchar(100) NOT NULL COMMENT '客服模板页尾',
  `mfirst` varchar(100) NOT NULL COMMENT '客户模板页头',
  `mfoot` varchar(100) NOT NULL COMMENT '客户模板页尾',
  `follow` tinyint(1) DEFAULT '0',
  `instore` tinyint(1) DEFAULT '0',
  `share_url` varchar(100) NOT NULL DEFAULT '',
  `card` tinyint(1) DEFAULT '0',
  `shangmen` tinyint(1) DEFAULT '0',
  `zhicheng` varchar(50) NOT NULL DEFAULT '',
  `xmname` varchar(50) NOT NULL DEFAULT '',
  `yuyuename` varchar(50) NOT NULL DEFAULT '',
  `mname` varchar(50) NOT NULL DEFAULT '',
  `skins` varchar(20) NOT NULL DEFAULT 'submit',
  `stime` int(2) NOT NULL,
  `etime` int(2) NOT NULL,
  `eday` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `weid` (`weid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dayu_yuyue_store` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `qq` varchar(15) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `dist` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `lng` varchar(10) NOT NULL,
  `lat` varchar(10) NOT NULL,
  `industry1` varchar(10) NOT NULL,
  `industry2` varchar(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_lat_lng` (`lng`,`lat`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_dayu_yuyue_xiangmu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `isshow` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `weid` (`weid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
";
pdo_run($sql);
if(!pdo_fieldexists('dayu_yuyue',  'reid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `reid` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dayu_yuyue',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue',  'title')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `title` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'description')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `description` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue',  'content')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `content` text NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue',  'information')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `information` varchar(500) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `thumb` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'inhome')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `inhome` tinyint(4) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `createtime` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `starttime` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `endtime` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue',  'status')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `status` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue',  'pretotal')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `pretotal` int(10) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('dayu_yuyue',  'accountsid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `accountsid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'tokenid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `tokenid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'appId')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `appId` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'templateId')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `templateId` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'm_templateid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `m_templateid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue',  'pay')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `pay` int(11) NOT NULL DEFAULT '1' COMMENT '支付开关';");
}
if(!pdo_fieldexists('dayu_yuyue',  'kaishi')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `kaishi` int(11) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('dayu_yuyue',  'jieshu')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `jieshu` int(11) NOT NULL DEFAULT '22';");
}
if(!pdo_fieldexists('dayu_yuyue',  'tianshu')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `tianshu` int(11) NOT NULL DEFAULT '15';");
}
if(!pdo_fieldexists('dayu_yuyue',  'xmshow')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `xmshow` int(11) NOT NULL DEFAULT '0' COMMENT '项目显示方式';");
}
if(!pdo_fieldexists('dayu_yuyue',  'xmname')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `xmname` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'yuyuename')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `yuyuename` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'kfirst')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `kfirst` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'kfoot')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `kfoot` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'mfirst')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `mfirst` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'mfoot')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `mfoot` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'share_url')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `share_url` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'follow')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `follow` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue',  'shangmen')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `shangmen` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue',  'stime')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `stime` int(2) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue',  'etime')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `etime` int(2) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue',  'eday')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `eday` int(2) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue',  'card')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `card` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue',  'instore')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `instore` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue',  'zhicheng')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `zhicheng` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'mname')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `mname` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue',  'skins')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD `skins` varchar(20) NOT NULL DEFAULT 'submit';");
}
if(!pdo_indexexists('dayu_yuyue',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue')." ADD KEY `weid` (`weid`);");
}
if(!pdo_fieldexists('dayu_yuyue_adv',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_adv')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dayu_yuyue_adv',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_adv')." ADD `weid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue_adv',  'advname')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_adv')." ADD `advname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_adv',  'link')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_adv')." ADD `link` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_adv',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_adv')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_adv',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_adv')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue_adv',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_adv')." ADD `enabled` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('dayu_yuyue_adv',  'indx_weid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_adv')." ADD KEY `indx_weid` (`weid`);");
}
if(!pdo_indexexists('dayu_yuyue_adv',  'indx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_adv')." ADD KEY `indx_enabled` (`enabled`);");
}
if(!pdo_indexexists('dayu_yuyue_adv',  'indx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_adv')." ADD KEY `indx_displayorder` (`displayorder`);");
}
if(!pdo_fieldexists('dayu_yuyue_jishi',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_jishi')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dayu_yuyue_jishi',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_jishi')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_jishi',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_jishi')." ADD `oid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_jishi',  'name')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_jishi')." ADD `name` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_jishi',  'telephone')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_jishi')." ADD `telephone` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_jishi',  'noticeemail')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_jishi')." ADD `noticeemail` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_jishi',  'content')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_jishi')." ADD `content` varchar(1000) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_jishi',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_jishi')." ADD `displayorder` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue_jishi',  'isshow')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_jishi')." ADD `isshow` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('dayu_yuyue_jishi',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_jishi')." ADD KEY `weid` (`weid`);");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'member')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `member` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `mobile` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'add')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `add` varchar(250) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `weid` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'yid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `yid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'xmid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `xmid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'oid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `oid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'jsid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `jsid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'yystarttime')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `yystarttime` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'yyendtime')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `yyendtime` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'yyfs')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `yyfs` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'beizhu')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `beizhu` text NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `createtime` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue_record',  'status')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_record')." ADD `status` tinyint(1) NOT NULL COMMENT '预约状态';");
}
if(!pdo_fieldexists('dayu_yuyue_reply',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_reply')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dayu_yuyue_reply',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_reply')." ADD `rid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_reply',  'reid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_reply')." ADD `reid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'reid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `reid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'accountsid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `accountsid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'tokenid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `tokenid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'appId')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `appId` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'templateId')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `templateId` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'k_templateid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `k_templateid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'm_templateId')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `m_templateId` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'kfid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `kfid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'kfirst')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `kfirst` varchar(100) NOT NULL COMMENT '客服模板页头';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'kfoot')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `kfoot` varchar(100) NOT NULL COMMENT '客服模板页尾';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'mfirst')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `mfirst` varchar(100) NOT NULL COMMENT '客户模板页头';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'mfoot')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `mfoot` varchar(100) NOT NULL COMMENT '客户模板页尾';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'follow')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `follow` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'instore')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `instore` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'share_url')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `share_url` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'card')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `card` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'shangmen')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `shangmen` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'zhicheng')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `zhicheng` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'xmname')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `xmname` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'yuyuename')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `yuyuename` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'mname')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `mname` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'skins')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `skins` varchar(20) NOT NULL DEFAULT 'submit';");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'stime')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `stime` int(2) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'etime')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `etime` int(2) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_setting',  'eday')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD `eday` int(2) NOT NULL;");
}
if(!pdo_indexexists('dayu_yuyue_setting',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_setting')." ADD KEY `weid` (`weid`);");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `weid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'name')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `name` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'content')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `content` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'phone')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `phone` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'qq')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `qq` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'province')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `province` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'city')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `city` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'dist')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `dist` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'address')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `address` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'lng')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `lng` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'lat')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `lat` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'industry1')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `industry1` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'industry2')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `industry2` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_store',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_indexexists('dayu_yuyue_store',  'idx_lat_lng')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_store')." ADD KEY `idx_lat_lng` (`lng`,`lat`);");
}
if(!pdo_fieldexists('dayu_yuyue_xiangmu',  'id')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_xiangmu')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('dayu_yuyue_xiangmu',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_xiangmu')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('dayu_yuyue_xiangmu',  'title')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_xiangmu')." ADD `title` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('dayu_yuyue_xiangmu',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_xiangmu')." ADD `displayorder` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('dayu_yuyue_xiangmu',  'isshow')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_xiangmu')." ADD `isshow` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('dayu_yuyue_xiangmu',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('dayu_yuyue_xiangmu')." ADD KEY `weid` (`weid`);");
}

?>