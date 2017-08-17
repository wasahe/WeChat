<?php


defined('IN_IA') || exit('Access Denied');
define('STYLE_PATH', '../addons/cgc_read_secret/template/style');
define('MB_ROOT', IA_ROOT . '/addons/cgc_read_secret');
require MB_ROOT . '/inc/util.php';
require MB_ROOT . '/inc/common.php';
session_start();
class cgc_read_secretModuleSite extends WeModuleSite
{
	public function __construct()
	{
		global $_W;
		global $_GPC;
		$weid = $_W['uniacid'];
		$sql = 'SELECT `settings` FROM ' . tablename('uni_account_modules') . ' WHERE `uniacid` = :uniacid AND `module` = :module';
		$modulename = str_replace('ModuleSite', '', 'cgc_read_secretModuleSite');
		$dd_settings = pdo_fetchcolumn($sql, array(':uniacid' => $_W['uniacid'], ':module' => $modulename));
		$dd_settings = iunserializer($dd_settings);

		if (empty($dd_settings)) {
			message('请先设置参数', './index.php?c=profile&a=module&do=setting&m=' . $modulename);
		}


		$zz = pdo_fetch('select * from ' . tablename('cgc_read_secret_fee') . ' where uniacid=' . $weid);

		if (empty($zz)) {
			$sql = 'INSERT INTO ' . tablename('cgc_read_secret_fee') . '(uniacid,fee,`desc`) ' . ' VALUES(' . $weid . ',\'1\',1),(' . $weid . ',\'1.5\',1),(' . $weid . ',\'2\',1),(' . $weid . ',\'2.5 \',1),(' . $weid . ',\'3\',1)' . ',(' . $weid . ',\'3.5\',2);';
			pdo_query($sql);
		}


		if (!empty($dd_settings) && $dd_settings['debug_mode']) {
			ini_set('display_errors', '1');
			error_reporting(30719 ^ 8);
			return NULL;
		}


		error_reporting(0);
	}

	public function verify_fee($id, $payment)
	{
		$cgc_read_secret_fee = new cgc_read_secret_fee();
		$fee = $cgc_read_secret_fee->getOne($id);

		if (!empty($fee) && ($fee['fee'] == $payment)) {
			return true;
		}


		return false;
	}

	public function insert_corelog($params)
	{
		global $_W;
		$log = pdo_get('core_paylog', array('uniacid' => $_W['uniacid'], 'module' => $this->modulename, 'tid' => $params['tid']));

		if (empty($log)) {
			$log = array('uniacid' => $_W['uniacid'], 'acid' => $_W['acid'], 'openid' => $_W['member']['uid'], 'module' => $this->module['name'], 'tid' => $params['tid'], 'fee' => $params['fee'], 'card_fee' => $params['fee'], 'status' => '0', 'is_usecard' => '0');
			return pdo_insert('core_paylog', $log);
		}

	}

	public function payResult($params)
	{
		global $_W;
		$data['pay_type'] = $params['type'];
		$settings = $this->module['config'];

		if ($params['type'] == 'wechat') {
			$data['wechat_no'] = $params['tag']['transaction_id'];
		}


		if ($params['type'] == 'ys_pay') {
			$data['wechat_no'] = $params['transaction_id'];
		}


		$cgc_read_secret_record = new cgc_read_secret_record();
		$item = $cgc_read_secret_record->getOne($params['tid']);

		if (($params['result'] == 'success') && ($params['from'] == 'notify') && empty($item['pay_status'])) {
			if ($params['fee'] < $item['payment']) {
				$data['pay_status'] = 2;
				$cgc_read_secret_record->modify($item['id'], array('pay_status' => 2, 'pay_log' => '支付' . $params['fee'] . ';实际金额' . $item['payment']));
				return NULL;
			}


			$data['pay_status'] = 1;
			$cgc_read_secret_user = new cgc_read_secret_user();
			$member = $cgc_read_secret_user->selectByOpenid($item['openid']);
			$userinfo = array('pay_amount' => $member['pay_amount'] + $params['fee']);

			if (!empty($member)) {
				$cgc_read_secret_user->modify($member['id'], $userinfo);
			}


			$settings['sx_bl'] = (empty($settings['sx_bl']) ? 0 : $settings['sx_bl']);
			$sx_fee = (intval($settings['sx_bl']) / 100) * $params['fee'];
			$data['sx_fee'] = $sx_fee;
			$cgc_read_secret_record->modify($item['id'], $data);
			$secret_member = $cgc_read_secret_user->selectByOpenid($item['secret_openid']);

			if (empty($secret_member)) {
				return NULL;
			}


			$tx_money = ($secret_member['no_account_amount'] + $params['fee']) - $sx_fee;
			$settings['tx_limit'] = (empty($settings['tx_limit']) ? 0 : $settings['tx_limit']);

			if (empty($settings['tx_type']) && ($settings['tx_limit'] <= $tx_money)) {
				$settings['pay_desc'] = str_replace('#nickname#', $item['nickname'], $settings['pay_desc']);
				$ret = send_qyfk($settings, $item['secret_openid'], $tx_money);

				if ($ret['code'] == 0) {
					$userinfo = array('total_amount' => ($secret_member['total_amount'] + $params['fee']) - $sx_fee, 'amount' => $secret_member['amount'] + $tx_money, 'no_account_amount' => 0, 'sx_fee' => $secret_member['sx_fee'] + $sx_fee);
					$cgc_read_secret_user->modify($secret_member['id'], $userinfo);
				}
				 else {
					WeUtility::logging('cgc_read_secret tx_type', $ret);
					$cgc_read_secret_record->modify($item['id'], array('pay_log' => $ret['message']));
					$userinfo = array('total_amount' => ($secret_member['total_amount'] + $params['fee']) - $sx_fee, 'no_account_amount' => $tx_money, 'sx_fee' => $secret_member['sx_fee'] + $sx_fee);
					$cgc_read_secret_user->modify($secret_member['id'], $userinfo);
				}
			}
			 else {
				$userinfo = array('total_amount' => ($secret_member['total_amount'] + $params['fee']) - $sx_fee, 'no_account_amount' => $tx_money, 'sx_fee' => $secret_member['sx_fee'] + $sx_fee);
				$cgc_read_secret_user->modify($secret_member['id'], $userinfo);
			}
		}


		if (($params['from'] == 'return') || (($params['sync'] == true) && ($params['type'] == 'yun_pay'))) {
			if ($params['result'] == 'success') {
				$type = 'success';
				$msg = '支付成功！';
				$redirect = '../../app/' . $this->createMobileUrl('payafter', array('secretid' => $item['secret_id']));
			}
			 else {
				$type = 'warn';
				$msg = '支付失败！';
				$redirect = '../../app/' . $this->createMobileUrl('pay', array('secretid' => $item['secret_id']));
			}

			$this->messageNew($msg, $redirect, $type);
		}

	}

	public function messageNew($msg, $redirect, $type = 'info')
	{
		global $_W;
		$styleroot = getSiteRoot($_W['siteroot']) . '/addons/cgc_read_secret/template/style';
		include $this->template('messageNew');
		exit();
	}

	public function insert_member($userinfo)
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		$cgc_read_secret_user = new cgc_read_secret_user();
		$data = array('uniacid' => $_W['uniacid'], 'headimgurl' => $userinfo['headimgurl'], 'openid' => $userinfo['openid'], 'nickname' => $userinfo['nickname'], 'pay_amount' => $userinfo['payment'], 'friend_headimgurl' => $userinfo['friend_headimgurl'], 'friend_openid' => $userinfo['friend_openid'], 'friend_nickname' => $userinfo['friend_nickname'], 'createtime' => time());
		return $cgc_read_secret_user->insert($data);
	}

	public function get_member($scode = 'snsapi_userinfo')
	{
		global $_W;
		global $_GPC;
		$uniacid = $_W['uniacid'];
		$settings = $this->module['config'];
		$scode = 'snsapi_userinfo';
		$userinfo = getFromUser($settings, $this->modulename);
		$userinfo = json_decode($userinfo, true);
		WeUtility::logging('$userinfo', $userinfo);
		$from_user = $userinfo['openid'];
		$member = pdo_fetch('SELECT * FROM ' . tablename('cgc_read_secret_user') . ' WHERE uniacid=' . $uniacid . ' and openid=\'' . $from_user . '\'');

		if (empty($member)) {
			$data = array('uniacid' => $uniacid, 'openid' => $userinfo['openid'], 'nickname' => $userinfo['nickname'], 'headimgurl' => $userinfo['headimgurl'], 'createtime' => TIMESTAMP);
			pdo_insert('cgc_read_secret_user', $data);
			$member = pdo_fetch('SELECT * FROM ' . tablename('cgc_read_secret_user') . ' WHERE uniacid=' . $uniacid . ' and openid=\'' . $userinfo['openid'] . '\'');
		}
		 else if (empty($member['nickname'])) {
			$data = array('uniacid' => $uniacid, 'openid' => $userinfo['openid'], 'nickname' => $userinfo['nickname'], 'headimgurl' => $userinfo['headimgurl'], 'createtime' => TIMESTAMP);
			pdo_update('cgc_read_secret_user', $data, array('id' => $member['id']));
			$member = pdo_fetch('SELECT * FROM ' . tablename('cgc_read_secret_user') . ' WHERE uniacid=' . $uniacid . ' and openid=\'' . $userinfo['openid'] . '\'');
		}


		if (empty($member)) {
			message('生成会员失败');
			exit();
		}


		return $member;
	}
}


?>