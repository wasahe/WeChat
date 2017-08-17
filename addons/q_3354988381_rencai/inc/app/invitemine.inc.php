<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
$person_id = $_SESSION['curr_person_id'] ? $_SESSION['curr_person_id'] : intval($_GPC['person_id']);

if ($_GPC['inviteid']) {//ajax
    $inviteid = $_GPC['inviteid'];
    $val = $_GPC['val'];
    $comany_name = $_GPC['comany_name'];
    
    $res = array('error' => 0, 'msg' => '您已同意'.$comany_name.'企业购买简历的邀请，请在24小时内与企业取得联系！');
    $invites = pdo_fetch("SELECT comany.from_user, person.username, comany.id as comany_id "
            . "FROM " . tablename('q_3354988381_rencai_company_lookresume') . " rsm "
            . "LEFT JOIN " . tablename('q_3354988381_rencai_company') . " comany ON rsm.company_id=comany.id "
            . "LEFT JOIN " . tablename('q_3354988381_rencai_person') . " person ON rsm.person_id=person.id "
            . "where rsm.id='$inviteid'");      
    if ($val == 'Y') {/*
        if (!$this->company_paid_money('look_resume', 0,0, $inviteid)) {
            $res = array('error' => 1, 'msg' => '企业余额不足');
            echo json_encode($res);
            exit;            
        }   */    
        
        $info_con = array('title' => '申请批准通知',
                     'description' => $invites['username'] . '已经接受了您的查看简历请求！',
                     'url' => $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=q_3354988381_rencai&do=viewsumelist&companyid=" . $invites['comany_id'],
             );                             
        $res_tpl = $this->send_notify_other_api($invites['from_user'], $info_con, 'I');           
    } else {   
        $info_con = array('title' => '申请拒绝通知',
                     'description' => $invites['username'] . '已经拒绝了您的查看简历请求！',
                     'url' => $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=q_3354988381_rencai&do=resume&companyid=" . $invites['comany_id'],
             );                             
        $res_tpl = $this->send_notify_other_api($invites['from_user'], $info_con, 'I');           
    }
    
    $sql = "update " . tablename('q_3354988381_rencai_company_lookresume') . " set person_agree='$val' where id='$inviteid' and weid=" . $this->weid;
    if ($person_id) {
        $sql .= " and person_id='$person_id'";
    }
    pdo_query($sql);
    echo json_encode($res);
    exit;
}
        //所有收藏
        $invites = pdo_fetchall("SELECT rsm.*, comany.name as comany_name "
                . "FROM " . tablename('q_3354988381_rencai_company_lookresume') . " rsm "
                . "LEFT JOIN " . tablename('q_3354988381_rencai_company') . " comany ON rsm.company_id=comany.id "
                . "WHERE rsm.weid = :weid AND rsm.person_id = :person_id order by rsm.id desc ", array(":weid" => $this->weid, ":person_id" => $person_id));

        
$title = '邀请我的企业';
include $this->template('invite_mine');

        
















