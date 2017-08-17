<?php
$location_c_cookie = 'location_c_cookie' . $uniacid;
$location_c = $_GPC['location_c'];
if (!empty($location_c)) 
{
	setcookie($location_c_cookie, $location_c, time() + (3600 * 24 * 30));
	$url = $this->createMobileUrl('index');
	message('正在为你匹配所选择城市...', $url);
}
if ($op == 'area') 
{
	$location_ps = pdo_fetchall('select distinct location_p from ' . tablename('hc_deluxejjr_loupan') . ' where isview = 1 and uniacid = ' . $uniacid);
	$location_cs = pdo_fetchall('select distinct location_p,location_c from ' . tablename('hc_deluxejjr_loupan') . ' where isview = 1 and uniacid = ' . $uniacid);
	include $this->template('area');
	exit();
}
if (!empty($openid)) 
{
	if ($uid) 
	{
		$myheadimg = pdo_fetchcolumn('select avatar from ' . tablename('mc_members') . ' where uid = ' . $uid);
		if (empty($myheadimg)) 
		{
			$myheadimg = '../addons/hc_deluxejjr/style/images/header.png';
		}
	}
	$profile = pdo_fetch('SELECT * FROM ' . tablename('hc_deluxejjr_member') . ' WHERE  uniacid = :uniacid  AND openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
	$id = $profile['id'];
	if (intval($id) && ($profile['status'] == 0)) 
	{
		include $this->template('forbidden');
		exit();
	}
	if (intval($id)) 
	{
		$mycustomer = pdo_fetchcolumn('SELECT count(*) FROM ' . tablename('hc_deluxejjr_customer') . ' WHERE  uniacid = :uniacid  AND openid = :openid', array(':uniacid' => $uniacid, ':openid' => $openid));
		$mycommission = pdo_fetchcolumn('SELECT sum(`commission`) FROM ' . tablename('hc_deluxejjr_commission') . ' WHERE flag != 2 and ischeck = 1 and  uniacid = :uniacid  AND mid = :mid', array(':uniacid' => $uniacid, ':mid' => $id));
		$mycommission = ((!empty($mycommission) ? $mycommission : 0));
		$idcommissions = pdo_fetchall('select * from ' . tablename('hc_deluxejjr_idcommission') . ' where identityid = ' . $profile['identity'] . ' and uniacid = ' . $uniacid);
		$idcommission = array();
		foreach ($idcommissions as $i ) 
		{
			$idcommission[$i['lid']] = $i['commission'];
		}
		$identitys = pdo_fetchall('select id from ' . tablename('hc_deluxejjr_identity') . ' where uniacid = ' . $uniacid . ' order by cuspri desc');
		$identity = $identitys[0]['id'];
		$allexp = pdo_fetchcolumn('select sum(exp) from ' . tablename('hc_deluxejjr_experience') . ' where uniacid = ' . $uniacid . ' and mid = ' . $profile['id']);
		$allexp = ((empty($allexp) ? 0 : $allexp));
		$explevels = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_explevel') . ' WHERE uniacid = \'' . $_W['uniacid'] . '\' ORDER BY displayorder desc');
		foreach ($explevels as $e ) 
		{
			if ($e['min'] <= $allexp) 
			{
				$explevel = $e;
				break;
			}
		}
	}
}
if (!$id) 
{
	$identitys = pdo_fetchall('select id from ' . tablename('hc_deluxejjr_identity') . ' where uniacid = ' . $uniacid . ' order by cuspri desc');
	$identity = $identitys[0]['id'];
	if (!empty($identity)) 
	{
		$idcommissions = pdo_fetchall('select * from ' . tablename('hc_deluxejjr_idcommission') . ' where identityid = ' . $identity . ' and uniacid = ' . $uniacid);
		$idcommission = array();
		foreach ($idcommissions as $i ) 
		{
			$idcommission[$i['lid']] = $i['commission'];
		}
	}
}
$location_c = $_COOKIE[$location_c_cookie];
if ($rule['isselect_city'] == 1) 
{
	if (empty($location_c)) 
	{
		$url = $this->createMobileUrl('index', array('op' => 'area'));
		message('请先选择城市！', $url);
	}
}
$location_as = pdo_fetchall('select distinct location_a from ' . tablename('hc_deluxejjr_loupan') . ' where uniacid = ' . $uniacid . ' and location_c = \'' . $location_c . '\'');
if (empty($location_c)) 
{
	$loupans = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE (id_view = \'\' || id_view like \'%,' . $profile['identity'] . ',%\') and `uniacid` = :uniacid and `isview` = 1 ORDER BY displayorder DESC', array(':uniacid' => $uniacid));
}
else 
{
	$location_a = trim($_GPC['location_a']);
	if (!empty($location_a)) 
	{
		$loupans = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE (id_view = \'\' || id_view like \'%,' . $profile['identity'] . ',%\') and `uniacid` = :uniacid and `isview` = 1 and location_c = \'' . $location_c . '\' and location_a = \'' . $location_a . '\' ORDER BY displayorder DESC', array(':uniacid' => $uniacid));
		$location_c = $location_a;
	}
	else 
	{
		$loupans = pdo_fetchall('SELECT * FROM ' . tablename('hc_deluxejjr_loupan') . ' WHERE (id_view = \'\' || id_view like \'%,' . $profile['identity'] . ',%\') and `uniacid` = :uniacid and `isview` = 1 and location_c = \'' . $location_c . '\' ORDER BY displayorder DESC', array(':uniacid' => $uniacid));
	}
}
$success_key = sizeof($this->ProcessStatus()) - 1;
$customers_1 = pdo_fetchall('select count(id) as num, loupan from ' . tablename('hc_deluxejjr_customer') . ' where status = 1 and uniacid = ' . $uniacid . ' group by loupan');
$customers_success_key = pdo_fetchall('select count(id) as num, loupan from ' . tablename('hc_deluxejjr_customer') . ' where status = ' . $success_key . ' and uniacid = ' . $uniacid . ' group by loupan');
$loupan_cusnum = array();
foreach ($customers_1 as $c ) 
{
	$loupan_cusnum[1][$c['loupan']] = $c['num'];
}
foreach ($customers_success_key as $c ) 
{
	$loupan_cusnum[$success_key][$c['loupan']] = $c['num'];
}
if ($rule['isopen'] == 1) 
{
	$areas = pdo_fetchall('select distinct location_c from ' . tablename('hc_deluxejjr_loupan') . ' where uniacid = ' . $uniacid . ' and isview = 1 and iscity = 1 order by displayorder desc');
}
$advs = pdo_fetchall('select * from ' . tablename('hc_deluxejjr_adv') . ' where enabled=1 and uniacid = ' . $uniacid . ' order by displayorder asc');
foreach ($advs as &$adv ) 
{
	if (substr($adv['link'], 0, 5) != 'http:') 
	{
		$adv['link'] = 'http://' . $adv['link'];
	}
}
unset($adv);
if (empty($location_c)) 
{
	$location_c = '全国';
}
include $this->template('index');
?>