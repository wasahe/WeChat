<?php
 

global $_W;
global $_GPC;
$cmd = $_GPC['cmd'];
$rank_id = $_GPC['rank_id'];

if (empty($rank_id)) {
	returnError('请选择要操作的圈子');
}


if ($cmd == 'add') {
	$uid = intval($_GPC['uid']);

	if (empty($uid)) {
		returnError('抱歉，传递的参数错误！');
	}


	pdo_query('UPDATE ' . tablename('vp_rank_user') . ' SET admin=1 where uniacid=:uniacid and rank_id=:rank_id and uid=:uid', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank_id, ':uid' => $uid));
	returnSuccess('添加成功！', $this->createWebUrl('admin', array('rank_id' => $rank_id)), 'success');
	return 1;
}


if ($cmd == 'delete') {
	$uid = intval($_GPC['uid']);

	if (empty($uid)) {
		returnError('抱歉，传递的参数错误！');
	}


	pdo_query('UPDATE ' . tablename('vp_rank_user') . ' SET admin=0 where uniacid=:uniacid and rank_id=:rank_id and uid=:uid', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank_id, ':uid' => $uid));
	returnSuccess('删除成功！', $this->createWebUrl('admin', array('rank_id' => $rank_id)), 'success');
	return 1;
}


$params = array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank_id);
$list = pdo_fetchall('select * from ' . tablename('vp_rank_user') . ' where uniacid=:uniacid  and rank_id=:rank_id and admin>0 ', $params);
$i = 0;

while ($i < count($list)) {
	$list[$i]['_user'] = $this->vp_users($list[$i]['uid'], 'nickname,avatar');
	++$i;
}

include $this->template('web/admin_list');

?>