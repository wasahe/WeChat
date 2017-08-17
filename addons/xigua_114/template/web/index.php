<!--####-->
<!--{template common/header}-->
{$customcolor}
<link href="source/plugin/xigua_114/static/base.css?20150620" rel="stylesheet">
<link href="source/plugin/xigua_114/static/flexslider.css?20150620" rel="stylesheet">
<script>var page = 1,loading = 0, nomore = 0;</script>
<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
<div class="container">
    <div class="cl">
        <div class="place-search">
            <form id="114_form" method="get" autocomplete="off" action="plugin.php">
                <input type="hidden" name="formhash" value="{FORMHASH}">
                <input type="hidden" name="id" value="xigua_114">
                <a class="place-search-btn icon-search"></a>
                <input class="place-search-input" placeholder="{$config[searchlabel]}" name="phonename" value="{$phonename}">
            </form>
        </div>

        <div id="pt" class="location bm cl">
            <div class="z">
                <a href="./" class="nvhm" title="{lang homepage}">$_G[setting][bbname]</a> <em>&rsaquo;</em>
                <a href="{$_G[siteurl]}plugin.php?id=xigua_114">{$title}</a>
            </div>
        </div>
    </div>

    <!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->

    <!--{if $topnavslider}-->
    <div class="slideBox" id="slides">
        <ul class="items">
            <!--{loop $topnavslider $v}-->
            <li>{$v}</li>
            <!--{/if}-->
        </ul>
    </div>
    <!--{/if}-->

    <div class="place-tab cl">
        <a href="{echo xg_replace_url()}" class="place-tab-item current" >{lang xigua_114:allcat}</a>
        <span class="place-tab-line"></span>
        <!--{hook/xigua_114_placetab}-->
        <a target="_blank" class="place-tab-item" href="{$_G[siteurl]}plugin.php?id=xigua_114&mobile=no&ac=join" rel="nofollow">{lang xigua_114:joinnow1}</a>
    </div>
    <!--[diy=diy4]--><div id="diy4" class="area"></div><!--[/diy]-->
    <div>
        <div class="excavator">
            <div class="excavator-filter" >
                <span class="excavator-filter-name">{lang xigua_114:catmain}</span>
                <a class="excavator-filter-item {if !$pid}focuss{/if}" href="{echo xg_replace_url('pid',0)}">{lang xigua_114:all}</a>
                <!--{loop $list $v}-->
                <!--{if !$v[adlink]}-->
                <a class="excavator-filter-item {if $pid==$v[id]}focuss{/if}" href="{echo xg_replace_url('pid',$v[id])}">{$v[name]}</a>
                <!--{/if}-->
                <!--{/loop}-->
            </div>
            <div class="excavator-filter excavator-line" >
                <span class="excavator-filter-name">{lang xigua_114:dist}</span>
                <a class="excavator-filter-item {if !$city}focuss{/if}" href="{echo xg_replace_url('city','')}">{lang xigua_114:all}</a>
                <!--{loop $dists $k $v}-->
                <a class="excavator-filter-item {if $city==$k}focuss{/if}" href="{echo xg_replace_url('city',$k)}">{$k}</a>
                <!--{/loop}-->
            </div>
            <div class="excavator-bgbar cl">
                <div class="excavator-sort">
                    <a href="{echo xg_replace_url('order','')}" class="excavator-sort-item {if !$order}focuss{/if}">{lang xigua_114:defaultsort}</a>
                    <a href="{echo xg_replace_url('order','new')}" class="excavator-sort-item {if $order=='new'}focuss{/if}">{lang xigua_114:newest}</a>
                </div>
                <div class="excavator-option">
                    <label class="excavator-option-item"><input type="checkbox" {if $vip}checked{/if} onclick="if(this.checked){window.location.href='{echo xg_replace_url('vip',1)}'; }else{ window.location.href='{echo xg_replace_url('vip','')}'}">{lang xigua_114:pt1}</label>
                    <label class="excavator-option-item"><input type="checkbox" {if $pt=='hui'}checked{/if}  onclick="if(this.checked){window.location.href='{echo xg_replace_url('pt','hui')}'; }else{ window.location.href='{echo xg_replace_url('pt','')}'}">{lang xigua_114:pt2}</label>
                    <label class="excavator-option-item"><input type="checkbox" {if $pt=='hot'}checked{/if}  onclick="if(this.checked){window.location.href='{echo xg_replace_url('pt','hot')}'; }else{ window.location.href='{echo xg_replace_url('pt','')}'}">{lang xigua_114:pt3}</label>
                    <label class="excavator-option-item"><input type="checkbox" {if $pt=='new'}checked{/if}  onclick="if(this.checked){window.location.href='{echo xg_replace_url('pt','new')}'; }else{ window.location.href='{echo xg_replace_url('pt','')}'}">{lang xigua_114:pt4}</label>
                </div>
            </div>
        </div>
        <!--[diy=diy5]--><div id="diy5" class="area"></div><!--[/diy]-->
        <div class="place-rstbox cl">
<!--{if $listinfo}-->
    <div class="cl" id="listinfo">{$listinfo_output}</div>
<!--{else}-->
    <div class="place-rstbox-nodata">
        <img class="nodata" width="100" src="source/plugin/xigua_114/static/nologo.png">
        <div class="font-small">{lang xigua_114:nodata}</div>
    </div>
<script>loading=1;nomore=1;</script>
<!--{/if}-->
            <div class="place-rstbox-loading" id="ajaxloading" >
                <img src="source/plugin/xigua_114/static/loading.gif">{lang xigua_114:loadingmore}
            </div>
            <div class="place-rstbox-loading" id="ajaxnomore" >{lang xigua_114:nomore}</div>
        </div>
    </div>

</div>
<!--[diy=diy2]--><div id="diy2" class="area"></div><!--[/diy]-->

<!--{if !getcookie('xigua114fqrc')}-->
<div id="xigua114_float_qrcode" class="p_pop xg1">
    <p class="cl"><img class="y" onclick="jQuery('#xigua114_float_qrcode').fadeOut();setcookie('xigua114fqrc', 1, '{$config[qrclose]}')" src="static/image/common/ad_close.gif"></p>
    <img src="{$qrurl}">
    <p>{echo nl2br($config[subfont])}</p>
</div>
<!--{/if}-->

<script src="source/plugin/xigua_114/static/jquery-1.7.1.min.js?{$_G[style][verhash]}"></script>
<script src="{$_G[setting][jspath]}common.js?{$_G[style][verhash]}" type="text/javascript"></script>
<script src="source/plugin/xigua_114/static/jquery.flexslider-min.js?{$_G[style][verhash]}"></script>
<script>
jQuery(document).ready(function() {
    jQuery('#slides').slideBox({
        direction : 'top',
        duration : 0.3,
        easing : 'linear',
        delay : 5,
        hideClickBar : false,
        clickBarRadius : 10
    });
    jQuery(window).scroll(function () {
        if (!nomore && !loading && ((jQuery(document).height() - jQuery(this).scrollTop() - jQuery(this).height())==0)) {
            showAjaxLoading();
            page = page+1;
            jQuery.ajax({
                type:'get',
                cache:false,
                url:'{echo xg_replace_url("","",array())}&formhash={FORMHASH}&inajax=1&page='+page,
                success:function(data){
                    if(data){
                        jQuery('#listinfo').append(data);
                    }else{
                        showNoMore();
                    }
                    hideAjaxLoading();
                }
            });
        }
    });
    jQuery('.place-search-btn').click(function(){
        if(jQuery('.place-search-input').val()){
            jQuery('#114_form').submit();
        }
    });

    var ft = $('ft');
    if(ft && jQuery('#xigua114_float_qrcode').length) {
        var scrolltop = $('xigua114_float_qrcode');
        var viewPortHeight = parseInt(document.documentElement.clientHeight);
        var scrollHeight = parseInt(document.body.getBoundingClientRect().top);
        var basew = parseInt(ft.clientWidth);
        var sw = scrolltop.clientWidth;
        if (basew < 1000) {
            var left = parseInt(fetchOffset(ft)['left']);
            left = left < sw ? left * 2 - sw : left;
            scrolltop.style.left = ( basew + left ) + 'px';
        } else {
            scrolltop.style.left = 'auto';
            scrolltop.style.right = 0;
        }
    }

    function showAjaxLoading(){
        loading = 1;
        jQuery('#ajaxloading').fadeIn();
    }
    function hideAjaxLoading(){
        loading = 0;
        jQuery('#ajaxloading').fadeOut();
    }
    function showNoMore(){
        nomore = 1;
        jQuery('#ajaxnomore').fadeIn();
    }
});
function rstblock(id){
    showWindow('xigua_114profile', '{$_G[siteurl]}plugin.php?id=xigua_114&mobile=no&ac=profile&company='+id, 'get', 0, {cover:1,drag:0});
}
</script>
<!--{template common/footer}-->