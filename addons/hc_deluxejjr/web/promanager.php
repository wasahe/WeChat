<?php

if ($op == 'list') {
	$list = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_promanager') . ' WHERE `uniacid` = :uniacid ORDER BY listorder DESC', array(':uniacid' => $uniacid));
	if (checksubmit('submit')) {
		foreach ($_GPC['listorder'] as $key => $val) {
			pdo_update('hc_deluxejjr_promanager', array('listorder' => intval($val)), array('id' => intval($key)));
		}
		message('更新经理排序成功！', $this->createWebUrl('promanager', array('op' => 'list')), 'success');
	}
	include $this->template('web/promanager_list');
}
if ($op == 'post') {
	$id = intval($_GPC['id']);
	if (0 < $id) {
		$theone = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_promanager') . ' WHERE  uniacid = :uniacid  AND id = :id', array(':uniacid' => $uniacid, ':id' => $id));
		$theone['loupanid'] = explode(',', $theone['loupanid']);
	} else {
		$theone = array('status' => 1, 'listorder' => 0);
	}
	if (checksubmit('submit')) {
		$code = trim($_GPC['code']) ? trim($_GPC['code']) : message('请填写邀请码！');
		$code1 = trim($_GPC['code1']);
		if (0 < $id) {
			if ($code === $code1) {
			} else {
				$codes = pdo_fetchall('select code from' . tablename('hc_deluxejjr_promanager') . 'where uniacid =' . $uniacid);
				foreach ($codes as $c) {
					if ($code === $c['code']) {
						message('已存在该邀请码请重新填写！');
					}
				}
			}
		} else {
			$codes = pdo_fetchall('select code from' . tablename('hc_deluxejjr_promanager') . 'where uniacid =' . $uniacid);
			foreach ($codes as $c) {
				if ($code === $c['code']) {
					message('已存在该邀请码请重新填写！');
				}
			}
		}
		$listorder = intval($_GPC['listorder']);
		$status = intval($_GPC['status']);
		$loupanid = $_GPC['loupanid'];
		$loupanid = explode(',', $loupanid);
		foreach ($loupanid as $key => $l) {
			if ($l == NULL) {
				unset($loupanid[$key]);
			}
		}
		$loupanid = implode(',', $loupanid);
		$insert = array('uniacid' => $uniacid, 'code' => $code, 'listorder' => $listorder, 'status' => $status, 'content' => trim($_GPC['content']), 'loupanid' => $loupanid, 'createtime' => TIMESTAMP);
		if (empty($id)) {
			pdo_insert('hc_deluxejjr_promanager', $insert);
			!pdo_insertid() ? message('保存经理数据失败, 请稍后重试.', 'error') : '';
		} else {
			if (pdo_update('hc_deluxejjr_promanager', $insert, array('id' => $id)) === false) {
				message('更新经理数据失败, 请稍后重试.', 'error');
			}
		}
		message('更新经理数据成功！', $this->createWebUrl('promanager', array('op' => 'list')), 'success');
	}
	$loupan = pdo_fetchall('SELECT id,title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid and `isview` =1 ', array(':uniacid' => $uniacid));
	$loupans = array();
	foreach ($loupan as $k => $v) {
		$loupans[$v['title']] = $v['id'];
	}
	include $this->template('web/promanager_post');
}
if ($op == 'del') {
	$temp = pdo_delete('hc_deluxejjr_promanager', array('id' => $_GPC['id']));
	if (empty($temp)) {
		message('删除数据失败！', $this->createWebUrl('promanager', array('op' => 'list')), 'error');
	} else {
		message('删除数据成功！', $this->createWebUrl('promanager', array('op' => 'list')), 'success');
	}
}
if ($op == 'randomcode') {
	$num = trim($_GPC['num']) ? trim($_GPC['num']) - 2 : 7;
	$num = intval($num);
	$randomcode = 'PR' . random($num, true);
	$code = pdo_fetchall('select code from' . tablename('hc_deluxejjr_promanager') . 'where uniacid =' . $uniacid);
	if (0 < sizeof($code)) {
		$i = 0;
		while ($i < sizeof($code)) {
			if ($randomcode === $code[$i]['code']) {
				$randomcode = 'PR' . random($num, true);
				$i = -1;
			}
			++$i;
		}
	}
	message($randomcode, '', 'ajax');
}
if ($op == 'promanagerlist') {
	include $this->template('web/promanager_list');
}