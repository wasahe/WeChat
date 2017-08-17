<?php if (!$weixin_get_fans_location || $_SESSION['weixin_get_fans_location'] == '全国'){?>    
	<script type="text/javascript" src="../addons/qwx_shangmen/js/jquery.js"></script>
	<script type="text/javascript" src="http://3gimg.qq.com/lightmap/components/geolocation/geolocation.min.js"></script>
    <script type="text/javascript" src="../addons/qwx_shangmen/js/layer/layer-pc.js"></script>.
    <script type="text/JavaScript">
	var index = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
	
        var geolocation = new qq.maps.Geolocation("OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77", "myapp");

        var positionNum = 0;
        var options = {timeout: 8000};
		var get_location_flag = false;
        function showPosition(position) {
			//alert(JSON.stringify(position, null, 4));return;
			var fans_location_json = JSON.stringify(position, null, 4);
			get_location_flag = true;
			//alert(fans_location_json);
			$.post('<?php echo $_save_from_url;?>', {'fans_location_json':fans_location_json}, function(data) {
				if (data.success == true) {
						//alert(data.msg);
						location.href = '<?php echo $_save_from_url;?>';
				} else {
						alert(data.msg);
				}
			},"json"); 
			
			return;
            positionNum ++;
            document.getElementById("demo").innerHTML += "序号：" + positionNum;
            document.getElementById("demo").appendChild(document.createElement('pre')).innerHTML = JSON.stringify(position, null, 4);
            document.getElementById("pos-area").scrollTop = document.getElementById("pos-area").scrollHeight;
        };

        function showErr() {
            positionNum ++;
            document.getElementById("demo").innerHTML += "序号：" + positionNum;
            document.getElementById("demo").appendChild(document.createElement('p')).innerHTML = "定位失败！";
            document.getElementById("pos-area").scrollTop = document.getElementById("pos-area").scrollHeight;
        };

        function showWatchPosition() {
            document.getElementById("demo").innerHTML += "开始监听位置！<br /><br />";
            geolocation.watchPosition(showPosition);
            document.getElementById("pos-area").scrollTop = document.getElementById("pos-area").scrollHeight;
        };

        function showClearWatch() {
            geolocation.clearWatch();
            document.getElementById("demo").innerHTML += "停止监听位置！<br /><br />";
            document.getElementById("pos-area").scrollTop = document.getElementById("pos-area").scrollHeight;
        };
        var user_gps_get_times = 0;
		function get_location_fun() {
			geolocation.getLocation(showPosition, showErr, options);
                        user_gps_get_times += 1;
                        if (get_location_flag == false) {
                            if (user_gps_get_times >= 3) {
                                alert('您未开启GPS服务！');
                                $.post('<?php echo $_save_from_url;?>', {'fans_location_json':'no_open'}, function(data) {
                                        if (data.success == true) {
                                                        //alert(data.msg);
                                                        location.href = '<?php echo $_save_from_url;?>';
                                        } else {
                                                        alert(data.msg);
                                        }
                                },"json");                                 
                            }
                            setTimeout("get_location_fun()", 3000)
                        }                       
		}
		geolocation.getLocation(showPosition, showErr, options);
                if (get_location_flag == false) {
                    user_gps_get_times += 1;
                        setTimeout("get_location_fun()", 3000)
                }                
    </script>
<?php }?>