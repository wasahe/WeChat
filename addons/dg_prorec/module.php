<?php
/**
 * 产品介绍群发模块定义
 *
 * @author 夺冠互动
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
class Dg_prorecModule extends WeModule {

	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		//点击模块设置时将调用此方法呈现模块设置页面，$settings 为模块设置参数, 结构为数组。这个参数系统针对不同公众账号独立保存。
		//在此呈现页面中自行处理post请求并保存设置参数（通过使用$this->saveSettings()来实现）
/*		empty($settings['dg_prorec_templateid']) && $settings['dg_prorec_templateid']="OPENTM207685059";*/
		empty($settings['dg_prorec_title']) && $settings['dg_prorec_title']=$_W['account']['name']."更新助手";
		if(checksubmit('submit')) {
			//字段验证, 并获得正确的数据$dat
/*			$dat['dg_prorec_templateid']=$_GPC['dg_prorec_templateid'];*/
			$dat['dg_prorec_title']=$_GPC['dg_prorec_title'];
			if (!$this->saveSettings($dat)) {
				message('设置失败','','error');
			} else {
				message('设置成功','','success');
			}
		}
		//这里来展示设置项表单
		include $this->template('setting');
	}

}