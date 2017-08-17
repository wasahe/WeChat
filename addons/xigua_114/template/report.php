<?php include DISCUZ_ROOT .'source/plugin/xigua_114/template/header.php'?>
<div class="container_map">
<div class="topnav" style="max-width: 640px;left:auto">
    <a class="home-return" href="javascript:window.history.go(-1);"><?php x1l('report_title')?></a>
    <h2 class="hd"><?php x1l('report_title')?></h2>
    <?php if($config['topjoin']){ ?><a class="joinnow" href="plugin.php?id=xigua_114&mobile=no&ac=join"><?php echo $config['topjoin'] ?></a><?php } ?>
</div>

<div id="container" class="container projects form">

    <form id="report-form" action="" accept-charset="UTF-8" enctype="multipart/form-data" method="post">
        <input type="hidden" name="formhash" value="<?php echo FORMHASH?>" />
        <div class="form-group">
            <label for=""><?php x1l('i_report')?></label>
            <input type="number" class="form-control" name="row[phone]" id="row_phone" placeholder="<?php x1l('report_phone')?>">
        </div>
        <div class="form-group">
            <label for=""><?php x1l('report_type')?></label>
            <ul class="form-ul" id="form-ul">
                <li><?php x1l('type1')?></li>
                <li class="focus"><?php x1l('type2')?></li>
                <li><?php x1l('type3')?></li>
            </ul>
        </div>
        <div class="form-group">
            <label for=""><?php x1l('extra_')?></label>
            <textarea class="form-control" rows="2" name="row[extra]" id="row_extra" placeholder="<?php x1l('extra__')?>"></textarea>
        </div>
        <div class="form-group">
            <label for=""><?php x1l('connect')?></label>
            <input type="number" class="form-control" name="row[mobile]" id="row_mobile" placeholder="<?php x1l('connect__')?>">
        </div>
        <div class="form-group">
            <a class="btn btn-outline " id="dosubmit"><?php x1l('report_submit')?></a>
        </div>
        <input type="hidden" name="row[type]" id="type" value="2" />
    </form>
</div>
<div id="agreement_mask"></div>
<div id="bottom-mask" class="animated-fast">
    <ul class="form-ul" id="bottom-list">
        <li><?php x1l('bottom_list1')?></li>
        <li><?php x1l('bottom_list2')?></li>
        <li><?php x1l('bottom_list3')?></li>
        <li><?php x1l('bottom_list4')?></li>
    </ul>
</div>
</div>
<?php include DISCUZ_ROOT .'source/plugin/xigua_114/template/footer.php'?>
<script src="source/plugin/xigua_114/static/tr.js?<?php echo $VERSION?>"></script>
<script>
$(function(){
    var extra = $('#row_extra');
    $('#form-ul li').each(function(){
        $(this).on('click', function(){
//            $(this).css('background','#f5f5f5');
            $(this).addClass('focus').siblings().removeClass('focus');
            var index = $(this).index();
            if(index==0){
                extra.val('<?php x1l('type1_')?>');
                extra.attr('placeholder', '<?php x1l('type1__')?>');
                $('#type').val('1');
            }else if(index == 1){
                extra.val('');
                extra.attr('placeholder', '<?php x1l('type2_')?>');
                $('#type').val('2');
            }else{
                $('#agreement_mask').fadeIn();
                $('#bottom-mask').addClass('fadeInUp').show();
                $('#type').val('3');
            }
            return false;
        });
//            .on('touchend', function(){
//            $(this).css('background','#fff');
//            return false;
//        });
    });
    $('#bottom-list li').on('click', function(){
        $(this).css('background','#f5f5f5');
        extra.val($(this).html());
        extra.attr('placeholder', '<?php x1l('type3_')?>');
        $('#agreement_mask').fadeOut();
        $('#bottom-mask').removeClass('fadeInUp').addClass('fadeInDown2');
        return false;
    }).on('touchend', function(){
        $(this).css('background','#fff');
    });
    $('#dosubmit').on('click', function(){
        var vailds = ['phone', 'extra','mobile'];
        var vaildlang = ['<?php x1l('phone_vaild')?>', '<?php x1l('extra_vaild')?>', '<?php x1l('mobile_qq_vaild')?>'];
        for(var i =0; i<vailds.length; i++){
            var o = $('#row_'+vailds[i]);
            if(o.val() == ''){
                alert(vaildlang[i]);
                o.focus();
                $('html, body').animate({scrollTop:o.offset().top-10},500);
                return false;
            }
        }

        $('#report-form').ajaxSubmit({
            type: 'post',
            success: function (data) {
                if(data=='report_succeed'){
                    alert('<?php x1l('report_succeed')?>');
                    window.location.href = window.location.href;
                }else{
                    alert(data);
                }
            }
        });
    });
});
</script>
