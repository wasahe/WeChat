<?php
/**
 * Created by PhpStorm.
 * User: sunhuajie
 * Date: 16/8/23
 * Time: 21:46
 */

class VoiceLogMode {
    /**
     * 添加语音记录
     * @param $openid
     * @param $money
     * @param $commision
     * @return mixed
     */
    static function addItem($openid,$r_log_id,$voice_path) {
        global $_W;

        $data['uniacid'] = $_W['uniacid'];
        $data['openid'] = $openid;
        $data['r_log_id'] = $r_log_id;
        $data['voice_path'] = $voice_path;
        $data['add_time'] = date("Y-m-d H:i:s");

        return pdo_insert('sunshine_huayue_voice_log',$data);
    }

    /**
     * 根据聊天室的主键，来获取该条记录所对应的语音文件信息
     * @param $r_log_id
     * @return mixed
     */
    static function getInfo($r_log_id) {
        global $_W;

        return pdo_fetch("select * from ".tablename('sunshine_huayue_voice_log')." where uniacid='{$_W['uniacid']}' and r_log_id='{$r_log_id}'");
    }


}