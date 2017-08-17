<?php include DISCUZ_ROOT .'source/plugin/xigua_114/template/header.php'?>
<?php if($config['nohead']):?><style>.topnav{display:none!important;}.pt-page, .container_map{padding-top:0 }.listnav{top:0!important;}</style><?php endif;?>
<div class="container_map" id="container_map">
    <div class="topnav">
        <a class="home-return" href="javascript:window.history.go(-1);"><?php echo $title?></a>
        <h2 class="hd"><?php echo $title?></h2>

        <?php if($config['topjoin']){ ?><a class="joinnow" href="plugin.php?id=xigua_114&mobile=no&ac=join"><?php echo $config['topjoin'] ?></a><?php } ?>
    </div>

<?php if($config['tt']){?><div class="space"></div><?php }?>

<?php if($top_cat['adimage']){?>
<div class="banner">
    <a href="<?php echo $top_cat['adlink'] ? $top_cat['adlink'] : $top_cat['link']?>">
        <img onerror="this.src='source/plugin/xigua_114/static/nopic.jpg';this.error=null;" src="<?php echo $top_cat['adimage']?>" />
    </a>
</div>
<?php }?>
<?php if($config['tt']){
    ?>

    <style>
        .listnav{background:rgba(247, 247, 248, 0.95);position:fixed;top:40px;width:100%;height:40px;z-index:999}
        .nav_filter { width: 100%; display: -webkit-box;display: -webkit-flex;display: flex;background: rgba(247, 247, 248, 0.95);height: 40px;line-height: 40px;-webkit-user-select: none;position:relative;        }
        .nav_filter:before {content: " ";position: absolute;left: 0;bottom: 0;width: 100%;height: 1px;border-top: 1px solid #f0f0f0;color: #f0f0f0;-webkit-transform-origin: 0 0;transform-origin: 0 0;-webkit-transform: scaleY(0.5);transform: scaleY(0.5);        }
        .nav_filter>li:first-child { border-left: 0;         }
        .nav_filter>li {width: 100%;-webkit-box-flex: 1;-webkit-flex: 1;flex: 1;        }
        .nav_filter>li>a {display: inline-block;text-align: center;width:100%;-o-text-overflow: ellipsis;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;-webkit-user-select: none;position:relative;        }
        .nav_filter>li>a:before{content: " ";position: absolute;right: 0;bottom: 0;top:0;height:80px;width: 1px;border-left: 1px solid #f0f0f0;color: #f0f0f0;-webkit-transform-origin: 0 0;transform-origin: 0 0;-webkit-transform: scaleY(0.5);transform: scaleY(0.5);        }
        .nav_filter>li>a:after{border:1px solid #ccc;border-right: rgba(0, 0, 0, 0);border-bottom: rgba(0, 0, 0, 0);content: "";top: 13px;height:10px;width:10px;right:10px;position: absolute;-webkit-transform: rotate(-135deg);        }
        .hide{display:none}
        .aclist{    background: #fff;position: absolute;top: 40px;width: 100%;left:0;max-height:320px;overflow-y: auto;        }
        .aclist a{padding:0 15px;display:block;        }
        .aclist a.on{background:#f3f3f3;        }
        #maskac {background: #000;opacity: .3;width: 100%;height: 100%;position: fixed;z-index: 998;top: 0;left: 0;display: none;        }
        .space{height:40px;width:100%;}
    </style>
    <div class="listnav">
        <ul class="nav_filter">
            <?php
            $dists = array_merge(array('geo' => array('city' => $config['nearby'],'dist'=> $config['nearby'])), $dists);
            if($dists){ ?>
            <li>
                <a class="acty" href="javascript:;">
                    <?php
                    $hascity = 0;
                    foreach ($dists as $k => $item) {

                        if($_GET['city'] && $_GET['city']== ($k=='geo' ? 'geo' :$item[$config['filter1']])){
                            echo $item[$config['filter1']];
                            $hascity = 1;
                        }
                    }
                    if(!$hascity){echo  x1l('d1', 0);}?></a>

            <ul class="hide aclist">
                <li><a href="plugin.php?id=xigua_114&mobile=no&ac=cat&catid=<?php echo $catid?>&tt=1&city="><?php x1l('all');?></a></li>
                <?php foreach ($dists as $k => $item) {?>
                    <li><a <?php if($_GET['city']==($k=='geo' ? 'geo' :$item[$config['filter1']])){echo 'class="on"';}?> href="plugin.php?id=xigua_114&mobile=no&ac=cat&catid=<?php echo $catid?>&tt=1&city=<?php echo $k=='geo' ? 'geo' :urlencode($item[$config['filter1']])?>"><?php echo $item[$config['filter1']]?></a></li>
                <?php }?>
            </ul>
            </li>
            <?php } ?>
            <li><a class="acty" href="javascript:;">
                    <?php
                    $hastopcat = 0;
                    foreach ($showlist as $item) {
                        if($top_cat['id'] && $top_cat['id']==$item['id']){
                            $hastopcat = 1;
                            echo $item['name'];
                        }
                    }
                    if(!$hastopcat){
                        x1l('d2');
                    }?></a>
                <ul class="hide aclist">

                    <li><a href="plugin.php?id=xigua_114&mobile=no&ac=cat&city=<?php echo urlencode($_GET['city']);?>&tt=1"><?php x1l('all');?></a></li>
                    <?php foreach ($showlist as $item) { if(!$item['adlink']){ ?>
                        <li><a <?php if($top_cat['id']==$item['id']){echo 'class="on"';}?> href="plugin.php?id=xigua_114&mobile=no&ac=cat&city=<?php echo urlencode($_GET['city']);?>&catid=<?php echo $item['id']?>&tt=1"><?php echo $item['name']?></a></li>
                    <?php } }?>
                </ul>
            </li>
            <li><a class="acty" href="javascript:;">
                    <?php
                    $hastopcat2 = 0;
                    foreach ($slblist as $item) {
                        if($catid&& $catid==$item['id']){
                            $hastopcat2 = 1;
                            echo $item['name'];
                        }
                    }
                    if(!$hastopcat2){
                        x1l('d3');
                    }?>
                </a>
                <ul class="hide aclist">
                    <li><a href="plugin.php?id=xigua_114&mobile=no&ac=cat&catid=<?php echo $top_cat['id'];?>&city=<?php echo urlencode($_GET['city']);?>&tt=1"><?php x1l('all');?></a></li>
                <?php foreach ($slblist as $item) { ?>
                    <li><a <?php if($catid==$item['id']){echo 'class="on"';}?> href="plugin.php?id=xigua_114&mobile=no&ac=cat&city=<?php echo urlencode($_GET['city']);?>&catid=<?php echo $item['id']?>&tt=1"><?php echo $item['name']?></a></li>
                <?php }?>
                </ul>
            </li>
        </ul>
    </div>
    <div id="maskac"></div>

<?php }?>

<?php $hass = 0; ?>
<?php if($_GET['city']!='geo'){?>
<?php   if($companies = $listinfo){ $hass = 1;?>
<!--<div class="company-list-head">--><?php //echo $cat_['name']?><!-- --><?php //if($cat_['pushtype']){?><!--<i class="main-hot">--><?php //x1l('main'.$cat_['pushtype'])?><!--</i>--><?php //}?><!--</div>-->
<ul class="cl company-list-1">
<?php foreach ($companies as $company) { /*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */?>
    <li>
        <a href="<?php echo $company['link']?>" <?php if(!$cin){?>class="company-link-only"<?php }?>>
            <div class="compnay-icon"><img src="<?php echo $company['logo']?>"> <?php if($company['v']){?><i class="vip"></i><?php }?></div>
            <div class="company-title"><?php echo $company['company_name']?> <?php if($company['pt']){?><i class="main-hot"><?php x1l('main'.$company['pt'])?></i><?php }?></div>
            <div class="company-desc"><?php echo $company['city'].$company['dist'].$company['address'];?></div>
        </a>
<?php if($cin){?>
        <a href="tel:<?php echo $company['phone']?>" class="compnay-icon-r">
            <div class="circle circle-dgreen"><i class="icon-phone"></i></div>
        </a>
<?php }?>
    </li>
<?php } ?>
</ul>
<?php   }
  }else{ $hass = 1; }


if(!$hass){
?>
<ul class="cl company-list-1">
    <li>
        <a>
            <div class="company-title"><?php x1l('nodata')?></div>
            <div class="company-desc"> </div>
        </a>
    </li>
</ul>
<?php
}
?>
<a style="display:<?php if($total_page>1){?>block<?php }else{ ?>none<?php } ?>;position: relative;text-align: center;margin-bottom:15px;border: 1px solid #eee;color: #aaa;width: 50%;margin-left: 25%;height: 40px;
line-height: 38px;border-radius: 8px;" id="shownext" ontouchstart="return shownext();return false;" href="javascript:void(0);"><?php x1l('loadmore') ?></a>

</div>
<?php include DISCUZ_ROOT .'source/plugin/xigua_114/template/footer.php'?>


<script>
    $(function () {
        var shows= {};
        $('.acty').on('click', function(){
            $('.aclist').addClass('hide');
            var csl = $(this).parent().find('ul');
            var index = $('.acty').index($(this));
            if(!shows[index]){
                csl.removeClass('hide');
                $('#maskac').show();
                shows= {};
                shows[index] = 1;
            }else{
                csl.addClass('hide');
                $('#maskac').hide();
                shows= {};
                shows[index] = 0;
            }
        });
        $('#maskac').on('click', function () {
            $('.aclist').addClass('hide');
            $('#maskac').hide();
            shows= {};
        });
    });
</script>

<script>
var loading = 0;
var _pageIndex = 1;
var _pageCount = <?php echo $total_page; ?>;
var lat =0, lng =0;
var ignorebtm = 0;
var xgpm = {
     widget: 'container_map',
    loading:'ajxloading',
     isPre: false,
     startY: 0,
     endY: 0,

     init: function () {
         this.touch = ('ontouchstart' in document);
         this.Start = this.touch ? 'touchstart' : 'mousedown';
         this.Move = this.touch ? 'touchmove' : 'mousemove';
         this.End = this.touch ? 'touchend' : 'mouseup';
         document.addEventListener(this.Start, this.proxy(this, this.startEvent), false);
         document.addEventListener(this.Move, this.proxy(this, this.moveEvent), false);
         document.addEventListener(this.End, this.proxy(this, this.endEvent), false);
     },
     startEvent: function (e) {
         this.startY = e.touches[0].clientY;
         this.endY = e.touches[0].clientY;
         var ctrl = $('body');

         if (ctrl.scrollTop() == ($(document).height() - $(window).height() ) ) {
             this.isPre = true;
         }
     },
     moveEvent: function () {
         this.endEvent();
     },
     endEvent: function () {
         var that = this;
         var ctrl = $('body');
         var isbottom = (ctrl.scrollTop() == ($(document).height() - $(window).height()));
         if ((isbottom && this.isPre) || ignorebtm) {
             _pageIndex++;
             if (_pageIndex > _pageCount) {
                 $('#shownext').html('<?php x1l('nomore') ?>');
                 return;
             }
             var wid = $('#' + that.widget);
             if (wid.children('.'+that.loading).length == 0) {
                 wid.append('<div class="'+that.loading+'"></div>');
             }
             $.post('<?php echo $_G['siteurl'].'plugin.php?id=xigua_114&inajax=1&mobile=no&ac=cat&catid='.$_GET['catid'].($_GET['city'] ? '&city='.urlencode($_GET['city']):'') ?>'+'&lat='+lat+'&lng='+lng,
                 {page: _pageIndex, formhash:'<?php echo FORMHASH?>'},
                 function (data) {
                     if(!data){
                         _pageCount = 0;
                     }
                     $(data).insertBefore($('#shownext'));
                     $('.'+that.loading).detach();
                 });
         }
         this.isPre = false;
     },
     proxy: function (context, fn) {
         return function () {
             return fn.apply(context, arguments);
         }
     }
 };
 xgpm.init();
 function shownext(){
     ignorebtm = 1;
     xgpm.endEvent();
     ignorebtm = 0;
     return false;
 }
</script>
<?php if($_GET['city']=='geo'){?>
<iframe id="geoPage" width=0 height=0 frameborder=0  style="display:none;" scrolling="no" src="https://apis.map.qq.com/tools/geolocation?key=OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77&referer=myapp">
</iframe>
    <script>
var initmap = 0;
window.addEventListener('message', function(event) {

    var loc = event.data;
    if (_pageIndex > _pageCount) {
        $('#shownext').html('<?php x1l('nomore') ?>');
        return;
    }
    var wid = $('#container_map');
    if(_pageIndex==1){
        $('.company-list-1').remove();
    }
    if (wid.children('.ajxloading').length == 0) {
        wid.append('<div class="ajxloading"></div>');
    }
    if(!loc){
        return;
    }

    lat =loc.lat ;
    lng =loc.lng;
    if(!(lat &&lng)){
        return ;
    }
    $.post('<?php echo $_G['siteurl'].'plugin.php?id=xigua_114&inajax=1&mobile=no&ac=cat&catid='.$_GET['catid'].'&lat='; ?>'+lat+'&lng='+lng, {page: _pageIndex, formhash:'<?php echo FORMHASH?>'}, function (data) {
        if(!initmap){
            _pageIndex++;
            initmap = 1;
            $(data).insertBefore($('#shownext'));
            $('.ajxloading').detach();
        }
    });

}, false);

</script>
<?php } ?>