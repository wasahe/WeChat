<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_ruifan_qiyeyewu_ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned DEFAULT '0',
  `uniacid` int(11) DEFAULT '0',
  `type` tinyint(1) DEFAULT '0',
  `adtitle` varchar(250) DEFAULT '' COMMENT '广告标题',
  `adimg` varchar(250) DEFAULT '' COMMENT '广告图片',
  `adurl` varchar(250) DEFAULT '0' COMMENT '广告链接',
  `status` tinyint(2) DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
CREATE TABLE IF NOT EXISTS `ims_ruifan_qiyeyewu_award` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `rid` int(11) DEFAULT '0',
  `fansID` int(11) DEFAULT '0',
  `from_user` varchar(50) DEFAULT '0' COMMENT '用户ID',
  `from_user2` varchar(50) DEFAULT '0' COMMENT '非认证服务号借用获取的ID',
  `fname` varchar(20) DEFAULT '' COMMENT '登记信息(姓名等)',
  `tel` varchar(20) DEFAULT '' COMMENT '登记信息(手机等)',
  `faddr` varchar(300) DEFAULT '' COMMENT '登记信息(地址等)',
  `avatar` varchar(512) NOT NULL DEFAULT '' COMMENT '微信头像',
  `todaycredit` int(11) DEFAULT '0' COMMENT '已兑换积分数',
  `sharenum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分享得积分数量',
  `spname` varchar(250) DEFAULT '' COMMENT '商品名称',
  `sp_integrals` int(11) DEFAULT '0' COMMENT '商品兑换积分数',
  `states` tinyint(4) DEFAULT '0' COMMENT '商品状态',
  `prizetype` varchar(250) DEFAULT '' COMMENT '类型',
  `createtime` int(10) DEFAULT '0',
  `consumetime` int(10) DEFAULT '0',
  `giscredt` tinyint(2) DEFAULT '0',
  `gcredit` decimal(11,2) DEFAULT '0.00',
  `ticket` varchar(255) DEFAULT '' COMMENT '微信卡券',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
CREATE TABLE IF NOT EXISTS `ims_ruifan_qiyeyewu_cs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned DEFAULT '0' COMMENT '规则id',
  `uniacid` int(11) DEFAULT '0' COMMENT '公众号id',
  `share_type` tinyint(1) DEFAULT '0',
  `guanzhu_txt` varchar(300) DEFAULT '',
  `guanzhu_img` varchar(250) DEFAULT '' COMMENT '关注二维码',
  `share_title` varchar(200) DEFAULT '',
  `share_desc` varchar(1000) DEFAULT '',
  `share_img` varchar(300) DEFAULT '',
  `btm_adtype` tinyint(1) DEFAULT '0' COMMENT '底部广告类型',
  `share_top` int(11) DEFAULT '0' COMMENT '转发赠送上限',
  `share_num` int(11) DEFAULT '0' COMMENT '分享赠送的积分数',
  `top_adtitle` varchar(250) DEFAULT '' COMMENT '头部广告标题',
  `top_adimg` varchar(250) DEFAULT '' COMMENT '头部广告图片',
  `top_adurl` varchar(250) DEFAULT '0' COMMENT '头部广告链接',
  `btm_adtitle` varchar(250) DEFAULT '' COMMENT '底部广告标题',
  `btm_adimg` varchar(250) DEFAULT '' COMMENT '底部广告图片',
  `btm_adurl` varchar(250) DEFAULT '0' COMMENT '底部广告链接',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
CREATE TABLE IF NOT EXISTS `ims_ruifan_qiyeyewu_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则id',
  `uniacid` int(10) unsigned NOT NULL COMMENT '公众号ID',
  `from_user` varchar(50) NOT NULL DEFAULT '' COMMENT '用户openid',
  `fromuser` varchar(50) NOT NULL DEFAULT '' COMMENT '分享人openid',
  `avatar` varchar(512) NOT NULL DEFAULT '' COMMENT '微信头像',
  `nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '微信昵称',
  `visitorsip` varchar(15) NOT NULL DEFAULT '' COMMENT '访问IP',
  `visitorstime` int(10) unsigned NOT NULL COMMENT '访问时间',
  `sharecreditnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分享得积分数量',
  `sharecutnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '好友帮忙砍了多少元',
  `viewnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '查看次数',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`),
  KEY `indx_from_user` (`from_user`),
  KEY `indx_fromuser` (`fromuser`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
CREATE TABLE IF NOT EXISTS `ims_ruifan_qiyeyewu_fans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) DEFAULT '0',
  `fansID` int(11) DEFAULT '0',
  `from_user` varchar(50) DEFAULT '' COMMENT '用户ID',
  `tel` varchar(20) DEFAULT '' COMMENT '登记信息(手机等)',
  `fname` varchar(20) DEFAULT '' COMMENT '登记信息(姓名等)',
  `fqq` varchar(20) DEFAULT '' COMMENT '登记信息(QQ等)',
  `femail` varchar(50) DEFAULT '' COMMENT '是否兑奖过了',
  `faddr` varchar(300) DEFAULT '' COMMENT '登记信息(地址等)',
  `todaynum` int(11) DEFAULT '0',
  `todaycredit` int(11) DEFAULT '0' COMMENT '已兑换积分数',
  `avatar` varchar(512) NOT NULL DEFAULT '' COMMENT '微信头像',
  `totalnum` int(11) DEFAULT '0',
  `creditnum` int(11) DEFAULT '0',
  `awardnum` int(11) DEFAULT '0',
  `last_time` int(10) DEFAULT '0',
  `createtime` int(10) DEFAULT '0',
  `minad` tinyint(1) DEFAULT '0' COMMENT '首次广告',
  `sharenum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分享得积分数量',
  `cutnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '拉黑状态',
  `sharetime` int(10) DEFAULT '0' COMMENT '最后分享时间',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_from_user` (`from_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
CREATE TABLE IF NOT EXISTS `ims_ruifan_qiyeyewu_jd` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned DEFAULT '0' COMMENT '规则id',
  `uniacid` int(11) DEFAULT '0' COMMENT '公众号id',
  `companyname` varchar(250) DEFAULT '' COMMENT '公司名称',
  `number` int(10) DEFAULT '0' COMMENT '模板编号',
  `name` varchar(250) DEFAULT '' COMMENT '模板名称',
  `type` int(10) DEFAULT '0' COMMENT '操作类型',
  `typename` varchar(50) DEFAULT '' COMMENT '操作类型名称',
  `sequence` int(10) DEFAULT '0' COMMENT '排序',
  `lcname` varchar(250) DEFAULT '' COMMENT '流程名称',
  `state` varchar(50) DEFAULT '0' COMMENT '状态（是否完成）',
  `status` tinyint(2) DEFAULT '0' COMMENT '状态（是否启用）',
  `endtime` int(11) DEFAULT '0' COMMENT '完成时间',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`),
  KEY `indx_number` (`number`),
  KEY `indx_companyname` (`companyname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
CREATE TABLE IF NOT EXISTS `ims_ruifan_qiyeyewu_lc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned DEFAULT '0' COMMENT '规则id',
  `uniacid` int(11) DEFAULT '0' COMMENT '公众号id',
  `number` int(10) DEFAULT '0' COMMENT '模板编号',
  `name` varchar(250) DEFAULT '' COMMENT '模板名称',
  `type` int(10) DEFAULT '0' COMMENT '业务类型',
  `typename` varchar(50) DEFAULT '' COMMENT '业务类型名称',
  `sequence` int(10) DEFAULT '0' COMMENT '排序',
  `lcname` varchar(250) DEFAULT '' COMMENT '流程名称',
  `state` tinyint(2) DEFAULT '0' COMMENT '状态（是否完成）',
  `status` tinyint(2) DEFAULT '0' COMMENT '状态（是否启用）',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`),
  KEY `indx_number` (`number`),
  KEY `indx_status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
CREATE TABLE IF NOT EXISTS `ims_ruifan_qiyeyewu_sp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned DEFAULT '0',
  `uniacid` int(11) DEFAULT '0',
  `sp_img` varchar(250) DEFAULT '' COMMENT '商品图片',
  `sp_title` varchar(250) DEFAULT '' COMMENT '商品名称',
  `sp_url` varchar(250) DEFAULT '' COMMENT '商品链接',
  `sp_numbers` int(11) DEFAULT '0' COMMENT '商品数量',
  `status` tinyint(2) DEFAULT '0' COMMENT '状态（是否启用）',
  `sp_integrals` int(11) DEFAULT '0' COMMENT '商品兑换积分数',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
CREATE TABLE IF NOT EXISTS `ims_ruifan_qiyeyewu_sysset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `appid` varchar(255) DEFAULT '',
  `appsecret` varchar(255) DEFAULT '',
  `appid_share` varchar(255) DEFAULT '',
  `appsecret_share` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
CREATE TABLE IF NOT EXISTS `ims_ruifan_qiyeyewu_template` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned DEFAULT '0' COMMENT '规则id',
  `uniacid` int(11) DEFAULT '0' COMMENT '公众号id',
  `number` int(10) DEFAULT '0' COMMENT '模板编号',
  `name` varchar(250) DEFAULT '' COMMENT '模板名称',
  `type` int(10) DEFAULT '0' COMMENT '业务类型',
  `typename` varchar(50) DEFAULT '' COMMENT '业务类型名称',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`),
  KEY `indx_number` (`number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
CREATE TABLE IF NOT EXISTS `ims_ruifan_qiyeyewu_yw` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned DEFAULT '0' COMMENT '规则id',
  `uniacid` int(11) DEFAULT '0' COMMENT '公众号id',
  `lxname` varchar(250) DEFAULT '' COMMENT '业务类型名称',
  `status` tinyint(2) DEFAULT '0' COMMENT '状态（是否启用）',
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
";
pdo_run($sql);
if(!pdo_fieldexists('ruifan_qiyeyewu_ad',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_ad')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_ad',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_ad')." ADD `rid` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_ad',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_ad')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_ad',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_ad')." ADD `type` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_ad',  'adtitle')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_ad')." ADD `adtitle` varchar(250) DEFAULT '' COMMENT '广告标题';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_ad',  'adimg')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_ad')." ADD `adimg` varchar(250) DEFAULT '' COMMENT '广告图片';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_ad',  'adurl')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_ad')." ADD `adurl` varchar(250) DEFAULT '0' COMMENT '广告链接';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_ad',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_ad')." ADD `status` tinyint(2) DEFAULT '0' COMMENT '状态';");
}
if(!pdo_indexexists('ruifan_qiyeyewu_ad',  'indx_rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_ad')." ADD KEY `indx_rid` (`rid`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_ad',  'indx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_ad')." ADD KEY `indx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `rid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'fansID')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `fansID` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'from_user')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `from_user` varchar(50) DEFAULT '0' COMMENT '用户ID';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'from_user2')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `from_user2` varchar(50) DEFAULT '0' COMMENT '非认证服务号借用获取的ID';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'fname')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `fname` varchar(20) DEFAULT '' COMMENT '登记信息(姓名等)';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'tel')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `tel` varchar(20) DEFAULT '' COMMENT '登记信息(手机等)';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'faddr')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `faddr` varchar(300) DEFAULT '' COMMENT '登记信息(地址等)';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `avatar` varchar(512) NOT NULL DEFAULT '' COMMENT '微信头像';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'todaycredit')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `todaycredit` int(11) DEFAULT '0' COMMENT '已兑换积分数';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'sharenum')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `sharenum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分享得积分数量';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'spname')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `spname` varchar(250) DEFAULT '' COMMENT '商品名称';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'sp_integrals')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `sp_integrals` int(11) DEFAULT '0' COMMENT '商品兑换积分数';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'states')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `states` tinyint(4) DEFAULT '0' COMMENT '商品状态';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'prizetype')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `prizetype` varchar(250) DEFAULT '' COMMENT '类型';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `createtime` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'consumetime')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `consumetime` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'giscredt')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `giscredt` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'gcredit')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `gcredit` decimal(11,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_award',  'ticket')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD `ticket` varchar(255) DEFAULT '' COMMENT '微信卡券';");
}
if(!pdo_indexexists('ruifan_qiyeyewu_award',  'indx_rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD KEY `indx_rid` (`rid`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_award',  'indx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_award')." ADD KEY `indx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `rid` int(10) unsigned DEFAULT '0' COMMENT '规则id';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `uniacid` int(11) DEFAULT '0' COMMENT '公众号id';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'share_type')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `share_type` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'guanzhu_txt')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `guanzhu_txt` varchar(300) DEFAULT '';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'guanzhu_img')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `guanzhu_img` varchar(250) DEFAULT '' COMMENT '关注二维码';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'share_title')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `share_title` varchar(200) DEFAULT '';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'share_desc')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `share_desc` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'share_img')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `share_img` varchar(300) DEFAULT '';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'btm_adtype')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `btm_adtype` tinyint(1) DEFAULT '0' COMMENT '底部广告类型';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'share_top')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `share_top` int(11) DEFAULT '0' COMMENT '转发赠送上限';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'share_num')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `share_num` int(11) DEFAULT '0' COMMENT '分享赠送的积分数';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'top_adtitle')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `top_adtitle` varchar(250) DEFAULT '' COMMENT '头部广告标题';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'top_adimg')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `top_adimg` varchar(250) DEFAULT '' COMMENT '头部广告图片';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'top_adurl')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `top_adurl` varchar(250) DEFAULT '0' COMMENT '头部广告链接';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'btm_adtitle')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `btm_adtitle` varchar(250) DEFAULT '' COMMENT '底部广告标题';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'btm_adimg')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `btm_adimg` varchar(250) DEFAULT '' COMMENT '底部广告图片';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_cs',  'btm_adurl')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD `btm_adurl` varchar(250) DEFAULT '0' COMMENT '底部广告链接';");
}
if(!pdo_indexexists('ruifan_qiyeyewu_cs',  'indx_rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD KEY `indx_rid` (`rid`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_cs',  'indx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_cs')." ADD KEY `indx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_data',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_data',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则id';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_data',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD `uniacid` int(10) unsigned NOT NULL COMMENT '公众号ID';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_data',  'from_user')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD `from_user` varchar(50) NOT NULL DEFAULT '' COMMENT '用户openid';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_data',  'fromuser')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD `fromuser` varchar(50) NOT NULL DEFAULT '' COMMENT '分享人openid';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_data',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD `avatar` varchar(512) NOT NULL DEFAULT '' COMMENT '微信头像';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_data',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD `nickname` varchar(50) NOT NULL DEFAULT '' COMMENT '微信昵称';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_data',  'visitorsip')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD `visitorsip` varchar(15) NOT NULL DEFAULT '' COMMENT '访问IP';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_data',  'visitorstime')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD `visitorstime` int(10) unsigned NOT NULL COMMENT '访问时间';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_data',  'sharecreditnum')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD `sharecreditnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分享得积分数量';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_data',  'sharecutnum')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD `sharecutnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '好友帮忙砍了多少元';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_data',  'viewnum')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD `viewnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '查看次数';");
}
if(!pdo_indexexists('ruifan_qiyeyewu_data',  'indx_rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD KEY `indx_rid` (`rid`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_data',  'indx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD KEY `indx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_data',  'indx_from_user')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD KEY `indx_from_user` (`from_user`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_data',  'indx_fromuser')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_data')." ADD KEY `indx_fromuser` (`fromuser`);");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `rid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'fansID')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `fansID` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'from_user')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `from_user` varchar(50) DEFAULT '' COMMENT '用户ID';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'tel')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `tel` varchar(20) DEFAULT '' COMMENT '登记信息(手机等)';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'fname')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `fname` varchar(20) DEFAULT '' COMMENT '登记信息(姓名等)';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'fqq')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `fqq` varchar(20) DEFAULT '' COMMENT '登记信息(QQ等)';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'femail')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `femail` varchar(50) DEFAULT '' COMMENT '是否兑奖过了';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'faddr')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `faddr` varchar(300) DEFAULT '' COMMENT '登记信息(地址等)';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'todaynum')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `todaynum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'todaycredit')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `todaycredit` int(11) DEFAULT '0' COMMENT '已兑换积分数';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `avatar` varchar(512) NOT NULL DEFAULT '' COMMENT '微信头像';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'totalnum')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `totalnum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'creditnum')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `creditnum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'awardnum')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `awardnum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'last_time')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `last_time` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `createtime` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'minad')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `minad` tinyint(1) DEFAULT '0' COMMENT '首次广告';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'sharenum')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `sharenum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分享得积分数量';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'cutnum')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `cutnum` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '拉黑状态';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_fans',  'sharetime')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD `sharetime` int(10) DEFAULT '0' COMMENT '最后分享时间';");
}
if(!pdo_indexexists('ruifan_qiyeyewu_fans',  'indx_rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD KEY `indx_rid` (`rid`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_fans',  'indx_from_user')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_fans')." ADD KEY `indx_from_user` (`from_user`);");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_jd',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_jd',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD `rid` int(10) unsigned DEFAULT '0' COMMENT '规则id';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_jd',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD `uniacid` int(11) DEFAULT '0' COMMENT '公众号id';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_jd',  'companyname')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD `companyname` varchar(250) DEFAULT '' COMMENT '公司名称';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_jd',  'number')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD `number` int(10) DEFAULT '0' COMMENT '模板编号';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_jd',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD `name` varchar(250) DEFAULT '' COMMENT '模板名称';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_jd',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD `type` int(10) DEFAULT '0' COMMENT '操作类型';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_jd',  'typename')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD `typename` varchar(50) DEFAULT '' COMMENT '操作类型名称';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_jd',  'sequence')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD `sequence` int(10) DEFAULT '0' COMMENT '排序';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_jd',  'lcname')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD `lcname` varchar(250) DEFAULT '' COMMENT '流程名称';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_jd',  'state')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD `state` varchar(50) DEFAULT '0' COMMENT '状态（是否完成）';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_jd',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD `status` tinyint(2) DEFAULT '0' COMMENT '状态（是否启用）';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_jd',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD `endtime` int(11) DEFAULT '0' COMMENT '完成时间';");
}
if(!pdo_indexexists('ruifan_qiyeyewu_jd',  'indx_rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD KEY `indx_rid` (`rid`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_jd',  'indx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD KEY `indx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_jd',  'indx_number')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD KEY `indx_number` (`number`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_jd',  'indx_companyname')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_jd')." ADD KEY `indx_companyname` (`companyname`);");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_lc',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_lc')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_lc',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_lc')." ADD `rid` int(10) unsigned DEFAULT '0' COMMENT '规则id';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_lc',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_lc')." ADD `uniacid` int(11) DEFAULT '0' COMMENT '公众号id';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_lc',  'number')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_lc')." ADD `number` int(10) DEFAULT '0' COMMENT '模板编号';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_lc',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_lc')." ADD `name` varchar(250) DEFAULT '' COMMENT '模板名称';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_lc',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_lc')." ADD `type` int(10) DEFAULT '0' COMMENT '业务类型';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_lc',  'typename')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_lc')." ADD `typename` varchar(50) DEFAULT '' COMMENT '业务类型名称';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_lc',  'sequence')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_lc')." ADD `sequence` int(10) DEFAULT '0' COMMENT '排序';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_lc',  'lcname')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_lc')." ADD `lcname` varchar(250) DEFAULT '' COMMENT '流程名称';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_lc',  'state')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_lc')." ADD `state` tinyint(2) DEFAULT '0' COMMENT '状态（是否完成）';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_lc',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_lc')." ADD `status` tinyint(2) DEFAULT '0' COMMENT '状态（是否启用）';");
}
if(!pdo_indexexists('ruifan_qiyeyewu_lc',  'indx_rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_lc')." ADD KEY `indx_rid` (`rid`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_lc',  'indx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_lc')." ADD KEY `indx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_lc',  'indx_number')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_lc')." ADD KEY `indx_number` (`number`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_lc',  'indx_status')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_lc')." ADD KEY `indx_status` (`status`);");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_sp',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sp')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_sp',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sp')." ADD `rid` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_sp',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sp')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_sp',  'sp_img')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sp')." ADD `sp_img` varchar(250) DEFAULT '' COMMENT '商品图片';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_sp',  'sp_title')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sp')." ADD `sp_title` varchar(250) DEFAULT '' COMMENT '商品名称';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_sp',  'sp_url')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sp')." ADD `sp_url` varchar(250) DEFAULT '' COMMENT '商品链接';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_sp',  'sp_numbers')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sp')." ADD `sp_numbers` int(11) DEFAULT '0' COMMENT '商品数量';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_sp',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sp')." ADD `status` tinyint(2) DEFAULT '0' COMMENT '状态（是否启用）';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_sp',  'sp_integrals')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sp')." ADD `sp_integrals` int(11) DEFAULT '0' COMMENT '商品兑换积分数';");
}
if(!pdo_indexexists('ruifan_qiyeyewu_sp',  'indx_rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sp')." ADD KEY `indx_rid` (`rid`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_sp',  'indx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sp')." ADD KEY `indx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_sysset',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sysset')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_sysset',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sysset')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_sysset',  'appid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sysset')." ADD `appid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_sysset',  'appsecret')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sysset')." ADD `appsecret` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_sysset',  'appid_share')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sysset')." ADD `appid_share` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_sysset',  'appsecret_share')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sysset')." ADD `appsecret_share` varchar(255) DEFAULT '';");
}
if(!pdo_indexexists('ruifan_qiyeyewu_sysset',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_sysset')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_template',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_template')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_template',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_template')." ADD `rid` int(10) unsigned DEFAULT '0' COMMENT '规则id';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_template',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_template')." ADD `uniacid` int(11) DEFAULT '0' COMMENT '公众号id';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_template',  'number')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_template')." ADD `number` int(10) DEFAULT '0' COMMENT '模板编号';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_template',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_template')." ADD `name` varchar(250) DEFAULT '' COMMENT '模板名称';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_template',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_template')." ADD `type` int(10) DEFAULT '0' COMMENT '业务类型';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_template',  'typename')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_template')." ADD `typename` varchar(50) DEFAULT '' COMMENT '业务类型名称';");
}
if(!pdo_indexexists('ruifan_qiyeyewu_template',  'indx_rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_template')." ADD KEY `indx_rid` (`rid`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_template',  'indx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_template')." ADD KEY `indx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_template',  'indx_number')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_template')." ADD KEY `indx_number` (`number`);");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_yw',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_yw')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_yw',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_yw')." ADD `rid` int(10) unsigned DEFAULT '0' COMMENT '规则id';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_yw',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_yw')." ADD `uniacid` int(11) DEFAULT '0' COMMENT '公众号id';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_yw',  'lxname')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_yw')." ADD `lxname` varchar(250) DEFAULT '' COMMENT '业务类型名称';");
}
if(!pdo_fieldexists('ruifan_qiyeyewu_yw',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_yw')." ADD `status` tinyint(2) DEFAULT '0' COMMENT '状态（是否启用）';");
}
if(!pdo_indexexists('ruifan_qiyeyewu_yw',  'indx_rid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_yw')." ADD KEY `indx_rid` (`rid`);");
}
if(!pdo_indexexists('ruifan_qiyeyewu_yw',  'indx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ruifan_qiyeyewu_yw')." ADD KEY `indx_uniacid` (`uniacid`);");
}

?>