<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/10/18
 * Time: 18:19
 */


$kjSetting=$this->findKJsetting();

function ordersubmit($orderid,$moneynum){
    global $_W,$_GPC;
    $id=$_GPC['id'];
    $uniacid=$_W['uniacid'];
    $openid=$_W['openid'];
    $data=array(
        "uniacid"=>$uniacid,
        "cateid"=>$id,
        "openid"=>$openid,
        "pay_money"=>$moneynum,
        "out_trade_no"=>$orderid,
        "status"=>0,
        "pay_time"=>time(),
    );
    pdo_insert('dg_prorecpay',$data);
}

function getpayment($money,$kjSetting){
    global $_W;
    $money= floatval($money);
    $money=(int)($money*100);
    $jsApi = new JsApi_pub($kjSetting);
    $openid=$_W['openid'];
    $unifiedOrder = new UnifiedOrder_pub($kjSetting);
    $unifiedOrder->setParameter("openid", "$openid");//商品描述
    $unifiedOrder->setParameter("body", "订阅付费");//商品描述
    $timeStamp = time();
    $out_trade_no =  date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    $unifiedOrder->setParameter("out_trade_no", "$out_trade_no");//商户订单号
    $unifiedOrder->setParameter("total_fee", $money);//总金额
    $notifyUrl = $_W['siteroot'] . "addons/dg_prorec/notify.php";
    $unifiedOrder->setParameter("notify_url", $notifyUrl);//通知地址
    $unifiedOrder->setParameter("trade_type", "JSAPI");//交易类型
    $prepay_id = $unifiedOrder->getPrepayId();
    $jsApi->setPrepayId($prepay_id);
    $jsApiParameters = $jsApi->getParameters();

    //插入数据到赞赏表中

    ordersubmit($out_trade_no,$money);
    return $jsApiParameters;
}

global $_W,$_GPC;
load()->func('tpl');
$id=$_GPC['id'];//分类id
$uniacid=$_W['uniacid'];

$openid=$_W['openid'];
$catesql="select * from ".tablename("dg_proreccate")." where id=:id and uniacid=:uniacid";

$sql="select * from ".tablename('dg_prorec')." where cateid=:id and uniacid=:uniacid and status=2 order by id desc";
$usersql="select * from ".tablename('dg_prorecuser')." where cateid=:id and uniacid=:uniacid and openid=:openid";
$parms=array(':id'=>$id,":uniacid"=>$uniacid);
$usrparms=array(':id'=>$id,":uniacid"=>$uniacid,":openid"=>$openid);
$categroy=pdo_fetch($catesql,$parms);
$user=pdo_fetch($usersql,$usrparms);//用户关注状态
$num=pdo_fetchcolumn("select count(*) from ".tablename('dg_prorec')." where cateid=:id and uniacid=:uniacid and status=2",array(":id"=>$id,":uniacid"=>$uniacid));
if($categroy['money']>0){
    if(empty($user)){
        $content=1;
    }
}
if(!empty($categroy['tags'])){
    $alltags=pdo_fetchall("select tag_name from ".tablename('dg_prorectags')." where uniacid=:uniacid and status=1 and id in({$categroy['tags']})",array(":uniacid"=>$uniacid));
}

if($_GPC['op']=='on'){
    $recid=$_GPC['recid'];//文章id
    $id=$_GPC['id'];
    $res=array();
    if($user['followstatus']==2){
        $isreadsql="select * from ".tablename('dg_prorecread')." where uniacid=:uniacid and openid=:openid and recid=:recid and cateid=:id";
        $redprams=array(":uniacid"=>$uniacid,":openid"=>$openid,":recid"=>$recid,":id"=>$id);
        $read=pdo_fetch($isreadsql,$redprams);
        if(empty($read)){
            $data=array(
                'uniacid'=>$uniacid,
                'cateid'=>$id,
                'recid'=>$recid,
                'openid'=>$openid,
                'status'=>2,
                'createtime'=>TIMESTAMP
            );
            pdo_insert('dg_prorecread',$data);
            $res['result']=1;
        }
    }
    header('Content-type:application/json');
    echo json_encode($res);
    exit();
}
$vesql="select * from ".tablename('dg_prorec')." where cateid=:id and uniacid=:uniacid order by id desc limit 1";
$vesion=pdo_fetch($vesql,$parms);
$list=pdo_fetchall($sql,$parms);
foreach($list as &$item){
    $readsql="select * from ".tablename('dg_prorecread')." where uniacid=:uniacid and openid=:openid and recid=:recid and cateid=:id";
    $ireadprams=array(":uniacid"=>$uniacid,":openid"=>$openid,":recid"=>$item['id'],":id"=>$id);
    $read=pdo_fetch($readsql,$ireadprams);
    if(empty($read)){
        $item['read']=1;
    }else{
        $item['read']=2;
    }
    unset($item);
}
if($_GPC['op']=='sub'){
    $ress=array();
    if($_W['fans']['follow']!=1){
        $ress['result']=1;
    }else{
        $sql="select * from ".tablename('dg_prorecuser')." where cateid=:id and uniacid=:uniacid and openid=:openid";
        $parms=array(":id"=>$id,":uniacid"=>$uniacid,"openid"=>$openid);
        $user=pdo_fetch($sql,$parms);
        $count=pdo_fetchcolumn("select `count` from ".tablename('dg_proreccate')." where id={$id}");
        $catepro=pdo_fetch("select * from ".tablename('dg_proreccate')." where id={$id}");
        if(empty($user)){
            if($catepro['money']>0){
                $pay_parameters=getpayment($catepro['money'],$kjSetting);
                $ress['data']=@json_decode($pay_parameters);
                $ress['result']=2;
            }else{
                $data=array(
                    'uniacid'=>$uniacid,
                    'openid'=>$openid,
                    'cateid'=>$id,
                    'followstatus'=>2,
                    'follow_time'=>TIMESTAMP
                );
                pdo_insert('dg_prorecuser',$data);
                $catedata=array(
                    'count'=>$count+1
                );
                pdo_update("dg_proreccate",$catedata,array("id"=>$id));
            }
        }elseif($user['followstatus']==1) {
            $data=array(
                'followstatus'=>2
            );
            pdo_update('dg_prorecuser',$data,array('id'=>$user['id']));
            $catedata=array(
                'count'=>$count+1
            );
            pdo_update("dg_proreccate",$catedata,array("id"=>$id));
        }else{
            $data=array(
                'followstatus'=>1
            );
            pdo_update('dg_prorecuser',$data,array('id'=>$user['id']));
            $catedata=array(
                'count'=>$count-1
            );
            pdo_update("dg_proreccate",$catedata,array("id"=>$id));
        }
    }
    header('Content-type:application/json');
    echo json_encode($ress);
    exit();
}
include $this->template('single');