<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_wr_printer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `photo_ad` varchar(100) NOT NULL COMMENT '模板1',
  `maxnum` tinyint(3) unsigned NOT NULL COMMENT '参与次数',
  `dcmaxnum` tinyint(2) NOT NULL DEFAULT '1',
  `authcode` varchar(20) NOT NULL COMMENT '验证码',
  `mpwd` varchar(20) NOT NULL COMMENT '管理码',
  `msg` text NOT NULL,
  `msg_succ` text NOT NULL,
  `msg_fail` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为停用，1为启用',
  `is_guestbook` tinyint(1) NOT NULL DEFAULT '1' COMMENT '留言0为停用，1为启用',
  `is_authcode` tinyint(1) NOT NULL DEFAULT '1' COMMENT '屏幕验证码0为停用，1为启用',
  `cycle` tinyint(1) NOT NULL DEFAULT '0' COMMENT '计次周期0为按天，1为整个活动期',
  `is_consumecode` tinyint(1) NOT NULL DEFAULT '0' COMMENT '消费码0为停用，1为启用',
  `adstatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '网络广告0为停用，1为启用',
  `is_cut` tinyint(1) NOT NULL DEFAULT '0' COMMENT '自助剪裁0为停用，1为启用',
  `timer` int(15) unsigned NOT NULL DEFAULT '0',
  `template` varchar(10) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pic_size` varchar(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_wr_printer_ads` (
  `rid` int(10) unsigned NOT NULL,
  `url` varchar(200) NOT NULL DEFAULT '',
  `pic` varchar(200) NOT NULL DEFAULT '',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0',
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `createtime` int(10) unsigned NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_wr_printer_consumecode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则id',
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'weid',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为未用，1为已用',
  `stype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为系统分配，1为客户分配',
  `consumecode` int(10) NOT NULL DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `use_time` int(11) DEFAULT NULL,
  `buy_time` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_wr_printer_count` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则id',
  `fid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '粉丝id',
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'weid',
  `count` int(10) NOT NULL DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_wr_printer_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则id',
  `mguser` varchar(50) NOT NULL COMMENT '管理者',
  `fid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '粉丝id',
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'weid',
  `count` int(10) NOT NULL DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_wr_printer_pic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则id',
  `fid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '粉丝id',
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'weid',
  `msg` varchar(100) NOT NULL COMMENT '消息',
  `pic` varchar(100) NOT NULL COMMENT '图片',
  `pwd1` varchar(20) NOT NULL COMMENT '参与码',
  `bianhao` varchar(20) NOT NULL COMMENT '照片编号',
  `printed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '打印状态',
  `create_time` int(11) DEFAULT NULL,
  `newpic` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
pdo_run($sql);
if(!pdo_fieldexists('wr_printer',  'id')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('wr_printer',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `rid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('wr_printer',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `weid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('wr_printer',  'photo_ad')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `photo_ad` varchar(100) NOT NULL COMMENT '模板1';");
}
if(!pdo_fieldexists('wr_printer',  'maxnum')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `maxnum` tinyint(3) unsigned NOT NULL COMMENT '参与次数';");
}
if(!pdo_fieldexists('wr_printer',  'dcmaxnum')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `dcmaxnum` tinyint(2) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('wr_printer',  'authcode')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `authcode` varchar(20) NOT NULL COMMENT '验证码';");
}
if(!pdo_fieldexists('wr_printer',  'mpwd')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `mpwd` varchar(20) NOT NULL COMMENT '管理码';");
}
if(!pdo_fieldexists('wr_printer',  'msg')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `msg` text NOT NULL;");
}
if(!pdo_fieldexists('wr_printer',  'msg_succ')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `msg_succ` text NOT NULL;");
}
if(!pdo_fieldexists('wr_printer',  'msg_fail')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `msg_fail` text NOT NULL;");
}
if(!pdo_fieldexists('wr_printer',  'status')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为停用，1为启用';");
}
if(!pdo_fieldexists('wr_printer',  'is_guestbook')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `is_guestbook` tinyint(1) NOT NULL DEFAULT '1' COMMENT '留言0为停用，1为启用';");
}
if(!pdo_fieldexists('wr_printer',  'is_authcode')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `is_authcode` tinyint(1) NOT NULL DEFAULT '1' COMMENT '屏幕验证码0为停用，1为启用';");
}
if(!pdo_fieldexists('wr_printer',  'cycle')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `cycle` tinyint(1) NOT NULL DEFAULT '0' COMMENT '计次周期0为按天，1为整个活动期';");
}
if(!pdo_fieldexists('wr_printer',  'is_consumecode')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `is_consumecode` tinyint(1) NOT NULL DEFAULT '0' COMMENT '消费码0为停用，1为启用';");
}
if(!pdo_fieldexists('wr_printer',  'adstatus')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `adstatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '网络广告0为停用，1为启用';");
}
if(!pdo_fieldexists('wr_printer',  'is_cut')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `is_cut` tinyint(1) NOT NULL DEFAULT '0' COMMENT '自助剪裁0为停用，1为启用';");
}
if(!pdo_fieldexists('wr_printer',  'timer')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `timer` int(15) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('wr_printer',  'template')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `template` varchar(10) DEFAULT NULL;");
}
if(!pdo_fieldexists('wr_printer',  'price')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `price` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('wr_printer',  'pic_size')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD `pic_size` varchar(3) NOT NULL;");
}
if(!pdo_indexexists('wr_printer',  'id')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer')." ADD UNIQUE KEY `id` (`id`);");
}
if(!pdo_fieldexists('wr_printer_ads',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_ads')." ADD `rid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('wr_printer_ads',  'url')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_ads')." ADD `url` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('wr_printer_ads',  'pic')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_ads')." ADD `pic` varchar(200) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('wr_printer_ads',  'listorder')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_ads')." ADD `listorder` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('wr_printer_ads',  'isshow')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_ads')." ADD `isshow` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示';");
}
if(!pdo_fieldexists('wr_printer_ads',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_ads')." ADD `createtime` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('wr_printer_ads',  'id')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_ads')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_indexexists('wr_printer_ads',  'id')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_ads')." ADD UNIQUE KEY `id` (`id`);");
}
if(!pdo_fieldexists('wr_printer_consumecode',  'id')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_consumecode')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('wr_printer_consumecode',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_consumecode')." ADD `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则id';");
}
if(!pdo_fieldexists('wr_printer_consumecode',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_consumecode')." ADD `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'weid';");
}
if(!pdo_fieldexists('wr_printer_consumecode',  'status')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_consumecode')." ADD `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为未用，1为已用';");
}
if(!pdo_fieldexists('wr_printer_consumecode',  'stype')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_consumecode')." ADD `stype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为系统分配，1为客户分配';");
}
if(!pdo_fieldexists('wr_printer_consumecode',  'consumecode')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_consumecode')." ADD `consumecode` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('wr_printer_consumecode',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_consumecode')." ADD `create_time` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('wr_printer_consumecode',  'use_time')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_consumecode')." ADD `use_time` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('wr_printer_consumecode',  'buy_time')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_consumecode')." ADD `buy_time` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('wr_printer_consumecode',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_consumecode')." ADD `openid` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('wr_printer_consumecode',  'price')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_consumecode')." ADD `price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('wr_printer_count',  'id')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_count')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('wr_printer_count',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_count')." ADD `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则id';");
}
if(!pdo_fieldexists('wr_printer_count',  'fid')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_count')." ADD `fid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '粉丝id';");
}
if(!pdo_fieldexists('wr_printer_count',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_count')." ADD `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'weid';");
}
if(!pdo_fieldexists('wr_printer_count',  'count')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_count')." ADD `count` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('wr_printer_count',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_count')." ADD `create_time` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('wr_printer_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_log')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('wr_printer_log',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_log')." ADD `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则id';");
}
if(!pdo_fieldexists('wr_printer_log',  'mguser')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_log')." ADD `mguser` varchar(50) NOT NULL COMMENT '管理者';");
}
if(!pdo_fieldexists('wr_printer_log',  'fid')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_log')." ADD `fid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '粉丝id';");
}
if(!pdo_fieldexists('wr_printer_log',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_log')." ADD `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'weid';");
}
if(!pdo_fieldexists('wr_printer_log',  'count')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_log')." ADD `count` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('wr_printer_log',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_log')." ADD `create_time` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('wr_printer_pic',  'id')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_pic')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('wr_printer_pic',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_pic')." ADD `rid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '规则id';");
}
if(!pdo_fieldexists('wr_printer_pic',  'fid')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_pic')." ADD `fid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '粉丝id';");
}
if(!pdo_fieldexists('wr_printer_pic',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_pic')." ADD `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'weid';");
}
if(!pdo_fieldexists('wr_printer_pic',  'msg')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_pic')." ADD `msg` varchar(100) NOT NULL COMMENT '消息';");
}
if(!pdo_fieldexists('wr_printer_pic',  'pic')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_pic')." ADD `pic` varchar(100) NOT NULL COMMENT '图片';");
}
if(!pdo_fieldexists('wr_printer_pic',  'pwd1')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_pic')." ADD `pwd1` varchar(20) NOT NULL COMMENT '参与码';");
}
if(!pdo_fieldexists('wr_printer_pic',  'bianhao')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_pic')." ADD `bianhao` varchar(20) NOT NULL COMMENT '照片编号';");
}
if(!pdo_fieldexists('wr_printer_pic',  'printed')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_pic')." ADD `printed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '打印状态';");
}
if(!pdo_fieldexists('wr_printer_pic',  'create_time')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_pic')." ADD `create_time` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('wr_printer_pic',  'newpic')) {
	pdo_query("ALTER TABLE ".tablename('wr_printer_pic')." ADD `newpic` varchar(100) NOT NULL;");
}

?>