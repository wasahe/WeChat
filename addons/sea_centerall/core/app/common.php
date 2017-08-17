<?php
global $_W, $_GPC;
load()->model('mc');
$uniacid=intval($_W['uniacid']);
$fans = $_W['fans'];

$openid = $fans['openid'];
if(empty($openid)){
    $openid = "fromUser";
}
$uid   = intval(mc_openid2uid($openid));

// if (is_weixin()) {
//     checkMember($openid);
// }

$pageTitle = $_W['account']['name'];

$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';

$pindex = max(1, intval($_GPC['page']));
$psize  = 10;

$member = pdo_fetch("select * from ".tablename($this->tb_member)." where uid = $uid ");
$config = $this->module['config'];

$setting = uni_setting($_W['uniacid'], array('payment'));
$pay = $setting['payment'];
$payset = array();
$payset['appid']     = $_W['account']['key'];
$payset['appsecret'] = $_W['account']['secret'];
$payset['mchid']     = $pay['wechat']['mchid'];
$payset['signkey']   = $pay['wechat']['apikey'];

