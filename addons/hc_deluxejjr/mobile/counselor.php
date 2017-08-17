<?php
$follow = pdo_fetch('select follow from ' . tablename('mc_mapping_fans') . ' where openid = \'' . $openid . '\' and uniacid = ' . $uniacid);
if (empty($follow) || ($follow['follow'] == 0)) 
{
	message('你想知道怎么加入么?', $rule['gzurl'], 'sucessr');
	exit();
}
$power = intval($_GPC['power']);
if (empty($power)) 
{
	$assistant = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_assistant') . ' WHERE flag = 0 and uniacid = :uniacid  AND openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
}
else 
{
	$assistant = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_assistant') . ' WHERE flag = ' . $power . ' and uniacid = :uniacid  AND openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
	if (empty($assistant)) 
	{
		message('非法访问');
	}
}
$id = $assistant['id'];
if (intval($id) && ($assistant['status'] == 0)) 
{
	include $this->template('forbidden');
	exit();
}
if ($op == 'remarkdetail') 
{
	$commid = intval($_GPC['commid']);
	if ($commid) 
	{
		$comm = pdo_fetch('select * from ' . tablename('hc_deluxejjr_commission') . ' where id = ' . $commid);
		if ($_GPC['opp'] == 'post') 
		{
			pdo_update('hc_deluxejjr_commission', array('content' => trim($_GPC['content'])), array('id' => $comm['id']));
			$url = $this->createMobileUrl('counselor', array('op' => 'detail', 'cid' => $comm['cid']));
			header('location:' . $url);
		}
	}
	include $this->template('remark_detail');
	exit();
}
if ($op == 'cancelfp') 
{
	$cid = intval($_GPC['cid']);
	if ($cid) 
	{
		pdo_update('hc_deluxejjr_customer', array('cid' => 0), array('id' => $cid));
		echo 1;
		exit();
	}
	else 
	{
		echo 0;
		exit();
	}
}
$status = $this->ProcessStatus();
$statuslenth = count($status) - 1;
$cfg = $this->module['config'];
$statusprotect = count($status) - 2;
$protectdate = intval($cfg['protectdate']);
if ($protectdate) 
{
	$protectdate = TIMESTAMP - (3600 * 24 * $protectdate);
	$protectwhere = ' AND (updatetime > ' . $protectdate . ' OR status > ' . $statuslenth . ' )';
}
if (intval($id)) 
{
	$pindex = max(1, intval($_GPC['page']));
	$psize = 15;
	if ($op == 'statussort') 
	{
		if ($power == 2) 
		{
			$profile = pdo_fetch('SELECT a.*, ac.loupanid FROM ' . tablename('hc_deluxejjr_assistant') . ' as a left join ' . tablename('hc_deluxejjr_promanager') . ' as ac on a.uniacid = ac.uniacid and a.code = ac.code WHERE a.flag = ' . $power . ' and a.uniacid = :uniacid  AND a.openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
		}
		else if ($power == 1) 
		{
			$profile = pdo_fetch('SELECT a.*, ac.loupanid FROM ' . tablename('hc_deluxejjr_assistant') . ' as a left join ' . tablename('hc_deluxejjr_acmanager') . ' as ac on a.uniacid = ac.uniacid and a.code = ac.code WHERE a.flag = ' . $power . ' and a.uniacid = :uniacid  AND a.openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
		}
		else 
		{
			$profile = pdo_fetch('SELECT a.*, ac.lid as loupanid FROM ' . tablename('hc_deluxejjr_assistant') . ' as a left join ' . tablename('hc_deluxejjr_counselor') . ' as ac on a.uniacid = ac.uniacid and a.code = ac.code WHERE a.flag = ' . $power . ' and a.uniacid = :uniacid  AND a.openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
		}
		$loupanids = $profile['loupanid'];
		if (empty($profile['loupanid'])) 
		{
			$loupanids = 0;
		}
		$s = intval($_GPC['status']);
		$louid = intval($_GPC['louid']);
		if ($louid) 
		{
			$louidsql = ' loupan = ' . $louid . ' and ';
		}
		else 
		{
			$louidsql = '';
		}
		$xss = pdo_fetchall('select id, realname from ' . tablename('hc_deluxejjr_assistant') . ' where uniacid = ' . $uniacid . ' and flag = 0');
		$xs = array();
		foreach ($xss as $x ) 
		{
			$xs[$x['id']] = $x['realname'];
		}
		if ($_GPC['oppp'] == 'all') 
		{
			$sql = 'select * from ' . tablename('hc_deluxejjr_customer') . 'where cid = ' . $profile['id'] . ' and loupan in (' . $loupanids . ') and uniacid =' . $uniacid . ' ' . $protectwhere . ' ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize;
			$sq = 'select count(id) from ' . tablename('hc_deluxejjr_customer') . 'where cid = ' . $profile['id'] . ' and loupan in (' . $loupanids . ') and uniacid =' . $uniacid . ' ' . $protectwhere . ' ';
		}
		else if ($_GPC['oppp'] == 'sort') 
		{
			$sql = 'select * from ' . tablename('hc_deluxejjr_customer') . 'where cid = ' . $profile['id'] . ' and loupan in (' . $loupanids . ') and ' . $louidsql . ' realname like \'%' . $_GPC['realname'] . '%\' and mobile like \'%' . $_GPC['mobile'] . '%\' and uniacid =' . $uniacid . ' ' . $protectwhere . ' ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize;
			$sq = 'select count(id) from ' . tablename('hc_deluxejjr_customer') . 'where cid = ' . $profile['id'] . ' and loupan in (' . $loupanids . ') and ' . $louidsql . ' realname like \'%' . $_GPC['realname'] . '%\' and mobile like \'%' . $_GPC['mobile'] . '%\' and uniacid =' . $uniacid . ' ' . $protectwhere . ' ';
		}
		else 
		{
			$sql = 'select * from ' . tablename('hc_deluxejjr_customer') . 'where cid = ' . $profile['id'] . ' and loupan in (' . $loupanids . ') and uniacid =' . $uniacid . ' and `status` = ' . $s . ' ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize;
			$sq = 'select count(id) from ' . tablename('hc_deluxejjr_customer') . 'where cid = ' . $profile['id'] . ' and loupan in (' . $loupanids . ') and uniacid =' . $uniacid . ' and `status` = ' . $s;
		}
		$customer = pdo_fetchall($sql);
		$total = pdo_fetchcolumn($sq);
	}
	if ($op == 'display') 
	{
		$active = 2;
		$customer = pdo_fetchall('select * from ' . tablename('hc_deluxejjr_customer') . 'where cid =' . $id . ' and uniacid =' . $uniacid . ' ' . $protectwhere . ' ORDER BY id DESC limit ' . (($pindex - 1) * $psize) . ',' . $psize);
		$total = pdo_fetchcolumn('select count(id) from ' . tablename('hc_deluxejjr_customer') . 'where cid =' . $id . ' and uniacid =' . $uniacid . ' ' . $protectwhere . ' ');
	}
	$pager = pagination1($total, $pindex, $psize);
	$loupan = pdo_fetchall('SELECT id, title FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE `uniacid` = :uniacid ORDER BY displayorder DESC', array(':uniacid' => $uniacid));
	$pan = array();
	foreach ($loupan as $l ) 
	{
		$pan[$l['id']] = $l['title'];
	}
	if ($op == 'detail') 
	{
		$cid = $_GPC['cid'];
		if (intval($cid)) 
		{
			$customer = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE `uniacid` = :uniacid AND id=:cid LIMIT 1', array(':uniacid' => $uniacid, ':cid' => $cid));
			$member = pdo_fetch('SELECT id, mobile, realname FROM ' . tablename('hc_deluxejjr_member') . ' WHERE `uniacid` = :uniacid AND `openid` =:openid LIMIT 1', array(':uniacid' => $uniacid, ':openid' => $customer['openid']));
			$xs = pdo_fetch('SELECT realname FROM ' . tablename('hc_deluxejjr_assistant') . ' WHERE id = ' . $customer['cid']);
		}
		else 
		{
			message('你想知道怎么加入么?', $rule['gzurl'], 'sucessr');
			exit();
		}
		$time_node = '';
		$time_detail = '';
		$statustimes = pdo_fetchall('select status, createtime from ' . tablename('hc_deluxejjr_commission') . ' where uniacid = ' . $uniacid . ' and lid = ' . $customer['loupan'] . ' and cid = ' . $cid);
		$statustime = array();
		foreach ($statustimes as $s ) 
		{
			$statustime[$s['status']] = date('Y-m-d H:i:s', $s['createtime']);
		}
		$i = 0;
		while ($i <= $statuslenth) 
		{
			if ((2 < $customer['status']) && ($i == 2)) 
			{
				continue;
			}
			$commid = ((empty($comcontent['id'][$i]) ? 0 : $comcontent['id'][$i]));
			$statime = ((empty($statustime[$i]) ? '' : '<br/>' . $statustime[$i]));
			if ($i <= $customer['status']) 
			{
				if ($i == $statuslenth) 
				{
					$time_node .= '<i class="time-node"><input class="input1" type="radio" name="status" value="' . $i . '"/></i>';
				}
				else 
				{
					$time_node .= '<i class="time-node"><input class="input1" type="radio" name="status" value="' . $i . '"/></i><span class="time-line"></span>';
				}
				$time_detail .= '<li class="fn-clear"><div class="time-detail"><p class="time-event" >' . $status[$i] . $statime . '</p></div></li>';
			}
			else 
			{
				if ($i == $statuslenth) 
				{
					$time_node .= '<i class="time-node-no"><input class="input1" type="radio" name="status" value="' . $i . '"/></i>';
				}
				else 
				{
					$time_node .= '<i class="time-node-no"><input class="input1" type="radio" name="status" value="' . $i . '"/></i><span class="time-line-no"></span>';
				}
				$time_detail .= '<li class="fn-clear"><div class="time-detail-no"><p class="time-event" >' . $status[$i] . $statime . '</p></div></li>';
			}
			++$i;
		}
		include $this->template('gw_customer');
		exit();
	}
	if ($op == 'status') 
	{
		$cid = $_GPC['cid'];
		$customer = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE `uniacid` = :uniacid AND id=:cid LIMIT 1', array(':uniacid' => $uniacid, ':cid' => $cid));
		$time = time();
		$statuss = array('status' => $_GPC['status'], 'indatetime' => $time, 'updatetime' => $time, 'updatetime1' => date('Y-m-d', $time));
		$temp = pdo_update('hc_deluxejjr_customer', $statuss, array('id' => $_GPC['cid']));
		$mid = pdo_fetchcolumn('select m.id from ' . tablename('hc_deluxejjr_member') . ' as m left join' . tablename('hc_deluxejjr_customer') . ' as c on m.openid = c.openid and m.uniacid = c.uniacid where m.uniacid =' . $uniacid . ' and c.id =' . $_GPC['cid']);
		$cstatus = pdo_fetchall('select status from' . tablename('hc_deluxejjr_commission') . 'where cid =' . $cid . '.and mid =' . $mid);
		$isupdate = 1;
		foreach ($cstatus as $s ) 
		{
			if ($s['status'] == $_GPC['status']) 
			{
				$isupdate = 0;
			}
		}
		if (!$mid) 
		{
			$mid = 0;
		}
		else 
		{
			$tjmid = pdo_fetchcolumn('select tjmid from' . tablename('hc_deluxejjr_member') . 'where id =' . $mid);
			$tjmid = intval($tjmid);
		}
		if ($isupdate) 
		{
			$commission = array('uniacid' => $uniacid, 'mid' => $mid, 'lid' => $customer['loupan'], 'cid' => $cid, 'status' => $_GPC['status'], 'flag' => $customer['flag'], 'opid' => $assistant['id'], 'opname' => $assistant['realname'], 'ischeck' => 0, 'createtime' => time());
			$temp = pdo_insert('hc_deluxejjr_commission', $commission);
			$stacredit = pdo_fetchcolumn('select stacredit from ' . tablename('hc_deluxejjr_loupan') . ' where id = ' . $customer['loupan']);
			$memcredits = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_customerstatus') . ' WHERE  uniacid = :uniacid order by displayorder asc', array(':uniacid' => $uniacid));
			$memcredit = array();
			if (!empty($memcredits)) 
			{
				foreach ($memcredits as $key => $m ) 
				{
					$memcredit[$key] = $m['jjrcredit'];
				}
			}
			$credit = array('uniacid' => $uniacid, 'mid' => $mid, 'lid' => $customer['loupan'], 'cid' => $cid, 'credit' => intval(($stacredit * $memcredit[$_GPC['status']]) / 100), 'content' => $_GPC['content'], 'status' => $_GPC['status'], 'opid' => $assistant['id'], 'opname' => $assistant['realname'], 'createtime' => time());
			pdo_insert('hc_deluxejjr_credit', $credit);
			if (!empty($credit['credit'])) 
			{
				$exp = array('uniacid' => $uniacid, 'mid' => $mid, 'lid' => $customer['loupan'], 'cid' => $cid, 'expname' => $customer['realname'] . $status[$_GPC['status']], 'exp' => intval(($stacredit * $memcredit[$_GPC['status']]) / 100), 'opid' => $assistant['id'], 'opname' => $assistant['realname'], 'createtime' => time());
				pdo_insert('hc_deluxejjr_experience', $exp);
			}
			load()->model('mc');
			$uid = pdo_fetchcolumn('select uid from ' . tablename('mc_mapping_fans') . ' where uniacid = ' . $uniacid . ' and openid = \'' . $customer['openid'] . '\'');
			if ($uid) 
			{
				mc_credit_update($uid, 'credit1', $credit['credit'], array('', '全民经纪人豪华版状态' . $status[$_GPC['status']] . '积分'));
			}
			if ($tjmid) 
			{
				$teamfy = $rule['teamfy'];
				if ($teamfy) 
				{
					$commission_team = array('uniacid' => $uniacid, 'mid' => $tjmid, 'lid' => $customer['loupan'], 'cid' => $cid, 'status' => $_GPC['status'], 'flag' => $customer['flag'], 'opid' => $assistant['id'], 'opname' => $assistant['realname'], 'ischeck' => 0, 'tid' => $mid, 'createtime' => time());
					$temp = pdo_insert('hc_deluxejjr_commission', $commission_team);
				}
			}
		}
		else 
		{
			$commission = array('opid' => $assistant['id'], 'ischeck' => 0, 'opname' => $assistant['realname'], 'createtime' => time());
			$temp = pdo_update('hc_deluxejjr_commission', $commission, array('cid' => $cid, 'mid' => $mid, 'status' => $_GPC['status']));
			if (!empty($_GPC['content'])) 
			{
				$creditlog = pdo_fetch('select * from' . tablename('hc_deluxejjr_credit') . 'where status = ' . $_GPC['status'] . ' and cid =' . $cid . ' and mid = ' . $mid . ' and uniacid =' . $uniacid);
				if (!empty($creditlog)) 
				{
					$credit = array('uniacid' => $uniacid, 'creditid' => $creditlog['id'], 'content' => trim($_GPC['content']), 'status' => $_GPC['status'], 'createtime' => time());
					pdo_insert('hc_deluxejjr_creditlog', $credit);
				}
			}
			if ($tjmid) 
			{
				$teamfy = pdo_fetchcolumn('select teamfy from' . tablename('hc_deluxejjr_rule') . 'where uniacid =' . $uniacid);
				if ($teamfy) 
				{
					$commission_team = array('opid' => $assistant['id'], 'opname' => $assistant['realname'], 'ischeck' => 0, 'createtime' => time());
					pdo_update('hc_deluxejjr_commission', $commission_team, array('cid' => $cid, 'mid' => $tjmid, 'status' => $_GPC['status']));
				}
			}
		}
		sendStatusChange($customer['openid'], $customer['realname'], $customer['mobile'], $pan[$customer['loupan']], date('Y-m-d H:i:s', $customer['createtime']), $status[$_GPC['status']], date('Y-m-d H:i:s', time()), $_GPC['content']);
		if (intval($customer['acid'])) 
		{
			$jlopenid = pdo_fetchcolumn('select openid from' . tablename('hc_deluxejjr_assistant') . 'where id = ' . $customer['acid']);
			sendStatusChange($jlopenid, $customer['realname'], $customer['mobile'], $pan[$customer['loupan']], date('Y-m-d H:i:s', $customer['createtime']), $status[$_GPC['status']], date('Y-m-d H:i:s', time()), $_GPC['content']);
		}
		if ($temp) 
		{
			echo 1;
		}
		else 
		{
			echo 0;
		}
		exit();
	}
	if ($_GPC['opp'] == 'pro') 
	{
		include $this->template('procus_index');
	}
	else 
	{
		include $this->template('gw_index');
	}
	exit();
}
if ($op == 'add') 
{
	$data = array('uniacid' => $uniacid, 'openid' => $openid, 'realname' => $_GPC['realname'], 'mobile' => $_GPC['mobile'], 'code' => $_GPC['code'], 'flag' => 0, 'createtime' => TIMESTAMP);
	$profile = pdo_fetch('SELECT code,id FROM ' . tablename('hc_deluxejjr_assistant') . ' WHERE flag = 0 and `uniacid` = :uniacid AND code=:code ', array(':uniacid' => $uniacid, ':code' => $_GPC['code']));
	if ($data['code'] == $profile['code']) 
	{
		echo '-1';
		exit();
	}
	$codes = pdo_fetchall('select id, code from ' . tablename('hc_deluxejjr_counselor') . 'where status = 1 and uniacid =' . $uniacid);
	$flag = true;
	foreach ($codes as $c ) 
	{
		if (trim($c['code']) == trim($_GPC['code'])) 
		{
			pdo_update('hc_deluxejjr_counselor', array('status' => 0), array('id' => $c['id']));
			$flag = false;
			break;
		}
	}
	if ($flag) 
	{
		echo -1;
		exit();
	}
	$counselor = pdo_fetch('select lid from ' . tablename('hc_deluxejjr_counselor') . ' where uniacid = ' . $uniacid . ' and code = \'' . $data['code'] . '\'');
	$data['lid'] = $counselor['lid'];
	pdo_insert('hc_deluxejjr_assistant', $data);
	echo 1;
	exit();
}
include $this->template('counselor');
?>