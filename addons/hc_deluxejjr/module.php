<?php
defined('IN_IA') || exit('Access Denied');
class hc_deluxejjrModule extends WeModule
{
	public function fieldsFormDisplay($rid = 0)
	{
	}

	public function fieldsFormValidate($rid = 0)
	{
	}

	public function fieldsFormSubmit($rid)
	{
	}

	public function ruleDeleted($rid)
	{
	}

	public function settingsDisplay($settings)
	{
		global $_GPC;
		global $_W;

		if (checksubmit()) {
			$cfg = array();
			$cfg['appid'] = $_GPC['appid'];
			$cfg['secret'] = $_GPC['secret'];
			$cfg['protectdate'] = intval($_GPC['protectdate']);

			if ($this->saveSettings($cfg)) {
				message('保存成功', 'refresh');
			}

		}


		include $this->template('setting');
	}
}


?>