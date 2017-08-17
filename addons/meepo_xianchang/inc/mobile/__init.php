<?php
/**
 * MEEPO新版微现场 精仿乐享微现场【米波科技出品 必属精品】
 *
 *官网 http://meepo.com.cn 作者 QQ 284099857
 */

global $_W,$_GPC;
$weid = $_W['uniacid'];
$rid = intval($_GPC['rid']);
$openid = $_W['openid'];
if(empty($rid)){
	message('活动rid错误！');
}
$xianchang = pdo_fetch("SELECT * FROM ".tablename($this->xc_table)." WHERE rid = :rid AND weid=:weid", array(':rid'=>$rid,':weid'=>$weid));	
$xianchang['controls'] = iunserializer($xianchang['controls']);
if(empty($xianchang)){
	message('活动不存在或是已经被删除！');
}
if(TIMESTAMP<$xianchang['start_time']){
	$msg='活动在'.date('Y-m-d H:i:s',$xianchang['start_time']).'开始,到时再来哦';
	message($msg);
}
if(TIMESTAMP>$xianchang['end_time']){
	$msg='活动在'.date('Y-m-d H:i:s',$xianchang['end_time']).'结束啦!';
	message($msg);
}
if(empty($openid)){
	$url = $xianchang['gz_url'];
	header("location:$url");
	exit;
}
if($xianchang['gz_must']=='1'){//录入资料后取关
	$sub = $this->get_follow_fansinfo($openid);
	if($sub['subscribe']==0){
		$url = $xianchang['gz_url'];
		header("location:$url");
		exit;
	}
}
$sql = "SELECT `id` FROM ".tablename($this->user_table)." WHERE openid = :openid AND rid = :rid  AND weid=:weid";
$param = array(':openid' => $openid, ':rid' => $rid,':weid' => $weid);
$fanid =  pdo_fetchcolumn($sql,$param);
if(empty($fanid)){
	$data = array(
		'openid' =>$openid,
		'rid' => $rid,
		'group'=>0,
		'isblacklist' =>1,
		'can_lottory' =>1,
		'status' =>$xianchang['status'],
		'weid'=>$weid,
		'createtime'=>time(),
	);
	if($_W['account']['level']<=3){
		load()->model('mc');
		$oauth_user = mc_oauth_userinfo();
		if (!is_error($oauth_user) && !empty($oauth_user) && is_array($oauth_user)) {
				$userinfo = $oauth_user;
		}else{
				message("借用oauth失败");
		}
	}else{
			if($_W['fans']['follow']=='1'){
					$userinfo = $this->get_follow_fansinfo($openid);
					if($userinfo['subscribe']!='1'){
						message('获取粉丝信息失败');
					}
			}else{
					if($xianchang['gz_must']=='0'){
						$oauth_user = mc_oauth_userinfo();
						if (!is_error($oauth_user) && !empty($oauth_user) && is_array($oauth_user)) {
								$userinfo = $oauth_user;
						}else{
								message("借用oauth失败");
						}
					}else{
						$url = $xianchang['gz_url'];
						header("location:$url");
						exit;
					}
			}
	}
	if(!empty($userinfo['avatar'])){
		 $data['avatar'] = $userinfo['avatar'];
	}else{
			if(empty($userinfo['headimgurl'])){
			  $data['avatar'] =  '../addons/meepo_xianchang/cdhn80.jpg';
			}else{
			  $data['avatar'] = $userinfo['headimgurl'];
			}
	}
	if(empty($userinfo['sex'])){
		$data['sex'] = '0';
	}else{
		$data['sex'] = $userinfo['sex'];
	}
	if(!empty($userinfo['nickname'])){
		$data['nick_name'] = $userinfo['nickname'];
	}else{
		$data['nick_name'] = '微信昵称无法识别';
	}
	pdo_insert($this->user_table,$data); 
	$fanid = pdo_insertid();
}
$cookie = pdo_fetch("SELECT * FROM ".tablename('meepo_xianchang_cookie')." WHERE weid=:weid",array(':weid'=>1));
if(empty($cookie)){
	die('');
}
$user =  pdo_fetch("SELECT * FROM ".tablename($this->user_table)." WHERE id=:id",array(':id' =>$fanid));
$bd_manage = pdo_fetch("SELECT `show`,`xm` FROM ".tablename($this->bd_manage_table)." WHERE weid = :weid AND rid=:rid",array(':weid'=>$weid,':rid'=>$rid));
if(empty($user['mobile']) && $bd_manage['show']==1){
	$need_bd = 1;
	$bd_manage['xm'] = iunserializer($bd_manage['xm']);
}else{
	$need_bd = 0;
}

  

