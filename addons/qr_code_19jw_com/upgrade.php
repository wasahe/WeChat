<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_qr_code_19jw_com_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `rid` int(11) DEFAULT '0',
  `typeid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `number` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `giveuptime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_qr_code_19jw_com_fans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `rid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `nickname` varchar(255) DEFAULT '' COMMENT '昵称',
  `headimgurl` varchar(255) DEFAULT '' COMMENT '头像',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态 -1 黑名单 0 正常',
  `suc` int(11) DEFAULT '0' COMMENT '取号次数',
  `past` int(11) DEFAULT '0' COMMENT '过号次数',
  `cancel` int(11) DEFAULT '0' COMMENT '取消次数',
  `createtime` int(11) DEFAULT '0' COMMENT '提交时间',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_rid` (`rid`),
  KEY `idx_status` (`status`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_qr_code_19jw_com_manager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `username` varchar(100) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_qr_code_19jw_com_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `rid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `description` varchar(255) DEFAULT '',
  `thumb` varchar(200) DEFAULT '',
  `heading` varchar(255) DEFAULT '',
  `smallheading` varchar(255) DEFAULT '',
  `tel` varchar(255) DEFAULT '',
  `followurl` varchar(255) DEFAULT '',
  `intro` text,
  `status` tinyint(1) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `num` int(11) DEFAULT '0',
  `beforenum` int(11) DEFAULT '0',
  `screenbg` varchar(255) DEFAULT '',
  `qrcode` varchar(1000) DEFAULT '',
  `qrcodetype` tinyint(3) DEFAULT '0',
  `templateid` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_rid` (`rid`),
  KEY `idx_status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_qr_code_19jw_com_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `rid` int(11) DEFAULT '0',
  `tag` varchar(255) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `num` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_rid` (`rid`),
  KEY `idx_status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
pdo_run($sql);
if(!pdo_fieldexists('qr_code_19jw_com_data',  'id')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_data')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('qr_code_19jw_com_data',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_data')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_data',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_data')." ADD `rid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_data',  'typeid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_data')." ADD `typeid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_data',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_data')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('qr_code_19jw_com_data',  'number')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_data')." ADD `number` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_data',  'status')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_data')." ADD `status` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_data',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_data')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_data',  'giveuptime')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_data')." ADD `giveuptime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('qr_code_19jw_com_data',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_data')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('qr_code_19jw_com_data',  'idx_rid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_data')." ADD KEY `idx_rid` (`rid`);");
}
if(!pdo_fieldexists('qr_code_19jw_com_fans',  'id')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_fans')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('qr_code_19jw_com_fans',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_fans')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_fans',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_fans')." ADD `rid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_fans',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_fans')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('qr_code_19jw_com_fans',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_fans')." ADD `nickname` varchar(255) DEFAULT '' COMMENT '昵称';");
}
if(!pdo_fieldexists('qr_code_19jw_com_fans',  'headimgurl')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_fans')." ADD `headimgurl` varchar(255) DEFAULT '' COMMENT '头像';");
}
if(!pdo_fieldexists('qr_code_19jw_com_fans',  'status')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_fans')." ADD `status` tinyint(1) DEFAULT '0' COMMENT '状态 -1 黑名单 0 正常';");
}
if(!pdo_fieldexists('qr_code_19jw_com_fans',  'suc')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_fans')." ADD `suc` int(11) DEFAULT '0' COMMENT '取号次数';");
}
if(!pdo_fieldexists('qr_code_19jw_com_fans',  'past')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_fans')." ADD `past` int(11) DEFAULT '0' COMMENT '过号次数';");
}
if(!pdo_fieldexists('qr_code_19jw_com_fans',  'cancel')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_fans')." ADD `cancel` int(11) DEFAULT '0' COMMENT '取消次数';");
}
if(!pdo_fieldexists('qr_code_19jw_com_fans',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_fans')." ADD `createtime` int(11) DEFAULT '0' COMMENT '提交时间';");
}
if(!pdo_indexexists('qr_code_19jw_com_fans',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_fans')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('qr_code_19jw_com_fans',  'idx_rid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_fans')." ADD KEY `idx_rid` (`rid`);");
}
if(!pdo_indexexists('qr_code_19jw_com_fans',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_fans')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('qr_code_19jw_com_fans',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_fans')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_fieldexists('qr_code_19jw_com_manager',  'id')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_manager')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('qr_code_19jw_com_manager',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_manager')." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('qr_code_19jw_com_manager',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_manager')." ADD `rid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('qr_code_19jw_com_manager',  'username')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_manager')." ADD `username` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('qr_code_19jw_com_manager',  'pwd')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_manager')." ADD `pwd` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('qr_code_19jw_com_manager',  'status')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_manager')." ADD `status` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('qr_code_19jw_com_manager',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_manager')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('qr_code_19jw_com_manager',  'idx_rid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_manager')." ADD KEY `idx_rid` (`rid`);");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'id')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `rid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'title')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'description')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `description` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `thumb` varchar(200) DEFAULT '';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'heading')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `heading` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'smallheading')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `smallheading` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'tel')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `tel` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'followurl')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `followurl` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'intro')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `intro` text;");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'status')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'num')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `num` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'beforenum')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `beforenum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'screenbg')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `screenbg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'qrcode')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `qrcode` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'qrcodetype')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `qrcodetype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_reply',  'templateid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD `templateid` varchar(255) DEFAULT '';");
}
if(!pdo_indexexists('qr_code_19jw_com_reply',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('qr_code_19jw_com_reply',  'idx_rid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD KEY `idx_rid` (`rid`);");
}
if(!pdo_indexexists('qr_code_19jw_com_reply',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_reply')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists('qr_code_19jw_com_type',  'id')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_type')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('qr_code_19jw_com_type',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_type')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_type',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_type')." ADD `rid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_type',  'tag')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_type')." ADD `tag` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('qr_code_19jw_com_type',  'title')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_type')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('qr_code_19jw_com_type',  'num')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_type')." ADD `num` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('qr_code_19jw_com_type',  'status')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_type')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_indexexists('qr_code_19jw_com_type',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_type')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('qr_code_19jw_com_type',  'idx_rid')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_type')." ADD KEY `idx_rid` (`rid`);");
}
if(!pdo_indexexists('qr_code_19jw_com_type',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('qr_code_19jw_com_type')." ADD KEY `idx_status` (`status`);");
}

?>