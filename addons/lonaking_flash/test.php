<?php

$content = file_get_contents(dirname(__FILE__)."/FlashCommonServiceMi.php");
$key = "/* PHP Encode by  http://we7.cc/ */";
echo $key;
$re = strpos($content,$key);
var_dump($re) ;