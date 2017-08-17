<?php

global $_W,$_GPC;
$res=pdo_delete('hulu_list_lunbo',array('lid'=>$_GPC['lid']));
if(!empty($res)){
	message('删除成功',$this->createWebUrl('lunbo'),'success');
}else{
	message('删除失败',$this->createWebUrl('lunbo'),'error');
}

?>