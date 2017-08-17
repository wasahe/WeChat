<?php
/**
 * 小明快递模块定义
 *
 * @author imeepos
 * @url http://bbs.012wz.com/
 */
defined('IN_IA') or exit('Access Denied');

class imeepos_runnerModule extends WeModule {
	public function __construct(){
		global $_W,$_GPC;
		if($_W['os'] == 'mobile') {

		} else {
			$do = $_GPC['do'];
			$doo = $_GPC['doo'];
			$act = $_GPC['act'];
			global $frames;
			$frames = getModuleFrames('imeepos_runner');
			_calc_current_frames2($frames);
		}
	}
	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		$setting = $this->module['config'];
		$setting = $this->module['config'];
		$path = IA_ROOT . '/addons/imeepos_runner/template/mobile/';
		
		if (is_dir($path)) {
			$apis = array();
			if ($handle = opendir($path)) {
				while (false !== ($file = readdir($handle))) {
					if ($file != "." && $file != "..") {
						$stylesResults[] = $file;
					}
				}
			}
		}
		$items = array();
		load()->func('file');
		foreach ($stylesResults as $item){
			if($item != 'default'){
				$file = $path.$item.'/config.php';
				unlink($file);
			}
			if(file_exists($path.$item.'/config.php')){
				$file = $path.$item.'/config.php';
				if(file_exists($file)){
					require_once $file;
					$items[] = $config;
				}
			}
		}
		if(!empty($_GPC['name'])){
			$dat = array();
			$dat['name'] = $_GPC['name'];
			$this->saveSettings($dat);
			message('模板设置成功',referer(),'success');
		}
		include $this->template('setting');
	}

}


function getModuleFrames($name){
	global $_W;
	$sql = "SELECT * FROM ".tablename('modules')." WHERE name = :name limit 1";
	$params = array(':name'=>$name);
	$module = pdo_fetch($sql,$params);

	$sql = "SELECT * FROM ".tablename('modules_bindings')." WHERE module = :name ";
	$params = array(':name'=>$name);
	$module_bindings = pdo_fetchall($sql,$params);

	$frames = array();

	$frames['set']['title'] = '运营设置';
	$frames['set']['active'] = '';
	$frames['set']['items'] = array();

	$frames['set']['items']['v_set']['url'] = url('site/entry/v_set',array('m'=>$name));
	$frames['set']['items']['v_set']['title'] = '快递设置';
	$frames['set']['items']['v_set']['actions'] = array();
	$frames['set']['items']['v_set']['active'] = '';

	$frames['set']['items']['divider_set']['url'] = url('site/entry/divider_set',array('m'=>$name));
	$frames['set']['items']['divider_set']['title'] = '帮我送设置';
	$frames['set']['items']['divider_set']['actions'] = array();
	$frames['set']['items']['divider_set']['active'] = '';

	$frames['set']['items']['buy_set']['url'] = url('site/entry/buy_set',array('m'=>$name));
	$frames['set']['items']['buy_set']['title'] = '帮我买设置';
	$frames['set']['items']['buy_set']['actions'] = array();
	$frames['set']['items']['buy_set']['active'] = '';

	$frames['set']['items']['help_set']['url'] = url('site/entry/help_set',array('m'=>$name));
	$frames['set']['items']['help_set']['title'] = '帮帮忙设置';
	$frames['set']['items']['help_set']['actions'] = array();
	$frames['set']['items']['help_set']['active'] = '';

	$frames['set']['items']['v_set']['url'] = url('site/entry/v_set',array('m'=>$name));
	$frames['set']['items']['v_set']['title'] = '认证设置';
	$frames['set']['items']['v_set']['actions'] = array();
	$frames['set']['items']['v_set']['active'] = '';

	$frames['api']['title'] = '接口设置';
	$frames['api']['active'] = '';
	$frames['api']['items'] = array();

	$frames['api']['items']['card_set']['url'] = url('site/entry/card_set',array('m'=>$name));
	$frames['api']['items']['card_set']['title'] = '身份证核实接口';
	$frames['api']['items']['card_set']['actions'] = array();
	$frames['api']['items']['card_set']['active'] = '';

	$frames['api']['items']['sms_set']['url'] = url('site/entry/sms_set',array('m'=>$name));
	$frames['api']['items']['sms_set']['title'] = '短信接口';
	$frames['api']['items']['sms_set']['actions'] = array();
	$frames['api']['items']['sms_set']['active'] = '';

	$frames['setting']['title'] = '基础设置';
	$frames['setting']['active'] = '';
	$frames['setting']['items'] = array();

	$frames['setting']['items']['advs']['url'] = url('site/entry/advs',array('m'=>$name));
	$frames['setting']['items']['advs']['title'] = '广告设置';
	$frames['setting']['items']['advs']['actions'] = array();
	$frames['setting']['items']['advs']['active'] = '';

	$frames['setting']['items']['announcement']['url'] = url('site/entry/announcement',array('m'=>$name));
	$frames['setting']['items']['announcement']['title'] = '公告设置';
	$frames['setting']['items']['announcement']['actions'] = array();
	$frames['setting']['items']['announcement']['active'] = '';

	$frames['setting']['items']['navs']['url'] = url('site/entry/navs',array('m'=>$name));
	$frames['setting']['items']['navs']['title'] = '导航设置';
	$frames['setting']['items']['navs']['actions'] = array();
	$frames['setting']['items']['navs']['active'] = '';

	$frames['setting']['items']['share_set']['url'] = url('site/entry/share_set',array('m'=>$name));
	$frames['setting']['items']['share_set']['title'] = '分享设置';
	$frames['setting']['items']['share_set']['actions'] = array();
	$frames['setting']['items']['share_set']['active'] = '';

	$frames['member']['title'] = '会员管理';
	$frames['member']['active'] = '';
	$frames['member']['items'] = array();

	$frames['member']['items']['member']['url'] = url('site/entry/member',array('m'=>$name));
	$frames['member']['items']['member']['title'] = '会员管理';
	$frames['member']['items']['member']['actions'] = array();
	$frames['member']['items']['member']['active'] = '';

	$frames['member']['items']['v']['url'] = url('site/entry/v',array('m'=>$name));
	$frames['member']['items']['v']['title'] = '快递管理';
	$frames['member']['items']['v']['actions'] = array();
	$frames['member']['items']['v']['active'] = '';

	$frames['member']['items']['runner']['url'] = url('site/entry/runner',array('m'=>$name));
	$frames['member']['items']['runner']['title'] = '监控台';
	$frames['member']['items']['runner']['actions'] = array();
	$frames['member']['items']['runner']['active'] = '';

	$frames['member']['items']['runner_level']['url'] = url('site/entry/runner_level',array('m'=>$name));
	$frames['member']['items']['runner_level']['title'] = '信誉等级';
	$frames['member']['items']['runner_level']['actions'] = array();
	$frames['member']['items']['runner_level']['active'] = '';

	$frames['manage']['title'] = '运营管理';
	$frames['manage']['active'] = '';
	$frames['manage']['items'] = array();

	$frames['manage']['items']['task']['url'] = url('site/entry/task',array('m'=>$name));
	$frames['manage']['items']['task']['title'] = '任务管理';
	$frames['manage']['items']['task']['actions'] = array();
	$frames['manage']['items']['task']['active'] = '';

	$frames['manage']['items']['recive']['url'] = url('site/entry/recive',array('m'=>$name));
	$frames['manage']['items']['recive']['title'] = '最新接单';
	$frames['manage']['items']['recive']['actions'] = array();
	$frames['manage']['items']['recive']['active'] = '';

	$frames['manage']['items']['star']['url'] = url('site/entry/star',array('m'=>$name));
	$frames['manage']['items']['star']['title'] = '最新评价';
	$frames['manage']['items']['star']['actions'] = array();
	$frames['manage']['items']['star']['active'] = '';

	$frames['manage']['items']['tasks_log']['url'] = url('site/entry/tasks_log',array('m'=>$name));
	$frames['manage']['items']['tasks_log']['title'] = '最新进度';
	$frames['manage']['items']['tasks_log']['actions'] = array();
	$frames['manage']['items']['tasks_log']['active'] = '';


	if($_W['role'] == 'founder'){
		$frames['founder']['title'] = '管理员特权';
		$frames['founder']['active'] = '';
		$frames['founder']['items'] = array();

		$frames['founder']['items']['delete']['url'] = url('site/entry/delete',array('m'=>$name));
		$frames['founder']['items']['delete']['title'] = '清理数据';
		$frames['founder']['items']['delete']['actions'] = array();
		$frames['founder']['items']['delete']['active'] = '';
	}
	return $frames;
}
function _calc_current_frames2(&$frames) {
	global $_W,$_GPC,$frames;
	if(!empty($frames) && is_array($frames)) {
		foreach($frames as &$frame) {
			foreach($frame['items'] as &$fr) {
				$query = parse_url($fr['url'], PHP_URL_QUERY);
				parse_str($query, $urls);
				if(defined('ACTIVE_FRAME_URL')) {
					$query = parse_url(ACTIVE_FRAME_URL, PHP_URL_QUERY);
					parse_str($query, $get);
				} else {
					$get = $_GET;
				}
				if(!empty($_GPC['a'])) {
					$get['a'] = $_GPC['a'];
				}
				if(!empty($_GPC['c'])) {
					$get['c'] = $_GPC['c'];
				}
				if(!empty($_GPC['do'])) {
					$get['do'] = $_GPC['do'];
				}
				if(!empty($_GPC['doo'])) {
					$get['doo'] = $_GPC['doo'];
				}
				if(!empty($_GPC['op'])) {
					$get['op'] = $_GPC['op'];
				}
				if(!empty($_GPC['m'])) {
					$get['m'] = $_GPC['m'];
				}
				$diff = array_diff_assoc($urls, $get);

				if(empty($diff)) {
					$fr['active'] = ' active';
					$frame['active'] = ' active';
				}
			}
		}
	}
}