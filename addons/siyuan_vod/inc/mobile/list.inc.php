<?php


defined('IN_IA') || exit('Access Denied');
$obj = new Siyuan_Vod_doMobileList();
$obj->exec();
class Siyuan_Vod_doMobileList extends Siyuan_VodModuleSite
{
	public function __construct()
	{
		parent::__construct();
	}

	public function exec()
	{
		global $_W;
		global $_GPC;
		$set = pdo_fetch('SELECT name,ad,logo,qr,color,top_logo,fengge,open,ad_pic,ad_url,bottom_name,bottom_ad,bottom_logo,bottom_qr,share_url FROM ' . tablename('siyuan_vod_setting') . ' WHERE weid = :weid ', array(':weid' => $_W['uniacid']));

		if ($set['open'] == '0') {
			$this->Checkeduseragent();
		}


		$so = pdo_fetchall('SELECT id,displayorder,title,vid FROM ' . tablename('siyuan_vod_so') . 'WHERE weid = ' . $_W['uniacid'] . ' ORDER BY displayorder DESC LIMIT 20');
		$menu = pdo_fetchall('SELECT title,url,displayorder,thumb FROM ' . tablename('siyuan_vod_menu') . 'WHERE weid = ' . $_W['uniacid'] . ' ORDER BY displayorder ASC LIMIT 30');
		$title = $set['name'];
		$id = intval($_GPC['id']);
		$pindex = max(1, intval($_GPC['page']));
		$psize = 30;
		$list = pdo_fetchall('SELECT id,time,title,thumb,shuxing,lianzai,blei,slei FROM ' . tablename('siyuan_vod') . ' WHERE weid = ' . $_W['uniacid'] . ' and blei = ' . $id . ' or slei = ' . $id . ' ORDER BY time DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize);
		$total = pdo_fetchcolumn('SELECT COUNT(id) FROM ' . tablename('siyuan_vod') . ' WHERE weid = ' . $_W['uniacid'] . ' and blei = ' . $id);
		$pager = pagination($total, $pindex, $psize);
		$pageend = ceil($total / $psize);

		if ((($total / $psize) != 0) && ($psize <= $total)) {
			++$pageend;
		}


		include $this->template('list');
	}
}

