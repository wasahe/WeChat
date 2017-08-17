<?php 
global $_GPC, $_W;
load()->func('tpl');

//检查用户是否登录：
checkauth();
$member = get_member_info();
$uid = $member['uid'];

$post_daojia_fee = 0;
$free_daojia_fee_reach = 0;

	if ($_POST){
		$return = new stdClass();
		$return->code = 0;
		$return->msg = '';

		$select_address_id = $_SESSION['select_address_id'];// my address id
		$select_staff_id = $_SESSION['select_staff_id'];
		$select_yuyue_time = $_SESSION['select_yuyue_time'];

		if (!$select_address_id){
                    $return->msg = '请填写联系地址';
                    echo json_encode($return);exit;
		}

		if (!$select_staff_id){
                    $return->msg = '请选择'.$this->getFieldsLabel('staff_name').'！';
                    echo json_encode($return);exit;
		}
		// echo $select_address_id .'=>'.$select_staff_id;exit;

		//檢查購物車是否還有商品：
		$uid = (int)$_W['member']['uid'];
		$session_id = get_senssion_id();
		// echo $session_id;exit;
		$where = '';
		if ($uid){
                    $where .= " and uid = '{$uid}' ";
		}else{
                    $where .= " and session_id = '{$session_id}' ";
		}

		$sql = "select * from ".tablename('daojia_cart')." where uniacid='{$_W['uniacid']}' {$where} ";
		$cart_goods = pdo_fetchall($sql);
		if (!$cart_goods){
                    message('购物车没有项目，请先选择服务项目！',$this->createMobileUrl('index'),'error');
		}

		//計算總價：
		$sum_num = 0;
		$sum_time = 0;
		$sum_money = 0;
		$sum_item = 0;

		if (is_array($cart_goods)){
			foreach ($cart_goods as $key=>$item){
				$cart_goods[$key]['params'] = json_decode($item['params'],true);
				$cart_goods[$key]['buy_price_format'] = number_format($cart_goods[$key]['buy_price'],2,'.','');
				$cart_goods[$key]['goods'] = $cart_goods[$key]['params']['goods'];

				$sum_num = $sum_num + $item['buy_num'];
				$sum_time = $sum_time + $cart_goods[$key]['goods']['shijian'] * $item['buy_num'];
				$sum_money = $sum_money + $item['buy_price']* $item['buy_num'];
				$sum_item++;
			}

                        
                        $sql = "select * from " . tablename('daojia_user') ." where uniacid = '{$_W['uniacid']}' and user_type = 1 and id = '{$select_staff_id}' limit 1 ";
                        $staff = pdo_fetch($sql);  
                        
                        $post_daojia_fee = get_store_name($staff['staff_store_id'], 'post_daojia_fee');   
                        if ($post_daojia_fee > 0) {
                            $free_daojia_fee_reach = get_store_name($staff['staff_store_id'], 'free_daojia_fee_reach');  

                            if ($free_daojia_fee_reach > 0 && $sum_money >= $free_daojia_fee_reach) {   
                                $post_daojia_fee = 0;
                            } else {
                                //$sum_money += $post_daojia_fee;
                                //$post_daojia_fee_msg = '（上门费￥' . $post_daojia_fee . '）';
                            }
                        }                                                  
		}

		// print_r($cart_goods);exit;

		//生成订单号,重试5次
		for ($try=0;$try=5;$try++){
			$order_sn = get_order_sn();
			//检查订单号是否已经存在：
			$sql = "select id from ".tablename('daojia_order')." where uniacid='{$_W['uniacid']}' and order_sn = '{$order_sn}' limit 1";
			$check = pdo_fetchcolumn($sql);
			// echo $check;exit;
			if (!$check){
				break;
			}
		}

		$params = array();
		//读取地址数据：
		$address_id = $select_address_id ? $select_address_id : $_POST['address_id'];
		$sql = "select * from ".tablename('daojia_address')." where uniacid='{$_W['uniacid']}' and uid = '{$member['uid']}' and id = '{$address_id}' limit 1 ";
		$address = pdo_fetch($sql);
		$params['address'] = $address;
		// print_r($params);exit;

		//組合订单需要的資料：
		$order = array();
		$order['uniacid'] = $_W['uniacid'];
		$order['uid'] = $member['uid'];
		$order['order_sn'] = $order_sn;
		$order['contact_name'] = $address['name'];
		$order['phone'] = $address['phone'];
		$order['price'] = $sum_money;
		$order['discount'] = $discount;
		$order['buy_price'] = $sum_money;
                $order['daojia_fee'] = $post_daojia_fee;
		$order['service_status'] = 0;
		$order['payment_status'] = 0;
		$order['status'] = 0;
		$order['params'] = json_encode($params);
		$order['address_id'] = $select_address_id;
		$order['staff_id'] = $select_staff_id;
		$order['yuyue_time'] = $select_yuyue_time;
		$order['memo'] = $_GPC['memo'];
		$order['create_time'] = $order['update_time'] = date("Y-m-d H:i:s");

		//格式化价格：
		$order['price']= number_format($order['price'],2,'.','');
		$order['discount']= number_format($order['discount'],2,'.','');
		$order['buy_price']= number_format($order['buy_price'],2,'.','');
		// print_r($order);exit;//@test;

		//寫入訂單表：
		pdo_insert('daojia_order',$order);
		$order_id = pdo_insertid();

		//寫入訂單商品表：
		if (is_array($cart_goods)){
			foreach ($cart_goods as $key=>$item){
				$goods = array();
				$goods['uniacid'] = $_W['uniacid'];
				$goods['uid'] = $member['uid'];
				$goods['order_id'] = $order_id;
				$goods['goods_id'] = $item['goods_id'];
				$goods['goods_name'] = $item['goods_name'];
				$goods['daojia'] = $item['daojia'];
				$goods['buy_num'] = $item['buy_num'];
				$goods['price'] = $item['buy_price'];
				$goods['discount'] = $item['discount'];
				$goods['price_total'] = $item['buy_price']*$item['buy_num'];
				$goods['price_total_real'] = $item['buy_price']*$item['buy_num'] - $item['discount'];
				$goods['params'] = json_encode($item);
				pdo_insert('daojia_order_item',$goods);
				// print_r($goods);exit;//@test;
			}
		}

		//清除購物車的商品：
		$sql = "delete from ".tablename('daojia_cart')." where (uid = '{$member['uid']}' or session_id = '{$session_id}') ";
		pdo_query($sql);
		$_SESSION['select_address_id'] = 0;
		$_SESSION['select_staff_id'] = 0;
		$_SESSION['select_yuyue_time'] = '';

		//返回：
		$return->order_sn = $order_sn;
		$return->order_id = $order_id;
		$return->buy_price = $order['buy_price'];
		$return->code = 1;
		$return->msg = '已经生成订单。';
		echo json_encode($return);exit;
	}

	
//读取数据：
//读取默认地址：
update_cart_uid();

$select_address_id = $_SESSION['select_address_id'];
$where = '';
if ($select_address_id){
    $where .= " and id = '{$select_address_id}' ";
}else{

}
$sql = "select * from ".tablename('daojia_address')." where uniacid = '{$_W['uniacid']}' and uid= '{$member['uid']}' {$where} order by is_default desc, id asc limit 1 ";
$address = pdo_fetch($sql);

if (!$_SESSION['select_address_id']){
        $_SESSION['select_address_id'] = $address['id'];
}
// print_r($address);exit;

//读取美容师的资料：$_SESSION['select_staff_id']
$select_staff_id = $_SESSION['select_staff_id'];
$select_yuyue_time = $_SESSION['select_yuyue_time']; //预约时间
$where = '';
if ($select_staff_id) {
    $where .= " and id = '{$select_staff_id}' ";
    $sql = "select * from " . tablename('daojia_user') ." where uniacid = '{$_W['uniacid']}' and user_type = 1 {$where} limit 1 ";
    $staff = pdo_fetch($sql);
    // print_r($staff);exit;
    $post_daojia_fee = get_store_name($staff['staff_store_id'], 'post_daojia_fee');   
    if ($post_daojia_fee > 0) {
        $free_daojia_fee_reach = get_store_name($staff['staff_store_id'], 'free_daojia_fee_reach');   
    }    
}

//读取购物车的数据：显示购物车的数据：
$uid = (int)$_W['member']['uid'];
$session_id = get_senssion_id();
$where = '';
if ($uid){
    $where .= " and uid = '{$uid}' ";
}else{
    $where .= " and session_id = '{$session_id}' ";
}
$sql = "select * from ".tablename('daojia_cart')." where uniacid='{$_W['uniacid']}' {$where} ";
$cart_goods = pdo_fetchall($sql);
// print_r($cart_goods);exit;
if (!$cart_goods){
    message('购物车没有项目，请先选择服务项目！',$this->createMobileUrl('index'),'error');
}

$sum_num = 0;
$sum_time = 0;
$sum_money = 0;
$sum_item = 0;
if (is_array($cart_goods)) {
    foreach ($cart_goods as $key => $item) {
        $cart_goods[$key]['params'] = json_decode($item['params'], true);
        $cart_goods[$key]['buy_price_format'] = number_format($cart_goods[$key]['buy_price'], 2, '.', '');
        $cart_goods[$key]['goods'] = $cart_goods[$key]['params']['goods'];

        $sum_num = $sum_num + $item['buy_num'];
        $sum_time = $sum_time + $cart_goods[$key]['goods']['shijian'] * $item['buy_num'];
        $sum_money = $sum_money + $item['buy_price'] * $item['buy_num'];
        $sum_item++;
    }
}
if ($post_daojia_fee > 0) {
    if ($free_daojia_fee_reach > 0 && $sum_money >= $free_daojia_fee_reach) {       
    } else {
        $sum_money += $post_daojia_fee;
        $post_daojia_fee_msg = '（上门费￥' . $post_daojia_fee . '）';
    }
} 

include $this->template('order');

?>