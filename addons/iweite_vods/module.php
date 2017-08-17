<?php
/**
 * 易 福 源 码 网
 *
 */
defined('IN_IA') or exit('Access Denied');

class iweite_vodsModule extends WeModule {

	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		if(checksubmit()) {
			//字段验证, 并获得正确的数据$dat
			$this->saveSettings($dat);
		}
		//这里来展示设置项表单
		include $this->template('setting');
	}

}