<?php
session_start();
defined('IN_IA') or exit('Access Denied');
class water_o2oModuleSite extends WeModuleSite
{
    public $fanstable = 'water_o2o_fans';
    public $shoptable = 'water_o2o_shops';
    public $workertable = 'water_o2o_workers';
    public $managertable = 'water_o2o_manager';
    public $ordertable = 'water_o2o_orders';
    public $servicetable = 'water_o2o_services';
    public $servicehometable = 'water_o2o_serviceshome';
    public $timetable = 'water_o2o_time';
    public $pltable = 'water_o2o_evaluate';
    public $fondtable = 'water_o2o_fondflow';
    public $indextitle = '欢乐筹首页';
    public $indexexapmletitle = '精选案例';
    public $addressttitle = '我的地址';
    public $ordertitle = '我的订单';
    public $shopordertitle = '店铺订单';
    public $messagetitle = '消息';
    public $messagePLtitle = '项目评论';
    public $messageXWtitle = '官方动态';
    public $centertitle = '我的主页';
    public $shopcentertitle = '商铺主页';
    public $centerSTtitle = '个人设置';
    public $centerFQtitle = '我发起的';
    public $centerSPtitle = '我支持的';
    public $centerFLtitle = '我关注的';
    public $centerQBtitle = '我的钱包';
    public $shopcenterQBtitle = '商铺账户余额';
    public $centeryhq1title = '未领取优惠券';
    public $centeryhq2title = '已领取优惠券';
    public $centerJYtitle = '我的交易';
    public $centerHBtitle = '我的回报';
    public $centerHPtitle = '帮助中心';
    public $shopitemtitle = '服务项目';
    public $shopmanagetitle = '管理中心';
    public $shopmembertitle = '会员信息';
    public $shopinfotitle = '商铺信息';
    public $shoptimetitle = '时间管理';
    public $workcentertitle = '工作中心';
    public $workordertitle = '工作订单';
    public $workitemtitle = '服务项目';
    public $workqbtitle = '钱包管理';
    public $workinfotitle = '员工信息';
    public function doMobileTest()
    {
        global $_GPC, $_W;
        $system = $this->module['config'];
        include 'bigfish/TopSdk.php';
        $c            = new TopClient;
        $c->appkey    = $system['fishappkey'];
        $c->secretKey = $system['fishsecret'];
        $req          = new AlibabaAliqinFcSmsNumSendRequest;
        $tel          = '0755-61910103';
        $req->setSmsType("normal");
        $req->setSmsFreeSignName($system['fishsign']);
        $json = json_encode(array(
            $system['fishyzmparam'] => $rand4num
        ));
        $req->setSmsParam($json);
        $req->setRecNum($tel);
        $req->setSmsTemplateCode($system['fishyzmb']);
        $resp = $c->execute($req);
        $arr  = (array) $resp;
        print_r($arr);
        if (is_array($arr)) {
            $result = $arr['result'];
            if (empty($result)) {
                die(json_encode(array(
                    "result" => 0,
                    "msg" => 'error3' . $result['msg']
                )));
            } else {
                $content = (array) $result;
                if ($content['err_code'] == "0") {
                    die(json_encode(array(
                        "result" => 1,
                        "msg" => '验证码已发送'
                    )));
                } else {
                    die(json_encode(array(
                        'result' => 0,
                        'msg' => 'error2'
                    )));
                }
            }
        } else {
            print_r($arr);
        }
    }
    public function doMobileTest1()
    {
        global $_GPC, $_W;
        $system = $this->module['config'];
        include $this->template('publicdream');
    }
    public function doMobileAuthuser()
    {
        global $_GPC, $_W;
        load()->func('communication');
        $openid  = $_W['fans']['from_user'];
        $hasAuth = false;
        if (empty($openid)) {
            $hasAuth = false;
        } else {
            $fans = pdo_fetch("SELECT id,nickname,headimg FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
            if (empty($fans)) {
                $hasAuth = false;
            } else {
                if (empty($fans['nickname']) || empty($fans['headimg'])) {
                    $hasAuth = false;
                } else {
                    $hasAuth = true;
                }
            }
        }
        if (!$hasAuth) {
            $url         = $_W['siteroot'] . 'app/' . $this->createMobileUrl('Authuser');
            $code        = $_GPC['code'];
            $oauth2_code = '';
            $appid       = $_W['account']['key'];
            $secret      = $_W['account']['secret'];
            if (empty($appid) || empty($secret)) {
                message('检查您的公众号APPID和SECRET是否填写');
            }
            if (empty($code)) {
                $oauth2_code = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $appid . "&redirect_uri=" . urlencode($url) . "&response_type=code&scope=snsapi_userinfo&state=0#wechat_redirect";
                header('Location:' . $oauth2_code, true, 302);
                exit();
            }
            $oauth2_code1 = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $appid . "&secret=" . $secret . "&code=" . $code . "&grant_type=authorization_code";
            $content      = ihttp_get($oauth2_code1);
            $content      = @json_decode($content['content'], true);
            $access_token = $content['access_token'];
            $openid       = $content['openid'];
            $oauth2_url   = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $openid;
            $content      = ihttp_get($oauth2_url);
            $info         = @json_decode($content['content'], true);
            if (!empty($info)) {
                $data = array(
                    'uniacid' => $_W['uniacid'],
                    'openid' => $info['openid'],
                    'nickname' => $info['nickname'],
                    'headimg' => $info['headimgurl']
                );
                if (empty($fans['id'])) {
                    pdo_insert($this->fanstable, $data);
                } else {
                    pdo_update($this->fanstable, $data, array(
                        'id' => $fans['id']
                    ));
                }
            }
        }
        if (empty($to)) {
            $this->doMobileIndex();
        } else {
            $this->doMobileCenter();
        }
    }
    public function doMobileAuthworker()
    {
        global $_GPC, $_W;
        load()->func('communication');
        $openid  = $_W['fans']['from_user'];
        $hasAuth = false;
        if (empty($openid)) {
            $hasAuth = false;
        } else {
            $worker = pdo_fetch("SELECT id,nickname,headimg FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
            if (empty($worker)) {
                $hasAuth = false;
            } else {
                if (empty($worker['nickname']) || empty($worker['headimg'])) {
                    $hasAuth = false;
                } else {
                    $hasAuth = true;
                }
            }
        }
        if (!$hasAuth) {
            $url         = $_W['siteroot'] . 'app/' . $this->createMobileUrl('Authworker');
            $code        = $_GPC['code'];
            $oauth2_code = '';
            $appid       = $_W['account']['key'];
            $secret      = $_W['account']['secret'];
            if (empty($appid) || empty($secret)) {
                message('检查您的公众号APPID和SECRET是否填写');
            }
            if (empty($code)) {
                $oauth2_code = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $appid . "&redirect_uri=" . urlencode($url) . "&response_type=code&scope=snsapi_userinfo&state=0#wechat_redirect";
                header('Location:' . $oauth2_code, true, 302);
                exit();
            }
            $oauth2_code1 = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $appid . "&secret=" . $secret . "&code=" . $code . "&grant_type=authorization_code";
            $content      = ihttp_get($oauth2_code1);
            $content      = @json_decode($content['content'], true);
            $access_token = $content['access_token'];
            $openid       = $content['openid'];
            $oauth2_url   = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $openid;
            $content      = ihttp_get($oauth2_url);
            $info         = @json_decode($content['content'], true);
            if (!empty($info['openid']) && !empty($info['nickname']) && !empty($info['headimgurl'])) {
                $data = array(
                    'uniacid' => $_W['uniacid'],
                    'openid' => $info['openid'],
                    'nickname' => $info['nickname'],
                    'headimg' => $info['headimgurl']
                );
                if (empty($worker['id'])) {
                    pdo_insert($this->workertable, $data);
                } else {
                    pdo_update($this->workertable, $data, array(
                        'id' => $worker['id']
                    ));
                }
            }
        }
        $this->doMobileWorkerentry();
    }
    public function doMobileIndex()
    {
        global $_GPC, $_W;
        $active     = 1;
        $type       = 0;
        $system     = $this->module['config'];
        $title      = $system['sysname'];
        $pageNumber = max(1, intval($_GPC['page']));
        $pageSize   = 20;
        $sql        = "SELECT * FROM " . tablename($this->shoptable) . " WHERE uniacid = '{$_W['uniacid']}' and state = 2 ORDER BY id LIMIT " . ($pageNumber - 1) * $pageSize . ',' . $pageSize;
        $list       = pdo_fetchall($sql);
        $total      = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->shoptable) . " WHERE  uniacid = '{$_W['uniacid']}' and state = 2 ORDER BY id");
        $pagenums   = ceil($total / $pageSize);
        $pagearray  = array();
        for ($i = 1; $i <= $pagenums; $i++) {
            $pagearray[$i] = $i;
        }
        $left  = 0;
        $right = 0;
        if ($pageNumber > 1) {
            $left = $pageNumber - 1;
        }
        if ($pageNumber < $pagenums) {
            $right = $pageNumber + 1;
        }
        include $this->template('index');
    }
    public function doMobileHomesvs()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        $active     = 1;
        $type       = 1;
        $system     = $this->module['config'];
        $title      = $system['sysname'];
        $pageNumber = max(1, intval($_GPC['page']));
        $pageSize   = 40;
        $sql        = "SELECT * FROM " . tablename($this->servicehometable) . " WHERE uniacid = '{$_W['uniacid']}'  and state = 2 ORDER BY id LIMIT " . ($pageNumber - 1) * $pageSize . ',' . $pageSize;
        $list       = pdo_fetchall($sql);
        $total      = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->servicehometable) . " WHERE  uniacid = '{$_W['uniacid']}' and state = 2 ORDER BY id");
        $pagenums   = ceil($total / $pageSize);
        $pagearray  = array();
        for ($i = 1; $i <= $pagenums; $i++) {
            $pagearray[$i] = $i;
        }
        $left  = 0;
        $right = 0;
        if ($pageNumber > 1) {
            $left = $pageNumber - 1;
        }
        if ($pageNumber < $pagenums) {
            $right = $pageNumber + 1;
        }
        include $this->template('homesvs');
    }
    public function doMobileHomewks()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        $active     = 1;
        $type       = 2;
        $system     = $this->module['config'];
        $title      = $system['sysname'];
        $pageNumber = max(1, intval($_GPC['page']));
        $pageSize   = 40;
        $wsql       = "SELECT wk.* FROM " . tablename($this->workertable) . " as wk left join " . tablename($this->servicetable) . " as sv on wk.id = sv.wid

				WHERE wk.uniacid = '{$_W['uniacid']}'  and sv.state = 2 and wk.sid = 0 and wk.state = 2 and wk.isfree = 1 ORDER BY wk.id  LIMIT " . ($pageNumber - 1) * $pageSize . ',' . $pageSize;
        $list       = pdo_fetchall($wsql);
        $total      = pdo_fetchcolumn('SELECT COUNT(wk.id) FROM ' . tablename($this->workertable) . " as wk left join " . tablename($this->servicetable) . " as sv on wk.id = sv.wid
				WHERE  wk.uniacid = '{$_W['uniacid']}' and sv.state = 2 and wk.sid = 0 and wk.state = 2 and wk.isfree = 1 ORDER BY wk.id");
        $pagenums   = ceil($total / $pageSize);
        $pagearray  = array();
        for ($i = 1; $i <= $pagenums; $i++) {
            $pagearray[$i] = $i;
        }
        $left  = 0;
        $right = 0;
        if ($pageNumber > 1) {
            $left = $pageNumber - 1;
        }
        if ($pageNumber < $pagenums) {
            $right = $pageNumber + 1;
        }
        include $this->template('homewks');
    }
    public function doMobileShop()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        $active = 0;
        $shopid = intval($_GPC['shopid']);
        if ($shopid > 0) {
            $shop = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE id= " . $shopid);
            if (!$shop) {
                message('抱歉，信息不存在或是已经删除！', '', 'error');
            }
            $type     = intval($_GPC['type']);
            $title    = $shop['stitle'];
            $simgs    = unserialize($shop['simgs']);
            $sbanners = unserialize($shop['sbanners']);
            $sql      = "SELECT * FROM " . tablename($this->servicetable) . " WHERE uniacid = '{$_W['uniacid']}' and sid = '{$shopid}' and state = 2 ORDER BY id ";
            $list     = pdo_fetchall($sql);
        } else {
            message('shopid is null', '', 'error');
        }
        include $this->template('shop');
    }
    public function doMobileWorker()
    {
        global $_GPC, $_W;
        $active   = 0;
        $workerid = intval($_GPC['workerid']);
        if ($workerid > 0) {
            $title  = $shop['stitle'];
            $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE id= " . $workerid);
            if (!$worker) {
                message('抱歉，信息不存在或是已经删除！', '', 'error');
            }
            if ($worker['sid'] > 0) {
                $shop = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE id= " . $worker['sid']);
                if (!$shop) {
                    message('抱歉，信息不存在或是已经删除！', '', 'error');
                }
                $sql  = "SELECT * FROM " . tablename($this->servicetable) . " WHERE uniacid = '{$_W['uniacid']}' and sid = '{$worker['sid']}' and dohome = 1 and state = 2  ORDER BY id ";
                $list = pdo_fetchall($sql);
            } else {
                $sql  = "SELECT * FROM " . tablename($this->servicetable) . " WHERE uniacid = '{$_W['uniacid']}' and sid = 0 and wid = '{$workerid}' and dohome = 1 and state = 2  ORDER BY id ";
                $list = pdo_fetchall($sql);
            }
            $plsum = pdo_fetch("SELECT count(*) as cnt FROM " . tablename($this->pltable) . " WHERE workerid = '{$workerid}' and uniacid = '{$_W['uniacid']}'");
            $type  = intval($_GPC['type']);
        } else {
            message('shopid is null', '', 'error');
        }
        include $this->template('worker');
    }
    public function doMobileWorkerpl()
    {
        global $_GPC, $_W;
        $active   = 0;
        $workerid = intval($_GPC['workerid']);
        if ($workerid > 0) {
            $title  = $shop['stitle'];
            $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE id= " . $workerid);
            if (!$worker) {
                message('抱歉，信息不存在或是已经删除！', '', 'error');
            }
            $sql   = "SELECT pl.*,ord.svname,ord.fmobile FROM " . tablename($this->pltable) . " as pl left join  " . tablename($this->ordertable) . " as ord on pl.orderid = ord.id WHERE pl.uniacid = '{$_W['uniacid']}' and  pl.workerid = '{$workerid}'  ORDER BY pl.id desc";
            $list  = pdo_fetchall($sql);
            $all   = count($list);
            $sql1  = "SELECT pl.*,ord.svname,ord.fmobile FROM " . tablename($this->pltable) . " as pl left join  " . tablename($this->ordertable) . " as ord on pl.orderid = ord.id WHERE pl.uniacid = '{$_W['uniacid']}' and  pl.workerid = '{$workerid}' and pl.rank = 1 ORDER BY pl.id desc";
            $list1 = pdo_fetchall($sql1);
            $hp    = count($list1);
            $sql2  = "SELECT pl.*,ord.svname,ord.fmobile FROM " . tablename($this->pltable) . " as pl left join  " . tablename($this->ordertable) . " as ord on pl.orderid = ord.id WHERE pl.uniacid = '{$_W['uniacid']}' and  pl.workerid = '{$workerid}' and pl.rank = 2 ORDER BY pl.id desc";
            $list2 = pdo_fetchall($sql2);
            $yb    = count($list2);
            $sql3  = "SELECT pl.*,ord.svname,ord.fmobile FROM " . tablename($this->pltable) . " as pl left join  " . tablename($this->ordertable) . " as ord on pl.orderid = ord.id WHERE pl.uniacid = '{$_W['uniacid']}' and  pl.workerid = '{$workerid}' and pl.rank = 3 ORDER BY pl.id desc";
            $list3 = pdo_fetchall($sql3);
            $bh    = count($list3);
        } else {
            message('workerid is null', '', 'error');
        }
        include $this->template('workerpl');
    }
    public function doMobileIndexexample()
    {
        global $_GPC, $_W;
        $active = 1;
        $title  = $this->indexexapmletitle;
        include $this->template('indexexample');
    }
    public function doMobileService()
    {
        global $_GPC, $_W;
        $active    = 1;
        $workerid  = intval($_GPC['workerid']);
        $serviceid = intval($_GPC['serviceid']);
        if ($serviceid > 0) {
            $service = pdo_fetch("SELECT * FROM " . tablename($this->servicetable) . " WHERE id= " . $serviceid);
            if (!$service) {
                message('抱歉，信息不存在或是已经删除！', '', 'error');
            }
            $type     = intval($_GPC['type']);
            $title    = $service['sname'];
            $simgs    = unserialize($service['simgs']);
            $sbanners = unserialize($service['sbanners']);
        } else {
            message('serviceid is null', '', 'error');
        }
        include $this->template('service');
    }
    public function doMobileServicehome()
    {
        global $_GPC, $_W;
        $active    = 1;
        $serviceid = intval($_GPC['serviceid']);
        if ($serviceid > 0) {
            $service = pdo_fetch("SELECT * FROM " . tablename($this->servicehometable) . " WHERE id= " . $serviceid);
            if (!$service) {
                message('抱歉，信息不存在或是已经删除！', '', 'error');
            }
            $title    = $service['shname'];
            $simgs    = unserialize($service['shimgs']);
            $sbanners = unserialize($service['shbanners']);
        } else {
            message('serviceid is null', '', 'error');
        }
        include $this->template('servicehome');
    }
    public function doMobileAttend()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,fname,mobile,address FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        $active      = 1;
        $whasxxrange = 0;
        $serviceid   = intval($_GPC['serviceid']);
        if ($serviceid > 0) {
            $service = pdo_fetch("SELECT * FROM " . tablename($this->servicetable) . " WHERE id= " . $serviceid);
            if (!$service) {
                message('抱歉，信息不存在或是已经删除！', '', 'error');
            }
            $type  = intval($_GPC['type']);
            $title = $service['sname'];
            if ($service['sid'] <= 0) {
                $type         = 2;
                $workerid     = $service['wid'];
                $workerhas    = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE id= " . $workerid);
                $whasxxrange  = intval($workerhas['wxxrange']);
                $busytimelist = pdo_fetchall("SELECT * FROM " . tablename($this->timetable) . " WHERE uniacid = '{$_W['uniacid']}' and workerid = '{$workerid}' ");
            } else {
                $shopid = $service['sid'];
                $shop   = pdo_fetch("SELECT id,stitle,slogo FROM " . tablename($this->shoptable) . " WHERE id= " . $shopid);
                if (!$shop) {
                    message('抱歉，信息不存在或是已经删除！', '', 'error');
                }
                $busytimelist = pdo_fetchall("SELECT * FROM " . tablename($this->timetable) . " WHERE uniacid = '{$_W['uniacid']}' and shopid = '{$shopid}' ");
            }
        } else {
            message('serviceid is null', '', 'error');
        }
        $str       = '2016-02-18 ';
        $wktmbegin = $this->module['config']['wktmbegin'] . ':00';
        $wktmend   = $this->module['config']['wktmend'] . ':00';
        $wktmrange = intval($this->module['config']['wktmrange']);
        $wktmrange += $whasxxrange;
        $todayrq    = date("Y-n-d");
        $today      = intval(date("d"));
        $month      = date("m");
        $nextmonth  = "";
        $t          = date('t');
        $yydays     = intval($this->module['config']['wktmyy']);
        $rqtemp     = $todayrq . ' ' . $wktmbegin;
        $rqendtemp  = $todayrq . ' ' . $wktmend;
        $nowtime    = strtotime(date("Y-m-d H:i:s", time() + $wktmrange * 60));
        $tempinfos  = array();
        $temphours  = array();
        $tempinfos2 = array();
        $temphours2 = array();
        if ($t - $today >= $yydays) {
            for ($i = 0; $i < $yydays; $i++) {
                $shrq         = date('d日', strtotime("$todayrq +$i day"));
                $beginthatday = date('Y-n-d', strtotime("$todayrq +$i day")) . ' ' . $wktmbegin;
                $endthatday   = date('Y-n-d', strtotime("$todayrq +$i day")) . ' ' . $wktmend;
                $index        = 0;
                while ($index < 30) {
                    $range     = $wktmrange * $index;
                    $rangetime = strtotime(date('Y-m-d H:i:s', strtotime("$beginthatday +$range minute")));
                    $endtime   = strtotime($endthatday);
                    if ($rangetime <= $endtime && $rangetime > $nowtime) {
                        if (empty($busytimelist)) {
                            $shfz              = date('H:i', $rangetime);
                            $temphours[$index] = array(
                                "h" => $shfz
                            );
                        } else {
                            $isbusy = false;
                            foreach ($busytimelist as $timeindex => $row) {
                                if (intval($row['strtotime']) == $rangetime) {
                                    $isbusy = true;
                                    break;
                                }
                            }
                            if (!$isbusy) {
                                $shfz              = date('H:i', $rangetime);
                                $temphours[$index] = array(
                                    "h" => $shfz
                                );
                            }
                        }
                    }
                    $index++;
                }
                if (empty($temphours)) {
                    continue;
                }
                $tempinfos[$i] = array(
                    "d" => $shrq,
                    "hs" => $temphours
                );
            }
        } else {
            $hdays = $t - $today + 1;
            for ($i = 0; $i < $hdays; $i++) {
                $shrq         = date('d日', strtotime("$todayrq +$i day"));
                $beginthatday = date('Y-n-d', strtotime("$todayrq +$i day")) . ' ' . $wktmbegin;
                $endthatday   = date('Y-n-d', strtotime("$todayrq +$i day")) . ' ' . $wktmend;
                $index        = 0;
                while ($index < 30) {
                    $range     = $wktmrange * $index;
                    $rangetime = strtotime(date('Y-m-d H:i:s', strtotime("$beginthatday +$range minute")));
                    $endtime   = strtotime($endthatday);
                    if ($rangetime <= $endtime && $rangetime > $nowtime) {
                        if (empty($busytimelist)) {
                            $shfz              = date('H:i', $rangetime);
                            $temphours[$index] = array(
                                "h" => $shfz
                            );
                        } else {
                            $isbusy = false;
                            foreach ($busytimelist as $timeindex => $row) {
                                if (intval($row['strtotime']) == $rangetime) {
                                    $isbusy = true;
                                    break;
                                }
                            }
                            if (!$isbusy) {
                                $shfz              = date('H:i', $rangetime);
                                $temphours[$index] = array(
                                    "h" => $shfz
                                );
                            }
                        }
                    }
                    $index++;
                }
                if (empty($temphours)) {
                    continue;
                }
                $tempinfos[$i] = array(
                    "d" => $shrq,
                    "hs" => $temphours
                );
            }
            $nextmonth = date('m', strtotime("$todayrq +1 month"));
            $edays     = $yydays - $hdays;
            for ($j = 0; $j < $edays; $j++) {
                $add           = $j + $hdays;
                $shrq2         = date('d日', strtotime("$todayrq +$add day"));
                $beginthatday2 = date('Y-n-d', strtotime("$todayrq +$j day")) . ' ' . $wktmbegin;
                $endthatday2   = date('Y-n-d', strtotime("$todayrq +$j day")) . ' ' . $wktmend;
                $index         = 0;
                while ($index < 30) {
                    $range     = $wktmrange * $index;
                    $rangetime = strtotime(date('Y-m-d H:i:s', strtotime("$beginthatday2 +$range minute")));
                    $endtime   = strtotime($endthatday2);
                    if ($rangetime <= $endtime) {
                        if (empty($busytimelist)) {
                            $shfz               = date('H:i', $rangetime);
                            $temphours2[$index] = array(
                                "h" => $shfz
                            );
                        } else {
                            $isbusy = false;
                            foreach ($busytimelist as $timeindex => $row) {
                                if (intval($row['strtotime']) == $rangetime) {
                                    $isbusy = true;
                                    break;
                                }
                            }
                            if (!$isbusy) {
                                $shfz               = date('H:i', $rangetime);
                                $temphours2[$index] = array(
                                    "h" => $shfz
                                );
                            }
                        }
                    }
                    $index++;
                }
                if (empty($temphours2)) {
                    continue;
                }
                $tempinfos2[$j] = array(
                    "d" => $shrq2,
                    "hs" => $temphours2
                );
            }
        }
        $worker = $_SESSION['water_o2o_worker'];
        include $this->template('attend');
    }
    public function doMobileOrdertake()
    {
        global $_GPC, $_W;
        $shopid  = intval($_GPC['shopid']);
        $orderid = intval($_GPC['orderid']);
        $sql     = "SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and sid = '{$shopid}' and isfree = 1 and state = 2 ORDER BY id ";
        $list    = pdo_fetchall($sql);
        if (empty($list)) {
            message('商铺内没有可分派员工');
        }
        include $this->template('select');
    }
    public function doMobileOrdertakerandom()
    {
        global $_GPC, $_W;
        $shopid  = intval($_GPC['shopid']);
        $orderid = intval($_GPC['orderid']);
        ;
        if ($shopid < 0 || $orderid < 0) {
            message('2p is null');
        }
        $workers = pdo_fetchall("SELECT id,wname,mobile FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and sid = '{$shopid}' and isfree = 1 and state = 2 ");
        if (empty($workers)) {
            message('商铺内没有可分派员工');
        }
        $size   = count($workers) - 1;
        $windex = rand(0, $size);
        $worker = $workers[$windex];
        $data   = array(
            'wid' => $workerid,
            'wname' => $worker['wname'],
            'wmobile' => $worker['mobile']
        );
        pdo_update($this->ordertable, $data, array(
            'id' => $orderid
        ));
        $_SESSION['water_o2o_worker'] = $worker;
        $this->doMobileShoporder();
    }
    public function doMobileOrderWorker()
    {
        global $_GPC, $_W;
        $shopid   = intval($_GPC['shopid']);
        $orderid  = intval($_GPC['orderid']);
        $type     = intval($_GPC['type']);
        $workerid = intval($_GPC['workerid']);
        if ($shopid < 0 || $orderid < 0 || $workerid < 0) {
            message('3p is null');
        }
        $worker = pdo_fetch("SELECT id,wname,mobile FROM " . tablename($this->workertable) . " WHERE id= " . $workerid);
        $data   = array(
            'wid' => $workerid,
            'wname' => $worker['wname'],
            'wmobile' => $worker['mobile']
        );
        pdo_update($this->ordertable, $data, array(
            'id' => $orderid
        ));
        $_SESSION['water_o2o_worker'] = $worker;
        $this->doMobileShoporder();
    }
    public function doMobileSelectShop()
    {
        global $_GPC, $_W;
        $svhmid      = intval($_GPC['serviceid']);
        $servicehome = pdo_fetch("SELECT * FROM " . tablename($this->servicehometable) . " WHERE id= " . $svhmid);
        $sql         = "SELECT svs.*,shop.slogo as shoplogo,shop.stitle as shoptitle,shop.sdesc as shopdesc FROM " . tablename($this->servicetable) . " as svs 
					left join " . tablename($this->shoptable) . " as shop on svs.sid = shop.id 
					WHERE svs.uniacid = '{$_W['uniacid']}' and svs.svhmid = '{$svhmid}' and svs.state = 2 and shop.state = 2 ORDER BY svs.id ";
        $list        = pdo_fetchall($sql);
        include $this->template('selectshop');
    }
    public function doMobileSelect()
    {
        global $_GPC, $_W;
        $shopid    = intval($_GPC['shopid']);
        $serviceid = intval($_GPC['serviceid']);
        $type      = intval($_GPC['type']);
        $sql       = "SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY id ";
        $list      = pdo_fetchall($sql);
        include $this->template('select');
    }
    public function doMobileSelectSure()
    {
        global $_GPC, $_W;
        $shopid    = intval($_GPC['shopid']);
        $serviceid = intval($_GPC['serviceid']);
        $type      = intval($_GPC['type']);
        $workerid  = intval($_GPC['workerid']);
        if ($shopid < 0 || $serviceid < 0 || $workerid < 0) {
            message('3p is null');
        }
        $worker                       = pdo_fetch("SELECT id,wname,mobile FROM " . tablename($this->workertable) . " WHERE id= " . $workerid);
        $_SESSION['water_o2o_worker'] = $worker;
        $this->doMobileAttend();
    }
    public function doMobileMakeorder()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        if (empty($openid)) {
            $this->doMobileAuthuser();
        }
        $serviceid = intval($_GPC['serviceid']);
        $service   = pdo_fetch("SELECT * FROM " . tablename($this->servicetable) . " WHERE id = " . $serviceid);
        if (empty($service)) {
            message('service is null');
        }
        $stime = $_GPC['stime'];
        $smsg  = $_GPC['smsg'];
        if (empty($smsg)) {
            $smsg = "期待哦";
        }
        $fans = pdo_fetch("SELECT id,fname,mobile,address FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        $type = intval($_GPC['type']);
        $wid  = 0;
        if ($type == 2) {
            $wid   = $_GPC['workerid'];
            $wname = $_GPC['wname'];
        }
        $_SESSION['water_o2o_worker'] = "";
        $orderno                      = $this->getMillisecond();
        $data                         = array(
            'uniacid' => $_W['uniacid'],
            'orderno' => $orderno,
            'ordertime' => date("Y-m-d H:i", time()),
            'orderfee' => $service['sprice'],
            'orderno' => $orderno,
            'openid' => $openid,
            'wid' => $wid,
            'wname' => $wname,
            'sid' => $service['sid'],
            'stitle' => $service['stitle'],
            'svid' => $serviceid,
            'svname' => $service['sname'],
            'stime' => $stime,
            'smsg' => $smsg,
            'fid' => $fans['id'],
            'fname' => $fans['fname'],
            'fmobile' => $fans['mobile'],
            'faddress' => $fans['address'],
            'type' => $type,
            'state' => 0
        );
        pdo_delete($this->ordertable, array(
            'svid' => $serviceid,
            'openid' => $openid,
            'state' => 0
        ));
        pdo_insert($this->ordertable, $data);
        $orderid = pdo_insertid();
        $this->updateTime($service['sid'], $wid, $stime, 'add');
        $params['tid']     = $orderid . '#' . $orderno;
        $params['user']    = $openid;
        $params['fee']     = $service['sprice'];
        $params['title']   = '服务费用';
        $params['ordersn'] = $orderno;
        $params['virtual'] = false;
        $this->pay($params);
    }
    public function doMobilePayOrder()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        if (empty($openid)) {
            $this->doMobileAuthuser();
        }
        $orderid = intval($_GPC['orderid']);
        if ($orderid <= 0) {
            message('orderid is null');
        }
        $order             = pdo_fetch("SELECT * FROM " . tablename($this->ordertable) . " WHERE id= " . $orderid);
        $params['tid']     = $orderid . '#' . $order['orderno'];
        $params['user']    = $openid;
        $params['fee']     = $order['orderfee'];
        $params['title']   = '服务费用';
        $params['ordersn'] = $order['orderno'];
        $params['virtual'] = false;
        $this->pay($params);
    }
    public function doMobileOrder()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        if (empty($openid)) {
            $this->doMobileAuthuser();
        }
        $active    = 2;
        $title     = $this->ordertitle;
        $state     = 0;
        $statetype = $_GPC['statetype'];
        if (empty($statetype)) {
            $statetype = "topay";
        }
        if ($statetype == "ing") {
            $state = '(1,2)';
        } elseif ($statetype == "end") {
            $state = '(3)';
        } else {
            $state = '(0)';
        }
        $sql  = "SELECT o.*,sv.sdesc,sv.simgs,sv.sprice,sv.sminute FROM " . tablename($this->ordertable) . " as o
					left join " . tablename($this->servicetable) . " as sv on sv.id = o.svid
				 WHERE o.openid = '{$openid}' and o.uniacid = '{$_W['uniacid']}' and o.state in {$state} ORDER BY o.id desc";
        $list = pdo_fetchall($sql);
        include $this->template('order');
    }
    public function doMobileOrderpl()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        if (empty($openid)) {
            $this->doMobileAuthuser();
        }
        $statetype = $_GPC['statetype'];
        $orderid   = intval($_GPC['orderid']);
        $sql       = "SELECT o.*,sv.sdesc,sv.slogo,sv.sprice,sv.sminute FROM " . tablename($this->ordertable) . " as o
					left join " . tablename($this->servicetable) . " as sv on sv.id = o.svid
						 WHERE o.openid = '{$openid}' and o.uniacid = '{$_W['uniacid']}' and o.id = '{$orderid}' ORDER BY o.id desc";
        $order     = pdo_fetch($sql);
        include $this->template('orderpl');
    }
    public function doMobileDoOrderpl()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        if (empty($openid)) {
            $this->doMobileAuthuser();
        }
        $rank = $_GPC['rank'];
        if (empty($rank)) {
            $rank = 1;
        }
        $comments = $_GPC['comments'];
        if (empty($comments)) {
            $comments = '好评';
        }
        $orderid   = intval($_GPC['orderid']);
        $serviceid = intval($_GPC['serviceid']);
        $workerid  = intval($_GPC['workerid']);
        $shopid    = intval($_GPC['shopid']);
        $data      = array(
            'uniacid' => $_W['uniacid'],
            'orderid' => $orderid,
            'serviceid' => $serviceid,
            'workerid' => $workerid,
            'shopid' => $shopid,
            'state' => 1,
            'rank' => $rank,
            'content' => $comments,
            'etime' => date("Y-m-d H:i", time())
        );
        pdo_delete($this->pltable, array(
            'orderid' => $orderid
        ));
        pdo_insert($this->pltable, $data);
        $statetype = $_GPC['statetype'];
        $this->domobileOrder();
    }
    public function doMobileOrderCancel()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        if (empty($openid)) {
            $this->doMobileAuthuser();
        }
        $orderid   = intval($_GPC['orderid']);
        $statetype = $_GPC['statetype'];
        pdo_delete($this->ordertable, array(
            'id' => $orderid
        ));
        $this->doMobileOrder();
    }
    public function doMobilePublicdream()
    {
        global $_GPC, $_W;
        $active = 2;
        $title  = $this->ordertitle;
        include $this->template('publicdream');
    }
    public function doMobileCenter()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg,mobile,fname FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        if (empty($fans['mobile'])) {
            $url                           = $_W['siteroot'] . 'app/' . $this->createMobileUrl('center');
            $_SESSION['water_o2o_app_url'] = $url;
            $system                        = $this->module['config'];
            include $this->template('login');
        } else {
            $active = 3;
            $title  = $this->centertitle;
            include $this->template('center');
        }
    }
    public function doMobileCenteryhq()
    {
        global $_GPC, $_W;
        if (empty($_W['member']['uid'])) {
            checkauth();
        }
        load()->model('mc');
        load()->model('activity');
        $type = $_GPC['type'];
        if (empty($type)) {
            $type = "undh";
        }
        if ($type == "undh") {
            $zkq   = activity_coupon_available($_W['member']['uid']);
            $list1 = $zkq['data'];
            $djq   = activity_token_available($_W['member']['uid']);
            $list2 = $djq['data'];
            $title = $this->centeryhq1title;
        } else {
            $zkqhas = activity_coupon_owned($_W['member']['uid']);
            $list3  = $zkqhas['data'];
            $djqhas = activity_token_owned($_W['member']['uid']);
            $list4  = $djqhas['data'];
            $title  = $this->centeryhq2title;
        }
        $active = 3;
        include $this->template('centeryhq');
    }
    public function doMobileTakeyhq()
    {
        global $_GPC, $_W;
        if (empty($_W['member']['uid'])) {
            checkauth();
        }
        load()->model('mc');
        load()->model('activity');
        $type      = $_GPC['type'];
        $item      = $_GPC['item'];
        $title     = $item['title'];
        $discount  = $item['discount'];
        $condition = $item['condition'];
        if ($type == "1") {
            $sql    = "SELECT couponid FROM " . tablename('activity_coupon') . " where type = 1 and credit = 0 and title = '{$title}' and discount= '{$discount}'   and uniacid = {$_W['uniacid']} ";
            $coupon = pdo_fetch($sql);
            $result = activity_coupon_grant($_W['member']['uid'], $coupon['couponid']);
        } else {
            $sql    = "SELECT couponid FROM " . tablename('activity_coupon') . " where type = 2 and credit = 0 and title = '{$title}' and discount = '{$discount}' and `condition` = '{$condition}'  and uniacid = {$_W['uniacid']} ";
            $token  = pdo_fetch($sql);
            $result = activity_token_grant($_W['member']['uid'], $token['couponid']);
        }
        if ($result) {
            $type   = "hasdh";
            $zkqhas = activity_coupon_owned($_W['member']['uid']);
            $list3  = $zkqhas['data'];
            $djqhas = activity_token_owned($_W['member']['uid']);
            $list4  = $djqhas['data'];
            include $this->template('centeryhq');
        } else {
            message('领取优惠券错误');
        }
    }
    public function doMobileShoperentry()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg,shopid,balance FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        if ($fans['shopid'] <= 0) {
            $url                           = $_W['siteroot'] . 'app/' . $this->createMobileUrl('shopinfo');
            $_SESSION['water_o2o_app_url'] = $url;
            $system                        = $this->module['config'];
            include $this->template('shoplogin');
        } else {
            $active = 3;
            $title  = $this->shopcentertitle;
            $shop   = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE uniacid = '{$_W['uniacid']}' and sopenid ='{$openid}'");
            if (empty($shop)) {
                message('请确认新增商铺后微信绑定商铺主人');
            }
            if ($shop['wxadd'] == -1) {
                include $this->template('shopcenter');
            } elseif ($shop['wxadd'] == 1) {
                $this->doMobileShopinfo();
            } elseif ($shop['wxadd'] == 2) {
                $system = $this->module['config'];
                include $this->template('shopwait');
            } else {
                include $this->template('shopcenter');
            }
        }
    }
    public function doMobileShopitem()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg,shopid FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        if ($fans['shopid'] <= 0) {
            message('不是店主');
        }
        $statetype = $_GPC['statetype'];
        $type      = $_SESSION['water_o2o_shop_item_type'];
        if (!empty($type)) {
            $statetype                            = $type;
            $_SESSION['water_o2o_shop_item_type'] = null;
        }
        if (empty($statetype)) {
            $statetype = "all";
        }
        if ($statetype == "ing") {
            $state = '(1)';
        } elseif ($statetype == "end") {
            $state = '(0)';
        } else {
            $state = '(0,1)';
        }
        $sql    = "SELECT * FROM " . tablename($this->servicetable) . " WHERE uniacid = '{$_W['uniacid']}' and sid= '{$fans['shopid']}' and state in {$state} ORDER BY id ";
        $list   = pdo_fetchall($sql);
        $active = 3;
        $title  = $this->shopitemtitle;
        include $this->template('shopitem');
    }
    public function doMobileShopdeleteitem()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg,shopid FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        if ($fans['shopid'] <= 0) {
            message('不是店主');
        }
        $serviceid                            = intval($_GPC['serviceid']);
        $statetype                            = $_GPC['statetype'];
        $_SESSION['water_o2o_shop_item_type'] = $statetype;
        pdo_delete($this->servicetable, array(
            'id' => $serviceid
        ));
        $this->doMobileShopitem();
    }
    public function doMobileIteminfo()
    {
        global $_GPC, $_W;
        $openid    = $_W['fans']['from_user'];
        $serviceid = intval($_GPC['serviceid']);
        $status    = $_GPC['status'];
        $service   = pdo_fetch("SELECT * FROM " . tablename($this->servicetable) . " WHERE id= " . $serviceid);
        include $this->template('iteminfo');
    }
    public function doMobileDoiteminfo()
    {
        global $_GPC, $_W;
        $serviceid = intval($_GPC['serviceid']);
        $data      = array(
            'sname' => $_GPC['sname'],
            'sdesc' => $_GPC['sdesc'],
            'scontent' => $_GPC['scontent'],
            'syynotice' => $_GPC['syynotice'],
            'sreminder' => $_GPC['sreminder'],
            'sprice' => floatval($_GPC['sprice']),
            'sminute' => intval($_GPC['sminute']),
            'state' => intval($_GPC['defaultstate'])
        );
        if (!empty($serviceid)) {
            pdo_update($this->servicetable, $data, array(
                'id' => $serviceid
            ));
            $status = $_GPC['status'];
            if ($status == 'work') {
                $this->doMobileWorkitem();
            } else {
                $this->doMobileShopitem();
            }
        } else {
            message('svid is null');
        }
    }
    public function doMobileSetitemstate()
    {
        global $_GPC, $_W;
        $serviceid = intval($_GPC['serviceid']);
        $service   = pdo_fetch("SELECT state FROM " . tablename($this->servicetable) . " WHERE id= " . $serviceid);
        $state     = 0;
        if ($service['state'] == "1") {
            $state = 0;
        } else {
            $state = 1;
        }
        $data = array(
            'state' => $state
        );
        if (!empty($serviceid)) {
            pdo_update($this->servicetable, $data, array(
                'id' => $serviceid
            ));
            $status = $_GPC['status'];
            if ($status == 'work') {
                $this->doMobileWorkitem();
            } else {
                $this->doMobileShopitem();
            }
        } else {
            message('svid is null');
        }
    }
    public function doMobileShoptime()
    {
        global $_GPC, $_W;
        $openid       = $_W['fans']['from_user'];
        $active       = 3;
        $title        = $this->shoptimetitle;
        $shop         = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE uniacid = '{$_W['uniacid']}' and sopenid ='{$openid}'");
        $busytimelist = pdo_fetchall("SELECT * FROM " . tablename($this->timetable) . " WHERE uniacid = '{$_W['uniacid']}' and shopid = '{$shop['id']}' ");
        $type         = $_GPC['type'];
        if (empty($type)) {
            $type = 'all';
        }
        if ($type == 'all') {
            $str        = '2016-02-18 ';
            $wktmbegin  = $this->module['config']['wktmbegin'] . ':00';
            $wktmend    = $this->module['config']['wktmend'] . ':00';
            $wktmrange  = intval($this->module['config']['wktmrange']);
            $todayrq    = date("Y-n-d");
            $today      = intval(date("d"));
            $month      = date("m");
            $nextmonth  = "";
            $y          = date('Y');
            $t          = date('t');
            $yydays     = intval($this->module['config']['wktmyy']);
            $rqtemp     = $todayrq . ' ' . $wktmbegin;
            $rqendtemp  = $todayrq . ' ' . $wktmend;
            $nowtime    = strtotime(date("Y-m-d H:i:s", time() + $wktmrange * 60));
            $tempinfos  = array();
            $temphours  = array();
            $tempinfos2 = array();
            $temphours2 = array();
            if ($t - $today >= $yydays) {
                for ($i = 0; $i < $yydays; $i++) {
                    $shrq         = date('d日', strtotime("$todayrq +$i day"));
                    $beginthatday = date('Y-n-d', strtotime("$todayrq +$i day")) . ' ' . $wktmbegin;
                    $endthatday   = date('Y-n-d', strtotime("$todayrq +$i day")) . ' ' . $wktmend;
                    $index        = 0;
                    while ($index < 30) {
                        $range     = $wktmrange * $index;
                        $rangetime = strtotime(date('Y-m-d H:i:s', strtotime("$beginthatday +$range minute")));
                        $endtime   = strtotime($endthatday);
                        if ($rangetime <= $endtime && $rangetime > $nowtime) {
                            if (empty($busytimelist)) {
                                $shfz              = date('H:i', $rangetime);
                                $temphours[$index] = array(
                                    "h" => $shfz
                                );
                            } else {
                                $isbusy = false;
                                foreach ($busytimelist as $timeindex => $row) {
                                    if (intval($row['strtotime']) == $rangetime) {
                                        $isbusy = true;
                                        break;
                                    }
                                }
                                if (!$isbusy) {
                                    $shfz              = date('H:i', $rangetime);
                                    $temphours[$index] = array(
                                        "h" => $shfz
                                    );
                                }
                            }
                        }
                        $index++;
                    }
                    if (empty($temphours)) {
                        continue;
                    }
                    $tempinfos[$i] = array(
                        "d" => $shrq,
                        "hs" => $temphours
                    );
                }
            } else {
                $hdays = $t - $today + 1;
                for ($i = 0; $i < $hdays; $i++) {
                    $shrq         = date('d日', strtotime("$todayrq +$i day"));
                    $beginthatday = date('Y-n-d', strtotime("$todayrq +$i day")) . ' ' . $wktmbegin;
                    $endthatday   = date('Y-n-d', strtotime("$todayrq +$i day")) . ' ' . $wktmend;
                    $index        = 0;
                    while ($index < 30) {
                        $range     = $wktmrange * $index;
                        $rangetime = strtotime(date('Y-m-d H:i:s', strtotime("$beginthatday +$range minute")));
                        $endtime   = strtotime($endthatday);
                        if ($rangetime <= $endtime && $rangetime > $nowtime) {
                            if (empty($busytimelist)) {
                                $shfz              = date('H:i', $rangetime);
                                $temphours[$index] = array(
                                    "h" => $shfz
                                );
                            } else {
                                $isbusy = false;
                                foreach ($busytimelist as $timeindex => $row) {
                                    if (intval($row['strtotime']) == $rangetime) {
                                        $isbusy = true;
                                        break;
                                    }
                                }
                                if (!$isbusy) {
                                    $shfz              = date('H:i', $rangetime);
                                    $temphours[$index] = array(
                                        "h" => $shfz
                                    );
                                }
                            }
                        }
                        $index++;
                    }
                    if (empty($temphours)) {
                        continue;
                    }
                    $tempinfos[$i] = array(
                        "d" => $shrq,
                        "hs" => $temphours
                    );
                }
                $nextmonth = date('m', strtotime("$todayrq +1 month"));
                $edays     = $yydays - $hdays;
                for ($j = 0; $j < $edays; $j++) {
                    $add           = $j + $hdays;
                    $shrq2         = date('d日', strtotime("$todayrq +$add day"));
                    $beginthatday2 = date('Y-n-d', strtotime("$todayrq +$j day")) . ' ' . $wktmbegin;
                    $endthatday2   = date('Y-n-d', strtotime("$todayrq +$j day")) . ' ' . $wktmend;
                    $index         = 0;
                    while ($index < 30) {
                        $range     = $wktmrange * $index;
                        $rangetime = strtotime(date('Y-m-d H:i:s', strtotime("$beginthatday2 +$range minute")));
                        $endtime   = strtotime($endthatday2);
                        if ($rangetime <= $endtime) {
                            if (empty($busytimelist)) {
                                $shfz               = date('H:i', $rangetime);
                                $temphours2[$index] = array(
                                    "h" => $shfz
                                );
                            } else {
                                $isbusy = false;
                                foreach ($busytimelist as $timeindex => $row) {
                                    if (intval($row['strtotime']) == $rangetime) {
                                        $isbusy = true;
                                        break;
                                    }
                                }
                                if (!$isbusy) {
                                    $shfz               = date('H:i', $rangetime);
                                    $temphours2[$index] = array(
                                        "h" => $shfz
                                    );
                                }
                            }
                        }
                        $index++;
                    }
                    if (empty($temphours2)) {
                        continue;
                    }
                    $tempinfos2[$j] = array(
                        "d" => $shrq2,
                        "hs" => $temphours2
                    );
                }
            }
        } elseif ($type == 'free') {
            $list = pdo_fetchall("SELECT * FROM " . tablename($this->timetable) . " WHERE uniacid = '{$_W['uniacid']}' and shopid = '{$shop['id']}' ");
        } else {
            $list = pdo_fetchall("SELECT * FROM " . tablename($this->timetable) . " WHERE uniacid = '{$_W['uniacid']}' and shopid = '{$shop['id']}' ");
        }
        include $this->template('shoptime');
    }
    public function doMobileWorktime()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($worker['openid']) || empty($worker['nickname'])) {
            $this->doMobileAuthworker();
        }
        $active       = 3;
        $title        = $this->shoptimetitle;
        $busytimelist = pdo_fetchall("SELECT * FROM " . tablename($this->timetable) . " WHERE uniacid = '{$_W['uniacid']}' and workerid = '{$worker['id']}' ");
        $type         = $_GPC['type'];
        if (empty($type)) {
            $type = 'all';
        }
        if ($type == 'all') {
            $str        = '2016-02-18 ';
            $wktmbegin  = $this->module['config']['wktmbegin'] . ':00';
            $wktmend    = $this->module['config']['wktmend'] . ':00';
            $wktmrange  = intval($this->module['config']['wktmrange']);
            $todayrq    = date("Y-n-d");
            $today      = intval(date("d"));
            $month      = date("m");
            $nextmonth  = "";
            $y          = date('Y');
            $t          = date('t');
            $yydays     = intval($this->module['config']['wktmyy']);
            $rqtemp     = $todayrq . ' ' . $wktmbegin;
            $rqendtemp  = $todayrq . ' ' . $wktmend;
            $nowtime    = strtotime(date("Y-m-d H:i:s", time() + $wktmrange * 60));
            $tempinfos  = array();
            $temphours  = array();
            $tempinfos2 = array();
            $temphours2 = array();
            if ($t - $today >= $yydays) {
                for ($i = 0; $i < $yydays; $i++) {
                    $shrq         = date('d日', strtotime("$todayrq +$i day"));
                    $beginthatday = date('Y-n-d', strtotime("$todayrq +$i day")) . ' ' . $wktmbegin;
                    $endthatday   = date('Y-n-d', strtotime("$todayrq +$i day")) . ' ' . $wktmend;
                    $index        = 0;
                    while ($index < 30) {
                        $range     = $wktmrange * $index;
                        $rangetime = strtotime(date('Y-m-d H:i:s', strtotime("$beginthatday +$range minute")));
                        $endtime   = strtotime($endthatday);
                        if ($rangetime <= $endtime && $rangetime > $nowtime) {
                            if (empty($busytimelist)) {
                                $shfz              = date('H:i', $rangetime);
                                $temphours[$index] = array(
                                    "h" => $shfz
                                );
                            } else {
                                $isbusy = false;
                                foreach ($busytimelist as $timeindex => $row) {
                                    if (intval($row['strtotime']) == $rangetime) {
                                        $isbusy = true;
                                        break;
                                    }
                                }
                                if (!$isbusy) {
                                    $shfz              = date('H:i', $rangetime);
                                    $temphours[$index] = array(
                                        "h" => $shfz
                                    );
                                }
                            }
                        }
                        $index++;
                    }
                    if (empty($temphours)) {
                        continue;
                    }
                    $tempinfos[$i] = array(
                        "d" => $shrq,
                        "hs" => $temphours
                    );
                }
            } else {
                $hdays = $t - $today + 1;
                for ($i = 0; $i < $hdays; $i++) {
                    $shrq         = date('d日', strtotime("$todayrq +$i day"));
                    $beginthatday = date('Y-n-d', strtotime("$todayrq +$i day")) . ' ' . $wktmbegin;
                    $endthatday   = date('Y-n-d', strtotime("$todayrq +$i day")) . ' ' . $wktmend;
                    $index        = 0;
                    while ($index < 30) {
                        $range     = $wktmrange * $index;
                        $rangetime = strtotime(date('Y-m-d H:i:s', strtotime("$beginthatday +$range minute")));
                        $endtime   = strtotime($endthatday);
                        if ($rangetime <= $endtime && $rangetime > $nowtime) {
                            if (empty($busytimelist)) {
                                $shfz              = date('H:i', $rangetime);
                                $temphours[$index] = array(
                                    "h" => $shfz
                                );
                            } else {
                                $isbusy = false;
                                foreach ($busytimelist as $timeindex => $row) {
                                    if (intval($row['strtotime']) == $rangetime) {
                                        $isbusy = true;
                                        break;
                                    }
                                }
                                if (!$isbusy) {
                                    $shfz              = date('H:i', $rangetime);
                                    $temphours[$index] = array(
                                        "h" => $shfz
                                    );
                                }
                            }
                        }
                        $index++;
                    }
                    if (empty($temphours)) {
                        continue;
                    }
                    $tempinfos[$i] = array(
                        "d" => $shrq,
                        "hs" => $temphours
                    );
                }
                $nextmonth = date('m', strtotime("$todayrq +1 month"));
                $edays     = $yydays - $hdays;
                for ($j = 0; $j < $edays; $j++) {
                    $add           = $j + $hdays;
                    $shrq2         = date('d日', strtotime("$todayrq +$add day"));
                    $beginthatday2 = date('Y-n-d', strtotime("$todayrq +$j day")) . ' ' . $wktmbegin;
                    $endthatday2   = date('Y-n-d', strtotime("$todayrq +$j day")) . ' ' . $wktmend;
                    $index         = 0;
                    while ($index < 30) {
                        $range     = $wktmrange * $index;
                        $rangetime = strtotime(date('Y-m-d H:i:s', strtotime("$beginthatday2 +$range minute")));
                        $endtime   = strtotime($endthatday2);
                        if ($rangetime <= $endtime) {
                            if (empty($busytimelist)) {
                                $shfz               = date('H:i', $rangetime);
                                $temphours2[$index] = array(
                                    "h" => $shfz
                                );
                            } else {
                                $isbusy = false;
                                foreach ($busytimelist as $timeindex => $row) {
                                    if (intval($row['strtotime']) == $rangetime) {
                                        $isbusy = true;
                                        break;
                                    }
                                }
                                if (!$isbusy) {
                                    $shfz               = date('H:i', $rangetime);
                                    $temphours2[$index] = array(
                                        "h" => $shfz
                                    );
                                }
                            }
                        }
                        $index++;
                    }
                    if (empty($temphours2)) {
                        continue;
                    }
                    $tempinfos2[$j] = array(
                        "d" => $shrq2,
                        "hs" => $temphours2
                    );
                }
            }
        } elseif ($type == 'free') {
            $list = pdo_fetchall("SELECT * FROM " . tablename($this->timetable) . " WHERE uniacid = '{$_W['uniacid']}' and workerid = '{$worker['id']}' ");
        } else {
            $list = pdo_fetchall("SELECT * FROM " . tablename($this->timetable) . " WHERE uniacid = '{$_W['uniacid']}' and workerid = '{$worker['id']}' ");
        }
        include $this->template('worktime');
    }
    public function doMobileShoptimemgr()
    {
        global $_GPC, $_W;
        $shoptime = $_GPC['shoptime'];
        $shopid   = intval($_GPC['shopid']);
        foreach ($shoptime as $index => $row) {
            $this->updateTime($shopid, 0, $row, 'add');
        }
        $this->doMobileShoptime();
    }
    public function doMobileWorktimemgr()
    {
        global $_GPC, $_W;
        $worktime = $_GPC['worktime'];
        $workerid = intval($_GPC['workerid']);
        foreach ($worktime as $index => $row) {
            $this->updateTime(0, $workerid, $row, 'add');
        }
        $this->doMobileWorktime();
    }
    public function doMobileShoptimemgrdelete()
    {
        global $_GPC, $_W;
        $shoptime = $_GPC['shoptime'];
        $shopid   = intval($_GPC['shopid']);
        foreach ($shoptime as $index => $row) {
            $this->updateTime($shopid, 0, $row, 'delete');
        }
        $this->doMobileShoptime();
    }
    public function doMobileWorktimemgrdelete()
    {
        global $_GPC, $_W;
        $worktime = $_GPC['worktime'];
        $workerid = intval($_GPC['workerid']);
        foreach ($worktime as $index => $row) {
            $this->updateTime(0, $workerid, $row, 'delete');
        }
        $this->doMobileWorktime();
    }
    public function updateTime($shopid, $workerid, $stime, $type)
    {
        global $_GPC, $_W;
        $data   = array(
            'uniacid' => $_W['uniacid'],
            'stime' => $stime,
            'shopid' => $shopid,
            'workerid' => $workerid,
            'state' => 1
        );
        $result = pdo_delete($this->timetable, $data);
        if ($type == 'add') {
            $thattime          = $this->dealstime($stime);
            $data['strtotime'] = strtotime($thattime);
            $data['sdatetime'] = date("Y-m-d H:i", strtotime($thattime));
            pdo_insert($this->timetable, $data);
            $result = pdo_insertid();
        }
        return $result;
    }
    public function dealstime($stime)
    {
        $thatm = intval(substr($stime, 0, 2));
        $month = intval(date("m"));
        $year  = intval(date('Y'));
        if ($thatm < $month) {
            $year += 1;
        }
        $stime = str_replace("月", "-", $stime);
        $stime = str_replace("日", "", $stime);
        $str   = $year . '-' . $stime . ':00';
        return $str;
    }
    public function doMobileShoporder()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg,shopid FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        $active    = 2;
        $title     = $this->shopordertitle;
        $state     = 0;
        $statetype = $_GPC['statetype'];
        if (empty($statetype)) {
            $statetype = "tosv";
        }
        if ($statetype == "ing") {
            $state = '(2)';
        } elseif ($statetype == "end") {
            $state = '(3)';
        } else {
            $state = '(1)';
        }
        $sql  = "SELECT o.*,sv.sdesc,sv.simgs,sv.sprice,sv.sminute FROM " . tablename($this->ordertable) . " as o
					left join " . tablename($this->servicetable) . " as sv on sv.id = o.svid
						 WHERE o.sid = '{$fans['shopid']}' and o.uniacid = '{$_W['uniacid']}' and o.state in {$state} ORDER BY o.id desc";
        $list = pdo_fetchall($sql);
        include $this->template('shoporder');
    }
    public function doMobileShopqb()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg,balance,shopid FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        if ($fans['shopid'] <= 0) {
            message('不是店长');
        }
        $active = 3;
        $title  = $this->shopcenterQBtitle;
        include $this->template('shopcenterqb');
    }
    public function doMobileTransferqb()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg,balance FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            die(json_encode(array(
                "state" => "0",
                "msg" => 'worker is not exist 1'
            )));
        }
        $worker = pdo_fetch("SELECT id,sid,openid,balance FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and openid= '{$openid}'");
        if (empty($worker)) {
            die(json_encode(array(
                "state" => "0",
                "msg" => 'worker is not exist 2'
            )));
        }
        $balance = $this->getSumCanFlowfeeByWid($worker['id']);
        if (floatval($balance) > 1) {
            $ret = $this->transfer($worker['openid'], $balance, '系统提现');
            if ($ret['code'] == "0") {
                $system   = $this->module['config'];
                $cost     = floatval($system['shopcost']) / 100;
                $flowdata = array(
                    'uniacid' => $_W['uniacid'],
                    'workerid' => $worker['id'],
                    'shopid' => $worker['sid'],
                    'fmoney' => $balance * (1 + $cost),
                    'fcost' => $balance * $cost,
                    'fapply' => $balance,
                    'ftime' => date("Y-m-d H:i", time()),
                    'state' => 1,
                    'ftitle' => '员工提现'
                );
                pdo_insert($this->fondtable, $flowdata);
                $fondid = pdo_insertid();
                die(json_encode(array(
                    'state' => "1",
                    'msg' => $ret['message']
                )));
            } else {
                die(json_encode(array(
                    'state' => "0",
                    'msg' => $ret['message']
                )));
            }
        } else {
            die(json_encode(array(
                'state' => "0",
                'msg' => '余额超过1元时才可提现'
            )));
        }
    }
    public function doMobileTransferqbforshop()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg,balance,shopid FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            die(json_encode(array(
                "state" => "0",
                "msg" => 'shoper is not exist 1'
            )));
        }
        if ($fans['shopid'] <= 0) {
            message('不是店主');
        }
        $balance = $this->getSumCanFlowfeeBySid($fans['shopid']);
        if (floatval($balance) > 1) {
            $ret = $this->transfer($fans['openid'], $balance, '系统提现');
            if ($ret['code'] == "0") {
                $system   = $this->module['config'];
                $cost     = floatval($system['workercost']) / 100;
                $flowdata = array(
                    'uniacid' => $_W['uniacid'],
                    'workerid' => 0,
                    'shopid' => $worker['sid'],
                    'fmoney' => $balance * (1 + $cost),
                    'fcost' => $balance * $cost,
                    'fapply' => $balance,
                    'ftime' => date("Y-m-d H:i", time()),
                    'state' => 1,
                    'ftitle' => '店主提现'
                );
                pdo_insert($this->fondtable, $flowdata);
                $fondid = pdo_insertid();
                die(json_encode(array(
                    'state' => "1",
                    'msg' => $ret['message']
                )));
            } else {
                die(json_encode(array(
                    'state' => "0",
                    'msg' => $ret['message']
                )));
            }
        } else {
            die(json_encode(array(
                'state' => "0",
                'msg' => '余额超过1元时才可提现'
            )));
        }
    }
    public function doMobileShopmanage()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg,shopid FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        if ($fans['shopid'] <= 0) {
            message('不是店长');
        }
        $active = 3;
        $title  = $this->shopmanagetitle;
        $shop   = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE uniacid = '{$_W['uniacid']}' and sopenid ='{$openid}'");
        include $this->template('shopmanage');
    }
    public function doMobileShopmembers()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg,shopid FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        if ($fans['shopid'] <= 0) {
            message('不是店长');
        }
        $active = 3;
        $title  = $this->shopmembertitle;
        $type   = $_GPC['type'];
        if (empty($type)) {
            $type = "all";
        }
        $list = pdo_fetchall("SELECT fans.* FROM " . tablename($this->fanstable) . " as fans left join " . tablename($this->ordertable) . " as ord on fans.openid = ord.openid WHERE fans.uniacid = '{$_W['uniacid']}' and ord.state in (1,2,3,4) group by fans.openid ");
        include $this->template('shopmembers');
    }
    public function doMobileShopinfo()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        $active = 3;
        $title  = $this->shopinfotitle;
        $shop   = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE uniacid = '{$_W['uniacid']}' and sopenid ='{$openid}'");
        include $this->template('shopinfo');
    }
    public function doMobileDoshopinfo()
    {
        global $_GPC, $_W;
        $shopid = intval($_GPC['shopid']);
        $data   = array(
            'stitle' => $_GPC['stitle'],
            'smobile' => $_GPC['smobile'],
            'saddress' => $_GPC['saddress'],
            'slocation' => $slocation,
            'sdesc' => $_GPC['sdesc'],
            'suname' => $_GPC['suname']
        );
        if (!empty($shopid)) {
            $shop = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE id ='{$shopid}'");
            if ($shop['wxadd'] == -1) {
                pdo_update($this->shoptable, $data, array(
                    'id' => $shopid
                ));
                $this->doMobileShopmanage();
            } elseif ($shop['wxadd'] == 1) {
                $system        = $this->module['config'];
                $data['wxadd'] = 2;
                pdo_update($this->shoptable, $data, array(
                    'id' => $shopid
                ));
                include $this->template('workerwait');
            }
        } else {
            message('svid is null');
        }
    }
    public function doMobileWorkerentry()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($worker['openid']) || empty($worker['nickname'])) {
            $this->doMobileAuthworker();
        }
        if ($worker['sid'] > 0 || $worker['state'] == 2) {
            $this->doMobileWorkcenter();
        } else {
            if ($worker['state'] == 1) {
                $system = $this->module['config'];
                include $this->template('workerwait');
            } else {
                if (empty($worker['mobile'])) {
                    $url                           = $_W['siteroot'] . 'app/' . $this->createMobileUrl('workinfo');
                    $_SESSION['water_o2o_app_url'] = $url;
                    $system                        = $this->module['config'];
                    include $this->template('worklogin');
                } else {
                    $this->doMobileWorkinfo();
                }
            }
        }
    }
    public function doMobileWorkcenter()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($worker['openid']) || empty($worker['nickname'])) {
            $this->doMobileAuthworker();
        }
        $active = 3;
        $title  = $this->workcentertitle;
        include $this->template('workcenter');
    }
    public function doMobileShopbind()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg,shopid FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        $active = 0;
        $shopid = intval($_GPC['shopid']);
        if ($fans['shopid'] == $shopid) {
            $url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('shoperentry');
            message('您已经绑定该商铺啦！直接进入商铺...', $url, 'error');
        }
        if ($shopid > 0) {
            $shop = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE id= " . $shopid);
            if (!$shop) {
                message('抱歉，不存在或是已经删除！', '', 'error');
            } else {
                pdo_update($this->fanstable, array(
                    'shopid' => 0,
                    'stitle' => '',
                    'balance' => 0
                ), array(
                    'shopid' => $shopid
                ));
                pdo_update($this->fanstable, array(
                    'shopid' => $shopid,
                    'stitle' => $shop['stitle']
                ), array(
                    'id' => $fans['id']
                ));
                pdo_update($this->shoptable, array(
                    'sopenid' => '',
                    'wxadd' => -1
                ), array(
                    'sopenid' => $openid
                ));
                pdo_update($this->shoptable, array(
                    'sopenid' => $openid,
                    'wxadd' => -1
                ), array(
                    'id' => $shopid
                ));
            }
        } else {
            message('shopid is null', '', 'error');
        }
        $this->doMobileShoperentry();
    }
    public function doMobileWorkerbind()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        if (empty($openid)) {
            message('openid is null');
        }
        $active   = 0;
        $workerid = intval($_GPC['workerid']);
        if ($workerid > 0) {
            $title  = $shop['stitle'];
            $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE id= " . $workerid);
            if (!$worker) {
                message('抱歉，员工不存在或是已经删除！', '', 'error');
            } else {
                if (empty($worker['openid'])) {
                    pdo_update($this->workertable, array(
                        'openid' => $openid
                    ), array(
                        'id' => $workerid
                    ));
                }
                $this->doMobileWorkcenter();
            }
        } else {
            message('workerid is null', '', 'error');
        }
    }
    public function doMobileSetworkerlocation()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $lat    = $_GPC['lat'];
        $lng    = $_GPC['lng'];
        $data   = array(
            'lng' => $lng,
            'lat' => $lat
        );
        $data1  = array(
            'wlocation' => serialize($data)
        );
        pdo_update($this->workertable, $data1, array(
            'uniacid' => $_W['uniacid'],
            'openid' => $openid
        ));
        die(json_encode(array(
            'result' => 1,
            'msg' => 'success',
            'wz' => $data
        )));
    }
    public function doMobileWorkitem()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($worker['openid']) || empty($worker['nickname'])) {
            $this->doMobileAuthworker();
        }
        $active    = 3;
        $title     = $this->centertitle;
        $statetype = $_GPC['statetype'];
        $type      = $_SESSION['water_o2o_work_item_type'];
        if (!empty($type)) {
            $statetype                            = $type;
            $_SESSION['water_o2o_work_item_type'] = null;
        }
        if (empty($statetype)) {
            $statetype = "all";
        }
        if ($statetype == "ing") {
            $state = '(1)';
        } elseif ($statetype == "end") {
            $state = '(0)';
        } else {
            $state = '(0,1)';
        }
        $sql    = "SELECT * FROM " . tablename($this->servicetable) . " WHERE uniacid = '{$_W['uniacid']}' and wid = '{$worker['id']}'  and state in {$state} ORDER BY id ";
        $list   = pdo_fetchall($sql);
        $active = 3;
        $title  = $this->workitemtitle;
        include $this->template('workitem');
    }
    public function doMobileShopadditem()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg,shopid,balance FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        if ($fans['shopid'] <= 0) {
            message('不是店主');
        }
        $shop = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE id= " . $fans['shopid']);
        include $this->template('shopadditem');
    }
    public function doMobileDoshopadditem()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg,shopid,balance FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            die(json_encode(array(
                "result" => 0,
                "msg" => 'null'
            )));
        }
        if ($fans['shopid'] <= 0) {
            die(json_encode(array(
                "result" => 0,
                "msg" => 'not shoper'
            )));
        }
        $img  = serialize($_GPC['simgs']);
        $data = array(
            'sname' => $_GPC['sname'],
            'sdesc' => mb_substr($_GPC['sdesc'], 0, 10, 'utf-8'),
            'scontent' => $_GPC['scontent'],
            'syynotice' => $_GPC['syynotice'],
            'sreminder' => $_GPC['sreminder'],
            'sprice' => floatval($_GPC['sprice']),
            'sminute' => intval($_GPC['sminute']),
            'state' => intval($_GPC['defaultstate']),
            'dohome' => intval($_GPC['dohome']),
            'uniacid' => $_W['uniacid'],
            'wid' => 0,
            'sid' => $fans['shopid'],
            'stitle' => $fans['stitle'],
            'slogo' => $_GPC['simgs'][0],
            'simgs' => $img,
            'dohome' => 1
        );
        pdo_insert($this->servicetable, $data);
        $serviceid = pdo_insertid();
        $url       = $_W['siteroot'] . 'app/' . $this->createMobileUrl('shopserviceshow', array(
            'serviceid' => $serviceid
        ));
        die(json_encode(array(
            'result' => 1,
            'msg' => 'success',
            url => $url
        )));
    }
    public function doMobileShopserviceshow()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $fans   = pdo_fetch("SELECT id,openid,nickname,headimg,shopid,balance FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($fans['openid']) || empty($fans['nickname'])) {
            $this->doMobileAuthuser();
        }
        if ($fans['shopid'] <= 0) {
            message('不是店主');
        }
        $system    = $this->module['config'];
        $serviceid = intval($_GPC['serviceid']);
        $service   = pdo_fetch("SELECT * FROM " . tablename($this->servicetable) . " WHERE id= " . $serviceid);
        include $this->template('shopservice');
    }
    public function doMobileWorkadditem()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($worker['openid']) || empty($worker['nickname'])) {
            $this->doMobileAuthworker();
        }
        include $this->template('workadditem');
    }
    public function doMobileDoworkadditem()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($worker['openid']) || empty($worker['nickname'])) {
            $this->doMobileAuthworker();
        }
        $img  = serialize($_GPC['simgs']);
        $data = array(
            'sname' => $_GPC['sname'],
            'sdesc' => mb_substr($_GPC['sdesc'], 0, 10, 'utf-8'),
            'scontent' => $_GPC['scontent'],
            'syynotice' => $_GPC['syynotice'],
            'sreminder' => $_GPC['sreminder'],
            'sprice' => floatval($_GPC['sprice']),
            'sminute' => intval($_GPC['sminute']),
            'state' => intval($_GPC['defaultstate']),
            'uniacid' => $_W['uniacid'],
            'wid' => $worker['id'],
            'sid' => $worker['sid'],
            'wname' => $worker['wname'],
            'wopenid' => $openid,
            'slogo' => $_GPC['simgs'][0],
            'simgs' => $img,
            'dohome' => 1
        );
        pdo_insert($this->servicetable, $data);
        $serviceid = pdo_insertid();
        $svsql     = "SELECT * FROM " . tablename($this->servicetable) . " WHERE uniacid = '{$_W['uniacid']}' and sid = 0 and state = 2 and wid = '{$worker['id']}' ORDER BY id DESC ";
        $list      = pdo_fetchall($svsql);
        $wsinfos   = array();
        $data      = array();
        foreach ($list as $index => $row) {
            $wsinfos[$index] = array(
                "sid" => $row['sid'],
                "sname" => $row['sname'],
                "feevalue" => $row['sprice'],
                "sminute" => $row['sminute']
            );
        }
        $data['wsinfos'] = serialize($wsinfos);
        pdo_update($this->workertable, $data, array(
            'id' => $workerid
        ));
        $url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('workserviceshow', array(
            'serviceid' => $serviceid
        ));
        die(json_encode(array(
            'result' => 1,
            'msg' => 'success',
            url => $url
        )));
    }
    public function doMobileWorkserviceshow()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($worker['openid']) || empty($worker['nickname'])) {
            $this->doMobileAuthworker();
        }
        $system    = $this->module['config'];
        $serviceid = intval($_GPC['serviceid']);
        $service   = pdo_fetch("SELECT * FROM " . tablename($this->servicetable) . " WHERE id= " . $serviceid);
        include $this->template('workservice');
    }
    public function doMobileWorkdeleteitem()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($worker['openid']) || empty($worker['nickname'])) {
            $this->doMobileAuthworker();
        }
        $serviceid                            = intval($_GPC['serviceid']);
        $statetype                            = $_GPC['statetype'];
        $_SESSION['water_o2o_work_item_type'] = $statetype;
        pdo_delete($this->servicetable, array(
            'id' => $serviceid
        ));
        $this->doMobileWorkitem();
    }
    public function doMobileWorkorder()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($worker['openid']) || empty($worker['nickname'])) {
            $this->doMobileAuthworker();
        }
        $active    = 2;
        $title     = $this->workordertitle;
        $statetype = $_GPC['statetype'];
        if (empty($statetype)) {
            $statetype = "tosv";
        }
        if ($statetype == "ing") {
            $state = '(2)';
        } elseif ($statetype == "end") {
            $state = '(3)';
        } else {
            $state = '(1)';
        }
        $sql  = "SELECT o.*,sv.sdesc,sv.simgs,sv.sprice,sv.sminute FROM " . tablename($this->ordertable) . " as o
					left join " . tablename($this->servicetable) . " as sv on sv.id = o.svid
							WHERE o.wid = '{$worker['id']}' and o.uniacid = '{$_W['uniacid']}' and o.state in {$state} ORDER BY o.id desc";
        $list = pdo_fetchall($sql);
        include $this->template('workorder');
    }
    public function doMobileOrderdeal()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($worker['openid']) || empty($worker['nickname'])) {
            $this->doMobileAuthworker();
        }
        $orderid    = intval($_GPC['orderid']);
        $orderstate = intval($_GPC['orderstate']) + 1;
        $statetype  = $_GPC['statetype'];
        pdo_update($this->ordertable, array(
            'state' => $orderstate
        ), array(
            'id' => $orderid
        ));
        $this->doMobileWorkorder();
    }
    public function doMobileOrderdealForShop()
    {
        global $_GPC, $_W;
        $openid     = $_W['fans']['from_user'];
        $orderid    = intval($_GPC['orderid']);
        $orderstate = intval($_GPC['orderstate']) + 1;
        $statetype  = $_GPC['statetype'];
        pdo_update($this->ordertable, array(
            'state' => $orderstate
        ), array(
            'id' => $orderid
        ));
        $this->doMobileShoporder();
    }
    public function doMobileWorkqb()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($worker['openid']) || empty($worker['nickname'])) {
            $this->doMobileAuthworker();
        }
        $active = 3;
        $title  = $this->workqbtitle;
        include $this->template('workerqb');
    }
    public function doMobileWorkmanage()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($worker['openid']) || empty($worker['nickname'])) {
            $this->doMobileAuthworker();
        }
        $active = 3;
        $title  = $this->shopmanagetitle;
        include $this->template('workmanage');
    }
    public function doMobileWorkerupdatelogo()
    {
        global $_W, $_GPC;
        $openid = $_W['fans']['from_user'];
        if (empty($openid)) {
            die(json_encode(array(
                "result" => 0,
                "msg" => "系统错误"
            )));
        }
        $workerid = $_GPC['workerid'];
        $media_id = $_GPC['media_ids'];
        $file     = $this->downloadFromWxServer($media_id);
        pdo_update($this->workertable, array(
            'wimg' => $file[0]['spath']
        ), array(
            'id' => $workerid
        ));
        die(json_encode(array(
            'result' => 1,
            'msg' => 'success',
            'url' => $_W['attachurl'] . $file[0]['path']
        )));
    }
    public function doMobileWorkeruploadpics()
    {
        global $_W, $_GPC;
        $openid = $_W['fans']['from_user'];
        if (empty($openid)) {
            die(json_encode(array(
                "result" => 0,
                "msg" => "系统错误"
            )));
        }
        $media_id = $_GPC['media_ids'];
        $id       = rand(1000000000, 9999999999);
        $file     = $this->downloadFromWxServer($media_id);
        die(json_encode(array(
            'result' => 1,
            'msg' => 'success',
            'imgid' => $id,
            "url" => $_W['attachurl'] . $file[0]['path'],
            "nameval" => $file[0]['path']
        )));
    }
    public function doMobileWorkinfo()
    {
        global $_GPC, $_W;
        $openid = $_W['fans']['from_user'];
        $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        if (empty($worker['openid']) || empty($worker['nickname'])) {
            $this->doMobileAuthworker();
        }
        $active = 3;
        $title  = $this->workinfotitle;
        $system = $this->module['config'];
        include $this->template('workerinfo');
    }
    public function doMobileDoworkerinfo()
    {
        global $_GPC, $_W;
        $workerid = intval($_GPC['workerid']);
        $data     = array(
            'wname' => $_GPC['wname'],
            'wage' => intval($_GPC['wage']),
            'wyears' => intval($_GPC['wyears']),
            'wxxrange' => intval($_GPC['wxxrange']),
            'wcity' => $_GPC['wcity'],
            'wdesc' => $_GPC['wdesc']
        );
        if (!empty($workerid)) {
            $worker = pdo_fetch("SELECT state FROM " . tablename($this->workertable) . " WHERE id ='{$workerid}'");
            if ($worker['state'] == 0) {
                $data['state'] = 1;
                pdo_update($this->workertable, $data, array(
                    'id' => $workerid
                ));
                $system = $this->module['config'];
                include $this->template('workerwait');
            } else {
                pdo_update($this->workertable, $data, array(
                    'id' => $workerid
                ));
                $this->doMobileWorkmanage();
            }
        } else {
            message('svid is null');
        }
    }
    public function doMobileCenterst()
    {
        global $_GPC, $_W;
        $active = 4;
        $title  = $this->centerSTtitle;
        include $this->template('centerst');
    }
    public function doMobileCenterqb()
    {
        global $_GPC, $_W;
        $active = 4;
        $title  = $this->centerQBtitle;
        $openid = $_W['fans']['from_user'];
        include $this->template('centerqb');
    }
    public function doMobileAbout()
    {
        global $_GPC, $_W;
        $active = 4;
        $title  = $this->addressttitle;
        include $this->template('about');
    }
    public function doMobileExit()
    {
        global $_GPC, $_W;
        $active = 4;
        $title  = $this->addressttitle;
        include $this->template('exit');
    }
    public function doMobileAddress()
    {
        global $_GPC, $_W;
        $active = 4;
        $title  = $this->addressttitle;
        $openid = $_W['fans']['from_user'];
        if (empty($openid)) {
            $this->doMobileAuthuser();
        }
        $shopid    = intval($_GPC['shopid']);
        $serviceid = intval($_GPC['serviceid']);
        $type      = intval($_GPC['type']);
        $fans      = pdo_fetch("SELECT id,fname,mobile,address FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and openid ='{$openid}'");
        $system    = $this->module['config'];
        if (empty($fans['mobile'])) {
            $url                           = $_W['siteroot'] . 'app/' . $this->createMobileUrl('attend', array(
                "shopid" => $shopid,
                "serviceid" => $serviceid,
                "type" => $type
            ));
            $_SESSION['water_o2o_app_url'] = $url;
            include $this->template('login');
        } else {
            include $this->template('address');
        }
    }
    public function doMobileSaveaddress()
    {
        global $_GPC, $_W;
        $data   = array(
            'fname' => $_GPC['fname'],
            'mobile' => $_GPC['mobile'],
            'address' => $_GPC['address']
        );
        $fansid = intval($_GPC['fansid']);
        if ($fansid < 0) {
            die(json_encode(array(
                "state" => "0",
                "msg" => 'error:fansid is null'
            )));
        }
        $result    = pdo_update($this->fanstable, $data, array(
            'id' => $fansid
        ));
        $shopid    = intval($_GPC['shopid']);
        $serviceid = intval($_GPC['serviceid']);
        $type      = intval($_GPC['type']);
        $url       = "http://www.baidu.com";
        if ($shopid > 0 && $serviceid > 0) {
            $url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('attend', array(
                'shopid' => $shopid,
                'serviceid' => $serviceid,
                'type' => $type
            ));
        } else {
            $url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('center');
        }
        die(json_encode(array(
            'state' => "1",
            'msg' => 'success',
            'url' => $url
        )));
    }
    public function doMobileAddresses()
    {
        global $_GPC, $_W;
        $active = 4;
        $title  = $this->addressttitle;
        include $this->template('addresses');
    }
    public function payResult($params)
    {
        global $_W;
        if ($params['result'] == 'success') {
            $fee      = floatval($params['fee']);
            $tid      = intval($params['tid']);
            $openid   = $params['user'];
            $ordersn  = $params['ordersn'];
            $tmparray = explode("#", $tid);
            $hassend  = false;
            $order    = "";
            if (is_array($tmparray)) {
                $orderid = $tmparray[0];
                $order   = pdo_fetch("SELECT * FROM " . tablename($this->ordertable) . " WHERE id= " . $orderid);
                if ($order['paystate'] == 0) {
                    $data = array(
                        'paytime' => date("Y-m-d H:i", time()),
                        'paystate' => 1,
                        'paytype' => 1
                    );
                    if ($order['state'] == 0) {
                        $data['state'] = 1;
                    }
                    pdo_update($this->ordertable, $data, array(
                        'id' => $orderid
                    ));
                    $hassend = true;
                }
            }
            if ($hassend) {
                $this->sendUserOrder($order);
                $workerid = intval($order['wid']);
                if ($workerid > 0) {
                    $this->sendWorkerOrder($order);
                }
            }
            if ($params['from'] == 'return') {
                message('支付成功！', '../../' . $this->createMobileUrl('order'), 'success');
            }
        } else {
            message('支付失败：' . $params['result']);
        }
    }
    public function sendUserOrder($order)
    {
        global $_W;
        $system        = $this->module['config'];
        $url1          = $_W['siteroot'] . 'app/' . $this->createMobileUrl('order');
        $data1         = array(
            'touser' => $order['openid'],
            'template_id' => $system['user_yyzf'],
            'url' => $url1,
            'topcolor' => '#FF0000'
        );
        $data1['data'] = array(
            'first' => array(
                'value' => '您好，预约订单支付成功',
                'color' => '#173177'
            ),
            'keyword1' => array(
                'value' => $order['orderno'],
                'color' => '#173177'
            ),
            'keyword2' => array(
                'value' => date('m/d H:i', TIMESTAMP),
                'color' => '#173177'
            ),
            'keyword3' => array(
                'value' => $order['orderfee'] . '元',
                'color' => '#173177'
            ),
            'remark' => array(
                'value' => '谢谢您的惠顾，如有问题，欢迎拨打客服电话：' . $system['kfdh'],
                'color' => '#173177'
            )
        );
        $token         = $this->getToken();
        $this->sendMBXX($token, $data1);
    }
    public function sendWorkerOrder($order)
    {
        global $_W;
        $system = $this->module['config'];
        $worker = pdo_fetch("SELECT openid FROM " . tablename($this->workertable) . " WHERE id = '{$order['wid']}'");
        $url2   = $_W['siteroot'] . 'app/' . $this->createMobileUrl('workorder');
        $data2  = array(
            'touser' => $worker['openid'],
            'template_id' => $system['worker_ddtx'],
            'url' => $url2,
            'topcolor' => '#FF0000'
        );
        $remark = "";
        if ($order['type'] == 0) {
            $remark = "预约到店服务";
        } else {
            $remark = "预约上门服务";
        }
        $remark .= ",客户留言：" . $order['smsg'];
        $data2['data'] = array(
            'first' => array(
                'value' => '您好，有新订单需要处理哦',
                'color' => '#173177'
            ),
            'keyword1' => array(
                'value' => $order['orderno'],
                'color' => '#173177'
            ),
            'keyword2' => array(
                'value' => $order['svname'],
                'color' => '#173177'
            ),
            'keyword3' => array(
                'value' => $order['orderfee'] . '元',
                'color' => '#173177'
            ),
            'keyword4' => array(
                'value' => date('m/d H:i', TIMESTAMP),
                'color' => '#173177'
            ),
            'keyword5' => array(
                'value' => '服务时间:' . $order['stime'],
                'color' => '#173177'
            ),
            'remark' => array(
                'value' => $remark,
                'color' => '#173177'
            )
        );
        $token         = $this->getToken();
        $this->sendMBXX($token, $data2);
    }
    public function doMobileUpload()
    {
        global $_GPC, $_W;
        $photo = $_GPC['photo'];
        $size  = $_GPC['size'];
        $path  = '../attachment/images/water/';
        if (!file_exists($path)) {
            mkdir($path);
        }
        $time     = time();
        $file     = $path . $time . '.jpeg';
        $filepath = 'images/water/' . $time . '.jpeg';
        $photo    = preg_replace("/data:image\/(.*);base64,/", "", $photo);
        $base64   = base64_decode($photo);
        file_put_contents($file, $base64);
        die(json_encode(array(
            'status' => 0,
            'msg' => $filepath
        )));
    }
    public function doMobileSavezc()
    {
        global $_GPC, $_W;
        $shopid = $_GPC['shopid'];
        if (empty($shopid)) {
            die(json_encode(array(
                "status" => 0,
                "msg" => 'error:shopid is null'
            )));
        }
        $tel = $_GPC['mobile'];
        if (empty($tel)) {
            die(json_encode(array(
                "status" => 0,
                "msg" => 'error:tel is null'
            )));
        }
        $zcdata = array(
            'openid' => $_W['fans']['from_user'],
            'shopid' => $shopid,
            'headlogo' => $_GPC['imgurl'],
            'name1' => $_GPC['name1'],
            'name2' => $_GPC['name2'],
            'zcgy' => $_GPC['zcgy'],
            'zcsum' => floatval($_GPC['price']),
            'tel' => $tel,
            'zctime' => date("Y-m-d H:i", time()),
            'scannum' => 1,
            'state' => '1',
            'uniacid' => $_W['uniacid']
        );
        pdo_insert($this->membertable, $zcdata);
        $memberid = pdo_insertid();
        if (empty($memberid)) {
            die(json_encode(array(
                "status" => 0,
                "msg" => 'error:memberid is null'
            )));
        }
        $shop = pdo_fetch("SELECT smsname,smspwd,smsmb FROM " . tablename($this->shoptable) . " WHERE id= " . $shopid);
        if (!empty($shop['smsname']) && !empty($shop['smspwd'])) {
            $tmparray = explode("#", $shop['smsmb']);
            $content  = '';
            if (is_array($tmparray)) {
                $rand    = random(10, true);
                $content = $tmparray[0] . $rand . $tmparray[1];
            } else {
                die(json_encode(array(
                    'status' => 0,
                    'msg' => 'error:smsmb is error'
                )));
            }
            $result = $this->sendMobileMSG($shop['smsname'], $shop['smspwd'], $tel, $content);
            $arr    = explode("&", $result);
            if (is_array($arr)) {
                $tmp1     = $arr[1];
                $statearr = explode("=", $tmp1);
                if (is_array($statearr)) {
                    $state = $statearr[1];
                    if ($state != '100') {
                        die(json_encode(array(
                            "status" => 0,
                            "msg" => 'sms:error code is' . $state
                        )));
                    }
                } else {
                    die(json_encode(array(
                        'status' => 0,
                        'msg' => 'sms:error'
                    )));
                }
            } else {
                die(json_encode(array(
                    'status' => 0,
                    'msg' => 'sms:error'
                )));
            }
        }
        $url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('Index', array(
            'shopid' => $shopid,
            'memberid' => $memberid
        ));
        include 'phpqrcode.php';
        $errorCorrectionLevel = 'L';
        $matrixPointSize      = 3;
        $path                 = '../attachment/images/waterqr/';
        if (!file_exists($path)) {
            mkdir($path);
        }
        $time     = time();
        $QR       = $path . $time . '.png';
        $QR2      = $path . $time . '2.png';
        $filepath = 'images/waterqr/' . $time . '2.png';
        QRcode::png($url, $QR, $errorCorrectionLevel, $matrixPointSize, 2);
        $logo = '../addons/water_o2o/logo.png';
        if ($logo !== FALSE) {
            $QR             = imagecreatefromstring(file_get_contents($QR));
            $logo           = imagecreatefromstring(file_get_contents($logo));
            $QR_width       = imagesx($QR);
            $QR_height      = imagesy($QR);
            $logo_width     = imagesx($logo);
            $logo_height    = imagesy($logo);
            $logo_qr_width  = $QR_width / 5;
            $scale          = $logo_width / $logo_qr_width;
            $logo_qr_height = $logo_height / $scale;
            $from_width     = ($QR_width - $logo_qr_width) / 2;
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        }
        imagepng($QR, $QR2);
        die(json_encode(array(
            'status' => 1,
            'msg' => $memberid,
            "code" => $_W['attachurl'] . $filepath,
            "url" => $url
        )));
    }
    public function dowebShop()
    {
        global $_W, $_GPC;
        $pageNumber = max(1, intval($_GPC['page']));
        $pageSize   = 20;
        $sql        = "SELECT * FROM " . tablename($this->shoptable) . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY id LIMIT " . ($pageNumber - 1) * $pageSize . ',' . $pageSize;
        $list       = pdo_fetchall($sql);
        $total      = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->shoptable) . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY id DESC");
        $pager      = pagination($total, $pageNumber, $pageSize);
        include $this->template('shop');
    }
    public function dowebAddshop()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        $shopid = intval($_GPC['shopid']);
        if ($shopid) {
            $shop = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE id= " . $shopid);
            if (!$shop) {
                message('抱歉，信息不存在或是已经删除！', '', 'error');
            }
            if (empty($shop['sewm'])) {
                $sewm = $this->createBindEWM($shopid, 0);
                pdo_update($this->shoptable, array(
                    'sewm' => $sewm
                ), array(
                    'id' => $shopid
                ));
            } else {
                $sewm = $shop['sewm'];
            }
            $fans      = pdo_fetch("SELECT id,openid,nickname,headimg FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and shopid ='{$shopid}'");
            $simgs     = unserialize($shop['simgs']);
            $sbanners  = unserialize($shop['sbanners']);
            $slocation = unserialize($shop['slocation']);
        }
        if ($_GPC['op'] == 'delete') {
            $shopid = intval($_GPC['shopid']);
            $shop   = pdo_fetch("SELECT id FROM " . tablename($this->shoptable) . " WHERE id = " . $shopid);
            if (empty($shop)) {
                message('抱歉，信息不存在或是已经被删除！');
            }
            pdo_delete($this->workertable, array(
                'sid' => $shopid
            ));
            pdo_delete($this->ordertable, array(
                'sid' => $shopid
            ));
            pdo_delete($this->shoptable, array(
                'id' => $shopid
            ));
            message('删除成功！', referer(), 'success');
        }
        if ($_GPC['op'] == 'audit') {
            $shopid = intval($_GPC['shopid']);
            $shop   = pdo_fetch("SELECT id FROM " . tablename($this->shoptable) . " WHERE id = " . $shopid);
            if (empty($shop)) {
                message('抱歉，信息不存在或是已经被删除！');
            }
            pdo_update($this->shoptable, array(
                'wxadd' => -1
            ), array(
                'id' => $shopid
            ));
            message('审核成功！', referer(), 'success');
        }
        if (checksubmit()) {
            $img        = serialize($_GPC['simgs']);
            $sbanners   = serialize($_GPC['sbanners']);
            $slocation  = serialize($_GPC['slocation']);
            $gaodezb    = $this->changeBDToGCJ($_GPC['slocation']['lat'], $_GPC['slocation']['lng']);
            $slocation2 = serialize($gaodezb);
            $totalw     = $this->getWorkersBySid($shopid);
            $totals     = $this->getOrdersEndSumBySid($shopid);
            $data       = array(
                'stitle' => $_GPC['stitle'],
                'smobile' => $_GPC['smobile'],
                'saddress' => $_GPC['saddress'],
                'slogo' => $_GPC['slogo'],
                'simgs' => $img,
                'sbanners' => $sbanners,
                'slocation' => $slocation,
                'slocation2' => $slocation2,
                'sdesc' => $_GPC['sdesc'],
                'suname' => $_GPC['suname'],
                'spwd' => $_GPC['spwd'],
                'state' => intval($_GPC['state']),
                'dohome' => intval($_GPC['dohome']),
                'totalw' => $totalw,
                'totals' => $totals
            );
            if (!empty($shopid)) {
                pdo_update($this->shoptable, $data, array(
                    'id' => $shopid
                ));
            } else {
                $data['uniacid'] = $_W['uniacid'];
                pdo_insert($this->shoptable, $data);
                $shopid = pdo_insertid();
            }
            $shop      = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE id= " . $shopid);
            $simgs     = unserialize($shop['simgs']);
            $sbanners  = unserialize($shop['sbanners']);
            $slocation = unserialize($shop['slocation']);
            message('添加成功！记得扫二维码绑定店主哦', referer(), 'success');
        }
        include $this->template('addshop');
    }
    public function dowebShopmanage()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        $shopid = intval($_GPC['shopid']);
        $shop   = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE id= " . $shopid);
        if (!$shop) {
            message('抱歉，信息不存在或是已经删除！', '', 'error');
        }
        $op = $_GPC['op'];
        if ($op == 'worker') {
            $sql  = "SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and sid = '{$shopid}' ORDER BY id ";
            $list = pdo_fetchall($sql);
            include $this->template('shopworker');
        } elseif ($op == 'service') {
            $sql  = "SELECT * FROM " . tablename($this->servicetable) . " WHERE uniacid = '{$_W['uniacid']}' and sid = '{$shopid}' and svhmid = 0  ORDER BY id ";
            $list = pdo_fetchall($sql);
            include $this->template('shopservice');
        } elseif ($op == 'servicehome') {
            $sql  = "SELECT * FROM " . tablename($this->servicehometable) . " WHERE uniacid = '{$_W['uniacid']}' and state = 2  ORDER BY id ";
            $list = pdo_fetchall($sql);
            include $this->template('shopservicehome');
        } elseif ($op == 'order') {
            $sql  = "SELECT * FROM " . tablename($this->ordertable) . " WHERE uniacid = '{$_W['uniacid']}' and sid = '{$shopid}'  ORDER BY id desc";
            $list = pdo_fetchall($sql);
            include $this->template('shoporder');
        } else {
            include $this->template('shopmanage');
        }
    }
    public function doWebShopsvhmforprice()
    {
        global $_W, $_GPC;
        $shid   = intval($_GPC['shid']);
        $shopid = intval($_GPC['shopid']);
        if ($shid <= 0 || $shopid <= 0) {
            die(json_encode(array(
                "result" => 0,
                "msg" => 'id不正确'
            )));
        }
        $sprice  = floatval($_GPC['sprice']);
        $sminute = intval($_GPC['sminute']);
        $state   = 1;
        if ($sprice <= 0 || $sminute <= 0) {
            $state = 0;
        }
        $shop        = pdo_fetch("SELECT id,stitle FROM " . tablename($this->shoptable) . " WHERE id= " . $shopid);
        $servicehome = pdo_fetch("SELECT * FROM " . tablename($this->servicehometable) . " WHERE id= " . $shid);
        $service     = pdo_fetch("SELECT * FROM " . tablename($this->servicetable) . " WHERE uniacid = '{$_W['uniacid']}' and sid = '{$shopid}' and svhmid = " . $shid);
        if (empty($service)) {
            $data = array(
                'uniacid' => $_W['uniacid'],
                'svhmid' => $shid,
                'sname' => $servicehome['shname'],
                'sdesc' => mb_substr($servicehome['shdesc'], 0, 10, 'utf-8'),
                'scontent' => $servicehome['shcontent'],
                'syynotice' => $servicehome['shyynotice'],
                'sreminder' => $servicehome['shreminder'],
                'sprice' => $sprice,
                'sminute' => $sminute,
                'state' => $state,
                'wid' => 0,
                'sid' => $shopid,
                'stitle' => $shop['stitle'],
                'slogo' => $servicehome['shlogo'],
                'simgs' => $servicehome['shimgs'],
                'dohome' => 1
            );
            pdo_insert($this->servicetable, $data);
            $serviceid = pdo_insertid();
            die(json_encode(array(
                'result' => 1,
                'msg' => '新增上门服务信息成功'
            )));
        } else {
            $data = array(
                'sprice' => $sprice,
                'sminute' => $sminute,
                'state' => $state
            );
            pdo_update($this->servicetable, $data, array(
                'id' => $service['id']
            ));
            die(json_encode(array(
                'result' => 1,
                'msg' => '修改上门服务信息成功'
            )));
        }
    }
    public function dowebWorker()
    {
        global $_W, $_GPC;
        $ssql      = "SELECT id,stitle FROM " . tablename($this->shoptable) . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY id";
        $slist     = pdo_fetchall($ssql);
        $condition = " and 1=1 ";
        $shopid    = intval($_GPC['shopid']);
        if ($shopid == -2) {
            $condition .= " and sid = '0'";
            $_SESSION['shopid'] = -2;
        } elseif ($shopid == -1) {
            $_SESSION['shopid'] = -1;
        } elseif ($shopid == 0) {
            $sessionshopid = intval($_SESSION['shopid']);
            if ($sessionshopid == -2) {
                $condition .= " and sid = '0'";
                $_SESSION['shopid'] = -2;
            } elseif ($sessionshopid > 0) {
                $shopid = $sessionshopid;
                $condition .= " and sid = '{$shopid}'";
                $_SESSION['shopid'] = $shopid;
            }
        } else {
            $condition .= " and sid = '{$shopid}'";
            $_SESSION['shopid'] = $shopid;
        }
        $wname = $_GPC['wname'];
        if (!empty($wname)) {
            $condition .= " AND wname like '%{$wname}%'";
        }
        $mobile = $_GPC['mobile'];
        if (!empty($mobile)) {
            $condition .= " AND mobile = '{$mobile}'";
        }
        $workerstate = intval($_GPC['workerstate']);
        if ($workerstate == -2) {
            $_SESSION['water_o2o_web_workerstate'] = -2;
        } elseif ($workerstate == -1) {
            $_SESSION['water_o2o_web_workerstate'] = -1;
        } elseif ($workerstate == 0) {
            $workerstate = intval($_SESSION['water_o2o_web_workerstate']);
            if ($sessionworkerstate > 0) {
                $condition .= " AND state = '{$workerstate}'";
                $_SESSION['water_o2o_web_workerstate'] = $workerstate;
            }
        } else {
            $condition .= " AND state = '{$workerstate}'";
            $_SESSION['water_o2o_web_workerstate'] = $workerstate;
        }
        $pageNumber = max(1, intval($_GPC['page']));
        $pageSize   = 50;
        $sql        = "SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' {$condition} ORDER BY id LIMIT " . ($pageNumber - 1) * $pageSize . ',' . $pageSize;
        $list       = pdo_fetchall($sql);
        $total      = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' {$condition} ORDER BY id DESC");
        $pager      = pagination($total, $pageNumber, $pageSize);
        include $this->template('worker');
    }
    public function dowebAddworker()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        $op       = $_GPC['op'];
        $workerid = intval($_GPC['workerid']);
        if ($workerid > 0) {
            $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE id= " . $workerid);
            if (!$worker) {
                message('抱歉，信息不存在或是已经删除！', '', 'error');
            }
            if (empty($worker['wewm'])) {
                $wewm = $this->createBindEWM(0, $workerid);
                pdo_update($this->workertable, array(
                    'wewm' => $wewm
                ), array(
                    'id' => $workerid
                ));
            } else {
                $wewm = $worker['wewm'];
            }
        }
        $shopid = intval($_GPC['shopid']);
        if ($shopid > 0) {
            $shop = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE id= " . $shopid);
            if (empty($shop)) {
                message('shop is null');
            }
        }
        if ($_GPC['op'] == 'delete') {
            $workerid = intval($_GPC['workerid']);
            $worker   = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE id = " . $workerid);
            if (empty($worker)) {
                message('抱歉，信息不存在或是已经被删除！');
            }
            pdo_delete($this->workertable, array(
                'id' => $workerid
            ));
            message('删除成功！', referer(), 'success');
        }
        if ($_GPC['op'] == 'audit') {
            $workerid = intval($_GPC['workerid']);
            $worker   = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE id = " . $workerid);
            if (empty($worker)) {
                message('抱歉，信息不存在或是已经被删除！');
            }
            pdo_update($this->workertable, array(
                'state' => 2
            ), array(
                'id' => $workerid
            ));
            message('审核成功！', referer(), 'success');
        }
        if (checksubmit()) {
            $data = array(
                'wimg' => $_GPC['wimg'],
                'type' => intval($_GPC['type']),
                'wname' => $_GPC['wname'],
                'wage' => intval($_GPC['wage']),
                'wyears' => intval($_GPC['wyears']),
                'wcity' => $_GPC['wcity'],
                'wdesc' => $_GPC['wdesc'],
                'mobile' => $_GPC['mobile'],
                'pwd' => $_GPC['pwd'],
                'balance' => floatval($_GPC['balance']),
                'state' => intval($_GPC['state'])
            );
            if (!empty($workerid)) {
                pdo_update($this->workertable, $data, array(
                    'id' => $workerid
                ));
            } else {
                $data['uniacid'] = $_W['uniacid'];
                $data['sid']     = $shopid;
                $data['stitle']  = $shop['stitle'];
                pdo_insert($this->workertable, $data);
                $workerid = pdo_insertid();
            }
            $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE id= " . $workerid);
            message('添加成功！注意:页面跳转后使用员工手机微信扫描二维码进行关联绑定', '../../' . $this->createWebUrl('addworker', array(
                'workerid' => $workerid
            )), 'success');
        }
        include $this->template('addworker');
    }
    public function dowebWorkerservice()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        $workerid = intval($_GPC['workerid']);
        if ($workerid > 0) {
            $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE id= " . $workerid);
            if (!$worker) {
                message('抱歉，信息不存在或是已经删除！', '', 'error');
            }
            $wsinfos = unserialize($worker['wsinfos']);
        } else {
            message('wid is null', '', 'error');
        }
        $svsql  = "SELECT id,sname,sprice,sminute FROM " . tablename($this->servicetable) . " WHERE uniacid = '{$_W['uniacid']}' and sid = '{$worker['sid']}' ORDER BY id DESC ";
        $svlist = pdo_fetchall($svsql);
        if (empty($svlist)) {
            message('请先添加店铺的服务项目');
        }
        if (!empty($wsinfos)) {
            $newwsinfos = array();
            foreach ($svlist as $index => $row) {
                $thevalue  = $row['sprice'];
                $theminute = $row['sminute'];
                foreach ($wsinfos as $indexold => $item) {
                    if ($row['id'] == $item['sid']) {
                        $thevalue  = $item['feevalue'];
                        $theminute = $item['sminute'];
                    }
                }
                $newwsinfos[$index] = array(
                    "sid" => $row['id'],
                    "sname" => $row['sname'],
                    "feevalue" => $thevalue,
                    "sminute" => $theminute
                );
            }
            $wsinfos = array();
            $wsinfos = $newwsinfos;
        }
        if (checksubmit()) {
            $data      = array();
            $snames    = $_GPC['sname'];
            $sids      = $_GPC['sid'];
            $fees      = $_GPC['fee'];
            $sminutes  = $_GPC['sminute'];
            $wsinfos   = array();
            $tempinfos = array();
            if (is_array($snames) && is_array($fees) && is_array($sids)) {
                $index1 = 0;
                $index2 = 0;
                foreach ($snames as $index => $row) {
                    if ($fees[$index] > 0) {
                        $wsinfos[$index1] = array(
                            "sid" => $sids[$index],
                            "sname" => $row,
                            "feevalue" => $fees[$index],
                            "sminute" => $sminutes[$index]
                        );
                        $index1++;
                    } else {
                        $tempinfos[$index2] = array(
                            "sid" => $sids[$index],
                            "sname" => $row,
                            "feevalue" => $fees[$index],
                            "sminute" => $sminutes[$index]
                        );
                        $index2++;
                    }
                }
                foreach ($tempinfos as $index => $row) {
                    $wsinfos[$index1] = array(
                        "sid" => $row['sid'],
                        "sname" => $row['sname'],
                        "feevalue" => $row['feevalue'],
                        "sminute" => $row['sminute']
                    );
                    $index1++;
                }
                $data['wsinfos'] = serialize($wsinfos);
            } else {
                message('项条目不是数组格式');
            }
            pdo_update($this->workertable, $data, array(
                'id' => $workerid
            ));
            $worker  = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE id = '{$workerid}'");
            $wsinfos = unserialize($worker['wsinfos']);
            message('更新成功！', referer(), 'success');
        }
        include $this->template('workerservice');
    }
    public function dowebWorkerserviceforsolo()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        $workerid = intval($_GPC['workerid']);
        if ($workerid > 0) {
            $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE id= " . $workerid);
            if (!$worker) {
                message('抱歉，信息不存在或是已经删除！', '', 'error');
            }
            $wsinfos = unserialize($worker['wsinfos']);
        } else {
            message('wid is null', '', 'error');
        }
        $svsql   = "SELECT * FROM " . tablename($this->servicetable) . " WHERE uniacid = '{$_W['uniacid']}' and sid = 0 and wid = '{$workerid}' ORDER BY id DESC ";
        $list    = pdo_fetchall($svsql);
        $wsinfos = array();
        $index1  = 0;
        $data    = array();
        foreach ($list as $index => $row) {
            if ($row['state'] == 1) {
                $wsinfos[$index1] = array(
                    "sid" => $row['sid'],
                    "sname" => $row['sname'],
                    "feevalue" => $row['sprice'],
                    "sminute" => $row['sminute']
                );
                $index1++;
            }
        }
        $data['wsinfos'] = serialize($wsinfos);
        pdo_update($this->workertable, $data, array(
            'id' => $workerid
        ));
        include $this->template('serviceforsolo');
    }
    public function dowebOrder()
    {
        global $_W, $_GPC;
        $ssql      = "SELECT id,stitle FROM " . tablename($this->shoptable) . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY id";
        $slist     = pdo_fetchall($ssql);
        $condition = " and 1=1 ";
        $shopid    = intval($_GPC['shopid']);
        if ($shopid == -2) {
            $condition .= " and sid = '0'";
            $_SESSION['ordershopid'] = -2;
        } elseif ($shopid == -1) {
            $_SESSION['ordershopid'] = -1;
        } elseif ($shopid == 0) {
            $sessionshopid = intval($_SESSION['ordershopid']);
            if ($sessionshopid == -2) {
                $condition .= " and sid = '0'";
                $_SESSION['ordershopid'] = -2;
            } elseif ($sessionshopid > 0) {
                $shopid = $sessionshopid;
                $condition .= " and sid = '{$shopid}'";
                $_SESSION['ordershopid'] = $shopid;
            }
        } else {
            $condition .= " and sid = '{$shopid}'";
            $_SESSION['shopid'] = $shopid;
        }
        $type = intval($_GPC['type']);
        if ($type > 0) {
            $rtype = $type - 1;
            $condition .= " and type = '{$rtype}'";
            $_SESSION['water_o2o_type'] = $rtype;
        } else {
            if ($type == -1) {
                $_SESSION['water_o2o_type'] = $type;
            } else {
                $nowtype = $_SESSION['water_o2o_type'];
                if ($nowtype >= 0) {
                    $type = $nowtype;
                    $condition .= " and type = '{$type}'";
                }
            }
        }
        $paystate = intval($_GPC['paystate']);
        if ($paystate > 0) {
            $rstate = $paystate - 1;
            $condition .= " and paystate = '{$rstate}'";
            $_SESSION['water_o2o_paystate'] = $rstate;
        } else {
            if ($paystate == -1) {
                $_SESSION['water_o2o_paystate'] = $paystate;
            } else {
                $nowpaystate = $_SESSION['water_o2o_paystate'];
                if ($nowpaystate >= 0) {
                    $paystate = $nowpaystate;
                    $condition .= " and paystate = '{$paystate}'";
                }
            }
        }
        $orderstate = intval($_GPC['orderstate']);
        if ($orderstate > 0) {
            $condition .= " and state = '{$orderstate}'";
            $_SESSION['water_o2o_state'] = $orderstate;
        } else {
            if ($orderstate == -1) {
                $_SESSION['water_o2o_state'] = $orderstate;
            } else {
                $noworderstate = $_SESSION['water_o2o_state'];
                if ($noworderstate >= 0) {
                    $orderstate = $noworderstate;
                    $condition .= " and state = '{$noworderstate}'";
                }
            }
        }
        $wname = $_GPC['wname'];
        if (!empty($wname)) {
            $condition .= " AND wname like '%{$wname}%'";
        }
        $orderno = $_GPC['orderno'];
        if (!empty($orderno)) {
            $condition .= " AND orderno = '{$orderno}'";
        }
        $pageNumber = max(1, intval($_GPC['page']));
        $pageSize   = 50;
        $sql        = "SELECT * FROM " . tablename($this->ordertable) . " WHERE uniacid = '{$_W['uniacid']}' {$condition} ORDER BY id DESC LIMIT " . ($pageNumber - 1) * $pageSize . ',' . $pageSize;
        $list       = pdo_fetchall($sql);
        $total      = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->ordertable) . " WHERE uniacid = '{$_W['uniacid']}' {$condition} ORDER BY id DESC");
        $pager      = pagination($total, $pageNumber, $pageSize);
        include $this->template('order');
    }
    public function dowebAddorder()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        $orderid = intval($_GPC['orderid']);
        if ($orderid > 0) {
            $order = pdo_fetch("SELECT * FROM " . tablename($this->ordertable) . " WHERE id= " . $orderid);
            if (!$order) {
                message('抱歉，信息不存在或是已经删除！', '', 'error');
            }
            $shop = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE id= " . $order['sid']);
        }
        if ($_GPC['op'] == 'delete') {
            $orderid = intval($_GPC['workerid']);
            $order   = pdo_fetch("SELECT id FROM " . tablename($this->ordertable) . " WHERE id = " . $orderid);
            if (empty($order)) {
                message('抱歉，信息不存在或是已经被删除！');
            }
            pdo_delete($this->ordertable, array(
                'id' => $orderid
            ));
            message('删除成功！', referer(), 'success');
        }
        if (checksubmit()) {
            $data     = array(
                'type' => intval($_GPC['type']),
                'orderfee' => floatval($_GPC['orderfee']),
                'smsg' => $_GPC['smsg'],
                'fmobile' => $_GPC['fmobile'],
                'faddress' => $_GPC['faddress']
            );
            $paystate = intval($_GPC['paystate']);
            if ($paystate == 1) {
                $data['paystate'] = 1;
                $data['paytype']  = 0;
            }
            $state = intval($_GPC['state']);
            if ($state == 4) {
                $data['state'] = 4;
            }
            if (!empty($orderid)) {
                pdo_update($this->ordertable, $data, array(
                    'id' => $orderid
                ));
            } else {
                $data['uniacid'] = $_W['uniacid'];
                $data['sid']     = $shop['id'];
                pdo_insert($this->ordertable, $data);
                $orderid = pdo_insertid();
            }
            $order = pdo_fetch("SELECT * FROM " . tablename($this->ordertable) . " WHERE id= " . $orderid);
        }
        include $this->template('addorder');
    }
    public function dowebServiceHome()
    {
        global $_W, $_GPC;
        $condition = " and 1=1 ";
        $shname    = $_GPC['shname'];
        if (!empty($shname)) {
            $condition .= " AND shname like '%{$shname}%'";
        }
        $pageNumber = max(1, intval($_GPC['page']));
        $pageSize   = 40;
        $sql        = "SELECT * FROM " . tablename($this->servicehometable) . " WHERE uniacid = '{$_W['uniacid']}' {$condition} ORDER BY id LIMIT " . ($pageNumber - 1) * $pageSize . ',' . $pageSize;
        $list       = pdo_fetchall($sql);
        $total      = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->servicehometable) . " WHERE uniacid = '{$_W['uniacid']}' {$condition} ORDER BY id DESC");
        $pager      = pagination($total, $pageNumber, $pageSize);
        include $this->template('servicehome');
    }
    public function dowebAddservicehome()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        $op            = $_GPC['op'];
        $servicehomeid = intval($_GPC['servicehomeid']);
        if ($servicehomeid > 0) {
            $servicehome = pdo_fetch("SELECT * FROM " . tablename($this->servicehometable) . " WHERE id= " . $servicehomeid);
            if (!$servicehome) {
                message('抱歉，信息不存在或是已经删除！', '', 'error');
            }
            $shimgs    = unserialize($servicehome['shimgs']);
            $shbanners = unserialize($servicehome['shbanners']);
        }
        if ($_GPC['op'] == 'delete') {
            $servicehomeid = intval($_GPC['servicehomeid']);
            $servicehome   = pdo_fetch("SELECT id FROM " . tablename($this->servicehometable) . " WHERE id = " . $servicehomeid);
            if (empty($servicehome)) {
                message('抱歉，信息不存在或是已经被删除！');
            }
            pdo_delete($this->servicehometable, array(
                'id' => $servicehomeid
            ));
            pdo_delete($this->servicetable, array(
                'svhmid' => $servicehomeid
            ));
            message('删除成功！', referer(), 'success');
        }
        if (checksubmit()) {
            $img       = serialize($_GPC['shimgs']);
            $shbanners = serialize($_GPC['shbanners']);
            $data      = array(
                'shname' => $_GPC['shname'],
                'sprice' => floatval($_GPC['sprice']),
                'sminute' => intval($_GPC['sminute']),
                'ssum' => $_GPC['ssum'],
                'shlogo' => $_GPC['shlogo'],
                'shimgs' => $img,
                'shbanners' => $shbanners,
                'shdesc' => mb_substr($_GPC['shdesc'], 0, 12, 'utf-8'),
                'shcontent' => $_GPC['shcontent'],
                'shyynotice' => $_GPC['shyynotice'],
                'shreminder' => $_GPC['shreminder'],
                'state' => intval($_GPC['state'])
            );
            $optitle   = '修改';
            if (!empty($servicehomeid)) {
                pdo_update($this->servicehometable, $data, array(
                    'id' => $servicehomeid
                ));
            } else {
                $data['uniacid'] = $_W['uniacid'];
                pdo_insert($this->servicehometable, $data);
                $servicehomeid = pdo_insertid();
                $optitle       = '添加';
            }
            $servicehome = pdo_fetch("SELECT * FROM " . tablename($this->servicehometable) . " WHERE id= " . $servicehomeid);
            $shimgs      = unserialize($servicehome['shimgs']);
            $shbanners   = unserialize($servicehome['shbanners']);
            message($optitle . '服务成功！', referer(), 'success');
        }
        include $this->template('addservicehome');
    }
    public function dowebServiceUnaudit()
    {
        global $_W, $_GPC;
        $condition  = " and state = 1 ";
        $pageNumber = max(1, intval($_GPC['page']));
        $pageSize   = 20;
        $sql        = "SELECT * FROM " . tablename($this->servicetable) . " WHERE uniacid = '{$_W['uniacid']}' {$condition} ORDER BY id LIMIT " . ($pageNumber - 1) * $pageSize . ',' . $pageSize;
        $list       = pdo_fetchall($sql);
        $total      = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->servicetable) . " WHERE uniacid = '{$_W['uniacid']}' {$condition} ORDER BY id DESC");
        $pager      = pagination($total, $pageNumber, $pageSize);
        include $this->template('serviceunaudit');
    }
    public function dowebServiceDoaudit()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        $op        = $_GPC['op'];
        $serviceid = intval($_GPC['serviceid']);
        if ($serviceid > 0) {
            $service = pdo_fetch("SELECT * FROM " . tablename($this->servicetable) . " WHERE id= " . $serviceid);
            if (!$service) {
                message('抱歉，信息不存在或是已经删除！', '', 'error');
            }
        }
        if ($_GPC['op'] == 'audit') {
            pdo_update($this->servicetable, array(
                'state' => 2
            ), array(
                'id' => $serviceid
            ));
        }
        $url = $_W['siteroot'] . $this->createWebUrl('ServiceUnaudit');
        message('审核通过！', $url, 'success');
    }
    public function dowebService()
    {
        global $_W, $_GPC;
        $ssql      = "SELECT id,stitle FROM " . tablename($this->shoptable) . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY id";
        $slist     = pdo_fetchall($ssql);
        $condition = " and 1=1 ";
        $shopid    = intval($_GPC['shopid']);
        if ($shopid > 0) {
            $condition .= " and sid = '{$shopid}'";
            $_SESSION['water_o2o_service_shopid'] = $shopid;
        } else {
            if ($shopid == -1) {
                $_SESSION['water_o2o_service_shopid'] = $shopid;
            } else {
                $nowshopid = $_SESSION['water_o2o_service_shopid'];
                if ($nowshopid > 0) {
                    $shopid = $nowshopid;
                    $condition .= " and sid = '{$shopid}'";
                }
            }
        }
        $stitle = $_GPC['stitle'];
        if (!empty($stitle)) {
            $condition .= " AND stitle like '%{$stitle}%'";
        }
        $pageNumber = max(1, intval($_GPC['page']));
        $pageSize   = 20;
        $sql        = "SELECT * FROM " . tablename($this->servicetable) . " WHERE uniacid = '{$_W['uniacid']}' {$condition} ORDER BY id LIMIT " . ($pageNumber - 1) * $pageSize . ',' . $pageSize;
        $list       = pdo_fetchall($sql);
        $total      = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->servicetable) . " WHERE uniacid = '{$_W['uniacid']}' {$condition} ORDER BY id DESC");
        $pager      = pagination($total, $pageNumber, $pageSize);
        include $this->template('service');
    }
    public function dowebAddservice()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        $op        = $_GPC['op'];
        $serviceid = intval($_GPC['serviceid']);
        if ($serviceid > 0) {
            $service = pdo_fetch("SELECT * FROM " . tablename($this->servicetable) . " WHERE id= " . $serviceid);
            if (!$service) {
                message('抱歉，信息不存在或是已经删除！', '', 'error');
            }
            $simgs    = unserialize($service['simgs']);
            $sbanners = unserialize($service['sbanners']);
            if ($service['sid'] > 0) {
                $shop = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE id= " . $service['sid']);
            }
        } else {
            $shopid = intval($_GPC['shopid']);
            if ($shopid > 0) {
                $shop = pdo_fetch("SELECT * FROM " . tablename($this->shoptable) . " WHERE id= " . $shopid);
            }
        }
        if ($_GPC['op'] == 'delete') {
            $serviceid = intval($_GPC['serviceid']);
            $service   = pdo_fetch("SELECT id FROM " . tablename($this->servicetable) . " WHERE id = " . $serviceid);
            if (empty($service)) {
                message('抱歉，信息不存在或是已经被删除！');
            }
            pdo_delete($this->servicetable, array(
                'id' => $serviceid
            ));
            message('删除成功！', referer(), 'success');
        }
        if (checksubmit()) {
            $img      = serialize($_GPC['simgs']);
            $sbanners = serialize($_GPC['sbanners']);
            $data     = array(
                'sname' => $_GPC['sname'],
                'slogo' => $_GPC['slogo'],
                'simgs' => $img,
                'sbanners' => $sbanners,
                'sdesc' => mb_substr($_GPC['sdesc'], 0, 12, 'utf-8'),
                'scontent' => $_GPC['scontent'],
                'syynotice' => $_GPC['syynotice'],
                'sreminder' => $_GPC['sreminder'],
                'sprice' => floatval($_GPC['sprice']),
                'sminute' => intval($_GPC['sminute']),
                'state' => intval($_GPC['state']),
                'dohome' => intval($_GPC['dohome'])
            );
            $optitle  = '修改';
            if (!empty($serviceid)) {
                pdo_update($this->servicetable, $data, array(
                    'id' => $serviceid
                ));
            } else {
                $data['uniacid'] = $_W['uniacid'];
                $data['rank']    = $rank;
                $data['sid']     = $shop['id'];
                $data['stitle']  = $shop['stitle'];
                pdo_insert($this->servicetable, $data);
                $serviceid = pdo_insertid();
                $optitle   = '添加';
            }
            $service  = pdo_fetch("SELECT * FROM " . tablename($this->servicetable) . " WHERE id= " . $serviceid);
            $simgs    = unserialize($service['simgs']);
            $sbanners = unserialize($service['sbanners']);
            message($optitle . '服务成功！', referer(), 'success');
        }
        include $this->template('addservice');
    }
    public function dowebFans()
    {
        global $_W, $_GPC;
        $pageNumber = max(1, intval($_GPC['page']));
        $pageSize   = 20;
        $sql        = "SELECT * FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}'  ORDER BY id LIMIT " . ($pageNumber - 1) * $pageSize . ',' . $pageSize;
        $list       = pdo_fetchall($sql);
        $total      = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}'  ORDER BY id");
        $pager      = pagination($total, $pageNumber, $pageSize);
        include $this->template('fans');
    }
    public function dowebaddFans()
    {
        global $_W, $_GPC;
        load()->func('tpl');
        $fansid = intval($_GPC['fansid']);
        if ($fansid > 0) {
            $fans = pdo_fetch("SELECT * FROM " . tablename($this->fanstable) . " WHERE id= '{$fansid}'");
            if (!$fans) {
                message('抱歉，信息不存在或是已经删除！', '', 'error');
            }
        }
        if ($_GPC['op'] == 'delete') {
            $fans = pdo_fetch("SELECT * FROM " . tablename($this->fanstable) . " WHERE id= '{$fansid}'");
            if (empty($fans)) {
                message('抱歉，信息不存在或是已经被删除！');
            }
            pdo_delete($this->fanstable, array(
                'id' => $fansid
            ));
            message('删除成功！', referer(), 'success');
        }
        if (checksubmit()) {
            $data = array(
                'fname' => $_GPC['fname'],
                'mobile' => $_GPC['mobile']
            );
            if (!empty($fansid)) {
                pdo_update($this->fanstable, $data, array(
                    'id' => $fansid
                ));
            } else {
                $data['uniacid'] = $_W['uniacid'];
                pdo_insert($this->fanstable, $data);
                $fansid = pdo_insertid();
            }
            $fans = pdo_fetch("SELECT * FROM " . tablename($this->fanstable) . " WHERE id= '{$fansid}'");
            message('更新成功！', referer(), 'success');
        }
        include $this->template('addfans');
    }
    function getMillisecond()
    {
        list($t1, $t2) = explode(' ', microtime());
        return (float) sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }
    public function getOrdersSumByFid($fansid)
    {
        global $_W;
        $result = pdo_fetch("SELECT count(*) as cnt FROM " . tablename($this->ordertable) . " WHERE state = 0 and  fid = '{$fansid}' and uniacid = '{$_W['uniacid']}'");
        return $result['cnt'] <= 0 ? 0 : $result['cnt'];
    }
    public function getWorkersBySid($shopid)
    {
        global $_W;
        $result = pdo_fetch("SELECT count(*) as cnt FROM " . tablename($this->workertable) . " WHERE state = 2 and  sid = '{$shopid}' and uniacid = '{$_W['uniacid']}'");
        return $result['cnt'] <= 0 ? 0 : $result['cnt'];
    }
    public function getSumfeeBySid($shopid)
    {
        global $_W;
        $result = pdo_fetch("SELECT sum(orderfee) as cnt FROM " . tablename($this->ordertable) . " WHERE paystate = 1 and sid = '{$shopid}' and uniacid = '{$_W['uniacid']}'");
        return $result['cnt'] <= 0 ? 0 : round($result['cnt'], 2);
    }
    public function getSumCanFlowfeeBySid($shopid)
    {
        global $_W;
        $all    = pdo_fetch("SELECT sum(orderfee) as cnt FROM " . tablename($this->ordertable) . " WHERE paystate = 1 and sid = '{$shopid}' and uniacid = '{$_W['uniacid']}'");
        $fmoney = pdo_fetch("SELECT sum(fmoney) as cnt FROM " . tablename($this->fondtable) . " WHERE shopid = '{$shopid}' and uniacid = '{$_W['uniacid']}'");
        $left   = $all['cnt'] - $fmoney['cnt'];
        return $left <= 0 ? 0 : round($left, 2);
    }
    public function getSumCanFlowfeeByWid($workerid)
    {
        global $_W;
        $all    = pdo_fetch("SELECT sum(orderfee) as cnt FROM " . tablename($this->ordertable) . " WHERE paystate = 1 and wid = '{$workerid}' and uniacid = '{$_W['uniacid']}'");
        $fmoney = pdo_fetch("SELECT sum(fmoney) as cnt FROM " . tablename($this->fondtable) . " WHERE workerid = '{$workerid}' and uniacid = '{$_W['uniacid']}'");
        $left   = floatval($all['cnt']) - floatval($fmoney['cnt']);
        return $left <= 0 ? 0 : round($left, 2);
    }
    public function getSumWorkerFeeByWid($workerid)
    {
        global $_W;
        $all  = pdo_fetch("SELECT sum(orderfee) as cnt FROM " . tablename($this->ordertable) . " WHERE paystate = 1 and wid = '{$workerid}' and uniacid = '{$_W['uniacid']}'");
        $left = floatval($all['cnt']);
        return $left <= 0 ? 0 : round($left, 2);
    }
    public function getOrdersEndSumBySid($shopid)
    {
        global $_W;
        $result = pdo_fetch("SELECT count(*) as cnt FROM " . tablename($this->ordertable) . " WHERE state = 3 and  sid = '{$shopid}' and uniacid = '{$_W['uniacid']}'");
        return $result['cnt'] <= 0 ? 0 : $result['cnt'];
    }
    public function getOrdersSumBySid($shopid)
    {
        global $_W;
        $result = pdo_fetch("SELECT count(*) as cnt FROM " . tablename($this->ordertable) . " WHERE state in (1,2) and  sid = '{$shopid}' and uniacid = '{$_W['uniacid']}'");
        return $result['cnt'] <= 0 ? 0 : $result['cnt'];
    }
    public function getOrdersSumByWid($workerid)
    {
        global $_W;
        $result = pdo_fetch("SELECT count(*) as cnt FROM " . tablename($this->ordertable) . " WHERE state in (1,2) and wid = '{$workerid}' and uniacid = '{$_W['uniacid']}'");
        return $result['cnt'] <= 0 ? 0 : $result['cnt'];
    }
    public function getZsOrdersSumByFid($fansid)
    {
        global $_W;
        $result = pdo_fetch("SELECT count(*) as cnt FROM " . tablename($this->ordertable) . " WHERE state in (1,2,3,4) and fid = '{$fansid}' and uniacid = '{$_W['uniacid']}'");
        return $result['cnt'] <= 0 ? 0 : $result['cnt'];
    }
    public function getServicesSumByWid($workerid)
    {
        global $_W;
        $result = pdo_fetch("SELECT count(*) as cnt FROM " . tablename($this->servicetable) . " WHERE wid = '{$workerid}' and uniacid = '{$_W['uniacid']}'");
        return $result['cnt'] <= 0 ? 0 : $result['cnt'];
    }
    public function getTimesSumByWid($workerid)
    {
        global $_W;
        $result = pdo_fetch("SELECT count(*) as cnt FROM " . tablename($this->timetable) . " WHERE state = 1 and workerid = '{$workerid}' and uniacid = '{$_W['uniacid']}'");
        return $result['cnt'] <= 0 ? 0 : $result['cnt'];
    }
    public function getServicesSumBySid($shopid)
    {
        global $_W;
        $result = pdo_fetch("SELECT count(*) as cnt FROM " . tablename($this->servicetable) . " WHERE sid = '{$shopid}' and uniacid = '{$_W['uniacid']}'");
        return $result['cnt'] <= 0 ? 0 : $result['cnt'];
    }
    public function getTimesSumBySid($shopid)
    {
        global $_W;
        $result = pdo_fetch("SELECT count(*) as cnt FROM " . tablename($this->timetable) . " WHERE state = 1 and shopid = '{$shopid}' and uniacid = '{$_W['uniacid']}'");
        return $result['cnt'] <= 0 ? 0 : $result['cnt'];
    }
    public function getOrdersSumBySvid($serviceid)
    {
        global $_W;
        $result = pdo_fetch("SELECT count(*) as cnt FROM " . tablename($this->ordertable) . " WHERE state = 3 and svid = '{$serviceid}' and uniacid = '{$_W['uniacid']}'");
        return $result['cnt'] <= 0 ? 0 : $result['cnt'];
    }
    public function getFansNickName($openid)
    {
        global $_W;
        $result = pdo_fetch("SELECT nickname FROM " . tablename($this->fanstable) . " WHERE openid = '{$openid}' ");
        return $result['nickname'];
    }
    public function getPLByOrderid($orderid)
    {
        global $_W;
        $result = pdo_fetch("SELECT * FROM " . tablename($this->pltable) . " WHERE orderid = '{$orderid}' ");
        return $result;
    }
    public function getServceHomeByShopidAndShid($shopid, $shid)
    {
        global $_W;
        $result = pdo_fetch("SELECT * FROM " . tablename($this->servicetable) . " WHERE uniacid = '{$_W['uniacid']}' and sid = '{$shopid}' and svhmid = '{$shid}' ");
        return $result;
    }
    public function getAccountInfo($openid)
    {
        global $_W;
        $member = pdo_fetch("SELECT mem.credit1,mem.credit2,mem.mobile FROM " . tablename('mc_mapping_fans') . " mapp 
								left join " . tablename('mc_members') . " mem on mapp.uid = mem.uid  WHERE mapp.openid = '{$openid}'");
        $jifen  = 0.00;
        $yue    = 0.00;
        if ($member['credit1']) {
            $jifen = $member['credit1'];
        }
        if ($member['credit2']) {
            $yue = $member['credit2'];
        }
        return array(
            'yue' => $yue,
            'jifen' => $jifen
        );
    }
    public function sendMobileMSG($uid, $pwd, $mobile, $content)
    {
        $url    = 'http://api.sms.cn/mt/?uid=' . $uid . '&pwd=' . md5($pwd . $uid) . '&mobile=' . $mobile . '&mobileids=' . $mobile . mt_rand() . '&content=' . $content . '&encode=utf8';
        $result = file_get_contents($url);
        return $result;
    }
    public function getToken()
    {
        global $_W;
        load()->classs('weixin.account');
        $accObj       = WeixinAccount::create($_W['acid']);
        $access_token = $accObj->fetch_token();
        return $access_token;
    }
    public function sendMBXX($access_token, $data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
        ihttp_post($url, json_encode($data));
    }
    public function doMobileSendVerifyCode()
    {
        global $_W, $_GPC;
        $tel = $_GPC['tel'];
        if (empty($tel)) {
            die(json_encode(array(
                "result" => 0,
                "msg" => '手机号码不正确'
            )));
        }
        $fans = pdo_fetch("SELECT * FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and mobile ='{$tel}'");
        if (!empty($fans)) {
            die(json_encode(array(
                "result" => 0,
                "msg" => '该手机号码已注册为系统用户账号'
            )));
        }
        $_SESSION['water_o2o_app_tel']  = $tel;
        $rand4num                       = random(4, true);
        $_SESSION['water_o2o_app_rand'] = $rand4num;
        $system                         = $this->module['config'];
        $usefish                        = intval($system['usefish']);
        if ($usefish == 0) {
            if (empty($system['smsuid']) || empty($system['smspwd']) || empty($system['smsyzmb'])) {
                die(json_encode(array(
                    "result" => 0,
                    "msg" => 'SMS短信设置信息不完善'
                )));
            }
            $content = str_replace("#", $rand4num, $system['smsyzmb']);
            $result  = $this->sendMobileMSG($system['smsuid'], $system['smspwd'], $tel, $content);
            $arr     = explode("&", $result);
            if (is_array($arr)) {
                $tmp1     = $arr[1];
                $statearr = explode("=", $tmp1);
                if (is_array($statearr)) {
                    $state = $statearr[1];
                    if ($state == '100') {
                        die(json_encode(array(
                            "result" => 1,
                            "msg" => '验证码已发送'
                        )));
                    } else {
                        die(json_encode(array(
                            'result' => 0,
                            'msg' => 'error:' . $state
                        )));
                    }
                } else {
                    die(json_encode(array(
                        'result' => 0,
                        'msg' => 'error2'
                    )));
                }
            } else {
                die(json_encode(array(
                    'result' => 0,
                    'msg' => 'error1'
                )));
            }
        } else {
            if (empty($system['fishappkey']) || empty($system['fishsecret']) || empty($system['fishsign']) || empty($system['fishyzmb']) || empty($system['fishyzmparam'])) {
                die(json_encode(array(
                    "result" => 0,
                    "msg" => '阿里大鱼短信设置信息不完善'
                )));
            }
            include 'bigfish/TopSdk.php';
            $c            = new TopClient;
            $c->appkey    = $system['fishappkey'];
            $c->secretKey = $system['fishsecret'];
            $req          = new AlibabaAliqinFcSmsNumSendRequest;
            $req->setSmsType("normal");
            $req->setSmsFreeSignName($system['fishsign']);
            $json = json_encode(array(
                $system['fishyzmparam'] => $rand4num
            ));
            $req->setSmsParam($json);
            $req->setRecNum($tel);
            $req->setSmsTemplateCode($system['fishyzmb']);
            $resp = $c->execute($req);
            $arr  = (array) $resp;
            if (is_array($arr)) {
                $result = $arr['result'];
                if (empty($result)) {
                    die(json_encode(array(
                        "result" => 0,
                        "msg" => 'error3' . $result['msg']
                    )));
                } else {
                    $content = (array) $result;
                    if ($content['err_code'] == "0") {
                        die(json_encode(array(
                            "result" => 1,
                            "msg" => '验证码已发送'
                        )));
                    } else {
                        die(json_encode(array(
                            'result' => 0,
                            'msg' => 'error2'
                        )));
                    }
                }
            } else {
                die(json_encode(array(
                    'result' => 0,
                    'msg' => 'error1'
                )));
            }
        }
    }
    public function doMobileSendVerifyCodeForWorker()
    {
        global $_W, $_GPC;
        $tel = $_GPC['tel'];
        if (empty($tel)) {
            die(json_encode(array(
                "result" => 0,
                "msg" => '手机号码不正确'
            )));
        }
        $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and mobile ='{$tel}'");
        if (!empty($worker)) {
            die(json_encode(array(
                "result" => 0,
                "msg" => '该手机号码已注册为系统员工账号'
            )));
        }
        $fans = pdo_fetch("SELECT * FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and mobile ='{$tel}'");
        if ($fans['shopid'] > 0) {
            die(json_encode(array(
                "result" => 0,
                "msg" => '该手机号码已注册为商铺账号'
            )));
        }
        $_SESSION['water_o2o_app_tel']  = $tel;
        $rand4num                       = random(4, true);
        $_SESSION['water_o2o_app_rand'] = $rand4num;
        $system                         = $this->module['config'];
        $usefish                        = intval($system['usefish']);
        if ($usefish == 0) {
            if (empty($system['smsuid']) || empty($system['smspwd']) || empty($system['smsyzmb'])) {
                die(json_encode(array(
                    "result" => 0,
                    "msg" => 'SMS短信设置信息不完善'
                )));
            }
            $content = str_replace("#", $rand4num, $system['smsyzmb']);
            $result  = $this->sendMobileMSG($system['smsuid'], $system['smspwd'], $tel, $content);
            $arr     = explode("&", $result);
            if (is_array($arr)) {
                $tmp1     = $arr[1];
                $statearr = explode("=", $tmp1);
                if (is_array($statearr)) {
                    $state = $statearr[1];
                    if ($state == '100') {
                        die(json_encode(array(
                            "result" => 1,
                            "msg" => '验证码已发送'
                        )));
                    } else {
                        die(json_encode(array(
                            'result' => 0,
                            'msg' => 'error:' . $state
                        )));
                    }
                } else {
                    die(json_encode(array(
                        'result' => 0,
                        'msg' => 'error2'
                    )));
                }
            } else {
                die(json_encode(array(
                    'result' => 0,
                    'msg' => 'error1'
                )));
            }
        } else {
            if (empty($system['fishappkey']) || empty($system['fishsecret']) || empty($system['fishsign']) || empty($system['fishyzmb']) || empty($system['fishyzmparam'])) {
                die(json_encode(array(
                    "result" => 0,
                    "msg" => '阿里大鱼短信设置信息不完善'
                )));
            }
            include 'bigfish/TopSdk.php';
            $c            = new TopClient;
            $c->appkey    = $system['fishappkey'];
            $c->secretKey = $system['fishsecret'];
            $req          = new AlibabaAliqinFcSmsNumSendRequest;
            $req->setSmsType("normal");
            $req->setSmsFreeSignName($system['fishsign']);
            $json = json_encode(array(
                $system['fishyzmparam'] => $rand4num
            ));
            $req->setSmsParam($json);
            $req->setRecNum($tel);
            $req->setSmsTemplateCode($system['fishyzmb']);
            $resp = $c->execute($req);
            $arr  = (array) $resp;
            if (is_array($arr)) {
                $result = $arr['result'];
                if (empty($result)) {
                    die(json_encode(array(
                        "result" => 0,
                        "msg" => 'error3' . $result['msg']
                    )));
                } else {
                    $content = (array) $result;
                    if ($content['err_code'] == "0") {
                        die(json_encode(array(
                            "result" => 1,
                            "msg" => '验证码已发送'
                        )));
                    } else {
                        die(json_encode(array(
                            'result' => 0,
                            'msg' => 'error2'
                        )));
                    }
                }
            } else {
                die(json_encode(array(
                    'result' => 0,
                    'msg' => 'error1'
                )));
            }
        }
    }
    public function doMobileSendVerifyCodeForShop()
    {
        global $_W, $_GPC;
        $tel = $_GPC['tel'];
        if (empty($tel)) {
            die(json_encode(array(
                "result" => 0,
                "msg" => '手机号码不正确'
            )));
        }
        $worker = pdo_fetch("SELECT * FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' and mobile ='{$tel}'");
        if (!empty($worker)) {
            die(json_encode(array(
                "result" => 0,
                "msg" => '该手机号码已注册为系统员工账号'
            )));
        }
        $fans = pdo_fetch("SELECT * FROM " . tablename($this->fanstable) . " WHERE uniacid = '{$_W['uniacid']}' and mobile ='{$tel}'");
        if ($fans['shopid'] > 0) {
            die(json_encode(array(
                "result" => 0,
                "msg" => '该手机号码已注册为商铺账号'
            )));
        }
        $_SESSION['water_o2o_app_tel']  = $tel;
        $rand4num                       = random(4, true);
        $_SESSION['water_o2o_app_rand'] = $rand4num;
        $system                         = $this->module['config'];
        $usefish                        = intval($system['usefish']);
        if ($usefish == 0) {
            if (empty($system['smsuid']) || empty($system['smspwd']) || empty($system['smsyzmb'])) {
                die(json_encode(array(
                    "result" => 0,
                    "msg" => 'SMS短信设置信息不完善'
                )));
            }
            $content = str_replace("#", $rand4num, $system['smsyzmb']);
            $result  = $this->sendMobileMSG($system['smsuid'], $system['smspwd'], $tel, $content);
            $arr     = explode("&", $result);
            if (is_array($arr)) {
                $tmp1     = $arr[1];
                $statearr = explode("=", $tmp1);
                if (is_array($statearr)) {
                    $state = $statearr[1];
                    if ($state == '100') {
                        die(json_encode(array(
                            "result" => 1,
                            "msg" => '验证码已发送'
                        )));
                    } else {
                        die(json_encode(array(
                            'result' => 0,
                            'msg' => 'error:' . $state
                        )));
                    }
                } else {
                    die(json_encode(array(
                        'result' => 0,
                        'msg' => 'error2'
                    )));
                }
            } else {
                die(json_encode(array(
                    'result' => 0,
                    'msg' => 'error1'
                )));
            }
        } else {
            if (empty($system['fishappkey']) || empty($system['fishsecret']) || empty($system['fishsign']) || empty($system['fishyzmb']) || empty($system['fishyzmparam'])) {
                die(json_encode(array(
                    "result" => 0,
                    "msg" => '阿里大鱼短信设置信息不完善'
                )));
            }
			//折V翼V天V使V资V源V社V区V提V供
            include 'bigfish/TopSdk.php';
            $c            = new TopClient;
            $c->appkey    = $system['fishappkey'];
            $c->secretKey = $system['fishsecret'];
            $req          = new AlibabaAliqinFcSmsNumSendRequest;
            $req->setSmsType("normal");
            $req->setSmsFreeSignName($system['fishsign']);
            $json = json_encode(array(
                $system['fishyzmparam'] => $rand4num
            ));
            $req->setSmsParam($json);
            $req->setRecNum($tel);
            $req->setSmsTemplateCode($system['fishyzmb']);
            $resp = $c->execute($req);
            $arr  = (array) $resp;
            if (is_array($arr)) {
                $result = $arr['result'];
                if (empty($result)) {
                    die(json_encode(array(
                        "result" => 0,
                        "msg" => 'error3' . $result['msg']
                    )));
                } else {
                    $content = (array) $result;
                    if ($content['err_code'] == "0") {
                        die(json_encode(array(
                            "result" => 1,
                            "msg" => '验证码已发送'
                        )));
                    } else {
                        die(json_encode(array(
                            'result' => 0,
                            'msg' => 'error2'
                        )));
                    }
                }
            } else {
                die(json_encode(array(
                    'result' => 0,
                    'msg' => 'error1'
                )));
            }
        }
    }
    public function doMobileVerifyCode()
    {
        global $_W, $_GPC;
        $openid = $_W['fans']['from_user'];
        $url    = $_W['siteroot'] . 'app/' . $this->createMobileUrl('index');
        if (empty($openid)) {
            die(json_encode(array(
                "result" => 0,
                "msg" => "系统错误",
                "url" => $url
            )));
        }
        $tel     = $_GPC['tel'];
        $code    = $_GPC['code'];
        $tel2    = $_SESSION['water_o2o_app_tel'];
        $code2   = $_SESSION['water_o2o_app_rand'];
        $sessurl = $_SESSION['water_o2o_app_url'];
        if (!empty($sessurl)) {
            $url                           = $sessurl;
            $_SESSION['water_o2o_app_url'] = "";
        }
        if ($tel == $tel2 && $code == $code2) {
            $_SESSION['water_o2o_app_mobile'] = $tel;
            $_SESSION['water_o2o_app_tel']    = '';
            $_SESSION['water_o2o_app_rand']   = '';
            $result                           = pdo_update($this->fanstable, array(
                'mobile' => $tel
            ), array(
                'openid' => $openid
            ));
            die(json_encode(array(
                'result' => 1,
                'msg' => '验证正确',
                'url' => $url
            )));
        } else {
            die(json_encode(array(
                'result' => 0,
                'msg' => '验证码错误',
                'url' => $url
            )));
        }
    }
    public function doMobileVerifyCodeForWorker()
    {
        global $_W, $_GPC;
        $openid = $_W['fans']['from_user'];
        $url    = $_W['siteroot'] . 'app/' . $this->createMobileUrl('index');
        if (empty($openid)) {
            die(json_encode(array(
                "result" => 0,
                "msg" => "系统错误",
                "url" => $url
            )));
        }
        $tel     = $_GPC['tel'];
        $code    = $_GPC['code'];
        $tel2    = $_SESSION['water_o2o_app_tel'];
        $code2   = $_SESSION['water_o2o_app_rand'];
        $sessurl = $_SESSION['water_o2o_app_url'];
        if (!empty($sessurl)) {
            $url                           = $sessurl;
            $_SESSION['water_o2o_app_url'] = "";
        }
        if ($tel == $tel2 && $code == $code2) {
            $_SESSION['water_o2o_app_mobile'] = $tel;
            $_SESSION['water_o2o_app_tel']    = '';
            $_SESSION['water_o2o_app_rand']   = '';
            $result                           = pdo_update($this->workertable, array(
                'mobile' => $tel
            ), array(
                'openid' => $openid
            ));
            die(json_encode(array(
                'result' => 1,
                'msg' => '验证正确',
                'url' => $url
            )));
        } else {
            die(json_encode(array(
                'result' => 0,
                'msg' => '验证码错误',
                'url' => $url
            )));
        }
    }
    public function doMobileVerifyCodeForShop()
    {
        global $_W, $_GPC;
        $openid = $_W['fans']['from_user'];
        $url    = $_W['siteroot'] . 'app/' . $this->createMobileUrl('index');
        if (empty($openid)) {
            die(json_encode(array(
                "result" => 0,
                "msg" => "系统错误",
                "url" => $url
            )));
        }
        $tel     = $_GPC['tel'];
        $code    = $_GPC['code'];
        $tel2    = $_SESSION['water_o2o_app_tel'];
        $code2   = $_SESSION['water_o2o_app_rand'];
        $sessurl = $_SESSION['water_o2o_app_url'];
        if (!empty($sessurl)) {
            $url                           = $sessurl;
            $_SESSION['water_o2o_app_url'] = "";
        }
        if ($tel == $tel2 && $code == $code2) {
            $_SESSION['water_o2o_app_mobile'] = $tel;
            $_SESSION['water_o2o_app_tel']    = '';
            $_SESSION['water_o2o_app_rand']   = '';
            $data                             = array(
                'uniacid' => $_W['uniacid'],
                'sopenid' => $openid,
                'smobile' => $tel,
                'wxadd' => 1
            );
            pdo_insert($this->shoptable, $data);
            $shopid = pdo_insertid();
            $result = pdo_update($this->fanstable, array(
                'shopid' => $shopid
            ), array(
                'openid' => $openid
            ));
            die(json_encode(array(
                'result' => 1,
                'msg' => '验证正确',
                'url' => $url
            )));
        } else {
            die(json_encode(array(
                'result' => 0,
                'msg' => '验证码错误',
                'url' => $url
            )));
        }
    }
    public function doMobileShopsjl()
    {
        global $_W, $_GPC;
        $lat    = $_GPC['lat'];
        $lng    = $_GPC['lng'];
        $sql    = "SELECT id,slocation FROM " . tablename($this->shoptable) . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY id";
        $list   = pdo_fetchall($sql);
        $jllist = array();
        foreach ($list as $index => $shop) {
            $slct           = unserialize($shop['slocation']);
            $juli           = $this->getDistance($lng, $lat, $slct['lng'], $slct['lat']);
            $jllist[$index] = array(
                "id" => $shop['id'],
                "jl" => $juli
            );
        }
        die(json_encode(array(
            'result' => 1,
            'msg' => 'success',
            jllist => $jllist
        )));
    }
    public function doMobileWorkersjl()
    {
        global $_W, $_GPC;
        $lat    = $_GPC['lat'];
        $lng    = $_GPC['lng'];
        $sql    = "SELECT id,wlocation FROM " . tablename($this->workertable) . " WHERE uniacid = '{$_W['uniacid']}' ORDER BY id";
        $list   = pdo_fetchall($sql);
        $jllist = array();
        foreach ($list as $index => $worker) {
            $slct           = unserialize($worker['wlocation']);
            $juli           = $this->getDistance($lng, $lat, $slct['lng'], $slct['lat']);
            $jllist[$index] = array(
                "id" => $worker['id'],
                "jl" => $juli
            );
        }
        die(json_encode(array(
            'result' => 1,
            'msg' => 'success',
            jllist => $jllist
        )));
    }
    static function getDistance($lng1, $lat1, $lng2, $lat2)
    {
        $EARTH_RADIUS = 6378.137;
        $PI           = 3.1415926;
        $radLat1      = $lat1 * $PI / 180.0;
        $radLat2      = $lat2 * $PI / 180.0;
        $a            = $radLat1 - $radLat2;
        $b            = ($lng1 * $PI / 180.0) - ($lng2 * $PI / 180.0);
        $s            = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $s            = $s * $EARTH_RADIUS;
        $s            = round($s * 1000);
        $distance     = round($s, 2);
        if ($distance < 1000) {
            $distance = floor($distance);
            $unit     = '米';
        } else {
            $distance = round($distance / 1000, 2);
            $unit     = '千米';
        }
        return $distance . $unit;
    }
    static function changeBDToGCJ($bd_lat, $bd_lon)
    {
        $x_pi   = 3.14159265358979324 * 3000.0 / 180.0;
        $x      = $bd_lat - 0.0065;
        $y      = $bd_lon - 0.006;
        $z      = sqrt($x * $x + $y * $y) - 0.00002 * sin($y * $x_pi);
        $theta  = atan2($y, $x) - 0.000003 * cos($x * $x_pi);
        $gg_lon = $z * cos($theta);
        $gg_lat = $z * sin($theta);
        return array(
            'lat' => round($gg_lon, 6),
            'lng' => round($gg_lat, 6)
        );
    }
    function transfer($openid, $amount, $desc)
    {
        global $_W;
        $system                   = $this->module['config'];
        $ret                      = array();
        $amount                   = $amount * 100;
        $ret['amount']            = $amount;
        $url                      = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
        $pars                     = array();
        $pars['mch_appid']        = $_W['account']['key'];
        $pars['mchid']            = $system['mchid'];
        $pars['nonce_str']        = random(32);
        $pars['partner_trade_no'] = random(10) . date('Ymd') . random(3);
        $pars['openid']           = $openid;
        $pars['check_name']       = "NO_CHECK";
        $pars['amount']           = $amount;
        $pars['desc']             = $desc;
        $pars['spbill_create_ip'] = $system['ip'];
        ksort($pars, SORT_STRING);
        $string1 = '';
        foreach ($pars as $k => $v) {
            $string1 .= "{$k}={$v}&";
        }
        $string1 .= "key=" . $system['apikey'];
        $pars['sign']              = strtoupper(md5($string1));
        $xml                       = array2xml($pars);
        $extras                    = array();
        $extras['CURLOPT_CAINFO']  = $system['rootca'];
        $extras['CURLOPT_SSLCERT'] = $system['apiclient_cert'];
        $extras['CURLOPT_SSLKEY']  = $system['apiclient_key'];
        load()->func('communication');
        $procResult = null;
        $resp       = ihttp_request($url, $xml, $extras);
        if (is_error($resp)) {
            $procResult     = $resp['message'];
            $ret['code']    = -1;
            $ret['message'] = "-1:" . $procResult;
            return $ret;
        } else {
            $xml = '<?xml version="1.0" encoding="utf-8"?>' . $resp['content'];
            $dom = new DOMDocument();
            if ($dom->loadXML($xml)) {
                $xpath  = new DOMXPath($dom);
                $code   = $xpath->evaluate('string(//xml/return_code)');
                $result = $xpath->evaluate('string(//xml/result_code)');
                if (strtolower($code) == 'success' && strtolower($result) == 'success') {
                    $ret['code']    = 0;
                    $ret['message'] = "success";
                    return $ret;
                } else {
                    $error          = $xpath->evaluate('string(//xml/err_code_des)');
                    $ret['code']    = -2;
                    $ret['message'] = "-2:" . $error;
                    return $ret;
                }
            } else {
                $ret['code']    = -3;
                $ret['message'] = "error response";
                return $ret;
            }
        }
    }
    function downloadFromWxServer($media_ids)
    {
        global $_W, $_GPC;
        $media_ids = explode(',', $media_ids);
        if (!$media_ids) {
            die(json_encode(array(
                'res' => '101',
                'message' => 'media_ids error'
            )));
        }
        load()->classs('weixin.account');
        $accObj       = WeixinAccount::create($_W['account']['acid']);
        $access_token = $accObj->fetch_token();
        load()->func('communication');
        load()->func('file');
        $contentType["image/gif"]  = ".gif";
        $contentType["image/jpeg"] = ".jpeg";
        $contentType["image/png"]  = ".png";
        foreach ($media_ids as $id) {
            if (!empty($id)) {
                $url      = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=" . $access_token . "&media_id=" . $id;
                $data     = ihttp_get($url);
                $filetype = $data['headers']['Content-Type'];
                $filename = date('YmdHis') . '_' . rand(1000000000, 9999999999) . '_' . rand(1000, 9999) . $contentType[$filetype];
                $wr       = file_write('/images/water_o2o/' . $filename, $data['content']);
                if ($wr) {
                    $file_succ[] = array(
                        'name' => $filename,
                        'path' => '/images/water_o2o/' . $filename,
                        'spath' => 'images/water_o2o/' . $filename,
                        'type' => 'local'
                    );
                }
            }
        }
        if (!empty($_W['setting']['remote']['type'])) {
            foreach ($file_succ as $key => $value) {
                $r = file_remote_upload($value['spath']);
                if (is_error($r)) {
                    unset($file_succ[$key]);
                    continue;
                }
                $file_succ[$key]['path'] = tomedia($value['spath']);
                $file_succ[$key]['type'] = 'other';
            }
        }
        return $file_succ;
    }
    public function createBindEWM($shopid, $workerid)
    {
        global $_W;
        $url = '';
        if ($shopid > 0) {
            $url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('shopbind', array(
                'shopid' => $shopid
            ));
        } else {
            $url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('workerbind', array(
                'workerid' => $workerid
            ));
        }
        include 'phpqrcode.php';
        $errorCorrectionLevel = 'L';
        $matrixPointSize      = 3;
        $path                 = '../attachment/images/water_o2o/';
        if (!file_exists($path)) {
            mkdir($path);
        }
        $time     = time();
        $wwwurl   = $_W['siteroot'] . 'attachment/';
        $QR       = $path . $time . '.png';
        $QR2      = $path . $time . '2.png';
        $filepath = 'images/water_o2o/' . $time . '2.png';
        QRcode::png($url, $QR, $errorCorrectionLevel, $matrixPointSize, 2);
        $logo = '../addons/water_o2o/logo.png';
        if ($logo !== FALSE) {
            $QR             = imagecreatefromstring(file_get_contents($QR));
            $logo           = imagecreatefromstring(file_get_contents($logo));
            $QR_width       = imagesx($QR);
            $QR_height      = imagesy($QR);
            $logo_width     = imagesx($logo);
            $logo_height    = imagesy($logo);
            $logo_qr_width  = $QR_width / 5;
            $scale          = $logo_width / $logo_qr_width;
            $logo_qr_height = $logo_height / $scale;
            $from_width     = ($QR_width - $logo_qr_width) / 2;
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        }
        imagepng($QR, $QR2);
        return $wwwurl . $filepath;
    }
}