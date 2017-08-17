<?php
require_once 'common.php';

if ($operation == 'display') {
    if (!empty($_GPC['displayorder'])) {
        foreach ($_GPC['displayorder'] as $id => $displayorder) {
            pdo_update($this->tb_menus, array( 'displayorder' => $displayorder ), array( 'id' => $id ));
        }
        message('排序更新成功！', $this->createWebUrl('manage', array( 'op' => 'display' )), 'success');
    }
    $list = pdo_fetchall("SELECT * FROM " . tablename($this->tb_menus) . " WHERE uniacid = '{$_W['uniacid']}' and deleted = 0 ORDER BY displayorder DESC");
} 

elseif ($operation == 'post') {
    $id = intval($_GPC['id']);
    if (checksubmit('submit')) {
        $data = array(
            'uniacid' => $_W['uniacid'],
            'title'   => trim($_GPC['title']),
            'thumb'   => $_GPC['thumb'],
            'link' => trim($_GPC['link']),
            'fontsize' => $_GPC['fontsize'],
            'color' => $_GPC['color'],
            'imgwidth' => $_GPC['imgwidth'],
            'imgheight' => $_GPC['imgheight'],
            'enabled' => intval($_GPC['enabled']),
            'displayorder' => intval($_GPC['displayorder']),
        );
        if (!empty($id)) {
            pdo_update($this->tb_menus, $data, array( 'id' => $id ));
        } else {
            pdo_insert($this->tb_menus, $data);
            $id = pdo_insertid();
        }
        message('更新成功！', $this->createWebUrl('manage', array( 'op' => 'display' )), 'success');
    }
    
    $item = pdo_fetch("select * from " . tablename($this->tb_menus) . " where id = ".$id);
} 

/**
 * 删除幻灯片
 */
elseif ($operation == 'delete') {
    $id   = intval($_GPC['id']);
    $item = pdo_fetch("SELECT * FROM " . tablename($this->tb_menus) . " WHERE id = '$id' and deleted = 0 AND uniacid=" . $_W['uniacid'] . "");
    if (empty($item)) {
        message('抱歉,该导航不存在或是已经被删除！', $this->createWebUrl('manage', array( 'op' => 'display' )), 'error');
    }
    pdo_update($this->tb_menus, array('deleted'=>1) ,array( 'id' => $id ));
    message('删除成功！', $this->createWebUrl('manage', array( 'op' => 'display' )), 'success');
}

include $this->template('manage');