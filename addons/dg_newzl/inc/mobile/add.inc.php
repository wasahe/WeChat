<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/7/13
 * Time: 10:01
 */
require_once MODULE_ROOT."/oauth2.class.php";
global $_W,$_GPC;
$table="newzl_reply";
$usertable="newzl_user";
$name=$_GPC['username'];
$phone=$_GPC['userphone'];
$rid=$_GPC['rid'];
$uniacid=$_W['uniacid'];
$nick=$_W['fans']['tag']['nickname'];
$headimg=$_W['fans']['tag']['avatar'];
$province=$_W['fans']['tag']['province'];
$city=$_W['fans']['tag']['city'];
$openid=$_W['openid'];
$sql="select * from ".tablename($table)."where rid=:rid and uniacid=:uniacid";
$parm=array(":rid"=>$rid,":uniacid"=>$uniacid);
$reply=pdo_fetch($sql,$parm);
$usersql="select count(*) from ".tablename($usertable)."where username=:username and userphone=:userphone and openid=:openid";
$userparm=array(":username"=>$name,":userphone"=>$phone,":openid"=>$openid);
$usercount=pdo_fetchcolumn($usersql,$userparm);
$g = "/^1[34578]\d{9}$/";
$obj=array();
$obj['success']=0;
$time=time();
$account = WeAccount::create($_W['account']);
$fansinfo = $account->fansQueryInfo($openid);
$site=new Dg_newzlModuleSite();
if (empty($fansinfo) || $fansinfo["subscribe"]!=1) {
    $fansinfo=$site->getUserInfo();
    $object = json_decode($fansinfo);
    $openid=$object->openid;
    $nick=$object->nickname;
    $headimg=$object->headimgurl;
    $province=$object->province;//用户的地区
    $city=$object->city;//用户的省份
}
header('Content-type: application/json');
if(!empty($reply['province'])&&!empty($reply['city'])){
    if($province!=$reply['province']&&$city!=$reply['city']){
        $obj['msg']="该活动只允许".$reply['province'].$reply['city']."地区用户参加";
        echo(json_encode($obj));
        exit;
    }
}
if($usercount>=1){
    $obj['msg']="您已经报过名了";
    echo(json_encode($obj));
    exit;
}
if(preg_match($g,$phone)){
    $status=2;
    $insert=array(
        'rid'=>$rid,
        'uniacid'=>$uniacid,
        'nick'=>$nick,
        'headimg'=>$headimg,
        'username'=>$name,
        'userphone'=>$phone,
        'openid'=>$openid,
        'addtime'=>$time,
        'status'=>$status,
        'province'=>$province,
        'city'=>$city
    );
    $res=pdo_insert($usertable,$insert);
    $id=pdo_insertid();
    if($res){
        $obj['success']=1;
        $obj['msg']="添加成功";
        $obj['id']=$id;
        $obj['rid']=$rid;
        $obj['uniacid']=$uniacid;
    }
    echo(json_encode($obj));
}else{
    $obj['msg']="请填写正确的手机号";
    echo(json_encode($obj));
};