<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_cgc_ad_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `quan_id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `from_user` varchar(50) NOT NULL DEFAULT '',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(50) NOT NULL DEFAULT '',
  `headimgurl` varchar(300) NOT NULL DEFAULT '',
  `total_amount` decimal(10,2) NOT NULL,
  `total_num` int(11) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `images` text,
  `link` varchar(255) DEFAULT NULL,
  `telphone` varchar(20) DEFAULT NULL,
  `publish_time` int(11) DEFAULT NULL,
  `hot_time` int(11) NOT NULL DEFAULT '0',
  `top_level` int(11) NOT NULL DEFAULT '0',
  `rob_start_time` int(11) DEFAULT '0',
  `total_pay` decimal(10,2) DEFAULT NULL,
  `pay` decimal(10,2) DEFAULT NULL,
  `logid` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `rob_status` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `links` int(11) NOT NULL DEFAULT '0',
  `rob_plan` mediumtext NOT NULL,
  `rob_amount` decimal(10,2) DEFAULT '0.00',
  `rob_users` int(11) NOT NULL DEFAULT '0',
  `rob_end_time` int(11) DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `del` tinyint(1) DEFAULT '0',
  `op` tinyint(1) DEFAULT NULL,
  `op_remark` text,
  `op_admin` int(11) DEFAULT NULL,
  `kouling` varchar(255) NOT NULL,
  `is_open` int(1) DEFAULT '0',
  `is_pl` int(1) DEFAULT '0',
  `is_message` int(1) DEFAULT '0',
  `is_kouling` int(1) DEFAULT '0',
  `is_up` int(1) DEFAULT '0',
  `model` tinyint(1) DEFAULT '1',
  `group_size` smallint(6) DEFAULT NULL,
  `type` int(2) NOT NULL DEFAULT '1',
  `qr_code` varchar(250) DEFAULT NULL,
  `time_limit` int(1) DEFAULT '0',
  `time_limit_start` varchar(50) DEFAULT NULL,
  `time_limit_end` varchar(50) DEFAULT NULL,
  `job_submission_time` int(10) DEFAULT '0',
  `allocation_way` int(1) DEFAULT '0',
  `hx_status` tinyint(1) DEFAULT '0',
  `hx_pass` varchar(255) DEFAULT NULL,
  `wx_cardid` varchar(255) DEFAULT NULL,
  `share_url` varchar(255) DEFAULT '',
  `task_submit_switch` int(1) DEFAULT '0',
  `share_desc` varchar(255) DEFAULT '',
  `message_send` tinyint(1) NOT NULL DEFAULT '0',
  `wechat_sn` varchar(300) NOT NULL DEFAULT '',
  `addr_forward` int(1) DEFAULT '0',
  `addr_forward_url` varchar(255) DEFAULT '',
  `city` varchar(255) DEFAULT '',
  `fl_type` tinyint(1) DEFAULT '0',
  `summary` text,
  `couponc_images` text NOT NULL,
  `couponc_rule` text NOT NULL,
  `couponc_detail` varchar(255) NOT NULL DEFAULT '',
  `couponc_miaosha` varchar(255) NOT NULL DEFAULT '',
  `couponc_tel` varchar(255) NOT NULL DEFAULT '',
  `couponc_add` varchar(500) NOT NULL DEFAULT '',
  `couponc_shoper` varchar(255) NOT NULL DEFAULT '',
  `couponc_gift` varchar(255) NOT NULL DEFAULT '',
  `couponc_money` int(11) NOT NULL DEFAULT '0',
  `couponc_discount` int(11) NOT NULL DEFAULT '0',
  `company_name` varchar(255) NOT NULL DEFAULT '',
  `couponc_type` tinyint(1) NOT NULL,
  `couponc_name` varchar(255) NOT NULL,
  `hx_pwd` varchar(255) NOT NULL,
  `couponc_valid_date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `cgc_ad_adv_key1` (`weid`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL,
  `quan_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `content` text,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(1) DEFAULT '0',
  `url` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_couponc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `quan_id` int(11) NOT NULL,
  `advid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `company_name` varchar(255) NOT NULL DEFAULT '',
  `couponc_type` tinyint(1) NOT NULL DEFAULT '0',
  `couponc_name` varchar(255) NOT NULL DEFAULT '',
  `couponc_valid_date` int(11) NOT NULL DEFAULT '0',
  `couponc_discount` int(11) NOT NULL DEFAULT '0',
  `couponc_money` int(11) NOT NULL DEFAULT '0',
  `couponc_gift` varchar(255) NOT NULL DEFAULT '',
  `couponc_shoper` varchar(255) NOT NULL DEFAULT '',
  `couponc_add` varchar(500) NOT NULL DEFAULT '',
  `couponc_tel` varchar(255) NOT NULL DEFAULT '',
  `couponc_detail` varchar(255) NOT NULL DEFAULT '',
  `couponc_rule` text NOT NULL,
  `couponc_images` text NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `status_time` int(11) NOT NULL,
  `couponc_miaosha` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `quan_id` int(11) NOT NULL,
  `advid` int(11) NOT NULL,
  `captain_id` int(11) NOT NULL,
  `captain_nickname` varchar(80) NOT NULL,
  `mine_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nickname` varchar(80) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `headimgurl` varchar(255) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `quan_id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `helper_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL,
  `quan_id` int(11) NOT NULL,
  `uid` int(10) NOT NULL,
  `from_user` varchar(50) NOT NULL DEFAULT '',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(50) NOT NULL DEFAULT '',
  `headimgurl` varchar(250) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL,
  `nicheng` varchar(255) NOT NULL,
  `status` int(2) NOT NULL,
  `credit` decimal(10,2) DEFAULT '0.00',
  `fabu` decimal(10,2) DEFAULT '0.00',
  `rob` decimal(10,2) DEFAULT '0.00',
  `up_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `follow` tinyint(1) DEFAULT '0',
  `follow_time` int(10) DEFAULT '0',
  `type` int(2) NOT NULL,
  `last_city` varchar(255) NOT NULL,
  `createtime` int(10) NOT NULL,
  `rob_next_time` int(10) NOT NULL DEFAULT '0',
  `fstatus` int(1) DEFAULT '0',
  `is_revice` int(1) DEFAULT '0',
  `inviter_id` int(10) DEFAULT '0',
  `qr_code` varchar(250) DEFAULT NULL,
  `telphone` varchar(20) DEFAULT NULL,
  `message_notify` int(1) NOT NULL DEFAULT '0',
  `ori_openid` varchar(255) DEFAULT '',
  `no_account_amount` decimal(10,2) DEFAULT '0.00',
  `fee` decimal(10,2) DEFAULT '0.00',
  `qrcode_imge` varchar(500) DEFAULT NULL,
  `qrcode_poster` varchar(500) DEFAULT NULL,
  `poster_time` int(11) DEFAULT NULL,
  `vip_id` varchar(20) DEFAULT NULL,
  `vip_name` varchar(20) DEFAULT NULL,
  `vip_recharge` decimal(10,2) DEFAULT '0.00',
  `vip_rob` decimal(10,2) DEFAULT '0.00',
  `credit1` decimal(10,2) DEFAULT NULL,
  `credit2` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cgc_ad_member_key1` (`weid`,`quan_id`,`openid`),
  KEY `cgc_ad_member_key2` (`weid`,`quan_id`,`id`),
  KEY `cgc_ad_member_key3` (`weid`,`quan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT NULL,
  `advid` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL,
  `upbdate` varchar(244) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_paylog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL,
  `quan_id` int(11) DEFAULT NULL,
  `advid` int(11) DEFAULT NULL,
  `total_amount` float(244,2) DEFAULT NULL,
  `upbdate` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_poster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `quan_id` int(11) NOT NULL,
  `quan_name` varchar(255) NOT NULL,
  `bg` varchar(255) DEFAULT '',
  `data` text,
  `keyword` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `waittext` varchar(255) DEFAULT '',
  `oktext` varchar(255) DEFAULT '',
  `subtext` varchar(255) DEFAULT '',
  `templateid` varchar(255) DEFAULT '',
  `entrytext` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`weid`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_pv` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL,
  `quan_id` int(10) NOT NULL,
  `mid` int(10) NOT NULL,
  `advid` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_quan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `aname` varchar(255) NOT NULL,
  `notice` text,
  `rule` text,
  `begin_time` tinyint(2) NOT NULL,
  `over_time` tinyint(2) NOT NULL,
  `cold_time` smallint(6) NOT NULL,
  `total_min` decimal(10,2) DEFAULT NULL,
  `total_max` decimal(10,2) DEFAULT NULL,
  `avg_min` decimal(10,2) DEFAULT NULL,
  `percent` decimal(10,2) DEFAULT NULL,
  `tx_min` decimal(10,2) DEFAULT NULL,
  `top_line` decimal(10,2) DEFAULT NULL,
  `follow_logo` varchar(255) NOT NULL,
  `follow_url` text,
  `sharetitle` varchar(255) NOT NULL,
  `sharedesc` varchar(255) NOT NULL,
  `sharelogo` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `shenhe` tinyint(1) DEFAULT '0',
  `del` tinyint(1) DEFAULT '0',
  `is_message` int(1) DEFAULT '1',
  `is_follow` int(1) DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `last_city` varchar(255) NOT NULL,
  `is_pl` int(1) DEFAULT '0',
  `piece_model` varchar(255) DEFAULT NULL,
  `groupmax` smallint(6) NOT NULL,
  `total_min2` decimal(10,2) NOT NULL,
  `total_max2` decimal(10,2) NOT NULL,
  `avg_min2` decimal(10,2) NOT NULL,
  `up_rob_fee` decimal(10,2) NOT NULL,
  `up_send_fee` decimal(10,2) NOT NULL,
  `total_min4` decimal(10,2) DEFAULT NULL,
  `total_max4` decimal(10,2) DEFAULT NULL,
  `avg_min4` decimal(10,2) DEFAULT NULL,
  `tx_follow` int(1) NOT NULL DEFAULT '0',
  `pp_mode` int(1) DEFAULT '0',
  `pp_openid` text,
  `task_submit_switch` tinyint(1) DEFAULT '0',
  `group_guanzhu` tinyint(1) DEFAULT '0',
  `hx_switch` tinyint(1) DEFAULT '0',
  `views` int(10) DEFAULT '0',
  `yun_fkz` tinyint(1) DEFAULT '0',
  `yun_rule` text,
  `guanzhu_qrcode` varchar(255) NOT NULL DEFAULT '',
  `guanzhu_name` varchar(50) NOT NULL DEFAULT '',
  `guanzhu_direct` tinyint(1) DEFAULT '0',
  `task_guanzhu` tinyint(1) DEFAULT '0',
  `kf_openid` text,
  `guanzhu_note` text,
  `guanzhu_key` varchar(255) DEFAULT '',
  `total_min5` decimal(10,2) DEFAULT NULL,
  `total_max5` decimal(10,2) DEFAULT NULL,
  `avg_min5` decimal(10,2) DEFAULT NULL,
  `tx_control` int(1) DEFAULT '0',
  `tx_num` int(1) DEFAULT '0',
  `tx_money` int(11) DEFAULT '0',
  `total_min6` decimal(10,2) DEFAULT NULL,
  `total_max6` decimal(10,2) DEFAULT NULL,
  `avg_min6` decimal(10,2) DEFAULT NULL,
  `total_min7` decimal(10,2) DEFAULT NULL,
  `total_max7` decimal(10,2) DEFAULT NULL,
  `avg_min7` decimal(10,2) DEFAULT NULL,
  `addr_forward` int(1) DEFAULT '0',
  `tx_percent` int(3) DEFAULT '0',
  `hx_show` int(1) DEFAULT '0',
  `menu_name` varchar(30) DEFAULT '',
  `menu_url` varchar(255) DEFAULT '',
  `regular_user_momeny` int(11) DEFAULT '0',
  `click_multiple` int(11) DEFAULT '0',
  `vip_valid` int(1) DEFAULT '0',
  `addr_forward_url` varchar(255) DEFAULT '',
  `forbidden_addr` varchar(100) DEFAULT '',
  `piece_model_authority` varchar(30) DEFAULT '',
  `message_notify` tinyint(1) NOT NULL DEFAULT '0',
  `total_min8` decimal(10,2) DEFAULT NULL,
  `total_max8` decimal(10,2) DEFAULT NULL,
  `avg_min8` decimal(10,2) DEFAULT NULL,
  `is_page_follow` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_red` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `quan_id` int(11) NOT NULL,
  `advid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `money` decimal(10,2) DEFAULT NULL,
  `up_money` decimal(10,2) DEFAULT NULL,
  `total_money` decimal(10,2) DEFAULT NULL,
  `is_luck` int(11) DEFAULT NULL,
  `is_shit` int(11) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `hx_status` tinyint(1) DEFAULT '0',
  `wx_code` varchar(32) DEFAULT NULL,
  `share_app_message_count` int(5) DEFAULT '0',
  `share_time_line_count` int(5) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `cgc_ad_red_key1` (`weid`,`quan_id`,`advid`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL,
  `ruleid` int(10) NOT NULL,
  `quan_id` int(10) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_thumb` varchar(255) NOT NULL,
  `news_content` varchar(255) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_setting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL,
  `appid` varchar(255) NOT NULL,
  `secret` varchar(32) NOT NULL,
  `mchid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `qn_ak` varchar(255) NOT NULL,
  `qn_sk` varchar(255) NOT NULL,
  `qn_bucket` varchar(255) NOT NULL,
  `qn_api` varchar(255) NOT NULL,
  `bd_ak` varchar(255) NOT NULL,
  `pay_type` int(1) NOT NULL DEFAULT '0',
  `yunpay_no` varchar(255) DEFAULT NULL,
  `yunpay_pid` varchar(255) DEFAULT NULL,
  `yunpay_key` varchar(255) DEFAULT NULL,
  `is_qniu` int(1) DEFAULT '0',
  `is_type` int(1) DEFAULT '0',
  `template_id` text NOT NULL,
  `tuisong` text,
  `kf_openid` text,
  `qq` text,
  `rush_text` varchar(20) NOT NULL,
  `unit_text` varchar(20) NOT NULL,
  `task_template_id` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `quan_id` int(11) NOT NULL,
  `advid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `nickname` varchar(80) DEFAULT NULL,
  `headimgurl` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `content` text,
  `task_status` int(1) DEFAULT '0',
  `images` text,
  `openid` varchar(50) DEFAULT '',
  `hx_status` tinyint(1) DEFAULT '0',
  `share_app_message_count` int(5) DEFAULT '0',
  `share_time_line_count` int(5) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_tx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `quan_id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `money` decimal(10,2) DEFAULT NULL,
  `money_before` decimal(10,2) DEFAULT NULL,
  `money_after` decimal(10,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `channel` tinyint(1) DEFAULT NULL,
  `mch_billno` varchar(50) DEFAULT NULL,
  `out_billno` varchar(50) DEFAULT NULL,
  `out_money` int(11) DEFAULT NULL,
  `tag` text,
  `remark` text,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `tx_status` tinyint(1) NOT NULL DEFAULT '0',
  `nickname` varchar(100) NOT NULL DEFAULT '',
  `headimgurl` varchar(300) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_vip_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quan_id` int(11) NOT NULL,
  `weid` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL,
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(50) NOT NULL DEFAULT '',
  `headimgurl` varchar(300) NOT NULL DEFAULT '',
  `vip_id` int(11) DEFAULT NULL,
  `vip_name` varchar(20) DEFAULT NULL,
  `vip_recharge` decimal(10,2) DEFAULT NULL,
  `pay` decimal(10,2) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `createtime` int(11) DEFAULT NULL,
  `wechat_sn` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_vip_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quan_id` int(11) NOT NULL,
  `weid` int(11) DEFAULT NULL,
  `vip_name` varchar(20) DEFAULT NULL,
  `vip_recharge` decimal(10,2) DEFAULT NULL,
  `vip_rob` decimal(10,2) DEFAULT NULL,
  `piece_model` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `is_spill` int(2) NOT NULL DEFAULT '0',
  `spill_prompt` varchar(100) NOT NULL DEFAULT '',
  `spill_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `spill_number` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_ad_yure` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL,
  `quan_id` int(10) NOT NULL,
  `fee` decimal(10,2) DEFAULT NULL,
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_addr_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL,
  `addr` varchar(200) NOT NULL,
  `group_id` int(50) NOT NULL DEFAULT '0',
  `group_name` varchar(50) NOT NULL DEFAULT '分组名称',
  `url` varchar(300) NOT NULL,
  `remark` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_share_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(3) NOT NULL,
  `headimgurl` varchar(200) NOT NULL COMMENT '头像',
  `openid` varchar(100) NOT NULL COMMENT '微信id',
  `nickname` varchar(200) NOT NULL COMMENT '昵称',
  `realname` varchar(30) NOT NULL COMMENT '真实姓名',
  `sex` int(1) NOT NULL COMMENT '性别',
  `city` varchar(20) NOT NULL COMMENT '城市',
  `province` varchar(10) NOT NULL COMMENT '省份',
  `subscribe` int(1) NOT NULL COMMENT '是否关注',
  `total_money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '总金额',
  `w_money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '未提现金额',
  `y_money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '已提现金额',
  `cz_money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '充值金额',
  `zf_money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态 0正常，1拉黑',
  `vip_status` int(1) NOT NULL DEFAULT '0' COMMENT 'vip状态 0否，1是',
  `start_createtime` int(10) NOT NULL DEFAULT '0' COMMENT 'vip开始时间',
  `end_createtime` int(10) NOT NULL DEFAULT '0' COMMENT 'vip结束时间',
  `createtime` int(10) DEFAULT NULL,
  `lh_no` int(2) NOT NULL DEFAULT '0' COMMENT '拉黑次数',
  PRIMARY KEY (`id`),
  KEY `cgc_share_member1` (`uniacid`,`openid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_share_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(3) NOT NULL,
  `url_id` int(5) NOT NULL COMMENT '链接id',
  `openid` varchar(100) NOT NULL COMMENT '微信id',
  `ip` varchar(200) NOT NULL COMMENT 'ip地址',
  `createtime` int(10) DEFAULT NULL,
  `share_openid` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `cgc_share_record_index` (`uniacid`,`url_id`,`openid`),
  KEY `cgc_share_record_gindex1` (`uniacid`,`createtime`,`url_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_share_url` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(3) NOT NULL,
  `title` varchar(300) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `openid` varchar(100) NOT NULL DEFAULT '',
  `nickname` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(300) NOT NULL DEFAULT '' COMMENT '微信链接地址或者头条地址',
  `money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '设置金额',
  `num` int(4) NOT NULL DEFAULT '0' COMMENT '份数',
  `y_num` int(4) NOT NULL DEFAULT '0' COMMENT '已领取份数',
  `share_type` int(1) NOT NULL DEFAULT '0' COMMENT '0全部，1朋友圈，2朋友微信群',
  `sx_bl` int(4) NOT NULL DEFAULT '0' COMMENT '手续费',
  `sex` int(1) NOT NULL DEFAULT '0' COMMENT '性别 0 全部，男 1，女2',
  `province` varchar(200) NOT NULL DEFAULT '' COMMENT '省份',
  `city` varchar(200) NOT NULL DEFAULT '' COMMENT '城市',
  `pay_status` int(1) NOT NULL DEFAULT '0' COMMENT '付款状态 0,未付款1,已付款',
  `wechat_sn` varchar(200) DEFAULT NULL COMMENT '微信单号',
  `order_sn` varchar(200) DEFAULT NULL COMMENT '订单号',
  `createtime` int(10) DEFAULT NULL,
  `desc` varchar(100) NOT NULL DEFAULT '',
  `pic` varchar(500) NOT NULL DEFAULT '',
  `zf_money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `tk_money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '退款金额',
  `tk_status` int(1) NOT NULL DEFAULT '0' COMMENT '退款状态',
  `paytype` varchar(20) DEFAULT '' COMMENT '付款方式',
  `pay_log` varchar(200) DEFAULT '' COMMENT '支付日志',
  `dj` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '单价',
  `read_num` int(10) DEFAULT '0' COMMENT '阅读数',
  `import_url_type` int(1) NOT NULL DEFAULT '0' COMMENT '链接类型 0 微信链接.1 其他链接',
  `read_single_money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '阅读单价',
  `read_money` int(5) NOT NULL DEFAULT '0' COMMENT '阅读总金额',
  PRIMARY KEY (`id`),
  KEY `cgc_share_url_gindex1` (`uniacid`,`id`),
  KEY `cgc_share_url_gindex2` (`uniacid`,`openid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_share_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(3) NOT NULL,
  `url_id` int(5) NOT NULL COMMENT '链接id',
  `headimgurl` varchar(200) NOT NULL COMMENT '头像',
  `openid` varchar(100) NOT NULL COMMENT '微信id',
  `nickname` varchar(200) NOT NULL COMMENT '昵称',
  `realname` varchar(30) NOT NULL COMMENT '真实姓名',
  `sex` int(1) NOT NULL COMMENT '性别',
  `city` varchar(20) NOT NULL COMMENT '城市',
  `province` varchar(10) NOT NULL COMMENT '省份',
  `subscribe` int(1) NOT NULL COMMENT '是否关注',
  `share_status` int(1) NOT NULL DEFAULT '0' COMMENT '分享状态 0未分享，1已分享',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态 0正常,1拉黑',
  `money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '红包金额',
  `createtime` int(10) DEFAULT NULL,
  `read_num` int(10) NOT NULL DEFAULT '0',
  `url` varchar(500) NOT NULL DEFAULT '',
  `title` varchar(500) NOT NULL DEFAULT '',
  `paytype` varchar(20) DEFAULT '' COMMENT '付款方式',
  `share_openid` varchar(50) NOT NULL DEFAULT '',
  `hb_status` int(1) NOT NULL DEFAULT '0' COMMENT '状态 0 已发送,1发送失败',
  `district` varchar(500) NOT NULL DEFAULT '',
  `share_type` int(1) NOT NULL DEFAULT '0' COMMENT '0全部，1朋友圈，2朋友微信群',
  PRIMARY KEY (`id`),
  KEY `cgc_share_user_index1` (`uniacid`,`url_id`,`openid`),
  KEY `cgc_share_user_gindex1` (`uniacid`,`url_id`),
  KEY `cgc_share_user_gindex2` (`uniacid`,`share_openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_cgc_share_vip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(3) NOT NULL,
  `openid` varchar(100) NOT NULL DEFAULT '',
  `nickname` varchar(50) NOT NULL DEFAULT '',
  `zf_money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `paytype` varchar(20) DEFAULT '' COMMENT '付款方式',
  `pay_log` varchar(200) DEFAULT '' COMMENT '支付日志',
  `order_sn` varchar(20) DEFAULT '' COMMENT '订单号',
  `wechat_sn` varchar(30) DEFAULT '' COMMENT '微信订单号',
  `status` int(1) DEFAULT '0' COMMENT '支付状态',
  `createtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `quan_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'mid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `mid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'from_user')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `from_user` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `openid` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `nickname` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `headimgurl` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'total_amount')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `total_amount` decimal(10,2) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'total_num')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `total_num` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'fee')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `fee` decimal(10,2) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'title')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `title` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'content')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `content` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'images')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `images` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'link')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `link` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'telphone')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `telphone` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'publish_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `publish_time` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'hot_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `hot_time` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'top_level')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `top_level` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'rob_start_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `rob_start_time` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'total_pay')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `total_pay` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'pay')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `pay` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'logid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `logid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `status` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'rob_status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `rob_status` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'views')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `views` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'links')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `links` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'rob_plan')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `rob_plan` mediumtext NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'rob_amount')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `rob_amount` decimal(10,2)   DEFAULT 0.00 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'rob_users')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `rob_users` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'rob_end_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `rob_end_time` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'create_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `create_time` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'del')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `del` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'op')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `op` tinyint(1)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'op_remark')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `op_remark` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'op_admin')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `op_admin` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'kouling')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `kouling` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'is_open')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `is_open` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'is_pl')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `is_pl` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'is_message')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `is_message` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'is_kouling')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `is_kouling` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'is_up')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `is_up` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'model')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `model` tinyint(1)   DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'group_size')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `group_size` smallint(6)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'type')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `type` int(2) NOT NULL  DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'qr_code')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `qr_code` varchar(250)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'time_limit')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `time_limit` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'time_limit_start')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `time_limit_start` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'time_limit_end')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `time_limit_end` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'job_submission_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `job_submission_time` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'allocation_way')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `allocation_way` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'hx_status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `hx_status` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'hx_pass')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `hx_pass` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'wx_cardid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `wx_cardid` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'share_url')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `share_url` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'task_submit_switch')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `task_submit_switch` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'share_desc')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `share_desc` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'message_send')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `message_send` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'wechat_sn')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `wechat_sn` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'addr_forward')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `addr_forward` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'addr_forward_url')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `addr_forward_url` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'city')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `city` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'fl_type')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `fl_type` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'summary')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `summary` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'couponc_images')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `couponc_images` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'couponc_rule')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `couponc_rule` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'couponc_detail')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `couponc_detail` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'couponc_miaosha')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `couponc_miaosha` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'couponc_tel')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `couponc_tel` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'couponc_add')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `couponc_add` varchar(500) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'couponc_shoper')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `couponc_shoper` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'couponc_gift')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `couponc_gift` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'couponc_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `couponc_money` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'couponc_discount')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `couponc_discount` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'company_name')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `company_name` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'couponc_type')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `couponc_type` tinyint(1) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'couponc_name')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `couponc_name` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'hx_pwd')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `hx_pwd` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_adv')) {
	if(!pdo_fieldexists('cgc_ad_adv',  'couponc_valid_date')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_adv')." ADD `couponc_valid_date` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_banner')) {
	if(!pdo_fieldexists('cgc_ad_banner',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_banner')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_banner')) {
	if(!pdo_fieldexists('cgc_ad_banner',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_banner')." ADD `weid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_banner')) {
	if(!pdo_fieldexists('cgc_ad_banner',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_banner')." ADD `quan_id` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_banner')) {
	if(!pdo_fieldexists('cgc_ad_banner',  'title')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_banner')." ADD `title` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_banner')) {
	if(!pdo_fieldexists('cgc_ad_banner',  'thumb')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_banner')." ADD `thumb` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_banner')) {
	if(!pdo_fieldexists('cgc_ad_banner',  'content')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_banner')." ADD `content` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_banner')) {
	if(!pdo_fieldexists('cgc_ad_banner',  'displayorder')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_banner')." ADD `displayorder` tinyint(3) unsigned NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_banner')) {
	if(!pdo_fieldexists('cgc_ad_banner',  'enabled')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_banner')." ADD `enabled` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_banner')) {
	if(!pdo_fieldexists('cgc_ad_banner',  'url')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_banner')." ADD `url` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_banner')) {
	if(!pdo_fieldexists('cgc_ad_banner',  'status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_banner')." ADD `status` tinyint(1)   DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_banner')) {
	if(!pdo_fieldexists('cgc_ad_banner',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_banner')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `quan_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'advid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `advid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'mid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `mid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `openid` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `nickname` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `avatar` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'company_name')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `company_name` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'couponc_type')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `couponc_type` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'couponc_name')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `couponc_name` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'couponc_valid_date')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `couponc_valid_date` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'couponc_discount')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `couponc_discount` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'couponc_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `couponc_money` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'couponc_gift')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `couponc_gift` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'couponc_shoper')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `couponc_shoper` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'couponc_add')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `couponc_add` varchar(500) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'couponc_tel')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `couponc_tel` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'couponc_detail')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `couponc_detail` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'couponc_rule')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `couponc_rule` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'couponc_images')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `couponc_images` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'create_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `create_time` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'update_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `update_time` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `status` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'status_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `status_time` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_couponc')) {
	if(!pdo_fieldexists('cgc_ad_couponc',  'couponc_miaosha')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_couponc')." ADD `couponc_miaosha` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_group')) {
	if(!pdo_fieldexists('cgc_ad_group',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_group')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_group')) {
	if(!pdo_fieldexists('cgc_ad_group',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_group')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_group')) {
	if(!pdo_fieldexists('cgc_ad_group',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_group')." ADD `quan_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_group')) {
	if(!pdo_fieldexists('cgc_ad_group',  'advid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_group')." ADD `advid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_group')) {
	if(!pdo_fieldexists('cgc_ad_group',  'captain_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_group')." ADD `captain_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_group')) {
	if(!pdo_fieldexists('cgc_ad_group',  'captain_nickname')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_group')." ADD `captain_nickname` varchar(80) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_group')) {
	if(!pdo_fieldexists('cgc_ad_group',  'mine_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_group')." ADD `mine_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_group')) {
	if(!pdo_fieldexists('cgc_ad_group',  'user_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_group')." ADD `user_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_group')) {
	if(!pdo_fieldexists('cgc_ad_group',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_group')." ADD `nickname` varchar(80)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_group')) {
	if(!pdo_fieldexists('cgc_ad_group',  'avatar')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_group')." ADD `avatar` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_group')) {
	if(!pdo_fieldexists('cgc_ad_group',  'headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_group')." ADD `headimgurl` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_group')) {
	if(!pdo_fieldexists('cgc_ad_group',  'create_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_group')." ADD `create_time` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_help')) {
	if(!pdo_fieldexists('cgc_ad_help',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_help')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_help')) {
	if(!pdo_fieldexists('cgc_ad_help',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_help')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_help')) {
	if(!pdo_fieldexists('cgc_ad_help',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_help')." ADD `quan_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_help')) {
	if(!pdo_fieldexists('cgc_ad_help',  'mid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_help')." ADD `mid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_help')) {
	if(!pdo_fieldexists('cgc_ad_help',  'helper_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_help')." ADD `helper_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_help')) {
	if(!pdo_fieldexists('cgc_ad_help',  'create_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_help')." ADD `create_time` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `weid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `quan_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'uid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `uid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'from_user')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `from_user` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `openid` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `nickname` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `headimgurl` varchar(250) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'thumb')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `thumb` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'nicheng')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `nicheng` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `status` int(2) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'credit')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `credit` decimal(10,2)   DEFAULT 0.00 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'fabu')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `fabu` decimal(10,2)   DEFAULT 0.00 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'rob')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `rob` decimal(10,2)   DEFAULT 0.00 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'up_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `up_money` decimal(10,2) NOT NULL  DEFAULT 0.00 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'follow')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `follow` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'follow_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `follow_time` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'type')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `type` int(2) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'last_city')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `last_city` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'rob_next_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `rob_next_time` int(10) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'fstatus')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `fstatus` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'is_revice')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `is_revice` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'inviter_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `inviter_id` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'qr_code')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `qr_code` varchar(250)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'telphone')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `telphone` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'message_notify')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `message_notify` int(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'ori_openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `ori_openid` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'no_account_amount')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `no_account_amount` decimal(10,2)   DEFAULT 0.00 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'fee')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `fee` decimal(10,2)   DEFAULT 0.00 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'qrcode_imge')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `qrcode_imge` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'qrcode_poster')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `qrcode_poster` varchar(500)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'poster_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `poster_time` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'vip_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `vip_id` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'vip_name')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `vip_name` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'vip_recharge')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `vip_recharge` decimal(10,2)   DEFAULT 0.00 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'vip_rob')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `vip_rob` decimal(10,2)   DEFAULT 0.00 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'credit1')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `credit1` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_member')) {
	if(!pdo_fieldexists('cgc_ad_member',  'credit2')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_member')." ADD `credit2` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_message')) {
	if(!pdo_fieldexists('cgc_ad_message',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_message')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_message')) {
	if(!pdo_fieldexists('cgc_ad_message',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_message')." ADD `weid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_message')) {
	if(!pdo_fieldexists('cgc_ad_message',  'advid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_message')." ADD `advid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_message')) {
	if(!pdo_fieldexists('cgc_ad_message',  'mid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_message')." ADD `mid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_message')) {
	if(!pdo_fieldexists('cgc_ad_message',  'upbdate')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_message')." ADD `upbdate` varchar(244)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_message')) {
	if(!pdo_fieldexists('cgc_ad_message',  'content')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_message')." ADD `content` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_message')) {
	if(!pdo_fieldexists('cgc_ad_message',  'status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_message')." ADD `status` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_paylog')) {
	if(!pdo_fieldexists('cgc_ad_paylog',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_paylog')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_paylog')) {
	if(!pdo_fieldexists('cgc_ad_paylog',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_paylog')." ADD `weid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_paylog')) {
	if(!pdo_fieldexists('cgc_ad_paylog',  'mid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_paylog')." ADD `mid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_paylog')) {
	if(!pdo_fieldexists('cgc_ad_paylog',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_paylog')." ADD `quan_id` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_paylog')) {
	if(!pdo_fieldexists('cgc_ad_paylog',  'advid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_paylog')." ADD `advid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_paylog')) {
	if(!pdo_fieldexists('cgc_ad_paylog',  'total_amount')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_paylog')." ADD `total_amount` float(244,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_paylog')) {
	if(!pdo_fieldexists('cgc_ad_paylog',  'upbdate')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_paylog')." ADD `upbdate` varchar(32)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_poster')) {
	if(!pdo_fieldexists('cgc_ad_poster',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_poster')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_poster')) {
	if(!pdo_fieldexists('cgc_ad_poster',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_poster')." ADD `weid` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_poster')) {
	if(!pdo_fieldexists('cgc_ad_poster',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_poster')." ADD `quan_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_poster')) {
	if(!pdo_fieldexists('cgc_ad_poster',  'quan_name')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_poster')." ADD `quan_name` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_poster')) {
	if(!pdo_fieldexists('cgc_ad_poster',  'bg')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_poster')." ADD `bg` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_poster')) {
	if(!pdo_fieldexists('cgc_ad_poster',  'data')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_poster')." ADD `data` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_poster')) {
	if(!pdo_fieldexists('cgc_ad_poster',  'keyword')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_poster')." ADD `keyword` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_poster')) {
	if(!pdo_fieldexists('cgc_ad_poster',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_poster')." ADD `createtime` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_poster')) {
	if(!pdo_fieldexists('cgc_ad_poster',  'waittext')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_poster')." ADD `waittext` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_poster')) {
	if(!pdo_fieldexists('cgc_ad_poster',  'oktext')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_poster')." ADD `oktext` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_poster')) {
	if(!pdo_fieldexists('cgc_ad_poster',  'subtext')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_poster')." ADD `subtext` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_poster')) {
	if(!pdo_fieldexists('cgc_ad_poster',  'templateid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_poster')." ADD `templateid` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_poster')) {
	if(!pdo_fieldexists('cgc_ad_poster',  'entrytext')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_poster')." ADD `entrytext` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_pv')) {
	if(!pdo_fieldexists('cgc_ad_pv',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_pv')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_pv')) {
	if(!pdo_fieldexists('cgc_ad_pv',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_pv')." ADD `weid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_pv')) {
	if(!pdo_fieldexists('cgc_ad_pv',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_pv')." ADD `quan_id` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_pv')) {
	if(!pdo_fieldexists('cgc_ad_pv',  'mid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_pv')." ADD `mid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_pv')) {
	if(!pdo_fieldexists('cgc_ad_pv',  'advid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_pv')." ADD `advid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_pv')) {
	if(!pdo_fieldexists('cgc_ad_pv',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_pv')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'aname')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `aname` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'notice')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `notice` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'rule')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `rule` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'begin_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `begin_time` tinyint(2) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'over_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `over_time` tinyint(2) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'cold_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `cold_time` smallint(6) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'total_min')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `total_min` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'total_max')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `total_max` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'avg_min')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `avg_min` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'percent')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `percent` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'tx_min')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `tx_min` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'top_line')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `top_line` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'follow_logo')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `follow_logo` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'follow_url')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `follow_url` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'sharetitle')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `sharetitle` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'sharedesc')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `sharedesc` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'sharelogo')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `sharelogo` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'city')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `city` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `status` tinyint(1) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'shenhe')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `shenhe` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'del')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `del` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'is_message')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `is_message` int(1)   DEFAULT 1 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'is_follow')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `is_follow` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'create_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `create_time` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'update_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `update_time` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'last_city')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `last_city` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'is_pl')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `is_pl` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'piece_model')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `piece_model` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'groupmax')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `groupmax` smallint(6) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'total_min2')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `total_min2` decimal(10,2) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'total_max2')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `total_max2` decimal(10,2) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'avg_min2')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `avg_min2` decimal(10,2) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'up_rob_fee')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `up_rob_fee` decimal(10,2) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'up_send_fee')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `up_send_fee` decimal(10,2) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'total_min4')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `total_min4` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'total_max4')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `total_max4` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'avg_min4')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `avg_min4` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'tx_follow')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `tx_follow` int(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'pp_mode')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `pp_mode` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'pp_openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `pp_openid` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'task_submit_switch')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `task_submit_switch` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'group_guanzhu')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `group_guanzhu` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'hx_switch')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `hx_switch` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'views')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `views` int(10)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'yun_fkz')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `yun_fkz` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'yun_rule')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `yun_rule` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'guanzhu_qrcode')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `guanzhu_qrcode` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'guanzhu_name')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `guanzhu_name` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'guanzhu_direct')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `guanzhu_direct` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'task_guanzhu')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `task_guanzhu` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'kf_openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `kf_openid` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'guanzhu_note')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `guanzhu_note` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'guanzhu_key')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `guanzhu_key` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'total_min5')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `total_min5` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'total_max5')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `total_max5` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'avg_min5')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `avg_min5` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'tx_control')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `tx_control` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'tx_num')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `tx_num` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'tx_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `tx_money` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'total_min6')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `total_min6` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'total_max6')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `total_max6` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'avg_min6')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `avg_min6` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'total_min7')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `total_min7` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'total_max7')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `total_max7` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'avg_min7')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `avg_min7` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'addr_forward')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `addr_forward` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'tx_percent')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `tx_percent` int(3)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'hx_show')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `hx_show` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'menu_name')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `menu_name` varchar(30)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'menu_url')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `menu_url` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'regular_user_momeny')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `regular_user_momeny` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'click_multiple')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `click_multiple` int(11)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'vip_valid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `vip_valid` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'addr_forward_url')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `addr_forward_url` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'forbidden_addr')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `forbidden_addr` varchar(100)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'piece_model_authority')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `piece_model_authority` varchar(30)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'message_notify')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `message_notify` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'total_min8')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `total_min8` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'total_max8')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `total_max8` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'avg_min8')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `avg_min8` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_quan')) {
	if(!pdo_fieldexists('cgc_ad_quan',  'is_page_follow')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_quan')." ADD `is_page_follow` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `quan_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'advid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `advid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'mid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `mid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `money` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'up_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `up_money` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'total_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `total_money` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'is_luck')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `is_luck` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'is_shit')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `is_shit` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'create_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `create_time` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `status` int(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'hx_status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `hx_status` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'wx_code')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `wx_code` varchar(32)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'share_app_message_count')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `share_app_message_count` int(5)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_red')) {
	if(!pdo_fieldexists('cgc_ad_red',  'share_time_line_count')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_red')." ADD `share_time_line_count` int(5)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_rule')) {
	if(!pdo_fieldexists('cgc_ad_rule',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_rule')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_rule')) {
	if(!pdo_fieldexists('cgc_ad_rule',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_rule')." ADD `weid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_rule')) {
	if(!pdo_fieldexists('cgc_ad_rule',  'ruleid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_rule')." ADD `ruleid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_rule')) {
	if(!pdo_fieldexists('cgc_ad_rule',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_rule')." ADD `quan_id` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_rule')) {
	if(!pdo_fieldexists('cgc_ad_rule',  'news_title')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_rule')." ADD `news_title` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_rule')) {
	if(!pdo_fieldexists('cgc_ad_rule',  'news_thumb')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_rule')." ADD `news_thumb` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_rule')) {
	if(!pdo_fieldexists('cgc_ad_rule',  'news_content')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_rule')." ADD `news_content` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_rule')) {
	if(!pdo_fieldexists('cgc_ad_rule',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_rule')." ADD `createtime` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `weid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'appid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `appid` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'secret')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `secret` varchar(32) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'mchid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `mchid` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'password')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `password` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'ip')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `ip` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'qn_ak')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `qn_ak` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'qn_sk')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `qn_sk` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'qn_bucket')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `qn_bucket` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'qn_api')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `qn_api` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'bd_ak')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `bd_ak` varchar(255) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'pay_type')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `pay_type` int(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'yunpay_no')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `yunpay_no` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'yunpay_pid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `yunpay_pid` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'yunpay_key')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `yunpay_key` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'is_qniu')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `is_qniu` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'is_type')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `is_type` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'template_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `template_id` text NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'tuisong')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `tuisong` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'kf_openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `kf_openid` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'qq')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `qq` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'rush_text')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `rush_text` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'unit_text')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `unit_text` varchar(20) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_setting')) {
	if(!pdo_fieldexists('cgc_ad_setting',  'task_template_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_setting')." ADD `task_template_id` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `quan_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'advid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `advid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'mid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `mid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `nickname` varchar(80)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `headimgurl` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `status` tinyint(4)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'create_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `create_time` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `money` decimal(10,2) NOT NULL  DEFAULT 0.00 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'content')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `content` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'task_status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `task_status` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'images')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `images` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `openid` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'hx_status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `hx_status` tinyint(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'share_app_message_count')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `share_app_message_count` int(5)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_task')) {
	if(!pdo_fieldexists('cgc_ad_task',  'share_time_line_count')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_task')." ADD `share_time_line_count` int(5)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `weid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `quan_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'mid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `mid` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `openid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `money` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'money_before')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `money_before` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'money_after')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `money_after` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `status` tinyint(1) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'channel')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `channel` tinyint(1)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'mch_billno')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `mch_billno` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'out_billno')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `out_billno` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'out_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `out_money` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'tag')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `tag` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'remark')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `remark` text    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'create_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `create_time` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'update_time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `update_time` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'tx_status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `tx_status` tinyint(1) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `nickname` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_tx')) {
	if(!pdo_fieldexists('cgc_ad_tx',  'headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_tx')." ADD `headimgurl` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_pay')) {
	if(!pdo_fieldexists('cgc_ad_vip_pay',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_pay')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_pay')) {
	if(!pdo_fieldexists('cgc_ad_vip_pay',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_pay')." ADD `quan_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_pay')) {
	if(!pdo_fieldexists('cgc_ad_vip_pay',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_pay')." ADD `weid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_pay')) {
	if(!pdo_fieldexists('cgc_ad_vip_pay',  'mid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_pay')." ADD `mid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_pay')) {
	if(!pdo_fieldexists('cgc_ad_vip_pay',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_pay')." ADD `openid` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_pay')) {
	if(!pdo_fieldexists('cgc_ad_vip_pay',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_pay')." ADD `nickname` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_pay')) {
	if(!pdo_fieldexists('cgc_ad_vip_pay',  'headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_pay')." ADD `headimgurl` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_pay')) {
	if(!pdo_fieldexists('cgc_ad_vip_pay',  'vip_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_pay')." ADD `vip_id` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_pay')) {
	if(!pdo_fieldexists('cgc_ad_vip_pay',  'vip_name')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_pay')." ADD `vip_name` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_pay')) {
	if(!pdo_fieldexists('cgc_ad_vip_pay',  'vip_recharge')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_pay')." ADD `vip_recharge` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_pay')) {
	if(!pdo_fieldexists('cgc_ad_vip_pay',  'pay')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_pay')." ADD `pay` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_pay')) {
	if(!pdo_fieldexists('cgc_ad_vip_pay',  'status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_pay')." ADD `status` int(1)   DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_pay')) {
	if(!pdo_fieldexists('cgc_ad_vip_pay',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_pay')." ADD `createtime` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_pay')) {
	if(!pdo_fieldexists('cgc_ad_vip_pay',  'wechat_sn')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_pay')." ADD `wechat_sn` varchar(50)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_rule')) {
	if(!pdo_fieldexists('cgc_ad_vip_rule',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_rule')." ADD `id` int(11) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_rule')) {
	if(!pdo_fieldexists('cgc_ad_vip_rule',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_rule')." ADD `quan_id` int(11) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_rule')) {
	if(!pdo_fieldexists('cgc_ad_vip_rule',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_rule')." ADD `weid` int(11)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_rule')) {
	if(!pdo_fieldexists('cgc_ad_vip_rule',  'vip_name')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_rule')." ADD `vip_name` varchar(20)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_rule')) {
	if(!pdo_fieldexists('cgc_ad_vip_rule',  'vip_recharge')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_rule')." ADD `vip_recharge` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_rule')) {
	if(!pdo_fieldexists('cgc_ad_vip_rule',  'vip_rob')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_rule')." ADD `vip_rob` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_rule')) {
	if(!pdo_fieldexists('cgc_ad_vip_rule',  'piece_model')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_rule')." ADD `piece_model` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_rule')) {
	if(!pdo_fieldexists('cgc_ad_vip_rule',  'remark')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_rule')." ADD `remark` varchar(255)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_rule')) {
	if(!pdo_fieldexists('cgc_ad_vip_rule',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_rule')." ADD `createtime` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_rule')) {
	if(!pdo_fieldexists('cgc_ad_vip_rule',  'is_spill')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_rule')." ADD `is_spill` int(2) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_rule')) {
	if(!pdo_fieldexists('cgc_ad_vip_rule',  'spill_prompt')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_rule')." ADD `spill_prompt` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_rule')) {
	if(!pdo_fieldexists('cgc_ad_vip_rule',  'spill_fee')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_rule')." ADD `spill_fee` decimal(10,2) NOT NULL  DEFAULT 0.00 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_vip_rule')) {
	if(!pdo_fieldexists('cgc_ad_vip_rule',  'spill_number')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_vip_rule')." ADD `spill_number` int(11) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_yure')) {
	if(!pdo_fieldexists('cgc_ad_yure',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_yure')." ADD `id` int(11) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_yure')) {
	if(!pdo_fieldexists('cgc_ad_yure',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_yure')." ADD `weid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_yure')) {
	if(!pdo_fieldexists('cgc_ad_yure',  'quan_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_yure')." ADD `quan_id` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_yure')) {
	if(!pdo_fieldexists('cgc_ad_yure',  'fee')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_yure')." ADD `fee` decimal(10,2)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_ad_yure')) {
	if(!pdo_fieldexists('cgc_ad_yure',  'time')) {
		pdo_query("ALTER TABLE ".tablename('cgc_ad_yure')." ADD `time` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_addr_group')) {
	if(!pdo_fieldexists('cgc_addr_group',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_addr_group')." ADD `id` int(10) NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_addr_group')) {
	if(!pdo_fieldexists('cgc_addr_group',  'weid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_addr_group')." ADD `weid` int(10) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_addr_group')) {
	if(!pdo_fieldexists('cgc_addr_group',  'addr')) {
		pdo_query("ALTER TABLE ".tablename('cgc_addr_group')." ADD `addr` varchar(200) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_addr_group')) {
	if(!pdo_fieldexists('cgc_addr_group',  'group_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_addr_group')." ADD `group_id` int(50) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_addr_group')) {
	if(!pdo_fieldexists('cgc_addr_group',  'group_name')) {
		pdo_query("ALTER TABLE ".tablename('cgc_addr_group')." ADD `group_name` varchar(50) NOT NULL  DEFAULT 分组名称 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_addr_group')) {
	if(!pdo_fieldexists('cgc_addr_group',  'url')) {
		pdo_query("ALTER TABLE ".tablename('cgc_addr_group')." ADD `url` varchar(300) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_addr_group')) {
	if(!pdo_fieldexists('cgc_addr_group',  'remark')) {
		pdo_query("ALTER TABLE ".tablename('cgc_addr_group')." ADD `remark` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `uniacid` int(3) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `headimgurl` varchar(200) NOT NULL   COMMENT '头像';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `openid` varchar(100) NOT NULL   COMMENT '微信id';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `nickname` varchar(200) NOT NULL   COMMENT '昵称';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'realname')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `realname` varchar(30) NOT NULL   COMMENT '真实姓名';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'sex')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `sex` int(1) NOT NULL   COMMENT '性别';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'city')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `city` varchar(20) NOT NULL   COMMENT '城市';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'province')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `province` varchar(10) NOT NULL   COMMENT '省份';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'subscribe')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `subscribe` int(1) NOT NULL   COMMENT '是否关注';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'total_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `total_money` decimal(6,2) NOT NULL  DEFAULT 0.00 COMMENT '总金额';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'w_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `w_money` decimal(6,2) NOT NULL  DEFAULT 0.00 COMMENT '未提现金额';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'y_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `y_money` decimal(6,2) NOT NULL  DEFAULT 0.00 COMMENT '已提现金额';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'cz_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `cz_money` decimal(6,2) NOT NULL  DEFAULT 0.00 COMMENT '充值金额';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'zf_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `zf_money` decimal(6,2) NOT NULL  DEFAULT 0.00 COMMENT '支付金额';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `status` int(1) NOT NULL  DEFAULT 0 COMMENT '状态 0正常，1拉黑';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'vip_status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `vip_status` int(1) NOT NULL  DEFAULT 0 COMMENT 'vip状态 0否，1是';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'start_createtime')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `start_createtime` int(10) NOT NULL  DEFAULT 0 COMMENT 'vip开始时间';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'end_createtime')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `end_createtime` int(10) NOT NULL  DEFAULT 0 COMMENT 'vip结束时间';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `createtime` int(10)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_member')) {
	if(!pdo_fieldexists('cgc_share_member',  'lh_no')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_member')." ADD `lh_no` int(2) NOT NULL  DEFAULT 0 COMMENT '拉黑次数';");
	}	
}
if(pdo_tableexists('cgc_share_record')) {
	if(!pdo_fieldexists('cgc_share_record',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_record')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_record')) {
	if(!pdo_fieldexists('cgc_share_record',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_record')." ADD `uniacid` int(3) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_record')) {
	if(!pdo_fieldexists('cgc_share_record',  'url_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_record')." ADD `url_id` int(5) NOT NULL   COMMENT '链接id';");
	}	
}
if(pdo_tableexists('cgc_share_record')) {
	if(!pdo_fieldexists('cgc_share_record',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_record')." ADD `openid` varchar(100) NOT NULL   COMMENT '微信id';");
	}	
}
if(pdo_tableexists('cgc_share_record')) {
	if(!pdo_fieldexists('cgc_share_record',  'ip')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_record')." ADD `ip` varchar(200) NOT NULL   COMMENT 'ip地址';");
	}	
}
if(pdo_tableexists('cgc_share_record')) {
	if(!pdo_fieldexists('cgc_share_record',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_record')." ADD `createtime` int(10)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_record')) {
	if(!pdo_fieldexists('cgc_share_record',  'share_openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_record')." ADD `share_openid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `uniacid` int(3) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'title')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `title` varchar(300) NOT NULL   COMMENT '标题';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'content')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `content` text NOT NULL   COMMENT '内容';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `openid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `nickname` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'url')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `url` varchar(300) NOT NULL   COMMENT '微信链接地址或者头条地址';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `money` decimal(6,2) NOT NULL  DEFAULT 0.00 COMMENT '设置金额';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'num')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `num` int(4) NOT NULL  DEFAULT 0 COMMENT '份数';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'y_num')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `y_num` int(4) NOT NULL  DEFAULT 0 COMMENT '已领取份数';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'share_type')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `share_type` int(1) NOT NULL  DEFAULT 0 COMMENT '0全部，1朋友圈，2朋友微信群';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'sx_bl')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `sx_bl` int(4) NOT NULL  DEFAULT 0 COMMENT '手续费';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'sex')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `sex` int(1) NOT NULL  DEFAULT 0 COMMENT '性别 0 全部，男 1，女2';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'province')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `province` varchar(200) NOT NULL   COMMENT '省份';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'city')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `city` varchar(200) NOT NULL   COMMENT '城市';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'pay_status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `pay_status` int(1) NOT NULL  DEFAULT 0 COMMENT '付款状态 0,未付款1,已付款';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'wechat_sn')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `wechat_sn` varchar(200)    COMMENT '微信单号';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'order_sn')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `order_sn` varchar(200)    COMMENT '订单号';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `createtime` int(10)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'desc')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `desc` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'pic')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `pic` varchar(500) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'zf_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `zf_money` decimal(6,2) NOT NULL  DEFAULT 0.00 COMMENT '支付金额';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'tk_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `tk_money` decimal(6,2) NOT NULL  DEFAULT 0.00 COMMENT '退款金额';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'tk_status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `tk_status` int(1) NOT NULL  DEFAULT 0 COMMENT '退款状态';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'paytype')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `paytype` varchar(20)    COMMENT '付款方式';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'pay_log')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `pay_log` varchar(200)    COMMENT '支付日志';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'dj')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `dj` decimal(6,2) NOT NULL  DEFAULT 0.00 COMMENT '单价';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'read_num')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `read_num` int(10)   DEFAULT 0 COMMENT '阅读数';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'import_url_type')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `import_url_type` int(1) NOT NULL  DEFAULT 0 COMMENT '链接类型 0 微信链接.1 其他链接';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'read_single_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `read_single_money` decimal(6,2) NOT NULL  DEFAULT 0.00 COMMENT '阅读单价';");
	}	
}
if(pdo_tableexists('cgc_share_url')) {
	if(!pdo_fieldexists('cgc_share_url',  'read_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_url')." ADD `read_money` int(5) NOT NULL  DEFAULT 0 COMMENT '阅读总金额';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `uniacid` int(3) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'url_id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `url_id` int(5) NOT NULL   COMMENT '链接id';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'headimgurl')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `headimgurl` varchar(200) NOT NULL   COMMENT '头像';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `openid` varchar(100) NOT NULL   COMMENT '微信id';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `nickname` varchar(200) NOT NULL   COMMENT '昵称';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'realname')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `realname` varchar(30) NOT NULL   COMMENT '真实姓名';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'sex')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `sex` int(1) NOT NULL   COMMENT '性别';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'city')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `city` varchar(20) NOT NULL   COMMENT '城市';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'province')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `province` varchar(10) NOT NULL   COMMENT '省份';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'subscribe')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `subscribe` int(1) NOT NULL   COMMENT '是否关注';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'share_status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `share_status` int(1) NOT NULL  DEFAULT 0 COMMENT '分享状态 0未分享，1已分享';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `status` int(1) NOT NULL  DEFAULT 0 COMMENT '状态 0正常,1拉黑';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `money` decimal(6,2) NOT NULL  DEFAULT 0.00 COMMENT '红包金额';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `createtime` int(10)    COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'read_num')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `read_num` int(10) NOT NULL  DEFAULT 0 COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'url')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `url` varchar(500) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'title')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `title` varchar(500) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'paytype')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `paytype` varchar(20)    COMMENT '付款方式';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'share_openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `share_openid` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'hb_status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `hb_status` int(1) NOT NULL  DEFAULT 0 COMMENT '状态 0 已发送,1发送失败';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'district')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `district` varchar(500) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_user')) {
	if(!pdo_fieldexists('cgc_share_user',  'share_type')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_user')." ADD `share_type` int(1) NOT NULL  DEFAULT 0 COMMENT '0全部，1朋友圈，2朋友微信群';");
	}	
}
if(pdo_tableexists('cgc_share_vip')) {
	if(!pdo_fieldexists('cgc_share_vip',  'id')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_vip')." ADD `id` int(10) unsigned NOT NULL auto_increment  COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_vip')) {
	if(!pdo_fieldexists('cgc_share_vip',  'uniacid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_vip')." ADD `uniacid` int(3) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_vip')) {
	if(!pdo_fieldexists('cgc_share_vip',  'openid')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_vip')." ADD `openid` varchar(100) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_vip')) {
	if(!pdo_fieldexists('cgc_share_vip',  'nickname')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_vip')." ADD `nickname` varchar(50) NOT NULL   COMMENT '';");
	}	
}
if(pdo_tableexists('cgc_share_vip')) {
	if(!pdo_fieldexists('cgc_share_vip',  'zf_money')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_vip')." ADD `zf_money` decimal(6,2) NOT NULL  DEFAULT 0.00 COMMENT '支付金额';");
	}	
}
if(pdo_tableexists('cgc_share_vip')) {
	if(!pdo_fieldexists('cgc_share_vip',  'paytype')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_vip')." ADD `paytype` varchar(20)    COMMENT '付款方式';");
	}	
}
if(pdo_tableexists('cgc_share_vip')) {
	if(!pdo_fieldexists('cgc_share_vip',  'pay_log')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_vip')." ADD `pay_log` varchar(200)    COMMENT '支付日志';");
	}	
}
if(pdo_tableexists('cgc_share_vip')) {
	if(!pdo_fieldexists('cgc_share_vip',  'order_sn')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_vip')." ADD `order_sn` varchar(20)    COMMENT '订单号';");
	}	
}
if(pdo_tableexists('cgc_share_vip')) {
	if(!pdo_fieldexists('cgc_share_vip',  'wechat_sn')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_vip')." ADD `wechat_sn` varchar(30)    COMMENT '微信订单号';");
	}	
}
if(pdo_tableexists('cgc_share_vip')) {
	if(!pdo_fieldexists('cgc_share_vip',  'status')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_vip')." ADD `status` int(1)   DEFAULT 0 COMMENT '支付状态';");
	}	
}
if(pdo_tableexists('cgc_share_vip')) {
	if(!pdo_fieldexists('cgc_share_vip',  'createtime')) {
		pdo_query("ALTER TABLE ".tablename('cgc_share_vip')." ADD `createtime` int(10)    COMMENT '';");
	}	
}
