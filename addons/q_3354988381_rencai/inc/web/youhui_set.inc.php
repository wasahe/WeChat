<?php
/**
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;

$profile_row = pdo_fetch("SELECT * FROM " . tablename('q_3354988381_rencai_profile') . " WHERE `key`='youhuiset_open' and weid=" . $this->weid);
if (!$profile_row) {
    pdo_insert('q_3354988381_rencai_profile', array('weid' => $this->weid, 'key' => 'youhuiset_open', 'val' => 'Y'));
} else {
    $youhuiset_open = $profile_row['val'];
}

$condition = " dtl.weid=".$this->weid;     
$sql = "SELECT dtl.* ". "FROM " . tablename('q_3354988381_rencai_youhuiset') . " dtl ". "WHERE $condition ORDER BY dtl.id ASC "; 
$list = pdo_fetchall($sql);

        if (checksubmit()) {
            $youhuiset_open = $_GPC['youhuiset_open'];  
            pdo_update('q_3354988381_rencai_profile', array('val' => $youhuiset_open), array('key' => 'youhuiset_open', 'weid' => $this->weid));
                    
            foreach ($list as $key => $data) {
                $_addmoney = $_GPC[$data['id'] . '_addmoney'];
                $_givemoney = $_GPC[$data['id'] . '_givemoney'];
                if ($_addmoney) {
                    pdo_update('q_3354988381_rencai_youhuiset', array('addmoney' => $_addmoney, 'givemoney' => $_givemoney), array('id' => $data['id']));
                } else {
                    pdo_delete('q_3354988381_rencai_youhuiset', array('id' => $data['id']));
                }
            }

            $_addmoney = $_GPC['new_addmoney'];
            $_givemoney = $_GPC['new_givemoney'];
            if ($_addmoney) {
                pdo_insert('q_3354988381_rencai_youhuiset', array('weid' => $this->weid, 'addmoney' => $_addmoney, 'givemoney' => $_givemoney));
            }          

            $curr_index_url = $this->createWebUrl('youhui_set');
            message('更新成功！', $curr_index_url, 'success');                
        }
        

include $this->template('youhui_set');








