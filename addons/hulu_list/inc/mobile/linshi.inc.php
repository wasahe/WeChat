<?php

global $_W,$_GPC;

if($_W['container']=='wechat'){
	if($_W['fans']['follow']=='1'){

if($_W['ispost']){
	$data=array(
		'uniacid'=>$_W['uniacid'],
		'openid'=>$_W['fans']['openid'],
		'nickname'=>$_W['fans']['nickname'],
		'pid'=>'1',
		'list'=>'6',

		'linshiname'=>$_GPC['linshiname'],
		'linshispecial'=>$_GPC['linshispecial'],
		

		'tel'=>$_GPC['tel'],
		'validity'=>$_GPC['validity'],
		
	'time'=>$_W['timestamp'],
		'ip'=>$_W['clientip'],
		'view'=>'0',
		'container'=>$_W['container'],
		'os'=>$_W['os'],
			);
		$res=pdo_insert('hulu_list_info',$data);
		if(!empty($res)){
			$vid = pdo_insertid();
			message('发布成功！',$this->createMobileUrl('view',array('vid'=>$vid)),'success');
			
		}else{
message('发布失败','','error');
		}

}else{
include $this->template('linshi');
}

}else{
	$follow=pdo_fetch("SELECT * FROM".tablename('hulu_list_code')."WHERE uniacid=:uniacid",array(':uniacid'=>$_W['uniacid']));
	echo $follow['follow'];

}
}else{
	$open=pdo_fetch("SELECT * FROM".tablename('hulu_list_code')."WHERE uniacid=:uniacid",array(':uniacid'=>$_W['uniacid']));
	echo $open['open'];
	

}

?>