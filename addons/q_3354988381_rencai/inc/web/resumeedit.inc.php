<?php
/**
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        $config = $this->get_config();
        $resumeid = intval($_GPC['resumeid']);
        if (checksubmit('save_info')) {
            if (0 && $_FILES['headimgurl']['tmp_name']) {
                $upfile = $_FILES['headimgurl'];
                $name = $upfile['name'];
                $type = $upfile['type'];  
                $tmp_name = $upfile['tmp_name'];
                //$upload_path = $_SERVER['DOCUMENT_ROOT'] . $this->_upload_prefix . "/attachment/q_3354988381_rencai/avatar/";
                $upload_path = $this->_attach_dir . 'avatar/';
                
                //允许上传的图片类型
                $uptypes = array('image/jpg', 'image/png', 'image/jpeg');
                //判断文件的类型
                if (!in_array($type, $uptypes)) {
                    message('上传文件类型不符', $this->createWebUrl('Resume'), 'error');
                }
                //存放目录
                if (!file_exists($upload_path)) {
                    mkdir($upload_path);
                }
                //移动文件
                $head_pic = date("YmdHi") . '_' . $name;
                if (!move_uploaded_file($tmp_name, $upload_path .$head_pic)) {
                    message('移动文件失败，请检查服务器权限', $this->createWebUrl('Resume'), 'error');
                }   
                $_GPC['data']['headimgurl'] = $head_pic;
            }
            
            if ($resumeid == 0) {
                $_GPC['data']['weid'] = $this->weid;
                $_GPC['data']['dateline'] = time();
                $_GPC['data']['updatetime'] = time();
                if (pdo_insert($this->person_table, $_GPC['data'])) {
                    $this->check_exist_member($_GPC['data'], 2);
                    message('添加成功', $this->createWebUrl('Resume'), 'success');
                } else {
                    message('操作失败或无改动', $this->createWebUrl('Resume'), 'error');
                }                
            } else {
                if (pdo_update($this->person_table, $_GPC['data'], array('id' => $resumeid))) {
                    $this->check_exist_member($_GPC['data'], 2);
                    message('保存成功', $this->createWebUrl('Resume'), 'success');
                } else {
                    message('操作失败或无改动', $this->createWebUrl('Resume'), 'error');
                }                
            }
        } else {
            $row = pdo_fetch("SELECT * FROM " . tablename($this->person_table) . " WHERE id = :id LIMIT 1", array(":id" => $resumeid));
            //$headimgurl = $_SERVER['DOCUMENT_ROOT'] . $this->_upload_prefix . "/attachment/q_3354988381_rencai/avatar/" . $row['headimgurl'];
            if (!$row) {
                $row['province'] = $this->getConfigArr('cfg_dft_p');
                $row['city'] = $this->getConfigArr('cfg_dft_c');
                $row['district'] = $this->getConfigArr('cfg_dft_d');
            
            if (!$row['headimgurl']) {
                $row['headimgurl'] = $this->get_user_header_pic($person['from_user'], $person['sex']);
            }
}         
            $offices = $this->get_all_office();
            $fields_list = $this->getFieldsSaveValArr('person_', 1, 1);
           // print_r($fields_list);exit;
            load()->func('tpl');
            include $this->template('resume_edit');
        }








