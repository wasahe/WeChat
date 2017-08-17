<?php
define('IN_MOBILE', true);
$_SERVER['HTTP_USER_AGENT'] = 'Mobile MicroMessenger';
require '../../framework/bootstrap.inc.php';
$input = file_get_contents('php://input');
$isxml = true;

if (!empty($input) && empty($_GET['out_trade_no'])) {
	$obj = isimplexml_load_string($input, 'SimpleXMLElement', LIBXML_NOCDATA);
	$data = json_decode(json_encode($obj), true);

	if (empty($data)) {
		$result = array('return_code' => 'FAIL', 'return_msg' => '');
		echo array2xml($result);
		exit();
	}


	if (($data['result_code'] != 'SUCCESS') || ($data['return_code'] != 'SUCCESS')) {
		$result = array('return_code' => 'FAIL', 'return_msg' => (empty($data['return_msg']) ? $data['err_code_des'] : $data['return_msg']));
		echo array2xml($result);
		exit();
	}


	$get = $data;
}
 else {
	$isxml = false;
	$get = $_GET;
}

$_W['uniacid'] = intval($get['attach']);
$site = WeUtility::createModuleSite('czt_tushang');

if (!is_error($site)) {
	$_W['uniaccount'] = $_W['account'] = uni_fetch($_W['uniacid']);
	$_W['acid'] = $_W['uniaccount']['acid'];
	$wechat = $site->module['config']['wechat'];

	if (!empty($wechat)) {
		ksort($get);
		$string1 = '';

		foreach ($get as $k => $v ) {
			if (($v != '') && ($k != 'sign')) {
				$string1 .= $k . '=' . $v . '&';
			}

		}

		$sign = strtoupper(md5($string1 . 'key=' . $wechat['signkey']));

		if ($sign == $get['sign']) {
			$method = 'payResult';

			if (method_exists($site, $method)) {
				$ret = array();
				$ret['uniacid'] = $_W['uniacid'];
				$ret['acid'] = (($_W['account']['level'] == 4 ? $_W['acid'] : 0));
				$ret['result'] = 'success';
				$ret['from'] = 'notify';
				$ret['tid'] = $get['out_trade_no'];
				$ret['openid'] = $get['openid'];
				$ret['transaction_id'] = $get['transaction_id'];
				$ret['fee'] = $get['total_fee'] / 100;
				$site->$method($ret);

				if ($isxml) {
					$result = array('return_code' => 'SUCCESS', 'return_msg' => 'OK');
					echo array2xml($result);
					exit();
				}
				 else {
					exit('success');
				}
			}
		}
	}
}
if ($isxml) {
	$result = array('return_code' => 'FAIL', 'return_msg' => '');
	echo array2xml($result);
	exit();
	return 1;
}


exit('fail');

?>