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

if ($cmd == 'post') {
	$type = $_GPC['type'];
	if (empty($type) || !in_array($type, array('1', '2'))) {
		return $this->returnError('请选择您的点评类型');
	}


	if ($_GPC['submit'] == 'post') {
		$merchant_id = $_GPC['merchant_id'];
		$merchant_name = $_GPC['merchant_name'];

		if (empty($merchant_name)) {
			return $this->returnError('您还没有选择商家哦~');
		}


		if (empty($merchant_id) && (20 < text_len($merchant_name))) {
			return $this->returnError('商家名称太长，不要超过20个字');
		}


		$content = $_GPC['content'];

		if (empty($content)) {
			return $this->returnError('您还没有写点评内容哦~');
		}


		if (500 < text_len($content)) {
			return $this->returnError('点评内容太长啦~不要超过500字');
		}


		if (empty($merchant_id)) {
			$merchant = pdo_fetch('select * from ' . tablename('vp_rank_merchant') . ' where uniacid=:uniacid and rank_id=:rank_id and name=:name ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':name' => $merchant_name));

			if (empty($merchant)) {
				$merchant = array('uniacid' => $_W['uniacid'], 'rank_id' => $rank['id'], 'name' => $merchant_name, 'create_uid' => $user['uid'], 'create_time' => time(), 'status' => 0, 'status_time' => time(), 'score' => 0, 'goods' => 0, 'bads' => 0);
				pdo_insert('vp_rank_merchant', $merchant);
				$merchant_id = pdo_insertid();

				if (empty($merchant_id)) {
					$this->returnError('创建商家失败，重试看看呢');
				}

			}
			 else {
				$merchant_id = $merchant['id'];
			}
		}
		 else {
			$merchant = pdo_fetch('select * from ' . tablename('vp_rank_merchant') . ' where uniacid=:uniacid and rank_id=:rank_id and id=:id ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':id' => $merchant_id));

			if (empty($merchant)) {
				$this->returnError('您选择的商家不存在，重选看看呢');
			}


			$merchant_name = $merchant['name'];
		}

		$images = $_GPC['images'];
		if (empty($images) || (count($images) == 0)) {
			return $this->returnError('请至少上传1张照片');
		}


		load()->func('file');
		$down_images = array();
		$WeiXinAccountService = WeiXinAccount::create($_W['oauth_account']);

		foreach ($images as $imgid ) {
			if (strpos($imgid, 'images/') === 0) {
				$down_images[] = $imgid;
			}
			 else {
				$ret = $WeiXinAccountService->downloadMedia(array('media_id' => $imgid, 'type' => 'image'));

				if (is_error($ret)) {
					$this->returnError('照片上传失败:' . $ret['message']);
				}


				$down_images[] = $ret;
			}
		}

		$images = iserializer($down_images);
		pdo_insert('vp_rank_feed', array('uniacid' => $_W['uniacid'], 'rank_id' => $rank['id'], 'uid' => $user['uid'], 'type' => $type, 'content' => $content, 'images' => $images, 'merchant_id' => $merchant_id, 'merchant_name' => $merchant_name, 'status' => 1, 'create_time' => time(), 'update_time' => time(), 'op' => 1));
		$feed_id = pdo_insertid();

		if (empty($feed_id)) {
			$this->returnError('发表失败，重试看看呢');
		}


		if (!empty($rank['settings']['credit_type'])) {
			$credit = (($type == 1 ? $rank['settings']['credit_award_new_good'] : $rank['settings']['credit_award_new_bad']));

			if (!empty($credit)) {
				load()->model('mc');
				mc_credit_update($user['uid'], $rank['settings']['credit_type'], $credit, array(0, '发表评价', MD_NAME));
			}

		}


		if ($type == 1) {
			pdo_query('UPDATE ' . tablename('vp_rank_merchant') . ' SET score=score+1, goods=goods+1 where uniacid=:uniacid and rank_id=:rank_id and id=:id', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':id' => $merchant_id));
		}
		 else if ($type == 2) {
			pdo_query('UPDATE ' . tablename('vp_rank_merchant') . ' SET score=score-1, bads=bads+1 where uniacid=:uniacid and rank_id=:rank_id and id=:id', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id'], ':id' => $merchant_id));
		}


		return $this->returnSuccess('发表成功', $this->createMobileUrl('index', array('rid' => pencode($rank['id']))));
	}


	if ($is_user_infoed == 0) {
		$this->doMobileLogin();
	}


	include $this->template('post');
	return 1;
}


if ($cmd == 'feeds') {
	$start = $_GPC['start'];
	if (!isset($start) || empty($start) || intval($start <= 0)) {
		$start = 0;
	}
	 else {
		$start = intval($start);
	}

	$limit = 20;
	$list = pdo_fetchall('select * from ' . tablename('vp_rank_feed') . ' where uniacid=:uniacid and rank_id=:rank_id and status=1 and op=1 ORDER BY create_time DESC limit ' . $start . ',' . $limit . ' ', array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id']));

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
				$images = preg_replace('/http:\/\/http:\/\//','http:\/\/',$images);
				$list[$i]['images'] = $images;
			}


			$list[$i]['agreers'] = (empty($list[$i]['agreers']) ? array() : explode(',', $list[$i]['agreers']));

			if (in_array($user['uid'], $list[$i]['agreers'])) {
				$list[$i]['_agreed'] = 1;
			}


			unset($list[$i]['agreers']);
			$list[$i]['disagreers'] = (empty($list[$i]['disagreers']) ? array() : explode(',', $list[$i]['disagreers']));

			if (in_array($user['uid'], $list[$i]['disagreers'])) {
				$list[$i]['_disagreed'] = 1;
			}


			unset($list[$i]['disagreers']);
			$list[$i]['_url'] = $this->createMobileUrl('feed', array('rid' => pencode($rank['id']), 'fid' => $list[$i]['id']));
			$list[$i]['_user_url'] = $this->createMobileUrl('user', array('rid' => pencode($rank['id']), 'uid' => pencode($list[$i]['uid'])));
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


if ($cmd == 'merchants') {
	$start = $_GPC['start'];
	if (!isset($start) || empty($start) || intval($start <= 0)) {
		$start = 0;
	}
	 else {
		$start = intval($start);
	}

	$search = $_GPC['search'];
	$search = trim($search);
	$where = ' where uniacid=:uniacid and rank_id=:rank_id and status=1 ';
	$params = array(':uniacid' => $_W['uniacid'], ':rank_id' => $rank['id']);

	if (!empty($search)) {
		$where .= ' and name like :search ';
		$params[':search'] = '%' . $search . '%';
	}


	$limit = 20;
	$list = pdo_fetchall('select id,name from ' . tablename('vp_rank_merchant') . ' ' . $where . '  ORDER BY create_time DESC limit ' . $start . ',' . $limit . ' ', $params);
	$more = 1;
	if (empty($list) || (count($list) < $limit)) {
		$more = 0;
	}


	$start += count($list);
	return $this->returnSuccess('', array('list' => $list, 'start' => $start, 'more' => $more));
}


if ($cmd == 'report') {
	if ($_GPC['submit'] == 'report') {
		$report = $_GPC['report'];
		if (empty($report['feed_id']) || empty($report['to_uid'])) {
			$this->returnError('请选择要举报的对象');
		}


		if (empty($report['type'])) {
			$this->returnError('请选择举报类型');
		}


		$report['uniacid'] = $_W['uniacid'];
		$report['rank_id'] = $rank['id'];
		$report['uid'] = $rank['id'];
		$report['create_time'] = time();
		$report['status'] = 1;
		pdo_insert('vp_rank_report', $report);
		$report_id = pdo_insertid();

		if (empty($report_id)) {
			$this->returnError('举报失败，重新试试看呢');
		}


		return $this->returnSuccess('举报成功，我们会尽快审核处理');
	}


	include $this->template('report');
	return 1;
}


if ($cmd == 'test') {
	include $this->template('test');
	return 1;
}


include $this->template('index');

?>