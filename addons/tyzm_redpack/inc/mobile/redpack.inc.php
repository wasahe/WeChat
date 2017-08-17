<?php



/**



 */



defined('IN_IA') or exit('Access Denied');

	global $_W,$_GPC;

	$rid = intval($_GPC['rid']);

	$weid = intval($_W['weid']);

	$uniacid = intval($_W['uniacid']);

	$userinfo=mc_oauth_userinfo();

	if(empty($userinfo)){

		//message("抱歉，微信红包仅能在微信中打开！"); 

	}
$this->authorization();
$tys = array('display', 'lucky', 'show', 'edit','ajaxpage');

$ty=trim($_GPC['ty']);

$ty = in_array($ty, $tys) ? $ty : 'display';

$tid=trim($_GPC['tid']);

$tokenkey=trim(base64_decode($_GPC['tokenkey']));


if(!empty($this->module['config']['followqrcode'])){
	$_W['account']['qrcode']=tomedia($this->module['config']['followqrcode']);
}
$config=$this->module['config'];
$senduserarr=explode(",",$config['senduser']);
if(in_array($_W['fans']['openid'],$senduserarr) || empty($config['senduser'])){
	$issend=1;
}

if($ty=='lucky'){

	$redata = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_lists') . " WHERE uniacid = :uniacid AND tid = :tid AND openid=:openid AND ispay=:ispay", array(':uniacid' => $uniacid,':tid' => $tid,':openid' => $tokenkey,':ispay' => 1));

	if(empty($redata)){

		echo "参数错误";exit;

	}

	$luckycount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND aid = :aid  ORDER BY `id` DESC", array(':uniacid' => $uniacid,':aid' => $redata['id']));

	

	$lickylog = pdo_fetchall("SELECT * FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND aid = :aid  ORDER BY `id` DESC", array(':uniacid' => $uniacid,':aid' => $redata['id']));

	

	

		if(!empty($lickylog)){

			foreach ($lickylog as $key => $value) { 

                $lickylog[$key]['userinfo']=mc_fansinfo($value['re_openid'],$_W['uniacid'], $_W['uniacid']);

                $lickylog[$key]['total_amount']=$lickylog[$key]['total_amount']/100;					

			}

	     }

	$redpackurl=$_W['siteroot'].'app/'.$this->createMobileUrl('Redpack',array('tid'=>$_GPC['tid'],'tokenkey'=>base64_encode($redata['openid'])));

	if($redata['openid']==$_W['fans']['openid']){

		if(empty($redata['short_url'])){//生成短链接

			//生成短链接start

			load()->func('communication');

			$longurl = trim($redpackurl);

			$token = WeAccount::token(WeAccount::TYPE_WEIXIN);

			$url = "https://api.weixin.qq.com/cgi-bin/shorturl?access_token={$token}";

			$send = array();

			$send['action'] = 'long2short';

			$send['long_url'] = $longurl;

			$response = ihttp_request($url, json_encode($send));

			if(is_error($response)) {

				$result = error(-1, "访问公众平台接口失败, 错误: {$response['message']}");

			}

			$result = @json_decode($response['content'], true);

			if(empty($result)) {

				$result =  error(-1, "接口调用失败, 元数据: {$response['meta']}");

			} elseif(!empty($result['errcode'])) {

				$result = error(-1, "访问微信接口错误, 错误代码: {$result['errcode']}, 错误信息: {$result['errmsg']}");

			}

			if(is_error($result)) {

				exit(json_encode(array('errcode' => -1, 'errmsg' => $result['message'])));

			}

			

			$short_url=$result['short_url'];

			if(!empty($short_url)){

				pdo_update('tyzm_redpack_lists',array('short_url' => $short_url),array('id' => $redata['id']));

				$redata['short_url']=$short_url;

			}

			//生成短链接end

		}

		$isme=1;

	}

	//自定义分享内容

	 



	 

	if(empty($redata['secret_key'])){

		 //自定义分享内容

		 $_share['title'] ="摇一摇，抢".$redata['send_name']."发的现金福利";

		 $_share['imgUrl'] =$redata['addimg'];

		 $_share['desc'] ="#".$redata['act_name']."#".$redata['wishing'];

		 //设置页面title

		 $_W['page']['sitename']=$redata['send_name']."发的福利";

	 }else{

		

		 //自定义分享内容

		 $_share['title'] ="大声喊出#".$redata['secret_key']."#口令，抢".$redata['send_name']."现金福利，".$redata['wishing'];

		 $_share['imgUrl'] =$redata['addimg'];

		 $_share['desc'] ="感谢#".$redata['send_name']."#的口令现金红包，快来抢啊！！！";

		 //设置页面title

		 $_W['page']['sitename']=$redata['send_name']."发的福利";

	 } 

	 $_share['link'] =$redpackurl;
	
	if(empty($this->module['config']['template'])){
		include $this->template('luckylist201603');
	}else{
		include $this->template('luckylist');
	}

}

if($ty=='ajaxpage'){

	$nowpage=$_GPC['limit'];

	$pindex = max(1, intval($nowpage));

	$psize = 10;

	

	$redata = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_lists') . " WHERE uniacid = :uniacid AND tid = :tid AND openid=:openid AND ispay=:ispay", array(':uniacid' => $uniacid,':tid' => $tid,':openid' => $tokenkey,':ispay' => 1));

	

	$list = pdo_fetchall("SELECT * FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND aid = :aid  ORDER BY `id` DESC LIMIT ".($pindex-1) * $psize.','.$psize,array(':uniacid' => $uniacid,':aid' => $redata['id']));

	if(!empty($list)){
		foreach ($list as $key => $value) { 
			$list[$key]['userinfo']=mc_fansinfo($value['re_openid']);	
			$list[$key]['total_amount']=$list[$key]['total_amount']/100;
		}

	}

	

	$info=array();

	if (!empty($list)){

		foreach ($list as $item){

			$row=array(

				'avatar'=>$item['userinfo']['tag']['avatar'],

				'nickname'=>$item['userinfo']['nickname'],

				'get_money'=>$item['total_amount'],

				'createtime'=>date('Y-m-d H:i:s', $item['createtime']),

			);

			$info[]=$row;			

		}

		$sta =200;

	}else{

		$sta =0;

	}

	$result=array(

		'status'=>$sta,

		'content'=>$info,	

	);

	echo json_encode($result);

	

}



if($ty=='show'){

	//测试

	//

	$redata = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_lists') . " WHERE uniacid = :uniacid AND tid = :tid AND openid=:openid AND ispay=:ispay", array(':uniacid' => $uniacid,':tid' => $tid,':openid' => $tokenkey,':ispay' => 1));
    
	$luckycount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND aid = :aid  ORDER BY `id` DESC", array(':uniacid' => $uniacid,':aid' => $redata['id']));
	if(empty($redata)){

		echo "参数错误";exit;

	}

	$lickylog = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_data') . " WHERE  aid = :aid AND uniacid = :uniacid AND re_openid=:openid AND isdel=0 ORDER BY `id` DESC", array(':aid' => $redata['id'],':uniacid' => $uniacid,':openid' => $_W['fans']['openid']));

    if(empty($lickylog)){

				$url=$this->createMobileUrl('Redpack',array('tid'=>$_GPC['tid'],'tokenkey'=>$_GPC['tokenkey']));

				header("location: ".$url);

	}else{
       
	   if(!empty($lickylog['tid'])&& $lickylog['result_code']!='SUCCESS' && $lickylog['total_amount']>=100){//第一次执行发红包动作&&红包发送不成功时，再执行多次执行，后台可以看到错误结果，红包金额要大于等于1元
	        $url=$_W['siteroot'].'app/'.$this->createMobileUrl('Ascncsendpack',array('tid'=>$_GPC['tid'],'tokenkey'=>$_GPC['tokenkey']));
	        //异步发红包start
			//$this->doRequest($url);
			// $senddata=array(
			    // 'openid'=>$_W['fans']['openid'],
				// 'local '=>1,
			// );
            //request_by_fsockopen($url,$senddata);//异步请求发红包
			//$this->makeRequest($url,$senddata,'POST');
			$senddata=array(
						'id'=>$redata['id'],
						'send_name'=>$redata['send_name'],
						'act_name' =>$redata['act_name'],
						'remark' =>$redata['remark'],
						'wishing' =>$redata['wishing'],
						'number'=>$redata['number'],
            );
			$this->sendredpackt($_W['fans']['openid'],$senddata,0);
            //file_put_contents(time()."data.txt",$senddata);
			//异步发红包end
		}

    }

	$lickylog['userinfo']=mc_fansinfo($lickylog['re_openid'],$_W['uniacid'], $_W['uniacid']);

	$lickylog['total_amount']=$lickylog['total_amount']/100;					



	 

	  if(empty($redata['secret_key'])){

		 //自定义分享内容

		 $_share['title'] ="摇一摇，抢".$redata['send_name']."发的现金福利";

		 $_share['imgUrl'] =$redata['addimg'];

		 $_share['desc'] ="#".$redata['act_name']."#".$redata['wishing'];

		 //设置页面title

		 $_W['page']['sitename']=$redata['send_name']."发的福利";

	 }else{

		

		 //自定义分享内容

		 $_share['title'] ="大声喊出#".$redata['secret_key']."#口令，抢".$redata['send_name']."现金福利，".$redata['wishing'];

		 $_share['imgUrl'] =$redata['addimg'];

		 $_share['desc'] ="感谢#".$redata['send_name']."#的口令现金红包，快来抢啊！！！";

		 //设置页面title

		 $_W['page']['sitename']=$redata['send_name']."发的福利";

	 }

	 $_share['link'] =$_W['siteroot'].'app/'.$this->createMobileUrl('Redpack',array('tid'=>$_GPC['tid'],'tokenkey'=>base64_encode($redata['openid'])));

	 

	$jelimit=empty($this->module['config']['jelimit'])?1:$this->module['config']['jelimit'];
    if(empty($this->module['config']['template'])){
		include $this->template('show201603');	 
	}else{
		include $this->template('newshow');	 
	}
	




}



if($ty=='edit'){

	$redata = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_lists') . " WHERE uniacid = :uniacid AND tid = :tid AND openid=:openid AND ispay=:ispay", array(':uniacid' => $uniacid,':tid' => $tid,':openid' => $_W['fans']['openid'],':ispay' => 1));



	if(empty($redata)){

		echo "参数错误";exit;

	}

	if($_W['ispost']){

		$msg=$_GPC['ad_name'].'发起的'.$_GPC['activity_name'].','.$_GPC['activity_blessing'];

		$addimg= $_GPC['serverId1'] ? tomedia($this->upimages($_GPC['serverId1'])) : $redata['addimg'];

		$adbg= $_GPC['serverId2'] ? tomedia($this->upimages($_GPC['serverId2'])) : $redata['adbg'];

		$secret_key= $_GPC['pack_type']? $data['secret_key']=$_GPC['secret_key'] : $data['secret_key']="";

		$data=array(

			'act_name' =>$_GPC['activity_name'],

			'send_name' =>$_GPC['ad_name'],

			'wishing' =>$_GPC['activity_blessing'],//广告语

			'remark' =>$msg,

			'description' =>$msg,

			'secret_key' =>$secret_key,

			'addimg' =>$addimg,

			'adbg' =>$adbg,

			'adurl' =>$_GPC['ad_url'],

			'maximum' =>intval($_GPC['maximum']),

			'starttime'=>strtotime($_GPC['starttime']),

			'onlyshare' =>$_GPC['onlyshare'],

		);

		if(pdo_update('tyzm_redpack_lists', $data,array('tid' => $redata['tid']))){

			$out['status'] = 200;

		    exit(json_encode($out));

		}else{

			$out['status'] = 0;

			$out['errmsg'] = "编辑失败！";

		    exit(json_encode($out));

		}

	}

	$_W['page']['sitename']="编辑红包";
    $template=$this->module['config']['template'];
	include $this->template('edit');

}







if($ty=='display'){

	$redata = pdo_fetch("SELECT * FROM " . tablename('tyzm_redpack_lists') . " WHERE uniacid = :uniacid AND tid = :tid AND openid=:openid  AND ispay=:ispay", array(':uniacid' => $uniacid,':tid' => $tid,':openid' => $tokenkey,':ispay' => 1));



	if(!empty($redata)){

		

		$isexist = pdo_fetch("SELECT `id` FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND tid = :tid AND re_openid=:re_openid  AND isdel=0", array(':uniacid' => $uniacid,':tid' => $tid,':re_openid' => $_W['fans']['openid']));

		if($isexist){

			$isexist=1;

		}

		

		

		if($redata['ispay']!=1){

				echo "红包未支付";exit;

		}

		if($redata['openid']!=$_W['fans']['openid']){//非自己红包，直接显示领取界面

		    $luckycount = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('tyzm_redpack_data') . " WHERE uniacid = :uniacid AND aid = :aid AND re_openid=:openid ORDER BY `id` DESC", array(':uniacid' => $uniacid,':aid' => $redata['id'],':openid' =>$_W['fans']['openid']));

		    /* 注释掉直接跳转领取界面*/

			if($luckycount){

				$url=$this->createMobileUrl('Redpack',array('ty'=>'show','tid'=>$_GPC['tid'],'tokenkey'=>$_GPC['tokenkey']));

				header("location: ".$url);

			}

			

	    }

	}else{

		echo "参数错误";exit;

	}		

	 

	 //include $this->template('redpack');

	 /*

	 if($_W['fans']['openid']=='o1W7Ht6YkguzeTUBrISJJlOlXn1A1'){

		include $this->template('newredpack');	 

	 }else{

		include $this->template('redpack'); 

	 }

	 */

	 if(empty($redata['secret_key'])){

		 //自定义分享内容

		 $_share['title'] ="摇一摇，抢".$redata['send_name']."发的现金福利";

		 $_share['imgUrl'] =$redata['addimg'];

		 $_share['desc'] ="#".$redata['act_name']."#".$redata['wishing'];

		 //设置页面title

		 $_W['page']['sitename']=$redata['send_name']."发的福利";

		 include $this->template('newredpack');	

	 }else{

		

		 //自定义分享内容

		 $_share['title'] ="大声喊出#".$redata['secret_key']."#口令，抢".$redata['send_name']."现金福利，".$redata['wishing'];

		 $_share['imgUrl'] =$redata['addimg'];

		 $_share['desc'] ="感谢#".$redata['send_name']."#的口令现金红包，快来抢啊！！！";

		 //设置页面title

		 $_W['page']['sitename']=$redata['send_name']."发的福利";
		 
		if(empty($this->module['config']['template'])){
			 include $this->template('key_redpack201603');
			
		}else{
			include $this->template('key_redpack');	 	
		}
		

	 }





	 

}  

  

function request_by_fsockopen($url,$post_data=array()){

    $url_array = parse_url($url);

    $hostname = $url_array['host'];

    $port = isset($url_array['port'])? $url_array['port'] : 80; 

    $requestPath = $url_array['path'] ."?". $url_array['query'];

    $fp = fsockopen($hostname, $port, $errno, $errstr, 10);

    if (!$fp) {

        echo "$errstr ($errno)";

        return false;

    }

    $method = "GET";

    if(!empty($post_data)){

        $method = "POST";

    }

    $header = "$method $requestPath HTTP/1.1\r\n";

    $header.="Host: $hostname\r\n";

    if(!empty($post_data)){

        $_post = strval(NULL);

        foreach($post_data as $k => $v){

                $_post[]= $k."=".urlencode($v);//必须做url转码以防模拟post提交的数据中有&符而导致post参数键值对紊乱

        }

        $_post = implode('&', $_post);

        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";//POST数据

        $header .= "Content-Length: ". strlen($_post) ."\r\n";//POST数据的长度

        $header.="Connection: Close\r\n\r\n";//长连接关闭

        $header .= $_post; //传递POST数据

    }else{

        $header.="Connection: Close\r\n\r\n";//长连接关闭

    }

    fwrite($fp, $header);

    fclose($fp);

}

		

		

 

	

   













