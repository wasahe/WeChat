<?php
/**
 * 【点沐】拼图红包模块处理程序
 *
 * @author deam
 * @url http://bbs.heirui.cn/
 */
defined('IN_IA') or exit('Access Denied');

class Deam_puzzleredpackModuleProcessor extends WeModuleProcessor {
	public function respond() {
		$content = $this->message['content'];
		$openid = $this->message['from'];
		$rid = $this->rule;
		global $_W;
		
		if($rid) {
			$arr = pdo_fetch("SELECT * FROM " . tablename('deam_puzzleredpack_report') . " WHERE rid = :rid", array(':rid' => $rid));
			//return $this->respText($arr['url']);
			$ismember = pdo_fetch("SELECT * FROM " . tablename('deam_puzzleredpack_guanzhu') . " WHERE openid = :openid", array(':openid' => $openid));//检查是否已经回复关键词/触发导航
			if(empty($ismember)){//没有触发过本关键词
				$insertarr['uniacid']= $_W['uniacid'];
				$insertarr['openid']= $openid;
				$insertarr['gztime']= time();
				$id = pdo_insert('deam_puzzleredpack_guanzhu', $insertarr);
			}
			$news = array(
				'title' => $arr['title'],
				'description' =>'',
				'picurl' =>$arr['image'],
				'url' => $_W['siteroot']."app/index.php?i=".$_W['uniacid']."&c=entry&id=".$arr['actid']."&do=puzzle&m=deam_puzzleredpack"."&openid=".$openid,
			);
			return $this->respNews($news);
		}
	}
}