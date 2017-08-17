!function(a, b, c) {
    function d(a, c) {
        this.wrapper = "string" == typeof a ? b.querySelector(a) : a,
        this.scroller = this.wrapper.children[0],
        this.scrollerStyle = this.scroller.style,
        this.options = {
            startX: 0,
            startY: 0,
            scrollY: !0,
            directionLockThreshold: 5,
            momentum: !0,
            bounce: !0,
            bounceTime: 600,
            bounceEasing: "",
            preventDefault: !0,
            preventDefaultException: {
                tagName: /^(INPUT|TEXTAREA|BUTTON|SELECT)$/
            },
            HWCompositing: !0,
            useTransition: !0,
            useTransform: !0
        };
        for (var d in c)
            this.options[d] = c[d];
        this.translateZ = this.options.HWCompositing && f.hasPerspective ? " translateZ(0)" : "",
        this.options.useTransition = f.hasTransition && this.options.useTransition,
        this.options.useTransform = f.hasTransform && this.options.useTransform,
        this.options.eventPassthrough = this.options.eventPassthrough === !0 ? "vertical" : this.options.eventPassthrough,
        this.options.preventDefault = !this.options.eventPassthrough && this.options.preventDefault,
        this.options.scrollY = "vertical" == this.options.eventPassthrough ? !1 : this.options.scrollY,
        this.options.scrollX = "horizontal" == this.options.eventPassthrough ? !1 : this.options.scrollX,
        this.options.freeScroll = this.options.freeScroll && !this.options.eventPassthrough,
        this.options.directionLockThreshold = this.options.eventPassthrough ? 0 : this.options.directionLockThreshold,
        this.options.bounceEasing = "string" == typeof this.options.bounceEasing ? f.ease[this.options.bounceEasing] || f.ease.circular : this.options.bounceEasing,
        this.options.resizePolling = void 0 === this.options.resizePolling ? 60 : this.options.resizePolling,
        this.options.tap === !0 && (this.options.tap = "tap"),
        this.x = 0,
        this.y = 0,
        this.directionX = 0,
        this.directionY = 0,
        this._events = {},
        this._init(),
        this.refresh(),
        this.scrollTo(this.options.startX, this.options.startY),
        this.enable()
    }
    var e = a.requestAnimationFrame || a.webkitRequestAnimationFrame || a.mozRequestAnimationFrame || a.oRequestAnimationFrame || a.msRequestAnimationFrame || function(b) {
        a.setTimeout(b, 1e3 / 60)
    }
      , f = function() {
        function d(a) {
            return g === !1 ? !1 : "" === g ? a : g + a.charAt(0).toUpperCase() + a.substr(1)
        }
        var e = {}
          , f = b.createElement("div").style
          , g = function() {
            for (var a, b = ["t", "webkitT", "MozT", "msT", "OT"], c = 0, d = b.length; d > c; c++)
                if (a = b[c] + "ransform",
                a in f)
                    return b[c].substr(0, b[c].length - 1);
            return !1
        }();
        e.getTime = Date.now || function() {
            return (new Date).getTime()
        }
        ,
        e.extend = function(a, b) {
            for (var c in b)
                a[c] = b[c]
        }
        ,
        e.addEvent = function(a, b, c, d) {
            a.addEventListener(b, c, !!d)
        }
        ,
        e.removeEvent = function(a, b, c, d) {
            a.removeEventListener(b, c, !!d)
        }
        ,
        e.prefixPointerEvent = function(b) {
            return a.MSPointerEvent ? "MSPointer" + b.charAt(9).toUpperCase() + b.substr(10) : b
        }
        ,
        e.momentum = function(a, b, d, e, f, g) {
            var h, i, j = a - b, k = c.abs(j) / d;
            return g = void 0 === g ? 6e-4 : g,
            h = a + k * k / (2 * g) * (0 > j ? -1 : 1),
            i = k / g,
            e > h ? (h = f ? e - f / 2.5 * (k / 8) : e,
            j = c.abs(h - a),
            i = j / k) : h > 0 && (h = f ? f / 2.5 * (k / 8) : 0,
            j = c.abs(a) + h,
            i = j / k),
            {
                destination: c.round(h),
                duration: i
            }
        }
        ;
        var h = d("transform");
        return e.extend(e, {
            hasTransform: h !== !1,
            hasPerspective: d("perspective") in f,
            hasTouch: "ontouchstart" in a,
            hasPointer: a.PointerEvent || a.MSPointerEvent,
            hasTransition: d("transition") in f
        }),
        e.isBadAndroid = /Android /.test(a.navigator.appVersion) && !/Chrome\/\d/.test(a.navigator.appVersion),
        e.extend(e.style = {}, {
            transform: h,
            transitionTimingFunction: d("transitionTimingFunction"),
            transitionDuration: d("transitionDuration"),
            transitionDelay: d("transitionDelay"),
            transformOrigin: d("transformOrigin")
        }),
        e.hasClass = function(a, b) {
            var c = new RegExp("(^|\\s)" + b + "(\\s|$)");
            return c.test(a.className)
        }
        ,
        e.addClass = function(a, b) {
            if (!e.hasClass(a, b)) {
                var c = a.className.split(" ");
                c.push(b),
                a.className = c.join(" ")
            }
        }
        ,
        e.removeClass = function(a, b) {
            if (e.hasClass(a, b)) {
                var c = new RegExp("(^|\\s)" + b + "(\\s|$)","g");
                a.className = a.className.replace(c, " ")
            }
        }
        ,
        e.offset = function(a) {
            for (var b = -a.offsetLeft, c = -a.offsetTop; a = a.offsetParent; )
                b -= a.offsetLeft,
                c -= a.offsetTop;
            return {
                left: b,
                top: c
            }
        }
        ,
        e.preventDefaultException = function(a, b) {
            for (var c in b)
                if (b[c].test(a[c]))
                    return !0;
            return !1
        }
        ,
        e.extend(e.eventType = {}, {
            touchstart: 1,
            touchmove: 1,
            touchend: 1,
            mousedown: 2,
            mousemove: 2,
            mouseup: 2,
            pointerdown: 3,
            pointermove: 3,
            pointerup: 3,
            MSPointerDown: 3,
            MSPointerMove: 3,
            MSPointerUp: 3
        }),
        e.extend(e.ease = {}, {
            quadratic: {
                style: "cubic-bezier(0.25, 0.46, 0.45, 0.94)",
                fn: function(a) {
                    return a * (2 - a)
                }
            },
            circular: {
                style: "cubic-bezier(0.1, 0.57, 0.1, 1)",
                fn: function(a) {
                    return c.sqrt(1 - --a * a)
                }
            },
            back: {
                style: "cubic-bezier(0.175, 0.885, 0.32, 1.275)",
                fn: function(a) {
                    var b = 4;
                    return (a -= 1) * a * ((b + 1) * a + b) + 1
                }
            },
            bounce: {
                style: "",
                fn: function(a) {
                    return (a /= 1) < 1 / 2.75 ? 7.5625 * a * a : 2 / 2.75 > a ? 7.5625 * (a -= 1.5 / 2.75) * a + .75 : 2.5 / 2.75 > a ? 7.5625 * (a -= 2.25 / 2.75) * a + .9375 : 7.5625 * (a -= 2.625 / 2.75) * a + .984375
                }
            },
            elastic: {
                style: "",
                fn: function(a) {
                    var b = .22
                      , d = .4;
                    return 0 === a ? 0 : 1 == a ? 1 : d * c.pow(2, -10 * a) * c.sin((a - b / 4) * (2 * c.PI) / b) + 1
                }
            }
        }),
        e.tap = function(a, c) {
            var d = b.createEvent("Event");
            d.initEvent(c, !0, !0),
            d.pageX = a.pageX,
            d.pageY = a.pageY,
            a.target.dispatchEvent(d)
        }
        ,
        e.click = function(a) {
            var c, d = a.target;
            /(SELECT|INPUT|TEXTAREA)/i.test(d.tagName) || (c = b.createEvent("MouseEvents"),
            c.initMouseEvent("click", !0, !0, a.view, 1, d.screenX, d.screenY, d.clientX, d.clientY, a.ctrlKey, a.altKey, a.shiftKey, a.metaKey, 0, null ),
            c._constructed = !0,
            d.dispatchEvent(c))
        }
        ,
        e
    }();
    d.prototype = {
        version: "5.1.2",
        _init: function() {
            this._initEvents()
        },
        destroy: function() {
            this._initEvents(!0),
            this._execEvent("destroy")
        },
        _transitionEnd: function(a) {
            a.target == this.scroller && this.isInTransition && (this._transitionTime(),
            this.resetPosition(this.options.bounceTime) || (this.isInTransition = !1,
            this._execEvent("scrollEnd")))
        },
        _start: function(a) {
            if ((1 == f.eventType[a.type] || 0 === a.button) && this.enabled && (!this.initiated || f.eventType[a.type] === this.initiated)) {
                !this.options.preventDefault || f.isBadAndroid || f.preventDefaultException(a.target, this.options.preventDefaultException) || a.preventDefault();
                var b, d = a.touches ? a.touches[0] : a;
                this.initiated = f.eventType[a.type],
                this.moved = !1,
                this.distX = 0,
                this.distY = 0,
                this.directionX = 0,
                this.directionY = 0,
                this.directionLocked = 0,
                this._transitionTime(),
                this.startTime = f.getTime(),
                this.options.useTransition && this.isInTransition ? (this.isInTransition = !1,
                b = this.getComputedPosition(),
                this._translate(c.round(b.x), c.round(b.y)),
                this._execEvent("scrollEnd")) : !this.options.useTransition && this.isAnimating && (this.isAnimating = !1,
                this._execEvent("scrollEnd")),
                this.startX = this.x,
                this.startY = this.y,
                this.absStartX = this.x,
                this.absStartY = this.y,
                this.pointX = d.pageX,
                this.pointY = d.pageY,
                this._execEvent("beforeScrollStart")
            }
        },
        _move: function(a) {
            if (this.enabled && f.eventType[a.type] === this.initiated) {
                this.options.preventDefault && a.preventDefault();
                var b, d, e, g, h = a.touches ? a.touches[0] : a, i = h.pageX - this.pointX, j = h.pageY - this.pointY, k = f.getTime();
                if (this.pointX = h.pageX,
                this.pointY = h.pageY,
                this.distX += i,
                this.distY += j,
                e = c.abs(this.distX),
                g = c.abs(this.distY),
                !(k - this.endTime > 300 && 10 > e && 10 > g)) {
                    if (this.directionLocked || this.options.freeScroll || (e > g + this.options.directionLockThreshold ? this.directionLocked = "h" : g >= e + this.options.directionLockThreshold ? this.directionLocked = "v" : this.directionLocked = "n"),
                    "h" == this.directionLocked) {
                        if ("vertical" == this.options.eventPassthrough)
                            a.preventDefault();
                        else if ("horizontal" == this.options.eventPassthrough)
                            return void (this.initiated = !1);
                        j = 0
                    } else if ("v" == this.directionLocked) {
                        if ("horizontal" == this.options.eventPassthrough)
                            a.preventDefault();
                        else if ("vertical" == this.options.eventPassthrough)
                            return void (this.initiated = !1);
                        i = 0
                    }
                    i = this.hasHorizontalScroll ? i : 0,
                    j = this.hasVerticalScroll ? j : 0,
                    b = this.x + i,
                    d = this.y + j,
                    (b > 0 || b < this.maxScrollX) && (b = this.options.bounce ? this.x + i / 3 : b > 0 ? 0 : this.maxScrollX),
                    (d > 0 || d < this.maxScrollY) && (d = this.options.bounce ? this.y + j / 3 : d > 0 ? 0 : this.maxScrollY),
                    this.directionX = i > 0 ? -1 : 0 > i ? 1 : 0,
                    this.directionY = j > 0 ? -1 : 0 > j ? 1 : 0,
                    this.moved || this._execEvent("scrollStart"),
                    this.moved = !0,
                    this._translate(b, d),
                    k - this.startTime > 300 && (this.startTime = k,
                    this.startX = this.x,
                    this.startY = this.y)
                }
            }
        },
        _end: function(a) {
            if (this.enabled && f.eventType[a.type] === this.initiated) {
                this.options.preventDefault && !f.preventDefaultException(a.target, this.options.preventDefaultException) && a.preventDefault();
                var b, d, e = (a.changedTouches ? a.changedTouches[0] : a,
                f.getTime() - this.startTime), g = c.round(this.x), h = c.round(this.y), i = c.abs(g - this.startX), j = c.abs(h - this.startY), k = 0, l = "";
                if (this.isInTransition = 0,
                this.initiated = 0,
                this.endTime = f.getTime(),
                !this.resetPosition(this.options.bounceTime))
                    return this.scrollTo(g, h),
                    this.moved ? this._events.flick && 200 > e && 100 > i && 100 > j ? void this._execEvent("flick") : (this.options.momentum && 300 > e && (b = this.hasHorizontalScroll ? f.momentum(this.x, this.startX, e, this.maxScrollX, this.options.bounce ? this.wrapperWidth : 0, this.options.deceleration) : {
                        destination: g,
                        duration: 0
                    },
                    d = this.hasVerticalScroll ? f.momentum(this.y, this.startY, e, this.maxScrollY, this.options.bounce ? this.wrapperHeight : 0, this.options.deceleration) : {
                        destination: h,
                        duration: 0
                    },
                    g = b.destination,
                    h = d.destination,
                    k = c.max(b.duration, d.duration),
                    this.isInTransition = 1),
                    g != this.x || h != this.y ? ((g > 0 || g < this.maxScrollX || h > 0 || h < this.maxScrollY) && (l = f.ease.quadratic),
                    void this.scrollTo(g, h, k, l)) : void this._execEvent("scrollEnd")) : (this.options.tap && f.tap(a, this.options.tap),
                    this.options.click && f.click(a),
                    void this._execEvent("scrollCancel"))
            }
        },
        _resize: function() {
            var a = this;
            clearTimeout(this.resizeTimeout),
            this.resizeTimeout = setTimeout(function() {
                a.refresh()
            }, this.options.resizePolling)
        },
        resetPosition: function(a) {
            var b = this.x
              , c = this.y;
            return a = a || 0,
            !this.hasHorizontalScroll || this.x > 0 ? b = 0 : this.x < this.maxScrollX && (b = this.maxScrollX),
            !this.hasVerticalScroll || this.y > 0 ? c = 0 : this.y < this.maxScrollY && (c = this.maxScrollY),
            b == this.x && c == this.y ? !1 : (this.scrollTo(b, c, a, this.options.bounceEasing),
            !0)
        },
        disable: function() {
            this.enabled = !1
        },
        enable: function() {
            this.enabled = !0
        },
        refresh: function() {
            this.wrapper.offsetHeight;
            this.wrapperWidth = this.wrapper.clientWidth,
            this.wrapperHeight = this.wrapper.clientHeight,
            this.scrollerWidth = this.scroller.offsetWidth,
            this.scrollerHeight = this.scroller.offsetHeight,
            this.maxScrollX = this.wrapperWidth - this.scrollerWidth,
            this.maxScrollY = this.wrapperHeight - this.scrollerHeight,
            this.hasHorizontalScroll = this.options.scrollX && this.maxScrollX < 0,
            this.hasVerticalScroll = this.options.scrollY && this.maxScrollY < 0,
            this.hasHorizontalScroll || (this.maxScrollX = 0,
            this.scrollerWidth = this.wrapperWidth),
            this.hasVerticalScroll || (this.maxScrollY = 0,
            this.scrollerHeight = this.wrapperHeight),
            this.endTime = 0,
            this.directionX = 0,
            this.directionY = 0,
            this.wrapperOffset = f.offset(this.wrapper),
            this._execEvent("refresh"),
            this.resetPosition()
        },
        on: function(a, b) {
            this._events[a] || (this._events[a] = []),
            this._events[a].push(b)
        },
        off: function(a, b) {
            if (this._events[a]) {
                var c = this._events[a].indexOf(b);
                c > -1 && this._events[a].splice(c, 1)
            }
        },
        _execEvent: function(a) {
            if (this._events[a]) {
                var b = 0
                  , c = this._events[a].length;
                if (c)
                    for (; c > b; b++)
                        this._events[a][b].apply(this, [].slice.call(arguments, 1))
            }
        },
        scrollBy: function(a, b, c, d) {
            a = this.x + a,
            b = this.y + b,
            c = c || 0,
            this.scrollTo(a, b, c, d)
        },
        scrollTo: function(a, b, c, d) {
            d = d || f.ease.circular,
            this.isInTransition = this.options.useTransition && c > 0,
            !c || this.options.useTransition && d.style ? (this._transitionTimingFunction(d.style),
            this._transitionTime(c),
            this._translate(a, b)) : this._animate(a, b, c, d.fn)
        },
        scrollToElement: function(a, b, d, e, g) {
            if (a = a.nodeType ? a : this.scroller.querySelector(a)) {
                var h = f.offset(a);
                h.left -= this.wrapperOffset.left,
                h.top -= this.wrapperOffset.top,
                d === !0 && (d = c.round(a.offsetWidth / 2 - this.wrapper.offsetWidth / 2)),
                e === !0 && (e = c.round(a.offsetHeight / 2 - this.wrapper.offsetHeight / 2)),
                h.left -= d || 0,
                h.top -= e || 0,
                h.left = h.left > 0 ? 0 : h.left < this.maxScrollX ? this.maxScrollX : h.left,
                h.top = h.top > 0 ? 0 : h.top < this.maxScrollY ? this.maxScrollY : h.top,
                b = void 0 === b || null  === b || "auto" === b ? c.max(c.abs(this.x - h.left), c.abs(this.y - h.top)) : b,
                this.scrollTo(h.left, h.top, b, g)
            }
        },
        _transitionTime: function(a) {
            a = a || 0,
            this.scrollerStyle[f.style.transitionDuration] = a + "ms",
            !a && f.isBadAndroid && (this.scrollerStyle[f.style.transitionDuration] = "0.001s")
        },
        _transitionTimingFunction: function(a) {
            this.scrollerStyle[f.style.transitionTimingFunction] = a
        },
        _translate: function(a, b) {
            this.options.useTransform ? this.scrollerStyle[f.style.transform] = "translate(" + a + "px," + b + "px)" + this.translateZ : (a = c.round(a),
            b = c.round(b),
            this.scrollerStyle.left = a + "px",
            this.scrollerStyle.top = b + "px"),
            this.x = a,
            this.y = b
        },
        _initEvents: function(b) {
            var c = b ? f.removeEvent : f.addEvent
              , d = this.options.bindToWrapper ? this.wrapper : a;
            c(a, "orientationchange", this),
            c(a, "resize", this),
            this.options.click && c(this.wrapper, "click", this, !0),
            this.options.disableMouse || (c(this.wrapper, "mousedown", this),
            c(d, "mousemove", this),
            c(d, "mousecancel", this),
            c(d, "mouseup", this)),
            f.hasPointer && !this.options.disablePointer && (c(this.wrapper, f.prefixPointerEvent("pointerdown"), this),
            c(d, f.prefixPointerEvent("pointermove"), this),
            c(d, f.prefixPointerEvent("pointercancel"), this),
            c(d, f.prefixPointerEvent("pointerup"), this)),
            f.hasTouch && !this.options.disableTouch && (c(this.wrapper, "touchstart", this),
            c(d, "touchmove", this),
            c(d, "touchcancel", this),
            c(d, "touchend", this)),
            c(this.scroller, "transitionend", this),
            c(this.scroller, "webkitTransitionEnd", this),
            c(this.scroller, "oTransitionEnd", this),
            c(this.scroller, "MSTransitionEnd", this)
        },
        getComputedPosition: function() {
            var b, c, d = a.getComputedStyle(this.scroller, null );
            return this.options.useTransform ? (d = d[f.style.transform].split(")")[0].split(", "),
            b = +(d[12] || d[4]),
            c = +(d[13] || d[5])) : (b = +d.left.replace(/[^-\d.]/g, ""),
            c = +d.top.replace(/[^-\d.]/g, "")),
            {
                x: b,
                y: c
            }
        },
        _animate: function(a, b, c, d) {
            function g() {
                var m, n, o, p = f.getTime();
                return p >= l ? (h.isAnimating = !1,
                h._translate(a, b),
                void (h.resetPosition(h.options.bounceTime) || h._execEvent("scrollEnd"))) : (p = (p - k) / c,
                o = d(p),
                m = (a - i) * o + i,
                n = (b - j) * o + j,
                h._translate(m, n),
                void (h.isAnimating && e(g)))
            }
            var h = this
              , i = this.x
              , j = this.y
              , k = f.getTime()
              , l = k + c;
            this.isAnimating = !0,
            g()
        },
        handleEvent: function(a) {
            switch (a.type) {
            case "touchstart":
            case "pointerdown":
            case "MSPointerDown":
            case "mousedown":
                this._start(a);
                break;
            case "touchmove":
            case "pointermove":
            case "MSPointerMove":
            case "mousemove":
                this._move(a);
                break;
            case "touchend":
            case "pointerup":
            case "MSPointerUp":
            case "mouseup":
            case "touchcancel":
            case "pointercancel":
            case "MSPointerCancel":
            case "mousecancel":
                this._end(a);
                break;
            case "orientationchange":
            case "resize":
                this._resize();
                break;
            case "transitionend":
            case "webkitTransitionEnd":
            case "oTransitionEnd":
            case "MSTransitionEnd":
                this._transitionEnd(a);
                break;
            case "wheel":
            case "DOMMouseScroll":
            case "mousewheel":
                this._wheel(a);
                break;
            case "keydown":
                this._key(a);
                break;
            case "click":
                a._constructed || (a.preventDefault(),
                a.stopPropagation())
            }
        }
    },
    d.utils = f,
    "undefined" != typeof module && module.exports ? module.exports = d : a.IScroll = d
}(window, document, Math);