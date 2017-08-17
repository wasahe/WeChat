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

$pluginid = 'xigua_114';

$sql = <<<SQL
  DROP TABLE pre_plugin_xigua114;
  DROP TABLE pre_plugin_xigua114_cat;
  DROP TABLE pre_plugin_xigua114_report;
SQL;

$cache_file = DISCUZ_ROOT . "./data/sysdata/table_plugin_xigua114_cat.php";
@unlink($cache_file);

$cache_file = DISCUZ_ROOT . "./data/sysdata/table_plugin_xigua114_wsqcache.php";
@unlink($cache_file);

@unlink(DISCUZ_ROOT . "./data/sysdata/xigua_114_access_token.php");
@unlink(DISCUZ_ROOT . "./data/sysdata/xigua_114_jsapi_ticket.php");

function xigua114delete_all($directory, $empty = false) {
    if(substr($directory,-1) == "/") {
        $directory = substr($directory,0,-1);
    }

    if(!file_exists($directory) || !is_dir($directory)) {
        return false;
    } elseif(!is_readable($directory)) {
        return false;
    } else {
        @$directoryHandle = opendir($directory);

        while ($contents = @readdir($directoryHandle)) {
            if($contents != '.' && $contents != '..') {
                $path = $directory . "/" . $contents;

                if(is_dir($path)) {
                    @xigua114delete_all($path, $empty);
                } else {
                    @unlink($path);
                }
            }
        }

        @closedir($directoryHandle);

        if($empty == false) {
            if(!@rmdir($directory)) {
                return false;
            }
        }

        return true;
    }
}


runquery($sql);


@include_once DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';
WeChatHook::delAPIHook($pluginid);

$finish = TRUE;