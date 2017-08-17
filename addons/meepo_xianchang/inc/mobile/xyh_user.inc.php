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
	$user = pdo_fetchall("SELECT * FROM ".tablename($this->user_table)." WHERE rid=:rid AND weid = :weid AND isblacklist=:isblacklist AND  status=:status {$where}",array(':rid'=>$rid,':weid'=>$weid,':isblacklist'=>'1',':status'=>'1'));
	$data = array();
	$data['ret'] = 0;
	$data['data'] = $user;
	die(json_encode($data));
}