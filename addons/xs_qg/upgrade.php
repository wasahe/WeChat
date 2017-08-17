<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_xs_dy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `one` varchar(255) NOT NULL,
  `shipin` varchar(255) NOT NULL,
  `two` varchar(255) NOT NULL,
  `three` varchar(255) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `createtime` varchar(20) NOT NULL,
  `dtime` varchar(20) NOT NULL,
  `uniacid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_xs_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `goods_num` int(11) NOT NULL,
  `tid` varchar(255) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` int(11) NOT NULL,
  `goods_state` int(11) NOT NULL,
  `createtime` varchar(20) NOT NULL,
  `uniacid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
pdo_run($sql);
if(!pdo_fieldexists('xs_dy',  'id')) {
	pdo_query("ALTER TABLE ".tablename('xs_dy')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('xs_dy',  'title')) {
	pdo_query("ALTER TABLE ".tablename('xs_dy')." ADD `title` varchar(100) NOT NULL;");
}
if(!pdo_fieldexists('xs_dy',  'one')) {
	pdo_query("ALTER TABLE ".tablename('xs_dy')." ADD `one` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('xs_dy',  'shipin')) {
	pdo_query("ALTER TABLE ".tablename('xs_dy')." ADD `shipin` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('xs_dy',  'two')) {
	pdo_query("ALTER TABLE ".tablename('xs_dy')." ADD `two` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('xs_dy',  'three')) {
	pdo_query("ALTER TABLE ".tablename('xs_dy')." ADD `three` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('xs_dy',  'money')) {
	pdo_query("ALTER TABLE ".tablename('xs_dy')." ADD `money` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists('xs_dy',  'tel')) {
	pdo_query("ALTER TABLE ".tablename('xs_dy')." ADD `tel` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('xs_dy',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('xs_dy')." ADD `createtime` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('xs_dy',  'dtime')) {
	pdo_query("ALTER TABLE ".tablename('xs_dy')." ADD `dtime` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('xs_dy',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('xs_dy')." ADD `uniacid` int(11) NOT NULL;");
}
if(!pdo_fieldexists('xs_order',  'id')) {
	pdo_query("ALTER TABLE ".tablename('xs_order')." ADD `id` int(11) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('xs_order',  'goods_id')) {
	pdo_query("ALTER TABLE ".tablename('xs_order')." ADD `goods_id` int(11) NOT NULL;");
}
if(!pdo_fieldexists('xs_order',  'goods_num')) {
	pdo_query("ALTER TABLE ".tablename('xs_order')." ADD `goods_num` int(11) NOT NULL;");
}
if(!pdo_fieldexists('xs_order',  'tid')) {
	pdo_query("ALTER TABLE ".tablename('xs_order')." ADD `tid` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('xs_order',  'money')) {
	pdo_query("ALTER TABLE ".tablename('xs_order')." ADD `money` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists('xs_order',  'name')) {
	pdo_query("ALTER TABLE ".tablename('xs_order')." ADD `name` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('xs_order',  'tel')) {
	pdo_query("ALTER TABLE ".tablename('xs_order')." ADD `tel` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('xs_order',  'address')) {
	pdo_query("ALTER TABLE ".tablename('xs_order')." ADD `address` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('xs_order',  'state')) {
	pdo_query("ALTER TABLE ".tablename('xs_order')." ADD `state` int(11) NOT NULL;");
}
if(!pdo_fieldexists('xs_order',  'goods_state')) {
	pdo_query("ALTER TABLE ".tablename('xs_order')." ADD `goods_state` int(11) NOT NULL;");
}
if(!pdo_fieldexists('xs_order',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('xs_order')." ADD `createtime` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists('xs_order',  'uniacid')) {
	pdo_query("ALTER TABLE ".tablename('xs_order')." ADD `uniacid` int(11) NOT NULL;");
}

?>