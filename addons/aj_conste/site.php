<?php
/**
 * 星座书模块微站定义
 *
 * @author 超级无语
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class Aj_consteModuleSite extends WeModuleSite {

	public function doWebManage(){
		global $_GPC,  $_W;
		$uniacid = $_W["uniacid"];

		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$where = $_GPC['title'] ? " AND title LIKE '%{$_GPC['title']}%'" : '';

		$list = pdo_fetchall( 'SELECT * FROM '.tablename('aj_conste' ).' WHERE uniacid = :uniacid '.$where.' ORDER BY id DESC  LIMIT '. ($pindex -1) * $psize . ',' .$psize , array(':uniacid' => $uniacid));
		$total = pdo_fetchcolumn( 'SELECT COUNT(*) FROM '.tablename('aj_conste').' WHERE uniacid = :uniacid'.$where, array(':uniacid' => $uniacid) );
		$pager = pagination($total, $pindex, $psize);

		include $this->template('manage');
	}
	 public function doWebdelete() {
        global $_GPC, $_W;
        $rid = intval($_GPC['rid']);
        $rule = pdo_fetch("SELECT id, module FROM " . tablename('rule') . " WHERE id = :id and uniacid=:weid", array(':id' => $rid, ':weid' => $_W['uniacid']));
        if (empty($rule)) {
            message('抱歉，要修改的规则不存在或是已经被删除！');
        }
        if (pdo_delete('rule', array('id' => $rid))) {
            pdo_delete('rule_keyword', array('rid' => $rid));
            //删除统计相关数据
            pdo_delete('stat_rule', array('rid' => $rid));
            pdo_delete('stat_keyword', array('rid' => $rid));
        }
        message('规则操作成功！', $this->createWebUrl('manage', array('op' => 'display')), 'success');
    }

}