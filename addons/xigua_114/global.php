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
function x1l($lang = '', $echo = 1)
{
    static $langs;
    $langs[$lang] = isset($langs[$lang]) ? $langs[$lang] : lang('plugin/xigua_114', $lang);
    if($echo){
        echo $langs[$lang];
        return TRUE;
    }else{
        return $langs[$lang];
    }
}

function aiconv2UTF8($string){
    if (is_array($string)) {
        foreach ($string as $key => $val) {
            $string[ $key ] = aiconv2UTF8($val);
        }
    } else {
        $string = diconv($string, CHARSET, 'UTF-8');
    }
    return $string;
}

function ___get_real_charset($string){
    $bm = array('ASCII', 'GBK', 'UTF-8', 'BIG5');
    foreach($bm as $c){
        if( $string === iconv('UTF-8', $c.'//IGNORE', iconv($c, 'UTF-8//IGNORE', $string))){
            return $c;
        }
    }
    return null;
}

function ___aiconv2($string, $in_charset, $out_charset){
    if (is_array($string)) {
        foreach ($string as $key => $val) {
            $string[ $key ] = ___aiconv2($val, $in_charset, $out_charset);
        }
    } else {
        $string = diconv($string, $in_charset, $out_charset);
    }
    return $string;
}

function ___get_real_input($data, $out_charset = CHARSET){
    $in_charset = ___get_real_charset(serialize($data));
    $out_charset = strtoupper($out_charset);

    if($in_charset && $in_charset != $out_charset && $out_charset != 'UTF-8'){
        $data = ___aiconv2($data, $in_charset, $out_charset);
    }
    return $data;
}

function upload_114($file_data, $imgtype = array('.jpg', '.jpeg', '.png', '.gif','.JPG', '.JPEG', '.PNG', '.GIF'), $dir = 'source/plugin/xigua_114/upload/')
{
    $errors = array(
        UPLOAD_ERR_OK         => x1l('UPLOAD_ERR_OK',        0),
        UPLOAD_ERR_INI_SIZE   => x1l('UPLOAD_ERR_INI_SIZE',  0),
        UPLOAD_ERR_FORM_SIZE  => x1l('UPLOAD_ERR_FORM_SIZE', 0),
        UPLOAD_ERR_PARTIAL    => x1l('UPLOAD_ERR_PARTIAL',   0),
        UPLOAD_ERR_NO_FILE    => x1l('UPLOAD_ERR_NO_FILE',   0),
        UPLOAD_ERR_NO_TMP_DIR => x1l('UPLOAD_ERR_NO_TMP_DIR',0),
        UPLOAD_ERR_CANT_WRITE => x1l('UPLOAD_ERR_CANT_WRITE',0),
        99                    => x1l('ONLY_IMAGE_ALLOW',     0),
    );
    $error = $file_data['error'];
    if($error != UPLOAD_ERR_OK){
        return array(
            'errno' => $error,
            'error' => $errors[$error]
        );
    }

    $type = '.'.addslashes(strtolower(substr(strrchr($file_data['name'], '.'), 1, 10)));
    $t = array_search($type, $imgtype);
    $filetype = $imgtype[$t];
    $file_data['type'] = strtolower($file_data['type']);
    if($t === false || ! $filetype ||!in_array(strtolower($file_data['type']), array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'))) {
        return array(
            'errno' => 99,
            'error' => $errors[99]
        );
    }

    dmkdir($dir);
    $file_attach = $dir. uniqid('gg').mt_rand(0,9999) . $filetype;
    $saved_file = DISCUZ_ROOT . $file_attach;
    $dst_saved_file = DISCUZ_ROOT . $file_attach.$type;
    $dst_file_attach = $file_attach.$type;

    if(is_uploaded_file($file_data['tmp_name']))
    {
        if(
            @copy($file_data['tmp_name'], $saved_file) ||
            @move_uploaded_file($file_data['tmp_name'], $saved_file)
        ){
            @unlink($file_data['tmp_name']);

            $r = resizeImage($saved_file, 1000, 1000, $dst_saved_file, $file_data['type']);
            return array(
                'errno' => 0,
                'error' => ($r ? $dst_file_attach : $file_attach)
            );
        }else{
            return array(
                'errno' => UPLOAD_ERR_CANT_WRITE,
                'error' => $errors[UPLOAD_ERR_CANT_WRITE]
            );
        }
    }
    return array(
        'errno' => UPLOAD_ERR_NO_FILE,
        'error' => $errors[UPLOAD_ERR_NO_FILE]
    );
}

function upload_114s($file_data, $imgtype = array('.jpg', '.jpeg', '.png', '.gif','.JPG', '.JPEG', '.PNG', '.GIF'), $dir = 'source/plugin/xigua_114/static/cat/')
{
    $ret = $data = array();
    foreach ($file_data['error'] as $k => $error) {
        $data[$k]['name']     = $file_data['name'][$k];
        $data[$k]['type']     = $file_data['type'][$k];
        $data[$k]['tmp_name'] = $file_data['tmp_name'][$k];
        $data[$k]['error']    = $file_data['error'][$k];
        $data[$k]['size']     = $file_data['size'][$k];
    }
    foreach ($data as $k => $row) {
        $ret[$k] = upload_114($row, $imgtype, $dir);
    }
    return $ret;
}

function __writetocache($key = 'table_plugin_xigua114_cat', $array = array())
{
    $datas = $array;
    $cachedata = " return " . var_export($datas, TRUE) . ";";

    global $_G;

    $dir = DISCUZ_ROOT . "./data/sysdata/";
    if (!is_dir($dir)) {
        dmkdir($dir, 0777);
    }
    $file = "$dir/$key.php";
    if ($fp = @fopen($file, 'wb')) {
        fwrite($fp, "<?php\n//Discuz! cache file, DO NOT modify me!\n//Identify: " . md5($key . '.php' . $cachedata . $_G['config']['security']['authkey']) . "\n\n$cachedata?>");
        fclose($fp);
    } else {
        exit('Can not write to cache files, please check directory ./data/ and ./data/sysdata/ .');
    }
}

function __readfromcache($key = 'table_plugin_xigua114_cat')
{
    $ret = array();

    $file = DISCUZ_ROOT . "./data/sysdata/$key.php";
    if (is_file($file)) {
        $ret = include $file;
    }

    return $ret;
}

function __deletefromcache($key = 'table_plugin_xigua114_cat')
{
    $cache_file = DISCUZ_ROOT . "./data/sysdata/$key.php";
    if(is_file($cache_file)){
        @unlink($cache_file);
    }
    return TRUE;
}

function in_wechat(){
    if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
        return true;
    }
    return false;
}


function format_company_list($company, $rank = 0){
    global $cin;
    $callhtml_class = $callhtml = '';
    if($cin){
        $callhtml = '<a href="tel:'.$company['phone'].'" class="compnay-icon-r">
    <div class="circle circle-dgreen"><i class="icon-phone"></i></div>
</a>';
    }else{
        $callhtml_class = 'class="company-link-only"';
    }

    if($_GET['needgeo']){
        $callhtml = '<div style="position: absolute;right: 0;top: 10px;color:#999">'.$company['distance'].'</div>';
    }

    if($company['pt']){
        $pt = '<i class="main-hot">'.x1l('main'.$company['pt'], 0).'</i>';
    }else{
        $pt = '';
    }
    if($company['v']){
        $vip = '<i class="vip"></i>';
    }else{
        $vip = '';
    }

    if($rank){
        $addrank = "<div class=\"rank ".($rank<=5?'rank'.$rank:'rankn')."\">$rank</div>";
    }else{
        $addrank = '';
    }

    return <<<HTML
<li>
<a href="$company[link]" $callhtml_class>$addrank
    <div class="compnay-icon"><img src="$company[logo]"> $vip</div>
    <div class="company-title">$company[company_name]$pt</div>
    <div class="company-desc">{$company['city']}{$company['dist']}{$company['address']}</div>
</a>
$callhtml
</li>
HTML;
}

function __get_access_token($noncestr, $acurl, $timestamp)
{
    global $config;
    if(empty($config['appid']) || empty($config['appsecret'])){
        return '';
    }
    $key = 'xigua_114_access_token';
    if(! $ret = readfromcache_expire($key)){
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$config['appid'].'&secret='.$config['appsecret'];
        $ret = dfsockopen($url);
        $ret = json_decode($ret, TRUE);
        writetocache_expire($key, $ret, $ret['expires_in']);
    }
    $access_token = $ret['access_token'];

    $key = 'xigua_114_jsapi_ticket';
    if(! $ret = readfromcache_expire($key)) {
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$access_token&type=jsapi";
        $ret = dfsockopen($url);

        $ret = json_decode($ret, TRUE);
        if($ret['errcode'] == 0){
            writetocache_expire($key, $ret, $ret['expires_in']);
        }
    }
    $string1 = "jsapi_ticket=$ret[ticket]&noncestr=$noncestr&timestamp=$timestamp&url=$acurl";

    $signature = sha1( $string1 );
    return $signature;
}

function writetocache_expire($script, $array = array(), $expirein = 7200)
{
    $expirein = $expirein - 100;
    $datas = array(
        'expireat' => time()+$expirein,
        'data'     => $array
    );
    $cachedata = " return ".var_export($datas, true).";";

    global $_G;

    $dir = DISCUZ_ROOT.'./data/sysdata/';
    if(!is_dir($dir)) {
        dmkdir($dir, 0777);
    }
    if($fp = @fopen("$dir$script.php", 'wb')) {
        fwrite($fp, "<?php\n//Discuz! cache file, DO NOT modify me!\n//Identify: ".md5($script.'.php'.$cachedata.$_G['config']['security']['authkey'])."\n\n$cachedata?>");
        fclose($fp);
    } else {
        exit('Can not write to cache files, please check directory ./data/ and ./data/sysdata/ and ./data/sysdata/xigua_beauty_cache/ .');
    }
}

function readfromcache_expire($script)
{
    $dir = DISCUZ_ROOT.'./data/sysdata/';
    if(!is_dir($dir)) {
        dmkdir($dir, 0777);
    }

    $ret = array();

    if(is_file("$dir$script.php")){
        $rets =  include "$dir$script.php";
        $ret = $rets['data'];
        if(time()>= $rets['expireat'] )
        {
            $ret = array();
        }
    }
    return $ret;
}
/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
function is_picurl($pic){
    return in_array(strtolower(substr($pic, 0, 6)), array('http:/', 'https:', 'ftp://'));
}

/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
function get_picurl($pic){
    if(strpos($pic, "\t") !== false){
        return $pic;
    }
    if(!$pic || in_array($pic, array('http://', 'https://', 'ftp://'))){
        return '';
    }
    global $_G;
    if(is_picurl($pic)){
        return $pic;
    }else{
        return rtrim($_G['siteurl'], '/').'/' . $pic;
    }
}

/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */
function xg_get_url($related = 0) {
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
    return $related ? $relate_url : $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}

function xg_replace_url($search = '', $replace = '', $unset = array('formhash', 'phonename')){
    $url = xg_get_url();
    $arr = parse_url($url);
    $query = $arr['query'] ? $arr['query']: '';

    parse_str($query, $output);
    if($search){
        if(!$replace){
            unset($output[$search]);
        }else{
            $output[$search] = $replace;
        }
    }
    if($unset){
        foreach ($unset as $v) {
            unset($output[$v]);
        }
    }

    return $arr['scheme'].'://'.$arr['host'].$arr['path'].'?'.http_build_query($output);
}

function resizeImage($fromfile ,$maxwidth,$maxheight, $name, $filetype)
{
    if(!function_exists('imagejpeg')){
        return false;
    }

    $imagefunc = 'imagejpeg';
    $imagecreatefromfunc = 'imagecreatefromjpeg';
    switch($filetype) {
        case 'image/jpeg':
            $imagecreatefromfunc = function_exists('imagecreatefromjpeg') ? 'imagecreatefromjpeg' : '';
            $imagefunc = function_exists('imagejpeg') ? 'imagejpeg' : '';
            break;
        case 'image/gif':
            $imagecreatefromfunc = function_exists('imagecreatefromgif') ? 'imagecreatefromgif' : '';
            $imagefunc = function_exists('imagegif') ? 'imagegif' : '';
            break;
        case 'image/png':
            $imagecreatefromfunc = function_exists('imagecreatefrompng') ? 'imagecreatefrompng' : '';
            $imagefunc = function_exists('imagepng') ? 'imagepng' : '';
            break;
    }

    $im = $imagecreatefromfunc($fromfile);
    $pic_width = imagesx($im);
    $pic_height = imagesy($im);

    if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight))
    {
        if($maxwidth && $pic_width>$maxwidth)
        {
            $widthratio = $maxwidth/$pic_width;
            $resizewidth_tag = true;
        }
        if($maxheight && $pic_height>$maxheight)
        {
            $heightratio = $maxheight/$pic_height;
            $resizeheight_tag = true;
        }
        if($resizewidth_tag && $resizeheight_tag)
        {
            if($widthratio<$heightratio)
                $ratio = $widthratio;
            else
                $ratio = $heightratio;
        }
        if($resizewidth_tag && !$resizeheight_tag)
            $ratio = $widthratio;
        if($resizeheight_tag && !$resizewidth_tag)
            $ratio = $heightratio;
        $newwidth = $pic_width * $ratio;
        $newheight = $pic_height * $ratio;
        if(function_exists("imagecopyresampled"))
        {
            $newim = imagecreatetruecolor($newwidth,$newheight);
            imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
        }
        else
        {
            $newim = imagecreate($newwidth,$newheight);
            imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
        }

        $imagefunc($newim, $name);
        imagedestroy($newim);
    }
    else
    {
        $imagefunc($im,$name);
    }
    @unlink($fromfile);
    return $name;
}

function get114Distance($lat1, $lng1, $lat2, $lng2)
{

    $calculatedDistance = acos(cos(($lng1 - $lng2) * 0.01745329252) * cos(($lat1 - $lat2) * 0.01745329252)) * 6371004;


    return round($calculatedDistance, 2);
}