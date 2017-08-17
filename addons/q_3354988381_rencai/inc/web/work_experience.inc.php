<?php
/**
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        $pindex = max(1, intval($_GPC['page']));
        $psize = 15;
        
        $condition = '';
        if ($_GPC['username']) {
            $condition .= " and stu.username like '%".$_GPC['username']."%'";
        }  
        if ($_GPC['company_name']) {
            $condition .= " and rsm.company_name like '%".$_GPC['company_name']."%'";
        }         
        
        $lists = pdo_fetchall("SELECT rsm.*, stu.username "
                . "FROM " . tablename($this->resume_table) . " rsm "
                . "LEFT JOIN " . tablename($this->person_table) . " stu ON rsm.person_id=stu.id " 
                . "WHERE 1 $condition and rsm.weid = :weid order by rsm.id desc LIMIT " . ($pindex - 1) * $psize . ',' . $psize, array(":weid" => $this->weid));

        $total = pdo_fetchcolumn('SELECT COUNT(*) '
                . "FROM " . tablename($this->resume_table) . " rsm "
                . "LEFT JOIN " . tablename($this->person_table) . " stu ON rsm.person_id=stu.id "            
                . "WHERE 1 $condition and rsm.weid = :weid ", array(":weid" => $this->weid));
        
        $pager = pagination($total, $pindex, $psize);
        
        include $this->template('work_experience');








