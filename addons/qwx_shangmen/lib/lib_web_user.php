<?php 
	global $_GPC, $_W;
	load()->func('tpl');
	$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';

	if ($op == 'set_staff'){
		//设为美容师：
		$user_type = (int)$_GPC['user_type'];
		$uid = (int)$_GPC['uid'];

		$sql = "select * from ".tablename('daojia_user') 
				. " where uniacid = '{$_W['uniacid']}' and member_id = '{$uid}' limit 1";
		$user = pdo_fetch($sql);

		$data = array();
		$data['user_type'] = $user_type;
		if (!$user['id']){
			$data['member_id'] = $uid;
			$data['uniacid'] = $_W['uniacid'];
			pdo_insert('daojia_user',$data);
		}else{
			pdo_update('daojia_user',$data,array('member_id'=>$uid));	
		}
		// print_r($data);exit;

		message('设置成功！', $this->createWebUrl('user', array('op' => 'display')), 'success');

	
	}else{
		//display list:
		//显示资源列表；
		$pindex = max(1, intval($_GPC['page']));
		$psize = 15;

		//filter:
		$condition = ' and a.uid != "" ';
		if (!empty($_GPC['keyword'])) {
			$condition .= " AND (
								a.realname LIKE '%{$_GPC['keyword']}%' 
								or a.nickname LIKE '%{$_GPC['keyword']}%' 
								or a.email LIKE '%{$_GPC['keyword']}%' 
								or f.openid LIKE '%{$_GPC['keyword']}%' 
							)";
		}
		
		/*if ($_GPC['status']>-1) {
			$condition .= " AND b.status = '" . intval($_GPC['status']) . "'";
		}else{
			$_GPC['status'] = -1;
		}*/

		//不显示被隐藏的订单，特征是status=-1;
		// $condition .= ' and b.user_type != 1 ';
		$sql = "SELECT a.*,f.openid,b.user_type,b.id as item_id "
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
				" left join ".tablename('daojia_user') ." as b on a.uid  = b.member_id ".
				" left join ".tablename('mc_mapping_fans') ." as f on a.uid  = f.uid ".
				" WHERE a.uniacid = '{$_W['uniacid']}' $condition ";
		$total = pdo_fetchcolumn($sql);
		$pager = pagination($total, $pindex, $psize);

		// print_r($_W);exit;

		include $this->template('user');

	}
?>