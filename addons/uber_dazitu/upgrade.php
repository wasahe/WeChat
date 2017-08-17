<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_uber_dazitu_fans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned DEFAULT '0',
  `rid` int(10) unsigned DEFAULT '0',
  `mchid` int(10) unsigned NOT NULL DEFAULT '0',
  `openid` varchar(100) DEFAULT '' COMMENT '用户ID',
  `oauthopenid` varchar(100) DEFAULT '' COMMENT '授权用户ID',
  `uid` int(10) unsigned DEFAULT '0',
  `nickname` varchar(100) DEFAULT '',
  `avatar` varchar(250) DEFAULT '',
  `realname` varchar(100) DEFAULT '',
  `mobile` varchar(30) DEFAULT '' COMMENT '登记信息(手机等)',
  `address` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `qq` varchar(20) NOT NULL DEFAULT '',
  `credit` decimal(10,2) DEFAULT '0.00' COMMENT '单次最高分数',
  `totalcredit` decimal(10,2) DEFAULT '0.00' COMMENT '累计分数',
  `totalnum` int(11) DEFAULT '0' COMMENT '总次数',
  `todaynum` int(11) DEFAULT '0' COMMENT '今天次数',
  `createtime` int(10) unsigned DEFAULT '0' COMMENT '最后游戏时间',
  `sharenum` int(11) DEFAULT '0' COMMENT '总分享次数',
  `shareawardnum` int(11) DEFAULT '0' COMMENT '分享抽奖次数',
  `todaysharenum` int(11) DEFAULT '0' COMMENT '今日分享次数',
  `lastsharetime` int(10) DEFAULT '0',
  `pubdate` int(10) unsigned DEFAULT '0',
  `redeemcode` varchar(20) NOT NULL DEFAULT '0',
  `ip` varchar(16) NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `exchange` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`),
  KEY `mchid` (`mchid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_uber_dazitu_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL DEFAULT '0',
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `starttime` int(10) DEFAULT '0',
  `endtime` int(10) DEFAULT '0',
  `ruletext` text,
  `playtimes` smallint(6) unsigned DEFAULT '0',
  `everydaytimes` smallint(6) unsigned NOT NULL DEFAULT '0',
  `isfollow` tinyint(1) unsigned DEFAULT '0',
  `awardtext` text,
  `followurl` varchar(200) DEFAULT '',
  `copyright` varchar(250) NOT NULL,
  `shownum` tinyint(1) unsigned DEFAULT '0',
  `viewnum` int(10) unsigned NOT NULL DEFAULT '0',
  `isprofile` tinyint(1) DEFAULT '0',
  `profile` varchar(250) DEFAULT '',
  `exchange` tinyint(1) unsigned DEFAULT '0',
  `share_title` varchar(200) DEFAULT '',
  `share_image` varchar(100) DEFAULT '',
  `share_url` varchar(100) NOT NULL DEFAULT '',
  `share_desc` varchar(250) DEFAULT '',
  `createtime` int(10) DEFAULT '0',
  `adimgurl` varchar(100) NOT NULL DEFAULT '',
  `adurl` varchar(100) NOT NULL DEFAULT '',
  `bgurl` varchar(100) DEFAULT '',
  `coverurl` varchar(100) DEFAULT '',
  `prize` text NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `daysharenum` int(10) unsigned NOT NULL DEFAULT '0',
  `shareawardnum` int(10) unsigned NOT NULL DEFAULT '0',
  `gametime` int(10) unsigned NOT NULL DEFAULT '15',
  `gamelevel` int(10) unsigned NOT NULL DEFAULT '3',
  `mode` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `showusernum` int(10) unsigned NOT NULL DEFAULT '200',
  `qrcode` varchar(100) NOT NULL DEFAULT '',
  `qrcodetext` varchar(100) DEFAULT '',
  `bgmusic` varchar(100) NOT NULL DEFAULT '',
  `q1` varchar(255) NOT NULL DEFAULT '',
  `q2` varchar(255) NOT NULL DEFAULT '',
  `q3` varchar(255) NOT NULL DEFAULT '',
  `q4` varchar(255) NOT NULL DEFAULT '',
  `q5` varchar(255) NOT NULL DEFAULT '',
  `q6` varchar(255) NOT NULL DEFAULT '',
  `q7` varchar(255) NOT NULL DEFAULT '',
  `q8` varchar(255) NOT NULL DEFAULT '',
  `q9` varchar(255) NOT NULL DEFAULT '',
  `q10` varchar(255) NOT NULL DEFAULT '',
  `qtext` varchar(1000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_uber_dazitu_share` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `share_openid` varchar(100) NOT NULL,
  `share_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
";
pdo_run($sql);
if(!pdo_fieldexists('uber_dazitu_fans',  'id')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `uniacid` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `rid` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'mchid')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `mchid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `openid` varchar(100) DEFAULT '' COMMENT '用户ID';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'oauthopenid')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `oauthopenid` varchar(100) DEFAULT '' COMMENT '授权用户ID';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `uid` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `nickname` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `avatar` varchar(250) DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `realname` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `mobile` varchar(30) DEFAULT '' COMMENT '登记信息(手机等)';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'address')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `address` varchar(250) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'email')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `email` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'qq')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `qq` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `credit` decimal(10,2) DEFAULT '0.00' COMMENT '单次最高分数';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'totalcredit')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `totalcredit` decimal(10,2) DEFAULT '0.00' COMMENT '累计分数';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'totalnum')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `totalnum` int(11) DEFAULT '0' COMMENT '总次数';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'todaynum')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `todaynum` int(11) DEFAULT '0' COMMENT '今天次数';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `createtime` int(10) unsigned DEFAULT '0' COMMENT '最后游戏时间';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'sharenum')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `sharenum` int(11) DEFAULT '0' COMMENT '总分享次数';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'shareawardnum')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `shareawardnum` int(11) DEFAULT '0' COMMENT '分享抽奖次数';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'todaysharenum')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `todaysharenum` int(11) DEFAULT '0' COMMENT '今日分享次数';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'lastsharetime')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `lastsharetime` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'pubdate')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `pubdate` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'redeemcode')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `redeemcode` varchar(20) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'ip')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `ip` varchar(16) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'status')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_fans',  'exchange')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD `exchange` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('uber_dazitu_fans',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD KEY `rid` (`rid`);");
}
if(!pdo_indexexists('uber_dazitu_fans',  'mchid')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_fans')." ADD KEY `mchid` (`mchid`);");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'id')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `rid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `uniacid` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'title')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `title` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `starttime` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `endtime` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'ruletext')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `ruletext` text;");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'playtimes')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `playtimes` smallint(6) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'everydaytimes')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `everydaytimes` smallint(6) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'isfollow')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `isfollow` tinyint(1) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'awardtext')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `awardtext` text;");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'followurl')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `followurl` varchar(200) DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'copyright')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `copyright` varchar(250) NOT NULL;");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'shownum')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `shownum` tinyint(1) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'viewnum')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `viewnum` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'isprofile')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `isprofile` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'profile')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `profile` varchar(250) DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'exchange')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `exchange` tinyint(1) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'share_title')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `share_title` varchar(200) DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'share_image')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `share_image` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'share_url')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `share_url` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'share_desc')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `share_desc` varchar(250) DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `createtime` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'adimgurl')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `adimgurl` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'adurl')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `adurl` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'bgurl')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `bgurl` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'coverurl')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `coverurl` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'prize')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `prize` text NOT NULL;");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'status')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `status` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'daysharenum')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `daysharenum` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'shareawardnum')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `shareawardnum` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'gametime')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `gametime` int(10) unsigned NOT NULL DEFAULT '15';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'gamelevel')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `gamelevel` int(10) unsigned NOT NULL DEFAULT '3';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'mode')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `mode` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'showusernum')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `showusernum` int(10) unsigned NOT NULL DEFAULT '200';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'qrcode')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `qrcode` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'qrcodetext')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `qrcodetext` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'bgmusic')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `bgmusic` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'q1')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `q1` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'q2')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `q2` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'q3')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `q3` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'q4')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `q4` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'q5')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `q5` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'q6')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `q6` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'q7')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `q7` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'q8')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `q8` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'q9')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `q9` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'q10')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `q10` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('uber_dazitu_reply',  'qtext')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD `qtext` varchar(1000) NOT NULL DEFAULT '';");
}
if(!pdo_indexexists('uber_dazitu_reply',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_reply')." ADD KEY `rid` (`rid`);");
}
if(!pdo_fieldexists('uber_dazitu_share',  'id')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_share')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('uber_dazitu_share',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_share')." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('uber_dazitu_share',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_share')." ADD `rid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('uber_dazitu_share',  'share_openid')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_share')." ADD `share_openid` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('uber_dazitu_share',  'share_time')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_share')." ADD `share_time` int(10) unsigned NOT NULL;");
}
if(!pdo_indexexists('uber_dazitu_share',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('uber_dazitu_share')." ADD KEY `rid` (`rid`);");
}

?>