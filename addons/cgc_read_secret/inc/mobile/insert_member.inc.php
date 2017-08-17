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
        exit(json_encode(array("msg"=>"神秘模式")));
 
      }
    }
	
   //必须强制关注
    if ($settings['must_guanzhu']){
      $follow= sfgz_user($userinfo['openid']);
      $guanzhu_url=$settings['guanzhu_url'];
      if (empty($follow) && !empty($guanzhu_url)){	   
  	     exit(json_encode(array("msg"=>"忘记关注")));
      }
   }		

	$cgc_read_secret_user=new cgc_read_secret_user();
 	$user=$cgc_read_secret_user->getByCon(" and openid='{$userinfo['openid']}'");
 	if (empty($user)){
 	  $userinfo['friend_openid'] =$_SESSION['sleep_openid'];
 	  $userinfo['friend_nickname'] =$_SESSION['sleep_nickname'];
 	  $userinfo['friend_headimgurl'] =$_SESSION['sleep_headimgurl'];
 	  $this->insert_member($userinfo);
 	   exit(json_encode(array("msg"=>"成功")));
 	} else {
 	  exit(json_encode(array("msg"=>"有了")));
 	}
 	