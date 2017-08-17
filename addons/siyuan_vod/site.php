<?php

defined('IN_IA') || exit('Access Denied');
class Siyuan_VodModuleSite extends WeModuleSite
{
	protected $modules_bindings;

	public function __construct()
	{
		global $_GPC;
		$this->modulename = 'siyuan_vod';
		$this->__define = IA_ROOT . '/addons/siyuan_vod/module.php';
		load()->model('module');
		$this->module = module_fetch($this->modulename);
		$dos = array('index', 'huodong', 'partner', 'my');
		$sql = 'SELECT eid,do FROM ' . tablename('modules_bindings') . 'WHERE `do` IN (\'' . implode('\',\'', $dos) . '\') AND `entry`=\'cover\' AND module=\'siyuan_vod\'';
		$this->modules_bindings = pdo_fetchall($sql, array(), 'do');
	}

	public function Checkeduseragent()
	{
		global $_W;
		global $_GPC;
		$set = pdo_fetch('SELECT name,ad,logo,qr,color,top_logo FROM ' . tablename('siyuan_vod_setting') . ' WHERE weid = :weid ', array(':weid' => $_W['uniacid']));
		$useragent = addslashes($_SERVER['HTTP_USER_AGENT']);

		if ((strpos($useragent, 'MicroMessenger') === false) && (strpos($useragent, 'Windows Phone') === false)) {
			include $this->template('pc');
			exit();
		}

	}
}

function getTopDomainhuo()
{
	$host = $_SERVER['HTTP_HOST'];
	$host = strtolower($host);

	if (strpos($host, '/') !== false) {
		$parse = @parse_url($host);
		$host = $parse['host'];
	}


	$topleveldomaindb = array('com', 'edu', 'gov', 'int', 'mil', 'net', 'org', 'biz', 'info', 'top', 'wang', 'pro', 'name', 'so', 'in', 'museum', 'coop', 'aero', 'xxx', 'idv', 'mobi', 'cc', 'me', 'co', 'asia');
	$str = '';

	foreach ($topleveldomaindb as $v ) {
		$str .= (($str ? '|' : '')) . $v;
	}

	$matchstr = '[^\\.]+\\.(?:(' . $str . ')|\\w{2}|((' . $str . ')\\.\\w{2}))$';

	if (preg_match('/' . $matchstr . '/ies', $host, $matchs)) {
		$domain = $matchs[0];
	}
	 else {
		$domain = $host;
	}

	return $domain;
}

