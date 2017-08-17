<?php
/**
 * 微招聘模块处理程序
 *
 * @author qq-3354988381
 * @url http://v2.addons.we7.cc/web/index.php?c=store&a=author&uid=91001
 * @公众号 http://v2.addons.we7.cc/web/index.php?c=store&a=author&uid=91001
 * @微信产品QQ群 490186557
 * 
 */
defined('IN_IA') or exit('Access Denied');

class Q_3354988381_rencaiModuleProcessor extends WeModuleProcessor {
	
	public $tablename = 'q_3354988381_rencai_reply';
	
	public function respond() {
		global $_W, $_GPC;
		$rid = $this->rule;		
		$row = pdo_fetch("SELECT * FROM ".tablename($this->tablename)." WHERE acid = :acid AND rid = :rid", array(':acid' => $_W['uniacid'], ':rid' => $rid));
		if($row){
			$url = $this->createMobileUrl('UserCompanyProfile', array('uid' => $row['id']));
		}else{
			$url = $this->createMobileUrl('Index');
		}
		return $this->respNews(
			array(
					'title' => $row['title'],
					'description' => $row['description'],
					'picurl'      => $row['avatar'],
					'url' => $this->createMobileUrl('Index')
			)
		);
	}

}