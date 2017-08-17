<?php 
global $_GPC, $_W;
load()->func('tpl');
$source = $_GPC['source'];

//选择美容师：
$op = $_GPC['op'];
	if ($op == 'select_staff'){
		// print_r($_GPC);exit;
		$yuyue_time = $_GPC['yuyue_time'];
                //24小时处理
                list($yuyue_time_ymd, $yuyue_time_hi) = explode(' ', $yuyue_time);
                list($yuyue_time_h, $yuyue_time_i) = explode(':', $yuyue_time_hi);
                if ($yuyue_time_h > 24) {
                    $yuyue_time_h -= 12;
                }
                $yuyue_time = $yuyue_time_ymd . ' ' . $yuyue_time_h . ':' . $yuyue_time_i;
                
		if ($yuyue_time){
			$yuyue_time = date("Y-m-d H:i",strtotime($yuyue_time));
		}else{
			$yuyue_time = '';
		}
                if (date('Y-m-d', strtotime($yuyue_time)) < date('Y-m-d')) {
                    $return = array();
                    $return['code'] = 0;
                    $return['msg'] = '请选择预约时间';
                    echo json_encode($return);exit;                    
                }
		$_SESSION['select_yuyue_time'] = $yuyue_time;
		$_SESSION['select_staff_id'] = $_GPC['staff_id'];
		$return = array();
		$return['code'] = 1;
		$return['msg'] = $this->getFieldsLabel('staff_name').'选择成功！';
		echo json_encode($return);exit;
	}
	
//读取订单列表的数据：
//读取项目的数据：
$pindex = max(1, intval($_GPC['page']));
$psize = 10;//@test;
$where = '';

//预留筛选器：
if (!$_GPC['store_id']){
    $status = 1;
}
        //定位用户城市
        if ($_SESSION['weixin_get_fans_location_p_c_d_a']) {
            $user_privince = str_replace('省', '', $_SESSION['weixin_get_fans_location_p_c_d_a']['province']);
            $user_city = str_replace('市', '', $_SESSION['weixin_get_fans_location_p_c_d_a']['city']);
            $user_district = str_replace('区', '', $_SESSION['weixin_get_fans_location_p_c_d_a']['district']);
            
            //$city_where = "(province like '%{$user_privince}%'";
            $city_where = '';
            if ($user_privince) {
                $city_where .= " and ((province like '%{$user_privince}%' and province != '') or province = '')";
            }            
            if ($user_city) {
                $city_where .= " and ((city like '%{$user_city}%' and city != '') or city = '')";
            }
            if ($user_district) {
                $city_where .= " and ((district like '%{$user_district}%' and district != '') or district = '')";
            }  
            $sql = "select id from ".tablename("daojia_store")." where 1 $city_where and uniacid = '" . $_W['uniacid'] . "' {$where} order by id desc";
            //echo $sql;exit;
            $list = pdo_fetchall($sql);
            $staff_store_id_arr = array();
            $staff_store_id_arr[] = '-1';
            foreach ($list as $row) {
                $staff_store_id_arr[] = $row['id'];
            }
            $where .= " and staff_store_id in (".  implode(',', $staff_store_id_arr).") ";
        }
if ($store_id){
    //$where .= " and staff_store_id = {$store_id} ";
}       

$where .= " and online = 1 and user_type = 1 ";//只显示在线的美容师
$sql = "select * from ".tablename("daojia_user"). " where uniacid = '" . $_W['uniacid'] . "' {$where} order by id desc LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
$list = pdo_fetchall($sql);
$size = sizeof($list);

$sql = "select count(*) from ".tablename("daojia_user")." where uniacid = '{$_W['uniacid']}' {$where}  ";
$total = pdo_fetchcolumn($sql);

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
$staff_store_id =  $item['staff_store_id'];
$yuyue_after_minutes = get_store_name($staff_store_id, 'yuyue_after_minutes');
if (!$yuyue_after_minutes) {
    $yuyue_after_minutes = 120;
}
//$yuyue_after_minutes = time() + $yuyue_after_minutes * 60;
$yuyue_after_minutes = floor($yuyue_after_minutes/60);
$yuyue_after_minutes = $yuyue_after_minutes ? $yuyue_after_minutes : 1;

$begin_hour = get_store_name($staff_store_id, 'begin_hour');
$end_hour = get_store_name($staff_store_id, 'end_hour');   
if (!$end_hour) {
    $end_hour = 23;
}
				$html .= <<<EOD
<a href="javascript:void(0);" data-id="{$item['id']}" onclick="select_staff({$item['id']}, {$yuyue_after_minutes}, {$begin_hour}, {$end_hour})" >
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
		// print_r($return);exit;
		echo json_encode($return);exit;
	}



include $this->template('staff');

?>