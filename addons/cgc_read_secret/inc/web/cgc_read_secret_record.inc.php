<?php

   global $_W, $_GPC;  
   $title = '交易记录';
   load()->func('tpl');
   $op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
   $uniacid=$_W["uniacid"];
   $id=$_GPC['id'];
    	
   
   $cgc_read_secret_record=new cgc_read_secret_record();
   
   if ($op=='display') { 		
  		$pindex = max(1, intval($_GPC['page']));	
		$psize= 20;
	    $con="uniacid=$uniacid";
	    if (!empty($_GPC['nickname'])) {
	    	$nickname = $_GPC['nickname'];
	    	$con .= " AND `nickname` like '%$nickname%' ";
	    }
	    
	   if (!empty($_GPC['sleep_openid'])) {
	    	$sleep_openid = $_GPC['sleep_openid'];
	    	$con .= " AND `sleep_openid` like '%$sleep_openid%' ";
	    }
	    
	    
	    
	    
	    if (!empty($_GPC['sleep_nickname'])) {
	    	$sleep_nickname = $_GPC['sleep_nickname'];
	    	$con .= " AND `sleep_nickname` like '%$sleep_nickname%'";
	    }
	    
	    if (!empty($_GPC['pay_status'])) {
	    	$pay_status = $_GPC['pay_status'];
	    	$con .= " AND `pay_status`=$pay_status";
	    }
	    $total=0; 
        $list = $cgc_read_secret_record->getAll($con, $pindex,$psize,$total);
		$pager = pagination($total, $pindex, $psize);		
		include $this->template('cgc_read_secret_record_display');
		exit();
  	}
  	
   	 if ($op=='post') {
  	     $id=$_GPC['id']; 
  	     if (!empty($id)){
            $data = $cgc_read_secret_record->getOne($id);  
  	     }
  	     
  	     if (checksubmit('submit')) {
  	     	$data = $_GPC['data'];
  	     	$data['uniacid'] = $_W['uniacid'];
  	     	$data['createtime'] = TIMESTAMP;
  	     
  	     	if (!empty($id)) {
  	     		$cgc_read_secret_record->modify($id,$data);
  	     	}else{
  	     		$cgc_read_secret_record->insert($data);
  	     	}
  	     	message('信息更新成功',$this->createWebUrl('cgc_read_secret_record', array('op' => 'display')), 'success');
  	     }
	     
	      include $this->template('cgc_read_secret_record_edit');
		  exit();
		} 
		
		if ($op=='delete') {
			$id=$_GPC['id'];
			$cgc_read_secret_record->delete($id);
			message('删除成功！',referer(), 'success');
		}
		
		if ($op=='deleteAll') {
			$cgc_read_secret_record->deleteAll();
			message('删除成功！',referer(), 'success');
		}
	 
