<?php
/*
  KuaiPan开放平台 PHP SDK 简化版，必须和kuaipan.class.php同目录
  编写：chenall
  主页: http://chenall.net
  来源: http://chenall.net/post/sdk_kp_php/
  时间: 2012-12-14
  使用方法例子：
   require_once('libs/kp.class.php');
   $kp = new kp(CONSUMER_KEY,CONSUMER_SECRET)
   $oauth = $kp->OAuth();
   
   更新记录：
   2012-12-26
    1.改写了一下KP.CLASS.PHP
      为了方便使用,修改了返回信息.具体看README
      像
      $ret = $kp->md('mytest');
      如果成功就返回新创建文件夹的ID,否则返回false,
   2012-12-14
    1.对PATH路径进行转码，这个路径必须是UTF-8编码,适应能力更强。
    2.上传时可以选择显示进度。
   2012-12-13
    1.download改成默认直接下载，可以附加参数false取得下载地址。
    2.upload修改，更简单。具体见README文件
*/
if (!function_exists('mb_check_encoding'))
	die('undefined function mb_check_encoding');
if (!function_exists('iconv') && !function_exists('mb_convert_encoding'))
	die("undefined function iconv or mb_convert_encoding");
require_once(dirname(__FILE__).'/kuaipan.class.php');
session_start();

function kp_upload_progress($download_size, $downloaded, $upload_size,$uploaded)
{
	if ($download_size)
		echo "D:".(round(($downloaded*100)/$download_size,2))."%\t\r";
	else if ($upload_size)
		echo "U:".(round(($uploaded*100)/$upload_size,2))."%\t\r";
	return 0;
}

class kp extends KuaiPan
{

	function __construct($consumer_key = '', $consumer_secret = '') {
		$this->consumer_key = $consumer_key;
		$this->consumer_secret = $consumer_secret;
	}

	/*
		OAuth 验证：
		 可以自己指定回调地址，你需要处理好回调过程。一般情况下直接使用默认的即可
	*/
	function OAuth($call_back = null)
	{
		if (isset($_GET['op']) && $_GET['op']=='oauth_authorize')//OAuth 第三步
		{
			// print_r($_SESSION);exit;
			$this->oauth_token = $_SESSION['oauth_token'];
			$this->oauth_token_secret = $_SESSION['oauth_token_secret'];
			if (empty($_SESSION['oauth_authorise']))
				return true;
			$_SESSION['oauth_authorise'] = null;
			$data = $this->accessToken();
			if (!empty($this->errstr))
				return false;
			$_SESSION['oauth_token_secret'] = $this->oauth_token = $data->oauth_token;
			$_SESSION['oauth_token_secret'] = $this->oauth_token_secret = $data->oauth_token_secret;
			//过期时间：
			$data->expires_time = time()+$data->expires_in;
			return $data;
		}
		empty($call_back) && $call_back = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].(empty($_SERVER['QUERY_STRING'])?'?':'&').'op=oauth_authorize';
		$data = $this->requestToken(array('oauth_callback'=>$call_back));//OAuth 第一步
		// echo $call_back;exit;
		if (!empty($this->errstr))
			return false;
		$_SESSION['oauth_token'] = $data->oauth_token;
		$_SESSION['oauth_token_secret'] = $data->oauth_token_secret;
		$_SESSION['oauth_authorise'] = 1;
		header('Location: https://www.kuaipan.cn/api.php?ac=open&op=authorise&oauth_token='.$data->oauth_token);//OAuth 第二步
	}

	function dir($path = '',$params = array())
	{
		$data = $this->metadata($params,self::realpath($path));
		if ($this->errstr)
			return false;
		$folders = array();
		$files = array();
		if (isset($data->files))
			$data = $data->files;
		else
			$data = array($data);
		foreach($data as $file)
		{
			$f = (object)array('name'=>$file->name,
							'create_time'=>$file->create_time,
							'modify_time'=>$file->modify_time,
							'file_id'=>$file->file_id,
							'size'=>$file->size,
							'isfolder'=>($file->type == "folder"?1:0));
			if ($file->type == "folder")
				$folders[] = $f;
			else
				$files[] = $f;
		}
		return array_merge($folders,$files);
	}

	function cp($from_path,$to_path)
	{
		$params = array(
			'root' => $this->root,
			'from_path' =>self::realpath($from_path),
			'to_path'=>self::realpath($to_path)
			);
		$ret = $this->copy($params);
		if (empty($ret->file_id))
			return false;
		return $ret->file_id;
	}

	function mv($from_path,$to_path)
	{
		$params = array(
			'root' => $this->root,
			'from_path' =>self::realpath($from_path),
			'to_path'=> self::realpath($to_path)
			);
		$this->move($params);
		return empty($this->errstr);
	}

	function md($path)
	{
		$params = array(
			'root'=>$this->root,
			'path'=>self::realpath($path));
		$res = $this->create_folder($params);
		if (isset($res->file_id))
			return $res->file_id;
		return false;
	}

	function rm($path,$to_recycle = "true")
	{
		$params = array(
			'to_recycle'=>$to_recycle,
			'root'=>$this->root,
			'path'=>self::realpath($path));
		$this->delete($params);
		return empty($this->errstr);
	}

	function download($path,$download = false)
	{
		$params = array(
			'root'=>$this->root,
			'path'=>self::realpath($path));
		$url = $this->download_file($params);
		if (!empty($this->errstr))
			return false;
		if ($download == false)
			return $url;
		header('Location: '.$url);
		exit();
	}

	function upload($path,$file,$progress = false)
	{
		// echo $file;exit;
		if (file_exists($file) === false)
		{
			$this->errstr = 'file not exist';
			return false;
		}

		$path = self::gbk_to_utf8($path);//必须使用UTF-8编码
		if (substr($path,-1,1) == '/')
		{
			$fn = self::gbk_to_utf8(trim(substr($file,strrpos($file,'/')),'/'));
			$path .= $fn;
		}
		else
			$fn = trim(substr($path,strrpos($path,'/')),'/');
		//这里就是$data的两种方法，可以直接是POST数据，也可以是CURLOPT参数。
		
		if (version_compare(phpversion(),"5.3",">=")){
			$data = $progress?//如果需要显示上传进度
					array(CURLOPT_PROGRESSFUNCTION=> 'kp_upload_progress',
							CURLOPT_NOPROGRESS => false,
							CURLOPT_POST=>true,
							CURLOPT_TIMEOUT => 3600,
							CURLOPT_POSTFIELDS=>array('file'=>'@'.$file.';filename='.$fn)):
							// CURLOPT_POSTFIELDS=>array('file'=>'@'.$file)):
					array('file'=>'@'.$file.';filename='.$fn);
					// array('file'=>'@'.$file);
		}else{
			$data = $progress?//如果需要显示上传进度
					array(CURLOPT_PROGRESSFUNCTION=> 'kp_upload_progress',
							CURLOPT_NOPROGRESS => false,
							CURLOPT_POST=>true,
							CURLOPT_TIMEOUT => 3600,
							// CURLOPT_POSTFIELDS=>array('file'=>'@'.$file.';filename='.$fn)):
							CURLOPT_POSTFIELDS=>array('file'=>'@'.$file)):
					// array('file'=>'@'.$file.';filename='.$fn);
					array('file'=>'@'.$file);
		}
		// echo $path;exit;
		
		$params = array(
			'overwrite'=>"true",
			'root'=>$this->root,
			'path'=>self::realpath($path));
			// print_r($data);exit;
		$ret = $this->upload_file($params,$data);
		if (empty($ret->file_id))
			return false;
		return $ret->file_id;
	}

	function gbk_to_utf8($string)
	{
		if (mb_check_encoding($string,'UTF-8'))
			return $string;
		if (function_exists('iconv'))
			return iconv("GBK","UTF-8//IGNORE",$string);
		return mb_convert_encoding($string,'UTF-8','GBK'); 
	}

	function realpath($path)//根据path变量返回实际路径。
	{
		$path = self::gbk_to_utf8($path);
		return (substr($path,0,1) == '/')?$path:$this->path.$path;
	}
}