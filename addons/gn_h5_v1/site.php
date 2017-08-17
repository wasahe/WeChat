<?php
/**
 * 中秋祝福_v2模块微站定义
 *
 * @author 天云
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class Gn_h5_v1ModuleSite extends WeModuleSite {

    public function doMobileIndex() {

         global $_W, $_GPC;
        //读取分享借用的信息
        $accountObj = WeAccount::create($_W['uniacid']);
        $_W['account']['jssdkconfig'] = $accountObj->getJssdkConfig();

        $num = file_get_contents(IA_ROOT . '/addons/gn_h5_v1/click.txt');
        $nums = (int)$num+ rand(100,1000);
        file_put_contents(IA_ROOT . '/addons/gn_h5_v1/click.txt',$nums);
        //这个操作被定义用来呈现 功能封面
        include $this->template('index');
    }
    public function doMobileJssdk() {

         global $_W, $_GPC;
        //读取分享借用的信息
        $accountObj = WeAccount::create($_W['uniacid']);
        $_W['account']['jssdkconfig'] = $accountObj->getJssdkConfig();
        echo json_encode($_W['account']['jssdkconfig'] );
    }

}