<?php
defined('IN_IA') or exit('Access Denied');
require_once '../framework/library/qrcode/phpqrcode.php';
define('ROOT_PATH', str_replace('site.php', '', str_replace('\\', '/', __FILE__)));
require_once ROOT_PATH."getip/IP.class.php";

require_once "jssdk.php";
class haoman_xxxModuleSite extends WeModuleSite {



	public function getip($a,$i,$rid){
		global $_GPC, $_W;

		$fansip = $_W['clientip'];

		$allowip = explode(",",$a);

		$isallowip = $i;

		$fansip = IP::find($fansip);

		switch($isallowip){

			case 1:
				if(!in_array($fansip[2],$allowip)){

					header("HTTP/1.1 301 Moved Permanently");
					header("Location: {$this->createMobileUrl('other',array('id'=>$rid,'type'=>2))}");
					exit();
				}
				break;

			case 2:

				if(in_array($fansip[2],$allowip)){

					header("HTTP/1.1 301 Moved Permanently");
					header("Location: {$this->createMobileUrl('other',array('id'=>$rid,'type'=>2))}");
					exit();
				}
				break;

			default:
		}
	}

	//非微信打开和限制IP地打开
	public function doMobileother(){
		global $_W,$_GPC;
		$rid = intval($_GPC['id']);
		$type = $_GPC['type'];
		$uniacid = $_W['uniacid'];

		if (empty($rid)) {
			message('抱歉，参数错误！!', '', 'error');//调试代码
		}

		if (empty($from_user)) {
			//	$this->message(array("status" => 2, "msg" => '获取不到您的OpenID,请从新进入活动页面'), "");
		}

		$reply = pdo_fetch("select * from " . tablename('haoman_xxx_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));

		$rule_keyword = pdo_fetch("select * from " . tablename('rule_keyword') . " where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
        $key_word = $rule_keyword['content'];
		$send_name = $this->substr_cut($_W['account']['name'],30);
		include $this->template('other');
	}

	public function doMobileappkey(){

		global $_GPC, $_W;


		$rid = intval($_GPC['id']);
		$latitude = $_GPC['lat'];
		$longitude = $_GPC['lon'];
		$appkey = $_GPC['appkey'];

		$reply = pdo_fetch("select * from " . tablename('haoman_xxx_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));

		// $this->message(array("success" => 1, "msg" => "432434234"), "");

		if (empty($latitude) || empty($longitude)) {
			$data = array(
				'success' => 100,
				'msg' => "获取位置失败",
			);

			//$this->message('位置获取失败');
		}

		$url = "http://api.map.baidu.com/geocoder/v2/?ak=" . $reply['bd_key'] . "&location=" . $latitude . "," . $longitude . "&output=json&pois=0";
		load()->func('communication');
		$response = ihttp_get($url);
		if (!is_error($response)) {
			$data = @json_decode($response['content'], true);
			if (empty($data) || $data['status'] != 0) {
//                    $this->message('位置获取失败：' . $data['message'] . '(' . $data['status'] . ')');
				$data = array(
					'success' => 100,
					'msg' => "获取位置失败",
				);
			} else {
				$data = $data['result'];
				$address = '';
				if (!empty($data['addressComponent'])) {
					$address = $data['addressComponent'];
				}
				if (empty($address['city'])) {
					$data = array(
						'success' => 100,
						'msg' => "获取位置失败",
					);
				} else {
					foreach ($address as $key => $value) {
						if ($key == 'province') {
							$province = $value;
						}
						if ($key == 'city') {
							$city = $value;
							//   $city = str_replace("市", "", $city);
						}
						if ($key == 'district') {
							$district = $value;
						}
					}
				}
				$address = $province . $city . $district;

				$add_sf = explode(',',$reply['address_sf']);
				$add_sq = explode(',',$reply['address_sq']);
				$add_qx = explode(',',$reply['address_qx']);

				$result = in_array($province, $add_sf);
				$result1 = in_array($city, $add_sq);
				$result2 = in_array($district, $add_qx);
				if($result){
					$data = array(
						'success' => 1,
						'msg' => '可参加活动',
					);
				}
				elseif($result1){
					$data = array(
						'success' => 1,
						'msg' => '可参加活动',
					);
				}
				elseif($result2){
					$data = array(
						'success' => 1,
						'msg' => '可参加活动',
					);
				}
				else{
					$data = array(
						'success' => 100,
						'msg' => '您不在允许参加的活动范围内！',
					);
				}
				//$this->returnSuccess('城市定位成功', $address);
			}
		} else {
			$data = array(
				'success' => 100,
				'msg' => '位置获取失败，请重试',
			);
//                $this->returnError('位置获取失败，请重试');
		}
		echo json_encode($data);



	}


	public function doMobilegetlbs(){

		global $_GPC, $_W;
		//$id = intval($_GPC['id']);
		$lat1 = $_GPC['lat'];
		$lon1 = $_GPC['lon'];
		$allowlbsip = explode("|",$_GPC['lbsip']);
		$lat2 = $allowlbsip[0];
		$lon2 = $allowlbsip[1];
		$dis = intval($allowlbsip[3]);



		$res = intval($this->getDistance($lat1,$lon1,$lat2,$lon2));




		if ($res <= $dis) {



			$data = array(
				'success' => 1,
				'msg' => '您可以正常参加活动！',
			);


		} else {

			$data = array(
				'success' => 100,
				'msg' => '您不在允许参加的活动范围内！',
			);
		}


		echo json_encode($data);

	}


	//根据经纬度计算距离 其中A($lat1,$lng1)、B($lat2,$lng2)
	public function getDistance($lat1,$lng1,$lat2,$lng2) {
		//地球半径
		$R = 6378137;
		//将角度转为狐度
		$radLat1 = deg2rad($lat1);
		$radLat2 = deg2rad($lat2);
		$radLng1 = deg2rad($lng1);
		$radLng2 = deg2rad($lng2);
		//结果
		$s = acos(cos($radLat1)*cos($radLat2)*cos($radLng1-$radLng2)+sin($radLat1)*sin($radLat2))*$R;
		// $s = 2*asin(sqrt(pow(sin(($radLat1-$radLat2)/2),2)+cos($radLat1)*cos($radLat2)*pow(sin(($radLng1-$radLng2)/2),2)))*$R;
		//精度
		$s = round($s* 10000)/10000;
		return  round($s);
	}


	public function doMobileShare() {
		global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$uniacid = $_W['uniacid'];
		$fromuser = authcode(base64_decode($_GPC['from_user']), 'DECODE');

		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') === false) {
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: {$this->createMobileUrl('other',array('type'=>1,'id'=>$rid))}");
			exit();
//			message('本页面仅支持微信访问!非微信浏览器禁止浏览!', '', 'error');
		}

		//网页授权借用开始

		load()->model('account');
		$_W['account'] = account_fetch($_W['acid']);
		$cookieid = '__cookie_haoman_xxx_201606186_' . $rid;
		$cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
		if ($_W['account']['level'] != 4) { //如果是借用的，那么$from_user、$avatar、$nickname不能使用全局的信息，只能使用Cookie的信息，这样才不会出现没有一开始没有关系，后面又关注的人，他之前的数据都没有的情况
			$from_user = $cookie['openid'];
			$avatar = $cookie['avatar'];
			$nickname = $cookie['nickname'];
		}else{
			$from_user = $_W['fans']['from_user'];
			$avatar = $_W['fans']['tag']['avatar'];
			$nickname = $_W['fans']['nickname'];
		}

		$code = $_GPC['code'];
		$urltype = $_GPC['from_user'];
		if (empty($from_user) || empty($avatar)) {
			if (!is_array($cookie) || !isset($cookie['avatar']) || !isset($cookie['openid'])) {
				$userinfo = $this->get_UserInfo($rid, $code, $urltype); //如果$from_user或是$avatar其中一个为空，并且cookie里面也没有信息，那么就调用高级权限去获取，这个如果本身是认证服务号的话，不会弹出授权界面，借用的会弹出授权界面
				$nickname = $userinfo['nickname'];
				$avatar = $userinfo['headimgurl'];
				$from_user = $userinfo['openid'];
			} else {
				$avatar = $cookie['avatar'];
				$nickname = $cookie['nickname'];
				$from_user = $cookie['openid'];
			}
		}

		//网页授权借用结束

		$reply = pdo_fetch("select sharenumtop,sharenum from " . tablename('haoman_xxx_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));


		load()->model('mc');

		if(empty($from_user)){
			$from_user=$this->get_openid($rid,$_GPC['from_user']);
		}

		if ($from_user != $fromuser) {
			//  message($from_user, '', 'error');//调试代码

			$sharedata = pdo_fetch("select id from " . tablename('haoman_xxx_data') . " where rid = '" . $rid . "' and from_user = '" . $from_user . "' and fromuser = '" . $fromuser . "' limit 1");
			//记录分享
			$insert = array(
				'rid' => $rid,
				'uniacid' => $_W['uniacid'],
				'from_user' => $from_user,
				'fromuser' => $fromuser,
				'visitorsip' => CLIENT_IP,
				'visitorstime' => TIMESTAMP,
				'viewnum' => 1

			);

			$fans = pdo_fetch("SELECT sharenum,last_time FROM " . tablename('haoman_xxx_fans') . " WHERE rid = " . $rid . " and from_user='" . $fromuser . "'");

			if (empty($sharedata) && ($reply['sharenumtop'] > $fans['sharenum'])){

				//更新当日次数
				$nowtime = mktime(0, 0, 0);

				$share_num = $reply['sharenum'];

				pdo_insert('haoman_xxx_data', $insert);


				if ($fans['last_time'] < $nowtime) {
					//   message($fans['sharenum'], '', 'error');//调试代码
					$fans['sharenum'] = 0;
					pdo_update('haoman_xxx_fans', array('sharenum' => $fans['sharenum'] + $share_num, 'last_time' => $nowtime), array('from_user' => $fromuser,'rid'=>$rid));
				}else{

					pdo_update('haoman_xxx_fans', array('sharenum' => $fans['sharenum'] + $share_num), array('from_user' => $fromuser,'rid'=>$rid));
				}


			}
			//记录分享
		}
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: " . $this->createMobileUrl('index', array('id' => $rid)) . "");
		exit();
	}


	// public function doMobileget_Share()
	// {
	// 	global $_GPC, $_W;
	// 	$rid = intval($_GPC['rid']);
	// 	//    $uniacid = $_W['uniacid'];
	// 	$from_user = $_GPC['from_user'];
	// 	$fromuser = authcode(base64_decode($_GPC['from_user']), 'DECODE');




	// 	$fans = pdo_fetch("SELECT * FROM " . tablename('haoman_xxx_fans') . " WHERE rid = " . $rid . " and from_user='" . $fromuser . "'");
	// 	if($fans['todaynum']==0){
	// 		pdo_update('haoman_xxx_fans', array('todaynum' =>$fans['todaynum'] + 1), array('from_user' => $fromuser, 'rid' => $rid));

	// 	}
	// 	$this->message(array("success" => 456, "msg" => '分享成功,可以领券了'), "");
	// }

//	分享设置
// 	public function doMobilesetshare() {
// 		global $_GPC, $_W;
// 		$rid = intval($_GPC['rid']);


// 		//网页授权借用开始（特殊代码）

// 		load()->model('account');
// 		$_W['account'] = account_fetch($_W['acid']);

// 		if ($_W['account']['level'] != 4) {
// 			$cookieid = '__cookie_haoman_xxx_201606186_' . $rid;
// 			$cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
// 			$from_user = $cookie['openid'];
// 			$avatar = $cookie['avatar'];
// 			$nickname = $cookie['nickname'];

// 		}else{

// 			$from_user = $_W['fans']['from_user'];
// 			$avatar = $_W['fans']['tag']['avatar'];
// 			$nickname = $_W['fans']['nickname'];
// 		}

// 		//网页授权借用结束（特殊代码）

// 		if (empty($from_user)) {
// 			$this->message(array("success" => 2, "msg" => '获取不到您的OpenID,请从新进入活动页面'), "");
// 		}
// 		$reply = pdo_fetch("select * from " . tablename('haoman_xxx_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));

// //		if($reply['match']==6){
// //			$cardArry = $this->getCardTicket($rid,$from_user);
// //			$cardArry['cardId']=$reply['couponid'];
// //		}




// 		$fans = pdo_fetch("select id from " . tablename('haoman_xxx_fans') . " where rid = " . $rid . " and from_user='" . $from_user . "'");
// 		if ($fans == false) {
// 			$data = array(
// 				'success' => 0,
// 				'msg' => '保存数据错误！',

// 			);
// 		} else {
// 			//查询规则保存哪些数据
// 			$updata = array();

// 			$updata['isshare'] = intval($_GPC['isshare']);

// 			$temp = pdo_update('haoman_xxx_fans', $updata, array('rid' => $rid, 'id' => $fans['id']));

// 			if ($temp === false) {
// 				$data = array(
// 					'success' => 0,
// 					'msg' => '保存数据错误！',
// 				);
// 			} else {

// 				$data = array(
// 					'success' => 1,
// 					'msg' => '成功提交数据',
// 					'cardArry' => $cardArry,
// 				);
// 			}
// 		}
// 		echo json_encode($data);
// 	}


	public function doMobilegetShareImgUrl() {

		global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$id = intval($_GPC['id']);
		$num = intval($_GPC['num']);
		$from_user = $_GPC['from_user'];
		$djtitle = $_GPC['djtitle'];
//		//网页授权借用开始（特殊代码）
//
//		load()->model('account');
//		$_W['account'] = account_fetch($_W['acid']);
//
//		if ($_W['account']['level'] != 4) {
//			$cookieid = '__cookie_haoman_xxx_201610186_' . $rid;
//			$cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
//			$from_user = $cookie['openid'];
//			$avatar = $cookie['avatar'];
//			$nickname = $cookie['nickname'];
//
//		}else{
//
//			$from_user = $_W['fans']['from_user'];
//			$avatar = $_W['fans']['tag']['avatar'];
//			$nickname = $_W['fans']['nickname'];
//		}
//
//		//网页授权借用结束（特殊代码）

		if (empty($from_user)) {
			$this->message(array("success" => 2, "msg" => '获取不到您的OpenID,请从新进入活动页面'), "");
		}

		$imgName = "haomanxxx".$_W['uniacid'].$id;
		$linkUrl = $_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&m=haoman_xxx&do=hexiao&rid=".$rid."&id=".$id;
		$imgUrl = "../addons/haoman_xxx/qrcode/".$imgName.".png";

		load()->func('file');
		mkdirs(ROOT_PATH . '/qrcode');
		$dir = $imgUrl;
		$flag = file_exists($dir);

		if($flag == false){
			//生成二维码图片
			$errorCorrectionLevel = "L";
			$matrixPointSize = "4";
			QRcode::png($linkUrl,$imgUrl,$errorCorrectionLevel,$matrixPointSize);
			//生成二维码图片
		}

		$data = array(
			'success' => 1,
			'msg' => $imgUrl,
			'djtitle' => $djtitle,
		);

		echo json_encode($data);
	}


	//实物兑奖
	public function doWebSetstatus() {
		global $_GPC, $_W;
		$id = intval($_GPC['id']);
		$rid = intval($_GPC['rid']);
		$status = intval($_GPC['status']);
		$reply = pdo_fetch("select * from " . tablename('haoman_xxx_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
		if (empty($id)) {
			message('抱歉，传递的参数错误！', '', 'error');
		}
		$p = array('status' => $status);
		if ($status == 2) {
			$p['consumetime'] = TIMESTAMP;
		}
		if ($status == 3) {
			$p['consumetime'] = '';
			$p['status'] = 1;
		}
		$temp = pdo_update('haoman_xxx_award', $p, array('id' => $id));
		if ($temp == false) {
			message('抱歉，刚才操作数据失败！', '', 'error');
		} else {
			//从奖池减少奖品
			message('状态设置成功！', $this->createWebUrl('awardlist', array('rid' => $_GPC['rid'])), 'success');
		}
	}
	
//	活动管理
	public function doWebManage() {
		global $_GPC, $_W;

		load()->model('reply');
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$sql = "uniacid = :uniacid and `module` = :module";
		$params = array();
		$params[':uniacid'] = $_W['uniacid'];
		$params[':module'] = 'haoman_xxx';

		if (!empty($_GPC['keyword'])) {
			$sql .= ' and `name` LIKE :keyword';
			$params[':keyword'] = "%{$_GPC['keyword']}%";
		}
		$list = reply_search($sql, $params, $pindex, $psize, $total);
		$pager = pagination($total, $pindex, $psize);

		if (!empty($list)) {
			foreach ($list as &$item) {
				$condition = "`rid`={$item['id']}";
				$item['keyword'] = reply_keywords_search($condition);
				$xxx = pdo_fetch("select fansnum, viewnum,starttime,endtime,isshow from " . tablename('haoman_xxx_reply') . " where rid = :rid ", array(':rid' => $item['id']));
				$item['fansnum'] = $xxx['fansnum'];
				$item['viewnum'] = $xxx['viewnum'];
				$item['starttime'] = date('Y-m-d H:i', $xxx['starttime']);
				$endtime = $xxx['endtime'];
				$item['endtime'] = date('Y-m-d H:i', $endtime);
				$nowtime = time();
				if ($xxx['starttime'] > $nowtime) {
					$item['status'] = '<span class="label label-warning">未开始</span>';
					$item['show'] = 1;
				} elseif ($endtime < $nowtime) {
					$item['status'] = '<span class="label label-default ">已结束</span>';
					$item['show'] = 0;
				} else {
					if ($xxx['isshow'] == 1) {
						$item['status'] = '<span class="label label-success">已开始</span>';
						$item['show'] = 2;
					} else {
						$item['status'] = '<span class="label label-default ">已暂停</span>';
						$item['show'] = 1;
					}
				}
				$item['isshow'] = $xxx['isshow'];
			}
		}
		include $this->template('manage');
	}


	//粉丝管理
	public function doWebFanslist() {
		global $_GPC, $_W;
		$rid = $_GPC['rid'];

		$params = array(':rid' => $rid, ':uniacid' => $_W['uniacid']);
		if (!empty($_GPC['nickname'])) {
			$where.=' and nickname=:nickname';
			$params[':nickname'] = $_GPC['nickname'];
		}
		if (!empty($_GPC['mobile'])) {
			$where.=' and mobile=:mobile';
			$params[':mobile'] = $_GPC['mobile'];
		}

		$total = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_fans') . "  where rid = :rid and uniacid=:uniacid " . $where . "", $params);
		$pindex = max(1, intval($_GPC['page']));
		$psize = 12;
		$pager = pagination($total, $pindex, $psize);
		$start = ($pindex - 1) * $psize;
		$limit .= " LIMIT {$start},{$psize}";
		$list = pdo_fetchall("select * from " . tablename('haoman_xxx_fans') . " where rid = :rid and uniacid=:uniacid " . $where . " order by id desc " . $limit, $params);
		//中奖情况
		foreach ($list as &$lists) {
			$lists['awardinfo'] = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_award') . "  where rid = :rid and from_user=:from_user", array(':rid' => $rid, ':from_user' => $lists['from_user']));
			$lists['share_num'] = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_data') . "  where rid = :rid and fromuser=:fromuser", array(':rid' => $rid, ':fromuser' => $lists['from_user']));
		}
		//中奖情况
		//一些参数的显示
		$num1 = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_fans') . "  where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		$num2 = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_fans') . "  where rid = :rid and uniacid=:uniacid and zhongjiang>0", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		$num3 = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_fans') . "  where rid = :rid and uniacid=:uniacid and zhongjiang=0", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//    $num4 = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_fans') . "  where rid = :rid and uniacid=:uniacid and zhongjiang=2", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//一些参数的显示
		include $this->template('fanslist');
	}


   //导出粉丝数据
	public function  doWebDownload()
	{
		global $_GPC,$_W;
		$rid = intval($_GPC['rid']);


		checklogin();
		$list = pdo_fetchall('select * from ' . tablename('haoman_xxx_fans') . ' where uniacid = :uniacid and rid = :rid ORDER BY id ', array(':uniacid' => $_W['uniacid'],':rid'=>$rid));

		$tableheader = array('ID','微信名称','OPENID','姓名','手机号','地址','时间');
		$html = "\xEF\xBB\xBF";


		foreach ($tableheader as $value) {
			$html .= $value . "\t ,";
		}
		$html .= "\n";
		foreach ($list as $value) {
			$html .= $value['id'] . "\t ,";
			$html .= str_replace('"','',$value['nickname']) . "\t ,";
			$html .=  $value['from_user'] . "\t ,";
			$html .=  $value['realname'] . "\t ,";
			$html .=  $value['mobile'] . "\t ,";
			$html .=  $value['address'] . "\t ,";
			$html .=  date('Y-m-d H:i:s', $value['createtime']) . "\n ";



		}


		header("Content-type:text/csv");

		header("Content-Disposition:attachment;filename=粉丝数据.csv");

		$html = mb_convert_encoding($html, 'gb2312', 'UTF-8');

		echo $html;
		exit();
	}

	//导出中奖记录
	public function  doWebDownload2()
	{
		global $_GPC,$_W;
		$rid = intval($_GPC['rid']);

		checklogin();
		$list = pdo_fetchall('select * from ' . tablename('haoman_xxx_award') . ' where uniacid = :uniacid and rid = :rid ORDER BY id ', array(':uniacid' => $_W['uniacid'],':rid'=>$rid));
		$tableheader = array('ID','微信名称','姓名','OPENID','奖品名称','姓名','手机号','地址','中奖时间','状态');
		$html = "\xEF\xBB\xBF";

		foreach ($list as &$row) {

			if($row['status'] == 1){

				$row['status']='未兑奖';

			}else if($row['status'] == 2){

				$row['status']='已兑奖';

			}
			else{
				$row['status']='不知道';
			}

		}
		foreach ($list as &$lists) {
			$lists['realname'] = pdo_fetchcolumn("select realname from " . tablename('haoman_xxx_fans') . " where from_user = :from_user", array(':from_user' => $lists['from_user']));
			$lists['address'] = pdo_fetchcolumn("select address from " . tablename('haoman_xxx_fans') . " where from_user = :from_user", array(':from_user' => $lists['from_user']));
		}
		foreach ($tableheader as $value) {
			$html .= $value . "\t ,";
		}
		$html .= "\n";
		foreach ($list as $value) {
			$html .= $value['id'] . "\t ,";
			$html .= str_replace('"','',$value['nickname']) . "\t ,";
			$html .= $value['realname'] . "\t ,";
			$html .=  $value['from_user'] . "\t ,";
			$html .=  $value['awardname'] . "\t ,";
			$html .=  $value['realname'] . "\t ,";
			$html .=  $value['mobile'] . "\t ,";
			$html .=  $value['address'] . "\t ,";
			$html .=  date('Y-m-d H:i:s', $value['createtime']) . "\t ,";
			$html .=  $value['status'] . "\n ";


		}


		header("Content-type:text/csv");

		header("Content-Disposition:attachment;filename=中奖记录.csv");

		$html = mb_convert_encoding($html, 'gb2312', 'UTF-8');

		echo $html;
		exit();
	}

    //导出提现记录
	public function  doWebDownload3()
	{
		global $_GPC,$_W;
		$rid = intval($_GPC['rid']);

		checklogin();
		$list = pdo_fetchall('select * from ' . tablename('haoman_xxx_cash') . ' where uniacid = :uniacid and rid = :rid ORDER BY id ', array(':uniacid' => $_W['uniacid'],':rid'=>$rid));
		$tableheader = array('ID','微信名称','OPENID','姓名','手机号','提现金额(元)','提现IP','提现时间','状态');
		$html = "\xEF\xBB\xBF";

		foreach ($list as &$row) {

			if($row['status'] == 1){

				$row['status']='同意';

			}else if($row['status'] == 2){

				$row['status']='拒绝';

			}
			else{
				$row['status']='申请中';
			}

		}
		foreach ($list as &$lists) {
			$lists['realname'] = pdo_fetchcolumn("select realname from " . tablename('haoman_xxx_fans') . " where from_user = :from_user", array(':from_user' => $lists['from_user']));
		}
		foreach ($tableheader as $value) {
			$html .= $value . "\t ,";
		}
		$html .= "\n";
		foreach ($list as $value) {
			$html .= $value['id'] . "\t ,";
			$html .= str_replace('"','',$value['nickname']) . "\t ,";
			$html .=  $value['from_user'] . "\t ,";
			$html .=  $value['realname'] . "\t ,";
			$html .=  $value['mobile'] . "\t ,";
			$html .=  $value['awardname']/100 . "\t ,";
			$html .=  $value['awardsimg'] . "\t ,";
			$html .=  date('Y-m-d H:i:s', $value['createtime']) . "\t ,";
			$html .=  $value['status'] . "\n ";


		}


		header("Content-type:text/csv");

		header("Content-Disposition:attachment;filename=提现记录.csv");

		$html = mb_convert_encoding($html, 'gb2312', 'UTF-8');

		echo $html;
		exit();
	}

	public function doWebAxq() {
		global $_GPC, $_W;
		if ($_W['isajax']) {
			$uid = intval($_GPC['uid']);
			$rid = intval($_GPC['rid']);
			//粉丝数据


			$data = pdo_fetch("select * from " . tablename('haoman_xxx_fans') . ' where id = :id and uniacid = :uniacid', array(':uniacid' => $_W['uniacid'], ':id' => $uid));
			$list = pdo_fetchall("select * from " . tablename('haoman_xxx_award') . "  where rid = :rid and uniacid=:uniacid and from_user=:from_user order by id desc ", array(':uniacid' => $_W['uniacid'], ':rid' => $rid, ':from_user' => $data['from_user']));
			include $this->template('axq');
			exit();
		}
	}

	public function doWebAxq2() {
		global $_GPC, $_W;
		if ($_W['isajax']) {
			$from_user = $_GPC['uid'];
			$rid = intval($_GPC['rid']);
			//粉丝数据


			$data = pdo_fetch("select * from " . tablename('haoman_xxx_fans') . ' where from_user = :from_user and uniacid = :uniacid', array(':uniacid' => $_W['uniacid'], ':from_user' => $from_user));

			$list = pdo_fetchall("select * from " . tablename('haoman_xxx_award') . "  where titleid >5 and rid = :rid and uniacid=:uniacid and from_user=:from_user order by id desc ", array(':uniacid' => $_W['uniacid'], ':rid' => $rid, ':from_user' => $data['from_user']));
			include $this->template('axq2');
			exit();
		}
	}

	public function doWebAwardlist() {
		global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$uniacid = $_W['uniacid'];

		//所有奖品类别		
		//    $reply = pdo_fetch("select turntable from " . tablename('haoman_xxx_reply') . " where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		$award = pdo_fetchall("select * from " . tablename('haoman_xxx_prize') . " where rid = :rid order by `id` asc", array(':rid' => $rid));
		foreach ($award as $k => $awards) {
			$award[$k]['num'] = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_award') . " where rid = :rid and prizetype='" . $awards['id'] . "'", array(':rid' => $rid));
		}
		//所有奖品类别


		if (empty($rid)) {
			message('抱歉，传递的参数错误！', '', 'error');
		}
		$where = '';
		$params = array(':rid' => $rid, ':uniacid' => $_W['uniacid']);
		if (!empty($_GPC['status'])) {
			$where.=' and a.status=:status';
			$params[':status'] = $_GPC['status'];
		}
		if (!empty($_GPC['nickname'])) {
			$where.=' and a.nickname=:nickname';
			$params[':nickname'] = $_GPC['nickname'];
		}

		$total = pdo_fetchcolumn("select count(a.id) from " . tablename('haoman_xxx_award') . " a where a.rid = :rid and a.uniacid=:uniacid " . $where . "", $params);
		$pindex = max(1, intval($_GPC['page']));
		$psize = 12;
		$pager = pagination($total, $pindex, $psize);
		$start = ($pindex - 1) * $psize;
		$limit .= " LIMIT {$start},{$psize}";
		$list = pdo_fetchall("select a.* from " . tablename('haoman_xxx_award') . " a where a.rid = :rid and a.uniacid=:uniacid  " . $where . " order by a.id desc " . $limit, $params);

		//中奖资料
		foreach ($list as &$lists) {
			$lists['realname'] = pdo_fetchcolumn("select realname from " . tablename('haoman_xxx_fans') . " where from_user = :from_user and rid = :rid ", array(':from_user' => $lists['from_user'],':rid'=>$rid));
			$lists['address'] = pdo_fetchcolumn("select address from " . tablename('haoman_xxx_fans') . " where from_user = :from_user and rid = :rid ", array(':from_user' => $lists['from_user'],':rid'=>$rid));
			$lists['ptype'] = pdo_fetchcolumn("select ptype from " . tablename('haoman_xxx_prize') . " where id = :id", array(':id' => $lists['prizetype']));
		}


		//中奖资料	
		//一些参数的显示
		$num1="";
		$prizedraw = pdo_fetchall("select * from " . tablename('haoman_xxx_prize') . " where rid =:rid and uniacid = :uniacid",array(':rid' => $rid,'uniacid'=>$uniacid));
		foreach($prizedraw as $k){
			$num1+=$k['awardstotal'];
		}
		//     $num0 = pdo_fetchcolumn("select awardpassword from " . tablename('haoman_xxx_reply') . " where rid = :rid", array(':rid' => $rid));
		//     $num1 = pdo_fetchcolumn("select count(id)from " . tablename('haoman_xxx_award') . " where rid = :rid", array(':rid' => $rid));
		$num2 = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_award') . " where rid = :rid and status=1", array(':rid' => $rid));
		$num3 = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_award') . " where rid = :rid and status=2", array(':rid' => $rid));
		$num4 = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_award') . " where rid = :rid and status=0", array(':rid' => $rid));
		//一些参数的显示
		include $this->template('awardlist');
	}
	
	public function doWebCashprize() {
		global $_GPC, $_W;
		$rid = $_GPC['rid'];

		$params = array(':rid' => $rid, ':uniacid' => $_W['uniacid']);
		if (!empty($_GPC['nickname'])) {
			$where.=' and nickname=:nickname';
			$params[':nickname'] = $_GPC['nickname'];
		}
		if (!empty($_GPC['mobile'])) {
			$where.=' and mobile=:mobile';
			$params[':mobile'] = $_GPC['mobile'];
		}

		if ($_GPC['status']!='') {
			$where.=' and status=:status';
			$params[':status'] = $_GPC['status'];
		}

		$total = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_cash') . "  where rid = :rid and uniacid=:uniacid " . $where . "", $params);
		$pindex = max(1, intval($_GPC['page']));
		$psize = 12;
		    $pager = pagination($total, $pindex, $psize);
		$start = ($pindex - 1) * $psize;
		$limit .= " LIMIT {$start},{$psize}";
		$list = pdo_fetchall("select * from " . tablename('haoman_xxx_cash') . " where rid = :rid and uniacid=:uniacid " . $where . " order by id desc " . $limit, $params);

		//中奖情况
		foreach ($list as &$lists) {
			$lists['realname'] = pdo_fetchcolumn("select realname from " . tablename('haoman_xxx_fans') . "  where rid = :rid and from_user=:from_user", array(':rid' => $rid, ':from_user' => $lists['from_user']));
		}
		//中奖情况
		//一些参数的显示
		$num1 = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_fans') . "  where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		$num2 = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_fans') . "  where rid = :rid and uniacid=:uniacid and zhongjiang>0", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		$num3 = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_fans') . "  where rid = :rid and uniacid=:uniacid and zhongjiang=0", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//    $num4 = pdo_fetchcolumn("select count(id) from " . tablename('haoman_xxx_fans') . "  where rid = :rid and uniacid=:uniacid and zhongjiang=2", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//一些参数的显示
		include $this->template('cashprize');
	}

	public function doMobileduijiang() {
		global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$inputval = $_GPC['inputval'];
		$num = $_GPC['num'];
		$from_user = $_GPC['from_user'];


//		//网页授权借用开始
//
//		load()->model('account');
//		$_W['account'] = account_fetch($_W['acid']);
//		$cookieid = '__cookie_haoman_qjb_201606186_' . $rid;
//		$cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
//		if ($_W['account']['level'] != 4) {
//			$from_user = $cookie['openid'];
//			$avatar = $cookie['avatar'];
//			$nickname = $cookie['nickname'];
//		}else{
//			$from_user = $_W['fans']['from_user'];
//			$avatar = $_W['fans']['tag']['avatar'];
//			$nickname = $_W['fans']['nickname'];
//		}
//
//		$code = $_GPC['code'];
//		$urltype = '';
//		if (empty($from_user) || empty($avatar)) {
//			if (!is_array($cookie) || !isset($cookie['avatar']) || !isset($cookie['openid'])) {
//				$userinfo = $this->get_UserInfo($rid, $code, $urltype);
//				$nickname = $userinfo['nickname'];
//				$avatar = $userinfo['headimgurl'];
//				$from_user = $userinfo['openid'];
//			} else {
//				$avatar = $cookie['avatar'];
//				$nickname = $cookie['nickname'];
//				$from_user = $cookie['openid'];
//			}
//		}
//
//		//网页授权借用结束


		if (empty($from_user)) {
			$this->message(array("success" => 0, "msg" => '获取不到您的OpenID,请从新进入活动页面'), "");
		}

		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') === false) {
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: {$this->createMobileUrl('other',array('type'=>1,'id'=>$rid))}");
			exit();
		}

		//  $fans = pdo_fetch("select id,mobile from " . tablename('haoman_qib_fans') . " where rid = " . $rid . " and from_user=" . $from_user . "");
		$num0 = pdo_fetch("select password from " . tablename('haoman_xxx_reply') . " where rid = :rid", array(':rid' => $rid));
		if($num0['password']==0){
			if($rid){
				$temp = pdo_update('haoman_xxx_award', array('status' => 2,'consumetime' => time()), array('rid' => $rid, 'from_user' => $from_user, 'uniacid' => $_W['uniacid'], 'id'=>$num));
				$data = array(
					'success' => 1,
					'msg' => '兑奖成功！',
				);
			}
		}
		else{


			if($inputval == $num0['password']){
				$temp = pdo_update('haoman_xxx_award', array('status' => 2,'consumetime' => time()), array('rid' => $rid, 'from_user' => $from_user, 'uniacid' => $_W['uniacid'], 'id'=>$num));
				$data = array(
					'success' => 1,
					'msg' => '兑奖成功！',
				);
			}
			else{
				$data = array(
					'success' => 0,
					'msg' => $num0,
				);
			}

		}

		echo json_encode($data);
	}


	public function doMobileDjcenter()
    {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $display = empty($_GPC['act']) ? 'display' : $_GPC['act'];
        $rid = intval($_GPC['id']);
        $awardid = intval($_GPC['awardid']);
        $title = $_GPC['title'];

       $user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') === false) {

			header("HTTP/1.1 301 Moved Permanently");
			header("Location: {$this->createMobileUrl('other',array('type'=>1,'id'=>$rid))}");
			exit();
		}


        if($display == "display"){

			//网页授权借用开始

			load()->model('account');
			$_W['account'] = account_fetch($_W['acid']);
			$cookieid = '__cookie_haoman_xxx_201606186_' . $rid;
			$cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
			if ($_W['account']['level'] != 4) {
				$from_user = $cookie['openid'];
				$avatar = $cookie['avatar'];
				$nickname = $cookie['nickname'];
			}else{
				$from_user = $_W['fans']['from_user'];
				$avatar = $_W['fans']['tag']['avatar'];
				$nickname = $_W['fans']['nickname'];
			}

			$code = $_GPC['code'];
			$urltype = '';
			if (empty($from_user) || empty($avatar) || empty($nickname)) {
				if (!is_array($cookie) || !isset($cookie['avatar']) || !isset($cookie['openid'])) {
					$userinfo = $this->get_UserInfo($rid, $code, $urltype);
					$nickname = $userinfo['nickname'];
					$avatar = $userinfo['headimgurl'];
					$from_user = $userinfo['openid'];
				} else {
					$avatar = $cookie['avatar'];
					$nickname = $cookie['nickname'];
					$from_user = $cookie['openid'];
				}
			}

			//网页授权借用结束

    		$replys = pdo_fetch("select * from " . tablename('haoman_xxx_reply') . " where uniacid = :uniacid AND password = :from_user", array(':uniacid' => $uniacid,':from_user' => $from_user));

            if($replys == false){
                message('您没有兑奖员权限,请先后台绑定下兑奖员OpenID','','error');
            }


            include $this->template('duijiang');
        }else{

            $award = pdo_fetch("select * from " . tablename('haoman_xxx_award') . " where uniacid = :uniacid and title = :title and status !=2",array(':uniacid'=>$uniacid,':title'=>$title));


            if($award == false || empty($title)){
                message('不存在此奖品！',$this->createMobileUrl('Djcenter'),'error');
            }

            if(intval($_GPC['rid']) == intval($award['rid'])){
                $temp = pdo_update('haoman_xxx_award', array('status' => 2,'consumetime'=>time()), array('id' => $award['id']));
            }else{
                message('您没有兑奖权限,请确认该奖品为此活动规则的奖品！',$this->createMobileUrl('Djcenter'),'error');
            }

            if ($temp === false) {
                message('兑奖奖品不成功，请联系商家',$this->createMobileUrl('Djcenter'),'error');
            } else {
                message('恭喜，已经成功兑换奖品！',$this->createMobileUrl('Djcenter'),'success');
            }
        }


    }


	public function doMobileHexiao()
	{
		global $_GPC, $_W;


		$uniacid = $_W['uniacid'];
		$display = empty($_GPC['act']) ? 'display' : $_GPC['act'];
		$rid = intval($_GPC['rid']);
		$awardid = intval($_GPC['id']);
//		$to_used = $_GPC['from_user'];
//		$djtitle = $_GPC['djtitle'];


		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') === false) {

			header("HTTP/1.1 301 Moved Permanently");
			header("Location: {$this->createMobileUrl('other',array('type'=>1,'id'=>$rid))}");
			exit();
		}


		if($display == "display"){

			//网页授权借用开始

			load()->model('account');
			$_W['account'] = account_fetch($_W['acid']);
			$cookieid = '__cookie_haoman_xxx_201606186_' . $rid;
			$cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
			if ($_W['account']['level'] != 4) {
				$from_user = $cookie['openid'];
				$avatar = $cookie['avatar'];
				$nickname = $cookie['nickname'];
			}else{
				$from_user = $_W['fans']['from_user'];
				$avatar = $_W['fans']['tag']['avatar'];
				$nickname = $_W['fans']['nickname'];
			}

			$code = $_GPC['code'];
			$urltype = '';
			if (empty($from_user) || empty($avatar) || empty($nickname)) {
				if (!is_array($cookie) || !isset($cookie['avatar']) || !isset($cookie['openid'])) {
					$userinfo = $this->get_UserInfo($rid, $code, $urltype);
					$nickname = $userinfo['nickname'];
					$avatar = $userinfo['headimgurl'];
					$from_user = $userinfo['openid'];
				} else {
					$avatar = $cookie['avatar'];
					$nickname = $cookie['nickname'];
					$from_user = $cookie['openid'];
				}
			}

			//网页授权借用结束
			$award = pdo_fetch("select * from " . tablename('haoman_xxx_award') . " where uniacid = :uniacid and id = :id and status != 2",array(':uniacid'=>$uniacid,':id'=>$awardid));
			if($award == false){
				message('奖品不存在或者已经兑换！',$this->createMobileUrl('hexiao'),'error');
			}
			$replys = pdo_fetch("select * from " . tablename('haoman_xxx_reply') . " where uniacid = :uniacid AND password = :from_user", array(':uniacid' => $uniacid,':from_user' => $from_user));

			if($replys == false){
				message('您没有兑奖员权限,请先后台绑定下兑奖员OpenID','','error');
			}

			include $this->template('hexiao');
		}else{

			$award = pdo_fetch("select * from " . tablename('haoman_xxx_award') . " where uniacid = :uniacid and id = :id and status != 2",array(':uniacid'=>$uniacid,':id'=>$awardid));


			if($award == false){
				message('不存在此奖品！',$this->createMobileUrl('hexiao'),'error');
			}

			if(intval($_GPC['rid']) == intval($award['rid'])){
				$temp = pdo_update('haoman_xxx_award', array('status' => 2,'consumetime'=>time()), array('id' => $award['id']));
			}else{
				message('您没有兑奖权限,请确认该奖品为此活动规则的奖品！',$this->createMobileUrl('hexiao'),'error');
			}

			if ($temp === false) {
				message('兑奖奖品不成功，请联系商家',$this->createMobileUrl('hexiao'),'error');
			} else {
				message('恭喜，已经成功兑换奖品！',$this->createMobileUrl('hexiao'),'success');
			}
		}


	}




//  我的奖品
	public function doMobilemybobing() {
		global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$uniacid = $_W['uniacid'];
		$credit1 = $_W['member']['credit1'];

		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') === false) {

			header("HTTP/1.1 301 Moved Permanently");
			header("Location: {$this->createMobileUrl('other',array('type'=>1,'id'=>$rid))}");
			exit();
		}

		//网页授权借用开始

		load()->model('account');
		$_W['account'] = account_fetch($_W['acid']);
		$cookieid = '__cookie_haoman_xxx_201606186_' . $rid;
		$cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
		if ($_W['account']['level'] != 4) {
			$from_user = $cookie['openid'];
			$avatar = $cookie['avatar'];
			$nickname = $cookie['nickname'];
		}else{
			$from_user = $_W['fans']['from_user'];
			$avatar = $_W['fans']['tag']['avatar'];
			$nickname = $_W['fans']['nickname'];
		}

		$code = $_GPC['code'];
		$urltype = '';
		if (empty($from_user) || empty($avatar) || empty($nickname)) {
			if (!is_array($cookie) || !isset($cookie['avatar']) || !isset($cookie['openid']) || !isset($cookie['nickname'])) {
				$userinfo = $this->get_UserInfo($rid, $code, $urltype);
				$nickname = $userinfo['nickname'];
				$avatar = $userinfo['headimgurl'];
				$from_user = $userinfo['openid'];
			} else {
				$avatar = $cookie['avatar'];
				$nickname = $cookie['nickname'];
				$from_user = $cookie['openid'];
			}
		}

		//网页授权借用结束

		


		$page_from_user = base64_encode(authcode($from_user, 'ENCODE'));


		if (empty($rid)) {
			message('抱歉，参数错误！', '', 'error');//调试代码
		}

		$reply = pdo_fetch("select * from " . tablename('haoman_xxx_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));

		$num = $reply['share_acid'] < 100 ? 100 : $reply['share_acid'];

		$fans = pdo_fetch("select * from " . tablename('haoman_xxx_fans') . " where rid = '" . $rid . "' and from_user='" . $from_user . "'");

		if ($fans == false) {
			$insert = array(
				'rid' => $rid,
				'uniacid' => $uniacid,
				'from_user' => $from_user,
				'avatar' => $avatar,
				'nickname' => $nickname,
				'todaynum' => 0,
				'totalnum' => 0,
				'awardnum' => 0,
				'createtime' => time(),
			);
			$temp = pdo_insert('haoman_xxx_fans', $insert);

		} 


			$mybobing = pdo_fetchall("select * from " . tablename('haoman_xxx_award') . " where rid = :rid and from_user =:from_user and uniacid = :uniacid ORDER BY id desc",array(':rid'=>$rid,':from_user'=>$from_user,'uniacid'=>$uniacid));
			$cashs = pdo_fetchall("select * from " . tablename('haoman_xxx_cash') . " where rid = :rid and from_user =:from_user and uniacid = :uniacid and status = 0",array(':rid'=>$rid,':from_user'=>$from_user,'uniacid'=>$uniacid));
            $numx = 0;
		if(empty($cashs)){
			$numx = 0;
		}
		foreach($cashs as $k){
			$numx += $k['awardname'];
		}



		if(empty($mybobing)){
				$mybb = 1;
			}


		//分享信息
		$sharelink = $_W['siteroot'] . 'app/' . $this->createMobileUrl('share', array('rid' => $rid, 'from_user' => $page_from_user));
		$sharetitle = empty($reply['share_title']) ? '一起来咻一咻抽奖吧!' : $reply['share_title'];
		$sharedesc = empty($reply['share_desc']) ? '亲，一起来咻一咻吧，赢大奖哦！！' : str_replace("\r\n", " ", $reply['share_desc']);
		if (!empty($reply['share_imgurl'])) {
			$shareimg = toimage($reply['share_imgurl']);
		} else {
			$shareimg = toimage($reply['picture']);
		}
		$jssdk = new JSSDK();
		$package = $jssdk->GetSignPackage();
		include $this->template('index3');
	}



//  规则
	public function doMobilerules() {
		global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$uniacid = $_W['uniacid'];

		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') === false) {

			header("HTTP/1.1 301 Moved Permanently");
			header("Location: {$this->createMobileUrl('other',array('type'=>1,'id'=>$rid))}");
			exit();
		}

		//网页授权借用开始

		load()->model('account');
		$_W['account'] = account_fetch($_W['acid']);
		$cookieid = '__cookie_haoman_xxx_201606186_' . $rid;
		$cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
		if ($_W['account']['level'] != 4) {
			$from_user = $cookie['openid'];
			$avatar = $cookie['avatar'];
			$nickname = $cookie['nickname'];
		}else{
			$from_user = $_W['fans']['from_user'];
			$avatar = $_W['fans']['tag']['avatar'];
			$nickname = $_W['fans']['nickname'];
		}

		$code = $_GPC['code'];
		$urltype = '';
		if (empty($from_user) || empty($avatar) || empty($nickname)) {
			if (!is_array($cookie) || !isset($cookie['avatar']) || !isset($cookie['openid']) || !isset($cookie['nickname'])) {
				$userinfo = $this->get_UserInfo($rid, $code, $urltype);
				$nickname = $userinfo['nickname'];
				$avatar = $userinfo['headimgurl'];
				$from_user = $userinfo['openid'];
			} else {
				$avatar = $cookie['avatar'];
				$nickname = $cookie['nickname'];
				$from_user = $cookie['openid'];
			}
		}

		//网页授权借用结束

		$page_from_user = base64_encode(authcode($from_user, 'ENCODE'));


		if (empty($rid)) {
			message('抱歉，参数错误！', '', 'error');//调试代码
		}

		

		$reply = pdo_fetch("select * from " . tablename('haoman_xxx_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));

		if ($reply == false) {
			message('抱歉，活动已经结束，下次再来吧！', '', 'error');
		}

		$prize = pdo_fetchall("select * from " . tablename('haoman_xxx_prize') . " where rid = '" . $rid . "' and uniacid = '" . $uniacid . "' and awardsimg!=''  order by id");

		//分享信息
		$sharelink = $_W['siteroot'] . 'app/' . $this->createMobileUrl('share', array('rid' => $rid, 'from_user' => $page_from_user));
		$sharetitle = empty($reply['share_title']) ? '一起来咻一咻抽奖吧!' : $reply['share_title'];
		$sharedesc = empty($reply['share_desc']) ? '亲，一起来咻一咻吧，赢大奖哦！！' : str_replace("\r\n", " ", $reply['share_desc']);
		if (!empty($reply['share_imgurl'])) {
			$shareimg = toimage($reply['share_imgurl']);
		} else {
			$shareimg = toimage($reply['picture']);
		}
		$jssdk = new JSSDK();
		$package = $jssdk->GetSignPackage();
		include $this->template('index5');
	}

	//修改资料
	public function doMobileinformation(){
		global $_GPC,$_W;
		$this->checkFollow;
		$this->checkBowser;
		$rid = intval($_GPC['id']);

		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') === false) {

			header("HTTP/1.1 301 Moved Permanently");
			header("Location: {$this->createMobileUrl('other',array('type'=>1,'id'=>$rid))}");
			exit();
		}

		$from_user = $_W['fans']['from_user'];

		load()->model('account');
        $_W['account'] = account_fetch($_W['acid']);
        if ($_W['account']['level'] != 4) {
            $from_user = authcode(base64_decode($_GPC['from_user']), 'DECODE');;
        }


		$reply = pdo_fetch( " SELECT * FROM ".tablename('haoman_xxx_reply')." WHERE rid='".$rid."' " );

		$fans = pdo_fetch("select * from " . tablename('haoman_xxx_fans') . " where rid = '" . $rid . "' and from_user='" . $from_user . "'");
		if($_GPC['op'] == 'chance'){
			$realname = trim($_GPC['realname']);
			$mobile = trim($_GPC['mobile']);
			$address = trim($_GPC['address']);
			if(empty($mobile)){
				message('请填写手机号码');
			}
			$chars = "/^((\(\d{2,3}\))|(\d{3}\-))?1(3|5|8|9|7)\d{9}$/";
			$flag = preg_match($chars, $mobile);
			if($flag == false){
				message("请填写正确的手机格式");
			}
			if(empty($fans)){
				$insert = array(
					'weid' => $_W['uniacid'],
					'openid' => $_W['openid'],
					'realname' => $realname,
					'mobile' => $mobile,
					'address' => $address,
					'rid' => $rid,
				);
				pdo_insert('haoman_xxx_fans',$insert);
			}else{
				$fans['realname'] = $realname;
				$fans['mobile'] = $mobile;
				$fans['address'] = $address;
				pdo_update('haoman_xxx_fans',$fans,array('id'=>$fans['id']));
			}
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: {$this->createMobileUrl('index',array('id'=>$rid))}");
			exit();
		}

		include $this->template('index6');
	}

	//抽奖页面
	public function doMobileIndex() {
		global $_GPC, $_W;
		$rid = intval($_GPC['id']);
		$uniacid = $_W['uniacid'];

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') === false) {

			header("HTTP/1.1 301 Moved Permanently");
			header("Location: {$this->createMobileUrl('other',array('type'=>1,'id'=>$rid))}");
			exit();
		}


		//网页授权借用开始

		load()->model('account');
		$_W['account'] = account_fetch($_W['acid']);
		$cookieid = '__cookie_haoman_xxx_201606186_' . $rid;
		$cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
		if ($_W['account']['level'] != 4) {
			$from_user = $cookie['openid'];
			$avatar = $cookie['avatar'];
			$nickname = $cookie['nickname'];
		}else{
			$from_user = $_W['fans']['from_user'];
			$avatar = $_W['fans']['tag']['avatar'];
			$nickname = $_W['fans']['nickname'];
		}

		$code = $_GPC['code'];
		$urltype = '';
		if (empty($from_user) || empty($avatar) || empty($nickname)) {
			if (!is_array($cookie) || !isset($cookie['avatar']) || !isset($cookie['openid']) || !isset($cookie['nickname'])) {
				$userinfo = $this->get_UserInfo($rid, $code, $urltype);
				$nickname = $userinfo['nickname'];
				$avatar = $userinfo['headimgurl'];
				$from_user = $userinfo['openid'];
			} else {
				$avatar = $cookie['avatar'];
				$nickname = $cookie['nickname'];
				$from_user = $cookie['openid'];
			}
		}

		//网页授权借用结束

		$page_from_user = base64_encode(authcode($from_user, 'ENCODE'));

		

		$reply = pdo_fetch("select * from " . tablename('haoman_xxx_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
		if (empty($reply)) {
			message('非法访问，请重新发送消息进入活动页面！');
		}
		if($reply['getip'] != 0){

			$this->getip($reply['getip_addr'],$reply['getip'],$rid);

		}


		//检测是否关注
		if (!empty($reply['share_url'])) {
			//查询是否为关注用户
			$fansID = $_W['member']['uid'];
			$follow = pdo_fetchcolumn("select follow from " . tablename('mc_mapping_fans') . " where uid=:uid and uniacid=:uniacid order by `fanid` desc", array(":uid" => $fansID, ":uniacid" => $uniacid));

			if ($follow == 0) {
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: " . $reply['share_url'] . "");
				exit();
			}

		}

		
		//检测是否为空
		$fans = pdo_fetch("select * from " . tablename('haoman_xxx_fans') . " where rid = '" . $rid . "' and from_user='" . $from_user . "'");
		if ($fans == false) {
			$insert = array(
				'rid' => $rid,
				'uniacid' => $uniacid,
				'from_user' => $from_user,
				'avatar' => $avatar,
				'nickname' => $nickname,
				'todaynum' => 0,
				'today_most_times' => 0,
				'totalnum' => 0,
				'awardnum' => 0,
				'createtime' => time(),
			);
			$temp = pdo_insert('haoman_xxx_fans', $insert);
			$fans['id'] = pdo_insertid();
			$fans = pdo_fetch("select * from " . tablename('haoman_xxx_fans') . " where rid = '" . $rid . "' and from_user='" . $from_user . "'");


			if ($temp == false) {
				message('抱歉，刚才操作数据失败！', '', 'error');
			}
			//增加人数，和浏览次数
			pdo_update('haoman_xxx_reply', array('fansnum' => $reply['fansnum'] + 1, 'viewnum' => $reply['viewnum'] + 1), array('id' => $reply['id']));
		} else {
			//增加浏览次数
			pdo_update('haoman_xxx_reply', array('viewnum' => $reply['viewnum'] + 1), array('id' => $reply['id']));
		}

		$nowtime = mktime(0, 0, 0);
		if ($fans['last_time'] < $nowtime) {

			$fans['todaynum'] = 0;
			$fans['today_most_times'] = 0;
			$fans['sharenum'] = 0;
			$fans['sharetime'] = 0;
			$fans['bbm_use_times']=0;

			if($reply['timenum']==1){
				$fans['isad']=0;

				$temp = pdo_update('haoman_xxx_fans', array('isad'=>$fans['isad'],'bbm_use_times' =>$fans['bbm_use_times'],'today_most_times' =>$fans['today_most_times'],'todaynum' => $fans['todaynum'],'sharenum' => $fans['sharenum'],'sharetime'=>$fans['sharetime'], 'last_time' => $nowtime), array('id' => $fans['id']));

			}
			else{
				$temp = pdo_update('haoman_xxx_fans', array('bbm_use_times' =>$fans['bbm_use_times'],'today_most_times' =>$fans['today_most_times'],'todaynum' => $fans['todaynum'],'sharenum' => $fans['sharenum'],'sharetime'=>$fans['sharetime'], 'last_time' => $nowtime), array('id' => $fans['id']));

			}

		}


		//首页广告显示控制
		if ($reply['timead'] > 0) {

			if($fans['isad'] == 0){
				pdo_update('haoman_xxx_fans', array('isad' => 1), array('from_user' => $from_user));
				//分享信息
				$sharelink = $_W['siteroot'] . 'app/' . $this->createMobileUrl('share', array('rid' => $rid, 'from_user' => $page_from_user));
				$sharetitle = empty($reply['share_title']) ? '一起来咻红包吧！' : $reply['share_title'];
				$sharedesc = empty($reply['share_desc']) ? '亲，一起来咻红包吧，赢大奖哦！！' : str_replace("\r\n", " ", $reply['share_desc']);
				if (!empty($reply['share_imgurl'])) {
					$shareimg = toimage($reply['share_imgurl']);
				} else {
					$shareimg = toimage($reply['picture']);
				}

				include $this->template('timead');
				exit;
			}
		}
		//首页广告显示控



		if($reply['ziliao']==1){
			if(empty($fans['mobile'])){
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: {$this->createMobileUrl('information',array('id'=>$rid,'from_user'=>$page_from_user))}");
				exit();
				//$this->createMobileUrl('information',array('id'=>$rid));
			}
		}elseif($reply['ziliao']==0){
			//判断是否第一次中奖
			$awardx = pdo_fetchall("SELECT * FROM " . tablename('haoman_xxx_award') . " WHERE rid = " . $rid . " and from_user='" . $from_user . "' order by id desc");
			// $this->message(array("success" => 2, "msg" => $fans['tel']), "");
			if ($awardx != false) {
				$awardone = $awardx[0];
			}

			if ($awardone && empty($fans['mobile'])) {
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: {$this->createMobileUrl('information',array('id'=>$rid,'from_user'=>$page_from_user))}");
				exit();
			}
		}




		if($reply['number_times']!=0){
			if($fans['sharetime']>$reply['number_times']||$fans['sharetime']==$reply['number_times']){
				$numx =1;
			}
		}


		if ($reply['sharenum'] > 0) {

			if ($reply['most_num_times'] > 0 && $fans['sharenum'] >= 0) {
				$reply['most_num_times'] = $reply['most_num_times'] + $fans['sharenum']+$fans['bbm_use_times'];
			}
		}

		if($reply['most_num_times'] > 0) {
			$Lcount = $reply['most_num_times'] - $fans['todaynum'];
		}  else {
			$Lcount = 99999;
		}



		$Lcount = $Lcount < 0 ? 0 : $Lcount;

		if (empty($fans['todaynum'])) {
			$fans['todaynum'] = 0;
		}


		$addad = pdo_fetchall("select * from " . tablename('haoman_xxx_addad') . " where rid = :rid ", array(':rid' => $rid));
		$num1 = array_rand($addad);
		$addad_img = $addad[$num1][adlogo];
		$addad_url = $addad[$num1][adlink];
		

		//卡券
    	$cardArry = $this->getCardTicket($rid,$from_user);

		$awardlist = pdo_fetchall("SELECT * FROM " . tablename('haoman_xxx_award') . " WHERE rid = :rid and uniacid = :uniacid ORDER BY createtime DESC limit 15 ",array(':rid'=>$rid,':uniacid'=>$uniacid));
		foreach ($awardlist as &$lists) {
			$lists['nickname'] = pdo_fetchcolumn("select nickname from " . tablename('haoman_xxx_fans') . " where from_user = :from_user and rid = :rid ", array(':from_user' => $lists['from_user'],':rid'=>$rid));
			$lists['avatar'] = pdo_fetchcolumn("select avatar from " . tablename('haoman_xxx_fans') . " where from_user = :from_user and rid = :rid ", array(':from_user' => $lists['from_user'],':rid'=>$rid));
		}


		//分享信息
		$sharelink = $_W['siteroot'] . 'app/' . $this->createMobileUrl('share', array('rid' => $rid, 'from_user' => $page_from_user));
		$sharetitle = empty($reply['share_title']) ? '一起来咻一咻抽奖吧!' : $reply['share_title'];
		$sharedesc = empty($reply['share_desc']) ? '亲，一起来咻一咻吧，赢大奖哦！！' : str_replace("\r\n", " ", $reply['share_desc']);
		if (!empty($reply['share_imgurl'])) {
			$shareimg = toimage($reply['share_imgurl']);
		} else {
			$shareimg = toimage($reply['picture']);
		}

		$jssdk = new JSSDK();
		$package = $jssdk->GetSignPackage();
		include $this->template('index');
	}

	private function sendText($openid,$txt){
		global $_W;
		$acid=pdo_fetchcolumn("SELECT acid FROM ".tablename('account')." WHERE uniacid=:uniacid ",array(':uniacid'=>$_W['uniacid']));
		$acc = WeAccount::create($acid);
		$data = $acc->sendCustomNotice(array('touser'=>$openid,'msgtype'=>'text','text'=>array('content'=>urlencode($txt))));
		return $data;


	}

    //开始咻红包了
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
		unset($proArr);
		return $result;
	}
	public function doMobileget_award() {
		global $_GPC, $_W;
		$rid = intval($_GPC['id']);
		$uniacid = $_W['uniacid'];

		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') === false) {

			header("HTTP/1.1 301 Moved Permanently");
			header("Location: {$this->createMobileUrl('other',array('type'=>1,'id'=>$rid))}");
			exit();
		}

		$fansID = $_W['member']['uid'];
		$credit1 = $_W['member']['credit1'];

//		if (empty($fansID)) {
//			$this->message(array("success" => 2,'level'=>1, "msg" => '$fansID,请关注公众号后，从新进入活动页面'), "");
//		}

		$from_user = $_W['fans']['from_user'];
		$avatar = $_W['fans']['tag']['avatar'];
		$nickname = $_W['fans']['nickname'];

		load()->model('account');
        $_W['account'] = account_fetch($_W['acid']);
        $cookieid = '__cookie_haoman_xxx_201606186_' . $rid;
		$cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
        if ($_W['account']['level'] != 4) {
            $from_user = authcode(base64_decode($_GPC['from_user']), 'DECODE');
            $avatar = $cookie['avatar'];
			$nickname = $cookie['nickname'];
        }


		if (empty($from_user)) {
			$this->message(array("success" => 2,'level'=>1, "msg" => '获取不到您的OpenID,请从新进入活动页面'), "");
		}



		//开始抽奖咯
		$reply = pdo_fetch("select * from " . tablename('haoman_xxx_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
		if ($reply == false) {
			$this->message(array("success" => 2,'level'=>1, "msg" => '规则出错！...'), "");
		}

		if ($reply['isshow'] != 1) {
			//活动已经暂停,请稍后...
			$this->message(array("success" => 2,'level'=>1, "msg" => '活动暂停，请稍后...'), "");
		}

		if ($reply['starttime'] > time()) {
			$this->message(array("success" => 2,'level'=>1, "msg" => '活动还没有开始呢'), "");
		}

		if ($reply['endtime'] < time()) {
			$this->message(array("success" => 2,'level'=>1, "msg" => '活动已经结束了！'), "");
		}

		if (!empty($reply['share_url'])) {
			//判断是否为关注用户
			$fansID = $_W['member']['uid'];
			$follow = pdo_fetchcolumn("select follow from " . tablename('mc_mapping_fans') . " where uid=:uid and uniacid=:uniacid order by `fanid` desc", array(":uid" => $fansID, ":uniacid" => $uniacid));
			if ($follow == 0) {
				$this->message(array("success" => 3,'level'=>1, "msg" => '您还未关注公共账号！'), "");
			}

		}
		//判断是否为关注用户
		$fans = pdo_fetch("select * from " . tablename('haoman_xxx_fans') . " where rid = " . $rid . " and from_user='" . $from_user . "'");
		if ($fans == false) {
			$this->message(array("success" => 5,'level'=>1, "msg" => '获取不到您的会员信息，请刷新页面重试!'), "");
		}


		if($reply['ziliao']==1){
			if (empty($fans['mobile'])) {
				$this->message(array("success" => 5,'level'=>1, "msg" => '您还没有填兑奖信息!'), "");
			}
		}elseif($reply['ziliao']==0){
			//判断是否第一次中奖
			$award = pdo_fetchall("SELECT * FROM " . tablename('haoman_xxx_award') . " WHERE rid = " . $rid . " and from_user='" . $from_user . "' order by id desc");
			// $this->message(array("success" => 2, "msg" => $fans['tel']), "");
			if ($award != false) {
				$awardone = $award[0];
			}

			if ($awardone && empty($fans['mobile'])) {
				$this->message(array("success" => 5,'level'=>1, "msg" => '您还没有填兑奖信息!'), "");
			}
		}

		//查询分享赠送次数
		if ($reply['sharenum'] > 0 ) {

			if ($reply['most_num_times'] > 0 && $fans['sharenum'] >= 0) {
				$reply['most_num_times'] = $reply['most_num_times'] + $fans['sharenum']+$fans['bbm_use_times'];
				$user['num'] = $reply['most_num_times'];
			}
		}

		//查询分享赠送次数
		//更新当日次数
		$nowtime = mktime(0, 0, 0);
		if ($fans['last_time'] < $nowtime) {
			$fans['todaynum'] = 0;
			$fans['today_most_times'] = 0;
		}
		if ($fans['todaynum'] >= $reply['most_num_times'] && $reply['most_num_times'] > 0) {
			//$this->message('', '超过当日限制次数');
			$this->message(array("success" => 4,'level'=>1, "msg" => '您超过当日抽奖次数了!'), "");
		}
		//所有奖品
		$gift = pdo_fetchall("select * from " . tablename('haoman_xxx_prize') . " where rid = :rid and uniacid=:uniacid order by Rand()", array(':rid' => $rid, ':uniacid' => $uniacid));
		$rate = 1;
		foreach ($gift as $giftxiao) {
			if ($giftxiao['probalilty'] < 1 && $giftxiao['probalilty'] > 0 && $giftxiao['awardstotal'] - $giftxiao['prizedraw'] >= 1) {
				$temp = explode('.', $giftxiao['probalilty']);
				$temp = pow(10, strlen($temp[1]));
				$rate = $temp < $rate ? $rate : $temp;
			}
		}
		$prize_arr = array();
		$isgift = false;
		foreach ($gift as $row) {
			if ($row['awardstotal'] - $row['prizedraw'] >= 1 and floatval($row['awardspro']) > 0) {
				$item = array(
					'id' => $row['id'],
					'prize' => $row['prizetype'],
					'v' => $row['awardspro'] * $rate,
				);
				$prize_arr[] = $item;
				$isgift = true;
			}
			$zprizepro += $row['awardspro'];
		}

		if ((100 - $zprizepro) > 0) {
			$item = array(
				'id' => 0,
				'prize' => '好可惜！没有中22',
				'v' => (100 - $zprizepro) * $rate,
			);
			$prize_arr[] = $item;
		}

        //点数概率
		$level=array();

		//所有奖品
		if ($isgift) {
			$last_time = strtotime(date("Y-m-d", mktime(0, 0, 0)));
			//当天抽奖次数
        //   	pdo_update('haoman_xxx_fans', array('today_most_times' => $fans['today_most_times'] + 1,'todaynum' => $fans['todaynum'] + 1, 'last_time' => $last_time), array('id' => $fans['id']));

			//开始抽奖咯
			foreach ($prize_arr as $key => $val) {
				$arr[$val['id']] = $val['v'];
			}
			$prizetype = $this->get_rand($arr); //根据概率获取奖项id


			if ($fans['awardnum'] >= $reply['award_times'] && $reply['award_times'] != 0) {
				$prizetype = -1;
				 pdo_update('haoman_xxx_fans', array('todaynum' => $fans['todaynum'] + 1, 'last_time' => $last_time), array('id' => $fans['id']));
				$data = array(
					'msg' => '好可惜!！没有抽中！!',
					'level'=>1,
					'success' => 11,
				);
				$this->message($data);
			} else {

				if ($fans['today_most_times'] >= $reply['today_most_times'] && $reply['today_most_times'] != 0) {
					$prizetype = -1;
					 pdo_update('haoman_xxx_fans', array('todaynum' => $fans['todaynum'] + 1, 'last_time' => $last_time), array('id' => $fans['id']));
					$data = array(
						'msg' => '好可惜!！没有抽中！',
						'level'=>1,
						'success' => 11,
					);
					$this->message($data);

				} else {



					if ($prizetype > 0) {

						$status = 1;

						$consumetime = '';

						$awardinfo = pdo_fetch("select * from " . tablename('haoman_xxx_prize') . " where  id='" . $prizetype . "'");

						if($awardinfo['ptype'] == 1){

							$prizetype = $_GPC['cardrowid'];

							$awardinfo = pdo_fetch("select * from " . tablename('haoman_xxx_prize') . " where  id='" . $prizetype . "'");

						}


						switch ($awardinfo['ptype']) {

							case 0:

								$credit = (mt_rand($awardinfo['credit'], $awardinfo['credit2']));

								if ($credit < 100) {
									//中奖记录保存


									$insert = array(
										'uniacid' => $uniacid,
										'rid' => $rid,
										'from_user' => $from_user,
										'avatar' => $avatar,
										'nickname' => $nickname,
										'mobile' => $fans['mobile'],
										'awardname' => $awardinfo['prizename'],
										'awardsimg' => $awardinfo['awardsimg'],
										'prizetype' => 0,
										'credit' => $credit,
										'prize' => $prizetype,
										'createtime' => time(),
										'consumetime' => $consumetime,
										'status' => 1,
									);

									

                                  	$nu = $credit/100;
									$actions = "恭喜您抽中：".$awardinfo['prizename']."，获得红包".$nu."元";

									$temp = pdo_insert('haoman_xxx_award', $insert);

									if($temp == false){

										$data = array(
											'msg' => '好可惜!！没有抽中!!！',
											'level'=>1,
											'success' => 11,
										);
										$this->message($data);

									}else{
										$this->sendText($from_user,$actions);
										pdo_update('haoman_xxx_prize', array('prizedraw' => $awardinfo['prizedraw'] + 1), array('id' => $prizetype));
										pdo_update('haoman_xxx_fans', array('today_most_times' => $fans['today_most_times'] + 1,'todaynum' => $fans['todaynum'] + 1,'awardnum' => $fans['awardnum'] + 1,'totalnum' => $fans['totalnum'] + $credit, 'zhongjiang' => 1), array('id' => $fans['id']));
									
										
									}

								} else {


									//中奖记录保存
									$insert = array(
										'uniacid' => $uniacid,
										'rid' => $rid,
										'from_user' => $from_user,
										'avatar' => $avatar,
										'nickname' => $nickname,
										'mobile' => $fans['mobile'],
										'awardname' => $awardinfo['prizename'],
										'awardsimg' => $awardinfo['awardsimg'],
										'prizetype' => 0,
										'credit' => $credit,
										'prize' => $prizetype,
										'createtime' => time(),
										'consumetime' => $consumetime,
										'status' => 2,
									);
									

									$record['fee'] = $credit / 100; //红包金额；
									$record['openid'] = $from_user;
									$user['nickname'] = $nickname;

									$sendhongbao = $this->sendhb($record, $user);


									if (is_error($sendhongbao['isok'])) {

										$awardinfo['prizename'] = $awardinfo['prizename'] . "虽然您中了红包，但是我们不真发哦！";

										

									} else {
										if ($sendhongbao['isok']) {

											$actions = "恭喜您抽中：".$awardinfo['prizename']."，获得红包".$record['fee']."元";
											//更新提现状态
//											$awardinfo['prizename'] = $awardinfo['prizename'] . "红包已发放成功！";
											$temp = pdo_insert('haoman_xxx_award', $insert);

											if($temp == false){

												$data = array(
													'msg' => '好可惜!!！没有抽中!！',
													'level'=>1,
													'success' => 11,
												);
												$this->message($data);

											}else{
								        		$this->sendText($from_user,$actions);
												pdo_update('haoman_xxx_prize', array('prizedraw' => $awardinfo['prizedraw'] + 1), array('id' => $prizetype));
												pdo_update('haoman_xxx_fans', array('today_most_times' => $fans['today_most_times'] + 1,'todaynum' => $fans['todaynum'] + 1,'awardnum' => $fans['awardnum'] + 1,'zhongjiang' => 1), array('id' => $fans['id']));
											
												
											}
											
										} else {

											if(!empty($reply['gl_openid'])){
												$actions = "亲爱的管理员，有粉丝红包领取失败！\n原因：".$sendhongbao['error_msg'];
												$this->sendText($reply['gl_openid'],$actions);
											}


											$awardinfo['prizename'] = $awardinfo['prizename'] . "红包发送失败,请联系商家！";

											
											$data = array(
												'success' => 6,
												'level'=>1,
												//   'msg'=>$sendhongbao['error_msg'],
												'msg' => '红包发送完毕，掌柜的充值中...',
											);

											$this->message($data);
										}
									}
								}
								break;

							case 1:

								//中奖记录保存
								$insert = array(
									'uniacid' => $uniacid,
									'rid' => $rid,
									'avatar' => $avatar,
									'nickname' => $nickname,
									'mobile' => $fans['mobile'],
									'from_user' => $from_user,
									'awardname' => $awardinfo['prizename'],
									'awardsimg' => $awardinfo['awardsimg'],
									'card_id' => $awardinfo['couponid'],
									'prizetype' => 1,
									'prize' => $prizetype,
									'createtime' => time(),
									'consumetime' => $consumetime,
									'status' => 2,
								);
							
								$actions = "恭喜您抽中：".$awardinfo['prizename']."，获得卡券一张";

								$temp = pdo_insert('haoman_xxx_award', $insert);

								if($temp == false){

									$data = array(
										'msg' => '好可惜!!！没有抽中！',
										'level'=>1,
										'success' => 11,
									);
									$this->message($data);

								}else{
									$this->sendText($from_user,$actions);
									pdo_update('haoman_xxx_fans', array('today_most_times' => $fans['today_most_times'] + 1,'todaynum' => $fans['todaynum'] + 1,'awardnum' => $fans['awardnum'] + 1, 'zhongjiang' => 1), array('id' => $fans['id']));
									pdo_update('haoman_xxx_prize', array('prizedraw' => $awardinfo['prizedraw'] + 1), array('id' => $prizetype));
									
									
								}
								
								break;

							case 2:
								$djtitle = $_W['uniacid'].sprintf('%d', time());
								//中奖记录保存
								$insert = array(
									'uniacid' => $uniacid,
									'rid' => $rid,
									'avatar' => $avatar,
									'nickname' => $nickname,
									'mobile' => $fans['mobile'],
									'from_user' => $from_user,
									'title' => $djtitle,
									'awardname' => $awardinfo['prizename'],
									'awardsimg' => $awardinfo['awardsimg'],
									'jifen' => $awardinfo['jifen'],
									'prizetype' => 2,
									'prize' => $prizetype,
									'createtime' => time(),
									'consumetime' => $consumetime,
									'status' => 1,
								);

								$actions = "恭喜您抽中：".$awardinfo['prizename'].",您的兑奖码是:".$djtitle;
								
								$temp = pdo_insert('haoman_xxx_award', $insert);

								if($temp == false){

									$data = array(
										'msg' => '好可惜!！没有抽中！',
										'level'=>1,
										'success' => 11,
									);
									$this->message($data);

								}else{
									$this->sendText($from_user,$actions);
									pdo_update('haoman_xxx_prize', array('prizedraw' => $awardinfo['prizedraw'] + 1), array('id' => $prizetype));
									pdo_update('haoman_xxx_fans', array('today_most_times' => $fans['today_most_times'] + 1,'todaynum' => $fans['todaynum'] + 1,'awardnum' => $fans['awardnum'] + 1,'zhongjiang' => 1), array('id' => $fans['id']));
									
									
								}
								
								break;
							case 3:
								$jifen = (mt_rand($awardinfo['jifen'], $awardinfo['jifen2']));
								//中奖记录保存
								$insert = array(
									'uniacid' => $uniacid,
									'rid' => $rid,
									'avatar' => $avatar,
									'nickname' => $nickname,
									'mobile' => $fans['mobile'],
									'from_user' => $from_user,
									'awardname' => $awardinfo['prizename'],
									'awardsimg' => $awardinfo['awardsimg'],
									'jifen' => $jifen,
									'prizetype' => 1,
									'prize' => $prizetype,
									'createtime' => time(),
									'consumetime' => $consumetime,
									'status' => 2,
								);

								$actions = "恭喜您抽中：".$jifen."积分";

								$temp = pdo_insert('haoman_xxx_award', $insert);

								if($temp == false){

									$data = array(
										'msg' => '好可惜!!！没有抽中！',
										'level'=>1,
										'success' => 11,
									);
									$this->message($data);

								}else{


									$this->sendText($from_user,$actions);
									pdo_update('haoman_xxx_fans', array('today_most_times' => $fans['today_most_times'] + 1,'todaynum' => $fans['todaynum'] + 1,'awardnum' => $fans['awardnum'] + 1, 'zhongjiang' => 1), array('id' => $fans['id']));
									pdo_update('haoman_xxx_prize', array('prizedraw' => $awardinfo['prizedraw'] + 1), array('id' => $prizetype));

									mc_credit_update($fansID, 'credit1', $jifen, array($fansID, '咻一咻活动抽中' . $jifen . '积分'));


								}

								break;

							default :
								pdo_update('haoman_xxx_fans', array('todaynum' => $fans['todaynum'] + 1, 'last_time' => $last_time), array('id' => $fans['id']));

								$data = array(
									'msg' => '好可惜！没有中奖!！',
									'level'=>1,
									'success' => 11,
									'height' => 240,
								);
								$this->message($data);

						}


						if (!empty($awardinfo['awardsimg'])) {
							$awardinfo['awardsimg'] = toimage($awardinfo['awardsimg']);
						}



						if (empty($awardinfo['prizename'])) {
							$awardinfo['prizename'] = "卡券ID设置错误";
						}

						if (!empty($awardinfo['credit'])) {
							$awardinfo['credit'] = $credit;
						}
						if (!empty($awardinfo['jifen'])) {
							$awardinfo['jifen'] = $jifen;
						}

						$data = array(
							'award' => $awardinfo,
							'msg' => '中奖了！',
							'level' => $level,
							'success' => 1,
							'prizetype' => $prizetype,
							'ptype' => $awardinfo['ptype'],
						);


						$this->message($data);
					} else {
						pdo_update('haoman_xxx_fans', array('todaynum' => $fans['todaynum'] + 1, 'last_time' => $last_time), array('id' => $fans['id']));
						$data = array(
							'msg' => '好可惜!！没有抽中！!',
							'level'=>1,
							'success' => 11,
						);
						$this->message($data);

					}
				}
			}
		} else {
			$last_time = strtotime(date("Y-m-d", mktime(0, 0, 0)));
			pdo_update('haoman_xxx_fans', array('today_most_times' => $fans['today_most_times'] + 1,'todaynum' => $fans['todaynum'] + 1, 'last_time' => $last_time), array('id' => $fans['id']));
			$data = array(
				'msg' => '奖品被抽完了，下次赶早哦！',
				'level'=>1,
				'success' => 11,
			);
		}


		$this->message($data);
	}

	
	
	//json
	public function message($_data = '', $_msg = '') {
		if (!empty($_data['succes']) && $_data['success'] != 2) {
			$this->setfans();
		}
		if (empty($_data)) {
			$_data = array(
				'name' => "谢谢参与",
				'success' => 1,
			);
		}
		if (!empty($_msg)) {
			//$_data['error']='invalid';
			$_data['msg'] = $_msg;
		}
		die(json_encode($_data));
	}

    //实物核销
	// public function doMobileduijiang() {
	// 	global $_GPC, $_W;
	// 	$rid = intval($_GPC['rid']);
	// 	$inputval = $_GPC['inputval'];
	// 	$num = $_GPC['num'];



	// 	//网页授权借用开始

	// 	load()->model('account');
	// 	$_W['account'] = account_fetch($_W['acid']);
	// 	$cookieid = '__cookie_haoman_xxx_201606186_' . $rid;
	// 	$cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
	// 	if ($_W['account']['level'] != 4) {
	// 		$from_user = $cookie['openid'];
	// 		$avatar = $cookie['avatar'];
	// 		$nickname = $cookie['nickname'];
	// 	}else{
	// 		$from_user = $_W['fans']['from_user'];
	// 		$avatar = $_W['fans']['tag']['avatar'];
	// 		$nickname = $_W['fans']['nickname'];
	// 	}

	// 	$code = $_GPC['code'];
	// 	$urltype = '';
	// 	if (empty($from_user) || empty($avatar)) {
	// 		if (!is_array($cookie) || !isset($cookie['avatar']) || !isset($cookie['openid'])) {
	// 			$userinfo = $this->get_UserInfo($rid, $code, $urltype);
	// 			$nickname = $userinfo['nickname'];
	// 			$avatar = $userinfo['headimgurl'];
	// 			$from_user = $userinfo['openid'];
	// 		} else {
	// 			$avatar = $cookie['avatar'];
	// 			$nickname = $cookie['nickname'];
	// 			$from_user = $cookie['openid'];
	// 		}
	// 	}

	// 	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	// 	if (strpos($user_agent, 'MicroMessenger') === false) {

	// 		header("HTTP/1.1 301 Moved Permanently");
	// 		header("Location: {$this->createMobileUrl('other',array('type'=>1,'id'=>$rid))}");
	// 		exit();
	// 	}

	// 	//网页授权借用结束
	// 	if (empty($from_user)) {
	// 		$this->message(array("success" => 0, "msg" => '获取不到您的OpenID,请从新进入活动页面'), "");
	// 	}

	// 	//  $fans = pdo_fetch("select id,mobile from " . tablename('haoman_qib_fans') . " where rid = " . $rid . " and from_user=" . $from_user . "");
	// 	$num0 = pdo_fetch("select password from " . tablename('haoman_xxx_reply') . " where rid = :rid", array(':rid' => $rid));
	// 	if($num0['password']==0){
	// 		$temp = pdo_update('haoman_xxx_award', array('status' => 2,'consumetime' => time()), array('rid' => $rid, 'from_user' => $from_user, 'uniacid' => $_W['uniacid'], 'id'=>$num));
	// 		$data = array(
	// 			'success' => 1,
	// 			'msg' => '兑奖成功！',
	// 		);
	// 	}
	// 	else{
	// 		if($num0['password']==$inputval){
	// 			$temp = pdo_update('haoman_xxx_award', array('status' => 2,'consumetime' => time()), array('rid' => $rid, 'from_user' => $from_user, 'uniacid' => $_W['uniacid'], 'id'=>$num));
	// 			$data = array(
	// 				'success' => 1,
	// 				'msg' => '兑奖成功！',
	// 			);
	// 		}
	// 		else{
	// 			$data = array(
	// 				'success' => 0,
	// 				'msg' => '参数错误！',
	// 			);
	// 		}
	// 	}




	// 	echo json_encode($data);
	// }

	//积分核销
	// public function doMobileduihuan() {
	// 	global $_GPC, $_W;
	// 	$rid = intval($_GPC['rid']);
	// 	$inputval = $_GPC['inputval'];
	// 	$num = intval($_GPC['num']);



	// 	//网页授权借用开始

	// 	load()->model('account');
	// 	$_W['account'] = account_fetch($_W['acid']);
	// 	$cookieid = '__cookie_haoman_xxx_201606186_' . $rid;
	// 	$cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
	// 	if ($_W['account']['level'] != 4) {
	// 		$from_user = $cookie['openid'];
	// 		$avatar = $cookie['avatar'];
	// 		$nickname = $cookie['nickname'];
	// 	}else{
	// 		$from_user = $_W['fans']['from_user'];
	// 		$avatar = $_W['fans']['tag']['avatar'];
	// 		$nickname = $_W['fans']['nickname'];
	// 	}

	// 	$code = $_GPC['code'];
	// 	$urltype = '';
	// 	if (empty($from_user) || empty($avatar)) {
	// 		if (!is_array($cookie) || !isset($cookie['avatar']) || !isset($cookie['openid'])) {
	// 			$userinfo = $this->get_UserInfo($rid, $code, $urltype);
	// 			$nickname = $userinfo['nickname'];
	// 			$avatar = $userinfo['headimgurl'];
	// 			$from_user = $userinfo['openid'];
	// 		} else {
	// 			$avatar = $cookie['avatar'];
	// 			$nickname = $cookie['nickname'];
	// 			$from_user = $cookie['openid'];
	// 		}
	// 	}

	// 	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	// 	if (strpos($user_agent, 'MicroMessenger') === false) {

	// 		header("HTTP/1.1 301 Moved Permanently");
	// 		header("Location: {$this->createMobileUrl('other',array('type'=>1,'id'=>$rid))}");
	// 		exit();
	// 	}

	// 	//网页授权借用结束
	// 	if (empty($from_user)) {
	// 		$this->message(array("success" => 0, "msg" => '获取不到您的OpenID,请从新进入活动页面'), "");
	// 	}

	// 	//  $fans = pdo_fetch("select id,mobile from " . tablename('haoman_qib_fans') . " where rid = " . $rid . " and from_user=" . $from_user . "");
	// 	$num0 = pdo_fetch("select password from " . tablename('haoman_xxx_reply') . " where rid = :rid", array(':rid' => $rid));
	// 	if($num0['password']==0){
	// 		$temp = pdo_update('haoman_xxx_fans', array('jifen' => 0), array('rid' => $rid, 'from_user' => $from_user, 'uniacid' => $_W['uniacid'], 'id'=>$num));
	// 		$data = array(
	// 			'success' => 1,
	// 			'msg' => '兑奖成功！',
	// 		);
	// 	}
	// 	else{
	// 		if($num0['password']==$inputval){
	// 			$temp = pdo_update('haoman_xxx_fans', array('jifen' => 0), array('rid' => $rid, 'from_user' => $from_user, 'uniacid' => $_W['uniacid'], 'id'=>$num));

	// 			$data = array(
	// 				'success' => 1,
	// 				'msg' => '兑奖成功了！',
	// 			);
	// 		}
	// 		else{
	// 			$data = array(
	// 				'success' => 0,
	// 				'msg' => '参数错误！',
	// 			);
	// 		}
	// 	}




	// 	echo json_encode($data);
	// }
    //广告管理
	public function doWebAdmanage() {
		global $_GPC, $_W;

		checklogin();
		$uniacid = $_W['uniacid'];
		load()->model('reply');
		load()->func('tpl');
		$sql = "uniacid = :uniacid and `module` = :module";
		$params = array();
		$params[':uniacid'] = $_W['uniacid'];
		$params[':module'] = 'haoman_xxx';

		$list = reply_search($sql, $params);
		foreach($list as $lists){
			$rid= $lists['id'];
		}





		$addcard = pdo_fetchall("select * from " . tablename('haoman_xxx_addad') . " order by `id` desc");


//
		$now = time();
		$addcard1 = array(
			"getstarttime" => $now,
			"getendtime" => strtotime(date("Y-m-d H:i", $now + 7 * 24 * 3600)),
		);



		$addad = pdo_fetchall("select * from " . tablename('haoman_xxx_addad') . "where rid= :rid order by `id` desc",array(':rid'=>$rid));

		// $pindex = max(1, intval($_GPC['page']));
		//$psize = 20;

		//  $pager = pagination($total, $pindex, $psize);


		include $this->template('admanage');
	}
    //添加广告
	public function doWebNewad() {
		global $_GPC, $_W;
		// $rid = intval($_GPC['rid']);
		$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';

		load()->model('reply');
		load()->func('tpl');
		$sql = "uniacid = :uniacid and `module` = :module";
		$params = array();
		$params[':uniacid'] = $_W['uniacid'];
		$params[':module'] = 'haoman_xxx';

		$rowlist = reply_search($sql, $params);

		// message($rid);

		if($operation == 'updataad'){

			$id = $_GPC['listid'];

			// message($_GPC['cardnum']);
			$keywords = reply_single($_GPC['rulename']);

			$updata = array(
				'rid' => $_GPC['rulename'],
				'rulename' => $keywords['name'],
				'adlogo' => $_GPC['adlogo'],
				'adtitle' => $_GPC['adtitle'],
				'addetails' => $_GPC['addetails'],
				'adlink' => $_GPC['adlink'],
				'createtime' =>time(),
			);


			$temp =  pdo_update('haoman_xxx_addad',$updata,array('id'=>$id));

			message("修改广告成功",$this->createWebUrl('admanage'),"success");


		}elseif($operation == 'addad'){

			// message($_GPC['cardname']);

			$keywords = reply_single($_GPC['rulename']);

			$updata = array(
				'rid' => $_GPC['rulename'],
				'rulename' => $keywords['name'],
				'adlogo' => $_GPC['adlogo'],
				'adtitle' => $_GPC['adtitle'],
				'addetails' => $_GPC['addetails'],
				'adlink' => $_GPC['adlink'],
				'createtime' =>time(),
			);


			// message($keywords['name']);

			$temp = pdo_insert('haoman_xxx_addad', $updata);

			message("添加广告成功",$this->createWebUrl('admanage'),"success");

		}elseif($operation == 'up'){

			$uid = intval($_GPC['uid']);
			$list = pdo_fetch("select * from " . tablename('haoman_xxx_addad') . "  where id=:uid ", array(':uid' => $uid));

			include $this->template('updataad');

		}else{

			$now = time();
			$addcard1 = array(
				"getstarttime" => $now,
				"getendtime" => strtotime(date("Y-m-d H:i", $now + 7 * 24 * 3600)),
			);

			include $this->template('newad');

		}

	}
    //删除广告
	public function doWebDelete9() {
		global $_GPC, $_W;
		$id = intval($_GPC['id']);
		$rule = pdo_fetch("select id from " . tablename('haoman_xxx_addad') . " where id = :id ", array(':id' => $id));
		if (empty($rule)) {
			message('抱歉，参数错误！');
		}
		if (pdo_delete('haoman_xxx_addad', array('id' => $id))) {
			message('删除成功！', referer(), 'success');
		}

	}
//批量删除广告
	public function doWebDeleteAllad() {
		global $_GPC, $_W;
		foreach ($_GPC['idArr'] as $k=>$rid) {
			$rid = intval($rid);
			if ($rid == 0 ||$rid ==1)
				continue;
			$rule = pdo_fetch("select id from " . tablename('haoman_xxx_addad') . " where id = :id ", array(':id' => $rid));
			if (empty($rule)) {
				message('抱歉，要修改的规则不存在或是已经被删除！', '', 'error');
			}
			if (pdo_delete('haoman_xxx_addad', array('id' => $rid))) {

			}
		}
		message('删除成功！', referer(), 'success');
	}

   //	提现申请
	public function doMobileapplication() {
		global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$uniacid = $_W['uniacid'];
		$content = intval($_GPC['content']*100);

		//网页授权借用开始（特殊代码）

		load()->model('account');
		$_W['account'] = account_fetch($_W['acid']);

		if ($_W['account']['level'] != 4) {
			$cookieid = '__cookie_haoman_xxx_201606186_' . $rid;
			$cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
			$from_user = $cookie['openid'];
			$avatar = $cookie['avatar'];
			$nickname = $cookie['nickname'];

		}else{

			$cookieid = '__cookie_haoman_xxx_201606186_' . $rid;
			$cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
			$from_user = $_W['fans']['from_user'];
			$avatar = empty($_W['fans']['tag']['avatar'])?$cookie['avatar']:$_W['fans']['tag']['avatar'];
			$nickname = empty($_W['fans']['nickname'])?$cookie['nickname']:$_W['fans']['nickname'];

		}

		//网页授权借用结束（特殊代码）
		if (empty($from_user)) {
			$this->message(array("success" => 0, "msg" => '获取不到您的OpenID,请从新进入活动页面'), "");
		}

		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') === false) {

			header("HTTP/1.1 301 Moved Permanently");
			header("Location: {$this->createMobileUrl('other',array('type'=>1,'id'=>$rid))}");
			exit();
		}

		$reply = pdo_fetch("select * from " . tablename('haoman_xxx_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));

		$num = $reply['share_acid'];

			$num = $num < 100 ? 100 : $num;

		$num2 = $reply['tx_most'];

		$num2 = $num2 < 500 ? 500 : $num2;

		$fans = pdo_fetch("select * from " . tablename('haoman_xxx_fans') . " where rid = " . $rid . " and from_user='" . $from_user . "'");

		$award = pdo_fetchall("select * from " . tablename('haoman_xxx_award') . " where status = 1 and prizetype = 0 and rid = " . $rid . " and from_user='" . $from_user . "'");
		$nums =0;
		foreach($award as $k){
			$nums +=$k['credit'];
		}
		if($nums<$num){
			$data = array(
				'success' => 0,
				'msg' => '账户金额未达到提现标准！',
			);
			exit();
		}
		if ($fans == false) {
			$data = array(
				'success' => 0,
				'msg' => '保存数据错误！',
			);
		}
		else {
			if (intval($nums) >= intval($num2)) {
				if (intval($fans['totalnum']) > $num && intval($fans['totalnum']) == $content && intval($fans['totalnum']) == intval($nums)) {

					$insert = array(
						'uniacid' => $uniacid,
						'rid' => $rid,
						'from_user' => $from_user,
						'avatar' => $avatar,
						'nickname' => $nickname,
						'mobile' => $fans['mobile'],
						'fansID' => 0,
						'awardname' => intval($nums),
						'prizetype' => 0,
						'awardsimg' => CLIENT_IP,
						'credit' => 0,
						'prize' => 0,
						'createtime' => time(),
						'consumetime' => 0,
						'status' => 0,
					);
					$temps = pdo_update('haoman_xxx_fans', array('totalnum' => $fans['totalnum'] - $content, 'sharetime' => $fans['sharetime'] + 1), array('rid' => $rid, 'from_user' => $from_user, 'uniacid' => $_W['uniacid']));

					$tempss = pdo_update('haoman_xxx_award', array('status' => 2), array('rid' => $rid, 'from_user' => $from_user, 'uniacid' => $_W['uniacid'], 'prizetype' => 0));

					$temp = pdo_insert('haoman_xxx_cash', $insert);
					$data = array(
						'success' => 1,
						'msg' => '提现申请成功！',
					);
				} else {
					$data = array(
						'success' => 0,
						'msg' => '提现申请失败！！',
					);
				}
			} else {

			if ($reply['xf_condition'] == 0) {

				if (intval($fans['totalnum']) > 0 && intval($fans['totalnum']) == $content && intval($fans['totalnum']) == intval($nums)) {

					$insert = array(
						'uniacid' => $uniacid,
						'rid' => $rid,
						'from_user' => $from_user,
						'avatar' => $avatar,
						'nickname' => $nickname,
						'mobile' => $fans['mobile'],
						'fansID' => 0,
						'awardname' => intval($nums),
						'prizetype' => 0,
						'awardsimg' => CLIENT_IP,
						'credit' => 0,
						'prize' => 0,
						'createtime' => time(),
						'consumetime' => 0,
						'status' => 0,
					);
					$temps = pdo_update('haoman_xxx_fans', array('totalnum' => $fans['totalnum'] - $content, 'sharetime' => $fans['sharetime'] + 1), array('rid' => $rid, 'from_user' => $from_user, 'uniacid' => $_W['uniacid']));

					$tempss = pdo_update('haoman_xxx_award', array('status' => 2), array('rid' => $rid, 'from_user' => $from_user, 'uniacid' => $_W['uniacid'], 'prizetype' => 0));

					$temp = pdo_insert('haoman_xxx_cash', $insert);
					$data = array(
						'success' => 1,
						'msg' => '提现申请成功！',
					);
				} else {
					$data = array(
						'success' => 0,
						'msg' => '提现申请失败！',
					);
				}
			} elseif ($reply['xf_condition'] == 1) {

				if (intval($fans['totalnum']) > $num && intval($fans['totalnum']) == $content && intval($fans['totalnum']) == intval($nums)) {

					$insert = array(
						'uniacid' => $uniacid,
						'rid' => $rid,
						'from_user' => $from_user,
						'avatar' => $avatar,
						'nickname' => $nickname,
						'mobile' => $fans['mobile'],
						'fansID' => 0,
						'awardname' => intval($nums),
						'prizetype' => 0,
						'credit' => 0,
						'awardsimg' => CLIENT_IP,
						'prize' => 0,
						'createtime' => time(),
						'consumetime' => 0,
						'status' => 1,
					);
					$credit = intval($nums);
					$record['fee'] = $credit / 100; //红包金额；
					$record['openid'] = $from_user;
					$user['nickname'] = $nickname;
					$sendhongbao = $this->sendhb($record, $user);
					if ($sendhongbao['isok']) {
						//更新提现状态
						$temp = pdo_insert('haoman_xxx_cash', $insert);
						$temps = pdo_update('haoman_xxx_fans', array('totalnum' => $fans['totalnum'] - $content, 'sharetime' => $fans['sharetime'] + 1), array('rid' => $rid, 'from_user' => $from_user, 'uniacid' => $_W['uniacid']));
						$tempss = pdo_update('haoman_xxx_award', array('status' => 2), array('rid' => $rid, 'from_user' => $from_user, 'uniacid' => $_W['uniacid'], 'prizetype' => 0));

						if ($temp == false) {
							$data = array(
								'success' => 0,
								'msg' => '提现申请失败！3',
							);
						} else {
							$data = array(
								'success' => 1,
								'msg' => '提现申请成功！',
							);
						}

						$hbstatus = 2;

					} else {

						if(!empty($reply['gl_openid'])){
							$actions = "亲爱的管理员，有粉丝提现失败！\n原因：".$sendhongbao['error_msg'];
							$this->sendText($reply['gl_openid'],$actions);
						}

						$data = array(
							'success' => 0,
//                            'msg' => $sendhongbao['error_msg'],
							'msg' => '红包已发完，掌柜正在充值...',
						);

						$hbstatus = 21;
					}


				} else {
					$data = array(
						'success' => 0,
						'msg' => '提现申请失败！',
					);
				}
			}
		}
		}

		echo json_encode($data);
	}
   //后台提现审核
	public function doWebSetstatuss() {
		global $_GPC, $_W;
		$id = intval($_GPC['id']);
		$rid = intval($_GPC['rid']);
		$status = intval($_GPC['status']);
		$credit = $_GPC['awardname'];

		$from_user =$_GPC['from_user'];
		//$nickname =$_GPC['nickname'];

		$reply = pdo_fetch("select * from " . tablename('haoman_xxx_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
		$cash = pdo_fetch("select * from " . tablename('haoman_xxx_cash') . " where rid = :rid and id = :id and from_user = :from_user ", array(':rid' => $rid,':id'=>$id,':from_user'=>$from_user));



		if (empty($id)) {
			message('抱歉，传递的参数错误！', '', 'error');
		}
		$p = array('status' => $status);
		if ($status == 1&&$cash['awardname']==$credit) {
			$record['fee'] = $cash['awardname']/100; //红包金额；
			$record['openid'] = $from_user;
			$user['nickname'] = $cash['nickname'];
			$sendhongbao = $this->sendhb($record, $user);
			if ($sendhongbao['isok']) {
				//更新提现状态

				$temp = pdo_update('haoman_xxx_cash', $p, array('id' => $id));

				if ($temp == false) {
					message('抱歉，刚才操作数据失败！', '', 'error');
				}else{
					message('操作成功！', $this->createWebUrl('cashprize', array('rid' => $_GPC['rid'])), 'success');
				}

				$hbstatus = 2;

			} else {

				message($sendhongbao['error_msg'], '', 'error');

				$hbstatus = 21;
			}
		}
		elseif($status == 2){
			$temp = pdo_update('haoman_xxx_cash', $p, array('id' => $id));
			message('成功拒绝！', $this->createWebUrl('cashprize', array('rid' => $_GPC['rid'])), 'success');

		}
		else{
			message('非法操作', '', 'error');
		}

	}

//生成口令
	public function doWebcode(){
		global $_W  ,$_GPC;
		checklogin();
		$uniacid = $_W['uniacid'];
		$rid = $_GPC['rid'];
		load()->model('reply');
		load()->func('tpl');
		$sql = "uniacid = :uniacid and `module` = :module";
		$params = array();
		$params[':uniacid'] = $_W['uniacid'];
		$params[':module'] = 'haoman_xxx';

		$rowlist = reply_search($sql, $params);


		$now = time();
		$addcard1 = array(
			"starttime" => $now,
			"endtime" => strtotime(date("Y-m-d H:i", $now + 7 * 24 * 3600)),
		);

		if (checksubmit()) {
			$count = $_GPC['num'];
			$rid = $_GPC['rulename'];
			$keywords = reply_single($_GPC['rulename']);
			$rulename = $keywords['name'];

			if(empty($count)||$count > 20000){
				message('参数错误', $this->createWebUrl("code"), 'error');
			}else{

				$picid = pdo_fetch("SELECT max(pici) FROM ".tablename('haoman_xxx_pw')." WHERE rid = :rid and uniacid = :uniacid", array(':uniacid' => $_W['uniacid'],':rid'=>$rid));
				$picid = $picid['max(pici)'];

				$pici = !empty($picid) ? ($picid+1) : 1;
				// print_r($picid);exit();

				$data = array('rid'=>$rid,'uniacid' => $_W['uniacid'], 'createtime' => time('Ymd'), 'codenum' => $count,'is_qrcode'=>0,'rulename'=>$rulename, 'pici' => $pici,'status'=>$_GPC['status']);
				pdo_insert('haoman_xxx_pici', $data);
				for($i = 0; $i < $count; $i++){
					$randcode = $this->genkeyword(8);
					$pwid = 'pwid'.date('Ymd') . sprintf('%d', time()).$i;


					$updata = array(
						'rid' => $rid,
						'pici' => $pici,
						'rulename' => $rulename,
						'uniacid' => $_W['uniacid'],
						'pwid' => $pwid,
						'title' => $randcode,
						'starttime' => strtotime($_GPC['datelimit']['start']),
						'endtime' => strtotime($_GPC['datelimit']['end']),
						'num' => 1,
						'iscqr' => 1,
						'status' => $_GPC['status'],
						'createtime' =>time(),
					);

					$temp = pdo_insert('haoman_xxx_pw', $updata);
				}


				message('口令生成成功', $this->createWebUrl('code'), 'success');
			}
		}



		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$sql = 'select * from ' . tablename('haoman_xxx_pici') . 'where  uniacid = :uniacid LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
		$prarm = array(':uniacid' => $_W['uniacid']);
		$list = pdo_fetchall($sql, $prarm);


		$count = pdo_fetchcolumn('select count(*) from ' . tablename('haoman_xxx_pici') . 'where uniacid = :uniacid', $prarm);
		$pager = pagination($count, $pindex, $psize);

		include $this->template('code');
	}


	function isExist($randcode){
		global $_W;
		$sql = 'select * from ' . tablename('haoman_xxx_code') . 'where uniacid = :uniacid and code = :code';
		$prarm = array(':uniacid' => $_W['uniacid'], ':code' => $randcode);
		if(pdo_fetch($sql,$prarm)){
			return 1;
		}else{
			return 0;
		}

	}

	function genkeyword($length)
	{
		$chars = array('0','1', '2', '3', '4', '5', '6', '7', '8', '9');
		$password = rand(1, 9);
		for ($i = 0; $i < $length - 1; $i++) {
			$keys = array_rand($chars, 1);
			$password .= $chars[$keys];
		}
		return $password;
	}

	//查看口令
	public function doWebcodeshow(){
		global $_W  ,$_GPC;
		checklogin();
		$pici = $_GPC['pici'];

		$t = time();
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$sql = 'select * from ' . tablename('haoman_xxx_pw') . 'where uniacid = :uniacid and pici = :pici LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
		$prarm = array(':uniacid' => $_W['uniacid'] ,':pici' => $pici);
		$list = pdo_fetchall($sql, $prarm);
		$count = pdo_fetchcolumn('select count(*) from ' . tablename('haoman_xxx_pw') . 'where uniacid = :uniacid and pici = :pici', $prarm);
		$pager = pagination($count, $pindex, $psize);

		load()->func('tpl');
		include $this->template('codeshow');
	}
	//口令导入
	public function doWebImport()
	{
		global $_W, $_GPC;
		load()->func('logging');
		$pici = $_GPC['pici'];

		if (!empty($_GPC['foo'])) {
			try {
				include_once "reader.php";
				$tmp = $_FILES['file']['tmp_name'];
				if (empty($tmp)) {
					echo '请选择要导入的Excel文件！';
					die;
				}
				$file_name = IA_ROOT . "/addons/haoman_xxx/xls/code.xls";
				$uniacid = $_W['uniacid'];

				if (copy($tmp, $file_name)) {
					$xls = new Spreadsheet_Excel_Reader();
					$xls->setOutputEncoding('utf-8');
					$xls->read($file_name);
					$data_values = "";
					$count = $xls->sheets[0]['numRows'];
					for ($i = 1; $i <= $count; $i++) {
						$code = $xls->sheets[0]['cells'][$i][1];

						$data = array(
							'uniacid' => $_W['uniacid'],
							'title' => $code,
							'pici' => $pici,
							'time' => TIMESTAMP,
						);
						$res = pdo_insert('haoman_xxx_pw',$data);
					}
					if ($res) {
						pdo_query("update " . tablename("haoman_xxx_pici") . " set codenum = codenum + {$count} where pici = :pici and uniacid =:uniacid", array(":pici" => $pici, ":uniacid" => $uniacid));
						$url = $this->createWebUrl('code');
						echo '<script>alert(\'导入成功！\')</script>';
						echo "<script>window.location.href= '{$url}'</script>";
					} else {
						$url = $this->createWebUrl('Import', array());
						echo '<script>alert(\'导入失败！\')</script>';
						echo "<script>window.location.href= '{$url}'</script>";
					}
				} else {
					echo '复制失败！';
					die;
				}
			} catch (Exception $e) {
				logging_run($e, '', 'upload_tiku');
			}
		} else {
			include $this->template('import');
		}
	}


	//失效口令删除
	public function doWebMiss() {
		global $_GPC, $_W;
		checklogin();
		$res = pdo_fetch('select * from ' . tablename('haoman_xxx_pw') . ' where uniacid = :uniacid and status = 2', array(':uniacid' => $_W['uniacid']));
		if($res){
			pdo_delete('haoman_xxx_pw',array('uniacid' => $_W['uniacid'] ,'status' =>'2'));
			message('删除成功',$this->createWebUrl("code"),'success');
		}else{
			message('暂无已失效口令',$this->createWebUrl("code"),'error');
		}
	}

	//每批次卡密删除
	public function doWebCodedie() {
		global $_GPC, $_W;
		checklogin();
		$pici = $_GPC['pici'];
		$res = pdo_fetch('select * from ' . tablename('haoman_xxx_pici') . ' where uniacid = :uniacid and pici = :pici', array(':uniacid' => $_W['uniacid'] ,':pici' => $pici));
		if($res){
			pdo_delete('haoman_xxx_pici', array('uniacid' => $_W['uniacid'],'pici' => $pici));
			pdo_delete('haoman_xxx_pw', array('uniacid' => $_W['uniacid'],'pici' => $pici));

			message('删除成功',$this->createWebUrl("code"),'success');
		}else{
			message('暂无口令',$this->createWebUrl("code"),'error');
		}
	}
//单独口令删除
	public function doWebDeletepw() {
		global $_GPC, $_W;
		$id = intval($_GPC['id']);
		$pici = intval($_GPC['pici']);
		$rule = pdo_fetch("select * from " . tablename('haoman_xxx_pw') . " where id = :id ", array(':id' => $id));
		$codenum = pdo_fetch("select * from " . tablename('haoman_xxx_pici') . " where pici = :pici ", array(':pici' => $pici));
		if (empty($rule)) {
			message('抱歉，参数错误！');
		}
		pdo_delete('haoman_xxx_pw', array('id' => $id));
		if($rule['pici']!=0){
			pdo_update('haoman_xxx_pici', array('codenum' => $codenum['codenum'] - 1), array('pici' => $codenum['pici']));

		}
		message('口令删除成功！', referer(), 'success');
	}

//    抽奖码下载
	public function  doWebUDownload2()
	{
		global $_GPC,$_W;
		checklogin();
		$list = pdo_fetchall('select * from ' . tablename('haoman_xxx_pw') . ' where uniacid = :uniacid and status = 1 ORDER BY id ', array(':uniacid' => $_W['uniacid']));
		$tableheader = array('ID','批次','博饼码','适用规则','开始时间','结束时间','剩余数量','创建时间');
		$html = "\xEF\xBB\xBF";
		foreach ($tableheader as $value) {
			$html .= $value . "\t ,";
		}
		$html .= "\n";
		foreach ($list as $value) {
			$html .= $value['id'] . "\t ,";
			$html .= $value['pici'] . "\t ,";
			$html .=  $value['title'] . "\t ,";
			$html .=  $value['rulename'] . "\t ,";
			$html .=  date('Y-m-d H:i:s', $value['starttime']) . "\t ,";
			$html .=  date('Y-m-d H:i:s', $value['endtime']) . "\t ,";
			$html .=  $value['num'] . "\t ,";
			$html .= date('Y-m-d H:i:s', $value['createtime']) . "\n";

		}


		header("Content-type:text/csv");

		header("Content-Disposition:attachment;filename=全部博饼码.csv");

		$html = mb_convert_encoding($html, 'gb2312', 'UTF-8');

		echo $html;
		exit();
	}


	//抽奖码兑换
	public function doMobilecheckpw() {
		global $_GPC, $_W;
		$rid = intval($_GPC['rid']);

		$from_user = $_W['fans']['from_user'];

		load()->model('account');
        $_W['account'] = account_fetch($_W['acid']);
        if ($_W['account']['level'] != 4) {
            $from_user = authcode(base64_decode($_GPC['from_user']), 'DECODE');;
        }

		if (empty($from_user)) {
			$this->message(array("success" => 2, "msg" => '获取不到您的OpenID,请从新进入活动页面'), "");
		}
		$reply = pdo_fetch("select * from " . tablename('haoman_xxx_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
		$fans = pdo_fetch("select * from " . tablename('haoman_xxx_fans') . " where rid = '" . $rid . "' and from_user='" . $from_user . "'");

		if($reply['is_openbbm']==0){
			message('还未开启抽奖码兑换次数活动','','error');
		}

		$pw = pdo_fetch("select * from " . tablename('haoman_xxx_pw') . " where rid = " . $rid . " and title='" . $_GPC['title'] . "'");

		if ($pw == false) {
			$data = array(
				'success' => 0,
				'msg' => '您输入的抽奖码不存在！',
			);
		}
		elseif($pw['status']==2){
			$data = array(
				'success' => 0,
				'msg' => '您输入的抽奖码还未启用！',
			);
		}
		elseif($pw['starttime'] >= time()){

			$data = array(
				'success' => 0,
				'msg' => '该抽奖码使用时间还没到哦！',
			);

		}elseif($pw['endtime'] <= time()){

			$data = array(
				'success' => 0,
				'msg' => '该抽奖码超过使用时间了哦！',
			);

		}elseif($pw['num']==0){
			$data = array(
				'success' => 0,
				'msg' => '该抽奖码已被使用过了哦！',
			);
		}
		elseif($fans['bbm_use_times']>=$reply['bbm_use_times']&&$reply['bbm_use_times']!=0){
			$data = array(
				'success' => 0,
				'msg' => '你已超过抽奖码使用次数了！',
			);
		}
		else {

			$insert = array(
				'rid' => $rid,
				'uniacid' => $_W['uniacid'],
				'from_user' => $from_user,
				'pwid' => $pw['pwid'],
				'avatar' => $avatar,
				'nickname' => $nickname,
				'visitorsip' => CLIENT_IP,
				'visitorstime' => TIMESTAMP,
			);

			pdo_insert('haoman_xxx_password', $insert);

			pdo_update('haoman_xxx_fans', array('bbm_use_times'=>$fans['bbm_use_times']+1), array('id' => $fans['id']));

			$temp = pdo_update('haoman_xxx_pw', array('num' => $pw['num']-1), array('id' => $pw['id']));

			if ($temp === false) {

				$data = array(
					'success' => 0,
					'msg' => '兑换失败了',
				);

			} else {

				$data = array(
					'success' => 1,
					'msg' => '兑换成功，赶紧去抽奖吧！',
				);
			}
		}
		echo json_encode($data);
	}

	//检测用户浏览器
	public function checkBowser(){
		$useragent = addslashes($_SERVER['HTTP_USER_AGENT']);
		if(strpos($useragent, 'MicroMessenger') === false && strpos($useragent, 'Windows Phone') === false ){

		}
	}



//删除测试数据
	public function doWebDelete_openid() {
		global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$del_openid = $_GPC['del_openid'];

		$reply = pdo_fetch("select * from " . tablename('haoman_xxx_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
		$fans = pdo_fetch("select * from " . tablename('haoman_xxx_fans') . " where from_user=:from_user and rid=:rid", array(':from_user' => $del_openid,':rid'=>$rid));
		$datas = pdo_fetchall("select * from " . tablename('haoman_xxx_data') . " where fromuser=:fromuser and rid=:rid", array(':fromuser' => $del_openid,':rid'=>$rid));
		$award = pdo_fetchall("select * from " . tablename('haoman_xxx_award') . " where from_user=:from_user and rid=:rid", array(':from_user' => $del_openid,':rid'=>$rid));
		$password = pdo_fetchall("select * from " . tablename('haoman_xxx_password') . " where from_user=:from_user and rid=:rid", array(':from_user' => $del_openid,':rid'=>$rid));

		if (empty($fans)) {
			$data = array(
				'success' => 0,
				'msg' => '抱歉，要删除的帐号不存在或是已经被删除！',
			);
		}
		else{
			pdo_delete('haoman_xxx_fans', array('from_user' => $del_openid,'rid'=>$rid));
			pdo_update('haoman_xxx_reply', array('fansnum' => $reply['fansnum'] - 1), array('id' => $reply['id']));

			if(!empty($datas)){
				pdo_delete('haoman_xxx_data', array('fromuser' => $del_openid,'rid'=>$rid));
			}
			if(!empty($award)){
				pdo_delete('haoman_xxx_award', array('from_user' => $del_openid,'rid'=>$rid));
			}
			if(!empty($password)){
				pdo_delete('haoman_xxx_password', array('from_user' => $del_openid,'rid'=>$rid));
			}
			$data = array(
				'success' => 1,
				'msg' => '删除成功',
			);

		}
		echo json_encode($data);
	}

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
	//更改活动状态
	public function doWebSetshow() {
		global $_GPC, $_W;
		$rid = intval($_GPC['rid']);
		$isshow = intval($_GPC['isshow']);

		if (empty($rid)) {
			message('抱歉，传递的参数错误！', '', 'error');
		}
		$temp = pdo_update('haoman_xxx_reply', array('isshow' => $isshow), array('rid' => $rid));
		message('状态设置成功！', referer(), 'success');
	}

	private function httpGet($url) {
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
  //随机字符串
  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }


	//获取api_ticket
   public function getCardTicket($rid,$openid){
		global $_W,$_GPC;
	    $uniacid = $_W['uniacid'];

	   $card_idarr = pdo_fetchall("select id,couponid,awardspro from " . tablename('haoman_xxx_prize') . " where  rid = " . $rid ." and awardspro > 0 and awardstotal-prizedraw>0 and couponid <> '' ORDER BY Rand() ASC"  );

	   $card_rowid=-1;
	   if($card_idarr) {
		   $card_temparr = array();
		   foreach ($card_idarr as $index => $row) {
			   $item = array(
				   'id' => $row['id'],
				   'couponid' => $row['couponid'],
				   'v' => $row['awardspro'],
			   );
			   $card_temparr[] = $item;

		   }

		   foreach ($card_temparr as $key => $val) {
			   $randarr[$val['id']] = $val['v'];
		   }

		   $card_rowid = $this->Get_rand($randarr); //根据概率获取奖项id
		   $card_new = pdo_fetch("select * from " . tablename('haoman_xxx_prize') . " where  id=" . $card_rowid . " and rid = " . $rid);
		   $card_id = $card_new['couponid'];

	   }else{
		   return false;
	   }

		//获取access_token
		$data = pdo_fetch( " SELECT * FROM ".tablename('haoman_xxx_cardticket')." WHERE weid='".$_W['uniacid']."' " );
		$appid = $_W['account']['key'];
		$appSecret = $_W['account']['secret'];
		load()->func('communication');
		//检测ticket是否过期
		if ($data['createtime'] < time()) {
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appSecret."";
			$res = json_decode($this->httpGet($url));
			$tokens = $res->access_token;
			if(empty($tokens))
			{
				return;
			}

			$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$tokens."&type=wx_card";
			$res = json_decode($this->httpGet($url));
			$now = TIMESTAMP;
			$now = intval($now) + 7200;
			$ticket = $res->ticket;
			$insert = array(
				'weid' => $_W['uniacid'],
				'createtime' => $now,
				'ticket' => $ticket,
			);
			if(empty($data)){
				pdo_insert('haoman_xxx_cardticket',$insert);
			}else{
				pdo_update('haoman_xxx_cardticket',$insert,array('id'=>$data['id']));
			}

		}else{
			$ticket = $data['ticket'];
		}

		// 注意 URL 一定要动态获取，不能 hardcode.
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		//获得ticket后将参数拼成字符串进行sha1加密
		$now = time();
		$timestamp = $now;



		//随机字符串
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < 16; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		//随机字符串



		$nonceStr = $str;
		$card_id = $card_id;
		$openid = $openid;
		$string = "card_id=$card_id&jsapi_ticket=$ticket&noncestr=$nonceStr$openid=$openid&timestamp=$timestamp";

		$arr = array($card_id,$ticket,$nonceStr,$openid,$timestamp);//组装参数
		asort($arr, SORT_STRING);
		$sortString = "";
		foreach($arr as $temp){
			$sortString = $sortString.$temp;
		}
		$signature = sha1($sortString);
		$cardArry = array(
			'code' =>"",
			'openid' => $openid,
			'timestamp' => $now,
			'signature' => $signature,
			'cardId' => $card_id,
			'ticket' => $ticket,
			'nonceStr' => $nonceStr,
			'card_rowid' => $card_rowid,
		);
		return $cardArry;


	}


	public function get_jieyong() {
		global $_W, $_GPC;
		$path = "/addons/haoman_xxx";
		$filename = IA_ROOT . $path . "/data/sysset_" . $_W['uniacid'] . ".txt";
		if (is_file($filename)) {
			$content = file_get_contents($filename);
			if (empty($content)) {
				return false;
			}
			return json_decode(base64_decode($content), true);
		}
		return pdo_fetch("SELECT * FROM " . tablename('haoman_xxx_jiequan') . " WHERE uniacid = :uniacid limit 1", array(':uniacid' => $_W['uniacid']));
	}


	public function doWebjieyong() {
		global $_W, $_GPC;
		$set = $this->get_jieyong();
		if (checksubmit('submit')) {
			$appid = trim($_GPC['appid']);
			$appsecret = trim($_GPC['appsecret']);

			$data = array(
				'uniacid' => $_W['uniacid'],
				'appid' => $appid,
				'appsecret' => $appsecret,
				'appid_share' => $appid,
				'appsecret_share' => $appsecret,
			);
			if (!empty($set)) {
				pdo_update('haoman_xxx_jiequan', $data, array('id' => $set['id']));
			} else {
				pdo_insert('haoman_xxx_jiequan', $data);
			}
			$this->write_cache("sysset_" . $_W['uniacid'], $data);
			message('更新借用设置成功！', 'refresh');
		}

		include $this->template('jiequan');
	}


	public function get_sysset() {   //读取借用数据appid和appsecret
		global $_W;
		return pdo_fetch("SELECT * FROM " . tablename('haoman_xxx_jiequan') . " WHERE uniacid = :uniacid limit 1", array(':uniacid' =>$_W['uniacid']));
	}

	private function get_code($rid,$appid,$urltype) {  //第一步先获取Code
		global $_W;
		if(empty($urltype)){  //这边是回调地址，获取Code成功后跳转的页面，默认是到首页，但是在助力页面也需要用到，所以需要传入$_GPC['from_user']，这样才不会出现回调后，分享人信息丢失

			$url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=haoman_xxx&do=index&id={$rid}";

		}else{

			$url =  $_W['siteroot'] . 'app/' . $this->createMobileUrl('share', array('rid' => $rid, 'from_user' => $urltype));
		}
		$oauth2_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $appid . "&redirect_uri=" . urlencode($url) . "&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
		header("location: $oauth2_url");
		exit();
	}

	public function get_openid($rid, $code, $urltype) { //第二步或是OpenID和AccessToken，注意借用获取到的OpenID是认证服务号的OpenID
		global $_GPC, $_W;
		load()->func('communication');
		load()->model('account');
		$_W['account'] = account_fetch($_W['acid']);
		$appid = $_W['account']['key'];
		$appsecret = $_W['account']['secret'];

		if ($_W['account']['level'] != 4) {
			//不是认证服务号
			$set = $this->get_sysset();
			if (!empty($set['appid']) && !empty($set['appsecret'])) {
				$appid = $set['appid'];
				$appsecret = $set['appsecret'];
			}  else{
				//如果没有借用，判断是否认证服务号
				message('请使用认证服务号进行活动，或借用其他认证服务号权限!');
			}
		}
		if (empty($appid) || empty($appsecret)) {
			message('请到管理后台设置完整的 AppID 和AppSecret !');
		}

		if (!isset($code)) {
			$this->get_code($rid, $appid,$urltype);
		}
		$oauth2_code = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $appid . "&secret=" . $appsecret . "&code=" . $code . "&grant_type=authorization_code";
		$content = ihttp_get($oauth2_code);
		$token = @json_decode($content['content'], true);
		if (empty($token) || !is_array($token) || empty($token['access_token']) || empty($token['openid'])) {
			message('未获取到 openid , 请刷新重试!','error');
		}
		return $token;
	}


	public function get_UserInfo($rid, $code, $urltype){ //第三步获取用户的昵称、头像、性别等信息，可以通过print_r($userInfo)来查看里面所有的字段
		global $_GPC, $_W;
		load()->func('communication');
		$token = $this->get_openid($rid, $code, $urltype);
		$accessToken = $token['access_token'];
		$openid = $token['openid'];
		$tokenUrl = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $accessToken . "&openid=" . $openid . "&lang=zh_CN";
		$content = ihttp_get($tokenUrl);
		$userInfo = @json_decode($content['content'], true);
		$cookieid = '__cookie_haoman_xxx_201606186_' . $rid;
		$cookie = array("nickname" => $userInfo['nickname'],'avatar'=>$userInfo['headimgurl'],'openid'=>$userInfo['openid']);
		setcookie($cookieid, base64_encode(json_encode($cookie)), time() + 3600 * 24 * 365);
		return $userInfo;
	}


	public function doWebHb(){
		global $_W,$_GPC;
		load()->func('tpl');
		load()->model('account');
		$sql = "SELECT * FROM ".tablename('haoman_xxx_hb')." WHERE uniacid = :uniacid";
		$params = array(':uniacid'=>$_W['uniacid']);
		$settings = pdo_fetch($sql,$params);

		// $settings = unserialize($settings['set']);
		if($_W['ispost']) {
			//字段验证, 并获得正确的数据$dat
			load()->func('file');
			mkdirs(ROOT_PATH . '/cert');
			$r = true;
			if (!empty($_GPC['cert'])) {
				$ret = file_put_contents(ROOT_PATH . '/cert/apiclient_cert.pem.' . $_W['uniacid'], trim($_GPC['cert']));
				$r = $r && $ret;
			}
			if (!empty($_GPC['key'])) {
				$ret = file_put_contents(ROOT_PATH . '/cert/apiclient_key.pem.' . $_W['uniacid'], trim($_GPC['key']));
				$r = $r && $ret;
			}
			if (!empty($_GPC['ca'])) {
				$ret = file_put_contents(ROOT_PATH . '/cert/rootca.pem.' . $_W['uniacid'], trim($_GPC['ca']));
				$r = $r && $ret;
			}
			if (!$r) {
				message('证书保存失败, 请保证 /addons/haoman_xxx/cert/ 目录可写');
			}

			$data = array();
			// $data['set'] = trim($_GPC['password']);;
			$data['password'] = trim($_GPC['password']);;
			$data['uniacid'] = $_W['uniacid'];
			$data['appid'] = trim($_GPC['appid']);
			$data['secret'] = trim($_GPC['secret']);
			$data['mchid'] = intval($_GPC['mchid']);
			$data['ip'] = trim($_GPC['ip']);
			$data['sname'] = trim($_GPC['sname']);
			$data['wishing'] = trim($_GPC['wishing']);
			$data['actname'] = trim($_GPC['actname']);
			$data['logo'] = trim($_GPC['logo']);
			$data['createtime'] = time();

			if(empty($settings)){
				pdo_insert('haoman_xxx_hb',$data);
			}else{
				pdo_update('haoman_xxx_hb',$data,array('uniacid'=>$_W['uniacid']));
			}

			message('提交成功',referer(),success);
		}

		if (empty($settings['ip'])) {
			$settings['ip'] = $_SERVER['SERVER_ADDR'];
		}
		include $this->template('hsetting');
	}

	public function substr_cut($str_cut,$length)
	{
		if (strlen($str_cut) > $length)
		{
			for($i=0; $i < $length; $i++)
				if (ord($str_cut[$i]) > 128)    $i++;
			$str_cut = substr($str_cut,0,$i)."..";
		}
		return $str_cut;
	}

	protected function sendhb($record, $user){  //红包发送代码
		global $_W;
		$uniacid = $_W['uniacid'];
		$sql = "SELECT * FROM ".tablename('haoman_xxx_hb')." WHERE uniacid = :uniacid";
		$params = array(':uniacid'=>$_W['uniacid']);
		$api = pdo_fetch($sql,$params);
		// $api = unserialize($api['set']);

		if (empty($api)) {
			return error(-2, '红包信息没有填！');
		}

		if(empty($api['sname'])){
			$send_name = $this->substr_cut($_W['account']['name'],30);
		}else{
			$send_name = $api['sname'];
		}

		$actname = empty($api['actname']) ? '参与疯狂抢红包活动' : $api['actname'];

		if(empty($api['wishing'])){
			$wishing = '恭喜您,抽中了一个' . $record['fee'] . '元红包!';
		}else{
			$wishing = $api['wishing'] . $record['fee'] . '元红包!';
		}


		$fee                   = floatval($record['fee'])*100;//红包金额，单位为分;
		$url                   = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
		$pars                  = array();
		$pars['nonce_str']     = random(32);
		$pars['mch_billno']    = $api['mchid'] . date('Ymd') . sprintf('%d', time());
		$pars['mch_id']        = $api['mchid'];
		$pars['wxappid']       = $api['appid'];
		$pars['nick_name']     = $_W['account']['name'];
		$pars['send_name']     = $send_name;
		$pars['re_openid']     = $record['openid'];
		$pars['total_amount']  = $fee;
		$pars['min_value']     = $pars['total_amount'];
		$pars['max_value']     = $pars['total_amount'];
		$pars['total_num']     = 1;
		$pars['wishing']       = $wishing;
		$pars['client_ip']     = $api['ip'];
		$pars['act_name']      = $actname;
		$pars['remark']        = '恭喜' . $user['nickname'] . '您的' . $record['fee'] . '元红包已经发放，请注意查收';
		$pars['logo_imgurl']   = tomedia($api['logo']);
		ksort($pars, SORT_STRING);
		$string1 = '';
		foreach ($pars as $k => $v) {
			$string1 .= "{$k}={$v}&";
		}
		$string1 .= "key={$api['password']}";
		$pars['sign']              = strtoupper(md5($string1));
		$xml                       = array2xml($pars);
		$extras                    = array();
		$extras['CURLOPT_CAINFO']  = ROOT_PATH . '/cert/rootca.pem.' . $uniacid;
		$extras['CURLOPT_SSLCERT'] = ROOT_PATH . '/cert/apiclient_cert.pem.' . $uniacid;
		$extras['CURLOPT_SSLKEY']  = ROOT_PATH . '/cert/apiclient_key.pem.' . $uniacid;
		load()->func('communication');

		// $this->message(array("success" => 2, "msg" => $api['ip']), "");

		$procResult = null;
		$resp       = ihttp_request($url, $xml, $extras);
		if (is_error($resp)) {
			$procResult = $resp;

		} else {

			$xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
			$dom = new DOMDocument();
			if ($dom->loadXML($xml)) {
				$xpath = new DOMXPath($dom);
				$code  = $xpath->evaluate('string(//xml/return_code)');
				$return_msg  = $xpath->evaluate('string(//xml/return_msg)');
				$ret   = $xpath->evaluate('string(//xml/result_code)');

				if (strtolower($code) == 'success' && strtolower($ret) == 'success') {
					$procResult = true;

				} else {
					$error      = $xpath->evaluate('string(//xml/err_code_des)');
					$procResult = error(-2, $error);
				}
			} else {
				$procResult = error(-1, 'error response');
			}
		}


		$packpage['error_msg']=$return_msg;
		// $packpage['error_msg']=$error;
		if (is_error($procResult)) {
			$packpage['isok']=false;
			return $packpage;
		} else {
			$packpage['isok']=true;
			return $packpage;
		}
	}
}
