<?php
defined('IN_IA') or exit('Access Denied');
class Baxia_yjModuleSite extends WeModuleSite
{
    public function doWebWinning()
    {
        global $_GPC, $_W;
        $datas = array();
        $datas_tmp = pdo_fetchall("select * from " . tablename('wx_yj_winning') . " where uniacid=" . $_W['uniacid'] . " order by addtime asc,id asc");
        if (!empty($datas_tmp)) {
            foreach ($datas_tmp as $value) {
                $datas[$value['addtime']][] = $value;
            }
        }
        include $this->template('winning');
    }
    public function doWebStart()
    {
        include $this->template('start');
    }
    public function doWebIndex()
    {
        global $_W, $_GPC;
        $param = $this->module['config'];
        if (empty($param)) {
            message('请先设置参数！');
        }
        if ($_GPC['strp']) {
            $strp = $_GPC['strp'];
            $strp = trim($strp, ',');
            $strp = explode(',', $strp);
            $time = time();
            $infos = pdo_fetchall("select * from " . tablename('wx_yj_users') . " where uniacid=" . $_W['uniacid'] . " and id in(" . implode(',', $strp) . ")");
            if (!empty($infos)) {
                foreach ($infos as $value) {
                    $arr = array('uniacid' => $_W['uniacid'], 'headurl' => $value['headurl'], 'nickname' => $value['nickname'], 'addtime' => $time);
                    pdo_insert('wx_yj_winning', $arr);
                }
            }
            if ($param['winning'] == 1) {
                pdo_query("update " . tablename('wx_yj_users') . " set let=-1 where id in(" . implode(',', $strp) . ")");
            }
            exit(json_encode('1'));
        }
        $staticurl = MODULE_URL;
        $str = $param['winning'] == 1 ? ' and let=1' : '';
        $datas = pdo_fetchall("select * from " . tablename('wx_yj_users') . " where uniacid=" . $_W['uniacid'] . " " . $str);
        $users = array();
        if (!empty($datas)) {
            shuffle($datas);
            foreach ($datas as $key => $value) {
                $users[$key]['id'] = $value['id'];
                $users[$key]['img'] = $value['headurl'];
                $users[$key]['name'] = $value['nickname'] ? base64_decode($value['nickname']) : '';
            }
        }
        $param['nums'] = count($users) >= $param['nums'] ? $param['nums'] : count($users);
        include $this->template('index');
    }
    public function doWebClear()
    {
        global $_W, $_GPC;
        pdo_update('wx_yj_users', array('let' => 1), array('uniacid' => $_W['uniacid']));
        pdo_delete('wx_yj_winning', array('uniacid' => $_W['uniacid']));
        message('已重置中奖', $this->createWebUrl('start'));
    }
    public function doWebDel()
    {
        global $_W, $_GPC;
        pdo_delete('wx_yj_users', array('uniacid' => $_W['uniacid']));
        pdo_delete('wx_yj_winning', array('uniacid' => $_W['uniacid']));
        message('已重置所有', $this->createWebUrl('start'));
    }
}
$GLOBALS["wodk"] = null;
unset($GLOBALS["wodk"]);