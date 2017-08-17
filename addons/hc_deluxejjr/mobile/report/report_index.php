<?php

$rembermobile = 'hc_deluxejjr_rembermobile' . $uniacid;
if ($op == 'display') {
	$isreg = 0;
	if (empty($_COOKIE[$ismobile]) || empty($_COOKIE[$iscode])) {
	} else {
		$assistant = pdo_fetch('select * from ' . tablename('hc_deluxejjr_assistant') . ' where (flag = 1 or flag = 2) and uniacid = ' . $uniacid . ' and mobile = \'' . trim($_COOKIE[$ismobile]) . '\' and code = \'' . trim($_COOKIE[$iscode]) . '\'');
		if (!empty($assistant)) {
			$isreg = 1;
		}
	}
	if (intval($_COOKIE['rereport-username']) == 1) {
		$username = $_COOKIE[$rembermobile];
	}
	if ($isreg == 0) {
		include $this->template('report/login');
		die;
	}
}
if ($op == 'login') {
	$isreg = 0;
	$assistants = pdo_fetchall('select * from ' . tablename('hc_deluxejjr_assistant') . ' where (flag = 1 or flag = 2) and uniacid = ' . $uniacid);
	foreach ($assistants as $h) {
		if ($h['mobile'] == trim($_GPC['mobile']) && $h['code'] == $_GPC['code']) {
			$isreg = 1;
			setcookie($ismobile, $_GPC['mobile'], time() + 3600 * 24);
			setcookie($rembermobile, $_GPC['mobile'], time() + 3600 * 24);
			setcookie($iscode, $_GPC['code'], time() + 3600 * 24);
			if ($_GPC['rember']) {
				setcookie('rereport-username', 1, time() + 3600 * 24);
			} else {
				setcookie('rereport-username', 0, time() + 3600 * 24);
			}
			echo 1;
			die;
		}
	}
	if ($isreg == 0) {
		echo -1;
		die;
	}
}
if ($op == 'exit') {
	setcookie($ismobile, '', time() + 3600 * 240);
	setcookie($iscode, '', time() + 3600 * 240);
	$url = $this->createMobileurl('report_index');
	header('location:' . $url);
}
if (empty($_COOKIE[$ismobile]) || empty($_COOKIE[$iscode])) {
	include $this->template('report/login');
	die;
}
include $this->template('report/loginindex');