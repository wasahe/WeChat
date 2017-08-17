<?php

$follow = pdo_fetch('select follow from ' . tablename('mc_mapping_fans') . ' where openid = \'' . $openid . '\' and uniacid = ' . $uniacid);
if (empty($follow) || $follow['follow'] == 0) {
	message('关注后才能查看哦', $rule['gzurl'], 'error');
	die;
}
if ($op == 'questions') {
	$qid = intval($_GPC['qid']);
	$questions = pdo_fetchall('select * from ' . tablename('hc_deluxejjr_question') . ' where uniacid = ' . $uniacid . ' and isopen = 1 order by displayorder desc');
	include $this->template('question');
	die;
}
if ($uid) {
	$credit1 = mc_fetch($uid, array('credit1'));
}
$profile = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_member') . ' WHERE  uniacid = :uniacid AND openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
$id = $profile['id'];
if (empty($profile)) {
	message('请先注册', $this->createMobileUrl('register'), 'error');
	die;
}
if (intval($profile['id']) && $profile['status'] == 0) {
	include $this->template('forbidden');
	die;
}
if ($op == 'complain') {
	if ($_GPC['opp'] == 'post') {
		if (!empty($_GPC['complain'])) {
			$complain = array('uniacid' => $uniacid, 'mid' => $id, 'realname' => $profile['realname'], 'mobile' => $_GPC['mobile'], 'complain' => trim($_GPC['complain']), 'createtime' => time());
			pdo_insert('hc_deluxejjr_complain', $complain);
			message('感谢您的反馈', $this->createMobileUrl('my'));
		}
	}
	include $this->template('complain');
	die;
}
if ($op == 'display') {
	$identity = pdo_fetchall('SELECT id,identity_name FROM ' . tablename('hc_deluxejjr_identity') . ' WHERE `uniacid` = :uniacid ', array(':uniacid' => $uniacid));
	$identitys = array();
	foreach ($identity as $k => $v) {
		$identitys[$v['id']] = $v['identity_name'];
	}
	$allexp = pdo_fetchcolumn('select sum(exp) from ' . tablename('hc_deluxejjr_experience') . ' where uniacid = ' . $uniacid . ' and mid = ' . $profile['id']);
	$allexp = empty($allexp) ? 0 : $allexp;
	$commission = pdo_fetchcolumn('select sum(commission) from' . tablename('hc_deluxejjr_commission') . ' where ischeck = 1 and flag != 2 and mid =' . $profile['id'] . ' and uniacid =' . $uniacid);
	$comm = $commission - $profile['commission'];
}
if ($op == 'myqrcode') {
	$target_file = IA_ROOT . '/addons/hc_deluxejjr/style/poster/memberposter/' . $uniacid . 'share' . $id . '.jpg';
	$isexist = 1;
	if (!file_exists($target_file)) {
		$isexist = 0;
	}
	include $this->template('myqrcode');
	die;
}
if ($op == 'identity') {
	if ($_GPC['opp'] == 'card') {
		if (!empty($profile['identity_cardurl'])) {
			message('身份证已上传，无须再上传！');
		}
		include $this->template('identity_post');
		die;
	}
	if ($_GPC['opp'] == 'head') {
		if (!empty($profile['identity_headurl'])) {
			message('身份证背面已上传，无须再上传！');
		}
		include $this->template('identity_post');
		die;
	}
	if ($_GPC['opp'] == 'cardpost') {
		$data = array('identity_cardurl' => $_GPC['identity_url'], 'cardurltime' => time());
		if (empty($profile['identity_cardurl'])) {
			if (!empty($data['identity_cardurl'])) {
				pdo_update('hc_deluxejjr_member', $data, array('openid' => $openid, 'uniacid' => $uniacid));
				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo -1;
		}
		die;
	}
	if ($_GPC['opp'] == 'headpost') {
		$data = array('identity_headurl' => $_GPC['identity_url'], 'headurltime' => time());
		if (empty($profile['identity_headurl'])) {
			if (!empty($data['identity_headurl'])) {
				pdo_update('hc_deluxejjr_member', $data, array('openid' => $openid, 'uniacid' => $uniacid));
				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo -1;
		}
		die;
	}
	include $this->template('identity_list');
	die;
}
include $this->template('home');