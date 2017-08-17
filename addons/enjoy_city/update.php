<?php
//012wz.com
//微赞
pdo_query("CREATE TABLE IF NOT EXISTS `ims_enjoy_city_ad` (
  `id` int(200) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(50) unsigned DEFAULT NULL,
  `hot` int(5) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `url` longtext,
  `pic` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_enjoy_city_contact` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `uniacid` int(50) DEFAULT NULL,
  `hot` int(50) DEFAULT NULL,
  `cgender` int(2) DEFAULT NULL,
  `cavatar` longtext,
  `cewm` longtext,
  `cnickname` varchar(50) DEFAULT NULL,
  `cweixin` varchar(50) DEFAULT NULL,
  `descript` varchar(1000) DEFAULT NULL,
  `addtime` varchar(50) DEFAULT NULL,
  `ischeck` int(2) DEFAULT NULL,
  `uid` int(255) DEFAULT NULL,
  `kind` int(2) DEFAULT NULL,
  `checktime` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_enjoy_city_fans` (
  `uid` int(255) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) unsigned NOT NULL,
  `huid` int(255) NOT NULL DEFAULT '0',
  `openid` varchar(40) NOT NULL DEFAULT '',
  `proxy` varchar(40) NOT NULL DEFAULT '',
  `unionid` varchar(40) NOT NULL DEFAULT '',
  `nickname` varchar(20) NOT NULL DEFAULT '',
  `gender` varchar(2) DEFAULT '',
  `state` varchar(20) NOT NULL DEFAULT '',
  `city` varchar(20) NOT NULL DEFAULT '',
  `country` varchar(20) NOT NULL DEFAULT '',
  `avatar` varchar(500) NOT NULL DEFAULT '',
  `subscribe` int(2) DEFAULT NULL,
  `subscribe_time` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `ewm` varchar(500) DEFAULT NULL,
  `weixin` varchar(100) DEFAULT NULL,
  `descript` varchar(1000) DEFAULT NULL,
  `addtime` varchar(50) DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `ischeck` int(2) NOT NULL DEFAULT '0',
  `createtime` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `uniacid` (`uniacid`),
  KEY `openid` (`openid`),
  KEY `proxy` (`proxy`),
  KEY `nickname` (`nickname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_enjoy_city_fansxx` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(50) DEFAULT NULL,
  `fid` int(255) DEFAULT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `intro` longtext,
  `createtime` varchar(50) DEFAULT NULL,
  `overtime` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_enjoy_city_fimg` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(50) DEFAULT NULL,
  `fid` int(200) DEFAULT NULL,
  `imgurl` varchar(1000) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `createtime` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_enjoy_city_firm` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(50) DEFAULT NULL,
  `hot` int(50) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `parentid` int(50) DEFAULT NULL,
  `childid` int(50) DEFAULT NULL,
  `tel` varchar(30) DEFAULT NULL,
  `intro` longtext,
  `ischeck` int(2) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `location_x` varchar(50) DEFAULT NULL,
  `location_y` varchar(50) DEFAULT NULL,
  `img` varchar(500) DEFAULT NULL,
  `icon` varchar(500) DEFAULT NULL,
  `uid` varchar(255) NOT NULL DEFAULT '0',
  `isrank` int(2) NOT NULL DEFAULT '0',
  `ismoney` int(2) NOT NULL DEFAULT '0',
  `stime` varchar(50) DEFAULT NULL,
  `etime` varchar(50) DEFAULT NULL,
  `browse` int(255) NOT NULL DEFAULT '0',
  `forward` int(255) NOT NULL DEFAULT '0',
  `wei_num` varchar(200) DEFAULT NULL,
  `wei_name` varchar(200) DEFAULT NULL,
  `wei_sex` int(2) DEFAULT NULL,
  `wei_intro` varchar(1000) DEFAULT NULL,
  `wei_avatar` varchar(2000) DEFAULT NULL,
  `wei_ewm` varchar(2000) DEFAULT NULL,
  `s_name` varchar(200) DEFAULT NULL,
  `createtime` varchar(50) DEFAULT NULL,
  `sid` int(50) DEFAULT NULL,
  `ispay` int(2) NOT NULL DEFAULT '0',
  `paymoney` float(50,2) DEFAULT NULL,
  `breaks` longtext,
  `firmurl` varchar(5000) DEFAULT NULL,
  `rid` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_enjoy_city_firmfans` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(50) DEFAULT NULL,
  `fid` int(255) DEFAULT NULL,
  `rid` int(255) DEFAULT NULL,
  `openid` varchar(500) DEFAULT NULL,
  `createtime` varchar(50) DEFAULT NULL,
  `favatar` longtext,
  `fnickname` varchar(500) DEFAULT NULL,
  `flag` int(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_enjoy_city_forward` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(50) DEFAULT NULL,
  `fid` int(200) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `createtime` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_enjoy_city_kind` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(50) DEFAULT NULL,
  `hot` int(50) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `thumb` varchar(1000) DEFAULT NULL,
  `parentid` int(50) DEFAULT NULL,
  `wurl` varchar(1000) DEFAULT NULL,
  `enabled` int(2) NOT NULL DEFAULT '0' COMMENT '0显示1不显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_enjoy_city_pics` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(50) DEFAULT NULL,
  `fid` int(100) DEFAULT NULL,
  `picurl` varchar(1000) DEFAULT NULL,
  `createtime` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_enjoy_city_reply` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(50) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `icon` longtext,
  `ewm` longtext,
  `slogo` longtext,
  `sucai` longtext,
  `share_title` varchar(500) DEFAULT NULL,
  `share_icon` varchar(500) DEFAULT NULL,
  `share_content` varchar(1000) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `copyright` varchar(500) DEFAULT NULL,
  `agreement` longtext,
  `weixin` varchar(200) DEFAULT NULL,
  `createtime` varchar(50) DEFAULT NULL,
  `fee` varchar(200) NOT NULL DEFAULT '200',
  `mshare_title` varchar(500) DEFAULT NULL,
  `mshare_icon` varchar(500) DEFAULT NULL,
  `mshare_content` varchar(1000) DEFAULT NULL,
  `jointel` varchar(1000) DEFAULT NULL,
  `banner` longtext,
  `onlinepay` int(2) NOT NULL DEFAULT '0',
  `bonus` longtext,
  `kfewm` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_enjoy_city_seller` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(50) DEFAULT NULL,
  `realname` varchar(500) DEFAULT NULL,
  `openid` varchar(1000) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `createtime` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");
if (pdo_tableexists('enjoy_city_ad')) {
    if (!pdo_fieldexists('enjoy_city_ad', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_ad') . " ADD `id` int(200) unsigned NOT NULL auto_increment  COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_ad')) {
    if (!pdo_fieldexists('enjoy_city_ad', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_ad') . " ADD `uniacid` int(50) unsigned    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_ad')) {
    if (!pdo_fieldexists('enjoy_city_ad', 'hot')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_ad') . " ADD `hot` int(5)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_ad')) {
    if (!pdo_fieldexists('enjoy_city_ad', 'title')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_ad') . " ADD `title` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_ad')) {
    if (!pdo_fieldexists('enjoy_city_ad', 'url')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_ad') . " ADD `url` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_ad')) {
    if (!pdo_fieldexists('enjoy_city_ad', 'pic')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_ad') . " ADD `pic` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_contact')) {
    if (!pdo_fieldexists('enjoy_city_contact', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_contact') . " ADD `id` int(255) NOT NULL auto_increment  COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_contact')) {
    if (!pdo_fieldexists('enjoy_city_contact', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_contact') . " ADD `uniacid` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_contact')) {
    if (!pdo_fieldexists('enjoy_city_contact', 'hot')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_contact') . " ADD `hot` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_contact')) {
    if (!pdo_fieldexists('enjoy_city_contact', 'cgender')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_contact') . " ADD `cgender` int(2)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_contact')) {
    if (!pdo_fieldexists('enjoy_city_contact', 'cavatar')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_contact') . " ADD `cavatar` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_contact')) {
    if (!pdo_fieldexists('enjoy_city_contact', 'cewm')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_contact') . " ADD `cewm` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_contact')) {
    if (!pdo_fieldexists('enjoy_city_contact', 'cnickname')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_contact') . " ADD `cnickname` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_contact')) {
    if (!pdo_fieldexists('enjoy_city_contact', 'cweixin')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_contact') . " ADD `cweixin` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_contact')) {
    if (!pdo_fieldexists('enjoy_city_contact', 'descript')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_contact') . " ADD `descript` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_contact')) {
    if (!pdo_fieldexists('enjoy_city_contact', 'addtime')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_contact') . " ADD `addtime` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_contact')) {
    if (!pdo_fieldexists('enjoy_city_contact', 'ischeck')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_contact') . " ADD `ischeck` int(2)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_contact')) {
    if (!pdo_fieldexists('enjoy_city_contact', 'uid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_contact') . " ADD `uid` int(255)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_contact')) {
    if (!pdo_fieldexists('enjoy_city_contact', 'kind')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_contact') . " ADD `kind` int(2)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_contact')) {
    if (!pdo_fieldexists('enjoy_city_contact', 'checktime')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_contact') . " ADD `checktime` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'uid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `uid` int(255) NOT NULL auto_increment  COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `uniacid` int(11) unsigned NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'huid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `huid` int(255) NOT NULL  DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'openid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `openid` varchar(40) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'proxy')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `proxy` varchar(40) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'unionid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `unionid` varchar(40) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'nickname')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `nickname` varchar(20) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'gender')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `gender` varchar(2)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'state')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `state` varchar(20) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'city')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `city` varchar(20) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'country')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `country` varchar(20) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'avatar')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `avatar` varchar(500) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'subscribe')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `subscribe` int(2)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'subscribe_time')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `subscribe_time` varchar(100)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'username')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `username` varchar(100)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'password')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `password` varchar(100)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'ewm')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `ewm` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'weixin')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `weixin` varchar(100)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'descript')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `descript` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'addtime')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `addtime` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'type')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `type` int(2)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'mobile')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `mobile` varchar(30)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'ip')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `ip` varchar(100)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'ischeck')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `ischeck` int(2) NOT NULL  DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fans')) {
    if (!pdo_fieldexists('enjoy_city_fans', 'createtime')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fans') . " ADD `createtime` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fansxx')) {
    if (!pdo_fieldexists('enjoy_city_fansxx', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fansxx') . " ADD `id` int(255) unsigned NOT NULL auto_increment  COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fansxx')) {
    if (!pdo_fieldexists('enjoy_city_fansxx', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fansxx') . " ADD `uniacid` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fansxx')) {
    if (!pdo_fieldexists('enjoy_city_fansxx', 'fid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fansxx') . " ADD `fid` int(255)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fansxx')) {
    if (!pdo_fieldexists('enjoy_city_fansxx', 'title')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fansxx') . " ADD `title` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fansxx')) {
    if (!pdo_fieldexists('enjoy_city_fansxx', 'intro')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fansxx') . " ADD `intro` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fansxx')) {
    if (!pdo_fieldexists('enjoy_city_fansxx', 'createtime')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fansxx') . " ADD `createtime` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fansxx')) {
    if (!pdo_fieldexists('enjoy_city_fansxx', 'overtime')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fansxx') . " ADD `overtime` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fimg')) {
    if (!pdo_fieldexists('enjoy_city_fimg', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fimg') . " ADD `id` int(255) unsigned NOT NULL auto_increment  COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fimg')) {
    if (!pdo_fieldexists('enjoy_city_fimg', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fimg') . " ADD `uniacid` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fimg')) {
    if (!pdo_fieldexists('enjoy_city_fimg', 'fid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fimg') . " ADD `fid` int(200)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fimg')) {
    if (!pdo_fieldexists('enjoy_city_fimg', 'imgurl')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fimg') . " ADD `imgurl` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fimg')) {
    if (!pdo_fieldexists('enjoy_city_fimg', 'title')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fimg') . " ADD `title` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_fimg')) {
    if (!pdo_fieldexists('enjoy_city_fimg', 'createtime')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_fimg') . " ADD `createtime` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `id` int(255) unsigned NOT NULL auto_increment  COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `uniacid` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'hot')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `hot` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'title')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `title` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'parentid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `parentid` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'childid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `childid` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'tel')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `tel` varchar(30)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'intro')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `intro` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'ischeck')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `ischeck` int(2)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'province')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `province` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'city')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `city` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'district')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `district` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'address')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `address` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'location_x')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `location_x` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'location_y')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `location_y` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'img')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `img` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'icon')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `icon` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'uid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `uid` varchar(255) NOT NULL  DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'isrank')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `isrank` int(2) NOT NULL  DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'ismoney')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `ismoney` int(2) NOT NULL  DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'stime')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `stime` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'etime')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `etime` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'browse')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `browse` int(255) NOT NULL  DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'forward')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `forward` int(255) NOT NULL  DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'wei_num')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `wei_num` varchar(200)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'wei_name')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `wei_name` varchar(200)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'wei_sex')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `wei_sex` int(2)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'wei_intro')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `wei_intro` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'wei_avatar')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `wei_avatar` varchar(2000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'wei_ewm')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `wei_ewm` varchar(2000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 's_name')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `s_name` varchar(200)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'createtime')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `createtime` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'sid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `sid` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'ispay')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `ispay` int(2) NOT NULL  DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'paymoney')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `paymoney` float(50,2)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'breaks')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `breaks` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'firmurl')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `firmurl` varchar(5000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firm')) {
    if (!pdo_fieldexists('enjoy_city_firm', 'rid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firm') . " ADD `rid` int(255)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firmfans')) {
    if (!pdo_fieldexists('enjoy_city_firmfans', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firmfans') . " ADD `id` int(255) unsigned NOT NULL auto_increment  COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firmfans')) {
    if (!pdo_fieldexists('enjoy_city_firmfans', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firmfans') . " ADD `uniacid` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firmfans')) {
    if (!pdo_fieldexists('enjoy_city_firmfans', 'fid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firmfans') . " ADD `fid` int(255)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firmfans')) {
    if (!pdo_fieldexists('enjoy_city_firmfans', 'rid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firmfans') . " ADD `rid` int(255)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firmfans')) {
    if (!pdo_fieldexists('enjoy_city_firmfans', 'openid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firmfans') . " ADD `openid` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firmfans')) {
    if (!pdo_fieldexists('enjoy_city_firmfans', 'createtime')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firmfans') . " ADD `createtime` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firmfans')) {
    if (!pdo_fieldexists('enjoy_city_firmfans', 'favatar')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firmfans') . " ADD `favatar` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firmfans')) {
    if (!pdo_fieldexists('enjoy_city_firmfans', 'fnickname')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firmfans') . " ADD `fnickname` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_firmfans')) {
    if (!pdo_fieldexists('enjoy_city_firmfans', 'flag')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_firmfans') . " ADD `flag` int(2)   DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_forward')) {
    if (!pdo_fieldexists('enjoy_city_forward', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_forward') . " ADD `id` int(255) unsigned NOT NULL auto_increment  COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_forward')) {
    if (!pdo_fieldexists('enjoy_city_forward', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_forward') . " ADD `uniacid` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_forward')) {
    if (!pdo_fieldexists('enjoy_city_forward', 'fid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_forward') . " ADD `fid` int(200)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_forward')) {
    if (!pdo_fieldexists('enjoy_city_forward', 'ip')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_forward') . " ADD `ip` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_forward')) {
    if (!pdo_fieldexists('enjoy_city_forward', 'createtime')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_forward') . " ADD `createtime` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_kind')) {
    if (!pdo_fieldexists('enjoy_city_kind', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_kind') . " ADD `id` int(255) unsigned NOT NULL auto_increment  COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_kind')) {
    if (!pdo_fieldexists('enjoy_city_kind', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_kind') . " ADD `uniacid` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_kind')) {
    if (!pdo_fieldexists('enjoy_city_kind', 'hot')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_kind') . " ADD `hot` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_kind')) {
    if (!pdo_fieldexists('enjoy_city_kind', 'name')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_kind') . " ADD `name` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_kind')) {
    if (!pdo_fieldexists('enjoy_city_kind', 'thumb')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_kind') . " ADD `thumb` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_kind')) {
    if (!pdo_fieldexists('enjoy_city_kind', 'parentid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_kind') . " ADD `parentid` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_kind')) {
    if (!pdo_fieldexists('enjoy_city_kind', 'wurl')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_kind') . " ADD `wurl` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_kind')) {
    if (!pdo_fieldexists('enjoy_city_kind', 'enabled')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_kind') . " ADD `enabled` int(2) NOT NULL  DEFAULT 0 COMMENT '0显示1不显示';");
    }
}
if (pdo_tableexists('enjoy_city_pics')) {
    if (!pdo_fieldexists('enjoy_city_pics', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_pics') . " ADD `id` int(255) unsigned NOT NULL auto_increment  COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_pics')) {
    if (!pdo_fieldexists('enjoy_city_pics', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_pics') . " ADD `uniacid` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_pics')) {
    if (!pdo_fieldexists('enjoy_city_pics', 'fid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_pics') . " ADD `fid` int(100)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_pics')) {
    if (!pdo_fieldexists('enjoy_city_pics', 'picurl')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_pics') . " ADD `picurl` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_pics')) {
    if (!pdo_fieldexists('enjoy_city_pics', 'createtime')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_pics') . " ADD `createtime` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `id` int(50) unsigned NOT NULL auto_increment  COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `uniacid` int(50) NOT NULL   COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'title')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `title` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'icon')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `icon` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'ewm')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `ewm` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'slogo')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `slogo` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'sucai')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `sucai` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'share_title')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `share_title` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'share_icon')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `share_icon` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'share_content')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `share_content` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'province')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `province` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'city')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `city` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'district')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `district` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'tel')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `tel` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'copyright')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `copyright` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'agreement')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `agreement` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'weixin')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `weixin` varchar(200)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'createtime')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `createtime` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'fee')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `fee` varchar(200) NOT NULL  DEFAULT 200 COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'mshare_title')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `mshare_title` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'mshare_icon')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `mshare_icon` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'mshare_content')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `mshare_content` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'jointel')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `jointel` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'banner')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `banner` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'onlinepay')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `onlinepay` int(2) NOT NULL  DEFAULT 0 COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'bonus')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `bonus` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_reply')) {
    if (!pdo_fieldexists('enjoy_city_reply', 'kfewm')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_reply') . " ADD `kfewm` longtext    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_seller')) {
    if (!pdo_fieldexists('enjoy_city_seller', 'id')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_seller') . " ADD `id` int(50) unsigned NOT NULL auto_increment  COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_seller')) {
    if (!pdo_fieldexists('enjoy_city_seller', 'uniacid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_seller') . " ADD `uniacid` int(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_seller')) {
    if (!pdo_fieldexists('enjoy_city_seller', 'realname')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_seller') . " ADD `realname` varchar(500)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_seller')) {
    if (!pdo_fieldexists('enjoy_city_seller', 'openid')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_seller') . " ADD `openid` varchar(1000)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_seller')) {
    if (!pdo_fieldexists('enjoy_city_seller', 'phone')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_seller') . " ADD `phone` varchar(50)    COMMENT '';");
    }
}
if (pdo_tableexists('enjoy_city_seller')) {
    if (!pdo_fieldexists('enjoy_city_seller', 'createtime')) {
        pdo_query('ALTER TABLE ' . tablename('enjoy_city_seller') . " ADD `createtime` varchar(50)    COMMENT '';");
    }
}