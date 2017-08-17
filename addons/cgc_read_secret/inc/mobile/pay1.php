<?php
if($_W['ispost']) {
    $cgc_read_secret_record= new cgc_read_secret_record();   
    $data=array("uniacid"=>$_W['uniacid'],
	  "openid"=>$_GPC['openid'],
      "nickname"=>trim($_GPC['nickname']),
	  "sleep_user_id"=>$_GPC['sleep_user_id'],
	  "sleep_nickname"=>$_GPC['sleep_nickname'],
	  "headimgurl"=>$_GPC['headimgurl'],	 
	  "nickname"=>$userinfo['nickname'],	
	  "payment"=>$_GPC['payment'],	
	  "createtime"=>time(),
	);	
	$data['order_sn']=time().mt_rand(1,10000);
			
	$id=$cgc_read_secret_record->insert($data);
	if (!empty($id)){
		exit(json_encode(array("code"=>1,"orderid"=>$id)));
	} else {
		exit(json_encode(array("code"=>0,"msg"=>"插入错误")));
	}
}
	


if ($op=="tj"){	
$orderid= intval($_GPC['orderid']);
$order= pdo_fetch("SELECT * FROM ".tablename('cgc_share_url')." WHERE `uniacid` = :uniacid and id=:id ", array(':uniacid'=>$weid,':id'=>$orderid));

if ($order['pay_status'] != '0') {
    message('抱歉，您的订单已经付款或是被关闭，请重新进入付款！', $this->createMobileUrl('cgc_share_url'), 'error');
}


if ($settings['debug_mode']){
 $order["zf_money"]=1;
}	
$params['tid'] = $orderid;
$params['user'] = $_W['fans']['from_user'];
$params['fee'] =$order["zf_money"];


$this->insert_member($userinfo);

$params['title'] = empty($m['title'])?"花钱睡我":$m['title'];
$params['ordersn'] = $order['order_sn'];

$this->pay($params);
	
    
     
 	$records=$cgc_read_secret_record->insert("and openid='{$_W['openid']}' and pay_status=1");
 	
    $trade = array();
    $trade['sn'] = date('YmdHis') . sprintf('%04d', $_W['uniacid']) . util_random(4, true);
    $trade['openid'] = $openid;
    $trade['fee'] = floatval($_GPC['fee']);
    $ret = $t->create($trade);
    if(is_error($ret)) {
        util_json('初始化支付失败, 请稍后再试');
        exit;
    }
    $trade['tid'] = $ret;
    $order = array();
    $order['tid'] = TIMESTAMP . util_random(4, true);
    $order['fee'] = $trade['fee'];
    $order['title'] = $config['title'];
    $order['attachment'] = $trade['tid'];
    $cfg = $this->module['config']['api'];
    $cfg['notify'] = $_W['siteroot'] . 'addons/mb_cashier/callback.php';
    $ret = $api->payCreateOrder($openid, $order, $cfg);
    if(is_error($ret)) {
        util_json($ret['message']);
    } else {
        $ret['tid'] = $trade['tid'];
        util_json($ret);
    }
    exit;
}