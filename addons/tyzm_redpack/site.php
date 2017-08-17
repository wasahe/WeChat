<?php



/**

* 红包管理

*

* @author tyzm

* @url http://tyzm.net/

*/



defined('IN_IA') or exit('Access Denied');
class Tyzm_redpackModuleSite extends WeModuleSite
{
    

    
    public function doMobileUrl()
    {
        global $_W, $_GPC;
        $url = $_GPC['url'];
        require(IA_ROOT . '/framework/library/qrcode/phpqrcode.php');
        $errorCorrectionLevel = "L";
        $matrixPointSize      = "5";
        QRcode::png($url, false, $errorCorrectionLevel, $matrixPointSize);
        exit();
    }
    
    
    public function payResult($params)
    {
        //一些业务代码
        //根据参数params中的result来判断支付是否成功
        
        if ($params['result'] == 'success' && $params['from'] == 'notify') {
            //此处会处理一些支付成功的业务代码
            pdo_update('tyzm_redpack_lists', array(
                'ispay' => '1'
            ), array(
                'tid' => $params['tid'],
                'openid' => $params['user']
            ));
            load()->classs('weixin.account');
            //sendTplNotice($touser, $tpl_id_short, $postdata, $url = '', $topcolor = '#FF683F');
            
            //file_put_contents(time()."payResult.txt",json_encode($params));
        }
        //因为支付完成通知有两种方式 notify，return,notify为后台通知,return为前台通知，需要给用户展示提示信息
        //return做为通知是不稳定的，用户很可能直接关闭页面，所以状态变更以notify为准
        //如果消息是用户直接返回（非通知），则提示一个付款成功
        
        if ($params['from'] == 'return') {
            $this->authorization();
            if ($params['result'] == 'success') {
                $url = murl('entry/module/Redpack', array(
                    'm' => 'tyzm_redpack',
                    'ty' => 'edit',
                    'tid' => $params['tid'],
                    'tokenkey' => base64_encode($params['user'])
                ));
                header("location: " . $_W['siteroot'] . '../../app/' . $url);
            } else {
                message("抱歉，支付失败，请刷新后再试！", 'referer', 'error');
            }
        }
    }
    public function IPlookup($ip)
    {
        global $_GPC, $_W;
        //地区start
        
        $apikey = $this->module['config']['baiduapikey'];
        
        $ch     = curl_init();
        $url    = 'http://apis.baidu.com/apistore/iplookupservice/iplookup?ip=' . $ip;
        $header = array(
            'apikey:' . $apikey
        );
        // 添加apikey到header
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行HTTP请求
        curl_setopt($ch, CURLOPT_URL, $url);
        $res = curl_exec($ch);
        $res = json_decode($res, TRUE);
        return ($res);
        
    }
    public function getSign($Obj, $key) //生成签名
    {
        foreach ($Obj as $k => $v) {
            $Parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        ksort($Parameters);
        
        $String = $this->formatBizQueryParaMap($Parameters, false);
        
        //echo '【string1】'.$String.'</br>';
        
        //签名步骤二：在string后加入KEY
        
        $String = $String . "&key=" . $key; // 商户后台设置的key
        
        //echo "【string2】".$String."</br>";
        
        //签名步骤三：MD5加密
        
        $String = md5($String);
        
        //echo "【string3】 ".$String."</br>";
        
        //签名步骤四：所有字符转为大写
        
        $result_ = strtoupper($String);
        
        //echo "【result】 ".$result_."</br>";
        
        return $result_;
        
    }
    
    /**
    
    *  作用：格式化参数，签名过程需要使用
    
    */
    
    public function formatBizQueryParaMap($paraMap, $urlencode)
    {
        
        $buff = "";
        
        ksort($paraMap);
        
        foreach ($paraMap as $k => $v) {
            
            if ($urlencode) {
                
                $v = urlencode($v);
                
            }
            
            $buff .= $k . "=" . $v . "&";
            
        }
        
        $reqPar;
        
        if (strlen($buff) > 0) {
            
            $reqPar = substr($buff, 0, strlen($buff) - 1);
            
        }
        
        return $reqPar;
        
    }
    
    /**
    
    *  作用：产生随机字符串，不长于32位
    
    */
    
    public function createNoncestr($length = 32)
    {
        
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        
        $str = "";
        
        for ($i = 0; $i < $length; $i++) {
            
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
            
        }
        
        return $str;
        
    }
    
    /**
    
    *  作用：array转xml
    
    */
    
    public function arrayToXml($arr)
    {
        
        $xml = "<xml>";
        
        foreach ($arr as $key => $val) {
            
            // if (is_numeric($val))
            
            if (0) {
                
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
                
            } else {
                
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
                
            }
            
        }
        
        $xml .= "</xml>";
        
        return $xml;
        
    }
    
    
    
    /**
    
    *  作用：将xml转为array
    
    */
    
    public function xmlToArray($xml)
    {
        
        //将XML转为array        
        
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        
        return $array_data;
        
    }
    
    
    
    public function wxHttpsRequestPem($vars, $url, $second = 30, $aHeader = array())
    {
        global $_W;
        $ch = curl_init();
        
        //超时时间
        
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        //这里设置代理，如果有的话
        
        //curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
        
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        
        curl_setopt($ch, CURLOPT_URL, $url);
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
        //以下两种方式需选择一种
        
        //第一种方法，cert 与 key 分别属于两个.pem文件
        
        //默认格式为PEM，可以注释
        
        curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
        
        curl_setopt($ch, CURLOPT_SSLCERT, MODULE_ROOT . '/redpackpem1104/' . $_W['uniacid'] . '/' . $this->module['config']['certkey'] . '/apiclient_cert.pem');
        
        //默认格式为PEM，可以注释
        
        curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
        curl_setopt($ch, CURLOPT_SSLKEY, MODULE_ROOT . '/redpackpem1104/' . $_W['uniacid'] . '/' . $this->module['config']['certkey'] . '/apiclient_key.pem');
        if (count($aHeader) >= 1) {
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
            
        }
        
        curl_setopt($ch, CURLOPT_POST, 1);
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        
        $data = curl_exec($ch);
        
        if ($data) {
            
            curl_close($ch);
            
            return $data;
            
        } else {
            $error = curl_errno($ch);
            return $error; //提交错误参数
            curl_close($ch);
            return false;
        }
        
    }
    
    public function upimages($serverid)
    {
        global $_W, $_GPC;
        load()->classs('weixin.account');
        $accObj       = new WeixinAccount();
        $access_token = $accObj->fetch_available_token();
        $url          = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$serverid";
        $ch           = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_NOBODY, 0); //只取body头
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $package  = curl_exec($ch);
        $httpinfo = curl_getinfo($ch);
        curl_close($ch);
        $fileInfo = array_merge(array(
            'header' => $httpinfo
        ), array(
            'body' => $package
        ));
        switch ($fileInfo['header']['content_type']) {
            case 'image/pjpeg':
            case 'image/jpeg':
                $extend = ".jpg";
                break;
            case 'image/gif':
                $extend = ".gif";
                break;
            case 'image/png':
                $extend = ".png";
                break;
        }
        $filename    = $this->createNoncestr(32) . date("YmdHis") . $extend;
        $uniacid     = intval($_W['uniacid']);
        $re_dir      = "images/{$uniacid}/redpack/" . date('Y/m/');
        $dir_name    = ATTACHMENT_ROOT . $re_dir;
        $filepath    = $dir_name . $filename;
        $filecontent = $fileInfo["body"];
        if (!is_dir($dir_name)) {
            $dir = mkdir($dir_name, 0777, true);
        }
        if (false !== $dir) {
            $local_file = fopen($filepath, 'w');
            if (false !== $local_file) {
                if (false !== fwrite($local_file, $filecontent)) {
                    fclose($local_file);
                    $imagesinfo = $re_dir . $filename;
                    return $imagesinfo;
                }
            } else {
                //message("图片上传失败，请联系管理员！","javascript:WeixinJSBridge.call('closeWindow');","error");
                return 0;
            }
        } else {
            //message("目录创建失败！","javascript:WeixinJSBridge.call('closeWindow');","error");
            return 4;
        }
        
        
    }
    
    public function makeRequest($url, $param, $httpMethod = 'GET')
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        
        if ($httpMethod == 'GET') {
            curl_setopt($oCurl, CURLOPT_URL, $url . "?" . http_build_query($param));
            curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        } else {
            curl_setopt($oCurl, CURLOPT_URL, $url);
            curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($oCurl, CURLOPT_POST, 1);
            curl_setopt($oCurl, CURLOPT_POSTFIELDS, http_build_query($param));
        }
        
        $sContent = curl_exec($oCurl);
        $aStatus  = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return FALSE;
        }
    }
    public function sendredpackt($openid, $redata, $id)
    {
        global $_W, $_GPC;
        $uniacid              = intval($_W['uniacid']);
        $_W['fans']['openid'] = $openid;
        
        if ($id == 0) { //正常发红包
            $lickylog = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_data') . " WHERE  aid = :aid AND uniacid = :uniacid AND re_openid=:openid AND isdel=0 ORDER BY `id` DESC", array(
                ':aid' => $redata['id'],
                ':uniacid' => $uniacid,
                ':openid' => $_W['fans']['openid']
            ));
        } else { //提现
            $redata   = array(
                'send_name' => $_W['uniaccount']['name'],
                'act_name' => "口令红包",
                'remark' => "自主提现",
                'wishing' => "恭喜发财，提现成功！"
            );
            $lickylog = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_data') . " WHERE id=:id AND uniacid = :uniacid AND re_openid=:openid AND isdel=0 AND gettype=3  ORDER BY `id` DESC", array(
                ':id' => $id,
                ':uniacid' => $uniacid,
                ':openid' => $_W['fans']['openid']
            ));
        }
        
        
        
        if (!empty($lickylog['tid'])) {
            
            if ($lickylog['result_code'] != 'SUCCESS') { //第一次执行发红包动作&&红包发送不成功时，再执行多次执行，后台可以看到错误结果
                //
                
                //执行发红包操作 start
                $setting = uni_setting($_W['uniacid'], array(
                    'payment'
                ));
                $wechat  = $setting['payment']['wechat'];
                if (!is_array($setting['payment'])) {
                    pdo_update('tyzm_redpack_data', array(
                        'return_msg' => "没有设定支付参数"
                    ), array(
                        'id' => $lickylog['id']
                    ));
                    exit;
                }
                
                $data['wxappid']      = $_W['account']['key'];
                $data['mch_id']       = $wechat['mchid'];
                $data['mch_billno']   = $lickylog['mch_billno'];
                $data['client_ip']    = $_W['clientip']; //获得服务器IP
                $data['re_openid']    = $_W['fans']['openid'];
                $data['total_amount'] = $lickylog['total_amount'];
                $data['send_name']    = $this->str_cut($redata['send_name'], 32, '');
                $data['act_name']     = $this->str_cut($redata['act_name'], 32, '');
                $data['remark']       = $this->str_cut($redata['remark'], 256, '');
                $data['wishing']      = $this->str_cut($redata['wishing'], 128, '');
                $data['total_num']    = 1;
                $data['nonce_str']    = $this->createNoncestr();
                $data['sign']         = $this->getSign($data, $wechat['apikey']);
                $xml                  = $this->arrayToXml($data);
                $url                  = "https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack";
                
                $re = $this->wxHttpsRequestPem($xml, $url);
                
                if ($re == 58) {
                    pdo_update('tyzm_redpack_data', array(
                        'return_msg' => "证书有问题"
                    ), array(
                        'id' => $lickylog['id']
                    ));
                    exit;
                }
                
                $data['createtime'] = TIMESTAMP;
                unset($data['mch_billno'], $data['nonce_str'], $data['send_name'], $data['act_name'], $data['remark'], $data['wishing'], $data['mch_id']); //删除多余数据
                $rearr = $this->xmlToArray($re);
                
                $rearr['return_data'] = json_encode($rearr);
                
                
                $totladata = array_merge($data, $rearr); //提交和返回值合并保存
                unset($totladata['amt_type']); //删除多余数据
                
                if (!empty($rearr['return_code'])) {
                    pdo_update('tyzm_redpack_data', $totladata, array(
                        'id' => $lickylog['id']
                    ));
                    if ($redata['number'] == $lickylog['order_num']) {
                        $redstatus['status'] = 2;
                        pdo_update('tyzm_redpack_lists', $redstatus, array(
                            'id' => $redata['id']
                        ));
                    }
                    
                    return "1";
                } else {
                    return "0";
                }
                //执行发红包操作 start 
            }
            
        }
    }
    public function authorization()
    {
       return 0; 
    }
    public function str_cut($string, $length, $dot = '', $charset = "utf-8")
    {
        $strlen = strlen($string);
        if ($strlen <= $length)
            return $string;
        $string = str_replace(array(
            ' ',
            '&nbsp;',
            '&amp;',
            '&quot;',
            '&#039;',
            '&ldquo;',
            '&rdquo;',
            '&mdash;',
            '&lt;',
            '&gt;',
            '&middot;',
            '&hellip;'
        ), array(
            '∵',
            ' ',
            '&',
            '"',
            "'",
            '“',
            '”',
            '—',
            '<',
            '>',
            '·',
            '…'
        ), $string);
        $strcut = '';
        if (strtolower($charset) == 'utf-8') {
            $length = intval($length - strlen($dot) - $length / 3);
            $n      = $tn = $noc = 0;
            while ($n < strlen($string)) {
                $t = ord($string[$n]);
                if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                    $tn = 1;
                    $n++;
                    $noc++;
                } elseif (194 <= $t && $t <= 223) {
                    $tn = 2;
                    $n += 2;
                    $noc += 2;
                } elseif (224 <= $t && $t <= 239) {
                    $tn = 3;
                    $n += 3;
                    $noc += 2;
                } elseif (240 <= $t && $t <= 247) {
                    $tn = 4;
                    $n += 4;
                    $noc += 2;
                } elseif (248 <= $t && $t <= 251) {
                    $tn = 5;
                    $n += 5;
                    $noc += 2;
                } elseif ($t == 252 || $t == 253) {
                    $tn = 6;
                    $n += 6;
                    $noc += 2;
                } else {
                    $n++;
                }
                if ($noc >= $length) {
                    break;
                }
            }
            if ($noc > $length) {
                $n -= $tn;
            }
            $strcut = substr($string, 0, $n);
            $strcut = str_replace(array(
                '∵',
                '&',
                '"',
                "'",
                '“',
                '”',
                '—',
                '<',
                '>',
                '·',
                '…'
            ), array(
                ' ',
                '&amp;',
                '&quot;',
                '&#039;',
                '&ldquo;',
                '&rdquo;',
                '&mdash;',
                '&lt;',
                '&gt;',
                '&middot;',
                '&hellip;'
            ), $strcut);
        } else {
            $dotlen      = strlen($dot);
            $maxi        = $length - $dotlen - 1;
            $current_str = '';
            $search_arr  = array(
                '&',
                ' ',
                '"',
                "'",
                '“',
                '”',
                '—',
                '<',
                '>',
                '·',
                '…',
                '∵'
            );
            $replace_arr = array(
                '&amp;',
                '&nbsp;',
                '&quot;',
                '&#039;',
                '&ldquo;',
                '&rdquo;',
                '&mdash;',
                '&lt;',
                '&gt;',
                '&middot;',
                '&hellip;',
                ' '
            );
            $search_flip = array_flip($search_arr);
            for ($i = 0; $i < $maxi; $i++) {
                $current_str = ord($string[$i]) > 127 ? $string[$i] . $string[++$i] : $string[$i];
                if (in_array($current_str, $search_arr)) {
                    $key         = $search_flip[$current_str];
                    $current_str = str_replace($search_arr[$key], $replace_arr[$key], $current_str);
                }
                $strcut .= $current_str;
            }
        }
        return $strcut . $dot;
    }
	
	
}

