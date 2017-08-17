function getWinHeight() {
    return window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight || 0
}
function getWinScrollHeight() {
    return document.documentElement.scrollTop || document.body.scrollTop
}
function QueryStringByName(a) {
    a = window.location.search.match(new RegExp("[?&]" + a + "=([^&]+)", "i"));
    return null == a || 0 > a.length ? "": a[1]
}
var bookBtn = $("#bookBtn"),
currentid = $(".item").eq(0).find("span").eq(0).data("id"),
itemNum = 1,
itemArray = {},
fromTime = QueryStringByName("time"),
pastTime = sessionStorage.getItem("trolleyTime_" + currentid) || "";
sessionStorage.removeItem("userPackageId");
fromTime && pastTime && fromTime == pastTime ? trolleyInit() : (bookBtn.data("item", currentid + "_1"), bookBtn.data("items", ""), bookBtn.data("type", 0), sessionStorage.setItem("trolleyCur_" + currentid, currentid + "_1"), sessionStorage.setItem("trolleyOther_" + currentid, ""), sessionStorage.setItem("trolleyTime_" + currentid, fromTime));
function trolleyInit() {
    var a = sessionStorage.getItem("trolleyCur_" + currentid) || "",
    c = sessionStorage.getItem("trolleyOther_" + currentid) || ""; (new Date).getTime();
    bookBtn.data("item", "");
    bookBtn.data("items", "");
    bookBtn.data("type", 0);
    var b = 0,
    e = 0,
    l = 0,
    n = 0,
    h = $(".items");
    h.html("");
    if (a) {
        if (bookBtn.data("item", a), itemNum = parseInt(a.split("_")[1]), a = a.split("_")[0], 0 < itemNum) {
            var f = $('span[data-id="' + a + '"]'),
            g = f.data("duration"),
            d = f.data("price"),
            k = parseInt(f.data("discount")) || 0,
            t = f.parent().prev().find("h3").html(),
            q = $("#sumNum"),
            x = $("#sumMoney");
            f.html(itemNum);
            f.parent().removeClass("fold");
            h.append($("<li><p>" + t + "</p><p><i></i>" + g + "\u5206\u949f</p><p>\uffe5" + d + '</p><p><span class="edit"><a class="add" href="javascript:void(0);">+</a><span data-price="' + d + '" data-duration="' + g + '" data-discount="' + k + '" data-id="' + a + '">' + itemNum + '</span><a class="minus" href="javascript:void(0);"></a></span></p></li>'));
            b += itemNum;
            e += g * itemNum;
            n += d + (d + k) * (itemNum - 1);
            q.html(b + "\u4e2a\u9879\u76ee<br>" + e + "\u5206\u949f").data("num", b).data("duration", e);
            x.html(n);
            bookBtn.data("type", 0)
        }
    } else $('span[data-id="' + currentid + '"]').html(0),
    $('span[data-id="' + currentid + '"]').parent().addClass("fold"),
    bookBtn.data("item", "");
    if (c) {
        bookBtn.data("items", c);
        var c = c.split(","),
        m = !1,
        q = $("#sumNum"),
        x = $("#sumMoney");
        itemArray = {};
        for (var v = 0; v < c.length; v++) {
            var a = c[v].split("_")[0],
            r = parseInt(c[v].split("_")[1]),
            f = $('span[data-id="' + a + '"]'),
            g = f.data("duration"),
            d = f.data("price"),
            k = parseInt(f.data("discount")) || 0,
            p = parseInt(f.data("times")) || 0,
            t = f.parent().prev().find("h3").html();
            f.html(r);
            itemArray[a] = r;
            f.parent().removeClass("fold");
            0 < p ? (m = !0, f.prev().addClass("odd"), l += p, b++, n += d, h.append($("<li><p>" + t + "</p><p><i></i>" + p + "\u6b21</p><p>\uffe5" + d + '</p><p><span class="edit"><a class="add odd" href="javascript:void(0);">+</a><span data-price="' + d + '" data-discount="' + k + '" data-times="' + p + '" data-id="' + a + '">1</span><a class="minus" href="javascript:void(0);"></a></span></p></li>'))) : (n += d + (d + k) * (r - 1), b += r, e += g * r, h.append($("<li><p>" + t + "</p><p><i></i>" + g + "\u5206\u949f</p><p>\uffe5" + d + '</p><p><span class="edit"><a class="add" href="javascript:void(0);">+</a><span data-price="' + d + '" data-duration="' + g + '" data-discount="' + k + '" data-id="' + a + '">' + r + '</span><a class="minus" href="javascript:void(0);"></a></span></p></li>')))
        }
        m ? (q.html(b + "\u4e2a\u5957\u9910<br>" + l + "\u6b21").data("num", b).data("times", l), bookBtn.data("type", 1)) : (q.html(b + "\u4e2a\u9879\u76ee<br>" + e + "\u5206\u949f").data("num", b).data("duration", e), bookBtn.data("type", 0));
        x.html(n)
    } else bookBtn.data("items", "")
}
function toStr(a) {
    var c = [],
    b;
    for (b in a) 0 < parseInt(a[b]) && c.push(b + "_" + a[b]);
    return c.join(",")
}
function calNum() {
    var a = $("#bookBtn"),
    c = 0;
    a.data("item") && (c += parseInt(a.data("item").split("_")[1]));
    if (a.data("items")) for (var a = a.data("items").split(","), b = a.length, e = 0; e < b; e++) c += parseInt(a[e].split("_")[1]);
    return c
}

function numInit() {
    $(".j_single .add").on("click tap",
    function() {
        // alert('hello');return false;
        



        var a = $(this),
        c = a.parent(),
        b = a.next(),
        e = parseInt(b.html()),
        l = b.data("duration"),
        n = parseFloat(b.data("price")),
        h = b.data("id"),
        f = parseInt(b.data("discount")) || 0,
        g = c.prev().find("h3").html(),
        d = $("#sumNum"),
        k = parseInt(d.data("num")),
        kk = e+1,
        t = parseInt(d.data("duration")),
        q = $("#sumMoney"),
        x = parseInt(q.html()),
        m = $(".j_multi").find(".add"),
        v = $(".j_multi").find(".fold").length == m.length ? !1 : !0,
        r = $(".items"),
        p = $("#loading"),
        u = $("#bookBtn");
        //修改为直接去ajax计算：
        //alert(2); alert(h+'=>'+n+'=>'+kk);return false;
        update_cart(h,n,kk);
        b.html(kk);
        return false;

        if ("yes" != a.data("loading")) {
            a.data("loading", "yes");
            u.data("type", 0);
            if (v) {
                m.each(function() {
                    var a = $(this);
                    a.removeClass("odd");
                    a.parent().addClass("fold");
                    a.next().html(0)
                });
                if (h != currentid) {
                    var m = $('span[data-id="' + currentid + '"]'),
                    v = m.data("duration"),
                    w = m.data("price"),
                    y = parseInt(m.data("discount")) || 0,
                    z = m.parent().prev().find("h3").html();
                    r.html("");
                    m.html(1);
                    m.parent().removeClass("fold");
                    r.append($("<li><p>" + z + "</p><p><i></i>" + v + "\u5206\u949f</p><p>\uffe5" + w + '</p><p><span class="edit"><a class="add" href="javascript:void(0);">+</a><span data-price="' + w + '" data-duration="' + v + '" data-discount="' + y + '" data-id="' + currentid + '">1</span><a class="minus" href="javascript:void(0);"></a></span></p></li>'));
                    itemNum = 1;
                    itemArray = {};
                    u.data("item", currentid + "_1");
                    u.data("items", "");
                    sessionStorage.setItem("trolleyCur_" + currentid, currentid + "_1");
                    sessionStorage.setItem("trolleyOther_" + currentid, "");
                    d.html("1\u4e2a\u9879\u76ee<br>" + v + "\u5206\u949f");
                    d.data("num", 1).data("duration", v).data("times", 0);
                    q.html(w)
                } else r.html(""),
                u.data("item", ""),
                u.data("items", ""),
                sessionStorage.setItem("trolleyCur_" + currentid, ""),
                sessionStorage.setItem("trolleyOther_" + currentid, ""),
                d.html("0\u4e2a\u9879\u76ee<br>0\u5206\u949f"),
                d.data("num", 0).data("duration", 0).data("times", 0),
                q.html(0);
                u.data("type", 0)
            }
            if (360 < t + l) p.html('<span class="fail"></span>\u60a8\u9884\u7ea6\u7684\u9879\u76ee\u603b\u65f6\u957f\u5df2\u8d85\u8fc76\u5c0f\u65f6\uff0c\u4e0d\u80fd\u518d\u7ea6\u5566\uff01\u8ba9\u81ea\u5df1\u4f11\u606f\u4e00\u4f1a\u513f\u5427~').removeClass("hide").addClass("animated").addClass("fadeInUp"),
            setTimeout(function() {
                p.addClass("hide").html("").attr("class", "hide");
                a.data("loading", "no")
            },
            2E3);
            else {
                0 == e ? (c.removeClass("fold"), r.append($("<li><p>" + g + "</p><p><i></i>" + l + "\u5206\u949f</p><p>\uffe5" + n + '</p><p><span class="edit"><a class="add" href="javascript:void(0);">+</a><span data-price="' + n + '" data-duration="' + l + '" data-discount="' + f + '" data-id="' + h + '">1</span><a class="minus" href="javascript:void(0);"></a></span></p></li>')), currentid == h ? (itemNum = 1, u.data("item", currentid + "_1"), sessionStorage.setItem("trolleyCur_" + currentid, currentid + "_1")) : (itemArray[h] = 1, u.data("items", toStr(itemArray)), sessionStorage.setItem("trolleyOther_" + currentid, toStr(itemArray)))) : (r.find('span[data-id="' + h + '"]').html(e + 1), currentid == h ? (itemNum++, u.data("item", currentid + "_" + itemNum), sessionStorage.setItem("trolleyCur_" + currentid, currentid + "_" + itemNum)) : (itemArray[h] = parseInt(itemArray[h]) + 1, u.data("items", toStr(itemArray)), sessionStorage.setItem("trolleyOther_" + currentid, toStr(itemArray))), n += f);
                var C = a.offset().left,
                A = getWinHeight() - a.offset().top + getWinScrollHeight(),
                B = $('<i class="ball"></i>');
                B.css("left", C + 2 + "px").css("bottom", (22 < A ? A - 22 : 0) + "px");
                $("aside").append(B);
                setTimeout(function() {
                    B.css("-webkit-transform", "translate3d(" + (30 - C) + "px, " + (42 < A ? A - 42 : 0) + "px, 0)")
                },
                100);
                b.html(e + 1);
                setTimeout(function() {
                    t = parseInt(d.data("duration"));
                    x = parseInt(q.html());
                    d.html(calNum() + "\u4e2a\u9879\u76ee<br>" + (t + l) + "\u5206\u949f");
                    d.data("num", k + 1).data("duration", t + l);
                    q.html(x + n);
                    B.remove();
                    a.data("loading", "no")
                },
                600)
            }
        }
    });
    $(".j_multi .add").on("click tap",
    function() {
        // alert('add');
        var a = $(this),
        c = a.parent(),
        b = a.next(),
        e = parseInt(b.html()),
        l = b.data("times"),
        n = b.data("price"),
        h = parseInt(b.data("discount")) || 0,
        f = b.data("id"),
        g = c.prev().find("h3").html(),
        d = $("#sumNum"),
        k = parseInt(d.data("num")),
        t = parseInt(d.data("times")),
        q = $("#sumMoney"),
        x = parseInt(q.html()),
        m = $(".j_single").find(".add"),
        v = $(".j_single").find(".fold").length == m.length ? !1 : !0,
        r = $(".items"),
        p = $("#bookBtn");
        if ("yes" != a.data("loading") && (a.data("loading", "yes"), !a.hasClass("odd"))) {
            a.addClass("odd");
            p.data("type", 1);
            v && (m.each(function() {
                var a = $(this);
                a.parent().addClass("fold");
                a.next().html(0)
            }), d.html("0\u4e2a\u5957\u9910<br>0\u6b21"), d.data("num", 0).data("duration", 0), q.html(0), x = t = k = 0, r.html(""), itemArray = {},
            p.data("item", ""), p.data("items", ""), sessionStorage.setItem("trolleyCur_" + currentid, ""), sessionStorage.setItem("trolleyOther_" + currentid, ""));
            0 == e ? (c.removeClass("fold"), r.append($("<li><p>" + g + "</p><p><i></i>" + l + "\u6b21</p><p>\uffe5" + n + '</p><p><span class="edit"><a class="add odd" href="javascript:void(0);">+</a><span data-price="' + n + '" data-discount="' + h + '" data-times="' + l + '" data-id="' + f + '">1</span><a class="minus" href="javascript:void(0);"></a></span></p></li>')), itemArray[f] = 1, p.data("items", toStr(itemArray)), sessionStorage.setItem("trolleyOther_" + currentid, toStr(itemArray))) : (r.find('span[data-id="' + f + '"]').html(e + 1), itemArray[f] = parseInt(itemArray[f]) + 1, p.data("items", toStr(itemArray)), sessionStorage.setItem("trolleyOther_" + currentid, toStr(itemArray)), n += h);
            var u = a.offset().left,
            w = getWinHeight() - a.offset().top + getWinScrollHeight(),
            y = $('<i class="ball"></i>');
            y.css("left", u + 2 + "px").css("bottom", (22 < w ? w - 22 : 0) + "px");
            $("aside").append(y);
            setTimeout(function() {
                y.css("-webkit-transform", "translate3d(" + (30 - u) + "px, " + (42 < w ? w - 42 : 0) + "px, 0)")
            },
            100);
            b.html(e + 1);
            setTimeout(function() {
                d.html(calNum() + "\u4e2a\u5957\u9910<br>" + (t + l) + "\u6b21");
                d.data("num", k + 1).data("times", t + l);
                q.html(x + n);
                y.remove();
                a.data("loading", "no")
            },
            600)
        }
    });
    $(document).on("click tap", ".minus",
    function() {
        // alert('hello');return false;
        var a = $(this),
        c = a.parent(),
        b = a.prev(),
        e = parseInt(b.html()),
        kk = e-1,
        l = b.data("duration") || 0,
        n = b.data("times") || 0,
        h = parseFloat(b.data("price")),
        f = parseInt(b.data("discount")) || 0,
        g = $(".chosen").eq(0).find("span").data("id"),
        d = b.data("id"),
        k = $("#sumNum"),
        t = parseInt(k.data("num")),
        q = parseInt(k.data("duration") || 0),
        x = parseInt(k.data("times") || 0),
        m = $("#sumMoney"),
        v = parseInt(m.html()),
        r = $(".items"),
        p = $(".j_multi").find(".add"),
        u = $(".j_multi").find(".fold").length == p.length ? !1 : !0,
        p = $("#bookBtn"),
        w = $("#loading");

        //修改为直接去ajax计算：
		//alert(1);alert(d+'=>'+h+'=>'+kk);return false;
        update_cart(d,h,kk);
        b.html(kk);
        if (kk<1){
            //remove this item;
            $(this).parent().parent().remove();
        }
        return false;



        if ("yes" != a.data("loading")) if (a.data("loading", "yes"), a.prev().prev().hasClass("odd") && a.prev().prev().removeClass("odd"), g == d && 1 == e) w.html('<span class="fail"></span>\u5df2\u9009\u9879\u76ee\u65e0\u6cd5\u6e05\u7a7a\uff01\u6216\u8005\u60a8\u53ef\u4ee5\u9009\u62e9\u4e0b\u65b9\u5305\u542b\u6b64\u9879\u76ee\u7684\u5957\u9910~').removeClass("hide").addClass("animated").addClass("fadeInUp"),
        setTimeout(function() {
            w.addClass("hide").html("").attr("class", "hide");
            a.data("loading", "no")
        },
        2E3);
        else {
            if (a.parent().hasClass("edit")) {
                var y = $(".choose").find('span[data-id="' + d + '"]'),
                z = y.parent();
                y.html(e - 1);
                y.prev().removeClass("odd");
                b.html(e - 1);
                1 == e ? (z.addClass("fold"), c.parent().parent().remove()) : h += f
            } else y = $(".bookArea").find('span[data-id="' + d + '"]'),
            z = y.parent(),
            y.html(e - 1),
            y.prev().removeClass("odd"),
            b.html(e - 1),
            1 == e ? (c.addClass("fold"), z.parent().parent().remove()) : h += f;
            g == d ? (itemNum--, p.data("item", g + "_" + itemNum), sessionStorage.setItem("trolleyCur_" + g, g + "_" + itemNum)) : (1 < parseInt(itemArray[d]) ? itemArray[d] = parseInt(itemArray[d]) - 1 : itemArray[d] = void 0, p.data("items", toStr(itemArray)), sessionStorage.setItem("trolleyOther_" + g, toStr(itemArray)));
            u ? 0 == calNum() ? (b = $('span[data-id="' + g + '"]'), c = b.parent(), l = b.data("duration"), h = b.data("price"), f = parseInt(b.data("discount")) || 0, e = c.prev().find("h3").html(), k = $("#sumNum"), t = parseInt(k.data("num")), q = parseInt(k.data("duration")), m = $("#sumMoney"), b.html(1), c.removeClass("fold"), r.append($("<li><p>" + e + "</p><p><i></i>" + l + "\u5206\u949f</p><p>\uffe5" + h + '</p><p><span class="edit"><a class="add" href="javascript:void(0);">+</a><span data-price="' + h + '" data-duration="' + l + '" data-discount="' + f + '" data-id="' + g + '">1</span><a class="minus" href="javascript:void(0);"></a></span></p></li>')), itemNum = 1, p.data("item", g + "_1"), sessionStorage.setItem("trolleyCur_" + g, g + "_1"), k.html("1\u4e2a\u9879\u76ee<br>" + l + "\u5206\u949f"), k.data("num", 1).data("duration", l).data("times", 0), m.html(h), p.data("type", 0)) : (k.html(calNum() + "\u4e2a\u5957\u9910<br>" + (x - n) + "\u6b21"), k.data("num", t - 1).data("times", x - n), m.html(v - h)) : (k.html(calNum() + "\u4e2a\u9879\u76ee<br>" + (q - l) + "\u5206\u949f"), k.data("num", t - 1).data("duration", q - l), m.html(v - h));
            a.data("loading", "no")
        }
    });
    $(document).on("click tap", ".items .add",
    function() {
        var a = $(this);
        a.parent();
        var c = a.next(),
        b = parseInt(c.html()),
        e = c.data("duration") || 0,
        l = c.data("times") || 0,
        n = parseInt(c.data("price")),
        h = parseInt(c.data("discount")) || 0,
        f = c.data("id"),
        g = $("#sumNum"),
        d = parseInt(g.data("num")),
        k = parseInt(g.data("duration") || 0),
        t = parseInt(g.data("times") || 0),
        q = $("#sumMoney"),
        x = parseInt(q.html()),
        m = $(".j_single").find(".add"),
        v = $(".j_single").find(".fold").length == m.length ? !1 : !0,
        r = $("#loading"),
        m = $("#bookBtn");

        // alert(n);return false;
        if ("yes" != a.data("loading") && (a.data("loading", "yes"), !a.hasClass("odd"))) if (360 < k + e && v) r.html('<span class="fail"></span>\u60a8\u9884\u7ea6\u7684\u9879\u76ee\u603b\u65f6\u957f\u5df2\u8d85\u8fc76\u5c0f\u65f6\uff0c\u4e0d\u80fd\u518d\u7ea6\u5566\uff01\u8ba9\u81ea\u5df1\u4f11\u606f\u4e00\u4f1a\u513f\u5427~').removeClass("hide").addClass("animated").addClass("fadeInUp"),
        setTimeout(function() {
            r.addClass("hide").html("").attr("class", "hide");
            a.data("loading", "no")
        },
        2E3);
        else {
            $(".choose").find('span[data-id="' + f + '"]').html(b + 1);
            var p = a.offset().left,
            u = getWinHeight() - a.offset().top + getWinScrollHeight(),
            w = $('<i class="ball"></i>');
            w.css("left", p + 2 + "px").css("bottom", (22 < u ? u - 22 : 0) + "px");
            $("aside").append(w);
            setTimeout(function() {
                w.css("-webkit-transform", "translate3d(" + (30 - p) + "px, " + (42 < u ? u - 42 : 0) + "px, 0)")
            },
            100);
            currentid == f ? (itemNum++, m.data("item", currentid + "_" + itemNum), sessionStorage.setItem("trolleyCur_" + currentid, currentid + "_" + itemNum)) : (itemArray[f] = parseInt(itemArray[f]) + 1, m.data("items", toStr(itemArray)), sessionStorage.setItem("trolleyOther_" + currentid, toStr(itemArray)));
            c.html(b + 1);
            setTimeout(function() {
                v ? (g.html(calNum() + "\u4e2a\u9879\u76ee<br>" + (k + e) + "\u5206\u949f"), g.data("num", d + 1).data("duration", k + e)) : (g.html(calNum() + "\u4e2a\u5957\u9910<br>" + (t + l) + "\u6b21"), g.data("num", d + 1).data("times", t + l));
                q.html(x + n + h);
                w.remove();
                a.data("loading", "no")
            },
            600)
        }
    })
}
function moreInit() {
    $(document).on("click tap", ".more",
    function() {
        for (var a = $(this), c = a.parent().find(".hide"), b = 0; b < Math.min(c.length, 3); b++) {
            c.eq(b).removeClass("hide");
            var e = c.eq(b).find("img");
            e.data("src") && e.attr("src", e.data("src"))
        }
        3 >= c.length && a.addClass("hide")
    });
    $("#orderNum").on("click tap",
    function() {
        var a = $(this),
        c = a.parent().prev(),
        b = $("#mb");
        a.hasClass("unfold") ? (b.addClass("hide"), a.removeClass("unfold"), c.addClass("animated").addClass("slideOutDown"), setTimeout(function() {
            c.addClass("hide").removeClass("slideOutDown").removeClass("animated")
        },
        300)) : (b.removeClass("hide"), a.addClass("unfold"), c.removeClass("hide").addClass("animated").addClass("slideInUp"), setTimeout(function() {
            c.removeClass("slideInUp").removeClass("animated")
        },
        300))
    });
    $("#mb").on("click tap",
    function() {
        var a = $("#orderNum"),
        c = a.parent().prev(),
        b = $(this);
        a.hasClass("unfold") ? (b.addClass("hide"), a.removeClass("unfold"), c.addClass("animated").addClass("slideOutDown"), setTimeout(function() {
            c.addClass("hide").removeClass("slideOutDown").removeClass("animated")
        },
        300)) : (b.removeClass("hide"), a.addClass("unfold"), c.removeClass("hide").addClass("animated").addClass("slideInUp"), setTimeout(function() {
            c.removeClass("slideInUp").removeClass("animated")
        },
        300))
    })
}
function payInit() {
    $(".pay li").on("click tap",
    function() {
        $(this).siblings().removeClass("active");
        $(this).addClass("active")
    })
}
function preInit() {
    $(".j_prePage").on("click tap",
    function() {
        1 >= window.history.length ? window.location.href = window.location.href: window.history.go( - 1)
    })
}
setTimeout(function() {
    preInit();
    numInit();
    moreInit();
    payInit()
},
300);