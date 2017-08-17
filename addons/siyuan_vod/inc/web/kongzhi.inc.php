<?php


defined('IN_IA') || exit('Access Denied');
load()->model('mc');
$obj = new Siyuan_Vod_doWebKongzhi();
$obj->exec();
class Siyuan_Vod_doWebKongzhi extends Siyuan_VodModuleSite
{
	public function __construct()
	{
		parent::__construct();
	}

	public function exec()
	{
		global $_W;
		global $_GPC;
		$op = ((!empty($_GPC['op']) ? $_GPC['op'] : 'display'));
		$version = IA_ROOT . '/addons/siyuan_vod/inc/web/version.php';
		$ver = include $version;
		$ver = $ver['ver'];
		$lastver = file_get_contents('');
		$bug = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('siyuan_vod_bug') . ' WHERE  weid = ' . $_W['uniacid'] . ' and bug = 0');
		include $this->template('web/kongzhi');
	}
}

