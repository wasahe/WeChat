<?php
/**
 * 新田源码 bbs.xtec.cc模块微站定义
 *
 *//
defined('IN_IA') or exit('Access Denied');
include 'huanghe_function.php';
class N1ce_missionModuleProcessor extends WeModuleProcessor {
	public function respond() {
		global $_W;
		load()->model('mc');
		$rid = $this->rule;
		$openid = $this->message['from'];
		$reply = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_reply') . " WHERE rid = :rid AND uniacid = :uniacid ORDER BY `id` DESC", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//获取昵称，坑爹的mc_fansinfo，用mc_fetch !不能实时获取到新关注的粉丝昵称
		$mc = mc_fetch($openid);
		//return $this->respText($openid);
		if(empty($mc['nickname']) || empty($mc['avatar']) || empty($mc['resideprovince']) || empty($mc['residecity']) || empty($mc['gender'])){
			load()->classs( 'account' );
			load()->func( 'communication' );
			$accToken = WeAccount::token();
			$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$accToken}&openid={$openid}&lang=zh_CN";
			$json = ihttp_get($url);
			$userinfo = @json_decode($json['content'],true);
			if($userinfo['nickname']) $mc['nickname'] = $userinfo['nickname'];
			if($userinfo['headimgurl']) $mc['avatar'] = $userinfo['headimgurl'];
			if($userinfo['resideprovince']) $mc['resideprovince'] = $userinfo['resideprovince'];
			if($userinfo['residecity']) $mc['residecity'] = $userinfo['residecity'];
			if($userinfo['sex']) $mc['gender'] = $userinfo['sex'];
			mc_update($openid,array('nickname' => $mc['nickname'] , 'avatar' => $mc['avatar'] , 'resideprovince' => $mc['resideprovince'], 'residecity' => $mc['residecity'], 'gender' => $mc['gender']));
		}
		
		if (!empty($reply)) {
			if ($reply['starttime'] > time()) {
				return $this->postText($openid, $reply['miss_start']);
			} elseif ($reply['endtime'] + 68399 < time()) {
				return $this->postText($openid, $reply['miss_end']);
			}
		}
		//判断性别
		if($reply['sex'] == 2 && $mc['gender'] == 2){//boy
			return $this->respText("抱歉,您的微信号存在问题,暂不能参与本次活动！");
		}
		if($reply['sex'] == 3 && $mc['gender'] == 1){//girl
			return $this->respText("抱歉,您的微信号存在问题,暂不能参与本次活动！");
		}
		//扫描参数二维码
		if ($this->message['msgtype'] == 'event') {
			
				$scene_id = str_replace('qrscene_', '', $this->message['eventkey']);
				if ($this->message['event'] == 'subscribe') {
					if($reply['posttype'] == 2){
						if(!empty($reply['area'])){
							$url = $this->createMobileUrl('subcome' , array('openid' => $openid,'rid' => $rid));
							$cheakurl = "<a href='" . $_W['siteroot'] . str_replace('./', 'app/', $url) . "'>点击这里</a>";
							$checkmsg = "本次活动只针对【" . $reply['area'] . "】微信用户开放\n\n如果你是该地区的用户，" . $cheakurl . "验证\n\n如果不处于此地区，暂时不能参与活动，感谢您的支持！";
							$this->postText($openid, $checkmsg);
							die;
						}else{
							$url = $this->createMobileUrl('subcome' , array('openid' => $openid,'rid' => $rid));
							$cheakurl = "<a href='" . $_W['siteroot'] . str_replace('./', 'app/', $url) . "'>点击这里</a>";
							$checkmsg = "此活动需要验证粉丝身份\n\n如果你是扫码参与活动的用户，" . $cheakurl . "验证\n\n如果不是，可以跳过验证，点击菜单参与活动！";
							$this->postText($openid, $checkmsg);
							die;
						}
						
					}
					
					//找出上级openid
					$fans = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_fans') . " WHERE uniacid = :uniacid and sceneid= :sceneid and rid = :rid", array(':uniacid' => $_W['uniacid'], ':sceneid' => $scene_id, ':rid' => $rid));
					//是否取消关注扫码
					$isfans = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_fans') . " WHERE uniacid = :uniacid and from_user=:from_user and rid = :rid", array(':uniacid' => $_W['uniacid'], ':from_user' => $openid, ':rid' => $rid));
					if (empty($isfans)) {
						if($reply['fans_limit'] == 1){
							$url = $this->createMobileUrl('fanslimit' , array('openid' => $openid,'rid' => $rid, 'sceneid' => $scene_id));
							$limiturl = $_W['siteroot'] . 'app' . str_replace('./', '/', $url);
							$limiturl = htmlspecialchars_decode(str_replace('&quot;','&#039;',$limiturl),ENT_QUOTES);
							$text = "<a href='" . $limiturl . "'>点击此处为好友增加人气</a>";
							$checkmsg = "本次活动只针对【" . $reply['area'] . "】微信用户开放\n\n如果你是该地区的用户，" . $text . "\n\n如果不处于此地区，暂时不能参与活动，感谢您的支持！";
							$this->postText($openid, $checkmsg);
							die;
						}
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
						$this->postText($this->message['from'], $miss_sub);
						//任务处理多任务处理
						$prizes = pdo_fetchall("SELECT * FROM " . tablename('n1ce_mission_prize') . " WHERE uniacid = :uniacid and rid = :rid order by miss_num ASC", array(':uniacid' => $_W['uniacid'], ':rid' => $rid));
						foreach($prizes as $key => $vol){
							if ($vol['miss_num'] > 0 && $fans['miss_num'] < $vol['miss_num']) {
								//black name
								//$info2 = str_replace('#昵称#', $mc['nickname'], $reply['miss_back']);
								//updata zhuli
								$updata = array(
									'miss_num' => $fans['miss_num'] + 1 ,
								); 
								pdo_update('n1ce_mission_fans',$updata,array('uniacid' => $_W['uniacid'], 'from_user' => $fans['from_user'],'rid' => $rid,'sceneid' => $scene_id));
								$jixu = $vol['miss_num'] - $updata['miss_num'];
								//替换标签
								$costext = str_replace('#昵称#', $mc['nickname'], $reply['miss_back']);
								$costext = str_replace('#人气值#', $updata['miss_num'], $costext);
								$costext = str_replace('#差值#', $jixu, $costext);
								$costext = str_replace('#奖品#', $vol['prize_name'], $costext);
								$costext = str_replace('#库存#', $vol['prizesum'], $costext);
								//achevie mission
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
						return $this->PostNews($reply, $mc['nickname']);
					}
					return $this->PostNews($reply, $mc['nickname']);
				}
				if ($this->message['event'] == 'SCAN') {
					$miss_resub = str_replace('#昵称#', $mc['nickname'], $reply['miss_resub']);
					$this->postText($openid, $miss_resub);
					return $this->PostNews($reply, $mc['nickname']);
				}
			
		}
		if ($this->message['msgtype'] == 'text' || $this->message['event'] == 'CLICK') {
			
			//create
			$limittime = $this->module['config']['limittime'];
			if (!empty($limittime)) {
				$fans = pdo_fetch("SELECT * FROM " . tablename('n1ce_mission_fans') . " WHERE uniacid = :uniacid and from_user= :from_user and rid = :rid", array(':uniacid' => $_W['uniacid'], ':from_user' => $openid, ':rid' => $rid));
				if ($fans['updatetime'] > 0 && time() - $fans['updatetime'] < $limittime) {
					$this->postText($this->message['from'], "亲,请勿频繁生成海报,请稍等".$limittime."秒后点击生成！");
					return '';
					die;
				}
			}
			//地区限制
			if(!empty($reply['area'])){
				$redurl = $this->createMobileUrl('iplimit' , array('openid' => base64_encode($openid),'rid' => $rid));
				$cheakurl = "<a href='" . $_W['siteroot'] . str_replace('./', 'app/', $redurl) . "'>点击这里</a>";
				$checkmsg = "次活动只针对【" . $reply['area'] . "】微信用户开放\n\n如果你是该地区的用户，" . $cheakurl . "验证\n\n如果不处于此地区，暂时不能参与活动，感谢您的支持！";
				$this->postText($openid, $checkmsg);
				die;
			}
			$img = $this->createPoster($mc, $reply , $openid);
			//return $this->respText($openid);
			$media_id = $this->uploadImage($img);
			if ($reply['first_info']) {
				$info = str_replace('#时间#', date('Y-m-d H:i', time() + 30 * 24 * 3600), $reply['first_info']);
				$info = str_replace('#昵称#', $mc['nickname'], $info);
				$this->postText($openid, $info);
				
			}
			if ($reply['miss_wait']) {
				sleep(1);
				$miss_wait = str_replace('#昵称#', $mc['nickname'], $reply['miss_wait']);
				$this->postText($openid, $miss_wait);
			}
			$this->sendImage($openid, $media_id);
			die;
		}
	}
	public function sendImage($openid, $media_id)
	{
		$data = array("touser" => $openid, "msgtype" => "image", "image" => array("media_id" => $media_id));
		$ret = $this->postRes($this->getAccessToken(), json_encode($data));
		return $ret;
	}
	function GetIpLookup($ip = '')
	{
		if (empty($ip)) {
			$ip = GetIp();
		}
		$res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
		if (empty($res)) {
			return false;
		}
		$jsonMatches = array();
		preg_match('#\{.+?\}#', $res, $jsonMatches);
		if (!isset($jsonMatches[0])) {
			return false;
		}
		$json = json_decode($jsonMatches[0], true);
		if (isset($json['ret']) && $json['ret'] == 1) {
			$json['ip'] = $ip;
			unset($json['ret']);
		} else {
			return false;
		}
		return $json;
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
	public function postText($openid, $text)
	{
		$post = '{"touser":"' . $openid . '","msgtype":"text","text":{"content":"' . $text . '"}}';
		$ret = $this->postRes($this->getAccessToken(), $post);
		return $ret;
	}
	private function postRes($access_token, $data)
	{
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";
		load()->func('communication');
		$ret = ihttp_request($url, $data);
		$content = @json_decode($ret['content'], true);
		return $content['errcode'];
	}
	private function PostNews($poster, $name)
	{
		$stitle = unserialize($poster['stitle']);
		if (!empty($stitle)) {
			$thumbs = unserialize($poster['sthumb']);
			$sdesc = unserialize($poster['sdesc']);
			$surl = unserialize($poster['surl']);
			foreach ($stitle as $key => $value) {
				if (empty($value)) {
					continue;
				}
				$response[] = array('title' => str_replace('#昵称#', $name, $value), 'description' => $sdesc[$key], 'picurl' => tomedia($thumbs[$key]), 'url' => $this->buildSiteUrl($surl[$key]));
			}
			if ($response) {
				return $this->respNews($response);
			}
		}
		return '';
	}
	//模板消息提醒
	public function sendtpl($openid, $url, $template_id, $content) {

		global $_GPC, $_W;
		load() -> classs('weixin.account');
		load() -> func('communication');
		$obj = new WeiXinAccount();
		$access_token = $obj -> fetch_available_token();
		$data = array('touser' => $openid, 'template_id' => $template_id, 'url' => $url, 'topcolor' => "#FF0000", 'data' => $content, );
		$json = json_encode($data);
		$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $access_token;
		$ret = ihttp_post($url, $json);
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
	private function sendText($openid,$txt){
		global $_W;
		$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
		$acc = WeAccount::create($acid);
		$data = $acc->sendCustomNotice(array('touser'=>$openid,'msgtype'=>'text','text'=>array('content'=>urlencode($txt))));
		return $data;
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
}