<?php

//decode by QQ:3213288469 http://www.guifox.com/
defined('IN_IA') or die('Access Denied');
class Dg_newzlModuleProcessor extends WeModuleProcessor
{
	public function respond()
	{
		$content = $this->message['content'];
		global $_W, $_GPC;
		$rid = $this->rule;
		$uniacid = $_W['uniacid'];
		$table = 'newzl_reply';
		$sql = "select * from " . tablename($table) . "where rid=:rid and uniacid=:uniacid order by id desc limit 1";
		$parms = array(":rid" => $rid, ":uniacid" => $uniacid);
		$replyinfo = pdo_fetch($sql, $parms);
		return $this->respNews(array('Title' => $replyinfo['tw_title'], 'Description' => $replyinfo['tw_desc'], 'PicUrl' => tomedia($replyinfo['tw_img']), 'Url' => $this->createMobileUrl('index', array('rid' => $rid, "uniacid" => $uniacid))));
	}
}