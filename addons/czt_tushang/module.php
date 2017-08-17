<?php

//bbs.heirui.c n 独家解密
defined('IN_IA') || die('Access Denied');
define('MODULE_NAME', 'czt_tushang');
define('MODULE_ROOT', IA_ROOT . '/addons/' . MODULE_NAME . '/');
require MODULE_ROOT . 'global.php';
class Czt_tushangModule extends WeModule
{
	public function settingsDisplay($settings)
	{
		global $_W;
		global $_GPC;
		$path = ATTACHMENT_ROOT . '/' . MODULE_NAME . '/cert';
		if (checksubmit()) {
			if (!file_exists($path)) {
				load()->func('file');
				mkdirs($path);
			}
			if (!empty($_GPC['rootca'])) {
				file_put_contents($path . '/rootca.pem.' . $_W['uniacid'], trim($_GPC['rootca']));
			}
			if (!empty($_GPC['apiclient_key'])) {
				file_put_contents($path . '/apiclient_key.pem.' . $_W['uniacid'], trim($_GPC['apiclient_key']));
			}
			if (!empty($_GPC['apiclient_cert'])) {
				file_put_contents($path . '/apiclient_cert.pem.' . $_W['uniacid'], trim($_GPC['apiclient_cert']));
			}
			if (!empty($_GPC['qiniu']['host'])) {
				$_GPC['qiniu']['host'] = trim(rtrim($_GPC['qiniu']['host'], '/') . '/');
				$_GPC['qiniu']['host'] = substr($_GPC['qiniu']['host'], 0, 4) != 'http' ? 'http://' . $_GPC['qiniu']['host'] : $_GPC['qiniu']['host'];
			}
			$input = coll_elements(array('foot_text', 'admin_openid', 'subscribe_url', 'cash', 'notify_tpl', 'qiniu', 'wechat'), $_GPC);
			$acid = intval($_GPC['acid']);
			if (0 < $acid) {
				$_oauth = pdo_fetchcolumn('SELECT `oauth` FROM ' . tablename('uni_settings') . ' WHERE `uniacid` = :uniacid LIMIT 1', array(':uniacid' => $_W['uniacid']));
				$_oauth = iunserializer($_oauth) ? iunserializer($_oauth) : array();
				$data = array('host' => empty($_oauth['host']) ? '' : $_oauth['host'], 'account' => $acid);
				pdo_update('uni_settings', array('oauth' => iserializer($data)), array('uniacid' => $_W['uniacid']));
				cache_delete('unisetting:' . $_W['uniacid']);
				$account = pdo_fetch('SELECT `key`,`secret` FROM ' . tablename('account_wechats') . ' WHERE `acid` = :acid LIMIT 1', array(':acid' => $acid));
				$oauth = array('acid' => $acid, 'key' => $account['key'], 'secret' => $account['secret'], 'force' => 1);
			} else {
				$oauth = array('acid' => $_W['acid'], 'secret' => $_W['account']['secret'], 'key' => $_W['account']['key'], 'force' => 0);
			}
			$input['wechat']['appid'] = $oauth['key'];
			$input['oauth'] = $oauth;
			$this->saveSettings($input);
			message('保存成功', referer());
		}
		$where = '';
		$params = array();
		if (empty($_W['isfounder'])) {
			$where = ' WHERE `uniacid` IN (SELECT `uniacid` FROM ' . tablename('uni_account_users') . ' WHERE `uid`=:uid)';
			$params[':uid'] = $_W['uid'];
		}
		$sql = 'SELECT * FROM ' . tablename('uni_account') . $where;
		$uniaccounts = pdo_fetchall($sql, $params);
		$accounts = array();
		if (!empty($uniaccounts)) {
			foreach ($uniaccounts as $uniaccount) {
				$accountlist = uni_accounts($uniaccount['uniacid']);
				if (!empty($accountlist)) {
					foreach ($accountlist as $account) {
						if (!empty($account['key']) && !empty($account['secret']) && in_array($account['level'], array(4)) && $account['acid'] != $_W['acid']) {
							$accounts[$account['acid']] = $account['name'];
						}
					}
				}
			}
		}
		include $this->template('setting');
	}
}