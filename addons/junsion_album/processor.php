<?php

defined('IN_IA') or exit('Access Denied');
class junsion_albumModuleProcessor extends WeModuleProcessor
{
    public function respond()
    {
        global $_W;
        $content  = $this->message['content'];
        $openid   = $this->message['from'];
        $mem_info = pdo_fetch("select id,status,curAlbum from " . tablename($this->modulename . "_member") . " where openid = '{$openid}' and weid = '{$_W['uniacid']}'");
        if ($mem_info['status'] == 1) {
            $text = "您已经被拉入黑名单中，不能创建和编辑相册，如有疑问，请联系客服！";
            return $this->respText($text);
        }
        if ($this->message['msgtype'] == 'image' || $this->message['event'] == 'pic_photo_or_album') {
            if ($this->message['msgtype'] == 'image') {
                $mid = $this->message['mediaid'];
                $img = $this->downLoadImg($mid);
            }
            if ($content == 'junsion_album' && $this->message['msgtype'] == 'event') {
                include_once 'func.php';
                $res = createAlbum($this->getFans($openid), '', $this->modulename);
                if (empty($this->message['sendpicsinfo']['count'])) {
                    pdo_update($this->modulename . "_member", array(
                        'curAlbum' => $res
                    ), array(
                        'id' => $mem_info['id']
                    ));
                    return '';
                } else {
                    $this->beginContext();
                    $_SESSION['junsion_album_pic' . $_W['uniacid']] = $this->message['sendpicsinfo']['count'];
                }
            } elseif ($this->inContext && $this->message['msgtype'] == 'image') {
                $_SESSION['junsion_album_pic' . $_W['uniacid']]--;
                if ($_SESSION['junsion_album_pic' . $_W['uniacid']] <= 0) {
                    $this->endContext();
                }
                $album  = pdo_fetch('select * from ' . tablename($this->modulename . "_album") . " where openid='{$openid}' order by createtime desc limit 1");
                $imgs   = unserialize($album['pics']);
                $imgs[] = $img;
                $pics   = array();
                foreach ($imgs as $value) {
                    if (!empty($value))
                        $pics[] = $value;
                }
                pdo_update($this->modulename . "_album", array(
                    'pics' => serialize($pics)
                ), array(
                    'id' => $album['id']
                ));
                if ($_SESSION['junsion_album_pic' . $_W['uniacid']] <= 0) {
                    $count = count($pics);
                    return $this->respText("<a href='" . $this->buildSiteUrl($this->createMobileUrl('album', array(
                        'aid' => base64_encode($album['id']),
                        'op' => 'edit'
                    ))) . "'>已收到{$count}张图片，点这里开始制作</a>");
                }
                return '';
            } else {
                if ($mem_info['curAlbum']) {
                    $album = pdo_fetch('select id,pics from ' . tablename($this->modulename . "_album") . " where id='{$mem_info['curAlbum']}'");
                    if (empty($album))
                        pdo_update($this->modulename . "_member", array(
                            'curAlbum' => 0
                        ), array(
                            'id' => $mem_info['id']
                        ));
                }
                if (empty($album))
                    $album = pdo_fetch('select id,pics from ' . tablename($this->modulename . "_album") . " where openid='{$openid}' order by createtime desc limit 1");
                if (empty($album)) {
                    include_once 'func.php';
                    $res = createAlbum($this->getFans($openid), $img, $this->modulename);
                    return $this->respText("<a href='" . $this->buildSiteUrl($this->createMobileUrl('album', array(
                        'aid' => base64_encode($res),
                        'op' => 'edit'
                    ))) . "'>已收到1张图片，点这里开始制作</a>");
                } else {
                    $imgs   = unserialize($album['pics']);
                    $imgs[] = $img;
                    $pics   = array();
                    foreach ($imgs as $value) {
                        if (!empty($value))
                            $pics[] = $value;
                    }
                    pdo_update($this->modulename . "_album", array(
                        'pics' => serialize($pics)
                    ), array(
                        'id' => $album['id']
                    ));
                    $count = count($pics);
                    return $this->respText("<a href='" . $this->buildSiteUrl($this->createMobileUrl('album', array(
                        'aid' => base64_encode($album['id']),
                        'op' => 'edit'
                    ))) . "'>已收到{$count}张图片，点这里开始制作</a>");
                }
            }
        }
    }
    private function downLoadImg($mediaid)
    {
        global $_W;
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=" . $this->getAccessToken() . "&media_id={$mediaid}";
        $dst = imagecreatefromstring(file_get_contents($url));
        $cfg = $this->module['config'];
        if ($cfg['isqiniu']) {
            return $this->uploadQiniu($url, $cfg, '.jpg');
        } else {
            if (!empty($_W['setting']['remote']['type'])) {
                $pathname = "images/" . random(10) . time() . "pic.jpg";
                imagejpeg($dst, ATTACHMENT_ROOT . $pathname);
                imagedestroy($dst);
                $remotestatus = file_remote_upload($pathname);
                $url          = tomedia($pathname);
            } else {
                $path = './attachment/jun_albums/';
                if (!file_exists($path)) {
                    mkdir($path, 0777);
                }
                $url = $path . random(10) . time() . "pic.jpg";
                imagejpeg($dst, $url);
                imagedestroy($dst);
                $url = toimage("." . $url);
            }
            return $url;
        }
    }
    private function uploadQiniu($url, $cfg, $type = '.png')
    {
        include_once 'qiniu.php';
        $cfg['url'] = $cfg['qiniuUrl'];
        $qiniu      = new Qiniu();
        $res        = $qiniu->save($url, $cfg, $type);
        return $res;
    }
    private function getFans($openid)
    {
        global $_W;
        load()->model('mc');
        $fans = mc_fansinfo($openid);
        if (empty($fans['nickname']) || empty($fans['avatar'])) {
            $ACCESS_TOKEN = $this->getAccessToken();
            $url          = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$ACCESS_TOKEN}&openid={$openid}&lang=zh_CN";
            load()->func('communication');
            $json     = ihttp_get($url);
            $userInfo = @json_decode($json['content'], true);
            if ($userInfo['nickname'])
                $fans['nickname'] = $userInfo['nickname'];
            if ($userInfo['headimgurl'])
                $fans['avatar'] = $userInfo['headimgurl'];
            $fans['openid'] = $openid;
        }
        $fans['uniacid'] = $_W['uniacid'];
        return $fans;
    }
    private function getAccessToken()
    {
        global $_W;
        load()->model('account');
        $acid = $_W['acid'];
        if (empty($acid)) {
            $acid = $_W['uniacid'];
        }
        $account = WeAccount::create($acid);
        $token   = $account->fetch_available_token();
        return $token;
    }
}

?>