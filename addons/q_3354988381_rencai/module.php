<?php

/**
 * 微招聘模块定义
 *
 * @author qq-3354988381
 * @url http://v2.addons.we7.cc/web/index.php?c=store&a=author&uid=91001
 * @公众号 http://v2.addons.we7.cc/web/index.php?c=store&a=author&uid=91001
 * @微信产品QQ群 490186557
 * 
 */
defined('IN_IA') or exit('Access Denied');

class Q_3354988381_rencaiModule extends WeModule {

    /**
     * 自定义回复表
     * @var unknown
     */
    public $tablename = 'q_3354988381_rencai_reply';

    public function fieldsFormDisplay($rid = 0) {
        global $_W;
        if (!empty($rid)) {
            $reply = pdo_fetch("SELECT * FROM " . tablename($this->tablename) . " WHERE acid = :acid AND rid = :rid ORDER BY `id` DESC", array(':acid' => $_W['uniacid'], ':rid' => $rid));
        }
        $home_url = $_W['siteroot'].'app/'.$this->createMobileUrl('index',array(),true);
        $home_url = str_replace('/./', '/', $home_url);           
        load()->func('tpl');
        include $this->template('form');
    }

    public function fieldsFormValidate($rid = 0) {
        return true;
    }

    public function fieldsFormSubmit($rid) {
        global $_GPC, $_W;
        $id = intval($_GPC['reply_id']);
        $data = array(
            'acid' => $_W['uniacid'],
            'rid' => $rid,
            'title' => $_GPC['title'],
            'avatar' => $_GPC['avatar'],
            'description' => $_GPC['description'],
            'dateline' => time()
        );
        if (empty($id)) {
            pdo_insert($this->tablename, $data);
        } else {
            pdo_update($this->tablename, $data, array('id' => $id));
        }
    }

    public function ruleDeleted($rid) {
        
    }
////加入初始数据
    private function set_up_insert_into_origin_data() {
        global $_W, $_GPC;
        $para_data = pdo_fetch("SELECT * FROM ".tablename('uni_account_modules')." WHERE module = :module AND uniacid = :uniacid", array(':module' => 'q_3354988381_rencai', ':uniacid' => $_W['uniacid']));
        if (!$para_data || $para_data['settings'] == '') {
            $default_para_setting = 'a:25:{s:15:"resume_validity";s:16:"1
3
5
10
365";s:7:"payroll";s:83:"1000-1999/月
2000-3999/月
4000-6999/月
7000-9999/月
10000以上/月
面议";s:7:"welfare";s:54:"五险一金
年底双薪
出国培训
生日惊喜";s:11:"educational";s:55:"初中
高中
大专
本科
硕士
博士及以上";s:12:"positiontype";s:14:"全职
兼职";s:14:"workexperience";s:36:"1-3年
3-5年
5-10年
10年以上";s:11:"companytype";s:40:"国营企业
私营企业
外资企业";s:5:"scale";s:46:"20人以下
20-50人
50-200人
200人以上";s:6:"qrcode";s:51:"images/9/2016/04/lmmHMyeyKpGXxPhHjKgHvJzh2Kkmeg.jpg";s:9:"telephone";s:10:"3354988381";s:11:"isopenaudit";s:1:"0";s:14:"viewresumenums";i:5;s:14:"isopenindextop";i:1;s:14:"isopenindexhot";i:1;s:12:"indextopnums";i:5;s:12:"indexhotnums";i:5;s:13:"indexlastnums";i:5;s:16:"indexcompanynums";i:6;s:13:"isopenlicense";s:1:"1";s:11:"maxfilesize";s:0:"";s:14:"headimgurlsize";s:1:"1";s:15:"headimgurlwidth";s:3:"200";s:14:"show_part_time";s:1:"0";s:16:"show_used_market";s:1:"0";s:18:"mobile_index_title";s:24:"微人才微招聘演示";}';
                
                $data_insert = array(
                    'uniacid' => $_W['uniacid'],
                    'module' => 'q_3354988381_rencai',
                    'enabled' => 1,
                    'settings' => $default_para_setting,
                );
                if (!$para_data) {
                    pdo_insert('uni_account_modules', $data_insert);
                } else {
                    pdo_update('uni_account_modules', $data_insert, array('id' => $para_data['id']));
                }
                
        }
    }
    public function settingsDisplay($settings) {
        global $_W, $_GPC;
        $this->set_up_insert_into_origin_data();
        $id = $_W['uniacid'];
        if (checksubmit()) {
            if (!empty($_FILES['fhbpaycert']['tmp_name'])) {
                load()->func('file');
                require_once IA_ROOT . '/addons/q_3354988381_rencai/lib/PHPZIP.php';
                $ext = pathinfo($_FILES['fhbpaycert']['name'], PATHINFO_EXTENSION);
                if (strtolower($ext) != "zip") {
                    message("[文件格式错误]请上传您的微信支付证书哦~", referer(), 'error');
                }
                
                $wxcertdir = IA_ROOT . "/web/{$id}";
                if (!is_dir($wxcertdir)) {
                    mkdir($wxcertdir);
                }
                if (is_dir($wxcertdir)) {
                    if (!is_writable($wxcertdir)) {
                        message("请保证目录：[" . $wxcertdir . "]可写");
                    }
                }
                $save_file = $wxcertdir . "/" . $id . "." . $ext;
                file_move($_FILES['fhbpaycert']['tmp_name'], $save_file);
                $archive = new PHPZIP();
                $archive->unzip($save_file, $wxcertdir); // 把zip中的文件解压到目录中
                file_delete($save_file);
                unlink($save_file);
            }             
            $dat = array(
//                    'colspan' => empty($_GPC['colspan']) ? 3 : intval($_GPC['colspan']),
                'resume_validity' => $_GPC['resume_validity'],
                'payroll' => $_GPC['payroll'],
                'welfare' => $_GPC['welfare'],
                'educational' => $_GPC['educational'],
                'positiontype' => $_GPC['positiontype'],
                'workexperience' => $_GPC['workexperience'],
                'companytype' => $_GPC['companytype'],
                'scale' => $_GPC['scale'],
                'qrcode' => $_GPC['qrcode'],
                'telephone' => $_GPC['telephone'],
                'isopenaudit' => $_GPC['isopenaudit'],
                'viewresumenums' => $_GPC['viewresumenums'],
                
                'isopenindextop' => !empty($_GPC['isopenindextop']) ? intval($_GPC['isopenindextop']) : 0,
                'isopenindexhot' => !empty($_GPC['isopenindexhot']) ? intval($_GPC['isopenindexhot']) : 0,
                'indextopnums' => !empty($_GPC['indextopnums']) ? intval($_GPC['indextopnums']) : 5,
                'indexhotnums' => !empty($_GPC['indexhotnums']) ? intval($_GPC['indexhotnums']) : 5,
                'indexlastnums' => !empty($_GPC['indexlastnums']) ? intval($_GPC['indexlastnums']) : 5,
                'indexcompanynums' => !empty($_GPC['indexcompanynums']) ? intval($_GPC['indexcompanynums']) : 5,
                'isopenlicense' => $_GPC['isopenlicense'],
                'maxfilesize' => $_GPC['maxfilesize'],
                'headimgurlsize' => $_GPC['headimgurlsize'],
                'headimgurlwidth' => $_GPC['headimgurlwidth'],
                
                'show_part_time' => $_GPC['show_part_time'],
                'show_used_market' => $_GPC['show_used_market'],
                'mobile_index_title' => $_GPC['mobile_index_title'],
                'ad_speed' => $_GPC['ad_speed'],
                'ad_time_of_lookresume' => $_GPC['ad_time_of_lookresume'],
                'view_need_person_agree' => $_GPC['view_need_person_agree'],
                
                'notify_auth_key' => $_GPC['notify_auth_key'],
                'footer_nav_bgcolors' => $_GPC['footer_nav_bgcolors'] ? $_GPC['footer_nav_bgcolors'] : '#0e76ad',
                
                'svs_appid' => $_GPC['svs_appid'],
                'svs_appsecret' => $_GPC['svs_appsecret'],
                
                'open_gps' => $_GPC['open_gps'],
                'miniaddmoney' => $_GPC['miniaddmoney'],
                'price_per_resume' => $_GPC['price_per_resume'],
                'company_joinin_cost_per_year' => $_GPC['company_joinin_cost_per_year'],
                'invites_per_member' => $_GPC['invites_per_member'],
                
                'cfg_dft_p' => $_GPC['cfg_dft_p'],
                'cfg_dft_c' => $_GPC['cfg_dft_c'],
                'cfg_dft_d' => $_GPC['cfg_dft_d'],
                
                'recommend_award_company' => $_GPC['recommend_award_company'],
                'recommend_award_person' => $_GPC['recommend_award_person'],
                'award_of_send_resume' => $_GPC['award_of_send_resume'],
                
                'fhb_mchid' => $_GPC['fhb_mchid'],
                'fhb_appid' => $_GPC['fhb_appid'],
		'fhb_secret' => $_GPC['fhb_secret'],
                'fhb_send_name' => $_GPC['fhb_send_name'],
                'fhb_nick_name' => $_GPC['fhb_nick_name'],
                'fhb_wishing' => $_GPC['fhb_wishing'],
                'fhb_remark' => $_GPC['fhb_remark'],
                'fhb_act_name' => $_GPC['fhb_act_name'],   
                'fhb_send_key' => $_GPC['fhb_send_key'],
            );
            $this->saveSettings($dat);
            message('配置参数更新成功！', referer(), 'success');
        }
        if ($this->module['config']['footer_nav_bgcolors'] == '') {
            $this->module['config']['footer_nav_bgcolors'] = '#AD0E56';
        }
        //是否上传过证书
        $wxcertdir = IA_ROOT . "/web/{$id}/apiclient_cert.pem";
        $wxcertdir_flag = file_exists($wxcertdir);       
        
        load()->func('tpl');
        include $this->template('setting');
    }

}
