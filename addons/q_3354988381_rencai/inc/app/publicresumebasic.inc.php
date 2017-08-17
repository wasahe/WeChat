<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;        
        //二次登录处理
        $reg_flag = pdo_fetch("SELECT id, `type`,`status` FROM " . tablename($this->member_table) . " WHERE weid = :weid AND from_user = :from_user and type=2 LIMIT 1", array(":weid" => $this->weid, ":from_user" => $this->from_user));
        if ($reg_flag && $reg_flag['status'] == 0) {
            pdo_update($this->member_table, array('status' => 1), array('id' => $reg_flag['id']));
            $this->set_public_url();
            header('location:'. $this->createMobileUrl('My'));
        }      
        
        //=========是否关注================================
        $oauth_openid = "Q_3354988381_Rencai_" . $_W['uniacid'];
        if (empty($_COOKIE[$oauth_openid])) {
            $this->doMobileGetCode('PublicResumeBasic');
        }
        $this->getFollow();
        //================================================
        $config = $this->get_config();
        $time = time();
        if ($_GPC['type'] != 2) {
            $person_id = $_GPC['person_id'];
        } else {
            $person_id = 0;
        }
        
        if (checksubmit('save_basic_submit')) {

            //新录入
            if (empty($person_id)) {
                //写member表
                $member_data = array(
                    'weid' => $this->weid,
                    'from_user' => $this->from_user,
                    'type' => 2
                );
                pdo_insert($this->member_table, $member_data);
                $person_id = pdo_insertid();

                //写person表
                $person_data = array(
                    'weid' => $this->weid,
                    'from_user' => $this->from_user,
                    'invite_id' => $this->get_share_whoid('p'),
                    'dateline' => $time,
                    'updatetime' => $time,
                );
                $person_data = array_merge($person_data, $_GPC['data']);


                //=====================上传头像处理start==============
                if (!empty($_FILES['uploadfile']['name'])) {
                    $upfile = $_FILES['uploadfile'];
                    $name = $upfile['name'];
                    $type = $upfile['type'];
                    $size = $upfile['size'];
                    $tmp_name = $upfile['tmp_name'];
                    $error = $upfile['error'];
                    //上传路径
                    //$upload_path = $_SERVER['DOCUMENT_ROOT'] . $this->_upload_prefix . "/attachment/q_3354988381_rencai/avatar/";
                    $upload_path = $this->_attach_dir . 'avatar/';
                    
                    if (intval($error) > 0) {
                        message('上传错误：错误代码：' . $error, referer(), 'error');
                    } else {

                        //上传文件大小0为不限制，默认2M
                        $maxfilesize = empty($this->module['config']['headimgurlsize']) ? 2 : intval($this->module['config']['headimgurlsize']);
                        if ($maxfilesize > 0) {
                            if ($size > $maxfilesize * 1024 * 1024) {
                                message('上传文件不得超过 '.$maxfilesize.' M' . $_FILES["uploadfile"]["error"], referer(), 'error');
                            }
                        }

                        //允许上传的图片类型
                        $uptypes = array('image/jpg', 'image/png', 'image/jpeg');
                        //判断文件的类型
                        if (!in_array($type, $uptypes)) {
                            message('上传文件类型不符：' . $type, referer(), 'error');
                        }
                        //存放目录
                        if (!file_exists($upload_path)) {
                            mkdir($upload_path);
                        }
                        //取文件后缀
                        //$suffix = strrev( substr(strrev($name), 0, strpos(strrev($name), '.')));
                        //移动文件
                        $source_filename = $person_id . '_' . date("Ymd") . '.jpg';
                        $target_filename = $person_id . '_' . date("Ymd") . '.thumb.jpg';

                        if (!move_uploaded_file($tmp_name, $upload_path . $source_filename)) {
                            message('移动文件失败-'.$upload_path, referer(), 'error');
                        }
                        //营业执照进行缩略
                        $srcfile = $upload_path . $source_filename;
                        $desfile = $upload_path . $target_filename;
                        //文件操作类
                        load()->func('file');
                        $ret = file_image_thumb($srcfile, $desfile, 320);
                        //$ret = file_image_crop($srcfile, $desfile, 400, 400 ,5);//裁剪
                        if (!is_array($ret)) {
                            //路径存入数据库
                            $person_data['headimgurl'] = 'images/q_3354988381_rencai/avatar/' . $target_filename;
                        }
                        //删除原图
                        unlink($srcfile);
                    }
                }
                //=====================上传头像end==============    			

                if (pdo_insert($this->person_table, $person_data)) {
                    $_SESSION['curr_person_id'] = pdo_insertid(); 
                    $obj_url = $this->createMobileUrl('PublicResumeWorkExperience', array('person_id' => $_SESSION['curr_person_id']));
                    message('添加成功，请完善你的工作经验信息', $obj_url, 'success');
                } else {
                    message('操作失败或表单无变化', $this->createMobileUrl('My'), 'error');
                }
            } else {
                 //=====================上传头像处理start==============
                if (!empty($_FILES['uploadfile']['name'])) {
                    $upfile = $_FILES['uploadfile'];
                    $name = $upfile['name'];
                    $type = $upfile['type'];
                    $size = $upfile['size'];
                    $tmp_name = $upfile['tmp_name'];
                    $error = $upfile['error'];
                    //上传路径
                    //$upload_path = $_SERVER['DOCUMENT_ROOT'] . $this->_upload_prefix . "/attachment/q_3354988381_rencai/avatar/";
                    $upload_path = $this->_attach_dir . 'avatar/';

                    if (intval($error) > 0) {
                        message('上传错误：错误代码：' . $error, referer(), 'error');
                    } else {

                        //上传文件大小0为不限制，默认2M
                        $maxfilesize = empty($this->module['config']['headimgurlsize']) ? 2 : intval($this->module['config']['headimgurlsize']);
                        if ($maxfilesize > 0) {
                            if ($size > $maxfilesize * 1024 * 1024) {
                                message('上传文件不得超过 '.$maxfilesize.' M' . $_FILES["uploadfile"]["error"], referer(), 'error');
                            }
                        }

                        //允许上传的图片类型
                        $uptypes = array('image/jpg', 'image/png', 'image/jpeg');
                        //判断文件的类型
                        if (!in_array($type, $uptypes)) {
                            message('上传文件类型不符：' . $type, referer(), 'error');
                        }
                        //存放目录
                        if (!file_exists($upload_path)) {
                            mkdir($upload_path);
                        }
                        //取文件后缀
                        //$suffix = strrev( substr(strrev($name), 0, strpos(strrev($name), '.')));
                        //移动文件
                        $source_filename = $person_id . '_' . date("Ymd").'.jpg';
                        $target_filename = $person_id . '_' . date("Ymd") . '.thumb.jpg';
                        $person_data['headimgurl'] = 'images/q_3354988381_rencai/avatar/' . $target_filename;

                        
                        if (!move_uploaded_file($tmp_name, $upload_path . $source_filename)) {
                            message('移动文件失败', referer(), 'error');
                        }
                        //营业执照进行缩略
                        $srcfile = $upload_path . $source_filename;
                        $desfile = $upload_path . $target_filename;
                        //文件操作类
                        load()->func('file');
                        $ret = file_image_thumb($srcfile, $desfile, 320);
                        //删除原图
                      //  unlink($srcfile);                        
                    }
                }
                //更新时间
                $person_data['updatetime'] = $time;
                $person_data = array_merge($person_data, $_GPC['data']);

                if (pdo_update($this->person_table, $person_data, array('id' => $person_id))) {
                    message('保存成功', $this->createMobileUrl('My'), 'success');
                } else {
                    message('操作失败或表单无变化', $this->createMobileUrl('My'), 'error');
                }
            }
        } else {
            if (!empty($person_id)) {
                //判断是否已注册
                $person = pdo_fetch("SELECT * FROM " . tablename($this->person_table) . " WHERE id = :id LIMIT 1", array(":id" => $person_id));
                if (!$person) {
                    $person['province'] = $this->getConfigArr('cfg_dft_p');
                    $person['city'] = $this->getConfigArr('cfg_dft_c');
                    $person['district'] = $this->getConfigArr('cfg_dft_d');
                }                
                //头像
                if ($person['headimgurl']) {
                    if (!strstr($person['headimgurl'], 'http')) {
                        $person['headimgurl'] = $this->get_rencai_pic($person['headimgurl']);
                    }                   
                } else {
                    $person['headimgurl'] = $this->get_user_header_pic($person['from_user'], $person['sex']);
                }                
            }

            //================================取所有职位分类====================
            $parent_cate = pdo_fetchall("SELECT * FROM " . tablename($this->category_table) . " WHERE weid = :weid AND parent_id = 0 AND isshow = 1 ORDER BY display ASC", array(":weid" => $this->weid));
            $tmp = array();
            foreach ($parent_cate AS $parent) {
                array_push($tmp, $parent['id']);
            }
            $tmp = implode(",", $tmp);
            if ($tmp == '') {
                $tmp = '-1';
            }
            $sub_cate = pdo_fetchall("SELECT * FROM " . tablename($this->category_table) . " WHERE weid = :weid AND parent_id IN (" . $tmp . ") AND isshow = 1 ORDER BY display ASC", array(":weid" => $this->weid));
            foreach ($parent_cate AS $key => $parent) {
                foreach ($sub_cate AS $k => $sub) {
                    if ($sub['parent_id'] == $parent['id']) {
                        $parent_cate[$key]['sub'][$k] = $sub;
                    }
                }
            }
            
            $title = '1：填写基本信息';
            $fields_list = $this->getFieldsSaveValArr('person_', 1, 1);            
            include $this->template('public_resume_basic');
        }

        
















