<?php
/**
 * �� �� Դ �� ��
 *
 */
defined('IN_IA') or exit('Access Denied');

class iweite_vodsModule extends WeModule {

	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		if(checksubmit()) {
			//�ֶ���֤, �������ȷ������$dat
			$this->saveSettings($dat);
		}
		//������չʾ�������
		include $this->template('setting');
	}

}