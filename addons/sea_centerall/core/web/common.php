<?php
    global $_GPC, $_W;
    load()->func('tpl');
    
    $uniacid=$_W['uniacid'];
    
    $pindex = max(1, intval($_GPC['page']));
    $psize  = 15;

    $operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
    
