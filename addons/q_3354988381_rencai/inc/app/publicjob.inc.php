<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        
        //二次登录处理
        $reg_flag = pdo_fetch("SELECT id, `type`,`status` FROM " . tablename($this->member_table) . " WHERE weid = :weid AND from_user = :from_user and type=1 LIMIT 1", array(":weid" => $this->weid, ":from_user" => $this->from_user));
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
        
        $config = $this->get_config();
        //判断是否已注册
        $company = pdo_fetch("SELECT * FROM " . tablename($this->company_table) . " WHERE weid = :weid AND from_user = :from_user LIMIT 1", array(":weid" => $this->weid, ":from_user" => $this->from_user));
        if ($company) {
            $this->check_joinin_info($company['id']);
        }        
        if ($this->_debug_flag == 0 && $company !== false && $company['status'] <= 0) {
            message('您未通过审核，暂不能发布职位', referer(), 'error');
        }   

        if (!$company) {
            $person['province'] = $this->getConfigArr('cfg_dft_p');
            $person['city'] = $this->getConfigArr('cfg_dft_c');
            $person['district'] = $this->getConfigArr('cfg_dft_d');            
        }
        //企业id
        $mid = intval($company['id']);
        if (checksubmit('savejobsubmit')) {
            $current_time = time();
            //判断是否填充
            if (empty($_GPC['data']['title'])) {
                message("请填写职位名称", referer(), 'error');
            }
            if (empty($_GPC['data']['nums'])) {
                message("请填写招聘人数", referer(), 'error');
            }
            if (empty($_GPC['data']['workaddress'])) {
                message("请填写工作地点", referer(), 'error');
            }
            if (empty($_GPC['data']['description'])) {
                message("请填写职位简介", referer(), 'error');
            }
            if (false == $company) {
                if (empty($_GPC['data2']['name'])) {
                    message("请填写公司名称", referer(), 'error');
                }
                if (empty($_GPC['data2']['contact'])) {
                    message("请填写联系人", referer(), 'error');
                }
                if (empty($_GPC['data2']['mobile'])) {
                    message("请填写联系电话", referer(), 'error');
                }
            }
            /**
             * 只有第一次用户发布职位的时候，注册到用户表、企业表
             * 下次发布职位的时候，仅注册职位信息
             */
            if ($company == false) {
                //===============插入用户表=================
                $member_insert = array(
                    'weid' => $this->weid,
                    'from_user' => $this->from_user,
                    'type' => 1
                );
                pdo_insert($this->member_table, $member_insert);
                //==============插入企业表==================
                $company_insert = array(
                    'weid' => $this->weid,
                    'from_user' => $this->from_user,
                    'invite_id' => $this->get_share_whoid('c'),
                    'scale' => 0, //规模
                    'status' => $this->module['config']['isopenaudit'], //直接通过OR待审核
                    'isauth' => 0,
                    'dateline' => $current_time,
                    'view_resume_total' => $this->module['config']['viewresumenums']
                );
                if ($_GPC['province']) {
                    $company_insert['province'] = $_GPC['province'];
                    $company_insert['city'] = $_GPC['city'];
                    $company_insert['district'] = $_GPC['district'];

                }
                $company_insert = array_merge($company_insert, $_GPC['data2']);
                pdo_insert($this->company_table, $company_insert);
                $new_company_flag = true;
                //如果是第1次注册
                $mid = pdo_insertid();
                $_SESSION['curr_person_id'] = $mid; 
            }
            //============插入职位信息=================
            $job_insert = array(
                'weid' => $this->weid,
                'mid' => $mid,
                'dateline' => $current_time,
            );
            $job_insert = array_merge($job_insert, $_GPC['data']);
            $job_insert['welfare'] = strrev(substr(strrev($_GPC['data']['welfare']), 1)); //处理福利id串末尾逗号

            if (pdo_insert($this->job_table, $job_insert)) {
                $succ_info = '发布成功';
                $obj_url = $this->createMobileUrl('index');
                if ($new_company_flag) {
                    $obj_url = $this->createMobileUrl('MyCompanyInfo');
                    $succ_info .= '，请完善企业基本信息';
                }
                message($succ_info, $obj_url, 'success');
            } else {
                message("发布失败", $this->createMobileUrl('My'), 'error');
            }
        } else {
            $parent_cate = $this->get_all_office();
            $parent_industry = $this->get_all_industry();
            $title = '发布职位';
            include $this->template('public_job');
        }

        
















