<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/10/19
 * Time: 16:53
 */
if(!pdo_fieldexists('dg_prorec','template')){
    pdo_query("ALTER TABLE ".tablename('dg_prorec')." ADD `template` MEDIUMTEXT COMMENT'模板消息';");
}
if(pdo_fieldexists('dg_proreccate','attpro')){
    pdo_query("ALTER TABLE ".tablename('dg_proreccate')." CHANGE `attpro` `attpro` MEDIUMTEXT COMMENT'介绍';");
}
if(!pdo_fieldexists('dg_prorec','tempid')){
    pdo_query("ALTER TABLE ".tablename('dg_prorec')." ADD `tempid` varchar(200) COMMENT '模板id';");
}
if(!pdo_tableexists('dg_article_sharep')){

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
);
";

    pdo_query($sql);
}
if(!pdo_fieldexists('dg_proreccate','rename')){
    pdo_query("ALTER TABLE ".tablename('dg_proreccate')." ADD `rename` varchar(200) DEFAULT '购买' COMMENT '改名';");
}
if(!pdo_fieldexists('dg_prorec','color')){
    pdo_query("ALTER TABLE ".tablename('dg_prorec')." ADD `color` varchar(300) COMMENT '颜色';");
}

if(!pdo_tableexists('dg_prorectags')){

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

}
if(!pdo_fieldexists('dg_proreccate','tags')){
    pdo_query("ALTER TABLE ".tablename('dg_proreccate')." ADD `tags` varchar(500);");
}

if(!pdo_tableexists('dg_prorecpay')){

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

}

if(!pdo_fieldexists('dg_proreccate','money')){
    pdo_query("ALTER TABLE ".tablename('dg_proreccate')." ADD `money` decimal(10,2);");
}


if(!pdo_fieldexists('dg_proreccate','fcount')){
    pdo_query("ALTER TABLE ".tablename('dg_proreccate')." ADD `fcount` INT;");
}

if(!pdo_fieldexists('dg_prorec','url')){
    pdo_query("ALTER TABLE ".tablename('dg_prorec')." ADD `url` VARCHAR(300);");
}