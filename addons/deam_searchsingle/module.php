<?php
/**
 * 寻找单身狗模块定义
 *
 * @author deam
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class Deam_searchsingleModule extends WeModule {
	public function fieldsFormDisplay($rid = 0) {
		global $_W;
		load()->func('tpl');
		$getact = pdo_fetchall("SELECT * FROM " . tablename('deam_searchsingle_actset') . " WHERE uniacid = :uniacid ORDER BY `id` DESC", array(':uniacid' => $_W['uniacid']));
		include $this->template('systerm/ruleform');
	}

	public function fieldsFormValidate($rid = 0) {
		//规则编辑保存时，要进行的数据验证，返回空串表示验证无误，返回其他字符串将呈现为错误提示。这里 $rid 为对应的规则编号，新增时为 0
		return '';
	}

	public function fieldsFormSubmit($rid) {
		global $_GPC,$_W;
		$id = intval($_GPC['actid']);
		pdo_update('deam_searchsingle_actset', 'rule_id=0', array('rule_id' => $rid,'uniacid'=>$_W['uniacid']));
		pdo_update('deam_searchsingle_actset', 'rule_id='.$rid, array('id' => $id));
	}

	public function ruleDeleted($rid) {
		global $_GPC,$_W;
		pdo_update('deam_searchsingle_actset', 'rule_id=0', array('rule_id' => $rid,'uniacid'=>$_W['uniacid']));
	}

}