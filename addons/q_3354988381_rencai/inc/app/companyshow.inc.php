<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
        global $_W, $_GPC;
        $config = $this->get_config();
        $companyid = intval($_GPC['companyid']);
        $company = pdo_fetch("SELECT * FROM " . tablename($this->company_table) . " WHERE id = :id LIMIT 1", array(":id" => $companyid));
        //取公司所属行业
        $industry = pdo_fetch("SELECT name FROM " . tablename($this->industry_table) . " WHERE id = :id AND weid = :weid LIMIT 1", array(":id" => $company['industry'], ":weid" => $this->weid));
        $company['description'] = htmlspecialchars_decode($company['description']);
        //改公司其他职位
        $other_jobs = pdo_fetchall("SELECT * FROM " . tablename($this->job_table) . " WHERE weid = :weid AND mid = :mid", array(":weid" => $this->weid, ":mid" => intval($company['id'])));

        $title = '公司概况';
        include $this->template('company_show');

        
















