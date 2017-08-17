<?php

	global $_W, $_GPC;	
    $settings=$this->module['config'];
	$userinfo=getFromUser($settings,$this->modulename);
    $userinfo=json_decode($userinfo,true);
    
    $_SESSION['forward']=true;
    
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
	
   //必须强制关注
    if ($settings['must_guanzhu']){
      $follow= sfgz_user($_W['openid']);
      $guanzhu_url=$settings['guanzhu_url'];
      if (empty($follow) && !empty($guanzhu_url)){
  	    header("location:$guanzhu_url");
  	    exit();
      }
   }
	

	$cgc_read_secret_user=new cgc_read_secret_user();
 	$user=$cgc_read_secret_user->getByCon(" and openid='{$userinfo['openid']}'");
 	//用户给他加一个，以免找不到用户信息。
 	if (empty($user)){
 	  $userinfo['friend_openid'] =$_SESSION['sleep_openid'];
 	  $userinfo['friend_nickname'] =$_SESSION['sleep_nickname'];
 	  $userinfo['friend_headimgurl'] =$_SESSION['sleep_headimgurl'];
 	  $this->insert_member($userinfo);
 	}
 	

 	if (!empty($user['total_amount'])){
 	  //超过多少人
 	  $beatPerc = $cgc_read_secret_user->getBeatPerc($user['total_amount']);
 	} else {
 	  $beatPerc=0;
 	}
 	
 	$user['amount']=empty($user['amount'])?0:$user['amount'];
    $user['no_account_amount']=empty($user['no_account_amount'])?0:$user['no_account_amount'];
 	
    $total_amount= $user['total_amount'];	
 	
  	
    //全国排名前3名 	
 	$allRanks = $cgc_read_secret_user->getRanks();
 
    $cgc_read_secret_record=new cgc_read_secret_record();
    $friends=$cgc_read_secret_record->getByConAll(" and sleep_openid='{$userinfo['openid']}' and pay_status=1 order by id  asc limit 300",'openid');
 
 
    if (!empty($friends)){ 
      $friendsstr="('".implode("','",array_keys($friends))."')";  
 	  //好友前3名 	
 	 
  	  $friendRanks=$cgc_read_secret_user->getFriendRanks(" and openid in $friendsstr  ORDER BY `total_amount` DESC limit 3");
    }
   		
 	$settings['share_title']=str_replace("#nickname#",$userinfo['nickname'],$settings['share_title']); 
    $settings['share_title']=str_replace("#beatPerc#",$beatPerc,$settings['share_title']);   
    $settings['share_title']=str_replace("#amount#",$user['amount'],$settings['share_title']);
   
    $settings['share_desc']=str_replace("#nickname#",$userinfo['nickname'],$settings['share_desc']);
    
    $settings['share_desc']=str_replace("#beatPerc#",$beatPerc,$settings['share_desc']);
    $settings['share_desc']=str_replace("#amount#",$user['amount'],$settings['share_desc']);
    
    $settings['share_thumb']=empty($settings['share_thumb'])?$userinfo['headimgurl']:$settings['share_thumb'];
 	
 	$settings['share_url']= $_W['siteroot'] . "app/index.php?i=".$_W['uniacid']."&j=".$_W['acid']."&c=entry&m={$this->modulename}&do=forward&sleep_openid={$userinfo['openid']}";
 	
 	include $this->template("person");