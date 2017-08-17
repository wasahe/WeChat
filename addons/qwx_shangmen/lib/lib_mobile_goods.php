<?php 

	global $_GPC, $_W;
	load()->func('tpl');

	$member = get_member_info();
	$uid = $member['uid'];
	$is_vip = is_vip($member['groupid'],$this->module['config']);//判断是否为vip用户；
	

	//根据ID读取数据：
	$id = (int)$_GPC['id'];
	$sql = "select * from ".tablename("daojia_goods")." where uniacid = '{$_W['uniacid']}' and id = '{$id}' and status = 1 limit 1 ";
	$goods = pdo_fetch($sql);
	if (!$goods){
            message('找不到该项目的资料！',getHomeUrl(),'error');
	}

        $_share = array();
        if ($this->getConfigArr('share_get_product_info') == 'Y') {
            $_share = array(
                'title' => $goods['title'].' ￥'.$goods['price'],
                'content' => $goods['titledesc'] ? $goods['titledesc'] : $goods['title'].' ￥'.$goods['price'],
                'imgUrl' => $_W['attachurl'] . $goods['photo'],
            );           
        } else {
            $_share = get_share_info($this->module['config']);
        }
                
	//读取该项目的销量：
	$order_status = -1;//最少的计算订单数量的状态；
	$sql = "select count(o.id) "
                . "from ".tablename('daojia_order_item'). " as oi ".
                " left join ".tablename('daojia_order') . " as o on oi.goods_id = o.id ".
                " where oi.uniacid = '{$_W['uniacid']}' and oi.goods_id = '{$goods['id']}' and o.status >{$order_status} ";
	$order_count = pdo_fetchcolumn($sql);
	$order_count = $goods['default_sale']+$order_count;

	include $this->template('goods');

?>