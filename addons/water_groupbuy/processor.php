<?php

defined('IN_IA') or die('Access Denied');
class water_groupbuyModuleProcessor extends WeModuleProcessor
{
    public $themetable = 'water_groupbuy_theme';
    public function respond()
    {
        global $_W, $_GPC;
        $content = trim($this->message['content']);
        $reply = pdo_fetch('SELECT * FROM ' . tablename($this->themetable) . ' WHERE uniacid = :uniacid and keyword = :keyword ', array(':uniacid' => $_W['uniacid'], ':keyword' => $content));
        if (empty($reply)) {
            return $this->respText('对不起，找不到活动记录，该活动已经结束或者被关闭，请联系管理员。');
        } else {
            $response = array('title' => $reply['title'], 'description' => $reply['desc'], 'picurl' => $reply['headlogo'], 'url' => $this->buildSiteUrl($this->createMobileUrl('Mode', array('themeid' => $reply[id]))));
        }
        return $this->respNews($response);
    }
}