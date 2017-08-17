<?php


defined('IN_IA') || exit('Access Denied');
load()->model('mc');
$obj = new Siyuan_Vod_doWebReg();
$obj->exec();
class Siyuan_Vod_doWebReg extends Siyuan_VodModuleSite
{
	public function __construct()
	{
		parent::__construct();
	}
}

