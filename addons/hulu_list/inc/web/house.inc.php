<?php

global $_W;
$fangwua=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'2'));

$fangwub=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'2',':pid'=>'1'));

$fangwuc=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'2',':pid'=>'2'));

$fangwud=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'2',':pid'=>'3'));

$fangwue=pdo_fetchall("SELECT * FROM".tablename('hulu_list_info')."WHERE uniacid=:uniacid AND list=:list AND pid=:pid ORDER BY id DESC",array(':uniacid'=>$_W['uniacid'],':list'=>'2',':pid'=>'4'));



include $this->template('house');

?>