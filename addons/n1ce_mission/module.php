<?php
/**
 * 新田源码 bbs.xtec.cc模块微站定义
 *
 */
defined('IN_IA') or exit('Access Denied');

class N1ce_missionModule extends WeModule {
	public $tablename = 'n1ce_mission_reply';

    public function fieldsFormDisplay($rid = 0) {
        global $_W;
        load()->func('tpl');
		$borrow = $this->module['config']['borrow'];
        if (!empty($rid)) {
            $reply = pdo_fetch("SELECT * FROM " . tablename($this->tablename) . " WHERE rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
        }
        if ($reply) {
            $now = TIMESTAMP;
			$data = json_decode(str_replace('&quot;', "'", $reply['data']), true);
			$size = getimagesize(toimage($reply['bg']));
			$size = array($size[0]/2,$size[1]/2);
			$titles = unserialize($reply['stitle']);
			$thumbs = unserialize($reply['sthumb']);
			$sdesc = unserialize($reply['sdesc']);
			$surl = unserialize($reply['surl']);
			foreach ($titles as $key => $value) {
				if (empty($value)) continue;
				$slist[] = array('stitle'=>$value,'sdesc'=>$sdesc[$key],'sthumb'=>$thumbs[$key],'surl'=>$surl[$key]);
			}
            
        }else{
			$now = TIMESTAMP;
            $reply = array(
                "starttime" => $now,
                "endtime" => strtotime(date("Y-m-d H:i", $now + 7 * 24 * 3600)),
			);
		}

        include $this->template('form');
    }

    public function fieldsFormValidate($rid = 0) {
        //规则编辑保存时，要进行的数据验证，返回空串表示验证无误，返回其他字符串将呈现为错误提示。这里 $rid 为对应的规则编号，新增时为 0
        return '';
    }

    public function fieldsFormSubmit($rid) {
        global $_GPC, $_W;
        load()->func('tpl');
        $id = intval($_GPC['reply_id']);
        $insert = array(
            'rid' => $rid,
			'uniacid'=> $_W['uniacid'],
            'title' => $_GPC ['title'],
            'bg' => $_GPC ['bg'],
            'data' => htmlspecialchars_decode($_GPC ['data']),
            'first_info' => htmlspecialchars_decode(str_replace('&quot;','&#039;',$_GPC ['first_info']),ENT_QUOTES),
            'miss_wait' =>htmlspecialchars_decode(str_replace('&quot;','&#039;',$_GPC ['miss_wait']),ENT_QUOTES),
            'stitle' => serialize($_GPC ['stitle']),
            'sthumb' => serialize($_GPC ['sthumb']),
            'sdesc' => serialize($_GPC ['sdesc']),
            'miss_start' => htmlspecialchars_decode(str_replace('&quot;','&#039;',$_GPC ['miss_start']),ENT_QUOTES),
            'miss_end' => htmlspecialchars_decode(str_replace('&quot;','&#039;',$_GPC ['miss_end']),ENT_QUOTES),
            'miss_sub' => htmlspecialchars_decode(str_replace('&quot;','&#039;',$_GPC ['miss_sub']),ENT_QUOTES),
            'miss_back' => htmlspecialchars_decode(str_replace('&quot;','&#039;',$_GPC ['miss_back']),ENT_QUOTES),
			'miss_resub' => htmlspecialchars_decode(str_replace('&quot;','&#039;',$_GPC ['miss_resub']),ENT_QUOTES),
			'miss_finish' => htmlspecialchars_decode(str_replace('&quot;','&#039;',$_GPC ['miss_finish']),ENT_QUOTES),
			'miss_youzan' => htmlspecialchars_decode(str_replace('&quot;','&#039;',$_GPC ['miss_youzan']),ENT_QUOTES),
            'starttime' => strtotime($_GPC['datelimit']['start']),
//            'endtime' => strtotime($_GPC['datelimit']['end']) + 86400 - 1,
            'endtime' => strtotime($_GPC['datelimit']['end']),
            'surl' => serialize($_GPC ['surl']),
            'miss_temp' => $_GPC ['miss_temp'],
			'xzlx' => $_GPC['xzlx'],
			'fans_limit' => $_GPC['fans_limit'],
			'area' => $_GPC['area'],
			'sex' => $_GPC['sex'],
			'iptype' => $_GPC['iptype'],
			'posttype' => $_GPC['posttype'],
            'miss_name' => $_GPC ['miss_name'],
            'miss_num' => $_GPC ['miss_num'],
            'miss_font' => $_GPC ['miss_font'],
            'createtime' =>TIMESTAMP,
        );
		//var_dump($insert);die();
        if (empty($id)) {
            $id = pdo_insert($this->tablename, $insert);
        } else {
            unset($insert['createtime']);
            pdo_update($this->tablename, $insert, array('id' => $id));
        }
        return true;
    }

    public function ruleDeleted($rid) {
        pdo_delete('n1ce_mission_reply', array('rid' => $rid));
		pdo_delete('n1ce_mission_fans', array('rid' => $rid));
		pdo_delete('n1ce_mission_prize', array('rid' => $rid));
    }

	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		//点击模块设置时将调用此方法呈现模块设置页面，$settings 为模块设置参数, 结构为数组。这个参数系统针对不同公众账号独立保存。
		//在此呈现页面中自行处理post请求并保存设置参数（通过使用$this->saveSettings()来实现）
		if(checksubmit()) {
			//字段验证, 并获得正确的数据$dat
			$cfg = array(
				'borrow' => $_GPC['borrow'],
				'appid' => trim($_GPC['appid']),
				'appsecret' => trim($_GPC['appsecret']),
				'pay_mchid' => $_GPC['pay_mchid'],
				'pay_signkey' => $_GPC['pay_signkey'],
				'act_name' => $_GPC['act_name'],
				'wishing' => $_GPC['wishing'],
				'remark' => $_GPC['remark'],
				'limittime' => $_GPC['limittime'],
				'suburl' => $_GPC['suburl'],
				'mopenid' => $_GPC['mopenid'],
				'send_name' => $_GPC['send_name'],
				'yzappId' => $_GPC['yzappId'],
				'yzappSecret' => $_GPC['yzappSecret'],
            );
			load()->func('file');
			$dir_url='../attachment/n1ce_mission/cert_2/'.$_W['uniacid']."/";
			mkdirs($dir_url);
			$cfg['rootca']=$_GPC['rootca2'];
			$cfg['apiclient_cert']=$_GPC['apiclient_cert2'];
			$cfg['apiclient_key']=$_GPC['apiclient_key2'];
			if ($_FILES["rootca"]["name"]){
				if(file_exists($dir_url.$settings["rootca"]))@unlink ($dir_url.$settings["rootca"]);
				$cfg['rootca']=TIMESTAMP.".pem";
				move_uploaded_file($_FILES["rootca"]["tmp_name"],$dir_url.$cfg['rootca']);
			}
			if ($_FILES["apiclient_cert"]["name"]){
				if(file_exists($dir_url.$settings["apiclient_cert"]))@unlink ($dir_url.$settings["apiclient_cert"]);
				$cfg['apiclient_cert']="cert".TIMESTAMP.".pem";
				move_uploaded_file($_FILES["apiclient_cert"]["tmp_name"],$dir_url.$cfg['apiclient_cert']);
			}
			if ($_FILES["apiclient_key"]["name"]){
				if(file_exists($dir_url.$settings["apiclient_key"]))@unlink ($dir_url.$settings["apiclient_key"]);
				$cfg['apiclient_key']="key".TIMESTAMP.".pem";
				move_uploaded_file($_FILES["apiclient_key"]["tmp_name"],$dir_url.$cfg['apiclient_key']);
			}
            if ($this->saveSettings($cfg))message('保存成功', 'refresh');
		}
		//这里来展示设置项表单
		include $this->template('setting');
	}

}