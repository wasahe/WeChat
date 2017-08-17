<?php


/**


 * 红包手机管理模块处理程序


 *


 * @author tyzm


 * @url http://bbs.we7.cc/


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
$muserarr=explode(",",$this->module['config']['mebilemanage']);
if(!in_array($_W['fans']['openid'],$muserarr)){
	exit("木有权限！");
}

$tys = array('display','redpackajax');
$ty=trim($_GPC['ty']);
$ty = in_array($ty, $tys) ? $ty : 'display';

if($ty==display){


$starttime = strtotime($_GPC['datelimit']['start'] ? strtotime($_GPC['datelimit']['start']) : date('Ymd', strtotime('-7day')));
$endtime = strtotime($_GPC['datelimit']['end'] ? strtotime($_GPC['datelimit']['end']) : date('Ymd'))+86399;
$stat = pdo_fetchall("SELECT `amount`,`number`,`createtime` FROM ".tablename('tyzm_redpack_lists')." WHERE createtime >= '$starttime' AND createtime <= '$endtime' AND uniacid = $uniacid AND ispay=1 ORDER BY id DESC", array(), 'date');

$list[0]['totalamount'] = 0;$list[0]['totalredpack']= 0;$list[1]['totalamount'] = 0;$list[1]['totalredpack']= 0;$list[2]['totalamount'] = 0;$list[2]['totalredpack']= 0;$list[3]['totalamount'] = 0;$list[3]['totalredpack']= 0;$list[4]['totalamount'] = 0;$list[4]['totalredpack']= 0;$list[5]['totalamount'] = 0;$list[5]['totalredpack']= 0;$list[6]['totalamount'] = 0;$list[6]['totalredpack']= 0;
for($i = 0; $i < count($stat); $i++) {
	if($stat[$i]['createtime']>=strtotime(date('Ymd'))){
		$list[0]['totalamount'] += $stat[$i]['amount'];
		$list[0]['totalredpack'] += $stat[$i]['number'];
	}else{
		$ytime=strtotime(date('Ymd'))-$stat[$i]['createtime'];
		//echo $ytime."<br/>";
		$dat=round($ytime/86400)+1;
		$list[$dat]['totalamount'] += $stat[$i]['amount'];
		$list[$dat]['totalredpack'] += $stat[$i]['number'];
	}
}
for($i = 0; $i < 8; $i++) {
	$list[$i]['date']=date('m-d', strtotime('-'.$i.'day'));
}
$_share['imgUrl'] = MODULE_URL."/template/static/images/icon.jpg";
$_share['desc'] ="口令红包后台数据查看页面";
$_W['page']['sitename']="红包数据";
include $this->template('mobilemanage');
}

if($ty==redpackajax){
	
	$nowpage=$_GPC['limit'];
	$pindex = max(1, intval($nowpage));
	$psize = 10;
	$list = pdo_fetchall("SELECT * FROM " . tablename('tyzm_redpack_lists') . " WHERE uniacid = :uniacid AND ispay=1 ORDER BY `id` DESC LIMIT ".($pindex-1) * $psize.','.$psize,array(':uniacid' => $uniacid));

	if(!empty($list)){
		foreach ($list as $key => $value) { 
			$list[$key]['get_num']= pdo_fetchcolumn("SELECT COUNT(id) FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND aid = :aid  ORDER BY `id` DESC", array(':uniacid' => $uniacid,':aid' => $value['id']));
			$count = pdo_fetchall("SELECT * FROM " . tablename('tyzm_redpack_count') . " WHERE uniacid = :uniacid AND tid = :tid  ", array(':uniacid' => $uniacid,':tid' => $value['tid']));
			
			$list[$key]['pv_count'] = 0;
			$list[$key]['forward_num'] = 0;
			$list[$key]['adclick_num'] = 0;
			for($i = 0; $i < count($count); $i++) {
				$list[$key]['pv_count'] += $count[$i]['pv_count'];
				$list[$key]['forward_num'] += $count[$i]['forward_num'];
				$list[$key]['adclick_num'] += $count[$i]['adclick_num'];
			}
		}
	}
	 
	if (!empty($list)){
		foreach ($list as $item){
			$row=array(
				'url'=>$this->createMobileUrl('Redpack',array('ty'=>'lucky','tid'=>$item['tid'],'tokenkey'=>base64_encode($item['openid']))),
				'ad_name'=>$item['send_name'],
				'addimg'=>$item['addimg'],
				'pack_money'=>$item['amount'],
				'pack_num'=>$item['number'],
				'get_num'=>$item['get_num'],
				'createtime'=>date('Y-m-d H:i:s', $item['createtime']),
				'pv_num'=>$item['pv_count'],
				'forward_num'=>$item['forward_num'],
				'adclick_num'=>$item['adclick_num'],
			);
			$info[]=$row;			
		}
		$sta =200;
	}else{
		$sta =-103;
	}
	$result=array(
		'status'=>$sta,
		'content'=>$info,	
	);
	echo json_encode($result);
	
}