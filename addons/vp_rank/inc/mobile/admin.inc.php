<?php
 

global $_W;
global $_GPC;
$this->_doMobileAuth();
$user = $this->_user;
$is_user_infoed = $this->_is_user_infoed;
$this->_doMobileInitialize();
$cmd = $this->_cmd;
$rank = $this->_rank;
$mine = $this->_mine;

if ($mine['admin'] <= 0) {
	return $this->returnError('您不是管理员，无权操作~');
}


if ($cmd == 'feed_delete') {
	$fid = $_GPC['fid'];

	if (empty($fid)) {
		return $this->returnError('请选择要操作的内容');
	}


	$fid = pdecode($fid);
	$fid = intval($fid);

	if (empty($fid)) {
		return $this->returnError('请选择要操作的内容');
	}


	if (false === pdo_delete('vp_rank_feed', array('uniacid' => $_W['uniacid'], 'id' => $fid), 'AND')) {
		return $this->returnError('删除失败，请重试');
	}


	return $this->returnSuccess('删除成功', $this->createMobileUrl('index', array('rid' => pencode($rank['id']))));
}


if ($cmd == 'report') {
	if ($_GPC['submit'] == 'list') {
		$start = $_GPC['start'];
		if (!isset($start) || empty($start) || intval($start <= 0)) {
			$start = 0;
		}
		 else {
			$start = intval($start);
		}

		$limit = 20;
		$list = pdo_fetchall('select * from ' . tablename('vp_rank_report') . ' where uniacid=:uniacid and rank_id=:rank_id limit ' . $start . ',' . $limit . ' ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id']));

		if (!empty($list)) {
			$uids = array();

			foreach ($list as $v ) {
				$uids[] = $v['uid'];
			}

			$vp_users = $this->vp_users($uids, 'id,uid,nickname,avatar,authority');
			$i = 0;

			while ($i < count($list)) {
				$list[$i]['url'] = $_W['siteroot'] . 'app/' . substr($this->createMobileUrl('feed', array('rid' => pencode($rank['id']), 'fid' => pencode($list[$i]['feed_id']))), 2);
				$uid = $list[$i]['uid'];
				$_user = $vp_users[$uid];
				$_user['avatar'] = VP_AVATAR($_user['avatar'], 's');
				$list[$i]['_user'] = $_user;
				++$i;
			}
		}


		$more = 1;
		if (empty($list) || (count($list) < $limit)) {
			$more = 0;
		}


		$start += count($list);
		return $this->returnSuccess('', array('list' => $list, 'start' => $start, 'more' => $more));
	}


	if ($_GPC['submit'] == 'op') {
		$id = $_GPC['id'];

		if (empty($id)) {
			return $this->returnError('请选择要操作的内容');
		}


		pdo_query('UPDATE ' . tablename('vp_rank_report') . ' SET status=2, status_time=:status_time, op_admin=:op_admin where uniacid=:uniacid and rank_id=:rank_id and id=:id', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':id' => $id, ':status_time' => time(), ':op_admin' => $user['uid']));
		return $this->returnSuccess('操作成功');
	}


	include $this->template('admin_report');
}


?>