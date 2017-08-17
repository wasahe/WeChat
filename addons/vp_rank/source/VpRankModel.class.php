<?php
 

class VpRankModel extends Model
{
	protected $_validate = array(
		array('name', 'require', '名称不能为空！'),
		array('name', '1,20', '名称长度为1~20个字', 0, 'length')
		);

	public function add($data = '', $options = array(), $replace = false)
	{
		if (empty($data)) {
			if (!empty($this->data)) {
				$data = $this->data;
				$this->data = array();
			}
			 else {
				$this->error = '没有数据';
				return false;
			}
		}


		$data['status'] = 1;
		$data['create_time'] = time();
		$data['update_time'] = time();
		pdo_insert($this->tableName, $data);
		return pdo_insertid();
	}

	public function save($data = '', $options = array(), $replace = false)
	{
		if (empty($data)) {
			if (!empty($this->data)) {
				$data = $this->data;
				$this->data = array();
			}
			 else {
				$this->error = '没有数据';
				return false;
			}
		}


		unset($data['uniacid']);
		$data['update_time'] = time();
		$ret = pdo_update($this->tableName, $data, array('id' => $data['id']));

		if ($ret === false) {
			$this->error = '数据更新失败';
			return false;
		}


		return true;
	}
}


?>