<?php

$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($op == 'display') {
	if (!empty($_GPC['listorder'])) {
		foreach ($_GPC['listorder'] as $id => $listorder) {
			pdo_update('hc_deluxejjr_cusmat', array('listorder' => $listorder), array('id' => $id));
		}
		message('条件排序更新成功！', $this->createWebUrl('cusmat', array('op' => 'display')), 'success');
	}
	$children = array();
	$cusmat = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_cusmat') . ' WHERE uniacid = \'' . $_W['uniacid'] . '\' ORDER BY parentid ASC, listorder DESC');
	foreach ($cusmat as $index => $row) {
		if (!empty($row['parentid'])) {
			$children[$row['parentid']][] = $row;
			unset($cusmat[$index]);
		}
	}
	include $this->template('web/cusmat');
	return 1;
}
if ($op == 'post') {
	$parentid = intval($_GPC['parentid']);
	$id = intval($_GPC['id']);
	if (!empty($id)) {
		$cusmat = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_cusmat') . ' WHERE id = \'' . $id . '\'');
	} else {
		$cusmat = array('listorder' => 0, 'isopen' => 1);
	}
	if (!empty($parentid)) {
		$parent = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_cusmat') . ' WHERE id = \'' . $parentid . '\'');
		if (empty($parent)) {
			message('抱歉，上级条件不存在或是已经被删除！', $this->createWebUrl('post'), 'error');
		}
	}
	if (checksubmit('submit')) {
		if (empty($_GPC['title'])) {
			message('抱歉，请输入条件！');
		}
		$data = array('uniacid' => $_W['uniacid'], 'parentid' => intval($parentid), 'title' => trim($_GPC['title']), 'listorder' => intval($_GPC['listorder']), 'content' => intval($_GPC['content']), 'flag' => intval($_GPC['flag']), 'isopen' => intval($_GPC['isopen']));
		if (!empty($id)) {
			unset($data['parentid']);
			pdo_update('hc_deluxejjr_cusmat', $data, array('id' => $id));
		} else {
			$data['createtime'] = time();
			pdo_insert('hc_deluxejjr_cusmat', $data);
			$id = pdo_insertid();
		}
		message('更新条件成功！', $this->createWebUrl('cusmat', array('op' => 'display')), 'success');
	}
	include $this->template('web/cusmat');
	return 1;
}
if ($op == 'delete') {
	$id = intval($_GPC['id']);
	$cusmat = pdo_fetch('SELECT id, parentid FROM ' . tablename('hc_deluxejjr_cusmat') . ' WHERE id = \'' . $id . '\'');
	if (empty($cusmat)) {
		message('抱歉，条件不存在或是已经被删除！', $this->createWebUrl('cusmat', array('op' => 'display')), 'error');
	}
	pdo_delete('hc_deluxejjr_cusmat', array('id' => $id, 'parentid' => $id), 'OR');
	message('条件删除成功！', $this->createWebUrl('cusmat', array('op' => 'display')), 'success');
}