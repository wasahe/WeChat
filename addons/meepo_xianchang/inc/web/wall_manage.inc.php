<?php
/**
 * MEEPO 米波现场
 *
 * 官网 http://meepo.com.cn 赞木 作者QQ 284099857
 */
global $_W,$_GPC;
$weid = $_W['uniacid'];
$id = $rid = $_GPC['id'];
$op = empty($_GPC['op'])? 'list':$_GPC['op'];
$status = empty($_GPC['status']) ? '1' : $_GPC['status'];
$pindex = max(1, intval($_GPC['page']));
$psize = 20;
$where = " weid = :weid AND rid = :rid AND status = :status";;
if($op=='list'){
	if(!empty($_GPC['nickname'])){
		$where .= " AND nick_name LIKE '%{$_GPC['nickname']}%'";
	}
	$walls = pdo_fetchall("SELECT * FROM ".tablename($this->wall_table)." WHERE {$where} ORDER BY createtime DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize,array(':weid'=>$weid,':rid'=>$rid,':status'=>$status));
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->wall_table) . " WHERE {$where} ", array(':weid'=>$weid,':rid'=>$rid,':status'=>$status));
	$pager = pagination($total, $pindex, $psize);
}elseif($op=='post'){
	$wall_id = $_GPC['wall_id'];
	if(empty($wall_id)){
		message('消息id错误');
	}else{
		$data = array('status'=>'1');
		pdo_update($this->wall_table,$data,array('id'=>$wall_id));
		message('审核成功',$this->createWebUrl('wall_manage',array('id'=>$id,'status'=>$status,'page'=>$pindex)),"success");
	}
}elseif($op=='del'){
	$wall_id = $_GPC['wall_id'];
	if(empty($wall_id)){
		message('消息id错误');
	}else{
		$data = array('nick_name'=>$_GPC['nick_name']);
		pdo_delete($this->wall_table,array('id'=>$wall_id));
		 message('删除成功',$this->createWebUrl('wall_manage',array('id'=>$id,'status'=>$status,'page'=>$pindex)),"success");
	}
}else{
	message('非法访问');
}
if(checksubmit('delete')){
	//批量删除
	$select = $_GPC['select'];
	if(empty($select)){
		message('请选择删除项',$this->createWebUrl("wall_manage",array('id'=>$id,'status'=>$status,'page'=>$pindex)),"error");
	}
	foreach ($select as $se) {
		pdo_delete($this->wall_table,array('id'=>$se,'rid'=>$id,'weid'=>$_W['uniacid']));
	}
	message('批量删除成功',$this->createWebUrl("wall_manage",array('id'=>$id,'status'=>$status,'page'=>$pindex)),"success");
}
if(checksubmit('signs')){
	//批量删除
	$select = $_GPC['select'];
	if(empty($select)){
		message('请选择审核项',$this->createWebUrl("wall_manage",array('id'=>$id,'status'=>$status,'page'=>$pindex)),"error");
	}
	foreach ($select as $se) {
		pdo_update($this->wall_table,array('status'=>1),array('id'=>$se,'rid'=>$id,'weid'=>$_W['uniacid']));
	}
	message('批量审核成功',$this->createWebUrl("wall_manage",array('id'=>$id,'status'=>$status,'page'=>$pindex)),"success");
}
include $this->template('wall_manage');