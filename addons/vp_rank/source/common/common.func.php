<?php
 

defined('IN_IA') || exit('Access Denied');
function returnError($message, $data = '', $status = 0, $type = '')
{
	global $_W;
	if ($_W['isajax'] || ($type == 'ajax')) {
		header('Content-Type:application/json; charset=utf-8');
		$ret = array('status' => $status, 'info' => $message, 'data' => $data);
		exit(json_encode($ret));
		return NULL;
	}


	return message($message, $data, 'error');
}

function returnSuccess($message, $data = '', $status = 1, $type = '')
{
	global $_W;
	if ($_W['isajax'] || ($type == 'ajax')) {
		header('Content-Type:application/json; charset=utf-8');
		$ret = array('status' => $status, 'info' => $message, 'data' => $data);
		exit(json_encode($ret));
		return NULL;
	}


	return message($message, $data, 'success');
}

function time_to_text($s, $m = 0)
{
	$t = '';

	if (86400 < $s) {
		$t .= intval($s / 86400) . '天';
		$s = $s % 86400;

		if ($m == 1) {
			return $t;
		}

	}


	if (3600 < $s) {
		$t .= intval($s / 3600) . '小时';
		$s = $s % 3600;

		if ($m == 1) {
			return $t;
		}

	}


	if (60 < $s) {
		$t .= intval($s / 60) . '分钟';
		$s = $s % 60;

		if ($m == 1) {
			return $t;
		}

	}


	if (0 < $s) {
		$t .= intval($s) . '秒';
	}


	return $t;
}

function array_get_by_range($as, $v, $k)
{
	$o = NULL;
	foreach ($as as $a ) {
		if ($a[$k] <= $v) {
			$o = $a;
			continue;
		}


		break;
	}

	return $o;
}

function time_to_time($t1, $t2 = 'now', $f = 'm-d H:i', $w = '前')
{
	$t = '';
	$t2 = (($t2 == 'now' ? time() : $t2));
	$s = abs($t2 - $t1);

	if (86400 < $s) {
		$t = date($f, $t1);
	}
	 else {
		if (3600 < $s) {
			$t .= intval($s / 3600) . '小时';
			$s = $s % 3600;
		}


		if (60 < $s) {
			$t .= intval($s / 60) . '分钟';
			$s = $s % 60;
		}


		if (0 <= $s) {
			$t .= intval($s) . '秒' . $w;
		}

	}

	return $t;
}

function rand_words($src, $len)
{
	$randStr = str_shuffle($src);
	return substr($randStr, 0, $len);
}

function url_base64_encode($str)
{
	$str = base64_encode($str);
	$code = url_encode($str);
	return $code;
}

function url_encode($code)
{
	$code = str_replace('+', '!', $code);
	$code = str_replace('/', '*', $code);
	$code = str_replace('=', '', $code);
	return $code;
}

function url_base64_decode($code)
{
	$code = url_decode($code);
	$str = base64_decode($code);
	return $str;
}

function url_decode($code)
{
	$code = str_replace('!', '+', $code);
	$code = str_replace('*', '/', $code);
	return $code;
}

function pencode($code, $seed = 'gengli9876543210')
{
	$c = url_base64_encode($code);
	$pre = substr(md5($seed . $code), 0, 3);
	return $pre . $c;
}

function pdecode($code, $seed = 'gengli9876543210')
{
	if (empty($code) || (strlen($code) <= 3)) {
		return '';
	}


	$pre = substr($code, 0, 3);
	$c = substr($code, 3);
	$str = url_base64_decode($c);
	$spre = substr(md5($seed . $str), 0, 3);

	if ($spre == $pre) {
		return $str;
	}


	return '';
}

function text_len($text)
{
	preg_match_all('/./us', $text, $match);
	return count($match[0]);
}

function VP_IMAGE_SAVE($path, $dir = '')
{
	global $_W;
	$filePath = ATTACHMENT_ROOT . '/' . $path;
	$key = $path;
	$accessKey = $_W['module_setting']['qn_ak'];
	$secretKey = $_W['module_setting']['qn_sk'];
	$auth = new Qiniu\Auth($accessKey, $secretKey);
	$bucket = ((empty($dir) ? $_W['module_setting']['qn_bucket'] : $dir));
	$token = $auth->uploadToken($bucket);
	$uploadMgr = new Qiniu\Storage\UploadManager();
	list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
	return array('error' => $err, 'image' => (empty($ret) ? '' : $ret['key']));
}

function VP_IMAGE_URL($path, $style = 'm', $dir = '', $driver = '')
{
	global $_W;

	if ('local' == $driver) {
		return $_W['attachurl'] . $path;
	}


	return 'http://' . $_W['module_setting']['qn_api'] . '/' . $path;
}

function VP_AVATAR($src, $size = 's')
{
	if (empty($src)) {
		return MODULE_URL . '/static/mobile/images/avatar.jpg';
	}


	if (empty($size)) {
		return $src;
	}


	$parts = parse_url($src);

	if ($parts['host'] == 'wx.qlogo.cn') {
		if ($size == 's') {
			$size = '64';
		}
		 else if ($size == 'm') {
			$size = '132';
		}


		$src = substr($src, 0, strrpos($src, '/')) . '/' . $size;
	}
	 else {
		$src = tomedia($src);
	}

	return $src;
}

function VP_THUMB($src, $size = 120)
{
	$ppos = strrpos($src, '.');
	return substr($src, 0, $ppos) . '_' . $size . substr($src, $ppos);
}

function VP_IMAGE_CREATE_FROM($src, $type)
{
	if ($type == 1) {
		if (function_exists('imagecreatefromgif')) {
			return imagecreatefromgif($src);
		}

	}
	 else if ($type == 2) {
		if (function_exists('imagecreatefromjpeg')) {
			return imagecreatefromjpeg($src);
		}

	}
	 else if ($type == 3) {
		if (function_exists('imagecreatefrompng')) {
			return imagecreatefrompng($src);
		}

	}

}

function VP_IMAGE_RESIZE($path, $s = 640)
{
	$src = imagecreatefromjpeg($path);
	$size_src = getimagesize($path);
	$w = $size_src[0];
	$h = $size_src[1];

	if ($w < 640) {
		return '图片宽度不能低于640像素';
	}


	if ($h < 640) {
		return '图片高度不能低于640像素';
	}


	$w = 640;
	$h = $h * (640 / $size_src[0]);
	$image = imagecreatetruecolor($w, $h);
	imagecopyresampled($image, $src, 0, 0, 0, 0, $w, $h, $size_src[0], $size_src[1]);
	imagejpeg($image, $path);
	return true;
}

function WX_CARD_TYPE($type = NULL)
{
	$map = array('GROUPON' => '团购券', 'DISCOUNT' => '折扣券', 'GIFT' => '礼品券', 'CASH' => '代金券', 'GENERAL_COUPON' => '通用券', 'MEMBER_CARD' => '会员卡', 'SCENIC_TICKET' => '景点门票', 'MOVIE_TICKET' => '电影票', 'BOARDING_PASS' => '飞机票', 'MEETING_TICKET' => '会议门票', 'BUS_TICKET' => '汽车票');

	if ($type == NULL) {
		return $map;
	}


	return $map[$type];
}

function WX_CARD_STATUS($status = NULL)
{
	$map = array('CARD_STATUS_NOT_VERIFY' => '待审核', 'CARD_STATUS_VERIFY_FAIL' => '审核失败', 'CARD_STATUS_VERIFY_OK' => '通过审核', 'CARD_STATUS_USER_DELETE' => '卡券被商户删除', 'CARD_STATUS_DISPATCH' => '在公众平台投放过的卡券');

	if ($status == NULL) {
		return $map;
	}


	return $map[$status];
}

function roll_weight($datas = array())
{
	$roll = rand(1, array_sum($datas));
	$_tmpW = 0;
	$rollnum = 0;

	foreach ($datas as $k => $v ) {
		$min = $_tmpW;
		$_tmpW += $v;
		$max = $_tmpW;

		if (($min < $roll) && ($roll <= $max)) {
			$rollnum = $k;
			break;
		}

	}

	return $rollnum;
}

function vp_sqr($n)
{
	return $n * $n;
}

function vp_random($bonus_min, $bonus_max)
{
	$sqr = intval(vp_sqr($bonus_max - $bonus_min));
	$rand_num = rand(0, $sqr - 1);
	return intval(sqrt($rand_num));
}

function redpack_plan($bonus_total, $bonus_count, $bonus_max, $bonus_min)
{
	$result = array();
	$average = $bonus_total / $bonus_count;
	$a = $average - $bonus_min;
	$b = $bonus_max - $bonus_min;
	$range1 = vp_sqr($average - $bonus_min);
	$range2 = vp_sqr($bonus_max - $average);
	$i = 0;

	while ($i < $bonus_count) {
		if ($average < rand($bonus_min, $bonus_max)) {
			$temp = $bonus_min + vp_random($bonus_min, $average);
			$result[$i] = $temp;
			$bonus_total -= $temp;
		}
		 else {
			$temp = $bonus_max - vp_random($average, $bonus_max);
			$result[$i] = $temp;
			$bonus_total -= $temp;
		}

		++$i;
	}

	if (0 < $bonus_total) {
		$i = 0;

		if ((0 < $bonus_total) && ($result[$i] < $bonus_max)) {
			++$result[$i];
			--$bonus_total;
		}


		++$i;
	}


	if ($bonus_total < 0) {
		$i = 0;

		if (($bonus_total < 0) && ($bonus_min < $result[$i])) {
			--$result[$i];
			++$bonus_total;
		}


		++$i;
	}


	return $result;
}

function explode_array($txt)
{
	$result = array();
	$arr = array();
	$txt = str_replace("\r\n", '%e2%80%a1', $txt);
	$txt = str_replace("\n", '%e2%80%a1', $txt);
	$arr = explode('%e2%80%a1', $txt);
	return $arr;
}

function explode_map($txt)
{
	$result = array();
	$arr = array();
	$txt = str_replace("\r\n", '%e2%80%a1', $txt);
	$txt = str_replace("\n", '%e2%80%a1', $txt);
	$arr = explode('%e2%80%a1', $txt);

	foreach ($arr as $kv ) {
		if (empty($kv)) {
			continue;
		}


		$kv = explode(':', $kv);

		if (count($kv) != 2) {
			continue;
		}


		$result[$kv[0]] = $kv[1];
	}

	return $result;
}


?>