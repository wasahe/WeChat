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
//ini_set('display_errors', 1);
//error_reporting(E_ALL ^ E_NOTICE);
$VERSION = '20160613';
if(!$_G['cache']['plugin']){
    loadcache('plugin');
}
$wechat = unserialize($_G['setting']['mobilewechat']);
$config = $_G['cache']['plugin']['xigua_114'];
$config['lunheight'] = $config['lunheight'] ? $config['lunheight'] : 200;
$cin = $config['callinlist'];

if(!$config['allowpc']){
    if(!checkmobile()){
        dheader('Location:'.$_G['siteurl']);
        exit;
    }
}
define('IN___WECHAT', strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false);

dsetcookie('mobile', '', -1);
include DISCUZ_ROOT . 'source/plugin/xigua_114/global.php';
$_GET = dhtmlspecialchars($_GET, ENT_QUOTES);
$acs = array(
    'index',
    'join',
    'report',
    'uploader',
    'cat',
    'profile',
    'map',
    'search',
    'rank',
    'fetchtype',
    'getgeo',
);
if(empty($_GET['ac']) || !in_array($_GET['ac'], $acs)){
    $_GET['ac'] = 'index';
}

$page = max(1, intval(getgpc('page')));
$lpp  = $config['lpp'] ? $config['lpp'] : 50;
$start_limit = ($page - 1) * $lpp;

if($_GET['formhash'] == FORMHASH){
    $_GET = ___get_real_input($_GET);
}

switch($_GET['ac']){
    case 'getgeo':
        $m = get114Distance($_GET['lat'], $_GET['lng'], $_GET['lat1'], $_GET['lng1']);
        if($m<=1000){
            $m = intval($m). 'm';
        }else if($m>1000){
            $m = round($m/1000, 1). 'km';
        }
        echo sprintf($config['mapguide'], $m);
        exit;
        break;
    case 'search':
        if($_GET['formhash'] == FORMHASH && submitcheck('phonename', 1)) {
            $phonename = trim($_GET['phonename']);
            $company_list = C::t('#xigua_114#plugin_xigua114')->fetch_all_by_search($start_limit, $lpp, $phonename);

            if(!($total_page = intval($_GET['total']))){
                $count        = C::t('#xigua_114#plugin_xigua114')->_count_search($phonename);
                $total_page   = floor($count/$lpp)+1;
            }

            foreach ($company_list as $k => $company) {
                $company['link'] = 'plugin.php?id=xigua_114&mobile=no&ac=profile&company='.$company['id'];
                $company['logo'] = $company['logo'] ? $company['logo'] : 'source/plugin/xigua_114/static/nologo.png';
                $company['logo'] = get_picurl($company['logo']);
                $company['qr'] = get_picurl($company['qr']);
                $company['cover'] = get_picurl($company['cover']);

                $company_list[$k] = $company;
            }
            if($_GET['inajax']){
                foreach ($company_list as $k => $company) {
                    echo format_company_list($company);
                }
                exit;
            }
        }

        $title = x1l('search_result', 0);
        include_once DISCUZ_ROOT . 'source/plugin/xigua_114/template/search.php';
        break;
    case 'uploader':
        $res = upload_114($_FILES['Filedata'], array('.jpg', '.jpeg', '.png'));
        ob_end_clean();
        function_exists('ob_gzhandler') ? ob_start('ob_gzhandler') : ob_start();
        header("Content-type: application/json");
        $res['error'] = iconv(CHARSET, 'UTF-8', $res['error']);
        echo json_encode($res);
        exit;
        break;
    case 'join':
        if(submitcheck('formhash')){
            $row = $_GET['row'];
            $row['province'] = $_GET['resideprovince'];
            $row['city'] = $_GET['residecity'];
            $row['dist'] = $_GET['residedist'];
            $row['crts'] = time();
            $row['cover'] = implode("\t", $row['cover']);

            if(C::t('#xigua_114#plugin_xigua114')->check_phone($row['phone'])){
                x1l('company_name_exists');
                exit;
            }
            if(C::t('#xigua_114#plugin_xigua114')->insert($row, true, false, true)){
                echo 'succeed';
            }else{
                echo x1l('error_', 0);
            }
            exit;
        }
        include_once libfile('function/profile');
        $cityhtml = showdistrict(
            array(0,0,0),
            array('resideprovince', 'residecity', 'residedist'),
            'residecitybox',
            3,
            'reside'
        );

        $list = C::t('#xigua_114#plugin_xigua114_cat')->list_all(0);
        foreach ($list as $index => $item) {
            if($item['adlink']){
                unset($list[$index]);
            }
        }
        C::t('#xigua_114#plugin_xigua114_cat')->init($list);
        $cat_list = C::t('#xigua_114#plugin_xigua114_cat')->get_tree_array(0);
        $cat = "<select class='form-control form-control-top' name=\"row[catid]\">";
        $cat .= "<option value=\"0\">".x1l('cat_error', 0)."</option>";
        foreach ($cat_list as $k => $v) {
            $cat .= "<optgroup label=\"$v[name]\">";
            foreach ($v['child'] as $kk => $vv) {
                $cat .= "<option value=\"$vv[id]\">$vv[name]</option>";
            }
            $cat .= "</optgroup>";
        }
        $cat .= '</select>';

        $title = x1l('in', 0);
        include_once DISCUZ_ROOT . 'source/plugin/xigua_114/template/join.php';
        break;
    case 'report':
        if(submitcheck('formhash')){
            $row = $_GET['row'];
            $row['crts']   = time();
            $row['status'] = 0;
            $row['phone'] = trim($row['phone']);
            $row['extra'] = trim($row['extra']);
            $row['mobile'] = trim($row['mobile']);

            if(empty($row['phone'])){
                x1l('phone_vaild');
                exit;
            }
            if(empty($row['extra'])){
                x1l('extra_vaild');
                exit;
            }
            if(empty($row['mobile'])){
                x1l('mobile_qq_vaild');
                exit;
            }

            if(C::t('#xigua_114#plugin_xigua114_report')->insert($row, true, false, true)){
                echo 'report_succeed';
            }else{
                echo x1l('error_', 0);
            }
            exit;
        }
        $title = x1l('report_title', 0);
        include_once DISCUZ_ROOT . 'source/plugin/xigua_114/template/report.php';
        break;
    case 'cat':
        $where = '';
        $catid = intval($_GET['catid']);

        if($catid){
            $list = C::t('#xigua_114#plugin_xigua114_cat')->list_by_pid($catid, FALSE);
            if(empty($list)){
                echo 'catid Error.';
                exit;
            }
            foreach ($list as $k_ => $v_) {
                if($v_['pid'] == 0){
                    $top_cat = $v_;
                }else{
                    $cat_list[$v_['id']] = $v_;
                }
                if($v_['nearby']){
                    $cat_near[$v_['id']] = $v_;
                }
            }
        }

        if($config['tt']){
            /*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
            if($city = dhtmlspecialchars($_GET['city'])){
                $quotecity = DB::quote($city);
                $where = " AND $config[filter1]=$quotecity";
            }
            if(!$top_cat){
                $top_cat = C::t('#xigua_114#plugin_xigua114_cat')->get_pid_by_childs(array($catid));
                $top_cat['id'] = $top_cat['pid'];
            }
            $showlist = C::t('#xigua_114#plugin_xigua114_cat')->list_by_pid(0, FALSE);
            if($top_cat['id'] !=0){
                $slblist  = C::t('#xigua_114#plugin_xigua114_cat')->get_childs_by_pids(array($top_cat['id']));
            }else{
                $slblist  = array();
            }
            $dists = C::t('#xigua_114#plugin_xigua114')->fetch_city_dist($config['filter1']);
            /*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
        }

        if($_GET['notme'] && $config['aboutshnum']){
            $lpp = $config['aboutshnum']+1;
        }

        if($_GET['lat'] && $_GET['lng']){
            $_GET['needgeo'] = 1;
            $company_list = C::t('#xigua_114#plugin_xigua114')->fetch_all_by_geo($_GET['lat'], $_GET['lng'], array_keys($cat_list), $start_limit, $lpp);
        }else{

            $company_list = C::t('#xigua_114#plugin_xigua114')->fetch_all_by_pids_page(array_keys($cat_list), $start_limit, $lpp, $where);
        }


//        $company_list = C::t('#xigua_114#plugin_xigua114')->fetch_all_by_pids_page(array_keys($cat_list), $start_limit, $lpp, $where);

        $digest = $listinfo = array();
        foreach ($company_list as $company) {
            $company['link'] = 'plugin.php?id=xigua_114&mobile=no&ac=profile&company='.$company['id'];
            $company['logo'] = $company['logo'] ? $company['logo'] : 'source/plugin/xigua_114/static/nologo.png';
            $company['logo'] = get_picurl($company['logo']);
            $company['qr']   = get_picurl($company['qr']);
            $company['cover'] = get_picurl($company['cover']);

            if($company['digest'] == 1){
                $digest[] = $company;
            }
            if(intval($_GET['notme']) != $company['id']){
                $listinfo[] = $company;
            }
        }

        if(submitcheck('inajax', 1) &&FORMHASH == $_GET['formhash']){

            if($listinfo){
            echo '<ul class="cl company-list-1">';
            foreach ($listinfo as $company) {
                echo format_company_list($company);
            }
            echo '</ul>';
            }

            /*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
            exit;
        }

        $total_count = C::t('#xigua_114#plugin_xigua114')->_count_by_pids(array_keys($cat_list));
        $total_page  = floor($total_count/$lpp)+1;

        $top_cat['link'] = 'plugin.php?id=xigua_114&mobile=no&ac=cat&catid='.$top_cat['id'];
        $top_cat['icon'] = $top_cat['icon'] ? $top_cat['icon'] : 'source/plugin/xigua_114/static/noicon.png';
        if(! $top_cat['name']){
            foreach ($slblist as $kkk => $vvv) {
                if($vvv['id'] == $catid){
                    $subname = $vvv['name'];
                    continue;
                }
            }
        }
        $title = $top_cat['name'] ? $top_cat['name'] : ($subname ? $subname : x1l('fx', 0));

        include_once DISCUZ_ROOT . 'source/plugin/xigua_114/template/cat.php';
        break;
    case 'rank':

        $company_list = C::t('#xigua_114#plugin_xigua114')->fetch_all_by_page($start_limit, $lpp, 0,1,'', ' `views` DESC,`shares` DESC,`displayorder` ASC,digest DESC ');
        foreach ($company_list as $company) {
            $company['link'] = 'plugin.php?id=xigua_114&mobile=no&ac=profile&company='.$company['id'];
            $company['logo'] = $company['logo'] ? $company['logo'] : 'source/plugin/xigua_114/static/nologo.png';
            $company['logo'] = get_picurl($company['logo']);
            $company['qr']   = get_picurl($company['qr']);
            $company['cover'] = get_picurl($company['cover']);
            $listinfo[] = $company;
        }

        if(submitcheck('inajax', 1) &&FORMHASH == $_GET['formhash']){

            echo '<ul class="cl company-list-1">';
            foreach ($listinfo as $k => $company) {
                $k = $start_limit+1+$k;
                echo format_company_list($company, $k);
            }
            echo '</ul>';
            exit;
        }
        $total_count = C::t('#xigua_114#plugin_xigua114')->_count_by_pids();
        $total_page  = floor($total_count/$lpp)+1;

        $title = x1l('ranktitle', 0);
        include_once DISCUZ_ROOT . 'source/plugin/xigua_114/template/rank.php';
        break;
    case 'fetchtype':
        $pt = $_GET['pt'];
        $where = '';

        if($vip = $_GET['vip']){
            $where .= ' AND `v`=1';
        }
        if($dig = $_GET['dig']){
            $where .= ' AND `digest`=1';
        }

        if($pt == 'hot'){
            $where .= " AND `pt`='$pt'";
            $company_list = C::t('#xigua_114#plugin_xigua114')->fetch_all_by_page($start_limit, $lpp, 0,1, $where, ' `views` DESC,`shares` DESC,`displayorder` DESC ');
        }elseif($pt == 'new'){
//            $where .= " AND `pt`='$pt'";
            $company_list = C::t('#xigua_114#plugin_xigua114')->fetch_all_by_page($start_limit, $lpp, 0,1, $where, ' `id` DESC ');
        }elseif($pt == 'hui'){
            $where .= " AND `pt`='$pt'";
            $company_list = C::t('#xigua_114#plugin_xigua114')->fetch_all_by_page($start_limit, $lpp, 0,1, $where, ' `views` DESC,`shares` DESC,`displayorder` DESC ');
        }else{
            $company_list = C::t('#xigua_114#plugin_xigua114')->fetch_all_by_page($start_limit, $lpp, 0,1, $where, ' `views` DESC,`shares` DESC,`displayorder` DESC ');
        }

        foreach ($company_list as $company) {
            $company['link'] = 'plugin.php?id=xigua_114&mobile=no&ac=profile&company='.$company['id'];
            $company['logo'] = $company['logo'] ? $company['logo'] : 'source/plugin/xigua_114/static/nologo.png';
            $company['logo'] = get_picurl($company['logo']);
            $company['qr']   = get_picurl($company['qr']);
            $company['cover'] = get_picurl($company['cover']);
            $listinfo[] = $company;
        }

        if(submitcheck('inajax', 1) &&FORMHASH == $_GET['formhash']){

            echo '<ul class="cl company-list-1">';
            foreach ($listinfo as $k => $company) {
                echo format_company_list($company);
            }
            if(!$listinfo){
                echo "<li><a><div class=\"company-title\">".x1l('nodata', 0)."</div><div class=\"company-desc\"> </div></a></li>";
            }
            echo '</ul>';
            exit;
        }
        break;
    case 'profile':
        $company_id = intval($_GET['company']);

        $company = C::t('#xigua_114#plugin_xigua114')->fetch($company_id);
        $company['link'] = 'plugin.php?id=xigua_114&mobile=no&ac=profile&company='.$company['id'];
        $company['logo'] = $company['logo'] ? $company['logo'] : 'source/plugin/xigua_114/static/nologo.png';
        $company['logo'] = get_picurl($company['logo']);
        $company['qr']   = get_picurl($company['qr']);
        $company['cover'] = get_picurl($company['cover']);
        $company['url'] = $company['site'] ? $company['site'] : ($company['weibo'] ? $company['weibo']: 'javascript:void(0);');

        $title = $company['company_name'];


        $catinfo = C::t('#xigua_114#plugin_xigua114_cat')->fetch($company['catid']);
//        print_r($catinfo);

        if($_GET['inajax']){
            if($company['pt'] == 'hot'){
                $company['pt_string'] = '<i style="background:#FF4E00;">'.x1l('mainhot', 0).'</i>';
            } else if($company['pt'] == 'new'){
                $company['pt_string'] = '<i style="background:#52AF27;">'.x1l('mainnew', 0).'</i>';
            } else if($company['pt'] == 'hui'){
                $company['pt_string'] = '<i style="background:#feaa2c;">' .x1l('mainhui', 0).'</i>';
            }else{
                $company['pt_string'] = '';
            }
            $company['v'] = $company['v'] ? '<img src="source/plugin/xigua_114/static/r2.png" class="rstblock-logo-passicon">' : '';
            $company['crts'] = dgmdate($company['crts'], 'Y-m-d H:i');

            include template('profile_ajax', 0, 'source/plugin/xigua_114/template/web');
            exit;
        }

        $timestamp = time();
        $noncestr = uniqid('wx');
        $cururl = xg_get_url();
        $signature = __get_access_token($noncestr, $cururl, $timestamp);

        include_once DISCUZ_ROOT . 'source/plugin/xigua_114/template/profile.php';
        break;
    case 'map':
        if($map_id = intval($_GET['company'])){
            $info = C::t('#xigua_114#plugin_xigua114')->fetch($map_id);
            $hast = $search = $info['company_name'];
        }
        $addr = $info['province'].$info['city'].$info['dist'].$info['address'];
        $addrs = $info['province'].','.$info['city'].','.$info['dist'].','.$info['address'];
        $desc = $info['company_desc'] ? $info['company_desc'] : $info['company_name'];

        $title = $hast ? $hast : x1l('near_by', 0) .$search;
        include_once DISCUZ_ROOT . 'source/plugin/xigua_114/template/map.php';
        break;
    default:

        $key = 'xigua114_cat_cache';
        $cache_data = __readfromcache($key);
        if (!$cache_data) {

            $bar = $hotlist = $near = $nav_hide = $nav = $sliders = array();
            $list = C::t('#xigua_114#plugin_xigua114_cat')->list_by_pid(0, TRUE);
            foreach ($list as $k_ => $row) {
                $pos = $row['pos'];
                $row['link'] = $row['adlink'] ? $row['adlink']:'plugin.php?id=xigua_114&mobile=no&ac=cat&catid='.$row['id'];
                $row['icon'] = $row['icon'] ? $row['icon'] : 'source/plugin/xigua_114/static/noicon.png';
                $list[$k_] = $row;

                if($pos == 'slider'){
                    $sliders[] = $row;
                }else if($pos == 'nav'){
                    if(count($nav)> 7){
                        $nav_hide[] = $row;
                    }else{
                        $nav[] = $row;
                    }
                }else if($pos == 'near'){
                    $near[] = $row;
                }else if($pos == 'list'){
                    $hotlist[] = $row;
                }else if($pos == 'bar'){
                    $bar[] = $row;
                }
            }
            if($hotlist){
                foreach ($hotlist as $row_) {
                    $pids_[] = $row_['id'];
                }
                $childs = C::t('#xigua_114#plugin_xigua114_cat')->get_childs_by_pids($pids_);
                foreach ($hotlist as $hk_ => $hrow_) {
                    foreach ($childs as $child) {
                        if($child['pid'] == $hrow_['id']){
                            if(count($hotlist[$hk_]['child'])>=2){
                                break 1;
                            }
                            $hotlist[$hk_]['child'][] = $child['name'];
                        }
                    }
                }
            }

            $cache_data = array(
                'bar' => $bar,
                'hotlist' => $hotlist,
                'near' => $near,
                'nav_hide' => $nav_hide,
                'nav' => $nav,
                'sliders' => $sliders,
                'list' => $list,
            );
            __writetocache($key, $cache_data);
        }
        extract($cache_data);



        $navtitle = $title = $config['title'] ? $config['title'] : x1l('home', 0);



        if(checkmobile()){
            if(IN___WECHAT){
                $timestamp = time();
                $noncestr = uniqid('wx');
                $cururl = xg_get_url();
                $signature = __get_access_token($noncestr, $cururl, $timestamp);
            }

            include_once DISCUZ_ROOT . 'source/plugin/xigua_114/template/index.php';
        }else{
            if(!in_array($config['filter1'], array('city', 'dist'))){
                $config['filter1'] = 'dist';
            }

            include DISCUZ_ROOT.'./source/plugin/wechat/wechat.lib.class.php';
            include DISCUZ_ROOT.'source/plugin/mobile/qrcode.class.php';

                /*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
                $pid = intval($_GET['pid']);
                $where = '';
                if($pid){
                    $subcats[] = $pid;
                    foreach(C::t('#xigua_114#plugin_xigua114_cat')->get_childs_by_pids(array($pid)) as $v){
                        if($v['id']){
                            $subcats[] = intval($v['id']);
                        }
                    }
                    if($subcats){
                        $where .= ' AND catid IN('. implode(',', $subcats) .')';
                    }
                }
                if($city = dhtmlspecialchars($_GET['city'])){
                    $quotecity = DB::quote($city);
                    $where .= " AND $config[filter1]=$quotecity";
                }
                if($vip = $_GET['vip']){
                    $where .= ' AND `v`=1';
                }
                if($pt = $_GET['pt']){
                    if(!in_array($pt, array('hot', 'new', 'hui'))){
                        $pt = 'hot';
                    }
                    $where .= " AND `pt`='$pt'";
                }

                if('new' == $_GET['order']){
                    $order = $_GET['order'];
                    $order_string = '`crts` ASC';
                }
                /*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

                /*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
                $dists = C::t('#xigua_114#plugin_xigua114')->fetch_city_dist($config['filter1']);
                /*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

                $allcat = C::t('#xigua_114#plugin_xigua114_cat')->list_all(1, true);

                if($_GET['formhash'] == FORMHASH && submitcheck('phonename', 1)){
                    $phonename = trim($_GET['phonename']);
                    $company_list = C::t('#xigua_114#plugin_xigua114')->fetch_all_by_search($start_limit, $lpp, $phonename);
                }else{
                    $company_list = C::t('#xigua_114#plugin_xigua114')->fetch_all_by_page($start_limit, $lpp, 0, 0, $where, $order_string);
                }

                $digest = $listinfo = array();
                foreach ($company_list as $company) {
                    $company['link'] = 'plugin.php?id=xigua_114&mobile=no&ac=profile&company='.$company['id'];
                    $company['logo'] = $company['logo'] ? $company['logo'] : 'source/plugin/xigua_114/static/nologo.png';
                    $company['logo'] = get_picurl($company['logo']);
                    $company['qr']   = get_picurl($company['qr']);
                    $company['cover'] = get_picurl($company['cover']);
                    $company['catname'] = $allcat[$company['catid']]['name'];
                    $company['display'] = $company['city'].$company['dist'].$company['address'] ? $company['city'].$company['dist'].$company['address'] : cutstr($company['company_desc'], 56);
                    if($company['pt'] == 'hot'){
                        $company['pt_string'] = '<i style="background:#FF4E00;">'.x1l('mainhot', 0).'</i>';
                    } else if($company['pt'] == 'new'){
                        $company['pt_string'] = '<i style="background:#52AF27;">'.x1l('mainnew', 0).'</i>';
                    } else if($company['pt'] == 'hui'){
                        $company['pt_string'] = '<i style="background:#feaa2c;">' .x1l('mainhui', 0).'</i>';
                    }else{
                        $company['pt_string'] = '';
                    }
                    $company['v'] = $company['v'] ? '<img src="source/plugin/xigua_114/static/r2.png" class="rstblock-logo-passicon">' : '';

                    if($company['digest'] == 1){
                        $digest[] = $company;
                    }else{
                        $listinfo[] = $company;
                    }
                }
                $listinfo = array_merge($digest, $listinfo);
                $listinfo_output = '';
                foreach ($listinfo as $k => $v) {
                    $listinfo_output .= <<<HTML
<a href="javascript:void(0);" class="rstblock" title="$v[company_name]" onclick="rstblock($v[id])">
    <div class="rstblock-logo">
        <img src="$v[logo]" width="70" height="70" class="rstblock-logo-icon">
        <span>$v[catname]</span>
        $v[v]
    </div>
    <div class="rstblock-content">
        <div class="rstblock-title">$v[company_name]</div>
        <span class="rstblock-monthsales">$v[phone]</span>
        <div class="rstblock-cost">$v[display]</div>
        <div class="rstblock-activity">$v[pt_string]</div>
    </div>
</a>
HTML;
                }

                if($_GET['inajax']){
                    echo $listinfo_output;
                    exit;
                }

                $preview = $_G['siteurl'] .'plugin.php?id=xigua_114';
                $qrelative = 'source/plugin/xigua_114/static/index_qrcode_cache.png';
                $qrfile = DISCUZ_ROOT . $qrelative;
                if(!file_exists($qrfile)) {
                    QRcode::png($preview, $qrfile, QR_ECLEVEL_L, 3);
                }
                $qrurl = $_G['siteurl'] . $qrelative;

                $topnavslider = array();
                if($pic_string = $config['topnavslider']){
                    $top_pics = array_filter(explode("\n", $pic_string));
                    if(!empty($top_pics) && is_array($top_pics)){
                        foreach ($top_pics as $top_pic) {
                            $top_pic = str_replace(array(',', x1l('dot', 0)), ' ', trim($top_pic));
                            list( $src, $href) = explode(' ', $top_pic);
                            $src = trim($src);
                            $href = trim($href);
                            if(empty($href) || $href == '#'){
                                $href = 'javascript:void(0);';
                            }
                            if($src && $href)
                            {
                                $topnavslider[] = "<a  href='$href' ><img src='$src'/></a>";
                            }
                        }
                    }
                }
                if($customcolor = $config['customcolor']){
                    $customcolor = $customcolor . '!important';
                    $customcolor = <<<CUSTOM
<style>.place-tab-item.current {color:$customcolor;border-bottom-color:$customcolor}.excavator-filter-item.focuss {background-color:$customcolor}.excavator-sort .focuss{color:$customcolor}
.cahngecity{color:$customcolor}div.slideBox div.tips div.nums a.active{ background-color:$customcolor}.rstblock:hover .rstblock-title {color:$customcolor}</style>
CUSTOM;
                }
                if($config['topnavsliderwidth1'] || $config['topnavsliderwidth2']){
                    $customcolor .= "<style>div.slideBox ul.items li a img{width:".intval($config['topnavsliderwidth1'])."px!important;}.widthauto div.slideBox ul.items li a img{width:".intval($config['topnavsliderwidth2'])."px!important;}</style>";
                }

                include template('diy:index', 0, 'source/plugin/xigua_114/template/web');
        }
        break;
}
