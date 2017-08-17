<?php
defined('IN_IA') or exit('Access Denied');
define('ROOT_PATH', str_replace('site.php', '', str_replace('\\', '/', __FILE__)));
require_once ROOT_PATH."getip/IP.class.php";
require_once "jssdk.php";
class haoman_sceneModuleSite extends WeModuleSite {



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

		$reply = pdo_fetch("select * from " . tablename('haoman_scene_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));

		$rule_keyword = pdo_fetch("select * from " . tablename('rule_keyword') . " where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
        $key_word = $rule_keyword['content'];
		$send_name = $this->substr_cut($_W['account']['name'],30);
		include $this->template('other');
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
		$params[':module'] = 'haoman_scene';

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
				$scene = pdo_fetch("select fansnum, viewnum,starttime,endtime,isshow from " . tablename('haoman_scene_reply') . " where rid = :rid ", array(':rid' => $item['id']));
				$item['fansnum'] = $scene['fansnum'];
				$item['viewnum'] = $scene['viewnum'];
				$item['starttime'] = date('Y-m-d H:i', $scene['starttime']);
				$endtime = $scene['endtime'];
				$item['endtime'] = date('Y-m-d H:i', $endtime);
				$nowtime = time();
				if ($scene['starttime'] > $nowtime) {
					$item['status'] = '<span class="label label-warning">未开始</span>';
					$item['show'] = 1;
				} elseif ($endtime < $nowtime) {
					$item['status'] = '<span class="label label-default ">已结束</span>';
					$item['show'] = 0;
				} else {
					if ($scene['isshow'] == 1) {
						$item['status'] = '<span class="label label-success">已开始</span>';
						$item['show'] = 2;
					} else {
						$item['status'] = '<span class="label label-default ">已暂停</span>';
						$item['show'] = 1;
					}
				}
				$item['isshow'] = $scene['isshow'];
			}
		}
		include $this->template('manage');
	}


	public function doWebBaomin() {
		global $_GPC, $_W;
		$rid = $_GPC['rid'];

		$params = array(':rid' => $rid, ':uniacid' => $_W['uniacid']);
		if (!empty($_GPC['nickname'])) {
			$where.=' and realname=:nickname';
			$params[':nickname'] = $_GPC['nickname'];
		}
		if (!empty($_GPC['mobile'])) {
			$where.=' and mobile=:mobile';
			$params[':mobile'] = $_GPC['mobile'];
		}

		$total = pdo_fetchcolumn("select count(id) from " . tablename('haoman_scene_baoming') . "  where rid = :rid and uniacid=:uniacid " . $where . "", $params);
		$pindex = max(1, intval($_GPC['page']));
		$psize = 30;
		$pager = pagination($total, $pindex, $psize);
		$start = ($pindex - 1) * $psize;
		$limit .= " LIMIT {$start},{$psize}";
		$list = pdo_fetchall("select * from " . tablename('haoman_scene_baoming') . " where rid = :rid and uniacid=:uniacid " . $where . " order by id desc " . $limit, $params);
		//中奖情况
		// foreach ($list as &$lists) {
		// 	$lists['awardinfo'] = pdo_fetchcolumn("select count(id) from " . tablename('haoman_scene_award') . "  where rid = :rid and from_user=:from_user", array(':rid' => $rid, ':from_user' => $lists['from_user']));
		// 	$lists['share_num'] = pdo_fetchcolumn("select count(id) from " . tablename('haoman_scene_data') . "  where rid = :rid and fromuser=:fromuser", array(':rid' => $rid, ':fromuser' => $lists['from_user']));
		// }
		//中奖情况
		//一些参数的显示
		$num1 = pdo_fetchcolumn("select count(id) from " . tablename('haoman_scene_baoming') . "  where rid = :rid and uniacid=:uniacid", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		// $num2 = pdo_fetchcolumn("select count(id) from " . tablename('haoman_scene_fans') . "  where rid = :rid and uniacid=:uniacid and zhongjiang>0", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		// $num3 = pdo_fetchcolumn("select count(id) from " . tablename('haoman_scene_fans') . "  where rid = :rid and uniacid=:uniacid and zhongjiang=0", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		// //    $num4 = pdo_fetchcolumn("select count(id) from " . tablename('haoman_scene_fans') . "  where rid = :rid and uniacid=:uniacid and zhongjiang=2", array(':rid' => $rid, ':uniacid' => $_W['uniacid']));
		//一些参数的显示
		include $this->template('baomin');
	}


   //导出粉丝数据
	public function  doWebDownload()
	{
		global $_GPC,$_W;
		$rid = intval($_GPC['rid']);


		checklogin();
		$list = pdo_fetchall('select * from ' . tablename('haoman_scene_fans') . ' where uniacid = :uniacid and rid = :rid ORDER BY id ', array(':uniacid' => $_W['uniacid'],':rid'=>$rid));

		$tableheader = array('ID','微信名称','OPENID','姓名','手机号','地址','时间');
		$html = "\xEF\xBB\xBF";


		foreach ($tableheader as $value) {
			$html .= $value . "\t ,";
		}
		$html .= "\n";
		foreach ($list as $value) {
			$html .= $value['id'] . "\t ,";
			$html .= $value['nickname'] . "\t ,";
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
		$list = pdo_fetchall('select * from ' . tablename('haoman_scene_award') . ' where uniacid = :uniacid and rid = :rid ORDER BY id ', array(':uniacid' => $_W['uniacid'],':rid'=>$rid));
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
			$lists['realname'] = pdo_fetchcolumn("select realname from " . tablename('haoman_scene_fans') . " where from_user = :from_user", array(':from_user' => $lists['from_user']));
			$lists['address'] = pdo_fetchcolumn("select address from " . tablename('haoman_scene_fans') . " where from_user = :from_user", array(':from_user' => $lists['from_user']));
		}
		foreach ($tableheader as $value) {
			$html .= $value . "\t ,";
		}
		$html .= "\n";
		foreach ($list as $value) {
			$html .= $value['id'] . "\t ,";
			$html .= $value['nickname'] . "\t ,";
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
		$list = pdo_fetchall('select * from ' . tablename('haoman_scene_cash') . ' where uniacid = :uniacid and rid = :rid ORDER BY id ', array(':uniacid' => $_W['uniacid'],':rid'=>$rid));
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
			$lists['realname'] = pdo_fetchcolumn("select realname from " . tablename('haoman_scene_fans') . " where from_user = :from_user", array(':from_user' => $lists['from_user']));
		}
		foreach ($tableheader as $value) {
			$html .= $value . "\t ,";
		}
		$html .= "\n";
		foreach ($list as $value) {
			$html .= $value['id'] . "\t ,";
			$html .= $value['nickname'] . "\t ,";
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


			$data = pdo_fetch("select * from " . tablename('haoman_scene_fans') . ' where id = :id and uniacid = :uniacid', array(':uniacid' => $_W['uniacid'], ':id' => $uid));
			$hbtotal = (($data['hb_total']+$data['share_total']+$data['pw_total']+$data['scan_total'])-$data['totalnum'])/100;
			$hbtotal = $hbtotal < 0 ? 0 : $hbtotal;

			$list = pdo_fetchall("select * from " . tablename('haoman_scene_award') . "  where rid = :rid and uniacid=:uniacid and from_user=:from_user order by id desc limit 100", array(':uniacid' => $_W['uniacid'], ':rid' => $rid, ':from_user' => $data['from_user']));
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


			$data = pdo_fetch("select * from " . tablename('haoman_scene_fans') . ' where from_user = :from_user and uniacid = :uniacid', array(':uniacid' => $_W['uniacid'], ':from_user' => $from_user));

			$list = pdo_fetchall("select * from " . tablename('haoman_scene_award') . "  where titleid >5 and rid = :rid and uniacid=:uniacid and from_user=:from_user order by id desc ", array(':uniacid' => $_W['uniacid'], ':rid' => $rid, ':from_user' => $data['from_user']));
			include $this->template('axq2');
			exit();
		}
	}



	//修改资料
	public function doMobileinformation(){
		global $_GPC,$_W;
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
        if ($_W['account']['level'] != 4 && $_W['account']['level'] != 3) {
            $from_user = authcode(base64_decode($_GPC['from_user']), 'DECODE');;
        }


		$fans = pdo_fetch("select * from " . tablename('haoman_scene_fans') . " where rid = '" . $rid . "' and from_user='" . $from_user . "'");
		if(empty($fans)){
			$this->message(array("success" => 5, "msg" => '获取不到您的会员信息，请刷新页面重试!'), "");
		}

		$isbaoming = pdo_fetch("select * from " . tablename('haoman_scene_baoming') . " where rid = '" . $rid . "' and from_user='" . $from_user . "'");

		if($isbaoming == true){
			$this->message(array("success" => 11, "msg" => '您已经报名了，不需要重新报名'), "");
		}

		$realname = trim($_GPC['realname']);
		$mobile = trim($_GPC['mobile']);
		$addr = trim($_GPC['addr']);
			
		$insert = array(
			'rid' => $rid,
			'uniacid' => $_W['uniacid'],
			'from_user' => $from_user,
			'realname' => $realname,
			'mobile' => $mobile,
			'address' => $addr,
			'createtime' => time(),
			'status' => 1,
		);
		$temp = pdo_insert('haoman_scene_baoming',$insert);
			
		if($temp == false){
			$this->message(array("success" => 11, "msg" => '报名失败！'), "");
		}else{
			$this->message(array("success" => 1, "msg" => '报名成功！'), "");
		}

	}


	public function doMobileIndex() {
		global $_GPC, $_W;
		$rid = intval($_GPC['id']);
		$uniacid = $_W['uniacid'];
		$fansID = $_W['member']['uid'];
		

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') === false) {

			header("HTTP/1.1 301 Moved Permanently");
			header("Location: {$this->createMobileUrl('other',array('type'=>1,'id'=>$rid))}");
			exit();
		}

		$from_user = $_W['fans']['from_user'];
		load()->model('account');
        $_W['account'] = account_fetch($_W['acid']);
        $cookieid = '__cookie_haoman_scene_201606186_' . $rid;
		$cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
        if ($_W['account']['level'] != 4 && $_W['account']['level'] != 3) {
        	$from_user = $cookie['openid'];
        }

		if (empty($from_user)) {
			$code = $_GPC['code'];
			$urltype = '';
			if (!is_array($cookie) || !isset($cookie['openid'])) {
				$userinfo = $this->get_openid($rid, $code, $urltype);
				$from_user = $userinfo['openid'];
			} else {
				$from_user = $cookie['openid'];
			}
		}


		$page_from_user = base64_encode(authcode($from_user, 'ENCODE'));

		

		$reply = pdo_fetch("select * from " . tablename('haoman_scene_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
		if (empty($reply)) {
			message('非法访问，请重新发送消息进入活动页面！');
		}
		if($reply['getip'] != 0){

			$this->getip($reply['getip_addr'],$reply['getip'],$rid);

		}




		//检测是否关注
		if ($reply['share_url'] == 1) {
			//查询是否为关注用户
			$fansID = $_W['member']['uid'];
			$follow = pdo_fetchcolumn("select follow from " . tablename('mc_mapping_fans') . " where uid=:uid and uniacid=:uniacid order by `fanid` desc", array(":uid" => $fansID, ":uniacid" => $uniacid));

			if ($follow == 0) {
				$addad = pdo_fetchall("select * from " . tablename('haoman_scene_addad') . " where rid = :rid ", array(':rid' => $rid));
				$num1 = array_rand($addad);
				$addad_img = $addad[$num1][adlogo];
				$addad_addetails = $addad[$num1][addetails];

				$nogz = 1; 
				include $this->template('index');
				exit();
			}

		}

		
		//检测是否为空
		$fans = pdo_fetch("select * from " . tablename('haoman_scene_fans') . " where rid = '" . $rid . "' and from_user='" . $from_user . "'");
		if ($fans == false) {
			$insert = array(
				'rid' => $rid,
				'uniacid' => $uniacid,
				'from_user' => $from_user,
				// 'avatar' => $avatar,
				// 'nickname' => $nickname,
				'createtime' => time(),
			);
			$temp = pdo_insert('haoman_scene_fans', $insert);
			$fans['id'] = pdo_insertid();
			$fans = pdo_fetch("select * from " . tablename('haoman_scene_fans') . " where rid = '" . $rid . "' and from_user='" . $from_user . "'");


			if ($temp == false) {
				message('抱歉，刚才操作数据失败！', '', 'error');
			}
			//增加人数，和浏览次数
			pdo_update('haoman_scene_reply', array('fansnum' => $reply['fansnum'] + 1, 'viewnum' => $reply['viewnum'] + 1), array('id' => $reply['id']));
		} else {
			//增加浏览次数
			pdo_update('haoman_scene_reply', array('viewnum' => $reply['viewnum'] + 1), array('id' => $reply['id']));
		}

		// if($fans['status']==2){
		// 	message('抱歉，您已经被拉黑了！', '', 'error');
		// }

// print_r($fans['isad'].$reply['scene'].$reply['isonce']);
// 			exit;
		if ($reply['isonce'] == 1 && empty($_GPC['type'])){
			$fans['isad'] = 0;
		}

		if($reply['scene'] == 1 && $fans['isad'] == 0 && empty($_GPC['type'])){
			
			
			pdo_update('haoman_scene_fans', array('isad' => 1), array('rid' => $rid, 'id' => $fans['id']));

			header("HTTP/1.1 301 Moved Permanently");
			header("Location: {$reply['out_scene_url']}");
			exit();
		}


		//分享信息
		$sharelink = "";
		// $sharelink = $_W['siteroot'] . 'app/' . $this->createMobileUrl('share', array('rid' => $rid, 'from_user' => $page_from_user));
		$sharetitle = empty($reply['share_title']) ? '欢迎参加活动!' : $reply['share_title'];
		$sharedesc = empty($reply['share_desc']) ? '欢迎参加活动，一起来玩！！' : str_replace("\r\n", " ", $reply['share_desc']);
		if (!empty($reply['share_imgurl'])) {
			$shareimg = toimage($reply['share_imgurl']);
		} else {
			$shareimg = toimage($reply['picture']);
		}



		$jssdk = new JSSDK();
		$package = $jssdk->GetSignPackage();
		include $this->template('index');
	}


	public function doMobilesetshare() {
        global $_GPC, $_W;
        $rid = intval($_GPC['id']);
        $uniacid = $_W['uniacid'];
        //网页授权借用开始（特殊代码）

        $from_user = $_W['fans']['from_user'];

		load()->model('account');
        $_W['account'] = account_fetch($_W['acid']);
        if ($_W['account']['level'] != 4 && $_W['account']['level'] != 3) {
            $from_user = authcode(base64_decode($_GPC['from_user']), 'DECODE');
        }



		if (empty($from_user)) {
			$this->message(array("success" => 2, "msg" => '获取不到您的OpenID,请从新进入活动页面'), "");
		}
		$reply = pdo_fetch("select * from " . tablename('haoman_scene_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));

        if($reply['share_type']==0 || $reply['share_type']==2){
        	$this->message(array("success" => 2, "msg" => '非法访问！'.$reply['share_type']), "");
        }

        $fans = pdo_fetch("select * from " . tablename('haoman_scene_fans') . " where rid = " . $rid . " and from_user='" . $from_user . "'");
        if ($fans == false) {
            $data = array(
                'success' => 0,
                'msg' => '保存数据错误！',
            );
        } else {
       

            //查询规则保存哪些数据
            $updata = array();

            $updata['isshare'] = 1;

   			$updata['last_time'] = time();

            $temps = pdo_update('haoman_scene_fans', $updata, array('id' => $fans['id']));

            if ($temps == false) {
                $data = array(
                    'success' => 2,
                    'msg' => '保存数据错误！',
                );
            } else {

                $data = array(
                    'success' => 1,
                    'msg' => '成功提交数据',
                );
            }
        }
        echo json_encode($data);
    }



	public function doMobileisScene(){
        global $_GPC, $_W;
        $rid = intval($_GPC['id']);
        load()->model('mc');
        $fansID = $_W['member']['uid'];

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'MicroMessenger') === false) {
            message('本页面仅支持微信访问!非微信浏览器禁止浏览!', '', 'error');
        }

        $from_user = $_W['fans']['from_user'];

		load()->model('account');
        $_W['account'] = account_fetch($_W['acid']);
        if ($_W['account']['level'] != 4 && $_W['account']['level'] != 3) {
            $from_user = authcode(base64_decode($_GPC['from_user']), 'DECODE');;
        }

		$reply = pdo_fetch("select * from " . tablename('haoman_scene_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));

        $fans = pdo_fetch("SELECT * FROM " . tablename('haoman_scene_fans') . " WHERE rid = " . $rid . " and from_user='" . $from_user . "'");

        if ($fans == false) {
            $data = array(
                'success' => 100,
                'msg' => '活动数据错误！',
            );

        } else {

        	if($reply['isonce'] == 1){
        		$data = array(
                	'isad' => 0,
            	);
        	}else{
        		$data = array(
                	'isad' => 1,
            	);
        	}

        	if($reply['share_type']==1 && $fans['isshare'] != 1){

	        	$data = array(
	                    'success' => 100,
	                    'msg' => '您还没有分享朋友圈，不能参与活动！',
	                );
	        	echo json_encode($data);
	        	exit;
        	}

        		// $this->message(array("success" => 100, "msg" => '您还没有分享朋友圈，不能参与活动！'), "");
        	// }

            $temp = pdo_update('haoman_scene_fans', $data, array('rid' => $rid, 'id' => $fans['id']));

            if ($temp === false) {

                $data = array(
                    'success' => 100,
                    'msg' => '活动数据错误！',
                );
            } else {
                $data = array(
                    'success' => 1,
                    'msg' => '成功参与活动',
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
	// public function doWebDelete_openid() {
	// 	global $_GPC, $_W;
	// 	$rid = intval($_GPC['rid']);
	// 	$del_openid = $_GPC['del_openid'];

	// 	$reply = pdo_fetch("select * from " . tablename('haoman_scene_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
	// 	$fans = pdo_fetch("select * from " . tablename('haoman_scene_fans') . " where from_user=:from_user and rid=:rid", array(':from_user' => $del_openid,':rid'=>$rid));
	// 	$datas = pdo_fetchall("select * from " . tablename('haoman_scene_data') . " where fromuser=:fromuser and rid=:rid", array(':fromuser' => $del_openid,':rid'=>$rid));
	// 	$award = pdo_fetchall("select * from " . tablename('haoman_scene_award') . " where from_user=:from_user and rid=:rid", array(':from_user' => $del_openid,':rid'=>$rid));
	// 	$password = pdo_fetchall("select * from " . tablename('haoman_scene_password') . " where from_user=:from_user and rid=:rid", array(':from_user' => $del_openid,':rid'=>$rid));

	// 	if (empty($fans)) {
	// 		$data = array(
	// 			'success' => 0,
	// 			'msg' => '抱歉，要删除的帐号不存在或是已经被删除！',
	// 		);
	// 	}
	// 	else{
	// 		pdo_delete('haoman_scene_fans', array('from_user' => $del_openid,'rid'=>$rid));
	// 		pdo_update('haoman_scene_reply', array('fansnum' => $reply['fansnum'] - 1), array('id' => $reply['id']));

	// 		if(!empty($datas)){
	// 			pdo_delete('haoman_scene_data', array('fromuser' => $del_openid,'rid'=>$rid));
	// 		}
	// 		if(!empty($award)){
	// 			pdo_delete('haoman_scene_award', array('from_user' => $del_openid,'rid'=>$rid));
	// 		}
	// 		if(!empty($password)){
	// 			pdo_delete('haoman_scene_password', array('from_user' => $del_openid,'rid'=>$rid));
	// 		}
	// 		$data = array(
	// 			'success' => 1,
	// 			'msg' => '删除成功',
	// 		);

	// 	}
	// 	echo json_encode($data);
	// }

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
		$temp = pdo_update('haoman_scene_reply', array('isshow' => $isshow), array('rid' => $rid));
		message('状态设置成功！', referer(), 'success');
	}

	public function doWebSetfansStatus() {
		global $_GPC, $_W;
		$status = intval($_GPC['status']);
		$fansid = intval($_GPC['fansid']);

		if (empty($fansid)) {
			message('抱歉，找不到该粉丝！', '', 'error');
		}
		
		$temp = pdo_update('haoman_scene_fans', array('status' => $status), array('id' => $fansid));
		if($status == 2){
			message('拉黑成功！', referer(), 'success');
		}else{
			message('取消拉黑成功！', referer(), 'success');
		}
		
	}


	 //广告管理
	public function doWebAdmanage() {
		global $_GPC, $_W;

		// checklogin();
		$uniacid = $_W['uniacid'];
		load()->model('reply');
		load()->func('tpl');
		$sql = "uniacid = :uniacid and `module` = :module";
		$params = array();
		$params[':uniacid'] = $_W['uniacid'];
		$params[':module'] = 'haoman_scene';

		$list = reply_search($sql, $params);
		foreach($list as $lists){
			$rid= $lists['id'];
		}





		$addcard = pdo_fetchall("select * from " . tablename('haoman_scene_addad') . " order by `id` desc");


//
		$now = time();
		$addcard1 = array(
			"getstarttime" => $now,
			"getendtime" => strtotime(date("Y-m-d H:i", $now + 7 * 24 * 3600)),
		);



		$addad = pdo_fetchall("select * from " . tablename('haoman_scene_addad') . "where uniacid= :uniacid order by `id` desc",array(':uniacid'=>$_W['uniacid']));

		
		// print_r($rid);
		// exit;
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
		$params[':module'] = 'haoman_scene';

		$rowlist = reply_search($sql, $params);

		// message($rid);

		if($operation == 'updataad'){

			$id = $_GPC['listid'];

			// message($_GPC['cardnum']);
			$keywords = reply_single($_GPC['rulename']);

			$updata = array(
				'uniacid' => $_W['uniacid'],
				'rid' => $_GPC['rulename'],
				'rulename' => $keywords['name'],
				'adlogo' => $_GPC['adlogo'],
				'adtitle' => $_GPC['adtitle'],
				'addetails' => $_GPC['addetails'],
				'adlink' => $_GPC['adlink'],
				'createtime' =>time(),
			);


			$temp =  pdo_update('haoman_scene_addad',$updata,array('id'=>$id));

			message("修改二维码成功",$this->createWebUrl('admanage'),"success");


		}elseif($operation == 'addad'){

			// message($_GPC['cardname']);

			$keywords = reply_single($_GPC['rulename']);

			$updata = array(
				'uniacid' => $_W['uniacid'],
				'rid' => $_GPC['rulename'],
				'rulename' => $keywords['name'],
				'adlogo' => $_GPC['adlogo'],
				'adtitle' => $_GPC['adtitle'],
				'addetails' => $_GPC['addetails'],
				'adlink' => $_GPC['adlink'],
				'createtime' =>time(),
			);


			// message($keywords['name']);

			$temp = pdo_insert('haoman_scene_addad', $updata);

			message("添加二维码成功",$this->createWebUrl('admanage'),"success");

		}elseif($operation == 'up'){

			$uid = intval($_GPC['uid']);
			$list = pdo_fetch("select * from " . tablename('haoman_scene_addad') . "  where id=:uid ", array(':uid' => $uid));

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
		$rule = pdo_fetch("select id from " . tablename('haoman_scene_addad') . " where id = :id ", array(':id' => $id));
		if (empty($rule)) {
			message('抱歉，参数错误！');
		}
		if (pdo_delete('haoman_scene_addad', array('id' => $id))) {
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
			$rule = pdo_fetch("select id from " . tablename('haoman_scene_addad') . " where id = :id ", array(':id' => $rid));
			if (empty($rule)) {
				message('抱歉，要修改的规则不存在或是已经被删除！', '', 'error');
			}
			if (pdo_delete('haoman_xxx_addad', array('id' => $rid))) {

			}
		}
		message('删除成功！', referer(), 'success');
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




	public function get_jieyong() {
		global $_W, $_GPC;
		$path = "/addons/haoman_scene";
		$filename = IA_ROOT . $path . "/data/sysset_" . $_W['uniacid'] . ".txt";
		if (is_file($filename)) {
			$content = file_get_contents($filename);
			if (empty($content)) {
				return false;
			}
			return json_decode(base64_decode($content), true);
		}
		return pdo_fetch("SELECT * FROM " . tablename('haoman_scene_jiequan') . " WHERE uniacid = :uniacid limit 1", array(':uniacid' => $_W['uniacid']));
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
				pdo_update('haoman_scene_jiequan', $data, array('id' => $set['id']));
			} else {
				pdo_insert('haoman_scene_jiequan', $data);
			}
			$this->write_cache("sysset_" . $_W['uniacid'], $data);
			message('更新借用设置成功！', 'refresh');
		}

		include $this->template('jiequan');
	}


	public function get_sysset() {   //读取借用数据appid和appsecret
		global $_W;
		return pdo_fetch("SELECT * FROM " . tablename('haoman_scene_jiequan') . " WHERE uniacid = :uniacid limit 1", array(':uniacid' =>$_W['uniacid']));
	}

	private function get_code($rid,$appid,$urltype) {  //第一步先获取Code
		global $_W;
		// if(empty($urltype)){  //这边是回调地址，获取Code成功后跳转的页面，默认是到首页，但是在助力页面也需要用到，所以需要传入$_GPC['from_user']，这样才不会出现回调后，分享人信息丢失

			$url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=haoman_scene&do=index&id={$rid}";

		// }else{

		// 	$url =  $_W['siteroot'] . 'app/' . $this->createMobileUrl('share', array('rid' => $rid, 'from_user' => $urltype));
		// }
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

		if ($_W['account']['level'] != 4 && $_W['account']['level'] != 3) {
			//不是认证服务号
			$set = $this->get_sysset();
			if (!empty($set['appid']) && !empty($set['appsecret'])) {
				$appid = $set['appid'];
				$appsecret = $set['appsecret'];
			} else{
				$cookieid = '__cookie_haoman_scene_201606186_' . $rid;
				$token['openid'] = 'NOOPENID'. $rid . TIMESTAMP;
				$cookie = array('openid'=>$token['openid']);
				setcookie($cookieid, base64_encode(json_encode($cookie)), time() + 3600 * 24 * 365);
				//如果没有借用，判断是否认证服务号
				return $token;
				exit;
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
		$cookieid = '__cookie_haoman_scene_201606186_' . $rid;
		$cookie = array('openid'=>$token['openid']);
		setcookie($cookieid, base64_encode(json_encode($cookie)), time() + 3600 * 24 * 365);
		return $token;
	}




}
