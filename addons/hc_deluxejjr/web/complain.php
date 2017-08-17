<?php

if ($op == 'display') {
	$pindex = max(1, intval($_GPC['page']));
	$psize = 30;
	$complains = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_complain') . ' WHERE uniacid = \'' . $_W['uniacid'] . '\' ORDER BY createtime DESC limit ' . ($pindex - 1) * $psize . ',' . $psize);
	$total = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('hc_deluxejjr_complain') . ' WHERE uniacid = \'' . $_W['uniacid'] . '\'');
	$pager = pagination($total, $pindex, $psize);
}
if ($op == 'detail') {
	$id = intval($_GPC['id']);
	if (!empty($id)) {
		$complain = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_complain') . ' WHERE id = \'' . $id . '\'');
		if (checksubmit('submit')) {
			$complain = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile'], 'complain' => trim($_GPC['complain']));
			pdo_update('hc_deluxejjr_complain', $complain, array('id' => $id));
			message('提交成功', $this->createWebUrl('complain'));
		}
	}
}
if ($op == 'delete') {
	$id = intval($_GPC['id']);
	pdo_delete('hc_deluxejjr_complain', array('id' => $id));
	message('删除成功！', $this->createWebUrl('complain', array('op' => 'display')), 'success');
}
include $this->template('web/complain');