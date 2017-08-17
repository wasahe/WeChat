<?php
defined('IN_IA') or exit('Access Denied');
define('ROOT_PATH', str_replace('site.php', '', str_replace('\\', '/', __FILE__)));//获取site所在目录的路径
require_once ROOT_PATH."inc/function.php";
require_once ROOT_PATH."inc/jssdk.php";


class Kuaiwei_xxcxModuleSite extends WeModuleSite
{

    public $tableflow = 'kuaiwei_xxcx_flow';
    public $tabletl = 'kuaiwei_xxcx_template';
    public $tableprogress = 'kuaiwei_xxcx_progress';
    public $tableparam = 'kuaiwei_xxcx_paramset';
    public $tablebusiness = 'kuaiwei_xxcx_business';
    public $tablefans = 'kuaiwei_xxcx_fans';
    public $tablead = 'kuaiwei_xxcx_ad';
	public $tabletype = 'kuaiwei_xxcx_type';
    public $tablefield = 'kuaiwei_xxcx_field';
	public $tableinfo = 'kuaiwei_xxcx_info';

	public function __construct() {
        global $_W;
        $this->tableinfo = 'kuaiwei_xxcx_info'.$_W['uniacid'];
	}
    public function getItemTiles()
    {
        global $_W;
        $articles = pdo_fetchall("SELECT id, title FROM " . tablename($this->tablebase) . " WHERE weid = '{$_W['uniacid']}'");
        if (!empty($articles)) {
            foreach ($articles as $row) {
                $urls[] = array('title' => $row['title'], 'url' => $this->createMobileUrl('index'));
            }
            return $urls;
        }
    }

      public function doWebSysset() {
        global $_W, $_GPC;
        $set = $this->get_sysset();
        if (checksubmit('submit')) {
            
            $appid = trim($_GPC['appid']);
            $appsecret = trim($_GPC['appsecret']);

            $data = array(
                'uniacid' => $_W['uniacid'],
                'appid' => $appid,
                'appsecret' => $appsecret,
                'appid_share' => $appid,
                'appsecret_share' => $appsecret,
            );
            if (!empty($set)) {
                pdo_update('kuaiwei_xxcx_sysset', $data, array('id' => $set['id']));
            } else {
                pdo_insert('kuaiwei_xxcx_sysset', $data);
            }
            $this->write_cache("sysset_" . $_W['uniacid'], $data);
            message('更新借用接口成功！', 'refresh');
        }

        include $this->template('sysset');
    }

    public function oath_openid($id, $code, $type)
    {
        global $_GPC, $_W;
        load()->func('communication');
        load()->model('account');
        $_W['account'] = account_fetch($_W['acid']);//获取指定子公号信息
        $appid = $_W['account']['key'];//公众号appid
        $appsecret = $_W['account']['secret'];//公众号appsecret

        if ($_W['account']['level'] != 4) {//公众号级别，普通订阅号1，普通服务号2，认证订阅号3，认证服务号4
            //不是认证服务号
            $set = $this->get_sysset();
            if (!empty($set['appid']) && !empty($set['appsecret'])) {
                $appid = $set['appid'];
                $appsecret = $set['appsecret'];
            } else {
                //如果没有借用，判断是否认证服务号
                message('请使用认证服务号进行活动，或借用其他认证服务号权限!');
            }
        }
        if (empty($appid) || empty($appsecret)) {
            message('请到管理后台设置完整的 AppID 和AppSecret !');
        }

        if (!isset($code)) {//判断变量是否已配置，变量未配置则执行
            // $this->get_code($id, $appid,$urltype);
            if (empty($type)) {

                $url = $_W['siteroot'] . "app/index.php?i=" . $_W['uniacid'] . "&c=entry&m=kuaiwei_xxcx&do=index&id={$id}";//返回助力页面

            } else {
                $url = $_W['siteroot'] . 'app/' . $this->createMobileUrl('share', array('id' => $id, 'from_user' => $type));//进入分享页面
            }
            $oauth2_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $appid . "&redirect_uri=" . urlencode($url) . "&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";//路径
            header("location: $oauth2_url");//弹出授权页面，可通过openid拿到昵称、性别、所在地；获取code
            exit();

        }
        $oauth2_code = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $appid . "&secret=" . $appsecret . "&code=" . $code . "&grant_type=authorization_code";//通过链接，获取access_token
        $content = ihttp_get($oauth2_code);//封装的 GET 请求方法
        $token = @json_decode($content['content'], true);
        if (empty($token) || !is_array($token) || empty($token['access_token']) || empty($token['openid'])) {
            message('未获取到 openid , 请刷新重试!', refeer(), 'error');
        }
        return $token;
    }


    public function oath_UserInfo($id, $code, $type)
    {
        global $_GPC, $_W;
        load()->func('communication');
        $token = $this->oath_openid($id, $code, $type);//获取access_token，openid
        $accessToken = $token['access_token'];
        $openid = $token['openid'];
        $tokenUrl = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $accessToken . "&openid=" . $openid . "&lang=zh_CN";//获取用户信息
        $content = ihttp_get($tokenUrl);//封装的 GET 请求方法
        $userInfo = @json_decode($content['content'], true);//解压
        $cookieid = '__cookie_kuaiwei_xxcx_20160714_' . $id;
        $cookie = array("nickname" => $userInfo['nickname'], 'avatar' => $userInfo['headimgurl'], 'openid' => $userInfo['openid']);//存入缓存
        setcookie($cookieid, base64_encode(json_encode($cookie)), time() + 3600 * 24 * 365);
        return $userInfo;
    }


    public function checkfans()
    {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $user_id = $_W['openid'];



        if (empty($user_id)) {

            $nofollow = 1;

        } else {

            //查询是否为关注用户
            $follow = pdo_fetch("select * from " . tablename('mc_mapping_fans') . " where openid=:openid and uniacid=:uniacid order by `fanid` desc", array(":openid" => $user_id, ":uniacid" => $uniacid));
            if ($follow['follow'] != 1) {

                $nofollow = 1;

            }
			else
			{
				 $nofollow=0;
			}
        }

		return $nofollow;
    }

    public function doMobileSuperindex()
    {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $fansID = $_W['member']['uid'];


         // $user_agent = $_SERVER['HTTP_USER_AGENT'];
         // if (strpos($user_agent, 'MicroMessenger') === false) {
         //     message('本页面仅支持微信访问!非微信浏览器禁止浏览!', '', 'error');
         // }

        //网页授权借用与非借用开始

         // load()->model('account');
         // $_W['account'] = account_fetch($_W['acid']);
         // $cookieid = '__cookie_kuaiwei_xxcx_20160714_' . $id;
         // $cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
         // if ($_W['account']['level'] != 4) {
         //   $from_user = $cookie['openid'];
         //   $avatar = $cookie['avatar'];
         //   $nickname = $cookie['nickname'];
         // }else{
        $from_user = $_W['fans']['from_user'];
        $avatar = $_W['fans']['tag']['avatar'];
        $nickname = $_W['fans']['nickname'];
         // }

         // $code = $_GPC['code'];
         // $type = '';
         // if (empty($from_user) || empty($avatar)) {
         //   if (!is_array($cookie) || !isset($cookie['avatar']) || !isset($cookie['openid'])) {
         //     $userinfo = $this->oath_UserInfo($id, $code, $type);
         //     $nickname = $userinfo['nickname'];
         //     $avatar = $userinfo['headimgurl'];
         //     $from_user = $userinfo['openid'];
         //   } else {
         //     $avatar = $cookie['avatar'];
         //     $nickname = $cookie['nickname'];
         //     $from_user = $cookie['openid'];
         //   }
         // }

        //网页授权借用与非借用结束

        //JS权限开始
        $jssdk = new JSSDK();
        $package = $jssdk->getSignPackage();
        //JS权限结束

        $page_from_user = base64_encode(authcode($from_user, 'ENCODE'));

        load()->model('mc');

        $fans = pdo_fetch("SELECT * FROM " . tablename($this->tablefans) . " WHERE from_user='" . $from_user . "'");

        if ($fans == false) {
            $insert = array(
                'fansID' => $fansID,
                'from_user' => $from_user,
                'todaynum' => 0,
                'totalnum' => 0,
                'avatar' => $avatar,
                'fname' => $nickname,
                'createtime' => time(),
            );
            $temp = pdo_insert($this->tablefans, $insert);
            $newId = pdo_insertid();

            if ($temp == false) {
                message('抱歉，刚才操作数据失败！', '', 'error');
            }
            //增加人数和浏览次数
        }




        $basecs = pdo_fetch("SELECT * FROM " . tablename($this->tableparam) . " WHERE uniacid = :uniacid ORDER BY `id` DESC", array('uniacid' => $_W['uniacid']));


        // $cs = pdo_fetch("SELECT * FROM ". tablename($this->tableparam) ."  WHERE uniacid = :uniacid", array('uniacid' => $_W['uniacid']));

        // $advert = pdo_fetch("SELECT * FROM ". tablename($this->tablead) ."  WHERE uniacid = :uniacid order by rand()  ", array('uniacid' => $_W['uniacid']));

        // $lxxx = pdo_fetchall("SELECT * FROM ". tablename($this->tableprogress) ." WHERE uniacid = :uniacid group by `type` ", array('uniacid' => $_W['uniacid']));
        // $lxxx = pdo_fetchall("SELECT * FROM ". tablename($this->tablebusiness) ." WHERE uniacid = :uniacid and status = 1 ORDER BY `id` DESC", array('uniacid' => $_W['uniacid']));

//        $lxxx = pdo_fetchall(" SELECT * FROM ". tablename($this->tablebusiness) ." ");
        $sharelink = $_W['siteroot'] . 'app/' . $this->createMobileUrl('index', array('id' => $id, 'from_user' => $page_from_user));
        $sharetitle = empty($basecs['share_title']) ? '欢迎使用信息查询管理系统！' : $basecs['share_title'];
        $sharedesc = empty($basecs['share_desc']) ? '欢迎使用信息查询管理系统！' : str_replace("\r\n", " ", $basecs['share_desc']);
        if (!empty($basecs['share_img'])) {
            $shareimg = toimage($basecs['share_img']);
        }
        $erwematype = $basecs['share_type'];
        if($basecs['guanzhu_img'])
            $erwemaimg = toimage($basecs['guanzhu_img']);
        if($basecs['guanzhu_txt'])
            $erwemaword = $basecs['guanzhu_txt'];
        $nofollow = $this->checkfans();

        include $this->template('superindex');


    }




    public function doMobileIndex()
    {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $fansID = $_W['member']['uid'];


         $user_agent = $_SERVER['HTTP_USER_AGENT'];
         if (strpos($user_agent, 'MicroMessenger') === false) {
             message('本页面仅支持微信访问!非微信浏览器禁止浏览!', '', 'error');
         }

        //网页授权借用与非借用开始

         load()->model('account');
         $_W['account'] = account_fetch($_W['acid']);
         $cookieid = '__cookie_kuaiwei_xxcx_20160714_' . $id;
         $cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
         if ($_W['account']['level'] != 4) {
           $from_user = $cookie['openid'];
           $avatar = $cookie['avatar'];
           $nickname = $cookie['nickname'];
         }else{
        $from_user = $_W['fans']['from_user'];
        $avatar = $_W['fans']['tag']['avatar'];
        $nickname = $_W['fans']['nickname'];
         }

         $code = $_GPC['code'];
         $type = '';
         if (empty($from_user) || empty($avatar)) {
           if (!is_array($cookie) || !isset($cookie['avatar']) || !isset($cookie['openid'])) {
             $userinfo = $this->oath_UserInfo($id, $code, $type);
             $nickname = $userinfo['nickname'];
             $avatar = $userinfo['headimgurl'];
             $from_user = $userinfo['openid'];
           } else {
             $avatar = $cookie['avatar'];
             $nickname = $cookie['nickname'];
             $from_user = $cookie['openid'];
           }
         }

        //网页授权借用与非借用结束

        //JS权限开始
        $jssdk = new JSSDK();
        $package = $jssdk->getSignPackage();
        //JS权限结束

        $page_from_user = base64_encode(authcode($from_user, 'ENCODE'));

        load()->model('mc');

        $fans = pdo_fetch("SELECT * FROM " . tablename($this->tablefans) . " WHERE from_user='" . $from_user . "'");

        if ($fans == false) {
            $insert = array(
                'fansID' => $fansID,
                'from_user' => $from_user,
                'todaynum' => 0,
                'totalnum' => 0,
                'avatar' => $avatar,
                'fname' => $nickname,
                'createtime' => time(),
            );
            $temp = pdo_insert($this->tablefans, $insert);
            $newId = pdo_insertid();

            if ($temp == false) {
                message('抱歉，刚才操作数据失败！', '', 'error');
            }
            //增加人数和浏览次数
        }




        $basecs = pdo_fetch("SELECT * FROM " . tablename($this->tableparam) . " WHERE uniacid = :uniacid ORDER BY `id` DESC", array('uniacid' => $_W['uniacid']));


        $cs = pdo_fetch("SELECT * FROM ". tablename($this->tableparam) ."  WHERE uniacid = :uniacid", array('uniacid' => $_W['uniacid']));

        $advert = pdo_fetch("SELECT * FROM ". tablename($this->tablead) ."  WHERE uniacid = :uniacid  AND status = 1 order by rand()  ", array('uniacid' => $_W['uniacid']));

        $lxxx = pdo_fetchall("SELECT * FROM ". tablename($this->tableprogress) ." WHERE uniacid = :uniacid group by `type` ", array('uniacid' => $_W['uniacid']));
        // $lxxx = pdo_fetchall("SELECT * FROM ". tablename($this->tablebusiness) ." WHERE uniacid = :uniacid and status = 1 ORDER BY `id` DESC", array('uniacid' => $_W['uniacid']));

//        $lxxx = pdo_fetchall(" SELECT * FROM ". tablename($this->tablebusiness) ." ");
        $sharelink = $_W['siteroot'] . 'app/' . $this->createMobileUrl('index', array('id' => $id, 'from_user' => $page_from_user));
        $sharetitle = empty($basecs['share_title']) ? '欢迎使用信息查询管理系统！' : $basecs['share_title'];
        $sharedesc = empty($basecs['share_desc']) ? '欢迎使用信息查询管理系统！' : str_replace("\r\n", " ", $basecs['share_desc']);
        if (!empty($basecs['share_img'])) {
            $shareimg = toimage($basecs['share_img']);
        }
		$erwematype = $basecs['share_type'];
		if($basecs['guanzhu_img'])
			$erwemaimg = toimage($basecs['guanzhu_img']);
		if($basecs['guanzhu_txt'])
			$erwemaword = $basecs['guanzhu_txt'];
        $nofollow = $this->checkfans();

        include $this->template('index');


    }

    public function doMobileIndex2()
    {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
        $fansID = $_W['member']['uid'];


         $user_agent = $_SERVER['HTTP_USER_AGENT'];
         if (strpos($user_agent, 'MicroMessenger') === false) {
             message('本页面仅支持微信访问!非微信浏览器禁止浏览!', '', 'error');
         }

        //网页授权借用与非借用开始

         load()->model('account');
         $_W['account'] = account_fetch($_W['acid']);
         $cookieid = '__cookie_kuaiwei_xxcx_20160714_' . $id;
         $cookie = json_decode(base64_decode($_COOKIE[$cookieid]),true);
         if ($_W['account']['level'] != 4) {
           $from_user = $cookie['openid'];
           $avatar = $cookie['avatar'];
           $nickname = $cookie['nickname'];
         }else{
        $from_user = $_W['fans']['from_user'];
        $avatar = $_W['fans']['tag']['avatar'];
        $nickname = $_W['fans']['nickname'];
         }

         $code = $_GPC['code'];
         $type = '';
         if (empty($from_user) || empty($avatar)) {
           if (!is_array($cookie) || !isset($cookie['avatar']) || !isset($cookie['openid'])) {
             $userinfo = $this->oath_UserInfo($id, $code, $type);
             $nickname = $userinfo['nickname'];
             $avatar = $userinfo['headimgurl'];
             $from_user = $userinfo['openid'];
           } else {
             $avatar = $cookie['avatar'];
             $nickname = $cookie['nickname'];
             $from_user = $cookie['openid'];
           }
         }

        //网页授权借用与非借用结束

        //JS权限开始
        $jssdk = new JSSDK();
        $package = $jssdk->getSignPackage();
        //JS权限结束

        $page_from_user = base64_encode(authcode($from_user, 'ENCODE'));

        load()->model('mc');

        $fans = pdo_fetch("SELECT * FROM " . tablename($this->tablefans) . " WHERE from_user='" . $from_user . "'");

        if ($fans == false) {
            $insert = array(
                'fansID' => $fansID,
                'from_user' => $from_user,
                'todaynum' => 0,
                'totalnum' => 0,
                'avatar' => $avatar,
                'fname' => $nickname,
                'createtime' => time(),
            );
            $temp = pdo_insert($this->tablefans, $insert);
            $newId = pdo_insertid();

            if ($temp == false) {
                message('抱歉，刚才操作数据失败！', '', 'error');
            }
            //增加人数和浏览次数
        }




        $basecs = pdo_fetch("SELECT * FROM " . tablename($this->tableparam) . " WHERE uniacid = :uniacid ORDER BY `id` DESC", array('uniacid' => $_W['uniacid']));


        $cs = pdo_fetch("SELECT * FROM ". tablename($this->tableparam) ."  WHERE uniacid = :uniacid", array('uniacid' => $_W['uniacid']));

        $advert = pdo_fetch("SELECT * FROM ". tablename($this->tablead) ."  WHERE uniacid = :uniacid AND status = 1 order by rand()  ", array('uniacid' => $_W['uniacid']));

        $lxxx = pdo_fetchall("SELECT * FROM ". tablename($this->tableprogress) ." WHERE uniacid = :uniacid group by `type` ", array('uniacid' => $_W['uniacid']));

		$collist = pdo_fetchall("SELECT * FROM ".tablename($this->tablefield)." WHERE uniacid = :uniacid AND is_search=1", array(':uniacid' => $uniacid));
		$collistall = pdo_fetchall("SELECT * FROM ".tablename($this->tablefield)." WHERE uniacid = :uniacid", array(':uniacid' => $uniacid));
		foreach($collistall as $k=>$colrow)
		{
			$colcn_arr[] = $colrow['cnname'];
			$col_arr[] = 'col'.$colrow['id'];
		}

		

        $sharelink = $_W['siteroot'] . 'app/' . $this->createMobileUrl('index', array('id' => $id, 'from_user' => $page_from_user));
        $sharetitle = empty($basecs['share_title']) ? '欢迎使用信息查询管理系统！' : $basecs['share_title'];
        $sharedesc = empty($basecs['share_desc']) ? '欢迎使用信息查询管理系统！' : str_replace("\r\n", " ", $basecs['share_desc']);
        if (!empty($basecs['share_img'])) {
            $shareimg = toimage($basecs['share_img']);
        }
		$erwematype = $basecs['share_type'];
		if($basecs['guanzhu_img'])
			$erwemaimg = toimage($basecs['guanzhu_img']);
		if($basecs['guanzhu_txt'])
			$erwemaword = $basecs['guanzhu_txt'];
        $nofollow = $this->checkfans();

        include $this->template('index2');

    }
	public function doMobileSearch()
    {
         global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
		$search_info = $_GPC['search_info'];
		$typeid = $_GPC['typeid'];


		$collist = pdo_fetchall("SELECT * FROM ".tablename($this->tablefield)." WHERE uniacid = :uniacid", array(':uniacid' => $uniacid));
		foreach($collist as $k=>$colrow)
		{
			$colcn_arr[] = $colrow['cnname'];
			$col_arr[] = 'col'.$colrow['id'];
		}
		$colname ="col".$typeid;
		if(pdo_tableexists($this->tableinfo))
		{
			$sql ="SELECT * FROM ".tablename($this->tableinfo). " WHERE uniacid = ".$uniacid." AND ".$colname." = '".$search_info."'";
			$infolist=pdo_fetchall($sql);
			if($infolist)
			{
				foreach($infolist as $k=>$row)
				{
					foreach($col_arr as $fieldname)
					{
						$info_col[$k][$fieldname] = $row[$fieldname];
					}
				}
				$data = array('success' => 0,'record' => $info_col);
			}
			else
				$data = array('success' => -1,'msg' =>'没有查找到记录123！');
		}
		else
			$data = array('success' => -1,'msg' =>$colname.'没有查找到记录！');

		echo json_encode($data);
	}
    public function doMobileChaxun()
    {
        global $_GPC, $_W;
        $companyname = $_GPC['companyname'];
        $type = $_GPC['type'];
       
        $qyjd = pdo_fetchall("SELECT * FROM ". tablename($this->tableprogress) ." WHERE uniacid = :uniacid and companyname = '". $companyname ."' and type = '". $type ."' and status = 1 order by `sequence`", array(':uniacid' => $_W['uniacid']));


        if($qyjd == false)
        {
            $data = array(
            'success'=> 100,
            'msg' => '无相应记录',
        );
        }
        else
        {
            $arr = array();
            $i=0;
            foreach( $qyjd as $row)
            {
//                array_push($arr,$row['companyname'],$row['type'],$row['lcname'],$row['state']);
                if($row['endtime'] != 0)
                {
                    $arr[$i]['endtime'] = date('Y-m-d H:i:s',$row['endtime']);
                }
                else
                {
                    $arr[$i]['endtime'] = $row['endtime'];
                }
                $arr[$i]['type'] = $row['type'];
                $arr[$i]['lcname'] = $row['lcname'];
                $arr[$i]['state'] = $row['state'];
                $i++;
                //            $this->message(array("success" => 100, "msg" => $arr), "");
            }
            $data = array(
                'success' => 1,
                'msg' => '成功',
                'arr' => $arr,
            );
        }

        echo json_encode($data);
    }


    public  function  doWebForm()
    {
        global $_GPC, $_W;
        $set = $this->get_formset();
        if (checksubmit('submit')) {
            $data = array(
                'uniacid' => $_W['uniacid'],
                'share_type' => $_GPC['share_type'],
                'guanzhu_txt' => $_GPC['guanzhu_txt'],
                'guanzhu_img' => $_GPC['guanzhu_img'],
                'share_title' => $_GPC['share_title'],
                'share_desc' => $_GPC['share_desc'],
                'share_img' => $_GPC['share_img'],
                'btm_adtype' => $_GPC['btm_adtype'],
                'top_adtitle' => $_GPC['top_adtitle'],
                'top_adimg' => $_GPC['top_adimg'],
                'top_adurl' => $_GPC['top_adurl'],
                'btm_adtitle' => $_GPC['btm_adtitle'],
                'btm_adimg' => $_GPC['btm_adimg'],
                'btm_adurl' => $_GPC['btm_adurl'],
            );
            if (!empty($set)) {
                pdo_update($this->tableparam, $data, array('id' => $set['id']));
            } else {
                pdo_insert($this->tableparam, $data);
            }
            $this->write_cache("kuaiwei_xxcx_" . $_W['uniacid'], $data);
            message('提交参数成功！', 'refresh');
        }
        include $this->template('form');
    }


    public function get_formset() {

        global $_W, $_GPC;
        $path = "/addons/kuaiwei_xxcx";
        $filename = IA_ROOT . $path . "/data/kuaiwei_xxcx_" . $_W['uniacid'] . ".txt";


        if (is_file($filename)) {
            $content = file_get_contents($filename);
            if (empty($content)) {
                return false;
            }
            return json_decode(base64_decode($content), true);

        }
        return pdo_fetch("SELECT * FROM " . tablename($this->tableparam) . " WHERE uniacid = :uniacid limit 1", array(':uniacid' => $_W['uniacid']));

    }


    //json数据发送
    public function message($_data = '', $_msg = '')
    {
        if (!empty($_data['runcode']) && $_data['runcode'] != 2) {
            $this->setfans();
        }
        if (empty($_data)) {
            $_data = array(
                'name' => "马上就要中奖了哦",
                'runcode' => 100,
            );
        }
        if (!empty($_msg)) {
            $_data['msg'] = $_msg['msg'];
            $_data['runcode'] = $_msg['runcode'];
        }
        die(json_encode($_data));
    }


    //进度管理开始
    public function doWebmanage()
    {

        global $_GPC, $_W;

        $total = pdo_fetchcolumn("SELECT count(*) FROM " . tablename($this->tableprogress) . " WHERE uniacid = :uniacid group by `companyname`,`type` order by `id` ", array(':uniacid' => $_W['uniacid']));
        $tl = pdo_fetchall("SELECT * FROM " . tablename($this->tabletl) . " WHERE uniacid = :uniacid order by `number` ", array(':uniacid' => $_W['uniacid']));


        $lc = pdo_fetchall("SELECT * FROM " . tablename($this->tableflow) . " WHERE uniacid = :uniacid group by `type` order by `number` ", array(':uniacid' => $_W['uniacid']));



        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $pager = pagination($total, $pindex, $psize);
		$start = ($pindex - 1) * $psize;
		$limit .= " LIMIT {$start},{$psize}";

        $list = pdo_fetchall("SELECT * FROM " . tablename($this->tableprogress) . " WHERE uniacid = :uniacid group by `companyname`,`type` order by `id` ".$limit, array(':uniacid' => $_W['uniacid']));

        //load()->model('reply');
        //$sql = "uniacid = :uniacid and `module` = :module";
        //$params = array();
        //$params[':uniacid'] = $_W['uniacid'];
        //$params[':module'] = 'kuaiwei_xxcx';

        //$rules = reply_search($sql, $params);

        include $this->template('manage');
    }


//    public function doWebGettype()
//    {
//        global $_GPC, $_W;
//        $number = $_GPC['number'];
//
//
//        $lc = pdo_fetchall("SELECT * FROM " . tablename($this->tableflow) . " WHERE uniacid = :uniacid and number = '".$number."' group by `type` order by `type` ", array(':uniacid' => $_W['uniacid']));
//
//        return $lc;
//    }


    public function doWebGettype()
    {
        global $_GPC, $_W;
        $number = $_GPC['number'];


        $lc = pdo_fetchall("SELECT * FROM " . tablename($this->tableflow) . " WHERE uniacid = :uniacid and number = '".$number."' group by `type` order by `type` ", array(':uniacid' => $_W['uniacid']));

        $arr = array();
        foreach($lc as $row)
        {
            array_push($arr,$row['typename']);
        }

        $data = array(
            'arr' => $arr,
            'success' => 1,
        );
        echo json_encode($data);

    }



//    public function doWebGettype()
//    {
//        global $_GPC, $_W;
//        $number = $_GPC['number'];
//
//
//        $lc = pdo_fetchall("SELECT * FROM " . tablename($this->tableflow) . " WHERE uniacid = :uniacid and number = '".$number."' group by `type` order by `type` ", array(':uniacid' => $_W['uniacid']));
//
//        $arr = array();
//        foreach($lc as $row)
//        {
//               array_push($arr,$row['type']);
////            array_push($arr,$row['typename']);
//        }
////            $this->message(array("success" => 100, "msg" => $arr), "");
//
//        $data = array(
//            'arr' => $arr,
//            'success' => 1,
//        );
//        echo json_encode($data);
//
//    }

    public function doWebNew()
    {

        global $_GPC, $_W;
        $number = $_GPC['number'];
        $typename = $_GPC['typename'];
        $companyname = $_GPC['companyname'];

//        $this->message(array("success" => 100, "msg" => $typename), "");


        $tllc = pdo_fetchall("SELECT * FROM ". tablename($this->tableflow) ." WHERE number = '". $number ."' and typename = '". $typename ."' and status = 1 ");
        $qyjd = pdo_fetchall("SELECT * FROM ". tablename($this->tableprogress) ." WHERE companyname = '". $companyname ."' and number = '". $number ."' and typename = '". $typename ."' ");
//        $qyjd = pdo_fetch("SELECT * FROM ". tablename($this->tableprogress) ." WHERE companyname = '". $companyname ."' ");


        if($qyjd == true)
        {
            $data = array(
                'success' => 100,
                'msg' => '已存在数据',
            );
        }
        else
        {
            foreach($tllc as $row)
            {
                $insert = array(
                    'uniacid' => $_W['uniacid'],
                    'number' => $_GPC['number'],
                    'name' => $row['name'],
                    'companyname' => $_GPC['companyname'],
                    'type' => $row['type'],
                    'typename' => $row['typename'],
                    'sequence' => $row['sequence'],
                    'lcname' => $row['lcname'],
                    'state' => '未完成',
                    'status' => 1,
                );
                pdo_insert($this->tableprogress, $insert);

            }
            $data = array(
                'success' => 1,
                'msg' => '保存数据成功',
            );

        }

        echo json_encode($data);
    }


    public function doWebUpdata()
    {
        global $_GPC, $_W;

        $id = $_GPC['id'];
        $number = $_GPC['number'];
        $type = $_GPC['type'];
        $companyname = $_GPC['companyname'];
        $lc = pdo_fetchall("SELECT * FROM ". tablename($this->tableprogress) ." WHERE number = '". $number ."' and companyname = '". $companyname ."' and type = '". $type ."' and status = 1 order by `sequence`");

        $lct = pdo_fetchcolumn("SELECT COUNT(*) FROM ". tablename($this->tableprogress) ." WHERE number = '". $number ."' and companyname = '". $companyname ."' and type = '". $type ."' and state = '". 已完成 ."'  ");
//        print_r($lct);
//        exit();

//        $this->message(array("success" => 100, "msg" => $number), "");
        include $this->template('update');

    }

    public function doWebSetshow()
    {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
        $status = intval($_GPC['status']);

        if (empty($id)) {
            message('抱歉，传递的参数错误！', '', 'error');
        }
        $temp = pdo_update($this->tableprogress, array('status' => $status), array('id' => $id));

        message('状态设置成功！', referer(), 'success');
    }

    public function doWebDeleted()
    {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
        $companyname = $_GPC['companyname'];
        $type = $_GPC['type'];
        $flow = pdo_fetch("SELECT id FROM " . tablename($this->tableprogress) . " WHERE id = :id and uniacid=:uniacid", array(':id' => $id, ':uniacid' => $_W['uniacid']));

        if (empty($flow)) {
            message('抱歉，要修改的模块不存在或是已经被删除！');
        }
        if (pdo_delete($this->tableprogress, array('companyname' => $companyname,'type' => $type))) {

        }
        message('流程操作成功！', referer(), 'success');
    }



    public function JudegSortArray($array) {
        $len = count($array);

        $flag = -1;
//         判断数组可能为升序or逆序
        for ($firLoc = 0, $secLoc = 1; $secLoc < $len; $firLoc ++, $secLoc ++) {
            if ($array[$firLoc] < $array[$secLoc]) {
                $flag = 0;
                break;
            }
            if ($array[$firLoc] > $array[$secLoc]) {
                $flag = 1;
                break;
            }
        }

        if ($flag == -1) {
            return "数组均为相同元素";
            return;
        }

        $temp = $flag;
        for($i = $secLoc; $i < $len - 1; $i ++) {
            if ($flag == 0) {
                if ($array [$i] <= $array [$i + 1]) {
                    continue;
                } else {
                    $flag = 1;
                    break;
                }
            }
            if ($flag == 1) {
                if ($array [$i] >= $array [$i + 1]) {
                    continue;
                } else {
                    $flag = 0;
                    break;
                }
            }
        }
        if ($flag != $temp) {
            return "无序数组";
        } else {
            return "有序数组";
        }
    }




    public  function  doWebUpdate()
    {
        global $_GPC, $_W;



            foreach ($_GPC['idArr'] as $k => $id) {
                $id = intval($id);

                if (empty($id)) {
                    message('抱歉，传递的参数错误！', '', 'error');
                }
                $jd = pdo_fetch("SELECT * FROM ". tablename($this->tableprogress) ." WHERE id = '". $id ."' ");
                if($jd['endtime'] == 0)
                {
                    $temp = pdo_update($this->tableprogress, array('state' => '已完成','endtime' => time()), array('id' => $id));
                }
            }
            $this->webmessage('更新进度成功！', '', 0);


    }
    //进度管理结束


//模板管理开始
    public function doWebTlmanage()
    {

        global $_GPC, $_W;
//        load()->model('reply');


        $total = pdo_fetchcolumn("SELECT count(id) FROM " . tablename($this->tabletl) . " WHERE uniacid = :uniacid ", array(':uniacid' => $_W['uniacid']));
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $pager = pagination($total, $pindex, $psize);
		$start = ($pindex - 1) * $psize;
		$limit .= " LIMIT {$start},{$psize}";

		$list = pdo_fetchall("SELECT * FROM " . tablename($this->tabletl) . " WHERE uniacid = :uniacid order by `number` ".$limit, array(':uniacid' => $_W['uniacid']));

        /*load()->model('reply');
        $sql = "uniacid = :uniacid and `module` = :module";
        $params = array();
        $params[':uniacid'] = $_W['uniacid'];
        $params[':module'] = 'kuaiwei_xxcx';

        $rules = reply_search($sql, $params);*/

        $ywlx = pdo_fetchall("SELECT * FROM " . tablename($this->tablebusiness) . " WHERE status = 1 AND uniacid = :uniacid ", array(':uniacid' => $_W['uniacid']));

        include $this->template('tlmanage');
    }


    /**
     *
     */
    public function doWebTlnew()
    {

        global $_GPC, $_W;
//        $id = $_GPC['id'];
        $number =  $_GPC['number'];
        $name = $_GPC['name'];
        $type = $_GPC['type'];

        $mb = pdo_fetch("SELECT * FROM " . tablename($this->tabletl) . " WHERE name = '". $name ."'  and uniacid = :uniacid   order by `number` ", array(':uniacid' => $_W['uniacid']));

        $lxm = pdo_fetch("SELECT * FROM ". tablename($this->tablebusiness) ." WHERE id = ". $type ."  ");

        if($mb == false)
        {
            $insert = array(
                'uniacid' => $_W['uniacid'],
                'type' => $type,
                'name' => $name,
                'typename' => $lxm['typename'],
            );

            pdo_insert($this->tabletl, $insert);
            $newId = pdo_insertid();

            $temp = pdo_update($this->tabletl, array('number' => $newId), array('id' => $newId));


            $data = array(
                'success' => 1,
                'msg' => '保存数据成功',
            );
        }
        else
        {
            $data = array(
                'success' => 100,
                'msg' => "模板名称不能相同",
            );
        }


        echo json_encode($data);

    }

    public function doWebTldelete()
    {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
        $number = $_GPC['number'];
        $flow = pdo_fetch("SELECT id FROM " . tablename($this->tabletl) . " WHERE id = :id and uniacid=:uniacid", array(':id' => $id, ':uniacid' => $_W['uniacid']));
        if (empty($flow)) {
            message('抱歉，要修改的模块不存在或是已经被删除！');
        }
        if (pdo_delete($this->tabletl, array('id' => $id))) {
            pdo_delete($this->tableflow, array('number' => $number));
        }
        message('流程操作成功！', referer(), 'success');
    }
   //模板管理结束




    //流程管理开始
    public function doWebFlow_manage()
    {

        global $_GPC, $_W;
//        load()->model('reply');
        $number = $_GPC['number'];
        $name = $_GPC['name'];

//        print_r($number);
//        exit();

        $total = pdo_fetchcolumn("SELECT count(id) FROM " . tablename($this->tableflow) . " WHERE uniacid = :uniacid and number = '". $number ."' order by `type`, `sequence` DESC", array(':uniacid' => $_W['uniacid']));
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $pager = pagination($total, $pindex, $psize);
		$start = ($pindex - 1) * $psize;
		$limit .= " LIMIT {$start},{$psize}";

        /*load()->model('reply');
        $sql = "uniacid = :uniacid and `module` = :module";
        $params = array();
        $params[':uniacid'] = $_W['uniacid'];
        $params[':module'] = 'kuaiwei_xxcx';

        $rules = reply_search($sql, $params);*/

		$list = pdo_fetchall("SELECT * FROM " . tablename($this->tableflow) . " WHERE uniacid = :uniacid and number = '". $number ."' order by `type`, `sequence` DESC ".$limit, array(':uniacid' => $_W['uniacid']));

        $ywlx = pdo_fetchall("SELECT * FROM " . tablename($this->tablebusiness) . " WHERE status = 1 AND uniacid = :uniacid ", array(':uniacid' => $_W['uniacid']));

        include $this->template('flow_manage');
    }

    public function doWebLcnew()
    {

        global $_GPC, $_W;
        $number = $_GPC['number'];
        $name = $_GPC['name'];
//        $type = $_GPC['type'];
        $lcname = $_GPC['lcname'];
//       $this->message(array("success" => 100, "msg" => $number), "");
        $lc = pdo_fetchall("SELECT * FROM " . tablename($this->tableflow) . " WHERE number = '". $number ."' and lcname = '". $lcname ."' and uniacid = :uniacid ", array(':uniacid' => $_W['uniacid']));

        $tl = pdo_fetch("SELECT * FROM " . tablename($this->tabletl) . " WHERE number = '". $number ."' and uniacid = :uniacid ", array(':uniacid' => $_W['uniacid']));

        if($lc == true)
        {
            $data = array(
                'success' => 100,
                'msg' => '请勿重复添加记录',
            );
        }
        else
        {
            $insert = array(
                'uniacid' => $_W['uniacid'],
                'number' => $_GPC['number'],
                'name' => $tl['name'],
                'type' => $tl['type'],
                'typename' => $tl['typename'],
                'sequence' => $_GPC['sequence'],
                'lcname' => $_GPC['lcname'],
                'state' => 0,
                'status' => 1,
            );


            pdo_insert($this->tableflow, $insert);

            $data = array(
                'success' => 1,
                'msg' => '保存数据成功',
            );
        }


        echo json_encode($data);

    }


    public function doWebFlow_update()
    {
        global $_GPC, $_W;
        $number = $_GPC['number'];
        $type = $_GPC['type'];
        $lcname = $_GPC['lcname'];
        $lc = pdo_fetch("SELECT * FROM " . tablename($this->tableflow) . " WHERE number = '". $number ."' and type = '". $type ."' and lcname = '". $lcname ."'  AND uniacid = :uniacid ", array(':uniacid' => $_W['uniacid']));



        $operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';

        if ($operation == 'updata') {

            if($_GPC['listid']!=$lc['id'] && $lc == true)
            {
//                echo "<script>alert('已存在数据，请重新修改');</script>";
                            message('已存在数据，请重新修改');

            }
            else{
                $id = $_GPC['listid'];

                $updata = array(
//                    'type' => $type,
//                    'sequence' => $_GPC['sequence'],
                    'lcname' => $_GPC['lcname'],
                    'status' => $_GPC['status'],
                );

                $temp = pdo_update($this->tableflow, $updata, array('id' => $id,'uniacid' => $_W['uniacid']));

                message("更新流程成功", $this->createWebUrl('flow_manage',array('number'=>$number)), "success");
            }


        } else {

            $id = $_GPC['id'];

            $list = pdo_fetch("SELECT * FROM " . tablename($this->tableflow) . " WHERE uniacid = :uniacid and id = :id", array(':uniacid' => $_W['uniacid'], ':id' => $id));


            load()->model('reply');
            $sql = "uniacid = :uniacid and `module` = :module";
            $params = array();
            $params[':uniacid'] = $_W['uniacid'];
            $params[':module'] = 'kuaiwei_xxcx';

            $rules = reply_search($sql, $params);


            include $this->template('flow_update');
        }
    }


    public function doWebLcdelete()
    {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);

        $flow = pdo_fetch("SELECT id FROM " . tablename($this->tableflow) . " WHERE id = :id and uniacid=:uniacid", array(':id' => $id, ':uniacid' => $_W['uniacid']));
        if (empty($flow)) {
            message('抱歉，要修改的流程不存在或是已经被删除！');
        }
        if (pdo_delete($this->tableflow, array('id' => $id))) {

        }
        message('流程操作成功！', referer(), 'success');
    }


/*    public function doWebDeleteAll()
    {
        global $_GPC, $_W;
        foreach ($_GPC['idArr'] as $k => $rid) {
            $rid = intval($rid);
            if ($rid == 0)
                continue;
            $flow = pdo_fetch("SELECT id, module FROM " . tablename('rule') . " WHERE id = :id and uniacid=:weid", array(':id' => $rid, ':weid' => $_W['uniacid']));
            if (empty($flow)) {
                $this->webmessage('抱歉，要修改的规则不存在或是已经被删除！');
            }
            if (pdo_delete('rule', array('id' => $rid))) {
                pdo_delete('rule_keyword', array('rid' => $rid));
                //删除统计相关数据
                pdo_delete('stat_rule', array('rid' => $rid));
                pdo_delete('stat_keyword', array('rid' => $rid));
                //调用模块中的删除
                $module = WeUtility::createModule($flow['module']);
                if (method_exists($module, 'ruleDeleted')) {
                    $module->ruleDeleted($rid);
                }
            }
        }
        $this->webmessage('规则操作成功！', '', 0);
    }
*/

    public function doWebSetlcshow()
    {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
        $status = intval($_GPC['status']);

        if (empty($id)) {
            message('抱歉，传递的参数错误！', '', 'error');
        }
        $temp = pdo_update($this->tableflow, array('status' => $status), array('id' => $id, 'uniacid' => $_W['uniacid']));

        message('状态设置成功！', referer(), 'success');
    }
    //流程管理结束


    //业务类型管理开始

    public function doWebBusiness_manage()
    {
        global $_GPC, $_W;

        $total = pdo_fetchcolumn("SELECT count(id) FROM " . tablename($this->tablebusiness) . " WHERE uniacid = :uniacid ", array(':uniacid' => $_W['uniacid']));
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $pager = pagination($total, $pindex, $psize);
		$start = ($pindex - 1) * $psize;
		$limit .= " LIMIT {$start},{$psize}";

        $list = pdo_fetchall("SELECT * FROM ". tablename($this->tablebusiness) . " WHERE uniacid = :uniacid ".$limit, array(':uniacid' => $_W['uniacid']));

        include $this->template('business_manage');
    }

    public function doWebBusiness_add()
    {
        global $_GPC, $_W;

        $typename = $_GPC['typename'];

        $yw = pdo_fetchall("SELECT * FROM " . tablename($this->tablebusiness) . " WHERE typename = '". $typename ."' AND uniacid = :uniacid ", array(':uniacid' => $_W['uniacid']));


        if($yw == true)
        {
            $data = array(
                'success' => 100,
                'msg' => '请勿重复添加业务类型',
            );
        }
        else
        {
            $insert = array(
                'uniacid' => $_W['uniacid'],
                'typename' => $typename,
                'status' => 1,
            );


            pdo_insert($this->tablebusiness, $insert);

            $data = array(
                'success' => 1,
                'msg' => '保存数据成功',
            );
        }


        echo json_encode($data);
    }


    public function doWebBusiness_update()
    {
        global $_GPC, $_W;
        $typename = $_GPC['typename'];

        $yw = pdo_fetch("SELECT * FROM " . tablename($this->tablebusiness) . " WHERE typename = '". $typename ."' AND uniacid = :uniacid ", array(':uniacid' => $_W['uniacid']));


        $operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';

        if ($operation == 'updata') {

            if($yw == true)
            {
                message('已存在数据，请重新修改');
            }
            else{
                $id = $_GPC['listid'];

                $updata = array(
                    'typename' => $typename,
                    'status' => $_GPC['status'],
                );

                $temp = pdo_update($this->tablebusiness, $updata, array('id' => $id));

                message("更新业务类型成功", $this->createWebUrl('business_manage'));
            }


        } else {

            $id = $_GPC['id'];

            $list = pdo_fetch("SELECT * FROM " . tablename($this->tablebusiness) . " WHERE id = ". $id ." AND uniacid = :uniacid ", array(':uniacid' => $_W['uniacid']));


            load()->model('reply');
            $sql = "uniacid = :uniacid and `module` = :module";
            $params = array();
            $params[':uniacid'] = $_W['uniacid'];
            $params[':module'] = 'kuaiwei_xxcx';

            $rules = reply_search($sql, $params);


            include $this->template('business_update');
        }
    }


    public function doWebBusiness_del()
    {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);

        $flow = pdo_fetch("SELECT id FROM " . tablename($this->tablebusiness) . " WHERE id = :id AND uniacid = :uniacid", array(':id' => $id,':uniacid' => $_W['uniacid']));
        if (empty($flow)) {
            message('抱歉，要修改的流程不存在或是已经被删除！');
        }
        if (pdo_delete($this->tablebusiness, array('id' => $id,'uniacid' => $_W['uniacid']))) {

        }
        message('流程操作成功！', referer(), 'success');
    }


    public function doWebSetbus_show()
    {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
        $status = intval($_GPC['status']);

        if (empty($id)) {
            message('抱歉，传递的参数错误！', '', 'error');
        }
        $temp = pdo_update($this->tablebusiness, array('status' => $status), array('id' => $id,'uniacid' => $_W['uniacid']));

        message('状态设置成功！', referer(), 'success');
    }

    //业务类型管理结束





    //底部广告设置开始

    public function doWebAdmanage()
    {
        global $_GPC, $_W;


        $total = pdo_fetchcolumn("SELECT count(id) FROM " . tablename($this->tablead) . " WHERE uniacid = :uniacid ", array(':uniacid' => $_W['uniacid']));
        $pindex = max(1, intval($_GPC['page']));
        $psize = 20;
        $pager = pagination($total, $pindex, $psize);
		$start = ($pindex - 1) * $psize;
		$limit .= " LIMIT {$start},{$psize}";

        $list = pdo_fetchall("SELECT * FROM " . tablename($this->tablead) . " WHERE uniacid = :uniacid ".$limit, array(':uniacid' => $_W['uniacid']));

        include $this->template('admanage');
    }


    public function doWebAdnew(){

        global $_GPC, $_W;

        $insert = array(
            'uniacid' => $_W['uniacid'],
            'adtitle' => $_GPC['adtitle'],
            'adimg' =>$_GPC['adimg'],
            'adurl' =>$_GPC['adurl'],
            'status' =>1,
        );

        pdo_insert($this->tablead, $insert);

        $data = array(
            'success' => 1,
            'msg' => '保存数据成功',
        );

        echo json_encode($data);

    }


    public function doWebAdupdata(){

        global $_GPC, $_W;

        $operation = !empty($_GPC['op']) ? $_GPC['op'] : 'display';

        if($operation == 'updata'){

            $id = $_GPC['listid'];

            $updata = array(
                'adtitle' => $_GPC['adtitle'],
                'adimg' => $_GPC['adimg'],
                'adurl' => $_GPC['adurl'],
                'status' => $_GPC['status'],
            );


            $temp =  pdo_update($this->tablead,$updata,array('id'=>$id));

            message("更新广告成功",$this->createWebUrl('admanage'),"success");


        }else{

            $id = $_GPC['id'];

            $list = pdo_fetch("SELECT * FROM " . tablename($this->tablead) . " WHERE uniacid = :uniacid and id = :id", array(':uniacid' => $_W['uniacid'],':id' => $id));

            include $this->template('adupdata');
        }
    }



    public function doWebDeletead()
    {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
        $rule = pdo_fetch("SELECT id FROM " . tablename($this->tablead) . " WHERE id = :id and uniacid=:uniacid", array(':id' => $id, ':uniacid' => $_W['uniacid']));
        if (empty($rule)) {
            message('抱歉，要修改的规则不存在或是已经被删除！');
        }
        if (pdo_delete($this->tablead, array('id' => $id))) {

        }
        message('规则操作成功！', referer(), 'success');
    }


    public function doWebSetadshow()
    {
        global $_GPC, $_W;
        $id = intval($_GPC['id']);
        $status = intval($_GPC['status']);

        if (empty($id)) {
            message('抱歉，传递的参数错误！', '', 'error');
        }
        $temp = pdo_update($this->tablead, array('status' => $status), array('id' => $id));
        message('状态设置成功！', referer(), 'success');
    }

    //底部广告设置结束

	public function doWebImport_manage()
    {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
		$collist = pdo_fetchall("SELECT * FROM ".tablename($this->tablefield)." WHERE uniacid = :uniacid", array(':uniacid' => $uniacid));
		foreach($collist as $k=>$colrow)
		{
			$colcn_arr[] = $colrow['cnname'];
			$col_arr[] = 'col'.$colrow['id'];
		}
		if(pdo_tableexists($this->tableinfo))
		{
			$infocount= pdo_fetchall("SELECT id FROM ".tablename($this->tableinfo)." WHERE uniacid = :uniacid", array(':uniacid' => $uniacid));
			$page = intval($_GPC['page']);
			$total = count($infocount);
			$number = 20;
			$url = $_W['siteroot']."web/index.php?i=".$_W['uniacid']."&c=site&a=entry&m=kuaiwei_xxcx&do=import_manage&page={page}";
			$pindex = max(1, $page);
			$pager = pagination($total, $pindex, $number);
			$startnum = ($pindex - 1) * $number;
			
			$rownum = ($pindex-1)*20;

			$infolist = pdo_fetchall("SELECT * FROM ".tablename($this->tableinfo)." WHERE uniacid = :uniacid ORDER BY `id` DESC LIMIT ".$startnum.",".$number, array(':uniacid' => $uniacid));
			
			
		}
        include $this->template('import_manage');
    }
	public function doWebImport_edit()
    {
         global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
		$id = intval($_GPC['id']);
		$data_arr = array();

		$collist = pdo_fetchall("SELECT * FROM ".tablename($this->tablefield)." WHERE uniacid = :uniacid", array(':uniacid' => $uniacid));
		foreach($collist as $k=>$colrow)
		{
			$data_arr['col'.$colrow['id']] = $_GPC['col'.$colrow['id']];
		}
		if(pdo_tableexists($this->tableinfo))
		{
			if($id==0)
			{
				$data_arr['uniacid'] = $uniacid;
				$res = pdo_insert($this->tableinfo, $data_arr);
				if($res>0)
					$data = array('success' => 0,'msg' =>'添加成功！');
				else
					$data = array('success' => 0,'msg' =>'添加失败！');
			}
			else
			{
				pdo_update($this->tableinfo , $data_arr, array('uniacid' =>$uniacid, 'id' => $id));
				$data = array('success' => 0,'msg' =>'修改成功！');
			}
		}
		else
		{
			$data = array('success' => -1,'msg' =>'信息表不存在！请先初始化信息表');
		}

		echo json_encode($data);
	}
	public function doWebEdit_info()
    {
         global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
		$id = intval($_GPC['id']);

		$collist = pdo_fetchall("SELECT * FROM ".tablename($this->tablefield)." WHERE uniacid = :uniacid", array(':uniacid' => $uniacid));
		foreach($collist as $k=>$colrow)
		{
			$colcn_arr[] = $colrow['cnname'];
			$col_arr[] = 'col'.$colrow['id'];
		}
		
		$inforow=pdo_fetch("SELECT * FROM ".tablename($this->tableinfo). " WHERE uniacid = :uniacid AND id = :id",array(':uniacid' =>$uniacid, ':id' => $id));
		if($inforow)
		{
			
			foreach($col_arr as $col_enname)
			{
				$info_col[] = $inforow[$col_enname];
			}
			$data = array('success' => 0,'record' => $info_col);
		}
		else
			$data = array('success' => -1,'msg' =>'没有查找到记录！');

		echo json_encode($data);
	}
	public function doWebImport_del()
    {
        global $_GPC, $_W;
        $uniacid = $_W['uniacid'];
		$id = intval($_GPC['id']);

		$infodel=pdo_delete($this->tableinfo,array('uniacid' =>$uniacid, 'id' => $id));
		if($infodel>0)
			$data = array('success' => 0,'msg' =>'删除成功！');
		else
			$data = array('success' => -1,'msg' =>'删除失败！');

		echo json_encode($data);
	}
	public function doWebImport_table()
    {
        global $_GPC, $_W;
		$uniacid = $_W['uniacid'];
		
		if($_W['ispost']) //checksubmit('submit')
		{
			if (!empty($_GPC['flagtype'])) {
				foreach ($_GPC['flagtype'] as $index => $flagtype_tmp) {
					if (empty($flagtype_tmp)) {
						continue;
					}
					$cnname=trim($_GPC['cnname'.$flagtype_tmp]);
					if(empty($cnname))
						continue;
					$type_len = explode(',',$_GPC['typename'.$flagtype_tmp]);
					$insert = array(
				    'uniacid' => $_W['uniacid'],				
				    'cnname' => $cnname,
				    'typename' => $type_len[0],
					'length' => $type_len[1],
					'is_import' => intval($_GPC['is_import'.$flagtype_tmp]),
					'is_search' => intval($_GPC['is_search'.$flagtype_tmp]),
					);
					pdo_update($this->tablefield, $insert, array('id' => $flagtype_tmp));
				}
				
				$col_id = implode(',',$_GPC['flagtype']);

				$nofieldlist = pdo_fetchall("SELECT * FROM ". tablename($this->tablefield)." WHERE uniacid = :uniacid and id NOT IN (".$col_id.")",array(':uniacid' => $uniacid));
				
				$result=pdo_delete($this->tablefield,'id NOT IN ('.$col_id.') AND uniacid = '.$uniacid);
				
			}
			else
			{
				pdo_delete($this->tablefield, array('uniacid' => $uniacid));
				pdo_query("DROP TABLE IF EXISTS ". tablename($this->tableinfo).";");
			}
			
			if (!empty($_GPC['flagtype_new'])&&count($_GPC['flagtype_new'])>=1) {
				foreach ($_GPC['flagtype_new'] as $index => $flagtype_new) 
				{
					$cnname=trim($_GPC['cnname'.$flagtype_new]);
					if(empty($cnname))
						continue;
					$type_len = explode(',',$_GPC['typename'.$flagtype_new]);
					$insert = array(
						'uniacid' => $_W['uniacid'],				
						'cnname' => $cnname,
						'typename' => $type_len[0],
						'length' => $type_len[1],
						'is_import' => $_GPC['is_import'.$flagtype_new],
						'is_search' => $_GPC['is_search'.$flagtype_new],
					);			
					pdo_insert($this->tablefield, $insert);

				}
			}
			$newfieldlist = pdo_fetchall("SELECT * FROM ". tablename($this->tablefield)." WHERE uniacid = :uniacid",array(':uniacid' => $uniacid));
			if(pdo_tableexists($this->tableinfo))
			{
				//message("111");
				//添加列
				foreach($newfieldlist as $row)
				{
					$field="col".$row['id'];
					$type_len=$row['typename'];
					if($row['length']>0)
						$type_len.="(".$row['length'].")";
					if(!pdo_fieldexists($this->tableinfo, $field)) {
						pdo_query("ALTER TABLE ". tablename($this->tableinfo)." ADD `".$field."` ".$type_len.";");
					}
				}
				//删除列
				//$rescolumns=pdo_query("SHOW COLUMNS FROM ims_kuaiwei_xxcx_info");
				//$rescolumns=pdo_query("SELECT * FROM ims_kuaiwei_xxcx_info limit 0");
				/*$rescolumns = pdo_fetchallfields(tablename($this->tableinfo));

				foreach($rescolumns as $k=>$colname)
				{
					if($k!=0)
						$colname_str.=",";
					$colname_str.=str_replace("col","",$colname);
				}
				$nofieldlist = pdo_fetchall("SELECT * FROM ". tablename($this->tablefield)." WHERE uniacid = :uniacid and id NOT IN (".$colname_str.")",array(':uniacid' => $uniacid));
				*/
				foreach($nofieldlist as $row)
				{
					
					$field="col".$row['id'];
					if(pdo_fieldexists($this->tableinfo, $field)) {
						pdo_query("ALTER TABLE ". tablename($this->tableinfo)." DROP COLUMN `".$field."`;");
					}
				}				
			}
			else
			{
				$sql="CREATE TABLE IF NOT EXISTS ". tablename($this->tableinfo)." (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `uniacid` int(11) DEFAULT '0' COMMENT '公众号id',";
				foreach($newfieldlist as $row)
				{
					$type_len=$row['typename'];
					if($row['length']>0)
						$type_len.="(".$row['length'].")";
					$sql.="`col".$row['id']."` ".$type_len.",";
				}
				$sql.="PRIMARY KEY (`id`),
				  KEY `indx_uniacid` (`uniacid`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
				$result = pdo_query($sql);
			}

		}

		$typelist = pdo_fetchall("SELECT * FROM " . tablename($this->tabletype));
		$fieldlist = pdo_fetchall("SELECT * FROM ". tablename($this->tablefield)." WHERE uniacid = :uniacid",array(':uniacid' => $uniacid));

        include $this->template('import_table');
    }

	public function doWebImport_csv()
	{
		global $_GPC, $_W;
		//$idarr = array();
		$uniacid = $_W['uniacid'];
		$filename = $_GPC['csv'];
		//message($_W['username'].' '.$_W['uid'],'','');
		if(!pdo_tableexists($this->tableinfo))
		{
			message('信息表不存在，请先创建信息表！',$this->createWebUrl('import_table'),'error');
		}
		if($_W['ispost'])
		{
			$filename = $_FILES['csv']['tmp_name'];  

			if(empty($filename))   
			{  
				//上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值
				message('请选择要导入的CSV文件或者文件超过php环境的大小限制！','','');
				exit;   
			} 
			//message($filename,'','error');
			$handle = fopen($filename, 'r');
			$result = input_csv($handle); //解析csv
			$len_result = count($result);
			if($len_result==0){
				message('导入的CSV文件没有数据！','','error');
				exit;
			}
			//message('123！','','error');
			$tableheader= pdo_fetchall("SELECT * FROM ". tablename($this->tablefield)." WHERE uniacid = :uniacid AND is_import=1 ORDER BY id",array(':uniacid' => $uniacid));
			if(!$tableheader)
			{
				message('请先进行初始化表设置并选择好要导入的列名！','','error');
				exit;
			}
			if(count($tableheader) > count($result[0]))
			{
				message('CSV文件和数据库要导入的字段数不符！请检查CSV文件或者重新设置导入字段！','','error');
				exit;
			}
			
			$tmp_num = 0;
			foreach($tableheader as $k=>$fieldrow)
			{
				$tmp_num = count($index);
				foreach($result[0] as $i=>$resrow)
				{
					if($fieldrow['cnname']==trim(iconv('gb2312','utf-8//IGNORE', $resrow)))
					{
						$index[] = $i;
						$col_arr[] = 'col'.$fieldrow['id'];
						break;
					}
				}
				if(($tmp_num+1)!=count($index))
				{
					message('在CSV文件中找不到要导入的列名：'.$fieldrow['cnname'].'，请检查！','','error');
					exit;
				}
			}

			$index_count = count($index);
			for ($i = 1; $i < $len_result; $i++) { //循环获取各字段值
				
				$data_values .= "('$uniacid'";
				for($j=0;$j <$index_count;$j++)
				{
					$tmp_value = iconv('gb2312', 'utf-8//IGNORE', replacestr($result[$i][$index[$j]]));
					$data_values .=",'$tmp_value'";
				}
				$data_values .= "),";
			}
			$data_values = substr($data_values,0,-1); //去掉最后一个逗号
			fclose($handle); //关闭指针
			$query = pdo_query("insert ignore into ".tablename($this->tableinfo)." (uniacid,". implode(",",$col_arr) .") values $data_values");
			//$query = mysql_query("insert into student (name,sex,age) values $data_values");//批量插入数据表中
			if($query){
				message('导入成功！',referer(),'success');
				//echo '导入成功！';
			}else{
				message('导入失败！',referer(),'error');
				//echo '导入失败！';
			}
		}
		
		include $this->template('import_csv');
	}

    public function webmessage($error, $url = '', $errno = -1)
    {
        $data = array();
        $data['errno'] = $errno;
        if (!empty($url)) {
            $data['url'] = $url;
        }
        $data['error'] = $error;
        echo json_encode($data);
        exit;
    }
}
