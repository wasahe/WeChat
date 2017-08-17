<?php

global $_W,$_GPC;
if(!($_W['ispost'])){

	$code=pdo_fetchall("SELECT * FROM".tablename('hulu_list_code')."WHERE uniacid=:uniacid",array(':uniacid'=>$_W['uniacid']));
	if(!empty($code)){
		$code=pdo_fetch("SELECT * FROM".tablename('hulu_list_code')."WHERE uniacid=:uniacid",array(':uniacid'=>$_W['uniacid']));
		include $this->template('tui');

	}else{
			$data=array(
		'uniacid'=>$_W['uniacid'],
		'codestart'=>'0',
		'codeday'=>'0',
		'codeonce'=>'0',
		'codetime'=>$_W['timestamp'],

				'webtitle'=>$_W['account']['name'].'同城信息',
		'follow'=>'<h1>'.'请先关注微信公众号：'.$_W['account']['name'].'，'.'“'.$_W['account']['account'].'”'.'</h1>',
		'open'=>'<h1>'.'请在微信客户端打开'.'<h1>',
		

		);
$res=pdo_insert('hulu_list_code',$data);
	
$code=pdo_fetch("SELECT * FROM".tablename('hulu_list_code')."WHERE uniacid=:uniacid",array(':uniacid'=>$_W['uniacid']));
include $this->template('tui');
}

}else{

	if($_GPC['codestart']<=$_GPC['codeonce']){
		
		message('起始积分必须大于等于一次消耗积分',$this->createWebUrl('tui'),'error');
	}else{
	$data=array(
		'uniacid'=>$_W['uniacid'],
		'codestart'=>$_GPC['codestart'],
		'codeday'=>$_GPC['codeday'],
		'codeonce'=>$_GPC['codeonce'],
		'codetime'=>$_W['timestamp'],
		);
$res=pdo_update('hulu_list_code',$data,array('uniacid'=>$_W['uniacid']));
if(!empty($res)){
	message('修改成功',$this->createWebUrl('tui'),'success');
}else{
	message('修改失败','','error');
}
}
}
?>