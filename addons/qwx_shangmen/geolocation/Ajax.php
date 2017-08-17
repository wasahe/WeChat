<?php   
//session_start();

$_SESSION["geolocation"]=$_POST["userLocation"];

echo $_SESSION["geolocation"];
//setcookie("geolocation",$_POST["userLocation"],time()+3600);
//$_COOKIE["userLocation"]=$_POST["userLocation"];

?> 