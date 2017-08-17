<?php

defined('IN_IA') || exit('Access Denied');
load()->model('mc');
$obj = new Siyuan_Vod_doWebFlash();
$obj->exec();
class Siyuan_Vod_doWebFlash extends Siyuan_VodModuleSite
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
		$operation = ((!empty($_GPC['op']) ? $_GPC['op'] : 'display'));

		if ($operation == 'display') {
			$list = pdo_fetchall('SELECT * FROM ' . tablename('siyuan_vod_flash') . ' WHERE weid = \'' . $_W['uniacid'] . '\' ORDER BY id DESC');
		}
		 else if ($operation == 'post') {
			$id = intval($_GPC['id']);

			if (checksubmit('submit')) {
				$data = array('weid' => $_W['uniacid'], 'title' => $_GPC['title'], 'url' => $_GPC['url'], 'attachment' => $_GPC['attachment']);

				if (!empty($id)) {
					pdo_update('siyuan_vod_flash', $data, array('id' => $id));
				}
				 else {
					pdo_insert('siyuan_vod_flash', $data);
					$id = pdo_insertid();
				}

				message('更新幻灯片成功！', $this->createWebUrl('flash', array('op' => 'display')), 'success');
			}


			$adv = pdo_fetch('select * from ' . tablename('siyuan_vod_flash') . ' where id=:id and weid=:weid', array(':id' => $id, ':weid' => $_W['uniacid']));
		}
		 else if ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$adv = pdo_fetch('SELECT id  FROM ' . tablename('siyuan_vod_flash') . ' WHERE id = \'' . $id . '\' AND weid=' . $_W['uniacid'] . '');

			if (empty($adv)) {
				message('抱歉，幻灯片不存在或是已经被删除！', $this->createWebUrl('flash', array('op' => 'display')), 'error');
			}


			pdo_delete('siyuan_vod_flash', array('id' => $id));
			message('幻灯片删除成功！', $this->createWebUrl('flash', array('op' => 'display')), 'success');
		}
		 else {
			message('请求方式不存在');
		}

		include $this->template('web/flash');
	}
}

