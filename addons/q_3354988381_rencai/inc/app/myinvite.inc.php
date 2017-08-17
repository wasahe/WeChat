<?php
/**
 * 邀请记录
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
$type = $_SESSION['curr_user_type'];

$title = '邀请记录';
$pindex = max(1, intval($_GPC['page']));
$psize = 15;   
$weid = $this->weid;

if ($type == 'C') {   
    $companyid = $_GPC['companyid'];
    if (!$companyid) {
        $company_data = $this->get_table_row('q_3354988381_rencai_company', $this->from_user, 'from_user');
        $companyid = $company_data['id'];
    }
        
    $condition = "and weid= '$weid' and invite_id='$companyid'";
    $sql = "SELECT * FROM " . tablename('q_3354988381_rencai_company') . " WHERE 1 $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize; 
    $list = pdo_fetchall($sql);

    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('q_3354988381_rencai_company') . " WHERE 1 $condition");    
} else if ($type == 'P') {
    $person_id = $_GPC['person_id'];
    if (!$person_id) {
        $person_data = $this->get_table_row('q_3354988381_rencai_person', $this->from_user, 'from_user');
        $person_id = $person_data['id'];
    }
        
    $condition = "and weid= '$weid' and invite_id='$person_id'";
    $sql = "SELECT * FROM " . tablename('q_3354988381_rencai_person') . " WHERE 1 $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize; 
    $list = pdo_fetchall($sql);

    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('q_3354988381_rencai_person') . " WHERE 1 $condition");        
}


$pager = pagination($total, $pindex, $psize);
$pageend = ceil($total / $psize);
if ($total / $psize != 0 && $total >= $psize) {
    $pageend++;
}
//page todo

include $this->template('myinvite');    
        

        
















