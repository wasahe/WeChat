(function() {
	var ab = this,
		J = ab._,
		R = Array.prototype,
		O = Object.prototype,
		X = Function.prototype,
		K = R.push,
		Q = R.slice,
		H = R.concat,
		af = O.toString,
		aa = O.hasOwnProperty,
		V = Array.isArray,
		ad = Object.keys,
		Y = X.bind,
		P = function(a) {
			return a instanceof P ? a : this instanceof P ? void(this._wrapped = a) : new P(a)
		};
	"undefined" != typeof exports ? ("undefined" != typeof module && module.exports && (exports = module.exports = P), exports._ = P) : ab._ = P, P.VERSION = "1.7.0";
	var ac = function(b, a, c) {
			if (a === void 0) {
				return b
			}
			switch (null == c ? 3 : c) {
			case 1:
				return function(d) {
					return b.call(a, d)
				};
			case 2:
				return function(e, d) {
					return b.call(a, e, d)
				};
			case 3:
				return function(f, e, d) {
					return b.call(a, f, e, d)
				};
			case 4:
				return function(g, f, d, e) {
					return b.call(a, g, f, d, e)
				}
			}
			return function() {
				return b.apply(a, arguments)
			}
		};
	P.iteratee = function(b, a, c) {
		return null == b ? P.identity : P.isFunction(b) ? ac(b, a, c) : P.isObject(b) ? P.matches(b) : P.property(b)
	}, P.each = P.forEach = function(f, b, g) {
		if (null == f) {
			return f
		}
		b = ac(b, g);
		var d, a = f.length;
		if (a === +a) {
			for (d = 0; a > d; d++) {
				b(f[d], d, f)
			}
		} else {
			var c = P.keys(f);
			for (d = 0, a = c.length; a > d; d++) {
				b(f[c[d]], c[d], f)
			}
		}
		return f
	}, P.map = P.collect = function(g, c, k) {
		if (null == g) {
			return []
		}
		c = P.iteratee(c, k);
		for (var f, b = g.length !== +g.length && P.keys(g), d = (b || g).length, h = Array(d), a = 0; d > a; a++) {
			f = b ? b[a] : a, h[a] = c(g[f], f, g)
		}
		return h
	};
	var G = "Reduce of empty array with no initial value";
	P.reduce = P.foldl = P.inject = function(g, c, k, f) {
		null == g && (g = []), c = ac(c, f, 4);
		var b, d = g.length !== +g.length && P.keys(g),
			h = (d || g).length,
			a = 0;
		if (arguments.length < 3) {
			if (!h) {
				throw new TypeError(G)
			}
			k = g[d ? d[a++] : a++]
		}
		for (; h > a; a++) {
			b = d ? d[a] : a, k = c(k, g[b], b, g)
		}
		return k
	}, P.reduceRight = P.foldr = function(f, b, h, d) {
		null == f && (f = []), b = ac(b, d, 4);
		var a, c = f.length !== +f.length && P.keys(f),
			g = (c || f).length;
		if (arguments.length < 3) {
			if (!g) {
				throw new TypeError(G)
			}
			h = f[c ? c[--g] : --g]
		}
		for (; g--;) {
			a = c ? c[g] : g, h = b(h, f[a], a, f)
		}
		return h
	}, P.find = P.detect = function(c, a, d) {
		var b;
		return a = P.iteratee(a, d), P.some(c, function(g, h, f) {
			return a(g, h, f) ? (b = g, !0) : void 0
		}), b
	}, P.filter = P.select = function(c, a, d) {
		var b = [];
		return null == c ? b : (a = P.iteratee(a, d), P.each(c, function(g, h, f) {
			a(g, h, f) && b.push(g)
		}), b)
	}, P.reject = function(b, a, c) {
		return P.filter(b, P.negate(P.iteratee(a)), c)
	}, P.every = P.all = function(f, b, h) {
		if (null == f) {
			return !0
		}
		b = P.iteratee(b, h);
		var d, a, c = f.length !== +f.length && P.keys(f),
			g = (c || f).length;
		for (d = 0; g > d; d++) {
			if (a = c ? c[d] : d, !b(f[a], a, f)) {
				return !1
			}
		}
		return !0
	}, P.some = P.any = function(f, b, h) {
		if (null == f) {
			return !1
		}
		b = P.iteratee(b, h);
		var d, a, c = f.length !== +f.length && P.keys(f),
			g = (c || f).length;
		for (d = 0; g > d; d++) {
			if (a = c ? c[d] : d, b(f[a], a, f)) {
				return !0
			}
		}
		return !1
	}, P.contains = P.include = function(b, a) {
		return null == b ? !1 : (b.length !== +b.length && (b = P.values(b)), P.indexOf(b, a) >= 0)
	}, P.invoke = function(c, a) {
		var d = Q.call(arguments, 2),
			b = P.isFunction(a);
		return P.map(c, function(f) {
			return (b ? a : f[a]).apply(f, d)
		})
	}, P.pluck = function(b, a) {
		return P.map(b, P.property(a))
	}, P.where = function(b, a) {
		return P.filter(b, P.matches(a))
	}, P.findWhere = function(b, a) {
		return P.find(b, P.matches(a))
	}, P.max = function(g, l, d) {
		var b, f, m = -1 / 0,
			c = -1 / 0;
		if (null == l && null != g) {
			g = g.length === +g.length ? g : P.values(g);
			for (var k = 0, h = g.length; h > k; k++) {
				b = g[k], b > m && (m = b)
			}
		} else {
			l = P.iteratee(l, d), P.each(g, function(i, o, a) {
				f = l(i, o, a), (f > c || f === -1 / 0 && m === -1 / 0) && (m = i, c = f)
			})
		}
		return m
	}, P.min = function(g, l, d) {
		var b, f, m = 1 / 0,
			c = 1 / 0;
		if (null == l && null != g) {
			g = g.length === +g.length ? g : P.values(g);
			for (var k = 0, h = g.length; h > k; k++) {
				b = g[k], m > b && (m = b)
			}
		} else {
			l = P.iteratee(l, d), P.each(g, function(i, o, a) {
				f = l(i, o, a), (c > f || 1 / 0 === f && 1 / 0 === m) && (m = i, c = f)
			})
		}
		return m
	}, P.shuffle = function(f) {
		for (var b, g = f && f.length === +f.length ? f : P.values(f), d = g.length, a = Array(d), c = 0; d > c; c++) {
			b = P.random(0, c), b !== c && (a[c] = a[b]), a[b] = g[c]
		}
		return a
	}, P.sample = function(b, a, c) {
		return null == a || c ? (b.length !== +b.length && (b = P.values(b)), b[P.random(b.length - 1)]) : P.shuffle(b).slice(0, Math.max(0, a))
	}, P.sortBy = function(b, a, c) {
		return a = P.iteratee(a, c), P.pluck(P.map(b, function(f, g, d) {
			return {
				value: f,
				index: g,
				criteria: a(f, g, d)
			}
		}).sort(function(g, d) {
			var h = g.criteria,
				f = d.criteria;
			if (h !== f) {
				if (h > f || h === void 0) {
					return 1
				}
				if (f > h || f === void 0) {
					return -1
				}
			}
			return g.index - d.index
		}), "value")
	};
	var U = function(a) {
			return function(c, e, d) {
				var b = {};
				return e = P.iteratee(e, d), P.each(c, function(g, f) {
					var h = e(g, f, c);
					a(b, g, h)
				}), b
			}
		};
	P.groupBy = U(function(b, a, c) {
		P.has(b, c) ? b[c].push(a) : b[c] = [a]
	}), P.indexBy = U(function(b, a, c) {
		b[c] = a
	}), P.countBy = U(function(b, a, c) {
		P.has(b, c) ? b[c]++ : b[c] = 1
	}), P.sortedIndex = function(g, c, k, f) {
		k = P.iteratee(k, f, 1);
		for (var b = k(c), d = 0, h = g.length; h > d;) {
			var a = d + h >>> 1;
			k(g[a]) < b ? d = a + 1 : h = a
		}
		return d
	}, P.toArray = function(a) {
		return a ? P.isArray(a) ? Q.call(a) : a.length === +a.length ? P.map(a, P.identity) : P.values(a) : []
	}, P.size = function(a) {
		return null == a ? 0 : a.length === +a.length ? a.length : P.keys(a).length
	}, P.partition = function(d, b, f) {
		b = P.iteratee(b, f);
		var c = [],
			a = [];
		return P.each(d, function(h, i, g) {
			(b(h, i, g) ? c : a).push(h)
		}), [c, a]
	}, P.first = P.head = P.take = function(b, a, c) {
		return null == b ? void 0 : null == a || c ? b[0] : 0 > a ? [] : Q.call(b, 0, a)
	}, P.initial = function(b, a, c) {
		return Q.call(b, 0, Math.max(0, b.length - (null == a || c ? 1 : a)))
	}, P.last = function(b, a, c) {
		return null == b ? void 0 : null == a || c ? b[b.length - 1] : Q.call(b, Math.max(b.length - a, 0))
	}, P.rest = P.tail = P.drop = function(b, a, c) {
		return Q.call(b, null == a || c ? 1 : a)
	}, P.compact = function(a) {
		return P.filter(a, P.identity)
	};
	var Z = function(g, d, k, f) {
			if (d && P.every(g, P.isArray)) {
				return H.apply(f, g)
			}
			for (var c = 0, h = g.length; h > c; c++) {
				var b = g[c];
				P.isArray(b) || P.isArguments(b) ? d ? K.apply(f, b) : Z(b, d, k, f) : k || f.push(b)
			}
			return f
		};
	P.flatten = function(b, a) {
		return Z(b, a, !1, [])
	}, P.without = function(a) {
		return P.difference(a, Q.call(arguments, 1))
	}, P.uniq = P.unique = function(k, p, d, b) {
		if (null == k) {
			return []
		}
		P.isBoolean(p) || (b = d, d = p, p = !1), null != d && (d = P.iteratee(d, b));
		for (var g = [], v = [], c = 0, m = k.length; m > c; c++) {
			var l = k[c];
			if (p) {
				c && v === l || g.push(l), v = l
			} else {
				if (d) {
					var h = d(l, c, k);
					P.indexOf(v, h) < 0 && (v.push(h), g.push(l))
				} else {
					P.indexOf(g, l) < 0 && g.push(l)
				}
			}
		}
		return g
	}, P.union = function() {
		return P.uniq(Z(arguments, !0, !0, []))
	}, P.intersection = function(f) {
		if (null == f) {
			return []
		}
		for (var b = [], h = arguments.length, d = 0, a = f.length; a > d; d++) {
			var c = f[d];
			if (!P.contains(b, c)) {
				for (var g = 1; h > g && P.contains(arguments[g], c); g++) {}
				g === h && b.push(c)
			}
		}
		return b
	}, P.difference = function(b) {
		var a = Z(Q.call(arguments, 1), !0, !0, []);
		return P.filter(b, function(c) {
			return !P.contains(a, c)
		})
	}, P.zip = function(c) {
		if (null == c) {
			return []
		}
		for (var a = P.max(arguments, "length").length, d = Array(a), b = 0; a > b; b++) {
			d[b] = P.pluck(arguments, b)
		}
		return d
	}, P.object = function(d, b) {
		if (null == d) {
			return {}
		}
		for (var f = {}, c = 0, a = d.length; a > c; c++) {
			b ? f[d[c]] = b[c] : f[d[c][0]] = d[c][1]
		}
		return f
	}, P.indexOf = function(d, b, f) {
		if (null == d) {
			return -1
		}
		var c = 0,
			a = d.length;
		if (f) {
			if ("number" != typeof f) {
				return c = P.sortedIndex(d, b), d[c] === b ? c : -1
			}
			c = 0 > f ? Math.max(0, a + f) : f
		}
		for (; a > c; c++) {
			if (d[c] === b) {
				return c
			}
		}
		return -1
	}, P.lastIndexOf = function(c, a, d) {
		if (null == c) {
			return -1
		}
		var b = c.length;
		for ("number" == typeof d && (b = 0 > d ? b + d + 1 : Math.min(b, d + 1)); --b >= 0;) {
			if (c[b] === a) {
				return b
			}
		}
		return -1
	}, P.range = function(f, b, g) {
		arguments.length <= 1 && (b = f || 0, f = 0), g = g || 1;
		for (var d = Math.max(Math.ceil((b - f) / g), 0), a = Array(d), c = 0; d > c; c++, f += g) {
			a[c] = f
		}
		return a
	};
	var B = function() {};
	P.bind = function(c, a) {
		var d, b;
		if (Y && c.bind === Y) {
			return Y.apply(c, Q.call(arguments, 1))
		}
		if (!P.isFunction(c)) {
			throw new TypeError("Bind must be called on a function")
		}
		return d = Q.call(arguments, 2), b = function() {
			if (this instanceof b) {
				B.prototype = c.prototype;
				var e = new B;
				B.prototype = null;
				var f = c.apply(e, d.concat(Q.call(arguments)));
				return P.isObject(f) ? f : e
			}
			return c.apply(a, d.concat(Q.call(arguments)))
		}
	}, P.partial = function(b) {
		var a = Q.call(arguments, 1);
		return function() {
			for (var f = 0, e = a.slice(), c = 0, d = e.length; d > c; c++) {
				e[c] === P && (e[c] = arguments[f++])
			}
			for (; f < arguments.length;) {
				e.push(arguments[f++])
			}
			return b.apply(this, e)
		}
	}, P.bindAll = function(c) {
		var a, d, b = arguments.length;
		if (1 >= b) {
			throw new Error("bindAll must be passed function names")
		}
		for (a = 1; b > a; a++) {
			d = arguments[a], c[d] = P.bind(c[d], c)
		}
		return c
	}, P.memoize = function(b, a) {
		var c = function(f) {
				var d = c.cache,
					e = a ? a.apply(this, arguments) : f;
				return P.has(d, e) || (d[e] = b.apply(this, arguments)), d[e]
			};
		return c.cache = {}, c
	}, P.delay = function(b, a) {
		var c = Q.call(arguments, 2);
		return setTimeout(function() {
			return b.apply(null, c)
		}, a)
	}, P.defer = function(a) {
		return P.delay.apply(P, [a, 1].concat(Q.call(arguments, 1)))
	}, P.throttle = function(g, l, d) {
		var b, f, m, c = null,
			k = 0;
		d || (d = {});
		var h = function() {
				k = d.leading === !1 ? 0 : P.now(), c = null, m = g.apply(b, f), c || (b = f = null)
			};
		return function() {
			var e = P.now();
			k || d.leading !== !1 || (k = e);
			var a = l - (e - k);
			return b = this, f = arguments, 0 >= a || a > l ? (clearTimeout(c), c = null, k = e, m = g.apply(b, f), c || (b = f = null)) : c || d.trailing === !1 || (c = setTimeout(h, a)), m
		}
	}, P.debounce = function(g, l, d) {
		var b, f, m, c, k, h = function() {
				var a = P.now() - c;
				l > a && a > 0 ? b = setTimeout(h, l - a) : (b = null, d || (k = g.apply(m, f), b || (m = f = null)))
			};
		return function() {
			m = this, f = arguments, c = P.now();
			var a = d && !b;
			return b || (b = setTimeout(h, l)), a && (k = g.apply(m, f), m = f = null), k
		}
	}, P.wrap = function(b, a) {
		return P.partial(a, b)
	}, P.negate = function(a) {
		return function() {
			return !a.apply(this, arguments)
		}
	}, P.compose = function() {
		var b = arguments,
			a = b.length - 1;
		return function() {
			for (var d = a, c = b[a].apply(this, arguments); d--;) {
				c = b[d].call(this, c)
			}
			return c
		}
	}, P.after = function(b, a) {
		return function() {
			return --b < 1 ? a.apply(this, arguments) : void 0
		}
	}, P.before = function(b, a) {
		var c;
		return function() {
			return --b > 0 ? c = a.apply(this, arguments) : a = null, c
		}
	}, P.once = P.partial(P.before, 2), P.keys = function(b) {
		if (!P.isObject(b)) {
			return []
		}
		if (ad) {
			return ad(b)
		}
		var a = [];
		for (var c in b) {
			P.has(b, c) && a.push(c)
		}
		return a
	}, P.values = function(d) {
		for (var b = P.keys(d), f = b.length, c = Array(f), a = 0; f > a; a++) {
			c[a] = d[b[a]]
		}
		return c
	}, P.pairs = function(d) {
		for (var b = P.keys(d), f = b.length, c = Array(f), a = 0; f > a; a++) {
			c[a] = [b[a], d[b[a]]]
		}
		return c
	}, P.invert = function(d) {
		for (var b = {}, f = P.keys(d), c = 0, a = f.length; a > c; c++) {
			b[d[f[c]]] = f[c]
		}
		return b
	}, P.functions = P.methods = function(b) {
		var a = [];
		for (var c in b) {
			P.isFunction(b[c]) && a.push(c)
		}
		return a.sort()
	}, P.extend = function(d) {
		if (!P.isObject(d)) {
			return d
		}
		for (var b, f, c = 1, a = arguments.length; a > c; c++) {
			b = arguments[c];
			for (f in b) {
				aa.call(b, f) && (d[f] = b[f])
			}
		}
		return d
	}, P.pick = function(k, o, c) {
		var b, g = {};
		if (null == k) {
			return g
		}
		if (P.isFunction(o)) {
			o = ac(o, c);
			for (b in k) {
				var p = k[b];
				o(p, b, k) && (g[b] = p)
			}
		} else {
			var m = H.apply([], Q.call(arguments, 1));
			k = new Object(k);
			for (var h = 0, d = m.length; d > h; h++) {
				b = m[h], b in k && (g[b] = k[b])
			}
		}
		return g
	}, P.omit = function(c, a, d) {
		if (P.isFunction(a)) {
			a = P.negate(a)
		} else {
			var b = P.map(H.apply([], Q.call(arguments, 1)), String);
			a = function(g, f) {
				return !P.contains(b, f)
			}
		}
		return P.pick(c, a, d)
	}, P.defaults = function(d) {
		if (!P.isObject(d)) {
			return d
		}
		for (var b = 1, f = arguments.length; f > b; b++) {
			var c = arguments[b];
			for (var a in c) {
				d[a] === void 0 && (d[a] = c[a])
			}
		}
		return d
	}, P.clone = function(a) {
		return P.isObject(a) ? P.isArray(a) ? a.slice() : P.extend({}, a) : a
	}, P.tap = function(b, a) {
		return a(b), b
	};
	var ae = function(v, y, d, a) {
			if (v === y) {
				return 0 !== v || 1 / v === 1 / y
			}
			if (null == v || null == y) {
				return v === y
			}
			v instanceof P && (v = v._wrapped), y instanceof P && (y = y._wrapped);
			var k = af.call(v);
			if (k !== af.call(y)) {
				return !1
			}
			switch (k) {
			case "[object RegExp]":
			case "[object String]":
				return "" + v == "" + y;
			case "[object Number]":
				return +v !== +v ? +y !== +y : 0 === +v ? 1 / +v === 1 / y : +v === +y;
			case "[object Date]":
			case "[object Boolean]":
				return +v === +y
			}
			if ("object" != typeof v || "object" != typeof y) {
				return !1
			}
			for (var C = d.length; C--;) {
				if (d[C] === v) {
					return a[C] === y
				}
			}
			var b = v.constructor,
				x = y.constructor;
			if (b !== x && "constructor" in v && "constructor" in y && !(P.isFunction(b) && b instanceof b && P.isFunction(x) && x instanceof x)) {
				return !1
			}
			d.push(v), a.push(y);
			var p, g;
			if ("[object Array]" === k) {
				if (p = v.length, g = p === y.length) {
					for (; p-- && (g = ae(v[p], y[p], d, a));) {}
				}
			} else {
				var w, m = P.keys(v);
				if (p = m.length, g = P.keys(y).length === p) {
					for (; p-- && (w = m[p], g = P.has(y, w) && ae(v[w], y[w], d, a));) {}
				}
			}
			return d.pop(), a.pop(), g
		};
	P.isEqual = function(b, a) {
		return ae(b, a, [], [])
	}, P.isEmpty = function(b) {
		if (null == b) {
			return !0
		}
		if (P.isArray(b) || P.isString(b) || P.isArguments(b)) {
			return 0 === b.length
		}
		for (var a in b) {
			if (P.has(b, a)) {
				return !1
			}
		}
		return !0
	}, P.isElement = function(a) {
		return !!a && 1 === a.nodeType
	}, P.isArray = V ||
	function(a) {
		return "[object Array]" === af.call(a)
	}, P.isObject = function(b) {
		var a = typeof b;
		return "function" === a || "object" === a && !! b
	}, P.each(["Arguments", "Function", "String", "Number", "Date", "RegExp"], function(a) {
		P["is" + a] = function(b) {
			return af.call(b) === "[object " + a + "]"
		}
	}), P.isArguments(arguments) || (P.isArguments = function(a) {
		return P.has(a, "callee")
	}), "function" != typeof / . / && (P.isFunction = function(a) {
		return "function" == typeof a || !1
	}), P.isFinite = function(a) {
		return isFinite(a) && !isNaN(parseFloat(a))
	}, P.isNaN = function(a) {
		return P.isNumber(a) && a !== +a
	}, P.isBoolean = function(a) {
		return a === !0 || a === !1 || "[object Boolean]" === af.call(a)
	}, P.isNull = function(a) {
		return null === a
	}, P.isUndefined = function(a) {
		return a === void 0
	}, P.has = function(b, a) {
		return null != b && aa.call(b, a)
	}, P.noConflict = function() {
		return ab._ = J, this
	}, P.identity = function(a) {
		return a
	}, P.constant = function(a) {
		return function() {
			return a
		}
	}, P.noop = function() {}, P.property = function(a) {
		return function(b) {
			return b[a]
		}
	}, P.matches = function(b) {
		var a = P.pairs(b),
			c = a.length;
		return function(h) {
			if (null == h) {
				return !c
			}
			h = new Object(h);
			for (var g = 0; c > g; g++) {
				var d = a[g],
					f = d[0];
				if (d[1] !== h[f] || !(f in h)) {
					return !1
				}
			}
			return !0
		}
	}, P.times = function(d, b, f) {
		var c = Array(Math.max(0, d));
		b = ac(b, f, 1);
		for (var a = 0; d > a; a++) {
			c[a] = b(a)
		}
		return c
	}, P.random = function(b, a) {
		return null == a && (a = b, b = 0), b + Math.floor(Math.random() * (a - b + 1))
	}, P.now = Date.now ||
	function() {
		return (new Date).getTime()
	};
	var F = {
		"&": "&amp;",
		"<": "&lt;",
		">": "&gt;",
		'"': "&quot;",
		"'": "&#x27;",
		"`": "&#x60;"
	},
		I = P.invert(F),
		q = function(d) {
			var b = function(e) {
					return d[e]
				},
				f = "(?:" + P.keys(d).join("|") + ")",
				c = RegExp(f),
				a = RegExp(f, "g");
			return function(g) {
				return g = null == g ? "" : "" + g, c.test(g) ? g.replace(a, b) : g
			}
		};
	P.escape = q(F), P.unescape = q(I), P.result = function(b, a) {
		if (null == b) {
			return void 0
		}
		var c = b[a];
		return P.isFunction(c) ? b[a]() : c
	};
	var D = 0;
	P.uniqueId = function(b) {
		var a = ++D + "";
		return b ? b + a : a
	}, P.templateSettings = {
		evaluate: /<%([\s\S]+?)%>/g,
		interpolate: /<%=([\s\S]+?)%>/g,
		escape: /<%-([\s\S]+?)%>/g
	};
	var j = /(.)^/,
		z = {
			"'": "'",
			"\\": "\\",
			"\r": "r",
			"\n": "n",
			"\u2028": "u2028",
			"\u2029": "u2029"
		},
		M = /\\|'|\r|\n|\u2028|\u2029/g,
		W = function(a) {
			return "\\" + z[a]
		};
	P.template = function(k, p, d) {
		!p && d && (p = d), p = P.defaults({}, p, P.templateSettings);
		var b = RegExp([(p.escape || j).source, (p.interpolate || j).source, (p.evaluate || j).source].join("|") + "|$", "g"),
			g = 0,
			v = "__p+='";
		k.replace(b, function(e, s, f, i, a) {
			return v += k.slice(g, a).replace(M, W), g = a + e.length, s ? v += "'+\n((__t=(" + s + "))==null?'':_.escape(__t))+\n'" : f ? v += "'+\n((__t=(" + f + "))==null?'':__t)+\n'" : i && (v += "';\n" + i + "\n__p+='"), e
		}), v += "';\n", p.variable || (v = "with(obj||{}){\n" + v + "}\n"), v = "var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};\n" + v + "return __p;\n";
		try {
			var c = new Function(p.variable || "obj", "_", v)
		} catch (m) {
			throw m.source = v, m
		}
		var l = function(a) {
				return c.call(this, a, P)
			},
			h = p.variable || "obj";
		return l.source = "function(" + h + "){\n" + v + "}", l
	}, P.chain = function(b) {
		var a = P(b);
		return a._chain = !0, a
	};
	var A = function(a) {
			return this._chain ? P(a).chain() : a
		};
	P.mixin = function(a) {
		P.each(P.functions(a), function(b) {
			var c = P[b] = a[b];
			P.prototype[b] = function() {
				var d = [this._wrapped];
				return K.apply(d, arguments), A.call(this, c.apply(P, d))
			}
		})
	}, P.mixin(P), P.each(["pop", "push", "reverse", "shift", "sort", "splice", "unshift"], function(b) {
		var a = R[b];
		P.prototype[b] = function() {
			var c = this._wrapped;
			return a.apply(c, arguments), "shift" !== b && "splice" !== b || 0 !== c.length || delete c[0], A.call(this, c)
		}
	}), P.each(["concat", "join", "slice"], function(b) {
		var a = R[b];
		P.prototype[b] = function() {
			return A.call(this, a.apply(this._wrapped, arguments))
		}
	}), P.prototype.value = function() {
		return this._wrapped
	}, "function" == typeof define && define.amd && define("underscore", [], function() {
		return P
	})
}).call(this);