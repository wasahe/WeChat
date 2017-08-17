<?php

$sql =<<<EOF
CREATE TABLE IF NOT EXISTS `ims_junsion_album_album` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `openid` varchar(50) DEFAULT '',
  `passwd` varchar(20) DEFAULT '',
  `musicid` int(11) DEFAULT '0',
  `musicurl` varchar(250) DEFAULT '',
  `styleid` int(11) DEFAULT '0',
  `is_preview` int(11) DEFAULT '0',
  `clicknum` int(11) DEFAULT '0',
  `sharenum` int(11) DEFAULT '0',
  `pics` text,
  `a_status` tinyint(1) DEFAULT '0' COMMENT '是否禁用 0否 1是',
  `opening` tinyint(1) DEFAULT '0' COMMENT '是否公开',
  `createtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_junsion_album_cate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) DEFAULT '0',
  `type` tinyint(1) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `status` tinyint(1) DEFAULT '0',
  `displayorder` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_junsion_album_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `avatar` varchar(255) DEFAULT '',
  `nickname` varchar(50) DEFAULT '',
  `content` varchar(250) DEFAULT '' COMMENT '评论内容',
  `aid` int(10) DEFAULT '0' COMMENT '相册id',
  `createtime` int(11) DEFAULT '0' COMMENT '评论时间',
  `isshow` tinyint(1) DEFAULT '0' COMMENT '是否显示 0是 1否',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_junsion_album_feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `avatar` varchar(255) DEFAULT '',
  `nickname` varchar(50) DEFAULT '',
  `content` varchar(250) DEFAULT '' COMMENT '反馈内容',
  `type` tinyint(1) DEFAULT '0' COMMENT '反馈类型',
  `aid` int(10) DEFAULT '0' COMMENT '相册id',
  `createtime` int(11) DEFAULT '0' COMMENT '相册时间',
  `tel` varchar(50) DEFAULT '' COMMENT '联系方式',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_junsion_album_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `authopenid` varchar(50) DEFAULT '',
  `avatar` varchar(255) DEFAULT '',
  `buy_styleid` text,
  `nickname` varchar(50) DEFAULT '',
  `status` tinyint(1) DEFAULT '0',
  `createtime` int(10) DEFAULT '0',
  `curAlbum` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_junsion_album_music` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) DEFAULT '0',
  `cate` int(10) DEFAULT '0',
  `hots` int(11) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `status` tinyint(1) DEFAULT '0',
  `price` decimal(11,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_junsion_album_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) DEFAULT '0',
  `ordersn` varchar(50) DEFAULT '' COMMENT '订单号',
  `openid` varchar(50) DEFAULT '',
  `styleid` int(10) DEFAULT '0' COMMENT '模板id',
  `pay_money` decimal(11,2) DEFAULT '0.00' COMMENT '金额',
  `transid` varchar(50) NOT NULL DEFAULT '0' COMMENT '微信支付单号',
  `status` tinyint(1) DEFAULT '0' COMMENT '支付状态 0普通状态 1已支付',
  `createtime` int(11) DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_junsion_album_print_order` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `avatar` varchar(255) DEFAULT '',
  `nickname` varchar(50) DEFAULT '',
  `pics` text COMMENT '打印的相片',
  `printno` varchar(50) DEFAULT '' COMMENT '打印订单编号',
  `pay_money` decimal(11,2) DEFAULT '0.00' COMMENT '金额',
  `status` tinyint(1) DEFAULT '0' COMMENT '是否支付 0否 1是',
  `transid` varchar(50) DEFAULT '' COMMENT '支付流水号',
  `createtime` int(11) DEFAULT '0' COMMENT '时间',
  `tel` varchar(12) DEFAULT '' COMMENT '联系方式',
  `location_p` varchar(100) DEFAULT '' COMMENT '省',
  `location_c` varchar(100) DEFAULT '' COMMENT '市',
  `location_a` varchar(100) DEFAULT '' COMMENT '区',
  `address` varchar(200) DEFAULT '' COMMENT '详细地址',
  `expresssn` varchar(50) DEFAULT '' COMMENT '快递单号',
  `express` varchar(50) DEFAULT '' COMMENT '快递',
  `dispatch_price` int(10) DEFAULT '0' COMMENT '运费',
  `remark` varchar(250) DEFAULT '' COMMENT '留言',
  `username` varchar(150) DEFAULT '' COMMENT '联系人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_junsion_album_print_temp_order` (
  `id` int(11) DEFAULT '0',
  `sn` varchar(50) DEFAULT '0' COMMENT '临时订单号',
  KEY `sn` (`sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_junsion_album_reward` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `avatar` varchar(255) DEFAULT '',
  `nickname` varchar(50) DEFAULT '',
  `aid` int(10) DEFAULT '0' COMMENT '相册id',
  `reward_no` varchar(50) DEFAULT '' COMMENT '打赏编号',
  `pay_money` decimal(11,2) DEFAULT '0.00' COMMENT '金额',
  `pay_rate` decimal(11,2) DEFAULT '0.00' COMMENT '手续费',
  `pay_time` int(11) DEFAULT '0' COMMENT '打赏支付时间',
  `packet_time` int(11) DEFAULT '0' COMMENT '发红包时间',
  `pay_status` tinyint(1) DEFAULT '0' COMMENT '是否支付 0否 1是',
  `packet_status` tinyint(1) DEFAULT '0' COMMENT '是否发红包 0否 1是',
  `pay_batch` varchar(50) DEFAULT '' COMMENT '支付流水号号',
  `packet_batch` varchar(50) DEFAULT '' COMMENT '发红包流水号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_junsion_album_style` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) DEFAULT '0',
  `cate` int(10) DEFAULT '0',
  `hots` int(11) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `path` varchar(250) DEFAULT '',
  `status` tinyint(1) DEFAULT '0',
  `price` decimal(11,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_junsion_album_zan` (
  `openid` varchar(50) DEFAULT '',
  `aid` int(10) DEFAULT '0' COMMENT '相册id',
  `isshow` tinyint(1) DEFAULT '0' COMMENT '是否有效 0否 1是',
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
EOF;
pdo_run($sql);
