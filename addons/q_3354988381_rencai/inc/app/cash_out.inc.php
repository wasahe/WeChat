<?php
/**
 * 我的钱包
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
$type = $_SESSION['curr_user_type'];

$show = $_GPC['show'];
if ($show == 'income') {//todo
    $title = '提现记录';
    $pindex = max(1, intval($_GPC['page']));
    $psize = 15;      

    $weid = $this->weid;
    $condition = "and weid= '$weid' and from_user='".$this->from_user."' and type='$type'";
    $sql = "SELECT * FROM " . tablename('q_3354988381_rencai_tixian') . " WHERE 1 $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize; 
    $list = pdo_fetchall($sql);

    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('q_3354988381_rencai_tixian') . " WHERE 1 $condition");

    $pager = pagination($total, $pindex, $psize);
    $pageend = ceil($total / $psize);
    if ($total / $psize != 0 && $total >= $psize) {
        $pageend++;
    }
    //page todo
    
} elseif ($show == 'award') {//todo
    $title = '邀请奖励';
    
    $pindex = max(1, intval($_GPC['page']));
    $psize = 15;      

    $weid = $this->weid;  
    
    if ($type == 'C') {
        $award_name = '邀请奖励';
        $condition = "and weid= '$weid' and inviter='".$_SESSION['curr_person_id']."' and type='$type'";
        $sql = "SELECT * FROM " . tablename('q_3354988381_rencai_invite_award') . " WHERE 1 $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize; 
        $list = pdo_fetchall($sql);
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('q_3354988381_rencai_invite_award') . " WHERE 1 $condition");          
    } else {
        $award_name = '简历收益';
        $condition = "and weid= '$weid' and person_id='".$_SESSION['curr_person_id']."'";
        $sql = "SELECT award_of_send_resume as award_price, createat as create_at, 'S' as finish_flag FROM " . tablename('q_3354988381_rencai_company_lookresume') . " WHERE 1 $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize; 
        $list = pdo_fetchall($sql);
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('q_3354988381_rencai_company_lookresume') . " WHERE 1 $condition");  
        
        $condition = "and weid= '$weid' and type='P' and inviter='".$_SESSION['curr_person_id']."'";
        $sql = "SELECT award_price, create_at, 'S' as finish_flag FROM " . tablename('q_3354988381_rencai_invite_award') . " WHERE 1 $condition ORDER BY id DESC"; 
        $list = array_merge($list, pdo_fetchall($sql));        
    }
            


    $pager = pagination($total, $pindex, $psize);
    $pageend = ceil($total / $psize);
    if ($total / $psize != 0 && $total >= $psize) {
        $pageend++;
    }
    //page todo
    
} elseif ($show == 'outcome') {
    $title = '我的支出';
    if ($type == 'C') {
        $pindex = max(1, intval($_GPC['page']));
        $psize = 15;      

        $weid = $this->weid;
        $company_money = $this->get_table_row('q_3354988381_rencai_company', $this->from_user, 'from_user');
        $condition = "and weid= '$weid' and company_id='".$company_money['id']."'";
        $sql = "SELECT * FROM " . tablename('q_3354988381_rencai_company_lookresume') . " WHERE 1 $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize; 
        $list = pdo_fetchall($sql);

        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('q_3354988381_rencai_company_lookresume') . " WHERE 1 $condition");

        $pager = pagination($total, $pindex, $psize);
        $pageend = ceil($total / $psize);
        if ($total / $psize != 0 && $total >= $psize) {
            $pageend++;
        }
        //page todo        
    }
} elseif ($show == 'charge') {
    $title = '充值记录';
    if ($type == 'C') {
        $pindex = max(1, intval($_GPC['page']));
        $psize = 15;      

        $weid = $this->weid;
        $company_money = $this->get_table_row('q_3354988381_rencai_company', $this->from_user, 'from_user');
        $condition = "and weid= '$weid' and company_id='".$company_money['id']."'";
        $sql = "SELECT * FROM " . tablename('q_3354988381_rencai_recharge') . " WHERE 1 $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize; 
        $list = pdo_fetchall($sql);

        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('q_3354988381_rencai_recharge') . " WHERE 1 $condition");

        $pager = pagination($total, $pindex, $psize);
        $pageend = ceil($total / $psize);
        if ($total / $psize != 0 && $total >= $psize) {
            $pageend++;
        }
        //page todo        
    }    
} else {
    $title = '申请提现';
    $can_tixian = $this->get_can_tixian_credits();
    $can_tixian_money = $can_tixian['to_money'];
    $have_tixian_moneys = $can_tixian['have_tixian_moneys'];       
}
include $this->template('cash_out');    
        

        
















