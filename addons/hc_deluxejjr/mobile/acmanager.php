<?php
$follow = pdo_fetch('select follow from ' . tablename('mc_mapping_fans') . ' where openid = \'' . $openid . '\' and uniacid = ' . $uniacid);
if (empty($follow) || ($follow['follow'] == 0)) 
{
	message('你想知道怎么加入么?', $rule['gzurl'], 'sucessr');
	exit();
}
$power = 1;
$assistant = pdo_fetch('SELECT a.*, ac.loupanid FROM ' . tablename('hc_deluxejjr_assistant') . ' as a left join ' . tablename('hc_deluxejjr_acmanager') . ' as ac on a.uniacid = ac.uniacid and a.code = ac.code WHERE flag = 1 and a.uniacid = :uniacid  AND a.openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
if (empty($assistant['loupanid'])) 
{
	$assistant['loupanid'] = 0;
}
$id = $assistant['id'];
if (intval($id) && ($assistant['status'] == 0)) 
{
	include $this->template('forbidden');
	exit();
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
if (intval($id)) 
{
	if ($op == 'allot') 
	{
		if (0 < $_GPC['id']) 
		{
			$id = intval($_GPC['id']);
			$update = array('cid' => $id, 'acid' => $assistant['id'], 'allottime' => time());
			$selected = explode(',', trim($_GPC['selected']));
			$cusids = '';
			$i = 0;
			while ($i < sizeof($selected)) 
			{
				$cusids = $cusids . $selected[$i] . ',';
				++$i;
			}
			$cusids = '(' . trim($cusids, ',') . ')';
			$customers = pdo_fetchall('select id, openid, loupan from ' . tablename('hc_deluxejjr_customer') . ' where id in ' . $cusids);
			$customer = array();
			foreach ($customers as $c ) 
			{
				$customer['openid'][$c['id']] = $c['openid'];
				$customer['loupan'][$c['id']] = $c['loupan'];
			}
			$loupans = pdo_fetchall('SELECT id, title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid', array(':uniacid' => $uniacid));
			$loupan = array();
			foreach ($loupans as $l ) 
			{
				$loupan[$l['id']] = $l['title'];
			}
			$xs = pdo_fetch('select openid, realname from ' . tablename('hc_deluxejjr_assistant') . ' where uniacid = ' . $uniacid . ' and id = ' . $id);
			$i = 0;
			while ($i < sizeof($selected)) 
			{
				$temp = pdo_update('hc_deluxejjr_customer', $update, array('id' => $selected[$i]));
				$url = $_W['siteroot'] . $this->createMobileUrl('counselor');
				sendCustomerFP($xs['openid'], '项目经理', date('Y-m-d H:i:s', time()), $customer['loupan'][$selected[$i]], $url);
				++$i;
			}
			if (!$temp) 
			{
				message('分配失败，请重新分配！', $this->createMobileUrl('acmanager', array('op' => 'allot')), 'error');
			}
			else 
			{
				message('分配成功！', $this->createMobileUrl('acmanager', array('op' => 'mycustomer', 'opp' => 'his', 'cid' => $id)), 'success');
			}
		}
		else 
		{
			$selected = trim($_GPC['selected']);
		}
		$customer = pdo_fetchall('select a.* from ' . tablename('hc_deluxejjr_assistant') . ' as a left join ' . tablename('hc_deluxejjr_counselor') . ' as c on a.code = c.code and a.uniacid = c.uniacid where c.lid in (' . $assistant['loupanid'] . ') and a.flag = 0 and a.status = 1 and a.uniacid =' . $uniacid);
		include $this->template('ga_index');
		exit();
	}
	$pindex = max(1, intval($_GPC['page']));
	$psize = 15;
	$xss = pdo_fetchall('select id, realname from ' . tablename('hc_deluxejjr_assistant') . ' where uniacid = ' . $uniacid . ' and flag = 0');
	$xs = array();
	foreach ($xss as $x ) 
	{
		$xs[$x['id']] = $x['realname'];
	}
	$total = pdo_fetchcolumn('select count(id) from ' . tablename('hc_deluxejjr_customer') . 'where loupan in (' . $assistant['loupanid'] . ') and uniacid =' . $uniacid . $protectwhere);
	$customer = pdo_fetchall('select * from ' . tablename('hc_deluxejjr_customer') . 'where loupan in (' . $assistant['loupanid'] . ') and uniacid =' . $uniacid . ' ' . $protectwhere . ' ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize);
	$pager = pagination1($total, $pindex, $psize);
	$loupan = pdo_fetchall('SELECT id, title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid ORDER BY displayorder DESC', array(':uniacid' => $uniacid));
	$pan = array();
	foreach ($loupan as $l ) 
	{
		$pan[$l['id']] = $l['title'];
	}
	include $this->template('gw_index');
	exit();
}
if ($op == 'add') 
{
	$data = array('uniacid' => $uniacid, 'openid' => $openid, 'realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile'], 'code' => $_GPC['code'], 'flag' => 1, 'createtime' => TIMESTAMP);
	$assistant = pdo_fetch('SELECT code,id FROM ' . tablename('hc_deluxejjr_assistant') . ' WHERE flag = 1 and `uniacid` = :uniacid AND code=:code ', array(':uniacid' => $uniacid, ':code' => $_GPC['code']));
	if ($data['code'] == $assistant['code']) 
	{
		echo '-1';
		exit();
	}
	$codes = pdo_fetchall('select id, code from ' . tablename('hc_deluxejjr_acmanager') . 'where status = 1 and uniacid =' . $uniacid);
	$flag = true;
	foreach ($codes as $c ) 
	{
		if (trim($c['code']) == trim($_GPC['code'])) 
		{
			pdo_update('hc_deluxejjr_acmanager', array('status' => 0), array('id' => $c['id']));
			$flag = false;
			break;
		}
	}
	if ($flag) 
	{
		echo -1;
		exit();
	}
	pdo_insert('hc_deluxejjr_assistant', $data);
	echo 1;
	exit();
}
include $this->template('acmanager');
?>