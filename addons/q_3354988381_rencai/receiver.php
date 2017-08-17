<?php
/**
 * 微招聘模块订阅器
 *
 * @author qq-3354988381
 * @url http://v2.addons.we7.cc/web/index.php?c=store&a=author&uid=91001
 * @公众号 http://v2.addons.we7.cc/web/index.php?c=store&a=author&uid=91001
 * @微信产品QQ群 490186557
 * 
 */
defined('IN_IA') or exit('Access Denied');

class Q_3354988381_rencaiModuleReceiver extends WeModuleReceiver {
	public function receive() {
		$type = $this->message['type'];
		//这里定义此模块进行消息订阅时的, 消息到达以后的具体处理过程, 请查看微擎文档来编写你的代码
	}
}