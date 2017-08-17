<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        $config = $this->get_config();
        if (checksubmit('savejobsubmit')) {
            if (false == $id = intval($_GPC['id'])) {
                message("传参错误", referer(), 'error');
            } else {
                //接收提交数据
                $data = $_GPC['data'];
                //判断是否填充
                if (empty($data['name']) || empty($data['address']) || empty($data['contact']) || empty($data['mobile']) || empty($data['description'])) {
                    message("请填写完整", referer(), 'error');
                }
                //是否开启运营执照上传
                if ($this->module['config']['isopenlicense'] && !empty($_FILES['license']['name'])) {
                    $data['license'] = 'images/q_3354988381_rencai/' . $this->upload_img('license', 'license');
                }

                //上传Logo
                if (!empty($_FILES['logo']['name'])) {
                    $data['logo'] = 'images/q_3354988381_rencai/' . $this->upload_img('logo', 'logo', true, 160);   //首页160*120
                }

                //上传封面
                if (!empty($_FILES['avatar']['name'])) {
                    $data['avatar'] = 'images/q_3354988381_rencai/' . $this->upload_img('avatar', 'avatar', true, 360);  //公司介绍页360*180
                }
                if (pdo_update($this->company_table, $data, array('weid' => $this->weid, "id" => $id))) {
                    message("成功保存", referer(), 'success');
                } else {
                    message("没有修改或保存失败", referer(), 'error');
                }
            }
        } else {
            //取企业注册信息
            $row = pdo_fetch("SELECT * FROM " . tablename($this->company_table) . " WHERE weid = :weid AND from_user = :from_user order by sort asc, id desc", array(":weid" => $this->weid, ":from_user" => $this->from_user));
            if (!$row) {
                $row['province'] = $this->getConfigArr('cfg_dft_p');
                $row['city'] = $this->getConfigArr('cfg_dft_c');
                $row['district'] = $this->getConfigArr('cfg_dft_d');
            }             
            //===============================取行业分类=========================
            $parent_industry = $this->get_all_industry();
            //是否开启营业执照上传
            $isopenlicense = $this->module['config']['isopenlicense'];
            load()->func('tpl');
            $title = '企业信息';
            include $this->template('my_company_info');
        }

        
















