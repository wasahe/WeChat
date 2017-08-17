<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;

        //您还未成为认证企业
        $company = pdo_fetch("SELECT `id`,`isauth`,`view_resume_nums`,`view_resume_total`, cant_resume FROM " . tablename($this->company_table) . " WHERE weid = :weid AND from_user = :from_user LIMIT 1", array(":weid" => $this->weid, ":from_user" => $this->from_user));
        if (!empty($company)) {
            if($company['isauth'] <= 0 || $company['cant_resume'] == 1){
                exit('-2');
            }
            if ($company['view_resume_nums'] >= $company['view_resume_total']) {
                exit('-5');
            }
        } else {
            exit('-3');
        }
        
        $person_id = intval($_GPC['person_id']);//被邀请的求职者
        $company_id = $company['id'];
        
        //是否已经邀请
        $invite = pdo_fetch("SELECT * FROM " . tablename('q_3354988381_rencai_invite_person') . " WHERE weid = :weid AND company_id = :company_id AND person_id = :person_id  LIMIT 1", 
                array(":weid" => $this->weid, ":company_id" => $company_id, ":person_id" => $person_id));
        if ($invite) {
            if ($this->getConfigArr('invites_per_member') <= $invite['invite_count']) {
                exit('-4'); //'邀请次数已用完';
            } else {
                pdo_update('q_3354988381_rencai_invite_person', array('invite_count' => $invite['invite_count']+1), array('id' => $invite['id']));
                //给求职者发通知-有公司邀请面试了
                $res = $this->send_notify_api('tpl_company', $person_id, $company_id);         
                exit('1');                
            }           
            //exit('-1');
        }            

        $data = array(
            'weid' => $this->weid,
            'company_id' => $company_id,
            'person_id' => $person_id,
            'dateline' => time()
        );
        if (pdo_insert('q_3354988381_rencai_invite_person', $data)) {
            //给求职者发通知-有公司邀请面试了
            $res = $this->send_notify_api('tpl_company', $person_id, $company_id);         
            exit('1');
        } else {
            exit('0');
        }

        
















