<?php

global $_W,$_GPC;
if($_W['ispost']){
	$data=array(
		'uniacid'=>$_W['uniacid'],
		'linkimg'=>$_GPC['linkimg'],
		'linkurl'=>$_GPC['linkurl'],
		'linkalt'=>$_GPC['linkalt'],
		'linktime'=>$_W['timestamp'],
		);
$res=pdo_insert('hulu_list_lunbo',$data);
if(!empty($res)){
	message('添加成功',$this->createWebUrl('lunbo'),'success');
}else{
	message('添加失败',$this->createWebUrl('lunbo'),'error');
}
}else{

}
//include $this->template(');

?>