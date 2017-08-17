<?php

global $_GPC, $_W;
load()->func('tpl');
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';

if ($op == 'post') {
    $id = intval($_GPC['id']);
    if (!$id) {
        $is_new = 1;
    } else {
        $is_new = 0;
    }
    // tpl_form_field_category_2level($name, $parents, $children, $parentid, $childid)
    // if ($_POST) {//@test;
    if (checksubmit('submit')) {
        // print_r($_POST);exit;

        $data = array();
        $data = $_GPC['jform'];
        $data['titledesc'] = $_GPC['titledesc'];
        $data['uniacid'] = $_W['uniacid'];
        $data['update_time'] = date("Y-m-d H:i:s");
        // print_r($data);exit;

        $cate_id = $_GPC['cate_id'];
        if ($cate_id['childid']) {
            $data['cate_id'] = $cate_id['childid'];
        } else {
            $data['cate_id'] = (int) $cate_id['parentid'];
        }
        // print_r($data);exit;
        if ($is_new) {
            $data['create_time'] = date("Y-m-d H:i:s");
            pdo_insert('daojia_goods', $data);
            $id = pdo_insertid();
        } else {
            pdo_update('daojia_goods', $data, array('id' => $id));
        }

        message('资料更新成功！', $this->createWebUrl('goods', array('op' => 'display')), 'success');
    }

    //default：
    if ($is_new) {
        $item = array();
        $item['status'] = 1;
        $item['default_sale'] = 0; //最低销量
    } else {
        //读取资料：
        $sql = "select * from " . tablename('daojia_goods') . " where uniacid = '{$_W['uniacid']}' and id='{$id}' limit 1 ";
        $item = pdo_fetch($sql);
        $cate_id = get_cate_id($item['cate_id']);

        $item['parent_id'] = $cate_id['parent_id'];
        $item['child_id'] = $cate_id['child_id'];
        // print_r($item);exit;
    }

    //读取分类数组：
    $cate_arr = get_goods_cate();
    // print_r($cate_arr);exit;

    include $this->template('goods_post');
} else if ($op == 'cate') {
    //项目分类：
    $parent_id = intval($_GPC['parent_id']);
    //显示列表；
    $pindex = max(1, intval($_GPC['page']));
    $psize = 1000;
    $condition = " and parent_id = '{$parent_id}' ";


    $sql = 'SELECT COUNT(*) FROM ' . tablename('daojia_goods_cate') .
            " WHERE uniacid = '{$_W['uniacid']}' $condition";
    $total = pdo_fetchcolumn($sql);

    $sql = "SELECT * FROM " . tablename('daojia_goods_cate') .
            " WHERE uniacid = '{$_W['uniacid']}' $condition 
				ORDER BY orderby desc LIMIT " .
            ($pindex - 1) * $psize . ',' . $psize;
    $list = pdo_fetchall($sql);
    $pager = pagination($total, $pindex, $psize);
    // print_r($list);exit;

    include $this->template('goods_cate');
} else if ($op == 'cate_post') {
    //添加和保存资料：
    // print_r($_GPC);exit;
    $id = intval($_GPC['id']);
    $return = $_GPC['return'];
    if ($_POST) {
        $data = array(
            'uniacid' => intval($_W['uniacid']),
            'title' => $_GPC['title'],
            'parent_id' => intval($_GPC['parent_id']),
            'orderby' => intval($_GPC['orderby'])
        );
        // print_r($data);exit;
        // echo IA_ROOT;exit;

        if (empty($id)) {
            pdo_insert('daojia_goods_cate', $data);
            $id = pdo_insertid();
        } else {
            pdo_update('daojia_goods_cate', $data, array('id' => $id));
        }
        if (!$return) {
            $return = $this->createWebUrl('goods', array('op' => 'cate'));
        }
        message('数据更新成功！', $return, 'success');
        exit;
    }
} else if ($op == 'cate_delete') {
    $id = intval($_GPC['id']);
    $return = $_GPC['return'];
    // print_r($return);exit;

    $row = pdo_fetch("SELECT id,parent_id FROM " . tablename('daojia_goods_cate') . " WHERE id = :id", array(':id' => $id));
    if (empty($row['id'])) {
        message('抱歉，指定的项目不存在或是已经被删除！');
    }


    pdo_delete("daojia_goods_cate", array("id" => $id));
    //删除下级分类：
    if ($row['parent_id'] == 0) {
        pdo_delete("daojia_goods_cate", array("parent_id" => $id));
    }

    if (!$return) {
        $return = $this->createWebUrl('goods', array('op' => 'cate'));
    }
    message('删除成功！', $return, 'success');
} else if ($op == 'delete') {
    $id = intval($_GPC['id']);
    $id_arr = $_GPC['delete'];
    if (!is_array($id_arr)) {
        $id = intval($_GPC['id']);
        $id_arr[] = $id;
    }
    // print_r($id_arr);exit;
    // echo $id;exit;

    if (is_array($id_arr) && sizeof($id_arr)) {
        foreach ($id_arr as $id) {
            $sql = "delete from " . tablename('daojia_goods') . " WHERE uniacid = {$_W['uniacid']} and id = '{$id}' limit 1 ";
            // echo $sql;exit;
            pdo_query($sql);
        }
    } else {
        message('抱歉，要删除的项目不存在或是已经被删除！');
    }

    message('删除成功！', $this->createWebUrl('goods', array('op' => 'display')), 'success');
} else {
    //display list:
    //显示资源列表；
    $pindex = max(1, intval($_GPC['page']));
    $psize = 15;

    //filter:
    $condition = ' and a.id != "" ';
    if (!empty($_GPC['keyword'])) {
        $condition .= " AND a.title LIKE '%{$_GPC['keyword']}%'";
    }

    if ($_GPC['status'] > -1) {
        $condition .= " AND a.status = '" . intval($_GPC['status']) . "'";
    } else {
        $_GPC['status'] = -1;
    }

    //不显示被隐藏的订单，特征是status=-1;
    $condition .= ' and a.status >= 0 ';
    $sql = "SELECT * FROM " . tablename('daojia_goods') . " as a " .
            " WHERE a.uniacid = '{$_W['uniacid']}' $condition 
				ORDER BY a.create_time DESC LIMIT " .
            ($pindex - 1) * $psize . ',' . $psize;
    // echo $sql;exit;
    $list = pdo_fetchall($sql);
    // print_r($list);exit;
    $sql = "SELECT COUNT(*) FROM " . tablename('daojia_goods') . " as a " .
            " WHERE a.uniacid = '{$_W['uniacid']}' $condition ";
    $total = pdo_fetchcolumn($sql);
    $pager = pagination($total, $pindex, $psize);


    // get_cur_cate(4);

    include $this->template('goods');
}
?>