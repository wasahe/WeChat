<?php

   global $_W, $_GPC;  
   $title = '活动用户';
   load()->func('tpl');
   $op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
   $uniacid=$_W["uniacid"];
   $id=$_GPC['id'];
    	
   
   $cgc_read_secret_user=new cgc_read_secret_user();
   
   if ($op=='display') { 		
  		$pindex = max(1, intval($_GPC['page']));	
		$psize= 20;
	    $con="uniacid=$uniacid";
	    if (!empty($_GPC['keyword'])) {
	    	$keyword = $_GPC['keyword'];
	    	$con .= " AND `nickname` like '%$keyword%'";
	    }
	    $total=0; 
        $list = $cgc_read_secret_user->getAll($con, $pindex,$psize,$total);
        
		$pager = pagination($total, $pindex, $psize);		
		include $this->template('cgc_read_secret_user_display');
		exit();
  	}
  	
   	 if ($op=='post') {
  	     if (!empty($id)){
            $data = $cgc_read_secret_user->getOne($id);  
  	     }
		if (checksubmit('submit')) {
			$data = $_GPC['data']; 
			$data['uniacid'] = $_W['uniacid'];
			$data['createtime'] = TIMESTAMP;
                    
			if (!empty($id)) {				
				$cgc_read_secret_user->modify($id,$data); 
			}else{
			   	$cgc_read_secret_user->insert($data); 
			}						
			message('信息更新成功',$this->createWebUrl('cgc_read_secret_user', array('op' => 'display')), 'success');
			}
	     
	      include $this->template('cgc_read_secret_user_edit');
		  exit();
		} 
	 
	 if ($op=='delete') {
        $cgc_read_secret_user->delete($id); 
        message('删除成功！',referer(), 'success');
	 }
	 
	 if ($op=='deleteAll') {
	 	$cgc_read_secret_user->deleteAll();
	 	message('删除成功！',referer(), 'success');
	 }
	 //发红包
	 if($op=='pay'){
	 	$fee = floatval($_GPC['fee']);
	 	
	 	$data = $cgc_read_secret_user->getOne($id);
	 	$settings = $this->module['config'];
	 
	 	if($fee>$data['no_account_amount']){
	 		message('红包金额超出实际未到账金额.');
	 	}else{
	 		$settings= $this->module['config'];
	 		$settings['pay_desc']= str_replace("#nickname#",$data['nickname'],$settings['pay_desc']);
	 		$ret=send_qyfk($settings,$data['openid'],$data['no_account_amount']);
	 		
	 		if ($ret['code']==0){	 			
	 			$data['amount'] = $data['amount']+$data['no_account_amount'];
	 			$data['no_account_amount'] =0;
 				$cgc_read_secret_user->modify($data['id'],$data);
 				message('发红包成功！',referer(), 'success');
	 		}else{
	 			message('发红包失败.'.$ret['message']);
	 		}
	 	}
	 }
	 
	  //发红包
	 if($op=='batch_tx'){	 	
	 	$settings = $this->module['config'];
	 	if(empty($settings['tx_limit'])){
	 		$settings['tx_limit'] = 0;
	 	}
	 	$count=0;
	 	$users= $cgc_read_secret_user->getByConAll(" and no_account_amount>0 and no_account_amount>={$settings['tx_limit']} order by id desc limit 50");
	 	foreach ($users as $user){
	 		$settings['pay_desc']= str_replace("#nickname#",$data['nickname'],$settings['pay_desc']);
	 		$ret=send_qyfk($settings,$user['openid'],$user['no_account_amount']);	 		
	 		if ($ret['code']==0){	 			
	 			$data['amount'] = $user['amount']+$user['no_account_amount'];
	 			$data['no_account_amount'] =0;
 				$cgc_read_secret_user->modify($user['id'],$data);
 				$count++;
	 		}
	 	}	 	
	 	message('提现成功'.$count.'个用户！',referer(), 'success');	
	 }
	 
	 
	 
	 
	 
	  if ($op=='sum') {
        $cgc_read_secret_user->sumData(); 
        message('累计成功！',referer(), 'success');
	 }
	 
     
   
