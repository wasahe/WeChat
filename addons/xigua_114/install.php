<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

$pluginid = 'xigua_114';

$Hooks = array(
    'forumdisplay_topBar',
);

$data = array();
foreach ($Hooks as $Hook) {
    $data[] = array(
        $Hook => array(
            'plugin' => $pluginid,
            'include' => 'api.class.php',
            'class' => $pluginid,
            'method' => $Hook)
    );
}


$sql = <<<SQL
CREATE TABLE IF NOT EXISTS `pre_plugin_xigua114` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `catid` int(10) unsigned NOT NULL,
 `company_name` varchar(200) NOT NULL,
 `company_desc` varchar(500) NOT NULL,
 `logo` varchar(200) NOT NULL,
 `cover` text NOT NULL,
 `phone` varchar(80) NOT NULL,
 `qq` varchar(20) NOT NULL,
 `qr` varchar(200) NOT NULL,
 `wechat` varchar(200) NOT NULL,
 `site` varchar(500) NOT NULL,
 `weibo` varchar(200) NOT NULL,
 `license_num` varchar(200) NOT NULL,
 `license_name` varchar(200) NOT NULL,
 `province` varchar(200) NOT NULL,
 `city` varchar(200) NOT NULL,
 `dist` varchar(200) NOT NULL,
 `address` varchar(500) NOT NULL,
 `realname` varchar(80) NOT NULL,
 `idcard` varchar(80) NOT NULL,
 `mobile` varchar(80) NOT NULL,
 `status` tinyint(3) unsigned NOT NULL,
 `displayorder` int(8) unsigned NOT NULL DEFAULT '0',
 `crts` int(11) unsigned NOT NULL,
 `digest` tinyint(1) unsigned NOT NULL DEFAULT '0',
 `v` tinyint(1) unsigned NOT NULL DEFAULT '0',
 `pt` varchar(3) NOT NULL DEFAULT '',
 `nearby` tinyint(1) unsigned NOT NULL DEFAULT '0',
 `views` int(11) NOT NULL DEFAULT '0',
 `shares` int(11) NOT NULL DEFAULT '0',
 `lat` varchar(20) NOT NULL,
 `lng` varchar(20) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `phone` (`phone`),
 KEY `catid` (`catid`),
 KEY `qr` (`qr`),
 KEY `logo` (`logo`),
 KEY `order` (`displayorder`),
 KEY `status` (`status`),
 KEY `digest` (`digest`),
 KEY `city` (`city`),
 KEY `dist` (`dist`),
 KEY `dist_2` (`dist`),
 KEY `city_2` (`city`),
 KEY `dist_3` (`dist`),
 KEY `city_3` (`city`),
 KEY `dist_4` (`dist`),
 KEY `shares` (`shares`),
 KEY `views` (`views`),
 KEY `city_4` (`city`),
 KEY `dist_5` (`dist`)
) ENGINE=InnoDB AUTO_INCREMENT=66;

CREATE TABLE IF NOT EXISTS `pre_plugin_xigua114_cat` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `pid` int(10) unsigned NOT NULL,
 `name` varchar(80) NOT NULL,
 `icon` varchar(200) NOT NULL,
 `adimage` varchar(200) NOT NULL,
 `adlink` varchar(200) NOT NULL,
 `ts` int(11) unsigned NOT NULL,
 `o` int(11) unsigned NOT NULL,
 `pushtype` varchar(20) NOT NULL DEFAULT '',
 `pos` varchar(10) NOT NULL DEFAULT '',
 `nearby` tinyint(1) unsigned NOT NULL DEFAULT '1',
 PRIMARY KEY (`id`),
 KEY `o` (`o`),
 KEY `pos` (`pos`),
 KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=228;

CREATE TABLE IF NOT EXISTS `pre_plugin_xigua114_report` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `phone` varchar(80) NOT NULL,
 `type` tinyint(3) unsigned NOT NULL,
 `extra` varchar(800) NOT NULL,
 `mobile` varchar(80) NOT NULL,
 `crts` int(11) unsigned NOT NULL,
 `status` tinyint(1) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46;


REPLACE INTO `pre_plugin_xigua114` (`id`, `catid`, `company_name`, `company_desc`, `logo`, `cover`, `phone`, `qq`, `qr`, `wechat`, `site`, `weibo`, `license_num`, `license_name`, `province`, `city`, `dist`, `address`, `realname`, `idcard`, `mobile`, `status`, `displayorder`, `crts`, `digest`, `v`, `pt`, `nearby`) VALUES
$installlang[l1]

REPLACE INTO `pre_plugin_xigua114_cat` (`id`, `pid`, `name`, `icon`, `adimage`, `adlink`, `ts`, `o`, `pushtype`, `pos`, `nearby`) VALUES
$installlang[l2]
SQL;
runquery($sql);


$finish = TRUE;



@include_once DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php';
WeChatHook::updateAPIHook($data);