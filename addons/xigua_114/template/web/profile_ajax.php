<!--####-->
<!--{template common/header_ajax}-->
<style type="text/css" reload="1">
.flex-control-paging li a.flex-active { background:{$config['customcolor']}!important; }
.leftbox{width:380px;margin-right:20px;position:relative}
.leftbox img{width:380px;max-height:{$config['lunheight']}px}
.rightbox{width:280px}
.company-name .rstblock-logo-passicon{top:52px;left:57px}
.company-name a,.company-name-extend{float:left;position:relative}
.company-name-extend{margin-left:20px;width:190px}
.company-name .logo{width:70px;height:70px}
.flb .rstblock-activity{display:inline-block;margin-top:0;margin-left:10px}
.company-info{margin-top:10px;font-size:14px}
.qqtalk{background:url(source/plugin/xigua_114/static/wpa_style_51.gif) center center no-repeat;display:inline-block;width:77px;height:22px;text-indent:99999px;overflow:hidden}
.company-info li{margin:5px 0}
.company-info label{float:left;width:180px}
.company-info span{float:left;width:90px}
.company-info .wechatqrbox{position:relative;display:inline-block}
.company-info .wechatqr,.company-info .wechatqrlarge{height:22px;vertical-align:middle;display:inline-block;margin:0 5px}
.company-info .wechatqrlarge{display:none;height:auto;margin:0;position:absolute;border:5px solid #fff;z-index:999}
</style>
<h3 class="flb">
    <em>{$company[company_name]}<p class="rstblock-activity" style="display:inline-block;margin-top:0;margin-left:10px;position:relative">{$company[pt_string]}</p></em>
    <span><a href="javascript:;" class="flbc" onclick="hideWindow('xigua_114profile', 0, 1)" title="{lang xigua_114:close}">{lang xigua_114:close}</a></span>
</h3>
<div class="c w700 cl">
    <table><tr>
    <!--{if $company[cover]}--><td>
    <div class="leftbox" style="width:380px;margin-right:20px;position:relative ">
        <div class="flexslider1" style="height:{$config['lunheight']}px;overflow:hidden">
            <ul class="slides">
                <!--{eval
                $tmp=array_filter(explode("\t", trim($company[cover])));
                }-->
                <!--{loop $tmp $kk $vv}-->
                <li><img style="*width:380px;max-width:380px!important;max-height:{$config['lunheight']}px" src="{$vv}" /></li>
                <!--{/loop}-->
            </ul>
        </div>
    </div></td>
    <!--{/if}-->

    <td><div class="rightbox" style="width:280px">
        <div class="hd cl company-name">
            <a style="float:left;position:relative" href="{$company[url]}" target="_blank" title="{$company[company_name]}">
                <img class="logo" style="width:70px;height:70px" src="{$company[logo]}">
                {$company[v]}
            </a>
            <div class="company-name-extend" style="margin-left:20px;width:190px;float:left;position:relative">
                <h1 title="{$company[company_name]}" class="rstblock-title">{$company[company_name]}</h1>
                <span class="rstblock-monthsales">{$company[phone]}</span>
                <div class="rstblock-cost">{eval echo nl2br($company[company_desc]);}</div>
            </div>
        </div>
        <div class="bd company-info" style="margin-top:10px;font-size:14px">
            <ul>
                {if $company[city]||$company[dist]||$company[address]}<li class="cl">
                    <span>{lang xigua_114:address_dot}</span>
                    <label>{$company[city]}{$company[dist]}{$company[address]}</label>
                </li>{/if}
                {if $company[wechat] || $company[qr]}<li class="cl">
                    <span>{lang xigua_114:wechat_dot}</span>
                    <label  onmouseover="showLarge(0)" onmouseout="showLarge(1)">{$company[wechat]}{if $company[qr]}
                        <div class="wechatqrbox" style="position:relative;display:inline-block">
                        <img class="wechatqr" style="height:22px;vertical-align:middle;display:inline-block;margin:0 5px" src="$company[qr]" />
                        <img class="wechatqrlarge" style="display:none;height:auto;margin:0;position:absolute;border:5px solid #fff;z-index:999" id="wechatqrlarge" src="$company[qr]" />
                        </div>
                    {/if}</label>
                </li>{/if}
                {if $company[site]}<li class="cl"><span>{lang xigua_114:site_dot}</span><label><a href="{$company[site]}" rel="nofollow" target="_blank">{$company[site]}</a></label></li>{/if}
                {if $company[weibo]}<li class="cl"><span>{lang xigua_114:weibo_dot}</span><label><a href="{$company[weibo]}" rel="nofollow" target="_blank">{$company[weibo]}</a></label></li>{/if}
                {if $company[qq]}<li class="cl qqblock"><span>{lang xigua_114:qq_dot}</span><label><a target="_blank" class="qqtalk" href="http://wpa.qq.com/msgrd?v=3&uin=$company[qq]&site=qq&menu=yes">{$company[qq]}</a></label></li>{/if}
            </ul>
        </div>
    </div></td>
        </tr>
    </table>
</div>
<p class="o pns">
    <button onclick="window.location.href='{$_G[siteurl]}plugin.php?id=xigua_114&mobile=no&ac=report'" class="pn" ><strong>{lang xigua_114:report}</strong></button>
    <button onclick="window.location.href='{$_G[siteurl]}plugin.php?id=xigua_114&mobile=no&ac=join'" class="pn pnc"><strong>{lang xigua_114:joinnow1}</strong></button>
</p>
<script>
function showLarge(hide){
    var large = $('wechatqrlarge');
    if(large){
        if(hide){
            large.style.display = 'none';
        }else{
            large.style.display = 'block';
        }
    }
}
</script>
<script reload="1">
    jQuery.noConflict();
    jQuery('.flexslider1').flexslider({
        animation: "slide",
        prevText:'',
        nextText:'',
        slideshow:true,
        slideshowSpeed:3000
    });
</script>
<!--{template common/footer_ajax}-->