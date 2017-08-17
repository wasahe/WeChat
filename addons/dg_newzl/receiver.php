<?php
/**
 * 新助力模块订阅器
 *
 * @author 夺冠互动
 * @url http://www.guifox.com/
 */
defined('IN_IA') or exit('Access Denied');

class Dg_newzlModuleReceiver extends WeModuleReceiver {
	public function receive() {
		$type = $this->message['type'];
		//这里定义此模块进行消息订阅时的, 消息到达以后的具体处理过程, 请查看微动力文档来编写你的代码
	}
}