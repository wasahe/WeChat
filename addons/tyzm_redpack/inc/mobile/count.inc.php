<?php



/**



 * 



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

$tys = array('adclick', 'forward', 'pv');

$ty=trim($_GPC['ty']);

$ty = in_array($ty, $tys) ? $ty : 'pv';

$tid=trim($_GPC['tid']);

$tokenkey=trim(base64_decode($_GPC['tokenkey']));



if($ty=='adclick'){

	//测试

	//

	

	

	//统计记录start

	 $countdata=array(

		  'uniacid' => $uniacid,

		  'tid' => $tid,

		  'openid' => $_W['fans']['openid'],

		  //'pv_count' =>1,

		 // 'forward_num' =>,

		  'clientip'=>$_W['clientip'],

		  'adclick_num' =>1,

		  'starttime' =>time(),

	 );

	 pdo_insert('tyzm_redpack_count', $countdata);

	 //统计记录end

}



if($ty=='forward'){

	//测试

	//

	

	

	//统计记录start

	 $countdata=array(

		  'uniacid' => $uniacid,

		  'tid' => $tid,

		  'openid' => $_W['fans']['openid'],

		  //'pv_count' =>1,

		  'forward_num' =>1,

		  //'adclick_num' =>,

		  'clientip'=>$_W['clientip'],

		  'starttime' =>time(),

	 );

	 pdo_insert('tyzm_redpack_count', $countdata);

	 //统计记录end

}



if($ty=='pv'){

	//测试

	//

	

	

	//统计记录start

	 $countdata=array(

		  'uniacid' => $uniacid,

		  'tid' => $tid,

		  'openid' => $_W['fans']['openid'],

		  'pv_count' =>1,

		  //'forward_num' =>,

		  //'adclick_num' =>,

		  'clientip'=>$_W['clientip'],

		  'starttime' =>time(),

	 );

	 pdo_insert('tyzm_redpack_count', $countdata);

	 //统计记录end

}

	

	

	

   













