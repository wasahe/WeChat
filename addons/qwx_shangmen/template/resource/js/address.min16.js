$(function() {
    function y(b) {
        b = window.location.search.match(new RegExp("[?&]" + b + "=([^&]+)", "i"));
        return null == b || 0 > b.length ? "": b[1]
    }
    function z() {
        0 == $("#nearby").find("li").length && navigator.geolocation.getCurrentPosition(function(b) {
            v = String(b.coords.longitude) + "," + String(b.coords.latitude);
            A(v)
        },
        function(b) {
            g("\u65e0\u6cd5\u83b7\u53d6\u5730\u7406<br>\u4f4d\u7f6e\u4fe1\u606f\u54e6\u4eb2~", "fail");
            $("#nearby").html('<li class="noresult">\u6682\u65e0\u9644\u8fd1\u5730\u5740\u5217\u8868\u4fe1\u606f</li>')
        },
        {
            maximumAge: 0,
            timeout: 1E4
        })
    }
    function B() {
        var b = $("#keyword"),
        d = $("#geoInfo"),
        a = $("#searchInfo"),
        m = a.find("ul"),
        k = $("#del"),
        f = $("#city"),
        n = $(".citySwitch"),
        h = n.find("span").eq(0),
        e = n.find("i").eq(0),
        n = n.find("select").eq(0);
        $("#stores");
        $("#nostores");
        n.on("change",
        function() {
            var l = $(this),
            b = l.find("option").not(function() {
                return ! this.selected
            }).val(),
            l = l.find("option").not(function() {
                return ! this.selected
            }).text();
            h.data("id");
            h.html();
            h.data("id", b).html(l);
            e.html(l);
            f.val(b)
        });
        b.on("input",
        function() {
            var b = $(this),
            e = b.val(),
            f = $(".citySwitch").find("span").eq(0).data("id") || 1,
            h = $(".loading");
            e ? (k.removeClass("hide"), d.addClass("hide"), a.removeClass("hide"), "yes" != b.data("loading") && "" != b.val() && (b.data("loading", "yes"), m.find("li").remove(), $.ajax({
                url: "/BaiDuMapApi/getLocationByPlace",
                type: "GET",
                dataType: "json",
                data: {
                    keyword: e,
                    city: f,
                    page: 1,
                    pageSize: 10
                },
                success: function(c) {
                    if (0 == c.status && c.data && 0 != parseInt(c.data.total) && c.data.list && 0 < c.data.list.length) {
                        c = c.data.list;
                        for (var a = 0; a < c.length; a++) c[a].location && c[a].location.lat && c[a].location.lng && c[a].name && c[a].address && $('<li data-lat="' + c[a].location.lat + '" data-lng="' + c[a].location.lng + '"><p>' + c[a].name + "</p><span>" + c[a].address + "</span></li>").insertBefore(h)
                    } else $('<li class="noresult">\u8bf7\u8f93\u5165\u5177\u4f53\u5730\u5740\uff08\u8857\u9053\u3001\u5c0f\u533a\u3001\u5e97\u540d\uff09\u8bd5\u8bd5\uff01</li>').insertBefore(h);
                    b.data("loading", "no")
                },
                error: function(c, a) {
                    $('<li class="noresult">\u8bf7\u8f93\u5165\u5177\u4f53\u5730\u5740\uff08\u8857\u9053\u3001\u5c0f\u533a\u3001\u5e97\u540d\uff09\u8bd5\u8bd5\uff01</li>').insertBefore(h);
                    b.data("loading", "no")
                }
            }))) : (k.addClass("hide"), a.addClass("hide"), d.removeClass("hide"))
        });
        k.on("click tap",
        function() {
            b.val("");
            $(this).addClass("hide");
            a.addClass("hide");
            d.removeClass("hide")
        })
    }
    function A(b) {
        var d = $("#nearby");
        $("#stores");
        $("#nostores");
        $.ajax({
            url: "/BaiDuMapApi/getPlaceList",
            type: "GET",
            dataType: "json",
            data: {
                location: b,
                isGPS: 1
            },
            success: function(a) {
                if (0 == a.status && a.data && a.data.list && 0 < a.data.list.length) {
                    var b = a.data.list,
                    k = a.data.business;
                    a = a.data.city_id;
                    for (var f = 0; f < b.length; f++) b[f].location && b[f].location.lat && b[f].location.lng && b[f].title && b[f].detail && d.append('<li data-city="' + a + '" data-lat="' + b[f].location.lat + '" data-lng="' + b[f].location.lng + '" data-business="' + k + '"><p>' + b[f].title + "</p><span>" + b[f].detail + "</span></li>")
                } else d.html('<li class="noresult">\u6682\u65e0\u9644\u8fd1\u5730\u5740\u5217\u8868\u4fe1\u606f</li>')
            },
            error: function(b, m) {
                d.html('<li class="noresult">\u6682\u65e0\u9644\u8fd1\u5730\u5740\u5217\u8868\u4fe1\u606f</li>')
            }
        })
    }
    function u() {
        return window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight || 0
    }
    function C() {
        $(".j_prePage").on("click tap",
        function() {
            // 1 >= window.history.length ? window.location.href = "http://www.365vmei.cn/": window.history.go( - 1)
        })
    }
    function D() {
        var b = document.documentElement.scrollTop || document.body.scrollTop,
        d = $("#adrPage"),
        a = $("#searchInfo"),
        m = d.height(),
        k = u();
        $("#loading");
        var f = $("#keyword").val(),
        n = $("#city").val();
        a.find("ul");
        if (!d.hasClass("hide") && !a.hasClass("hide") && f && b + k >= m - 100 && !$(".loading").data("loaded")) {
            var h = $(".loading"),
            e = h.data("page") || 2;
            "yes" != h.data("loading") && (h.data("loading", "yes").show(), $.ajax({
                url: "/BaiDuMapApi/getLocationByPlace",
                type: "GET",
                dataType: "json",
                data: {
                    keyword: f,
                    city: n,
                    page: e,
                    pageSize: 10
                },
                success: function(b) {
                    if (0 == b.status && b.data && b.data.list && 0 < b.data.list.length) {
                        for (var a = b.data.list,
                        d = 0; d < a.length; d++) a[d].location && a[d].location.lat && a[d].location.lng && a[d].name && a[d].address && $('<li data-lat="' + a[d].location.lat + '" data-lng="' + a[d].location.lng + '"><p>' + a[d].name + "</p><span>" + a[d].address + "</span></li>").insertBefore(h);
                        e++;
                        h.data("page", e);
                        e > b.data.total && h.data("loaded", 1);
                        h.data("loading", "no").hide()
                    } else g("\u52a0\u8f7d\u5931\u8d25\uff01\u8bf7\u7a0d\u540e\u518d\u8bd5~", "fail")
                },
                error: function(b, a) {
                    h.data("loading", "no").hide();
                    g("\u52a0\u8f7d\u5931\u8d25\uff01\u8bf7\u7a0d\u540e\u518d\u8bd5~", "fail")
                }
            }))
        }
    }
    function E() {
        var b = $("#j_setLocation"),
        d = $("#address"),
        a = $("#room"),
        m = $("#lat"),
        k = $("#lng"),
        f = $("#business"),
        n = $("#city"),
        h = $("#store"),
        e = $("#newPage"),
        l = $("#adrPage");
        $("#adrList").find("li");
        var g = $(".j_preStep");
        $(".cnts").children();
        $("#blank");
        var x = $("#setDefaultBtn"),
        w = $("#setDefault");
        e.css("minHeight", u() + "px");
        l.css("minHeight", u() + "px");
        g.on("click tap",
        function() {
            l.addClass("hide");
            e.removeClass("hide").addClass("animated").addClass("fadeInLeft");
            setTimeout(function() {
                e.attr("class", "")
            },
            400)
        });
        b.on("click tap",
        function() {
            e.addClass("hide");
            l.removeClass("hide").addClass("animated").addClass("fadeInRight");
            setTimeout(function() {
                l.attr("class", "")
            },
            400);
            z()
        });
        B();
        $(document).on("click tap", "#geoInfo li",
        function() {
            if (!$(this).hasClass("noresult")) {
                var c = $(this),
                g = c.find("p").html();
                c.find("span").html();
                var p = c.data("lat"),
                r = c.data("lng"),
                t = c.data("city"),
                q = c.data("business");
                $("#adrList li").removeClass("cur");
                c.addClass("cur");
                b.html(g);
                d.val(g);
                m.val(p);
                k.val(r);
                n.val(t);
                f.val(q);
                h.val(0);
                a.val("").removeAttr("readonly");
                l.addClass("hide");
                e.removeClass("hide").addClass("animated").addClass("fadeInLeft");
                setTimeout(function() {
                    e.attr("class", "")
                },
                400)
            }
        });
        $(document).on("click tap", "#searchInfo li",
        function() {
            if (!$(this).hasClass("noresult")) {
                var c = $(this),
                g = c.find("p").html(),
                p = c.find("span").html(),
                r = c.data("lat"),
                t = c.data("lng");
                $.ajax({
                    url: "/BaiDuMapApi/getPlaceList",
                    type: "GET",
                    dataType: "json",
                    data: {
                        location: t + "," + r
                    },
                    success: function(q) {
                        if (0 == q.status && q.data && q.data.business && q.data.city_id) {
                            var p = q.data.business;
                            $("#adrList li").removeClass("cur");
                            c.addClass("cur");
                            b.html(g);
                            d.val(g);
                            m.val(r);
                            k.val(t);
                            n.val(q.data.city_id);
                            f.val(p)
                        } else $("#adrList li").removeClass("cur"),
                        c.addClass("cur"),
                        b.html(g),
                        d.val(g),
                        m.val(r),
                        k.val(t);
                        a.val("").removeAttr("readonly");
                        h.val(0);
                        l.addClass("hide");
                        e.removeClass("hide").addClass("animated").addClass("fadeInLeft");
                        setTimeout(function() {
                            e.attr("class", "")
                        },
                        400)
                    },
                    error: function(f, n) {
                        $("#adrList li").removeClass("cur");
                        c.addClass("cur");
                        b.html(p + g);
                        d.val(p + g);
                        m.val(r);
                        k.val(t);
                        a.val("").removeAttr("readonly");
                        h.val("");
                        l.addClass("hide");
                        e.removeClass("hide").addClass("animated").addClass("fadeInLeft");
                        setTimeout(function() {
                            e.attr("class", "")
                        },
                        400)
                    }
                })
            }
        });
        $(document).on("click tap", "#stores li",
        function() {
            var c = $(this),
            d = c.find("p").html(),
            f = c.find("span").html();
            c.data("lat");
            c.data("lng");
            var g = c.data("id");
            $("#adrList li").removeClass("cur");
            c.addClass("cur");
            b.html(f);
            a.val(d).attr("readonly", "readonly");
            h.val(g);
            l.addClass("hide");
            e.removeClass("hide").addClass("animated").addClass("fadeInLeft");
            setTimeout(function() {
                e.attr("class", "")
            },
            400)
        });
        x.on("click tap",
        function() {
            var b = $(this);
            b.hasClass("locked") ? (b.removeClass("locked"), w.val(1)) : (b.addClass("locked"), w.val(0))
        });
        $(window).on("scroll", D)
    }
    function g(b, d) {
        var a = $("#loading");
        a.html('<span class="' + d + '"></span>' + b).removeClass("hide").addClass("animated").addClass("fadeInUp");
        setTimeout(function() {
            a.addClass("hide").html("").attr("class", "hide")
        },
        1E3)
    }
    function F() {
        var b = $("#newPage"),
        d = $("#adrPage"),
        a = $("#saveAdr"),
        m = $("#name"),
        k = $("#phone"),
        f = $("#j_setLocation"),
        n = $("#address"),
        h = $("#room"),
        e = $("#store"),
        l = $("#lat"),
        u = $("#lng"),
        x = $("#business"),
        w = $("#setDefault"),
        c = $("#address_id"),
        v = $("#city"),
        p = /^1\d{10}$/i;
        a.on("click tap",
        function() {
            if (m.val()) if (p.test(k.val())) if (f.html()) {
                var a = {};
                a.city = v.val();
                a.name = m.val();
                a.phone = k.val();
                a.
            default = w.val();
                a.room = h.val();
                0 < c.length && c.val() && (a.address_id = c.val());
                0 < e.length && e.val() && "0" != e.val() ? a.store_id = e.val() : (a.address = n.val(), a.lat = l.val(), a.lng = u.val(), a.business = x.val());
                $.ajax({
                    url: "/UserAddressApi/edit/",
                    type: "POST",
                    dataType: "json",
                    data: a,
                    success: function(a) {
                        if (0 == a.status && a.data && a.data.address_id) {
                            a = a.data.address_id;
                            var b = sessionStorage.getItem("bookPkgId") || "";
                            "pkg" == y("from") ? document.location.href = "/Package/packagePay/id/" + b + "?address_id=" + a: "my" == y("from") ? document.location.href = "/UserAddress/rank?from=my": document.location.href = "/app/index.php" + window.location.search + (window.location.search ? "&": "?") + "address_id=" + a
                        } else 1 == a.status ? g(a.info, "fail") : g("\u5730\u5740\u4fdd\u5b58\u5931\u8d25\uff01\u8bf7\u7a0d\u540e\u518d\u8bd5~", "fail")
                    },
                    error: function(a, b) {
                        g("\u5730\u5740\u4fdd\u5b58\u5931\u8d25\uff01\u8bf7\u7a0d\u540e\u518d\u8bd5~", "fail")
                    }
                })
            } else g("\u8bf7\u60a8\u8bbe\u7f6e\u670d\u52a1\u5730\u5740\uff01", "fail"),
            z(),
            setTimeout(function() {
                b.addClass("hide");
                d.removeClass("hide").addClass("animated").addClass("fadeInRight");
                setTimeout(function() {
                    d.attr("class", "")
                },
                400)
            },
            500);
            else g("\u8bf7\u60a8\u6b63\u786e\u586b\u5199\u624b\u673a\u53f7\u7801\uff01", "fail"),
            k.focus();
            else g("\u8bf7\u60a8\u586b\u5199\u8054\u7cfb\u4eba\u59d3\u540d\uff01", "fail"),
            m.focus()
        })
    }
    function G() {
        $("#delAdr").on("click tap",
        function() {
            $(this);
            var b = $('input[name="address_id"]').val();
            confirm("\u786e\u5b9a\u8981\u5220\u9664\u8be5\u5730\u5740\u4e48\uff1f") && $.ajax({
                url: "/UserAddressApi/del/",
                type: "POST",
                dataType: "json",
                data: {
                    address_id: b
                },
                success: function(b) {
                    0 == b.status ? document.location.href = "/UserAddress/rank?from=my": g("\u5220\u9664\u5730\u5740\u5931\u8d25\uff01\u8bf7\u7a0d\u540e\u518d\u8bd5~", "fail")
                },
                error: function(b, a) {
                    g("\u5220\u9664\u5730\u5740\u5931\u8d25\uff01\u8bf7\u7a0d\u540e\u518d\u8bd5~", "fail")
                }
            })
        })
    }
    var v = "";
    setTimeout(function() {
        C();
        E();
        F();
        G()
    },
    300)
});