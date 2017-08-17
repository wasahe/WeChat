<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_weixin_awardlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `displayid` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `luck_name` varchar(100) NOT NULL DEFAULT '' COMMENT '奖品名称',
  `luckid` int(10) NOT NULL DEFAULT '0' COMMENT '奖项活动ID来此关键词的rid也是按人数抽奖的id',
  `num` int(10) NOT NULL DEFAULT '0' COMMENT '此项奖品的已经中奖人数',
  `tag_name` varchar(100) NOT NULL DEFAULT '' COMMENT '第几等奖',
  `tagNum` int(10) NOT NULL DEFAULT '0' COMMENT '奖品数量',
  `num_exclude` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否准许按人数抽奖的时候重复中奖',
  `tag_exclude` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否准许按第几等奖抽奖的时候重复中奖',
  `nd` varchar(500) DEFAULT NULL COMMENT '内定抽奖粉丝ID字符串',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_weixin_bahe_prize` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `prize` text NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_weixin_bahe_team` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `old_team` tinyint(1) NOT NULL DEFAULT '0',
  `team` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(300) NOT NULL,
  `nickname` varchar(300) NOT NULL,
  `point` int(11) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_weixin_cookie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cookie` text NOT NULL,
  `cookies` text NOT NULL,
  `token` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_weixin_flag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `fakeid` varchar(100) NOT NULL,
  `flag` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `content` text NOT NULL,
  `sex` varchar(255) NOT NULL,
  `cjstatu` tinyint(4) NOT NULL DEFAULT '0',
  `rid` int(10) unsigned NOT NULL COMMENT '用户当前所在的微信墙话题',
  `isjoin` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否正在加入话题',
  `isblacklist` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户是否是黑名单',
  `lastupdate` int(10) unsigned NOT NULL COMMENT '用户最后发表时间',
  `verify` varchar(10) NOT NULL,
  `status` int(1) NOT NULL,
  `othid` int(10) NOT NULL,
  `sign` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户是否已经签到',
  `signtime` int(12) NOT NULL DEFAULT '0' COMMENT '用户签到时间',
  `getaward` int(12) NOT NULL DEFAULT '0',
  `msgid` varchar(12) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `award_id` varchar(20) NOT NULL DEFAULT 'meepo' COMMENT '是否正在加入话题',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_weixin_luckuser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `awardid` int(10) NOT NULL DEFAULT '0' COMMENT '奖项活动ID',
  `createtime` int(10) NOT NULL DEFAULT '0' COMMENT '中奖时间',
  `openid` varchar(200) NOT NULL DEFAULT '' COMMENT '粉丝标识',
  `bypername` varchar(200) DEFAULT NULL COMMENT '默认为空，只要选择了按人数才能有值',
  `rid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_weixin_mobile_manage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `rid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_weixin_mobile_upload` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  `previous_name` varchar(100) NOT NULL,
  `now_name` varchar(100) NOT NULL,
  `file_path` varchar(300) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_weixin_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `bg` varchar(300) NOT NULL,
  `modules_url` varchar(500) NOT NULL,
  `rid` int(11) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_weixin_shake_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `point` int(11) NOT NULL,
  `avatar` text NOT NULL,
  `rid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_weixin_shake_toshake` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `point` int(11) NOT NULL,
  `avatar` text NOT NULL,
  `rid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_weixin_signs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `rid` int(11) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_weixin_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `name` text NOT NULL,
  `vote_img` varchar(300) NOT NULL,
  `res` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_weixin_wall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `messageid` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `content` text NOT NULL,
  `nickname` text NOT NULL,
  `avatar` text NOT NULL,
  `ret` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image` text NOT NULL,
  `type` varchar(10) NOT NULL COMMENT '发表内容类型',
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示',
  `createtime` int(10) NOT NULL,
  `rid` int(10) unsigned NOT NULL COMMENT '用户当前所在的微信墙话题',
  `isblacklist` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_weixin_wall_num` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(10) NOT NULL COMMENT '用户当前所在的微信墙话题',
  `num` int(11) NOT NULL,
  `weid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_weixin_wall_reply` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rid` int(10) NOT NULL COMMENT '规则ID',
  `weid` int(10) NOT NULL,
  `enter_tips` varchar(300) NOT NULL DEFAULT '' COMMENT '进入提示',
  `subit_tips` varchar(300) NOT NULL DEFAULT '' COMMENT '首次关注进入提示',
  `quit_tips` varchar(300) NOT NULL DEFAULT '' COMMENT '退出提示',
  `send_tips` varchar(300) NOT NULL DEFAULT '' COMMENT '发表提示',
  `3dsign` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否需要审核',
  `3dsign_title` varchar(300) NOT NULL DEFAULT '' COMMENT '退出提示',
  `3dsign_bg` varchar(300) NOT NULL DEFAULT '' COMMENT '发表提示',
  `3dsign_join_words` varchar(300) NOT NULL DEFAULT '' COMMENT '退出提示',
  `3d_noavatar` varchar(300) NOT NULL DEFAULT '' COMMENT '发表提示',
  `3dsign_show_info` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否需要审核',
  `3dsign_logo` varchar(300) NOT NULL DEFAULT '' COMMENT '发表提示',
  `3dsign_words` varchar(300) NOT NULL DEFAULT '' COMMENT '发表提示',
  `3dsign_gap` int(10) NOT NULL DEFAULT '15' COMMENT '是否需要审核',
  `3dsign_persons` int(10) NOT NULL DEFAULT '200' COMMENT '是否需要审核',
  `table_time` int(10) NOT NULL DEFAULT '15' COMMENT '是否需要审核',
  `sphere_time` int(10) NOT NULL DEFAULT '15' COMMENT '是否需要审核',
  `helix_time` int(10) NOT NULL DEFAULT '15' COMMENT '是否需要审核',
  `grid_time` int(10) NOT NULL DEFAULT '15' COMMENT '是否需要审核',
  `quit_command` varchar(10) NOT NULL DEFAULT '' COMMENT '退出指令',
  `timeout` int(10) NOT NULL DEFAULT '0' COMMENT '超时时间',
  `isshow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否需要审核',
  `lurumobile` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否需要审核',
  `lurucheck` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否需要审核',
  `gz_must` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否需要审核',
  `chaoshi_tips` varchar(300) NOT NULL DEFAULT '' COMMENT '发表提示',
  `isopen` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '摇一摇状态',
  `votetitle` varchar(300) NOT NULL DEFAULT '' COMMENT '投票标题',
  `qdtitle` varchar(300) NOT NULL DEFAULT '' COMMENT '签到标题',
  `votepower` varchar(300) NOT NULL DEFAULT '' COMMENT '投票页面版权',
  `yyyzhuti` varchar(300) NOT NULL DEFAULT '' COMMENT '摇一摇主题',
  `cjname` varchar(300) NOT NULL DEFAULT '' COMMENT '抽奖名字',
  `cjimgurl` varchar(300) NOT NULL DEFAULT '' COMMENT '抽奖主题图片',
  `loginpass` varchar(300) NOT NULL DEFAULT '' COMMENT '主持人登录密码',
  `indexstyle` varchar(300) NOT NULL DEFAULT '' COMMENT '风格',
  `danmutime` int(10) NOT NULL DEFAULT '20' COMMENT '弹幕时间',
  `refreshtime` int(10) NOT NULL DEFAULT '0' COMMENT '刷新时间',
  `saytasktime` int(10) NOT NULL DEFAULT '0' COMMENT '刷新时间',
  `yyyendtime` int(10) NOT NULL DEFAULT '0' COMMENT '摇一摇结束总摇晃数目',
  `yyyshowperson` int(10) NOT NULL DEFAULT '0' COMMENT '摇一摇结果显示人数',
  `voterefreshtime` int(10) NOT NULL DEFAULT '0' COMMENT 'tp刷新时间',
  `qdqshow` int(10) NOT NULL DEFAULT '0' COMMENT '签到墙是否显示',
  `baheshow` int(10) NOT NULL DEFAULT '0' COMMENT '签到墙是否显示',
  `yyyshow` int(10) NOT NULL DEFAULT '0' COMMENT '摇一摇是否显示',
  `ddpshow` int(10) NOT NULL DEFAULT '0' COMMENT '对对碰是否显示',
  `tpshow` int(10) NOT NULL DEFAULT '0' COMMENT '投票是否显示',
  `cjshow` int(10) NOT NULL DEFAULT '0' COMMENT '抽奖是否显示',
  `danmushow` int(10) NOT NULL DEFAULT '0' COMMENT '抽奖是否显示',
  `cjnum_tag` int(10) NOT NULL DEFAULT '0' COMMENT '按人数抽奖是否开启',
  `cjnum_exclude` int(10) NOT NULL DEFAULT '0' COMMENT '按人数抽奖是否可以重复中奖',
  `cjtag_exclude` int(10) NOT NULL DEFAULT '0' COMMENT '按人数抽奖是否可以重复中奖',
  `defaultshow` int(10) NOT NULL DEFAULT '2' COMMENT '默认打开哪面墙',
  `yyyrealman` int(10) NOT NULL DEFAULT '0' COMMENT '真实人数',
  `yyybgimg` varchar(300) NOT NULL COMMENT '摇一摇背景',
  `danmubgimg` varchar(300) NOT NULL COMMENT '弹幕背景',
  `gz_url` varchar(300) NOT NULL COMMENT '弹幕背景',
  `bg_music` varchar(300) NOT NULL COMMENT '弹幕背景',
  `bg_music_on` tinyint(1) NOT NULL DEFAULT '0' COMMENT '真实人数',
  `image_open` tinyint(1) NOT NULL DEFAULT '0' COMMENT '真实人数',
  `bahe_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '真实人数',
  `saywords` varchar(300) NOT NULL COMMENT '摇一摇背景',
  `signwords` varchar(300) NOT NULL COMMENT '摇一摇背景',
  `cjwords` varchar(300) NOT NULL COMMENT '摇一摇背景',
  `votewords` varchar(300) NOT NULL COMMENT '摇一摇背景',
  `ddpwords` varchar(300) NOT NULL COMMENT '摇一摇背景',
  `danmuwords` varchar(300) NOT NULL COMMENT '弹幕标题',
  `toplogo` varchar(300) NOT NULL COMMENT '弹幕标题',
  `realman` int(10) DEFAULT NULL COMMENT '摇一摇随机抽取人数',
  `bgimg` varchar(100) DEFAULT NULL COMMENT '首页背景图片',
  `fontcolor` varchar(20) DEFAULT NULL COMMENT '文字颜色',
  `votemam` int(20) DEFAULT NULL COMMENT '投票总人数限制',
  `starttime` int(11) NOT NULL DEFAULT '0',
  `endtime` int(11) NOT NULL DEFAULT '0',
  `signcheck` tinyint(1) NOT NULL DEFAULT '2',
  `followagain` tinyint(1) NOT NULL DEFAULT '2',
  `renzhen` tinyint(1) NOT NULL DEFAULT '0',
  `erweima` varchar(300) NOT NULL,
  `yyy_keyword` varchar(50) NOT NULL,
  `tp_keyword` varchar(50) NOT NULL,
  `qd_keyword` varchar(50) NOT NULL,
  `login_bg` varchar(300) NOT NULL,
  `mg_words` text NOT NULL COMMENT '顶部标语',
  `webopen` int(10) NOT NULL DEFAULT '0' COMMENT '真实人数',
  `luru_words` text NOT NULL COMMENT '顶部标语',
  `sign_success` text NOT NULL COMMENT '顶部标语',
  `had_sign_content` text NOT NULL COMMENT '顶部标语',
  `danmufontcolor` varchar(30) NOT NULL DEFAULT '' COMMENT '进入提示',
  `danmufontsmall` int(11) NOT NULL DEFAULT '20',
  `danmufontbig` int(11) NOT NULL DEFAULT '40',
  `can_send` int(11) NOT NULL DEFAULT '1',
  `send_luck_words` varchar(300) NOT NULL DEFAULT '你中奖啦',
  `3dsign_logo_width` int(11) NOT NULL DEFAULT '400',
  `3dsign_logo_height` int(11) NOT NULL DEFAULT '400',
  `new_mess` tinyint(1) NOT NULL DEFAULT '1',
  `bahe_time` int(11) NOT NULL DEFAULT '20',
  `bahe_web_bg_image` varchar(300) NOT NULL DEFAULT '',
  `bahe_web_adv4_image` varchar(300) NOT NULL DEFAULT '',
  `bahe_web_adv3_image` varchar(300) NOT NULL DEFAULT '',
  `bahe_web_adv2_image` varchar(300) NOT NULL DEFAULT '',
  `bahe_web_adv1_image` varchar(300) NOT NULL DEFAULT '',
  `bahe_web_person4_image` varchar(300) NOT NULL DEFAULT '',
  `bahe_web_person3_image` varchar(300) NOT NULL DEFAULT '',
  `bahe_web_person2_image` varchar(300) NOT NULL DEFAULT '',
  `bahe_web_person1_image` varchar(300) NOT NULL DEFAULT '',
  `bahe_web_zhuti2_img` varchar(300) NOT NULL DEFAULT '',
  `bahe_web_zhuti1_img` varchar(300) NOT NULL DEFAULT '',
  `bahe_team2_image` varchar(300) NOT NULL DEFAULT '',
  `bahe_team1_image` varchar(300) NOT NULL DEFAULT '',
  `bahe_team2_name` varchar(300) NOT NULL DEFAULT '',
  `bahe_team1_name` varchar(300) NOT NULL DEFAULT '',
  `bahe_title` varchar(300) NOT NULL DEFAULT '',
  `bahe_joinwords` text NOT NULL,
  `bahe_bgmusic` varchar(300) NOT NULL DEFAULT '',
  `bahe_web_big_bg` varchar(300) NOT NULL DEFAULT '',
  `activity_starttime` int(11) NOT NULL DEFAULT '0',
  `activity_endtime` int(11) NOT NULL DEFAULT '0',
  `activity_title` varchar(300) NOT NULL DEFAULT '',
  `cj_config` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");
if(pdo_tableexists('weixin_awardlist')) {
	if(!pdo_fieldexists('weixin_awardlist',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_awardlist')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_awardlist')) {
	if(!pdo_fieldexists('weixin_awardlist',  'displayid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_awardlist')." ADD `displayid` int(10) NOT NULL  DEFAULT 0 COMMENT '排序';");
	}	
}
if(pdo_tableexists('weixin_awardlist')) {
	if(!pdo_fieldexists('weixin_awardlist',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_awardlist')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('weixin_awardlist')) {
	if(!pdo_fieldexists('weixin_awardlist',  'luck_name')) {
		pdo_query("ALTER TABLE ".tablename('weixin_awardlist')." ADD `luck_name` varchar(100) NOT NULL   COMMENT '奖品名称';");
	}	
}
if(pdo_tableexists('weixin_awardlist')) {
	if(!pdo_fieldexists('weixin_awardlist',  'luckid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_awardlist')." ADD `luckid` int(10) NOT NULL  DEFAULT 0 COMMENT '奖项活动ID来此关键词的rid也是按人数抽奖的id';");
	}	
}
if(pdo_tableexists('weixin_awardlist')) {
	if(!pdo_fieldexists('weixin_awardlist',  'num')) {
		pdo_query("ALTER TABLE ".tablename('weixin_awardlist')." ADD `num` int(10) NOT NULL  DEFAULT 0 COMMENT '此项奖品的已经中奖人数';");
	}	
}
if(pdo_tableexists('weixin_awardlist')) {
	if(!pdo_fieldexists('weixin_awardlist',  'tag_name')) {
		pdo_query("ALTER TABLE ".tablename('weixin_awardlist')." ADD `tag_name` varchar(100) NOT NULL   COMMENT '第几等奖';");
	}	
}
if(pdo_tableexists('weixin_awardlist')) {
	if(!pdo_fieldexists('weixin_awardlist',  'tagNum')) {
		pdo_query("ALTER TABLE ".tablename('weixin_awardlist')." ADD `tagNum` int(10) NOT NULL  DEFAULT 0 COMMENT '奖品数量';");
	}	
}
if(pdo_tableexists('weixin_awardlist')) {
	if(!pdo_fieldexists('weixin_awardlist',  'num_exclude')) {
		pdo_query("ALTER TABLE ".tablename('weixin_awardlist')." ADD `num_exclude` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '是否准许按人数抽奖的时候重复中奖';");
	}	
}
if(pdo_tableexists('weixin_awardlist')) {
	if(!pdo_fieldexists('weixin_awardlist',  'tag_exclude')) {
		pdo_query("ALTER TABLE ".tablename('weixin_awardlist')." ADD `tag_exclude` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '是否准许按第几等奖抽奖的时候重复中奖';");
	}	
}
if(pdo_tableexists('weixin_awardlist')) {
	if(!pdo_fieldexists('weixin_awardlist',  'nd')) {
		pdo_query("ALTER TABLE ".tablename('weixin_awardlist')." ADD `nd` varchar(500)    COMMENT '内定抽奖粉丝ID字符串';");
	}	
}
if(pdo_tableexists('weixin_bahe_prize')) {
	if(!pdo_fieldexists('weixin_bahe_prize',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_bahe_prize')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_bahe_prize')) {
	if(!pdo_fieldexists('weixin_bahe_prize',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_bahe_prize')." ADD `rid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_bahe_prize')) {
	if(!pdo_fieldexists('weixin_bahe_prize',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_bahe_prize')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_bahe_prize')) {
	if(!pdo_fieldexists('weixin_bahe_prize',  'prize')) {
		pdo_query("ALTER TABLE ".tablename('weixin_bahe_prize')." ADD `prize` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_bahe_prize')) {
	if(!pdo_fieldexists('weixin_bahe_prize',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_bahe_prize')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_bahe_team')) {
	if(!pdo_fieldexists('weixin_bahe_team',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_bahe_team')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_bahe_team')) {
	if(!pdo_fieldexists('weixin_bahe_team',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_bahe_team')." ADD `rid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_bahe_team')) {
	if(!pdo_fieldexists('weixin_bahe_team',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_bahe_team')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_bahe_team')) {
	if(!pdo_fieldexists('weixin_bahe_team',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_bahe_team')." ADD `openid` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_bahe_team')) {
	if(!pdo_fieldexists('weixin_bahe_team',  'old_team')) {
		pdo_query("ALTER TABLE ".tablename('weixin_bahe_team')." ADD `old_team` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_bahe_team')) {
	if(!pdo_fieldexists('weixin_bahe_team',  'team')) {
		pdo_query("ALTER TABLE ".tablename('weixin_bahe_team')." ADD `team` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_bahe_team')) {
	if(!pdo_fieldexists('weixin_bahe_team',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('weixin_bahe_team')." ADD `avatar` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_bahe_team')) {
	if(!pdo_fieldexists('weixin_bahe_team',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('weixin_bahe_team')." ADD `nickname` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_bahe_team')) {
	if(!pdo_fieldexists('weixin_bahe_team',  'point')) {
		pdo_query("ALTER TABLE ".tablename('weixin_bahe_team')." ADD `point` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_bahe_team')) {
	if(!pdo_fieldexists('weixin_bahe_team',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_bahe_team')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_cookie')) {
	if(!pdo_fieldexists('weixin_cookie',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_cookie')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_cookie')) {
	if(!pdo_fieldexists('weixin_cookie',  'cookie')) {
		pdo_query("ALTER TABLE ".tablename('weixin_cookie')." ADD `cookie` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_cookie')) {
	if(!pdo_fieldexists('weixin_cookie',  'cookies')) {
		pdo_query("ALTER TABLE ".tablename('weixin_cookie')." ADD `cookies` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_cookie')) {
	if(!pdo_fieldexists('weixin_cookie',  'token')) {
		pdo_query("ALTER TABLE ".tablename('weixin_cookie')." ADD `token` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_cookie')) {
	if(!pdo_fieldexists('weixin_cookie',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_cookie')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `openid` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'fakeid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `fakeid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'flag')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `flag` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'vote')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `vote` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `nickname` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `avatar` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'content')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `content` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'sex')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `sex` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'cjstatu')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `cjstatu` tinyint(4) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `rid` int(10) unsigned NOT NULL   COMMENT '用户当前所在的微信墙话题';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'isjoin')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `isjoin` tinyint(1) unsigned NOT NULL  DEFAULT 1 COMMENT '是否正在加入话题';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'isblacklist')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `isblacklist` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '用户是否是黑名单';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'lastupdate')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `lastupdate` int(10) unsigned NOT NULL   COMMENT '用户最后发表时间';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'verify')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `verify` varchar(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'status')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `status` int(1) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'othid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `othid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'sign')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `sign` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '用户是否已经签到';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'signtime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `signtime` int(12) NOT NULL  DEFAULT 0 COMMENT '用户签到时间';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'getaward')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `getaward` int(12) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'msgid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `msgid` varchar(12) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `mobile` varchar(15) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'realname')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `realname` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_flag')) {
	if(!pdo_fieldexists('weixin_flag',  'award_id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_flag')." ADD `award_id` varchar(20) NOT NULL  DEFAULT meepo COMMENT '是否正在加入话题';");
	}	
}
if(pdo_tableexists('weixin_luckuser')) {
	if(!pdo_fieldexists('weixin_luckuser',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_luckuser')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_luckuser')) {
	if(!pdo_fieldexists('weixin_luckuser',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_luckuser')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('weixin_luckuser')) {
	if(!pdo_fieldexists('weixin_luckuser',  'awardid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_luckuser')." ADD `awardid` int(10) NOT NULL  DEFAULT 0 COMMENT '奖项活动ID';");
	}	
}
if(pdo_tableexists('weixin_luckuser')) {
	if(!pdo_fieldexists('weixin_luckuser',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_luckuser')." ADD `createtime` int(10) NOT NULL  DEFAULT 0 COMMENT '中奖时间';");
	}	
}
if(pdo_tableexists('weixin_luckuser')) {
	if(!pdo_fieldexists('weixin_luckuser',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_luckuser')." ADD `openid` varchar(200) NOT NULL   COMMENT '粉丝标识';");
	}	
}
if(pdo_tableexists('weixin_luckuser')) {
	if(!pdo_fieldexists('weixin_luckuser',  'bypername')) {
		pdo_query("ALTER TABLE ".tablename('weixin_luckuser')." ADD `bypername` varchar(200)    COMMENT '默认为空，只要选择了按人数才能有值';");
	}	
}
if(pdo_tableexists('weixin_luckuser')) {
	if(!pdo_fieldexists('weixin_luckuser',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_luckuser')." ADD `rid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_mobile_manage')) {
	if(!pdo_fieldexists('weixin_mobile_manage',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_mobile_manage')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_mobile_manage')) {
	if(!pdo_fieldexists('weixin_mobile_manage',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_mobile_manage')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_mobile_manage')) {
	if(!pdo_fieldexists('weixin_mobile_manage',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('weixin_mobile_manage')." ADD `mobile` varchar(15) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_mobile_manage')) {
	if(!pdo_fieldexists('weixin_mobile_manage',  'realname')) {
		pdo_query("ALTER TABLE ".tablename('weixin_mobile_manage')." ADD `realname` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_mobile_manage')) {
	if(!pdo_fieldexists('weixin_mobile_manage',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_mobile_manage')." ADD `rid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_mobile_upload')) {
	if(!pdo_fieldexists('weixin_mobile_upload',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_mobile_upload')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_mobile_upload')) {
	if(!pdo_fieldexists('weixin_mobile_upload',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_mobile_upload')." ADD `rid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_mobile_upload')) {
	if(!pdo_fieldexists('weixin_mobile_upload',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_mobile_upload')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_mobile_upload')) {
	if(!pdo_fieldexists('weixin_mobile_upload',  'previous_name')) {
		pdo_query("ALTER TABLE ".tablename('weixin_mobile_upload')." ADD `previous_name` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_mobile_upload')) {
	if(!pdo_fieldexists('weixin_mobile_upload',  'now_name')) {
		pdo_query("ALTER TABLE ".tablename('weixin_mobile_upload')." ADD `now_name` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_mobile_upload')) {
	if(!pdo_fieldexists('weixin_mobile_upload',  'file_path')) {
		pdo_query("ALTER TABLE ".tablename('weixin_mobile_upload')." ADD `file_path` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_mobile_upload')) {
	if(!pdo_fieldexists('weixin_mobile_upload',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_mobile_upload')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_modules')) {
	if(!pdo_fieldexists('weixin_modules',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_modules')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_modules')) {
	if(!pdo_fieldexists('weixin_modules',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_modules')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_modules')) {
	if(!pdo_fieldexists('weixin_modules',  'name')) {
		pdo_query("ALTER TABLE ".tablename('weixin_modules')." ADD `name` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_modules')) {
	if(!pdo_fieldexists('weixin_modules',  'status')) {
		pdo_query("ALTER TABLE ".tablename('weixin_modules')." ADD `status` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_modules')) {
	if(!pdo_fieldexists('weixin_modules',  'bg')) {
		pdo_query("ALTER TABLE ".tablename('weixin_modules')." ADD `bg` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_modules')) {
	if(!pdo_fieldexists('weixin_modules',  'modules_url')) {
		pdo_query("ALTER TABLE ".tablename('weixin_modules')." ADD `modules_url` varchar(500) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_modules')) {
	if(!pdo_fieldexists('weixin_modules',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_modules')." ADD `rid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_modules')) {
	if(!pdo_fieldexists('weixin_modules',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_modules')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_shake_data')) {
	if(!pdo_fieldexists('weixin_shake_data',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_shake_data')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_shake_data')) {
	if(!pdo_fieldexists('weixin_shake_data',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_shake_data')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_shake_data')) {
	if(!pdo_fieldexists('weixin_shake_data',  'phone')) {
		pdo_query("ALTER TABLE ".tablename('weixin_shake_data')." ADD `phone` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_shake_data')) {
	if(!pdo_fieldexists('weixin_shake_data',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_shake_data')." ADD `openid` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_shake_data')) {
	if(!pdo_fieldexists('weixin_shake_data',  'point')) {
		pdo_query("ALTER TABLE ".tablename('weixin_shake_data')." ADD `point` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_shake_data')) {
	if(!pdo_fieldexists('weixin_shake_data',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('weixin_shake_data')." ADD `avatar` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_shake_data')) {
	if(!pdo_fieldexists('weixin_shake_data',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_shake_data')." ADD `rid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_shake_toshake')) {
	if(!pdo_fieldexists('weixin_shake_toshake',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_shake_toshake')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_shake_toshake')) {
	if(!pdo_fieldexists('weixin_shake_toshake',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_shake_toshake')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_shake_toshake')) {
	if(!pdo_fieldexists('weixin_shake_toshake',  'phone')) {
		pdo_query("ALTER TABLE ".tablename('weixin_shake_toshake')." ADD `phone` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_shake_toshake')) {
	if(!pdo_fieldexists('weixin_shake_toshake',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_shake_toshake')." ADD `openid` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_shake_toshake')) {
	if(!pdo_fieldexists('weixin_shake_toshake',  'point')) {
		pdo_query("ALTER TABLE ".tablename('weixin_shake_toshake')." ADD `point` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_shake_toshake')) {
	if(!pdo_fieldexists('weixin_shake_toshake',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('weixin_shake_toshake')." ADD `avatar` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_shake_toshake')) {
	if(!pdo_fieldexists('weixin_shake_toshake',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_shake_toshake')." ADD `rid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_signs')) {
	if(!pdo_fieldexists('weixin_signs',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_signs')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_signs')) {
	if(!pdo_fieldexists('weixin_signs',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_signs')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_signs')) {
	if(!pdo_fieldexists('weixin_signs',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_signs')." ADD `openid` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_signs')) {
	if(!pdo_fieldexists('weixin_signs',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('weixin_signs')." ADD `nickname` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_signs')) {
	if(!pdo_fieldexists('weixin_signs',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('weixin_signs')." ADD `avatar` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_signs')) {
	if(!pdo_fieldexists('weixin_signs',  'content')) {
		pdo_query("ALTER TABLE ".tablename('weixin_signs')." ADD `content` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_signs')) {
	if(!pdo_fieldexists('weixin_signs',  'status')) {
		pdo_query("ALTER TABLE ".tablename('weixin_signs')." ADD `status` tinyint(1) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_signs')) {
	if(!pdo_fieldexists('weixin_signs',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_signs')." ADD `rid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_signs')) {
	if(!pdo_fieldexists('weixin_signs',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_signs')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_vote')) {
	if(!pdo_fieldexists('weixin_vote',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_vote')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_vote')) {
	if(!pdo_fieldexists('weixin_vote',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_vote')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_vote')) {
	if(!pdo_fieldexists('weixin_vote',  'name')) {
		pdo_query("ALTER TABLE ".tablename('weixin_vote')." ADD `name` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_vote')) {
	if(!pdo_fieldexists('weixin_vote',  'vote_img')) {
		pdo_query("ALTER TABLE ".tablename('weixin_vote')." ADD `vote_img` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_vote')) {
	if(!pdo_fieldexists('weixin_vote',  'res')) {
		pdo_query("ALTER TABLE ".tablename('weixin_vote')." ADD `res` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_vote')) {
	if(!pdo_fieldexists('weixin_vote',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_vote')." ADD `rid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `openid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'messageid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `messageid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'num')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `num` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'content')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `content` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `nickname` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `avatar` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'ret')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `ret` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'status')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `status` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'image')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `image` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'type')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `type` varchar(10) NOT NULL   COMMENT '发表内容类型';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'isshow')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `isshow` tinyint(1) unsigned NOT NULL  DEFAULT 0 COMMENT '是否显示';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `rid` int(10) unsigned NOT NULL   COMMENT '用户当前所在的微信墙话题';");
	}	
}
if(pdo_tableexists('weixin_wall')) {
	if(!pdo_fieldexists('weixin_wall',  'isblacklist')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall')." ADD `isblacklist` int(1) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_num')) {
	if(!pdo_fieldexists('weixin_wall_num',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_num')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_num')) {
	if(!pdo_fieldexists('weixin_wall_num',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_num')." ADD `rid` int(10) NOT NULL   COMMENT '用户当前所在的微信墙话题';");
	}	
}
if(pdo_tableexists('weixin_wall_num')) {
	if(!pdo_fieldexists('weixin_wall_num',  'num')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_num')." ADD `num` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_num')) {
	if(!pdo_fieldexists('weixin_wall_num',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_num')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'id')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `id` int(10) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `rid` int(10) NOT NULL   COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `weid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'enter_tips')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `enter_tips` varchar(300) NOT NULL   COMMENT '进入提示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'subit_tips')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `subit_tips` varchar(300) NOT NULL   COMMENT '首次关注进入提示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'quit_tips')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `quit_tips` varchar(300) NOT NULL   COMMENT '退出提示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'send_tips')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `send_tips` varchar(300) NOT NULL   COMMENT '发表提示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  '3dsign')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `3dsign` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '是否需要审核';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  '3dsign_title')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `3dsign_title` varchar(300) NOT NULL   COMMENT '退出提示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  '3dsign_bg')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `3dsign_bg` varchar(300) NOT NULL   COMMENT '发表提示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  '3dsign_join_words')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `3dsign_join_words` varchar(300) NOT NULL   COMMENT '退出提示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  '3d_noavatar')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `3d_noavatar` varchar(300) NOT NULL   COMMENT '发表提示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  '3dsign_show_info')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `3dsign_show_info` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '是否需要审核';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  '3dsign_logo')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `3dsign_logo` varchar(300) NOT NULL   COMMENT '发表提示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  '3dsign_words')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `3dsign_words` varchar(300) NOT NULL   COMMENT '发表提示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  '3dsign_gap')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `3dsign_gap` int(10) NOT NULL  DEFAULT 15 COMMENT '是否需要审核';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  '3dsign_persons')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `3dsign_persons` int(10) NOT NULL  DEFAULT 200 COMMENT '是否需要审核';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'table_time')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `table_time` int(10) NOT NULL  DEFAULT 15 COMMENT '是否需要审核';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'sphere_time')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `sphere_time` int(10) NOT NULL  DEFAULT 15 COMMENT '是否需要审核';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'helix_time')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `helix_time` int(10) NOT NULL  DEFAULT 15 COMMENT '是否需要审核';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'grid_time')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `grid_time` int(10) NOT NULL  DEFAULT 15 COMMENT '是否需要审核';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'quit_command')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `quit_command` varchar(10) NOT NULL   COMMENT '退出指令';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'timeout')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `timeout` int(10) NOT NULL  DEFAULT 0 COMMENT '超时时间';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'isshow')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `isshow` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '是否需要审核';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'lurumobile')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `lurumobile` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '是否需要审核';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'lurucheck')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `lurucheck` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '是否需要审核';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'gz_must')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `gz_must` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '是否需要审核';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'chaoshi_tips')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `chaoshi_tips` varchar(300) NOT NULL   COMMENT '发表提示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'isopen')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `isopen` int(1) unsigned NOT NULL  DEFAULT 1 COMMENT '摇一摇状态';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'votetitle')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `votetitle` varchar(300) NOT NULL   COMMENT '投票标题';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'qdtitle')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `qdtitle` varchar(300) NOT NULL   COMMENT '签到标题';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'votepower')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `votepower` varchar(300) NOT NULL   COMMENT '投票页面版权';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'yyyzhuti')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `yyyzhuti` varchar(300) NOT NULL   COMMENT '摇一摇主题';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'cjname')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `cjname` varchar(300) NOT NULL   COMMENT '抽奖名字';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'cjimgurl')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `cjimgurl` varchar(300) NOT NULL   COMMENT '抽奖主题图片';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'loginpass')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `loginpass` varchar(300) NOT NULL   COMMENT '主持人登录密码';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'indexstyle')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `indexstyle` varchar(300) NOT NULL   COMMENT '风格';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'danmutime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `danmutime` int(10) NOT NULL  DEFAULT 20 COMMENT '弹幕时间';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'refreshtime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `refreshtime` int(10) NOT NULL  DEFAULT 0 COMMENT '刷新时间';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'saytasktime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `saytasktime` int(10) NOT NULL  DEFAULT 0 COMMENT '刷新时间';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'yyyendtime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `yyyendtime` int(10) NOT NULL  DEFAULT 0 COMMENT '摇一摇结束总摇晃数目';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'yyyshowperson')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `yyyshowperson` int(10) NOT NULL  DEFAULT 0 COMMENT '摇一摇结果显示人数';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'voterefreshtime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `voterefreshtime` int(10) NOT NULL  DEFAULT 0 COMMENT 'tp刷新时间';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'qdqshow')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `qdqshow` int(10) NOT NULL  DEFAULT 0 COMMENT '签到墙是否显示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'baheshow')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `baheshow` int(10) NOT NULL  DEFAULT 0 COMMENT '签到墙是否显示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'yyyshow')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `yyyshow` int(10) NOT NULL  DEFAULT 0 COMMENT '摇一摇是否显示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'ddpshow')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `ddpshow` int(10) NOT NULL  DEFAULT 0 COMMENT '对对碰是否显示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'tpshow')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `tpshow` int(10) NOT NULL  DEFAULT 0 COMMENT '投票是否显示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'cjshow')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `cjshow` int(10) NOT NULL  DEFAULT 0 COMMENT '抽奖是否显示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'danmushow')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `danmushow` int(10) NOT NULL  DEFAULT 0 COMMENT '抽奖是否显示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'cjnum_tag')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `cjnum_tag` int(10) NOT NULL  DEFAULT 0 COMMENT '按人数抽奖是否开启';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'cjnum_exclude')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `cjnum_exclude` int(10) NOT NULL  DEFAULT 0 COMMENT '按人数抽奖是否可以重复中奖';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'cjtag_exclude')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `cjtag_exclude` int(10) NOT NULL  DEFAULT 0 COMMENT '按人数抽奖是否可以重复中奖';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'defaultshow')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `defaultshow` int(10) NOT NULL  DEFAULT 2 COMMENT '默认打开哪面墙';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'yyyrealman')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `yyyrealman` int(10) NOT NULL  DEFAULT 0 COMMENT '真实人数';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'yyybgimg')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `yyybgimg` varchar(300) NOT NULL   COMMENT '摇一摇背景';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'danmubgimg')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `danmubgimg` varchar(300) NOT NULL   COMMENT '弹幕背景';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'gz_url')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `gz_url` varchar(300) NOT NULL   COMMENT '弹幕背景';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bg_music')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bg_music` varchar(300) NOT NULL   COMMENT '弹幕背景';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bg_music_on')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bg_music_on` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '真实人数';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'image_open')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `image_open` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '真实人数';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_status')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_status` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '真实人数';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'saywords')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `saywords` varchar(300) NOT NULL   COMMENT '摇一摇背景';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'signwords')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `signwords` varchar(300) NOT NULL   COMMENT '摇一摇背景';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'cjwords')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `cjwords` varchar(300) NOT NULL   COMMENT '摇一摇背景';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'votewords')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `votewords` varchar(300) NOT NULL   COMMENT '摇一摇背景';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'ddpwords')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `ddpwords` varchar(300) NOT NULL   COMMENT '摇一摇背景';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'danmuwords')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `danmuwords` varchar(300) NOT NULL   COMMENT '弹幕标题';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'toplogo')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `toplogo` varchar(300) NOT NULL   COMMENT '弹幕标题';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'realman')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `realman` int(10)    COMMENT '摇一摇随机抽取人数';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bgimg')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bgimg` varchar(100)    COMMENT '首页背景图片';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'fontcolor')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `fontcolor` varchar(20)    COMMENT '文字颜色';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'votemam')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `votemam` int(20)    COMMENT '投票总人数限制';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'starttime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `starttime` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'endtime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `endtime` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'signcheck')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `signcheck` tinyint(1) NOT NULL  DEFAULT 2 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'followagain')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `followagain` tinyint(1) NOT NULL  DEFAULT 2 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'renzhen')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `renzhen` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'erweima')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `erweima` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'yyy_keyword')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `yyy_keyword` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'tp_keyword')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `tp_keyword` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'qd_keyword')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `qd_keyword` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'login_bg')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `login_bg` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'mg_words')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `mg_words` text NOT NULL   COMMENT '顶部标语';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'webopen')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `webopen` int(10) NOT NULL  DEFAULT 0 COMMENT '真实人数';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'luru_words')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `luru_words` text NOT NULL   COMMENT '顶部标语';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'sign_success')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `sign_success` text NOT NULL   COMMENT '顶部标语';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'had_sign_content')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `had_sign_content` text NOT NULL   COMMENT '顶部标语';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'danmufontcolor')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `danmufontcolor` varchar(30) NOT NULL   COMMENT '进入提示';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'danmufontsmall')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `danmufontsmall` int(11) NOT NULL  DEFAULT 20 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'danmufontbig')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `danmufontbig` int(11) NOT NULL  DEFAULT 40 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'can_send')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `can_send` int(11) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'send_luck_words')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `send_luck_words` varchar(300) NOT NULL  DEFAULT 你中奖啦 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  '3dsign_logo_width')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `3dsign_logo_width` int(11) NOT NULL  DEFAULT 400 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  '3dsign_logo_height')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `3dsign_logo_height` int(11) NOT NULL  DEFAULT 400 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'new_mess')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `new_mess` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_time')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_time` int(11) NOT NULL  DEFAULT 20 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_web_bg_image')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_web_bg_image` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_web_adv4_image')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_web_adv4_image` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_web_adv3_image')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_web_adv3_image` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_web_adv2_image')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_web_adv2_image` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_web_adv1_image')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_web_adv1_image` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_web_person4_image')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_web_person4_image` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_web_person3_image')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_web_person3_image` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_web_person2_image')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_web_person2_image` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_web_person1_image')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_web_person1_image` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_web_zhuti2_img')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_web_zhuti2_img` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_web_zhuti1_img')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_web_zhuti1_img` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_team2_image')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_team2_image` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_team1_image')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_team1_image` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_team2_name')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_team2_name` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_team1_name')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_team1_name` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_title')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_title` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_joinwords')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_joinwords` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_bgmusic')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_bgmusic` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'bahe_web_big_bg')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `bahe_web_big_bg` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'activity_starttime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `activity_starttime` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'activity_endtime')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `activity_endtime` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'activity_title')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `activity_title` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('weixin_wall_reply')) {
	if(!pdo_fieldexists('weixin_wall_reply',  'cj_config')) {
		pdo_query("ALTER TABLE ".tablename('weixin_wall_reply')." ADD `cj_config` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
