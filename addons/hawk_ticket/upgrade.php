<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_hticket_activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `shareimg` varchar(100) NOT NULL,
  `singleimg` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) unsigned DEFAULT '0',
  `starttime` int(11) unsigned NOT NULL,
  `endtime` int(11) unsigned NOT NULL,
  `place` varchar(100) NOT NULL,
  `createtime` int(11) unsigned NOT NULL,
  `extype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `proname` varchar(50) NOT NULL,
  `tlimit` int(11) unsigned NOT NULL,
  `scantimes` int(11) unsigned NOT NULL DEFAULT '1',
  `buylimit` int(8) unsigned NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `author` varchar(50) NOT NULL,
  `groups` varchar(200) NOT NULL,
  `viewnums` int(11) unsigned NOT NULL,
  `isseat` tinyint(2) unsigned NOT NULL,
  `seatsets` text NOT NULL,
  `usedseats` text NOT NULL,
  `orderseats` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `status` (`status`),
  KEY `isseat` (`isseat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hticket_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `orderid` int(11) unsigned NOT NULL,
  `actid` int(11) unsigned NOT NULL,
  `scanown` varchar(50) NOT NULL,
  `type` int(2) unsigned NOT NULL DEFAULT '1',
  `remark` varchar(100) NOT NULL,
  `createtime` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `orderid` (`orderid`),
  KEY `actid` (`actid`),
  KEY `scanown` (`scanown`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hticket_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `actid` int(11) unsigned NOT NULL,
  `type` varchar(20) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `scanown` varchar(50) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `createtime` int(11) unsigned NOT NULL,
  `paytime` int(11) unsigned NOT NULL,
  `scantime` int(11) unsigned NOT NULL,
  `closetime` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `openid` (`openid`),
  KEY `actid` (`actid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_hticket_seat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `orid` int(11) unsigned NOT NULL,
  `seats` text NOT NULL,
  `ptime` varchar(50) NOT NULL,
  `nums` int(11) unsigned NOT NULL DEFAULT '0',
  `price` float NOT NULL,
  `createtime` int(11) unsigned NOT NULL,
  `remark` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `openid` (`openid`),
  KEY `orid` (`orid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
pdo_run($sql);
if(!pdo_fieldexists('hticket_activity',  'id')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('hticket_activity',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'title')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `title` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'description')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `description` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'shareimg')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `shareimg` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'singleimg')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `singleimg` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'content')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `content` text NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'status')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `status` tinyint(1) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('hticket_activity',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `starttime` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `endtime` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'place')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `place` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `createtime` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'extype')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `extype` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('hticket_activity',  'proname')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `proname` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'tlimit')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `tlimit` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'scantimes')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `scantimes` int(11) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('hticket_activity',  'buylimit')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `buylimit` int(8) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'fee')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `fee` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('hticket_activity',  'author')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `author` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'groups')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `groups` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'viewnums')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `viewnums` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'isseat')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `isseat` tinyint(2) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'seatsets')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `seatsets` text NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'usedseats')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `usedseats` text NOT NULL;");
}
if(!pdo_fieldexists('hticket_activity',  'orderseats')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD `orderseats` text NOT NULL;");
}
if(!pdo_indexexists('hticket_activity',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('hticket_activity',  'status')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('hticket_activity',  'isseat')) {
	pdo_query("ALTER TABLE ".tablename('hticket_activity')." ADD KEY `isseat` (`isseat`);");
}
if(!pdo_fieldexists('hticket_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('hticket_log')." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('hticket_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_log')." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_log',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_log')." ADD `orderid` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_log',  'actid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_log')." ADD `actid` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_log',  'scanown')) {
	pdo_query("ALTER TABLE ".tablename('hticket_log')." ADD `scanown` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('hticket_log',  'type')) {
	pdo_query("ALTER TABLE ".tablename('hticket_log')." ADD `type` int(2) unsigned NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('hticket_log',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('hticket_log')." ADD `remark` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('hticket_log',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('hticket_log')." ADD `createtime` int(11) unsigned NOT NULL;");
}
if(!pdo_indexexists('hticket_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_log')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('hticket_log',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_log')." ADD KEY `orderid` (`orderid`);");
}
if(!pdo_indexexists('hticket_log',  'actid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_log')." ADD KEY `actid` (`actid`);");
}
if(!pdo_indexexists('hticket_log',  'scanown')) {
	pdo_query("ALTER TABLE ".tablename('hticket_log')." ADD KEY `scanown` (`scanown`);");
}
if(!pdo_indexexists('hticket_log',  'type')) {
	pdo_query("ALTER TABLE ".tablename('hticket_log')." ADD KEY `type` (`type`);");
}
if(!pdo_fieldexists('hticket_order',  'id')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('hticket_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_order',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('hticket_order',  'actid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD `actid` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_order',  'type')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD `type` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('hticket_order',  'fee')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD `fee` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('hticket_order',  'status')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('hticket_order',  'scanown')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD `scanown` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('hticket_order',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD `remark` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('hticket_order',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD `createtime` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_order',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD `paytime` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_order',  'scantime')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD `scantime` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_order',  'closetime')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD `closetime` int(11) unsigned NOT NULL;");
}
if(!pdo_indexexists('hticket_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('hticket_order',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD KEY `openid` (`openid`);");
}
if(!pdo_indexexists('hticket_order',  'actid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD KEY `actid` (`actid`);");
}
if(!pdo_indexexists('hticket_order',  'status')) {
	pdo_query("ALTER TABLE ".tablename('hticket_order')." ADD KEY `status` (`status`);");
}
if(!pdo_fieldexists('hticket_seat',  'id')) {
	pdo_query("ALTER TABLE ".tablename('hticket_seat')." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('hticket_seat',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_seat')." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_seat',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_seat')." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('hticket_seat',  'orid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_seat')." ADD `orid` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_seat',  'seats')) {
	pdo_query("ALTER TABLE ".tablename('hticket_seat')." ADD `seats` text NOT NULL;");
}
if(!pdo_fieldexists('hticket_seat',  'ptime')) {
	pdo_query("ALTER TABLE ".tablename('hticket_seat')." ADD `ptime` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('hticket_seat',  'nums')) {
	pdo_query("ALTER TABLE ".tablename('hticket_seat')." ADD `nums` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('hticket_seat',  'price')) {
	pdo_query("ALTER TABLE ".tablename('hticket_seat')." ADD `price` float NOT NULL;");
}
if(!pdo_fieldexists('hticket_seat',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('hticket_seat')." ADD `createtime` int(11) unsigned NOT NULL;");
}
if(!pdo_fieldexists('hticket_seat',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('hticket_seat')." ADD `remark` varchar(150) NOT NULL;");
}
if(!pdo_indexexists('hticket_seat',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_seat')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('hticket_seat',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_seat')." ADD KEY `openid` (`openid`);");
}
if(!pdo_indexexists('hticket_seat',  'orid')) {
	pdo_query("ALTER TABLE ".tablename('hticket_seat')." ADD KEY `orid` (`orid`);");
}

?>