<?php

$follow = pdo_fetch('select follow from ' . tablename('mc_mapping_fans') . ' where openid = \'' . $openid . '\' and uniacid = ' . $uniacid);
if (empty($follow) || $follow['follow'] == 0) {
	message('你想知道怎么加入么?', $rule['gzurl'], 'sucessr');
	die;
}
$power = intval($_GPC['power']);
$assistant = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_assistant') . ' WHERE flag != 2 and uniacid = :uniacid AND openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
$id = $assistant['id'];
if (intval($id) && $assistant['status'] == 0) {
	include $this->template('forbidden');
	die;
}
if ($op == 'display') {
	$opp = $_GPC['opp'];
	$cid = intval($_GPC['cid']);
	if ($cid) {
		$cusmatlog = pdo_fetch('select * from ' . tablename('hc_deluxejjr_cusmatlog') . ' where uniacid = ' . $uniacid . ' and cid = ' . $cid);
		$type = explode(',', $cusmatlog['type']);
		$buyreason = explode(',', $cusmatlog['buyreason']);
	}
}
if ($op == 'post') {
	$cid = intval($_GPC['cid']);
	if ($cid) {
		$age = !empty($_GPC['age']) ? intval($_GPC['age']) : message('请选择年龄！');
		$sex = !empty($_GPC['sex']) ? intval($_GPC['sex']) : message('请选择性别！');
		$types = !empty($_GPC['type']) ? $_GPC['type'] : message('请选择意向户型！');
		$type = '';
		foreach ($types as $t) {
			$type = $t . ',' . $type;
		}
		$type = trim($type, ',');
		$wantprice = !empty($_GPC['wantprice']) ? $_GPC['wantprice'] : message('请输入心理单价！');
		$allprice = !empty($_GPC['allprice']) ? $_GPC['allprice'] : message('请输入总价预算！');
		$cpf = !empty($_GPC['cpf']) ? intval($_GPC['cpf']) : message('请选择公积金！');
		$buyreasons = !empty($_GPC['buyreason']) ? $_GPC['buyreason'] : '';
		$buyreason = '';
		if (!empty($buyreasons)) {
			foreach ($buyreasons as $b) {
				$buyreason = $b . ',' . $buyreason;
			}
			$buyreason = trim($buyreason, ',');
		}
		$livecondition = !empty($_GPC['livecondition']) ? intval($_GPC['livecondition']) : '';
		$homeformation = !empty($_GPC['homeformation']) ? intval($_GPC['homeformation']) : '';
		$worknature = !empty($_GPC['worknature']) ? intval($_GPC['worknature']) : '';
		$worklevel = !empty($_GPC['worklevel']) ? intval($_GPC['worklevel']) : '';
		$cusmatlog = pdo_fetch('select * from ' . tablename('hc_deluxejjr_cusmatlog') . ' where uniacid = ' . $uniacid . ' and cid = ' . $cid);
		$cusmat = array('uniacid' => $uniacid, 'cid' => $cid, 'age' => $age, 'sex' => $sex, 'area_location_p' => $_GPC['area_location_p'], 'area_location_c' => $_GPC['area_location_c'], 'area_location_a' => $_GPC['area_location_a'], 'type' => $type, 'wantprice' => $wantprice, 'allprice' => $allprice, 'cpf' => $cpf, 'live_location_p' => $_GPC['live_location_p'], 'live_location_c' => $_GPC['live_location_c'], 'live_location_a' => $_GPC['live_location_a'], 'work_location_p' => $_GPC['work_location_p'], 'work_location_c' => $_GPC['work_location_c'], 'work_location_a' => $_GPC['work_location_a'], 'buyreason' => $buyreason, 'livecondition' => $livecondition, 'homeformation' => $homeformation, 'worknature' => $worknature, 'homeformation' => $homeformation, 'worklevel' => $worklevel);
		if (empty($cusmatlog)) {
			$cusmat['createtime'] = time();
			pdo_insert('hc_deluxejjr_cusmatlog', $cusmat);
		} else {
			pdo_update('hc_deluxejjr_cusmatlog', $cusmat, array('id' => $cusmatlog['id']));
		}
		message('提交成功！', $this->createMobileUrl('counselor', array('op' => 'detail', 'cid' => $cid, 'power' => $power)));
	}
}
include $this->template('cusmat');