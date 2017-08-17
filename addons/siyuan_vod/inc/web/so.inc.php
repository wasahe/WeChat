<?php


defined('IN_IA') || exit('Access Denied');
load()->model('mc');
$obj = new Siyuan_Vod_doWebSo();
$obj->exec();
class Siyuan_Vod_doWebSo extends Siyuan_VodModuleSite
{
	public function __construct()
	{
		parent::__construct();
	}

	public function exec()
	{
		global $_W;
		global $_GPC;
		load()->func('tpl');
		$weid = $_W['uniacid'];
		$act = ((!empty($_GPC['op']) ? $_GPC['op'] : 'display'));

		if ($act == 'display') {
			$params = array();
			$cates = pdo_fetchall('SELECT * FROM ' . tablename('siyuan_vod_so') . 'WHERE weid = ' . $_W['uniacid'] . ' ORDER BY displayorder DESC , id DESC ', $params);

			if (checksubmit('submit')) {
				$i = 0;

				while ($i < count($_GPC['titles'])) {
					$ids = $_GPC['ids'];
					$id = trim(implode(',', $ids), ',');
					$insert = array('title' => $_GPC['titles'][$i], 'vid' => $_GPC['vid'][$i], 'displayorder' => $_GPC['displayorders'][$i], 'weid' => $weid);

					if ($ids[$i] != NULL) {
						pdo_update('siyuan_vod_so', $insert, array('id' => $ids[$i]));
					}
					 else {
						pdo_insert('siyuan_vod_so', $insert);
					}

					++$i;
				}

				message('更新信息成功', referer(), 'success');
			}

		}
		 else if ($act == 'delete') {
			load()->func('file');
			$id = intval($_GPC['id']);
			pdo_delete('siyuan_vod_so', array('id' => $id));
			message('删除成功！', referer(), 'success');
		}


		include $this->template('web/so');
	}
}

