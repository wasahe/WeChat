<?php
if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');
global $_GPC,$_W;
$rid= intval($_GPC['rid']);
$prizeid = intval($_GPC['prizeid']);
$data= $_GPC['data'];
if(empty($rid)){
    message('抱歉，传递的参数错误！','', 'error');              
}
$reply = pdo_fetch("SELECT * FROM " . tablename('stonefish_scenesign_reply') . " WHERE rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
$exchange = pdo_fetch("select * FROM ".tablename("stonefish_scenesign_exchange")." where rid = :rid", array(':rid' => $rid));
if(empty($reply)){
    message('抱歉，活动不存在！','', 'error');              
}
$isfansname = explode(',',$exchange['isfansname']);
if($data=='mobileverify'){
    $statustitle='手机验证名单';	
	$list = pdo_fetchall("SELECT * FROM ".tablename('stonefish_scenesign_mobileverify')."  WHERE rid = :rid and uniacid=:uniacid ORDER BY id DESC" , array(':rid' => $rid,':uniacid'=>$_W['uniacid']));
    if($reply['yanzheng']==3){
		$tableheader = array('ID', '姓名', '手机号', '验证时间', '添加时间', '福利倍数', '状态');
	}else{
		$tableheader = array('ID', '姓名', '手机号', '验证时间', '添加时间', '状态');
	}
	$html = "\xEF\xBB\xBF";
    foreach ($tableheader as $value) {
	    $html .= $value . "\t ,";
    }
    $html .= "\n";
    foreach ($list as $value) {
	    $html .= $value['id'] . "\t ,";
	    $html .= $value['realname'] . "\t ,";	
		$html .= $value['mobile'] . "\t ,";
		if($value['verifytime']){
			$html .= date('Y-m-d H:i:s', $value['verifytime']) . "\t ,";
		}else{
			$html .= "未使用\t ,";
		}
		$html .= date('Y-m-d H:i:s', $value['createtime']) . "\t ,";
		if($reply['yanzheng']==3){
			$html .= $value['welfare'] . "\t ,";
		}
		if($value['status']==0){
			$html .= "不可用\n";
		}elseif($value['status']==1){
			$html .= "未审核\n";
		}else{
			$html .= "已审核\n";
		}		
    }
}elseif($data=='fansdata'){
    $zhongjiang = $_GPC['zhongjiang'];
	if(!empty($zhongjiang)){        
	    if($zhongjiang == 1){
		    $statustitle='未中奖用户';
			$where.=' and zhongjiang=0';
	    }elseif($zhongjiang == 2){
		    $statustitle='中奖用户';
			$where.=' and zhongjiang>=1';
		}elseif($zhongjiang == 3){
		    $statustitle='虚拟中奖';
			$where.=' and zhongjiang>=1 and xuni=1';
		}
    }else{
        $statustitle='全部用户';
    }
	$list = pdo_fetchall("SELECT * FROM ".tablename('stonefish_scenesign_fans')."  WHERE rid = :rid and uniacid=:uniacid ".$where." ORDER BY id DESC" , array(':rid' => $rid,':uniacid'=>$_W['uniacid']));
	$tableheader = array('ID', '状态');
	$ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
	$k = 0;
	if($exchange['group'])$tableheader[]='分组';
	foreach ($ziduan as $ziduans) {
		if($exchange['is'.$ziduans]){
			$tableheader[]=$isfansname[$k];
		}
		$k++;
	}
	$tableheader[]='签到者微信码';
	$tableheader[]='签到时间';
    $html = "\xEF\xBB\xBF";
    foreach ($tableheader as $value) {
	    $html .= $value . "\t ,";
    }
    $html .= "\n";
    foreach ($list as $value) {
	    $value['status']='';
		if($value['zhongjiang']==0){
		    $value['status']='未中奖';
	    }elseif($value['zhongjiang']==1){
		    $value['status']='未兑奖';
		}elseif($value['zhongjiang']==2){
		    $value['status']='已兑奖';
		}
		if($value['xuni']==0){
		    $value['status'].='/真实';
		}else{
		    $value['status'].='/虚拟';
		}
		$value['status'].='/虚拟';
		$html .= $value['id'] . "\t ,";	    
	    $html .= $value['status'] . "\t ,";
		if($exchange['group']){
			$bumen1 = pdo_fetchcolumn("select gname from ".tablename('stonefish_scenesign_group')." where id = :id", array(':id' => $value['pcate']));
			$bumen2 = pdo_fetchcolumn("select gname from ".tablename('stonefish_scenesign_group')." where id = :id", array(':id' => $value['ccate']));
			if($bumen2)$bumen2='-'.$bumen2;
			$html .= $bumen1.$bumen2."\t ,";
		}
	    foreach ($ziduan as $ziduans) {
			if($exchange['is'.$ziduans]){
				if($ziduans=='gender'){
					if($value[$ziduans]==0){
						$html .= "保密\t ,";
					}elseif($value[$ziduans]==1){
						$html .= "男\t ,";
					}elseif($value[$ziduans]==2){
						$html .= "女\t ,";
					}
				}else{
					$html .= $value[$ziduans] . "\t ,";	
				}
			}
		}
	    $html .= $value['from_user'] . "\t ,";
	    $html .= date('Y-m-d H:i:s', $value['createtime']) . "\n";
    }
}elseif($data=='prizedata'){
    $params = '';
	//导出标题
	if ($_GPC['tickettype']>=1) {
        if($_GPC['tickettype']==1){
		    $statustitle = '后台兑奖统计';
		    $params = " and tickettype=1";
	    }
	    if($_GPC['tickettype']==2){
		    $statustitle = '店员兑奖统计';
		    $params = " and tickettype=2";
	    }
	    if($value['tickettype']==4){
			$value['tickettype']='密码兑奖';
		}
		if($value['tickettype']==5){
			$value['tickettype']='奖品密码兑奖';
		}
    }else{
		$statustitle = '全部兑奖统计';
	}
	if(!empty($prizeid)){
        $statustitle .= pdo_fetchcolumn("SELECT prizerating FROM ".tablename('stonefish_scenesign_prize')." WHERE id=:prizeid", array(':prizeid' => $_GPC['prizeid']));
		$params .= " and prizeid='".$prizeid."'";
    }
	if($_GPC['zhongjiang']==1){
		$statustitle .= '未兑换';
		$params.=' and zhongjiang=1';
	}elseif($_GPC['zhongjiang']==2){
		$statustitle .= '已兑换';
		$params.=' and zhongjiang>=2';
	}else{
		$params.=' and zhongjiang>=1';
	}
	if($_GPC['xuni']==1){
		$statustitle .= '虚拟';
		$params.=' and xuni=1';
	}
	if($_GPC['xuni']=='2'){
		$statustitle .= '真实';
		$params.=' and xuni=0';
	}
	//导出标题    
    $list = pdo_fetchall("SELECT * FROM ".tablename('stonefish_scenesign_fansaward')." WHERE rid = :rid and uniacid=:uniacid ".$params." ORDER BY id DESC", array(':rid' => $rid,':uniacid'=>$_W['uniacid']));
    $tableheader = array('ID', '奖项', '奖品名称', '状态');
	if($exchange['group'])$tableheader[]='分组';
    $ziduan = array('realname','mobile','qq','email','address','gender','telephone','idcard','company','occupation','position');
	$k=0;
	foreach ($ziduan as $ziduans) {
		if($exchange['is'.$ziduans]){
			$tableheader[]=$isfansname[$k];
		}
		$k++;
	}
	$tableheader[]='中奖者微信码';
	$tableheader[]='中奖时间';
	$tableheader[]='兑奖时间';
	$tableheader[]='兑奖类型';
	$tableheader[]='兑奖人';
	$html = "\xEF\xBB\xBF";
    foreach ($tableheader as $value) {
	    $html .= $value . "\t ,";
    }
    $html .= "\n";
    foreach ($list as $value) {
		$value['status']='';
		if($value['zhongjiang']==0){
		    $value['status']='未中奖';
	    }elseif($value['zhongjiang']==1){
		    $value['status']='未兑奖';
		}elseif($value['zhongjiang']==2){
		    $value['status']='已兑奖';
		}
		if($value['xuni']==0){
		    $value['status'].='/真实';
		}else{
		    $value['status'].='/虚拟';
		}
		$value['status'].='/虚拟';
		if($value['tickettype']==1){
			$value['tickettype']='后台兑奖';
		}
		if($value['tickettype']==2){
			$value['tickettype']='店员兑奖';
			$value['ticketname'] = pdo_fetchcolumn("SELECT name FROM " . tablename('activity_coupon_password') . " WHERE id = :id", array(':id' => $value['ticketid']));
		}		
		if($value['tickettype']==4){
			$value['tickettype']='密码兑奖';
		}
		if($value['tickettype']==5){
			$value['tickettype']='奖品密码兑奖';
		}
		$prize = pdo_fetch("select prizerating,prizename from " . tablename('stonefish_scenesign_prize') . "  where id = :id", array(':id' =>$value['prizeid']));
		$value['prizerating'] =$prize['prizerating'];
		$value['prizename'] =$prize['prizename'];
		
		$html .= $value['id'] . "\t ,";
	    $html .= $value['prizerating'] . "\t ,";	
	    $html .= $value['prizename'] . "\t ,";	
	    $html .= $value['status'] . "\t ,";
		if($exchange['group']){
			$bumen1 = pdo_fetchcolumn("select gname from ".tablename('stonefish_scenesign_group')." where id = :id", array(':id' => $value['pcate']));
			$bumen2 = pdo_fetchcolumn("select gname from ".tablename('stonefish_scenesign_group')." where id = :id", array(':id' => $value['ccate']));
			if($bumen2)$bumen2='-'.$bumen2;
			$html .= $bumen1.$bumen2."\t ,";
		}
	    $fans = pdo_fetch("select realname,mobile,qq,email,address,gender,telephone,idcard,company,occupation,position from " . tablename('stonefish_scenesign_fans') . "  where from_user = :from_user and rid = :rid and uniacid = :uniacid", array(':from_user' =>$value['from_user'],':rid' =>$rid,':uniacid' =>$_W['uniacid']));
		foreach ($ziduan as $ziduans) {
			if($exchange['is'.$ziduans]){
				if($ziduans=='gender'){
					if($fans[$ziduans]==0){
						$html .= "保密\t ,";
					}elseif($fans[$ziduans]==1){
						$html .= "男\t ,";	
					}elseif($fans[$ziduans]==2){
						$html .= "女\t ,";
					}
				}else{
					$html .= $fans[$ziduans] . "\t ,";	
				}				
			}
		}	
	    $html .= $value['from_user'] . "\t ,";
	    $html .= date('Y-m-d H:i:s', $value['createtime']) . "\t ,";
	    $html .= ($value['consumetime'] == 0 ? '未使用' : date('Y-m-d H:i',$value['consumetime'])) . "\t ,";
		$html .= $value['tickettype'] . "\t ,";
		$html .= $value['ticketname']  . "\n";
    }
}
header("Content-type:text/csv");
header("Content-Disposition:attachment; filename=".$statustitle.$award."数据_".$rid.".csv");
echo $html;
exit();