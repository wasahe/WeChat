<?php


defined('IN_IA') || exit('Access Denied');
load()->model('mc');
$obj = new Siyuan_Vod_doWebNews();
$obj->exec();
class Siyuan_Vod_doWebnews extends Siyuan_VodModuleSite
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
		$fenlei = pdo_fetchall('SELECT * FROM ' . tablename('siyuan_vod_fenlei') . ' WHERE weid = \'' . $_W['weid'] . '\' ORDER BY parentid ASC, displayorder ASC, id ASC ', array(), 'id');

		if ($op == 'display') {
			$pindex = max(1, intval($_GPC['page']));
			$psize = 60;
			$condition = '';
			$params = array();

			if (!empty($_GPC['keyword'])) {
				$condition .= ' AND title LIKE :keyword';
				$params[':keyword'] = '%' . $_GPC['keyword'] . '%';
			}


			if (!empty($_GPC['cate_1'])) {
				$cid = intval($_GPC['cate_1']);
				$condition .= ' AND blei = \'' . $cid . '\'';
			}


			$list = pdo_fetchall('SELECT * FROM ' . tablename('siyuan_vod') . ' WHERE weid = \'' . $_W['weid'] . '\' ' . $condition . ' ORDER BY gx DESC, time DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, $params);
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('siyuan_vod') . ' WHERE weid = \'' . $_W['weid'] . '\' ' . $condition, $params);
			$pager = pagination($total, $pindex, $psize);
			include $this->template('web/news');
			return;
		}


		if ($op == 'post') {
			$id = intval($_GPC['id']);
			$parent = array();
			$children = array();

			if (!empty($fenlei)) {
				$children = '';

				foreach ($fenlei as $cid => $cate ) {
					if (!empty($cate['parentid'])) {
						$children[$cate['parentid']][] = $cate;
					}
					 else {
						$parent[$cate['id']] = $cate;
					}
				}
			}


			if (!empty($id)) {
				$item = pdo_fetch('SELECT * FROM ' . tablename('siyuan_vod') . ' WHERE id = :id', array(':id' => $id));

				if (empty($item)) {
					message('抱歉，文章不存在或是已经删除！', '', 'error');
				}


				$blei = $item['blei'];
				$slei = $item['slei'];
			}


			$sql = 'SELECT * FROM ' . tablename('siyuan_vod_kv') . ' WHERE `vid` = ' . $id . ' ORDER BY displayorder ASC';
			$item['params'] = pdo_fetchAll($sql);

			if (checksubmit('submit')) {
				if (empty($_GPC['title'])) {
					message('标题不能为空，请输入标题!');
				}


				$data = array('weid' => $_W['weid'], 'title' => $_GPC['title'], 'gx' => $_GPC['gx'], 'thumb' => $_GPC['thumb'], 'body' => htmlspecialchars_decode($_GPC['body']), 'play' => $_GPC['play'], 'shuxing' => $_GPC['shuxing'], 'lianzai' => $_GPC['lianzai'], 'blei' => intval($_GPC['fenlei']['parentid']), 'slei' => intval($_GPC['fenlei']['childid']), 'displayorder' => intval($_GPC['displayorder']), 'yuedu' => intval($_GPC['yuedu']), 'time' => TIMESTAMP);
				$vod_id = $id;

				if (empty($id)) {
					pdo_insert('siyuan_vod', $data);
					$vod_id = pdo_insertid();
				}
				 else {
					pdo_update('siyuan_vod', $data, array('id' => $id));
				}

				$ids = array();

				if (isset($_GPC['params_key']) && $_GPC['params_key']) {
					foreach ($_GPC['params_key'] as $k => $v ) {
						$data = array('weid' => $_W['uniacid'], 'vid' => $vod_id, 'ji' => $_GPC['params_key'][$k], 'url' => $_GPC['params_value'][$k], 'displayorder' => $k);

						if (empty($_GPC['params_id'][$k])) {
							pdo_insert('siyuan_vod_kv', $data);
							$ids[] = pdo_insertid();
						}
						 else {
							pdo_update('siyuan_vod_kv', $data, array('id' => $_GPC['params_id'][$k]));
							$ids[] = $_GPC['params_id'][$k];
						}
					}
				}


				$sql = 'DELETE FROM ' . tablename('siyuan_vod_kv') . ' WHERE vid=:vid';

				if (!empty($ids)) {
					$sql .= ' AND id NOT IN(' . implode(',', $ids) . ')';
					pdo_query($sql, array(':vid' => $vod_id));
				}
				 else {
					pdo_query($sql, array(':vid' => $vod_id));
				}

				message('', url('site/entry/news', array('op' => 'display', 'm' => 'siyuan_vod')), 'success');
			}


			include $this->template('web/news');
			exit();
			return;
		}


		if ($op == 'params') {
			global $_W;
			global $_GPC;
			include $this->template('web/news-params-new');
			exit();
			return;
		}


		if ($op == 'deletekv') {
			$id = intval($_GPC['id']);

			if (0 < $id) {
				pdo_delete('siyuan_vod_kv', array('id' => $id));
			}


			echo 'success';
			return;
		}


		if ($op == 'delete') {
			$id = intval($_GPC['id']);
			$row = pdo_fetch('SELECT id FROM ' . tablename('siyuan_vod') . ' WHERE id = :id', array(':id' => $id));

			if (empty($row)) {
				message('抱歉，文章不存在或是已经被删除！');
			}


			pdo_delete('siyuan_vod', array('id' => $id));
			message('删除成功！', referer(), 'success');
			exit();
		}

	}
}

