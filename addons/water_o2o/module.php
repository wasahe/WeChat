<?php
defined('IN_IA') or exit('Access Denied');
class water_o2oModule extends WeModule
{
    public $fanstable = 'water_o2o_fans';
    public function settingsDisplay($system)
    {
        global $_W, $_GPC;
        load()->func('tpl');
        if (checksubmit()) {
            load()->func('file');
            $_W['uploadsetting']                            = array();
            $_W['uploadsetting']['image']['folder']         = 'images/' . $_W['uniacid'];
            $_W['setting']['upload']['image']['extentions'] = array_merge($_W['setting']['upload']['image']['extentions'], array(
                "pem"
            ));
            $_W['uploadsetting']['image']['limit']          = $_W['config']['upload']['image']['limit'];
            if (!empty($_FILES['apiclient_cert_file']['name'])) {
                $file = file_upload($_FILES['apiclient_cert_file']);
                if (is_error($file)) {
                    message('apiclient_cert证书保存失败, 请保证目录可写' . $file['message']);
                } else {
                    $_GPC['apiclient_cert'] = empty($file['path']) ? trim($_GPC['apiclient_cert']) : ATTACHMENT_ROOT . $file['path'];
                }
            }
            if (!empty($_FILES['apiclient_key_file']['name'])) {
                $file = file_upload($_FILES['apiclient_key_file']);
                if (is_error($file)) {
                    message('apiclient_key证书保存失败, 请保证目录可写' . $file['message']);
                } else {
                    $_GPC['apiclient_key'] = empty($file['path']) ? trim($_GPC['apiclient_key']) : ATTACHMENT_ROOT . $file['path'];
                }
            }
            if (!empty($_FILES['rootca_file']['name'])) {
                $file = file_upload($_FILES['rootca_file']);
                if (is_error($file)) {
                    message('rootca证书保存失败, 请保证目录可写' . $file['message']);
                } else {
                    $_GPC['rootca'] = empty($file['path']) ? trim($_GPC['rootca']) : ATTACHMENT_ROOT . $file['path'];
                }
            }
            $input                   = array();
            $input['sysname']        = trim($_GPC['sysname']);
            $input['kfdh']           = trim($_GPC['kfdh']);
            $input['wktmbegin']      = trim($_GPC['wktmbegin']);
            $input['wktmend']        = trim($_GPC['wktmend']);
            $input['wktmrange']      = trim($_GPC['wktmrange']);
            $input['wkxxrangemin']   = trim($_GPC['wkxxrangemin']);
            $input['wkxxrangemax']   = trim($_GPC['wkxxrangemax']);
            $input['wktmyy']         = trim($_GPC['wktmyy']);
            $input['gaodekey']       = trim($_GPC['gaodekey']);
            $input['sharetitle']     = trim($_GPC['sharetitle']);
            $input['sharedesc']      = trim($_GPC['sharedesc']);
            $input['sharepic']       = trim($_GPC['sharepic']);
            $input['smfw']           = trim($_GPC['smfw']);
            $input['banner1']        = $_GPC['banner1'];
            $input['banner2']        = $_GPC['banner2'];
            $input['banner3']        = $_GPC['banner3'];
            $input['zhucetitle']     = $_GPC['zhucetitle'];
            $input['zhuceimg']       = $_GPC['zhuceimg'];
            $input['zhucecontent']   = $_GPC['zhucecontent'];
            $input['usefish']        = intval(trim($_GPC['usefish']));
            $input['fishappkey']     = trim($_GPC['fishappkey']);
            $input['fishsecret']     = trim($_GPC['fishsecret']);
            $input['fishsign']       = trim($_GPC['fishsign']);
            $input['fishyzmb']       = trim($_GPC['fishyzmb']);
            $input['fishyzmparam']   = trim($_GPC['fishyzmparam']);
            $input['smsuid']         = $_GPC['smsuid'];
            $input['smspwd']         = $_GPC['smspwd'];
            $input['smsyzmb']        = $_GPC['smsyzmb'];
            $input['user_yyzf']      = $_GPC['user_yyzf'];
            $input['worker_ddtx']    = $_GPC['worker_ddtx'];
            $input['shopcost']       = floatval(trim($_GPC['shopcost']));
            $input['workercost']     = floatval(trim($_GPC['workercost']));
            $input['apiclient_cert'] = trim($_GPC['apiclient_cert']);
            $input['apiclient_key']  = trim($_GPC['apiclient_key']);
            $input['rootca']         = trim($_GPC['rootca']);
            $input['ip']             = trim($_GPC['ip']);
            $payment                 = pdo_fetch("SELECT payment FROM " . tablename('uni_settings') . " WHERE uniacid= '{$_W['uniacid']}'");
            $payment                 = unserialize($payment['payment']);
            $input['mchid']          = $payment['wechat']['mchid'];
            $input['apikey']         = $payment['wechat']['apikey'];
            $input['workid']         = trim($_GPC['workid']);
            $input['wknickname']     = trim($_GPC['wknickname']);
            if ($_GPC['workid']) {
                $fans = pdo_fetch("SELECT openid,nickname FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$_GPC['workid']}'");
                if ($fans) {
                    $input['wknickname'] = $fans['nickname'];
                } else {
                    message('找不到此ID的用户信息，请通过微信进入维修管家之后再进行尝试');
                }
            }
            if ($input['wknickname']) {
                $fans = pdo_fetch("SELECT openid,nickname FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and nickname = '{$input['wknickname']}'");
                if ($fans) {
                    $input['workid'] = $fans['openid'];
                } else {
                    message('找不到此昵称的用户信息，请通过微信进入维修管家之后再进行尝试');
                }
            }
            if ($this->saveSettings($input)) {
                message('保存参数成功', 'refresh');
            }
        }
        if (empty($system['ip'])) {
            $system['ip'] = $_SERVER['SERVER_ADDR'];
        }
        include $this->template('system');
    }
}