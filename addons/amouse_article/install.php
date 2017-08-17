<?php
if (!defined('IN_IA')) {
	die('Access Denied');
}
if (!pdo_tableexists('fineness_article')) {
	$sql = "CREATE TABLE IF NOT EXISTS " . tablename('fineness_article') . " (
	  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `weid` int(10) unsigned NOT NULL,
	  `title` varchar(100) NOT NULL DEFAULT '',
	  `musicurl` varchar(100) NOT NULL DEFAULT '' COMMENT '上传音乐',
	  `content` mediumtext,
	  `credit` varchar(255) DEFAULT '0',
	  `pcate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '一级分类',
	  `ccate` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '二级分类',
	  `template` varchar(300) NOT NULL DEFAULT '' COMMENT '内容模板目录',
	  `templatefile` varchar(300) NOT NULL DEFAULT '' COMMENT '分类模板名称',
	  `bg_music_switch` varchar(1) NOT NULL DEFAULT '1',
	  `kid` int(10) unsigned NOT NULL,
	  `rid` int(10) unsigned NOT NULL,
	  `type` varchar(10) NOT NULL,
	  `clickNum` int(10) unsigned NOT NULL DEFAULT '0',
	  `zanNum` int(10) unsigned NOT NULL DEFAULT '0',
	  `thumb` varchar(500) NOT NULL DEFAULT '' COMMENT '缩略图',
	  `tel` varchar(15) NOT NULL DEFAULT '' COMMENT '缩略图',
	  `description` varchar(500) NOT NULL DEFAULT '' COMMENT '简介',
	  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
	  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
	  `outLink` varchar(500) DEFAULT '0' COMMENT '外链',
	  `author` varchar(100) DEFAULT '' COMMENT '作者',
	  `iscomment` varchar(1) default '1' COMMENT '是否评论',
	  PRIMARY KEY (`id`),
	  KEY `idx_uniacid` (`weid`),
	  KEY `idx_pcate` (`pcate`),
	  KEY `idx_ccate` (`ccate`),
	  KEY `idx_createtime` (`createtime`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
	pdo_query($sql);

	$sql = "CREATE TABLE IF NOT EXISTS ".tablename('fineness_article_category')."(
	  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `uniacid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
	  `name` varchar(50) NOT NULL COMMENT '分类名称',
	  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级',
	  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
	  `thumb` varchar(1024) NOT NULL DEFAULT '' COMMENT '分类图片',
	  `kid` int(10) unsigned NOT NULL,
	  `rid` int(10) unsigned NOT NULL,
	  `type` varchar(10) NOT NULL,
	  `description` varchar(100) NOT NULL DEFAULT '' COMMENT '分类描述',
	  `template` VARCHAR(300) NOT NULL DEFAULT '' COMMENT '分类模板目录',
	  `templatefile` VARCHAR(300) NOT NULL DEFAULT '' COMMENT '分类模板名称',
	  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
	   PRIMARY KEY (`id`),
	  KEY `idx_uniacid` (`uniacid`),
	  KEY `idx_type` (`type`),
	  KEY `idx_createtime` (`createtime`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
	pdo_query($sql);

	$sql = "CREATE TABLE  IF NOT EXISTS " . tablename('fineness_adv') . "(
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `weid` int(11) default 0,
	  `pid` int(11) default 0,
	  `link` varchar(255) DEFAULT '',
	  `title` varchar(255) DEFAULT '',
	  `thumb` varchar(255) DEFAULT '',
	  PRIMARY KEY (`id`),
	  KEY `idx_weid` (`weid`),
	  KEY `idx_pid` (`pid`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

	$sql = "CREATE TABLE  IF NOT EXISTS " . tablename('fineness_sysset') . " (
	  `id` int(11)  AUTO_INCREMENT,
	  `weid` int(11) DEFAULT 0 ,
	  `guanzhuUrl` varchar(255) DEFAULT '' comment '引导关注',
	  `guanzhutitle` varchar(255) DEFAULT '' comment '引导关注名称',
	  `historyUrl` varchar(255) DEFAULT '' comment '历史记录外链',
	  `copyright` varchar(255) DEFAULT '' comment '版权',
	  `cnzz` varchar(800) DEFAULT '' comment '统计',
	  `appid` varchar(255) default '',
	  `logo` varchar(255) default '',
	  `footlogo` varchar(255) default '',
	  `appsecret` varchar(255) default '',
	  `appid_share` varchar(255) default '',
	  `isopen` varchar(1) default '1',
	  `isget` varchar(1) default '0' comment '是否开启授权获取昵称',
	  `iscomment` varchar(1) default '1',
	  `title` varchar(255) default '',
	  `tjgzh` varchar(255) DEFAULT '1' comment '推荐公众号图片',
	  `tjgzhUrl` varchar(255) DEFAULT '1' comment '推荐公众号引导关注',
	  `appsecret_share` varchar(255) default '',
	  PRIMARY KEY (`id`),
	  KEY `indx_weid` (`weid`)
   ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
	pdo_query($sql);

	$sql="CREATE TABLE  IF NOT EXISTS ".tablename('fineness_adv_er')." (
	  `id` int(11)  AUTO_INCREMENT,
	  `weid` int(11) DEFAULT 0 ,
	  `title` varchar(255) NOT NULL COMMENT '广告标题',
	  `thumb` varchar(500) NOT NULL COMMENT '广告图片',
	  `link` varchar(500) NOT NULL COMMENT '广告外链',
	  `type` tinyint(1) unsigned NOT NULL COMMENT '0商品推广1推荐公众',
	  `description` varchar(500) NOT NULL COMMENT '广告外链',
	  `status` varchar(2) NOT NULL COMMENT '是否显示',
	  `createtime` int(10) NOT NULL,
	  PRIMARY KEY (`id`),
	  KEY `indx_weid` (`weid`)
   ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
	pdo_query($sql);

	$sql="CREATE TABLE  IF NOT EXISTS ".tablename('wx_tuijian')." (
	 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `weid` int(10) unsigned NOT NULL,
	  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '公众号名称',
	  `description` varchar(100) NOT NULL DEFAULT '' COMMENT '公众号名称',
	  `guanzhuUrl` varchar(255) NOT NULL DEFAULT '' COMMENT '引导关注',
	  `type` varchar(1)  NOT NULL DEFAULT '1',
	  `clickNum` int(10) unsigned NOT NULL  DEFAULT '0',
	  `ipclient` varchar(50) NOT NULL DEFAULT '' COMMENT 'ip',
	  `thumb` varchar(500) NOT NULL DEFAULT '' COMMENT '缩略图',
	  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
	  `hot` int(1) NOT NULL COMMENT '是否热门 0默认 1热门',
      PRIMARY KEY (`id`),
	  KEY `indx_weid` (`weid`)
   ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
	pdo_query($sql);

   $sql="CREATE TABLE  IF NOT EXISTS ".tablename('fineness_comment')." (
	 `id` int(11) NOT NULL AUTO_INCREMENT,
	  `weid` int(10) unsigned NOT NULL,
	  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章ID',
	  `author` varchar(255) NOT NULL COMMENT '昵称',
	  `openid` varchar(255) NOT NULL COMMENT '昵称',
	  `thumb` varchar(500) NOT NULL COMMENT '头像',
	  `js_cmt_input` varchar(500) NOT NULL COMMENT '留言内容',
	  `js_cmt_reply` varchar(500) NOT NULL COMMENT '回复内容',
	  `status` varchar(2) NOT NULL COMMENT '是否显示',
	  `praise_num` int(10) unsigned NOT NULL  DEFAULT '0',
	  `createtime` int(10) NOT NULL,
	  `updatetime` int(10) NOT NULL,
      PRIMARY KEY (`id`),
	  KEY `indx_weid` (`weid`)
   ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
	pdo_query($sql);
}