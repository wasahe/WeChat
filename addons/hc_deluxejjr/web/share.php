<?php

$theone = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_rule') . ' WHERE  uniacid = :uniacid', array(':uniacid' => $uniacid));
if (checksubmit('submit')) {
	$insert = array('uniacid' => $uniacid, 'share_title' => trim($_GPC['share_title']), 'share_thumb' => trim($_GPC['share_thumb']), 'share_content' => trim($_GPC['share_content']));
	if (empty($theone)) {
		$insert['createtime'] = time();
		pdo_insert('hc_deluxejjr_rule', $insert);
		!pdo_insertid() ? message('保存失败, 请稍后重试.', 'error') : '';
	} else {
		if (pdo_update('hc_deluxejjr_rule', $insert, array('id' => $theone['id'])) === false) {
			message('更新失败, 请稍后重试.', 'error');
		}
	}
	message('更新成功！', $this->createWebUrl('share'), 'success');
}
include $this->template('web/share');