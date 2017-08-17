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
if ($op == 'display') 
{
	$lid = intval($_GPC['lid']);
	$loupans = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE (id_view = \'\' || id_view like \'%,' . $profile['identity'] . ',%\') and `uniacid` = :uniacid and `isview` =1 ORDER BY displayorder DESC', array(':uniacid' => $uniacid));
	include $this->template('recommend');
}
if ($op == 'add') 
{
	$time = time();
	$data = array('uniacid' => $uniacid, 'openid' => $openid, 'identity' => $profile['identity'], 'realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile'], 'loupan' => intval($_GPC['loupan']), 'content' => trim($_GPC['content']), 'createtime1' => date('Y-m-d', $time), 'isvalid' => 1, 'createtime' => $time, 'updatetime' => $time, 'indatetime' => $time);
	$status = $this->ProcessStatus();
	$statuslenth = count($status) - 1;
	$cfg = $this->module['config'];
	$statusprotect = count($status) - 2;
	$protectdate = intval($cfg['protectdate']);
	if ($protectdate) 
	{
		$protectdate = $time - (3600 * 24 * $protectdate);
		$protectwhere = ' AND (updatetime > ' . $protectdate . ' OR status > ' . $statusprotect . ' )';
	}
	$profile1 = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE loupan = ' . intval($_GPC['loupan']) . ' and isvalid = 1 and mobile=:mobile AND `uniacid` = :uniacid ' . $protectwhere . ' ', array(':uniacid' => $uniacid, ':mobile' => $_GPC['mobile']));
	$cprotect = pdo_fetchcolumn('SELECT count(id) FROM ' . tablename('hc_deluxejjr_protect') . ' WHERE `uniacid` = :uniacid AND mobile=:mobile ', array(':uniacid' => $uniacid, ':mobile' => $_GPC['mobile']));
	if ($profile1 || $cprotect) 
	{
		echo '-1';
		exit();
	}
	$loupan = pdo_fetch('SELECT recnum, isautoallot FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid and `isview` = 1 and id = ' . $data['loupan'], array(':uniacid' => $uniacid));
	if (!empty($loupan)) 
	{
		pdo_update('hc_deluxejjr_loupan', array('recnum' => $loupan['recnum'] + 1), array('id' => $data['loupan']));
	}
	if ($loupan['isautoallot'] == 1) 
	{
		$xss = pdo_fetchall('select id, mark from ' . tablename('hc_deluxejjr_assistant') . ' where flag = 0 and uniacid = ' . $uniacid . ' and lid = ' . $data['loupan'] . ' order by id asc');
		$lastxsid = 0;
		$markid = 0;
		$firstxsid = 0;
		$flag = 0;
		foreach ($xss as $x ) 
		{
			if ($firstxsid == 0) 
			{
				$firstxsid = $x['id'];
			}
			if ($x['mark'] == 1) 
			{
				if ($markid == 0) 
				{
					$markid = $x['id'];
				}
			}
			if ($markid != 0) 
			{
				++$flag;
			}
			$lastxsid = $x['id'];
			if ($markid == $lastxsid) 
			{
				$nextmarkid = $firstxsid;
			}
			if ($markid < $lastxsid) 
			{
				if ($flag == 2) 
				{
					$nextmarkid = $x['id'];
				}
			}
		}
		if (!empty($xss)) 
		{
			if ($markid != 0) 
			{
				pdo_update('hc_deluxejjr_assistant', array('mark' => 0), array('id' => $markid));
				pdo_update('hc_deluxejjr_assistant', array('mark' => 1), array('id' => $nextmarkid));
				$data['cid'] = $nextmarkid;
			}
			else 
			{
				pdo_update('hc_deluxejjr_assistant', array('mark' => 1), array('id' => $firstxsid));
				$data['cid'] = $firstxsid;
			}
		}
	}
	$tjcredit = pdo_fetch('select tjcredit, title from ' . tablename('hc_deluxejjr_loupan') . ' where id =' . $data['loupan']);
	if (!empty($tjcredit['tjcredit'])) 
	{
		load()->model('mc');
		$uid = pdo_fetchcolumn('select uid from ' . tablename('mc_mapping_fans') . ' where uniacid = ' . $uniacid . ' and openid = \'' . $openid . '\'');
		if ($uid) 
		{
			mc_credit_update($uid, 'credit1', $tjcredit['tjcredit'], array('', '全民经纪人豪华版' . $profile['realname'] . '推荐积分'));
			$url = $_W['siteroot'] . $this->createMobileUrl('my');
			sendCreditChange($openid, '积分增加', '推荐' . $tjcredit['title'] . '成功', $tjcredit['tjcredit'], $url);
		}
	}
	pdo_insert('hc_deluxejjr_customer', $data);
	$cid = pdo_insertId();
	if (intval($data['cid'])) 
	{
		$url = $_W['siteroot'] . $this->createMobileUrl('counselor');
		$xs = pdo_fetch('select openid, realname from ' . tablename('hc_deluxejjr_assistant') . ' where uniacid = ' . $uniacid . ' and id = ' . $data['cid']);
		sendCustomerFP($xs['openid'], '项目经理', date('Y-m-d H:i:s', $time), $tjcredit['title'], $url);
	}
	if (!empty($tjcredit['tjcredit'])) 
	{
		$exp = array('uniacid' => $uniacid, 'mid' => $profile['id'], 'lid' => $data['loupan'], 'cid' => $cid, 'expname' => '推荐' . $_GPC['realname'], 'exp' => $tjcredit['tjcredit'], 'createtime' => $time);
		pdo_insert('hc_deluxejjr_experience', $exp);
	}
	echo 1;
	exit();
}
?>