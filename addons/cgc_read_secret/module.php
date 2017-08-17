<?php


defined('IN_IA') || exit('Access Denied');
class cgc_read_secretModule extends WeModule
{
	public function settingsDisplay($settings)
	{
		global $_W;
		global $_GPC;
		load()->func('tpl');

		if (!empty($settings['question_list'])) {
			$settings['question_list'] = unserialize($settings['question_list']);
		}


		if (checksubmit()) {
			load()->func('file');
			$_W['uploadsetting'] = array();
			$_W['uploadsetting']['image']['folder'] = 'images/' . $_W['uniacid'];
			$_W['setting']['upload']['image']['extentions'] = array_merge($_W['setting']['upload']['image']['extentions'], array('pem'));
			$_W['uploadsetting']['image']['limit'] = $_W['config']['upload']['image']['limit'];

			if (!empty($_FILES['apiclient_cert_file']['name'])) {
				$file = file_upload($_FILES['apiclient_cert_file']);

				if (is_error($file)) {
					message('apiclient_cert证书保存失败, 请保证目录可写' . $file['message']);
				}
				 else {
					$_GPC['apiclient_cert'] = (empty($file['path']) ? trim($_GPC['apiclient_cert']) : ATTACHMENT_ROOT . '/' . $file['path']);
				}
			}


			if (!empty($_FILES['apiclient_key_file']['name'])) {
				$file = file_upload($_FILES['apiclient_key_file']);

				if (is_error($file)) {
					message('apiclient_key证书保存失败, 请保证目录可写' . $file['message']);
				}
				 else {
					$_GPC['apiclient_key'] = (empty($file['path']) ? trim($_GPC['apiclient_key']) : ATTACHMENT_ROOT . '/' . $file['path']);
				}
			}


			if (!empty($_FILES['rootca_file']['name'])) {
				$file = file_upload($_FILES['rootca_file']);

				if (is_error($file)) {
					message('rootca证书保存失败, 请保证目录可写' . $file['message']);
				}
				 else {
					$_GPC['rootca'] = (empty($file['path']) ? trim($_GPC['rootca']) : ATTACHMENT_ROOT . '/' . $file['path']);
				}
			}


			$question_list = array();
			$question = $_GPC['question'];

			if (!empty($question) && is_array($question_list)) {
				foreach ($question as $key => $value ) {
					$d = array('question' => $question[$key]);
					$question_list[] = $d;
				}
			}


			if (!empty($question_list)) {
				$_GPC['question_list'] = serialize($question_list);
			}


			$input = array();
			$input['apiclient_cert'] = trim($_GPC['apiclient_cert']);
			$input['apiclient_key'] = trim($_GPC['apiclient_key']);
			$input['rootca'] = trim($_GPC['rootca']);
			$input['appid'] = trim($_GPC['appid']);
			$input['secret'] = trim($_GPC['secret']);
			$input['mchid'] = trim($_GPC['mchid']);
			$input['password'] = trim($_GPC['password']);
			$input['ip'] = trim($_GPC['ip']);
			$input['act_name'] = trim($_GPC['act_name']);
			$input['send_name'] = trim($_GPC['send_name']);
			$input['remark'] = trim($_GPC['remark']);
			$input['pay_desc'] = trim($_GPC['pay_desc']);
			$input['iplimit'] = trim($_GPC['iplimit']);
			$input['locationtype'] = trim($_GPC['locationtype']);
			$input['copy_right'] = trim($_GPC['copy_right']);
			$input['share_thumb'] = trim($_GPC['share_thumb']);
			$input['share_desc'] = trim($_GPC['share_desc']);
			$input['share_title'] = trim($_GPC['share_title']);
			$input['share_url'] = trim($_GPC['share_url']);
			$input['succ_url'] = trim($_GPC['succ_url']);
			$input['task_close'] = trim($_GPC['task_close']);
			$input['header_desc'] = trim($_GPC['header_desc']);
			$input['footer_desc1'] = trim($_GPC['footer_desc1']);
			$input['footer_btn1'] = trim($_GPC['footer_btn1']);
			$input['footer_btn2'] = trim($_GPC['footer_btn2']);
			$input['footer_desc2'] = trim($_GPC['footer_desc2']);
			$input['footer_logo'] = trim($_GPC['footer_logo']);
			$input['user_word'] = trim($_GPC['user_word']);
			$input['users_text'] = trim($_GPC['users_text']);
			$input['footer_text'] = trim($_GPC['footer_text']);
			$input['share_btn'] = trim($_GPC['share_btn']);
			$input['pay_text'] = trim($_GPC['pay_text']);
			$input['tx_type'] = trim($_GPC['tx_type']);
			$input['tx_limit'] = trim($_GPC['tx_limit']);
			$input['sx_bl'] = trim($_GPC['sx_bl']);
			$input['ys_pay'] = trim($_GPC['ys_pay']);
			$input['yunpay_no'] = trim($_GPC['yunpay_no']);
			$input['yunpay_pid'] = trim($_GPC['yunpay_pid']);
			$input['yunpay_key'] = trim($_GPC['yunpay_key']);
			$input['close_mode'] = trim($_GPC['close_mode']);
			$input['must_guanzhu'] = trim($_GPC['must_guanzhu']);
			$input['guanzhu_url'] = trim($_GPC['guanzhu_url']);
			$input['dead_module'] = trim($_GPC['dead_module']);
			$input['share_type'] = trim($_GPC['share_type']);
			$input['followinfo_show'] = trim($_GPC['followinfo_show']);
			$input['pay_title'] = trim($_GPC['pay_title']);
			$input['footer_home'] = trim($_GPC['footer_home']);
			$input['footer_url'] = trim($_GPC['footer_url']);
			$input['question_list'] = trim($_GPC['question_list']);
			$input['bg_thumb'] = trim($_GPC['bg_thumb']);
			$input['succ_url'] = trim($_GPC['succ_url']);

			if ($this->saveSettings($input)) {
				message('保存参数成功', 'refresh');
			}

		}


		if (empty($settings['ip'])) {
			$settings['ip'] = $_SERVER['SERVER_ADDR'];
		}


		include $this->template('setting');
	}

	public function fieldsFormValidate($rid = 0)
	{
		return '';
	}

	public function fieldsFormSubmit($rid)
	{
	}

	public function ruleDeleted($rid)
	{
	}
}


?>