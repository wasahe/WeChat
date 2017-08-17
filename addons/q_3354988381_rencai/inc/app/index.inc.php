<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
global $_GPC, $_W;
        $curr_url = 'index';
        $config = $this->get_config();
        
        $nowtime = time();
        //======幻灯AD======
        $ad_lists = pdo_fetchall("SELECT * FROM " . tablename($this->ads_table) . " WHERE weid = :weid AND isshow = 1 AND exprtime > :time ORDER BY display ASC ", array(":weid" => $this->weid, ":time" => $nowtime));
        $big_ad_lists = $small_ad_lists = array();
        foreach ($ad_lists AS $key => $ad) {
            if ($ad['position'] == 1) {
                array_unshift($big_ad_lists, $ad);//在数组开头插入一个或多个单元 
            } else {
                array_unshift($small_ad_lists, $ad);
            }
        }
        $big_ad_nums = count($big_ad_lists);

        //======置顶======
        $time = time();
        $offset = intval($this->module['config']['indextopnums']);
        $top_lists = pdo_fetchall("SELECT job.* "
                . "FROM " . tablename($this->job_table) . " job "
                . "LEFT JOIN " . tablename($this->company_table) . " comp ON job.mid=comp.id "
                . "WHERE job.weid = :weid AND job.istop = 1 AND job.expiration > {$time} and comp.status>=0 ORDER BY job.dateline DESC LIMIT 0, {$offset} ", array(":weid" => $this->weid));
        //置顶信息背后的企业信息
        $tmp = array();
        foreach ($top_lists AS $key => $val) {
            array_unshift($tmp, $val['mid']);//公司id
            $top_lists[$key]['welfare'] = explode(',', $val['welfare']);//福利
        }
        if (!empty($tmp)) {
            $top_companys = $this->get_companys_info($tmp);
        }
        unset($tmp);

        //======最新招聘=====
        $limit = intval($this->module['config']['indexlastnums']);
        $last_tmp_jobs = pdo_fetchall("SELECT job.* "
                . "FROM " . tablename($this->job_table) . " job "
                . "LEFT JOIN " . tablename($this->company_table) . " comp ON job.mid=comp.id "
                . "WHERE job.weid = :weid and comp.status>=0 ORDER BY job.dateline DESC limit 0, {$limit} ", array(":weid" => $this->weid));
        //最新招聘背后的企业
        $tmp = $last_jobs = array();
        foreach ($last_tmp_jobs AS $key => $val) {
            array_unshift($tmp, $val['mid']);
            $last_jobs[$key] = $val;
            $last_jobs[$key]['welfare'] = explode(',', $val['welfare']);
        }
        $tmp = array_unique($tmp);  //去重
        if (!empty($tmp)) {
            $last_companys = $this->get_companys_info($tmp);
        }
        unset($tmp);

        //========热门职位==========
        $limit = intval($this->module['config']['indexhotnums']);
        $hot_jobs = pdo_fetchall("SELECT job.* "
                . "FROM " . tablename($this->job_table) . " job "
                . "LEFT JOIN " . tablename($this->company_table) . " comp ON job.mid=comp.id "
                . "WHERE job.weid = :weid AND job.ishot = 1 and comp.status>=0 ORDER BY job.dateline DESC LIMIT 0, {$limit} ", array(":weid" => $this->weid));
        //热门信息背后的企业
        $tmp = array();
        foreach ($hot_jobs AS $key => $val) {
            array_unshift($tmp, $val['mid']);
            $hot_jobs[$key]['welfare'] = explode(',', $val['welfare']);
        }
        if (!empty($tmp)) {
            $hot_companys = $this->get_companys_info($tmp);
        }
        unset($tmp);
        
        
        //名企推荐
        $limit = intval($this->module['config']['indexcompanynums']);
        $companys_positions = pdo_fetchall("SELECT `id`, `name`, `logo` FROM " . tablename($this->company_table) . " WHERE weid = :weid AND position = 1 and status>=0 order by position_sort DESC, id DESC LIMIT 0, {$limit}", array(":weid" => $this->weid));
        //附件地址
        $atturl = $_W['attachurl'];
        //是否开启置顶
        $isopenindextop = $this->module['config']['isopenindextop'];
        //是否开启热门职位推荐
        $isopenindexhot = $this->module['config']['isopenindexhot'];
        //标题
        $title = !empty($this->module['config']['mobile_index_title']) ? $this->module['config']['mobile_index_title'] : '微人才微招聘';
        
        //自定义字段读取
        $sh_field_name = 'sys_position';
        $getFieldsSaveValArr = $this->getFieldsSaveValArr();
        $allFieldsArr = $this->getFieldsArr(); //['sys'][$sh_field_name] / ['person'][$sh_field_name]    
        
        $ad_speed = intval($this->module['config']['ad_speed']) * 1000;
        if ($ad_speed <= 0) {
            $ad_speed = 3000;
        }
                
        $theme_flag = $this->getPositionTypeFlag();
        if ($theme_flag == 'Z') {//职位主题
            $positiontype_list = array();
            $condition = " c.weid=" . $this->weid;
            $sql = "SELECT c.* "
                    . "FROM " . tablename('q_3354988381_rencai_positiontype') . " c "
                    . "WHERE $condition "
                    . "ORDER BY c.sort ASC, id DESC"; 
            $positiontype_list = pdo_fetchall($sql);           
            include $this->template('home_index_z');//职位类型形式模板
        } else {// D
            include $this->template('home_index');
        }

        
















