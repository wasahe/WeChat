<?php

//decode by QQ:3213288469 http://www.zheyitianshi.com/
class LiveVideoComponent
{
	private $domain = 'live.api.qcloud.com/v2/index.php';
	function __construct()
	{
		$this->Region = sunshine_huayueModuleSite::$_SET['lvb_region'] ? sunshine_huayueModuleSite::$_SET['lvb_region'] : 'bj';
		$this->SecretKey = sunshine_huayueModuleSite::$_SET['lvb_secretkey'];
		$this->SecretId = sunshine_huayueModuleSite::$_SET['lvb_secretid'];
	}
	function commonParam($Action)
	{
		$p['Action'] = $Action;
		$p['Region'] = $this->Region;
		$p['Timestamp'] = time();
		$p['Nonce'] = rand(10000000, 99999999);
		$p['SecretId'] = $this->SecretId;
		return $p;
	}
	function createSign($paramArr)
	{
		ksort($paramArr);
		foreach ($paramArr as $k => $v) {
			$paramStr[] = $k . '=' . $v;
		}
		$srcStr = 'POST' . $this->domain . '?' . join($paramStr, '&');
		return base64_encode(hash_hmac('sha1', $srcStr, $this->SecretKey, true));
	}
	function sendPost($paramArr)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://' . $this->domain);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $paramArr);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$json = curl_exec($ch);
		curl_close($ch);
		return json_decode($json);
	}
	function CreateLVBChannel($channelName, $channelDescribe, $outputSourceType, $source_name, $source_type)
	{
		$p['channelName'] = $channelName;
		$p['channelDescribe'] = $channelDescribe;
		$p['outputSourceType'] = $outputSourceType;
		$p['sourceList.1.name'] = $source_name;
		$p['sourceList.1.type'] = $source_type;
		$p = array_merge($p, $this->commonParam(__FUNCTION__));
		$p['Signature'] = $this->createSign($p);
		return $this->sendPost($p);
	}
	function DescribeLVBChannelList($channelStatus, $pageNo, $pageSize)
	{
		$p['channelStatus'] = $channelStatus;
		$p['ascDesc'] = 1;
		$p['pageNo'] = $pageNo;
		$p['pageSize'] = $pageSize;
		$p = array_merge($p, $this->commonParam(__FUNCTION__));
		$p['Signature'] = $this->createSign($p);
		return $this->sendPost($p);
	}
	function DescribeLVBChannel($channelId)
	{
		$p['channelId'] = $channelId;
		$p = array_merge($p, $this->commonParam(__FUNCTION__));
		$p['Signature'] = $this->createSign($p);
		return $this->sendPost($p);
	}
	function DescribeLVBOnlineUsers($channelId)
	{
		$p = array();
		$p = array_merge($p, $this->commonParam(__FUNCTION__));
		$p = $this->commonParam(__FUNCTION__);
		$p['Signature'] = $this->createSign($p);
		return $this->sendPost($p);
	}
	function DeleteLVBChannel($channelId)
	{
		$p['channelIds.1'] = $channelId;
		$p = array_merge($p, $this->commonParam(__FUNCTION__));
		$p['Signature'] = $this->createSign($p);
		return $this->sendPost($p);
	}
	function StopLVBChannel($channelId)
	{
		$p['channelIds.1'] = $channelId;
		$p = array_merge($p, $this->commonParam(__FUNCTION__));
		$p['Signature'] = $this->createSign($p);
		return $this->sendPost($p);
	}
}