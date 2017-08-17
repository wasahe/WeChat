<?php

global $_W;

$all=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid!=4 AND zendtime>'".$_W['timestamp']."' ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'1'));

$job=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid!=4 ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'1'));

$house=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid!=4 ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'2'));

$old=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid!=4 ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'3'));

$che1=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid!=4 ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'4'));

$che2=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid!=4 ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'5'));

$work=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid!=4 ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'6'));

include $this->template('all');

?>