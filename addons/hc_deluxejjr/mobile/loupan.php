<?php

$lid = $_GPC['lid'];
if ($op == 'add') {
	$logloupan = array('uniacid' => $uniacid, 'openid' => $openid, 'lid' => $lid, 'createtime' => time(), 'createtime1' => date('Y-m-d', time()));
	pdo_insert('hc_deluxejjr_logloupan', $logloupan);
	message(1, '', 'ajax');
}
if (empty($lid)) {
	message('抱歉，产品不存在或者已删除！', '', 'error');
}
$loupan = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE id = :id', array(':id' => $lid));
if (empty($loupan)) {
	message('产品不存在或是已经被删除！');
}
if (!preg_match('/^http:\\/\\/[A-Za-z0-9]+\\.[A-Za-z0-9]+[\\/=\\?%\\-&_~`@[\\]\\\':+!]*([^<>"])*$/', $loupan['music'])) {
	$loupan['music'] = $_W['attachurl'] . $loupan['music'];
}
$result['list'] = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_photo') . ' WHERE lpid = :lpid ORDER BY displayorder DESC', array(':lpid' => $loupan['id']));
foreach ($result['list'] as &$photo) {
	$photo['items'] = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_item') . ' WHERE photoid = :photoid', array(':photoid' => $photo['id']));
}
$profile = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_member') . ' WHERE  uniacid = :uniacid  AND openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
if (!empty($profile)) {
	$id = $profile['id'];
} else {
	$id = 0;
}
if (empty($loupan)) {
	message('抱歉，产品不存在或者已删除！', '', 'error');
}
$shareids = 'hc_deluxejjr_shareid' . $uniacid;
if (intval($_GPC['id'])) {
	$shareid = intval($_GPC['id']);
	setcookie($shareids, $shareid, TIMESTAMP + 3600 * 24 * 30);
}
$share_openid = '';
$shareid = intval($_COOKIE[$shareid]);
if (!empty($shareid)) {
	$share_openid = pdo_fetchcolumn('select openid from' . tablename('hc_deluxejjr_member') . 'where id =' . $shareid);
}
$log = array('uniacid' => $uniacid, 'openid' => $openid, 'share_openid' => $share_openid, 'loupan' => $lid, 'browser' => $_SERVER['HTTP_USER_AGENT'], 'ip' => getip(), 'createtime' => time(), 'createtime1' => date('Y-m-d', time()));
pdo_insert('hc_deluxejjr_log', $log);
include $this->template('loupan');