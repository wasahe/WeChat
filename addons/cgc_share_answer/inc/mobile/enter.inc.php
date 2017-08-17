<?php
 

global $_W;
global $_GPC;
$_SESSION['forward'] = true;
$form = ((empty($_GPC['form']) ? 'question' : $_GPC['form']));
header('location:' . $this->createMobileUrl($form, array('test' => $_GPC['test'])));

?>