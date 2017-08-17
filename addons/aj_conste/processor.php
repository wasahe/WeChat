<?php
/**
 * 星座书模块处理程序
 *
 * @author 超级无语
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class Aj_consteModuleProcessor extends WeModuleProcessor {
	public function respond() {
		global $_W;
		$rid = $this->rule;
		$openid = $_W['openid'];
		$row = pdo_fetch("SELECT * FROM " . tablename('aj_conste') . " WHERE `rid`=:rid LIMIT 1", array(':rid' => $rid));
		if( empty($row) ){
			return $this->respText( '游戏已被删除！' );
		}
		$news = array();
		$news[] = array(
			'title'	=>	$row['title'],
			'description'	=>	$row['description'],
			'picurl'	=>	tomedia($row['thumb']),
			'url'	=>	$this->createMobileUrl('index', array('id'=>$rid)),
		);
		return $this->respNews( $news );
		//这里定义此模块进行消息处理时的具体过程, 请查看微擎文档来编写你的代码
	}
}