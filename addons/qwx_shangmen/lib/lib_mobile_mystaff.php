<?php 
global $_GPC, $_W;
load()->func('tpl');

//检查用户是否登录：
checkauth();
$member = get_member_info();
$uid = $member['uid'];
$is_staff = is_staff($uid);

//读取该用户的订单包含的staff id:
$sql = "select * from ".tablename('daojia_order')." where uniacid = '{$_W['uniacid']}' and uid = '{$uid}' ";
$orders = pdo_fetchall($sql);
$staff_id = array();
if (is_array($orders)){
        foreach ($orders as $key=>$item){
                if ($item['staff_id']){
                        $staff_id[] = $item['staff_id'];

                }
        }
}
$staff_id = array_unique($staff_id);

//读取订单列表的数据：
//读取项目的数据：
$pindex = max(1, intval($_GPC['page']));
$psize = 10;//@test;
$where = '';

if (sizeof($staff_id)>0){
        $staff_id = join(',',$staff_id);
        $where .= " and id in ($staff_id) ";
}else{
        $where .= ' and id = 0 ';
}

//预留筛选器：
if (!$_GPC['store_id']){
        $status = 1;
}
if ($store_id == 1){
        $where .= " and staff_store_id = {$store_id} ";
}

$sql = "select * from ".tablename("daojia_user")." where uniacid = '{$_W['uniacid']}' {$where} order by id desc LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
$list = pdo_fetchall($sql);
$size = sizeof($list);

$sql = "select count(*) from ".tablename("daojia_user")." where uniacid = '{$_W['uniacid']}' {$where}  ";
$total = pdo_fetchcolumn($sql);
// $total = 0;//@test;

	$is_ajax = $_GPC['is_ajax'];
	if ($is_ajax){
		$return = array();
		$html = '';
		//组合html：
		if (is_array($list)){
			foreach ($list as $key=>$item){
				$url = $this->createMobileUrl('myorderdetail',array('id'=>$item['id']));
				$create_time = date("Y-m-d",strtotime($item['create_time']));
				$photo_url = $_W['attachurl'] . $item[staff_photo];
				$store_name = get_store_name($item['staff_store_id']);
				$store_name = "&nbsp;({$store_name})";
				// print_r($item);exit;
				$html .= <<<EOD
<a href="javascript:void(0);" data-id="{$item['id']}" onclick="select_staff({$item['id']})" >
    <dl>
        <dt>
        <img src="{$photo_url}">
        </dt>
        <dd>
            <h3 class="">{$item['staff_name']}{$store_name}</h3>
            <p>{$item['staff_desc']}</p>
            <p>工号：{$item['staff_work_no']}，电话：{$item['staff_phone']}</p>
        </dd>
    </dl>
</a>
EOD;
			}
		}

		$return['item'] = $html;
		$return['total'] = $total;
		if ($size>0){
			$return['page'] = 1;

		}else{
			$return['page'] = 0;
		}
		echo json_encode($return);exit;
	}


include $this->template('mystaff');
?>