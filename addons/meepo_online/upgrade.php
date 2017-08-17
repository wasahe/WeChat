<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_meepo_footer_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `icon` varchar(50) NOT NULL COMMENT '分类名称',
  `isshow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示',
  `url` varchar(300) NOT NULL,
  `displayorder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_my_live` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `openid` varchar(200) NOT NULL COMMENT '粉丝标识',
  `mobile` varchar(12) NOT NULL COMMENT 'mobile',
  `listid` int(10) NOT NULL COMMENT '直播id',
  `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_adv` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `title` varchar(100) NOT NULL COMMENT '幻灯片标题',
  `displayorder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `isshow` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '显示',
  `img` varchar(300) NOT NULL COMMENT '幻灯片',
  `url` varchar(300) NOT NULL COMMENT '幻灯片链接',
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `title` varchar(50) NOT NULL COMMENT '分类名称',
  `isshow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示',
  `no_img` varchar(300) NOT NULL,
  `displayorder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_dayu_sms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `appkey` varchar(200) NOT NULL COMMENT 'appkey',
  `appsecret` varchar(200) NOT NULL COMMENT 'appsecret',
  `sms_signname` varchar(100) NOT NULL COMMENT 'sms_signname',
  `sms_tpl_id` varchar(100) NOT NULL COMMENT 'sms_tpl_id',
  `sms_success_tpl_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_dayu_sms_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `openid` varchar(200) NOT NULL COMMENT 'appkey',
  `listid` int(10) NOT NULL COMMENT '直播id',
  `sms_code` varchar(10) NOT NULL COMMENT 'sms_signname',
  `createtime` int(11) NOT NULL COMMENT 'sms_tpl_id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `activity_id` varchar(100) NOT NULL,
  `cansay` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `shake_bg_img` varchar(300) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `no_start_type` tinyint(1) NOT NULL DEFAULT '3',
  `title` varchar(100) NOT NULL,
  `activity_vu` varchar(100) NOT NULL,
  `activity_uu` varchar(100) NOT NULL,
  `activity_pu` varchar(100) NOT NULL,
  `live_advs` text NOT NULL,
  `open_img` varchar(300) NOT NULL,
  `open_img_url` varchar(300) NOT NULL,
  `djs_txt_color` varchar(20) NOT NULL DEFAULT '#ffffff',
  `yt_iframe` varchar(1000) NOT NULL,
  `local_media` varchar(300) NOT NULL,
  `no_start_activity_id` varchar(100) NOT NULL,
  `no_start_activity_vu` varchar(100) NOT NULL,
  `no_start_activity_uu` varchar(100) NOT NULL,
  `no_start_activity_pu` varchar(100) NOT NULL,
  `no_start_yt_iframe` varchar(1000) NOT NULL,
  `no_start_local_media` varchar(300) NOT NULL,
  `no_start_advs` text NOT NULL,
  `end_activity_id` varchar(100) NOT NULL,
  `end_activity_vu` varchar(100) NOT NULL,
  `end_activity_uu` varchar(100) NOT NULL,
  `end_activity_pu` varchar(100) NOT NULL,
  `end_yt_iframe` varchar(1000) NOT NULL,
  `end_local_media` varchar(300) NOT NULL,
  `end_advs` text NOT NULL,
  `thumb_time` int(10) NOT NULL DEFAULT '5',
  `marqueen_words` varchar(1000) NOT NULL,
  `img` varchar(300) NOT NULL,
  `main_color` varchar(300) NOT NULL DEFAULT '#ff6a00',
  `description` longtext NOT NULL,
  `isshow` int(11) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `zan_style` tinyint(1) NOT NULL,
  `zan` int(11) NOT NULL,
  `pinglun` int(11) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `is_best` tinyint(1) NOT NULL DEFAULT '0',
  `live_logo` varchar(300) NOT NULL,
  `top_bj` varchar(300) NOT NULL,
  `share_title` varchar(300) NOT NULL,
  `share_content` varchar(300) NOT NULL,
  `share_img` varchar(300) NOT NULL,
  `advs` text NOT NULL,
  `content` text NOT NULL,
  `award_tpl` varchar(300) NOT NULL,
  `consumer_tpl` varchar(300) NOT NULL,
  `award_customer_img` varchar(300) NOT NULL,
  `yuyue_tpl` varchar(300) NOT NULL,
  `yuyue_customer_img` varchar(300) NOT NULL,
  `consumer_customer_img` varchar(300) NOT NULL,
  `dashang_show` tinyint(1) NOT NULL,
  `gift_show` tinyint(1) NOT NULL,
  `dashang_limit` varchar(20) NOT NULL DEFAULT '1',
  `dashang_flower` tinyint(1) NOT NULL DEFAULT '1',
  `gift_flower` tinyint(1) NOT NULL DEFAULT '1',
  `newjoin_flower` tinyint(1) NOT NULL DEFAULT '1',
  `dashang_music` varchar(300) NOT NULL DEFAULT '0',
  `gift_music` varchar(300) NOT NULL DEFAULT '0',
  `newjoin_music` varchar(300) NOT NULL,
  `live_persons` int(11) NOT NULL,
  `shake_show` tinyint(1) NOT NULL,
  `shake_must_address` tinyint(1) NOT NULL,
  `player_height` int(11) NOT NULL DEFAULT '180',
  `createtime` int(11) NOT NULL,
  `need_pay` tinyint(1) NOT NULL DEFAULT '0',
  `pay_money` varchar(100) NOT NULL DEFAULT '0',
  `look_code` varchar(100) NOT NULL,
  `look_type` tinyint(1) NOT NULL DEFAULT '0',
  `end_type` tinyint(1) NOT NULL COMMENT '规则',
  `yuyue_show` tinyint(1) NOT NULL DEFAULT '1',
  `sms_mobile` tinyint(1) NOT NULL DEFAULT '1',
  `put_mobile` tinyint(1) NOT NULL DEFAULT '1',
  `gift_pay_detail` tinyint(1) NOT NULL DEFAULT '1',
  `rtmp` varchar(500) NOT NULL DEFAULT '0',
  `hls` varchar(500) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_list_gift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `money` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(300) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_list_live_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `content` text NOT NULL,
  `imgs` text NOT NULL,
  `audio` text NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_list_live_news_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `newsid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `nickname` varchar(300) NOT NULL,
  `content` text NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_list_live_news_zan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `newsid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `nickname` varchar(300) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_list_lookcode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `openid` varchar(200) NOT NULL COMMENT '粉丝标识',
  `listid` int(10) NOT NULL COMMENT '直播id',
  `code` varchar(15) NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_list_lookpay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `openid` varchar(200) NOT NULL COMMENT '粉丝标识',
  `listid` int(10) NOT NULL COMMENT '直播id',
  `money` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支付',
  `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_list_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `isshow` tinyint(1) NOT NULL,
  `type` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `settings` text NOT NULL,
  `displayorder` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_list_need_input` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `placeholder` varchar(300) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_list_shake_award` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `listid` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `had_get_num` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(300) NOT NULL,
  `gailv` int(11) NOT NULL DEFAULT '0',
  `get_url` varchar(300) NOT NULL,
  `get_way` tinyint(1) NOT NULL DEFAULT '1',
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_list_shake_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `award_id` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_list_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `nickname` varchar(200) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_list_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `oauth_openid` varchar(100) NOT NULL,
  `nickname` varchar(200) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `cansay` tinyint(1) NOT NULL DEFAULT '0',
  `categoryid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `realname` varchar(200) NOT NULL DEFAULT '0',
  `mobile` varchar(20) NOT NULL DEFAULT '0',
  `father_id` int(11) NOT NULL DEFAULT '0',
  `address` varchar(500) NOT NULL DEFAULT '0',
  `need_info` text NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_list_zan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `nickname` varchar(200) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_pinglun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `nickname` varchar(200) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `type` varchar(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `money` varchar(100) NOT NULL,
  `num` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `settings` text NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_online_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `realname` varchar(200) NOT NULL DEFAULT '0',
  `address` varchar(500) NOT NULL DEFAULT '0',
  `mobile` varchar(20) NOT NULL DEFAULT '0',
  `createtime` int(11) NOT NULL,
  `newjointime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
pdo_run($sql);
if(!pdo_fieldexists('meepo_footer_menu',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_footer_menu')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_footer_menu',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_footer_menu')." ADD `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号';");
}
if(!pdo_fieldexists('meepo_footer_menu',  'name')) {
	pdo_query("ALTER TABLE ".tablename('meepo_footer_menu')." ADD `name` varchar(50) NOT NULL COMMENT '分类名称';");
}
if(!pdo_fieldexists('meepo_footer_menu',  'icon')) {
	pdo_query("ALTER TABLE ".tablename('meepo_footer_menu')." ADD `icon` varchar(50) NOT NULL COMMENT '分类名称';");
}
if(!pdo_fieldexists('meepo_footer_menu',  'isshow')) {
	pdo_query("ALTER TABLE ".tablename('meepo_footer_menu')." ADD `isshow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示';");
}
if(!pdo_fieldexists('meepo_footer_menu',  'url')) {
	pdo_query("ALTER TABLE ".tablename('meepo_footer_menu')." ADD `url` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_footer_menu',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('meepo_footer_menu')." ADD `displayorder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序';");
}
if(!pdo_fieldexists('meepo_my_live',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_my_live')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_my_live',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_my_live')." ADD `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号';");
}
if(!pdo_fieldexists('meepo_my_live',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_my_live')." ADD `openid` varchar(200) NOT NULL COMMENT '粉丝标识';");
}
if(!pdo_fieldexists('meepo_my_live',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('meepo_my_live')." ADD `mobile` varchar(12) NOT NULL COMMENT 'mobile';");
}
if(!pdo_fieldexists('meepo_my_live',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_my_live')." ADD `listid` int(10) NOT NULL COMMENT '直播id';");
}
if(!pdo_fieldexists('meepo_my_live',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_my_live')." ADD `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示';");
}
if(!pdo_fieldexists('meepo_online_adv',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_adv')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_adv',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_adv')." ADD `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号';");
}
if(!pdo_fieldexists('meepo_online_adv',  'title')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_adv')." ADD `title` varchar(100) NOT NULL COMMENT '幻灯片标题';");
}
if(!pdo_fieldexists('meepo_online_adv',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_adv')." ADD `displayorder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序';");
}
if(!pdo_fieldexists('meepo_online_adv',  'isshow')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_adv')." ADD `isshow` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '显示';");
}
if(!pdo_fieldexists('meepo_online_adv',  'img')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_adv')." ADD `img` varchar(300) NOT NULL COMMENT '幻灯片';");
}
if(!pdo_fieldexists('meepo_online_adv',  'url')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_adv')." ADD `url` varchar(300) NOT NULL COMMENT '幻灯片链接';");
}
if(!pdo_fieldexists('meepo_online_adv',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_adv')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_category')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_category',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_category')." ADD `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号';");
}
if(!pdo_fieldexists('meepo_online_category',  'title')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_category')." ADD `title` varchar(50) NOT NULL COMMENT '分类名称';");
}
if(!pdo_fieldexists('meepo_online_category',  'isshow')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_category')." ADD `isshow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示';");
}
if(!pdo_fieldexists('meepo_online_category',  'no_img')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_category')." ADD `no_img` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_category')." ADD `displayorder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序';");
}
if(!pdo_fieldexists('meepo_online_category',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_category')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_dayu_sms',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_dayu_sms')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_dayu_sms',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_dayu_sms')." ADD `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号';");
}
if(!pdo_fieldexists('meepo_online_dayu_sms',  'appkey')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_dayu_sms')." ADD `appkey` varchar(200) NOT NULL COMMENT 'appkey';");
}
if(!pdo_fieldexists('meepo_online_dayu_sms',  'appsecret')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_dayu_sms')." ADD `appsecret` varchar(200) NOT NULL COMMENT 'appsecret';");
}
if(!pdo_fieldexists('meepo_online_dayu_sms',  'sms_signname')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_dayu_sms')." ADD `sms_signname` varchar(100) NOT NULL COMMENT 'sms_signname';");
}
if(!pdo_fieldexists('meepo_online_dayu_sms',  'sms_tpl_id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_dayu_sms')." ADD `sms_tpl_id` varchar(100) NOT NULL COMMENT 'sms_tpl_id';");
}
if(!pdo_fieldexists('meepo_online_dayu_sms',  'sms_success_tpl_id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_dayu_sms')." ADD `sms_success_tpl_id` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_dayu_sms_record',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_dayu_sms_record')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_dayu_sms_record',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_dayu_sms_record')." ADD `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号';");
}
if(!pdo_fieldexists('meepo_online_dayu_sms_record',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_dayu_sms_record')." ADD `openid` varchar(200) NOT NULL COMMENT 'appkey';");
}
if(!pdo_fieldexists('meepo_online_dayu_sms_record',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_dayu_sms_record')." ADD `listid` int(10) NOT NULL COMMENT '直播id';");
}
if(!pdo_fieldexists('meepo_online_dayu_sms_record',  'sms_code')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_dayu_sms_record')." ADD `sms_code` varchar(10) NOT NULL COMMENT 'sms_signname';");
}
if(!pdo_fieldexists('meepo_online_dayu_sms_record',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_dayu_sms_record')." ADD `createtime` int(11) NOT NULL COMMENT 'sms_tpl_id';");
}
if(!pdo_fieldexists('meepo_online_list',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_list',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'categoryid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `categoryid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'activity_id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `activity_id` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'cansay')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `cansay` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'status')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `status` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'shake_bg_img')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `shake_bg_img` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'type')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `type` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'no_start_type')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `no_start_type` tinyint(1) NOT NULL DEFAULT '3';");
}
if(!pdo_fieldexists('meepo_online_list',  'title')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `title` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'activity_vu')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `activity_vu` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'activity_uu')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `activity_uu` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'activity_pu')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `activity_pu` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'live_advs')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `live_advs` text NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'open_img')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `open_img` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'open_img_url')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `open_img_url` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'djs_txt_color')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `djs_txt_color` varchar(20) NOT NULL DEFAULT '#ffffff';");
}
if(!pdo_fieldexists('meepo_online_list',  'yt_iframe')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `yt_iframe` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'local_media')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `local_media` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'no_start_activity_id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `no_start_activity_id` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'no_start_activity_vu')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `no_start_activity_vu` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'no_start_activity_uu')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `no_start_activity_uu` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'no_start_activity_pu')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `no_start_activity_pu` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'no_start_yt_iframe')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `no_start_yt_iframe` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'no_start_local_media')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `no_start_local_media` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'no_start_advs')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `no_start_advs` text NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'end_activity_id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `end_activity_id` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'end_activity_vu')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `end_activity_vu` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'end_activity_uu')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `end_activity_uu` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'end_activity_pu')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `end_activity_pu` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'end_yt_iframe')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `end_yt_iframe` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'end_local_media')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `end_local_media` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'end_advs')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `end_advs` text NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'thumb_time')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `thumb_time` int(10) NOT NULL DEFAULT '5';");
}
if(!pdo_fieldexists('meepo_online_list',  'marqueen_words')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `marqueen_words` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'img')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `img` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'main_color')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `main_color` varchar(300) NOT NULL DEFAULT '#ff6a00';");
}
if(!pdo_fieldexists('meepo_online_list',  'description')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `description` longtext NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'isshow')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `isshow` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'start_time')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `start_time` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'end_time')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `end_time` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'zan_style')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `zan_style` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'zan')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `zan` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'pinglun')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `pinglun` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `displayorder` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'is_best')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `is_best` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_list',  'live_logo')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `live_logo` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'top_bj')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `top_bj` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'share_title')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `share_title` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'share_content')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `share_content` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'share_img')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `share_img` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'advs')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `advs` text NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'content')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `content` text NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'award_tpl')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `award_tpl` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'consumer_tpl')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `consumer_tpl` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'award_customer_img')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `award_customer_img` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'yuyue_tpl')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `yuyue_tpl` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'yuyue_customer_img')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `yuyue_customer_img` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'consumer_customer_img')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `consumer_customer_img` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'dashang_show')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `dashang_show` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'gift_show')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `gift_show` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'dashang_limit')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `dashang_limit` varchar(20) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('meepo_online_list',  'dashang_flower')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `dashang_flower` tinyint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('meepo_online_list',  'gift_flower')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `gift_flower` tinyint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('meepo_online_list',  'newjoin_flower')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `newjoin_flower` tinyint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('meepo_online_list',  'dashang_music')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `dashang_music` varchar(300) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_list',  'gift_music')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `gift_music` varchar(300) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_list',  'newjoin_music')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `newjoin_music` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'live_persons')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `live_persons` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'shake_show')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `shake_show` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'shake_must_address')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `shake_must_address` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'player_height')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `player_height` int(11) NOT NULL DEFAULT '180';");
}
if(!pdo_fieldexists('meepo_online_list',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'need_pay')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `need_pay` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_list',  'pay_money')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `pay_money` varchar(100) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_list',  'look_code')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `look_code` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list',  'look_type')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `look_type` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_list',  'end_type')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `end_type` tinyint(1) NOT NULL COMMENT '规则';");
}
if(!pdo_fieldexists('meepo_online_list',  'yuyue_show')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `yuyue_show` tinyint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('meepo_online_list',  'sms_mobile')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `sms_mobile` tinyint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('meepo_online_list',  'put_mobile')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `put_mobile` tinyint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('meepo_online_list',  'gift_pay_detail')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `gift_pay_detail` tinyint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('meepo_online_list',  'rtmp')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `rtmp` varchar(500) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_list',  'hls')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list')." ADD `hls` varchar(500) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_list_gift',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_gift')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_list_gift',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_gift')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_gift',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_gift')." ADD `listid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_gift',  'money')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_gift')." ADD `money` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_gift',  'name')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_gift')." ADD `name` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_gift',  'img')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_gift')." ADD `img` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_gift',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_gift')." ADD `displayorder` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_gift',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_gift')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_list_live_news',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news')." ADD `listid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news',  'content')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news')." ADD `content` text NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news',  'imgs')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news')." ADD `imgs` text NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news',  'audio')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news')." ADD `audio` text NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news_reply',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news_reply')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_list_live_news_reply',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news_reply')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news_reply',  'newsid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news_reply')." ADD `newsid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news_reply',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news_reply')." ADD `listid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news_reply',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news_reply')." ADD `avatar` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news_reply',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news_reply')." ADD `nickname` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news_reply',  'content')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news_reply')." ADD `content` text NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news_reply',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news_reply')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news_zan',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news_zan')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_list_live_news_zan',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news_zan')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news_zan',  'newsid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news_zan')." ADD `newsid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news_zan',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news_zan')." ADD `listid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news_zan',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news_zan')." ADD `avatar` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news_zan',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news_zan')." ADD `nickname` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_live_news_zan',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_live_news_zan')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_lookcode',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_lookcode')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_list_lookcode',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_lookcode')." ADD `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号';");
}
if(!pdo_fieldexists('meepo_online_list_lookcode',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_lookcode')." ADD `openid` varchar(200) NOT NULL COMMENT '粉丝标识';");
}
if(!pdo_fieldexists('meepo_online_list_lookcode',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_lookcode')." ADD `listid` int(10) NOT NULL COMMENT '直播id';");
}
if(!pdo_fieldexists('meepo_online_list_lookcode',  'code')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_lookcode')." ADD `code` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_lookcode',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_lookcode')." ADD `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示';");
}
if(!pdo_fieldexists('meepo_online_list_lookpay',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_lookpay')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_list_lookpay',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_lookpay')." ADD `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号';");
}
if(!pdo_fieldexists('meepo_online_list_lookpay',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_lookpay')." ADD `openid` varchar(200) NOT NULL COMMENT '粉丝标识';");
}
if(!pdo_fieldexists('meepo_online_list_lookpay',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_lookpay')." ADD `listid` int(10) NOT NULL COMMENT '直播id';");
}
if(!pdo_fieldexists('meepo_online_list_lookpay',  'money')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_lookpay')." ADD `money` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_lookpay',  'status')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_lookpay')." ADD `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支付';");
}
if(!pdo_fieldexists('meepo_online_list_lookpay',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_lookpay')." ADD `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '支付时间';");
}
if(!pdo_fieldexists('meepo_online_list_menu',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_menu')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_list_menu',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_menu')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_menu',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_menu')." ADD `listid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_menu',  'isshow')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_menu')." ADD `isshow` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_menu',  'type')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_menu')." ADD `type` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_menu',  'name')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_menu')." ADD `name` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_menu',  'settings')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_menu')." ADD `settings` text NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_menu',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_menu')." ADD `displayorder` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_menu',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_menu')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_need_input',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_need_input')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_list_need_input',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_need_input')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_need_input',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_need_input')." ADD `listid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_need_input',  'name')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_need_input')." ADD `name` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_need_input',  'code')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_need_input')." ADD `code` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_need_input',  'placeholder')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_need_input')." ADD `placeholder` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_need_input',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_need_input')." ADD `displayorder` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_need_input',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_need_input')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_shake_award',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_award')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_list_shake_award',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_award')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_shake_award',  'type')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_award')." ADD `type` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_list_shake_award',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_award')." ADD `listid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_shake_award',  'num')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_award')." ADD `num` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_shake_award',  'had_get_num')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_award')." ADD `had_get_num` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_shake_award',  'name')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_award')." ADD `name` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_shake_award',  'img')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_award')." ADD `img` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_shake_award',  'gailv')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_award')." ADD `gailv` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_list_shake_award',  'get_url')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_award')." ADD `get_url` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_shake_award',  'get_way')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_award')." ADD `get_way` tinyint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('meepo_online_list_shake_award',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_award')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_shake_record',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_record')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_list_shake_record',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_record')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_shake_record',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_record')." ADD `listid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_shake_record',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_record')." ADD `openid` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_shake_record',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_record')." ADD `nickname` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_shake_record',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_record')." ADD `avatar` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_shake_record',  'award_id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_record')." ADD `award_id` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_shake_record',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_shake_record')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_share',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_share')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_list_share',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_share')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_share',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_share')." ADD `openid` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_share',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_share')." ADD `nickname` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_share',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_share')." ADD `avatar` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_share',  'categoryid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_share')." ADD `categoryid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_share',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_share')." ADD `listid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_share',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_share')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_user',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_list_user',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_user',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `openid` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_user',  'oauth_openid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `oauth_openid` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_user',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `nickname` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_user',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `avatar` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_user',  'sex')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `sex` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_user',  'cansay')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `cansay` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_list_user',  'categoryid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `categoryid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_user',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `listid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_user',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `realname` varchar(200) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_list_user',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `mobile` varchar(20) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_list_user',  'father_id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `father_id` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_list_user',  'address')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `address` varchar(500) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_list_user',  'need_info')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `need_info` text NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_user',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_user')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_zan',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_zan')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_list_zan',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_zan')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_zan',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_zan')." ADD `openid` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_zan',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_zan')." ADD `nickname` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_zan',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_zan')." ADD `avatar` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_zan',  'categoryid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_zan')." ADD `categoryid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_zan',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_zan')." ADD `listid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_list_zan',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_list_zan')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_pinglun',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_pinglun')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_pinglun',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_pinglun')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_pinglun',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_pinglun')." ADD `openid` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_pinglun',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_pinglun')." ADD `nickname` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_pinglun',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_pinglun')." ADD `avatar` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_pinglun',  'sex')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_pinglun')." ADD `sex` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_pinglun',  'categoryid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_pinglun')." ADD `categoryid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_pinglun',  'listid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_pinglun')." ADD `listid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_pinglun',  'content')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_pinglun')." ADD `content` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_pinglun',  'type')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_pinglun')." ADD `type` varchar(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_pinglun',  'status')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_pinglun')." ADD `status` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_pinglun',  'money')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_pinglun')." ADD `money` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_pinglun',  'num')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_pinglun')." ADD `num` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_pinglun',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_pinglun')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_setting',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_setting')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_setting',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_setting')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_setting',  'settings')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_setting')." ADD `settings` text NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_setting',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_setting')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_user',  'id')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_user')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('meepo_online_user',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_user')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_user',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_user')." ADD `openid` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_user',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_user')." ADD `nickname` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_user',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_user')." ADD `avatar` varchar(300) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_user',  'sex')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_user')." ADD `sex` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_user',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_user')." ADD `realname` varchar(200) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_user',  'address')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_user')." ADD `address` varchar(500) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_user',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_user')." ADD `mobile` varchar(20) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('meepo_online_user',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_user')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('meepo_online_user',  'newjointime')) {
	pdo_query("ALTER TABLE ".tablename('meepo_online_user')." ADD `newjointime` int(11) NOT NULL;");
}

?>