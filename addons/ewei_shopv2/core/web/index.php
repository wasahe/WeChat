<?php
//Ò×¸£Ô´ÂëÍø www.efwww.com
if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_EweiShopV2Page extends WebPage
{
	public function main()
	{
		header('location:' . webUrl('shop'));
		exit();
	}
}

?>
