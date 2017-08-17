<?php
/**
*易 福 源 码 网 www.efwww.com
*/
defined('IN_IA') or exit('Access Denied');
class zmcn_signModuleReceiver extends WeModuleReceiver
{
    public function receive()
    {
        $type = $this->message['type'];
    }
}