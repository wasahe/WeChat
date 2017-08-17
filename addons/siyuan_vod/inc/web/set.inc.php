<?php


defined('IN_IA') || exit('Access Denied');
load()->model('mc');
$obj = new Siyuan_Vod_doWebSet();
$obj->exec();
class Siyuan_Vod_doWebSet extends Siyuan_VodModuleSite
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
		$set = pdo_fetch('SELECT * FROM ' . tablename('siyuan_vod_setting') . ' WHERE weid = :weid ', array(':weid' => $_W['uniacid']));

		if (checksubmit('submit')) {
			$data = array('weid' => $_W['uniacid'], 'name' => $_GPC['name'], 'logo' => $_GPC['logo'], 'ad' => $_GPC['ad'], 'top_logo' => $_GPC['top_logo'], 'video_key' => $_GPC['video_key'], 'time' => $_GPC['time'], 'share_url' => $_GPC['share_url'], 'open' => $_GPC['open'], 'qr' => $_GPC['qr'], 'bottom_name' => $_GPC['bottom_name'], 'tishi' => $_GPC['tishi'], 'fengge' => $_GPC['fengge'], 'bottom_ad' => $_GPC['bottom_ad'], 'bottom_logo' => $_GPC['bottom_logo'], 'bottom_qr' => $_GPC['bottom_qr'], 'ad_pic' => $_GPC['ad_pic'], 'ad_url' => $_GPC['ad_url'], 'color' => $_GPC['color'], 'vod_xiaoxi' => $_GPC['vod_xiaoxi'], 'bug_xiaoxi' => $_GPC['bug_xiaoxi'], 'openid' => $_GPC['openid']);

			if (!empty($set)) {
				pdo_update('siyuan_vod_setting', $data, array('id' => $set['id']));
			}
			 else {
				pdo_insert('siyuan_vod_setting', $data);
			}

			message('更新系统设置成功！', 'refresh');
		}


		include $this->template('web/set');
	}
}

