<?php

defined("IN_IA") || exit("Access Denied");
class water_groupbuyModule extends WeModule
{
	public $paymenttable = 'water_partner_payment';
	public $authdatatable = 'water_partner_authdata';

	public function settingsDisplay($system)
	{
		global $_W;
		global $_GPC;
		load()->func("tpl");

		if (checksubmit()) {
			$input = array();
			$input['sysname'] = trim($_GPC['sysname']);
			$input['sysdesc'] = trim($_GPC['sysdesc']);
			$input['noticeopen'] = intval(trim($_GPC['noticeopen']));
			$input['orderpayok'] = trim($_GPC['orderpayok']);
			$input['auth'] = intval(trim($_GPC['auth']));

			if ($input['auth'] == 1) {
				if (!pdo_tableexists($this->paymenttable)) {
					message('检测到您尚未安装Water伴侣，请先到商城安装后即可使用，谢谢！');
				}


				$authdata = pdo_fetch('SELECT * FROM ' . tablename($this->authdatatable) . "\r\n" . '            ' . "\t\t\t\t\t\t\t" . 'WHERE uniacid= \'' . $_W['uniacid'] . '\' and name = \'' . $this->module['name'] . '\' ');

				if (empty($authdata)) {
					$adata = array('uniacid' => $_W['uniacid'], 'name' => $this->module['name'], 'title' => $this->module['title'], 'addtime' => date('Y-m-d H:i:s'), 'state' => 1);
					pdo_insert($this->authdatatable, $adata);
				}
				 else if ($authdata['state'] == 0) {
					pdo_update($this->authdatatable, array('state' => 1), array('id' => $authdata['id']));
				}


				$authpayment = pdo_fetch('SELECT * FROM ' . tablename($this->paymenttable));
				$input['appid'] = trim($authpayment['appid']);
				$input['secret'] = trim($authpayment['secret']);
				$input['acid'] = trim($authpayment['acid']);
				$input['mchid'] = trim($authpayment['mchid']);
				$input['apikey'] = trim($authpayment['apikey']);
				$input['apiclient_cert'] = trim($authpayment['apiclient_cert']);
				$input['apiclient_key'] = trim($authpayment['apiclient_key']);
				$input['rootca'] = trim($authpayment['rootca']);
				$input['ip'] = trim($authpayment['ip']);
				if (empty($input['appid']) || empty($input['secret'])) {
					message('启用借权后，appid/secret不可为空，请检查您的伴侣参数配置');
				}

			}
			 else {
				$appid = $_W['account']['key'];
				$secret = $_W['account']['secret'];
				$input['appid'] = $appid;
				$input['secret'] = $secret;
				$payment = pdo_fetch('SELECT payment FROM ' . tablename('uni_settings') . ' WHERE uniacid= \'' . $_W['uniacid'] . '\'');
				$payment = unserialize($payment['payment']);
				$input['mchid'] = $payment['wechat']['mchid'];
				$input['apikey'] = $payment['wechat']['apikey'];
				$input['ip'] = trim($_GPC['ip']);

				if (pdo_tableexists($this->paymenttable)) {
					$authdata = pdo_fetch('SELECT * FROM ' . tablename($this->authdatatable) . "\r\n\t" . '            ' . "\t\t\t\t\t" . 'WHERE uniacid= \'' . $_W['uniacid'] . '\' and name = \'' . $this->module['name'] . '\' ');

					if (!empty($authdata)) {
						if ($authdata['state'] == 1) {
							pdo_update($this->authdatatable, array('state' => 0), array('id' => $authdata['id']));
						}

					}

				}

			}

			if ($this->saveSettings($input)) {
				message('保存参数成功', 'refresh');
			}

		}


		if (empty($system['ip'])) {
			$system['ip'] = $_SERVER['SERVER_ADDR'];
		}


		include $this->template('system');
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


	$topleveldomaindb = array('com', 'edu', 'gov', 'int', 'mil', 'net', 'org', 'biz', 'info', 'top', 'wang', 'pro', 'name', 'so', 'in', 'museum', 'coop', 'aero', 'xxx', 'idv', 'mobi', 'cc', 'me', 'co', 'asia');
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