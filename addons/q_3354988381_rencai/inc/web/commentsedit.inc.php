<?php
/**
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;

    if ('chg_status' == $_GPC['op']) {
        $comment_id = $_GPC['comment_id'];
        $status = $_GPC['change_to'];

        $data = array('status' => intval($status));
        $filter = array('id' => intval($comment_id), 'weid' => $this->weid);
        if (false !== pdo_update($this->jobs_comments_table, $data, $filter)) {
            exit('1');
        } else {
            exit('0');
        }               
    }
    if ('del_comment' == $_GPC['op']) {
        $id = intval($_GPC['comment_id']);
        if (pdo_delete($this->jobs_comments_table, array('id' => $id))) {
            exit('1');
        } else {
            exit('0');
        }         
    }
    








