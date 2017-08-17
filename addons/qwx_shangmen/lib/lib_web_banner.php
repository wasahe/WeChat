<?php 

	global $_GPC, $_W;
	load()->func('tpl');
	$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';

	if ($op == 'post'){
		$id = intval($_GPC['id']);
		if (!$id){
			$is_new = 1;
		}else{
			$is_new = 0;
		}

		// if ($_POST) {//@test;
		if (checksubmit('submit')) {
			// print_r($_POST);exit;

			$data = array();
			$data = $_GPC['jform'];
			$data['uniacid'] = $_W['uniacid'];
			
			$data['update_time'] = date("Y-m-d H:i:s");
			// print_r($data);exit;

			if ($is_new){
                                $data['create_time'] = date("Y-m-d H:i:s");
				pdo_insert('daojia_banner', $data);
				//$id = pdo_insertid();
			}else{
				pdo_update('daojia_banner', $data, array('id' => $id));
				
			}
			
			message('资料更新成功！', $this->createWebUrl('banner', array('op' => 'display')), 'success');

		}

		//default：
		if ($is_new){
			$item = array();
			$item['status'] = 1;
		}else{
			//读取资料：
			$sql = "select * from ".tablename('daojia_banner'). " where uniacid = '{$_W['uniacid']}' and id='{$id}' limit 1 ";
			$item = pdo_fetch($sql);
			// print_r($item);
		}

		include $this->template('banner_post');
	}else if ($op == 'delete'){
		$id = intval($_GPC['id']);
		$id_arr = $_GPC['delete'];
		if (!is_array($id_arr)){
			$id = intval($_GPC['id']);
			$id_arr[] = $id;
		}
		// print_r($id_arr);exit;
		// echo $id;exit;

		if (is_array($id_arr) && sizeof($id_arr)){
			foreach ($id_arr as $id){
				$sql = "delete from ".tablename('daojia_banner'). " WHERE uniacid = {$_W['uniacid']} and id = '{$id}' limit 1 ";
				// echo $sql;exit;
				pdo_query($sql);
			}
		}else{
			message('抱歉，要删除的项目不存在或是已经被删除！');
		}

		message('删除成功！', $this->createWebUrl('banner', array('op' => 'display')), 'success');
	}else{
		//display list:
		$sql = "SELECT * FROM " . tablename('daojia_banner') . " as a ".
				" WHERE a.uniacid = '{$_W['uniacid']}' $condition 
				ORDER BY a.orderby desc,a.create_time DESC" ;
		// echo $sql;exit;
		$list = pdo_fetchall($sql);

		// print_r($_W);exit;

		include $this->template('banner');

	}
?>