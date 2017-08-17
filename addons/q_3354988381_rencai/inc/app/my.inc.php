<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
        global $_W, $_GPC;
        //是否关注
        $oauth_openid = "Q_3354988381_Rencai_" . $_W['uniacid'];
        if (empty($this->from_user) && empty($_COOKIE[$oauth_openid])) {
            $this->doMobileGetCode('my');
        }
        
        if (!$this->exist_openid($this->from_user)) {
            $this->doMobileGetCode('my');
        }
           
        $this->getFollow();
        
        //检查是个人:2,还是企业:1
        $type = pdo_fetchcolumn("SELECT `type` FROM " . tablename($this->member_table) . " WHERE weid = :weid AND from_user = :from_user AND status = 1 LIMIT 1", array(":weid" => $this->weid, ":from_user" => $this->from_user));
        if (false == $type) {
            $this->doMobilePublicIndex();
        } else {
            if ($type == 1) {
                $_SESSION['curr_user_type'] = 'C';
                $this->doMobileMyCompanyIndex();
            } else {
                $_SESSION['curr_user_type'] = 'P';
                $this->doMobileMyPersonIndex();
            }
        }

        
















