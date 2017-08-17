var fnTimeCountDown = function(d, o){
	var f = {
		haomiao: function(n){
			if(n < 10)return "00" + n.toString();
			if(n < 100)return "0" + n.toString();
			return n.toString();
		},
		zero: function(n){
			var n = parseInt(n, 10);//解析字符串,返回整数
			if(n > 0){
				if(n <= 9){
					n = "0" + n;	
				}
				return String(n);
			}else{
				return "00";	
			}
		},
		dv: function(){
			//d = d || Date.UTC(2050, 0, 1); //如果未定义时间，则我们设定倒计时日期是2050年1月1日
			var now = new Date();
			//现在将来秒差值
			//alert(future.getTimezoneOffset());
			var dur = (d - now.getTime()) / 1000 , mss = d - now.getTime() ,pms = {
				hm:"000",
				sec: "00",
				mini: "00",
				hour: "00",
				day: "00",
				month: "00",
				year: "0"
			};
			if(mss > 0){
				pms.hm = f.haomiao(mss % 1000);
				pms.sec = f.zero(dur % 60);
				pms.mini = Math.floor((dur / 60)) > 0? f.zero(Math.floor((dur / 60)) % 60) : "00";
				pms.hour = Math.floor((dur / 3600)) > 0? f.zero(Math.floor((dur / 3600)) % 24) : "00";
				pms.day = Math.floor((dur / 86400)) > 0? f.zero(Math.floor((dur / 86400))) : "00";// % 30
				//月份，以实际平均每月秒数计算
				pms.month = Math.floor((dur / 2629744)) > 0? f.zero(Math.floor((dur / 2629744)) % 12) : "00";
				//年份，按按回归年365天5时48分46秒算
				pms.year = Math.floor((dur / 31556926)) > 0? Math.floor((dur / 31556926)) : "0";
			}else{
				pms.year=pms.month=pms.day=pms.hour=pms.mini=pms.sec="00";
				pms.hm = "000";
				//location.reload(true);
				return;
			}
			return pms;
		},
		ui: function(){			
			if(o.hm){
				o.hm.html(f.dv().hm);
			}
			if(o.sec){
				o.sec.html(f.dv().sec);
			}
			if(o.mini){
				o.mini.html(f.dv().mini);
			}
			if(o.hour){
				o.hour.html(f.dv().hour);
			}
			if(o.day){
				o.day.html(f.dv().day);
			}
			if(o.month){
				o.month.html(f.dv().month);
			}
			if(o.year){
				o.year.html(f.dv().year);
			}			
			setTimeout(f.ui, 1);			
		}
	};	
f.ui();
};

function pageLoadCommon(a, b) {
	a.scroll(function() {
		distanceScrollCount = document.body.scrollHeight;
		distanceScroll = document.body.scrollTop;
		topicPageHight = document.body.clientHeight;
		1 >= distanceScrollCount - distanceScroll - topicPageHight && b()
	})
}

/*声音播放完毕事件*/
function voicePlayOver(){
	if(globalObj.voicePlaying){
		globalObj.voicePlaying.removeClass("active");
		globalObj.isPlaying=false;
	}
}

function QuestionBind(){
	$(".whisper_question").unbind();
	$(".whisper_question").click(function(){
		var url=$(this).attr('attr-href');
		location.href=url;
	});
}

/*声音播放事件*/
function voicePlay(){
	$(".chat").unbind();
	$(".chat").click(function(){
		$(".chat").removeClass("active");
		var recordMsg=$(this);
		var voice_str=recordMsg.attr('attr-src');
		if(voice_str=='pay'){
		   var ask_id=recordMsg.parents(".box").attr('attr-id');
		   var answer_id=recordMsg.parents(".box").attr('attr-aid');
		   var pay_type=recordMsg.attr('ask-type');
		   //设置当前支付的问答信息
		   globalObj.recordPay=recordMsg;
		   showTips("努力请求中..",5000);
		   var submitData={submit: true,ask_type:'public',ask_id:ask_id,pay_type:pay_type};
		   var pay_url=my_ask_index;
		   if(pay_type=='reward_listen'){
			   submitData={"op":"reward_listen",answer_id:answer_id,ask_id:ask_id};
			   pay_url=ask_pay_url;
		   }
		   $.getJSON(pay_url,submitData, function(json){
				$(".min_tips_box").hide();  
			   callpay(json,'listen');  
		   });
		   return;
		}
		
		if(voice_str.indexOf('http')==0){
 		  	var media = $('#dgAudioPlayer')[0];
 		  	if($("#dgAudioPlayer").attr('src')!=voice_str)
 		  	   $("#dgAudioPlayer").attr('src',voice_str);
 		  	if(media.paused) { 
 		  		media.play();
 		  		recordMsg.addClass("active");
 		  		globalObj.isPlaying=true;
 		    } else {  
 		    	media.pause(); 
 		    	recordMsg.removeClass('active')
 		    }
 		  	globalObj.voicePlaying=recordMsg;

 		  	media.removeEventListener("ended",voicePlayOver,false);
		  	media.addEventListener("ended",voicePlayOver,false);
		  	return;
		}
		
		if(recordMsg.attr("localid")){
		    var localId=recordMsg.attr("localid");
		    if($(this).hasClass('active')){
		    	wx.pauseVoice({
		    	    localId: localId // 需要暂停的音频的本地ID，由stopRecord接口获得
		    	});
		    	$(this).removeClass('active')
		    }else{
		    	wx.playVoice({
		    	    localId: localId // 需要播放的音频的本地ID，由stopRecord接口获得
		    	});
		    	$(this).addClass("active");
		    	wx.onVoicePlayEnd({
		    	    success: function (res) {
		    	    	recordMsg.removeClass("active");
		    	    }
		    	});
		    }
		    return;	 
		 }
		
		  wx.downloadVoice({
			    serverId: recordMsg.attr('attr-src'), // 需要下载的音频的服务器端ID，由uploadVoice接口获得
			    isShowProgressTips: 0, // 默认为1，显示进度提示
			    success: function (res) {
			        var localId = res.localId; // 返回音频的本地ID
			        recordMsg.addClass("active");
			        recordVoice.attr('localid',localId);
			        wx.playVoice({
			            localId: localId // 需要播放的音频的本地ID，由stopRecord接口获得
			        });
			        wx.onVoicePlayEnd({
			    	    success: function (res) {
			    	    	recordMsg.removeClass("active");
			    	    }
			    	});
			    }
			});  
	  });
}

/*微信支付开始*/
function jsApiCall(parameters,pay_type){
	var jsdata=JSON.parse(parameters.jsdata);
		WeixinJSBridge.invoke(
		    'getBrandWCPayRequest',
			jsdata,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				if(res.err_msg == "get_brand_wcpay_request:ok") {
					if(pay_type=='ask'){
						 $(".qlws_as_text").val('');
						 $.post(send_url,{ask_id:parameters.ask_id,notice_type:'ask'},function(result){
							  location.href=location.href+"&a=1";//刷新页面
					  	});				  
					}
					else if(pay_type=='reward'){
						$(".releaseSuc").addClass("active");
						$("#reward_desc").val('');
						$("#reward_money").val('');
						$("#reward_days li.active").removeClass('active');
					}
					else if(pay_type=='reward_details' || pay_type=="listen"){
						location.href=location.href;
					}
					else{
						var ask_id=globalObj.recordPay.parents(".box").attr('attr-id');
						//alert(ask_id);
						$.post(get_user_url,{op:'ask','ask_type':'all','mdo':"getanswer",ask_id:ask_id,pindex:1},function(result){
							var html=getAskHtml(result);
							var obj=globalObj.recordPay.parents("li");
							obj.replaceWith(html);
							voicePlay();
							QuestionBind();
						});
					}
               } else if(res.err_msg == "get_brand_wcpay_request:cancel"){
               }else{
               	  alert(res.err_msg);
               }
			}
		);
}

function callpay(parameters,pay_type){
	if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall(parameters,pay_type);
	}
}
/*微信支付结束*/

function showTips(text,seconds){
	$(".textTip").show();
	$(".textTip").children("p").text(text);
	setTimeout(function(){
		$(".textTip").hide();
	},seconds);
}

function Follow(){
	$(".listen").unbind();
	$(".listen").click(function(){
		var uid=$(this).attr('data');
		var dgSt=$(this);
		var op="follow";
		if($(this).hasClass('active'))
			op="cancel";
		$.post(follow_url,{op:op,uid:uid},function(result){
			if(result.success==1){
				if(result.follow==1){
					dgSt.removeClass('active');
					dgSt.addClass('active');
					showTips("成功收听",1500);
				}else{
					dgSt.removeClass('active');
					showTips("已取消收听",1500);
				}
			}else{
				alert(result.data);
			}
		});
	});
}

/*获取公开的分答数据HTML*/
function getAskPublicHtml(Qindex,List){
	var last_html="";
	last_html+='<li class="fen">';
	last_html+='<div class="questioner clearfix">';
	last_html+='<span class="yel fr"><i class="iconfont">&#xe61e;</i> '+List[Qindex].pay_money+'</span>';
	last_html+='<div class="avatar mr5 fl">';
	if(List[Qindex].is_nm==1){
	last_html+='<img src="../web/resource/images/gw-wx.gif" width="30" height="30">';
	last_html+='</div>';
	last_html+='<div class="name fl gray">匿名</div>';
	}else{
	last_html+='<img src="'+List[Qindex].pay_avatar+'" width="30" height="30">';
	last_html+='</div>';
	last_html+='<div class="name fl gray">'+List[Qindex].pay_nickname+'</div>';
	}
	last_html+='</div>';
	last_html+='<div class="ask whisper_question" attr-href="'+ask_detailurl+'&type=expert&ask_id='+List[Qindex].id+'">';
	last_html+='<p>'+List[Qindex].ask_content+'</p>';
	last_html+='</div>';
	
	if(List[Qindex].answer){
	last_html+='<div class="info">';
	last_html+='<h3 class="gray">'+List[Qindex].real_name+'<span>'+List[Qindex].user_title+'</span></h3>';
	last_html+='</div>';	
	last_html+='<div class="reply flex2">';
	
	if(List[Qindex].vstatus==1){
		last_html+='<div class="avatar renzheng">';
	}else{
		last_html+='<div class="avatar">';
	}
	last_html+='<a href="'+my_ask_index+"&uid="+List[Qindex].payto_uid+'">';
	last_html+='<img src="'+List[Qindex].payto_avatar+'" width="40" height="40">';
	last_html+='</a>';
	last_html+='</div>';
	last_html+='<div class="voice sub">';
	
	     temp_index=1;
	     for(var aindex in List[Qindex].answer){ 
		    last_html+='<div class="box" attr-id="'+List[Qindex].id+'" attr-aid="'+List[Qindex].answer[aindex].id+'">';
		      if(temp_index==List[Qindex].answer.length){
		           last_html+='<span class="visit gray fr">'+List[Qindex].paycount+'人旁听</span>';
			  }
		      if(List[Qindex].show==true){
				last_html+='<div class="chat" attr-src="'+List[Qindex].answer[aindex].answer_content+'">';
				if(List[Qindex].pay_money==0)
					 last_html+='免费播放</p>';
				  else
					 last_html+='点击播放</p>';
				 last_html+='</div>';
		      }else{
				 last_html+='<div class="chat" attr-src="pay"  ask-type="listen">'+listen_money+'元旁听</div>';
			  }
			 last_html+='</div>';
		     temp_index++;
	     }
	 
	 last_html+='</div>';
	 last_html+='</div>';
	}else{
		last_html+='<div class="wei tc">';
		 if (is_myindex){
		  last_html+='<a href="'+ask_detailurl+'&type=expert&ask_id='+List[Qindex].id+'">';
		  last_html+='<button>我要回答</button>';
		  last_html+='</a>';
		  last_html+='<i class="text-tips">48小时没有回答，付款将自动退回</i>';
		 }
		  else{
		     last_html+='<i class="text-tips">暂无回答~</i>';
		  }
		last_html+='</div>';
	 }
	 
     last_html+='</li>';
     return last_html;
}
/*获取悬赏的分答数据HTML*/
function getAskRewardHtml(Qindex,List){
	var last_html="";
	if(List[Qindex].reward_overtime>0){
	  last_html+='<li class="shang over">';
	}else{
		last_html+='<li class="shang">';
	}
	last_html+='<div class="questioner clearfix">';
	last_html+='<span class="yel fr"><i class="iconfont">&#xe618;</i> '+List[Qindex].pay_money+'</span>';
	if(List[Qindex].vstatus==1){
		last_html+='<div class="avatar renzheng mr5 fl">';
	}else{
		last_html+='<div class="avatar mr5 fl">';
	}
	if(List[Qindex].is_nm==1){
	last_html+='<img src="../web/resource/images/gw-wx.gif" width="30" height="30">';
	last_html+='</div>';
	last_html+='<div class="name fl gray">匿名</div>';
	}else{
	last_html+='<img src="'+List[Qindex].pay_avatar+'" width="30" height="30">';
	last_html+='</div>';
	last_html+='<div class="name fl gray">'+List[Qindex].pay_nickname+'</div>';
	}
	last_html+='</div>';
	last_html+='<div class="ask whisper_question" attr-href="'+reward_detailurl+'&ask_id='+List[Qindex].id+'">';
	last_html+='<p>'+List[Qindex].ask_content+'</p>';
	last_html+='</div>';
	if(List[Qindex].answer){
	     for(var aindex in List[Qindex].answer){ 
			last_html+='<div class="reply">';
			last_html+='<div class="info">';
			if(List[Qindex].answer[aindex][0].real_name)
			  last_html+='<h3 class="gray">'+List[Qindex].answer[aindex][0].real_name+'<span>'+List[Qindex].answer[aindex][0].user_title+'</span></h3>';
			else
				last_html+='<h3 class="gray">'+List[Qindex].answer[aindex][0].nickname+'</h3>';
			last_html+='</div>';
			if(List[Qindex].answer[aindex][0].score==5){
			    last_html+='<span class="yel best"><i class="iconfont ">&#xe619;</i></span>';
			}
			
			if(List[Qindex].answer[aindex][0].vstatus==1){
				last_html+='<div class="avatar renzheng fl">';
			}else{
				last_html+='<div class="avatar fl">';
			}
			last_html+='<a href="'+my_ask_index+"&uid="+List[Qindex].answer[aindex][0].answer_uid+'">';
			last_html+='<img src="'+List[Qindex].answer[aindex][0].payto_avatar+'" width="40" height="40">';
			last_html+='</a>';
			last_html+='</div>';
			last_html+='<div class="voice">';
          //console.dir(List[Qindex].answer);
          
		  for(var dindex in List[Qindex].answer[aindex]){
		     temp_index=1;
				last_html+='<div class="box" attr-id="'+List[Qindex].id+'" attr-aid="'+List[Qindex].answer[aindex][dindex].id+'">';
				last_html+='<span class="visit gray fr">'+List[Qindex].answer[aindex][dindex].paycount+'人旁听</span>';
				if (List[Qindex].answer[aindex][dindex].show==true || List[Qindex].show==true){
				last_html+='<div class="chat" attr-src="'+List[Qindex].answer[aindex][dindex].answer_content+'">';
				     if (List[Qindex].pay_money==0)
				    	  last_html+='免费播放';
				     else
				    	  last_html+='点击播放</div>';
				}
				 else{
				    last_html+=' <div class="chat" attr-src="pay" ask-type="reward_listen">'+listen_money+'元旁听</div>';
				}
				last_html+='</div>';
				temp_index++;
				last_html+='</div>';
	    }

	    last_html+='</div>';
	}
	}else{
		last_html+='<div class="wei tc">';
		 if (is_myindex==false && !List[Qindex].is_timeout){
		   last_html+='<a href="'+reward_detailurl+'&ask_id='+List[Qindex].id+'">';
		   last_html+='<button>我要回答</button>';
		   last_html+='</a>';
		 }
		  else if(List[Qindex].is_timeout){
			  last_html+='<i class="text-tips">该悬赏已结束~</i>';
		  }else{
			  last_html+='<i class="text-tips">暂无回答~</i>';
		  }
		  
		last_html+=' </div>';
	}
    last_html+='</li>';   
   return last_html;
}
/*获取分答数据HTML*/
function getAskHtml(result){
	var last_html="";
	
	for(var qindex in result.list){
		if(result.list[qindex].ask_type=='reward')
			last_html+=getAskRewardHtml(qindex,result.list);
		else
		    last_html+=getAskPublicHtml(qindex,result.list);
	}
	return last_html;
}

/*获取用户列表数据*/
function getUserHtml(result){
	var last_html='';
	for(var qindex in result.list){
	  last_html+='<li class="flex2">';
	  if(result.list[qindex].vstatus==1){
		last_html+='<div class="avatar renzheng">';
	  }else{
		last_html+='<div class="avatar">';
	  }
	  last_html+='<a href="'+my_ask_index+'&uid='+result.list[qindex].id+'">';
	  last_html+='<img src="'+result.list[qindex].avatar+'" width="60" height="60">';
	  last_html+='</a>';
	  last_html+='</div>';
	  last_html+='<div class="info sub">';
	  last_html+='<div class="indro">';
	  last_html+='<h3 class="f16">';
	  last_html+='<span class="ml5 gray f12 fr"><i class="iconfont">&#xe616;</i> '+result.list[qindex].follow_num+'人收听</span>';
	  last_html+='<span class="yel"><i class="iconfont"></i> '+result.list[qindex].pay_money+'</span>';
	  last_html+='<a href="'+my_ask_index+'&uid='+result.list[qindex].id+'">';
	  last_html+=result.list[qindex].real_name;
	  last_html+='</a>';
	  last_html+='</h3>';
	  last_html+='<p class="mt5 f12">';
	  last_html+=result.list[qindex].user_title;
	  last_html+='</p>';
	  last_html+='<p class="mt5 gray f12">';
	  last_html+=result.list[qindex].user_desc;
	  last_html+='</p></div>';
	  last_html+='<div class="tags mt10 clearfix">';
	   
	  if (result.list[qindex].tags){
		  var tag_array=result.list[qindex].tags;
	      for(i=0;i<tag_array.length;i++){
	    	  last_html+='<span>'+tag_array[i]+'</span>';
	      }
	  }
	
     last_html+='</div>';
     last_html+='<div class="mt10 btn">';
     last_html+='<a href="'+my_ask_index+'&uid='+result.list[qindex].id+'" class="putQ">向TA提问</a>';
     if(result.list[qindex].listen&&result.list[qindex].listen==1)
         last_html+='<a href="javaScript:;" data="'+result.list[qindex].id+'" class="listen ml10 active">收听 <i class="iconfont">&#xe617;</i></a>';
     else
    	 last_html+='<a href="javaScript:;" data="'+result.list[qindex].id+'" class="listen ml10">收听 <i class="iconfont">&#xe617;</i></a>'; 
     last_html+='</div>';
     last_html+='</div>';
     last_html+='</li>';
	}
	return last_html;
}

/*获取问题列表*/
function ajax_ask_list(){
	if(globalObj.isloading)return;
	globalObj.isloading=true;
	$(".loading").show();
	$(".noMore").hide();
	pindex++;
	var tag_id=$(".mytag.active").eq(0).attr('attr-id');
	var postData={pindex: pindex,op:'ask',ask_type:ask_type};
	if(keyword!=''){
		postData.keyword=keyword;
	}
	if(tag_id!="0"){
		postData.tags=tag_id;
	}
	
	$.post(get_user_url, postData, function(result){
		$(".loading").hide();
		if(result.pages<pindex){
			$(".noMore").show();
			globalObj.isloading=false;
			return false;
		}
		pindex=result.pindex;
		//console.dir(result);
		
		var html=getAskHtml(result);
		$(".itemList ul").append(html);
		voicePlay();
		globalObj.isloading=false;
		QuestionBind();
	});	
}

/*获取专家列表*/
function ajax_users_list(){
	if(globalObj.isloading)return;
	globalObj.isloading=true;
	 $(".loading").show();
	 $(".noMore").hide();
	upindex++;
	var postData={pindex: upindex,op:'user'};
	var tag_id=$(".mytag.active").eq(0).attr('attr-id');
	if(tag_id!="0"){
		postData.tags=tag_id;
	}
	
	if(keyword!=''){
		postData.keyword=keyword;
	}
	
	if(expert_order!=""){
		postData.expert_order=expert_order;
	}
	
	$.post(get_user_url, postData, function(result){
		$(".loading").hide();	
		if(result.pages<upindex){
			$(".noMore").show();
			globalObj.isloading=false;
			return false;
		}
		upindex=result.pindex;			
		var html=getUserHtml(result);
		$(".expertList ul").eq(0).append(html);
		globalObj.isloading=false;
		Follow();
	});	
}
