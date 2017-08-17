<?php
/**
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        $config = $this->get_config();
        $jobid = intval($_GPC['jobid']);
        if (checksubmit('save_info')) {
            //$data = $_GPC['data'];
            $_GPC['data']['welfare'] = implode(',', $_GPC['welfare']);
            if ($jobid > 0) {              
                if (pdo_update($this->job_table, $_GPC['data'], array('id' => $jobid))) {
                    message('保存成功', $this->createWebUrl('Zhaoinfo'), 'success');
                } else {
                    message('操作失败或无改动', $this->createWebUrl('Zhaoinfo'), 'error');
                }               
            } else {
                $_GPC['data']['weid'] = $this->weid;
                $_GPC['data']['dateline'] = time();
                if (pdo_insert($this->job_table, $_GPC['data'])) {
                    message('添加成功', $this->createWebUrl('Zhaoinfo'), 'success');
                } else {
                    message('操作失败或无改动', $this->createWebUrl('Zhaoinfo'), 'error');
                }                 
            }            
        } else {
            $row = pdo_fetch("SELECT * FROM " . tablename($this->job_table) . " WHERE id = :id LIMIT 1", array(":id" => $jobid));
            if (!$jobid) {
                $row['end_time'] = date('Y-m-d', strtotime('+30 day'));
            }
            $welfare_array = explode(',', $row['welfare']);
            $offices = $this->get_all_office();
            load()->func('tpl');
            
            //企业列表
            $company_arr = pdo_fetchall("SELECT id, name FROM " . tablename($this->company_table) . " WHERE weid = :weid", array(":weid" => $this->weid)); 
            
            include $this->template('zhao_info_edit');
        }








