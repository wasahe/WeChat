<?php
	global $_W, $_GPC;	
	$settings=$this->module['config'];  
    if  (empty($_SESSION['forward'])){
          exit("error");
     }
	
	//神秘防封模块互通
    if ($settings['dead_module']==1){
      $uid = $_W['member']['uid'];
      load()->model('module');
      $module = module_fetch('yun_fkz');
      $cgc_dead_module =new cgc_dead_module();
      $member = $cgc_dead_module->get_jymember($uid);
      if (empty($member['parent1']) && $uid!= $module['config']['uid']) {
        include $this->template('nolevel');
        return;
      }
    }
			
	$userinfo=getFromUser($settings,$this->modulename);
    $userinfo=json_decode($userinfo,true);
    $show=0;
	//如果是自己点击了，就显示
	if (empty($_GPC['sleep_openid']) || $_GPC['sleep_openid']==$userinfo['openid']){
	   $show=1;
	}
			
	$cgc_read_secret_user=new cgc_read_secret_user();	
	$show_openid=empty($_GPC['sleep_openid'])?$userinfo['openid']:$_GPC['sleep_openid'];	
	//会员的表的用户信息
 	$show_user=$cgc_read_secret_user->getByCon(" and openid='$show_openid'");
    $show_user=empty($show_user)?$userinfo:$show_user;
 	$show_user['amount']=empty($show_user['amount'])?0:$show_user['amount'];
    $show_user['no_account_amount']=empty($show_user['no_account_amount'])?0:$show_user['no_account_amount'];
 	$total_amount= $show_user['total_amount'];	
    
    if ($_GPC['sleep_openid']!=$userinfo['openid']){
 	  $_SESSION['sleep_openid']=$show_user["openid"];
 	  $_SESSION['sleep_nickname']=$show_user["nickname"];
 	  $_SESSION['sleep_headimgurl']=$show_user["headimgurl"];
 	}
 	
 	if (!empty($show_user['total_amount'])){
 	  //超过多少人
 	  $beatPerc = $cgc_read_secret_user->getBeatPerc($show_user['total_amount']);
 	} else {
 	  $beatPerc=0;
 	}
 	
 	$cgc_read_secret_record=new cgc_read_secret_record();
 	$records=$cgc_read_secret_record->getByConAll(" and secret_openid='$show_openid' and pay_status=1");	
 
 	//是否对被睡的用户付款过，如果付款了就显示
 	if (!empty($records) && !empty($_GPC['sleep_openid']) && $_GPC['sleep_openid']!=$userinfo['openid']){
 	  $ret=$cgc_read_secret_record->getByCon(" and openid='{$userinfo['openid']}' and sleep_openid='$show_openid' and pay_status=1 ");
 	  if (!empty($ret)){
 	   $show=1;
 	  }
 	}
 	
 	$cgc_read_secret_fee=new cgc_read_secret_fee();
 	$fees=$cgc_read_secret_fee->getByConAll(""); 	
 	$settings['share_title']=str_replace("#nickname#",$show_user['nickname'],$settings['share_title']);
    $settings['share_title']=str_replace("#beatPerc#",$beatPerc,$settings['share_title']);  
    $settings['share_title']=str_replace("#amount#",$show_user['amount'],$settings['share_title']);
    $settings['share_desc']=str_replace("#nickname#",$userinfo['nickname'],$settings['share_desc']);   
    $settings['share_desc']=str_replace("#beatPerc#",$beatPerc,$settings['share_desc']);
    $settings['share_desc']=str_replace("#amount#",$show_user['amount'],$settings['share_desc']); 	
 	
 	$settings['share_url']= $_W['siteroot'] . "app/index.php?i=".$_W['uniacid']."&j=".$_W['acid']."&c=entry&m={$this->modulename}&do=forward&sleep_openid={$show_user['openid']}";
 	
 	$settings['share_thumb']=empty($settings['share_thumb'])?$show_user['headimgurl']:$settings['share_thumb'];
 	
 	if (!empty($_GPC['test'])){
	  $show=0;
	}
 	
 	include $this->template("enter");
 	
 	
 	