<?php 
global $_GPC, $_W;
load()->func('tpl');

//检查用户是否登录：
checkauth();
$member = get_member_info();
$uid = $member['uid'];

$status = $_GPC['status'];
//读取订单列表的数据：
//读取项目的数据：
$pindex = max(1, intval($_GPC['page']));
$psize = 10;//@test;
$where = '';

//预留筛选器：
if (!$_GPC['status']){
    $status = 1;
}
if ($status == 1) {
    $where .= " and status <= '{$status}' ";
} else {
    $where .= " and status = '{$status}' ";
}

$sql = "select * from ".tablename("daojia_order")." where uniacid = '{$_W['uniacid']}' and uid='{$uid}' {$where} order by id desc LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
$list = pdo_fetchall($sql);
$size = sizeof($list);

$sql = "select count(*) from ".tablename("daojia_order")." where uniacid = '{$_W['uniacid']}' and uid='{$uid}' {$where}  ";
$total = pdo_fetchcolumn($sql);

	$is_ajax = $_GPC['is_ajax'];
	if ($is_ajax){
		$return = array();
		$html = '';
		//组合html：
		if (is_array($list)){
			foreach ($list as $key=>$item){
                                $order_status_ch = get_order_status($item['status']);
				$url = $this->createMobileUrl('myorderdetail',array('id'=>$item['id']));
				$create_time = date("Y-m-d",strtotime($item['create_time']));
				$title = 
				$html .= <<<EOD
<div class="adrwrap">
    <div class="adritem">
        <a class="adrdetail" href="{$url}">
            <p><i>订单：{$item['order_sn']}</i><span>{$create_time}</span></p>
            <p style="margin-top: 0.2em;">
                <span>
                总价：{$item['buy_price']}&nbsp;</span>
                <span>
                 订单状态：{$order_status_ch}
                </span>
            </p>
        </a>
       
    </div>
</div>
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



include $this->template('myorder');
?>