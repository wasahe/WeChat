<?php
defined('IN_IA') or exit('Access Denied');
require_once '../framework/library/qrcode/phpqrcode.php';
define('ROOT_PATH', str_replace('module.php', '', str_replace('\\', '/', __FILE__)));

class haoman_xxxModule extends WeModule {
	public $tablenames = 'haoman_xxx_reply';
	public $tablename = 'haoman_xxx_prize';
		public function fieldsFormDisplay($rid = 0) {
		global $_W;
		global $_GPC;
		load()->func('tpl');

		$creditnames = array();
			$unisettings = uni_setting($uniacid, array('creditnames'));
			foreach ($unisettings['creditnames'] as $key=>$credit) {
				if (!empty($credit['enabled'])) {
					$creditnames[$key] = $credit['title'];
				}
			}
			if (!empty($rid)) {
				$reply = pdo_fetch("select * from " . tablename('haoman_xxx_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
				$prize = pdo_fetchall("select * from " . tablename($this->tablename) . " where rid = :rid order by `id` asc", array(':rid' => $rid));
				$carr = explode(',',$reply['ticketinfo']);
				$num1 = $carr[0]/100;
				$num2 = $carr[1]/100;
			}

			$prizes = pdo_fetch("select * from " . tablename($this->tablename) . " where rid = :rid order by `id` asc", array(':rid' => $rid));
			$times = $prizes['id'];
			if(empty($prizes)){
				$times = 1;
			}

			if (!$reply) {
				$now = time();
				$reply = array(
					"title" => "",
					"start_picurl" => "",
					"starttime" => $now,
					"endtime" => strtotime(date("Y-m-d H:i", $now + 7 * 24 * 3600)),
					"backpicurl" => "",
					"most_num_times" => 0,
					"probability" => 0,
					"award_times" => 1,
					"number_times" => 0,
					"show_num" => 0,
					"password" => 0,
					"turntable" => 8,
					"match" => 5,
					"share_acid" => 100,
					"credit1" => 1,
					"awardnum" => 50,
					"xf_condition" =>0,
					"show_type" =>0,
					"share_type" =>0,
					"is_openbbm" =>0,
					"bbm_use_times" =>0,
					"is_sharetype" =>0,
					"is_indexshow_rule" =>0,
					"tx_most" =>500,
					"rank" =>1,
					"isappkey" =>0,

				);
			}

			$imgName = "haomanxxx".$_W['uniacid'].$rid;
			$linkUrl = $_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&m=haoman_xxx&do=index&id=".$rid;
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

			$allowip1 = explode("|",$reply['allowip']);
			$allowip2 = $allowip1[3];
			if($allowip2!=0){
				$allowip = implode("|",array_slice($allowip1,0,3));
			}


			include $this->template('form');
	}

	public function fieldsFormValidate($rid = 0) {
		return '';
	}

	public function fieldsFormSubmit($rid = 0) {
	load()->func('file');
		global $_GPC, $_W;
		$actime = $_GPC['actime'];
		if(intval($_GPC['prace_times']) < intval($_GPC['sharecount'])){
			message("转发奖励次数不能大于每天最大奖励次数");
		}

//		if(empty($_GPC['share_url'])){
//			message('关注引导链接不能为空','','error');
//		}

		$allowip1 = explode("|",$_GPC['allowip']);
		$allowip = implode("|",array_slice($allowip1,0,3));
		$arr_allowip = str_replace("\r\n", " ",$allowip)."|".intval($_GPC['allowip2']);


		$a =intval($_GPC['ticketinfo1']*100);
		$b =intval($_GPC['ticketinfo2']*100);
		$num = $a.','.$b;

		$insert = array(
			'rid' => $rid,
			'uniacid' => $_W['uniacid'],
			'weid' => $_W['uniacid'],
			'picture' => $_GPC['picture'],
			'description' => $_GPC['description'],
			'registimg' => $_GPC['registimg'],
			'start_picurl' => $_GPC['start_picurl'],
			'periodlottery' => intval($_GPC['periodlottery']),
			'maxlottery' => intval($_GPC['maxlottery']),
			'rules' => htmlspecialchars_decode($_GPC['rules']),
			'sharecount' => intval($_GPC['sharecount']),
			'misscredit' => intval($_GPC['misscredit']),
			'prace_times' => intval($_GPC['prace_times']),
			'title' => $_GPC['title'],
			'indexPicture' =>$_GPC['indexPicture'],
			'up_qrcode' =>$_GPC['up_qrcode'],
			'headpic' => $_GPC['headpic'],
			'headurl' => $_GPC['headurl'],
			'zhuanfaimg' => $_GPC['zhuanfaimg'],
			'panzi' => $_GPC['panzi'],
			'xf_condition' => $_GPC['xf_condition'],
			'tx_most' => $_GPC['tx_most']*100,
			'show_type' => $_GPC['show_type'],
			'fansstatus' => intval($_GPC['fansstatus']),
			'turntable' => $_GPC['turntable'],
			'is_openbbm' => $_GPC['is_openbbm'],
			'adpic' => $_GPC['adpic'],
			'backpicurl' => $_GPC['backpicurl'],
			'backcolor' => $_GPC['backcolor'],
			'adpicurl' => $_GPC['adpicurl'],
			'noip_url' => $_GPC['noip_url'],
			'registurl' => $_GPC['registurl'],
			'start_theme' => $_GPC['start_theme'],
			'start_title' => $_GPC['start_title'],
			'tiemadpic' => $_GPC['tiemadpic'],
			'timead' => $_GPC['timead'],
			'timenum' => $_GPC['timenum'],
			'time_style' => $_GPC['time_style'],
			'bbm_use_times' => $_GPC['bbm_use_times'],
			'timeadurl' => $_GPC['timeadurl'],
			'key_money1' => $_GPC['key_money1']*100,
			'key_money2' => $_GPC['key_money2']*100,
			'number_times' => $_GPC['number_times'],
			'award_times' => $_GPC['award_times'],
			'couponid' => $_GPC['couponid'],
			'couponname' => $_GPC['couponname'],
			'hb_today_times' => $_GPC['most_num_times'],
			'most_num_times' => $_GPC['most_num_times'],
			'count_time' => $_GPC['count_time'],
			'today_most_times' => $_GPC['today_most_times'],
			"ptype" => $_GPC['ptype'],
			"gl_openid" => trim($_GPC['gl_openid']),
			"credit1" => $_GPC['credit1'],
			"rec_show" => $_GPC['rec_show'],
			'createtime' => time(),
			'share_acid' => $_GPC['share_acid']*100,
			'copyright' => $_GPC['copyright'],
			'starttime' => strtotime($_GPC['datelimit']['start']),
			'endtime' => strtotime($_GPC['datelimit']['end']),
			'start_hour' => $_GPC['start_hour'],
			'end_hour' => $_GPC['end_hour'],
			'ticketinfo' => $num,
			'qjbpic' => $_GPC['qjbpic'],
			'qjbimg' => $_GPC['qjbimg'],
			'ziliao' =>  $_GPC['ziliao'],
			'match' =>  $_GPC['match'],
			'follow_url' =>  $_GPC['follow_url'],
			'password' =>  $_GPC['password'],
			'is_show_prize' =>  $_GPC['is_show_prize'],
			'is_show_prize_num' =>  $_GPC['is_show_prize_num'],
			'share_imgurl' =>  $_GPC['share_imgurl'],
			'share_title' =>  $_GPC['share_title'],
			'share_desc' =>  $_GPC['share_desc'],
			'share_type' =>  $_GPC['share_type'],
			'sharenum' =>  $_GPC['sharenum'],
			'rank' =>  $_GPC['rank'],
			'sharenumtop' =>  $_GPC['sharenumtop'],
			'is_error' =>  $_GPC['is_error'],
			'up_bgvoice' =>  $_GPC['up_bgvoice'],
			'up_bbvoice' =>  $_GPC['up_bbvoice'],
			'bd_key' =>  $_GPC['bd_key'],
			'address_sf' =>  $_GPC['address_sf'],
			'address_sq' =>  $_GPC['address_sq'],
			'address_qx' =>  $_GPC['address_qx'],
			'share_url' =>  trim($_GPC['share_url']),
			'mybb_url' =>  trim($_GPC['mybb_url']),
			'ruleimg_url' =>  trim($_GPC['ruleimg_url']),
			'is_closebb' =>  intval($_GPC['is_closebb']),
			'is_closebg' =>  intval($_GPC['is_closebg']),
			'is_indexshow_rule' =>  intval($_GPC['is_indexshow_rule']),
			'getip' =>  intval($_GPC['getip']),
			'getip_addr' =>  trim($_GPC['getip_addr']),
			'is_sharetype' =>  intval($_GPC['is_sharetype']),
			'isallowip' => intval($_GPC['isallowip']),
			'isappkey' => intval($_GPC['isappkey']),
			'allowip' => str_replace("\r\n", " ",$arr_allowip),

		);
		$id = intval($_GPC['id']);


		if (empty($id)) {
			if ($insert['starttime'] <= time()) {
				$insert['isshow'] = 1;
			} else {
				$insert['isshow'] = 0;
			}
			$id = pdo_insert('haoman_xxx_reply', $insert);
		} else {
			pdo_update('haoman_xxx_reply', $insert, array('id' => $id));
		}

		if (!empty($_GPC['flagtype'])) {

			foreach ($_GPC['flagtype'] as $index => $flagtype_tmp) {

				if (empty($flagtype_tmp)) {

					continue;

				}
				$insert = array(

					'rid' => $rid,

					'uniacid' => $_W['uniacid'],

					'prizename' => $_GPC['prizename'.$flagtype_tmp],

					'awardsimg' => $_GPC['awardsimg'][$flagtype_tmp],

					'awardstotal' => $_GPC['awardstotal'.$flagtype_tmp],

					'awardspro' => $_GPC['awardspro'.$flagtype_tmp],

					'jifen' => $_GPC['gjifen'.$flagtype_tmp],
					'jifen2' => $_GPC['gjifen2'.$flagtype_tmp],

					'prizetxt' => $_GPC['prizetxt'.$flagtype_tmp],

					'credit' => intval($_GPC['creditt'.$flagtype_tmp]*100),

					'credit2' => intval($_GPC['creditt2'.$flagtype_tmp]*100),

					'couponid' => $_GPC['couponid'.$flagtype_tmp],

					'ptype' => $_GPC['ptype'.$flagtype_tmp],

				);

				pdo_update($this->tablename, $insert, array('id' => $flagtype_tmp));



			}

			$result=pdo_delete($this->tablename,'id NOT IN ('.implode(',',$_GPC['flagtype']).') AND rid = '.$rid);

		}

		else{

			pdo_delete($this->tablename, array('rid' => $rid));

		}





		if (!empty($_GPC['flagtype_new'])&&count($_GPC['flagtype_new'])>=1) {

			foreach ($_GPC['flagtype_new'] as $index => $flagtype_new) {

				$insert = array(

					'rid' => $rid,

					'uniacid' => $_W['uniacid'],

					'prizename' => $_GPC['prizename_new'.$flagtype_new],

					'awardsimg' => $_GPC['awardsimg_new'][$index+1],

					'awardstotal' => $_GPC['awardstotal_new'.$flagtype_new],

					'awardspro' => $_GPC['awardspro_new'.$flagtype_new],

					'jifen' => intval($_GPC['jifen_new'.$flagtype_new]),

					'jifen2' => intval($_GPC['jifen2_new'.$flagtype_new]),

					'prizetxt' => $_GPC['prizetxt_new'.$flagtype_new],

					'credit' => intval($_GPC['credit_new'.$flagtype_new]*100),

					'credit2' => intval($_GPC['credit2_new'.$flagtype_new]*100),

					'couponid' => $_GPC['couponid_new'.$flagtype_new],

					'ptype' => $_GPC['ptype_new'.$flagtype_new],

				);

				pdo_insert($this->tablename, $insert);

			}

		}


	}

	public function ruleDeleted($rid = 0) {
		global $_W;
			load()->func('file');
		$replies = pdo_fetchall("SELECT id, picture FROM ".tablename($this->tablenames)." WHERE rid = '$rid'");
		$deleteid = array();
		
		if (!empty($replies)) {
			foreach ($replies as $index => $row) {
				file_delete($row['picture']);
				$deleteid[] = $row['id'];
			}
		}
		pdo_delete($this->tablenames, "id IN ('".implode("','", $deleteid)."')");
		
		return true;
	}
}
