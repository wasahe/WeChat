<?php

global $_W;
$zhaopina=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'1'));

$zhaopinb=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'1',':pid'=>'1'));

$zhaopinc=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'1',':pid'=>'2'));

$zhaopind=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'1',':pid'=>'3'));

$zhaopine=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'1',':pid'=>'4'));



include $this->template('job');

?>