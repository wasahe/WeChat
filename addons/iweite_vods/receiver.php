<?php
defined('IN_IA') || die('Access Denied');
class Iweite_vodsModuleReceiver extends WeModuleReceiver
{
	public function receive()
	{
		$type = $this->message['type'];
	}
}