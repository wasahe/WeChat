<?php
/**
 * 寻找单身狗模块微站定义
 *
 * @author deam
 * @url http://bbs.we7.cc/
 * @desc 游戏首页
 */
defined('IN_IA') or exit('Access Denied');
global $_GPC,$_W;
$id = intval($_GPC['id']);
$uniacid = intval($_W['uniacid']);
$openid = $_W['openid'];
load()->model('mc');
$userinfo = $this->deamMembers($id);
$nowtime = TIMESTAMP;
$arr = pdo_fetch("SELECT * FROM " . tablename('deam_searchsingle_actset') . " WHERE id = :id AND uniacid = :uniacid AND is_delete=0", array(':id' => $id,':uniacid' => $uniacid));//获取活动相关数据
if($_GPC['openid']){
	$openid = addslashes($_GPC['openid']);
	setcookie('deam_openid', $openid, time()+31536000);
	header("Location: ".$this->createMobileUrl('index',array('id'=>$id)));
	exit;
}
$is_subscribe = intval($arr['is_subscribe']);
if($is_subscribe){//开启必须关注模式
	if($_W['account']['level'] == '4'){//认证服务号
		$subscribe_model = '2';
	}else{
		$subscribe_model = '1';
	}
	$isGuanzhu = checkIsSubscribe($subscribe_model);
}
$need_info = iunserializer($arr['need_info']);
$need_username = @in_array('username',$need_info);
$need_telphone = @in_array('telphone',$need_info);
if($need_username && empty($userinfo['realname'])){
	$item['joinOptions']['username'] = 2;
}
if($need_telphone && empty($userinfo['telphone'])){
	$item['joinOptions']['mobile'] = 3;
}
$package = $_W['account']['jssdkconfig'];
if($_W['isajax']){
	$operation = $_GPC['op'];
	if($operation == 'checkgamedata'){
		//判断当前时间是否在游戏期间内
		$starttime = $arr['starttime'];
		$endtime = $arr['endtime'];
		if($nowtime < $starttime){
			show_json(0,'游戏还未开始');
		}elseif($nowtime > $endtime){
			show_json(0,'游戏已结束！');
		}else{
			if($item['joinOptions']['username']=='2'||$item['joinOptions']['mobile']=='3'){
				show_json(202,'未注册');
			}else{
				show_json(1,'已注册并登陆');
			}
		}
	}elseif($operation == 'register'){
		$telphone = trim($_GPC['telphone']);
		$realname = trim($_GPC['realname']);
		$result = pdo_update('deam_searchsingle_members',array('realname'=>$realname,'telphone'=>$telphone),array('id'=>$userinfo['id']));
		$result && show_json(1,'注册成功并自动登陆');
		show_json(0,'未知错误，请联系管理员');
	}elseif($operation == 'submitscore'){
		$score = intval($_GPC['score']);
		$useTimeArr = explode(',', $_GPC['seconds']);
		foreach ($useTimeArr as $key => $value) {
			$value = intval($value);
			$value = empty($value) ? '1' : $value;
			$useAllTime += $value;
		}

		$updateArr = array(
			'maxscore'	=>	$score,
			'alltime'	=>	$useAllTime
		);
		$isReg = pdo_fetch("SELECT * FROM ".tablename("deam_searchsingle_members")." WHERE uniacid = :uniacid AND openid=:openid AND act_id=:act_id",array(':uniacid'=>$uniacid,':openid'=>$openid,':act_id'=>$id));
		$isReg['alltime'] = empty($isReg['alltime']) ? '10000' : $isReg['alltime'];
		if($score == $isReg['maxscore'] && $useAllTime >= $isReg['alltime']){
			show_json(1,'耗时比记录高，不保存');
		}
		if($score<$isReg['maxscore']){
			show_json(1,'分数未达到最高分，不保存');
		}
		$result = pdo_update('deam_searchsingle_members',$updateArr,array('openid'=>$openid,'uniacid'=>$uniacid,'act_id'=>$id));
		!empty($result) && show_json(1,'保存分数成功！');
	}elseif($operation == 'getrank'){
		$myrank = pdo_fetch("SELECT (SELECT COUNT(*)  FROM ".tablename('deam_searchsingle_members')." WHERE uniacid=:uniacid AND act_id=:act_id) as total_count,(SELECT COUNT(*) +1 FROM ".tablename('deam_searchsingle_members')." b WHERE (b.maxscore > a.maxscore AND b.uniacid= :uniacid AND b.act_id=:act_id) OR (b.maxscore = a.maxscore AND b.alltime < a.alltime AND b.uniacid= :uniacid AND b.act_id=:act_id)) as rank,a.* FROM ".tablename('deam_searchsingle_members')." a WHERE a.openid=:openid AND a.uniacid = :uniacid AND a.act_id=:act_id",array(':openid'=>$openid,':uniacid'=>$uniacid,':act_id'=>$id));
		$ranklist = pdo_fetchall("SELECT * FROM ".tablename('deam_searchsingle_members')." WHERE uniacid = :uniacid AND act_id=:act_id ORDER BY `maxscore` DESC,`alltime` ASC,id DESC LIMIT 0,50",array(':uniacid'=>$uniacid,':act_id'=>$id));
		if(empty($myrank['total_count'])){
			$myrank['total_count'] = pdo_fetchcolumn("SELECT COUNT(*)  FROM ".tablename('deam_searchsingle_members')." WHERE uniacid=:uniacid AND act_id=:act_id",array(':uniacid'=>$uniacid,':act_id'=>$id));
		}
		$myrank['maxscore'] = empty($myrank['maxscore']) ? '0' : $myrank['maxscore'];
		$myrank['rank'] = empty($myrank['rank']) ? $myrank['total_count']+1 : $myrank['rank'];
		$myrank['percent'] = $myrank['rank'] / $myrank['total_count'] * 100;
		foreach($ranklist as $rankid=>$rankitem){
			$ranklist[$rankid]['telphone'] = substr_replace($rankitem['telphone'],'****',3,4);;
		}
		show_json(1,array('user_result'=>$myrank,'rank_list'=>$ranklist));
	}
	
	
}else{
	if(empty($arr)){
		message("该游戏不存在");
		die();
	}
	if(empty($userinfo['avatar'])){//非认证服务号或没有服务号借权
		$deamUser = trim($_COOKIE['deamuser']);
		if(!empty($deamUser)){
			$memberinfo = pdo_fetch("SELECT * FROM ".tablename("deam_searchsingle_members")." WHERE uniacid = :uniacid AND telphone=:telphone AND act_id=:act_id",array(':uniacid'=>$uniacid,':telphone'=>$deamUser,':act_id'=>$id));
		}
	}else{//认证服务号
		$memberinfo = pdo_fetch("SELECT * FROM ".tablename("deam_searchsingle_members")." WHERE uniacid = :uniacid AND openid=:openid AND act_id=:act_id",array(':uniacid'=>$uniacid,':openid'=>$openid,':act_id'=>$id));
	}
	$maxScore = intval($memberinfo['maxscore']);
	$usetime = intval($memberinfo['alltime']);
	$memberinfo['avatar'] = empty($memberinfo['avatar']) ? '../addons/deam_searchsingle/style/images/getheadimg.jpg' : $memberinfo['avatar'];
	
	
	$shareTitle = str_replace("{SCORE}",$maxScore,$arr['share_title']);
	$shareTitle = str_replace("{USETIME}",$usetime,$shareTitle);
	include $this->template('index');
	
}
?>