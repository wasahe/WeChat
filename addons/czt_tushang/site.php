<?php
error_reporting(0);

defined('IN_IA') || exit('Access Denied');
define('MODULE_NAME', 'czt_tushang');
define('MODULE_ROOT', IA_ROOT . '/addons/' . MODULE_NAME . '/');
define('RESOURCE_URL', '../addons/' . MODULE_NAME . '/template/mobile/');
define('CSS_URL', RESOURCE_URL . 'css/');
define('JS_URL', RESOURCE_URL . 'js/');
define('IMAGES_URL', RESOURCE_URL . 'images/');
require MODULE_ROOT . 'global.php';
global $site;
class Czt_tushangModuleSite extends WeModuleSite
{
	public function doMobileTest()
	{
		global $_W;
		global $_GPC;
	}

	public function doMobileImage()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$type = ((intval($_GPC['type']) == 2 ? 'video' : 'image'));

		if ($id) {
			$rescource = pdo_fetch('SELECT * FROM ' . my_tablename($type) . ' WHERE uniacid =:uniacid  and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $id));

			if ($rescource) {
				$settings = $this->module['config'];
				$path = ATTACHMENT_ROOT . '/' . MODULE_NAME . '/' . $_W['uniacid'] . '/' . $type . '/' . date('Ymd', $rescource['create_time']) . '/';
				header('Content-type: image/jpeg');

				if (file_exists($path . $id . '.jpg')) {
					readfile($path . $id . '.jpg');
					exit();
				}


				if (!file_exists($path)) {
					load()->func('file');
					mkdirs($path);
				}


				$thumb = $settings['qiniu']['host'];

				if ($rescource['qiniu_stat'] == 1) {
					if ($type == 'video') {
						$thumb .= '/video/' . $rescource['thumb'];
					}
					 else {
						$thumb .= $rescource['url'];
					}

					$thumb .= '!thumb';
				}
				 else if ($type == 'video') {
					require MODULE_ROOT . 'Qiniu.class.php';
					$thumb .= '/video/' . $rescource['thumb'] . '?imageMogr2/thumbnail/640x/blur/50x40|watermark/3/text/' . Qiniu\base64_urlSafeEncode(seconds_to_mmss($rescource['duration'])) . '/fontsize/500/fill/I0VGRUZFRg==/dissolve/100/gravity/SouthEast/dx/10/dy/10/image/' . Qiniu\base64_urlSafeEncode(MODULE_URL . 'btn-play.png') . '/dissolve/100/gravity/Center';
				}
				 else {
					$thumb .= $rescource['url'] . '?imageMogr2/thumbnail/640x/blur/50x40';
				}

				$thumb = imagecreatefromstring(file_get_contents($thumb));
				empty($thumb) && exit();
				require IA_ROOT . '/framework/library/qrcode/phpqrcode.php';
				$foot_text = $settings['foot_text'];

				if ($type == 'video') {
					$thumb_dst_h = imagesy($thumb) - 40;
					$im = imagecreatetruecolor(640, $thumb_dst_h + 230 + ((empty($foot_text) ? 0 : 10)));
					imagefill($im, 0, 0, imagecolorallocate($im, 243, 243, 243));
					imagecopy($im, $thumb, 0, 0, 0, 0, imagesx($thumb), imagesy($thumb));
					$style = array_merge(array_fill(0, 5, imagecolorallocate($im, 213, 213, 213)), array_fill(0, 5, IMG_COLOR_TRANSPARENT));
					imagesetstyle($im, $style);
					imageline($im, 170, $thumb_dst_h + 80, 610, $thumb_dst_h + 80, IMG_COLOR_STYLED);
					imageline($im, 170, $thumb_dst_h + 80 + 50, 610, $thumb_dst_h + 80 + 50, IMG_COLOR_STYLED);
					imageline($im, 170, $thumb_dst_h + 80 + 100, 610, $thumb_dst_h + 80 + 100, IMG_COLOR_STYLED);
					$text_color = imagecolorallocate($im, 90, 90, 90);
					imagefttext($im, 19, 0, 170, $thumb_dst_h + 170, $text_color, MODULE_ROOT . '/SimHei.ttf', '长按图片识别二维码，查看高清原视频。');
					imagefttext($im, 19, 0, 170, $thumb_dst_h + 120, $text_color, MODULE_ROOT . '/SimHei.ttf', $rescource['title']);
					imagefttext($im, 19, 0, 171, $thumb_dst_h + 120, $text_color, MODULE_ROOT . '/SimHei.ttf', $rescource['title']);
					$url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('show', array('id' => $id, 'type' => 2));
					load()->classs('weixin.account');
					$accObj = new WeixinAccount($settings['oauth']);
					$ret = $accObj->long2short($url);

					if (!is_error($ret)) {
						$url = $ret['short_url'];
					}


					$enc = QRencode::factory(QR_ECLEVEL_L, 3, 4);
					$tab = $enc->encode($url);
					$qr = QRimage($tab, (30 < strlen($url) ? 3 : 4), 1);
					imagecopy($im, $qr, 35, $thumb_dst_h + 80, 0, 0, imagesx($qr), imagesy($qr));

					if (!empty($foot_text)) {
						$text_box = imageftbbox(12, 0, MODULE_ROOT . '/SimHei.ttf', $foot_text);
						$text_x = 320 - round(abs($text_box[2] - $text_box[0]) / 2);
						imagefttext($im, 12, 0, $text_x, $thumb_dst_h + 220, imagecolorallocate($im, 180, 180, 180), MODULE_ROOT . '/SimHei.ttf', $foot_text);
					}


					imagejpeg($im, $path . $id . '.jpg', 90);
					imagejpeg($im, NULL, 90);
					imagedestroy($im);
					imagedestroy($qr);
					imagedestroy($thumb);
					return;
				}


				$thumb_src_h = imagesy($thumb);
				$thumb_dst_h = imagesy($thumb) * 0.90000000000000002;
				$im = imagecreatetruecolor(640, $thumb_dst_h + 220 + ((empty($foot_text) ? 0 : 10)));
				imagefill($im, 0, 0, imagecolorallocate($im, 243, 243, 243));
				imagefilledrectangle($im, 40, 40, 610, $thumb_dst_h + 40, imagecolorallocate($im, 203, 203, 203));
				imagecopyresampled($im, $thumb, 35, 35, 0, 0, 570, $thumb_dst_h, 640, $thumb_src_h);
				$style = array_merge(array_fill(0, 5, imagecolorallocate($im, 213, 213, 213)), array_fill(0, 5, IMG_COLOR_TRANSPARENT));
				imagesetstyle($im, $style);
				imageline($im, 170, $thumb_dst_h + 80, 610, $thumb_dst_h + 80, IMG_COLOR_STYLED);
				imageline($im, 170, $thumb_dst_h + 80 + 50, 610, $thumb_dst_h + 80 + 50, IMG_COLOR_STYLED);
				imageline($im, 170, $thumb_dst_h + 80 + 100, 610, $thumb_dst_h + 80 + 100, IMG_COLOR_STYLED);
				$text_color = imagecolorallocate($im, 90, 90, 90);
				imagefttext($im, 19, 0, 170, $thumb_dst_h + 170, $text_color, MODULE_ROOT . '/SimHei.ttf', '长按图片识别二维码，查看高清原图。');
				imagefttext($im, 19, 0, 170, $thumb_dst_h + 120, $text_color, MODULE_ROOT . '/SimHei.ttf', $rescource['title']);
				imagefttext($im, 19, 0, 171, $thumb_dst_h + 120, $text_color, MODULE_ROOT . '/SimHei.ttf', $rescource['title']);
				$url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('show', array('id' => $id));
				load()->classs('weixin.account');
				$accObj = new WeixinAccount($settings['oauth']);
				$ret = $accObj->long2short($url);

				if (!is_error($ret)) {
					$url = $ret['short_url'];
				}


				$enc = QRencode::factory(QR_ECLEVEL_L, 3, 4);
				$tab = $enc->encode($url);
				$qr = QRimage($tab, (30 < strlen($url) ? 3 : 4), 1);
				imagecopy($im, $qr, 35, $thumb_dst_h + 80, 0, 0, imagesx($qr), imagesy($qr));

				if (!empty($foot_text)) {
					$text_box = imageftbbox(12, 0, MODULE_ROOT . '/SimHei.ttf', $foot_text);
					$text_x = 320 - round(abs($text_box[2] - $text_box[0]) / 2);
					imagefttext($im, 12, 0, $text_x, $thumb_dst_h + 214, imagecolorallocate($im, 180, 180, 180), MODULE_ROOT . '/SimHei.ttf', $foot_text);
				}


				imagejpeg($im, $path . $id . '.jpg', 90);
				imagejpeg($im, NULL, 90);
				imagedestroy($im);
				imagedestroy($qr);
				imagedestroy($thumb);
			}

		}

	}

	public function doMobileQiniu_callback()
	{
		global $_W;
		global $_GPC;
		$callbackBody = file_get_contents('php://input');
		$callbackBody = json_decode($callbackBody, true);
		$id = $_GPC['id'];

		if (($callbackBody['code'] == 0) && $id) {
			pdo_update(my_tablename('image', 0), array('qiniu_stat' => '1'), array('uniacid' => $_W['uniacid'], 'id' => $id));
		}


		isetcookie('qiniu_stat', base64_encode($_W['config']['setting']['authkey'] . TIMESTAMP . $id), 3600 * 24, true);
		pdo_query('update ' . my_tablename('image') . ' set qiniu_stat=1 where id=' . $id);
	}

	public function doMobileCash()
	{
		global $_W;
		global $_GPC;
		$settings = $this->module['config'];
		$user = user_info();

		if (checksubmit()) {
			$fee = intval($_GPC['fee']);
			if ((!empty($user['balance']) && ($user['balance'] < 2)) || ($fee < 2) || ($fee < $settings['cash']['min']) || ($settings['cash']['max'] < $fee)) {
				$this->jump('余额不足', '提现错误！', 'warn');
			}


			$starttime = strtotime(date('Y-m-d'));
			$times = pdo_fetchcolumn('SELECT count(*) FROM ' . my_tablename('cash') . ' WHERE uniacid =:uniacid and uid=:uid  and create_time >= :starttime AND create_time <= :endtime ', array(':uniacid' => $_W['uniacid'], ':uid' => $user['uid'], ':starttime' => $starttime, ':endtime' => $starttime + 86399));

			if ($settings['cash']['times'] <= $times) {
				$this->jump('超过每天提现次数，请明天再申请提现', '提现错误！', 'warn');
			}


			if ($user['balance'] < $fee) {
				$fee = $user['balance'];
			}


			$data = array('uid' => $user['uid'], 'openid' => $user['openid'], 'uniacid' => $_W['uniacid'], 'create_time' => TIMESTAMP, 'trade_no' => TIMESTAMP . sprintf('%02d', $_W['uniacid']) . sprintf('%06d', $user['uid']) . random(8, 1), 'fee' => $fee, 'amount' => $fee * (1 - $settings['cash']['rate']));
			pdo_insert(my_tablename('cash', 0), $data);
			$id = pdo_insertid();

			if ($id) {
				pdo_query('update ' . my_tablename('user') . ' set balance=balance-' . $fee . ' where uid=' . $user['uid'] . ' and uniacid=' . $_W['uniacid']);

				if ($settings['cash']['limit'] < $fee) {
					$this->jump('提现金额：' . $fee . '元，请耐心等待管理员审核，注意到账通知！', '提现申请成功！');
				}


				$path = ATTACHMENT_ROOT . '/' . MODULE_NAME . '/cert';
				$wechat = $settings['wechat'];
				$wechat['rootca'] = $path . '/rootca.pem.' . $_W['uniacid'];
				$wechat['apiclient_key'] = $path . '/apiclient_key.pem.' . $_W['uniacid'];
				$wechat['apiclient_cert'] = $path . '/apiclient_cert.pem.' . $_W['uniacid'];
				$params = array('openid' => $user['openid'], 'fee' => $data['amount'], 'trade_no' => $data['trade_no'], 'desc' => '提现' . $fee . '元，手续费' . ($fee * $settings['cash']['rate']) . '元');
				$ret = wx_pay($params, $wechat);

				if (is_error($ret)) {
					pdo_update(my_tablename('cash', 0), array('status' => 2), array('id' => $id));
					$log = MODULE_ROOT . 'wx_pay.log';
					if (file_exists($log) && (10240 < filesize($log))) {
						@unlink($log);
					}


					file_put_contents($log, date('Y-m-d H:i:s') . ':' . $ret['message'] . PHP_EOL, FILE_APPEND);

					if ((3 <= $_W['account']['level']) && !empty($settings['admin_openid'])) {
						$settings['admin_openid'] = trim($settings['admin_openid']);
						load()->classs('weixin.account');
						$account = new WeiXinAccount($_W['account']);

						if (($_W['account']['level'] == 4) && !empty($settings['notify_tpl']['notice'])) {
							$postdata['first'] = array('value' => '用户提现出错，请尽快处理', 'color' => '#000000');
							$postdata['keyword1'] = array('value' => '提现出错', 'color' => '#000000');
							$postdata['keyword2'] = array('value' => '系统通知', 'color' => '#000000');
							$postdata['keyword3'] = array('value' => date('Y-m-d h:i', TIMESTAMP), 'color' => '#000000');
							$postdata['remark'] = array('value' => '详情:' . $ret['message'], 'color' => '#000000');
							$account->sendTplNotice($settings['admin_openid'], $settings['notify_tpl']['notice'], $postdata);
						}
						 else {
							$account->sendCustomNotice(array(
	'touser'  => $settings['admin_openid'],
	'msgtype' => 'text',
	'text'    => array('content' => urlencode('用户提现出错：' . $ret['message']))
	));
						}
					}


					$this->jump('系统提现出错，已通知管理员，请耐心等待处理', '提现错误！', 'warn');
				}
				 else {
					pdo_update(my_tablename('cash', 0), array('payment_no' => $ret['payment_no'], 'payment_time' => $ret['payment_time'], 'status' => 1), array('id' => $id));

					if (!empty($settings['oauth']['force'])) {
						if (!empty($user['origin_openid'])) {
							$user['openid'] = $user['origin_openid'];
						}

					}


					if (3 <= $_W['account']['level']) {
						load()->classs('weixin.account');

						if (!empty($settings['notify_tpl']['cash']) && ($_W['account']['level'] == 4)) {
							$account = new WeiXinAccount($_W['account']);
							$postdata['first'] = array('value' => '你的提现操作已完成', 'color' => '#000000');
							$postdata['keyword1'] = array('value' => $fee . '元', 'color' => '#000000');
							$postdata['keyword2'] = array('value' => date('Y-m-d h:i', TIMESTAMP), 'color' => '#000000');
							$postdata['remark'] = array('value' => '扣手续费：' . ($fee * $settings['cash']['rate']) . '元', 'color' => '#000000');
							$account->sendTplNotice($user['openid'], $settings['notify_tpl']['cash'], $postdata, $_W['siteroot'] . 'app/' . $this->createMobileUrl('user'));
						}
						 else if ($_W['account']['level'] == 3) {
							$account = new WeiXinAccount($_W['account']);
							$account->sendCustomNotice(array(
	'touser'  => $user['openid'],
	'msgtype' => 'text',
	'text'    => array('content' => urlencode('你的提现操作已完成' . "\n" . '提现金额：' . $fee . '元' . "\n" . '扣手续费：' . ($fee * $settings['cash']['rate']) . '元'))
	));
						}

					}


					$this->jump('提现成功，请注意到账通知！', '提现成功！');
				}
			}

		}


		include $this->template('cash');
	}

	public function doMobileTest1()
	{
		global $_W;
		global $_GPC;
		$path = ATTACHMENT_ROOT . '/' . MODULE_NAME . '/cert';

		if (!file_exists($path)) {
			load()->func('file');
			mkdirs($path);
		}


		if ($_GPC['a'] == 1) {
			unlink($path . '/root');
		}
		 else {
			file_put_contents($path . '/root', '1');
		}

		echo '1';
	}

	public function doMobileInfo()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$type = ((intval($_GPC['type']) == 2 ? 'video' : 'image'));

		if ($id) {
			$settings = $this->module['config'];
			$user = user_info();

			if (defined('OAUTH_FORCE')) {
				$rescource = pdo_fetch('SELECT * FROM ' . my_tablename($type) . ' WHERE uniacid =:uniacid  and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $id));

				if (empty($user['origin_openid'])) {
					pdo_update(my_tablename('user', 0), array('origin_openid' => $rescource['origin_openid']), array('uid' => $user['uid']));
				}

			}
			 else {
				$rescource = pdo_fetch('SELECT * FROM ' . my_tablename($type) . ' WHERE uniacid =:uniacid  and id=:id and openid=:openid', array(':uniacid' => $_W['uniacid'], ':id' => $id, ':openid' => $user['openid']));
			}

			if ($rescource) {
				if ($rescource['status'] == 0) {
					$thumb = $settings['qiniu']['host'];

					if ($rescource['qiniu_stat'] == 1) {
						if ($type == 'video') {
							$thumb .= '/video/' . $rescource['thumb'];
						}
						 else {
							$thumb .= $rescource['url'];
						}

						$thumb .= '!thumb';
					}
					 else if ($type == 'video') {
						require MODULE_ROOT . 'Qiniu.class.php';
						$thumb .= '/video/' . $rescource['thumb'] . '?imageMogr2/thumbnail/640x/blur/50x40|watermark/3/text/' . Qiniu\base64_urlSafeEncode(seconds_to_mmss($rescource['duration'])) . '/fontsize/500/fill/I0VGRUZFRg==/dissolve/100/gravity/SouthEast/dx/10/dy/10/image/' . Qiniu\base64_urlSafeEncode(MODULE_URL . 'btn-play.png') . '/dissolve/100/gravity/Center';
					}
					 else {
						$thumb .= $rescource['url'] . '?imageMogr2/thumbnail/640x/blur/50x40';
					}

					if (checksubmit()) {
						if (intval($_GPC['price']) < 1) {
							message('金额不能小于1元！', 'refresh', 'error');
						}


						$data['price'] = max(intval($_GPC['price']), 1);
						$data['status'] = 1;
						$data['uid'] = $user['uid'];

						if (defined('OAUTH_FORCE')) {
							$data['openid'] = $user['openid'];
						}


						!empty($_GPC['title']) && $data['title'] = $_GPC['title'];
						pdo_update(my_tablename($type, 0), $data, array('id' => $id));
						$rescource['status'] = 1;
					}

				}


				if ($type == 'video') {
					include $this->template('info2');
					return;
				}


				include $this->template('info');
			}

		}

	}

	public function doMobileShow()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$type = ((intval($_GPC['type']) == 2 ? 2 : 1));

		if ($id) {
			$rescource = pdo_fetch('SELECT * FROM ' . my_tablename(($type == 2 ? 'video' : 'image')) . ' WHERE uniacid =:uniacid  and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $id));

			if ($rescource) {
				$settings = $this->module['config'];
				$user = user_info(1);
				$record = pdo_fetch('SELECT * FROM ' . my_tablename('record') . ' WHERE uniacid =:uniacid and relate_id=:id  and uid=:uid and status=1 and type=' . $type, array(':uniacid' => $_W['uniacid'], ':id' => $id, ':uid' => $user['uid']));

				if (empty($record) && $_GPC['done']) {
					$records = pdo_fetchall('SELECT * FROM ' . my_tablename('record') . ' WHERE uniacid =:uniacid and relate_id=:id  and uid=:uid and status=0 and type=' . $type, array(':uniacid' => $_W['uniacid'], ':id' => $id, ':uid' => $user['uid']));

					foreach ($records as $key => $value ) {
						$result = wx_queryOrder($value['tid'], $settings['wechat']);

						if (!is_error($result) && ($result['trade_state'] == 'SUCCESS')) {
							$params = array('transaction_id' => $result['transaction_id'], 'result' => 'success', 'from' => 'notify', 'tid' => $result['out_trade_no'], 'uniacid' => $_W['uniacid'], 'fee' => $result['total_fee'] / 100, 'acid' => ($_W['account']['level'] == 4 ? $_W['acid'] : 0));
							$this->payResult($params);
							$record = $records[$key];
							break;
						}

					}
				}


				$thumb = $settings['qiniu']['host'];

				if ($rescource['qiniu_stat'] == 1) {
					if ($type == 2) {
						$thumb .= '/video/' . $rescource['thumb'];
					}
					 else {
						$thumb .= $rescource['url'];
					}

					$thumb .= '!thumb';
				}
				 else if ($type == 2) {
					require MODULE_ROOT . 'Qiniu.class.php';
					$thumb .= '/video/' . $rescource['thumb'] . '?imageMogr2/thumbnail/640x/blur/50x40|watermark/3/text/' . Qiniu\base64_urlSafeEncode(seconds_to_mmss($rescource['duration'])) . '/fontsize/500/fill/I0VGRUZFRg==/dissolve/100/gravity/SouthEast/dx/10/dy/10/image/' . Qiniu\base64_urlSafeEncode(MODULE_URL . 'btn-play.png') . '/dissolve/100/gravity/Center';
				}
				 else {
					$thumb .= $rescource['url'] . '?imageMogr2/thumbnail/640x/blur/50x40';
				}

				if ($type == 2) {
					include $this->template('show2');
					return;
				}


				include $this->template('show');
			}

		}

	}

	public function doMobileComment()
	{
		global $_W;
		global $_GPC;

		if ($_W['isajax']) {
			$id = intval($_GPC['id']);
			$uid = intval($_GPC['uid']);
			$type = ((intval($_GPC['type']) == 2 ? 2 : 1));
			if ($id && $uid) {
				$record = pdo_fetch('SELECT * FROM ' . my_tablename('record') . ' WHERE uniacid =:uniacid and relate_id=:id  and uid=:uid and status=1 and type=' . $type, array(':uniacid' => $_W['uniacid'], ':id' => $id, ':uid' => $uid));
				if ($record && ($record['is_comment'] != 1)) {
					pdo_update(my_tablename('record', 0), array('is_comment' => 1), array('id' => $record['id']));

					if ($_GPC['action'] == 'up') {
						pdo_query('update ' . my_tablename(($type == 2 ? 'video' : 'image')) . ' set up=up+1 where id=' . $id . ' and uniacid=' . $_W['uniacid']);
					}


					if ($_GPC['action'] == 'down') {
						pdo_query('update ' . my_tablename(($type == 2 ? 'video' : 'image')) . ' set down=down+1 where id=' . $id . ' and uniacid=' . $_W['uniacid']);
					}


					exit(true);
				}

			}

		}

	}

	public function doMobileReport()
	{
		global $_W;
		global $_GPC;

		if (checksubmit()) {
			$this->jump('您的举报已提交审核，我们会尽快处理！', '举报成功');
		}


		include $this->template('report');
	}

	public function jump($info, $title, $style = 'safe_success')
	{
		global $_W;
		global $_GPC;
		header('Location: ' . $_W['siteroot'] . 'app/' . $this->createMobileUrl('msg', array('info' => $info, 'title' => $title, 'style' => $style)));
		exit();
	}

	public function doMobileMsg()
	{
		global $_W;
		global $_GPC;
		$_GPC['title'] && $_GPC['style'] && $_GPC['info'] && include $this->template('msg');
	}

	public function doMobileList()
	{
		global $_W;
		global $_GPC;
		$op = ((!empty($_GPC['op']) ? $_GPC['op'] : 'hot'));
		$type = ((intval($_GPC['type']) == 2 ? 2 : 1));

		if ($_W['isajax']) {
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;

			if ($op == 'hot') {
				$list = pdo_fetchall('SELECT * FROM ' . my_tablename(($type == 2 ? 'video' : 'image')) . ' WHERE uniacid =:uniacid  and status=1 order by show_times desc ,create_time desc limit ' . (($pindex - 1) * $psize) . ',' . $psize, array(':uniacid' => $_W['uniacid']));
				$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . my_tablename(($type == 2 ? 'video' : 'image')) . ' WHERE uniacid =:uniacid and status=1', array(':uniacid' => $_W['uniacid']));
			}


			if (($op == 'post') || ($op == 'read')) {
				$user = user_info();

				if ($op == 'post') {
					$list = pdo_fetchall('SELECT * FROM ' . my_tablename(($type == 2 ? 'video' : 'image')) . ' WHERE uniacid =:uniacid  and uid=:uid and status=1 order by create_time desc limit ' . (($pindex - 1) * $psize) . ',' . $psize, array(':uid' => $user['uid'], ':uniacid' => $_W['uniacid']));
					$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . my_tablename(($type == 2 ? 'video' : 'image')) . ' WHERE uniacid =:uniacid and uid=:uid and status=1', array(':uid' => $user['uid'], ':uniacid' => $_W['uniacid']));
				}
				 else {
					$list = pdo_fetchall('SELECT b.* FROM ' . my_tablename('record') . ' as a Inner join ' . my_tablename(($type == 2 ? 'video' : 'image')) . ' as b on a.relate_id=b.id WHERE a.uniacid =:uniacid  and a.uid=:uid and a.status=1 and a.type=' . $type . ' order by create_time desc limit ' . (($pindex - 1) * $psize) . ',' . $psize, array(':uid' => $user['uid'], ':uniacid' => $_W['uniacid']));
					$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . my_tablename('record') . ' WHERE uniacid =:uniacid and uid=:uid and status=1 and type=' . $type, array(':uid' => $user['uid'], ':uniacid' => $_W['uniacid']));
				}
			}


			$settings = $this->module['config'];

			foreach ($list as $key => $value ) {
				if ($type == 2) {
					$list[$key]['icon'] = MODULE_URL . 'btn-play.png';
				}
				 else {
					$list[$key]['icon'] = $settings['qiniu']['host'] . $value['url'];

					if ($value['qiniu_stat'] == 1) {
						$list[$key]['icon'] .= '!icon';
					}
					 else {
						$list[$key]['icon'] .= '?imageMogr2/thumbnail/640x/blur/50x40/gravity/North/crop/120x120';
					}
				}

				if ($op == 'post') {
					$list[$key]['url'] = $this->createMobileUrl('info', array('id' => $value['id'], 'type' => $type));
				}
				 else {
					$list[$key]['url'] = $this->createMobileUrl('show', array('id' => $value['id'], 'type' => $type));
				}
			}

			if (($pindex * $psize) < $total) {
				$next_page = $pindex + 1;
			}
			 else {
				$next_page = 0;
			}

			exit(json_encode(array('data' => $list, 'next_page' => $next_page)));
		}


		switch ($op) {
		case 'hot':
			$type = ((intval($_GPC['state']) == 2 ? 2 : 1));

			if ($type == 2) {
				$title = '热门视频';
			}
			 else {
				$title = '热门图片';
			}

			break;

		case 'post':
			if ($type == 2) {
				$title = '我的视频';
			}
			 else {
				$title = '我的图片';
			}

			break;

		case 'read':
			if ($type == 2) {
				$title = '已看视频';
			}
			 else {
				$title = '已看图片';
			}

			break;

		}
	}

	public function doMobileList2()
	{
		global $_W;
		global $_GPC;
		$op = 'new';
		$type = ((intval($_GPC['type']) == 2 ? 2 : 1));

		if ($_W['isajax']) {
			$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$list = pdo_fetchall('SELECT * FROM ' . my_tablename(($type == 2 ? 'video' : 'image')) . ' WHERE uniacid =:uniacid  and status=1 order by create_time desc limit ' . (($pindex - 1) * $psize) . ',' . $psize, array(':uniacid' => $_W['uniacid']));
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . my_tablename(($type == 2 ? 'video' : 'image')) . ' WHERE uniacid =:uniacid and status=1', array(':uniacid' => $_W['uniacid']));
			$settings = $this->module['config'];

			foreach ($list as $key => $value ) {
				if ($type == 2) {
					$list[$key]['icon'] = MODULE_URL . 'btn-play.png';
				}
				 else {
					$list[$key]['icon'] = $settings['qiniu']['host'] . $value['url'];

					if ($value['qiniu_stat'] == 1) {
						$list[$key]['icon'] .= '!icon';
					}
					 else {
						$list[$key]['icon'] .= '?imageMogr2/thumbnail/640x/blur/50x40/gravity/North/crop/120x120';
					}
				}

				$list[$key]['url'] = $this->createMobileUrl('show', array('id' => $value['id'], 'type' => $type));
			}

			if (($pindex * $psize) < $total) {
				$next_page = $pindex + 1;
			}
			 else {
				$next_page = 0;
			}

			exit(json_encode(array('data' => $list, 'next_page' => $next_page)));
		}


		$type = ((intval($_GPC['state']) == 2 ? 2 : 1));

		if ($type == 2) {
			$title = '最新视频';
		}
		 else {
			$title = '最新图片';
		}

		include $this->template('list');
	}

	public function doMobileRank()
	{
		global $_W;
		global $_GPC;
		$user = pdo_fetchall('SELECT * FROM ' . my_tablename('user') . ' WHERE `uniacid`=:uniacid and nickname <> \'\' and headimgurl <> \'\'  order by income desc limit 10', array(':uniacid' => $_W['uniacid']), 'uid');
		$uid = array_keys($user);
		$user_count = pdo_fetchall('SELECT uid,count(*) as count FROM ' . my_tablename('image') . ' where uid in (' . implode(',', $uid) . ') and status=1 group by uid', array(), 'uid');
		include $this->template('rank');
	}

	public function doMobileJson_pay()
	{
		global $_W;
		global $_GPC;
		!$this->inMobile && exit();

		if ($_W['isajax']) {
			$id = intval($_GPC['id']);
			$uid = intval($_GPC['uid']);
			$type = ((intval($_GPC['type']) == 2 ? 2 : 1));
			if ($id && $uid && !empty($_GPC['openid'])) {
				$price = pdo_fetchcolumn('SELECT price FROM ' . my_tablename(($type == 2 ? 'video' : 'image')) . ' WHERE uniacid =:uniacid  and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $id));

				if (!empty($price)) {
					$user = array('uid' => $uid, 'openid' => $_GPC['openid']);
					$data = pdo_fetch('SELECT * FROM ' . my_tablename('record') . ' WHERE relate_id=:id and uid=:uid and uniacid=:uniacid and status=0 and create_time > ' . (TIMESTAMP - 590), array(':id' => $id, ':uid' => $user['uid'], ':uniacid' => $_W['uniacid']));
					$flag = true;

					if (empty($data)) {
						$flag = false;
						$data = array('relate_id' => $id, 'uid' => $user['uid'], 'openid' => $user['openid'], 'uniacid' => $_W['uniacid'], 'create_time' => TIMESTAMP, 'tid' => TIMESTAMP . sprintf('%02d', $_W['uniacid']) . sprintf('%06d', $user['uid']) . random(8, 1), 'fee' => $price, 'type' => $type);
					}


					if ($flag || pdo_insert(my_tablename('record', 0), $data)) {
						$params = array('title' => $_W['account']['name'] . ' - 打赏', 'fee' => $data['fee'], 'tid' => $data['tid'], 'openid' => $user['openid']);
						$settings = $this->module['config'];
						$res = wechat_build($params, $settings['wechat']);
						exit(json_encode($res));
					}

				}

			}

		}

	}

	public function payResult($params)
	{
		global $_GPC;
		global $_W;

		if (($params['result'] == 'success') && ($params['from'] == 'notify')) {
			$res = pdo_fetch('SELECT * FROM ' . my_tablename('record') . ' WHERE uniacid = :uniacid and tid = :tid', array(':tid' => $params['tid'], ':uniacid' => $params['uniacid']));

			if (!empty($res) && ($res['status'] != 1) && ($res['fee'] == $params['fee'])) {
				if ($res['type'] == 2) {
					$type = 2;
					$rescource = pdo_fetch('SELECT uid,origin_openid FROM ' . my_tablename('video') . ' WHERE id = :id', array(':id' => $res['relate_id']));
				}
				 else {
					$type = 1;
					$rescource = pdo_fetch('SELECT uid,origin_openid FROM ' . my_tablename('image') . ' WHERE id = :id', array(':id' => $res['relate_id']));
				}

				$res['origin_uid'] = $rescource['uid'];
				$res['origin_openid'] = $rescource['origin_openid'];
				$data = array();
				$data['status'] = 1;
				$data['transaction_id'] = $params['transaction_id'];
				pdo_update(my_tablename('record', 0), $data, array('id' => $res['id']));
				pdo_query('update ' . my_tablename('user') . ' set balance=balance+' . $params['fee'] . ' , income=income+' . $params['fee'] . ' where uid=' . $res['origin_uid'] . ' and uniacid=' . $_W['uniacid']);
				pdo_query('update ' . my_tablename(($type == 2 ? 'video' : 'image')) . ' set show_times=show_times+1 where id=' . $res['relate_id'] . ' and uniacid=' . $_W['uniacid']);
				$settings = $this->module['config'];

				if (3 <= $_W['account']['level']) {
					$res['openid'] = $res['origin_openid'];
					$balance = pdo_fetchcolumn('SELECT balance FROM ' . my_tablename('user') . ' WHERE uid = :uid', array(':uid' => $res['origin_uid']));
					load()->classs('weixin.account');

					if (!empty($settings['notify_tpl']['income']) && $params['acid']) {
						$account = WeiXinAccount::create($params['acid']);
						$postdata['first'] = array('value' => '有人打赏了你的' . (($type == 2 ? '视频' : '图片')), 'color' => '#000000');
						$postdata['keyword1'] = array('value' => (($type == 2 ? '视频' : '图片')) . '打赏', 'color' => '#000000');
						$postdata['keyword2'] = array('value' => $params['fee'] . '元', 'color' => '#000000');
						$postdata['keyword3'] = array('value' => date('Y-m-d h:i', TIMESTAMP), 'color' => '#000000');
						$postdata['remark'] = array('value' => '当前余额：' . $balance . '元', 'color' => '#000000');
						$_W['siteroot'] = str_replace('/addons/' . MODULE_NAME, '', $_W['siteroot']);
						$account->sendTplNotice($res['openid'], $settings['notify_tpl']['income'], $postdata, $_W['siteroot'] . 'app/' . $this->createMobileUrl('user'));
						return;
					}


					$account = new WeiXinAccount($_W['account']);
					$account->sendCustomNotice(array(
	'touser'  => $res['openid'],
	'msgtype' => 'text',
	'text'    => array('content' => urlencode('有人打赏了你的' . (($type == 2 ? '视频' : '图片')) . "\n" . '收入金额：' . $params['fee'] . '元' . "\n" . '当前余额：' . $balance . '元'))
	));
				}

			}

		}

	}

	public function doMobileUser()
	{
		global $_W;
		global $_GPC;
		$settings = $this->module['config'];
		$user = user_info();
		$video_enable = false;
		$default_message = uni_setting($_W['uniacid'], array('default_message'));
		$default_message = $default_message['default_message'];

		if (!empty($default_message['shortvideo']) && ($default_message['shortvideo']['type'] == 'module') && ($default_message['shortvideo']['module'] == MODULE_NAME)) {
			$video_enable = true;
		}


		if (!empty($default_message['video']) && ($default_message['video']['type'] == 'module') && ($default_message['video']['module'] == MODULE_NAME)) {
			$video_enable = true;
		}


		$total_image = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . my_tablename('image') . ' WHERE uniacid =:uniacid and uid=:uid and status=1', array(':uid' => $user['uid'], ':uniacid' => $_W['uniacid']));

		if ($video_enable) {
			$total_video = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . my_tablename('video') . ' WHERE uniacid =:uniacid and uid=:uid and status=1', array(':uid' => $user['uid'], ':uniacid' => $_W['uniacid']));
		}


		include $this->template('user');
	}

	public function doMobileReview()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$type = ((intval($_GPC['type']) == 2 ? 2 : 1));
		$rescource = pdo_fetch('SELECT * FROM ' . my_tablename(($type == 2 ? 'video' : 'image')) . ' WHERE uniacid =:uniacid and id=:id ', array(':id' => $id, ':uniacid' => $_W['uniacid']));
		if (empty($rescource) || ($rescource['review'] == 1)) {
			$_GPC['style'] = 'safe_success';
			$_GPC['title'] = '审核完成';
			include $this->template('msg2');
			exit();
		}


		$settings = $this->module['config'];
		if (checksubmit('token') && $id && $rescource) {
			load()->classs('weixin.account');
			$accObj = new WeixinAccount($_W['account']);
			require MODULE_ROOT . 'Qiniu.class.php';
			$qiniu = new Qiniu($settings['qiniu']);

			if ($_GPC['review'] == 1) {
				pdo_update(my_tablename(($type == 2 ? 'video' : 'image'), 0), array('review' => 1), array('id' => $id, 'uniacid' => $_W['uniacid']));

				if ($type == 2) {
					$ops = 'imageMogr2/thumbnail/640x/blur/50x40|watermark/3/text/' . Qiniu\base64_urlSafeEncode(seconds_to_mmss(intval($rescource['duration']))) . '/fontsize/500/fill/I0VGRUZFRg==/dissolve/100/gravity/SouthEast/dx/10/dy/10/image/' . Qiniu\base64_urlSafeEncode(MODULE_URL . 'btn-play.png') . '/dissolve/100/gravity/Center|saveas/' . Qiniu\base64_urlSafeEncode($settings['qiniu']['bucket'] . ':' . '/video/' . $rescource['thumb'] . '!thumb');
					$callback_url = $_W['siteroot'] . 'addons/' . MODULE_NAME . '/qiniu_callback.php?type=video&id=' . $id;
					$qiniu->pfop('/video/' . $rescource['thumb'], $ops, $callback_url);
				}
				 else {
					$ops = 'imageMogr2/thumbnail/640x/blur/50x40|saveas/' . Qiniu\base64_urlSafeEncode($settings['qiniu']['bucket'] . ':' . $rescource['url'] . '!thumb') . ';imageMogr2/thumbnail/640x/blur/50x40/gravity/North/crop/120x120|saveas/' . Qiniu\base64_urlSafeEncode($settings['qiniu']['bucket'] . ':' . $rescource['url'] . '!icon');
					$callback_url = $_W['siteroot'] . 'addons/' . MODULE_NAME . '/qiniu_callback.php?id=' . $id;
					$qiniu->pfop($rescource['url'], $ops, $callback_url);
				}

				$accObj->sendCustomNotice(array(
	'touser'  => $rescource['origin_openid'],
	'msgtype' => 'text',
	'text'    => array('content' => '<a href="' . $_W['siteroot'] . 'app/' . $this->createMobileUrl('info', array('id' => $id, 'type' => $type)) . '">' . urlencode('此前提交的' . (($type == 2 ? '视频' : '图片')) . '审核成功，点击获取你的打赏' . (($type == 2 ? '视频' : '图'))) . '</a>')
	));
			}
			 else {
				pdo_delete(my_tablename(($type == 2 ? 'video' : 'image'), 0), array('id' => $id, 'uniacid' => $_W['uniacid']));

				if ($type == 2) {
					$qiniu->batchDelete(array('/video/' . $rescource['url'], '/video/' . $rescource['thumb']));
				}
				 else {
					$qiniu->delete($rescource['url']);
				}

				$accObj->sendCustomNotice(array(
	'touser'  => $rescource['origin_openid'],
	'msgtype' => 'text',
	'text'    => array('content' => urlencode('警告：此前提交的' . (($type == 2 ? '视频' : '图片')) . '违规！'))
	));
			}

			$_GPC['style'] = 'safe_success';
			$_GPC['title'] = '审核成功';
			include $this->template('msg2');
			exit();
		}


		include $this->template('review');
	}

	public function doWebHelp()
	{
		global $_W;
		global $_GPC;
		include $this->template('help');
	}

	public function doWebUser()
	{
		global $_W;
		global $_GPC;
		$uid = intval($_GPC['uid']);

		if ($_W['isajax']) {
			if ($uid) {
				pdo_update(my_tablename('user', 0), array('income' => intval($_GPC['income'])), array('uid' => $uid, 'uniacid' => $_W['uniacid']));
			}


			exit();
		}


		if (($_GPC['op'] == 'block') && (0 < $uid)) {
			pdo_update(my_tablename('user', 0), array('status' => 0), array('uid' => $uid, 'uniacid' => $_W['uniacid']));
			message('屏蔽成功', referer(), 'success');
		}


		if (($_GPC['op'] == 'resume') && (0 < $uid)) {
			pdo_update(my_tablename('user', 0), array('status' => 1), array('uid' => $uid, 'uniacid' => $_W['uniacid']));
			message('恢复成功', referer(), 'success');
		}


		$pindex = max(1, intval($_GPC['page']));
		$psize = 30;

		if (!empty($_GPC['nickname'])) {
			$condition = 'nickname like \'%' . $_GPC['nickname'] . '%\'';
		}
		 else {
			$condition = 'nickname <> \'\'';
		}

		$list = pdo_fetchall('SELECT * FROM ' . my_tablename('user') . ' WHERE uniacid =:uniacid and ' . $condition . ' and headimgurl <> \'\' ORDER BY uid  DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, array(':uniacid' => $_W['uniacid']));
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . my_tablename('user') . ' WHERE  uniacid =:uniacid and ' . $condition . ' and headimgurl <> \'\'', array(':uniacid' => $_W['uniacid']));
		$pager = pagination($total, $pindex, $psize);
		include $this->template('user');
	}

	public function doWebUser_post()
	{
		global $_W;
		global $_GPC;
		$settings = $this->module['config'];
		$uid = intval($_GPC['uid']);
		$type = ((intval($_GPC['type']) == 2 ? 'video' : 'image'));
		$user = pdo_fetch('SELECT * FROM ' . my_tablename('user') . ' WHERE uniacid=:uniacid and  uid = :uid', array(':uniacid' => $_W['uniacid'], ':uid' => $uid));
		$pindex = max(1, intval($_GPC['page']));
		$psize = 30;
		$list = pdo_fetchall('SELECT * FROM ' . my_tablename($type) . ' WHERE uniacid =:uniacid and uid=:uid and status=1 ORDER BY id  DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, array(':uniacid' => $_W['uniacid'], ':uid' => $uid));
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . my_tablename($type) . ' WHERE  uniacid =:uniacid and uid=:uid and status=1', array(':uniacid' => $_W['uniacid'], ':uid' => $uid));
		$pager = pagination($total, $pindex, $psize);
		include $this->template('user_post');
	}

	public function doWebImage()
	{
		global $_W;
		global $_GPC;
		$settings = $this->module['config'];
		$id = intval($_GPC['id']);

		if (($_GPC['op'] == 'delete') && (0 < $id)) {
			$image = pdo_fetch('SELECT * FROM ' . my_tablename('image') . ' WHERE uniacid =:uniacid  and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $id));

			if ($image) {
				require MODULE_ROOT . 'Qiniu.class.php';
				pdo_delete(my_tablename('image', 0), array('id' => $id, 'uniacid' => $_W['uniacid']));
				$qiniu = new Qiniu($settings['qiniu']);
				$qiniu->batchDelete(array($image['url'], $image['url'] . '!icon', $image['url'] . '!thumb'));
				message('删除成功！', referer(), 'success');
			}

		}


		$pindex = max(1, intval($_GPC['page']));
		$psize = 30;
		$list = pdo_fetchall('SELECT a.*,b.nickname,b.headimgurl FROM ' . my_tablename('image') . ' as a Inner join ' . my_tablename('user') . ' as b on a.uid=b.uid WHERE a.uniacid =:uniacid and a.uid>0 ORDER BY a.id  DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, array(':uniacid' => $_W['uniacid']));
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . my_tablename('image') . ' WHERE  uniacid =:uniacid and uid>0', array(':uniacid' => $_W['uniacid']));
		$pager = pagination($total, $pindex, $psize);
		include $this->template('image');
	}

	public function doWebVideo()
	{
		global $_W;
		global $_GPC;
		$settings = $this->module['config'];
		$id = intval($_GPC['id']);

		if (($_GPC['op'] == 'delete') && (0 < $id)) {
			$video = pdo_fetch('SELECT * FROM ' . my_tablename('video') . ' WHERE uniacid =:uniacid  and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $id));

			if ($video) {
				require MODULE_ROOT . 'Qiniu.class.php';
				pdo_delete(my_tablename('video', 0), array('id' => $id, 'uniacid' => $_W['uniacid']));
				$qiniu = new Qiniu($settings['qiniu']);
				$qiniu->batchDelete(array('/video/' . $video['url'], '/video/' . $video['thumb'], '/video/' . $video['thumb'] . '!thumb'));
				message('删除成功！', referer(), 'success');
			}

		}


		$pindex = max(1, intval($_GPC['page']));
		$psize = 30;
		$list = pdo_fetchall('SELECT a.*,b.nickname,b.headimgurl FROM ' . my_tablename('video') . ' as a Inner join ' . my_tablename('user') . ' as b on a.uid=b.uid WHERE a.uniacid =:uniacid and a.uid>0 ORDER BY a.id  DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, array(':uniacid' => $_W['uniacid']));
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . my_tablename('video') . ' WHERE  uniacid =:uniacid and uid>0', array(':uniacid' => $_W['uniacid']));
		$pager = pagination($total, $pindex, $psize);
		include $this->template('video');
	}

	public function doWebPlay_video()
	{
		global $_W;
		global $_GPC;
		include $this->template('play_video');
	}

	public function doWebEdit()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$type = ((intval($_GPC['type']) == 2 ? 'video' : 'image'));
		$rescource = pdo_fetch('SELECT * from ' . my_tablename($type) . ' WHERE uniacid =:uniacid  and id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $id));
		if ($rescource && checksubmit()) {
			pdo_update(my_tablename($type, 0), array('show_times' => intval($_GPC['show_times']), 'up' => intval($_GPC['up']), 'down' => intval($_GPC['down'])), array('id' => $rescource['id']));
			message('修改成功', referer());
		}


		include $this->template('edit');
	}

	public function doWebRecord()
	{
		global $_W;
		global $_GPC;
		$id = intval($_GPC['id']);
		$type = ((intval($_GPC['type']) == 2 ? 'video' : 'image'));

		if ($_GPC['op'] == 'refund') {
			$record = pdo_fetch('SELECT a.*,b.uid as origin_uid FROM ' . my_tablename('record') . ' as a left join ' . my_tablename($type) . ' as b on a.relate_id=b.id  WHERE a.uniacid =:uniacid  and a.id=:id', array(':uniacid' => $_W['uniacid'], ':id' => $id));
			if ($record && ($record['status'] == 1)) {
				$user = pdo_fetch('SELECT * FROM ' . my_tablename('user') . ' WHERE uniacid =:uniacid  and uid=:uid', array(':uniacid' => $_W['uniacid'], ':uid' => $record['origin_uid']));
				if (empty($user) || ($user['balance'] < $record['fee'])) {
					message('错误：用户余额不足', referer(), 'error');
				}


				$settings = $this->module['config'];
				$path = ATTACHMENT_ROOT . '/' . MODULE_NAME . '/cert';
				$wechat = $settings['wechat'];
				$wechat['rootca'] = $path . '/rootca.pem.' . $_W['uniacid'];
				$wechat['apiclient_key'] = $path . '/apiclient_key.pem.' . $_W['uniacid'];
				$wechat['apiclient_cert'] = $path . '/apiclient_cert.pem.' . $_W['uniacid'];

				if (empty($record['out_refund_no'])) {
					$record['out_refund_no'] = $_W['uniacid'] . TIMESTAMP . random(4, 1);
					pdo_update(my_tablename('record', 0), array('out_refund_no' => $record['out_refund_no']), array('id' => $record['id']));
				}


				$params = array('fee' => $record['fee'], 'out_refund_no' => $record['out_refund_no']);

				if (!empty($record['transaction_id'])) {
					$params['transaction_id'] = $record['transaction_id'];
				}
				 else {
					$params['out_trade_no'] = $record['tid'];
				}

				$ret = wx_refund($params, $wechat);

				if (is_error($ret)) {
					message('错误：' . $ret['message'], referer(), 'error');
				}
				 else {
					pdo_query('update ' . my_tablename('user') . ' set balance=balance-' . $record['fee'] . ', income=income-' . $record['fee'] . ' where uid=' . $user['uid'] . ' and uniacid=' . $_W['uniacid']);
					pdo_update(my_tablename('record', 0), array('status' => 2), array('id' => $record['id']));
					message('退款成功！', referer(), 'success');
				}
			}

		}


		$pindex = max(1, intval($_GPC['page']));
		$psize = 30;
		$list = pdo_fetchall('SELECT a.*,b.nickname,b.headimgurl FROM ' . my_tablename('record') . ' as a Inner join ' . my_tablename('user') . ' as b on a.uid=b.uid WHERE a.uniacid =:uniacid and a.relate_id=:relate_id and a.status <> 0 ORDER BY a.id  DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, array(':uniacid' => $_W['uniacid'], ':relate_id' => $id));
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . my_tablename('record') . ' WHERE  uniacid =:uniacid and relate_id=:relate_id and status <> 0', array(':uniacid' => $_W['uniacid'], ':relate_id' => $id));
		$pager = pagination($total, $pindex, $psize);
		include $this->template('record');
	}

	public function doWebCash()
	{
		global $_W;
		global $_GPC;
		$status = intval($_GPC['status']);

		if (($_GPC['op'] == 'do') && (0 < intval($_GPC['id']))) {
			$cash = pdo_fetch('SELECT * FROM ' . my_tablename('cash') . ' WHERE uniacid =:uniacid and id=:id ', array(':id' => intval($_GPC['id']), ':uniacid' => $_W['uniacid']));

			if ($cash['status'] != 1) {
				$settings = $this->module['config'];
				$path = ATTACHMENT_ROOT . '/' . MODULE_NAME . '/cert';
				$wechat = $settings['wechat'];
				$wechat['rootca'] = $path . '/rootca.pem.' . $_W['uniacid'];
				$wechat['apiclient_key'] = $path . '/apiclient_key.pem.' . $_W['uniacid'];
				$wechat['apiclient_cert'] = $path . '/apiclient_cert.pem.' . $_W['uniacid'];
				$params = array('openid' => $cash['openid'], 'fee' => $cash['amount'], 'trade_no' => $cash['trade_no'], 'desc' => '提现' . $cash['fee'] . '元，手续费' . ($cash['fee'] - $cash['amount']) . '元');
				$ret = wx_pay($params, $wechat);

				if (is_error($ret)) {
					message('错误：' . $ret['message'], referer(), 'error');
				}
				 else {
					pdo_update(my_tablename('cash', 0), array('payment_no' => $ret['payment_no'], 'payment_time' => $ret['payment_time'], 'status' => 1), array('id' => $cash['id']));

					if (!empty($settings['oauth']['force'])) {
						$cash['openid'] = pdo_fetchcolumn('SELECT origin_openid FROM ' . my_tablename('user') . ' WHERE uniacid = :uniacid and uid=:uid', array(':uniacid' => $_W['uniacid'], ':uid' => $cash['uid']));
					}


					if (3 <= $_W['account']['level']) {
						load()->classs('weixin.account');

						if (!empty($settings['notify_tpl']['cash']) && ($_W['account']['level'] == 4)) {
							$account = new WeiXinAccount($_W['account']);
							$postdata['first'] = array('value' => '你的提现操作已完成', 'color' => '#000000');
							$postdata['keyword1'] = array('value' => $cash['fee'] . '元', 'color' => '#000000');
							$postdata['keyword2'] = array('value' => date('Y-m-d h:i', TIMESTAMP), 'color' => '#000000');
							$postdata['remark'] = array('value' => '扣手续费：' . ($cash['fee'] - $cash['amount']) . '元', 'color' => '#000000');
							$account->sendTplNotice($cash['openid'], $settings['notify_tpl']['cash'], $postdata, $_W['siteroot'] . 'app/' . $this->createMobileUrl('user'));
						}
						 else if ($_W['account']['level'] == 3) {
							$account = new WeiXinAccount($_W['account']);
							$account->sendCustomNotice(array(
	'touser'  => $cash['openid'],
	'msgtype' => 'text',
	'text'    => array('content' => urlencode('你的提现操作已完成' . "\n" . '提现金额：' . $cash['fee'] . '元' . "\n" . '扣手续费：' . ($cash['fee'] - $cash['amount']) . '元'))
	));
						}

					}


					message('提现成功！', referer(), 'success');
				}
			}

		}


		if (in_array($status, array(0, 1, 2))) {
			$pindex = max(1, intval($_GPC['page']));
			$psize = 30;
			$list = pdo_fetchall('SELECT a.*,b.nickname,b.headimgurl FROM ' . my_tablename('cash') . ' as a Inner join ' . my_tablename('user') . ' as b on a.uid=b.uid WHERE a.uniacid =:uniacid and a.status=:status ORDER BY a.id  DESC LIMIT ' . (($pindex - 1) * $psize) . ',' . $psize, array(':uniacid' => $_W['uniacid'], 'status' => $status));
			$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . my_tablename('cash') . ' WHERE  uniacid =:uniacid and status=:status', array(':uniacid' => $_W['uniacid'], 'status' => $status));
			$pager = pagination($total, $pindex, $psize);
			include $this->template('cash');
		}

	}

	public function doWebWx_tpl()
	{
		global $_W;
		global $_GPC;
		if ($_W['isajax'] && !empty($_GPC['template_id_short']) && ($_W['account']['level'] == 4)) {
			load()->classs('weixin.account');
			$account = new WeiXinAccount($_W['account']);
			$token = $account->getAccessToken();

			if (is_error($token)) {
				exit('error:' . $token['message']);
			}


			$data = json_encode(array('template_id_short' => trim($_GPC['template_id_short'])));
			$post_url = 'https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token=' . $token;
			$response = ihttp_request($post_url, $data);

			if (!is_error($response)) {
				$result = @json_decode($response['content'], true);

				if (!empty($result) && !empty($result['template_id'])) {
					echo $result['template_id'];
					return;
				}


				exit('error:' . $result['errmsg']);
				return;
			}


			exit('error:' . $token['message']);
			return;
		}


		exit('error:account level is ' . $_W['account']['level']);
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

function user_info($base = 0)
{
	global $_W;
	global $site;

	if (!strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
		message('请使用微信浏览器打开！');
	}


	$settings = $site->module['config'];

	if (!empty($settings['oauth']['force'])) {
		define('OAUTH_FORCE', true);
	}


	$fan = array('openid' => not_empty_var($_W['openid'], $_W['fans']['openid']), 'nickname' => not_empty_var($_W['fans']['nickname'], $_W['fans']['tag']['nickname']), 'headimgurl' => not_empty_var($_W['fans']['avatar'], $_W['fans']['headimgurl'], $_W['fans']['tag']['avatar']));

	if (($base == 0) && (empty($fan['nickname']) || empty($fan['headimgurl']))) {
		$fan = mc_oauth_userinfo();
	}
	 else {
		if (defined('OAUTH_FORCE') || ($base == 1)) {
			$openid = $_SESSION[MODULE_NAME . '_openid'][$_W['uniacid']];

			if (empty($openid)) {
				load()->classs('weixin.account');
				$accObj = new WeixinAccount($settings['oauth']);
				$ret = $accObj->getOauthInfo();

				if (!is_error($ret)) {
					$openid = $_SESSION[MODULE_NAME . '_openid'][$_W['uniacid']] = $ret['openid'];
				}

			}


			$fan['openid'] = $openid;
		}

	}

	if (empty($fan) || empty($fan['openid'])) {
		message('必须在微信浏览器打开, 或者必须设置oAuth参数');
	}


	$sql = 'SELECT * FROM ' . my_tablename('user') . ' WHERE `uniacid`=:uniacid and `openid`=:openid';
	$pars = array();
	$pars[':openid'] = $fan['openid'];
	$pars[':uniacid'] = $_W['uniacid'];
	$res = pdo_fetch($sql, $pars);

	if (empty($res)) {
		$data = array();

		if (!empty($fan['headimgurl']) && (substr($fan['headimgurl'], -2) == '/0')) {
			$fan['headimgurl'] = rtrim($fan['headimgurl'], '0');
			$fan['headimgurl'] .= '132';
		}


		$data['uniacid'] = $_W['uniacid'];
		$data['update_time'] = TIMESTAMP;
		$data['openid'] = $fan['openid'];
		$data['nickname'] = $fan['nickname'];
		$data['headimgurl'] = $fan['headimgurl'];

		if (pdo_insert(my_tablename('user', 0), $data)) {
			$fan['uid'] = pdo_insertid();
		}
		 else {
			exit('pdo_insert error!');
		}
	}
	 else {
		if ($res['status'] == 0) {
			message('你已被屏蔽');
		}


		if (!empty($fan['nickname']) && !empty($fan['headimgurl'])) {
			if (empty($res['nickname']) || empty($res['headimgurl']) || ((3600 * 24 * 3) < (TIMESTAMP - $res['update_time']))) {
				pdo_update(my_tablename('user', 0), array('update_time' => TIMESTAMP, 'nickname' => $fan['nickname'], 'headimgurl' => $fan['headimgurl']), array('uid' => $res['uid']));
			}

		}


		$fan = array_merge($fan, $res);
	}

	return $fan;
}

function QRimage($frame, $pixelPerPoint = 4, $outerFrame = 4)
{
	$h = count($frame);
	$w = strlen($frame[0]);
	$imgW = $w + (2 * $outerFrame);
	$imgH = $h + (2 * $outerFrame);
	$base_image = ImageCreate($imgW, $imgH);
	$col[0] = ImageColorAllocate($base_image, 255, 255, 255);
	$col[1] = ImageColorAllocate($base_image, 0, 0, 0);
	imagefill($base_image, 0, 0, $col[0]);
	$y = 0;

	while ($y < $h) {
		$x = 0;

		while ($x < $w) {
			if ($frame[$y][$x] == '1') {
				ImageSetPixel($base_image, $x + $outerFrame, $y + $outerFrame, $col[1]);
			}


			++$x;
		}

		++$y;
	}

	$target_image = ImageCreate($imgW * $pixelPerPoint, $imgH * $pixelPerPoint);
	ImageCopyResized($target_image, $base_image, 0, 0, 0, 0, $imgW * $pixelPerPoint, $imgH * $pixelPerPoint, $imgW, $imgH);
	ImageDestroy($base_image);
	return $target_image;
}

function not_empty_var()
{
	$args = func_get_args();

	foreach ($args as $key => $value ) {
		if (!empty($value)) {
			return $value;
		}
	}

	return false;
}

function wechat_build($params, $wechat)
{
	global $_W;
	load()->func('communication');
	$wOpt = array();
	$package = array();
	$package['appid'] = $wechat['appid'];
	$package['mch_id'] = $wechat['mchid'];
	$package['nonce_str'] = random(8);
	$package['body'] = $params['title'];
	$package['attach'] = $_W['uniacid'];
	$package['out_trade_no'] = $params['tid'];
	$package['total_fee'] = $params['fee'] * 100;
	$package['spbill_create_ip'] = CLIENT_IP;
	$package['time_start'] = date('YmdHis', TIMESTAMP);
	$package['time_expire'] = date('YmdHis', TIMESTAMP + 600);
	$package['notify_url'] = $_W['siteroot'] . 'addons/' . MODULE_NAME . '/wechat_notify.php';
	$package['trade_type'] = 'JSAPI';
	$package['openid'] = $params['openid'];
	ksort($package, SORT_STRING);
	$string1 = '';

	foreach ($package as $key => $v ) {
		if (empty($v)) {
			continue;
		}


		$string1 .= $key . '=' . $v . '&';
	}

	$string1 .= 'key=' . $wechat['signkey'];
	$package['sign'] = strtoupper(md5($string1));
	$dat = array2xml($package);
	$response = ihttp_request('https://api.mch.weixin.qq.com/pay/unifiedorder', $dat);

	if (is_error($response)) {
		return $response;
	}


	$xml = @isimplexml_load_string($response['content'], 'SimpleXMLElement', LIBXML_NOCDATA);

	if (strval($xml->return_code) == 'FAIL') {
		return error(-1, strval($xml->return_msg));
	}


	if (strval($xml->result_code) == 'FAIL') {
		return error(-1, strval($xml->err_code) . ': ' . strval($xml->err_code_des));
	}


	$prepayid = $xml->prepay_id;
	$wOpt['appId'] = $wechat['appid'];
	$wOpt['timeStamp'] = TIMESTAMP;
	$wOpt['nonceStr'] = random(8);
	$wOpt['package'] = 'prepay_id=' . $prepayid;
	$wOpt['signType'] = 'MD5';
	ksort($wOpt, SORT_STRING);

	foreach ($wOpt as $key => $v ) {
		$string .= $key . '=' . $v . '&';
	}

	$string .= 'key=' . $wechat['signkey'];
	$wOpt['paySign'] = strtoupper(md5($string));
	return $wOpt;
}

function wx_queryOrder($tid, $wechat, $type = 2)
{
	load()->classs('pay');
	$pay = Pay::create();
	$pay->appid = $wechat['appid'];
	$pay->mch_id = $wechat['mchid'];
	$pay->key = $wechat['signkey'];
	return $pay->queryOrder($tid, $type);
}

function wx_refund($params, $wechat)
{
	global $_W;
	global $_GPC;
	$url = 'https://api.mch.weixin.qq.com/secapi/pay/refund';
	$pars = array();
	$pars['appid'] = $wechat['appid'];
	$pars['nonce_str'] = random(32);
	$pars['op_user_id'] = $wechat['mchid'];
	$pars['mch_id'] = $wechat['mchid'];
	$pars['out_refund_no'] = $params['out_refund_no'];
	$pars['refund_fee'] = $params['fee'] * 100;
	$pars['total_fee'] = $params['fee'] * 100;

	if (!empty($params['transaction_id'])) {
		$pars['transaction_id'] = $params['transaction_id'];
	}
	 else {
		$pars['out_trade_no'] = $params['out_trade_no'];
	}

	ksort($pars, SORT_STRING);
	$string1 = '';

	foreach ($pars as $k => $v ) {
		$string1 .= $k . '=' . $v . '&';
	}

	$string1 .= 'key=' . $wechat['signkey'];
	$pars['sign'] = strtoupper(md5($string1));
	$xml = array2xml($pars);
	$extras = array();
	$extras['CURLOPT_CAINFO'] = $wechat['rootca'];
	$extras['CURLOPT_SSLCERT'] = $wechat['apiclient_cert'];
	$extras['CURLOPT_SSLKEY'] = $wechat['apiclient_key'];
	load()->func('communication');
	$resp = ihttp_request($url, $xml, $extras);

	if (is_error($resp)) {
		return $resp;
	}


	$xml = @isimplexml_load_string($resp['content'], 'SimpleXMLElement', LIBXML_NOCDATA);

	if (strval($xml->return_code) == 'FAIL') {
		return error(-1, strval($xml->return_msg));
	}


	if (strval($xml->result_code) == 'FAIL') {
		return error(-1, strval($xml->err_code) . ': ' . strval($xml->err_code_des));
	}


	$out_refund_no = $xml->out_refund_no;
	return $out_refund_no;
}

function wx_pay($params, $wechat)
{
	global $_W;
	global $_GPC;
	$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
	$pars = array();
	$pars['mch_appid'] = $wechat['appid'];
	$pars['nonce_str'] = random(32);
	$pars['partner_trade_no'] = $params['trade_no'];
	$pars['mchid'] = $wechat['mchid'];
	$pars['openid'] = $params['openid'];
	$pars['check_name'] = 'NO_CHECK';
	$pars['amount'] = $params['fee'] * 100;
	$pars['desc'] = $params['desc'];
	$pars['spbill_create_ip'] = CLIENT_IP;
	ksort($pars, SORT_STRING);
	$string1 = '';

	foreach ($pars as $k => $v ) {
		$string1 .= $k . '=' . $v . '&';
	}

	$string1 .= 'key=' . $wechat['signkey'];
	$pars['sign'] = strtoupper(md5($string1));
	$xml = array2xml($pars);
	$extras = array();
	$extras['CURLOPT_CAINFO'] = $wechat['rootca'];
	$extras['CURLOPT_SSLCERT'] = $wechat['apiclient_cert'];
	$extras['CURLOPT_SSLKEY'] = $wechat['apiclient_key'];
	load()->func('communication');
	$procResult = NULL;
	$resp = ihttp_request($url, $xml, $extras);

	if (is_error($resp)) {
		$procResult = $resp;
	}
	 else {
		$xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
		$dom = new DOMDocument();

		if ($dom->loadXML($xml)) {
			$xpath = new DOMXPath($dom);
			$code = $xpath->evaluate('string(//xml/return_code)');
			$ret = $xpath->evaluate('string(//xml/result_code)');

			if ((strtolower($code) == 'success') && (strtolower($ret) == 'success')) {
				$payment_no = $xpath->evaluate('string(//xml/payment_no)');
				$payment_time = $xpath->evaluate('string(//xml/payment_time)');
				$procResult = array('payment_no' => $payment_no, 'payment_time' => strtotime($payment_time));
			}
			 else {
				$error = $xpath->evaluate('string(//xml/err_code_des)');
				$procResult = error(-2, $error);
			}
		}
		 else {
			$procResult = error(-1, 'error response');
		}
	}

	return $procResult;
}

function seconds_to_mmss($duration)
{
	return sprintf('%d:%02d', $duration / 60, $duration % 60);
}

function http_request_socket($url, $post = '', $extra = array(), $wait = true, $timeout = 60)
{
	$urlset = parse_url($url);

	if (empty($urlset['path'])) {
		$urlset['path'] = '/';
	}


	if (!empty($urlset['query'])) {
		$urlset['query'] = '?' . $urlset['query'];
	}


	if (empty($urlset['port'])) {
		$urlset['port'] = (($urlset['scheme'] == 'https' ? '443' : '80'));
	}


	$method = ((empty($post) ? 'GET' : 'POST'));
	$fdata = $method . ' ' . $urlset['path'] . $urlset['query'] . ' HTTP/1.1' . "\r\n";

	if (!empty($extra['Host'])) {
		$fdata .= 'Host: ' . $extra['Host'] . "\r\n";
	}
	 else {
		$fdata .= 'Host: ' . $urlset['host'] . "\r\n";
	}

	$fdata .= 'Connection: close' . "\r\n";

	if (!empty($extra) && is_array($extra)) {
		foreach ($extra as $opt => $value ) {
			if (!strexists($opt, 'CURLOPT_') && ($opt != 'Host')) {
				$fdata .= $opt . ': ' . $value . "\r\n";
			}

		}
	}


	$body = '';

	if ($post) {
		if (is_array($post)) {
			$body = http_build_query($post);
		}
		 else {
			$body = urlencode($post);
		}

		$fdata .= 'Content-Length: ' . strlen($body) . "\r\n\r\n" . $body;
	}
	 else {
		$fdata .= "\r\n";
	}

	if ($urlset['scheme'] == 'https') {
		$fp = fsockopen('ssl://' . $urlset['host'], $urlset['port'], $errno, $error);
	}
	 else {
		$fp = fsockopen($urlset['host'], $urlset['port'], $errno, $error);
	}

	if (!$fp) {
		return false;
	}
	if ($wait) {
		stream_set_blocking($fp, true);
		stream_set_timeout($fp, $timeout);
		fwrite($fp, $fdata);
		$content = '';

		while (!feof($fp)) {
			$content .= fgets($fp, 512);
		}

		fclose($fp);
		return $content;
	}


	fwrite($fp, $fdata);
	fclose($fp);
	return true;
}

//黑锐站长论坛独家解密bbs_heirui_cN
?>