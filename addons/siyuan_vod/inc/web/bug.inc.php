<?php


defined('IN_IA') || exit('Access Denied');
load()->model('mc');
$obj = new Siyuan_Vod_doWebBug();
$obj->exec();
class Siyuan_Vod_doWebBug extends Siyuan_VodModuleSite
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

		if ($op == 'display') {
			$pindex = max(1, intval($_GPC['page']));
			$psize = 50;
			$list = pdo_fetchall('SELECT * FROM ' . tablename('siyuan_vod_bug') . 'WHERE weid = ' . $_W['uniacid'] . ' ORDER BY id DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, $params);
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('siyuan_vod_bug') . ' WHERE weid = \'' . $_W['weid'] . '\' ' . $condition, $params);
			$pager = pagination($total, $pindex, $psize);
			include $this->template('web/bug');
			return;
		}


		if ($op == 'delete') {
			$id = intval($_GPC['id']);
			$row = pdo_fetch('SELECT id FROM ' . tablename('siyuan_vod_bug') . ' WHERE id = :id', array(':id' => $id));

			if (empty($row)) {
				message('抱歉，文章不存在或是已经被删除！');
			}


			pdo_delete('siyuan_vod_bug', array('id' => $id));
			message('', referer(), 'success');
			exit();
			return;
		}


		if ($op == 'ok') {
			$id = intval($_GPC['id']);
			pdo_update('siyuan_vod_bug', array('bug' => 1), array('id' => $id));
			message('', referer(), 'success');
			exit();
			return;
		}


		if ($op == 'send') {
			$id = intval($_GPC['id']);
			$set = pdo_fetch('SELECT * FROM ' . tablename('siyuan_vod_setting') . ' WHERE weid = :weid ', array(':weid' => $_W['uniacid']));
			$news = pdo_fetch('SELECT * FROM ' . tablename('siyuan_vod_bug') . ' WHERE id = :id', array(':id' => $id));
			$data = array('touser' => $news['openid'], 'template_id' => $set['vod_xiaoxi'], 'url' => $_W['siteroot'] . 'app/' . $this->createMobileUrl('news', array('id' => $news['vid'])), 'topcolor' => '#FF0000');
			$data['data'] = array(
				'first'    => array('value' => '您提交的失效影片已经修复！'),
				'keyword1' => array('value' => $news['title'], 'color' => '#173177'),
				'keyword2' => array('value' => date('Y-m-d H:i:s', time()), 'color' => '#173177'),
				'keyword3' => array('value' => $news['ma_ok'], 'color' => '#173177'),
				'remark'   => array('value' => '请点击查看...')
				);
			$token = $this->getToken();
			$this->sendMBXX($token, $data);
			pdo_update('siyuan_vod_bug', array('bug' => 1), array('id' => $id));
			message('', referer(), 'success');
			exit();
		}

	}
}

