<?php
/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
dsetcookie('mobile', '', -1);
include DISCUZ_ROOT . 'source/plugin/xigua_114/global.php';

if(submitcheck('formhash')){
    $r = 0;
    if($id = $_GET['views']){
        $r = DB::query("UPDATE %t SET `views`=`views`+1 WHERE id=%d LIMIT 1", array(
            'plugin_xigua114',
            $id
        ));
    }
    if($id = $_GET['shares']){
        $r = DB::query("UPDATE %t SET `shares`=`shares`+1 WHERE id=%d LIMIT 1", array(
            'plugin_xigua114',
            $id
        ));
    }
    echo $r ? 1 : 0;
}