<?php
/**
 * 新田源码 bbs.xtec.cc模块微站定义
 *
 */
defined('IN_IA') or exit('Access Denied');
define('JS', '../addons/n1ce_mission/style/js/');
include 'huanghe_function.php';
include 'monUtil.class.php';
class N1ce_missionModuleSite extends WeModuleSite {
	public $table_reply = 'n1ce_mission_reply';
	public $table_fans = 'n1ce_mission_fans';
	public function doMobileIplimit(){
		global $_GPC, $_W;
		$rid = $_GPC['rid'];
		$openid = base64_decode($_GPC['openid']);
		load()->model('mc');
		$mc = mc_fetch($openid);
		$reply = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_reply') . " WHERE rid = :rid AND uniacid = :uniacid ORDER BY `id` DESC", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		if($reply['iptype'] == 1){
			$uu="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=".$_W['clientip'];
			$kk=json_decode($this->api_notice_increment($uu)); 
			if($reply['xzlx'] == 1){
				$clientcity=$kk->province;
			}else{
				$clientcity=$kk->city;
			}
			if(strpos($reply['area'],$clientcity)===false){	
				$msg = "只允许".$reply['area']."区域的IP参与活动,您的IP所属区域为".$clientcity;
				message($msg,'',error);
			}
			$img = $this->createPoster($mc, $reply , $openid);
			//return $this->respText($openid);
			$media_id = $this->uploadImage($img);
			if ($reply['first_info']) {
				$info = str_replace('#时间#', date('Y-m-d H:i', time() + 30 * 24 * 3600), $reply['first_info']);
				$info = str_replace('#昵称#', $mc['nickname'], $info);
				$this->sendText($openid, $info);
				
			}
			if ($reply['miss_wait']) {
				sleep(1);
				$miss_wait = str_replace('#昵称#', $mc['nickname'], $reply['miss_wait']);
				$this->sendText($openid, $miss_wait);
			}
			$this->sendImage($openid, $media_id);
		}
		include $this->template('iplimit');
	}
	public function doMobileGpslimit(){
		global $_GPC, $_W;
		
		$rid = $_GPC['rid'];
		$openid = $_GPC['openid'];
		load()->model('mc');
		$mc = mc_fetch($openid);
		$reply = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_reply') . " WHERE rid = :rid AND uniacid = :uniacid ORDER BY `id` DESC", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		$loc="";
		if (!empty($_GPC['latitude']) && !empty($_GPC['longitude'])){
			$loc=$_GPC['latitude'].",".$_GPC['longitude'];
		}else{
			exit(json_encode(array('status' => 1, 'msg' => "获取位置失败,请重试！")));
		}
		$url="http://api.map.baidu.com/geocoder/v2/?ak=qen1OGw9ddzoDQrTX35gote2&location=".$loc."&output=json";
		$ret=json_decode(file_get_contents($url),true);
		if($reply['xzlx'] == 1){
			$clientcity=$ret['result']['addressComponent']['province'];
		}elseif($reply['xzlx'] == 2){
			$clientcity=$ret['result']['addressComponent']['district'];
		}else{
			$clientcity=$ret['result']['addressComponent']['city'];
		}
		$clientcity = str_replace('市','',$clientcity);
		$clientcity = str_replace('省','',$clientcity);
		if(strpos($reply['area'],$clientcity)===false){	
			$msg = "只允许".$reply['area']."区域的GPS参与活动,您的GPS所在区域为".$clientcity;
			exit(json_encode(array('status' => 2, 'msg' => $msg)));
		}
		$img = $this->createPoster($mc, $reply , $openid);
		//return $this->respText($openid);
		$media_id = $this->uploadImage($img);
		if ($reply['first_info']) {
			$info = str_replace('#时间#', date('Y-m-d H:i', time() + 30 * 24 * 3600), $reply['first_info']);
			$info = str_replace('#昵称#', $mc['nickname'], $info);
			$this->sendText($openid, $info);
			
		}
		if ($reply['miss_wait']) {
			sleep(1);
			$miss_wait = str_replace('#昵称#', $mc['nickname'], $reply['miss_wait']);
			$this->sendText($openid, $miss_wait);
		}
		$this->sendImage($openid, $media_id);
		exit(json_encode(array('status' => 3, 'msg' => "ok")));
	}
	//限定扫描粉丝
	public function doMobileFanslimit(){
		global $_GPC, $_W;
		$rid = $_GPC['rid'];
		$openid = $_GPC['openid'];
		$scene_id = $_GPC['sceneid'];
		$settings = $this->module['config'];
		load()->model('mc');
		$mc = mc_fetch($openid);
		$reply = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_reply') . " WHERE rid = :rid AND uniacid = :uniacid ORDER BY `id` DESC", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		if($reply['iptype'] == 1){
			$uu="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=".$_W['clientip'];
			$kk=json_decode($this->api_notice_increment($uu)); 
			if($reply['xzlx'] == 1){
				$clientcity=$kk->province;
			}else{
				$clientcity=$kk->city;
			}
			if(strpos($reply['area'],$clientcity)===false){	
				$msg = "只允许".$reply['area']."区域的IP参与活动,您的IP所属区域为".$clientcity;
				message($msg,'',error);
			}
			//找出上级openid
			$fans = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_fans') . " WHERE uniacid = :uniacid and sceneid= :sceneid and rid = :rid", array(':uniacid' => $_W['uniacid'], ':sceneid' => $scene_id, ':rid' => $rid));
			//是否取消关注扫码
			$isfans = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_fans') . " WHERE uniacid = :uniacid and from_user=:from_user and rid = :rid", array(':uniacid' => $_W['uniacid'], ':from_user' => $openid, ':rid' => $rid));
			if (empty($isfans)) {
				//表中不存在入库
				$insert = array(
					'uniacid' => $_W['uniacid'],
					'rid' => $rid,
					'from_user' => $openid,
					'nickname' => $mc['nickname'],
					'headimgurl' => $mc['avatar'],
					'follow' => '1',
					'createtime' => TIMESTAMP,
				);
				pdo_insert('n1ce_mission_fans' , $insert);
				$insertid = pdo_insertid();
				//提示扫码关注用户
				$miss_sub = str_replace('#昵称#', $mc['nickname'], $reply['miss_sub']);
				$this->postText($openid, $miss_sub);
				//任务处理多任务处理
				$prizes = pdo_fetchall("SELECT * FROM " . tablename('n1ce_mission_prize') . " WHERE uniacid = :uniacid and rid = :rid order by miss_num ASC", array(':uniacid' => $_W['uniacid'], ':rid' => $rid));
				foreach($prizes as $key => $vol){
					if ($vol['miss_num'] > 0 && $fans['miss_num'] < $vol['miss_num']) {
						//black name
						$info2 = str_replace('#昵称#', $mc['nickname'], $reply['miss_back']);
						//updata zhuli
						$updata = array(
							'miss_num' => $fans['miss_num'] + 1 ,
						); 
						pdo_update('n1ce_mission_fans',$updata,array('uniacid' => $_W['uniacid'], 'from_user' => $fans['from_user'],'rid' => $rid,'sceneid' => $scene_id));
						//achevie mission
						
						$jixu = $vol['miss_num'] - $updata['miss_num'];
						$costext = str_replace('#昵称#', $mc['nickname'], $reply['miss_back']);
						$costext = str_replace('#人气值#', $updata['miss_num'], $costext);
						$costext = str_replace('#差值#', $jixu, $costext);
						$costext = str_replace('#奖品#', $vol['prize_name'], $costext);
						$costext = str_replace('#库存#', $vol['prizesum'], $costext);
						if($updata['miss_num'] == $vol['miss_num']){
							//give award
							$havetext = str_replace('#昵称#', $mc['nickname'], $reply['miss_finish']);
							$havetext = str_replace('#人气值#', $updata['miss_num'], $havetext);
							$havetext = str_replace('#奖品#', $vol['prize_name'], $havetext);
							$havetext = str_replace('#库存#', $vol['prizesum'], $havetext);
							if($vol['prizesum'] <= 0){
								$this->postText($fans['from_user'],"很抱歉,您完成当前奖励任务时间太久了,奖品被领完了！继续邀请好友加入即可继续达成下阶段奖励！");
								die();
							}
							
							$uprdata = array(
									'prizesum' => $vol['prizesum'] - 1 ,
								); 
							pdo_update('n1ce_mission_prize',$uprdata,array('uniacid' => $_W['uniacid'], 'rid' => $rid,'id' => $vol['id']));
							$infoinsert = array(
								'rid' => $rid,
								'uniacid' => $_W['uniacid'],
								'openid' => $fans['from_user'],
								'nickname' => $fans['nickname'],
								'miss_num' => $updata['miss_num'],
								'headimgurl' => $fans['headimgurl'],
								'time' => TIMESTAMP,
							);
							if($vol['type'] == '1'){
								$this->postText($fans['from_user'],$havetext);
								$money = rand($vol['min_money'], $vol['max_money']);
								$action = $this->sendRedPacket($fans['from_user'], $money);
								if($action === true){
									$infoinsert['type'] = "1";
									$infoinsert['money'] = $money;
									$infoinsert['status'] = "1";
									pdo_insert('n1ce_mission_user',$infoinsert);
								}else{
									$infoinsert['type'] = "1";
									$infoinsert['money'] = $money;
									$infoinsert['status'] = "2";
									pdo_insert('n1ce_mission_user',$infoinsert);
									$actions = "亲爱的管理员，有粉丝红包领取失败！\n原因：".$action;
									$this->sendText($settings['mopenid'],$actions);
								}
								return $this->respText('');die();
							}
							if($vol['type'] == '2'){
								$this->postText($fans['from_user'],$havetext);
								$res = $this->sendWxCard($fans['from_user'],$vol['cardid']);
								$infoinsert['type'] = "2";
								$infoinsert['status'] = "1";
								pdo_insert('n1ce_mission_user',$infoinsert);
								return $this->respText('');die();
							}
							if($vol['type'] == '3'){
								$appId = $this->module['config']['yzappId'];
								$appSecret = $this->module['config']['yzappSecret'];
								$res = he_youzan_addtags($appId,$appSecret,$fans['from_user'],$vol['lable']);
								if($res['response']){
									$url = $vol['url'];
									$msgshop = str_replace('#昵称#', $mc['nickname'], $reply['miss_youzan']);
									$msgshop = str_replace('#人气值#', $updata['miss_num'], $msgshop);
									$msgshop = str_replace('#奖品#', $vol['prize_name'], $msgshop);
									$msgshop = str_replace('#库存#', $vol['prizesum'], $msgshop);
									$msgshop = str_replace('#有赞#', $url, $msgshop);
									$this->postText($fans['from_user'],$msgshop);
									$infoinsert['type'] = "3";
									$infoinsert['status'] = "1";
									pdo_insert('n1ce_mission_user',$infoinsert);
								}
								return $this->respText('');die();
							}
							if($vol['type'] == '4'){
								$this->postText($fans['from_user'],$havetext);
								load()->model('mc');
								$uid = mc_openid2uid($fans['from_user']);
								$res = mc_credit_update($uid, 'credit1', $vol['credit'], array(0, '系统积分'.$vol['credit'].'积分'));
								$infoinsert['type'] = "4";
								$infoinsert['status'] = "1";
								pdo_insert('n1ce_mission_user',$infoinsert);
								return $this->respText('');die();
							}
							if($vol['type'] == '5'){
								$url = $vol['url'];
								$msgshop = str_replace('#昵称#', $mc['nickname'], $reply['miss_youzan']);
								$msgshop = str_replace('#人气值#', $updata['miss_num'], $msgshop);
								$msgshop = str_replace('#奖品#', $vol['prize_name'], $msgshop);
								$msgshop = str_replace('#库存#', $vol['prizesum'], $msgshop);
								$msgshop = str_replace('#有赞#', $url, $msgshop);
								$this->postText($fans['from_user'],$msgshop);
								$infoinsert['type'] = "5";
								$infoinsert['status'] = "1";
								pdo_insert('n1ce_mission_user',$infoinsert);
								return $this->respText('');die();
							}
						}else{
							$this->postText($fans['from_user'],$costext);
						}
						break;
					}
				}
			}else {
				$miss_resub = str_replace('#昵称#', $mc['nickname'], $reply['miss_resub']);
				$this->postText($openid, $miss_resub);
			}
		}
		
		include $this->template('fanslimit');
	}
	//gps
	public function doMobileFansgpslimit(){
		global $_GPC, $_W;
		$settings = $this->module['config'];
		$rid = $_GPC['rid'];
		$openid = $_GPC['openid'];
		$scene_id = $_GPC['scene_id'];
		load()->model('mc');
		$mc = mc_fetch($openid);
		$reply = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_reply') . " WHERE rid = :rid AND uniacid = :uniacid ORDER BY `id` DESC", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		$loc="";
		if (!empty($_GPC['latitude']) && !empty($_GPC['longitude'])){
			$loc=$_GPC['latitude'].",".$_GPC['longitude'];
		}else{
			exit(json_encode(array('status' => 1, 'msg' => "获取位置失败,请重试！")));
		}
		$url="http://api.map.baidu.com/geocoder/v2/?ak=qen1OGw9ddzoDQrTX35gote2&location=".$loc."&output=json";
		$ret=json_decode(file_get_contents($url),true);
		if($reply['xzlx'] == 1){
			$clientcity=$ret['result']['addressComponent']['province'];
		}elseif($reply['xzlx'] == 2){
			$clientcity=$ret['result']['addressComponent']['district'];
		}else{
			$clientcity=$ret['result']['addressComponent']['city'];
		}
		$clientcity = str_replace('市','',$clientcity);
		$clientcity = str_replace('省','',$clientcity);
		if(strpos($reply['area'],$clientcity)===false){	
			$msg = "只允许".$reply['area']."区域的GPS参与活动,您的GPS所在区域为".$clientcity;
			exit(json_encode(array('status' => 2, 'msg' => $msg)));
		}
		//找出上级openid
		$fans = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_fans') . " WHERE uniacid = :uniacid and sceneid= :sceneid and rid = :rid", array(':uniacid' => $_W['uniacid'], ':sceneid' => $scene_id, ':rid' => $rid));
		//是否取消关注扫码
		$isfans = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_fans') . " WHERE uniacid = :uniacid and from_user=:from_user and rid = :rid", array(':uniacid' => $_W['uniacid'], ':from_user' => $openid, ':rid' => $rid));
		if (empty($isfans)) {
			//表中不存在入库
			$insert = array(
				'uniacid' => $_W['uniacid'],
				'rid' => $rid,
				'from_user' => $openid,
				'nickname' => $mc['nickname'],
				'headimgurl' => $mc['avatar'],
				'follow' => '1',
				'createtime' => TIMESTAMP,
			);
			pdo_insert('n1ce_mission_fans' , $insert);
			$insertid = pdo_insertid();
			//提示扫码关注用户
			$miss_sub = str_replace('#昵称#', $mc['nickname'], $reply['miss_sub']);
			$this->postText($openid, $miss_sub);
			//任务处理多任务处理
			$prizes = pdo_fetchall("SELECT * FROM " . tablename('n1ce_mission_prize') . " WHERE uniacid = :uniacid and rid = :rid order by miss_num ASC", array(':uniacid' => $_W['uniacid'], ':rid' => $rid));
			foreach($prizes as $key => $vol){
				if ($vol['miss_num'] > 0 && $fans['miss_num'] < $vol['miss_num']) {
					//black name
					$info2 = str_replace('#昵称#', $mc['nickname'], $reply['miss_back']);
					//updata zhuli
					$updata = array(
						'miss_num' => $fans['miss_num'] + 1 ,
					); 
					pdo_update('n1ce_mission_fans',$updata,array('uniacid' => $_W['uniacid'], 'from_user' => $fans['from_user'],'rid' => $rid,'sceneid' => $scene_id));
					//achevie mission
					
					$jixu = $vol['miss_num'] - $updata['miss_num'];
					$costext = str_replace('#昵称#', $mc['nickname'], $reply['miss_back']);
					$costext = str_replace('#人气值#', $updata['miss_num'], $costext);
					$costext = str_replace('#差值#', $jixu, $costext);
					$costext = str_replace('#奖品#', $vol['prize_name'], $costext);
					$costext = str_replace('#库存#', $vol['prizesum'], $costext);
					if($updata['miss_num'] == $vol['miss_num']){
						//give award
						$havetext = str_replace('#昵称#', $mc['nickname'], $reply['miss_finish']);
						$havetext = str_replace('#人气值#', $updata['miss_num'], $havetext);
						$havetext = str_replace('#奖品#', $vol['prize_name'], $havetext);
						$havetext = str_replace('#库存#', $vol['prizesum'], $havetext);
						if($vol['prizesum'] <= 0){
							$this->postText($fans['from_user'],"很抱歉,您完成当前奖励任务时间太久了,奖品被领完了！继续邀请好友加入即可继续达成下阶段奖励！");
							die();
						}
						
						$uprdata = array(
								'prizesum' => $vol['prizesum'] - 1 ,
							); 
						pdo_update('n1ce_mission_prize',$uprdata,array('uniacid' => $_W['uniacid'], 'rid' => $rid,'id' => $vol['id']));
						$infoinsert = array(
							'rid' => $rid,
							'uniacid' => $_W['uniacid'],
							'openid' => $fans['from_user'],
							'nickname' => $fans['nickname'],
							'miss_num' => $updata['miss_num'],
							'headimgurl' => $fans['headimgurl'],
							'time' => TIMESTAMP,
						);
						if($vol['type'] == '1'){
							$this->postText($fans['from_user'],$havetext);
							$money = rand($vol['min_money'], $vol['max_money']);
							$action = $this->sendRedPacket($fans['from_user'], $money);
							if($action === true){
								$infoinsert['type'] = "1";
								$infoinsert['money'] = $money;
								$infoinsert['status'] = "1";
								pdo_insert('n1ce_mission_user',$infoinsert);
							}else{
								$infoinsert['type'] = "1";
								$infoinsert['money'] = $money;
								$infoinsert['status'] = "2";
								pdo_insert('n1ce_mission_user',$infoinsert);
								$actions = "亲爱的管理员，有粉丝红包领取失败！\n原因：".$action;
								$this->sendText($settings['mopenid'],$actions);
							}
							return $this->respText('');die();
						}
						if($vol['type'] == '2'){
							$this->postText($fans['from_user'],$havetext);
							$res = $this->sendWxCard($fans['from_user'],$vol['cardid']);
							$infoinsert['type'] = "2";
							$infoinsert['status'] = "1";
							pdo_insert('n1ce_mission_user',$infoinsert);
							return $this->respText('');die();
						}
						if($vol['type'] == '3'){
							$appId = $this->module['config']['yzappId'];
							$appSecret = $this->module['config']['yzappSecret'];
							$res = he_youzan_addtags($appId,$appSecret,$fans['from_user'],$vol['lable']);
							if($res['response']){
								$url = $vol['url'];
								$msgshop = str_replace('#昵称#', $mc['nickname'], $reply['miss_youzan']);
								$msgshop = str_replace('#人气值#', $updata['miss_num'], $msgshop);
								$msgshop = str_replace('#奖品#', $vol['prize_name'], $msgshop);
								$msgshop = str_replace('#库存#', $vol['prizesum'], $msgshop);
								$msgshop = str_replace('#有赞#', $url, $msgshop);
								$this->postText($fans['from_user'],$msgshop);
								$infoinsert['type'] = "3";
								$infoinsert['status'] = "1";
								pdo_insert('n1ce_mission_user',$infoinsert);
							}
							return $this->respText('');die();
						}
						if($vol['type'] == '4'){
							$this->postText($fans['from_user'],$havetext);
							load()->model('mc');
							$uid = mc_openid2uid($fans['from_user']);
							$res = mc_credit_update($uid, 'credit1', $vol['credit'], array(0, '系统积分'.$vol['credit'].'积分'));
							$infoinsert['type'] = "4";
							$infoinsert['status'] = "1";
							pdo_insert('n1ce_mission_user',$infoinsert);
							return $this->respText('');die();
						}
						if($vol['type'] == '5'){
							$url = $vol['url'];
							$msgshop = str_replace('#昵称#', $mc['nickname'], $reply['miss_youzan']);
							$msgshop = str_replace('#人气值#', $updata['miss_num'], $msgshop);
							$msgshop = str_replace('#奖品#', $vol['prize_name'], $msgshop);
							$msgshop = str_replace('#库存#', $vol['prizesum'], $msgshop);
							$msgshop = str_replace('#有赞#', $url, $msgshop);
							$this->postText($fans['from_user'],$msgshop);
							$infoinsert['type'] = "5";
							$infoinsert['status'] = "1";
							pdo_insert('n1ce_mission_user',$infoinsert);
							return $this->respText('');die();
						}
					}else{
						$this->postText($fans['from_user'],$costext);
					}
					break;
				}
			}
		}else {
			$miss_resub = str_replace('#昵称#', $mc['nickname'], $reply['miss_resub']);
			$this->postText($openid, $miss_resub);
		}
		exit(json_encode(array('status' => 3, 'msg' => "ok")));
	}
	//订阅号扫描二维码网址
	public function doMobileSubpost(){
		global $_GPC, $_W;
		//获取扫描人的openID等信息
		$brrow = mc_oauth_userinfo();
		//var_dump($brrow);die();
		$rid = $_GPC['rid'];
		$settings = $this->module['config'];
		$suburl = $this->module['config']['suburl'];
		//被扫描人的openID
		$openid = $_GPC['openid'];
		$reply = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_reply') . " WHERE rid = :rid AND uniacid = :uniacid ORDER BY `id` DESC", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		
		if($reply['sex'] == 2 && $brrow['sex'] == 2){//boy
			//return $this->respText("抱歉,您的微信号存在问题,暂不能参与本次活动！");
			message('抱歉,您的微信号存在问题,暂不能参与本次活动！',$suburl,'error');
		}
		if($reply['sex'] == 3 && $brrow['sex'] == 1){//girl
			message('抱歉,您的微信号存在问题,暂不能参与本次活动！',$suburl,'error');
		}
		//ip判定
		if($reply['iptype'] == 1){
			$uu="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=".$_W['clientip'];
			$kk=json_decode($this->api_notice_increment($uu)); 
			if($reply['xzlx'] == 1){
				$clientcity=$kk->province;
			}else{
				$clientcity=$kk->city;
			}
			if(strpos($reply['area'],$clientcity)===false){	
				$msg = "只允许".$reply['area']."区域的IP参与活动,您的IP所属区域为".$clientcity;
				message($msg,'',error);
			}
		}
		//找出上级信息
		$fans = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_fans') . " WHERE uniacid = :uniacid and from_user=:from_user and rid = :rid", array(':uniacid' => $_W['uniacid'], ':from_user' => $openid, ':rid' => $rid));
		//是否取消关注扫码
		$isfans = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_fans') . " WHERE uniacid = :uniacid and bropenid=:bropenid and rid = :rid", array(':uniacid' => $_W['uniacid'], ':bropenid' => $brrow['openid'], ':rid' => $rid));
		if (empty($isfans)) {
			//表中不存在入库
			$insert = array(
				'uniacid' => $_W['uniacid'],
				'rid' => $rid,
				'upopenid' => $openid,
				'bropenid' => $brrow['openid'],
				'nickname' => $brrow['nickname'],
				'headimgurl' => $brrow['headimgurl'],
				'follow' => '0',
				'createtime' => TIMESTAMP,
			);
			pdo_insert('n1ce_mission_fans' , $insert);
			header("location:" . $suburl);
		}else{
			message('亲，您已经是粉丝了，快去完成自己的任务吧', $suburl ,'error');
		}
	}
	public function doMobileSubcome(){
		global $_GPC, $_W;
		//获取扫描人的openID等信息
		$brrow = mc_oauth_userinfo();
		$rid = $_GPC['rid'];
		$suburl = $this->module['config']['suburl'];
		//扫描人的openID
		$openid = $_GPC['openid'];
		$reply = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_reply') . " WHERE rid = :rid AND uniacid = :uniacid ORDER BY `id` DESC", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		if($reply['sex'] == 2 && $brrow['sex'] == 2){//boy
			//return $this->respText("抱歉,您的微信号存在问题,暂不能参与本次活动！");
			message('抱歉,您的微信号存在问题,暂不能参与本次活动！',$suburl,'error');
		}
		if($reply['sex'] == 3 && $brrow['sex'] == 1){//girl
			message('抱歉,您的微信号存在问题,暂不能参与本次活动！',$suburl,'error');
		}
		$isfans = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_fans') . " WHERE uniacid = :uniacid and bropenid=:bropenid and rid = :rid", array(':uniacid' => $_W['uniacid'], ':bropenid' => $brrow['openid'], ':rid' => $rid));
		
		if(empty($isfans['from_user']) && $isfans['bropenid']){
			$datas = array(
				'from_user' => $openid,
				'follow' => '1',
				'createtime' => TIMESTAMP,
			);
			pdo_update('n1ce_mission_fans',$datas,array('rid' => $rid, 'uniacid' => $_W['uniacid'], 'bropenid' => $brrow['openid']));
			//找出上级
			$fans = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_fans') . " WHERE uniacid = :uniacid and from_user= :from_user and rid = :rid", array(':uniacid' => $_W['uniacid'], ':from_user' => $isfans['upopenid'], ':rid' => $rid));
			
			$prizes = pdo_fetchall("SELECT * FROM " . tablename('n1ce_mission_prize') . " WHERE uniacid = :uniacid and rid = :rid order by miss_num ASC", array(':uniacid' => $_W['uniacid'], ':rid' => $rid));
			foreach($prizes as $key => $vol){
				if ($vol['miss_num'] > 0 && $fans['miss_num'] < $vol['miss_num']) {
					//black name
					$info2 = str_replace('#昵称#', $brrow['nickname'], $reply['miss_back']);
					//updata zhuli
					$updata = array(
						'miss_num' => $fans['miss_num'] + 1 ,
					); 
					pdo_update('n1ce_mission_fans',$updata,array('uniacid' => $_W['uniacid'], 'from_user' => $fans['from_user'],'rid' => $rid));
					//achevie mission
					$jixu = $vol['miss_num'] - $updata['miss_num'];
					$costext = str_replace('#昵称#', $brrow['nickname'], $reply['miss_back']);
					$costext = str_replace('#人气值#', $updata['miss_num'], $costext);
					$costext = str_replace('#差值#', $jixu, $costext);
					$costext = str_replace('#奖品#', $vol['prize_name'], $costext);
					$costext = str_replace('#库存#', $vol['prizesum'], $costext);
					if($updata['miss_num'] == $vol['miss_num']){
						//give award
						$havetext = str_replace('#昵称#', $mc['nickname'], $reply['miss_finish']);
						$havetext = str_replace('#人气值#', $updata['miss_num'], $havetext);
						$havetext = str_replace('#奖品#', $vol['prize_name'], $havetext);
						$havetext = str_replace('#库存#', $vol['prizesum'], $havetext);
						if($vol['prizesum'] <= 0){
							$this->postText($fans['from_user'],"很抱歉,您完成当前奖励任务时间太久了,奖品被领完了！继续邀请好友加入即可继续达成下阶段奖励！");
							die();
						}
						
						$uprdata = array(
								'prizesum' => $vol['prizesum'] - 1 ,
							); 
						pdo_update('n1ce_mission_prize',$uprdata,array('uniacid' => $_W['uniacid'], 'rid' => $rid,'id' => $vol['id']));
						$infoinsert = array(
							'rid' => $rid,
							'uniacid' => $_W['uniacid'],
							'openid' => $fans['from_user'],
							'nickname' => $fans['nickname'],
							'miss_num' => $updata['miss_num'],
							'headimgurl' => $fans['headimgurl'],
							'time' => TIMESTAMP,
						);
						if($vol['type'] == '1'){
							$this->postText($fans['from_user'],$havetext);
							$money = rand($vol['min_money'], $vol['max_money']);
							$salt = md5($fans['from_user'].time());
							$redurl = $this->createMobileUrl('redurl' , array('salt'=>$salt,'rid'=>$rid));
							$infoinsert['salt'] = $salt;
							$infoinsert['type'] = "1";
							$infoinsert['money'] = $money;
							$infoinsert['status'] = "3";
							pdo_insert('n1ce_mission_user',$infoinsert);
							$redurl = $_W['siteroot'] . 'app' . str_replace('./', '/', $redurl);
							$redurl = htmlspecialchars_decode(str_replace('&quot;','&#039;',$redurl),ENT_QUOTES);
							$yuan = $money/100;
							$text = "<a href='" . $redurl . "'>点击这里领取您的红包</a>";
							$redtext = "恭喜你获得".$yuan."元红包\n\n".$text;
							$this->sendText($fans['from_user'],$redtext);
						}
						if($vol['type'] == '2'){
							$this->postText($fans['from_user'],$havetext);
							$res = $this->sendWxCard($fans['from_user'],$vol['cardid']);
							$infoinsert['type'] = "2";
							$infoinsert['status'] = "1";
							pdo_insert('n1ce_mission_user',$infoinsert);
						}
						if($vol['type'] == '3'){
							$appId = $this->module['config']['yzappId'];
							$appSecret = $this->module['config']['yzappSecret'];
							$res = he_youzan_addtags($appId,$appSecret,$fans['from_user'],$vol['lable']);
							if($res['response']){
								$url = $vol['url'];
								$msgshop = str_replace('#昵称#', $brrow['nickname'], $reply['miss_youzan']);
								$msgshop = str_replace('#人气值#', $updata['miss_num'], $msgshop);
								$msgshop = str_replace('#奖品#', $vol['prize_name'], $msgshop);
								$msgshop = str_replace('#库存#', $vol['prizesum'], $msgshop);
								$msgshop = str_replace('#有赞#', $url, $msgshop);
								$this->postText($fans['from_user'],$msgshop);
								$infoinsert['type'] = "3";
								$infoinsert['status'] = "1";
								pdo_insert('n1ce_mission_user',$infoinsert);
							}
						}
						if($vol['type'] == '4'){
							$this->postText($fans['from_user'],$havetext);
							load()->model('mc');
							$uid = mc_openid2uid($fans['from_user']);
							$res = mc_credit_update($uid, 'credit1', $vol['credit'], array(0, '系统积分'.$vol['credit'].'积分'));
							$infoinsert['type'] = "4";
							$infoinsert['status'] = "1";
							pdo_insert('n1ce_mission_user',$infoinsert);
							return $this->respText('');die();
						}
						if($vol['type'] == '5'){
							$url = $vol['url'];
							$msgshop = str_replace('#昵称#', $brrow['nickname'], $reply['miss_youzan']);
							$msgshop = str_replace('#人气值#', $updata['miss_num'], $msgshop);
							$msgshop = str_replace('#奖品#', $vol['prize_name'], $msgshop);
							$msgshop = str_replace('#库存#', $vol['prizesum'], $msgshop);
							$msgshop = str_replace('#有赞#', $url, $msgshop);
							$this->postText($fans['from_user'],$msgshop);
							$infoinsert['type'] = "5";
							$infoinsert['status'] = "1";
							pdo_insert('n1ce_mission_user',$infoinsert);
							return $this->respText('');die();
						}
					}else{
						$this->postText($fans['from_user'],$costext);
					}
					break;
				}
			}
			message('恭喜你,验证成功,阅读规则参与活动吧！',$suburl,'success');
		}else{
			header("location:" . $suburl);
		}
		
	}
	
	public function doMobileRedurl(){
		//借权获取openid并发红包
		global $_W, $_GPC;
		$brrow = mc_oauth_userinfo();
		$bropenid = $brrow['openid'];
		$salt = $_GPC['salt'];
		$rid = $_GPC['rid'];
		
		$res = pdo_fetch('select * from' . tablename('n1ce_mission_user') . ' where uniacid = :uniacid and salt = :salt and status = 3', array(':uniacid' => $_W['uniacid'], ':salt' => $salt));
		
		if(!$res){
			message('请通过正常途径获取红包！','','error');
		}
		include $this->template('sendred');
	}
	public function doMobileSaltcheck(){
		global $_GPC, $_W;
		$settings = $this->module['config'];
		$salt = $_GPC['salt'];
		$rid = $_GPC['rid'];
		$bropenid = $_GPC['openid'];
		$res = pdo_fetch('select * from' . tablename('n1ce_mission_user') . ' where uniacid = :uniacid and salt = :salt and status = 3', array(':uniacid' => $_W['uniacid'], ':salt' => $salt));
		if($res){
			$action = $this->sendRedPacket($bropenid, $res['money']);
			if($action === true){
				$data = "恭喜你获得红包！";
				$binsert = array(
					'bopenid' => $bropenid,
					'status' => '1',
				);
				pdo_update('n1ce_mission_user',$binsert, array('id'=>$res['id']));
				exit(json_encode(array('status' => 3, 'msg' => $data)));
			}else{
				$data = "红包正在排队发放中！！";
				$binsert = array(
					'bopenid' => $bropenid,
					'status' => '2',
				);
				pdo_update('n1ce_mission_user',$binsert, array('id'=>$res['id']));
				$actions = "亲爱的管理员，有粉丝红包领取失败！\n原因：".$action;
				$this->sendText($settings['mopenid'],$actions);
				exit(json_encode(array('status' => 3, 'msg' => $data)));
			}
		}else{
			$data = "您已领取过红包,请勿重复点击！";
			exit(json_encode(array('status' => 3, 'msg' => $data)));
		}
	}
	public function doWebManage() {
		//这个操作被定义用来呈现 管理中心导航菜单
		global $_GPC, $_W;
        load()->model('reply');
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $sql = "uniacid = :uniacid AND `module` = :module";
        $params = array();
        $params[':uniacid'] = $_W['uniacid'];
        $params[':module'] = 'n1ce_mission';

        if (isset($_GPC['keywords'])) {
            $sql .= ' AND `name` LIKE :keywords';
            $params[':keywords'] = "%{$_GPC['keywords']}%";
        }

        $list = reply_search($sql, $params, $pindex, $psize, $total);
        $pager = pagination($total, $pindex, $psize);

        if (!empty($list)) {
            foreach ($list as &$item) {
                $condition = "`rid`={$item['id']}";
                $item['keywords'] = reply_keywords_search($condition);
                $n1ce_mission = pdo_fetch("SELECT * FROM " . tablename($this->table_reply) . " WHERE rid = :rid ", array(':rid' => $item['id']));
                $item['viewnum'] = $item['viewnum`'];
                $item['starttime'] = date('Y-m-d H:i', $n1ce_mission['starttime']);
                $endtime = $n1ce_mission['endtime'];
                $item['endtime'] = date('Y-m-d H:i', $endtime);
                $nowtime = time();
                if ($n1ce_mission['starttime'] > $nowtime) {
                    $item['show'] = '<span class="label label-warning">未开始</span>';
                } elseif ($endtime < $nowtime) {
                    $item['show'] = '<span class="label label-default">已结束</span>';
                } else{
					$item['show'] = '<span class="label label-success">已开始</span>';
				}
                $item['uniacid'] = $n1ce_mission['uniacid'];
            }
        }
        include $this->template('manage');
	}
	public function doWebPrize(){
		global $_GPC, $_W;
		checklogin();
		$rid = intval($_GPC['rid']);
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if($operation=="delete"){
				$id = $_GPC['id'];
				$rid =$_GPC['rid'];
				if(!$id)message('参数错误！','', 'error');
				pdo_delete("n1ce_mission_prize",array("id"=>$id,"uniacid"=>$_W['uniacid'],"rid"=>$rid));
				message("删除成功",$this->createWebUrl("prize" , array('rid' => $rid)), 'success');
		}
		$pindex = max(1, intval($_GPC['page']));
			$psize = 20;
			$sql = 'select * from ' . tablename('n1ce_mission_prize') . 'where uniacid = :uniacid and rid = :rid LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
			$prarm = array(':uniacid' => $_W['uniacid'],':rid' => $rid);
			$list = pdo_fetchall($sql, $prarm);
			$count = pdo_fetchcolumn('select count(*) from ' . tablename('n1ce_mission_prize') . 'where uniacid = :uniacid', $prarm);
			$pager = pagination($count, $pindex, $psize);
		include $this->template('prize');
	}
	public function doWebdelete() {
        global $_GPC, $_W;
        $rid = intval($_GPC['rid']);
        $rule = pdo_fetch("SELECT id, module FROM " . tablename('rule') . " WHERE id = :id and uniacid=:uniacid", array(':id' => $rid, ':uniacid' => $_W['uniacid']));
        if (empty($rule)) {
            message('抱歉，要修改的规则不存在或是已经被删除！');
        }
        if (pdo_delete('rule', array('id' => $rid))) {
            pdo_delete('rule_keyword', array('rid' => $rid));
            //删除统计相关数据
            pdo_delete('stat_rule', array('rid' => $rid));
            pdo_delete('stat_keyword', array('rid' => $rid));
        }
        message('规则操作成功！', $this->createWebUrl('manage', array('op' => 'display')), 'success');
    }
	public function doWebPrizeadd(){
		global $_GPC, $_W;
		checklogin();
		$rid = $_GPC['rid'];
		if (checksubmit()){
			if($_GPC['type'] == '1'){
				$data = array(
				'uniacid' => $_W['uniacid'],
				'prizesum' => $_GPC['prize_sum'],
				'type' => $_GPC['type'],
				'min_money' => $_GPC['min_money'],
				'max_money' => $_GPC['max_money'],
				'rid' => $_GPC['rid'],
				'time' => time()
				);
			}
			if($_GPC['type'] == '2'){
				$data = array(
				'uniacid' => $_W['uniacid'],
				'prizesum' => $_GPC['cprize_sum'],
				'type' => $_GPC['type'],
				'cardid' => $_GPC['cardid'],
				'rid' => $_GPC['rid'],
				'time' => time()
				);
			}
			if($_GPC['type'] == '3'){
				$data = array(
				'uniacid' => $_W['uniacid'],
				'lable' => $_GPC['lable'],
				'prizesum' => $_GPC['uprize_sum'],
				'type' => $_GPC['type'],
				'url' => $_GPC['url'],
				'rid' => $_GPC['rid'],
				'time' => time()
				);
			}
			if($_GPC['type'] == '4'){
				$data = array(
				'uniacid' => $_W['uniacid'],
				'prizesum' => $_GPC['jprize_sum'],
				'type' => $_GPC['type'],
				'credit' => $_GPC['credit'],
				'rid' => $_GPC['rid'],
				'time' => time()
				);
			}
			if($_GPC['type'] == '5'){
				$data = array(
				'uniacid' => $_W['uniacid'],
				'prizesum' => $_GPC['myuprize_sum'],
				'type' => $_GPC['type'],
				'url' => $_GPC['myurl'],
				'rid' => $_GPC['rid'],
				'time' => time()
				);
			}
			$data['miss_num'] = $_GPC['miss_num'];
			$data['prize_name'] = $_GPC['prize_name'];
			//message(var_dump($data));
			pdo_insert('n1ce_mission_prize', $data );
			message('添加成功',$this->createWebUrl('prize',array('rid' => $rid)),'success');
		}
		include $this->template('prizeadd');
	}
	public function doWebPrizeedits(){
		global $_GPC, $_W;
		checklogin();
		$rid = $_GPC['rid'];
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if($operation=="edits"){
			$id = $_GPC['id'];
			$rid = $_GPC['rid'];
			$sql = 'select * from ' . tablename('n1ce_mission_prize') . 'where uniacid = :uniacid and rid = :rid and id = :id';
			$prarm = array(':uniacid' => $_W['uniacid'],':rid' => $rid,':id' => $id);
			$sum = pdo_fetch($sql, $prarm);
		}
		if (checksubmit()){
			pdo_update('n1ce_mission_prize', array('prizesum' => $_GPC['prize_sum']), array('rid' => $_GPC['rid'],'uniacid' => $_W['uniacid'],'id' => $_GPC['id']));
			message('更新奖品成功',$this->createWebUrl('prize',array('rid' => $rid)),'success');
		}
		include $this->template('prizeedits');
	}
	public function doWebUsershow(){
		global $_GPC, $_W;
		checklogin();
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$rid = $_GPC['rid'];
		if(empty($rid)){
			
			message('参数错误！','','error');
		}
		$sql = 'select * from ' . tablename('n1ce_mission_fans') . 'where uniacid = :uniacid and rid = :rid order by miss_num DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize ;
		$prarm = array(':uniacid' => $_W['uniacid'],':rid' => $rid);
		$list = pdo_fetchall($sql, $prarm);
		$count = pdo_fetchcolumn('select count(*) from ' . tablename('n1ce_mission_fans') . 'where uniacid = :uniacid and rid = :rid', $prarm);
		$pager = pagination($count, $pindex, $psize);
		
		load()->func('tpl');
		include $this->template('user');
	}
	public function doWebUserdetail(){
		global $_GPC, $_W;
		checklogin();
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$rid = $_GPC['rid'];
		$reply = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_reply') . " WHERE rid = :rid AND uniacid = :uniacid ORDER BY `id` DESC", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if(empty($rid)){
			
			message('参数错误！','','error');
		}
		if($operation=="finish"){
			$reply = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_reply') . " WHERE rid = :rid AND uniacid = :uniacid ORDER BY `id` DESC", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
			$sql = 'select * from ' . tablename('n1ce_mission_user') . 'where uniacid = :uniacid and rid = :rid order by miss_num DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize ;
			$prarm = array(':uniacid' => $_W['uniacid'],':rid' => $rid);
			$list = pdo_fetchall($sql, $prarm);
			$count = pdo_fetchcolumn('select count(*) from ' . tablename('n1ce_mission_user') . 'where uniacid = :uniacid and rid = :rid', $prarm);
			$pager = pagination($count, $pindex, $psize);
		}
		if($operation=="havetrue"){
			$sql = 'select * from ' . tablename('n1ce_mission_user') . 'where uniacid = :uniacid and rid = :rid AND status = 1 order by miss_num DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize ;
			$prarm = array(':uniacid' => $_W['uniacid'],':rid' => $rid);
			$list = pdo_fetchall($sql, $prarm);
			$count = pdo_fetchcolumn('select count(*) from ' . tablename('n1ce_mission_user') . 'where uniacid = :uniacid and rid = :rid and status = 1', $prarm);
			$pager = pagination($count, $pindex, $psize);
		}
		if($operation=="isfail"){
			$sql = 'select * from ' . tablename('n1ce_mission_user') . 'where uniacid = :uniacid and rid = :rid AND status = 2 order by miss_num DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize ;
			$prarm = array(':uniacid' => $_W['uniacid'],':rid' => $rid);
			$list = pdo_fetchall($sql, $prarm);
			$count = pdo_fetchcolumn('select count(*) from ' . tablename('n1ce_mission_user') . 'where uniacid = :uniacid and rid = :rid and status = 2', $prarm);
			$pager = pagination($count, $pindex, $psize);
		}
		load()->func('tpl');
		include $this->template('userdetail');
	}
	public function doWebSendred(){
		global $_W ,$_GPC;
		checklogin();
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
		if($operation=="send"){
			$id = $_GPC['id'];
			$rid = $_GPC['rid'];
			$money = $_GPC['money'];
			$openid = $_GPC['openid'];
			$res = $this->sendRedPacket($openid,$money);
			if($res === true){
				pdo_query('update ' . tablename('n1ce_mission_user') . ' set status = 1 where uniacid = :uniacid and id = :id', array(':uniacid' => $_W['uniacid'],':id' => $id));
				message('恭喜你，红包发送成功', $this->createWebUrl('userdetail',array('op'=>"finish",'rid' => $rid)), 'success');
			}else{
				message($res,'','error');
			}
			
		}	
	}
	private function sendRedPacket($openid,$money){
		global $_W,$_GPC;
		$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
		load()->func('communication');
		$pars = array();
		$cfg = $this->module['config'];
		$pars['nonce_str'] = random(32);
		$pars['mch_billno'] = $cfg['pay_mchid'] . date('YmdHis') . rand( 100, 999 );
		$pars['mch_id'] = $cfg['pay_mchid'];
		$pars['wxappid'] = $cfg['appid'];
		//$pars['nick_name'] = $cfg['nick_name'];
		$pars['send_name'] = $cfg['send_name'];
		$pars['re_openid'] = $openid;
		$pars['total_amount'] = $money;
		$pars['total_num'] = 1;
		$pars['wishing'] = $cfg['wishing'];
		$pars['client_ip'] = $_W['clientip'];
		$pars['act_name'] = $cfg['act_name'];
		$pars['remark'] = $cfg['remark'];
		ksort($pars, SORT_STRING);
		$string1 = '';
		foreach($pars as $k => $v) {
			$string1 .= "{$k}={$v}&";
		}
		$string1 .= "key={$cfg['pay_signkey']}";
		$pars['sign'] = strtoupper(md5($string1));
		$xml = array2xml($pars);
		$extras = array();
		$extras['CURLOPT_CAINFO'] = IA_ROOT .'/attachment/n1ce_mission/cert_2/' . $_W['uniacid'] . '/' . $cfg['rootca'];
		$extras['CURLOPT_SSLCERT'] = IA_ROOT .'/attachment/n1ce_mission/cert_2/' . $_W['uniacid'] . '/' . $cfg['apiclient_cert'];
		$extras['CURLOPT_SSLKEY'] = IA_ROOT .'/attachment/n1ce_mission/cert_2/' . $_W['uniacid'] . '/' . $cfg['apiclient_key'];
		$procResult = false;
		$resp = ihttp_request($url, $xml, $extras);
		if(is_error($resp)) {
			$setting = $this->module['config'];
			$setting['api']['error'] = $resp['message'];
			$this->saveSettings($setting);
			$procResult = $resp['message'];
		} else {
			$xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
			$dom = new DOMDocument();
			if($dom->loadXML($xml)) {
				$xpath = new DOMXPath($dom);
				$code = $xpath->evaluate('string(//xml/return_code)');
				$ret = $xpath->evaluate('string(//xml/result_code)');
				if(strtolower($code) == 'success' && strtolower($ret) == 'success') {
					$procResult = true;
					$setting = $this->module['config'];
					$setting['api']['error'] = '';
					$this->saveSettings($setting);
				} else {
					$error = $xpath->evaluate('string(//xml/err_code_des)');
					$setting = $this->module['config'];
					$setting['api']['error'] = $error;
					$this->saveSettings($setting);
					$procResult = $error;
				}
			} else {
				$procResult = 'error response';
			}
		}
		return $procResult;
	}
	private function api_notice_increment($url, $data) {
       $ch = curl_init();
        $header = "Accept-Charset: utf-8";
       
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        if (curl_errno($ch)) {
            return false;
        } else {
		
            return $tmpInfo;
        }
    }
	private function sendText($openid,$txt){
		global $_W;
		$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
		$acc = WeAccount::create($acid);
		$data = $acc->sendCustomNotice(array('touser'=>$openid,'msgtype'=>'text','text'=>array('content'=>urlencode($txt))));
		return $data;
	}
	public function sendImage($openid, $media_id)
	{
		$data = array("touser" => $openid, "msgtype" => "image", "image" => array("media_id" => $media_id));
		$ret = $this->postRes($this->getAccessToken(), json_encode($data));
		return $ret;
	}
	private function uploadImage($img)
	{
		$url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=" . $this->getAccessToken() . "&type=image";
		$post = array('media' => '@' . $img);
		load()->func('communication');
		$ret = ihttp_request($url, $post);
		$content = @json_decode($ret['content'], true);
		return $content['media_id'];
	}
	private $sceneid = 0;
	private $Qrcode = "/addons/n1ce_mission/qrcode/mposter#sid#.jpg";
	private function createPoster($mc, $reply , $openid)
	{
		global $_W;
		$bg = $reply['bg'];
		$rid = $reply['rid'];
		$share = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_fans') . " WHERE uniacid = :uniacid and from_user= :from_user and rid = :rid", array(':uniacid' => $_W['uniacid'], ':from_user' => $openid, ':rid' => $rid));
		if (empty($share)) {
			$inserts = array(
						'uniacid' => $_W['uniacid'],
						'rid' => $reply['rid'],
						'from_user' => $openid,
						'nickname' => $mc['nickname'],
						'headimgurl' => $mc['avatar'],
						'follow' => '1',
						'createtime' => TIMESTAMP,
					);
			pdo_insert('n1ce_mission_fans' , $inserts);
			$share['id'] = pdo_insertid();
			$share = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_fans') . " WHERE id = :id", array(':id' => $share['id']));
		} else {
			pdo_update('n1ce_mission_fans', array('updatetime' => time()), array('id' => $share['id']));
		}
		$qrcode = str_replace('#sid#', $share['id'], IA_ROOT . $this->Qrcode);
		$data = json_decode(str_replace('&quot;', "'", $reply['data']), true);
		set_time_limit(0);
		@ini_set('memory_limit', '256M');
		$size = getimagesize(tomedia($bg));
		$target = imagecreatetruecolor($size[0], $size[1]);
		
		$bg = imagecreates(tomedia($bg));
		imagecopy($target, $bg, 0, 0, 0, 0, $size[0], $size[1]);
		imagedestroy($bg);
		
		foreach ($data as $value) {
			$value = trimPx($value);
			
			if ($value['type'] == 'qr') {
				if($reply['posttype'] == 2){
					$url = $_W['siteroot'] . str_replace('./', 'app/', $this->createMobileurl('subpost', array('openid' => $openid, 'rid' => $rid)));
				}else{
					$url = $this->getQR($mc, $reply, $share['id']);
				}
				if (!empty($url)) {
					$img = IA_ROOT . "/addons/n1ce_mission/temp_qrcode.png";
					include "phpqrcode.php";
					$errorCorrectionLevel = "L";
					$matrixPointSize = "4";
					QRcode::png($url, $img, $errorCorrectionLevel, $matrixPointSize, 2);
					mergeImage($target, $img, array('left' => $value['left'], 'top' => $value['top'], 'width' => $value['width'], 'height' => $value['height']));
					@unlink($img);
				}
			} elseif ($value['type'] == 'img') {
				$img = saveImage($mc['avatar']);
				mergeImage($target, $img, array('left' => $value['left'], 'top' => $value['top'], 'width' => $value['width'], 'height' => $value['height']));
				@unlink($img);
			} elseif ($value['type'] == 'name') {
				mergeText($this->modulename, $target, $mc['nickname'], array('size' => $value['size'], 'color' => $value['color'], 'left' => $value['left'], 'top' => $value['top']), $reply);
			}
		}
		
		imagejpeg($target, $qrcode);
		imagedestroy($target);
		return $qrcode;
	}
	private function getQR($mc, $reply, $sid)
	{
		global $_W;
		$rid = $reply['rid'];
		if (empty($this->sceneid)) {
			$share = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_fans') . " WHERE id = :id", array(':id' => $sid));
			if (!empty($share['url'])) {
				$out = false;
				$qrcode = pdo_fetch('select * from ' . tablename('qrcode') . " where uniacid='{$_W['uniacid']}' and qrcid='{$share['sceneid']}' " . " and name='{$reply['title']}' and ticket='{$share['ticketid']}' and url='{$share['url']}'");
				if ($qrcode['createtime'] + $qrcode['expire'] < time()) {
						pdo_delete('qrcode', array('id' => $qrcode['id']));
						$out = true;
				}
				if (!$out) {
					$this->sceneid = $share['sceneid'];
					return $share['url'];
				}
			}
			$this->sceneid = pdo_fetchcolumn('select sceneid from ' . tablename('n1ce_mission_fans') . " where uniacid='{$_W['uniacid']}' order by sceneid desc limit 1");
			if (empty($this->sceneid)) {
				$this->sceneid = 5000001;
			} else {
				$this->sceneid++;
			}
			$barcode['action_info']['scene']['scene_id'] = $this->sceneid;
			load()->model('account');
			$acid = pdo_fetchcolumn('select acid from ' . tablename('account') . " where uniacid={$_W['uniacid']}");
			$uniacccount = WeAccount::create($acid);
			$time = 0;
			$barcode['action_name'] = 'QR_SCENE';
			$barcode['expire_seconds'] = 30 * 24 * 3600;
			$res = $uniacccount->barCodeCreateDisposable($barcode);
			$time = $barcode['expire_seconds'];
			$sql = "SELECT * FROM " . tablename('rule_keyword') . " WHERE `rid`=:rid LIMIT 1";
			$row = pdo_fetch($sql, array(':rid' => $rid));
			pdo_insert('qrcode', array('uniacid' => $_W['uniacid'], 'acid' => $acid, 'qrcid' => $this->sceneid, 'name' => $reply['title'], 'keyword' => $row['content'], 'model' => 1, 'ticket' => $res['ticket'], 'expire' => $time, 'createtime' => time(), 'status' => 1, 'url' => $res['url']));
			pdo_update('n1ce_mission_fans', array('sceneid' => $this->sceneid, 'ticketid' => $res['ticket'], 'url' => $res['url'], 'nickname' => $mc['nickname'], 'headimgurl' => $mc['avatar']), array('id' => $sid));
			return $res['url'];
		}
	}
	private function postRes($access_token, $data)
	{
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";
		load()->func('communication');
		$ret = ihttp_request($url, $data);
		$content = @json_decode($ret['content'], true);
		return $content['errcode'];
	}
	private function getAccessToken()
	{
		global $_W;
		load()->model('account');
		$acid = $_W['acid'];
		if (empty($acid)) {
			$acid = $_W['uniacid'];
		}
		$account = WeAccount::create($acid);
		$token = $account->getAccessToken();
		return $token;
	}
	public function postText($openid, $text)
	{
		$post = '{"touser":"' . $openid . '","msgtype":"text","text":{"content":"' . $text . '"}}';
		$ret = $this->postRes($this->getAccessToken(), $post);
		return $ret;
	}
	private function sendWxCard($from_user, $cardid,$code = '') {
		load()->classs('weixin.account');
		load()->func('communication');
		$access_token = WeAccount::token();
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";
	
		$now = time();
		$nonce_str = $this->createNonceStr(8);
		$data = array(
				'api_ticket'=>$this->getApiTicket($access_token),
				'nonce_str'=>$nonce_str,
				'timestamp'=>$now,
				'code'=>$code,
				'card_id'=>$cardid,
				'openid'=>$from_user,
		);
		ksort($data);
		$buff = "";
		foreach ($data as $v) {
			$buff .= $v;
		}
		$sign = sha1($buff);
		$card_ext = array('code'=>$code,'openid'=>$from_user,'signature'=>$sign);
		$post = '{"touser":"' . $from_user . '","msgtype":"wxcard","wxcard":{"card_id":"' . $cardid . '","card_ext":"'.json_encode($card_ext).'"}}';
		load()->func('communication');
		$res = ihttp_post($url, $post);
		$res = json_decode($res['content'],true);
		if ($res['errcode'] == 0) return true;
		return $res['errmsg'];
	}
	private function createNonceStr($length = 16) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str.= substr($chars, mt_rand(0, strlen($chars) - 1) , 1);
		}
		return $str;
	}
	private function getApiTicket($access_token){
		global $_W, $_GPC;
		$w = $_W['uniacid'];
		$cookiename = "wx{$w}a{$w}pi{$w}ti{$w}ck{$w}et";
		$apiticket = $_COOKIE[$cookiename];
		if (empty($apiticket)){
			$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$access_token}&type=wx_card";
			load()->func('communication');
			$res = ihttp_get($url);
			$res = json_decode($res['content'],true);
			if (!empty($res['ticket'])){
				setcookie($cookiename,$res['ticket'],time()+$res['expires_in']);
				$apiticket = $res['ticket'];
			}else{
				message('获取api_ticket失败：'.$res['errmsg']);
			}
		}
		return $apiticket;
	}
	/*public function getMenus() {
        $menus = array(
            array(
                'title' => '活动管理',
                'url'   => $this->createWebUrl('manage'),
				'state' => '',
                'icon'  => 'fa fa-home',
            ),
        );
        return $menus;
    }*/
}