<?php include DISCUZ_ROOT .'source/plugin/xigua_114/template/header.php'?>
<?php $cm = $company;?>
<?php if($config['nohead']):?><style>.topnav{display:none!important;}.pt-page, .container_map{padding-top:0 }</style><?php endif;?>
<?php if($config['lunheight']):?><style>.banner img{height:<?php echo $config['lunheight']?$config['lunheight']:'200' ?>px}</style><?php endif;?>
<div class="container_map" id="container_map">
<div class="topnav">
    <a class="home-return" href="<?php echo $_GET['from'] ? $_G['siteurl'].'plugin.php?id=xigua_114' :'javascript:window.history.go(-1);';?>"><?php echo $title?> <?php if($company['v']){?><i class="vip"></i><?php }?></a>
    <h2 class="hd"><?php echo $title?></h2>
    <?php if($config['topjoin']){ ?><a class="joinnow" href="plugin.php?id=xigua_114&mobile=no&ac=join"><?php echo $config['topjoin'] ?></a><?php } ?>
</div>
<?php
if(!$cm['cover']){ $cm['cover'] = 'source/plugin/xigua_114/static/d.png';}
if($cm['cover']){?>
<div class="banner nom swipe cl">
    <div class="swipe-wrap">
    <?php foreach ($tmp=array_filter(explode("\t", trim($cm['cover']))) as $item) { ?>
        <div><a><img src="<?php echo $item?>" /></a></div>
    <?php } ?>
    </div>
    <nav class="bullets compage"><em class="imgnum">1</em>/<em><?php echo count($tmp) ?></em></nav>
    <?php if($config['showvi']){ ?>
    <div class="comviews">
        <span><?php echo $config['viewsword'] ?></span>
        <span><!--<i class="icon iconfont icon-attention" style="font-size:12px"></i>--> <?php echo $cm['views'] ?></span>
    </div><?php } ?>
    <?php if($config['showsh']){ ?>
    <div class="comshares" id="wechatshare">
        <i class="icon iconfont icon-share"></i>
        <span><?php echo $cm['shares'] ?></span>
    </div><?php } ?>
</div>
<?php }?>
<ul class="cl company-card noborder nomb">
    <li class="pt15">
        <div class="left">
            <img src="<?php echo $cm['logo']?>" alt="<?php echo $title?>">
        </div>
        <?php if($cm['company_desc']){?>
        <div class="desc"><?php echo nl2br($cm['company_desc'])?></div>
        <?php }else{?>
        <div class="title"><?php echo $cm['company_name']?></div>
        <?php }?>
    </li>
</ul>

<ul class="cl company-card noborder nomt">
    <li>
        <a href="tel:<?php echo $cm['phone']?>" class="phone">
            <div class="upper"><?php echo $cm['phone']?></div>
            <div class="suber"><?php x1l('hotline_')?></div>
            <div class="right-icon">
                <div class="circle circle-largephone circle-wegreen"><i class="icon-phone"></i></div>
            </div>
        </a>
    </li>
<?php if($cm['address']){?>
    <li>
        <a href="plugin.php?id=xigua_114&mobile=no&ac=map&company=<?php echo $cm['id']?>" class="more-info-link phone" style="height:auto;padding-right:60px;">
            <div class="upper"><?php x1l('address')?></div>
            <div class="suber"><?php echo $cm['city'].$cm['dist'].$cm['address']?></div>
        </a>
    </li>
<?php }?>
<?php if(/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */ $cm['lat']){?>
    <li>
        <a href="plugin.php?id=xigua_114&mobile=no&ac=map&company=<?php echo $cm['id']?>" class="more-info">
            <div class="upper" id="nearbygeo"><?php x1l('near_s');echo $cm['company_name']?></div>
            <div class="right-icon-thin">
                <div class="circle circle-red"><i class="icon-map-marker"></i></div>
            </div>
        </a>
        <iframe id="geoPage" width=0 height=0 frameborder=0  style="display:none;" scrolling="no" src="https://apis.map.qq.com/tools/geolocation?key=OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77&referer=myapp">
        </iframe>
        <script>
            window.addEventListener('message', function(event) {

                var loc = event.data;
                if(!loc){
                    return;
                }

                lat =loc.lat ;
                lng =loc.lng;
                if(!(lat &&lng)){
                    return ;
                }

                $.get('<?php echo $_G['siteurl'].'plugin.php?id=xigua_114&inajax=1&mobile=no&ac=getgeo&lat='.$cm['lat'].'&lng='.$cm['lng'].'&lat1='; ?>'+lat+'&lng1='+lng, function (data) {
                    $('#nearbygeo').html(data);
                });
            }, false);

        </script>
    </li>
<?php }?>
</ul>

<div class="company-list-head"><?php x1l('more')?></div>
<ul class="cl company-card nomt">
<?php if($cm['qr'] || $cm['wechat']){?>
    <li>
        <a id="wechat" href="javascript:;" class="more-info">
            <div class="upper"><?php x1l('wechat'); echo ' '.$cm['wechat']?></div>
            <div class="right-icon-thin">
                <div class="circle circle-wegreen"><i class="icon-wechat"></i></div>
            </div>
        </a>
    </li>
<?php }?>
<?php if($cm['weibo']){?>
    <li>
        <a href="<?php echo $cm['weibo']?>" class="more-info">
            <div class="upper"><?php x1l('weibo_')?></div>
            <div class="right-icon-thin">
                <div class="circle circle-white"><img src="source/plugin/xigua_114/static/weibo.png" /></div>
            </div>
        </a>
    </li>
<?php }?>
<?php if($cm['qq']){?>
    <li>
        <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $cm['qq']?>&site=qq&menu=yes" class="more-info">
            <div class="upper"><?php x1l('qq');echo ' '.$cm['qq']; ?></div>
            <div class="right-icon-thin">
                <div class="circle circle-dred"><i class="icon-qq"></i></div>
            </div>
        </a>
    </li>
<?php }?>
<?php if($cm['site']){?>
    <li>
        <a href="<?php echo $cm['site']?>" class="more-info-link">
            <div class="upper"><?php x1l('site_')?></div>
        </a>
    </li>
<?php }?>
    <li>
        <a href="plugin.php?id=xigua_114&mobile=no&ac=report" class="more-info-link">
            <div class="upper"><?php x1l('report_title')?></div>
        </a>
    </li>

</ul>

<!--other start-->
<?php if($config['aboutsh']){ ?>
<script src="source/plugin/xigua_114/static/jquery-1.7.1.min.js?t=201403261231"></script>
<div style="margin-top:20px">
    <h3 class="cl company-card" style="border:0"><?php echo $config['aboutsh'] ?><a class="fr" href="plugin.php?id=xigua_114&mobile=no&ac=cat&city=&catid=<?php echo $catinfo['id'] ?>&tt=1" style="float:right"><?php echo $catinfo['name'] ?></a></h3>
    <div id="datcat">
        <div class="ajxloading"></div>
    </div>
    <script>
        $.post('<?php echo $_G['siteurl'].'plugin.php?id=xigua_114&inajax=1&mobile=no&ac=cat&notme='.$cm['id'].'&catid='.$catinfo['id']?>',
            {page: 1, formhash:'<?php echo FORMHASH?>'},
            function (data) {
                $('#datcat').html(data);
            });
    </script>
</div>
<?php } ?>
<!--other end-->
<?php if($config['pinglun']){
    echo $config['pinglun'];
} ?>

<div class="company-card-pop" id="xg_box">
    <div class="company-card-inner animated">
<?php if($cm['qr'] && IN___WECHAT){?>
        <div class="company-card-noqr">
            <img src="<?php echo $cm['qr']?>" />
        </div>
        <div class="p noborder">
            <?php echo sprintf(x1l('hold_guide', 0), $cm['wechat']);?>
        </div>
<?php }else{?>
        <div class="company-card-noqr">
            <a href="javascript:;"></a>
        </div>
        <div class="p">
            <?php echo sprintf(x1l('search_guide', 0), $cm['wechat']);?>
        </div>
        <div class="subp"><?php echo sprintf(x1l('guide', 0), $cm['wechat']);?></div>
<?php }?>
        <a id="close_wechat" class="btn btn-outline"><?php x1l('know')?></a>
    </div>
</div>
<a class="share_wechat" id="share_wechat"></a>
<footer>
    <a href="plugin.php?id=xigua_114&mobile=no&ac=join"><?php echo $config['jointip']?></a>
</footer>
<div id="wechat-mask"><div id="wechat-guider"></div></div>
<script src="source/plugin/xigua_114/static/slider.js"></script>
    <?php if($config['customcolor']){ ?>
        <style>.weui_tabbar_item.weui_bar_item_on .weui_tabbar_icon,.weui_tabbar_item.weui_bar_item_on .weui_tabbar_label {
                color:<?php echo $config['customcolor'] ?>;
            }</style>
    <?php } ?>
    <div class="weui_tabbar footer">
        <a href="plugin.php?id=xigua_114&mobile=no" class="weui_tabbar_item <?php if($_GET['ac']=='index'){echo 'weui_bar_item_on';} ?>">
            <div class="weui_tabbar_icon">
                <i class="icon iconfont icon-home"></i>
            </div>
            <p class="weui_tabbar_label"><?php x1l('index') ?></p>
        </a>
        <a href="tel:<?php echo $cm['phone']?>" class="weui_tabbar_item  <?php if($_GET['ac']=='rank'){echo 'weui_bar_item_on';} ?>">
            <div class="weui_tabbar_icon">
                <i class="icon iconfont icon-tel" style="font-size:20px!important" ></i>
            </div>
            <p class="weui_tabbar_label"><?php x1l('bo1') ?></p>
        </a>
        <a href="javascript:;" id="wechat1" class="weui_tabbar_item <?php if($_GET['ac']=='cat'){echo 'weui_bar_item_on';} ?>">
            <div class="weui_tabbar_icon">
                <i class="icon iconfont icon-weixin1"></i>
            </div>
            <p class="weui_tabbar_label"><?php x1l('wechat') ?></p>
        </a>
        <a href="plugin.php?id=xigua_114&mobile=no&ac=join" class="weui_tabbar_item">
            <div class="weui_tabbar_icon">
                <i class="icon iconfont icon-my"></i>
            </div>
            <p class="weui_tabbar_label"><?php x1l('joind') ?></p>
        </a>
    </div>
    <script src="source/plugin/xigua_114/static/jquery-1.7.1.min.js?t=201403261231"></script>
    <script>
        $(function(){
            $(".btn").on("touchstart",function() {
                $(this)[0].classList.add('active');
                if($(this).attr('data-to')){
                    return false;
                }
            }).on("touchend",function() {
                $(this)[0].classList.remove('active');
            });
        });
    </script>
<script>
var box = $('#xg_box'), inner = box.find('div.company-card-inner');
$('#wechat,#wechat1').on('click', function(){
    box.show();
    inner.removeClass('zoomOut');
    inner.addClass('bounceIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass('bounceIn');
        return false;
    });
});

$('#close_wechat').on('click', function(){
    box.fadeOut();
    inner.removeClass('bounceIn');
    inner.addClass('zoomOut').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass('zoomOut');
        return false;
    });
});

$(function() {
    function runslider(_this, auto) {
        var bullets = _this.find('nav.bullets');
        var position = _this.find('ul.position');
        new Swipe2(_this[0], {
            startSlide: 0, speed: 500, auto: auto, continuous: true, callback: function (index) {
                if (bullets.length > 0) {
                    index = index%bullets.find('em:last-child').text();
                    bullets.find('em:first-child').text(index + 1);
                }
                if (position.length > 0) {
                    var selectors = position[0].children;
                    for (var t = 0; t < selectors.length; t++) {
                        selectors[t].className = selectors[t].className.replace("current", "");
                    }
                    selectors[(index) % (selectors.length)].className = "current";
                }
            }
        });
    }

    $('div.swipe').each(function () {
        runslider($(this), 3000);
        $(this).css('height', 'auto');
    });
    $.post('plugin.php?id=xigua_114:incr&mobile=no&views=<?php echo $cm['id'] ?>', 'formhash=<?php echo FORMHASH ?>');
});
var vars ={};
$(document).ready(function() {
    vars.hb = $('body,html');
    vars.$body = $("body");
    vars.$myScroll = null;
    vars.$window = $(window);
    vars.$wechat = vars.$body.find('#wechatshare');
    vars.$wechatmask = vars.$body.find('#wechat-mask');
    vars.$wechatguider = vars.$body.find('#wechat-guider');


    if(vars.$wechat.length){
        vars.$wechat.on('click',function(){
            vars.$wechatmask.show();
            Anmi(vars.$wechatguider, 'fadeInUp', 'fast');
            Anmi(vars.$wechatmask, 'fadeIn', 'normal');
        });
        vars.$wechatmask.on('click',function(){
            Anmi(vars.$wechatguider, 'fadeOutUp', 'fast');
            Anmi(vars.$wechatmask, 'fadeOut', 'normal', function(){
                vars.$wechatmask.hide();
            });
        });
    }
});

function Anmi(obj, x, fast, callback) {
    var ani = ' animated';
    if(fast == 'fast'){
        ani = ' animated-fast';
    }
    obj.removeClass().addClass(x + ani).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
        if(callback && typeof callback == 'function') {
            callback();
        }
    });
}
</script>
<?php if($signature){?>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
var title = '<?php echo $title?>';
var desc = '<?php echo $cm['company_desc'] ? (strip_tags(str_replace(array("\n","\r"), '', $cm['company_desc']))) : ($cm['company_name'])?>';
var link = '<?php echo $cururl?>';
var imgUrl = '<?php echo $cm['logo']?>';

wx.config({
  debug:false,
  appId: '<?php echo $config['appid']?>',
  timestamp: <?php echo $timestamp?>,
  nonceStr: '<?php echo $noncestr?>',
  signature: '<?php echo $signature?>',
  jsApiList: [
      'onMenuShareTimeline',
      'onMenuShareAppMessage',
      'onMenuShareQQ',
      'onMenuShareWeibo',
  ]
});
wx.ready(function () {
    wx.onMenuShareAppMessage({
        title: title,
        desc: desc,
        link: link,
        imgUrl: imgUrl,success:function(){ shareed();}
    });
    wx.onMenuShareTimeline({
        title: title,
        link: link,
        imgUrl: imgUrl,success:function(){ shareed();}
    });
    wx.onMenuShareQQ({
        title: title,
        desc: desc,
        link: link,
        imgUrl: imgUrl,success:function(){ shareed();}
    });
    wx.onMenuShareWeibo({
        title: title,
        desc: desc,
        link: link,
        imgUrl: imgUrl,success:function(){ shareed();}
    });
});
function shareed() {
    $.post('plugin.php?id=xigua_114:incr&mobile=no&shares=<?php echo $cm['id'] ?>', 'formhash=<?php echo FORMHASH ?>');
    Anmi(vars.$wechatguider, 'fadeOutUp', 'fast');
    Anmi(vars.$wechatmask, 'fadeOut', 'normal', function(){
        vars.$wechatmask.hide();
    });
    $('#wechatshare span').text(parseInt($('#wechatshare span').text())+1);
}
</script><?php }?>

</body>
</html>