<?php 
	global $_GPC, $_W;
	load()->func('tpl');

	//检查用户是否登录：
	checkauth();
	$member = get_member_info();
	$uid = $member['uid'];

	$op = $_GPC['op'];
	if ($op == 'select_address'){
		$_SESSION['select_address_id'] = $_GPC['address_id'];
		$return = array();
		$return['code'] = 1;
		$return['msg'] = '地址选择成功！';
		echo json_encode($return);exit;
	}

	$source = $_GPC['source'];
	$is_order_from = 0;
	if ($source == 'order'){
            $is_order_from = 1;
	}

	$sql = "select * from ".tablename('daojia_address') . " where uniacid = '" . $_W['uniacid'] . "' and uid= '" . $member['uid'] . "' order by is_default desc, id desc ";
	$list = pdo_fetchall($sql);
	

	include $this->template('myaddress');

?>