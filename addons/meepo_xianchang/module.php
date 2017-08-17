<?php
defined('IN_IA') or die('Access Denied');
class Meepo_xianchangModule extends WeModule
{
	public $basic_config_table = 'meepo_xianchang_basic_config';
	public $user_table = 'meepo_xianchang_user';
	public $xc_table = 'meepo_xianchang_rid';
	public $wall_table = 'meepo_xianchang_wall';
	public $wall_config_table = 'meepo_xianchang_wall_config';
	public $cookie_table = 'meepo_xianchang_cookie';
	public $qd_table = 'meepo_xianchang_qd';
	public $qd_config_table = 'meepo_xianchang_qd_config';
	public $lottory_award_table = 'meepo_xianchang_lottory_award';
	public $lottory_user_table = 'meepo_xianchang_lottory_user';
	public $lottory_config_table = 'meepo_xianchang_lottory_config';
	public $jb_table = 'meepo_xianchang_jb';
	public $vote_table = 'meepo_xianchang_vote';
	public $vote_xms_table = 'meepo_xianchang_vote_xms';
	public $vote_record = 'meepo_xianchang_vote_record';
	public $shake_rotate_table = 'meepo_xianchang_shake_rotate';
	public $shake_user_table = 'meepo_xianchang_shake_user';
	public $shake_config_table = 'meepo_xianchang_shake_config';
	public $xc2_table = 'meepo_xianchang_xc';
	public $bd_manage_table = 'meepo_xianchang_bd';
	public $bd_data_table = 'meepo_xianchang_bd_data';
	public $sd_config_table = 'meepo_xianchang_3d_config';
	public $redpack_config_table = 'meepo_xianchang_redpack_config';
	public $redpack_user_table = 'meepo_xianchang_redpack_user';
	public $redpack_rotate_table = 'meepo_xianchang_redpack_rotate';
	public function fieldsFormDisplay($rid = 0)
	{
		global $_W;
		load()->func('tpl');
		if (!empty($rid)) {
			$reply = pdo_fetch("SELECT * FROM " . tablename($this->xc_table) . " WHERE rid = :rid", array(':rid' => $rid));
			$reply['controls'] = iunserializer($reply['controls']);
		}
		if (!$reply['status']) {
			$reply['status'] = 1;
		}
		if (!$reply['gz_must']) {
			$reply['gz_must'] = 0;
		}
		include $this->template('form');
	}
	public function fieldsFormValidate($rid = 0)
	{
		return '';
	}
	public function fieldsFormSubmit($rid)
	{
		global $_W, $_GPC;
		$id = intval($_GPC['reply_id']);
		$insert = array();
		$insert = array('rid' => $rid, 'weid' => $_W['uniacid'], 'title' => $_GPC['title'], 'status' => intval($_GPC['status']), 'pass_word' => $_GPC['pass_word'], 'gz_url' => $_GPC['gz_url'], 'gz_must' => intval($_GPC['gz_must']));
		$insert['controls'] = iserializer($_GPC['controls']);
		$insert['start_time'] = strtotime($_GPC['ac_times']['start']);
		$insert['end_time'] = strtotime($_GPC['ac_times']['end']);
		if (empty($id)) {
			pdo_insert($this->xc_table, $insert);
		} else {
			pdo_update($this->xc_table, $insert, array('id' => $id));
		}
	}
	public function ruleDeleted($rid)
	{
		global $_W;
		pdo_delete($this->xc_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->basic_config_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->user_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->qd_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->qd_config_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->wall_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->wall_config_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->lottory_award_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->lottory_config_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->jb_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->vote_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->vote_xms_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->vote_record, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->shake_rotate_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->shake_user_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->shake_config_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->xc2_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->bd_manage_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->bd_data_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->sd_config_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->redpack_config_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->redpack_user_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		pdo_delete($this->redpack_rotate_table, array('rid' => $rid, 'weid' => $_W['uniacid']));
		return true;
	}
}