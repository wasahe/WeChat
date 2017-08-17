<?php

if ($op == 'add') {
	$shareid = 'hc_deluxejjr_shareid' . $uniacid;
	$shareid = $_COOKIE[$shareid];
	if (intval($shareid)) {
		$share_member = pdo_fetch('select openid, identity from ' . tablename('hc_deluxejjr_member') . ' where id = ' . $shareid);
		$share_openid = $share_member['openid'];
		$share_identity = $share_member['identity'];
	} else {
		$share_openid = '';
		$share_identity = 0;
	}
	$time = time();
	$data = array('uniacid' => $uniacid, 'openid' => $share_openid, 'identity' => $share_identity, 'realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile'], 'loupan' => intval($_GPC['loupan']), 'createtime1' => date('Y-m-d', $time), 'createtime' => $time, 'updatetime' => $time, 'indatetime' => $time, 'flag' => 1);
	$profile = pdo_fetch('SELECT loupan,id FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE `flag` = :flag AND `uniacid` = :uniacid AND loupan=:loupan AND `openid` = :openid', array(':flag' => 1, ':uniacid' => $uniacid, ':loupan' => $_GPC['loupan'], ':openid' => $openid));
	if ($data['loupan'] == $profile['loupan']) {
		echo '-1';
		die;
	}
	pdo_insert('hc_deluxejjr_customer', $data);
	echo 1;
	die;
}
$id = $_GPC['id'];
$loupans = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid and `isview` =1 ORDER BY displayorder DESC', array(':uniacid' => $uniacid));
include $this->template('yuyue');