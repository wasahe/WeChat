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

	$tys = array('display', 'edit');

    $ty=trim($_GPC['ty']);

    $ty = in_array($ty, $tys) ? $ty : 'display';
	$config=$this->module['config'];
	$FEE=$config['FEE'];
	$gettype=$config['gettype'];
	$pluspelp=$config['pluspelp'];
	if($FEE===null){$FEE=5;}//默认收取5%手续费
	$defaulthelp="javascript:;";
	if(empty($pluspelp)){$pluspelp=$defaulthelp;}
	
	if($ty=='edit'){

		//设置页面title

		$_W['page']['sitename']=$reply['title'];

		include $this->template('edit');

	}else{
		
$senduserarr=explode(",",$config['senduser']);
if(!in_array($_W['fans']['openid'],$senduserarr) && !empty($config['senduser'])){
	message("没有权限发红包，请联系管理员！");
}

		 //自定义分享内容

		 $_share['title'] =empty($reply['share_title']) ? $reply['title'] : $reply['share_title'];

		 $_share['imgUrl'] =empty($reply['share_icon']) ? tomedia($reply['thumb']) : tomedia($reply['share_icon']);

		 $_share['desc'] =empty($reply['share_des']) ? $reply['description'] : $reply['share_des'];

		 //设置页面title

		 $_W['page']['sitename']="发红包";

	     include $this->template('plus');

	}

	

	

	

	

   













