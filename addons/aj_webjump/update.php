<?php

//decode by QQ:3213288469 http://www.zheyitianshi.com/
pdo_query("CREATE TABLE IF NOT EXISTS `ims_aj_webjump` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rid` int(10) NOT NULL,
  `uniacid` int(10) NOT NULL,
  `content` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `bgpic` varchar(255) NOT NULL,
  `headthumb` varchar(255) NOT NULL,
  `head` varchar(100) NOT NULL,
  `head2` varchar(100) NOT NULL,
  `minhead` varchar(100) NOT NULL,
  `minhead2` varchar(100) NOT NULL,
  `button` varchar(50) NOT NULL,
  `success_otitle` varchar(100) NOT NULL,
  `success_otitle2` varchar(100) NOT NULL,
  `success_ttitle` varchar(100) NOT NULL,
  `success_ttitle2` varchar(100) NOT NULL,
  `success_stitle` varchar(100) NOT NULL,
  `success_stitle2` varchar(100) NOT NULL,
  `qrcode` varchar(255) NOT NULL,
  `sharetitle` varchar(100) NOT NULL,
  `sharepic` varchar(255) NOT NULL,
  `sharedes` varchar(255) NOT NULL,
  `key` varchar(10) NOT NULL,
  `matitle` varchar(100) NOT NULL,
  `malucky` varchar(10) NOT NULL,
  `mades` varchar(100) NOT NULL,
  `mades2` varchar(100) NOT NULL,
  `copyrighturl` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `tiaozhuan` varchar(255) NOT NULL,
  `fxz1` varchar(50) NOT NULL,
  `fxz2` varchar(50) NOT NULL,
  `fxz3` varchar(50) NOT NULL,
  `formpic` varchar(255) NOT NULL,
  `mintips` varchar(100) NOT NULL,
  `formbutton` varchar(10) NOT NULL,
  `copyright` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
CREATE TABLE IF NOT EXISTS `ims_aj_webjump_player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `realname` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `usertime` varchar(100) NOT NULL,
  `lasttime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=300 DEFAULT CHARSET=utf8;
");
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'id')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `id` int(10) NOT NULL auto_increment  COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'rid')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `rid` int(10) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'uniacid')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `uniacid` int(10) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'content')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `content` varchar(50) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'title')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `title` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'thumb')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `thumb` varchar(255) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'description')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `description` varchar(255) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'bgpic')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `bgpic` varchar(255) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'headthumb')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `headthumb` varchar(255) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'head')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `head` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'head2')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `head2` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'minhead')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `minhead` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'minhead2')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `minhead2` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'button')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `button` varchar(50) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'success_otitle')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `success_otitle` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'success_otitle2')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `success_otitle2` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'success_ttitle')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `success_ttitle` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'success_ttitle2')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `success_ttitle2` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'success_stitle')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `success_stitle` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'success_stitle2')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `success_stitle2` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'qrcode')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `qrcode` varchar(255) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'sharetitle')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `sharetitle` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'sharepic')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `sharepic` varchar(255) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'sharedes')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `sharedes` varchar(255) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'key')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `key` varchar(10) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'matitle')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `matitle` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'malucky')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `malucky` varchar(10) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'mades')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `mades` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'mades2')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `mades2` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'copyrighturl')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `copyrighturl` varchar(255) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'logo')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `logo` varchar(255) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'tiaozhuan')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `tiaozhuan` varchar(255) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'fxz1')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `fxz1` varchar(50) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'fxz2')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `fxz2` varchar(50) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'fxz3')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `fxz3` varchar(50) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'formpic')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `formpic` varchar(255) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'mintips')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `mintips` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'formbutton')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `formbutton` varchar(10) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump')) {
	if (!pdo_fieldexists('aj_webjump', 'copyright')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump') . ' ADD `copyright` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump_player')) {
	if (!pdo_fieldexists('aj_webjump_player', 'id')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump_player') . ' ADD `id` int(11) NOT NULL auto_increment  COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump_player')) {
	if (!pdo_fieldexists('aj_webjump_player', 'weid')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump_player') . ' ADD `weid` int(11) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump_player')) {
	if (!pdo_fieldexists('aj_webjump_player', 'rid')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump_player') . ' ADD `rid` int(11) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump_player')) {
	if (!pdo_fieldexists('aj_webjump_player', 'status')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump_player') . ' ADD `status` int(1) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump_player')) {
	if (!pdo_fieldexists('aj_webjump_player', 'openid')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump_player') . ' ADD `openid` varchar(50) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump_player')) {
	if (!pdo_fieldexists('aj_webjump_player', 'realname')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump_player') . ' ADD `realname` varchar(50) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump_player')) {
	if (!pdo_fieldexists('aj_webjump_player', 'mobile')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump_player') . ' ADD `mobile` varchar(50) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump_player')) {
	if (!pdo_fieldexists('aj_webjump_player', 'avatar')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump_player') . ' ADD `avatar` varchar(200) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump_player')) {
	if (!pdo_fieldexists('aj_webjump_player', 'nickname')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump_player') . ' ADD `nickname` varchar(50) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump_player')) {
	if (!pdo_fieldexists('aj_webjump_player', 'usertime')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump_player') . ' ADD `usertime` varchar(100) NOT NULL   COMMENT \'\';');
	}
}
if (pdo_tableexists('aj_webjump_player')) {
	if (!pdo_fieldexists('aj_webjump_player', 'lasttime')) {
		pdo_query('ALTER TABLE ' . tablename('aj_webjump_player') . ' ADD `lasttime` varchar(100) NOT NULL   COMMENT \'\';');
	}
}