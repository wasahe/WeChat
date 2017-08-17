<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_yukiho_zvoice_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `weblink` varchar(255) DEFAULT '',
  `contents` varchar(1000) DEFAULT '',
  `mode` tinyint(2) DEFAULT '0',
  `status` tinyint(2) DEFAULT '0',
  `images` varchar(255) DEFAULT '',
  `create_time` int(11) DEFAULT '0',
  `openid` varchar(64) DEFAULT '',
  `question_id` int(11) DEFAULT '0',
  `voice_id` varchar(320) DEFAULT '',
  `timelong` int(11) DEFAULT '0',
  `src` varchar(320) DEFAULT '',
  `persistentId` varchar(320) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_yukiho_zvoice_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `title` varchar(32) DEFAULT '',
  `icon` varchar(32) DEFAULT '',
  `fid` int(1) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `ismore` tinyint(2) DEFAULT '0',
  `image` varchar(320) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_yukiho_zvoice_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(64) DEFAULT '',
  `number` int(11) DEFAULT '0' COMMENT '回答个数',
  `follow` int(11) DEFAULT '0' COMMENT '收听人数',
  `tags` varchar(20) DEFAULT '' COMMENT '头衔',
  `desc` varchar(320) DEFAULT '',
  `credit` int(5) DEFAULT '0' COMMENT '提问费用',
  `avatar` varchar(320) DEFAULT '',
  `nickname` varchar(32) DEFAULT '',
  `status` tinyint(2) DEFAULT '0',
  `score` decimal(5,2) DEFAULT '0.00',
  `subjects` varchar(100) DEFAULT '',
  `realname` varchar(32) DEFAULT '',
  `home_cover` varchar(255) DEFAULT '',
  `verifyMsg` varchar(255) DEFAULT '',
  `certify` varchar(255) DEFAULT '',
  `create_time` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `open_free` tinyint(2) DEFAULT '0',
  `ishot` tinyint(2) DEFAULT '0',
  `isrecommend` tinyint(2) DEFAULT '0',
  `category_id` int(11) DEFAULT '0',
  `admin` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_yukiho_zvoice_paylog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `type` tinyint(2) DEFAULT '0',
  `credit` decimal(10,2) DEFAULT '0.00',
  `sn` varchar(64) DEFAULT '',
  `openid` varchar(64) DEFAULT '',
  `to_openid` varchar(64) DEFAULT '',
  `question_id` int(11) DEFAULT '0',
  `status` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_yukiho_zvoice_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `title` varchar(320) DEFAULT '',
  `category_id` int(11) DEFAULT '0',
  `openid` varchar(64) DEFAULT '',
  `credit` decimal(10,2) DEFAULT '0.00',
  `listen_num` int(11) DEFAULT '0',
  `good_num` int(11) DEFAULT '0',
  `open` tinyint(2) DEFAULT '0',
  `voice_id` varchar(320) DEFAULT '',
  `to_openid` varchar(64) DEFAULT '',
  `status` tinyint(2) DEFAULT '0',
  `isfree` tinyint(2) DEFAULT '0',
  `free_start_time` int(11) DEFAULT '0',
  `free_end_time` int(11) DEFAULT '0',
  `timelong` int(11) DEFAULT '0',
  `hash` varchar(320) DEFAULT '',
  `key` varchar(320) DEFAULT '',
  `isweixin` tinyint(2) DEFAULT '0',
  `images` varchar(1000) DEFAULT '',
  `sn` varchar(64) DEFAULT '',
  `usePoint` tinyint(2) DEFAULT '0',
  `pointNum` decimal(10,2) DEFAULT '0.00',
  `src` varchar(320) DEFAULT '',
  `istask` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_yukiho_zvoice_quickmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `title` varchar(32) DEFAULT '',
  `name` varchar(255) DEFAULT '',
  `icon` varchar(320) DEFAULT '',
  `link` varchar(320) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `ido` varchar(32) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_yukiho_zvoice_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codename` varchar(32) DEFAULT '',
  `value` text,
  `uniacid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
";
pdo_run($sql);
if(!pdo_fieldexists('yukiho_zvoice_answer',  'id')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_answer')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('yukiho_zvoice_answer',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_answer')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_answer',  'weblink')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_answer')." ADD `weblink` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_answer',  'contents')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_answer')." ADD `contents` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_answer',  'mode')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_answer')." ADD `mode` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_answer',  'status')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_answer')." ADD `status` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_answer',  'images')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_answer')." ADD `images` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_answer',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_answer')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_answer',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_answer')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_answer',  'question_id')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_answer')." ADD `question_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_answer',  'voice_id')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_answer')." ADD `voice_id` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_answer',  'timelong')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_answer')." ADD `timelong` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_answer',  'src')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_answer')." ADD `src` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_answer',  'persistentId')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_answer')." ADD `persistentId` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('yukiho_zvoice_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_category')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_category',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_category')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_category',  'title')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_category')." ADD `title` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_category',  'icon')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_category')." ADD `icon` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_category',  'fid')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_category')." ADD `fid` int(1) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_category')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_category',  'ismore')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_category')." ADD `ismore` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_category',  'image')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_category')." ADD `image` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'id')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'number')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `number` int(11) DEFAULT '0' COMMENT '回答个数';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'follow')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `follow` int(11) DEFAULT '0' COMMENT '收听人数';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'tags')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `tags` varchar(20) DEFAULT '' COMMENT '头衔';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'desc')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `desc` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `credit` int(5) DEFAULT '0' COMMENT '提问费用';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `avatar` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `nickname` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'status')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `status` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'score')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `score` decimal(5,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'subjects')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `subjects` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `realname` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'home_cover')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `home_cover` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'verifyMsg')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `verifyMsg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'certify')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `certify` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `uid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'open_free')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `open_free` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'ishot')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `ishot` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'isrecommend')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `isrecommend` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'category_id')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `category_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_member',  'admin')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_member')." ADD `admin` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_paylog',  'id')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_paylog')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('yukiho_zvoice_paylog',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_paylog')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_paylog',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_paylog')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_paylog',  'type')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_paylog')." ADD `type` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_paylog',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_paylog')." ADD `credit` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('yukiho_zvoice_paylog',  'sn')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_paylog')." ADD `sn` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_paylog',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_paylog')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_paylog',  'to_openid')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_paylog')." ADD `to_openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_paylog',  'question_id')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_paylog')." ADD `question_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_paylog',  'status')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_paylog')." ADD `status` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'id')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'title')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `title` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'category_id')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `category_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `credit` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'listen_num')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `listen_num` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'good_num')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `good_num` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'open')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `open` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'voice_id')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `voice_id` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'to_openid')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `to_openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'status')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `status` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'isfree')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `isfree` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'free_start_time')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `free_start_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'free_end_time')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `free_end_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'timelong')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `timelong` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'hash')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `hash` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'key')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `key` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'isweixin')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `isweixin` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'images')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `images` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'sn')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `sn` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'usePoint')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `usePoint` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'pointNum')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `pointNum` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'src')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `src` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_question',  'istask')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_question')." ADD `istask` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_quickmenu',  'id')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_quickmenu')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('yukiho_zvoice_quickmenu',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_quickmenu')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_quickmenu',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_quickmenu')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_quickmenu',  'title')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_quickmenu')." ADD `title` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_quickmenu',  'name')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_quickmenu')." ADD `name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_quickmenu',  'icon')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_quickmenu')." ADD `icon` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_quickmenu',  'link')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_quickmenu')." ADD `link` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_quickmenu',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_quickmenu')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('yukiho_zvoice_quickmenu',  'ido')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_quickmenu')." ADD `ido` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_setting',  'id')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_setting')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('yukiho_zvoice_setting',  'codename')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_setting')." ADD `codename` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('yukiho_zvoice_setting',  'value')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_setting')." ADD `value` text;");
}
if(!pdo_fieldexists('yukiho_zvoice_setting',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('yukiho_zvoice_setting')." ADD `uniacid` int(11) DEFAULT '0';");
}

?>