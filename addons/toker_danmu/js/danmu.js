//$(function(){
//	$(".danmu").animate({top:20+"%",opacity:1},500);
//	setTimeout(danmu_xiaoshi,3000)
//})

$(function(){

setInterval(req,3000);

function req(){
	var danmu_url = 'http://wx.tokershop.cn/app/index.php?c=entry&m=toker_danmu&do=danmu';
        $.post(
                danmu_url, {
                    'i': '{$_W["uniacid"]}'
                },
                function (data) {
                   alert(data.message);return;
                   var dan=data.message;//订单条数
                   panduan();
                },
                "json");
                //var dan=5;//订单条数
                //panduan();
};
function panduan(){
	if(dan>0){
		danmu_xainxian();
		
		dan--;
	}
};
function danmu_xainxian(){
	$(".danmu").animate({top:20+"%",opacity:1},1000);
	setTimeout(danmu_xiaoshi,3000);
};
function danmu_xiaoshi(){
	$(".danmu").animate({top:10+"%",opacity:0},1000);
	setTimeout(panduan,1000);
};
})


//易 福 源 码 网
//$(function(){
//	
//	var dan=5;
//	panduan();
// 
//function panduan(){
//	if(dan>0){
//		danmu_xainxian();
//		
//		dan--;
//	}
//};
//function danmu_xainxian(){
//	$(".danmu").animate({top:20+"%",opacity:1},1000);
//	setTimeout(danmu_xiaoshi,3000);
//};
//function danmu_xiaoshi(){
//	$(".danmu").animate({top:10+"%",opacity:0},1000);
//	setTimeout(panduan,1000);
//};
//})