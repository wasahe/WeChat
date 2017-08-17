<?php

global $_W;
$cheba=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'5'));

$chebb=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'5',':pid'=>'1'));

$chebc=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'5',':pid'=>'2'));

$chebd=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'5',':pid'=>'3'));

$chebe=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'5',':pid'=>'4'));



include $this->template('cheb');

?>