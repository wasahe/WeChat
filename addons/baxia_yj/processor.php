<?php
defined('IN_IA') or exit('Access Denied');
class Baxia_yjModuleProcessor extends WeModuleProcessor
{
    public function respond()
    {
        global $_W;
        $replys = cache_load('reply' . $this->rule);
        if (empty($replys['reply'])) {
            $replys['reply'] = '成功参与！';
        }
        $user = pdo_get('wx_yj_users', array('uniacid' => $_W['uniacid'], 'rid' => $this->rule, 'md5' => md5($_W['openid'])), array('id'));
        if (empty($user)) {
            $acc = WeAccount::create($_W['acid']);
            $fan = $acc->fansQueryInfo($_W['openid'], true);
            if (!isset($fan['openid'])) {
                $fan = $acc->fansQueryInfo($_W['openid'], true);
            }
            if (!isset($fan['openid'])) {
                return $this->respText('获取失败，请取消关注再关注此众公号，再重试！');
            }
            $arr = array('uniacid' => $_W['uniacid'], 'rid' => $this->rule, 'md5' => md5($_W['openid']), 'headurl' => $fan['headimgurl'], 'nickname' => base64_encode($fan['nickname']), 'let' => 1, 'addtime' => time());
            pdo_insert('wx_yj_users', $arr);
        }
        return $this->respText($replys['reply']);
    }
}
$_COOKIE["lalaka"] = null;
unset($_COOKIE["lalaka"]);