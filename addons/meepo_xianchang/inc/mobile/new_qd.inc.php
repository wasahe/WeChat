<?php
/**
 * MEEPO 米波现场
 *
 * 官网 http://meepo.com.cn 作者QQ 284099857
 */
global $_W,$_GPC;
$weid = $_W['uniacid'];
if($_W['isajax']){
	$rid = intval($_GPC['rid']);
	$maxid = intval($_GPC['mid']);//old max_id
	$qd = pdo_fetch("SELECT `id`,`nick_name`,`avatar` FROM ".tablename($this->qd_table)." WHERE weid = :weid AND rid = :rid AND level = :level AND id > :id ORDER BY createtime ASC LIMIT 1",array(':weid'=>$weid,':rid'=>$rid,':level'=>'1',':id'=>$maxid));
	$data = array();
	//{"omid":191080,"mid":191080,"nick_name":null,"qdnums":null,"avatar":null}
	if(empty($qd)){
		$data = array('omid'=>$maxid,'mid'=>$maxid,'nick_name'=>'','qdnums'=>'','avatar'=>'');
	}else{
		$qdnums = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename($this->qd_table)." WHERE weid = :weid AND rid = :rid AND level = :level AND id < :id",array(':weid'=>$weid,':rid'=>$rid,':level'=>'1',':id'=>$qd['id']));
		$qdnums = intval($qdnums) + 1;
		$data = array('omid'=>$maxid,'mid'=>$qd['id'],'nick_name'=>$qd['nick_name'],'qdnums'=>$qdnums,'avatar'=>$qd['avatar']);
	}
	die(json_encode($data));
}