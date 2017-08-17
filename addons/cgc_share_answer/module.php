<?php
 

defined('IN_IA') || exit('Access Denied');
class Cgc_share_answerModule extends WeModule
{
	public function settingsDisplay($settings)
	{
		global $_W;
		global $_GPC;

		if (checksubmit()) {
			$dat = $_GPC['dat'];
			$this->saveSettings($dat);
			message('保存参数成功', 'refresh');
		}


		include $this->template('setting');
	}
}


?>