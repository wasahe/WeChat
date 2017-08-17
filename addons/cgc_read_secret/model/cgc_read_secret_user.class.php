<?php


class cgc_read_secret_user
{
	public function __construct()
	{
		$this->table_name = 'cgc_read_secret_user';
		$this->columns = '*';
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

	public function getByConAll($con)
	{
		global $_W;
		$sql = 'SELECT * FROM ' . tablename($this->table_name) . ' WHERE uniacid=' . $_W['uniacid'] . ' ' . $con;
		$ds = pdo_fetchall($sql);
		return $ds;
	}

	public function getByCon($con)
	{
		global $_W;
		$sql = 'SELECT * FROM ' . tablename($this->table_name) . ' WHERE uniacid=' . $_W['uniacid'] . ' ' . $con;
		$ds = pdo_fetch($sql);
		return $ds;
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
     * 获取排名
     * @param unknown_type $con
     */
	public function getRanks($limit = 3)
	{
		global $_W;
		$sql = 'SELECT * FROM ' . tablename($this->table_name) . ' WHERE uniacid=' . $_W['uniacid'] . ' ' . $con . ' ORDER BY `total_amount` DESC limit ' . $limit;
		$ds = pdo_fetchall($sql);
		return $ds;
	}

	/**
     * 获取排名
     * @param unknown_type $con
     */
	public function getFriendRanks($con)
	{
		global $_W;
		$sql = 'SELECT * FROM ' . tablename($this->table_name) . ' WHERE uniacid=' . $_W['uniacid'] . ' ' . $con;
		$ds = pdo_fetchall($sql);
		return $ds;
	}

	public function getFriends($openid)
	{
		global $_W;
		$sql = 'SELECT * FROM ' . tablename($this->table_name) . ' WHERE uniacid=' . $_W['uniacid'] . ' and friend_openid=\'' . $openid . '\' ORDER BY `amount` DESC limit 3';
		$ds = pdo_fetchall($sql);
		return $ds;
	}

	public function sumData()
	{
		global $_W;
		$sql = 'update ' . tablename($this->table_name) . ' set total_amount=no_account_amount+amount WHERE uniacid=' . $_W['uniacid'];
		$ds = pdo_query($sql);
	}

	/**
     * 超过了全国 0% 的人
     * @param unknown_type $amount
     * @return number|string
     */
	public function getBeatPerc($amount = 0)
	{
		global $_W;
		$total = $this->getTotal('');
		if (($total == 0) || ($total == 1)) {
			return 0;
		}


		$con = ' and `total_amount`<' . $amount;
		$beatTotal = $this->getTotal($con);
		return intval(($beatTotal / ($total - 1)) * 100);
	}
}


?>