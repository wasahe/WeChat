<?php
/**
 * 疯狂摇圣诞树抽奖模块微站定义
 */
defined('IN_IA') or exit('Access Denied');

class Truein_sdcjModuleSite extends WeModuleSite {

	public function doMobileSdcj() {
		//这个操作被定义用来呈现 功能封面
		global $_GPC, $_W;	
		include $this -> template('index');
	}


}