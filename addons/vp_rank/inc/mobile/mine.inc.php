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

if ($cmd == 'money') {
	include $this->template('mine_money');
	return 1;
}


if ($cmd == 'income') {
	if ('list' == $_GPC['submit']) {
		$start = $_GPC['start'];
		if (!isset($start) || empty($start) || intval($start <= 0)) {
			$start = 0;
		}
		 else {
			$start = intval($start);
		}

		$limit = 20;
		$where = ' where uniacid=:uniacid and rank_id=:rank_id and ward_uid=:ward_uid ';
		$params = array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':ward_uid' => $user['uid']);
		$list = pdo_fetchall('select feed_id,reply_id,money,create_time from ' . tablename('vp_rank_ward') . '  ' . $where . ' ORDER BY create_time DESC limit ' . $start . ',' . $limit . ' ', $params);

		if (0 < count($list)) {
			$i = 0;

			while ($i < count($list)) {
				if (0 < $list[$i]['reply_id']) {
					$list[$i]['biz_text'] = '回复被打赏';
				}
				 else {
					$list[$i]['biz_text'] = '发表内容被打赏';
				}

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

}
 else if ($cmd == 'outcash') {
	$money = $mine['money'];

	if (20000 < $money) {
		$money = 20000;
	}


	$rate = floatval($rank['settings']['cash_rate']);
	$tax = intval($rate * $money);
	$cash = $money - $tax;
	$outcash_min = ((empty($rank['settings']['cash_min']) ? 100 : $rank['settings']['cash_min'] * 100));

	if ($cash < $outcash_min) {
		$this->returnError('扣除服务费后，需满' . ($outcash_min / 100) . '元才可提现');
	}


	if ('outcash' == $_GPC['submit']) {
		if (($money != $_GPC['money']) || ($rate != $_GPC['rate']) || ($tax != $_GPC['tax']) || ($cash != $_GPC['cash'])) {
			$this->returnError('账户金额变化，请重新发起提现');
		}


		$ret1 = pdo_query('UPDATE ' . tablename('vp_rank_user') . ' SET money=money-:money where uniacid=:uniacid and uid=:uid', array(':uniacid' => $_W['uniacid'], ':uid' => $user['uid'], ':money' => $money));

		if (false === $ret1) {
			$this->returnError('操作失败，请重试');
		}


		pdo_insert('vp_rank_outcash', array('uniacid' => $_W['uniacid'], 'rank_id' => $rank['id'], 'uid' => $user['uid'], 'openid' => $_W['openid'], 'money' => $money, 'money_before' => $mine['money'], 'money_after' => $mine['money'] - $money, 'cash' => $cash, 'rate' => $rate, 'tax' => $tax, 'status' => 0, 'create_time' => time(), 'update_time' => time()));
		$outcash_id = pdo_insertid();

		if (empty($outcash_id)) {
			$this->returnError('操作失败，请重试');
		}


		$this->returnSuccess('款项会在最迟两个工作日内以微信红包的形式发放给您，请注意查收');
		return 1;
	}


	$this->returnSuccess('<p>本次提现' . ($money / 100) . '元</p><p>扣除' . ($rate * 100) . '%服务费' . ($tax / 100) . '元</p><p>实际到账金额为' . ($cash / 100) . '元</p>', array('submit' => 'outcash', 'money' => $money, 'rate' => $rate, 'tax' => $tax, 'cash' => $cash));
	return 1;
}
 else if ($cmd == 'outcashs') {
	if ('list' == $_GPC['submit']) {
		$start = $_GPC['start'];
		if (!isset($start) || empty($start) || intval($start <= 0)) {
			$start = 0;
		}
		 else {
			$start = intval($start);
		}

		$limit = 20;
		$where = ' where uniacid=:uniacid and rank_id=:rank_id and uid=:uid ';
		$params = array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':uid' => $user['uid']);
		$list = pdo_fetchall('select money,cash,rate,tax,status,channel,fedback,create_time,update_time from ' . tablename('vp_rank_outcash') . '  ' . $where . ' ORDER BY create_time DESC limit ' . $start . ',' . $limit . ' ', $params);

		if (0 < count($list)) {
			$i = 0;

			while ($i < count($list)) {
				if ($list[$i]['status'] == 0) {
					$list[$i]['status_text'] = '处理中（两工作日内完成）';
				}
				 else if ($list[$i]['status'] == 1) {
					$list[$i]['status_text'] = '已通过' . (($list[$i]['channel'] == 1 ? '微信红包' : '微信企业付款')) . '发放';
				}
				 else if ($list[$i]['status'] == 2) {
					$list[$i]['status_text'] = '已拒绝';
				}


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


	include $this->template('mine_outcash');
	return 1;
}
 else {
	$rank2 = pdo_fetchall('select * from ' . tablename('vp_rank'));
	$authoritys = $rank2[0]['authoritys'];
	$authoritys = iunserializer($authoritys);
	$rank['authoritys'] = $authoritys;
	$mine['_authority'] = array_get_by_range($rank['authoritys'], $mine['authority'], 'credit');
	$mine['_authority'] = (empty($mine['_authority']) ? array() : $mine['_authority']);
	$you = $mine;
	include $this->template('user_index');
}

?>