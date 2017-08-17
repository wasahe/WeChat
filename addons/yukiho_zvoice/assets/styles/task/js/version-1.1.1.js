//------------------------------------------------------
//IPtest();
function IPtest(){ //安卓APP 测试
$("body").append('<div class="lay_menu" style="position:fixed;top:70%;left:2%;z-index:2;"><a onclick="myrefresh();" style="width:0.7rem; height:0.7rem;background:#f60;border-radius:50%;color:#fff;font-size:0.2rem;line-height:0.7rem;text-align:center;cursor:pointer;display:block;">刷新</a><a href="index.asp" style="width:0.7rem; height:0.7rem;background:#f60;border-radius:50%;color:#fff;font-size:0.2rem;line-height:0.7rem;text-align:center;cursor:pointer;display:block;margin-top:0.1rem">返回</a></div>');
}
//------------------------------------------------------
function myrefresh(){ //刷新页面
		 window.location.reload();
}
//------------------------------------------------------
autoheight(".ohei");
function autoheight(obj){
	autoh();
	$(window).resize(function(){
		autoh();
		});
		function autoh(){
				$(obj).height($(window).height());
			}
}
//------------------------------------------------------
	function evaluate(click_obj){ //星星评价
			$(click_obj).click(function(){
			$(click_obj).removeClass("ico");
			$(this).addClass("ico");
			$(click_obj+":lt("+$(this).index()+")").addClass("ico");
			
		})
	}
//------------------------------------------------------
function test(obj,value){
var u = navigator.userAgent;
var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
var flag = IsPC(); //true为PC端，false为手机端

if (isiOS && flag){
$(obj).each(function(index, element) {
    if($(this).val()==""){
			$(this).css("height",value);
		}
});
$(obj).blur(function(){
	if($(this).val()!=""){
		$(this).removeAttr("style");
	}
	else{
		$(this).css("height",value);
		}
	})
};
}
function IsPC() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone",
                "SymbianOS", "Windows Phone",
                "iPad", "iPod"];
    var flag = false;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) {
            flag = true;
            break;
        }
    }
    return flag;
}

function slide_menu(main_div,click_hide,click_show,bettow){//左侧划出菜单
	var wibody=$("body").width();
	var objwid=$(".mobile_wrap").width();
	if(wibody>objwid){
			$(main_div).fadeOut().removeClass("opacity");
			$(click_hide).click(function(){
			$(main_div).fadeOut();
				})
			$(click_show).click(function(){
				$(main_div).fadeIn();
				})
		}else{
					$(main_div).removeClass("opacity").css({"margin-left":bettow*wibody});
					$(click_show).click(function(){
					$(main_div).animate({"margin-left":0});
					})
					$(click_hide).click(function(){
					$(main_div).animate({"margin-left":bettow*wibody});
					})
			}
	}			
function radio(obj){ //点击对象-单选
		$(obj).click(function(){
				$(this).find("input[type='radio']").prop("checked","checked");
			})
	}
function numadd(obj,click_left,click_right){//数量加减
	var i=1;
	$(click_left).click(function(){
			if(i>1){
					i--;
					$(this).parent().find("input").val(i);
				}
			if(i==1){
					$(this).addClass("noadd");
				}
			
		})
	$(click_right).click(function(){
			i++;
			$(obj).removeClass("noadd");
			$(this).parent().find("input").val(i);
		})
	}

function judge_tstate(obj_input,obj_state){//登录框-按钮状态
var i=0;
$(obj_input).keyup(function(){
		i=0;
		var vale=$(this).val().length;
		if(vale>0){
			$(this).attr("text","1");	
		}
		else{
			$(this).attr("text","0");
		}
		$(obj_input).each(function(index, element) {
            if($(this).attr("text")=="1"){
				i++;
				if(i>1){
						$(obj_state).addClass("active");
					}else{
						$(obj_state).removeClass("active");
						}
				}
        });
	})
}

function alertbox(click_show,click_hide,obj,box_vague){//弹窗js
	$(obj).find(".layout").css({"-webkit-transform":"scale(0) translate(0,-0.5rem)","transition":"0.3s"});
	$(click_hide).click(function(){
			$(obj).fadeOut();
			$(obj).find(".layout").css({"-webkit-transform":"scale(0)  translate(0,-0.5rem)"});
			$(box_vague).removeClass("mohu");
		})
	$(click_show).click(function(){
			$(obj).fadeIn();
			$(obj).find(".layout").css({"-webkit-transform":"scale(1)  translate(0,0)"});
			$(box_vague).addClass("mohu");
		})
}

function judge(obj,fun1,fun2){//判断复选框
	$(obj).click(function(){
			if($(this).find("input[type=checkbox]").is(":checked")==true){
					fun1();
			}else{
					fun2();
				}
		})
}

function imgauto(obj){//  图片适应
				var ite=0;
				$(obj).load(function(){
					 ite++; 
					 $(obj).css("width","auto");
					$(this).attr("load","1");
							$(obj).each(function(index, element) {
								if($(this).attr("load")==1){
									$(this).width($(this).width()/100+"rem");
					
								}	})	
			})	;
			
			if(ite==0){
					$(obj).each(function(index, element) {
						$(this).attr("load","1");
						$(this).width($(this).width()/100+"rem");						
			})
	setTimeout(function(){
			$(obj).each(function(index, element) {
				if($(this).attr("load")!=1){
						$(this).width($(this).width()/100+"rem");
					}
				});
		},1500)
					//console.log("null");
						
			}	
					
	}

function click_addname(obj,className,Boolean){//给对象添加类  1.点击的对象  2.类名  3.是否清除所有-非零[可选] 
		if(Boolean>0){
		$(obj).click(function(){
				$(obj).removeClass(className);
				$(this).addClass(className);
			})
			}else{
					$(obj).click(function(){
				$(this).addClass(className).siblings().removeClass(className);
			})
				}
	}

function checkbox(obj){
 $(obj).click(function(){
	 	if($(this).find("input[type='checkbox']").is(':checked')==true){
					$(this).parents('li').addClass('acti');
				}else{
						$(this).parents('li').removeClass('acti');
					}
	 })
}
function cli_cgimg(obj){
$(obj).click(function(){
		if($(this).attr("ter")=="1"){
            var path_img=$(this).find('img').attr('src');
			var new_path=path_img.replace("-1.",".");
			$(this).find('img').attr('src',new_path);
			$(this).attr("ter","0");
		}else{
		var path_img=$(this).find('img').attr('src');
		var new_path=path_img.replace(".","-1.");
		$(this).find('img').attr('src',new_path);
		$(this).attr("ter","1");
		}
	})
}

function replaimg(obj){//click变颜色的图标 1.移上去的对象
$('.tbas').hide();
tee=0;
$('.tbas').eq(tee).show();
	$(obj).click(function(){
			$(obj).eq(tee).removeClass('acti');
			$('.tbas').eq(tee).hide();
			var path_img=$(obj).eq(tee).find('img').attr('src');
			var new_path=path_img.replace("-1.",".");
			$(obj).eq(tee).find('img').attr('src',new_path);
			
			$(this).addClass('acti');
			var path_img=$(this).find('img').attr('src');
			var new_path=path_img.replace(".","-1.");
			$(this).find('img').attr('src',new_path);	
			
			tee=$(this).index();		
			$('.tbas').eq(tee).show();
		})
	}
function downslide(cilr,cilra,classname,main){//轮播图 说明：swiper-container   swiper-wrapper   swiper-slide
$(window).resize(function(){
				autowite();
			});
autowite();
function autowite(){
		var tabsSwiper = new Swiper(main,{
		speed:500,
		autoplay:4000,
		loop:true,
		autoplayDisableOnInteraction : false,
		onSlideChangeStart: function(){
			var olen=$(cilra).length;
			var ite=$(main+" .swiper-slide-active").index()-1;
			if(ite==olen){
					ite=0;
					}
			$(cilra).eq(ite).addClass(classname).siblings().removeClass(classname);
		}
	});
	
	$(main).css({"overflow":"hidden"});
	$(cilra).on('touchstart mousedown',function(e){
		e.preventDefault();
		$(cilr).removeClass(classname);
		$(this).addClass(classname);
		tabsSwiper.slideTo( $(this).index()+1);
	});
	$(cilra).click(function(e){
		e.preventDefault();
	});	
	}
}

function tabs_cg(Oobj,Otabch,event){//选项卡切换  1.点击的对象  2.切换的的对象  3.事件
	$(Otabch).hide();
	$(Otabch).first().show();
		$(Oobj)[event](function(){
				$(this).addClass('acti').siblings().removeClass('acti');
				$(Otabch).hide();
				$(Otabch).eq($(this).index()).show();
			});
}
	
function hide(obj,value){//隐藏对象  1.要隐藏的对象  2.滚动条的值
   $(window).scroll(function(){
    var et=$(window).scrollTop();
    if(et>value){
        $(obj).fadeIn();
    }else{
        $(obj).fadeOut();
    }
   }) ;
} 
