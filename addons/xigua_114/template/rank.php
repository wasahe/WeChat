<?php include DISCUZ_ROOT .'source/plugin/xigua_114/template/header.php'?>
<?php if($config['nohead']):?><style>.topnav{display:none!important;}.pt-page, .container_map{padding-top:0 }.listnav{top:0!important;}</style><?php endif;?>
<style>.company-list-1 .company-desc{margin-left:93px}</style>
<div class="container_map" id="container_map">
    <div class="topnav">
        <a class="home-return" href="javascript:window.history.go(-1);"><?php echo $title?></a>
        <h2 class="hd"><?php echo $title?></h2>

        <?php if($config['topjoin']){ ?><a class="joinnow" href="plugin.php?id=xigua_114&mobile=no&ac=join"><?php echo $config['topjoin'] ?></a><?php } ?>
    </div>

    <?php $hass = 0; ?>
    <?php   if($companies = $listinfo){ $hass = 1;?>
        <!--<div class="company-list-head">--><?php //echo $cat_['name']?><!-- --><?php //if($cat_['pushtype']){?><!--<i class="main-hot">--><?php //x1l('main'.$cat_['pushtype'])?><!--</i>--><?php //}?><!--</div>-->
        <ul class="cl company-list-1">
            <?php foreach ($companies as $k => $company) { $k++;/*
 *折翼天使资源社区折翼天使资源社区www.zheyitianshi.com
 *备用域名www.zheyitianshi.com
 *更多精品资源请访问折翼天使资源社区官方网站免费获取
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */?>
                <li>
                    <a href="<?php echo $company['link']?>" <?php if(!$cin){?>class="company-link-only"<?php }?>>
                        <div class="rank <?php echo $k<=5?'rank'.$k:'rankn'; ?>"><?php echo $k ?></div>
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
    var loading = 0;
    var _pageIndex = 1;
    var _pageCount = <?php echo $total_page; ?>;
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
            if ((isbottom && this.isPre) ||ignorebtm ) {
                _pageIndex++;
                if (_pageIndex > _pageCount) {
                    $('#shownext').html('<?php x1l('nomore') ?>');
                    return;
                }
                var wid = $('#' + that.widget);
                if (wid.children('.'+that.loading).length == 0) {
                    wid.append('<div class="'+that.loading+'"></div>');
                }
                $.post('<?php echo $_G['siteurl'].'plugin.php?id=xigua_114&inajax=1&mobile=no&ac=rank' ?>',
                    {page: _pageIndex, formhash:'<?php echo FORMHASH?>'},
                    function (data) {
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
