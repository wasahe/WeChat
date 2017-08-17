<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        $person_id = $_SESSION['curr_person_id'] ? $_SESSION['curr_person_id'] : intval($_GPC['person_id']);

        //所有收藏
        $collects = pdo_fetchall("SELECT * FROM " . tablename($this->collect_table) . " WHERE weid = :weid AND person_id = :person_id ", array(":weid" => $this->weid, ":person_id" => $person_id));
        $jobs_id_tmp = $companys_id_tmp = $jobs = $companys = array();
        foreach ($collects AS $key => $collect) {
            array_unshift($companys_id_tmp, $collect['company_id']); //取公司id
            array_unshift($jobs_id_tmp, $collect['job_id']); //取职位id
            $collects[$key]['dateline'] = date("Y/m/d", $collect['dateline']);
        }
        $collect_nums = count($collects); //收藏数
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
        $title = '我收藏的职位';
        include $this->template('my_collect');

        
















