// @fancyapps/ui/Fancybox v4.0.27
const t = t => "object" == typeof t && null !== t && t.constructor === Object && "[object Object]" === Object.prototype.toString.call(t),
    e = (...i) => {
        let s = !1;
        "boolean" == typeof i[0] && (s = i.shift());
        let o = i[0];
        if (!o || "object" != typeof o) throw new Error("extendee must be an object");
        const n = i.slice(1),
            a = n.length;
        for (let i = 0; i < a; i++) {
            const a = n[i];
            for (let i in a)
                if (a.hasOwnProperty(i)) {
                    const n = a[i];
                    if (s && (Array.isArray(n) || t(n))) {
                        const t = Array.isArray(n) ? [] : {};
                        o[i] = e(!0, o.hasOwnProperty(i) ? o[i] : t, n)
                    } else o[i] = n
                }
        }
        return o
    },
    i = (t, e = 1e4) => (t = parseFloat(t) || 0, Math.round((t + Number.EPSILON) * e) / e),
    s = function (t) {
        return !!(t && "object" == typeof t && t instanceof Element && t !== document.body) && (!t.__Panzoom && (function (t) {
            const e = getComputedStyle(t)["overflow-y"],
                i = getComputedStyle(t)["overflow-x"],
                s = ("scroll" === e || "auto" === e) && Math.abs(t.scrollHeight - t.clientHeight) > 1,
                o = ("scroll" === i || "auto" === i) && Math.abs(t.scrollWidth - t.clientWidth) > 1;
            return s || o
        }(t) ? t : s(t.parentNode)))
    },
    o = "undefined" != typeof window && window.ResizeObserver || class {
        constructor(t) {
            this.observables = [], this.boundCheck = this.check.bind(this), this.boundCheck(), this.callback = t
        }
        observe(t) {
            if (this.observables.some((e => e.el === t))) return;
            const e = {
                el: t,
                size: {
                    height: t.clientHeight,
                    width: t.clientWidth
                }
            };
            this.observables.push(e)
        }
        unobserve(t) {
            this.observables = this.observables.filter((e => e.el !== t))
        }
        disconnect() {
            this.observables = []
        }
        check() {
            const t = this.observables.filter((t => {
                const e = t.el.clientHeight,
                    i = t.el.clientWidth;
                if (t.size.height !== e || t.size.width !== i) return t.size.height = e, t.size.width = i, !0
            })).map((t => t.el));
            t.length > 0 && this.callback(t), window.requestAnimationFrame(this.boundCheck)
        }
    };
class n {
    constructor(t) {
        this.id = self.Touch && t instanceof Touch ? t.identifier : -1, this.pageX = t.pageX, this.pageY = t.pageY, this.clientX = t.clientX, this.clientY = t.clientY
    }
}
const a = (t, e) => e ? Math.sqrt((e.clientX - t.clientX) ** 2 + (e.clientY - t.clientY) ** 2) : 0,
    r = (t, e) => e ? {
        clientX: (t.clientX + e.clientX) / 2,
        clientY: (t.clientY + e.clientY) / 2
    } : t;
class h {
    constructor(t, {
        start: e = (() => !0),
        move: i = (() => {}),
        end: s = (() => {})
    } = {}) {
        this._element = t, this.startPointers = [], this.currentPointers = [], this._pointerStart = t => {
            if (t.buttons > 0 && 0 !== t.button) return;
            const e = new n(t);
            this.currentPointers.some((t => t.id === e.id)) || this._triggerPointerStart(e, t) && (window.addEventListener("mousemove", this._move), window.addEventListener("mouseup", this._pointerEnd))
        }, this._touchStart = t => {
            for (const e of Array.from(t.changedTouches || [])) this._triggerPointerStart(new n(e), t)
        }, this._move = t => {
            const e = this.currentPointers.slice(),
                i = (t => "changedTouches" in t)(t) ? Array.from(t.changedTouches).map((t => new n(t))) : [new n(t)];
            for (const t of i) {
                const e = this.currentPointers.findIndex((e => e.id === t.id));
                e < 0 || (this.currentPointers[e] = t)
            }
            this._moveCallback(e, this.currentPointers.slice(), t)
        }, this._triggerPointerEnd = (t, e) => {
            const i = this.currentPointers.findIndex((e => e.id === t.id));
            return !(i < 0) && (this.currentPointers.splice(i, 1), this.startPointers.splice(i, 1), this._endCallback(t, e), !0)
        }, this._pointerEnd = t => {
            t.buttons > 0 && 0 !== t.button || this._triggerPointerEnd(new n(t), t) && (window.removeEventListener("mousemove", this._move, {
                passive: !1
            }), window.removeEventListener("mouseup", this._pointerEnd, {
                passive: !1
            }))
        }, this._touchEnd = t => {
            for (const e of Array.from(t.changedTouches || [])) this._triggerPointerEnd(new n(e), t)
        }, this._startCallback = e, this._moveCallback = i, this._endCallback = s, this._element.addEventListener("mousedown", this._pointerStart, {
            passive: !1
        }), this._element.addEventListener("touchstart", this._touchStart, {
            passive: !1
        }), this._element.addEventListener("touchmove", this._move, {
            passive: !1
        }), this._element.addEventListener("touchend", this._touchEnd), this._element.addEventListener("touchcancel", this._touchEnd)
    }
    stop() {
        this._element.removeEventListener("mousedown", this._pointerStart, {
            passive: !1
        }), this._element.removeEventListener("touchstart", this._touchStart, {
            passive: !1
        }), this._element.removeEventListener("touchmove", this._move, {
            passive: !1
        }), this._element.removeEventListener("touchend", this._touchEnd), this._element.removeEventListener("touchcancel", this._touchEnd), window.removeEventListener("mousemove", this._move), window.removeEventListener("mouseup", this._pointerEnd)
    }
    _triggerPointerStart(t, e) {
        return !!this._startCallback(t, e) && (this.currentPointers.push(t), this.startPointers.push(t), !0)
    }
}
class l {
    constructor(t = {}) {
        this.options = e(!0, {}, t), this.plugins = [], this.events = {};
        for (const t of ["on", "once"])
            for (const e of Object.entries(this.options[t] || {})) this[t](...e)
    }
    option(t, e, ...i) {
        t = String(t);
        let s = (o = t, n = this.options, o.split(".").reduce((function (t, e) {
            return t && t[e]
        }), n));
        var o, n;
        return "function" == typeof s && (s = s.call(this, this, ...i)), void 0 === s ? e : s
    }
    localize(t, e = []) {
        return t = (t = String(t).replace(/\{\{(\w+).?(\w+)?\}\}/g, ((t, i, s) => {
            let o = "";
            s ? o = this.option(`${i[0]+i.toLowerCase().substring(1)}.l10n.${s}`) : i && (o = this.option(`l10n.${i}`)), o || (o = t);
            for (let t = 0; t < e.length; t++) o = o.split(e[t][0]).join(e[t][1]);
            return o
        }))).replace(/\{\{(.*)\}\}/, ((t, e) => e))
    }
    on(e, i) {
        if (t(e)) {
            for (const t of Object.entries(e)) this.on(...t);
            return this
        }
        return String(e).split(" ").forEach((t => {
            const e = this.events[t] = this.events[t] || []; - 1 == e.indexOf(i) && e.push(i)
        })), this
    }
    once(e, i) {
        if (t(e)) {
            for (const t of Object.entries(e)) this.once(...t);
            return this
        }
        return String(e).split(" ").forEach((t => {
            const e = (...s) => {
                this.off(t, e), i.call(this, this, ...s)
            };
            e._ = i, this.on(t, e)
        })), this
    }
    off(e, i) {
        if (!t(e)) return e.split(" ").forEach((t => {
            const e = this.events[t];
            if (!e || !e.length) return this;
            let s = -1;
            for (let t = 0, o = e.length; t < o; t++) {
                const o = e[t];
                if (o && (o === i || o._ === i)) {
                    s = t;
                    break
                }
            } - 1 != s && e.splice(s, 1)
        })), this;
        for (const t of Object.entries(e)) this.off(...t)
    }
    trigger(t, ...e) {
        for (const i of [...this.events[t] || []].slice())
            if (i && !1 === i.call(this, this, ...e)) return !1;
        for (const i of [...this.events["*"] || []].slice())
            if (i && !1 === i.call(this, t, this, ...e)) return !1;
        return !0
    }
    attachPlugins(t) {
        const i = {};
        for (const [s, o] of Object.entries(t || {})) !1 === this.options[s] || this.plugins[s] || (this.options[s] = e({}, o.defaults || {}, this.options[s]), i[s] = new o(this));
        for (const [t, e] of Object.entries(i)) e.attach(this);
        return this.plugins = Object.assign({}, this.plugins, i), this
    }
    detachPlugins() {
        for (const t in this.plugins) {
            let e;
            (e = this.plugins[t]) && "function" == typeof e.detach && e.detach(this)
        }
        return this.plugins = {}, this
    }
}
const c = {
    touch: !0,
    zoom: !0,
    pinchToZoom: !0,
    panOnlyZoomed: !1,
    lockAxis: !1,
    friction: .64,
    decelFriction: .88,
    zoomFriction: .74,
    bounceForce: .2,
    baseScale: 1,
    minScale: 1,
    maxScale: 2,
    step: .5,
    textSelection: !1,
    click: "toggleZoom",
    wheel: "zoom",
    wheelFactor: 42,
    wheelLimit: 5,
    draggableClass: "is-draggable",
    draggingClass: "is-dragging",
    ratio: 1
};
class d extends l {
    constructor(t, i = {}) {
        super(e(!0, {}, c, i)), this.state = "init", this.$container = t;
        for (const t of ["onLoad", "onWheel", "onClick"]) this[t] = this[t].bind(this);
        this.initLayout(), this.resetValues(), this.attachPlugins(d.Plugins), this.trigger("init"), this.updateMetrics(), this.attachEvents(), this.trigger("ready"), !1 === this.option("centerOnStart") ? this.state = "ready" : this.panTo({
            friction: 0
        }), t.__Panzoom = this
    }
    initLayout() {
        const t = this.$container;
        if (!(t instanceof HTMLElement)) throw new Error("Panzoom: Container not found");
        const e = this.option("content") || t.querySelector(".panzoom__content");
        if (!e) throw new Error("Panzoom: Content not found");
        this.$content = e;
        let i = this.option("viewport") || t.querySelector(".panzoom__viewport");
        i || !1 === this.option("wrapInner") || (i = document.createElement("div"), i.classList.add("panzoom__viewport"), i.append(...t.childNodes), t.appendChild(i)), this.$viewport = i || e.parentNode
    }
    resetValues() {
        this.updateRate = this.option("updateRate", /iPhone|iPad|iPod|Android/i.test(navigator.userAgent) ? 250 : 24), this.container = {
            width: 0,
            height: 0
        }, this.viewport = {
            width: 0,
            height: 0
        }, this.content = {
            origWidth: 0,
            origHeight: 0,
            width: 0,
            height: 0,
            x: this.option("x", 0),
            y: this.option("y", 0),
            scale: this.option("baseScale")
        }, this.transform = {
            x: 0,
            y: 0,
            scale: 1
        }, this.resetDragPosition()
    }
    onLoad(t) {
        this.updateMetrics(), this.panTo({
            scale: this.option("baseScale"),
            friction: 0
        }), this.trigger("load", t)
    }
    onClick(t) {
        if (t.defaultPrevented) return;
        if (this.option("textSelection") && window.getSelection().toString().length) return void t.stopPropagation();
        const e = this.$content.getClientRects()[0];
        if ("ready" !== this.state && (this.dragPosition.midPoint || Math.abs(e.top - this.dragStart.rect.top) > 1 || Math.abs(e.left - this.dragStart.rect.left) > 1)) return t.preventDefault(), void t.stopPropagation();
        !1 !== this.trigger("click", t) && this.option("zoom") && "toggleZoom" === this.option("click") && (t.preventDefault(), t.stopPropagation(), this.zoomWithClick(t))
    }
    onWheel(t) {
        !1 !== this.trigger("wheel", t) && this.option("zoom") && this.option("wheel") && this.zoomWithWheel(t)
    }
    zoomWithWheel(t) {
        void 0 === this.changedDelta && (this.changedDelta = 0);
        const e = Math.max(-1, Math.min(1, -t.deltaY || -t.deltaX || t.wheelDelta || -t.detail)),
            i = this.content.scale;
        let s = i * (100 + e * this.option("wheelFactor")) / 100;
        if (e < 0 && Math.abs(i - this.option("minScale")) < .01 || e > 0 && Math.abs(i - this.option("maxScale")) < .01 ? (this.changedDelta += Math.abs(e), s = i) : (this.changedDelta = 0, s = Math.max(Math.min(s, this.option("maxScale")), this.option("minScale"))), this.changedDelta > this.option("wheelLimit")) return;
        if (t.preventDefault(), s === i) return;
        const o = this.$content.getBoundingClientRect(),
            n = t.clientX - o.left,
            a = t.clientY - o.top;
        this.zoomTo(s, {
            x: n,
            y: a
        })
    }
    zoomWithClick(t) {
        const e = this.$content.getClientRects()[0],
            i = t.clientX - e.left,
            s = t.clientY - e.top;
        this.toggleZoom({
            x: i,
            y: s
        })
    }
    attachEvents() {
        this.$content.addEventListener("load", this.onLoad), this.$container.addEventListener("wheel", this.onWheel, {
            passive: !1
        }), this.$container.addEventListener("click", this.onClick, {
            passive: !1
        }), this.initObserver();
        const t = new h(this.$container, {
            start: (e, i) => {
                if (!this.option("touch")) return !1;
                if (this.velocity.scale < 0) return !1;
                const o = i.composedPath()[0];
                if (!t.currentPointers.length) {
                    if (-1 !== ["BUTTON", "TEXTAREA", "OPTION", "INPUT", "SELECT", "VIDEO"].indexOf(o.nodeName)) return !1;
                    if (this.option("textSelection") && ((t, e, i) => {
                            const s = t.childNodes,
                                o = document.createRange();
                            for (let t = 0; t < s.length; t++) {
                                const n = s[t];
                                if (n.nodeType !== Node.TEXT_NODE) continue;
                                o.selectNodeContents(n);
                                const a = o.getBoundingClientRect();
                                if (e >= a.left && i >= a.top && e <= a.right && i <= a.bottom) return n
                            }
                            return !1
                        })(o, e.clientX, e.clientY)) return !1
                }
                return !s(o) && (!1 !== this.trigger("touchStart", i) && ("mousedown" === i.type && i.preventDefault(), this.state = "pointerdown", this.resetDragPosition(), this.dragPosition.midPoint = null, this.dragPosition.time = Date.now(), !0))
            },
            move: (e, i, s) => {
                if ("pointerdown" !== this.state) return;
                if (!1 === this.trigger("touchMove", s)) return void s.preventDefault();
                if (i.length < 2 && !0 === this.option("panOnlyZoomed") && this.content.width <= this.viewport.width && this.content.height <= this.viewport.height && this.transform.scale <= this.option("baseScale")) return;
                if (i.length > 1 && (!this.option("zoom") || !1 === this.option("pinchToZoom"))) return;
                const o = r(e[0], e[1]),
                    n = r(i[0], i[1]),
                    h = n.clientX - o.clientX,
                    l = n.clientY - o.clientY,
                    c = a(e[0], e[1]),
                    d = a(i[0], i[1]),
                    u = c && d ? d / c : 1;
                this.dragOffset.x += h, this.dragOffset.y += l, this.dragOffset.scale *= u, this.dragOffset.time = Date.now() - this.dragPosition.time;
                const f = 1 === this.dragStart.scale && this.option("lockAxis");
                if (f && !this.lockAxis) {
                    if (Math.abs(this.dragOffset.x) < 6 && Math.abs(this.dragOffset.y) < 6) return void s.preventDefault();
                    const t = Math.abs(180 * Math.atan2(this.dragOffset.y, this.dragOffset.x) / Math.PI);
                    this.lockAxis = t > 45 && t < 135 ? "y" : "x"
                }
                if ("xy" === f || "y" !== this.lockAxis) {
                    if (s.preventDefault(), s.stopPropagation(), s.stopImmediatePropagation(), this.lockAxis && (this.dragOffset["x" === this.lockAxis ? "y" : "x"] = 0), this.$container.classList.add(this.option("draggingClass")), this.transform.scale === this.option("baseScale") && "y" === this.lockAxis || (this.dragPosition.x = this.dragStart.x + this.dragOffset.x), this.transform.scale === this.option("baseScale") && "x" === this.lockAxis || (this.dragPosition.y = this.dragStart.y + this.dragOffset.y), this.dragPosition.scale = this.dragStart.scale * this.dragOffset.scale, i.length > 1) {
                        const e = r(t.startPointers[0], t.startPointers[1]),
                            i = e.clientX - this.dragStart.rect.x,
                            s = e.clientY - this.dragStart.rect.y,
                            {
                                deltaX: o,
                                deltaY: a
                            } = this.getZoomDelta(this.content.scale * this.dragOffset.scale, i, s);
                        this.dragPosition.x -= o, this.dragPosition.y -= a, this.dragPosition.midPoint = n
                    } else this.setDragResistance();
                    this.transform = {
                        x: this.dragPosition.x,
                        y: this.dragPosition.y,
                        scale: this.dragPosition.scale
                    }, this.startAnimation()
                }
            },
            end: (e, i) => {
                if ("pointerdown" !== this.state) return;
                if (this._dragOffset = {
                        ...this.dragOffset
                    }, t.currentPointers.length) return void this.resetDragPosition();
                if (this.state = "decel", this.friction = this.option("decelFriction"), this.recalculateTransform(), this.$container.classList.remove(this.option("draggingClass")), !1 === this.trigger("touchEnd", i)) return;
                if ("decel" !== this.state) return;
                const s = this.option("minScale");
                if (this.transform.scale < s) return void this.zoomTo(s, {
                    friction: .64
                });
                const o = this.option("maxScale");
                if (this.transform.scale - o > .01) {
                    const t = this.dragPosition.midPoint || e,
                        i = this.$content.getClientRects()[0];
                    this.zoomTo(o, {
                        friction: .64,
                        x: t.clientX - i.left,
                        y: t.clientY - i.top
                    })
                } else;
            }
        });
        this.pointerTracker = t
    }
    initObserver() {
        this.resizeObserver || (this.resizeObserver = new o((() => {
            this.updateTimer || (this.updateTimer = setTimeout((() => {
                const t = this.$container.getBoundingClientRect();
                t.width && t.height ? ((Math.abs(t.width - this.container.width) > 1 || Math.abs(t.height - this.container.height) > 1) && (this.isAnimating() && this.endAnimation(!0), this.updateMetrics(), this.panTo({
                    x: this.content.x,
                    y: this.content.y,
                    scale: this.option("baseScale"),
                    friction: 0
                })), this.updateTimer = null) : this.updateTimer = null
            }), this.updateRate))
        })), this.resizeObserver.observe(this.$container))
    }
    resetDragPosition() {
        this.lockAxis = null, this.friction = this.option("friction"), this.velocity = {
            x: 0,
            y: 0,
            scale: 0
        };
        const {
            x: t,
            y: e,
            scale: i
        } = this.content;
        this.dragStart = {
            rect: this.$content.getBoundingClientRect(),
            x: t,
            y: e,
            scale: i
        }, this.dragPosition = {
            ...this.dragPosition,
            x: t,
            y: e,
            scale: i
        }, this.dragOffset = {
            x: 0,
            y: 0,
            scale: 1,
            time: 0
        }
    }
    updateMetrics(t) {
        !0 !== t && this.trigger("beforeUpdate");
        const e = this.$container,
            s = this.$content,
            o = this.$viewport,
            n = s instanceof HTMLImageElement,
            a = this.option("zoom"),
            r = this.option("resizeParent", a);
        let h = this.option("width"),
            l = this.option("height"),
            c = h || (d = s, Math.max(parseFloat(d.naturalWidth || 0), parseFloat(d.width && d.width.baseVal && d.width.baseVal.value || 0), parseFloat(d.offsetWidth || 0), parseFloat(d.scrollWidth || 0)));
        var d;
        let u = l || (t => Math.max(parseFloat(t.naturalHeight || 0), parseFloat(t.height && t.height.baseVal && t.height.baseVal.value || 0), parseFloat(t.offsetHeight || 0), parseFloat(t.scrollHeight || 0)))(s);
        Object.assign(s.style, {
            width: h ? `${h}px` : "",
            height: l ? `${l}px` : "",
            maxWidth: "",
            maxHeight: ""
        }), r && Object.assign(o.style, {
            width: "",
            height: ""
        });
        const f = this.option("ratio");
        c = i(c * f), u = i(u * f), h = c, l = u;
        const g = s.getBoundingClientRect(),
            p = o.getBoundingClientRect(),
            m = o == e ? p : e.getBoundingClientRect();
        let y = Math.max(o.offsetWidth, i(p.width)),
            v = Math.max(o.offsetHeight, i(p.height)),
            b = window.getComputedStyle(o);
        if (y -= parseFloat(b.paddingLeft) + parseFloat(b.paddingRight), v -= parseFloat(b.paddingTop) + parseFloat(b.paddingBottom), this.viewport.width = y, this.viewport.height = v, a) {
            if (Math.abs(c - g.width) > .1 || Math.abs(u - g.height) > .1) {
                const t = ((t, e, i, s) => {
                    const o = Math.min(i / t || 0, s / e);
                    return {
                        width: t * o || 0,
                        height: e * o || 0
                    }
                })(c, u, Math.min(c, g.width), Math.min(u, g.height));
                h = i(t.width), l = i(t.height)
            }
            Object.assign(s.style, {
                width: `${h}px`,
                height: `${l}px`,
                transform: ""
            })
        }
        if (r && (Object.assign(o.style, {
                width: `${h}px`,
                height: `${l}px`
            }), this.viewport = {
                ...this.viewport,
                width: h,
                height: l
            }), n && a && "function" != typeof this.options.maxScale) {
            const t = this.option("maxScale");
            this.options.maxScale = function () {
                return this.content.origWidth > 0 && this.content.fitWidth > 0 ? this.content.origWidth / this.content.fitWidth : t
            }
        }
        this.content = {
            ...this.content,
            origWidth: c,
            origHeight: u,
            fitWidth: h,
            fitHeight: l,
            width: h,
            height: l,
            scale: 1,
            isZoomable: a
        }, this.container = {
            width: m.width,
            height: m.height
        }, !0 !== t && this.trigger("afterUpdate")
    }
    zoomIn(t) {
        this.zoomTo(this.content.scale + (t || this.option("step")))
    }
    zoomOut(t) {
        this.zoomTo(this.content.scale - (t || this.option("step")))
    }
    toggleZoom(t = {}) {
        const e = this.option("maxScale"),
            i = this.option("baseScale"),
            s = this.content.scale > i + .5 * (e - i) ? i : e;
        this.zoomTo(s, t)
    }
    zoomTo(t = this.option("baseScale"), {
        x: e = null,
        y: s = null
    } = {}) {
        t = Math.max(Math.min(t, this.option("maxScale")), this.option("minScale"));
        const o = i(this.content.scale / (this.content.width / this.content.fitWidth), 1e7);
        null === e && (e = this.content.width * o * .5), null === s && (s = this.content.height * o * .5);
        const {
            deltaX: n,
            deltaY: a
        } = this.getZoomDelta(t, e, s);
        e = this.content.x - n, s = this.content.y - a, this.panTo({
            x: e,
            y: s,
            scale: t,
            friction: this.option("zoomFriction")
        })
    }
    getZoomDelta(t, e = 0, i = 0) {
        const s = this.content.fitWidth * this.content.scale,
            o = this.content.fitHeight * this.content.scale,
            n = e > 0 && s ? e / s : 0,
            a = i > 0 && o ? i / o : 0;
        return {
            deltaX: (this.content.fitWidth * t - s) * n,
            deltaY: (this.content.fitHeight * t - o) * a
        }
    }
    panTo({
        x: t = this.content.x,
        y: e = this.content.y,
        scale: i,
        friction: s = this.option("friction"),
        ignoreBounds: o = !1
    } = {}) {
        if (i = i || this.content.scale || 1, !o) {
            const {
                boundX: s,
                boundY: o
            } = this.getBounds(i);
            s && (t = Math.max(Math.min(t, s.to), s.from)), o && (e = Math.max(Math.min(e, o.to), o.from))
        }
        this.friction = s, this.transform = {
            ...this.transform,
            x: t,
            y: e,
            scale: i
        }, s ? (this.state = "panning", this.velocity = {
            x: (1 / this.friction - 1) * (t - this.content.x),
            y: (1 / this.friction - 1) * (e - this.content.y),
            scale: (1 / this.friction - 1) * (i - this.content.scale)
        }, this.startAnimation()) : this.endAnimation()
    }
    startAnimation() {
        this.rAF ? cancelAnimationFrame(this.rAF) : this.trigger("startAnimation"), this.rAF = requestAnimationFrame((() => this.animate()))
    }
    animate() {
        if (this.setEdgeForce(), this.setDragForce(), this.velocity.x *= this.friction, this.velocity.y *= this.friction, this.velocity.scale *= this.friction, this.content.x += this.velocity.x, this.content.y += this.velocity.y, this.content.scale += this.velocity.scale, this.isAnimating()) this.setTransform();
        else if ("pointerdown" !== this.state) return void this.endAnimation();
        this.rAF = requestAnimationFrame((() => this.animate()))
    }
    getBounds(t) {
        let e = this.boundX,
            s = this.boundY;
        if (void 0 !== e && void 0 !== s) return {
            boundX: e,
            boundY: s
        };
        e = {
            from: 0,
            to: 0
        }, s = {
            from: 0,
            to: 0
        }, t = t || this.transform.scale;
        const o = this.content.fitWidth * t,
            n = this.content.fitHeight * t,
            a = this.viewport.width,
            r = this.viewport.height;
        if (o < a) {
            const t = i(.5 * (a - o));
            e.from = t, e.to = t
        } else e.from = i(a - o);
        if (n < r) {
            const t = .5 * (r - n);
            s.from = t, s.to = t
        } else s.from = i(r - n);
        return {
            boundX: e,
            boundY: s
        }
    }
    setEdgeForce() {
        if ("decel" !== this.state) return;
        const t = this.option("bounceForce"),
            {
                boundX: e,
                boundY: i
            } = this.getBounds(Math.max(this.transform.scale, this.content.scale));
        let s, o, n, a;
        if (e && (s = this.content.x < e.from, o = this.content.x > e.to), i && (n = this.content.y < i.from, a = this.content.y > i.to), s || o) {
            let i = ((s ? e.from : e.to) - this.content.x) * t;
            const o = this.content.x + (this.velocity.x + i) / this.friction;
            o >= e.from && o <= e.to && (i += this.velocity.x), this.velocity.x = i, this.recalculateTransform()
        }
        if (n || a) {
            let e = ((n ? i.from : i.to) - this.content.y) * t;
            const s = this.content.y + (e + this.velocity.y) / this.friction;
            s >= i.from && s <= i.to && (e += this.velocity.y), this.velocity.y = e, this.recalculateTransform()
        }
    }
    setDragResistance() {
        if ("pointerdown" !== this.state) return;
        const {
            boundX: t,
            boundY: e
        } = this.getBounds(this.dragPosition.scale);
        let i, s, o, n;
        if (t && (i = this.dragPosition.x < t.from, s = this.dragPosition.x > t.to), e && (o = this.dragPosition.y < e.from, n = this.dragPosition.y > e.to), (i || s) && (!i || !s)) {
            const e = i ? t.from : t.to,
                s = e - this.dragPosition.x;
            this.dragPosition.x = e - .3 * s
        }
        if ((o || n) && (!o || !n)) {
            const t = o ? e.from : e.to,
                i = t - this.dragPosition.y;
            this.dragPosition.y = t - .3 * i
        }
    }
    setDragForce() {
        "pointerdown" === this.state && (this.velocity.x = this.dragPosition.x - this.content.x, this.velocity.y = this.dragPosition.y - this.content.y, this.velocity.scale = this.dragPosition.scale - this.content.scale)
    }
    recalculateTransform() {
        this.transform.x = this.content.x + this.velocity.x / (1 / this.friction - 1), this.transform.y = this.content.y + this.velocity.y / (1 / this.friction - 1), this.transform.scale = this.content.scale + this.velocity.scale / (1 / this.friction - 1)
    }
    isAnimating() {
        return !(!this.friction || !(Math.abs(this.velocity.x) > .05 || Math.abs(this.velocity.y) > .05 || Math.abs(this.velocity.scale) > .05))
    }
    setTransform(t) {
        let e, s, o;
        if (t ? (e = i(this.transform.x), s = i(this.transform.y), o = this.transform.scale, this.content = {
                ...this.content,
                x: e,
                y: s,
                scale: o
            }) : (e = i(this.content.x), s = i(this.content.y), o = this.content.scale / (this.content.width / this.content.fitWidth), this.content = {
                ...this.content,
                x: e,
                y: s
            }), this.trigger("beforeTransform"), e = i(this.content.x), s = i(this.content.y), t && this.option("zoom")) {
            let t, n;
            t = i(this.content.fitWidth * o), n = i(this.content.fitHeight * o), this.content.width = t, this.content.height = n, this.transform = {
                ...this.transform,
                width: t,
                height: n,
                scale: o
            }, Object.assign(this.$content.style, {
                width: `${t}px`,
                height: `${n}px`,
                maxWidth: "none",
                maxHeight: "none",
                transform: `translate3d(${e}px, ${s}px, 0) scale(1)`
            })
        } else this.$content.style.transform = `translate3d(${e}px, ${s}px, 0) scale(${o})`;
        this.trigger("afterTransform")
    }
    endAnimation(t) {
        cancelAnimationFrame(this.rAF), this.rAF = null, this.velocity = {
            x: 0,
            y: 0,
            scale: 0
        }, this.setTransform(!0), this.state = "ready", this.handleCursor(), !0 !== t && this.trigger("endAnimation")
    }
    handleCursor() {
        const t = this.option("draggableClass");
        t && this.option("touch") && (1 == this.option("panOnlyZoomed") && this.content.width <= this.viewport.width && this.content.height <= this.viewport.height && this.transform.scale <= this.option("baseScale") ? this.$container.classList.remove(t) : this.$container.classList.add(t))
    }
    detachEvents() {
        this.$content.removeEventListener("load", this.onLoad), this.$container.removeEventListener("wheel", this.onWheel, {
            passive: !1
        }), this.$container.removeEventListener("click", this.onClick, {
            passive: !1
        }), this.pointerTracker && (this.pointerTracker.stop(), this.pointerTracker = null), this.resizeObserver && (this.resizeObserver.disconnect(), this.resizeObserver = null)
    }
    destroy() {
        "destroy" !== this.state && (this.state = "destroy", clearTimeout(this.updateTimer), this.updateTimer = null, cancelAnimationFrame(this.rAF), this.rAF = null, this.detachEvents(), this.detachPlugins(), this.resetDragPosition())
    }
}
d.version = "4.0.27", d.Plugins = {};
const u = (t, e) => {
    let i = 0;
    return function (...s) {
        const o = (new Date).getTime();
        if (!(o - i < e)) return i = o, t(...s)
    }
};
class f {
    constructor(t) {
        this.$container = null, this.$prev = null, this.$next = null, this.carousel = t, this.onRefresh = this.onRefresh.bind(this)
    }
    option(t) {
        return this.carousel.option(`Navigation.${t}`)
    }
    createButton(t) {
        const e = document.createElement("button");
        e.setAttribute("title", this.carousel.localize(`{{${t.toUpperCase()}}}`));
        const i = this.option("classNames.button") + " " + this.option(`classNames.${t}`);
        return e.classList.add(...i.split(" ")), e.setAttribute("tabindex", "0"), e.innerHTML = this.carousel.localize(this.option(`${t}Tpl`)), e.addEventListener("click", (e => {
            e.preventDefault(), e.stopPropagation(), this.carousel["slide" + ("next" === t ? "Next" : "Prev")]()
        })), e
    }
    build() {
        this.$container || (this.$container = document.createElement("div"), this.$container.classList.add(...this.option("classNames.main").split(" ")), this.carousel.$container.appendChild(this.$container)), this.$next || (this.$next = this.createButton("next"), this.$container.appendChild(this.$next)), this.$prev || (this.$prev = this.createButton("prev"), this.$container.appendChild(this.$prev))
    }
    onRefresh() {
        const t = this.carousel.pages.length;
        t <= 1 || t > 1 && this.carousel.elemDimWidth < this.carousel.wrapDimWidth && !Number.isInteger(this.carousel.option("slidesPerPage")) ? this.cleanup() : (this.build(), this.$prev.removeAttribute("disabled"), this.$next.removeAttribute("disabled"), this.carousel.option("infiniteX", this.carousel.option("infinite")) || (this.carousel.page <= 0 && this.$prev.setAttribute("disabled", ""), this.carousel.page >= t - 1 && this.$next.setAttribute("disabled", "")))
    }
    cleanup() {
        this.$prev && this.$prev.remove(), this.$prev = null, this.$next && this.$next.remove(), this.$next = null, this.$container && this.$container.remove(), this.$container = null
    }
    attach() {
        this.carousel.on("refresh change", this.onRefresh)
    }
    detach() {
        this.carousel.off("refresh change", this.onRefresh), this.cleanup()
    }
}
f.defaults = {
    prevTpl: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" tabindex="-1"><path d="M15 3l-9 9 9 9"/></svg>',
    nextTpl: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" tabindex="-1"><path d="M9 3l9 9-9 9"/></svg>',
    classNames: {
        main: "carousel__nav",
        button: "carousel__button",
        next: "is-next",
        prev: "is-prev"
    }
};
class g {
    constructor(t) {
        this.carousel = t, this.selectedIndex = null, this.friction = 0, this.onNavReady = this.onNavReady.bind(this), this.onNavClick = this.onNavClick.bind(this), this.onNavCreateSlide = this.onNavCreateSlide.bind(this), this.onTargetChange = this.onTargetChange.bind(this)
    }
    addAsTargetFor(t) {
        this.target = this.carousel, this.nav = t, this.attachEvents()
    }
    addAsNavFor(t) {
        this.target = t, this.nav = this.carousel, this.attachEvents()
    }
    attachEvents() {
        this.nav.options.initialSlide = this.target.options.initialPage, this.nav.on("ready", this.onNavReady), this.nav.on("createSlide", this.onNavCreateSlide), this.nav.on("Panzoom.click", this.onNavClick), this.target.on("change", this.onTargetChange), this.target.on("Panzoom.afterUpdate", this.onTargetChange)
    }
    onNavReady() {
        this.onTargetChange(!0)
    }
    onNavClick(t, e, i) {
        const s = i.target.closest(".carousel__slide");
        if (!s) return;
        i.stopPropagation();
        const o = parseInt(s.dataset.index, 10),
            n = this.target.findPageForSlide(o);
        this.target.page !== n && this.target.slideTo(n, {
            friction: this.friction
        }), this.markSelectedSlide(o)
    }
    onNavCreateSlide(t, e) {
        e.index === this.selectedIndex && this.markSelectedSlide(e.index)
    }
    onTargetChange() {
        const t = this.target.pages[this.target.page].indexes[0],
            e = this.nav.findPageForSlide(t);
        this.nav.slideTo(e), this.markSelectedSlide(t)
    }
    markSelectedSlide(t) {
        this.selectedIndex = t, [...this.nav.slides].filter((t => t.$el && t.$el.classList.remove("is-nav-selected")));
        const e = this.nav.slides[t];
        e && e.$el && e.$el.classList.add("is-nav-selected")
    }
    attach(t) {
        const e = t.options.Sync;
        (e.target || e.nav) && (e.target ? this.addAsNavFor(e.target) : e.nav && this.addAsTargetFor(e.nav), this.friction = e.friction)
    }
    detach() {
        this.nav && (this.nav.off("ready", this.onNavReady), this.nav.off("Panzoom.click", this.onNavClick), this.nav.off("createSlide", this.onNavCreateSlide)), this.target && (this.target.off("Panzoom.afterUpdate", this.onTargetChange), this.target.off("change", this.onTargetChange))
    }
}
g.defaults = {
    friction: .92
};
const p = {
    Navigation: f,
    Dots: class {
        constructor(t) {
            this.carousel = t, this.$list = null, this.events = {
                change: this.onChange.bind(this),
                refresh: this.onRefresh.bind(this)
            }
        }
        buildList() {
            if (this.carousel.pages.length < this.carousel.option("Dots.minSlideCount")) return;
            const t = document.createElement("ol");
            return t.classList.add("carousel__dots"), t.addEventListener("click", (t => {
                if (!("page" in t.target.dataset)) return;
                t.preventDefault(), t.stopPropagation();
                const e = parseInt(t.target.dataset.page, 10),
                    i = this.carousel;
                e !== i.page && (i.pages.length < 3 && i.option("infinite") ? i[0 == e ? "slidePrev" : "slideNext"]() : i.slideTo(e))
            })), this.$list = t, this.carousel.$container.appendChild(t), this.carousel.$container.classList.add("has-dots"), t
        }
        removeList() {
            this.$list && (this.$list.parentNode.removeChild(this.$list), this.$list = null), this.carousel.$container.classList.remove("has-dots")
        }
        rebuildDots() {
            let t = this.$list;
            const e = !!t,
                i = this.carousel.pages.length;
            if (i < 2) return void(e && this.removeList());
            e || (t = this.buildList());
            const s = this.$list.children.length;
            if (s > i)
                for (let t = i; t < s; t++) this.$list.removeChild(this.$list.lastChild);
            else {
                for (let t = s; t < i; t++) {
                    const e = document.createElement("li");
                    e.classList.add("carousel__dot"), e.dataset.page = t, e.setAttribute("role", "button"), e.setAttribute("tabindex", "0"), e.setAttribute("title", this.carousel.localize("{{GOTO}}", [
                        ["%d", t + 1]
                    ])), e.addEventListener("keydown", (t => {
                        const i = t.code;
                        let s;
                        "Enter" === i || "NumpadEnter" === i ? s = e : "ArrowRight" === i ? s = e.nextSibling : "ArrowLeft" === i && (s = e.previousSibling), s && s.click()
                    })), this.$list.appendChild(e)
                }
                this.setActiveDot()
            }
        }
        setActiveDot() {
            if (!this.$list) return;
            this.$list.childNodes.forEach((t => {
                t.classList.remove("is-selected")
            }));
            const t = this.$list.childNodes[this.carousel.page];
            t && t.classList.add("is-selected")
        }
        onChange() {
            this.setActiveDot()
        }
        onRefresh() {
            this.rebuildDots()
        }
        attach() {
            this.carousel.on(this.events)
        }
        detach() {
            this.removeList(), this.carousel.off(this.events), this.carousel = null
        }
    },
    Sync: g
};
const m = {
    slides: [],
    preload: 0,
    slidesPerPage: "auto",
    initialPage: null,
    initialSlide: null,
    friction: .92,
    center: !0,
    infinite: !0,
    fill: !0,
    dragFree: !1,
    prefix: "",
    classNames: {
        viewport: "carousel__viewport",
        track: "carousel__track",
        slide: "carousel__slide",
        slideSelected: "is-selected"
    },
    l10n: {
        NEXT: "Next slide",
        PREV: "Previous slide",
        GOTO: "Go to slide #%d"
    }
};
class y extends l {
    constructor(t, i = {}) {
        if (super(i = e(!0, {}, m, i)), this.state = "init", this.$container = t, !(this.$container instanceof HTMLElement)) throw new Error("No root element provided");
        this.slideNext = u(this.slideNext.bind(this), 250), this.slidePrev = u(this.slidePrev.bind(this), 250), this.init(), t.__Carousel = this
    }
    init() {
        this.pages = [], this.page = this.pageIndex = null, this.prevPage = this.prevPageIndex = null, this.attachPlugins(y.Plugins), this.trigger("init"), this.initLayout(), this.initSlides(), this.updateMetrics(), this.$track && this.pages.length && (this.$track.style.transform = `translate3d(${-1*this.pages[this.page].left}px, 0px, 0) scale(1)`), this.manageSlideVisiblity(), this.initPanzoom(), this.state = "ready", this.trigger("ready")
    }
    initLayout() {
        const t = this.option("prefix"),
            e = this.option("classNames");
        this.$viewport = this.option("viewport") || this.$container.querySelector(`.${t}${e.viewport}`), this.$viewport || (this.$viewport = document.createElement("div"), this.$viewport.classList.add(...(t + e.viewport).split(" ")), this.$viewport.append(...this.$container.childNodes), this.$container.appendChild(this.$viewport)), this.$track = this.option("track") || this.$container.querySelector(`.${t}${e.track}`), this.$track || (this.$track = document.createElement("div"), this.$track.classList.add(...(t + e.track).split(" ")), this.$track.append(...this.$viewport.childNodes), this.$viewport.appendChild(this.$track))
    }
    initSlides() {
        this.slides = [];
        this.$viewport.querySelectorAll(`.${this.option("prefix")}${this.option("classNames.slide")}`).forEach((t => {
            const e = {
                $el: t,
                isDom: !0
            };
            this.slides.push(e), this.trigger("createSlide", e, this.slides.length)
        })), Array.isArray(this.options.slides) && (this.slides = e(!0, [...this.slides], this.options.slides))
    }
    updateMetrics() {
        let t, e = 0,
            s = [];
        this.slides.forEach(((i, o) => {
            const n = i.$el,
                a = i.isDom || !t ? this.getSlideMetrics(n) : t;
            i.index = o, i.width = a, i.left = e, t = a, e += a, s.push(o)
        }));
        let o = Math.max(this.$track.offsetWidth, i(this.$track.getBoundingClientRect().width)),
            n = getComputedStyle(this.$track);
        o -= parseFloat(n.paddingLeft) + parseFloat(n.paddingRight), this.contentWidth = e, this.viewportWidth = o;
        const a = [],
            r = this.option("slidesPerPage");
        if (Number.isInteger(r) && e > o)
            for (let t = 0; t < this.slides.length; t += r) a.push({
                indexes: s.slice(t, t + r),
                slides: this.slides.slice(t, t + r)
            });
        else {
            let t = 0,
                e = 0;
            for (let i = 0; i < this.slides.length; i += 1) {
                let s = this.slides[i];
                (!a.length || e + s.width > o) && (a.push({
                    indexes: [],
                    slides: []
                }), t = a.length - 1, e = 0), e += s.width, a[t].indexes.push(i), a[t].slides.push(s)
            }
        }
        const h = this.option("center"),
            l = this.option("fill");
        a.forEach(((t, i) => {
            t.index = i, t.width = t.slides.reduce(((t, e) => t + e.width), 0), t.left = t.slides[0].left, h && (t.left += .5 * (o - t.width) * -1), l && !this.option("infiniteX", this.option("infinite")) && e > o && (t.left = Math.max(t.left, 0), t.left = Math.min(t.left, e - o))
        }));
        const c = [];
        let d;
        a.forEach((t => {
            const e = {
                ...t
            };
            d && e.left === d.left ? (d.width += e.width, d.slides = [...d.slides, ...e.slides], d.indexes = [...d.indexes, ...e.indexes]) : (e.index = c.length, d = e, c.push(e))
        })), this.pages = c;
        let u = this.page;
        if (null === u) {
            const t = this.option("initialSlide");
            u = null !== t ? this.findPageForSlide(t) : parseInt(this.option("initialPage", 0), 10) || 0, c[u] || (u = c.length && u > c.length ? c[c.length - 1].index : 0), this.page = u, this.pageIndex = u
        }
        this.updatePanzoom(), this.trigger("refresh")
    }
    getSlideMetrics(t) {
        if (!t) {
            const e = this.slides[0];
            (t = document.createElement("div")).dataset.isTestEl = 1, t.style.visibility = "hidden", t.classList.add(...(this.option("prefix") + this.option("classNames.slide")).split(" ")), e.customClass && t.classList.add(...e.customClass.split(" ")), this.$track.prepend(t)
        }
        let e = Math.max(t.offsetWidth, i(t.getBoundingClientRect().width));
        const s = t.currentStyle || window.getComputedStyle(t);
        return e = e + (parseFloat(s.marginLeft) || 0) + (parseFloat(s.marginRight) || 0), t.dataset.isTestEl && t.remove(), e
    }
    findPageForSlide(t) {
        t = parseInt(t, 10) || 0;
        const e = this.pages.find((e => e.indexes.indexOf(t) > -1));
        return e ? e.index : null
    }
    slideNext() {
        this.slideTo(this.pageIndex + 1)
    }
    slidePrev() {
        this.slideTo(this.pageIndex - 1)
    }
    slideTo(t, e = {}) {
        const {
            x: i = -1 * this.setPage(t, !0),
            y: s = 0,
            friction: o = this.option("friction")
        } = e;
        this.Panzoom.content.x === i && !this.Panzoom.velocity.x && o || (this.Panzoom.panTo({
            x: i,
            y: s,
            friction: o,
            ignoreBounds: !0
        }), "ready" === this.state && "ready" === this.Panzoom.state && this.trigger("settle"))
    }
    initPanzoom() {
        this.Panzoom && this.Panzoom.destroy();
        const t = e(!0, {}, {
            content: this.$track,
            wrapInner: !1,
            resizeParent: !1,
            zoom: !1,
            click: !1,
            lockAxis: "x",
            x: this.pages.length ? -1 * this.pages[this.page].left : 0,
            centerOnStart: !1,
            textSelection: () => this.option("textSelection", !1),
            panOnlyZoomed: function () {
                return this.content.width <= this.viewport.width
            }
        }, this.option("Panzoom"));
        this.Panzoom = new d(this.$container, t), this.Panzoom.on({
            "*": (t, ...e) => this.trigger(`Panzoom.${t}`, ...e),
            afterUpdate: () => {
                this.updatePage()
            },
            beforeTransform: this.onBeforeTransform.bind(this),
            touchEnd: this.onTouchEnd.bind(this),
            endAnimation: () => {
                this.trigger("settle")
            }
        }), this.updateMetrics(), this.manageSlideVisiblity()
    }
    updatePanzoom() {
        this.Panzoom && (this.Panzoom.content = {
            ...this.Panzoom.content,
            fitWidth: this.contentWidth,
            origWidth: this.contentWidth,
            width: this.contentWidth
        }, this.pages.length > 1 && this.option("infiniteX", this.option("infinite")) ? this.Panzoom.boundX = null : this.pages.length && (this.Panzoom.boundX = {
            from: -1 * this.pages[this.pages.length - 1].left,
            to: -1 * this.pages[0].left
        }), this.option("infiniteY", this.option("infinite")) ? this.Panzoom.boundY = null : this.Panzoom.boundY = {
            from: 0,
            to: 0
        }, this.Panzoom.handleCursor())
    }
    manageSlideVisiblity() {
        const t = this.contentWidth,
            e = this.viewportWidth;
        let i = this.Panzoom ? -1 * this.Panzoom.content.x : this.pages.length ? this.pages[this.page].left : 0;
        const s = this.option("preload"),
            o = this.option("infiniteX", this.option("infinite")),
            n = parseFloat(getComputedStyle(this.$viewport, null).getPropertyValue("padding-left")),
            a = parseFloat(getComputedStyle(this.$viewport, null).getPropertyValue("padding-right"));
        this.slides.forEach((r => {
            let h, l, c = 0;
            h = i - n, l = i + e + a, h -= s * (e + n + a), l += s * (e + n + a);
            const d = r.left + r.width > h && r.left < l;
            h = i + t - n, l = i + t + e + a, h -= s * (e + n + a);
            const u = o && r.left + r.width > h && r.left < l;
            h = i - t - n, l = i - t + e + a, h -= s * (e + n + a);
            const f = o && r.left + r.width > h && r.left < l;
            u || d || f ? (this.createSlideEl(r), d && (c = 0), u && (c = -1), f && (c = 1), r.left + r.width > i && r.left <= i + e + a && (c = 0)) : this.removeSlideEl(r), r.hasDiff = c
        }));
        let r = 0,
            h = 0;
        this.slides.forEach(((e, i) => {
            let s = 0;
            e.$el ? (i !== r || e.hasDiff ? s = h + e.hasDiff * t : h = 0, e.$el.style.left = Math.abs(s) > .1 ? `${h+e.hasDiff*t}px` : "", r++) : h += e.width
        })), this.markSelectedSlides()
    }
    createSlideEl(t) {
        if (!t) return;
        if (t.$el) {
            let e = t.$el.dataset.index;
            if (!e || parseInt(e, 10) !== t.index) {
                let e;
                t.$el.dataset.index = t.index, t.$el.querySelectorAll("[data-lazy-srcset]").forEach((t => {
                    t.srcset = t.dataset.lazySrcset
                })), t.$el.querySelectorAll("[data-lazy-src]").forEach((t => {
                    let e = t.dataset.lazySrc;
                    t instanceof HTMLImageElement ? t.src = e : t.style.backgroundImage = `url('${e}')`
                })), (e = t.$el.dataset.lazySrc) && (t.$el.style.backgroundImage = `url('${e}')`), t.state = "ready"
            }
            return
        }
        const e = document.createElement("div");
        e.dataset.index = t.index, e.classList.add(...(this.option("prefix") + this.option("classNames.slide")).split(" ")), t.customClass && e.classList.add(...t.customClass.split(" ")), t.html && (e.innerHTML = t.html);
        const i = [];
        this.slides.forEach(((t, e) => {
            t.$el && i.push(e)
        }));
        const s = t.index;
        let o = null;
        if (i.length) {
            let t = i.reduce(((t, e) => Math.abs(e - s) < Math.abs(t - s) ? e : t));
            o = this.slides[t]
        }
        return this.$track.insertBefore(e, o && o.$el ? o.index < t.index ? o.$el.nextSibling : o.$el : null), t.$el = e, this.trigger("createSlide", t, s), t
    }
    removeSlideEl(t) {
        t.$el && !t.isDom && (this.trigger("removeSlide", t), t.$el.remove(), t.$el = null)
    }
    markSelectedSlides() {
        const t = this.option("classNames.slideSelected"),
            e = "aria-hidden";
        this.slides.forEach(((i, s) => {
            const o = i.$el;
            if (!o) return;
            const n = this.pages[this.page];
            n && n.indexes && n.indexes.indexOf(s) > -1 ? (t && !o.classList.contains(t) && (o.classList.add(t), this.trigger("selectSlide", i)), o.removeAttribute(e)) : (t && o.classList.contains(t) && (o.classList.remove(t), this.trigger("unselectSlide", i)), o.setAttribute(e, !0))
        }))
    }
    updatePage() {
        this.updateMetrics(), this.slideTo(this.page, {
            friction: 0
        })
    }
    onBeforeTransform() {
        this.option("infiniteX", this.option("infinite")) && this.manageInfiniteTrack(), this.manageSlideVisiblity()
    }
    manageInfiniteTrack() {
        const t = this.contentWidth,
            e = this.viewportWidth;
        if (!this.option("infiniteX", this.option("infinite")) || this.pages.length < 2 || t < e) return;
        const i = this.Panzoom;
        let s = !1;
        return i.content.x < -1 * (t - e) && (i.content.x += t, this.pageIndex = this.pageIndex - this.pages.length, s = !0), i.content.x > e && (i.content.x -= t, this.pageIndex = this.pageIndex + this.pages.length, s = !0), s && "pointerdown" === i.state && i.resetDragPosition(), s
    }
    onTouchEnd(t, e) {
        const i = this.option("dragFree");
        if (!i && this.pages.length > 1 && t.dragOffset.time < 350 && Math.abs(t.dragOffset.y) < 1 && Math.abs(t.dragOffset.x) > 5) this[t.dragOffset.x < 0 ? "slideNext" : "slidePrev"]();
        else if (i) {
            const [, e] = this.getPageFromPosition(-1 * t.transform.x);
            this.setPage(e)
        } else this.slideToClosest()
    }
    slideToClosest(t = {}) {
        let [, e] = this.getPageFromPosition(-1 * this.Panzoom.content.x);
        this.slideTo(e, t)
    }
    getPageFromPosition(t) {
        const e = this.pages.length;
        this.option("center") && (t += .5 * this.viewportWidth);
        const i = Math.floor(t / this.contentWidth);
        t -= i * this.contentWidth;
        let s = this.slides.find((e => e.left <= t && e.left + e.width > t));
        if (s) {
            let t = this.findPageForSlide(s.index);
            return [t, t + i * e]
        }
        return [0, 0]
    }
    setPage(t, e) {
        let i = 0,
            s = parseInt(t, 10) || 0;
        const o = this.page,
            n = this.pageIndex,
            a = this.pages.length,
            r = this.contentWidth,
            h = this.viewportWidth;
        if (t = (s % a + a) % a, this.option("infiniteX", this.option("infinite")) && r > h) {
            const o = Math.floor(s / a) || 0,
                n = r;
            if (i = this.pages[t].left + o * n, !0 === e && a > 2) {
                let t = -1 * this.Panzoom.content.x;
                const e = i - n,
                    o = i + n,
                    r = Math.abs(t - i),
                    h = Math.abs(t - e),
                    l = Math.abs(t - o);
                l < r && l <= h ? (i = o, s += a) : h < r && h < l && (i = e, s -= a)
            }
        } else t = s = Math.max(0, Math.min(s, a - 1)), i = this.pages.length ? this.pages[t].left : 0;
        return this.page = t, this.pageIndex = s, null !== o && t !== o && (this.prevPage = o, this.prevPageIndex = n, this.trigger("change", t, o)), i
    }
    destroy() {
        this.state = "destroy", this.slides.forEach((t => {
            this.removeSlideEl(t)
        })), this.slides = [], this.Panzoom.destroy(), this.detachPlugins()
    }
}
y.version = "4.0.27", y.Plugins = p;
const v = !("undefined" == typeof window || !window.document || !window.document.createElement);
let b = null;
const x = ["a[href]", "area[href]", 'input:not([disabled]):not([type="hidden"]):not([aria-hidden])', "select:not([disabled]):not([aria-hidden])", "textarea:not([disabled]):not([aria-hidden])", "button:not([disabled]):not([aria-hidden])", "iframe", "object", "embed", "video", "audio", "[contenteditable]", '[tabindex]:not([tabindex^="-"]):not([disabled]):not([aria-hidden])'],
    w = t => {
        if (t && v) {
            null === b && document.createElement("div").focus({
                get preventScroll() {
                    return b = !0, !1
                }
            });
            try {
                if (t.setActive) t.setActive();
                else if (b) t.focus({
                    preventScroll: !0
                });
                else {
                    const e = window.pageXOffset || document.body.scrollTop,
                        i = window.pageYOffset || document.body.scrollLeft;
                    t.focus(), document.body.scrollTo({
                        top: e,
                        left: i,
                        behavior: "auto"
                    })
                }
            } catch (t) {}
        }
    };
class $ {
    constructor(t) {
        this.fancybox = t, this.$container = null, this.state = "init";
        for (const t of ["onPrepare", "onClosing", "onKeydown"]) this[t] = this[t].bind(this);
        this.events = {
            prepare: this.onPrepare,
            closing: this.onClosing,
            keydown: this.onKeydown
        }
    }
    onPrepare() {
        this.getSlides().length < this.fancybox.option("Thumbs.minSlideCount") ? this.state = "disabled" : !0 === this.fancybox.option("Thumbs.autoStart") && this.fancybox.Carousel.Panzoom.content.height >= this.fancybox.option("Thumbs.minScreenHeight") && this.build()
    }
    onClosing() {
        this.Carousel && this.Carousel.Panzoom.detachEvents()
    }
    onKeydown(t, e) {
        e === t.option("Thumbs.key") && this.toggle()
    }
    build() {
        if (this.$container) return;
        const t = document.createElement("div");
        t.classList.add("fancybox__thumbs"), this.fancybox.$carousel.parentNode.insertBefore(t, this.fancybox.$carousel.nextSibling), this.Carousel = new y(t, e(!0, {
            Dots: !1,
            Navigation: !1,
            Sync: {
                friction: 0
            },
            infinite: !1,
            center: !0,
            fill: !0,
            dragFree: !0,
            slidesPerPage: 1,
            preload: 1
        }, this.fancybox.option("Thumbs.Carousel"), {
            Sync: {
                target: this.fancybox.Carousel
            },
            slides: this.getSlides()
        })), this.Carousel.Panzoom.on("wheel", ((t, e) => {
            e.preventDefault(), this.fancybox[e.deltaY < 0 ? "prev" : "next"]()
        })), this.$container = t, this.state = "visible"
    }
    getSlides() {
        const t = [];
        for (const e of this.fancybox.items) {
            const i = e.thumb;
            i && t.push({
                html: `<div class="fancybox__thumb" style="background-image:url('${i}')"></div>`,
                customClass: `has-thumb has-${e.type||"image"}`
            })
        }
        return t
    }
    toggle() {
        "visible" === this.state ? this.hide() : "hidden" === this.state ? this.show() : this.build()
    }
    show() {
        "hidden" === this.state && (this.$container.style.display = "", this.Carousel.Panzoom.attachEvents(), this.state = "visible")
    }
    hide() {
        "visible" === this.state && (this.Carousel.Panzoom.detachEvents(), this.$container.style.display = "none", this.state = "hidden")
    }
    cleanup() {
        this.Carousel && (this.Carousel.destroy(), this.Carousel = null), this.$container && (this.$container.remove(), this.$container = null), this.state = "init"
    }
    attach() {
        this.fancybox.on(this.events)
    }
    detach() {
        this.fancybox.off(this.events), this.cleanup()
    }
}
$.defaults = {
    minSlideCount: 2,
    minScreenHeight: 500,
    autoStart: !0,
    key: "t",
    Carousel: {}
};
const C = (t, e) => {
        const i = new URL(t),
            s = new URLSearchParams(i.search);
        let o = new URLSearchParams;
        for (const [t, i] of [...s, ...Object.entries(e)]) "t" === t ? o.set("start", parseInt(i)) : o.set(t, i);
        o = o.toString();
        let n = t.match(/#t=((.*)?\d+s)/);
        return n && (o += `#t=${n[1]}`), o
    },
    S = {
        video: {
            autoplay: !0,
            ratio: 16 / 9
        },
        youtube: {
            autohide: 1,
            fs: 1,
            rel: 0,
            hd: 1,
            wmode: "transparent",
            enablejsapi: 1,
            html5: 1
        },
        vimeo: {
            hd: 1,
            show_title: 1,
            show_byline: 1,
            show_portrait: 0,
            fullscreen: 1
        },
        html5video: {
            tpl: '<video class="fancybox__html5video" playsinline controls controlsList="nodownload" poster="{{poster}}">\n  <source src="{{src}}" type="{{format}}" />Sorry, your browser doesn\'t support embedded videos.</video>',
            format: ""
        }
    };
class E {
    constructor(t) {
        this.fancybox = t;
        for (const t of ["onInit", "onReady", "onCreateSlide", "onRemoveSlide", "onSelectSlide", "onUnselectSlide", "onRefresh", "onMessage"]) this[t] = this[t].bind(this);
        this.events = {
            init: this.onInit,
            ready: this.onReady,
            "Carousel.createSlide": this.onCreateSlide,
            "Carousel.removeSlide": this.onRemoveSlide,
            "Carousel.selectSlide": this.onSelectSlide,
            "Carousel.unselectSlide": this.onUnselectSlide,
            "Carousel.refresh": this.onRefresh
        }
    }
    onInit() {
        for (const t of this.fancybox.items) this.processType(t)
    }
    processType(t) {
        if (t.html) return t.src = t.html, t.type = "html", void delete t.html;
        const i = t.src || "";
        let s = t.type || this.fancybox.options.type,
            o = null;
        if (!i || "string" == typeof i) {
            if (o = i.match(/(?:youtube\.com|youtu\.be|youtube\-nocookie\.com)\/(?:watch\?(?:.*&)?v=|v\/|u\/|embed\/?)?(videoseries\?list=(?:.*)|[\w-]{11}|\?listType=(?:.*)&list=(?:.*))(?:.*)/i)) {
                const e = C(i, this.fancybox.option("Html.youtube")),
                    n = encodeURIComponent(o[1]);
                t.videoId = n, t.src = `https://www.youtube-nocookie.com/embed/${n}?${e}`, t.thumb = t.thumb || `https://i.ytimg.com/vi/${n}/mqdefault.jpg`, t.vendor = "youtube", s = "video"
            } else if (o = i.match(/^.+vimeo.com\/(?:\/)?([\d]+)(.*)?/)) {
                const e = C(i, this.fancybox.option("Html.vimeo")),
                    n = encodeURIComponent(o[1]);
                t.videoId = n, t.src = `https://player.vimeo.com/video/${n}?${e}`, t.vendor = "vimeo", s = "video"
            } else(o = i.match(/(?:maps\.)?google\.([a-z]{2,3}(?:\.[a-z]{2})?)\/(?:(?:(?:maps\/(?:place\/(?:.*)\/)?\@(.*),(\d+.?\d+?)z))|(?:\?ll=))(.*)?/i)) ? (t.src = `//maps.google.${o[1]}/?ll=${(o[2]?o[2]+"&z="+Math.floor(o[3])+(o[4]?o[4].replace(/^\//,"&"):""):o[4]+"").replace(/\?/,"&")}&output=${o[4]&&o[4].indexOf("layer=c")>0?"svembed":"embed"}`, s = "map") : (o = i.match(/(?:maps\.)?google\.([a-z]{2,3}(?:\.[a-z]{2})?)\/(?:maps\/search\/)(.*)/i)) && (t.src = `//maps.google.${o[1]}/maps?q=${o[2].replace("query=","q=").replace("api=1","")}&output=embed`, s = "map");
            s || ("#" === i.charAt(0) ? s = "inline" : (o = i.match(/\.(mp4|mov|ogv|webm)((\?|#).*)?$/i)) ? (s = "html5video", t.format = t.format || "video/" + ("ogv" === o[1] ? "ogg" : o[1])) : i.match(/(^data:image\/[a-z0-9+\/=]*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg|ico)((\?|#).*)?$)/i) ? s = "image" : i.match(/\.(pdf)((\?|#).*)?$/i) && (s = "pdf")), t.type = s || this.fancybox.option("defaultType", "image"), "html5video" !== s && "video" !== s || (t.video = e({}, this.fancybox.option("Html.video"), t.video), t._width && t._height ? t.ratio = parseFloat(t._width) / parseFloat(t._height) : t.ratio = t.ratio || t.video.ratio || S.video.ratio)
        }
    }
    onReady() {
        this.fancybox.Carousel.slides.forEach((t => {
            t.$el && (this.setContent(t), t.index === this.fancybox.getSlide().index && this.playVideo(t))
        }))
    }
    onCreateSlide(t, e, i) {
        "ready" === this.fancybox.state && this.setContent(i)
    }
    loadInlineContent(t) {
        let e;
        if (t.src instanceof HTMLElement) e = t.src;
        else if ("string" == typeof t.src) {
            const i = t.src.split("#", 2),
                s = 2 === i.length && "" === i[0] ? i[1] : i[0];
            e = document.getElementById(s)
        }
        if (e) {
            if ("clone" === t.type || e.$placeHolder) {
                e = e.cloneNode(!0);
                let i = e.getAttribute("id");
                i = i ? `${i}--clone` : `clone-${this.fancybox.id}-${t.index}`, e.setAttribute("id", i)
            } else {
                const t = document.createElement("div");
                t.classList.add("fancybox-placeholder"), e.parentNode.insertBefore(t, e), e.$placeHolder = t
            }
            this.fancybox.setContent(t, e)
        } else this.fancybox.setError(t, "{{ELEMENT_NOT_FOUND}}")
    }
    loadAjaxContent(t) {
        const e = this.fancybox,
            i = new XMLHttpRequest;
        e.showLoading(t), i.onreadystatechange = function () {
            i.readyState === XMLHttpRequest.DONE && "ready" === e.state && (e.hideLoading(t), 200 === i.status ? e.setContent(t, i.responseText) : e.setError(t, 404 === i.status ? "{{AJAX_NOT_FOUND}}" : "{{AJAX_FORBIDDEN}}"))
        };
        const s = t.ajax || null;
        i.open(s ? "POST" : "GET", t.src), i.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), i.setRequestHeader("X-Requested-With", "XMLHttpRequest"), i.send(s), t.xhr = i
    }
    loadIframeContent(t) {
        const e = this.fancybox,
            i = document.createElement("iframe");
        if (i.className = "fancybox__iframe", i.setAttribute("id", `fancybox__iframe_${e.id}_${t.index}`), i.setAttribute("allow", "autoplay; fullscreen"), i.setAttribute("scrolling", "auto"), t.$iframe = i, "iframe" !== t.type || !1 === t.preload) return i.setAttribute("src", t.src), this.fancybox.setContent(t, i), void this.resizeIframe(t);
        e.showLoading(t);
        const s = document.createElement("div");
        s.style.visibility = "hidden", this.fancybox.setContent(t, s), s.appendChild(i), i.onerror = () => {
            e.setError(t, "{{IFRAME_ERROR}}")
        }, i.onload = () => {
            e.hideLoading(t);
            let s = !1;
            i.isReady || (i.isReady = !0, s = !0), i.src.length && (i.parentNode.style.visibility = "", this.resizeIframe(t), s && e.revealContent(t))
        }, i.setAttribute("src", t.src)
    }
    setAspectRatio(t) {
        const e = t.$content,
            i = t.ratio;
        if (!e) return;
        let s = t._width,
            o = t._height;
        if (i || s && o) {
            Object.assign(e.style, {
                width: s && o ? "100%" : "",
                height: s && o ? "100%" : "",
                maxWidth: "",
                maxHeight: ""
            });
            let t = e.offsetWidth,
                n = e.offsetHeight;
            if (s = s || t, o = o || n, s > t || o > n) {
                let e = Math.min(t / s, n / o);
                s *= e, o *= e
            }
            Math.abs(s / o - i) > .01 && (i < s / o ? s = o * i : o = s / i), Object.assign(e.style, {
                width: `${s}px`,
                height: `${o}px`
            })
        }
    }
    resizeIframe(t) {
        const e = t.$iframe;
        if (!e) return;
        let i = t._width || 0,
            s = t._height || 0;
        i && s && (t.autoSize = !1);
        const o = e.parentNode,
            n = o && o.style;
        if (!1 !== t.preload && !1 !== t.autoSize && n) try {
            const t = window.getComputedStyle(o),
                a = parseFloat(t.paddingLeft) + parseFloat(t.paddingRight),
                r = parseFloat(t.paddingTop) + parseFloat(t.paddingBottom),
                h = e.contentWindow.document,
                l = h.getElementsByTagName("html")[0],
                c = h.body;
            n.width = "", c.style.overflow = "hidden", i = i || l.scrollWidth + a, n.width = `${i}px`, c.style.overflow = "", n.flex = "0 0 auto", n.height = `${c.scrollHeight}px`, s = l.scrollHeight + r
        } catch (t) {}
        if (i || s) {
            const t = {
                flex: "0 1 auto"
            };
            i && (t.width = `${i}px`), s && (t.height = `${s}px`), Object.assign(n, t)
        }
    }
    onRefresh(t, e) {
        e.slides.forEach((t => {
            t.$el && (t.$iframe && this.resizeIframe(t), t.ratio && this.setAspectRatio(t))
        }))
    }
    setContent(t) {
        if (t && !t.isDom) {
            switch (t.type) {
                case "html":
                    this.fancybox.setContent(t, t.src);
                    break;
                case "html5video":
                    this.fancybox.setContent(t, this.fancybox.option("Html.html5video.tpl").replace(/\{\{src\}\}/gi, t.src).replace("{{format}}", t.format || t.html5video && t.html5video.format || "").replace("{{poster}}", t.poster || t.thumb || ""));
                    break;
                case "inline":
                case "clone":
                    this.loadInlineContent(t);
                    break;
                case "ajax":
                    this.loadAjaxContent(t);
                    break;
                case "pdf":
                case "video":
                case "map":
                    t.preload = !1;
                case "iframe":
                    this.loadIframeContent(t)
            }
            t.ratio && this.setAspectRatio(t)
        }
    }
    onSelectSlide(t, e, i) {
        "ready" === t.state && this.playVideo(i)
    }
    playVideo(t) {
        if ("html5video" === t.type && t.video.autoplay) try {
            const e = t.$el.querySelector("video");
            if (e) {
                const t = e.play();
                void 0 !== t && t.then((() => {})).catch((t => {
                    e.muted = !0, e.play()
                }))
            }
        } catch (t) {}
        if ("video" !== t.type || !t.$iframe || !t.$iframe.contentWindow) return;
        const e = () => {
            if ("done" === t.state && t.$iframe && t.$iframe.contentWindow) {
                let e;
                if (t.$iframe.isReady) return t.video && t.video.autoplay && (e = "youtube" == t.vendor ? {
                    event: "command",
                    func: "playVideo"
                } : {
                    method: "play",
                    value: "true"
                }), void(e && t.$iframe.contentWindow.postMessage(JSON.stringify(e), "*"));
                "youtube" === t.vendor && (e = {
                    event: "listening",
                    id: t.$iframe.getAttribute("id")
                }, t.$iframe.contentWindow.postMessage(JSON.stringify(e), "*"))
            }
            t.poller = setTimeout(e, 250)
        };
        e()
    }
    onUnselectSlide(t, e, i) {
        if ("html5video" === i.type) {
            try {
                i.$el.querySelector("video").pause()
            } catch (t) {}
            return
        }
        let s = !1;
        "vimeo" == i.vendor ? s = {
            method: "pause",
            value: "true"
        } : "youtube" === i.vendor && (s = {
            event: "command",
            func: "pauseVideo"
        }), s && i.$iframe && i.$iframe.contentWindow && i.$iframe.contentWindow.postMessage(JSON.stringify(s), "*"), clearTimeout(i.poller)
    }
    onRemoveSlide(t, e, i) {
        i.xhr && (i.xhr.abort(), i.xhr = null), i.$iframe && (i.$iframe.onload = i.$iframe.onerror = null, i.$iframe.src = "//about:blank", i.$iframe = null);
        const s = i.$content;
        "inline" === i.type && s && (s.classList.remove("fancybox__content"), "none" !== s.style.display && (s.style.display = "none")), i.$closeButton && (i.$closeButton.remove(), i.$closeButton = null);
        const o = s && s.$placeHolder;
        o && (o.parentNode.insertBefore(s, o), o.remove(), s.$placeHolder = null)
    }
    onMessage(t) {
        try {
            let e = JSON.parse(t.data);
            if ("https://player.vimeo.com" === t.origin) {
                if ("ready" === e.event)
                    for (let e of document.getElementsByClassName("fancybox__iframe")) e.contentWindow === t.source && (e.isReady = 1)
            } else "https://www.youtube-nocookie.com" === t.origin && "onReady" === e.event && (document.getElementById(e.id).isReady = 1)
        } catch (t) {}
    }
    attach() {
        this.fancybox.on(this.events), window.addEventListener("message", this.onMessage, !1)
    }
    detach() {
        this.fancybox.off(this.events), window.removeEventListener("message", this.onMessage, !1)
    }
}
E.defaults = S;
class P {
    constructor(t) {
        this.fancybox = t;
        for (const t of ["onReady", "onClosing", "onDone", "onPageChange", "onCreateSlide", "onRemoveSlide", "onImageStatusChange"]) this[t] = this[t].bind(this);
        this.events = {
            ready: this.onReady,
            closing: this.onClosing,
            done: this.onDone,
            "Carousel.change": this.onPageChange,
            "Carousel.createSlide": this.onCreateSlide,
            "Carousel.removeSlide": this.onRemoveSlide
        }
    }
    onReady() {
        this.fancybox.Carousel.slides.forEach((t => {
            t.$el && this.setContent(t)
        }))
    }
    onDone(t, e) {
        this.handleCursor(e)
    }
    onClosing(t) {
        clearTimeout(this.clickTimer), this.clickTimer = null, t.Carousel.slides.forEach((t => {
            t.$image && (t.state = "destroy"), t.Panzoom && t.Panzoom.detachEvents()
        })), "closing" === this.fancybox.state && this.canZoom(t.getSlide()) && this.zoomOut()
    }
    onCreateSlide(t, e, i) {
        "ready" === this.fancybox.state && this.setContent(i)
    }
    onRemoveSlide(t, e, i) {
        i.$image && (i.$el.classList.remove(t.option("Image.canZoomInClass")), i.$image.remove(), i.$image = null), i.Panzoom && (i.Panzoom.destroy(), i.Panzoom = null), i.$el && i.$el.dataset && delete i.$el.dataset.imageFit
    }
    setContent(t) {
        if (t.isDom || t.html || t.type && "image" !== t.type) return;
        if (t.$image) return;
        t.type = "image", t.state = "loading";
        const e = document.createElement("div");
        e.style.visibility = "hidden";
        const i = document.createElement("img");
        i.addEventListener("load", (e => {
            e.stopImmediatePropagation(), this.onImageStatusChange(t)
        })), i.addEventListener("error", (() => {
            this.onImageStatusChange(t)
        })), i.src = t.src, i.alt = "", i.draggable = !1, i.classList.add("fancybox__image"), t.srcset && i.setAttribute("srcset", t.srcset), t.sizes && i.setAttribute("sizes", t.sizes), t.$image = i;
        const s = this.fancybox.option("Image.wrap");
        if (s) {
            const o = document.createElement("div");
            o.classList.add("string" == typeof s ? s : "fancybox__image-wrap"), o.appendChild(i), e.appendChild(o), t.$wrap = o
        } else e.appendChild(i);
        t.$el.dataset.imageFit = this.fancybox.option("Image.fit"), this.fancybox.setContent(t, e), i.complete || i.error ? this.onImageStatusChange(t) : this.fancybox.showLoading(t)
    }
    onImageStatusChange(t) {
        const e = t.$image;
        e && "loading" === t.state && (e.complete && e.naturalWidth && e.naturalHeight ? (this.fancybox.hideLoading(t), "contain" === this.fancybox.option("Image.fit") && this.initSlidePanzoom(t), t.$el.addEventListener("wheel", (e => this.onWheel(t, e)), {
            passive: !1
        }), t.$content.addEventListener("click", (e => this.onClick(t, e)), {
            passive: !1
        }), this.revealContent(t)) : this.fancybox.setError(t, "{{IMAGE_ERROR}}"))
    }
    initSlidePanzoom(t) {
        t.Panzoom || (t.Panzoom = new d(t.$el, e(!0, this.fancybox.option("Image.Panzoom", {}), {
            viewport: t.$wrap,
            content: t.$image,
            width: t._width,
            height: t._height,
            wrapInner: !1,
            textSelection: !0,
            touch: this.fancybox.option("Image.touch"),
            panOnlyZoomed: !0,
            click: !1,
            wheel: !1
        })), t.Panzoom.on("startAnimation", (() => {
            this.fancybox.trigger("Image.startAnimation", t)
        })), t.Panzoom.on("endAnimation", (() => {
            "zoomIn" === t.state && this.fancybox.done(t), this.handleCursor(t), this.fancybox.trigger("Image.endAnimation", t)
        })), t.Panzoom.on("afterUpdate", (() => {
            this.handleCursor(t), this.fancybox.trigger("Image.afterUpdate", t)
        })))
    }
    revealContent(t) {
        null === this.fancybox.Carousel.prevPage && t.index === this.fancybox.options.startIndex && this.canZoom(t) ? this.zoomIn() : this.fancybox.revealContent(t)
    }
    getZoomInfo(t) {
        const e = t.$thumb.getBoundingClientRect(),
            i = e.width,
            s = e.height,
            o = t.$content.getBoundingClientRect(),
            n = o.width,
            a = o.height,
            r = o.top - e.top,
            h = o.left - e.left;
        let l = this.fancybox.option("Image.zoomOpacity");
        return "auto" === l && (l = Math.abs(i / s - n / a) > .1), {
            top: r,
            left: h,
            scale: n && i ? i / n : 1,
            opacity: l
        }
    }
    canZoom(t) {
        const e = this.fancybox,
            i = e.$container;
        if (window.visualViewport && 1 !== window.visualViewport.scale) return !1;
        if (t.Panzoom && !t.Panzoom.content.width) return !1;
        if (!e.option("Image.zoom") || "contain" !== e.option("Image.fit")) return !1;
        const s = t.$thumb;
        if (!s || "loading" === t.state) return !1;
        i.classList.add("fancybox__no-click");
        const o = s.getBoundingClientRect();
        let n;
        if (this.fancybox.option("Image.ignoreCoveredThumbnail")) {
            const t = document.elementFromPoint(o.left + 1, o.top + 1) === s,
                e = document.elementFromPoint(o.right - 1, o.bottom - 1) === s;
            n = t && e
        } else n = document.elementFromPoint(o.left + .5 * o.width, o.top + .5 * o.height) === s;
        return i.classList.remove("fancybox__no-click"), n
    }
    zoomIn() {
        const t = this.fancybox,
            e = t.getSlide(),
            i = e.Panzoom,
            {
                top: s,
                left: o,
                scale: n,
                opacity: a
            } = this.getZoomInfo(e);
        t.trigger("reveal", e), i.panTo({
            x: -1 * o,
            y: -1 * s,
            scale: n,
            friction: 0,
            ignoreBounds: !0
        }), e.$content.style.visibility = "", e.state = "zoomIn", !0 === a && i.on("afterTransform", (t => {
            "zoomIn" !== e.state && "zoomOut" !== e.state || (t.$content.style.opacity = Math.min(1, 1 - (1 - t.content.scale) / (1 - n)))
        })), i.panTo({
            x: 0,
            y: 0,
            scale: 1,
            friction: this.fancybox.option("Image.zoomFriction")
        })
    }
    zoomOut() {
        const t = this.fancybox,
            e = t.getSlide(),
            i = e.Panzoom;
        if (!i) return;
        e.state = "zoomOut", t.state = "customClosing", e.$caption && (e.$caption.style.visibility = "hidden");
        let s = this.fancybox.option("Image.zoomFriction");
        const o = t => {
            const {
                top: o,
                left: n,
                scale: a,
                opacity: r
            } = this.getZoomInfo(e);
            t || r || (s *= .82), i.panTo({
                x: -1 * n,
                y: -1 * o,
                scale: a,
                friction: s,
                ignoreBounds: !0
            }), s *= .98
        };
        window.addEventListener("scroll", o), i.once("endAnimation", (() => {
            window.removeEventListener("scroll", o), t.destroy()
        })), o()
    }
    handleCursor(t) {
        if ("image" !== t.type || !t.$el) return;
        const e = t.Panzoom,
            i = this.fancybox.option("Image.click", !1, t),
            s = this.fancybox.option("Image.touch"),
            o = t.$el.classList,
            n = this.fancybox.option("Image.canZoomInClass"),
            a = this.fancybox.option("Image.canZoomOutClass");
        if (o.remove(a), o.remove(n), e && "toggleZoom" === i) {
            e && 1 === e.content.scale && e.option("maxScale") - e.content.scale > .01 ? o.add(n) : e.content.scale > 1 && !s && o.add(a)
        } else "close" === i && o.add(a)
    }
    onWheel(t, e) {
        if ("ready" === this.fancybox.state && !1 !== this.fancybox.trigger("Image.wheel", e)) switch (this.fancybox.option("Image.wheel")) {
            case "zoom":
                "done" === t.state && t.Panzoom && t.Panzoom.zoomWithWheel(e);
                break;
            case "close":
                this.fancybox.close();
                break;
            case "slide":
                this.fancybox[e.deltaY < 0 ? "prev" : "next"]()
        }
    }
    onClick(t, e) {
        if ("ready" !== this.fancybox.state) return;
        const i = t.Panzoom;
        if (i && (i.dragPosition.midPoint || 0 !== i.dragOffset.x || 0 !== i.dragOffset.y || 1 !== i.dragOffset.scale)) return;
        if (this.fancybox.Carousel.Panzoom.lockAxis) return !1;
        const s = i => {
                switch (i) {
                    case "toggleZoom":
                        e.stopPropagation(), t.Panzoom && t.Panzoom.zoomWithClick(e);
                        break;
                    case "close":
                        this.fancybox.close();
                        break;
                    case "next":
                        e.stopPropagation(), this.fancybox.next()
                }
            },
            o = this.fancybox.option("Image.click"),
            n = this.fancybox.option("Image.doubleClick");
        n ? this.clickTimer ? (clearTimeout(this.clickTimer), this.clickTimer = null, s(n)) : this.clickTimer = setTimeout((() => {
            this.clickTimer = null, s(o)
        }), 300) : s(o)
    }
    onPageChange(t, e) {
        const i = t.getSlide();
        e.slides.forEach((t => {
            t.Panzoom && "done" === t.state && t.index !== i.index && t.Panzoom.panTo({
                x: 0,
                y: 0,
                scale: 1,
                friction: .8
            })
        }))
    }
    attach() {
        this.fancybox.on(this.events)
    }
    detach() {
        this.fancybox.off(this.events)
    }
}
P.defaults = {
    canZoomInClass: "can-zoom_in",
    canZoomOutClass: "can-zoom_out",
    zoom: !0,
    zoomOpacity: "auto",
    zoomFriction: .82,
    ignoreCoveredThumbnail: !1,
    touch: !0,
    click: "toggleZoom",
    doubleClick: null,
    wheel: "zoom",
    fit: "contain",
    wrap: !1,
    Panzoom: {
        ratio: 1
    }
};
class L {
    constructor(t) {
        this.fancybox = t;
        for (const t of ["onChange", "onClosing"]) this[t] = this[t].bind(this);
        this.events = {
            initCarousel: this.onChange,
            "Carousel.change": this.onChange,
            closing: this.onClosing
        }, this.hasCreatedHistory = !1, this.origHash = "", this.timer = null
    }
    onChange(t) {
        const e = t.Carousel;
        this.timer && clearTimeout(this.timer);
        const i = null === e.prevPage,
            s = t.getSlide(),
            o = new URL(document.URL).hash;
        let n = !1;
        if (s.slug) n = "#" + s.slug;
        else {
            const i = s.$trigger && s.$trigger.dataset,
                o = t.option("slug") || i && i.fancybox;
            o && o.length && "true" !== o && (n = "#" + o + (e.slides.length > 1 ? "-" + (s.index + 1) : ""))
        }
        i && (this.origHash = o !== n ? o : ""), n && o !== n && (this.timer = setTimeout((() => {
            try {
                window.history[i ? "pushState" : "replaceState"]({}, document.title, window.location.pathname + window.location.search + n), i && (this.hasCreatedHistory = !0)
            } catch (t) {}
        }), 300))
    }
    onClosing() {
        if (this.timer && clearTimeout(this.timer), !0 !== this.hasSilentClose) try {
            return void window.history.replaceState({}, document.title, window.location.pathname + window.location.search + (this.origHash || ""))
        } catch (t) {}
    }
    attach(t) {
        t.on(this.events)
    }
    detach(t) {
        t.off(this.events)
    }
    static startFromUrl() {
        const t = L.Fancybox;
        if (!t || t.getInstance() || !1 === t.defaults.Hash) return;
        const {
            hash: e,
            slug: i,
            index: s
        } = L.getParsedURL();
        if (!i) return;
        let o = document.querySelector(`[data-slug="${e}"]`);
        if (o && o.dispatchEvent(new CustomEvent("click", {
                bubbles: !0,
                cancelable: !0
            })), t.getInstance()) return;
        const n = document.querySelectorAll(`[data-fancybox="${i}"]`);
        n.length && (null === s && 1 === n.length ? o = n[0] : s && (o = n[s - 1]), o && o.dispatchEvent(new CustomEvent("click", {
            bubbles: !0,
            cancelable: !0
        })))
    }
    static onHashChange() {
        const {
            slug: t,
            index: e
        } = L.getParsedURL(), i = L.Fancybox, s = i && i.getInstance();
        if (s && s.plugins.Hash) {
            if (t) {
                const i = s.Carousel;
                if (t === s.option("slug")) return i.slideTo(e - 1);
                for (let e of i.slides)
                    if (e.slug && e.slug === t) return i.slideTo(e.index);
                const o = s.getSlide(),
                    n = o.$trigger && o.$trigger.dataset;
                if (n && n.fancybox === t) return i.slideTo(e - 1)
            }
            s.plugins.Hash.hasSilentClose = !0, s.close()
        }
        L.startFromUrl()
    }
    static create(t) {
        function e() {
            window.addEventListener("hashchange", L.onHashChange, !1), L.startFromUrl()
        }
        L.Fancybox = t, v && window.requestAnimationFrame((() => {
            /complete|interactive|loaded/.test(document.readyState) ? e() : document.addEventListener("DOMContentLoaded", e)
        }))
    }
    static destroy() {
        window.removeEventListener("hashchange", L.onHashChange, !1)
    }
    static getParsedURL() {
        const t = window.location.hash.substr(1),
            e = t.split("-"),
            i = e.length > 1 && /^\+?\d+$/.test(e[e.length - 1]) && parseInt(e.pop(-1), 10) || null;
        return {
            hash: t,
            slug: e.join("-"),
            index: i
        }
    }
}
const T = {
    pageXOffset: 0,
    pageYOffset: 0,
    element: () => document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement,
    activate(t) {
        T.pageXOffset = window.pageXOffset, T.pageYOffset = window.pageYOffset, t.requestFullscreen ? t.requestFullscreen() : t.mozRequestFullScreen ? t.mozRequestFullScreen() : t.webkitRequestFullscreen ? t.webkitRequestFullscreen() : t.msRequestFullscreen && t.msRequestFullscreen()
    },
    deactivate() {
        document.exitFullscreen ? document.exitFullscreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitExitFullscreen && document.webkitExitFullscreen()
    }
};
class _ {
    constructor(t) {
        this.fancybox = t, this.active = !1, this.handleVisibilityChange = this.handleVisibilityChange.bind(this)
    }
    isActive() {
        return this.active
    }
    setTimer() {
        if (!this.active || this.timer) return;
        const t = this.fancybox.option("slideshow.delay", 3e3);
        this.timer = setTimeout((() => {
            this.timer = null, this.fancybox.option("infinite") || this.fancybox.getSlide().index !== this.fancybox.Carousel.slides.length - 1 ? this.fancybox.next() : this.fancybox.jumpTo(0, {
                friction: 0
            })
        }), t);
        let e = this.$progress;
        e || (e = document.createElement("div"), e.classList.add("fancybox__progress"), this.fancybox.$carousel.parentNode.insertBefore(e, this.fancybox.$carousel), this.$progress = e, e.offsetHeight), e.style.transitionDuration = `${t}ms`, e.style.transform = "scaleX(1)"
    }
    clearTimer() {
        clearTimeout(this.timer), this.timer = null, this.$progress && (this.$progress.style.transitionDuration = "", this.$progress.style.transform = "", this.$progress.offsetHeight)
    }
    activate() {
        this.active || (this.active = !0, this.fancybox.$container.classList.add("has-slideshow"), "done" === this.fancybox.getSlide().state && this.setTimer(), document.addEventListener("visibilitychange", this.handleVisibilityChange, !1))
    }
    handleVisibilityChange() {
        this.deactivate()
    }
    deactivate() {
        this.active = !1, this.clearTimer(), this.fancybox.$container.classList.remove("has-slideshow"), document.removeEventListener("visibilitychange", this.handleVisibilityChange, !1)
    }
    toggle() {
        this.active ? this.deactivate() : this.fancybox.Carousel.slides.length > 1 && this.activate()
    }
}
const A = {
    display: ["counter", "zoom", "slideshow", "fullscreen", "thumbs", "close"],
    autoEnable: !0,
    items: {
        counter: {
            position: "left",
            type: "div",
            class: "fancybox__counter",
            html: '<span data-fancybox-index=""></span>&nbsp;/&nbsp;<span data-fancybox-count=""></span>',
            attr: {
                tabindex: -1
            }
        },
        prev: {
            type: "button",
            class: "fancybox__button--prev",
            label: "PREV",
            html: '<svg viewBox="0 0 24 24"><path d="M15 4l-8 8 8 8"/></svg>',
            attr: {
                "data-fancybox-prev": ""
            }
        },
        next: {
            type: "button",
            class: "fancybox__button--next",
            label: "NEXT",
            html: '<svg viewBox="0 0 24 24"><path d="M8 4l8 8-8 8"/></svg>',
            attr: {
                "data-fancybox-next": ""
            }
        },
        fullscreen: {
            type: "button",
            class: "fancybox__button--fullscreen",
            label: "TOGGLE_FULLSCREEN",
            html: '<svg viewBox="0 0 24 24">\n                <g><path d="M3 8 V3h5"></path><path d="M21 8V3h-5"></path><path d="M8 21H3v-5"></path><path d="M16 21h5v-5"></path></g>\n                <g><path d="M7 2v5H2M17 2v5h5M2 17h5v5M22 17h-5v5"/></g>\n            </svg>',
            click: function (t) {
                t.preventDefault(), T.element() ? T.deactivate() : T.activate(this.fancybox.$container)
            }
        },
        slideshow: {
            type: "button",
            class: "fancybox__button--slideshow",
            label: "TOGGLE_SLIDESHOW",
            html: '<svg viewBox="0 0 24 24">\n                <g><path d="M6 4v16"/><path d="M20 12L6 20"/><path d="M20 12L6 4"/></g>\n                <g><path d="M7 4v15M17 4v15"/></g>\n            </svg>',
            click: function (t) {
                t.preventDefault(), this.Slideshow.toggle()
            }
        },
        zoom: {
            type: "button",
            class: "fancybox__button--zoom",
            label: "TOGGLE_ZOOM",
            html: '<svg viewBox="0 0 24 24"><circle cx="10" cy="10" r="7"></circle><path d="M16 16 L21 21"></svg>',
            click: function (t) {
                t.preventDefault();
                const e = this.fancybox.getSlide().Panzoom;
                e && e.toggleZoom()
            }
        },
        download: {
            type: "link",
            label: "DOWNLOAD",
            class: "fancybox__button--download",
            html: '<svg viewBox="0 0 24 24"><path d="M12 15V3m0 12l-4-4m4 4l4-4M2 17l.62 2.48A2 2 0 004.56 21h14.88a2 2 0 001.94-1.51L22 17"/></svg>',
            click: function (t) {
                t.stopPropagation()
            }
        },
        thumbs: {
            type: "button",
            label: "TOGGLE_THUMBS",
            class: "fancybox__button--thumbs",
            html: '<svg viewBox="0 0 24 24"><circle cx="4" cy="4" r="1" /><circle cx="12" cy="4" r="1" transform="rotate(90 12 4)"/><circle cx="20" cy="4" r="1" transform="rotate(90 20 4)"/><circle cx="4" cy="12" r="1" transform="rotate(90 4 12)"/><circle cx="12" cy="12" r="1" transform="rotate(90 12 12)"/><circle cx="20" cy="12" r="1" transform="rotate(90 20 12)"/><circle cx="4" cy="20" r="1" transform="rotate(90 4 20)"/><circle cx="12" cy="20" r="1" transform="rotate(90 12 20)"/><circle cx="20" cy="20" r="1" transform="rotate(90 20 20)"/></svg>',
            click: function (t) {
                t.stopPropagation();
                const e = this.fancybox.plugins.Thumbs;
                e && e.toggle()
            }
        },
        close: {
            type: "button",
            label: "CLOSE",
            class: "fancybox__button--close",
            html: '<svg viewBox="0 0 24 24"><path d="M20 20L4 4m16 0L4 20"></path></svg>',
            attr: {
                "data-fancybox-close": "",
                tabindex: 0
            }
        }
    }
};
class z {
    constructor(t) {
        this.fancybox = t, this.$container = null, this.state = "init";
        for (const t of ["onInit", "onPrepare", "onDone", "onKeydown", "onClosing", "onChange", "onSettle", "onRefresh"]) this[t] = this[t].bind(this);
        this.events = {
            init: this.onInit,
            prepare: this.onPrepare,
            done: this.onDone,
            keydown: this.onKeydown,
            closing: this.onClosing,
            "Carousel.change": this.onChange,
            "Carousel.settle": this.onSettle,
            "Carousel.Panzoom.touchStart": () => this.onRefresh(),
            "Image.startAnimation": (t, e) => this.onRefresh(e),
            "Image.afterUpdate": (t, e) => this.onRefresh(e)
        }
    }
    onInit() {
        if (this.fancybox.option("Toolbar.autoEnable")) {
            let t = !1;
            for (const e of this.fancybox.items)
                if ("image" === e.type) {
                    t = !0;
                    break
                } if (!t) return void(this.state = "disabled")
        }
        for (const e of this.fancybox.option("Toolbar.display")) {
            if ("close" === (t(e) ? e.id : e)) {
                this.fancybox.options.closeButton = !1;
                break
            }
        }
    }
    onPrepare() {
        const t = this.fancybox;
        if ("init" === this.state && (this.build(), this.update(), this.Slideshow = new _(t), !t.Carousel.prevPage && (t.option("slideshow.autoStart") && this.Slideshow.activate(), t.option("fullscreen.autoStart") && !T.element()))) try {
            T.activate(t.$container)
        } catch (t) {}
    }
    onFsChange() {
        window.scrollTo(T.pageXOffset, T.pageYOffset)
    }
    onSettle() {
        const t = this.fancybox,
            e = this.Slideshow;
        e && e.isActive() && (t.getSlide().index !== t.Carousel.slides.length - 1 || t.option("infinite") ? "done" === t.getSlide().state && e.setTimer() : e.deactivate())
    }
    onChange() {
        this.update(), this.Slideshow && this.Slideshow.isActive() && this.Slideshow.clearTimer()
    }
    onDone(t, e) {
        const i = this.Slideshow;
        e.index === t.getSlide().index && (this.update(), i && i.isActive() && (t.option("infinite") || e.index !== t.Carousel.slides.length - 1 ? i.setTimer() : i.deactivate()))
    }
    onRefresh(t) {
        t && t.index !== this.fancybox.getSlide().index || (this.update(), !this.Slideshow || !this.Slideshow.isActive() || t && "done" !== t.state || this.Slideshow.deactivate())
    }
    onKeydown(t, e, i) {
        " " === e && this.Slideshow && (this.Slideshow.toggle(), i.preventDefault())
    }
    onClosing() {
        this.Slideshow && this.Slideshow.deactivate(), document.removeEventListener("fullscreenchange", this.onFsChange)
    }
    createElement(t) {
        let e;
        "div" === t.type ? e = document.createElement("div") : (e = document.createElement("link" === t.type ? "a" : "button"), e.classList.add("carousel__button")), e.innerHTML = t.html, e.setAttribute("tabindex", t.tabindex || 0), t.class && e.classList.add(...t.class.split(" "));
        for (const i in t.attr) e.setAttribute(i, t.attr[i]);
        t.label && e.setAttribute("title", this.fancybox.localize(`{{${t.label}}}`)), t.click && e.addEventListener("click", t.click.bind(this)), "prev" === t.id && e.setAttribute("data-fancybox-prev", ""), "next" === t.id && e.setAttribute("data-fancybox-next", "");
        const i = e.querySelector("svg");
        return i && (i.setAttribute("role", "img"), i.setAttribute("tabindex", "-1"), i.setAttribute("xmlns", "http://www.w3.org/2000/svg")), e
    }
    build() {
        this.cleanup();
        const i = this.fancybox.option("Toolbar.items"),
            s = [{
                position: "left",
                items: []
            }, {
                position: "center",
                items: []
            }, {
                position: "right",
                items: []
            }],
            o = this.fancybox.plugins.Thumbs;
        for (const n of this.fancybox.option("Toolbar.display")) {
            let a, r;
            if (t(n) ? (a = n.id, r = e({}, i[a], n)) : (a = n, r = i[a]), ["counter", "next", "prev", "slideshow"].includes(a) && this.fancybox.items.length < 2) continue;
            if ("fullscreen" === a) {
                if (!document.fullscreenEnabled || window.fullScreen) continue;
                document.addEventListener("fullscreenchange", this.onFsChange)
            }
            if ("thumbs" === a && (!o || "disabled" === o.state)) continue;
            if (!r) continue;
            let h = r.position || "right",
                l = s.find((t => t.position === h));
            l && l.items.push(r)
        }
        const n = document.createElement("div");
        n.classList.add("fancybox__toolbar");
        for (const t of s)
            if (t.items.length) {
                const e = document.createElement("div");
                e.classList.add("fancybox__toolbar__items"), e.classList.add(`fancybox__toolbar__items--${t.position}`);
                for (const i of t.items) e.appendChild(this.createElement(i));
                n.appendChild(e)
            } this.fancybox.$carousel.parentNode.insertBefore(n, this.fancybox.$carousel), this.$container = n
    }
    update() {
        const t = this.fancybox.getSlide(),
            e = t.index,
            i = this.fancybox.items.length,
            s = t.downloadSrc || ("image" !== t.type || t.error ? null : t.src);
        for (const t of this.fancybox.$container.querySelectorAll("a.fancybox__button--download")) s ? (t.removeAttribute("disabled"), t.removeAttribute("tabindex"), t.setAttribute("href", s), t.setAttribute("download", s), t.setAttribute("target", "_blank")) : (t.setAttribute("disabled", ""), t.setAttribute("tabindex", -1), t.removeAttribute("href"), t.removeAttribute("download"));
        const o = t.Panzoom,
            n = o && o.option("maxScale") > o.option("baseScale");
        for (const t of this.fancybox.$container.querySelectorAll(".fancybox__button--zoom")) n ? t.removeAttribute("disabled") : t.setAttribute("disabled", "");
        for (const e of this.fancybox.$container.querySelectorAll("[data-fancybox-index]")) e.innerHTML = t.index + 1;
        for (const t of this.fancybox.$container.querySelectorAll("[data-fancybox-count]")) t.innerHTML = i;
        if (!this.fancybox.option("infinite")) {
            for (const t of this.fancybox.$container.querySelectorAll("[data-fancybox-prev]")) 0 === e ? t.setAttribute("disabled", "") : t.removeAttribute("disabled");
            for (const t of this.fancybox.$container.querySelectorAll("[data-fancybox-next]")) e === i - 1 ? t.setAttribute("disabled", "") : t.removeAttribute("disabled")
        }
    }
    cleanup() {
        this.Slideshow && this.Slideshow.isActive() && this.Slideshow.clearTimer(), this.$container && this.$container.remove(), this.$container = null
    }
    attach() {
        this.fancybox.on(this.events)
    }
    detach() {
        this.fancybox.off(this.events), this.cleanup()
    }
}
z.defaults = A;
const k = {
    ScrollLock: class {
        constructor(t) {
            this.fancybox = t, this.viewport = null, this.pendingUpdate = null;
            for (const t of ["onReady", "onResize", "onTouchstart", "onTouchmove"]) this[t] = this[t].bind(this)
        }
        onReady() {
            const t = window.visualViewport;
            t && (this.viewport = t, this.startY = 0, t.addEventListener("resize", this.onResize), this.updateViewport()), window.addEventListener("touchstart", this.onTouchstart, {
                passive: !1
            }), window.addEventListener("touchmove", this.onTouchmove, {
                passive: !1
            }), window.addEventListener("wheel", this.onWheel, {
                passive: !1
            })
        }
        onResize() {
            this.updateViewport()
        }
        updateViewport() {
            const t = this.fancybox,
                e = this.viewport,
                i = e.scale || 1,
                s = t.$container;
            if (!s) return;
            let o = "",
                n = "",
                a = "";
            i - 1 > .1 && (o = e.width * i + "px", n = e.height * i + "px", a = `translate3d(${e.offsetLeft}px, ${e.offsetTop}px, 0) scale(${1/i})`), s.style.width = o, s.style.height = n, s.style.transform = a
        }
        onTouchstart(t) {
            this.startY = t.touches ? t.touches[0].screenY : t.screenY
        }
        onTouchmove(t) {
            const e = this.startY,
                i = window.innerWidth / window.document.documentElement.clientWidth;
            if (!t.cancelable) return;
            if (t.touches.length > 1 || 1 !== i) return;
            const o = s(t.composedPath()[0]);
            if (!o) return void t.preventDefault();
            const n = window.getComputedStyle(o),
                a = parseInt(n.getPropertyValue("height"), 10),
                r = t.touches ? t.touches[0].screenY : t.screenY,
                h = e <= r && 0 === o.scrollTop,
                l = e >= r && o.scrollHeight - o.scrollTop === a;
            (h || l) && t.preventDefault()
        }
        onWheel(t) {
            s(t.composedPath()[0]) || t.preventDefault()
        }
        cleanup() {
            this.pendingUpdate && (cancelAnimationFrame(this.pendingUpdate), this.pendingUpdate = null);
            const t = this.viewport;
            t && (t.removeEventListener("resize", this.onResize), this.viewport = null), window.removeEventListener("touchstart", this.onTouchstart, !1), window.removeEventListener("touchmove", this.onTouchmove, !1), window.removeEventListener("wheel", this.onWheel, {
                passive: !1
            })
        }
        attach() {
            this.fancybox.on("initLayout", this.onReady)
        }
        detach() {
            this.fancybox.off("initLayout", this.onReady), this.cleanup()
        }
    },
    Thumbs: $,
    Html: E,
    Toolbar: z,
    Image: P,
    Hash: L
};
const O = {
        startIndex: 0,
        preload: 1,
        infinite: !0,
        showClass: "fancybox-zoomInUp",
        hideClass: "fancybox-fadeOut",
        animated: !0,
        hideScrollbar: !0,
        parentEl: null,
        mainClass: null,
        autoFocus: !0,
        trapFocus: !0,
        placeFocusBack: !0,
        click: "close",
        closeButton: "inside",
        dragToClose: !0,
        keyboard: {
            Escape: "close",
            Delete: "close",
            Backspace: "close",
            PageUp: "next",
            PageDown: "prev",
            ArrowUp: "next",
            ArrowDown: "prev",
            ArrowRight: "next",
            ArrowLeft: "prev"
        },
        template: {
            closeButton: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" tabindex="-1"><path d="M20 20L4 4m16 0L4 20"/></svg>',
            spinner: '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="25 25 50 50" tabindex="-1"><circle cx="50" cy="50" r="20"/></svg>',
            main: null
        },
        l10n: {
            CLOSE: "Close",
            NEXT: "Next",
            PREV: "Previous",
            MODAL: "You can close this modal content with the ESC key",
            ERROR: "Something Went Wrong, Please Try Again Later",
            IMAGE_ERROR: "Image Not Found",
            ELEMENT_NOT_FOUND: "HTML Element Not Found",
            AJAX_NOT_FOUND: "Error Loading AJAX : Not Found",
            AJAX_FORBIDDEN: "Error Loading AJAX : Forbidden",
            IFRAME_ERROR: "Error Loading Page",
            TOGGLE_ZOOM: "Toggle zoom level",
            TOGGLE_THUMBS: "Toggle thumbnails",
            TOGGLE_SLIDESHOW: "Toggle slideshow",
            TOGGLE_FULLSCREEN: "Toggle full-screen mode",
            DOWNLOAD: "Download"
        }
    },
    M = new Map;
let I = 0;
class F extends l {
    constructor(t, i = {}) {
        t = t.map((t => (t.width && (t._width = t.width), t.height && (t._height = t.height), t))), super(e(!0, {}, O, i)), this.bindHandlers(), this.state = "init", this.setItems(t), this.attachPlugins(F.Plugins), this.trigger("init"), !0 === this.option("hideScrollbar") && this.hideScrollbar(), this.initLayout(), this.initCarousel(), this.attachEvents(), M.set(this.id, this), this.trigger("prepare"), this.state = "ready", this.trigger("ready"), this.$container.setAttribute("aria-hidden", "false"), this.option("trapFocus") && this.focus()
    }
    option(t, ...e) {
        const i = this.getSlide();
        let s = i ? i[t] : void 0;
        return void 0 !== s ? ("function" == typeof s && (s = s.call(this, this, ...e)), s) : super.option(t, ...e)
    }
    bindHandlers() {
        for (const t of ["onMousedown", "onKeydown", "onClick", "onFocus", "onCreateSlide", "onSettle", "onTouchMove", "onTouchEnd", "onTransform"]) this[t] = this[t].bind(this)
    }
    attachEvents() {
        document.addEventListener("mousedown", this.onMousedown), document.addEventListener("keydown", this.onKeydown, !0), this.option("trapFocus") && document.addEventListener("focus", this.onFocus, !0), this.$container.addEventListener("click", this.onClick)
    }
    detachEvents() {
        document.removeEventListener("mousedown", this.onMousedown), document.removeEventListener("keydown", this.onKeydown, !0), document.removeEventListener("focus", this.onFocus, !0), this.$container.removeEventListener("click", this.onClick)
    }
    initLayout() {
        this.$root = this.option("parentEl") || document.body;
        let t = this.option("template.main");
        t && (this.$root.insertAdjacentHTML("beforeend", this.localize(t)), this.$container = this.$root.querySelector(".fancybox__container")), this.$container || (this.$container = document.createElement("div"), this.$root.appendChild(this.$container)), this.$container.onscroll = () => (this.$container.scrollLeft = 0, !1), Object.entries({
            class: "fancybox__container",
            role: "dialog",
            tabIndex: "-1",
            "aria-modal": "true",
            "aria-hidden": "true",
            "aria-label": this.localize("{{MODAL}}")
        }).forEach((t => this.$container.setAttribute(...t))), this.option("animated") && this.$container.classList.add("is-animated"), this.$backdrop = this.$container.querySelector(".fancybox__backdrop"), this.$backdrop || (this.$backdrop = document.createElement("div"), this.$backdrop.classList.add("fancybox__backdrop"), this.$container.appendChild(this.$backdrop)), this.$carousel = this.$container.querySelector(".fancybox__carousel"), this.$carousel || (this.$carousel = document.createElement("div"), this.$carousel.classList.add("fancybox__carousel"), this.$container.appendChild(this.$carousel)), this.$container.Fancybox = this, this.id = this.$container.getAttribute("id"), this.id || (this.id = this.options.id || ++I, this.$container.setAttribute("id", "fancybox-" + this.id));
        const e = this.option("mainClass");
        return e && this.$container.classList.add(...e.split(" ")), document.documentElement.classList.add("with-fancybox"), this.trigger("initLayout"), this
    }
    setItems(t) {
        const e = [];
        for (const i of t) {
            const t = i.$trigger;
            if (t) {
                const e = t.dataset || {};
                i.src = e.src || t.getAttribute("href") || i.src, i.type = e.type || i.type, !i.src && t instanceof HTMLImageElement && (i.src = t.currentSrc || i.$trigger.src)
            }
            let s = i.$thumb;
            if (!s) {
                let t = i.$trigger && i.$trigger.origTarget;
                t && (s = t instanceof HTMLImageElement ? t : t.querySelector("img:not([aria-hidden])")), !s && i.$trigger && (s = i.$trigger instanceof HTMLImageElement ? i.$trigger : i.$trigger.querySelector("img:not([aria-hidden])"))
            }
            i.$thumb = s || null;
            let o = i.thumb;
            !o && s && (o = s.currentSrc || s.src, !o && s.dataset && (o = s.dataset.lazySrc || s.dataset.src)), o || "image" !== i.type || (o = i.src), i.thumb = o || null, i.caption = i.caption || "", e.push(i)
        }
        this.items = e
    }
    initCarousel() {
        return this.Carousel = new y(this.$carousel, e(!0, {}, {
            prefix: "",
            classNames: {
                viewport: "fancybox__viewport",
                track: "fancybox__track",
                slide: "fancybox__slide"
            },
            textSelection: !0,
            preload: this.option("preload"),
            friction: .88,
            slides: this.items,
            initialPage: this.options.startIndex,
            slidesPerPage: 1,
            infiniteX: this.option("infinite"),
            infiniteY: !0,
            l10n: this.option("l10n"),
            Dots: !1,
            Navigation: {
                classNames: {
                    main: "fancybox__nav",
                    button: "carousel__button",
                    next: "is-next",
                    prev: "is-prev"
                }
            },
            Panzoom: {
                textSelection: !0,
                panOnlyZoomed: () => this.Carousel && this.Carousel.pages && this.Carousel.pages.length < 2 && !this.option("dragToClose"),
                lockAxis: () => {
                    if (this.Carousel) {
                        let t = "x";
                        return this.option("dragToClose") && (t += "y"), t
                    }
                }
            },
            on: {
                "*": (t, ...e) => this.trigger(`Carousel.${t}`, ...e),
                init: t => this.Carousel = t,
                createSlide: this.onCreateSlide,
                settle: this.onSettle
            }
        }, this.option("Carousel"))), this.option("dragToClose") && this.Carousel.Panzoom.on({
            touchMove: this.onTouchMove,
            afterTransform: this.onTransform,
            touchEnd: this.onTouchEnd
        }), this.trigger("initCarousel"), this
    }
    onCreateSlide(t, e) {
        let i = e.caption || "";
        if ("function" == typeof this.options.caption && (i = this.options.caption.call(this, this, this.Carousel, e)), "string" == typeof i && i.length) {
            const t = document.createElement("div"),
                s = `fancybox__caption_${this.id}_${e.index}`;
            t.className = "fancybox__caption", t.innerHTML = i, t.setAttribute("id", s), e.$caption = e.$el.appendChild(t), e.$el.classList.add("has-caption"), e.$el.setAttribute("aria-labelledby", s)
        }
    }
    onSettle() {
        this.option("autoFocus") && this.focus()
    }
    onFocus(t) {
        this.focus(t)
    }
    onClick(t) {
        if (t.defaultPrevented) return;
        let e = t.composedPath()[0];
        if (e.matches("[data-fancybox-close]")) return t.preventDefault(), void F.close(!1, t);
        if (e.matches("[data-fancybox-next]")) return t.preventDefault(), void F.next();
        if (e.matches("[data-fancybox-prev]")) return t.preventDefault(), void F.prev();
        if (e.matches(x) || document.activeElement.blur(), e.closest(".fancybox__content")) return;
        if (getSelection().toString().length) return;
        if (!1 === this.trigger("click", t)) return;
        switch (this.option("click")) {
            case "close":
                this.close();
                break;
            case "next":
                this.next()
        }
    }
    onTouchMove() {
        const t = this.getSlide().Panzoom;
        return !t || 1 === t.content.scale
    }
    onTouchEnd(t) {
        const e = t.dragOffset.y;
        Math.abs(e) >= 150 || Math.abs(e) >= 35 && t.dragOffset.time < 350 ? (this.option("hideClass") && (this.getSlide().hideClass = "fancybox-throwOut" + (t.content.y < 0 ? "Up" : "Down")), this.close()) : "y" === t.lockAxis && t.panTo({
            y: 0
        })
    }
    onTransform(t) {
        if (this.$backdrop) {
            const e = Math.abs(t.content.y),
                i = e < 1 ? "" : Math.max(.33, Math.min(1, 1 - e / t.content.fitHeight * 1.5));
            this.$container.style.setProperty("--fancybox-ts", i ? "0s" : ""), this.$container.style.setProperty("--fancybox-opacity", i)
        }
    }
    onMousedown() {
        "ready" === this.state && document.body.classList.add("is-using-mouse")
    }
    onKeydown(t) {
        if (F.getInstance().id !== this.id) return;
        document.body.classList.remove("is-using-mouse");
        const e = t.key,
            i = this.option("keyboard");
        if (!i || t.ctrlKey || t.altKey || t.shiftKey) return;
        const s = t.composedPath()[0],
            o = document.activeElement && document.activeElement.classList,
            n = o && o.contains("carousel__button");
        if ("Escape" !== e && !n) {
            if (t.target.isContentEditable || -1 !== ["BUTTON", "TEXTAREA", "OPTION", "INPUT", "SELECT", "VIDEO"].indexOf(s.nodeName)) return
        }
        if (!1 === this.trigger("keydown", e, t)) return;
        const a = i[e];
        "function" == typeof this[a] && this[a]()
    }
    getSlide() {
        const t = this.Carousel;
        if (!t) return null;
        const e = null === t.page ? t.option("initialPage") : t.page,
            i = t.pages || [];
        return i.length && i[e] ? i[e].slides[0] : null
    }
    focus(t) {
        if (F.ignoreFocusChange) return;
        if (["init", "closing", "customClosing", "destroy"].indexOf(this.state) > -1) return;
        const e = this.$container,
            i = this.getSlide(),
            s = "done" === i.state ? i.$el : null;
        if (s && s.contains(document.activeElement)) return;
        t && t.preventDefault(), F.ignoreFocusChange = !0;
        const o = Array.from(e.querySelectorAll(x));
        let n, a = [];
        for (let t of o) {
            const e = t.offsetParent,
                i = s && s.contains(t),
                o = !this.Carousel.$viewport.contains(t);
            e && (i || o) ? (a.push(t), void 0 !== t.dataset.origTabindex && (t.tabIndex = t.dataset.origTabindex, t.removeAttribute("data-orig-tabindex")), (t.hasAttribute("autoFocus") || !n && i && !t.classList.contains("carousel__button")) && (n = t)) : (t.dataset.origTabindex = void 0 === t.dataset.origTabindex ? t.getAttribute("tabindex") : t.dataset.origTabindex, t.tabIndex = -1)
        }
        t ? a.indexOf(t.target) > -1 ? this.lastFocus = t.target : this.lastFocus === e ? w(a[a.length - 1]) : w(e) : this.option("autoFocus") && n ? w(n) : a.indexOf(document.activeElement) < 0 && w(e), this.lastFocus = document.activeElement, F.ignoreFocusChange = !1
    }
    hideScrollbar() {
        if (!v) return;
        const t = window.innerWidth - document.documentElement.getBoundingClientRect().width,
            e = "fancybox-style-noscroll";
        let i = document.getElementById(e);
        i || t > 0 && (i = document.createElement("style"), i.id = e, i.type = "text/css", i.innerHTML = `.compensate-for-scrollbar {padding-right: ${t}px;}`, document.getElementsByTagName("head")[0].appendChild(i), document.body.classList.add("compensate-for-scrollbar"))
    }
    revealScrollbar() {
        document.body.classList.remove("compensate-for-scrollbar");
        const t = document.getElementById("fancybox-style-noscroll");
        t && t.remove()
    }
    clearContent(t) {
        this.Carousel.trigger("removeSlide", t), t.$content && (t.$content.remove(), t.$content = null), t.$closeButton && (t.$closeButton.remove(), t.$closeButton = null), t._className && t.$el.classList.remove(t._className)
    }
    setContent(t, e, i = {}) {
        let s;
        const o = t.$el;
        if (e instanceof HTMLElement)["img", "iframe", "video", "audio"].indexOf(e.nodeName.toLowerCase()) > -1 ? (s = document.createElement("div"), s.appendChild(e)) : s = e;
        else {
            const t = document.createRange().createContextualFragment(e);
            s = document.createElement("div"), s.appendChild(t)
        }
        if (t.filter && !t.error && (s = s.querySelector(t.filter)), s instanceof Element) return t._className = `has-${i.suffix||t.type||"unknown"}`, o.classList.add(t._className), s.classList.add("fancybox__content"), "none" !== s.style.display && "none" !== getComputedStyle(s).getPropertyValue("display") || (s.style.display = t.display || this.option("defaultDisplay") || "flex"), t.id && s.setAttribute("id", t.id), t.$content = s, o.prepend(s), this.manageCloseButton(t), "loading" !== t.state && this.revealContent(t), s;
        this.setError(t, "{{ELEMENT_NOT_FOUND}}")
    }
    manageCloseButton(t) {
        const e = void 0 === t.closeButton ? this.option("closeButton") : t.closeButton;
        if (!e || "top" === e && this.$closeButton) return;
        const i = document.createElement("button");
        i.classList.add("carousel__button", "is-close"), i.setAttribute("title", this.options.l10n.CLOSE), i.innerHTML = this.option("template.closeButton"), i.addEventListener("click", (t => this.close(t))), "inside" === e ? (t.$closeButton && t.$closeButton.remove(), t.$closeButton = t.$content.appendChild(i)) : this.$closeButton = this.$container.insertBefore(i, this.$container.firstChild)
    }
    revealContent(t) {
        this.trigger("reveal", t), t.$content.style.visibility = "";
        let e = !1;
        t.error || "loading" === t.state || null !== this.Carousel.prevPage || t.index !== this.options.startIndex || (e = void 0 === t.showClass ? this.option("showClass") : t.showClass), e ? (t.state = "animating", this.animateCSS(t.$content, e, (() => {
            this.done(t)
        }))) : this.done(t)
    }
    animateCSS(t, e, i) {
        if (t && t.dispatchEvent(new CustomEvent("animationend", {
                bubbles: !0,
                cancelable: !0
            })), !t || !e) return void("function" == typeof i && i());
        const s = function (o) {
            o.currentTarget === this && (t.removeEventListener("animationend", s), i && i(), t.classList.remove(e))
        };
        t.addEventListener("animationend", s), t.classList.add(e)
    }
    done(t) {
        t.state = "done", this.trigger("done", t);
        const e = this.getSlide();
        e && t.index === e.index && this.option("autoFocus") && this.focus()
    }
    setError(t, e) {
        t.error = e, this.hideLoading(t), this.clearContent(t);
        const i = document.createElement("div");
        i.classList.add("fancybox-error"), i.innerHTML = this.localize(e || "<p>{{ERROR}}</p>"), this.setContent(t, i, {
            suffix: "error"
        })
    }
    showLoading(t) {
        t.state = "loading", t.$el.classList.add("is-loading");
        let e = t.$el.querySelector(".fancybox__spinner");
        e || (e = document.createElement("div"), e.classList.add("fancybox__spinner"), e.innerHTML = this.option("template.spinner"), e.addEventListener("click", (() => {
            this.Carousel.Panzoom.velocity || this.close()
        })), t.$el.prepend(e))
    }
    hideLoading(t) {
        const e = t.$el && t.$el.querySelector(".fancybox__spinner");
        e && (e.remove(), t.$el.classList.remove("is-loading")), "loading" === t.state && (this.trigger("load", t), t.state = "ready")
    }
    next() {
        const t = this.Carousel;
        t && t.pages.length > 1 && t.slideNext()
    }
    prev() {
        const t = this.Carousel;
        t && t.pages.length > 1 && t.slidePrev()
    }
    jumpTo(...t) {
        this.Carousel && this.Carousel.slideTo(...t)
    }
    close(t) {
        if (t && t.preventDefault(), ["closing", "customClosing", "destroy"].includes(this.state)) return;
        if (!1 === this.trigger("shouldClose", t)) return;
        if (this.state = "closing", this.Carousel.Panzoom.destroy(), this.detachEvents(), this.trigger("closing", t), "destroy" === this.state) return;
        this.$container.setAttribute("aria-hidden", "true"), this.$container.classList.add("is-closing");
        const e = this.getSlide();
        if (this.Carousel.slides.forEach((t => {
                t.$content && t.index !== e.index && this.Carousel.trigger("removeSlide", t)
            })), "closing" === this.state) {
            const t = void 0 === e.hideClass ? this.option("hideClass") : e.hideClass;
            this.animateCSS(e.$content, t, (() => {
                this.destroy()
            }), !0)
        }
    }
    destroy() {
        if ("destroy" === this.state) return;
        this.state = "destroy", this.trigger("destroy");
        const t = this.option("placeFocusBack") ? this.getSlide().$trigger : null;
        this.Carousel.destroy(), this.detachPlugins(), this.Carousel = null, this.options = {}, this.events = {}, this.$container.remove(), this.$container = this.$backdrop = this.$carousel = null, t && w(t), M.delete(this.id);
        const e = F.getInstance();
        e ? e.focus() : (document.documentElement.classList.remove("with-fancybox"), document.body.classList.remove("is-using-mouse"), this.revealScrollbar())
    }
    static show(t, e = {}) {
        return new F(t, e)
    }
    static fromEvent(t, e = {}) {
        if (t.defaultPrevented) return;
        if (t.button && 0 !== t.button) return;
        if (t.ctrlKey || t.metaKey || t.shiftKey) return;
        const i = t.composedPath()[0];
        let s, o, n, a = i;
        if ((a.matches("[data-fancybox-trigger]") || (a = a.closest("[data-fancybox-trigger]"))) && (s = a && a.dataset && a.dataset.fancyboxTrigger), s) {
            const t = document.querySelectorAll(`[data-fancybox="${s}"]`),
                e = parseInt(a.dataset.fancyboxIndex, 10) || 0;
            a = t.length ? t[e] : a
        }
        a || (a = i), Array.from(F.openers.keys()).reverse().some((e => {
            n = a;
            let i = !1;
            try {
                n instanceof Element && ("string" == typeof e || e instanceof String) && (i = n.matches(e) || (n = n.closest(e)))
            } catch (t) {}
            return !!i && (t.preventDefault(), o = e, !0)
        }));
        let r = !1;
        if (o) {
            e.event = t, e.target = n, n.origTarget = i, r = F.fromOpener(o, e);
            const s = F.getInstance();
            s && "ready" === s.state && t.detail && document.body.classList.add("is-using-mouse")
        }
        return r
    }
    static fromOpener(t, i = {}) {
        let s = [],
            o = i.startIndex || 0,
            n = i.target || null;
        const a = void 0 !== (i = e({}, i, F.openers.get(t))).groupAll && i.groupAll,
            r = void 0 === i.groupAttr ? "data-fancybox" : i.groupAttr,
            h = r && n ? n.getAttribute(`${r}`) : "";
        if (!n || h || a) {
            const e = i.root || (n ? n.getRootNode() : document.body);
            s = [].slice.call(e.querySelectorAll(t))
        }
        if (n && !a && (s = h ? s.filter((t => t.getAttribute(`${r}`) === h)) : [n]), !s.length) return !1;
        const l = F.getInstance();
        return !(l && s.indexOf(l.options.$trigger) > -1) && (o = n ? s.indexOf(n) : o, s = s.map((function (t) {
            const e = ["false", "0", "no", "null", "undefined"],
                i = ["true", "1", "yes"],
                s = Object.assign({}, t.dataset),
                o = {};
            for (let [t, n] of Object.entries(s))
                if ("fancybox" !== t)
                    if ("width" === t || "height" === t) o[`_${t}`] = n;
                    else if ("string" == typeof n || n instanceof String)
                if (e.indexOf(n) > -1) o[t] = !1;
                else if (i.indexOf(o[t]) > -1) o[t] = !0;
            else try {
                o[t] = JSON.parse(n)
            } catch (e) {
                o[t] = n
            } else o[t] = n;
            return t instanceof Element && (o.$trigger = t), o
        })), new F(s, e({}, i, {
            startIndex: o,
            $trigger: n
        })))
    }
    static bind(t, e = {}) {
        function i() {
            document.body.addEventListener("click", F.fromEvent, !1)
        }
        v && (F.openers.size || (/complete|interactive|loaded/.test(document.readyState) ? i() : document.addEventListener("DOMContentLoaded", i)), F.openers.set(t, e))
    }
    static unbind(t) {
        F.openers.delete(t), F.openers.size || F.destroy()
    }
    static destroy() {
        let t;
        for (; t = F.getInstance();) t.destroy();
        F.openers = new Map, document.body.removeEventListener("click", F.fromEvent, !1)
    }
    static getInstance(t) {
        if (t) return M.get(t);
        return Array.from(M.values()).reverse().find((t => !["closing", "customClosing", "destroy"].includes(t.state) && t)) || null
    }
    static close(t = !0, e) {
        if (t)
            for (const t of M.values()) t.close(e);
        else {
            const t = F.getInstance();
            t && t.close(e)
        }
    }
    static next() {
        const t = F.getInstance();
        t && t.next()
    }
    static prev() {
        const t = F.getInstance();
        t && t.prev()
    }
}
F.version = "4.0.27", F.defaults = O, F.openers = new Map, F.Plugins = k, F.bind("[data-fancybox]");
for (const [t, e] of Object.entries(F.Plugins || {})) "function" == typeof e.create && e.create(F);
export {
    y as Carousel, F as Fancybox, d as Panzoom
};
