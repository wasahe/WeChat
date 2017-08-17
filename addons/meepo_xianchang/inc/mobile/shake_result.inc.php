<?php
global $_W,$_GPC;
$rotate_id = intval($_GPC['rotate_id']);
$rid = intval($_GPC['rid']);
$weid = $_W['uniacid'];
$rounds = pdo_fetchall("SELECT * FROM ".tablename($this->shake_rotate_table)." WHERE weid=:weid AND rid=:rid ORDER BY id ASC",array(':weid'=>$weid,':rid'=>$rid));
if(!empty($rotate_id) && $rid){
	$data = pdo_fetchall("SELECT * FROM ".tablename($this->shake_user_table)." WHERE rid = :rid AND weid = :weid AND rotate_id = :rotate_id ORDER BY count DESC",array(':rid'=>$rid,':weid'=>$weid,':rotate_id'=>$rotate_id));
}else{
	$rotate_id = pdo_fetchcolumn("SELECT * FROM ".tablename($this->shake_rotate_table)." WHERE weid=:weid AND rid=:rid",array(':weid'=>$weid,':rid'=>$rid));
	
	$data = pdo_fetchall("SELECT * FROM ".tablename($this->shake_user_table)." WHERE rid = :rid AND weid = :weid AND rotate_id = :rotate_id  ORDER BY count DESC",array(':rid'=>$rid,':weid'=>$weid,':rotate_id'=>$rotate_id));
}
include $this->template('shake_result');