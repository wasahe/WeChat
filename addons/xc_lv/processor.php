<?php
/**
 * 语音回复处理类
 * 
 * 来自悟空源码网
 * www.5kym.com
 */
defined('IN_IA') or exit('Access Denied');

class Xc_lvModuleProcessor extends WeModuleProcessor {
	
	public function respond() {
		global $_W;
		$this->module['config']['picurl'] = $_W['attachurl'] . $this->module['config']['picurl'];
		return $this->respNews($this->module['config']);
	}
}
