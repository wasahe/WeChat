<?php

/**
 * 微取号&扫码取号

 */
defined('IN_IA') or exit('Access Denied');

class qr_code_19jw_comModuleProcessor extends WeModuleProcessor {

    public function respond() {
        global $_W;
        $rid = $this->rule;
        if ($rid) {
            $reply = pdo_fetch("SELECT * FROM " . tablename('qr_code_19jw_com_reply') . " WHERE rid = :rid", array(':rid' => $rid));
            if ($reply) {
                $news = array(
                    array(
                        'title' => $reply['title'],
                        'description' => strip_tags($reply['description']),
                        'picurl' => tomedia($reply['thumb']),
                        'url' => $this->createMobileUrl('index', array('rid' =>$rid))
                ));
                return $this->respNews($news);
            }
        }
    }

}
