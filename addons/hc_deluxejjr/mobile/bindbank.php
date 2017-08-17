<?php

$follow = pdo_fetch('select follow from ' . tablename('mc_mapping_fans') . ' where openid = \'' . $openid . '\' and uniacid = ' . $uniacid);
if (empty($follow) || $follow['follow'] == 0) {
	message('你想知道怎么加入么?', $rule['gzurl'], 'sucessr');
	die;
}
$shareid = 'hc_deluxejjr_shareid' . $uniacid;
if (empty($_COOKIE[$shareid])) {
} else {
	$profile = pdo_fetchcolumn('SELECT id FROM ' . tablename('hc_deluxejjr_member') . ' WHERE  uniacid = :uniacid  AND openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
	if (!empty($profile)) {
	} else {
		echo "<script>\r\n\t\t\t\t\tif(confirm('您是否要注册?')){\r\n\t\t\t\t\t\twindow.location.href = '" . $this->createMobileUrl('register', array('op' => 'display')) . "';\r\n\t\t\t\t\t}else{\r\n\t\t\t\t\t\twindow.location.href = '" . $this->createMobileUrl('yuyue') . "';\r\n\t\t\t\t\t}\r\n\t\t\t\t\t\t\r\n\t\t\t\t</script>";
	}
}
$profile = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_member') . ' WHERE  uniacid = :uniacid  AND openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
if (intval($profile['id']) && $profile['status'] == 0) {
	include $this->template('forbidden');
	die;
}
if (empty($profile)) {
	message('请先注册', $this->createMobileUrl('register'), 'error');
	die;
}
if ($op == 'editinfo') {
	if ($_GPC['opp'] == 'post') {
		$data = array('realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile']);
		if (!empty($data['realname']) && !empty($data['mobile'])) {
			pdo_update('hc_deluxejjr_member', $data, array('openid' => $openid, 'uniacid' => $uniacid));
			echo 1;
		} else {
			echo 0;
		}
		die;
	}
	include $this->template('editinfo');
	die;
}
if ($op == 'edit') {
	$data = array('bankcard' => $_GPC['bankcard'], 'banktype' => $_GPC['banktype']);
	if (!empty($data['bankcard']) && !empty($data['banktype'])) {
		pdo_update('hc_deluxejjr_member', $data, array('openid' => $openid, 'uniacid' => $uniacid));
		echo 1;
	} else {
		echo 0;
	}
	die;
}
include $this->template('bindbank');