<?php
/**
 * MEEPO 米波现场
 *
 * 官网 http://meepo.com.cn 赞木 作者QQ 284099857
 */

global $_W,$_GPC;
$weid = $_W['uniacid'];
$id = $rid = $_GPC['id'];
$shake = pdo_fetch("SELECT * FROM ".tablename($this->shake_config_table)." WHERE weid = :weid AND rid=:rid",array(':weid'=>$weid,':rid'=>$rid));
if(empty($shake)){
	$shake['paodao_color'] = '#70B405';
	$shake['ready_time'] = 5;
	$shake['point'] = 100;
	$shake['app_bg'] = $_W['siteroot'].'addons/meepo_xianchang/template/mobile/app/images/shake/shake0.png';
	$shake['title'] = '摇一摇';
	$shake['slogan'] = '再大力！#再大力,再大力！#再大力,再大力,再大力！#摇，大力摇#快点摇啊，别停！摇啊，摇啊，摇啊';
	$shake['pp_img'] = $_W['siteroot'].'addons/meepo_xianchang/template/mobile/app/images/shake/car.png';
	$shake['shake_music'] = $_W['siteroot'].'addons/meepo_xianchang/template/mobile/app/images/shake/v4.mp3';
	$shake['award_again'] = 2;
}
if(checksubmit('submit')){
	$data = array();
	$data['award_again'] = intval($_GPC['award_again']);
	$data['app_bg'] = $_GPC['app_bg'];
	$data['point'] = intval($_GPC['point']);
	$data['slogan'] = $_GPC['slogan'];
	$data['ready_time'] = intval($_GPC['ready_time']);
	$data['paodao_color'] = $_GPC['paodao_color'];
	$data['pp_img'] = $_GPC['pp_img'];
	$data['shake_music'] = $_GPC['shake_music'];
	$data['title'] = $_GPC['title'];
	$data['weid'] = $weid;
	$data['rid'] = $rid;
	$shake_config_id = intval($_GPC['shake_config_id']);
	if(empty($shake_config_id)){
		pdo_insert($this->shake_config_table,$data);
	}else{
		pdo_update($this->shake_config_table,$data,array('id'=>$shake_config_id,'weid'=>$weid));
	}
	message('保存成功',$this->createWebUrl('shake_config',array('id'=>$id)),"success");
}
include $this->template('shake_config');