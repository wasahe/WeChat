<?php


defined('IN_IA') || exit('Access Denied');
load()->model('mc');
$obj = new Siyuan_Vod_doWebUpdate();
$obj->exec();
class Siyuan_Vod_doWebUpdate extends Siyuan_VodModuleSite
{
	public function __construct()
	{
		parent::__construct();
	}

	public function exec()
	{
		global $_GPC;
		global $_W;
		$eid = intval($_GPC['eid']);
		$op = ((!empty($_GPC['op']) ? $_GPC['op'] : 'display'));
		$auth_host = '';
		$host_ip = CLIENT_IP;
		$host_url = $_SERVER['HTTP_HOST'];
		$status = file_get_contents($auth_host . '&act=auth&bs=siyuan_vod&url=' . $host_url . '&ip=' . $host_ip);
		$qr = file_get_contents($auth_host . '&act=qr&bs=siyuan_vod');

		if ($status == '0') {
			message('', url('site/entry/reg', array('op' => 'display', 'm' => 'siyuan_vod')), 'success');
		}


		if ($op == 'display') {
			$version = IA_ROOT . '/addons/siyuan_vod/inc/web/version.php';
			$ver = include $version;
			$ver = $ver['ver'];
			$lastver = file_get_contents($auth_host . '&act=update&bs=siyuan_vod');
		}
		 else if ($op == 'data') {
			include IA_ROOT . '/addons/siyuan_vod/inc/web/update.class.php';
			$zip_path = IA_ROOT . '/addons';
			$data = file_get_contents($auth_host . '&act=data&bs=siyuan_vod&url=' . $host_url . '&ip=' . $host_ip);
			$updatedir = IA_ROOT . '/addons/siyuan_vod/data';
			mkdirs($updatedir);
			get_file($data, 'siyuan_vod.zip', $updatedir);
			$updatezip = $updatedir . '/' . 'siyuan_vod.zip';
			$archive = new PclZip($updatezip);

			if ($archive->extract(PCLZIP_OPT_PATH, $zip_path, PCLZIP_OPT_REPLACE_NEWER) == 0) {
				delDirAndFile($updatedir);
				message('远程升级文件不存在.升级失败！', url('site/entry/kongzhi', array('m' => 'siyuan_vod')), 'error');
			}
			 else {
				delDirAndFile($updatedir);
				message('文件更新成功，下面升级数据库，请不要关闭本页面！', url('site/entry/update', array('op' => 'sql', 'm' => 'siyuan_vod')), 'success');
			}
		}
		 else if ($op == 'sql') {
			$updatefile = IA_ROOT . '/addons/siyuan_vod/up.php';
			require $updatefile;
			message('数据库升级成功！', url('site/entry/kongzhi', array('m' => 'siyuan_vod')), 'success');
		}


		include $this->template('web/update');
	}
}

