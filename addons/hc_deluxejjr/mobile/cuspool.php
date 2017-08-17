<?php
$follow = pdo_fetch('select follow, uid from ' . tablename('mc_mapping_fans') . ' where openid = \'' . $openid . '\' and uniacid = ' . $uniacid);
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
$loupans = pdo_fetchall('SELECT id, title, tel, location_c, location_a FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid ', array(':uniacid' => $uniacid));
$pan = array();
foreach ($loupans as $k => $v ) 
{
	$pan[$v['id']] = $v['title'];
	$tel[$v['id']] = $v['tel'];
	$location_c[$v['id']] = $v['location_c'];
	$location_a[$v['id']] = $v['location_a'];
}
$status = $this->ProcessStatus();
$idpris = pdo_fetchall('select id, cuspri from ' . tablename('hc_deluxejjr_identity') . ' where uniacid = ' . $uniacid . ' order by cuspri asc');
$idpri = array();
$identity = array();
foreach ($idpris as $key => $i ) 
{
	$idpri[$i['cuspri']] = $key;
	$identity[$i['id']] = $i['cuspri'];
}
if ($op == 'display') 
{
	$indates = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_customerstatus') . ' WHERE `uniacid` = :uniacid order by displayorder asc', array(':uniacid' => $uniacid));
	$indate = array();
	foreach ($indates as $key => $i ) 
	{
		$indate[$key] = intval($i['indate']);
	}
	$cuspri = '';
	$pindex = max(1, intval($_GPC['page']));
	$psize = 15;
	$total = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('hc_deluxejjr_cuspool') . ' WHERE `uniacid` = :uniacid ' . $cuspri . ' ORDER BY id DESC ', array(':uniacid' => $uniacid));
	$pager = pagination1($total, $pindex, $psize);
	$cuspool = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_cuspool') . ' WHERE `uniacid` = :uniacid ' . $cuspri . ' ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize, array(':uniacid' => $uniacid));
	$lists = pdo_fetchall('SELECT count(id) as sum, status FROM ' . tablename('hc_deluxejjr_cuspool') . ' WHERE uniacid = ' . $uniacid . $cuspri . ' group by status');
	foreach ($status as $key => $s ) 
	{
		$list[$key] = 0;
	}
	foreach ($lists as $l ) 
	{
		$list[$l['status']] = $l['sum'];
	}
	$type = explode(',', $cusmatlog['type']);
	$buyreason = explode(',', $cusmatlog['buyreason']);
	include $this->template('cuspool');
	exit();
}
if ($op == 'sort') 
{
	$area_location_p = trim($_GPC['area_location_p']);
	$area_location_c = trim($_GPC['area_location_c']);
	$area_location_a = trim($_GPC['area_location_a']);
	$type = intval($_GPC['type']);
	$cpf = intval($_GPC['cpf']);
	$buyreason = intval($_GPC['buyreason']);
	$livecondition = intval($_GPC['livecondition']);
	$homeformation = intval($_GPC['homeformation']);
	$wantprice1 = intval($_GPC['wantprice1']);
	$wantprice2 = intval($_GPC['wantprice2']);
	$allprice1 = intval($_GPC['allprice1']);
	$allprice2 = intval($_GPC['allprice2']);
	$keyword = trim($_GPC['keyword']);
	$condition = '';
	if ($area_location_p !== '请选择省份..') 
	{
		$condition .= ' and area_location_p = \'' . $area_location_p . '\'';
	}
	if ($area_location_c !== '请选择市/县..') 
	{
		$condition .= ' and area_location_c = \'' . $area_location_c . '\'';
	}
	if ($area_location_a !== '请选择区..') 
	{
		$condition .= ' and area_location_a = \'' . $area_location_a . '\'';
	}
	if (!empty($type)) 
	{
		$condition .= ' and type like \'%' . $type . '%\'';
	}
	if (!empty($cpf)) 
	{
		$condition .= ' and cpf = \'' . $cpf . '\'';
	}
	if (!empty($buyreason)) 
	{
		$condition .= ' and buyreason like \'%' . $buyreason . '%\'';
	}
	if (!empty($livecondition)) 
	{
		$condition .= ' and livecondition = \'' . $livecondition . '\'';
	}
	if (!empty($homeformation)) 
	{
		$condition .= ' and homeformation = \'' . $homeformation . '\'';
	}
	if (!empty($wantprice1)) 
	{
		$condition .= ' and wantprice >= \'' . $wantprice1 . '\'';
	}
	if (!empty($wantprice2)) 
	{
		$condition .= ' and wantprice <= \'' . $wantprice2 . '\'';
	}
	if (!empty($allprice1)) 
	{
		$condition .= ' and allprice >= \'' . $allprice1 . '\'';
	}
	if (!empty($allprice2)) 
	{
		$condition .= ' and allprice <= \'' . $allprice2 . '\'';
	}
	if (!empty($condition)) 
	{
		$cusmatlogs = pdo_fetchall('SELECT cid FROM ' . tablename('hc_deluxejjr_cusmatlog') . ' WHERE `uniacid` = :uniacid ' . $condition . ' ORDER BY id DESC', array(':uniacid' => $uniacid));
	}
	$cuspri = '';
	if (!empty($cusmatlogs)) 
	{
		$cids = '';
		foreach ($cusmatlogs as $c ) 
		{
			$cids .= $c['cid'] . ',';
		}
		$cids = '(' . trim($cids, ',') . ')';
		$cuspool = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_cuspool') . ' WHERE cusid in ' . $cids . ' and realname like \'%' . $keyword . '%\' and `uniacid` = :uniacid ' . $cuspri . ' ORDER BY id DESC', array(':uniacid' => $uniacid));
	}
	else if (empty($condition)) 
	{
		if (!empty($keyword)) 
		{
			$cuspool = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_cuspool') . ' WHERE realname like \'%' . $keyword . '%\' and `uniacid` = :uniacid ' . $cuspri . ' ORDER BY id DESC', array(':uniacid' => $uniacid));
		}
		else 
		{
			echo -1;
			exit();
		}
	}
	if (empty($cuspool)) 
	{
		echo 0;
		exit();
	}
	else 
	{
		foreach ($cuspool as &$c ) 
		{
			$c['url'] = $this->createMobileurl('customer', array('op' => 'detail', 'opp' => 'cuspool', 'cid' => $c['id']));
			$c['tjurl'] = $this->createMobileurl('recommend', array('lid' => $c['loupan']));
			$c['location_c'] = $location_c[$c['loupan']];
			$c['location_a'] = $location_a[$c['loupan']];
			$c['status'] = $status[$c['status']];
			$c['mobile'] = hoho1($c['mobile']);
		}
		echo json_encode($cuspool);
		exit();
	}
}
if ($op == 'exchange') 
{
	if (!empty($follow['uid'])) 
	{
		$mc = mc_fetch($follow['uid'], array('credit1'));
		if ($rule['cpcredit'] <= $mc['credit1']) 
		{
			$cpid = intval($_GPC['cpid']);
			if ($cpid) 
			{
				mc_credit_update($uid, 'credit1', -$rule['cpcredit'], array('', '全民经纪人豪华版' . $profile['realname'] . '提取客户消费积分'));
				$cuspool = pdo_fetch('select cusid, cuspri from ' . tablename('hc_deluxejjr_cuspool') . ' where id = ' . $cpid);
				pdo_update('hc_deluxejjr_customer', array('openid' => $openid, 'cuspri' => $cuspool['cuspri'] + 1, 'isvalid' => 1, 'indatetime' => time()), array('id' => $cuspool['cusid']));
				pdo_delete('hc_deluxejjr_cuspool', array('id' => $cpid));
			}
			echo 1;
			exit();
		}
		else 
		{
			echo 2;
			exit();
		}
	}
	else 
	{
		echo 0;
		exit();
	}
	echo 0;
	exit();
}
?>