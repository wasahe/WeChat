<?php

$follow = pdo_fetch('select follow from ' . tablename('mc_mapping_fans') . ' where openid = \'' . $openid . '\' and uniacid = ' . $uniacid);
if (empty($follow) || $follow['follow'] == 0) {
	message('你想知道怎么加入么?', $rule['gzurl'], 'sucessr');
	die;
}
$profile = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('hc_deluxejjr_member') . ' WHERE `uniacid` = :uniacid AND openid=:openid ', array(':uniacid' => $uniacid, ':openid' => $openid));
if ($profile) {
	message('你已注册过啦！', $this->createMobileUrl('index'), 'sucess');
	die;
}
if ($op == 'display') {
	$this->CheckCookie();
	$identity = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_identity') . ' WHERE `uniacid` = :uniacid and status = 1 ', array(':uniacid' => $uniacid));
	$iscode = array();
	foreach ($identity as $i) {
		$iscode[$i['id']] = $i['iscode'];
	}
	include $this->template('register');
	die;
}
if ($op == 'add') {
	if ($uid) {
		$headurl = pdo_fetchcolumn('select avatar from ' . tablename('mc_members') . ' where uid = ' . $uid);
	}
	$code = trim($_GPC['code']);
	$time = time();
	$data = array('uniacid' => $uniacid, 'tjmid' => $_COOKIE[$shareid], 'openid' => $openid, 'headurl' => $headurl, 'realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile'], 'identity' => intval($_GPC['identity']), 'code' => $code, 'status' => 1, 'createtime' => $time, 'createtime1' => date('Y-m-d', $time));
	$profile = pdo_fetch('SELECT mobile,id FROM ' . tablename('hc_deluxejjr_member') . ' WHERE `uniacid` = :uniacid AND mobile=:mobile ', array(':uniacid' => $uniacid, ':mobile' => $_GPC['mobile']));
	if ($data['mobile'] == $profile['mobile']) {
		echo '-2';
		die;
	}
	if (!empty($code)) {
		$iscode = pdo_fetch('select * from ' . tablename('hc_deluxejjr_jjrcode') . ' where uniacid = ' . $uniacid . ' and status = 1 and code = \'' . $code . '\'');
		if (empty($iscode)) {
			echo -3;
			die;
		} else {
			pdo_update('hc_deluxejjr_jjrcode', array('status' => 0), array('id' => $iscode['id']));
		}
	}
	if (intval($rule['teamcredit']) && intval($_COOKIE[$shareid])) {
		load()->model('mc');
		$profile = pdo_fetch('select realname, openid from ' . tablename('hc_deluxejjr_member') . ' where id = ' . intval($_COOKIE[$shareid]));
		$uid = pdo_fetchcolumn('select uid from ' . tablename('mc_mapping_fans') . ' where uniacid = ' . $uniacid . ' and openid = \'' . $profile['openid'] . '\'');
		if ($uid) {
			mc_credit_update($uid, 'credit1', intval($rule['teamcredit']), array('', '全民经纪人豪华版' . $profile['realname'] . '拉取' . $_GPC['realname'] . '积分'));
			$url = $_W['siteroot'] . $this->createMobileUrl('my');
			sendCreditChange($profile['openid'], '积分增加', '下线经纪人增加', intval($rule['teamcredit']), $url);
		}
	}
	pdo_insert('hc_deluxejjr_member', $data);
	setcookie($shareid, '');
	echo 1;
	die;
}