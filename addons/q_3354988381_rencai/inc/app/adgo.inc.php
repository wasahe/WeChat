<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
        global $_GPC, $_W;
        $ad_id = $_GPC['aid'];
        $ad_data = pdo_fetch("SELECT `link` FROM " . tablename($this->ads_table) . " WHERE weid = :weid AND id = :id ", array(":weid" => $this->weid, ":id" => $ad_id));

        if ($this->from_user) {
            $data = array(
                'weid' => $this->weid,
                'ad_id' => $ad_id,
                'link_url' => $ad_data['link'],
                'user_from' => $this->from_user,
                'createtime' => date('Y-m-d H:i:s')
            );  
            pdo_insert($this->ads_tj_table, $data);                
        }        
        header('location:' . $ad_data['link']);

        
















