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

	$userinfo=mc_oauth_userinfo();

	if(empty($userinfo)){

		message("抱歉，微信红包仅能在微信中打开！");

	}
	

if($_W['ispost']){

global $_W, $_GPC;

$retype=intval($_GPC['type']);//红包类型：0手气红包；1普通红包
$FEE=$this->module['config']['FEE'];
$gettype=$this->module['config']['gettype'];
if($FEE===null){$FEE=5;}//默认收取5%手续费
$packet_numbers=intval($_GPC['packet_numbers']);

if($packet_numbers==1){//红包个数为1时，改为普通红包
	$retype=1;
}

$packetprice=(float)$_GPC['packetprice'];

if($gettype){//提现模式
    if($retype===0){
		$onetotal=$packetprice/$packet_numbers;
		if($onetotal<0.01 || $onetotal>200){
			$out['errmsg'] = "单个红包不能小于1，也不能大于200";
			exit(json_encode($out));
		}
		$amount=$packetprice;
		$allpacketprice=$packetprice*(1+$FEE/100);
		$redtype=2;//随机红包
	}elseif($retype===1){
		if($packetprice<0.01 || $packetprice>200){
			$out['errmsg'] = "单个红包不能小于1，也不能大于200";
			exit(json_encode($out));
		}
		$amount=$packet_numbers*$packetprice;
		$allpacketprice=$packet_numbers*$packetprice*(1+$FEE/100);
		$redtype=3;//普通红包
	}
}else{//立即红包模式
	if($retype===0){
		$onetotal=$packetprice/$packet_numbers;
		if($onetotal<1 || $onetotal>200){
			$out['errmsg'] = "单个红包不能小于1，也不能大于200";
			exit(json_encode($out));
		}
		$amount=$packetprice;
		$allpacketprice=$packetprice*(1+$FEE/100);
		$redtype=2;//随机红包

	}elseif($retype===1){
		if($packetprice<1 || $packetprice>200){
			$out['errmsg'] = "单个红包不能小于1，也不能大于200";
			exit(json_encode($out));
		}
		$amount=$packet_numbers*$packetprice;
		$allpacketprice=$packet_numbers*$packetprice*(1+$FEE/100);
		$redtype=3;//普通红包
	}
}


/*
$out['errmsg'] = $amount;
exit(json_encode($out));
*/


	$tid=date('YmdHi').random(8, 1);

	$params = array(
		'tid' => $tid,
		'ordersn' => $tid,
		'title' => '发红包',
		'fee' => sprintf("%.2f",$allpacketprice),
		'user' => $_W['member']['uid'],
		'module' => $this->module['name'],
	);
	$moduels = uni_modules();
	if(empty($params) || !array_key_exists($params['module'], $moduels)) {
		message('访问错误.');
	}
    $setting = uni_setting($_W['uniacid'], 'payment');
	$sql = 'SELECT * FROM ' . tablename('core_paylog') . ' WHERE `uniacid`=:uniacid AND `module`=:module AND `tid`=:tid';
	$pars  = array();
	$pars[':uniacid'] = $_W['uniacid'];
	$pars[':module'] = $params['module'];
	$pars[':tid'] = $params['tid'];
	$log = pdo_fetch($sql, $pars);
	if(!empty($log) && $log['status'] != '0') {
		$out['200'] = 201;
		$out['pay_url'] = "";
		exit(json_encode($out));
	}

	if(!empty($log) && $log['status'] == '0') {
		$log = null;
	}

	if(empty($log)){
		$moduleid = pdo_fetchcolumn("SELECT mid FROM ".tablename('modules')." WHERE name = :name", array(':name' => $params['module']));
		$moduleid = empty($moduleid) ? '000000' : sprintf("%06d", $moduleid);
		$fee = $params['fee'];
		$record = array();
		$record['uniacid'] = $_W['uniacid'];
		$record['openid'] = $_W['member']['uid'];
		$record['module'] = $params['module'];
		$record['type'] = 'wechat';
		$record['tid'] = $params['tid'];
		$record['uniontid'] = date('YmdHis').$moduleid.random(8,1);
		$record['fee'] = $fee;
		$record['status'] = '0';
		$record['is_usecard'] = 0;
		$record['card_id'] = 0;
		$record['card_fee'] = $fee;
		$record['encrypt_code'] = '';
		$record['acid'] = $_W['acid'];



		if(pdo_insert('core_paylog', $record)) {
			$plid = pdo_insertid();
			$record['plid'] = $plid;
			$log = $record;
		} else {
			$out['errmsg'] = "操作失败，请刷新后再试！";
		    exit(json_encode($out));
		}
	}

	$ps = array();

	$ps['tid'] = $log['plid'];

	$ps['uniontid'] = $log['uniontid'];

	$ps['user'] = $_W['fans']['from_user'];

	$ps['fee'] = $log['card_fee'];

	$ps['title'] = $params['title'];

	if(!empty($plid)){
		$tag = array();
		$tag['acid'] = $_W['acid'];
		$tag['uid'] = $_W['member']['uid'];
		pdo_update('core_paylog', array('openid' => $_W['openid'], 'tag' => iserializer($tag)), array('plid' => $plid));
	}

	load()->model('payment');
	load()->func('communication');
	$sl = base64_encode(json_encode($ps));
	$auth = sha1($sl . $_W['uniacid'] . $_W['config']['setting']['authkey']);
	

	//为空处理
    if(empty($this->module['config']['template'])){
		$defaultadbg=MODULE_URL."/template/static/images/redpackbg1.jpg"; 
	}else{
		$defaultadbg=MODULE_URL."/template/static/images/redpackdefaultbg.jpg";
	}
   

	$reddata=array(

		'plid' =>$plid,
		'uniacid'=>$_W['uniacid'],
        'redtype' =>$redtype,
		'gettype' =>$gettype,
		'act_name' =>$_W['fans']['tag']['nickname'],
		'send_name' =>$_W['fans']['tag']['nickname'],

		'wishing' =>'恭喜发财，大吉大利！',//广告语

		'amount' =>$amount,

		'total' =>0,

		'total_num' =>0,

		'maximum' =>$packet_numbers,

		'starttime' =>TIMESTAMP,

		'endtime' =>(TIMESTAMP+1296000),

		'remark' =>substr($_W['fans']['tag']['nickname'].'送红包，全民红包，大吉大利！',0,255),

		'secret_key' =>'我要红包',

		'description' =>$_W['fans']['tag']['nickname'],

		'status' =>1,

		'number' =>$packet_numbers,

		'addimg' =>$_W['fans']['tag']['avatar'],

		'adbg' =>$defaultadbg,

		'openid' =>$_W['fans']['openid'],

		'tid' =>$tid,
		
		'onlyshare' =>2,
		
		'user_ip' =>$_W['clientip'],

		'createtime' =>TIMESTAMP,

	);

	

	if($redtype==2){//随机红包
        if($gettype){//提现模式
		    $red_rand=sendHB($amount,$packet_numbers);
		}else{
			$red_rand=red_rand($amount,$packet_numbers);
		}
		if (!is_array($red_rand)){
			$out['errmsg'] = "金额设置错误！";
		    exit(json_encode($out));
		}
		$reddata['reddata']= iserializer($red_rand);
	}

	if(pdo_insert('tyzm_redpack_lists', $reddata)){

		$out['status'] = 200;

		$out['pay_url'] = "../payment/wechat/pay.php?i={$_W['uniacid']}&auth={$auth}&ps={$sl}";

		exit(json_encode($out));

	}else{

		$out['errmsg'] = "操作失败，请刷新后再试！";

		exit(json_encode($out));

	}

	



}



/*

** $amount：金额，单位（元）

** $num：红包个数

** 正常返回数组；否则错误

*/

function red_rand($amount, $num)

{

	$min = 100;		//红包最小金额1元

	$max = 20000;	//红包最大金额200元

	

	$num = intval($num);

	if (!($num>0)){	//红包个数必须>=1

		return 1;

	}

	

	$amount = round($amount * 100);

	if ($amount<100){	//红包总金额必须>=1元

		return 2;

	}

	

	if($num*$min > $amount){	//红包个数乘于最小金额必须>红包总金额

		return 3;

	}

	

	if ($amount/$num > $max){	//红包上限将>200元，无法发放

		return 4;

	}

	

	if ($amount - ($num-1)*$max > $min){	//设置红包最小基数

		$min = $amount - ($num-1)*$max;

	}

	

	$reds = array();

	$arr = array();	//最终的红包数组

	$rand_small = array();

	$rand_big = array();

	$rand_total = $amount - $num*$min;		//可随机分配的总金额

	$i = 0;



	while(--$num){

		$r = rand(1, $rand_total);

		$r = fix_rand($r, $reds, $rand_total);

		$reds[] = $r;

	}

	

	asort($reds);

	$last = 0;

	foreach($reds as $v){

		$arr[] = $min + $v - $last;

		$last = $v;

	}

	$arr[] = $min + $rand_total - $last;

	

	while(true){

		asort($arr);

		$s_v = current($arr);

		if ($s_v < $min){

			inc_fix($arr, $min, $max);

		}else{

			break;

		}

	}

	

	while(true){

		arsort($arr);

		$s_v = current($arr);

		if ($s_v > $max){

			dec_fix($arr, $min, $max);

		}else{

			break;

		}

	}

	

	ksort($arr);

	foreach($arr as $k => $v){

		$arr[$k] = $v/100;

	}

	return $arr;

}





function fix_rand($r, $reds, $max){

	if(in_array($r, $reds) || $r == $max){

		$r1 = $r;

		while(--$r1){

			if(!in_array($r1, $reds)){

				return $r1;

				break;

			}

		}

		

		while(true){

			if ($r < $max){

				++$r;

				if( ! in_array($r, $reds)){

					return $r;

					break;

				}

			}else{

				return $r;

				break;

			}

		}

	}

	return $r;

}



function inc_fix(&$pa, $min, $max){

	asort($pa);

	$key = key($pa);

	$val = current($pa);

	$step = $min - $val;

	

	arsort($pa);

	foreach($pa as $k => $v){

		if ($step > 0){

			if ($v - $step > $min){

				$pa[$k] = $v - $step;

				$pa[$key] = $pa[$key] + $step;

				$step = 0;

			}else{

				if ($v > $min){

					$pa[$k] = $v - 1;

					$pa[$key] = $pa[$key] + 1;

					$step--;

				}else{

					break;

				}

			}

		}else{

			break;

		}

	}

}





function dec_fix(&$pa, $min, $max){

	arsort($pa);

	$key = key($pa);

	$val = current($pa);

	$step = $val - $max;

	

	asort($pa);

	foreach($pa as $k => $v){

		if ($step > 0){

			if ($v + $step < $max){

					$pa[$k] = $v + $step;

					$pa[$key] = $pa[$key] - $step;

					$step = 0;

			}else{

				if ($v < $max){

					$pa[$k] = $v + 1;

					$pa[$key] = $pa[$key] - 1;

					$step--;

				}else{

					break;

				}

			}

		}else{

			break;

		}

	}

}

 /** 
 * 拼手气红包实现 
 * 生成num个随机数，每个随机数占随机数总和的比例*money_total的值即为每个红包的钱额 
 * 考虑到精度问题，最后重置最大的那个红包的钱额为money_total-其他红包的总额 
 * 浮点数比较大小,使用number_format,精确到2位小数 
 * 
 * @param double $money_total  总钱额， 每人最少0.01,精确到2位小数 
 * @param int $num 发送给几个人 
 * @return array num个元素的一维数组，值是随机钱额 
 */  
function sendHB($money_total, $num) {  
    if($money_total < $num*0.01) {  
        exit('钱太少');  
    }  
  
    $rand_arr = array();  
    for($i=0; $i<$num; $i++) {  
        $rand = rand(1, 100);  
        $rand_arr[] = $rand;  
    }  
  
    $rand_sum = array_sum($rand_arr);  
    $rand_money_arr = array();  
    $rand_money_arr = array_pad($rand_money_arr, $num, 0.01);  //保证每个红包至少0.01  
  
    foreach ($rand_arr as $key => $r) {  
        $rand_money = number_format($money_total*$r/$rand_sum, 2);  
  
        if($rand_money <= 0.01 || number_format(array_sum($rand_money_arr), 2) >= number_format($money_total, 2)) {  
            $rand_money_arr[$key] = 0.01;  
        } else {  
            $rand_money_arr[$key] = $rand_money;  
        }  
  
    }  
  
    $max_index = $max_rand = 0;  
    foreach ($rand_money_arr as $key => $rm) {  
        if($rm > $max_rand) {  
            $max_rand = $rm;  
            $max_index = $key;  
        }  
    }  
  
    unset($rand_money_arr[$max_index]);  
    //这里的array_sum($rand_money_arr)一定是小于$money_total的  
    $rand_money_arr[$max_index] = number_format($money_total - array_sum($rand_money_arr), 2);  
      
    ksort($rand_money_arr);  
    return $rand_money_arr;  
}  

