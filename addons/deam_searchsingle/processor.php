<?php
/**
 * 寻找单身狗模块微站定义
 *
 * @author deam
 * @url http://bbs.we7.cc/
 * @desc 
 */
defined('IN_IA') or exit('Access Denied');

class Deam_searchsingleModuleProcessor extends WeModuleProcessor {
	public function respond() {
		$content = $this->message['content'];
		//这里定义此模块进行消息处理时的具体过程, 请查看微擎文档来编写你的代码
		$openid = $this->message['from'];
		$rid = $this->rule;
		global $_W;
		if($rid) {
			$arr = pdo_fetch("SELECT * FROM " . tablename('deam_searchsingle_actset') . " WHERE rule_id = :rule_id", array(':rule_id' => $rid));
			if(empty($arr)){
				return $this->respText('该关键词未关联活动或关联的活动被删除！');
			}
			if(empty($arr['reply_title'])){
				return $this->respText('图文标题必填！');
			}
			$ismember = pdo_fetch("SELECT * FROM " . tablename('deam_searchsingle_guanzhu') . " WHERE openid = :openid AND aid=:aid", array(':openid' => $openid,':aid'=>$arr['id']));//检查是否已经回复关键词/触发导航
			if(empty($ismember)){//没有触发过本关键词
				$insertarr['uniacid']= $_W['uniacid'];
				$insertarr['aid']= $arr['id'];
				$insertarr['openid']= $openid;
				$insertarr['gztime']= TIMESTAMP;
				$id = pdo_insert('deam_searchsingle_guanzhu', $insertarr);
			}
			$news = array(
				'title' => $arr['reply_title'],
				'description' =>$arr['reply_description'],
				'picurl' =>$arr['reply_img'],
				'url' => $_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&id=".$arr['id']."&do=index&m=deam_searchsingle"."&openid=".$openid,
			);
			return $this->respNews($news);
		}
	}
}