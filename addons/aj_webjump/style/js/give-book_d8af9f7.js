var $=require("common:widget/jquery/1.11.3/jquery.js"),ZM=require("common:widget/zm/zm.js");require("common:widget/wechat/jweixin-1.0.0.js"),$(function(){function e(e){ZM.Api.post("/api/wechat/get-signature",{signUrl:location.href.split("#")[0]},function(n){var i=n.data;jWeixin.config({debug:!1,appId:i.appId,timestamp:i.timestamp,nonceStr:i.nonceStr,signature:i.signature,jsApiList:["checkJsApi","onMenuShareTimeline","onMenuShareAppMessage","onMenuShareQQ","onMenuShareWeibo"]}),jWeixin.ready(function(){jWeixin.onMenuShareAppMessage(e),jWeixin.onMenuShareTimeline(e),jWeixin.onMenuShareQQ(e),jWeixin.onMenuShareWeibo(e)})})}{var n=$(".submit-btn"),i=$(".mask"),o=$(".share-friends");$(".success-share")}window.rightWay&&(window.location.href=window.location.href+"/view");var c=!1;n.on("touchmove",function(){c=!0}).on("touchend",function(){return c?void(c=!1):(i.addClass("blur"),void o.show())}),o.on("touchend",function(){i.removeClass("blur"),o.hide()}),e({title:"我参与了免费领书活动！有机会获得龙应台“人生三书”1套！",desc:"我参与了世界读书日送书活动，你也赶紧来免费领书！",link:"https://mp.weixin.qq.com/s?__biz=MjM5MzcxMjQzOQ==&mid=402964118&idx=1&sn=9492e19cb56f57b541a88ca79381b3fa&scene=1&srcid=0327IUIcCNXkKFSJZ0ZfjBJf&key=710a5d99946419d91cb83200d07bad580bae1e7c10544126a3b20e66e7a04e3103d8921a3906045c32bbbde31fe1975f&ascene=0&uin=MTE2MTQzMTcwMQ%3D%3D&devicetype=iMac+MacBookPro12%2C1+OSX+OSX+10.11.3+build(15D21)&version=11020201&pass_ticket=6nGwKy0ZZSkMXVVkwqENOljjZgDnOKmF3qTdV4cy84mPvd%2BWNEVvqMUE3ABG2FOH",imgUrl:document.getElementById("wechat-thumb").src,trigger:function(){},success:function(){location.href="/mobile/game/give-book/share-success"},cancel:function(){},fail:function(){}})});