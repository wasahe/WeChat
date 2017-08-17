<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
        global $_W, $_GPC;
        $this->chkUserAuth();
        if ($this->module['config']['task_top_logo_link']) {
            $data = array(//ad_id
                'weid' => $this->_weid,
                'user_from' => $this->_from_user,
                'link_url' => $this->module['config']['task_top_logo_link'],
                'createtime' => date('Y-m-d H:i:s')
            ); 
            pdo_insert('wei_tb_task_adtj', $data);            
            header('location:' . $this->module['config']['task_top_logo_link']);
            exit;
        }

        
















