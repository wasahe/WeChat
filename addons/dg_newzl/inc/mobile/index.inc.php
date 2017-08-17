<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/7/12
 * Time: 11:36
 */
require_once MODULE_ROOT."/oauth2.class.php";
load()->func('tpl');
global $_W,$_GPC;
$rid=$_GPC['rid'];
$openid=$_W['openid'];
$table="newzl_reply";
$tablealtgs="newzl_altgs";
$usertable='newzl_user';
$helptable='newzl_helpuser';
$sql1="select * from".tablename($usertable)."where openid=:openid and rid=:rid order by id limit 1";
$parmss=array(":openid"=>$openid,":rid"=>$rid);
$info1=pdo_fetch($sql1,$parmss);
$id=!empty($_GPC['id'])?$_GPC['id']:$info1["id"];
$fromid=$info1["id"];

$sumsql="select count(id) as id from ".tablename($usertable)."where rid=:rid";
$sumid=pdo_fetch($sumsql,array(":rid"=>$rid));
$sum=$sumid['id'];//参加数
$sumsqlc="select SUM(count) as sumcount from ".tablename($usertable)."where rid=:rid";
$sumcount=pdo_fetch($sumsqlc,array(":rid"=>$rid));
$countsum=$sumcount['sumcount'];//传播量

$uniacid=$_W['uniacid'];
$nick=$_W['fans']['tag']['nickname'];
$headimg=$_W['fans']['tag']['avatar'];
$account = WeAccount::create($_W['account']);
$fansinfo = $account->fansQueryInfo($openid);
$site=new Dg_newzlModuleSite();
if (empty($fansinfo) || $fansinfo["subscribe"]!=1) {
    $fansinfo=$site->getUserInfo();
    $obj = json_decode($fansinfo);
    $openid=$obj->openid;
    $nick=$obj->nickname;
    $headimg=$obj->headimgurl;
    $province=$obj->province;//用户的地区
    $city=$obj->city;//用户的省份
}

$sql = "select * from " . tablename($table) . "where rid=:rid and uniacid=:uniacid order by id desc limit 1";
$parms = array(":rid" => $rid, ":uniacid" => $uniacid);
$replyinfo = pdo_fetch($sql, $parms);
$start = date("Y-m-d H:i:s", $replyinfo['starttime']);
$end = date("Y-m-d H:i:s", $replyinfo['endtime']);
$ipcount=$replyinfo['ipcount'];
$piclist = pdo_fetchall("select * from " . tablename($tablealtgs) . "where t_id=" . $replyinfo['id']);
//增加支持数
function userid($usertable, $rid, $uniacid, $id)
{
    if (!empty($id)) {
        $zhichi = "select * from " . tablename($usertable) . "where id=:id and rid=:rid and uniacid=:uniacid order by id limit 1";
        $parms = array(":id" => $id, ":rid" => $rid, ":uniacid" => $uniacid);
        $info = pdo_fetch($zhichi, $parms);
    }
    return $info;
}

$userinfo1 = userid($usertable, $rid, $uniacid, $id);

$fromuserid = $userinfo1['openid'];
$paisqls="set @rowNum=0;";
$paisql="SELECT * FROM (SELECT * ,(@rowNum:=@rowNum+1) AS rowNo FROM ".tablename($usertable)." WHERE rid=:rid ORDER BY COUNT DESC) AS paihang WHERE paihang.openid=:openid";
$paiparm=array(":rid"=>$rid,":openid"=>$fromuserid);
pdo_query($paisqls);
$ranknum=pdo_fetch($paisql,$paiparm);//个人中心排行


$usersql="select * from ".tablename($usertable)."where rid=:rid and openid=:openid";
$userparm=array("rid"=>$rid,":openid"=>$openid);
$userc=pdo_fetch($usersql,$userparm);
$usercount=$userc['count'];//个人传播量


$rank=$ranknum['rowNo'];
if (!empty($id)) {
    $fromheadimg = $userinfo1['headimg'];
    $fromusername=$userinfo1['username'];
}
if (!empty($fromuserid)) {

    $usersql = "select * from " . tablename($usertable) . "where rid=:rid and uniacid=:uniacid  and openid=:fromuserid";
    $usrparm = array(":rid" => $rid, ":uniacid" => $uniacid, ":fromuserid" => $fromuserid);
    $isuser = pdo_fetch($usersql, $usrparm);//查询分享人的信息

    $helpsql = "select * from " . tablename($helptable) . "where rid=:rid and uniacid=:uniacid and helpopenid=:openid and h_id=:h_id order by id limit 1";
    $helpparm = array(":rid" => $rid, ":uniacid" => $uniacid, ":openid" => $openid, "h_id" => $isuser['id']);
    $help = pdo_fetch($helpsql, $helpparm);//判断是否支持
    $helpip="select count(*) from ".tablename($helptable)."where rid=:rid and uniacid=:uniacid and ip=:ip";
    $ipparm=array(":rid"=>$rid,":uniacid"=>$uniacid,":ip"=>$_W['clientip']);
    $li=pdo_fetchcolumn($helpip,$ipparm);
    if ($fromuserid != $openid && empty($help) && !empty($openid) && $li<=$ipcount) {
        $nowtime = time();
        $count = $isuser['count'] + 1;
        $data = array(
            'count' => $count
        );
        pdo_update($usertable, $data, array('rid' => $rid, "uniacid" => $uniacid, "openid" => $fromuserid));
        $insert = array(
            'rid' => $rid,
            'uniacid' => $uniacid,
            'usernick' => $nick,
            'userheadimg' => $headimg,
            'h_id' => $isuser['id'],
            'fromuserid' => $fromuserid,
            'helpopenid' => $openid,
            'addtime' => $nowtime,
            'ip'=>$_W['clientip']
        );
        pdo_insert($helptable, $insert);
    }
}
//用户信息
$user = "select * from " . tablename($usertable) . "where rid=:rid and uniacid=:uniacid and openid=:openid order by id limit 1";
$parm = array(":rid" => $rid, ":uniacid" => $uniacid, ":openid" => $openid);
$userinfo = pdo_fetch($user, $parm);
$usid=$userinfo['id'];

//排行榜
$sql1 = "select * from " . tablename($usertable) . "where rid=:rid and uniacid=:uniacid order by count desc limit 0,100";
$parms1 = array(":rid" => $rid, ":uniacid" => $uniacid);
$userinfo2 = pdo_fetchall($sql1, $parms1);
$time = time();
if ($time > $replyinfo['endtime']) {
    $userinfo['status'] = 3;
}
$url = $this->createMobileUrl('index', array('rid' => $rid, 'id' =>$id,'uniacid'=>$uniacid));
$turl = substr($url, 1);
$shareurl = $_W['siteroot'] . 'app' . $turl;



include $this->template('index');