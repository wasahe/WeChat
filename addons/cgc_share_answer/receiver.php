<?php
 

defined('IN_IA') || exit('Access Denied');
class Cgc_share_answerModuleReceiver extends WeModuleReceiver
{
	public function receive()
	{
		$type = $this->message['type'];
	}
}


?>