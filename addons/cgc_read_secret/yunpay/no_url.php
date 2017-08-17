<?php
/* *
 * 功能：服务器异步通知页面
 */
require_once '../../../framework/bootstrap.inc.php';
load()->app('common');
load()->app('template');

$order_sn = $_REQUEST['i2'];
$sql = 'SELECT * FROM ' . tablename('cgc_read_secret_record') . ' WHERE `order_sn`=:order_sn';
$pars = array();
$pars[':order_sn'] = $order_sn;
$record = pdo_fetch($sql, $pars);
if (empty($record) || $record['pay_status']==1){
	WeUtility::logging('cgc_read_secret no_url', "record error");
	exit('fail');
}


$_W['uniacid'] = $record['uniacid'];

$site = WeUtility::createModuleSite('cgc_read_secret');

if(is_error($site)) {
	WeUtility::logging('cgc_read_secret no_url', "site error");
	exit('fail');
}

$setting = $site->module['config'];

//合作身份者id
$yun_config['partner']		= $setting['yunpay_pid'];

//安全检验码
$yun_config['key']			= $setting['yunpay_key'];

//云会员账户（邮箱）
$seller_email = $setting['yunpay_no'];

require_once("lib/yun_md5.function.php");

//计算得出通知验证结果
$yunNotify = md5Verify($_REQUEST['i1'],$_REQUEST['i2'],$_REQUEST['i3'],$yun_config['key'],$yun_config['partner']);
if($yunNotify) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//商户订单号

	$out_trade_no = $_REQUEST['i2'];

	//云支付交易号

	$trade_no = $_REQUEST['i4'];

	//价格
	$yunprice=$_REQUEST['i1'];
	
	$method = 'payResult';
	if (method_exists($site, $method)) {
	  $ret = array();			
	  $ret['uniacid'] = $_W['uniacid'];
	  $ret['result'] = 'success';
	  $ret['type'] = "yun_pay";
	  $ret['from'] = 'notify';
	  //异步请求
	  $ret['sync'] = false;
	  $ret['tid'] = $record['id'];
	  $ret['user'] = $record['openid'];
	  $ret['fee'] = $record['payment'];					
	  $ret['transaction_id'] = $trade_no;
	  $site->$method($ret);
	  exit('success');
	} 
} else {
  exit('fail');
}
      