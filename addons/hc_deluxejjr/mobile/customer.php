<?php
$follow = pdo_fetch('select follow from ' . tablename('mc_mapping_fans') . ' where openid = \'' . $openid . '\' and uniacid = ' . $uniacid);
if (empty($follow) || ($follow['follow'] == 0)) 
{
	message('你想知道怎么加入么?', $rule['gzurl'], 'sucessr');
	exit();
}
if (empty($_COOKIE[$shareid])) 
{
}
else 
{
	$profile = pdo_fetchcolumn('SELECT id FROM ' . tablename('hc_deluxejjr_member') . ' WHERE  uniacid = :uniacid  AND openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
	if (!empty($profile)) 
	{
	}
	else 
	{
		echo '<script>' . "\r\n\t\t\t\t\t" . 'if(confirm(\'您是否要注册?\')){' . "\r\n\t\t\t\t\t\t" . 'window.location.href = \'' . $this->createMobileUrl('register', array('op' => 'display')) . '\';' . "\r\n\t\t\t\t\t" . '}else{' . "\r\n\t\t\t\t\t\t" . 'window.location.href = \'' . $this->createMobileUrl('yuyue') . '\';' . "\r\n\t\t\t\t\t" . '}' . "\r\n\t\t\t\t\t\t\r\n\t\t\t\t" . '</script>';
	}
}
$profile = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_member') . ' WHERE  uniacid = :uniacid  AND openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
if (intval($profile['id']) && ($profile['status'] == 0)) 
{
	include $this->template('forbidden');
	exit();
}
if (empty($profile)) 
{
	message('请先注册', $this->createMobileUrl('register'), 'error');
	exit();
}
if ($op == 'member') 
{
	$cid = intval($_GPC['cid']);
	if ($cid) 
	{
		$cusmatlog = pdo_fetch('select * from ' . tablename('hc_deluxejjr_cusmatlog') . ' where uniacid = ' . $uniacid . ' and cid = ' . $cid);
		$type = explode(',', $cusmatlog['type']);
		$buyreason = explode(',', $cusmatlog['buyreason']);
		include $this->template('cusmat');
		exit();
	}
	else 
	{
		message('非法访问！');
	}
}
$loupans = pdo_fetchall('SELECT id, title, tel, location_c, location_a, phone FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid', array(':uniacid' => $uniacid));
$pan = array();
foreach ($loupans as $k => $v ) 
{
	$pan[$v['id']] = $v['title'];
	$tel[$v['id']] = $v['tel'];
	$location_c[$v['id']] = $v['location_c'];
	$location_a[$v['id']] = $v['location_a'];
	$phone[$v['id']] = $v['phone'];
}
$status = $this->ProcessStatus();
$statuslenth = count($status) - 1;
$cfg = $this->module['config'];
$statusprotect = count($status) - 2;
$protectdate = intval($cfg['protectdate']);
if ($protectdate) 
{
	$protectdate = TIMESTAMP - (3600 * 24 * $protectdate);
	$protectwhere = ' AND (updatetime > ' . $protectdate . ' OR status > ' . $statusprotect . ' )';
}
if ($op == 'display') 
{
	$indates = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_customerstatus') . ' WHERE `uniacid` = :uniacid order by displayorder asc', array(':uniacid' => $uniacid));
	$indate = array();
	foreach ($indates as $key => $i ) 
	{
		$indate[$key] = intval($i['indate']);
	}
	$refreshcus = 'isvalidcus' . $uniacid;
	if (1) 
	{
		$isvalidcuss = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE isvalid = 1 and `uniacid` = :uniacid AND `openid` =:openid ' . $protectwhere, array(':uniacid' => $uniacid, ':openid' => $openid));
		foreach ($isvalidcuss as $i ) 
		{
			$usetime = time() - $i['indatetime'];
			$days = ceil($usetime / 86400);
			$indays = $indate[$i['status']] - $days;
			if ($indays < 0) 
			{
				pdo_update('hc_deluxejjr_customer', array('isvalid' => 0), array('id' => $i['id']));
				$cuspool = array('uniacid' => $uniacid, 'cusid' => $i['id'], 'mobile' => $i['mobile'], 'realname' => $i['realname'], 'loupan' => $i['loupan'], 'status' => $i['status'], 'cuspri' => $i['cuspri'], 'content' => $i['content'], 'createtime' => time());
				pdo_insert('hc_deluxejjr_cuspool', $cuspool);
			}
		}
		setcookie($refreshcus, $refreshcus, time() + 300);
	}
	$pindex = max(1, intval($_GPC['page']));
	$psize = 15;
	$total = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE `uniacid` = :uniacid AND `openid` =:openid ORDER BY id DESC ', array(':uniacid' => $uniacid, ':openid' => $openid));
	$pager = pagination1($total, $pindex, $psize);
	$customer = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE `uniacid` = :uniacid AND `openid` =:openid ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize, array(':uniacid' => $uniacid, ':openid' => $openid));
	$lists = pdo_fetchall('SELECT status, isvalid FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE uniacid = ' . $uniacid . ' and openid = \'' . $openid . '\'');
	foreach ($status as $key => $s ) 
	{
		$list[$key] = 0;
	}
	$s1 = 0;
	$s2 = 0;
	$s3 = 0;
	foreach ($lists as $key => $l ) 
	{
		if ($l['status'] == 1) 
		{
			++$s1;
		}
		if ($l['status'] == 2) 
		{
			++$s2;
		}
		if (3 <= $l['status']) 
		{
			++$s3;
		}
	}
	include $this->template('customer');
	exit();
}
if ($op == 'sort') 
{
	$keyword = trim($_GPC['keyword']);
	if (empty($keyword)) 
	{
		echo 0;
		exit();
	}
	$customer = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE (realname like \'%' . $keyword . '%\' or mobile like \'%' . $keyword . '%\') and `uniacid` = :uniacid AND `openid` =:openid ' . $protectwhere . ' ORDER BY id DESC', array(':uniacid' => $uniacid, ':openid' => $openid));
	if (empty($customer)) 
	{
		echo 0;
		exit();
	}
	else 
	{
		$indates = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_customerstatus') . ' WHERE `uniacid` = :uniacid order by displayorder asc', array(':uniacid' => $uniacid));
		$indate = array();
		foreach ($indates as $key => $i ) 
		{
			$indate[$key] = intval($i['indate']);
		}
		foreach ($customer as &$c ) 
		{
			$c['url'] = $this->createMobileurl('customer', array('op' => 'detail', 'cid' => $c['id']));
			$c['tjurl'] = $this->createMobileurl('recommend', array('lid' => $c['loupan']));
			$c['location_c'] = $location_c[$c['loupan']];
			$c['location_a'] = $location_a[$c['loupan']];
			$c['indate'] = haha($indate[$c['status']], $c['indatetime']);
			$c['status'] = $status[$c['status']];
			$c['mobile'] = ((empty($c['isvalid']) ? hoho($c['mobile']) : $c['mobile']));
		}
		echo json_encode($customer);
		exit();
	}
}
if ($op == 'detail') 
{
	$cid = $_GPC['cid'];
	if (intval($cid)) 
	{
		$opp = $_GPC['opp'];
		if ($opp == 'cuspool') 
		{
			$cid = pdo_fetchcolumn('SELECT cusid FROM ' . tablename('hc_deluxejjr_cuspool') . ' WHERE id =:cid LIMIT 1', array(':cid' => $cid));
		}
		$customer = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE id=:cid LIMIT 1', array(':cid' => $cid));
		if ($customer['cid']) 
		{
			$assistant = pdo_fetch('select mobile, realname from ' . tablename('hc_deluxejjr_assistant') . ' where id = ' . $customer['cid']);
			$tel[$customer['loupan']] = $assistant['mobile'];
		}
	}
	else 
	{
		message('你想知道怎么加入么?', $rule['gzurl'], 'sucessr');
		exit();
	}
	$time_node = '';
	$time_detail = '';
	$i = 0;
	while ($i <= $statuslenth) 
	{
		if ($i <= $customer['status']) 
		{
			if ($i == $statuslenth) 
			{
				$time_node .= '<i class="time-node"></i>';
			}
			else 
			{
				$time_node .= '<i class="time-node"></i><span class="time-line"></span>';
			}
			$time_detail .= '<li class="fn-clear"><div class="time-detail"><p class="time-event">' . $status[$i] . '</p></div></li>';
		}
		else 
		{
			if ($i == $statuslenth) 
			{
				$time_node .= '<i class="time-node-no"></i>';
			}
			else 
			{
				$time_node .= '<i class="time-node-no"></i><span class="time-line-no"></span>';
			}
			$time_detail .= '<li class="fn-clear"><div class="time-detail-no"><p class="time-event">' . $status[$i] . '</p></div></li>';
		}
		++$i;
	}
	include $this->template('customershow');
	exit();
}
if ($op == 'remarkdetail') 
{
	$contents = pdo_fetchall('select id, status, content, createtime from ' . tablename('hc_deluxejjr_credit') . ' where uniacid = ' . $uniacid . ' and cid = ' . intval($_GPC['cid'] . ' and lid = ' . intval($_GPC['lid'])));
	if (!empty($contents)) 
	{
		$creditids = '';
		foreach ($contents as $c ) 
		{
			$creditids = $c['id'] . ',' . $creditids;
		}
		$creditids = '(' . trim($creditids, ',') . ')';
		$creditlogs = pdo_fetchall('select status, content, createtime from ' . tablename('hc_deluxejjr_creditlog') . ' where uniacid = ' . $uniacid . ' and creditid in ' . $creditids . ' order by createtime asc');
		$creditlog = array();
		$i = 0;
		while ($i < $statuslenth) 
		{
			foreach ($creditlogs as $key => $c ) 
			{
				if ($i == $c['status']) 
				{
					$creditlog[$c['status']][count($creditlog[$c['status']])]['content'] = $c['content'];
					$creditlog[$c['status']][count($creditlog[$c['status']]) - 1]['createtime'] = $c['createtime'];
					unset($creditlogs[$key]);
				}
			}
			++$i;
		}
	}
	include $this->template('remark_detail');
	exit();
}
?>