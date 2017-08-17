<?php include DISCUZ_ROOT .'source/plugin/xigua_114/template/header.php'?>
<?php //if($config['nohead']):?><!--<style>.topnav{display:none!important;}.pt-page, .allmap{padding-top:0 }</style>--><?php //endif;?>
<div class="topnav pa">
    <a class="home-return" href="javascript:window.history.go(-1);"><?php echo $title?></a>
    <h2 class="hd"><?php echo $title?></h2>
    <?php if($config['topjoin']){ ?><a class="joinnow" href="plugin.php?id=xigua_114&mobile=no&ac=join"><?php echo $config['topjoin'] ?></a><?php } ?>
</div>
<div class="" id="allmap" style="height:94%"><div id="allmap-inner"><div class="ajxloading-large"></div></div></div>
<a style="position:absolute;bottom:0;left:0" id="navguide" class="btn btn-outline iterateEffects"><?php x1l('guidenav') ?></a>


<script src="http://map.qq.com/api/js?v=2.exp" type="text/javascript"></script>
<?php if(!$info['lat']){ ?>
<script>
    var geocoder, map, marker = null;
    var init = function() {
        geocoder = new qq.maps.Geocoder();
        geocoder.getLocation('<?php echo $addrs ?>');
        geocoder.setComplete(function(result) {
            var center = result.detail.location;
            marker = center;
//            console.log(center);
            document.getElementById('navguide').href = "http://apis.map.qq.com/uri/v1/marker?marker=coord:"+marker.lat+","+marker.lng+";title:<?php echo $info['company_name'] ?>;addr:<?php echo $addr ?>";
            var map = new qq.maps.Map(document.getElementById('allmap'),{
                center: center,
                zoom: 15
            });
            var infoWin = new qq.maps.InfoWindow({
                map: map
            });
            infoWin.open();
            infoWin.setContent('<h3><?php echo $addr ?></h3><p><?php echo strip_tags(str_replace(array("\t","\r","\n"), $desc)) ?></p><p><a href="tel:<?php echo $info['phone'] ?>"><?php x1l('company_phone');echo ':'.$info['phone'] ?></a></p>');
            infoWin.setPosition(center);
        });
        geocoder.setError(function() {
            alert("<?php x1l('shanger') ?>");
        });
    };
window.onload = function(){ init(); };
</script>
<?php }else{?>
<script>
    var geocoder, map, marker = null;
    var init = function() {
        var center = new qq.maps.LatLng(<?php echo $info['lat'] ?>,<?php echo $info['lng'] ?>);
        document.getElementById('navguide').href = "http://apis.map.qq.com/uri/v1/marker?marker=coord:<?php echo $info['lat'] ?>,<?php echo $info['lng'] ?>;title:<?php echo $info['company_name'] ?>;addr:<?php echo $addr ?>";
        var map = new qq.maps.Map(document.getElementById('allmap'),{
            center: center,
            zoom: 15
        });
        var infoWin = new qq.maps.InfoWindow({
            map: map
        });
        infoWin.open();
        infoWin.setContent('<h3><?php echo $addr ?></h3><p><?php echo strip_tags(str_replace(array("\t","\r","\n"), $desc)) ?></p><p><a href="tel:<?php echo $info['phone'] ?>"><?php x1l('company_phone');echo ':'.$info['phone'] ?></a></p>');
        infoWin.setPosition(center);
    };
    window.onload = function(){ init(); };
</script>
<?php } ?>
</body>
</html>
