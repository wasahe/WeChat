<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;

        $member = pdo_fetch("SELECT * FROM " . tablename($this->member_table) . " WHERE weid = :weid AND from_user = :from_user LIMIT 1", array(":weid" => $this->weid, ":from_user" => $this->from_user));
        if (empty($member)) {
            exit('-2'); //先检查有没有这个人
        }
        if ($member['type'] == 1) {
            exit('-3'); //企业用户，不准收藏
        }

        //用户id 
        $person_id = $_SESSION['curr_person_id'] ? $_SESSION['curr_person_id'] : pdo_fetchcolumn("SELECT * FROM " . tablename($this->person_table) . " WHERE weid = :weid AND from_user = :from_user LIMIT 1", array(":weid" => $this->weid, ":from_user" => $this->from_user), 0);

        //是否收藏
        $collect = pdo_fetch("SELECT * FROM " . tablename($this->collect_table) . " WHERE weid = :weid AND person_id = :person_id AND job_id = :job_id LIMIT 1", array(":weid" => $this->weid, ":person_id" => $person_id, ":job_id" => intval($_GPC['job_id'])));
        if ($collect) {
            exit('-1');
        }

        $data = array(
            'weid' => $this->weid,
            'person_id' => $person_id,
            'company_id' => intval($_GPC['company_id']),
            'job_id' => intval($_GPC['job_id']),
            'dateline' => time()
        );
        if (pdo_insert($this->collect_table, $data)) {
            exit('1');
        } else {
            exit('0');
        }

        
















