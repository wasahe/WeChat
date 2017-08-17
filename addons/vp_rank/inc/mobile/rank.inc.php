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
$cmd = $_GPC['cmd'];

if ($cmd == 'goods') {
	if ($_GPC['submit'] == 'list') {
		$where = ' where uniacid=:uniacid and rank_id=:rank_id and goods>bads and status=1 ';
		$params = array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id']);
		$list = pdo_fetchall('select * from ' . tablename('vp_rank_merchant') . ' ' . $where . '  ORDER BY score DESC limit 0,10', $params);
		$more = 0;
		$start += count($list);
		return $this->returnSuccess('', array('list' => $list, 'start' => $start, 'more' => $more));
	}


	include $this->template('goods_index');
	return 1;
}


if ($cmd == 'bads') {
	if ($_GPC['submit'] == 'list') {
		//$where = ' where uniacid=:uniacid and rank_id=:rank_id and bads>goods and status=1 ';
		$where = ' where uniacid=:uniacid and rank_id=:rank_id and bads>=0 and status=1 ';
		$params = array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id']);
		$list = pdo_fetchall('select * from ' . tablename('vp_rank_merchant') . ' ' . $where . '  ORDER BY bads desc limit 0,10', $params);
		$more = 0;
		$start += count($list);
		return $this->returnSuccess('', array('list' => $list, 'start' => $start, 'more' => $more));
	}


	include $this->template('bads_index');
}


?>