<?php
//decode by 鬼狐源码社区 www.guifox.com
  global $_W, $_GPC;
  $uniacid=$_W['uniacid'];
  $qid = $_GPC['q_id'];
  $settings=$this->module['config']; 
  $cgc_addr_forward = new cgc_addr_forward();
  $item;
  
  if (empty ($qid)) {
  	$item = $cgc_addr_forward->getOnly();
  }
  else{
  	$item = $cgc_addr_forward->getOne($qid);
  }
   $item['fans_regional'] = unserialize($item['fans_regional']);  

  include $this->template('enter'); 
   
     