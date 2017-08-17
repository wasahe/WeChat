<?php 

	global $_GPC, $_W;
	load()->func('tpl');
	//检查用户是否登录：
	checkauth();
	$member = get_member_info();
	$uid = $member['uid'];
	// print_r($member);exit;

	$is_staff = is_staff($uid);
	$op = $_GPC['op'];


	include $this->template('my');

?>