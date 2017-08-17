<?php
/*
*源码来自 悟空源码网
*www.5kym.com
*/
defined('IN_IA') or die('Access Denied');
class Xs_qgModuleSite extends WeModuleSite
{
	public function doMobileIndex()
	{
		global $_GPC, $_W;
		if ($_POST) {
			$num = $_GPC['goods_num'];
			if ($num) {
				$id = intval($_GPC['id']);
				$list = pdo_fetch('select * from ' . tablename('xs_dy') . ' where id=:id and uniacid=:uniacid ', array('uniacid' => $_W['uniacid'], 'id' => $id));
				$chargerecord['tid'] = $_SESSION['tid'];
				$fee = $list['money'] * intval($_GPC['goods_num']);
				if ($fee <= 0) {
					message('支付错误, 金额小于0');
				}
				$params = array('tid' => $chargerecord['tid'], 'ordersn' => $chargerecord['tid'], 'title' => '商品购买', 'fee' => $fee);
				$log = pdo_get('xs_order', array('uniacid' => $_W['uniacid'], 'tid' => $params['tid']));
				if (empty($log)) {
					$log = array('tid' => $params['tid'], 'goods_id' => $id, 'goods_state' => 0, 'goods_num' => $_GPC['goods_num'], 'name' => $_GPC['name'], 'tel' => $_GPC['phone_num'], 'address' => $_GPC['buyer_address'], 'state' => 0, 'money' => $fee, 'createtime' => time(), 'uniacid' => $_W['uniacid']);
					pdo_insert('xs_order', $log);
				}
				$this->pay($params);
				die;
			}
		}
		$id = intval($_GPC['id']);
		if (empty($id)){
			$id =1;
		}
		//if ($id) {
			$list = pdo_fetch('select * from ' . tablename('xs_dy') . ' where id=:id and uniacid=:uniacid ', array('uniacid' => $_W['uniacid'], 'id' => $id));
			if ($list) {
				$_SESSION['tid'] = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
				$images1 = explode('-', $list['one']);
				$images2 = explode('-', $list['two']);
				$images3 = explode('-', $list['three']);
				include $this->template('index');
			} else {
				echo "查看的页面不存在，或者复制单页的网址来进行访问！";
			}
		//} else {
		//	echo "oh on!";
		//}
	}
	public function doWebOrder()
	{
		global $_GPC, $_W;
		checklogin();
		if ($_GPC['fahuo'] == 1) {
			$id = $_GPC['id'];
			$user_data = array('goods_state' => 1);
			$result = pdo_update('xs_order', $user_data, array('id' => $id, 'uniacid' => $_W['uniacid']));
			if (!empty($result)) {
				message('发货成功');
			}
		}
		if ($_GPC['del'] == 1) {
			$id = $_GPC['id'];
			$result2 = pdo_query("DELETE FROM " . tablename('xs_order') . " WHERE id = :id and uniacid=:uniacid", array(':id' => $id, ':uniacid' => $_W['uniacid']));
			if (!empty($result2)) {
				message('删除成功');
			}
		}
		$state = array('未付款', '已付款');
		$goods_state = array('未发货', '已发货');
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$sql = "select * from" . tablename('xs_order') . " where uniacid=:uniacid order by id desc";
		$sql .= " limit " . ($pindex - 1) * $psize . ',' . $psize;
		$list = pdo_fetchall($sql, array('uniacid' => $_W['uniacid']));
		$total = pdo_fetchcolumn("select count(*) from" . tablename('xs_order') . " where uniacid=:uniacid order by id desc", array('uniacid' => $_W['uniacid']));
		$pager = pagination($total, $pindex, $psize);
		include $this->template('web/order');
	}
	public function doWebDanye()
	{
		global $_GPC, $_W;
		checklogin();
		if ($_GPC['del'] == 1) {
			$id = $_GPC['id'];
			$result = pdo_query("DELETE FROM " . tablename('xs_dy') . " WHERE id = :id", array(':id' => $id));
			if (!empty($result)) {
				message('删除成功');
			}
		}
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$sql = "select * from" . tablename('xs_dy') . " where uniacid=:uniacid order by id desc";
		$sql .= " limit " . ($pindex - 1) * $psize . ',' . $psize;
		$list = pdo_fetchall($sql, array('uniacid' => $_W['uniacid']));
		$total = pdo_fetchcolumn("select count(*) from" . tablename('xs_dy') . " where uniacid=:uniacid order by id desc", array('uniacid' => $_W['uniacid']));
		$pager = pagination($total, $pindex, $psize);
		include $this->template('web/index');
	}
	public function doWebDanyeadd()
	{
		global $_GPC, $_W;
		checklogin();
		if ($_POST['title']) {
			$one = '';
			for ($i = 0; $i < count($_GPC['one']); $i++) {
				$one .= $_GPC['one'][$i] . '-';
			}
			$two = '';
			for ($i = 0; $i < count($_GPC['two']); $i++) {
				$two .= $_GPC['two'][$i] . '-';
			}
			$three = '';
			for ($i = 0; $i < count($_GPC['three']); $i++) {
				$three .= $_GPC['three'][$i] . '-';
			}
			$user_data = array('title' => $_GPC['title'], 'one' => $one, 'two' => $two, 'three' => $three, 'shipin' => $_GPC['shipin'], 'tel' => $_GPC['tel'], 'money' => intval($_GPC['money']), 'dtime' => $_GPC['dtime'], 'createtime' => time(), 'uniacid' => $_W['uniacid']);
			$result = pdo_insert('xs_dy', $user_data);
			if (!empty($result)) {
				$uid = pdo_insertid();
				message('添加单页成功。');
			}
		} else {
			include $this->template('web/add');
		}
	}
	public function payResult($params)
	{
		global $_GPC, $_W;
		if ($params['result'] == 'success' && $params['from'] == 'return') {
			$order = pdo_get('xs_order', array('uniacid' => $_W['uniacid'], 'tid' => $params['tid']));
			if ($params['fee'] != $order['money']) {
				die('用户支付的金额与订单金额不符合');
			}
			$data = array('state' => '1');
			$result = pdo_update('xs_order', $data, array('tid' => $params['tid'], 'uniacid' => $_W['uniacid']));
		}
		if (empty($params['result']) || $params['result'] != 'success') {
		}
		if ($params['from'] == 'return') {
			if ($params['result'] == 'success') {
				message('支付成功！请关闭页面');
			} else {
				message('支付失败！');
			}
		}
	}
}