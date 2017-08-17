<?php
/**
 * 邀请记录
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;

$title = '我购买的简历';
$pindex = max(1, intval($_GPC['page']));
$psize = 15;   
$weid = $this->weid;

 
    $companyid = $_GPC['companyid'];
    if (!$companyid) {
        $company_data = $this->get_table_row('q_3354988381_rencai_company', $this->from_user, 'from_user');
        $companyid = $company_data['id'];
    }
        
    $condition = "and lst.weid= '$weid' and lst.company_id='$companyid'";
    $sql = "SELECT lst.*, p.username, p.id as p_id "
            . "FROM " . tablename('q_3354988381_rencai_company_lookresume') . " lst "
            . "LEFT JOIN " . tablename('q_3354988381_rencai_person') . " p ON lst.person_id=p.id "
            . "WHERE 1 $condition ORDER BY lst.id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize; 
    $list = pdo_fetchall($sql);

    $total = pdo_fetchcolumn('SELECT COUNT(*) '
            . 'FROM ' . tablename('q_3354988381_rencai_company_lookresume') . " lst "
            . "LEFT JOIN " . tablename('q_3354988381_rencai_person') . " p ON lst.person_id=p.id "
            . "WHERE 1 $condition");    



$pager = pagination($total, $pindex, $psize);
$pageend = ceil($total / $psize);
if ($total / $psize != 0 && $total >= $psize) {
    $pageend++;
}
//page todo

include $this->template('viewsumelist');    
        

        
















