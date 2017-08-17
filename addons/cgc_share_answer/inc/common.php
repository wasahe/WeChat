<?php
 

function createNonceStr($length = 16)
{
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$str = '';
	$i = 0;

	while ($i < $length) {
		$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		++$i;
	}

	return $str;
}

function get_random_domain($url)
{
	if (empty($url)) {
		return '';
	}


	$nonceStr = createnoncestr();
	$zdy_domain = explode('|', $url);
	$size = count($zdy_domain);

	if ($size == 1) {
		$zdy_domain[0] = str_replace('*', $nonceStr, $zdy_domain[0]);
		return $zdy_domain[0];
	}


	$random = mt_rand(1, $size);
	$zdy_domain[$random - 1] = str_replace('*', $nonceStr, $zdy_domain[$random - 1]);
	return $zdy_domain[$random - 1];
}

function send_template_message($data, $access_token)
{
	$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $access_token;
	load()->func('communication');
	$res = ihttp_request($url, $data);

	if (is_error($res)) {
		return array('code' => '-4', 'msg' => json_encode($res));
	}


	$res = json_decode($res['content'], true);

	if ($res['errcode'] == '0') {
		return array('code' => '1', 'msg' => json_encode($res));
	}


	return array('code' => '-3', 'msg' => json_encode($res));
}

function sfgz_user($fromuser)
{
	global $_W;
	$uniacid = $_W['uniacid'];
	$follow = pdo_fetchcolumn('SELECT follow FROM ' . tablename('mc_mapping_fans') . ' where uniacid=' . $uniacid . ' and openid=\'' . $fromuser . '\'');
	return $follow;
}

function getFromUserTest()
{
	global $_W;
	global $_GPC;
	$obj = array('openid' => $_GPC['test'], 'nickname' => $_GPC['test'], 'headimgurl' => 'http://wx.qlogo.cn/mmopen/bHACibrA8hAhnlNYETmRhdPTJiaKDCr7OvwoQ5y3oJKuDFD7iafDGWsmpVXCibjia30kc0bibkTU4xHKdrqXP1iaWkYxMmaOmFicHLza/0');
	return json_encode($obj);
}

function getFromUser($settings, $modulename)
{
	global $_W;
	global $_GPC;
	$uniacid = $_W['uniacid'];

	if (!empty($_GPC['test'])) {
		$userinfo = getfromusertest();
		setcookie($modulename . '_user_' . $uniacid, $userinfo, time() + (3600 * 24 * 5));
		return $userinfo;
	}


	if (empty($_COOKIE[$modulename . '_user_' . $uniacid])) {
		$url = $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&j=' . $_W['acid'] . '&c=entry&m=' . $modulename . '&do=xoauth';
		$xoauthURL = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		setcookie('xoauthURL', $xoauthURL, time() + (3600 * 24 * 5));
		$oauth2_code = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $settings['appid'] . '&redirect_uri=' . urlencode($url) . '&response_type=code&scope=snsapi_base&state=0#wechat_redirect';
		header('location:' . $oauth2_code);
		exit();
		return;
	}


	return $_COOKIE[$modulename . '_user_' . $uniacid];
}

function sendImage($access_token, $obj)
{
	load()->func('communication');
	$data = array(
		'touser'  => $obj['openid'],
		'msgtype' => 'image',
		'image'   => array('media_id' => $obj['media_id'])
		);
	WeUtility::logging('sendImage start', json_encode($data));
	$url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=' . $access_token;
	WeUtility::logging('sendResurl', $url);
	$ret = ihttp_request($url, json_encode($data));
	$content = @json_decode($ret['content'], true);
	WeUtility::logging('sendImage end', $content);
	return $content;
}

function post_send_text($openid, $content)
{
	global $_W;
	$acid = ((!empty($_W['acid']) ? $_W['acid'] : $_W['uniacid']));
	load()->classs('weixin.account');
	$accObj = WeixinAccount::create($acid);
	$token = $accObj->fetch_token();
	load()->func('communication');
	$data['touser'] = $openid;
	$data['msgtype'] = 'text';
	$data['text']['content'] = urlencode($content);
	$dat = json_encode($data);
	$dat = urldecode($dat);
	$url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=' . $token;
	$ret = ihttp_post($url, $dat);
	$dat = $ret['content'];
	$result = @json_decode($dat, true);

	if ($result['errcode'] == '0') {
	}
	 else {
		load()->func('logging');
		logging_run('post_send_text:');
		logging_run($dat);
		logging_run($result);
	}

	return $result;
}

function get_wechat_user($fromuser)
{
	global $_W;
	$acid = $_W['acid'];
	$uniacccount = WeAccount::create($acid);
	$userinfo = $uniacccount->fansQueryInfo($fromuser);
	return $userinfo;
}


?>