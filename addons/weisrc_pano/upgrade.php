<?php
$sql="CREATE TABLE IF NOT EXISTS `ims_weisrc_pano_reply` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rid` int(10) NOT NULL DEFAULT '0',
  `weid` int(10) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `picture` varchar(200) NOT NULL,
  `picture1` varchar(200) NOT NULL,
  `picture2` varchar(200) NOT NULL,
  `picture3` varchar(200) NOT NULL,
  `picture4` varchar(200) NOT NULL,
  `picture5` varchar(200) NOT NULL,
  `picture6` varchar(200) NOT NULL,
  `music` varchar(400) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `dateline` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
";
pdo_run($sql);
if(!pdo_fieldexists('weisrc_pano_reply',  'id')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `id` int(10) NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists('weisrc_pano_reply',  'rid')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `rid` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('weisrc_pano_reply',  'weid')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `weid` int(10) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('weisrc_pano_reply',  'type')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `type` tinyint(1) NOT NULL DEFAULT '1';");
}
if(!pdo_fieldexists('weisrc_pano_reply',  'title')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `title` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists('weisrc_pano_reply',  'description')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `description` text NOT NULL;");
}
if(!pdo_fieldexists('weisrc_pano_reply',  'picture')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `picture` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('weisrc_pano_reply',  'picture1')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `picture1` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('weisrc_pano_reply',  'picture2')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `picture2` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('weisrc_pano_reply',  'picture3')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `picture3` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('weisrc_pano_reply',  'picture4')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `picture4` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('weisrc_pano_reply',  'picture5')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `picture5` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('weisrc_pano_reply',  'picture6')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `picture6` varchar(200) NOT NULL;");
}
if(!pdo_fieldexists('weisrc_pano_reply',  'music')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `music` varchar(400) NOT NULL;");
}
if(!pdo_fieldexists('weisrc_pano_reply',  'status')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `status` tinyint(1) NOT NULL DEFAULT '0';");
}
if(!pdo_fieldexists('weisrc_pano_reply',  'dateline')) {
	pdo_query("ALTER TABLE ".tablename('weisrc_pano_reply')." ADD `dateline` int(10) NOT NULL DEFAULT '0';");
}

?>