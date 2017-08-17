<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/7/13
 * Time: 12:22
 */
global $_W,$_GPC;
load()->func('tpl');
$rid=$_GPC['rid'];
$uniacid=$_GPC['uniacid'];
$usertable="newzl_user";
$sql="select * from ".tablename($usertable)."where rid=:rid and uniacid=:uniacid order by count desc";
$parms=array(":rid"=>$rid,":uniacid"=>$uniacid);
$userinfo=pdo_fetchall($sql,$parms);
include $this->template('rule');