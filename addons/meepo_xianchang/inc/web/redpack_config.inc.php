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
$redpack_config = pdo_fetch("SELECT * FROM ".tablename($this->redpack_config_table)." WHERE weid = :weid AND rid=:rid",array(':weid'=>$weid,':rid'=>$rid));
if(empty($redpack_config)){
	$redpack_config['tip_words'] = '<p>大屏幕倒计时开始，<br/>红包将从大屏幕降落到手机，此时<br/>手指戳红包即可参与<br/>抢红包游戏<br/></p>';
	$redpack_config['guize'] = '<p>1.用户打开微信扫描大屏幕上的二维码进入等待抢红包页面<br/>2.主持人说开始后，大屏幕和手机页面同时落下红包雨<br/>3.用户随机选择落下的红包，并拆开红包。<br/>4.如果倒计时还在继续，那么无论用户是否抢到了，都可以继续抢 直到倒计时完成。</p>';
    $redpack_config['all_nums'] = 2;
	$redpack_config['weixin_pay'] = 0;
}
load()->func('file');
if(!empty($_GPC['cert'])) {
	$picurl = "images/cert/".$_W['uniacid']."/apiclient_cert.pem";
	if(file_exists(ATTACHMENT_ROOT . '/'.$picurl)){
	   file_delete($picurl);
	}
	$upload = file_write($picurl,$_GPC['cert']);
}
if(!empty($_GPC['key'])) {
	$picurl = "images/cert/".$_W['uniacid']."/apiclient_key.pem";
	if(file_exists(ATTACHMENT_ROOT . '/'.$picurl)){
	   file_delete($picurl);
	}
	$upload = file_write($picurl,$_GPC['key']);	
}
if(!empty($_GPC['ca'])) {
	$picurl = "images/cert/".$_W['uniacid']."/rootca.pem";
	if(file_exists(ATTACHMENT_ROOT . '/'.$picurl)){
	   file_delete($picurl);
	}
	$upload = file_write($picurl,$_GPC['ca']);	
}
if(checksubmit('submit')){
	$data = array();
	$data['weid'] = $weid;
	$data['rid'] = $rid;
	$data['tip_words'] = $_GPC['tip_words'];
	$data['guize'] = $_GPC['guize'];
	$data['weixin_pay'] = intval($_GPC['weixin_pay']);
	$data['appid'] = trim($_GPC['appid']);
	$data['secret'] = trim($_GPC['secret']);
	$data['mchid'] = trim($_GPC['mchid']);
	$data['signkey'] = trim($_GPC['signkey']);
	$data['ip'] = trim($_GPC['ip']);
	$data['_desc'] = $_GPC['_desc'];
	$data['all_nums'] = intval($_GPC['all_nums']);
	
	$redpack_config_id = intval($_GPC['redpack_config_id']);
	if(empty($redpack_config_id)){
		pdo_insert($this->redpack_config_table,$data);
		message('保存成功',$this->createWebUrl('redpack_config',array('id'=>$id)),"success");
	}else{
		pdo_update($this->redpack_config_table,$data,array('id'=>$redpack_config_id,'weid'=>$weid));
		message('更新成功',$this->createWebUrl('redpack_config',array('id'=>$id)),"success");
	}
	
}

include $this->template('redpack_config');
 
      
