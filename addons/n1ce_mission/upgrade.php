<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_n1ce_mission_fans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `rid` int(10) unsigned DEFAULT '0',
  `from_user` varchar(100) NOT NULL,
  `bropenid` varchar(100) NOT NULL,
  `upopenid` varchar(100) NOT NULL,
  `nickname` varchar(50) DEFAULT '0',
  `headimgurl` varchar(500) DEFAULT '',
  `sceneid` int(11) DEFAULT '0',
  `ticketid` varchar(200) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `parentid` int(11) DEFAULT '0',
  `helpid` int(11) DEFAULT '0',
  `follow` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(1) DEFAULT '0',
  `hasdel` int(1) DEFAULT '0',
  `miss_num` int(10) DEFAULT '0',
  `money` varchar(50) DEFAULT '0',
  `createtime` varchar(50) DEFAULT NULL,
  `updatetime` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `from_user` (`from_user`),
  KEY `rid` (`rid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_n1ce_mission_prize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT '0',
  `rid` int(10) NOT NULL DEFAULT '0',
  `prizesum` int(10) unsigned NOT NULL DEFAULT '0',
  `miss_num` int(10) DEFAULT '0',
  `prize_name` varchar(50) DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `min_money` varchar(16) DEFAULT '',
  `max_money` varchar(16) DEFAULT '',
  `cardid` varchar(100) DEFAULT '',
  `lable` varchar(100) DEFAULT '',
  `total_num` int(10) unsigned NOT NULL DEFAULT '0',
  `url` varchar(255) DEFAULT '',
  `txt` varchar(255) DEFAULT '',
  `credit` int(10) NOT NULL DEFAULT '0',
  `time` varchar(32) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_n1ce_mission_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned DEFAULT '0',
  `uniacid` int(11) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `data` text,
  `bg` varchar(500) DEFAULT '',
  `miss_font` varchar(50) DEFAULT NULL,
  `first_info` varchar(200) DEFAULT NULL,
  `miss_wait` varchar(200) DEFAULT NULL,
  `starttime` int(10) DEFAULT '0',
  `endtime` int(10) DEFAULT '0',
  `miss_start` varchar(200) DEFAULT NULL,
  `miss_end` varchar(200) DEFAULT NULL,
  `miss_sub` varchar(200) DEFAULT NULL,
  `miss_temp` varchar(200) DEFAULT NULL,
  `miss_back` varchar(200) DEFAULT NULL,
  `stitle` text,
  `sthumb` text,
  `sdesc` text,
  `surl` text,
  `miss_name` varchar(50) DEFAULT '',
  `xzlx` int(1) NOT NULL DEFAULT '0',
  `area` text NOT NULL,
  `sex` int(1) NOT NULL DEFAULT '0',
  `iptype` int(1) NOT NULL DEFAULT '0',
  `posttype` int(1) NOT NULL DEFAULT '0',
  `miss_num` int(10) DEFAULT '0',
  `createtime` varchar(16) NOT NULL DEFAULT '1',
  `fans_limit` int(1) NOT NULL DEFAULT '0',
  `miss_resub` varchar(200) DEFAULT NULL,
  `miss_finish` varchar(200) DEFAULT NULL,
  `miss_youzan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_n1ce_mission_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) NOT NULL DEFAULT '0',
  `uniacid` int(10) unsigned NOT NULL DEFAULT '1',
  `openid` varchar(64) NOT NULL DEFAULT '1',
  `bopenid` varchar(64) NOT NULL DEFAULT '1',
  `miss_num` int(10) DEFAULT '0',
  `nickname` varchar(64) NOT NULL DEFAULT '1',
  `money` varchar(16) NOT NULL DEFAULT '0',
  `headimgurl` varchar(500) DEFAULT '',
  `time` varchar(16) NOT NULL DEFAULT '1',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `salt` varchar(32) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
pdo_run($sql);
if(!pdo_fieldexists('n1ce_mission_fans',  'id')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `rid` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'from_user')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `from_user` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'bropenid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `bropenid` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'upopenid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `upopenid` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `nickname` varchar(50) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'headimgurl')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `headimgurl` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'sceneid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `sceneid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'ticketid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `ticketid` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'url')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `url` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'parentid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `parentid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'helpid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `helpid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'follow')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `follow` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'status')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `status` int(1) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'hasdel')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `hasdel` int(1) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'miss_num')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `miss_num` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'money')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `money` varchar(50) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `createtime` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_fans',  'updatetime')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD `updatetime` varchar(50) DEFAULT '0';");
}
if(!pdo_indexexists('n1ce_mission_fans',  'from_user')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD KEY `from_user` (`from_user`);");
}
if(!pdo_indexexists('n1ce_mission_fans',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD KEY `rid` (`rid`);");
}
if(!pdo_indexexists('n1ce_mission_fans',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_fans')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'id')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `uniacid` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `rid` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'prizesum')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `prizesum` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'miss_num')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `miss_num` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'prize_name')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `prize_name` varchar(50) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'type')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `type` tinyint(4) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'min_money')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `min_money` varchar(16) DEFAULT '';");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'max_money')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `max_money` varchar(16) DEFAULT '';");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'cardid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `cardid` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'lable')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `lable` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'total_num')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `total_num` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'url')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `url` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'txt')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `txt` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `credit` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_prize',  'time')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD `time` varchar(32) NOT NULL DEFAULT '1';");
}
if(!pdo_indexexists('n1ce_mission_prize',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD KEY `rid` (`rid`);");
}
if(!pdo_indexexists('n1ce_mission_prize',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_prize')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'id')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `rid` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'title')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `title` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'data')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `data` text;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'bg')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `bg` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'miss_font')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `miss_font` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'first_info')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `first_info` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'miss_wait')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `miss_wait` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `starttime` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `endtime` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'miss_start')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `miss_start` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'miss_end')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `miss_end` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'miss_sub')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `miss_sub` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'miss_temp')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `miss_temp` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'miss_back')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `miss_back` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'stitle')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `stitle` text;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'sthumb')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `sthumb` text;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'sdesc')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `sdesc` text;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'surl')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `surl` text;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'miss_name')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `miss_name` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'xzlx')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `xzlx` int(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'area')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `area` text NOT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'sex')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `sex` int(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'iptype')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `iptype` int(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'posttype')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `posttype` int(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'miss_num')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `miss_num` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `createtime` varchar(16) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'fans_limit')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `fans_limit` int(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'miss_resub')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `miss_resub` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'miss_finish')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `miss_finish` varchar(200) DEFAULT NULL;");
}
if(!pdo_fieldexists('n1ce_mission_reply',  'miss_youzan')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD `miss_youzan` varchar(200) DEFAULT NULL;");
}
if(!pdo_indexexists('n1ce_mission_reply',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD KEY `rid` (`rid`);");
}
if(!pdo_indexexists('n1ce_mission_reply',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_reply')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('n1ce_mission_user',  'id')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_user')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('n1ce_mission_user',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_user')." ADD `rid` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_user',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_user')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('n1ce_mission_user',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_user')." ADD `openid` varchar(64) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('n1ce_mission_user',  'bopenid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_user')." ADD `bopenid` varchar(64) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('n1ce_mission_user',  'miss_num')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_user')." ADD `miss_num` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_user',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_user')." ADD `nickname` varchar(64) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('n1ce_mission_user',  'money')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_user')." ADD `money` varchar(16) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_user',  'headimgurl')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_user')." ADD `headimgurl` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('n1ce_mission_user',  'time')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_user')." ADD `time` varchar(16) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('n1ce_mission_user',  'type')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_user')." ADD `type` tinyint(4) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_user',  'status')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_user')." ADD `status` tinyint(4) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('n1ce_mission_user',  'salt')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_user')." ADD `salt` varchar(32) DEFAULT '';");
}
if(!pdo_indexexists('n1ce_mission_user',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_user')." ADD KEY `rid` (`rid`);");
}
if(!pdo_indexexists('n1ce_mission_user',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('n1ce_mission_user')." ADD KEY `uniacid` (`uniacid`);");
}

?>