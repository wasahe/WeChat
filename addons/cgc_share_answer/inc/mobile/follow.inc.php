<?php
 

global $_GPC;
global $_W;
$uniacid = $_W['uniacid'];
$settings = $this->module['config'];
$modulename = $this->modulename;
include $this->template('follow');
exit();

?>