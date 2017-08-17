<?php

	global $_W,$_GPC;
	$op=empty($_GPC['op'])?"display":$_GPC['op'];
	$uniacid=$_W['uniacid'];
	$settings=$this->module['config'];
	$userinfo=getFromUser($settings,$this->modulename);
	$userinfo=json_decode($userinfo,true);
	
	$secretid = $_GPC['secretid'];
	
	$cgc_read_secret_record= new cgc_read_secret_record(); 
	
	$pay_status=$cgc_read_secret_record->getByCon(" and openid='{$userinfo['openid']}' and secret_id={$secretid} and pay_status=1");
	if (empty($pay_status)){
	  exit("你尚未支付，无法偷看");	
	}
	
	$cgc_read_secret = new cgc_read_secret();
	
	$secret = $cgc_read_secret->getOne($secretid);

	include $this->template('payafter');