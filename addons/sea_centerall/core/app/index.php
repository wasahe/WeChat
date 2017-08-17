<?php
include_once 'common.php';
$pageTitle = "会员中心";

if($operation == 'display'){
    $advs     = pdo_fetchall("select * from " . tablename($this->tb_adv) . " where uniacid = $uniacid and enabled=1 and deleted = 0 order by displayorder desc ");
    $advs     = set_medias($advs, "thumb");
    
    $menus     = pdo_fetchall("select * from " . tablename($this->tb_menus) . " where uniacid = $uniacid and enabled=1 and deleted = 0 order by displayorder desc ");
    $menus     = set_medias($menus, "thumb");
}

include $this->template('index');