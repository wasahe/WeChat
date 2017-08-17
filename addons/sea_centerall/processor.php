<?php
defined('IN_IA') or exit('Access Denied');
require_once 'addons/sea_centerall/core/inc/functions.php';
class Sea_centerallModuleProcessor extends WeModuleProcessor {
	public function respond() {
	    
	}
	
	/**
	 * 输入空
	 * 输入方法    return $this->responseEmpty();
	 */
	private function responseEmpty(){
	    ob_clean();
	    ob_start();
	    echo '';
	    ob_flush();
	    ob_end_flush();
	    exit(0);
	}
	
}