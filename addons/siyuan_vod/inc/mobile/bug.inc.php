<?php

defined('IN_IA') || exit('Access Denied');
$obj = new Siyuan_Vod_doMobileBug();
$obj->exec();
class Siyuan_Vod_doMobileBug extends Siyuan_VodModuleSite
{
	public function __construct()
	{
		parent::__construct();
	}

	public function exec()
	{
		global $_W;
		global $_GPC;
		$act = (($_GPC['act'] ? $_GPC['act'] : 'bug'));
		$id = intval($_GPC['id']);
		$ji = $_GPC['ji'];
		$news = pdo_fetch('SELECT id,title FROM ' . tablename('siyuan_vod') . ' WHERE `id` = ' . $id);

		if ($id) {
			$date = array('openid' => $user['openid'], 'weid' => $_W['weid'], 'title' => $news['title'] . $ji, 'vid' => $id);
			pdo_insert('siyuan_vod_bug', $date);
			message('提交成功，我们会尽快修复后通知您观看！', $this->createMobileUrl('index'), 'success');
		}

	}
}

