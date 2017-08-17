<?php
/**
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        
        $pindex = max(1, intval($_GPC['page']));
        $psize = 15;
        
        $condition = " dtl.weid=".$this->weid;
        if ($_GPC['ad_name']) {
            $condition .= " and ad.name like '%".$_GPC['ad_name']."%'";
        }        
        
        $sql = "SELECT dtl.*, ad.name as ad_name "
                . "FROM " . tablename($this->ads_tj_table) . " dtl "
                . "LEFT JOIN " . tablename($this->ads_table ) . " ad ON dtl.ad_id=ad.id "
                . "WHERE $condition ORDER BY dtl.id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize; 
        $list = pdo_fetchall($sql);
        $total = pdo_fetchcolumn('SELECT COUNT(*) '
                . "FROM " . tablename($this->ads_tj_table) . " dtl "
                . "LEFT JOIN " . tablename($this->ads_table ) . " ad ON dtl.ad_id=ad.id "
                . "WHERE $condition");
        
        $pager = pagination($total, $pindex, $psize);
        include $this->template('ad_tj');








