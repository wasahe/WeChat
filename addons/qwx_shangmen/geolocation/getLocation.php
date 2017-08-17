<?php
@session_start();
//echo substr(dirname(__FILE__), 0, -7);
echo"<iframe id='geoPage' width=0 height=0 frameborder=0  style='display:none;' scrolling='no' src='http://apis.map.qq.com/tools/geolocation?key=OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77&referer=myapp'> </iframe>
<script type='text/javascript' src='../addons/qwx_shangmen/geolocation/Ajax.js'></script>
<script type='text/JavaScript'>
var loc;var isPost=false;var myAddress='';window.addEventListener('message',function(B){loc=B.data;console.log('location',loc);if(loc&&(loc.module=='geolocation')){myAddress=loc.province+loc.city+loc.addr;var A=new Ajax();if(!isPost){isPost=true;A.post('../addons/qwx_shangmen/geolocation/Ajax.php','userLocation='+myAddress,function(C){})}}},false);	
</script>";
?>