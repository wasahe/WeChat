<?php

//decode by QQ:3213288469 http://www.zheyitianshi.com/
class ChatroomModel
{
	static function info($room_id)
	{
		global $_W;
		static $infos = array();
		if (!isset($infos[$room_id])) {
			$info = pdo_fetch("select * from " . tablename('sunshine_huayue_chatroom') . " where uniacid={$_W['uniacid']} and id={$room_id}");
			$infos[$room_id] = $info;
		}
		return $infos[$room_id];
	}
	static function isCreator($openid, $room_id)
	{
		$roominfo = self::info($room_id);
		if ($roominfo && $roominfo['creator'] == $openid) {
			return true;
		}
		return false;
	}
	static function getList($is_approve = 'allow')
	{
		global $_W;
		return pdo_fetchall('select * from ' . tablename('sunshine_huayue_chatroom') . " where room_status='normal' and uniacid={$_W['uniacid']} and is_approve='{$is_approve}' order by sort_id desc");
	}
	static function getListByStatus($status = 'normal')
	{
		global $_W;
		return pdo_fetchall('select * from ' . tablename('sunshine_huayue_chatroom') . " where room_status='{$status}' and uniacid={$_W['uniacid']}");
	}
	static function getFrontList()
	{
		global $_W;
		return pdo_fetchall("select * from " . tablename('sunshine_huayue_chatroom') . " where room_status='normal' and uniacid={$_W['uniacid']} and is_approve='allow' and is_public='y' order by sort_id desc ");
	}
	static function createChatRoom($name, $desc, $logo, $creator = 'system', $is_public = 'y', $in_type = 'no_type', $room_secret = 'n', $room_type = 'normal', $room_money = '0', $room_money_day = '0')
	{
		global $_W;
		if (!$name || !$desc || !$logo || !$creator) {
			return array('res' => '101', 'msg' => '参数错误');
		}
		$info = pdo_fetch("select * from " . tablename('sunshine_huayue_chatroom') . " where room_name = :room_name and uniacid={$_W['uniacid']}", array(':room_name' => $name));
		if ($info) {
			return array('res' => '101', 'msg' => '该聊天室名称已存在');
		}
		$data = array();
		$data['uniacid'] = $_W['uniacid'];
		$data['creator'] = $creator;
		$data['room_name'] = $name;
		$data['room_desc'] = $desc;
		$data['room_logo'] = $logo;
		$data['room_type'] = $room_type;
		$data['is_public'] = $is_public;
		$data['in_type'] = $in_type;
		$data['room_secret'] = $room_secret;
		$data['room_money'] = $room_money;
		$data['room_money_day'] = $room_money_day;
		$data['is_approve'] = $creator == 'system' ? 'allow' : 'wait';
		$data['add_date'] = date("Y-m-d");
		$data['add_time'] = date("Y-m-d H:i:s");
		$res = pdo_insert('sunshine_huayue_chatroom', $data);
		if ($res) {
			return array('res' => '100', 'msg' => '添加成功');
		}
		return array('res' => '101', 'msg' => '添加失败');
	}
	static function setRobot($id, $is_robot)
	{
		global $_W;
		return pdo_update("sunshine_huayue_chatroom", array('is_robot' => $is_robot), array('id' => $id, 'uniacid' => $_W['uniacid']));
	}
	static function getListByOpenid($openid)
	{
		global $_W;
		return pdo_fetchall("select * from " . tablename('sunshine_huayue_chatroom') . " where uniacid='{$_W['uniacid']}' and creator = '{$openid}' and room_status='normal'");
	}
}