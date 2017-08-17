<?php


defined('IN_IA') || exit('Access Denied');
$obj = new Siyuan_Vod_doMobileIndex();
$obj->exec();
class Siyuan_Vod_doMobileIndex extends Siyuan_VodModuleSite
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


		$flash = pdo_fetchall('SELECT attachment,url,title FROM ' . tablename('siyuan_vod_flash') . ' WHERE weid = ' . $_W['uniacid'] . ' ORDER BY id DESC LIMIT 5');
		$so = pdo_fetchall('SELECT id,displayorder,title,vid FROM ' . tablename('siyuan_vod_so') . 'WHERE weid = ' . $_W['uniacid'] . ' ORDER BY displayorder DESC LIMIT 20');
		$menu = pdo_fetchall('SELECT title,url,displayorder,thumb FROM ' . tablename('siyuan_vod_menu') . 'WHERE weid = ' . $_W['uniacid'] . ' ORDER BY displayorder ASC LIMIT 30');
		$title = $set['name'];
		$list = pdo_fetchall('SELECT parentid,displayorder,name,id FROM ' . tablename('siyuan_vod_fenlei') . ' WHERE weid = ' . $_W['uniacid'] . ' and parentid = \'0\' ORDER BY displayorder ASC LIMIT 8');

		foreach ($list as $re ) {
			$sql = 'SELECT id,blei,title,lianzai,shuxing,thumb FROM ' . tablename('siyuan_vod') . ' WHERE weid = ' . $_W['uniacid'] . ' and blei = :blei ORDER BY time DESC LIMIT 9';
			$params = array(':blei' => $re['id']);
			$mreply = pdo_fetchall($sql, $params);

			foreach ($mreply as $mre ) {
				$re['mreply'][$mre['id']]['title'] = $mre['title'];
				$re['mreply'][$mre['id']]['id'] = $mre['id'];
				$re['mreply'][$mre['id']]['lianzai'] = $mre['lianzai'];
				$re['mreply'][$mre['id']]['shuxing'] = $mre['shuxing'];
				$re['mreply'][$mre['id']]['thumb'] = $_W['attachurl'] . $mre['thumb'];
			}

			$reply[] = $re;
		}

		include $this->template('index');
	}
}

