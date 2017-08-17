<?php

global $_GPC, $_W;
load()->func('tpl');

$member = get_member_info();
$uid = $member['uid'];
$is_vip = is_vip($member['groupid'], $this->module['config']); //判断是否为vip用户
//读取banner的数据：
$sql = "select * from " . tablename("daojia_banner") . " where uniacid = '{$_W['uniacid']}' and  status = 1 order by orderby desc,id asc";
$banner = pdo_fetchall($sql);

//读取分类的数据：
$sql = "select * from " . tablename("daojia_goods_cate") . " where uniacid = '{$_W['uniacid']}' and  parent_id = 0 order by orderby desc";
$cates = pdo_fetchall($sql);

$is_ajax = $_GPC['is_ajax'];

//读取项目的数据：
$pindex = max(1, intval($_GPC['page']));
$psize = 8;
$where = '';
//预留分类的筛选器：
$cate_id = (int) $_GPC['cate_id'];//一级id
$cate_id_cur = $cate_id;
// echo $cate_id;exit;
if ($cate_id) {
    $sql = "select * from " . tablename('daojia_goods_cate') ." where uniacid = '{$_W['uniacid']}' and id = '{$cate_id}' ";
    $cur_cate = pdo_fetch($sql);
    if ($cur_cate['parent_id']) {
        //二级目录：
        $cate_id = $cur_cate['parent_id'];
        $sub_cate_id = $cur_cate['id'];
    } else {
        //一级目录：
        $cate_id = $cur_cate['id'];
        //$sub_cate_id = $cur_cate['id'];
    }

    //读取下级的分类：
    $cate_arr = array();
    $cate_arr[] = $cate_id;
    
    $sql = "select * from " . tablename('daojia_goods_cate') . " where uniacid = '{$_W['uniacid']}' and parent_id = '{$cate_id}' ";
    $sub_cates = pdo_fetchall($sql);
    $sub_cates_html = '';//二级分类
    if ($sub_cates) {
        $cate_arr1 = array();
        $sub_cur = 0;
        foreach ($sub_cates as $k => $c) {
            if (!$c) {
                continue;
            }
            $cate_arr1[] = $c['id'];

            $cate_url = $this->createMobileUrl('index', array('cate_id' => $c[id]));
            $cur = '';
            if ($c[id] == $sub_cate_id) {
                $cur = 'class="cur"';
                $cate_arr[] = $c['id'];
                $sub_cur = 1;
            }
            $sub_cates_html .= "<li {$cur} style='height: auto;'><a href='{$cate_url}' style='line-height: 2;'>{$c['title']}</a></li>";
            $parent_cate_id = $c['parent_id'];
        }
        if (!$sub_cur) {
            // print_r($cate_arr1);exit;
            $cate_arr = array_merge($cate_arr, $cate_arr1);
        }
    } else {
        
    }

    
    if ($cate_arr) {
        $cate_arr = join(',', $cate_arr);
        $where .= " and cate_id IN ({$cate_arr}) ";
    }
}

$sql = "select * from " . tablename("daojia_goods") . " where uniacid = '{$_W['uniacid']}' {$where} and  status = 1 order by id desc LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
$goods = pdo_fetchall($sql);
$goods_size = sizeof($goods);
$sql = "select count(*) from " . tablename("daojia_goods") . " where uniacid = '{$_W['uniacid']}' {$where} and  status = 1 ";
$goods_total = pdo_fetchcolumn($sql);


if ($is_ajax) {
    $return = array();
    $item = '';
    //组合html：
    if (is_array($goods)) {
        foreach ($goods as $key => $good) {
            $goods_url = $this->createMobileUrl('goods', array('id' => $good['id']));
            $goods_photo_url = $_W['attachurl'] . $good['photo'];

            if ($is_vip && $good['member_price'] > 0) {
                $price_html = "<i>￥</i>{$good['member_price']}<span class='vip_span' style='text-decoration: none;'>/vip</span>&nbsp;<span>原价:{$good['price']}</span>";
            } else {
                $price_html = "<i>￥</i>{$good['price']}<span>原价:{$good['market_price']}</span>";
            }
            $html = <<<EOD
<div class="item ">
	<a rel="{$goods_url}">
		<dl>
			<dt>
				<img src="{$goods_photo_url}" alt="{$good['title']}">
			</dt>
			<dd>
				<h3>{$good['title']}</h3>
				<p class="effects {php echo $good[titledesc] ? $good[titledesc] : 'hide';}" >{$good[titledesc]}</p>
				<p class="duration">
					<i></i>{$good['shijian']}分钟
					<cite class="">到店</cite>
					<cite class="online " >上门</cite>
				</p>
				<p class="price">
					{$price_html}
				</p>
			</dd>
			<dd></dd>
		</dl>
	</a>
</div>
EOD;
            $item .= trim($html);
            // echo $html;exit;
        }
    }

    $return['item'] = $item;
    $return['total'] = $goods_total;
    if ($goods_size > 0) {
        $return['page'] = 1;
    } else {
        $return['page'] = 0;
    }
    echo json_encode($return);
    exit;
}


include $this->template('index');
?>