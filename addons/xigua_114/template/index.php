<?php include DISCUZ_ROOT .'source/plugin/xigua_114/template/header.php'?>
<?php if($config['nohead']):?><style>.topnav{display:none!important;}.pt-page, .container_map{padding-top:0 }</style><?php endif;?>
<?php if($config['customcolor']):?><style>
.buttons-tab .button.active{color:<?php echo $config['customcolor'] ?>;border-color:<?php echo $config['customcolor'] ?>}
.buttons-tab .button.active:before{border-top:1px solid <?php echo $config['customcolor'] ?>;color:<?php echo $config['customcolor'] ?>}
</style><?php endif;?>
<div class="container_map">
    <div class="topnav">
        <a class="home-return" href="javascript:window.history.go(-1);"><?php echo $title?></a>
        <h2 class="hd"><?php echo $title?></h2>
        <?php if($config['topjoin']){ ?><a class="joinnow" href="plugin.php?id=xigua_114&mobile=no&ac=join"><?php echo $config['topjoin'] ?></a><?php } ?>
    </div>
    <div class="banner">
        <form action="plugin.php" method="get" id="form114">
            <input type="hidden" name="id" value="xigua_114" />
            <input type="hidden" name="ac" value="search" />
            <input type="hidden" name="formhash" value="<?php echo FORMHASH?>" />
            <input class="form-search" type="search" name="phonename" autocomplete="off" placeholder="<?php echo $config['searchlabel']?>" />
            <a href="javascript:;" id="form-clear" class="form-clear"></a>
            <a href="javascript:;" id="form114submit" class="form114submit"></a>
        </form>
    </div>
    <div class="swipe cl">
        <div class="swipe-wrap">
            <?php foreach ($sliders as $slider) { ?>
            <div><a href="<?php echo $slider['adlink'] ? $slider['adlink'] : $slider['link']?>"><img onerror="this.src='source/plugin/xigua_114/static/nopic.jpg';this.error=null;" src="<?php echo $slider['adimage']?>" /></a></div>
            <?php }?>
        </div>
        <nav class="bullets">
            <ul class="position">
            <?php foreach ($sliders as $k => $slider) { ?>
                <li <?php if($k ==0){?>class="current"<?php }?>></li>
            <?php }?>
            </ul>
        </nav>
    </div>

    <nav class="nav-list cl swipe">
        <div class="swipe-wrap">
        <div><ul class="cl">
<?php foreach (array_merge($nav,$nav_hide) as $k => $n) { if($k && $k%8==0){ echo '</ul></div><div><ul class="cl">';}?>
<li>
    <a href="<?php echo $n['link']?>">
        <span><img src="<?php echo $n['icon']?>" />
<?php if($n['pushtype']){?><i class="main-hot"><?php x1l('main'.$n['pushtype'])?></i><?php }?>
        </span>
        <em class="m-piclist-title"><?php echo $n['name']?></em>
    </a>
</li>
<?php }?>
        </ul>
        </div></div>
        <nav class="cl bullets bullets1">
            <ul class="position position1">
                <?php for ($i=0;$i<(count(array_merge($nav,$nav_hide))/8); $i++) {?>
                    <li <?php if($i ==0){?>class="current"<?php }?>></li>
                <?php }?>
            </ul>
        </nav>
    </nav>

<?php if($bar[0]){?>
<div class="bar">
    <a href="<?php echo $bar[0]['adlink'] ? $bar[0]['adlink'] : $bar[0]['link']?>">
        <img onerror="this.src='source/plugin/xigua_114/static/nopic.jpg';this.error=null;" src="<?php echo $bar[0]['adimage']?>" />
    </a>
</div>
<?php }?>
<?php if($near){?>
    <div class="nav-list-head"><i class="icon-map-marker"></i> <?php x1l('near')?></div>
    <nav class="nav-list-far cl">
        <ul class="cl">
<?php foreach ($near as $k => $n) {?>
<li>
    <a href="<?php echo $n['link']?>">
<span><img src="<?php echo $n['icon']?>" />
<?php if($n['pushtype']){?><i class="main-hot"><?php x1l('main'.$n['pushtype'])?></i><?php }?>
</span>
        <em class="m-piclist-title"><?php echo $n['name']?></em>
    </a>
</li>
<?php }?>
        </ul>
    </nav>
<?php }?>
<?php if($hotlist){?>
    <div class="nav-list-head"><i class="icon-fire2"></i> <?php x1l('hotlist')?></div>
    <nav class="nav-list-col cl">
        <ul>
<?php foreach ($hotlist as $k => $n) {?>
<li>
    <a href="<?php echo $n['link']?>" class="cl">
        <div class="nav-icon"><img src="<?php echo $n['icon']?>" /></div>
        <div class="main-title"><?php echo $n['name']?> <?php if($n['pushtype']){?><i class="main-hot"><?php x1l('main'.$n['pushtype'])?></i><?php }?></div>
        <div class="sub-title">
            <?php foreach ($n['child'] as $child_) {
                echo "<span>$child_</span>";
           }
            ?>
        </div>
    </a>
</li>
<?php
}
?>
        </ul>
    </nav>
<?php }?>

    <div>
        <div class="buttons-tab">
            <a href="javascript:;" id="t0" class="tab-link button active"><?php x1l('hottab') ?></a>
            <a href="javascript:;" id="t1" class="tab-link button"><?php x1l('newtab') ?></a>
            <a href="javascript:;" id="t2" class="tab-link button"><?php x1l('youtab') ?></a>
            <a href="javascript:;" id="t3" class="tab-link button"><?php x1l('rentab') ?></a>
            <a href="javascript:;" id="t4" class="tab-link button"><?php x1l('tuitab') ?></a>
        </div>
        <div class="cl swiper-container" id="spage">
            <div class="swiper-wrapper">
            <div id="w0" class="swiper-slide spageitm"><ul class="cl company-list-1"><li><div class="ajxloading"></div></li></ul></div>
            <div id="w1" class="swiper-slide spageitm"><ul class="cl company-list-1"><li><div class="ajxloading"></div></li></ul></div>
            <div id="w2" class="swiper-slide spageitm"><ul class="cl company-list-1"><li><div class="ajxloading"></div></li></ul></div>
            <div id="w3" class="swiper-slide spageitm"><ul class="cl company-list-1"><li><div class="ajxloading"></div></li></ul></div>
            <div id="w4" class="swiper-slide spageitm"><ul class="cl company-list-1"><li><div class="ajxloading"></div></li></ul></div>
            </div>
        </div>
    </div>

    <footer>
        <a href="plugin.php?id=xigua_114&mobile=no&ac=join"><?php echo $config['jointip']?></a>
    </footer>
</div>
<?php include DISCUZ_ROOT .'source/plugin/xigua_114/template/footer.php'?>
<script src="source/plugin/xigua_114/static/slider.js"></script>
<script src="source/plugin/xigua_114/static/idangerous.swiper.min.js"></script>
<script>
    var tabsSwiper = new Swiper('.swiper-container',{
        speed:500,
        onSlideChangeStart: function(){
            $(".tab-link.active").removeClass('active')
            $(".tab-link").eq(tabsSwiper.activeIndex).addClass('active')
        },
        onTouchEnd: function(swiper){
            spageto(tabsSwiper.activeIndex);
        }
    });
    $(".tab-link").on('touchstart mousedown',function(e){
        e.preventDefault()
        $(".tab-link.active").removeClass('active')
        $(this).addClass('active')
        tabsSwiper.swipeTo( $(this).index() );
        spageto( $(this).index() );
    });
    $(".tab-link").click(function(e){
        e.preventDefault()
    });
</script>
<script>
function spageto(index, got){
    if(! $('#w'+index).hasClass('hasload')){
        var url;
        if(index==1){
            url = 'plugin.php?id=xigua_114&inajax=1&mobile=no&ac=fetchtype&pt=new';
        }else if(index ==2){
            url = 'plugin.php?id=xigua_114&inajax=1&mobile=no&ac=fetchtype&pt=hui';
        }else if(index ==3){
            url = 'plugin.php?id=xigua_114&inajax=1&mobile=no&ac=fetchtype&vip=1';
        }else if(index ==4){
            url = 'plugin.php?id=xigua_114&inajax=1&mobile=no&ac=fetchtype&dig=1';
        }else if(index ==0){
            url = 'plugin.php?id=xigua_114&inajax=1&mobile=no&ac=fetchtype&pt=hot';
        }
        $.post(url, {formhash:'<?php echo FORMHASH?>'},
            function (data) {
                $('#w'+index).html(data).addClass('hasload');
                $('.spageitm').height($('#w'+index).find('ul').height());
                $('.tab-link').removeClass('active');
                $('#t'+index).addClass('active');
            });
    }else {
        $('.spageitm').height($('#w'+index).find('ul').height());
        $('.tab-link').removeClass('active');
        $('#t'+index).addClass('active');
    }
}
spageto(0);

$('.buttons-tab').each(function () {
    var _this = $(this);
    var ofst = _this.offset(), scrol;
    $(window).scroll(function () {
        scrol = $(window).scrollTop();
        if (scrol >= ofst.top+77) {
            _this.addClass('posfixed');
            $('#spage').css({'margin-top':'55px'});
            $('.topnav').hide();
        } else {
            _this.removeClass('posfixed');
            $('#spage').css({'margin-top':'0'});
            <?php if(!$config['nohead']){?>$('.topnav').show();<?php } ?>
        }
    });
});

$(function(){
function runslider(_this,auto){
    var bullets = _this.find('nav.bullets');var position = _this.find('ul.position');
new Swipe2(_this[0], {startSlide: 0,speed: 500,auto:auto,continuous:true,callback:function(index){if(bullets.length>0){bullets.find('em:first-child').text(index+1);} if(position.length>0){var selectors=position[0].children;
for(var t=0;t<selectors.length;t++){selectors[t].className=selectors[t].className.replace("current","");} selectors[(index)%(selectors.length)].className="current";}}});}
    $('div.swipe').each(function(){runslider($(this),3000);$(this).css('height','auto');});
    $('nav.swipe').each(function(){runslider($(this),0);$(this).css('height','auto');});

    var list_hide = $('ul.list_hide');
    $('#chevron').on('click', function(){
        list_hide.toggleClass('none');
        $(this).toggleClass('reversal');
        return false;
    });
    $('#form-clear').on('click', function(){
        $('input[name="phonename"]').val('');
        $(this).hide();
        return false;
    });
    $('#form114submit').on('click', function(){
        if($('input[name="phonename"]').val()){
        $('#form114').submit();}
    });
    $('input[name="phonename"]').on('keyup',  function(){
        if($(this).val() ==''){
            $('#form-clear').hide();
        }else{
            $('#form-clear').show();
        }
        return false;
    });
});
</script>
<?php if($signature){?>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>
var title = '<?php echo $title?>';
var desc = '<?php echo $title?>';
var link = '<?php echo $cururl?>';
var imgUrl = '<?php echo $wechat['wsq_sitelogo']?>';

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
        imgUrl: imgUrl
    });
    wx.onMenuShareTimeline({
        title: title,
        link: link,
        imgUrl: imgUrl
    });
    wx.onMenuShareQQ({
        title: title,
        desc: desc,
        link: link,
        imgUrl: imgUrl
    });
    wx.onMenuShareWeibo({
        title: title,
        desc: desc,
        link: link,
        imgUrl: imgUrl
    });
});
</script><?php }?>