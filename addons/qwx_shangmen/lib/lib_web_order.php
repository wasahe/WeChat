<?php

global $_GPC, $_W;
load()->func('tpl');
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';

if ($op == 'detail') {
    $id = intval($_GPC['id']);

    if (!$id) {
        message('没有找到该订单！', '', 'error');
    }

    // if ($_POST) {//@test;
    if (checksubmit('submit')) {
        // print_r($_POST);exit;

        $data = array();
        $data = $_GPC['jform'];

        $area_input = $_GPC['area_input'];
        $data['city'] = $area_input['city'];
        $data['province'] = $area_input['province'];
        $data['district'] = $area_input['district'];

        $baidumap = $_GPC['baidumap'];
        $data['lng'] = $baidumap['lng'];
        $data['lat'] = $baidumap['lat'];

        $data['uniacid'] = $_W['uniacid'];
        $data['create_time'] = date("Y-m-d H:i:s");
        $data['update_time'] = date("Y-m-d H:i:s");
        // print_r($data);exit;

        if ($is_new) {
            pdo_insert('daojia_order', $data);
            $id = pdo_insertid();
        } else {
            pdo_update('daojia_order', $data, array('id' => $id));
        }

        message('资料更新成功！', $this->createWebUrl('order', array('op' => 'display')), 'success');
    }

    //读取资料：
    $sql = "select * from " . tablename('daojia_order') . " where uniacid = '{$_W['uniacid']}' and id='{$id}' limit 1 ";
    $order = pdo_fetch($sql);
    $order['params'] = json_decode($order['params'], true);
    $address = $order['params']['address'];

    //读取商品的信息：
    $sql = "select * from " . tablename('daojia_order_item') .
            " where uniacid = '{$_W['uniacid']}' and order_id = '{$id}' order by id asc ";
    $goods = pdo_fetchall($sql);

    $sum_num = 0;
    $sum_time = 0;
    $sum_money = 0;
    $sum_item = 0;
    // print_r($goods);exit;
    if (is_array($goods)) {
        foreach ($goods as $key => $item) {

            $goods[$key]['params'] = json_decode($item['params'], true);
            $goods[$key]['buy_price_format'] = number_format($goods[$key]['buy_price'], 0, '.', ''); // buy_price todo? -> price_total_real
            $goods[$key]['goods'] = $goods[$key]['params']['goods'];
            // print_r($item);exit;

            $sum_num = $sum_num + $item['buy_num'];
            $sum_time = $sum_time + $goods[$key]['goods']['shijian'] * $item['buy_num'];
            $sum_money = $sum_money + $item['buy_price'] * $item['buy_num'];
            $sum_item++;
        }
    }
    // print_r($goods);exit;
    // echo $sum_time;exit;
    //读取美容师的资料：$_SESSION['select_staff_id']
    $select_staff_id = $order['staff_id'];
    $where = '';
    if ($select_staff_id) {
        $staff_name = get_staff_name($select_staff_id);
    }

    include $this->template('order_detail');
} else if ($op == 'ajax_update_status') {
    $order_id = $_GPC['order_id'];
    $data = array();
    $data[$_GPC['act_type']] = $_GPC['val'];
    pdo_update('daojia_order', $data, array('id' => $order_id));
    $return = array();
    $return['code'] = 1;
    $return['msg'] = '成功更新状态！';
    echo json_encode($return);
    exit;
} else if ($op == 'delete') {
    $id = intval($_GPC['id']);
    $id_arr = $_GPC['delete'];
    if (!is_array($id_arr)) {
        $id = intval($_GPC['id']);
        $id_arr[] = $id;
    }
    // print_r($id_arr);exit;
    // echo $id;exit;

    if (is_array($id_arr) && sizeof($id_arr)) {
        foreach ($id_arr as $id) {
            $sql = "delete from " . tablename('daojia_order') . " WHERE uniacid = {$_W['uniacid']} and id = '{$id}' limit 1 ";
            // echo $sql;exit;
            pdo_query($sql);
            //删除关联的项目：
            $sql = "delete from " . tablename('daojia_order_item') . " WHERE uniacid = {$_W['uniacid']} and order_id = '{$id}'  ";
            // echo $sql;exit;
            pdo_query($sql);
        }
    } else {
        message('抱歉，要删除的项目不存在或是已经被删除！');
    }

    message('删除成功！', $this->createWebUrl('order', array('op' => 'display')), 'success');
} else {
    //display list:
    //显示资源列表；
    $pindex = max(1, intval($_GPC['page']));
    $psize = 15;

    //filter:
    $condition = ' and a.id != "" ';
    if (!empty($_GPC['keyword'])) {
        $condition .= " AND a.order_sn LIKE '%{$_GPC['keyword']}%'";
    }

    if ($_GPC['status'] > -1) {
        $condition .= " AND a.status = '" . intval($_GPC['status']) . "'";
    } else {
        $_GPC['status'] = -1;
    }

    if ($_GPC['payment_status'] > -1) {
        $condition .= " AND a.payment_status = '" . intval($_GPC['payment_status']) . "'";
    } else {
        $_GPC['payment_status'] = -1;
    }

    if ($_GPC['service_status'] > -1) {
        $condition .= " AND a.service_status = '" . intval($_GPC['service_status']) . "'";
    } else {
        $_GPC['service_status'] = -1;
    }

    //不显示被隐藏的订单，特征是status=-1;
    $condition .= ' and a.status >= 0 ';
    $sql = "SELECT a.* "
            . "FROM " . tablename('daojia_order') . " as a " .
            " WHERE a.uniacid = '{$_W['uniacid']}' $condition ORDER BY a.create_time DESC LIMIT " .
            ($pindex - 1) * $psize . ',' . $psize;
    // echo $sql;exit;
    $list = pdo_fetchall($sql);
    // print_r($list);exit;
    $sql = "SELECT COUNT(*) FROM " . tablename('daojia_order') . " as a WHERE a.uniacid = '{$_W['uniacid']}' $condition ";
    $total = pdo_fetchcolumn($sql);
    $pager = pagination($total, $pindex, $psize);

    if (is_array($list)) {
        foreach ($list as $key => $item) {
            // print_r($item);exit;
            $goods = get_first_goods($item['id']);
            $list[$key]['goods_name'] = $goods['goods_name'];
            $list[$key]['daojia_name'] = $goods['daojia'];
        }
    }

    // print_r($list);exit;

    include $this->template('order');
}
?>