<?php

global $_W,$_GPC;
if(!($_W['ispost'])){
$page=pdo_fetchall("SELECT * FROM".tablename('hulu_list_code')."WHERE uniacid=:uniacid",array(':uniacid'=>$_W['uniacid']));

if(!empty($page)){
	$page=pdo_fetch("SELECT * FROM".tablename('hulu_list_code')."WHERE uniacid=:uniacid",array(':uniacid'=>$_W['uniacid']));
load()->func('tpl');
include $this->template('page');


}else{
	$arr=array(
		'uniacid'=>$_W['uniacid'],
			'codestart'=>$_GPC['codestart'],
		'codeday'=>$_GPC['codeday'],
		'codeonce'=>$_GPC['codeonce'],
		'codetime'=>$_W['timestamp'],
		'webtitle'=>$_W['account']['name'].'同城信息',
		'follow'=>'<h1>'.'请先关注微信公众号：'.$_W['account']['name'].'，'.'“'.$_W['account']['account'].'”'.'</h1>',
		'open'=>'<h1>'.'请在微信客户端打开'.'<h1>',
		);
		pdo_insert('hulu_list_code',$arr);
		
		$page=pdo_fetch("SELECT * FROM".tablename('hulu_list_code')."WHERE uniacid=:uniacid",array(':uniacid'=>$_W['uniacid']));
		load()->func('tpl');
include $this->template('page');
}

}else{


	$data=array(
		'uniacid'=>$_W['uniacid'],
		'webtitle'=>$_GPC['webtitle'],
		'follow'=>$_GPC['follow'],
		'open'=>$_GPC['open'],
	
		'codetime'=>$_W['timestamp'],
		);
$res=pdo_update('hulu_list_code',$data,array('uniacid'=>$_W['uniacid']));
if(!empty($res)){
	message('修改成功',$this->createWebUrl('page'),'success');
}else{
	message('修改失败','','error');
}
}

?>