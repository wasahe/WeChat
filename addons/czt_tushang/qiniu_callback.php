<?php
if (!empty($_GET['check'])) {
    die('ok');
}
require '../../framework/bootstrap.inc.php';
$callbackBody = file_get_contents('php://input');
$callbackBody = json_decode($callbackBody, true);
$id           = intval($_GET['id']);
if ($callbackBody['code'] == 0 && $id) {
    if ($_GET['type'] == 'video') {
        pdo_update('czt_tushang_video', array('qiniu_stat' => '1'), array('id' => $id));
    } else {
        pdo_update('czt_tushang_image', array('qiniu_stat' => '1'), array('id' => $id));
    }
}