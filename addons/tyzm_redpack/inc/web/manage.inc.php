<?php


defined('IN_IA') or exit('Access Denied');

load()->func('file');
load()->func('tpl');
global $_W, $_GPC;
$uniacid = intval($_W['uniacid']);

defined('IN_IA') or exit('Access Denied');
global $_GPC, $_W;
$tys     = array(
    'display',
    'ajaxonlyshare'
);
$ty      = trim($_GPC['ty']);
$ty      = in_array($ty, $tys) ? $ty : 'display';
$uniacid = intval($_W['uniacid']);
$this->authorization();

if ($ty == 'ajaxonlyshare') {
    if ($_W['ispost']) {
        if (pdo_update('tyzm_redpack_lists', array(
            'onlyshare' => $_GPC['onlyshare']
        ), array(
            'id' => $_GPC['id']
        ))) {
            $out['status'] = 200;
            exit(json_encode($out));
        }
    }
}
if ($ty == 'display') {
    //分页start
    
    $pindex = max(1, intval($_GPC['page']));
    
    $psize = 20;
    
    $condition = '';
    
    if (!empty($_GPC['keyword'])) {
        $condition .= " AND CONCAT(`act_name`,`send_name`) LIKE '%".$_GPC['keyword']."%'";
    }
    
    $list = pdo_fetchall("SELECT * FROM " . tablename('tyzm_redpack_lists') . " WHERE uniacid = " . $uniacid . " $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('tyzm_redpack_lists') . " WHERE uniacid = " . $uniacid . " $condition");
    
    $pager = pagination($total, $pindex, $psize);
    
    //分页end
    
    if (!empty($list)) {

        foreach ($list as $key => $value) {

            if ($value['status'] == 1) {

                if ($value['starttime'] > time()) {

                    $list[$key]['status'] = 2;

                } elseif ($value['endtime'] < time()) {

                    $list[$key]['status'] = 3;
                }
            }
        }
    }
    
    include $this->template('manage');
    
}






