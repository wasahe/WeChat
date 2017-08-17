<?php 
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */
 

defined('IN_IA') or exit('Access Denied');
	global $_W,$_GPC;
	$rid = intval($_GPC['rid']);
	$weid = intval($_W['weid']);
	$uniacid = intval($_W['uniacid']);
	$tid=trim($_GPC['tid']);
	$tokenkey=trim(base64_decode($_GPC['tokenkey']));
	$_W['fans']['openid']=$_GPC['openid'];
	
	if($_GPC['local']!=2){//正常发红包
		$redata = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_lists') . " WHERE uniacid = :uniacid AND tid = :tid AND openid=:openid AND ispay=:ispay", array(':uniacid' => $uniacid,':tid' => $tid,':openid' => $tokenkey,':ispay' => 1));
		if(empty($redata) && $redata['gettype']==1){
			echo "参数错误";exit;
		}
		$lickylog = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_data') . " WHERE  aid = :aid AND uniacid = :uniacid AND re_openid=:openid AND isdel=0 ORDER BY `id` DESC", array(':aid' => $redata['id'],':uniacid' => $uniacid,':openid' => $_W['fans']['openid']));
	}else{//提现
	    $id=intval($_GPC['id']);
	    $redata=array(
		  'send_name'=>$_W['uniaccount']['name'],
		  'act_name' => "口令红包",
		  'remark' => "自主提现",
		  'wishing' => "恭喜发财，提现成功！",
		);
		$lickylog = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_data') . " WHERE id=:id AND uniacid = :uniacid AND re_openid=:openid AND isdel=0 AND gettype=3  ORDER BY `id` DESC", array(':id'=> $id,':uniacid' => $uniacid,':openid' => $_W['fans']['openid']));
	}
	
		
	
    if(!empty($lickylog['tid'])){
		
	   if($lickylog['result_code']!='SUCCESS'){//第一次执行发红包动作&&红包发送不成功时，再执行多次执行，后台可以看到错误结果
	 //
		//执行发红包操作 start
			$setting = uni_setting($_W['uniacid'], array('payment'));
			$wechat=$setting['payment']['wechat'];
			if(!is_array($setting['payment'])){
			   pdo_update('tyzm_redpack_data', array('return_msg' => "没有设定支付参数"),array('id' => $lickylog['id']));
			   exit;
			}	
			$data['wxappid'] = $_W['account']['key'];
			$data['mch_id'] = $wechat['mchid'];
			$data['mch_billno'] = $lickylog['mch_billno'];
			$data['client_ip'] = $_W['clientip'];//获得服务器IP
			$data['re_openid'] = $_W['fans']['openid']; 
			$data['total_amount'] = $lickylog['total_amount'];
			$data['send_name'] = str_cut($redata['send_name'],32,'');
			$data['act_name'] = str_cut($redata['act_name'],32,'');
			$data['remark'] = str_cut($redata['remark'],256,'');
			$data['wishing'] = str_cut($redata['wishing'],128,'');
			$data['total_num'] = 1;
			$data['nonce_str'] = $this->createNoncestr();
			$data['sign'] = $this->getSign($data,$wechat['apikey']);
			$xml = $this->arrayToXml($data);
			$url ="https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";
			$re = $this->wxHttpsRequestPem($xml,$url);
			file_put_contents("data.txt",$data);//大于log
            if($re==58){
				pdo_update('tyzm_redpack_data', array('return_msg' => "证书有问题"),array('id' => $lickylog['id']));
			    exit;
			}
			
			$data['createtime']=TIMESTAMP;
			unset($data['mch_billno'],$data['nonce_str'],$data['send_name'],$data['act_name'],$data['remark'],$data['wishing'],$data['mch_id']); //删除多余数据
			$rearr = $this->xmlToArray($re);  
			$rearr['return_data']=json_encode($rearr);
			
			$totladata=array_merge($data,$rearr);//提交和返回值合并保存
			unset($totladata['amt_type']); //删除多余数据
			
			if(!empty($rearr['return_code']) && $rearr['err_code']!='SEND_FAILED'){
			  file_put_contents(time()."redata.txt",json_encode($totladata)); 
			  pdo_update('tyzm_redpack_data', $totladata,array('id' => $lickylog['id']));
			  if($redata['number']==$lickylog['order_num']){
				  $redstatus['status']=2;
				  pdo_update('tyzm_redpack_lists', $redstatus, array('id' => $redata['id']));
			  }
			  return "1";
			}else{
			  return "0"; 
			}
			//执行发红包操作 start 
		}
	
    }
	


