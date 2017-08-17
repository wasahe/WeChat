<?php
require_once 'common.php';

if ($operation == 'display') {
    if (!empty($_GPC['displayorder'])) {
        foreach ($_GPC['displayorder'] as $id => $displayorder) {
            pdo_update($this->tb_adv, array( 'displayorder' => $displayorder ), array( 'id' => $id ));
        }
        message('幻灯片排序更新成功！', $this->createWebUrl('adv', array( 'op' => 'display' )), 'success');
    }
    $list = pdo_fetchall("SELECT * FROM " . tablename($this->tb_adv) . " WHERE uniacid = '{$_W['uniacid']}' and deleted = 0 ORDER BY displayorder DESC");
} 

elseif ($operation == 'post') {
    $id = intval($_GPC['id']);
    if (checksubmit('submit')) {
        $data = array(
            'uniacid' => $_W['uniacid'],
            'title'   => trim($_GPC['title']),
            'thumb'   => $_GPC['thumb'],
            'link' => trim($_GPC['link']),
            'enabled' => intval($_GPC['enabled']),
            'displayorder' => intval($_GPC['displayorder']),
        );
        if (!empty($id)) {
            pdo_update($this->tb_adv, $data, array( 'id' => $id ));
        } else {
            pdo_insert($this->tb_adv, $data);
            $id = pdo_insertid();
        }
        message('幻灯片更新成功！', $this->createWebUrl('adv', array( 'op' => 'display' )), 'success');
    }
    
    $item = pdo_fetch("select * from " . tablename($this->tb_adv) . " where id = ".$id);
} 

/**
 * 删除幻灯片
 */
elseif ($operation == 'delete') {
    $id   = intval($_GPC['id']);
    $item = pdo_fetch("SELECT * FROM " . tablename($this->tb_adv) . " WHERE id = '$id' and deleted = 0 AND uniacid=" . $_W['uniacid'] . "");
    if (empty($item)) {
        message('抱歉,该幻灯片不存在或是已经被删除！', $this->createWebUrl('adv', array( 'op' => 'display' )), 'error');
    }
    pdo_update($this->tb_adv, array('deleted'=>1) ,array( 'id' => $id ));
    message('幻灯片删除成功！', $this->createWebUrl('adv', array( 'op' => 'display' )), 'success');
}

include $this->template('adv');