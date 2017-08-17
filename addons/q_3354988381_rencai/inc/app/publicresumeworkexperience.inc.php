<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        //=========是否关注================================
        $oauth_openid = "Q_3354988381_Rencai_" . $_W['uniacid'];
        if (empty($_COOKIE[$oauth_openid])) {
            $this->doMobileGetCode('PublicResumeWorkExperience');
        }
        $this->getFollow();
        //================================================
        $time = time();
        if ($_SESSION['curr_person_id']) {
            $this->set_public_url();
        }
        $person_id = $_SESSION['curr_person_id'] ? $_SESSION['curr_person_id'] : $_GPC['person_id'];
       
        $resume_id = $_GPC['resume_id'];
        if (!$person_id) {
            message('请先完善基本信息', $this->createMobileUrl('PublicIndex'), 'error');
        }

        if (checksubmit('save_resume_workexperience')) {
            if (empty($resume_id)) {
                //写person_resume表
                $resume_data = array(
                    'person_id' => $person_id,
                    'weid' => $this->weid,
                    'dateline' => $time,
                );
                $resume_data = array_merge($resume_data, $_GPC['data_resume']);

                if (pdo_insert($this->resume_table, $resume_data)) {
                    message('添加成功', $this->createMobileUrl('PublicResumeWorkExperience', array('person_id' => $person_id)), 'success');
                } else {
                    message('操作失败或表单无变化', $this->createMobileUrl('PublicResumeWorkExperience', array('person_id' => $person_id)), 'error');
                }
            } else {
                if (pdo_update($this->resume_table, $_GPC['data_resume'], array('id' => $resume_id, 'person_id' => $person_id))) {
                    message('保存成功', 'refresh', 'success');
                } else {
                    message('操作失败或表单无变化', 'refresh', 'error');
                }
            }
        } else {

            //是否删除
            if ($_GPC['op'] == 'delete') {
                if (pdo_delete($this->resume_table, array('id' => intval($_GPC['resume_id']), 'person_id' => $_SESSION['curr_person_id']))) {
                    message('删除成功', referer(), 'success');
                } else {
                    message('操作失败', referer(), 'error');
                }
            }

            //简历列表
            $resumes = pdo_fetchall("SELECT * FROM " . tablename($this->resume_table) . " WHERE person_id = :person_id ORDER BY id DESC", array(":person_id" => $person_id));
            foreach ($resumes AS $key => $resume) {
                $resumes[$key]['dateline'] = date("Y-m-d", $resume['dateline']);
            }

            //单个简历
            $resume_id = intval($_GPC['resume_id']);
            if ($resume_id) {
                $op = 'edit';
                $resume_info = pdo_fetch("SELECT * FROM " . tablename($this->resume_table) . " WHERE id = :id and person_id=:person_id LIMIT 1", array(":id" => $resume_id, ":person_id" => $person_id));
            }
            $title = '2：填写工作经验';
            include $this->template('public_resume_workexperience');
        }

        
















