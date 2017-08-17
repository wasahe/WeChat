<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_business` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `qq` varchar(15) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `dist` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `lng` varchar(10) NOT NULL,
  `lat` varchar(10) NOT NULL,
  `industry1` varchar(10) NOT NULL,
  `industry2` varchar(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_lat_lng` (`lng`,`lat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
";
pdo_run($sql);
if(!pdo_fieldexists('business',  'id')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('business',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `weid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists('business',  'title')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `title` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('business',  'thumb')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `thumb` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists('business',  'content')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `content` varchar(1000) NOT NULL;");
}
if(!pdo_fieldexists('business',  'phone')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `phone` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('business',  'qq')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `qq` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists('business',  'province')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `province` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('business',  'city')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `city` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('business',  'dist')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `dist` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('business',  'address')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `address` varchar(500) NOT NULL;");
}
if(!pdo_fieldexists('business',  'lng')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `lng` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('business',  'lat')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `lat` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('business',  'industry1')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `industry1` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('business',  'industry2')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `industry2` varchar(10) NOT NULL;");
}
if(!pdo_fieldexists('business',  'createtime')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD `createtime` int(10) NOT NULL;");
}
if(!pdo_indexexists('business',  'idx_lat_lng')) {
	pdo_query("ALTER TABLE ".tablename('business')." ADD KEY `idx_lat_lng` (`lng`,`lat`);");
}

?>