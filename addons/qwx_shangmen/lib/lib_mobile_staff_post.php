<?php 

	global $_GPC, $_W;
	load()->func('tpl');
	
	//检查用户是否登录：
	checkauth();
	$member = get_member_info();
	$uid = $member['uid'];

	$is_staff = is_staff($uid);
	$op = $_GPC['op'];

	if (!$is_staff){
		message('对不起，你没有权限操作！',$this->createMobileUrl('index'),'error');
	}

	if ($_POST){ 
		$data = array();
		$data = $_GPC['jform'];
                if (!isset($data['online'])) {
                    $data['online'] = 0;
                }
                if ($_GPC['ajax_pic_flag'] && $_SESSION['session_ajax_pic']) {
                    $data['staff_photo'] = $_SESSION['session_ajax_pic'];
                }
                
		pdo_update('daojia_user',$data,array('member_id'=>$uid));
		message('资料修改成功！', $this->createMobileUrl('my', array('op' => 'display')), 'success');
	}
	//读取美容师的资料：
	$sql = "select * from ".tablename('daojia_user')." where uniacid = '{$_W['uniacid']}' and member_id = '{$uid}' limit 1 ";
	$item = pdo_fetch($sql);
        if ($item['staff_photo']) {
            $staff_photo = $this->get_rencai_pic($item['staff_photo']);
        }

	include $this->template('staff_post');

?>