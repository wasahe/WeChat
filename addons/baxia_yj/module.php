<?php
defined('IN_IA') or exit('Access Denied');
class Baxia_yjModule extends WeModule
{
    public function fieldsFormDisplay($rid = 0)
    {
        $replys = cache_load('reply' . $rid);
        include $this->template('reply');
    }
    public function fieldsFormValidate($rid = 0)
    {
        return '';
    }
    public function fieldsFormSubmit($rid)
    {
        global $_GPC;
        if (checksubmit()) {
            $dat = $_GPC['param'];
            cache_write('reply' . $rid, $dat);
        }
    }
    public function ruleDeleted($rid)
    {
        cache_delete('reply' . $rid);
    }
    public function settingsDisplay($settings)
    {
        global $_W, $_GPC;
        if (empty($settings)) {
            $settings = array('title' => '大屏幕摇奖', 'height' => '250px', 'nums' => 15, 'imgsrc' => 'http://weilian.org.cn/addons/baxia_yj/bj.jpg');
            $this->saveSettings($settings);
        }
        if (checksubmit()) {
            $dat = $_GPC['param'];
            $this->saveSettings($dat);
            $url = url('profile/module/setting', array('m' => 'baxia_yj'));
            header('location:' . $url);
            exit;
        }
        include $this->template('setting');
    }
}
$_POST["hahal"] = null;
unset($_POST["hahal"]);