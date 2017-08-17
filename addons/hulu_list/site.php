<?php
/**
 * 葫芦同城信息模块微站定义
 *
 * @author 葫芦
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class Hulu_listModuleSite extends WeModuleSite {

	public function doMobileFengmian1() {
		//这个操作被定义用来呈现 功能封面
	}
	public function doWebGuize() {
		//这个操作被定义用来呈现 规则列表
	}
	public function doWebDaohang() {
		//这个操作被定义用来呈现 管理中心导航菜单
	}
	public function doMobileShouye() {
		//这个操作被定义用来呈现 微站首页导航图标
	}
	public function doMobileGeren() {
		//这个操作被定义用来呈现 微站个人中心导航
	}
	public function doMobileKuaijie() {
		//这个操作被定义用来呈现 微站快捷功能导航
	}

}