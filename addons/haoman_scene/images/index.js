var load_img = [];
load_img.push( '../addons/haoman_scene/images/preloader.gif' );
load_img.push( '../addons/haoman_scene/images/w1.png' );
load_img.push( '../addons/haoman_scene/images/w6.png' );
load_img.push( '../addons/haoman_scene/images/w21.png' );
load_img.push( '../addons/haoman_scene/images/w22.png' );
load_img.push( '../addons/haoman_scene/images/hand2.png' );
load_img.push( '../addons/haoman_scene/images/startbg.png' );
load_img.push( '../addons/haoman_scene/images/title1.png' );
load_img.push( '../addons/haoman_scene/images/btn.png' );
load_img.push( '../addons/haoman_scene/images/title3.png' );
load_img.push( '../addons/haoman_scene/images/btn3.png' );
load_img.push( '../addons/haoman_scene/images/bookbg.jpg' );
load_img.push( '../addons/haoman_scene/images/title2.png' );
load_img.push( '../addons/haoman_scene/images/minebg.jpg' );
load_img.push( '../addons/haoman_scene/images/share.png' );
load_img.push( '../addons/haoman_scene/images/btn2.png' );




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
        // handShake();
    });

    touch.on('.cover_p3', 'swipeup', function(ev){
        console.log(000);
        $(".start").show();
    });

   
}

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
              window.location.href = httpsceneurl;
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

    //关闭分享提示
    $(".share").click(function(){
        $(".share").fadeOut();
    })
}




var audio = document.getElementById("audio");
function music(){
  audio.load();
  audio.play();
  $(".music_btn").on('touchstart',function(){
        if(!audio.paused){
            audio.pause();
            $(".music_btn img").attr('src','../addons/haoman_scene/images/stop.png');
        }else{
            audio.play();
            $(".music_btn img").attr('src','../addons/haoman_scene/images/play.png');
        }
    })
}


