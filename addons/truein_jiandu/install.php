<?php
pdo_query(
"DROP TABLE IF EXISTS `ims_truein_jiandu_ad`;

CREATE TABLE `ims_truein_jiandu_ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  `thumb` varchar(500) NOT NULL DEFAULT '',
  `share_num` int(10) DEFAULT '0' COMMENT '分享文章数',
  `weid` int(10) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL COMMENT '广告描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*Table structure for table `ims_truein_jiandu_logs` */

DROP TABLE IF EXISTS `ims_truein_jiandu_logs`;

CREATE TABLE `ims_truein_jiandu_logs` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `share_id` varchar(50) DEFAULT NULL COMMENT '分享记录id',
  `read_user` varchar(100) DEFAULT NULL COMMENT '阅读者openid',
  `headimgurl` varchar(200) DEFAULT NULL,
  `nickname` varchar(100) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `datetime` varchar(50) DEFAULT NULL COMMENT '阅读时间',
  `read` int(5) DEFAULT '0' COMMENT '是否阅读',
  `click` int(5) DEFAULT '0' COMMENT '是否点击',
  `share` int(5) DEFAULT '0' COMMENT '是否分享',
  `from_ip` varchar(50) DEFAULT NULL COMMENT '来源ip',
  `from_os` varchar(100) DEFAULT NULL COMMENT '来源操作系统',
  `from_container` varchar(100) DEFAULT NULL COMMENT '来源机型',
  `from_openid` varchar(200) DEFAULT NULL COMMENT '来源openid',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*Table structure for table `ims_truein_jiandu_medies` */

DROP TABLE IF EXISTS `ims_truein_jiandu_medies`;

CREATE TABLE `ims_truein_jiandu_medies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `content` text,
  `share_desc` varchar(255) DEFAULT NULL COMMENT '分享摘要',
  `share_image` varchar(255) DEFAULT NULL COMMENT '分享图片',
  `datetime` varchar(50) DEFAULT NULL COMMENT '添加时间',
  `status` tinyint(2) DEFAULT '1' COMMENT '1正常 0禁止分享',
  `default_read` int(10) DEFAULT '0' COMMENT '默认阅读数',
  `default_praise` int(10) DEFAULT '0' COMMENT '默认点赞数',
  `tousu` int(5) DEFAULT '0' COMMENT '投诉人次',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*Table structure for table `ims_truein_jiandu_reply` */

DROP TABLE IF EXISTS `ims_truein_jiandu_reply`;

CREATE TABLE `ims_truein_jiandu_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `rid` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `starttime` int(10) NOT NULL DEFAULT '0',
  `endtime` int(10) NOT NULL DEFAULT '0',
  `aid` int(10) DEFAULT NULL COMMENT '编号',
  `appid` varchar(250) DEFAULT NULL COMMENT 'appid',
  `secret` varchar(250) DEFAULT NULL COMMENT 'secret',
  `needfollow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '强制关注',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `cover` varchar(255) DEFAULT NULL COMMENT '封面',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `weid` int(10) DEFAULT NULL,
  `gift` text COMMENT '奖励规则',
  `help` text COMMENT '帮助文档',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*Table structure for table `ims_truein_jiandu_share` */

DROP TABLE IF EXISTS `ims_truein_jiandu_share`;

CREATE TABLE `ims_truein_jiandu_share` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `staffid` int(10) DEFAULT NULL COMMENT '用户id',
  `rid` int(10) DEFAULT NULL COMMENT '活动id',
  `uniacid` int(10) DEFAULT NULL COMMENT '公众号id',
  `mediaid` int(10) DEFAULT NULL COMMENT '文章id',
  `adid` int(10) DEFAULT NULL COMMENT '广告id',
  `sharecount` int(10) DEFAULT '0' COMMENT '分享次数',
  `readcount` int(10) DEFAULT '1' COMMENT '阅读数',
  `click` int(10) DEFAULT '0' COMMENT '广告点击数',
  `status` tinyint(2) DEFAULT '1',
  `datetime` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

/*Table structure for table `ims_truein_jiandu_staff` */

DROP TABLE IF EXISTS `ims_truein_jiandu_staff`;

CREATE TABLE `ims_truein_jiandu_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '' COMMENT '用户ID',
  `nickname` varchar(50) DEFAULT '',
  `headimgurl` varchar(500) DEFAULT '',
  `username` varchar(50) DEFAULT '',
  `mobile` varchar(50) DEFAULT '',
  `address` varchar(200) DEFAULT '',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '性别',
  `country` varchar(50) DEFAULT '',
  `province` varchar(50) DEFAULT '',
  `city` varchar(50) DEFAULT '',
  `qrcode` varchar(500) DEFAULT '',
  `is_vip` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1' COMMENT '是否禁用 0为禁用',
  `datetime` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;"
);