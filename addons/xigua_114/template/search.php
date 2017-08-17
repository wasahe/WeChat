<?php include DISCUZ_ROOT .'source/plugin/xigua_114/template/header.php'?>
<?php if($config['nohead']):?><style>.topnav{display:none!important;}.pt-page, .container_map{padding-top:0 }</style><?php endif;?>
<div class="container_map">
    <div class="topnav">
        <a class="home-return" href="plugin.php?id=xigua_114"><?php echo $title?></a>
        <h2 class="hd"><?php echo $title?></h2>
        <?php if($config['topjoin']){ ?><a class="joinnow" href="plugin.php?id=xigua_114&mobile=no&ac=join"><?php echo $config['topjoin'] ?></a><?php } ?>
    </div>
    <div class="banner">
        <form action="plugin.php" method="get" id="form114">
            <input type="hidden" name="id" value="xigua_114" />
            <input type="hidden" name="ac" value="search" />
            <input type="hidden" name="formhash" value="<?php echo FORMHASH?>" />
            <input class="form-search" type="search" name="phonename" autocomplete="off" placeholder="<?php echo $config['searchlabel']?>" value="<?php echo $phonename?>" />
            <a href="javascript:;" id="form-clear" class="form-clear"></a>
            <a href="javascript:;" id="form114submit" class="form114submit"></a>
        </form>
    </div>
    <ul class="cl company-list-1 noborder" id="container_ul">
    <?php
    if($company_list){
        foreach ($company_list as $company) {
            echo format_company_list($company);
        }
    }else{
        ?>
<li>
<a href="javascript:;">
    <div class="company-title company-title-middle"><?php echo sprintf(x1l('nothing',0), $phonename)?></div>
</a>
</li>
<?php if(0 && !is_numeric($phonename)){?>
<li>
    <a href="plugin.php?id=xigua_114&mobile=no&ac=map&phonename=<?php echo $phonename?>" class="company-link-only">
        <div class="compnay-icon">
            <div class="circle"><i class="icon-map-marker"></i></div>
        </div>
        <div class="company-title company-title-middle"> <?php x1l('near'); echo $phonename?></div>
    </a>
</li>
<?php }?>
<?php
    } ?>
    </ul>
</div>

<footer>
    <a href="plugin.php?id=xigua_114&mobile=no&ac=join"><?php echo $config['jointip']?></a>
</footer>
<?php include DISCUZ_ROOT .'source/plugin/xigua_114/template/footer.php'?>
<script>
$(function(){
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
var loading = 0;
var _pageIndex = 1;
var _pageCount = <?php echo $total_page; ?>;
var xgpm = {
    widget: 'container_ul',
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
        if (isbottom && this.isPre) {
            _pageIndex++;
            if (_pageIndex > _pageCount) {
                return;
            }
            var wid = $('#' + that.widget);
            if (wid.children('.'+that.loading).length == 0) {
                wid.append('<div class="'+that.loading+'"></div>');
            }
            $.post('<?php echo $_G['siteurl'].'plugin.php?id=xigua_114&inajax=1&ac=search&total='.$total_page ?>',
                {page: _pageIndex,phonename:'<?php echo $phonename?>', formhash:'<?php echo FORMHASH?>'},
                function (data) {
                    wid.append(data);
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
</script>
