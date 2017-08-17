<?php
pdo_query("CREATE TABLE IF NOT EXISTS `ims_cgc_guess` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`uniacid` int(3) NOT NULL,
`logo` varchar(200) NOT NULL DEFAULT '',
`title` varchar(100) NOT NULL DEFAULT '',
`question` varchar(200) NOT NULL DEFAULT '',
`answera` varchar(200) NOT NULL DEFAULT '',
`answerb` varchar(200) NOT NULL DEFAULT '',
`answerc` varchar(200) NOT NULL DEFAULT '',
`answerd` varchar(200) NOT NULL DEFAULT '',
`answere` varchar(200) NOT NULL DEFAULT '',
`result` varchar(1) NOT NULL DEFAULT '',
`score` int(20) NOT NULL DEFAULT '0',
`createtime` int(10),
`type` int(1) DEFAULT '0',
`video_url` varchar(200) DEFAULT '',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

");
