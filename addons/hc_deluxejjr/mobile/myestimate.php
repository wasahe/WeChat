<?php

$follow = pdo_fetch('select follow from ' . tablename('mc_mapping_fans') . ' where openid = \'' . $openid . '\' and uniacid = ' . $uniacid);
if (empty($follow) || $follow['follow'] == 0) {
	message('你想知道怎么加入么?', $rule['gzurl'], 'sucessr');
	die;
}
$profile = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_member') . ' WHERE  uniacid = :uniacid  AND openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
if (intval($profile['id']) && $profile['status'] == 0) {
	include $this->template('forbidden');
	die;
}
if (empty($profile)) {
	message('请先注册', $this->createMobileUrl('register'), 'error');
	die;
}
$loupans = pdo_fetchall('SELECT id, title, tel FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid and `isview` =1 ', array(':uniacid' => $uniacid));
$pan = array();
foreach ($loupans as $k => $v) {
	$pan[$v['id']] = $v['title'];
	$tel[$v['id']] = $v['tel'];
}
$status = $this->ProcessStatus();
$statuslenth = count($status) - 1;
$cfg = $this->module['config'];
$statusprotect = count($status) - 2;
$protectdate = intval($cfg['protectdate']);
if ($protectdate) {
	$protectdate = TIMESTAMP - 3600 * 24 * $protectdate;
	$protectwhere = ' AND (updatetime > ' . $protectdate . ' OR status > ' . $statusprotect . ' )';
}
if ($op == 'display') {
	$pindex = max(1, intval($_GPC['page']));
	$psize = 15;
	$total = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE `uniacid` = :uniacid AND `openid` =:openid group by mobile ORDER BY id DESC ', array(':uniacid' => $uniacid, ':openid' => $openid));
	$pager = pagination1($total, $pindex, $psize);
	$customer = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE `uniacid` = :uniacid AND `openid` =:openid group by mobile ORDER BY id DESC limit ' . ($pindex - 1) * $psize . ',' . $psize, array(':uniacid' => $uniacid, ':openid' => $openid));
	include $this->template('myestimate_customer');
	die;
}
if ($op == 'sort') {
	$keyword = trim($_GPC['keyword']);
	if (empty($keyword)) {
		echo 0;
		die;
	}
	$customer = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE (realname like \'%' . $keyword . '%\' or mobile like \'%' . $keyword . '%\') and `uniacid` = :uniacid AND `openid` =:openid group by mobile ORDER BY id DESC', array(':uniacid' => $uniacid, ':openid' => $openid));
	if (empty($customer)) {
		echo 0;
		die;
	} else {
		foreach ($customer as &$c) {
			$c['tjurl'] = $this->createMobileurl('myestimate', array('op' => 'cusloupan', 'cid' => $c['id']));
			$c['mobile'] = empty($c['isvalid']) ? hoho($c['mobile']) : $c['mobile'];
		}
		echo json_encode($customer);
		die;
	}
}
if ($op == 'cusloupan') {
	$cid = intval($_GPC['cid']);
	if (!empty($cid)) {
		$mobile = pdo_fetchcolumn('SELECT mobile FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE id=:cid LIMIT 1', array(':cid' => $cid));
		$customer = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE `uniacid` = :uniacid AND `openid` =:openid and mobile = \'' . $mobile . '\' ORDER BY id DESC', array(':uniacid' => $uniacid, ':openid' => $openid));
	}
	include $this->template('customer_loupan');
}
if ($op == 'detail') {
	$cid = $_GET['cid'];
	if (intval($cid)) {
		$customer = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE isvalid = 1 and `uniacid` = :uniacid AND `openid` =:openid AND id=:cid LIMIT 1', array(':uniacid' => $uniacid, ':cid' => $cid, ':openid' => $openid));
		if ($customer['cid']) {
			$assistant = pdo_fetch('select mobile from ' . tablename('hc_deluxejjr_assistant') . ' where id = ' . $customer['cid']);
			$tel[$customer['loupan']] = $assistant['mobile'];
		}
	} else {
		message('你想知道怎么加入么?', $rule['gzurl'], 'sucessr');
		die;
	}
	$time_node = '';
	$time_detail = '';
	$i = 0;
	while ($i <= $statuslenth) {
		if (2 < $customer['status'] && $i == 2) {
			continue;
		}
		if ($customer['status'] == 2 && $i == 2) {
			$time_node .= '<i class="time-node"></i>';
			$time_detail .= '<li class="fn-clear"><div class="time-detail"><p class="time-event">' . $status[$i] . '</p></div></li>';
			break;
		}
		if ($i <= $customer['status']) {
			if ($i == $statuslenth) {
				$time_node .= '<i class="time-node"></i>';
			} else {
				$time_node .= '<i class="time-node"></i><span class="time-line"></span>';
			}
			$time_detail .= '<li class="fn-clear"><div class="time-detail"><p class="time-event">' . $status[$i] . '</p></div></li>';
		} else {
			if ($i == $statuslenth) {
				$time_node .= '<i class="time-node-no"></i>';
			} else {
				$time_node .= '<i class="time-node-no"></i><span class="time-line-no"></span>';
			}
			$time_detail .= '<li class="fn-clear"><div class="time-detail-no"><p class="time-event">' . $status[$i] . '</p></div></li>';
		}
		++$i;
	}
	include $this->template('myestimate_customershow');
	die;
}