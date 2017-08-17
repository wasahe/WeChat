<?php

//decode by QQ:3213288469 http://www.zheyitianshi.com/
defined('IN_IA') or die('Access Denied');
class Meepo_xianchangModuleProcessor extends WeModuleProcessor
{
	public function respond()
	{
		$content = $this->message['content'];
		return $this->respText('直接添加链接或是图文消息即可');
	}
}