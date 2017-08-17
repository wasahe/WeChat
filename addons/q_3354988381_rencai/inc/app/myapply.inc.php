<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        $person_id = $_SESSION['curr_person_id'] ? $_SESSION['curr_person_id'] : intval($_GPC['person_id']);

        //所有收藏
        $applys = pdo_fetchall("SELECT * FROM " . tablename($this->apply_table) . " WHERE weid = :weid AND person_id = :person_id ", array(":weid" => $this->weid, ":person_id" => $person_id));
        $jobs_id_tmp = $companys_id_tmp = $jobs = $companys = array();
        foreach ($applys AS $key => $apply) {
            array_unshift($companys_id_tmp, $apply['company_id']); //去公司id
            array_unshift($jobs_id_tmp, $apply['job_id']); //取职位id
            $applys[$key]['dateline'] = date("Y/m/d", $apply['dateline']);
        }
        $applys_nums = count($applys); //收藏数
        //职位名称
        if (!empty($jobs_id_tmp)) {
            $jobs_tmp = pdo_fetchall("SELECT id,title FROM " . tablename($this->job_table) . " WHERE id IN (" . implode(',', $jobs_id_tmp) . ")");
            $jobs == array();
            foreach ($jobs_tmp AS $key => $val) {
                $jobs[$val['id']] = $val;
            }
        }
        //公司名称
        if (!empty($companys_id_tmp)) {
            $companys_tmp = pdo_fetchall("SELECT id,name,isauth FROM " . tablename($this->company_table) . " WHERE id IN (" . implode(',', $companys_id_tmp) . ")");
            foreach ($companys_tmp AS $key => $val) {
                $companys[$val['id']] = $val;
            }
        }
        $title = '我申请的职位';
        include $this->template('my_apply');

        
















