<?php

defined('IN_IA') or exit('Access Denied');

	global $_W,$_GPC;
	$weid = intval($_W['weid']);
	$uniacid = intval($_W['uniacid']);
    $userinfo=mc_oauth_userinfo();
	if(empty($userinfo)){
		message("抱歉，微信红包仅能在微信中打开！"); 
	}

$tys = array('display','redpackajax');

$ty=trim($_GPC['ty']);

$ty = in_array($ty, $tys) ? $ty : 'display';
$config=$this->module['config'];
$senduserarr=explode(",",$config['senduser']);
if(in_array($_W['fans']['openid'],$senduserarr) or empty($config['senduser'])){
	$issend=1;
}
if($ty=='display'){
	$_share['title'] ="商家发福利啦，你也过来喊口令吧，轻松赚到下午茶！";
	$_share['imgUrl'] = $_W['siteroot']."/addons/tyzm_redpack/template/static/images/icon.jpg";
	$_share['desc'] ="红包广场，商家发广告，我们喊红包，商家开心，我们高兴！";
	//设置页面title
	$_W['page']['sitename']="红包广场-口令红包";
	if(empty($this->module['config']['template'])){		include $this->template('indexnew');	 	}else{		include $this->template('index');	 	}
	
}
if($ty=='redpackajax'){

	$nowpage=$_GPC['limit'];

	$pindex = max(1, intval($nowpage));

	$psize = 10;

	

	

	$list = pdo_fetchall("SELECT * FROM " . tablename('tyzm_redpack_lists') . " WHERE uniacid = :uniacid AND ispay=1 AND onlyshare=0 ORDER BY `id` DESC LIMIT ".($pindex-1) * $psize.','.$psize,array(':uniacid' => $uniacid));

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

				'url'=>$this->createMobileUrl('Redpack',array('tid'=>$item['tid'],'tokenkey'=>base64_encode($item['openid']))),

				'ad_name'=>$item['send_name'],

				'addimg'=>$item['addimg'],
				
				'adbg'=>$item['adbg'],
				'key'=>$item['secret_key'],
                'send_name'=>$item['send_name'],
				'pack_money'=>$item['amount'],
                'wishing'=>$item['wishing'],
				'pack_num'=>$item['number'],
				'pack_type'=>empty($item['secret_key'])? '摇一摇' : '喊口令',
				'status'=>$item['status'],
				'createtime'=>date('Y-m-d H:i:s', $item['createtime']),

				'hot_num'=>$item['adclick_num']*6+$item['forward_num']*2+$item['pv_count'],

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


