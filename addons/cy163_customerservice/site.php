<?php

//decode by QQ:3213288469 http://www.zheyitianshi.com/
defined('IN_IA') or die('Access Denied');
define('MD_ROOT', '../addons/cy163_customerservice/');
define('BEST_SET', 'messikefu_set');
define('BEST_TPLMESSAGE_SENDLOG', 'messikefu_tplmessage_sendlog');
define('BEST_TPLMESSAGE_TPLLIST', 'messikefu_tplmessage_tpllist');
define('BEST_CHAT', 'messikefu_chat');
define('BEST_CSERVICE', 'messikefu_cservice');
class Cy163_customerserviceModuleSite extends WeModuleSite
{
	public $setting = '';
	public function __construct()
	{
		global $_W;
		$this->setting = pdo_fetch("SELECT * FROM " . tablename(BEST_SET) . " WHERE weid = {$_W['uniacid']}");
	}
	public function doWebSetting()
	{
		global $_W, $_GPC;
		$op = trim($_GPC['op']);
		if ($op == 'post') {
			$id = intval($_GPC['id']);
			$data = array('weid' => $_W['uniacid'], 'title' => trim($_GPC['title']), 'istplon' => intval($_GPC['istplon']), 'unfollowtext' => trim($_GPC['unfollowtext']), 'followqrcode' => trim($_GPC['followqrcode']), 'sharetitle' => trim($_GPC['sharetitle']), 'sharedes' => trim($_GPC['sharedes']), 'sharethumb' => trim($_GPC['sharethumb']), 'kefutplminute' => intval($_GPC['kefutplminute']), 'bgcolor' => trim($_GPC['bgcolor']), 'defaultavatar' => trim($_GPC['defaultavatar']));
			if (!empty($id)) {
				pdo_update(BEST_SET, $data, array('id' => $id, 'weid' => $_W['uniacid']));
			} else {
				pdo_insert(BEST_SET, $data);
			}
			message('操作成功！', $this->createWebUrl('setting', array('op' => 'display')), 'success');
		} else {
			$setting = $this->setting;
			include $this->template('web/set');
		}
	}
	public function doWebCservice()
	{
		global $_GPC, $_W;
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if ($operation == 'display') {
			if (!empty($_GPC['displayorder'])) {
				foreach ($_GPC['displayorder'] as $id => $displayorder) {
					pdo_update(BEST_CSERVICE, array('displayorder' => $displayorder), array('id' => $id, 'weid' => $_W['uniacid']));
				}
				message('客服排序更新成功！', $this->createWebUrl('cservice', array('op' => 'display')), 'success');
			}
			$cservicelist = pdo_fetchall("SELECT * FROM " . tablename(BEST_CSERVICE) . " WHERE weid = '{$_W['uniacid']}' ORDER BY displayorder ASC");
			include $this->template('web/cservice');
		} elseif ($operation == 'post') {
			$id = intval($_GPC['id']);
			if (!empty($id)) {
				$cservice = pdo_fetch("SELECT * FROM " . tablename(BEST_CSERVICE) . " WHERE id = :id AND weid = :weid", array(':id' => $id, ':weid' => $_W['uniacid']));
			}
			if (checksubmit('submit')) {
				if (empty($_GPC['name'])) {
					message('抱歉，请输入客服名称！');
				}
				if (empty($_GPC['ctype'])) {
					message('抱歉，请选择客服类型！');
				}
				if (empty($_GPC['content'])) {
					message('抱歉，请输入客服内容！');
				}
				if (empty($_GPC['thumb'])) {
					message('抱歉，请上传客服头像！');
				}
				$data = array('weid' => $_W['uniacid'], 'name' => trim($_GPC['name']), 'ctype' => intval($_GPC['ctype']), 'content' => trim($_GPC['content']), 'thumb' => $_GPC['thumb'], 'displayorder' => intval($_GPC['displayorder']));
				if (!empty($id)) {
					pdo_update(BEST_CSERVICE, $data, array('id' => $id, 'weid' => $_W['uniacid']));
				} else {
					pdo_insert(BEST_CSERVICE, $data);
				}
				message('操作成功！', $this->createWebUrl('cservice', array('op' => 'display')), 'success');
			}
			include $this->template('web/cservice');
		} elseif ($operation == 'delete') {
			$id = intval($_GPC['id']);
			$cservice = pdo_fetch("SELECT id FROM " . tablename(BEST_CSERVICE) . " WHERE id = {$id}");
			if (empty($cservice)) {
				message('抱歉，该客服信息不存在或是已经被删除！', $this->createWebUrl('cservice', array('op' => 'display')), 'error');
			}
			pdo_delete(BEST_CSERVICE, array('id' => $id));
			message('删除服信息成功！', $this->createWebUrl('cservice', array('op' => 'display')), 'success');
		}
	}
	public function doMobileChosekefu()
	{
		global $_W, $_GPC;
		$setting = $this->setting;
		$setting['shareurl'] = $_W["siteroot"] . 'app/' . str_replace("./", "", $this->createMobileUrl('chosekefu'));
		$cservicelist = pdo_fetchall("SELECT * FROM " . tablename(BEST_CSERVICE) . " WHERE weid = {$_W['uniacid']} ORDER BY displayorder DESC");
		include $this->template('chosekefu');
	}
	public function doMobileChat()
	{
		global $_W, $_GPC;
		$openid = $_W['fans']['from_user'];
		if (empty($openid)) {
			message('请在微信浏览器中打开！', '', 'error');
		}
		$toopenid = trim($_GPC['toopenid']);
		if ($openid == $toopenid) {
			message('不能和自己聊天！', '', 'error');
		}
		$touser = pdo_fetch("SELECT * FROM " . tablename(BEST_CSERVICE) . " WHERE weid = {$_W['uniacid']} AND content = '{$toopenid}'");
		$chatcon = pdo_fetchall("SELECT * FROM " . tablename(BEST_CHAT) . " WHERE ((openid = '{$openid}' AND toopenid = '{$toopenid}') OR (openid = '{$toopenid}' AND toopenid = '{$openid}')) AND weid = {$_W['uniacid']} ORDER BY time ASC");
		$timestamp = TIMESTAMP;
		$setting = $this->setting;
		$setting['shareurl'] = $_W["siteroot"] . 'app/' . str_replace("./", "", $this->createMobileUrl('chosekefu'));
		include $this->template("chat");
	}
	public function doMobileServicechat()
	{
		global $_W, $_GPC;
		$openid = $_W['fans']['from_user'];
		if (empty($openid)) {
			message('请在微信浏览器中打开，折,翼,天,使,资,源,社,区！', '', 'error');
		}
		$toopenid = trim($_GPC['toopenid']);
		$touser = pdo_fetch("SELECT nickname FROM " . tablename(BEST_CHAT) . " WHERE weid = {$_W['uniacid']} AND toopenid = '{$openid}' AND openid = '{$toopenid}'");
		$nickname = empty($touser) ? '匿名用户' : $touser['nickname'];
		$chatcon = pdo_fetchall("SELECT * FROM " . tablename(BEST_CHAT) . " WHERE ((openid = '{$toopenid}' AND toopenid = '{$openid}') OR (openid = '{$openid}' AND toopenid = '{$toopenid}')) AND weid = {$_W['uniacid']} ORDER BY time ASC");
		$timestamp = TIMESTAMP;
		$setting = $this->setting;
		$setting['shareurl'] = $_W["siteroot"] . 'app/' . str_replace("./", "", $this->createMobileUrl('chosekefu'));
		include $this->template("servicechat");
	}
	public function doMobileShuaxinchat()
	{
		global $_W, $_GPC;
		$openid = $_W['fans']['from_user'];
		$toopenid = trim($_GPC['toopenid']);
		$timestamp = intval($_GPC['timestamp']);
		$chatcon = pdo_fetchall("SELECT * FROM " . tablename(BEST_CHAT) . " WHERE ((openid = '{$toopenid}' AND toopenid = '{$openid}') OR (openid = '{$openid}' AND toopenid = '{$toopenid}')) AND weid = {$_W['uniacid']} AND time >= {$timestamp} ORDER BY time ASC");
		$html = '';
		if (!empty($chatcon)) {
			foreach ($chatcon as $k => $v) {
				if ($v['openid'] == $openid) {
					$messageclass = 'message me';
					$bubble = 'bubble bubble_primary right';
					$nicknamediv = '<span class="time">' . date('Y-m-d H:i:s', $v['time']) . '</span>' . $v['nickname'];
				} else {
					$messageclass = 'message';
					$bubble = 'bubble bubble_default left';
					$nicknamediv = $v['nickname'] . '<span class="time">' . date('Y-m-d H:i:s', $v['time']) . '</span>';
				}
				$imgsrc = $v['avatar'];
				$html .= '<div class="' . $messageclass . '">' . '<img class="avatar" src="' . $imgsrc . '" />' . '<div class="content">' . '<div class="nickname">' . $nicknamediv . '</div>' . '<div class="' . $bubble . '">' . ' <div class="bubble_cont">' . '<div class="plain">' . $v['content'] . '</div>' . '</div>' . '</div>' . '</div>' . '</div>';
			}
			$resArr['error'] = 0;
			$resArr['msg'] = $html;
			$resArr['timestamp'] = TIMESTAMP;
			echo json_encode($resArr);
			die;
		} else {
			$resArr['error'] = 1;
			$resArr['msg'] = '';
			$resArr['timestamp'] = TIMESTAMP;
			echo json_encode($resArr);
			die;
		}
	}
	public function doMobileAddchat()
	{
		global $_W, $_GPC;
		$chatcontent = trim($_GPC['content']);
		if (empty($chatcontent)) {
			$resArr['error'] = 1;
			$resArr['msg'] = '请输入对话内容！';
			echo json_encode($resArr);
			die;
		}
		$setting = $this->setting;
		$data['openid'] = $_W['fans']['from_user'];
		$data['toopenid'] = trim($_GPC['toopenid']);
		$data['time'] = TIMESTAMP;
		$data['content'] = $chatcontent;
		$data['weid'] = $_W['uniacid'];
		$data['nickname'] = empty($_W['fans']) ? '匿名用户' : $_W['fans']['tag']['nickname'];
		$data['avatar'] = empty($_W['fans']) ? tomedia($seeting['defaultavatar']) : $_W['fans']['tag']['avatar'];
		$data['type'] = 1;
		$hasliao = pdo_fetch("SELECT id,time FROM " . tablename(BEST_CHAT) . " WHERE weid = {$_W['uniacid']} AND openid = '{$data['openid']}' AND toopenid = '{$data['toopenid']}' ORDER BY time DESC");
		$guotime = TIMESTAMP - $hasliao['time'];
		if ($setting['istplon'] == 1 && (empty($hasliao) || $guotime > $setting['kefutplminute'])) {
			$tpllist = pdo_fetch("SELECT id FROM" . tablename(BEST_TPLMESSAGE_TPLLIST) . " WHERE tplbh = 'OPENTM207327169' AND uniacid = {$_W['uniacid']}");
			if (!empty($tpllist)) {
				$arrmsg = array('openid' => $data['toopenid'], 'topcolor' => '#980000', 'first' => '客服咨询提醒', 'firstcolor' => '', 'keyword1' => date("Y-m-d H:i:s", TIMESTAMP), 'keyword1color' => '', 'keyword2' => 1, 'keyword2color' => '', 'remark' => '咨询内容：' . $data['content'], 'remarkcolor' => '', 'url' => $_W["siteroot"] . 'app/' . str_replace("./", "", $this->createMobileUrl("servicechat", array('toopenid' => $data['openid']))));
				$this->sendtemmsg($tpllist['id'], $arrmsg);
			}
		}
		pdo_insert(BEST_CHAT, $data);
		$resArr['error'] = 0;
		$resArr['msg'] = '';
		echo json_encode($resArr);
		die;
	}
	public function doMobileAddchat2()
	{
		global $_W, $_GPC;
		$chatcontent = trim($_GPC['content']);
		if (empty($chatcontent)) {
			$resArr['error'] = 1;
			$resArr['msg'] = '请输入对话内容！';
			echo json_encode($resArr);
			die;
		}
		$setting = $this->setting;
		$data['openid'] = $_W['fans']['from_user'];
		$touser = pdo_fetch("SELECT * FROM " . tablename(BEST_CSERVICE) . " WHERE weid = {$_W['uniacid']} AND content = '{$data['openid']}'");
		$data['nickname'] = $touser['name'];
		$data['avatar'] = tomedia($touser['thumb']);
		$data['toopenid'] = trim($_GPC['toopenid']);
		$data['time'] = TIMESTAMP;
		$data['content'] = $chatcontent;
		$data['weid'] = $_W['uniacid'];
		$data['type'] = 2;
		$hasliao = pdo_fetch("SELECT id,time FROM " . tablename(BEST_CHAT) . " WHERE weid = {$_W['uniacid']} AND openid = '{$data['openid']}' AND toopenid = '{$data['toopenid']}' ORDER BY time DESC");
		$guotime = TIMESTAMP - $hasliao['time'];
		if ($setting['istplon'] == 1 && (empty($hasliao) || $guotime > $setting['kefutplminute'])) {
			$tpllist = pdo_fetch("SELECT id FROM" . tablename(BEST_TPLMESSAGE_TPLLIST) . " WHERE tplbh = 'OPENTM207327169' AND uniacid = {$_W['uniacid']}");
			if (!empty($tpllist)) {
				$arrmsg = array('openid' => $data['toopenid'], 'topcolor' => '#980000', 'first' => '客服咨询提醒', 'firstcolor' => '', 'keyword1' => date("Y-m-d H:i:s", TIMESTAMP), 'keyword1color' => '', 'keyword2' => 1, 'keyword2color' => '', 'remark' => '咨询内容：' . $data['content'], 'remarkcolor' => '', 'url' => $_W["siteroot"] . 'app/' . str_replace("./", "", $this->createMobileUrl("chat", array('toopenid' => $data['openid']))));
				$this->sendtemmsg($tpllist['id'], $arrmsg);
			}
		}
		pdo_insert(BEST_CHAT, $data);
		$resArr['error'] = 0;
		$resArr['msg'] = '';
		echo json_encode($resArr);
		die;
	}
	public function doWebTpllist()
	{
		global $_W;
		$list = pdo_fetchall("SELECT * FROM " . tablename(BEST_TPLMESSAGE_TPLLIST) . " WHERE uniacid = {$_W['uniacid']} ORDER BY id ASC");
		include $this->template('web/tpllist');
	}
	public function doWebCreatetpl()
	{
		global $_GPC, $_W;
		$tplbh = trim($_GPC['tplbh']);
		$istplbh = pdo_fetch("SELECT * FROM " . tablename(BEST_TPLMESSAGE_TPLLIST) . " WHERE uniacid = {$_W['uniacid']} AND tplbh = '{$tplbh}'");
		if (!empty($istplbh)) {
			message('您已添加该模板消息！', $this->createWebUrl('Tpllist'), 'error');
		} else {
			$account_api = WeAccount::create();
			$token = $account_api->getAccessToken();
			if (is_error($token)) {
				message('获取access token 失败');
			}
			$url = "https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token={$token}";
			$postdata = array('template_id_short' => $tplbh);
			$response = ihttp_request($url, urldecode(json_encode($postdata)));
			$errarr = json_decode($response['content'], true);
			if ($errarr['errcode'] == 0) {
				$data = array('tplbh' => $tplbh, 'tpl_id' => $errarr['template_id'], 'uniacid' => $_W['uniacid']);
				pdo_insert(BEST_TPLMESSAGE_TPLLIST, $data);
				message('添加模板消息成功！', $this->createWebUrl('Tpllist'), 'success');
				return;
			} else {
				message($errarr['errmsg'], $this->createWebUrl('Tpllist'), 'error');
			}
		}
	}
	public function doWebdeltpl()
	{
		global $_GPC, $_W;
		$tplid = trim($_GPC['tplid']);
		$istplbh = pdo_fetch("SELECT * FROM " . tablename(BEST_TPLMESSAGE_TPLLIST) . " WHERE uniacid = {$_W['uniacid']} AND tpl_id = '{$tpl_id}'");
		if (!empty($istplbh)) {
			message('没有该模板消息！', $this->createWebUrl('Tpllist'), 'error');
		} else {
			if (empty($istplbh['tpl_key'])) {
				message('该该模板消息没有同步，不能删除！', $this->createWebUrl('Tpllist'), 'error');
			}
			$account_api = WeAccount::create();
			$token = $account_api->getAccessToken();
			if (is_error($token)) {
				message('获取access token 失败');
			}
			$url = "https://api.weixin.qq.com/cgi-bin/template/del_private_template?access_token={$token}";
			$postjson = '{"template_id":"' . $tplid . '"}';
			$response = ihttp_request($url, $postjson);
			$errarr = json_decode($response['content'], true);
			if ($errarr['errcode'] == 0) {
				pdo_delete(BEST_TPLMESSAGE_TPLLIST, array('tpl_id' => $tplid));
				message('删除模板消息成功！', $this->createWebUrl('Tpllist'), 'success');
				return;
			} else {
				message($errarr['errmsg'], $this->createWebUrl('Tpllist'), 'error');
			}
		}
	}
	public function doWebUpdateTpl()
	{
		global $_W;
		$success = 0;
		$account_api = WeAccount::create();
		$token = $account_api->getAccessToken();
		if (is_error($token)) {
			message('获取access token 失败');
		}
		$url = "https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token={$token}";
		$response = ihttp_request($url, urldecode(json_encode($data)));
		if (is_error($response)) {
			return error(-1, "访问公众平台接口失败, 错误: {$response['message']}");
		}
		$list = json_decode($response['content'], true);
		if (empty($list['template_list'])) {
			message('访问公众平台接口失败, 错误: 模板列表返回为空');
		}
		foreach ($list['template_list'] as $k => $v) {
			$template_id = $v['template_id'];
			$data['tpl_title'] = $v['title'];
			preg_match_all('/{{(.*?)\.DATA}}/', $v['content'], $key);
			preg_match_all('/}}\n*(.*?){{/', $v['content'], $title);
			$keys = $this->formatTplKey($key[1], $title[1]);
			$data['tpl_key'] = serialize($keys);
			$data['tpl_example'] = $v['example'];
			pdo_update(BEST_TPLMESSAGE_TPLLIST, $data, array('tpl_id' => $template_id));
		}
		message('更新完闭！', $this->createWebUrl('Tpllist'), 'success');
	}
	public function formatTplKey($key, $title)
	{
		$keys = array();
		for ($i = 0; $i < count($key); $i++) {
			if (empty($key[$i])) {
				continue;
			}
			if ($i == 0) {
				$keys[$i]['title'] = "首标题：";
				$keys[$i]['key'] = $key[$i];
				continue;
			}
			if ($i == count($key) - 1) {
				$keys[$i]['title'] = "尾备注：";
				$keys[$i]['key'] = $key[$i];
				continue;
			}
			$keys[$i]['title'] = $title[$i - 1];
			$keys[$i]['key'] = $key[$i];
		}
		return $keys;
	}
	public function doWebSendone()
	{
		global $_W, $_GPC;
		$tpllist = pdo_fetchall("SELECT * FROM " . tablename(BEST_TPLMESSAGE_TPLLIST) . " WHERE uniacid = {$_W['uniacid']} ORDER BY id");
		if (empty($tpllist)) {
			message("请先同步模板！", $this->createWebUrl('Tpllist'), 'error');
			die;
		}
		$data['tplid'] = empty($_GPC['tplid']) ? $tpllist[0]['id'] : $_GPC['tplid'];
		$tpldetailed = pdo_fetch("SELECT * FROM " . tablename(BEST_TPLMESSAGE_TPLLIST) . " WHERE id = {$data['tplid']} LIMIT 1");
		$tplkeys = unserialize($tpldetailed['tpl_key']);
		include $this->template('web/sendone');
	}
	public function doWebSendOneSumbit()
	{
		global $_W, $_GPC;
		$account_api = WeAccount::create();
		$token = $account_api->getAccessToken();
		if (is_error($token)) {
			message('获取access token 失败');
		}
		$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $token;
		$tpldetailed = pdo_fetch("SELECT * FROM " . tablename(BEST_TPLMESSAGE_TPLLIST) . " WHERE id = {$_GPC['tplid']} LIMIT 1");
		$tplkeys = unserialize($tpldetailed['tpl_key']);
		$postData = array();
		$postData['template_id'] = $tpldetailed['tpl_id'];
		$postData['url'] = $_GPC['url'];
		$postData['topcolor'] = $_GPC['topcolor'];
		foreach ($tplkeys as $value) {
			$postData['data'][$value['key']]['value'] = $_GPC[$value['key']];
			$postData['data'][$value['key']]['color'] = $_GPC[$value['key'] . 'color'];
		}
		pdo_insert(BEST_TPLMESSAGE_SENDLOG, array('tpl_id' => $_GPC['tplid'], 'tpl_title' => $tpldetailed['tpl_title'], 'message' => serialize($postData), 'time' => time(), 'uniacid' => $_W['uniacid'], 'target' => implode(",", $_GPC['openid']), 'type' => 1));
		$tid = pdo_insertid();
		if ($tid <= 0) {
			message('抱歉,请求失败', 'referer', 'error');
		}
		$openid = $_GPC['openid'];
		$success = 0;
		$fail = 0;
		$error = "";
		foreach ($openid as $value) {
			$postData['touser'] = $value;
			$res = ihttp_post($url, json_encode($postData));
			$re = json_decode($res['content'], true);
			if ($re['errmsg'] == 'ok') {
				$success++;
			} else {
				$fail++;
				$error .= $value . ",";
			}
		}
		pdo_update(BEST_TPLMESSAGE_SENDLOG, array('success' => $success, 'fail' => $fail, 'error' => $error, 'status' => 1), array('id' => $tid));
		if ($success <= 0) {
			message("发送失败！", 'referer', 'error');
		}
		message("发送成功，总计：" . ($success + $fail) . "人，成功：{$success} 人，失败：{$fail} 人", $this->createWebUrl('SendOnelog'), 'success');
	}
	public function doWebSendOnelog()
	{
		global $_W, $_GPC;
		$page = empty($_GPC['page']) ? 1 : $_GPC['page'];
		$pagesize = 20;
		$total = pdo_fetch("SELECT COUNT(id) AS num FROM " . tablename(BEST_TPLMESSAGE_SENDLOG) . " WHERE type = 1 AND uniacid = {$_W['uniacid']} ");
		$list = pdo_fetchall("SELECT a.id,a.success,a.fail,a.time,a.target,a.status,a.tpl_title as title,a.error FROM " . tablename(BEST_TPLMESSAGE_SENDLOG) . " AS a WHERE a.type = 1 AND a.uniacid = {$_W['uniacid']} ORDER BY time DESC LIMIT " . ($page - 1) * $pagesize . "," . $pagesize);
		$pagination = pagination($total['num'], $page, $pagesize);
		include $this->template("web/sendonelog");
	}
	public function sendtemmsg($tplid, $arrmsg)
	{
		global $_W, $_GPC;
		$account_api = WeAccount::create();
		$token = $account_api->getAccessToken();
		$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $token;
		$tpldetailed = pdo_fetch("SELECT * FROM " . tablename(BEST_TPLMESSAGE_TPLLIST) . " WHERE id = {$tplid} LIMIT 1");
		$tplkeys = unserialize($tpldetailed['tpl_key']);
		$postData = array();
		$postData['template_id'] = $tpldetailed['tpl_id'];
		$postData['url'] = $arrmsg['url'];
		$postData['topcolor'] = $arrmsg['topcolor'];
		foreach ($tplkeys as $value) {
			$postData['data'][$value['key']]['value'] = $arrmsg[$value['key']];
			$postData['data'][$value['key']]['color'] = $arrmsg[$value['key'] . 'color'];
		}
		pdo_insert(BEST_TPLMESSAGE_SENDLOG, array('tpl_id' => $tplid, 'tpl_title' => $tpldetailed['tpl_title'], 'message' => serialize($postData), 'time' => time(), 'uniacid' => $_W['uniacid'], 'target' => $arrmsg['openid'], 'type' => 1));
		$tid = pdo_insertid();
		$success = 0;
		$fail = 0;
		$error = "";
		$postData['touser'] = $arrmsg['openid'];
		$res = ihttp_post($url, json_encode($postData));
		$re = json_decode($res['content'], true);
		if ($re['errmsg'] == 'ok') {
			$success++;
		} else {
			$fail++;
			$error .= $openid;
		}
		pdo_update(BEST_TPLMESSAGE_SENDLOG, array('success' => $success, 'fail' => $fail, 'error' => $error, 'status' => 1), array('id' => $tid));
	}
}