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

include DISCUZ_ROOT . 'source/plugin/xigua_114/global.php';
class xigua_114
{

    public function __construct()
    {
        global $_G;
        if(!$_G['cache']['plugin']){
            loadcache('plugin');
        }
        $this->config = $_G['cache']['plugin']['xigua_114'];
        $this->config['company'] = unserialize($this->config['company']);
        $this->config['cat'] = unserialize($this->config['cat']);
    }

    function forumdisplay_topBar()
    {
        global $_G;
        if($this->config['cat'][0] == 1 && $this->config['company'][0] == 1){
            return array();
        }

        if($this->config['cache_ttl'] == 0){
            $this->config['cache_ttl'] = 3600;
        }

        $key = 'xigua114';
        $cache_data = __readfromcache($key);
        if (!$cache_data || ($cache_data['ts']+$this->config['cache_ttl'] <time()) ) {
            $return = array();
            $hasstyle = 0;
            $style = <<<HTML
<style>
#topcontainer .x1 li{box-sizing:border-box;width:54px;height:72px;float:left;margin-right:10px}
#topcontainer .x1 li:last-child{margin-right:0}
#topcontainer .x1 a{text-align:center}
#topcontainer .x1 img{border-radius:50%;display:block;margin:0 auto;width:45px;height:45px}
#topcontainer .x1 span{clear:both;display:block;text-align:center;overflow:hidden;line-height:22px;height:22px}
</style>
HTML;

            if ($this->config['cat'][0] != 1) {  //docat
                $list = C::t('#xigua_114#plugin_xigua114_cat')->list_by_pushtype();
                foreach ($this->config['cat'] as $pushtype) {
                    $html[$pushtype] = '';

                    foreach ($list as $row) {
                        if ($row['pushtype'] == $pushtype) {
                            $link = $_G['siteurl'] . 'plugin.php?id=xigua_114&mobile=no&ac=cat&catid=' . $row['id'];
                            $icon = $_G['siteurl'] . $row['icon'];
                            $html[$pushtype] .= <<<HTML
<li><a href="$link"><img src="$icon"><span>$row[name]</span></a></li>
HTML;
                        }
                    }

                    if ($html[$pushtype]) {
                        $return[] = array('name' => x1l("wsqcat_$pushtype", 0), 'html' => (!$hasstyle ? $style : '') . '<ul class="x1">' . $html[$pushtype] . '</ul>', 'more' => $_G['siteurl'] . 'plugin.php?id=xigua_114');
                        $hasstyle = 1;
                    }
                }
            }

            if ($this->config['company'][0] != 1) {  //docompany
                $companies = C::t('#xigua_114#plugin_xigua114')->list_by_pt();
                foreach ($this->config['company'] as $pt) {
                    $cmp[$pt] = '';

                    foreach ($companies as $company) {
                        if ($company['pt'] == $pt) {
                            $link = $_G['siteurl'] . 'plugin.php?id=xigua_114&mobile=no&ac=profile&mobile=no&company=' . $company['id'];
                            $icon = $_G['siteurl'] . $company['logo'];
                            $cmp[$pt] .= <<<HTML
<li><a href="$link"><img src="$icon"><span>$company[company_name]</span></a></li>
HTML;
                        }
                    }

                    if ($cmp[$pt]) {
                        $return[] = array('name' => x1l("wsqcompany_$pt", 0), 'html' => (!$hasstyle ? $style : '') . '<ul class="x1">' . $cmp[$pt] . '</ul>', 'more' => $_G['siteurl'] . 'plugin.php?id=xigua_114');
                        $hasstyle = 1;
                    }
                }

            }

            if($return){
                $cache_data['data'] = $return;
                $cache_data['ts']   = time();
                __writetocache($key, $cache_data);
            }
        }

        return $cache_data['data'];
    }
}