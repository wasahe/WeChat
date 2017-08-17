<?php
/**
 * 广告
 */
defined('IN_IA') or exit('Access Denied');
global $_W, $_GPC;
        $config = $this->get_config();
        $offices = $this->get_all_office();
        
        $where = empty($_GPC['cid']) ? '' : ' AND cid = ' . intval($_GPC['cid']);
        if (!empty($_GPC['cid'])) {
            $cid = intval($_GPC['cid']);
            $cname = pdo_fetchcolumn("SELECT `name` FROM " . tablename($this->category_table) . " WHERE id = " . $_GPC['cid'] . " LIMIT 1");
        } else {
            $cname = '';//'全部职位';
        }

        //****************************列表页****************************
        //薪资
        if (isset($_GPC['payroll'])) {
            $query_payroll = intval($_GPC['payroll']);
            $where .= ' AND payroll = ' . $query_payroll;
        }

        //类型->学历->city p_c_d
        if (isset($_GPC['positiontype'])) {
            //$query_positiontype = intval($_GPC['positiontype']);
            //$where .= ' AND educational = ' . $query_positiontype;
            list($sh_p, $sh_c, $sh_d) = explode('_', $_GPC['positiontype']);
            if ($sh_p) {
                if ($sh_d && 'null' != $sh_d) {
                    $sh_city_name = $sh_d;
                    $where .= " AND district = '$sh_d'";
                } else if ($sh_c && 'null' != $sh_c) {
                    $sh_city_name = $sh_c;
                    $where .= " AND city = '$sh_c'";
                } else if ($sh_p && 'null' != $sh_p) {
                    $sh_city_name = $sh_p;
                    $where .= " AND province = '$sh_city_name'";
                }                
            }
        } else {
            if ($this->getConfigArr('open_gps') == 'Y' && $_SESSION['weixin_get_fans_location'] && $_SESSION['weixin_get_fans_location'] != '未知') {
                list($sh_p, $sh_c, $sh_d,$addr) = explode(',', $_SESSION['weixin_get_fans_location']);
                if ($sh_p) {
                    if ($sh_d && 'null' != $sh_d) {
                        $sh_city_name = $sh_d;
                        $where .= " AND district = '$sh_d'";
                    } else if ($sh_c && 'null' != $sh_c) {
                        $sh_city_name = $sh_c;
                        $where .= " AND city = '$sh_c'";
                    } else if ($sh_p && 'null' != $sh_p) {
                        $sh_city_name = $sh_p;
                        $where .= " AND province = '$sh_city_name'";
                    }                
                }               
            }
            
        }
        
        //关键词搜索
        if (isset($_GPC['keyword'])) {
            $keyword = trim($_GPC['keyword']);
            $where .= ' AND (professional LIKE \'%' . $keyword . '%\' or workaddress LIKE \'%' . $keyword . '%\')';
        }
        
        $time = time();
        //置顶
        $top_lists = pdo_fetchall("SELECT * FROM " . tablename($this->person_table) . " WHERE weid = :weid $where AND istop = 1 AND outline=0 AND expiration > {$time} ORDER BY updatetime DESC", array(":weid" => $this->weid));
        foreach ($top_lists AS $key => $val) {
            if (!$val['headimgurl']) {
                $top_lists[$key]['headimgurl'] = $this->get_user_header_pic($val['from_user'], $val['sex']);
            } else {
                if (strstr($val['headimgurl'], 'http')) {
                    $top_lists[$key]['headimgurl'] = $val['headimgurl'];
                } else {
                    $top_lists[$key]['headimgurl'] = $this->get_rencai_pic($val['headimgurl']);;
                }
            }            
            $top_lists[$key]['dateline'] = date("Y-m-d", $val['dateline']);
            $top_lists[$key]['updatetime'] = date("Y-m-d", $val['updatetime']);
        }
        //普通
        $begin_rec = 0;
        $per_page_rec = 15;
        if ($_GPC['page']) {
            $where = $_SESSION['save_sql_where'];
            $begin_rec = $per_page_rec * ($_GPC['page']-1);
        } else {
            $_SESSION['save_sql_where'] = $where;
        }        
        $lists = pdo_fetchall("SELECT * FROM " . tablename($this->person_table) . " WHERE weid = :weid $where AND outline=0 AND istop = 0  ORDER BY updatetime DESC, views DESC limit $begin_rec,$per_page_rec", array(":weid" => $this->weid));
        foreach ($lists AS $key => $val) {
            if (!$val['headimgurl']) {
                $lists[$key]['headimgurl'] = $this->get_user_header_pic($val['from_user'], $val['sex']);
            } else {
                if (strstr($val['headimgurl'], 'http')) {
                    $lists[$key]['headimgurl'] = $val['headimgurl'];
                } else {
                    $lists[$key]['headimgurl'] = $this->get_rencai_pic($val['headimgurl']);
                }
                
            }
            $lists[$key]['dateline'] = date("Y-m-d", $val['dateline']);
            $lists[$key]['updatetime'] = date("Y-m-d", $val['updatetime']);
            
            $category = pdo_fetch("SELECT name FROM " . tablename($this->category_table) . " WHERE id = :id AND weid = :weid LIMIT 1", array(":id" => $val['cid'], ":weid" => $this->weid));
            $lists[$key]['cid_name'] = $category['name'];
        }
if ($_GPC['page']) {foreach ($lists as $person){?>
	    <div class="am-g" style="background-color:#FFF;margin-top:1px;" onclick="location.href='<?php echo $this->createMobileUrl('ShowResumeInfo', array('person_id' => $person['id']));?>';">
	        <div class="am-u-sm-3">
	            <img class="am-img-thumbnail am-radius" style="width:80px;height:80px" src="<?php echo $person['headimgurl'];?>"/>
	        </div>
	         <div class="am-u-sm-8">
	              <strong><?php echo  mb_substr($person['username'],0,1,'utf-8');?></strong>
	              <font size="1.2rem"><?php echo $person['sex'] == 1 ? '先生' : '女士';?></font>
                  <font size="1.2rem">更新于：<?php echo $person['updatetime'];?></font>

                  <?php if ($this->getFieldsShowFlag('person_age') || $this->getFieldsShowFlag('person_educational') || $this->getFieldsShowFlag('person_professional')){?>                
                  <p style="font-size:12px;margin:5px 0 5px 0">
                     <?php if ($this->getFieldsShowFlag('person_age')){ echo $person['age'] . '岁';}?>
                     <?php if ($this->getFieldsShowFlag('person_educational') && trim($config['educational'][$person['educational']])){ echo ' | '.$config['educational'][$person['educational']];}?>
                     <?php if ($this->getFieldsShowFlag('person_professional') && $person['professional']){ echo ' | '.$person['professional'];}?>
                     <?php if ($this->getFieldsShowFlag('cid') && $person['cid_name']) { echo ' | '.$person['cid_name'];}?>
                  </p> 
                  <?php }?>
                  
                  <?php if ($this->getFieldsShowFlag('person_workaddress')){?>                
                  <p style="font-size:12px;margin:5px 0 5px 0">
                  		<?php echo $this->getFieldsArr('person', 'person_workaddress');?>：<?php echo $person['workaddress'];?>&nbsp;&nbsp;
	              </p>
                  <?php }?>                                 
	         </div>         
	   </div>
<?php } } 
if ($_GPC['page']) {
    if (empty($lists)) {
        echo 'norec';
    }
    exit;
}
        $title = '求职频道';
        include $this->template('home_resume');

        
















