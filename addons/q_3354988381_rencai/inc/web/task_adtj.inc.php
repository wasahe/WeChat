<?php
/**
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        
        $pindex = max(1, intval($_GPC['page']));
        $psize = 15;
        
        $condition = " ad.weid=".$this->weid;
        if ($_GPC['ad_name']) {
            $condition .= " and ad.name like '%".$_GPC['ad_name']."%'";
        }        
        
        $sql = "SELECT ad.* "
                . "FROM " . tablename('wei_tb_task_adtj') . " ad "
                . "WHERE $condition ORDER BY ad.id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize; 
        $list = pdo_fetchall($sql);
        $total = pdo_fetchcolumn('SELECT COUNT(*) '
                . "FROM " . tablename('wei_tb_task_adtj') . " ad "
                . "WHERE $condition");
        
        $pager = pagination($total, $pindex, $psize);
        include $this->template('ad_tj');








