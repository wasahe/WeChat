var load_img = [];
load_img.push( '../addons/haoman_updatehb/images/preloader.gif' );
load_img.push( '../addons/haoman_updatehb/images/w1.png' );
load_img.push( '../addons/haoman_updatehb/images/w6.png' );
load_img.push( '../addons/haoman_updatehb/images/w21.png' );
load_img.push( '../addons/haoman_updatehb/images/w22.png' );
load_img.push( '../addons/haoman_updatehb/images/hand2.png' );
load_img.push( '../addons/haoman_updatehb/images/startbg.png' );
load_img.push( '../addons/haoman_updatehb/images/title1.png' );
load_img.push( '../addons/haoman_updatehb/images/btn.png' );
load_img.push( '../addons/haoman_updatehb/images/title3.png' );
load_img.push( '../addons/haoman_updatehb/images/btn3.png' );
load_img.push( '../addons/haoman_updatehb/images/bookbg.jpg' );
load_img.push( '../addons/haoman_updatehb/images/title2.png' );
load_img.push( '../addons/haoman_updatehb/images/minebg.jpg' );
load_img.push( '../addons/haoman_updatehb/images/share.png' );
load_img.push( '../addons/haoman_updatehb/images/btn2.png' );




var load_img_progress = 0;
var load_img_total = load_img.length;

// 资源图片加载
jQuery.imgpreload(load_img,{
	all: function() {
		$('#loading').hide();
		$('.wrap').show();
	}
});
var type;
var twidth = $(window).width();
var theight = $(window).height();
$(document).ready(function(){
	_init();

    $(document).on("touchmove", function(e) {
        event.stopPropagation();
        event.preventDefault();
    });
})


function _init(){
    cover();
    start();
    booking();
    mine();

    if(ismusic == 1){
      music();
    }
}

function cover(){
    touch.on('.cover_p1', 'swipeup', function(ev){
        $(".cover_p1").fadeOut();
        $(".cover_p2").show();
        // handShake();
    });

    touch.on('.cover_p2', 'swipeup', function(ev){
        $(".cover_p2").fadeOut();
        $(".cover_p3").show();
        handShake();
    });

    $(".cover_p3 .hand_con").click(function(){
        console.log(000);
        $(".start").show();
    })
}
//获取url参数，例:GetQueryString("id");
// function GetQueryString(name){
//      var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
//      var r = window.location.search.substr(1).match(reg);
//      if(r!=null)return  unescape(r[2]); return null;
// }
// var once = GetQueryString('once');
// if(once==1){
//   $(".mine").fadeOut();
// }
function start(){
    //如何参与
    $(".start .btn .btn1").click(function(){
        $(".rule").fadeIn();
    })
    //马上开始
    $(".start .btn .btn2").click(function(){
        $.ajax({
          url: PostIsad,
          dataType:'json',
          success:function(data){
            if(data.success==1){
              $('.cover').hide();
              $(".mine").fadeIn();
            }else{
              alert(data.msg);
            }
          }
        });

        
    })


    $(".rule_btn").click(function(){
        $(".rule").fadeOut();
    })

    $(".result_btn").click(function(){
        window.location.href = indexUrl;
    })
}


function booking(){
    //一键拨号
    $(".booking_con .click .c1 p span").click(function(){
        location.href = 'tel:'+ksmobile;
    })
    // 立即填写
    $(".booking_con .click .c2 p span").click(function(){
        $(".booking_put").fadeIn();
    })

    //会长大的红包
    $(".booking_btn").click(function(){
      // if(once!=1){
      //   window.location.href = indexUrl;
        //$(".mine").fadeIn();
      // }else{
        window.location.href = indexUrl;
      // }
        
    })

    //关闭信息填写
    $(".booking_put_off").click(function(){
      $(".booking_put").fadeOut();
    })

    //提交信息
    $(".booking_put_btn").click(function(){
        var realname = $(".booking_put_con input.name").val();
        var mobile = $(".booking_put_con input.tel").val();
        var addr = $(".booking_put_con input.addr").val();
        // alert(openid);
        if(realname == ''){
            alert("请填写姓名");
        }else if(mobile == ''){
            alert("请填写电话");
        }else if(isNaN(mobile)){
            alert("电话只能是数字");
        }else{
            var ischeck = true;
            if(ischeck){
                ischeck = false;
                $.post(information, {'realname': realname,'mobile':mobile,'addr':addr}, function(idata) {
                  if (idata.success == 1) {
                      alert('报名成功');
                      $(".booking_put").fadeOut();
                  } else {
                      alert(idata.msg);
                      $(".booking_put").fadeOut();
                  }
                ischeck = true;
                },"json");
            }
            
            
        }
    })
}

function mine(){
    // 点击切换
    // $(".mine_top i").click(function(){
    //     if(confirm("切换模式后将会失去之前获得的所有收益哦，是否切换模式?")){
    //          $(".mine").fadeOut();
    //          $(".choose").fadeIn();
    //       }
    // })

    //刷新收益
    var isStart = true;
    $(".mine_money span").click(function(){

      $('#loading').show();
      if(isStart){
        isStart = false;
          $.ajax({
          url: getaward,
          dataType: 'json',
          success:function(data){
            $('#loading').hide();
            if(data.success==1){
              $("#hbtotal").html(data.credit);
              $("#recent").html(data.recent);
              $("#recenttime").html(data.recenttime);
              if(ishbad ==1){
                $("#hbnum").html('￥'+data.recent);
                $(".result").show();
              }
            }else if(data.success==3){
                $(".gz").show();
            }else if(data.success==4){
                $("#token").val("sx_code")
                $(".tel_cover").show();
            } else{
                alert(data.msg);
            }
            isStart = true;
          }
        })

      }

     
    })

    //分享到朋友圈
    $(".mine_btn .share_1").click(function(){
        $(".share").fadeIn();
    })

    //再看一次
    $(".mine_btn .once_1").click(function(){
        $.ajax({
          url: OnceIsad,
          dataType:'json',
          success:function(data){
            if(data.success==1){
              window.location.href = indexUrl;
            }else{
              alert(data.msg);
            }
          }
        });
        
    })
    
    //红包提现
    $("#tixian").click(function(){
      
        $.ajax({
          url: application,
          dataType:'json',
          success:function(data){
            if(data.success==1){
              alert(data.msg);
              window.location.href = indexUrl;
            }else if(data.success==5){ //未获取到fansID，弹出关注二维码图标
              $(".gz").show();
            }else if(data.success==11){
                $("#token").val("tx_code");
                $(".tel_cover").show();
            }
            else{
              alert(data.msg);
            }
          }
        });

    })

     $("#password").click(function(){
        $("#pwtitle").html('输入红包口令');
        $('.pw').show(1000);
     })


     $("#btnx").on("click", function () {
        var title = $("#title").val();
        if(title==''){
            $(".nothingbg").html("请输入正确的口令");
            $('.nothingbg').show(1000);
            $("#title").val('');
            setTimeout(function(){
                $(".nothingbg").hide(1000);
            },3000)
            return false
        }
        $('#loading').show();
        var submitData = {
            title: title,
        };

        $.post(checkpwurl, submitData, function (data) {
              $('#loading').hide();
              $("#title").val('');
              if(data.success==1){
                  $("#hbtotal").html(data.credit);
                  $("#recent").html(data.recent);
                  $("#recenttime").html(data.recenttime);
                if(ishbad ==1){
                  $("#hbnum").html('￥'+data.recent);
                  $(".result").show();
                }else{
                  alert(data.msg);
                  $('.pw').hide(1000);
                }
                
              }else{
                  alert(data.msg);
                  $('.pw').hide(1000);
              }
        }, "json")

    })

    //关闭分享提示
    $(".share").click(function(){
        $(".share").fadeOut();
    })
}


var flag = true;
// 摇一摇功能
function handShake(){
  if(window.DeviceMotionEvent){
      var speed = 25;
      var x = y = z = lastX = lastY = lastZ = 0;
      window.addEventListener('devicemotion', function(){
          var acceleration =event.accelerationIncludingGravity;
          x = acceleration.x;
          y = acceleration.y;
          if(Math.abs(x-lastX) > speed || Math.abs(y-lastY) > speed){
              if(flag){
                //摇一摇结束
                $(".start").show();
                
                flag = false;
              }   
          }
          lastX = x;
          lastY = y;
      }, false);
  }
}//handShake结束


var audio = document.getElementById("audio");
function music(){
  audio.load();
  audio.play();
  $(".music_btn").on('touchstart',function(){
        if(!audio.paused){
            audio.pause();
            $(".music_btn img").attr('src','../addons/haoman_updatehb/images/stop.png');
        }else{
            audio.play();
            $(".music_btn img").attr('src','../addons/haoman_updatehb/images/play.png');
        }
    })
}


