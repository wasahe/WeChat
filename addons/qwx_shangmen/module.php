<?php

/**
 * 智慧美容美发模块定义
 *
 * @author 3354988381
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class qwx_shangmenModule extends WeModule {
    private function getFieldsLabel($field) {
        global $_W, $_GPC;
        
        $condition = " uniacid=" . $_W['uniacid'];
        if ($field) {
            $condition .= " and `field` = '{$field}'";
        }

        $sql = "SELECT * "
                . "FROM " . tablename('daojia_form') . "  "
                . "WHERE $condition "
                . "ORDER BY sort ASC, id ASC"; 
        $field_data = pdo_fetch($sql);
        $label = $field_data['user_label'] ? $field_data['user_label'] : $field_data['label'];
        if (!$label) {
            $label = '美容师';
        }
        return $label;
    }
    public function fieldsFormDisplay($rid = 0) {
        //要嵌入规则编辑页的自定义内容，这里 $rid 为对应的规则编号，新增时为 0
    }

    public function fieldsFormValidate($rid = 0) {
        //规则编辑保存时，要进行的数据验证，返回空串表示验证无误，返回其他字符串将呈现为错误提示。这里 $rid 为对应的规则编号，新增时为 0
        return '';
    }

    public function fieldsFormSubmit($rid) {
        //规则验证无误保存入库时执行，这里应该进行自定义字段的保存。这里 $rid 为对应的规则编号
    }

    public function ruleDeleted($rid) {
        //删除规则时调用，这里 $rid 为对应的规则编号
    }

    public function settingsDisplay($settings) {
        global $_W, $_GPC;
        load()->func('tpl');

        if (checksubmit()) {
            $dat = array(
                'site_name' => $_GPC['site_name'],
                'service_phone' => $_GPC['service_phone'],
                'vip_usergroup' => trim($_GPC['vip_usergroup']),
                'open_gps' => trim($_GPC['open_gps']),
                'can_all_platform' => trim($_GPC['can_all_platform']),
                'msgid_resort' => trim($_GPC['msgid_resort']),
                'share_get_product_info' => trim($_GPC['share_get_product_info']),
                
                'share_title' => $_GPC['share_title'],
                'share_photo' => $_GPC['share_photo'],
                'share_desc' => $_GPC['share_desc'],
                
                'msgid_staff' => $_GPC['msgid_staff'],//通知美容师的模板消息id
                
                'open_diaodianyoujiang' => $_GPC['open_diaodianyoujiang'],
                'diaodianyoujiang_url' => $_GPC['diaodianyoujiang_url'],
                'xinshoutongdao_url' => $_GPC['xinshoutongdao_url'],
                'qiyefuli_url' => $_GPC['qiyefuli_url'],
            );
            // print_r($dat);exit;
            if ($this->saveSettings($dat)) {
                message('保存成功', 'refresh');
            }
        }

        //读取会员组的数据：
        load()->model('mc');
        $user_group = mc_groups($_W['uniacid']);

        $home_url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('index', array(), true);
        $home_url = str_replace('/./', '/', $home_url);

        $myorder_url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('myorder', array(), true);
        $myorder_url = str_replace('/./', '/', $myorder_url);

        $my_url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('my', array(), true);
        $my_url = str_replace('/./', '/', $my_url);

        $apply_vip_url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=mc&a=bond&do=card";

        include $this->template('setting');
    }

}
