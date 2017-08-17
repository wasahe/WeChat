<?php

//decode by QQ:3213288469 http://www.zheyitianshi.com/
class LivePlayComponent
{
	private $domain;
	private $path;
	private $server;
	public function __construct()
	{
		$this->domain = 'api.open.letvcloud.com';
		$this->path = '/live/execute?';
		$this->server = $this->domain . $this->path;
		$settings = sunshine_huayueModuleSite::$_SET;
		$this->secretkey = $settings['letv_secretkey'];
		$this->userid = $settings['letv_userid'];
	}
	public function createCommonParam($method, $ver)
	{
		$p['timestamp'] = $this->createMicroTime();
		$p['method'] = $method;
		$p['ver'] = $ver;
		$p['userid'] = $this->userid;
		return $p;
	}
	public function createMicroTime()
	{
		list($ms, $s) = explode(' ', microtime());
		return floor($s * 1000 + $ms * 1000);
	}
	public function createSign($param)
	{
		ksort($param);
		foreach ($param as $k => $v) {
			$paramArr[] = $k . $v;
		}
		$str = join('', $paramArr) . $this->secretkey;
		return md5($str);
	}
	public function sendGet($p, $method, $ver = '3.1')
	{
		foreach ($p as $k => $v) {
			if ($v === '') {
				unset($p[$k]);
			}
		}
		$pArr = array_merge($this->createCommonParam($method, $ver), $p);
		$pArr['sign'] = $this->createSign($pArr);
		foreach ($pArr as $k => $v) {
			$paramArr[] = $k . '=' . $v;
		}
		$url = join('&', $paramArr);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://' . $this->server . $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$json = curl_exec($ch);
		curl_close($ch);
		return json_decode($json);
	}
	public function sendPost($p, $method, $ver = '3.1')
	{
		foreach ($p as $k => $v) {
			if ($v === '') {
				unset($p[$k]);
			}
		}
		$pArr = array_merge($this->createCommonParam($method, $ver), $p);
		$pArr['sign'] = $this->createSign($pArr);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://' . $this->server);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $pArr);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$json = curl_exec($ch);
		curl_close($ch);
		return json_decode($json);
	}
	public function info($activityId)
	{
		$method = 'lecloud.cloudlive.vrs.activity.vrsinfo.search';
		$ver = '3.1';
		$p['activityId'] = $activityId;
		return $this->sendGet($p, $method);
	}
	public function getList($offSet = 0, $fetchSize = 20)
	{
		$method = 'lecloud.cloudlive.vrs.activity.vrsinfo.search';
		$ver = '3.1';
		$p['offSet'] = $offSet;
		$p['fetchSize'] = $fetchSize;
		return $this->sendGet($p, $method);
	}
	public function createActivity($activityName, $startTime, $endTime, $coverImgUrl, $description, $codeRateTypes, $playMode)
	{
		$method = 'lecloud.cloudlive.activity.create';
		$ver = '3.1';
		$p['activityName'] = $activityName;
		$p['startTime'] = $startTime;
		$p['endTime'] = $endTime;
		$p['coverImgUrl'] = $coverImgUrl;
		$p['description'] = $description;
		$p['liveNum'] = 1;
		$p['codeRateTypes'] = '13,16,19';
		$p['needRecord'] = 1;
		$p['needTimeShift'] = 1;
		$p['activityCategory'] = 999;
		$p['playMode'] = $playMode;
		return $this->sendPost($p, $method);
	}
	public function modifyActivityInfo($activityId, $startTime, $endTime)
	{
		$method = 'lecloud.cloudlive.vrs.activity.vrsinfo.modify';
		$p['activityId'] = $activityId;
		$p['startTime'] = $startTime;
		$p['endTime'] = $endTime;
		$p['extensions'] = '';
		return $this->sendPost($p, $method);
	}
	public function getPushAddr($activityId)
	{
		$method = 'lecloud.cloudlive.activity.getPushUrl';
		$p['activityId'] = $activityId;
		return $this->sendGet($p, $method);
	}
	public function getMachineStatus($activityId)
	{
		$method = 'letv.cloudlive.activity.getActivityMachineState';
		$p['activityId'] = $activityId;
		return $this->sendGet($p, $method);
	}
	public function setSafe($activityId)
	{
		$method = 'lecloud.cloudlive.activity.sercurity.config';
		$p['activityId'] = $activityId;
		$p['neededPushAuth'] = 0;
		$p['needIpWhiteList'] = 0;
		$p['needPlayerDomainWhiteList'] = 0;
		return $this->sendPost($p, $method);
	}
}