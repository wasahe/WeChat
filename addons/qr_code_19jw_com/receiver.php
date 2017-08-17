<?php
/**
 * 微取号&扫码取号

 */
defined('IN_IA') or exit('Access Denied');

class qr_code_19jw_comModuleProcessor extends WeModuleProcessor {
	public function receive() {
		$type = $this->message['type'];
		//这里定义此模块进行消息订阅时的, 消息到达以后的具体处理过程, 请查看微擎文档来编写你的代码
	}
}