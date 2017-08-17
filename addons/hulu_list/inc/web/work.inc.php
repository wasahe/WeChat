<?php

global $_W;
$linshia=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'6'));

$linshib=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'6',':pid'=>'1'));

$linshic=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'6',':pid'=>'2'));

$linshid=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'6',':pid'=>'3'));

$linshie=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'6',':pid'=>'4'));



include $this->template('work');

?>