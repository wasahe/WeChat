<?php
load()->func('tpl');
$pp = trim($_GPC['pp']);
if ($pp != 'xml') 
{
	$starttime = strtotime($_GPC['starttime']);
	$endtime = strtotime($_GPC['endtime']) + 86399;
	$starttime = ((empty($starttime) ? strtotime(date('Y-m-01 00:00:00')) : $starttime));
	$endtime = ((empty($_GPC['endtime']) ? strtotime(date('Y-m-d 23:59:59', time())) : $endtime));
}
else 
{
	$starttime = $_GPC['starttime'];
	$endtime = $_GPC['endtime'];
}
$location_ps = pdo_fetchall('SELECT distinct(location_p) as location_p FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid', array(':uniacid' => $uniacid));
$loupans = pdo_fetchall('SELECT id,title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid', array(':uniacid' => $uniacid));
$loupan = array();
foreach ($loupans as $k => $v ) 
{
	$loupan[$v['id']] = $v['title'];
}
$condition = array('op' => $op, 'starttime' => $starttime, 'endtime' => $endtime, 'location_p' => trim($_GPC['location_p']), 'location_c' => trim($_GPC['location_c']), 'location_a' => trim($_GPC['location_a']), 'lid' => intval($_GPC['lid']));
$location_p = trim($condition['location_p']);
$location_c = trim($condition['location_c']);
$location_a = trim($condition['location_a']);
$lid = intval($condition['lid']);
if ($op == 'select') 
{
	if ($_GPC['opp'] == 'location_p') 
	{
		if (!empty($location_p)) 
		{
			$location_cs = pdo_fetchall('SELECT distinct(location_c) as location_c FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE location_p = \'' . $location_p . '\' and `uniacid` = :uniacid', array(':uniacid' => $uniacid));
			if (!empty($location_cs)) 
			{
				echo json_encode($location_cs);
				exit();
			}
			else 
			{
				echo 0;
				exit();
			}
		}
	}
	if ($_GPC['opp'] == 'location_c') 
	{
		if (!empty($location_p) && !empty($location_c)) 
		{
			$location_as = pdo_fetchall('SELECT distinct(location_a) as location_a FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE location_p = \'' . $location_p . '\' and location_c = \'' . $location_c . '\' and `uniacid` = :uniacid', array(':uniacid' => $uniacid));
			if (!empty($location_as)) 
			{
				echo json_encode($location_as);
				exit();
			}
			else 
			{
				echo 0;
				exit();
			}
		}
	}
	if ($_GPC['opp'] == 'location_a') 
	{
		if (!empty($location_p) && !empty($location_c) && !empty($location_a)) 
		{
			$loupans = pdo_fetchall('SELECT id, title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE location_p = \'' . $location_p . '\' and location_c = \'' . $location_c . '\' and location_a = \'' . $location_a . '\' and `uniacid` = :uniacid', array(':uniacid' => $uniacid));
			if (!empty($loupans)) 
			{
				echo json_encode($loupans);
				exit();
			}
			else 
			{
				echo 0;
				exit();
			}
		}
	}
}
if ($op == 'lpcustomernum') 
{
	$logtype = 1;
	$caption = $location_p . $location_c . $location_a . '楼盘客户数柱状图';
	if ($pp == 'xml') 
	{
		$conditions = '';
		if (!empty($location_p)) 
		{
			$conditions = $conditions . ' and location_p = \'' . $location_p . '\'';
		}
		if (!empty($location_c)) 
		{
			$conditions = $conditions . ' and location_c = \'' . $location_c . '\'';
		}
		if (!empty($location_a)) 
		{
			$conditions = $conditions . ' and location_a = \'' . $location_a . '\'';
		}
		if (!empty($location_p)) 
		{
			$loupanids = pdo_fetchall('SELECT id FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid ' . $conditions, array(':uniacid' => $uniacid));
			$loupanid = '';
			foreach ($loupanids as $l ) 
			{
				$loupanid = $loupanid . $l['id'] . ',';
			}
			$loupanid = '(' . trim($loupanid, ',') . ')';
		}
		if (!empty($loupanids)) 
		{
			$logs = pdo_fetchall('select count(id) as num, loupan from ' . tablename('hc_deluxejjr_customer') . ' where loupan in ' . $codeloupanids . ' and loupan in ' . $loupanid . ' and uniacid = ' . $uniacid . ' and createtime >= ' . $starttime . ' and createtime <' . $endtime . ' group by loupan');
		}
		else 
		{
			$logs = pdo_fetchall('select count(id) as num, loupan from ' . tablename('hc_deluxejjr_customer') . ' where loupan in ' . $codeloupanids . ' and uniacid = ' . $uniacid . ' and createtime >= ' . $starttime . ' and createtime <' . $endtime . ' group by loupan');
		}
		$string = '<?xml version="1.0" encoding="utf-8"?>' . "\r\n\t\t\t\t" . '<chart caption="">' . "\r\n\t\t\t\t" . '</chart>';
		$xml = simplexml_load_string($string);
		$xml['caption'] = $caption;
		foreach ($logs as $log ) 
		{
			$set = $xml->addChild('set');
			$set->addAttribute('label', $loupan[$log['loupan']]);
			$set->addAttribute('value', $log['num']);
		}
		header('Content-Type: text/xml');
		echo $xml->asXML();
		exit();
	}
}
if ($op == 'arealoupan') 
{
	$logtype = 2;
	$caption = $location_p . $location_c . $location_a . '楼盘数圆饼图';
	if ($pp == 'xml') 
	{
		if (empty($location_p)) 
		{
			$logs = pdo_fetchall('select count(id) as num, location_p as location from ' . tablename('hc_deluxejjr_loupan') . ' where id in ' . $codeloupanids . ' and uniacid = ' . $uniacid . ' and createtime >= ' . $starttime . ' and createtime <' . $endtime . ' group by location_p');
		}
		else if (empty($location_c)) 
		{
			$logs = pdo_fetchall('select count(id) as num, location_c as location from ' . tablename('hc_deluxejjr_loupan') . ' where id in ' . $codeloupanids . ' and location_p = \'' . $location_p . '\' and uniacid = ' . $uniacid . ' and createtime >= ' . $starttime . ' and createtime <' . $endtime . ' group by location_c');
		}
		else if (empty($location_a)) 
		{
			$logs = pdo_fetchall('select count(id) as num, location_a as location from ' . tablename('hc_deluxejjr_loupan') . ' where id in ' . $codeloupanids . ' and location_p = \'' . $location_p . '\' and location_c = \'' . $location_c . '\' and uniacid = ' . $uniacid . ' and createtime >= ' . $starttime . ' and createtime <' . $endtime . ' group by location_c');
		}
		else 
		{
			$logs = pdo_fetchall('select count(id) as num, location_a as location from ' . tablename('hc_deluxejjr_loupan') . ' where id in ' . $codeloupanids . ' and location_p = \'' . $location_p . '\' and location_c = \'' . $location_c . '\' and location_a = \'' . $location_a . '\' and uniacid = ' . $uniacid . ' and createtime >= ' . $starttime . ' and createtime <' . $endtime . ' group by location_c');
		}
		$string = '<?xml version="1.0" encoding="utf-8"?>' . "\r\n\t\t\t\t" . '<chart caption="">' . "\r\n\t\t\t\t" . '</chart>';
		$xml = simplexml_load_string($string);
		$xml['caption'] = $caption;
		foreach ($logs as $log ) 
		{
			$set = $xml->addChild('set');
			$set->addAttribute('label', $log['location']);
			$set->addAttribute('value', $log['num']);
		}
		header('Content-Type: text/xml');
		echo $xml->asXML();
		exit();
	}
}
if ($op == 'loupansuccess') 
{
	$logtype = 3;
	$caption = $location_p . $location_c . $location_a . '楼盘成交数';
	if ($pp == 'xml') 
	{
		$conditions = '';
		if (!empty($location_p)) 
		{
			$conditions = $conditions . ' and location_p = \'' . $location_p . '\'';
		}
		if (!empty($location_c)) 
		{
			$conditions = $conditions . ' and location_c = \'' . $location_c . '\'';
		}
		if (!empty($location_a)) 
		{
			$conditions = $conditions . ' and location_a = \'' . $location_a . '\'';
		}
		if (!empty($location_p)) 
		{
			$loupanids = pdo_fetchall('SELECT id FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid ' . $conditions, array(':uniacid' => $uniacid));
			$loupanid = '';
			foreach ($loupanids as $l ) 
			{
				$loupanid = $loupanid . $l['id'] . ',';
			}
			$loupanid = '(' . trim($loupanid, ',') . ')';
		}
		$success_key = sizeof($this->ProcessStatus()) - 1;
		if (!empty($loupanids)) 
		{
			$logs = pdo_fetchall('select count(id) as num, loupan from ' . tablename('hc_deluxejjr_customer') . ' where loupan in ' . $codeloupanids . ' and status = ' . $success_key . ' and loupan in ' . $loupanid . ' and uniacid = ' . $uniacid . ' and createtime >= ' . $starttime . ' and createtime <' . $endtime . ' group by loupan');
		}
		else 
		{
			$logs = pdo_fetchall('select count(id) as num, loupan from ' . tablename('hc_deluxejjr_customer') . ' where loupan in ' . $codeloupanids . ' and status = ' . $success_key . ' and uniacid = ' . $uniacid . ' and createtime >= ' . $starttime . ' and createtime <' . $endtime . ' group by loupan');
		}
		$string = '<?xml version="1.0" encoding="utf-8"?>' . "\r\n\t\t\t\t" . '<chart caption="" lineThickness="4" showValues="0" formatNumberScale="0" anchorRadius="4" divLineAlpha="15" divLineColor="666666" divLineIsDashed="1" showAlternateHGridColor="1" alternateHGridColor="666666" shadowAlpha="40" labelStep="2" numvdivlines="5" chartRightMargin="35" bgColor="FFFFFF,FFFFFF" bgAngle="270" bgAlpha="10,10" alternateHGridAlpha="5" legendPosition="RIGHT " baseFontSize="12" baseFont="Microsoft YaHei,Helvitica,Verdana,Arial,san-serif" canvasBorderThickness="1" canvasBorderColor="888888" showShadow="1" animation="1" showBorder="0" showToolTip="1" adjustDiv="1" setAdaptiveYMin="1" defaultAnimation="1">' . "\r\n\t\t\t\t\t" . '<categories>' . "\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t" . '</categories>' . "\r\n\t\t\t\t\t" . '<dataset seriesName="" color="66cc00" anchorBorderColor="66cc00" anchorBgColor="ffffff">' . "\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t" . '</dataset>' . "\r\n\t\t\t\t\t" . '<styles>' . "\r\n\t\t\t\t\t\t" . '<definition>' . "\r\n\t\t\t\t\t\t\t" . '<style name="CaptionFont" type="font" size="12"/>' . "\r\n\t\t\t\t\t\t" . '</definition>' . "\r\n\t\t\t\t\t\t" . '<application>' . "\r\n\t\t\t\t\t\t\t" . '<apply toObject="CAPTION" styles="CaptionFont"/>' . "\r\n\t\t\t\t\t\t\t" . '<apply toObject="SUBCAPTION" styles="CaptionFont"/>' . "\r\n\t\t\t\t\t\t" . '</application>' . "\r\n\t\t\t\t\t" . '</styles>' . "\r\n\t\t\t\t" . '</chart>';
		$xml = simplexml_load_string($string);
		$xml['caption'] = $caption;
		foreach ($logs as $log ) 
		{
			$category = $xml->categories->addChild('category');
			$category->addAttribute('label', $loupan[$log['loupan']]);
			$set = $xml->dataset->addChild('set');
			$set->addAttribute('value', $log['num']);
		}
		header('Content-Type: text/xml');
		echo $xml->asXML();
		exit();
	}
}
if ($op == 'cusstatus') 
{
	$logtype = 4;
	$caption = $location_p . $location_c . $location_a . $loupan[$lid] . '客户状态走势圆饼图';
	if ($pp == 'xml') 
	{
		if (empty($lid)) 
		{
			$conditions = '';
			if (!empty($location_p)) 
			{
				$conditions = $conditions . ' and location_p = \'' . $location_p . '\'';
			}
			if (!empty($location_c)) 
			{
				$conditions = $conditions . ' and location_c = \'' . $location_c . '\'';
			}
			if (!empty($location_a)) 
			{
				$conditions = $conditions . ' and location_a = \'' . $location_a . '\'';
			}
			if (!empty($location_p)) 
			{
				$loupanids = pdo_fetchall('SELECT id FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid ' . $conditions, array(':uniacid' => $uniacid));
				$loupanid = '';
				foreach ($loupanids as $l ) 
				{
					$loupanid = $loupanid . $l['id'] . ',';
				}
				$loupanid = '(' . trim($loupanid, ',') . ')';
			}
		}
		if (!empty($loupanids)) 
		{
			$logs = pdo_fetchall('select count(id) as num, status, loupan from' . tablename('hc_deluxejjr_customer') . 'where loupan in ' . $codeloupanids . ' and loupan in ' . $loupanid . ' and uniacid =' . $uniacid . '.and updatetime >= ' . $starttime . '.and updatetime <' . $endtime . '.group by status');
		}
		else if (empty($lid)) 
		{
			$logs = pdo_fetchall('select count(id) as num, status, loupan from' . tablename('hc_deluxejjr_customer') . 'where loupan in ' . $codeloupanids . ' and uniacid =' . $uniacid . '.and updatetime >= ' . $starttime . '.and updatetime <' . $endtime . '.group by status');
		}
		else 
		{
			$logs = pdo_fetchall('select count(id) as num, status, loupan from' . tablename('hc_deluxejjr_customer') . 'where loupan in ' . $codeloupanids . ' and loupan = ' . $lid . ' and uniacid =' . $uniacid . '.and updatetime >= ' . $starttime . '.and updatetime <' . $endtime . '.group by status');
		}
		$string = '<?xml version="1.0" encoding="utf-8"?>' . "\r\n\t\t\t\t" . '<chart caption="">' . "\r\n\t\t\t\t" . '</chart>';
		$xml = simplexml_load_string($string);
		$xml['caption'] = $caption;
		$status = $this->ProcessStatus();
		foreach ($logs as $log ) 
		{
			$set = $xml->addChild('set');
			$set->addAttribute('label', $status[$log['status']]);
			$set->addAttribute('value', $log['num']);
		}
		header('Content-Type: text/xml');
		echo $xml->asXML();
		exit();
	}
}
if ($op == 'display') 
{
	$logtype = 5;
	$caption = '经纪人增长曲线图';
	if ($pp == 'xml') 
	{
		$daytime = $endtime - $starttime;
		$daytimes = intval($daytime / 86400);
		$logs = pdo_fetchall('select count(id) as num, createtime1 from ' . tablename('hc_deluxejjr_member') . ' where uniacid = ' . $uniacid . ' and createtime >= ' . $starttime . ' and createtime < ' . $endtime . ' group by createtime1 order by createtime asc');
		$string = '<?xml version="1.0" encoding="utf-8"?>' . "\r\n\t\t\t\t" . '<chart caption="" lineThickness="4" showValues="1" formatNumberScale="0" anchorRadius="4" divLineAlpha="15" divLineColor="666666" divLineIsDashed="1" showAlternateHGridColor="1" alternateHGridColor="666666" shadowAlpha="40" labelStep="2" numvdivlines="5" chartRightMargin="35" bgColor="FFFFFF,FFFFFF" bgAngle="270" bgAlpha="10,10" alternateHGridAlpha="5" legendPosition="RIGHT " baseFontSize="12" baseFont="Microsoft YaHei,Helvitica,Verdana,Arial,san-serif" canvasBorderThickness="1" canvasBorderColor="888888" showShadow="1" animation="1" showBorder="0" showToolTip="1" adjustDiv="1" setAdaptiveYMin="1" defaultAnimation="1">' . "\r\n\t\t\t\t\t" . '<categories>' . "\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t" . '</categories>' . "\r\n\t\t\t\t\t" . '<dataset seriesName="" color="66cc00" anchorBorderColor="66cc00" anchorBgColor="ffffff">' . "\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t" . '</dataset>' . "\r\n\t\t\t\t\t" . '<styles>' . "\r\n\t\t\t\t\t\t" . '<definition>' . "\r\n\t\t\t\t\t\t\t" . '<style name="CaptionFont" type="font" size="12"/>' . "\r\n\t\t\t\t\t\t" . '</definition>' . "\r\n\t\t\t\t\t\t" . '<application>' . "\r\n\t\t\t\t\t\t\t" . '<apply toObject="CAPTION" styles="CaptionFont"/>' . "\r\n\t\t\t\t\t\t\t" . '<apply toObject="SUBCAPTION" styles="CaptionFont"/>' . "\r\n\t\t\t\t\t\t" . '</application>' . "\r\n\t\t\t\t\t" . '</styles>' . "\r\n\t\t\t\t" . '</chart>';
		$xml = simplexml_load_string($string);
		$xml['caption'] = $caption;
		$i = 0;
		while ($i <= $daytimes) 
		{
			$eachtimes = date('Y-m-d', $starttime);
			$category = $xml->categories->addChild('category');
			$xtimes = substr($eachtimes, 5);
			$category->addAttribute('label', $xtimes);
			$set = $xml->dataset->addChild('set');
			foreach ($logs as $key => $log ) 
			{
				if ($log['createtime1'] == $eachtimes) 
				{
					$set->addAttribute('value', $log['num']);
					unset($logs[$key]);
				}
				else 
				{
					$set->addAttribute('value', 0);
				}
				break;
			}
			if (empty($logs)) 
			{
				$set->addAttribute('value', 0);
			}
			$starttime = $starttime + 86400;
			++$i;
		}
		header('Content-Type: text/xml');
		echo $xml->asXML();
		exit();
	}
	else 
	{
		$membernum = pdo_fetchcolumn('select count(id) from ' . tablename('hc_deluxejjr_member') . ' where uniacid = ' . $uniacid . ' and createtime >= ' . $starttime . ' and createtime <' . $endtime);
		$customers = pdo_fetchall('select id, status, openid from ' . tablename('hc_deluxejjr_customer') . ' where uniacid = ' . $uniacid . ' and createtime >= ' . $starttime . ' and createtime <' . $endtime);
		$success_key = sizeof($this->ProcessStatus()) - 1;
		$tjnum = 0;
		$success_loupannum = 0;
		$tjcus_membernum = 0;
		$openids = array();
		foreach ($customers as $c ) 
		{
			++$tjnum;
			if ($c['status'] == $success_key) 
			{
				++$success_loupannum;
			}
			if (!in_array($c['openid'], $openids)) 
			{
				++$tjcus_membernum;
				$openids[$c['id']] = $c['openid'];
			}
		}
	}
}
if ($op == 'customer') 
{
	$logtype = 6;
	$caption = $location_p . $location_c . $location_a . $loupan[$lid] . '客户增长曲线图';
	if (empty($lid)) 
	{
		$conditions = '';
		if (!empty($location_p)) 
		{
			$conditions = $conditions . ' and location_p = \'' . $location_p . '\'';
		}
		if (!empty($location_c)) 
		{
			$conditions = $conditions . ' and location_c = \'' . $location_c . '\'';
		}
		if (!empty($location_a)) 
		{
			$conditions = $conditions . ' and location_a = \'' . $location_a . '\'';
		}
		if (!empty($location_p)) 
		{
			$loupanids = pdo_fetchall('SELECT id FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid ' . $conditions, array(':uniacid' => $uniacid));
			$loupanid = '';
			foreach ($loupanids as $l ) 
			{
				$loupanid = $loupanid . $l['id'] . ',';
			}
			$loupanid = '(' . trim($loupanid, ',') . ')';
		}
	}
	if ($pp == 'xml') 
	{
		$daytime = $endtime - $starttime;
		$daytimes = intval($daytime / 86400);
		if (!empty($loupanids)) 
		{
			$logs = pdo_fetchall('select count(id) as num, createtime1 from' . tablename('hc_deluxejjr_customer') . 'where loupan in ' . $codeloupanids . ' and loupan in ' . $loupanid . ' and uniacid =' . $uniacid . '.and createtime >= ' . $starttime . '.and createtime <' . $endtime . '.group by createtime1 order by createtime asc');
		}
		else if (empty($lid)) 
		{
			$logs = pdo_fetchall('select count(id) as num, createtime1 from' . tablename('hc_deluxejjr_customer') . 'where loupan in ' . $codeloupanids . ' and uniacid =' . $uniacid . '.and createtime >= ' . $starttime . '.and createtime <' . $endtime . '.group by createtime1 order by createtime asc');
		}
		else 
		{
			$logs = pdo_fetchall('select count(id) as num, createtime1 from' . tablename('hc_deluxejjr_customer') . 'where loupan in ' . $codeloupanids . ' and loupan = ' . $lid . ' and uniacid =' . $uniacid . '.and createtime >= ' . $starttime . '.and createtime <' . $endtime . '.group by createtime1 order by createtime asc');
		}
		$string = '<?xml version="1.0" encoding="utf-8"?>' . "\r\n\t\t\t\t" . '<chart caption="" lineThickness="4" showValues="1" formatNumberScale="0" anchorRadius="4" divLineAlpha="15" divLineColor="666666" divLineIsDashed="1" showAlternateHGridColor="1" alternateHGridColor="666666" shadowAlpha="40" labelStep="2" numvdivlines="5" chartRightMargin="35" bgColor="FFFFFF,FFFFFF" bgAngle="270" bgAlpha="10,10" alternateHGridAlpha="5" legendPosition="RIGHT " baseFontSize="12" baseFont="Microsoft YaHei,Helvitica,Verdana,Arial,san-serif" canvasBorderThickness="1" canvasBorderColor="888888" showShadow="1" animation="1" showBorder="0" showToolTip="1" adjustDiv="1" setAdaptiveYMin="1" defaultAnimation="1">' . "\r\n\t\t\t\t\t" . '<categories>' . "\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t" . '</categories>' . "\r\n\t\t\t\t\t" . '<dataset seriesName="" color="66cc00" anchorBorderColor="66cc00" anchorBgColor="ffffff">' . "\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t" . '</dataset>' . "\r\n\t\t\t\t\t" . '<styles>' . "\r\n\t\t\t\t\t\t" . '<definition>' . "\r\n\t\t\t\t\t\t\t" . '<style name="CaptionFont" type="font" size="12"/>' . "\r\n\t\t\t\t\t\t" . '</definition>' . "\r\n\t\t\t\t\t\t" . '<application>' . "\r\n\t\t\t\t\t\t\t" . '<apply toObject="CAPTION" styles="CaptionFont"/>' . "\r\n\t\t\t\t\t\t\t" . '<apply toObject="SUBCAPTION" styles="CaptionFont"/>' . "\r\n\t\t\t\t\t\t" . '</application>' . "\r\n\t\t\t\t\t" . '</styles>' . "\r\n\t\t\t\t" . '</chart>';
		$xml = simplexml_load_string($string);
		$xml['caption'] = $caption;
		$i = 0;
		while ($i <= $daytimes) 
		{
			$eachtimes = date('Y-m-d', $starttime);
			$category = $xml->categories->addChild('category');
			$xtimes = substr($eachtimes, 5);
			$category->addAttribute('label', $xtimes);
			$set = $xml->dataset->addChild('set');
			foreach ($logs as $key => $log ) 
			{
				if ($log['createtime1'] == $eachtimes) 
				{
					$set->addAttribute('value', $log['num']);
					unset($logs[$key]);
				}
				else 
				{
					$set->addAttribute('value', 0);
				}
				break;
			}
			if (empty($logs)) 
			{
				$set->addAttribute('value', 0);
			}
			$starttime = $starttime + 86400;
			++$i;
		}
		header('Content-Type: text/xml');
		echo $xml->asXML();
		exit();
	}
	else 
	{
		if (!empty($loupanids)) 
		{
			$customers = pdo_fetchall('select status from' . tablename('hc_deluxejjr_customer') . 'where loupan in ' . $codeloupanids . ' and loupan in ' . $loupanid . ' and uniacid =' . $uniacid . '.and createtime >= ' . $starttime . '.and createtime <' . $endtime);
		}
		else if (empty($lid)) 
		{
			$customers = pdo_fetchall('select status from' . tablename('hc_deluxejjr_customer') . 'where loupan in ' . $codeloupanids . ' and uniacid =' . $uniacid . '.and createtime >= ' . $starttime . '.and createtime <' . $endtime);
		}
		else 
		{
			$customers = pdo_fetchall('select status from' . tablename('hc_deluxejjr_customer') . 'where loupan in ' . $codeloupanids . ' and loupan = ' . $lid . ' and uniacid =' . $uniacid . '.and createtime >= ' . $starttime . '.and createtime <' . $endtime);
		}
		$status = $this->ProcessStatus();
		$customernum = 0;
		$status1num = 0;
		$status2num = 0;
		$status3num = 0;
		foreach ($customers as $c ) 
		{
			++$customernum;
			if ($c['status'] == 1) 
			{
				++$status1num;
			}
			if ($c['status'] == 2) 
			{
				++$status2num;
			}
			if ($c['status'] == 3) 
			{
				++$status3num;
			}
		}
	}
}
if ($op == 'activecus') 
{
	$logtype = 7;
	$caption = $location_p . $location_c . $location_a . $loupan[$lid] . '活跃经纪人推荐数量走势圆饼图';
	if ($pp == 'xml') 
	{
		if (empty($lid)) 
		{
			$conditions = '';
			if (!empty($location_p)) 
			{
				$conditions = $conditions . ' and location_p = \'' . $location_p . '\'';
			}
			if (!empty($location_c)) 
			{
				$conditions = $conditions . ' and location_c = \'' . $location_c . '\'';
			}
			if (!empty($location_a)) 
			{
				$conditions = $conditions . ' and location_a = \'' . $location_a . '\'';
			}
			if (!empty($location_p)) 
			{
				$loupanids = pdo_fetchall('SELECT id FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid ' . $conditions, array(':uniacid' => $uniacid));
				$loupanid = '';
				foreach ($loupanids as $l ) 
				{
					$loupanid = $loupanid . $l['id'] . ',';
				}
				$loupanid = '(' . trim($loupanid, ',') . ')';
			}
		}
		if (!empty($loupanids)) 
		{
			$logs = pdo_fetchall('select count(id) as num, identity from' . tablename('hc_deluxejjr_customer') . 'where  openid != \'\' and identity != 0 and uniacid =' . $uniacid . '.and createtime >= ' . $starttime . '.and createtime <' . $endtime . '.group by identity');
		}
		else if (empty($lid)) 
		{
			$logs = pdo_fetchall('select count(id) as num, identity from' . tablename('hc_deluxejjr_customer') . 'where  openid != \'\' and identity != 0 and createtime >= ' . $starttime . '.and createtime <' . $endtime . '.group by identity');
		}
		else 
		{
			$logs = pdo_fetchall('select count(id) as num, identity from' . tablename('hc_deluxejjr_customer') . 'where  openid != \'\' and identity != 0 and uniacid =' . $uniacid . '.and createtime >= ' . $starttime . '.and createtime <' . $endtime . '.group by identity');
		}
		$string = '<?xml version="1.0" encoding="utf-8"?>' . "\r\n\t\t\t\t" . '<chart caption="">' . "\r\n\t\t\t\t" . '</chart>';
		$xml = simplexml_load_string($string);
		$xml['caption'] = $caption;
		$identitys = pdo_fetchall('select id, identity_name from ' . tablename('hc_deluxejjr_identity') . ' where uniacid = ' . $uniacid);
		$identity = array();
		foreach ($identitys as $i ) 
		{
			$identity[$i['id']] = $i['identity_name'];
		}
		foreach ($logs as $log ) 
		{
			$set = $xml->addChild('set');
			$set->addAttribute('label', $identity[$log['identity']]);
			$set->addAttribute('value', $log['num']);
		}
		header('Content-Type: text/xml');
		echo $xml->asXML();
		exit();
	}
}
if ($op == 'activemem') 
{
	$logtype = 8;
	$caption = $location_p . $location_c . $location_a . $loupan[$lid] . '活跃经纪人数量走势圆饼图';
	if ($pp == 'xml') 
	{
		if (empty($lid)) 
		{
			$conditions = '';
			if (!empty($location_p)) 
			{
				$conditions = $conditions . ' and location_p = \'' . $location_p . '\'';
			}
			if (!empty($location_c)) 
			{
				$conditions = $conditions . ' and location_c = \'' . $location_c . '\'';
			}
			if (!empty($location_a)) 
			{
				$conditions = $conditions . ' and location_a = \'' . $location_a . '\'';
			}
			if (!empty($location_p)) 
			{
				$loupanids = pdo_fetchall('SELECT id FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid ' . $conditions, array(':uniacid' => $uniacid));
				$loupanid = '';
				foreach ($loupanids as $l ) 
				{
					$loupanid = $loupanid . $l['id'] . ',';
				}
				$loupanid = '(' . trim($loupanid, ',') . ')';
			}
		}
		if (!empty($loupanids)) 
		{
			$logs = pdo_fetchall('select count(distinct openid) as num, identity from' . tablename('hc_deluxejjr_customer') . 'where loupan in ' . $codeloupanids . ' and loupan in ' . $loupanid . ' and openid != \'\' and identity != 0 and uniacid =' . $uniacid . '.and createtime >= ' . $starttime . '.and createtime <' . $endtime . '.group by identity');
		}
		else if (empty($lid)) 
		{
			$logs = pdo_fetchall('select count(distinct openid) as num, identity from' . tablename('hc_deluxejjr_customer') . 'where loupan in ' . $codeloupanids . ' and uniacid =' . $uniacid . ' and openid != \'\' and identity != 0 and createtime >= ' . $starttime . '.and createtime <' . $endtime . '.group by identity');
		}
		else 
		{
			$logs = pdo_fetchall('select count(distinct openid) as num, identity from' . tablename('hc_deluxejjr_customer') . 'where loupan in ' . $codeloupanids . ' and loupan = ' . $lid . ' and openid != \'\' and identity != 0 and uniacid =' . $uniacid . '.and createtime >= ' . $starttime . '.and createtime <' . $endtime . '.group by identity');
		}
		$string = '<?xml version="1.0" encoding="utf-8"?>' . "\r\n\t\t\t\t" . '<chart caption="">' . "\r\n\t\t\t\t" . '</chart>';
		$xml = simplexml_load_string($string);
		$xml['caption'] = $caption;
		$identitys = pdo_fetchall('select id, identity_name from ' . tablename('hc_deluxejjr_identity') . ' where uniacid = ' . $uniacid);
		$identity = array();
		foreach ($identitys as $i ) 
		{
			$identity[$i['id']] = $i['identity_name'];
		}
		foreach ($logs as $log ) 
		{
			$set = $xml->addChild('set');
			$set->addAttribute('label', $identity[$log['identity']]);
			$set->addAttribute('value', $log['num']);
		}
		header('Content-Type: text/xml');
		echo $xml->asXML();
		exit();
	}
}
if (!empty($location_p)) 
{
	$location_cs = pdo_fetchall('SELECT distinct(location_c) as location_c FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE location_p = \'' . $location_p . '\' and uniacid = ' . $uniacid);
}
if (!empty($location_c)) 
{
	$location_as = pdo_fetchall('SELECT distinct(location_a) as location_a FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE location_p = \'' . $location_p . '\' and location_c = \'' . $location_c . '\' and `uniacid` = :uniacid', array(':uniacid' => $uniacid));
}
if (!empty($location_a)) 
{
	$loupanss = pdo_fetchall('SELECT id, title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE location_p = \'' . $location_p . '\' and location_c = \'' . $location_c . '\' and location_a = \'' . $location_a . '\' and `uniacid` = :uniacid', array(':uniacid' => $uniacid));
}
include $this->template('report/jlreport');
?>