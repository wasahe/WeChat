<?php

//decode by QQ:3213288469 http://www.zheyitianshi.com/
class ChatroomLogModel
{
	static function del($id, $room_id)
	{
		global $_W;
		return pdo_update("sunshine_huayue_chatroom_log", array('is_del' => 'y'), array('uniacid' => $_W['uniacid'], 'id' => $id, 'rid' => $room_id));
	}
	static function unReadNums($room_id, $openid)
	{
		global $_W;
		return pdo_fetch("select count(*) as num from (select id,openid from " . tablename('sunshine_huayue_chatroom_log') . " where rid=:rid and openid=:openid and uniacid={$_W['uniacid']} order by id desc limit 1) as n," . tablename('sunshine_huayue_chatroom_log') . " as t where t.id>n.id and t.rid=:rid", array(':rid' => $room_id, ':openid' => $openid));
	}
	static function history($room_id, $prev_logid = '', $num = 30)
	{
		global $_W;
		if ($prev_logid) {
			$sql = " and id < {$prev_logid} ";
		}
		return pdo_fetchall("select * from (select * from " . tablename('sunshine_huayue_chatroom_log') . " where rid=:rid and uniacid={$_W['uniacid']} {$sql} order by add_time desc limit {$num}) as n order by add_time asc", array(':rid' => $room_id));
	}
	static function getUnreadList($room_id, $openid, $logid)
	{
		global $_W;
		return pdo_fetchall("select * from (select * from " . tablename('sunshine_huayue_chatroom_log') . " where id>:id and rid=:rid and openid <> :openid and uniacid={$_W['uniacid']}) as n order by add_time asc", array(':id' => $logid, ':rid' => $room_id, ':openid' => $openid));
	}
	static function addItem($room_id, $openid, $content, $type)
	{
		global $_W;
		$data = array();
		$data['uniacid'] = $_W['uniacid'];
		$data['rid'] = $room_id;
		$data['openid'] = $openid;
		$data['content'] = $content;
		$data['type'] = $type;
		$data['add_time'] = date('Y-m-d H:i:s');
		$res = pdo_insert('sunshine_huayue_chatroom_log', $data);
		return $res;
	}
}