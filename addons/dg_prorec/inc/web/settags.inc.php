<?php
/**
 * Created by PhpStorm.
 * User: chengbin
 * Date: 2016/10/31
 * Time: 15:02
 */
global $_W,$_GPC;
load()->func('tpl');
$uniacid=$_W['uniacid'];
$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if($operation=='display'){
    $list = pdo_fetchall("SELECT * FROM " . tablename('dg_prorectags') . " WHERE uniacid = '{$uniacid}' ORDER BY displayorder DESC");
}elseif ($operation == 'post') {

    $id = intval($_GPC['id']);
    if (checksubmit('submit')) {
        $data = array(
            'uniacid' => $uniacid,
            'tag_name' => $_GPC['tag_name'],
            'status' => intval($_GPC['status']),
            'displayorder' => intval($_GPC['displayorder']),
            'createtime'=>time()
        );

        if (!empty($id)) {
            pdo_update('dg_prorectags', $data, array('id' => $id));
        } else {
            pdo_insert('dg_prorectags', $data);
            $id = pdo_insertid();
        }
        message('更新标签成功！', $this->createWebUrl('settags', array('op' => 'display')), 'success');
    }
    $banner = pdo_fetch("select * from " . tablename('dg_prorectags') . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $id, ":uniacid" => $uniacid));
} elseif ($operation == 'delete') {
    $id = intval($_GPC['id']);
    $banner = pdo_fetch("SELECT id  FROM " . tablename('dg_prorectags') . " WHERE id = '$id' AND uniacid=" . $uniacid);
    if (empty($banner)) {
        message('抱歉，标签不存在或是已经被删除！', $this->createWebUrl('settags', array('op' => 'display')), 'error');
    }
    pdo_delete('dg_prorectags', array('id' => $id));
    message('标签删除成功！', $this->createWebUrl('settags', array('op' => 'display')), 'success');
} else {
    message('请求方式不存在');
}
include $this->template('settags');