<?php


defined('IN_IA') or exit('Access Denied');

global $_W, $_GPC;

$rid = intval($_GPC['rid']);

$weid = intval($_W['weid']);

$uniacid = intval($_W['uniacid']);

$userinfo = mc_oauth_userinfo();
$config   = $this->module['config'];
if (empty($userinfo)) {
    
    message("抱歉，微信红包仅能在微信中打开！");
    
}

$tys = array(
    'display',
    'lucky',
    'myredpackajax',
    'myluckyjax',
    'getred',
    'get_list'
);

$ty = trim($_GPC['ty']);

$ty = in_array($ty, $tys) ? $ty : 'display';

$senduserarr = explode(",", $config['senduser']);
if (in_array($_W['fans']['openid'], $senduserarr) || empty($config['senduser'])) {
    $issend = 1;
}

if ($ty == display) {
    
    $redata = pdo_fetchall("SELECT * FROM " . tablename('tyzm_redpack_lists') . " WHERE uniacid = :uniacid AND openid=:openid AND ispay=1 ORDER BY id DESC", array(
        ':uniacid' => $uniacid,
        ':openid' => $_W['fans']['openid']
    ));
    
    $redpacktotal = count($redata);
    
    $amount = 0;
    
    foreach ($redata as $item) {
        
        $amount += $item['amount'];
        
    }
    
    //自定义分享内容
    
    $_share['title'] = empty($reply['share_title']) ? $reply['title'] : $reply['share_title'];
    
    $_share['imgUrl'] = empty($reply['share_icon']) ? tomedia($reply['thumb']) : tomedia($reply['share_icon']);
    
    $_share['desc'] = empty($reply['share_des']) ? $reply['description'] : $reply['share_des'];
    
    //设置页面title
    
    $_W['page']['sitename'] = "发出的红包";
    
    include $this->template('mypack');
    
}

if ($ty == 'lucky') {
    
    $redata = pdo_fetchall("SELECT * FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND re_openid=:openid AND isdel=0 AND gettype!=3  ORDER BY id DESC", array(
        ':uniacid' => $uniacid,
        ':openid' => $_W['fans']['openid']
    ));
    
    $getamount = pdo_fetchcolumn("SELECT sum(total_amount) FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND re_openid=:openid AND isdel=0 AND total_amount<100 ORDER BY id DESC", array(
        ':uniacid' => $uniacid,
        ':openid' => $_W['fans']['openid']
    ));
    
    $withdrawamount = pdo_fetchcolumn("SELECT sum(total_amount) FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND re_openid=:openid AND isdel=0 AND gettype=3 ORDER BY id DESC", array(
        ':uniacid' => $uniacid,
        ':openid' => $_W['fans']['openid']
    ));
    
    $getamount = $getamount - $withdrawamount;
    
    $redpacktotal = count($redata);
    
    $amount = 0;
    
    foreach ($redata as $item) {
        $amount += $item['total_amount'];
    }
    
    //自定义分享内容
    
    $_share['title'] = empty($reply['share_title']) ? $reply['title'] : $reply['share_title'];
    
    $_share['imgUrl'] = empty($reply['share_icon']) ? tomedia($reply['thumb']) : tomedia($reply['share_icon']);
    
    $_share['desc'] = empty($reply['share_des']) ? $reply['description'] : $reply['share_des'];
    
    //设置页面title
    $defaulthelp = "javascript:;";
    $pluspelp    = $config['pluspelp'];
    if (empty($pluspelp)) {
        $pluspelp = $defaulthelp;
    }
    $_W['page']['sitename'] = "收到的红包";
    $gettype                = $config['gettype'];
    $jelimit                = empty($config['jelimit']) ? 1 : $config['jelimit'];
    include $this->template('mylucky');
    
}

if ($ty == 'myredpackajax') {
    
    $nowpage = $_GPC['limit'];
    
    $pindex = max(1, intval($nowpage));
    
    $psize = 10;
    
    
    
    
    
    $list = pdo_fetchall("SELECT * FROM " . tablename('tyzm_redpack_lists') . " WHERE uniacid = :uniacid AND openid = :openid AND ispay=1 ORDER BY `id` DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize, array(
        ':uniacid' => $uniacid,
        ':openid' => $_W['fans']['openid']
    ));
    
    
    
    if (!empty($list)) {
        
        foreach ($list as $key => $value) {
            
            $list[$key]['get_num'] = pdo_fetchcolumn("SELECT COUNT(id) FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND aid = :aid  ORDER BY `id` DESC", array(
                ':uniacid' => $uniacid,
                ':aid' => $value['id']
            ));
            
            $count = pdo_fetchall("SELECT * FROM " . tablename('tyzm_redpack_count') . " WHERE uniacid = :uniacid AND tid = :tid  ", array(
                ':uniacid' => $uniacid,
                ':tid' => $value['tid']
            ));
            
            
            
            $list[$key]['pv_count'] = 0;
            
            $list[$key]['forward_num'] = 0;
            
            $list[$key]['adclick_num'] = 0;
            
            for ($i = 0; $i < count($count); $i++) {
                
                $list[$key]['pv_count'] += $count[$i]['pv_count'];
                
                $list[$key]['forward_num'] += $count[$i]['forward_num'];
                
                $list[$key]['adclick_num'] += $count[$i]['adclick_num'];
                
            }
            
        }
        
    }
    
    
    
    if (!empty($list)) {
        
        foreach ($list as $item) {
            
            $row = array(
                
                'url' => $this->createMobileUrl('Redpack', array(
                    'ty' => 'lucky',
                    'tid' => $item['tid'],
                    'tokenkey' => base64_encode($item['openid'])
                )),
                
                'ad_name' => $item['send_name'],
                
                'addimg' => $item['addimg'],
                
                'pack_money' => $item['amount'],
                
                'pack_num' => $item['number'],
                
                'get_num' => $item['get_num'],
                
                'createtime' => date('Y-m-d H:i:s', $item['createtime']),
                
                'pv_num' => $item['pv_count'],
                
                'forward_num' => $item['forward_num'],
                
                'adclick_num' => $item['adclick_num']
                
            );
            
            $info[] = $row;
            
        }
        
        $sta = 200;
        
    } else {
        
        $sta = -103;
        
    }
    
    $result = array(
        
        'status' => $sta,
        
        'content' => $info
        
    );
    
    echo json_encode($result);
    
    
    
}



if ($ty == 'myluckyjax') {
    
    $nowpage = $_GPC['limit'];
    
    $pindex = max(1, intval($nowpage));
    
    $psize = 10;
    
    $list = pdo_fetchall("SELECT * FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND re_openid = :openid AND isdel=0 AND gettype!=3 ORDER BY `id` DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize, array(
        ':uniacid' => $uniacid,
        ':openid' => $_W['fans']['openid']
    ));
    
    if (!empty($list)) {
        
        foreach ($list as $key => $value) {
            
            $list[$key]['red'] = pdo_fetch("SELECT `send_name`,`openid`,`addimg` FROM " . tablename('tyzm_redpack_lists') . " WHERE uniacid = :uniacid AND id = :id ", array(
                ':uniacid' => $uniacid,
                ':id' => $value['aid']
            ));
            
        }
        
    }
    if (!empty($list)) {
        foreach ($list as $item) {
            $row = array(
                
                'url' => $this->createMobileUrl('Redpack', array(
                    'ty' => 'show',
                    'tid' => $item['tid'],
                    'tokenkey' => base64_encode($item['red']['openid'])
                )),
                
                'ad_name' => $item['red']['send_name'],
                
                'addimg' => $item['red']['addimg'],
                
                'pack_money' => $item['total_amount'] / 100,
                
                'createtime' => date('Y-m-d H:i:s', $item['createtime'])
                
            );
            
            $info[] = $row;
            
        }
        
        $sta = 200;
        
    } else {
        
        $sta = -103;
        
    }
    
    $result = array(
        
        'status' => $sta,
        
        'content' => $info
        
    );
    
    echo json_encode($result);
    
    
    
}
if ($ty == 'get_list') {
    
    $redata = pdo_fetchall("SELECT * FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND re_openid=:openid AND isdel=0 AND gettype=3  ORDER BY id DESC", array(
        ':uniacid' => $uniacid,
        ':openid' => $_W['fans']['openid']
    ));
    
    $amount = pdo_fetchcolumn("SELECT sum(total_amount) FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND re_openid=:openid AND isdel=0 AND gettype=3 ORDER BY id DESC", array(
        ':uniacid' => $uniacid,
        ':openid' => $_W['fans']['openid']
    ));
    
    $redpacktotal = count($redata);
    //自定义分享内容
    
    $_share['title'] = empty($reply['share_title']) ? $reply['title'] : $reply['share_title'];
    
    $_share['imgUrl'] = empty($reply['share_icon']) ? tomedia($reply['thumb']) : tomedia($reply['share_icon']);
    
    $_share['desc'] = empty($reply['share_des']) ? $reply['description'] : $reply['share_des'];
    
    //设置页面title
    
    $_W['page']['sitename'] = "提现记录";
    
    include $this->template('get_list');
    
}
if ($ty == "getred") {
    $getamount      = pdo_fetchcolumn("SELECT sum(total_amount) FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND re_openid=:openid AND isdel=0 AND total_amount<100 ORDER BY id DESC", array(
        ':uniacid' => $uniacid,
        ':openid' => $_W['fans']['openid']
    ));
    $withdrawamount = pdo_fetchcolumn("SELECT sum(total_amount) FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND re_openid=:openid AND isdel=0 AND gettype=3 ORDER BY id DESC", array(
        ':uniacid' => $uniacid,
        ':openid' => $_W['fans']['openid']
    ));
    
    $getamount = $getamount - $withdrawamount;
    $jelimit   = $config['jelimit'] < 1 ? 100 : $config['jelimit'] * 100;
    
    if ($getamount < $jelimit) { //小于1块不能提现
        $result = array(
            'status' => 404,
            'errmsg' => "可提现金额大于" . ($jelimit / 100) . "块才能提现！"
        );
        echo json_encode($result);
    } else {
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
        $insdata = array(
            'aid' => '0',
            'tid' => $uniacid . date('YmdHi') . random(7, 1),
            'uniacid' => $uniacid,
            'gettype' => '3',
            're_openid' => $_W['fans']['openid'],
            'mch_billno' => $wechat['mchid'] . date("Ymd", time()) . date("His", time()) . rand(1111, 9999),
            'order_num' => 1,
            'total_amount' => $getamount > 20000 ? 20000 : $getamount,
            'total_num' => 1,
            'user_ip' => $_W['clientip'],
            'createtime' => TIMESTAMP
        );
        if (pdo_insert('tyzm_redpack_data', $insdata)) {
            // $url=$_W['siteroot'].'app/'.$this->createMobileUrl('Ascncsendpack');
            // $senddata=array(
            // 'openid'=>$_W['fans']['openid'],
            // 'local'=>2,
            // 'id'=>pdo_insertid(),
            // );
            $senredid = pdo_insertid();
            //request_by_fsockopen($url,$senddata);//异步请求发红包
            $this->sendredpackt($_W['fans']['openid'], $senddata, $senredid);
            $out['status'] = 200;
            $out['errmsg'] = "提现成功，请留意拆开公众号发送的现金红包！";
            echo json_encode($out);
        } else {
            $out['status'] = 502;
            $out['errmsg'] = "服务器君倍感压力！";
            exit(json_encode($out));
        }
    }
    
}

function request_by_fsockopen($url, $post_data = array())
{
    
    $url_array = parse_url($url);
    
    $hostname = $url_array['host'];
    
    $port = isset($url_array['port']) ? $url_array['port'] : 80;
    
    $requestPath = $url_array['path'] . "?" . $url_array['query'];
    
    $fp = fsockopen($hostname, $port, $errno, $errstr, 10);
    
    if (!$fp) {
        
        echo "$errstr ($errno)";
        
        return false;
        
    }
    
    $method = "GET";
    
    if (!empty($post_data)) {
        
        $method = "POST";
        
    }
    
    $header = "$method $requestPath HTTP/1.1\r\n";
    
    $header .= "Host: $hostname\r\n";
    
    if (!empty($post_data)) {
        
        $_post = strval(NULL);
        
        foreach ($post_data as $k => $v) {
            
            $_post[] = $k . "=" . urlencode($v); //必须做url转码以防模拟post提交的数据中有&符而导致post参数键值对紊乱
            
        }
        
        $_post = implode('&', $_post);
        
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n"; //POST数据
        
        $header .= "Content-Length: " . strlen($_post) . "\r\n"; //POST数据的长度
        
        $header .= "Connection: Close\r\n\r\n"; //长连接关闭
        
        $header .= $_post; //传递POST数据
        
    } else {
        
        $header .= "Connection: Close\r\n\r\n"; //长连接关闭
        
    }
    
    fwrite($fp, $header);
    
    fclose($fp);
    
}



?>