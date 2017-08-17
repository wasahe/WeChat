<?php
 

global $_W;
global $_GPC;
require MD_ROOT . '/source/Model.class.php';
require MD_ROOT . '/source/VpRankModel.class.php';
$cmd = $_GPC['cmd'];
$rank_id = $_GPC['rank_id'];

if (empty($rank_id)) {
	returnError('请选择要操作的圈子');
}


if ($cmd == 'add') {
	if ('add' == $_GPC['submit']) {
		$merchant = $_GPC['merchant'];

		if (empty($merchant['name'])) {
			returnError('请填写商户名称');
		}


		if (40 < text_len($merchant['name'])) {
			return $this->returnError('名称大长了，不要超过40个字');
		}


		$merchant['uniacid'] = $_W['uniacid'];
		$merchant['rank_id'] = $rank_id;
		$merchant['create_uid'] = 0;
		$merchant['create_time'] = time();
		$merchant['status'] = 1;
		$merchant['status_time'] = time();
		pdo_insert('vp_rank_merchant', $merchant);
		returnSuccess('商户创建成功!', $this->createWebUrl('merchant', array('rank_id' => $rank_id)));
		return 1;
	}


	include $this->template('web/merchant_add');
	return 1;
}


if ($cmd == 'edit') {
	if ('edit' == $_GPC['submit']) {
		$merchant = $_GPC['merchant'];

		if (empty($merchant['name'])) {
			returnError('请填写商户名称');
		}


		if (40 < text_len($merchant['name'])) {
			return $this->returnError('名称大长了，不要超过40个字');
		}


		unset($merchant['uniacid']);
		$ret = pdo_update('vp_rank_merchant', $merchant, array('id' => $merchant['id']));

		if ($ret === false) {
			return $this->returnError('更新失败');
		}


		returnSuccess('商户保存成功!', $this->createWebUrl('merchant', array('rank_id' => $rank_id)));
		return 1;
	}


	$id = intval($_GPC['id']);

	if (empty($id)) {
		message('抱歉，传递的参数错误！', '', 'error');
	}


	$merchant = pdo_fetch('select * from ' . tablename('vp_rank_merchant') . ' where uniacid=:uniacid and id=:id ', array(':uniacid' => $_W['uniacid'], ':id' => $id));

	if (empty($merchant)) {
		message('抱歉，没有相关数据！', '', 'error');
	}


	include $this->template('web/merchant_edit');
	return 1;
}


if ($cmd == 'import') {
	if ('baidu' == $_GPC['submit']) {
		if (empty($_W['module_setting']['bd_ak'])) {
			return $this->returnError('请先配置百度KEY');
		}


		$region = $_GPC['region'];

		if (empty($region)) {
			return $this->returnError('请填写城市名称');
		}


		$tags = $_GPC['tags'];
		if (empty($tags) || (count($tags) == 0)) {
			return $this->returnError('请选择商户类型');
		}


		$url = 'http://api.map.baidu.com/place/v2/search?q=' . implode(',', $tags) . '&region=' . $region . '&output=json&page_size=20&ak=' . $_W['module_setting']['bd_ak'];
		load()->func('communication');
		$i = 0;
		$num_add = 0;
		$num_up = 0;

		while ($i < 2000) {
			$url .= '&page_num=' . $i;
			$response = ihttp_get($url);

			if (!is_error($response)) {
				$data = @json_decode($response['content'], true);
				if (empty($data) || ($data['status'] != 0)) {
					$this->returnError('导入到第' . $i . '页失败：' . $data['message'] . '(' . $data['status'] . ')');
				}
				 else {
					$list = $data['results'];
					if (empty($list) || (count($list) == 0)) {
						break;
					}


					foreach ($list as $item ) {
						$old = pdo_fetch('select id from ' . tablename('vp_rank_merchant') . ' where uniacid=:uniacid and rank_id=:rank_id and name=:name ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank_id, ':name' => $item['name']));

						if (empty($old)) {
							$new = array('uniacid' => $_W['uniacid'], 'rank_id' => $rank_id, 'name' => $item['name'], 'telephone' => $item['telephone'], 'address' => $item['address'], 'lat' => $item['location']['lat'], 'lng' => $item['location']['lng'], 'create_uid' => 0, 'create_time' => time(), 'status' => 1, 'status_time' => time());
							$ret = pdo_insert('vp_rank_merchant', $new);

							if (false !== $ret) {
								++$num_add;
							}

						}
						 else {
							$new = array('name' => $item['name'], 'telephone' => $item['telephone'], 'address' => $item['address'], 'lat' => $item['location']['lat'], 'lng' => $item['location']['lng']);
							$ret = pdo_update('vp_rank_merchant', $new, array('id' => $old['id']));

							if (false !== $ret) {
								++$num_up;
							}

						}
					}
				}
			}


			++$i;
		}

		$this->returnSuccess('导入成功：新增' . $num_add . '条，更新' . $num_up . '条');
		return 1;
	}


	include $this->template('web/merchant_import');
	return 1;
}


$params = array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank_id);
$total = pdo_fetchcolumn('select count(id) from ' . tablename('vp_rank_merchant') . ' where uniacid=:uniacid and rank_id=:rank_id ', $params);
$pindex = max(1, intval($_GPC['page']));
$psize = 80;
$pager = pagination($total, $pindex, $psize);
$start = ($pindex - 1) * $psize;
$limit .= ' LIMIT ' . $start . ',' . $psize;
$list = pdo_fetchall('select * from ' . tablename('vp_rank_merchant') . '  where uniacid=:uniacid and rank_id=:rank_id order by create_time desc ' . $limit, $params);
include $this->template('web/merchant_list');

?>