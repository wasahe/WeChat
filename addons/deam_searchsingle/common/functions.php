<?php

//decode by QQ: http://www.5kym.com/
defined('IN_IA') or die('Access Denied');
function show_json($status = 1, $return = null)
{
	$ret = array('status' => $status);
	if ($return) {
		$ret['result'] = $return;
	}
	die(json_encode($ret));
}
function checkIsSubscribe($subscribe_model)
{
	global $_W, $_GPC;
	$openid = $_W['openid'];
	$uniacid = $_W['uniacid'];
	load()->classs('weixin.account');
	$accObj = WeixinAccount::create($acid);
	$access_token = $accObj->fetch_token();
	if ($subscribe_model == '2') {
		if (!empty($_W['fans']['nickname'])) {
			$isSubscribe = $_W['fans']['follow'];
		} else {
			$getuserInfoUrl = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';
			$getuserInfo = httpcurl($getuserInfoUrl);
			$getuserInfo = @json_decode($getuserInfo, true);
			if ($getuserInfo['errcode']) {
				load()->func('logging');
				logging_run($getuserInfo);
			}
			$isSubscribe = $getuserInfo['subscribe'];
		}
	} else {
		if ($subscribe_model == '1') {
			if ($_COOKIE['deam_openid']) {
				$jopenid = $_COOKIE['deam_openid'];
				$isGuanzhu = pdo_fetch("SELECT * FROM " . tablename(DM_TABLEPRE . 'guanzhu') . " WHERE openid = :openid AND uniacid = :uniacid", array(':openid' => $jopenid, ':uniacid' => $uniacid));
				if (!empty($isGuanzhu)) {
					$isSubscribe = '1';
				} else {
					$isSubscribe = '0';
				}
			} else {
				$isSubscribe = '0';
			}
		}
	}
	return $isSubscribe;
}
function httpcurl($url)
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}
function get_rand($dataArr)
{
	$result = '';
	$dataSum = array_sum($dataArr);
	$randNum = mt_rand(1, 10000);
	foreach ($dataArr as $key => $dataCur) {
		$nextSum = $dataSum - $dataCur;
		if ($nextSum < $randNum && $randNum <= $dataSum) {
			$result = $key;
			break;
		}
		$dataSum -= $dataCur;
	}
	unset($dataArr);
	return $result;
}
function deam_only_wechat($status = true)
{
	global $_W;
	if ($status) {
		$_W['container'] = 'wechat';
	}
}