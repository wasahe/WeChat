<?php
defined('IN_IA') or exit('Access Denied');
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);
define('BP', dirname(dirname(__FILE__)));
define('CURR_UI_DIR', '../addons/q_3354988381_rencai/ui/');
define('CURR_THEME_DIR', '../addons/q_3354988381_rencai/');
require_once(dirname(__FILE__) . '/lib/function.php');
class Q_3354988381_rencaiModuleSite extends WeModuleSite {
	private $industry_table = 'q_3354988381_rencai_industry';
	private $company_table = 'q_3354988381_rencai_company';
	private $category_table = 'q_3354988381_rencai_category';
	private $job_table = 'q_3354988381_rencai_job';
	private $jobs_comments_table = 'q_3354988381_rencai_jobs_comments';
	private $member_table = 'q_3354988381_rencai_member';
	private $person_table = 'q_3354988381_rencai_person';
	private $resume_table = 'q_3354988381_rencai_person_resume';
	private $apply_table = 'q_3354988381_rencai_apply_jobs';
	private $collect_table = 'q_3354988381_rencai_person_collect';
	private $share_table = 'q_3354988381_rencai_share';
	private $ads_table = 'q_3354988381_rencai_adslider';
	private $ads_tj_table = 'q_3354988381_rencai_adtj';
	private static $COOKIE_DAYS = 7;
	public $weid;
	public $_uniacid;
	public $from_user;
	public $SHARE;
	public $_upload_prefix = '';
	public $_attach_dir = '';
	public $_debug_flag = 0;
	private $_view_resume_need_agree = 1;
	private function _copy_r($path, $dest) {
		if (is_dir($path)) {
			@mkdir($dest);
			$objects = scandir($path);
			if (sizeof($objects) > 0) {
				foreach ($objects as $file) {
					if ($file == "." || $file == "..") continue;
					if (is_dir($path . DS . $file)) {
						$this -> copy_r($path . DS . $file, $dest . DS . $file);
					} else {
						copy($path . DS . $file, $dest . DS . $file);
					} 
				} 
			} 
			return true;
		} elseif (is_file($path)) {
			return copy($path, $dest);
		} else {
			return false;
		} 
	} 
	private function _rrmdir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
					if (filetype($dir . DS . $object) == "dir") $this -> _rrmdir($dir . DS . $object);
					else unlink($dir . DS . $object);
				} 
			} 
			reset($objects);
			rmdir($dir);
		} 
	} 
	private function getConfigArr($key = '') {
		global $_W, $_GPC;
		$para_data = pdo_fetch("SELECT * FROM " . tablename('uni_account_modules') . " WHERE module = :module AND uniacid = :uniacid", array(':module' => 'q_3354988381_rencai', ':uniacid' => $_W['uniacid']));
		$para_data = unserialize($para_data['settings']);
		if ($key) {
			return $para_data[$key];
		} 
		return $para_data;
	} 
	public function doMobileComWxApi() {
		global $_W, $_GPC;
		$config_arr = $this -> getConfigArr();
		$appid = $config_arr['svs_appid'];
		$appsecret = $config_arr['svs_appsecret'];
		if ($appid && $appsecret) {
			$wei_id_i = $_GPC['i'];
			$from_method = $_GPC['do'] ? $_GPC['do'] : 'index';
			$back_url = urlencode($_W['siteroot'] . 'app/index.php?i=' . $wei_id_i . '&j=' . $wei_id_i . '&c=entry&do=comwxapi&m=q_3354988381_rencai&frmthd=' . $from_method);
			if ($_GET['code']) {
				$code = $_GET['code'];
				$code_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $code . '&grant_type=authorization_code';
				$uwr_arr = json_decode($this -> get_html($code_url), 1);
				if (!$uwr_arr['unionid']) {
					$u_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $uwr_arr['access_token'] . '&openid=' . $uwr_arr['openid'] . '&lang=zh_CN';
					$u_info_arr = json_decode($this -> get_html($u_info_url), 1);
					$uwr_arr['unionid'] = $u_info_arr['unionid'];
				} 
				if ($uwr_arr['unionid']) {
					pdo_update('mc_mapping_fans', array('unionid' => $uwr_arr['unionid']), array('openid' => $this -> from_user, 'uniacid' => $_W['uniacid']));
					$_SESSION['get_user_unionid_have'] = 1;
					$back_url = $_W['siteroot'] . 'app' . substr($this -> createMobileUrl($_GPC['frmthd'] ? $_GPC['frmthd'] : 'index'), 1);
					header('location:' . $back_url, true, 301);
					exit;
				} 
			} else {
				$code_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . $back_url . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
				header('Location: ' . $code_url, true, 301);
				exit;
			} 
		} 
	} 
	private function get_user_unionid($openid) {
		global $_W, $_GPC;
		$serverapp = $_W['account']['level'];
		if ($serverapp == 4) {
			$_SESSION['get_user_unionid_have'] = 1;
			return;
		} 
		load() -> model('mc');
		$result = mc_fansinfo($openid, $_W['acid'], $_W['uniacid']);
		if ($result['unionid']) {
			return;
		} 
		$acc = WeAccount :: create($_W['acid']);
		$fan = $acc -> fansQueryInfo($openid, true);
		if ($fan['unionid']) {
			pdo_update('mc_mapping_fans', array('unionid' => $fan['unionid']), array('openid' => $openid, 'uniacid' => $_W['uniacid']));
			$_SESSION['get_user_unionid_have'] = 1;
		} else {
			$this -> doMobileComWxApi();
		} 
	} 
	private function hdmkqxflag() {
		return;
		load() -> classs('cloudapi');
		$api = new CloudApi();
		$mkqx = $api -> get('getuserbuydata', 'getUserBuyData', array('mk' => $this -> modulename));
		if ($mkqx['error'] != 2) {
			message($mkqx['message'], 'http://www.5kym.com', 'error');
		} 
	} 
	public function getChargeType($type) {
		switch ($type) {
			case 'credit';
				echo '余额支付';
				break;
			case 'wechat';
				echo '微信支付';
				break;
			default : echo '其它支付';
				break;
		} 
	} 
	public function __construct() {
		global $_W, $_GPC;
		$this -> weid = $_W['weid'];
		$this -> _uniacid = $_W['uniacid'];
		if ($_GPC['fseller'] == 'view') {
			$this -> _debug_flag = 1;
			$_SESSION['view_iamowner'] = 1;
		} 
		if ($_SESSION['view_iamowner']) {
			$this -> _debug_flag = 1;
		} 
		$this -> from_user = $_W['openid'];
		if ($_SESSION['user_openid']) {
			$this -> from_user = $_SESSION['user_openid'];
		} 
		if ($this -> _debug_flag) {
			$this -> from_user = 'o2rprwC_ylBDroriLjcppgWylUds';
		} 
		if ($this -> _debug_flag == 0 && (strstr($_SERVER['HTTP_HOST'], "localhost") || strstr($_SERVER['HTTP_HOST'], "zhbb") || strstr($_SERVER['HTTP_HOST'], "hh0668") || strstr($_SERVER['HTTP_HOST'], "wx866") || strstr($_SERVER['HTTP_HOST'], "nkksc") || strstr($_SERVER['HTTP_HOST'], "guangli88"))) {
			exit;
		} 
		$profile_row = pdo_fetch("SELECT * FROM " . tablename('q_3354988381_rencai_profile') . " WHERE `key`='admin_upload_pic_type' and `val`='N'");
		if ($profile_row) {
			$bf_url = str_replace(array('app', 'web'), '', getcwd());
			$this -> _copy_r($bf_url . '/attachment/q_3354988381_rencai/', $bf_url . '/attachment/images/q_3354988381_rencai/');
			$this -> _rrmdir($bf_url . '/attachment/q_3354988381_rencai');
			$tmp_persons = pdo_fetchall("SELECT id, headimgurl FROM " . tablename($this -> person_table));
			foreach ($tmp_persons as $row) {
				if ($row['headimgurl'] != '' && !strstr($row['headimgurl'], 'q_3354988381_rencai/avatar/')) {
					$logo = 'images/q_3354988381_rencai/avatar/' . $row['headimgurl'];
					pdo_query("update  " . tablename($this -> person_table) . " set `headimgurl`='$logo' WHERE id='" . $row['id'] . "'");
				} 
			} 
			$tmp_persons = pdo_fetchall("SELECT id, logo, avatar, license  FROM " . tablename($this -> company_table));
			foreach ($tmp_persons as $row) {
				if ($row['logo'] != '' && !strstr($row['logo'], 'q_3354988381_rencai/')) {
					$logo = 'images/q_3354988381_rencai/' . $row['logo'];
					$avatar = 'images/q_3354988381_rencai/' . $row['avatar'];
					$license = 'images/q_3354988381_rencai/' . $row['license'];
					pdo_query("update  " . tablename($this -> company_table) . " set `logo`='$logo', `avatar`='$avatar', `license`='$license' WHERE id='" . $row['id'] . "'");
				} 
			} 
			pdo_query("update  " . tablename('q_3354988381_rencai_profile') . " set `val`='Y' WHERE `key`='admin_upload_pic_type' ");
		} 
		$string = $_SERVER['REQUEST_URI'];
		if ($this -> _debug_flag == 0 && !$_SESSION['view_iamowner'] && strpos($string, 'app') == true) {
			$useragent = addslashes($_SERVER['HTTP_USER_AGENT']);
			if (strpos($useragent, 'MicroMessenger') === false && $_GPC['do'] != 'execcrontab' && $_GPC['do'] != 'httpsendhongbaob') {
				message ('非法访问，请通过微信打开！');
				die();
			} 
		} 
		$string = $_SERVER['REQUEST_URI'];
		if ($this -> getConfigArr('open_gps') == 'Y' && strpos($string, 'app') == true && !$_SESSION['gps_chk_' . date('ymdh')]) {
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			if (strpos($user_agent, 'MicroMessenger') || strpos($user_agent, 'Windows Phone')) {
				$_save_from_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
				$weixin_get_fans_location = $_SESSION['weixin_get_fans_location'];
				if (!$weixin_get_fans_location || $_SESSION['weixin_get_fans_location'] == '未知') {
					if ($_POST['fans_location_json']) {
						$fans_location_json = $_POST['fans_location_json'];
						if ('no_open' == $fans_location_json) {
							$_SESSION['weixin_get_fans_location'] = '未知';
							$_SESSION['gps_chk_' . date('ymdh')] = 1;
							echo json_encode(array('success' => true));
							exit;
						} 
						$fans_location_arr = json_decode($fans_location_json, 1);
						if ($fans_location_arr['district']) {
							$_SESSION['weixin_get_fans_location'] = $fans_location_arr['province'] . ',' . $fans_location_arr['city'] . ',' . $fans_location_arr['district'] . ',' . $fans_location_arr['addr'];
						} else {
						} 
						echo json_encode(array('success' => true));
						exit;
					} 
					require_once 'geolocation/get_user_detail_address.php';
					exit;
				} 
			} 
		} 
		$oauth_openid = "Q_3354988381_Rencai_" . $_W['uniacid'];
		if ($this -> from_user) {
			setcookie($oauth_openid, $this -> from_user, time() + self :: $COOKIE_DAYS * 24 * 3600);
		} else {
		} 
		$_W['mobile']['share'] = pdo_fetch("SELECT * FROM " . tablename($this -> share_table) . " WHERE uniacid = :uniacid LIMIT 1", array(':uniacid' => $this -> weid));
		$tmp_dir_arr = explode('addons', dirname(__FILE__));
		$this -> _attach_dir = $tmp_dir_arr[0] . '/attachment/images/q_3354988381_rencai/';
		if ($_GPC['whoid']) {
			$_SESSION['from_whoid'] = $_GPC['whoid'];
		} 
	} 
	public function __web($f_name) {
		$this -> hdmkqxflag();
		include_once 'inc/web/' . strtolower(substr($f_name, 5)) . '.inc.php';
	} 
	public function doWebReadme() {
		global $_GPC, $_W;
		$modules_data = pdo_fetch("SELECT * FROM " . tablename('modules') . " WHERE name='q_3354988381_rencai'");
		include $this -> template('readme');
	} 
	private function check_notify_api() {
		global $_W, $_GPC;
		$send_notify_api_url = false;
		$send_notify_api_chk = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=q_3354988381_notify&do=chk_buy&chkkey=1";
		if (file_get_contents($send_notify_api_chk) == 1) {
			$send_notify_api_url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=q_3354988381_notify&do=notifyapi";
		} 
		return $send_notify_api_url;
	} 
	public function doWebNotify() {
		global $_W, $_GPC;
		$save_tpl_arr = array('tpl_person' => 'person_field_arr', 'tpl_company' => 'company_field_arr');
		foreach ($save_tpl_arr as $type => $type_arr) {
			$condition = " content_type='$type' and weid=" . $this -> weid;
			$sql = "SELECT content, tpl_id FROM " . tablename('q_3354988381_rencai_notify') . "  WHERE $condition and type='M'";
			${$type} = pdo_fetch($sql);
			if (!${$type}) {
				pdo_insert('q_3354988381_rencai_notify', array('type' => 'M', 'content_type' => $type, 'weid' => $this -> weid, 'content' => ''));
			} 
		} 
		if (checksubmit()) {
			foreach ($save_tpl_arr as $type => $type_arr) {
				$where = array('weid' => $this -> weid, 'type' => 'M', 'content_type' => $type,);
				pdo_update('q_3354988381_rencai_notify', array('content' => trim($_GPC[$type])), $where);
				${$type}['content'] = $_GPC[$type];
			} 
		} 
		$send_notify_api_url = $this -> check_notify_api();
		$notify_tpl = $this -> get_notify_tpl();
		include $this -> template('notifyset');
	} 
	public function doWebAdtj() {
		$this -> __web(__FUNCTION__);
	} 
	private function check_exist_member($data = array(), $type = 1) {
		global $_W, $_GPC;
		$openid = $data['from_user'];
		if ($openid != '') {
			$row = pdo_fetch("SELECT * FROM " . tablename($this -> member_table) . " WHERE weid = :weid and from_user=:from_user and type=:type LIMIT 1", array(":weid" => $this -> weid, ":from_user" => $openid, ":type" => $type));
			if (!empty($row)) {
				pdo_update($this -> member_table, array('from_user' => $openid), array('id' => $row['id']));
			} else {
				$data = array('weid' => $this -> weid, 'from_user' => $openid, 'type' => $type, 'status' => 0);
				pdo_insert($this -> member_table, $data);
			} 
		} 
	} 
	public function doWebZhaounit() {
		$this -> __web(__FUNCTION__);
	} 
	public function doWebZhaounitEdit() {
		$this -> __web(__FUNCTION__);
	} 
	public function doWebAuditCompanyStatusAjax() {
		global $_W, $_GPC;
		$company_id = $_GPC['company_id'];
		$status = $_GPC['change_to'];
		$data = array('status' => intval($status));
		$filter = array('id' => intval($company_id), 'weid' => $this -> weid);
		if (false !== pdo_update($this -> company_table, $data, $filter)) {
			exit('1');
		} else {
			exit('0');
		} 
	} 
	public function doWebAuditCompanyAuthAjax() {
		global $_W, $_GPC;
		$company_id = $_GPC['company_id'];
		$status = $_GPC['change_to'];
		$data = array('isauth' => intval($status));
		$filter = array('id' => intval($company_id));
		if (false !== pdo_update($this -> company_table, $data, $filter)) {
			exit('1');
		} else {
			exit('0');
		} 
	} 
	public function doWebDeleteCompanyAjax() {
		global $_W, $_GPC;
		$company_id = intval($_GPC['company_id']);
		$info = pdo_fetch("SELECT from_user FROM " . tablename($this -> company_table) . " WHERE id = :id LIMIT 1", array(":id" => $company_id));
		pdo_delete($this -> member_table, array('weid' => $this -> weid, 'from_user' => $info['from_user'], 'type' => 1));
		pdo_delete($this -> company_table, array('id' => $company_id));
	} 
	public function doWebAuditViewResumeTotal() {
		global $_W, $_GPC;
		$company_id = $_GPC['company_id'];
		if (checksubmit('save_info')) {
			$view_resume_total = $_GPC['view_resume_total'];
			$company_id = $_GPC['company_id'];
			if (false !== pdo_update($this -> company_table, array('view_resume_total' => $view_resume_total), array('id' => $company_id))) {
				message("保存成功", $this -> createWebUrl('Zhaounit'), 'success');
			} 
		} else {
			$row = pdo_fetch("SELECT `view_resume_total` FROM " . tablename($this -> company_table) . " WHERE id = :id ", array(":id" => $company_id));
			include $this -> template('audit_viewresumetotal');
		} 
	} 
	public function doWebAuditTopInfoStatusAjax() {
		global $_W, $_GPC;
		$info_id = $_GPC['info_id'];
		$status = $_GPC['change_to'];
		$data = array('istop' => intval($status), 'expiration' => 0);
		$filter = array('id' => intval($info_id));
		if (false !== pdo_update($this -> job_table, $data, $filter)) {
			exit('1');
		} else {
			exit('0');
		} 
	} 
	public function doWebAuditHotInfoStatusAjax() {
		global $_W, $_GPC;
		$info_id = $_GPC['info_id'];
		$status = $_GPC['change_to'];
		$data = array('ishot' => intval($status));
		$filter = array('id' => intval($info_id));
		if (false !== pdo_update($this -> job_table, $data, $filter)) {
			exit('1');
		} else {
			exit('0');
		} 
	} 
	public function doWebComments() {
		$this -> __web(__FUNCTION__);
	} 
	public function doWebCommentsEdit() {
		$this -> __web(__FUNCTION__);
	} 
	public function doWebAuditTopInfo() {
		global $_GPC, $_W;
		$config = $this -> get_config();
		if (checksubmit('save_topinfo')) {
			$data = array('istop' => 1, 'expiration' => strtotime($_GPC['expiration']));
			$filter = array('id' => intval($_GPC['info_id']));
			if (false !== pdo_update($this -> job_table, $data, $filter)) {
				message("有效期设置成功", $this -> createWebUrl('Zhaoinfo'), 'success');
			} 
		} else {
			$info_id = intval($_GPC['info_id']);
			load() -> func('tpl');
			include $this -> template('top_info');
		} 
	} 
	public function doWebZhaoinfo() {
		$this -> __web(__FUNCTION__);
	} 
	public function doWebZhaoinfoEdit() {
		$this -> __web(__FUNCTION__);
	} 
	public function doWebZhaoinfoDeleteAjax() {
		global $_W, $_GPC;
		$id = intval($_GPC['info_id']);
		if (pdo_delete($this -> job_table, array('id' => $id))) {
			exit('1');
		} else {
			exit('0');
		} 
	} 
	public function doWebSetShareInfo() {
		global $_GPC, $_W;
		if (checksubmit('save_shareinfo_submit')) {
			$shareid = intval($_GPC['shareid']);
			$data = $_GPC['data'];
			if ($shareid) {
				if (pdo_update($this -> share_table, $data, array('id' => $shareid))) {
					message('更新成功', referer(), 'success');
				} else {
					message('更新失败，联系作者', referer(), 'error');
				} 
			} else {
				if (pdo_insert($this -> share_table, $data)) {
					message('添加成功', referer(), 'success');
				} else {
					message('添加失败，联系作者', referer(), 'error');
				} 
			} 
		} else {
			$share = pdo_fetch("SELECT * FROM " . tablename($this -> share_table));
			load() -> func('tpl');
			include $this -> template('shareinfo');
		} 
	} 
	public function doWebCategory() {
		$this -> __web(__FUNCTION__);
	} 
	public function doWebDeleteCategoryAjax() {
		global $_GPC, $_W;
		$ret = pdo_fetch("SELECT * FROM " . tablename($this -> category_table) . " WHERE parent_id = :parent_id LIMIT 1", array(":parent_id" => intval($_GPC['cid'])));
		if ($ret !== false) {
			exit('-2');
		} else {
			if (false !== pdo_query("DELETE FROM " . tablename($this -> category_table) . " WHERE id = :id LIMIT 1", array(":id" => intval($_GPC['cid'])))) {
				exit('删除成功');
			} else {
				exit('操作失败');
			} 
		} 
	} 
	public function doWebIndustry() {
		$this -> __web(__FUNCTION__);
	} 
	public function doWebDeleteIndustryAjax() {
		global $_GPC, $_W;
		$ret = pdo_fetch("SELECT * FROM " . tablename($this -> industry_table) . " WHERE parent_id = :parent_id LIMIT 1", array(":parent_id" => intval($_GPC['cid'])));
		if ($ret !== false) {
			exit('-2');
		} else {
			if (false !== pdo_query("DELETE FROM " . tablename($this -> industry_table) . " WHERE id = :id LIMIT 1", array(":id" => intval($_GPC['cid'])))) {
				exit('删除成功');
			} else {
				exit('操作失败');
			} 
		} 
	} 
	public function doWebResume() {
		global $_GPC, $_W;
		$config = $this -> get_config();
		$pindex = max(1, intval($_GPC['page']));
		$psize = 15;
		$condition = " weid=" . $this -> weid;
		if ($_GPC['username']) {
			$condition .= " and username like '%" . $_GPC['username'] . "%'";
		} 
		if ($_GPC['mobile']) {
			$condition .= " and mobile like '%" . $_GPC['mobile'] . "%'";
		} 
		if ($_GPC['deleterec']) {
			pdo_query("delete from " . tablename($this -> person_table) . " WHERE {$condition}");
		} 
		$sql = "SELECT * FROM " . tablename($this -> person_table) . " WHERE {$condition} LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
		$persons = pdo_fetchall($sql);
		$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this -> person_table) . " WHERE $condition");
		$pager = pagination($total, $pindex, $psize);
		include $this -> template('resume');
	} 
	public function doWebWork_experience() {
		$this -> __web(__FUNCTION__);
	} 
	public function doWebWork_experience_set() {
		$this -> __web(__FUNCTION__);
	} 
	public function doWebResumeEdit() {
		$this -> __web(__FUNCTION__);
	} 
	public function doWebResumeDeleteAjax() {
		global $_W, $_GPC;
		$personid = $_GPC['personid'];
		$info = pdo_fetch("SELECT from_user FROM " . tablename($this -> person_table) . " WHERE id = :id LIMIT 1", array(":id" => $personid));
		pdo_delete($this -> resume_table, array('weid' => $this -> weid, 'person_id' => $personid));
		pdo_delete($this -> member_table, array('weid' => $this -> weid, 'from_user' => $info['from_user'], 'type' => 2));
		pdo_delete($this -> person_table, array('id' => $personid));
	} 
	public function doWebAuditResumeTopInfoAjax() {
		global $_W, $_GPC;
		$person_id = $_GPC['person_id'];
		$status = $_GPC['change_to'];
		$data = array('istop' => intval($status), 'expiration' => 0);
		$filter = array('id' => intval($person_id));
		if (false !== pdo_update($this -> person_table, $data, $filter)) {
			exit('1');
		} else {
			exit('0');
		} 
	} 
	public function doWebAuditResumeTopInfo() {
		global $_GPC, $_W;
		$config = $this -> get_config();
		if (checksubmit('save_topinfo')) {
			$validity = intval($_GPC['validity']);
			$data = array('istop' => 1, 'expiration' => strtotime(" +" . $validity . " days"));
			$filter = array('id' => intval($_GPC['person_id']));
			if (false !== pdo_update($this -> person_table, $data, $filter)) {
				message("有效期设置成功", $this -> createWebUrl('Resume'), 'success');
			} 
		} else {
			$person_id = intval($_GPC['person_id']);
			include $this -> template('resume_top_info');
		} 
	} 
	public function doWebADSlider() {
		$this -> __web(__FUNCTION__);
	} 
	public function doWebADSliderDeleteAjax() {
		global $_GPC, $_W;
		if (pdo_delete($this -> ads_table, array("id" => intval($_GPC['id'])))) {
			exit('删除成功');
		} else {
			exit('删除失败');
		} 
	} 
	public function doWebShare() {
		global $_GPC, $_W;
		if (checksubmit('save_shareinfo_submit')) {
			$shareid = $_GPC['shareid'];
			$data = $_GPC['data'];
			if (empty($shareid)) {
				$data = array_merge($data, array('uniacid' => $this -> weid));
				if (pdo_insert($this -> share_table, $data)) {
					message("添加成功", referer(), 'success');
				} else {
					message("添加失败", referer(), 'error');
				} 
			} else {
				if (pdo_update($this -> share_table, $data, array('id' => $shareid))) {
					message("更新成功", referer(), 'success');
				} else {
					message("更新失败", referer(), 'error');
				} 
			} 
		} else {
			$share = pdo_fetch("SELECT * FROM " . tablename($this -> share_table) . " WHERE uniacid = :uniacid LIMIT 1", array(':uniacid' => $this -> weid));
			load() -> func('tpl');
			include $this -> template('share');
		} 
	} 
	public function doWebForm() {
		global $_W, $_GPC;
		$do = $do ? $do : 'display';
		$profile_row = pdo_fetch("SELECT * FROM " . tablename('q_3354988381_rencai_profile') . " WHERE `key`='deal_form_fields' and `val`='N'");
		if ($profile_row) {
			$sql = "delete from " . tablename('q_3354988381_rencai_form') . " ";
			pdo_query($sql);
			$sql = "update " . tablename('q_3354988381_rencai_profile') . " set `val`='Y' WHERE `key`='deal_form_fields'";
			pdo_query($sql);
		} else {
			$p = pdo_fetch("SELECT * FROM " . tablename('q_3354988381_rencai_form') . " WHERE uniacid = :weid AND field = :field LIMIT 1", array(":weid" => $this -> weid, ":field" => 'person_province'));
			if (!$p) {
				$data = array('user_label' => '', 'show' => 0, 'sort' => 0, 'uniacid' => $this -> _uniacid, 'field' => 'person_province', 'label' => '所在城市',);
				pdo_insert('q_3354988381_rencai_form', $data);
			} 
		} 
		$fields_arr = $this -> getFieldsArr();
		if (checksubmit()) {
			$condition = " uniacid=" . $this -> _uniacid;
			foreach ($fields_arr[$_GPC['fields_type']] as $field => $field_item) {
				$user_label = $_GPC['user_label_' . $field];
				$show = $_GPC['show_' . $field];
				$sort = $_GPC['sort_' . $field];
				$sql = "SELECT * FROM " . tablename('q_3354988381_rencai_form') . " WHERE $condition and field='$field' limit 1";
				$form_data = pdo_fetch($sql);
				if ($form_data) {
					$data = array('user_label' => $user_label, 'show' => $show, 'sort' => $sort,);
					pdo_update('q_3354988381_rencai_form', $data, array('id' => $form_data['id']));
				} else {
					list($title, $label_info) = explode('|', $field_item);
					$data = array('user_label' => $user_label, 'show' => $show, 'sort' => $sort, 'uniacid' => $this -> _uniacid, 'field' => $field, 'label' => $title,);
					pdo_insert('q_3354988381_rencai_form', $data);
				} 
			} 
			message("保存成功", $this -> createWebUrl('form'), 'success');
		} 
		$fields_list = $this -> getFieldsSaveValArr();
		include $this -> template('fields');
	} 
	public function getPublicIndexProfile() {
		global $_W, $_GPC;
		$public_index_arr = pdo_fetch("SELECT `val`,remark FROM " . tablename('q_3354988381_rencai_profile') . " WHERE `key`='public_index_logo' and `weid`='" . $this -> weid . "'");
		$public_index_arr['company_logo'] = $public_index_arr['val'] ? $this -> get_rencai_pic($public_index_arr['val']) : '../addons/q_3354988381_rencai/template/static/images/company_logo.png';
		return $public_index_arr;
	} 
	public function doWebIndex_theme() {
		global $_W, $_GPC;
		if ($_GPC['op'] == 'delete') {
			$id = intval($_GPC['id']);
			$row = pdo_fetch("SELECT id FROM " . tablename('q_3354988381_rencai_positiontype') . " WHERE id = :id and weid='" . $this -> weid . "'", array(':id' => $id));
			if (empty($row)) {
				message('抱歉，信息不存在或是已经被删除！');
			} 
			pdo_delete('q_3354988381_rencai_positiontype', array('id' => $id));
			message('删除成功！', referer(), 'success');
		} 
		if (checksubmit('submit')) {
			$condition = " c.weid=" . $this -> weid;
			$sql = "SELECT c.* " . "FROM " . tablename('q_3354988381_rencai_positiontype') . " c " . "WHERE $condition " . "ORDER BY c.id DESC";
			$list_data = pdo_fetchall($sql);
			foreach ($list_data as $row) {
				$id = $row['id'];
				$data = array('sort' => $_GPC['sort_' . $id], 'name' => $_GPC['name_' . $id], 'logo' => $_GPC['logo_' . $id],);
				pdo_update('q_3354988381_rencai_positiontype', $data, array('id' => $id));
			} 
			if ($_GPC['name']) {
				$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('q_3354988381_rencai_positiontype') . " WHERE name='" . $_GPC['name'] . "' and weid='" . $this -> weid . "'");
				if ($total <= 0) {
					pdo_insert('q_3354988381_rencai_positiontype', array('logo' => $_GPC['logo'], 'name' => $_GPC['name'], 'sort' => intval($_GPC['sort']), 'weid' => $this -> weid));
				} 
			} 
			$theme_type = $_GPC['theme_type'];
			pdo_update('q_3354988381_rencai_profile', array('val' => $theme_type), array('key' => 'index_theme', 'weid' => $this -> weid));
		} 
		if (checksubmit('submit2') && $_GPC['public_index_logo']) {
			$condition = " c.weid=" . $this -> weid;
			$sql = "SELECT c.* " . "FROM " . tablename('q_3354988381_rencai_profile') . " c " . "WHERE $condition and `key`='public_index_logo'";
			$tmp_data = pdo_fetch($sql);
			if ($tmp_data) {
				pdo_update('q_3354988381_rencai_profile', array('val' => $_GPC['public_index_logo'], 'remark' => $_GPC['public_index_admsg']), array('key' => 'public_index_logo', 'weid' => $this -> weid));
			} else {
				pdo_insert('q_3354988381_rencai_profile', array('val' => $_GPC['public_index_logo'], 'remark' => $_GPC['public_index_admsg'], 'key' => 'public_index_logo', 'weid' => $this -> weid));
			} 
		} 
		$public_index_arr = $this -> getPublicIndexProfile();
		$public_index_logo = $public_index_arr['val'];
		$public_index_admsg = $public_index_arr['remark'];
		$public_index_admsg = $public_index_admsg ? $public_index_admsg : '招人才、找工作就用微人才微招聘，安全靠谱！';
		$theme_flag = $this -> getPositionTypeFlag();
		$condition = " c.weid=" . $this -> weid;
		$sql = "SELECT c.* " . "FROM " . tablename('q_3354988381_rencai_positiontype') . " c " . "WHERE $condition " . "ORDER BY c.sort ASC, id DESC";
		$list_data = pdo_fetchall($sql);
		load() -> func('tpl');
		include $this -> template('index_theme');
	} 
	public function doWebYouhui_set() {
		$this -> __web(__FUNCTION__);
	} 
	public function get_rencai_pic($pic_dir) {
		global $_W, $_GPC;
		if (strstr($pic_dir, 'q_3354988381_rencai')) {
			return $_W['siteroot'] . 'attachment/' . $pic_dir;
		} else {
			return $_W['attachurl'] . $pic_dir;
		} 
	} 
	private function get_resume_price($person_id) {
		$person_data = $this -> get_table_row('q_3354988381_rencai_person', $person_id);
		if ($person_data['price']) {
			return $person_data['price'];
		} else {
			$this -> module['config']['price_per_resume'];
		} 
	} 
	private function do_share_award($company_id, $person_id, $price_per_resume) {
		global $_W, $_GPC;
		if (!$price_per_resume) {
			return;
		} 
		$company_row = $this -> get_table_row('q_3354988381_rencai_company', $company_id);
		$person_row = $this -> get_table_row('q_3354988381_rencai_person', $person_id);
		$recommend_award_company = $this -> getConfigArr('recommend_award_company');
		$recommend_award_person = $this -> getConfigArr('recommend_award_person');
		if ($company_row['invite_id'] && $recommend_award_company) {
			$award_money = number_format($recommend_award_company * $price_per_resume / 100, 2);
			pdo_query("update " . tablename('q_3354988381_rencai_company_money') . " set money=money+{$award_money}, updatetime=NOW() where company_id={$company_row['invite_id']}");
			$in_data = array('weid' => $this -> weid, 'type' => 'C', 'inviter' => $company_row['invite_id'], 'invited' => $company_id, 'award_price' => $award_money, 'create_at' => date('Y-m-d H:i:s'));
			pdo_insert('q_3354988381_rencai_invite_award', $in_data);
		} 
		if ($person_row['invite_id'] && $recommend_award_person) {
			$award_money = number_format($recommend_award_person * $price_per_resume / 100, 2);
			$person_money_row = $this -> get_table_row('q_3354988381_rencai_person_money', $person_row['invite_id'], 'person_id');
			if (!$person_money_row) {
				pdo_insert('q_3354988381_rencai_person_money', array('person_id' => $person_row['invite_id'], 'money' => $award_money, 'updatetime' => date('Y-m-d H:i:s')));
			} else {
				pdo_query("update " . tablename('q_3354988381_rencai_person_money') . " set money=money+{$award_money}, updatetime=NOW() where person_id={$person_row['invite_id']}");
			} 
			$in_data = array('weid' => $this -> weid, 'type' => 'P', 'inviter' => $person_row['invite_id'], 'invited' => $person_id, 'award_price' => $award_money, 'create_at' => date('Y-m-d H:i:s'));
			pdo_insert('q_3354988381_rencai_invite_award', $in_data);
		} 
	} 
	private function company_paid_money($pay_type = 'look_resume', $company_id, $person_id, $invite_id = 0) {
		global $_W;
		if ($pay_type == 'look_resume') {
			$sql_where = "and company_id='$company_id' and person_id='$person_id' and weid='" . $this -> weid . "'";
			$sql = "SELECT * FROM " . tablename('q_3354988381_rencai_company_lookresume') . " WHERE 1 $sql_where";
			if ($this -> _view_resume_need_agree) {
				if (pdo_fetch($sql)) {
					$invite_data = $this -> get_table_row('q_3354988381_rencai_company_lookresume', $invite_id);
					if (($invite_data && $invite_data['person_agree'] == '') || $invite_data['person_agree_payflag'] == 'Y') {
						return true;
					} 
					$company_id = $invite_data['company_id'];
					$person_id = $invite_data['person_id'];
					$price_per_resume = $this -> get_resume_price($person_id);
					$company = $this -> get_person_company_row(1, $this -> from_user, '', true);
					$my_money = $company['company_curr_money'];
					if ($my_money >= $price_per_resume) {
						pdo_query("update " . tablename('q_3354988381_rencai_company_money') . " set money=money-{$price_per_resume},money_youhui_get=money_youhui_get-{$price_per_resume}, updatetime=NOW() where company_id='$company_id'");
						$award_of_send_resume = $price_per_resume * $this -> getConfigArr('award_of_send_resume') / 100;
						pdo_update('q_3354988381_rencai_company_lookresume', array('person_agree_payflag' => 'Y', 'award_of_send_resume' => $award_of_send_resume), array('id' => $invite_id));
						$tmp_data = $this -> get_table_row('q_3354988381_rencai_person_money', $person_id, 'person_id');
						if ($tmp_data) {
							pdo_query("update " . tablename('q_3354988381_rencai_person_money') . " set money=money+{$award_of_send_resume} where person_id={$person_id}");
						} else {
							pdo_insert('q_3354988381_rencai_person_money', array('person_id' => $person_id, 'money' => $award_of_send_resume, 'updatetime' => date('Y-m-d H:i:s')));
						} 
						$this -> do_share_award($company_id, $person_id, $price_per_resume);
						$company_row = $this -> get_table_row('q_3354988381_rencai_company', $company_id);
						$person_row = $this -> get_table_row('q_3354988381_rencai_person', $person_id);
						$info_con = array('title' => '付费通知', 'description' => '您查看了' . $person_row['username'] . '的简历，查看费用为￥' . $price_per_resume . '元！', 'url' => $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=q_3354988381_rencai&do=viewsumelist&companyid=" . $company_id,);
						$res_tpl = $this -> send_notify_other_api($company_row['from_user'], $info_con, 'I');
						return 2;
					} else {
						return false;
					} 
				} else {
					$price_per_resume = $this -> get_resume_price($person_id);
					$company = $this -> get_person_company_row(1, $this -> from_user, '', true);
					$my_money = $company['company_curr_money'];
					if ($my_money < $price_per_resume) {
						return false;
					} 
					$data = array('weid' => $this -> weid, 'company_id' => $company_id, 'person_id' => $person_id, 'fee' => $price_per_resume, 'createat' => date('Y-m-d H:i:s'),);
					if ($this -> getConfigArr('view_need_person_agree') != 'Y') {
						$data['person_agree'] = 'Y';
					} 
					pdo_insert('q_3354988381_rencai_company_lookresume', $data);
					$company_row = $this -> get_table_row('q_3354988381_rencai_company', $company_id);
					$person_row = $this -> get_table_row('q_3354988381_rencai_person', $person_id);
					$info_con = array('title' => '申请通知', 'description' => ($company_row['name'] . '企业向你发出了查看简历请求！'), 'url' => $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=q_3354988381_rencai&do=invitemine&person_id=" . $person_id,);
					$res_tpl = $this -> send_notify_other_api($person_row['from_user'], $info_con, 'I');
					return true;
				} 
			} else {
				if (pdo_fetch($sql)) {
					return true;
				} else {
					$company = $this -> get_person_company_row(1, $this -> from_user, '', true);
					$my_money = $company['company_curr_money'];
					$price_per_resume = $this -> get_resume_price($person_id);
					if ($my_money >= $price_per_resume) {
						$data = array('weid' => $this -> weid, 'company_id' => $company_id, 'person_id' => $person_id, 'fee' => $price_per_resume, 'createat' => date('Y-m-d H:i:s'), 'person_agree' => 'Y',);
						pdo_insert('q_3354988381_rencai_company_lookresume', $data);
						pdo_update('q_3354988381_rencai_company_money', array('money' => $my_money - $price_per_resume, 'updatetime' => date('Y-m-d H:i:s')), array('company_id' => $company_id));
						$this -> do_share_award($company_id, $person_id, $price_per_resume);
						return true;
					} 
				} 
			} 
		} 
		return false;
	} 
	private function get_table_row($table_name, $id, $primary_key = 'id', $sql_where = '') {
		if ($sql_where) {
			$sql = "SELECT * FROM " . tablename($table_name) . " WHERE $sql_where";
		} else {
			$sql = "SELECT * FROM " . tablename($table_name) . " WHERE {$primary_key}='$id' limit 1";
		} 
		return pdo_fetch($sql);
	} 
	private function get_notify_tpl() {
		$person_field_arr = array('username' => '姓名', 'sex' => '性别', 'from_user' => 'Openid', 'age' => '年龄', 'educational' => '学历', 'professional' => '专业', 'mobile' => '手机', 'QQ' => 'QQ号', 'workexperience' => '工作年限', 'workaddress' => '期望工作地点', 'assessment' => '自我评价', 'cid' => '申请职位分类', 'title' => '申请职位名称', 'positiontype' => '申请职位类型',);
		$company_field_arr = array('name' => '公司名称', 'industry' => '公司所属行业', 'address' => '公司地址', 'contact' => '联系人', 'mobile' => '联系电话', 'scale' => '公司规模', 'type' => '公司性质', 'description' => '公司简介');
		return array('person_field_arr' => $person_field_arr, 'company_field_arr' => $company_field_arr);
	} 
	private function doMobileTest_api() {
		echo $res = $this -> send_notify_api('tpl_person', 15, 38);
		echo '---';
	} 
	private function L($info) {
		load() -> func('logging');
		logging_run($info);
	} 
	private function send_notify_other_api($openid, $send_content, $msgtype = 'M') {
		global $_W, $_GPC;
		$notify_auth_key = $this -> module['config']['notify_auth_key'];
		if (!$notify_auth_key) {
			return '未设置第三方调用时的授权密钥！';
		} 
		$api_url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=q_3354988381_notify&do=notifyapi";
		$send_arr = array('openid' => $openid, 'key' => md5($openid), 'caller' => '微人才微招聘', 'authkey' => $notify_auth_key, 'msgtype' => $msgtype,);
		if ($msgtype == 'M') {
			$send_arr['content'] = htmlspecialchars_decode(strip_tags($send_content));
		} else if ($msgtype == 'I') {
			$send_arr['info_id'] = '';
			$content = array('title' => urlencode($send_content['title']), 'description' => urlencode($send_content['description']), 'url' => $send_content['url'],);
			if ($send_content['logo']) {
				$content['picurl'] = $_W['attachurl'] . $send_content['logo'];
			} 
			$send_arr['info_content'] = $content;
		} 
		$data = http_build_query($send_arr);
		$opts = array('http' => array('method' => "POST", 'header' => "Content-type: application/x-www-form-urlencoded\r\n" . "Content-length:" . strlen($data) . "\r\n" . "Cookie: foo=bar\r\n" . "\r\n", 'content' => $data,));
		$cxContext = stream_context_create($opts);
		$api_res = file_get_contents($api_url, false, $cxContext);
		$api_res = json_decode($api_res, 1);
		if ($api_res['status'] == 1) {
			return '成功';
		} else {
			return '失败：' . $api_res['res'];
		} 
	} 
	private function send_notify_api($tpl_name = 'tpl_person', $rec_id, $send_id) {
		global $_W, $_GPC;
		$notify_auth_key = $this -> module['config']['notify_auth_key'];
		if (!$notify_auth_key) {
			return '未设置第三方调用时的授权密钥！';
		} 
		$save_tpl_arr = array('tpl_person' => 'person_field_arr', 'tpl_company' => 'company_field_arr');
		$tpl_name = $save_tpl_arr[$tpl_name];
		$notify_tpl = $this -> get_notify_tpl();
		$person_field_arr = $notify_tpl[$tpl_name];
		if (!is_array($person_field_arr)) {
			return '模板不存在！';
		} 
		$send_content = '';
		$config = $this -> get_config();
		if ($tpl_name == 'person_field_arr') {
			$condition = " content_type='tpl_person' and weid=" . $this -> weid;
			$sql = "SELECT content FROM " . tablename('q_3354988381_rencai_notify') . "  WHERE $condition and type='M'";
			$send_content = pdo_fetchcolumn($sql);
			$sql = "SELECT * FROM " . tablename('q_3354988381_rencai_person') . "  WHERE id='$rec_id'";
			$user_data = pdo_fetch($sql);
			foreach ($person_field_arr as $field => $field_name) {
				if (in_array($field, array('cid', 'title', 'positiontype')) || !isset($user_data[$field])) {
					continue;
				} 
				$val = $user_data[$field];
				if ($field == 'sex') {
					$val = ($val == 1 ? '男' : '女');
				} 
				if ('educational' == $field) {
					$send_content = str_replace('{{' . $field . '}}', $config[$field][$val], $send_content);
				} else {
					$send_content = str_replace('{{' . $field . '}}', $val, $send_content);
				} 
			} 
			$condition = "c.weid=" . $this -> weid;
			$sql = "SELECT job.title, c.from_user, ct.name as cid_name, po.name as positiontype_name FROM " . tablename('q_3354988381_rencai_company') . " c " . "LEFT JOIN " . tablename('q_3354988381_rencai_job') . " job ON c.id=job.mid " . "LEFT JOIN " . tablename('q_3354988381_rencai_category') . " ct ON job.cid=ct.id " . "LEFT JOIN " . tablename('q_3354988381_rencai_positiontype') . " po ON job.positiontype=po.id " . "WHERE $condition and job.id='$send_id'";
			$company_data = pdo_fetch($sql);
			$openid = $company_data['from_user'];
			$send_content = str_replace('{{cid}}', $company_data['cid_name'], $send_content);
			$send_content = str_replace('{{title}}', $company_data['title'], $send_content);
			$send_content = str_replace('{{positiontype}}', $company_data['positiontype_name'], $send_content);
		} else if ($tpl_name == 'company_field_arr') {
			$condition = " content_type='tpl_company' and weid=" . $this -> weid;
			$sql = "SELECT content FROM " . tablename('q_3354988381_rencai_notify') . "  WHERE $condition and type='M'";
			$send_content = pdo_fetchcolumn($sql);
			$sql = "SELECT * FROM " . tablename('q_3354988381_rencai_company') . "  WHERE id='$send_id'";
			$company_data = pdo_fetch($sql);
			foreach ($person_field_arr as $field => $field_name) {
				if (!isset($company_data[$field])) {
					continue;
				} 
				$val = $company_data[$field];
				if ($field == 'industry') {
					$industry = pdo_fetch("SELECT name FROM " . tablename($this -> industry_table) . " WHERE id = :id AND weid = :weid LIMIT 1", array(":id" => $val, ":weid" => $this -> weid));
					$val = $industry['name'];
				} else if ($field == 'scale') {
					$val = $config['scale'][$val];
				} else if ($field == 'type') {
					$val = $config['companytype'][$val];
				} 
				$send_content = str_replace('{{' . $field . '}}', $val, $send_content);
			} 
			$openid = pdo_fetchcolumn("SELECT from_user FROM " . tablename($this -> person_table) . " WHERE id = :id", array(":id" => $rec_id), 0);
		} 
		$send_content = str_replace(array('<p>', '</p>'), array('', ''), html_entity_decode($send_content));
		$api_url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=q_3354988381_notify&do=notifyapi";
		$send_arr = array('openid' => $openid, 'key' => md5($openid), 'caller' => '微人才微招聘', 'authkey' => $notify_auth_key, 'msgtype' => 'M', 'content' => htmlspecialchars_decode(strip_tags($send_content)),);
		$data = http_build_query($send_arr);
		$opts = array('http' => array('method' => "POST", 'header' => "Content-type: application/x-www-form-urlencoded\r\n" . "Content-length:" . strlen($data) . "\r\n" . "Cookie: foo=bar\r\n" . "\r\n", 'content' => $data,));
		$cxContext = stream_context_create($opts);
		$api_res = file_get_contents($api_url, false, $cxContext);
		$api_res = json_decode($api_res, 1);
		if ($api_res['status'] == 1) {
			return '成功';
		} else {
			return '失败：' . $api_res['res'];
		} 
	} 
	private function showInfoMsg($ui_info_arr) {
		global $_W, $_GPC;
		$ui_info_arr = $ui_info_arr;
		include $this -> template('ui_info');
		exit;
	} 
	public function doMobileDeleteAjax() {
		global $_W, $_GPC;
		if (pdo_delete($this -> job_table, array('id' => $_GPC['jobid'], 'mid' => $_SESSION['curr_person_id']))) {
			exit('1');
		} else {
			exit('0');
		} 
	} 
	public function upload_img($upload_name, $asname = '', $thumb = true, $width = 320, $height = 240, $position = 5) {
		load() -> func('file');
		$upfile = $_FILES[$upload_name];
		$name = $upfile['name'];
		$type = $upfile['type'];
		$size = $upfile['size'];
		$tmp_name = $upfile['tmp_name'];
		$error = $upfile['error'];
		$upload_path = $this -> _attach_dir;
		if (intval($error) > 0) {
			message('上传错误：错误代码：' . $upload_name . '-' . $error, referer(), 'error');
		} else {
			$maxfilesize = empty($this -> module['config']['maxfilesize']) ? 2 : intval($this -> module['config']['maxfilesize']);
			if ($maxfilesize > 0) {
				if ($size > $maxfilesize * 1024 * 1024) {
					message('上传文件不得超过 ' . $maxfilesize . ' M' . $_FILES[$upload_name]["error"], referer(), 'error');
				} 
			} 
			$uptypes = array('image/jpg', 'image/png', 'image/jpeg');
			if (!in_array($type, $uptypes)) {
				message('上传文件类型不符：' . $type, referer(), 'error');
			} 
			if (!file_exists($upload_path)) {
				mkdir($upload_path);
			} 
			$source_filename = $asname . date("YmdHis") . '.jpg';
			if (!move_uploaded_file($tmp_name, $upload_path . $source_filename)) {
				message('移动文件失败，请检查目录权限-' . $upload_path, referer(), 'error');
			} 
			$srcfile = $upload_path . $source_filename;
			$desfile = date("YmdHis") . '_' . $asname . '.thumb.jpg';
			if ($thumb) {
				file_image_thumb($srcfile, $upload_path . $desfile, $width);
			} else {
				file_image_crop($srcfile, $upload_path . $desfile, $width, $height, 5);
			} 
			return $desfile;
		} 
	} 
	private function exist_openid($openid) {
		global $_GPC, $_W;
		$p = pdo_fetch("SELECT * FROM " . tablename('mc_mapping_fans') . " WHERE uniacid = :weid AND openid = :openid LIMIT 1", array(":weid" => $this -> weid, ":openid" => $openid));
		if ($p) {
			return true;
		} else {
			return false;
		} 
	} 
	public function getFollow() {
		global $_GPC, $_W;
		$p = pdo_fetch("SELECT follow FROM " . tablename('mc_mapping_fans') . " WHERE uniacid = :weid AND openid = :openid LIMIT 1", array(":weid" => $this -> weid, ":openid" => $this -> from_user));
		if ($this -> from_user) {
			return true;
		} 
		if (intval($p['follow']) == 0) {
			header('Location: ' . $this -> createMobileUrl('FansUs'), true, 301);
		} else {
			return true;
		} 
	} 
	private function xxxpost_curl($url, $post = '') {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		return json_decode($data, 1);
	} 
	private function xxxget_curl($url) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		return json_decode($data, 1);
	} 
	private function doMobileGetToken() {
		global $_GPC, $_W;
		$appid = $_W['account']['key'];
		$secret = $_W['account']['secret'];
		$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $secret . '&code=' . $_GPC['code'] . '&grant_type=authorization_code';
		$data = $this -> get_curl($url);
		if (empty($data)) {
			$data = file_get_contents($url);
			$data = json_decode($data, 1);
		} 
		$oauth_openid = "Q_3354988381_Rencai_" . $_W['uniacid'];
		setcookie($oauth_openid, $data['openid'], time() + self :: $COOKIE_DAYS * 24 * 60 * 60);
		header('Location:' . $this -> createMobileUrl('index'), true, 301);
	} 
	private function get_html($url) {
		if (function_exists('curl_init')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$return = curl_exec($ch);
			if (curl_errno($curl)) {
				echo 'Errno' . curl_error($ch);
				exit;
			} 
			curl_close($ch);
			return $return;
		} 
		return false;
	} 
	public function doMobileGetCode($from_method = '') {
		global $_GPC, $_W;
		$from_method = $from_method ? $from_method : $_GPC['do'];
		$level = $_W['account']['level'];
		$oauth_openid = "Q_3354988381_Rencai_" . $_W['uniacid'];
		if ($level == 4) {
			if (empty($_COOKIE[$oauth_openid])) {
				$appid = $_W['account']['key'];
				$secret = $_W['account']['secret'];
				$appsecret = $secret;
				$wei_id_i = $_GPC['i'];
				$back_url = $_W['siteroot'] . 'app' . substr($this -> createMobileUrl('getcode', array('frmthd' => $from_method)), 1);
				$back_url = urlencode($back_url);
				if ($_GET['code']) {
					$code = $_GET['code'];
					$code_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $code . '&grant_type=authorization_code';
					$uwr_arr = json_decode($this -> get_html($code_url), 1);
					if ($uwr_arr['openid']) {
						$openid = $uwr_arr['openid'];
						setcookie($oauth_openid, $openid, time() + self :: $COOKIE_DAYS * 24 * 3600);
						$back_url = $_W['siteroot'] . 'app' . substr($this -> createMobileUrl($_GPC['frmthd'] ? $_GPC['frmthd'] : 'index'), 1);
						header('location:' . $back_url, true, 301);
						exit;
					} 
				} else {
					$code_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . $back_url . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
					header('location:' . $code_url);
					exit;
				} 
			} 
		} else {
			$appid = $this -> module['config']['svs_appid'];
			$appsecret = $this -> module['config']['svs_appsecret'];
			if ($appid && $appsecret) {
				$wei_id_i = $_GPC['i'];
				$back_url = urlencode($_W['siteroot'] . 'app/index.php?i=' . $wei_id_i . '&j=' . $wei_id_i . '&c=entry&do=getcode&m=q_3354988381_rencai&frmthd=' . $from_method);
				if ($_GET['code']) {
					$code = $_GET['code'];
					$code_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $code . '&grant_type=authorization_code';
					$uwr_arr = json_decode($this -> get_html($code_url), 1);
					if (!$uwr_arr['unionid']) {
						$u_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $uwr_arr['access_token'] . '&openid=' . $uwr_arr['openid'] . '&lang=zh_CN';
						$u_info_arr = json_decode($this -> get_html($u_info_url), 1);
						$uwr_arr['unionid'] = $u_info_arr['unionid'];
					} 
					if ($uwr_arr['unionid']) {
						$sql = "select * from" . tablename("mc_mapping_fans") . "where uniacid='" . $this -> weid . "' and unionid = '" . $uwr_arr['unionid'] . "' ";
						$reg_arr = pdo_fetch($sql);
						if ($reg_arr) {
							$_SESSION['user_openid'] = $reg_arr['openid'];
						} else if ($_W['fans']['from_user']) {
							$sql = "select * from" . tablename("mc_mapping_fans") . " where openid = '" . $_W['fans']['from_user'] . "' and acid='" . $_W['weid'] . "' ";
							$reg_arr = pdo_fetch($sql);
							if ($reg_arr) {
								$_SESSION['user_openid'] = $_W['fans']['from_user'];
							} 
						} 
						if ($_SESSION['user_openid']) {
							$openid = $_SESSION['user_openid'];
							setcookie($oauth_openid, $openid, time() + self :: $COOKIE_DAYS * 24 * 3600);
							$back_url = $_W['siteroot'] . 'app' . substr($this -> createMobileUrl($_GPC['frmthd'] ? $_GPC['frmthd'] : 'index'), 1);
							header('location:' . $back_url, true, 301);
							exit;
						} 
					} 
				} else {
					$code_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . $back_url . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
					header('location:' . $code_url);
					exit;
				} 
			} 
		} 
	} 
	private function get_user_avatar($from_user_openid, $key = '') {
		global $_W, $_GPC;
		$condition = " fans.uniacid='" . $this -> weid . "' and fans.openid='" . $from_user_openid . "'";
		$sql = "SELECT fans.nickname, fans.unionid, mem.credit1, mem.credit2, mem.avatar " . "FROM " . tablename('mc_mapping_fans') . " fans " . "LEFT JOIN " . tablename('mc_members') . " mem ON fans.uid=mem.uid " . "WHERE $condition LIMIT 1";
		$member_arr = pdo_fetch($sql);
		if ($key) {
			return @$member_arr[$key];
		} 
		return $member_arr;
	} 
	private function get_user_header_pic($from_user = '', $sex = 1) {
		global $_GPC, $_W;
		$from_user = $from_user ? $from_user : $this -> from_user;
		$sex = $sex ? $sex : 1;
		$header_pic = $this -> get_user_avatar($from_user, 'avatar');
		if (!$header_pic) {
			if ($sex == 1) {
				$header_pic = $_W['siteroot'] . 'addons/q_3354988381_rencai/template/static/images/default_man.jpg';
			} else {
				$header_pic = $_W['siteroot'] . 'addons/q_3354988381_rencai/template/static/images/default_woman.jpg';
			} 
		} 
		return $header_pic;
	} 
	private function makeQrcodeFile($order_num) {
		global $_GPC, $_W;
		$prefix = $this -> module['config']['prefix'];
		require (IA_ROOT . '/framework/library/qrcode/phpqrcode.php');
		load() -> func('file');
		if (!file_exists(ATTACHMENT_ROOT . '/q_3354988381_rencai')) {
			mkdirs(ATTACHMENT_ROOT . '/q_3354988381_rencai');
		} 
		$filename = ATTACHMENT_ROOT . '/q_3354988381_rencai/' . $order_num . '.png';
		QRcode :: png($prefix . ":" . $order_num, $filename, 'L', 6, 2);
	} 
	private function getCheckQrcodeUrl($order_num) {
		global $_W;
		return $this -> get_rencai_pic('/q_3354988381_rencai/' . $order_num . '.png');
	} 
	private function getPositionTypeFlag() {
		$condition = " and weid=" . $this -> weid;
		$theme_data = pdo_fetch('SELECT `val` FROM ' . tablename('q_3354988381_rencai_profile') . " WHERE 1 $condition and `key`='index_theme' limit 1");
		if (!$theme_data) {
			$sql = "INSERT INTO " . tablename('q_3354988381_rencai_profile') . " (`weid`,`key`, `val`, `remark`) VALUES ('" . $this -> weid . "', 'index_theme', 'D', '手机端首页主题');";
			pdo_query($sql);
			$theme_flag = 'D';
		} else {
			$theme_flag = $theme_data['val'];
		} 
		return $theme_flag;
	} 
	private function getPositionTypeArr() {
		$theme_flag = $this -> getPositionTypeFlag();
		if ($theme_flag == 'Z') {
			$positiontype = array();
			$condition = " c.weid=" . $this -> weid;
			$sql = "SELECT c.* " . "FROM " . tablename('q_3354988381_rencai_positiontype') . " c " . "WHERE $condition " . "ORDER BY c.sort ASC, id DESC";
			$list_data = pdo_fetchall($sql);
			foreach ($list_data as $row) {
				$positiontype[$row['id']] = $row['name'];
			} 
		} else {
			$positiontype = $this -> module['config']['positiontype'];
			$positiontype = explode("\n", $positiontype);
			foreach ($positiontype AS $key => $val) {
				$positiontype[$key + 1] = $val;
			} 
			unset($positiontype[0]);
		} 
		return $positiontype;
	} 
	public function get_config() {
		$config = array();
		$resume_validitys = $this -> module['config']['resume_validity'];
		$resume_validitys = explode("\n", $resume_validitys);
		foreach ($resume_validitys AS $key => $val) {
			$resume_validitys[$key + 1] = $val;
		} 
		unset($resume_validitys[0]);
		$config['validity'] = $resume_validitys;
		$payrolls = $this -> module['config']['payroll'];
		$payrolls = explode("\n", $payrolls);
		foreach ($payrolls AS $key => $val) {
			$payrolls[$key + 1] = $val;
		} 
		unset($payrolls[0]);
		$config['payroll'] = $payrolls;
		$welfares = $this -> module['config']['welfare'];
		$welfares = explode("\n", $welfares);
		foreach ($welfares AS $key => $val) {
			$welfares[$key + 1] = $val;
		} 
		unset($welfares[0]);
		$config['welfare'] = $welfares;
		$educationals = $this -> module['config']['educational'];
		$config['educational'] = explode("\n", $educationals);
		$config['positiontype'] = $this -> getPositionTypeArr();
		$workexperience = $this -> module['config']['workexperience'];
		$config['workexperience'] = explode("\n", $workexperience);
		$companytype = $this -> module['config']['companytype'];
		$config['companytype'] = explode("\n", $companytype);
		$scale = $this -> module['config']['scale'];
		$config['scale'] = explode("\n", $scale);
		return $config;
	} 
	public function get_companys_info($ids) {
		global $_GPC, $_W;
		$ids = $ids ? $ids : '-1';
		$tmp_companys = pdo_fetchall("SELECT id,name,isauth FROM " . tablename($this -> company_table) . " WHERE id IN (" . implode(',', $ids) . ")");
		$companys = array();
		foreach ($tmp_companys AS $company) {
			$companys[$company['id']] = $company;
		} 
		return $companys;
	} 
	public function get_person_info($ids) {
		global $_GPC, $_W;
		$ids = $ids ? $ids : '-1';
		$tmp_persons = pdo_fetchall("SELECT id,username,sex,headimgurl FROM " . tablename($this -> person_table) . " WHERE id IN (" . implode(',', $ids) . ")");
		$persons = array();
		foreach ($tmp_persons AS $person) {
			$persons[$person['id']] = $person;
		} 
		return $persons;
	} 
	private function xxxget_member_info() {
		global $_GPC, $_W;
		$type = $this -> get_memner_type();
		if ($type == 1) {
			return pdo_fetch("SELECT * FROM " . tablename($this -> company_table) . " WHERE weid = :weid AND from_user = :from_user LIMIT 1", array(":weid" => $this -> weid, ":from_user" => $this -> from_user));
		} else {
			return pdo_fetch("SELECT * FROM " . tablename($this -> person_table) . " WHERE weid = :weid AND from_user = :from_user LIMIT 1", array(":weid" => $this -> weid, ":from_user" => $this -> from_user));
		} 
	} 
	public function get_person_company_row($type = 1, $from_user, $key = '', $add_you_get = false) {
		if ($type == 1) {
			$tmp_persons = pdo_fetch("SELECT * FROM " . tablename($this -> company_table) . " WHERE weid='" . $this -> weid . "' and from_user='$from_user' order by id desc limit 1");
			$company_money_row = $this -> get_table_row('q_3354988381_rencai_company_money', $tmp_persons['id'], 'company_id');
			$tmp_persons['company_curr_money'] = number_format($company_money_row['money'], 2);
			if (!$add_you_get) {
				$tmp_persons['company_curr_money'] -= $company_money_row['money_youhui_get'];
			} 
		} else if ($type == 2) {
			$tmp_persons = pdo_fetch("SELECT * FROM " . tablename($this -> person_table) . " WHERE weid='" . $this -> weid . "' and from_user='$from_user' order by id desc limit 1");
			$company_money_row = $this -> get_table_row('q_3354988381_rencai_person_money', $tmp_persons['id'], 'person_id');
			$tmp_persons['company_curr_money'] = number_format($company_money_row['money'], 2);
		} 
		if ($key) {
			return $tmp_persons[$key];
		} else {
			return $tmp_persons;
		} 
	} 
	private function getFieldsShowFlag($get_fix_field = '') {
		global $_W, $_GPC;
		$condition = " field='$get_fix_field' and uniacid=" . $this -> _uniacid;
		$sql = "SELECT `show` " . "FROM " . tablename('q_3354988381_rencai_form') . "  " . "WHERE $condition " . "ORDER BY sort ASC, id ASC";
		$field_data = pdo_fetch($sql);
		if ($field_data && $field_data['show'] == 0) {
			return false;
		} 
		return true;
	} 
	private function getFieldsSaveValArr($field_prefix = '', $only_get_show = 0, $get_real_field = 0) {
		global $_W, $_GPC;
		$condition = " uniacid=" . $this -> _uniacid;
		if ($field_prefix) {
			$condition .= " and `field` like '{$field_prefix}%'";
		} 
		if ($only_get_show) {
			$condition .= " and `show`=1";
		} 
		$sql = "SELECT * " . "FROM " . tablename('q_3354988381_rencai_form') . "  " . "WHERE $condition " . "ORDER BY sort ASC, id ASC";
		$fields_list = array();
		$list_data = pdo_fetchall($sql);
		foreach ($list_data as $k => $item) {
			if ($get_real_field) {
				$item['field'] = str_replace($field_prefix, '', $item['field']);
			} 
			$fields_list[$item['field']] = $item;
		} 
		return $fields_list;
	} 
	private function getFieldsArr($get_fix_key = '', $get_fix_field = '') {
		$fields_sys_arr = array('sys_position' => '名企推荐|首页下边名企推荐', 'sys_nav_index' => '首页|手机端导航菜单-必选项', 'sys_nav_zhao' => '招聘|手机端导航菜单-必选项', 'sys_nav_fabu' => '发布|手机端导航菜单-必选项', 'sys_nav_person' => '求职|手机端导航菜单-必选项', 'sys_nav_my' => '我的|手机端导航菜单-必选项',);
		$fields_person_arr = array('person_username' => '姓名', 'person_headimgurl' => '头像', 'person_sex' => '性别', 'person_mobile' => '手机', 'person_qq' => 'QQ', 'person_age' => '年龄', 'person_educational' => '学历', 'person_professional' => '专业', 'person_workexperience' => '工作经验', 'person_cid' => '应聘职位', 'person_payroll' => '期望薪资', 'person_workaddress' => '期望工作地点', 'person_province' => '所在城市', 'person_assessment' => '自我评价', 'person_outline' => '显示状态', 'person_attach_a' => '预置字段A', 'person_attach_b' => '预置字段B', 'person_attach_c' => '预置字段C', 'person_attach_d' => '预置字段D', 'person_attach_e' => '预置字段E', 'person_price' => '查看费用');
		$fields_arr = array('sys' => $fields_sys_arr, 'person' => $fields_person_arr);
		if ($get_fix_key && $get_fix_field) {
			$sh_field_name = $get_fix_field;
			$getFieldsSaveValArr = $this -> getFieldsSaveValArr();
			if ($getFieldsSaveValArr[$sh_field_name]['user_label']) {
				return $getFieldsSaveValArr[$sh_field_name]['user_label'];
			} else {
				$allFieldsArr = $fields_arr;
				list($sh_field_name, $rmk) = explode('|', $allFieldsArr[$get_fix_key][$sh_field_name]);
				return $sh_field_name;
			} 
		} 
		return $fields_arr;
	} 
	public function get_all_office() {
		global $_GPC, $_W;
		$parent_cate = pdo_fetchall("SELECT * FROM " . tablename($this -> category_table) . " WHERE weid = :weid AND parent_id = 0 AND isshow = 1 ORDER BY display ASC", array(":weid" => $this -> weid));
		$tmp = array();
		foreach ($parent_cate AS $parent) {
			array_push($tmp, $parent['id']);
		} 
		$tmp = implode(",", $tmp);
		if ($tmp == '') {
			$tmp = '-1';
		} 
		$sub_cate = pdo_fetchall("SELECT * FROM " . tablename($this -> category_table) . " WHERE weid = :weid AND parent_id IN (" . $tmp . ") AND isshow = 1 ORDER BY display ASC", array(":weid" => $this -> weid));
		foreach ($parent_cate AS $key => $parent) {
			foreach ($sub_cate AS $k => $sub) {
				if ($sub['parent_id'] == $parent['id']) {
					$parent_cate[$key]['sub'][$k] = $sub;
				} 
			} 
		} 
		return $parent_cate;
	} 
	public function get_all_industry() {
		global $_GPC, $_W;
		$parent_industry = pdo_fetchall("SELECT * FROM " . tablename($this -> industry_table) . " WHERE weid = :weid AND parent_id = 0 AND isshow = 1 ORDER BY display ASC", array(":weid" => $this -> weid));
		$tmp = array();
		foreach ($parent_industry AS $parent) {
			array_push($tmp, $parent['id']);
		} 
		$pids = implode(",", $tmp);
		unset($tmp);
		if (!empty($pids)) {
			$sub_industry = pdo_fetchall("SELECT * FROM " . tablename($this -> industry_table) . " WHERE weid = :weid AND parent_id IN ({$pids}) AND isshow = 1 ORDER BY display ASC", array(":weid" => $this -> weid));
			foreach ($parent_industry AS $key => $parent) {
				foreach ($sub_industry AS $k => $sub) {
					if ($sub['parent_id'] == $parent['id']) {
						$parent_industry[$key]['sub'][$k] = $sub;
					} 
				} 
			} 
		} 
		return $parent_industry;
	} 
	public function get_memner_type() {
		global $_GPC, $_W;
		return pdo_fetchcolumn("SELECT `type` FROM " . tablename($this -> member_table) . " WHERE weid = :weid AND from_user = :from_user LIMIT 1", array(":weid" => $this -> weid, ":from_user" => $this -> from_user), 0);
	} 
	public function get_member_id() {
		global $_GPC, $_W;
		$type = $this -> get_memner_type();
		if ($type == 1) {
			return pdo_fetchcolumn("SELECT `id` FROM " . tablename($this -> company_table) . " WHERE weid = :weid AND from_user = :from_user LIMIT 1", array(":weid" => $this -> weid, ":from_user" => $this -> from_user), 0);
		} else {
			return pdo_fetchcolumn("SELECT `id` FROM " . tablename($this -> person_table) . " WHERE weid = :weid AND from_user = :from_user LIMIT 1", array(":weid" => $this -> weid, ":from_user" => $this -> from_user), 0);
		} 
	} 
	public function get_is_apply($uid, $jobid) {
		global $_GPC, $_W;
		$ret = pdo_fetch("SELECT id FROM " . tablename($this -> apply_table) . " WHERE weid = :weid AND person_id = :person_id AND job_id = :job_id LIMIT 1", array(':weid' => $this -> weid, ':person_id' => $uid, ':job_id' => $jobid));
		if ($ret) {
			return true;
		} else {
			return false;
		} 
	} 
	public function get_is_collect($uid, $jobid) {
		global $_GPC, $_W;
		$ret = pdo_fetch("SELECT id FROM " . tablename($this -> collect_table) . " WHERE weid = :weid AND person_id = :person_id AND job_id = :job_id LIMIT 1", array(':weid' => $this -> weid, ':person_id' => $uid, ':job_id' => $jobid));
		if ($ret) {
			return true;
		} else {
			return false;
		} 
	} 
	public function get_buy_total($person_id) {
		global $_GPC, $_W;
		return pdo_fetchcolumn("select count(*) from " . tablename('q_3354988381_rencai_company_lookresume') . " where person_id='$person_id' and person_agree_payflag='Y' and weid=" . $this -> weid);
	} 
	private function set_public_url() {
		global $_W, $_GPC;
		$_SESSION['session_public_url'] = '';
		if ($this -> from_user) {
			$member_row = pdo_fetch("SELECT `type`,status FROM " . tablename($this -> member_table) . " WHERE status=1 and weid = :weid AND from_user = :from_user limit 1", array(":weid" => $this -> weid, ":from_user" => $this -> from_user));
			if ($member_row) {
				if ($member_row['type'] == 1) {
					$_SESSION['curr_person_id'] = $this -> get_person_company_row(1, $this -> from_user, 'id');
					$public_url = $this -> createMobileUrl('PublicJob', array('type' => 1, 'person_id' => $_SESSION['curr_person_id']));
				} else if ($member_row['type'] == 2) {
					$_SESSION['curr_person_id'] = $this -> get_person_company_row(2, $this -> from_user, 'id');
					$public_url = $this -> createMobileUrl('PublicResumeBasic', array('type' => 2, 'person_id' => $_SESSION['curr_person_id']));
				} 
				$_SESSION['session_public_url'] = $public_url;
			} 
		} else {
			message('获取openid失败！', referer(), 'error');
		} 
	} 
	private function check_joinin_info($company_id) {
		$company_joinin_cost_per_year = $this -> getConfigArr('company_joinin_cost_per_year');
		if ($company_joinin_cost_per_year <= 0) {
			return true;
		} 
		$year_price = pdo_fetch("SELECT * FROM " . tablename('q_3354988381_rencai_joinin_money') . " WHERE company_id=:company_id order by id desc LIMIT 1", array(":company_id" => $company_id));
		if ($year_price) {
			if ($year_price['to_day'] >= date('Y-m-d')) {
				return true;
			} 
		} else {
			$company_money_row = $this -> get_table_row('q_3354988381_rencai_company_money', $company_id, 'company_id');
			if ($company_money_row['money'] < $company_joinin_cost_per_year) {
				$ui_info_arr = array('icon' => 'weui_icon_msg weui_icon_warn', 'msg_title' => '警告', 'msg_desc' => '当前账户余额不足缴清年费请充值', 'go_url' => $this -> createMobileUrl('my_recharge'),);
				$this -> showInfoMsg($ui_info_arr);
			} else {
				$to_day = date("Y-m-d", strtotime("+1 year"));;
				$data = array('company_id' => $company_id, 'year_money' => $company_joinin_cost_per_year, 'to_day' => $to_day, 'create_at' => date('Y-m-d H:i:s'),);
				pdo_insert('q_3354988381_rencai_joinin_money', $data);
				pdo_update('q_3354988381_rencai_company_money', array('money' => $company_money_row['money'] - $company_joinin_cost_per_year, 'updatetime' => date('Y-m-d H:i:s')), array('company_id' => $company_id));
				return true;
			} 
		} 
		$ui_info_arr = array('icon' => 'weui_icon_msg weui_icon_warn', 'msg_title' => '警告', 'msg_desc' => '企业须缴纳' . $company_joinin_cost_per_year . '元年费', 'go_url' => $this -> createMobileUrl('my_recharge'),);
		$this -> showInfoMsg($ui_info_arr);
	} 
	private function get_can_tixian_credits() {
		global $_W, $_GPC;
		$type = $_SESSION['curr_user_type'];
		$apply_data = pdo_fetch('SELECT sum(scores) as apply_scores, sum(credits2) as apply_credits2, sum(tixian_money) as have_tixian_moneys FROM ' . tablename('q_3354988381_rencai_tixian') . " WHERE weid='" . $this -> weid . "' and from_user='" . $this -> from_user . "' and finish_flag='F' and type='$type'");
		$company = $this -> get_person_company_row($type == 'C' ? '1' : '2' , $this -> from_user);
		$my_money = $company['company_curr_money'];
		$my_money -= $apply_data['have_tixian_moneys'];
		if ($my_money < 0) {
			$my_money = 0;
		} 
		return array('credit1' => $credit1, 'credit2' => number_format($credit2, 2), 'have_tixian_moneys' => $apply_data['have_tixian_moneys'] + 0, 'to_money' => number_format($my_money, 2) + 0,);
	} 
	public function doMobilePublicRartTime() {
		global $_W, $_GPC;
		$title = '发布兼职';
		include $this -> template('public_parttime');
	} 
	public function doMobilePublicUsedMarket() {
		global $_W, $_GPC;
		$title = '二手市场';
		include $this -> template('public_used_market');
	} 
	public function __app($f_name) {
		$this -> hdmkqxflag();
		if ($this -> from_user && $_SESSION['get_user_unionid_have'] == '') {
			$this -> get_user_unionid($this -> from_user);
		} 
		include_once 'inc/app/' . strtolower(substr($f_name, 8)) . '.inc.php';
	} 
	public function get_share_whoid($add_flag = '') {
		global $_W, $_GPC;
		if ($add_flag) {
			if ($_SESSION['from_whoid']) {
				$type = substr($_SESSION['from_whoid'], 0, 1);
				${$type.'_id'} = substr($_SESSION['from_whoid'], 1);
				if ($add_flag == 'c') {
					return $c_id;
				} else if ($add_flag == 'p') {
					return $p_id;
				} 
			} 
			return 0;
		} 
		$whoid = '';
		$type = $_SESSION['curr_user_type'];
		if ($type == 'C') {
			$company = $this -> get_person_company_row(1, $this -> from_user);
			$whoid = 'c' . $company['id'];
		} elseif ($type == 'P') {
			$person = $this -> get_person_company_row(2, $this -> from_user);
			$whoid = 'p' . $person['id'];
		} 
		return '&whoid=' . $whoid;
	} 
	public function doMobileShareaward() {
		global $_W, $_GPC;
		$share_item = $_GPC['share_item'];
		$res = array('success' => false, 'msg' => '分享奖励失败');
		$fromuser = $_W['fans']['from_user'];
		$uid = mc_openid2uid($fromuser);
		$share_data = pdo_fetch("SELECT * FROM " . tablename($this -> share_table) . " WHERE uniacid = :uniacid LIMIT 1", array(':uniacid' => $this -> weid));
		if ($share_item == 'index') {
			mc_credit_update($uid, 'credit1', $share_data['share_index_award_score'], array('', '微人才微招聘分享赠送' . $share_data['share_index_award_score'] . '积分', 'q_3354988381_rencai', $uid));
			$res = array('success' => true, 'msg' => '分享成功，奖励' . $share_data['share_index_award_score'] . '积分');
		} else if ($share_item == 'zhao') {
			mc_credit_update($uid, 'credit1', $share_data['share_zhao_award_score'], array('', '微人才微招聘分享赠送' . $share_data['share_zhao_award_score'] . '积分', 'q_3354988381_rencai', $uid));
			$res = array('success' => true, 'msg' => '分享成功，奖励' . $share_data['share_zhao_award_score'] . '积分');
		} else if ($share_item == 'qiu') {
			mc_credit_update($uid, 'credit1', $share_data['share_qiu_award_score'], array('', '微人才微招聘分享赠送' . $share_data['share_qiu_award_score'] . '积分', 'q_3354988381_rencai', $uid));
			$res = array('success' => true, 'msg' => '分享成功，奖励' . $share_data['share_qiu_award_score'] . '积分');
		} else if ($share_item == 'my') {
			mc_credit_update($uid, 'credit1', $share_data['share_my_award_score'], array('', '微人才微招聘分享赠送' . $share_data['share_my_award_score'] . '积分', 'q_3354988381_rencai', $uid));
			$res = array('success' => true, 'msg' => '分享成功，奖励' . $share_data['share_my_award_score'] . '积分');
		} 
		echo json_encode($res);
		exit;
	} 
	public function doMobileAdGo() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileIndex() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileIndex_home() {
		$this -> doMobileIndex();
	} 
	public function doMobileFansUs() {
		global $_W, $_GPC;
		$serverapp = $_W['account']['level'];
		if ($serverapp != 4) {
			$keywords = pdo_fetchall("SELECT content FROM " . tablename('rule_keyword') . " WHERE uniacid = :uniacid AND module = 'q_3354988381_rencai'", array(":uniacid" => $this -> weid));
			$tmp = array();
			foreach ($keywords AS $key) {
				array_unshift($tmp, $key['content']);
			} 
			$keywords = implode('&nbsp;&nbsp;', $tmp);
			$message = '并发送关键字：<font color="red"><strong>' . $keywords . '</strong></font>';
		} 
		$qrcode = $this -> module['config']['qrcode'];
		$title = '关注我们';
		include $this -> template('fans_us');
	} 
	public function doMobileGetopenid($from_method) {
		global $_W, $_GPC;
		$config_arr = $this -> getConfigArr();
		$appid = $config_arr['svs_appid'];
		$appsecret = $config_arr['svs_appsecret'];
		$back_url = urlencode($_W['siteroot'] . 'app' . substr($this -> createMobileUrl('getopenid'), 1)) . '&frmmtd=' . $from_method;
		if ($_GET['code']) {
			$code = $_GET['code'];
			$code_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $code . '&grant_type=authorization_code';
			$uwr_arr = json_decode($this -> get_html($code_url), 1);
			if ($uwr_arr['openid']) {
				$_SESSION['user_openid'] = $uwr_arr['openid'];
				$this -> from_user = $_SESSION['user_openid'];
				$back_url = $_W['siteroot'] . 'app' . substr($this -> createMobileUrl($_GPC['frmmtd'] ? $_GPC['frmmtd'] : 'index'), 1);
				header('location:' . $back_url, true, 301);
				exit;
			} else {
				die('--get openid error--');
			} 
		} else {
			$code_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . $back_url . '&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
			header('location:' . $code_url);
			exit;
		} 
	} 
	public function doMobilePublicIndex() {
		global $_GPC;
		if (!$this -> from_user) {
			$this -> doMobileGetopenid('PublicIndex');
		} 
		if ($this -> from_user && $_SESSION['get_user_unionid_have'] == '') {
			$this -> get_user_unionid($this -> from_user);
		} 
		$title = '选择发布类型';
		$this -> set_public_url();
		if ($_SESSION['session_public_url']) {
			header('location:' . $_SESSION['session_public_url']);
		} 
		$type = $_GPC['type'];
		$show_part_time = $this -> module['config']['show_part_time'];
		$show_used_market = $this -> module['config']['show_used_market'];
		include $this -> template('public_index');
	} 
	public function doMobileMyCompanyIndex() {
		global $_W, $_GPC;
		if ($this -> from_user && $_SESSION['get_user_unionid_have'] == '') {
			$this -> get_user_unionid($this -> from_user);
		} 
		$curr_action = 'MyCompanyIndex';
		$company = $this -> get_person_company_row(1, $this -> from_user, '', true);
		$ret = pdo_fetch("SELECT mid, COUNT(*) AS nums FROM " . tablename($this -> job_table) . " WHERE weid = :weid AND mid = :mid", array(":weid" => $this -> weid, ":mid" => $company['id']));
		$headimgurl = $this -> get_user_header_pic($company['from_user'], 1);
		$member_arr = $this -> get_user_avatar($this -> from_user);
		$credit2 = number_format($member_arr['credit2'], 2);
		$my_money = $company['company_curr_money'];
		$telephone = $this -> module['config']['telephone'];
		$curr_action = 'MyCompanyIndex';
		$title = '用户中心';
		include $this -> template('my_company_index');
	} 
	public function doMobileMy_recharge() {
		global $_W, $_GPC;
		$ajax_res = array('status' => 0, 'msg' => '非法操作！');
		$company_row = $this -> get_person_company_row(1, $this -> from_user, '', 1);
		$my_money = $company_row['company_curr_money'];
		if (!$company_row) {
			message('您不是企业身份！');
		} 
		$curr_title = '企业充值';
		if (isset($_GPC['addmoney'])) {
			$addmoney = round($_GPC['addmoney'], 2);
			$need_money = $this -> module['config']['miniaddmoney']?$this -> module['config']['miniaddmoney']:1;
			if ($need_money > $addmoney) {
				$ajax_res['msg'] = '商户要求最低充值金额 ' . $need_money . '元';
				echo json_encode($ajax_res);
				exit;
			} 
			if (0 && $_SESSION['agent_recharge_insert_id'] > 0) {
				pdo_update('wei_tb_agent_recharge', array('fee' => $addmoney), array('id' => $_SESSION['agent_recharge_insert_id']));
			} else {
				require_once 'lib/WxPay.Config.php';
				$order_no = WxPayConfig :: MCHID . date("YmdHis") . rand(10, 99);
				$data = array('weid' => $this -> weid, 'type' => 'C', 'company_id' => $company_row['id'], 'pay_info' => '企业充值', 'fee' => $addmoney, 'order' => $order_no, 'status' => 0, 'create_at' => date('Y-m-d H:i:s'), 'rand_auth_code' => rand(1000, 9999),);
				pdo_insert('q_3354988381_rencai_recharge', $data);
				$log_id = pdo_insertid();
				$_SESSION['agent_recharge_insert_id'] = $log_id;
			} 
			$ajax_res = array('status' => 1, 'msg' => '支付中！');
			echo json_encode($ajax_res);
			exit;
		} 
		$profile_row = pdo_fetch("SELECT * FROM " . tablename('q_3354988381_rencai_profile') . " WHERE `key`='youhuiset_open' and weid=" . $this -> weid);
		$youhuiset_open = $profile_row['val'];
		if ($youhuiset_open == 'Y') {
			$condition = " dtl.weid=" . $this -> weid;
			$sql = "SELECT dtl.* " . "FROM " . tablename('q_3354988381_rencai_youhuiset') . " dtl " . "WHERE $condition and addmoney>=1 ORDER BY dtl.addmoney ASC ";
			$youhuiset_list = pdo_fetchall($sql);
		} 
		include $this -> template('my_recharge');
	} 
	public function doMobilePay() {
		global $_W, $_GPC;
		if (!$_SESSION['agent_recharge_insert_id']) {
			message('支付流程异常！', $this -> createMobileUrl('MyCompanyIndex'));
		} 
		$recharge_row = $this -> get_table_row('q_3354988381_rencai_recharge', $_SESSION['agent_recharge_insert_id']);
		$params = array('tid' => $_SESSION['agent_recharge_insert_id'], 'ordersn' => $recharge_row['order'], 'title' => '企业人才招聘费充值', 'fee' => $recharge_row['fee'], 'user' => $recharge_row['company_id'],);
		$_SESSION['agent_recharge_insert_id'] = '';
		$this -> pay($params);
	} 
	public function doMobilePayRes() {
		global $_W, $_GPC;
		if ($_GPC['res'] == 1) {
			$ui_info_arr = array('icon' => 'weui_icon_safe weui_icon_safe_success', 'msg_title' => '恭喜', 'msg_desc' => '充值成功', 'go_url' => $this -> createMobileUrl('MyCompanyIndex'),);
		} else {
			$ui_info_arr = array('icon' => 'weui_icon_msg weui_icon_warn', 'msg_title' => '充值失败', 'msg_desc' => $msg, 'go_url' => $this -> createMobileUrl('MyCompanyIndex'),);
		} 
		$this -> showInfoMsg($ui_info_arr);
	} 
	private function get_data_by_memberid($uid, $key = '') {
		global $_W, $_GPC;
		$sql = "SELECT fans.openid " . "FROM " . tablename('mc_mapping_fans') . " fans " . "LEFT JOIN " . tablename('mc_members') . " mem ON fans.uid=mem.uid " . "WHERE mem.uid='$uid'";
		$member_arr = pdo_fetch($sql);
		if ($key) {
			return $member_arr[$key];
		} 
		return $member_arr;
	} 
	private function update_youhui_money($fee, $company_id) {
		global $_W, $_GPC;
		$profile_row = pdo_fetch("SELECT * FROM " . tablename('q_3354988381_rencai_profile') . " WHERE `key`='youhuiset_open' and weid=" . $this -> weid);
		$youhuiset_open = $profile_row['val'];
		if ($youhuiset_open == 'Y') {
			$condition = " dtl.weid=" . $this -> weid;
			$sql = "SELECT dtl.* " . "FROM " . tablename('q_3354988381_rencai_youhuiset') . " dtl " . "WHERE $condition and addmoney<='$fee' ORDER BY dtl.addmoney DESC limit 1";
			$youhuiset_row = pdo_fetch($sql);
			if ($youhuiset_row) {
				$youhuiset_row['givemoney'] = number_format($youhuiset_row['givemoney'], 2);
				$sql = "update " . tablename('q_3354988381_rencai_company_money') . " set money=money+{$youhuiset_row['givemoney']}, money_youhui_get=money_youhui_get+{$youhuiset_row['givemoney']} where company_id='$company_id'";
				pdo_query($sql);
			} 
		} 
	} 
	public function payResult($params) {
		global $_W, $_GPC;
		$is_success = 0;
		$msg = '';
		$tid = $params['tid'];
		$uid = $params['user'];
		if ($params['type'] == 'credit') {
			$uid = $this -> get_data_by_memberid($uid, 'openid');
		} 
		if (!$uid || !is_numeric($uid)) {
			$agent_row = $this -> get_person_company_row(1, $uid);
			$uid = $agent_row['id'];
		} 
		if (!$tid) {
			die('原始log_id为空！');
		} 
		$transaction_id = $params['tag']['transaction_id'];
		$recharge_row = $this -> get_table_row('q_3354988381_rencai_recharge', $tid);
		if (strtolower($recharge_row['result_code']) == 'success') {
			header('location:' . $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=q_3354988381_rencai&do=payres&res=1");
			exit;
			die('重复通知！');
		} 
		pdo_update('q_3354988381_rencai_recharge', array('pay_type' => $params['type']), array('id' => $tid));
		if ($params['result'] != 'success') {
			pdo_update('q_3354988381_rencai_recharge', array('result_code' => $params['result'], 'transaction_id' => $transaction_id), array('id' => $tid));
		} 
		if (strtolower($params['result']) == 'success' && $params['from'] == 'notify') {
			$company_money_row = $this -> get_table_row('q_3354988381_rencai_company_money', $uid, 'company_id');
			if ($company_money_row) {
				pdo_update('q_3354988381_rencai_company_money', array('money' => $company_money_row['money'] + $recharge_row['fee'], 'updatetime' => date('Y-m-d H:i:s')), array('company_id' => $uid));
			} else {
				pdo_insert('q_3354988381_rencai_company_money', array('company_id' => $uid, 'money' => $recharge_row['fee'], 'updatetime' => date('Y-m-d H:i:s')));
			} 
			$this -> update_youhui_money($recharge_row['fee'], $uid);
			pdo_update('q_3354988381_rencai_recharge', array('result_code' => $params['result'], 'status' => 1), array('id' => $tid));
			$is_success = 1;
			$msg = '支付成功！';
		} 
		if (0 && empty($params['result']) || $params['result'] != 'success') {
			$data = array();
			if ($params['type'] == 'delivery') {
				$data['status'] = 1;
				$is_success = 1;
				$msg = '已经选用货到付款支付！';
			} else {
				$is_success = 0;
				$msg = '支付失败！';
			} 
		} 
		if ($params['result'] == 'success' && $params['from'] == 'return') {
			$data = array();
			if ($params['type'] == 'credit') {
				$is_success = 1;
				$msg = '支付成功！';
			} 
		} 
		if ($params['from'] == 'return') {
			if ($is_success) {
				pdo_update('q_3354988381_rencai_company', array('status' => 1), array('id' => $tid));
				if ($params['type'] == 'credit') {
					message($msg, '../../app/' . url('entry', array('do' => 'my', 'm' => 'q_3354988381_rencai')), 'success');
				} else {
					header('location:' . $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=q_3354988381_rencai&do=payres&res=1");
				} 
			} else {
				header('location:' . $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=q_3354988381_rencai&do=payres&res=0");
			} 
			exit;
		} 
	} 
	public function doMobileMyPersonIndex() {
		global $_W, $_GPC;
		if ($this -> from_user && $_SESSION['get_user_unionid_have'] == '') {
			$this -> get_user_unionid($this -> from_user);
		} 
		$curr_action = 'MyPersonIndex';
		$person = $this -> get_person_company_row(2, $this -> from_user);
		$person['buy_total'] = $this -> get_buy_total($person['id']);
		if (!$person['headimgurl']) {
			$person['headimgurl'] = $this -> get_user_header_pic($person['from_user'], $person['sex']);
		} else {
			if (!strstr($person['headimgurl'], 'http')) {
				$person['headimgurl'] = $this -> get_rencai_pic($person['headimgurl']);
			} 
		} 
		$telephone = $this -> module['config']['telephone'];
		$member_arr = $this -> get_user_avatar($this -> from_user);
		$credit2 = number_format($member_arr['credit2'], 2);
		$person_money_data = $this -> get_table_row('q_3354988381_rencai_person_money', $person['id'], 'person_id');
		$my_money = number_format($person_money_data['money'], 2);
		$title = '用户中心';
		include $this -> template('my_person_index');
	} 
	public function doMobileMy() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileLogoutIdentity() {
		global $_W, $_GPC;
		if (pdo_update($this -> member_table, array('status' => 0), array('weid' => $this -> weid, 'from_user' => $this -> from_user))) {
			$_SESSION['session_public_url'] = '';
			message('成功注销', $this -> createMobileUrl('Index'), 'success');
		} else {
			message('操作失败', referer(), 'error');
		} 
	} 
	//折D翼D天D使D资D源D社D区D提供D
	private function xxxdoMobileJobIndex() {
		global $_W, $_GPC;
		$last_company = pdo_fetchall("SELECT * FROM " . tablename($this -> company_table) . " WHERE weid = :weid AND status = 1 ORDER BY sort asc, id DESC LIMIT 20", array(":weid" => $this -> weid));
		foreach ($last_company AS $key => $val) {
			$last_company[$key]['dateline'] = date("Y-m-d", $val['dateline']);
		} 
		$parent_cate = pdo_fetchall("SELECT * FROM " . tablename($this -> category_table) . " WHERE weid = :weid AND parent_id = 0 AND isshow = 1 ORDER BY display ASC", array(":weid" => $this -> weid));
		$tmp = array();
		foreach ($parent_cate AS $parent) {
			array_push($tmp, $parent['id']);
		} 
		$tmp = implode(",", $tmp);
		if ($tmp == '') {
			$tmp = '-1';
		} 
		$sub_cate = pdo_fetchall("SELECT * FROM " . tablename($this -> category_table) . " WHERE weid = :weid AND parent_id IN (" . $tmp . ") AND isshow = 1", array(":weid" => $this -> weid));
		foreach ($parent_cate AS $key => $parent) {
			$i = 1;
			foreach ($sub_cate AS $k => $sub) {
				if ($sub['parent_id'] == $parent['id']) {
					$parent_cate[$key]['sub'][$i] = $sub;
					$i++;
				} 
			} 
		} 
		include $this -> template('Job_Index');
	} 
	public function doMobileJobList() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileJobShow() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileCompanyShow() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileResume() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileCommentAjax() {
		global $_W, $_GPC;
		$type = $this -> get_memner_type();
		if (!$type) {
			exit('-2');
		} 
		if ($type == 1) {
			exit('-3');
		} 
		$data = array('weid' => $this -> weid, 'mid' => intval($_GPC['mid']), 'jobid' => intval($_GPC['jobid']), 'content' => $_GPC['content'], 'status' => 0, 'dateline' => time(), 'check_res' => 'N', 'from_user' => $this -> from_user);
		if (pdo_insert($this -> jobs_comments_table, $data)) {
			echo('1');
		} else {
			echo('-1');
		} 
	} 
	public function doMobileMyCompanyInfo() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobilePublicJob() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileMyPublicJob() {
		global $_W, $_GPC;
		$config = $this -> get_config();
		$companyid = intval($_GPC['companyid']);
		$job_lists = pdo_fetchall("SELECT * FROM " . tablename($this -> job_table) . " WHERE weid = :weid AND mid = :companyid ORDER BY dateline DESC", array(":weid" => $this -> weid, ":companyid" => $companyid));
		foreach ($job_lists AS $key => $job) {
			$job_lists[$key]['dateline'] = date("Y/m/d", $job['dateline']);
		} 
		$title = '我发布的职位';
		include $this -> template('my_company_job');
	} 
	public function doMobileEditJob() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileShowCompanyMap() {
		global $_W, $_GPC;
		$info = pdo_fetch("SELECT * FROM " . tablename($this -> company_table) . " WHERE id = :id", array(":id" => $_GPC['companyid']));
		$coordinate = json_decode($info['coordinate'], 1);
		$title = '查看地图';
		include $this -> template('show_company_map');
	} 
	public function doMobileInviteJobAjax() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileShowResumeInfo() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobilePublicResumeBasic() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileComeApply() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobilePublicResumeWorkExperience() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileMyCollect() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileMyinvite() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileMyApply() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileInvitemine() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileCollectJobAjax() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileApplyJobAjax() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileHome_footer() {
		global $_W, $_GPC;
		$curr_action = $_GPC['curr_action'];
		include $this -> template('common_footer');
	} 
	public function doMobileCash_out() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileViewsumelist() {
		$this -> __app(__FUNCTION__);
	} 
	public function doMobileTixianapply() {
		global $_W, $_GPC;
		$res = array('status' => 0, 'msg' => '非法提交');
		$tixian_yuan = number_format($_GPC['addmoney'], 2);
		if ($tixian_yuan < 1) {
			$res['msg'] = '提现金额小于1元了';
			echo json_encode($res);
			exit;
		} 
		$can_tixian = $this -> get_can_tixian_credits();
		$can_tixian_money = $can_tixian['to_money'];
		if ($can_tixian_money < 1) {
			$res['msg'] = '可提现金额小于1元';
			echo json_encode($res);
			exit;
		} 
		if ($can_tixian_money < $tixian_yuan) {
			$res['msg'] = '提现金额超出当前余额';
			echo json_encode($res);
			exit;
		} 
		$res['status'] = 1;
		echo json_encode($res);
		exit;
	} 
	private function formatQueryParaMap($paraMap, $urlencode = 0) {
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v) {
			if (null != $v && "null" != $v && "sign" != $k) {
				if ($urlencode) {
					$v = urlencode($v);
				} 
				$buff .= $k . "=" . $v . "&";
			} 
		} 
		$reqPar = '';
		if (strlen($buff) > 0) {
			$reqPar = substr($buff, 0, strlen($buff) - 1);
		} 
		return $reqPar;
	} 
	private function arr2xml($data, $root = true) {
		$str = "";
		if ($root) {
			$str .= "<xml>";
		} 
		foreach ($data as $key => $val) {
			if (is_array($val)) {
				$child = arr2xml($val, false);
				$str .= "<$key>$child</$key>";
			} else {
				$str .= "<$key>$val</$key>";
			} 
		} 
		if ($root) {
			$str .= "</xml>";
		} 
		return $str;
	} 
	private function vpost($url, $data) {
		global $_W, $_GPC;
		$id = $_W['uniacid'];
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);
		$key_url = str_replace('app', 'web', getcwd()) . '/' . $id;
		curl_setopt($curl, CURLOPT_SSLCERT, $key_url . '/apiclient_cert.pem');
		curl_setopt($curl, CURLOPT_SSLKEY, $key_url . '/apiclient_key.pem');
		curl_setopt($curl, CURLOPT_CAINFO, $key_url . '/rootca.pem');
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$tmpInfo = curl_exec($curl);
		if (curl_errno($curl)) {
			echo 'Errno' . curl_error($curl);
		} 
		curl_close($curl);
		return $tmpInfo;
	} 
	private function send_hongbao($bill_no, $to_user_openid, $money) {
		$company_info = array('mchid' => $this -> module['config']['fhb_mchid'], 'bill_no' => $bill_no, 'appid' => $this -> module['config']['fhb_appid'], 'send_name' => $this -> module['config']['fhb_send_name'], 'nick_name' => $this -> module['config']['fhb_nick_name'], 'to_user_openid' => $to_user_openid, 'min_value' => $money, 'max_value' => $money, 'total_amount' => $money, 'total_num' => 1, 'wishing' => $this -> module['config']['fhb_wishing'], 'remark' => $this -> module['config']['fhb_remark'], 'act_name' => $this -> module['config']['fhb_act_name'], 'key' => $this -> module['config']['fhb_send_key']);
		$para_str = '';
		$hongbao_url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
		$param_arr = array('nonce_str' => md5(date('YmdHis') . rand(0, 1000)), 'mch_billno' => $company_info['bill_no'], 'mch_id' => $company_info['mchid'], 'wxappid' => $company_info['appid'], 'send_name' => $company_info['send_name'], 'nick_name' => $company_info['nick_name'], 're_openid' => $company_info['to_user_openid'], 'min_value' => $company_info['min_value'], 'max_value' => $company_info['max_value'], 'total_amount' => $company_info['total_amount'], 'total_num' => $company_info['total_num'], 'wishing' => $company_info['wishing'], 'client_ip' => $_SERVER['SERVER_ADDR'] ? $_SERVER['SERVER_ADDR'] : '192.168.1.1', 'remark' => $company_info['remark'], 'act_name' => $company_info['act_name'],);
		ksort($param_arr);
		$para_str = $this -> formatQueryParaMap($param_arr);
		$para_str .= '&key=' . $company_info['key'];
		$param_arr['sign'] = strtoupper(md5($para_str));
		$xml = $this -> arr2xml($param_arr);
		$result = $this -> vpost($hongbao_url, $xml);
		$array_data = json_decode(json_encode(simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
		return $array_data;
	} 
	public function doMobileHttpsendhongbaob() {
		global $_W, $_GPC;
		$no_empty_arr = array('openid' => 'openid', 'money' => '红包金额', 'sign' => '签名');
		foreach ($no_empty_arr as $field => $item_name) {
			if (empty($_GPC[$field])) {
				$res_arr = array('error' => '1', 'msg' => '请填写' . $item_name . '！');
				echo json_encode($res_arr);
				exit;
			} 
		} 
		$para_data = $this -> getConfigArr();
		$data = array('weid' => $this -> weid, 'receive_flag' => 'N', 'send_finish' => 'N', 'createtime' => date('Y-m-d H:i:s'), 'openid_service' => $_GPC['openid_service'], 'openid' => $_GPC['openid'],);
		$field_arr = array('openid', 'memberid', 'user_info_id', 'money', 'remark');
		sort($field_arr);
		$get_str = '';
		foreach ($field_arr as $field) {
			if (!empty($_GPC[$field])) {
				$data[$field] = $_GPC[$field];
				$get_str .= $field . '=' . $_GPC[$field] . '&';
			} 
		} 
		$get_str .= 'key=' . $para_data['fhb_send_key'];
		$get_str_sign = strtoupper(md5($get_str));
		if ($get_str_sign != $_GPC['sign']) {
			$res_arr = array('error' => '1', 'msg' => '签名错误！');
			echo json_encode($res_arr);
			exit;
		} 
		pdo_insert('q_3354988381_rencai_fhb_sendrec', $data);
		$in_id = pdo_insertid();
		$bill_no = $para_data['fhb_mchid'] . date('Ymd') . str_pad($in_id, 10, "0", STR_PAD_LEFT);
		pdo_update('q_3354988381_rencai_fhb_sendrec', array('bill_no' => $bill_no), array('id' => $in_id));
		$id = $in_id;
		$data = pdo_fetch("SELECT * FROM " . tablename('q_3354988381_rencai_fhb_sendrec') . " WHERE id = :id", array(':id' => $id));
		$send_res = $this -> send_hongbao($data['bill_no'] ? $data['bill_no'] : $bill_no, ($data['openid_service'] ? $data['openid_service'] : $data['openid']), $data['money']);
		$res = $send_res['return_code'] . '->' . $send_res['return_msg'];
		$update_data = array('send_res' => $res, 'send_finish' => strstr($send_res['return_code'], 'SUCCESS') ? 'Y' : 'N', 'send_time' => date('Y-m-d H:i:s'));
		pdo_update('q_3354988381_rencai_fhb_sendrec', $update_data, array('id' => $id));
		$res_arr = array('error' => '0', 'msg' => '保存成功！发放红包结果：' . $res);
		echo json_encode($res_arr);
		exit;
	} 
	public function doMobileTixianapplyflb() {
		global $_W, $_GPC;
		$tixian_yuan = number_format($_GPC['addmoney'], 2);
		if ($tixian_yuan < 1) {
			$ui_info_arr = array('icon' => 'weui_icon_msg weui_icon_warn', 'msg_title' => '失败', 'msg_desc' => '提现金额小于1元了',);
			$this -> showInfoMsg($ui_info_arr);
		} 
		$can_tixian = $this -> get_can_tixian_credits();
		$can_tixian_money = $can_tixian['to_money'];
		if ($can_tixian_money < 1) {
			$ui_info_arr = array('icon' => 'weui_icon_msg weui_icon_warn', 'msg_title' => '失败', 'msg_desc' => '可提现金额小于1元',);
			$this -> showInfoMsg($ui_info_arr);
		} 
		if ($can_tixian_money < $tixian_yuan) {
			$ui_info_arr = array('icon' => 'weui_icon_msg weui_icon_warn', 'msg_title' => '失败', 'msg_desc' => '提现金额超出当前余额',);
			$this -> showInfoMsg($ui_info_arr);
		} 
		$cfg_arr = $this -> getConfigArr();
		if ($cfg_arr) {
			$openid_service = '';
			$appid = $cfg_arr['fhb_appid'];
			$appsecret = $cfg_arr['fhb_secret'];
			$url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=q_3354988381_rencai&do=tixianapplyflb&addmoney=" . $tixian_yuan;
			$back_url = urlencode($url);
			if ($_GET['code']) {
				$code = $_GET['code'];
				$code_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $code . '&grant_type=authorization_code';
				$uwr_arr = json_decode($this -> get_html($code_url), 1);
				if ($uwr_arr['openid']) {
					$openid_service = $uwr_arr['openid'];
				} else {
					die('--get openid error--');
				} 
			} else {
				$code_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . $back_url . '&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
				header('location:' . $code_url);
				exit;
			} 
			$money = $tixian_yuan;
			$obj_url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . '&c=entry&m=q_3354988381_rencai&do=httpsendhongbaob&';
			$param_arr = array('openid' => $this -> from_user ? $this -> from_user : 'svs', 'memberid' => 0, 'user_info_id' => 0, 'money' => $money * 100, 'remark' => '微人才提现');
			ksort($param_arr);
			$para_str = $this -> formatQueryParaMap($param_arr);
			$para_str .= '&key=' . $cfg_arr['fhb_send_key'];
			$para_str .= '&sign=' . strtoupper(md5($para_str));
			$obj_url .= $para_str . '&openid_service=' . $openid_service;
			$res = file_get_contents($obj_url);
			$res_arr = json_decode($res, 1);
			if ($res_arr['error'] == 0) {
				$ui_info_arr = array('icon' => 'weui_icon_safe weui_icon_safe_success', 'msg_title' => '提现成功', 'msg_desc' => '请返回到微信主页面领取红包',);
				$type = $_SESSION['curr_user_type'];
				$data = array('weid' => $this -> weid, 'type' => $type, 'from_user' => $this -> from_user, 'tixian_msg' => '+' . $money . '元', 'tixian_money' => $money, 'finish_flag' => 'S', 'createtime' => date('Y-m-d H:i:s'),);
				pdo_insert('q_3354988381_rencai_tixian', $data);
				if ($type == 'C') {
					$company = $this -> get_person_company_row(1, $this -> from_user);
					$company_money_row = $this -> get_table_row('q_3354988381_rencai_company_money', $company['id'], 'company_id');
					pdo_update('q_3354988381_rencai_company_money', array('money' => $company_money_row['money'] - $tixian_yuan, 'updatetime' => date('Y-m-d H:i:s')), array('company_id' => $company['id']));
				} elseif ($type == 'P') {
					$person = $this -> get_person_company_row(2, $this -> from_user);
					$person_money_row = $this -> get_table_row('q_3354988381_rencai_person_money', $person['id'], 'person_id');
					pdo_update('q_3354988381_rencai_person_money', array('money' => $person_money_row['money'] - $tixian_yuan, 'updatetime' => date('Y-m-d H:i:s')), array('person_id' => $person['id']));
				} 
			} else {
				$ui_info_arr = array('icon' => 'weui_icon_msg weui_icon_warn', 'msg_title' => '处理失败', 'msg_desc' => $res_arr['msg'],);
			} 
			$this -> showInfoMsg($ui_info_arr);
		} else {
			$ui_info_arr = array('icon' => 'weui_icon_msg weui_icon_warn', 'msg_title' => '错误', 'msg_desc' => '未设置提现信息',);
			$this -> showInfoMsg($ui_info_arr);
		} 
	} 
	private function get_tixian_status($val) {
		$arr = array('N' => '处理中', 'F' => '失败', 'S' => '成功');
		return $arr[$val] ? $arr[$val] : '未知';
	} 
	public function doMobileExeccrontab() {
		global $_W, $_GPC;
		$this -> L('--in rencai crontab--');
		$invites = pdo_fetch("SELECT rsm.id, comany.from_user, person.username, comany.id as comany_id " . "FROM " . tablename('q_3354988381_rencai_company_lookresume') . " rsm " . "LEFT JOIN " . tablename('q_3354988381_rencai_company') . " comany ON rsm.company_id=comany.id " . "LEFT JOIN " . tablename('q_3354988381_rencai_person') . " person ON rsm.person_id=person.id " . "where rsm.person_agree='' and rsm.weid=:weid and rsm.weid=:weid", array(':weid' => $this -> weid, ':weid' => $this -> weid));
		pdo_update('q_3354988381_rencai_company_lookresume', array('person_agree' => 'Y'), array('id' => $invites['id']));
		$info_con = array('title' => '申请批准通知', 'description' => $invites['username'] . '已经接受了您的查看简历请求！', 'url' => $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=q_3354988381_rencai&do=viewsumelist&companyid=" . $invites['comany_id'],);
		$this -> send_notify_other_api($invites['from_user'], $info_con, 'I');
	} 
} 
