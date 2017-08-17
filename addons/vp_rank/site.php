<?php

defined('IN_IA') || exit('Access Denied');
define('MD_NAME', 'vp_rank');
define('MD_ROOT', IA_ROOT . '/addons/' . MD_NAME);
define('VP_RANK_BRANCH', 'A');
require MD_ROOT . '/source/common/common.func.php';
class Vp_rankModuleSite extends WeModuleSite
{
	public $_user;
	public $_is_user_infoed = 0;
	public $_cmd;
	public $_mine;

	public function __construct()
	{
		global $_GPC;
		global $_W;
		load()->model('module');
		$module = module_fetch(MD_NAME);

		if (empty($module['config'])) {
			return returnError('应用尚未配置');
		}


		$_W['module_setting'] = $module['config'];
		$_W['setting']['remote']['type'] = '3';
		$_W['setting']['remote']['qiniu']['accesskey'] = $_W['module_setting']['qn_ak'];
		$_W['setting']['remote']['qiniu']['secretkey'] = $_W['module_setting']['qn_sk'];
		$_W['setting']['remote']['qiniu']['bucket'] = $_W['module_setting']['qn_bucket'];
	}

	protected function _doMobileAuth()
	{
		global $_GPC;
		global $_W;

		if ($_W['container'] != 'wechat') {
			return $this->returnError('应用目前仅支持在微信中访问', '', 'error');
		}


		if (!isset($_SESSION['uid']) || empty($_SESSION['uid'])) {
			if (intval($_W['account']['level']) != 4) {
				if (empty($_W['oauth_account'])) {
					return message('该公众号无微信授权能力，请联系公众号管理员', '', 'error');
				}


				if ($_W['oauth_account']['level'] != 4) {
					return message('微信授权能力获取失败，请联系公众号管理员', '', 'error');
				}

			}


			if (empty($_SESSION['oauth_openid'])) {
				return message('微信授权失败，请重试', '', 'error');
			}


			$getUserInfo = false;
			$accObj = WeiXinAccount::create($_W['oauth_account']);
			$userinfo = $accObj->fansQueryInfo($_SESSION['oauth_openid']);

			if (!is_error($userinfo) && !empty($userinfo) && is_array($userinfo) && !empty($userinfo['subscribe'])) {
				if (empty($userinfo['nickname'])) {
					return message('获取个人信息失败，请重试', '', 'error');
				}


				$getUserInfo = true;
				$userinfo['nickname'] = stripcslashes($userinfo['nickname']);
				$userinfo['avatar'] = $userinfo['headimgurl'];
				unset($userinfo['headimgurl']);
				$_SESSION['userinfo'] = base64_encode(iserializer($userinfo));
			}


			$default_groupid = pdo_fetchcolumn('SELECT groupid FROM ' . tablename('mc_groups') . ' WHERE uniacid = :uniacid AND isdefault = 1', array(':uniacid' => $_W['uniacid']));
			$data = array('uniacid' => $_W['uniacid'], 'email' => md5($_SESSION['oauth_openid']) . '@we7.cc', 'salt' => random(8), 'groupid' => $default_groupid, 'createtime' => TIMESTAMP, 'password' => md5($message['from'] . $data['salt'] . $_W['config']['setting']['authkey']));

			if (true === $getUserInfo) {
				$data['nickname'] = stripslashes($userinfo['nickname']);
				$data['avatar'] = rtrim($userinfo['avatar'], '0') . 132;
				$data['gender'] = $userinfo['sex'];
				$data['nationality'] = $userinfo['country'];
				$data['resideprovince'] = $userinfo['province'] . '省';
				$data['residecity'] = $userinfo['city'] . '市';
			}


			$uid = pdo_fetchcolumn('SELECT uid FROM ' . tablename('mc_members') . ' WHERE uniacid = :uniacid AND email = :email ', array(':uniacid' => $_W['uniacid'], ':email' => $data['email']));
			if (!$uid || empty($uid) || ($uid <= 0)) {
				pdo_insert('mc_members', $data);
				$uid = pdo_insertid();
			}


			$_SESSION['uid'] = $uid;
			$fan = mc_fansinfo($_SESSION['oauth_openid']);

			if (empty($fan)) {
				$fan = array('openid' => $_SESSION['oauth_openid'], 'uid' => $uid, 'acid' => $_W['acid'], 'uniacid' => $_W['uniacid'], 'salt' => random(8), 'updatetime' => TIMESTAMP, 'follow' => 0, 'followtime' => 0, 'unfollowtime' => 0);

				if (true === $getUserInfo) {
					$fan['nickname'] = $data['nickname'];
					$fan['follow'] = $userinfo['subscribe'];
					$fan['followtime'] = $userinfo['subscribe_time'];
					$fan['tag'] = base64_encode(iserializer($userinfo));
				}


				pdo_insert('mc_mapping_fans', $fan);
			}
			 else {
				$fan['uid'] = $uid;
				$fan['updatetime'] = TIMESTAMP;
				unset($fan['tag']);

				if (true === $getUserInfo) {
					$fan['nickname'] = $data['nickname'];
					$fan['follow'] = $userinfo['subscribe'];
					$fan['followtime'] = $userinfo['subscribe_time'];
					$fan['tag'] = base64_encode(iserializer($userinfo));
				}


				unset($fan['sex']);
				pdo_update('mc_mapping_fans', $fan, array('openid' => $_SESSION['oauth_openid'], 'acid' => $_W['acid'], 'uniacid' => $_W['uniacid']));
			}

			$_W['fans'] = $fan;
			$_W['fans']['from_user'] = $_SESSION['oauth_openid'];

			if (intval($_W['account']['level']) != 4) {
				$mc_oauth_fan = _mc_oauth_fans($_SESSION['oauth_openid'], $_W['acid']);

				if (empty($mc_oauth_fan)) {
					$data = array('acid' => $_W['acid'], 'oauth_openid' => $_SESSION['oauth_openid'], 'uid' => $uid, 'openid' => $_SESSION['openid']);
					pdo_insert('mc_oauth_fans', $data);
				}
				 else {
					if (!empty($mc_oauth_fan['uid'])) {
						$_SESSION['uid'] = intval($mc_oauth_fan['uid']);
					}


					if (empty($_SESSION['openid']) && !empty($mc_oauth_fan['openid'])) {
						$_SESSION['openid'] = strval($mc_oauth_fan['openid']);
					}

				}
			}
			 else {
				$_SESSION['openid'] = $_SESSION['oauth_openid'];
			}

			header('Location: ' . $_W['siteroot'] . 'app/index.php?' . $_SERVER['QUERY_STRING']);
		}


		load()->model('mc');
		$this->_user = mc_fetch($_SESSION['uid'], array('email', 'mobile', 'nickname', 'gender', 'avatar', 'credit1', 'credit2', 'credit3', 'credit4', 'credit5'));

		if (empty($this->_user)) {
			if (intval($_W['account']['level']) != 4) {
				pdo_delete('mc_oauth_fans', array('acid' => $_W['acid'], 'uid' => $_SESSION['uid']));
			}


			unset($_SESSION['uid']);
			header('Location: ' . $_W['siteroot'] . 'app/index.php?' . $_SERVER['QUERY_STRING']);
			exit();
		}


		if (!empty($this->_user['nickname']) || !empty($this->_user['avatar'])) {
			$this->_is_user_infoed = 1;
		}

	}

	protected function _doMobileInitialize()
	{
		global $_GPC;
		global $_W;
		global $do;
		$this->_cmd = $_GPC['cmd'];
		$rid = $_GPC['rid'];

		if (empty($rid)) {
			$this->returnError('朋友，迷路了吧');
		}


		$rid = pdecode($rid);

		if (empty($rid)) {
			$this->returnError('朋友，走错路了吧');
		}


		$rid = intval($rid);

		if ($rid <= 0) {
			$this->returnError('你是逗逼请来的黑客吗？');
		}


		$this->_rank = $this->getRank($rid);

		if (empty($this->_rank)) {
			$this->returnError('圈子不见了...');
		}


		$this->_mine = pdo_fetch('select * from ' . tablename('vp_rank_user') . ' where uniacid=:uniacid and uid=:uid ', array(':uniacid' => $_W['uniacid'], ':uid' => $this->_user['uid']));
		$doors = array('play');

		if (!$_W['isajax'] && (empty($this->_cmd) || in_array($this->_cmd, $doors))) {
			if (empty($this->_mine)) {
				load()->model('mc');
				$fan = mc_fansinfo($this->_user['uid'], $_W['acid'], $_W['uniacid']);
				$mine = array();
				$mine['uniacid'] = $_W['uniacid'];
				$mine['rank_id'] = $this->_rank['id'];
				$mine['uid'] = $this->_user['uid'];

				if (!empty($this->_user['nickname'])) {
					$mine['nickname'] = $this->_user['nickname'];
				}


				if (!empty($this->_user['avatar'])) {
					$mine['avatar'] = $this->_user['avatar'];
				}


				$mine['followed'] = (!empty($fan) && ($fan['follow'] == 1) ? 1 : 0);

				$mine['follow'] = (!empty($fan) && ($fan['follow'] == 1) ? 1 : 0);
				$mine['create_time'] = time();
				pdo_insert('vp_rank_user', $mine);
				$mine_id = pdo_insertid();

				if (0 < $mine_id) {
					$this->_mine = $mine;
					$this->_mine['id'] = $mine_id;
				}

			}
			 else if ($this->_mine['follow'] == -1) {
				load()->model('mc');
				$fan = mc_fansinfo($this->_user['uid'], $_W['acid'], $_W['uniacid']);

				$this->_mine['follow'] = (!empty($fan) && ($fan['follow'] == 1) ? 1 : 0);
				pdo_query('UPDATE ' . tablename('vp_rank_user') . ' SET follow=:follow where uniacid=:uniacid and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $this->_mine['id'], ':follow' => $this->_mine['follow']));
			}

		}


		if (empty($this->_mine)) {
			$this->returnError('请从正常入口访问');
		}


		if ($this->_mine['black'] == 1) {
			$this->returnError('您暂时无法访问，原因：' . $this->_mine['black_why']);
		}


		if ((empty($this->_mine['nickname']) && !empty($this->_user['nickname'])) || (empty($this->_mine['avatar']) && !empty($this->_user['avatar']))) {
			$this->_mine['nickname'] = $this->_user['nickname'];
			$this->_mine['avatar'] = $this->_user['avatar'];
			pdo_query('UPDATE ' . tablename('vp_rank_user') . ' SET nickname=:nickname,avatar=:avatar where uniacid=:uniacid and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $this->_mine['id'], ':nickname' => $this->_user['nickname'], ':avatar' => $this->_user['avatar']));
		}

	}

	public function doMobileLogin()
	{
		global $_GPC;
		global $_W;

		if (empty($_SESSION['login_referer'])) {
			$_SESSION['login_referer'] = $_SERVER['HTTP_REFERER'];
		}


		if ($_W['container'] == 'wechat') {
			$userinfo = mc_oauth_userinfo();

			if (is_error($userinfo)) {
				unset($_SESSION['login_referer']);
				return message($userinfo['message'], '', 'error');
			}


			if (empty($userinfo) || !is_array($userinfo)) {
				unset($_SESSION['login_referer']);
				return message('微信自动登录失败，请重试', '', 'error');
			}


			$login_referer = $_SESSION['login_referer'];
			unset($_SESSION['login_referer']);
			header('Location: ' . $login_referer);
			exit();
		}
		 else {
			unset($_SESSION['login_referer']);
			return message('该应用仅支持在微信中运行', '', 'error');
		}

		unset($_SESSION['login_referer']);
		return message('该应用目前仅支持在微信中访问', '', 'error');
	}

	protected function vp_users($uids, $fields)
	{
		global $_W;

		if (empty($uids)) {
			return NULL;
		}


		if (is_array($uids)) {
			if (count($uids) == 0) {
				return array();
			}


			return pdo_fetchall('select ' . $fields . ' from ' . tablename('vp_rank_user') . ' where uniacid=:uniacid  AND uid IN(' . implode(',', $uids) . ') ', array(':uniacid' => $_W['uniacid']), 'uid');
		}


		return pdo_fetch('select ' . $fields . ' from ' . tablename('vp_rank_user') . ' where uniacid=:uniacid  AND uid=:uid ', array(':uniacid' => $_W['uniacid'], ':uid' => $uids));
	}

	public function doMobileReset()
	{
		global $_GPC;
		global $_W;
		session_unset();
		message('已清空');
	}

	public function doMobileQr()
	{
		global $_GPC;
		$raw = @base64_decode($_GPC['raw']);

		if (!empty($raw)) {
			include MD_ROOT . '/source/common/phpqrcode.php';
			QRcode::png($raw, false, QR_ECLEVEL_Q, 4);
		}

	}

	public function doWebQr()
	{
		global $_GPC;
		$raw = @base64_decode($_GPC['raw']);

		if (!empty($raw)) {
			include MD_ROOT . '/source/common/phpqrcode.php';
			QRcode::png($raw, false, QR_ECLEVEL_Q, 4);
		}

	}

	protected function getRank($id)
	{
		global $_W;
		$rank_cache_key = 'vap_rank:' . $id;
		$rank = cache_load($rank_cache_key);

		if (empty($rank)) {
			$rank = pdo_fetch('select * from ' . tablename('vp_rank') . ' where uniacid=:uniacid and id=:id ', array(':uniacid' => $_W['uniacid'], ':id' => $id));

			if (empty($rank)) {
				return NULL;
			}


			$rank['settings'] = (empty($rank['settings']) ? array() : iunserializer($rank['settings']));
			$rank['settings']['award_values'] = explode(',', $rank['settings']['award_values']);
			$rank['menus'] = (empty($rank['menus']) ? array() : iunserializer($rank['menus']));
			$rank['authoritys'] = (empty($rank['authoritys']) ? array() : iunserializer($rank['authoritys']));
			$i = 0;

			while ($i < count($rank['authoritys'])) {
				$rank['authoritys'][$i]['flag'] = tomedia($rank['authoritys'][$i]['flag']);
				++$i;
			}

			cache_write($rank_cache_key, $rank);
		}


		return $rank;
	}

	protected function returnMessage($msg, $redirect = '', $type = '')
	{
		global $_W;
		global $_GPC;

		if ($redirect == 'refresh') {
			$redirect = $_W['script_name'] . '?' . $_SERVER['QUERY_STRING'];
		}


		if ($redirect == 'referer') {
			$redirect = referer();
		}


		if ($redirect == '') {
			$type = ((in_array($type, array('success', 'error', 'info', 'warn')) ? $type : 'info'));
		}
		 else {
			$type = ((in_array($type, array('success', 'error', 'info', 'warn')) ? $type : 'success'));
		}

		if (empty($msg) && !empty($redirect)) {
			header('location: ' . $redirect);
		}


		$label = $type;

		if ($type == 'error') {
			$label = 'warn';
		}


		include $this->template('inc/message');
		exit();
	}

	protected function returnError($message, $data = '', $status = 0, $type = '')
	{
		global $_W;
		if ($_W['isajax'] || ($type == 'ajax')) {
			header('Content-Type:application/json; charset=utf-8');
			$ret = array('status' => $status, 'info' => $message, 'data' => $data);
			exit(json_encode($ret));
			return NULL;
		}


		return $this->returnMessage($message, $data, 'error');
	}

	protected function returnSuccess($message, $data = '', $status = 1, $type = '')
	{
		global $_W;
		if ($_W['isajax'] || ($type == 'ajax')) {
			header('Content-Type:application/json; charset=utf-8');
			$ret = array('status' => $status, 'info' => $message, 'data' => $data);
			exit(json_encode($ret));
			return NULL;
		}


		return $this->returnMessage($message, $data, 'success');
	}

	protected function payReady($params = array(), $mine = array())
	{
		global $_W;
		$params['module'] = $this->module['name'];
		$sql = 'SELECT * FROM ' . tablename('core_paylog') . ' WHERE `uniacid`=:uniacid AND `module`=:module AND `tid`=:tid';
		$pars = array();
		$pars[':uniacid'] = $_W['uniacid'];
		$pars[':module'] = $params['module'];
		$pars[':tid'] = $params['tid'];
		$log = pdo_fetch($sql, $pars);

		if (empty($log)) {
			$log = array('uniacid' => $_W['uniacid'], 'acid' => $_W['acid'], 'openid' => $_W['member']['uid'], 'module' => $this->module['name'], 'tid' => $params['tid'], 'fee' => $params['fee'], 'card_fee' => $params['fee'], 'status' => '0', 'is_usecard' => '0');
			pdo_insert('core_paylog', $log);
		}


		if ($log['status'] == '1') {
			message('这个订单已经支付成功, 不需要重复支付.');
		}


		return $params;
	}

	public function payResult($params)
	{
		global $_W;
		$order = pdo_fetch('select * from ' . tablename('vp_rank_order') . ' where id=:id ', array(':id' => $params['tid']));
		$rank = $this->getRank($order['rank_id']);

		if (($params['result'] == 'success') && ($params['from'] == 'notify')) {
			if (empty($order)) {
				exit();
			}


			if ((intval($order['fee']) < 1) || (round($order['fee']) != round(floatval($params['fee']) * 100))) {
				exit();
			}


			$order['detail'] = iunserializer($order['detail']);
			pdo_query('UPDATE ' . tablename('vp_rank_order') . ' SET status=2,pay=:pay,pay_time=:pay_time where id=:id', array(':id' => $order['id'], ':pay' => round(floatval($params['fee']) * 100), ':pay_time' => time()));

			if ($order['biz'] == 'award') {
				$ret = pdo_query('UPDATE ' . tablename('vp_rank_user') . ' SET income=income+:income, money=money+:money where uniacid=:uniacid and rank_id=:rank_id and uid=:uid', array(':income' => floatval($params['fee']) * 100, ':money' => floatval($params['fee']) * 100, ':uniacid' => $order['uniacid'], ':rank_id' => $order['rank_id'], ':uid' => $order['biz_id']));

				if (empty($ret)) {
					exit();
				}


				pdo_insert('vp_rank_ward', array('uniacid' => $_W['uniacid'], 'rank_id' => $order['rank_id'], 'uid' => $order['uid'], 'nickname' => $order['detail']['nickname'], 'avatar' => $order['detail']['avatar'], 'ward_uid' => $order['biz_id'], 'feed_id' => $order['detail']['feed_id'], 'reply_id' => 0, 'money' => floatval($params['fee']) * 100, 'create_time' => time()));

				if (!empty($rank['settings']['notice_ward'])) {
					$openid = pdo_fetchcolumn('select openid from ' . tablename('mc_mapping_fans') . '  where uniacid=:uniacid and uid=:uid and follow=1 ', array(':uniacid' => $_W['uniacid'], ':uid' => $order['biz_id']));

					if (!empty($openid)) {
						$postdata = array(
							'first'    => array('value' => '您发表的内容被打赏啦！', 'color' => '#576b95'),
							'keyword1' => array('value' => $params['fee'] . '元', 'color' => '#576b95'),
							'keyword2' => array('value' => date('y-m-d h:i:s', time()), 'color' => '#576b95'),
							'keyword3' => array('value' => '打赏', 'color' => '#576b95'),
							'keyword4' => array('value' => '点击查看', 'color' => '#576b95'),
							'remark'   => array('value' => '来自' . $rank['name'], 'color' => '#999999')
							);
						$accObj = WeiXinAccount::create($_W['oauth_account']);
						$accObj->sendTplNotice($openid, $rank['settings']['notice_ward'], $postdata, $order['detail']['url'], '#FF5454');
					}

				}

			}
			 else if ($order['biz'] == 'reward') {
				$ret = pdo_query('UPDATE ' . tablename('vp_rank_user') . ' SET income=income+:income, money=money+:money where uniacid=:uniacid and rank_id=:rank_id and uid=:uid', array(':income' => floatval($params['fee']) * 100, ':money' => floatval($params['fee']) * 100, ':uniacid' => $order['uniacid'], ':rank_id' => $order['rank_id'], ':uid' => $order['biz_id']));

				if (empty($ret)) {
					exit();
				}


				pdo_insert('vp_rank_ward', array('uniacid' => $_W['uniacid'], 'rank_id' => $order['rank_id'], 'uid' => $order['uid'], 'nickname' => $order['detail']['nickname'], 'avatar' => $order['detail']['avatar'], 'ward_uid' => $order['biz_id'], 'feed_id' => $order['detail']['feed_id'], 'reply_id' => $order['detail']['reply_id'], 'money' => floatval($params['fee']) * 100, 'create_time' => time()));

				if (!empty($rank['settings']['notice_ward'])) {
					$openid = pdo_fetchcolumn('select openid from ' . tablename('mc_mapping_fans') . '  where uniacid=:uniacid and uid=:uid and follow=1 ', array(':uniacid' => $_W['uniacid'], ':uid' => $order['biz_id']));

					if (!empty($openid)) {
						$postdata = array(
							'first'    => array('value' => '您的回复被打赏啦！', 'color' => '#576b95'),
							'keyword1' => array('value' => $params['fee'] . '元', 'color' => '#576b95'),
							'keyword2' => array('value' => date('y-m-d h:i:s', time()), 'color' => '#576b95'),
							'keyword3' => array('value' => '打赏', 'color' => '#576b95'),
							'keyword4' => array('value' => '点击查看', 'color' => '#576b95'),
							'remark'   => array('value' => '来自' . $rank['name'], 'color' => '#999999')
							);
						$accObj = WeiXinAccount::create($_W['oauth_account']);
						$accObj->sendTplNotice($openid, $rank['settings']['notice_ward'], $postdata, $order['detail']['url'], '#FF5454');
					}

				}

			}


			pdo_query('UPDATE ' . tablename('vp_rank_order') . ' SET status=3 where id=:id', array(':id' => $order['id']));
		}


		if ($params['from'] == 'return') {
			if (empty($order)) {
				$this->returnError('支付失败，订单错误');
			}


			if ((intval($order['fee']) < 1) || (round($order['fee']) != round(floatval($params['fee']) * 100))) {
				$this->returnError('支付金额不符【' . $order['fee'] . '】【' . $params['fee'] . '】！');
			}


			$order['detail'] = iunserializer($order['detail']);

			if ($params['result'] == 'success') {
				if ($order['biz'] == 'award') {
					header('Location:' . $order['detail']['url']);
					exit();
					return NULL;
				}


				if ($order['biz'] == 'reward') {
					header('Location:' . $order['detail']['url']);
					exit();
					return NULL;
				}

			}
			 else {
				$this->returnError('支付失败！');
			}
		}

	}

	protected function transferByRedpack($transfer)
	{
		global $_W;
		$api = array('mchid' => $_W['module_setting']['mchid'], 'appid' => $_W['module_setting']['appid'], 'ip' => $_W['module_setting']['ip'], 'key' => $_W['module_setting']['key']);
		$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
		load()->func('communication');
		$pars = array();
		$pars['nonce_str'] = random(32);
		$pars['mch_billno'] = $api['mchid'] . date('Ymd') . $transfer['id'];
		$pars['mch_id'] = $api['mchid'];
		$pars['wxappid'] = $api['appid'];
		$pars['nick_name'] = $transfer['nick_name'];
		$pars['send_name'] = $transfer['send_name'];
		$pars['re_openid'] = (empty($transfer['openid']) ? $_W['openid'] : $transfer['openid']);
		$pars['total_amount'] = $transfer['money'];
		$pars['min_value'] = $transfer['money'];
		$pars['max_value'] = $transfer['money'];
		$pars['total_num'] = 1;
		$pars['wishing'] = $transfer['wishing'];
		$pars['client_ip'] = $api['ip'];
		$pars['act_name'] = $transfer['act_name'];
		$pars['remark'] = $transfer['remark'];
		ksort($pars, SORT_STRING);
		$string1 = '';

		foreach ($pars as $k => $v ) {
			$string1 .= $k . '=' . $v . '&';
		}

		$string1 .= 'key=' . $api['key'];
		$pars['sign'] = strtoupper(md5($string1));
		$xml = array2xml($pars);
		$extras = array();
		$extras['CURLOPT_CAINFO'] = ATTACHMENT_ROOT . '/' . $_W['module_setting']['cert_rootca']['path'];
		$extras['CURLOPT_SSLCERT'] = ATTACHMENT_ROOT . '/' . $_W['module_setting']['cert_cert']['path'];
		$extras['CURLOPT_SSLKEY'] = ATTACHMENT_ROOT . '/' . $_W['module_setting']['cert_key']['path'];
		$procResult = NULL;
		$resp = ihttp_request($url, $xml, $extras);

		if (is_error($resp)) {
			return $resp;
		}


		$xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
		$dom = new DOMDocument();

		if ($dom->loadXML($xml)) {
			$xpath = new DOMXPath($dom);
			$code = $xpath->evaluate('string(//xml/return_code)');
			$ret = $xpath->evaluate('string(//xml/result_code)');

			if ((strtolower($code) == 'success') && (strtolower($ret) == 'success')) {
				$mch_billno = $xpath->evaluate('string(//xml/mch_billno)');
				$out_billno = $xpath->evaluate('string(//xml/send_listid)');
				$out_money = $xpath->evaluate('string(//xml/total_amount)');
				$procResult = array('mch_billno' => $mch_billno, 'out_billno' => $out_billno, 'out_money' => $out_money, 'tag' => iserializer($resp));
			}
			 else {
				$error = $xpath->evaluate('string(//xml/err_code_des)');
				$procResult = error(-2, $error);
			}
		}
		 else {
			$procResult = error(-1, 'error response');
		}

		return $procResult;
	}
}

function getTopDomainhuo()
{
	$host = $_SERVER['HTTP_HOST'];
	$host = strtolower($host);

	if (strpos($host, '/') !== false) {
		$parse = @parse_url($host);
		$host = $parse['host'];
	}


	$topleveldomaindb = array('com', 'edu', 'gov', 'int', 'mil', 'net', 'org', 'biz', 'info', 'top', 'wang', 'pro', 'so', 'name', 'in', 'museum', 'coop', 'aero', 'xxx', 'idv', 'mobi', 'cc', 'me', 'co', 'asia');
	$str = '';

	foreach ($topleveldomaindb as $v ) {
		$str .= (($str ? '|' : '')) . $v;
	}

	$matchstr = '[^\\.]+\\.(?:(' . $str . ')|\\w{2}|((' . $str . ')\\.\\w{2}))$';

	if (preg_match('/' . $matchstr . '/ies', $host, $matchs)) {
		$domain = $matchs[0];
	}
	 else {
		$domain = $host;
	}

	return $domain;
}


?>