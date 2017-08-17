<?php
/**
 * 积分商城模块微站订义
 */
defined('IN_IA') or exit('Access Denied');

require_once IA_ROOT. '/addons/sea_centerall/version.php';
require_once IA_ROOT. '/addons/sea_centerall/defines.php';
require_once INCENSE_INC.'functions.php';

class Sea_centerallModuleSite extends WeModuleSite {
    public $tb_member           =   "mc_members";
    public $tb_fans             =   "mc_mapping_fans";
    
    public $tb_menus            =   "sea_centerall_manus";
    public $tb_adv              =   "sea_centerall_adv";
    
    /**
     * 会员中心管理
     */
	public function doWebManage() {
	    $this->__web(__FUNCTION__);
	}
	
    /**
     * 会员中心幻灯片
     */
	public function doWebAdv() {
	    $this->__web(__FUNCTION__);
	}
	
	/**
	 * 会员中心首页
	 */
	public function doMobileIndex() {
	    $this->__app(__FUNCTION__);
	}
	
	/**
	 * 前台程序 inc/app文件夹下
	 * @param unknown $f_name
	 */
	public function __app($f_name){
	    include_once INCENSE_CORE."app/".strtolower(substr($f_name, 8)).'.php';
	}
	
	/**
	 * 后台程序 inc/web文件夹下
	 * @param unknown $f_name
	 */
	public function __web($f_name){
	    include_once INCENSE_CORE."web/".strtolower(substr($f_name, 5)).'.php';
	}
   
	
}