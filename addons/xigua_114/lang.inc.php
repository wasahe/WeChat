<?php
/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

include_once DISCUZ_ROOT.'source/plugin/xigua_114/global.php';

$plugin = 'xigua_114';

loadcache('pluginlanguage_script');

if(submitcheck('dosubmit')){
    if(checkmobile()){
        cpmsg('no zuo no die!', "action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=lang", 'succeed');
    }


    $cache = DB::result_first("select data from ".DB::table('common_syscache')." where cname='pluginlanguage_template'");
    $data = unserialize($cache);
    $data[$plugin] = $_GET['configary1'];
    C::t('common_syscache')->update('pluginlanguage_template', $data);
    unset($data);

    $cache = DB::result_first("select data from ".DB::table('common_syscache')." where cname='pluginlanguage_script'");
    $data = unserialize($cache);
    $data[$plugin] = $_GET['configary1'];
    C::t('common_syscache')->update('pluginlanguage_script', $data);


    cpmsg(x1l('succeed', 0), "action=plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=lang", 'succeed');
}

showformheader("plugins&operation=config&do=$pluginid&identifier=xigua_114&pmod=lang");
showtableheader();


foreach ($_G['cache']['pluginlanguage_script'][$plugin] as $arr => $item) {
    showsetting($arr, 'configary1['.$arr.']', $item, 'text', 0, 0 );
}

showsubmit('dosubmit');
showtablefooter();
showformfooter();
