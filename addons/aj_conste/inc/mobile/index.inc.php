<?php
global $_W;
//获取活动数据
$list = pdo_fetch("SELECT * FROM ".tablename('aj_conste')." WHERE `uniacid`=:uniacid ORDER BY `id` DESC",array(':uniacid'=>$_W['uniacid']));
// var_dump($list);exit;
//加载视图
include $this->template('index');