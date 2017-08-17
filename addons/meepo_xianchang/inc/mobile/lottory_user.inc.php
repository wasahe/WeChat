<?php
/**
 * MEEPO 米波现场
 *
 * 官网 http://meepo.com.cn 作者QQ 284099857
 */
global $_W,$_GPC;
$weid = $_W['uniacid'];
$rid = intval($_GPC['rid']);
if($_W['isajax']){
	$where = '';
	$luck_user = pdo_fetchall("SELECT `user_id` FROM ".tablename($this->lottory_user_table)." WHERE rid=:rid AND weid=:weid",array(':rid'=>$rid,':weid'=>$weid));
	if(!empty($luck_user)){
		foreach($luck_user as $row){
			$real_user[] = $row['user_id'];
		}
		 $where .= "AND id NOT IN  ('".implode("','", $real_user)."')";
	}
	$user = pdo_fetchall("SELECT * FROM ".tablename($this->user_table)." WHERE rid=:rid AND weid = :weid AND isblacklist=:isblacklist AND can_lottory=:can_lottory AND status=:status {$where}",array(':rid'=>$rid,':weid'=>$weid,':isblacklist'=>'1',':can_lottory'=>'1',':status'=>'1'));
	$data = array();
	$data['ret'] = 0;
	$data['data'] = $user;
	die(json_encode($data));
}