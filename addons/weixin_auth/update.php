<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_mp_app` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `m_id` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) unsigned NOT NULL,
  `create_time` int(10) unsigned NOT NULL,
  `token` char(32) NOT NULL,
  `encodingaeskey` char(43) NOT NULL,
  `url` varchar(200) NOT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '50',
  `desc` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_mp_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `w_id` int(10) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `appid` char(18) NOT NULL,
  `appsecret` char(32) NOT NULL,
  `token` char(32) NOT NULL,
  `encodingaeskey` char(43) NOT NULL,
  `is_yz` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1',
  `is_delete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL,
  `desc` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_mp_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `m_id` int(10) unsigned NOT NULL,
  `a_id` int(10) unsigned NOT NULL,
  `from_data` varchar(10000) NOT NULL,
  `send_data` varchar(10000) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");
if(pdo_tableexists('mp_app')) {
	if(!pdo_fieldexists('mp_app',  'id')) {
		pdo_query("ALTER TABLE ".tablename('mp_app')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('mp_app')) {
	if(!pdo_fieldexists('mp_app',  'name')) {
		pdo_query("ALTER TABLE ".tablename('mp_app')." ADD `name` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_app')) {
	if(!pdo_fieldexists('mp_app',  'm_id')) {
		pdo_query("ALTER TABLE ".tablename('mp_app')." ADD `m_id` int(11) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('mp_app')) {
	if(!pdo_fieldexists('mp_app',  'status')) {
		pdo_query("ALTER TABLE ".tablename('mp_app')." ADD `status` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('mp_app')) {
	if(!pdo_fieldexists('mp_app',  'is_delete')) {
		pdo_query("ALTER TABLE ".tablename('mp_app')." ADD `is_delete` tinyint(1) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_app')) {
	if(!pdo_fieldexists('mp_app',  'create_time')) {
		pdo_query("ALTER TABLE ".tablename('mp_app')." ADD `create_time` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_app')) {
	if(!pdo_fieldexists('mp_app',  'token')) {
		pdo_query("ALTER TABLE ".tablename('mp_app')." ADD `token` char(32) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_app')) {
	if(!pdo_fieldexists('mp_app',  'encodingaeskey')) {
		pdo_query("ALTER TABLE ".tablename('mp_app')." ADD `encodingaeskey` char(43) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_app')) {
	if(!pdo_fieldexists('mp_app',  'url')) {
		pdo_query("ALTER TABLE ".tablename('mp_app')." ADD `url` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_app')) {
	if(!pdo_fieldexists('mp_app',  'sort')) {
		pdo_query("ALTER TABLE ".tablename('mp_app')." ADD `sort` int(11) unsigned NOT NULL  DEFAULT 50 COMMENT '';");
	}	
}
if(pdo_tableexists('mp_app')) {
	if(!pdo_fieldexists('mp_app',  'desc')) {
		pdo_query("ALTER TABLE ".tablename('mp_app')." ADD `desc` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_list')) {
	if(!pdo_fieldexists('mp_list',  'id')) {
		pdo_query("ALTER TABLE ".tablename('mp_list')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('mp_list')) {
	if(!pdo_fieldexists('mp_list',  'w_id')) {
		pdo_query("ALTER TABLE ".tablename('mp_list')." ADD `w_id` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_list')) {
	if(!pdo_fieldexists('mp_list',  'name')) {
		pdo_query("ALTER TABLE ".tablename('mp_list')." ADD `name` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_list')) {
	if(!pdo_fieldexists('mp_list',  'appid')) {
		pdo_query("ALTER TABLE ".tablename('mp_list')." ADD `appid` char(18) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_list')) {
	if(!pdo_fieldexists('mp_list',  'appsecret')) {
		pdo_query("ALTER TABLE ".tablename('mp_list')." ADD `appsecret` char(32) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_list')) {
	if(!pdo_fieldexists('mp_list',  'token')) {
		pdo_query("ALTER TABLE ".tablename('mp_list')." ADD `token` char(32) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_list')) {
	if(!pdo_fieldexists('mp_list',  'encodingaeskey')) {
		pdo_query("ALTER TABLE ".tablename('mp_list')." ADD `encodingaeskey` char(43) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_list')) {
	if(!pdo_fieldexists('mp_list',  'is_yz')) {
		pdo_query("ALTER TABLE ".tablename('mp_list')." ADD `is_yz` tinyint(1) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('mp_list')) {
	if(!pdo_fieldexists('mp_list',  'status')) {
		pdo_query("ALTER TABLE ".tablename('mp_list')." ADD `status` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '1';");
	}	
}
if(pdo_tableexists('mp_list')) {
	if(!pdo_fieldexists('mp_list',  'is_delete')) {
		pdo_query("ALTER TABLE ".tablename('mp_list')." ADD `is_delete` tinyint(1) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('mp_list')) {
	if(!pdo_fieldexists('mp_list',  'create_time')) {
		pdo_query("ALTER TABLE ".tablename('mp_list')." ADD `create_time` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_list')) {
	if(!pdo_fieldexists('mp_list',  'desc')) {
		pdo_query("ALTER TABLE ".tablename('mp_list')." ADD `desc` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_log')) {
	if(!pdo_fieldexists('mp_log',  'id')) {
		pdo_query("ALTER TABLE ".tablename('mp_log')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('mp_log')) {
	if(!pdo_fieldexists('mp_log',  'm_id')) {
		pdo_query("ALTER TABLE ".tablename('mp_log')." ADD `m_id` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_log')) {
	if(!pdo_fieldexists('mp_log',  'a_id')) {
		pdo_query("ALTER TABLE ".tablename('mp_log')." ADD `a_id` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_log')) {
	if(!pdo_fieldexists('mp_log',  'from_data')) {
		pdo_query("ALTER TABLE ".tablename('mp_log')." ADD `from_data` varchar(10000) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_log')) {
	if(!pdo_fieldexists('mp_log',  'send_data')) {
		pdo_query("ALTER TABLE ".tablename('mp_log')." ADD `send_data` varchar(10000) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('mp_log')) {
	if(!pdo_fieldexists('mp_log',  'time')) {
		pdo_query("ALTER TABLE ".tablename('mp_log')." ADD `time` int(10) unsigned NOT NULL   COMMENT '';");
	}	
}
