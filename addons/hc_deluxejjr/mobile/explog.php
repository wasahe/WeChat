<?php

$follow = pdo_fetch('select follow from ' . tablename('mc_mapping_fans') . ' where openid = \'' . $openid . '\' and uniacid = ' . $uniacid);
if (empty($follow) || $follow['follow'] == 0) {
	message('你想知道怎么加入么?', $rule['gzurl'], 'sucessr');
	die;
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
if ($op == 'display') {
	$pindex = max(1, intval($_GPC['page']));
	$psize = 30;
	$explogs = pdo_fetchall('select * from ' . tablename('hc_deluxejjr_experience') . ' where uniacid = ' . $uniacid . ' and mid = ' . $profile['id'] . ' order by createtime desc limit ' . ($pindex - 1) * $psize . ',' . $psize);
	$total = pdo_fetchcolumn('select count(id) from ' . tablename('hc_deluxejjr_experience') . ' where uniacid = ' . $uniacid . ' and mid = ' . $profile['id']);
	$pager = pagination1($total, $pindex, $psize);
	$allexp = 0;
	foreach ($explogs as $e) {
		$allexp = $allexp + $e['exp'];
	}
}
include $this->template('explog');