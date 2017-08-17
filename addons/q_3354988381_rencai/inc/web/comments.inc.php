<?php
/**
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        $pindex = max(1, intval($_GPC['page']));
        $psize = 15;
        
        $condition = '';
        if ($_GPC['job_name']) {
            $condition .= " and job.title like '%".$_GPC['job_name']."%'";
        }  
        $sql = "SELECT cmt.*, job.title as job_name,company.name as company_name, fans.nickname, mem.avatar "
                . "FROM " . tablename($this->jobs_comments_table) . " cmt "
                . "LEFT JOIN " . tablename($this->job_table) . " job ON cmt.jobid=job.id " 
                . "LEFT JOIN " . tablename('mc_mapping_fans') . " fans ON cmt.from_user=openid "
                . "LEFT JOIN " . tablename('mc_members') . " mem ON fans.uid=mem.uid "                
                . "LEFT JOIN " . tablename($this->company_table) . " company ON job.mid=company.id " 
                . "WHERE 1 $condition and cmt.weid = :weid and fans.uniacid=:weid order by cmt.id desc LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
        $lists = pdo_fetchall($sql, array(":weid" => $this->weid));

        $total = pdo_fetchcolumn('SELECT COUNT(*) '
                . "FROM " . tablename($this->jobs_comments_table) . " cmt "
                . "LEFT JOIN " . tablename($this->job_table) . " job ON cmt.jobid=job.id " 
                . "LEFT JOIN " . tablename('mc_mapping_fans') . " fans ON cmt.from_user=openid "
                . "LEFT JOIN " . tablename('mc_members') . " mem ON fans.uid=mem.uid "                
                . "WHERE 1 $condition and cmt.weid = :weid and fans.uniacid=:weid", array(":weid" => $this->weid));
        
        $pager = pagination($total, $pindex, $psize);
        include $this->template('comments');








