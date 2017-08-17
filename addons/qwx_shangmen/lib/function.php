<?php
function L($info) {
    load()->func('logging');
    logging_run($info);
}

//取指定项目的 1、2级分类 arr
function get_cur_cate($cate_id) {
    global $_W, $_GPC;
    $arr = get_cate_id($cate_id);
    // print_r($arr);exit;
    $return = array();
    if (is_array($arr)) {
        foreach ($arr as $key => $value) {
            $sql = "select * from " . tablename('daojia_goods_cate')
                    . " where  uniacid = '{$_W['uniacid']}' and id = '{$value}' limit 1 ";
            $row = pdo_fetch($sql);
            // echo $sql;exit;
            // print_r($row);exit;
            $return[$key] = $row['title'];
        }
    }
    // print_r($return);exit;
    return $return;
}
function get_cate_id($cate_id) {
    global $_W, $_GPC;
    $sql = "select * from " . tablename('daojia_goods_cate')
            . " where  uniacid = '{$_W['uniacid']}' and id = '{$cate_id}' limit 1 ";
    $arr = pdo_fetch($sql);

    if ($arr['parent_id']) {
        $return['parent_id'] = $arr['parent_id'];
        $return['child_id'] = $arr['id'];
    } else {
        $return['parent_id'] = $arr['id'];
        $return['child_id'] = 0;
    }
    return $return;
    // print_r($return);exit;
}

//分类二级树用
function get_goods_cate() {
    global $_W, $_GPC;
    $sql = "select * from " . tablename('daojia_goods_cate')
            . " where  uniacid = '{$_W['uniacid']}' and parent_id = 0
				ORDER BY orderby desc ";
    $arr = pdo_fetchall($sql);

    $cate1 = array();
    $cate2 = array();
    if (is_array($arr)) {
        foreach ($arr as $key => $val) {
            $cate1[] = array('id' => $val['id'], 'name' => $val['title']);
            
            $sql = "select * from " . tablename('daojia_goods_cate') .
                    " where uniacid = '{$_W['uniacid']}' and parent_id = '{$val['id']}' ORDER BY orderby desc ";
            $arr2 = pdo_fetchall($sql);
            $tmp = array();
            if (is_array($arr2)) {
                foreach ($arr2 as $kk => $ii) {
                    $tmp[] = array('id' => $ii['id'], 'name' => $ii['title']);
                }
            }
            $cate2[$val['id']] = $tmp;
            // print_r($tmp);exit;
        }
    }

    $cate = array();
    $cate['cate1'] = $cate1;
    $cate['cate2'] = $cate2;
    // print_r($cate1);exit;
    return $cate;
}

//订单的第一个商品
function get_first_goods($order_id) {
    global $_W;
    $sql = "select * from " . tablename('daojia_order_item') .
            " where uniacid = '{$_W['uniacid']}' and order_id = '{$order_id}' order by id asc limit 1 ";
    // echo $sql;exit;
    $goods = pdo_fetch($sql);
    $goods['params'] = json_decode($goods['params']);

    $arr = array();
    $arr['goods_name'] = $goods['goods_name'];
    $arr['daojia'] = get_daojia_statsu($goods['daojia']);

    // print_r($arr);exit;
    return $arr;
}
function get_daojia_statsu($daojia) {
    return $daojia ? '上门服务' : '到店服务';
}

function get_staff_name($staff_id, $get_key = 'staff_name') {
    global $_W;
    $sql = "select {$get_key} from " . tablename('daojia_user') .
            " where uniacid = '{$_W['uniacid']}' and id = '{$staff_id}' and user_type = 1 limit 1 ";
    // echo $sql;exit;
    $staff_name = pdo_fetchcolumn($sql);
    return $staff_name;
}

//get order status:
function get_order_status($status, $show_span = false) {
    $val = '';
    switch ($status) {
        case 1:
            $label_css = 'primary';
            $val = '已确认';
            break;
        case 2:
            $label_css = 'success';
            $val = '已成功';
            break;
        case 5:
            $label_css = 'danger';
            $val = '已取消';
            break;
        default:
            $label_css = 'info';
            $val = '未确认';
            break;
    }
    if ($show_span) {
        return '<span class="label label-'.$label_css.'">' . $val . '</span>&nbsp;';
    } else {
        return $val;
    }
}
//get pay status:
function get_payment_status($status, $show_span = false) {
    $val = '';
    switch ($status) {
        case 1:
            $label_css = 'primary';
            $val = '货到付款';
            break;
        case 2:
            $label_css = 'success';
            $val = '已付款';
            break;
        case 5:
            $label_css = 'danger';
            $val = '付款失败';
            break;
        default:
            $label_css = 'info';
            $val = '未付款';
            break;
    }
    if ($show_span) {
        return '<span class="label label-'.$label_css.'">' . $val . '</span>&nbsp;';
    } else {
        return $val;
    }    
}
//get pay status:
function get_service_status($status, $show_span = false) {
$val = '';
    switch ($status) {
        case 1:
            $label_css = 'primary';
            $val = '服务中';
            break;
        case 2:
            $label_css = 'success';
            $val = '服务完成';
            break;
        case 5:
            $label_css = 'danger';
            $val = '服务取消';
            break;
        default:
            $label_css = 'info';
            $val = '未开始';
            break;
    }
    if ($show_span) {
        return '<span class="label label-'.$label_css.'">' . $val . '</span>&nbsp;';
    } else {
        return $val;
    }    
}

function is_staff($uid) {
    global $_W;
    $sql = "select user_type from " . tablename('daojia_user') .
            " where uniacid = '{$_W['uniacid']}' and member_id = '{$uid}' limit 1 ";
    // echo $sql;exit;
    $user_type = pdo_fetchcolumn($sql);
    return $user_type;
}
function is_vip($groupid, $config) {
    global $_W;
    if ($groupid == $config['vip_usergroup']) {
        return true;
    } else {
        return false;
    }
}
//get store name:
function get_store_name($store_id, $field_name = 'title') {
    global $_W;
    if ($store_id) {
        $sql = "select {$field_name} from " . tablename('daojia_store') .
                " where uniacid = '{$_W['uniacid']}' and id = '{$store_id}' limit 1 ";
        return pdo_fetchcolumn($sql);
    } else {
        return '';
    }
}
/**
 * 得到新订单号
 * @return  string
 */
function get_order_sn() {
    /* 选择一个随机的方案 */
    mt_srand((double) microtime() * 1000000);
    return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
}
//读取当前会员的资料：
function get_member_info() {
    global $_W;
    load()->model('mc');
    $uid = (int) $_W['member']['uid'];
    $member = mc_fetch($uid);
    return $member;
}
function get_senssion_id() {
    $session_id = $_SESSION['session_id'];
    if (!$session_id) {
        $session_id = md5(time() . rand(10000, 999999));
        $_SESSION['session_id'] = $session_id;
    }
    return $session_id;
}
//把当前购物车的数据写入会员ID
function update_cart_uid() {
    global $_W;
    $uid = (int) $_W['member']['uid'];
    $session_id = get_senssion_id();
    if ($uid) {
        $sql = "update " . tablename('daojia_cart')
                . " set uid = '{$uid}' where uniacid='{$_W['uniacid']}' and session_id = '{$session_id}' ";
        // echo $sql;exit;
        pdo_query($sql);
    }
}
//格式化文本：
function get_html($string) {
    return htmlspecialchars_decode($string);
}
//获得首页的网址：
function getHomeUrl() {
    return murl('entry', array('do' => 'index', 'm' => 'qwx_shangmen'));
}
function get_share_info($config) {
    global $_W;
    $_share = array(
        'title' => $config['share_title'] ? $config['share_title'] : $config['site_name'],
        'content' => $config['share_desc'] ? $config['share_desc'] : $config['site_name']
    );

    if ($config['share_photo']) {
        $_share['imgUrl'] = $_W['attachurl'] . $config['share_photo'];
    }
    return $_share;
}
function getStaffFieldsLabel($field = 'staff_name') {
        global $_W, $_GPC;
        
        $condition = " uniacid=" . $_W['uniacid'];
        if ($field) {
            $condition .= " and `field` = '{$field}'";
        }

        $sql = "SELECT * "
                . "FROM " . tablename('daojia_form') . "  "
                . "WHERE $condition "
                . "ORDER BY sort ASC, id ASC"; 
        $field_data = pdo_fetch($sql);
        $label = $field_data['user_label'] ? $field_data['user_label'] : $field_data['label'];
        if (!$label) {
            $label = '美容师';
        }
        return $label;
    }


function send_msg_to_staff($order_id, $tpl_id_short, $uniacid, $msgid_resort) {
    global $_W;
    load()->func('logging');
    //读取订单的数据：
    $sql = "select * from " . tablename('daojia_order') . " where uniacid = '{$uniacid}' and id = '{$order_id}' limit 1 ";
    $order = pdo_fetch($sql);
    $order['params'] = json_decode($order['params'], true);

    //读取购物商品的数据：
    $where = '';
    $sql = "select i.*,g.id as goods_id,g.title,g.photo,g.shijian,i.id as item_id "
            . "from " . tablename('daojia_order_item') . " as i "
            . " left join " . tablename('daojia_goods') . " as g on i.goods_id = g.id "
            . " where i.uniacid='{$uniacid}' and i.uid= '{$order['uid']}' and i.order_id = '{$order['id']}' {$where} ";
    $goods = pdo_fetchall($sql);
    //读取美容师的openid：

    $staff_id = $order['staff_id'];
    $sql = "select member_id from " . tablename('daojia_user') . " where uniacid = '{$uniacid}' and id = '{$staff_id}' limit 1 ";
    $staff_uid = pdo_fetchcolumn($sql);


    /* load()->model('mc');
      $result = mc_fansinfo($staff_uid, '', $uniacid);
      $touser = $result['openid']; */

    $sql = "select openid from " . tablename('mc_mapping_fans') . " where uniacid = '{$uniacid}' and uid = '{$staff_uid}' ";
    $touser = pdo_fetchcolumn($sql);

    if ($touser && $tpl_id_short) {
        //组合发送内容：
        $postdata = array();

        $user_name = $order['contact_name'];
        $need_item = '';
        if (is_array($goods)) {
            foreach ($goods as $key => $good) {
                $key ++;
                if ($need_item) {
                    $need_item .= "\r\n";
                }
                $need_item .= "{$key}. {$good['goods_name']}；";
            }
        }

        //上门服务地址 \r\n
        $user_family_address .= "{$order['params']['address']['province']},{$order['params']['address']['city']},{$order['params']['address']['district']},{$order['params']['address']['address']}";
        $user_ask_time = $order['yuyue_time'];

        /**
          美容师您好，您有新的预约订单：
          客户名称：张小红
          客户手机：13688888888
          服务项目：面部香薰SPA护理
          预约时间：2014-12-31 16:00
          预约地址：广州市天河区华景路31号6楼
        
          请留意预约时间，并及时为您的客户提供服务
         */
        $postdata['first']['value'] = getStaffFieldsLabel().'您好，您有新的预约订单：';
        $postdata['first']['color'] = '#FF0000';

        //'user' => array('value' => $name, 'color' => '#0A0A0A'),
        $postdata['keyword1']['value'] = $user_name;
        $postdata['keyword2']['value'] = $order['phone'];
        $postdata['keyword3']['value'] = $need_item;
        $postdata['keyword4']['value'] = $user_ask_time;
        $postdata['keyword5']['value'] = $user_family_address;
        $postdata_bak = $postdata;
        
        //$msgid_resort = $this->getConfigArr('msgid_resort');
        if ($msgid_resort == '') {
            $msgid_resort = '1_2_3_4_5';
        }
        $msgid_resort_arr = explode('_', $msgid_resort);
        foreach ($msgid_resort_arr as $key => $val) {
            $postdata['keyword' . $val]['value'] = $postdata_bak['keyword' . ($key+1)]['value'];
        }

        $postdata['remark']['value'] = "\r\n" . '请留意预约时间，并及时为您的客户提供服务'; //remark
        
        $acc = WeAccount::create($uniacid);
        $rs = $acc->sendTplNotice($touser, $tpl_id_short, $postdata, $url = '', $topcolor = '#FF683F');
    }

    return $rs;
}
?>