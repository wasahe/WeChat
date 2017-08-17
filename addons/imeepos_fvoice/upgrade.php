<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_advs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `title` varchar(64) DEFAULT '',
  `image` varchar(300) DEFAULT '',
  `time` int(11) DEFAULT '0',
  `link` varchar(320) DEFAULT '',
  `status` tinyint(2) DEFAULT '0',
  `activeid` int(11) DEFAULT '0',
  `position` varchar(32) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `openid` varchar(64) DEFAULT '',
  `question_id` int(11) DEFAULT '0',
  `voice_id` varchar(320) DEFAULT '',
  `timelong` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `title` varchar(32) DEFAULT '',
  `fid` int(1) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `image` varchar(320) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_chart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `title` varchar(320) DEFAULT '',
  `status` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_chart_listen_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `openid` varchar(64) DEFAULT '',
  `chart_id` int(11) DEFAULT '0',
  `chart_log_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_chart_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `openid` varchar(64) DEFAULT '',
  `voice_id` varchar(320) DEFAULT '',
  `listen_num` int(11) DEFAULT '0',
  `timelong` int(11) DEFAULT '0',
  `chart_id` int(11) DEFAULT '0',
  `isweixin` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `openid` varchar(64) DEFAULT '',
  `to_openid` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_listen_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `openid` varchar(64) DEFAULT '',
  `to_openid` varchar(64) DEFAULT '',
  `question_id` int(11) DEFAULT '0',
  `status` tinyint(2) DEFAULT '0',
  `sn` varchar(64) DEFAULT '',
  `credit` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(64) DEFAULT '',
  `number` int(11) DEFAULT '0' COMMENT '回答个数',
  `follow` int(11) DEFAULT '0' COMMENT '收听人数',
  `tags` varchar(20) DEFAULT '' COMMENT '头衔',
  `desc` varchar(320) DEFAULT '',
  `credit` decimal(10,2) DEFAULT '0.00' COMMENT '提问费用',
  `avatar` varchar(320) DEFAULT '',
  `nickname` varchar(32) DEFAULT '',
  `create_time` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `open_free` tinyint(2) DEFAULT '0',
  `ishot` tinyint(2) DEFAULT '0',
  `isrecommend` tinyint(2) DEFAULT '0',
  `category_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `openid` varchar(64) DEFAULT '',
  `to_openid` varchar(64) DEFAULT '',
  `title` varchar(320) DEFAULT '',
  `status` tinyint(2) DEFAULT '0',
  `href` varchar(320) DEFAULT '',
  `content` varchar(1000) DEFAULT '',
  `type` varchar(32) DEFAULT '',
  `image` varchar(320) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_paylog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `credit` decimal(10,2) DEFAULT '0.00',
  `sn` varchar(64) DEFAULT '',
  `openid` varchar(64) DEFAULT '',
  `to_openid` varchar(64) DEFAULT '',
  `question_id` int(11) DEFAULT '0',
  `status` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_question` (
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_quickmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `title` varchar(32) DEFAULT '',
  `icon` varchar(320) DEFAULT '',
  `link` varchar(320) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `ido` varchar(32) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codename` varchar(32) DEFAULT '',
  `value` text,
  `uniacid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `title` varchar(100) DEFAULT '',
  `images` varchar(1000) DEFAULT '',
  `open` tinyint(2) DEFAULT '0',
  `openid` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_task_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `openid` varchar(64) DEFAULT '',
  `task_id` int(11) DEFAULT '0',
  `voice_id` varchar(320) DEFAULT '',
  `isweixin` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_task_answer_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `answer_id` int(11) DEFAULT '0',
  `task_id` int(11) DEFAULT '0',
  `openid` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_task_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `title` varchar(32) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `title` varchar(32) DEFAULT '',
  `answer_num` int(11) DEFAULT '0',
  `desc` varchar(1000) DEFAULT '',
  `image` varchar(320) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_imeepos_fvoice_themes_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `themes_id` int(11) DEFAULT '0',
  `openid` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
pdo_run($sql);
if(!pdo_fieldexists('imeepos_fvoice_advs',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_advs')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_advs',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_advs')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_advs',  'title')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_advs')." ADD `title` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_advs',  'image')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_advs')." ADD `image` varchar(300) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_advs',  'time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_advs')." ADD `time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_advs',  'link')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_advs')." ADD `link` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_advs',  'status')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_advs')." ADD `status` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_advs',  'activeid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_advs')." ADD `activeid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_advs',  'position')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_advs')." ADD `position` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_answer',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_answer')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_answer',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_answer')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_answer',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_answer')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_answer',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_answer')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_answer',  'question_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_answer')." ADD `question_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_answer',  'voice_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_answer')." ADD `voice_id` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_answer',  'timelong')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_answer')." ADD `timelong` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_category')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_category',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_category')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_category',  'title')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_category')." ADD `title` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_category',  'fid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_category')." ADD `fid` int(1) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_category')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_category',  'image')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_category')." ADD `image` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_chart',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart',  'title')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart')." ADD `title` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart',  'status')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart')." ADD `status` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart_listen_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart_listen_log')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_chart_listen_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart_listen_log')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart_listen_log',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart_listen_log')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart_listen_log',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart_listen_log')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart_listen_log',  'chart_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart_listen_log')." ADD `chart_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart_listen_log',  'chart_log_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart_listen_log')." ADD `chart_log_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart_log')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_chart_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart_log')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart_log',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart_log')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart_log',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart_log')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart_log',  'voice_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart_log')." ADD `voice_id` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart_log',  'listen_num')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart_log')." ADD `listen_num` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart_log',  'timelong')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart_log')." ADD `timelong` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart_log',  'chart_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart_log')." ADD `chart_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_chart_log',  'isweixin')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_chart_log')." ADD `isweixin` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_follow',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_follow')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_follow',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_follow')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_follow',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_follow')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_follow',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_follow')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_follow',  'to_openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_follow')." ADD `to_openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_listen_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_listen_log')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_listen_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_listen_log')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_listen_log',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_listen_log')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_listen_log',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_listen_log')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_listen_log',  'to_openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_listen_log')." ADD `to_openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_listen_log',  'question_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_listen_log')." ADD `question_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_listen_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_listen_log')." ADD `status` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_listen_log',  'sn')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_listen_log')." ADD `sn` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_listen_log',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_listen_log')." ADD `credit` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'number')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `number` int(11) DEFAULT '0' COMMENT '回答个数';");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'follow')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `follow` int(11) DEFAULT '0' COMMENT '收听人数';");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'tags')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `tags` varchar(20) DEFAULT '' COMMENT '头衔';");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'desc')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `desc` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `credit` decimal(10,2) DEFAULT '0.00' COMMENT '提问费用';");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `avatar` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `nickname` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `uid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'open_free')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `open_free` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'ishot')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `ishot` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'isrecommend')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `isrecommend` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_member',  'category_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_member')." ADD `category_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_online',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_online')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_online',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_online')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_online',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_online')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_online',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_online')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_online',  'to_openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_online')." ADD `to_openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_online',  'title')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_online')." ADD `title` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_online',  'status')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_online')." ADD `status` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_online',  'href')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_online')." ADD `href` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_online',  'content')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_online')." ADD `content` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_online',  'type')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_online')." ADD `type` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_online',  'image')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_online')." ADD `image` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_paylog',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_paylog')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_paylog',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_paylog')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_paylog',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_paylog')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_paylog',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_paylog')." ADD `credit` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('imeepos_fvoice_paylog',  'sn')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_paylog')." ADD `sn` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_paylog',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_paylog')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_paylog',  'to_openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_paylog')." ADD `to_openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_paylog',  'question_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_paylog')." ADD `question_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_paylog',  'status')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_paylog')." ADD `status` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'title')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `title` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'category_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `category_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `credit` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'listen_num')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `listen_num` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'good_num')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `good_num` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'open')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `open` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'voice_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `voice_id` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'to_openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `to_openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'status')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `status` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'src')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `src` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'isfree')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `isfree` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'free_start_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `free_start_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'free_end_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `free_end_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'timelong')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `timelong` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'hash')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `hash` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'key')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `key` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'isweixin')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `isweixin` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'images')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `images` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_question',  'sn')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_question')." ADD `sn` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_quickmenu',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_quickmenu')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_quickmenu',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_quickmenu')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_quickmenu',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_quickmenu')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_quickmenu',  'title')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_quickmenu')." ADD `title` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_quickmenu',  'icon')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_quickmenu')." ADD `icon` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_quickmenu',  'link')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_quickmenu')." ADD `link` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_quickmenu',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_quickmenu')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_quickmenu',  'ido')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_quickmenu')." ADD `ido` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_setting',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_setting')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_setting',  'codename')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_setting')." ADD `codename` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_setting',  'value')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_setting')." ADD `value` text;");
}
if(!pdo_fieldexists('imeepos_fvoice_setting',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_setting')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_task',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_task',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_task',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_task',  'title')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task')." ADD `title` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_task',  'images')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task')." ADD `images` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_task',  'open')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task')." ADD `open` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_task',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_task_answer',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_answer')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_task_answer',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_answer')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_task_answer',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_answer')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_task_answer',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_answer')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_task_answer',  'task_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_answer')." ADD `task_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_task_answer',  'voice_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_answer')." ADD `voice_id` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_task_answer',  'isweixin')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_answer')." ADD `isweixin` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_task_answer_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_answer_log')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_task_answer_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_answer_log')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_task_answer_log',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_answer_log')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_task_answer_log',  'answer_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_answer_log')." ADD `answer_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_task_answer_log',  'task_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_answer_log')." ADD `task_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_task_answer_log',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_answer_log')." ADD `openid` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_task_class',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_class')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_task_class',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_class')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_task_class',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_class')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_task_class',  'title')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_class')." ADD `title` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_task_class',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_task_class')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_themes',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_themes')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_themes',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_themes')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_themes',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_themes')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_themes',  'title')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_themes')." ADD `title` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_themes',  'answer_num')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_themes')." ADD `answer_num` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_themes',  'desc')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_themes')." ADD `desc` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_themes',  'image')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_themes')." ADD `image` varchar(320) DEFAULT '';");
}
if(!pdo_fieldexists('imeepos_fvoice_themes_answer',  'id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_themes_answer')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('imeepos_fvoice_themes_answer',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_themes_answer')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_themes_answer',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_themes_answer')." ADD `create_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_themes_answer',  'themes_id')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_themes_answer')." ADD `themes_id` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('imeepos_fvoice_themes_answer',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('imeepos_fvoice_themes_answer')." ADD `openid` varchar(64) DEFAULT '';");
}

?>