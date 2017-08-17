<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/10/18
 * Time: 10:41
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
$openid=$_W['openid'];
$uniacid=$_W['uniacid'];
$cfg=$this->module['config'];
$title=$cfg['dg_prorec_title'];
load()->func('tpl');
$tags=pdo_fetchall("select * from ".tablename('dg_prorectags')." where uniacid=:uniacid and status=1 order by displayorder desc,id desc",array(":uniacid"=>$uniacid));
//判断用户关注了那些产品
$exist=pdo_fetchall("select * from ".tablename('dg_prorecuser')." where openid=:openid and uniacid=:uniacid and followstatus=2",array(":openid"=>$openid,":uniacid"=>$uniacid));
$usercate=array();
if(!empty($exist)){
    foreach ($exist as $item) {
        $usercate[]=$item['cateid'];
    }
    if(count($usercate)>1){
        $usercondition="and id in (".implode(',',$usercate).")";
    }elseif(!empty($usercate)){
        $usercondition="and id in (".$usercate[0].")";
    }
    $cateid=pdo_fetchall("select id from ".tablename('dg_proreccate')." where uniacid=:uniacid",array(":uniacid"=>$uniacid));
    foreach($cateid as $row){
        $cate[]=$row['id'];
    }
    $res=array_values(array_diff($cate,$usercate));
    if(count($res)>1){
        $condition="and id in (".implode(',',$res).")";
    }elseif(!empty($res)){
            $condition="and id in (".$res[0].")";
    }
    $attpro=pdo_fetchall("select * from ".tablename('dg_proreccate')." where uniacid=:uniacid ".$usercondition." order by displayid desc,id desc",array(":uniacid"=>$uniacid));
    foreach($attpro as &$item){
        $userli=pdo_fetch("select * from ".tablename('dg_prorec')." where cateid=:cateid and uniacid=:uniacid order by id desc",array(":cateid"=>$item['id'],":uniacid"=>$uniacid));
        $reccount=pdo_fetchcolumn("select count(*) from ".tablename('dg_prorec')." where cateid=:cateid and uniacid=:uniacid",array(":cateid"=>$item['id'],":uniacid"=>$uniacid));
        $readcont=pdo_fetchcolumn("select count(*) from ".tablename('dg_prorecread')." where cateid=:cateid and uniacid=:uniacid and openid=:openid",array(":cateid"=>$item['id'],":uniacid"=>$uniacid,":openid"=>$openid));
        if(!empty($item['tags'])){
            $salltags=pdo_fetchall("select tag_name from ".tablename('dg_prorectags')." where uniacid=:uniacid and status=1 and id in({$item['tags']})",array(":uniacid"=>$uniacid));
        }
        $readcom=intval($reccount-$readcont);
        $item['time']=$userli['createtime'];
        $item['readcount']=$readcom;
        $item['tags']=$salltags;
        unset($item);
    }

}
if(empty($res)&&count($usercate)>=1){

}else{
    $allpro = pdo_fetchall("select * from " . tablename('dg_proreccate') . " where uniacid=:uniacid " . $condition . " order by displayid desc,id desc", array(":uniacid" => $uniacid));

    foreach ($allpro as &$item) {
        $li = pdo_fetch("select * from " . tablename('dg_prorec') . " where cateid=:cateid and uniacid=:uniacid order by id desc limit 1", array(":cateid" => $item['id'], ":uniacid" => $uniacid));
        if(!empty($item['tags'])){
            $alltags=pdo_fetchall("select tag_name from ".tablename('dg_prorectags')." where uniacid=:uniacid and status=1 and id in({$item['tags']})",array(":uniacid"=>$uniacid));
        }
        $item['tags']=$alltags;
        $item['time'] = $li['createtime'];
        unset($item);
    }

}
if($_GPC['op']=='on'){
    $id=$_GPC['id'];
    if($_W['fans']['follow']!=1){
        $res['result']=2;
    }else{
        $sql="select * from ".tablename('dg_prorecuser')." where cateid=:id and uniacid=:uniacid and openid=:openid";
        $parms=array(":id"=>$id,":uniacid"=>$uniacid,"openid"=>$openid);
        $user=pdo_fetch($sql,$parms);
        $count=pdo_fetchcolumn("select `count` from ".tablename('dg_proreccate')." where id={$id}");
        $catepro=pdo_fetch("select * from ".tablename('dg_proreccate')." where id={$id}");
        $res=array();
        if(empty($user)){
            if($catepro['money']>0){
                $pay_parameters=getpayment($catepro['money'],$kjSetting);
                $res['data']=@json_decode($pay_parameters);
                $res['result']=3;
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
                'followstatus'=>2,
            );
            pdo_update('dg_prorecuser',$data,array('id'=>$user['id']));
            $catedata=array(
                'count'=>$count+1
            );
            pdo_update("dg_proreccate",$catedata,array("id"=>$id));
        }else{
            $data=array(
                'followstatus'=>1,
            );
            pdo_update('dg_prorecuser',$data,array('id'=>$user['id']));
            $catedata=array(
                'count'=>$count-1
            );
            pdo_update("dg_proreccate",$catedata,array("id"=>$id));
            $res['result']=1;
        }
    }
    header("Content-type:application/json");
    echo json_encode($res);
    exit();
}
if($_GPC['op']=="sla"){
    $tagid=$_GPC['tagid'];
    $data=array();
    if(!empty($exist)){
        foreach ($exist as $item) {
            $usercate[]=$item['cateid'];
        }
        if(count($usercate)>1){
            $usercondition="and id in (".implode(',',$usercate).")";
        }elseif(!empty($usercate)){
            $usercondition="and id in (".$usercate[0].")";
        }
        $cateid=pdo_fetchall("select id from ".tablename('dg_proreccate')." where uniacid=:uniacid",array(":uniacid"=>$uniacid));
        foreach($cateid as $row){
            $cate[]=$row['id'];
        }
        $res=array_values(array_diff($cate,$usercate));
        if(count($res)>1){
            $condition="and id in (".implode(',',$res).")";
        }elseif(!empty($res)){
            $condition="and id in (".$res[0].")";
        }
        $subtags=pdo_fetchall("select * from ".tablename('dg_proreccate')." where uniacid=:uniacid ".$usercondition." and find_in_set({$tagid},tags) order by displayid desc,id desc",array(":uniacid"=>$uniacid));
        foreach($subtags as &$item){
            $userli=pdo_fetch("select * from ".tablename('dg_prorec')." where cateid=:cateid and uniacid=:uniacid order by id desc",array(":cateid"=>$item['id'],":uniacid"=>$uniacid));
            $reccount=pdo_fetchcolumn("select count(*) from ".tablename('dg_prorec')." where cateid=:cateid and uniacid=:uniacid",array(":cateid"=>$item['id'],":uniacid"=>$uniacid));
            $readcont=pdo_fetchcolumn("select count(*) from ".tablename('dg_prorecread')." where cateid=:cateid and uniacid=:uniacid and openid=:openid",array(":cateid"=>$item['id'],":uniacid"=>$uniacid,":openid"=>$openid));
            if(!empty($item['tags'])){
                $alltags=pdo_fetchall("select tag_name from ".tablename('dg_prorectags')." where uniacid=:uniacid and status=1 and id in ({$item['tags']})",array(":uniacid"=>$uniacid));
            }
            $readcom=intval($reccount-$readcont);
            $item['time']=date('m-d',$userli['createtime']);
            $item['icon']=tomedia($item['icon']);
            $item['readcount']=$readcom;
            $item['tags']=$alltags;
            unset($item);
        }
    }
    if(empty($res)&&count($usercate)>=1){
        $unsubtags=array();
    }else{
        $unsubtags = pdo_fetchall("select * from " . tablename('dg_proreccate') . " where uniacid=:uniacid " . $condition . " and find_in_set({$tagid},tags) order by displayid desc,id desc", array(":uniacid" => $uniacid));
        foreach ($unsubtags as &$item) {
            $li = pdo_fetch("select * from " . tablename('dg_prorec') . " where cateid=:cateid and uniacid=:uniacid order by id desc limit 1", array(":cateid" => $item['id'], ":uniacid" => $uniacid));
            if(!empty($item['tags'])){
                $alltags=pdo_fetchall("select tag_name from ".tablename('dg_prorectags')." where uniacid=:uniacid and status=1 and id in ({$item['tags']})",array(":uniacid"=>$uniacid));
            }
            $item['tags']=$alltags;
            $item['time'] = date("m-d",$li['createtime']);
            $item['icon']=tomedia($item['icon']);
            unset($item);
        }
    }
    $data['sublist']=$subtags;
    $data['unsublist']=$unsubtags;
    header("Content-type:application/json");
    echo json_encode($data);
    exit();
}
$slide=pdo_fetchall("select * from ".tablename('dg_prorec_slide')." where uniacid=:uniacid and status=2",array(':uniacid'=>$uniacid));


include $this->template('index');