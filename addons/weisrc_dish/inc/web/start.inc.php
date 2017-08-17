<?php
global $_W, $_GPC;
$weid = $this->_weid;
$action = 'start';
$title = $this->actions_titles[$action];
load()->func('tpl');

$storeid = intval($_GPC['storeid']);
$this->checkStore($storeid);
$returnid = $this->checkPermission($storeid);
$cur_store = $this->getStoreById($storeid);
$GLOBALS['frames'] = $this->getNaveMenu($storeid, $action);

$operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if ($operation == 'display') {
    $zero_time = mktime(0, 0, 0);
//todayprice
    $today_order_price = pdo_fetchcolumn("SELECT sum(totalprice) FROM " . tablename($this->table_order) . " WHERE weid=:weid AND storeid=:storeid AND dateline>:time AND status=3 AND ispay=1 ", array(':weid' => $this->_weid, ':storeid' => $storeid, ':time' => $zero_time));
    $today_order_price = sprintf('%.2f', $today_order_price);

    $total_order_price = pdo_fetchcolumn("SELECT sum(totalprice) FROM " . tablename($this->table_order) . " WHERE weid=:weid
 AND storeid=:storeid AND status=3 AND ispay=1 ", array(':weid' => $this->_weid, ':storeid' => $storeid));

//ordercount
    $today_order_count = pdo_fetchcolumn("SELECT COUNT(1) FROM " . tablename($this->table_order) . " WHERE weid=:weid AND storeid=:storeid AND dateline>:time", array(':weid' => $this->_weid, ':storeid' => $storeid, ':time' => $zero_time));
    $total_order_count = pdo_fetchcolumn("SELECT COUNT(1) FROM " . tablename($this->table_order) . " WHERE weid=:weid AND storeid=:storeid", array(':weid' => $this->_weid, ':storeid' => $storeid));

//fans
    $today_fans_count = pdo_fetchcolumn("SELECT COUNT(1) FROM " . tablename($this->table_fans) . " WHERE weid=:weid AND lasttime>:time", array(':weid' => $this->_weid, ':time' => $zero_time));
    $total_fans_count = pdo_fetchcolumn("SELECT COUNT(1) FROM " . tablename($this->table_fans) . " WHERE weid=:weid ", array(':weid' => $this->_weid));
//online
    $online_totalprice = pdo_fetchcolumn("SELECT sum(totalprice) FROM " . tablename($this->table_order) . " WHERE weid = :weid AND storeid=:storeid AND ispay=1 AND
status=3 AND (paytype=2 OR paytype=1 OR paytype=4) ", array(':weid' => $weid, ':storeid' => $storeid));
    $online_todayprice = pdo_fetchcolumn("SELECT sum(totalprice) FROM " . tablename($this->table_order) . " WHERE weid = :weid AND storeid=:storeid AND ispay=1 AND
status=3 AND (paytype=2 OR paytype=1 OR paytype=4) AND dateline>:time", array(':weid' => $weid, ':storeid' => $storeid, ':time' => $zero_time));
    $online_todayprice = sprintf('%.2f', $online_todayprice);

//goods
    $total_goods_count = pdo_fetchcolumn("SELECT COUNT(1) FROM " . tablename($this->table_goods) . " WHERE weid=:weid AND storeid=:storeid", array(':weid' => $this->_weid, ':storeid' => $storeid));
//print
    $total_print_count = pdo_fetchcolumn("SELECT COUNT(1) FROM " . tablename($this->table_print_setting) . " WHERE weid=:weid AND storeid=:storeid", array(':weid' => $this->_weid, ':storeid' => $storeid));
//table
    $total_table_count = pdo_fetchcolumn("SELECT COUNT(1) FROM " . tablename($this->table_tables) . " WHERE weid=:weid AND storeid=:storeid", array(':weid' => $this->_weid, ':storeid' => $storeid));
//queue
    $total_queue_count = pdo_fetchcolumn("SELECT COUNT(1) FROM " . tablename($this->table_queue_setting) . " WHERE weid=:weid AND storeid=:storeid", array(':weid' => $this->_weid, ':storeid' => $storeid));

    $condition = " ";
    if (!empty($_GPC['time'])) {
        $starttime = strtotime($_GPC['time']['start']);
        $endtime = strtotime($_GPC['time']['end']) + 86399;
        $condition .= " AND dateline >= {$starttime} AND dateline <= {$endtime} ";
    }
    if (empty($starttime) || empty($endtime)) {
        $starttime = strtotime('-1 month');
        $endtime = TIMESTAMP;
    }

    $detail_total_order_price = pdo_fetchcolumn("SELECT sum(totalprice) FROM " . tablename($this->table_order) . " WHERE
weid=:weid
 AND storeid=:storeid AND status=3 AND ispay=1 $condition ", array(':weid' => $this->_weid, ':storeid' => $storeid));

    $detail_online_totalprice = pdo_fetchcolumn("SELECT sum(totalprice) FROM " . tablename($this->table_order) . " WHERE weid = :weid AND storeid=:storeid AND ispay=1 AND
status=3 AND (paytype=2 OR paytype=1 OR paytype=4) $condition ", array(':weid' => $weid, ':storeid' => $storeid));

//营业详情
    $data = pdo_fetchall('SELECT * FROM ' . tablename($this->table_order) . " WHERE weid = :weid AND storeid = :storeid AND status=3 AND ispay=1 $condition ORDER BY
dateline DESC", array(':weid' => $this->_weid, ':storeid' => $storeid));
    $total = array();
    if (!empty($data)) {
        foreach ($data as &$da) {
            $total_price = $da['totalprice'];
            $key = date('Y-m-d', $da['dateline']);
            $return[$key]['totalprice'] += $total_price;
            $return[$key]['count'] += 1;
            $total['total_price'] += $total_price;
            $total['total_count'] += 1;
            if ($da['paytype'] == '1' || $da['paytype'] == '2' || $da['paytype'] == '4') {
                $return[$key]['1'] += $total_price;
            } elseif ($da['paytype'] == '3' || $da['paytype'] == '0') {
                $return[$key]['2'] += $total_price;
            }
        }
    }
}
if ($operation == 'a') {
    if (!empty($_GPC['start'])) {
        $starttime = strtotime($_GPC['start']);
        $endtime = strtotime($_GPC['end']) + 86399;
    } else {
        $starttime = 0;
        $endtime = TIMESTAMP;
    }
    if ($_W['isajax'] && $_W['ispost']) {
        $datasets = array(
            '4' => array('name' => '支付宝支付', 'value' => 0),
            '2' => array('name' => '微信支付', 'value' => 0),
            '3' => array('name' => '现金支付', 'value' => 0),
            '1' => array('name' => '余额支付', 'value' => 0)
        );
        $data = pdo_fetchall("SELECT * FROM " . tablename($this->table_order) . 'WHERE weid = :weid AND storeid = :storeid and status = 3 and dateline
 >= :starttime and dateline <= :endtime', array(':weid' => $weid, ':storeid' => $storeid, ':starttime' => $starttime,
            'endtime' => $endtime));
        foreach ($data as $da) {
            if (in_array($da['paytype'], array_keys($datasets))) {
                $datasets[$da['paytype']]['value'] += 1;
            }
        }
        $datasets = array_values($datasets);
        message(error(0, $datasets), '', 'ajax');
    }
}
if ($operation == 'b') {

    if (!empty($_GPC['start'])) {
        $starttime = strtotime($_GPC['start']);
        $endtime = strtotime($_GPC['end']) + 86399;
        $condition .= " AND dateline > '{$starttime}' AND dateline < '{$endtime}'";
    } else {
        $starttime = strtotime('-30 day');
        $endtime = TIMESTAMP;
        $condition .= "";
    }
    $dn = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename($this->table_order) . " WHERE weid = '{$weid}' AND 
    storeid = '{$storeid}' AND dining_mode=1
$condition ");
    $wm = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename($this->table_order) . " WHERE weid = '{$weid}' AND
    storeid = '{$storeid}' AND
dining_mode=2
$condition ");
    $kc = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename($this->table_order) . " WHERE weid = '{$weid}' AND
    storeid = '{$storeid}' AND
dining_mode=4 $condition ");
    $yd = pdo_fetchcolumn('SELECT COUNT(1) FROM ' . tablename($this->table_order) . " WHERE weid = '{$weid}' AND
    storeid = '{$storeid}' AND dining_mode=3 $condition ");

    if ($_W['isajax'] && $_W['ispost']) {
        $datasets = array(
            'dn' => array('name' => '店内', 'value' => $dn),
            'wm' => array('name' => '外卖', 'value' => $wm),
            'kc' => array('name' => '快餐', 'value' => $kc),
            'yd' => array('name' => '预定', 'value' => $yd)
        );

        $datasets = array_values($datasets);
        message(error(0, $datasets), '', 'ajax');
    }
}

include $this->template('web/start');