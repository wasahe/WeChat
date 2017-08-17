$(function() {
	function a() {
		WeixinJSBridge.call("hideOptionMenu")
	}
	if (typeof WeixinJSBridge == "undefined") {
		if (document.addEventListener) {
			document.addEventListener("WeixinJSBridgeReady", a, false)
		} else {
			if (document.attachEvent) {
				document.attachEvent("WeixinJSBridgeReady", a);
				document.attachEvent("onWeixinJSBridgeReady", a)
			}
		}
	} else {
		a()
	}
	$("#user_login").click(function(d) {
		var e = $("#user_name").val(),
			c = $("#user_pwd").val();
		if (e != "" && c != "") {
			$.ajax({
				type: "post",
				url: window.moduleurl + "login",
				data: {
					username: e,
					password: c
				},
				beforeSend: function() {
					$.showOpenBox.show()
				},
				success: function(f) {
					f = $.parseJSON(f);
					if (f.status == true) {
						b("登录成功");
						window.location.href = window.moduleurl + "manage#index"
					} else {
						b("帐号密码错误")
					}
				},
				complete: function() {
					$.showOpenBox.close()
				}
			})
		} else {
			if (e == "") {
				b("帐号不能为空")
			} else {
				if (c == "") {
					b("密码不能为空")
				}
			}
		}
	});

	function b(d) {
		$(".login-status").html(d).show();
		var c = $(".login-status").width();
		$(".login-status").css("margin-left", -c / 2);
		setTimeout(function() {
			$(".login-status").hide()
		}, 800)
	}
});