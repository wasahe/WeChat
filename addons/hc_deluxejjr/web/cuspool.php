<?php

if ($op == 'display') {
	$pindex = max(1, intval($_GPC['page']));
	$psize = 30;
	$cuspool = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_cuspool') . ' WHERE uniacid = \'' . $_W['uniacid'] . '\' ORDER by createtime DESC limit ' . ($pindex - 1) * $psize . ',' . $psize);
	$total = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('hc_deluxejjr_cuspool') . ' WHERE uniacid = \'' . $_W['uniacid'] . '\'');
	$pager = pagination($total, $pindex, $psize);
}
if ($op == 'sort') {
	if ($_GPC['loupan'] == '') {
		$sort = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
		$cuspool = pdo_fetchall('select * from' . tablename('hc_deluxejjr_cuspool') . ' where uniacid = ' . $uniacid . ' and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\' ORDER BY createtime DESC');
		$total = sizeof($cuspool);
	} else {
		$sort = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
		$loupan = pdo_fetchall('SELECT id,title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid ', array(':uniacid' => $uniacid));
		$loupans = array();
		foreach ($loupan as $k => $v) {
			$loupans[$v['title']] = $v['id'];
		}
		$loupan = $loupans[$_GPC['loupan']];
		$pindex = max(1, intval($_GPC['page']));
		$psize = 30;
		$total = pdo_fetchcolumn('select count(id) from' . tablename('hc_deluxejjr_cuspool') . ' where uniacid =' . $uniacid . ' and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\' and loupan = ' . $loupan);
		$pager = pagination($total, $pindex, $psize);
		$cuspool = pdo_fetchall('select * from' . tablename('hc_deluxejjr_cuspool') . ' where uniacid =' . $uniacid . ' and realname like \'%' . $sort['realname'] . '%\' and mobile like \'%' . $sort['mobile'] . '%\' and loupan = ' . $loupan . ' ORDER BY createtime DESC limit ' . ($pindex - 1) * $psize . ',' . $psize);
	}
}
if ($op == 'del') {
	$id = intval($_GPC['id']);
	pdo_delete('hc_deluxejjr_cuspool', array('id' => $id));
	message('删除成功！', $this->createWebUrl('cuspool', array('op' => 'display')), 'success');
}
$loupans = pdo_fetchall('SELECT id, title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid ', array(':uniacid' => $uniacid));
$loupan = array();
foreach ($loupans as $k => $v) {
	$loupan[$v['id']] = $v['title'];
}
$status = $this->ProcessStatus();
$idpris = pdo_fetchall('select cuspri, identity_name from ' . tablename('hc_deluxejjr_identity') . ' where uniacid = ' . $uniacid . ' order by cuspri asc');
$idpri = array();
$identity = array();
foreach ($idpris as $key => $i) {
	$idpri[$key] = $i['cuspri'];
	$identity[$i['cuspri']] = $i['identity_name'];
}
include $this->template('web/cuspool');