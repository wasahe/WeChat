<?php 
global $_GPC, $_W;
load()->func('tpl');

$is_ajax = (int)$_GPC['is_ajax'];
$op = $_GPC['op'];

$member = get_member_info();
$uid = $member['uid'];
$is_vip = is_vip($member['groupid'],$this->module['config']);//判断是否为vip用户；
	
//处理ajax的请求：from goods page
if ($is_ajax){
        if ($op == 'add_cart'){
                $return = new stdClass();
                $return->code = 0;
                $return->msg = '';

                $goods_id = $_GPC['goods_id'];
                $price = $_GPC['price'];
                $is_vip = $_GPC['is_vip'];
                if (isset($_GPC['daojia'])) {
                    $daojia = (int) $_GPC['daojia'];//是否上门
                } else {
                    $daojia = -1;
                }

                if (isset($_GPC['buy_num'])) {
                    $buy_num = (int) $_GPC['buy_num'];
                } else {
                    $buy_num = 1;
                }

                $html = (int)$_GPC['html'];

                // print_r($uid);exit;

                //读取项目的数据：
                $sql = "select * from ".tablename("daojia_goods")." where uniacid = '{$_W['uniacid']}' and id = '{$goods_id}' and status = 1 limit 1 ";
                $goods = pdo_fetch($sql);
                if (!$goods){
                    $return->msg = '没有该项目的资料。';
                    echo json_encode($return);exit;
                }

                //检查该用户的购物车是否有该商品：
                $uid = (int)$_W['member']['uid'];
                $session_id = get_senssion_id();

                $where = '';
                if ($uid){
                        $where .= " and uid = '{$uid}' ";
                }else{
                        $where .= " and session_id = '{$session_id}' ";
                }
                $sql = "select * from ".tablename('daojia_cart')." where uniacid='{$_W['uniacid']}' {$where} and goods_id = '{$goods_id}' limit 1 ";
                $cart_goods = pdo_fetch($sql);
                
                // print_r($cart_goods);exit;
                $params = array();
                $discount = 0;
                $params['goods'] = $goods;
                $params['is_vip'] = $is_vip;
                // print_r($params);exit;

                $data = array();
                $data['price'] = $goods['price'];
                $data['discount'] = $discount;
                if ($daojia>-1){
                    $data['daojia'] = $daojia;
                }
                $data['params'] = json_encode($params);
                $data['create_time'] = date("Y-m-d H:i:s");

                if ($cart_goods){
                        if ($buy_num==0){
                                //删除该商品：
                                pdo_delete('daojia_cart',array('id'=>$cart_goods['id']));
                                $cart_id = $cart_goods['id'];
                        }else{
                                //更新购物车：
                                if (!$buy_num){
                                    $buy_num = 1;
                                }
                                $data['buy_price'] = $price;
                                $data['buy_num'] = $buy_num;
                                $cart_id = $cart_goods['id'];
                                // print_r($data);exit;
                                pdo_update('daojia_cart',$data,array('id'=>$cart_id));
                        }


                }else{
                        if (!$buy_num){
                                $buy_num = 1;
                        }

                        $data['uniacid'] = $_W['uniacid'];
                        $data['uid'] = $uid;
                        $data['session_id'] = $session_id;
                        $data['goods_id'] = $goods_id;
                        $data['goods_name'] = $goods['title'];
                        $data['price'] = $goods['price'];
                        $data['buy_price'] = $price;
                        $data['buy_num'] = $buy_num;
                        $data['discount'] = $discount;
                        $data['daojia'] = $daojia;
                        $data['create_time'] = date("Y-m-d H:i:s");
                        // print_r($data);exit;

                        pdo_insert('daojia_cart',$data);
                        $cart_id = pdo_insertid();
                }

                if ($cart_id){
                        $return->code = 1;
                        $return->msg = '成功添加到购物车！';
                }

                if ($html==1){
                        //显示购物车的数据：
                        //$uid = (int)$_W['member']['uid'];
                        //$session_id = get_senssion_id();

                        $where = '';
                        if ($uid){
                                $where .= " and uid = '{$uid}' ";//90
                        }else{
                                $where .= " and session_id = '{$session_id}' ";
                        }
                        $sql = "select * from ".tablename('daojia_cart')." where uniacid='{$_W['uniacid']}' {$where} ";
                        $cart_goods = pdo_fetchall($sql);

                        $sum_num = 0;//购买数量
                        $sum_time = 0;//总服务时长
                        $sum_money = 0;//buy_price和
                        $sum_item = 0;//购物车记录数

                        if (is_array($cart_goods)){
                                foreach ($cart_goods as $key=>$item){
                                        $cart_goods[$key]['params'] = json_decode($item['params'],true);
                                        $cart_goods[$key]['buy_price_format'] = number_format($cart_goods[$key]['buy_price'],2,'.','');
                                        $cart_goods[$key]['goods'] = $cart_goods[$key]['params']['goods'];// goods is array

                                        $sum_num = $sum_num + $item['buy_num'];
                                        $sum_time = $sum_time + $cart_goods[$key]['goods']['shijian'] * $item['buy_num'];
                                        $sum_money = $sum_money + $item['buy_price']* $item['buy_num'];
                                        $sum_item++;
                                }
                        }

                        //返回数据：
                        $return->sum_num = $sum_num ;
                        $return->sum_time = $sum_time ;
                        $return->sum_money = $sum_money ;
                        $return->sum_item = $sum_item;

                }

                echo json_encode($return);
                exit;

        }
}

	
//显示购物车的数据：
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
}

include $this->template('cart');

?>