<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_siyuan_vod` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`title` varchar(100) NOT NULL DEFAULT '',
`blei` int(11),
`slei` int(11),
`thumb` varchar(300) NOT NULL DEFAULT '',
`displayorder` int(10) unsigned NOT NULL DEFAULT '0',
`weid` int(10) unsigned NOT NULL,
`pic` varchar(300),
`body` text,
`yuedu` int(20) NOT NULL DEFAULT '0',
`time` int(10),
`shuxing` varchar(20),
`lianzai` varchar(50),
`gx` varchar(500),
`play` int(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_bug` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL DEFAULT '0',
`vid` int(11) NOT NULL DEFAULT '0',
`title` varchar(200),
`openid` varchar(100),
`bug` int(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `indx_houseid` (`vid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_fenlei` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(10) unsigned NOT NULL DEFAULT '0',
`nid` int(10) unsigned NOT NULL DEFAULT '0',
`name` varchar(50) NOT NULL,
`thumb` varchar(200) NOT NULL,
`parentid` int(10) unsigned NOT NULL DEFAULT '0',
`displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
`enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_flash` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(10) unsigned NOT NULL,
`title` varchar(100) NOT NULL DEFAULT '',
`url` varchar(200) NOT NULL DEFAULT '',
`attachment` varchar(100) NOT NULL DEFAULT '',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_kv` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL DEFAULT '0',
`vid` int(11) NOT NULL DEFAULT '0',
`ji` varchar(512) NOT NULL DEFAULT '',
`url` varchar(512) NOT NULL DEFAULT '',
`displayorder` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `indx_houseid` (`vid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_menu` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(10) unsigned NOT NULL,
`title` varchar(100) NOT NULL DEFAULT '',
`url` varchar(200) NOT NULL DEFAULT '',
`displayorder` int(10) NOT NULL DEFAULT '0',
`thumb` varchar(100) NOT NULL DEFAULT '',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_play_set` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL,
`videojj_key` varchar(100) NOT NULL,
`playm3u8_key` varchar(100) NOT NULL,
`playm3u8_host` varchar(100) NOT NULL,
`playm3u8_title` varchar(200) NOT NULL,
`playm3u8_url` varchar(150) DEFAULT 'http://www.playm3u8.com',
`playm3u8_site1` varchar(150) NOT NULL,
`playm3u8_site2` varchar(150) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_setting` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`weid` int(11) NOT NULL DEFAULT '0',
`name` varchar(20),
`ad` varchar(50),
`logo` varchar(300),
`qr` varchar(300),
`top_logo` varchar(300),
`openid` varchar(100),
`color` varchar(10),
`ad_pic` varchar(200),
`ad_url` varchar(200),
`vod_xiaoxi` varchar(100),
`bug_xiaoxi` varchar(100),
`open` int(1) NOT NULL DEFAULT '0',
`time` int(10) NOT NULL DEFAULT '5000',
`bottom_name` varchar(50),
`bottom_ad` varchar(100),
`bottom_logo` varchar(300),
`bottom_qr` varchar(250),
`tishi` varchar(500),
`fengge` int(1) NOT NULL DEFAULT '0',
`video_key` varchar(20) NOT NULL,
`share_url` varchar(300) NOT NULL,
PRIMARY KEY (`id`),
KEY `indx_uniacid` (`weid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_siyuan_vod_so` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`weid` int(10) unsigned NOT NULL,
`title` varchar(100) NOT NULL DEFAULT '',
`vid` varchar(200) NOT NULL DEFAULT '',
`displayorder` int(10) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

");
if(pdo_tableexists('ims_siyuan_vod')) {
	if(!pdo_fieldexists('ims_siyuan_vod',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod')) {
	if(!pdo_fieldexists('ims_siyuan_vod',  'title')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod')." ADD `title` varchar(100) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod')) {
	if(!pdo_fieldexists('ims_siyuan_vod',  'blei')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod')." ADD `blei` int(11);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod')) {
	if(!pdo_fieldexists('ims_siyuan_vod',  'slei')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod')." ADD `slei` int(11);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod')) {
	if(!pdo_fieldexists('ims_siyuan_vod',  'thumb')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod')." ADD `thumb` varchar(300) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod')) {
	if(!pdo_fieldexists('ims_siyuan_vod',  'displayorder')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod')." ADD `displayorder` int(10) unsigned NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod')) {
	if(!pdo_fieldexists('ims_siyuan_vod',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod')." ADD `weid` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod')) {
	if(!pdo_fieldexists('ims_siyuan_vod',  'pic')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod')." ADD `pic` varchar(300);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod')) {
	if(!pdo_fieldexists('ims_siyuan_vod',  'body')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod')." ADD `body` text;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod')) {
	if(!pdo_fieldexists('ims_siyuan_vod',  'yuedu')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod')." ADD `yuedu` int(20) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod')) {
	if(!pdo_fieldexists('ims_siyuan_vod',  'time')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod')." ADD `time` int(10);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod')) {
	if(!pdo_fieldexists('ims_siyuan_vod',  'shuxing')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod')." ADD `shuxing` varchar(20);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod')) {
	if(!pdo_fieldexists('ims_siyuan_vod',  'lianzai')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod')." ADD `lianzai` varchar(50);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod')) {
	if(!pdo_fieldexists('ims_siyuan_vod',  'gx')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod')." ADD `gx` varchar(500);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod')) {
	if(!pdo_fieldexists('ims_siyuan_vod',  'play')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod')." ADD `play` int(1) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_bug')) {
	if(!pdo_fieldexists('ims_siyuan_vod_bug',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_bug')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_bug')) {
	if(!pdo_fieldexists('ims_siyuan_vod_bug',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_bug')." ADD `weid` int(11) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_bug')) {
	if(!pdo_fieldexists('ims_siyuan_vod_bug',  'vid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_bug')." ADD `vid` int(11) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_bug')) {
	if(!pdo_fieldexists('ims_siyuan_vod_bug',  'title')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_bug')." ADD `title` varchar(200);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_bug')) {
	if(!pdo_fieldexists('ims_siyuan_vod_bug',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_bug')." ADD `openid` varchar(100);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_bug')) {
	if(!pdo_fieldexists('ims_siyuan_vod_bug',  'bug')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_bug')." ADD `bug` int(1) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_fenlei')) {
	if(!pdo_fieldexists('ims_siyuan_vod_fenlei',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_fenlei')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_fenlei')) {
	if(!pdo_fieldexists('ims_siyuan_vod_fenlei',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_fenlei')." ADD `weid` int(10) unsigned NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_fenlei')) {
	if(!pdo_fieldexists('ims_siyuan_vod_fenlei',  'nid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_fenlei')." ADD `nid` int(10) unsigned NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_fenlei')) {
	if(!pdo_fieldexists('ims_siyuan_vod_fenlei',  'name')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_fenlei')." ADD `name` varchar(50) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_fenlei')) {
	if(!pdo_fieldexists('ims_siyuan_vod_fenlei',  'thumb')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_fenlei')." ADD `thumb` varchar(200) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_fenlei')) {
	if(!pdo_fieldexists('ims_siyuan_vod_fenlei',  'parentid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_fenlei')." ADD `parentid` int(10) unsigned NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_fenlei')) {
	if(!pdo_fieldexists('ims_siyuan_vod_fenlei',  'displayorder')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_fenlei')." ADD `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_fenlei')) {
	if(!pdo_fieldexists('ims_siyuan_vod_fenlei',  'enabled')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_fenlei')." ADD `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_flash')) {
	if(!pdo_fieldexists('ims_siyuan_vod_flash',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_flash')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_flash')) {
	if(!pdo_fieldexists('ims_siyuan_vod_flash',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_flash')." ADD `weid` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_flash')) {
	if(!pdo_fieldexists('ims_siyuan_vod_flash',  'title')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_flash')." ADD `title` varchar(100) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_flash')) {
	if(!pdo_fieldexists('ims_siyuan_vod_flash',  'url')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_flash')." ADD `url` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_flash')) {
	if(!pdo_fieldexists('ims_siyuan_vod_flash',  'attachment')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_flash')." ADD `attachment` varchar(100) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_kv')) {
	if(!pdo_fieldexists('ims_siyuan_vod_kv',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_kv')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_kv')) {
	if(!pdo_fieldexists('ims_siyuan_vod_kv',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_kv')." ADD `weid` int(11) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_kv')) {
	if(!pdo_fieldexists('ims_siyuan_vod_kv',  'vid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_kv')." ADD `vid` int(11) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_kv')) {
	if(!pdo_fieldexists('ims_siyuan_vod_kv',  'ji')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_kv')." ADD `ji` varchar(512) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_kv')) {
	if(!pdo_fieldexists('ims_siyuan_vod_kv',  'url')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_kv')." ADD `url` varchar(512) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_kv')) {
	if(!pdo_fieldexists('ims_siyuan_vod_kv',  'displayorder')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_kv')." ADD `displayorder` int(11) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_menu')) {
	if(!pdo_fieldexists('ims_siyuan_vod_menu',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_menu')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_menu')) {
	if(!pdo_fieldexists('ims_siyuan_vod_menu',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_menu')." ADD `weid` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_menu')) {
	if(!pdo_fieldexists('ims_siyuan_vod_menu',  'title')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_menu')." ADD `title` varchar(100) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_menu')) {
	if(!pdo_fieldexists('ims_siyuan_vod_menu',  'url')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_menu')." ADD `url` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_menu')) {
	if(!pdo_fieldexists('ims_siyuan_vod_menu',  'displayorder')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_menu')." ADD `displayorder` int(10) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_menu')) {
	if(!pdo_fieldexists('ims_siyuan_vod_menu',  'thumb')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_menu')." ADD `thumb` varchar(100) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_play_set')) {
	if(!pdo_fieldexists('ims_siyuan_vod_play_set',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_play_set')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_play_set')) {
	if(!pdo_fieldexists('ims_siyuan_vod_play_set',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_play_set')." ADD `weid` int(11) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_play_set')) {
	if(!pdo_fieldexists('ims_siyuan_vod_play_set',  'videojj_key')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_play_set')." ADD `videojj_key` varchar(100) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_play_set')) {
	if(!pdo_fieldexists('ims_siyuan_vod_play_set',  'playm3u8_key')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_play_set')." ADD `playm3u8_key` varchar(100) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_play_set')) {
	if(!pdo_fieldexists('ims_siyuan_vod_play_set',  'playm3u8_host')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_play_set')." ADD `playm3u8_host` varchar(100) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_play_set')) {
	if(!pdo_fieldexists('ims_siyuan_vod_play_set',  'playm3u8_title')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_play_set')." ADD `playm3u8_title` varchar(200) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_play_set')) {
	if(!pdo_fieldexists('ims_siyuan_vod_play_set',  'playm3u8_url')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_play_set')." ADD `playm3u8_url` varchar(150) DEFAULT 'http://www.playm3u8.com';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_play_set')) {
	if(!pdo_fieldexists('ims_siyuan_vod_play_set',  'playm3u8_site1')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_play_set')." ADD `playm3u8_site1` varchar(150) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_play_set')) {
	if(!pdo_fieldexists('ims_siyuan_vod_play_set',  'playm3u8_site2')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_play_set')." ADD `playm3u8_site2` varchar(150) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `weid` int(11) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'name')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `name` varchar(20);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'ad')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `ad` varchar(50);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'logo')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `logo` varchar(300);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'qr')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `qr` varchar(300);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'top_logo')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `top_logo` varchar(300);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `openid` varchar(100);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'color')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `color` varchar(10);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'ad_pic')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `ad_pic` varchar(200);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'ad_url')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `ad_url` varchar(200);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'vod_xiaoxi')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `vod_xiaoxi` varchar(100);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'bug_xiaoxi')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `bug_xiaoxi` varchar(100);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'open')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `open` int(1) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'time')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `time` int(10) NOT NULL DEFAULT '5000';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'bottom_name')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `bottom_name` varchar(50);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'bottom_ad')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `bottom_ad` varchar(100);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'bottom_logo')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `bottom_logo` varchar(300);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'bottom_qr')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `bottom_qr` varchar(250);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'tishi')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `tishi` varchar(500);");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'fengge')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `fengge` int(1) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'video_key')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `video_key` varchar(20) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_setting')) {
	if(!pdo_fieldexists('ims_siyuan_vod_setting',  'share_url')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_setting')." ADD `share_url` varchar(300) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_so')) {
	if(!pdo_fieldexists('ims_siyuan_vod_so',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_so')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_so')) {
	if(!pdo_fieldexists('ims_siyuan_vod_so',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_so')." ADD `weid` int(10) unsigned NOT NULL;");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_so')) {
	if(!pdo_fieldexists('ims_siyuan_vod_so',  'title')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_so')." ADD `title` varchar(100) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_so')) {
	if(!pdo_fieldexists('ims_siyuan_vod_so',  'vid')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_so')." ADD `vid` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_siyuan_vod_so')) {
	if(!pdo_fieldexists('ims_siyuan_vod_so',  'displayorder')) {
		pdo_query("ALTER TABLE ".tablename('ims_siyuan_vod_so')." ADD `displayorder` int(10) NOT NULL DEFAULT '0';");
	}	
}
