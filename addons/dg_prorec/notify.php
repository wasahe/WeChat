<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.zheyitianshi.com/ for more details.
 */

error_reporting(1);
define('IN_MOBILE', true);
require '../../framework/bootstrap.inc.php';
require_once  "../../addons/dg_prorec/WxPayPubHelper/WxPayPubHelper.php";
load()->func('logging');
$input = file_get_contents('php://input');
WeUtility::logging('info',"产品订阅异步通知数据".$input);
global $_W;
//WeUtility::logging('info',"商户key数据".$kjsetting);
$notify=new Notify_pub();
$notify->saveData($input);
$data=$notify->getData();
//$kjsetting=DBUtil::findUnique(DBUtil::$TABLE_WKJ_SETTING,array(":appid"=>$data['appid']));
if(empty($data)){
	$notify->setReturnParameter("return_code","FAIL");
	$notify->setReturnParameter("return_msg","参数格式校验错误");
	WeUtility::logging('info',"产品订阅回复参数格式校验错误");
	exit($notify->createXml());
}

if($data['result_code'] !='SUCCESS' || $data['return_code'] !='SUCCESS') {
	$notify->setReturnParameter("return_code","FAIL");
	$notify->setReturnParameter("return_msg","参数格式校验错误");
	WeUtility::logging('info',"产品订阅回复参数格式校验错误");
	exit($notify->createXml());
}
//更新表订单信息
WeUtility::logging('info',"更新表订单信息".$data);
logging_run($data);
//DBUtil::update(DBUtil::$TABLE_WJK_ORDER,array("status"=>4,'notifytime'=>TIMESTAMP,'wxnotify'=>$data,'wxorder_no'=>$data['transaction_id']),array("order_no"=>$data['out_trade_no']));
    $order_data=array(
    		"status"=>1,
    		"transaction_id"=>$data['transaction_id'],
    		"pay_money"=>floatval($data['cash_fee'])/100,
    		"pay_time"=>time()
    );
	$res=pdo_update('dg_prorecpay',$order_data,array("out_trade_no"=>$data["out_trade_no"]));
	if($res){
		logging_run("111");
		$order=pdo_fetch("select * from ".tablename('dg_prorecpay')." where out_trade_no=:out_trade_no",array(":out_trade_no"=>$data["out_trade_no"]));
		$data=array(
			'uniacid'=>$order['uniacid'],
			'openid'=>$order['openid'],
			'follow_time'=>time(),
			'cateid'=>$order['cateid'],
			'followstatus'=>2
		);
		$parms=array(
			":openid"=>$order['openid'],
			":uniacid"=>$order['uniacid'],
			":cateid"=>$order['cateid']
		);
		$ifset=pdo_fetch("select * from ".tablename('dg_prorecuser')." where openid=:openid and uniacid=:uniacid and cateid=:cateid",$parms);
		if(empty($ifset)){
			$inser=pdo_insert("dg_prorecuser",$data);
		}
		if($inser){
			$count=pdo_fetchcolumn("select `count` from ".tablename('dg_proreccate')." where id={$order['cateid']}");
			$ccount=$count+1;
			pdo_update('da_proreccate',array('count'=>$ccount),array('id'=>$order['cateid']));
		}

	}
	$notify->setReturnParameter("return_code","SUCCESS");
	$notify->setReturnParameter("return_msg","OK");
	exit($notify->createXml());


WeUtility::logging('info',"产品订阅查询回复数据".$data);




