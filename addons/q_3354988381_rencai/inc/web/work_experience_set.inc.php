<?php
/**
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        $id = intval($_GPC['id']);
        
        if ($_GPC['op'] == 'delete') {
            $id = intval($_GPC['id']);
            $row = pdo_fetch("SELECT id FROM " . tablename($this->resume_table) . " WHERE id = :id and weid='".$this->weid."'", array(':id' => $id));
            if (empty($row)) {
                message('抱歉，信息不存在或是已经被删除！');
            }
            pdo_delete($this->resume_table, array('id' => $id));
            message('删除成功！', referer(), 'success');
        }
        
        if (checksubmit('save_info')) {
            $id = intval($_GPC['id']);
            $post_data = $_GPC['data'];
            $data = array(
                'weid' => $this->weid,
                'person_id' => $post_data['person_id'],
                'company_name' => $post_data['company_name'],
                'start_time' => $_GPC['datelimit']['start'],
                'end_time' => $_GPC['datelimit']['end'],
                'wage' => $post_data['wage'],
                'work_description' => $post_data['work_description'],
                'dateline' => time()
            );

            //必须项判断
            $no_empty_arr = array(
                'person_id' => '姓名',
                'company_name' => '公司名称',
            );
            foreach ($no_empty_arr as $field => $item_name) {
                if (empty($data[$field])) {
                    message('请填写' . $item_name . '！', '', 'error');
                }
            }

            if (!empty($id)) {
                pdo_update($this->resume_table, $data, array('id' => $id));
            } else {
                pdo_insert($this->resume_table, $data);
            }
            
            $curr_index_url = $this->createWebUrl('work_experience');
            message('更新成功！', $curr_index_url, 'success');           
        } else {
            load()->func('tpl');
            $row = pdo_fetch("SELECT * FROM " . tablename($this->resume_table) . " WHERE id = :id LIMIT 1", array(":id" => $id));   
            $persons = pdo_fetchall("SELECT id,username FROM " . tablename($this->person_table) . " WHERE weid='".$this->weid."'");
           
            include $this->template('work_experience_set');
        }








