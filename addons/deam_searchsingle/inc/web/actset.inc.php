<?php
/**
 * 寻找单身狗模块微站定义
 *
 * @author deam
 * @url http://bbs.we7.cc/
 * @desc 游戏管理
 */
defined('IN_IA') or exit('Access Denied');
global $_W,$_GPC;
$uniacid = $_W['uniacid'];
$nowtime = TIMESTAMP;
$operation = empty($_GPC['op']) ? 'display' : $_GPC['op'];

if($operation == 'display'){
	$pindex = max(1, intval($_GPC['page']));

	$psize = 30;

	$condition = 'AND is_delete=0';

	
	$list = pdo_fetchall("SELECT * FROM " . tablename('deam_searchsingle_actset') . " WHERE uniacid = '{$_W['uniacid']}' $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
	
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('deam_searchsingle_actset') . " WHERE uniacid = '{$_W['uniacid']}' $condition");

	$pager = pagination($total, $pindex, $psize);
}elseif ($operation == 'post') {
	$id = intval($_GPC['id']);
	if (!empty($id)) {
		$item = pdo_fetch("SELECT * FROM " . tablename('deam_searchsingle_actset') . " WHERE id = :id AND uniacid = :uniacid AND is_delete=0", array(':id' => $id,':uniacid'=>$uniacid));
		$need_info = iunserializer($item['need_info']);
		if (empty($item)) {
			message('抱歉，活动不存在或是已经删除！', '', 'error');
		}
		
	}
	$need_username = @in_array('username',$need_info);
	$need_telphone = @in_array('telphone',$need_info);
	$item['starttime'] = empty($item['starttime']) ? $nowtime : $item['starttime'];
	$item['endtime'] = empty($item['endtime']) ? $nowtime : $item['endtime'];
	if(checksubmit('submit')){
		
		$date = $_GPC['datelimit'];
		$starttime = strtotime($date['start']);
		$starttime=date('Y-m-d H:i',$starttime);
		$starttime = strtotime($starttime);
		
		$endtime = strtotime($date['end']);
		$endtime=date('Y-m-d H:i',$endtime);
		$endtime = strtotime($endtime);
		
		$data = array(
			'uniacid' => intval($_W['uniacid']),
			'act_name' => $_GPC['act_name'],
			'pagetitle' => $_GPC['pagetitle'],
			'qrcodeimage' => $_GPC['qrcodeimage'],
			'createtime' => TIMESTAMP,
			'is_info' => intval($_GPC['is_info']),
			'need_info' => is_array($_GPC['need_info']) ? iserializer($_GPC['need_info']) : '',
			'is_subscribe' => intval($_GPC['is_subscribe']),
			'is_area' => intval($_GPC['is_area']),
			'in_area' => $_GPC['in_area'],
			'is_jssdk' => intval($_GPC['is_jssdk']),
			'share_img' => $_GPC['share_img'],
			'share_title' => $_GPC['share_title'],
			'share_desc' => $_GPC['share_desc'],
			'gzimage' => $_GPC['gzimage'],
			'starttime' => $starttime,
			'endtime' => $endtime,
			'content' => htmlspecialchars_decode($_GPC['content']),
			'copyright' =>$_GPC['copyright'],
			'reply_title'		=>	trim($_GPC['reply_title']),
			'reply_img'			=>	trim($_GPC['reply_img']),
			'reply_description'	=>	trim($_GPC['reply_description']),
		);
		if (empty($id)) {
			pdo_insert('deam_searchsingle_actset', $data);
			$id = pdo_insertid();
		} else {
			unset($data['createtime']);
			$result = pdo_update("deam_searchsingle_actset", $data,array("id"=>$id));
		}
		message('更新成功！', $this->createWebUrl('actset', array('op' => 'post', 'id' => $id)), 'success');
		
	}
}elseif ($operation == 'delete') {
	$id = intval($_GPC['id']);
	$result = pdo_update("deam_searchsingle_actset", "is_delete=1",array("id"=>$id));
	message('删除成功！', $this->createWebUrl('actset'), 'success');
}

include $this->template('systerm/actset');
?>