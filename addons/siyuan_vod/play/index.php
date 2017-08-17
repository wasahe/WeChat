<?php
// +----------------------------------------------------------------------
// | PlayM3u8 播放器配置文件
// +----------------------------------------------------------------------
// | 本播放器采用的全部是m3u8模式播放支持PC端和手机端
// +----------------------------------------------------------------------
// | Licensed ( http://www.playm3u8com/ )
// +----------------------------------------------------------------------
// | Author: QQ:2621633663 <admin@playm3u8.com>
// +----------------------------------------------------------------------

// 提示：此文件无需修改，以免导致出错。
error_reporting(0);
require_once 'config.php';
$Locat = false; $error = false; $ext = Null;
$hd    = isset($_GET['hd']) ? addslashes($_GET['hd']) : play_hd;
$vid   = isset($_GET['vid']) ? addslashes($_GET['vid']) : "";
$url   = isset($_GET['url']) ? addslashes($_GET['url']) : "";
$type  = isset($_GET['type']) ? addslashes($_GET['type']) : "";
$mode  = isset($_GET['mode']) ? addslashes($_GET['mode']) : "";
$index = isset($_GET['index']) ? addslashes($_GET['index']) : 1;
$refee = isset($_SERVER["HTTP_REFERER"]) ? addslashes($_SERVER["HTTP_REFERER"]) : '';
$swf_path = strstr(host_path(),'index.php')? strzuo(host_path(),'index.php') : host_path();
$auth_domain[count($auth_domain)] = (empty($_SERVER['HTTP_HOST'])? "" : $_SERVER['HTTP_HOST']);
$USER_AGENT = isset($_SERVER['HTTP_USER_AGENT']) ? addslashes($_SERVER['HTTP_USER_AGENT']) : '';
$ctype = ((strstr($USER_AGENT,'MicroMessenger'))? 10 : 0);
$refee = parse_url($refee);
if(!empty($refee['host'])){
	if(!in_array($refee['host'], $auth_domain)){
		$error   = true;
		$Locat   = true;
		$message = '播放器被盗用';
	}
}else{
	if(!$debug){
		$error   = true;
		$Locat   = false;
		$message = '播放器禁止在浏览器直接打开';
	}
}

function playm3u8($host, $data, $index = 0){
	$json = json_decode(juhecurl($host.'/api?'.merge_string($data)),true);
	if($json['code'] == 405){
		// 切换为VIP视频解析
		$data['type'] = $json['source'].'_vip';
		$json = json_decode(juhecurl($host.'/api?'.merge_string($data)),true);
	}elseif($json['code'] == 406){
		// 切换为普通视频解析
		$data['type'] = strzuo($json['source'],'_vip');
		$json = json_decode(juhecurl($host.'/api?'.merge_string($data)),true);
	}elseif($json['code'] == 407){
		// 切换视频解析
		$data['url'] = "";
		$data['type'] = $json['result']['to'];
		$data['vid'] = $json['result']['vid'];
		$json = json_decode(juhecurl($host.'/api?'.merge_string($data)),true);
	}

	if($json){
		if($json['code'] != 200){
			return array(
				'error'    => true,
				'play_url' => '',
				'message'  => $json['message'],
			);
		}else{
			if($json['source'] == 'magnet' || $json['source'] == 'y115'){
				if(!is_ssl()){
					return array(
						'error'    => true,
						'play_url' => '',
						'message'  => '啊噢~['.$json['source'].']云播请配合(https)ssl证书使用',
					);
				}
			}
			$ext = $json['result']['play_type'];
			if($json['result']['filelist']){
				if($data['mode'] == 'pc'){
					ec_xml($json['result']['filelist']);
				}
				if($index == 0) $index = 1;
				if($json['source'] == 'magnet'){
					$play_url = $json['result']['filelist'][$index-1]['url'];
					if(empty($play_url)){
						return array(
							'error'    => true,
							'play_url' => '',
							'message'  => '啊噢~没有找到播放文件',
						);
					}else{
						return array(
							'error'     => false,
							'ext'       => $ext,
							'play_url'  => $play_url,
							'html_play' => (empty($json['result']['filelist'][$index-1]['html_play'])? '' : $json['result']['filelist'][$index-1]['html_play']),
							'message'   => '',
						);
					}
				}
			}else{
				return array(
					'error'     => false,
					'ext'       => $ext,
					'play_url'  => $json['result']['files'],
					'html_play' => (empty($json['result']['html_play'])? '' : $json['result']['html_play']),
					'message'   => '',
				);
			}
		}
	}else{
		return array(
			'error'    => true,
			'play_url' => '',
			'message'  => '啊噢~解析服务器故障,请刷新页面重试',
	    );
	}
}

function is_mobile(){
    static $a;
    if (isset($a)) {
    } elseif (empty($_SERVER['HTTP_USER_AGENT'])) {
        $a = false;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false) {
        $a = true;
    } else {
        $a = false;
    }
    return $a;
}

function p($data){
    echo "<pre>";
    print_r($data); die;
}

function ec_xml($data){
	header("Content-Type: text/xml");
	$xml .= '<?xml version="1.0" encoding="utf-8"?>'.chr(13);
	$xml .= '<ckplayer>'.chr(13);
	$xml .= '<flashvars>{h->2}</flashvars>'.chr(13);
	foreach ($data as $v) {
		$xml .= '<video>'.chr(13);
		$xml .= '<file><![CDATA['.$v['url'].']]></file>'.chr(13);
		$xml .= '</video>'.chr(13);
	}
	$xml .= '</ckplayer>'.chr(13);
	exit($xml);
}

function juhecurl($url,$params=false,$ispost=0){
    $httpInfo = array();
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
    curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
    curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
	$headers = array(
		'X-Forwarded-For: '.$_SERVER['REMOTE_ADDR'], 
		'Client-IP: '.$_SERVER['REMOTE_ADDR'],
	);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    if (substr($url, 0, 5) == 'https'); {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    if( $ispost ) {
        curl_setopt( $ch , CURLOPT_POST , true );
        curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
        curl_setopt( $ch , CURLOPT_URL , $url );
    } else{
        if($params){
            curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
        }else{
            curl_setopt( $ch , CURLOPT_URL , $url);
        }
    }
    $response = curl_exec( $ch );
    if ($response === FALSE) {
        return false;
    }
    $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
    $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
    curl_close( $ch );
    return $response;
}

function is_ssl() {
    if(isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))){
        return true;
    }elseif(isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'] )) {
        return true;
    }elseif(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && ('https' == $_SERVER['HTTP_X_FORWARDED_PROTO'])){
    	return true;
    }
    return false;
}

function current_url() {
    static $url;
    if (empty($url)) {
        $url = is_ssl() ? 'https://' : 'http://';
        $url .= $_SERVER['HTTP_HOST'];
        $url .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : (isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/');
        $url = parse_url($url);
        $url['query'] = empty($url['query']) ? Array() : parse_string($url['query']);
        $url['query'] = merge_string($url['query']);
        $url = merge_url($url);
    }
    return $url;
}

function parse_string($s) {
    if (is_array($s)) {
        return $s;
    }
    parse_str($s, $r);
    return $r;
}

function merge_string($a) {
    if (!is_array($a) && !is_object($a)) {
        return (string) $a;
    }
    return http_build_query(to_array($a));
}

function merge_url($parse = array()) {
    $url = '';
    if (isset($parse['scheme'])) {
        $url .= $parse['scheme'] . '://';
    }
    if (isset($parse['user'])) {
        $url .= $parse['user'];
    }
    if (isset($parse['pass'])) {
        $url .= ':' . $parse['pass'];
    }
    if (isset($parse['user']) || isset($parse['pass'])) {
        $url .= '@';
    }
    if (isset($parse['host'])) {
        $url .= $parse['host'];
    }
    if (isset($parse['port'])) {
        $url .= ':'. $parse['port'];
    }
    if (isset($parse['path'])) {
        $url .= $parse['path'];
    } else {
        $url .= '/';
    }
    if (isset($parse['query']) && $parse['query'] !== '') {
        $url .= '?'. $parse['query'];
    }

    if (isset($parse['fragment'])) {
        $url .= '#'. $parse['fragment'];
    }
    return $url;
}

function to_array($a) {
    $a = (array) $a;
    foreach ($a as &$v) {
        if (is_array($v) || is_object($v)) {
            $v = to_array($v);
        }
    }
    return $a;
}

function host_path(){
    @list($hosturl, $end) = explode('?', $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]);
    return (is_ssl()?'https://':'http://').$hosturl;
}

function strzuo( $str , $zuo ){
    $wz = strpos( $str , $zuo);
    if(empty($wz)){
        return null;
    }
    if ( !$text = substr( $str , 0 , $wz )){
        return null;
    }else{
        return $text;
    }
}
$count = 0;
if(!$error){
	if(!empty($type)) $data['type'] = $type;
	if(!empty($vid)){
		$data['vid'] = $vid;
		$data['type'] = $type;
	}elseif(!empty($url)){
		if(empty($data['type'])){
			if(strstr($url,'cctv.com')){
				$data['type'] = 'cntv';
			}elseif(strstr($url,'agnet:?xt=urn:')){
				$data['type'] = 'magnet';
			}elseif(strstr($url,'www.tudou.com')){
				$data['type'] = 'tudou';
			}elseif(strstr($url,'www.iqiyi.com')){
				$data['type'] = 'iqiyi';
			}elseif(strstr($url,'v.youku.com')){
				$data['type'] = 'youku';
			}elseif(strstr($url,'v.pptvyun.com')){
				$data['type'] = 'pptvyun';
			}elseif(strstr($url,'.m3u8')){
				$data['type'] = 'playm3u8';
			}elseif(strstr($url,'www.acfun.tv')){
				$data['type'] = 'acfun';
			}elseif(strstr($url,'qq.com')){
				$data['type'] = 'qq';
			}
		}
		$data['url'] = $url;
	}
	$data['hd'] = $hd;
	$data['ct'] = $ctype;
	$data['apikey'] = apikey;
	if($data['type'] == 'y115'){
		$data['y115_cookie'] = base64_encode($y115_data['y115_cookie']);
	}
	$play  = array();
	$play_mode = array();
	if(!is_mobile()){ 
		$data['iframe'] = '1';
		$play_mode = json_decode(juhecurl(api_host.'/player_mode'),true);
	}
	if(in_array($data['type'],$play_mode)){
		if($mode == 'ckplay'){
			$data['mode'] = 'pc';
			playm3u8(api_host,$data,$index);
		}else{
			$count = 2;
			$play_url = current_url().'&mode=ckplay';
		}
	}else{
		$data['mode'] = 'iphone';
		$play = playm3u8(api_host,$data,$index);
		if(!$play['error']){
			$ext       = $play['ext'];
			$play_url  = $play['play_url'];
			$html_play = $play['html_play'];
		}else{
			$error = $play['error'];
			$message = $play['message'];
		}
	}
}?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo play_title?></title>
	<style type="text/css">body,html{background-color:black;padding: 0;margin: 0;width:100%;height:100%;}</style>
	<link rel="shortcut icon" href="extend/playm3u8.png">
	<script src="extend/layer/jquery.min.js"></script>
	<script src="extend/layer/layer.js"></script>
</head>
<body>
	<div id="a1" style="height:100%;position: relative;"></div>
	<script type="text/javascript" src="ckplayer/ckplayer.js" charset="utf-8"></script>
	<script type="text/javascript">
		layer.config({
		    extend: 'extend/layer.ext.js'
		});
		var html  = "";
		var ext   = "<?php echo $ext ?>";
		var type  = "<?php echo $data['type'] ?>";
		var error = "<?php echo $error ?>";
		var Locat = "<?php echo $Locat ?>";
		var refee = "<?php echo $refee['host'] ?>";
		var play_url = "<?php echo $play_url?>";
		var html_mp4 = '<?php echo $html_play?>';
		var Android  = navigator.userAgent.match(/Android/i) != null;
		var isiPad   = navigator.userAgent.match(/iPad|iPhone|Linux|Android|iPod/i) != null;
		if (error) {
		    if (Locat) {
		        window.location.href = "<?php echo gws_host ?>";
		    } else {
		        layer.alert("<?php echo $message ?>");
		    }
		} else {
		    if (refee == "") layer.alert('警告：当前播放器为调试状态，部署到网站请关闭调试。', {
		       area: ['420px']
		    });
			if (ext == 'm3u8') {
				var flashvars = {
					f: "<?php echo $swf_path;?>extend/swf/m3u8.swf",
					a: encodeURIComponent(play_url),
					c: 0,
					s: 4,
					p: '<?php echo Auto_play?>',
					lv: 0,
					e: 1,
				};
			}else if (ext == 'iframe') {
				var html = "<embed src='"+play_url+"' quality='high' width='100%' height='100%' align='middle' allowScriptAccess='always' allownetworking='all' allowfullscreen='true' type='application/x-shockwave-flash' wmode='window'></embed>";
				document.getElementById('a1').innerHTML = html;
			} else {
				var flashvars = {
					f: play_url,
					s: <?php echo $count;?>,
					p: '<?php echo Auto_play?>',
					c: 0,
					e: 1,
					h: 4,
				};
			}
			if(html == ''){
				var params = {
					bgcolor: '#FFF',
					allowFullScreen: true,
					allowScriptAccess: 'always',
					wmode: 'transparent'
				};
				if(type == 'magnet' || type == 'y115'){
					if (!Android) {
						var video=[play_url];
					}else{
						if(html_mp4 == ""){
							var video=[play_url];
							//layer.alert("啊哦！没有找到mp4类型视频，安卓端播放是需要mp4视频文件。");
						}else{
							var video=[html_mp4];
						}
					}
				}else{
					var video=[play_url];
				}
				var autoplay = '';	
				if('<?php echo Auto_play?>' == '1'){
					var autoplay = 'autoplay="autoplay"';			
				}
			    if (isiPad) {
			    	var html5 = '<video src="' + video[0] + '" controls="controls" '+autoplay+' width="100%" height="99%"></video>';
			        document.getElementById('a1').innerHTML = html5;
			    } else {
			        CKobject.embedSWF('ckplayer/ckplayer.swf', 'a1', 'ckplayer_a1', '100%', '100%', flashvars, params);
			    }
			}
		}
	</script>
</body>
</html>
