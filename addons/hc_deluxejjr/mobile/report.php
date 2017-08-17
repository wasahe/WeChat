<?php

$active = 1;
if (empty($_COOKIE[$ismobile]) || empty($_COOKIE[$ispwd])) {
	include $this->template('report/login');
	die;
}
$report = pdo_fetch('select * from ' . tablename('yunmall_report') . ' where ischeck = 1 and weid = ' . $weid . ' and mobile = \'' . trim($_COOKIE[$ismobile]) . '\' and pwd = \'' . trim($_COOKIE[$ispwd]) . '\'');
if (empty($report)) {
	include $this->template('report/login');
	die;
}
if ($op == 'display') {
	if (!empty($_GPC['displayorder'])) {
		foreach ($_GPC['displayorder'] as $id => $displayorder) {
			pdo_update('yunmall_category', array('displayorder' => $displayorder), array('id' => $id));
		}
		message('分类排序更新成功！', $this->createMobileurl('category', array('op' => 'display')), 'success');
	}
	$children = array();
	$category = pdo_fetchall('SELECT * FROM ' . tablename('yunmall_category') . ' WHERE weid = \'' . $_W['uniacid'] . '\' ORDER BY parentid ASC, displayorder DESC');
	foreach ($category as $index => $row) {
		if (!empty($row['parentid'])) {
			$children[$row['parentid']][] = $row;
			unset($category[$index]);
		}
	}
	include $this->template('report/categorylist');
}