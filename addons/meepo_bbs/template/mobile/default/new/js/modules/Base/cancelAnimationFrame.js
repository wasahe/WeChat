!function() {
    !function() {
        for (var a = 0, b = ["ms", "moz", "webkit", "o"], c = 0; c < b.length && !window.requestAnimationFrame; ++c)
            window.requestAnimationFrame = window[b[c] + "RequestAnimationFrame"],
            window.cancelAnimationFrame = window[b[c] + "CancelAnimationFrame"] || window[b[c] + "CancelRequestAnimationFrame"];
        window.requestAnimationFrame || (window.requestAnimationFrame = function(b) {
            var c = (new Date).getTime()
              , d = Math.max(0, 16 - (c - a))
              , e = window.setTimeout(function() {
                b(c + d)
            }, d);
            return a = c + d,
            e
        }
        ),
        window.cancelAnimationFrame || (window.cancelAnimationFrame = function(a) {
            clearTimeout(a)
        }
        )
    }()
}()