<?php
defined('IN_IA') or exit('Access Denied');
require_once '../framework/library/qrcode/phpqrcode.php';
define('ROOT_PATH', str_replace('module.php', '', str_replace('\\', '/', __FILE__)));

class haoman_sceneModule extends WeModule {
	public $tablenames = 'haoman_scene_reply';
	// public $tablename = 'haoman_scene_prize';
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
				$reply = pdo_fetch("select * from " . tablename('haoman_scene_reply') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
			}

		

			if (!$reply) {
				$now = time();
				$reply = array(
					"title" => "",
					"starttime" => $now,
					"endtime" => strtotime(date("Y-m-d H:i", $now + 7 * 24 * 3600)),
					"share_acid" => 100,
					"xf_condition" =>0,
					"is_openbbm" =>0,
					"bbm_use_times" =>0,
					"isonce" =>0,
					"is_sharetype" =>0,
					"tx_most" =>500,

				);
			}

			$imgName = "haomanscene".$_W['uniacid'].$rid;
			$imgName2 = "haomanupdatescan".$_W['uniacid'].$rid;
			$linkUrl = $_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&m=haoman_scene&do=index&id=".$rid;
			$linkUrl2 = $_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&m=haoman_scene&do=scan&id=".$rid;
			$imgUrl = "../addons/haoman_scene/qrcode/".$imgName.".png";
			$imgUrl2 = "../addons/haoman_scene/qrcode/".$imgName2.".png";
			load()->func('file');
			mkdirs(ROOT_PATH . '/qrcode');
			$dir = $imgUrl;
			$dir2 = $imgUrl2;
			$flag = file_exists($dir);
			$flag2 = file_exists($dir2);
			// if($flag == false){
				//生成二维码图片
				$errorCorrectionLevel = "L";
				$matrixPointSize = "4";
				QRcode::png($linkUrl,$imgUrl,$errorCorrectionLevel,$matrixPointSize);
				//生成二维码图片
			// }
			// if($flag2 == false){
				//生成二维码图片
				// $errorCorrectionLevel = "L";
				// $matrixPointSize = "4";
				QRcode::png($linkUrl2,$imgUrl2,$errorCorrectionLevel,$matrixPointSize);
				//生成二维码图片
			// }

			$allowip1 = explode("|",$reply['allowip']);
			$allowip2 = $allowip1[3];
			if($allowip2!=0){
				$allowip = implode("|",array_slice($allowip1,0,3));
			}

			load()->model('account');
			$isnogz = 0;
			$_W['account'] = account_fetch($_W['acid']);
			if ($_W['account']['level'] != 4 && $_W['account']['level'] != 3) {
				$app = pdo_fetch("SELECT * FROM " . tablename('haoman_scene_jiequan') . " WHERE uniacid = :uniacid limit 1", array(':uniacid' =>$_W['uniacid']));
				if (empty($app['appid']) || empty($app['appsecret'])) {
					$isnogz = 1;
				}

			}


			include $this->template('form');
	}

	public function fieldsFormValidate($rid = 0) {
		return '';
	}

	public function fieldsFormSubmit($rid = 0) {
	load()->func('file');
		global $_GPC, $_W;

		$allowip1 = explode("|",$_GPC['allowip']);
		$allowip = implode("|",array_slice($allowip1,0,3));
		$arr_allowip = str_replace("\r\n", " ",$allowip)."|".intval($_GPC['allowip2']);

		$insert = array(
			'rid' => $rid,
			'uniacid' => $_W['uniacid'],
			'title' => $_GPC['title'],
			'picture' => $_GPC['picture'],
			'description' => $_GPC['description'],
			'starttime' => strtotime($_GPC['datelimit']['start']),
			'endtime' => strtotime($_GPC['datelimit']['end']),
			'rules' => htmlspecialchars_decode($_GPC['rules']),
			'up_qrcode' =>$_GPC['up_qrcode'],
			'share_url' =>  trim($_GPC['share_url']),
			'share_gz' =>  trim($_GPC['share_gz']),
			'share_type' =>  $_GPC['share_type'],
			'getip' =>  intval($_GPC['getip']),
			'getip_addr' =>  trim($_GPC['getip_addr']),
			'isallowip' => intval($_GPC['isallowip']),
			'allowip' => str_replace("\r\n", " ",$arr_allowip),
			'share_imgurl' =>  $_GPC['share_imgurl'],
			'share_title' =>  $_GPC['share_title'],
			'share_desc' =>  $_GPC['share_desc'],
			'noip_url' => $_GPC['noip_url'],
			'scene' => intval($_GPC['scene']),
			'isonce' => intval($_GPC['isonce']),
			'isonline' => intval($_GPC['isonline']),
			'out_scene_url' => $_GPC['out_scene_url'],
			'http_scene_url' => $_GPC['http_scene_url'],
			'p1_bg' => $_GPC['p1_bg'],
			'p1_top' => $_GPC['p1_top'],
			'p1_bottom' => $_GPC['p1_bottom'],
			'p2_bg' => $_GPC['p2_bg'],
			'p2_top' => $_GPC['p2_top'],
			'p2_bottom' => $_GPC['p2_bottom'],
			'p3_bg' => $_GPC['p3_bg'],
			'p3_top' => $_GPC['p3_top'],
			'p3_isphone' => intval($_GPC['p3_isphone']),
			'p3_phone' => $_GPC['p3_phone'],
			'start_bg' => $_GPC['start_bg'],
			'start_top' => $_GPC['start_top'],
			'start_dec' => $_GPC['start_dec'],
			'start_music' => $_GPC['start_music'],
			'createtime' => time(),
			'copyright' => $_GPC['copyright'],


		);
		$id = intval($_GPC['id']);


		if (empty($id)) {
			if ($insert['starttime'] <= time()) {
				$insert['isshow'] = 1;
			} else {
				$insert['isshow'] = 0;
			}
			$id = pdo_insert('haoman_scene_reply', $insert);
		} else {
			pdo_update('haoman_scene_reply', $insert, array('id' => $id));
		}

		// if (!empty($_GPC['flagtype'])) {

		// 	foreach ($_GPC['flagtype'] as $index => $flagtype_tmp) {

		// 		if (empty($flagtype_tmp)) {

		// 			continue;

		// 		}
		// 		$insert = array(

		// 			'rid' => $rid,
		// 			'uniacid' => $_W['uniacid'],
		// 			'line1' => intval($_GPC['line1'.$flagtype_tmp]*100),
		// 			'line2' => intval($_GPC['line2'.$flagtype_tmp]*100),
		// 			'credit' => intval($_GPC['creditt'.$flagtype_tmp]*100),
		// 			'credit2' => intval($_GPC['creditt2'.$flagtype_tmp]*100),

		// 		);

		// 		pdo_update($this->tablename, $insert, array('id' => $flagtype_tmp));



		// 	}

		// 	$result=pdo_delete($this->tablename,'id NOT IN ('.implode(',',$_GPC['flagtype']).') AND rid = '.$rid);

		// }

		// else{

		// 	pdo_delete($this->tablename, array('rid' => $rid));

		// }





		// if (!empty($_GPC['flagtype_new'])&&count($_GPC['flagtype_new'])>=1) {

		// 	foreach ($_GPC['flagtype_new'] as $index => $flagtype_new) {

		// 		$insert = array(

		// 			'rid' => $rid,
		// 			'uniacid' => $_W['uniacid'],
		// 			'line1' => intval($_GPC['line1_new'.$flagtype_new]*100),
		// 			'line2' => intval($_GPC['line2_new'.$flagtype_new]*100),
		// 			'credit' => intval($_GPC['credit_new'.$flagtype_new]*100),
		// 			'credit2' => intval($_GPC['credit2_new'.$flagtype_new]*100),


		// 		);

		// 		pdo_insert($this->tablename, $insert);

		// 	}

		// }


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
