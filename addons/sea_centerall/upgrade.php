<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_sea_centerall_adv` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL DEFAULT '',
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_sea_centerall_manus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniacid` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL DEFAULT '',
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `displayorder` int(10) NOT NULL DEFAULT '0',
  `fontsize` int(10) NOT NULL DEFAULT '18',
  `color` varchar(20) NOT NULL DEFAULT '#333333',
  `imgwidth` int(10) NOT NULL DEFAULT '40',
  `imgheight` int(10) NOT NULL DEFAULT '40',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
pdo_run($sql);
if(!pdo_fieldexists('sea_centerall_adv',  'id')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_adv')." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('sea_centerall_adv',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_adv')." ADD `uniacid` int(10) NOT NULL;");
}
if(!pdo_fieldexists('sea_centerall_adv',  'title')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_adv')." ADD `title` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('sea_centerall_adv',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_adv')." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('sea_centerall_adv',  'link')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_adv')." ADD `link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('sea_centerall_adv',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_adv')." ADD `enabled` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('sea_centerall_adv',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_adv')." ADD `deleted` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('sea_centerall_adv',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_adv')." ADD `displayorder` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('sea_centerall_manus',  'id')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_manus')." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('sea_centerall_manus',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_manus')." ADD `uniacid` int(10) NOT NULL;");
}
if(!pdo_fieldexists('sea_centerall_manus',  'title')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_manus')." ADD `title` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('sea_centerall_manus',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_manus')." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('sea_centerall_manus',  'link')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_manus')." ADD `link` varchar(255) NOT NULL DEFAULT '';");
}
if(!pdo_fieldexists('sea_centerall_manus',  'enabled')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_manus')." ADD `enabled` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('sea_centerall_manus',  'deleted')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_manus')." ADD `deleted` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('sea_centerall_manus',  'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_manus')." ADD `displayorder` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('sea_centerall_manus',  'fontsize')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_manus')." ADD `fontsize` int(10) NOT NULL DEFAULT '18';");
}
if(!pdo_fieldexists('sea_centerall_manus',  'color')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_manus')." ADD `color` varchar(20) NOT NULL DEFAULT '#333333';");
}
if(!pdo_fieldexists('sea_centerall_manus',  'imgwidth')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_manus')." ADD `imgwidth` int(10) NOT NULL DEFAULT '40';");
}
if(!pdo_fieldexists('sea_centerall_manus',  'imgheight')) {
	pdo_query("ALTER TABLE ".tablename('sea_centerall_manus')." ADD `imgheight` int(10) NOT NULL DEFAULT '40';");
}

?>