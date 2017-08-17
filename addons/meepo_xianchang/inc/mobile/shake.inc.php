<?php
/**
 * MEEPO 米波现场
 *
 * 官网 http://meepo.com.cn 作者QQ 284099857
 */
include MODULE_ROOT.'/inc/mobile/pc_init.php';
$shake_info = $shake_config = pdo_fetch("SELECT * FROM ".tablename($this->shake_config_table)." WHERE weid=:weid AND rid=:rid",array(':weid'=>$weid,':rid'=>$rid));
if(empty($shake_config)){
	message('请先配置现场摇一摇');
}
$shake_info['slogan_list'] = explode('#',$shake_info['slogan']);
$shake_info['rotate_list'] = pdo_fetchall("SELECT * FROM ".tablename($this->shake_rotate_table)." WHERE weid=:weid AND rid=:rid  ORDER BY id ASC  ",array(':weid'=>$weid,':rid'=>$rid));
include $this->template('shake');