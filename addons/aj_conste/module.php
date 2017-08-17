<?php
/**
 * 星座书配对模块定义
 *
 * @author 超级无语
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class Aj_consteModule extends WeModule {
	public $tablename = 'aj_conste';
	public function fieldsFormDisplay($rid = 0) {
		global $_W;
		load()->func('tpl');
		if (!empty($rid)) {
            $reply = pdo_fetch("SELECT * FROM " . tablename($this->tablename) . " WHERE rid = :rid ORDER BY `rid` DESC", array(':rid' => $rid));
        }
        if (!$reply) {
        	$reply = array(
        		"title" => "【星座书】十二星座性格解析",
        		"thumb" => "../addons/aj_conste/style/images/game.png",
        		"description" => "快来看看Ta是你的幸运情侣星座吗？",
        		"copyright"   => "©星座书",
        		"copyrighturl" => "http://www.baidu.com/",
        		"qrcode" => "../addons/aj_conste/style/images/qrcode.png",
        		"instruction" => "扫描二维码关注,回复“我的星座”，解密你的星座命格",
        		"bgpic" => "../addons/aj_conste/style/images/bg.jpg",
        		"success_url" => "http://www.baidu.com",
        		);
        }
        include $this->template('rule');
		//要嵌入规则编辑页的自定义内容，这里 $rid 为对应的规则编号，新增时为 0
	}

	public function fieldsFormValidate($rid = 0) {
		//规则编辑保存时，要进行的数据验证，返回空串表示验证无误，返回其他字符串将呈现为错误提示。这里 $rid 为对应的规则编号，新增时为 0
		return '';
	}

	public function fieldsFormSubmit($rid) {
		global $_GPC,$_W;
		$uniacid = $_W['uniacid'];
		load()-> func('tpl');
		$content = pdo_fetch( 'SELECT * FROM '.tablename('rule_keyword').' WHERE uniacid =:uniacid AND rid = :rid',array(':uniacid' => $uniacid,':rid' =>$rid));
		$insert = array(
			'rid' => $rid,
			'uniacid' => $_W['uniacid'],
			'content' => $content['content'],//从其它表中获得该字段
			'title' => $_GPC['title'],
			'thumb' => $_GPC['thumb'],
			'description' => $_GPC['description'],
			'copyright' => $_GPC['copyright'],
			'copyrighturl' => $_GPC['copyrighturl'],
			'qrcode' => $_GPC['qrcode'],
			'instruction' => $_GPC['instruction'],
			'bgpic' => $_GPC['bgpic'],
			'success_url' => $_GPC['success_url'],
		);
		$res = pdo_fetch( 'SELECT * FROM '.tablename($this->tablename).' WHERE uniacid = :uniacid AND rid = :rid' , array(':uniacid' => $uniacid,':rid'=>$rid));
		if( $res ){
			pdo_update($this->tablename, $insert, array('rid'=>$rid));
		} else {
			$insert['rid']	=	$rid;
			$insert['uniacid']	=	$uniacid;

			pdo_insert($this->tablename, $insert);
		}

		message('游戏信息保存成功！正转向游戏管理！', $this->createWebUrl('manage', array('id' => $rid)));
		
		//规则验证无误保存入库时执行，这里应该进行自定义字段的保存。这里 $rid 为对应的规则编号
	}

	public function ruleDeleted($rid) {
		pdo_delete('aj_conste', array('rid' => $rid));
		//删除规则时调用，这里 $rid 为对应的规则编号
	}

	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		//点击模块设置时将调用此方法呈现模块设置页面，$settings 为模块设置参数, 结构为数组。这个参数系统针对不同公众账号独立保存。
		//在此呈现页面中自行处理post请求并保存设置参数（通过使用$this->saveSettings()来实现）
		if(checksubmit()) {
			//字段验证, 并获得正确的数据$dat
			$this->saveSettings($dat);
		}
		//这里来展示设置项表单
		include $this->template('setting');
	}

}