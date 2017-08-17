<?php 
	global $_GPC, $_W;
	load()->func('tpl');
	$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';

	if ($op == 'post'){
		$uid = $_GPC['uid'];
		if (!$uid){
			message('缺乏必要参数，请重试！',$this->createWebUrl('staff'),'error');
		}

		
		if ($_POST){

			$data = array();
			$data = $_GPC['jform'];
			$data['online'] = $_GPC['online'];
			// print_r($data);exit;

			pdo_update('daojia_user',$data,array('member_id'=>$uid));
			message('设置成功！', $this->createWebUrl('staff', array('op' => 'display')), 'success');
			// print_r($_POST);exit;

		}

		$sql = "select m.*,u.* from ".tablename('daojia_user')." as u 
				left join ".tablename('mc_members')." as m 
				on u.member_id = m.uid 
				where u.uniacid = '{$_W['uniacid']}' and u.member_id = '{$uid}' and u.user_type = 1 limit 1";
		$item = pdo_fetch($sql);
		$item['staff'] = json_decode($item['staff'],true);

		//读取门店的资料：
		$sql = "select * from ".tablename('daojia_store').
				" where uniacid = '{$_W['uniacid']}' and status = 1";
		$stores = pdo_fetchall($sql);

		// print_r($item);exit;

		include $this->template('staff_post');
	}else if ($op == 'set_online'){
		//设为美容师：
		$online = (int)$_GPC['online'];
		$uid = (int)$_GPC['uid'];

		$sql = "select * from ".tablename('daojia_user') 
				. " where uniacid = '{$_W['uniacid']}' and member_id = '{$uid}' limit 1";
		$user = pdo_fetch($sql);

		$data = array();
		$data['online'] = $online;
		if (!$user['id']){
			$data['member_id'] = $uid;
			$data['uniacid'] = $_W['uniacid'];
			pdo_insert('daojia_user',$data);
		}else{
			pdo_update('daojia_user',$data,array('member_id'=>$uid));	
		}
		// print_r($data);exit;

		message('设置成功！', $this->createWebUrl('staff', array('op' => 'display')), 'success');

	
	}else{
		//display list:
		//显示资源列表；
		$pindex = max(1, intval($_GPC['page']));
		$psize = 15;

		//filter:
		$condition = ' and a.uid != "" ';
		if (!empty($_GPC['keyword'])) {
			$condition .= " AND (a.realname LIKE '%{$_GPC['keyword']}%' or f.openid like '%{$_GPC['keyword']}%' or b.staff_name like '%{$_GPC['keyword']}%' ) ";
		}
		
		if ($_GPC['online']>-1) {
			$condition .= " AND b.online = '" . intval($_GPC['online']) . "'";
		}else{
			$_GPC['online'] = -1;
		}

		//不显示被隐藏的订单，特征是status=-1;
		$condition .= ' and b.user_type = 1 ';
		$sql = "SELECT a.*,f.openid,b.*,b.id as item_id "
                        . "FROM " . tablename('mc_members') . " as a ".
                        " left join ".tablename('daojia_user') ." as b on a.uid  = b.member_id ".
                        " left join ".tablename('mc_mapping_fans') ." as f on a.uid  = f.uid ".
                        " WHERE a.uniacid = '{$_W['uniacid']}' $condition 
                        ORDER BY a.uid DESC LIMIT " . 
                        ($pindex - 1) * $psize . ',' . $psize;
		// echo $sql;exit;
		$list = pdo_fetchall($sql);
		// print_r($list);exit;
		$sql = "SELECT COUNT(*) FROM " . tablename('mc_members') . " as a ".
				" left join ".tablename('daojia_user') ." as b on a.uid  = b. member_id ".
				" left join ".tablename('mc_mapping_fans') ." as f on a.uid  = f.uid ".
				" WHERE a.uniacid = '{$_W['uniacid']}' $condition ";
		$total = pdo_fetchcolumn($sql);
		$pager = pagination($total, $pindex, $psize);



		if (is_array($list)){
			foreach ($list as $key=>$item){
				// print_r($item);exit;
				$list[$key]['staff'] = json_decode($item['staff'],true);//staff 美容师的资料

			}

		}

		// print_r($list);exit;

		include $this->template('staff');

	}
?>