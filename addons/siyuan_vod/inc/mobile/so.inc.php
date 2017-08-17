<?php

defined('IN_IA') || exit('Access Denied');
$obj = new Siyuan_Vod_doMobileSo();
$obj->exec();
class Siyuan_Vod_doMobileSo extends Siyuan_VodModuleSite
{
	public function __construct()
	{
		parent::__construct();
	}

	public function exec()
	{
		global $_W;
		global $_GPC;
		$set = pdo_fetch('SELECT name,ad,logo,qr,color,top_logo,fengge,open,ad_pic,ad_url,bottom_name,bottom_ad,bottom_logo,bottom_qr FROM ' . tablename('siyuan_vod_setting') . ' WHERE weid = :weid ', array(':weid' => $_W['uniacid']));

		if ($set['open'] == '0') {
			$this->Checkeduseragent();
		}


		$so = pdo_fetchall('SELECT id,displayorder,title,vid FROM ' . tablename('siyuan_vod_so') . 'WHERE weid = ' . $_W['uniacid'] . ' ORDER BY displayorder DESC LIMIT 20');
		$menu = pdo_fetchall('SELECT title,url,displayorder,thumb FROM ' . tablename('siyuan_vod_menu') . 'WHERE weid = ' . $_W['uniacid'] . ' ORDER BY displayorder ASC LIMIT 30');
		$title = $set['name'];
		$condition = '';
		$params = array();

		if (!empty($_GPC['keyword'])) {
			$condition .= ' title LIKE :keyword';
			$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
			$list = pdo_fetchall('SELECT id,time,title,thumb,shuxing,lianzai,blei,slei FROM ' . tablename('siyuan_vod') . ' WHERE weid = ' . $_W['uniacid'] . ' and ' . $condition . ' ORDER BY time DESC LIMIT 30', $params);
		}
		 else {
			$list = pdo_fetchall('SELECT id,time,title,thumb,shuxing,lianzai,blei,slei FROM ' . tablename('siyuan_vod') . 'WHERE weid = ' . $_W['uniacid'] . ' ORDER BY time DESC LIMIT 30', $params);
		}

		include $this->template('so');
	}
}

