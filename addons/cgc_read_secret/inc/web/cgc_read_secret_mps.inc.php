<?php

   global $_W, $_GPC;  
   load()->func('tpl');
   $op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
   $uniacid=$_W["uniacid"];
   $id=$_GPC['id'];    	 
   $cgc_read_secret_mps=new cgc_read_secret_mps();  
   if ($op=='display') { 		
  		$pindex = max(1, intval($_GPC['page']));	
		$psize= 20;
	    $con="uniacid=$uniacid";
	    $total=0; 
        $list = $cgc_read_secret_mps->getAll($con, $pindex,$psize,$total);
		$pager = pagination($total, $pindex, $psize);		
		include $this->template('cgc_read_secret_mps_display');
		exit();
  	}
  	
   	 if ($op=='post') {
  	     $id=$_GPC['id']; 
  	     if (!empty($id)){
            $data = $cgc_read_secret_mps->getOne($id);  
  	     }
		if (checksubmit('submit')) {
			$data = $_GPC['data']; 
			$data['uniacid'] = $_W['uniacid'];
			$data['createtime'] = TIMESTAMP;
                    
			if (!empty($id)) {				
				$cgc_read_secret_mps->modify($id,$data); 
			}else{
			   	$cgc_read_secret_mps->insert($data); 
			}						
			message('信息更新成功',$this->createWebUrl('cgc_read_secret_mps', array('op' => 'display')), 'success');
		 }
	     
	      include $this->template('cgc_read_secret_mps_edit');
		  exit();
		} 
	 
	 if ($op=='delete') {
	 	$id=$_GPC['id'];
        $cgc_read_secret_mps->delete($id); 
        message('删除成功！',referer(), 'success');
	 }
	 
	 if ($op=='deleteAll') {
	 	$cgc_read_secret_mps->deleteAll($id);
	 	message('删除成功！',referer(), 'success');
	 }
	 
     
   
