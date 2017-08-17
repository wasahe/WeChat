<?php
/**
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        $config = $this->get_config();

        $condition = " weid=".$this->weid;
        if ($_GPC['name']) {
            $condition .= " and name like '%".$_GPC['name']."%'";
        }  
        if ($_GPC['deleterec']) {
            pdo_query("delete from " . tablename($this->company_table) . " WHERE {$condition}");            
        }
        
        $lists = pdo_fetchall("SELECT * FROM " . tablename($this->company_table) . " WHERE $condition order by sort asc, id desc");
        foreach ($lists AS $key => $val) {
            $lists[$key]['type'] = $config['companytype'][$val['type']];
            $company_money_rom = $this->get_table_row('q_3354988381_rencai_company_money', $val['id'], 'company_id');
            $lists[$key]['money_youhui_get'] = $company_money_rom['money_youhui_get']+0;
            $lists[$key]['curr_money'] = $company_money_rom['money'];
        }

        //所有行业分类
        $categorys = pdo_fetchall("SELECT * FROM " . tablename($this->industry_table) . " WHERE $condition ");
        $tmp = array();
        foreach ($categorys AS $key => $cate) {
            $tmp[$cate['id']] = $cate;
        }
        foreach ($lists AS $key => $val) {
            $lists[$key]['cname'] = $tmp[$val['industry']]['name'];
        }
        include $this->template('zhao_unit');








