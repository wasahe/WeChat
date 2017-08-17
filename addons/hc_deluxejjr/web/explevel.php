<?php

if ($op == 'display') {
	if (!empty($_GPC['displayorder'])) {
		foreach ($_GPC['displayorder'] as $id => $displayorder) {
			pdo_update('hc_deluxejjr_explevel', array('displayorder' => $displayorder), array('id' => $id));
		}
		message('分段排序更新成功！', $this->createWebUrl('explevel', array('op' => 'display')), 'success');
	}
	$explevels = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_explevel') . ' WHERE uniacid = \'' . $_W['uniacid'] . '\' ORDER BY displayorder asc');
	include $this->template('web/explevel');
	return 1;
}
if ($op == 'post') {
	$id = intval($_GPC['id']);
	if (!empty($id)) {
		$explevel = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_explevel') . ' WHERE id = \'' . $id . '\'');
	} else {
		$explevel = array('displayorder' => 0);
	}
	if (checksubmit('submit')) {
		if (empty($_GPC['title'])) {
			message('请输入标题！');
		}
		$data = array('uniacid' => $_W['uniacid'], 'title' => $_GPC['title'], 'displayorder' => intval($_GPC['displayorder']), 'levelicon' => trim($_GPC['levelicon']), 'min' => intval($_GPC['min']), 'max' => intval($_GPC['max']), 'createtime' => time());
		if (!empty($id)) {
			pdo_update('hc_deluxejjr_explevel', $data, array('id' => $id));
		} else {
			pdo_insert('hc_deluxejjr_explevel', $data);
		}
		message('提交成功！', $this->createWebUrl('explevel', array('op' => 'display')), 'success');
	}
	include $this->template('web/explevel');
	return 1;
}
if ($op == 'delete') {
	$id = intval($_GPC['id']);
	pdo_delete('hc_deluxejjr_explevel', array('id' => $id));
	message('删除成功！', $this->createWebUrl('explevel', array('op' => 'display')), 'success');
}