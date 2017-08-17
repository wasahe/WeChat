<?php
/**
 */
defined('IN_IA') or exit('Access Denied');
global $_GPC, $_W;

        if (checksubmit('save_industry')) {
            $data = $_GPC['data'];
            $data['weid'] = $this->weid;
            $data['dateline'] = time();

            if (isset($_GPC['cid']) && !empty($_GPC['cid'])) {
                $cid = intval($_GPC['cid']);
                if (pdo_update($this->industry_table, $data, array('id' => $cid))) {
                    message('操作成功', $this->createWebUrl('Industry'), 'success');
                } else {
                    message('操作失败', $this->createWebUrl('Industry'), 'error');
                }
            } else {
                if (pdo_insert($this->industry_table, $data)) {
                    message('操作成功', $this->createWebUrl('Industry'), 'success');
                } else {
                    message('操作失败', $this->createWebUrl('Industry'), 'error');
                }
            }
        } else {
            $op = isset($_GPC['op']) ? $_GPC['op'] : 'display';

            //取父类
            $parents = pdo_fetchall("SELECT * FROM " . tablename($this->industry_table) . " WHERE weid = :weid AND parent_id = 0 ORDER BY display ASC", array(":weid" => $this->weid));
            $tmp = array();
            foreach ($parents AS $parent) {
                array_push($tmp, $parent['id']);
            }
            $pids = implode(",", $tmp);
            unset($tmp);
            if (!empty($pids)) {
                //取子类
                $subs = pdo_fetchall("SELECT * FROM " . tablename($this->industry_table) . " WHERE weid = :weid AND parent_id IN ({$pids}) ORDER BY display ASC", array(":weid" => $this->weid));
                foreach ($parents AS $key => $parent) {
                    foreach ($subs AS $k => $sub) {
                        if ($sub['parent_id'] == $parent['id']) {
                            $parents[$key]['sub'][$k] = $sub;
                        }
                    }
                }
            }
            //行业分类
            $row = pdo_fetch("SELECT * FROM " . tablename($this->industry_table) . " WHERE id = :id AND weid = :weid", array(":id" => intval($_GPC['id']), ":weid" => $this->weid));

            include $this->template('industry');
        }








