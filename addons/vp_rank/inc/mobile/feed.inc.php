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
$fid = $_GPC['fid'];

if (empty($fid)) {
	return $this->returnError('您从哪里来？要往哪里去？');
}


$fid = pdecode($fid);
$fid = intval($fid);

if (empty($fid)) {
	return $this->returnError('走错路了吧，朋友');
}


$feed = pdo_fetch('select * from ' . tablename('vp_rank_feed') . ' where uniacid=:uniacid and id=:id ', array(':uniacid' => $_W['uniacid'], ':id' => $fid));

if (empty($feed)) {
	return $this->returnError('你要找的，已然不再了');
}


$feed['agreers'] = (empty($feed['agreers']) ? array() : explode(',', $feed['agreers']));
$feed['disagreers'] = (empty($feed['disagreers']) ? array() : explode(',', $feed['disagreers']));
$cmd = $_GPC['cmd'];

if ($cmd == 'agree') {
	if (in_array($user['uid'], $feed['agreers'])) {
		return $this->returnError('您已经赞同过了');
	}


	if (in_array($user['uid'], $feed['disagreers'])) {
		return $this->returnError('您已经反对过了');
	}


	$feed['agreers'][] = $user['uid'];
	$ret = pdo_query('UPDATE ' . tablename('vp_rank_feed') . ' SET agrees=agrees+1, agreers=:agreers, update_time=:update_time where uniacid=:uniacid and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $feed['id'], ':agreers' => implode(',', $feed['agreers']), ':update_time' => time()));

	if (empty($ret)) {
		return $this->returnError('没赞同成功，重试看看呢');
	}


	pdo_query('UPDATE ' . tablename('vp_rank_user') . ' SET authority=authority+1, agreeds=agreeds+1 where uniacid=:uniacid and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $mine['id']));

	if (!empty($rank['settings']['credit_type']) && !empty($rank['settings']['credit_award_gree'])) {
		load()->model('mc');
		mc_credit_update($user['uid'], $rank['settings']['credit_type'], $rank['settings']['credit_award_gree'], array(0, '表示赞同', MD_NAME));
	}


	pdo_insert('vp_rank_gree', array('uniacid' => $_W['uniacid'], 'rank_id' => $rank['id'], 'feed_id' => $feed['id'], 'uid' => $feed['uid'], 'gree_uid' => $user['uid'], 'gree' => 1, 'create_time' => time()));

	if ($feed['type'] == 1) {
		pdo_query('UPDATE ' . tablename('vp_rank_merchant') . ' SET score=score+1, goods=goods+1 where uniacid=:uniacid and rank_id=:rank_id and id=:id', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':id' => $feed['merchant_id']));
	}
	 else if ($feed['type'] == 2) {
		pdo_query('UPDATE ' . tablename('vp_rank_merchant') . ' SET score=score-1, bads=bads+1 where uniacid=:uniacid and rank_id=:rank_id and id=:id', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':id' => $feed['merchant_id']));
	}


	return $this->returnSuccess('赞同成功');
}


if ($cmd == 'disagree') {
	if (in_array($user['uid'], $feed['disagreers'])) {
		return $this->returnError('您已经反对过了');
	}


	if (in_array($user['uid'], $feed['agreers'])) {
		return $this->returnError('您已经赞同过了');
	}


	$feed['disagreers'][] = $user['uid'];
	$ret = pdo_query('UPDATE ' . tablename('vp_rank_feed') . ' SET disagrees=disagrees+1, disagreers=:disagreers, update_time=:update_time where uniacid=:uniacid and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $feed['id'], ':disagreers' => implode(',', $feed['disagreers']), ':update_time' => time()));

	if (empty($ret)) {
		return $this->returnError('没反对成功，重试看看呢');
	}


	pdo_query('UPDATE ' . tablename('vp_rank_user') . ' SET authority=authority-1, disagreeds=disagreeds+1 where uniacid=:uniacid and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $mine['id']));

	if (!empty($rank['settings']['credit_type']) && !empty($rank['settings']['credit_award_gree'])) {
		load()->model('mc');
		mc_credit_update($user['uid'], $rank['settings']['credit_type'], $rank['settings']['credit_award_gree'], array(0, '表示反对', MD_NAME));
	}


	pdo_insert('vp_rank_gree', array('uniacid' => $_W['uniacid'], 'rank_id' => $rank['id'], 'feed_id' => $feed['id'], 'uid' => $feed['uid'], 'gree_uid' => $user['uid'], 'gree' => 2, 'create_time' => time()));

	if ($feed['type'] == 1) {
		pdo_query('UPDATE ' . tablename('vp_rank_merchant') . ' SET score=score-1, goods=goods-1 where uniacid=:uniacid and rank_id=:rank_id and id=:id', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':id' => $feed['merchant_id']));
	}
	 else if ($feed['type'] == 2) {
		pdo_query('UPDATE ' . tablename('vp_rank_merchant') . ' SET score=score+1, bads=bads-1 where uniacid=:uniacid and rank_id=:rank_id and id=:id', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':id' => $feed['merchant_id']));
	}


	return $this->returnSuccess('反对成功');
}


if ($cmd == 'reply') {
	$content = $_GPC['content'];

	if (empty($content)) {
		return $this->returnError('您什么都还没说呢');
	}


	if (500 < text_len($content)) {
		return $this->returnError('回复内容太长啦~不要超过500字');
	}


	pdo_insert('vp_rank_reply', array('uniacid' => $_W['uniacid'], 'rank_id' => $rank['id'], 'feed_id' => $feed['id'], 'uid' => $user['uid'], 'content' => $content, 'create_time' => time(), 'update_time' => time(), 'status' => 1));
	$reply_id = pdo_insertid();

	if (empty($reply_id)) {
		$this->returnError('回复失败，重试看看呢');
	}


	pdo_query('UPDATE ' . tablename('vp_rank_feed') . ' SET replys=replys+1 where uniacid=:uniacid and rank_id=:rank_id and id=:id', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':id' => $feed['id']));

	if (!empty($rank['settings']['notice_reply'])) {
		$openid = pdo_fetchcolumn('select openid from ' . tablename('mc_mapping_fans') . '  where uniacid=:uniacid and uid=:uid and follow=1 ', array(':uniacid' => $_W['uniacid'], ':uid' => $feed['uid']));

		if (!empty($openid)) {
			$postdata = array(
				'first'    => array('value' => '有人回复了您发表的内容', 'color' => '#576b95'),
				'keyword1' => array('value' => (empty($user['nickname']) ? '用户_' . $user['uid'] : $user['nickname']), 'color' => '#576b95'),
				'keyword2' => array('value' => date('y-m-d h:i:s', time()), 'color' => '#576b95'),
				'keyword3' => array('value' => '点击查看', 'color' => '#576b95'),
				'remark'   => array('value' => '来自' . $rank['name'], 'color' => '#999999')
				);
			$accObj = WeiXinAccount::create($_W['oauth_account']);
			$accObj->sendTplNotice($openid, $rank['settings']['notice_reply'], $postdata, $_SERVER['HTTP_REFERER'], '#FF5454');
		}

	}


	return $this->returnSuccess('回复成功');
}


if ($cmd == 'replys') {
	$start = $_GPC['start'];
	if (!isset($start) || empty($start) || intval($start <= 0)) {
		$start = 0;
	}
	 else {
		$start = intval($start);
	}

	$limit = 20;
	$sort = $_GPC['sort'];
	$sort = (($sort == 'new' ? ' ORDER BY create_time DESC ' : ' ORDER BY likes DESC,create_time DESC '));
	$list = pdo_fetchall('select * from ' . tablename('vp_rank_reply') . ' where uniacid=:uniacid and rank_id=:rank_id and feed_id=:feed_id and status=1 ' . $sort . ' limit ' . $start . ',' . $limit . ' ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':feed_id' => $feed['id']));

	if (!empty($list)) {
		$rpids = array();
		$uids = array();

		foreach ($list as $v ) {
			$rpids[] = $v['id'];
			$uids[] = $v['uid'];
		}

		$vp_users = $this->vp_users($uids, 'id,uid,nickname,avatar,authority');
		$rewards = pdo_fetchall('select reply_id,group_concat(avatar) as avatars from ' . tablename('vp_rank_ward') . ' where uniacid=:uniacid and rank_id=:rank_id and feed_id=:feed_id and reply_id IN(' . implode(',', $rpids) . ') GROUP BY reply_id ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':feed_id' => $feed['id']), 'reply_id');
		$i = 0;

		while ($i < count($list)) {
			$uid = $list[$i]['uid'];
			$_user = $vp_users[$uid];
			$_user['avatar'] = VP_AVATAR($_user['avatar'], 's');
			$_user['_authority'] = array_get_by_range($rank['authoritys'], $_user['authority'], 'credit');
			$list[$i]['_user'] = $_user;

			if (!empty($rewards[$list[$i]['id']]['avatars'])) {
				$_rewards = explode(',', $rewards[$list[$i]['id']]['avatars']);
				$j = 0;

				while ($j < count($_rewards)) {
					$_rewards[$j] = VP_AVATAR($_rewards[$j], 's');
					++$j;
				}

				$list[$i]['_rewards'] = $_rewards;
			}


			$list[$i]['likers'] = (empty($list[$i]['likers']) ? array() : explode(',', $list[$i]['likers']));

			if (in_array($user['uid'], $list[$i]['likers'])) {
				$list[$i]['_liked'] = 1;
			}


			unset($list[$i]['likers']);
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


if ($cmd == 'like') {
	$rpid = $_GPC['rpid'];

	if (empty($rpid)) {
		$this->returnError('缺少参数');
	}


	$type = $_GPC['type'];
	$type = (($type == 1 ? 1 : 2));
	$reply = pdo_fetch('select * from ' . tablename('vp_rank_reply') . ' where uniacid=:uniacid and rank_id=:rank_id and feed_id=:feed_id and id=:id ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':feed_id' => $feed['id'], ':id' => $rpid));

	if (empty($reply)) {
		$this->returnError('该回复不存在');
	}


	$likers = ((empty($reply['likers']) ? array() : explode(',', $reply['likers'])));

	if ($type == 1) {
		if (in_array($user['uid'], $likers)) {
			$this->returnSuccess('已赞');
			return 1;
		}


		$likers[] = $user['uid'];
		$ret = pdo_query('UPDATE ' . tablename('vp_rank_reply') . ' SET likes=likes+1, likers=:likers where id=:id', array(':id' => $rpid, ':likers' => implode(',', $likers)));

		if (empty($ret)) {
			return $this->returnError('没赞成功，重试看看呢');
		}


		$this->returnSuccess('已赞');
		return 1;
	}


	$uidk = array_search($user['uid'], $likers);

	if (false === $uidk) {
		$this->returnSuccess('已取消');
		return 1;
	}


	array_splice($likers, $uidk, 1);
	$ret = pdo_query('UPDATE ' . tablename('vp_rank_reply') . ' SET likes=likes-1, likers=:likers where id=:id', array(':id' => $rpid, ':likers' => implode(',', $likers)));

	if (empty($ret)) {
		return $this->returnError('没取消成功，重试看看呢');
	}


	$this->returnSuccess('已取消');
	return 1;
}


if ($cmd == 'award') {
	$money = intval($_GPC['money']);
	if (empty($money) || ($money <= 0)) {
		return $this->returnError('请输入有效的金额');
	}


	if (!in_array($money, $rank['settings']['award_values'])) {
		if ($money < ($rank['settings']['award_min'] / 100)) {
			return $this->returnError('不能低于' . ($rank['settings']['award_min'] / 100) . '元');
		}


		if (($rank['settings']['award_max'] / 100) < $money) {
			return $this->returnError('不能高于' . ($rank['settings']['award_max'] / 100) . '元');
		}

	}


	$order = array('uniacid' => $_W['uniacid'], 'biz' => 'award', 'biz_id' => $feed['uid'], 'uid' => $user['uid'], 'rank_id' => $rank['id'], 'fee' => $money, 'detail' => iserializer(array('feed_id' => $feed['id'], 'nickname' => $user['nickname'], 'avatar' => $user['avatar'], 'url' => $_SERVER['HTTP_REFERER'])), 'status' => 1, 'create_time' => time());
	pdo_insert('vp_rank_order', $order);
	$order_id = pdo_insertid();

	if (empty($order_id)) {
		$this->returnError('打赏失败，请重试');
	}


	$params = array('tid' => $order_id, 'ordersn' => $order_id, 'title' => '打赏作者', 'fee' => $order['fee'] / 100, 'user' => $user['nickname']);
	$params = $this->payReady($params);
	$this->returnSuccess('', base64_encode(json_encode($params)));
	return 1;
}


if ($cmd == 'awards') {
	$total = pdo_fetchcolumn('select COUNT(id) from ' . tablename('vp_rank_ward') . ' where uniacid=:uniacid and rank_id=:rank_id and feed_id=:feed_id and reply_id=0  ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':feed_id' => $feed['id']));
	$list = pdo_fetchall('select * from ' . tablename('vp_rank_ward') . ' where uniacid=:uniacid and rank_id=:rank_id and feed_id=:feed_id and reply_id=0  ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':feed_id' => $feed['id']));

	if (!empty($list)) {
		$i = 0;

		while ($i < count($list)) {
			$list[$i]['avatar'] = VP_AVATAR($list[$i]['avatar'], 's');
			++$i;
		}
	}


	return $this->returnSuccess('', array('total' => $total, 'list' => $list));
}


if ($cmd == 'reward') {
	$money = intval($_GPC['money']);
	if (empty($money) || ($money <= 0)) {
		return $this->returnError('请输入有效的金额');
	}


	if (!in_array($money, $rank['settings']['award_values'])) {
		if ($money < ($rank['settings']['award_min'] / 100)) {
			return $this->returnError('不能低于' . ($rank['settings']['award_min'] / 100) . '元');
		}


		if (($rank['settings']['award_max'] / 100) < $money) {
			return $this->returnError('不能高于' . ($rank['settings']['award_max'] / 100) . '元');
		}

	}


	$reply_id = intval($_GPC['reply_id']);

	if (empty($reply_id)) {
		return $this->returnError('请选择要打赏的回复');
	}


	$reply = pdo_fetch('select * from ' . tablename('vp_rank_reply') . ' where uniacid=:uniacid and id=:id ', array(':uniacid' => $_W['uniacid'], ':id' => $reply_id));

	if (empty($reply)) {
		return $this->returnError('该回复不存在或已被删除');
	}


	$order = array('uniacid' => $_W['uniacid'], 'biz' => 'reward', 'biz_id' => $reply['uid'], 'uid' => $user['uid'], 'rank_id' => $rank['id'], 'fee' => $money, 'detail' => iserializer(array('feed_id' => $feed['id'], 'reply_id' => $reply['id'], 'nickname' => $user['nickname'], 'avatar' => $user['avatar'], 'url' => $_SERVER['HTTP_REFERER'])), 'status' => 1, 'create_time' => time());
	pdo_insert('vp_rank_order', $order);
	$order_id = pdo_insertid();

	if (empty($order_id)) {
		$this->returnError('打赏失败，请重试');
	}


	$params = array('tid' => $order_id, 'ordersn' => $order_id, 'title' => '打赏回复', 'fee' => $order['fee'] / 100, 'user' => $user['nickname']);
	$params = $this->payReady($params);
	$this->returnSuccess('', base64_encode(json_encode($params)));
	return 1;
}


$feed['images'] = (empty($feed['images']) ? array() : iunserializer($feed['images']));

if (empty($feed['user_info'])) {
	$_user = $this->vp_users($feed['uid'], 'avatar,nickname,authority');
	$_user['_authority'] = array_get_by_range($rank['authoritys'], $_user['authority'], 'credit');
	$feed['_user'] = $_user;
}
 else {
	$feed['_user'] = iunserializer($feed['user_info']);
	unset($feed['user_info']);
}

$uids = array();
$i = 0;

while (array() && ($i < ($feed['agreers'])) && ($i < 9)) {
	$uids[] = $feed['agreers'][$i];
	++$i;
}
$feed['_agreers'] = $this->vp_users($uids, 'avatar,nickname');
$uids = array();
$i = 0;

while (array() && ($i < ($feed['disagreers'])) && ($i < 9)) {
	$uids[] = $feed['disagreers'][$i];
	++$i;
}
$feed['_disagreers'] = $this->vp_users($uids, 'avatar,nickname');
include $this->template('feed_index');

?>