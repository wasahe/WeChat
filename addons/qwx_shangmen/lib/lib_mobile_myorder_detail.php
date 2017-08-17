<?php 
global $_GPC, $_W;
load()->func('tpl');

//检查用户是否登录：
checkauth();
$member = get_member_info();
$uid = $member['uid'];
$order_id = $_GPC['id'];
$op = $_GPC['op'];

//读取订单的数据：
$sql = "select * from ".tablename('daojia_order')." where uniacid = '".$_W['uniacid'] ."' and uid= '".$member['uid']."' and id = '{$order_id}' limit 1 ";
$order = pdo_fetch($sql);
$params = json_decode($order['params'],true);
$order['params'] = json_decode($order['params'],true);
$address = $params['address'];

//取消订单：
if ($op == 'cancel_order' && $order['id']){
        $data = array();
        $data['status'] = 5;
        pdo_update('daojia_order',$data,array('id'=>$order_id));
        message("编号：" . $order['order_sn'] . "的订单取消成功！", $this->createMobileUrl('myorder'), 'success');
}


//读取购物商品的数据：
$where = '';
$sql = "select i.*,g.id as goods_id,g.title,g.photo,g.shijian,i.id as item_id "
        . "from ".tablename('daojia_order_item')." as i "
        ." left join ".tablename('daojia_goods')." as g on i.goods_id = g.id "
        ." where i.uniacid='" . $_W['uniacid'] . "' and i.uid= '{$uid}' and i.order_id = '{$order_id}' {$where} ";
$goods = pdo_fetchall($sql);



	/*todo $tpl_id_short = $this->module['config']['msgid_staff'];
	$uniacid = $params['uniacid'] ? $params['uniacid'] : $_W['uniacid'];
	$rs = send_msg_to_staff($order_id,$tpl_id_short,$uniacid);
	print_r($rs);exit;*/

	//发送预约通知给美容师的测试代码：@test
	/*//读取美容师的openid：
	$staff_id = $order['staff_id'];
	$sql = "select member_id from ".tablename('daojia_user')." where uniacid = '{$_W['uniacid']}' and id = '{$staff_id}' limit 1 ";
	$staff_uid = pdo_fetchcolumn($sql);
	load()->model('mc');
	$result = mc_fansinfo($staff_uid, $_W['acid'], $_W['uniacid']);
	$touser = $result['openid'];

	//读取msg_id:
	$tpl_id_short = $this->module['config']['msgid_staff'];
	// print_r($tpl_id_short);exit;

	if ($touser && $tpl_id_short){
		//组合发送内容：
		$postdata = array();
		$msg_body = '';
		$msg_body .= "客户【{$order['contact_name']}】已经预约了以下美容项目：\r\n";
		if (is_array($goods)){
			foreach ($goods as $key=>$good){
				$key ++;
				// print_r($good);exit;
				$msg_body .= "{$key}. {$good['goods_name']}；\r\n";
			}
		}
		$msg_body .= "上门服务地址：{$order['params']['address']['province']},{$order['params']['address']['city']},{$order['params']['address']['district']},{$order['params']['address']['address']}\r\n";
		// echo $msg_body;exit;
		$postdata['first']['value'] = $msg_body;//详细内容
		$postdata['keynote1']['value'] = $order['yuyue_time'];//上门服务时间
		$postdata['keynote2']['value'] = $order['phone'];//联系电话
		$postdata['keynote3']['value'] = '';//微信号
		$postdata['remark']['value'] = '';//remark
		// print_r($postdata);exit;
		$acc = WeAccount::create($_W['uniacid']);
		$rs = $acc->sendTplNotice($touser, $tpl_id_short, $postdata, $url = '', $topcolor = '#FF683F');
		// print_r($rs);exit;
		
	}*/


	$sum_num = 0;
	$sum_time = 0;
	$sum_money = 0;
	$sum_item = 0;
	// print_r($goods);exit;
	if (is_array($goods)){
		foreach ($goods as $key=>$item){
			$goods[$key]['params'] = json_decode($item['params'],true);
			$goods[$key]['buy_price_format'] = number_format($goods[$key]['buy_price'],2,'.','');
			$goods[$key]['goods'] = $goods[$key]['params']['goods'];
			// print_r($item);exit;

			$sum_num = $sum_num + $item['buy_num'];
			$sum_time = $sum_time + $goods[$key]['goods']['shijian'] * $item['buy_num'];
			$sum_money = $sum_money + $item['buy_price'] * $item['buy_num'];
			$sum_item++;
		}
	}

	//读取美容师的资料：$_SESSION['select_staff_id']
	$select_staff_id = $order['staff_id'];
	$where = '';
	if ($select_staff_id){
		$where .= " and id = '{$select_staff_id}' ";
		$sql = "select * from ".tablename('daojia_user')." where uniacid = '" . $_W['uniacid'] . "' and user_type = 1 {$where} limit 1 ";
		$staff = pdo_fetch($sql);
		// print_r($staff);exit;
                /*
                $post_daojia_fee = get_store_name($staff['staff_store_id'], 'post_daojia_fee');   
                if ($post_daojia_fee > 0) {
                    $free_daojia_fee_reach = get_store_name($staff['staff_store_id'], 'free_daojia_fee_reach');   
                    
                    if ($free_daojia_fee_reach > 0 && $sum_money >= $free_daojia_fee_reach) {       
                    } else {
                        $sum_money += $post_daojia_fee;
                        $post_daojia_fee_msg = '（上门费￥' . $post_daojia_fee . '）';
                    }
                }     */             
                
	}


include $this->template('myorder_detail');
?>