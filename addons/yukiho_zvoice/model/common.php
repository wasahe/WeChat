<?php

/**
 * Created by yukiho_zvoice
 * User: yukihho
 * Date: 2016/12/18
 * Time: 14:43
 */
class common extends yukiho_zvoiceModuleSite
{

	function createWxImage($media_id,$dir){
	    global $_W,$_GPC;
		load()->classs('weixin.account');
		$accObj= new WeixinAccount();
		$access_token = $accObj->fetch_available_token();
		$upload_path = ATTACHMENT_ROOT . 'images' . '/'.$this->modulename.'/'.$dir.'/';
		$upload_file_name = time()."_".random(6).'.jpg';
		if (!is_dir($upload_path)) { 
			mkdir($upload_path, 0777);  
		}
		$targetName = $upload_path.$upload_file_name;
		$ch = curl_init("http://file.api.weixin.qq.com/cgi-bin/media/get?access_token={$access_token}&media_id={$media_id}");
		$fp = fopen($targetName, 'wb');

		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
		$base64 = 'data:image/jpeg;base64,'.base64_encode(file_get_contents($targetName));
		return $this->createImage($base64);
    }
	
	function tranTime($time) { 
		$rtime = date("m-d",$time); 
		$htime = date("H:i",$time);
		$time = time() - $time; 
	 
		if ($time < 60) { 
			$str = '刚刚'; 
		}elseif ($time < 60 * 60) { 
			$min = floor($time/60); 
			$str = $min.'分钟前'; 
		}elseif ($time < 60 * 60 * 24) { 
			$h = floor($time/(60*60)); 
			$str = $h.'小时前'; 
		}elseif ($time < 60 * 60 * 24 * 3) { 
			$d = floor($time/(60*60*24)); 
			if($d==1) 
			   $str = '昨天'; 
			else 
			   $str = '前天'; 
		}elseif ($time < 60 * 60 * 24 * 99) { 
			$h = floor($time/(60 * 60 * 24)); 
			$str = $h.'天前'; 
		}else { 
			$str = $rtime; 
		} 
		return $str; 
	} 
	
    public function mc_notice_init(){
        global $_W;
        if(empty($_W['account'])) {
            $_W['account'] = uni_fetch($_W['uniacid']);
        }
        if(empty($_W['account'])) {
            return error(-1, '创建公众号操作类失败');
        }
        $acc = WeAccount::create();
        if(is_null($acc)) {
            return error(-1, '创建公众号操作对象失败');
        }
        return $acc;
    }
    //先插入，异步转码！
    public function createAudioTest($table,$service_id){
        global $_W;
        $acc = $this->mc_notice_init();
        $token = $acc->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=".$token."&media_id=".$service_id;
        $key = M('qiniu')->fetch($url,$service_id.".amr");
        $re_url = $this->createMobileUrl('qiniu2mp3',array('service_id'=>$service_id));
        $re_url = str_replace('./','',$re_url);
        $re_url = $_W['siteroot'].'app/'.$re_url;
        $return = M('qiniu')->toMp3($key,$re_url);
        $item = M(''.$table)->getVoiceId($service_id);
        M(''.$table)->update($item);
        return $service_id;
    }
	
    public function createAudio($table,$id,$service_id=""){
        global $_W;
        $oauth_account = WeAccount::create($_W['account']['oauth']);
        $token = $oauth_account->getAccessToken();

        $url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=".$token."&media_id=".$service_id;
        //$url = "https://api.weixin.qq.com/cgi-bin/media/get/jssdk?access_token=".$token."&media_id=".$service_id;
        $key = M('qiniu')->fetch($url,$service_id.".amr");
        $re_url = $this->createMobileUrl('qiniu2mp3',array('id'=>$id,'table'=>$table,'redirect'=>'1'));
        $re_url = str_replace('./','',$re_url);
        $re_url = $_W['siteroot'].'app/'.$re_url;
        M('qiniu')->toMp3($key,$re_url);
    }
	
    public function createImage($image){
        load()->func('file');
        if(preg_match('/^(data:\s*image\/(\w+);base64,)/', $image, $result)){
            $type = $result[2];
            $name =time()."_".random(6).".".$type;
            $filename = "images/yukiho_zvoice/".date('Y/m/d')."/".$name;

            if(file_write($filename, base64_decode(str_replace($result[1],'',$image)))){
                if(M('qiniu')->check()){
                    $url = tomedia($filename);
                    $key = M('qiniu')->fetch($url,$name);
                    if(!empty($key)){
                        return M('qiniu')->getUrl($key);
                    }else{
                        return tomedia($filename);
                    }
                }else{
                    $return = tomedia($filename);
                }
            }
        }else{
            $return = tomedia($image);
        }
        return $return;
    }
    public function refund(){
        $url = 'https://api.mch.weixin.qq.com/secapi/pay/refund';
        $params = array();
        $params['appid'] = '';
        $params['mch_id'] = '';
        $params['out_trade_no'] = '';
        $params['out_refund_no'] = '';
        $params['total_fee'] = '';
        $params['refund_fee'] = '';
        $params['op_user_id'] = '';
        $params['nonce_str'] = '';
        $params['sign'] = '';

    }
    function mc_notice_consume2($openid, $title, $content, $url = '',$thumbs='') {
        global $_W;
        $acc = $this->mc_notice_init();
        $status = 0;
        if(is_error($acc)) {
            return error(-1, $acc['message']);
        }
        if($_W['account']['level'] == 4) {
            $status = mc_notice_public($openid, $title, $_W['account']['name'], $content);
            if(is_error($status)){
                $status = $this->mc_notice_custom_news($openid, $title, $content,$url,$thumbs);
            }
        }
        if($_W['account']['level'] == 3){
            $status = $this->mc_notice_custom_news($openid, $title, $content,$url,$thumbs);
        }
        return $status;
    }
    function mc_notice_custom_news($openid, $title, $content,$url,$thumb) {
        global $_W;
        $acc = $this->mc_notice_init();
        if(is_error($acc)) {
            return error(-1, $acc['message']);
        }
        $fans = pdo_fetch('SELECT salt,acid,openid FROM ' . tablename('mc_mapping_fans') . ' WHERE uniacid = :uniacid AND openid = :openid', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));

        $row = array();
        $row['title'] = urlencode($title);
        $row['description'] = urlencode($content);
        !empty($thumb) && ($row['picurl'] = tomedia($thumb));

        if(strexists($url, 'http://') || strexists($url, 'https://')) {
            $row['url'] = $url;
        } else {
            $pass['time'] = TIMESTAMP;
            $pass['acid'] = $fans['acid'];
            $pass['openid'] = $fans['openid'];
            $pass['hash'] = md5("{$fans['openid']}{$pass['time']}{$fans['salt']}{$_W['config']['setting']['authkey']}");
            $auth = base64_encode(json_encode($pass));
            $vars = array();
            $vars['__auth'] = $auth;
            if(empty($url)){
                $vars['forward'] = base64_encode($this->createMobileUrl('fans_home'));
            }else{
                $vars['forward'] = base64_encode($url);
            }


            $row['url'] =  $_W['siteroot'] . 'app/' . murl('auth/forward', $vars);
        }
        $news[] = $row;
        $send['touser'] = trim($openid);
        $send['msgtype'] = 'news';
        $send['news']['articles'] = $news;
        $status = $acc->sendCustomNotice($send);
        return $status;
    }
	
    function createTplMessage($openid, $title, $content, $url, $thumb) {
        global $_W;
		$pro = M('setting')->getSetting('pro');
        $acc = $this->mc_notice_init();
		$data = array();
		$data['first']['value'] = $title;
		$data['first']['color'] = '#173177';
		
		$data['keyword1']['value'] = $title;	
		$data['keynote1']['color'] = '#173177';	
		
		$data['keyword2']['value'] = $content;	
		$data['keynote2']['color'] = '#173177';	
		
		$data['keyword3']['value'] = date('Y-m-d H:i');	
		$data['keyword3']['color'] = '#173177';	
		
		$response = $acc->sendTplNotice(trim($openid), trim($pro['messageTplId']), $data, $url);
		
		if(is_error($response)){
			load()->func('logging');
			logging_run('数据发送失败===原因：'.$response['message'].'===时间：'.date('Y-m-d H:i').'===标题：'.$title.'===内容：'.$content);
		}
		
        return $status;
    }
    /**
     * 格式化开始时间
     * */
    public function format_start_time($created_at) {
        if (!is_numeric($created_at)) {
            $created_at = strtotime($created_at);
        }
        $seconds = $created_at - time();
        $minutes = floor($seconds / 60);
        $hours = floor($seconds / (60 * 60));
        $days = floor($seconds / (60 * 60 * 24));
        if ($seconds <= 0) {
            return "报名进行中";
        } else if ($seconds < 60 && $seconds > 0) {
            return "即将开始";
        } elseif ($seconds < 120) {
            return "1分钟后开始";
        } elseif ($minutes < 60) {
            return $minutes . "分钟后开始";
        } elseif ($minutes < 120) {
            return "1小时后开始";
        } elseif ($hours < 24) {
            return $hours . "小时后开始";
        } elseif ($hours < 24 * 2) {
            return "1天后开始";
        } elseif ($days < 30) {
            return $days . "天后开始";
        } elseif ($days < 365) {
            return floor($days / 30) . "个月后开始";
        } else {
            return date("YYYY年mm月dd日", $created_at);
        }
    }
    /**
     * 格式化结束时间
     * */

    public function format_end_time($created_at) {
        if (!is_numeric($created_at)) {
            $created_at = strtotime($created_at);
        }

        $seconds = $created_at - time();
        $minutes = floor($seconds / 60);
        $hours = floor($seconds / (60 * 60));
        $days = floor($seconds / (60 * 60 * 24));

        if ($seconds <= 0) {
            return "已经结束";
        } else if ($seconds < 60) {
            return "即将结束";
        } elseif ($seconds < 120) {
            return "1分钟后结束";
        } elseif ($minutes < 60) {
            return $minutes . "分钟后结束";
        } elseif ($minutes < 120) {
            return "1小时后结束";
        } elseif ($hours < 24) {
            return $hours . "小时后结束";
        } elseif ($hours < 24 * 2) {
            return "1天后结束";
        } elseif ($days < 30) {
            return $days . "天后结束";
        } elseif ($days < 365) {
            return floor($days / 30) . "个月后结束";
        } else {
            return floor($days / 365) . "年后截止";
        }
    }
    /**
     * 格式化创建时间
     * */
    public function format_create_time($created_at) {
        if (!is_numeric($created_at)) {
            $created_at = strtotime($created_at);
        }
        $seconds = time() - $created_at;
        $minutes = floor($seconds / 60);
        $hours = floor($seconds / (60 * 60));
        $days = floor($seconds / (60 * 60 * 24));
        if ($seconds < 60) {
            return "刚刚";
        } elseif ($seconds < 120) {
            return "1分钟前";
        } elseif ($minutes < 60) {
            return $minutes . "分钟前";
        } elseif ($minutes < 120) {
            return "1小时前";
        } elseif ($hours < 24) {
            return $hours . "小时前";
        } elseif ($hours < 24 * 2) {
            return "1天前";
        } elseif ($days < 30) {
            return $days . "天前";
        } elseif ($days < 365) {
            return floor($days / 30) . "个月前";
        } else {
            return date("YYYY年mm月dd日", $created_at);
        }
    }
}