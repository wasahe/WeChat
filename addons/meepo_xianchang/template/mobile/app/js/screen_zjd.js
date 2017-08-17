var $ResultSeed;
var Players;
var Winers;
var audio_Running,
audio_GetOne;
var resizePart = window.WBActivity.resize = function() {};
var start = window.WBActivity.start = function() {
    window.WBActivity.hideLoading();
    var b = document.getElementById("Audio_Running");
    if (b.play) {
        audio_Running = b
    }
    var a = document.getElementById("Audio_Result");
    if (a.play) {
        audio_GetOne = a
    }
    $(".usercount-label").html("加载数据中...");
    $(".control").hide();
    $.getJSON(PATH_ACTIVITY + Path_url('lottory_user'), {
        rid: scene_id
    },
    function(json) {
        if(json.ret==0 && json.data.length>0){
            Players = json.data;
            var c = Players.length;
            $(".usercount-label").html(c + "人");
            $(".control.button-stop").fadeIn()
        } else {
            alert("数据异常，无法进行抽奖，请刷新！")
        }
    }).fail(function() {
        alert("无法连接服务器，请重试")
    });
    $(".Panel.Top").css({
        top: 0
    });
    $(".Panel.Bottom").css({
        bottom: 0
    });
    $(".Panel.Lottery").css({
        display: "block",
        opacity: 1
    });
    $ResultSeed = $(".lottery-right .result-line");
    $(".control.button-run").on("click", 
    function() {
        start_game()
    });
    $(".control.button-stop").on("click", 
    function() {
        stop_game()
    });
    $(".control.button-nextround").on("click", 
    function() {
        window.location.reload()
    });
    $(".button-reload").on("click", 
    function() {
        window.location.reload()
    });
    $(".select-button").on("click", 
    function(g) {
        var f = $(this),
        c = $(".select-value"),
        d = c.text();
        if (f.hasClass("minus")) {
            if (d > 1) {
                d--;
                c.text(d)
            }
        } else {
            if (f.hasClass("plus")) {
                if (d < Players.length) {
                    d++
                } else {
                    c = Players.length
                }
                c.text(d)
            }
        }
        g.preventDefault();
        return false
    })
};
var getUser = function(f) {
	   window.setTimeout(function() { 
    if (audio_GetOne) {
        audio_GetOne.play()
    } },
        400);
    $(".lottery-right").scrollTop(0);
    var b = $(".lottery-right").scroll(0).children(".result-line").length - 1;
    var a = $ResultSeed.clone();
    a.find(".result-num").html((b + 1));
    a.prependTo(".lottery-right").slideDown();
    var e = a.offset();
    
	 $(".lottery-run").addClass('moving');
	 $(".lottery-run").removeClass('box-moving');
	  window.setTimeout(function() { 
	   window.setTimeout(function() { 
	  $(".lottery-run").removeClass('moving');
	  },
        1000);
	  
	 var c = $(".lottery-run .user");
    var d = c.clone().appendTo("body").css({
        position: "absolute",
        top: c.offset().top,
        left: c.offset().left,
        width: c.width(),
        height: c.height()
    }).addClass('').animate({
        width: 60,
        height: 60,
        top: e.top + 5,
        left: e.left + 50
    },
    500, 
    function() {
        var g = d.css("background-image");
        d.appendTo(a).removeAttr("style").css({
            "background-image": g
        });
        if ($.isFunction(f)) {
            f.call(this)
        }
    })
	 },
       1500)
};

var stop_game = function() {
    $(".control.button-stop").hide();
    if ($.isArray(Players)) {
        winer_count = $(".select-value").text() * 1;
        if (winer_count <= Players.length) {
            getWiner()
        } else {
            alert("计划选" + winer_count + "人，但是只剩" + Players.length + "人可选，请减少选取数！")
        }
    } else {
        alert("无法获得游戏数据，与游戏服务器断开，请刷新重试！")
    }
};
var winer_count = 0;
var getWiner = function() {
    flgPlaying = false;
    window.clearTimeout(tmr_playanimate);
    var b = Math.floor(Math.random() * Players.length);
    var a = Players.splice(b, 1)[0];
    $(".usercount-label").html(Players.length + "人");
    $(".lottery-run .user").css({
        "background-image": "url(" + a.avatar + ")"
    });
    $(".lottery-run .user .nick-name").html(a.nick_name);
	$(".lottery-run .user .mobile").html(a.mobile);
	
    window.setTimeout(function() {
		 
        getUser(function() {
			 
            winer_count--;
            if (winer_count > 0) {
                flgPlaying = true;
               
                window.setTimeout(function() {
					// playanimate();
                    getWiner();
					
                },
                600)
            } else {
                if (audio_Running) {
                    audio_Running.pause()
                }
                $(".control.button-stop").fadeIn()
            }
        })
    },
    1000)
};
var curr_index = 0;
var flgPlaying = false;
var tmr_playanimate;
var playanimate = function() {
    if (Players[curr_index]) {
        var a = Players[curr_index];
        $(".lottery-run .user").css({
            "background-image": "url(" + a.avatar + ")"
        });
        $(".lottery-run .user .nick-name").html(a.nick_name);
        curr_index++;
        if (curr_index >= Players.length) {
            curr_index = 0
        }
        if (flgPlaying) {
            tmr_playanimate = window.setTimeout(playanimate, 100)
        }
    }
};