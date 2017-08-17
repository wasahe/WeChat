<?php

if ($_GPC['op'] == 'sort') {
	$sort = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
	$pindex = max(1, intval($_GPC['page']));
	$psize = 20;
	$total = pdo_fetchcolumn('select count(id) from' . tablename('hc_deluxejjr_assistant') . ' where flag = 2 and uniacid =' . $uniacid . ' and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\'');
	$pager = pagination($total, $pindex, $psize);
	$list = pdo_fetchall('select * from' . tablename('hc_deluxejjr_assistant') . ' where flag = 2 and uniacid =' . $uniacid . ' and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\' ORDER BY id DESC limit ' . ($pindex - 1) * $psize . ',' . $psize);
} else {
	$pindex = max(1, intval($_GPC['page']));
	$psize = 20;
	$total = pdo_fetchcolumn('select count(id) from' . tablename('hc_deluxejjr_assistant') . ' where flag = 2 and uniacid =' . $uniacid);
	$pager = pagination($total, $pindex, $psize);
	$list = pdo_fetchall('select * from' . tablename('hc_deluxejjr_assistant') . ' where flag = 2 and uniacid =' . $uniacid . ' ORDER BY id DESC limit ' . ($pindex - 1) * $psize . ',' . $psize);
}
if ($_GPC['op'] == 'status') {
	$counselors = array('content' => trim($_GPC['content']), 'status' => $_GPC['status']);
	$temp = pdo_update('hc_deluxejjr_assistant', $counselors, array('id' => $_GPC['id']));
	if (empty($temp)) {
		message('提交失败，请重新提交！', $this->createWebUrl('promanagers', array('op' => 'showdetail', 'id' => $_GPC['id'])), 'error');
	} else {
		message('提交成功！', $this->createWebUrl('promanagers'), 'success');
	}
}
if ($_GPC['op'] == 'showdetail') {
	$id = $_GPC['id'];
	$user = pdo_fetch('select a.*, ac.loupanid, ac.id as codeid from' . tablename('hc_deluxejjr_assistant') . ' as a left join ' . tablename('hc_deluxejjr_promanager') . ' as ac on a.uniacid = ac.uniacid and a.code = ac.code where a.id =' . $_GPC['id']);
	$loupanids = explode(',', $user['loupanid']);
	$loupan = pdo_fetchall('SELECT id,title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid and `isview` =1 ', array(':uniacid' => $uniacid));
	$loupans = array();
	foreach ($loupan as $k => $v) {
		$loupans[$v['id']] = $v['title'];
	}
	include $this->template('web/promanagers_showdetail');
	die;
}
if ($_GPC['op'] == 'del') {
	$code = pdo_fetchcolumn('select code from' . tablename('hc_deluxejjr_assistant') . 'where id =' . $_GPC['id']);
	$temp = pdo_delete('hc_deluxejjr_assistant', array('id' => $_GPC['id']));
	$temp = pdo_delete('hc_deluxejjr_promanager', array('code' => $code));
	if (empty($temp)) {
		message('删除失败，请重新删除！', $this->createWebUrl('promanagers', array('op' => 'showdetail', 'id' => $_GPC['mid'])), 'error');
	} else {
		message('删除成功！', $this->createWebUrl('promanagers'), 'success');
	}
}
include $this->template('web/promanagers_show');