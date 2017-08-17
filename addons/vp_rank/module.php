<?php
 

defined('IN_IA') || exit('Access Denied');
class Vp_rankModule extends WeModule
{
	public function settingsDisplay($settings)
	{
		global $_GPC;
		$_FILES = &$_FILES;
		global $_W;

		if (checksubmit()) {
			$cfg = array('mchid' => $_GPC['mchid'], 'appid' => $_GPC['appid'], 'key' => $_GPC['key'], 'ip' => $_GPC['ip'], 'bd_ak' => $_GPC['bd_ak'], 'qn_ak' => $_GPC['qn_ak'], 'qn_sk' => $_GPC['qn_sk'], 'qn_bucket' => $_GPC['qn_bucket'], 'qn_api' => $_GPC['qn_api'], 'fo_img' => $_GPC['fo_img'], 'fo_text' => $_GPC['fo_text'], 'fo_time' => $_GPC['fo_time']);
			load()->func('file');

			if (!empty($_FILES['cert_rootca']['tmp_name'])) {
				$cert_rootca = file_upload($_FILES['cert_rootca']);
				$cfg['cert_rootca'] = $cert_rootca;
			}
			 else {
				$cfg['cert_rootca'] = $settings['cert_rootca'];
			}

			if (!empty($_FILES['cert_cert']['tmp_name'])) {
				$cert_cert = file_upload($_FILES['cert_cert']);
				$cfg['cert_cert'] = $cert_cert;
			}
			 else {
				$cfg['cert_cert'] = $settings['cert_cert'];
			}

			if (!empty($_FILES['cert_key']['tmp_name'])) {
				$cert_key = file_upload($_FILES['cert_key']);
				$cfg['cert_key'] = $cert_key;
			}
			 else {
				$cfg['cert_key'] = $settings['cert_key'];
			}

			if ($this->saveSettings($cfg)) {
				message('保存成功', 'refresh');
			}

		}


		load()->func('tpl');
		include $this->template('setting');
	}
}


?>