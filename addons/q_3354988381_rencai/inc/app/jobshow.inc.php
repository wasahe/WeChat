<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        $config = $this->get_config();
        $job_id = intval($_GPC['job_id']);

        //职位信息
        $job = pdo_fetch("SELECT * FROM " . tablename($this->job_table) . " WHERE id = :id", array(":id" => $job_id));
        $job['dateline'] = date("Y-m-d", $job['dateline']);
        $is_has_welfare = empty($job['welfare']) ? false : true;    //是否有福利
        $job['welfare'] = explode(',', $job['welfare']);

        //对应公司信息
        $company = pdo_fetch("SELECT * FROM " . tablename($this->company_table) . " WHERE id = :mid", array(":mid" => $job['mid']));
        //取职位分类
        $category = pdo_fetch("SELECT name FROM " . tablename($this->category_table) . " WHERE id = :id AND weid = :weid LIMIT 1", array(":id" => $job['cid'], ":weid" => $this->weid));

        //取公司所属行业
        $industry = pdo_fetch("SELECT name FROM " . tablename($this->industry_table) . " WHERE id = :id AND weid = :weid LIMIT 1", array(":id" => $company['industry'], ":weid" => $this->weid));

        //更新浏览次数
        pdo_update($this->job_table, array('views' => $job['views'] + 1), array('id' => $job_id));

        //公司或个人id
        $uid = $this->get_member_id();
        //是否申请
        $isapply = $this->get_is_apply($uid, $job_id);

        //是否收藏
        $iscollect = $this->get_is_collect($uid, $job_id);

        //评论
        $comments = pdo_fetchall("SELECT * FROM " . tablename($this->jobs_comments_table) . " WHERE weid = :weid AND jobid = :jobid AND status = 1 ORDER BY dateline DESC LIMIT 2", array(":weid" => $this->weid, ":jobid" => $job_id));
        $tmp = array();
        foreach ($comments AS $key => $val) {
            array_unshift($tmp, $val['mid']);
            $comments[$key]['dateline'] = date("Y-m-d", $val['dateline']);
        }
        if (!empty($tmp)) {
            $persons = $this->get_person_info($tmp);
            foreach ($persons AS $key => $person) {
                if ($person['headimgurl']) {
                    if (!strstr($person['headimgurl'], 'http')) {
                        $persons[$key]['headimgurl'] = $this->get_rencai_pic($person['headimgurl']);
                    }                      
                } else {
                    $persons[$key]['headimgurl'] = $this->get_user_header_pic($person['from_user'], $person['sex']);
                }
            }
        }
        $company['description'] = htmlspecialchars_decode($company['description']);     
        $title = '职位详情';
        include $this->template('job_show');

        
















