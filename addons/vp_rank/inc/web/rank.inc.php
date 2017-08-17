<?php
 

global $_W;
global $_GPC;
require MD_ROOT . '/source/Model.class.php';
require MD_ROOT . '/source/VpRankModel.class.php';
$cmd = $_GPC['cmd'];

if ($cmd == 'add') {
	if ('add' == $_GPC['submit']) {
		$rank = $_GPC['rank'];

		if (empty($rank['name'])) {
			returnError('请填写圈子名称');
		}


		if (10 < text_len($rank['name'])) {
			return $this->returnError('名称大长了，不要超过10个字');
		}


		if (empty($rank['settings']['award_values'])) {
			return $this->returnError('请填写默认金额');
		}


		if (count(explode(',', $rank['settings']['award_values'])) != 6) {
			return $this->returnError('请填写6个默认金额，用逗号隔开');
		}


		$rank['uniacid'] = $_W['uniacid'];
		$rank['settings'] = iserializer($rank['settings']);
		$rank['create_time'] = time();
		pdo_insert('vp_rank', $rank);
		returnSuccess('圈子创建成功!', $this->createWebUrl('rank'));
		return 1;
	}


	include $this->template('web/rank_add');
	return 1;
}


if ($cmd == 'edit') {
	if ('edit' == $_GPC['submit']) {
		$VpRankModel = new VpRankModel();
		$rank = $_GPC['rank'];

		if (empty($rank['settings']['award_values'])) {
			return $this->returnError('请填写默认金额');
		}


		if (count(explode(',', $rank['settings']['award_values'])) != 6) {
			return $this->returnError('请填写6个默认金额，用逗号隔开');
		}


		if (false === $VpRankModel->create($rank)) {
			returnError('验证出错：' . $VpRankModel->getError());
		}


		$VpRankModel->__unset('uniacid');
		$VpRankModel->__set('settings', iserializer($VpRankModel->__get('settings')));

		if (false === $VpRankModel->save()) {
			returnError('操作失败，请重试');
		}


		$rank_cache_key = 'vap_rank:' . $rank['id'];
		cache_delete($rank_cache_key);
		returnSuccess('圈子保存成功!', $this->createWebUrl('rank'));
		return 1;
	}


	$id = intval($_GPC['id']);

	if (empty($id)) {
		message('抱歉，传递的参数错误！', '', 'error');
	}


	$rank = pdo_fetch('select * from ' . tablename('vp_rank') . ' where uniacid=:uniacid and id=:id ', array(':uniacid' => $_W['uniacid'], ':id' => $id));

	if (empty($rank)) {
		message('抱歉，没有相关数据！', '', 'error');
	}


	$rank['settings'] = iunserializer($rank['settings']);
	include $this->template('web/rank_edit');
	return 1;
}


if ('authoritys' == $_GPC['cmd']) {
	$id = $_GPC['id'];

	if (empty($id)) {
		returnError('请选择要设置的圈子');
	}


	$rank = pdo_fetch('select * from ' . tablename('vp_rank') . ' where uniacid=:uniacid and id=:id ', array(':uniacid' => $_W['uniacid'], ':id' => $id));

	if (empty($rank)) {
		message('抱歉，没有相关数据！', '', 'error');
	}


	if ('add' == $_GPC['submit']) {
		$level = $_GPC['level'];
		if (empty($level) || empty($level['level']) || empty($level['name']) || empty($level['flag']) || !isset($level['credit'])) {
			returnError('请先完善信息');
		}


		$levels = ((empty($rank['authoritys']) ? array() : iunserializer($rank['authoritys'])));
		$levels[$level['level']] = $level;
		$ret = pdo_query('UPDATE ' . tablename('vp_rank') . ' SET authoritys=:authoritys where uniacid=:uniacid and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $rank['id'], ':authoritys' => iserializer($levels)));

		if (empty($ret)) {
			return $this->returnError('操作失败');
		}


		returnSuccess('新增成功');
		return 1;
	}


	if ('save' == $_GPC['submit']) {
		$level = $_GPC['level'];
		if (empty($level) || empty($level['level']) || empty($level['name']) || empty($level['flag']) || !isset($level['credit'])) {
			returnError('请先完善信息');
		}


		$levels = ((empty($rank['authoritys']) ? array() : iunserializer($rank['authoritys'])));
		$levels[$level['level']] = $level;
		$ret = pdo_query('UPDATE ' . tablename('vp_rank') . ' SET authoritys=:authoritys where uniacid=:uniacid and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $rank['id'], ':authoritys' => iserializer($levels)));

		if (empty($ret)) {
			return $this->returnError('操作失败');
		}


		returnSuccess('保存成功');
		return 1;
	}


	$levels = ((empty($rank['authoritys']) ? array() : iunserializer($rank['authoritys'])));
	include $this->template('web/rank_authoritys');
	return 1;
}


$params = array(':uniacid' => $_W['uniacid']);
$total = pdo_fetchcolumn('select count(id) from ' . tablename('vp_rank') . ' where uniacid=:uniacid ', $params);
$pindex = max(1, intval($_GPC['page']));
$psize = 12;
$pager = pagination($total, $pindex, $psize);
$start = ($pindex - 1) * $psize;
$limit .= ' LIMIT ' . $start . ',' . $psize;
$list = pdo_fetchall('select * from ' . tablename('vp_rank') . '  where uniacid=:uniacid  order by create_time desc ' . $limit, $params);
$i = 0;

while ($i < count($list)) {
	$url = $this->createMobileUrl('index', array('rid' => pencode($list[$i]['id'])));
	$list[$i]['_surl'] = $url;
	$url = substr($url, 2);
	$url = $_W['siteroot'] . 'app/' . $url;
	$list[$i]['_url'] = $url;
	++$i;
}

include $this->template('web/rank_list');

?>