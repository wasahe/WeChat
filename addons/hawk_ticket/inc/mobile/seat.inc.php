<?php
global $_W,$_GPC;
$this->checkMobile();
load()->func('tpl');
$input = array();
if(empty($_GPC['actid'])){
    message('活动错误',referer,'warning');
}
$id = $_GPC['actid'];
require_once(MODULE_ROOT.'/module/Activity.class.php');
require_once(MODULE_ROOT.'/module/Order.class.php');
require_once(MODULE_ROOT.'/module/Seat.class.php');
$act = new Activity();
$order = new Order();
$scl = new Seat();
$ds = $act->getOne($id);
if(!$ds){
    message("访问错误",referer,'warning');
}
//获取座们配置
if(!empty($ds['seatsets']) && $ds['isseat']){
    $atmp=unserialize($ds['seatsets']);
    $ds['seattype']=htmlspecialchars_decode(base64_decode($atmp[0]));
    $ds['crset']=htmlspecialchars_decode(base64_decode($atmp[1]));
    $ds['seatset']=htmlspecialchars_decode(base64_decode($atmp[2]));
    $ds['seattype']=str_replace("&#039;","'" ,$ds['seattype'] );
    $ds['crset']=str_replace("&#039;","'" ,$ds['crset'] );
    $ds['seatset']=str_replace("&#039;","'" ,$ds['seatset'] );
    $ds['usedseats']=unserialize($ds['usedseats']);
    $ds['orderseats'] = unserialize(base64_decode($ds['orderseats']));
    if(!empty($ds['orderseats'])){
        $unseats = implode(',',$ds['orderseats']);
        $ds['usedseats'] = $ds['usedseats'].','.$unseats;
    }
    $ds['usedseats']=str_replace("&#039;","'" ,$ds['usedseats'] );
}else{
    message("访问错误",referer,'warning');
}
include $this->template('seat');
