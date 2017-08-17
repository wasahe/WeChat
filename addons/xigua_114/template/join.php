<?php include DISCUZ_ROOT .'source/plugin/xigua_114/template/header.php'?>
<?php $fields = (array)unserialize($config['field']);?>
<?php if($config['nohead']):?><style>.topnav{display:none!important;}.pt-page, .container_map{padding-top:0 }</style><?php endif;?>
<div id="pt-main">
    <div class="pt-page pt-page-1">
            <div class="topnav">
                <a class="home-return" href="javascript:window.history.go(-1);"><?php x1l('in')?></a>
                <h2 class="hd"><?php x1l('in')?></h2>

            </div>

            <div class="masthead">
                <img src="source/plugin/xigua_114/static/bg.jpg" width="100%" />
            </div>

            <div class="container projects">
                <?php echo $config['joindesc'] ?>
            </div>
            <div class="container projects">
                <p class="masthead-button-links">
                    <a class="btn btn-outline iterateEffects" data-to="1" data-page="1"><?php x1l('new_')?></a>
                </p>
            </div>
            <div class="container projects">
                <?php if($config['hotline']){?><p class="masthead-button-links">
                    <?php x1l('hotline')?> <a href="tel:<?php echo $config['hotline']?>"><?php echo $config['hotline']?></a>
                </p><?php }?>
                <p class="masthead-button-links">
                    <a href="plugin.php?id=xigua_114&mobile=no&ac=report"><?php x1l('report_title')?></a>
                </p>
            </div>
    </div>
    <div class="pt-page pt-page-2">
        <div class="topnav">
            <a data-to="2" data-page="0" class="home-return iterateEffects" href="javascript:void(0);"><?php x1l('in')?></a>
            <h2 class="hd"><?php x1l('in')?></h2>
        </div>
        <div class="container projects form">
            <form id="former" action="" accept-charset="UTF-8" enctype="multipart/form-data" method="post">
            <input type="hidden" name="formhash" value="<?php echo FORMHASH?>" />
                <div class="form-group">
                    <label for=""><?php x1l('company_title')?></label>
                    <?php if(in_array('phone', $fields)){ ?>
                    <input type="text" class="form-control form-control-top" name="row[phone]" placeholder="<?php x1l('phone_tip')?>">
                    <?php } ?>
                    <?php if(in_array('qq', $fields)){ ?>
                    <input type="number" class="form-control form-control-middle" name="row[qq]" placeholder="<?php x1l('qq1')?>">
                    <?php } ?>
                    <?php if(in_array('wechat', $fields)){ ?>
                    <input type="text" class="form-control form-control-middle" name="row[wechat]" placeholder="<?php x1l('wechat')?>">
                    <?php } ?>
                    <?php if(in_array('qr', $fields)){ ?>
                    <input type="text" class="form-control form-control-middle" readonly="readonly" onfocus="this.blur()" onclick="return false" placeholder="<?php x1l('qr_')?>">
                    <div class="photo-control" >
                        <div class="photo-process"></div>
                        <i class="icon-plus"></i>
                        <input type="file" name="row[qr]" accept="image/*" onchange="return upload_start(this,0);" />
                    </div><?php } ?>
                    <?php if(in_array('weibo', $fields)){ ?>
                    <input type="text" class="form-control form-control-middle" name="row[weibo]" placeholder="<?php x1l('weibo')?>">
                    <?php } ?>
                    <?php if(in_array('site', $fields)){ ?>
                    <input type="text" class="form-control form-control-bottom" name="row[site]" placeholder="<?php x1l('site')?>">
                    <?php } ?>
                </div>
                <div class="form-group">
                    <?php if(in_array('catid', $fields)){ ?>
                    <label for=""><?php x1l('nameanddesc')?></label>
                    <?php echo $cat?>
                    <?php } ?>
                    <?php if(in_array('company_name', $fields)){ ?>
                    <input type="text" class="form-control form-control-middle" name="row[company_name]" placeholder="<?php x1l('company_name_')?>">
                    <?php } ?>
                    <?php if(in_array('company_desc', $fields)){ ?>
                    <input type="text" class="form-control form-control-middle" name="row[company_desc]" placeholder="<?php x1l('company_desc')?>">
                    <?php } ?>
                    <?php if(in_array('logo', $fields)){ ?>
                    <input type="text" class="form-control form-control-middle" readonly="readonly" onfocus="this.blur()" onclick="return false" placeholder="<?php x1l('company_logo')?>">
                    <div class="photo-control">
                        <div class="photo-process"></div>
                        <i class="icon-plus"></i>
                        <input type="file" name="row[logo]" accept="image/*" onchange="return upload_start(this,0);" />
                    </div>
                    <?php } ?>
                    <?php if(in_array('cover', $fields)){ ?>
                    <input type="text" class="form-control form-control-bottom" readonly="readonly" onfocus="this.blur()" onclick="return false" placeholder="<?php x1l('company_cover')?>">
                    <div class="photo-control ">
                        <div class="photo-process"></div>
                        <i class="icon-plus"></i>
                        <input type="file" name="row[cover][]" accept="image/*" onchange="return upload_start(this,1);" />
                    </div>
                    <?php } ?>
                </div>

                    <?php if(in_array('address', $fields)){ ?>
                <div class="form-group">
                    <label for="address"><?php x1l('address_')?></label>
                    <div id="residecitybox" style="height:auto">
<!--                        --><?php //echo $cityhtml;?>
<!--resideprovince-->
<!--residecity-->
<!--residedist-->
<!--row[address]-->
                        <a name="location" id="location" style="line-height: 30px;display: block;width: 100%;">
                            <i class="a9 f18 icon iconfont icon-locationfill"></i> <span id="locationadr"><?php x1l('please_input_address') ?></span>
                        </a>

                    </div>
<!--                    <input type="text" class="form-control form-control-bottom" id="address" name="row[address]" placeholder="--><?php //x1l('address_profile')?><!--">-->
                </div>
                    <?php } ?>
                <div class="form-group">
                    <?php if(in_array('realname', $fields)){ ?>
                    <label for=""><?php x1l('apply_name')?></label>
                    <input type="text" class="form-control form-control-top" name="row[realname]" placeholder="<?php x1l('applyer_')?>">
                    <?php } ?>
                    <?php if(in_array('idcard', $fields)){ ?>
                    <input type="text" class="form-control form-control-middle" name="row[idcard]" placeholder="<?php x1l('idcard')?>">
                    <?php } ?>
                    <?php if(in_array('mobile', $fields)){ ?>
                    <input type="number" class="form-control form-control-bottom" name="row[mobile]" placeholder="<?php x1l('phoneqq')?>">
                    <?php } ?>
                </div>
                <div class="form-group">
                    <p class="agree"><i id="chker-control" class="form-cheker icon-check"></i> <?php x1l('iagree')?><a id="agreement-ctrl"><?php x1l('agreement')?></a></p>
                </div>
                <div class="form-group">
                    <a class="btn btn-outline " id="dosubmit"><?php x1l('submit_apply')?></a>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="agreement_mask"></div>
<div id="agreement" class="agreement animated fadeInDown">
    <h3><?php x1l('agreement_doc')?></h3>
    <?php echo $config['agreement']?>
    <a class="btn btn-offline" id="agreement-close"><?php x1l('close')?></a>
</div>
<script src="source/plugin/xigua_114/static/jquery-1.7.1.min.js?t=201403261231"></script>
<script src="source/plugin/xigua_114/static/tr.js?<?php echo $VERSION?>"></script>
<script>
var async = true;

$(function(){
    $(".btn").on("touchstart",function() {
        $(this)[0].classList.add('active');
//        if($(this).attr('data-to')){
//           return false;
//        }
    }).on("touchend",function() {
        $(this)[0].classList.remove('active');
    });
    $('#chker-control').on("click", function(){
        $(this)[0].classList.toggle('form-cheker-disable');
        $('#dosubmit')[0].classList.toggle('btn-offline');
    });
    $('#agreement-ctrl').on('click', function(){
        $('#agreement_mask').fadeIn();
        $('#agreement').show();
    });
    $('#agreement-close').on('click', function(){
        $('#agreement_mask').fadeOut();
        $('#agreement').hide();
    });
    $('#dosubmit').on('click', function(){
        if($('#chker-control')[0].classList.contains('form-cheker-disable')){
            return false;
        }
        var vailds = ['phone', 'company_name', 'realname', 'mobile'];
        var vaildlang = ['<?php x1l('phone__vaild')?>', '<?php x1l('company_name_vaild')?>', '<?php x1l('realname_vaild')?>', '<?php x1l('mobile_qq_vaild')?>'];
        for(var i =0; i<vailds.length; i++){
            var o = $('input[name="row['+vailds[i]+']"]');
            if(o.length>0 && o.val() == ''){
                alert(vaildlang[i]);
                o.focus();
                $('html, body').animate({scrollTop:o.offset().top-60},500);
                return false;
            }
        }

        $('#former').ajaxSubmit({
            type: 'post',
            success: function (data) {
                if(data=='succeed'){
                    alert('<?php x1l('join_succeed')?>');
                    window.location.href = window.location.href;
                }else{
                    alert(data);
                }
            }
        });
    });

});


function _$(id) {
    return document.getElementById(id);
}
function showdistrict(container, elems, totallevel, changelevel, containertype) {
    var getdid = function(elem) {
        var op = elem.options[elem.selectedIndex];
        return op['did'] || op.getAttribute('did') || '0';
    };
    var pid = changelevel >= 1 && elems[0] && _$(elems[0]) ? getdid(_$(elems[0])) : 0;
    var cid = changelevel >= 2 && elems[1] && _$(elems[1]) ? getdid(_$(elems[1])) : 0;
    var did = changelevel >= 3 && elems[2] && _$(elems[2]) ? getdid(_$(elems[2])) : 0;
    var coid = changelevel >= 4 && elems[3] && _$(elems[3]) ? getdid(_$(elems[3])) : 0;
    var url = "<?php echo $_G['siteurl']?>home.php?mod=misc&ac=ajax&op=district&container="+container+"&containertype="+containertype
        +"&province="+elems[0]+"&city="+elems[1]+"&district="+elems[2]+"&community="+elems[3]
        +"&pid="+pid + "&cid="+cid+"&did="+did+"&coid="+coid+'&level='+totallevel+'&handlekey='+container+'&inajax=1&mobile=no'+(!changelevel ? '&showdefault=1' : '');
    $.ajax({
        type: "GET",url: url,cache:false,dataType:'xml',async :async,
        success: function(data){
            var content = $(data).find("root").text();
            content = content.replace(/&nbsp;&nbsp;/ig, " ");
            $('#'+container).html(content);
        }
    });
}

function upload_start(obj, ap){
    if(!FileReader){
        alert('Error.');
    }else{
        uploader.uploadFile(obj, 'plugin.php?id=xigua_114&mobile=no&ac=uploader', function (data){
            uploader.reset_progressbar(obj);
            var re = (new Function('', 'return ' + data.response))();
            if(re.errno == 0){
                var ctrl = $(obj).parent();
                if(ap){
                    ctrl.parent().append('<div class="photo-control">'+ctrl.html()+'</div>');
                }
                var html = ctrl.html();
                ctrl.html('<img class="photo-full" src="' +data.src+'" /><i class="icon-cross"></i>');
                ctrl.append('<input type="hidden" name="'+obj.name+'" value="' +re.error+'" />');
                $('i.icon-cross').on('click', function(){
                    if(ap){
                        $(this).parent().remove();
                    }else{
                    $(this).parent().html(html);
                    }
                    return false;
                });
            }else{
                alert(re.error);
            }
        });
    }
    return false;
}
XMLHttpRequest.prototype.sendAsBinary || (XMLHttpRequest.prototype.sendAsBinary = function(a) {
    function b(a) {
        return 255 & a.charCodeAt(0)
    }
    var c = Array.prototype.map.call(a, b),
        d = new Uint8Array(c);
    this.send(d)
});
var uploader = {
    uploadFile: function(obj, url, callback) {
        var progressbar = $(obj).parent().find('div.photo-process');
        progressbar.css({width:'0'}).fadeIn();
        var reader = new FileReader, file = obj.files[0];
        reader.onloadend = function() {
            reader.onloadend = null;
            var formdata, xhr = new XMLHttpRequest, upload = xhr.upload;
            if(file.size <=0){
            }else if(file.type != 'image/png' && file.type != 'image/jpeg'){
                alert('<?php x1l('ONLY_IMAGE_ALLOW')?>');
            }else{
                var src = '', reader2 = new FileReader;
                reader2.readAsDataURL(file);
                reader2.onloadend = function(){
                    reader2.onloadend = null;
                    src = reader2.result;
                };
                upload.progressbar = progressbar;
                upload.addEventListener("progress", uploader.pr_uploadProgress, 0);
                upload.addEventListener("load", uploader.pr_uploadSucceed, 0);
                upload.addEventListener("error", uploader.pr_uploadError, 0);
                xhr.open("POST", url);
                xhr.overrideMimeType("application/octet-stream");
                formdata = new FormData;
                formdata.append("Filedata", file);
                formdata.append("field", uploader.field);
                xhr.send(formdata);
                xhr.onreadystatechange = function() {
                    if (4 == xhr.readyState && 200 == xhr.status) {
                        var response = xhr.responseText;
                        var res = {response:response, src:src};
                        "function" == typeof callback ? callback(res) : eval(callback);
                    }
                }
            }
        };
        reader.readAsBinaryString(file);
    },
    pr_uploadProgress: function(a) {
        if (a.lengthComputable) {
            a.target.progressbar[0].style.width = (a.loaded/a.total)*100 + '%';
        }
    },
    pr_uploadSucceed: function(a) { },
    pr_uploadError: function(a) { alert("Error:" + a);},
    reset_progressbar:function(obj){$(obj).parent().find('div.photo-process').css({width:'0%'}).fadeOut();}
}
</script>



<style>
    .tipmap{position:fixed;top:0;left:0;height:100%;width:100%;z-index:9999999;display:none}
</style>
<div class="tipmap">
    <script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
    <iframe id="mapPage" width="100%" height="100%" frameborder=0 src=""></iframe>
    <script>
        window.addEventListener('message', function(event) {
            var loc = event.data;
            if (loc && loc.module == 'locationPicker') {

                var geocoder;
                geocoder = new qq.maps.Geocoder();
                var latLng = new qq.maps.LatLng(loc.latlng.lat, loc.latlng.lng);
                geocoder.getAddress(latLng);
                geocoder.setComplete(function(result) {

                    var cityhtml = '';
                    cityhtml += '<input type="hidden" name="resideprovince" value="'+ result.detail.addressComponents.province +'" />';
                    cityhtml += '<input type="hidden" name="residecity" value="'+ result.detail.addressComponents.city +'" />';
                    cityhtml += '<input type="hidden" name="residedist" value="'+ result.detail.addressComponents.district +'" />';

                    var address=loc.poiaddress.replace(result.detail.addressComponents.province,"");
                    address=address.replace(result.detail.addressComponents.city,"");
                    address=address.replace(result.detail.addressComponents.district,"");

                    $('#locationadr').html(loc.poiaddress+ cityhtml +
                            '<input type="hidden" name="row[address]" value="'+address+'" />'+
                            '<input type="hidden" name="row[lat]" value="'+loc.latlng.lat+'" />'+
                            '<input type="hidden" name="row[lng]" value="'+loc.latlng.lng+'" />');
                    $('.tipmap').fadeOut();
                });
            }
        }, false);
        $('#location').on('click', function(){
            if(!$('#mapPage').attr('src')){
                $('#mapPage').attr('src', 'http://apis.map.qq.com/tools/locpicker?search=1&type=1&key=OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77&referer=myapp');
            }
            $('.tipmap').fadeIn();
        });
    </script>
</div>



</body>
</html>