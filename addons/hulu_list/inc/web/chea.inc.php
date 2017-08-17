<?php

global $_W;
$cheaa=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'4'));

$cheab=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'4',':pid'=>'1'));

$cheac=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'4',':pid'=>'2'));

$chead=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'4',':pid'=>'3'));

$cheae=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'4',':pid'=>'4'));



include $this->template('chea');

?>