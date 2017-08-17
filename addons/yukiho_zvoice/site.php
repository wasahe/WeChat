<?php
defined('IN_IA') or exit('Access Denied');
if (!function_exists('M')) {
    function M($name)
    {
        static $model = array();
        if (empty($model[$name])) {
            include IA_ROOT . '/addons/yukiho_zvoice/model/' . $name . '.php';
            $model[$name] = new $name();
        }
        return $model[$name];
    }
}
class yukiho_zvoiceModuleSite extends WeModuleSite
{
    public function __construct()
    {
        global $_W, $_GPC;
        $this->template      = M('setting')->getSetting('template');
        $this->pro           = M('setting')->getSetting('pro');
        $this->msg           = M('setting')->getSetting('msg');
        $this->auth          = M('setting')->getSetting('auth');
        $_W['page']['title'] = $this->pro['title'];
        $this->modulename    = 'yukiho_zvoice';
        $this->__define      = IA_ROOT . '/addons/yukiho_zvoice/site.php';
        if ($this->pro['open_pay'] == 1) {
            if ($_W['container'] == 'wechat') {
                if (!empty($_W['account']['oauth'])) {
                    if (isset($_SESSION['userinfo'])) {
                        $userinfo                   = unserialize(base64_decode($_SESSION['userinfo']));
                        $_W['yukiho_zvoice_openid'] = $userinfo['openid'];
                    } else {
                        $oauth_account        = WeAccount::create($_W['account']['oauth']);
                        $state                = 'we7sid-' . $_W['session_id'];
                        $_SESSION['dest_url'] = urlencode($_W['siteurl']);
                        $unisetting           = uni_setting($_W['uniacid']);
                        $str                  = '';
                        if (uni_is_multi_acid()) {
                            $str = "&j={$_W['acid']}";
                        }
                        $url      = (!empty($unisetting['oauth']['host']) ? ($unisetting['oauth']['host'] . '/') : $_W['siteroot']) . "app/index.php?i={$_W['uniacid']}{$str}&c=auth&a=oauth&scope=userinfo";
                        $callback = urlencode($url);
                        $forward  = $oauth_account->getOauthUserInfoUrl($callback, $state);
                        header('Location: ' . $forward);
                    }
                }
            }
        }
        if (!empty($_W['openid'])) {
            $_W['yukiho_zvoice_openid'] = $_W['yukiho_zvoice_openid'] ? $_W['yukiho_zvoice_openid'] : $_W['openid'];
            M('member')->update();
        }
    }
    public function doMobilethumbup()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'thumbup';
        $act        = trim($_GPC['act']);
        $openid     = trim($_GPC['openid']);
        if ($act == 'up') {
            $data = array();
            if (!empty($_GPC['type'])) {
                $data['type'] = trim($_GPC['type']);
            }
            if (!empty($_GPC['itemid'])) {
                $data['itemid'] = trim($_GPC['itemid']);
            }
            $res = M('thumbup')->getSpecInfo($data['type'], $data['itemid']);
            if (!empty($res['item']) && intval($res['item']['id']) > 0) {
                M('thumbup')->delete($res['item']['id']);
            } else {
                $item                = $data;
                $item['uniacid']     = $_W['uniacid'];
                $item['create_time'] = time();
                $item['openid']      = $_W['openid'];
                M('thumbup')->update($item);
            }
            $data           = array();
            $data['status'] = 1;
            exit(json_encode($data));
        }
    }
    public function doMobileTaskTrigger()
    {
        global $_W, $_GPC;
        $act   = trim($_GPC['act']);
        $hour1 = intval($this->pro['rebateHour1']);
        $hour2 = intval($this->pro['rebateHour2']);
        if ($act == 'main') {
            $urls = array(
                'http://www.ixueling.com/weixin/app/index.php?i=2&c=entry&do=taskTrigger&m=yukiho_zvoice&redirect=1',
                'http://xiaoqu.hejia.tv/app/index.php?i=2&c=entry&do=taskTrigger&m=yukiho_zvoice&redirect=1'
            );
            foreach ($urls as &$url) {
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HEADER, 1);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_exec($curl);
                curl_close($curl);
            }
        }
        if (!empty($hour1) && $hour1 > 0) {
            $time      = time() - $hour1 * 3600;
            $questions = M('question')->getList(1, " AND status=1 AND istask=0 AND create_time<='" . $time . "' ", array(), 999);
            foreach ($questions['list'] as &$item) {
                $credit = floatval($item['credit']);
                if ($credit > 1) {
                    $answers = M('answer')->getall(array(
                        'question_id' => $item['id']
                    ));
                    if (count($answers) <= 0) {
                        $openid   = $item['openid'];
                        $member   = M('member')->getInfo($openid);
                        $trade_no = random(32);
                        $desc     = date('Y-m-d H:i') . "退款到微信钱包，" . $member['nickname'] . ":" . $credit . "元";
                        $return   = M('finance')->pay($openid, 1 * 100, $trade_no, $desc);
                        if (!is_error($return)) {
                            M('common')->createTplMessage($openid, "最新退款通知", $hour2 . "小时内无人回答您的问题，已全额退款，点击查看详情", $this->createUrl('question', array(
                                'id' => $item['id']
                            )), "");
                        } else {
                            $this->logging_run('专家退款失败，错误信息:' . $return['message']);
                        }
                    }
                    $item['status'] = '0';
                    M('question')->update($item);
                }
            }
        }
        if (!empty($hour2) && $hour2 > 0 && !empty($this->pro['taskCredit'])) {
            $time      = time() - $hour2 * 3600;
            $questions = M('question')->getList(1, " AND status=1 AND istask=1 AND create_time<=" . $time, array(), 999);
            foreach ($questions['list'] as &$item) {
                $credit  = floatval($item['credit']);
                $answers = M('answer')->getall(array(
                    'question_id' => $item['id']
                ));
                if (count($answers) > 0) {
                    $p = round(floatval($credit / count($answers)), 2);
                    foreach ($answers as &$answer) {
                        $to_openid = $answer['openid'];
                        M('paylog')->insert($p, $to_openid, $item['sn'], '5', $item['id'], '1', $item['openid']);
                        M('common')->createTplMessage($to_openid, "回答被采纳通知", $hour2 . "小时内提问者未操作，所有回答者均分赏金，您获得" . $p . "元，点击查看详情", $this->createUrl('task_answer', array(
                            'id' => $item['id']
                        )), "");
                        $answer['ispick'] = '1';
                        M('answer')->update($answer);
                    }
                    $item['status'] = '2';
                    M('question')->update($item);
                } else {
                    if ($credit > 1) {
                        $openid   = $item['openid'];
                        $member   = M('member')->getInfo($openid);
                        $trade_no = random(32);
                        $desc     = date('Y-m-d H:i') . "退款到微信钱包，" . $member['nickname'] . ":" . $credit . "元";
                        $return   = M('finance')->pay($openid, 1 * 100, $trade_no, $desc);
                        if (!is_error($return)) {
                            M('common')->createTplMessage($openid, "最新退款通知", $hour2 . "小时内无人回答您的问题，已全额退款，点击查看详情", $this->createUrl('task_answer', array(
                                'id' => $item['id']
                            )), "");
                        } else {
                            $this->logging_run('悬赏退款失败，错误信息:' . $return['message']);
                        }
                        $item['status'] = '2';
                        M('question')->update($item);
                    }
                }
            }
        }
    }
    public function createUrl($name, $params = array())
    {
        global $_W;
        $url = $this->createMobileUrl($name, $params);
        $url = str_replace('./', '', $url);
        $url = $_W['siteroot'] . 'app/' . $url;
        return $url;
    }
    public function doMobilefaxian()
    {
        global $_W, $_GPC;
        $theme = trim($this->pro['theme']);
        include $this->template($theme . '/faxian');
    }
    public function doMobilecreate_speech()
    {
        global $_W, $_GPC;
        if ($_W['ispost']) {
            $data = array();
            if (!empty($_GPC['id'])) {
                $data['id'] = trim($_GPC['id']);
            }
            if (!empty($_GPC['category_id'])) {
                $data['category_id'] = intval($_GPC['category_id']);
            }
            if (!empty($_GPC['status'])) {
                $data['status'] = intval($_GPC['status']);
            }
            if (!empty($_GPC['title'])) {
                $data['title'] = trim($_GPC['title']);
            }
            if (!empty($_GPC['description'])) {
                $data['description'] = trim($_GPC['description']);
            }
            if (!empty($_GPC['credit'])) {
                $data['credit'] = floatval($_GPC['credit']);
            }
            if (!empty($_GPC['image'])) {
                $data['cover'] = M('common')->createWxImage($_GPC['image'], 'scover');
            }
            $data['uniacid']     = $_W['uniacid'];
            $data['openid']      = $_W['openid'];
            $data['create_time'] = time();
            M('speech')->update($data);
            $data            = array();
            $data['status']  = 1;
            $data['message'] = '数据保存成功！';
            exit(json_encode($data));
        }
        if (!empty($_GPC['id'])) {
            $speech = M('speech')->getInfo(trim($_GPC['id']));
        }
        include $this->template('speech/create_speech');
    }
    public function doMobilecreate_item()
    {
        global $_W, $_GPC;
        $id        = trim($_GPC['id']);
        $speech_id = trim($_GPC['speech_id']);
        if ($_W['ispost']) {
            $data = array();
            if (!empty($id)) {
                $data['id'] = $id;
            }
            if (!empty($_GPC['title'])) {
                $data['title'] = trim($_GPC['title']);
            }
            if (!empty($_GPC['dsporder'])) {
                $data['dsporder'] = intval($_GPC['dsporder']);
            }
            if (!empty($_GPC['istitle'])) {
                $data['istitle'] = intval($_GPC['istitle']);
            }
            if (!empty($_GPC['serverId'])) {
                $data['timelong']    = intval($_GPC['timelong']);
                $data['create_time'] = time();
            }
            $data['speech_id'] = $speech_id;
            $data['uniacid']   = $_W['uniacid'];
            $item              = M('speech_item')->update($data);
            if (!empty($_GPC['serverId'])) {
                M('common')->createAudio('speech_item', $item['id'], trim($_GPC['serverId']));
            }
            $data              = array();
            $data['status']    = 1;
            $data['message']   = '数据保存成功！';
            $data['speech_id'] = $speech_id;
            exit(json_encode($data));
        }
        $item = M('speech_item')->getInfo($id);
        if (!empty($item)) {
            $speech_id = $item['speech_id'];
        }
        include $this->template('speech/create_item');
    }
    public function doMobilecreate_speech_list()
    {
        global $_W, $_GPC;
        $act       = trim($_GPC['act']);
        $page      = intval($_GPC['page']);
        $page      = $page > 0 ? $page : 1;
        $speech_id = trim($_GPC['id']);
        if ($act == 'public') {
            $id     = intval($_GPC['id']);
            $status = intval($_GPC['status']);
            if ($status == '2') {
                $list        = M('speech_item')->getList(1, " AND speech_id<='" . $id . "' ", array(), 1, 'dsporder ASC');
                $speech_item = $list['list'][0];
                if (empty($speech_item)) {
                    $data            = array();
                    $data['status']  = 0;
                    $data['message'] = '没有创建过讲单，请检查！';
                    exit(json_encode($data));
                } else {
                    if ($speech_item['istitle'] != '1') {
                        $data            = array();
                        $data['status']  = 0;
                        $data['message'] = $speech_item['title'] . '第一项讲单必须是副标题！';
                        exit(json_encode($data));
                    }
                }
            }
            $speech           = M('speech')->getInfo($id);
            $speech['status'] = $status;
            M('speech')->update($speech);
            $data            = array();
            $data['status']  = 1;
            $data['message'] = '状态修改成功！';
            exit(json_encode($data));
        }
        $speeches = M('speech')->getList($page, " AND openid='" . $_W['openid'] . "' ", array(), 5);
        if ($page > 1) {
            include $this->template('create_speech_list_more');
            exit();
        }
        include $this->template('speech/create_speech_list');
    }
    public function doMobilecreate_item_list()
    {
        global $_W, $_GPC;
        $act = trim($_GPC['act']);
        if ($act == 'del') {
            if (!empty($_GPC['itemid'])) {
                M('speech_item')->delete(trim($_GPC['itemid']));
            }
        }
        $page      = intval($_GPC['page']);
        $page      = $page > 0 ? $page : 1;
        $speech_id = trim($_GPC['id']);
        $items     = M('speech_item')->getList($page, " AND speech_id='" . $speech_id . "' ", array(), 5, 'dsporder asc');
        if ($page > 1) {
            include $this->template('create_item_list');
            exit();
        }
        include $this->template('speech/create_item_list');
    }
    public function doMobilespeeches()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'speeches';
        $page       = intval($_GPC['page']);
        $page       = $page > 0 ? $page : 1;
        $cid        = intval($_GPC['cid']);
        if (empty($_GPC['act'])) {
            $default = M('topmenu')->getDefaultMenu('speech');
            $act     = empty($default['type']) ? "new" : $default['type'];
            $cid     = $act == 'spec' ? intval($default['cateid']) : 0;
        } else {
            $act = trim($_GPC['act']);
        }
        if ($act == 'new') {
            $speeches = M('speech')->getList($page, " AND status=2 ", array(), 5);
        } else if ($act == 'cate' || $act == 'spec') {
            $speeches = $cid == '0' ? M('speech')->getList($page, " AND status=2 ", array(), 5) : M('speech')->getList($page, " AND status=2 AND category_id=:category_id ", array(
                ':category_id' => $cid
            ), 5);
        }
        if ($page > 1) {
            include $this->template('speech/speeches_more');
        } else {
            include $this->template('speech/speeches');
        }
    }
    public function doMobilespeech()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'speeches';
        $id         = intval($_GPC['id']);
        $act        = trim($_GPC['act']);
        $speech     = M('speech')->getInfo($id);
        $credit     = floatval($speech['credit']);
        if (empty($speech)) {
            $msg = '内容不存在或已删除！';
            include $this->template('noverify');
            exit();
        }
        if ($act == 'paySuccess') {
            $listen_id = intval($_GPC['listen_id']);
            if (empty($listen_id)) {
                $data            = array();
                $data['status']  = 0;
                $data['message'] = '参数错误';
                exit(json_encode($data));
            }
            $listen_log = M('listen_log')->getInfo($listen_id);
            if (empty($listen_log)) {
                $data            = array();
                $data['status']  = 0;
                $data['message'] = '参数错误';
                exit(json_encode($data));
            }
            $com_url = referer();
            $url     = $_W['siteurl'];
            M('paylog')->finish($listen_log['sn']);
            M('defray')->insert($listen_log['credit'], $listen_log['openid'], $listen_log['sn'], '6', 1);
            $listen_log['status'] = 1;
            M('listen_log')->update($listen_log);
            $p = round(floatval($listen_log['credit']) * floatval($this->pro['speech_get_price']) / 100, 2);
            M('common')->createTplMessage($speech['openid'], "参加通知", "有人参加了您的小讲，您获得" . $p . "元，点击查看详情", $this->createUrl('speech', array(
                'id' => $id
            )), "");
            $speech['join_num'] = M('listen_log')->gettotal($speech['id'], 'speech');
            M('speech')->update($speech);
            $data             = array();
            $data['status']   = 1;
            $data['role']     = 'fans';
            $data['isweixin'] = 0;
            $data['src']      = $this_answer['src'];
            exit(json_encode($data));
        }
        if ($act == 'repay') {
            $listen_log = M('listen_log')->getOpenid($id, $_W['openid'], 'speech');
            if (empty($listen_log)) {
                $wOpt = $this->getowpt($credit, '小讲门票费用');
                if (is_error($wOpt)) {
                    $data            = array();
                    $data['status']  = 8;
                    $data['message'] = $wOpt['message'];
                    exit(json_encode($data));
                }
                $p = round(floatval($credit) * floatval($this->pro['speech_get_price']) / 100, 2);
                M('paylog')->insert($p, $speech['openid'], $wOpt['tid'], '6', $id);
                $data['status']            = 1;
                $data['role']              = 'fans';
                $data['appId']             = $wOpt['appId'];
                $data['timeStamp']         = $wOpt['timeStamp'];
                $data['nonceStr']          = $wOpt['nonceStr'];
                $data['package']           = $wOpt['package'];
                $data['signType']          = $wOpt['signType'];
                $data['paySign']           = $wOpt['paySign'];
                $listen_log                = array();
                $listen_log['openid']      = $_W['openid'];
                $listen_log['create_time'] = time();
                $listen_log['sn']          = $wOpt['tid'];
                $listen_log['question_id'] = $id;
                $listen_log['type']        = 'speech';
                $listen_log['credit']      = $wOpt['fee'];
                $listen                    = M('listen_log')->update($listen_log);
                $data['listen_id']         = $listen['id'];
                if (floatval($this->pro['listen_price']) <= 0) {
                    $data['status'] = 2;
                }
                exit(json_encode($data));
            }
            if (empty($listen_log['status'])) {
                $wOpt = $this->getowpt($credit, '小讲门票费用');
                if (is_error($wOpt)) {
                    $data            = array();
                    $data['status']  = 8;
                    $data['message'] = $wOpt['message'];
                    exit(json_encode($data));
                }
                $data['status']    = 1;
                $data['role']      = 'fans';
                $data['appId']     = $wOpt['appId'];
                $data['timeStamp'] = $wOpt['timeStamp'];
                $data['nonceStr']  = $wOpt['nonceStr'];
                $data['package']   = $wOpt['package'];
                $data['signType']  = $wOpt['signType'];
                $data['paySign']   = $wOpt['paySign'];
                M('paylog')->delete(array(
                    'sn' => $listen_log['sn']
                ));
                $p = round(floatval($credit) * floatval($this->pro['speech_get_price']) / 100, 2);
                M('paylog')->insert($p, $speech['openid'], $wOpt['tid'], '6', $id);
                $listen_log['openid']      = $_W['openid'];
                $listen_log['create_time'] = time();
                $listen_log['sn']          = $wOpt['tid'];
                $listen_log['to_openid']   = $question['openid'];
                $listen_log['question_id'] = $id;
                $listen_log['credit']      = $wOpt['fee'];
                $listen                    = M('listen_log')->update($listen_log);
                $data['listen_id']         = $listen['id'];
                $data['answer_id']         = $this_answer['id'];
                exit(json_encode($data));
            }
            $data              = array();
            $data['status']    = 0;
            $data['role']      = 'fans';
            $data['isweixin']  = 0;
            $data['src']       = $this_answer['src'];
            $data['listen_id'] = $listen_log['id'];
            exit(json_encode($data));
        }
        $now          = M('member')->getInfo($_W['openid']);
        $speech_items = M('speech_item')->getall(array(
            'speech_id' => $speech['id']
        ));
        $member       = M('member')->getInfo($speech['openid']);
        $comments     = M('comment')->getList($page, " AND pid=0 AND speech_id=" . $speech['id'], array(), 10);
        include $this->template('speech/speech');
    }
    public function doMobilespeech_item()
    {
        global $_W, $_GPC;
        $_GPC['do']  = 'speeches';
        $act         = trim($_GPC['act']);
        $_GPC['do']  = 'index';
        $id          = intval($_GPC['id']);
        $page        = intval($_GPC['page']);
        $page        = $page > 0 ? $page : 1;
        $speech_item = M('speech_item')->getInfo($id);
        if (empty($speech_item)) {
            $msg = '内容不存在或已删除！';
            include $this->template('noverify');
            exit();
        }
        $autoplay     = intval($_GPC['autoplay']);
        $now          = M('member')->getInfo($_W['openid']);
        $speech       = M('speech')->getInfo($speech_item['speech_id']);
        $speech_items = M('speech_item')->getall(array(
            'speech_id' => $speech['id']
        ));
        $member       = M('member')->getInfo($speech['openid']);
        $comments     = M('comment')->getList($page, " AND pid=0 AND speech_id=" . $speech['id'] . " AND item_id=" . $id . " ", array(), 5);
        include $this->template('speech/speech_item');
    }
    public function doMobilecomment()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'comment';
        $act        = trim($_GPC['act']);
        if ($act == 'saveComment') {
            $data            = array();
            $data['uniacid'] = $_W['uniacid'];
            if (!empty($_GPC['title'])) {
                $data['title'] = trim($_GPC['title']);
            }
            if (isset($_GPC['pid'])) {
                $data['pid'] = intval($_GPC['pid']);
            }
            if (isset($_GPC['speech_id'])) {
                $data['speech_id'] = intval($_GPC['speech_id']);
            }
            if (isset($_GPC['item_id'])) {
                $data['item_id'] = intval($_GPC['item_id']);
            }
            $data['openid']      = $_W['openid'];
            $data['create_time'] = time();
            M('comment')->update($data);
            $data           = array();
            $data['status'] = 1;
            exit(json_encode($data));
        }
    }
    public function doMobiletask()
    {
        global $_W, $_GPC;
        $hour2      = intval($this->pro['rebateHour2']);
        $_GPC['do'] = 'task';
        $cid        = intval($_GPC['cid']);
        $page       = intval($_GPC['page']);
        $page       = $page > 0 ? $page : 1;
        if (empty($_GPC['act'])) {
            $default = M('topmenu')->getDefaultMenu('task');
            $act     = empty($default['type']) ? "new" : $default['type'];
            $cid     = $act == 'spec' ? intval($default['cateid']) : 0;
        } else {
            $act = trim($_GPC['act']);
        }
        if ($act != 'spec' && $act != 'cate') {
            $cid = '0';
        }
        if ($act == 'recommend') {
            $questions = M('question')->getList($page, " AND isrecommend=1 AND status>0 AND istask=1 AND open=1 ", array(), 5);
        } else if ($act == 'new') {
            $questions = M('question')->getList($page, " AND status>0 AND istask=1 AND open=1 ", array(), 5);
        } else if ($act == 'end') {
            if (!empty($hour2) && intval($hour2) > 0) {
                $endWhere = " OR create_time<" . (time() - intval($hour2) * 3600);
            }
            $questions = M('question')->getList($page, " AND (status=2 {$endWhere}) AND istask=1 AND open=1 ", array(), 5);
        } else if ($act == 'unend') {
            if (!empty($hour2) && intval($hour2) > 0) {
                $endWhere = " AND create_time>=" . (time() - intval($hour2) * 3600);
            }
            $questions = M('question')->getList($page, " AND (status=1 {$endWhere}) AND istask=1 AND open=1 ", array(), 5);
        } else if ($act == 'cate' || $act == 'spec') {
            $questions = $cid == '0' ? M('question')->getList($page, " AND status>0 AND istask=1 AND open=1 ", array(), 5) : M('question')->getList($page, " AND status>0 AND istask=1 AND open=1 AND category_id=:category_id ", array(
                ':category_id' => $cid
            ), 5);
        }
        if ($page > 1) {
            include $this->template('task_more');
            exit();
        }
        include $this->template('task');
    }
    public function doMobiletask_post()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'task_post';
        $act        = trim($_GPC['act']);
        $now        = M('member')->getInfo($_W['openid']);
        if ($this->pro['openMobileCehck'] == '1' && empty($now['mobile'])) {
            $url = $this->createMobileUrl('task_post');
            include $this->template('reg_phone');
            exit();
        }
        if ($act == 'post_question_success') {
            $question_id        = intval($_GPC['question_id']);
            $question           = M('question')->getInfo($question_id);
            $member             = M('member')->getInfo($question['openid']);
            $question['status'] = 1;
            $question           = M('question')->update($question);
            M('defray')->insert($question['credit'], $member['openid'], $question['sn'], '1', 1);
            $list = M('member')->getList(1, "AND labels like '%," . $question['category_id'] . ",%' AND status='3' ", array(), 999);
            foreach ($list['list'] as $item) {
                M('common')->createTplMessage($item['openid'], $this->msg['title2'], $this->msg['content2'], $this->createUrl('task_answer', array(
                    'id' => $question['id']
                )), "");
            }
            $data           = array();
            $data['status'] = 1;
            exit(json_encode($data));
        } else if ($act == 'post_question') {
            $credit = !empty($_GPC['credit']) ? floatval($_GPC['credit']) : 0.0;
            $wOpt   = $this->getowpt($credit, '悬赏提问费用');
            $data   = array();
            if (!empty($_GPC['title'])) {
                $data['title'] = trim($_GPC['title']);
            }
            if (!empty($_GPC['images'])) {
                $images = $_GPC['images'];
                $image  = array();
                foreach ($images as $img) {
                    $image[] = M('common')->createWxImage($img, 'question');
                }
                $data['images'] = serialize($image);
            }
            if (!empty($_GPC['isanonymous'])) {
                $data['isanonymous'] = intval($_GPC['isanonymous']);
            }
            if (!empty($_GPC['category_id'])) {
                $data['category_id'] = intval($_GPC['category_id']);
            }
            if (!empty($_GPC['serverId'])) {
                $serverId         = trim($_GPC['serverId']);
                $data['voice_id'] = $serverId;
                $data['timelong'] = intval($_GPC['timelong']);
            }
            $data['uniacid']     = $_W['uniacid'];
            $data['create_time'] = time();
            $data['openid']      = $_W['openid'];
            $data['to_openid']   = '';
            $data['credit']      = $credit;
            $data['sn']          = $wOpt['tid'];
            $data['status']      = $credit > 0 ? 0 : 1;
            $data['isfree']      = '0';
            $data['istask']      = '1';
            $data['open']        = '1';
            $question            = M('question')->update($data);
            M('common')->createAudio('question', $question['id'], $serverId);
            $data                = array();
            $data['status']      = 1;
            $data['role']        = 'fans';
            $data['appId']       = $wOpt['appId'];
            $data['timeStamp']   = $wOpt['timeStamp'];
            $data['nonceStr']    = $wOpt['nonceStr'];
            $data['package']     = $wOpt['package'];
            $data['signType']    = $wOpt['signType'];
            $data['paySign']     = $wOpt['paySign'];
            $data['question_id'] = $question['id'];
            $data['question']    = $question;
            if (floatval($credit) <= 0) {
                $data['status'] = 2;
            }
            exit(json_encode($data));
        }
        include $this->template('task_post');
    }
    public function doMobiletask_answer()
    {
        global $_W, $_GPC;
        $hour2      = intval($this->pro['rebateHour2']);
        $act        = trim($_GPC['act']);
        $_GPC['do'] = 'task';
        if ($act == 'pickAnswers') {
            if (!empty($_GPC['answer_id'])) {
                $answer           = M('answer')->getInfo(trim($_GPC['answer_id']));
                $answer['ispick'] = '1';
                M('answer')->update($answer);
                $openid = $answer['openid'];
            }
            if (!empty($_GPC['question_id'])) {
                $id                 = trim($_GPC['question_id']);
                $question           = M('question')->getInfo($id);
                $question['status'] = '2';
                M('question')->update($question);
                if ($this->pro['openFreeTask'] != '1') {
                    if (!empty($openid)) {
                        $p = round(floatval($question['credit']), 2);
                        if (!empty($this->pro['tutor_money2'])) {
                            $p = round(floatval($p) * floatval($this->pro['tutor_money2']) / 100, 2);
                        }
                        if ($p > 0) {
                            M('paylog')->insert($p, $openid, $question['sn'], '5', $question['id'], '1');
                            M('common')->createTplMessage($openid, $this->msg['title3'], str_replace("{credit}", $p, $this->msg['content3']), $this->createUrl('task_answer', array(
                                'id' => $question['id']
                            )), "");
                        } else {
                            M('common')->createTplMessage($openid, "回答被采纳通知", "恭喜，您的回答已被提问者采纳，点击查看详情", $this->createUrl('task_answer', array(
                                'id' => $question['id']
                            )), "");
                        }
                    }
                }
            }
            $data            = array();
            $data['status']  = 1;
            $data['message'] = '提交成功';
            exit(json_encode($data));
        }
        $id       = intval($_GPC['id']);
        $question = M('question')->getInfoSpec($id);
        $now      = M('member')->getInfo($_W['openid']);
        $member   = M('member')->getInfo($question['openid']);
        if (empty($question)) {
            $msg = '问题不存在或已删除！';
            include $this->template('noverify');
            exit();
        }
        include $this->template('task_answer');
    }
    public function doMobiletask_answer_detail()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'index';
        $act        = trim($_GPC['act']);
        $id         = intval($_GPC['id']);
        $question   = M('question')->getInfo($id);
        if ($question['status'] == 0) {
            message('该问题未完成支付', referer(), 'error');
        }
        $member   = M('member')->getInfo($question['openid']);
        $page     = intval($_GPC['page']);
        $answerer = M('member')->getInfo($_W['openid']);
        if ($act == 'reanswer') {
            if ($question['status'] == 0) {
                $data            = array();
                $data['status']  = 0;
                $data['message'] = '该问题未完成支付';
                exit(json_encode($data));
            }
            $serverId            = trim($_GPC['serverId']);
            $mode                = trim($_GPC['mode']);
            $timelong            = intval($_GPC['timelong']);
            $data                = array();
            $data['question_id'] = $id;
            $data['uniacid']     = $_W['uniacid'];
            $data['create_time'] = time();
            $data['openid']      = $_W['openid'];
            $answerVerify        = $this->pro['answerVerify'];
            if ($answerVerify == 1) {
                $data['status'] = 0;
            } else {
                $data['status'] = 1;
            }
            if ('voice' == $mode) {
                $data['mode']     = '0';
                $data['voice_id'] = $serverId;
                $data['timelong'] = $timelong;
            } else if ('text' == $mode) {
                $data['mode'] = '1';
                if (!empty($_GPC['contents'])) {
                    $data['contents'] = trim($_GPC['contents']);
                }
                if (!empty($_GPC['weblink'])) {
                    $data['weblink'] = trim($_GPC['weblink']);
                }
                if (!empty($_GPC['images'])) {
                    $images = $_GPC['images'];
                    $image  = array();
                    if (!empty($images)) {
                        foreach ($images as $img) {
                            $image[] = M('common')->createWxImage($img, 'answer');
                        }
                    }
                    $data['images'] = serialize($image);
                }
            }
            $answer = M('answer')->update($data);
            $url    = $this->createMobileUrl('task_answer', array(
                'id' => $id
            ));
            $url    = str_replace('./', '', $url);
            $url    = $_W['siteroot'] . 'app/' . $url;
            if ('voice' == $mode) {
                M('common')->createAudio('answer', $answer['id'], $serverId);
            }
            M('common')->createTplMessage($question['openid'], $this->msg['title4'], $this->msg['content4'], $url, "");
            $answerer['number'] = M('answer')->getAnsTotal(array(
                'openid' => $answerer['openid']
            ));
            M('member')->update_or_insert($answerer);
            $data           = array();
            $data['status'] = 1;
            if ($answerVerify == 1 && $mode != '2') {
                $data['message'] = '审核中，请耐心等待';
            } else {
                $data['message'] = '提交成功';
            }
            exit(json_encode($data));
        }
        $page   = $page > 0 ? $page : 1;
        $where  = "";
        $params = array();
        $psize  = 10;
        $list   = M('answer')->getList($page, $where, $params, $psize);
        if ($page > 1) {
            include $this->template('answer_detail_more');
            exit();
        }
        include $this->template('answer_detail');
    }
    public function doMobilemain()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'main';
        if ($_GPC['act'] == 'cancelSubscribeTip') {
            $_SESSION['cancelSubscribeTip'] = '1';
            exit(json_encode($data));
        }
        $theme          = trim($this->pro['theme']);
        $cid            = intval($_GPC['cid']);
        $page           = intval($_GPC['page']);
        $page           = $page > 0 ? $page : 1;
        $num1           = intval($this->pro['userNums']);
        $num1           = $num1 > 0 ? $num1 : 5;
        $num2           = intval($this->pro['questionNums']);
        $num2           = $num2 > 0 ? $num2 : 10;
        $hour2          = intval($this->pro['rebateHour2']);
        $members_menu   = M('topmenu')->getall(" AND ismain=1 AND page='find' ", array(), 'displayorder asc');
        $questions_menu = M('topmenu')->getall(" AND ismain=1 AND page!='find' ", array(), 'displayorder asc');
        include $this->template($theme . 'main');
    }
    public function doWebtopmenu()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'topmenu';
        $_GPC['menu'] = 'menu';
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data            = array();
                $data['uniacid'] = $_W['uniacid'];
                $data['title']   = trim($_GPC['title']);
                if (!empty($_GPC['page'])) {
                    $data['page'] = trim($_GPC['page']);
                }
                if (!empty($_GPC['type'])) {
                    $data['type'] = trim($_GPC['type']);
                }
                if (!empty($_GPC['cateid'])) {
                    $data['cateid'] = intval($_GPC['cateid']);
                }
                if (!empty($_GPC['link'])) {
                    $data['link'] = trim($_GPC['link']);
                }
                if (isset($_GPC['ismain'])) {
                    $data['ismain'] = intval($_GPC['ismain']);
                }
                if (isset($_GPC['onlymain'])) {
                    $data['onlymain'] = intval($_GPC['onlymain']);
                }
                $data['displayorder'] = intval($_GPC['displayorder']);
                $data['create_time']  = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                }
                M('topmenu')->update($data);
                message('保存成功', $this->createWebUrl('topmenu'), 'success');
            }
            $item = M('topmenu')->getInfo($id);
            include $this->template('topmenu_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                message('参数错误', referer(), 'error');
            }
            M('topmenu')->delete($id);
            message('删除成功', referer(), 'success');
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = "";
        $list  = M('topmenu')->getList($page);
        include $this->template('topmenu');
    }
    public function doWebquickmenu()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'quickmenu';
        $_GPC['menu'] = 'menu';
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data                 = array();
                $data['uniacid']      = $_W['uniacid'];
                $data['icon']         = trim($_GPC['icon']);
                $data['link']         = trim($_GPC['link']);
                $data['title']        = trim($_GPC['title']);
                $data['name']         = trim($_GPC['name']);
                $data['ido']          = trim($_GPC['ido']);
                $data['auth']         = intval($_GPC['auth']);
                $data['displayorder'] = intval($_GPC['displayorder']);
                $data['create_time']  = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                }
                M('quickmenu')->update($data);
                message('保存成功', $this->createWebUrl('quickmenu'), 'success');
            }
            $item = M('quickmenu')->getInfo($id);
            include $this->template('quickmenu_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                message('参数错误', referer(), 'error');
            }
            M('quickmenu')->delete($id);
            message('删除成功', referer(), 'success');
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = "";
        $list  = M('quickmenu')->getList($page);
        include $this->template('quickmenu');
    }
    public function doWeblink()
    {
        global $_W, $_GPC;
        $callback  = $_GPC['callback'];
        $runners   = array();
        $runners[] = array(
            'url' => $this->createMobileUrl('main'),
            'title' => '站点主页（推荐）'
        );
        $runners[] = array(
            'url' => $this->createMobileUrl('index'),
            'title' => '问题列表（推荐）'
        );
        $runners[] = array(
            'url' => $this->createMobileUrl('find'),
            'title' => '找专家（推荐）'
        );
        $runners[] = array(
            'url' => $this->createMobileUrl('home'),
            'title' => '个人中心（推荐）'
        );
        $runners[] = array(
            'url' => $this->createMobileUrl('task'),
            'title' => '悬赏问题列表'
        );
        $runners[] = array(
            'url' => $this->createMobileUrl('task_post'),
            'title' => '发布悬赏提问'
        );
        $runners[] = array(
            'url' => $this->createMobileUrl('income'),
            'title' => '我的收入'
        );
        $runners[] = array(
            'url' => $this->createMobileUrl('ask'),
            'title' => '我提问的'
        );
        $runners[] = array(
            'url' => $this->createMobileUrl('tutor_edit'),
            'title' => '专家认证'
        );
        $runners[] = array(
            'url' => $this->createMobileUrl('help'),
            'title' => '帮助说明'
        );
        include $this->template('link');
    }
    public function doMobileqiniu2mp3()
    {
        global $_W, $_GPC;
        $table   = trim($_GPC['table']);
        $id      = trim($_GPC['id']);
        $items   = M("" . $table)->getInfo($id);
        $__input = $_GPC['__input'];
        $item    = $__input['items'][0];
        $key     = $item['key'];
        if (!empty($key)) {
            $items['src'] = M('qiniu')->getUrl($key);
            M("" . $table)->update($items);
        } else {
        }
    }
    public function doMobileindex()
    {
        global $_W, $_GPC;
        $theme      = trim($this->pro['theme']);
        $_GPC['do'] = 'index';
        $cid        = intval($_GPC['cid']);
        $page       = intval($_GPC['page']);
        $page       = $page > 0 ? $page : 1;
        $hour2      = intval($this->pro['rebateHour2']);
        if (empty($_GPC['act'])) {
            $default = M('topmenu')->getDefaultMenu('index');
            $act     = empty($default['type']) ? "new" : $default['type'];
            $cid     = $act == 'spec' ? intval($default['cateid']) : 0;
        } else {
            $act = trim($_GPC['act']);
        }
        $cate['title'] = '全部';
        if ($act == 'recommend') {
            $questions = M('question')->getList($page, " AND isrecommend='1' AND open=1 AND status=2 ", array(), 5);
        } else if ($act == 'free') {
            if (!empty($this->pro['openFree']) && intval($this->pro['openFree']) > 0) {
                $freeWhere = " OR create_time>=" . (time() - intval($this->pro['openFree']) * 3600);
            }
            $questions = M('question')->getList($page, " AND (isfree=1{$freeWhere}) AND open=1 AND status = 2 ", array(), 5);
        } else if ($act == 'new') {
            $questions = M('question')->getList($page, " AND open=1 AND ((status = 2 AND istask='0') OR (status >0 AND istask='1')) ", array(), 5);
        } else if ($act == 'cate' || $act == 'spec') {
            if ($cid == '0') {
                $questions = M('question')->getList($page, " AND open=1 AND ((status = 2 AND istask='0') OR (status >0 AND istask='1')) ", array(), 5);
            } else {
                $cate      = M('category')->getInfo($cid);
                $questions = M('question')->getList($page, " AND open=1 AND ((status=2 AND istask='0') OR (status>0 AND istask='1')) AND category_id=:category_id ", array(
                    ':category_id' => $cid
                ), 5);
            }
        } else if ($act == 'task') {
            $questions = M('question')->getList($page, " AND open=1 AND status >0 AND istask='1' ", array(), 5);
        } else if ($act == 'extra') {
            $questions = M('question')->getList($page, " AND open=1 AND ((status = 2 AND istask='0') OR (status >0 AND istask='1')) ", array(), 5, 'listen_num desc');
        }
        if ($page > 1) {
            include $this->template($theme . 'index_more');
        } else {
            include $this->template($theme . 'index');
        }
    }
    public function doMobilefeed()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'home';
        $page       = intval($_GPC['page']);
        $page       = $page > 0 ? $page : 1;
        $questions  = M('question')->getFeedList($page, array(), 5, array(
            'from' => 'to_openid',
            'to' => 'to_openid',
            'follow' => 'openid'
        ));
        if ($page >= 2) {
            include $this->template('feed_more');
            exit();
        }
        include $this->template('feed');
    }
    public function doMobilerefeed()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'home';
        $page       = intval($_GPC['page']);
        $page       = $page > 0 ? $page : 1;
        $questions  = M('question')->getFeedList($page, array(), 5, array(
            'from' => 'openid',
            'to' => 'openid',
            'follow' => 'to_openid'
        ));
        if ($page >= 2) {
            include $this->template('feed_more');
            exit();
        }
        include $this->template('refeed');
    }
    public function doMobilefollow()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'home';
        $theme      = trim($this->pro['theme']);
        $page       = intval($_GPC['page']);
        $page       = $page > 0 ? $page : 1;
        $follows    = M('follow')->getList($page, " AND openid = :openid ", array(
            ':openid' => $_W['openid']
        ), 5);
        if ($page >= 2) {
            include $this->template('follow_more');
            exit();
        }
        include $this->template('follow');
    }
    public function doMobilefocus()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'home';
        $page       = intval($_GPC['page']);
        $page       = $page > 0 ? $page : 1;
        $follows    = M('follow')->getList($page, " AND to_openid = :openid ", array(
            ':openid' => $_W['openid']
        ), 5);
        if ($page >= 2) {
            include $this->template('focus_more');
            exit();
        }
        include $this->template('focus');
    }
    public function doMobilefind()
    {
        global $_W, $_GPC;
        $theme      = trim($this->pro['theme']);
        $_GPC['do'] = 'find';
        if (!empty($_GPC['orderby'])) {
            $orderby = trim($_GPC['orderby']);
        } else {
            $orderby = 'score';
        }
        $where      = "";
        $params     = array();
        $url_params = array();
        $cid        = intval($_GPC['cid']);
        if (empty($_GPC['act'])) {
            $default = M('topmenu')->getDefaultMenu('find');
            $act     = empty($default['type']) ? "new" : trim($default['type']);
            $cid     = $act == 'spec' ? intval($default['cateid']) : 0;
        } else {
            $act = trim($_GPC['act']);
        }
        $url_params['act'] = $act;
        $page              = intval($_GPC['page']);
        $page              = $page > 0 ? $page : 1;
        $_GPC['status']    = 3;
        $cate['title']     = '全部';
        if ($act == 'recommend') {
            $members = M('member')->getList($page, " AND isrecommend = '1' ", $params, 20, $orderby . " desc");
        } else if ($act == 'new') {
            $members = M('member')->getList($page, $where, $params, 20, 'create_time desc');
        } else if ($act == 'star') {
            $members = M('member')->getList($page, $where, $params, 20, 'score desc');
        } else if ($act == 'focus') {
            $members = M('member')->getList($page, $where, $params, 20, 'follow desc');
        } else if ($act == 'answers') {
            $members = M('member')->getList($page, $where, $params, 20, 'number desc');
        } else if ($act == 'cate' || $act == 'spec') {
            if ($cid != 0) {
                $cate = M('category')->getInfo($cid);
                $where .= " AND labels like '%," . $cid . ",%'";
                $url_params['cid'] = $cid;
            }
            $members = M('member')->getList($page, $where, $params, 20, $orderby . " desc");
        }
        if ($page >= 2) {
            include $this->template('find_more');
            exit();
        }
        include $this->template($theme . 'find');
    }
    public function doMobilefind_more()
    {
        global $_W, $_GPC;
        $_GPC['do']     = 'index';
        $page           = intval($_GPC['page']);
        $page           = $page > 0 ? $page : 1;
        $_GPC['status'] = 3;
        $cid            = intval($_GPC['cid']);
        $members        = $cid == '0' ? M('member')->getList($page, " ", array(), 20) : M('member')->getList($page, " AND category_id = :category_id ", array(
            ':category_id' => $cid
        ), 20);
        if (empty($members)) {
            include $this->template('empty');
        } else {
            include $this->template('members_more');
        }
    }
    public function doMobilemaking()
    {
        global $_W, $_GPC;
        $openid = trim($_GPC['openid']);
        $now    = M('member')->getInfo($_W['openid']);
        if ($this->pro['openMobileCehck'] == '1' && empty($now['mobile'])) {
            $url = $this->createMobileUrl('making', array(
                'openid' => $openid
            ));
            include $this->template('reg_phone');
            exit();
        }
        $_GPC['do'] = 'index';
        $act        = trim($_GPC['act']);
        if (empty($openid)) {
            $url = $this->createMobileUrl('tutor', array(
                'openid' => $_W['openid']
            ));
            header("location:$url");
            exit();
        }
        $member = M('member')->getInfo($openid);
        if ($act == 'saveQuestionContent') {
            $content                      = trim($_GPC['content']);
            $_SESSION['question_content'] = $content;
            $data                         = array();
            $data['status']               = 1;
            exit(json_encode($data));
        } else if ($act == 'post_question_success') {
            $question_id        = intval($_GPC['question_id']);
            $question           = M('question')->getInfo($question_id);
            $member             = M('member')->getInfo($question['openid']);
            $question['status'] = 1;
            M('question')->update($question);
            $url = $this->createMobileUrl('question', array(
                'id' => $question_id
            ));
            $url = str_replace('./', '', $url);
            $url = $_W['siteroot'] . 'app/' . $url;
            M('common')->createTplMessage($question['to_openid'], $this->msg['title1'], str_replace("{name}", $member['nickname'], $this->msg['content1']), $url, "");
            M('defray')->insert($question['credit'], $member['openid'], $question['sn'], '1', 1);
            $data           = array();
            $data['status'] = 1;
            exit(json_encode($data));
        } else if ($act == 'post_question') {
            if ($member['status'] != '3') {
                $data            = array();
                $data['status']  = 8;
                $data['message'] = '该用户未认证，不可进行提问！';
                exit(json_encode($data));
            }
            if ($member['openid'] == $_W['openid']) {
                $data            = array();
                $data['status']  = 8;
                $data['message'] = '不可对自己进行提问！';
                exit(json_encode($data));
            }
            $wOpt = $this->getowpt(floatval($member['credit']), '专家提问费用');
            $data = array();
            if (!empty($_GPC['title'])) {
                $data['title'] = trim($_GPC['title']);
            }
            $data['uniacid']     = $_W['uniacid'];
            $data['create_time'] = time();
            if (!empty($_GPC['open'])) {
                $data['open'] = intval($_GPC['open']);
            }
            if (!empty($_GPC['usePoint'])) {
                $data['usePoint'] = intval($_GPC['usePoint']);
            }
            if (!empty($_GPC['category_id'])) {
                $data['category_id'] = intval($_GPC['category_id']);
            }
            if (!empty($_GPC['images'])) {
                $images = $_GPC['images'];
                $image  = array();
                foreach ($images as $img) {
                    $image[] = M('common')->createWxImage($img, 'question');
                }
                $data['images'] = serialize($image);
            }
            $data['openid']    = $_W['openid'];
            $data['to_openid'] = $openid;
            $data['credit']    = floatval($member['credit']);
            $data['sn']        = $wOpt['tid'];
            $data['status']    = floatval($member['credit']) > 0 ? 0 : 1;
            $data['isfree']    = '0';
            if (!empty($_GPC['serverId'])) {
                $serverId         = trim($_GPC['serverId']);
                $data['voice_id'] = $serverId;
                $data['timelong'] = intval($_GPC['timelong']);
            }
            $question = M('question')->update($data);
            M('common')->createAudio('question', $question['id'], $serverId);
            $price = round(floatval($member['credit']) * floatval($this->pro['tutor_money']) / 100, 2);
            if (floatval($price) > 0) {
                M('paylog')->insert($price, $member['openid'], $wOpt['tid'], '1', $question['id']);
            }
            $data                = array();
            $data['status']      = 1;
            $data['role']        = 'fans';
            $data['appId']       = $wOpt['appId'];
            $data['timeStamp']   = $wOpt['timeStamp'];
            $data['nonceStr']    = $wOpt['nonceStr'];
            $data['package']     = $wOpt['package'];
            $data['signType']    = $wOpt['signType'];
            $data['paySign']     = $wOpt['paySign'];
            $data['question_id'] = $question['id'];
            $data['question']    = $question;
            $member['credit']    = floatval($member['credit']);
            if (floatval($member['credit']) <= 0) {
                $data['status'] = 2;
            }
            exit(json_encode($data));
        }
        include $this->template('making');
    }
    public function doMobilehelp()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'help';
        include $this->template('help');
    }
    public function doWebdefray()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'defray';
        $_GPC['menu'] = 'paylog';
        $act          = trim($_GPC['act']);
        if ($_GPC['act'] == 'mutdelete') {
            $ids = $_GPC['ids'];
            foreach ($ids as $id) {
                M('defray')->delete($id);
            }
            message('删除成功', referer(), 'success');
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    message('参数错误', referer(), 'error');
                }
            }
            M('defray')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                message('删除成功', referer(), 'success');
            }
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = "";
        $list  = M('defray')->getList($page, $where);
        include $this->template('defray');
    }
    public function doWebwithdraw()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'withdraw';
        $_GPC['menu'] = 'paylog';
        $act          = trim($_GPC['act']);
        if ($_GPC['act'] == 'mutdelete') {
            $ids = $_GPC['ids'];
            foreach ($ids as $id) {
                M('withdraw')->delete($id);
            }
            message('删除成功', referer(), 'success');
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    message('参数错误', referer(), 'error');
                }
            }
            M('withdraw')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                message('删除成功', referer(), 'success');
            }
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = "";
        $list  = M('withdraw')->getList($page, $where);
        include $this->template('withdraw');
    }
    public function doMobilehome()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'home';
        $theme      = trim($this->pro['theme']);
        $member     = M('member')->getInfo($_W['openid']);
        $credit     = M('paylog')->membertotalcredit(array(
            'to_openid' => $_W['openid']
        ));
        if ($member['status'] == 3) {
            include $this->template($theme . 'homet');
        } else {
            include $this->template($theme . 'homes');
        }
    }
    public function doWebfinish_paylog()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'finish_paylog';
        $_GPC['menu'] = 'paylog';
        $act          = trim($_GPC['act']);
        load()->model('mc');
        if ($act == 'finish') {
            $to_openid = trim($_GPC['to_openid']);
            $credit    = floatval($_GPC['credit']);
            if (!empty($this->pro['withdraw_deduct']) && intval($this->pro['withdraw_deduct']) > 0) {
                $credit = round($credit * (100 - intval($this->pro['withdraw_deduct'])) / 100, 2);
            }
            $type = trim($_GPC['type']);
            if ($type == 'wechat') {
                $member   = M('member')->getInfo($to_openid);
                $trade_no = random(32);
                $desc     = date('Y-m-d H:i') . "打款到微信钱包，" . $member['nickname'] . ":" . $credit . "元";
                $return   = M('finance')->pay($to_openid, $credit * 100, $trade_no, $desc);
                if (is_error($return)) {
                    message($return['message'], referer(), 'error');
                }
                pdo_update('yukiho_zvoice_paylog', array(
                    'status' => 2
                ), array(
                    'to_openid' => $to_openid,
                    'status' => 1
                ));
                $item['type']        = '1';
                $item['openid']      = $to_openid;
                $item['credit']      = $credit;
                $item['create_time'] = time();
                M('withdraw')->update($item);
            }
            if ($type == 'credit2') {
                $member   = M('member')->getInfo($to_openid);
                $trade_no = random(32);
                $desc     = date('Y-m-d H:i') . "打款到余额给" . $member['nickname'] . ":" . $credit . "元";
                $uid      = $member['uid'];
                if (empty($uid)) {
                    $uid = mc_openid2uid($to_openid);
                }
                if (empty($uid)) {
                    message("粉丝会员UID为空！打款到余额失败", referer(), 'error');
                }
                $log    = array(
                    $uid,
                    $desc,
                    'yukiho_zvoice',
                    0
                );
                $return = mc_credit_update($uid, 'credit2', $credit, $log);
                if (is_error($return)) {
                    message($return['message'], referer(), 'error');
                }
                pdo_update('yukiho_zvoice_paylog', array(
                    'status' => 2,
                    'mode' => 'admin'
                ), array(
                    'to_openid' => $to_openid,
                    'status' => 1
                ));
            }
            message('打款成功', $this->createWebUrl('finish_paylog'), 'success');
        }
        $sql    = "SELECT SUM(credit) as credit,to_openid FROM " . tablename('yukiho_zvoice_paylog') . " WHERE uniacid = :uniacid AND status = :status GROUP BY to_openid ORDER BY credit DESC";
        $params = array(
            ':uniacid' => $_W['uniacid'],
            ':status' => 1
        );
        $list   = pdo_fetchall($sql, $params);
        include $this->template('finish_paylog');
    }
    public function doMobilevisited()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'home';
        $page       = intval($_GPC['page']);
        $page       = $page > 0 ? $page : 1;
        $list       = M('listen_log')->getList($page, " AND openid = :openid ", array(
            ':openid' => $_W['openid']
        ), 5);
        $cid        = intval($_GPC['cid']);
        $logs       = $cid == '0' ? M('listen_log')->getList($page, " AND openid = :openid ", array(
            ':openid' => $_W['openid']
        ), 5) : M('listen_log')->getList($page, " AND openid = :openid AND question_id in (select id from " . tablename('yukiho_zvoice_question') . " where status=2 and open=1 and category_id=:category_id) ", array(
            ':openid' => $_W['openid'],
            ':category_id' => $cid
        ), 5);
        if ($page > 1) {
            include $this->template('visited_more');
            exit();
        }
        include $this->template('visited');
    }
    public function doMobileincome()
    {
        global $_W, $_GPC;
        $theme      = trim($this->pro['theme']);
        $_GPC['do'] = 'income';
        $act        = trim($_GPC['act']);
        if ($act == 'log') {
            $res = M('paylog')->getList(1, " AND credit>0 AND status>0 AND to_openid=:openid", array(
                'openid' => $_W['openid']
            ), 999);
            include $this->template($theme . 'income_log');
            exit();
        }
        if ($act == 'withdraw') {
            $res = M('withdraw')->getall(array(
                'openid' => $_W['openid']
            ));
            include $this->template($theme . 'income_withdraw');
            exit();
        }
        if ($act == 'payMe') {
            $to_openid = $_W['openid'];
            $sql       = "SELECT SUM(credit) as credit,to_openid FROM " . tablename('yukiho_zvoice_paylog') . " WHERE uniacid = :uniacid AND status = :status AND to_openid=:to_openid";
            $params    = array(
                ':uniacid' => $_W['uniacid'],
                ':status' => 1,
                ":to_openid" => $to_openid
            );
            $credit    = pdo_fetchcolumn($sql, $params);
            if (!empty($this->pro['withdraw_deduct']) && intval($this->pro['withdraw_deduct']) > 0) {
                $credit = round($credit * (100 - intval($this->pro['withdraw_deduct'])) / 100, 2);
            }
            $member   = M('member')->getInfo($to_openid);
            $trade_no = random(32);
            $desc     = date('Y-m-d H:i') . "打款到微信钱包，" . $member['nickname'] . ":" . $credit . "元";
            $return   = M('finance')->pay($to_openid, $credit * 100, $trade_no, $desc);
            if (is_error($return)) {
                $data['status']  = 2;
                $data['message'] = $return['message'];
                $data['type']    = 'error';
                exit(json_encode($data));
            }
            pdo_update('yukiho_zvoice_paylog', array(
                'status' => 2,
                'mode' => 'user'
            ), array(
                'to_openid' => $to_openid,
                'status' => 1
            ));
            $item['type']        = '2';
            $item['openid']      = $to_openid;
            $item['credit']      = $credit;
            $item['create_time'] = time();
            M('withdraw')->update($item);
            $data['status']  = 1;
            $data['message'] = '已成功提现金额' . $credit;
            $data['type']    = 'success';
            exit(json_encode($data));
        }
        $res    = M('paylog')->getList(1, " AND credit>0 AND status>0 AND to_openid=:openid", array(
            'openid' => $_W['openid']
        ), 999);
        $credit = M('paylog')->membertotalcredit(array(
            'to_openid' => $_W['openid']
        ));
        include $this->template($theme . 'income');
    }
    public function doWebanswer()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'answer';
        $_GPC['menu'] = 'zvoice';
        $where        = "";
        if ($_GPC['act'] == 'to_question') {
            $where .= " AND question_id='" . $_GPC['question_id'] . "' ";
        }
        if ($_GPC['act'] == 'pass') {
            $data           = array();
            $data['id']     = intval($_GPC['id']);
            $data['status'] = '1';
            $answer         = M('answer')->update($data);
            $url            = $this->createMobileUrl('question', array(
                'id' => $answer['question_id']
            ));
            $url            = str_replace('./', '', $url);
            $url            = $_W['siteroot'] . 'app/' . $url;
            M('common')->createTplMessage($answer['openid'], '审核通过通知', "恭喜，您的内容已经审核通过了哦！ 点击查看详情。", $url, '');
            message('审核通过', $this->createWebUrl('answer'), 'success');
        }
        if ($_GPC['act'] == 'mutdelete') {
            $ids = $_GPC['ids'];
            foreach ($ids as $id) {
                M('answer')->delete($id);
            }
            message('删除成功', referer(), 'success');
        }
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data            = array();
                $data['uniacid'] = $_W['uniacid'];
                if (isset($_GPC['openid'])) {
                    $data['openid'] = trim($_GPC['openid']);
                }
                if (isset($_GPC['question_id'])) {
                    $data['question_id'] = trim($_GPC['question_id']);
                }
                if (isset($_GPC['contents'])) {
                    $data['contents'] = trim($_GPC['contents']);
                }
                if (isset($_GPC['ispick'])) {
                    $data['ispick'] = intval($_GPC['ispick']);
                }
                if (isset($_GPC['src'])) {
                    $data['src'] = tomedia(trim($_GPC['src']));
                }
                if (isset($_GPC['timelong'])) {
                    $data['timelong'] = trim($_GPC['timelong']);
                }
                if (isset($_GPC['weblink'])) {
                    $data['weblink'] = trim($_GPC['weblink']);
                }
                if (isset($_GPC['mode'])) {
                    $data['mode'] = intval($_GPC['mode']);
                }
                if (!empty($_GPC['images'])) {
                    $images = $_GPC['images'];
                    $image  = array();
                    foreach ($images as $img) {
                        $base64  = 'data:image/jpeg;base64,' . base64_encode(file_get_contents(tomedia($img)));
                        $image[] = M('common')->createImage($base64);
                    }
                    $data['images'] = serialize($image);
                }
                $data['status']      = '1';
                $data['create_time'] = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                    $question = M('answer')->update($data);
                } else {
                    $question = M('answer')->update($data);
                }
                message('保存成功', $this->createWebUrl('answer'), 'success');
            }
            $item = M('answer')->getInfo($id);
            include $this->template('answer_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    message('参数错误', referer(), 'error');
                }
            }
            M('answer')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                message('删除成功', referer(), 'success');
            }
        }
        $page = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $list = M('answer')->getList($page, $where);
        include $this->template('answer');
    }
    public function doWebslider()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'slider';
        $_GPC['menu'] = 'zvoice';
        if ($_GPC['act'] == 'mutdelete') {
            $ids = $_GPC['ids'];
            foreach ($ids as $id) {
                M('slider')->delete($id);
            }
            message('删除成功', referer(), 'success');
        }
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data            = array();
                $data['uniacid'] = $_W['uniacid'];
                if (isset($_GPC['title'])) {
                    $data['title'] = trim($_GPC['title']);
                }
                if (!empty($_GPC['image'])) {
                    $data['image'] = tomedia(trim($_GPC['image']));
                }
                if (isset($_GPC['link'])) {
                    $data['link'] = trim($_GPC['link']);
                }
                if (isset($_GPC['status'])) {
                    $data['status'] = intval($_GPC['status']);
                }
                if (isset($_GPC['dsporder'])) {
                    $data['dsporder'] = intval($_GPC['dsporder']);
                }
                $data['create_time'] = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                    $question = M('slider')->update($data);
                } else {
                    $question = M('slider')->update($data);
                }
                message('保存成功', $this->createWebUrl('slider'), 'success');
            }
            $item = M('slider')->getInfo($id);
            include $this->template('slider_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    message('参数错误', referer(), 'error');
                }
            }
            M('slider')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                message('删除成功', referer(), 'success');
            }
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = "";
        $list  = M('slider')->getList($page, $where);
        include $this->template('slider');
    }
    public function doWebhelp()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'help';
        $_GPC['menu'] = 'zvoice';
        if ($_GPC['act'] == 'mutdelete') {
            $ids = $_GPC['ids'];
            foreach ($ids as $id) {
                M('help')->delete($id);
            }
            message('删除成功', referer(), 'success');
        }
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data            = array();
                $data['uniacid'] = $_W['uniacid'];
                if (isset($_GPC['title'])) {
                    $data['title'] = trim($_GPC['title']);
                }
                if (isset($_GPC['contents'])) {
                    $data['contents'] = trim($_GPC['contents']);
                }
                if (isset($_GPC['dsporder'])) {
                    $data['dsporder'] = intval($_GPC['dsporder']);
                }
                $data['create_time'] = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                    $question = M('help')->update($data);
                } else {
                    $question = M('help')->update($data);
                }
                message('保存成功', $this->createWebUrl('help'), 'success');
            }
            $item = M('help')->getInfo($id);
            include $this->template('help_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    message('参数错误', referer(), 'error');
                }
            }
            M('help')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                message('删除成功', referer(), 'success');
            }
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = "";
        $list  = M('help')->getList($page, $where);
        include $this->template('help');
    }
    public function doMobileanswer()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'home';
        $cid        = intval($_GPC['cid']);
        $page       = intval($_GPC['page']);
        $page       = $page > 0 ? $page : 1;
        $questions  = $cid == '0' ? M('question')->getList($page, " AND to_openid = :to_openid AND status != 0 ", array(
            ':to_openid' => $_W['openid']
        ), 5) : M('question')->getList($page, " AND to_openid = :to_openid AND category_id=:category_id AND status != 0 ", array(
            ':to_openid' => $_W['openid'],
            ':category_id' => $cid
        ), 5);
        if ($page >= 2) {
            include $this->template('answer_more');
            exit();
        }
        include $this->template('answer');
    }
    public function doMobileask()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'ask';
        $hour1      = intval($this->pro['rebateHour1']);
        $hour2      = intval($this->pro['rebateHour2']);
        $cid        = intval($_GPC['cid']);
        $page       = intval($_GPC['page']);
        $page       = $page > 0 ? $page : 1;
        $questions  = $cid == '0' ? M('question')->getList($page, " AND openid = :openid AND status>0 ", array(
            ':openid' => $_W['openid']
        ), 5) : M('question')->getList($page, " AND openid = :openid AND category_id=:category_id AND status>0 ", array(
            ':openid' => $_W['openid'],
            ':category_id' => $cid
        ), 5);
        if ($page >= 2) {
            include $this->template('ask_more');
            exit();
        }
        include $this->template('ask');
    }
    public function doMobilemyqrcode()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'myqrcode';
        include $this->template('myqrcode');
    }
    public function doMobiletutor_edit()
    {
        global $_W, $_GPC;
        $theme      = trim($this->pro['theme']);
        $_GPC['do'] = 'tutor_edit';
        $member     = M('member')->getInfo($_W['openid']);
        if ($_W['ispost']) {
            if (!empty($_GPC['realname'])) {
                $member['realname'] = trim($_GPC['realname']);
            }
            if (!empty($_GPC['tags'])) {
                $member['tags'] = trim($_GPC['tags']);
            }
            if (!empty($_GPC['sex'])) {
                $member['sex'] = intval($_GPC['sex']);
            }
            if (!empty($_GPC['desc'])) {
                $member['desc'] = trim($_GPC['desc']);
            }
            if (isset($_GPC['credit'])) {
                $member['credit'] = floatval($_GPC['credit']);
            }
            if (!empty($_GPC['avatar'])) {
                $member['avatar'] = M('common')->createWxImage($_GPC['avatar'], 'avatar');
            }
            if (!empty($_GPC['labels'])) {
                $member['labels'] = trim($_GPC['labels']);
            }
            if (!empty($_GPC['images'])) {
                $images = $_GPC['images'];
                $image  = array();
                if (!empty($images)) {
                    foreach ($images as $img) {
                        $image[] = M('common')->createWxImage($img, 'certify');
                    }
                }
                $member['certify'] = serialize($image);
            }
            $member['status'] = 1;
            M('member')->update_or_insert($member);
            $list = M('member')->getall(array(
                'admin' => '1'
            ));
            foreach ($list as $item) {
                M('common')->createTplMessage($item['openid'], $this->msg['title5'], str_replace("{name}", $member['nickname'], $this->msg['content5']), "", "");
            }
            $data            = array();
            $data['status']  = 1;
            $data['message'] = '提交成功';
            exit(json_encode($data));
        }
        include $this->template($theme . 'tutor_edit');
    }
    public function doMobilehome_edit()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'home';
        $theme      = trim($this->pro['theme']);
        $member     = M('member')->getInfo($_W['openid']);
        if ($_W['ispost']) {
            if (!empty($_GPC['nickname'])) {
                $member['nickname'] = trim($_GPC['nickname']);
            }
            if (!empty($_GPC['mobile'])) {
                $member['mobile'] = trim($_GPC['mobile']);
            }
            if (!empty($_GPC['avatar'])) {
                $member['avatar'] = M('common')->createWxImage($_GPC['avatar'], 'avatar');
            }
            if (!empty($_GPC['image'])) {
                $member['home_cover'] = serialize(M('common')->createWxImage($_GPC['image'], 'cover'));
            }
            M('member')->update_or_insert($member);
            $data            = array();
            $data['status']  = 1;
            $data['message'] = '提交成功';
            exit(json_encode($data));
        }
        include $this->template($theme . 'home_edit');
    }
    public function doMobileanswer_detail()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'index';
        $act        = trim($_GPC['act']);
        $id         = intval($_GPC['id']);
        $question   = M('question')->getInfo($id);
        if ($question['status'] == 0) {
            message('该问题未完成支付', referer(), 'error');
        }
        $member    = M('member')->getInfo($question['openid']);
        $to_member = M('member')->getInfo($question['to_openid']);
        $page      = intval($_GPC['page']);
        $answerer  = M('member')->getInfo($_W['openid']);
        if ($act == 'reanswer') {
            if ($question['status'] == 0) {
                $data            = array();
                $data['status']  = 0;
                $data['message'] = '该问题未完成支付';
                exit(json_encode($data));
            }
            $serverId            = trim($_GPC['serverId']);
            $mode                = trim($_GPC['mode']);
            $timelong            = intval($_GPC['timelong']);
            $data                = array();
            $data['question_id'] = $id;
            $data['uniacid']     = $_W['uniacid'];
            $data['create_time'] = time();
            $data['openid']      = $_W['openid'];
            $answerVerify        = $this->pro['answerVerify'];
            if ($answerVerify == 1) {
                $data['status'] = 0;
            } else {
                $data['status'] = 1;
            }
            if ('voice' == $mode) {
                $data['mode']     = '0';
                $data['voice_id'] = $serverId;
                $data['timelong'] = $timelong;
            } else if ('text' == $mode) {
                $data['mode'] = '1';
                if (!empty($_GPC['contents'])) {
                    $data['contents'] = trim($_GPC['contents']);
                }
                if (!empty($_GPC['weblink'])) {
                    $data['weblink'] = trim($_GPC['weblink']);
                }
                if (!empty($_GPC['images'])) {
                    $images = $_GPC['images'];
                    $image  = array();
                    if (!empty($images)) {
                        foreach ($images as $img) {
                            $pic     = M('common')->createWxImage($img, 'answer');
                            $image[] = $pic;
                        }
                    }
                    $data['images'] = serialize($image);
                }
            } else if ('feedback' == $mode) {
                if (!empty($_GPC['feedback'])) {
                    $question['feedback'] = trim($_GPC['feedback']);
                }
                if (!empty($_GPC['score'])) {
                    $question['score'] = intval($_GPC['score']);
                }
                $question['status'] = 2;
                M('question')->update($question);
                $url = $this->createMobileUrl('question', array(
                    'id' => $question['id']
                ));
                $url = str_replace('./', '', $url);
                $url = $_W['siteroot'] . 'app/' . $url;
                M('common')->createTplMessage($question['to_openid'], $this->msg['title6'], $this->msg['content6'], $url, "");
                $to_member['score'] = M('question')->getscore($to_member['openid']);
                M('member')->update_or_insert($to_member);
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '评价成功';
                exit(json_encode($data));
            }
            M('paylog')->finish($question['sn']);
            $answer = M('answer')->update($data);
            $url    = $this->createMobileUrl('question', array(
                'id' => $id
            ));
            $url    = str_replace('./', '', $url);
            $url    = $_W['siteroot'] . 'app/' . $url;
            if ('voice' == $mode) {
                M('common')->createAudio('answer', $answer['id'], $serverId);
            }
            if ($question['to_openid'] == $_W['openid']) {
                M('common')->createTplMessage($question['openid'], $this->msg['title4'], $this->msg['content4'], $url, "");
            }
            if ($question['openid'] == $answer['openid']) {
                M('common')->createTplMessage($question['to_openid'], $this->msg['title7'], $this->msg['content7'], $url, "");
            }
            $question['status'] = 2;
            M('question')->update($question);
            $answerer['number'] = M('answer')->getAnsTotal(array(
                'openid' => $answerer['openid']
            ));
            M('member')->update_or_insert($answerer);
            $data           = array();
            $data['status'] = 1;
            if ($answerVerify == 1 && $mode != '2') {
                $data['message'] = '审核中，请耐心等待';
            } else {
                $data['message'] = '提交成功';
            }
            exit(json_encode($data));
        }
        $page   = $page > 0 ? $page : 1;
        $where  = "";
        $params = array();
        $psize  = 10;
        $list   = M('answer')->getList($page, $where, $params, $psize);
        if ($page > 1) {
            include $this->template('answer_detail_more');
            exit();
        }
        include $this->template('answer_detail');
    }
    public function doMobiletutor()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'find';
        $theme      = trim($this->pro['theme']);
        $act        = trim($_GPC['act']);
        $openid     = trim($_GPC['openid']);
        $member     = M('member')->getInfo($openid);
        $page       = intval($_GPC['page']);
        $page       = $page > 0 ? $page : 1;
        $questions  = M('question')->getMyQuestions($page, $openid);
        if ($page >= 2) {
            include $this->template($theme . 'tutor_more');
            exit();
        }
        include $this->template($theme . 'tutor');
    }
    public function wechat_build($params, $wechat)
    {
        global $_W;
        load()->func('communication');
        if (empty($wechat['version']) && !empty($wechat['signkey'])) {
            $wechat['version'] = 1;
        }
        $wOpt = array();
        if ($wechat['version'] == 1) {
            $wOpt['appId']               = $wechat['appid'];
            $wOpt['timeStamp']           = TIMESTAMP;
            $wOpt['nonceStr']            = random(8);
            $package                     = array();
            $package['bank_type']        = 'WX';
            $package['body']             = $params['title'];
            $package['attach']           = $wechat['uniacid'];
            $package['partner']          = $wechat['partner'];
            $package['out_trade_no']     = $params['uniontid'];
            $package['total_fee']        = $params['fee'] * 100;
            $package['fee_type']         = '1';
            $package['notify_url']       = $_W['siteroot'] . 'payment/wechat/notify.php';
            $package['spbill_create_ip'] = CLIENT_IP;
            $package['time_start']       = date('YmdHis', TIMESTAMP);
            $package['time_expire']      = date('YmdHis', TIMESTAMP + 600);
            $package['input_charset']    = 'UTF-8';
            ksort($package);
            $string1 = '';
            foreach ($package as $key => $v) {
                if (empty($v)) {
                    continue;
                }
                $string1 .= "{$key}={$v}&";
            }
            $string1 .= "key={$wechat['key']}";
            $sign    = strtoupper(md5($string1));
            $string2 = '';
            foreach ($package as $key => $v) {
                $v = urlencode($v);
                $string2 .= "{$key}={$v}&";
            }
            $string2 .= "sign={$sign}";
            $wOpt['package'] = $string2;
            $string          = '';
            $keys            = array(
                'appId',
                'timeStamp',
                'nonceStr',
                'package',
                'appKey'
            );
            sort($keys);
            foreach ($keys as $key) {
                $v = $wOpt[$key];
                if ($key == 'appKey') {
                    $v = $wechat['signkey'];
                }
                $key = strtolower($key);
                $string .= "{$key}={$v}&";
            }
            $string           = rtrim($string, '&');
            $wOpt['signType'] = 'SHA1';
            $wOpt['paySign']  = sha1($string);
            return $wOpt;
        } else {
            $package                     = array();
            $package['appid']            = $wechat['appid'];
            $package['mch_id']           = $wechat['mchid'];
            $package['nonce_str']        = random(32);
            $package['body']             = $params['title'];
            $package['attach']           = $wechat['uniacid'];
            $package['out_trade_no']     = $params['uniontid'];
            $package['total_fee']        = $params['fee'] * 100;
            $package['spbill_create_ip'] = CLIENT_IP;
            $package['time_start']       = date('YmdHis', TIMESTAMP);
            $package['time_expire']      = date('YmdHis', TIMESTAMP + 600);
            $package['notify_url']       = $_W['siteroot'] . 'payment/wechat/notify.php';
            $package['trade_type']       = 'JSAPI';
            $package['openid']           = !empty($_W['yukiho_zvoice_openid']) ? $_W['yukiho_zvoice_openid'] : $_W['openid'];
            ksort($package, SORT_STRING);
            $string1 = '';
            foreach ($package as $key => $v) {
                if (empty($v)) {
                    continue;
                }
                $string1 .= "{$key}={$v}&";
            }
            $string1 .= "key={$wechat['signkey']}";
            $package['sign'] = strtoupper(md5($string1));
            $dat             = array2xml($package);
            $response        = ihttp_request('https://api.mch.weixin.qq.com/pay/unifiedorder', $dat);
            if (is_error($response)) {
                return $response;
            }
            $xml = @isimplexml_load_string($response['content'], 'SimpleXMLElement', LIBXML_NOCDATA);
            if (strval($xml->return_code) == 'FAIL') {
                return error(-1, strval($xml->return_msg));
            }
            if (strval($xml->result_code) == 'FAIL') {
                return error(-1, strval($xml->err_code) . ': ' . strval($xml->err_code_des));
            }
            $prepayid          = $xml->prepay_id;
            $wOpt['appId']     = $wechat['appid'];
            $wOpt['timeStamp'] = TIMESTAMP;
            $wOpt['nonceStr']  = random(8);
            $wOpt['package']   = 'prepay_id=' . $prepayid;
            $wOpt['signType']  = 'MD5';
            ksort($wOpt, SORT_STRING);
            $string = "";
            foreach ($wOpt as $key => $v) {
                $string .= "{$key}={$v}&";
            }
            $string .= "key={$wechat['signkey']}";
            $wOpt['paySign'] = strtoupper(md5($string));
            return $wOpt;
        }
    }
    public function logging_run($log, $type = 'normal')
    {
        global $_W;
        $filename = IA_ROOT . '/addons/' . $this->modulename . '/' . $_W['uniacid'] . '/log.log';
        load()->func('logging');
        load()->func('file');
        mkdirs(dirname($filename));
        $logFormat = "%date %type %user %url %rc";
        if (!empty($GLOBALS['_POST'])) {
            $context[] = logging_implode($GLOBALS['_POST']);
        }
        if (is_array($log)) {
            $context[] = logging_implode($log);
        } else {
            $context[] = preg_replace('/[ \t\r\n]+/', ' ', $log);
        }
        $log = str_replace(explode(' ', $logFormat), array(
            '[' . date('Y-m-d H:i:s', $_W['timestamp']) . ']',
            $type,
            $_W['username'],
            $_SERVER["PHP_SELF"] . "?" . $_SERVER["QUERY_STRING"],
            implode("\n", $context)
        ), $logFormat);
        file_put_contents($filename, $log . "\r\n", FILE_APPEND);
        return true;
    }
    public function getowpt($credit, $title)
    {
        global $_W;
        load()->model('payment');
        if (!empty($credit)) {
            if ($this->pro['open_pay'] == 1) {
                $setting = uni_setting($_W['account']['oauth']['acid'], array(
                    'payment'
                ));
            } else {
                $setting = uni_setting($_W['uniacid'], array(
                    'payment'
                ));
            }
            $wechat = $setting['payment']['wechat'];
            if (empty($wechat)) {
                $data            = array();
                $data['status']  = 8;
                $data['message'] = '微信支付配置错误';
                exit(json_encode($data));
            }
            if (empty($wechat['account'])) {
                $data            = array();
                $data['status']  = 8;
                $data['message'] = '支付账户不存在或已删除';
                exit(json_encode($data));
            }
            $sql = 'SELECT `key`,`secret` FROM ' . tablename('account_wechats') . ' WHERE `acid`=:acid';
            $row = pdo_fetch($sql, array(
                ':acid' => $wechat['account']
            ));
            if (empty($row)) {
                $data            = array();
                $data['status']  = 8;
                $data['message'] = '支付账户不存在或已删除';
                exit(json_encode($data));
            }
            $wechat['appid']   = $row['key'];
            $wechat['secret']  = $row['secret'];
            $wechat['uniacid'] = $wechat['account'];
            $tid               = random(32);
            $uniontid          = date('YmdHis') . random(8, 1);
            $params            = array(
                'tid' => $tid,
                'fee' => $credit,
                'user' => $_W['yukiho_zvoice_openid'],
                'title' => urldecode($title),
                'uniontid' => $uniontid
            );
            $wOpt              = $this->wechat_build($params, $wechat);
            $wOpt['tid']       = $tid;
            $wOpt['fee']       = $credit;
        } else {
            $tid         = random(32);
            $wOpt['tid'] = $tid;
            $wOpt['fee'] = $credit;
        }
        return $wOpt;
    }
    public function doWebmsg_template()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'msg_template';
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data            = array();
                $data['uniacid'] = $_W['uniacid'];
                if (!empty($_GPC['title'])) {
                    $data['title'] = trim($_GPC['title']);
                }
                if (!empty($_GPC['link'])) {
                    $data['link'] = trim($_GPC['link']);
                }
                if (!empty($_GPC['image'])) {
                    $data['image'] = tomedia(trim($_GPC['image']));
                }
                if (!empty($_GPC['position'])) {
                    $data['position'] = trim($_GPC['position']);
                }
                $data['time'] = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                }
                M('advs')->update($data);
                $this->message('保存成功', $this->createWebUrl('advs'), 'success');
            }
            $item = M('advs')->getInfo($id);
            include $this->template('advs_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    message('参数错误', referer(), 'error');
                }
            }
            M('advs')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                message('删除成功', referer(), 'success');
            }
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = "";
        $list  = M('advs')->getList($page, $where);
        include $this->template('advs');
    }
    public function doMobilesearchq()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'searchq';
        $hour2      = intval($this->pro['rebateHour2']);
        $key        = trim($_GPC['key']);
        $page       = intval($_GPC['page']);
        $page       = $page > 0 ? $page : 1;
        $where      = "";
        if (!empty($key)) {
            $where .= " AND title like '%{$key}%'";
        }
        $questions = M('question')->getList($page, $where, array(), 20);
        if ($page > 1 && !empty($key)) {
            include $this->template('searchq_more');
            exit();
        }
        include $this->template('searchq');
    }
    public function doMobilesearchm()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'searchm';
        $key        = trim($_GPC['key']);
        $page       = intval($_GPC['page']);
        $page       = $page > 0 ? $page : 1;
        $where      = "";
        if (!empty($key)) {
            $where .= " AND status='3' AND (nickname like '%{$key}%' OR tags like '%{$key}%' OR `desc` like '%{$key}%') ";
        }
        $params  = array();
        $members = M('member')->getList($page, $where, $params, 6);
        if ($page > 1 && !empty($key)) {
            include $this->template('searchm_more');
            exit();
        }
        include $this->template('searchm');
    }
    public function doMobilecategory_all()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'category_all';
        $act        = trim($_GPC['act']);
        include $this->template('category_all');
    }
    public function doMobilecategory()
    {
        global $_W, $_GPC;
        $_GPC['do']  = 'category';
        $category_id = intval($_GPC['category_id']);
        $category    = M('category')->getInfo($category_id);
        $page        = intval($_GPC['page']);
        $page        = $page > 0 ? $page : 1;
        $members     = M('member')->getList($page, " AND category_id = :category_id ", array(
            ':category_id' => $category_id
        ), 5);
        if ($page > 1) {
            include $this->template('category_more');
            exit();
        }
        include $this->template('category');
    }
    public function doWeblisten_log()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'listen_log';
        $_GPC['menu'] = 'zvoice';
        $question_id  = intval($_GPC['question_id']);
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data                = array();
                $data['uniacid']     = $_W['uniacid'];
                $data['create_time'] = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                }
                M('listen_log')->update($data);
                message('保存成功', $this->createWebUrl('listen_log'), 'success');
            }
            $item = M('listen_log')->getInfo($id);
            include $this->template('listen_log_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    message('参数错误', referer(), 'error');
                }
            }
            M('listen_log')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                message('删除成功', referer(), 'success');
            }
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = "";
        $list  = M('listen_log')->getList($page, $where);
        include $this->template('listen_log');
    }
    public function doMobilequestion()
    {
        global $_W, $_GPC;
        $act         = trim($_GPC['act']);
        $_GPC['do']  = 'index';
        $id          = intval($_GPC['id']);
        $theme       = trim($this->pro['theme']);
        $random_num  = intval($this->pro['openRelatedListNum']);
        $random_num  = $random_num > 0 ? $random_num : 5;
        $answer_id   = intval($_GPC['answer_id']);
        $type        = trim($_GPC['type']);
        $this_answer = M('answer')->getInfo($answer_id);
        $question    = M('question')->getInfoSpec($id);
        $randoms     = M('question')->getRandomList($id, $random_num);
        if (empty($question)) {
            $msg = '问题不存在或已删除！';
            include $this->template('noverify');
            exit();
        }
        $member   = M('member')->getInfo($question['openid']);
        $answer   = M('member')->getInfo($question['to_openid']);
        $credit   = floatval($this->pro['listen_price']);
        $pro      = M('setting')->getSetting('pro');
        $template = M('setting')->getSetting('template');
        if ($act == 'cancel') {
            $data     = array();
            $trade_no = random(32);
            $credit   = floatval($question['credit']);
            if ($credit >= 1) {
                $desc   = date('Y-m-d H:i') . "退款到微信钱包，" . $member['nickname'] . ":" . $credit . "元";
                $return = M('finance')->pay($question['openid'], $credit * 100, $trade_no, $desc);
                if (!is_error($return)) {
                    $question['status'] = 0;
                    M('question')->update($question);
                    M('common')->createTplMessage($question['openid'], "取消提问通知", "您已成功取消提问，提问费用已全额退款，请在微信钱包中查看", "", "");
                    $data['status']  = 1;
                    $data['message'] = '取消提问成功';
                    $data['type']    = 'success';
                } else {
                    logging_run('提问费用退款失败，错误信息:' . $return['message']);
                    $data['status']  = 2;
                    $data['message'] = $return['message'];
                    $data['type']    = 'error';
                }
            } else {
                $question['status'] = 0;
                M('question')->update($question);
                M('common')->createTplMessage($question['openid'], "取消提问通知", "您已成功取消提问，如有问题请咨询平台客服。", "", "");
                $data['status']  = 1;
                $data['message'] = '取消提问成功';
                $data['type']    = 'success';
            }
            exit(json_encode($data));
        }
        if ($act == 'answer') {
            $serverId            = trim($_GPC['serverId']);
            $timelong            = intval($_GPC['timelong']);
            $data                = array();
            $data['uniacid']     = $_W['uniacid'];
            $data['create_time'] = time();
            $data['openid']      = $_W['openid'];
            $data['question_id'] = $id;
            $data['voice_id']    = $serverId;
            $data['timelong']    = $timelong;
            if (!empty($_GPC['contents'])) {
                $data['contents'] = trim($_GPC['contents']);
            }
            if (!empty($_GPC['images'])) {
                $data['images'] = serialize($_GPC['images']);
            }
            $answer = M('answer')->update($data);
            M('common')->createAudio('answer', $answer['id'], $serverId);
            if ($question['to_openid'] == $_W['openid']) {
                $url = $this->createMobileUrl('question', array(
                    'id' => $id
                ));
                $url = str_replace('./', '', $url);
                $url = $_W['siteroot'] . 'app/' . $url;
                M('common')->createTplMessage($question['openid'], $this->msg['title4'], $this->msg['content4'], $url, "");
                $question['voice_id'] = $serverId;
                $question['timelong'] = $timelong;
                $question['status']   = 2;
                $question['isweixin'] = 0;
                M('question')->update($question);
            }
            $data            = array();
            $data['status']  = 1;
            $data['message'] = '提交成功';
            exit(json_encode($data));
        }
        if ($act == 'reward_success') {
            $reward_id = intval($_GPC['reward_id']);
            $reward    = M('reward')->getInfo($reward_id);
            if (empty($reward)) {
                $data           = array();
                $data['status'] = -1;
                exit(json_encode($data));
            }
            $com_url = referer();
            $url     = $_W['siteurl'];
            if ($com_url == $url) {
                M('paylog')->finish($reward['sn']);
                $reward['status'] = 1;
                M('reward')->update($reward);
                $user = M('member')->getInfo($_W['openid']);
                $url  = $this->createMobileUrl('question', array(
                    'id' => $id
                ));
                $url  = str_replace('./', '', $url);
                $url  = $_W['siteroot'] . 'app/' . $url;
                $data = array();
                exit(json_encode($data));
            }
        }
        if ($act == 'reward') {
            $credit = floatval($_GPC['credit']);
            $wOpt   = $this->getowpt($credit, '打赏费用');
            if (is_error($wOpt)) {
                $data            = array();
                $data['status']  = 8;
                $data['message'] = $wOpt['message'];
                exit(json_encode($data));
            }
            $reward_money = round(floatval($credit) * floatval($pro['reward_money']) / 100, 2);
            M('paylog')->insert($reward_money, $question['to_openid'], $wOpt['tid'], '4', $question['id']);
            $data                  = array();
            $data['status']        = 1;
            $data['role']          = 'fans';
            $data['appId']         = $wOpt['appId'];
            $data['timeStamp']     = $wOpt['timeStamp'];
            $data['nonceStr']      = $wOpt['nonceStr'];
            $data['package']       = $wOpt['package'];
            $data['signType']      = $wOpt['signType'];
            $data['paySign']       = $wOpt['paySign'];
            $reward                = array();
            $reward['uniacid']     = $_W['uniacid'];
            $reward['create_time'] = time();
            $reward['openid']      = $_W['openid'];
            $reward['question_id'] = $id;
            $reward['credit']      = $credit;
            $reward['status']      = 0;
            $reward['free_num']    = intval($credit / 1);
            $reward['sn']          = $wOpt['tid'];
            $r                     = M('reward')->update($reward);
            $data['reward_id']     = $r['id'];
            exit(json_encode($data));
        }
        if ($act == 'paySuccess') {
            $listen_id = intval($_GPC['listen_id']);
            if (empty($listen_id)) {
                $data            = array();
                $data['status']  = 0;
                $data['message'] = '参数错误';
                exit(json_encode($data));
            }
            $listen_log = M('listen_log')->getInfo($listen_id);
            if (empty($listen_log)) {
                $data            = array();
                $data['status']  = 0;
                $data['message'] = '参数错误';
                exit(json_encode($data));
            }
            $com_url = referer();
            $url     = $_W['siteurl'];
            M('paylog')->finish($listen_log['sn']);
            M('defray')->insert($listen_log['credit'], $listen_log['openid'], $listen_log['sn'], '2', 1);
            $listen_log['status'] = 1;
            M('listen_log')->update($listen_log);
            $user      = M('member')->getInfo($_W['openid']);
            $url       = $this->createMobileUrl('question', array(
                'id' => $id
            ));
            $url       = str_replace('./', '', $url);
            $url       = $_W['siteroot'] . 'app/' . $url;
            $learnName = $template['learnName'];
            $p         = round(floatval($listen_log['credit']) * floatval($this->pro['listen_get_price']) / 100, 2);
            M('common')->createTplMessage($question['openid'], $this->msg['title8'], str_replace("{credit}", $p, $this->msg['content8']), $url, "");
            $p = round(floatval($listen_log['credit']) * floatval($this->pro['listen_get_price2']) / 100, 2);
            M('common')->createTplMessage($question['to_openid'], $this->msg['title8'], str_replace("{credit}", $p, $this->msg['content8']), $url, "");
            $question['listen_num'] = M('listen_log')->gettotal($question['id']);
            M('question')->update($question);
            $data             = array();
            $data['status']   = 1;
            $data['role']     = 'fans';
            $data['isweixin'] = 0;
            $data['src']      = $this_answer['src'];
            exit(json_encode($data));
        }
        if ($act == 'repay') {
            $listen_log = M('listen_log')->getOpenid($id, $_W['openid']);
            if (empty($listen_log)) {
                $wOpt = $this->getowpt($credit, '学习费用');
                if (is_error($wOpt)) {
                    $data            = array();
                    $data['status']  = 8;
                    $data['message'] = $wOpt['message'];
                    exit(json_encode($data));
                }
                $p1 = round(floatval($credit) * floatval($this->pro['listen_get_price']) / 100, 2);
                M('paylog')->insert($p1, $question['openid'], $wOpt['tid'], '3', $id);
                $p2 = round(floatval($credit) * floatval($this->pro['listen_get_price2']) / 100, 2);
                M('paylog')->insert($p2, $question['to_openid'], $wOpt['tid'], '2', $id);
                $data['status']            = 1;
                $data['role']              = 'fans';
                $data['appId']             = $wOpt['appId'];
                $data['timeStamp']         = $wOpt['timeStamp'];
                $data['nonceStr']          = $wOpt['nonceStr'];
                $data['package']           = $wOpt['package'];
                $data['signType']          = $wOpt['signType'];
                $data['paySign']           = $wOpt['paySign'];
                $listen_log                = array();
                $listen_log['openid']      = $_W['openid'];
                $listen_log['create_time'] = time();
                $listen_log['sn']          = $wOpt['tid'];
                $listen_log['to_openid']   = $question['openid'];
                $listen_log['question_id'] = $id;
                $listen_log['credit']      = $wOpt['fee'];
                $listen                    = M('listen_log')->update($listen_log);
                $data['listen_id']         = $listen['id'];
                $data['answer_id']         = $this_answer['id'];
                if (floatval($this->pro['listen_price']) <= 0) {
                    $data['status'] = 2;
                }
                exit(json_encode($data));
            }
            if (empty($listen_log['status'])) {
                $wOpt = $this->getowpt($credit, '学习费用');
                if (is_error($wOpt)) {
                    $data            = array();
                    $data['status']  = 8;
                    $data['message'] = $wOpt['message'];
                    exit(json_encode($data));
                }
                $data['status']    = 1;
                $data['role']      = 'fans';
                $data['appId']     = $wOpt['appId'];
                $data['timeStamp'] = $wOpt['timeStamp'];
                $data['nonceStr']  = $wOpt['nonceStr'];
                $data['package']   = $wOpt['package'];
                $data['signType']  = $wOpt['signType'];
                $data['paySign']   = $wOpt['paySign'];
                M('paylog')->delete(array(
                    'sn' => $listen_log['sn']
                ));
                $p1 = round(floatval($credit) * floatval($this->pro['listen_get_price']) / 100, 2);
                M('paylog')->insert($p1, $question['openid'], $wOpt['tid'], '2', $id);
                $p2 = round(floatval($credit) * floatval($this->pro['listen_get_price2']) / 100, 2);
                M('paylog')->insert($p2, $question['to_openid'], $wOpt['tid'], '3', $id);
                $listen_log['openid']      = $_W['openid'];
                $listen_log['create_time'] = time();
                $listen_log['sn']          = $wOpt['tid'];
                $listen_log['to_openid']   = $question['openid'];
                $listen_log['question_id'] = $id;
                $listen_log['credit']      = $wOpt['fee'];
                $listen                    = M('listen_log')->update($listen_log);
                $data['listen_id']         = $listen['id'];
                $data['answer_id']         = $this_answer['id'];
                exit(json_encode($data));
            }
            $data              = array();
            $data['status']    = 0;
            $data['role']      = 'fans';
            $data['isweixin']  = 0;
            $data['src']       = $this_answer['src'];
            $data['listen_id'] = $listen_log['id'];
            exit(json_encode($data));
        }
        if ($act == 'src') {
            if (empty($_W['openid'])) {
                $data            = array();
                $data['status']  = 8;
                $data['message'] = "请在微信浏览器中打开";
                exit(json_encode($data));
            }
            $now = M('member')->getInfo($_W['openid']);
            if ($now['admin'] == '1' || $question['istask'] == '1' || $question['openid'] == $_W['openid'] || $_W['openid'] == 'fromUser' || $type == 'question' || $question['isfree'] == 1 || $question['to_openid'] == $_W['openid'] || floatval($this->pro['listen_price']) <= 0) {
                $data             = array();
                $data['status']   = 0;
                $data['isweixin'] = 0;
                $type == 'question' ? $data['src'] = $question['src'] : $data['src'] = $this_answer['src'];
                $data['role'] = 'answer';
                exit(json_encode($data));
            }
            $listen_log = M('listen_log')->getOpenid($id, $_W['openid']);
            if (empty($listen_log)) {
                $pro  = M('setting')->getSetting('pro');
                $wOpt = $this->getowpt($credit, '学习费用');
                if (is_error($wOpt)) {
                    $data            = array();
                    $data['status']  = 8;
                    $data['message'] = $wOpt['message'];
                    exit(json_encode($data));
                }
                $p1 = round(floatval($credit) * floatval($this->pro['listen_get_price']) / 100, 2);
                M('paylog')->insert($p1, $question['openid'], $wOpt['tid'], '2', $id);
                $p2 = round(floatval($credit) * floatval($this->pro['listen_get_price2']) / 100, 2);
                M('paylog')->insert($p2, $question['to_openid'], $wOpt['tid'], '3', $id);
                $data['status']            = 1;
                $data['role']              = 'fans';
                $data['appId']             = $wOpt['appId'];
                $data['timeStamp']         = $wOpt['timeStamp'];
                $data['nonceStr']          = $wOpt['nonceStr'];
                $data['package']           = $wOpt['package'];
                $data['signType']          = $wOpt['signType'];
                $data['paySign']           = $wOpt['paySign'];
                $listen_log                = array();
                $listen_log['openid']      = $_W['openid'];
                $listen_log['create_time'] = time();
                $listen_log['sn']          = $wOpt['tid'];
                $listen_log['to_openid']   = $question['openid'];
                $listen_log['question_id'] = $id;
                $listen_log['credit']      = $wOpt['fee'];
                $listen                    = M('listen_log')->update($listen_log);
                $data['listen_id']         = $listen['id'];
                $data['answer_id']         = $this_answer['id'];
                if (floatval($this->pro['listen_price']) <= 0) {
                    $data['status'] = 2;
                }
                exit(json_encode($data));
            }
            if (empty($listen_log['status'])) {
                $wOpt = $this->getowpt($credit, '学习费用');
                if (is_error($wOpt)) {
                    $data            = array();
                    $data['status']  = 8;
                    $data['message'] = $wOpt['message'];
                    exit(json_encode($data));
                }
                $data['status']    = 1;
                $data['role']      = 'fans';
                $data['appId']     = $wOpt['appId'];
                $data['timeStamp'] = $wOpt['timeStamp'];
                $data['nonceStr']  = $wOpt['nonceStr'];
                $data['package']   = $wOpt['package'];
                $data['signType']  = $wOpt['signType'];
                $data['paySign']   = $wOpt['paySign'];
                M('paylog')->delete(array(
                    'sn' => $listen_log['sn']
                ));
                $p1 = round(floatval($credit) * floatval($this->pro['listen_get_price']) / 100, 2);
                M('paylog')->insert($p1, $question['openid'], $wOpt['tid'], '2', $id);
                $p2 = round(floatval($credit) * floatval($this->pro['listen_get_price2']) / 100, 2);
                M('paylog')->insert($p2, $question['to_openid'], $wOpt['tid'], '3', $id);
                $listen_log['openid']      = $_W['openid'];
                $listen_log['create_time'] = time();
                $listen_log['sn']          = $wOpt['tid'];
                $listen_log['to_openid']   = $question['openid'];
                $listen_log['question_id'] = $id;
                $listen_log['credit']      = $wOpt['fee'];
                $listen                    = M('listen_log')->update($listen_log);
                $data['listen_id']         = $listen['id'];
                $data['answer_id']         = $this_answer['id'];
                exit(json_encode($data));
            }
            $data              = array();
            $data['status']    = 0;
            $data['role']      = 'fans';
            $data['isweixin']  = 0;
            $data['src']       = $this_answer['src'];
            $data['listen_id'] = $listen_log['id'];
            exit(json_encode($data));
        }
        include $this->template($theme . 'question');
    }
    public function doMobilefind_search()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'find_search';
        include $this->template('find_search');
    }
    public function doMobilelongvoice()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'longvoice';
        $page       = intval($_GPC['page']);
        $where      = " AND isfree = :isfree AND free_end_time > :free_end_time AND status = :status";
        $params     = array(
            ':isfree' => 1,
            ':free_end_time' => time(),
            ':status' => 2
        );
        $questions  = M('question')->getList($page, $where, $params, 5);
        if ($page > 1) {
            include $this->template('longvoice_more');
        } else {
            include $this->template('longvoice');
        }
    }
    public function doWebsetting()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'setting';
        $_GPC['menu'] = $_GPC['menu'];
        $code         = $_GPC['code'];
        if (empty($code)) {
            $code = 'pro';
        }
        $item = M('setting')->getSetting($code);
        if (false) {
            $server_ip     = $_SERVER['SERVER_ADDR'];
            $server_domain = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
        }
        if (empty($item)) {
            $item = array();
        }
        if ($_W['ispost']) {
            $data             = array();
            $data['codename'] = $code;
            $_POST            = array_merge($item, $_POST);
            if (!empty($_FILES)) {
                foreach ($_FILES as $key => $file) {
                    $name = $file['name'];
                    if (!empty($name)) {
                        $ext = substr($name, strrpos($name, '.') + 1);
                        if ($ext != 'pem') {
                            message("文件格式有误", referer(), 'error');
                        }
                        $temp    = $file['tmp_name'];
                        $content = file_get_contents($temp);
                        $path    = IA_ROOT . '/addons/yukiho_zvoice/public/cert/' . $_W['uniacid'] . '/';
                        if (!is_dir($path)) {
                            load()->func('file');
                            mkdirs($path);
                        }
                        $cert_file = $path . $name;
                        if (!is_file($cert_file)) {
                            file_put_contents($cert_file, $content);
                        }
                        $_POST[$key] = $cert_file;
                    }
                }
            }
            $data['value'] = serialize($_POST);
            M('setting')->update($data);
            $this->message('保存成功', referer(), 'success');
        }
        include $this->template('setting_' . $code);
    }
    public function doMobilemembers()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'members';
        $act        = trim($_GPC['act']);
        if ($act == 'follow') {
            $openid = trim($_GPC['openid']);
            if ($openid == $_W['openid']) {
                $data            = array();
                $data['status']  = 0;
                $data['message'] = '不能关注自己';
                exit(json_encode($data));
            }
            $follow = M('follow')->check($openid);
            if (empty($follow)) {
                $data              = array();
                $data['openid']    = $_W['openid'];
                $data['to_openid'] = $openid;
                M('follow')->update($data);
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '关注成功';
                exit(json_encode($data));
            } else {
                $data            = array();
                $data['status']  = 0;
                $data['message'] = '已关注';
                exit(json_encode($data));
            }
        } else if ($act == 'unfollow') {
            $openid = trim($_GPC['openid']);
            $follow = M('follow')->check($openid);
            if (empty($follow)) {
                $data            = array();
                $data['status']  = 0;
                $data['message'] = '您还未关注';
                exit(json_encode($data));
            } else {
                M('follow')->deleteFollow($_W['openid'], $openid);
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '已取消关注';
                exit(json_encode($data));
            }
        }
        $page    = intval($_GPC['page']);
        $page    = $page > 0 ? $page : 1;
        $where   = "  AND credit > 0";
        $keyword = trim($_GPC['keyword']);
        if (!empty($keyword)) {
            $where .= " AND nickname like '%{$keyword}%'";
        }
        $members = M('member')->getList($page, $where, array(), 8);
        if ($page >= 2 || !empty($keyword)) {
            include $this->template('members_more');
            exit();
        }
        include $this->template('members');
    }
    public function doWebthemes_answer()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'themes_answer';
        $themes_id  = intval($_GPC['themes_id']);
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data            = array();
                $data['uniacid'] = $_W['uniacid'];
                if (!empty($_GPC['openid'])) {
                    $data['openid'] = trim($_GPC['openid']);
                }
                if (!empty($_GPC['themes_id'])) {
                    $data['themes_id'] = intval($_GPC['themes_id']);
                }
                $data['create_time'] = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                }
                M('themes_answer')->update($data);
                message('保存成功', $this->createWebUrl('themes_answer', array(
                    'themes_id' => $themes_id
                )), 'success');
            }
            $item = M('themes_answer')->getInfo($id);
            if (empty($item)) {
                $item['themes_id'] = $themes_id;
            }
            include $this->template('themes_answer_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    message('参数错误', referer(), 'error');
                }
            }
            M('themes_answer')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                message('删除成功', referer(), 'success');
            }
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = "";
        $list  = M('themes_answer')->getList($page, $where);
        include $this->template('themes_answer');
    }
    public function doWebthemes()
    {
        global $_W, $_GPC;
        $_GPC['do'] = 'themes';
        $themes_id  = intval($_GPC['themes_id']);
        if ($_GPC['act'] == 'select') {
            $data   = array();
            $themes = M('themes')->getInfo($themes_id);
            if (empty($themes)) {
                $data            = array();
                $data['status']  = 0;
                $data['message'] = '主题不存在或已删除';
                exit(json_encode($data));
            }
            if (!empty($_GPC['openid'])) {
                $data['openid'] = trim($_GPC['openid']);
            }
            if (!empty($themes_id)) {
                $data['themes_id'] = intval($themes_id);
            }
            M('themes_answer')->update($data);
            $data            = array();
            $data['status']  = 1;
            $data['message'] = '添加成功';
            exit(json_encode($data));
        }
        if ($_GPC['act'] == 'deselect') {
            $data   = array();
            $themes = M('themes')->getInfo($themes_id);
            $openid = trim($_GPC['openid']);
            if (empty($themes)) {
                $data            = array();
                $data['status']  = 0;
                $data['message'] = '主题不存在或已删除';
                exit(json_encode($data));
            }
            M('themes_answer')->deleteOpenid($themes_id, $openid);
            $data            = array();
            $data['status']  = 1;
            $data['message'] = '取消成功';
            exit(json_encode($data));
        }
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data            = array();
                $data['uniacid'] = $_W['uniacid'];
                if (!empty($_GPC['title'])) {
                    $data['title'] = trim($_GPC['title']);
                }
                if (!empty($_GPC['desc'])) {
                    $data['desc'] = trim($_GPC['desc']);
                }
                if (!empty($_GPC['image'])) {
                    $data['image'] = tomedia(trim($_GPC['image']));
                }
                $data['create_time'] = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                }
                M('themes')->update($data);
                message('保存成功', $this->createWebUrl('themes'), 'success');
            }
            $item = M('themes')->getInfo($id);
            include $this->template('themes_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    message('参数错误', referer(), 'error');
                }
            }
            M('themes')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                message('删除成功', referer(), 'success');
            }
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = "";
        $list  = M('themes')->getList($page, $where);
        include $this->template('themes');
    }
    public function doWebquestion()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'question';
        $_GPC['menu'] = 'zvoice';
        if ($_GPC['act'] == 'mutdelete') {
            $ids = $_GPC['ids'];
            foreach ($ids as $id) {
                M('question')->delete($id);
            }
            message('删除成功', referer(), 'success');
        }
        if ($_GPC['act'] == 'recommend') {
            $id                      = intval($_GPC['id']);
            $question                = M('question')->getInfo($id);
            $question['isrecommend'] = '1';
            M('question')->update($question);
            $this->message('推荐成功', referer(), 'success');
        }
        if ($_GPC['act'] == 'remind') {
            $id       = intval($_GPC['id']);
            $question = M('question')->getInfo($id);
            $member   = M('member')->getInfo($question['openid']);
            $url      = $this->createMobileUrl('question', array(
                'id' => $id
            ));
            $url      = str_replace('./', '', $url);
            $url      = $_W['siteroot'] . 'app/' . $url;
            M('common')->createTplMessage($question['to_openid'], $this->msg['title1'], str_replace("{name}", $member['nickname'], $this->msg['content1']), $url, "");
            $this->message('提醒成功', referer(), 'success');
        }
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data            = array();
                $data['uniacid'] = $_W['uniacid'];
                if (isset($_GPC['openid'])) {
                    $data['openid'] = trim($_GPC['openid']);
                }
                if (isset($_GPC['to_openid'])) {
                    $data['to_openid'] = trim($_GPC['to_openid']);
                }
                if (isset($_GPC['title'])) {
                    $data['title'] = trim($_GPC['title']);
                }
                if (isset($_GPC['class_id'])) {
                    $data['category_id'] = intval($_GPC['class_id']);
                }
                if (isset($_GPC['istask'])) {
                    $data['istask'] = intval($_GPC['istask']);
                }
                if (isset($_GPC['isrecommend'])) {
                    $data['isrecommend'] = intval($_GPC['isrecommend']);
                }
                if (isset($_GPC['score'])) {
                    $data['score'] = intval($_GPC['score']);
                }
                if (isset($_GPC['feedback'])) {
                    $data['feedback'] = trim($_GPC['feedback']);
                }
                if (isset($_GPC['credit'])) {
                    $data['credit'] = floatval($_GPC['credit']);
                }
                if (isset($_GPC['open'])) {
                    $data['open'] = intval($_GPC['open']);
                }
                if (isset($_GPC['voice_id'])) {
                    $data['src'] = tomedia($_GPC['voice_id']);
                }
                if (isset($_GPC['isfree'])) {
                    $data['isfree'] = intval($_GPC['isfree']);
                }
                if (isset($_GPC['status'])) {
                    $data['status'] = intval($_GPC['status']);
                }
                if (is_array($_GPC['images'])) {
                    $images    = $_GPC['images'];
                    $image_url = array();
                    foreach ($images as $img) {
                        $base64      = 'data:image/jpeg;base64,' . base64_encode(file_get_contents(tomedia($img)));
                        $image_url[] = M('common')->createImage($base64);
                    }
                    $data['images'] = serialize($image_url);
                }
                $data['create_time'] = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                    $question = M('question')->update($data);
                } else {
                    $question = M('question')->update($data);
                }
                $this->message('保存成功', $this->createWebUrl('question'), 'success');
            }
            $item = M('question')->getInfo($id);
            include $this->template('question_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    $this->message('参数错误', referer(), 'error');
                }
            }
            M('question')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                $this->message('删除成功', referer(), 'success');
            }
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = "";
        $list  = M('question')->getList($page, $where);
        include $this->template('question');
    }
    public function doWebspeech()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'speech';
        $_GPC['menu'] = 'speech';
        if ($_GPC['act'] == 'mutdelete') {
            $ids = $_GPC['ids'];
            foreach ($ids as $id) {
                M('speech')->delete($id);
            }
            message('删除成功', referer(), 'success');
        }
        if ($_GPC['act'] == 'recommend') {
            $id                    = intval($_GPC['id']);
            $speech                = M('speech')->getInfo($id);
            $speech['isrecommend'] = '1';
            M('speech')->update($speech);
            $this->message('推荐成功', referer(), 'success');
        }
        if ($_GPC['act'] == 'remind') {
            $id     = intval($_GPC['id']);
            $speech = M('speech')->getInfo($id);
            $member = M('member')->getInfo($speech['openid']);
            $url    = $this->createMobileUrl('speech', array(
                'id' => $id
            ));
            $url    = str_replace('./', '', $url);
            $url    = $_W['siteroot'] . 'app/' . $url;
            M('common')->createTplMessage($speech['to_openid'], $this->msg['title1'], str_replace("{name}", $member['nickname'], $this->msg['content1']), $url, "");
            $this->message('提醒成功', referer(), 'success');
        }
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data            = array();
                $data['uniacid'] = $_W['uniacid'];
                if (isset($_GPC['openid'])) {
                    $data['openid'] = trim($_GPC['openid']);
                }
                if (isset($_GPC['title'])) {
                    $data['title'] = trim($_GPC['title']);
                }
                if (isset($_GPC['category_id'])) {
                    $data['category_id'] = intval($_GPC['category_id']);
                }
                if (isset($_GPC['isrecommend'])) {
                    $data['isrecommend'] = intval($_GPC['isrecommend']);
                }
                if (isset($_GPC['voice_id'])) {
                    $data['src'] = tomedia($_GPC['voice_id']);
                }
                if (isset($_GPC['isfree'])) {
                    $data['isfree'] = intval($_GPC['isfree']);
                }
                if (isset($_GPC['status'])) {
                    $data['status'] = intval($_GPC['status']);
                }
                if (isset($_GPC['description'])) {
                    $data['description'] = trim($_GPC['description']);
                }
                if (isset($_GPC['credit'])) {
                    $data['credit'] = floatval($_GPC['credit']);
                }
                if (isset($_GPC['cover'])) {
                    $base64        = 'data:image/jpeg;base64,' . base64_encode(file_get_contents(tomedia($_GPC['cover'])));
                    $data['cover'] = tomedia($_GPC['cover']);
                }
                $data['create_time'] = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                    $speech = M('speech')->update($data);
                } else {
                    $speech = M('speech')->update($data);
                }
                $this->message('保存成功', $this->createWebUrl('speech'), 'success');
            }
            $item = M('speech')->getInfo($id);
            include $this->template('speech_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    $this->message('参数错误', referer(), 'error');
                }
            }
            M('speech')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                $this->message('删除成功', referer(), 'success');
            }
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = "";
        $list  = M('speech')->getList($page, $where);
        include $this->template('speech');
    }
    public function doWebspeech_item()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'speech_item';
        $_GPC['menu'] = 'speech';
        if ($_GPC['act'] == 'mutdelete') {
            $ids = $_GPC['ids'];
            foreach ($ids as $id) {
                M('speech_item')->delete($id);
            }
            message('删除成功', referer(), 'success');
        }
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data            = array();
                $data['uniacid'] = $_W['uniacid'];
                if (isset($_GPC['speech_id'])) {
                    $data['speech_id'] = intval($_GPC['speech_id']);
                }
                if (isset($_GPC['title'])) {
                    $data['title'] = trim($_GPC['title']);
                }
                if (isset($_GPC['src'])) {
                    $data['src'] = trim($_GPC['src']);
                }
                if (isset($_GPC['dsporder'])) {
                    $data['dsporder'] = intval($_GPC['dsporder']);
                }
                if (isset($_GPC['isfree'])) {
                    $data['isfree'] = intval($_GPC['isfree']);
                }
                if (isset($_GPC['timelong'])) {
                    $data['timelong'] = intval($_GPC['timelong']);
                }
                if (isset($_GPC['istitle'])) {
                    $data['istitle'] = intval($_GPC['istitle']);
                }
                if (isset($_GPC['status'])) {
                    $data['status'] = intval($_GPC['status']);
                }
                $data['create_time'] = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                    $speech_item = M('speech_item')->update($data);
                } else {
                    $speech_item = M('speech_item')->update($data);
                }
                $this->message('保存成功', $this->createWebUrl('speech_item'), 'success');
            }
            $item = M('speech_item')->getInfo($id);
            include $this->template('speech_item_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    $this->message('参数错误', referer(), 'error');
                }
            }
            M('speech_item')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                $this->message('删除成功', referer(), 'success');
            }
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = "" . !empty($_GPC['speech_id']) ? " AND speech_id=" . intval($_GPC['speech_id']) : "";
        $list  = M('speech_item')->getList($page, $where);
        include $this->template('speech_item');
    }
    public function doWebcomment()
    {
        global $_W, $_GPC;
        $_GPC['menu'] = 'speech';
        if ($_GPC['act'] == 'mutdelete') {
            $ids = $_GPC['ids'];
            foreach ($ids as $id) {
                M('comment')->delete($id);
            }
            message('删除成功', referer(), 'success');
        }
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data            = array();
                $data['uniacid'] = $_W['uniacid'];
                if (isset($_GPC['speech_id'])) {
                    $data['speech_id'] = intval($_GPC['speech_id']);
                }
                if (!empty($_GPC['title'])) {
                    $data['title'] = trim($_GPC['title']);
                }
                if (isset($_GPC['openid'])) {
                    $data['openid'] = trim($_GPC['openid']);
                }
                $data['create_time'] = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                }
                M('comment')->update($data);
                $this->message('保存成功', $this->createWebUrl('comment'), 'success');
            }
            $item = M('comment')->getInfo($id);
            if (empty($item)) {
                $item['fid'] = intval($_GPC['fid']);
            }
            include $this->template('comment_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    $this->message('参数错误', referer(), 'error');
                }
            }
            M('comment')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                $this->message('删除成功', referer(), 'success');
            }
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = "" . !empty($_GPC['speech_id']) ? " AND speech_id=" . intval($_GPC['speech_id']) : "";
        $where = $where . !empty($_GPC['item_id']) ? " AND item_id=" . intval($_GPC['item_id']) : "";
        $list  = M('comment')->getList($page, $where);
        include $this->template('comment');
    }
    public function doWebfollow()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'follow';
        $_GPC['menu'] = 'zvoice';
        $to_openid    = trim($_GPC['to_openid']);
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data            = array();
                $data['uniacid'] = $_W['uniacid'];
                if (!empty($_GPC['to_openid'])) {
                    $data['to_openid'] = trim($_GPC['to_openid']);
                }
                if (!empty($_GPC['openid'])) {
                    $data['openid'] = trim($_GPC['openid']);
                }
                $data['create_time'] = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                }
                M('follow')->update($data);
                message('保存成功', $this->createWebUrl('follow', array(
                    'to_openid' => $to_openid
                )), 'success');
            }
            $item = M('follow')->getInfo($id);
            if (empty($item)) {
                $item['to_openid'] = $to_openid;
            }
            include $this->template('follow_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    message('参数错误', referer(), 'error');
                }
            }
            M('follow')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                message('删除成功', referer(), 'success');
            }
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = "";
        $list  = M('follow')->getList($page, $where);
        include $this->template('follow');
    }
    public function doWebmember()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'member';
        $_GPC['menu'] = 'member';
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data            = array();
                $data['uniacid'] = $_W['uniacid'];
                if (isset($_GPC['openid'])) {
                    $data['openid'] = trim($_GPC['openid']);
                }
                if (isset($_GPC['nickname'])) {
                    $data['nickname'] = trim($_GPC['nickname']);
                }
                if (isset($_GPC['realname'])) {
                    $data['realname'] = trim($_GPC['realname']);
                }
                if (isset($_GPC['avatar'])) {
                    $data['avatar'] = tomedia(trim($_GPC['avatar']));
                }
                if (isset($_GPC['status'])) {
                    $data['status'] = intval($_GPC['status']);
                }
                if (isset($_GPC['score'])) {
                    $data['score'] = floatval($_GPC['score']);
                }
                if (isset($_GPC['number'])) {
                    $data['number'] = intval($_GPC['number']);
                }
                if (isset($_GPC['follow'])) {
                    $data['follow'] = intval($_GPC['follow']);
                }
                if (isset($_GPC['learn'])) {
                    $data['learn'] = intval($_GPC['learn']);
                }
                if (!empty($_GPC['mobile'])) {
                    $data['mobile'] = trim($_GPC['mobile']);
                }
                if (!empty($_GPC['desc'])) {
                    $data['desc'] = trim($_GPC['desc']);
                }
                if (isset($_GPC['tags'])) {
                    $data['tags'] = trim($_GPC['tags']);
                }
                if (isset($_GPC['credit'])) {
                    $data['credit'] = floatval($_GPC['credit']);
                }
                if (isset($_GPC['open_free'])) {
                    $data['open_free'] = intval($_GPC['open_free']);
                }
                if (isset($_GPC['ishot'])) {
                    $data['ishot'] = intval($_GPC['ishot']);
                }
                if (isset($_GPC['isrecommend'])) {
                    $data['isrecommend'] = intval($_GPC['isrecommend']);
                }
                if (isset($_GPC['admin'])) {
                    $data['admin'] = intval($_GPC['admin']);
                }
                if (isset($_GPC['category_id'])) {
                    $data['category_id'] = intval($_GPC['category_id']);
                }
                if (isset($_GPC['labels'])) {
                    $data['labels'] = trim($_GPC['labels']);
                }
                $data['create_time'] = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                }
                $member = M('member')->update_or_insert($data);
                $this->message('保存成功', $this->createWebUrl('member'), 'success');
            }
            $item = M('member')->getInfoById($id);
            include $this->template('member_edit');
            exit();
        }
        if ($_GPC['act'] == 'pass') {
            $id   = intval($_GPC['id']);
            $data = array();
            if (!empty($id)) {
                $data['id'] = $id;
                unset($data['create_time']);
            }
            $data['uniacid'] = $_W['uniacid'];
            $data['status']  = '3';
            $item            = M('member')->getInfoById($id);
            $url             = $this->createMobileUrl('home', array(
                'openid' => $item['openid']
            ));
            $url             = str_replace('./', '', $url);
            $url             = $_W['siteroot'] . 'app/' . $url;
            M('common')->createTplMessage($item['openid'], '认证审核结果', "恭喜，您已经审核通过了哦！ 点击查看详情。", $url, '');
            M('member')->update_or_insert($data);
            $this->message('操作成功', $this->createWebUrl('member'), 'success');
            include $this->template('member');
            exit();
        }
        if ($_GPC['act'] == 'status') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data = array();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                }
                $data['uniacid']   = $_W['uniacid'];
                $data['status']    = intval($_GPC['status']);
                $data['verifyMsg'] = trim($_GPC['verifyMsg']);
                $item              = M('member')->getInfoById($id);
                if ($data['status'] == 2) {
                    $content = "审核不通过！原因：" . $data['verifyMsg'] . "  点击查看详情。";
                } else if ($data['status'] == 3) {
                    $content = "恭喜，您已经审核通过了哦！ 点击查看详情。";
                }
                $url = $this->createMobileUrl('home', array(
                    'openid' => $item['openid']
                ));
                $url = str_replace('./', '', $url);
                $url = $_W['siteroot'] . 'app/' . $url;
                M('common')->mc_notice_custom_news($item['openid'], '认证审核结果', $content, $url, '');
                M('member')->update_or_insert($data);
                $this->message('操作成功', $this->createWebUrl('member'), 'success');
            }
            $item = M('member')->getInfoById($id);
            include $this->template('verify_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    $this->message('参数错误', referer(), 'error');
                }
            }
            M('member')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                message('删除成功', referer(), 'success');
            }
        }
        $page    = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $verifys = M('member')->getall(array(
            'status' => '1'
        ));
        $list    = M('member')->getList($page, $where, array());
        include $this->template('member');
    }
    public function doWebpaylog()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'paylog';
        $_GPC['menu'] = 'paylog';
        if ($_GPC['act'] == 'mutdelete') {
            $ids = $_GPC['ids'];
            foreach ($ids as $id) {
                $item = M('paylog')->getInfo($id);
                M('paylog')->delete(array(
                    'id' => $id
                ));
                if ($item['status'] == '2' || $item['status'] == '3') {
                    M('listen_log')->deleteBySn($item['sn']);
                }
            }
            message('删除成功', referer(), 'success');
        }
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data                = array();
                $data['uniacid']     = $_W['uniacid'];
                $data['create_time'] = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                }
                M('paylog')->update($data);
                message('保存成功', $this->createWebUrl('paylog'), 'success');
            }
            $item = M('paylog')->getInfo($id);
            include $this->template('paylog_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    message('参数错误', referer(), 'error');
                }
            }
            $item = M('paylog')->getInfo($id);
            if ($item['type'] == '2' || $item['type'] == '3') {
                M('listen_log')->deleteBySn($item['sn']);
            }
            M('paylog')->delete(array(
                'id' => $id
            ));
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                message('删除成功', referer(), 'success');
            }
        }
        if ($_GPC['act'] == 'search') {
            $page   = isset($_GPC['page']) ? intval($_GPC['page']) : 1;
            $params = array();
            if (isset($_GPC['status'])) {
                $where .= " AND status = :status ";
                $params[':status'] = intval($_GPC['status']);
            }
            if (isset($_GPC['date'])) {
                $start = strtotime(trim($_GPC['date']['start']));
                $end   = strtotime(trim($_GPC['date']['end'])) + 86400;
                $where .= " AND create_time>={$start} AND create_time<={$end} ";
            }
            $list = M('paylog')->getList($page, $where, $params);
            include $this->template('paylog');
            exit();
        }
        $page = isset($_GPC['page']) ? intval($_GPC['page']) : 1;
        $list = M('paylog')->getList($page, $where);
        include $this->template('paylog');
    }
    public function doWebcategory()
    {
        global $_W, $_GPC;
        $_GPC['do']   = 'category';
        $_GPC['menu'] = 'menu';
        if ($_GPC['act'] == 'edit') {
            $id = intval($_GPC['id']);
            if ($_W['ispost']) {
                $data            = array();
                $data['uniacid'] = $_W['uniacid'];
                if (!empty($_GPC['title'])) {
                    $data['title'] = trim($_GPC['title']);
                }
                if (isset($_GPC['fid'])) {
                    $data['fid'] = intval($_GPC['fid']);
                }
                if (isset($_GPC['labels'])) {
                    $data['labels'] = trim($_GPC['labels']);
                }
                if (isset($_GPC['ismain'])) {
                    $data['ismain'] = intval($_GPC['ismain']);
                }
                if (isset($_GPC['task_credit'])) {
                    $data['task_credit'] = floatval($_GPC['task_credit']);
                }
                if (isset($_GPC['displayorder'])) {
                    $data['displayorder'] = intval($_GPC['displayorder']);
                }
                if (!empty($_GPC['image'])) {
                    $data['image'] = tomedia(trim($_GPC['image']));
                }
                $data['create_time'] = time();
                if (!empty($id)) {
                    $data['id'] = $id;
                    unset($data['create_time']);
                }
                M('category')->update($data);
                $this->message('保存成功', $this->createWebUrl('category'), 'success');
            }
            $item = M('category')->getInfo($id);
            if (empty($item)) {
                $item['fid'] = intval($_GPC['fid']);
            }
            include $this->template('category_edit');
            exit();
        }
        if ($_GPC['act'] == 'delete') {
            $id = intval($_GPC['id']);
            if (empty($id)) {
                if ($_W['ispost']) {
                    $data            = array();
                    $data['status']  = 1;
                    $data['message'] = '参数错误';
                    exit(json_encode($data));
                } else {
                    $this->message('参数错误', referer(), 'error');
                }
            }
            M('category')->delete($id);
            if ($_W['ispost']) {
                $data            = array();
                $data['status']  = 1;
                $data['message'] = '操作成功';
                exit(json_encode($data));
            } else {
                $this->message('删除成功', referer(), 'success');
            }
        }
        $page  = !empty($_GPC['page']) ? intval($_GPC['page']) : 1;
        $where = " AND fid = 0";
        $list  = M('category')->getList($page, $where);
        include $this->template('category');
    }

    
    public function message($msg, $redirect = '', $type = '')
    {
        global $_W;
        if ($redirect == 'refresh') {
            $redirect = $_W['script_name'] . '?' . $_SERVER['QUERY_STRING'];
        }
        if ($redirect == '') {
            $type = in_array($type, array(
                'success',
                'error',
                'tips',
                'ajax',
                'sql'
            )) ? $type : 'error';
        } else {
            $type = in_array($type, array(
                'success',
                'error',
                'tips',
                'ajax',
                'sql'
            )) ? $type : 'success';
        }
        if ($_W['isajax'] || $type == 'ajax') {
            $vars             = array();
            $vars['message']  = $msg;
            $vars['redirect'] = $redirect;
            $vars['type']     = $type;
            exit(json_encode($vars));
        }
        if (defined('IN_MOBILE')) {
            $message = "<script type=\"text/javascript\">alert('$msg');";
            $redirect && $message .= "location.href = \"{$redirect}\";";
            $message .= "</script>";
            include template('message', TEMPLATE_INCLUDEPATH);
            exit();
        }
        if (empty($msg) && !empty($redirect)) {
            header('Location: ' . $redirect);
        }
        include $this->template('msg');
        exit();
    }
}