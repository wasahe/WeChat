<?php

$sql =<<<EOF
CREATE TABLE IF NOT EXISTS `ims_iweite_vods_category` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) DEFAULT NULL,
  `sid` int(4) DEFAULT '0',
  `dateline` varchar(80) DEFAULT NULL,
  `fdes` varchar(350) DEFAULT NULL,
  `fpic` varchar(300) DEFAULT NULL,
  `weid` int(4) DEFAULT NULL,
  `isup` int(4) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_iweite_vods_guanggao` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `classid` int(4) DEFAULT NULL,
  `title` varchar(300) DEFAULT NULL,
  `fpic` varchar(300) DEFAULT NULL,
  `flink` mediumtext,
  `sid` int(4) DEFAULT '0',
  `dateline` varchar(80) DEFAULT NULL,
  `weid` int(4) DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_iweite_vods_jiekou` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(4) DEFAULT '0',
  `title` varchar(300) DEFAULT NULL,
  `fdes` mediumtext,
  `dateline` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_iweite_vods_setting` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(4) DEFAULT '0',
  `title` varchar(300) DEFAULT NULL,
  `indexpagesize` int(4) DEFAULT '0',
  `pagesize` int(4) DEFAULT '0',
  `copyright` mediumtext,
  `cnzz` varchar(300) DEFAULT NULL,
  `share` mediumtext,
  `guanzhu` mediumtext,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_iweite_vods_ziyuan` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `classid` int(4) DEFAULT NULL,
  `title` varchar(300) DEFAULT NULL,
  `fpic` varchar(300) DEFAULT NULL,
  `fdes` varchar(300) DEFAULT NULL,
  `isok` int(4) DEFAULT '0',
  `recommend` int(4) DEFAULT '0',
  `sid` int(4) DEFAULT '0',
  `dateline` varchar(80) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `guanlian` varchar(350) DEFAULT NULL,
  `content` mediumtext,
  `weid` int(4) DEFAULT '0',
  `flag` VARCHAR( 35) NOT NULL,
  `cid` INT( 4) NOT NULL  DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_iweite_vods_ziyuan_list` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `classid` int(4) DEFAULT NULL,
  `content` mediumtext,
  `dateline` varchar(80) DEFAULT NULL,
  `weid` int(4) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
EOF;
pdo_run($sql);
