<?php
require '../../framework/bootstrap.inc.php';
set_time_limit(0);
ignore_user_abort(true);
define('MODULE_NAME', 'czt_tushang');
define('MODULE_ROOT', IA_ROOT . '/addons/' . MODULE_NAME . '/');
require MODULE_ROOT . 'global.php';
require MODULE_ROOT . 'Qiniu.class.php';
global $_W;
global $_GPC;
$post = $_GPC;
$_W['uniacid'] = $post['uniacid'];
$_W['siteroot'] = str_replace('/addons/' . MODULE_NAME, '', $_W['siteroot']);
define('MODULE_URL', $_W['siteroot'] . 'addons/' . MODULE_NAME . '/');
load()->classs('weixin.account');
$accObj = new WeixinAccount($post['account']);
$token = $accObj->getAccessToken();
$url = 'http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=' . $token . '&media_id=' . $post['mediaid'];
$qiniu = new Qiniu($post['qiniu']);
$post['mediaid'] .= '.mp4';
$ret = $qiniu->fetch($url, '/video/' . $post['mediaid']);

if ($ret === true) {
	$token = $accObj->getAccessToken();
	$url = 'http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=' . $token . '&media_id=' . $post['thumbmediaid'];
	$ret = $qiniu->fetch($url, '/video/' . $post['thumbmediaid']);

	if ($ret === true) {
		load()->func('communication');
		$review = false;

		if ($post['qiniu']['video_nrop'] == 1) {
			$ret = ihttp_get($post['qiniu']['host'] . '/video/' . $post['mediaid'] . '?tupu-video/nrop');

			if ($ret['code'] == 200) {
				$ret = json_decode($ret['content'], true);

				if ($ret['code'] == 0) {
					if (($ret['label'] == 0) && ($ret['review'] === false)) {
						$qiniu->batchDelete(array('/video/' . $post['mediaid'], '/video/' . $post['thumbmediaid']));
						$ret_text = '警告：该视频违规！';
					}


					if (($ret['label'] == 0) && ($ret['review'] === true)) {
						$review = true;
					}

				}
				 else {
					$ret_text = '接口请求错误：' . $ret['code'];
				}
			}
			 else {
				$ret_text = '接口请求错误：0';
			}

			if (!empty($ret_text)) {
				$accObj->sendCustomNotice(array(
	'touser'  => $post['openid'],
	'msgtype' => 'text',
	'text'    => array('content' => urlencode($ret_text))
	));
				return;
			}

		}


		$ret = ihttp_get($post['qiniu']['host'] . '/video/' . $post['mediaid'] . '?avinfo');

		if ($ret['code'] == 200) {
			$ret = json_decode($ret['content'], true);
			pdo_insert(my_tablename('video', 0), array('uniacid' => $post['uniacid'], 'url' => $post['mediaid'], 'thumb' => $post['thumbmediaid'], 'openid' => $post['openid'], 'origin_openid' => $post['openid'], 'duration' => intval($ret['format']['duration']), 'create_time' => TIMESTAMP));
			$id = pdo_insertid();

			if ($id) {
				if ($review && !empty($accObj) && !empty($post['admin_openid'])) {
					if (($post['account']['level'] == 4) && !empty($post['notify_tpl']['notice'])) {
						$postdata['first'] = array('value' => '有视频(ID:' . $id . ')需要人工审核', 'color' => '#000000');
						$postdata['keyword1'] = array('value' => '视频审核', 'color' => '#000000');
						$postdata['keyword2'] = array('value' => '系统通知', 'color' => '#000000');
						$postdata['keyword3'] = array('value' => date('Y-m-d h:i', TIMESTAMP), 'color' => '#000000');
						$postdata['remark'] = array('value' => '点击详情进行审核', 'color' => '#000000');
						$accObj->sendTplNotice($post['admin_openid'], $post['notify_tpl']['notice'], $postdata, $_W['siteroot'] . 'app/' . createMobileUrl('review', array('id' => $id, 'type' => 2)));
					}
					 else {
						$accObj->sendCustomNotice(array(
	'touser'  => $post['admin_openid'],
	'msgtype' => 'text',
	'text'    => array('content' => '<a href="' . $_W['siteroot'] . 'app/' . createMobileUrl('review', array('id' => $id, 'type' => 2)) . '">' . urlencode('有视频(ID:' . $id . ')需要人工审核，请点击') . '</a>')
	));
					}

					$accObj->sendCustomNotice(array(
	'touser'  => $post['openid'],
	'msgtype' => 'text',
	'text'    => array('content' => urlencode('该视频需要管理员审核，请耐心等待。'))
	));
					return;
				}


				$ops = 'imageMogr2/thumbnail/640x/blur/50x40|watermark/3/text/' . Qiniu\base64_urlSafeEncode(seconds_to_mmss(intval($ret['format']['duration']))) . '/fontsize/500/fill/I0VGRUZFRg==/dissolve/100/gravity/SouthEast/dx/10/dy/10/image/' . Qiniu\base64_urlSafeEncode(MODULE_URL . 'btn-play.png') . '/dissolve/100/gravity/Center|saveas/' . Qiniu\base64_urlSafeEncode($post['qiniu']['bucket'] . ':' . '/video/' . $post['thumbmediaid'] . '!thumb');
				$callback_url = $_W['siteroot'] . 'addons/' . MODULE_NAME . '/qiniu_callback.php?type=video&id=' . $id;
				$qiniu->pfop('/video/' . $post['thumbmediaid'], $ops, $callback_url);
				$accObj->sendCustomNotice(array(
	'touser'  => $post['openid'],
	'msgtype' => 'text',
	'text'    => array('content' => '<a href="' . $_W['siteroot'] . 'app/' . createMobileUrl('info', array('type' => 2, 'id' => $id)) . '">' . urlencode('点击获取你的打赏视频') . '</a>')
	));
				return 1;
			}

		}
		 else {
			$accObj->sendCustomNotice(array(
	'touser'  => $post['openid'],
	'msgtype' => 'text',
	'text'    => array('content' => 'avinfo error')
	));
		}
	}

}

function createMobileUrl($do, $query = array(), $noredirect = true)
{
	global $_W;
	$query['do'] = $do;
	$query['m'] = MODULE_NAME;
	return murl('entry', $query, $noredirect);
}

function seconds_to_mmss($duration)
{
	return sprintf('%d:%02d', $duration / 60, $duration % 60);
}


?>