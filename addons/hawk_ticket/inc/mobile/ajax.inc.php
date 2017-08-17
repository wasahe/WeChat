<?php
global $_W,$_GPC;
$this->checkMobile();
load()->func('tpl');
$input = array();
$eurl = $this->createMobileUrl('seat',array('actid'=>$_GPC['actid']));
if(empty($_GPC['actid'])){
    message('活动错误',$eurl,'warning');
}
$id = $_GPC['actid'];
require_once(MODULE_ROOT.'/module/Activity.class.php');
require_once(MODULE_ROOT.'/module/Order.class.php');
require_once(MODULE_ROOT.'/function/check.func.php');
$act = new Activity();
$order = new Order();
$ds = $act->getOne($id);
if(!$ds){
    message("访问错误",$erul,'warning');
}
//file_put_contents('test.txt',$_POST['data'] );
if($ds) {
    $seats = $_GPC['seats'];
    $tmoney= $_GPC['tmoney'];
    $seats = str_replace("&#039;","'" ,$seats );
    if(!empty($seats)){
        $sarry=array_filter(explode(',',$seats));
        //print_r($sarry);
        //exit();
        $check = seat_check($sarry, $ds['id']);
        $varry = base64_encode(serialize($sarry));
        $utime = base64_encode($_GPC['usetime']);
        if($check){
            $url = $this->createMobileUrl('order',array('actid'=>$ds['id'],'pr'=>$tmoney,'st'=>$varry,'utime'=>$utime));
            header("Location:$url");
            //echo "true";
        }else{
            //echo "false";
            message('座位出错，请重新选择',$eurl,'error');
        }

    }else{
        //echo "false";
        message('座位出错，请重新选择',$eurl,'error');
    }
}else{
    //echo "false";
    message('座位出错，请重新选择',$eurl,'error');
}