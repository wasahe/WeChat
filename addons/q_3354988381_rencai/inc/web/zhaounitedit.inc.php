<?php
/**
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        load()->func('tpl');
        if (checksubmit('save_info')) {
            $id = intval($_GPC['companyid']);
            $_GPC['data']['coordinate'] = json_encode($_GPC['data']['coordinate']);

            if (!isset($_GPC['data']['cant_resume']) || $_GPC['data']['cant_resume'] == '') {
                $_GPC['data']['cant_resume'] = 1;
            }
            if ($id > 0) {    
                $tmp_row = $this->get_table_row('q_3354988381_rencai_company_money', $id, 'company_id');
                if ($tmp_row) {
                    $company_money_rom = $this->get_table_row('q_3354988381_rencai_company_money', $id, 'company_id');         
                    $curr_money = number_format($company_money_rom['money_youhui_get'], 2);                    
                    pdo_query('update '. tablename('q_3354988381_rencai_company_money') . " set money_youhui_get=".$_GPC['curr_money'].", money=money+".($_GPC['curr_money']-$curr_money) . " where company_id='$id'");
                } else {
                    pdo_insert('q_3354988381_rencai_company_money', array('company_id' => $id, 'money' => $_GPC['curr_money'], 'money_youhui_get' => $_GPC['curr_money']));
                }
                
                if (pdo_update($this->company_table, $_GPC['data'], array('id' => $id))) {    
                    $this->check_exist_member($_GPC['data'], 1);
                    message("保存成功", $this->createWebUrl('Zhaounit'), 'success');
                } else {
                    message("保存失败", $this->createWebUrl('Zhaounit'), 'error');
                }                
            } else {
                $_GPC['data']['weid'] = $this->weid;
                $_GPC['data']['dateline'] = time();
                pdo_insert($this->company_table, $_GPC['data']);
                $in_id = pdo_insertid();  
                $in_id_money = pdo_insert('q_3354988381_rencai_company_money', array('company_id' => $in_id, 'money' => $_GPC['curr_money'], 'money_youhui_get' => $_GPC['curr_money']));
                if ($in_id || $in_id_money) {
                    $this->check_exist_member($_GPC['data'], 1);
                    message('添加成功', $this->createWebUrl('Zhaounit'), 'success');
                } else {
                    message('操作失败或无改动', $this->createWebUrl('Zhaounit'), 'error');
                }                 
            }

        } else {
            $config = $this->get_config();
            $id = intval($_GPC['id']);
            $row = pdo_fetch("SELECT * FROM " . tablename($this->company_table) . " WHERE  id = :id AND weid = :weid LIMIT 1", array(":id" => $id, ":weid" => $this->weid));
            $coordinate = json_decode($row['coordinate'], 1);
            
            $company_money_rom = $this->get_table_row('q_3354988381_rencai_company_money', $id, 'company_id');         
            $curr_money = number_format($company_money_rom['money_youhui_get'], 2);

            //$company_logo = $_SERVER['DOCUMENT_ROOT'] . $this->_upload_prefix . "/attachment/q_3354988381_rencai/" . $row['logo'];
            $company_logo = $this->get_rencai_pic($row['logo']);
            $company_avatar = $this->get_rencai_pic($row['avatar']);
            $company_license = $this->get_rencai_pic($row['license']);
            if (!$row) {
                $row['province'] = $this->getConfigArr('cfg_dft_p');
                $row['city'] = $this->getConfigArr('cfg_dft_c');
                $row['district'] = $this->getConfigArr('cfg_dft_d');
            }

            //行业分类=取父类
            $parents = pdo_fetchall("SELECT * FROM " . tablename($this->industry_table) . " WHERE weid = :weid AND parent_id = 0 ORDER BY display ASC", array(":weid" => $this->weid));
            $tmp = array();
            foreach ($parents AS $parent) {
                array_push($tmp, $parent['id']);
            }
            $pids = implode(",", $tmp);
            unset($tmp);
            if (!empty($pids)) {
                //取子类
                $subs = pdo_fetchall("SELECT * FROM " . tablename($this->industry_table) . " WHERE weid = :weid AND parent_id IN ({$pids}) ORDER BY display ASC", array(":weid" => $this->weid));
                foreach ($parents AS $key => $parent) {
                    foreach ($subs AS $k => $sub) {
                        if ($sub['parent_id'] == $parent['id']) {
                            $parents[$key]['sub'][$k] = $sub;
                        }
                    }
                }
            }
            include $this->template('zhao_unit_edit');
        }








