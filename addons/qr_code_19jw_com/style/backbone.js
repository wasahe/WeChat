(function() {
	var ar = this,
		ad = ar.Backbone,
		ai = [],
		af = ai.push,
		an = ai.slice,
		ae = ai.splice,
		ah;
	typeof exports != "undefined" ? ah = exports : ah = ar.Backbone = {}, ah.VERSION = "1.0.0";
	var ac = ar._;
	!ac && typeof require != "undefined" && (ac = require("underscore")), ah.$ = ar.jQuery || ar.Zepto || ar.ender || ar.$, ah.noConflict = function() {
		return ar.Backbone = ad, this
	}, ah.emulateHTTP = !1, ah.emulateJSON = !1;
	var aw = ah.Events = {
		on: function(c, a, d) {
			if (!ak(this, "on", c, [a, d]) || !a) {
				return this
			}
			this._events || (this._events = {});
			var b = this._events[c] || (this._events[c] = []);
			return b.push({
				callback: a,
				context: d,
				ctx: d || this
			}), this
		},
		once: function(d, b, f) {
			if (!ak(this, "once", d, [b, f]) || !b) {
				return this
			}
			var c = this,
				a = ac.once(function() {
					c.off(d, a), b.apply(this, arguments)
				});
			return a._callback = b, this.on(d, a, f)
		},
		off: function(m, v, g) {
			var b, j, w, d, u, l, p, k;
			if (!this._events || !ak(this, "off", m, [v, g])) {
				return this
			}
			if (!m && !v && !g) {
				return this._events = {}, this
			}
			d = m ? [m] : ac.keys(this._events);
			for (u = 0, l = d.length; u < l; u++) {
				m = d[u];
				if (w = this._events[m]) {
					this._events[m] = b = [];
					if (v || g) {
						for (p = 0, k = w.length; p < k; p++) {
							j = w[p], (v && v !== j.callback && v !== j.callback._callback || g && g !== j.context) && b.push(j)
						}
					}
					b.length || delete this._events[m]
				}
			}
			return this
		},
		trigger: function(c) {
			if (!this._events) {
				return this
			}
			var a = an.call(arguments, 1);
			if (!ak(this, "trigger", c, a)) {
				return this
			}
			var d = this._events[c],
				b = this._events.all;
			return d && au(d, a), b && au(b, arguments), this
		},
		stopListening: function(f, b, g) {
			var d = this._listeners;
			if (!d) {
				return this
			}
			var a = !b && !g;
			typeof b == "object" && (g = this), f && ((d = {})[f._listenerId] = f);
			for (var c in d) {
				d[c].off(b, g, this), a && delete this._listeners[c]
			}
			return this
		}
	},
		aq = /\s+/,
		ak = function(g, c, j, f) {
			if (!j) {
				return !0
			}
			if (typeof j == "object") {
				for (var b in j) {
					g[c].apply(g, [b, j[b]].concat(f))
				}
				return !1
			}
			if (aq.test(j)) {
				var d = j.split(aq);
				for (var h = 0, a = d.length; h < a; h++) {
					g[c].apply(g, [d[h]].concat(f))
				}
				return !1
			}
			return !0
		},
		au = function(g, c) {
			var j, f = -1,
				b = g.length,
				d = c[0],
				h = c[1],
				a = c[2];
			switch (c.length) {
			case 0:
				while (++f < b) {
					(j = g[f]).callback.call(j.ctx)
				}
				return;
			case 1:
				while (++f < b) {
					(j = g[f]).callback.call(j.ctx, d)
				}
				return;
			case 2:
				while (++f < b) {
					(j = g[f]).callback.call(j.ctx, d, h)
				}
				return;
			case 3:
				while (++f < b) {
					(j = g[f]).callback.call(j.ctx, d, h, a)
				}
				return;
			default:
				while (++f < b) {
					(j = g[f]).callback.apply(j.ctx, c)
				}
			}
		},
		ao = {
			listenTo: "on",
			listenToOnce: "once"
		};
	ac.each(ao, function(b, a) {
		aw[a] = function(d, g, f) {
			var c = this._listeners || (this._listeners = {}),
				e = d._listenerId || (d._listenerId = ac.uniqueId("l"));
			return c[e] = d, typeof g == "object" && (f = this), d[b](g, f, this), this
		}
	}), aw.bind = aw.on, aw.unbind = aw.off, ac.extend(ah, aw);
	var ag = ah.Model = function(c, a) {
			var d, b = c || {};
			a || (a = {}), this.cid = ac.uniqueId("c"), this.attributes = {}, ac.extend(this, ac.pick(a, at)), a.parse && (b = this.parse(b, a) || {});
			if (d = ac.result(this, "defaults")) {
				b = ac.defaults({}, b, d)
			}
			this.set(b, a), this.changed = {}, this.initialize.apply(this, arguments)
		},
		at = ["url", "urlRoot", "collection"];
	ac.extend(ag.prototype, aw, {
		changed: null,
		validationError: null,
		idAttribute: "id",
		initialize: function() {},
		toJSON: function(a) {
			return ac.clone(this.attributes)
		},
		sync: function() {
			return ah.sync.apply(this, arguments)
		},
		get: function(a) {
			return this.attributes[a]
		},
		escape: function(a) {
			return ac.escape(this.get(a))
		},
		has: function(a) {
			return this.get(a) != null
		},
		set: function(w, A, j) {
			var b, m, B, g, y, v, k, x;
			if (w == null) {
				return this
			}
			typeof w == "object" ? (m = w, j = A) : (m = {})[w] = A, j || (j = {});
			if (!this._validate(m, j)) {
				return !1
			}
			B = j.unset, y = j.silent, g = [], v = this._changing, this._changing = !0, v || (this._previousAttributes = ac.clone(this.attributes), this.changed = {}), x = this.attributes, k = this._previousAttributes, this.idAttribute in m && (this.id = m[this.idAttribute]);
			for (b in m) {
				A = m[b], ac.isEqual(x[b], A) || g.push(b), ac.isEqual(k[b], A) ? delete this.changed[b] : this.changed[b] = A, B ? delete x[b] : x[b] = A
			}
			if (!y) {
				g.length && (this._pending = !0);
				for (var u = 0, d = g.length; u < d; u++) {
					this.trigger("change:" + g[u], this, x[g[u]], j)
				}
			}
			if (v) {
				return this
			}
			if (!y) {
				while (this._pending) {
					this._pending = !1, this.trigger("change", this, j)
				}
			}
			return this._pending = !1, this._changing = !1, this
		},
		unset: function(b, a) {
			return this.set(b, void 0, ac.extend({}, a, {
				unset: !0
			}))
		},
		clear: function(b) {
			var a = {};
			for (var c in this.attributes) {
				a[c] = void 0
			}
			return this.set(a, ac.extend({}, b, {
				unset: !0
			}))
		},
		hasChanged: function(a) {
			return a == null ? !ac.isEmpty(this.changed) : ac.has(this.changed, a)
		},
		changedAttributes: function(d) {
			if (!d) {
				return this.hasChanged() ? ac.clone(this.changed) : !1
			}
			var b, f = !1,
				c = this._changing ? this._previousAttributes : this.attributes;
			for (var a in d) {
				if (ac.isEqual(c[a], b = d[a])) {
					continue
				}(f || (f = {}))[a] = b
			}
			return f
		},
		previous: function(a) {
			return a == null || !this._previousAttributes ? null : this._previousAttributes[a]
		},
		previousAttributes: function() {
			return ac.clone(this._previousAttributes)
		},
		fetch: function(b) {
			b = b ? ac.clone(b) : {}, b.parse === void 0 && (b.parse = !0);
			var a = this,
				c = b.success;
			return b.success = function(d) {
				if (!a.set(a.parse(d, b), b)) {
					return !1
				}
				c && c(a, d, b), a.trigger("sync", a, d, b)
			}, am(this, b), this.sync("read", this, b)
		},
		save: function(j, l, d) {
			var b, g, m, c = this.attributes;
			j == null || typeof j == "object" ? (b = j, d = l) : (b = {})[j] = l;
			if (b && (!d || !d.wait) && !this.set(b, d)) {
				return !1
			}
			d = ac.extend({
				validate: !0
			}, d);
			if (!this._validate(b, d)) {
				return !1
			}
			b && d.wait && (this.attributes = ac.extend({}, c, b)), d.parse === void 0 && (d.parse = !0);
			var k = this,
				h = d.success;
			return d.success = function(f) {
				k.attributes = c;
				var a = k.parse(f, d);
				d.wait && (a = ac.extend(b || {}, a));
				if (ac.isObject(a) && !k.set(a, d)) {
					return !1
				}
				h && h(k, f, d), k.trigger("sync", k, f, d)
			}, am(this, d), g = this.isNew() ? "create" : d.patch ? "patch" : "update", g === "patch" && (d.attrs = b), m = this.sync(g, this, d), b && d.wait && (this.attributes = c), m
		},
		destroy: function(d) {
			d = d ? ac.clone(d) : {};
			var b = this,
				f = d.success,
				c = function() {
					b.trigger("destroy", b, b.collection, d)
				};
			d.success = function(e) {
				(d.wait || b.isNew()) && c(), f && f(b, e, d), b.isNew() || b.trigger("sync", b, e, d)
			};
			if (this.isNew()) {
				return d.success(), !1
			}
			am(this, d);
			var a = this.sync("delete", this, d);
			return d.wait || c(), a
		},
		url: function() {
			var a = ac.result(this, "urlRoot") || ac.result(this.collection, "url") || W();
			return this.isNew() ? a : a + (a.charAt(a.length - 1) === "/" ? "" : "/") + encodeURIComponent(this.id)
		},
		parse: function(b, a) {
			return b
		},
		clone: function() {
			return new this.constructor(this.attributes)
		},
		isNew: function() {
			return this.id == null
		},
		isValid: function(a) {
			return this._validate({}, ac.extend(a || {}, {
				validate: !0
			}))
		},
		_validate: function(b, a) {
			if (!a.validate || !this.validate) {
				return !0
			}
			b = ac.extend({}, this.attributes, b);
			var c = this.validationError = this.validate(b, a) || null;
			return c ? (this.trigger("invalid", this, c, ac.extend(a || {}, {
				validationError: c
			})), !1) : !0
		}
	});
	var ab = ["keys", "values", "pairs", "invert", "pick", "omit"];
	ac.each(ab, function(a) {
		ag.prototype[a] = function() {
			var b = an.call(arguments);
			return b.unshift(this.attributes), ac[a].apply(ac, b)
		}
	});
	var aj = ah.Collection = function(b, a) {
			a || (a = {}), a.url && (this.url = a.url), a.model && (this.model = a.model), a.comparator !== void 0 && (this.comparator = a.comparator), this._reset(), this.initialize.apply(this, arguments), b && this.reset(b, ac.extend({
				silent: !0
			}, a))
		},
		ap = {
			add: !0,
			remove: !0,
			merge: !0
		},
		Y = {
			add: !0,
			merge: !1,
			remove: !1
		};
	ac.extend(aj.prototype, aw, {
		model: ag,
		initialize: function() {},
		toJSON: function(a) {
			return this.map(function(b) {
				return b.toJSON(a)
			})
		},
		sync: function() {
			return ah.sync.apply(this, arguments)
		},
		add: function(b, a) {
			return this.set(b, ac.defaults(a || {}, Y))
		},
		remove: function(f, b) {
			f = ac.isArray(f) ? f.slice() : [f], b || (b = {});
			var g, d, a, c;
			for (g = 0, d = f.length; g < d; g++) {
				c = this.get(f[g]);
				if (!c) {
					continue
				}
				delete this._byId[c.id], delete this._byId[c.cid], a = this.indexOf(c), this.models.splice(a, 1), this.length--, b.silent || (b.index = a, c.trigger("remove", c, this, b)), this._removeReference(c)
			}
			return this
		},
		set: function(x, D) {
			D = ac.defaults(D || {}, ap), D.parse && (x = this.parse(x, D)), ac.isArray(x) || (x = x ? [x] : []);
			var j, s, g, B, w, r, A = D.at,
				u = this.comparator && A == null && D.sort !== !1,
				b = ac.isString(this.comparator) ? this.comparator : null,
				y = [],
				C = [],
				k = {};
			for (j = 0, s = x.length; j < s; j++) {
				if (!(g = this._prepareModel(x[j], D))) {
					continue
				}(w = this.get(g)) ? (D.remove && (k[w.cid] = !0), D.merge && (w.set(g.attributes, D), u && !r && w.hasChanged(b) && (r = !0))) : D.add && (y.push(g), g.on("all", this._onModelEvent, this), this._byId[g.cid] = g, g.id != null && (this._byId[g.id] = g))
			}
			if (D.remove) {
				for (j = 0, s = this.length; j < s; ++j) {
					k[(g = this.models[j]).cid] || C.push(g)
				}
				C.length && this.remove(C, D)
			}
			y.length && (u && (r = !0), this.length += y.length, A != null ? ae.apply(this.models, [A, 0].concat(y)) : af.apply(this.models, y)), r && this.sort({
				silent: !0
			});
			if (D.silent) {
				return this
			}
			for (j = 0, s = y.length; j < s; j++) {
				(g = y[j]).trigger("add", g, this, D)
			}
			return r && this.trigger("sort", this, D), this
		},
		reset: function(c, a) {
			a || (a = {});
			for (var d = 0, b = this.models.length; d < b; d++) {
				this._removeReference(this.models[d])
			}
			return a.previousModels = this.models, this._reset(), this.add(c, ac.extend({
				silent: !0
			}, a)), a.silent || this.trigger("reset", this, a), this
		},
		push: function(b, a) {
			return b = this._prepareModel(b, a), this.add(b, ac.extend({
				at: this.length
			}, a)), b
		},
		pop: function(b) {
			var a = this.at(this.length - 1);
			return this.remove(a, b), a
		},
		unshift: function(b, a) {
			return b = this._prepareModel(b, a), this.add(b, ac.extend({
				at: 0
			}, a)), b
		},
		shift: function(b) {
			var a = this.at(0);
			return this.remove(a, b), a
		},
		slice: function(b, a) {
			return this.models.slice(b, a)
		},
		get: function(a) {
			return a == null ? void 0 : this._byId[a.id != null ? a.id : a.cid || a]
		},
		at: function(a) {
			return this.models[a]
		},
		where: function(b, a) {
			return ac.isEmpty(b) ? a ? void 0 : [] : this[a ? "find" : "filter"](function(c) {
				for (var d in b) {
					if (b[d] !== c.get(d)) {
						return !1
					}
				}
				return !0
			})
		},
		findWhere: function(a) {
			return this.where(a, !0)
		},
		sort: function(a) {
			if (!this.comparator) {
				throw new Error("Cannot sort a set without a comparator")
			}
			return a || (a = {}), ac.isString(this.comparator) || this.comparator.length === 1 ? this.models = this.sortBy(this.comparator, this) : this.models.sort(ac.bind(this.comparator, this)), a.silent || this.trigger("sort", this, a), this
		},
		sortedIndex: function(c, a, d) {
			a || (a = this.comparator);
			var b = ac.isFunction(a) ? a : function(f) {
					return f.get(a)
				};
			return ac.sortedIndex(this.models, c, b, d)
		},
		pluck: function(a) {
			return ac.invoke(this.models, "get", a)
		},
		fetch: function(b) {
			b = b ? ac.clone(b) : {}, b.parse === void 0 && (b.parse = !0);
			var a = b.success,
				c = this;
			return b.success = function(e) {
				var d = b.reset ? "reset" : "set";
				c[d](e, b), a && a(c, e, b), c.trigger("sync", c, e, b)
			}, am(this, b), this.sync("read", this, b)
		},
		create: function(c, a) {
			a = a ? ac.clone(a) : {};
			if (!(c = this._prepareModel(c, a))) {
				return !1
			}
			a.wait || this.add(c, a);
			var d = this,
				b = a.success;
			return a.success = function(e) {
				a.wait && d.add(c, a), b && b(c, e, a)
			}, c.save(null, a), c
		},
		parse: function(b, a) {
			return b
		},
		clone: function() {
			return new this.constructor(this.models)
		},
		_reset: function() {
			this.length = 0, this.models = [], this._byId = {}
		},
		_prepareModel: function(b, a) {
			if (b instanceof ag) {
				return b.collection || (b.collection = this), b
			}
			a || (a = {}), a.collection = this;
			var c = new this.model(b, a);
			return c._validate(b, a) ? c : (this.trigger("invalid", this, b, a), !1)
		},
		_removeReference: function(a) {
			this === a.collection && delete a.collection, a.off("all", this._onModelEvent, this)
		},
		_onModelEvent: function(c, a, d, b) {
			if ((c === "add" || c === "remove") && d !== this) {
				return
			}
			c === "destroy" && this.remove(a, b), a && c === "change:" + a.idAttribute && (delete this._byId[a.previous(a.idAttribute)], a.id != null && (this._byId[a.id] = a)), this.trigger.apply(this, arguments)
		}
	});
	var av = ["forEach", "each", "map", "collect", "reduce", "foldl", "inject", "reduceRight", "foldr", "find", "detect", "filter", "select", "reject", "every", "all", "some", "any", "include", "contains", "invoke", "max", "min", "toArray", "size", "first", "head", "take", "initial", "rest", "tail", "drop", "last", "without", "indexOf", "shuffle", "lastIndexOf", "isEmpty", "chain"];
	ac.each(av, function(a) {
		aj.prototype[a] = function() {
			var b = an.call(arguments);
			return b.unshift(this.models), ac[a].apply(ac, b)
		}
	});
	var aa = ["groupBy", "countBy", "sortBy"];
	ac.each(aa, function(a) {
		aj.prototype[a] = function(b, d) {
			var c = ac.isFunction(b) ? b : function(f) {
					return f.get(b)
				};
			return ac[a](this.models, c, d)
		}
	});
	var R = ah.View = function(a) {
			this.cid = ac.uniqueId("view"), this._configure(a || {}), this._ensureElement(), this.initialize.apply(this, arguments), this.delegateEvents()
		},
		z = /^(\S+)\s*(.*)$/,
		Z = ["model", "collection", "el", "id", "attributes", "className", "tagName", "events"];
	ac.extend(R.prototype, aw, {
		tagName: "div",
		$: function(a) {
			return this.$el.find(a)
		},
		initialize: function() {},
		render: function() {
			return this
		},
		remove: function() {
			return this.$el.remove(), this.stopListening(), this
		},
		setElement: function(b, a) {
			return this.$el && this.undelegateEvents(), this.$el = b instanceof ah.$ ? b : ah.$(b), this.el = this.$el[0], a !== !1 && this.delegateEvents(), this
		},
		delegateEvents: function(f) {
			if (!f && !(f = ac.result(this, "events"))) {
				return this
			}
			this.undelegateEvents();
			for (var b in f) {
				var g = f[b];
				ac.isFunction(g) || (g = this[f[b]]);
				if (!g) {
					continue
				}
				var d = b.match(z),
					a = d[1],
					c = d[2];
				g = ac.bind(g, this), a += ".delegateEvents" + this.cid, c === "" ? this.$el.on(a, g) : this.$el.on(a, c, g)
			}
			return this
		},
		undelegateEvents: function() {
			return this.$el.off(".delegateEvents" + this.cid), this
		},
		_configure: function(a) {
			this.options && (a = ac.extend({}, ac.result(this, "options"), a)), ac.extend(this, ac.pick(a, Z)), this.options = a
		},
		_ensureElement: function() {
			if (!this.el) {
				var b = ac.extend({}, ac.result(this, "attributes"));
				this.id && (b.id = ac.result(this, "id")), this.className && (b["class"] = ac.result(this, "className"));
				var a = ah.$("<" + ac.result(this, "tagName") + ">").attr(b);
				this.setElement(a, !1)
			} else {
				this.setElement(ac.result(this, "el"), !1)
			}
		}
	}), ah.sync = function(h, d, j) {
		var g = q[h];
		ac.defaults(j || (j = {}), {
			emulateHTTP: ah.emulateHTTP,
			emulateJSON: ah.emulateJSON
		});
		var c = {
			type: g,
			dataType: "json"
		};
		j.url || (c.url = ac.result(d, "url") || W()), j.data == null && d && (h === "create" || h === "update" || h === "patch") && (c.contentType = "application/json", c.data = JSON.stringify(j.attrs || d.toJSON(j))), j.emulateJSON && (c.contentType = "application/x-www-form-urlencoded", c.data = c.data ? {
			model: c.data
		} : {});
		if (j.emulateHTTP && (g === "PUT" || g === "DELETE" || g === "PATCH")) {
			c.type = "POST", j.emulateJSON && (c.data._method = g);
			var f = j.beforeSend;
			j.beforeSend = function(a) {
				a.setRequestHeader("X-HTTP-Method-Override", g);
				if (f) {
					return f.apply(this, arguments)
				}
			}
		}
		c.type !== "GET" && !j.emulateJSON && (c.processData = !1), c.type === "PATCH" && window.ActiveXObject && (!window.external || !window.external.msActiveXFilteringEnabled) && (c.xhr = function() {
			return new ActiveXObject("Microsoft.XMLHTTP")
		});
		var b = j.xhr = ah.ajax(ac.extend(c, j));
		return d.trigger("request", d, b, j), b
	};
	var q = {
		create: "POST",
		update: "PUT",
		patch: "PATCH",
		"delete": "DELETE",
		read: "GET"
	};
	ah.ajax = function() {
		return ah.$.ajax.apply(ah.$, arguments)
	};
	var I = ah.Router = function(a) {
			a || (a = {}), a.routes && (this.routes = a.routes), this._bindRoutes(), this.initialize.apply(this, arguments)
		},
		V = /\((.*?)\)/g,
		al = /(\(\?)?:\w+/g,
		K = /\*\w+/g,
		X = /[\-{}\[\]+?.,\\\^$|#\s]/g;
	ac.extend(I.prototype, aw, {
		initialize: function() {},
		route: function(c, a, d) {
			ac.isRegExp(c) || (c = this._routeToRegExp(c)), ac.isFunction(a) && (d = a, a = ""), d || (d = this[a]);
			var b = this;
			return ah.history.route(c, function(e) {
				var f = b._extractParameters(c, e);
				d && d.apply(b, f), b.trigger.apply(b, ["route:" + a].concat(f)), b.trigger("route", a, f), ah.history.trigger("route", b, a, f)
			}), this
		},
		navigate: function(b, a) {
			return ah.history.navigate(b, a), this
		},
		_bindRoutes: function() {
			if (!this.routes) {
				return
			}
			this.routes = ac.result(this, "routes");
			var b, a = ac.keys(this.routes);
			while ((b = a.pop()) != null) {
				this.route(b, this.routes[b])
			}
		},
		_routeToRegExp: function(a) {
			return a = a.replace(X, "\\$&").replace(V, "(?:$1)?").replace(al, function(c, b) {
				return b ? c : "([^/]+)"
			}).replace(K, "(.*?)"), new RegExp("^" + a + "$")
		},
		_extractParameters: function(b, a) {
			var c = b.exec(a).slice(1);
			return ac.map(c, function(d) {
				return d ? decodeURIComponent(d) : null
			})
		}
	});
	var G = ah.History = function() {
			this.handlers = [], ac.bindAll(this, "checkUrl"), typeof window != "undefined" && (this.location = window.location, this.history = window.history)
		},
		J = /^[#\/]|\s+$/g,
		ax = /^\/+|\/+$/g,
		U = /msie [\w.]+/,
		F = /\/$/;
	G.started = !1, ac.extend(G.prototype, aw, {
		interval: 50,
		getHash: function(b) {
			var a = (b || this).location.href.match(/#(.*)$/);
			return a ? a[1] : ""
		},
		getFragment: function(b, a) {
			if (b == null) {
				if (this._hasPushState || !this._wantsHashChange || a) {
					b = this.location.pathname;
					var c = this.root.replace(F, "");
					b.indexOf(c) || (b = b.substr(c.length))
				} else {
					b = this.getHash()
				}
			}
			return b.replace(J, "")
		},
		start: function(f) {
			if (G.started) {
				throw new Error("Backbone.history has already been started")
			}
			G.started = !0, this.options = ac.extend({}, {
				root: "/"
			}, this.options, f), this.root = this.options.root, this._wantsHashChange = this.options.hashChange !== !1, this._wantsPushState = !! this.options.pushState, this._hasPushState = !! (this.options.pushState && this.history && this.history.pushState);
			var b = this.getFragment(),
				g = document.documentMode,
				d = U.exec(navigator.userAgent.toLowerCase()) && (!g || g <= 7);
			this.root = ("/" + this.root + "/").replace(ax, "/"), d && this._wantsHashChange && (this.iframe = ah.$('<iframe src="javascript:0" tabindex="-1" />').hide().appendTo("body")[0].contentWindow, this.navigate(b)), this._hasPushState ? ah.$(window).on("popstate", this.checkUrl) : this._wantsHashChange && "onhashchange" in window && !d ? ah.$(window).on("hashchange", this.checkUrl) : this._wantsHashChange && (this._checkUrlInterval = setInterval(this.checkUrl, this.interval)), this.fragment = b;
			var a = this.location,
				c = a.pathname.replace(/[^\/]$/, "$&/") === this.root;
			if (this._wantsHashChange && this._wantsPushState && !this._hasPushState && !c) {
				return this.fragment = this.getFragment(null, !0), this.location.replace(this.root + this.location.search + "#" + this.fragment), !0
			}
			this._wantsPushState && this._hasPushState && c && a.hash && (this.fragment = this.getHash().replace(J, ""), this.history.replaceState({}, document.title, this.root + this.fragment + a.search));
			if (!this.options.silent) {
				return this.loadUrl()
			}
		},
		stop: function() {
			ah.$(window).off("popstate", this.checkUrl).off("hashchange", this.checkUrl), clearInterval(this._checkUrlInterval), G.started = !1
		},
		route: function(b, a) {
			this.handlers.unshift({
				route: b,
				callback: a
			})
		},
		checkUrl: function(b) {
			var a = this.getFragment();
			a === this.fragment && this.iframe && (a = this.getFragment(this.getHash(this.iframe)));
			if (a === this.fragment) {
				return !1
			}
			this.iframe && this.navigate(a), this.loadUrl() || this.loadUrl(this.getHash())
		},
		loadUrl: function(b) {
			var a = this.fragment = this.getFragment(b),
				c = ac.any(this.handlers, function(d) {
					if (d.route.test(a)) {
						return d.callback(a), !0
					}
				});
			return c
		},
		navigate: function(b, a) {
			if (!G.started) {
				return !1
			}
			if (!a || a === !0) {
				a = {
					trigger: a
				}
			}
			b = this.getFragment(b || "");
			if (this.fragment === b) {
				return
			}
			this.fragment = b;
			var c = this.root + b;
			if (this._hasPushState) {
				this.history[a.replace ? "replaceState" : "pushState"]({}, document.title, c)
			} else {
				if (!this._wantsHashChange) {
					return this.location.assign(c)
				}
				this._updateHash(this.location, b, a.replace), this.iframe && b !== this.getFragment(this.getHash(this.iframe)) && (a.replace || this.iframe.document.open().close(), this._updateHash(this.iframe.location, b, a.replace))
			}
			a.trigger && this.loadUrl(b)
		},
		_updateHash: function(c, a, d) {
			if (d) {
				var b = c.href.replace(/(javascript:|#).*$/, "");
				c.replace(b + "#" + a)
			} else {
				c.hash = "#" + a
			}
		}
	}), ah.history = new G;
	var Q = function(d, b) {
			var f = this,
				c;
			d && ac.has(d, "constructor") ? c = d.constructor : c = function() {
				return f.apply(this, arguments)
			}, ac.extend(c, f, b);
			var a = function() {
					this.constructor = c
				};
			return a.prototype = f.prototype, c.prototype = new a, d && ac.extend(c.prototype, d), c.__super__ = f.prototype, c
		};
	ag.extend = aj.extend = I.extend = R.extend = G.extend = Q;
	var W = function() {
			throw new Error('A "url" property or function must be specified')
		},
		am = function(b, a) {
			var c = a.error;
			a.error = function(d) {
				c && c(b, d, a), b.trigger("error", b, d, a)
			}
		}
}).call(this);