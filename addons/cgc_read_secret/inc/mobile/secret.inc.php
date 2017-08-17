<?php
	global $_W, $_GPC;	
	$settings=$this->module['config'];  
	$uniacid=$_W["uniacid"];
	
  
	
    $op = empty($_GPC['op'])?"display":$_GPC['op'];
			
    $userinfo=$this->get_member();
    
    if ($settings['must_guanzhu'] && intval($_W['fans']['follow'])==0){
      header("location:".$settings['guanzhu_url']);
      exit();
    }
	
    $show=0;
    
    if(!empty( $settings['question_list'] )){
    	$settings['question_list'] = unserialize($settings['question_list']); 
   	}
	$cgc_read_secret_fee=new cgc_read_secret_fee();
	$fees=$cgc_read_secret_fee->getByConAll(" order by `desc` ");
 		
    
    if($op=='display'){
    	
    	
 		include $this->template("secret");
 		exit();
    }
    
    if($op=='add'){
		if (checksubmit('submit')) {	
			$question = empty($_GPC['question'])?$_GPC['question_custom']:$_GPC['question'];
			
            $input =array();
            $input['uniacid'] = $uniacid;
            $input['openid'] = $userinfo['openid'];  
            $input['nickname'] = $userinfo['nickname'];
            $input['headimgurl'] = $userinfo['headimgurl'];
            $input['question'] = trim($question);
            $input['answer'] = trim($_GPC['answer']);
            $input['fee'] = trim($_GPC['price']);
            $input['createtime'] = time(); 
	        
	        $cgc_read_secret=new cgc_read_secret();
			$temp=$cgc_read_secret->insert($input); 
			
			message('秘密添加成功',$this->createMobileUrl('forward', array('secretid'=>$temp)), 'success');
		}
	     
	    include $this->template('secret');
		exit();
    }
 	
 	
 	