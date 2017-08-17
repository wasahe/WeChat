<?php

//decode by QQ:3213288469 http://www.guifox.com/
defined('IN_IA') or die('Access Denied');
define('ROOT_PATH', str_replace('site.php', '', str_replace('\\', '/', __FILE__)));
define('INC_PATH', ROOT_PATH . 'inc/');
define('TEMPLATE_PATH', '../../addons/dg_newzl/template/style/');
class Dg_newzlModuleSite extends WeModuleSite
{
	public function doWebManage()
	{
		global $_GPC, $_W;
		load()->model('reply');
		$pindex = max(1, intval($_GPC['page']));
		$psize = 20;
		$params = array();
		$uniacid = $_W['uniacid'];
		$total = pdo_fetchcolumn("SELECT count(id) FROM " . tablename('newzl_reply') . " WHERE uniacid=" . $uniacid);
		$sql = "uniacid = :iacid AND `module` = :module";
		$params = array();
		$params[':iacid'] = $uniacid;
		$params[':module'] = 'dg_newzl';
		if (isset($_GPC['keywords'])) {
			$sql .= ' AND `huodongname` LIKE :keywords';
			$params[':keywords'] = "%{$_GPC['keywords']}%";
		}
		$list = reply_search($sql, $params, $pindex, $psize, $total);
		$pager = pagination($total, $pindex, $psize);
		$invitreply = "";
		if (!empty($list)) {
			foreach ($list as &$item) {
				$condition = "`rid`={$item['id']}";
				$item['keywords'] = reply_keywords_search($condition);
				$invitreply = pdo_fetch("SELECT * FROM " . tablename('newzl_reply') . " WHERE rid = :rid ", array(':rid' => $item['id']));
				$item['starttime'] = date('Y-m-d H:i', $invitreply['starttime']);
				$endtime = $invitreply['endtime'] + 86399;
				$item['endtime'] = date('Y-m-d H:i', $endtime);
				$nowtime = time();
				if ($invitreply['starttime'] > $nowtime) {
					$item['status'] = '<span class="label label-warning">未开始</span>';
				} else {
					if ($endtime < $nowtime) {
						$item['status'] = '<span class="label label-default ">已结束</span>';
					} else {
						if ($invitreply['subscribes'] == 1) {
							$item['status'] = '<span class="label label-success">已开始</span>';
						} else {
							$item['status'] = '<span class="label label-default ">已暂停</span>';
						}
					}
				}
			}
		}
		include $this->template('manage');
	}
	public function doWebRecord()
	{
		global $_GPC, $_W;
		load()->model('reply');
		load()->func('tpl');
		$rid = $_GPC["rid"];
		$uniacid = $_W['uniacid'];
		$pindex = max(1, intval($_GPC['page']));
		$psize = 10;
		$params = array();
		$total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('newzl_user') . " WHERE rid=" . $rid);
		$sql = "SELECT * FROM " . tablename('newzl_user') . "  WHERE rid = " . $rid . " and uniacid=" . $uniacid . ' ORDER BY  count  DESC LIMIT ' . ($pindex - 1) * $psize . ',' . $psize;
		$list = pdo_fetchall($sql, array());
		$pager = pagination($total, $pindex, $psize);
		include $this->template('record');
	}
	public function doWebInvit()
	{
		global $_GPC, $_W;
		$sharetable = "newzl_helpuser";
		$table = "newzl_user";
		$rid = $_GPC["rid"];
		$uniacid = $_W['uniacid'];
		$openid = $_GPC["openid"];
		$pindex = max(1, intval($_GPC['page']));
		$psize = 10;
		$params = array();
		$total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename('newzl_helpuser') . " WHERE rid=" . $rid);
		$sql = "SELECT s.usernick,s.userheadimg,s.addtime FROM " . tablename('newzl_helpuser') . " s inner join " . tablename('newzl_user') . "i on s.fromuserid=i.openid and s.h_id=i.id WHERE i.rid = " . $rid . " and s.fromuserid=:openid and s.uniacid=" . $uniacid . " ORDER BY s.id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
		$list = pdo_fetchall($sql, array(":openid" => $openid));
		foreach ($list as &$row) {
			$row['addtime'] = date('Y-m-d,H:i:s', $row['addtime']);
		}
		unset($row);
		$pager = pagination($total, $pindex, $psize);
		include $this->template('invit');
	}
	public function doWebHdControl()
	{
		global $_GPC, $_W;
		$status = $_GPC['status'];
		$rid = $_GPC["rid"];
		$data = array('status' => $status);
		$params = array('rid' => $rid);
		$re = pdo_update('newzl_reply', $data, $params);
		if (!empty($re)) {
			message('操作成功！', referer(), 'success');
		} else {
			message('操作失败！', referer(), 'success');
		}
	}
	public function doWebdelete()
	{
		global $_W, $_GPC;
		$rid = $_GPC['rid'];
		$re = pdo_delete('newzl_reply', array("rid" => $rid));
		if (!empty($re)) {
			message('操作成功！', referer(), 'success');
		} else {
			message('操作失败！', referer(), 'success');
		}
	}
	public function doWebInsert()
	{
		global $_W, $_GPC;
		$table = 'newzl_user';
		$rid = $_GPC['rid'];
		$id = $_GPC['id'];
		$sql = "select * from " . tablename($table) . "where rid=:rid and id=:id";
		$parms = array(":rid" => $rid, ":id" => $id);
		$user = pdo_fetch($sql, $parms);
		include $this->template('insert');
	}
	public function doWebInsertuser()
	{
		global $_W, $_GPC;
		$table = 'newzl_user';
		$rid = $_GPC['rid'];
		$openid = $_GPC['openid'];
		$sql = "select * from " . tablename($table) . "where rid=:rid and openid=:openid";
		$parms = array(":rid" => $rid, ":openid" => $openid);
		$user = pdo_fetch($sql, $parms);
		$count = $_GPC['count'];
		$sum = $user['count'] + $count;
		$insert = array("count" => $sum, "rid" => $rid, "openid" => $openid);
		$res = pdo_update($table, $insert, array('openid' => $openid));
		if (!empty($res)) {
			message('操作成功！', referer(), 'success');
		} else {
			message('操作失败！', referer(), 'success');
		}
	}
	function getUserInfo()
	{
		global $_GPC, $_W;
		$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
		$cuser_info = $_GPC['dg_user_info'];
		if (empty($cuser_info)) {
			$oauth2 = new Oauth2($_W['oauth_account']);
			if (empty($_GPC['code'])) {
				$oauth2->authorization_code($redirect_uri, Oauth2::$SCOPE_USERINFO, 'we7sid-' . $_W['session_id']);
			}
			$code = $_GPC['code'];
			$access_token = $oauth2->getOauthAccessToken($code);
			$user_info = $oauth2->getOauthUserInfo($access_token['openid'], $access_token['access_token']);
			$cookieKey = "dg_user_info";
			$cuser_info = $oauth2::setClientCookieUserInfo($user_info, $cookieKey);
		}
		$user_info = base64_decode($cuser_info);
		return $user_info;
	}
}