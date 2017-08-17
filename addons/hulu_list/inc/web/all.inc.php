<?php

global $_W;
$zhaopin=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid!=4 ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'1'));

$fangwu=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid!=4 ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'2'));

$ershou=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid!=4 ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'3'));

$che1=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid!=4 ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'4'));

$che2=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid!=4 ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'5'));


$linshi=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid!=4 ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'6'));

include $this->template('all');

?>