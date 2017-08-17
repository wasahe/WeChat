<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_3d_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `placeholder_image_arr` text NOT NULL,
  `str` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_basic_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `mp_name` varchar(300) NOT NULL COMMENT '公众号名称',
  `mp_img` varchar(300) NOT NULL COMMENT '公众号二维码',
  `top_img` varchar(300) NOT NULL COMMENT '顶部logo',
  `top_title` varchar(2000) NOT NULL COMMENT '顶部滚动文字',
  `top_font_size` varchar(10) NOT NULL COMMENT '顶部文字大小',
  `bottom_img` varchar(300) NOT NULL COMMENT '底部logo',
  `bg_img` varchar(300) NOT NULL COMMENT '背景图片',
  `bottom_words` varchar(300) NOT NULL COMMENT '底部文字',
  `show_star` tinyint(1) NOT NULL DEFAULT '0',
  `show_leaf` tinyint(1) NOT NULL DEFAULT '1',
  `leaf_style` tinyint(1) NOT NULL DEFAULT '1',
  `basic_style` varchar(10) NOT NULL,
  `diy_css` text NOT NULL,
  `bg_music_on` tinyint(1) NOT NULL DEFAULT '0',
  `bg_music` varchar(300) NOT NULL,
  `bg_vedio` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_bd` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `show` tinyint(1) NOT NULL DEFAULT '1',
  `xm` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_bd_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `openid` varchar(100) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_cookie` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `cookie` varchar(300) NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_jb` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `displayid` int(10) NOT NULL DEFAULT '0',
  `name` varchar(300) NOT NULL COMMENT '昵称',
  `tx` varchar(300) NOT NULL COMMENT '头像',
  `des` text NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_lottory_award` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `displayid` int(11) NOT NULL,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `tag_num` int(11) NOT NULL DEFAULT '3',
  `luck_name` varchar(300) NOT NULL,
  `luck_img` varchar(300) NOT NULL,
  `tag_name` varchar(100) NOT NULL,
  `nd_id` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_lottory_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `title` varchar(200) NOT NULL,
  `send_mess` tinyint(1) NOT NULL DEFAULT '0',
  `def_mess` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_lottory_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `openid` varchar(100) NOT NULL,
  `nick_name` varchar(300) NOT NULL COMMENT '昵称',
  `avatar` varchar(300) NOT NULL COMMENT '头像',
  `user_id` int(11) NOT NULL,
  `lottory_id` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_qd` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `openid` varchar(100) NOT NULL,
  `nick_name` varchar(100) NOT NULL COMMENT '昵称',
  `avatar` varchar(300) NOT NULL COMMENT '活动开始时间',
  `level` int(1) NOT NULL DEFAULT '2' COMMENT '状态',
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_qd_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `title` varchar(300) NOT NULL DEFAULT '签到',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_redpack_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `tip_words` text NOT NULL,
  `guize` text NOT NULL,
  `weixin_pay` tinyint(1) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `appid` varchar(100) NOT NULL,
  `secret` varchar(100) NOT NULL,
  `mchid` varchar(30) NOT NULL,
  `signkey` varchar(100) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `_desc` varchar(100) NOT NULL,
  `all_nums` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_redpack_rotate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `money` varchar(100) NOT NULL DEFAULT '6.6',
  `all_money` varchar(100) NOT NULL DEFAULT '6.6',
  `min` varchar(100) NOT NULL DEFAULT '1',
  `max` varchar(100) NOT NULL DEFAULT '8.8',
  `redpack_num` int(10) NOT NULL,
  `get_num` int(10) NOT NULL DEFAULT '1',
  `gailv` int(10) NOT NULL DEFAULT '50',
  `countdown` int(10) NOT NULL DEFAULT '60',
  `zzs` varchar(500) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_redpack_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `rotate_id` int(10) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `nick_name` varchar(300) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `money` varchar(100) NOT NULL DEFAULT '0.0',
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_rid` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `title` varchar(200) NOT NULL COMMENT '活动标题',
  `start_time` int(11) NOT NULL COMMENT '活动开始时间',
  `end_time` int(11) NOT NULL COMMENT '活动结束时间',
  `controls` text NOT NULL,
  `gz_must` tinyint(1) NOT NULL DEFAULT '0',
  `gz_url` varchar(300) NOT NULL,
  `pass_word` varchar(20) NOT NULL COMMENT '场控密码',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_shake_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `ready_time` int(10) NOT NULL DEFAULT '5' COMMENT '预备时间',
  `title` varchar(200) NOT NULL,
  `paodao_color` varchar(100) NOT NULL COMMENT 'color',
  `shake_music` varchar(300) NOT NULL COMMENT 'music',
  `pp_img` varchar(300) NOT NULL COMMENT '品牌',
  `app_bg` varchar(300) NOT NULL,
  `point` int(11) NOT NULL,
  `award_again` tinyint(1) NOT NULL DEFAULT '2',
  `slogan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_shake_rotate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `pnum` int(10) NOT NULL DEFAULT '10' COMMENT '预备时间',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_shake_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `rotate_id` int(10) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `award` tinyint(1) NOT NULL DEFAULT '0',
  `createtime` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `nick_name` varchar(300) NOT NULL,
  `avatar` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `openid` varchar(100) NOT NULL,
  `nick_name` varchar(300) NOT NULL COMMENT '昵称',
  `avatar` varchar(300) NOT NULL COMMENT '头像',
  `sex` varchar(2) NOT NULL DEFAULT '0' COMMENT 'sex',
  `group` int(10) NOT NULL DEFAULT '0' COMMENT '分组',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isblacklist` tinyint(1) NOT NULL DEFAULT '1',
  `can_lottory` tinyint(1) NOT NULL DEFAULT '1',
  `nd_id` int(11) NOT NULL DEFAULT '0' COMMENT '分组',
  `createtime` int(11) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_vote` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `title` varchar(300) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `show_style` tinyint(1) NOT NULL,
  `vote_zhuti` varchar(300) NOT NULL,
  `vote_zhuti_img` varchar(300) NOT NULL,
  `vote_zhuti_des` text NOT NULL,
  `vote_more` tinyint(1) NOT NULL DEFAULT '1',
  `vote_nums` int(11) NOT NULL DEFAULT '2',
  `vote_start_time` int(11) NOT NULL,
  `vote_end_time` int(11) NOT NULL,
  `vote_show_result` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_vote_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `fid` int(11) NOT NULL DEFAULT '0',
  `vote_xm_id` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(100) NOT NULL,
  `nick_name` varchar(300) NOT NULL,
  `avatar` varchar(300) NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_vote_xms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `fid` int(11) NOT NULL DEFAULT '0',
  `displayid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(300) NOT NULL DEFAULT '2',
  `img` varchar(300) NOT NULL,
  `nums` int(11) NOT NULL DEFAULT '0',
  `show_style` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_wall` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `openid` varchar(120) NOT NULL COMMENT '粉丝标志',
  `nick_name` varchar(300) NOT NULL COMMENT '粉丝头像',
  `avatar` varchar(300) NOT NULL COMMENT '粉丝头像',
  `content` text NOT NULL COMMENT '内容',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `createtime` int(11) NOT NULL COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_wall_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '审核状态',
  `title` varchar(500) NOT NULL COMMENT '标题',
  `show_style` tinyint(1) NOT NULL DEFAULT '0',
  `show_type` tinyint(1) NOT NULL DEFAULT '0',
  `show_big` tinyint(1) NOT NULL DEFAULT '0',
  `show_big_time` int(11) NOT NULL DEFAULT '3',
  `re_time` int(10) NOT NULL DEFAULT '3',
  `show_time` int(10) NOT NULL DEFAULT '0',
  `chistory` int(10) NOT NULL DEFAULT '50',
  `forbidden_words` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_xc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL COMMENT '主公众号',
  `rid` int(10) NOT NULL DEFAULT '0' COMMENT '规则ID',
  `displayid` int(10) NOT NULL DEFAULT '0',
  `img` varchar(300) NOT NULL COMMENT '昵称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");
if(pdo_tableexists('meepo_xianchang_3d_config')) {
	if(!pdo_fieldexists('meepo_xianchang_3d_config',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_3d_config')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_3d_config')) {
	if(!pdo_fieldexists('meepo_xianchang_3d_config',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_3d_config')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_3d_config')) {
	if(!pdo_fieldexists('meepo_xianchang_3d_config',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_3d_config')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_3d_config')) {
	if(!pdo_fieldexists('meepo_xianchang_3d_config',  'placeholder_image_arr')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_3d_config')." ADD `placeholder_image_arr` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_3d_config')) {
	if(!pdo_fieldexists('meepo_xianchang_3d_config',  'str')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_3d_config')." ADD `str` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'mp_name')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `mp_name` varchar(300) NOT NULL   COMMENT '公众号名称';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'mp_img')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `mp_img` varchar(300) NOT NULL   COMMENT '公众号二维码';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'top_img')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `top_img` varchar(300) NOT NULL   COMMENT '顶部logo';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'top_title')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `top_title` varchar(2000) NOT NULL   COMMENT '顶部滚动文字';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'top_font_size')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `top_font_size` varchar(10) NOT NULL   COMMENT '顶部文字大小';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'bottom_img')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `bottom_img` varchar(300) NOT NULL   COMMENT '底部logo';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'bg_img')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `bg_img` varchar(300) NOT NULL   COMMENT '背景图片';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'bottom_words')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `bottom_words` varchar(300) NOT NULL   COMMENT '底部文字';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'show_star')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `show_star` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'show_leaf')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `show_leaf` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'leaf_style')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `leaf_style` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'basic_style')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `basic_style` varchar(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'diy_css')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `diy_css` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'bg_music_on')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `bg_music_on` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'bg_music')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `bg_music` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_basic_config')) {
	if(!pdo_fieldexists('meepo_xianchang_basic_config',  'bg_vedio')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_basic_config')." ADD `bg_vedio` varchar(500) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_bd')) {
	if(!pdo_fieldexists('meepo_xianchang_bd',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_bd')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_bd')) {
	if(!pdo_fieldexists('meepo_xianchang_bd',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_bd')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_bd')) {
	if(!pdo_fieldexists('meepo_xianchang_bd',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_bd')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_bd')) {
	if(!pdo_fieldexists('meepo_xianchang_bd',  'show')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_bd')." ADD `show` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_bd')) {
	if(!pdo_fieldexists('meepo_xianchang_bd',  'xm')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_bd')." ADD `xm` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_bd_data')) {
	if(!pdo_fieldexists('meepo_xianchang_bd_data',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_bd_data')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_bd_data')) {
	if(!pdo_fieldexists('meepo_xianchang_bd_data',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_bd_data')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_bd_data')) {
	if(!pdo_fieldexists('meepo_xianchang_bd_data',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_bd_data')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_bd_data')) {
	if(!pdo_fieldexists('meepo_xianchang_bd_data',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_bd_data')." ADD `openid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_bd_data')) {
	if(!pdo_fieldexists('meepo_xianchang_bd_data',  'data')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_bd_data')." ADD `data` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_cookie')) {
	if(!pdo_fieldexists('meepo_xianchang_cookie',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_cookie')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_cookie')) {
	if(!pdo_fieldexists('meepo_xianchang_cookie',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_cookie')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_cookie')) {
	if(!pdo_fieldexists('meepo_xianchang_cookie',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_cookie')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_cookie')) {
	if(!pdo_fieldexists('meepo_xianchang_cookie',  'cookie')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_cookie')." ADD `cookie` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_cookie')) {
	if(!pdo_fieldexists('meepo_xianchang_cookie',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_cookie')." ADD `createtime` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_jb')) {
	if(!pdo_fieldexists('meepo_xianchang_jb',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_jb')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_jb')) {
	if(!pdo_fieldexists('meepo_xianchang_jb',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_jb')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_jb')) {
	if(!pdo_fieldexists('meepo_xianchang_jb',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_jb')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_jb')) {
	if(!pdo_fieldexists('meepo_xianchang_jb',  'displayid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_jb')." ADD `displayid` int(10) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_jb')) {
	if(!pdo_fieldexists('meepo_xianchang_jb',  'name')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_jb')." ADD `name` varchar(300) NOT NULL   COMMENT '昵称';");
	}	
}
if(pdo_tableexists('meepo_xianchang_jb')) {
	if(!pdo_fieldexists('meepo_xianchang_jb',  'tx')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_jb')." ADD `tx` varchar(300) NOT NULL   COMMENT '头像';");
	}	
}
if(pdo_tableexists('meepo_xianchang_jb')) {
	if(!pdo_fieldexists('meepo_xianchang_jb',  'des')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_jb')." ADD `des` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_jb')) {
	if(!pdo_fieldexists('meepo_xianchang_jb',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_jb')." ADD `createtime` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_award')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_award',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_award')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_award')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_award',  'displayid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_award')." ADD `displayid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_award')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_award',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_award')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_award')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_award',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_award')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_award')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_award',  'tag_num')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_award')." ADD `tag_num` int(11) NOT NULL  DEFAULT 3 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_award')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_award',  'luck_name')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_award')." ADD `luck_name` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_award')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_award',  'luck_img')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_award')." ADD `luck_img` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_award')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_award',  'tag_name')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_award')." ADD `tag_name` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_award')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_award',  'nd_id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_award')." ADD `nd_id` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_config')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_config',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_config')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_config')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_config',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_config')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_config')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_config',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_config')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_config')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_config',  'title')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_config')." ADD `title` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_config')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_config',  'send_mess')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_config')." ADD `send_mess` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_config')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_config',  'def_mess')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_config')." ADD `def_mess` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_user')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_user',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_user')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_user')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_user',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_user')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_user')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_user',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_user')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_user')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_user',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_user')." ADD `openid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_user')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_user',  'nick_name')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_user')." ADD `nick_name` varchar(300) NOT NULL   COMMENT '昵称';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_user')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_user',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_user')." ADD `avatar` varchar(300) NOT NULL   COMMENT '头像';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_user')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_user',  'user_id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_user')." ADD `user_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_user')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_user',  'lottory_id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_user')." ADD `lottory_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_lottory_user')) {
	if(!pdo_fieldexists('meepo_xianchang_lottory_user',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_lottory_user')." ADD `createtime` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_qd')) {
	if(!pdo_fieldexists('meepo_xianchang_qd',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_qd')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_qd')) {
	if(!pdo_fieldexists('meepo_xianchang_qd',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_qd')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_qd')) {
	if(!pdo_fieldexists('meepo_xianchang_qd',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_qd')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_qd')) {
	if(!pdo_fieldexists('meepo_xianchang_qd',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_qd')." ADD `openid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_qd')) {
	if(!pdo_fieldexists('meepo_xianchang_qd',  'nick_name')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_qd')." ADD `nick_name` varchar(100) NOT NULL   COMMENT '昵称';");
	}	
}
if(pdo_tableexists('meepo_xianchang_qd')) {
	if(!pdo_fieldexists('meepo_xianchang_qd',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_qd')." ADD `avatar` varchar(300) NOT NULL   COMMENT '活动开始时间';");
	}	
}
if(pdo_tableexists('meepo_xianchang_qd')) {
	if(!pdo_fieldexists('meepo_xianchang_qd',  'level')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_qd')." ADD `level` int(1) NOT NULL  DEFAULT 2 COMMENT '状态';");
	}	
}
if(pdo_tableexists('meepo_xianchang_qd')) {
	if(!pdo_fieldexists('meepo_xianchang_qd',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_qd')." ADD `createtime` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_qd_config')) {
	if(!pdo_fieldexists('meepo_xianchang_qd_config',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_qd_config')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_qd_config')) {
	if(!pdo_fieldexists('meepo_xianchang_qd_config',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_qd_config')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_qd_config')) {
	if(!pdo_fieldexists('meepo_xianchang_qd_config',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_qd_config')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_qd_config')) {
	if(!pdo_fieldexists('meepo_xianchang_qd_config',  'status')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_qd_config')." ADD `status` int(1) NOT NULL  DEFAULT 1 COMMENT '状态';");
	}	
}
if(pdo_tableexists('meepo_xianchang_qd_config')) {
	if(!pdo_fieldexists('meepo_xianchang_qd_config',  'title')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_qd_config')." ADD `title` varchar(300) NOT NULL  DEFAULT 签到 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_config')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_config',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_config')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_config')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_config',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_config')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_config')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_config',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_config')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_config')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_config',  'tip_words')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_config')." ADD `tip_words` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_config')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_config',  'guize')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_config')." ADD `guize` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_config')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_config',  'weixin_pay')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_config')." ADD `weixin_pay` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_config')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_config',  'appid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_config')." ADD `appid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_config')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_config',  'secret')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_config')." ADD `secret` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_config')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_config',  'mchid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_config')." ADD `mchid` varchar(30) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_config')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_config',  'signkey')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_config')." ADD `signkey` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_config')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_config',  'ip')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_config')." ADD `ip` varchar(30) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_config')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_config',  '_desc')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_config')." ADD `_desc` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_config')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_config',  'all_nums')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_config')." ADD `all_nums` int(11) NOT NULL  DEFAULT 2 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_rotate',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_rotate')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_rotate',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_rotate')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_rotate',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_rotate')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_rotate',  'status')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_rotate')." ADD `status` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_rotate',  'type')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_rotate')." ADD `type` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_rotate',  'money')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_rotate')." ADD `money` varchar(100) NOT NULL  DEFAULT 6.6 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_rotate',  'all_money')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_rotate')." ADD `all_money` varchar(100) NOT NULL  DEFAULT 6.6 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_rotate',  'min')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_rotate')." ADD `min` varchar(100) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_rotate',  'max')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_rotate')." ADD `max` varchar(100) NOT NULL  DEFAULT 8.8 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_rotate',  'redpack_num')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_rotate')." ADD `redpack_num` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_rotate',  'get_num')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_rotate')." ADD `get_num` int(10) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_rotate',  'gailv')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_rotate')." ADD `gailv` int(10) NOT NULL  DEFAULT 50 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_rotate',  'countdown')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_rotate')." ADD `countdown` int(10) NOT NULL  DEFAULT 60 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_rotate',  'zzs')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_rotate')." ADD `zzs` varchar(500) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_rotate',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_rotate')." ADD `createtime` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_user')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_user',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_user')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_user')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_user',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_user')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_user')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_user',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_user')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_user')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_user',  'rotate_id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_user')." ADD `rotate_id` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_user')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_user',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_user')." ADD `openid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_user')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_user',  'nick_name')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_user')." ADD `nick_name` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_user')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_user',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_user')." ADD `avatar` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_user')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_user',  'money')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_user')." ADD `money` varchar(100) NOT NULL  DEFAULT 0.0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_redpack_user')) {
	if(!pdo_fieldexists('meepo_xianchang_redpack_user',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_redpack_user')." ADD `createtime` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_rid')) {
	if(!pdo_fieldexists('meepo_xianchang_rid',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_rid')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_rid')) {
	if(!pdo_fieldexists('meepo_xianchang_rid',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_rid')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_rid')) {
	if(!pdo_fieldexists('meepo_xianchang_rid',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_rid')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_rid')) {
	if(!pdo_fieldexists('meepo_xianchang_rid',  'title')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_rid')." ADD `title` varchar(200) NOT NULL   COMMENT '活动标题';");
	}	
}
if(pdo_tableexists('meepo_xianchang_rid')) {
	if(!pdo_fieldexists('meepo_xianchang_rid',  'start_time')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_rid')." ADD `start_time` int(11) NOT NULL   COMMENT '活动开始时间';");
	}	
}
if(pdo_tableexists('meepo_xianchang_rid')) {
	if(!pdo_fieldexists('meepo_xianchang_rid',  'end_time')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_rid')." ADD `end_time` int(11) NOT NULL   COMMENT '活动结束时间';");
	}	
}
if(pdo_tableexists('meepo_xianchang_rid')) {
	if(!pdo_fieldexists('meepo_xianchang_rid',  'controls')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_rid')." ADD `controls` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_rid')) {
	if(!pdo_fieldexists('meepo_xianchang_rid',  'gz_must')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_rid')." ADD `gz_must` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_rid')) {
	if(!pdo_fieldexists('meepo_xianchang_rid',  'gz_url')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_rid')." ADD `gz_url` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_rid')) {
	if(!pdo_fieldexists('meepo_xianchang_rid',  'pass_word')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_rid')." ADD `pass_word` varchar(20) NOT NULL   COMMENT '场控密码';");
	}	
}
if(pdo_tableexists('meepo_xianchang_rid')) {
	if(!pdo_fieldexists('meepo_xianchang_rid',  'status')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_rid')." ADD `status` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_config')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_config',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_config')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_config')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_config',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_config')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_config')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_config',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_config')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_config')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_config',  'ready_time')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_config')." ADD `ready_time` int(10) NOT NULL  DEFAULT 5 COMMENT '预备时间';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_config')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_config',  'title')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_config')." ADD `title` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_config')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_config',  'paodao_color')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_config')." ADD `paodao_color` varchar(100) NOT NULL   COMMENT 'color';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_config')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_config',  'shake_music')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_config')." ADD `shake_music` varchar(300) NOT NULL   COMMENT 'music';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_config')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_config',  'pp_img')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_config')." ADD `pp_img` varchar(300) NOT NULL   COMMENT '品牌';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_config')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_config',  'app_bg')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_config')." ADD `app_bg` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_config')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_config',  'point')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_config')." ADD `point` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_config')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_config',  'award_again')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_config')." ADD `award_again` tinyint(1) NOT NULL  DEFAULT 2 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_config')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_config',  'slogan')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_config')." ADD `slogan` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_rotate',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_rotate')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_rotate',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_rotate')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_rotate',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_rotate')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_rotate',  'pnum')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_rotate')." ADD `pnum` int(10) NOT NULL  DEFAULT 10 COMMENT '预备时间';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_rotate',  'status')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_rotate')." ADD `status` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_rotate')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_rotate',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_rotate')." ADD `createtime` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_user')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_user',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_user')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_user')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_user',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_user')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_user')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_user',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_user')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_user')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_user',  'rotate_id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_user')." ADD `rotate_id` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_user')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_user',  'count')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_user')." ADD `count` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_user')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_user',  'award')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_user')." ADD `award` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_user')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_user',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_user')." ADD `createtime` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_user')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_user',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_user')." ADD `openid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_user')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_user',  'nick_name')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_user')." ADD `nick_name` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_shake_user')) {
	if(!pdo_fieldexists('meepo_xianchang_shake_user',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_shake_user')." ADD `avatar` varchar(500) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_user')) {
	if(!pdo_fieldexists('meepo_xianchang_user',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_user')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_user')) {
	if(!pdo_fieldexists('meepo_xianchang_user',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_user')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_user')) {
	if(!pdo_fieldexists('meepo_xianchang_user',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_user')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_user')) {
	if(!pdo_fieldexists('meepo_xianchang_user',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_user')." ADD `openid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_user')) {
	if(!pdo_fieldexists('meepo_xianchang_user',  'nick_name')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_user')." ADD `nick_name` varchar(300) NOT NULL   COMMENT '昵称';");
	}	
}
if(pdo_tableexists('meepo_xianchang_user')) {
	if(!pdo_fieldexists('meepo_xianchang_user',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_user')." ADD `avatar` varchar(300) NOT NULL   COMMENT '头像';");
	}	
}
if(pdo_tableexists('meepo_xianchang_user')) {
	if(!pdo_fieldexists('meepo_xianchang_user',  'sex')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_user')." ADD `sex` varchar(2) NOT NULL  DEFAULT 0 COMMENT 'sex';");
	}	
}
if(pdo_tableexists('meepo_xianchang_user')) {
	if(!pdo_fieldexists('meepo_xianchang_user',  'group')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_user')." ADD `group` int(10) NOT NULL  DEFAULT 0 COMMENT '分组';");
	}	
}
if(pdo_tableexists('meepo_xianchang_user')) {
	if(!pdo_fieldexists('meepo_xianchang_user',  'status')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_user')." ADD `status` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_user')) {
	if(!pdo_fieldexists('meepo_xianchang_user',  'isblacklist')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_user')." ADD `isblacklist` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_user')) {
	if(!pdo_fieldexists('meepo_xianchang_user',  'can_lottory')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_user')." ADD `can_lottory` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_user')) {
	if(!pdo_fieldexists('meepo_xianchang_user',  'nd_id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_user')." ADD `nd_id` int(11) NOT NULL  DEFAULT 0 COMMENT '分组';");
	}	
}
if(pdo_tableexists('meepo_xianchang_user')) {
	if(!pdo_fieldexists('meepo_xianchang_user',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_user')." ADD `createtime` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_user')) {
	if(!pdo_fieldexists('meepo_xianchang_user',  'mobile')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_user')." ADD `mobile` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote')) {
	if(!pdo_fieldexists('meepo_xianchang_vote',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote')) {
	if(!pdo_fieldexists('meepo_xianchang_vote',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote')) {
	if(!pdo_fieldexists('meepo_xianchang_vote',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote')) {
	if(!pdo_fieldexists('meepo_xianchang_vote',  'title')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote')." ADD `title` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote')) {
	if(!pdo_fieldexists('meepo_xianchang_vote',  'status')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote')." ADD `status` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote')) {
	if(!pdo_fieldexists('meepo_xianchang_vote',  'show_style')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote')." ADD `show_style` tinyint(1) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote')) {
	if(!pdo_fieldexists('meepo_xianchang_vote',  'vote_zhuti')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote')." ADD `vote_zhuti` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote')) {
	if(!pdo_fieldexists('meepo_xianchang_vote',  'vote_zhuti_img')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote')." ADD `vote_zhuti_img` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote')) {
	if(!pdo_fieldexists('meepo_xianchang_vote',  'vote_zhuti_des')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote')." ADD `vote_zhuti_des` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote')) {
	if(!pdo_fieldexists('meepo_xianchang_vote',  'vote_more')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote')." ADD `vote_more` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote')) {
	if(!pdo_fieldexists('meepo_xianchang_vote',  'vote_nums')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote')." ADD `vote_nums` int(11) NOT NULL  DEFAULT 2 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote')) {
	if(!pdo_fieldexists('meepo_xianchang_vote',  'vote_start_time')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote')." ADD `vote_start_time` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote')) {
	if(!pdo_fieldexists('meepo_xianchang_vote',  'vote_end_time')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote')." ADD `vote_end_time` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote')) {
	if(!pdo_fieldexists('meepo_xianchang_vote',  'vote_show_result')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote')." ADD `vote_show_result` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_record')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_record',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_record')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_record')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_record',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_record')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_record')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_record',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_record')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_record')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_record',  'fid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_record')." ADD `fid` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_record')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_record',  'vote_xm_id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_record')." ADD `vote_xm_id` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_record')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_record',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_record')." ADD `openid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_record')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_record',  'nick_name')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_record')." ADD `nick_name` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_record')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_record',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_record')." ADD `avatar` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_record')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_record',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_record')." ADD `createtime` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_xms')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_xms',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_xms')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_xms')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_xms',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_xms')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_xms')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_xms',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_xms')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_xms')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_xms',  'fid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_xms')." ADD `fid` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_xms')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_xms',  'displayid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_xms')." ADD `displayid` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_xms')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_xms',  'name')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_xms')." ADD `name` varchar(300) NOT NULL  DEFAULT 2 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_xms')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_xms',  'img')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_xms')." ADD `img` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_xms')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_xms',  'nums')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_xms')." ADD `nums` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_vote_xms')) {
	if(!pdo_fieldexists('meepo_xianchang_vote_xms',  'show_style')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_vote_xms')." ADD `show_style` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall')) {
	if(!pdo_fieldexists('meepo_xianchang_wall',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall')) {
	if(!pdo_fieldexists('meepo_xianchang_wall',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall')) {
	if(!pdo_fieldexists('meepo_xianchang_wall',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall')) {
	if(!pdo_fieldexists('meepo_xianchang_wall',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall')." ADD `openid` varchar(120) NOT NULL   COMMENT '粉丝标志';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall')) {
	if(!pdo_fieldexists('meepo_xianchang_wall',  'nick_name')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall')." ADD `nick_name` varchar(300) NOT NULL   COMMENT '粉丝头像';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall')) {
	if(!pdo_fieldexists('meepo_xianchang_wall',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall')." ADD `avatar` varchar(300) NOT NULL   COMMENT '粉丝头像';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall')) {
	if(!pdo_fieldexists('meepo_xianchang_wall',  'content')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall')." ADD `content` text NOT NULL   COMMENT '内容';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall')) {
	if(!pdo_fieldexists('meepo_xianchang_wall',  'type')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall')." ADD `type` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '类型';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall')) {
	if(!pdo_fieldexists('meepo_xianchang_wall',  'status')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall')." ADD `status` tinyint(1) NOT NULL  DEFAULT 1 COMMENT '状态';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall')) {
	if(!pdo_fieldexists('meepo_xianchang_wall',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall')." ADD `createtime` int(11) NOT NULL   COMMENT '发送时间';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall_config')) {
	if(!pdo_fieldexists('meepo_xianchang_wall_config',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall_config')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall_config')) {
	if(!pdo_fieldexists('meepo_xianchang_wall_config',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall_config')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall_config')) {
	if(!pdo_fieldexists('meepo_xianchang_wall_config',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall_config')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall_config')) {
	if(!pdo_fieldexists('meepo_xianchang_wall_config',  'status')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall_config')." ADD `status` int(1) NOT NULL  DEFAULT 1 COMMENT '审核状态';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall_config')) {
	if(!pdo_fieldexists('meepo_xianchang_wall_config',  'title')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall_config')." ADD `title` varchar(500) NOT NULL   COMMENT '标题';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall_config')) {
	if(!pdo_fieldexists('meepo_xianchang_wall_config',  'show_style')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall_config')." ADD `show_style` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall_config')) {
	if(!pdo_fieldexists('meepo_xianchang_wall_config',  'show_type')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall_config')." ADD `show_type` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall_config')) {
	if(!pdo_fieldexists('meepo_xianchang_wall_config',  'show_big')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall_config')." ADD `show_big` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall_config')) {
	if(!pdo_fieldexists('meepo_xianchang_wall_config',  'show_big_time')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall_config')." ADD `show_big_time` int(11) NOT NULL  DEFAULT 3 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall_config')) {
	if(!pdo_fieldexists('meepo_xianchang_wall_config',  're_time')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall_config')." ADD `re_time` int(10) NOT NULL  DEFAULT 3 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall_config')) {
	if(!pdo_fieldexists('meepo_xianchang_wall_config',  'show_time')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall_config')." ADD `show_time` int(10) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall_config')) {
	if(!pdo_fieldexists('meepo_xianchang_wall_config',  'chistory')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall_config')." ADD `chistory` int(10) NOT NULL  DEFAULT 50 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_wall_config')) {
	if(!pdo_fieldexists('meepo_xianchang_wall_config',  'forbidden_words')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_wall_config')." ADD `forbidden_words` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_xc')) {
	if(!pdo_fieldexists('meepo_xianchang_xc',  'id')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_xc')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_xc')) {
	if(!pdo_fieldexists('meepo_xianchang_xc',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_xc')." ADD `weid` int(10) NOT NULL   COMMENT '主公众号';");
	}	
}
if(pdo_tableexists('meepo_xianchang_xc')) {
	if(!pdo_fieldexists('meepo_xianchang_xc',  'rid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_xc')." ADD `rid` int(10) NOT NULL  DEFAULT 0 COMMENT '规则ID';");
	}	
}
if(pdo_tableexists('meepo_xianchang_xc')) {
	if(!pdo_fieldexists('meepo_xianchang_xc',  'displayid')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_xc')." ADD `displayid` int(10) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('meepo_xianchang_xc')) {
	if(!pdo_fieldexists('meepo_xianchang_xc',  'img')) {
		pdo_query("ALTER TABLE ".tablename('meepo_xianchang_xc')." ADD `img` varchar(300) NOT NULL   COMMENT '昵称';");
	}	
}
