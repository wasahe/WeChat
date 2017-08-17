<?php

//decode by QQ:3213288469 http://www.zheyitianshi.com/
function echoJson($arr)
{
	if (!is_array($arr)) {
		echo $arr;
	} else {
		header("content-type:application/json");
		echo json_encode($arr);
	}
	die;
}
function createQrcode($url)
{
	global $_W;
	return $_W['siteroot'] . "web/index.php?c=platform&a=url2qr&do=qr&url=" . urlencode($url);
}
function timeShortHandle($time)
{
	if (strtotime($time) >= strtotime(date('Y-m-d'))) {
		return date('H:i:s', strtotime($time));
	}
	if (strtotime($time) >= strtotime(date('Y-12-31 23:59:59') . ' -1 years')) {
		return date('m-d H:i', strtotime($time));
	}
	return $time;
}
function momentsTimeHandle($time)
{
	if (strtotime($time) >= strtotime(date('Y-m-d'))) {
		return array('year' => '今天', 'month' => '');
	}
	if (strtotime($time) >= strtotime(date('Y-m-d', strtotime('-1 days')))) {
		return array('year' => '昨天', 'month' => '');
	}
	if (strtotime($time) >= strtotime(date('Y-12-31 23:59:59') . ' -1 years')) {
		return array('year' => date('m-d', strtotime($time)), 'month' => '');
	}
	return array('year' => date('Y', strtotime($time)), 'month' => date('m-d', strtotime($time)));
}