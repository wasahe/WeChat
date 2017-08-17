<?php

global $_W,$_GPC;

$info=pdo_fetch("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND id=:vid",array(':uniacid'=>$_W['uniacid'],':vid'=>$_GPC['vid']));

$res=$_W['timestamp']-strtotime($info['validity']);

//判断是否过期
if($res>'0'||empty($info['validity'])){
	//如果已经过期，直接渲染模板
	include 'share.inc.php';
	
	
}else{

	//判断IP
			$ip=pdo_fetchall("SELECT * FROM".tablename('hulu_list_ip')."WHERE vid=:vid AND ip=:ip",array(':vid'=>$_GPC['vid'],':ip'=>$_W['clientip']));

			
			if(!empty($ip)){

			//直接渲染模板
			//include 'share.inc.php';
			}else{
				
				$arr=array(
				'vid'=>$_GPC['vid'],
				'list'=>$info['list'],
				'ip'=>$_W['clientip'],
				'aopenid'=>$info['openid'],
				'anickname'=>$info['nickname'],
				'bopenid'=>$_W['openid'],
				'bnickname'=>$_W['fans']['nickname'],
				'time'=>$_W['timestamp'],
				'container'=>$_W['container'],
				'os'=>$_W['os'],
				);
				
			pdo_insert('hulu_list_ip',$arr);
			$view=$info['view']+1;
			$zid=$info['zid']+1;
			pdo_update('hulu_list_info',array('view'=>$view,'zid'=>$zid),array('uniacid'=>$_W['uniacid'],'id'=>$_GPC['vid']));
			}
	
	$info=pdo_fetch("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND id=:vid",array(':uniacid'=>$_W['uniacid'],':vid'=>$_GPC['vid']));

	//判断此贴是否置顶，仍在置顶
	if($info['zendtime']>=$_W['timestamp']){include 'share.inc.php';}

	//判断此贴是否置顶，没有置顶
	if($info['zendtime']<$_W['timestamp']||empty($info['zendtime'])){

		$code=pdo_fetch("SELECT * FROM".tablename('hulu_list_code')."WHERE uniacid=:uniacid",array(':uniacid'=>$_W['uniacid']));

		//如果没有置顶，判断现在条件是否满足置顶条件，满足就进行置顶操作
		if($info['zid']>=$code['codestart']){
			$data=array(
				'zid'=>$info['zid']-$code['codeonce'],
				'zendtime'=>$_W['timestamp']+('86400'*$code['codeday']),
				);
			pdo_update('hulu_list_info',$data,array('uniacid'=>$_W['uniacid'],'id'=>$_GPC['vid']));			

			}else{
				//不满足条件
				include 'share.inc.php';
			
			}
		

	}



}
?>