<?php

//decode by QQ:3213288469 http://www.zheyitianshi.com/
class ChatModel
{
	static function chatInit($chat_openid, $self_openid)
	{
		global $_W;
		$talk_sign = self::talkSign($chat_openid, $self_openid);
		if (!$chat_openid) {
			return false;
		}
		$res = pdo_fetch("select * from " . tablename('sunshine_huayue_chat') . " where user_openid=:user_openid and to_openid=:to_openid and uniacid={$_W['uniacid']}", array(':user_openid' => $self_openid, ':to_openid' => $chat_openid));
		if (!$res) {
			$defriend_status = DefriendModel::status($self_openid, $chat_openid);
			if ($defriend_status) {
				return array('res' => '104', 'msg' => '您将对方加入了黑名单，移出后可以发起聊天');
			}
			$defriend_status = DefriendModel::status($chat_openid, $self_openid);
			if ($defriend_status) {
				return array('res' => '102', 'msg' => '对方拒绝了您的消息');
			}
			$insertdata = array();
			$insertdata['uniacid'] = $_W['uniacid'];
			$insertdata['talk_sign'] = $talk_sign;
			$insertdata['user_openid'] = $self_openid;
			$insertdata['to_openid'] = $chat_openid;
			$insertdata['add_time'] = date('Y-m-d H:i:s');
			$r = pdo_insert('sunshine_huayue_chat', $insertdata, true);
			if ($r) {
				return array('res' => '100', 'msg' => 'first init');
			}
			return array('res' => '101', 'msg' => 'first init fail');
		} else {
			$res = pdo_fetch("select * from " . tablename('sunshine_huayue_chat') . " where user_openid=:user_openid and to_openid=:to_openid and uniacid={$_W['uniacid']}", array(':to_openid' => $self_openid, ':user_openid' => $chat_openid));
			if ($res) {
				$defriend_status = DefriendModel::status($self_openid, $chat_openid);
				if ($defriend_status) {
					return array('res' => '104', 'msg' => '您将对方加入了黑名单，移出后可以发起聊天');
				}
				$defriend_status = DefriendModel::status($chat_openid, $self_openid);
				if ($defriend_status) {
					return array('res' => '102', 'msg' => '对方拒绝了您的消息');
				}
				return array('res' => '100', 'msg' => 'success');
			} else {
				$res = pdo_fetch("select count(*) as num from " . tablename('sunshine_huayue_chatmessage') . " where send_openid=:openid and talk_sign=:talk_sign and uniacid={$_W['uniacid']}", array(':openid' => $self_openid, ':talk_sign' => $talk_sign));
				if ($res['num'] >= 3) {
					return array('res' => '103', 'msg' => 'already 3 messages,please wait');
				}
				return array('res' => '100', 'msg' => 'not enough 3 message');
			}
		}
	}
	static function talkSign($openid_a, $openid_b)
	{
		if (strcmp($openid_a, $openid_b) >= 0) {
			return $openid_a . ":" . $openid_b;
		} else {
			return $openid_b . ":" . $openid_a;
		}
	}
}