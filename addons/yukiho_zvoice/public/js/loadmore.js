var page = 2;
var loading = false;

function initload(url,callback){
    $(document.body).infinite().on("infinite", function() {
        loadmore(url,callback);
    });
}

function loadmore(url,callback){
    if(loading) return;
    loading = true;
    $.get(url,{page:page},function(html){
        if(html){
            callback(html);
            page = page + 1;
            loading = false;
        }else{
            loading = false;
            $('.portfolio-filter-wrapper').velocity({opacity:0},1000);
            $(document.body).destroyInfinite()
        }
    },'html');
}