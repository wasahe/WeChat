<?php



defined('IN_IA') or exit('Access Denied');

	global $_W,$_GPC;

	$rid = intval($_GPC['rid']);

	$weid = intval($_W['weid']);

	$uniacid = intval($_W['uniacid']);

	$userinfo=mc_oauth_userinfo();

	if(empty($userinfo)){

		message("抱歉，微信红包仅能在微信中打开！");

	}

$tid = trim($_GPC['tid']);

$tokenkey = trim(base64_decode($_GPC['tokenkey']));
$config=$this->module['config'];
$isfollow=$config['isfollow'];


//防止直接post

//防止直接post end

//是否关注

if (empty($_W['fans']['follow']) && $isfollow) {

    $out['status'] = 501;

    $out['errmsg'] = "关注公众号才能领取";

    exit(json_encode($out));

}

//end

//处理并发，引入文件锁

if ($_W['ispost'] && $_W['isajax']) {

    //$ipcount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND aid = :aid AND user_ip = :user_ip ORDER BY `id` DESC", array(':uniacid' => $uniacid,':aid' => $redata['id'],':user_ip' => $_W['clientip']));

    if ($ipcount > 20) {

        $out['status'] = 2;

        $out['errmsg'] = "口令错误，清清嗓子，再来！";

        exit(json_encode($out));

    }

    //file_put_contents(time()."data11.txt",$_W['clientip']);

    $isexist = pdo_fetch("SELECT `id` FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND tid = :tid AND re_openid=:re_openid", array(

        ':uniacid' => $uniacid,

        ':tid' => $tid,

        ':re_openid' => $_W['fans']['openid']

    ));

    if (!empty($isexist)) {

        $out['status'] = 201;

        exit(json_encode($out));

    }



        //抽奖处理start

        $redata = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_lists') . " WHERE uniacid = :uniacid AND tid = :tid AND openid=:openid AND ispay=:ispay", array(

            ':uniacid' => $uniacid,

            ':tid' => $tid,

            ':openid' => $tokenkey,

            ':ispay' => 1

        ));
		if(!empty($redata['area'])){//城市限制
			$retData=$this->IPlookup($_W['clientip']);
			$ipcity=$retData['retData']['city'];
			//file_put_contents(time()."data.txt",$ipcity);
			if(!empty($ipcity)){//获取不到地区时，直接通过
				$area = explode(",",$redata['area']);
				if(!in_array($ipcity,$area)){
					$out['status'] = 401;
					$out['errmsg'] = "不在活动区域，不能抢红包！";
					exit(json_encode($out));
				}
					
			}
		}
        //设置开始时间
        if (time() < $redata['starttime']) {

            $out['status'] = 401;

            $out['errmsg'] = "开始时间：" . date('Y-m-d H:i', $redata['starttime']);

			

            exit(json_encode($out));

        }

        //end

        //口令红包secret_key

        if (!empty($redata['secret_key'])) {

            require (IA_ROOT . '/addons/tyzm_redpack/inc/mobile/hz2py.php');

            $key = str_replace(array('，','！') , array('','') , $_GPC['key']);

            similar_text(CUtf8_PY::encode($key, 'all') , CUtf8_PY::encode($redata['secret_key'], 'all') , $percent);
$matching=empty($config['matching'])?85:$config['matching'];
            if ($percent < $matching || !in_array(mb_substr($_GPC['key'], -1, 1, 'utf-8') , array('，','。','！','？','、','；','：')) || empty($_GPC['localId'])) {

                //未达到标准，返回错误

                $out['status'] = 2;

                $out['errmsg'] = "口令错误，清清嗓子，再来！";

				

                exit(json_encode($out));

            }

            //

            

        }

        //口令红包

        //周边start

        if (!empty($redata['uuid'])) {

            load()->classs('weixin.account');

            load()->func('communication');

            $accObj = new WeixinAccount();

            $token = $accObj->fetch_available_token();

            $url = "https://api.weixin.qq.com/shakearound/user/getshakeinfo?access_token={$token}";

            $data = array(

                'ticket' => $_GPC['ticket'],

                'need_poi' => 1

            );

            $response = ihttp_request($url, json_encode($data));

            $zbre = @json_decode($response['content'], true);

            if ($zbre['errcode'] == 0) {

                if ($_W['fans']['openid'] != $zbre['data']['openid'] or $zbre['data']['beacon_info']['uuid'] != $redata['uuid']) {

                    $out['status'] = 301; //仅在通过摇一摇打开才能领取

                    $out['errmsg'] = "红包仅能通过摇一摇打开才能领取,分享无效。";

					

                    exit(json_encode($out));

                }

            } else {

                $out['status'] = 301; //仅在通过摇一摇打开才能领取

                $out['errmsg'] = "红包仅能通过摇一摇打开才能领取";

				

                exit(json_encode($out));

            }

        }

        //周边摇一摇

        //

        $luckycount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND aid = :aid  ORDER BY `id` DESC", array(

            ':uniacid' => $uniacid,

            ':aid' => $redata['id']

        ));

        //每天领取500个

        $fewdays = floor((time() - $redata['starttime']) / 86400) + 1;

        if ($luckycount >= ($fewdays * $redata['maximum'])) {

            if (time() < (strtotime(date("Y-m-d ", time())) + $redata['starttime'] - strtotime(date("Y-m-d", $redata['starttime'])))) {

                //未开始

                $out['status'] = 0;

                $out['errmsg'] = date("H:i", $redata['starttime']) . "惊喜开始！";

				

                exit(json_encode($out));

            } else {

                //已抽完start

                $out['status'] = 0;

                $out['errmsg'] = "今天已领取完，明天" . date("H:i", $redata['starttime']) . "再来吧！";

				

                exit(json_encode($out));

            }

        }

        $order_num = ($redata['number'] - $luckycount);

        //file_put_contents(time()."data.txt",$order_num);

        if (intval($order_num) > 0) {

            //获得机会start

            if ($redata['redtype'] == 2) { //获取随机红包红包金额

                $reddata = unserialize($redata['reddata']);

                $total_amount = $reddata[$luckycount];

            } elseif ($redata['redtype']) {

                $total_amount = sprintf("%.2f", $redata['amount'] / $redata['number']);

            }

            if ($total_amount < 1 && empty($redata['gettype'])) {
                $total_amount = 1;

            }

            $setting = uni_setting($_W['uniacid'], array(

                'payment'

            ));

            $wechat = $setting['payment']['wechat'];

            if (!is_array($setting['payment'])) {
				$out['status'] = 801; 
                $out['errmsg'] = "没有设定支付参数";
                exit(json_encode($out));
            }

            $insdata = array(

                'aid' => $redata['id'],

                'tid' => $redata['tid'],

                'uniacid' => $uniacid,
				
				'gettype' => $redata['gettype'],

                're_openid' => $_W['fans']['openid'],

                'mch_billno' => $wechat['mchid'] . date("Ymd", time()) . date("His", time()) . rand(1111, 9999) ,

                'order_num' => $redata['number'] - $order_num + 1,

                'total_amount' => $total_amount * 100,

                'total_num' => 1,

                'user_ip' => $_W['clientip'],

                'createtime' => TIMESTAMP,

            );

            //file_put_contents(time()."redata.txt",$total_amount);

            if (pdo_insert('tyzm_redpack_data', $insdata)) {
                $newredpackid = pdo_insertid();
				//异步发红包
				if(!empty($newredpackid) && $insdata['total_amount']>=100){//异步发红包，红包金额要大于等于1元
					$url=$_W['siteroot'].'app/'.$this->createMobileUrl('Ascncsendpack',array('tid'=>$insdata['tid'],'tokenkey'=>$_GPC['tokenkey']));
					//异步发红包start
					//$this->doRequest($url);
					// $senddata=array(
						// 'openid'=>$_W['fans']['openid'],
						// 'local '=>1,
					// );
					$senddata=array(
						'id'=>$redata['id'],
						'send_name'=>$redata['send_name'],
						'act_name' =>$redata['act_name'],
						'remark' =>$redata['remark'],
						'wishing' =>$redata['wishing'],
						'number'=>$redata['number'],
                     );
			        $this->sendredpackt($_W['fans']['openid'],$senddata,0);
					//request_by_fsockopen($url,$senddata);//异步请求发红包
					//$this->makeRequest($url,$senddata,'POST');
					//异步发红包end
				}
                $out['status'] = 200;
                echo json_encode($out);
            }else{

				$out['status'] = 502;

				$out['errmsg'] = "服务器君倍感压力！";
				exit(json_encode($out));
			}

            //获得机会end

            

        } else {

            if ($redata['status'] != 2) { //把红包状态设置为已领取完

                $redstatus['status'] = 2;

                pdo_update('tyzm_redpack_lists', $redstatus, array(

                    'id' => $redata['id']

                ));

            }

            //已抽完start

            $out['status'] = 0;

            $out['errmsg'] = "手慢了，红包派完了";

			

            exit(json_encode($out));

            //已抽完end

            

        }

        //抽奖处理end

		

        

    

}



