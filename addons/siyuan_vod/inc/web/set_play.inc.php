<?php


defined('IN_IA') || exit('Access Denied');
load()->model('mc');
$obj = new Siyuan_Vod_doWebSet_Play();
$obj->exec();
class Siyuan_Vod_doWebSet_Play extends Siyuan_VodModuleSite
{
	public function __construct()
	{
		parent::__construct();
	}

	public function exec()
	{
		global $_W;
		global $_GPC;
		$weid = $_W['uniacid'];
		$set = pdo_fetch('SELECT * FROM ' . tablename('siyuan_vod_play_set') . ' WHERE weid = :weid ', array(':weid' => $_W['uniacid']));
		$filename = '../addons/siyuan_vod/play/config.php';
		$config = file_get_contents($filename);

		if (checksubmit('submit')) {
			$data = array('weid' => $_W['uniacid'], 'videojj_key' => $_GPC['videojj_key'], 'playm3u8_key' => $_GPC['playm3u8_key'], 'playm3u8_host' => $_GPC['playm3u8_host'], 'playm3u8_site1' => $_GPC['playm3u8_site1'], 'playm3u8_site2' => $_GPC['playm3u8_site2'], 'playm3u8_title' => $_GPC['playm3u8_title']);
			$arr = file($filename);
			$playm3u8_key = 'define(\'apikey\', \'' . $_GPC['playm3u8_key'] . '\');';
			$playm3u8_host = 'define(\'api_host\', \'' . $_GPC['playm3u8_host'] . '\');';
			$playm3u8_title = 'define(\'play_title\', \'' . $_GPC['playm3u8_title'] . '\');';
			$playm3u8_url = 'define(\'play_url\', \'' . $_GPC['playm3u8_url'] . '\');';
			$playm3u8_site = '$auth_domain =' . ' array(\'' . $_GPC['playm3u8_site1'] . '\',\'' . $_GPC['playm3u8_site2'] . '\');';
			$str = '';
			reset($arr);

			foreach ($arr as $a => $b ) {
				if ((strpos($b, 'apikey') === false) && (strpos($b, 'api_host') === false) && (strpos($b, 'play_title') === false) && (strpos($b, 'play_url') === false) && (strpos($b, 'auth_domain') === false)) {
					$str .= $b;
				}

			}

			file_put_contents($filename, $str);
			file_put_contents($filename, $playm3u8_key . "\n", FILE_APPEND);
			file_put_contents($filename, $playm3u8_host . "\n", FILE_APPEND);
			file_put_contents($filename, $playm3u8_title . "\n", FILE_APPEND);
			file_put_contents($filename, $playm3u8_url . "\n", FILE_APPEND);
			file_put_contents($filename, $playm3u8_site, FILE_APPEND);

			if (!empty($set)) {
				pdo_update('siyuan_vod_play_set', $data, array('id' => $set['id']));
			}
			 else {
				pdo_insert('siyuan_vod_play_set', $data);
			}

			message('解析设置成功！', 'refresh');
		}


		include $this->template('web/set_play');
	}
}

