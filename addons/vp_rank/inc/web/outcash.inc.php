<?php
 

global $_W;
global $_GPC;
$cmd = $_GPC['cmd'];
$rank_id = $_GPC['rank_id'];

if (empty($rank_id)) {
	returnError('请选择要操作的圈子');
}


$rank = pdo_fetch('select * from ' . tablename('vp_rank') . ' where uniacid=:uniacid and id=:id ', array(':uniacid' => $_W['uniacid'], ':id' => $rank_id));

if (empty($rank)) {
	returnError('该圈子不存在');
}


if ($cmd == 'outcash') {
	$ids = $_GPC['ids'];

	if (empty($ids)) {
		returnError('请选择要发放的记录');
	}


	$channel = $_GPC['channel'];

	if (empty($channel)) {
		returnError('请选择发放渠道');
	}


	if ($channel != 1) {
		returnError('目前只支持微信红包方式发放');
	}


	$remark = $_GPC['remark'];

	if (empty($remark)) {
		returnError('请填写操作备注');
	}


	$outcashs = pdo_fetchall('select * from ' . tablename('vp_rank_outcash') . '  where uniacid=:uniacid and rank_id=:rank_id and id IN (:ids) ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':ids' => $ids));
	if (empty($outcashs) || (count($outcashs) == 0)) {
		returnError('记录不存在');
	}


	$errs = array();
	$i = 0;

	while ($i < count($outcashs)) {
		$outcash = $outcashs[$i];

		try {
			$ret = $this->transferByRedpack(array('id' => $outcash['id'], 'openid' => $outcash['openid'], 'nick_name' => $rank['name'], 'send_name' => $rank['name'], 'money' => $outcash['cash'], 'wishing' => '感谢您支持', 'act_name' => '提现红包', 'remark' => '提现红包'));
		}
		catch (Exception $e) {
			load()->func('logging');
			logging_run('发放异常：' . $e->getMessage());
			$ret = false;
		}

		if (is_error($ret)) {
			$errs[] = $outcash['id'];
		}
		 else {
			pdo_query('UPDATE ' . tablename('vp_rank_outcash') . ' SET status=1,channel=:channel,mch_billno=:mch_billno,out_billno=:out_billno,out_money=:out_money,tag=:tag,update_time=:update_time,remark=:remark where id=:id', array(':channel' => $channel, ':mch_billno' => $ret['mch_billno'], ':out_billno' => $ret['out_billno'], ':out_money' => $ret['out_money'], ':tag' => $ret['tag'], ':update_time' => time(), ':id' => $outcash['id'], ':remark' => $remark));
			pdo_query('UPDATE ' . tablename('vp_rank_user') . ' SET outcash=outcash+:outcash where  uniacid=:uniacid and rank_id=:rank_id and uid=:uid ', array(':outcash' => $ret['out_money'], ':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':uid' => $outcash['uid']));
		}

		++$i;
	}

	returnSuccess('成功发放' . count($outcashs) . '个' . ((count($errs) == 0 ? '' : '，失败：' . implode(',', $errs))));
	return 1;
}


if ($cmd == 'refusecash') {
	$id = $_GPC['id'];

	if (empty($id)) {
		returnError('请选择要拒绝的记录');
	}


	$fedback = $_GPC['fedback'];

	if (empty($fedback)) {
		returnError('请填写拒绝原因');
	}


	$outcash = pdo_fetch('select * from ' . tablename('vp_rank_outcash') . '  where uniacid=:uniacid and id=:id ', array(':uniacid' => $_W['uniacid'], ':id' => $id));

	if (empty($outcash)) {
		returnError('记录不存在');
	}


	pdo_query('UPDATE ' . tablename('vp_rank_outcash') . ' SET status=2,update_time=:update_time,fedback=:fedback where id=:id', array(':update_time' => time(), ':id' => $outcash['id'], ':fedback' => $fedback));
	returnSuccess('成功拒绝');
	return 1;
}


$where = ' where A.uniacid=:uniacid and A.rank_id=:rank_id ';
$params = array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id']);

if (isset($_GPC['stat'])) {
	$stat = intval($_GPC['stat']);

	if ('0' == $stat) {
		$where .= ' and A.status=0 ';
	}
	 else if ('1' == $stat) {
		$where .= ' and A.status=1 ';
	}
	 else if ('2' == $stat) {
		$where .= ' and A.status=2 ';
	}

}


$total = pdo_fetchcolumn('select count(id) from ' . tablename('vp_rank_outcash') . ' A   ' . $where . '', $params);
$pindex = max(1, intval($_GPC['page']));
$psize = 12;
$pager = pagination($total, $pindex, $psize);
$start = ($pindex - 1) * $psize;
$limit .= ' LIMIT ' . $start . ',' . $psize;
$list = pdo_fetchall('select A.*,B.nickname,B.avatar,B.income,B.money AS room_money,B.outcash from ' . tablename('vp_rank_outcash') . ' A LEFT JOIN ' . tablename('vp_rank_user') . ' B ON(A.uid=B.uid) ' . $where . ' order by A.create_time desc ' . $limit, $params);
include $this->template('web/outcash_list');

?>