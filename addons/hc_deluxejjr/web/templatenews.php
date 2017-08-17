<?php

$theone = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_templatenews') . ' WHERE  uniacid = :uniacid', array(':uniacid' => $uniacid));
if (checksubmit('submit')) {
	$insert = array('uniacid' => $uniacid, 'StatusChange' => trim($_GPC['StatusChange']), 'Commission' => trim($_GPC['Commission']), 'CreditChange' => trim($_GPC['CreditChange']), 'CustomerFP' => trim($_GPC['CustomerFP']));
	if (empty($theone)) {
		$insert['createtime'] = time();
		pdo_insert('hc_deluxejjr_templatenews', $insert);
		!pdo_insertid() ? message('保存失败, 请稍后重试.', 'error') : '';
	} else {
		if (pdo_update('hc_deluxejjr_templatenews', $insert, array('id' => $theone['id'])) === false) {
			message('更新失败, 请稍后重试.', 'error');
		}
	}
	message('更新成功！', $this->createWebUrl('templatenews'), 'success');
}
include $this->template('web/template_news');