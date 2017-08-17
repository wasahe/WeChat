<?php
/**
 * MEEPO 米波现场
 *
 * 官网 http://meepo.com.cn 赞木 作者QQ 284099857
 */

global $_W,$_GPC;
$weid = $_W['uniacid'];
$id = $rid = $_GPC['id'];
load()->func('tpl');
$sd_config = pdo_fetch("SELECT * FROM ".tablename($this->sd_config_table)." WHERE weid = :weid AND rid=:rid",array(':weid'=>$weid,':rid'=>$rid));
if(empty($sd_config)){
	$sd_config['bg'] = $_W['siteroot'].'addons/meepo_xianchang/template/mobile/app/images/bg.jpg';
}else{
	$sd_config['str'] = iunserializer($sd_config['str']);
	$sd_config['placeholder_image_arr'] = iunserializer($sd_config['placeholder_image_arr']);
}
if(checksubmit('submit')){
	$data = array();
	$data['weid'] = $weid;
	$data['rid'] = $rid;
	$data['placeholder_image_arr'] = iserializer($_GPC['placeholder_image_arr']);
	$str = array();
	if(!empty($_GPC['type']) && is_array($_GPC['type'])){
		foreach($_GPC['type'] as $key=>$row){
			
			if($row=='Text'){
				$val = $_GPC['text'][$key];
			}elseif($row=='Sphere'){
				$val = '#sphere';
			}elseif($row=='Helix'){
				$val = '#helix';
			}elseif($row=='Torus'){
				$val = '#torus';
			}elseif($row=='Logo'){
				$val = $_GPC['3dLogo'][$key];
			}elseif($row=='Countdown'){
				$val = intval($_GPC['Countdown'][$key]);
			}
			$str[]=  array('type'=>$row,'value'=>$val);
		}
	}
	$data['str'] = iserializer($str);
	$sd_config_id = intval($_GPC['sd_config_id']);
	if(empty($sd_config_id)){
		pdo_insert($this->sd_config_table,$data);
		message('保存成功',$this->createWebUrl('3d_config',array('id'=>$id)),"success");
	}else{
		pdo_update($this->sd_config_table,$data,array('id'=>$sd_config_id,'weid'=>$weid));
		message('更新成功',$this->createWebUrl('3d_config',array('id'=>$id)),"success");
	}
	
}
include $this->template('3d_config');
 
      
