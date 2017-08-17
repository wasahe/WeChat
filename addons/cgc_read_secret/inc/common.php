<?php
   
function send_template_message($data,$access_token){
		$url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token;
		load()->func('communication');
  	    $res=ihttp_request($url, $data);
	    
	    if (is_error($res)){
	      return array("code"=>"-4","msg"=>json_encode($res));
	    }
		
		$res=json_decode($res['content'],true);	
		
		if ($res['errcode'] == '0') {
			return array("code"=>"1","msg"=>json_encode($res));
		} else {
			return array("code"=>"-3","msg"=>json_encode($res));
		}
	
	 }

  //是否关注
  function sfgz_user($fromuser){
  	global $_W;
  	$uniacid=$_W['uniacid'];
   	$follow=pdo_fetchcolumn("SELECT follow FROM " . tablename('mc_mapping_fans').
          " where uniacid=$uniacid and openid='$fromuser'"); 
   	return $follow;
  }
  
  
 function getFromUserTest() 
{ 
  $obj=array("openid"=>"test1",
  "nickname"=>"test1","headimgurl"=>
  "http://wx.qlogo.cn/mmopen/bHACibrA8hAhnlNYETmRhdPTJiaKDCr7OvwoQ5y3oJKuDFD7iafDGWsmpVXCibjia30kc0bibkTU4xHKdrqXP1iaWkYxMmaOmFicHLza/0");
  return json_encode($obj);
}
 





	
//授权获取用户信息。	
 function getFromUser($settings,$modulename) 
{
  global $_W,$_GPC;	
/*  //调用系统的抓取用户。
  load()->model('mc');
  $userinfo    = mc_oauth_userinfo();
  return json_encode($userinfo);
  //下面代码先取消。
*/

  $uniacid = $_W['uniacid'];  
  if (!empty($_GPC['test'])){
  	 $userinfo= getFromUserTest();
  	 setcookie($modulename."_user_".$uniacid,$userinfo, time()+3600*(24*5));
     return $userinfo;
  }	
  
  if(empty($_COOKIE[$modulename."_user_".$uniacid])){
     $url = $_W['siteroot'] . "app/index.php?i=".$_W['uniacid']."&j=".$_W['acid']."&c=entry&m=$modulename&do=xoauth";
     $xoauthURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
     setcookie("xoauthURL",$xoauthURL, time()+3600*(24*5));
     $oauth2_code = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$settings['appid']."&redirect_uri=".urlencode($url)."&response_type=code&scope=snsapi_userinfo&state=0#wechat_redirect";
     header("location:$oauth2_code");
     exit;                  
  } else { 	
  	return $_COOKIE[$modulename."_user_".$uniacid];
  } 
}
 





   
    function get_wechat_user($param = array()) {     
      $uniacccount = WeAccount::create($param['acid']); 
   	  $userinfo=$uniacccount->fansQueryInfo($param['fromuser']);
      if (is_error($userinfo)){
   	    return array("code"=>-1,"msg"=>$userinfo['message']);
      }     
     return array("code"=>1,"user"=>$userinfo);
    }  	
    
    
   



  
 

 //现金红包接口
   function send_xjhb($settings,$fromUser,$amount,$desc) {
   	  $Hour = date('G'); 	
   
   	   $ret=array();
       $ret['code']=0;
       $ret['message']="success";     
       //return $ret;
      	$amount=$amount*100;
        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
        $pars = array();
        $pars['nonce_str'] = random(32);
        $pars['mch_billno'] =random(10). date('Ymd') . random(3);
        $pars['mch_id'] = $settings['mchid'];
        $pars['wxappid'] = $settings['appid'];
        $pars['nick_name'] =   $settings['send_name'];
        $pars['send_name'] = $settings['send_name'];
        $pars['re_openid'] = $fromUser;
        $pars['total_amount'] = $amount;
        $pars['min_value'] = $amount;
        $pars['max_value'] = $amount;
        $pars['total_num'] = 1;
        $pars['wishing'] = $desc;
        $pars['client_ip'] = $settings['ip'];
        $pars['act_name'] =  $settings['act_name'];
        $pars['remark'] = $settings['remark'];

        ksort($pars, SORT_STRING);
        $string1 = '';
        foreach($pars as $k => $v) {
            $string1 .= "{$k}={$v}&";
        }
        $string1 .= "key={$settings['password']}";
        $pars['sign'] = strtoupper(md5($string1));
        $xml = array2xml($pars);
        $extras = array();
       
        $extras['CURLOPT_CAINFO']= $settings['rootca'];
        $extras['CURLOPT_SSLCERT'] =$settings['apiclient_cert'];
        $extras['CURLOPT_SSLKEY'] =$settings['apiclient_key'];


        load()->func('communication');
        $procResult = null; 
        $resp = ihttp_request($url, $xml, $extras);
        if(is_error($resp)) {
            $procResult = $resp["message"];
            $ret['code']=-1;
            $ret['message']=$procResult;
            return $ret;     
        } else {
            $xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
            $dom = new DOMDocument();
             if($dom->loadXML($xml)) {
                $xpath = new DOMXPath($dom);
                $code = $xpath->evaluate('string(//xml/return_code)');
                $result = $xpath->evaluate('string(//xml/result_code)');
                if(strtolower($code) == 'success' && strtolower($result) == 'success') {
                    $ret['code']=0;
                    $ret['message']="success";
               
                    return $ret;
                  
                } else {
                    $error = $xpath->evaluate('string(//xml/err_code_des)');
                    $ret['code']=-2;
                    $ret['message']=$error;
                    return $ret;
                 }
            } else {
                $ret['code']=-3;
                $ret['message']="3error3";
                return $ret;
            }
            
        }

     
    }

  
  //企业付款接口
   function send_qyfk($settings,$fromUser,$amount){
    $ret=array();
    $amount=$amount*100;
    $ret['amount']=$amount;
    $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
    $pars = array();
    $pars['mch_appid'] =$settings['appid'];
    $pars['mchid'] = $settings['mchid'];
    $pars['nonce_str'] = random(32);
    $pars['partner_trade_no'] = random(10). date('Ymd') . random(3);
    $pars['openid'] =$fromUser;
    $pars['check_name'] = "NO_CHECK";
    $pars['amount'] =$amount;
    $pars['desc'] = $settings['pay_desc'];
    $pars['spbill_create_ip'] =$settings['ip']; 
    ksort($pars, SORT_STRING);
        $string1 = '';
        foreach($pars as $k => $v) {
            $string1 .= "{$k}={$v}&";
        }
        $string1 .= "key={$settings['password']}";
        $pars['sign'] = strtoupper(md5($string1));
        $xml = array2xml($pars);
        $extras = array();
        $extras['CURLOPT_CAINFO']= $settings['rootca'];
        $extras['CURLOPT_SSLCERT'] =$settings['apiclient_cert'];
        $extras['CURLOPT_SSLKEY'] =$settings['apiclient_key'];
 
     
        load()->func('communication');
        $procResult = null; 
        $resp = ihttp_request($url, $xml, $extras);
        if(is_error($resp)) {
            $procResult = $resp['message'];
            $ret['code']=-1;
            $ret['message']="-1:".$procResult;
            return $ret;            
         } else {        	
            $xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
            $dom = new DOMDocument();
            if($dom->loadXML($xml)) {
                $xpath = new DOMXPath($dom);
                $code = $xpath->evaluate('string(//xml/return_code)');
                $result = $xpath->evaluate('string(//xml/result_code)');
                if(strtolower($code) == 'success' && strtolower($result) == 'success') {
                    $ret['code']=0;
                    $ret['message']="success";
                    return $ret;
                  
                } else {
                    $error = $xpath->evaluate('string(//xml/err_code_des)');
                    $ret['code']=-2;
                    $ret['message']="-2:".$error;
                    return $ret;
                 }
            } else {
                $ret['code']=-3;
                $ret['message']="error response";
                return $ret;
            }
        }
    
   }


  
  //获得粉丝积分和金额
  function get_fans($obj){
  	load()->model('mc');
    $openid=$obj['openid'];  
    $uid=mc_openid2uid($openid);		
	return mc_fetch($openid); 
  }
  
  
  
  //增加粉丝积分
  function add_fans_score($obj){
  	load()->model('mc');
    $openid=$obj['openid'];  
    $uid=mc_openid2uid($openid);		
	mc_credit_update($uid,"credit1",$obj['credit1']); 
  }

//主动文本回复消息，48小时之内
 function post_send_text($openid,$content) {
	    global $_W;	
		//$weid = $_W['acid'];  
	    $acid=!empty($_W['acid'])?$_W['acid']:$_W['uniacid'];
        load()->classs('weixin.account');
        $accObj= WeixinAccount::create($acid);
        $token=$accObj->fetch_token();
        load()->func('communication');
		$data['touser'] =$openid;
		$data['msgtype'] = 'text';
		$data['text']['content'] = urlencode($content);
		$dat = json_encode($data);
		$dat = urldecode($dat);
		 //客服消息
			$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$token;			
			$ret=ihttp_post($url, $dat);
			$dat = $ret['content'];
			$result = @json_decode($dat, true);
			if ($result['errcode'] == '0') {				
				//message('发送消息成功！', referer(), 'success');
			} else {
			  load()->func('logging');
			  logging_run("post_send_text:");
			  logging_run($dat);
		      logging_run($result);
			}
			return $result;
			
}

//返回百度地址
//根据经纬度返回百度地址：http://api.map.baidu.com/geocoder/v2/?ak=qen1OGw9ddzoDQrTX35gote2&location=26.047125,119.330221&output=json
function getAddr($location){
	if (empty($location)){
       return false;
	}

	if (empty($location['x']) && empty($location['location_x'])){
       return false;
	}
    $loc="";
	if (!empty($location['location_x']) && !empty($location['location_y'])){
		$loc=$location['location_x'].",".$location['location_y'];
	}

	if (!empty($location['x']) && !empty($location['y'])){
       $loc=$location['x'].",".$location['y'];
    }

    if (empty($loc)){
      return false;
    }

    $url="http://api.map.baidu.com/geocoder/v2/?ak=qen1OGw9ddzoDQrTX35gote2&location=".$loc."&output=json";
 
    $ret=json_decode(file_get_contents($url),true);
 
    if ($ret['status']!=0) {
       WeUtility::logging("getAddr", "$url==>" . json_encode($ret)); 
      return false;
    }
  
    if (strpos($ret['result']['formatted_address'],$location['addr'])===false){
        WeUtility::logging("getAddr", "error==>" . json_encode($location)); 
      return false;
    } else {
      return true;
    }

}

/**
 * 根据微擎url获取siteroot
 * @param unknown_type $url
 * @return string
 */
function getSiteRoot($url){
	$arr = array('/web', '/app', '/payment/wechat', '/payment/alipay', '/api','/addons');
	foreach ($arr as $value) {
		$length = strpos($url, $value);
		if($length){
			$url = substr($url, 0, $length);
			break;
		}
	}
	return $url;
}




