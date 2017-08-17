<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        $config = $this->get_config();
        $id = intval($_GPC['id']);
        if (checksubmit('savejobsubmit')) {
            $companyid = $_GPC['companyid'];
            $data = $_GPC['data'];
            $data['updatetime'] = date('Y-m-d H:i:s');
            if (pdo_update($this->job_table, $data, array('id' => $_GPC['jobid'], 'mid' => $_SESSION['curr_person_id']))) {
                message("更新成功", $this->createMobileUrl('MyPublicJob', array('companyid' => $companyid)), 'success');
            } else {
                message("更新失败", $this->createMobileUrl('MyPublicJob'), 'error');
            }
        } else {
            $info = pdo_fetch("SELECT * FROM " . tablename($this->job_table) . " WHERE id = :id and mid='".$_SESSION['curr_person_id']."' LIMIT 1", array(':id' => $id));
            $welfare_array = explode(',', $info['welfare']);
            //================================取所有职位分类====================
            $parent_cate = pdo_fetchall("SELECT * FROM " . tablename($this->category_table) . " WHERE weid = :weid AND parent_id = 0 AND isshow = 1 ORDER BY display ASC", array(":weid" => $this->weid));
            $tmp = array();
            foreach ($parent_cate AS $parent) {
                array_push($tmp, $parent['id']);
            }
            $tmp = implode(",", $tmp);
            if ($tmp == '') {
                    $tmp = '-1';
            }
            $sub_cate = pdo_fetchall("SELECT * FROM " . tablename($this->category_table) . " WHERE weid = :weid AND parent_id IN (" . $tmp . ") AND isshow = 1 ORDER BY display ASC", array(":weid" => $this->weid));
            foreach ($parent_cate AS $key => $parent) {
                foreach ($sub_cate AS $k => $sub) {
                    if ($sub['parent_id'] == $parent['id']) {
                        $parent_cate[$key]['sub'][$k] = $sub;
                    }
                }
            }
            $title = '编辑职位';
            include $this->template('edit_company_job');
        }

        
















