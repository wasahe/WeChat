<?php
/**
 * 寻找单身狗模块微站定义
 *
 * @author deam
 * @url http://bbs.we7.cc/
 * @desc 游戏管理
 */
defined('IN_IA') or exit('Access Denied');
global $_W,$_GPC;
$uniacid = $_W['uniacid'];
$operation = empty($_GPC['op']) ? 'display' : $_GPC['op'];
if($operation == 'display'){
	$act_id = $_GPC['id'];
	$pindex = max(1, intval($_GPC['page']));

	$psize = 30;

	$condition = ' AND act_id='.$act_id;
	$condition .= empty($_GPC['username']) ? '' : " AND (( realname LIKE '%".trim($_GPC['username'])."%' ) OR ( nickname LIKE '%".trim($_GPC['username'])."%' ) OR ( telphone LIKE '%".trim($_GPC['username'])."%' ) OR ( openid LIKE '%".trim($_GPC['username'])."%' ))";
	
	$list = pdo_fetchall("SELECT * FROM " . tablename('deam_searchsingle_members') . " WHERE uniacid = '{$_W['uniacid']}' $condition ORDER BY maxscore DESC,alltime ASC LIMIT " . ($pindex - 1) * $psize . ',' . $psize);
	
	$total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename('deam_searchsingle_members') . " WHERE uniacid = '{$_W['uniacid']}' $condition");

	$pager = pagination($total, $pindex, $psize);
	
}elseif($operation=='delete'){
	$act_id = intval($_GPC['id']);
	$memberid = intval($_GPC['memberid']);
	$result = pdo_delete('deam_searchsingle_members',array('id'=>$memberid,'act_id'=>$act_id));
	$result && message('删除成功！', $this->createWebUrl('gamedata', array('op' => 'display','id'=>$act_id)), 'success');
}elseif($operation=='update'){
	$act_id = intval($_GPC['id']);
	$memberid = intval($_GPC['memberid']);
	$highscore = intval($_GPC['highscore']);
	$alltime = intval($_GPC['alltime']);
	$result = pdo_update('deam_searchsingle_members',array('maxscore'=>$highscore,'alltime'=>$alltime),array('id'=>$memberid,'act_id'=>$act_id));
	$result && message('分数修改成功！', $this->createWebUrl('gamedata', array('op' => 'display','id'=>$act_id)), 'success');
}elseif($operation=='export'){
	$act_id = intval($_GPC['id']);
	$html = "\xEF\xBB\xBF";
	$filter = array(
		'name' => '昵称',
		'openid' => 'openid',
		'username' => '姓名',
		'telphone' => '电话',
		'score' => '分数',
		'time' =>'使用秒数'
	);
	foreach ($filter as $title) {
		$html .= $title . "\t,";
	}
	$html .= "\n";
	$list = pdo_fetchall("SELECT * FROM ".tablename('deam_searchsingle_members')." WHERE 1 ".$condition." AND uniacid=:uniacid AND act_id=:act_id ORDER BY maxscore DESC,alltime ASC",array(':uniacid'=>$uniacid,':act_id'=>$act_id));
	foreach ($list as $item) {
		$html .= $item['nickname']. "\t, ";
		$html .= $item['openid']. "\t, ";
		$html .= $item['realname']. "\t, ";
		$html .= $item['telphone']. "\t, ";
		$html .= $item['maxscore']. "\t, ";
		$html .= $item['alltime']. "\t, ";
		$html .= "\n";
	}
	header("Content-type:text/csv");
	header("Content-Disposition:attachment; filename=寻找单身狗数据 By deam.csv");
	echo $html;
	exit();
}
include $this->template('systerm/gamedata');
?>