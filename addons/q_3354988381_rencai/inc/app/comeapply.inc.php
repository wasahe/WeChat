<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        $companyid = $_SESSION['curr_person_id'] ? $_SESSION['curr_person_id'] : $_GPC['companyid'];
        $applys = pdo_fetchall("SELECT * FROM " . tablename($this->apply_table) . " WHERE weid = :weid AND company_id = :companyid", array(":weid" => $this->weid, ":companyid" => $companyid));
        $tmp = $temp = array();
        foreach ($applys AS $key => $apply) {
            array_unshift($tmp, $apply['person_id']);
            array_unshift($temp, $apply['job_id']);
            $applys[$key]['dateline'] = date("Y-m-d", $apply['dateline']);
        }
        //====用户=========
        if (!empty($tmp)) {
            $persons_tmp = pdo_fetchall("SELECT `id`,`username` FROM " . tablename($this->person_table) . " WHERE id IN (" . implode(',', $tmp) . ")");
            $person = array();
            foreach ($persons_tmp AS $key => $val) {
                $person[$val['id']] = $val;
            }
        }
        //======职位===========
        if (!empty($temp)) {
            $jobs_tmp = pdo_fetchall("SELECT `id`,`title` FROM " . tablename($this->job_table) . " WHERE id IN (" . implode(',', $temp) . ")");
            $jobs = array();
            foreach ($jobs_tmp AS $key => $val) {
                $jobs[$val['id']] = $val;
            }
        }
        $title = '来应聘的';
        include $this->template('my_company_comeapply');

        
















