<?php
/**
 * 模块定义：规则内容
 *
 * @author 石头鱼
 * @url http://www.00393.com/
 */
defined('IN_IA') or exit('Access Denied');

class Stonefish_scenesignModuleSite extends WeModuleSite {	

	//微信访问限制
	function Weixin(){
		global $_W;
		$setting = $this->module['config'];
		if($setting['stonefish_scenesign_jssdk']==2 && !empty($setting['jssdk_appid']) && !empty($setting['jssdk_secret'])){
			$_W['account']['jssdkconfig'] = $this->getSignPackage($setting['jssdk_appid'],$setting['jssdk_secret']);
		}
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
		if(strpos($user_agent, 'MicroMessenger') === false){
			if($setting['weixinvisit']==1){
				include $this->template('remindnotweixin');
			    exit;
			}else{
				return true;
			}
		}else{
			return true;
		}
    }
	//微信访问限制
	//json返回参数
	public function Json_encode($_data) {
        die(json_encode($_data));
		exit;
    }
	//json返回参数
	//发送消息模板
	public function Seed_tmplmsg($openid,$tmplmsgid,$rid,$params) {
        global $_W;
		$reply = pdo_fetch("select title,starttime,endtime FROM ".tablename("stonefish_scenesign_reply")." where rid = :rid", array(':rid' => $rid));
		$exchange = pdo_fetch("select awardingstarttime,awardingendtime FROM ".tablename("stonefish_scenesign_exchange")." where rid = :rid", array(':rid' => $rid));
		$listtotal = pdo_fetchcolumn("select xuninum+fansnum as total from ".tablename("stonefish_scenesign_reply")." where rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
		$tmplmsg = pdo_fetch("select * FROM ".tablename("stonefish_scenesign_tmplmsg")." where id = :id", array(':id' => $tmplmsgid));
		$fans = pdo_fetch("select * FROM ".tablename("stonefish_scenesign_fans")." where rid = :rid and from_user = :from_user", array(':rid' => $rid, ':from_user' => $openid));
		$fans['realname'] = empty($fans['realname']) ? stripcslashes($fans['nickname']) : $fans['realname'];
		if(!empty($tmplmsg)){
			$appUrl= $this->createMobileUrl($params['do'], array('rid' => $rid,'id' => $params['iid']),true);
		    $appUrl=$_W['siteroot'].'app/'.substr($appUrl,2);
			$str = array('#活动名称#'=>$reply['title'],'#参与人数#'=>$listtotal,'#活动时间#'=>date('Y-m-d H:i', $reply['starttime']).'至'.date('Y-m-d H:i', $reply['endtime']),'#兑奖时间#'=>date('Y-m-d H:i', $exchange['awardingstarttime']).'至'.date('Y-m-d H:i', $exchange['awardingendtime']),'#奖品名称#'=>$params['prizerating'].'-'.$params['prizename'],'#粉丝昵称#'=>stripcslashes($fans['nickname']),'#真实姓名#'=>$fans['realname'],'#现在时间#'=>date('Y-m-d H:i', time()),'#奖品数量#'=>$params['prizenum'],'#中奖时间#'=>date('Y-m-d H:i', $params['prizetime']),'#助力昵称#'=>stripcslashes($params['nickname']));
			$datas['first'] = array('value'=>strtr($tmplmsg['first'],$str),'color'=>$tmplmsg['firstcolor']);
			for($i = 1; $i <= 10; $i++) {
				if(!empty($tmplmsg['keyword'.$i]) && !empty($tmplmsg['keyword'.$i.'code'])){
					$datas[$tmplmsg['keyword'.$i.'code']] = array('value'=>strtr($tmplmsg['keyword'.$i],$str),'color'=>$tmplmsg['keyword'.$i.'color']);
				}
			}
			$datas['remark'] = array('value'=>strtr($tmplmsg['remark'],$str),'color'=>$tmplmsg['remarkcolor']);
	        $data=json_encode($datas);
			
			load()->func('communication');
            load()->classs('weixin.account');
            $accObj = WeixinAccount::create($_W['acid']);
            $access_token = $accObj->fetch_token();
			if (empty($access_token)) {
                return;
            }
			$postarr = '{"touser":"'.$openid.'","template_id":"'.$tmplmsg['template_id'].'","url":"'.$appUrl.'","topcolor":"'.$tmplmsg['topcolor'].'","data":'.$data.'}';
            $res = ihttp_post('https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $access_token, $postarr);
			//添加消息发送记录
			$tmplmsgdata = array(
				'rid' => $rid,
				'uniacid' => $_W['uniacid'],
				'from_user' => $openid,
				'tmplmsgid' => $tmplmsgid,
				'tmplmsg' => $postarr,
				'seednum' => 1,
				'createtime' => TIMESTAMP,
			);
			pdo_insert('stonefish_scenesign_fanstmplmsg', $tmplmsgdata);
			//添加消息发送记录
			return true;
		}
		return;
    }
	//发送消息模板
	//随机抽奖ID
	function Get_rand($proArr) {   
        $result = '';    
        //概率数组的总概率精度   
        $proSum = array_sum($proArr);    
        //概率数组循环   
        foreach ($proArr as $key => $proCur) {   
            $randNum = mt_rand(1, $proSum);   
            if ($randNum <= $proCur) {   
                $result = $key;   
                break;   
            } else {
                $proSum -= $proCur;   
            }         
        }   
        unset ($proArr);    
        return $result;
    }
	//随机抽奖ID	
	//奖品名称替换
	function Get_prizename($rid,$title,$id='') {
		global $_W;
		$uniacid = $_W['uniacid'];
		if($id){
			$prizename = pdo_fetchcolumn("select prizename FROM ".tablename("stonefish_scenesign_prize")." where id = :id", array(':uniacid' => $uniacid,':rid' => $rid));
		}else{
			$prizename = pdo_fetchcolumn("select prizename FROM ".tablename("stonefish_scenesign_prize")." AS t1 JOIN (select ROUND(RAND() * (select MAX(id) FROM ".tablename("stonefish_scenesign_prize").")) AS id) AS t2 where t1.uniacid= :uniacid AND t1.rid= :rid and t1.id >= t2.id", array(':uniacid' => $uniacid,':rid' => $rid));
		}		
		$str = array('#奖品名称#'=>$prizename);
		$result = strtr($title,$str);
        return $result;
    }
	//奖品名称替换
	//提示出错页
	function Message_tips($rid,$msg,$url=''){
        global $_W;
		$reply = pdo_fetch("select msgadpictime,msgadpic from ".tablename("stonefish_scenesign_reply")." where rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
		$time = $reply['msgadpictime'];
		$msgadpic = iunserializer($reply['msgadpic']);
		$msgadpicid = array_rand($msgadpic);
		$msgadpic =$msgadpic[$msgadpicid];
		if(empty($msg)){
			$msg = '未知错误！';
		}
		include $this->template('message');
		exit;
    }
	//提示出错页
	//获取openid
	function Get_openid() {
        global $_W;
		$from_user = array();
		$from_user['openidtrue'] = $_SESSION['openid'];
		$from_user['openid'] = $_W['openid'];
		$setting = $this->module['config'];
		if($_W['account']['level']<4 && $setting['stonefish_scenesign_oauth']==1){
			$from_user['openid'] = $_SESSION['oauth_openid'];
		}
		if($_W['account']['level']<4 && $setting['stonefish_scenesign_oauth']==2){
			$from_user['openid'] = $_COOKIE["stonefish_oauth_from_user"];
		}
		if(empty($from_user['openid'])){
			if (isset($_COOKIE["user_oauth2_wuopenid"])){
				$from_user['openid'] = $_COOKIE["user_oauth2_wuopenid"];
			}
		}
		//重新判断是否关注用户
		if($_W['account']['level']==4){
		    $fans_member = pdo_fetch("select follow,uid from " . tablename('mc_mapping_fans') . " where uniacid = :uniacid and acid = :acid and openid = :openid order by `fanid` desc", array(':uniacid' => $_W['uniacid'], ':acid' => $_W['acid'], ':openid' => $from_user['openid']));
		    if(!empty($fans_member)){
			    $_W['fans']['follow'] = $fans_member['follow'];
		        $_W['member']['uid'] = $fans_member['uid'];
		    }
		}elseif(!empty($_SESSION['openid'])){
			$fans_member = pdo_fetch("select follow,uid from " . tablename('mc_mapping_fans') . " where uniacid = :uniacid and acid = :acid and openid = :openid order by `fanid` desc", array(':uniacid' => $_W['uniacid'], ':acid' => $_W['acid'], ':openid' => $_SESSION['openid']));
		    if(!empty($fans_member)){
			    $_W['fans']['follow'] = $fans_member['follow'];
		        $_W['member']['uid'] = $fans_member['uid'];
		    }
		}
		//重新判断是否关注用户
		return $from_user;
    }
	//获取openid
	//获取粉丝数据
	function Get_UserInfo($power,$rid,$iid=0,$page_fromuser,$entrytype) {
        global $_W;
		$setting = $this->module['config'];
		if(!empty($_COOKIE['stonefish_userinfo'])){
			$userinfo = iunserializer($_COOKIE["stonefish_userinfo"]);
			if($_COOKIE["stonefish_userinfo_power"]!=$power || empty($userinfo['openid'])){
				setcookie("stonefish_userinfo", '', time()-7200);
				setcookie("stonefish_userinfo_power", '', time()-7200);
				$appUrl=$this->createMobileUrl('entry', array('rid' => $rid,'iid' => $iid,'from_user' => $page_fromuser,'entrytype' => $entrytype),true);
				$appUrl=substr($appUrl,2);
				$url = $_W['siteroot'] ."app/".$appUrl;
				header("location: $url");
				exit;
			}
			if(empty($userinfo['nickname']) && $power==2){
				setcookie("stonefish_userinfo", '', time()-7200);
				setcookie("stonefish_userinfo_power", '', time()-7200);
				$appUrl=$this->createMobileUrl('entry', array('rid' => $rid,'iid' => $iid,'from_user' => $page_fromuser,'entrytype' => $entrytype),true);
				$appUrl=substr($appUrl,2);
				$url = $_W['siteroot'] ."app/".$appUrl;
				header("location: $url");
				exit;
			}
			if(empty($userinfo['headimgurl']) && $power==2){
				$userinfo['headimgurl'] = MODULE_URL.'template/images/avatar.jpg';
			}
		}elseif($setting['stonefish_scenesign_oauth']>=1 || $_W['account']['level']==4){
			$appUrl=$this->createMobileUrl('entry', array('rid' => $rid,'iid' => $iid,'from_user' => $page_fromuser,'entrytype' => $entrytype),true);
			$appUrl=substr($appUrl,2);
			$url = $_W['siteroot'] ."app/".$appUrl;
			header("location: $url");
			exit;
		}else{
			$userinfo = array('headimgurl' => MODULE_URL.'template/images/avatar.jpg','nickname' => '匿名');
		}
		return $userinfo;
	}
	//获取粉丝数据
	//活动状态
	function Check_reply($reply) {   
		if ($reply == false) {
            $this->message_tips($reply['rid'],'抱歉，活动不存在，您穿越了！');
        }else{
			if ($reply['isshow'] == 0) {
				$this->message_tips($reply['rid'],'抱歉，活动暂停，请稍后...');
			}
			if ($reply['starttime'] > time()) {
				$this->message_tips($reply['rid'],'抱歉，活动未开始，请于'.date("Y-m-d H:i:s", $row['starttime']) .'参加活动!');
			}
		}
		return true;
    }
	//活动状态
	//分享设置
	function Get_share($rid,$from_user,$title) {
		global $_W;
		$uniacid = $_W['uniacid'];
		if (!empty($rid)) {
			$listtotal = pdo_fetchcolumn("select fansnum as total from ".tablename("stonefish_scenesign_reply")." where rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
        }
		if (!empty($from_user)) {
		    $fans = pdo_fetch("select realname,nickname FROM ".tablename("stonefish_scenesign_fans")." where uniacid= :uniacid AND rid= :rid AND from_user= :from_user", array(':uniacid' => $uniacid,':rid' => $rid,':from_user' => $from_user));
			if ($fans['zhongjiang']>=1) {
				$prizeid = pdo_fetchcolumn("select prizeid FROM ".tablename("stonefish_scenesign_fansaward")." where zhongjiang>=1 and uniacid= :uniacid AND rid= :rid AND from_user= :from_user ORDER BY RAND() LIMIT 1", array(':uniacid' => $uniacid,':rid' => $rid,':from_user' => $from_user));
				if(!empty($prizeid)){
					$prize = pdo_fetch("select prizename FROM ".tablename("stonefish_scenesign_prize")." where id = :id", array(':id' => $prizeid));
			        $prizename = $prize['prizename'];
				}
			}
		}
		$str = array('#参与人数#'=>$listtotal,'#粉丝昵称#'=>stripcslashes($fans['nickname']),'#真实姓名#'=>$fans['realname'],'#奖品名称#'=>$prizename);
		$result = strtr($title,$str);
        return $result;
    }
	//分享设置
	//获取关健词
	function Rule_keyword($rid) {   
		$keyword = pdo_fetchall("select content from ".tablename('rule_keyword')." where rid=:rid and type=1",array(":rid"=>$rid));
        foreach ($keyword as $keywords){
			$rule_keyword .= $keywords['content'].',';
		}
		$rule_keyword = substr($rule_keyword,0,strlen($rule_keyword)-1);
		return $rule_keyword;
    }
	//获取关健词
	//认证第二部获取 openid和accessToken
    public function doMobileauth2(){
        global $_W, $_GPC;
		$setting = $this->module['config'];
        $entrytype = $_GPC['entrytype'];
        $code = $_GPC['code'];                
        $rid = intval($_GPC['rid']);
		$iid = intval($_GPC['iid']);
		$tokenInfo = $this->getAuthTokenInfo($code,$_GPC['power']);
        $from_user = $tokenInfo['openid'];
		setcookie("stonefish_userinfo", iserializer($tokenInfo), time()+3600*24*$setting['stonefish_oauth_time']);
		setcookie("stonefish_userinfo_power", $_GPC['power'], time()+3600*24*$setting['stonefish_oauth_time']);
		setcookie("stonefish_oauth_from_user", $from_user, time()+3600*24*$setting['stonefish_oauth_time']);
        if ($entrytype == "index") { // 粉丝参与活动
		    $appUrl= $this->createMobileUrl('index', array('rid' => $rid),true);
		    $appUrl=substr($appUrl,2);
            $url = $_W['siteroot'] . "app/".$appUrl;
        } elseif ($entrytype == "shareview") { // 好友进入认证
            $appUrl=$this->createMobileUrl('shareview', array('rid' => $rid,'iid' => $iid,"fromuser" => $_GPC['from_user']),true);
			$appUrl=substr($appUrl,2);
			$url = $_W['siteroot'] ."app/".$appUrl;
        }
        header("location: $url");
		exit;
    }
	//认证第二部获取 openid和accessToken
    //获取token信息
    public function getAuthTokenInfo($code,$power){
        global $_GPC, $_W;
		if ($_W['account']['level']==4){
			$appid = $_W['account']['key'];
            $secret = $_W['account']['secret'];
		}else{
			$setting = $this->module['config'];
			if($setting['stonefish_scenesign_oauth']==1 && !empty($_W['oauth_account']['key']) && !empty($_W['oauth_account']['secret'])){
				$appid = $_W['oauth_account']['key'];
                $secret = $_W['oauth_account']['secret'];
			}
			if($setting['stonefish_scenesign_oauth']==2 && !empty($setting['appid']) && !empty($setting['secret'])){
				$appid = $setting['appid'];
                $secret = $setting['secret'];
			}
		}
        load()->func('communication');
        $oauth2_code = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $appid . "&secret=" . $secret . "&code=" . $code . "&grant_type=authorization_code";
        $content = ihttp_get($oauth2_code);
        $token = @json_decode($content['content'], true);
        if (empty($token) || ! is_array($token) || empty($token['access_token']) || empty($token['openid'])) {
            echo '<h1>获取微信公众号授权' . $code . '失败[无法取得token以及openid], 请稍后重试！ 公众平台返回原始数据为: <br />' . $content['meta'] . '<h1>';
            exit();
        }else{
			if($power==1){
				$token = array('openid'=>$token['openid'],'headimgurl' => MODULE_URL.'template/images/avatar.jpg','nickname' => '匿名');
			}else{
				$token = $this->getUserInfo($token['openid'], $token['access_token']);
			}
		}
        return $token;
    }
	//获取token信息
    //获取用户信息
    public function getUserInfo($openid, $access_token)    {
		load()->func('communication');
        $tokenUrl = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $openid . "&lang=zh_CN";
        $content = ihttp_get($tokenUrl);
        $userInfo = @json_decode($content['content'], true);
        return $userInfo;
    }
	//获取用户信息
	//进入页
	public function doMobileEntry() {
		global $_GPC, $_W;
		$this->Weixin();
		$rid = intval($_GPC['rid']);
		$iid = intval($_GPC['iid']);
		$entrytype = $_GPC['entrytype'];
		$uniacid = $_W['uniacid'];       
		$acid = $_W['acid'];
		$reply = pdo_fetch("select * from " . tablename('stonefish_scenesign_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));		
        //活动状态
		$this->check_reply($reply);		
		//活动状态		
		//获取openid
		$openid = $this->get_openid();
		$from_user = $openid['openidtrue'];
		//获取openid
		//广告显示控制
		if($reply['homepictime']>0){
			if($reply['homepictype']==1 && $_GPC['homepic']!="yes"){
				include $this->template('homepictime');
				exit;
			}
			if((empty($_COOKIE['stonefish_scenesign_hometime'.$rid]) || $_COOKIE["stonefish_scenesign_hometime".$rid]<=time()) && $_GPC['homepic']!="yes"){
				switch ($reply['homepictype']){
				    case 2:
				        setcookie("stonefish_scenesign_hometime".$rid, strtotime(date("Y-m-d",strtotime("+1 day"))), strtotime(date("Y-m-d",strtotime("+1 day"))));
				        break;
					case 3:
				        setcookie("stonefish_scenesign_hometime".$rid, strtotime(date("Y-m-d",strtotime("+1 week"))), strtotime(date("Y-m-d",strtotime("+7 week"))));
				        break;
					case 4:
				        setcookie("stonefish_scenesign_hometime".$rid, strtotime(date("Y-m-d",strtotime("+1 year"))), strtotime(date("Y-m-d",strtotime("+1 year"))));
				        break;
				}
				include $this->template('homepictime');
				exit;
			}			
		}		
        //广告显示控制
		if(!empty($_COOKIE['stonefish_userinfo']) && $_W['account']['level']<4){
			$appUrl=$this->createMobileUrl($entrytype, array('rid' => $rid,'fromuser' => $_GPC['from_user'],'iid' => $iid),true);
			$appUrl=substr($appUrl,2);
			$url = $_W['siteroot'] ."app/".$appUrl;
			header("location: $url");
		    exit;
		}else{
			$setting = $this->module['config'];
		    //认证服务号
		    //认证服务号
		    if($_W['account']['level']==4){
			    $fans = pdo_fetch("select * from " . tablename('mc_mapping_fans') . " where uniacid = :uniacid and acid = :acid and openid = :openid order by `fanid` desc", array(':uniacid' => $uniacid, ':acid' => $acid, ':openid' => $from_user));
			    $appid = $_W['account']['key'];
                $secret = $_W['account']['secret'];
				if(intval($_W['fans']['follow'])){
			        load()->classs('weixin.account');
		            $accObj= WeixinAccount::create($acid);
		            $access_token = $accObj->fetch_token();
			        load()->func('communication');
			        $oauth2_code = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$from_user."&lang=zh_CN";
			        $content = ihttp_get($oauth2_code);
			        $token = @json_decode($content['content'], true);
			        setcookie("stonefish_userinfo", iserializer($token), time()+3600*24*$setting['stonefish_oauth_time']);
				    setcookie("stonefish_userinfo_power", $reply['power'], time()+3600*24*$setting['stonefish_oauth_time']);
			        //判断是否关注
					if(empty($fans)){
					    //平台没有此粉丝数据重新写入数据，一般不会出现这个问题
					    $rec = array();
			            $rec['acid'] = $acid;
			            $rec['uniacid'] = $uniacid;
			            $rec['uid'] = 0;
			            $rec['openid'] = $token['openid'];
			            $rec['salt'] = random(8);
				        $rec['follow'] = 1;
				        $rec['followtime'] = $token['subscribe_time'];
				        $rec['unfollowtime'] = 0;
					    $settings = uni_setting($uniacid, array('passport'));
					    if (!isset($settings['passport']) || empty($settings['passport']['focusreg'])) {
						    $default_groupid = pdo_fetchcolumn('SELECT groupid FROM ' .tablename('mc_groups') . ' WHERE uniacid = :uniacid AND isdefault = 1', array(':uniacid' => $uniacid));
						    $data = array(
					            'uniacid' => $uniacid,
					            'email' => md5($token['openid']).'@00393.com',
					            'salt' => random(8),
					            'groupid' => $default_groupid,
								'avatar' => rtrim($token['headimgurl'],'0').'132',
					            'createtime' => TIMESTAMP,
				            );
				            $data['password'] = md5($token['openid'] . $data['salt'] . $_W['config']['setting']['authkey']);
				            pdo_insert('mc_members', $data);
				            $rec['uid'] = pdo_insertid();
						    $fans['uid'] = $rec['uid'];
			            }
			            pdo_insert('mc_mapping_fans', $rec);					
					    //平台没有此粉丝数据重新写入数据，一般不会出现这个问题
				    }
				    $appUrl=$this->createMobileUrl($entrytype, array('rid' => $rid,'fromuser' => $_GPC['from_user'],'iid' => $iid),true);
			        $appUrl=substr($appUrl,2);
			        $url = $_W['siteroot'] ."app/".$appUrl;
			        header("location: $url");
		            exit;
			    }
			    if(!empty($_COOKIE['stonefish_userinfo'])){
				    $appUrl=$this->createMobileUrl($entrytype, array('rid' => $rid,'fromuser' => $_GPC['from_user'],'iid' => $iid),true);
				    $appUrl=substr($appUrl,2);
				    $url = $_W['siteroot'] ."app/".$appUrl;
				    header("location: $url");
		   	        exit;
		        }elseif($reply['power']==2){
				    $appUrl= $this->createMobileUrl('auth2', array('entrytype' => $entrytype,'rid' => $rid,'from_user' => $_GPC['from_user'],'iid' => $iid,'power' => $reply['power']),true);
		            $appUrl = substr($appUrl,2);
                    $redirect_uri = $_W['siteroot'] ."app/".$appUrl ;
		            //snsapi_base为只获取OPENID,snsapi_userinfo为获取头像和昵称
			        $scope = $reply['power']==1 ? 'snsapi_base' : 'snsapi_userinfo';
                    $oauth2_code = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".urlencode($redirect_uri)."&response_type=code&scope=".$scope."&state=1#wechat_redirect";
                    header("location: $oauth2_code");
		            exit;
			    }
		    }
		    //认证服务号
		    //非认证服务号和认证服务号未关注粉丝
            //不是认证号又没有借用服务号获取头像昵称可认证服务号未关注用户
		    if($setting['stonefish_scenesign_oauth']==0 && $_W['account']['level']!=4){
				if(!isset($_COOKIE["user_oauth2_wuopenid"])){
				   	//设置cookie信息
			    	$token = array('openid'=>time(),'headimgurl' => MODULE_URL.'template/images/avatar.jpg','nickname' => '匿名');
			    	setcookie("user_oauth2_wuopenid", time(), time()+3600*24*$setting['stonefish_oauth_time']);
					setcookie("stonefish_userinfo", iserializer($token), time()+3600*24*$setting['stonefish_oauth_time']);
				    setcookie("stonefish_userinfo_power", $reply['power'], time()+3600*24*$setting['stonefish_oauth_time']);
			   	}
			    $appUrl=$this->createMobileUrl($entrytype, array('rid' => $rid,'fromuser' => $_GPC['from_user'],'iid' => $iid),true);
			   	$appUrl=substr($appUrl,2);
			   	$url = $_W['siteroot'] ."app/".$appUrl;
			    header("location: $url");
		        exit;
			}
		    //不是认证号又没有借用服务号获取头像昵称可认证服务号未关注用户			
		    //不是认证号 借用服务号获取头像昵称
            if ($setting['stonefish_scenesign_oauth']==1 && !empty($_W['oauth_account']['key']) && !empty($_W['oauth_account']['secret'])) { // 判断是否是借用设置
                $appid = $_W['oauth_account']['key'];
                $secret = $_W['oauth_account']['secret'];
            }
			if ($setting['stonefish_scenesign_oauth']==2 && !empty($setting['appid']) && ! empty($setting['secret'])) { // 判断是否是借用设置
                $appid = $setting['appid'];
                $secret = $setting['secret'];
            }
		    $appUrl= $this->createMobileUrl('auth2', array('entrytype' => $entrytype,'rid' => $rid,'from_user' => $_GPC['from_user'],'iid' => $iid,'power' => $reply['power']),true);
		    $appUrl = substr($appUrl,2);
            $redirect_uri = $_W['siteroot'] ."app/".$appUrl ;
		    //snsapi_base为只获取OPENID,snsapi_userinfo为获取头像和昵称
			$scope = $reply['power']==1 ? 'snsapi_base' : 'snsapi_userinfo';
            $oauth2_code = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".urlencode($redirect_uri)."&response_type=code&scope=".$scope."&state=1#wechat_redirect";
            header("location: $oauth2_code");
		    exit;
		    //不是认证号 借用服务号获取头像昵称
		    //非认证服务号和认证服务号未关注粉丝
		}
	}
	//进入页
	//帮助页
	public function doMobileShareview() {
        global $_GPC, $_W;
        $rid = intval($_GPC['rid']);
		if(empty($rid)){
			echo '系统出错！';
			exit;
		}
		$uniacid = $_W['uniacid'];       
		$fromuser = authcode(base64_decode($_GPC['fromuser']), 'DECODE');
		$page_fromuser = $_GPC['fromuser'];		
		$acid = $_W['acid'];
		//获取openid
		$openid = $this->get_openid();
		$from_user = $openid['openid'];
		$page_from_user = $page_fromuser;
		//获取openid
		$reply = pdo_fetch("select * from " . tablename('stonefish_scenesign_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
		$template = pdo_fetch("select * from " . tablename('stonefish_scenesign_template') . " where id = :id", array(':id' => $reply['templateid']));
		$exchange = pdo_fetch("select * from " . tablename('stonefish_scenesign_exchange') . " where rid = :rid", array(':rid' => $rid));
		$share = pdo_fetch("select * from " . tablename('stonefish_scenesign_share') . " where rid = :rid and acid = :acid", array(':rid' => $rid,':acid' => $acid));
		//活动状态
		$this->check_reply($reply);		
		//活动状态
		//增加人数，和浏览次数
        pdo_update('stonefish_scenesign_reply', array('viewnum' => $reply['viewnum']+1), array('id' => $reply['id']));
		//增加人数，和浏览次数
		//是否结束
		if ($reply['endtime'] < time()) {
			$this->message_tips($rid,'抱歉，活动已结束，下次早点来参与吧!');
		}
		//是否结束
		if(!empty($from_user)) {
			//获得用户资料
		    if($_W['member']['uid']){
			    $profile = mc_fetch($_W['member']['uid'], array('avatar','nickname','realname','mobile','groupid','qq','email','address','gender','telephone','idcard','company','occupation','position'));
		    }
		    //获得用户资料
			//获取粉丝信息
			if($reply['power']==2){
			    $userinfo = $this->get_userinfo($reply['power'],$rid,$iid,$page_fromuser,'shareview');
		    }
			//获取粉丝信息			
			//参与分享人信息 fans
		    $from_fans = pdo_fetch("select * from ".tablename('stonefish_scenesign_fans')." where rid = :rid and uniacid = :uniacid and from_user= :from_user", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $fromuser));
		    if(!empty($from_fans)){
			    $realname = empty($from_fans['realname']) ? stripcslashes($from_fans['nickname']) : $from_fans['realname'];
				if($from_fans['status']==0){
				    $this->message_tips($rid,'抱歉，活动中您的朋友可能有作弊行为已被管理员暂停屏蔽！请告之你的朋友〖'.$realname.'〗，Ta将不胜感激！by【'.$_W['account']['name'].'】',$share['xiu_url']);
			    }
		    }else{
			    $this->message_tips($rid,'抱歉，您的朋友没有参与本活动！请告之你的朋友！',$share['xiu_url']);
		    }
		}else{
			//跳转易企秀页
			header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $share['xiu_url'] . "");
            exit();
			//跳转易企秀页
		}
		if($from_user!=$fromuser){
			//添加分享人气记录
			$sharedata = pdo_fetch("SELECT * FROM ".tablename('stonefish_scenesign_sharedata')." WHERE share_type=1 and fromuser = :fromuser and rid = :rid and from_user = :from_user", array(':fromuser' => $fromuser,':from_user' => $from_user,':rid' => $rid));
			if(empty($sharedata)){
				$insertdata = array(
		            'uniacid'        => $uniacid,
					'share_type'     => 1,
					'who'            => '助力',
		            'from_user'      => $from_user,
		            'fromuser'       => $fromuser,
		            'avatar'         => $userinfo["headimgurl"],                            
		            'nickname'       => $userinfo["nickname"],
		            'rid'            => $rid,
		            'visitorsip'	 => getip(),
		            'visitorstime'   => time()
		        );
				pdo_insert('stonefish_scenesign_sharedata', $insertdata);
				$dataid = pdo_insertid();//取id
				//给分享人添加人气量
				$sharenum = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('stonefish_scenesign_sharedata')." WHERE share_type=1 and uniacid = :uniacid and fromuser = :fromuser and rid = :rid", array(':uniacid' => $uniacid,':fromuser' => $fromuser,':rid' => $rid));
				$updatelist = array(
		            'sharenum'  => $sharenum,
		            'sharetime' => time()
		        );
				pdo_update('stonefish_scenesign_fans',$updatelist,array('id' => $from_fans['id']));
			}
			//添加分享人气记录
			//跳转易企秀页
			header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $share['xiu_url'] . "");
            exit();
			//跳转易企秀页
		}else{
			header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $this->createMobileUrl('index', array('rid' => $rid)) . "");
            exit();
		}
	}
	//帮助页	
	//活动首页
	public function doMobileindex() {
        global $_GPC, $_W;
		$rid = intval($_GPC['rid']);        
		$uniacid = $_W['uniacid'];
		$acid = $_W['acid'];
        if (empty($rid)) {
            $this->message_tips($rid,'抱歉，参数错误！');
        }
        $reply = pdo_fetch("select * from " . tablename('stonefish_scenesign_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
		$exchange = pdo_fetch("select * FROM ".tablename("stonefish_scenesign_exchange")." where rid = :rid", array(':rid' => $rid));
		$template = pdo_fetch("select * from " . tablename('stonefish_scenesign_template') . " where id = :id", array(':id' => $reply['templateid']));
		$prize = pdo_fetchall("select * from " . tablename('stonefish_scenesign_prize') . " where rid = :rid order by `id` asc", array(':rid' => $rid));
        $share = pdo_fetch("select * from " . tablename('stonefish_scenesign_share') . " where rid = :rid and acid = :acid", array(':rid' => $rid,':acid' => $acid));
		//活动状态
		$this->check_reply($reply);
		//活动状态	
		//获取openid
		$openid = $this->get_openid();
		$from_user = $openid['openid'];
		$page_from_user = base64_encode(authcode($from_user, 'ENCODE'));
		//获取openid
        //获得关键词
        $reply['keyword']=  $this->rule_keyword($rid);
        //获得关键词		
		//获取openid以及头像昵称
		if(empty($from_user)) {
		    //没有获取openid跳转至引导页
            if (!empty($share['share_url'])) {
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $share['share_url'] . "");
                exit();
            }else{
				$this->message_tips($rid,'请关注公众号再参与活动');
			}
			//没有获取openid跳转至引导页			           
		}else{
			//查询是否为关注用户并查询是否需要关注粉丝参与活动否则跳转至引导页
			if($reply['issubscribe']>=1 && intval($_W['fans']['follow'])!=1){
			    //没有关注粉丝跳转至引导页
				if (!empty($share['share_url'])) {
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: " . $share['share_url'] . "");
                    exit();
                }else{
				    $this->message_tips($rid,'请关注公众号再参与活动');
			    }
				//没有关注粉丝跳转至引导页
			}
			//查询是否为关注用户并查询是否需要关注粉丝参与活动否则跳转至引导页
			//获得用户资料
		    if($_W['member']['uid']){
			    $profile = mc_fetch($_W['member']['uid'], array('avatar','nickname','realname','mobile','groupid','qq','email','address','gender','telephone','idcard','company','occupation','position'));
		    }
		    //获得用户资料
			//验证系统会员组
			if($reply['issubscribe']==6){
				$grouparr = (array)iunserializer($reply['sys_users']);
				if(!in_array($profile['groupid'], $grouparr)) {
					$this->message_tips($rid,$reply['sys_users_tips']);
				}
			}
			//验证系统会员组
			//获取粉丝信息
			if($reply['power']==2){
			    $userinfo = $this->get_userinfo($reply['power'],$rid,$iid,$page_fromuser,'index');
		    }
			//获取粉丝信息
		}
		//内部分组
		load()->func('tpl');
		$sql = 'SELECT id,parentid,gname as name FROM ' . tablename('stonefish_scenesign_group') . ' WHERE `uniacid` = :uniacid ORDER BY `parentid`, `displayorder` DESC';
		$group = pdo_fetchall($sql, array(':uniacid' => $_W['uniacid']), 'id');
		if (!empty($group)) {
			$parent = $children = array();
			foreach ($group as $cid => $cate) {
				if (!empty($cate['parentid'])) {
					$children[$cate['parentid']][] = $cate;
				} else {
					$parent[$cate['id']] = $cate;
				}
			}
		}
		//内部分组
		//查询是否参与活动并更新头像和昵称
		$fans = pdo_fetch("select * from ".tablename('stonefish_scenesign_fans')." where rid = :rid and uniacid = :uniacid and from_user= :from_user", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user));
		if(!empty($fans)){
			if($fans['status']==0){
				$real_name = empty($fans['realname']) ? stripcslashes($fans['nickname']) : $fans['realname'];
				$this->message_tips($rid,'抱歉，活动中您〖'.$real_name.'〗可能有作弊行为已被管理员暂停屏蔽！请联系【'.$_W['account']['name'].'】管理员');
			}
			//更新头像和昵称
			if($reply['power']==2){
				pdo_update('stonefish_scenesign_fans', array('avatar' => $userinfo['headimgurl'], 'nickname' => $userinfo['nickname']), array('id' => $fans['id']));
			}
			//更新头像和昵称
			//查询是否需要弹出填写兑奖资料
			if($fans['zhongjiang']){
				//自动读取会员信息存入FANS表中
				$ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
				foreach ($ziduan as $ziduans) {
					if($exchange['is'.$ziduans]){
			            if(!empty($profile[$ziduans]) && empty($fans[$ziduans])){
				            if($exchange['isfans']==2){
							    pdo_update('stonefish_scenesign_fans', array($ziduans => $profile[$ziduans]), array('id' => $fans['id']));
						    }else{
							    $$ziduans = true;
						    }
				        }else{
					        if(empty($fans[$ziduans])){
						        $$ziduans = true;
						    }
					    }
			        }
				}
				if($realname || $mobile || $qq || $email || $address || $gender || $telephone || $idcard || $company || $occupation || $position){
			       $isfansinfo = true;
				   $isfans = true;
			    }
				//自动读取会员信息存入FANS表中
			}
			//查询是否需要弹出填写兑奖资料
			//开启分组强制显示
			if($exchange['group'] && ((!empty($parent) && $fans['pcate']==0) || (!empty($children) && $fans['ccate']==0))){
				$fans='';
				$isfansinfo = true;
				$isfans = true;
			}
			//开启分组强制显示
		}else{
			//开启分组强制显示
			if(($exchange['group'] && !empty($parent)) || $reply['mobileverify']){
				$isfansinfo = true;
				$isfans = true;
			}else{
				//自动读取会员信息存入FANS表中
			    $ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
				foreach ($ziduan as $ziduans) {
					if($exchange['is'.$ziduans]){
			            if(!empty($profile[$ziduans])){
							//存在数据
				        }else{
					        $$ziduans = true;
					    }
			        }
				}
				if($realname || $mobile || $qq || $email || $address || $gender || $telephone || $idcard || $company || $occupation || $position){
			       $isfansinfo = true;
				   $isfans = true;
			    }
		        //自动读取会员信息存入FANS表中
				if($isfansinfo != true){
					//自动签到
				    $fansdata = array(
                    'rid' => $rid,
				    'uniacid' => $uniacid,
                    'from_user' => $from_user,
				    'avatar' => $userinfo['headimgurl'],
				    'nickname' => $userinfo['nickname'],
				    'tickettype' => $exchange['tickettype'],
                    'createtime' => time(),
                    );
                    pdo_insert('stonefish_scenesign_fans', $fansdata);
                    $fansid = pdo_insertid();
					//自动读取会员信息存入FANS表中
			        $ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
				    foreach ($ziduan as $ziduans) {
					    if($exchange['is'.$ziduans]){
			                if(!empty($profile[$ziduans])){
							    pdo_update('stonefish_scenesign_fans', array($ziduans => $profile[$ziduans]), array('id' => $fansid));
					        }
			            }
				    }
		            //自动读取会员信息存入FANS表中
			        //发送消息模板之参与模板
			        if($exchange['tmplmsg_participate']){
				        $this->seed_tmplmsg($from_user,$exchange['tmplmsg_participate'],$rid,array('do' =>'index', 'nickname' =>$userinfo['nickname']));
			        }
			        //发送消息模板之参与模板
			        //增加人数，和浏览次数
                    pdo_update('stonefish_scenesign_reply', array('fansnum' => $reply['fansnum'] + 1), array('id' => $reply['id']));
			        //增加人数，和浏览次数
					//开始抽奖
					$prize = pdo_fetchall("select * from " . tablename('stonefish_scenesign_prize') . " where rid = :rid order by `id` asc", array(':rid' => $rid));
					if(!empty($prize)){
						$this->choujiang($rid,$fansid);
					}
					//开始抽奖
				    //自动签到
				}
			}
			//开启分组强制显示
		}
		if($isfansinfo)$isfansshow=1;
		//查询是否参与活动并更新头像和昵称
		//兑奖参数重命名
		$isfansname = explode(',',$exchange['isfansname']);
		//兑奖参数重命名	
		//增加人数，和浏览次数
        pdo_update('stonefish_scenesign_reply', array('viewnum' => $reply['viewnum'] + 1), array('id' => $reply['id']));
		//增加人数，和浏览次数
		//所有签到人员列表
		$fansdata = pdo_fetchall("select * from ".tablename('stonefish_scenesign_fans')." where rid = :rid and uniacid = :uniacid and status=1 ORDER BY `id` desc", array(':rid' => $rid, ':uniacid' => $uniacid));
		if($exchange['group']){
			foreach ($fansdata as &$fansdatas) {
				$bumen1 = pdo_fetchcolumn("select gname from ".tablename('stonefish_scenesign_group')." where id = :id", array(':id' => $fansdatas['pcate']));
				$bumen2 = pdo_fetchcolumn("select gname from ".tablename('stonefish_scenesign_group')." where id = :id", array(':id' => $fansdatas['ccate']));
				if($bumen2)$bumen2='-'.$bumen2;
			    $fansdatas['bumen'] = $bumen1.$bumen2;
			}
		}
		//所有签到人员列表 bumen
		//分享信息
        $sharelink = $_W['siteroot'] .'app/'.substr($this->createMobileUrl('entry', array('rid' => $rid,'from_user' => $page_from_user,'entrytype' => 'shareview')),2);
        $sharetitle = empty($share['share_title']) ? '我正在参加这家公司的会议，他的公司不错！介绍给你' : $share['share_title'];
        $sharedesc = empty($share['share_desc']) ? '我正在参加这家公司的会议，他的公司不错！介绍给你，你也来参加吧！！' : str_replace("\r\n"," ", $share['share_desc']);
		$sharetitle = $this->get_share($rid,$from_user,$sharetitle);
		$sharedesc = $this->get_share($rid,$from_user,$sharedesc);
		if(!empty($share['share_img'])){
		    $shareimg = toimage($share['share_img']);
		}else{
		    $shareimg = toimage($reply['start_picurl']);
		}
		//分享信息
		if($this->Weixin()){
			include $this->template('index');
		}else{
			$this->Weixin();
		}
    }
	//活动首页
	//用户注册
	public function doMobileRegfans() {
        global $_GPC, $_W;
        $rid = intval($_GPC['rid']);        
		$uniacid = $_W['uniacid'];
		$reply = pdo_fetch("select * FROM " . tablename('stonefish_scenesign_reply') . " where rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
		//规则判断        
        if ($reply == false) {
            $this->json_encode(array("success"=>2, "msg"=>'规则出错！...'));
        }
        if($reply['isshow'] != 1){
            $this->json_encode(array("success"=>2, "msg"=>'活动暂停，请稍后...'));
        }
        if ($reply['starttime'] > time()) {
            $this->json_encode(array("success"=>2, "msg"=>'活动还没有开始呢，请等待...'));
        }
        if ($reply['endtime'] < time()) {
            $this->json_encode(array("success"=>2, "msg"=>'活动已经结束了，下次再来吧！'));
        }
        if ($reply['issubscribe']&&intval($_W['fans']['follow'])==0) {
            $this->json_encode(array("success"=>2, "msg"=>'请先关注公共账号再来参与活动！详情请查看规则！'));
        }
		//规则判断
		//获得用户资料
		if($_W['member']['uid']){
			$profile = mc_fetch($_W['member']['uid'], array('avatar','nickname','realname','mobile','groupid','qq','email','address','gender','telephone','idcard','company','occupation','position'));
		}
		//获得用户资料	
		//验证系统会员组
		if($reply['issubscribe']==6){
			$grouparr = (array)iunserializer($reply['sys_users']);
			if(!in_array($profile['groupid'], $grouparr)) {
				$this->json_encode(array("success"=>2, "msg"=>$reply['sys_users_tips']));
			}
		}
		//验证系统会员组
		//获取openid
		$openid = $this->get_openid();
		$from_user = $openid['openid'];
		$page_from_user = base64_encode(authcode($from_user, 'ENCODE'));
		//获取openid
		//获取粉丝信息
		if($reply['power']==2){
			$userinfo = $this->get_userinfo($reply['power'],$rid,$iid,$page_fromuser,'index');
		}
		//获取粉丝信息		
        //判断是否参与过
		$fans = pdo_fetch("select * from ".tablename('stonefish_scenesign_fans')." where rid = :rid and uniacid = :uniacid and from_user= :from_user", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user));
		if(!empty($fans)){
			$exchange = pdo_fetch("select * FROM ".tablename("stonefish_scenesign_exchange")." where rid = :rid", array(':rid' => $rid));
			//自动读取会员信息存入FANS表中
			$ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
			foreach ($ziduan as $ziduans){
				if($exchange['is'.$ziduans]){
					if(!empty($_GPC[$ziduans])){
				        pdo_update('stonefish_scenesign_fans', array($ziduans => $_GPC[$ziduans]), array('id' => $fans['id']));
				        if($exchange['isfans']){				            
                            if($ziduans=='email'){
								mc_update($_W['member']['uid'], array('email' => $_GPC['email']));
							}else{
								mc_update($_W['member']['uid'], array($ziduans => $_GPC[$ziduans],'email' => $profile['email']));
							}
				        }
					}
			    }
		    }
		    //自动读取会员信息存入FANS表中
			//是否开启内部分组
			if($exchange['group']){
				pdo_update('stonefish_scenesign_fans', array('pcate' => $_GPC['group_parent'],'ccate' => $_GPC['group_child']), array('id' => $fans['id']));
			}
			//是否开启内部分组
			$data = array(
                'success' => 1,
				'msg' => '恭喜，签到资料修改成功!',
            );
		}else{
			if($reply['mobileverify']==1 && !empty($_GPC['mobile'])){
				$mobileverify = pdo_fetch("select * FROM ".tablename("stonefish_scenesign_mobileverify")." where rid = :rid and uniacid = :uniacid and mobile = :mobile", array(':rid' => $rid,':uniacid' => $uniacid,':mobile' => $_GPC['mobile']));
				if(empty($mobileverify)){
					$this->json_encode(array("success"=>2, "msg"=>'未成功验证手机号，请确认手机号码！'));
				}elseif($mobileverify['verifytime']){
					$this->json_encode(array("success"=>2, "msg"=>'此手机号码已使用过，请确认手机号码！'));
				}elseif($mobileverify['status']!=2){
					$this->json_encode(array("success"=>2, "msg"=>'此手机号码还未审核，请等待管理员审核后再来参加！'));
				}
			}
			$exchange = pdo_fetch("select * FROM ".tablename("stonefish_scenesign_exchange")." where rid = :rid", array(':rid' => $rid));
			$fansdata = array(
                'rid' => $rid,
				'uniacid' => $uniacid,
                'from_user' => $from_user,
				'avatar' => $userinfo['headimgurl'],
				'nickname' => $userinfo['nickname'],
				'tickettype' => $exchange['tickettype'],
                'createtime' => time(),
            );
            pdo_insert('stonefish_scenesign_fans', $fansdata);
            $fans['id'] = pdo_insertid();
			if($reply['mobileverify']==1 && !empty($_GPC['mobile'])){
			    pdo_update('stonefish_scenesign_mobileverify', array('verifytime' => time()), array('id' => $mobileverify['id']));
			}
			if($_GPC['isfansinfo']){
				//自动读取会员信息存入FANS表中
			    $ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
			    foreach ($ziduan as $ziduans){
				    if($exchange['is'.$ziduans]){
					    if(!empty($_GPC[$ziduans])){
				            pdo_update('stonefish_scenesign_fans', array($ziduans => $_GPC[$ziduans]), array('id' => $fans['id']));
				            if($exchange['isfans']){
                                if($ziduans=='email'){
								    mc_update($_W['member']['uid'], array('email' => $_GPC['email']));
							    }else{
								    mc_update($_W['member']['uid'], array($ziduans => $_GPC[$ziduans],'email' => $profile['email']));
							    }
				            }
					    }
			        }
		        }
		        //自动读取会员信息存入FANS表中
			}
			//是否开启内部分组
			if($exchange['group']){
				pdo_update('stonefish_scenesign_fans', array('pcate' => $_GPC['group_parent'],'ccate' => $_GPC['group_child']), array('id' => $fans['id']));
			}
			//是否开启内部分组
			//发送消息模板之参与模板
			if($exchange['tmplmsg_participate']){
				$this->seed_tmplmsg($from_user,$exchange['tmplmsg_participate'],$rid,array('do' =>'index', 'nickname' =>$userinfo['nickname']));
			}
			//发送消息模板之参与模板
			//增加人数，和浏览次数
            pdo_update('stonefish_scenesign_reply', array('fansnum' => $reply['fansnum'] + 1), array('id' => $reply['id']));
			//增加人数，和浏览次数
			//开始抽奖
			$prize = pdo_fetchall("select * from " . tablename('stonefish_scenesign_prize') . " where rid = :rid order by `id` asc", array(':rid' => $rid));
			if(!empty($prize)){
				$prize_choujiang = $this->choujiang($rid,$fans['id']);
			}
			//开始抽奖
			$data = array(
                'success' => 1,
				'msg' => '恭喜，签到成功!<br/><br/>'.$prize_choujiang,
            );
		}
		//判断是否参与过
		$this->json_encode($data);
    }
	//用户注册
	//签到抽奖
	public function Choujiang($rid,$fansid) {
        global $_W;
		$uniacid = $_W['uniacid'];
		$reply = pdo_fetch("select power from " . tablename('stonefish_scenesign_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
		$exchange = pdo_fetch("select * FROM ".tablename("stonefish_scenesign_exchange")." where rid = :rid", array(':rid' => $rid));
		$fans = pdo_fetch("select * from ".tablename('stonefish_scenesign_fans')." where id= :id", array(':id' => $fansid));
        //获取openid
		$openid = $this->get_openid();
		$from_user = $openid['openid'];
		$page_from_user = base64_encode(authcode($from_user, 'ENCODE'));
		//获取openid
		//获取粉丝信息
		if($reply['power']==2){
			$userinfo = $this->get_userinfo($reply['power'],$rid,$iid,$page_from_user,'index');
		}
		//获取粉丝信息
		//所有奖品
		$gift = pdo_fetchall("select * from ".tablename('stonefish_scenesign_prize')." where rid = :rid and uniacid=:uniacid order by Rand()", array(':rid' => $rid,':uniacid' => $uniacid));
		//计算礼物中的最小概率
		$rate = 1;
		foreach ($gift as $giftxiao) {
			if ($giftxiao['probalilty']< 1&&$giftxiao['probalilty']> 0 && $giftxiao['prizetotal']-$giftxiao['prizedraw']>=1) {
                $temp = explode('.', $giftxiao['probalilty']);
                $temp = pow(10, strlen($temp[1]));
                $rate = $temp < $rate ? $rate : $temp;
            }
		}
		//计算礼物中的最小概率
        $prize_arr = array();
		foreach ($gift as $row) {
			if($row['prizetotal']-$row['prizedraw']>=1 && floatval($row['probalilty'])>0){
			    $item = array(
			    	'id'      => $row['id'],
				    'prize'   => $row['prizetype'],
				    'v'       => $row['probalilty'] * $rate,
			    );
				$prize_arr[] = $item;
				$isgift = true;
			}
			$probalilty += $row['probalilty'];
		}
		//所有奖品
		if($isgift){
			if(100-$probalilty>0){
				$item = array(
			    	'id'      => 0,
				    'prize'   => '好可惜！没有中奖',
				    'v'       => (100-$probalilty)*$rate,
			    );
			    $prize_arr[] = $item;
			}
			//开始刮奖咯
		    foreach ($prize_arr as $key => $val) {
   		        $arr[$val['id']] = $val['v'];
		    }
		    $prizeid = $this->get_rand($arr); //根据概率获取奖项id
            if($prizeid>0){
                $codesn = date("YmdHis").mt_rand(1000,9999);
				$status = 1;
				$consumetime = '';
				//查询奖品名称和类型				
				$awardinfo = pdo_fetch("select * from ".tablename('stonefish_scenesign_prize')." where id = :id", array(':id' =>$prizeid));
				//减少库存
				if($exchange['inventory']==1){
					pdo_update('stonefish_scenesign_prize', array('prizedraw' => $awardinfo['prizedraw'] + 1), array('id' => $prizeid));
				}
				//减少库存
				if($awardinfo['prizetype']!='physical' && $awardinfo['prizetype']!='virtual'){
		            $unisetting_s = uni_setting($uniacid, array('creditnames'));
		            foreach ($unisetting_s['creditnames'] as $key=>$credit) {
		    	        if ($awardinfo['prizetype']==$key) {
			    	        $credit_names = $credit['title'];
					        break;
			            }
		            }
			        //添加积分到粉丝数据库
			        mc_credit_update($_W['member']['uid'], $awardinfo['prizetype'], $awardinfo['prizevalue'], array($_W['member']['uid'], '会议签到中'.$awardinfo['prizevalue'].'个'.$credit_names));
			        //添加积分到粉丝数据库
				    $status = 2;
				    $consumetime = time();
					$fans['tickettype'] = 1;
					$fans['ticketid'] = 0;
					$fans['ticketname'] = '系统';
				    //减少库存
				    if($exchange['inventory']==2){
					    pdo_update('stonefish_scenesign_prize', array('prizedraw' => $awardinfo['prizedraw'] + 1), array('id' => $prizeid));
				    }
				    //减少库存
				}
				//中奖记录保存
			    $insert = array(
                    'uniacid' => $uniacid,
                    'rid' => $rid,                   
                    'from_user' => $from_user,
                    'prizeid' => $prizeid,
                    'codesn' => $codesn,
                    'createtime' => time(),
					'zhongjiangtime' => time(),
                    'consumetime' => $consumetime,
                    'zhongjiang' => $status,
					'tickettype' => $fans['tickettype'],
					'ticketid' => $fans['ticketid'],
					'ticketname' => $fans['ticketname'],
                );
				$temp = pdo_insert('stonefish_scenesign_fansaward', $insert);
				$fansawardid = pdo_insertid();//取id商家赠送时保存
				//中奖记录保存
				//发送消息模板之中奖记录
			    if($exchange['tmplmsg_winning']){
				    $this->seed_tmplmsg($from_user,$exchange['tmplmsg_winning'],$rid,array('do' =>'myaward','nickname' =>$fans['nickname'],'prizerating' =>$awardinfo['prizerating'],'prizename' =>$awardinfo['prizename']));
			    }
			    //发送消息模板之中奖记录
                //保存中奖人信息到fans中
                pdo_update('stonefish_scenesign_fans', array('zhongjiang' => 1), array('id' => $fans['id']));
				//保存中奖人信息到fans中
				if($status == 2){
				    //发送消息模板之兑奖记录
					if($exchange['tmplmsg_exchange']){
				       	$this->seed_tmplmsg($from_user,$exchange['tmplmsg_exchange'],$rid,array('do' =>'myaward', 'prizerating' =>$awardinfo['prizerating'], 'prizename' =>$awardinfo['prizename'], 'prizenum' =>1));
			       	}
					//发送消息模板之兑奖记录
				}
				$awardname = $awardinfo['prizename'];
            }else{
				$nojiang = iunserializer($reply['notawardtext']);
				$nojiangid = array_rand($nojiang);
			    $awardname =$nojiang[$nojiangid];
			}
        }else{
		    //没有奖品或没有资格的提示
			$noprize = iunserializer($reply['notprizetext']);
			$noprizeid = array_rand($noprize);
			$awardname =$noprize[$noprizeid];
		}
		return $awardname;
	}
	//签到抽奖
	//分享成功
	public function doMobileShare_confirm() {
        global $_GPC, $_W;
        $rid = intval($_GPC['rid']);
		$uniacid = $_W['uniacid'];
		$fromuser = authcode(base64_decode($_GPC['fromuser']), 'DECODE');
		$reply = pdo_fetch("select power from " . tablename('stonefish_scenesign_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
		//获取openid
		$openid = $this->get_openid();
		$from_user = $openid['openid'];
		$page_from_user = base64_encode(authcode($from_user, 'ENCODE'));
		//获取openid
		if(empty($fromuser)){
			$fromuser = $from_user;
		}
		//获得用户资料
		if($_W['member']['uid']){
			$profile = mc_fetch($_W['member']['uid'], array('avatar','nickname','realname','mobile','groupid','qq','email','address','gender','telephone','idcard','company','occupation','position'));
		}
		//获得用户资料
	    //获取粉丝信息
		if($reply['power']==2){
			$userinfo = $this->get_userinfo($reply['power'],$rid,$iid,$page_fromuser,'shareitem');
		}
		//获取粉丝信息
		$fans = pdo_fetch("select * from " . tablename('stonefish_scenesign_fans') . " where rid = :rid and uniacid = :uniacid and from_user = :from_user", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user));
		if ($fans == true) {
			//保存分享次数
			pdo_update('stonefish_scenesign_fans', array('share_num' => $fans['share_num']+1,'sharetime' => time()), array('id' => $fans['id']));
			$fanssharedata = array(
                'rid' => $rid,
			    'uniacid' => $uniacid,
			    'fromuser' => $fromuser,
				'from_user' => $from_user,
			    'avatar' => $userinfo['headimgurl'],
		        'nickname' => $userinfo['nickname'],
                'visitorsip' => getip(),
			    'visitorstime' => time(),
				'viewnum' =>1,
            );
		    pdo_insert('stonefish_scenesign_sharedata', $fanssharedata);
			$data = array(
                'msg' => '分享成功！',
                'success' => 1,
            );
		}else{
			$data = array(
                'msg' => '感觉您为您的好友分享此任务!',
                'success' => 0,
            );
		}
        $this->Json_encode($data);
    }
	//分享成功
	//活动规则
	public function doMobileRule() {
        global $_GPC, $_W;
        $rid = intval($_GPC['rid']);		
		$uniacid = $_W['uniacid'];
		$acid = $_W['acid'];
        if (empty($rid)) {
            $this->message_tips($rid,'抱歉，参数错误！');
        }		
		$reply = pdo_fetch("select * from " . tablename('stonefish_scenesign_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
		$template = pdo_fetch("select * from " . tablename('stonefish_scenesign_template') . " where id = :id", array(':id' => $reply['templateid']));
		$exchange = pdo_fetch("select * FROM ".tablename("stonefish_scenesign_exchange")." where rid = :rid", array(':rid' => $rid));
		$share = pdo_fetch("select * from " . tablename('stonefish_scenesign_share') . " where rid = :rid and acid = :acid", array(':rid' => $rid,':acid' => $acid));
        //活动状态
		$this->check_reply($reply);		
		//活动状态
		//查询奖品设置
		$prize = pdo_fetchall("select * FROM " . tablename('stonefish_scenesign_prize') . " where rid = :rid ORDER BY `break` asc", array(':rid' => $rid));
		//获取openid
		$openid = $this->get_openid();
		$from_user = $openid['openid'];
		$page_from_user = base64_encode(authcode($from_user, 'ENCODE'));
		//获取openid
		//获得用户资料
		if($_W['member']['uid']){
			$profile = mc_fetch($_W['member']['uid'], array('avatar','nickname','realname','mobile','groupid','qq','email','address','gender','telephone','idcard','company','occupation','position'));
		}
		//获得用户资料
	    //获取粉丝信息
		if($reply['power']==2){
			$userinfo = $this->get_userinfo($reply['power'],$rid,$iid,$page_fromuser,'shareitem');
		}
		//获取粉丝信息
		//查询是否参与活动并更新任务情况
		load()->func('tpl');
		$sql = 'SELECT id,parentid,gname as name FROM ' . tablename('stonefish_scenesign_group') . ' WHERE `uniacid` = :uniacid ORDER BY `parentid`, `displayorder` DESC';
		$group = pdo_fetchall($sql, array(':uniacid' => $_W['uniacid']), 'id');
		if (!empty($group)) {
			$parent = $children = array();
			foreach ($group as $cid => $cate) {
				if (!empty($cate['parentid'])) {
					$children[$cate['parentid']][] = $cate;
				} else {
					$parent[$cate['id']] = $cate;
				}
			}
		}
		//内部分组
		$fans = pdo_fetch("select * from ".tablename('stonefish_scenesign_fans')." where rid = :rid and uniacid = :uniacid and from_user= :from_user", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user));
		if(!empty($fans)){
			if($fans['status']==0){
				$real_name = empty($fans['realname']) ? stripcslashes($fans['nickname']) : $fans['realname'];
				$this->message_tips($rid,'抱歉，活动中您〖'.$real_name.'〗可能有作弊行为已被管理员暂停屏蔽！请联系【'.$_W['account']['name'].'】管理员');
			}
			//查询是否需要弹出填写兑奖资料
			if($fans['zhongjiang']){
				//自动读取会员信息存入FANS表中
				$ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
				foreach ($ziduan as $ziduans) {
					if($exchange['is'.$ziduans]){
			            if(!empty($profile[$ziduans]) && empty($fans[$ziduans])){
				            if($exchange['isfans']==2){
							    pdo_update('stonefish_scenesign_fans', array($ziduans => $profile[$ziduans]), array('id' => $fans['id']));
						    }else{
							    $$ziduans = true;
						    }
				        }else{
					        if(empty($fans[$ziduans])){
						        $$ziduans = true;
						    }
					    }
			        }
				}
				if($realname || $mobile || $qq || $email || $address || $gender || $telephone || $idcard || $company || $occupation || $position){
			       $isfansinfo = true;
				   $isfans = true;
			    }
				//自动读取会员信息存入FANS表中
			}
			//查询是否需要弹出填写兑奖资料
			//开启分组强制显示
			if($exchange['group'] && ((!empty($parent) && $fans['pcate']==0) || (!empty($children) && $fans['ccate']==0))){
				$fans='';
				$isfansinfo = true;
				$isfans = true;
			}
			//开启分组强制显示
		}else{
			//开启分组强制显示
			if(($exchange['group'] && !empty($parent)) || $reply['mobileverify']){
				$isfansinfo = true;
				$isfans = true;
			}else{	
				//自动读取会员信息存入FANS表中
			    $ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
				foreach ($ziduan as $ziduans) {
					if($exchange['is'.$ziduans]){
			            if(!empty($profile[$ziduans])){
							//存在数据
				        }else{
					        $$ziduans = true;
					    }
			        }
				}
				if($realname || $mobile || $qq || $email || $address || $gender || $telephone || $idcard || $company || $occupation || $position){
			       $isfansinfo = true;
				   $isfans = true;
			    }
		        //自动读取会员信息存入FANS表中
				if($isfansinfo != true){
					//自动签到
				    $fansdata = array(
                    'rid' => $rid,
				    'uniacid' => $uniacid,
                    'from_user' => $from_user,
				    'avatar' => $userinfo['headimgurl'],
				    'nickname' => $userinfo['nickname'],
				    'tickettype' => $exchange['tickettype'],
                    'createtime' => time(),
                    );
                    pdo_insert('stonefish_scenesign_fans', $fansdata);
                    $fansid = pdo_insertid();
					//自动读取会员信息存入FANS表中
			        $ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
				    foreach ($ziduan as $ziduans) {
					    if($exchange['is'.$ziduans]){
			                if(!empty($profile[$ziduans])){
							    pdo_update('stonefish_scenesign_fans', array($ziduans => $profile[$ziduans]), array('id' => $fansid));
					        }
			            }
				    }
		            //自动读取会员信息存入FANS表中
			        //发送消息模板之参与模板
			        if($exchange['tmplmsg_participate']){
				        $this->seed_tmplmsg($from_user,$exchange['tmplmsg_participate'],$rid,array('do' =>'index', 'nickname' =>$userinfo['nickname']));
			        }
			        //发送消息模板之参与模板
			        //增加人数，和浏览次数
                    pdo_update('stonefish_scenesign_reply', array('fansnum' => $reply['fansnum'] + 1), array('id' => $reply['id']));
			        //增加人数，和浏览次数
					//开始抽奖
					$prize = pdo_fetchall("select * from " . tablename('stonefish_scenesign_prize') . " where rid = :rid order by `id` asc", array(':rid' => $rid));
					if(!empty($prize)){
						$this->choujiang($rid,$fansid);
					}
					//开始抽奖
				    //自动签到
				}
			}
			//开启分组强制显示
		}
		//查询是否参与活动并更新任务情况
		//兑奖参数重命名
		$isfansname = explode(',',$exchange['isfansname']);
		//兑奖参数重命名
		//分享信息
        $sharelink = $_W['siteroot'] .'app/'.substr($this->createMobileUrl('entry', array('rid' => $rid,'from_user' => $page_from_user,'entrytype' => 'shareview')),2);
        $sharetitle = empty($share['share_title']) ? '我正在参加这家公司的会议，他的公司不错！介绍给你' : $share['share_title'];
        $sharedesc = empty($share['share_desc']) ? '我正在参加这家公司的会议，他的公司不错！介绍给你，你也来参加吧！！' : str_replace("\r\n"," ", $share['share_desc']);
		$sharetitle = $this->get_share($rid,$from_user,$sharetitle);
		$sharedesc = $this->get_share($rid,$from_user,$sharedesc);
		if(!empty($share['share_img'])){
		    $shareimg = toimage($share['share_img']);
		}else{
		    $shareimg = toimage($reply['start_picurl']);
		}
		//分享信息
		if($this->Weixin()){
			include $this->template('rule');
		}else{
			$this->Weixin();
		}
    }
	//活动规则
	//中奖名单
	public function doMobileGift() {
        global $_GPC, $_W;
        $rid = intval($_GPC['rid']);		
		$uniacid = $_W['uniacid'];
		$acid = $_W['acid'];
        if (empty($rid)) {
            $this->message_tips($rid,'抱歉，参数错误！');
        }
		$reply = pdo_fetch("select * from " . tablename('stonefish_scenesign_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
		$template = pdo_fetch("select * from " . tablename('stonefish_scenesign_template') . " where id = :id", array(':id' => $reply['templateid']));
		$exchange = pdo_fetch("select * FROM ".tablename("stonefish_scenesign_exchange")." where rid = :rid", array(':rid' => $rid));
		$prize = pdo_fetchall("select * from " . tablename('stonefish_scenesign_prize') . " where rid = :rid order by `id` asc", array(':rid' => $rid));
		$share = pdo_fetch("select * from " . tablename('stonefish_scenesign_share') . " where rid = :rid and acid = :acid", array(':rid' => $rid,':acid' => $acid));
        //活动状态
		$this->check_reply($reply);		
		//活动状态
		//中奖名单
		$rankorder = 'a.id';//awardnum奖品数量sharenum分享量sharepoint分享助力
		$gift = pdo_fetchall("select b.avatar,b.nickname,b.realname,b.mobile from " . tablename('stonefish_scenesign_fansaward') . " as a," . tablename('stonefish_scenesign_fans') . " as b where a.rid = :rid and a.uniacid = :uniacid and a.from_user = b.from_user and b.rid = :rid and b.uniacid = :uniacid order by ".$rankorder." desc limit ".$reply['viewawardnum'], array(':rid' => $rid,':uniacid' => $uniacid));
		//中奖名单
		//获取openid
		$openid = $this->get_openid();
		$from_user = $openid['openid'];
		$page_from_user = base64_encode(authcode($from_user, 'ENCODE'));
		//获取openid
		//获得用户资料
		if($_W['member']['uid']){
			$profile = mc_fetch($_W['member']['uid'], array('avatar','nickname','realname','mobile','groupid','qq','email','address','gender','telephone','idcard','company','occupation','position'));
		}
		//获得用户资料
	    //获取粉丝信息
		if($reply['power']==2){
			$userinfo = $this->get_userinfo($reply['power'],$rid,$iid,$page_fromuser,'shareitem');
		}
		//获取粉丝信息
		//查询是否参与活动并更新任务情况
		load()->func('tpl');
		$sql = 'SELECT id,parentid,gname as name FROM ' . tablename('stonefish_scenesign_group') . ' WHERE `uniacid` = :uniacid ORDER BY `parentid`, `displayorder` DESC';
		$group = pdo_fetchall($sql, array(':uniacid' => $_W['uniacid']), 'id');
		if (!empty($group)) {
			$parent = $children = array();
			foreach ($group as $cid => $cate) {
				if (!empty($cate['parentid'])) {
					$children[$cate['parentid']][] = $cate;
				} else {
					$parent[$cate['id']] = $cate;
				}
			}
		}
		//内部分组
		$fans = pdo_fetch("select * from ".tablename('stonefish_scenesign_fans')." where rid = :rid and uniacid = :uniacid and from_user= :from_user", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user));
		if(!empty($fans)){
			if($fans['status']==0){
				$real_name = empty($fans['realname']) ? stripcslashes($fans['nickname']) : $fans['realname'];
				$this->message_tips($rid,'抱歉，活动中您〖'.$real_name.'〗可能有作弊行为已被管理员暂停屏蔽！请联系【'.$_W['account']['name'].'】管理员');
			}
			//查询是否需要弹出填写兑奖资料
			if($fans['zhongjiang']){
				//自动读取会员信息存入FANS表中
				$ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
				foreach ($ziduan as $ziduans) {
					if($exchange['is'.$ziduans]){
			            if(!empty($profile[$ziduans]) && empty($fans[$ziduans])){
				            if($exchange['isfans']==2){
							    pdo_update('stonefish_scenesign_fans', array($ziduans => $profile[$ziduans]), array('id' => $fans['id']));
						    }else{
							    $$ziduans = true;
						    }
				        }else{
					        if(empty($fans[$ziduans])){
						        $$ziduans = true;
						    }
					    }
			        }
				}
				if($realname || $mobile || $qq || $email || $address || $gender || $telephone || $idcard || $company || $occupation || $position){
			       $isfansinfo = true;
				   $isfans = true;
			    }
				//自动读取会员信息存入FANS表中
			}
			//查询是否需要弹出填写兑奖资料
			//开启分组强制显示
			if($exchange['group'] && ((!empty($parent) && $fans['pcate']==0) || (!empty($children) && $fans['ccate']==0))){
				$fans='';
				$isfansinfo = true;
				$isfans = true;
			}
			//开启分组强制显示
		}else{
			//开启分组强制显示
			if(($exchange['group'] && !empty($parent)) || $reply['mobileverify']){
				$isfansinfo = true;
				$isfans = true;
			}else{	
				//自动读取会员信息存入FANS表中
			    $ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
				foreach ($ziduan as $ziduans) {
					if($exchange['is'.$ziduans]){
			            if(!empty($profile[$ziduans])){
							//存在数据
				        }else{
					        $$ziduans = true;
					    }
			        }
				}
				if($realname || $mobile || $qq || $email || $address || $gender || $telephone || $idcard || $company || $occupation || $position){
			       $isfansinfo = true;
				   $isfans = true;
			    }
		        //自动读取会员信息存入FANS表中
				if($isfansinfo != true){
					//自动签到
				    $fansdata = array(
                    'rid' => $rid,
				    'uniacid' => $uniacid,
                    'from_user' => $from_user,
				    'avatar' => $userinfo['headimgurl'],
				    'nickname' => $userinfo['nickname'],
				    'tickettype' => $exchange['tickettype'],
                    'createtime' => time(),
                    );
                    pdo_insert('stonefish_scenesign_fans', $fansdata);
                    $fansid = pdo_insertid();
					//自动读取会员信息存入FANS表中
			        $ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
				    foreach ($ziduan as $ziduans) {
					    if($exchange['is'.$ziduans]){
			                if(!empty($profile[$ziduans])){
							    pdo_update('stonefish_scenesign_fans', array($ziduans => $profile[$ziduans]), array('id' => $fansid));
					        }
			            }
				    }
		            //自动读取会员信息存入FANS表中
			        //发送消息模板之参与模板
			        if($exchange['tmplmsg_participate']){
				        $this->seed_tmplmsg($from_user,$exchange['tmplmsg_participate'],$rid,array('do' =>'index', 'nickname' =>$userinfo['nickname']));
			        }
			        //发送消息模板之参与模板
			        //增加人数，和浏览次数
                    pdo_update('stonefish_scenesign_reply', array('fansnum' => $reply['fansnum'] + 1), array('id' => $reply['id']));
			        //增加人数，和浏览次数
					//开始抽奖
					$prize = pdo_fetchall("select * from " . tablename('stonefish_scenesign_prize') . " where rid = :rid order by `id` asc", array(':rid' => $rid));
					if(!empty($prize)){
						$this->choujiang($rid,$fansid);
					}
					//开始抽奖
				    //自动签到
				}
			}
			//开启分组强制显示
		}
		//查询是否参与活动并更新任务情况
		//兑奖参数重命名
		$isfansname = explode(',',$exchange['isfansname']);
		//兑奖参数重命名
		//分享信息
        $sharelink = $_W['siteroot'] .'app/'.substr($this->createMobileUrl('entry', array('rid' => $rid,'from_user' => $page_from_user,'entrytype' => 'shareview')),2);
        $sharetitle = empty($share['share_title']) ? '我正在参加这家公司的会议，他的公司不错！介绍给你' : $share['share_title'];
        $sharedesc = empty($share['share_desc']) ? '我正在参加这家公司的会议，他的公司不错！介绍给你，你也来参加吧！！' : str_replace("\r\n"," ", $share['share_desc']);
		$sharetitle = $this->get_share($rid,$from_user,$sharetitle);
		$sharedesc = $this->get_share($rid,$from_user,$sharedesc);
		if(!empty($share['share_img'])){
		    $shareimg = toimage($share['share_img']);
		}else{
		    $shareimg = toimage($reply['start_picurl']);
		}
		//分享信息
		if($this->Weixin()){
			include $this->template('gift');
		}else{
			$this->Weixin();
		}
    }
	//中奖名单
	//我的奖品
	public function doMobileMyaward() {
        global $_GPC, $_W;
        $rid = intval($_GPC['rid']);		
		$uniacid = $_W['uniacid'];
		$acid = $_W['acid'];
        if (empty($rid)) {
            $this->message_tips($rid,'抱歉，参数错误！');
        }		
		$reply = pdo_fetch("select * from " . tablename('stonefish_scenesign_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
		$exchange = pdo_fetch("select * FROM ".tablename("stonefish_scenesign_exchange")." where rid = :rid", array(':rid' => $rid));
		$template = pdo_fetch("select * from " . tablename('stonefish_scenesign_template') . " where id = :id", array(':id' => $reply['templateid']));
		$prize = pdo_fetchall("select * from " . tablename('stonefish_scenesign_prize') . " where rid = :rid order by `id` asc", array(':rid' => $rid));
		$share = pdo_fetch("select * from " . tablename('stonefish_scenesign_share') . " where rid = :rid and acid = :acid", array(':rid' => $rid,':acid' => $acid));
        //活动状态
		$this->check_reply($reply);
		$nojiang = iunserializer($reply['notawardtext']);
		$nojiangid = array_rand($nojiang);
		$awardname =$this->get_prizename($rid,$nojiang[$nojiangid]);		
		//活动状态
		//获取openid
		$openid = $this->get_openid();
		$from_user = $openid['openid'];
		$page_from_user = base64_encode(authcode($from_user, 'ENCODE'));
		//获取openid
		//获得用户资料
		if($_W['member']['uid']){
			$profile = mc_fetch($_W['member']['uid'], array('avatar','nickname','realname','mobile','groupid','qq','email','address','gender','telephone','idcard','company','occupation','position'));
		}
		//获得用户资料
	    //获取粉丝信息
		if($reply['power']==2){
			$userinfo = $this->get_userinfo($reply['power'],$rid,$iid,$page_fromuser,'shareitem');
		}
		//获取粉丝信息
		//兑奖参数重命名
		$isfansname = explode(',',$exchange['isfansname']);
		//兑奖参数重命名
		//查询是否参与活动并更新任务情况
		load()->func('tpl');
		$sql = 'SELECT id,parentid,gname as name FROM ' . tablename('stonefish_scenesign_group') . ' WHERE `uniacid` = :uniacid ORDER BY `parentid`, `displayorder` DESC';
		$group = pdo_fetchall($sql, array(':uniacid' => $_W['uniacid']), 'id');
		if (!empty($group)) {
			$parent = $children = array();
			foreach ($group as $cid => $cate) {
				if (!empty($cate['parentid'])) {
					$children[$cate['parentid']][] = $cate;
				} else {
					$parent[$cate['id']] = $cate;
				}
			}
		}
		//内部分组
		$fans = pdo_fetch("select * from ".tablename('stonefish_scenesign_fans')." where rid = :rid and uniacid = :uniacid and from_user= :from_user", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user));
		if(!empty($fans)){
			if($fans['status']==0){
				$real_name = empty($fans['realname']) ? stripcslashes($fans['nickname']) : $fans['realname'];
				$this->message_tips($rid,'抱歉，活动中您〖'.$real_name.'〗可能有作弊行为已被管理员暂停屏蔽！请联系【'.$_W['account']['name'].'】管理员');
			}
			//查询是否需要弹出填写兑奖资料
			if($fans['zhongjiang']){
				//自动读取会员信息存入FANS表中
				$ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
				foreach ($ziduan as $ziduans) {
					if($exchange['is'.$ziduans]){
			            if(!empty($profile[$ziduans]) && empty($fans[$ziduans])){
				            if($exchange['isfans']==2){
							    pdo_update('stonefish_scenesign_fans', array($ziduans => $profile[$ziduans]), array('id' => $fans['id']));
						    }else{
							    $$ziduans = true;
						    }
				        }else{
					        if(empty($fans[$ziduans])){
						        $$ziduans = true;
						    }
					    }
			        }
				}
				if($realname || $mobile || $qq || $email || $address || $gender || $telephone || $idcard || $company || $occupation || $position){
			       $isfansinfo = true;
				   $isfans = true;
			    }
				//自动读取会员信息存入FANS表中
			}
			//查询是否需要弹出填写兑奖资料
			//开启分组强制显示
			if($exchange['group'] && ((!empty($parent) && $fans['pcate']==0) || (!empty($children) && $fans['ccate']==0))){
				$fans='';
				$isfansinfo = true;
				$isfans = true;
			}
			//开启分组强制显示
		}else{
			//开启分组强制显示
			if(($exchange['group'] && !empty($parent)) || $reply['mobileverify']){
				$isfansinfo = true;
				$isfans = true;
			}else{	
				//自动读取会员信息存入FANS表中
			    $ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
				foreach ($ziduan as $ziduans) {
					if($exchange['is'.$ziduans]){
			            if(!empty($profile[$ziduans])){
							//存在数据
				        }else{
					        $$ziduans = true;
					    }
			        }
				}
				if($realname || $mobile || $qq || $email || $address || $gender || $telephone || $idcard || $company || $occupation || $position){
			       $isfansinfo = true;
				   $isfans = true;
			    }
		        //自动读取会员信息存入FANS表中
				if($isfansinfo != true){
					//自动签到
				    $fansdata = array(
                    'rid' => $rid,
				    'uniacid' => $uniacid,
                    'from_user' => $from_user,
				    'avatar' => $userinfo['headimgurl'],
				    'nickname' => $userinfo['nickname'],
				    'tickettype' => $exchange['tickettype'],
                    'createtime' => time(),
                    );
                    pdo_insert('stonefish_scenesign_fans', $fansdata);
                    $fansid = pdo_insertid();
					//自动读取会员信息存入FANS表中
			        $ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
				    foreach ($ziduan as $ziduans) {
					    if($exchange['is'.$ziduans]){
			                if(!empty($profile[$ziduans])){
							    pdo_update('stonefish_scenesign_fans', array($ziduans => $profile[$ziduans]), array('id' => $fansid));
					        }
			            }
				    }
		            //自动读取会员信息存入FANS表中
			        //发送消息模板之参与模板
			        if($exchange['tmplmsg_participate']){
				        $this->seed_tmplmsg($from_user,$exchange['tmplmsg_participate'],$rid,array('do' =>'index', 'nickname' =>$userinfo['nickname']));
			        }
			        //发送消息模板之参与模板
			        //增加人数，和浏览次数
                    pdo_update('stonefish_scenesign_reply', array('fansnum' => $reply['fansnum'] + 1), array('id' => $reply['id']));
			        //增加人数，和浏览次数
					//开始抽奖
					$prize = pdo_fetchall("select * from " . tablename('stonefish_scenesign_prize') . " where rid = :rid order by `id` asc", array(':rid' => $rid));
					if(!empty($prize)){
						$this->choujiang($rid,$fansid);
					}
					//开始抽奖
				    //自动签到
				}
			}
			//开启分组强制显示
		}
		//查询是否参与活动并更新任务情况
		//查询是否需要弹出填写兑奖资料
		if($fans['zhongjiang']){
			//自动读取会员信息存入FANS表中
			$uid = pdo_fetchcolumn("select uid FROM ".tablename('mc_mapping_fans') ." where openid=:openid and uniacid=:uniacid",array(":openid"=>$from_user,":uniacid"=>$uniacid));
			$profile = mc_fetch($uid, array('avatar','nickname','realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position'));
			$ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
			foreach ($ziduan as $ziduans) {
				if($exchange['is'.$ziduans]){
			        if(!empty($profile[$ziduans]) && empty($fans[$ziduans])){
				        if($exchange['isfans']==2){
							pdo_update('stonefish_scenesign_fans', array($ziduans => $profile[$ziduans]), array('id' => $fans['id']));
						}else{
							$$ziduans = true;
						}
				    }else{
					    if(empty($fans[$ziduans])){
						    $$ziduans = true;
						}
					}
			    }
			}
			if($realname || $mobile || $qq || $email || $address || $gender || $telephone || $idcard || $company || $occupation || $position){
			    $isfans = $isfansshow = true;
			}
			//自动读取会员信息存入FANS表中
		}
		//查询是否需要弹出填写兑奖资料
		$mylihe = pdo_fetchall("select tt.* from(
select * from ".tablename('stonefish_scenesign_fansaward')." order by zhongjiang asc) as tt  where rid = :rid and uniacid = :uniacid and from_user = :from_user and zhongjiang>=1 GROUP BY prizeid order by `id` asc", array(':rid' => $rid,':uniacid' => $uniacid,':from_user' => $from_user));
		foreach ($mylihe as $mid => $mylihes) {
			$mylihe[$mid]['num'] = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid = :uniacid and from_user = :from_user and zhongjiang=1 and prizeid='".$mylihes['prizeid']."'", array(':rid' => $rid,':uniacid' => $uniacid,':from_user' => $from_user));
			$mylihe[$mid]['numd'] = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid = :uniacid and from_user = :from_user and zhongjiang=2 and prizeid='".$mylihes['prizeid']."'", array(':rid' => $rid,':uniacid' => $uniacid,':from_user' => $from_user));
			$prizes = pdo_fetch("select * from " . tablename('stonefish_scenesign_prize') . " where id='".$mylihes['prizeid']."'");
			$mylihe[$mid]['prizepic'] = $prizes['prizepic'];
			$mylihe[$mid]['prizerating'] = $prizes['prizerating'];
			$mylihe[$mid]['prizename'] = $prizes['prizename'];
			$mylihe[$mid]['prizetype'] = $prizes['prizetype'];
			$mylihe[$mid]['description'] = $prizes['description'];
			if(empty($mylihes['ticketname'])&&!empty($mylihes['ticketid'])){
				if($exchange['tickettype']==2){
				    $mylihe[$mid]['ticketname'] = pdo_fetchcolumn("select name FROM " . tablename('activity_coupon_password') . " where uniacid = :uniacid and id = :id", array(':uniacid' => $_W['uniacid'],':id' => $mylihes['ticketid']));
			    }
			    if($exchange['tickettype']==3){
				    $mylihe[$mid]['ticketname'] = pdo_fetchcolumn("select title FROM " . tablename('stonefish_branch_business') . " where uniacid = :uniacid and id = :id", array(':uniacid' => $_W['uniacid'],':id' => $mylihes['ticketid']));
			    }
			}
			$mylihe[$mid]['ticketid'] = empty($mylihe[$mid]['ticketid']) ? "0" : $mylihe[$mid]['ticketid'];
			$mylihe[$mid]['ticketname'] = empty($mylihe[$mid]['ticketname']) ? "没有选择" : $mylihe[$mid]['ticketname'];
		}
		//我的分享项目奖品
		//店员
		if($exchange['tickettype']==2){
			$shangjia = pdo_fetchall("select name as shangjianame,id FROM " . tablename('activity_coupon_password') . " where uniacid = :uniacid ORDER BY `id` asc", array(':uniacid' => $uniacid));
		}
		//商家网点
		if($exchange['tickettype']==3){
			$shangjia = pdo_fetchall("select title as shangjianame,id FROM " . tablename('stonefish_branch_business') . " where uniacid = :uniacid ORDER BY `id` DESC", array(':uniacid' => $uniacid));
		}
		//分享信息
        $sharelink = $_W['siteroot'] .'app/'.substr($this->createMobileUrl('entry', array('rid' => $rid,'from_user' => $page_from_user,'entrytype' => 'shareview')),2);
        $sharetitle = empty($share['share_title']) ? '我正在参加这家公司的会议，他的公司不错！介绍给你' : $share['share_title'];
        $sharedesc = empty($share['share_desc']) ? '我正在参加这家公司的会议，他的公司不错！介绍给你，你也来参加吧！！' : str_replace("\r\n"," ", $share['share_desc']);
		$sharetitle = $this->get_share($rid,$from_user,$sharetitle);
		$sharedesc = $this->get_share($rid,$from_user,$sharedesc);
		if(!empty($share['share_img'])){
		    $shareimg = toimage($share['share_img']);
		}else{
		    $shareimg = toimage($reply['start_picurl']);
		}
		//分享信息
		if($this->Weixin()){
			include $this->template('myaward');
		}else{
			$this->Weixin();
		}
    }
	//我的奖品
	//奖品展示
	public function doMobilePrizeinfo() {
        global $_GPC, $_W;
		$id = intval($_GPC['id']);
        if(empty($id)){
			$data = array(                    
			    'msg' => '奖品出错，请联系管理员！',
                'success' => 2,
            );
		}else{
			$item = pdo_fetch("select * FROM " . tablename('stonefish_scenesign_prize') . " where id = :id", array(':id' => $id));
			$daohangh = 300;
			if(!empty($item['awardingaddress'])){
				if(!empty($item['baidumaplng']) && !empty($item['baidumaplat'])){
					$daohang = '<div class="btnduihuan" style="margin:5px;height: 35px;"><a href="http://api.map.baidu.com/marker?location='.$item['baidumaplat'].','.$item['baidumaplng'].'&title='.urlencode('兑奖地点').'&content='.urlencode($item['awardingaddress']).'&output=html"><h2 class="biaoti_address">'.$item['awardingaddress'].'</a></h2></div>';
				}else{
					$daohang = '<div class="btnduihuan" style="margin:5px;height: 35px;"><h2 class="biaoti_address">'.$item['awardingaddress'].'</h2></div>';
				}				
				$daohangh += 40;
			}
			if(!empty($item['awardingtel'])){
				$daohang .= '<div class="btnduihuan" style="margin:5px;height: 35px;"><a href="tel:'.$item['awardingtel'].'"><h2 class="biaoti_tel">'.$item['awardingtel'].'</h2></a></div>';
				$daohangh += 40;
			}
			$data = array(                    
			    'prizepic' => toimage($item['prizepic']),
				'description' => str_replace("\n","<br>",$item['description']),
                'success' => 1,
				'daohang' => $daohang,
				'daohangh' => $daohangh,
            );
			
		}
		$this->Json_encode($data);
    }
	//奖品展示
	//兑奖商家
	public function doMobileExchange_shangjia() {
        global $_GPC, $_W;
		$uniacid = $_W['uniacid'];
		$rid = intval($_GPC['rid']);
		//获取openid
		$from_user = authcode(base64_decode($_GPC['from_user']), 'DECODE');
		//获取openid
		$shangjiaid = $_GPC['shangjiaid'];
		if(empty($from_user)){
			$data = array(                    
			    'msg' => '系统出错，兑奖人出错，请联系管理员！',
                'success' => 2,
            );
			$this->Json_encode($data);
		}
		if(!empty($rid)){
			$reply = pdo_fetch("select * FROM " . tablename('stonefish_scenesign_reply') . " where rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
			$exchange = pdo_fetch("select * FROM ".tablename("stonefish_scenesign_exchange")." where rid = :rid", array(':rid' => $rid));
		}else{
			$data = array(                    
			    'msg' => '系统出错，活动规则！请联系管理员',
                'success' => 2,
            );
			$this->Json_encode($data);
		}
		if(empty($shangjiaid)){
			$data = array(                    
			    'msg' => '请选择商家或门店',
                'success' => 2,
            );
			$this->Json_encode($data);
		}
		$fansaward = pdo_fetch("select * from " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid = :uniacid and from_user = :from_user and zhongjiang=1", array(':rid' => $rid,':uniacid' => $uniacid,':from_user' => $from_user));
		if(!empty($fansaward)){
		    if($exchange['tickettype']==2){
				$ticketname = pdo_fetchcolumn("select name FROM " . tablename('activity_coupon_password') . " where uniacid = :uniacid and id = :id", array(':uniacid' => $uniacid,':id' => $shangjiaid));
			}
			if($exchange['tickettype']==3){
				$ticketname = pdo_fetchcolumn("select title FROM " . tablename('stonefish_branch_business') . " where uniacid = :uniacid and id = :id", array(':uniacid' => $uniacid,':id' => $shangjiaid));
			}
			if($_GPC['award_id']=='all'){
			    pdo_update('stonefish_scenesign_fansaward', array('tickettype' => $exchange['tickettype'],'ticketid' => $shangjiaid,'ticketname' => $ticketname), array('rid' => $rid, 'uniacid' => $uniacid, 'from_user' => $from_user, 'zhongjiang' => 1));
			    pdo_update('stonefish_scenesign_fans', array('tickettype' => $exchange['tickettype'],'ticketid' => $shangjiaid,'ticketname' => $ticketname), array('rid' => $rid, 'uniacid' => $uniacid, 'from_user' => $from_user));
			}else{
				pdo_update('stonefish_scenesign_fansaward', array('tickettype' => $exchange['tickettype'],'ticketid' => $shangjiaid,'ticketname' => $ticketname), array('rid' => $rid, 'uniacid' => $uniacid, 'from_user' => $from_user, 'zhongjiang' => 1, 'prizeid' =>$_GPC['award_id']));
			    pdo_update('stonefish_scenesign_fans', array('tickettype' => $exchange['tickettype'],'ticketid' => $shangjiaid,'ticketname' => $ticketname), array('rid' => $rid, 'uniacid' => $uniacid, 'from_user' => $from_user));
			}
			$data = array(                    
			    'msg' => '数据保存成功！请返回兑奖！',
                'success' => 1,
            );
			$this->Json_encode($data);
		}else{
			$data = array(                    
			    'msg' => '穿越了，没有中奖呀，亲！',
                'success' => 2,
            );
			$this->Json_encode($data);
		}
	}
	//兑奖商家
	//兑奖
	public function doMobileExchange() {
        global $_GPC, $_W;
		$uniacid = $_W['uniacid'];
        $awardid = $_GPC['awardid'];
		$rid = intval($_GPC['rid']);
		$shangjiaid = intval($_GPC['dianmian']);
		$password = $_GPC['mima'];
		//获取openid
		$from_user = authcode(base64_decode($_GPC['from_user']), 'DECODE');
		//获取openid
		if(empty($from_user)){
			$data = array(
			    'msg' => '系统出错，兑奖人出错，请联系管理员！',
                'success' => 2,
            );
			$this->Json_encode($data);
		}
		if(empty($password)){
			$data = array(                    
			    'msg' => '请输入密码',
                'success' => 2,
            );
			$this->Json_encode($data);
		}
		if(empty($awardid)){
			$data = array(                    
			    'msg' => '奖品ID出错！请联系管理员',
                'success' => 2,
            );
			$this->Json_encode($data);
		}
		if(!empty($rid)){
			$reply = pdo_fetch("select * FROM " . tablename('stonefish_scenesign_reply') . " where rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
			$exchange = pdo_fetch("select * FROM ".tablename("stonefish_scenesign_exchange")." where rid = :rid", array(':rid' => $rid));
		}else{
			$data = array(                    
			    'msg' => '系统出错，活动规则！请联系管理员',
                'success' => 2,
            );
			$this->Json_encode($data);
		}
		if($exchange['tickettype']==5){
			$prize = pdo_fetch("select * FROM " . tablename('stonefish_scenesign_prize') . " where id = :id", array(':id' => $awardid));
			if($prize['password']!=$password){
				$data = array(                    
			        'msg' => '系统出错，兑奖密码不匹配！',
                    'success' => 2,
                );
			    $this->Json_encode($data);
			}
			$prizenum = pdo_fetchcolumn("select count(id) FROM " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid =:uniacid and from_user =:from_user and prizeid =:prizeid and zhongjiang=1", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user, ':prizeid' => $awardid));
			pdo_update('stonefish_scenesign_fansaward', array('tickettype' => $exchange['tickettype'],'zhongjiang' => 2, 'consumetime' => time()), array('rid' => $rid, 'uniacid' => $uniacid, 'from_user' => $from_user, 'prizeid' => $awardid, 'zhongjiang' => 1));
			pdo_update('stonefish_scenesign_fans', array('tickettype' => $exchange['tickettype'],'zhongjiang' => 2), array('rid' => $rid, 'uniacid' => $uniacid, 'from_user' => $from_user));
			//减少库存
			if($exchange['inventory']==2){
				pdo_update('stonefish_scenesign_prize', array('prizedraw' => $prize['prizedraw'] + $prizenum), array('id' => $awardid));
			}
		    //减少库存
			$prizetime = pdo_fetchcolumn("select createtime FROM " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid =:uniacid and from_user =:from_user and prizeid =:prizeid and zhongjiang>=1", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user, ':prizeid' => $awardid));
			//发送消息模板之奖记录
			if($exchange['tmplmsg_exchange']){
				$this->seed_tmplmsg($from_user,$exchange['tmplmsg_exchange'],$rid,array('do' =>'myaward', 'prizerating' =>$prize['prizerating'], 'prizename' =>$prize['prizename'], 'prizenum' =>$prizenum, 'prizetime' =>$prizetime));
			}
			//发送消息模板之奖记录
			$data = array(                    
			    'msg' => '恭喜兑奖成功！',
                'success' => 1,
            );
			$this->Json_encode($data);
		}elseif($exchange['tickettype']==4){
			if($exchange['awardingpas']!=$password){
				$data = array(                    
			        'msg' => '系统出错，兑奖密码或账号不匹配！',
                    'success' => 2,
                );
			    $this->Json_encode($data);
			}else{
				if($awardid=='all'){
					$prizenum = pdo_fetchcolumn("select count(id) FROM " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid =:uniacid and from_user =:from_user and zhongjiang=1", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user));
					pdo_update('stonefish_scenesign_fansaward', array('tickettype' => $exchange['tickettype'],'zhongjiang' => 2, 'consumetime' => time()), array('rid' => $rid, 'uniacid' => $uniacid, 'from_user' => $from_user, 'zhongjiang' => 1));
					pdo_update('stonefish_scenesign_fans', array('tickettype' => $exchange['tickettype'],'zhongjiang' => 2), array('rid' => $rid, 'uniacid' => $uniacid, 'from_user' => $from_user));
					//减少库存
					if($exchange['inventory']==1){
					    $prize = pdo_fetchall("select * FROM " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid =:uniacid and from_user =:from_user and zhongjiang=1", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user));
						foreach ($prize as $prizes) {
							pdo_update('stonefish_scenesign_prize', array('prizedraw' => $prizes['prizedraw'] + 1), array('id' => $prizes['id']));
						}
				    }
					//减少库存
					$prizetime = pdo_fetchcolumn("select createtime FROM " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid =:uniacid and from_user =:from_user and zhongjiang>=1", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user));
					//发送消息模板之奖记录
					if($exchange['tmplmsg_exchange']){
				        $this->seed_tmplmsg($from_user,$exchange['tmplmsg_exchange'],$rid,array('do' =>'myaward', 'prizerating' =>'所有', 'prizename' =>'奖品', 'prizenum' =>$prizenum, 'prizetime' =>$prizetime));
			        }
					//发送消息模板之奖记录
				}else{
					$prizenum = pdo_fetchcolumn("select count(id) FROM " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid =:uniacid and from_user =:from_user and prizeid =:prizeid and zhongjiang=1", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user, ':prizeid' => $awardid));
					pdo_update('stonefish_scenesign_fansaward', array('tickettype' => $exchange['tickettype'],'zhongjiang' => 2, 'consumetime' => time()), array('rid' => $rid, 'uniacid' => $uniacid, 'from_user' => $from_user, 'prizeid' => $awardid, 'zhongjiang' => 1));
					pdo_update('stonefish_scenesign_fans', array('tickettype' => $exchange['tickettype'],'zhongjiang' => 2), array('rid' => $rid, 'uniacid' => $uniacid, 'from_user' => $from_user));
					//减少库存
					if($exchange['inventory']==2){
					    pdo_update('stonefish_scenesign_prize', array('prizedraw' => $prize['prizedraw'] + $prizenum), array('id' => $awardid));
				    }
					//减少库存
					$prize = pdo_fetch("select * FROM " . tablename('stonefish_scenesign_prize') . " where id = :id", array(':id' => $awardid));
					$prizetime = pdo_fetchcolumn("select createtime FROM " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid =:uniacid and from_user =:from_user and prizeid =:prizeid and zhongjiang>=1", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user, ':prizeid' => $awardid));
					//发送消息模板之奖记录
					if($exchange['tmplmsg_exchange']){
				        $this->seed_tmplmsg($from_user,$exchange['tmplmsg_exchange'],$rid,array('do' =>'myaward', 'prizerating' =>$prize['prizerating'], 'prizename' =>$prize['prizename'], 'prizenum' =>$prizenum, 'prizetime' =>$prizetime));
			        }
					//发送消息模板之奖记录
				}
				$data = array(                    
			        'msg' => '恭喜兑奖成功！',
                    'success' => 1,
                );
			    $this->Json_encode($data);
			}
		}else{
			if(empty($shangjiaid)){
			    $data = array(                    
			        'msg' => '请选择店名或商家网点',
                    'success' => 2,
                );
			    $this->Json_encode($data);
		    }
			if($exchange['tickettype']==2){
			    //店员
			    $shangjia = pdo_fetch("select name as shangjianame,id FROM " . tablename('activity_coupon_password') . " where uniacid = :uniacid and id = :id and password = :password", array(':uniacid' => $uniacid,':id' => $shangjiaid,':password' => $password));
			    if(!empty($shangjia)){
				    $duijiangmima = 1;
			    }
		    }elseif($exchange['tickettype']==3){
			    //商家网点
			    $shangjia = pdo_fetch("select title as shangjianame,id FROM " . tablename('stonefish_branch_business') . " where uniacid = :uniacid and id = :id and password = :password", array(':uniacid' => $uniacid,':id' => $shangjiaid,':password' => $password));
			    if(!empty($shangjia)){
				    $duijiangmima = 1;
			    }
		    }
			if($duijiangmima==1){
				if($awardid=='all'){
					$prizenum = pdo_fetchcolumn("select count(id) FROM " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid =:uniacid and from_user =:from_user and zhongjiang=1", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user));
					pdo_update('stonefish_scenesign_fansaward', array('tickettype' => $exchange['tickettype'],'ticketid' => $shangjiaid,'ticketname' => $shangjia['shangjianame'],'zhongjiang' => 2, 'consumetime' => time()), array('rid' => $rid, 'uniacid' => $uniacid, 'from_user' => $from_user, 'zhongjiang' => 1));
					pdo_update('stonefish_scenesign_fans', array('tickettype' => $exchange['tickettype'],'ticketid' => $shangjiaid,'ticketname' => $shangjia['shangjianame'],'zhongjiang' => 2), array('rid' => $rid, 'uniacid' => $uniacid, 'from_user' => $from_user));
					//减少库存
					if($exchange['inventory']==1){
					    $prize = pdo_fetchall("select * FROM " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid =:uniacid and from_user =:from_user and zhongjiang=1", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user));
						foreach ($prize as $prizes) {
							pdo_update('stonefish_scenesign_prize', array('prizedraw' => $prizes['prizedraw'] + 1), array('id' => $prizes['id']));
						}
				    }
					//减少库存
					$prizetime = pdo_fetchcolumn("select createtime FROM " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid =:uniacid and from_user =:from_user and prizeid =:prizeid and zhongjiang>=1", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user, ':prizeid' => $awardid));
					//发送消息模板之奖记录
					if($exchange['tmplmsg_exchange']){
				        $this->seed_tmplmsg($from_user,$exchange['tmplmsg_exchange'],$rid,array('do' =>'myaward', 'prizerating' =>'所有', 'prizename' =>'奖品', 'prizenum' =>$prizenum, 'prizetime' =>$prizetime));
			        }
					//发送消息模板之奖记录
				}else{
					$prizenum = pdo_fetchcolumn("select count(id) FROM " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid =:uniacid and from_user =:from_user and prizeid =:prizeid and zhongjiang=1", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user, ':prizeid' => $awardid));
					$prize = pdo_fetch("select * FROM " . tablename('stonefish_scenesign_prize') . " where id='" . $awardid . "'");
					pdo_update('stonefish_scenesign_fansaward', array('tickettype' => $exchange['tickettype'],'ticketid' => $shangjiaid,'ticketname' => $shangjia['shangjianame'],'zhongjiang' => 2, 'consumetime' => time()), array('rid' => $rid, 'uniacid' => $uniacid, 'from_user' => $from_user, 'prizeid' => $awardid, 'zhongjiang' => 1));
					pdo_update('stonefish_scenesign_fans', array('tickettype' => $exchange['tickettype'],'ticketid' => $shangjiaid,'ticketname' => $shangjia['shangjianame'],'zhongjiang' => 2), array('rid' => $rid, 'uniacid' => $uniacid, 'from_user' => $from_user));
					//减少库存
					if($exchange['inventory']==2){
					    pdo_update('stonefish_scenesign_prize', array('prizedraw' => $prize['prizedraw'] + $prizenum), array('id' => $awardid));
				    }
					//减少库存
					$prizetime = pdo_fetchcolumn("select createtime FROM " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid =:uniacid and from_user =:from_user and prizeid =:prizeid and zhongjiang>=1", array(':rid' => $rid, ':uniacid' => $uniacid, ':from_user' => $from_user, ':prizeid' => $awardid));
					//发送消息模板之奖记录
					if($exchange['tmplmsg_exchange']){
				        $this->seed_tmplmsg($from_user,$exchange['tmplmsg_exchange'],$rid,array('do' =>'myaward', 'prizerating' =>$prize['prizerating'], 'prizename' =>$prize['prizename'], 'prizenum' =>$prizenum, 'prizetime' =>$prizetime));
			        }
					//发送消息模板之奖记录
				}
			    //添加兑奖记录到商家网点
			    if($exchange['tickettype']==3){			
			        $content = '兑奖成功';
			        $insert = array(
                        'uniacid' => $uniacid,
                        'rid' => $rid,
                        'module' => 'stonefish_scenesign',
                        'fansID' => $_W['member']['uid'],
				        'mobile' => $fans['mobile'],
				        'bid' => $shangjiaid,
                        'content' =>$content,
				        'createtime' => time()
                    );
			        pdo_insert('stonefish_branch_duijiang', $insert);
			    }
			    //添加兑奖记录到商家网点
		        $data = array(                    
			        'msg' => '恭喜兑奖成功！',
                    'success' => 1,
                );
			    $this->Json_encode($data);
		    }else{
			    $data = array(                    
			        'msg' => '系统出错，兑奖密码或账号不匹配！',
                    'success' => 2,
                );
			    $this->Json_encode($data);
		    }
		}	
	}
	//兑奖
	//参数配置
	public function config(){
		//查询是否填写系统参数
		$setting = $this->module['config'];
		if(empty($setting)){
			message('抱歉，系统参数没有填写，请先填写系统参数！', url('profile/module/setting',array('m' => 'stonefish_scenesign')), 'error');
		}
		//查询是否填写系统参数
	}
	//参数配置
	//活动管理
	public function doWebManage() {
        global $_GPC, $_W;
        $this->config();
		$params = array(':uniacid' => $_W['uniacid']);
		if (!empty($_GPC['keyword'])) {
            $where = ' AND `title` LIKE :keyword';
            $params[':keyword'] = "%{$_GPC['keyword']}%";
        }
        $total = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_reply') . "  where uniacid=:uniacid " . $where . "", $params);
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $pager = pagination($total, $pindex, $psize);
        $start = ($pindex - 1) * $psize;
        $limit .= " LIMIT {$start},{$psize}";
        $list = pdo_fetchall("select * from " . tablename('stonefish_scenesign_reply') . " where uniacid=:uniacid " . $where . " order by id desc " . $limit, $params);

        if (!empty($list)) {
            foreach ($list as &$item) {
                $item['start_time'] = date('Y-m-d H:i', $item['starttime']);
                $item['end_time'] = date('Y-m-d H:i', $item['endtime']);
                $nowtime = time();
                if ($item['starttime'] > $nowtime) {
                    $item['status'] = '<span class="label label-warning">未开始</span>';
                    $item['show'] = 1;
                } elseif ($item['endtime'] < $nowtime) {
                    $item['status'] = '<span class="label label-default ">已结束</span>';
                    $item['show'] = 0;
                } else {
                    if ($item['isshow'] == 1) {
                        $item['status'] = '<span class="label label-success">已开始</span>';
                        $item['show'] = 2;
                    } else {
                        $item['status'] = '<span class="label label-default ">已暂停</span>';
                        $item['show'] = 1;
                    }
                }
            }
        }
        include $this->template('manage');
    }
	//活动管理
	//内部分组
	public function doWebGroup() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_W, $_GPC;
		checklogin();
		//查询是否参数设置过
		$moduleconfig = $this->module['config'];
		if(empty($moduleconfig)){
			message('抱歉，系统参数没有填写，请先填写系统参数！', Url('profile/module/setting',array('m'=>'stonefish_scenesign')), 'error');
		}
		//查询是否参数设置过
		load()->func('tpl');
		$op = $_GPC['op'];
		$dos = array('category', 'postcategory', 'delcategory');
        $op = in_array($op, $dos) ? $op : 'category';
		
		if ($op == 'category') {
			if (!empty($_GPC['displayorder'])) {
				foreach ($_GPC['displayorder'] as $id => $displayorder) {
					$update = array('displayorder' => $displayorder);
					pdo_update('stonefish_scenesign_group', $update, array('id' => $id));					
				}
				message('会员分组排序更新成功！', 'refresh', 'success');
			}
			$children = array();
			$category = pdo_fetchall("SELECT * FROM ".tablename('stonefish_scenesign_group')." WHERE uniacid = '{$_W['uniacid']}' ORDER BY parentid, displayorder DESC, id");
			foreach ($category as $index => $row) {
				if (!empty($row['parentid'])){
					$children[$row['parentid']][] = $row;
					unset($category[$index]);
				}
			}
		}
		if($op == 'postcategory'){
	        $parentid = intval($_GPC['parentid']);
	        $id = intval($_GPC['id']);		    
	        if(!empty($id)) {
		        $category = pdo_fetch("SELECT * FROM ".tablename('stonefish_scenesign_group')." WHERE id = '$id' AND uniacid = {$_W['uniacid']}");
		        if(empty($category)) {
			        message('会员分组不存在或已删除', '', 'error');
	        	}		        
	        } else {
		        $category = array(
			        'displayorder' => 0,			       
		        );
	        }
	        if (!empty($parentid)) {
		        $parent = pdo_fetch("SELECT id, gname FROM ".tablename('stonefish_scenesign_group')." WHERE id = '$parentid'");
		        if (empty($parent)) {
			        message('抱歉，上级分类不存在或是已经被删除！', url('site/entry/group', array('op'=>'category','m' => 'stonefish_scenesign')), 'error');
		        }
	        }

	        if (checksubmit('submit')) {
		        if (empty($_GPC['gname'])) {
			        message('抱歉，请输入会员分组名称！');
		        }
		        $data = array(
			        'uniacid' => $_W['uniacid'],
			        'gname' => $_GPC['gname'],
			        'displayorder' => intval($_GPC['displayorder']),
			        'parentid' => intval($parentid),
			        'description' => $_GPC['description'],					
		        );		       
		        
		        if (!empty($id)) {
			        unset($data['parentid']);
			        pdo_update('stonefish_scenesign_group', $data, array('id' => $id));
		        } else {
			        pdo_insert('stonefish_scenesign_group', $data);
			        $id = pdo_insertid();
		        }
		        message('更新会员分组成功！', url('site/entry/group', array('op'=>'category','m' => 'stonefish_scenesign')), 'success');
	        }
		}
		if ($op == 'delcategory') {
			$id = intval($_GPC['id']);
	        $category = pdo_fetch("SELECT * FROM ".tablename('stonefish_scenesign_group')." WHERE id = '$id'");
	        if (empty($category)) {
		        message('抱歉，会员分组不存在或是已经被删除！', url('site/entry/group', array('op'=>'category','m' => 'stonefish_scenesign')), 'error');
	        }
			pdo_delete('stonefish_scenesign_group', array('id' => $id, 'parentid' => $id), 'OR');
			message('会员分组删除成功！', url('site/entry/group', array('op'=>'category','m' => 'stonefish_scenesign')), 'success');
		}
		
		include $this->template('group');
	}
	//内部分组
	//活动分析表
	public function doWebTrend() {
        global $_GPC, $_W;
		load()->func('tpl');
		$this->config();
		//查询do参数
		if(empty($_GPC['do'])){
			$_GPC['do'] = pdo_fetchcolumn("select do from " . tablename('modules_bindings') . "  where eid = :eid and module=:module", array(':eid' => $_GPC['eid'], ':module' => 'stonefish_scenesign'));
		}
		//查询do参数
        $rid = intval($_GPC['rid']);
		$rid = empty($rid) ? intval($_GPC['id']) : $rid;
		$reply = pdo_fetch("select * FROM " . tablename('stonefish_scenesign_reply') . " where rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
		//所有奖品类别
		$award = pdo_fetchall("select * FROM " . tablename('stonefish_scenesign_prize') . " where rid = :rid and uniacid=:uniacid ORDER BY `id` asc", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//中奖数量
		$reply['zhongjiangnum'] = pdo_fetchcolumn("select count(id) FROM " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid=:uniacid and zhongjiang>=1", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//领取数量
		//所有奖品类别
		//今日昨天关键指标
		$fansnum = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('stonefish_scenesign_fans') . ' WHERE rid = :rid AND uniacid = :uniacid AND createtime >= :starttime AND createtime <= :endtime', array(':rid' => $rid, ':uniacid' => $_W['uniacid'], ':starttime' => strtotime(date('Y-m-d')) - 86400, ':endtime' => strtotime(date('Y-m-d'))));
		$zhongjiangnum = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('stonefish_scenesign_fansaward') . ' WHERE rid = :rid AND uniacid = :uniacid AND createtime >= :starttime AND createtime <= :endtime and zhongjiang>=1', array(':rid' => $rid, ':uniacid' => $_W['uniacid'], ':starttime' => strtotime(date('Y-m-d')) - 86400, ':endtime' => strtotime(date('Y-m-d'))));
		
		$today_fansnum = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('stonefish_scenesign_fans') . ' WHERE rid = :rid AND uniacid = :uniacid AND createtime >= :starttime AND createtime <= :endtime', array(':rid' => $rid, ':uniacid' => $_W['uniacid'], ':starttime' => strtotime(date('Y-m-d')), ':endtime' => TIMESTAMP));
		$today_zhongjiangnum = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('stonefish_scenesign_fansaward') . ' WHERE rid = :rid AND uniacid = :uniacid AND createtime >= :starttime AND createtime <= :endtime and zhongjiang>=1', array(':rid' => $rid, ':uniacid' => $_W['uniacid'], ':starttime' => strtotime(date('Y-m-d')), ':endtime' => TIMESTAMP));
		//今日昨天关键指标
		$scroll = intval($_GPC['scroll']);
		$st = $_GPC['datelimit']['start'] ? strtotime($_GPC['datelimit']['start']) : strtotime('-30day');
	    $et = $_GPC['datelimit']['end'] ? strtotime($_GPC['datelimit']['end']) : strtotime(date('Y-m-d'));
		if(empty($_GPC['datelimit']['start']) && $st!=$reply['starttime']){
			$st=$reply['starttime'];
		}
	    $starttime = min($st, $et);
	    $endtime = max($st, $et);
		$day_num = ($endtime - $starttime) / 86400 + 1;
	    $endtime += 86399;
		if($_W['isajax'] && $_W['ispost']) {
		    $days = array();
		    $datasets = array();
		    for($i = 0; $i < $day_num; $i++){
			    $key = date('m-d', $starttime + 86400 * $i);
			    $days[$key] = 0;
			    $datasets['flow1'][$key] = 0;
				$datasets['flow2'][$key] = 0;
		    }

			$data = pdo_fetchall('SELECT createtime FROM ' . tablename('stonefish_scenesign_fans') . ' WHERE uniacid = :uniacid AND rid = :rid AND createtime >= :starttime AND createtime <= :endtime', array(':uniacid' => $_W['uniacid'], ':rid' => $rid, ':starttime' => $starttime, ':endtime' => $endtime));
		    foreach($data as $da) {
			    $key = date('m-d', $da['createtime']);
			    if(in_array($key, array_keys($days))) {
				    $datasets['flow1'][$key]++;
			    }
		    }	
			
			$data = pdo_fetchall('SELECT createtime FROM ' . tablename('stonefish_scenesign_fansaward') . ' WHERE uniacid = :uniacid AND rid = :rid AND createtime >= :starttime AND createtime <= :endtime and zhongjiang>=1', array(':uniacid' => $_W['uniacid'], ':rid' => $rid, ':starttime' => $starttime, ':endtime' => $endtime));
		    foreach($data as $da) {
			    $key = date('m-d', $da['createtime']);
			    if(in_array($key, array_keys($days))) {
				    $datasets['flow2'][$key]++;
			    }
		    }

		    $shuju['label'] = array_keys($days);
		    $shuju['datasets'] = $datasets;
		
		    if ($day_num == 1) {
			    $day_num = 2;
			    $shuju['label'][] = $shuju['label'][0];
			
			    foreach ($shuju['datasets']['flow1'] as $ky => $va) {
				    $k = $ky;
				    $v = $va;
			    }
			    $shuju['datasets']['flow1']['-'] = $v;
			
			    foreach ($shuju['datasets']['flow2'] as $ky => $va) {
				    $k = $ky;
				    $v = $va;
			    }
			    $shuju['datasets']['flow2']['-'] = $v;
		    }

		    $shuju['datasets']['flow1'] = array_values($shuju['datasets']['flow1']);
		    $shuju['datasets']['flow2'] = array_values($shuju['datasets']['flow2']);
		    exit(json_encode($shuju));		
	    }
		
        include $this->template('trend');
    }
	//活动分析表
	//模板管理
	public function doWebTemplate() {
        global $_GPC, $_W;
		$this->config();
		//活动模板
		$template = pdo_fetch("select * FROM " . tablename('stonefish_scenesign_template') . " where uniacid = :uniacid or uniacid = 0 ORDER BY `id` asc", array(':uniacid' => $_W['uniacid']));
		if(empty($template)){
			$inserttemplate = array(
                'uniacid'          => 0,
				'title'            => '默认',
				'thumb'            => '../addons/stonefish_scenesign/template/images/template.jpg',
				'fontsize'         => '12',
				'bgimg'            => '../addons/stonefish_scenesign/template/images/bg.jpg',
				'bgcolor'          => '#eef3ef',
				'textcolor'        => '#666666',
				'textcolorlink'    => '#f3f3f3',
				'buttoncolor'      => '#38c89a',
				'buttontextcolor'  => '#ffffff',
				'rulecolor'        => '#5dd1ac',
				'ruletextcolor'    => '#f3f3f3',
				'navcolor'         => '#fcfcfc',
				'navtextcolor'     => '#9a9a9a',
				'navactioncolor'   => '#45c018',
				'watchcolor'       => '#f5f0eb',
				'watchtextcolor'   => '#717171',
				'awardcolor'       => '#8571fe',
				'awardtextcolor'   => '#ffffff',
				'awardscolor'      => '#b7b7b7',
				'awardstextcolor'  => '#434343',
			);
			pdo_insert('stonefish_scenesign_template', $inserttemplate);			
		}
		//活动模板
		$params = array(':uniacid' => $_W['uniacid']);
		if (!empty($_GPC['keyword'])) {
            $where = ' AND `title` LIKE :keyword';
            $params[':keyword'] = "%{$_GPC['keyword']}%";
        }
        $total = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_template') . "  where (uniacid=:uniacid or uniacid = 0) " . $where . "", $params);
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $pager = pagination($total, $pindex, $psize);
        $start = ($pindex - 1) * $psize;
        $limit .= " LIMIT {$start},{$psize}";
        $list = pdo_fetchall("select * from " . tablename('stonefish_scenesign_template') . " where (uniacid=:uniacid or uniacid = 0) " . $where . " order by id desc " . $limit, $params);
        include $this->template('template');
    }
	//模板管理
	//模板修改
	public function doWebTemplatepost() {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
		load()->func('tpl');
		if(!empty($id)) {
			$item = pdo_fetch("select * FROM ".tablename('stonefish_scenesign_template')." where id = :id", array(':id' => $id));				
		}else{
			$item['uniacid'] = $_W['uniacid'];
		}
		if(checksubmit('submit')) {
			if(empty($_GPC['edit']) && empty($_GPC['fuzhi'])){
				message('系统模板，无权修改', url('site/entry/template', array('m' => 'stonefish_scenesign')), 'error');
			}
			if(empty($_GPC['title'])){
				message('模板名称必需输入', referer(), 'error');
			}
			if(!isset($_GPC['thumb'])){
				message('模板缩略图必需上传', referer(), 'error');
			}
			if(empty($_GPC['bgimg'])){
				message('模板背景必需上传', referer(), 'error');
			}
			if(empty($_GPC['fontsize'])){
				message('文字大小必需填写', referer(), 'error');
			}
			if(empty($_GPC['bgcolor']) || empty($_GPC['textcolor']) || empty($_GPC['textcolorlink']) || empty($_GPC['buttoncolor']) || empty($_GPC['buttontextcolor']) || empty($_GPC['rulecolor']) || empty($_GPC['ruletextcolor']) || empty($_GPC['navcolor']) || empty($_GPC['navtextcolor']) || empty($_GPC['navactioncolor']) || empty($_GPC['watchcolor']) || empty($_GPC['watchtextcolor']) || empty($_GPC['awardcolor']) || empty($_GPC['awardtextcolor']) || empty($_GPC['awardscolor']) || empty($_GPC['awardstextcolor'])){
				message('颜色必需选择', referer(), 'error');
			}
			$data = array(
				'uniacid'          => $_GPC['uniacid'],
				'title'            => $_GPC['title'],
				'thumb'            => $_GPC['thumb'],
				'fontsize'         => $_GPC['fontsize'],
				'bgimg'            => $_GPC['bgimg'],
				'bgcolor'          => $_GPC['bgcolor'],
				'textcolor'        => $_GPC['textcolor'],
				'textcolorlink'    => $_GPC['textcolorlink'],
				'buttoncolor'      => $_GPC['buttoncolor'],
				'buttontextcolor'  => $_GPC['buttontextcolor'],
				'rulecolor'        => $_GPC['rulecolor'],
				'ruletextcolor'    => $_GPC['ruletextcolor'],
				'navcolor'         => $_GPC['navcolor'],
				'navtextcolor'     => $_GPC['navtextcolor'],
				'navactioncolor'   => $_GPC['navactioncolor'],
				'watchcolor'       => $_GPC['watchcolor'],
				'watchtextcolor'   => $_GPC['watchtextcolor'],
				'awardcolor'       => $_GPC['awardcolor'],
				'awardtextcolor'   => $_GPC['awardtextcolor'],
				'awardscolor'      => $_GPC['awardscolor'],
				'awardstextcolor'  => $_GPC['awardstextcolor'],
		    );
			if(!empty($_GPC['edit'])){
				if(!empty($id)) {
				    pdo_update('stonefish_scenesign_template', $data, array('id' => $id));
				    message('模板修改成功！', url('site/entry/template', array('m' => 'stonefish_scenesign')), 'success');
			    }else{
				    pdo_insert('stonefish_scenesign_template', $data);
				    message('模板添加成功！', url('site/entry/template', array('m' => 'stonefish_scenesign')), 'success');
			    }
			}
			if(!empty($_GPC['fuzhi'])){
				$data['uniacid'] = $_W['uniacid'];
				pdo_insert('stonefish_scenesign_template', $data);
				$id = pdo_insertid();
				message('模板复制成功！', url('site/entry/templatepost', array('m' => 'stonefish_scenesign','id' => $id)), 'success');
			}
		}
        include $this->template('templatepost');
    }
	//模板修改
	//模板删除
	public function doWebTemplatedel() {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
		load()->func('tpl');
		if(!empty($id)) {
			$item = pdo_fetch("select * FROM ".tablename('stonefish_scenesign_template')." where id = :id", array(':id' => $id));
			if(!empty($item)){
				if($item['uniacid']){
					pdo_delete('stonefish_scenesign_template', array('id' => $id));
				    message('模板删除成功', referer(), 'success');
				}else{
					message('系统模板，无权删除', referer(), 'error');
				}				
			}else{
				message('活动不存在或已删除', referer(), 'error');
			}
		}else{
			message('系统出错', referer(), 'error');
		}
    }
	//模板删除
	//消息模板管理
	public function doWebTmplmsg() {
        global $_GPC, $_W;
		$this->config();
		$params = array(':uniacid' => $_W['uniacid']);
		if (!empty($_GPC['keyword'])) {
            $where = ' AND template_name LIKE :keyword';
            $params[':keyword'] = "%{$_GPC['keyword']}%";
        }
        $total = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_tmplmsg') . "  where uniacid=:uniacid " . $where . "", $params);
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $pager = pagination($total, $pindex, $psize);
        $start = ($pindex - 1) * $psize;
        $limit .= " LIMIT {$start},{$psize}";
        $list = pdo_fetchall("select * from " . tablename('stonefish_scenesign_tmplmsg') . " where uniacid=:uniacid " . $where . " order by id desc " . $limit, $params);
        include $this->template('tmplmsg');
    }
	//消息模板管理
	//消息模板修改
	public function doWebTmplmsgpost() {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
		load()->func('tpl');
		if(!empty($id)) {
			$item = pdo_fetch("select * FROM ".tablename('stonefish_scenesign_tmplmsg')." where id = :id", array(':id' => $id));				
		}else{
			$item['uniacid'] = $_W['uniacid'];
		}
		if(checksubmit('submit')) {
			if(empty($_GPC['template_name'])){
				message('消息模板名称必需输入', referer(), 'error');
			}
			if(empty($_GPC['template_id'])){
				message('消息模板ID必需输入', referer(), 'error');
			}
			if(empty($_GPC['first'])){
				message('消息模板标题必需输入', referer(), 'error');
			}
			if(empty($_GPC['keyword1'])){
				message('消息模板必需输入一个参数', referer(), 'error');
			}
			if(empty($_GPC['remark'])){
				message('消息模板必需输入备注', referer(), 'error');
			}
			$data = array(
				'uniacid'          => $_GPC['uniacid'],
				'template_name'    => $_GPC['template_name'],
				'template_id'      => $_GPC['template_id'],
				'topcolor'         => $_GPC['topcolor'],
				'first'            => $_GPC['first'],
				'firstcolor'       => $_GPC['firstcolor'],
				'keyword1'         => $_GPC['keyword1'],
				'keyword2'         => $_GPC['keyword2'],
				'keyword3'         => $_GPC['keyword3'],
				'keyword4'         => $_GPC['keyword4'],
				'keyword5'         => $_GPC['keyword5'],
				'keyword6'         => $_GPC['keyword6'],
				'keyword7'         => $_GPC['keyword7'],
				'keyword8'         => $_GPC['keyword8'],
				'keyword9'         => $_GPC['keyword9'],
				'keyword10'        => $_GPC['keyword10'],
				'keyword1color'    => $_GPC['keyword1color'],
				'keyword2color'    => $_GPC['keyword2color'],
				'keyword3color'    => $_GPC['keyword3color'],
				'keyword4color'    => $_GPC['keyword4color'],
				'keyword5color'    => $_GPC['keyword5color'],
				'keyword6color'    => $_GPC['keyword6color'],
				'keyword7color'    => $_GPC['keyword7color'],
				'keyword8color'    => $_GPC['keyword8color'],
				'keyword9color'    => $_GPC['keyword9color'],
				'keyword10color'   => $_GPC['keyword10color'],
				'keyword1code'     => $_GPC['keyword1code'],
				'keyword2code'     => $_GPC['keyword2code'],
				'keyword3code'     => $_GPC['keyword3code'],
				'keyword4code'     => $_GPC['keyword4code'],
				'keyword5code'     => $_GPC['keyword5code'],
				'keyword6code'     => $_GPC['keyword6code'],
				'keyword7code'     => $_GPC['keyword7code'],
				'keyword8code'     => $_GPC['keyword8code'],
				'keyword9code'     => $_GPC['keyword9code'],
				'keyword10code'    => $_GPC['keyword10code'],
				'remark'           => $_GPC['remark'],
				'remarkcolor'      => $_GPC['remarkcolor'],
		    );
			if(!empty($id)) {
				pdo_update('stonefish_scenesign_tmplmsg', $data, array('id' => $id));
				message('消息模板修改成功！', url('site/entry/tmplmsg', array('m' => 'stonefish_scenesign')), 'success');
			}else{
				pdo_insert('stonefish_scenesign_tmplmsg', $data);
				message('消息模板添加成功！', url('site/entry/tmplmsg', array('m' => 'stonefish_scenesign')), 'success');
			}			
		}
        include $this->template('tmplmsgpost');
    }
	//消息模板修改
	//消息模板删除
	public function doWebTmplmsgdel() {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
		load()->func('tpl');
		if(!empty($id)) {
			$item = pdo_fetch("select * FROM ".tablename('stonefish_scenesign_tmplmsg')." where id = :id", array(':id' => $id));
			if(!empty($item)){
				pdo_delete('stonefish_scenesign_tmplmsg', array('id' => $id));
				message('消息模板删除成功', referer(), 'success');
			}else{
				message('消息模板不存在或已删除', referer(), 'error');
			}
		}else{
			message('系统出错', referer(), 'error');
		}
    }
	//消息模板删除
	//活动状态设置
    public function doWebSetshow() {
        global $_GPC, $_W;
        $rid = intval($_GPC['rid']);
        $isshow = intval($_GPC['isshow']);

        if (empty($rid)) {
            message('抱歉，传递的参数错误！', '', 'error');
        }
        $temp = pdo_update('stonefish_scenesign_reply', array('isshow' => $isshow), array('rid' => $rid));
		if($isshow){
			message('状态设置成功！活动已开启！', referer(), 'success');
		}else{
			message('状态设置成功！活动已关闭！', referer(), 'success');
		}
       
    }
	//活动状态设置
	//删除活动
	public function doWebDelete() {
        global $_GPC, $_W;
        $rid = intval($_GPC['rid']);
        $rule = pdo_fetch("select id, module from " . tablename('rule') . " where id = :id and uniacid=:uniacid", array(':id' => $rid, ':uniacid' => $_W['uniacid']));
        if (empty($rule)) {
            message('抱歉，要修改的规则不存在或是已经被删除！');
        }
        if (pdo_delete('rule', array('id' => $rid))) {
            pdo_delete('rule_keyword', array('rid' => $rid));
            //删除统计相关数据
            pdo_delete('stat_rule', array('rid' => $rid));
            pdo_delete('stat_keyword', array('rid' => $rid));
            //调用模块中的删除
            $module = WeUtility::createModule($rule['module']);
            if (method_exists($module, 'ruleDeleted')) {
                $module->ruleDeleted($rid);
            }
        }
        message('活动删除成功！', referer(), 'success');
    }
	//删除活动
	//批理删除活动
	public function doWebDeleteAll() {
        global $_GPC, $_W;
        foreach ($_GPC['idArr'] as $k => $rid) {
            $rid = intval($rid);
            if ($rid == 0)
                continue;
            $rule = pdo_fetch("select id, module from " . tablename('rule') . " where id = :id and uniacid=:uniacid", array(':id' => $rid, ':uniacid' => $_W['uniacid']));
            if (empty($rule)) {
				echo json_encode(array('errno' => 1,'error' => '抱歉，要修改的规则不存在或是已经被删除！'));
				exit;
            }
            if (pdo_delete('rule', array('id' => $rid))) {
                pdo_delete('rule_keyword', array('rid' => $rid));
                //删除统计相关数据
                pdo_delete('stat_rule', array('rid' => $rid));
                pdo_delete('stat_keyword', array('rid' => $rid));
                //调用模块中的删除
                $module = WeUtility::createModule($rule['module']);
                if (method_exists($module, 'ruleDeleted')) {
                    $module->ruleDeleted($rid);
                }
            }
        }
        //message('选择中的活动删除成功！', referer(), 'success');
		echo json_encode(array('errno' => 0,'error' => '选择中的活动删除成功！'));
		exit;
    }
	//批理删除活动	
	//奖品配置数据
	public function doWebPrize() {
        global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$rid = empty($rid) ? intval($_GPC['id']) : $rid;
		$reply = pdo_fetch("select mobileverify from ".tablename('stonefish_scenesign_reply')." where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//查询do参数
		if(empty($_GPC['do'])){
			$_GPC['do'] = pdo_fetchcolumn("select do from " . tablename('modules_bindings') . "  where eid = :eid and module=:module", array(':eid' => $_GPC['eid'], ':module' => 'stonefish_scenesign'));
		}
		//查询do参数
		$params = array(':rid' => $rid, ':uniacid' => $_W['uniacid']);
		if (!empty($_GPC['prizename'])) {
            $where.=' and prizename LIKE :prizename';
            $params[':prizename'] = "%{$_GPC['prizename']}%";
        }
		if (!empty($_GPC['prizetype'])) {
            $where.=' and prizetype ＝:prizetype';
            $params[':prizetype'] = "{$_GPC['prizetype']}";
        }
		$total = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_prize') . "  where rid = :rid and uniacid=:uniacid " . $where . "", $params);
        $pindex = max(1, intval($_GPC['page']));
        $psize = 30;
        $pager = pagination($total, $pindex, $psize);
        $start = ($pindex - 1) * $psize;
        $limit .= " LIMIT {$start},{$psize}";
        $list = pdo_fetchall("select * from " . tablename('stonefish_scenesign_prize') . " where rid = :rid and uniacid=:uniacid " . $where . " order by id asc " . $limit, $params);
        include $this->template('prize');
    }
	//奖品配置数据
	//奖品配置数据修改
	public function doWebPrizeedit() {
        global $_GPC, $_W;
        $rid = intval($_GPC['rid']);
		$rid = empty($rid) ? intval($_GPC['id']) : $rid;
		$reply = pdo_fetch("select mobileverify from ".tablename('stonefish_scenesign_reply')." where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//查询do参数
		if(empty($_GPC['do'])){
			$_GPC['do'] = pdo_fetchcolumn("select do from " . tablename('modules_bindings') . "  where eid = :eid and module=:module", array(':eid' => $_GPC['eid'], ':module' => 'stonefish_scenesign'));
		}
		//查询do参数
		$id = intval($_GPC['id']);
		load()->func('tpl');
		if(!empty($id)) {
			$item = pdo_fetch("select * FROM ".tablename('stonefish_scenesign_prize')." where id = :id", array(':id' => $id));
		}
		//积分类型
		$creditnames = array();
		$unisettings = uni_setting($_W['uniacid'], array('creditnames'));
		foreach ($unisettings['creditnames'] as $key=>$credit) {
			if (!empty($credit['enabled'])) {
				$creditnames[$key] = $credit['title'];
			}
		}
		//积分类型
		$item['prizetype'] = empty($item['prizetype']) ? "physical" : $item['prizetype'];
		$item['probalilty'] = !isset($item['probalilty']) ? "10" : $item['probalilty'];
		$item['prizetotal'] = !isset($item['prizetotal']) ? "100" : $item['prizetotal'];
		if(checksubmit('submit')) {
			if(empty($_GPC['prizetype'])){
				message('奖品类型必需选择', referer(), 'error');
			}
			if(empty($_GPC['prizename'])){
				message('奖品名称必需输入', referer(), 'error');
			}
			if(empty($_GPC['prizetotal'])){
				message('奖品数量必需输入', referer(), 'error');
			}
			$data = array(
                'rid' => $rid,
				'uniacid' => $_W['uniacid'],					
				'prizetype' => $_GPC['prizetype'],
				'prizerating' => $_GPC['prizerating'],
				'prizevalue' => $_GPC['prizevalue'],
				'prizename' => $_GPC['prizename'],
				'prizepic' => $_GPC['prizepic'],
				'prizetotal' => $_GPC['prizetotal'],
				'probalilty' => $_GPC['probalilty'],
				'description' => $_GPC['prizedescription'],
				'break' => $_GPC['break'],
				'password' => $_GPC['password'],
				'awardingaddress' => $_GPC['awardingaddress'],
			    'awardingtel' => $_GPC['awardingtel'],
			    'baidumaplng' => $_GPC['baidumap']['lng'],
			    'baidumaplat' => $_GPC['baidumap']['lat'],
			);
			if(!empty($id)) {
				pdo_update('stonefish_scenesign_prize', $data, array('id' => $id));
				message('奖品配置修改成功！', url('site/entry/prize', array('m' => 'stonefish_scenesign','rid' => $rid)), 'success');
			}else{
				pdo_insert('stonefish_scenesign_prize', $data);
				message('奖品配置添加成功！', url('site/entry/prize', array('m' => 'stonefish_scenesign','rid' => $rid)), 'success');
			}
		}
        include $this->template('prizeedit');
    }
	//奖品配置数据修改
	//删除奖品配置数据
	public function doWebPrizedelete() {
        global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$reply = pdo_fetch("select * from ".tablename('stonefish_scenesign_reply')." where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
        if(empty($reply)){
			message('抱歉，传递的参数错误！', referer(), 'error');
        }
        $id = intval($_GPC['id']);
		$business = pdo_fetch("select * from ".tablename('stonefish_scenesign_prize')." where id = :id", array(':id' => $id));
        if(empty($business)){
			message('抱歉，选中的数据不存在！', referer(), 'error');
        }
		//删除粉丝分享记录
		pdo_delete('stonefish_scenesign_prize', array('id' => $id));
		//删除粉丝分享记录
		if($_GPC['replyid']=='yes'){
			message('奖品配置数据删除成功', url('platform/reply/post',array('m'=>'stonefish_scenesign','rid'=>$rid)));
		}else{
			message('奖品配置数据删除成功', url('site/entry/prize',array('rid' => $rid, 'm' => 'stonefish_scenesign')));
		}		
    }
	//删除奖品配置数据
	//消息通知记录
	public function doWebPosttmplmsg() {
        global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$rid = empty($rid) ? intval($_GPC['id']) : $rid;
		$reply = pdo_fetch("select poweravatar,mobileverify from ".tablename('stonefish_scenesign_reply')." where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//查询do参数
		if(empty($_GPC['do'])){
			$_GPC['do'] = pdo_fetchcolumn("select do from " . tablename('modules_bindings') . "  where eid = :eid and module=:module", array(':eid' => $_GPC['eid'], ':module' => 'stonefish_scenesign'));
		}
		//查询do参数
		//消息模板
		$tmplmsg = pdo_fetchall("SELECT * FROM " . tablename('stonefish_scenesign_tmplmsg') . " WHERE uniacid = :uniacid ORDER BY `id` asc", array(':uniacid' => $_W['uniacid']));
		//消息模板
		$params = array(':rid' => $rid, ':uniacid' => $_W['uniacid']);
		if (!empty($_GPC['nickname'])) {
            $where.=' and b.nickname LIKE :nickname';
            $params[':nickname'] = "%{$_GPC['nickname']}%";
        }
		if (!empty($_GPC['realname'])) {     
            $where.=' and b.realname LIKE :realname';
            $params[':realname'] = "%{$_GPC['realname']}%";
        }
		if (!empty($_GPC['mobile'])) {     
            $where.=' and b.mobile LIKE :mobile';
            $params[':mobile'] = "%{$_GPC['mobile']}%";
        }		
		if($_GPC['zhongjiang']==1){
			$where.=' and b.zhongjiang =0';
		}
		if($_GPC['zhongjiang']==2){
			$where.=' and b.zhongjiang>=1';
		}
		if($_GPC['zhongjiang']==3){
			$where.='and b.zhongjiang>=1 and b.xuni=1';
		}
		if (!empty($_GPC['tmplmsgid'])) {     
            $where.=' and a.tmplmsgid =:tmplmsgid';
            $params[':tmplmsgid'] = "{$_GPC['tmplmsgid']}";
        }
		$total = pdo_fetchcolumn("select count(a.id) from " . tablename('stonefish_scenesign_fanstmplmsg') . " as a," . tablename('stonefish_scenesign_fans') . " as b where a.rid = :rid and a.uniacid=:uniacid and a.from_user=b.from_user" . $where . "", $params);
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $pager = pagination($total, $pindex, $psize);
        $start = ($pindex - 1) * $psize;
        $limit .= " LIMIT {$start},{$psize}";
        $list = pdo_fetchall("select a.id,a.from_user,a.tmplmsg,a.createtime,a.seednum,b.avatar,b.realname,b.nickname,b.mobile,c.template_name from " . tablename('stonefish_scenesign_fanstmplmsg') . " as a," . tablename('stonefish_scenesign_fans') . " as b," . tablename('stonefish_scenesign_tmplmsg') . " as c where a.rid = :rid and a.uniacid=:uniacid and a.from_user=b.from_user and c.id=a.tmplmsgid" . $where . " order by a.id desc " . $limit, $params);
		//是否为关注会员并发送消息
		foreach ($list as &$lists) {
			$lists['fanid'] = pdo_fetchcolumn("select fanid FROM ".tablename('mc_mapping_fans') ." where openid=:openid and uniacid=:uniacid and follow=1",array(":openid"=>$lists['from_user'],":uniacid"=>$_W['uniacid']));
		}
		//是否为关注会员并发送消息
        include $this->template('posttmplmsg');
    }
	//消息通知记录
	//模板消息内容
	public function doWebTmplmsginfo() {
        global $_GPC, $_W;
		if($_W['isajax']) {
			load()->func('tpl');
			$id = intval($_GPC['id']);
			$fanstmplmsg = pdo_fetch("select * from ".tablename('stonefish_scenesign_fanstmplmsg')." where id = :id", array(':id' => $id));
			if(!empty($fanstmplmsg)){
				$data = pdo_fetch("select avatar,nickname from ".tablename('stonefish_scenesign_fans')." where from_user = :from_user and rid = :rid", array(':from_user' => $fanstmplmsg['from_user'],':rid' => $fanstmplmsg['rid']));
				$fanstmplmsg['tmplmsg'] = json_decode($fanstmplmsg['tmplmsg'],true);
				$len=count($fanstmplmsg['tmplmsg']['data']);
			}
			include $this->template('tmplmsginfo');
			exit();
		}
    }
	//模板消息内容
	//再次发送模板消息
	public function doWebSeedtmplmsg() {
        global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		load()->func('communication');
        load()->classs('weixin.account');
        $accObj = WeixinAccount::create($_W['acid']);
        $access_token = $accObj->fetch_token();
		if (empty($access_token)) {
            message('系统出错！', url('site/entry/posttmplmsg',array('rid' => $rid, 'm' => 'stonefish_scenesign','page'=>intval($_GPC['page']))), 'error');
        }
		if($_GPC['all']=='yes'){
			foreach ($_GPC['idArr'] as $k => $id) {
                $id = intval($id);
                if($id == 0)
                    continue;
			    $fanstmplmsg = pdo_fetch("select * from ".tablename('stonefish_scenesign_fanstmplmsg')." where id = :id", array(':id' => $id));
                if(empty($fanstmplmsg)){
				    echo json_encode(array('errno' => 1,'error' => '抱歉，选中的模板消息数据不存在！'));
				    exit;
                }				
			    $postarr = $fanstmplmsg['tmplmsg'];
                $res = ihttp_post('https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $access_token, $postarr);
			    //添加消息发送记录
			    $tmplmsgdata = array(
				    'seednum' => $fanstmplmsg['seednum']+1,
				    'createtime' => TIMESTAMP,
			    );
			    pdo_update('stonefish_scenesign_fanstmplmsg', $tmplmsgdata, array('id' => $id));
            }
		    echo json_encode(array('errno' => 0,'error' => '选中的模板消息数据再次发送成功！'));
		    exit;
		}else{
			$id = intval($_GPC['id']);
		    $fanstmplmsg = pdo_fetch("select * from ".tablename('stonefish_scenesign_fanstmplmsg')." where id = :id", array(':id' => $id));
		    if(!empty($fanstmplmsg)){
			    $postarr = $fanstmplmsg['tmplmsg'];
                $res = ihttp_post('https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $access_token, $postarr);
			    //添加消息发送记录
			    $tmplmsgdata = array(
				    'seednum' => $fanstmplmsg['seednum']+1,
				    'createtime' => TIMESTAMP,
			    );
			    pdo_update('stonefish_scenesign_fanstmplmsg', $tmplmsgdata, array('id' => $id));
			    message('模板消息再次发送成功！', url('site/entry/posttmplmsg',array('rid' => $rid, 'm' => 'stonefish_scenesign','page'=>intval($_GPC['page']))), 'success');
			    //添加消息发送记录
		    }else{
			    message('模板消息内容出错！', url('site/entry/posttmplmsg',array('rid' => $rid, 'm' => 'stonefish_scenesign','page'=>intval($_GPC['page']))), 'error');
		    }
		}
    }	
	//再次发送模板消息
	//参与活动粉丝
	public function doWebFansdata() {
        global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$rid = empty($rid) ? intval($_GPC['id']) : $rid;
		$reply = pdo_fetch("select poweravatar,mobileverify from ".tablename('stonefish_scenesign_reply')." where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		$group = pdo_fetchcolumn("select `group` from " . tablename('stonefish_scenesign_exchange') . "  where rid = :rid", array(':rid' => $rid));
		//查询do参数
		if(empty($_GPC['do'])){
			$_GPC['do'] = pdo_fetchcolumn("select do from " . tablename('modules_bindings') . "  where eid = :eid and module=:module", array(':eid' => $_GPC['eid'], ':module' => 'stonefish_scenesign'));
		}
		//查询do参数
		$params = array(':rid' => $rid, ':uniacid' => $_W['uniacid']);
		if (!empty($_GPC['nickname'])) {
            $where.=' and nickname LIKE :nickname';
            $params[':nickname'] = "%{$_GPC['nickname']}%";
        }
		if (!empty($_GPC['realname'])) {     
            $where.=' and realname LIKE :realname';
            $params[':realname'] = "%{$_GPC['realname']}%";
        }
		if (!empty($_GPC['mobile'])) {     
            $where.=' and mobile LIKE :mobile';
            $params[':mobile'] = "%{$_GPC['mobile']}%";
        }
		//导出标题以及参数设置
		if($_GPC['zhongjiang']==''){
		    $statustitle = '全部';
		}
		if($_GPC['zhongjiang']==1){
		    $statustitle = '未中奖';
			$where.=' and zhongjiang=0';
		}
		if($_GPC['zhongjiang']==2){
		    $statustitle = '已中奖';
			$where.=' and zhongjiang>=1';
		}
		if($_GPC['zhongjiang']==3){
		    $statustitle = '虚拟奖';
			$where.='and zhongjiang>=1 and xuni=1';
		}
		//导出标题以及参数设置				
		$total = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_fans') . "  where rid = :rid and uniacid=:uniacid " . $where . "", $params);
        $psize = 20;
		$pagemax = ceil($total/$psize);
		$_GPC['page'] = $_GPC['page']>$pagemax ? $pagemax : $_GPC['page'];
        $pindex = max(1, intval($_GPC['page']));
        $pager = pagination($total, $pindex, $psize);
        $start = ($pindex - 1) * $psize;
        $limit .= " LIMIT {$start},{$psize}";
        $list = pdo_fetchall("select * from " . tablename('stonefish_scenesign_fans') . " where rid = :rid and uniacid=:uniacid " . $where . " order by id desc " . $limit, $params);
		//中奖情况以及是否为关注会员并发送消息
		foreach ($list as &$lists) {
			$lists['awardinfo'] = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_fansaward') . "  where rid = :rid and from_user=:from_user", array(':rid' => $rid,':from_user' => $lists['from_user']));
			$lists['fanid'] = pdo_fetchcolumn("select fanid FROM ".tablename('mc_mapping_fans') ." where openid=:openid and uniacid=:uniacid and follow=1",array(":openid"=>$lists['from_user'],":uniacid"=>$_W['uniacid']));
			if($group){
				$bumen1 = pdo_fetchcolumn("select gname from ".tablename('stonefish_scenesign_group')." where id = :id", array(':id' => $lists['pcate']));
				$bumen2 = pdo_fetchcolumn("select gname from ".tablename('stonefish_scenesign_group')." where id = :id", array(':id' => $lists['ccate']));
				if($bumen2)$bumen2='-'.$bumen2;
			    $lists['bumen'] = $bumen1.$bumen2;
			}
		}
		//中奖情况以及是否为关注会员并发送消息
		//一些参数的显示
        $num1 = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_fans') . "  where rid = :rid and uniacid=:uniacid and zhongjiang=0", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
        $num2 = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_fans') . "  where rid = :rid and uniacid=:uniacid and zhongjiang>=1", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
        $num3 = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_fans') . "  where rid = :rid and uniacid=:uniacid and zhongjiang>=1 and xuni=1", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//一些参数的显示
        include $this->template('fansdata');
    }
	//参与活动粉丝
	//参与活动粉丝状态
	public function doWebSetfansstatus() {
		global $_GPC, $_W;
		$id = intval($_GPC['id']);
		$data = intval($_GPC['data']);
		if ($id) {
			$data = ($data==1?'0':'1');
			pdo_update("stonefish_scenesign_fans", array('status' => $data), array("id" => $id));
			die(json_encode(array("result" => 1, "data" => $data)));
		}
		die(json_encode(array("result" => 0)));
	}
	//参与活动粉丝状态
	//删除参与活动粉丝
	public function doWebDeletefans() {
        global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$reply = pdo_fetch("select * from ".tablename('stonefish_scenesign_reply')." where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
        $exchange = pdo_fetch("select inventory FROM ".tablename("stonefish_scenesign_exchange")." where rid = :rid", array(':rid' => $rid));
		if(empty($reply)){
			echo json_encode(array('errno' => 1,'error' => '抱歉，传递的参数错误！'));
			exit;
        }
        foreach ($_GPC['idArr'] as $k => $id) {
            $id = intval($id);
            if($id == 0)
                continue;
			$fans = pdo_fetch("select * from ".tablename('stonefish_scenesign_fans')." where id = :id", array(':id' => $id));
            if(empty($fans)){
				echo json_encode(array('errno' => 1,'error' => '抱歉，选中的粉丝数据不存在！'));
				exit;
            }
            //删除粉丝中奖记录
			load()->model('mc');
			$fansaward = pdo_fetchall("select id,prizeid,zhongjiang from " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid=:uniacid and from_user=:from_user", array(':rid' => $rid, ':uniacid' => $_W['uniacid'], ':from_user' => $fans['from_user']));
			foreach ($fansaward as $fansawards) {
				$prize = pdo_fetch("select id,prizedraw from " . tablename('stonefish_scenesign_prize') . " where id = :id", array(':id' => $fansawards['prizeid']));
				if($exchange['inventory']==1 && $fansawards['zhongjiang']>=1){
					pdo_update('stonefish_scenesign_prize', array('prizedraw' => $prize['prizedraw']-1), array('id' => $fansawards['prizeid']));
				}
				if($exchange['inventory']==2 && $fansawards['zhongjiang']>=2){
					pdo_update('stonefish_scenesign_prize', array('prizedraw' => $prize['prizedraw']-1), array('id' => $fansawards['prizeid']));
				}
				//查询奖品是否为虚拟积分，如果是则扣除相应的积分
				if($prize['prizetype']!='physical' && $prize['prizetype']!='virtual' && $prize['prizetype']!='againprize'){
					$uid = pdo_fetchcolumn("select uid FROM ".tablename('mc_mapping_fans') ." where openid=:openid and uniacid=:uniacid",array(":openid"=>$fans['from_user'],":uniacid"=>$_W['uniacid']));
					$unisetting_s = uni_setting($_W['uniacid'], array('creditnames'));
		            foreach ($unisetting_s['creditnames'] as $key=>$credit) {
		    	        if ($prize['prizetype']==$key) {
			    	        $credit_names = $credit['title'];
					        break;
			            }
		            }
					//扣除积分到粉丝数据库					
			        mc_credit_update($uid, $prize['prizetype'], -$prize['prizevalue'], array($_W['uid'], '占领朋友圈删除奖品扣除'.$prize['prizevalue'].'个'.$credit_names));
			        //扣除积分到粉丝数据库
				}
			    //查询奖品是否为虚拟积分，如果是则扣除相应的积分				
			}
			//删除粉丝中奖记录
			//删除粉丝验证记录
			pdo_update('stonefish_scenesign_mobileverify', array('verifytime' => 0), array('mobile' => $fans['mobile'],'rid' => $rid,'uniacid' => $_W['uniacid']));
			//删除粉丝验证记录
			//删除粉丝中奖详细记录
			pdo_delete('stonefish_scenesign_fansaward', array('from_user' => $fans['from_user'],'rid' => $rid,'uniacid' => $_W['uniacid']));
			//删除粉丝中奖详细记录
			//删除粉丝消息模板记录
			pdo_delete('stonefish_scenesign_fanstmplmsg', array('from_user' => $fans['from_user'],'rid' => $rid,'uniacid' => $_W['uniacid']));
			//删除粉丝消息模板记录
			//删除粉丝分享详细记录
			pdo_delete('stonefish_scenesign_sharedata', array('fromuser' => $fans['from_user'],'rid' => $rid,'uniacid' => $_W['uniacid']));
			//删除粉丝分享详细记录
			//删除粉丝参与记录
			pdo_delete('stonefish_scenesign_fans', array('id' => $id));
			//删除粉丝参与记录
			$i = $i + 1;
        }
		//减少参与记录
		pdo_update('stonefish_scenesign_reply', array('fansnum' => $reply['fansnum']-$i), array('id' => $reply['id']));
		//减少参与记录
		echo json_encode(array('errno' => 0,'error' => '选中的粉丝删除成功！'));
		exit;
    }
	//删除参与活动粉丝
	//参与粉丝信息
	public function doWebUserinfo() {
        global $_GPC, $_W;
		if($_W['isajax']) {
			$uid = intval($_GPC['uid']);
			$rid = intval($_GPC['rid']);
			//兑奖资料
			$reply = pdo_fetch("select * FROM " . tablename('stonefish_scenesign_reply') . " where rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
			$exchange = pdo_fetch("select * FROM ".tablename("stonefish_scenesign_exchange")." where rid = :rid", array(':rid' => $rid));
			$isfansname = explode(',',$exchange['isfansname']);
			//粉丝数据
			if($uid){
				$data = pdo_fetch("select * FROM ".tablename('stonefish_scenesign_fans')." where id = :id", array(':id' => $uid));
			}else{
				echo '未找到指定粉丝资料';
				exit;
			}
			include $this->template('userinfo');
			exit();
		}
    }
	//参与粉丝信息
	//参与粉丝中奖记录信息
	public function doWebPrizeinfo() {
        global $_GPC, $_W;
		if($_W['isajax']) {
			$uid = intval($_GPC['uid']);
			$rid = intval($_GPC['rid']);
			//中奖记录
			if($uid){
				$data = pdo_fetch("select id, from_user from " . tablename('stonefish_scenesign_fans') . ' where id = :id', array(':id' => $uid));
				$list = pdo_fetchall("select a.*,b.* from " . tablename('stonefish_scenesign_fansaward') . " a," . tablename('stonefish_scenesign_prize') . " AS b where a.prizeid = b.id and a.rid = :rid and a.uniacid=:uniacid and a.from_user=:from_user order by a.id desc ", array(':uniacid' => $_W['uniacid'], ':rid' => $rid, ':from_user' => $data['from_user']));
			}else{
				echo '未找到指定粉丝中奖记录';
				exit;
			}
			include $this->template('prizeinfo');
			exit();
		}
    }
	//参与粉丝中奖记录信息
	//助力详细情况
	public function doWebSharelist() {
        global $_GPC, $_W;
		if($_W['isajax']) {
			$uid = intval($_GPC['uid']);
			$rid = intval($_GPC['rid']);
			//规则
			$reply = pdo_fetch("select poweravatar FROM " . tablename('stonefish_scenesign_reply') . " where rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
			//粉丝数据
			$data = pdo_fetch("select id, from_user  FROM " . tablename('stonefish_scenesign_fans') . ' where id = :id', array(':id' => $uid));
			$share = pdo_fetchall("select * FROM " . tablename('stonefish_scenesign_sharedata') . "  where rid = :rid and uniacid=:uniacid and fromuser=:fromuser ORDER BY id DESC ", array(':uniacid' => $_W['uniacid'], ':rid' => $rid, ':fromuser' => $data['from_user']));
			include $this->template('sharelist');
			exit();
		}
    }
	//助力详细情况
	//虚拟奖品
	public function doWebAddxuniaward() {
        global $_GPC, $_W;
		if($_W['isajax']) {
			$uid = intval($_GPC['uid']);
			$rid = intval($_GPC['rid']);
			//规则
			$reply = pdo_fetch("select * FROM " . tablename('stonefish_scenesign_reply') . " where rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
			//粉丝数据
			$data = pdo_fetch("select *  FROM " . tablename('stonefish_scenesign_fans') . ' where id = :id', array(':id' => $uid));
			//奖品数据
			$awardlist = pdo_fetchall("select * from " . tablename('stonefish_scenesign_prize') . ' where rid = :rid and uniacid = :uniacid order by id ASC', array(':uniacid' => $_W['uniacid'], ':rid' => $rid));
			include $this->template('addxuniaward');
			exit();
		}
    }
	public function doWebSavexuniaward() {
        global $_GPC, $_W;
		$uid = intval($_GPC['uid']);
		$rid = intval($_GPC['rid']);
		$awardid = intval($_GPC['awardid']);
		if(!$awardid){
		    message('必需选择奖品才能生效', url('site/entry/fansdata',array('rid' => $rid, 'm' => 'stonefish_scenesign', 'page' => intval($_GPC['page']))), 'error');
		}
		if(!$rid){
		    message('系统出错', url('site/entry/fansdata',array('rid' => $rid, 'm' => 'stonefish_scenesign', 'page' => intval($_GPC['page']))), 'error');
		}
		if($uid) {
		    //规则
			$reply = pdo_fetch("select * from " . tablename('stonefish_scenesign_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
			//粉丝数据
			$data = pdo_fetch("select id, from_user  from " . tablename('stonefish_scenesign_fans') . ' where id = :id', array(':id' => $uid));
			//添加中奖记录
			$prize = pdo_fetch("select * from " . tablename('stonefish_scenesign_prize') . "  where id=:id", array(':id' => $awardid));
			pdo_update('stonefish_scenesign_prize', array('prizedraw' => $prize['prizedraw'] + 1), array('id' => $awardid));
            //保存award中
            $codesn = date("YmdHis").mt_rand(100000,999999);
			$insert = array(
                'uniacid' => $_W['uniacid'],
                'rid' => $rid,
                'from_user' => $data['from_user'],                
                'prizeid' => $awardid,
                'codesn' => $codesn,
                'createtime' => time(),
				'zhongjiangtime' => time(),
				'consumetime' => time(),
                'zhongjiang' => 2,
				'xuni' => 1
            );
            $temp = pdo_insert('stonefish_scenesign_fansaward', $insert);
            //保存中奖人信息到fans中
            pdo_update('stonefish_scenesign_fans', array('zhongjiang' => 1,'xuni' => 1), array('id' => $data['id']));			
			message('添加虚拟奖品成功', url('site/entry/fansdata',array('rid' => $rid, 'm' => 'stonefish_scenesign', 'page' => intval($_GPC['page']))));
		} else {
			message('未找到指定用户', url('site/entry/fansdata',array('rid' => $rid, 'm' => 'stonefish_scenesign', 'page' => intval($_GPC['page']))), 'error');
		}      
    }
	//虚拟奖品
	//参与活动粉丝分享数据
	public function doWebSharedata() {
        global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$rid = empty($rid) ? intval($_GPC['id']) : $rid;
		$reply = pdo_fetch("select poweravatar,mobileverify from ".tablename('stonefish_scenesign_reply')." where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//查询do参数
		if(empty($_GPC['do'])){
			$_GPC['do'] = pdo_fetchcolumn("select do from " . tablename('modules_bindings') . "  where eid = :eid and module=:module", array(':eid' => $_GPC['eid'], ':module' => 'stonefish_scenesign'));
		}
		//查询do参数
		$params = array(':rid' => $rid, ':uniacid' => $_W['uniacid']);
		if (!empty($_GPC['nickname'])) {
            $where.=' and nickname LIKE :nickname';
            $params[':nickname'] = "%{$_GPC['nickname']}%";
        }		
		if (!empty($_GPC['fromuser'])) {     
            $where.=' and fromuser=:fromuser';
            $params[':fromuser'] = $_GPC['fromuser'];
        }
		$total = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_sharedata') . "  where rid = :rid and uniacid=:uniacid " . $where . "", $params);
		$psize = 20;
		$pagemax = ceil($total/$psize);
		$_GPC['page'] = $_GPC['page']>$pagemax ? $pagemax : $_GPC['page'];
        $pindex = max(1, intval($_GPC['page']));
        $pager = pagination($total, $pindex, $psize);
        $start = ($pindex - 1) * $psize;
        $limit .= " LIMIT {$start},{$psize}";
        $list = pdo_fetchall("select * from " . tablename('stonefish_scenesign_sharedata') . " where rid = :rid and uniacid=:uniacid " . $where . " order by id desc " . $limit, $params);
		//分享人
		foreach ($list as &$lists) {
			$fans = pdo_fetch("select avatar,nickname,realname from " . tablename('stonefish_scenesign_fans') . "  where rid = :rid and from_user=:from_user", array(':rid' => $rid,':from_user' => $lists['fromuser']));
			$lists['favatar'] =$fans['avatar'];
			$lists['fnickname'] =stripcslashes($fans['nickname']);
			$lists['frealname'] =$fans['realname'];
		}
		//分享人
        include $this->template('sharedata');
    }
	//参与活动粉丝分享数据
	//删除参与活动粉丝分享数据
	public function doWebDeletesharedata() {
        global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$reply = pdo_fetch("select * from ".tablename('stonefish_scenesign_reply')." where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
        if(empty($reply)){
			echo json_encode(array('errno' => 1,'error' => '抱歉，传递的参数错误！'));
			exit;
        }
        foreach ($_GPC['idArr'] as $k => $id) {
            $id = intval($id);
            if($id == 0)
                continue;
			$sharedata = pdo_fetch("select id,fromuser from ".tablename('stonefish_scenesign_sharedata')." where id = :id", array(':id' => $id));
            if(empty($sharedata)){
				echo json_encode(array('errno' => 1,'error' => '抱歉，选中的数据不存在！'));
				exit;
            }
			$fans = pdo_fetch("select * from " . tablename('stonefish_scenesign_fans') . " where rid = :rid and uniacid=:uniacid and from_user=:from_user", array(':rid' => $rid, ':uniacid' => $_W['uniacid'], ':from_user' => $sharedata['fromuser']));
			//减少参与粉丝分享助力
			pdo_update('stonefish_scenesign_fans', array('sharenum' => $fans['sharenum']-1), array('id' => $fans['id']));
			//减少参与粉丝分享助力			
			//删除粉丝分享记录
			pdo_delete('stonefish_scenesign_sharedata', array('id' => $sharedata['id']));
			//删除粉丝分享记录
        }
		echo json_encode(array('errno' => 0,'error' => '选中的分享数据删除成功！'));
		exit;
    }
	//删除参与活动粉丝分享数据
	//参与活动粉丝奖品数据
	public function doWebPrizedata() {
        global $_GPC, $_W;
		$rid = $_GPC['rid'];
		$rid = empty($rid) ? $_GPC['id'] : $rid;
		$reply = pdo_fetch("select poweravatar,mobileverify from ".tablename('stonefish_scenesign_reply')." where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//查询do参数
		if(empty($_GPC['do'])){
			$_GPC['do'] = pdo_fetchcolumn("select do from " . tablename('modules_bindings') . "  where eid = :eid and module=:module", array(':eid' => $_GPC['eid'], ':module' => 'stonefish_scenesign'));
		}
		//查询do参数
		//查询是否有商户网点权限
		$modules = uni_modules($enabledOnly = true);
		$modules_arr = array();
		$modules_arr = array_reduce($modules, create_function('$v,$w', '$v[$w["mid"]]=$w["name"];return $v;'));
		if(in_array('stonefish_branch',$modules_arr)){
		    $stonefish_branch = true;
		}
		//查询是否有商户网点权限
		//所有奖品类别
		$award = pdo_fetchall("select * FROM " . tablename('stonefish_scenesign_prize') . " where rid = :rid and uniacid=:uniacid ORDER BY `id` asc", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		foreach ($award as $k =>$awards) {
			$award[$k]['num'] = pdo_fetchcolumn("select count(id) FROM " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid=:uniacid and prizeid=:prizeid", array(':rid' => $rid, ':uniacid' => $_W['uniacid'], ':prizeid' => $awards['id']));
		}
		//所有奖品类别
		$params = array(':rid' => $rid, ':uniacid' => $_W['uniacid']);
		if (!empty($_GPC['nickname'])) {
			$sql_from_user = "SELECT GROUP_CONCAT(from_user) AS from_user_list FROM ".tablename('stonefish_scenesign_fans')." WHERE rid = :rid and uniacid=:uniacid and nickname LIKE :nickname";
		    $from_user_list = pdo_fetchcolumn($sql_from_user, array(':rid' => $rid, ':uniacid' => $_W['uniacid'], ':nickname' => "%{$_GPC['nickname']}%"));
			if(!empty($from_user_list)){
				$from_user_list = str_replace(",","','",$from_user_list);
				$from_user_list = "'".$from_user_list."'";
				$where.=' and from_user in ('.$from_user_list.')';
			}
        }
		if (!empty($_GPC['realname'])) {     
			$sql_from_user = "SELECT GROUP_CONCAT(from_user) AS from_user_list FROM ".tablename('stonefish_scenesign_fans')." WHERE rid = :rid and uniacid=:uniacid and realname LIKE :realname";
		    $from_user_list = pdo_fetchcolumn($sql_from_user, array(':rid' => $rid, ':uniacid' => $_W['uniacid'], ':realname' => "%{$_GPC['realname']}%"));
			if(!empty($from_user_list)){
				$from_user_list = str_replace(",","','",$from_user_list);
				$from_user_list = "'".$from_user_list."'";
				$where.=' and from_user in ('.$from_user_list.')';
			}
        }
		if (!empty($_GPC['mobile'])) {     
			$sql_from_user = "SELECT GROUP_CONCAT(from_user) AS from_user_list FROM ".tablename('stonefish_scenesign_fans')." WHERE rid = :rid and uniacid=:uniacid and mobile LIKE :mobile";
		    $from_user_list = pdo_fetchcolumn($sql_from_user, array(':rid' => $rid, ':uniacid' => $_W['uniacid'], ':mobile' => "%{$_GPC['mobile']}%"));
			if(!empty($from_user_list)){
				$from_user_list = str_replace(",","','",$from_user_list);
				$from_user_list = "'".$from_user_list."'";
				$where.=' and from_user in ('.$from_user_list.')';
			}
        }
		//导出标题以及参数设置
		if($_GPC['zhongjiang']==''){
		    $statustitle = '全部';
			$where.=' and zhongjiang>=1';
		}
		if($_GPC['zhongjiang']==1){
		    $statustitle = '未兑换';
			$where.=' and zhongjiang=1';
		}
		if($_GPC['zhongjiang']==2){
		    $statustitle = '已兑换';
			$where.=' and zhongjiang>=2';
		}		
		if($_GPC['xuni']==1){
		    $statustitle .= '虚拟';
			$where.=' and xuni=1';
		}
		if($_GPC['xuni']=='2'){
		    $statustitle .= '真实';
			$where.=' and xuni=0';
		}
		if($_GPC['tickettype']==1){
		    $statustitle .= '后台兑奖';
			$where.=' and tickettype=1';
		}
		if($_GPC['tickettype']==2){
		    $statustitle .= '店员兑奖';
			$where.=' and tickettype=2';
		}
		if($_GPC['tickettype']==4){
		    $statustitle .= '密码兑奖';
			$where.=' and tickettype=4';
		}
		if($_GPC['tickettype']==5){
		    $statustitle .= '奖品密码兑奖';
			$where.=' and tickettype=5';
		}
		if (!empty($_GPC['prizeid'])) {
            $statustitle .= pdo_fetchcolumn("select prizerating FROM ".tablename('stonefish_scenesign_prize')." where id=:prizeid", array(':prizeid' => $_GPC['prizeid']));;
			$where.=' and prizeid=:prizeid';
            $params[':prizeid'] = $_GPC['prizeid'];
        }
		
		//导出标题以及参数设置				
		$total = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid=:uniacid" . $where . "", $params);
        $psize = 20;
		$pagemax = ceil($total/$psize);
		$_GPC['page'] = $_GPC['page']>$pagemax ? $pagemax : $_GPC['page'];
        $pindex = max(1, intval($_GPC['page']));
        $pager = pagination($total, $pindex, $psize);
        $start = ($pindex - 1) * $psize;
        $limit .= " LIMIT {$start},{$psize}";
        $list = pdo_fetchall("select * from " . tablename('stonefish_scenesign_fansaward') . " where rid = :rid and uniacid=:uniacid" . $where . " order by id desc " . $limit, $params);
		//奖品名称
		foreach ($list as &$lists) {
			$fans = pdo_fetch("select id, avatar, nickname, realname, mobile from " . tablename('stonefish_scenesign_fans') . "  where from_user = :from_user", array(':from_user' =>$lists['from_user']));
			$lists['fid'] =$fans['id'];
			$lists['avatar'] =$fans['avatar'];
			$lists['nickname'] =$fans['nickname'];
			$lists['realname'] =$fans['realname'];
			$lists['mobile'] =$fans['mobile'];
			$prize = pdo_fetch("select prizerating,prizename from " . tablename('stonefish_scenesign_prize') . "  where id = :id", array(':id' =>$lists['prizeid']));
			$lists['prizerating'] =$prize['prizerating'];
			$lists['prizename'] =$prize['prizename'];
			$lists['fanid'] = pdo_fetchcolumn("select fanid FROM ".tablename('mc_mapping_fans') ." where openid=:openid and uniacid=:uniacid",array(":openid"=>$lists['from_user'],":uniacid"=>$_W['uniacid']));
		}
		//奖品名称
		//一些参数的显示
        $num1 = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_fansaward') . "  where rid = :rid and uniacid=:uniacid and zhongjiang>=1 and tickettype=1", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
        $num2 = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_fansaward') . "  where rid = :rid and uniacid=:uniacid and zhongjiang>=1 and tickettype=2", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		$num4 = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_fansaward') . "  where rid = :rid and uniacid=:uniacid and zhongjiang>=1 and tickettype=4", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		$num5 = pdo_fetchcolumn("select count(id) from " . tablename('stonefish_scenesign_fansaward') . "  where rid = :rid and uniacid=:uniacid and zhongjiang>=1 and tickettype=5", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//一些参数的显示
        include $this->template('prizedata');
    }
	//参与活动粉丝奖品数据
	//设置奖品兑换状态
	public function doWebSetprizestatus() {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
		$rid = intval($_GPC['rid']);
		$pid = intval($_GPC['pid']);
        $zhongjiang = intval($_GPC['zhongjiang']);
		$exchange = pdo_fetch("select inventory,tickettype FROM ".tablename("stonefish_scenesign_exchange")." where rid = :rid", array(':rid' => $rid));
		if (empty($id)) {
            message('抱歉，传递的参数错误！', '', 'warning');
        }
		//查询奖品数量
		$prize = pdo_fetch("select * FROM " . tablename('stonefish_scenesign_prize') . " where id = :id ORDER BY `id` DESC", array(':id' => $pid));
		if($zhongjiang == 2 && $prize['prizetotal']<=$prize['prizedraw']){
			message('抱歉，没有足够的奖品发放了！', '', 'warning');
		}
		//查询奖品数量
        $p = array('zhongjiang' => $zhongjiang);
        if ($zhongjiang == 2) {
            $p['consumetime'] = TIMESTAMP;
			$p['tickettype'] = 1;
			$p['ticketname'] = $_W['username'];
        }
        if ($zhongjiang == 1) {
            $p['consumetime'] = '0';
			$p['zhongjiang'] = 1;
			$p['tickettype'] = $exchange['tickettype'];
			$p['ticketid'] = 0;
			$p['ticketname'] = '';
        }
        $temp = pdo_update('stonefish_scenesign_fansaward', $p, array('id' => $id));
		if($exchange['inventory']==2 && $zhongjiang == 2){
			pdo_update('stonefish_scenesign_prize', array('prizedraw' => $prize['prizedraw']+1), array('id' => $pid));
		}
		if($exchange['inventory']==2 && $zhongjiang == 1){
			pdo_update('stonefish_scenesign_prize', array('prizedraw' => $prize['prizedraw']-1), array('id' => $pid));
		}
        if ($temp == false) {
            message('抱歉，刚才操作数据失败！', '', 'warning');
        } else {
		    //修改用户状态
			$from_user = pdo_fetchcolumn("select from_user FROM " . tablename('stonefish_scenesign_fansaward') . " where id = :id ORDER BY `id` DESC", array(':id' => $id));
			pdo_update('stonefish_scenesign_fans', array('zhongjiang' => $zhongjiang), array('rid' => $rid,'uniacid' => $_W['uniacid'],'from_user' => $from_user));
			message('奖品兑换状态设置成功！', $this->createWebUrl('prizedata',array('rid'=>$_GPC['rid'], 'page' => intval($_GPC['page']))), 'success');
        }
    }
	//设置奖品兑换状态
	//删除中奖记录数据
	public function doWebDeleteprizedata() {
        global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$reply = pdo_fetch("select * from ".tablename('stonefish_scenesign_reply')." where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
        $exchange = pdo_fetch("select inventory,tickettype FROM ".tablename("stonefish_scenesign_exchange")." where rid = :rid", array(':rid' => $rid));
		if(empty($reply)){
			echo json_encode(array('errno' => 1,'error' => '抱歉，传递的参数错误！'));
			exit;
        }
        foreach ($_GPC['idArr'] as $k => $id) {
            $id = intval($id);
            if($id == 0)
                continue;
			$fansaward = pdo_fetch("select prizeid,from_user,zhongjiang from ".tablename('stonefish_scenesign_fansaward')." where id = :id", array(':id' => $id));
			$from_user = $fansaward['from_user'];
			$fans = pdo_fetch("select * from ".tablename('stonefish_scenesign_fans')." where rid = :rid and  uniacid = :uniacid and  from_user = :from_user", array(':rid' => $rid,':uniacid'=>$_W['uniacid'],':from_user'=>$from_user));
            if(empty($fansaward)){
				echo json_encode(array('errno' => 1,'error' => '抱歉，选中的中奖数据不存在！'));
				exit;
            }
			$prize = pdo_fetch("select prizetype,prizevalue,prizedraw FROM " . tablename('stonefish_scenesign_prize') . " where id = :id ORDER BY `id` DESC", array(':id' => $fansaward['prizeid']));
			//修改积分到粉丝数据库
			if($prize['prizetype']!='physical' && $prize['prizetype']!='virtual'){
				load()->model('mc');
			    $uid = pdo_fetchcolumn("select uid FROM ".tablename('mc_mapping_fans') ." where openid=:openid and uniacid=:uniacid",array(":openid"=>$from_user,":uniacid"=>$_W['uniacid']));
			    $unisetting_s = uni_setting($uniacid, array('creditnames'));
		        foreach ($unisetting_s['creditnames'] as $key=>$credit) {
		    	    if ($prize['prizetype']==$key) {
			    	    $credit_names = $credit['title'];
					    break;
			        }
		        }
			    mc_credit_update($uid, $prize['prizetype'], -$prize['prizevalue'], array($_W['uid'], '占领朋友圈取消中奖扣除'.$prize['prizevalue'].'个'.$credit_names));
			}
			//修改积分到粉丝数据库
			if($exchange['inventory']==1 && $fansaward['zhongjiang']>=1){
				pdo_update('stonefish_scenesign_prize', array('prizedraw' => $prize['prizedraw']-1), array('id' => $fansaward['prizeid']));
			}
			if($exchange['inventory']==2 && $fansaward['zhongjiang']>=2){
				pdo_update('stonefish_scenesign_prize', array('prizedraw' => $prize['prizedraw']-1), array('id' => $fansaward['prizeid']));
			}
			//删除粉丝中奖记录
			pdo_delete('stonefish_scenesign_fansaward', array('id' => $id));
			//删除粉丝中奖记录
			//查询此用户是否还有中奖记录并更新状态
			$yes = pdo_fetch("select * FROM ".tablename('stonefish_scenesign_fansaward') ." where from_user=:from_user and uniacid=:uniacid and rid=:rid and zhongjiang>=1",array(":from_user"=>$from_user,":uniacid"=>$_W['uniacid'],":rid"=>$rid));
			if(empty($yes)){
				pdo_update('stonefish_scenesign_fans', array('zhongjiang' => 0), array('rid' => $rid,'uniacid' => $_W['uniacid'],'from_user' => $from_user));
			}
			//查询此用户是否还有中奖记录并更新状态
        }
		echo json_encode(array('errno' => 0,'error' => '选中的中奖数据删除成功！'));
		exit;
    }
	//删除中奖记录数据
	//手机验证记录
	public function doWebmobileverify() {
        global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$rid = empty($rid) ? intval($_GPC['id']) : $rid;
		$reply = pdo_fetch("select poweravatar,mobileverify from ".tablename('stonefish_scenesign_reply')." where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//查询do参数
		if(empty($_GPC['do'])){
			$_GPC['do'] = pdo_fetchcolumn("select do from " . tablename('modules_bindings') . "  where eid = :eid and module=:module", array(':eid' => $_GPC['eid'], ':module' => 'stonefish_scenesign'));
		}
		//查询do参数
		$params = array(':rid' => $rid, ':uniacid' => $_W['uniacid']);
		if (!empty($_GPC['mobile'])) {
            $where.=' and mobile=:mobile';
            $params[':mobile'] = $_GPC['mobile'];
        }
		if ($_GPC['verifytime']!='') {
            if ($_GPC['verifytime']==1) {
				$where.=' and verifytime>0';
			}else{
				$where.=' and verifytime=0';
			}
        }
		$total = pdo_fetchcolumn("select count(id) FROM " . tablename('stonefish_scenesign_mobileverify') . "  where rid = :rid and uniacid=:uniacid ".$where."", $params);
        $psize = 20;
		$pagemax = ceil($total/$psize);
		$_GPC['page'] = $_GPC['page']>$pagemax ? $pagemax : $_GPC['page'];
        $pindex = max(1, intval($_GPC['page']));
        $pager = pagination($total, $pindex, $psize);
        $start = ($pindex - 1) * $psize;
        $limit .= " LIMIT {$start},{$psize}";
        $list = pdo_fetchall("select * FROM " . tablename('stonefish_scenesign_mobileverify') . " where rid = :rid and uniacid=:uniacid ".$where." ORDER BY id DESC " . $limit, $params);
        include $this->template('mobileverify');
    }
	//手机验证记录
	//导入手机验证记录
	public function doWebMobileverifyImporting() {
        global $_GPC, $_W;
		if($_W['isajax']) {
		    $rid = intval($_GPC['rid']);
			$reply = pdo_fetch("select mobileverify from ".tablename('stonefish_scenesign_reply')." where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
			include $this->template('mobileverifyimporting');
			exit();
		}
    }
	public function doWebMobileverifyimportingsave() {
        global $_GPC, $_W;		
		$rid = intval($_GPC['rid']);
		if(!$rid){
		    message('系统出错', url('site/entry/mobileverify',array('rid' => $rid, 'm' => 'stonefish_scenesign')), 'error');
			exit;
		}
		if(empty($_FILES["inputExcel"]["tmp_name"])){
			message('系统出错', url('site/entry/mobileverify',array('rid' => $rid, 'm' => 'stonefish_scenesign')), 'error');
			exit;
		}
		$inputFileName = '../addons/stonefish_scenesign/template/moban/excel/'.$_FILES["inputExcel"]["name"];
		if (file_exists($inputFileName)){
            unlink($inputFileName);    //如果服务器上存在同名文件，则删除
		}
		move_uploaded_file($_FILES["inputExcel"]["tmp_name"],$inputFileName);
        require_once '../framework/library/phpexcel/PHPExcel.php';
        require_once '../framework/library/phpexcel/PHPExcel/IOFactory.php';
        require_once '../framework/library/phpexcel/PHPExcel/Reader/Excel5.php';			
		//设置php服务器可用内存，上传较大文件时可能会用到
		ini_set('memory_limit', '1024M');
		$objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format 
		$objPHPExcel = $objReader->load($inputFileName); 
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow();           //取得总行数 
		$highestColumn = $sheet->getHighestColumn(); //取得总列数
			
		$objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow(); 

        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);//总列数
            
        $headtitle=array(); 
        for ($row = 2;$row <= $highestRow;$row++){
            $strs=array();
            //注意highestColumnIndex的列数索引从0开始
            for ($col = 0;$col < $highestColumnIndex;$col++){
                $strs[$col] =$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
            //插入数据
			$chongfu = pdo_fetch("select id FROM ".tablename('stonefish_scenesign_mobileverify')." where mobile =:mobile and uniacid=:uniacid and rid=:rid", array(':mobile' => $strs[0],':uniacid' => $_W['uniacid'],':rid' => $rid));
			$data = array(
					'uniacid' => $_W['uniacid'],
					'rid' => $rid,
					'realname' => $strs[0],
					'mobile' => $strs[1],
					'welfare' => $strs[2],
					'status' => 2,
					'createtime' => time()
			);
			if (!empty($chongfu)){
				pdo_update('stonefish_scenesign_mobileverify', $data, array('id' => $chongfu['id']));
			}else{
				pdo_insert('stonefish_scenesign_mobileverify', $data);
			}
        }
        unlink($inputFileName); //删除上传的excel文件
        message('导入手机验证成功', url('site/entry/mobileverify',array('rid' => $rid, 'm' => 'stonefish_scenesign')));
		exit;    
    }
	//导入手机验证记录
	//修改手机验证记录
	public function doWebAddmobileverify() {
        global $_GPC, $_W;
		if($_W['isajax']) {
			$rid = intval($_GPC['rid']);
			$op = 'add';
			$reply = pdo_fetch("select mobileverify FROM ".tablename('stonefish_scenesign_reply')." where rid = :rid", array(':rid' => $rid));
			$data['status'] =2;
			include $this->template('mobileverifyedit');
			exit();
		}
    }
	public function doWebEditmobileverify() {
        global $_GPC, $_W;
		if($_W['isajax']) {
			$uid = intval($_GPC['uid']);
			$rid = intval($_GPC['rid']);
			$reply = pdo_fetch("select mobileverify FROM ".tablename('stonefish_scenesign_reply')." where rid = :rid", array(':rid' => $rid));
			$data = pdo_fetch("select * FROM " . tablename('stonefish_scenesign_mobileverify') . ' where id = :id AND uniacid = :uniacid', array(':uniacid' => $_W['uniacid'], ':id' => $uid));
			include $this->template('mobileverifyedit');
			exit();
		}
    }
	public function doWebEditmobileverifysave() {
        global $_GPC, $_W;
		$uid = intval($_GPC['uid']);
		$rid = intval($_GPC['rid']);
		$status = intval($_GPC['status']);
		$op = $_GPC['op'];
		if(!$rid){
		    message('系统出错', url('site/entry/mobileverify',array('rid' => $rid, 'm' => 'stonefish_scenesign','page' => intval($_GPC['page']))), 'error');
		}
		$reply = pdo_fetch("select mobileverify FROM ".tablename('stonefish_scenesign_reply')." where rid = :rid", array(':rid' => $rid));
		if (empty($_GPC['mobile'])){
			message('必需输入手机号', url('site/entry/mobileverify',array('rid' => $rid, 'm' => 'stonefish_scenesign','page' => intval($_GPC['page']))), 'error');
		}
		if($uid && empty($op)) {
		    //次数
			$chongfu = pdo_fetch("select id FROM ".tablename('stonefish_scenesign_mobileverify')." where mobile =:mobile and uniacid=:uniacid and rid=:rid and id<>:id", array(':mobile' => $_GPC['mobile'],':uniacid' => $_W['uniacid'],':rid' => $rid,':id' => $uid));
			if (empty($chongfu)){
				pdo_update('stonefish_scenesign_mobileverify', array('realname' => $_GPC['realname'],'mobile' => $_GPC['mobile'],'status' => $status), array('id' => $uid));
				if($reply['mobileverify']==2){
					pdo_update('stonefish_scenesign_mobileverify', array('welfare' => $_GPC['welfare']), array('id' => $uid));
				}
			    message('修改手机验证成功', url('site/entry/mobileverify',array('rid' => $rid, 'm' => 'stonefish_scenesign','page' => intval($_GPC['page']))));
			}else{
				message('此手机号已存在', url('site/entry/mobileverify',array('rid' => $rid, 'm' => 'stonefish_scenesign','page' => intval($_GPC['page']))), 'error');
			}
		}else{
			if(!empty($op)){
				$chongfu = pdo_fetch("select id FROM ".tablename('stonefish_scenesign_mobileverify')." where mobile =:mobile and uniacid=:uniacid and rid=:rid", array(':mobile' => $_GPC['mobile'],':uniacid' => $_W['uniacid'],':rid' => $rid));
			    if (empty($chongfu)){
					$data = array(
					    'uniacid' => $_W['uniacid'],
					    'rid' => $rid,
					    'realname' => $_GPC['realname'],
					    'mobile' => $_GPC['mobile'],
					    'status' => $status,
					    'createtime' => time()
			        );
					if($reply['mobileverify']==2){
						$data['welfare'] = $_GPC['welfare'];
					}
					pdo_insert('stonefish_scenesign_mobileverify', $data);
			        message('添加手机验证成功', url('site/entry/mobileverify',array('rid' => $rid, 'm' => 'stonefish_scenesign','page' => intval($_GPC['page']))));
			    }else{
				    message('此手机号已存在', url('site/entry/mobileverify',array('rid' => $rid, 'm' => 'stonefish_scenesign','page' => intval($_GPC['page']))), 'error');
			    }
			}else{
				message('未找到指定用户', url('site/entry/mobileverify',array('rid' => $rid, 'm' => 'stonefish_scenesign','page' => intval($_GPC['page']))), 'error');
			}
		}
    }
	//修改手机验证记录
	//手机验证记录状态
	public function doWebSetmobileverifycheck() {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
        $type = $_GPC['type'];
        $data = intval($_GPC['data']);
        if (in_array($type, array('status'))) {
            $data = ($data==2?'1':'2');
            pdo_update("stonefish_scenesign_mobileverify", array("status" => $data), array("id" => $id, "uniacid" => $_W['uniacid']));
            die(json_encode(array("result" => 1, "data" => $data)));
        }
        die(json_encode(array("result" => 0)));
    }
	//手机验证记录状态
	//删除手机验证记录
	public function doWebDeletemobileverify() {
        global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$reply = pdo_fetch("select * FROM ".tablename('stonefish_scenesign_reply')." where rid = :rid", array(':rid' => $rid));
        if (empty($reply)) {
			echo json_encode(array('errno' => 1,'error' => '抱歉，要修改的活动不存在或是已经被删除！'));
			exit;
        }
        foreach ($_GPC['idArr'] as $k => $id) {
            $id = intval($id);
            if ($id == 0)
                continue;
            //删除使用记录
			$doings = pdo_fetch("select * FROM " . tablename('stonefish_scenesign_mobileverify') . " where id = :id", array(':id' => $id));
			if(empty($doings)){
				continue;
			}
			//删除赠送记录
			pdo_delete('stonefish_scenesign_mobileverify', array('id' => $id));
			//删除赠送记录
        }
		echo json_encode(array('errno' => 0,'error' => '手机验证记录删除成功！'));
		exit;
    }
	//删除手机验证记录
	//导出数据
	public function doWebDownload() {
        require_once 'download.php';
    }
	//导出数据
	//借用ＪＳ分享
	function getSignPackage($appId,$appSecret) {
		global $_W;
        $jsapiTicket = $this->getJsApiTicket($_W['uniacid'],$appId,$appSecret);
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $timestamp = time();
        $nonceStr = $this->createNonceStr();
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string1 = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string1);
		$signPackage = array(
			"appId"		=> $appId,
			"nonceStr"	=> $nonceStr,
			"timestamp" => "$timestamp",
			"signature" => $signature,
		);
		
		if(DEVELOPMENT) {
			$signPackage['url'] = $url;
			$signPackage['string1'] = $string1;
			$signPackage['name'] = $_W['account']['name'];
		}        
        return $signPackage;
    }

    function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    function getJsApiTicket($uniacid,$appId,$appSecret) {
        load()->func('cache');
        $api = cache_load("stonefish_scenesign.api_share.json::".$uniacid, true);
        $new = false;
        if(empty($api['appid']) || $api['appid']!==$appId){
            $new = true;
        }
        if(empty($api['appsecret']) || $api['appsecret']!==$appSecret){
            $new = true;
        }      
        $data = cache_load("stonefish_scenesign.jsapi_ticket.json::".$uniacid, true);
        if (empty($data['expire_time']) || $data['expire_time'] < time() || $new) {
            $accessToken = $this->getAccessToken($uniacid,$appId,$appSecret);       
            $url = "http://api.weixin.qq.com/cgi-bin/ticket/getticket?type=1&access_token=$accessToken";
            $res = json_decode($this->httpGet($url));
            $ticket = $res->ticket;
            if ($ticket) {
                $data['expire_time'] = time() + 7000;
                $data['jsapi_ticket'] = $ticket;
                cache_write("stonefish_scenesign.jsapi_ticket.json::".$uniacid, iserializer($data));
                cache_write("stonefish_scenesign.api_share.json::".$uniacid, iserializer(array("appid"=>$appId,"appsecret"=>$appSecret)));
            }
        } else {
            $ticket = $data['jsapi_ticket'];
        }
        return $ticket;
    }

    function getAccessToken($uniacid,$appId,$appSecret) {
        load()->func('cache');
        $api = cache_load("stonefish_scenesign.api_share.json::".$uniacid, true);
        $new = false;
        if(empty($api['appid']) || $api['appid']!==$appId){
            $new = true;
        }
        if(empty($api['appsecret']) || $api['appsecret']!==$appSecret){
            $new = true;
        }
        $data = cache_load("stonefish_scenesign.access_token.json::".$uniacid, true);     
        if (empty($data['expire_time']) || $data['expire_time'] < time() || $new) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appId&secret=$appSecret";
            $res = json_decode($this->httpGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data['expire_time'] = time() + 7000;
                $data['access_token'] = $access_token;
                cache_write("stonefish_scenesign.access_token.json::".$uniacid, iserializer($data));
                cache_write("stonefish_scenesign.api_share.json::".$uniacid, iserializer(array("appid"=>$appId,"appsecret"=>$appSecret)));
            }
        } else {
            $access_token = $data['access_token'];
        }
        return $access_token;
    }
	function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }
	//借用ＪＳ分享
}