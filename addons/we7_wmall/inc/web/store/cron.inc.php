<?php
/**
 * 外送系统
 * @author TuLe wei系列
 * @QQ 97391583
 * @url http://Www.TuLe5.Com/
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
$_W['page']['title'] = '计划任务-' . $_W['we7_wmall']['config']['title'];
mload()->model('store');
$store = store_check();
$sid = $store['id'];
$do = 'cron';
$op = trim($_GPC['op']);

if($op == 'order_notice') {
	if(!$store['pc_notice_status']) {
		exit('error');
	}
	$order = pdo_fetch('SELECT id FROM ' . tablename('tiny_wmall_order') . ' WHERE uniacid = :uniacid AND sid = :sid and status = 1 ORDER BY id asc', array(':uniacid' => $_W['uniacid'], ':sid' => $sid));
	if(!empty($order)) {
		exit('success');
	}
	exit('error');
}







