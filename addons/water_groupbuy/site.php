<?php

defined("IN_IA") || exit("Access Denied");
class water_groupbuyModuleSite extends WeModuleSite
{
	public $fanstable = 'water_live_fans';
	public $themetable = 'water_groupbuy_theme';
	public $sharetable = 'water_groupbuy_share';
	public $ordertable = 'water_groupbuy_order';
	public $pricegrouptable = 'water_groupbuy_pricegroup';
	public $pricetable = 'water_groupbuy_price';

	public function doMobileMode()
	{
		global $_GPC;
		global $_W;
		$system = $this->module['config'];
		$fans = $this->checkinfo();
		$themeid = intval($_GPC['themeid']);

		if ($themeid <= 0) {
			message('id is null');
		}


		$worker = array();
		$workerid = intval($_GPC['workerid']);

		if ($fans['status'] == 2) {
			$workerid = $fans['id'];
			$worker['id'] = $workerid;
			$worker['workername'] = $fans['fname'];
			$worker['workermobile'] = $fans['fmobile'];
		}
		 else if (0 < $workerid) {
			$thefans = pdo_fetch('SELECT id,fname,fmobile FROM ' . tablename($this->fanstable) . ' WHERE id= \'' . $workerid . '\'');
			$worker['id'] = $workerid;
			$worker['workername'] = $thefans['fname'];
			$worker['workermobile'] = $thefans['fmobile'];
		}


		pdo_query("UPDATE " . tablename($this->themetable) . ' SET scansum = scansum +1 WHERE id =\'' . $themeid . '\' ');
		$theme = pdo_fetch('SELECT * FROM ' . tablename($this->themetable) . ' WHERE id= \'' . $themeid . '\'');
		$centerimg = unserialize($theme['centerimg']);
		$imgs = unserialize($theme['imgs']);
		$hasattend = $this->getThemeSumByTid($themeid);
		$hasattend = intval($hasattend) + intval($theme['fake']);
		$jindu = round((100 * $hasattend) / $theme['target'], 2);
		$percent = $jindu;

		if (100 < $percent) {
			$percent = 100;
		}


		$pricesql = 'SELECT * FROM ' . tablename($this->pricetable) . ' ' . "\r\n\t\t\t\t\t\t\t\t" . 'WHERE target <= ' . $hasattend . ' and uniacid = \'' . $_W['uniacid'] . '\' and state = 1 and pricegroupid = \'' . $theme['pricegroupid'] . '\' ' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'ORDER BY price limit 1';
		$price = pdo_fetch($pricesql);

		if (empty($price)) {
			$price['name'] = '原价';
			$price['price'] = '不打折';
		}


		$order = pdo_fetch('SELECT * FROM ' . tablename($this->ordertable) . ' ' . "\r\n\t\t\t\t\t\t\t\t" . 'WHERE uniacid = \'' . $_W['uniacid'] . '\' and paystate = 1 and themeid = \'' . $themeid . '\' and fansid = \'' . $fans['id'] . '\' ');
		$share = pdo_fetch('SELECT sharecount FROM ' . tablename($this->sharetable) . "\r\n\t\t\t\t" . 'WHERE uniacid = \'' . $_W['uniacid'] . '\'  and themeid = \'' . $themeid . '\' and fansid = \'' . $fans['id'] . '\' ');
		$lightsum = $share['sharecount'];
		$lightlist = array();
		$i = 1;

		while ($i <= $lightsum) {
			$lightlist[$i] = $i;
			++$i;
		}

		$darksum = $theme['iconnum'];
		$darklist = array();
		$i = $lightsum + 1;

		while ($i <= $darksum) {
			$darklist[$i] = $i;
			++$i;
		}

		include $this->template('mode1');
	}

	public function doMobileWorker()
	{
		global $_GPC;
		global $_W;
		$system = $this->module['config'];
		$fans = $this->checkinfo();
		$sql = 'SELECT fs.nickname,fs.headimgurl,fs.fmobile,fs.fname,fs.addtime,sh.sharecount,sh.verify as sverify,od.paystate,od.fee,od.verify as overify FROM ' . tablename($this->fanstable) . ' as fs' . "\r\n\t\t\t\t\t" . 'left join ' . tablename($this->sharetable) . ' as sh on sh.fansid =  fs.id' . "\r\n\t\t\t\t\t" . 'left join ' . tablename($this->ordertable) . ' as od on od.fansid =  fs.id' . "\r\n\t\t\t\t\t\t\t" . 'WHERE fs.uniacid = \'' . $_W['uniacid'] . '\' and (od.workerid = \'' . $fans['id'] . '\' or sh.workerid = \'' . $fans['id'] . '\') ORDER BY od.id desc';
		$list = pdo_fetchall($sql);
		include $this->template('worker');
	}

	public function doMobileVerifygift()
	{
		global $_GPC;
		global $_W;
		$system = $this->module['config'];
		$fans = $this->checkinfo();
		$themeid = intval($_GPC['themeid']);

		if ($themeid <= 0) {
			message('themeid is null');
		}


		$theme = pdo_fetch('SELECT * FROM ' . tablename($this->themetable) . ' WHERE id= \'' . $themeid . '\'');

		if (empty($theme)) {
			message('活动不存在或已删除');
		}


		$share = pdo_fetch('SELECT * FROM ' . tablename($this->sharetable) . "\r\n\t\t\t\t" . 'WHERE uniacid = \'' . $_W['uniacid'] . '\'  and themeid = \'' . $themeid . '\' and fansid = \'' . $fans['id'] . '\' ');
		$order = pdo_fetch('SELECT * FROM ' . tablename($this->ordertable) . "\r\n\t\t\t\t\t\t\t" . 'WHERE uniacid = \'' . $_W['uniacid'] . '\'  and themeid = \'' . $themeid . '\' and fansid = \'' . $fans['id'] . '\' ');
		include $this->template('verify');
	}

	public function doMobileVerifyShare()
	{
		global $_GPC;
		global $_W;
		$system = $this->module['config'];
		$openid = $this->checkopenid();
		$fans = $this->getFansDBInfo($openid);
		if (empty($fans['openid']) || empty($fans['nickname'])) {
			exit(json_encode(array('errcode' => 1, 'errmsg' => 'un auth')));
		}


		$themeid = intval($_GPC['themeid']);

		if ($themeid <= 0) {
			exit(json_encode(array('errcode' => 1, 'errmsg' => 'un themeid')));
		}


		$result = array();
		$theme = pdo_fetch('SELECT iconnum,icongiftsum FROM ' . tablename($this->themetable) . ' WHERE id= \'' . $themeid . '\'');

		if ($theme['icongiftsum'] <= 0) {
			$result['errcode'] = 1;
			$result['errmsg'] = '奖品库存不足啦';
		}
		 else {
			$share = pdo_fetch('SELECT * FROM ' . tablename($this->sharetable) . "\r\n\t\t\t\t\t" . 'WHERE uniacid = \'' . $_W['uniacid'] . '\'  and themeid = \'' . $themeid . '\' and fansid = \'' . $fans['id'] . '\' ');
			$sharecount = $share['sharecount'];

			if ($theme['iconnum'] <= $sharecount) {
				pdo_update($this->sharetable, array('verify' => 1), array('id' => $share['id']));
				pdo_query("UPDATE " . tablename($this->themetable) . ' SET icongiftsum = icongiftsum -1 WHERE id =\'' . $themeid . '\' ');
				$result['errcode'] = 0;
				$result['msg'] = '分享已核销，谢谢参与';
			}
			 else {
				$result['errcode'] = 1;
				$result['errmsg'] = 'sharecount is not enough';
			}
		}

		exit(json_encode($result));
	}

	public function doMobileVerifyOrder()
	{
		global $_GPC;
		global $_W;
		$system = $this->module['config'];
		$openid = $this->checkopenid();
		$fans = $this->getFansDBInfo($openid);
		if (empty($fans['openid']) || empty($fans['nickname'])) {
			exit(json_encode(array('errcode' => 1, 'errmsg' => 'un auth')));
		}


		$themeid = intval($_GPC['themeid']);

		if ($themeid <= 0) {
			exit(json_encode(array('errcode' => 1, 'errmsg' => 'un themeid')));
		}


		$result = array();
		$order = pdo_fetch('SELECT id,paystate FROM ' . tablename($this->ordertable) . "\r\n\t\t\t\t\t\t\t" . 'WHERE uniacid = \'' . $_W['uniacid'] . '\'  and themeid = \'' . $themeid . '\' and fansid = \'' . $fans['id'] . '\' ');

		if ($order['paystate'] == 1) {
			pdo_update($this->ordertable, array('verify' => 1), array('id' => $order['id']));
			$result['errcode'] = 0;
			$result['msg'] = '订单已核销，谢谢参与';
		}
		 else {
			$result['errcode'] = 1;
			$result['errmsg'] = 'order hasnt pay';
		}

		exit(json_encode($result));
	}

	public function doMobileDoShare()
	{
		global $_GPC;
		global $_W;
		$system = $this->module['config'];
		$openid = $this->checkopenid();
		$fans = $this->getFansDBInfo($openid);
		if (empty($fans['openid']) || empty($fans['nickname'])) {
			exit(json_encode(array('errcode' => 1, 'errmsg' => 'un auth')));
		}


		$themeid = intval($_GPC['themeid']);

		if ($themeid <= 0) {
			exit(json_encode(array('errcode' => 1, 'errmsg' => 'un themeid')));
		}


		$workerid = intval($_GPC['workerid']);
		$theme = pdo_fetch('SELECT lighticon FROM ' . tablename($this->themetable) . ' WHERE id= \'' . $themeid . '\'');
		$share = pdo_fetch('SELECT * FROM ' . tablename($this->sharetable) . ' ' . "\r\n\t\t\t\t\t\t" . 'WHERE uniacid = \'' . $_W['uniacid'] . '\'  and themeid = \'' . $themeid . '\' and fansid = \'' . $fans['id'] . '\' ');
		$sharecount = $share['sharecount'];
		$a_date = date('Y-m-d', strtotime($share['sharetime']));
		$b_date = date('Y-m-d');

		if ($a_date != $b_date) {
			if (empty($share)) {
				$sharecount = 1;
				$data = array('uniacid' => $_W['uniacid'], 'themeid' => $themeid, 'fansid' => $fans['id'], 'openid' => $fans['openid'], 'sharetime' => date('Y-m-d H:i:s'), 'sharecount' => $sharecount, 'workerid' => $workerid);
				pdo_insert($this->sharetable, $data);
			}
			 else {
				++$sharecount;
				pdo_update($this->sharetable, array('sharetime' => date('Y-m-d H:i:s'), 'sharecount' => $sharecount), array('id' => $share['id']));
			}
		}


		$ishasinfo = 1;
		if (empty($fans['fmobile']) || empty($fans['fname'])) {
			$ishasinfo = 0;
		}


		$result = array('errcode' => 0, 'errmsg' => 'success', 'ishasinfo' => $ishasinfo, 'sharecount' => $sharecount, 'lighticon' => $_W['attachurl'] . $theme['lighticon']);
		exit(json_encode($result));
	}

	public function doMobileDoinfo()
	{
		global $_GPC;
		global $_W;
		$fname = $_GPC['fname'];
		$fmobile = $_GPC['fmobile'];
		if (empty($fname) || empty($fmobile)) {
			exit(json_encode(array('errcode' => 1, 'errmsg' => 'un params')));
		}


		$system = $this->module['config'];
		$openid = $this->checkopenid();
		$fans = $this->getFansDBInfo($openid);
		if (empty($fans['openid']) || empty($fans['nickname'])) {
			exit(json_encode(array('errcode' => 1, 'errmsg' => 'un auth')));
		}


		pdo_update($this->fanstable, array('fname' => $fname, 'fmobile' => $fmobile), array('id' => $fans['id']));
		$result = array('errcode' => 0, 'errmsg' => 'success');
		exit(json_encode($result));
	}

	public function helppay($params)
	{
		global $_W;
		$log = pdo_get('core_paylog', array('uniacid' => $_W['uniacid'], 'module' => $this->module['name'], 'tid' => $params['tid']));

		if (empty($log)) {
			$log = array('uniacid' => $_W['uniacid'], 'acid' => $_W['acid'], 'openid' => $_W['member']['uid'], 'module' => $this->module['name'], 'tid' => $params['tid'], 'fee' => $params['fee'], 'card_fee' => $params['fee'], 'status' => '0', 'is_usecard' => '0');
			pdo_insert("core_paylog", $log);
		}

	}

	public function payResult($params)
	{
		global $_W;
		$orderid = $params['tid'];
		$order = pdo_fetch('SELECT themeid,fee FROM ' . tablename($this->ordertable) . ' WHERE id = \'' . $orderid . '\' ');
		$fee = $params['fee'];

		if (($params['result'] == 'success') && ($params['from'] == 'notify')) {
			if ($params['fee'] != $order['fee']) {
				exit('用户支付的金额与订单金额不符合');
			}
			 else {
				$this->dealorder($params);
			}
		}


		if (empty($params['result']) || ($params['result'] != 'success')) {
			load()->model('account');
			$setting = uni_setting($_W['uniacid'], array('payment'));

			if ($params['type'] == 'wechat') {
				if (!empty($setting['payment']['wechat']['switch'])) {
					if (empty($params['tag']['transaction_id'])) {
						exit();
					}
					 else {
						$res = $this->checkWechatTran($setting, $params['tag']['transaction_id']);
						$res['fee'] = round($res['fee'], 2);
						$fee = round($fee, 2);

						if (($res['code'] == 1) && ($res['fee'] == $fee)) {
							$this->dealorder($params);
						}

					}
				}

			}

		}


		if ($params['from'] == 'return') {
			if ($params['result'] == 'success') {
				message('支付成功！', '../../' . $this->createMobileUrl('mode', array('themeid' => $order['themeid'])), 'success');
				return;
			}


			message("支付失败！", "../../" . $this->createMobileUrl('mode', array('themeid' => $order['themeid'])), 'error');
		}

	}

	public function dealorder($params)
	{
		global $_W;
		$orderid = $params['tid'];
		$order = pdo_fetch('SELECT * FROM ' . tablename($this->ordertable) . ' WHERE id = \'' . $orderid . '\' ');

		if (!empty($order) && ($order['state'] == 0)) {
			if ($order['state'] == 0) {
				pdo_update($this->ordertable, array('state' => 1, 'paytime' => date('Y-m-d H:i:s')), array('id' => $orderid));
			}
			 else {
				exit("订单已支付");
			}
		}


		exit("订单不存在或已支付");
	}

	public function sendNotice($url, $toopenid, $template_id, $order)
	{
		global $_W;
		$system = $this->module['config'];
		$data = array('touser' => $toopenid, 'template_id' => $template_id, 'url' => $url, 'topcolor' => '#FF0000');
		$data['data'] = array(
			'first'    => array('value' => '您的订单已支付成功。', 'color' => '#173177'),
			'keyword1' => array('value' => $order['nickname'], 'color' => '#173177'),
			'keyword2' => array('value' => $order['orderno'], 'color' => '#173177'),
			'keyword3' => array('value' => $order['fee'] . '元', 'color' => '#173177'),
			'keyword4' => array('value' => '查看活动页面', 'color' => '#173177'),
			'remark'   => array('value' => '谢谢支持', 'color' => '#173177')
			);
		$token = $this->getToken();
		$this->sendMBXX($token, $data);
	}

	public function dowebTheme()
	{
		global $_W;
		global $_GPC;
		$pageNumber = max(1, intval($_GPC['page']));
		$pageSize = 20;
		$sql = 'SELECT * FROM ' . tablename($this->themetable) . ' WHERE uniacid = \'' . $_W['uniacid'] . '\'  ORDER BY displayorder LIMIT ' . (($pageNumber - 1) * $pageSize) . ',' . $pageSize;
		$list = pdo_fetchall($sql);
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->themetable) . ' WHERE uniacid = \'' . $_W['uniacid'] . '\'  ORDER BY displayorder');
		$pager = pagination($total, $pageNumber, $pageSize);
		include $this->template('theme');
	}

	public function dowebaddTheme()
	{
		global $_W;
		global $_GPC;
		load()->func("tpl");
		$themeid = intval($_GPC['themeid']);

		if (0 < $themeid) {
			$theme = pdo_fetch('SELECT * FROM ' . tablename($this->themetable) . ' WHERE id= \'' . $themeid . '\'');

			if (!$theme) {
				message('抱歉，信息不存在或是已经删除！', '', 'error');
			}


			$hasverify = $this->getThemeShareGiftVerifySumByTid($themeid);
			$left = intval($theme['icongiftsum']) - intval($hasverify);
			$imgs = unserialize($theme['imgs']);
			$centerimg = unserialize($theme['centerimg']);
			$themeurl = $_W['siteroot'] . 'app/' . $this->createMobileUrl('mode', array('themeid' => $themeid));
		}


		$groupsql = 'SELECT * FROM ' . tablename($this->pricegrouptable) . ' WHERE state = 1 and uniacid = \'' . $_W['uniacid'] . '\' ORDER BY id';
		$grouplist = pdo_fetchall($groupsql);

		if ($_GPC['op'] == 'delete') {
			$theme = pdo_fetch('SELECT id FROM ' . tablename($this->themetable) . ' WHERE id = \'' . $themeid . '\'');

			if (empty($theme['id'])) {
				message('抱歉，信息不存在或是已经被删除！');
			}


			pdo_delete($this->themetable, array('id' => $themeid));
			message("删除成功！", referer(), "success");
		}


		if (checksubmit()) {
			$imgs = serialize($_GPC['imgs']);
			$centerimg = serialize($_GPC['centerimg']);
			$pricegroupid = intval($_GPC['pricegroupid']);
			$typeid = intval($_GPC['typeid']);

			if (0 < $pricegroupid) {
				$pricesum = $this->getPriceSumByGroupid($pricegroupid);

				if ($pricesum <= 0) {
					message('所选价格分组的价格数量为0，请添加具体的价格');
				}


				$pricesql = 'SELECT * FROM ' . tablename($this->pricetable) . "\r\n\t\t\t\t\t\t\t\t\t" . 'WHERE uniacid = \'' . $_W['uniacid'] . '\' and state = 1 and pricegroupid = \'' . $theme['pricegroupid'] . '\'' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . 'ORDER BY price limit 1';
				$price = pdo_fetch($pricesql);
			}


			$data = array('displayorder' => intval($_GPC['displayorder']), 'typeid' => intval($_GPC['typeid']), 'keyword' => $_GPC['keyword'], 'title' => $_GPC['title'], 'desc' => $_GPC['desc'], 'content' => htmlspecialchars_decode($_GPC['content']), 'begintime' => date('Y-m-d', strtotime($_GPC['themetime']['start'])), 'endtime' => date('Y-m-d', strtotime($_GPC['themetime']['end'])), 'headlogo' => $_GPC['headlogo'], 'centerimg' => $centerimg, 'iconimg' => $_GPC['iconimg'], 'imgs' => $imgs, 'bottomlefttip' => $_GPC['bottomlefttip'], 'bottomshare' => $_GPC['bottomshare'], 'themelxr' => $_GPC['themelxr'], 'themetel' => $_GPC['themetel'], 'tsupport' => $_GPC['tsupport'], 'tsupporturl' => $_GPC['tsupporturl'], 'state' => intval($_GPC['state']), 'darkicon' => $_GPC['darkicon'], 'lighticon' => $_GPC['lighticon'], 'iconname' => $_GPC['iconname'], 'iconnum' => intval($_GPC['iconnum']), 'icongift' => $_GPC['icongift'], 'icongiftsum' => intval($_GPC['icongiftsum']), 'payfee' => floatval($_GPC['payfee']), 'pricegroupid' => $pricegroupid, 'fake' => intval($_GPC['fake']), 'target' => $price['target']);

			if (!empty($themeid)) {
				pdo_update($this->themetable, $data, array('id' => $themeid));
			}
			 else {
				$data['uniacid'] = $_W['uniacid'];
				pdo_insert($this->themetable, $data);
				$themeid = pdo_insertid();
			}

			$theme = pdo_fetch('SELECT * FROM ' . tablename($this->themetable) . ' WHERE id = \'' . $themeid . '\'');

			if (empty($theme['verifigift'])) {
				$ewmdata = array();
				$url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('verifygift', array('themeid' => $themeid));
				$ewmurl = $this->createEWM($url);
				$ewmdata['verifigift'] = $ewmurl;
				pdo_update($this->themetable, $ewmdata, array('id' => $themeid));
			}


			message("更新成功！", referer(), "success");
		}


		include $this->template('addtheme');
	}

	public function dowebPricegroup()
	{
		global $_W;
		global $_GPC;
		$pageNumber = max(1, intval($_GPC['page']));
		$pageSize = 30;
		$sql = 'SELECT * FROM ' . tablename($this->pricegrouptable) . ' WHERE uniacid = \'' . $_W['uniacid'] . '\' ORDER BY id LIMIT ' . (($pageNumber - 1) * $pageSize) . ',' . $pageSize;
		$list = pdo_fetchall($sql);
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->pricegrouptable) . ' WHERE uniacid = \'' . $_W['uniacid'] . '\' ORDER BY id DESC');
		$pager = pagination($total, $pageNumber, $pageSize);
		include $this->template('pricegroup');
	}

	public function doWebAddPricegroup()
	{
		global $_W;
		global $_GPC;
		load()->func("tpl");
		$pricegroupid = intval($_GPC['pricegroupid']);

		if (0 < $pricegroupid) {
			$pricegroup = pdo_fetch('SELECT * FROM ' . tablename($this->pricegrouptable) . ' WHERE id= ' . $pricegroupid);
		}


		if ($_GPC['op'] == 'delete') {
			$pricegroupid = intval($_GPC['pricegroupid']);
			$pricegroup = pdo_fetch('SELECT id FROM ' . tablename($this->pricegrouptable) . ' WHERE id = ' . $pricegroupid);

			if (empty($pricegroup)) {
				message('抱歉，商品不存在或是已经被删除！');
			}


			pdo_delete($this->pricetable, array('pricegroupid' => $pricegroupid));
			pdo_delete($this->pricegrouptable, array('id' => $pricegroupid));
			message("删除成功！", referer(), "success");
		}


		if (checksubmit()) {
			$data = array('groupname' => $_GPC['groupname'], 'state' => intval($_GPC['state']));

			if (!empty($pricegroupid)) {
				pdo_update($this->pricegrouptable, $data, array('id' => $pricegroupid));
			}
			 else {
				$data['uniacid'] = $_W['uniacid'];
				pdo_insert($this->pricegrouptable, $data);
				$pricegroupid = pdo_insertid();
			}

			message("更新成功！", referer(), "success");
		}


		include $this->template('addpricegroup');
	}

	public function dowebPrice()
	{
		global $_W;
		global $_GPC;
		$pricegroupid = intval($_GPC['pricegroupid']);

		if ($pricegroupid <= 0) {
			message('请先增加分类');
		}


		$sql = 'SELECT * FROM ' . tablename($this->pricetable) . ' WHERE uniacid = \'' . $_W['uniacid'] . '\' and pricegroupid = \'' . $pricegroupid . '\' ORDER BY displayorder ';
		$list = pdo_fetchall($sql);
		include $this->template('price');
	}

	public function doWebAddPrice()
	{
		global $_W;
		global $_GPC;
		load()->func("tpl");
		$pricegroupid = intval($_GPC['pricegroupid']);

		if ($pricegroupid <= 0) {
			message('请先增加分类');
		}


		$priceid = intval($_GPC['priceid']);

		if ($priceid) {
			$price = pdo_fetch('SELECT * FROM ' . tablename($this->pricetable) . ' WHERE id= ' . $priceid);
		}


		if ($_GPC['op'] == 'delete') {
			$priceid = intval($_GPC['priceid']);
			$price = pdo_fetch('SELECT id FROM ' . tablename($this->pricetable) . ' WHERE id = ' . $priceid);

			if (empty($price)) {
				message('抱歉，信息不存在或是已经被删除！');
			}


			pdo_delete($this->pricetable, array('id' => $priceid));
			message("删除成功！", referer(), "success");
		}


		if (checksubmit()) {
			$data = array('displayorder' => intval($_GPC['displayorder']), 'name' => $_GPC['name'], 'price' => floatval($_GPC['price']), 'target' => intval($_GPC['target']), 'state' => intval($_GPC['state']));

			if (!empty($priceid)) {
				pdo_update($this->pricetable, $data, array('id' => $priceid));
			}
			 else {
				$data['uniacid'] = $_W['uniacid'];
				$data['pricegroupid'] = $pricegroupid;
				pdo_insert($this->pricetable, $data);
				$priceid = pdo_insertid();
			}

			message("更新成功！", referer(), "success");
		}


		include $this->template('addprice');
	}

	public function dowebOrder()
	{
		global $_W;
		global $_GPC;
		$pageNumber = max(1, intval($_GPC['page']));
		$pageSize = 100;
		$state = $_GPC['state'];

		if (empty($state)) {
			$state = 'all';
		}


		$condition = ' and 1 = 1';

		if ($state == 'unpay') {
			$condition .= ' and o.paystate = 0';
		}
		 else if ($state == 'haspay') {
			$condition .= ' and o.paystate = 1';
		}


		$sql = 'SELECT o.*,f.fname,f.fmobile FROM ' . tablename($this->ordertable) . ' as o ' . "\r\n\t\t\t\t\t" . 'left join ' . tablename($this->fanstable) . ' as f on o.fansid =  f.id' . "\r\n\t\t\t\t\t" . 'WHERE o.uniacid = \'' . $_W['uniacid'] . '\' ' . $condition . ' ' . "\r\n\t\t\t\t\t\t" . '  ORDER BY o.id desc LIMIT ' . (($pageNumber - 1) * $pageSize) . ',' . $pageSize;
		$list = pdo_fetchall($sql);
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->ordertable) . ' as o' . "\r\n\t\t\t\t\t" . 'WHERE o.uniacid = \'' . $_W['uniacid'] . '\' ' . $condition . ' ORDER BY o.id desc');
		$pager = pagination($total, $pageNumber, $pageSize);
		include $this->template('order');
	}

	public function dowebaddOrder()
	{
		global $_W;
		global $_GPC;
		load()->func("tpl");
		$orderid = intval($_GPC['orderid']);

		if (0 < $orderid) {
			$order = pdo_fetch('SELECT * FROM ' . tablename($this->ordertable) . ' WHERE id= \'' . $orderid . '\'');

			if (!$order) {
				message('抱歉，信息不存在或是已经删除！', '', 'error');
			}

		}


		if ($_GPC['op'] == 'delete') {
			$order = pdo_fetch('SELECT id FROM ' . tablename($this->ordertable) . ' WHERE id = \'' . $orderid . '\'');

			if (empty($order['id'])) {
				message('抱歉，信息不存在或是已经被删除！');
			}


			pdo_delete($this->ordertable, array('id' => $orderid));
			message("删除成功！", referer(), "success");
		}


		include $this->template('addsection');
	}

	public function dowebFans()
	{
		global $_W;
		global $_GPC;
		$pageNumber = max(1, intval($_GPC['page']));
		$pageSize = 100;
		$condition = ' and 1 = 1';
		$nickname = $_GPC['nickname'];

		if (!empty($nickname)) {
			$condition .= ' AND fs.nickname like \'%' . $nickname . '%\'';
		}


		$state = intval($_GPC['state']);

		if ($state == 1) {
			$condition .= ' and fs.fname != \'\' and fs.fmobile != \'\' ';
		}


		$status = intval($_GPC['status']);

		if ($status == 2) {
			$condition .= ' and fs.status = 2 ';
		}


		$sql = 'SELECT fs.*,sh.sharecount,sh.verify FROM ' . tablename($this->fanstable) . ' as fs' . "\r\n\t\t\t\t\t" . 'left join ' . tablename($this->sharetable) . ' sh on fs.id = sh.fansid' . "\r\n\t\t\t\t\t\t\t\t" . 'WHERE fs.uniacid = \'' . $_W['uniacid'] . '\' and (sh.uniacid is null or sh.uniacid = \'' . $_W['uniacid'] . '\')  ' . $condition . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'ORDER BY fs.state desc,fs.id desc LIMIT ' . (($pageNumber - 1) * $pageSize) . ',' . $pageSize;
		$list = pdo_fetchall($sql);
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->fanstable) . ' as fs' . "\r\n\t\t\t\t\t" . 'left join ' . tablename($this->sharetable) . ' sh on fs.id = sh.fansid' . "\r\n\t\t\t\t\t\t" . 'WHERE fs.uniacid = \'' . $_W['uniacid'] . '\' and (sh.uniacid is null or sh.uniacid = \'' . $_W['uniacid'] . '\')  ' . $condition . ' ORDER BY fs.state desc,fs.id');
		$pager = pagination($total, $pageNumber, $pageSize);
		include $this->template('fans');
	}

	public function dowebaddFans()
	{
		global $_W;
		global $_GPC;
		load()->func("tpl");
		$fansid = intval($_GPC['fansid']);

		if (0 < $fansid) {
			$fans = pdo_fetch('SELECT * FROM ' . tablename($this->fanstable) . ' WHERE id= \'' . $fansid . '\'');

			if (!$fans) {
				message('抱歉，信息不存在或是已经删除！', '', 'error');
			}

		}


		if ($_GPC['op'] == 'delete') {
			$fans = pdo_fetch('SELECT * FROM ' . tablename($this->fanstable) . ' WHERE id= \'' . $fansid . '\'');

			if (empty($fans)) {
				message('抱歉，信息不存在或是已经被删除！');
			}


			pdo_delete($this->fanstable, array('id' => $fansid));
			message("删除成功！", referer(), "success");
		}


		if ($_GPC['op'] == 'admin') {
			$fans = pdo_fetch('SELECT * FROM ' . tablename($this->fanstable) . ' WHERE id= \'' . $fansid . '\'');

			if (empty($fans)) {
				message('抱歉，信息不存在或是已经被删除！');
			}


			pdo_update($this->fanstable, array('status' => 2), array('id' => $fansid));
			message("设置员工成功！", referer(), "success");
		}


		if ($_GPC['op'] == 'unadmin') {
			$fans = pdo_fetch('SELECT * FROM ' . tablename($this->fanstable) . ' WHERE id= \'' . $fansid . '\'');

			if (empty($fans)) {
				message('抱歉，信息不存在或是已经被删除！');
			}


			pdo_update($this->fanstable, array('status' => 0), array('id' => $fansid));
			message("移除员工成功！", referer(), "success");
		}


		if ($_GPC['op'] == 'black') {
			$fans = pdo_fetch('SELECT * FROM ' . tablename($this->fanstable) . ' WHERE id= \'' . $fansid . '\'');

			if (empty($fans)) {
				message('抱歉，信息不存在或是已经被删除！');
			}


			pdo_update($this->fanstable, array('state' => 1), array('id' => $fansid));
			message("拉黑成功！", referer(), "success");
		}


		if ($_GPC['op'] == 'unblack') {
			$fans = pdo_fetch('SELECT * FROM ' . tablename($this->fanstable) . ' WHERE id= \'' . $fansid . '\'');

			if (empty($fans)) {
				message('抱歉，信息不存在或是已经被删除！');
			}


			pdo_update($this->fanstable, array('state' => 0), array('id' => $fansid));
			message("移除黑名单成功！", referer(), "success");
		}


		include $this->template('addfans');
	}

	public function getShareByFansid($fansid)
	{
		global $_W;
		$result = pdo_fetch('SELECT * FROM ' . tablename($this->sharetable) . ' ' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . 'WHERE fansid = \'' . $fansid . '\' and uniacid = \'' . $_W['uniacid'] . '\'');
		return $result;
	}

	public function getPriceSumByGroupid($groupid)
	{
		global $_W;
		$result = pdo_fetch('SELECT count(*) as cnt FROM ' . tablename($this->pricetable) . ' ' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . 'WHERE state = 1 and pricegroupid = \'' . $groupid . '\' and uniacid = \'' . $_W['uniacid'] . '\'');
		return ($result['cnt'] <= 0 ? 0 : $result['cnt']);
	}

	public function getThemeSumByTid($themeid)
	{
		global $_W;
		$result = pdo_fetch('SELECT count(*) as cnt FROM ( SELECT id from ' . tablename($this->ordertable) . ' ' . "\r\n\t\t\t\t" . 'WHERE themeid = \'' . $themeid . '\' and uniacid = \'' . $_W['uniacid'] . '\' group by fansid) as t ');
		return ($result['cnt'] <= 0 ? 0 : $result['cnt']);
	}

	public function getThemeShareGiftVerifySumByTid($themeid)
	{
		global $_W;
		$result = pdo_fetch('SELECT count(*) as cnt FROM ' . tablename($this->sharetable) . ' ' . "\r\n\t\t\t\t\t\t\t" . 'WHERE themeid = \'' . $themeid . '\' and verify = 1  and uniacid = \'' . $_W['uniacid'] . '\'');
		return ($result['cnt'] <= 0 ? 0 : $result['cnt']);
	}

	public function getThemeShareGiftValidSumByTid($themeid, $limit)
	{
		global $_W;
		$result = pdo_fetch('SELECT count(*) as cnt FROM ' . tablename($this->sharetable) . "\r\n\t\t\t\t" . 'WHERE themeid = \'' . $themeid . '\'  and uniacid = \'' . $_W['uniacid'] . '\' and  sharecount > ' . $limit);
		return ($result['cnt'] <= 0 ? 0 : $result['cnt']);
	}

	public function getValidFansSum()
	{
		global $_W;
		$result = pdo_fetch('SELECT count(*) as cnt FROM ' . tablename($this->fanstable) . ' ' . "\r\n\t\t\t\t\t\t\t" . 'WHERE fname != \'\' and fmobile != \'\'  and uniacid = \'' . $_W['uniacid'] . '\'');
		return ($result['cnt'] <= 0 ? 0 : $result['cnt']);
	}

	private function createEWM($url)
	{
		global $_W;
		require_once "phpqrcode.php";
		$errorCorrectionLevel = 'L';
		$matrixPointSize = 3;
		$path = '../attachment/images/water_groupbuy/';

		if (!file_exists($path)) {
			mkdir($path);
		}


		$time = time();
		$wwwurl = $_W['siteroot'] . 'attachment/';
		$QR = $path . $time . '.png';
		$QR2 = $path . $time . '2.png';
		$filepath = 'images/water_groupbuy/' . $time . '2.png';
		QRcode::png($url, $QR, $errorCorrectionLevel, $matrixPointSize, 2);
		$logo = '../addons/water_groupbuy/logo.png';

		if ($logo !== false) {
			$QR = imagecreatefromstring(file_get_contents($QR));
			$logo = imagecreatefromstring(file_get_contents($logo));
			$QR_width = imagesx($QR);
			$QR_height = imagesy($QR);
			$logo_width = imagesx($logo);
			$logo_height = imagesy($logo);
			$logo_qr_width = $QR_width / 5;
			$scale = $logo_width / $logo_qr_width;
			$logo_qr_height = $logo_height / $scale;
			$from_width = ($QR_width - $logo_qr_width) / 2;
			imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
		}


		imagepng($QR, $QR2);
		return $wwwurl . $filepath;
	}

	private function checkWechatTran($setting, $transid)
	{
		$wechat = $setting['payment']['wechat'];
		$sql = 'SELECT `key`,`secret` FROM ' . tablename('account_wechats') . ' WHERE `acid`=:acid';
		$row = pdo_fetch($sql, array(':acid' => $wechat['account']));
		$wechat['appid'] = $row['key'];
		$url = 'https://api.mch.weixin.qq.com/pay/orderquery';
		$random = random(8);
		$post = array('appid' => $wechat['appid'], 'transaction_id' => $transid, 'nonce_str' => $random, 'mch_id' => $wechat['mchid']);
		ksort($post);
		$string = $this->ToUrlParams($post);
		$string .= '&key=' . $wechat['signkey'];
		$sign = md5($string);
		$post['sign'] = strtoupper($sign);
		$resp = $this->postXmlCurl($this->ToXml($post), $url);
		libxml_disable_entity_loader(true);
		$resp = json_decode(json_encode(simplexml_load_string($resp, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

		if ($resp['result_code'] != 'SUCCESS') {
			exit('fail');
		}


		if ($resp['trade_state'] == 'SUCCESS') {
			return array('code' => 1, 'fee' => $resp['total_fee'] / 100);
		}

	}

	private function ToUrlParams($urlObj)
	{
		$buff = '';

		foreach ($urlObj as $k => $v ) {
			if ($k != 'sign') {
				$buff .= $k . '=' . $v . '&';
			}

		}

		$buff = trim($buff, '&');
		return $buff;
	}

	private function postXmlCurl($xml, $url, $useCert = false, $second = 30)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_TIMEOUT, $second);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		if ($useCert == true) {
			curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
			curl_setopt($ch, CURLOPT_SSLCERT, WxPayConfig::SSLCERT_PATH);
			curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
			curl_setopt($ch, CURLOPT_SSLKEY, WxPayConfig::SSLKEY_PATH);
		}


		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		$data = curl_exec($ch);

		if ($data) {
			curl_close($ch);
			return $data;
		}

	}

	private function ToXml($post)
	{
		$xml = '<xml>';

		foreach ($post as $key => $val ) {
			if (is_numeric($val)) {
				$xml .= '<' . $key . '>' . $val . '</' . $key . '>';
			}
			 else {
				$xml .= '<' . $key . '><![CDATA[' . $val . ']]></' . $key . '>';
			}
		}

		$xml .= '</xml>';
		return $xml;
	}

	public function sqr($n)
	{
		return $n * $n;
	}

	public function xRandom($bonus_min, $bonus_max)
	{
		$sqr = intval($this->sqr($bonus_max - $bonus_min));
		$rand_num = rand(0, $sqr - 1);
		return intval(sqrt($rand_num));
	}

	public function getMillisecond()
	{
		list($t1, $t2) = explode(' ', microtime());
		$basecode = (double) sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
		return date("YmdHis") . substr($basecode, 2, 10) . mt_rand(1000, 9999);
	}

	public function getToken()
	{
		global $_W;
		load()->classs("weixin.account");
		$id = $_W['acid'];

		if (empty($id)) {
			$id = $_W['uniacid'];
		}


		$accObj = WeixinAccount::create($id);
		$access_token = $accObj->fetch_token();
		return $access_token;
	}

	public function sendMBXX($access_token, $data)
	{
		$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $access_token;
		ihttp_post($url, json_encode($data));
	}

	public function getFansDBInfo($openid)
	{
		global $_W;
		$fans = pdo_fetch('SELECT * FROM ' . tablename($this->fanstable) . ' WHERE uniacid = \'' . $_W['uniacid'] . '\' and openid =\'' . $openid . '\'');
		return $fans;
	}

	public function checkinfo()
	{
		global $_GPC;
		global $_W;
		$system = $this->module['config'];

		if ($system['auth'] == 0) {
			$openid = $_W['fans']['from_user'];
			$fans = $this->getFansDBInfo($openid);

			if (empty($fans)) {
				$authuser = $this->authUser();
				$fans = $this->addFans($authuser);
			}

		}
		 else {
			$openid = $_SESSION['water_groupbuy_authpenid'];

			if (empty($openid)) {
				$authuser = $this->authUser();
				$openid = $authuser['openid'];
				$fans = $this->getFansDBInfo($openid);

				if (empty($fans)) {
					$fans = $this->addFans($authuser);
				}


				$_SESSION['water_groupbuy_authpenid'] = $fans['openid'];
			}
			 else {
				$fans = $this->getFansDBInfo($openid);
			}
		}

		return $fans;
	}

	public function checkopenid()
	{
		global $_GPC;
		global $_W;
		$system = $this->module['config'];

		if ($system['auth'] == 0) {
			$openid = $_W['fans']['from_user'];
		}
		 else {
			$openid = $_SESSION['water_groupbuy_authpenid'];

			if (empty($openid)) {
				$openid = $this->authOpenid();
				$_SESSION['water_groupbuy_authpenid'] = $openid;
			}

		}

		return $openid;
	}

	public function authOpenid()
	{
		global $_GPC;
		global $_W;

		if (!isset($_GPC['code'])) {
			$baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
			$baseUrl = urlencode($baseUrl);
			$url = $this->__CreateOauthUrlForCode($baseUrl, 'snsapi_base');
			Header('Location:' . $url);
			exit();
			return;
		}


		$code = $_GPC['code'];
		$base = $this->getBaseFromMp($code);
		return $base['openid'];
	}

	public function authUser()
	{
		global $_GPC;
		global $_W;

		if (!isset($_GPC['code'])) {
			$baseUrl = urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
			$url = $this->__CreateOauthUrlForCode($baseUrl, 'snsapi_userinfo');
			Header('Location: ' . $url);
			exit();
			return;
		}


		$code = $_GPC['code'];
		$base = $this->getBaseFromMp($code);
		$user = $this->getUserInfoFromMp($base);
		return $user;
	}

	private function __CreateOauthUrlForCode($redirectUrl, $scope)
	{
		global $_W;
		$system = $this->module['config'];
		$urlObj['appid'] = $system['appid'];
		$urlObj['redirect_uri'] = $redirectUrl;
		$urlObj['response_type'] = 'code';
		$urlObj['scope'] = $scope;
		$urlObj['state'] = 'STATE' . '#wechat_redirect';
		$bizString = $this->ToUrlParams($urlObj);
		return "https://open.weixin.qq.com/connect/oauth2/authorize?" . $bizString;
	}

	public function getBaseFromMp($code)
	{
		$url = $this->__CreateOauthUrlForOpenid($code);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($res, true);
		$base = array();
		$base['openid'] = $data['openid'];
		$base['access_token'] = $data['access_token'];
		return $base;
	}

	public function getUserInfoFromMp($base)
	{
		$url = $this->__CreateOauthUrlForUserInfo($base);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$res = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($res, true);
		return $data;
	}

	private function __CreateOauthUrlForOpenid($code)
	{
		global $_W;
		$system = $this->module['config'];
		$urlObj['appid'] = $system['appid'];
		$urlObj['secret'] = $system['secret'];
		$urlObj['code'] = $code;
		$urlObj['grant_type'] = 'authorization_code';
		$bizString = $this->ToUrlParams($urlObj);
		return "https://api.weixin.qq.com/sns/oauth2/access_token?" . $bizString;
	}

	private function __CreateOauthUrlForUserInfo($base)
	{
		global $_W;
		$urlObj['access_token'] = $base['access_token'];
		$urlObj['openid'] = $base['openid'];
		$bizString = $this->ToUrlParams($urlObj);
		return "https://api.weixin.qq.com/sns/userinfo?" . $bizString;
	}

	private function addFans($info)
	{
		global $_W;
		$data = array();

		if (!empty($info['nickname']) && !empty($info['openid'])) {
			$data = array('uniacid' => $_W['uniacid'], 'openid' => $info['openid'], 'nickname' => $info['nickname'], 'headimgurl' => $info['headimgurl'], 'sex' => $info['sex'], 'addtime' => date('Y-m-d H:i:s'));
			$flag = $_W['uniacid'] . $info['openid'];
			$addfans = $_SESSION['water_live_addfans'];
			if (empty($addfans) || ($addfans != $flag)) {
				$_SESSION['water_live_addfans'] = $flag;
				pdo_insert($this->fanstable, $data);
				$fansid = pdo_insertid();
			}

		}


		return $data;
	}

	private function addOrder($fans, $post, $themeid, $workerid)
	{
		global $_W;
		$fee = $post['total_fee'] / 100;
		$data = array('uniacid' => $_W['uniacid'], 'orderno' => $post['out_trade_no'], 'themeid' => $themeid, 'workerid' => $workerid, 'fee' => $fee, 'fansid' => $fans['id'], 'openid' => $fans['openid'], 'nickname' => $fans['nickname'], 'headimgurl' => $fans['headimgurl'], 'addtime' => date('Y-m-d H:i:s'));
		pdo_insert($this->ordertable, $data);
		$orderid = pdo_insertid();
		return $orderid;
	}

	public function doMobileGetPrepay()
	{
		global $_GPC;
		global $_W;
		$openid = $this->checkopenid();
		$fans = $this->getFansDBInfo($openid);

		if (empty($fans)) {
			$result = array('errcode' => 1, 'errmsg' => '用户信息不存在');
			exit(json_encode($result));
		}


		$themeid = intval($_GPC['themeid']);
		$workerid = intval($_GPC['workerid']);
		$fname = $_GPC['fname'];
		$fmobile = $_GPC['fmobile'];
		if (empty($fname) || empty($fmobile)) {
			$result = array('errcode' => 1, 'errmsg' => '用户名和手机号码不可为空');
			exit(json_encode($result));
		}


		pdo_update($this->fanstable, array('fname' => $fname, 'fmobile' => $fmobile), array('id' => $fans['id']));
		$theme = pdo_fetch('SELECT typeid,payfee,state FROM ' . tablename($this->themetable) . ' WHERE id = \'' . $themeid . '\'');

		if ($theme['state'] != 1) {
			$result = array('errcode' => 1, 'errmsg' => '活动已经结束或者不存在');
			exit(json_encode($result));
		}


		$desc = '活动付款';
		$fee = floatval($theme['payfee']);
		$result = $this->unifiedPay($fans, $desc, $fee, $themeid, $workerid);
		exit(json_encode($result));
	}

	public function doMobileCheckJsPayResult()
	{
		global $_GPC;
		global $_W;
		$openid = $this->checkopenid();
		$fans = $this->getFansDBInfo($openid);
		$orderno = $_GPC['orderno'];
		$orderid = $_GPC['orderid'];
		$order = pdo_fetch('SELECT orderno FROM ' . tablename($this->ordertable) . ' WHERE id = \'' . $orderid . '\' ');
		$result = $this->dealpayresult($order['orderno']);
		exit(json_encode($result));
	}

	private function dealpayresult($orderno)
	{
		global $_W;
		$result = array();

		if (empty($orderno)) {
			$result['errcode'] = 1;
			$result['errmsg'] = '订单号为空';
		}
		 else {
			$checkresult = $this->checkWechatTranByOrderNo($orderno);

			if ($checkresult['errcode'] == 0) {
				$order = pdo_fetch('SELECT * FROM ' . tablename($this->ordertable) . ' WHERE  uniacid = \'' . $_W['uniacid'] . '\' and orderno =\'' . $orderno . '\'');

				if ($order['paystate'] == 0) {
					$data = array('paystate' => 1, 'paytime' => date('Y-m-d H:i:s'));

					if ($order['state'] == 0) {
						$data['state'] = 1;
					}


					pdo_update($this->ordertable, $data, array('id' => $order['id']));
					pdo_delete($this->ordertable, array('themeid' => $order['themeid'], 'paystate' => 0, 'fansid' => $order['fansid']));
					$system = $this->module['config'];

					if (($system['noticeopen'] == 1) && !empty($system['orderpayok'])) {
						$url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('mode', array('themeid' => $order['themeid']));
						$this->sendNotice($url, $order['openid'], $system['orderpayok'], $order);
					}

				}


				$url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('mode', array('themeid' => $order['themeid']));
				$result['errcode'] = 0;
				$result['msg'] = '支付成功，感谢支持';
				$result['url'] = $url;
			}
			 else {
				$result['errcode'] = 1;
				$result['errmsg'] = $checkresult['errmsg'];
			}
		}

		return $result;
	}

	private function getPayOKData($order)
	{
		$datacontent = array(
			'first'    => array('value' => '您的订单已支付成功。 >>查看订单详情', 'color' => '#173177'),
			'keyword1' => array('value' => $order['nickname'], 'color' => '#173177'),
			'keyword2' => array('value' => $order['orderno'], 'color' => '#173177'),
			'keyword3' => array('value' => $order['fee'], 'color' => '#173177'),
			'keyword4' => array('value' => '查看活动页面', 'color' => '#173177'),
			'remark'   => array('value' => '谢谢支持', 'color' => '#173177')
			);
	}

	private function checkWechatTranByOrderNo($orderno)
	{
		global $_W;
		$system = $this->module['config'];
		$url = 'https://api.mch.weixin.qq.com/pay/orderquery';
		$random = random(8);
		$post = array('appid' => $system['appid'], 'out_trade_no' => $orderno, 'nonce_str' => $random, 'mch_id' => $system['mchid']);
		ksort($post);
		$string = $this->ToUrlParams($post);
		$string .= '&key=' . $system['apikey'];
		$sign = md5($string);
		$post['sign'] = strtoupper($sign);
		$resp = $this->postXmlCurl($this->ToXml($post), $url);
		libxml_disable_entity_loader(true);
		$resp = json_decode(json_encode(simplexml_load_string($resp, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

		if ($resp['return_code'] == 'SUCCESS') {
			if ($resp['result_code'] == 'SUCCESS') {
				if ($resp['trade_state'] == 'SUCCESS') {
					return array('errcode' => 0, 'fee' => $resp['total_fee'] / 100);
				}


				return array("errcode" => 1, "errmsg" => "未支付:" . $resp['trade_state']);
			}


			return array("errcode" => 1, "errmsg" => "订单不存在" . $resp['err_code']);
		}


		return array("errcode" => 1, "errmsg" => "查询失败:" . $resp['return_msg']);
	}

	private function unifiedOrder($fans, $sectionid, $desc, $fee)
	{
		global $_W;
		$system = $this->module['config'];
		$url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
		$random = random(8);
		$orderno = $this->getMillisecond();
		$trade_type = 'JSAPI';

		if ($system['auth'] == 1) {
			$trade_type = 'NATIVE';
		}


		$post = array('appid' => $system['appid'], 'mch_id' => $system['mchid'], 'nonce_str' => $random, 'body' => $desc, 'out_trade_no' => $orderno, 'total_fee' => $fee * 100, 'spbill_create_ip' => $system['ip'], 'notify_url' => 'http://' . $_SERVER['HTTP_HOST'] . '/payment/wechat/pay.php', 'trade_type' => $trade_type, 'openid' => $fans['openid']);
		ksort($post);
		$string = $this->ToUrlParams($post);
		$string .= '&key=' . $system['apikey'];
		$sign = md5($string);
		$post['sign'] = strtoupper($sign);
		$resp = $this->postXmlCurl($this->ToXml($post), $url);
		libxml_disable_entity_loader(true);
		$resp = json_decode(json_encode(simplexml_load_string($resp, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

		if ($resp['result_code'] != 'SUCCESS') {
			return array('errcode' => 1, 'errmsg' => $resp['return_msg']);
		}


		$orderid = $this->addOrder($fans, $sectionid, $post);
		return array("errcode" => 0, "prepay_id" => $resp['prepay_id'], 'code_url' => $resp['code_url'], 'orderno' => $orderno, 'orderid' => $orderid);
	}

	private function unifiedPay($fans, $desc, $fee, $coreid, $workerid)
	{
		global $_W;
		$system = $this->module['config'];
		$url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
		$random = random(8);
		$orderno = $this->getMillisecond();
		$trade_type = 'JSAPI';
		$thisappid = $_W['account']['key'];

		if ($system['auth'] == 1) {
			$trade_type = 'NATIVE';
		}


		$post = array('appid' => $system['appid'], 'mch_id' => $system['mchid'], 'nonce_str' => $random, 'body' => $desc, 'out_trade_no' => $orderno, 'total_fee' => $fee * 100, 'spbill_create_ip' => $system['ip'], 'notify_url' => 'http://' . $_SERVER['HTTP_HOST'] . '/payment/wechat/pay.php', 'trade_type' => $trade_type, 'openid' => $fans['openid']);
		ksort($post);
		$string = $this->ToUrlParams($post);
		$string .= '&key=' . $system['apikey'];
		$sign = md5($string);
		$post['sign'] = strtoupper($sign);
		$resp = $this->postXmlCurl($this->ToXml($post), $url);
		libxml_disable_entity_loader(true);
		$resp = json_decode(json_encode(simplexml_load_string($resp, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

		if ($resp['result_code'] != 'SUCCESS') {
			return array('errcode' => 1, 'errmsg' => $resp['return_msg']);
		}


		$orderid = $this->addOrder($fans, $post, $coreid, $workerid);

		if ($system['auth'] == 0) {
			$params = $this->getWxPayJsParams($resp['prepay_id']);
			$result = array('errcode' => 0, 'auth' => 0, 'timeStamp' => $params['timeStamp'], 'nonceStr' => $params['nonceStr'], 'package' => $params['package'], 'signType' => $params['signType'], 'paySign' => $params['paySign'], 'orderno' => $orderno, 'orderid' => $orderid);
		}
		 else {
			$url = 'http://paysdk.weixin.qq.com/example/qrcode.php?data=';
			$result = array('errcode' => 0, 'auth' => 1, 'orderno' => $orderno, 'orderid' => $orderid, 'code_url' => $url . $resp['code_url']);
		}

		return $result;
	}

	private function getWxPayJsParams($prepay_id)
	{
		global $_W;
		$system = $this->module['config'];
		$random = random(8);
		$post = array('appId' => $system['appid'], 'timeStamp' => time(), 'nonceStr' => $random, 'package' => 'prepay_id=' . $prepay_id, 'signType' => 'MD5');
		ksort($post);
		$string = $this->ToUrlParams($post);
		$string .= '&key=' . $system['apikey'];
		$sign = md5($string);
		$post['paySign'] = strtoupper($sign);
		return $post;
	}
}


?>