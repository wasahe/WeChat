<?php
global $_W,$_GPC;
$op=empty($_GPC['op'])?"display":$_GPC['op'];
$uniacid=$_W['uniacid'];
$settings=$this->module['config'];
$userinfo=getFromUser($settings,$this->modulename);
$userinfo=json_decode($userinfo,true);

if($op=="display") {
	$secretid = $_GPC['secretid'];
	if (empty($secretid)){
		exit("秘密不能为空");
	}
	$cgc_read_secret = new cgc_read_secret();
	$secret = $cgc_read_secret->getOne($secretid);
	if (empty($secret)){
		exit("秘密记录不存在");
	}
	$fee = $_GPC['fee'];
	//验证下支付金额是否有问题，避免黑客模拟提交
	if ($secret['fee']!=$fee){
		exit(json_encode(array("code"=>-333,"msg"=>"服务器崩溃了，哥哥等等吧")));
	}
	
	$cgc_read_secret_record= new cgc_read_secret_record(); 
	
	$pay_status=$cgc_read_secret_record->getByCon(" and openid='{$userinfo['openid']}' and secret_id={$secretid} and pay_status=1");
	if (!empty($pay_status)){
	  exit(json_encode(array("code"=>-4,"msg"=>"你已经支付过了")));	
	}
	
	$settings['sx_bl']=empty($settings['sx_bl'])?0:$settings['sx_bl'];
	//手续费计算
	$sx_fee=intval($settings['sx_bl'])/100*$fee; 
     
    $data=array("uniacid"=>$_W['uniacid'],
	  "openid"=>$userinfo['openid'],
      "nickname"=>$userinfo['nickname'],
      "headimgurl"=>$userinfo['headimgurl'],	 
	  "secret_id"=>$secretid,
	  "secret_openid"=>$secret['openid'],
	  "secret_nickname"=>$secret['nickname'],
	  "secret_headimgurl"=>$secret['headimgurl'],
	  "sx_fee"=>$sx_fee,		  	 
	  "payment"=>$fee,	
	  "createtime"=>time(),
	);	
	$data['order_sn']="cgc_read_secret".time().mt_rand(1,10000);
			
	$id=$cgc_read_secret_record->insert($data);
	
	if (empty($id)){
	  exit(json_encode(array("code"=>0,"msg"=>"插入错误")));
	}
	
	//原生支付
	if ($settings['ys_pay']==1){	 
	  $data['id']=$logid;
      $data['title'] =empty($settings['pay_title'])?"花钱看秘密":$settings['pay_title'];  
      $settings['notify_url'] = $_W['siteroot'] . 'addons/'.$this->modulename.'/callback.php';
      $Api=new Api();
	  $ret=$Api->payOrder($userinfo['openid'], $data, $settings);		
	  if  (is_error($ret)){
		 exit(json_encode(array("code"=>-3,"msg"=>$ret['message'])));	
	  }
	  
	  exit(json_encode(array("code"=>1,"orderid"=>$id,"wx"=>$ret)));		
	}
	
    exit(json_encode(array("code"=>1,"orderid"=>$id)));	
}
	

if ($op=="tj"){	
  $orderid= intval($_GPC['orderid']);
  $order= pdo_fetch("SELECT * FROM ".tablename('cgc_read_secret_record')." WHERE `uniacid` = :uniacid and id=:id ", array(':uniacid'=>$uniacid,':id'=>$orderid));
  if ($order['pay_status'] != '0') {
    message('抱歉，您的订单已经付款或是被关闭，请重新进入付款！',referer(), 'error');
  }
	
  $params['tid'] = $orderid;
  $params['user'] = $userinfo['openid'];
  $params['fee'] =$order["payment"];
  $params['title'] = empty($settings['title'])?"花钱看秘密":$settings['title'];
  $params['ordersn'] = $order['order_sn'];
  $this->pay($params);
	
  
}  
     
 	