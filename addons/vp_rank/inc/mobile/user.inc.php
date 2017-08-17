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
$uid = $_GPC['uid'];

if (empty($uid)) {
	return $this->returnError('您从哪里来？要往哪里去？');
}


$uid = pdecode($uid);
$uid = intval($uid);

if (empty($uid)) {
	return $this->returnError('走错路了吧，朋友');
}


$you = pdo_fetch('select * from ' . tablename('vp_rank_user') . ' where uniacid=:uniacid and uid=:uid ', array(':uniacid' => $_W['uniacid'], ':uid' => $uid));

if (empty($you)) {
	return $this->returnError('你要找的，已然不再了');
}


$you['_authority'] = array_get_by_range($rank['authoritys'], $you['authority'], 'credit');
$you['_authority'] = (empty($you['_authority']) ? array() : $you['_authority']);

if ($cmd == 'test') {
	return 1;
}


if ($cmd == 'goods') {
	if ($_GPC['submit'] == 'list') {
		$start = $_GPC['start'];
		if (!isset($start) || empty($start) || intval($start <= 0)) {
			$start = 0;
		}
		 else {
			$start = intval($start);
		}

		$limit = 20;
		$list = pdo_fetchall('select * from ' . tablename('vp_rank_feed') . ' where uniacid=:uniacid and rank_id=:rank_id and uid=:uid and type=1 ' . (($you['uid'] == $user['uid'] ? '' : ' and status=1 and op=1 ')) . ' ORDER BY create_time DESC limit ' . $start . ',' . $limit . ' ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':uid' => $you['uid']));

		if (!empty($list)) {
			$i = 0;

			while ($i < count($list)) {
				$list[$i]['id'] = pencode($list[$i]['id']);

				if (!empty($list[$i]['images'])) {
					$images = iunserializer($list[$i]['images']);
					$images[0] = VP_IMAGE_URL($images[0], 't');
					$list[$i]['images'] = $images;
				}


				$list[$i]['_url'] = $this->createMobileUrl('feed', array('rid' => pencode($rank['id']), 'fid' => $list[$i]['id']));
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


	include $this->template('user_goods');
	return 1;
}


if ($cmd == 'bads') {
	if ($_GPC['submit'] == 'list') {
		$start = $_GPC['start'];
		if (!isset($start) || empty($start) || intval($start <= 0)) {
			$start = 0;
		}
		 else {
			$start = intval($start);
		}

		$limit = 20;
		$list = pdo_fetchall('select * from ' . tablename('vp_rank_feed') . ' where uniacid=:uniacid and rank_id=:rank_id and uid=:uid and type=2 ' . (($you['uid'] == $user['uid'] ? '' : ' and status=1 and op=1 ')) . ' ORDER BY create_time DESC limit ' . $start . ',' . $limit . ' ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':uid' => $you['uid']));

		if (!empty($list)) {
			$i = 0;

			while ($i < count($list)) {
				$list[$i]['id'] = pencode($list[$i]['id']);

				if (!empty($list[$i]['images'])) {
					$images = iunserializer($list[$i]['images']);
					$images[0] = VP_IMAGE_URL($images[0], 't');
					$list[$i]['images'] = $images;
				}


				$list[$i]['_url'] = $this->createMobileUrl('feed', array('rid' => pencode($rank['id']), 'fid' => $list[$i]['id']));
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


	include $this->template('user_bads');
	return 1;
}


if ($cmd == 'agrees') {
	if ($_GPC['submit'] == 'list') {
		$start = $_GPC['start'];
		if (!isset($start) || empty($start) || intval($start <= 0)) {
			$start = 0;
		}
		 else {
			$start = intval($start);
		}

		$limit = 20;
		$ids = pdo_fetchall('select feed_id from ' . tablename('vp_rank_gree') . ' where uniacid=:uniacid and rank_id=:rank_id and gree_uid=:gree_uid and gree=1 ORDER BY create_time DESC limit ' . $start . ',' . $limit . ' ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':gree_uid' => $you['uid']), 'feed_id');
		$list = array();

		if (!empty($ids) && (0 < count($ids))) {
			$ids = array_keys($ids);
			$list = pdo_fetchall('select * from ' . tablename('vp_rank_feed') . ' where uniacid=:uniacid and rank_id=:rank_id and id IN(' . implode(',', $ids) . ') ORDER BY create_time DESC  ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id']));

			if (!empty($list)) {
				$uids = array();

				foreach ($list as $v ) {
					if (empty($v['user_info'])) {
						$uids[] = $v['uid'];
					}

				}

				$vp_users = $this->vp_users($uids, 'id,uid,nickname,avatar,authority');
				$i = 0;

				while ($i < count($list)) {
					$list[$i]['id'] = pencode($list[$i]['id']);
					$uid = $list[$i]['uid'];
					$_user = $vp_users[$uid];
					$_user['avatar'] = VP_AVATAR($_user['avatar'], 's');
					$_user['_authority'] = array_get_by_range($rank['authoritys'], $_user['authority'], 'credit');
					$_user['_authority'] = (empty($_user['_authority']) ? array() : $_user['_authority']);
					$list[$i]['_user'] = $_user;

					if (!empty($list[$i]['images'])) {
						$images = iunserializer($list[$i]['images']);

						if (count($images) == 1) {
							$j = 0;

							while ($j < count($images)) {
								$images[$j] = VP_IMAGE_URL($images[$j], 'z');
								++$j;
							}
						}
						 else {
							$j = 0;

							while ($j < count($images)) {
								$images[$j] = VP_IMAGE_URL($images[$j], 's');
								++$j;
							}
						}

						$list[$i]['images'] = $images;
					}


					$list[$i]['_url'] = $this->createMobileUrl('feed', array('rid' => pencode($rank['id']), 'fid' => $list[$i]['id']));
					++$i;
				}
			}

		}


		$more = 1;
		if (empty($list) || (count($list) < $limit)) {
			$more = 0;
		}


		$start += count($list);
		return $this->returnSuccess('', array('list' => $list, 'start' => $start, 'more' => $more));
	}


	include $this->template('user_agrees');
	return 1;
}


if ($cmd == 'disagrees') {
	if ($_GPC['submit'] == 'list') {
		$start = $_GPC['start'];
		if (!isset($start) || empty($start) || intval($start <= 0)) {
			$start = 0;
		}
		 else {
			$start = intval($start);
		}

		$limit = 20;
		$ids = pdo_fetchall('select feed_id from ' . tablename('vp_rank_gree') . ' where uniacid=:uniacid and rank_id=:rank_id and gree_uid=:gree_uid and gree=2 ORDER BY create_time DESC limit ' . $start . ',' . $limit . ' ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':gree_uid' => $you['uid']), 'feed_id');
		$list = array();

		if (!empty($ids) && (0 < count($ids))) {
			$ids = array_keys($ids);
			$list = pdo_fetchall('select * from ' . tablename('vp_rank_feed') . ' where uniacid=:uniacid and rank_id=:rank_id and id IN(' . implode(',', $ids) . ') ORDER BY create_time DESC  ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id']));

			if (!empty($list)) {
				$uids = array();

				foreach ($list as $v ) {
					if (empty($v['user_info'])) {
						$uids[] = $v['uid'];
					}

				}

				$vp_users = $this->vp_users($uids, 'id,uid,nickname,avatar,authority');
				$i = 0;

				while ($i < count($list)) {
					$list[$i]['id'] = pencode($list[$i]['id']);
					$uid = $list[$i]['uid'];
					$_user = $vp_users[$uid];
					$_user['avatar'] = VP_AVATAR($_user['avatar'], 's');
					$_user['_authority'] = array_get_by_range($rank['authoritys'], $_user['authority'], 'credit');
					$_user['_authority'] = (empty($_user['_authority']) ? array() : $_user['_authority']);
					$list[$i]['_user'] = $_user;

					if (!empty($list[$i]['images'])) {
						$images = iunserializer($list[$i]['images']);

						if (count($images) == 1) {
							$j = 0;

							while ($j < count($images)) {
								$images[$j] = VP_IMAGE_URL($images[$j], 'z');
								++$j;
							}
						}
						 else {
							$j = 0;

							while ($j < count($images)) {
								$images[$j] = VP_IMAGE_URL($images[$j], 's');
								++$j;
							}
						}

						$list[$i]['images'] = $images;
					}


					$list[$i]['_url'] = $this->createMobileUrl('feed', array('rid' => pencode($rank['id']), 'fid' => $list[$i]['id']));
					++$i;
				}
			}

		}


		$more = 1;
		if (empty($list) || (count($list) < $limit)) {
			$more = 0;
		}


		$start += count($list);
		return $this->returnSuccess('', array('list' => $list, 'start' => $start, 'more' => $more));
	}


	include $this->template('user_disagrees');
	return 1;
}


if ($cmd == 'posts') {
	include $this->template('user_posts');
	return 1;
}


include $this->template('user_index');

?>