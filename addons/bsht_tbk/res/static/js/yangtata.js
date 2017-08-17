;(function($){
    $.yangtata = $.yangtata || {version: "v1.0.0"},
    $.extend($.yangtata, {
        util: {
            getStrLength: function(str) {
                str = $.trim(str);
                var length = str.replace(/[^\x00-\xff]/g, "**").length;
                return parseInt(length / 2) == length / 2 ? length / 2: parseInt(length / 2) + .5;
            },
            empty: function(str) {
                return void 0 === str || null === str || "" === str
            },
            isURl: function(str) {
                return /([\w-]+\.)+[\w-]+.([^a-z])(\/[\w-.\/?%&=]*)?|[a-zA-Z0-9\-\.][\w-]+.([^a-z])(\/[\w-.\/?%&=]*)?/i.test(str) ? !0 : !1
            },
            isEmail: function(str) {
                return /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(str);
            },
            minLength: function(str, length) {
                var strLength = $.qupai.util.getStrLength(str);
                return strLength >= length;
            },
            maxLength: function(str, length) {
                var strLength = $.qupai.util.getStrLength(str);
                return strLength <= length;
            },
            redirect: function(uri, toiframe) {
                if(toiframe != undefined){
                    $('#' + toiframe).attr('src', uri);
                    return !1;
                }
                location.href = uri;
            },

			setCookie: function(name, value) {
				var Days = 30; 
				var exp = new Date(); 
				exp.setTime(exp.getTime() + Days*24*60*60*1000); 
				document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString(); 
			},
			getCookie: function(name) {
				var arg = name + "="; 
				var alen = arg.length; 
				var clen = document.cookie.length; 
				var i = 0; 
				while (i < clen) 
				{ 
				var j = i + alen; 
				if (document.cookie.substring(i, j) == arg) {
					return $.yangtata.util.getCookieVal (j); 
				}
				i = document.cookie.indexOf(" ", i) + 1; 
				if (i == 0) 
				break; 
				} 
				return null; 

			},
			getCookieVal: function (offset){
				var endstr = document.cookie.indexOf (";", offset); 
				if (endstr == -1) 
				endstr = document.cookie.length; 
				return unescape(document.cookie.substring(offset, endstr)); 
			},
            base64_decode: function(input) {
                var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
                var output = "";
                var chr1, chr2, chr3 = "";
                var enc1, enc2, enc3, enc4 = "";
                var i = 0;
                //if(typeof input.length=='undefined')return '';
                if(input.length%4!=0){
                    return "";
                }
                var base64test = /[^A-Za-z0-9\+\/\=]/g;
                
                if(base64test.exec(input)){
                    return "";
                }
                
                do {
                    enc1 = keyStr.indexOf(input.charAt(i++));
                    enc2 = keyStr.indexOf(input.charAt(i++));
                    enc3 = keyStr.indexOf(input.charAt(i++));
                    enc4 = keyStr.indexOf(input.charAt(i++));
                    
                    chr1 = (enc1 << 2) | (enc2 >> 4);
                    chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                    chr3 = ((enc3 & 3) << 6) | enc4;
                    
                    output = output + String.fromCharCode(chr1);
                    
                    if (enc3 != 64) {
                        output+=String.fromCharCode(chr2);
                    }
                    if (enc4 != 64) {
                        output+=String.fromCharCode(chr3);
                    }
                    
                    chr1 = chr2 = chr3 = "";
                    enc1 = enc2 = enc3 = enc4 = "";
                
                } while (i < input.length);
                return output;
            }
        }
    });
})(jQuery);

;(function($){
    //把对象调整到中心位置
    $.fn.setmiddle = function() {
        var dl = $(document).scrollLeft(),
            dt = $(document).scrollTop(),
            ww = $(window).width(),
            wh = $(window).height(),
            ow = $(this).width(),
            oh = $(this).height(),
            left = (ww - ow) / 2 + dl,
            top = (oh < 4 * wh / 7 ? wh * 0.382 - oh / 2 : (wh - oh) / 2) + dt;
                
        $(this).css({left:Math.max(left, dl) + 'px',top:Math.max(top, dt) + 'px'});             
        return this;
    }
    //返回顶部
    $.fn.returntop = function() {
        var self = $(this);
        self.live({
            mouseover: function() {
                $(this).addClass('return_top_hover');
            },
            mouseout: function() {
                $(this).removeClass('return_top_hover');
            },
            click: function() {
                $("html, body").animate({scrollTop: 0}, 120);
            }
        });
        $(window).bind("scroll", function() {
            $(document).scrollTop() > 0 ? self.fadeIn() : self.fadeOut();
        });
    }
})(jQuery);