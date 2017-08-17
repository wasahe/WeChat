<?php

$sql =<<<EOF
CREATE TABLE IF NOT EXISTS `ims_meepo_xianchang_3d_config` (
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
EOF;
pdo_run($sql);
