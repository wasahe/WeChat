<?php 

// +----------------------------------------------------------------------
// | Copyright (c) 2015-2020.
// +----------------------------------------------------------------------
// | Describe: 支付结果处理类
// +----------------------------------------------------------------------
// | Author: weliam<937991452@qq.com>
// +----------------------------------------------------------------------

class payResult{
	/** 
	* 异步支付结果回调 ，处理业务逻辑
	* 
	* @access public
	* @name  
	* @param mixed  参数一的说明 
	* @return array 
	*/  
	function payNotify($params){
		global $_W;
		Util::wl_log('payResult_notify',TG_DATA, $params); //写入异步日志记录
		$ordernoType = substr($params['tid'] , 0 , 7); /*判断orderno的类型*/
		if($ordernoType=='Credit1'){ //充值
			$orderCredit1 = pdo_fetch("select * from".tablename('tg_credit1rechargerecord')."where orderno='{$params['tid']}'");
			$dataCredit1 = array();
			$paytype = array('credit' => 1, 'wechat' => 2, 'alipay' => 3, 'delivery' => 4);
			$dataCredit1['paytype'] = $paytype[$params['type']];
			$dataCredit1['transid'] = $params['tag']['transaction_id'];
			$dataCredit1['status'] = 1;
			wl_load()->model('credit');
			wl_load()->model('member');
			wl_load()->model('setting');
			$member = getMember($orderCredit1['openid']);
			$setting=setting_get_by_name("member");
			$credit_type = $setting['credit_type']?$setting['credit_type']:1;
			credit_update_credit2($member['uid'],$orderCredit1['num'],$credit_type,"充值");
			pdo_update('tg_credit1rechargerecord', $dataCredit1, array('orderno' => $params['tid'])); //更新订单状态
		}else{
			$groupSuccess = FALSE;
			$order_out = pdo_fetch("select * from".tablename('tg_order')."where orderno='{$params['tid']}'");
			$goodsInfo = model_goods::getSingleGoods($order_out['g_id'], '*');
			Util::deleteCache('goods', $goodsInfo['id']);
			if ($order_out['tuan_id']) $berforeGroup = model_group::getSingleGroup($order_out['tuan_id'], "*");//此订单支付之前的团
			if (!empty($berforeGroup) && ($berforeGroup['lacknum'] == 0) ) $groupSuccess = TRUE;  //此订单支付之前团的状态，是否已组团成功
			if($goodsInfo['merchantid']) $merchant = model_merchant::getSingleMerchant($goodsInfo['merchantid'], '*'); //商家
			$data = self::getPayData($params, $order_out, $goodsInfo); //得到支付参数，处理代付
			pdo_update('tg_order', $data, array('orderno' => $params['tid'])); //更新订单状态
			
			if($groupSuccess){ //在此订单之前已组团成功
				pdo_update('tg_order',array('status'=>6,'is_tuan'=>2), array('orderno' => $params['tid'])); // 团满退款单
		  	}else{//此订单单买 或则 在此订单之前未组团成功
		  		$url = app_url('order/order/detail', array('id' => $order_out['id'])); // 支付成功通知
				message::pay_success($order_out['openid'], $data['price'], $goodsInfo['gname'], $url);
				
				if ($berforeGroup['lacknum'] > 0) { //参团
					$downNum = $berforeGroup['lacknum'] - 1; 
					if($order_out['ordertype']==2 && $goodsInfo['g_type']==4){
						$downNum = ($berforeGroup['lacknum'] - $order_out['gnum']>0)?$berforeGroup['lacknum'] - $order_out['gnum']:0;//商品数量团
					}
					pdo_update('tg_group', array('lacknum' => $downNum,'endnum'=>$berforeGroup['neednum'] - $berforeGroup['lacknum'] + $order_out['gnum']), array('groupnumber' => $order_out['tuan_id']));
					Util::deleteCache('group', $order_out['tuan_id']);
					$afterGroup = model_group::getSingleGroup($order_out['tuan_id'], "*"); //该团最新状态
				}
				if (!empty($afterGroup) && $afterGroup['lacknum'] == 0) { //参团后组团成功
					message::group_success($order_out['tuan_id'],app_url('order/group', array('tuan_id' => $order_out['tuan_id']))); //参团后组团成功消息
					pdo_update('tg_group',array('groupstatus' => 2,'successtime'=>TIMESTAMP,'endnum'=>$berforeGroup['neednum'] - $berforeGroup['lacknum'] + $order_out['gnum']), array('groupnumber' => $afterGroup['groupnumber'])); //更新团状态
					Util::deleteCache('group', $order_out['tuan_id']); // 删除团缓存
					if($order_out['lottery_status']==-1) //抽奖订单
						pdo_update('tg_order',array('status' => 2,'successtime'=>TIMESTAMP,'lottery_status'=>1), array('tuan_id' => $afterGroup['groupnumber'], 'status' => 1)); // 更新订单状态
					else
						pdo_update('tg_order',array('status' => 2,'successtime'=>TIMESTAMP), array('tuan_id' => $afterGroup['groupnumber'], 'status' => 1)); // 更新订单状态
				}
				if ((!empty($afterGroup) && $afterGroup['lacknum'] == 0) || $order_out['is_tuan'] == 0)  // 单买或参团后组团成功操作，更新库存，积分，商家进账,优惠券
					self::updateStockAndCreditAndMerchantAndCoupon($afterGroup, $order_out, $goodsInfo, $merchant,$data['price']);
			}
 		}
		
	}
	/** 
	* 函数的含义说明 
	* 
	* @access public
	* @name 方法名称 
	* @param mixed  参数一的说明 
	* @return array 
	*/  
	function payReturn($params){
		global $_W;
		Util::wl_log('payResult_return',TG_DATA, $params);//写入日志记录
		$ordernoType = substr($params['tid'] , 0 , 7);
		if($ordernoType=='Credit1'){ //充值
			$orderCredit1 = pdo_fetch("select * from".tablename('tg_credit1rechargerecord')."where orderno='{$params['tid']}'");
			if ($params['result'] == 'success' && $params['from'] == 'return') {
			 	echo "<script>  location.href='" . app_url('pay/success',array('money'=>$orderCredit1['num'])) . "';</script>";exit ;
			}
		}else{
			$order_out = pdo_fetch("select * from".tablename('tg_order')."where orderno='{$params['tid']}'");
		 	if($order_out['is_tuan'] == 2){
		 		header("location:".app_url('pay/success',array('orderid'=>$order_out['id'],'errno'=>2)));
			}elseif($order_out['is_tuan'] == 1){
				header("location:".app_url('order/group', array('tuan_id' => $order_out['tuan_id'],'pay'=>'pay')));
			}elseif($order_out['is_tuan'] == 0){
				header("location:".app_url('pay/success',array('orderid'=>$order_out['id'])));
			}
 		}
	}
	/** 
	* 函数的含义说明 
	* 
	* @access public
	* @name 方法名称 
	* @param mixed  参数一的说明 
	* @return array 
	*/  
	 function getPayData($params,$order_out,$goodsInfo){
	 	global $_W;
		$data = array('status' => $params['result'] == 'success' ? 1 : 0);
		if ($order_out['is_tuan'] == 0) $data['status']=2;
			if($params['is_usecard']==1){
				$fee = $params['card_fee'];
				$data['is_usecard'] = 1;
			}else{
				$fee = $params['fee'];
			}
			$paytype = array('credit' => 1, 'wechat' => 2, 'alipay' => 3, 'delivery' => 4);
			$data['pay_type'] = $paytype[$params['type']];
			if ($params['type'] == 'wechat') $data['transid'] = $params['tag']['transaction_id'];
			$data['ptime'] = TIMESTAMP;
			$data['price'] = $fee;
			$data['starttime'] = TIMESTAMP;
			$data['credits'] = $goodsInfo['credits'];
			if($order_out['openid'] != $params['user']){ //处理代付
				$data['ordertype']=1;
				$data['helpbuy_opneid']=$params['user'];
				$time = date("Y-m-d H:i:s",time());
				$url = app_url('order/order/detail', array('id' => $order_out['id']));
				message::daipay_success($order_out['openid'], $fee, $order_out['othername'], $params['tid'], $goodsInfo['gname'], $time, $order_out['message'], $url);
				message::daipay_success($params['user'], $fee, $order_out['othername'], $params['tid'], $goodsInfo['gname'], $time, $order_out['message'], $url);
			}
			if(!empty($goodsInfo['merchantid'])) model_merchant::updateAmount($fee, $goodsInfo['merchantid'],$order_out['id'],1,'订单支付成功');  //商家进账
			if($order_out['is_usecard'] == 1){ //处理优惠券
				pdo_update('tg_coupon',array('use_time'=>1), array('id' => $order_out['couponid']));
				$coupon = pdo_fetch("select coupon_template_id from".tablename('tg_coupon')."where id = {$order_out['couponid']}");
				model_coupon::coupon_quantity_issue_increase($coupon['coupon_template_id'], 1);
				
			}
			return $data;
	}
	/** 
	* 函数的含义说明 
	* 
	* @access public
	* @name 方法名称 
	* @param $now  更新后的团 
	* @param $order_out  订单 
	* @param $goodsInfo  商品 
	* @param $merchant  商家 
	* @param $fee  支付金额 
	* @return array 
	*/  
	 function updateStockAndCreditAndMerchantAndCoupon($now,$order_out,$goodsInfo,$merchant,$fee){
	 	global $_W;
		if($merchant['messageopenid']){ //发货提醒
			$msg = '';
			$msg .= "【发货提醒】您有新的待发货订单，请注意发货——".date('Y-m-d H:i:s',time());
			$msg .= "";
			sendCustomNotice($merchant['messageopenid'],$msg,'','');
		}
		if (!empty($now) && $now['lacknum'] == 0) {
			$where =array();
			$where['tuan_id'] = $order_out['tuan_id'];
			$where['status'] = 2;
			$where['!=mobile'] = "'虚拟'";
			$ordersData=model_order::getNumOrder('*', $where, 'id desc', 0, 0, 0);
			$orders = $ordersData[0];
		}elseif($order_out['is_tuan'] == 0){
			$where =array();
			$where['orderno'] = $order_out['orderno'];
			$where['status'] = 2;
			$where['!=mobile'] = "'虚拟'";
			
			$ordersData=model_order::getNumOrder('*', $where, 'id desc', 0, 0, 0);
			$orders = $ordersData[0];
		}
		foreach($orders as$key=>$value){
			if(empty($value['optionid'])){ //无规格，更改商品库存
				$goodsInfo['gnum'] = pdo_getcolumn('tg_goods', array('id' => $value['g_id']), 'gnum');
				$level_num = $goodsInfo['gnum'] - $value['gnum'];
				if ($level_num<=0) {
					pdo_update('tg_goods',array('gnum' => 0, 'isshow' => 3), array('id' => $value['g_id']));
				}else{
					pdo_update('tg_goods',array('gnum' => $level_num), array('id' => $value['g_id']));
				}
			}else{ //有规格 ， 更改规格库存
				$options = pdo_fetch("select stock from " . tablename('tg_goods_option') . " where id=:id ", array(':id' => $value['optionid']));
				$options['stock'] = intval($options['stock']);
				$value['gnum'] = intval($value['gnum']);
				if($options['stock'] <= $value['gnum']){
					$stock = 0;
				}else{
					$stock = $options['stock']-$value['gnum'];
				}
				pdo_update('tg_goods_option',array('stock'=>$stock),array('id'=>$value['optionid']));
			}
			pdo_query('UPDATE '.tablename('tg_goods')." SET `salenum` = `salenum` + {$value['gnum']} WHERE id={$value['g_id']}");
			if($merchant['id'])pdo_query('UPDATE '.tablename('tg_merchant')." SET `salenum` = `salenum` + {$value['gnum']} WHERE id={$merchant['id']}");
			if(!empty($goodsInfo['credits']) || !empty($value['marketing'])){ //计算积分
				wl_load()->model('credit');
				wl_load()->model('member');
				wl_load()->model('setting');
				$setting=setting_get_by_name("member");
				$credit_type = $setting['credit_type']?$setting['credit_type']:1;
				if(!empty($goodsInfo['credits']))
					credit_update_credit1($value['openid'],$goodsInfo['credits'],$credit_type,"获得积分【".$goodsInfo['gname']."】");
				if(!empty($value['marketing'])){
					$orderMarket = unserialize($value['marketing']);
					if($orderMarket['deduct'])$deduct = unserialize($orderMarket['deduct']);
					if($deduct[0])credit_update_credit1($value['openid'],0-$deduct[0],$credit_type,"积分抵扣【".$goodsInfo['gname']."】");
				}
			}
			if(!empty($goodsInfo['give_coupon_id'])) model_coupon::coupon_grant($value['openid'],$goodsInfo['give_coupon_id']);
		}
	}
}



?>