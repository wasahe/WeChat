<?php

class cgc_read_secret_record
{
	public function __construct()
	{
		$this->table_name = 'cgc_read_secret_record';
		$this->columns = '*';
	}

	public function getByConAll($con = '', $key = '')
	{
		global $_W;
		$sql = 'SELECT * FROM ' . tablename($this->table_name) . ' WHERE uniacid=' . $_W['uniacid'] . ' ' . $con;

		if (empty($key)) {
			$ds = pdo_fetchall($sql);
		}
		 else {
			$ds = pdo_fetchall($sql, array(), $key);
		}

		return $ds;
	}

	public function getByCon($con)
	{
		global $_W;
		$sql = 'SELECT * FROM ' . tablename($this->table_name) . ' WHERE uniacid=' . $_W['uniacid'] . ' ' . $con;
		$ds = pdo_fetch($sql);
		return $ds;
	}

	public function selectByOpenid($openid)
	{
		global $_W;
		$uniacid = $_W['uniacid'];
		$user = pdo_fetch('SELECT ' . $this->columns . ' FROM ' . tablename($this->table_name) . ' WHERE uniacid=' . $uniacid . ' and openid=:openid ', array(':openid' => $openid));
		return $user;
	}

	public function deleteAll()
	{
		global $_W;
		$condition = '`uniacid`=:uniacid';
		$pars = array();
		$pars[':uniacid'] = $_W['uniacid'];
		$sql = 'delete FROM ' . tablename($this->table_name) . ' WHERE ' . $condition;
		return pdo_query($sql, $pars);
	}

	public function insert($entity)
	{
		global $_W;
		$ret = pdo_insert($this->table_name, $entity);

		if (!empty($ret)) {
			$id = pdo_insertid();
			return $id;
		}


		return false;
	}

	public function modify($id, $entity)
	{
		global $_W;
		$id = intval($id);
		$ret = pdo_update($this->table_name, $entity, array('id' => $id));
		return $ret;
	}

	public function modifybysn($order_sn, $entity)
	{
		global $_W;
		$ret = pdo_update($this->table_name, $entity, array('order_sn' => $order_sn));
		return $ret;
	}

	public function delete($id)
	{
		global $_W;
		$pars = array();
		$pars[':uniacid'] = $_W['uniacid'];
		$pars[':id'] = $id;
		$sql = 'DELETE FROM ' . tablename($this->table_name) . ' WHERE `uniacid`=:uniacid AND `id`=:id';
		$ret = pdo_query($sql, $pars);
		return $ret;
	}

	public function getOrdersn($ordersn)
	{
		global $_W;
		$condition = '`uniacid`=:uniacid AND `order_sn`=:order_sn';
		$pars = array();
		$pars[':uniacid'] = $_W['uniacid'];
		$pars[':order_sn'] = $ordersn;
		$sql = 'SELECT * FROM ' . tablename($this->table_name) . ' WHERE ' . $condition;
		$entity = pdo_fetch($sql, $pars);
		return $entity;
	}

	public function getOne($id)
	{
		global $_W;
		$condition = '`uniacid`=:uniacid AND `id`=:id';
		$pars = array();
		$pars[':uniacid'] = $_W['uniacid'];
		$pars[':id'] = $id;
		$sql = 'SELECT * FROM ' . tablename($this->table_name) . ' WHERE ' . $condition;
		$entity = pdo_fetch($sql, $pars);
		return $entity;
	}

	public function getOrder_sn($order_sn)
	{
		global $_W;
		$condition = '`uniacid`=:uniacid AND `order_sn`=:order_sn';
		$pars = array();
		$pars[':uniacid'] = $_W['uniacid'];
		$pars[':order_sn'] = $order_sn;
		$sql = 'SELECT * FROM ' . tablename($this->table_name) . ' WHERE ' . $condition;
		$entity = pdo_fetch($sql, $pars);
		return $entity;
	}

	public function getAll($con, $pindex = 0, $psize = 20, &$total = 0)
	{
		global $_W;
		$sql = 'SELECT COUNT(*) FROM ' . tablename($this->table_name) . ' WHERE ' . $con;
		$total = pdo_fetchcolumn($sql);
		$start = ($pindex - 1) * $psize;
		$sql = 'SELECT * FROM ' . tablename($this->table_name) . ' WHERE ' . $con . ' ORDER BY `id` DESC LIMIT ' . $start . ',' . $psize;
		$ds = pdo_fetchall($sql);
		return $ds;
	}

	public function getTotal($con)
	{
		global $_W;
		$sql = 'SELECT COUNT(*) FROM ' . tablename($this->table_name) . ' WHERE uniacid=' . $_W['uniacid'] . '  ' . $con;
		$total = pdo_fetchcolumn($sql);
		return $total;
	}

	/**
     * 根据条件获取汇总金额
     * @param unknown_type $con
     */
	public function getTotalAmount($con)
	{
		global $_W;
		$sql = 'SELECT SUM(payment) FROM ' . tablename($this->table_name) . ' WHERE uniacid=' . $_W['uniacid'] . ' ' . $con;
		$total = pdo_fetchcolumn($sql);
		return $total;
	}
}


?>