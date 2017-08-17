<?php
defined('IN_IA') or die('Access Denied');
class yukiho_zvoiceModule extends WeModule
{
	public function settingsDisplay($settings)
	{
		global $_W, $_GPC;
		$item = $this->module['config'];
		if (checksubmit()) {
			$data = array();
			if (!empty($_GPC['answerVerify'])) {
				$data['answerVerify'] = trim($_GPC['answerVerify']);
			}
			if (!empty($_GPC['answerWithLink'])) {
				$data['answerWithLink'] = trim($_GPC['answerWithLink']);
			}
			if (!empty($_GPC['share_title'])) {
				$data['share_title'] = trim($_GPC['share_title']);
			}
			if (!empty($_GPC['share_desc'])) {
				$data['share_desc'] = trim($_GPC['share_desc']);
			}
			if (!empty($_GPC['share_image'])) {
				$data['share_image'] = tomedia(trim($_GPC['share_image']));
			}
			$this->saveSettings($data);
			message('保存成功', referer(), 'success');
		}
		include $this->template('setting');
	}
}