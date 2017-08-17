<?php


/**


 * 红包管理模块定义


 *


 * @author tyzm


 * @url http://bbs.we7.cc/


 */


defined('IN_IA') or exit('Access Denied');





class Tyzm_redpackModule extends WeModule {


	public function fieldsFormDisplay($rid = 0) {

        $this->authorization();
		//要嵌入规则编辑页的自定义内容，这里 $rid 为对应的规则编号，新增时为 0


	}





	public function fieldsFormValidate($rid = 0) {


		//规则编辑保存时，要进行的数据验证，返回空串表示验证无误，返回其他字符串将呈现为错误提示。这里 $rid 为对应的规则编号，新增时为 0


		return '';


	}





	public function fieldsFormSubmit($rid) {


		//规则验证无误保存入库时执行，这里应该进行自定义字段的保存。这里 $rid 为对应的规则编号


	}





	public function ruleDeleted($rid) {


		//删除规则时调用，这里 $rid 为对应的规则编号


	}





	public function settingsDisplay($settings) {


		global $_W, $_GPC;


		//点击模块设置时将调用此方法呈现模块设置页面，$settings 为模块设置参数, 结构为数组。这个参数系统针对不同公众账号独立保存。


		//在此呈现页面中自行处理post请求并保存设置参数（通过使用$this->saveSettings()来实现）


		load()->func('tpl');


		if(checksubmit()) {


			//字段验证, 并获得正确的数据$dat
			load()->func('file');
			$certroot=MODULE_ROOT.'/redpackpem1104/'.$_W['uniacid'].'/'.$_GPC['certkey'];
			if($this->module['config']['certkey']!=$_GPC['certkey'] && !empty($this->module['config']['certkey'])){
				$oldcertroot=MODULE_ROOT.'/redpackpem1104/'.$_W['uniacid'].'/'.$this->module['config']['certkey'];
				//if(is_dir($oldcertroot) && !rename($oldcertroot,$certroot)){
				//    message('修改证书秘钥错误，请联系管理员！');
				//}
				rename($oldcertroot,$certroot);
			}
            $r = mkdirs($certroot);
			if(!empty($_GPC['apiclient_cert'])) {
                $ret = file_put_contents($certroot.'/apiclient_cert.pem', trim($_GPC['apiclient_cert']));
                $r = $r && $ret;
            }
            if(!empty($_GPC['apiclient_key'])) {
                $ret = file_put_contents($certroot.'/apiclient_key.pem', trim($_GPC['apiclient_key']));
                $r = $r && $ret;
            }
			if(!$r) {
                message('证书保存失败, 请保证 /addons/tyzm_redpack/redpackpem1104/ 目录可写');
            }
			$dat = array( 
                'isfollow'=>$_GPC['isfollow'],
				'mebilemanage' => $_GPC['mebilemanage'],
				'senduser' => $_GPC['senduser'],
				'certkey' => $_GPC['certkey'],
				'FEE' => intval($_GPC['FEE']),
				'followqrcode' => $_GPC['followqrcode'],
				'gettype' => $_GPC['gettype'],
				'pluspelp' => $_GPC['pluspelp'],
				'template' => $_GPC['template'],
				'matching' => $_GPC['matching'],
				'jelimit' => $_GPC['jelimit'],
				'baiduapikey' => $_GPC['baiduapikey'],
				
			);


			$this->saveSettings($dat);
			message('保存成功', 'refresh');
		}


		//这里来展示设置项表单


		include $this->template('setting');


	}





}