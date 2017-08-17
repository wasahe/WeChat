<?php
global $_W,$_GPC;
$this->checkMobile();
$input = array();
if(empty($_GPC['actid'])){
    message('订单错误',referer,'warning');
}
$id = $_GPC['actid'];
require_once(MODULE_ROOT.'/module/Activity.class.php');
require_once(MODULE_ROOT.'/module/Order.class.php');
require_once(MODULE_ROOT.'/module/Seat.class.php');
$act = new Activity();
$order = new Order();
$seat = new Seat();
$ds = $act->getOne($id);
if(!$ds){
    message("访问错误",referer,'warning');
}
//总票数限制
$ds['remain']= $ds['tlimit'] - $ds['used'];
if($ds['remain']<=0){
    message("票已售完，您可以查看其他活动",$this->createMobileUrl('list'),'warning');
}
//加入限购
$maxlimit = $ds['buylimit'];
if($maxlimit > 0){

    $filters = array();
    $fileters['status'] = 2;
    $fileters['actid'] = $ds['id'];
    $payed=$order->getMyOrders($fileters);
    $fileters['status'] = 3;
    $checked=$order->getMyOrders($fileters);
    if($payed){
        $payednum = count($payed);
    }else{
        $payednum = 0;
    }
    if($checked){
        $checkednum = count($checked);
    }else{
        $checkednum = 0;
    }
    $allbuynums = $checkednum + $payednum;
    if($allbuynums >= $maxlimit){
        message("您已购买过了，最多可购买".$maxlimit."张",$this->createMobileUrl('list'),'warning');
    }
}
//写入订单
$input = array();
$input['actid'] = $id;
if($_GPC['pr']){
    $ds['fee']=intval($_GPC['pr']);
    $input['fee'] = $ds['fee'];
}else{
    $input['fee'] = $ds['fee'];
}
$res = $order->create($input);
//写入座位 www.efwww.com  易福源码网
if(!empty($_GPC['st'])){
    $seats = unserialize(base64_decode($_GPC['st']));
    $sinput['seats'] = $_GPC['st'];
    $sinput['price'] = $input['fee'];
    $sinput['nums'] = count($seats);
    $sinput['orid'] = $res;
    $sinput['ptime'] = $_GPC['utime'];
    $seat->create($sinput);
}
if($res){
    $orderid = $res;
    $params = array();
    $params['id'] = $orderid;
    $params['fee'] = $ds['fee'];
    $params['title'] = $ds['proname'];

    $params = base64_encode(serialize($params));
    $url = $this->createMobileUrl('pay',array('pars'=>$params));
    header("Location:{$url}");
    exit();
}else{
    message('订单出错',referfer,'error');
}
