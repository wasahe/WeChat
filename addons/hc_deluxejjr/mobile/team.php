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
$profile = pdo_fetch('SELECT id, status FROM ' . tablename('hc_deluxejjr_member') . ' WHERE uniacid = :uniacid AND openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
$id = $profile['id'];
if (intval($id) && $profile['status'] == 0) {
	include $this->template('forbidden');
	die;
}
if (empty($profile)) {
	message('请先注册', $this->createMobileUrl('register'), 'error');
	die;
}
$areas = pdo_fetchall('select distinct location_a from ' . tablename('hc_deluxejjr_loupan') . ' where uniacid = ' . $uniacid . ' and isview = 1 order by displayorder desc');
$pindex = max(1, intval($_GPC['page']));
$psize = 30;
$team = pdo_fetchall('select realname, mobile from ' . tablename('hc_deluxejjr_member') . ' where tjmid =' . $id . ' ORDER BY id DESC limit ' . ($pindex - 1) * $psize . ',' . $psize);
$total = pdo_fetchcolumn('select count(id) from ' . tablename('hc_deluxejjr_member') . 'where tjmid =' . $id);
$pager = pagination1($total, $pindex, $psize);
include $this->template('term');