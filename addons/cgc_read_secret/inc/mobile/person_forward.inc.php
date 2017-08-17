<?php

  global $_W, $_GPC;	
  $settings=$this->module['config'];
  	
  $user_json=getFromUser($settings,$this->modulename);
  $userinfo=json_decode($userinfo,true);
  $form=empty($_GPC['form'])?"person":"enter";
  //入口正常  
   $_SESSION['person_forward']=true;
  $url=$this->createMobileUrl($form,array('sign'=>time(),'sleep_openid'=>$_GPC['sleep_openid'])); 
  header("location:".$url);
	    
 	
 	
 	