<?php

$follow = pdo_fetch('select follow from ' . tablename('mc_mapping_fans') . ' where openid = \'' . $openid . '\' and uniacid = ' . $uniacid);
if (empty($follow) || $follow['follow'] == 0) {
	message('你想知道怎么加入么?', $rule['gzurl'], 'sucessr');
	die;
}
$profile = pdo_fetch('SELECT a.*, ac.loupanid FROM ' . tablename('hc_deluxejjr_assistant') . ' as a left join ' . tablename('hc_deluxejjr_promanager') . ' as ac on a.uniacid = ac.uniacid and a.code = ac.code WHERE flag = 2 and a.uniacid = :uniacid  AND a.openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
if (empty($profile['loupanid'])) {
	$profile['loupanid'] = 0;
}
$id = $profile['id'];
if (intval($id) && $profile['status'] == 0) {
	include $this->template('forbidden');
	die;
}
$status = $this->ProcessStatus();
$statuslenth = count($status) - 1;
$cfg = $this->module['config'];
$statusprotect = count($status) - 2;
$protectdate = intval($cfg['protectdate']);
if ($protectdate) {
	$protectdate = TIMESTAMP - 3600 * 24 * $protectdate;
	$protectwhere = ' AND (updatetime > ' . $protectdate . ' OR status > ' . $statusprotect . ' )';
}
if (intval($id)) {
	if ($op == 'allot') {
		$opp = $_GPC['opp'];
		$customer = pdo_fetchall('select a.* from ' . tablename('hc_deluxejjr_assistant') . ' as a left join ' . tablename('hc_deluxejjr_counselor') . ' as c on a.code = c.code and a.uniacid = c.uniacid where c.lid in (' . $profile['loupanid'] . ') and a.flag = 0 and a.status = 1 and a.uniacid =' . $uniacid);
		include $this->template('ga_index');
		die;
	}
	$pindex = max(1, intval($_GPC['page']));
	$psize = 15;
	$xss = pdo_fetchall('select id, realname from ' . tablename('hc_deluxejjr_assistant') . ' where uniacid = ' . $uniacid . ' and flag = 0');
	$xs = array();
	foreach ($xss as $x) {
		$xs[$x['id']] = $x['realname'];
	}
	$total = pdo_fetchcolumn('select count(id) from ' . tablename('hc_deluxejjr_customer') . 'where loupan in (' . $profile['loupanid'] . ') and uniacid =' . $uniacid . $protectwhere);
	$customer = pdo_fetchall('select * from ' . tablename('hc_deluxejjr_customer') . 'where loupan in (' . $profile['loupanid'] . ') and uniacid =' . $uniacid . ' ' . $protectwhere . ' ORDER BY id DESC limit ' . ($pindex - 1) * $psize . ',' . $psize);
	$pager = pagination1($total, $pindex, $psize);
	$loupan = pdo_fetchall('SELECT id, title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid ORDER BY displayorder DESC', array(':uniacid' => $uniacid));
	$pan = array();
	foreach ($loupan as $l) {
		$pan[$l['id']] = $l['title'];
	}
	include $this->template('procus_index');
	die;
}
if ($op == 'add') {
	$data = array('uniacid' => $uniacid, 'openid' => $openid, 'realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile'], 'code' => $_GPC['code'], 'flag' => 2, 'createtime' => TIMESTAMP);
	$profile = pdo_fetch('SELECT code,id FROM ' . tablename('hc_deluxejjr_assistant') . ' WHERE flag = 2 and `uniacid` = :uniacid AND code=:code ', array(':uniacid' => $uniacid, ':code' => $_GPC['code']));
	if ($data['code'] == $profile['code']) {
		echo '-1';
		die;
	}
	$codes = pdo_fetchall('select id, code from ' . tablename('hc_deluxejjr_promanager') . 'where status = 1 and uniacid =' . $uniacid);
	$flag = true;
	foreach ($codes as $c) {
		if (trim($c['code']) == trim($_GPC['code'])) {
			pdo_update('hc_deluxejjr_promanager', array('status' => 0), array('id' => $c['id']));
			$flag = false;
			break;
		}
	}
	if ($flag) {
		echo -1;
		die;
	}
	pdo_insert('hc_deluxejjr_assistant', $data);
	echo 1;
	die;
}
include $this->template('promanager');