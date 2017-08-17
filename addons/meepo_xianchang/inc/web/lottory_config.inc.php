<?php
/**
 * MEEPO 米波现场
 *
 * 官网 http://meepo.com.cn 赞木 作者QQ 284099857
 */
global $_W,$_GPC;
$weid = $_W['uniacid'];
$id = $rid = $_GPC['id'];
$lottory_config = pdo_fetch("SELECT * FROM ".tablename($this->lottory_config_table)." WHERE weid = :weid AND rid=:rid",array(':weid'=>$weid,':rid'=>$rid));
if(empty($lottory_config)){
	$lottory_config['send_mess']  = 0;
	$lottory_config['title']  = '抽奖';
	$lottory_config['def_mess']  = "亲爱的@你已经中了#、奖品为:*、请按照主持人的提示，到指定地点领取您的奖品！\n您的获奖验证码是:%";
}
if(checksubmit('submit')){
	$data = array();
	$data['send_mess'] = intval($_GPC['send_mess']);
	$data['def_mess'] = $_GPC['def_mess'];
	$data['title'] = $_GPC['title'];
	$data['weid'] = $weid;
	$data['rid'] = $rid;
	$lottory_config_id = intval($_GPC['lottory_config_id']);
	if(empty($lottory_config_id)){
		pdo_insert($this->lottory_config_table,$data);
		message('保存成功',$this->createWebUrl('lottory_config',array('id'=>$id)),"success");
	}else{
		pdo_update($this->lottory_config_table,$data,array('id'=>$lottory_config_id,'weid'=>$weid));
		message('更新成功',$this->createWebUrl('lottory_config',array('id'=>$id)),"success");
	}
	
}
include $this->template('lottory_config');
 
      
