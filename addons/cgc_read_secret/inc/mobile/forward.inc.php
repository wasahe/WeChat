<?php

	global $_W,$_GPC;
	$op=empty($_GPC['op'])?"display":$_GPC['op'];
	$uniacid=$_W['uniacid'];
	$settings=$this->module['config'];
	/*$userinfo=getFromUser($settings,$this->modulename);
	$userinfo=json_decode($userinfo,true);*/
	
	
	 
	
	$userinfo=$this->get_member();
	

	$secretid = $_GPC['secretid'];
	
	if (empty($secretid)){
		exit("秘密不能为空");
	}
	
	$cgc_read_secret = new cgc_read_secret();
	
	$secret = $cgc_read_secret->getOne($secretid);
	
	if (empty($secret)){
		exit("秘密记录不存在");
	}
	
	
    $settings['share_title']=str_replace("#nickname#",$secret["nickname"], $settings['share_title']);
    $settings['share_desc']=str_replace("#nickname#",$secret["nickname"], $settings['share_desc']); 
    $settings['share_thumb']=empty($settings['share_thumb'])?$secret['headimgurl']:$settings['share_thumb'];
	
	include $this->template('pay');