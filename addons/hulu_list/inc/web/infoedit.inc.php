<?php

global $_W,$_GPC;
$data=array(
'pid'=>$_GPC['pid'],

);
$res=pdo_update("hulu_list_info",$data,array('uniacid'=>$_W['uniacid'],'id'=>$_GPC['vid']));
if(!empty($res)){
	message('恭喜，修改成功！','','success');

}else{
	message('抱歉，修改失败，请重试！','','error');
}

?>