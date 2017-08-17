<?php
/**
 * 寻找单身狗模块微站定义
 *
 * @author deam
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
define('DM_ROOT', IA_ROOT . '/addons/deam_searchsingle');
define('DM_TABLEPRE', 'deam_searchsingle_');
require DM_ROOT. '/common/functions.php';
class Deam_searchsingleModuleSite extends WeModuleSite {

	public function Checkedcontainer(){
		global $_W;
		deam_only_wechat();
        if ($_W['container'] != 'wechat') {
        	message('非法访问，请通过微信打开！');
        	die();
        }
    }
    public function deamMembers($act_id){
		global $_W,$_GPC;	
		$this->Checkedcontainer();
		load()->model('mc');
		$uniacid = $_W['uniacid'];
		$userinfo = mc_oauth_userinfo();
		$profile = pdo_fetch("SELECT * FROM " . tablename('deam_searchsingle_members') . " WHERE uniacid = :uniacid AND openid = :openid AND act_id=:act_id", array(':openid' => $userinfo['openid'],':uniacid' => $uniacid,':act_id'=>$act_id));
		if(empty($profile)){
			if(!empty($userinfo['openid'])){
				$data = array(
					'uniacid' => $uniacid,
					'act_id' => $act_id,
					'openid' => $userinfo['openid'],
					'nickname' => $userinfo['nickname'],
					'avatar' => !empty($userinfo['avatar']) ? $userinfo['avatar'] : '../addons/deam_searchsingle/style/images/getheadimg.jpg',
					'createtime'=>TIMESTAMP
				);
				pdo_insert('deam_searchsingle_members',$data);
				$data['id'] = pdo_insertid();
			}
			return $data;
		}else{
			return $profile;
		}
	}
}