<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        $config = $this->get_config();
        $offices = $this->get_all_office();
        
        //职位
        $where = empty($_GPC['cid']) ? '' : ' AND job.cid = ' . intval($_GPC['cid']);
        if (!empty($_GPC['cid'])) {
            $cid = intval($_GPC['cid']);
            $cname = pdo_fetchcolumn("SELECT `name` FROM " . tablename($this->category_table) . " WHERE id = " . $_GPC['cid'] . " LIMIT 1");
        } else {
            $cname = '';//'全部职位';
        }
        
        //查询条件
        //*****************************搜索框****************************
        //关键词搜索
        if (isset($_GPC['keyword'])) {
            $keyword = trim($_GPC['keyword']);
            $where .= ' AND job.title LIKE \'%' . $keyword . '%\'';
        }
        if ($_GPC['positiontype_id']) {//主题2首页链接过来的
            $where .= ' AND positiontype = ' . intval($_GPC['positiontype_id']);
        }
        //****************************列表页****************************
        //薪资
        if (isset($_GPC['payroll'])) {
            $query_payroll = intval($_GPC['payroll']);
            $where .= ' AND job.payroll = ' . $query_payroll;
        }

        //todo 主题为2种时的链接过来的处理
        //求职类型->city p_c_d
        if (isset($_GPC['positiontype'])) {
            //$query_positiontype = intval($_GPC['positiontype']);
            //$where .= ' AND positiontype = ' . $query_positiontype;
            list($sh_p, $sh_c, $sh_d) = explode('_', $_GPC['positiontype']);
            if ($sh_p) {
                if ($sh_d && 'null' != $sh_d) {
                    $sh_city_name = $sh_d;
                    $where .= " AND company.district = '$sh_d'";
                } else if ($sh_c && 'null' != $sh_c) {
                    $sh_city_name = $sh_c;
                    $where .= " AND company.city = '$sh_c'";
                } else if ($sh_p && 'null' != $sh_p) {
                    $sh_city_name = $sh_p;
                    $where .= " AND company.province = '$sh_city_name'";
                }                
            }            
        } else {
            if ($this->getConfigArr('open_gps') == 'Y' && $_SESSION['weixin_get_fans_location'] && $_SESSION['weixin_get_fans_location'] != '未知') {
                list($sh_p, $sh_c, $sh_d, $addr) = explode(',', $_SESSION['weixin_get_fans_location']);
                if ($sh_p) {
                    if ($sh_d && 'null' != $sh_d) {
                        $sh_city_name = $sh_d;
                        $where .= " AND company.district = '$sh_d'";
                    } else if ($sh_c && 'null' != $sh_c) {
                        $sh_city_name = $sh_c;
                        $where .= " AND company.city = '$sh_c'";
                    } else if ($sh_p && 'null' != $sh_p) {
                        $sh_city_name = $sh_p;
                        $where .= " AND company.province = '$sh_city_name'";
                    }                
                }                
            }
            
        }
        //**************************************************************
        //取所有栏目下职位信息，左查询
//		$job_lists = pdo_fetchall("SELECT j.id AS job_id, j.title AS job_title, c.name AS company_name, c.isauth AS company_isauth, j.payroll AS job_payroll FROM ".tablename($this->job_table)." AS j LEFT JOIN ".tablename($this->company_table)." AS c ON j.mid = c.id WHERE j.weid = c.weid AND c.weid = :weid AND c.status = 1 AND j.cid IN (:cids) ".$where, array(":weid" => $this->weid, ":cids" => $cids));
        $begin_rec = 0;
        $per_page_rec = 15;
        if ($_GPC['page']) {
            $where = $_SESSION['save_sql_where'];
            $begin_rec = $per_page_rec * ($_GPC['page']-1);
        } else {
            $_SESSION['save_sql_where'] = $where;
        }
        $job_lists = pdo_fetchall("SELECT job.* "
                . "FROM " . tablename($this->job_table) . " job "
                . "LEFT JOIN " . tablename($this->company_table) . " company ON job.mid=company.id "
                . "WHERE job.weid = :weid $where and status>=0 ORDER BY job.updatetime DESC, job.id DESC limit $begin_rec , $per_page_rec", array(":weid" => $this->weid));
        if (!empty($job_lists)) {
            $companyids = array();
            foreach ($job_lists AS $key => $val) {
                array_unshift($companyids, $val['mid']);
                $job_lists[$key]['welfare'] = explode(',', $val['welfare']);
            }
           
            $companyids = implode(',', array_unique($companyids));
            if (!$companyids) {
                $companyids = -1;
            }
            $tmp = pdo_fetchall("SELECT `id`,`name`,`isauth` FROM " . tablename($this->company_table) . " WHERE id IN (" . $companyids . ")");
            $companys = array();
            foreach ($tmp AS $key => $val) {
                $companys[$val['id']] = $val;
            }
            unset($tmp);     
            
if ($_GPC['page']) {foreach ($job_lists as $job){?>
    <li class="am-g am-list-item-desced" style="padding-left: 1rem">
            <a href="<?php echo $this->createMobileUrl('JobShow', array('job_id' => $job['id']));?>" class="am-list-item-hd ">
                <?php echo $job['title'];?>&nbsp;<font color="red"><?php echo $config['payroll'][$job['payroll']];?></font>
            </a>
            <div class="am-list-item-text" style="font-size: 1.4rem">
                <?php echo $companys[$job['mid']]['name'];?>
                <?php if ($companys[$job['mid']]['isauth'] == 0){?>
                <span class="am-badge am-badge-default">未认证</span>
                <?php } else {?>
                <span class="am-badge am-badge-success">已认证</span>
                <?php }?>
            </div>
            <?php if ($job['welfare']){?>
            <div class="am-list-item-text" style="max-height: 8.4rem;padding-bottom:0.2rem">
                <?php foreach($job['welfare'] as $key => $welfare) {?>
                <span type="button" class="am-btn am-btn-default am-btn-xs am-radius" style="background-color: #FFF;padding: 0.4rem;margin: 2px"><?php echo $config['welfare'][$welfare];?></span>
                <?php }?>
            </div>
            <?php } ?>
            <div class="am-list-item-text" style="font-size: 1rem">
                &nbsp;&nbsp;最后更新：<?php echo date('Y-m-d H:i', $job['updatetime']=='0000-00-00 00:00:00'?$job['dateline']:strtotime($job['updatetime']));?>
                &nbsp;&nbsp;<span style="color:#ff0000;"><?php echo $job['views'];?></span>人浏览
            </div>          
    </li>
<?php } }            
        }
if ($_GPC['page']) {
    if (empty($job_lists)) {
        echo 'norec';
    }
    exit;
}         
        $title = '招聘频道';
        include $this->template('job_list');

        
















