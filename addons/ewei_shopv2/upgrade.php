<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_ewei_message_mass_sign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `taskid` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `log` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_message_mass_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `processnum` int(11) DEFAULT NULL,
  `sendnum` int(11) DEFAULT NULL,
  `messagetype` tinyint(1) DEFAULT NULL,
  `templateid` int(11) DEFAULT NULL,
  `resptitle` varchar(255) DEFAULT NULL,
  `respthumb` varchar(255) DEFAULT NULL,
  `respdesc` varchar(255) DEFAULT NULL,
  `respurl` varchar(255) DEFAULT NULL,
  `sendlimittype` tinyint(1) DEFAULT NULL,
  `send_openid` text,
  `send_level` int(11) DEFAULT NULL,
  `send_group` int(11) DEFAULT NULL,
  `send_agentlevel` int(11) DEFAULT NULL,
  `customertype` tinyint(1) DEFAULT NULL,
  `resdesc2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_message_mass_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `template_id` varchar(255) DEFAULT NULL,
  `first` text NOT NULL,
  `firstcolor` varchar(255) DEFAULT NULL,
  `data` text NOT NULL,
  `remark` text NOT NULL,
  `remarkcolor` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `createtime` int(11) DEFAULT NULL,
  `sendtimes` int(11) DEFAULT NULL,
  `sendcount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_abonus_bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `billno` varchar(100) DEFAULT '',
  `paytype` int(11) DEFAULT '0',
  `year` int(11) DEFAULT '0',
  `month` int(11) DEFAULT '0',
  `week` int(11) DEFAULT '0',
  `ordercount` int(11) DEFAULT '0',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  `paytime` int(11) DEFAULT '0',
  `aagentcount1` int(11) DEFAULT '0',
  `aagentcount2` int(11) DEFAULT '0',
  `aagentcount3` int(11) DEFAULT '0',
  `bonusmoney1` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_send1` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_pay1` decimal(10,2) DEFAULT '0.00',
  `bonusmoney2` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_send2` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_pay2` decimal(10,2) DEFAULT '0.00',
  `bonusmoney3` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_send3` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_pay3` decimal(10,2) DEFAULT '0.00',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `starttime` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `confirmtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_paytype` (`paytype`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_paytime` (`paytime`),
  KEY `idx_status` (`status`),
  KEY `idx_month` (`month`),
  KEY `idx_week` (`week`),
  KEY `idx_year` (`year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_abonus_billo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `billid` int(11) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `idx_billid` (`billid`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_abonus_billp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `billid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `payno` varchar(255) DEFAULT '',
  `paytype` tinyint(3) DEFAULT '0',
  `bonus1` decimal(10,4) DEFAULT '0.0000',
  `bonus2` decimal(10,4) DEFAULT '0.0000',
  `bonus3` decimal(10,4) DEFAULT '0.0000',
  `money1` decimal(10,2) DEFAULT '0.00',
  `realmoney1` decimal(10,2) DEFAULT '0.00',
  `paymoney1` decimal(10,2) DEFAULT '0.00',
  `money2` decimal(10,2) DEFAULT '0.00',
  `realmoney2` decimal(10,2) DEFAULT '0.00',
  `paymoney2` decimal(10,2) DEFAULT '0.00',
  `money3` decimal(10,2) DEFAULT '0.00',
  `realmoney3` decimal(10,2) DEFAULT '0.00',
  `paymoney3` decimal(10,2) DEFAULT '0.00',
  `chargemoney1` decimal(10,2) DEFAULT '0.00',
  `chargemoney2` decimal(10,2) DEFAULT '0.00',
  `chargemoney3` decimal(10,2) DEFAULT '0.00',
  `charge` decimal(10,2) DEFAULT '0.00',
  `status` tinyint(3) DEFAULT '0',
  `reason` varchar(255) DEFAULT '',
  `paytime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_billid` (`billid`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_abonus_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `levelname` varchar(50) DEFAULT '',
  `bonus1` decimal(10,4) DEFAULT '0.0000',
  `bonus2` decimal(10,4) DEFAULT '0.0000',
  `bonus3` decimal(10,4) DEFAULT '0.0000',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  `ordercount` int(11) DEFAULT '0',
  `bonusmoney` decimal(10,2) DEFAULT '0.00',
  `downcount` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  `shopid` int(11) DEFAULT '0',
  `iswxapp` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_area_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `new_area` tinyint(3) NOT NULL DEFAULT '0',
  `address_street` tinyint(3) NOT NULL DEFAULT '0',
  `createtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_title` varchar(255) NOT NULL DEFAULT '',
  `resp_desc` text NOT NULL,
  `resp_img` text NOT NULL,
  `article_content` longtext,
  `article_category` int(11) NOT NULL DEFAULT '0',
  `article_date_v` varchar(20) NOT NULL DEFAULT '',
  `article_date` varchar(20) NOT NULL DEFAULT '',
  `article_mp` varchar(50) NOT NULL DEFAULT '',
  `article_author` varchar(20) NOT NULL DEFAULT '',
  `article_readnum_v` int(11) NOT NULL DEFAULT '0',
  `article_readnum` int(11) NOT NULL DEFAULT '0',
  `article_likenum_v` int(11) NOT NULL DEFAULT '0',
  `article_likenum` int(11) NOT NULL DEFAULT '0',
  `article_linkurl` varchar(300) NOT NULL DEFAULT '',
  `article_rule_daynum` int(11) NOT NULL DEFAULT '0',
  `article_rule_allnum` int(11) NOT NULL DEFAULT '0',
  `article_rule_credit` int(11) NOT NULL DEFAULT '0',
  `article_rule_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `page_set_option_nocopy` int(1) NOT NULL DEFAULT '0',
  `page_set_option_noshare_tl` int(1) NOT NULL DEFAULT '0',
  `page_set_option_noshare_msg` int(1) NOT NULL DEFAULT '0',
  `article_keyword` varchar(255) NOT NULL DEFAULT '',
  `article_keyword2` varchar(255) NOT NULL DEFAULT '',
  `article_report` int(1) NOT NULL DEFAULT '0',
  `product_advs_type` int(1) NOT NULL DEFAULT '0',
  `product_advs_title` varchar(255) NOT NULL DEFAULT '',
  `product_advs_more` varchar(255) NOT NULL DEFAULT '',
  `product_advs_link` varchar(255) NOT NULL DEFAULT '',
  `product_advs` text NOT NULL,
  `article_state` int(1) NOT NULL DEFAULT '0',
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `network_attachment` varchar(255) DEFAULT '',
  `article_rule_credittotal` int(11) DEFAULT '0',
  `article_rule_moneytotal` decimal(10,2) DEFAULT '0.00',
  `article_rule_credit2` int(11) NOT NULL DEFAULT '0',
  `article_rule_money2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `article_rule_creditm` int(11) NOT NULL DEFAULT '0',
  `article_rule_moneym` decimal(10,2) NOT NULL DEFAULT '0.00',
  `article_rule_creditm2` int(11) NOT NULL DEFAULT '0',
  `article_rule_moneym2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `article_readtime` int(11) DEFAULT '0',
  `article_areas` varchar(255) DEFAULT '',
  `article_endtime` int(11) DEFAULT '0',
  `article_hasendtime` tinyint(3) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `article_advance` int(11) DEFAULT '0',
  `article_virtualadd` tinyint(3) DEFAULT '0',
  `article_visit` tinyint(3) DEFAULT '0',
  `article_visit_level` text,
  `article_visit_tip` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_article_title` (`article_title`),
  KEY `idx_article_keyword` (`article_keyword`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL DEFAULT '',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `isshow` tinyint(1) NOT NULL DEFAULT '0',
  `uniacid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_category_name` (`category_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_article_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL DEFAULT '0',
  `read` int(11) NOT NULL DEFAULT '0',
  `like` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `uniacid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_aid` (`aid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_article_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `aid` int(11) DEFAULT '0',
  `cate` varchar(255) NOT NULL DEFAULT '',
  `cons` varchar(255) NOT NULL DEFAULT '',
  `uniacid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_article_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL DEFAULT '0',
  `share_user` int(11) NOT NULL DEFAULT '0',
  `click_user` int(11) NOT NULL DEFAULT '0',
  `click_date` varchar(20) NOT NULL DEFAULT '',
  `add_credit` int(11) NOT NULL DEFAULT '0',
  `add_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `uniacid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_aid` (`aid`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_article_sys` (
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `article_message` varchar(255) NOT NULL DEFAULT '',
  `article_title` varchar(255) NOT NULL DEFAULT '',
  `article_image` varchar(300) NOT NULL DEFAULT '',
  `article_shownum` int(11) NOT NULL DEFAULT '0',
  `article_keyword` varchar(255) NOT NULL DEFAULT '',
  `article_source` varchar(255) NOT NULL DEFAULT '',
  `article_temp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uniacid`),
  KEY `idx_article_message` (`article_message`),
  KEY `idx_article_keyword` (`article_keyword`),
  KEY `idx_article_title` (`article_title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_author_bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `billno` varchar(100) DEFAULT '',
  `paytype` int(11) DEFAULT '0',
  `year` int(11) DEFAULT '0',
  `month` int(11) DEFAULT '0',
  `week` int(11) DEFAULT '0',
  `ordercount` int(11) DEFAULT '0',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  `bonusordermoney` decimal(10,2) DEFAULT '0.00',
  `bonusrate` decimal(10,2) DEFAULT '0.00',
  `bonusmoney` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_send` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_pay` decimal(10,2) DEFAULT '0.00',
  `paytime` int(11) DEFAULT '0',
  `partnercount` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `starttime` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `confirmtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_paytype` (`paytype`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_paytime` (`paytime`),
  KEY `idx_status` (`status`),
  KEY `idx_month` (`month`),
  KEY `idx_week` (`week`),
  KEY `idx_year` (`year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_author_billo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `billid` int(11) DEFAULT '0',
  `authorid` int(11) DEFAULT NULL,
  `orderid` text,
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `idx_billid` (`billid`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_author_billp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `billid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `payno` varchar(255) DEFAULT '',
  `paytype` tinyint(3) DEFAULT '0',
  `bonus` decimal(10,2) DEFAULT '0.00',
  `money` decimal(10,2) DEFAULT '0.00',
  `realmoney` decimal(10,2) DEFAULT '0.00',
  `paymoney` decimal(10,2) DEFAULT '0.00',
  `charge` decimal(10,2) DEFAULT '0.00',
  `chargemoney` decimal(10,2) DEFAULT '0.00',
  `status` tinyint(3) DEFAULT '0',
  `reason` varchar(255) DEFAULT '',
  `paytime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_billid` (`billid`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_author_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `levelname` varchar(50) DEFAULT '',
  `bonus` decimal(10,4) DEFAULT '0.0000',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  `ordercount` int(11) DEFAULT '0',
  `commissionmoney` decimal(10,2) DEFAULT '0.00',
  `bonusmoney` decimal(10,2) DEFAULT '0.00',
  `downcount` int(11) DEFAULT '0',
  `bonus_fg` varchar(500) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_author_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `teamno` varchar(50) DEFAULT '',
  `year` int(11) DEFAULT '0',
  `month` int(11) DEFAULT '0',
  `team_count` int(11) DEFAULT '0',
  `team_ids` longtext,
  `status` tinyint(1) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `paytime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `teamno` (`teamno`),
  KEY `year` (`year`),
  KEY `month` (`month`),
  KEY `status` (`status`),
  KEY `createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_author_team_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `teamid` int(11) DEFAULT '0',
  `mid` int(11) DEFAULT '0',
  `payno` varchar(255) DEFAULT '',
  `money` decimal(10,2) DEFAULT '0.00',
  `paymoney` decimal(10,2) DEFAULT '0.00',
  `paytime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_teamid` (`teamid`),
  KEY `idx_mid` (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `bannername` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  `shopid` int(11) DEFAULT '0',
  `iswxapp` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_bargain_account` (
  `id` int(11) NOT NULL,
  `mall_name` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `mall_title` varchar(255) DEFAULT NULL,
  `mall_content` varchar(255) DEFAULT NULL,
  `mall_logo` varchar(255) DEFAULT NULL,
  `message` int(11) DEFAULT '0',
  `partin` int(11) DEFAULT '0',
  `rule` text,
  `end_message` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_bargain_actor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `now_price` decimal(9,2) NOT NULL,
  `created_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `bargain_times` int(10) NOT NULL,
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(20) NOT NULL,
  `head_image` varchar(200) NOT NULL,
  `bargain_price` decimal(9,2) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `account_id` int(11) NOT NULL,
  `initiate` tinyint(4) NOT NULL DEFAULT '0',
  `order` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_bargain_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `goods_id` varchar(20) NOT NULL,
  `end_price` decimal(10,2) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `status` tinyint(2) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `user_set` text,
  `rule` text,
  `act_times` int(11) NOT NULL,
  `mode` tinyint(4) NOT NULL,
  `total_time` int(11) NOT NULL,
  `each_time` int(11) NOT NULL,
  `time_limit` int(11) NOT NULL,
  `probability` text NOT NULL,
  `custom` varchar(255) DEFAULT NULL,
  `maximum` int(11) DEFAULT NULL,
  `initiate` tinyint(4) NOT NULL DEFAULT '0',
  `myself` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_bargain_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actor_id` int(11) NOT NULL,
  `bargain_price` decimal(9,2) NOT NULL,
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(20) NOT NULL,
  `head_image` varchar(200) NOT NULL,
  `bargain_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_carrier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `realname` varchar(50) DEFAULT '',
  `mobile` varchar(50) DEFAULT '',
  `address` varchar(255) DEFAULT '',
  `deleted` tinyint(1) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_deleted` (`deleted`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_cashier_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `catename` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_cashier_clearing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `cashierid` int(11) DEFAULT '0',
  `clearno` varchar(64) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `money` decimal(10,2) DEFAULT '0.00',
  `realmoney` decimal(10,2) DEFAULT '0.00',
  `remark` varchar(500) DEFAULT '',
  `orderids` text,
  `createtime` int(11) DEFAULT '0',
  `paytime` int(11) DEFAULT '0',
  `deleted` tinyint(3) DEFAULT '0',
  `paytype` tinyint(1) DEFAULT '0',
  `payinfo` varchar(1000) DEFAULT '',
  `charge` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `storeid` (`cashierid`),
  KEY `status` (`status`),
  KEY `createtime` (`createtime`),
  KEY `deleted` (`deleted`),
  KEY `clearno` (`clearno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_cashier_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `cashierid` int(11) DEFAULT '0',
  `createtime` int(10) unsigned DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `image` varchar(255) DEFAULT '',
  `categoryid` tinyint(1) DEFAULT '0',
  `price` decimal(10,2) DEFAULT '0.00',
  `total` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `goodssn` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `cashierid` (`cashierid`),
  KEY `goodssn` (`goodssn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_cashier_goods_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `cashierid` int(11) DEFAULT '0',
  `catename` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_cashierid` (`cashierid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_cashier_operator` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `cashierid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `manageopenid` varchar(50) DEFAULT '',
  `username` varchar(255) DEFAULT '',
  `password` varchar(50) DEFAULT '',
  `salt` varchar(8) DEFAULT '',
  `perm` text,
  `createtime` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `cashierid` (`cashierid`),
  KEY `manageopenid` (`manageopenid`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_cashier_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `ordersn` varchar(255) DEFAULT '',
  `price` decimal(10,2) DEFAULT '0.00',
  `openid` varchar(50) DEFAULT '',
  `payopenid` varchar(50) DEFAULT '',
  `createtime` int(10) unsigned DEFAULT '0',
  `status` tinyint(4) DEFAULT '0',
  `paytime` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_cashier_pay_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `cashierid` int(11) DEFAULT '0',
  `operatorid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `paytype` tinyint(3) DEFAULT NULL,
  `logno` varchar(255) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `money` decimal(10,2) DEFAULT '0.00',
  `paytime` int(11) DEFAULT '0',
  `is_applypay` tinyint(1) DEFAULT '0',
  `randommoney` decimal(10,2) DEFAULT '0.00',
  `enough` decimal(10,2) DEFAULT '0.00',
  `mobile` varchar(20) DEFAULT '',
  `deduction` decimal(10,2) DEFAULT '0.00',
  `discountmoney` decimal(10,2) DEFAULT '0.00',
  `discount` decimal(5,2) DEFAULT '0.00',
  `isgoods` tinyint(1) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `orderprice` decimal(10,2) DEFAULT '0.00',
  `goodsprice` decimal(10,2) DEFAULT '0.00',
  `couponpay` decimal(10,2) DEFAULT '0.00',
  `payopenid` varchar(50) DEFAULT '',
  `nosalemoney` decimal(10,2) DEFAULT '0.00',
  `coupon` int(11) DEFAULT '0',
  `usecoupon` int(11) DEFAULT '0',
  `usecouponprice` decimal(10,2) DEFAULT '0.00',
  `present_credit1` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_type` (`paytype`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_status` (`status`),
  KEY `idx_storeid` (`cashierid`),
  KEY `idx_logno` (`logno`),
  KEY `is_applypay` (`is_applypay`),
  KEY `orderid` (`orderid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_cashier_pay_log_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cashierid` int(11) DEFAULT '0',
  `logid` int(11) DEFAULT '0',
  `goodsid` int(11) DEFAULT '0',
  `price` decimal(10,2) DEFAULT '0.00',
  `total` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `logid` (`logid`),
  KEY `goodsid` (`goodsid`),
  KEY `cashierid` (`cashierid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_cashier_qrcode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `cashierid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `goodstitle` varchar(255) DEFAULT '',
  `money` decimal(10,2) DEFAULT '0.00',
  `createtime` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `cashierid` (`cashierid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_cashier_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `storeid` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `setmeal` tinyint(3) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `logo` varchar(255) DEFAULT '',
  `manageopenid` varchar(50) DEFAULT '',
  `isopen_commission` tinyint(1) DEFAULT '0',
  `name` varchar(50) DEFAULT '',
  `mobile` varchar(50) DEFAULT '',
  `categoryid` int(11) DEFAULT '0',
  `wechat_status` tinyint(1) DEFAULT '0',
  `wechatpay` text,
  `alipay_status` tinyint(1) DEFAULT '0',
  `alipay` text,
  `withdraw` decimal(10,2) DEFAULT '0.00',
  `openid` varchar(50) DEFAULT '',
  `diyformfields` text,
  `diyformdata` text,
  `createtime` int(11) DEFAULT '0',
  `username` varchar(255) DEFAULT '',
  `password` varchar(32) DEFAULT '',
  `salt` char(8) DEFAULT '',
  `lifetimestart` int(10) unsigned DEFAULT '0',
  `lifetimeend` int(10) unsigned DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `set` longtext,
  `deleted` tinyint(1) DEFAULT '0',
  `can_withdraw` tinyint(1) DEFAULT '0',
  `show_paytype` tinyint(1) DEFAULT '0',
  `couponid` varchar(255) DEFAULT '',
  `management` varchar(1000) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `openid` (`manageopenid`),
  KEY `username` (`username`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT '0',
  `isrecommand` int(10) DEFAULT '0',
  `description` varchar(500) DEFAULT NULL,
  `displayorder` tinyint(3) unsigned DEFAULT '0',
  `enabled` tinyint(1) DEFAULT '1',
  `ishome` tinyint(3) DEFAULT '0',
  `level` tinyint(3) DEFAULT NULL,
  `advimg` varchar(255) DEFAULT '',
  `advurl` varchar(500) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_parentid` (`parentid`),
  KEY `idx_isrecommand` (`isrecommand`),
  KEY `idx_ishome` (`ishome`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_commission_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `applyno` varchar(255) DEFAULT '',
  `mid` int(11) DEFAULT '0',
  `type` tinyint(3) DEFAULT '0',
  `orderids` longtext,
  `commission` decimal(10,2) DEFAULT '0.00',
  `commission_pay` decimal(10,2) DEFAULT '0.00',
  `content` text,
  `status` tinyint(3) DEFAULT '0',
  `applytime` int(11) DEFAULT '0',
  `checktime` int(11) DEFAULT '0',
  `paytime` int(11) DEFAULT '0',
  `invalidtime` int(11) DEFAULT '0',
  `refusetime` int(11) DEFAULT '0',
  `realmoney` decimal(10,2) DEFAULT '0.00',
  `charge` decimal(10,2) DEFAULT '0.00',
  `deductionmoney` decimal(10,2) DEFAULT '0.00',
  `beginmoney` decimal(10,2) DEFAULT '0.00',
  `endmoney` decimal(10,2) DEFAULT '0.00',
  `alipay` varchar(50) NOT NULL DEFAULT '',
  `bankname` varchar(50) NOT NULL DEFAULT '',
  `bankcard` varchar(50) NOT NULL DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `repurchase` decimal(10,2) DEFAULT '0.00',
  `alipay1` varchar(50) NOT NULL DEFAULT '',
  `bankname1` varchar(50) NOT NULL DEFAULT '',
  `bankcard1` varchar(50) NOT NULL DEFAULT '',
  `sendmoney` decimal(10,2) DEFAULT '0.00',
  `senddata` text,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_mid` (`mid`),
  KEY `idx_checktime` (`checktime`),
  KEY `idx_paytime` (`paytime`),
  KEY `idx_applytime` (`applytime`),
  KEY `idx_status` (`status`),
  KEY `idx_invalidtime` (`invalidtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_commission_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `bankname` varchar(255) NOT NULL DEFAULT '',
  `content` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_commission_clickcount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `from_openid` varchar(255) DEFAULT '',
  `clicktime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_from_openid` (`from_openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_commission_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `levelname` varchar(50) DEFAULT '',
  `commission1` decimal(10,2) DEFAULT '0.00',
  `commission2` decimal(10,2) DEFAULT '0.00',
  `commission3` decimal(10,2) DEFAULT '0.00',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  `ordercount` int(11) DEFAULT '0',
  `downcount` varchar(255) DEFAULT '',
  `commissionmoney` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_commission_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `applyid` int(11) DEFAULT '0',
  `mid` int(11) DEFAULT '0',
  `commission` decimal(10,2) DEFAULT '0.00',
  `createtime` int(11) DEFAULT '0',
  `commission_pay` decimal(10,2) DEFAULT '0.00',
  `realmoney` decimal(10,2) DEFAULT '0.00',
  `charge` decimal(10,2) DEFAULT '0.00',
  `deductionmoney` decimal(10,2) DEFAULT '0.00',
  `type` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_applyid` (`applyid`),
  KEY `idx_mid` (`mid`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_commission_rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `num` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_commission_repurchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `year` int(4) DEFAULT '0',
  `month` tinyint(2) DEFAULT '0',
  `repurchase` decimal(10,2) DEFAULT '0.00',
  `applyid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `applyid` (`applyid`),
  KEY `openid` (`openid`),
  KEY `uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_commission_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `mid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `logo` varchar(255) DEFAULT '',
  `img` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT '',
  `selectgoods` tinyint(3) DEFAULT '0',
  `selectcategory` tinyint(3) DEFAULT '0',
  `goodsids` text,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_mid` (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `catid` int(11) DEFAULT '0',
  `couponname` varchar(255) DEFAULT '',
  `gettype` tinyint(3) DEFAULT '0',
  `getmax` int(11) DEFAULT '0',
  `usetype` tinyint(3) DEFAULT '0',
  `returntype` tinyint(3) DEFAULT '0',
  `bgcolor` varchar(255) DEFAULT '',
  `enough` decimal(10,2) DEFAULT '0.00',
  `timelimit` tinyint(3) DEFAULT '0',
  `coupontype` tinyint(3) DEFAULT '0',
  `timedays` int(11) DEFAULT '0',
  `timestart` int(11) DEFAULT '0',
  `timeend` int(11) DEFAULT '0',
  `discount` decimal(10,2) DEFAULT '0.00',
  `deduct` decimal(10,2) DEFAULT '0.00',
  `backtype` tinyint(3) DEFAULT '0',
  `backmoney` varchar(50) DEFAULT '',
  `backcredit` varchar(50) DEFAULT '',
  `backredpack` varchar(50) DEFAULT '',
  `backwhen` tinyint(3) DEFAULT '0',
  `thumb` varchar(255) DEFAULT '',
  `desc` text,
  `createtime` int(11) DEFAULT '0',
  `total` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `money` decimal(10,2) DEFAULT '0.00',
  `respdesc` text,
  `respthumb` varchar(255) DEFAULT '',
  `resptitle` varchar(255) DEFAULT '',
  `respurl` varchar(255) DEFAULT '',
  `credit` int(11) DEFAULT '0',
  `usecredit2` tinyint(3) DEFAULT '0',
  `remark` varchar(1000) DEFAULT '',
  `descnoset` tinyint(3) DEFAULT '0',
  `pwdkey` varchar(255) DEFAULT '',
  `pwdkey2` varchar(255) DEFAULT '',
  `pwdsuc` text,
  `pwdfail` text,
  `pwdurl` varchar(255) DEFAULT '',
  `pwdask` text,
  `pwdstatus` tinyint(3) DEFAULT '0',
  `pwdtimes` int(11) DEFAULT '0',
  `pwdfull` text,
  `pwdwords` text,
  `pwdopen` tinyint(3) DEFAULT '0',
  `pwdown` text,
  `pwdexit` varchar(255) DEFAULT '',
  `pwdexitstr` text,
  `displayorder` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `limitgoodtype` tinyint(1) DEFAULT '0',
  `limitgoodcatetype` tinyint(1) DEFAULT '0',
  `limitgoodcateids` varchar(500) DEFAULT '',
  `limitgoodids` varchar(500) DEFAULT '',
  `islimitlevel` tinyint(1) DEFAULT '0',
  `limitmemberlevels` varchar(500) DEFAULT '',
  `limitagentlevels` varchar(500) DEFAULT '',
  `limitpartnerlevels` varchar(500) DEFAULT '',
  `limitaagentlevels` varchar(500) DEFAULT '',
  `tagtitle` varchar(20) DEFAULT '',
  `settitlecolor` tinyint(1) DEFAULT '0',
  `titlecolor` varchar(10) DEFAULT '',
  `limitdiscounttype` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_coupontype` (`coupontype`),
  KEY `idx_timestart` (`timestart`),
  KEY `idx_timeend` (`timeend`),
  KEY `idx_timelimit` (`timelimit`),
  KEY `idx_status` (`status`),
  KEY `idx_givetype` (`backtype`),
  KEY `idx_catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_coupon_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_coupon_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `couponid` int(11) DEFAULT '0',
  `gettype` tinyint(3) DEFAULT '0',
  `used` int(11) DEFAULT '0',
  `usetime` int(11) DEFAULT '0',
  `gettime` int(11) DEFAULT '0',
  `senduid` int(11) DEFAULT '0',
  `ordersn` varchar(255) DEFAULT '',
  `back` tinyint(3) DEFAULT '0',
  `backtime` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `isnew` tinyint(1) DEFAULT '1',
  `nocount` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_couponid` (`couponid`),
  KEY `idx_gettype` (`gettype`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_coupon_goodsendtask` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `goodsid` int(11) DEFAULT '0',
  `couponid` int(11) DEFAULT '0',
  `starttime` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `sendnum` int(11) DEFAULT '1',
  `num` int(11) DEFAULT '0',
  `sendpoint` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_coupon_guess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `couponid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `times` int(11) DEFAULT '0',
  `pwdkey` varchar(255) DEFAULT '',
  `ok` tinyint(3) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_couponid` (`couponid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_coupon_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `logno` varchar(255) DEFAULT '',
  `openid` varchar(255) DEFAULT '',
  `couponid` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `paystatus` tinyint(3) DEFAULT '0',
  `creditstatus` tinyint(3) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `paytype` tinyint(3) DEFAULT '0',
  `getfrom` tinyint(3) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_couponid` (`couponid`),
  KEY `idx_status` (`status`),
  KEY `idx_paystatus` (`paystatus`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_getfrom` (`getfrom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_coupon_sendshow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `showkey` varchar(20) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `coupondataid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_coupon_sendtasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `enough` decimal(10,2) DEFAULT '0.00',
  `couponid` int(11) DEFAULT '0',
  `starttime` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `sendnum` int(11) DEFAULT '1',
  `num` int(11) DEFAULT '0',
  `sendpoint` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_coupon_taskdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL,
  `taskid` int(11) DEFAULT '0',
  `couponid` int(11) DEFAULT '0',
  `sendnum` int(11) DEFAULT '0',
  `tasktype` tinyint(1) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `parentorderid` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `sendpoint` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_creditshop_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  `merchid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_creditshop_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `displayorder` tinyint(3) unsigned DEFAULT '0',
  `enabled` tinyint(1) DEFAULT '1',
  `advimg` varchar(255) DEFAULT '',
  `advurl` varchar(500) DEFAULT '',
  `isrecommand` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_enabled` (`enabled`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_creditshop_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `logid` int(11) NOT NULL DEFAULT '0',
  `logno` varchar(50) NOT NULL DEFAULT '',
  `goodsid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `headimg` varchar(255) DEFAULT NULL,
  `level` tinyint(3) NOT NULL DEFAULT '0',
  `content` varchar(255) DEFAULT NULL,
  `images` text,
  `time` int(11) NOT NULL DEFAULT '0',
  `reply_content` varchar(255) DEFAULT NULL,
  `reply_images` text,
  `reply_time` int(11) NOT NULL DEFAULT '0',
  `append_content` varchar(255) DEFAULT NULL,
  `append_images` text,
  `append_time` int(11) NOT NULL DEFAULT '0',
  `append_reply_content` varchar(255) DEFAULT NULL,
  `append_reply_images` text,
  `append_reply_time` int(11) NOT NULL DEFAULT '0',
  `istop` tinyint(3) NOT NULL DEFAULT '0',
  `checked` tinyint(3) NOT NULL DEFAULT '0',
  `append_checked` tinyint(3) NOT NULL DEFAULT '0',
  `virtual` tinyint(3) NOT NULL DEFAULT '0',
  `deleted` tinyint(3) NOT NULL DEFAULT '0',
  `merchid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_creditshop_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `cate` int(11) DEFAULT '0',
  `thumb` varchar(255) DEFAULT '',
  `price` decimal(10,2) DEFAULT '0.00',
  `type` tinyint(3) DEFAULT '0',
  `credit` int(11) DEFAULT '0',
  `money` decimal(10,2) DEFAULT '0.00',
  `total` int(11) DEFAULT '0',
  `totalday` int(11) DEFAULT '0',
  `chance` int(11) DEFAULT '0',
  `chanceday` int(11) DEFAULT '0',
  `detail` text,
  `rate1` int(11) DEFAULT '0',
  `rate2` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `joins` int(11) DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `deleted` tinyint(3) DEFAULT '0',
  `showlevels` text,
  `buylevels` text,
  `showgroups` text,
  `buygroups` text,
  `vip` tinyint(3) DEFAULT '0',
  `istop` tinyint(3) DEFAULT '0',
  `isrecommand` tinyint(3) DEFAULT '0',
  `istime` tinyint(3) DEFAULT '0',
  `timestart` int(11) DEFAULT '0',
  `timeend` int(11) DEFAULT '0',
  `share_title` varchar(255) DEFAULT '',
  `share_icon` varchar(255) DEFAULT '',
  `share_desc` varchar(500) DEFAULT '',
  `followneed` tinyint(3) DEFAULT '0',
  `followtext` varchar(255) DEFAULT '',
  `subtitle` varchar(255) DEFAULT '',
  `subdetail` text,
  `noticedetail` text,
  `usedetail` varchar(255) DEFAULT '',
  `goodsdetail` text,
  `isendtime` tinyint(3) DEFAULT '0',
  `usecredit2` tinyint(3) DEFAULT '0',
  `area` varchar(255) DEFAULT '',
  `dispatch` decimal(10,2) DEFAULT '0.00',
  `storeids` text,
  `noticeopenid` varchar(255) DEFAULT '',
  `noticetype` tinyint(3) DEFAULT '0',
  `isverify` tinyint(3) DEFAULT '0',
  `goodstype` tinyint(3) DEFAULT '0',
  `couponid` int(11) DEFAULT '0',
  `goodsid` int(11) DEFAULT '0',
  `merchid` int(11) NOT NULL DEFAULT '0',
  `productprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `mincredit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `minmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `maxcredit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `dispatchtype` tinyint(3) NOT NULL DEFAULT '0',
  `dispatchid` int(11) NOT NULL DEFAULT '0',
  `verifytype` tinyint(3) NOT NULL DEFAULT '0',
  `verifynum` int(11) NOT NULL DEFAULT '0',
  `grant1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `grant2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `goodssn` varchar(255) NOT NULL,
  `productsn` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL,
  `showtotal` tinyint(3) NOT NULL,
  `totalcnf` tinyint(3) NOT NULL,
  `usetime` int(11) NOT NULL,
  `hasoption` tinyint(3) NOT NULL,
  `noticedetailshow` tinyint(3) NOT NULL,
  `detailshow` tinyint(3) NOT NULL,
  `packetmoney` decimal(10,2) NOT NULL,
  `surplusmoney` decimal(10,2) NOT NULL,
  `packetlimit` decimal(10,2) NOT NULL,
  `packettype` tinyint(3) NOT NULL,
  `minpacketmoney` decimal(10,2) NOT NULL,
  `packettotal` int(11) NOT NULL,
  `packetsurplus` int(11) NOT NULL,
  `maxmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_type` (`type`),
  KEY `idx_endtime` (`endtime`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_status` (`status`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_deleted` (`deleted`),
  KEY `idx_istop` (`istop`),
  KEY `idx_isrecommand` (`isrecommand`),
  KEY `idx_istime` (`istime`),
  KEY `idx_timestart` (`timestart`),
  KEY `idx_timeend` (`timeend`),
  KEY `idx_goodstype` (`goodstype`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_creditshop_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `logno` varchar(255) DEFAULT '',
  `eno` varchar(255) DEFAULT '',
  `openid` varchar(255) DEFAULT '',
  `goodsid` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `paystatus` tinyint(3) DEFAULT '0',
  `paytype` tinyint(3) DEFAULT '-1',
  `dispatchstatus` tinyint(3) DEFAULT '0',
  `creditpay` tinyint(3) DEFAULT '0',
  `addressid` int(11) DEFAULT '0',
  `dispatchno` varchar(255) DEFAULT '',
  `usetime` int(11) DEFAULT '0',
  `express` varchar(255) DEFAULT '',
  `expresssn` varchar(255) DEFAULT '',
  `expresscom` varchar(255) DEFAULT '',
  `verifyopenid` varchar(255) DEFAULT '',
  `transid` varchar(255) DEFAULT '',
  `dispatchtransid` varchar(255) DEFAULT '',
  `storeid` int(11) DEFAULT '0',
  `realname` varchar(255) DEFAULT '',
  `mobile` varchar(255) DEFAULT '',
  `couponid` int(11) DEFAULT '0',
  `dupdate1` tinyint(3) DEFAULT '0',
  `address` text,
  `optionid` int(11) NOT NULL DEFAULT '0',
  `time_send` int(11) NOT NULL DEFAULT '0',
  `time_finish` int(11) NOT NULL DEFAULT '0',
  `iscomment` tinyint(3) NOT NULL DEFAULT '0',
  `dispatchtime` int(11) NOT NULL DEFAULT '0',
  `verifynum` int(11) NOT NULL DEFAULT '1',
  `verifytime` int(11) NOT NULL DEFAULT '0',
  `merchid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_creditshop_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `thumb` varchar(60) DEFAULT '',
  `credit` int(10) NOT NULL DEFAULT '0',
  `money` decimal(10,2) DEFAULT '0.00',
  `total` int(11) DEFAULT '0',
  `weight` decimal(10,2) DEFAULT '0.00',
  `displayorder` int(11) DEFAULT '0',
  `specs` text,
  `skuId` varchar(255) DEFAULT '',
  `goodssn` varchar(255) DEFAULT '',
  `productsn` varchar(255) DEFAULT '',
  `virtual` int(11) DEFAULT '0',
  `exchange_stock` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_creditshop_spec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(11) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `description` varchar(1000) DEFAULT '',
  `displaytype` tinyint(3) DEFAULT '0',
  `content` text,
  `displayorder` int(11) DEFAULT '0',
  `propId` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_creditshop_spec_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `specid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `show` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `valueId` varchar(255) DEFAULT '',
  `virtual` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_creditshop_verify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(45) DEFAULT '0',
  `logid` int(11) DEFAULT '0',
  `verifycode` varchar(45) DEFAULT NULL,
  `storeid` int(11) DEFAULT '0',
  `verifier` varchar(45) DEFAULT '0',
  `isverify` tinyint(3) DEFAULT '0',
  `verifytime` int(11) DEFAULT '0',
  `merchid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `kf_id` varchar(255) DEFAULT NULL,
  `kf_account` varchar(255) DEFAULT '',
  `kf_nick` varchar(255) DEFAULT '',
  `kf_pwd` varchar(255) DEFAULT '',
  `kf_headimgurl` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_customer_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_customer_guestbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `realname` varchar(11) DEFAULT '',
  `mobile` varchar(255) DEFAULT '',
  `weixin` varchar(255) DEFAULT '',
  `images` text,
  `content` text,
  `remark` text,
  `status` tinyint(3) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `deleted` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_customer_robot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `cate` int(11) DEFAULT '0',
  `keywords` varchar(500) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `content` longtext,
  `url` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_cate` (`cate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_designer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `pagename` varchar(255) NOT NULL DEFAULT '',
  `pagetype` tinyint(3) NOT NULL DEFAULT '0',
  `pageinfo` text NOT NULL,
  `createtime` varchar(255) NOT NULL DEFAULT '',
  `keyword` varchar(255) DEFAULT '',
  `savetime` varchar(255) NOT NULL DEFAULT '',
  `setdefault` tinyint(3) NOT NULL DEFAULT '0',
  `datas` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_pagetype` (`pagetype`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_designer_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `menuname` varchar(255) DEFAULT '',
  `isdefault` tinyint(3) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `menus` text,
  `params` text,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_isdefault` (`isdefault`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_dispatch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `dispatchname` varchar(50) DEFAULT '',
  `dispatchtype` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `firstprice` decimal(10,2) DEFAULT '0.00',
  `secondprice` decimal(10,2) DEFAULT '0.00',
  `firstweight` int(11) DEFAULT '0',
  `secondweight` int(11) DEFAULT '0',
  `express` varchar(250) DEFAULT '',
  `areas` text,
  `carriers` text,
  `enabled` int(11) DEFAULT '0',
  `calculatetype` tinyint(1) DEFAULT '0',
  `firstnum` int(11) DEFAULT '0',
  `secondnum` int(11) DEFAULT '0',
  `firstnumprice` decimal(10,2) DEFAULT '0.00',
  `secondnumprice` decimal(10,2) DEFAULT '0.00',
  `isdefault` tinyint(1) DEFAULT '0',
  `shopid` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `nodispatchareas` text,
  `nodispatchareas_code` text NOT NULL,
  `isdispatcharea` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_diyform_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_diyform_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `typeid` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) DEFAULT '0',
  `diyformfields` text,
  `fields` text NOT NULL,
  `openid` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_typeid` (`typeid`),
  KEY `idx_cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_diyform_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `typeid` int(11) DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  `diyformfields` text,
  `fields` text NOT NULL,
  `openid` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) DEFAULT '0',
  `diyformid` int(11) DEFAULT '0',
  `diyformdata` text,
  `carrier_realname` varchar(255) DEFAULT '',
  `carrier_mobile` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_diyform_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `cate` int(11) DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `fields` text NOT NULL,
  `usedata` int(11) NOT NULL DEFAULT '0',
  `alldata` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_cate` (`cate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_diypage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `data` longtext NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `lastedittime` int(11) NOT NULL DEFAULT '0',
  `keyword` varchar(255) NOT NULL DEFAULT '',
  `diymenu` int(11) NOT NULL DEFAULT '0',
  `merch` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_type` (`type`),
  KEY `idx_keyword` (`keyword`),
  KEY `idx_lastedittime` (`lastedittime`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_diypage_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `lastedittime` int(11) NOT NULL DEFAULT '0',
  `merch` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_lastedittime` (`lastedittime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_diypage_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `data` longtext NOT NULL,
  `preview` varchar(255) NOT NULL DEFAULT '',
  `tplid` int(11) DEFAULT '0',
  `cate` int(11) DEFAULT '0',
  `deleted` tinyint(3) DEFAULT '0',
  `merch` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_type` (`type`),
  KEY `idx_cate` (`cate`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_diypage_template_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `merch` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_exchange_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(100) DEFAULT NULL,
  `goodsid` int(11) DEFAULT NULL,
  `total` int(10) DEFAULT '1',
  `marketprice` decimal(10,2) DEFAULT NULL,
  `optionid` int(11) DEFAULT NULL,
  `selected` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `groupid` int(11) DEFAULT NULL,
  `serial` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_exchange_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL DEFAULT '0',
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `endtime` datetime NOT NULL DEFAULT '2016-10-01 00:00:00',
  `status` int(2) NOT NULL DEFAULT '1',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `count` int(11) NOT NULL DEFAULT '0',
  `key` varchar(255) NOT NULL DEFAULT '',
  `type` int(11) NOT NULL DEFAULT '0',
  `scene` int(11) NOT NULL DEFAULT '0',
  `qrcode_url` varchar(255) NOT NULL DEFAULT '',
  `serial` varchar(255) NOT NULL DEFAULT '',
  `balancestatus` int(11) DEFAULT '1',
  `redstatus` int(11) DEFAULT '1',
  `scorestatus` int(11) DEFAULT '1',
  `couponstatus` int(11) DEFAULT '1',
  `goodsstatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_exchange_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `type` int(2) NOT NULL DEFAULT '0',
  `endtime` datetime NOT NULL DEFAULT '2016-10-01 00:00:00',
  `mode` int(2) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `max` int(2) NOT NULL DEFAULT '0',
  `value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `starttime` datetime NOT NULL DEFAULT '2016-10-01 00:00:00',
  `goods` text,
  `score` int(11) NOT NULL DEFAULT '0',
  `coupon` text,
  `use` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT '0',
  `red` decimal(10,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `balance_left` decimal(10,2) NOT NULL DEFAULT '0.00',
  `balance_right` decimal(10,2) NOT NULL DEFAULT '0.00',
  `red_left` decimal(10,2) NOT NULL DEFAULT '0.00',
  `red_right` decimal(10,2) NOT NULL DEFAULT '0.00',
  `score_left` int(11) NOT NULL DEFAULT '0',
  `score_right` int(11) NOT NULL DEFAULT '0',
  `balance_type` int(11) NOT NULL,
  `red_type` int(11) NOT NULL,
  `score_type` int(11) NOT NULL,
  `title_reply` varchar(255) NOT NULL DEFAULT '',
  `img` varchar(255) NOT NULL DEFAULT '',
  `content` varchar(255) NOT NULL DEFAULT '',
  `rule` text NOT NULL,
  `coupon_type` varchar(255) DEFAULT NULL,
  `basic_content` varchar(500) NOT NULL DEFAULT '',
  `reply_type` int(11) NOT NULL DEFAULT '0',
  `code_type` int(11) NOT NULL DEFAULT '0',
  `binding` int(11) NOT NULL DEFAULT '0',
  `showcount` int(11) DEFAULT '0',
  `postage` decimal(10,2) DEFAULT '0.00',
  `postage_type` int(11) DEFAULT '0',
  `banner` varchar(800) DEFAULT '',
  `keyword_reply` int(11) DEFAULT '0',
  `reply_status` int(11) DEFAULT '1',
  `reply_keyword` varchar(255) DEFAULT '',
  `input_banner` varchar(255) DEFAULT '',
  `diypage` int(11) NOT NULL DEFAULT '0',
  `sendname` varchar(255) DEFAULT '',
  `wishing` varchar(255) DEFAULT '',
  `actname` varchar(255) DEFAULT '',
  `remark` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_exchange_query` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `querykey` varchar(255) NOT NULL DEFAULT '',
  `querytime` int(11) NOT NULL DEFAULT '0',
  `unfreeze` int(11) NOT NULL DEFAULT '0',
  `errorcount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_exchange_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL DEFAULT '',
  `uniacid` int(11) DEFAULT NULL,
  `goods` text,
  `orderid` varchar(255) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL DEFAULT '',
  `mode` int(11) NOT NULL DEFAULT '0',
  `balance` decimal(10,2) DEFAULT '0.00',
  `red` decimal(10,2) NOT NULL DEFAULT '0.00',
  `coupon` text,
  `score` int(11) NOT NULL DEFAULT '0',
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `groupid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `serial` varchar(255) NOT NULL DEFAULT '',
  `ordersn` varchar(255) NOT NULL DEFAULT '',
  `goods_title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_exchange_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `freeze` int(11) NOT NULL DEFAULT '0',
  `mistake` int(11) NOT NULL DEFAULT '0',
  `grouplimit` int(11) NOT NULL DEFAULT '0',
  `alllimit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_exhelper_express` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `type` int(1) NOT NULL DEFAULT '1',
  `expressname` varchar(255) DEFAULT '',
  `expresscom` varchar(255) NOT NULL DEFAULT '',
  `express` varchar(255) NOT NULL DEFAULT '',
  `width` decimal(10,2) DEFAULT '0.00',
  `datas` text,
  `height` decimal(10,2) DEFAULT '0.00',
  `bg` varchar(255) DEFAULT '',
  `isdefault` tinyint(3) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_isdefault` (`isdefault`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_exhelper_senduser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `sendername` varchar(255) DEFAULT '',
  `sendertel` varchar(255) DEFAULT '',
  `sendersign` varchar(255) DEFAULT '',
  `sendercode` int(11) DEFAULT NULL,
  `senderaddress` varchar(255) DEFAULT '',
  `sendercity` varchar(255) DEFAULT NULL,
  `isdefault` tinyint(3) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_isdefault` (`isdefault`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_exhelper_sys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(20) NOT NULL DEFAULT 'localhost',
  `ip_cloud` varchar(255) NOT NULL DEFAULT '',
  `port` int(11) NOT NULL DEFAULT '8000',
  `port_cloud` int(11) NOT NULL DEFAULT '8000',
  `is_cloud` int(1) NOT NULL DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_express` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '',
  `express` varchar(50) DEFAULT '',
  `status` tinyint(1) DEFAULT '1',
  `displayorder` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_express_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expresssn` varchar(50) DEFAULT NULL,
  `express` varchar(50) DEFAULT NULL,
  `lasttime` int(11) NOT NULL,
  `datas` text,
  PRIMARY KEY (`id`),
  KEY `idx_expresssn` (`expresssn`),
  KEY `idx_express` (`express`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '0',
  `type` tinyint(1) DEFAULT '1',
  `status` tinyint(1) DEFAULT '0',
  `feedbackid` varchar(100) DEFAULT '',
  `transid` varchar(100) DEFAULT '',
  `reason` varchar(1000) DEFAULT '',
  `solution` varchar(1000) DEFAULT '',
  `remark` varchar(1000) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_feedbackid` (`feedbackid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_transid` (`transid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `isrequire` tinyint(3) DEFAULT '0',
  `key` varchar(255) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `type` varchar(255) DEFAULT '',
  `values` text,
  `cate` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_form_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_funbar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `datas` text,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_gift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `activity` tinyint(3) NOT NULL DEFAULT '1',
  `orderprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `goodsid` varchar(255) NOT NULL,
  `giftgoodsid` varchar(255) NOT NULL,
  `starttime` int(11) NOT NULL DEFAULT '0',
  `endtime` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `share_title` varchar(255) NOT NULL,
  `share_icon` varchar(255) NOT NULL,
  `share_desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_globonus_bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `billno` varchar(100) DEFAULT '',
  `paytype` int(11) DEFAULT '0',
  `year` int(11) DEFAULT '0',
  `month` int(11) DEFAULT '0',
  `week` int(11) DEFAULT '0',
  `ordercount` int(11) DEFAULT '0',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  `bonusmoney` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_send` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_pay` decimal(10,2) DEFAULT '0.00',
  `paytime` int(11) DEFAULT '0',
  `partnercount` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `starttime` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `confirmtime` int(11) DEFAULT '0',
  `bonusordermoney` decimal(10,2) DEFAULT '0.00',
  `bonusrate` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_paytype` (`paytype`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_paytime` (`paytime`),
  KEY `idx_status` (`status`),
  KEY `idx_month` (`month`),
  KEY `idx_week` (`week`),
  KEY `idx_year` (`year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_globonus_billo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `billid` int(11) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `idx_billid` (`billid`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_globonus_billp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `billid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `payno` varchar(255) DEFAULT '',
  `paytype` tinyint(3) DEFAULT '0',
  `bonus` decimal(10,2) DEFAULT '0.00',
  `money` decimal(10,2) DEFAULT '0.00',
  `realmoney` decimal(10,2) DEFAULT '0.00',
  `paymoney` decimal(10,2) DEFAULT '0.00',
  `charge` decimal(10,2) DEFAULT '0.00',
  `chargemoney` decimal(10,2) DEFAULT '0.00',
  `status` tinyint(3) DEFAULT '0',
  `reason` varchar(255) DEFAULT '',
  `paytime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_billid` (`billid`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_globonus_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `levelname` varchar(50) DEFAULT '',
  `bonus` decimal(10,4) DEFAULT '0.0000',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  `ordercount` int(11) DEFAULT '0',
  `commissionmoney` decimal(10,2) DEFAULT '0.00',
  `bonusmoney` decimal(10,2) DEFAULT '0.00',
  `downcount` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_goods` (
  `allcates` text,
  `artid` int(11) DEFAULT '0',
  `autoreceive` int(11) DEFAULT '0',
  `bargain` int(11) DEFAULT '0',
  `buyagain_commission` text,
  `buyagain_condition` tinyint(1) DEFAULT '0',
  `buyagain_islong` tinyint(1) DEFAULT '0',
  `buyagain_sale` tinyint(1) DEFAULT '0',
  `buyagain` decimal(10,2) DEFAULT '0.00',
  `buycontent` text,
  `buygroups` text,
  `buylevels` text,
  `buyshow` tinyint(1) DEFAULT '0',
  `cannotrefund` tinyint(3) DEFAULT '0',
  `cash` tinyint(3) DEFAULT '0',
  `cashier` tinyint(1) DEFAULT '0',
  `catch_id` varchar(255) DEFAULT '',
  `catch_source` varchar(255) DEFAULT '',
  `catch_url` varchar(255) DEFAULT '',
  `cates` text,
  `catesinit3` text,
  `ccate` int(11) DEFAULT '0',
  `ccates` text,
  `checked` tinyint(3) DEFAULT '0',
  `city` varchar(255) DEFAULT '',
  `commission_thumb` varchar(255) DEFAULT '',
  `commission` text,
  `commission1_pay` decimal(10,2) DEFAULT '0.00',
  `commission1_rate` decimal(10,2) DEFAULT '0.00',
  `commission2_pay` decimal(10,2) DEFAULT '0.00',
  `commission2_rate` decimal(10,2) DEFAULT '0.00',
  `commission3_pay` decimal(10,2) DEFAULT '0.00',
  `commission3_rate` decimal(10,2) DEFAULT '0.00',
  `content` text,
  `costprice` decimal(10,2) DEFAULT '0.00',
  `createtime` int(11) DEFAULT '0',
  `credit` varchar(255) DEFAULT NULL,
  `deduct` decimal(10,2) DEFAULT '0.00',
  `deduct2` decimal(10,2) DEFAULT '0.00',
  `deleted` tinyint(3) DEFAULT '0',
  `description` varchar(1000) DEFAULT NULL,
  `detail_btntext1` varchar(255) DEFAULT '',
  `detail_btntext2` varchar(255) DEFAULT '',
  `detail_btnurl1` varchar(255) DEFAULT '',
  `detail_btnurl2` varchar(255) DEFAULT '',
  `detail_logo` varchar(255) DEFAULT '',
  `detail_shopname` varchar(255) DEFAULT '',
  `detail_totaltitle` varchar(255) DEFAULT '',
  `discounts` text,
  `dispatch` int(11) DEFAULT '0',
  `dispatchid` int(11) DEFAULT '0',
  `dispatchprice` decimal(10,2) DEFAULT '0.00',
  `dispatchtype` tinyint(1) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `diyfields` text,
  `diyformid` int(11) DEFAULT '0',
  `diyformtype` tinyint(1) DEFAULT '0',
  `diymode` tinyint(1) DEFAULT '0',
  `diypage` int(11) DEFAULT NULL,
  `diysave` tinyint(1) DEFAULT '0',
  `diysaveid` int(11) DEFAULT '0',
  `edareas_code` text NOT NULL,
  `edareas` text,
  `edmoney` decimal(10,2) DEFAULT '0.00',
  `ednum` int(11) DEFAULT '0',
  `endtime` int(11) NOT NULL DEFAULT '0',
  `exchange_postage` decimal(10,2) NOT NULL DEFAULT '0.00',
  `exchange_stock` int(11) DEFAULT '0',
  `followtip` varchar(255) DEFAULT '',
  `followurl` varchar(255) DEFAULT '',
  `goodssn` varchar(50) DEFAULT '',
  `groupstype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hascommission` tinyint(3) DEFAULT '0',
  `hasoption` int(11) DEFAULT '0',
  `hidecommission` tinyint(3) DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` tinyint(3) DEFAULT '0',
  `iscomment` tinyint(1) DEFAULT '0',
  `isdiscount_discounts` text,
  `isdiscount_time` int(11) DEFAULT '0',
  `isdiscount_title` varchar(255) DEFAULT '',
  `isdiscount` tinyint(1) DEFAULT '0',
  `isendtime` tinyint(3) NOT NULL DEFAULT '0',
  `ishot` tinyint(1) DEFAULT '0',
  `isnew` tinyint(1) DEFAULT '0',
  `isnodiscount` tinyint(3) DEFAULT '0',
  `ispresell` tinyint(3) NOT NULL DEFAULT '0',
  `isrecommand` tinyint(1) DEFAULT '0',
  `issendfree` tinyint(1) DEFAULT '0',
  `istime` tinyint(1) DEFAULT '0',
  `isverify` tinyint(3) DEFAULT '0',
  `keywords` varchar(255) DEFAULT '',
  `labelname` text,
  `manydeduct` tinyint(1) DEFAULT '0',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  `maxbuy` int(11) DEFAULT '0',
  `maxprice` decimal(10,2) DEFAULT '0.00',
  `merchdisplayorder` int(11) NOT NULL DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `merchsale` tinyint(1) DEFAULT '0',
  `minbuy` int(11) DEFAULT '0',
  `minprice` decimal(10,2) DEFAULT '0.00',
  `money` varchar(255) DEFAULT '',
  `needfollow` tinyint(3) DEFAULT '0',
  `nocommission` tinyint(3) DEFAULT '0',
  `noticeopenid` varchar(255) DEFAULT '',
  `noticetype` text,
  `originalprice` decimal(10,2) DEFAULT '0.00',
  `pcate` int(11) DEFAULT '0',
  `pcates` text,
  `presellend` tinyint(3) NOT NULL DEFAULT '0',
  `presellover` tinyint(3) NOT NULL DEFAULT '0',
  `presellovertime` int(11) NOT NULL,
  `presellprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `presellsendstatrttime` int(11) NOT NULL DEFAULT '0',
  `presellsendtime` int(11) NOT NULL DEFAULT '0',
  `presellsendtype` tinyint(3) NOT NULL DEFAULT '0',
  `presellstart` tinyint(3) NOT NULL DEFAULT '0',
  `preselltimeend` int(11) NOT NULL DEFAULT '0',
  `preselltimestart` int(11) NOT NULL DEFAULT '0',
  `productprice` decimal(10,2) DEFAULT '0.00',
  `productsn` varchar(50) DEFAULT '',
  `province` varchar(255) DEFAULT '',
  `quality` tinyint(3) DEFAULT '0',
  `repair` tinyint(3) DEFAULT '0',
  `sales` int(11) DEFAULT '0',
  `salesreal` int(11) DEFAULT '0',
  `saleupdate30424` tinyint(3) DEFAULT '0',
  `saleupdate37975` tinyint(3) DEFAULT '0',
  `saleupdate51117` tinyint(3) DEFAULT '0',
  `score` decimal(10,2) DEFAULT '0.00',
  `seven` tinyint(3) DEFAULT '0',
  `share_icon` varchar(255) DEFAULT '',
  `share_title` varchar(255) DEFAULT '',
  `sharebtn` tinyint(1) NOT NULL DEFAULT '0',
  `shopid` int(11) DEFAULT '0',
  `shorttitle` varchar(255) DEFAULT '',
  `showgroups` text,
  `showlevels` text,
  `showtotal` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `showtotaladd` tinyint(1) DEFAULT '0',
  `spec` varchar(5000) DEFAULT '',
  `status` tinyint(1) DEFAULT '1',
  `storeids` text,
  `subtitle` varchar(255) DEFAULT '',
  `taobaoid` varchar(255) DEFAULT '',
  `taobaourl` varchar(255) DEFAULT '',
  `taotaoid` varchar(255) DEFAULT '',
  `tcate` int(11) DEFAULT '0',
  `tcates` text,
  `thumb_first` tinyint(3) DEFAULT '0',
  `thumb_url` text,
  `thumb` varchar(255) DEFAULT '',
  `timeend` int(11) DEFAULT '0',
  `timestart` int(11) DEFAULT '0',
  `title` varchar(100) DEFAULT '',
  `total` int(10) DEFAULT '0',
  `totalcnf` int(11) DEFAULT '0',
  `type` tinyint(1) DEFAULT '1',
  `uniacid` int(11) DEFAULT '0',
  `unit` varchar(5) DEFAULT '',
  `updatetime` int(11) DEFAULT '0',
  `usermaxbuy` int(11) DEFAULT '0',
  `usetime` int(11) NOT NULL DEFAULT '0',
  `verifytype` tinyint(1) DEFAULT '0',
  `viewcount` int(11) DEFAULT '0',
  `virtual` int(11) DEFAULT '0',
  `virtualsend` tinyint(1) DEFAULT '0',
  `virtualsendcontent` text,
  `weight` decimal(10,2) DEFAULT '0.00',
  `minpriceupdated` tinyint(1) DEFAULT NULL,
  `unite_total` tinyint(3) NOT NULL,
  `buyagain_price` decimal(10,2) DEFAULT NULL,
  `threen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_pcate` (`pcate`),
  KEY `idx_ccate` (`ccate`),
  KEY `idx_isnew` (`isnew`),
  KEY `idx_ishot` (`ishot`),
  KEY `idx_isdiscount` (`isdiscount`),
  KEY `idx_isrecommand` (`isrecommand`),
  KEY `idx_iscomment` (`iscomment`),
  KEY `idx_issendfree` (`issendfree`),
  KEY `idx_istime` (`istime`),
  KEY `idx_deleted` (`deleted`),
  KEY `idx_scate` (`tcate`),
  KEY `idx_merchid` (`merchid`),
  KEY `idx_checked` (`checked`),
  KEY `idx_productsn` (`productsn`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_goods_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(10) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `nickname` varchar(50) DEFAULT '',
  `headimgurl` varchar(255) DEFAULT '',
  `content` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_goodsid` (`goodsid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_goods_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `goodsids` varchar(255) NOT NULL DEFAULT '',
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_enabled` (`enabled`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_goods_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `label` varchar(255) NOT NULL DEFAULT '',
  `labelname` text NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_goods_labelstyle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `style` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_goods_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `thumb` varchar(60) DEFAULT '',
  `productprice` decimal(10,2) DEFAULT '0.00',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  `costprice` decimal(10,2) DEFAULT '0.00',
  `stock` int(11) DEFAULT '0',
  `weight` decimal(10,2) DEFAULT '0.00',
  `displayorder` int(11) DEFAULT '0',
  `specs` text,
  `skuId` varchar(255) DEFAULT '',
  `goodssn` varchar(255) DEFAULT '',
  `productsn` varchar(255) DEFAULT '',
  `virtual` int(11) DEFAULT '0',
  `exchange_stock` int(11) DEFAULT '0',
  `exchange_postage` decimal(10,2) NOT NULL DEFAULT '0.00',
  `presellprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_goodsid` (`goodsid`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_productsn` (`productsn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_goods_param` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `value` text,
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_goodsid` (`goodsid`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_goods_spec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(11) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `description` varchar(1000) DEFAULT '',
  `displaytype` tinyint(3) DEFAULT '0',
  `content` text,
  `displayorder` int(11) DEFAULT '0',
  `propId` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_goodsid` (`goodsid`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_goods_spec_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `specid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `show` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `valueId` varchar(255) DEFAULT '',
  `virtual` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_specid` (`specid`),
  KEY `idx_show` (`show`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_groups_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_groups_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `displayorder` tinyint(3) unsigned DEFAULT '0',
  `enabled` tinyint(1) DEFAULT '1',
  `advimg` varchar(255) DEFAULT '',
  `advurl` varchar(500) DEFAULT '',
  `isrecommand` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_enabled` (`enabled`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_groups_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `displayorder` int(11) unsigned DEFAULT '0',
  `uniacid` int(11) DEFAULT '0',
  `goodssn` varchar(50) DEFAULT NULL,
  `productsn` varchar(50) DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `category` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `showstock` tinyint(2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `price` decimal(10,2) DEFAULT '0.00',
  `groupsprice` decimal(10,2) DEFAULT '0.00',
  `goodsnum` int(11) NOT NULL DEFAULT '1',
  `purchaselimit` int(11) NOT NULL DEFAULT '0',
  `single` tinyint(2) NOT NULL DEFAULT '0',
  `singleprice` decimal(10,2) DEFAULT '0.00',
  `units` varchar(255) NOT NULL DEFAULT '件',
  `dispatchtype` tinyint(2) NOT NULL,
  `dispatchid` int(11) NOT NULL,
  `freight` decimal(10,2) DEFAULT '0.00',
  `endtime` int(11) unsigned NOT NULL DEFAULT '0',
  `groupnum` int(10) NOT NULL DEFAULT '0',
  `sales` int(10) NOT NULL DEFAULT '0',
  `thumb` varchar(255) DEFAULT '',
  `description` varchar(1000) DEFAULT NULL,
  `content` text,
  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `isindex` tinyint(3) NOT NULL DEFAULT '0',
  `deleted` tinyint(3) NOT NULL DEFAULT '0',
  `goodsid` int(11) NOT NULL DEFAULT '0',
  `followneed` tinyint(2) NOT NULL DEFAULT '0',
  `followtext` varchar(255) DEFAULT NULL,
  `followurl` varchar(255) DEFAULT NULL,
  `share_title` varchar(255) DEFAULT NULL,
  `share_icon` varchar(255) DEFAULT NULL,
  `share_desc` varchar(500) DEFAULT NULL,
  `deduct` decimal(10,2) NOT NULL DEFAULT '0.00',
  `thumb_url` text,
  `rights` tinyint(2) NOT NULL DEFAULT '1',
  `gid` int(11) DEFAULT '0',
  `discount` tinyint(3) DEFAULT '0',
  `headstype` tinyint(3) DEFAULT NULL,
  `headsmoney` decimal(10,2) DEFAULT '0.00',
  `headsdiscount` int(11) DEFAULT '0',
  `isdiscount` tinyint(3) DEFAULT '0',
  `isverify` tinyint(3) DEFAULT '0',
  `verifytype` tinyint(3) DEFAULT '0',
  `verifynum` int(11) DEFAULT '0',
  `storeids` text,
  `merchid` int(11) DEFAULT '0',
  `shorttitle` varchar(255) DEFAULT '',
  `teamnum` int(11) DEFAULT '0',
  `ishot` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_type` (`category`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_groups_goods_atlas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `g_id` int(11) NOT NULL,
  `thumb` varchar(145) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_groups_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(45) NOT NULL,
  `orderno` varchar(45) NOT NULL,
  `groupnum` int(11) NOT NULL,
  `paytime` int(11) NOT NULL,
  `credit` int(11) DEFAULT '0',
  `creditmoney` decimal(11,2) DEFAULT '0.00',
  `price` decimal(11,2) DEFAULT '0.00',
  `freight` decimal(11,2) DEFAULT '0.00',
  `status` int(9) NOT NULL,
  `pay_type` varchar(45) DEFAULT NULL,
  `dispatchid` int(11) DEFAULT NULL,
  `addressid` int(11) NOT NULL DEFAULT '0',
  `address` varchar(255) DEFAULT NULL,
  `goodid` int(11) NOT NULL,
  `teamid` int(11) NOT NULL,
  `is_team` int(2) NOT NULL,
  `heads` int(11) DEFAULT '0',
  `discount` decimal(10,2) DEFAULT '0.00',
  `starttime` int(11) NOT NULL,
  `canceltime` int(11) NOT NULL DEFAULT '0',
  `endtime` int(45) NOT NULL,
  `createtime` int(11) NOT NULL,
  `finishtime` int(11) NOT NULL DEFAULT '0',
  `refundid` int(11) NOT NULL DEFAULT '0',
  `refundstate` tinyint(2) NOT NULL DEFAULT '0',
  `refundtime` int(11) NOT NULL DEFAULT '0',
  `express` varchar(45) DEFAULT NULL,
  `expresscom` varchar(100) DEFAULT NULL,
  `expresssn` varchar(45) DEFAULT NULL,
  `sendtime` int(45) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `remarkclose` text,
  `remarksend` text,
  `message` varchar(255) DEFAULT NULL,
  `success` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `realname` varchar(20) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `isverify` tinyint(3) DEFAULT '0',
  `verifytype` tinyint(3) DEFAULT '0',
  `verifycode` varchar(45) DEFAULT '0',
  `verifynum` int(11) DEFAULT '0',
  `printstate` int(11) NOT NULL DEFAULT '0',
  `printstate2` int(11) NOT NULL DEFAULT '0',
  `apppay` tinyint(3) NOT NULL DEFAULT '0',
  `delete` int(2) NOT NULL DEFAULT '0',
  `isborrow` tinyint(1) DEFAULT '0',
  `borrowopenid` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_groups_order_refund` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(45) NOT NULL DEFAULT '',
  `orderid` int(11) NOT NULL DEFAULT '0',
  `refundno` varchar(45) NOT NULL DEFAULT '0',
  `refundstatus` tinyint(3) NOT NULL DEFAULT '0',
  `refundaddressid` int(11) NOT NULL DEFAULT '0',
  `refundaddress` varchar(255) NOT NULL DEFAULT '0',
  `content` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `applytime` varchar(45) NOT NULL DEFAULT '0',
  `applycredit` int(11) NOT NULL DEFAULT '0',
  `applyprice` decimal(11,2) NOT NULL DEFAULT '0.00',
  `reply` text,
  `refundtype` varchar(45) DEFAULT NULL,
  `rtype` int(3) NOT NULL DEFAULT '0',
  `refundtime` varchar(45) NOT NULL,
  `endtime` varchar(45) NOT NULL DEFAULT '0',
  `message` varchar(255) DEFAULT NULL,
  `operatetime` varchar(45) NOT NULL DEFAULT '0',
  `realcredit` int(11) NOT NULL,
  `realmoney` decimal(11,2) NOT NULL,
  `express` varchar(45) DEFAULT NULL,
  `expresscom` varchar(100) DEFAULT NULL,
  `expresssn` varchar(45) DEFAULT NULL,
  `sendtime` varchar(45) NOT NULL DEFAULT '0',
  `returntime` int(11) NOT NULL DEFAULT '0',
  `rexpress` varchar(45) DEFAULT NULL,
  `rexpresscom` varchar(100) DEFAULT NULL,
  `rexpresssn` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_groups_paylog` (
  `plid` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `openid` varchar(40) NOT NULL,
  `tid` varchar(64) NOT NULL,
  `credit` int(10) NOT NULL DEFAULT '0',
  `creditmoney` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `module` varchar(50) NOT NULL,
  `tag` varchar(2000) NOT NULL,
  `is_usecard` tinyint(3) unsigned NOT NULL,
  `card_type` tinyint(3) unsigned NOT NULL,
  `card_id` varchar(50) NOT NULL,
  `card_fee` decimal(10,2) unsigned NOT NULL,
  `encrypt_code` varchar(100) NOT NULL,
  `uniontid` varchar(50) NOT NULL,
  PRIMARY KEY (`plid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_tid` (`tid`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `uniontid` (`uniontid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_groups_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` varchar(45) DEFAULT NULL,
  `groups` int(2) NOT NULL DEFAULT '0',
  `followurl` varchar(255) DEFAULT NULL,
  `followqrcode` varchar(255) DEFAULT NULL,
  `groupsurl` varchar(255) DEFAULT NULL,
  `share_title` varchar(255) DEFAULT NULL,
  `share_icon` varchar(255) DEFAULT NULL,
  `share_desc` varchar(255) DEFAULT NULL,
  `share_url` varchar(255) DEFAULT NULL,
  `groups_description` text,
  `description` int(2) NOT NULL DEFAULT '0',
  `creditdeduct` tinyint(2) NOT NULL DEFAULT '0',
  `groupsdeduct` tinyint(2) NOT NULL DEFAULT '0',
  `credit` int(11) NOT NULL DEFAULT '1',
  `groupsmoney` decimal(11,2) NOT NULL DEFAULT '0.00',
  `refund` int(11) NOT NULL DEFAULT '0',
  `refundday` int(11) NOT NULL DEFAULT '0',
  `goodsid` text NOT NULL,
  `rules` text,
  `receive` int(11) DEFAULT '0',
  `discount` tinyint(3) DEFAULT '0',
  `headstype` tinyint(3) DEFAULT '0',
  `headsmoney` decimal(10,2) DEFAULT '0.00',
  `headsdiscount` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_groups_verify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(45) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `verifycode` varchar(45) DEFAULT '',
  `storeid` int(11) DEFAULT '0',
  `verifier` varchar(45) DEFAULT '0',
  `isverify` tinyint(3) DEFAULT '0',
  `verifytime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_lottery` (
  `lottery_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `lottery_title` varchar(150) DEFAULT NULL,
  `lottery_icon` varchar(255) DEFAULT NULL,
  `lottery_banner` varchar(255) DEFAULT NULL,
  `lottery_cannot` varchar(255) DEFAULT NULL,
  `lottery_type` tinyint(1) DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `lottery_data` text,
  `is_goods` tinyint(1) DEFAULT NULL,
  `lottery_days` int(11) DEFAULT NULL,
  `task_type` tinyint(1) DEFAULT NULL,
  `task_data` text,
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`lottery_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_lottery_default` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `data` text,
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_lottery_join` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `join_user` varchar(255) DEFAULT NULL,
  `lottery_id` int(11) DEFAULT NULL,
  `lottery_num` int(10) DEFAULT NULL,
  `lottery_tag` varchar(255) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_lottery_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `lottery_id` int(11) DEFAULT NULL,
  `join_user` varchar(255) DEFAULT NULL,
  `lottery_data` text,
  `is_reward` tinyint(1) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_mc_merchant` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `merchant_no` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `salt` varchar(8) NOT NULL DEFAULT '',
  `contact_name` varchar(255) NOT NULL DEFAULT '',
  `contact_mobile` varchar(16) NOT NULL DEFAULT '',
  `contact_address` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `createtime` int(11) NOT NULL,
  `validitytime` int(11) NOT NULL,
  `industry` varchar(255) NOT NULL DEFAULT '',
  `remark` varchar(1000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `groupid` int(11) DEFAULT '0',
  `level` int(11) DEFAULT '0',
  `agentid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `realname` varchar(20) DEFAULT '',
  `mobile` varchar(11) DEFAULT '',
  `pwd` varchar(32) DEFAULT '',
  `weixin` varchar(100) DEFAULT '',
  `content` text,
  `createtime` int(10) DEFAULT '0',
  `agenttime` int(10) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `isagent` tinyint(1) DEFAULT '0',
  `clickcount` int(11) DEFAULT '0',
  `agentlevel` int(11) DEFAULT '0',
  `noticeset` text,
  `nickname` varchar(255) DEFAULT '',
  `credit1` decimal(10,2) DEFAULT '0.00',
  `credit2` decimal(10,2) DEFAULT '0.00',
  `birthyear` varchar(255) DEFAULT '',
  `birthmonth` varchar(255) DEFAULT '',
  `birthday` varchar(255) DEFAULT '',
  `gender` tinyint(3) DEFAULT '0',
  `avatar` varchar(255) DEFAULT '',
  `province` varchar(255) DEFAULT '',
  `city` varchar(255) DEFAULT '',
  `area` varchar(255) DEFAULT '',
  `childtime` int(11) DEFAULT '0',
  `agentnotupgrade` int(11) DEFAULT '0',
  `inviter` int(11) DEFAULT '0',
  `agentselectgoods` tinyint(3) DEFAULT '0',
  `agentblack` int(11) DEFAULT '0',
  `username` varchar(255) DEFAULT '',
  `fixagentid` tinyint(3) DEFAULT '0',
  `diymemberid` int(11) DEFAULT '0',
  `diymemberdataid` int(11) DEFAULT '0',
  `diymemberdata` text,
  `diycommissionid` int(11) DEFAULT '0',
  `diycommissiondataid` int(11) DEFAULT '0',
  `diycommissiondata` text,
  `isblack` int(11) DEFAULT '0',
  `diymemberfields` text,
  `diycommissionfields` text,
  `commission_total` decimal(10,2) DEFAULT '0.00',
  `endtime2` int(11) DEFAULT '0',
  `ispartner` tinyint(3) DEFAULT '0',
  `partnertime` int(11) DEFAULT '0',
  `partnerstatus` tinyint(3) DEFAULT '0',
  `partnerblack` tinyint(3) DEFAULT '0',
  `partnerlevel` int(11) DEFAULT '0',
  `partnernotupgrade` tinyint(3) DEFAULT '0',
  `diyglobonusid` int(11) DEFAULT '0',
  `diyglobonusdata` text,
  `diyglobonusfields` text,
  `isaagent` tinyint(3) DEFAULT '0',
  `aagentlevel` int(11) DEFAULT '0',
  `aagenttime` int(11) DEFAULT '0',
  `aagentstatus` tinyint(3) DEFAULT '0',
  `aagentblack` tinyint(3) DEFAULT '0',
  `aagentnotupgrade` tinyint(3) DEFAULT '0',
  `aagenttype` tinyint(3) DEFAULT '0',
  `aagentprovinces` text,
  `aagentcitys` text,
  `aagentareas` text,
  `diyaagentid` int(11) DEFAULT '0',
  `diyaagentdata` text,
  `diyaagentfields` text,
  `salt` varchar(32) DEFAULT NULL,
  `mobileverify` tinyint(3) DEFAULT '0',
  `mobileuser` tinyint(3) DEFAULT '0',
  `carrier_mobile` varchar(11) DEFAULT '0',
  `isauthor` tinyint(1) DEFAULT '0',
  `authortime` int(11) DEFAULT '0',
  `authorstatus` tinyint(1) DEFAULT '0',
  `authorblack` tinyint(1) DEFAULT '0',
  `authorlevel` int(11) DEFAULT '0',
  `authornotupgrade` tinyint(1) DEFAULT '0',
  `diyauthorid` int(11) DEFAULT '0',
  `diyauthordata` text,
  `diyauthorfields` text,
  `authorid` int(11) DEFAULT '0',
  `comefrom` varchar(20) DEFAULT NULL,
  `openid_qq` varchar(50) DEFAULT NULL,
  `openid_wx` varchar(50) DEFAULT NULL,
  `diymaxcredit` tinyint(3) DEFAULT '0',
  `maxcredit` int(11) DEFAULT '0',
  `datavalue` varchar(50) NOT NULL DEFAULT '',
  `openid_wa` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_shareid` (`agentid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_status` (`status`),
  KEY `idx_agenttime` (`agenttime`),
  KEY `idx_isagent` (`isagent`),
  KEY `idx_uid` (`uid`),
  KEY `idx_groupid` (`groupid`),
  KEY `idx_level` (`level`),
  KEY `idx_mobile` (`mobile`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_member_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '0',
  `realname` varchar(20) DEFAULT '',
  `mobile` varchar(11) DEFAULT '',
  `province` varchar(30) DEFAULT '',
  `city` varchar(30) DEFAULT '',
  `area` varchar(30) DEFAULT '',
  `address` varchar(300) DEFAULT '',
  `isdefault` tinyint(1) DEFAULT '0',
  `zipcode` varchar(255) DEFAULT '',
  `deleted` tinyint(1) DEFAULT '0',
  `street` varchar(50) NOT NULL DEFAULT '',
  `datavalue` varchar(50) NOT NULL DEFAULT '',
  `streetdatavalue` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_isdefault` (`isdefault`),
  KEY `idx_deleted` (`deleted`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_member_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(100) DEFAULT '',
  `goodsid` int(11) DEFAULT '0',
  `total` int(11) DEFAULT '0',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  `deleted` tinyint(1) DEFAULT '0',
  `optionid` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `diyformdataid` int(11) DEFAULT '0',
  `diyformdata` text,
  `diyformfields` text,
  `diyformid` int(11) DEFAULT '0',
  `selected` tinyint(1) DEFAULT '1',
  `merchid` int(11) DEFAULT '0',
  `selectedadd` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_goodsid` (`goodsid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_deleted` (`deleted`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_member_favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(10) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `deleted` tinyint(1) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `type` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_goodsid` (`goodsid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_deleted` (`deleted`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_member_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `groupname` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_member_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(10) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `deleted` tinyint(1) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `times` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_goodsid` (`goodsid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_deleted` (`deleted`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_member_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `level` int(11) DEFAULT '0',
  `levelname` varchar(50) DEFAULT '',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  `ordercount` int(10) DEFAULT '0',
  `discount` decimal(10,2) DEFAULT '0.00',
  `enabled` tinyint(3) DEFAULT '0',
  `enabledadd` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_member_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `type` tinyint(3) DEFAULT NULL,
  `logno` varchar(255) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `money` decimal(10,2) DEFAULT '0.00',
  `rechargetype` varchar(255) DEFAULT '',
  `transid` varchar(255) DEFAULT '',
  `gives` decimal(10,2) DEFAULT NULL,
  `couponid` int(11) DEFAULT '0',
  `isborrow` tinyint(3) DEFAULT '0',
  `borrowopenid` varchar(100) DEFAULT '',
  `realmoney` decimal(10,2) DEFAULT '0.00',
  `charge` decimal(10,2) DEFAULT '0.00',
  `deductionmoney` decimal(10,2) DEFAULT '0.00',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `apppay` tinyint(3) NOT NULL DEFAULT '0',
  `alipay` varchar(50) NOT NULL DEFAULT '',
  `bankname` varchar(50) NOT NULL DEFAULT '',
  `bankcard` varchar(50) NOT NULL DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `applytype` tinyint(3) NOT NULL DEFAULT '0',
  `sendmoney` decimal(10,2) DEFAULT '0.00',
  `senddata` text,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_type` (`type`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_member_message_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `template_id` varchar(255) DEFAULT '',
  `first` text NOT NULL,
  `firstcolor` varchar(255) DEFAULT '',
  `data` text NOT NULL,
  `remark` text NOT NULL,
  `remarkcolor` varchar(255) DEFAULT '',
  `url` varchar(255) NOT NULL,
  `createtime` int(11) DEFAULT '0',
  `sendtimes` int(11) DEFAULT '0',
  `sendcount` int(11) DEFAULT '0',
  `typecode` varchar(30) DEFAULT '',
  `messagetype` tinyint(1) DEFAULT '0',
  `send_desc` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_member_message_template_default` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typecode` varchar(255) DEFAULT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `templateid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_member_message_template_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `typecode` varchar(255) DEFAULT NULL,
  `templatecode` varchar(255) DEFAULT NULL,
  `templateid` varchar(255) DEFAULT NULL,
  `templatename` varchar(255) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `showtotaladd` tinyint(1) DEFAULT '0',
  `typegroup` varchar(255) DEFAULT '',
  `groupname` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_member_printer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `type` tinyint(3) DEFAULT '0',
  `print_data` text,
  `createtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_member_printer_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `type` tinyint(3) DEFAULT '0',
  `print_title` varchar(255) DEFAULT '',
  `print_style` varchar(255) DEFAULT '',
  `print_data` text,
  `code` varchar(500) DEFAULT '',
  `qrcode` varchar(500) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_member_rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  `num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `merchid` int(11) DEFAULT '0',
  `username` varchar(255) DEFAULT '',
  `pwd` varchar(255) DEFAULT '',
  `salt` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `perms` text,
  `isfounder` tinyint(3) DEFAULT '0',
  `lastip` varchar(255) DEFAULT '',
  `lastvisit` varchar(255) DEFAULT '',
  `roleid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_merchid` (`merchid`),
  KEY `idx_status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `displayorder` int(11) DEFAULT NULL,
  `enabled` int(11) DEFAULT NULL,
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_merchid` (`merchid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `bannername` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_merchid` (`merchid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `applyno` varchar(255) NOT NULL DEFAULT '',
  `merchid` int(11) NOT NULL DEFAULT '0',
  `orderids` text NOT NULL,
  `realprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `realpricerate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `finalprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payrateprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payrate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `applytime` int(11) NOT NULL DEFAULT '0',
  `checktime` int(11) NOT NULL DEFAULT '0',
  `paytime` int(11) NOT NULL DEFAULT '0',
  `invalidtime` int(11) NOT NULL DEFAULT '0',
  `refusetime` int(11) NOT NULL DEFAULT '0',
  `remark` text NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `ordernum` int(11) NOT NULL DEFAULT '0',
  `orderprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `passrealprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `passrealpricerate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `passorderids` text NOT NULL,
  `passordernum` int(11) NOT NULL DEFAULT '0',
  `passorderprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `alipay` varchar(50) NOT NULL DEFAULT '',
  `bankname` varchar(50) NOT NULL DEFAULT '',
  `bankcard` varchar(50) NOT NULL DEFAULT '',
  `applyrealname` varchar(50) NOT NULL DEFAULT '',
  `applytype` tinyint(3) NOT NULL DEFAULT '0',
  `handpay` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_merchid` (`merchid`),
  KEY `idx_status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_billo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `billid` int(11) NOT NULL DEFAULT '0',
  `orderid` int(11) NOT NULL DEFAULT '0',
  `ordermoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `catename` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `thumb` varchar(500) DEFAULT '',
  `isrecommand` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_category_swipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `thumb` varchar(500) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_clearing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `merchid` int(11) NOT NULL DEFAULT '0',
  `clearno` varchar(64) NOT NULL DEFAULT '',
  `goodsprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `dispatchprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deductprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deductcredit2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discountprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deductenough` decimal(10,2) NOT NULL DEFAULT '0.00',
  `merchdeductenough` decimal(10,2) NOT NULL DEFAULT '0.00',
  `isdiscountprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `realprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `realpricerate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `finalprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remark` varchar(2000) NOT NULL DEFAULT '',
  `paytime` int(11) NOT NULL DEFAULT '0',
  `payrate` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `uniacid` (`uniacid`),
  KEY `merchid` (`merchid`),
  KEY `starttime` (`starttime`),
  KEY `endtime` (`endtime`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `groupname` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `isdefault` tinyint(1) DEFAULT '0',
  `goodschecked` tinyint(1) DEFAULT '0',
  `commissionchecked` tinyint(1) DEFAULT '0',
  `changepricechecked` tinyint(1) DEFAULT '0',
  `finishchecked` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `navname` varchar(255) DEFAULT '',
  `icon` varchar(255) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_status` (`status`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_merchid` (`merchid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `detail` text,
  `status` tinyint(3) DEFAULT '0',
  `createtime` int(11) DEFAULT NULL,
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_merchid` (`merchid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_perm_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `type` varchar(255) DEFAULT '',
  `op` text,
  `ip` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_merchid` (`merchid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_perm_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `rolename` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `perms` text,
  `deleted` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`),
  KEY `idx_deleted` (`deleted`),
  KEY `merchid` (`merchid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `merchname` varchar(255) DEFAULT '',
  `salecate` varchar(255) DEFAULT '',
  `desc` varchar(500) DEFAULT '',
  `realname` varchar(255) DEFAULT '',
  `mobile` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `diyformdata` text,
  `diyformfields` text,
  `applytime` int(11) DEFAULT '0',
  `reason` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_saler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `storeid` int(11) DEFAULT '0',
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `salername` varchar(255) DEFAULT '',
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_storeid` (`storeid`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_merchid` (`merchid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `storename` varchar(255) DEFAULT '',
  `address` varchar(255) DEFAULT '',
  `tel` varchar(255) DEFAULT '',
  `lat` varchar(255) DEFAULT '',
  `lng` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `type` tinyint(1) DEFAULT '0',
  `realname` varchar(255) DEFAULT '',
  `mobile` varchar(255) DEFAULT '',
  `fetchtime` varchar(255) DEFAULT '',
  `logo` varchar(255) DEFAULT '',
  `saletime` varchar(255) DEFAULT '',
  `desc` text,
  `displayorder` int(11) DEFAULT '0',
  `commission_total` decimal(10,2) DEFAULT NULL,
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`),
  KEY `idx_merchid` (`merchid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_merch_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `regid` int(11) DEFAULT '0',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `groupid` int(11) DEFAULT '0',
  `merchno` varchar(255) NOT NULL DEFAULT '',
  `merchname` varchar(255) NOT NULL DEFAULT '',
  `salecate` varchar(255) NOT NULL DEFAULT '',
  `desc` varchar(500) NOT NULL DEFAULT '',
  `realname` varchar(255) NOT NULL DEFAULT '',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `accounttime` int(11) DEFAULT '0',
  `diyformdata` text,
  `diyformfields` text,
  `applytime` int(11) DEFAULT '0',
  `accounttotal` int(11) DEFAULT '0',
  `remark` text,
  `jointime` int(11) DEFAULT '0',
  `accountid` int(11) DEFAULT '0',
  `sets` text,
  `logo` varchar(255) NOT NULL DEFAULT '',
  `payopenid` varchar(32) NOT NULL DEFAULT '',
  `payrate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `isrecommand` tinyint(1) DEFAULT '0',
  `cateid` int(11) DEFAULT '0',
  `address` varchar(255) DEFAULT '',
  `tel` varchar(255) DEFAULT '',
  `lat` varchar(255) DEFAULT '',
  `lng` varchar(255) DEFAULT '',
  `pluginset` text,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`),
  KEY `idx_groupid` (`groupid`),
  KEY `idx_regid` (`regid`),
  KEY `idx_cateid` (`cateid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_multi_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `company` varchar(255) DEFAULT '',
  `sales` varchar(255) DEFAULT '',
  `starttime` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `applytime` int(11) DEFAULT '0',
  `jointime` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `refusecontent` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `navname` varchar(255) DEFAULT '',
  `icon` varchar(255) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `iswxapp` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_status` (`status`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `detail` text,
  `status` tinyint(3) DEFAULT '0',
  `createtime` int(11) DEFAULT NULL,
  `shopid` int(11) DEFAULT '0',
  `iswxapp` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `agentid` int(11) DEFAULT '0',
  `ordersn` varchar(30) DEFAULT '',
  `price` decimal(10,2) DEFAULT '0.00',
  `goodsprice` decimal(10,2) DEFAULT '0.00',
  `discountprice` decimal(10,2) DEFAULT '0.00',
  `status` tinyint(3) DEFAULT '0',
  `paytype` tinyint(1) DEFAULT '0',
  `transid` varchar(30) DEFAULT '0',
  `remark` varchar(1000) DEFAULT '',
  `addressid` int(11) DEFAULT '0',
  `dispatchprice` decimal(10,2) DEFAULT '0.00',
  `dispatchid` int(10) DEFAULT '0',
  `createtime` int(10) DEFAULT NULL,
  `dispatchtype` tinyint(3) DEFAULT '0',
  `carrier` text,
  `refundid` int(11) DEFAULT '0',
  `iscomment` tinyint(3) DEFAULT '0',
  `creditadd` tinyint(3) DEFAULT '0',
  `deleted` tinyint(3) DEFAULT '0',
  `userdeleted` tinyint(3) DEFAULT '0',
  `finishtime` int(11) DEFAULT '0',
  `paytime` int(11) DEFAULT '0',
  `expresscom` varchar(30) NOT NULL DEFAULT '',
  `expresssn` varchar(50) NOT NULL DEFAULT '',
  `express` varchar(255) DEFAULT '',
  `sendtime` int(11) DEFAULT '0',
  `fetchtime` int(11) DEFAULT '0',
  `cash` tinyint(3) DEFAULT '0',
  `canceltime` int(11) DEFAULT NULL,
  `cancelpaytime` int(11) DEFAULT '0',
  `refundtime` int(11) DEFAULT '0',
  `isverify` tinyint(3) DEFAULT '0',
  `verified` tinyint(3) DEFAULT '0',
  `verifyopenid` varchar(255) DEFAULT '',
  `verifytime` int(11) DEFAULT '0',
  `verifycode` varchar(255) DEFAULT '',
  `verifystoreid` int(11) DEFAULT '0',
  `deductprice` decimal(10,2) DEFAULT '0.00',
  `deductcredit` int(10) DEFAULT '0',
  `deductcredit2` decimal(10,2) DEFAULT '0.00',
  `deductenough` decimal(10,2) DEFAULT '0.00',
  `virtual` int(11) DEFAULT '0',
  `virtual_info` text,
  `virtual_str` text,
  `address` text,
  `sysdeleted` tinyint(3) DEFAULT '0',
  `ordersn2` int(11) DEFAULT '0',
  `changeprice` decimal(10,2) DEFAULT '0.00',
  `changedispatchprice` decimal(10,2) DEFAULT '0.00',
  `oldprice` decimal(10,2) DEFAULT '0.00',
  `olddispatchprice` decimal(10,2) DEFAULT '0.00',
  `isvirtual` tinyint(3) DEFAULT '0',
  `couponid` int(11) DEFAULT '0',
  `couponprice` decimal(10,2) DEFAULT '0.00',
  `diyformdata` text,
  `diyformfields` text,
  `diyformid` int(11) DEFAULT '0',
  `storeid` int(11) DEFAULT '0',
  `closereason` text,
  `remarksaler` text,
  `printstate` tinyint(1) DEFAULT '0',
  `printstate2` tinyint(1) DEFAULT '0',
  `address_send` text,
  `refundstate` tinyint(3) DEFAULT '0',
  `remarkclose` text,
  `remarksend` text,
  `ismr` int(1) NOT NULL DEFAULT '0',
  `isdiscountprice` decimal(10,2) DEFAULT '0.00',
  `isvirtualsend` tinyint(1) DEFAULT '0',
  `virtualsend_info` text,
  `verifyinfo` text,
  `verifytype` tinyint(1) DEFAULT '0',
  `verifycodes` text,
  `merchid` int(11) DEFAULT '0',
  `invoicename` varchar(255) DEFAULT '',
  `ismerch` tinyint(1) DEFAULT '0',
  `parentid` int(11) DEFAULT '0',
  `isparent` tinyint(1) DEFAULT '0',
  `grprice` decimal(10,2) DEFAULT '0.00',
  `merchshow` tinyint(1) DEFAULT '0',
  `merchdeductenough` decimal(10,2) DEFAULT '0.00',
  `couponmerchid` int(11) DEFAULT '0',
  `isglobonus` tinyint(3) DEFAULT '0',
  `merchapply` tinyint(1) DEFAULT '0',
  `isabonus` tinyint(3) DEFAULT '0',
  `isborrow` tinyint(3) DEFAULT '0',
  `borrowopenid` varchar(100) DEFAULT '',
  `merchisdiscountprice` decimal(10,2) DEFAULT '0.00',
  `apppay` tinyint(3) NOT NULL DEFAULT '0',
  `coupongoodprice` decimal(10,2) DEFAULT '1.00',
  `buyagainprice` decimal(10,2) DEFAULT '0.00',
  `ispackage` tinyint(3) DEFAULT '0',
  `packageid` int(11) DEFAULT '0',
  `taskdiscountprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `seckilldiscountprice` decimal(10,2) DEFAULT '0.00',
  `verifyendtime` int(11) NOT NULL DEFAULT '0',
  `willcancelmessage` tinyint(1) DEFAULT '0',
  `sendtype` tinyint(3) NOT NULL DEFAULT '0',
  `lotterydiscountprice` decimal(10,2) DEFAULT '0.00',
  `contype` tinyint(1) DEFAULT '0',
  `wxid` int(11) DEFAULT '0',
  `wxcardid` varchar(50) DEFAULT '',
  `wxcode` varchar(50) DEFAULT '',
  `dispatchkey` varchar(30) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_shareid` (`agentid`),
  KEY `idx_status` (`status`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_refundid` (`refundid`),
  KEY `idx_paytime` (`paytime`),
  KEY `idx_finishtime` (`finishtime`),
  KEY `idx_merchid` (`merchid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_order_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `goodsid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `nickname` varchar(50) DEFAULT '',
  `headimgurl` varchar(255) DEFAULT '',
  `level` tinyint(3) DEFAULT '0',
  `content` varchar(255) DEFAULT '',
  `images` text,
  `createtime` int(11) DEFAULT '0',
  `deleted` tinyint(3) DEFAULT '0',
  `append_content` varchar(255) DEFAULT '',
  `append_images` text,
  `reply_content` varchar(255) DEFAULT '',
  `reply_images` text,
  `append_reply_content` varchar(255) DEFAULT '',
  `append_reply_images` text,
  `istop` tinyint(3) DEFAULT '0',
  `checked` tinyint(3) NOT NULL DEFAULT '0',
  `replychecked` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_goodsid` (`goodsid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_orderid` (`orderid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_order_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `goodsid` int(11) DEFAULT '0',
  `price` decimal(10,2) DEFAULT '0.00',
  `total` int(11) DEFAULT '1',
  `optionid` int(10) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `optionname` text,
  `commission1` text,
  `applytime1` int(11) DEFAULT '0',
  `checktime1` int(10) DEFAULT '0',
  `paytime1` int(11) DEFAULT '0',
  `invalidtime1` int(11) DEFAULT '0',
  `deletetime1` int(11) DEFAULT '0',
  `status1` tinyint(3) DEFAULT '0',
  `content1` text,
  `commission2` text,
  `applytime2` int(11) DEFAULT '0',
  `checktime2` int(10) DEFAULT '0',
  `paytime2` int(11) DEFAULT '0',
  `invalidtime2` int(11) DEFAULT '0',
  `deletetime2` int(11) DEFAULT '0',
  `status2` tinyint(3) DEFAULT '0',
  `content2` text,
  `commission3` text,
  `applytime3` int(11) DEFAULT '0',
  `checktime3` int(10) DEFAULT '0',
  `paytime3` int(11) DEFAULT '0',
  `invalidtime3` int(11) DEFAULT '0',
  `deletetime3` int(11) DEFAULT '0',
  `status3` tinyint(3) DEFAULT '0',
  `content3` text,
  `realprice` decimal(10,2) DEFAULT '0.00',
  `goodssn` varchar(255) DEFAULT '',
  `productsn` varchar(255) DEFAULT '',
  `nocommission` tinyint(3) DEFAULT '0',
  `changeprice` decimal(10,2) DEFAULT '0.00',
  `oldprice` decimal(10,2) DEFAULT '0.00',
  `commissions` text,
  `diyformdata` text,
  `diyformfields` text,
  `diyformdataid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `diyformid` int(11) DEFAULT '0',
  `rstate` tinyint(3) DEFAULT '0',
  `refundtime` int(11) DEFAULT '0',
  `printstate` int(11) NOT NULL DEFAULT '0',
  `printstate2` int(11) NOT NULL DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `parentorderid` int(11) DEFAULT '0',
  `merchsale` tinyint(3) NOT NULL DEFAULT '0',
  `isdiscountprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `canbuyagain` tinyint(1) DEFAULT '0',
  `seckill` tinyint(3) DEFAULT '0',
  `seckill_taskid` int(11) DEFAULT '0',
  `seckill_roomid` int(11) DEFAULT '0',
  `seckill_timeid` int(11) DEFAULT '0',
  `is_make` tinyint(1) DEFAULT '0',
  `sendtype` tinyint(3) NOT NULL DEFAULT '0',
  `expresscom` varchar(30) NOT NULL,
  `expresssn` varchar(50) NOT NULL,
  `express` varchar(255) NOT NULL,
  `sendtime` int(11) NOT NULL,
  `finishtime` int(11) NOT NULL,
  `remarksend` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_orderid` (`orderid`),
  KEY `idx_goodsid` (`goodsid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_applytime1` (`applytime1`),
  KEY `idx_checktime1` (`checktime1`),
  KEY `idx_status1` (`status1`),
  KEY `idx_applytime2` (`applytime2`),
  KEY `idx_checktime2` (`checktime2`),
  KEY `idx_status2` (`status2`),
  KEY `idx_applytime3` (`applytime3`),
  KEY `idx_invalidtime1` (`invalidtime1`),
  KEY `idx_checktime3` (`checktime3`),
  KEY `idx_invalidtime2` (`invalidtime2`),
  KEY `idx_invalidtime3` (`invalidtime3`),
  KEY `idx_status3` (`status3`),
  KEY `idx_paytime1` (`paytime1`),
  KEY `idx_paytime2` (`paytime2`),
  KEY `idx_paytime3` (`paytime3`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_order_refund` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `refundno` varchar(255) DEFAULT '',
  `price` varchar(255) DEFAULT '',
  `reason` varchar(255) DEFAULT '',
  `images` text,
  `content` text,
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `reply` text,
  `refundtype` tinyint(3) DEFAULT '0',
  `realprice` decimal(10,2) DEFAULT '0.00',
  `refundtime` int(11) DEFAULT '0',
  `orderprice` decimal(10,2) DEFAULT '0.00',
  `applyprice` decimal(10,2) DEFAULT '0.00',
  `imgs` text,
  `rtype` tinyint(3) DEFAULT '0',
  `refundaddress` text,
  `message` text,
  `express` varchar(100) DEFAULT '',
  `expresscom` varchar(100) DEFAULT '',
  `expresssn` varchar(100) DEFAULT '',
  `operatetime` int(11) DEFAULT '0',
  `sendtime` int(11) DEFAULT '0',
  `returntime` int(11) DEFAULT '0',
  `rexpress` varchar(100) DEFAULT '',
  `rexpresscom` varchar(100) DEFAULT '',
  `rexpresssn` varchar(100) DEFAULT '',
  `refundaddressid` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `freight` decimal(10,2) NOT NULL DEFAULT '0.00',
  `thumb` varchar(255) NOT NULL,
  `starttime` int(11) NOT NULL DEFAULT '0',
  `endtime` int(11) NOT NULL DEFAULT '0',
  `goodsid` varchar(255) NOT NULL,
  `cash` tinyint(3) NOT NULL DEFAULT '0',
  `share_title` varchar(255) NOT NULL,
  `share_icon` varchar(255) NOT NULL,
  `share_desc` varchar(500) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `deleted` tinyint(3) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_package_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `goodsid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `option` varchar(255) NOT NULL,
  `goodssn` varchar(255) NOT NULL,
  `productsn` varchar(255) NOT NULL,
  `hasoption` tinyint(3) NOT NULL DEFAULT '0',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  `packageprice` decimal(10,2) DEFAULT '0.00',
  `commission1` decimal(10,2) DEFAULT '0.00',
  `commission2` decimal(10,2) DEFAULT '0.00',
  `commission3` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_package_goods_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `goodsid` int(11) NOT NULL DEFAULT '0',
  `optionid` int(11) NOT NULL DEFAULT '0',
  `pid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `packageprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `marketprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `commission1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `commission2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `commission3` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_perm_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `type` varchar(255) DEFAULT '',
  `op` text,
  `createtime` int(11) DEFAULT '0',
  `ip` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uid` (`uid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_perm_plugin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acid` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `type` tinyint(3) DEFAULT '0',
  `plugins` text,
  `coms` text,
  `datas` text,
  PRIMARY KEY (`id`),
  KEY `idx_uid` (`uid`),
  KEY `idx_type` (`type`),
  KEY `idx_uniacid` (`acid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_perm_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `rolename` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `perms` text,
  `perms2` text,
  `deleted` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`),
  KEY `idx_deleted` (`deleted`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_perm_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `username` varchar(255) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `roleid` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `perms` text,
  `perms2` text,
  `deleted` tinyint(3) DEFAULT '0',
  `realname` varchar(255) DEFAULT '',
  `mobile` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_uid` (`uid`),
  KEY `idx_roleid` (`roleid`),
  KEY `idx_status` (`status`),
  KEY `idx_deleted` (`deleted`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_plugin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `displayorder` int(11) DEFAULT '0',
  `identity` varchar(50) DEFAULT '',
  `name` varchar(50) DEFAULT '',
  `version` varchar(10) DEFAULT '',
  `author` varchar(20) DEFAULT '',
  `status` int(11) DEFAULT '0',
  `category` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `desc` text,
  `iscom` tinyint(3) DEFAULT '0',
  `deprecated` tinyint(3) DEFAULT '0',
  `isv2` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_identity` (`identity`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_poster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `type` tinyint(3) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `bg` varchar(255) DEFAULT '',
  `data` text,
  `keyword` varchar(255) DEFAULT '',
  `keyword2` varchar(255) DEFAULT '',
  `times` int(11) DEFAULT '0',
  `follows` int(11) DEFAULT '0',
  `isdefault` tinyint(3) DEFAULT '0',
  `resptype` tinyint(3) DEFAULT '0',
  `resptext` text,
  `resptitle` varchar(255) DEFAULT '',
  `respthumb` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `respdesc` varchar(255) DEFAULT '',
  `respurl` varchar(255) DEFAULT '',
  `waittext` varchar(255) DEFAULT '',
  `oktext` varchar(255) DEFAULT '',
  `subcredit` int(11) DEFAULT '0',
  `submoney` decimal(10,2) DEFAULT '0.00',
  `reccredit` int(11) DEFAULT '0',
  `recmoney` decimal(10,2) DEFAULT '0.00',
  `scantext` varchar(255) DEFAULT '',
  `subtext` varchar(255) DEFAULT '',
  `beagent` tinyint(3) DEFAULT '0',
  `bedown` tinyint(3) DEFAULT '0',
  `isopen` tinyint(3) DEFAULT '0',
  `opentext` varchar(255) DEFAULT '',
  `openurl` varchar(255) DEFAULT '',
  `paytype` tinyint(1) NOT NULL DEFAULT '0',
  `subpaycontent` text,
  `recpaycontent` varchar(255) DEFAULT '',
  `templateid` varchar(255) DEFAULT '',
  `entrytext` varchar(255) DEFAULT '',
  `reccouponid` int(11) DEFAULT '0',
  `reccouponnum` int(11) DEFAULT '0',
  `subcouponid` int(11) DEFAULT '0',
  `subcouponnum` int(11) DEFAULT '0',
  `resptext11` text,
  `reward_totle` varchar(500) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_type` (`type`),
  KEY `idx_times` (`times`),
  KEY `idx_isdefault` (`isdefault`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_poster_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `posterid` int(11) DEFAULT '0',
  `from_openid` varchar(255) DEFAULT '',
  `subcredit` int(11) DEFAULT '0',
  `submoney` decimal(10,2) DEFAULT '0.00',
  `reccredit` int(11) DEFAULT '0',
  `recmoney` decimal(10,2) DEFAULT '0.00',
  `createtime` int(11) DEFAULT '0',
  `reccouponid` int(11) DEFAULT '0',
  `reccouponnum` int(11) DEFAULT '0',
  `subcouponid` int(11) DEFAULT '0',
  `subcouponnum` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_posterid` (`posterid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_poster_qr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acid` int(10) unsigned NOT NULL,
  `openid` varchar(100) NOT NULL DEFAULT '',
  `type` tinyint(3) DEFAULT '0',
  `sceneid` int(11) DEFAULT '0',
  `mediaid` varchar(255) DEFAULT '',
  `ticket` varchar(250) NOT NULL,
  `url` varchar(80) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `goodsid` int(11) DEFAULT '0',
  `qrimg` varchar(1000) DEFAULT '',
  `posterid` int(11) DEFAULT '0',
  `scenestr` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_acid` (`acid`),
  KEY `idx_sceneid` (`sceneid`),
  KEY `idx_type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_poster_scan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `posterid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `from_openid` varchar(255) DEFAULT '',
  `scantime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_posterid` (`posterid`),
  KEY `idx_scantime` (`scantime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_postera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `type` tinyint(3) DEFAULT '0',
  `days` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `bg` varchar(255) DEFAULT '',
  `data` text,
  `keyword` varchar(255) DEFAULT '',
  `keyword2` varchar(255) DEFAULT '',
  `isdefault` tinyint(3) DEFAULT '0',
  `resptype` tinyint(3) DEFAULT '0',
  `resptext` text,
  `resptitle` varchar(255) DEFAULT '',
  `respthumb` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `respdesc` varchar(255) DEFAULT '',
  `respurl` varchar(255) DEFAULT '',
  `waittext` varchar(255) DEFAULT '',
  `oktext` varchar(255) DEFAULT '',
  `subcredit` int(11) DEFAULT '0',
  `submoney` decimal(10,2) DEFAULT '0.00',
  `reccredit` int(11) DEFAULT '0',
  `recmoney` decimal(10,2) DEFAULT '0.00',
  `scantext` varchar(255) DEFAULT '',
  `subtext` varchar(255) DEFAULT '',
  `beagent` tinyint(3) DEFAULT '0',
  `bedown` tinyint(3) DEFAULT '0',
  `isopen` tinyint(3) DEFAULT '0',
  `opentext` varchar(255) DEFAULT '',
  `openurl` varchar(255) DEFAULT '',
  `paytype` tinyint(1) NOT NULL DEFAULT '0',
  `subpaycontent` text,
  `recpaycontent` varchar(255) DEFAULT '',
  `templateid` varchar(255) DEFAULT '',
  `entrytext` varchar(255) DEFAULT '',
  `reccouponid` int(11) DEFAULT '0',
  `reccouponnum` int(11) DEFAULT '0',
  `subcouponid` int(11) DEFAULT '0',
  `subcouponnum` int(11) DEFAULT '0',
  `timestart` int(11) DEFAULT '0',
  `timeend` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `goodsid` int(11) DEFAULT '0',
  `starttext` varchar(255) DEFAULT '',
  `endtext` varchar(255) DEFAULT NULL,
  `testflag` tinyint(1) DEFAULT '0',
  `reward_totle` varchar(500) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_type` (`type`),
  KEY `idx_isdefault` (`isdefault`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_postera_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `posterid` int(11) DEFAULT '0',
  `from_openid` varchar(255) DEFAULT '',
  `subcredit` int(11) DEFAULT '0',
  `submoney` decimal(10,2) DEFAULT '0.00',
  `reccredit` int(11) DEFAULT '0',
  `recmoney` decimal(10,2) DEFAULT '0.00',
  `createtime` int(11) DEFAULT '0',
  `reccouponid` int(11) DEFAULT '0',
  `reccouponnum` int(11) DEFAULT '0',
  `subcouponid` int(11) DEFAULT '0',
  `subcouponnum` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_posteraid` (`posterid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_postera_qr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acid` int(10) unsigned NOT NULL,
  `openid` varchar(100) NOT NULL DEFAULT '',
  `posterid` int(11) DEFAULT '0',
  `type` tinyint(3) DEFAULT '0',
  `sceneid` int(11) DEFAULT '0',
  `mediaid` varchar(255) DEFAULT '',
  `ticket` varchar(250) NOT NULL,
  `url` varchar(80) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `goodsid` int(11) DEFAULT '0',
  `qrimg` varchar(1000) DEFAULT '',
  `expire` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `qrtime` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_acid` (`acid`),
  KEY `idx_sceneid` (`sceneid`),
  KEY `idx_type` (`type`),
  KEY `idx_posterid` (`posterid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_qa_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_qa_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `displayorder` tinyint(3) unsigned DEFAULT '0',
  `enabled` tinyint(1) DEFAULT '1',
  `isrecommand` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_qa_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `cate` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `isrecommand` tinyint(3) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `createtime` int(11) NOT NULL DEFAULT '0',
  `lastedittime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_qa_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `showmember` tinyint(3) NOT NULL DEFAULT '0',
  `showtype` tinyint(3) NOT NULL DEFAULT '0',
  `keyword` varchar(255) NOT NULL DEFAULT '',
  `enter_title` varchar(255) NOT NULL DEFAULT '',
  `enter_img` varchar(255) NOT NULL DEFAULT '',
  `enter_desc` varchar(255) NOT NULL DEFAULT '',
  `share` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_unaicid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_refund_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '0',
  `title` varchar(20) DEFAULT '',
  `name` varchar(20) DEFAULT '',
  `tel` varchar(20) DEFAULT '',
  `mobile` varchar(11) DEFAULT '',
  `province` varchar(30) DEFAULT '',
  `city` varchar(30) DEFAULT '',
  `area` varchar(30) DEFAULT '',
  `address` varchar(300) DEFAULT '',
  `isdefault` tinyint(1) DEFAULT '0',
  `zipcode` varchar(255) DEFAULT '',
  `content` text,
  `deleted` tinyint(1) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_openid` (`openid`),
  KEY `idx_isdefault` (`isdefault`),
  KEY `idx_deleted` (`deleted`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sale_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `type` tinyint(3) DEFAULT '0',
  `ckey` decimal(10,2) DEFAULT '0.00',
  `cvalue` decimal(10,2) DEFAULT '0.00',
  `nums` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_createtime` (`createtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sale_coupon_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `couponid` int(11) DEFAULT '0',
  `gettime` int(11) DEFAULT '0',
  `gettype` tinyint(3) DEFAULT '0',
  `usedtime` int(11) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_couponid` (`couponid`),
  KEY `idx_gettime` (`gettime`),
  KEY `idx_gettype` (`gettype`),
  KEY `idx_usedtime` (`usedtime`),
  KEY `idx_orderid` (`orderid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_saler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `storeid` int(11) DEFAULT '0',
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `salername` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_storeid` (`storeid`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_seckill_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_seckill_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_seckill_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `cateid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `enabled` tinyint(3) DEFAULT '0',
  `page_title` varchar(255) DEFAULT '',
  `share_title` varchar(255) DEFAULT '',
  `share_desc` varchar(255) DEFAULT '',
  `share_icon` varchar(255) DEFAULT '',
  `tag` varchar(10) DEFAULT '',
  `closesec` int(11) DEFAULT '0',
  `oldshow` tinyint(3) DEFAULT '0',
  `times` text,
  `createtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`enabled`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_seckill_task_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `taskid` int(11) DEFAULT '0',
  `roomid` int(11) DEFAULT '0',
  `timeid` int(11) DEFAULT '0',
  `goodsid` int(11) DEFAULT '0',
  `optionid` int(11) DEFAULT '0',
  `price` decimal(10,2) DEFAULT '0.00',
  `total` int(11) DEFAULT '0',
  `maxbuy` int(11) DEFAULT '0',
  `totalmaxbuy` int(11) DEFAULT '0',
  `commission1` decimal(10,2) DEFAULT '0.00',
  `commission2` decimal(10,2) DEFAULT '0.00',
  `commission3` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_goodsid` (`goodsid`),
  KEY `idx_optionid` (`optionid`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_taskid` (`taskid`),
  KEY `idx_roomid` (`roomid`),
  KEY `idx_time` (`timeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_seckill_task_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `taskid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `enabled` tinyint(3) DEFAULT '0',
  `page_title` varchar(255) DEFAULT '',
  `share_title` varchar(255) DEFAULT '',
  `share_desc` varchar(255) DEFAULT '',
  `share_icon` varchar(255) DEFAULT '',
  `oldshow` tinyint(3) DEFAULT '0',
  `tag` varchar(10) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `diypage` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_taskid` (`taskid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_seckill_task_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `taskid` int(11) DEFAULT '0',
  `time` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sign_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `credit` int(11) NOT NULL DEFAULT '0',
  `log` varchar(255) DEFAULT '',
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `day` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_time` (`time`),
  KEY `idx_type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sign_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `iscenter` tinyint(3) NOT NULL DEFAULT '0',
  `iscreditshop` tinyint(3) NOT NULL DEFAULT '0',
  `keyword` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `desc` varchar(255) NOT NULL DEFAULT '',
  `isopen` tinyint(3) NOT NULL DEFAULT '0',
  `signold` tinyint(3) NOT NULL DEFAULT '0',
  `signold_price` int(11) NOT NULL DEFAULT '0',
  `signold_type` tinyint(3) NOT NULL DEFAULT '0',
  `textsign` varchar(255) NOT NULL DEFAULT '',
  `textsignold` varchar(255) NOT NULL DEFAULT '',
  `textsigned` varchar(255) NOT NULL DEFAULT '',
  `textsignforget` varchar(255) NOT NULL DEFAULT '',
  `maincolor` varchar(20) NOT NULL DEFAULT '',
  `cycle` tinyint(3) NOT NULL DEFAULT '0',
  `reward_default_first` int(11) NOT NULL DEFAULT '0',
  `reward_default_day` int(11) NOT NULL DEFAULT '0',
  `reword_order` text NOT NULL,
  `reword_sum` text NOT NULL,
  `reword_special` text NOT NULL,
  `sign_rule` text NOT NULL,
  `share` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sign_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `order` int(11) NOT NULL DEFAULT '0',
  `orderday` int(11) NOT NULL DEFAULT '0',
  `sum` int(11) NOT NULL DEFAULT '0',
  `signdate` varchar(10) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT '',
  `template` tinyint(3) NOT NULL DEFAULT '0',
  `smstplid` varchar(255) NOT NULL DEFAULT '',
  `smssign` varchar(255) NOT NULL DEFAULT '',
  `content` varchar(100) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sms_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `juhe` tinyint(3) NOT NULL DEFAULT '0',
  `juhe_key` varchar(255) NOT NULL DEFAULT '',
  `dayu` tinyint(3) NOT NULL DEFAULT '0',
  `dayu_key` varchar(255) NOT NULL DEFAULT '',
  `dayu_secret` varchar(255) NOT NULL DEFAULT '',
  `emay` tinyint(3) NOT NULL DEFAULT '0',
  `emay_url` varchar(255) NOT NULL DEFAULT '',
  `emay_sn` varchar(255) NOT NULL DEFAULT '',
  `emay_pw` varchar(255) NOT NULL DEFAULT '',
  `emay_sk` varchar(255) NOT NULL DEFAULT '',
  `emay_phost` varchar(255) NOT NULL DEFAULT '',
  `emay_pport` int(11) NOT NULL DEFAULT '0',
  `emay_puser` varchar(255) NOT NULL DEFAULT '',
  `emay_ppw` varchar(255) NOT NULL DEFAULT '',
  `emay_out` int(11) NOT NULL DEFAULT '0',
  `emay_outresp` int(11) NOT NULL DEFAULT '30',
  `emay_warn` decimal(10,2) NOT NULL DEFAULT '0.00',
  `emay_mobile` varchar(11) NOT NULL DEFAULT '',
  `emay_warn_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sns_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sns_board` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `cid` int(11) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `logo` varchar(255) DEFAULT '',
  `desc` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  `showgroups` text,
  `showlevels` text,
  `postgroups` text,
  `postlevels` text,
  `showagentlevels` text,
  `postagentlevels` text,
  `postcredit` int(11) DEFAULT '0',
  `replycredit` int(11) DEFAULT '0',
  `bestcredit` int(11) DEFAULT '0',
  `bestboardcredit` int(11) DEFAULT '0',
  `notagent` tinyint(3) DEFAULT '0',
  `notagentpost` tinyint(3) DEFAULT '0',
  `topcredit` int(11) DEFAULT '0',
  `topboardcredit` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `noimage` tinyint(3) DEFAULT '0',
  `novoice` tinyint(3) DEFAULT '0',
  `needfollow` tinyint(3) DEFAULT '0',
  `needpostfollow` tinyint(3) DEFAULT '0',
  `share_title` varchar(255) DEFAULT '',
  `share_icon` varchar(255) DEFAULT '',
  `share_desc` varchar(255) DEFAULT '',
  `keyword` varchar(255) DEFAULT '',
  `isrecommand` tinyint(3) DEFAULT '0',
  `banner` varchar(255) DEFAULT '',
  `needcheck` tinyint(3) DEFAULT '0',
  `needcheckmanager` tinyint(3) DEFAULT '0',
  `needcheckreply` int(11) DEFAULT '0',
  `needcheckreplymanager` int(11) DEFAULT '0',
  `showsnslevels` text,
  `postsnslevels` text,
  `showpartnerlevels` text,
  `postpartnerlevels` text,
  `notpartner` tinyint(3) DEFAULT '0',
  `notpartnerpost` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_displayorder` (`displayorder`),
  KEY `idx_cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sns_board_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `bid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT NULL,
  `createtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_bid` (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sns_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `displayorder` tinyint(3) unsigned DEFAULT '0',
  `enabled` tinyint(1) DEFAULT '1',
  `advimg` varchar(255) DEFAULT '',
  `advurl` varchar(500) DEFAULT '',
  `isrecommand` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_enabled` (`enabled`),
  KEY `idx_isrecommand` (`isrecommand`),
  KEY `idx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sns_complain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(3) NOT NULL,
  `postsid` int(11) NOT NULL DEFAULT '0',
  `defendant` varchar(255) NOT NULL DEFAULT '0',
  `complainant` varchar(255) NOT NULL DEFAULT '0',
  `complaint_type` int(10) NOT NULL DEFAULT '0',
  `complaint_text` text NOT NULL,
  `images` text NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `checkedtime` int(11) NOT NULL DEFAULT '0',
  `checked` tinyint(3) NOT NULL DEFAULT '0',
  `checked_note` varchar(255) NOT NULL,
  `deleted` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sns_complaincate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sns_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `levelname` varchar(255) DEFAULT '',
  `credit` int(11) DEFAULT '0',
  `enabled` tinyint(3) DEFAULT '0',
  `post` int(11) DEFAULT '0',
  `color` varchar(255) DEFAULT '',
  `bg` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_enabled` (`enabled`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sns_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `pid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sns_manage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `bid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `enabled` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_bid` (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sns_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `credit` int(11) DEFAULT '0',
  `sign` varchar(255) DEFAULT '',
  `isblack` tinyint(3) DEFAULT '0',
  `notupgrade` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sns_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `bid` int(11) DEFAULT '0',
  `pid` int(11) DEFAULT '0',
  `rpid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `avatar` varchar(255) DEFAULT '',
  `nickname` varchar(255) DEFAULT '',
  `title` varchar(50) DEFAULT '',
  `content` text,
  `images` text,
  `voice` varchar(255) DEFAULT NULL,
  `createtime` int(11) DEFAULT '0',
  `replytime` int(11) DEFAULT '0',
  `credit` int(11) DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `islock` tinyint(1) DEFAULT '0',
  `istop` tinyint(1) DEFAULT '0',
  `isboardtop` tinyint(1) DEFAULT '0',
  `isbest` tinyint(1) DEFAULT '0',
  `isboardbest` tinyint(3) DEFAULT '0',
  `deleted` tinyint(3) DEFAULT '0',
  `deletedtime` int(11) DEFAULT '0',
  `checked` tinyint(3) DEFAULT NULL,
  `checktime` int(11) DEFAULT '0',
  `isadmin` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_bid` (`bid`),
  KEY `idx_pid` (`pid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_islock` (`islock`),
  KEY `idx_istop` (`istop`),
  KEY `idx_isboardtop` (`isboardtop`),
  KEY `idx_isbest` (`isbest`),
  KEY `idx_deleted` (`deleted`),
  KEY `idx_deletetime` (`deletedtime`),
  KEY `idx_checked` (`checked`),
  KEY `idx_rpid` (`rpid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `storename` varchar(255) DEFAULT '',
  `address` varchar(255) DEFAULT '',
  `tel` varchar(255) DEFAULT '',
  `lat` varchar(255) DEFAULT '',
  `lng` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `type` tinyint(1) DEFAULT '0',
  `realname` varchar(255) DEFAULT '',
  `mobile` varchar(255) DEFAULT '',
  `fetchtime` varchar(255) DEFAULT '',
  `logo` varchar(255) DEFAULT '',
  `saletime` varchar(255) DEFAULT '',
  `desc` text,
  `displayorder` int(11) DEFAULT '0',
  `order_printer` varchar(500) DEFAULT '',
  `order_template` int(11) DEFAULT '0',
  `ordertype` varchar(500) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_sysset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `sets` longtext,
  `plugins` longtext,
  `sec` text,
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_system_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `module` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_system_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `author` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `content` text,
  `createtime` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `cate` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_system_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `background` varchar(10) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_system_case` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `qr` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `cate` int(11) DEFAULT '0',
  `description` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_system_casecategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_system_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_system_company_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `author` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `content` text,
  `createtime` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `cate` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_system_company_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_system_copyright` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `copyright` text,
  `bgcolor` varchar(255) DEFAULT '',
  `ismanage` tinyint(3) DEFAULT '0',
  `logo` varchar(255) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_system_copyright_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `author` varchar(255) DEFAULT '',
  `content` text,
  `createtime` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_system_guestbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `content` varchar(255) NOT NULL DEFAULT '',
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `createtime` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `clientip` varchar(64) NOT NULL DEFAULT '',
  `mobile` varchar(11) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_system_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `displayorder` int(11) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_system_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL,
  `background` varchar(10) DEFAULT '',
  `casebanner` varchar(255) DEFAULT '',
  `contact` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_system_site` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL DEFAULT '',
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_task_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_task_default` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `data` text,
  `addtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_task_join` (
  `join_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `join_user` varchar(100) NOT NULL DEFAULT '',
  `task_id` int(11) NOT NULL DEFAULT '0',
  `task_type` tinyint(1) NOT NULL DEFAULT '0',
  `needcount` tinyint(3) NOT NULL DEFAULT '0',
  `completecount` tinyint(3) NOT NULL DEFAULT '0',
  `reward_data` text,
  `is_reward` tinyint(1) NOT NULL DEFAULT '0',
  `failtime` int(11) NOT NULL DEFAULT '0',
  `addtime` int(11) DEFAULT '0',
  PRIMARY KEY (`join_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_task_joiner` (
  `complete_id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `task_user` varchar(100) NOT NULL DEFAULT '',
  `joiner_id` varchar(100) NOT NULL DEFAULT '',
  `join_id` int(11) NOT NULL DEFAULT '0',
  `task_id` int(11) NOT NULL DEFAULT '0',
  `task_type` tinyint(1) NOT NULL DEFAULT '0',
  `join_status` tinyint(1) NOT NULL DEFAULT '1',
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`complete_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_task_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(100) NOT NULL DEFAULT '',
  `from_openid` varchar(100) NOT NULL DEFAULT '',
  `join_id` int(11) NOT NULL DEFAULT '0',
  `taskid` int(11) DEFAULT '0',
  `task_type` tinyint(1) NOT NULL DEFAULT '0',
  `subdata` text,
  `recdata` text,
  `createtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_task_poster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `days` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `bg` varchar(255) DEFAULT '',
  `data` text,
  `keyword` varchar(255) DEFAULT NULL,
  `resptype` tinyint(1) NOT NULL DEFAULT '0',
  `resptext` text,
  `resptitle` varchar(255) DEFAULT NULL,
  `respthumb` varchar(255) DEFAULT NULL,
  `respdesc` varchar(255) DEFAULT NULL,
  `respurl` varchar(255) DEFAULT NULL,
  `createtime` int(11) DEFAULT NULL,
  `waittext` varchar(255) DEFAULT NULL,
  `oktext` varchar(255) DEFAULT NULL,
  `scantext` varchar(255) DEFAULT NULL,
  `beagent` tinyint(1) NOT NULL DEFAULT '0',
  `bedown` tinyint(1) NOT NULL DEFAULT '0',
  `timestart` int(11) DEFAULT NULL,
  `timeend` int(11) DEFAULT NULL,
  `is_repeat` tinyint(1) DEFAULT '0',
  `getposter` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `starttext` varchar(255) DEFAULT NULL,
  `endtext` varchar(255) DEFAULT NULL,
  `reward_data` text,
  `needcount` tinyint(3) NOT NULL DEFAULT '0',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `poster_type` tinyint(1) DEFAULT '1',
  `reward_days` int(11) DEFAULT '0',
  `titleicon` text,
  `poster_banner` text,
  `is_goods` tinyint(1) DEFAULT '0',
  `autoposter` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_task_poster_qr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(100) NOT NULL,
  `posterid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `sceneid` int(11) NOT NULL DEFAULT '0',
  `mediaid` varchar(255) DEFAULT NULL,
  `ticket` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `createtime` int(11) DEFAULT NULL,
  `qrimg` varchar(1000) DEFAULT NULL,
  `expire` int(11) DEFAULT NULL,
  `endtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_virtual_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_virtual_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `typeid` int(11) NOT NULL DEFAULT '0',
  `pvalue` varchar(255) DEFAULT '',
  `fields` text NOT NULL,
  `openid` varchar(255) NOT NULL DEFAULT '',
  `usetime` int(11) NOT NULL DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `ordersn` varchar(255) DEFAULT '',
  `price` decimal(10,2) DEFAULT '0.00',
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_typeid` (`typeid`),
  KEY `idx_usetime` (`usetime`),
  KEY `idx_orderid` (`orderid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_virtual_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `cate` int(11) DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `fields` text NOT NULL,
  `usedata` int(11) NOT NULL DEFAULT '0',
  `alldata` int(11) NOT NULL DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_cate` (`cate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_shop_wxcard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `card_id` varchar(255) DEFAULT NULL,
  `displayorder` int(11) DEFAULT NULL,
  `catid` int(11) DEFAULT NULL,
  `card_type` varchar(50) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `wxlogourl` varchar(255) DEFAULT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `code_type` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `notice` varchar(50) DEFAULT NULL,
  `service_phone` varchar(50) DEFAULT NULL,
  `description` text,
  `datetype` varchar(50) DEFAULT NULL,
  `begin_timestamp` int(11) DEFAULT NULL,
  `end_timestamp` int(11) DEFAULT NULL,
  `fixed_term` int(11) DEFAULT NULL,
  `fixed_begin_term` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_quantity` varchar(255) DEFAULT NULL,
  `use_limit` int(11) DEFAULT NULL,
  `get_limit` int(11) DEFAULT NULL,
  `use_custom_code` tinyint(1) DEFAULT NULL,
  `bind_openid` tinyint(1) DEFAULT NULL,
  `can_share` tinyint(1) DEFAULT NULL,
  `can_give_friend` tinyint(1) DEFAULT NULL,
  `center_title` varchar(20) DEFAULT NULL,
  `center_sub_title` varchar(20) DEFAULT NULL,
  `center_url` varchar(255) DEFAULT NULL,
  `setcustom` tinyint(1) DEFAULT NULL,
  `custom_url_name` varchar(20) DEFAULT NULL,
  `custom_url_sub_title` varchar(20) DEFAULT NULL,
  `custom_url` varchar(255) DEFAULT NULL,
  `setpromotion` tinyint(1) DEFAULT NULL,
  `promotion_url_name` varchar(20) DEFAULT NULL,
  `promotion_url_sub_title` varchar(20) DEFAULT NULL,
  `promotion_url` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `can_use_with_other_discount` tinyint(1) DEFAULT NULL,
  `setabstract` tinyint(1) DEFAULT NULL,
  `abstract` varchar(50) DEFAULT NULL,
  `abstractimg` varchar(255) DEFAULT NULL,
  `icon_url_list` varchar(255) DEFAULT NULL,
  `accept_category` varchar(50) DEFAULT NULL,
  `reject_category` varchar(50) DEFAULT NULL,
  `least_cost` decimal(10,2) DEFAULT NULL,
  `reduce_cost` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `limitgoodtype` tinyint(1) DEFAULT NULL,
  `limitgoodcatetype` tinyint(1) unsigned DEFAULT NULL,
  `limitgoodcateids` varchar(255) DEFAULT NULL,
  `limitgoodids` varchar(255) DEFAULT NULL,
  `limitdiscounttype` tinyint(1) unsigned DEFAULT NULL,
  `merchid` int(11) DEFAULT NULL,
  `gettype` tinyint(3) DEFAULT NULL,
  `islimitlevel` tinyint(1) DEFAULT NULL,
  `limitmemberlevels` varchar(500) DEFAULT NULL,
  `limitagentlevels` varchar(500) DEFAULT NULL,
  `limitpartnerlevels` varchar(500) DEFAULT NULL,
  `limitaagentlevels` varchar(500) DEFAULT NULL,
  `settitlecolor` tinyint(1) DEFAULT NULL,
  `titlecolor` varchar(10) DEFAULT NULL,
  `tagtitle` varchar(20) DEFAULT NULL,
  `use_condition` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_takephoto_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `rid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `description` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `starttime` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `bgimg` varchar(255) DEFAULT '',
  `helpimg` varchar(255) DEFAULT '',
  `shareimg` varchar(255) DEFAULT '',
  `titleimg` varchar(255) DEFAULT '',
  `cameraimg` varchar(255) DEFAULT '',
  `numberimg` varchar(255) DEFAULT '',
  `items` text COMMENT '物品',
  `follow_url` varchar(1000) DEFAULT '',
  `follow_button` varchar(1000) DEFAULT '',
  `share_url` varchar(1000) DEFAULT '',
  `viewnum` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `share_desc` varchar(500) DEFAULT '',
  `share_icon` varchar(255) DEFAULT '',
  `share_title` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_rid` (`rid`),
  KEY `idx_status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_takephotoa_fans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '' COMMENT '用户openid',
  `nickname` varchar(255) DEFAULT '' COMMENT '用户昵称',
  `headimgurl` varchar(255) DEFAULT '' COMMENT '用户头像',
  `score` decimal(10,2) DEFAULT '0.00' COMMENT '平均',
  `img` varchar(255) DEFAULT '' COMMENT '成绩截图',
  `createtime` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_takephotoa_fans_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '' COMMENT '用户openid',
  `score` decimal(10,2) DEFAULT '0.00' COMMENT '平均',
  `createtime` int(10) DEFAULT '0',
  `img` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_rid` (`rid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_takephotoa_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `rid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `description` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `starttime` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `bgimg` varchar(255) DEFAULT '',
  `helpimg` varchar(255) DEFAULT '',
  `shareimg` varchar(255) DEFAULT '',
  `titleimg` varchar(255) DEFAULT '',
  `cameraimg` varchar(255) DEFAULT '',
  `numberimg` varchar(255) DEFAULT '',
  `items` text COMMENT '物品',
  `follow_url` varchar(1000) DEFAULT '',
  `share_url` varchar(1000) DEFAULT '',
  `viewnum` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `share_desc` varchar(500) DEFAULT '',
  `share_icon` varchar(255) DEFAULT '',
  `share_title` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`),
  KEY `idx_rid` (`rid`),
  KEY `idx_status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_ewei_takephotoa_sysset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `oauth2` tinyint(1) DEFAULT '0',
  `appid` varchar(255) DEFAULT '',
  `appsecret` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
pdo_run($sql);
if(!pdo_fieldexists('ewei_message_mass_sign',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_sign')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_message_mass_sign',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_sign')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_sign',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_sign')." ADD `openid` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_sign',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_sign')." ADD `nickname` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_sign',  'taskid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_sign')." ADD `taskid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_sign',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_sign')." ADD `status` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_sign',  'log')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_sign')." ADD `log` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `title` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `status` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'processnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `processnum` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'sendnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `sendnum` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'messagetype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `messagetype` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'templateid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `templateid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'resptitle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `resptitle` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'respthumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `respthumb` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'respdesc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `respdesc` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'respurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `respurl` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'sendlimittype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `sendlimittype` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'send_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `send_openid` text;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'send_level')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `send_level` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'send_group')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `send_group` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'send_agentlevel')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `send_agentlevel` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'customertype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `customertype` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_task',  'resdesc2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_task')." ADD `resdesc2` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_template',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_template')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_message_mass_template',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_template')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_template',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_template')." ADD `title` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_template',  'template_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_template')." ADD `template_id` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_template',  'first')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_template')." ADD `first` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_template',  'firstcolor')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_template')." ADD `firstcolor` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_template',  'data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_template')." ADD `data` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_template',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_template')." ADD `remark` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_template',  'remarkcolor')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_template')." ADD `remarkcolor` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_template',  'url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_template')." ADD `url` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_template',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_template')." ADD `createtime` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_template',  'sendtimes')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_template')." ADD `sendtimes` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_message_mass_template',  'sendcount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_message_mass_template')." ADD `sendcount` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'billno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `billno` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `paytype` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'year')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `year` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'month')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `month` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'week')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `week` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'ordercount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `ordercount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'ordermoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `ordermoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `paytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'aagentcount1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `aagentcount1` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'aagentcount2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `aagentcount2` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'aagentcount3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `aagentcount3` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'bonusmoney1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `bonusmoney1` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'bonusmoney_send1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `bonusmoney_send1` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'bonusmoney_pay1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `bonusmoney_pay1` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'bonusmoney2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `bonusmoney2` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'bonusmoney_send2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `bonusmoney_send2` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'bonusmoney_pay2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `bonusmoney_pay2` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'bonusmoney3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `bonusmoney3` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'bonusmoney_send3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `bonusmoney_send3` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'bonusmoney_pay3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `bonusmoney_pay3` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `starttime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `endtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_bill',  'confirmtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD `confirmtime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_abonus_bill',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_abonus_bill',  'idx_paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD KEY `idx_paytype` (`paytype`);");
}
if(!pdo_indexexists('ewei_shop_abonus_bill',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_abonus_bill',  'idx_paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD KEY `idx_paytime` (`paytime`);");
}
if(!pdo_indexexists('ewei_shop_abonus_bill',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_abonus_bill',  'idx_month')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD KEY `idx_month` (`month`);");
}
if(!pdo_indexexists('ewei_shop_abonus_bill',  'idx_week')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD KEY `idx_week` (`week`);");
}
if(!pdo_indexexists('ewei_shop_abonus_bill',  'idx_year')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_bill')." ADD KEY `idx_year` (`year`);");
}
if(!pdo_fieldexists('ewei_shop_abonus_billo',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billo')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_abonus_billo',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billo')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billo',  'billid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billo')." ADD `billid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billo',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billo')." ADD `orderid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billo',  'ordermoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billo')." ADD `ordermoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_indexexists('ewei_shop_abonus_billo',  'idx_billid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billo')." ADD KEY `idx_billid` (`billid`);");
}
if(!pdo_indexexists('ewei_shop_abonus_billo',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billo')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'billid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `billid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'payno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `payno` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `paytype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'bonus1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `bonus1` decimal(10,4) DEFAULT '0.0000';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'bonus2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `bonus2` decimal(10,4) DEFAULT '0.0000';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'bonus3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `bonus3` decimal(10,4) DEFAULT '0.0000';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'money1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `money1` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'realmoney1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `realmoney1` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'paymoney1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `paymoney1` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'money2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `money2` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'realmoney2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `realmoney2` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'paymoney2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `paymoney2` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'money3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `money3` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'realmoney3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `realmoney3` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'paymoney3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `paymoney3` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'chargemoney1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `chargemoney1` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'chargemoney2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `chargemoney2` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'chargemoney3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `chargemoney3` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'charge')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `charge` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'reason')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `reason` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_abonus_billp',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD `paytime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_abonus_billp',  'idx_billid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD KEY `idx_billid` (`billid`);");
}
if(!pdo_indexexists('ewei_shop_abonus_billp',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_billp')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_abonus_level',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_level')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_abonus_level',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_level')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_abonus_level',  'levelname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_level')." ADD `levelname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_abonus_level',  'bonus1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_level')." ADD `bonus1` decimal(10,4) DEFAULT '0.0000';");
}
if(!pdo_fieldexists('ewei_shop_abonus_level',  'bonus2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_level')." ADD `bonus2` decimal(10,4) DEFAULT '0.0000';");
}
if(!pdo_fieldexists('ewei_shop_abonus_level',  'bonus3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_level')." ADD `bonus3` decimal(10,4) DEFAULT '0.0000';");
}
if(!pdo_fieldexists('ewei_shop_abonus_level',  'ordermoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_level')." ADD `ordermoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_level',  'ordercount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_level')." ADD `ordercount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_abonus_level',  'bonusmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_level')." ADD `bonusmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_abonus_level',  'downcount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_level')." ADD `downcount` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_abonus_level',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_abonus_level')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_adv',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_adv')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_adv',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_adv')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_adv',  'advname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_adv')." ADD `advname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_adv',  'link')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_adv')." ADD `link` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_adv',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_adv')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_adv',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_adv')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_adv',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_adv')." ADD `enabled` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_adv',  'shopid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_adv')." ADD `shopid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_adv',  'iswxapp')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_adv')." ADD `iswxapp` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_adv',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_adv')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_adv',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_adv')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_indexexists('ewei_shop_adv',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_adv')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_fieldexists('ewei_shop_area_config',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_area_config')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_area_config',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_area_config')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_area_config',  'new_area')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_area_config')." ADD `new_area` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_area_config',  'address_street')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_area_config')." ADD `address_street` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_area_config',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_area_config')." ADD `createtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_area_config',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_area_config')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_article',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_title` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article',  'resp_desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `resp_desc` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_article',  'resp_img')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `resp_img` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_content` longtext;");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_category')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_category` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_date_v')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_date_v` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_date')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_date` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_mp')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_mp` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_author')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_author` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_readnum_v')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_readnum_v` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_readnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_readnum` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_likenum_v')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_likenum_v` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_likenum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_likenum` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_linkurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_linkurl` varchar(300) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_rule_daynum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_rule_daynum` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_rule_allnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_rule_allnum` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_rule_credit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_rule_credit` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_rule_money')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_rule_money` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_article',  'page_set_option_nocopy')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `page_set_option_nocopy` int(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'page_set_option_noshare_tl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `page_set_option_noshare_tl` int(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'page_set_option_noshare_msg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `page_set_option_noshare_msg` int(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_keyword')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_keyword` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_keyword2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_keyword2` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_report')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_report` int(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'product_advs_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `product_advs_type` int(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'product_advs_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `product_advs_title` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article',  'product_advs_more')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `product_advs_more` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article',  'product_advs_link')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `product_advs_link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article',  'product_advs')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `product_advs` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_state')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_state` int(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'network_attachment')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `network_attachment` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_rule_credittotal')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_rule_credittotal` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_rule_moneytotal')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_rule_moneytotal` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_rule_credit2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_rule_credit2` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_rule_money2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_rule_money2` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_rule_creditm')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_rule_creditm` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_rule_moneym')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_rule_moneym` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_rule_creditm2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_rule_creditm2` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_rule_moneym2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_rule_moneym2` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_readtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_readtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_areas')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_areas` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_endtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_hasendtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_hasendtime` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_advance')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_advance` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_virtualadd')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_virtualadd` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_visit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_visit` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_visit_level')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_visit_level` text;");
}
if(!pdo_fieldexists('ewei_shop_article',  'article_visit_tip')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD `article_visit_tip` varchar(500) DEFAULT NULL;");
}
if(!pdo_indexexists('ewei_shop_article',  'idx_article_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD KEY `idx_article_title` (`article_title`);");
}
if(!pdo_indexexists('ewei_shop_article',  'idx_article_keyword')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD KEY `idx_article_keyword` (`article_keyword`);");
}
if(!pdo_indexexists('ewei_shop_article',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_article_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_article_category',  'category_name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_category')." ADD `category_name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_category')." ADD `displayorder` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article_category',  'isshow')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_category')." ADD `isshow` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_category')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_article_category',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_category')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_article_category',  'idx_category_name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_category')." ADD KEY `idx_category_name` (`category_name`);");
}
if(!pdo_fieldexists('ewei_shop_article_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_log')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_article_log',  'aid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_log')." ADD `aid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article_log',  'read')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_log')." ADD `read` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article_log',  'like')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_log')." ADD `like` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article_log',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_log')." ADD `openid` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_log')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_article_log',  'idx_aid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_log')." ADD KEY `idx_aid` (`aid`);");
}
if(!pdo_indexexists('ewei_shop_article_log',  'idx_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_log')." ADD KEY `idx_openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_article_log',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_log')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_article_report',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_report')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_article_report',  'mid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_report')." ADD `mid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article_report',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_report')." ADD `openid` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article_report',  'aid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_report')." ADD `aid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article_report',  'cate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_report')." ADD `cate` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article_report',  'cons')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_report')." ADD `cons` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article_report',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_report')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article_share',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_share')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_article_share',  'aid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_share')." ADD `aid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article_share',  'share_user')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_share')." ADD `share_user` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article_share',  'click_user')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_share')." ADD `click_user` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article_share',  'click_date')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_share')." ADD `click_date` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article_share',  'add_credit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_share')." ADD `add_credit` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article_share',  'add_money')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_share')." ADD `add_money` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_article_share',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_share')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_article_share',  'idx_aid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_share')." ADD KEY `idx_aid` (`aid`);");
}
if(!pdo_indexexists('ewei_shop_article_share',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_share')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_article_sys',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_sys')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article_sys',  'article_message')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_sys')." ADD `article_message` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article_sys',  'article_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_sys')." ADD `article_title` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article_sys',  'article_image')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_sys')." ADD `article_image` varchar(300) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article_sys',  'article_shownum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_sys')." ADD `article_shownum` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_article_sys',  'article_keyword')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_sys')." ADD `article_keyword` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article_sys',  'article_source')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_sys')." ADD `article_source` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_article_sys',  'article_temp')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_sys')." ADD `article_temp` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_article_sys',  'idx_article_message')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_sys')." ADD KEY `idx_article_message` (`article_message`);");
}
if(!pdo_indexexists('ewei_shop_article_sys',  'idx_article_keyword')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_sys')." ADD KEY `idx_article_keyword` (`article_keyword`);");
}
if(!pdo_indexexists('ewei_shop_article_sys',  'idx_article_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article_sys')." ADD KEY `idx_article_title` (`article_title`);");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'billno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `billno` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `paytype` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'year')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `year` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'month')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `month` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'week')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `week` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'ordercount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `ordercount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'ordermoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `ordermoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'bonusordermoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `bonusordermoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'bonusrate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `bonusrate` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'bonusmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `bonusmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'bonusmoney_send')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `bonusmoney_send` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'bonusmoney_pay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `bonusmoney_pay` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `paytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'partnercount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `partnercount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `starttime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `endtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_bill',  'confirmtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD `confirmtime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_author_bill',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_author_bill',  'idx_paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD KEY `idx_paytype` (`paytype`);");
}
if(!pdo_indexexists('ewei_shop_author_bill',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_author_bill',  'idx_paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD KEY `idx_paytime` (`paytime`);");
}
if(!pdo_indexexists('ewei_shop_author_bill',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_author_bill',  'idx_month')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD KEY `idx_month` (`month`);");
}
if(!pdo_indexexists('ewei_shop_author_bill',  'idx_week')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD KEY `idx_week` (`week`);");
}
if(!pdo_indexexists('ewei_shop_author_bill',  'idx_year')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_bill')." ADD KEY `idx_year` (`year`);");
}
if(!pdo_fieldexists('ewei_shop_author_billo',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billo')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_author_billo',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billo')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_billo',  'billid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billo')." ADD `billid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_billo',  'authorid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billo')." ADD `authorid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_author_billo',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billo')." ADD `orderid` text;");
}
if(!pdo_fieldexists('ewei_shop_author_billo',  'ordermoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billo')." ADD `ordermoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_indexexists('ewei_shop_author_billo',  'idx_billid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billo')." ADD KEY `idx_billid` (`billid`);");
}
if(!pdo_indexexists('ewei_shop_author_billo',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billo')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_author_billp',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_author_billp',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_billp',  'billid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD `billid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_billp',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_author_billp',  'payno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD `payno` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_author_billp',  'paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD `paytype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_billp',  'bonus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD `bonus` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_billp',  'money')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD `money` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_billp',  'realmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD `realmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_billp',  'paymoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD `paymoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_billp',  'charge')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD `charge` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_billp',  'chargemoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD `chargemoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_billp',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_billp',  'reason')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD `reason` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_author_billp',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD `paytime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_author_billp',  'idx_billid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD KEY `idx_billid` (`billid`);");
}
if(!pdo_indexexists('ewei_shop_author_billp',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_billp')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_author_level',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_level')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_author_level',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_level')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_author_level',  'levelname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_level')." ADD `levelname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_author_level',  'bonus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_level')." ADD `bonus` decimal(10,4) DEFAULT '0.0000';");
}
if(!pdo_fieldexists('ewei_shop_author_level',  'ordermoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_level')." ADD `ordermoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_level',  'ordercount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_level')." ADD `ordercount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_level',  'commissionmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_level')." ADD `commissionmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_level',  'bonusmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_level')." ADD `bonusmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_level',  'downcount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_level')." ADD `downcount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_level',  'bonus_fg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_level')." ADD `bonus_fg` varchar(500) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_author_level',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_level')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_author_team',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_author_team',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_team',  'teamno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD `teamno` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_author_team',  'year')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD `year` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_team',  'month')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD `month` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_team',  'team_count')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD `team_count` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_team',  'team_ids')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD `team_ids` longtext;");
}
if(!pdo_fieldexists('ewei_shop_author_team',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_team',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_team',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD `paytime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_author_team',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_author_team',  'teamno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD KEY `teamno` (`teamno`);");
}
if(!pdo_indexexists('ewei_shop_author_team',  'year')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD KEY `year` (`year`);");
}
if(!pdo_indexexists('ewei_shop_author_team',  'month')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD KEY `month` (`month`);");
}
if(!pdo_indexexists('ewei_shop_author_team',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_author_team',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team')." ADD KEY `createtime` (`createtime`);");
}
if(!pdo_fieldexists('ewei_shop_author_team_pay',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team_pay')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_author_team_pay',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team_pay')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_team_pay',  'teamid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team_pay')." ADD `teamid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_team_pay',  'mid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team_pay')." ADD `mid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_author_team_pay',  'payno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team_pay')." ADD `payno` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_author_team_pay',  'money')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team_pay')." ADD `money` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_team_pay',  'paymoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team_pay')." ADD `paymoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_author_team_pay',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team_pay')." ADD `paytime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_author_team_pay',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team_pay')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_author_team_pay',  'idx_teamid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team_pay')." ADD KEY `idx_teamid` (`teamid`);");
}
if(!pdo_indexexists('ewei_shop_author_team_pay',  'idx_mid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_author_team_pay')." ADD KEY `idx_mid` (`mid`);");
}
if(!pdo_fieldexists('ewei_shop_banner',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_banner')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_banner',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_banner')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_banner',  'bannername')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_banner')." ADD `bannername` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_banner',  'link')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_banner')." ADD `link` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_banner',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_banner')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_banner',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_banner')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_banner',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_banner')." ADD `enabled` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_banner',  'shopid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_banner')." ADD `shopid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_banner',  'iswxapp')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_banner')." ADD `iswxapp` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_banner',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_banner')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_banner',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_banner')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_indexexists('ewei_shop_banner',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_banner')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_fieldexists('ewei_shop_bargain_account',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_account')." ADD `id` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_account',  'mall_name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_account')." ADD `mall_name` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_account',  'banner')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_account')." ADD `banner` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_account',  'mall_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_account')." ADD `mall_title` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_account',  'mall_content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_account')." ADD `mall_content` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_account',  'mall_logo')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_account')." ADD `mall_logo` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_account',  'message')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_account')." ADD `message` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_bargain_account',  'partin')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_account')." ADD `partin` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_bargain_account',  'rule')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_account')." ADD `rule` text;");
}
if(!pdo_fieldexists('ewei_shop_bargain_account',  'end_message')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_account')." ADD `end_message` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_bargain_actor',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_actor')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_bargain_actor',  'goods_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_actor')." ADD `goods_id` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_actor',  'now_price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_actor')." ADD `now_price` decimal(9,2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_actor',  'created_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_actor')." ADD `created_time` datetime NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_actor',  'update_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_actor')." ADD `update_time` datetime NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_actor',  'bargain_times')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_actor')." ADD `bargain_times` int(10) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_actor',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_actor')." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_bargain_actor',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_actor')." ADD `nickname` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_actor',  'head_image')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_actor')." ADD `head_image` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_actor',  'bargain_price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_actor')." ADD `bargain_price` decimal(9,2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_actor',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_actor')." ADD `status` tinyint(2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_actor',  'account_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_actor')." ADD `account_id` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_actor',  'initiate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_actor')." ADD `initiate` tinyint(4) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_bargain_actor',  'order')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_actor')." ADD `order` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'account_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `account_id` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'goods_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `goods_id` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'end_price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `end_price` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'start_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `start_time` datetime NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'end_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `end_time` datetime NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `status` tinyint(2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `type` tinyint(2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'user_set')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `user_set` text;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'rule')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `rule` text;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'act_times')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `act_times` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'mode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `mode` tinyint(4) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'total_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `total_time` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'each_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `each_time` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'time_limit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `time_limit` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'probability')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `probability` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'custom')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `custom` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'maximum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `maximum` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'initiate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `initiate` tinyint(4) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_bargain_goods',  'myself')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD `myself` tinyint(3) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_bargain_goods',  'goods_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_goods')." ADD KEY `goods_id` (`goods_id`);");
}
if(!pdo_fieldexists('ewei_shop_bargain_record',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_record')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_bargain_record',  'actor_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_record')." ADD `actor_id` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_record',  'bargain_price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_record')." ADD `bargain_price` decimal(9,2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_record',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_record')." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_bargain_record',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_record')." ADD `nickname` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_record',  'head_image')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_record')." ADD `head_image` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_bargain_record',  'bargain_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_bargain_record')." ADD `bargain_time` datetime NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_carrier',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_carrier')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_carrier',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_carrier')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_carrier',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_carrier')." ADD `realname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_carrier',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_carrier')." ADD `mobile` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_carrier',  'address')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_carrier')." ADD `address` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_carrier',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_carrier')." ADD `deleted` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_carrier',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_carrier')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_carrier',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_carrier')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_carrier',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_carrier')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_carrier',  'idx_deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_carrier')." ADD KEY `idx_deleted` (`deleted`);");
}
if(!pdo_indexexists('ewei_shop_carrier',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_carrier')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_fieldexists('ewei_shop_cashier_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_cashier_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_category')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_category',  'catename')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_category')." ADD `catename` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_category',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_category')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_category',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_category')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_category')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_cashier_category',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_category')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_cashier_clearing',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_cashier_clearing',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_clearing',  'cashierid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD `cashierid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_clearing',  'clearno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD `clearno` varchar(64) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_clearing',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_clearing',  'money')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD `money` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_clearing',  'realmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD `realmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_clearing',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD `remark` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_clearing',  'orderids')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD `orderids` text;");
}
if(!pdo_fieldexists('ewei_shop_cashier_clearing',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_clearing',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD `paytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_clearing',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD `deleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_clearing',  'paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD `paytype` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_clearing',  'payinfo')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD `payinfo` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_clearing',  'charge')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD `charge` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_indexexists('ewei_shop_cashier_clearing',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_cashier_clearing',  'storeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD KEY `storeid` (`cashierid`);");
}
if(!pdo_indexexists('ewei_shop_cashier_clearing',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD KEY `status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_cashier_clearing',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD KEY `createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_cashier_clearing',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD KEY `deleted` (`deleted`);");
}
if(!pdo_indexexists('ewei_shop_cashier_clearing',  'clearno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_clearing')." ADD KEY `clearno` (`clearno`);");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods',  'cashierid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods')." ADD `cashierid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods')." ADD `createtime` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods',  'image')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods')." ADD `image` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods',  'categoryid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods')." ADD `categoryid` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods',  'price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods')." ADD `price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods',  'total')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods')." ADD `total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods',  'goodssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods')." ADD `goodssn` varchar(50) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_cashier_goods',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_cashier_goods',  'cashierid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods')." ADD KEY `cashierid` (`cashierid`);");
}
if(!pdo_indexexists('ewei_shop_cashier_goods',  'goodssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods')." ADD KEY `goodssn` (`goodssn`);");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods_category')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods_category',  'cashierid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods_category')." ADD `cashierid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods_category',  'catename')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods_category')." ADD `catename` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods_category',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods_category')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods_category',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods_category')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_goods_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods_category')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_cashier_goods_category',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods_category')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_cashier_goods_category',  'idx_cashierid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_goods_category')." ADD KEY `idx_cashierid` (`cashierid`);");
}
if(!pdo_fieldexists('ewei_shop_cashier_operator',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_operator')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_cashier_operator',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_operator')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_operator',  'cashierid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_operator')." ADD `cashierid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_operator',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_operator')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_operator',  'manageopenid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_operator')." ADD `manageopenid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_operator',  'username')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_operator')." ADD `username` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_operator',  'password')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_operator')." ADD `password` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_operator',  'salt')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_operator')." ADD `salt` varchar(8) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_operator',  'perm')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_operator')." ADD `perm` text;");
}
if(!pdo_fieldexists('ewei_shop_cashier_operator',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_operator')." ADD `createtime` int(10) unsigned DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_cashier_operator',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_operator')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_cashier_operator',  'cashierid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_operator')." ADD KEY `cashierid` (`cashierid`);");
}
if(!pdo_indexexists('ewei_shop_cashier_operator',  'manageopenid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_operator')." ADD KEY `manageopenid` (`manageopenid`);");
}
if(!pdo_indexexists('ewei_shop_cashier_operator',  'username')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_operator')." ADD KEY `username` (`username`);");
}
if(!pdo_fieldexists('ewei_shop_cashier_order',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_order')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_cashier_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_order')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_order',  'ordersn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_order')." ADD `ordersn` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_order',  'price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_order')." ADD `price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_order',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_order')." ADD `openid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_order',  'payopenid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_order')." ADD `payopenid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_order',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_order')." ADD `createtime` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_order',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_order')." ADD `status` tinyint(4) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_order',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_order')." ADD `paytime` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'cashierid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `cashierid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'operatorid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `operatorid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `openid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `paytype` tinyint(3) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'logno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `logno` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `status` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'money')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `money` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `paytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'is_applypay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `is_applypay` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'randommoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `randommoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'enough')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `enough` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `mobile` varchar(20) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'deduction')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `deduction` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'discountmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `discountmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'discount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `discount` decimal(5,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'isgoods')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `isgoods` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `orderid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'orderprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `orderprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'goodsprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `goodsprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'couponpay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `couponpay` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'payopenid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `payopenid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'nosalemoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `nosalemoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'coupon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `coupon` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'usecoupon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `usecoupon` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'usecouponprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `usecouponprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log',  'present_credit1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD `present_credit1` tinyint(4) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_cashier_pay_log',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_cashier_pay_log',  'idx_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD KEY `idx_type` (`paytype`);");
}
if(!pdo_indexexists('ewei_shop_cashier_pay_log',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_cashier_pay_log',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_cashier_pay_log',  'idx_storeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD KEY `idx_storeid` (`cashierid`);");
}
if(!pdo_indexexists('ewei_shop_cashier_pay_log',  'idx_logno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD KEY `idx_logno` (`logno`);");
}
if(!pdo_indexexists('ewei_shop_cashier_pay_log',  'is_applypay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD KEY `is_applypay` (`is_applypay`);");
}
if(!pdo_indexexists('ewei_shop_cashier_pay_log',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log')." ADD KEY `orderid` (`orderid`);");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log_goods',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log_goods')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log_goods',  'cashierid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log_goods')." ADD `cashierid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log_goods',  'logid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log_goods')." ADD `logid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log_goods',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log_goods')." ADD `goodsid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log_goods',  'price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log_goods')." ADD `price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_pay_log_goods',  'total')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log_goods')." ADD `total` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_cashier_pay_log_goods',  'logid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log_goods')." ADD KEY `logid` (`logid`);");
}
if(!pdo_indexexists('ewei_shop_cashier_pay_log_goods',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log_goods')." ADD KEY `goodsid` (`goodsid`);");
}
if(!pdo_indexexists('ewei_shop_cashier_pay_log_goods',  'cashierid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_pay_log_goods')." ADD KEY `cashierid` (`cashierid`);");
}
if(!pdo_fieldexists('ewei_shop_cashier_qrcode',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_qrcode')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_cashier_qrcode',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_qrcode')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_qrcode',  'cashierid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_qrcode')." ADD `cashierid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_qrcode',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_qrcode')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_qrcode',  'goodstitle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_qrcode')." ADD `goodstitle` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_qrcode',  'money')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_qrcode')." ADD `money` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_qrcode',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_qrcode')." ADD `createtime` int(10) unsigned DEFAULT NULL;");
}
if(!pdo_indexexists('ewei_shop_cashier_qrcode',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_qrcode')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_cashier_qrcode',  'cashierid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_qrcode')." ADD KEY `cashierid` (`cashierid`);");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'storeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `storeid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'setmeal')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `setmeal` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'logo')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `logo` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'manageopenid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `manageopenid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'isopen_commission')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `isopen_commission` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `name` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `mobile` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'categoryid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `categoryid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'wechat_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `wechat_status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'wechatpay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `wechatpay` text;");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'alipay_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `alipay_status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'alipay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `alipay` text;");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'withdraw')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `withdraw` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `openid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'diyformfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `diyformfields` text;");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'diyformdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `diyformdata` text;");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'username')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `username` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'password')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `password` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'salt')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `salt` char(8) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'lifetimestart')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `lifetimestart` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'lifetimeend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `lifetimeend` int(10) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'set')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `set` longtext;");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `deleted` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'can_withdraw')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `can_withdraw` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'show_paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `show_paytype` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `couponid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_cashier_user',  'management')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD `management` varchar(1000) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_cashier_user',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_cashier_user',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD KEY `openid` (`manageopenid`);");
}
if(!pdo_indexexists('ewei_shop_cashier_user',  'username')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD KEY `username` (`username`);");
}
if(!pdo_indexexists('ewei_shop_cashier_user',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_cashier_user')." ADD KEY `status` (`status`);");
}
if(!pdo_fieldexists('ewei_shop_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD `name` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_category',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD `thumb` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_category',  'parentid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD `parentid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_category',  'isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD `isrecommand` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_category',  'description')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD `description` varchar(500) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD `displayorder` tinyint(3) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_category',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD `enabled` tinyint(1) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_category',  'ishome')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD `ishome` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_category',  'level')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD `level` tinyint(3) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_category',  'advimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD `advimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_category',  'advurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD `advurl` varchar(500) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_category',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_category',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_indexexists('ewei_shop_category',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_indexexists('ewei_shop_category',  'idx_parentid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD KEY `idx_parentid` (`parentid`);");
}
if(!pdo_indexexists('ewei_shop_category',  'idx_isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD KEY `idx_isrecommand` (`isrecommand`);");
}
if(!pdo_indexexists('ewei_shop_category',  'idx_ishome')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_category')." ADD KEY `idx_ishome` (`ishome`);");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'applyno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `applyno` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'mid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `mid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `type` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'orderids')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `orderids` longtext;");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'commission')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `commission` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'commission_pay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `commission_pay` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `content` text;");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'applytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `applytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'checktime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `checktime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `paytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'invalidtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `invalidtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'refusetime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `refusetime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'realmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `realmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'charge')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `charge` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'deductionmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `deductionmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'beginmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `beginmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'endmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `endmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'alipay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `alipay` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'bankname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `bankname` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'bankcard')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `bankcard` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `realname` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'repurchase')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `repurchase` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'alipay1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `alipay1` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'bankname1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `bankname1` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'bankcard1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `bankcard1` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'sendmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `sendmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_apply',  'senddata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD `senddata` text;");
}
if(!pdo_indexexists('ewei_shop_commission_apply',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_commission_apply',  'idx_mid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD KEY `idx_mid` (`mid`);");
}
if(!pdo_indexexists('ewei_shop_commission_apply',  'idx_checktime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD KEY `idx_checktime` (`checktime`);");
}
if(!pdo_indexexists('ewei_shop_commission_apply',  'idx_paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD KEY `idx_paytime` (`paytime`);");
}
if(!pdo_indexexists('ewei_shop_commission_apply',  'idx_applytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD KEY `idx_applytime` (`applytime`);");
}
if(!pdo_indexexists('ewei_shop_commission_apply',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_commission_apply',  'idx_invalidtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_apply')." ADD KEY `idx_invalidtime` (`invalidtime`);");
}
if(!pdo_fieldexists('ewei_shop_commission_bank',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_bank')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_commission_bank',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_bank')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_bank',  'bankname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_bank')." ADD `bankname` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_bank',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_bank')." ADD `content` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_bank',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_bank')." ADD `status` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_bank',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_bank')." ADD `displayorder` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_commission_bank',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_bank')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_commission_clickcount',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_clickcount')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_commission_clickcount',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_clickcount')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_clickcount',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_clickcount')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_clickcount',  'from_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_clickcount')." ADD `from_openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_clickcount',  'clicktime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_clickcount')." ADD `clicktime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_commission_clickcount',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_clickcount')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_commission_clickcount',  'idx_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_clickcount')." ADD KEY `idx_openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_commission_clickcount',  'idx_from_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_clickcount')." ADD KEY `idx_from_openid` (`from_openid`);");
}
if(!pdo_fieldexists('ewei_shop_commission_level',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_level')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_commission_level',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_level')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_commission_level',  'levelname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_level')." ADD `levelname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_level',  'commission1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_level')." ADD `commission1` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_level',  'commission2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_level')." ADD `commission2` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_level',  'commission3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_level')." ADD `commission3` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_level',  'ordermoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_level')." ADD `ordermoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_level',  'ordercount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_level')." ADD `ordercount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_level',  'downcount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_level')." ADD `downcount` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_level',  'commissionmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_level')." ADD `commissionmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_indexexists('ewei_shop_commission_level',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_level')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_commission_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_log')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_commission_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_log')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_log',  'applyid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_log')." ADD `applyid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_log',  'mid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_log')." ADD `mid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_log',  'commission')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_log')." ADD `commission` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_log',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_log')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_log',  'commission_pay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_log')." ADD `commission_pay` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_log',  'realmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_log')." ADD `realmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_log',  'charge')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_log')." ADD `charge` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_log',  'deductionmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_log')." ADD `deductionmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_log',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_log')." ADD `type` tinyint(3) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_commission_log',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_log')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_commission_log',  'idx_applyid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_log')." ADD KEY `idx_applyid` (`applyid`);");
}
if(!pdo_indexexists('ewei_shop_commission_log',  'idx_mid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_log')." ADD KEY `idx_mid` (`mid`);");
}
if(!pdo_indexexists('ewei_shop_commission_log',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_log')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_fieldexists('ewei_shop_commission_rank',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_rank')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_commission_rank',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_rank')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_commission_rank',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_rank')." ADD `type` tinyint(4) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_rank',  'num')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_rank')." ADD `num` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_commission_rank',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_rank')." ADD `status` tinyint(4) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_rank',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_rank')." ADD `title` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_rank',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_rank')." ADD `content` text;");
}
if(!pdo_fieldexists('ewei_shop_commission_repurchase',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_repurchase')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_commission_repurchase',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_repurchase')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_repurchase',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_repurchase')." ADD `openid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_repurchase',  'year')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_repurchase')." ADD `year` int(4) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_repurchase',  'month')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_repurchase')." ADD `month` tinyint(2) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_repurchase',  'repurchase')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_repurchase')." ADD `repurchase` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_commission_repurchase',  'applyid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_repurchase')." ADD `applyid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_commission_repurchase',  'applyid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_repurchase')." ADD KEY `applyid` (`applyid`);");
}
if(!pdo_indexexists('ewei_shop_commission_repurchase',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_repurchase')." ADD KEY `openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_commission_repurchase',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_repurchase')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_commission_shop',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_shop')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_commission_shop',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_shop')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_shop',  'mid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_shop')." ADD `mid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_shop',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_shop')." ADD `name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_shop',  'logo')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_shop')." ADD `logo` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_shop',  'img')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_shop')." ADD `img` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_commission_shop',  'desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_shop')." ADD `desc` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_commission_shop',  'selectgoods')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_shop')." ADD `selectgoods` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_shop',  'selectcategory')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_shop')." ADD `selectcategory` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_commission_shop',  'goodsids')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_shop')." ADD `goodsids` text;");
}
if(!pdo_indexexists('ewei_shop_commission_shop',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_shop')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_commission_shop',  'idx_mid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_commission_shop')." ADD KEY `idx_mid` (`mid`);");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'catid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `catid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'couponname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `couponname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'gettype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `gettype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'getmax')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `getmax` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'usetype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `usetype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'returntype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `returntype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'bgcolor')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `bgcolor` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'enough')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `enough` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'timelimit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `timelimit` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'coupontype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `coupontype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'timedays')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `timedays` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'timestart')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `timestart` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'timeend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `timeend` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'discount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `discount` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'deduct')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `deduct` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'backtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `backtype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'backmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `backmoney` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'backcredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `backcredit` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'backredpack')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `backredpack` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'backwhen')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `backwhen` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `desc` text;");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'total')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'money')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `money` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'respdesc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `respdesc` text;");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'respthumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `respthumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'resptitle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `resptitle` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'respurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `respurl` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `credit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'usecredit2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `usecredit2` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `remark` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'descnoset')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `descnoset` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'pwdkey')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `pwdkey` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'pwdkey2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `pwdkey2` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'pwdsuc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `pwdsuc` text;");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'pwdfail')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `pwdfail` text;");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'pwdurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `pwdurl` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'pwdask')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `pwdask` text;");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'pwdstatus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `pwdstatus` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'pwdtimes')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `pwdtimes` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'pwdfull')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `pwdfull` text;");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'pwdwords')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `pwdwords` text;");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'pwdopen')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `pwdopen` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'pwdown')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `pwdown` text;");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'pwdexit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `pwdexit` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'pwdexitstr')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `pwdexitstr` text;");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'limitgoodtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `limitgoodtype` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'limitgoodcatetype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `limitgoodcatetype` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'limitgoodcateids')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `limitgoodcateids` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'limitgoodids')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `limitgoodids` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'islimitlevel')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `islimitlevel` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'limitmemberlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `limitmemberlevels` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'limitagentlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `limitagentlevels` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'limitpartnerlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `limitpartnerlevels` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'limitaagentlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `limitaagentlevels` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'tagtitle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `tagtitle` varchar(20) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'settitlecolor')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `settitlecolor` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'titlecolor')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `titlecolor` varchar(10) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon',  'limitdiscounttype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD `limitdiscounttype` tinyint(1) DEFAULT '1';");
}
if(!pdo_indexexists('ewei_shop_coupon',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_coupon',  'idx_coupontype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD KEY `idx_coupontype` (`coupontype`);");
}
if(!pdo_indexexists('ewei_shop_coupon',  'idx_timestart')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD KEY `idx_timestart` (`timestart`);");
}
if(!pdo_indexexists('ewei_shop_coupon',  'idx_timeend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD KEY `idx_timeend` (`timeend`);");
}
if(!pdo_indexexists('ewei_shop_coupon',  'idx_timelimit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD KEY `idx_timelimit` (`timelimit`);");
}
if(!pdo_indexexists('ewei_shop_coupon',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_coupon',  'idx_givetype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD KEY `idx_givetype` (`backtype`);");
}
if(!pdo_indexexists('ewei_shop_coupon',  'idx_catid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon')." ADD KEY `idx_catid` (`catid`);");
}
if(!pdo_fieldexists('ewei_shop_coupon_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_coupon_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_category')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_category')." ADD `name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_category')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_category',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_category')." ADD `status` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_category',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_category')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_coupon_category',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_category')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_coupon_category',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_category')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_indexexists('ewei_shop_coupon_category',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_category')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists('ewei_shop_coupon_data',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_coupon_data',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_data',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon_data',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD `couponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_data',  'gettype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD `gettype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_data',  'used')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD `used` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_data',  'usetime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD `usetime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_data',  'gettime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD `gettime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_data',  'senduid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD `senduid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_data',  'ordersn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD `ordersn` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon_data',  'back')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD `back` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_data',  'backtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD `backtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_data',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_data',  'isnew')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD `isnew` tinyint(1) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_coupon_data',  'nocount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD `nocount` tinyint(1) DEFAULT '1';");
}
if(!pdo_indexexists('ewei_shop_coupon_data',  'idx_couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD KEY `idx_couponid` (`couponid`);");
}
if(!pdo_indexexists('ewei_shop_coupon_data',  'idx_gettype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_data')." ADD KEY `idx_gettype` (`gettype`);");
}
if(!pdo_fieldexists('ewei_shop_coupon_goodsendtask',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_goodsendtask')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_coupon_goodsendtask',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_goodsendtask')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_coupon_goodsendtask',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_goodsendtask')." ADD `goodsid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_goodsendtask',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_goodsendtask')." ADD `couponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_goodsendtask',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_goodsendtask')." ADD `starttime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_goodsendtask',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_goodsendtask')." ADD `endtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_goodsendtask',  'sendnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_goodsendtask')." ADD `sendnum` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_coupon_goodsendtask',  'num')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_goodsendtask')." ADD `num` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_goodsendtask',  'sendpoint')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_goodsendtask')." ADD `sendpoint` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_goodsendtask',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_goodsendtask')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_guess',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_guess')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_coupon_guess',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_guess')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_guess',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_guess')." ADD `couponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_guess',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_guess')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon_guess',  'times')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_guess')." ADD `times` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_guess',  'pwdkey')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_guess')." ADD `pwdkey` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon_guess',  'ok')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_guess')." ADD `ok` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_guess',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_guess')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_coupon_guess',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_guess')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_coupon_guess',  'idx_couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_guess')." ADD KEY `idx_couponid` (`couponid`);");
}
if(!pdo_fieldexists('ewei_shop_coupon_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_coupon_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_log',  'logno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD `logno` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon_log',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_coupon_log',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD `couponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD `status` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_log',  'paystatus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD `paystatus` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_log',  'creditstatus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD `creditstatus` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_log',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_log',  'paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD `paytype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_log',  'getfrom')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD `getfrom` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_log',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_coupon_log',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_coupon_log',  'idx_couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD KEY `idx_couponid` (`couponid`);");
}
if(!pdo_indexexists('ewei_shop_coupon_log',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_coupon_log',  'idx_paystatus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD KEY `idx_paystatus` (`paystatus`);");
}
if(!pdo_indexexists('ewei_shop_coupon_log',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_coupon_log',  'idx_getfrom')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_log')." ADD KEY `idx_getfrom` (`getfrom`);");
}
if(!pdo_fieldexists('ewei_shop_coupon_sendshow',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_sendshow')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_coupon_sendshow',  'showkey')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_sendshow')." ADD `showkey` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_coupon_sendshow',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_sendshow')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_coupon_sendshow',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_sendshow')." ADD `openid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_coupon_sendshow',  'coupondataid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_sendshow')." ADD `coupondataid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_coupon_sendtasks',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_sendtasks')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_coupon_sendtasks',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_sendtasks')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_coupon_sendtasks',  'enough')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_sendtasks')." ADD `enough` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_coupon_sendtasks',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_sendtasks')." ADD `couponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_sendtasks',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_sendtasks')." ADD `starttime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_sendtasks',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_sendtasks')." ADD `endtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_sendtasks',  'sendnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_sendtasks')." ADD `sendnum` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_coupon_sendtasks',  'num')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_sendtasks')." ADD `num` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_sendtasks',  'sendpoint')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_sendtasks')." ADD `sendpoint` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_sendtasks',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_sendtasks')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_taskdata',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_taskdata')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_coupon_taskdata',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_taskdata')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_coupon_taskdata',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_taskdata')." ADD `openid` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_coupon_taskdata',  'taskid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_taskdata')." ADD `taskid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_taskdata',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_taskdata')." ADD `couponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_taskdata',  'sendnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_taskdata')." ADD `sendnum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_taskdata',  'tasktype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_taskdata')." ADD `tasktype` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_taskdata',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_taskdata')." ADD `orderid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_taskdata',  'parentorderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_taskdata')." ADD `parentorderid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_taskdata',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_taskdata')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_taskdata',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_taskdata')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_coupon_taskdata',  'sendpoint')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_coupon_taskdata')." ADD `sendpoint` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_adv',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_adv')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_adv',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_adv')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_adv',  'advname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_adv')." ADD `advname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_adv',  'link')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_adv')." ADD `link` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_adv',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_adv')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_adv',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_adv')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_adv',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_adv')." ADD `enabled` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_adv',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_adv')." ADD `merchid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_creditshop_adv',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_adv')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_adv',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_adv')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_adv',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_adv')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_fieldexists('ewei_shop_creditshop_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_category')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_category')." ADD `name` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_category',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_category')." ADD `thumb` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_category')." ADD `displayorder` tinyint(3) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_category',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_category')." ADD `enabled` tinyint(1) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_category',  'advimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_category')." ADD `advimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_category',  'advurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_category')." ADD `advurl` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_category',  'isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_category')." ADD `isrecommand` tinyint(3) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_creditshop_category',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_category')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_category',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_category')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_category',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_category')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'logid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `logid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'logno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `logno` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `goodsid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `openid` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `nickname` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'headimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `headimg` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'level')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `level` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `content` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'images')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `images` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `time` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'reply_content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `reply_content` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'reply_images')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `reply_images` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'reply_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `reply_time` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'append_content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `append_content` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'append_images')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `append_images` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'append_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `append_time` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'append_reply_content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `append_reply_content` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'append_reply_images')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `append_reply_images` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'append_reply_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `append_reply_time` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'istop')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `istop` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'checked')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `checked` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'append_checked')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `append_checked` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'virtual')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `virtual` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `deleted` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_comment',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_comment')." ADD `merchid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'cate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `cate` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `type` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `credit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'money')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `money` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'total')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'totalday')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `totalday` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'chance')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `chance` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'chanceday')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `chanceday` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'detail')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `detail` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'rate1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `rate1` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'rate2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `rate2` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `endtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'joins')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `joins` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'views')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `views` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `deleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'showlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `showlevels` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'buylevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `buylevels` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'showgroups')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `showgroups` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'buygroups')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `buygroups` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'vip')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `vip` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'istop')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `istop` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `isrecommand` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'istime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `istime` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'timestart')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `timestart` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'timeend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `timeend` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'share_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `share_title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'share_icon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `share_icon` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'share_desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `share_desc` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'followneed')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `followneed` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'followtext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `followtext` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'subtitle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `subtitle` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'subdetail')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `subdetail` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'noticedetail')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `noticedetail` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'usedetail')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `usedetail` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'goodsdetail')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `goodsdetail` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'isendtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `isendtime` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'usecredit2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `usecredit2` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'area')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `area` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'dispatch')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `dispatch` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'storeids')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `storeids` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'noticeopenid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `noticeopenid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'noticetype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `noticetype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'isverify')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `isverify` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'goodstype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `goodstype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `couponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `goodsid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `merchid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'productprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `productprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'mincredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `mincredit` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'minmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `minmoney` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'maxcredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `maxcredit` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'dispatchtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `dispatchtype` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'dispatchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `dispatchid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'verifytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `verifytype` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'verifynum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `verifynum` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'grant1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `grant1` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'grant2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `grant2` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'goodssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `goodssn` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'productsn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `productsn` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'weight')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `weight` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'showtotal')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `showtotal` tinyint(3) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'totalcnf')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `totalcnf` tinyint(3) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'usetime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `usetime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'hasoption')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `hasoption` tinyint(3) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'noticedetailshow')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `noticedetailshow` tinyint(3) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'detailshow')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `detailshow` tinyint(3) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'packetmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `packetmoney` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'surplusmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `surplusmoney` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'packetlimit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `packetlimit` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'packettype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `packettype` tinyint(3) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'minpacketmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `minpacketmoney` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'packettotal')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `packettotal` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'packetsurplus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `packetsurplus` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_goods',  'maxmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD `maxmoney` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_indexexists('ewei_shop_creditshop_goods',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_goods',  'idx_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD KEY `idx_type` (`type`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_goods',  'idx_endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD KEY `idx_endtime` (`endtime`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_goods',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_goods',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_goods',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_goods',  'idx_deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD KEY `idx_deleted` (`deleted`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_goods',  'idx_istop')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD KEY `idx_istop` (`istop`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_goods',  'idx_isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD KEY `idx_isrecommand` (`isrecommand`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_goods',  'idx_istime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD KEY `idx_istime` (`istime`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_goods',  'idx_timestart')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD KEY `idx_timestart` (`timestart`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_goods',  'idx_timeend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD KEY `idx_timeend` (`timeend`);");
}
if(!pdo_indexexists('ewei_shop_creditshop_goods',  'idx_goodstype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_goods')." ADD KEY `idx_goodstype` (`goodstype`);");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'logno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `logno` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'eno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `eno` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `goodsid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'paystatus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `paystatus` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `paytype` tinyint(3) DEFAULT '-1';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'dispatchstatus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `dispatchstatus` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'creditpay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `creditpay` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'addressid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `addressid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'dispatchno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `dispatchno` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'usetime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `usetime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'express')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `express` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'expresssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `expresssn` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'expresscom')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `expresscom` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'verifyopenid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `verifyopenid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'transid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `transid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'dispatchtransid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `dispatchtransid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'storeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `storeid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `realname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `mobile` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `couponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'dupdate1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `dupdate1` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'address')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `address` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'optionid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `optionid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'time_send')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `time_send` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'time_finish')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `time_finish` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'iscomment')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `iscomment` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'dispatchtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `dispatchtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'verifynum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `verifynum` int(11) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'verifytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `verifytime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_log',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_log')." ADD `merchid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `goodsid` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `title` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `thumb` varchar(60) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `credit` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'money')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `money` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'total')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'weight')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `weight` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'specs')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `specs` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'skuId')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `skuId` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'goodssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `goodssn` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'productsn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `productsn` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'virtual')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `virtual` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_option',  'exchange_stock')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_option')." ADD `exchange_stock` int(11) NOT NULL DEFAULT '-1';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec')." ADD `goodsid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec')." ADD `title` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec',  'description')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec')." ADD `description` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec',  'displaytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec')." ADD `displaytype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec')." ADD `content` text;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec',  'propId')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec')." ADD `propId` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec_item',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec_item')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec_item',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec_item')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec_item',  'specid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec_item')." ADD `specid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec_item',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec_item')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec_item',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec_item')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec_item',  'show')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec_item')." ADD `show` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec_item',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec_item')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec_item',  'valueId')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec_item')." ADD `valueId` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_spec_item',  'virtual')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_spec_item')." ADD `virtual` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_verify',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_verify')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_verify',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_verify')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_verify',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_verify')." ADD `openid` varchar(45) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_verify',  'logid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_verify')." ADD `logid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_verify',  'verifycode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_verify')." ADD `verifycode` varchar(45) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_creditshop_verify',  'storeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_verify')." ADD `storeid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_verify',  'verifier')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_verify')." ADD `verifier` varchar(45) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_verify',  'isverify')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_verify')." ADD `isverify` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_verify',  'verifytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_verify')." ADD `verifytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_creditshop_verify',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_creditshop_verify')." ADD `merchid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_customer',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_customer',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_customer',  'kf_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer')." ADD `kf_id` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_customer',  'kf_account')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer')." ADD `kf_account` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_customer',  'kf_nick')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer')." ADD `kf_nick` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_customer',  'kf_pwd')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer')." ADD `kf_pwd` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_customer',  'kf_headimgurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer')." ADD `kf_headimgurl` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_customer',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_customer',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_customer',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_fieldexists('ewei_shop_customer_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_customer_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_category')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_customer_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_category')." ADD `name` varchar(50) DEFAULT NULL;");
}
if(!pdo_indexexists('ewei_shop_customer_category',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_category')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_customer_guestbook',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_guestbook')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_customer_guestbook',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_guestbook')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_customer_guestbook',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_guestbook')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_customer_guestbook',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_guestbook')." ADD `realname` varchar(11) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_customer_guestbook',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_guestbook')." ADD `mobile` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_customer_guestbook',  'weixin')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_guestbook')." ADD `weixin` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_customer_guestbook',  'images')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_guestbook')." ADD `images` text;");
}
if(!pdo_fieldexists('ewei_shop_customer_guestbook',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_guestbook')." ADD `content` text;");
}
if(!pdo_fieldexists('ewei_shop_customer_guestbook',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_guestbook')." ADD `remark` text;");
}
if(!pdo_fieldexists('ewei_shop_customer_guestbook',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_guestbook')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_customer_guestbook',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_guestbook')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_customer_guestbook',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_guestbook')." ADD `deleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_customer_robot',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_robot')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_customer_robot',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_robot')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_customer_robot',  'cate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_robot')." ADD `cate` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_customer_robot',  'keywords')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_robot')." ADD `keywords` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_customer_robot',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_robot')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_customer_robot',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_robot')." ADD `content` longtext;");
}
if(!pdo_fieldexists('ewei_shop_customer_robot',  'url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_robot')." ADD `url` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_customer_robot',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_robot')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_customer_robot',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_robot')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_customer_robot',  'idx_cate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_customer_robot')." ADD KEY `idx_cate` (`cate`);");
}
if(!pdo_fieldexists('ewei_shop_designer',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_designer',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_designer',  'pagename')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer')." ADD `pagename` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_designer',  'pagetype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer')." ADD `pagetype` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_designer',  'pageinfo')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer')." ADD `pageinfo` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_designer',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer')." ADD `createtime` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_designer',  'keyword')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer')." ADD `keyword` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_designer',  'savetime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer')." ADD `savetime` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_designer',  'setdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer')." ADD `setdefault` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_designer',  'datas')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer')." ADD `datas` text NOT NULL;");
}
if(!pdo_indexexists('ewei_shop_designer',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_designer',  'idx_pagetype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer')." ADD KEY `idx_pagetype` (`pagetype`);");
}
if(!pdo_fieldexists('ewei_shop_designer_menu',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer_menu')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_designer_menu',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer_menu')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_designer_menu',  'menuname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer_menu')." ADD `menuname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_designer_menu',  'isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer_menu')." ADD `isdefault` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_designer_menu',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer_menu')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_designer_menu',  'menus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer_menu')." ADD `menus` text;");
}
if(!pdo_fieldexists('ewei_shop_designer_menu',  'params')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer_menu')." ADD `params` text;");
}
if(!pdo_indexexists('ewei_shop_designer_menu',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer_menu')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_designer_menu',  'idx_isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer_menu')." ADD KEY `idx_isdefault` (`isdefault`);");
}
if(!pdo_indexexists('ewei_shop_designer_menu',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_designer_menu')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'dispatchname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `dispatchname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'dispatchtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `dispatchtype` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'firstprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `firstprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'secondprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `secondprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'firstweight')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `firstweight` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'secondweight')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `secondweight` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'express')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `express` varchar(250) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'areas')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `areas` text;");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'carriers')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `carriers` text;");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `enabled` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'calculatetype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `calculatetype` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'firstnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `firstnum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'secondnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `secondnum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'firstnumprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `firstnumprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'secondnumprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `secondnumprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `isdefault` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'shopid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `shopid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'nodispatchareas')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `nodispatchareas` text;");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'nodispatchareas_code')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `nodispatchareas_code` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_dispatch',  'isdispatcharea')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD `isdispatcharea` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_dispatch',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_dispatch',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_fieldexists('ewei_shop_diyform_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_diyform_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_category')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diyform_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_category')." ADD `name` varchar(50) DEFAULT NULL;");
}
if(!pdo_indexexists('ewei_shop_diyform_category',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_category')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_diyform_data',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_data')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_diyform_data',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_data')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diyform_data',  'typeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_data')." ADD `typeid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diyform_data',  'cid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_data')." ADD `cid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diyform_data',  'diyformfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_data')." ADD `diyformfields` text;");
}
if(!pdo_fieldexists('ewei_shop_diyform_data',  'fields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_data')." ADD `fields` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_diyform_data',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_data')." ADD `openid` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_diyform_data',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_data')." ADD `type` tinyint(2) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_diyform_data',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_data')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_diyform_data',  'idx_typeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_data')." ADD KEY `idx_typeid` (`typeid`);");
}
if(!pdo_indexexists('ewei_shop_diyform_data',  'idx_cid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_data')." ADD KEY `idx_cid` (`cid`);");
}
if(!pdo_fieldexists('ewei_shop_diyform_temp',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_temp')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_diyform_temp',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_temp')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diyform_temp',  'typeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_temp')." ADD `typeid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diyform_temp',  'cid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_temp')." ADD `cid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diyform_temp',  'diyformfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_temp')." ADD `diyformfields` text;");
}
if(!pdo_fieldexists('ewei_shop_diyform_temp',  'fields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_temp')." ADD `fields` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_diyform_temp',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_temp')." ADD `openid` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_diyform_temp',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_temp')." ADD `type` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diyform_temp',  'diyformid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_temp')." ADD `diyformid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diyform_temp',  'diyformdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_temp')." ADD `diyformdata` text;");
}
if(!pdo_fieldexists('ewei_shop_diyform_temp',  'carrier_realname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_temp')." ADD `carrier_realname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_diyform_temp',  'carrier_mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_temp')." ADD `carrier_mobile` varchar(255) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_diyform_temp',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_temp')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_diyform_temp',  'idx_cid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_temp')." ADD KEY `idx_cid` (`cid`);");
}
if(!pdo_fieldexists('ewei_shop_diyform_type',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_type')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_diyform_type',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_type')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diyform_type',  'cate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_type')." ADD `cate` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diyform_type',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_type')." ADD `title` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_diyform_type',  'fields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_type')." ADD `fields` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_diyform_type',  'usedata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_type')." ADD `usedata` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diyform_type',  'alldata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_type')." ADD `alldata` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diyform_type',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_type')." ADD `status` tinyint(1) DEFAULT '1';");
}
if(!pdo_indexexists('ewei_shop_diyform_type',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_type')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_diyform_type',  'idx_cate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diyform_type')." ADD KEY `idx_cate` (`cate`);");
}
if(!pdo_fieldexists('ewei_shop_diypage',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_diypage',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diypage',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage')." ADD `type` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diypage',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage')." ADD `name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_diypage',  'data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage')." ADD `data` longtext NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_diypage',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage')." ADD `createtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diypage',  'lastedittime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage')." ADD `lastedittime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diypage',  'keyword')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage')." ADD `keyword` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_diypage',  'diymenu')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage')." ADD `diymenu` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diypage',  'merch')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage')." ADD `merch` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_diypage',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_diypage',  'idx_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage')." ADD KEY `idx_type` (`type`);");
}
if(!pdo_indexexists('ewei_shop_diypage',  'idx_keyword')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage')." ADD KEY `idx_keyword` (`keyword`);");
}
if(!pdo_indexexists('ewei_shop_diypage',  'idx_lastedittime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage')." ADD KEY `idx_lastedittime` (`lastedittime`);");
}
if(!pdo_indexexists('ewei_shop_diypage',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_fieldexists('ewei_shop_diypage_menu',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_menu')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_diypage_menu',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_menu')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diypage_menu',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_menu')." ADD `name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_diypage_menu',  'data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_menu')." ADD `data` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_diypage_menu',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_menu')." ADD `createtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diypage_menu',  'lastedittime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_menu')." ADD `lastedittime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diypage_menu',  'merch')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_menu')." ADD `merch` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_diypage_menu',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_menu')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_diypage_menu',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_menu')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_diypage_menu',  'idx_lastedittime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_menu')." ADD KEY `idx_lastedittime` (`lastedittime`);");
}
if(!pdo_fieldexists('ewei_shop_diypage_template',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_diypage_template',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diypage_template',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template')." ADD `type` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diypage_template',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template')." ADD `name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_diypage_template',  'data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template')." ADD `data` longtext NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_diypage_template',  'preview')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template')." ADD `preview` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_diypage_template',  'tplid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template')." ADD `tplid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diypage_template',  'cate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template')." ADD `cate` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diypage_template',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template')." ADD `deleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diypage_template',  'merch')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template')." ADD `merch` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_diypage_template',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_diypage_template',  'idx_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template')." ADD KEY `idx_type` (`type`);");
}
if(!pdo_indexexists('ewei_shop_diypage_template',  'idx_cate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template')." ADD KEY `idx_cate` (`cate`);");
}
if(!pdo_fieldexists('ewei_shop_diypage_template_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_diypage_template_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template_category')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_diypage_template_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template_category')." ADD `name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_diypage_template_category',  'merch')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template_category')." ADD `merch` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_diypage_template_category',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_diypage_template_category')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_exchange_cart',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_cart')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_exchange_cart',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_cart')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_cart',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_cart')." ADD `openid` varchar(100) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_cart',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_cart')." ADD `goodsid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_cart',  'total')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_cart')." ADD `total` int(10) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_exchange_cart',  'marketprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_cart')." ADD `marketprice` decimal(10,2) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_cart',  'optionid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_cart')." ADD `optionid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_cart',  'selected')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_cart')." ADD `selected` tinyint(1) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_exchange_cart',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_cart')." ADD `deleted` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_cart',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_cart')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_cart',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_cart')." ADD `title` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_cart',  'groupid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_cart')." ADD `groupid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_cart',  'serial')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_cart')." ADD `serial` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'groupid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `groupid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `endtime` datetime NOT NULL DEFAULT '2016-10-01 00:00:00';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `status` int(2) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `openid` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'count')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `count` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'key')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `key` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `type` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'scene')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `scene` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'qrcode_url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `qrcode_url` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'serial')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `serial` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'balancestatus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `balancestatus` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'redstatus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `redstatus` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'scorestatus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `scorestatus` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'couponstatus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `couponstatus` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_exchange_code',  'goodsstatus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_code')." ADD `goodsstatus` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `title` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `type` int(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `endtime` datetime NOT NULL DEFAULT '2016-10-01 00:00:00';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'mode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `mode` int(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `status` int(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'max')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `max` int(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'value')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `value` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `starttime` datetime NOT NULL DEFAULT '2016-10-01 00:00:00';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'goods')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `goods` text;");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'score')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `score` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'coupon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `coupon` text;");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'use')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `use` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'total')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `total` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'red')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `red` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'balance')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `balance` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'balance_left')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `balance_left` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'balance_right')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `balance_right` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'red_left')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `red_left` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'red_right')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `red_right` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'score_left')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `score_left` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'score_right')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `score_right` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'balance_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `balance_type` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'red_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `red_type` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'score_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `score_type` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'title_reply')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `title_reply` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'img')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `img` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `content` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'rule')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `rule` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'coupon_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `coupon_type` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'basic_content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `basic_content` varchar(500) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'reply_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `reply_type` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'code_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `code_type` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'binding')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `binding` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'showcount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `showcount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'postage')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `postage` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'postage_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `postage_type` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'banner')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `banner` varchar(800) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'keyword_reply')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `keyword_reply` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'reply_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `reply_status` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'reply_keyword')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `reply_keyword` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'input_banner')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `input_banner` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'diypage')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `diypage` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'sendname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `sendname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'wishing')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `wishing` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'actname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `actname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_group',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_group')." ADD `remark` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_query',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_query')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_exchange_query',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_query')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_query',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_query')." ADD `openid` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_query',  'querykey')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_query')." ADD `querykey` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_query',  'querytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_query')." ADD `querytime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_query',  'unfreeze')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_query')." ADD `unfreeze` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_query',  'errorcount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_query')." ADD `errorcount` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'key')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `key` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'goods')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `goods` text;");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `orderid` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `time` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `openid` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'mode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `mode` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'balance')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `balance` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'red')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `red` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'coupon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `coupon` text;");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'score')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `score` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `nickname` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'groupid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `groupid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `title` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'serial')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `serial` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'ordersn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `ordersn` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exchange_record',  'goods_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_record')." ADD `goods_title` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exchange_setting',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_setting')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_exchange_setting',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_setting')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_setting',  'freeze')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_setting')." ADD `freeze` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_setting',  'mistake')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_setting')." ADD `mistake` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_setting',  'grouplimit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_setting')." ADD `grouplimit` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exchange_setting',  'alllimit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exchange_setting')." ADD `alllimit` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_express',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_express')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_exhelper_express',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_express')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_express',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_express')." ADD `type` int(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_express',  'expressname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_express')." ADD `expressname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_express',  'expresscom')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_express')." ADD `expresscom` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_express',  'express')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_express')." ADD `express` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_express',  'width')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_express')." ADD `width` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_express',  'datas')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_express')." ADD `datas` text;");
}
if(!pdo_fieldexists('ewei_shop_exhelper_express',  'height')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_express')." ADD `height` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_express',  'bg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_express')." ADD `bg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_express',  'isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_express')." ADD `isdefault` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_express',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_express')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_exhelper_express',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_express')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_exhelper_express',  'idx_isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_express')." ADD KEY `idx_isdefault` (`isdefault`);");
}
if(!pdo_fieldexists('ewei_shop_exhelper_senduser',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_senduser')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_exhelper_senduser',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_senduser')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_senduser',  'sendername')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_senduser')." ADD `sendername` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_senduser',  'sendertel')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_senduser')." ADD `sendertel` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_senduser',  'sendersign')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_senduser')." ADD `sendersign` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_senduser',  'sendercode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_senduser')." ADD `sendercode` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exhelper_senduser',  'senderaddress')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_senduser')." ADD `senderaddress` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_senduser',  'sendercity')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_senduser')." ADD `sendercity` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_exhelper_senduser',  'isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_senduser')." ADD `isdefault` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_senduser',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_senduser')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_exhelper_senduser',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_senduser')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_exhelper_senduser',  'idx_isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_senduser')." ADD KEY `idx_isdefault` (`isdefault`);");
}
if(!pdo_fieldexists('ewei_shop_exhelper_sys',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_sys')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_exhelper_sys',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_sys')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_sys',  'ip')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_sys')." ADD `ip` varchar(20) NOT NULL DEFAULT 'localhost';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_sys',  'ip_cloud')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_sys')." ADD `ip_cloud` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_sys',  'port')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_sys')." ADD `port` int(11) NOT NULL DEFAULT '8000';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_sys',  'port_cloud')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_sys')." ADD `port_cloud` int(11) NOT NULL DEFAULT '8000';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_sys',  'is_cloud')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_sys')." ADD `is_cloud` int(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_exhelper_sys',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_exhelper_sys')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_express',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_express')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_express',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_express')." ADD `name` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_express',  'express')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_express')." ADD `express` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_express',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_express')." ADD `status` tinyint(1) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_express',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_express')." ADD `displayorder` tinyint(3) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_express_cache',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_express_cache')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_express_cache',  'expresssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_express_cache')." ADD `expresssn` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_express_cache',  'express')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_express_cache')." ADD `express` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_express_cache',  'lasttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_express_cache')." ADD `lasttime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_express_cache',  'datas')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_express_cache')." ADD `datas` text;");
}
if(!pdo_indexexists('ewei_shop_express_cache',  'idx_expresssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_express_cache')." ADD KEY `idx_expresssn` (`expresssn`);");
}
if(!pdo_indexexists('ewei_shop_express_cache',  'idx_express')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_express_cache')." ADD KEY `idx_express` (`express`);");
}
if(!pdo_fieldexists('ewei_shop_feedback',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_feedback')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_feedback',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_feedback')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_feedback',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_feedback')." ADD `openid` varchar(50) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_feedback',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_feedback')." ADD `type` tinyint(1) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_feedback',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_feedback')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_feedback',  'feedbackid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_feedback')." ADD `feedbackid` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_feedback',  'transid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_feedback')." ADD `transid` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_feedback',  'reason')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_feedback')." ADD `reason` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_feedback',  'solution')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_feedback')." ADD `solution` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_feedback',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_feedback')." ADD `remark` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_feedback',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_feedback')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_feedback',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_feedback')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_feedback',  'idx_feedbackid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_feedback')." ADD KEY `idx_feedbackid` (`feedbackid`);");
}
if(!pdo_indexexists('ewei_shop_feedback',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_feedback')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_feedback',  'idx_transid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_feedback')." ADD KEY `idx_transid` (`transid`);");
}
if(!pdo_fieldexists('ewei_shop_form',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_form')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_form',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_form')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_form',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_form')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_form',  'isrequire')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_form')." ADD `isrequire` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_form',  'key')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_form')." ADD `key` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_form',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_form')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_form',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_form')." ADD `type` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_form',  'values')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_form')." ADD `values` text;");
}
if(!pdo_fieldexists('ewei_shop_form',  'cate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_form')." ADD `cate` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_form_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_form_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_form_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_form_category')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_form_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_form_category')." ADD `name` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_funbar',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_funbar')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_funbar',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_funbar')." ADD `uid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_funbar',  'datas')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_funbar')." ADD `datas` text;");
}
if(!pdo_fieldexists('ewei_shop_funbar',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_funbar')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_gift',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_gift')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_gift',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_gift')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_gift',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_gift')." ADD `title` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_gift',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_gift')." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_gift',  'activity')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_gift')." ADD `activity` tinyint(3) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_gift',  'orderprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_gift')." ADD `orderprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_gift',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_gift')." ADD `goodsid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_gift',  'giftgoodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_gift')." ADD `giftgoodsid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_gift',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_gift')." ADD `starttime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_gift',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_gift')." ADD `endtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_gift',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_gift')." ADD `status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_gift',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_gift')." ADD `displayorder` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_gift',  'share_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_gift')." ADD `share_title` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_gift',  'share_icon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_gift')." ADD `share_icon` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_gift',  'share_desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_gift')." ADD `share_desc` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'billno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `billno` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `paytype` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'year')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `year` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'month')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `month` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'week')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `week` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'ordercount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `ordercount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'ordermoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `ordermoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'bonusmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `bonusmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'bonusmoney_send')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `bonusmoney_send` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'bonusmoney_pay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `bonusmoney_pay` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `paytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'partnercount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `partnercount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `starttime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `endtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'confirmtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `confirmtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'bonusordermoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `bonusordermoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_globonus_bill',  'bonusrate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD `bonusrate` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_indexexists('ewei_shop_globonus_bill',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_globonus_bill',  'idx_paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD KEY `idx_paytype` (`paytype`);");
}
if(!pdo_indexexists('ewei_shop_globonus_bill',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_globonus_bill',  'idx_paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD KEY `idx_paytime` (`paytime`);");
}
if(!pdo_indexexists('ewei_shop_globonus_bill',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_globonus_bill',  'idx_month')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD KEY `idx_month` (`month`);");
}
if(!pdo_indexexists('ewei_shop_globonus_bill',  'idx_week')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD KEY `idx_week` (`week`);");
}
if(!pdo_indexexists('ewei_shop_globonus_bill',  'idx_year')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_bill')." ADD KEY `idx_year` (`year`);");
}
if(!pdo_fieldexists('ewei_shop_globonus_billo',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billo')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_globonus_billo',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billo')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billo',  'billid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billo')." ADD `billid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billo',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billo')." ADD `orderid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billo',  'ordermoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billo')." ADD `ordermoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_indexexists('ewei_shop_globonus_billo',  'idx_billid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billo')." ADD KEY `idx_billid` (`billid`);");
}
if(!pdo_indexexists('ewei_shop_globonus_billo',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billo')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_globonus_billp',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_globonus_billp',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billp',  'billid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD `billid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billp',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billp',  'payno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD `payno` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billp',  'paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD `paytype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billp',  'bonus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD `bonus` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billp',  'money')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD `money` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billp',  'realmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD `realmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billp',  'paymoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD `paymoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billp',  'charge')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD `charge` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billp',  'chargemoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD `chargemoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billp',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billp',  'reason')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD `reason` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_globonus_billp',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD `paytime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_globonus_billp',  'idx_billid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD KEY `idx_billid` (`billid`);");
}
if(!pdo_indexexists('ewei_shop_globonus_billp',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_billp')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_globonus_level',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_level')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_globonus_level',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_level')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_globonus_level',  'levelname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_level')." ADD `levelname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_globonus_level',  'bonus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_level')." ADD `bonus` decimal(10,4) DEFAULT '0.0000';");
}
if(!pdo_fieldexists('ewei_shop_globonus_level',  'ordermoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_level')." ADD `ordermoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_globonus_level',  'ordercount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_level')." ADD `ordercount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_globonus_level',  'commissionmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_level')." ADD `commissionmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_globonus_level',  'bonusmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_level')." ADD `bonusmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_globonus_level',  'downcount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_level')." ADD `downcount` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_globonus_level',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_globonus_level')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_goods',  'allcates')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `allcates` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'artid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `artid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'autoreceive')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `autoreceive` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'bargain')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `bargain` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'buyagain_commission')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `buyagain_commission` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'buyagain_condition')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `buyagain_condition` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'buyagain_islong')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `buyagain_islong` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'buyagain_sale')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `buyagain_sale` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'buyagain')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `buyagain` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'buycontent')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `buycontent` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'buygroups')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `buygroups` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'buylevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `buylevels` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'buyshow')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `buyshow` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'cannotrefund')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `cannotrefund` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'cash')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `cash` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'cashier')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `cashier` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'catch_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `catch_id` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'catch_source')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `catch_source` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'catch_url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `catch_url` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'cates')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `cates` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'catesinit3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `catesinit3` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'ccate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `ccate` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'ccates')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `ccates` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'checked')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `checked` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'city')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `city` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'commission_thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `commission_thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'commission')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `commission` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'commission1_pay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `commission1_pay` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'commission1_rate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `commission1_rate` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'commission2_pay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `commission2_pay` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'commission2_rate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `commission2_rate` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'commission3_pay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `commission3_pay` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'commission3_rate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `commission3_rate` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `content` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'costprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `costprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `credit` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'deduct')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `deduct` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'deduct2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `deduct2` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `deleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'description')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `description` varchar(1000) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'detail_btntext1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `detail_btntext1` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'detail_btntext2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `detail_btntext2` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'detail_btnurl1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `detail_btnurl1` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'detail_btnurl2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `detail_btnurl2` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'detail_logo')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `detail_logo` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'detail_shopname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `detail_shopname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'detail_totaltitle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `detail_totaltitle` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'discounts')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `discounts` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'dispatch')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `dispatch` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'dispatchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `dispatchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'dispatchprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `dispatchprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'dispatchtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `dispatchtype` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'diyfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `diyfields` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'diyformid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `diyformid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'diyformtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `diyformtype` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'diymode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `diymode` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'diypage')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `diypage` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'diysave')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `diysave` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'diysaveid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `diysaveid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'edareas_code')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `edareas_code` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'edareas')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `edareas` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'edmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `edmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'ednum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `ednum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `endtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'exchange_postage')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `exchange_postage` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'exchange_stock')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `exchange_stock` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'followtip')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `followtip` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'followurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `followurl` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'goodssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `goodssn` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'groupstype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `groupstype` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'hascommission')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `hascommission` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'hasoption')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `hasoption` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'hidecommission')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `hidecommission` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'invoice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `invoice` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'iscomment')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `iscomment` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'isdiscount_discounts')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `isdiscount_discounts` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'isdiscount_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `isdiscount_time` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'isdiscount_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `isdiscount_title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'isdiscount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `isdiscount` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'isendtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `isendtime` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'ishot')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `ishot` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'isnew')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `isnew` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'isnodiscount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `isnodiscount` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'ispresell')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `ispresell` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `isrecommand` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'issendfree')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `issendfree` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'istime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `istime` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'isverify')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `isverify` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'keywords')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `keywords` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'labelname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `labelname` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'manydeduct')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `manydeduct` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'marketprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `marketprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'maxbuy')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `maxbuy` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'maxprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `maxprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'merchdisplayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `merchdisplayorder` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'merchsale')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `merchsale` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'minbuy')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `minbuy` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'minprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `minprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'money')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `money` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'needfollow')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `needfollow` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'nocommission')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `nocommission` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'noticeopenid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `noticeopenid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'noticetype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `noticetype` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'originalprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `originalprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'pcate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `pcate` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'pcates')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `pcates` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'presellend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `presellend` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'presellover')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `presellover` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'presellovertime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `presellovertime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'presellprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `presellprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'presellsendstatrttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `presellsendstatrttime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'presellsendtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `presellsendtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'presellsendtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `presellsendtype` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'presellstart')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `presellstart` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'preselltimeend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `preselltimeend` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'preselltimestart')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `preselltimestart` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'productprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `productprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'productsn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `productsn` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'province')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `province` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'quality')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `quality` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'repair')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `repair` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'sales')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `sales` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'salesreal')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `salesreal` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'saleupdate30424')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `saleupdate30424` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'saleupdate37975')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `saleupdate37975` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'saleupdate51117')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `saleupdate51117` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'score')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `score` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'seven')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `seven` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'share_icon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `share_icon` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'share_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `share_title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'sharebtn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `sharebtn` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'shopid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `shopid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'shorttitle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `shorttitle` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'showgroups')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `showgroups` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'showlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `showlevels` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'showtotal')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `showtotal` tinyint(1) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'showtotaladd')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `showtotaladd` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'spec')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `spec` varchar(5000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `status` tinyint(1) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'storeids')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `storeids` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'subtitle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `subtitle` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'taobaoid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `taobaoid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'taobaourl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `taobaourl` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'taotaoid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `taotaoid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'tcate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `tcate` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'tcates')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `tcates` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'thumb_first')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `thumb_first` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'thumb_url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `thumb_url` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'timeend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `timeend` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'timestart')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `timestart` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `title` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'total')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `total` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'totalcnf')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `totalcnf` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `type` tinyint(1) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'unit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `unit` varchar(5) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'updatetime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `updatetime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'usermaxbuy')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `usermaxbuy` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'usetime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `usetime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'verifytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `verifytype` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'viewcount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `viewcount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'virtual')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `virtual` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'virtualsend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `virtualsend` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'virtualsendcontent')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `virtualsendcontent` text;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'weight')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `weight` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods',  'minpriceupdated')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `minpriceupdated` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'unite_total')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `unite_total` tinyint(3) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'buyagain_price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `buyagain_price` decimal(10,2) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_goods',  'threen')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD `threen` varchar(255) DEFAULT NULL;");
}
if(!pdo_indexexists('ewei_shop_goods',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_goods',  'idx_pcate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD KEY `idx_pcate` (`pcate`);");
}
if(!pdo_indexexists('ewei_shop_goods',  'idx_ccate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD KEY `idx_ccate` (`ccate`);");
}
if(!pdo_indexexists('ewei_shop_goods',  'idx_isnew')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD KEY `idx_isnew` (`isnew`);");
}
if(!pdo_indexexists('ewei_shop_goods',  'idx_ishot')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD KEY `idx_ishot` (`ishot`);");
}
if(!pdo_indexexists('ewei_shop_goods',  'idx_isdiscount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD KEY `idx_isdiscount` (`isdiscount`);");
}
if(!pdo_indexexists('ewei_shop_goods',  'idx_isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD KEY `idx_isrecommand` (`isrecommand`);");
}
if(!pdo_indexexists('ewei_shop_goods',  'idx_iscomment')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD KEY `idx_iscomment` (`iscomment`);");
}
if(!pdo_indexexists('ewei_shop_goods',  'idx_issendfree')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD KEY `idx_issendfree` (`issendfree`);");
}
if(!pdo_indexexists('ewei_shop_goods',  'idx_istime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD KEY `idx_istime` (`istime`);");
}
if(!pdo_indexexists('ewei_shop_goods',  'idx_deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD KEY `idx_deleted` (`deleted`);");
}
if(!pdo_indexexists('ewei_shop_goods',  'idx_scate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD KEY `idx_scate` (`tcate`);");
}
if(!pdo_indexexists('ewei_shop_goods',  'idx_merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD KEY `idx_merchid` (`merchid`);");
}
if(!pdo_indexexists('ewei_shop_goods',  'idx_checked')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD KEY `idx_checked` (`checked`);");
}
if(!pdo_indexexists('ewei_shop_goods',  'idx_productsn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD KEY `idx_productsn` (`productsn`);");
}
if(!pdo_fieldexists('ewei_shop_goods_comment',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_comment')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_goods_comment',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_comment')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_comment',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_comment')." ADD `goodsid` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_comment',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_comment')." ADD `openid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_comment',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_comment')." ADD `nickname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_comment',  'headimgurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_comment')." ADD `headimgurl` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_comment',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_comment')." ADD `content` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_comment',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_comment')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_goods_comment',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_comment')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_goods_comment',  'idx_goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_comment')." ADD KEY `idx_goodsid` (`goodsid`);");
}
if(!pdo_indexexists('ewei_shop_goods_comment',  'idx_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_comment')." ADD KEY `idx_openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_goods_comment',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_comment')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_fieldexists('ewei_shop_goods_group',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_group')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_goods_group',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_group')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_group',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_group')." ADD `name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_group',  'goodsids')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_group')." ADD `goodsids` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_group',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_group')." ADD `enabled` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_goods_group',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_group')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_goods_group',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_group')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_fieldexists('ewei_shop_goods_label',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_label')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_goods_label',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_label')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_label',  'label')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_label')." ADD `label` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_label',  'labelname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_label')." ADD `labelname` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_goods_label',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_label')." ADD `status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_label',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_label')." ADD `displayorder` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_labelstyle',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_labelstyle')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_goods_labelstyle',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_labelstyle')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_goods_labelstyle',  'style')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_labelstyle')." ADD `style` int(3) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `goodsid` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `title` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `thumb` varchar(60) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'productprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `productprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'marketprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `marketprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'costprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `costprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'stock')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `stock` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'weight')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `weight` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'specs')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `specs` text;");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'skuId')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `skuId` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'goodssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `goodssn` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'productsn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `productsn` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'virtual')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `virtual` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'exchange_stock')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `exchange_stock` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'exchange_postage')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `exchange_postage` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_goods_option',  'presellprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD `presellprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_indexexists('ewei_shop_goods_option',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_goods_option',  'idx_goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD KEY `idx_goodsid` (`goodsid`);");
}
if(!pdo_indexexists('ewei_shop_goods_option',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_indexexists('ewei_shop_goods_option',  'idx_productsn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_option')." ADD KEY `idx_productsn` (`productsn`);");
}
if(!pdo_fieldexists('ewei_shop_goods_param',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_param')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_goods_param',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_param')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_param',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_param')." ADD `goodsid` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_param',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_param')." ADD `title` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_param',  'value')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_param')." ADD `value` text;");
}
if(!pdo_fieldexists('ewei_shop_goods_param',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_param')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_goods_param',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_param')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_goods_param',  'idx_goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_param')." ADD KEY `idx_goodsid` (`goodsid`);");
}
if(!pdo_indexexists('ewei_shop_goods_param',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_param')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_fieldexists('ewei_shop_goods_spec',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_goods_spec',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_spec',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec')." ADD `goodsid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_spec',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec')." ADD `title` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_spec',  'description')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec')." ADD `description` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_spec',  'displaytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec')." ADD `displaytype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_spec',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec')." ADD `content` text;");
}
if(!pdo_fieldexists('ewei_shop_goods_spec',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_spec',  'propId')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec')." ADD `propId` varchar(255) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_goods_spec',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_goods_spec',  'idx_goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec')." ADD KEY `idx_goodsid` (`goodsid`);");
}
if(!pdo_indexexists('ewei_shop_goods_spec',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_fieldexists('ewei_shop_goods_spec_item',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec_item')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_goods_spec_item',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec_item')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_spec_item',  'specid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec_item')." ADD `specid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_spec_item',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec_item')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_spec_item',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec_item')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_spec_item',  'show')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec_item')." ADD `show` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_spec_item',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec_item')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_goods_spec_item',  'valueId')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec_item')." ADD `valueId` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_goods_spec_item',  'virtual')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec_item')." ADD `virtual` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_goods_spec_item',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec_item')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_goods_spec_item',  'idx_specid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec_item')." ADD KEY `idx_specid` (`specid`);");
}
if(!pdo_indexexists('ewei_shop_goods_spec_item',  'idx_show')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec_item')." ADD KEY `idx_show` (`show`);");
}
if(!pdo_indexexists('ewei_shop_goods_spec_item',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods_spec_item')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_fieldexists('ewei_shop_groups_adv',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_adv')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_groups_adv',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_adv')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_adv',  'advname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_adv')." ADD `advname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_groups_adv',  'link')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_adv')." ADD `link` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_groups_adv',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_adv')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_groups_adv',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_adv')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_adv',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_adv')." ADD `enabled` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_groups_adv',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_adv')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_groups_adv',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_adv')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_indexexists('ewei_shop_groups_adv',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_adv')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_fieldexists('ewei_shop_groups_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_groups_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_category')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_category')." ADD `name` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_category',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_category')." ADD `thumb` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_category')." ADD `displayorder` tinyint(3) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_category',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_category')." ADD `enabled` tinyint(1) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_groups_category',  'advimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_category')." ADD `advimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_groups_category',  'advurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_category')." ADD `advurl` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_groups_category',  'isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_category')." ADD `isrecommand` tinyint(3) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_groups_category',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_category')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_groups_category',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_category')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_indexexists('ewei_shop_groups_category',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_category')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `displayorder` int(11) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'goodssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `goodssn` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'productsn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `productsn` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `title` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'category')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `category` tinyint(3) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'showstock')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `showstock` tinyint(2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'stock')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `stock` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'groupsprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `groupsprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'goodsnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `goodsnum` int(11) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'purchaselimit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `purchaselimit` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'single')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `single` tinyint(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'singleprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `singleprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'units')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `units` varchar(255) NOT NULL DEFAULT '件';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'dispatchtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `dispatchtype` tinyint(2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'dispatchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `dispatchid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'freight')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `freight` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `endtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'groupnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `groupnum` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'sales')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `sales` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'description')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `description` varchar(1000) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `content` text;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `createtime` int(11) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'isindex')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `isindex` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `deleted` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `goodsid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'followneed')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `followneed` tinyint(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'followtext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `followtext` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'followurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `followurl` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'share_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `share_title` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'share_icon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `share_icon` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'share_desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `share_desc` varchar(500) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'deduct')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `deduct` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'thumb_url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `thumb_url` text;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'rights')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `rights` tinyint(2) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'gid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `gid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'discount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `discount` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'headstype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `headstype` tinyint(3) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'headsmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `headsmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'headsdiscount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `headsdiscount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'isdiscount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `isdiscount` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'isverify')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `isverify` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'verifytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `verifytype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'verifynum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `verifynum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'storeids')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `storeids` text;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'shorttitle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `shorttitle` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'teamnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `teamnum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_goods',  'ishot')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD `ishot` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_groups_goods',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_groups_goods',  'idx_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD KEY `idx_type` (`category`);");
}
if(!pdo_indexexists('ewei_shop_groups_goods',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_groups_goods',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists('ewei_shop_groups_goods_atlas',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods_atlas')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods_atlas',  'g_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods_atlas')." ADD `g_id` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_goods_atlas',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_goods_atlas')." ADD `thumb` varchar(145) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `openid` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'orderno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `orderno` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'groupnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `groupnum` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `paytime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `credit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'creditmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `creditmoney` decimal(11,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `price` decimal(11,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'freight')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `freight` decimal(11,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `status` int(9) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'pay_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `pay_type` varchar(45) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'dispatchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `dispatchid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'addressid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `addressid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'address')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `address` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'goodid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `goodid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'teamid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `teamid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'is_team')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `is_team` int(2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'heads')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `heads` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'discount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `discount` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `starttime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'canceltime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `canceltime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `endtime` int(45) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'finishtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `finishtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'refundid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `refundid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'refundstate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `refundstate` tinyint(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'refundtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `refundtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'express')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `express` varchar(45) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'expresscom')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `expresscom` varchar(100) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'expresssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `expresssn` varchar(45) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'sendtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `sendtime` int(45) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `remark` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'remarkclose')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `remarkclose` text;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'remarksend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `remarksend` text;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'message')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `message` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'success')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `success` int(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `deleted` int(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `realname` varchar(20) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `mobile` varchar(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'isverify')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `isverify` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'verifytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `verifytype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'verifycode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `verifycode` varchar(45) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'verifynum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `verifynum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'printstate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `printstate` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'printstate2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `printstate2` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'apppay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `apppay` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'delete')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `delete` int(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'isborrow')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `isborrow` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order',  'borrowopenid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order')." ADD `borrowopenid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `openid` varchar(45) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `orderid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'refundno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `refundno` varchar(45) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'refundstatus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `refundstatus` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'refundaddressid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `refundaddressid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'refundaddress')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `refundaddress` varchar(255) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `content` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'reason')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `reason` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'images')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `images` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'applytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `applytime` varchar(45) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'applycredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `applycredit` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'applyprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `applyprice` decimal(11,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'reply')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `reply` text;");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'refundtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `refundtype` varchar(45) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'rtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `rtype` int(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'refundtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `refundtime` varchar(45) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `endtime` varchar(45) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'message')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `message` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'operatetime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `operatetime` varchar(45) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'realcredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `realcredit` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'realmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `realmoney` decimal(11,2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'express')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `express` varchar(45) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'expresscom')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `expresscom` varchar(100) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'expresssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `expresssn` varchar(45) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'sendtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `sendtime` varchar(45) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'returntime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `returntime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'rexpress')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `rexpress` varchar(45) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'rexpresscom')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `rexpresscom` varchar(100) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_order_refund',  'rexpresssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_order_refund')." ADD `rexpresssn` varchar(45) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'plid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `plid` bigint(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `type` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'acid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `acid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `openid` varchar(40) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'tid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `tid` varchar(64) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `credit` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'creditmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `creditmoney` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'fee')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `fee` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `status` tinyint(4) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'module')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `module` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'tag')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `tag` varchar(2000) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'is_usecard')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `is_usecard` tinyint(3) unsigned NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'card_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `card_type` tinyint(3) unsigned NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'card_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `card_id` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'card_fee')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `card_fee` decimal(10,2) unsigned NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'encrypt_code')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `encrypt_code` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_paylog',  'uniontid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD `uniontid` varchar(50) NOT NULL;");
}
if(!pdo_indexexists('ewei_shop_groups_paylog',  'idx_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD KEY `idx_openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_groups_paylog',  'idx_tid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD KEY `idx_tid` (`tid`);");
}
if(!pdo_indexexists('ewei_shop_groups_paylog',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_groups_paylog',  'uniontid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_paylog')." ADD KEY `uniontid` (`uniontid`);");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `uniacid` varchar(45) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'groups')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `groups` int(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'followurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `followurl` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'followqrcode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `followqrcode` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'groupsurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `groupsurl` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'share_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `share_title` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'share_icon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `share_icon` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'share_desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `share_desc` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'share_url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `share_url` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'groups_description')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `groups_description` text;");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'description')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `description` int(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'creditdeduct')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `creditdeduct` tinyint(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'groupsdeduct')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `groupsdeduct` tinyint(2) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `credit` int(11) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'groupsmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `groupsmoney` decimal(11,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'refund')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `refund` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'refundday')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `refundday` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `goodsid` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'rules')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `rules` text;");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'receive')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `receive` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'discount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `discount` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'headstype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `headstype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'headsmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `headsmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_groups_set',  'headsdiscount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_set')." ADD `headsdiscount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_verify',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_verify')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_groups_verify',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_verify')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_verify',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_verify')." ADD `openid` varchar(45) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_verify',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_verify')." ADD `orderid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_verify',  'verifycode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_verify')." ADD `verifycode` varchar(45) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_groups_verify',  'storeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_verify')." ADD `storeid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_verify',  'verifier')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_verify')." ADD `verifier` varchar(45) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_verify',  'isverify')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_verify')." ADD `isverify` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_groups_verify',  'verifytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_groups_verify')." ADD `verifytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'lottery_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `lottery_id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'lottery_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `lottery_title` varchar(150) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'lottery_icon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `lottery_icon` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'lottery_banner')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `lottery_banner` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'lottery_cannot')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `lottery_cannot` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'lottery_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `lottery_type` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'is_delete')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `is_delete` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `addtime` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'lottery_data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `lottery_data` text;");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'is_goods')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `is_goods` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'lottery_days')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `lottery_days` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'task_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `task_type` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'task_data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `task_data` text;");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'start_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `start_time` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery',  'end_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery')." ADD `end_time` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery_default',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_default')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_lottery_default',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_default')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery_default',  'data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_default')." ADD `data` text;");
}
if(!pdo_fieldexists('ewei_shop_lottery_default',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_default')." ADD `addtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery_join',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_join')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_lottery_join',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_join')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery_join',  'join_user')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_join')." ADD `join_user` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery_join',  'lottery_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_join')." ADD `lottery_id` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery_join',  'lottery_num')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_join')." ADD `lottery_num` int(10) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery_join',  'lottery_tag')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_join')." ADD `lottery_tag` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery_join',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_join')." ADD `addtime` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery_log',  'log_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_log')." ADD `log_id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_lottery_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_log')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery_log',  'lottery_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_log')." ADD `lottery_id` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery_log',  'join_user')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_log')." ADD `join_user` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery_log',  'lottery_data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_log')." ADD `lottery_data` text;");
}
if(!pdo_fieldexists('ewei_shop_lottery_log',  'is_reward')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_log')." ADD `is_reward` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_lottery_log',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_lottery_log')." ADD `addtime` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_mc_merchant',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_mc_merchant')." ADD `id` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_mc_merchant',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_mc_merchant')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_mc_merchant',  'merchant_no')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_mc_merchant')." ADD `merchant_no` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_mc_merchant',  'username')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_mc_merchant')." ADD `username` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_mc_merchant',  'password')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_mc_merchant')." ADD `password` varchar(32) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_mc_merchant',  'salt')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_mc_merchant')." ADD `salt` varchar(8) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_mc_merchant',  'contact_name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_mc_merchant')." ADD `contact_name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_mc_merchant',  'contact_mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_mc_merchant')." ADD `contact_mobile` varchar(16) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_mc_merchant',  'contact_address')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_mc_merchant')." ADD `contact_address` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_mc_merchant',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_mc_merchant')." ADD `type` tinyint(4) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_mc_merchant',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_mc_merchant')." ADD `status` tinyint(4) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_mc_merchant',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_mc_merchant')." ADD `createtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_mc_merchant',  'validitytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_mc_merchant')." ADD `validitytime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_mc_merchant',  'industry')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_mc_merchant')." ADD `industry` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_mc_merchant',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_mc_merchant')." ADD `remark` varchar(1000) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_member',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `uid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'groupid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `groupid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'level')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `level` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `agentid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `openid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `realname` varchar(20) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `mobile` varchar(11) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'pwd')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `pwd` varchar(32) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'weixin')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `weixin` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `content` text;");
}
if(!pdo_fieldexists('ewei_shop_member',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `createtime` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'agenttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `agenttime` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'isagent')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `isagent` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'clickcount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `clickcount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'agentlevel')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `agentlevel` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'noticeset')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `noticeset` text;");
}
if(!pdo_fieldexists('ewei_shop_member',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `nickname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'credit1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `credit1` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_member',  'credit2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `credit2` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_member',  'birthyear')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `birthyear` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'birthmonth')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `birthmonth` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'birthday')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `birthday` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'gender')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `gender` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `avatar` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'province')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `province` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'city')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `city` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'area')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `area` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'childtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `childtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'agentnotupgrade')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `agentnotupgrade` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'inviter')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `inviter` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'agentselectgoods')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `agentselectgoods` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'agentblack')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `agentblack` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'username')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `username` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'fixagentid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `fixagentid` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'diymemberid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diymemberid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'diymemberdataid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diymemberdataid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'diymemberdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diymemberdata` text;");
}
if(!pdo_fieldexists('ewei_shop_member',  'diycommissionid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diycommissionid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'diycommissiondataid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diycommissiondataid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'diycommissiondata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diycommissiondata` text;");
}
if(!pdo_fieldexists('ewei_shop_member',  'isblack')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `isblack` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'diymemberfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diymemberfields` text;");
}
if(!pdo_fieldexists('ewei_shop_member',  'diycommissionfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diycommissionfields` text;");
}
if(!pdo_fieldexists('ewei_shop_member',  'commission_total')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `commission_total` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_member',  'endtime2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `endtime2` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'ispartner')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `ispartner` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'partnertime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `partnertime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'partnerstatus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `partnerstatus` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'partnerblack')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `partnerblack` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'partnerlevel')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `partnerlevel` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'partnernotupgrade')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `partnernotupgrade` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'diyglobonusid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diyglobonusid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'diyglobonusdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diyglobonusdata` text;");
}
if(!pdo_fieldexists('ewei_shop_member',  'diyglobonusfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diyglobonusfields` text;");
}
if(!pdo_fieldexists('ewei_shop_member',  'isaagent')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `isaagent` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'aagentlevel')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `aagentlevel` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'aagenttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `aagenttime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'aagentstatus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `aagentstatus` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'aagentblack')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `aagentblack` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'aagentnotupgrade')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `aagentnotupgrade` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'aagenttype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `aagenttype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'aagentprovinces')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `aagentprovinces` text;");
}
if(!pdo_fieldexists('ewei_shop_member',  'aagentcitys')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `aagentcitys` text;");
}
if(!pdo_fieldexists('ewei_shop_member',  'aagentareas')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `aagentareas` text;");
}
if(!pdo_fieldexists('ewei_shop_member',  'diyaagentid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diyaagentid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'diyaagentdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diyaagentdata` text;");
}
if(!pdo_fieldexists('ewei_shop_member',  'diyaagentfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diyaagentfields` text;");
}
if(!pdo_fieldexists('ewei_shop_member',  'salt')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `salt` varchar(32) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member',  'mobileverify')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `mobileverify` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'mobileuser')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `mobileuser` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'carrier_mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `carrier_mobile` varchar(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'isauthor')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `isauthor` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'authortime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `authortime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'authorstatus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `authorstatus` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'authorblack')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `authorblack` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'authorlevel')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `authorlevel` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'authornotupgrade')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `authornotupgrade` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'diyauthorid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diyauthorid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'diyauthordata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diyauthordata` text;");
}
if(!pdo_fieldexists('ewei_shop_member',  'diyauthorfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diyauthorfields` text;");
}
if(!pdo_fieldexists('ewei_shop_member',  'authorid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `authorid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'comefrom')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `comefrom` varchar(20) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member',  'openid_qq')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `openid_qq` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member',  'openid_wx')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `openid_wx` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member',  'diymaxcredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `diymaxcredit` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'maxcredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `maxcredit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member',  'datavalue')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `datavalue` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member',  'openid_wa')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD `openid_wa` varchar(50) DEFAULT NULL;");
}
if(!pdo_indexexists('ewei_shop_member',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_member',  'idx_shareid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD KEY `idx_shareid` (`agentid`);");
}
if(!pdo_indexexists('ewei_shop_member',  'idx_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD KEY `idx_openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_member',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_member',  'idx_agenttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD KEY `idx_agenttime` (`agenttime`);");
}
if(!pdo_indexexists('ewei_shop_member',  'idx_isagent')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD KEY `idx_isagent` (`isagent`);");
}
if(!pdo_indexexists('ewei_shop_member',  'idx_uid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD KEY `idx_uid` (`uid`);");
}
if(!pdo_indexexists('ewei_shop_member',  'idx_groupid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD KEY `idx_groupid` (`groupid`);");
}
if(!pdo_indexexists('ewei_shop_member',  'idx_level')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD KEY `idx_level` (`level`);");
}
if(!pdo_indexexists('ewei_shop_member',  'idx_mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD KEY `idx_mobile` (`mobile`);");
}
if(!pdo_fieldexists('ewei_shop_member_address',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_member_address',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_address',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD `openid` varchar(50) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_address',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD `realname` varchar(20) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_address',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD `mobile` varchar(11) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_address',  'province')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD `province` varchar(30) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_address',  'city')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD `city` varchar(30) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_address',  'area')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD `area` varchar(30) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_address',  'address')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD `address` varchar(300) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_address',  'isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD `isdefault` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_address',  'zipcode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD `zipcode` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_address',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD `deleted` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_address',  'street')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD `street` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_address',  'datavalue')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD `datavalue` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_address',  'streetdatavalue')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD `streetdatavalue` varchar(30) NOT NULL DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_member_address',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_member_address',  'idx_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD KEY `idx_openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_member_address',  'idx_isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD KEY `idx_isdefault` (`isdefault`);");
}
if(!pdo_indexexists('ewei_shop_member_address',  'idx_deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_address')." ADD KEY `idx_deleted` (`deleted`);");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `openid` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `goodsid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'total')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'marketprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `marketprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `deleted` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'optionid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `optionid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'diyformdataid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `diyformdataid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'diyformdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `diyformdata` text;");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'diyformfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `diyformfields` text;");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'diyformid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `diyformid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'selected')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `selected` tinyint(1) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_cart',  'selectedadd')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD `selectedadd` tinyint(1) DEFAULT '1';");
}
if(!pdo_indexexists('ewei_shop_member_cart',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_member_cart',  'idx_goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD KEY `idx_goodsid` (`goodsid`);");
}
if(!pdo_indexexists('ewei_shop_member_cart',  'idx_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD KEY `idx_openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_member_cart',  'idx_deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD KEY `idx_deleted` (`deleted`);");
}
if(!pdo_fieldexists('ewei_shop_member_favorite',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_favorite')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_member_favorite',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_favorite')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_favorite',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_favorite')." ADD `goodsid` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_favorite',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_favorite')." ADD `openid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_favorite',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_favorite')." ADD `deleted` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_favorite',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_favorite')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_favorite',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_favorite')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_favorite',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_favorite')." ADD `type` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_member_favorite',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_favorite')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_member_favorite',  'idx_goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_favorite')." ADD KEY `idx_goodsid` (`goodsid`);");
}
if(!pdo_indexexists('ewei_shop_member_favorite',  'idx_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_favorite')." ADD KEY `idx_openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_member_favorite',  'idx_deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_favorite')." ADD KEY `idx_deleted` (`deleted`);");
}
if(!pdo_indexexists('ewei_shop_member_favorite',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_favorite')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_fieldexists('ewei_shop_member_group',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_group')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_member_group',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_group')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_group',  'groupname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_group')." ADD `groupname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_history',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_history')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_member_history',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_history')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_history',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_history')." ADD `goodsid` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_history',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_history')." ADD `openid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_history',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_history')." ADD `deleted` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_history',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_history')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_history',  'times')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_history')." ADD `times` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_history',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_history')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_member_history',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_history')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_member_history',  'idx_goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_history')." ADD KEY `idx_goodsid` (`goodsid`);");
}
if(!pdo_indexexists('ewei_shop_member_history',  'idx_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_history')." ADD KEY `idx_openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_member_history',  'idx_deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_history')." ADD KEY `idx_deleted` (`deleted`);");
}
if(!pdo_indexexists('ewei_shop_member_history',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_history')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_fieldexists('ewei_shop_member_level',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_level')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_member_level',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_level')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_level',  'level')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_level')." ADD `level` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_level',  'levelname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_level')." ADD `levelname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_level',  'ordermoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_level')." ADD `ordermoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_member_level',  'ordercount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_level')." ADD `ordercount` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_level',  'discount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_level')." ADD `discount` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_member_level',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_level')." ADD `enabled` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_level',  'enabledadd')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_level')." ADD `enabledadd` tinyint(1) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_member_level',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_level')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `type` tinyint(3) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'logno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `logno` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `status` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'money')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `money` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'rechargetype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `rechargetype` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'transid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `transid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'gives')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `gives` decimal(10,2) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `couponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'isborrow')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `isborrow` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'borrowopenid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `borrowopenid` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'realmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `realmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'charge')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `charge` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'deductionmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `deductionmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `remark` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'apppay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `apppay` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'alipay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `alipay` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'bankname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `bankname` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'bankcard')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `bankcard` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `realname` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'applytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `applytype` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'sendmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `sendmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_member_log',  'senddata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD `senddata` text;");
}
if(!pdo_indexexists('ewei_shop_member_log',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_member_log',  'idx_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD KEY `idx_openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_member_log',  'idx_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD KEY `idx_type` (`type`);");
}
if(!pdo_indexexists('ewei_shop_member_log',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_member_log',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_log')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'template_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `template_id` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'first')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `first` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'firstcolor')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `firstcolor` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `data` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `remark` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'remarkcolor')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `remarkcolor` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `url` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'sendtimes')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `sendtimes` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'sendcount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `sendcount` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'typecode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `typecode` varchar(30) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'messagetype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `messagetype` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_message_template',  'send_desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD `send_desc` varchar(255) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_member_message_template',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_member_message_template',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_fieldexists('ewei_shop_member_message_template_default',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template_default')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template_default',  'typecode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template_default')." ADD `typecode` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template_default',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template_default')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template_default',  'templateid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template_default')." ADD `templateid` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template_type',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template_type')." ADD `id` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template_type',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template_type')." ADD `name` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template_type',  'typecode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template_type')." ADD `typecode` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template_type',  'templatecode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template_type')." ADD `templatecode` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template_type',  'templateid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template_type')." ADD `templateid` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template_type',  'templatename')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template_type')." ADD `templatename` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template_type',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template_type')." ADD `content` varchar(1000) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_message_template_type',  'showtotaladd')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template_type')." ADD `showtotaladd` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_message_template_type',  'typegroup')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template_type')." ADD `typegroup` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_message_template_type',  'groupname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template_type')." ADD `groupname` varchar(255) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_member_message_template_type',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_message_template_type')." ADD KEY `id` (`id`);");
}
if(!pdo_fieldexists('ewei_shop_member_printer',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_member_printer',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_printer',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_printer',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer')." ADD `type` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_printer',  'print_data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer')." ADD `print_data` text;");
}
if(!pdo_fieldexists('ewei_shop_member_printer',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_member_printer',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_member_printer',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_fieldexists('ewei_shop_member_printer_template',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer_template')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_member_printer_template',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer_template')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_printer_template',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer_template')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_printer_template',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer_template')." ADD `type` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_member_printer_template',  'print_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer_template')." ADD `print_title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_printer_template',  'print_style')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer_template')." ADD `print_style` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_printer_template',  'print_data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer_template')." ADD `print_data` text;");
}
if(!pdo_fieldexists('ewei_shop_member_printer_template',  'code')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer_template')." ADD `code` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_printer_template',  'qrcode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer_template')." ADD `qrcode` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_member_printer_template',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer_template')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_member_printer_template',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer_template')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_member_printer_template',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_printer_template')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_fieldexists('ewei_shop_member_rank',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_rank')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_member_rank',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_rank')." ADD `uniacid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_rank',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_rank')." ADD `status` tinyint(4) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_member_rank',  'num')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_rank')." ADD `num` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_merch_account',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_account',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_account',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_account',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_account',  'username')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD `username` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_account',  'pwd')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD `pwd` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_account',  'salt')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD `salt` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_account',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_account',  'perms')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD `perms` text;");
}
if(!pdo_fieldexists('ewei_shop_merch_account',  'isfounder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD `isfounder` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_account',  'lastip')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD `lastip` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_account',  'lastvisit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD `lastvisit` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_account',  'roleid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD `roleid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_merch_account',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_merch_account',  'idx_merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD KEY `idx_merchid` (`merchid`);");
}
if(!pdo_indexexists('ewei_shop_merch_account',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_account')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists('ewei_shop_merch_adv',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_adv')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_adv',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_adv')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_adv',  'advname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_adv')." ADD `advname` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_merch_adv',  'link')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_adv')." ADD `link` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_merch_adv',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_adv')." ADD `thumb` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_merch_adv',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_adv')." ADD `displayorder` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_merch_adv',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_adv')." ADD `enabled` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_merch_adv',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_adv')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_merch_adv',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_adv')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_merch_adv',  'idx_merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_adv')." ADD KEY `idx_merchid` (`merchid`);");
}
if(!pdo_fieldexists('ewei_shop_merch_banner',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_banner')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_banner',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_banner')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_banner',  'bannername')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_banner')." ADD `bannername` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_banner',  'link')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_banner')." ADD `link` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_banner',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_banner')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_banner',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_banner')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_banner',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_banner')." ADD `enabled` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_banner',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_banner')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_merch_banner',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_banner')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_merch_banner',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_banner')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_indexexists('ewei_shop_merch_banner',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_banner')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_indexexists('ewei_shop_merch_banner',  'idx_merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_banner')." ADD KEY `idx_merchid` (`merchid`);");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'applyno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `applyno` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `merchid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'orderids')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `orderids` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'realprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `realprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'realpricerate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `realpricerate` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'finalprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `finalprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'payrateprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `payrateprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'payrate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `payrate` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'money')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `money` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'applytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `applytime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'checktime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `checktime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `paytime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'invalidtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `invalidtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'refusetime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `refusetime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `remark` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'ordernum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `ordernum` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'orderprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `orderprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `price` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'passrealprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `passrealprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'passrealpricerate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `passrealpricerate` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'passorderids')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `passorderids` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'passordernum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `passordernum` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'passorderprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `passorderprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'alipay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `alipay` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'bankname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `bankname` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'bankcard')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `bankcard` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'applyrealname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `applyrealname` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'applytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `applytype` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_bill',  'handpay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD `handpay` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_merch_bill',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_merch_bill',  'idx_merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD KEY `idx_merchid` (`merchid`);");
}
if(!pdo_indexexists('ewei_shop_merch_bill',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_bill')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists('ewei_shop_merch_billo',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_billo')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_billo',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_billo')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_billo',  'billid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_billo')." ADD `billid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_billo',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_billo')." ADD `orderid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_billo',  'ordermoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_billo')." ADD `ordermoney` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_indexexists('ewei_shop_merch_billo',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_billo')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_merch_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_category',  'catename')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category')." ADD `catename` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_category',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_category',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_category',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category')." ADD `thumb` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_category',  'isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category')." ADD `isrecommand` tinyint(1) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_merch_category',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_merch_category_swipe',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category_swipe')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_category_swipe',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category_swipe')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_category_swipe',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category_swipe')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_category_swipe',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category_swipe')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_category_swipe',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category_swipe')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_category_swipe',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category_swipe')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_category_swipe',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category_swipe')." ADD `thumb` varchar(500) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_merch_category_swipe',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_category_swipe')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `merchid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'clearno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `clearno` varchar(64) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'goodsprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `goodsprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'dispatchprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `dispatchprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'deductprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `deductprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'deductcredit2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `deductcredit2` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'discountprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `discountprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'deductenough')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `deductenough` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'merchdeductenough')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `merchdeductenough` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'isdiscountprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `isdiscountprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `price` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `createtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `starttime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `endtime` int(10) unsigned NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `status` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'realprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `realprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'realpricerate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `realpricerate` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'finalprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `finalprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `remark` varchar(2000) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `paytime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_clearing',  'payrate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD `payrate` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_indexexists('ewei_shop_merch_clearing',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD KEY `uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_merch_clearing',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD KEY `merchid` (`merchid`);");
}
if(!pdo_indexexists('ewei_shop_merch_clearing',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD KEY `starttime` (`starttime`);");
}
if(!pdo_indexexists('ewei_shop_merch_clearing',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD KEY `endtime` (`endtime`);");
}
if(!pdo_indexexists('ewei_shop_merch_clearing',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_clearing')." ADD KEY `status` (`status`);");
}
if(!pdo_fieldexists('ewei_shop_merch_group',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_group')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_group',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_group')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_group',  'groupname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_group')." ADD `groupname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_group',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_group')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_group',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_group')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_group',  'isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_group')." ADD `isdefault` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_group',  'goodschecked')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_group')." ADD `goodschecked` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_group',  'commissionchecked')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_group')." ADD `commissionchecked` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_group',  'changepricechecked')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_group')." ADD `changepricechecked` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_group',  'finishchecked')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_group')." ADD `finishchecked` tinyint(1) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_merch_group',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_group')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_merch_nav',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_nav')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_nav',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_nav')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_nav',  'navname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_nav')." ADD `navname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_nav',  'icon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_nav')." ADD `icon` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_nav',  'url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_nav')." ADD `url` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_nav',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_nav')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_nav',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_nav')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_nav',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_nav')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_merch_nav',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_nav')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_merch_nav',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_nav')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_merch_nav',  'idx_merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_nav')." ADD KEY `idx_merchid` (`merchid`);");
}
if(!pdo_fieldexists('ewei_shop_merch_notice',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_notice')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_notice',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_notice')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_notice',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_notice')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_notice',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_notice')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_notice',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_notice')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_notice',  'link')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_notice')." ADD `link` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_notice',  'detail')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_notice')." ADD `detail` text;");
}
if(!pdo_fieldexists('ewei_shop_merch_notice',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_notice')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_notice',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_notice')." ADD `createtime` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_merch_notice',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_notice')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_merch_notice',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_notice')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_merch_notice',  'idx_merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_notice')." ADD KEY `idx_merchid` (`merchid`);");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_log')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_log',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_log')." ADD `uid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_log')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_log',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_log')." ADD `name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_log',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_log')." ADD `type` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_log',  'op')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_log')." ADD `op` text;");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_log',  'ip')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_log')." ADD `ip` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_log',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_log')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_log',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_log')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_merch_perm_log',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_log')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_merch_perm_log',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_log')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_merch_perm_log',  'idx_merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_log')." ADD KEY `idx_merchid` (`merchid`);");
}
if(!pdo_indexexists('ewei_shop_merch_perm_log',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_log')." ADD KEY `uid` (`uid`);");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_role',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_role')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_role',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_role')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_role',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_role')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_role',  'rolename')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_role')." ADD `rolename` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_role',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_role')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_role',  'perms')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_role')." ADD `perms` text;");
}
if(!pdo_fieldexists('ewei_shop_merch_perm_role',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_role')." ADD `deleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_merch_perm_role',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_role')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_merch_perm_role',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_role')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_merch_perm_role',  'idx_deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_role')." ADD KEY `idx_deleted` (`deleted`);");
}
if(!pdo_indexexists('ewei_shop_merch_perm_role',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_perm_role')." ADD KEY `merchid` (`merchid`);");
}
if(!pdo_fieldexists('ewei_shop_merch_reg',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_reg')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_reg',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_reg')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_reg',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_reg')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_reg',  'merchname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_reg')." ADD `merchname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_reg',  'salecate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_reg')." ADD `salecate` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_reg',  'desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_reg')." ADD `desc` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_reg',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_reg')." ADD `realname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_reg',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_reg')." ADD `mobile` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_reg',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_reg')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_reg',  'diyformdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_reg')." ADD `diyformdata` text;");
}
if(!pdo_fieldexists('ewei_shop_merch_reg',  'diyformfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_reg')." ADD `diyformfields` text;");
}
if(!pdo_fieldexists('ewei_shop_merch_reg',  'applytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_reg')." ADD `applytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_reg',  'reason')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_reg')." ADD `reason` text;");
}
if(!pdo_fieldexists('ewei_shop_merch_saler',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_saler')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_saler',  'storeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_saler')." ADD `storeid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_saler',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_saler')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_saler',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_saler')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_saler',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_saler')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_saler',  'salername')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_saler')." ADD `salername` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_saler',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_saler')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_merch_saler',  'idx_storeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_saler')." ADD KEY `idx_storeid` (`storeid`);");
}
if(!pdo_indexexists('ewei_shop_merch_saler',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_saler')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_merch_saler',  'idx_merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_saler')." ADD KEY `idx_merchid` (`merchid`);");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'storename')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `storename` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'address')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `address` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'tel')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `tel` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'lat')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `lat` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'lng')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `lng` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `type` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `realname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `mobile` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'fetchtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `fetchtime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'logo')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `logo` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'saletime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `saletime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `desc` text;");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'commission_total')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `commission_total` decimal(10,2) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_merch_store',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_merch_store',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_merch_store',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_merch_store',  'idx_merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_store')." ADD KEY `idx_merchid` (`merchid`);");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'regid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `regid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `openid` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'groupid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `groupid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'merchno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `merchno` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'merchname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `merchname` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'salecate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `salecate` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `desc` varchar(500) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `realname` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `mobile` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'accounttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `accounttime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'diyformdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `diyformdata` text;");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'diyformfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `diyformfields` text;");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'applytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `applytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'accounttotal')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `accounttotal` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `remark` text;");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'jointime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `jointime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'accountid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `accountid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'sets')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `sets` text;");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'logo')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `logo` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'payopenid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `payopenid` varchar(32) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'payrate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `payrate` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `isrecommand` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'cateid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `cateid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'address')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `address` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'tel')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `tel` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'lat')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `lat` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'lng')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `lng` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_merch_user',  'pluginset')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD `pluginset` text;");
}
if(!pdo_indexexists('ewei_shop_merch_user',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_merch_user',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_merch_user',  'idx_groupid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD KEY `idx_groupid` (`groupid`);");
}
if(!pdo_indexexists('ewei_shop_merch_user',  'idx_regid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD KEY `idx_regid` (`regid`);");
}
if(!pdo_indexexists('ewei_shop_merch_user',  'idx_cateid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_merch_user')." ADD KEY `idx_cateid` (`cateid`);");
}
if(!pdo_fieldexists('ewei_shop_multi_shop',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_multi_shop')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_multi_shop',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_multi_shop')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_multi_shop',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_multi_shop')." ADD `uid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_multi_shop',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_multi_shop')." ADD `name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_multi_shop',  'company')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_multi_shop')." ADD `company` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_multi_shop',  'sales')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_multi_shop')." ADD `sales` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_multi_shop',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_multi_shop')." ADD `starttime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_multi_shop',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_multi_shop')." ADD `endtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_multi_shop',  'applytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_multi_shop')." ADD `applytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_multi_shop',  'jointime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_multi_shop')." ADD `jointime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_multi_shop',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_multi_shop')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_multi_shop',  'refusecontent')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_multi_shop')." ADD `refusecontent` text;");
}
if(!pdo_fieldexists('ewei_shop_nav',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_nav')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_nav',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_nav')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_nav',  'navname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_nav')." ADD `navname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_nav',  'icon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_nav')." ADD `icon` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_nav',  'url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_nav')." ADD `url` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_nav',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_nav')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_nav',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_nav')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_nav',  'iswxapp')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_nav')." ADD `iswxapp` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_nav',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_nav')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_nav',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_nav')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_notice',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_notice')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_notice',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_notice')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_notice',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_notice')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_notice',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_notice')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_notice',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_notice')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_notice',  'link')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_notice')." ADD `link` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_notice',  'detail')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_notice')." ADD `detail` text;");
}
if(!pdo_fieldexists('ewei_shop_notice',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_notice')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_notice',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_notice')." ADD `createtime` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_notice',  'shopid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_notice')." ADD `shopid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_notice',  'iswxapp')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_notice')." ADD `iswxapp` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_notice',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_notice')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_order',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `openid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order',  'agentid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `agentid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'ordersn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `ordersn` varchar(30) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order',  'price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'goodsprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `goodsprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'discountprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `discountprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `paytype` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'transid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `transid` varchar(30) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'remark')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `remark` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order',  'addressid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `addressid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'dispatchprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `dispatchprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'dispatchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `dispatchid` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `createtime` int(10) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_order',  'dispatchtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `dispatchtype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'carrier')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `carrier` text;");
}
if(!pdo_fieldexists('ewei_shop_order',  'refundid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `refundid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'iscomment')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `iscomment` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'creditadd')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `creditadd` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `deleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'userdeleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `userdeleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'finishtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `finishtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `paytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'expresscom')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `expresscom` varchar(30) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order',  'expresssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `expresssn` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order',  'express')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `express` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order',  'sendtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `sendtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'fetchtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `fetchtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'cash')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `cash` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'canceltime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `canceltime` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_order',  'cancelpaytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `cancelpaytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'refundtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `refundtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'isverify')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `isverify` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'verified')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `verified` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'verifyopenid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `verifyopenid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order',  'verifytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `verifytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'verifycode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `verifycode` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order',  'verifystoreid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `verifystoreid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'deductprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `deductprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'deductcredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `deductcredit` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'deductcredit2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `deductcredit2` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'deductenough')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `deductenough` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'virtual')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `virtual` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'virtual_info')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `virtual_info` text;");
}
if(!pdo_fieldexists('ewei_shop_order',  'virtual_str')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `virtual_str` text;");
}
if(!pdo_fieldexists('ewei_shop_order',  'address')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `address` text;");
}
if(!pdo_fieldexists('ewei_shop_order',  'sysdeleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `sysdeleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'ordersn2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `ordersn2` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'changeprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `changeprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'changedispatchprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `changedispatchprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'oldprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `oldprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'olddispatchprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `olddispatchprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'isvirtual')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `isvirtual` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `couponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'couponprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `couponprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'diyformdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `diyformdata` text;");
}
if(!pdo_fieldexists('ewei_shop_order',  'diyformfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `diyformfields` text;");
}
if(!pdo_fieldexists('ewei_shop_order',  'diyformid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `diyformid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'storeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `storeid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'closereason')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `closereason` text;");
}
if(!pdo_fieldexists('ewei_shop_order',  'remarksaler')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `remarksaler` text;");
}
if(!pdo_fieldexists('ewei_shop_order',  'printstate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `printstate` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'printstate2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `printstate2` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'address_send')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `address_send` text;");
}
if(!pdo_fieldexists('ewei_shop_order',  'refundstate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `refundstate` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'remarkclose')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `remarkclose` text;");
}
if(!pdo_fieldexists('ewei_shop_order',  'remarksend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `remarksend` text;");
}
if(!pdo_fieldexists('ewei_shop_order',  'ismr')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `ismr` int(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'isdiscountprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `isdiscountprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'isvirtualsend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `isvirtualsend` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'virtualsend_info')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `virtualsend_info` text;");
}
if(!pdo_fieldexists('ewei_shop_order',  'verifyinfo')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `verifyinfo` text;");
}
if(!pdo_fieldexists('ewei_shop_order',  'verifytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `verifytype` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'verifycodes')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `verifycodes` text;");
}
if(!pdo_fieldexists('ewei_shop_order',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'invoicename')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `invoicename` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order',  'ismerch')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `ismerch` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'parentid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `parentid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'isparent')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `isparent` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'grprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `grprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'merchshow')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `merchshow` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'merchdeductenough')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `merchdeductenough` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'couponmerchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `couponmerchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'isglobonus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `isglobonus` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'merchapply')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `merchapply` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'isabonus')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `isabonus` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'isborrow')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `isborrow` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'borrowopenid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `borrowopenid` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order',  'merchisdiscountprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `merchisdiscountprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'apppay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `apppay` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'coupongoodprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `coupongoodprice` decimal(10,2) DEFAULT '1.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'buyagainprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `buyagainprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'ispackage')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `ispackage` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'packageid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `packageid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'taskdiscountprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `taskdiscountprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'seckilldiscountprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `seckilldiscountprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'verifyendtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `verifyendtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'willcancelmessage')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `willcancelmessage` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'sendtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `sendtype` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'lotterydiscountprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `lotterydiscountprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order',  'contype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `contype` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'wxid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `wxid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order',  'wxcardid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `wxcardid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order',  'wxcode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `wxcode` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order',  'dispatchkey')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD `dispatchkey` varchar(30) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_order',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_order',  'idx_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD KEY `idx_openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_order',  'idx_shareid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD KEY `idx_shareid` (`agentid`);");
}
if(!pdo_indexexists('ewei_shop_order',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_order',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_order',  'idx_refundid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD KEY `idx_refundid` (`refundid`);");
}
if(!pdo_indexexists('ewei_shop_order',  'idx_paytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD KEY `idx_paytime` (`paytime`);");
}
if(!pdo_indexexists('ewei_shop_order',  'idx_finishtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD KEY `idx_finishtime` (`finishtime`);");
}
if(!pdo_indexexists('ewei_shop_order',  'idx_merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD KEY `idx_merchid` (`merchid`);");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `orderid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `goodsid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `openid` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `nickname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'headimgurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `headimgurl` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'level')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `level` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `content` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'images')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `images` text;");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `deleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'append_content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `append_content` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'append_images')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `append_images` text;");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'reply_content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `reply_content` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'reply_images')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `reply_images` text;");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'append_reply_content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `append_reply_content` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'append_reply_images')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `append_reply_images` text;");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'istop')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `istop` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'checked')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `checked` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_comment',  'replychecked')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD `replychecked` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_order_comment',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_order_comment',  'idx_goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD KEY `idx_goodsid` (`goodsid`);");
}
if(!pdo_indexexists('ewei_shop_order_comment',  'idx_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD KEY `idx_openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_order_comment',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_order_comment',  'idx_orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_comment')." ADD KEY `idx_orderid` (`orderid`);");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `orderid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `goodsid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'total')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `total` int(11) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'optionid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `optionid` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'optionname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `optionname` text;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'commission1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `commission1` text;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'applytime1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `applytime1` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'checktime1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `checktime1` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'paytime1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `paytime1` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'invalidtime1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `invalidtime1` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'deletetime1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `deletetime1` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'status1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `status1` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'content1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `content1` text;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'commission2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `commission2` text;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'applytime2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `applytime2` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'checktime2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `checktime2` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'paytime2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `paytime2` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'invalidtime2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `invalidtime2` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'deletetime2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `deletetime2` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'status2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `status2` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'content2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `content2` text;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'commission3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `commission3` text;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'applytime3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `applytime3` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'checktime3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `checktime3` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'paytime3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `paytime3` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'invalidtime3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `invalidtime3` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'deletetime3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `deletetime3` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'status3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `status3` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'content3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `content3` text;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'realprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `realprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'goodssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `goodssn` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'productsn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `productsn` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'nocommission')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `nocommission` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'changeprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `changeprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'oldprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `oldprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'commissions')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `commissions` text;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'diyformdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `diyformdata` text;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'diyformfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `diyformfields` text;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'diyformdataid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `diyformdataid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'diyformid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `diyformid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'rstate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `rstate` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'refundtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `refundtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'printstate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `printstate` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'printstate2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `printstate2` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'parentorderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `parentorderid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'merchsale')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `merchsale` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'isdiscountprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `isdiscountprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'canbuyagain')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `canbuyagain` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'seckill')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `seckill` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'seckill_taskid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `seckill_taskid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'seckill_roomid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `seckill_roomid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'seckill_timeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `seckill_timeid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'is_make')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `is_make` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'sendtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `sendtype` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'expresscom')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `expresscom` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'expresssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `expresssn` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'express')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `express` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'sendtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `sendtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'finishtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `finishtime` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_order_goods',  'remarksend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD `remarksend` text NOT NULL;");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_orderid` (`orderid`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_goodsid` (`goodsid`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_applytime1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_applytime1` (`applytime1`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_checktime1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_checktime1` (`checktime1`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_status1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_status1` (`status1`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_applytime2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_applytime2` (`applytime2`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_checktime2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_checktime2` (`checktime2`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_status2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_status2` (`status2`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_applytime3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_applytime3` (`applytime3`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_invalidtime1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_invalidtime1` (`invalidtime1`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_checktime3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_checktime3` (`checktime3`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_invalidtime2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_invalidtime2` (`invalidtime2`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_invalidtime3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_invalidtime3` (`invalidtime3`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_status3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_status3` (`status3`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_paytime1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_paytime1` (`paytime1`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_paytime2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_paytime2` (`paytime2`);");
}
if(!pdo_indexexists('ewei_shop_order_goods',  'idx_paytime3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD KEY `idx_paytime3` (`paytime3`);");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `orderid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'refundno')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `refundno` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `price` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'reason')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `reason` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'images')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `images` text;");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `content` text;");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'reply')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `reply` text;");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'refundtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `refundtype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'realprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `realprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'refundtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `refundtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'orderprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `orderprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'applyprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `applyprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'imgs')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `imgs` text;");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'rtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `rtype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'refundaddress')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `refundaddress` text;");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'message')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `message` text;");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'express')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `express` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'expresscom')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `expresscom` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'expresssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `expresssn` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'operatetime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `operatetime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'sendtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `sendtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'returntime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `returntime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'rexpress')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `rexpress` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'rexpresscom')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `rexpresscom` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'rexpresssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `rexpresssn` varchar(100) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'refundaddressid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `refundaddressid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `endtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_order_refund',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_order_refund',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_order_refund',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_refund')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_package',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_package',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_package',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `title` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_package',  'price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `price` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_package',  'freight')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `freight` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_package',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_package',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `starttime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_package',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `endtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_package',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `goodsid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_package',  'cash')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `cash` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_package',  'share_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `share_title` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_package',  'share_icon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `share_icon` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_package',  'share_desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `share_desc` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_package',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_package',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `deleted` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_package',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package')." ADD `displayorder` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'pid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `pid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `goodsid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `title` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `price` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'option')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `option` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'goodssn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `goodssn` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'productsn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `productsn` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'hasoption')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `hasoption` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'marketprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `marketprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'packageprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `packageprice` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'commission1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `commission1` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'commission2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `commission2` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_package_goods',  'commission3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods')." ADD `commission3` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_package_goods_option',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods_option')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_package_goods_option',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods_option')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_package_goods_option',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods_option')." ADD `goodsid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_package_goods_option',  'optionid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods_option')." ADD `optionid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_package_goods_option',  'pid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods_option')." ADD `pid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_package_goods_option',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods_option')." ADD `title` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_package_goods_option',  'packageprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods_option')." ADD `packageprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_package_goods_option',  'marketprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods_option')." ADD `marketprice` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_package_goods_option',  'commission1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods_option')." ADD `commission1` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_package_goods_option',  'commission2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods_option')." ADD `commission2` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_package_goods_option',  'commission3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_package_goods_option')." ADD `commission3` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_perm_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_log')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_perm_log',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_log')." ADD `uid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_perm_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_log')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_perm_log',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_log')." ADD `name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_perm_log',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_log')." ADD `type` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_perm_log',  'op')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_log')." ADD `op` text;");
}
if(!pdo_fieldexists('ewei_shop_perm_log',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_log')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_perm_log',  'ip')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_log')." ADD `ip` varchar(255) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_perm_log',  'idx_uid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_log')." ADD KEY `idx_uid` (`uid`);");
}
if(!pdo_indexexists('ewei_shop_perm_log',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_log')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_perm_log',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_log')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_perm_plugin',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_plugin')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_perm_plugin',  'acid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_plugin')." ADD `acid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_perm_plugin',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_plugin')." ADD `uid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_perm_plugin',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_plugin')." ADD `type` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_perm_plugin',  'plugins')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_plugin')." ADD `plugins` text;");
}
if(!pdo_fieldexists('ewei_shop_perm_plugin',  'coms')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_plugin')." ADD `coms` text;");
}
if(!pdo_fieldexists('ewei_shop_perm_plugin',  'datas')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_plugin')." ADD `datas` text;");
}
if(!pdo_indexexists('ewei_shop_perm_plugin',  'idx_uid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_plugin')." ADD KEY `idx_uid` (`uid`);");
}
if(!pdo_indexexists('ewei_shop_perm_plugin',  'idx_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_plugin')." ADD KEY `idx_type` (`type`);");
}
if(!pdo_indexexists('ewei_shop_perm_plugin',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_plugin')." ADD KEY `idx_uniacid` (`acid`);");
}
if(!pdo_fieldexists('ewei_shop_perm_role',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_role')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_perm_role',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_role')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_perm_role',  'rolename')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_role')." ADD `rolename` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_perm_role',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_role')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_perm_role',  'perms')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_role')." ADD `perms` text;");
}
if(!pdo_fieldexists('ewei_shop_perm_role',  'perms2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_role')." ADD `perms2` text;");
}
if(!pdo_fieldexists('ewei_shop_perm_role',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_role')." ADD `deleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_perm_role',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_role')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_perm_role',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_role')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_perm_role',  'idx_deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_role')." ADD KEY `idx_deleted` (`deleted`);");
}
if(!pdo_fieldexists('ewei_shop_perm_user',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_perm_user',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_perm_user',  'uid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD `uid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_perm_user',  'username')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD `username` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_perm_user',  'password')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD `password` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_perm_user',  'roleid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD `roleid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_perm_user',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD `status` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_perm_user',  'perms')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD `perms` text;");
}
if(!pdo_fieldexists('ewei_shop_perm_user',  'perms2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD `perms2` text;");
}
if(!pdo_fieldexists('ewei_shop_perm_user',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD `deleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_perm_user',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD `realname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_perm_user',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD `mobile` varchar(255) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_perm_user',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_perm_user',  'idx_uid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD KEY `idx_uid` (`uid`);");
}
if(!pdo_indexexists('ewei_shop_perm_user',  'idx_roleid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD KEY `idx_roleid` (`roleid`);");
}
if(!pdo_indexexists('ewei_shop_perm_user',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_indexexists('ewei_shop_perm_user',  'idx_deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_perm_user')." ADD KEY `idx_deleted` (`deleted`);");
}
if(!pdo_fieldexists('ewei_shop_plugin',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_plugin')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_plugin',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_plugin')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_plugin',  'identity')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_plugin')." ADD `identity` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_plugin',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_plugin')." ADD `name` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_plugin',  'version')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_plugin')." ADD `version` varchar(10) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_plugin',  'author')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_plugin')." ADD `author` varchar(20) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_plugin',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_plugin')." ADD `status` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_plugin',  'category')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_plugin')." ADD `category` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_plugin',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_plugin')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_plugin',  'desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_plugin')." ADD `desc` text;");
}
if(!pdo_fieldexists('ewei_shop_plugin',  'iscom')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_plugin')." ADD `iscom` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_plugin',  'deprecated')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_plugin')." ADD `deprecated` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_plugin',  'isv2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_plugin')." ADD `isv2` tinyint(3) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_plugin',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_plugin')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_indexexists('ewei_shop_plugin',  'idx_identity')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_plugin')." ADD KEY `idx_identity` (`identity`);");
}
if(!pdo_fieldexists('ewei_shop_poster',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_poster',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `type` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'bg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `bg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `data` text;");
}
if(!pdo_fieldexists('ewei_shop_poster',  'keyword')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `keyword` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'keyword2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `keyword2` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'times')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `times` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'follows')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `follows` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `isdefault` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'resptype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `resptype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'resptext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `resptext` text;");
}
if(!pdo_fieldexists('ewei_shop_poster',  'resptitle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `resptitle` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'respthumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `respthumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'respdesc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `respdesc` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'respurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `respurl` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'waittext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `waittext` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'oktext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `oktext` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'subcredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `subcredit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'submoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `submoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'reccredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `reccredit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'recmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `recmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'scantext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `scantext` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'subtext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `subtext` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'beagent')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `beagent` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'bedown')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `bedown` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'isopen')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `isopen` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'opentext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `opentext` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'openurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `openurl` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `paytype` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'subpaycontent')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `subpaycontent` text;");
}
if(!pdo_fieldexists('ewei_shop_poster',  'recpaycontent')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `recpaycontent` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'templateid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `templateid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'entrytext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `entrytext` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'reccouponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `reccouponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'reccouponnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `reccouponnum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'subcouponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `subcouponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'subcouponnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `subcouponnum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster',  'resptext11')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `resptext11` text;");
}
if(!pdo_fieldexists('ewei_shop_poster',  'reward_totle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD `reward_totle` varchar(500) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_poster',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_poster',  'idx_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD KEY `idx_type` (`type`);");
}
if(!pdo_indexexists('ewei_shop_poster',  'idx_times')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD KEY `idx_times` (`times`);");
}
if(!pdo_indexexists('ewei_shop_poster',  'idx_isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD KEY `idx_isdefault` (`isdefault`);");
}
if(!pdo_indexexists('ewei_shop_poster',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_fieldexists('ewei_shop_poster_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_poster_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster_log',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster_log',  'posterid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD `posterid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster_log',  'from_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD `from_openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster_log',  'subcredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD `subcredit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster_log',  'submoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD `submoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_poster_log',  'reccredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD `reccredit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster_log',  'recmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD `recmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_poster_log',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster_log',  'reccouponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD `reccouponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster_log',  'reccouponnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD `reccouponnum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster_log',  'subcouponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD `subcouponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster_log',  'subcouponnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD `subcouponnum` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_poster_log',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_poster_log',  'idx_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD KEY `idx_openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_poster_log',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_poster_log',  'idx_posterid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_log')." ADD KEY `idx_posterid` (`posterid`);");
}
if(!pdo_fieldexists('ewei_shop_poster_qr',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_poster_qr',  'acid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD `acid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_poster_qr',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD `openid` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster_qr',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD `type` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster_qr',  'sceneid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD `sceneid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster_qr',  'mediaid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD `mediaid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster_qr',  'ticket')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD `ticket` varchar(250) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_poster_qr',  'url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD `url` varchar(80) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_poster_qr',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD `createtime` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_poster_qr',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD `goodsid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster_qr',  'qrimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD `qrimg` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster_qr',  'posterid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD `posterid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster_qr',  'scenestr')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD `scenestr` varchar(255) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_poster_qr',  'idx_acid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD KEY `idx_acid` (`acid`);");
}
if(!pdo_indexexists('ewei_shop_poster_qr',  'idx_sceneid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD KEY `idx_sceneid` (`sceneid`);");
}
if(!pdo_indexexists('ewei_shop_poster_qr',  'idx_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_qr')." ADD KEY `idx_type` (`type`);");
}
if(!pdo_fieldexists('ewei_shop_poster_scan',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_scan')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_poster_scan',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_scan')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster_scan',  'posterid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_scan')." ADD `posterid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_poster_scan',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_scan')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster_scan',  'from_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_scan')." ADD `from_openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_poster_scan',  'scantime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_scan')." ADD `scantime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_poster_scan',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_scan')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_poster_scan',  'idx_posterid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_scan')." ADD KEY `idx_posterid` (`posterid`);");
}
if(!pdo_indexexists('ewei_shop_poster_scan',  'idx_scantime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_poster_scan')." ADD KEY `idx_scantime` (`scantime`);");
}
if(!pdo_fieldexists('ewei_shop_postera',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_postera',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `type` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'days')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `days` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'bg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `bg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `data` text;");
}
if(!pdo_fieldexists('ewei_shop_postera',  'keyword')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `keyword` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'keyword2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `keyword2` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `isdefault` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'resptype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `resptype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'resptext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `resptext` text;");
}
if(!pdo_fieldexists('ewei_shop_postera',  'resptitle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `resptitle` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'respthumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `respthumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'respdesc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `respdesc` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'respurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `respurl` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'waittext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `waittext` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'oktext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `oktext` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'subcredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `subcredit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'submoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `submoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'reccredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `reccredit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'recmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `recmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'scantext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `scantext` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'subtext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `subtext` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'beagent')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `beagent` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'bedown')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `bedown` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'isopen')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `isopen` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'opentext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `opentext` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'openurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `openurl` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'paytype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `paytype` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'subpaycontent')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `subpaycontent` text;");
}
if(!pdo_fieldexists('ewei_shop_postera',  'recpaycontent')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `recpaycontent` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'templateid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `templateid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'entrytext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `entrytext` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'reccouponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `reccouponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'reccouponnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `reccouponnum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'subcouponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `subcouponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'subcouponnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `subcouponnum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'timestart')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `timestart` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'timeend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `timeend` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `goodsid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'starttext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `starttext` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'endtext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `endtext` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_postera',  'testflag')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `testflag` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera',  'reward_totle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD `reward_totle` varchar(500) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_postera',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_postera',  'idx_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD KEY `idx_type` (`type`);");
}
if(!pdo_indexexists('ewei_shop_postera',  'idx_isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD KEY `idx_isdefault` (`isdefault`);");
}
if(!pdo_indexexists('ewei_shop_postera',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_fieldexists('ewei_shop_postera_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_postera_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera_log',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera_log',  'posterid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD `posterid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera_log',  'from_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD `from_openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera_log',  'subcredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD `subcredit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera_log',  'submoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD `submoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_postera_log',  'reccredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD `reccredit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera_log',  'recmoney')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD `recmoney` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_postera_log',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera_log',  'reccouponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD `reccouponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera_log',  'reccouponnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD `reccouponnum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera_log',  'subcouponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD `subcouponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera_log',  'subcouponnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD `subcouponnum` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_postera_log',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_postera_log',  'idx_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD KEY `idx_openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_postera_log',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_postera_log',  'idx_posteraid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_log')." ADD KEY `idx_posteraid` (`posterid`);");
}
if(!pdo_fieldexists('ewei_shop_postera_qr',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_postera_qr',  'acid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD `acid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_postera_qr',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD `openid` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera_qr',  'posterid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD `posterid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera_qr',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD `type` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera_qr',  'sceneid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD `sceneid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera_qr',  'mediaid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD `mediaid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera_qr',  'ticket')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD `ticket` varchar(250) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_postera_qr',  'url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD `url` varchar(80) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_postera_qr',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD `createtime` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_postera_qr',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD `goodsid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera_qr',  'qrimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD `qrimg` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_postera_qr',  'expire')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD `expire` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera_qr',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD `endtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_postera_qr',  'qrtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD `qrtime` varchar(32) DEFAULT NULL;");
}
if(!pdo_indexexists('ewei_shop_postera_qr',  'idx_acid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD KEY `idx_acid` (`acid`);");
}
if(!pdo_indexexists('ewei_shop_postera_qr',  'idx_sceneid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD KEY `idx_sceneid` (`sceneid`);");
}
if(!pdo_indexexists('ewei_shop_postera_qr',  'idx_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD KEY `idx_type` (`type`);");
}
if(!pdo_indexexists('ewei_shop_postera_qr',  'idx_posterid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera_qr')." ADD KEY `idx_posterid` (`posterid`);");
}
if(!pdo_fieldexists('ewei_shop_qa_adv',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_adv')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_qa_adv',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_adv')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_qa_adv',  'advname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_adv')." ADD `advname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_qa_adv',  'link')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_adv')." ADD `link` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_qa_adv',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_adv')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_qa_adv',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_adv')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_qa_adv',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_adv')." ADD `enabled` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_qa_adv',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_adv')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_qa_adv',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_adv')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_indexexists('ewei_shop_qa_adv',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_adv')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_fieldexists('ewei_shop_qa_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_qa_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_category')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_qa_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_category')." ADD `name` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_qa_category',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_category')." ADD `thumb` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_qa_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_category')." ADD `displayorder` tinyint(3) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_qa_category',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_category')." ADD `enabled` tinyint(1) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_qa_category',  'isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_category')." ADD `isrecommand` tinyint(3) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_qa_category',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_category')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_indexexists('ewei_shop_qa_category',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_category')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_indexexists('ewei_shop_qa_category',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_category')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_qa_question',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_question')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_qa_question',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_question')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_qa_question',  'cate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_question')." ADD `cate` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_qa_question',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_question')." ADD `title` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_qa_question',  'keywords')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_question')." ADD `keywords` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_qa_question',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_question')." ADD `content` mediumtext NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_qa_question',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_question')." ADD `status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_qa_question',  'isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_question')." ADD `isrecommand` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_qa_question',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_question')." ADD `displayorder` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_qa_question',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_question')." ADD `createtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_qa_question',  'lastedittime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_question')." ADD `lastedittime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_qa_question',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_question')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_qa_question',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_question')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists('ewei_shop_qa_set',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_set')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_qa_set',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_set')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_qa_set',  'showmember')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_set')." ADD `showmember` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_qa_set',  'showtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_set')." ADD `showtype` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_qa_set',  'keyword')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_set')." ADD `keyword` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_qa_set',  'enter_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_set')." ADD `enter_title` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_qa_set',  'enter_img')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_set')." ADD `enter_img` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_qa_set',  'enter_desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_set')." ADD `enter_desc` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_qa_set',  'share')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_set')." ADD `share` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_qa_set',  'idx_unaicid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_qa_set')." ADD KEY `idx_unaicid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `openid` varchar(50) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `title` varchar(20) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `name` varchar(20) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'tel')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `tel` varchar(20) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `mobile` varchar(11) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'province')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `province` varchar(30) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'city')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `city` varchar(30) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'area')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `area` varchar(30) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'address')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `address` varchar(300) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `isdefault` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'zipcode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `zipcode` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `content` text;");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `deleted` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_refund_address',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_refund_address',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_refund_address',  'idx_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD KEY `idx_openid` (`openid`);");
}
if(!pdo_indexexists('ewei_shop_refund_address',  'idx_isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD KEY `idx_isdefault` (`isdefault`);");
}
if(!pdo_indexexists('ewei_shop_refund_address',  'idx_deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_refund_address')." ADD KEY `idx_deleted` (`deleted`);");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon')." ADD `name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon')." ADD `type` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon',  'ckey')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon')." ADD `ckey` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon',  'cvalue')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon')." ADD `cvalue` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon',  'nums')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon')." ADD `nums` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_sale_coupon',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_sale_coupon',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon_data',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon_data')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon_data',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon_data')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon_data',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon_data')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon_data',  'couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon_data')." ADD `couponid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon_data',  'gettime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon_data')." ADD `gettime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon_data',  'gettype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon_data')." ADD `gettype` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon_data',  'usedtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon_data')." ADD `usedtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sale_coupon_data',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon_data')." ADD `orderid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_sale_coupon_data',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon_data')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_sale_coupon_data',  'idx_couponid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon_data')." ADD KEY `idx_couponid` (`couponid`);");
}
if(!pdo_indexexists('ewei_shop_sale_coupon_data',  'idx_gettime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon_data')." ADD KEY `idx_gettime` (`gettime`);");
}
if(!pdo_indexexists('ewei_shop_sale_coupon_data',  'idx_gettype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon_data')." ADD KEY `idx_gettype` (`gettype`);");
}
if(!pdo_indexexists('ewei_shop_sale_coupon_data',  'idx_usedtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon_data')." ADD KEY `idx_usedtime` (`usedtime`);");
}
if(!pdo_indexexists('ewei_shop_sale_coupon_data',  'idx_orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sale_coupon_data')." ADD KEY `idx_orderid` (`orderid`);");
}
if(!pdo_fieldexists('ewei_shop_saler',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_saler')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_saler',  'storeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_saler')." ADD `storeid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_saler',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_saler')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_saler',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_saler')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_saler',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_saler')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_saler',  'salername')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_saler')." ADD `salername` varchar(255) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_saler',  'idx_storeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_saler')." ADD KEY `idx_storeid` (`storeid`);");
}
if(!pdo_indexexists('ewei_shop_saler',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_saler')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_seckill_adv',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_adv')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_seckill_adv',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_adv')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_adv',  'advname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_adv')." ADD `advname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_seckill_adv',  'link')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_adv')." ADD `link` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_seckill_adv',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_adv')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_seckill_adv',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_adv')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_adv',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_adv')." ADD `enabled` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_seckill_adv',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_adv')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_indexexists('ewei_shop_seckill_adv',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_adv')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_indexexists('ewei_shop_seckill_adv',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_adv')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_seckill_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_seckill_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_category')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_category')." ADD `name` varchar(255) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_seckill_category',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_category')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_seckill_task',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_seckill_task',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task',  'cateid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD `cateid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD `enabled` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task',  'page_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD `page_title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task',  'share_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD `share_title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task',  'share_desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD `share_desc` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task',  'share_icon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD `share_icon` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task',  'tag')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD `tag` varchar(10) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task',  'closesec')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD `closesec` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task',  'oldshow')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD `oldshow` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task',  'times')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD `times` text;");
}
if(!pdo_fieldexists('ewei_shop_seckill_task',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_seckill_task',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_seckill_task',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task')." ADD KEY `idx_status` (`enabled`);");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_goods',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_goods',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_goods',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_goods',  'taskid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD `taskid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_goods',  'roomid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD `roomid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_goods',  'timeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD `timeid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_goods',  'goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD `goodsid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_goods',  'optionid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD `optionid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_goods',  'price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD `price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_goods',  'total')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD `total` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_goods',  'maxbuy')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD `maxbuy` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_goods',  'totalmaxbuy')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD `totalmaxbuy` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_goods',  'commission1')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD `commission1` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_goods',  'commission2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD `commission2` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_goods',  'commission3')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD `commission3` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_indexexists('ewei_shop_seckill_task_goods',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_seckill_task_goods',  'idx_goodsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD KEY `idx_goodsid` (`goodsid`);");
}
if(!pdo_indexexists('ewei_shop_seckill_task_goods',  'idx_optionid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD KEY `idx_optionid` (`optionid`);");
}
if(!pdo_indexexists('ewei_shop_seckill_task_goods',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_indexexists('ewei_shop_seckill_task_goods',  'idx_taskid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD KEY `idx_taskid` (`taskid`);");
}
if(!pdo_indexexists('ewei_shop_seckill_task_goods',  'idx_roomid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD KEY `idx_roomid` (`roomid`);");
}
if(!pdo_indexexists('ewei_shop_seckill_task_goods',  'idx_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_goods')." ADD KEY `idx_time` (`timeid`);");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_room',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_room')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_room',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_room')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_room',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_room')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_room',  'taskid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_room')." ADD `taskid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_room',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_room')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_room',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_room')." ADD `enabled` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_room',  'page_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_room')." ADD `page_title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_room',  'share_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_room')." ADD `share_title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_room',  'share_desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_room')." ADD `share_desc` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_room',  'share_icon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_room')." ADD `share_icon` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_room',  'oldshow')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_room')." ADD `oldshow` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_room',  'tag')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_room')." ADD `tag` varchar(10) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_room',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_room')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_room',  'diypage')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_room')." ADD `diypage` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_seckill_task_room',  'idx_taskid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_room')." ADD KEY `idx_taskid` (`taskid`);");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_time',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_time')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_time',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_time')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_time',  'taskid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_time')." ADD `taskid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_seckill_task_time',  'time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_seckill_task_time')." ADD `time` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_records',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_records')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sign_records',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_records')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_records',  'time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_records')." ADD `time` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_records',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_records')." ADD `openid` varchar(50) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sign_records',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_records')." ADD `credit` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_records',  'log')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_records')." ADD `log` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sign_records',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_records')." ADD `type` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_records',  'day')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_records')." ADD `day` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_sign_records',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_records')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_sign_records',  'idx_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_records')." ADD KEY `idx_time` (`time`);");
}
if(!pdo_indexexists('ewei_shop_sign_records',  'idx_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_records')." ADD KEY `idx_type` (`type`);");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'iscenter')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `iscenter` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'iscreditshop')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `iscreditshop` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'keyword')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `keyword` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `title` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `thumb` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `desc` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'isopen')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `isopen` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'signold')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `signold` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'signold_price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `signold_price` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'signold_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `signold_type` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'textsign')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `textsign` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'textsignold')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `textsignold` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'textsigned')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `textsigned` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'textsignforget')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `textsignforget` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'maincolor')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `maincolor` varchar(20) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'cycle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `cycle` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'reward_default_first')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `reward_default_first` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'reward_default_day')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `reward_default_day` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'reword_order')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `reword_order` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'reword_sum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `reword_sum` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'reword_special')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `reword_special` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'sign_rule')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `sign_rule` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sign_set',  'share')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_set')." ADD `share` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_user',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_user')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sign_user',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_user')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_user',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_user')." ADD `openid` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sign_user',  'order')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_user')." ADD `order` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_user',  'orderday')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_user')." ADD `orderday` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_user',  'sum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_user')." ADD `sum` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sign_user',  'signdate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sign_user')." ADD `signdate` varchar(10) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sms',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sms',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms')." ADD `name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms')." ADD `type` varchar(10) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms',  'template')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms')." ADD `template` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sms',  'smstplid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms')." ADD `smstplid` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms',  'smssign')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms')." ADD `smssign` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms')." ADD `content` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms',  'data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms')." ADD `data` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sms',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms')." ADD `status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'juhe')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `juhe` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'juhe_key')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `juhe_key` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'dayu')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `dayu` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'dayu_key')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `dayu_key` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'dayu_secret')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `dayu_secret` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'emay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `emay` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'emay_url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `emay_url` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'emay_sn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `emay_sn` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'emay_pw')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `emay_pw` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'emay_sk')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `emay_sk` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'emay_phost')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `emay_phost` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'emay_pport')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `emay_pport` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'emay_puser')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `emay_puser` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'emay_ppw')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `emay_ppw` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'emay_out')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `emay_out` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'emay_outresp')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `emay_outresp` int(11) NOT NULL DEFAULT '30';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'emay_warn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `emay_warn` decimal(10,2) NOT NULL DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'emay_mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `emay_mobile` varchar(11) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sms_set',  'emay_warn_time')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sms_set')." ADD `emay_warn_time` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_adv',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_adv')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sns_adv',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_adv')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_adv',  'advname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_adv')." ADD `advname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_adv',  'link')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_adv')." ADD `link` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_adv',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_adv')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_adv',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_adv')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_adv',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_adv')." ADD `enabled` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_sns_adv',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_adv')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_sns_adv',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_adv')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_indexexists('ewei_shop_sns_adv',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_adv')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'cid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `cid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `title` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'logo')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `logo` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `desc` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `enabled` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'showgroups')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `showgroups` text;");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'showlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `showlevels` text;");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'postgroups')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `postgroups` text;");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'postlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `postlevels` text;");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'showagentlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `showagentlevels` text;");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'postagentlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `postagentlevels` text;");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'postcredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `postcredit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'replycredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `replycredit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'bestcredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `bestcredit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'bestboardcredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `bestboardcredit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'notagent')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `notagent` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'notagentpost')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `notagentpost` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'topcredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `topcredit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'topboardcredit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `topboardcredit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'noimage')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `noimage` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'novoice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `novoice` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'needfollow')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `needfollow` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'needpostfollow')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `needpostfollow` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'share_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `share_title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'share_icon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `share_icon` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'share_desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `share_desc` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'keyword')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `keyword` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `isrecommand` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'banner')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `banner` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'needcheck')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `needcheck` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'needcheckmanager')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `needcheckmanager` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'needcheckreply')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `needcheckreply` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'needcheckreplymanager')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `needcheckreplymanager` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'showsnslevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `showsnslevels` text;");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'postsnslevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `postsnslevels` text;");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'showpartnerlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `showpartnerlevels` text;");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'postpartnerlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `postpartnerlevels` text;");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'notpartner')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `notpartner` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board',  'notpartnerpost')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD `notpartnerpost` tinyint(3) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_sns_board',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_sns_board',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_indexexists('ewei_shop_sns_board',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_indexexists('ewei_shop_sns_board',  'idx_cid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board')." ADD KEY `idx_cid` (`cid`);");
}
if(!pdo_fieldexists('ewei_shop_sns_board_follow',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board_follow')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sns_board_follow',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board_follow')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board_follow',  'bid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board_follow')." ADD `bid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_board_follow',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board_follow')." ADD `openid` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sns_board_follow',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board_follow')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_sns_board_follow',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board_follow')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_sns_board_follow',  'idx_bid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_board_follow')." ADD KEY `idx_bid` (`bid`);");
}
if(!pdo_fieldexists('ewei_shop_sns_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sns_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_category')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_category')." ADD `name` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sns_category',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_category')." ADD `thumb` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sns_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_category')." ADD `displayorder` tinyint(3) unsigned DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_category',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_category')." ADD `enabled` tinyint(1) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_sns_category',  'advimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_category')." ADD `advimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_category',  'advurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_category')." ADD `advurl` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_category',  'isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_category')." ADD `isrecommand` tinyint(3) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_sns_category',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_category')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_sns_category',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_category')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_indexexists('ewei_shop_sns_category',  'idx_isrecommand')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_category')." ADD KEY `idx_isrecommand` (`isrecommand`);");
}
if(!pdo_indexexists('ewei_shop_sns_category',  'idx_displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_category')." ADD KEY `idx_displayorder` (`displayorder`);");
}
if(!pdo_fieldexists('ewei_shop_sns_complain',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complain')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sns_complain',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complain')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_complain',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complain')." ADD `type` tinyint(3) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sns_complain',  'postsid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complain')." ADD `postsid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_complain',  'defendant')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complain')." ADD `defendant` varchar(255) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_complain',  'complainant')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complain')." ADD `complainant` varchar(255) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_complain',  'complaint_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complain')." ADD `complaint_type` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_complain',  'complaint_text')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complain')." ADD `complaint_text` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sns_complain',  'images')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complain')." ADD `images` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sns_complain',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complain')." ADD `createtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_complain',  'checkedtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complain')." ADD `checkedtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_complain',  'checked')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complain')." ADD `checked` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_complain',  'checked_note')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complain')." ADD `checked_note` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sns_complain',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complain')." ADD `deleted` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_complaincate',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complaincate')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sns_complaincate',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complaincate')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sns_complaincate',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complaincate')." ADD `name` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sns_complaincate',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complaincate')." ADD `status` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_complaincate',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_complaincate')." ADD `displayorder` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_level',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_level')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sns_level',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_level')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_level',  'levelname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_level')." ADD `levelname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_level',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_level')." ADD `credit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_level',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_level')." ADD `enabled` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_level',  'post')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_level')." ADD `post` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_level',  'color')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_level')." ADD `color` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_level',  'bg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_level')." ADD `bg` varchar(255) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_sns_level',  'idx_enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_level')." ADD KEY `idx_enabled` (`enabled`);");
}
if(!pdo_fieldexists('ewei_shop_sns_like',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_like')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sns_like',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_like')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_like',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_like')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_like',  'pid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_like')." ADD `pid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_sns_like',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_like')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_sns_like',  'idx_pid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_like')." ADD KEY `idx_pid` (`pid`);");
}
if(!pdo_fieldexists('ewei_shop_sns_manage',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_manage')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sns_manage',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_manage')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_manage',  'bid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_manage')." ADD `bid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_manage',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_manage')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_manage',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_manage')." ADD `enabled` tinyint(3) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_sns_manage',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_manage')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_sns_manage',  'idx_bid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_manage')." ADD KEY `idx_bid` (`bid`);");
}
if(!pdo_fieldexists('ewei_shop_sns_member',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_member')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sns_member',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_member')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_member',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_member')." ADD `openid` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sns_member',  'level')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_member')." ADD `level` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_member',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_member')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_member',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_member')." ADD `credit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_member',  'sign')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_member')." ADD `sign` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_member',  'isblack')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_member')." ADD `isblack` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_member',  'notupgrade')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_member')." ADD `notupgrade` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'bid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `bid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'pid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `pid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'rpid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `rpid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `openid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'avatar')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `avatar` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `nickname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `title` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `content` text;");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'images')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `images` text;");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'voice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `voice` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'replytime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `replytime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'credit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `credit` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'views')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `views` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'islock')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `islock` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'istop')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `istop` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'isboardtop')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `isboardtop` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'isbest')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `isbest` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'isboardbest')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `isboardbest` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `deleted` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'deletedtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `deletedtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'checked')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `checked` tinyint(3) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'checktime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `checktime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sns_post',  'isadmin')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD `isadmin` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_sns_post',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_sns_post',  'idx_bid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD KEY `idx_bid` (`bid`);");
}
if(!pdo_indexexists('ewei_shop_sns_post',  'idx_pid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD KEY `idx_pid` (`pid`);");
}
if(!pdo_indexexists('ewei_shop_sns_post',  'idx_createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD KEY `idx_createtime` (`createtime`);");
}
if(!pdo_indexexists('ewei_shop_sns_post',  'idx_islock')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD KEY `idx_islock` (`islock`);");
}
if(!pdo_indexexists('ewei_shop_sns_post',  'idx_istop')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD KEY `idx_istop` (`istop`);");
}
if(!pdo_indexexists('ewei_shop_sns_post',  'idx_isboardtop')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD KEY `idx_isboardtop` (`isboardtop`);");
}
if(!pdo_indexexists('ewei_shop_sns_post',  'idx_isbest')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD KEY `idx_isbest` (`isbest`);");
}
if(!pdo_indexexists('ewei_shop_sns_post',  'idx_deleted')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD KEY `idx_deleted` (`deleted`);");
}
if(!pdo_indexexists('ewei_shop_sns_post',  'idx_deletetime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD KEY `idx_deletetime` (`deletedtime`);");
}
if(!pdo_indexexists('ewei_shop_sns_post',  'idx_checked')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD KEY `idx_checked` (`checked`);");
}
if(!pdo_indexexists('ewei_shop_sns_post',  'idx_rpid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sns_post')." ADD KEY `idx_rpid` (`rpid`);");
}
if(!pdo_fieldexists('ewei_shop_store',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_store',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_store',  'storename')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `storename` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_store',  'address')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `address` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_store',  'tel')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `tel` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_store',  'lat')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `lat` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_store',  'lng')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `lng` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_store',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_store',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `type` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_store',  'realname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `realname` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_store',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `mobile` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_store',  'fetchtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `fetchtime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_store',  'logo')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `logo` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_store',  'saletime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `saletime` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_store',  'desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `desc` text;");
}
if(!pdo_fieldexists('ewei_shop_store',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_store',  'order_printer')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `order_printer` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_store',  'order_template')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `order_template` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_store',  'ordertype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD `ordertype` varchar(500) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_store',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_store',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists('ewei_shop_sysset',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sysset')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_sysset',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sysset')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_sysset',  'sets')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sysset')." ADD `sets` longtext;");
}
if(!pdo_fieldexists('ewei_shop_sysset',  'plugins')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sysset')." ADD `plugins` longtext;");
}
if(!pdo_fieldexists('ewei_shop_sysset',  'sec')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sysset')." ADD `sec` text;");
}
if(!pdo_indexexists('ewei_shop_sysset',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_sysset')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_system_adv',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_adv')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_system_adv',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_adv')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_adv',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_adv')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_adv',  'url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_adv')." ADD `url` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_adv',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_adv')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_adv',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_adv')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_adv',  'module')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_adv')." ADD `module` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_adv',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_adv')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_article',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_article')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_system_article',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_article')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_article',  'author')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_article')." ADD `author` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_article',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_article')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_article',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_article')." ADD `content` text;");
}
if(!pdo_fieldexists('ewei_shop_system_article',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_article')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_article',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_article')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_article',  'cate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_article')." ADD `cate` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_article',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_article')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_banner',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_banner')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_system_banner',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_banner')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_banner',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_banner')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_banner',  'url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_banner')." ADD `url` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_banner',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_banner')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_banner',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_banner')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_banner',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_banner')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_banner',  'background')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_banner')." ADD `background` varchar(10) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_case',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_case')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_system_case',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_case')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_case',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_case')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_case',  'qr')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_case')." ADD `qr` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_case',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_case')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_case',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_case')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_case',  'cate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_case')." ADD `cate` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_case',  'description')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_case')." ADD `description` varchar(255) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_casecategory',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_casecategory')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_system_casecategory',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_casecategory')." ADD `name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_casecategory',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_casecategory')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_casecategory',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_casecategory')." ADD `status` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_system_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_category')." ADD `name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_category')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_category',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_category')." ADD `status` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_company_article',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_company_article')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_system_company_article',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_company_article')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_company_article',  'author')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_company_article')." ADD `author` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_company_article',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_company_article')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_company_article',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_company_article')." ADD `content` text;");
}
if(!pdo_fieldexists('ewei_shop_system_company_article',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_company_article')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_company_article',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_company_article')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_company_article',  'cate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_company_article')." ADD `cate` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_company_article',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_company_article')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_company_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_company_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_system_company_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_company_category')." ADD `name` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_company_category',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_company_category')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_company_category',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_company_category')." ADD `status` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_copyright',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_copyright')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_system_copyright',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_copyright')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_system_copyright',  'copyright')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_copyright')." ADD `copyright` text;");
}
if(!pdo_fieldexists('ewei_shop_system_copyright',  'bgcolor')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_copyright')." ADD `bgcolor` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_copyright',  'ismanage')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_copyright')." ADD `ismanage` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_copyright',  'logo')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_copyright')." ADD `logo` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_copyright',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_copyright')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_indexexists('ewei_shop_system_copyright',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_copyright')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_system_copyright_notice',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_copyright_notice')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_system_copyright_notice',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_copyright_notice')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_copyright_notice',  'author')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_copyright_notice')." ADD `author` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_copyright_notice',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_copyright_notice')." ADD `content` text;");
}
if(!pdo_fieldexists('ewei_shop_system_copyright_notice',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_copyright_notice')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_copyright_notice',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_copyright_notice')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_copyright_notice',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_copyright_notice')." ADD `status` tinyint(3) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_system_guestbook',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_guestbook')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_system_guestbook',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_guestbook')." ADD `title` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_guestbook',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_guestbook')." ADD `content` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_guestbook',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_guestbook')." ADD `nickname` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_guestbook',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_guestbook')." ADD `createtime` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_system_guestbook',  'email')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_guestbook')." ADD `email` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_guestbook',  'clientip')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_guestbook')." ADD `clientip` varchar(64) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_guestbook',  'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_guestbook')." ADD `mobile` varchar(11) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_link',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_link')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_system_link',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_link')." ADD `name` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_link',  'url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_link')." ADD `url` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_link',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_link')." ADD `thumb` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_link',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_link')." ADD `displayorder` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_system_link',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_link')." ADD `status` tinyint(3) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_system_setting',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_setting')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_system_setting',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_setting')." ADD `uniacid` int(10) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_system_setting',  'background')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_setting')." ADD `background` varchar(10) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_setting',  'casebanner')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_setting')." ADD `casebanner` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_setting',  'contact')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_setting')." ADD `contact` text;");
}
if(!pdo_fieldexists('ewei_shop_system_site',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_site')." ADD `id` int(11) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_system_site',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_site')." ADD `type` varchar(32) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_system_site',  'content')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_system_site')." ADD `content` text;");
}
if(!pdo_fieldexists('ewei_shop_task_adv',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_adv')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_task_adv',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_adv')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_adv',  'advname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_adv')." ADD `advname` varchar(50) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_task_adv',  'link')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_adv')." ADD `link` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_task_adv',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_adv')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_task_adv',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_adv')." ADD `displayorder` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_adv',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_adv')." ADD `enabled` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_default',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_default')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_task_default',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_default')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_default',  'data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_default')." ADD `data` text;");
}
if(!pdo_fieldexists('ewei_shop_task_default',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_default')." ADD `addtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_join',  'join_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_join')." ADD `join_id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_task_join',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_join')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_join',  'join_user')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_join')." ADD `join_user` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_task_join',  'task_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_join')." ADD `task_id` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_join',  'task_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_join')." ADD `task_type` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_join',  'needcount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_join')." ADD `needcount` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_join',  'completecount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_join')." ADD `completecount` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_join',  'reward_data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_join')." ADD `reward_data` text;");
}
if(!pdo_fieldexists('ewei_shop_task_join',  'is_reward')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_join')." ADD `is_reward` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_join',  'failtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_join')." ADD `failtime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_join',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_join')." ADD `addtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_joiner',  'complete_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_joiner')." ADD `complete_id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_task_joiner',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_joiner')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_joiner',  'task_user')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_joiner')." ADD `task_user` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_task_joiner',  'joiner_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_joiner')." ADD `joiner_id` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_task_joiner',  'join_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_joiner')." ADD `join_id` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_joiner',  'task_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_joiner')." ADD `task_id` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_joiner',  'task_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_joiner')." ADD `task_type` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_joiner',  'join_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_joiner')." ADD `join_status` tinyint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_task_joiner',  'addtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_joiner')." ADD `addtime` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_log',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_log')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_task_log',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_log')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_log',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_log')." ADD `openid` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_task_log',  'from_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_log')." ADD `from_openid` varchar(100) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_task_log',  'join_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_log')." ADD `join_id` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_log',  'taskid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_log')." ADD `taskid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_log',  'task_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_log')." ADD `task_type` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_log',  'subdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_log')." ADD `subdata` text;");
}
if(!pdo_fieldexists('ewei_shop_task_log',  'recdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_log')." ADD `recdata` text;");
}
if(!pdo_fieldexists('ewei_shop_task_log',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_log')." ADD `createtime` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'days')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `days` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `title` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'bg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `bg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `data` text;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'keyword')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `keyword` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'resptype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `resptype` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'resptext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `resptext` text;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'resptitle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `resptitle` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'respthumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `respthumb` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'respdesc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `respdesc` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'respurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `respurl` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `createtime` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'waittext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `waittext` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'oktext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `oktext` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'scantext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `scantext` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'beagent')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `beagent` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'bedown')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `bedown` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'timestart')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `timestart` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'timeend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `timeend` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'is_repeat')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `is_repeat` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'getposter')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `getposter` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `status` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'starttext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `starttext` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'endtext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `endtext` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'reward_data')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `reward_data` text;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'needcount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `needcount` tinyint(3) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'is_delete')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `is_delete` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'poster_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `poster_type` tinyint(1) DEFAULT '1';");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'reward_days')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `reward_days` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'titleicon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `titleicon` text;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'poster_banner')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `poster_banner` text;");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'is_goods')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `is_goods` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_poster',  'autoposter')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster')." ADD `autoposter` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster_qr',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster_qr')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_task_poster_qr',  'acid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster_qr')." ADD `acid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_poster_qr',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster_qr')." ADD `openid` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster_qr',  'posterid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster_qr')." ADD `posterid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_poster_qr',  'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster_qr')." ADD `type` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_poster_qr',  'sceneid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster_qr')." ADD `sceneid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_task_poster_qr',  'mediaid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster_qr')." ADD `mediaid` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster_qr',  'ticket')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster_qr')." ADD `ticket` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster_qr',  'url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster_qr')." ADD `url` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster_qr',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster_qr')." ADD `createtime` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster_qr',  'qrimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster_qr')." ADD `qrimg` varchar(1000) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster_qr',  'expire')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster_qr')." ADD `expire` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_task_poster_qr',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_task_poster_qr')." ADD `endtime` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_virtual_category',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_category')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_virtual_category',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_category')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_virtual_category',  'name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_category')." ADD `name` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_virtual_category',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_category')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_virtual_category',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_category')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_fieldexists('ewei_shop_virtual_data',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_data')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_virtual_data',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_data')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_virtual_data',  'typeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_data')." ADD `typeid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_virtual_data',  'pvalue')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_data')." ADD `pvalue` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_virtual_data',  'fields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_data')." ADD `fields` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_virtual_data',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_data')." ADD `openid` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_virtual_data',  'usetime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_data')." ADD `usetime` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_virtual_data',  'orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_data')." ADD `orderid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_virtual_data',  'ordersn')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_data')." ADD `ordersn` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_virtual_data',  'price')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_data')." ADD `price` decimal(10,2) DEFAULT '0.00';");
}
if(!pdo_fieldexists('ewei_shop_virtual_data',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_data')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_virtual_data',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_data')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_virtual_data',  'idx_typeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_data')." ADD KEY `idx_typeid` (`typeid`);");
}
if(!pdo_indexexists('ewei_shop_virtual_data',  'idx_usetime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_data')." ADD KEY `idx_usetime` (`usetime`);");
}
if(!pdo_indexexists('ewei_shop_virtual_data',  'idx_orderid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_data')." ADD KEY `idx_orderid` (`orderid`);");
}
if(!pdo_fieldexists('ewei_shop_virtual_type',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_type')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_virtual_type',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_type')." ADD `uniacid` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_virtual_type',  'cate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_type')." ADD `cate` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_virtual_type',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_type')." ADD `title` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('ewei_shop_virtual_type',  'fields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_type')." ADD `fields` text NOT NULL;");
}
if(!pdo_fieldexists('ewei_shop_virtual_type',  'usedata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_type')." ADD `usedata` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_virtual_type',  'alldata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_type')." ADD `alldata` int(11) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_shop_virtual_type',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_type')." ADD `merchid` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_shop_virtual_type',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_type')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_shop_virtual_type',  'idx_cate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_virtual_type')." ADD KEY `idx_cate` (`cate`);");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `uniacid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'card_id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `card_id` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `displayorder` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'catid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `catid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'card_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `card_type` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'logo_url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `logo_url` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'wxlogourl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `wxlogourl` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'brand_name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `brand_name` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'code_type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `code_type` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `title` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'color')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `color` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'notice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `notice` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'service_phone')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `service_phone` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'description')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `description` text;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'datetype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `datetype` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'begin_timestamp')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `begin_timestamp` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'end_timestamp')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `end_timestamp` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'fixed_term')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `fixed_term` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'fixed_begin_term')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `fixed_begin_term` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'quantity')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `quantity` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'total_quantity')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `total_quantity` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'use_limit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `use_limit` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'get_limit')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `get_limit` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'use_custom_code')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `use_custom_code` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'bind_openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `bind_openid` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'can_share')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `can_share` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'can_give_friend')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `can_give_friend` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'center_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `center_title` varchar(20) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'center_sub_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `center_sub_title` varchar(20) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'center_url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `center_url` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'setcustom')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `setcustom` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'custom_url_name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `custom_url_name` varchar(20) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'custom_url_sub_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `custom_url_sub_title` varchar(20) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'custom_url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `custom_url` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'setpromotion')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `setpromotion` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'promotion_url_name')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `promotion_url_name` varchar(20) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'promotion_url_sub_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `promotion_url_sub_title` varchar(20) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'promotion_url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `promotion_url` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'source')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `source` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'can_use_with_other_discount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `can_use_with_other_discount` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'setabstract')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `setabstract` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'abstract')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `abstract` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'abstractimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `abstractimg` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'icon_url_list')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `icon_url_list` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'accept_category')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `accept_category` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'reject_category')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `reject_category` varchar(50) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'least_cost')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `least_cost` decimal(10,2) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'reduce_cost')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `reduce_cost` decimal(10,2) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'discount')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `discount` decimal(10,2) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'limitgoodtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `limitgoodtype` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'limitgoodcatetype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `limitgoodcatetype` tinyint(1) unsigned DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'limitgoodcateids')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `limitgoodcateids` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'limitgoodids')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `limitgoodids` varchar(255) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'limitdiscounttype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `limitdiscounttype` tinyint(1) unsigned DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'merchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `merchid` int(11) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'gettype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `gettype` tinyint(3) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'islimitlevel')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `islimitlevel` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'limitmemberlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `limitmemberlevels` varchar(500) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'limitagentlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `limitagentlevels` varchar(500) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'limitpartnerlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `limitpartnerlevels` varchar(500) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'limitaagentlevels')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `limitaagentlevels` varchar(500) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'settitlecolor')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `settitlecolor` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'titlecolor')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `titlecolor` varchar(10) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'tagtitle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `tagtitle` varchar(20) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_shop_wxcard',  'use_condition')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_wxcard')." ADD `use_condition` tinyint(1) DEFAULT NULL;");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `rid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'description')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `description` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `starttime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `endtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'bgimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `bgimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'helpimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `helpimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'shareimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `shareimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'titleimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `titleimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'cameraimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `cameraimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'numberimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `numberimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'items')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `items` text COMMENT '物品';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'follow_url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `follow_url` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'follow_button')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `follow_button` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'share_url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `share_url` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'viewnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `viewnum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'share_desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `share_desc` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'share_icon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `share_icon` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'share_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `share_title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephoto_reply',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_takephoto_reply',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_takephoto_reply',  'idx_rid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD KEY `idx_rid` (`rid`);");
}
if(!pdo_indexexists('ewei_takephoto_reply',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephoto_reply')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists('ewei_takephotoa_fans',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_takephotoa_fans',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans')." ADD `rid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephotoa_fans',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans')." ADD `openid` varchar(255) DEFAULT '' COMMENT '用户openid';");
}
if(!pdo_fieldexists('ewei_takephotoa_fans',  'nickname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans')." ADD `nickname` varchar(255) DEFAULT '' COMMENT '用户昵称';");
}
if(!pdo_fieldexists('ewei_takephotoa_fans',  'headimgurl')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans')." ADD `headimgurl` varchar(255) DEFAULT '' COMMENT '用户头像';");
}
if(!pdo_fieldexists('ewei_takephotoa_fans',  'score')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans')." ADD `score` decimal(10,2) DEFAULT '0.00' COMMENT '平均';");
}
if(!pdo_fieldexists('ewei_takephotoa_fans',  'img')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans')." ADD `img` varchar(255) DEFAULT '' COMMENT '成绩截图';");
}
if(!pdo_fieldexists('ewei_takephotoa_fans',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans')." ADD `createtime` int(10) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_takephotoa_fans',  'idx_rid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans')." ADD KEY `idx_rid` (`rid`);");
}
if(!pdo_fieldexists('ewei_takephotoa_fans_score',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans_score')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_takephotoa_fans_score',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans_score')." ADD `rid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephotoa_fans_score',  'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans_score')." ADD `openid` varchar(255) DEFAULT '' COMMENT '用户openid';");
}
if(!pdo_fieldexists('ewei_takephotoa_fans_score',  'score')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans_score')." ADD `score` decimal(10,2) DEFAULT '0.00' COMMENT '平均';");
}
if(!pdo_fieldexists('ewei_takephotoa_fans_score',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans_score')." ADD `createtime` int(10) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephotoa_fans_score',  'img')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans_score')." ADD `img` varchar(255) DEFAULT '';");
}
if(!pdo_indexexists('ewei_takephotoa_fans_score',  'idx_rid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_fans_score')." ADD KEY `idx_rid` (`rid`);");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `rid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'description')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `description` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `thumb` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'starttime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `starttime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `endtime` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'bgimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `bgimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'helpimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `helpimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'shareimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `shareimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'titleimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `titleimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'cameraimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `cameraimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'numberimg')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `numberimg` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'items')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `items` text COMMENT '物品';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'follow_url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `follow_url` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'share_url')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `share_url` varchar(1000) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'viewnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `viewnum` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `status` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'share_desc')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `share_desc` varchar(500) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'share_icon')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `share_icon` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'share_title')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `share_title` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephotoa_reply',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD `createtime` int(11) DEFAULT '0';");
}
if(!pdo_indexexists('ewei_takephotoa_reply',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD KEY `idx_uniacid` (`uniacid`);");
}
if(!pdo_indexexists('ewei_takephotoa_reply',  'idx_rid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD KEY `idx_rid` (`rid`);");
}
if(!pdo_indexexists('ewei_takephotoa_reply',  'idx_status')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_reply')." ADD KEY `idx_status` (`status`);");
}
if(!pdo_fieldexists('ewei_takephotoa_sysset',  'id')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_sysset')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('ewei_takephotoa_sysset',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_sysset')." ADD `uniacid` int(11) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephotoa_sysset',  'oauth2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_sysset')." ADD `oauth2` tinyint(1) DEFAULT '0';");
}
if(!pdo_fieldexists('ewei_takephotoa_sysset',  'appid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_sysset')." ADD `appid` varchar(255) DEFAULT '';");
}
if(!pdo_fieldexists('ewei_takephotoa_sysset',  'appsecret')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_sysset')." ADD `appsecret` varchar(255) DEFAULT '';");
}
if(!pdo_indexexists('ewei_takephotoa_sysset',  'idx_uniacid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_takephotoa_sysset')." ADD KEY `idx_uniacid` (`uniacid`);");
}

?>