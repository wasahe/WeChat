<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_cgc_guess` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uniacid` int(3) NOT NULL,
`logo` varchar(200) NOT NULL DEFAULT '',
`title` varchar(100) NOT NULL DEFAULT '',
`question` varchar(200) NOT NULL DEFAULT '',
`answera` varchar(200) NOT NULL DEFAULT '',
`answerb` varchar(200) NOT NULL DEFAULT '',
`answerc` varchar(200) NOT NULL DEFAULT '',
`answerd` varchar(200) NOT NULL DEFAULT '',
`answere` varchar(200) NOT NULL DEFAULT '',
`result` varchar(1) NOT NULL DEFAULT '',
`score` int(20) NOT NULL DEFAULT '0',
`createtime` int(10),
`type` int(1) DEFAULT '0',
`video_url` varchar(200) DEFAULT '',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

");
if(pdo_tableexists('ims_cgc_guess')) {
	if(!pdo_fieldexists('ims_cgc_guess',  'id')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_guess')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
	}	
}
if(pdo_tableexists('ims_cgc_guess')) {
	if(!pdo_fieldexists('ims_cgc_guess',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_guess')." ADD `uniacid` int(3) NOT NULL;");
	}	
}
if(pdo_tableexists('ims_cgc_guess')) {
	if(!pdo_fieldexists('ims_cgc_guess',  'logo')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_guess')." ADD `logo` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_cgc_guess')) {
	if(!pdo_fieldexists('ims_cgc_guess',  'title')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_guess')." ADD `title` varchar(100) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_cgc_guess')) {
	if(!pdo_fieldexists('ims_cgc_guess',  'question')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_guess')." ADD `question` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_cgc_guess')) {
	if(!pdo_fieldexists('ims_cgc_guess',  'answera')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_guess')." ADD `answera` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_cgc_guess')) {
	if(!pdo_fieldexists('ims_cgc_guess',  'answerb')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_guess')." ADD `answerb` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_cgc_guess')) {
	if(!pdo_fieldexists('ims_cgc_guess',  'answerc')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_guess')." ADD `answerc` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_cgc_guess')) {
	if(!pdo_fieldexists('ims_cgc_guess',  'answerd')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_guess')." ADD `answerd` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_cgc_guess')) {
	if(!pdo_fieldexists('ims_cgc_guess',  'answere')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_guess')." ADD `answere` varchar(200) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_cgc_guess')) {
	if(!pdo_fieldexists('ims_cgc_guess',  'result')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_guess')." ADD `result` varchar(1) NOT NULL DEFAULT '';");
	}	
}
if(pdo_tableexists('ims_cgc_guess')) {
	if(!pdo_fieldexists('ims_cgc_guess',  'score')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_guess')." ADD `score` int(20) NOT NULL DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_cgc_guess')) {
	if(!pdo_fieldexists('ims_cgc_guess',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_guess')." ADD `createtime` int(10);");
	}	
}
if(pdo_tableexists('ims_cgc_guess')) {
	if(!pdo_fieldexists('ims_cgc_guess',  'type')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_guess')." ADD `type` int(1) DEFAULT '0';");
	}	
}
if(pdo_tableexists('ims_cgc_guess')) {
	if(!pdo_fieldexists('ims_cgc_guess',  'video_url')) {
		pdo_query("ALTER TABLE ".tablename('ims_cgc_guess')." ADD `video_url` varchar(200) DEFAULT '';");
	}	
}
