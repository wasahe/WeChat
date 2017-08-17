<?php
/**
 * MEEPO 米波现场
 *
 * 官网 http://meepo.com.cn 作者QQ 284099857
 */
include MODULE_ROOT.'/inc/mobile/__init.php';
if(!in_array('wall',$xianchang['controls'])){
	message('本次活动未开启上墙活动！');
}
if(empty($user)){
	message('错误你的信息不存在或是已经被删除！');
}
include $this->template('app_wall');