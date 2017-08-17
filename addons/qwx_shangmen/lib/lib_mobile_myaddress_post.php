<?php
global $_GPC, $_W;
load()->func('tpl');

//检查用户是否登录：
checkauth();
$member = get_member_info();
$id = intval($_GPC['id']);
$op = $_GPC['op'];
$source = $_GPC['source'];

//删除地址：
if ($op == 'delete') {
    //查询是否为默认：
    $sql = "select is_default from " . tablename('daojia_address') . " where uniacid = '{$_W['uniacid']}' and uid= '{$member['uid']}' and id='{$id}' limit 1";
    $is_default = pdo_fetchcolumn($sql);
    pdo_delete('daojia_address', array('id' => $id));
    //重新设定默认地址：
    if ($is_default) {
        $sql = "update " . tablename('daojia_address'). " set is_default = 1 where uniacid = '{$_W['uniacid']}' and uid = '{$member['uid']}' order by id desc limit 1";
        pdo_query($sql);
    }

    message('地址删除成功！', $this->createMobileUrl('myaddress', array(), 'success'));
}


//保存地址：
if ($_POST) {

    if (!$id) {
        $is_new = 1;
    } else {
        $is_new = 0;
    }

    $data = array();
    $data = $_GPC['jform'];
    $area_input = $_GPC['area_input'];
    $data['city'] = $area_input['city'];
    $data['province'] = $area_input['province'];
    $data['district'] = $area_input['district'];
    $data['uid'] = $member['uid'];

    $data['uniacid'] = $_W['uniacid'];
    $data['update_time'] = date("Y-m-d H:i:s");

    if ($is_new) {
        $data['create_time'] = date("Y-m-d H:i:s");
        pdo_insert('daojia_address', $data);
        $id = pdo_insertid();
    } else {
        pdo_update('daojia_address', $data, array('id' => $id));
    }

    //设定为默认地址：
    $is_default = $data['is_default'];
    if ($is_default) {
        //重设为非默认状态：
        $sql = "update " . tablename('daojia_address') . " set is_default = 0 where uniacid = '{$_W['uniacid']}' and uid= '{$member['uid']}' ";
        pdo_query($sql);

        $arr = array();
        $arr['is_default'] = 1;
        pdo_update('daojia_address', $arr, array('id' => $id));
    }

    if ($source == 'order') {
        $_SESSION['select_address_id'] = $id;
        message('地址添加成功！', $this->createMobileUrl('order'), 'success');
    } else {
        message('地址更新成功！', $this->createMobileUrl('myaddress'), 'success');
    }
}


if ($id) {
    //读取地址的资料：
    $sql = "select * from " . tablename('daojia_address') . " where uniacid = '{$_W['uniacid']}' and id = '{$id}' limit 1";
    $item = pdo_fetch($sql);
    if (!$item) {
        message('没有找到该地址！', $this->createMobileUrl('myaddress'), 'error');
    }
}

include $this->template('myaddress_post');
?>