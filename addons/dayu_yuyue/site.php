<?php
/**
 * 悟空源码网 www.5kym.com出品
 *
 */
include 'plugin/yunzhixun.php';
defined('IN_IA') or exit('Access Denied');
class dayu_yuyueModuleSite extends WeModuleSite
{
    public function getHomeTitles()
    {
        global $_W;
        $urls = array();
        $list = pdo_fetchall("SELECT title, reid FROM " . tablename('dayu_yuyue') . " WHERE weid = '{$_W['uniacid']}'");
        if (!empty($list)) {
            foreach ($list as $row) {
                $urls[] = array(
                    'title' => $row['title'],
                    'url' => $this->createMobileUrl('dayu_yuyue', array(
                        'id' => $row['reid']
                    ))
                );
            }
        }
        return $urls;
    }
    public function doWebQuery()
    {
        global $_W, $_GPC;
        $kwd              = $_GPC['keyword'];
        $sql              = 'SELECT * FROM ' . tablename('dayu_yuyue') . ' WHERE `weid`=:weid AND `title` LIKE :title ORDER BY reid DESC LIMIT 0,8';
        $params           = array();
        $params[':weid']  = $_W['uniacid'];
        $params[':title'] = "%{$kwd}%";
        $ds               = pdo_fetchall($sql, $params);
        foreach ($ds as &$row) {
            $r                = array();
            $r['title']       = $row['title'];
            $r['description'] = cutstr(strip_tags($row['description']), 50);
            $r['thumb']       = $row['thumb'];
            $r['reid']        = $row['reid'];
            $row['entry']     = $r;
        }
        include $this->template('query');
    }
    public function doWebDetail()
    {
        global $_W, $_GPC;
        $rerid            = intval($_GPC['id']);
        $sql              = 'SELECT * FROM ' . tablename('dayu_yuyue_record') . " WHERE `id`=:rerid";
        $params           = array();
        $params[':rerid'] = $rerid;
        $row              = pdo_fetch($sql, $params);
        if (empty($row)) {
            message('访问非法.');
        }
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue') . ' WHERE `weid`=:weid AND `reid`=:reid';
        $params          = array();
        $params[':weid'] = $_W['uniacid'];
        $params[':reid'] = $row['yid'];
        $activity        = pdo_fetch($sql, $params);
        if (empty($activity)) {
            message('非法访问.');
        }
        $userinfo = $this->get_userinfo($row['weid'], $row['openid']);
        $yyfsfy   = $row['yyfs'] == 0 ? '店面预约' : '上门服务';
        $beizhufy = $row['beizhu'] == '' ? '无备注信息' : $row['beizhu'];
        if (empty($row['oid'])) {
            $outletfy['title'] = '上门服务';
        } else {
            $outletfy = $this->getoutletinfo($row['oid']);
        }
        $jsinfo              = $this->getjsinfo($row['jsid']);
        $yyxmfy              = $this->getxminfo($row['xmid']);
        $cardinfo            = $this->getcardinfo($row['weid'], $row['openid']);
        $record              = array();
        $record['status']    = intval($_GPC['status']);
        $record['yyendtime'] = strtotime($_GPC['yyendtime']);
        if ($_W['ispost']) {
            pdo_update('dayu_yuyue_record', $record, array(
                'id' => $rerid
            ));
            message('修改成功', referer(), 'success');
        }
        include $this->template('detail');
    }
    public function doWebManage()
    {
        global $_W, $_GPC;
        $reid            = intval($_GPC['id']);
        $type            = $_GPC["type"];
        $keyword         = $_GPC["keyword"];
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue') . ' WHERE `weid`=:weid AND `reid`=:reid';
        $params          = array();
        $params[':weid'] = $_W['uniacid'];
        $params[':reid'] = $reid;
        $activity        = pdo_fetch($sql, $params);
        if (empty($activity)) {
            message('非法访问.');
        }
        $where = "WHERE yid='{$reid}'";
        switch ($type) {
            case 'cardno':
                $where .= " and cardno = '" . $keyword . "' ";
                break;
            case 'member':
                $user = pdo_fetchall(" SELECT openid FROM " . tablename("dayu_yuyue_record") . " where member like '%" . $keyword . "%' and weid=" . $_W['uniacid']);
                $arr  = array();
                foreach ($user as $key => $value) {
                    $arr[] = "'" . $value['openid'] . "'";
                }
                if (!empty($user)) {
                    $userstr = implode(',', $arr);
                    $where .= " and openid in (" . $userstr . ") ";
                }
                break;
            case 'mobile':
                $user = pdo_fetchall(" SELECT openid FROM " . tablename("dayu_yuyue_record") . " where mobile like '%" . $keyword . "%' and weid=" . $_W['uniacid']);
                $arr  = array();
                foreach ($user as $key => $value) {
                    $arr[] = "'" . $value['openid'] . "'";
                }
                if (!empty($user)) {
                    $userstr = implode(',', $arr);
                    $where .= " and openid in (" . $userstr . ") ";
                }
                break;
        }
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue_setting') . ' WHERE `weid`=:weid';
        $params          = array();
        $params[':weid'] = $_W['uniacid'];
        $setting         = pdo_fetch($sql, $params);
        $zhicheng        = $setting['zhicheng'];
        $starttime       = empty($_GPC['start']) ? strtotime('-1 month') : strtotime($_GPC['start']);
        $endtime         = empty($_GPC['end']) ? TIMESTAMP : strtotime($_GPC['end']) + 86399;
        $where .= " and createtime > {$starttime} and createtime < {$endtime}";
        $pindex = max(1, intval($_GPC['page']));
        $psize  = 15;
        $sql    = 'SELECT * FROM ' . tablename('dayu_yuyue_record') . " {$where} ORDER BY `createtime` DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
        $total  = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('dayu_yuyue_record') . " {$where}");
        $pager  = pagination($total, $pindex, $psize);
        $list   = pdo_fetchall($sql, $params);
        include $this->template('manage');
    }
    public function doWebCardExcel()
    {
        global $_GPC, $_W;
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue_setting') . ' WHERE `weid`=:weid';
        $params          = array();
        $params[':weid'] = $_W['uniacid'];
        $setting         = pdo_fetch($sql, $params);
        $zhicheng        = $setting['zhicheng'];
        $cardlist        = pdo_fetchall("select * from " . tablename('dayu_yuyue_record') . " where weid =:weid and yid =:yid ", array(
            ':weid' => $_W['uniacid'],
            ':yid' => $_GPC['yid']
        ));
        $filename        = '预约' . date('YmdHis') . '.csv';
        $exceler         = new Jason_Excel_Export();
        $exceler->charset('UTF-8');
        $exceler->setFileName($filename);
        $excel_title = array(
            '姓名',
            '电话',
            '预约方式',
            '门店名称',
            $zhicheng,
            '预约项目',
            '预约时间段',
            '提交时间'
        );
        $exceler->setTitle($excel_title);
        $excel_data = array();
        foreach ($cardlist as $row) {
            $outletfy     = $this->getoutletinfo($row['oid']);
            $yyxmfy       = $this->getxminfo($row['xmid']);
            $jsinfo       = $this->getjsinfo($row['jsid']);
            $username     = $row['member'];
            $tel          = $row['mobile'];
            $yyfs         = $row['yyfs'] == 0 ? '门店预约' : '上门服务';
            $outlet       = $outletfy['title'];
            $js           = $jsinfo['name'];
            $yyxm         = $yyxmfy['title'];
            $timerang     = date('Y-m-d H:i:s', $row['yystarttime']) . "至" . date('Y-m-d H:i:s', $row['yyendtime']);
            $createtime   = date('Y-m-d H:i:s', $row['createtime']);
            $excel_data[] = array(
                $username,
                $tel,
                $yyfs,
                $outlet,
                $js,
                $yyxm,
                $timerang,
                $createtime
            );
        }
        $exceler->setContent($excel_data);
        $exceler->export();
    }
    public function doWebDisplay()
    {
        global $_W, $_GPC;
        if ($_W['ispost']) {
            $reid              = intval($_GPC['reid']);
            $switch            = intval($_GPC['switch']);
            $sql               = 'UPDATE ' . tablename('dayu_yuyue') . ' SET `status`=:status WHERE `reid`=:reid';
            $params            = array();
            $params[':status'] = $switch;
            $params[':reid']   = $reid;
            pdo_query($sql, $params);
            exit();
        }
        $sql = 'SELECT * FROM ' . tablename('dayu_yuyue') . ' WHERE `weid`=:weid';
        $ds  = pdo_fetchall($sql, array(
            ':weid' => $_W['uniacid']
        ));
        foreach ($ds as &$item) {
            $item['isstart'] = $item['starttime'] > 0;
            $item['switch']  = $item['status'];
            $item['link']    = $this->createMobileUrl('dayu_yuyue', array(
                'id' => $item['reid']
            ));
        }
        include $this->template('display');
    }
    public function doWebyyxmpost()
    {
        global $_W, $_GPC;
        $xmid = intval($_GPC['id']);
        $weid = $_W['uniacid'];
        if (checksubmit()) {
            $xmrecord                 = array();
            $xmrecord['title']        = trim($_GPC['activity']);
            $xmrecord['weid']         = $_W['uniacid'];
            $xmrecord['isshow']       = $_GPC['isshow'];
            $xmrecord['displayorder'] = $_GPC['displayorder'];
            if (empty($xmid)) {
                pdo_insert('dayu_yuyue_xiangmu', $xmrecord);
                $xmid = pdo_insertid();
                if (!$xmid) {
                    message('保存预约项目失败, 请稍后重试.');
                }
            } else {
                if (pdo_update('dayu_yuyue_xiangmu', $xmrecord, array(
                    'id' => $xmid
                )) === false) {
                    message('保存预约项目失败, 请稍后重试.');
                }
            }
            message('保存预约项目成功.', 'refresh');
        }
        if ($xmid) {
            $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue_xiangmu') . ' WHERE `weid`=:weid AND `id`=:xmid';
            $params          = array();
            $params[':weid'] = $_W['uniacid'];
            $params[':xmid'] = $xmid;
            $xmactivity      = pdo_fetch($sql, $params);
        }
        include $this->template('yyxmpost');
    }
    public function doWebstorepost()
    {
        global $_GPC, $_W;
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue_setting') . ' WHERE `weid`=:weid';
        $params          = array();
        $params[':weid'] = $_W['uniacid'];
        $setting         = pdo_fetch($sql, $params);
        if ($setting['instore'] == '1') {
            message('您选择了『微商户』作为门店，内置门店功能已关闭！请在 参数设置-主要参数中 切换。', '', 'error');
        }
        if (empty($_GPC['do'])) {
            $_GPC['do'] = 'post';
        }
        $id = intval($_GPC['id']);
        if (!empty($id)) {
            $item = pdo_fetch("SELECT * FROM " . tablename('dayu_yuyue_store') . " WHERE id = :id", array(
                ':id' => $id
            ));
            if (empty($item)) {
                message('抱歉，门店不存在或是已经删除！', '', 'error');
            }
        }
        if (checksubmit('submit')) {
            if (empty($_GPC['name'])) {
                message('请输入门店名称！');
            }
            $data = array(
                'weid' => $_W['weid'],
                'name' => $_GPC['name'],
                'content' => htmlspecialchars_decode($_GPC['content']),
                'phone' => $_GPC['phone'],
                'qq' => $_GPC['qq'],
                'province' => $_GPC['district']['province'],
                'city' => $_GPC['district']['city'],
                'dist' => $_GPC['district']['district'],
                'address' => $_GPC['address'],
                'lng' => $_GPC['baidumap']['lng'],
                'lat' => $_GPC['baidumap']['lat'],
                'industry1' => $_GPC['industry']['parent'],
                'industry2' => $_GPC['industry']['child'],
                'createtime' => TIMESTAMP
            );
            if (!empty($_GPC['thumb'])) {
                $data['thumb'] = $_GPC['thumb'];
                load()->func('file');
                file_delete($_GPC['thumb-old']);
            }
            if (empty($id)) {
                pdo_insert('dayu_yuyue_store', $data);
            } else {
                unset($data['createtime']);
                pdo_update('dayu_yuyue_store', $data, array(
                    'id' => $id
                ));
            }
            message('门店信息更新成功！', $this->createWebUrl('storedisplay'), 'success');
        }
        include $this->template('storepost');
    }
    public function doWebstoredisplay()
    {
        global $_W, $_GPC;
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue_setting') . ' WHERE `weid`=:weid';
        $params          = array();
        $params[':weid'] = $_W['uniacid'];
        $setting         = pdo_fetch($sql, $params);
        if ($setting['instore'] == '1') {
            message('您选择了『微商户』作为门店，内置门店功能已关闭！请在 参数设置-主要参数中 切换。', '', 'error');
        }
        if (empty($_GPC['do'])) {
            $_GPC['do'] = 'display';
        }
        $pindex    = max(1, intval($_GPC['page']));
        $psize     = 20;
        $condition = '';
        if (!empty($_GPC['keyword'])) {
            $condition .= " AND name LIKE '%{$_GPC['keyword']}%'";
        }
        if (is_array($_GPC['industry'])) {
            if (!empty($_GPC['industry']['parent'])) {
                $condition .= " AND industry1 = '{$_GPC['industry']['parent']}'";
            }
            if (!empty($_GPC['industry']['child'])) {
                $condition .= " AND industry2 = '{$_GPC['industry']['child']}'";
            }
        }
        $list  = pdo_fetchall("SELECT * FROM " . tablename('dayu_yuyue_store') . " WHERE weid = '{$_W['weid']}' $condition ORDER BY id DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
        $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('dayu_yuyue_store') . " WHERE weid = '{$_W['weid']}' $condition");
        $pager = pagination($total, $pindex, $psize);
        include $this->template('storedisplay');
    }
    public function doWebstoredelete()
    {
        global $_GPC;
        $id   = intval($_GPC['id']);
        $item = pdo_fetch("SELECT * FROM " . tablename('dayu_yuyue_store') . " WHERE id = :id", array(
            ':id' => $id
        ));
        if (empty($item)) {
            message('抱歉，门店不存在或是已经删除！', '', 'error');
        }
        if (!empty($item['thumb'])) {
            load()->func('file');
            file_delete($item['thumb']);
        }
        pdo_delete('dayu_yuyue_store', array(
            'id' => $item['id']
        ));
        message('删除成功！', referer(), 'success');
    }
    public function doWebyyxmdisplay()
    {
        global $_W, $_GPC;
        $sql = 'SELECT * FROM ' . tablename('dayu_yuyue_xiangmu') . ' WHERE `weid`=:weid';
        $ds  = pdo_fetchall($sql, array(
            ':weid' => $_W['uniacid']
        ));
        foreach ($ds as &$item) {
            $item['isshow'] = $item['isshow'] == '0' ? '<span class="label label-default label-info">不显示</span>' : '<span class="label label-default label-info">显示</span>';
        }
        include $this->template('yyxmdisplay');
    }
    public function doWebjishidisplay()
    {
        global $_W, $_GPC;
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue_setting') . ' WHERE `weid`=:weid';
        $params          = array();
        $params[':weid'] = $_W['uniacid'];
        $setting         = pdo_fetch($sql, $params);
        $zhicheng        = $setting['zhicheng'];
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue_jishi') . ' WHERE `weid`=:weid';
        $js              = pdo_fetchall($sql, array(
            ':weid' => $_W['uniacid']
        ));
        foreach ($js as &$item) {
            $item['isshow'] = $item['isshow'] == '0' ? '<span class="label label-default label-info">下班</span>' : '<span class="label label-default label-info">上班</span>';
        }
        include $this->template('jishidisplay');
    }
    public function get_outlet($id)
    {
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue_setting') . ' WHERE `weid`=:weid';
        $params          = array();
        $params[':weid'] = $_W['uniacid'];
        $setting         = pdo_fetch($sql, $params);
        if ($setting['instore'] == '1') {
            return pdo_fetch("SELECT * FROM " . tablename('dayu_store_category') . " WHERE id = :id and checked = 1 ", array(
                ':id' => $id
            ));
        } else {
            return pdo_fetch('SELECT * FROM ' . tablename('dayu_yuyue_store') . ' WHERE id = :id ', array(
                ':id' => $id
            ));
        }
    }
    public function get_outlet2($store, $id)
    {
        if ($store == '1') {
            return pdo_fetch("SELECT * FROM " . tablename('dayu_store_category') . " WHERE id = :id and checked = 1 ", array(
                ':id' => $id
            ));
        } else {
            return pdo_fetch('SELECT * FROM ' . tablename('dayu_yuyue_store') . ' WHERE id = :id ', array(
                ':id' => $id
            ));
        }
    }
    public function doWebjishipost()
    {
        global $_W, $_GPC;
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue_setting') . ' WHERE `weid`=:weid';
        $params          = array();
        $params[':weid'] = $_W['uniacid'];
        $setting         = pdo_fetch($sql, $params);
        $zhicheng        = $setting['zhicheng'];
        $reid            = intval($_GPC['id']);
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue') . ' WHERE `weid`=:weid AND `reid`=:reid';
        $params          = array();
        $params[':weid'] = $_W['uniacid'];
        $params[':reid'] = $reid;
        $activity        = pdo_fetch($sql, $params);
        $js              = intval($_GPC['id']);
        $weid            = $_W['uniacid'];
        if ($setting['instore'] == '1') {
            $outlets = pdo_fetchall("SELECT * FROM " . tablename('dayu_store_category') . " WHERE weid = :weid and checked = 1 ORDER BY id DESC", array(
                ':weid' => $weid
            ));
        } else {
            $outlets = pdo_fetchall("SELECT * FROM " . tablename('dayu_yuyue_store') . " WHERE weid = :weid ORDER BY id DESC", array(
                ':weid' => $weid
            ));
        }
        if (checksubmit()) {
            $jsrecord                 = array();
            $jsrecord['name']         = trim($_GPC['jsname']);
            $jsrecord['weid']         = $_W['uniacid'];
            $jsrecord['isshow']       = $_GPC['isshow'];
            $jsrecord['displayorder'] = $_GPC['displayorder'];
            $jsrecord['telephone']    = trim($_GPC['jstel']);
            $jsrecord['noticeemail']  = trim($_GPC['noticeemail']);
            $jsrecord['oid']          = $_GPC['gid'];
            $jsrecord['content']      = trim($_GPC['content']);
            if (empty($js)) {
                pdo_insert('dayu_yuyue_jishi', $jsrecord);
                $js = pdo_insertid();
                if (!$js) {
                    message('保存' . $zhicheng . '失败, 请稍后重试.');
                }
            } else {
                if (pdo_update('dayu_yuyue_jishi', $jsrecord, array(
                    'id' => $js
                )) === false) {
                    message('保存' . $zhicheng . '失败, 请稍后重试.');
                }
            }
            message('保存' . $zhicheng . '成功.', 'refresh');
        }
        if ($js) {
            $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue_jishi') . ' WHERE `weid`=:weid AND `id`=:js';
            $params          = array();
            $params[':weid'] = $_W['uniacid'];
            $params[':js']   = $js;
            $js              = pdo_fetch($sql, $params);
        }
        include $this->template('jishipost');
    }
    public function doWebjsDelete()
    {
        global $_W, $_GPC;
        $jsid = intval($_GPC['id']);
        if ($jsid > 0) {
            $params          = array();
            $params[':jsid'] = $jsid;
            $sql             = 'DELETE FROM ' . tablename('dayu_yuyue_jishi') . ' WHERE `id`=:jsid';
            pdo_query($sql, $params);
            $sql = 'DELETE FROM ' . tablename('dayu_yuyue_record') . ' WHERE `jsid`=:jsid';
            pdo_query($sql, $params);
            message('操作成功.', referer());
        }
        message('非法访问.');
    }
    public function doWebDelete()
    {
        global $_W, $_GPC;
        $reid = intval($_GPC['id']);
        if ($reid > 0) {
            $params          = array();
            $params[':reid'] = $reid;
            $sql             = 'DELETE FROM ' . tablename('dayu_yuyue') . ' WHERE `reid`=:reid';
            pdo_query($sql, $params);
            $sql = 'DELETE FROM ' . tablename('dayu_yuyue_record') . ' WHERE `yid`=:reid';
            pdo_query($sql, $params);
            message('操作成功.', referer());
        }
        message('非法访问.');
    }
    public function doWebXmDelete()
    {
        global $_W, $_GPC;
        $xmid = intval($_GPC['id']);
        if ($xmid > 0) {
            $params          = array();
            $params[':xmid'] = $xmid;
            $sql             = 'DELETE FROM ' . tablename('dayu_yuyue_xiangmu') . ' WHERE `id`=:xmid';
            pdo_query($sql, $params);
            $sql = 'DELETE FROM ' . tablename('dayu_yuyue_record') . ' WHERE `xmid`=:xmid';
            pdo_query($sql, $params);
            message('操作成功.', referer());
        }
        message('非法访问.');
    }
    public function doWebAdv()
    {
        global $_W, $_GPC;
        $operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
        if ($operation == 'display') {
            $list = pdo_fetchall("SELECT * FROM " . tablename('dayu_yuyue_adv') . " WHERE weid = '{$_W['uniacid']}' ORDER BY displayorder DESC");
        } elseif ($operation == 'post') {
            $id = intval($_GPC['id']);
            if (checksubmit('submit')) {
                $data = array(
                    'weid' => $_W['uniacid'],
                    'advname' => $_GPC['advname'],
                    'link' => $_GPC['link'],
                    'enabled' => intval($_GPC['enabled']),
                    'displayorder' => intval($_GPC['displayorder'])
                );
                if (!empty($_GPC['thumb'])) {
                    $data['thumb'] = $_GPC['thumb'];
                    load()->func('file');
                    file_delete($_GPC['thumb-old']);
                }
                if (!empty($id)) {
                    pdo_update('dayu_yuyue_adv', $data, array(
                        'id' => $id
                    ));
                } else {
                    pdo_insert('dayu_yuyue_adv', $data);
                    $id = pdo_insertid();
                }
                message('更新幻灯片成功！', $this->createWebUrl('adv', array(
                    'op' => 'display'
                )), 'success');
            }
            $adv = pdo_fetch("select * from " . tablename('dayu_yuyue_adv') . " where id=:id and weid=:weid limit 1", array(
                ":id" => $id,
                ":weid" => $_W['uniacid']
            ));
        } elseif ($operation == 'delete') {
            $id  = intval($_GPC['id']);
            $adv = pdo_fetch("SELECT id  FROM " . tablename('dayu_yuyue_adv') . " WHERE id = '$id' AND weid=" . $_W['uniacid'] . "");
            if (empty($adv)) {
                message('抱歉，幻灯片不存在或是已经被删除！', $this->createWebUrl('adv', array(
                    'op' => 'display'
                )), 'error');
            }
            pdo_delete('dayu_yuyue_adv', array(
                'id' => $id
            ));
            message('幻灯片删除成功！', $this->createWebUrl('adv', array(
                'op' => 'display'
            )), 'success');
        } else {
            message('请求方式不存在');
        }
        include $this->template('adv', TEMPLATE_INCLUDEPATH, true);
    }
    public function getcardinfo($uniacid, $openid)
    {
        return pdo_fetch("SELECT * FROM " . tablename('mc_mapping_fans') . " WHERE openid = '" . $openid . "' and uniacid = " . $uniacid . " limit 1");
    }
    public function doWebResearchDelete()
    {
        global $_W, $_GPC;
        $id = intval($_GPC['id']);
        if (!empty($id)) {
            pdo_delete('dayu_yuyue_record', array(
                'id' => $id
            ));
        }
        message('操作成功.', referer());
    }
    public function doWebPost()
    {
        global $_W, $_GPC;
        $reid = intval($_GPC['id']);
        if (checksubmit()) {
            $record                = array();
            $record['title']       = trim($_GPC['activity']);
            $record['weid']        = $_W['uniacid'];
            $record['description'] = trim($_GPC['description']);
            $record['content']     = trim($_GPC['content']);
            $record['information'] = trim($_GPC['information']);
            if (!empty($_GPC['thumb'])) {
                $record['thumb'] = $_GPC['thumb'];
                load()->func('file');
                file_delete($_GPC['thumb-old']);
            }
            $record['status']    = intval($_GPC['status']);
            $record['inhome']    = intval($_GPC['inhome']);
            $record['pretotal']  = intval($_GPC['pretotal']);
            $record['starttime'] = strtotime($_GPC['starttime']);
            $record['endtime']   = strtotime($_GPC['endtime']);
            if (empty($reid)) {
                $record['status']     = 1;
                $record['createtime'] = TIMESTAMP;
                pdo_insert('dayu_yuyue', $record);
                $reid = pdo_insertid();
                if (!$reid) {
                    message('保存预约失败, 请稍后重试.');
                }
            } else {
                if (pdo_update('dayu_yuyue', $record, array(
                    'reid' => $reid
                )) === false) {
                    message('保存预约失败, 请稍后重试.');
                }
            }
            message('保存预约成功.', 'refresh');
        }
        if ($reid) {
            $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue') . ' WHERE `weid`=:weid AND `reid`=:reid';
            $params          = array();
            $params[':weid'] = $_W['uniacid'];
            $params[':reid'] = $reid;
            $activity        = pdo_fetch($sql, $params);
            $activity['starttime'] && $activity['starttime'] = date('Y-m-d H:i:s', $activity['starttime']);
            $activity['endtime'] && $activity['endtime'] = date('Y-m-d H:i:s', $activity['endtime']);
        }
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue') . ' WHERE `weid`=:weid AND `reid`=:reid';
        $params          = array();
        $params[':weid'] = $_W['uniacid'];
        $params[':reid'] = $reid;
        $reply           = pdo_fetch($sql, $params);
        if (!$reply) {
            $activity = array(
                "content" => "请提交你的预约内容. 我们会尽快联系你.",
                "information" => "您的预约申请我们已经收到, 请等待客服确认."
            );
        }
        if (empty($activity['endtime'])) {
            $activity['endtime'] = date('Y-m-d', strtotime('+1 day'));
        }
        include $this->template('post');
    }
    public function doWebsetting()
    {
        global $_W, $_GPC;
        $weid     = $_W['uniacid'];
        $activity = pdo_fetch("SELECT * FROM " . tablename('dayu_yuyue_setting') . " WHERE weid = '{$_W['uniacid']}'");
        if (checksubmit()) {
            $record                 = array();
            $record['weid']         = $_W['uniacid'];
            $record['shangmen']     = intval($_GPC['shangmen']);
            $record['stime']        = intval($_GPC['stime']);
            $record['etime']        = intval($_GPC['etime']);
            $record['eday']         = intval($_GPC['eday']);
            $record['card']         = intval($_GPC['card']);
            $record['follow']       = intval($_GPC['follow']);
            $record['instore']      = intval($_GPC['instore']);
            $record['accountsid']   = trim($_GPC['accountsid']);
            $record['tokenid']      = trim($_GPC['tokenid']);
            $record['appId']        = trim($_GPC['appId']);
            $record['templateId']   = trim($_GPC['templateId']);
            $record['xmname']       = trim($_GPC['xmname']);
            $record['mname']        = trim($_GPC['mname']);
            $record['yuyuename']    = trim($_GPC['yuyuename']);
            $record['k_templateid'] = trim($_GPC['k_templateid']);
            $record['m_templateid'] = trim($_GPC['m_templateid']);
            $record['zhicheng']     = trim($_GPC['zhicheng']);
            $record['skins']        = trim($_GPC['skins']);
            $record['kfirst']       = trim($_GPC['kfirst']);
            $record['kfoot']        = trim($_GPC['kfoot']);
            $record['mfirst']       = trim($_GPC['mfirst']);
            $record['mfoot']        = trim($_GPC['mfoot']);
            $record['share_url']    = trim($_GPC['share_url']);
            $record['kfid']         = trim($_GPC['kfid']);
            if (empty($activity)) {
                pdo_insert('dayu_yuyue_setting', $record);
            } else {
                if (pdo_update('dayu_yuyue_setting', $record, array(
                    'weid' => $weid
                )) === false) {
                    message('保存参数设置失败, 请稍后重试.');
                }
            }
            message('保存参数设置成功.', 'refresh');
        }
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue_setting') . ' WHERE `weid`=:weid';
        $params          = array();
        $params[':weid'] = $_W['uniacid'];
        $reply           = pdo_fetch($sql, $params);
        if (!$reply) {
            $activity = array(
                "mname" => "我的预约",
                "xmname" => "请选择服务项目",
                "yuyuename" => "预约时间",
                "stime" => "2",
                "etime" => "22",
                "eday" => "15",
                "zhicheng" => "技师",
                "kfirst" => "有新的客户预约，请及时确认",
                "kfoot" => "点击确认预约，或修改预约时间",
                "mfirst" => "预约结果通知",
                "mfoot" => "如有疑问，请致电联系我们",
                "content" => "请提交你的预约内容. 我们会尽快联系你.",
                "information" => "您的预约申请我们已经收到, 请等待客服确认."
            );
        }
        if (empty($activity['endtime'])) {
            $activity['endtime'] = date('Y-m-d', strtotime('+1 day'));
        }
        include $this->template('setting');
    }
    public function isHy($weid, $from_user)
    {
        load()->model('mc');
        $fans = mc_fetch($from_user);
        if (!empty($fans)) {
            $card = pdo_fetch("SELECT * FROM " . tablename("mc_card_members") . " WHERE uniacid=:uniacid AND uid=:uid ", array(
                ':uniacid' => $weid,
                ':uid' => $fans['uid']
            ));
        }
        if (empty($card)) {
            return false;
        } else {
            return true;
        }
    }
    public function isHy2($weid, $from_user)
    {
        $card = fans_search($from_user);
        if (empty($card)) {
            return false;
        } else {
            return true;
        }
    }
    public function doMobiledayu_yuyue()
    {
        global $_W, $_GPC;
        $do        = 'dayu_yuyue';
        $from_user = $_W['openid'];
        $weid      = $_W['uniacid'];
        $ishy      = $this->isHy($weid, $from_user);
        $advs      = pdo_fetchall("select * from " . tablename('dayu_yuyue_adv') . " where enabled=1 and weid= '{$_W['uniacid']}'  order by displayorder asc");
        foreach ($advs as &$adv) {
            if (substr($adv['link'], 0, 5) != 'http:') {
                $adv['link'] = "http://" . $adv['link'];
            }
        }
        unset($adv);
        $userinfo        = $this->get_userinfo($weid, $from_user);
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue_setting') . ' WHERE `weid`=:weid';
        $params          = array();
        $params[':weid'] = $_W['uniacid'];
        $setting         = pdo_fetch($sql, $params);
        $zhicheng        = $setting['zhicheng'];
        $shangmen        = $setting['shangmen'];
        $mname           = $setting['mname'];
        $stime           = $setting['stime'];
        $etime           = $setting['etime'];
        $eday            = $setting['eday'];
        $accountsid      = $setting['accountsid'];
        $tokenid         = $setting['tokenid'];
        $appId           = $setting['appId'];
        $templateId      = $setting['templateId'];
        $reid            = intval($_GPC['id']);
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue') . ' WHERE `weid`=:weid AND `reid`=:reid';
        $params          = array();
        $params[':weid'] = $_W['uniacid'];
        $params[':reid'] = $reid;
        $activity        = pdo_fetch($sql, $params);
        $title           = $activity['title'];
        $starttime       = date('Y-m-d H:i', time());
        $endtime         = date('Y-m-d H:i', time() + 1800);
        $follow          = pdo_fetchcolumn("select follow from " . tablename('mc_mapping_fans') . " where openid=:openid and uniacid=:uniacid order by `fanid` desc", array(
            ":openid" => $from_user,
            ":uniacid" => $_W['uniacid']
        ));
        if ($follow == 0 && $setting['follow'] == 1) {
            if (!empty($setting['share_url'])) {
                header("HTTP/1.1 301 Moved Permanently");
                header('Location: ' . $setting['share_url'] . "");
                exit();
            }
            $isshare = 1;
            $running = false;
            message('请先关注公共号。');
        }
        if ($setting['card'] == 1 && $ishy == false) {
            message('您还不是会员哦,请先领取您的会员卡.', $this->createMobileUrl('card', array(
                'a' => 'bond',
                'c' => 'mc',
                'i' => $row[weid]
            ), false), 'error');
        }
        if ($activity['status'] != '1') {
            message('当前预约活动已经停止.');
        }
        if (!$activity) {
            message('非法访问.');
        }
        if ($activity['starttime'] > TIMESTAMP) {
            message('当前预约活动还未开始！');
        }
        if ($activity['endtime'] < TIMESTAMP) {
            message('当前预约活动已经结束！');
        }
        if ($setting['instore'] == '1') {
            $outlets = pdo_fetchall("SELECT * FROM " . tablename('dayu_store_category') . " WHERE weid = :weid and checked = 1 ORDER BY id DESC", array(
                ':weid' => $weid
            ));
        } else {
            $outlets = pdo_fetchall("SELECT * FROM " . tablename('dayu_yuyue_store') . " WHERE weid = :weid ORDER BY id DESC", array(
                ':weid' => $weid
            ));
        }
        $xms = pdo_fetchall("SELECT * FROM " . tablename('dayu_yuyue_xiangmu') . " WHERE weid = :weid AND isshow=1 ORDER BY displayorder DESC,id DESC", array(
            ':weid' => $weid
        ));
        if (checksubmit()) {
            $pretotal = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename('dayu_yuyue_record') . " WHERE weid = :weid AND openid = :openid AND yid = :yid", array(
                ':weid' => $weid,
                ':openid' => $from_user,
                ':yid' => $_GPC['yid']
            ));
            if ($pretotal >= $activity['pretotal']) {
                message('抱歉!每人只能提交' . $activity['pretotal'] . "次！", referer(), 'error');
            }
            $row                    = array();
            $row['weid']            = $weid;
            $row['member']          = $_GPC['member'];
            $row['mobile']          = $_GPC['mobile'];
            $row['add']             = $_GPC['add'];
            $row['yid']             = $activity['reid'];
            $row['xmid']            = $_GPC['xmid'];
            $row['oid']             = $_GPC['oid'];
            $row['jsid']            = $_GPC['jsid'];
            $row['yystarttime']     = strtotime($_GPC['yystarttime']);
            $row['yyendtime']       = strtotime($_GPC['yyendtime']);
            $row['yyfs']            = $_GPC['yyfs'];
            $row['openid']          = $from_user;
            $row['beizhu']          = $_GPC['beizhu'];
            $row['createtime']      = TIMESTAMP;
            $addr                   = array();
            $addr['resideprovince'] = $_GPC['resideprovince'];
            $addr['residecity']     = $_GPC['residecity'];
            $addr['residedist']     = $_GPC['residedist'];
            $addr['address']        = $_GPC['address'];
            if ($addr['resideprovince'] != $userinfo['resideprovince'] || $addr['residecity'] != $userinfo['residecity'] || $addr != $userinfo['residedist'] || $addr['address'] != $userinfo['address']) {
                if (pdo_update('mc_members', $addr, array(
                    'uid' => $userinfo['uid']
                )) === false) {
                    message('保存地址失败, 请稍后重试.');
                }
            }
            pdo_insert('dayu_yuyue_record', $row);
            $reid = pdo_insertid();
            if (empty($reid)) {
                message('预约失败，请稍后重试.');
            }
            if (empty($row['oid'])) {
                $outletfy['title'] = '上门服务';
            } else {
                $outletfy = $this->getoutletinfo($row['oid']);
            }
            $timefy   = date('Y-m-d H:i:s', $row['createtime']);
            $yyfsfy   = $row['yyfs'] == 0 ? '店面预约' : '上门服务';
            $beizhufy = $row['beizhu'] == '' ? '无备注信息' : $row['beizhu'];
            $dizhi    = $row['yyfs'] == 0 ? $outletfy['province'] . $outletfy['city'] . $outletfy['dist'] . $outletfy['address'] : $userinfo['resideprovince'] . ', ' . $userinfo['residecity'] . ', ' . $userinfo['residedist'] . ', ' . $userinfo['address'];
            $yyxmfy   = $this->getxminfo($row['xmid']);
            $jsinfo   = $this->getjsinfo($row['jsid']);
            $body     = "会员姓名：" . $row['member'] . "<br/>会员电话：" . $row['mobile'] . "<br/>预约方式：" . $yyfsfy . "<br/>门店：" . $outletfy['name'] . "<br/>地址：" . $dizhi . "<br/>" . $zhicheng . "：" . $jsinfo['name'] . "<br/>预约项目：" . $yyxmfy['title'] . "<br/>预约时间：" . $_GPC['yystarttime'] . "<br/>备注：" . $beizhufy . "<br/><br/>";
            if (!empty($jsinfo['noticeemail'])) {
                load()->func('communication');
                ihttp_email($jsinfo['noticeemail'], $activity['title'] . '的预约提醒', $body);
            }
            if (!empty($jsinfo['telephone'])) {
                $this->SendSms($jsinfo['telephone'], $outletfy['name'], $row['member'], $row['mobile'], $row['yid'], $row['weid'], $setting['accountsid'], $setting['tokenid'], $setting['appId'], $setting['templateId']);
            }
            if (!empty($setting['m_templateid'])) {
                $template = array(
                    "touser" => $from_user,
                    "template_id" => $setting['m_templateid'],
                    "url" => "",
                    "topcolor" => "#FF0000",
                    "data" => array(
                        'first' => array(
                            'value' => urlencode("您好，您已成功预约！"),
                            'color' => "#743A3A"
                        ),
                        'keyword1' => array(
                            'value' => urlencode($yyxmfy['title']),
                            'color' => '#000000'
                        ),
                        'keyword2' => array(
                            'value' => urlencode($jsinfo['name']),
                            'color' => '#000000'
                        ),
                        'keyword3' => array(
                            'value' => urlencode($_GPC['yystarttime']),
                            'color' => '#000000'
                        ),
                        'keyword4' => array(
                            'value' => urlencode($outletfy['title']),
                            'color' => "#FF0000"
                        ),
                        'remark' => array(
                            'value' => urlencode("\\n如有疑问，请致电{$outletfy['phone']}联系我们。"),
                            'color' => "#008000"
                        )
                    )
                );
                $this->send_template_message(urldecode(json_encode($template)));
            }
            message($activity['information'], 'refresh');
        }
        load()->func('tpl');
        include $this->template('submit');
    }
    public function SendSms($telephone, $title, $member, $mobile, $yid, $weid, $accountsid, $tokenid, $appId, $templateId)
    {
        $result['state']       = 0;
        $options['accountsid'] = $accountsid;
        $options['token']      = $tokenid;
        $ucpass                = new Ucpaas($options);
        $appId                 = $appId;
        $to                    = $telephone;
        $templateId            = $templateId;
        $title                 = $title;
        $member                = $member;
        $mobile                = $mobile;
        $param                 = "{$title},{$member},{$mobile}";
        $iscg                  = $ucpass->templateSMS($appId, $to, $templateId, $param);
    }
    public function send_template_message2($data)
    {
        global $_W, $_GPC;
        $atype        = 'weixin';
        $account_code = "account_weixin_code";
        load()->classs('weixin.account');
        $access_token = WeAccount::token();
        $url          = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
        load()->func('communication');
        $res = ihttp_post($url, $data);
        return true;
    }
    public function send_template_message($data)
    {
        global $_W, $_GPC;
        $atype        = 'weixin';
        $account_code = "account_weixin_code";
        load()->classs('weixin.account');
        $access_token = WeAccount::token();
        $url          = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
        load()->func('communication');
        $result = ihttp_post($url, $data);
        return json_decode($result, true);
    }
    public function doMobilegetEndtime($time)
    {
        global $_GPC;
        $endtime = strtotime($_GPC['time']) + 1800;
        $endtime = date('Y-m-d H:i', $endtime);
        echo $endtime;
    }
    public function getjsinfo($jsid)
    {
        return $js = pdo_fetch("SELECT * FROM " . tablename('dayu_yuyue_jishi') . " WHERE id = :id", array(
            ':id' => $jsid
        ));
    }
    public function getxminfo($xmid)
    {
        return $xm = pdo_fetch("SELECT * FROM " . tablename('dayu_yuyue_xiangmu') . " WHERE id = :id", array(
            ':id' => $xmid
        ));
    }
    public function getoutletinfo($oid)
    {
        $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue_setting') . ' WHERE `weid`=:weid';
        $params          = array();
        $params[':weid'] = $_W['uniacid'];
        $setting         = pdo_fetch($sql, $params);
        if ($setting['instore'] == '1') {
            return $js = pdo_fetch("SELECT * FROM " . tablename('dayu_store_category') . " WHERE id = :id and checked = 1", array(
                ':id' => $oid
            ));
        } else {
            return $js = pdo_fetch("SELECT * FROM " . tablename('dayu_yuyue_store') . " WHERE id = :id", array(
                ':id' => $oid
            ));
        }
    }
    public function getoutletinfo2($oid)
    {
        return $js = pdo_fetch("SELECT * FROM " . tablename('dayu_yuyue_store') . " WHERE id = :id", array(
            ':id' => $oid
        ));
    }
    public function getoutletinfo_dayu($oid)
    {
        return $js = pdo_fetch("SELECT * FROM " . tablename('dayu_store_category') . " WHERE id = :id and checked = 1", array(
            ':id' => $oid
        ));
    }
    public function get_userinfo($weid, $from_user)
    {
        load()->model('mc');
        return mc_fetch($from_user);
    }
    public function doMobilegetjs()
    {
        global $_GPC, $_W;
        $jss = pdo_fetchall("SELECT * FROM " . tablename('dayu_yuyue_jishi') . " WHERE weid = :weid AND oid = :oid AND isshow=1 ORDER BY displayorder DESC,id DESC", array(
            ':weid' => $_W['uniacid'],
            ':oid' => $_GPC['oid']
        ));
        if (empty($jss)) {
            $result['status'] = 0;
            $result['jss']    = '该门店暂时无法为您提供服务.';
            message($result, '', 'ajax');
        }
        $result['status'] = 1;
        $result['jss']    = $jss;
        message($result, '', 'ajax');
    }
    public function doMobilegetjss()
    {
        global $_GPC, $_W;
        $jss = pdo_fetchall("SELECT * FROM " . tablename('dayu_yuyue_jishi') . " WHERE weid = :weid AND isshow=1 ORDER BY displayorder DESC,id DESC", array(
            ':weid' => $_W['uniacid']
        ));
        if (empty($jss)) {
            $result['status'] = 0;
            $result['jss']    = '暂时无法为您提供服务.';
            message($result, '', 'ajax');
        }
        $result['status'] = 1;
        $result['jss']    = $jss;
        message($result, '', 'ajax');
    }
    public function doMobileMyResearch()
    {
        global $_W, $_GPC;
        $operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
        $weid      = $_W['uniacid'];
        if ($operation == 'display') {
            $rows = pdo_fetchall("SELECT * FROM " . tablename('dayu_yuyue_record') . " WHERE openid = :openid and weid= :weid ORDER BY createtime DESC", array(
                ':openid' => $_W['fans']['from_user'],
                ':weid' => $_W['uniacid']
            ));
            if (!empty($rows)) {
                foreach ($rows as $row) {
                    $reids[$row['yid']] = $row['yid'];
                }
                $research = pdo_fetchall("SELECT * FROM " . tablename('dayu_yuyue') . " WHERE reid IN (" . implode(',', $reids) . ")", array(), 'reid');
            }
        } elseif ($operation == 'detail') {
            $rerid               = intval($_GPC['id']);
            $record              = array();
            $record['status']    = intval($_GPC['status']);
            $record['yyendtime'] = strtotime($_GPC['yyendtime']);
            if ($_W['ispost']) {
                pdo_update('dayu_yuyue_record', $record, array(
                    'id' => $rerid
                ));
                message('取消预约成功', referer(), 'success');
            }
            $sql              = 'SELECT * FROM ' . tablename('dayu_yuyue_record') . " WHERE `id`=:rerid";
            $params           = array();
            $params[':rerid'] = $rerid;
            $row              = pdo_fetch($sql, $params);
            if (empty($row)) {
                message('访问非法.');
            }
            $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue_setting') . ' WHERE `weid`=:weid';
            $params          = array();
            $params[':weid'] = $_W['uniacid'];
            $setting         = pdo_fetch($sql, $params);
            $zhicheng        = $setting['zhicheng'];
            $sql             = 'SELECT * FROM ' . tablename('dayu_yuyue') . ' WHERE `weid`=:weid AND `reid`=:reid';
            $params          = array();
            $params[':weid'] = $_W['uniacid'];
            $params[':reid'] = $row['yid'];
            $activity        = pdo_fetch($sql, $params);
            if (empty($activity)) {
                message('非法访问.');
            }
            $userinfo = $this->get_userinfo($row['weid'], $row['openid']);
            $yyfsfy   = $row['yyfs'] == 0 ? '店面预约' : '上门服务';
            $beizhufy = $row['beizhu'] == '' ? '无备注信息' : $row['beizhu'];
            if (empty($row['oid'])) {
                $outletfy['title'] = '上门服务';
            } else {
                $outletfy = $this->getoutletinfo($row['oid']);
            }
            $yyxmfy   = $this->getxminfo($row['xmid']);
            $jsinfo   = $this->getjsinfo($row['jsid']);
            $cardinfo = $this->getcardinfo($row['weid'], $row['openid']);
        }
        include $this->template('research');
    }
}
function tpl_form_field_dateyy($name, $value = array(), $ishour = false)
{
    $s = '';
    if (!defined('INCLUDE_DATE')) {
        $s = '
		<link type="text/css" rel="stylesheet" href="resource/style/datetimepicker.css" />
		<script type="text/javascript" src="resource/script/datetimepicker.js"></script>';
    }
    define('INCLUDE_DATE', true);
    if (strexists($name, '[')) {
        $id = str_replace(array(
            '[',
            ']'
        ), '_', $name);
    } else {
        $id = $name;
    }
    $value  = empty($value) ? date('Y-m-d', mktime(0, 0, 0)) : $value;
    $ishour = empty($ishour) ? 2 : 0;
    $s .= '
	<input type="text" class="datepicker" id="datepicker_' . $id . '" name="' . $name . '" value="' . $value . '" readonly="readonly" />
	<script type="text/javascript">
		$("#datepicker_' . $id . '").datetimepicker({
			format: "yyyy-mm-dd hh:ii",
			minView: "' . $ishour . '",
			//pickerPosition: "top-right",
			autoclose: true
		});
	</script>';
    return $s;
}
class Jason_Excel_Export
{
    private $_titles = array();
    private $_titles_count = 0;
    private $_contents = array();
    private $_contents_count = 0;
    private $_fileName = '';
    private $_split = "\t";
    private $_charset = '';
    const DEFAULT_FILE_NAME = 'jason_excel.xls';
    function __construct($fileName = null)
    {
        if ($fileName !== null) {
            $this->_fileName = $fileName;
        } else {
            $this->setFileName();
        }
    }
    public function setFileName($fileName = self::DEFAULT_FILE_NAME)
    {
        $this->_fileName = $fileName;
        $this->setSplite();
        return $this;
    }
    private function _getType()
    {
        return substr($this->_fileName, strrpos($this->_fileName, '.') + 1);
    }
    public function setSplite($split = null)
    {
        if ($split === null) {
            switch ($this->_getType()) {
                case 'xls':
                    $this->_split = "\t";
                    break;
                case 'csv':
                    $this->_split = ",";
                    break;
            }
        } else
            $this->_split = $split;
    }
    public function setTitle(&$title = array())
    {
        $this->_titles       = $title;
        $this->_titles_count = count($title);
        return $this;
    }
    public function setContent(&$content = array())
    {
        $this->_contents       = $content;
        $this->_contents_count = count($content);
        return $this;
    }
    public function addRow($row = array())
    {
        $this->_contents[] = $row;
        $this->_contents_count++;
        return $this;
    }
    public function addRows($rows = array())
    {
        $this->_contents = array_merge($this->_contents, $rows);
        $this->_contents_count += count($rows);
        return $this;
    }
    public function toCode($type = 'GB2312', $from = 'auto')
    {
        foreach ($this->_titles as $k => $title) {
            $this->_titles[$k] = mb_convert_encoding($title, $type, $from);
        }
        foreach ($this->_contents as $i => $contents) {
            $this->_contents[$i] = $this->_toCodeArr($contents);
        }
        return $this;
    }
    private function _toCodeArr(&$arr = array(), $type = 'GB2312', $from = 'auto')
    {
        foreach ($arr as $k => $val) {
            $arr[$k] = mb_convert_encoding($val, $type, $from);
        }
        return $arr;
    }
    public function charset($charset = '')
    {
        if ($charset == '')
            $this->_charset = '';
        else {
            $charset = strtoupper($charset);
            switch ($charset) {
                case 'UTF-8':
                case 'UTF8':
                    $this->_charset = ';charset=UTF-8';
                    break;
                default:
                    $this->_charset = ';charset=' . $charset;
            }
        }
        return $this;
    }
    public function export()
    {
        $header = '';
        $data   = array();
        $header = implode($this->_split, $this->_titles);
        for ($i = 0; $i < $this->_contents_count; $i++) {
            $line_arr = array();
            foreach ($this->_contents[$i] as $value) {
                if (!isset($value) || $value == "") {
                    $value = '""';
                } else {
                    $value = str_replace('"', '""', $value);
                    $value = '"' . $value . '"';
                }
                $line_arr[] = $value;
            }
            $data[] = implode($this->_split, $line_arr);
        }
        $data = implode("\n", $data);
        $data = str_replace("\r", "", $data);
        if ($data == "") {
            $data = "\n(0) Records Found!\n";
        }
        header('Content-type: application/vnd.ms-excel' . $this->_charset);
        header("Content-Disposition: attachment; filename=$this->_fileName");
        header('Pragma: no-cache');
        header('Expires: 0');
        echo '\xEF\xBB\xBF' . $header . "\n" . $data;
    }
}