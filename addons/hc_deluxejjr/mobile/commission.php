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
$mycommission = pdo_fetchcolumn('select commission from' . tablename('hc_deluxejjr_member') . ' where id =' . $profile['id']);
$commission = pdo_fetchcolumn('select sum(commission) from' . tablename('hc_deluxejjr_commission') . ' where ischeck = 1 and flag != 2 and mid =' . $profile['id'] . ' and uniacid =' . $uniacid);
$comm = $commission - $profile['commission'];
if ($op == 'more') {
	$op = 'more';
	$pindex = max(1, intval($_GPC['page']));
	$psize = 10;
	$list = pdo_fetchall('select co.*, cu.realname from ' . tablename('hc_deluxejjr_commission') . ' as co left join ' . tablename('hc_deluxejjr_customer') . ' as cu on co.cid = cu.id and co.uniacid = cu.uniacid where co.ischeck = 1 and co.mid =' . $profile['id'] . ' and co.flag != 2 ORDER BY co.createtime DESC limit ' . ($pindex - 1) * $psize . ',' . $psize);
	$total = pdo_fetchcolumn('select count(id) from ' . tablename('hc_deluxejjr_commission') . ' where mid =' . $profile['id'] . ' and ischeck = 1 and flag != 2');
	$pager = pagination1($total, $pindex, $psize);
} else {
	$list = pdo_fetchall('select co.*, cu.realname from ' . tablename('hc_deluxejjr_commission') . ' as co left join ' . tablename('hc_deluxejjr_customer') . ' as cu on co.cid = cu.id and co.uniacid = cu.uniacid where co.ischeck = 1 and co.mid =' . $profile['id'] . ' and co.flag != 2 ORDER BY co.createtime DESC limit 10');
	$total = pdo_fetchcolumn('select count(id) from ' . tablename('hc_deluxejjr_commission') . ' where mid =' . $profile['id'] . ' and ischeck = 1 and flag != 2');
}
include $this->template('commission');