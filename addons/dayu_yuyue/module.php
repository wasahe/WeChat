<?php
/**
 * 悟空源码网 www.5kym.com出品
 *
 */
defined('IN_IA') or exit('Access Denied');

class dayu_yuyueModule extends WeModule {
	public function fieldsFormDisplay($rid = 0) {
		global $_W;
		if($rid) {
			$reply = pdo_fetch("SELECT * FROM " . tablename('dayu_yuyue_reply') . " WHERE rid = :rid", array(':rid' => $rid));
			$sql = 'SELECT * FROM ' . tablename('dayu_yuyue') . ' WHERE `weid`=:weid AND `reid`=:reid';
			$activity = pdo_fetch($sql, array(':weid' => $_W['weid'], ':reid' => $reply['reid']));
		}
		include $this->template('form');
	}

	public function fieldsFormValidate($rid = 0) {
		global $_GPC;
		$reid = intval($_GPC['activity']);
		if($reid) {
			$sql = 'SELECT * FROM ' . tablename('dayu_yuyue') . " WHERE `reid`=:reid";
			$params = array();
			$params[':reid'] = $reid;
			$activity = pdo_fetch($sql, $params);
			if(!empty($activity)) {
				return '';
			}
		}
		return '没有选择合适的预约活动';
	}

	public function fieldsFormSubmit($rid) {
		global $_GPC;
		$reid = intval($_GPC['activity']);
		$record = array();
		$record['reid'] = $reid;
		$record['rid'] = $rid;
		$reply = pdo_fetch("SELECT * FROM " . tablename('dayu_yuyue_reply') . " WHERE rid = :rid", array(':rid' => $rid));
		if($reply) {
			pdo_update('dayu_yuyue_reply', $record, array('id' => $reply['id']));
		} else {
			pdo_insert('dayu_yuyue_reply', $record);
		}
	}

	public function ruleDeleted($rid) {
		pdo_delete('dayu_yuyue_reply', array('rid' => $rid));
	}

	public function settingsDisplay($settings) {
		global $_GPC, $_W;
		if(checksubmit()) {
			$cfg = array(
				'instore' => $_GPC['instore'],
				'zhicheng' => $_GPC['zhicheng'],
				'shangmen' => $_GPC['shangmen'],
				'skin' => $_GPC['skin'],
			);
			if($this->saveSettings($cfg)) {
				message('保存成功', 'refresh');
			}
		}
		include $this->template('setting');
	}
}