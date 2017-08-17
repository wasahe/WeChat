<?php
/**
 */
defined('IN_IA') or exit('Access Denied');
        global $_W, $_GPC;
        $config = $this->get_config();
        
        $pindex = max(1, intval($_GPC['page']));
        $psize = 15;
        
        $condition = " weid=".$this->weid;

        if ($_GPC['title']) {
            $condition .= " and title like '%".$_GPC['title']."%'";
        }
        
	$starttime = empty($_GPC['end_time']['start']) ? strtotime('-30 days') : strtotime($_GPC['end_time']['start']);
	$endtime = empty($_GPC['end_time']['end']) ? TIMESTAMP + 86399 : strtotime($_GPC['end_time']['end']) + 86399;        
        $condition .= " and end_time >= '".date('Y-m-d', $starttime)."' and end_time<='".date('Y-m-d', $endtime)."'";
      
        if ($_GPC['deleterec']) {
            pdo_query("delete from " . tablename($this->job_table) . " WHERE {$condition}");            
        }
        
        //所有职位
        $sql = "SELECT * FROM " . tablename($this->job_table) . " WHERE {$condition}"
            . " ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize; 
        $lists = pdo_fetchall($sql);
        
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->job_table) . " WHERE $condition");
        $pager = pagination($total, $pindex, $psize);        
        
        //所有职位分类
        $categorys = pdo_fetchall("SELECT * FROM " . tablename($this->category_table) . " WHERE weid = :weid AND isshow = 1", array(":weid" => $this->weid));
        $tmp = array();
        foreach ($categorys AS $key => $cate) {
            $tmp[$cate['id']] = $cate;
        }
        foreach ($lists AS $key => $val) {
            $lists[$key]['cname'] = $tmp[$val['cid']]['name'];
        }

        include $this->template('zhao_info');








