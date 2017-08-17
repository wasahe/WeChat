<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/10/14
 * Time: 15:43
 */
$sql="
CREATE TABLE IF NOT EXISTS ".tablename('dg_prorec')."(
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) DEFAULT NULL COMMENT '公众号ID',
  `title` varchar(100) DEFAULT NULL COMMENT '文章标题',
  `content` mediumtext COMMENT '文章内容',
  `createtime` int(11) DEFAULT NULL COMMENT '时间',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `cateid` int(11) DEFAULT NULL COMMENT '分类id',
  `catename` varchar(100) DEFAULT NULL COMMENT '分类名称',
  `version` varchar(50) DEFAULT NULL COMMENT '版本号',
  `template` mediumtext COMMENT '模板消息',
  `tempid` varchar(200) DEFAULT NULL COMMENT '模板id',
  `color` varchar(300) DEFAULT NULL COMMENT '颜色',
  `url` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
)ENGINE=INNODB CHARSET=utf8;
";
pdo_query($sql);


$sql="
CREATE TABLE IF NOT EXISTS ".tablename('dg_prorec_slide')."(
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `thumb` varchar(250) DEFAULT NULL COMMENT '幻灯片',
  `link` varchar(250) DEFAULT NULL COMMENT '链接地址',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `createtime` int(11) NOT NULL COMMENT '时间',
  `displayorder` int(11) DEFAULT NULL COMMENT '排序',
  `name` varchar(100) DEFAULT NULL COMMENT '幻灯片名字',
  PRIMARY KEY (`id`)
)ENGINE=INNODB CHARSET=utf8;
";

pdo_query($sql);


$sql="
CREATE TABLE IF NOT EXISTS ".tablename('dg_proreccate')."(
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `displayid` int(11) DEFAULT NULL COMMENT '排序',
  `createtime` int(11) NOT NULL COMMENT '时间',
  `icon` varchar(200) DEFAULT NULL COMMENT '分类图标',
  `attpro` mediumtext COMMENT '介绍',
  `count` int(11) DEFAULT NULL COMMENT '关注的人数',
  `buyurl` varchar(100) DEFAULT NULL COMMENT '购买地址',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `rename` varchar(200) DEFAULT '购买' COMMENT '改名',
  `tags` varchar(500) DEFAULT NULL COMMENT '标签',
  `money` decimal(10,2) DEFAULT NULL,
  `fcount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
)ENGINE=INNODB CHARSET=utf8;
";

pdo_query($sql);



$sql="
CREATE TABLE IF NOT EXISTS ".tablename('dg_prorecread')."(
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `cateid` int(11) DEFAULT NULL COMMENT '分类id',
  `recid` int(11) DEFAULT NULL COMMENT '文章id',
  `openid` varchar(200) DEFAULT NULL COMMENT '用户openid',
  `createtime` int(11) DEFAULT NULL COMMENT '时间',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
)ENGINE=INNODB CHARSET=utf8;
";

pdo_query($sql);


$sql="
CREATE TABLE IF NOT EXISTS ".tablename('dg_prorecuser')."(
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL COMMENT '公众号ID',
  `openid` varchar(100) NOT NULL COMMENT '用户的openid',
  `follow_time` int(11) DEFAULT NULL COMMENT '时间',
  `cateid` int(11) DEFAULT NULL COMMENT '关注id',
  `followstatus` tinyint(4) NOT NULL DEFAULT '1' COMMENT '关注状态',
  PRIMARY KEY (`id`)
)ENGINE=INNODB CHARSET=utf8;
";

pdo_query($sql);


$sql="
CREATE TABLE IF NOT EXISTS ".tablename('dg_prorectemp')."(
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号ID',
  `tempid` varchar(200) DEFAULT NULL COMMENT '模板ID',
  `templist` mediumtext COMMENT '模板内容',
  `tempexple` text COMMENT '模板示例',
  `createtime` int(11) DEFAULT NULL COMMENT '时间',
  `tempstatus` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否展示',
  `tempname` varchar(200) DEFAULT NULL COMMENT '模板名称',
  PRIMARY KEY (`id`)
)ENGINE=INNODB CHARSET=utf8;
";

pdo_query($sql);

$sql="
CREATE TABLE IF NOT EXISTS ".tablename('dg_prorectags')." (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL COMMENT '公众号ID',
  `tag_name` varchar(100) DEFAULT NULL COMMENT '标签名称',
  `displayorder` int(11) DEFAULT NULL COMMENT '排序',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态',
  `createtime` int(11) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

pdo_query($sql);


$sql="
CREATE TABLE IF NOT EXISTS ".tablename('dg_prorecpay')." (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `cateid` int(11) NOT NULL,
  `openid` varchar(200) NOT NULL,
  `transaction_id` varchar(200) DEFAULT NULL COMMENT '交易流水号',
  `out_trade_no` varchar(100) DEFAULT NULL,
  `pay_money` decimal(10,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `pay_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
";

pdo_query($sql);

