<?php

//decode by QQ:3213288469 http://www.guifox.com/
defined('IN_IA') or die('Access Denied');
class Dg_newzlModule extends WeModule
{
	public $table = 'newzl_reply';
	public $tablealtgs = 'newzl_altgs';
	public function fieldsFormDisplay($rid = 0)
	{
		global $_W, $_GPC;
		load()->func('tpl');
		if (!empty($rid)) {
			$reply = pdo_fetch("select * from" . tablename('newzl_reply') . "where rid=:rid order by id desc limit 1", array(":rid" => $rid));
			$id = $reply['id'];
			$piclistinfo = pdo_fetchall("select thumb from " . tablename('newzl_altgs') . "where t_id=" . $id);
			foreach ($piclistinfo as $value) {
				$piclist[] = $value['thumb'];
			}
		}
		if (!$reply) {
			$now = time();
			$reply = array('starttime' => $now, 'endtime' => strtotime(date("Y-m-d H:i", $now + 7 * 24 * 3600)));
		}
		include $this->template('from');
	}
	public function fieldsFormValidate($rid = 0)
	{
		return '';
	}
	public function fieldsFormSubmit($rid)
	{
		global $_W, $_GPC;
		$uniacid = $_W['uniacid'];
		$id = intval($_GPC['id']);
		$images = $_GPC['img'];
		$insert = array('rid' => $rid, 'uniacid' => $uniacid, 'titile' => $_GPC['title'], 'desc' => htmlspecialchars_decode($_GPC['desc']), 'tw_title' => $_GPC['tw_title'], 'tw_img' => $_GPC['tw_img'], 'tw_desc' => $_GPC['tw_desc'], 'share_title' => $_GPC['share_title'], 'share_img' => $_GPC['share_img'], 'share_desc' => $_GPC['share_desc'], 'starttime' => strtotime($_GPC['datelimit']['start']), 'endtime' => strtotime($_GPC['datelimit']['end']), 'province' => $_GPC['province'], 'city' => $_GPC['city'], 'ipcount' => $_GPC['ipcount']);
		if (empty($id)) {
			$ret = pdo_insert('newzl_reply', $insert);
			if (!empty($ret)) {
				$id = pdo_insertid();
			}
			if ($images) {
				foreach ($images as $key => $value) {
					$data1 = array('thumb' => $images[$key], 't_id' => $id);
					pdo_insert('newzl_altgs', $data1);
				}
			}
		} else {
			if ($images) {
				pdo_delete('newzl_altgs', array("t_id" => $id));
				foreach ($images as $key => $value) {
					$data1 = array('thumb' => $images[$key], 't_id' => $id);
					pdo_insert('newzl_altgs', $data1);
				}
			}
			pdo_update('newzl_reply', $insert, array('id' => $id));
		}
	}
	public function ruleDeleted($rid)
	{
		pdo_delete('newzl_reply', array('rid' => $rid));
		pdo_delete('newzl_user', array('rid' => $rid));
		pdo_delete('newzl_helpuser', array('rid' => $rid));
	}
	public function settingsDisplay($settings)
	{
		global $_W, $_GPC;
		if (checksubmit()) {
			$this->saveSettings($dat);
		}
		include $this->template('setting');
	}
}