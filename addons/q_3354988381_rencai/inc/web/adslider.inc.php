<?php
/**
 */
defined('IN_IA') or exit('Access Denied');
global $_GPC, $_W;
        $op = empty($_GPC['op']) ? 'display' : $_GPC['op'];
        if (checksubmit('submit')) {
            $insert_data = array(
                'weid' => $this->weid,
                'dateline' => time(),
            );
            $time = $_GPC['data']['exprtime'];
            $_GPC['data']['exprtime'] = strtotime($time);

            $insert_data = array_merge($insert_data, $_GPC['data']);
            if (empty($_GPC['id'])) {
                if (false !== pdo_insert($this->ads_table, $insert_data)) {
                    message("添加成功", $this->createWebUrl('ADSlider'), 'success');
                } else {
                    message("操作失败", referer(), 'error');
                }
            } else {
                if (false !== pdo_update($this->ads_table, $insert_data, array('id' => intval($_GPC['id'])))) {
                    message("更新成功", $this->createWebUrl('ADSlider'), 'success');
                } else {
                    message("更新失败", referer(), 'error');
                }
            }
        } else {
            if ($op == 'display') {
                $lists = pdo_fetchall("SELECT * FROM " . tablename($this->ads_table) . " WHERE weid = :weid", array(":weid" => $this->weid));
            } else {
                $row = pdo_fetch("SELECT * FROM " . tablename($this->ads_table) . " WHERE id = :id LIMIT 1", array(":id" => intval($_GPC['id'])));
            }
            load()->func('tpl');
            include $this->template('adslider');
        }








