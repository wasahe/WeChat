/**
 * 提示框
 * @param msg
 * @param position
 * @param duration
 * @param url
 */
function show(msg, position, duration,url){
	if($('#core_show_div').length>0){
        $('#core_show_div').remove();
    }
	if(!msg){
	    var m=document.getElementById('core_show_div');
	        var d = 0.2;
	        m.style.webkitTransition = '-webkit-transform ' + d + 's ease-in, opacity ' + d + 's ease-in';
	        m.style.opacity = '0';
	        setTimeout(function() {
	            document.body.removeChild(m)
	        }, d * 1000);
	        return;
	}
	if(position!='bottom' && position!='middle' && position!='top'){
	    position ='bottom';
	}
	
	 duration = isNaN(duration) ? 1000 : duration;
	 var m = document.createElement('div');
	 m.id = 'core_show_div';
	 m.innerHTML = msg;
	 var css = "width:60%; font-size:14px;min-width:150px; background:#000; opacity:0.7; min-height:35px; overflow:hidden; color:#fff; line-height:35px; text-align:center; border-radius:5px; position:fixed; left:20%; z-index:999999;box-shadow:3px 3px 4px #d9d9d9;-webkit-box-shadow: 3px 3px 4px #d9d9d9;-moz-box-shadow: 3px 3px 4px #d9d9d9;";
	 if(position=='top'){
	     css+="top:10%; ";
	 } else if(position=='bottom'){
	      css+="bottom:10%; ";
	 } else if(position=='middle'){
	      css+="top:50%;margin-top:-18px;";
	 }
	 m.style.cssText = css;
	 document.body.appendChild(m);
	 if(duration!=0){
	     setTimeout(function() {
	         var d = 0.2;
	         m.style.webkitTransition = '-webkit-transform ' + d + 's ease-in, opacity ' + d + 's ease-in';
	         m.style.opacity = '0';
	         setTimeout(function() {
	             document.body.removeChild(m)
	         }, d * 1000);
        	 if(url !='' && url!=undefined && url!=null && typeof(url) != "undefined"){ 
	        	 location.href = url;
	         }
	         
	     }, duration);
	 }
}

/**
 * 确认框
 * @param msg
 * @param callback
 */
function confirm(msg,callback){
	var html = '<div id="core_alert"><div class="layer"></div><div class="tips"><div class="title">';
    html+=msg;
    html+='</div><div class="sub"><nav data-action="cancel">取消</nav><nav data-action="ok">确定</nav>';
    html+='</div></div></div>';
    if($('#core_tip').length>0){
        $('#core_tip').remove();
    }
    var div =$(html);
    $(document.body).append(div);
    $('.layer',div).fadeIn(100);$('.tips',div).fadeIn(100);
    div.find('nav').unbind('click').click(function(){
        
        var action=$(this).data('action');
        if(action=='ok'){
            if(callback){
                callback();
            }
        }
        div.remove();
    });
}

/**
 * 缓冲区
 * @param flag
 */
function loading(flag){
	if(flag){
		if ($('#core_loading').length <= 0) {
    		$('body').append('<div id="core_loading" style="top:50%;left:50%;margin-left:-35px;margin-top:-30px;position:absolute;width:80px;z-index:999999"><img src="../addons/sea_creditshop/static/img/loading.svg" width="80" /></div>')
		}else{
			$('#core_loading').show();
		}
	}else{
		$('#core_loading').hide();
	}
}
