!(function () {
  var e = {
      633: function (e, t) {
        var n;
        !(function () {
          "use strict";
          var o = {}.hasOwnProperty;
          function r() {
            for (var e = [], t = 0; t < arguments.length; t++) {
              var n = arguments[t];
              if (n) {
                var i = typeof n;
                if ("string" === i || "number" === i) e.push(n);
                else if (Array.isArray(n)) {
                  if (n.length) {
                    var s = r.apply(null, n);
                    s && e.push(s);
                  }
                } else if ("object" === i) {
                  if (
                    n.toString !== Object.prototype.toString &&
                    !n.toString.toString().includes("[native code]")
                  ) {
                    e.push(n.toString());
                    continue;
                  }
                  for (var a in n) o.call(n, a) && n[a] && e.push(a);
                }
              }
            }
            return e.join(" ");
          }
          e.exports
            ? ((r.default = r), (e.exports = r))
            : void 0 ===
                (n = function () {
                  return r;
                }.apply(t, [])) || (e.exports = n);
        })();
      },
    },
    t = {};
  function n(o) {
    var r = t[o];
    if (void 0 !== r) return r.exports;
    var i = (t[o] = { exports: {} });
    return e[o](i, i.exports, n), i.exports;
  }
  (n.n = function (e) {
    var t =
      e && e.__esModule
        ? function () {
            return e.default;
          }
        : function () {
            return e;
          };
    return n.d(t, { a: t }), t;
  }),
    (n.d = function (e, t) {
      for (var o in t)
        n.o(t, o) &&
          !n.o(e, o) &&
          Object.defineProperty(e, o, { enumerable: !0, get: t[o] });
    }),
    (n.o = function (e, t) {
      return Object.prototype.hasOwnProperty.call(e, t);
    }),
    (function () {
      "use strict";
      function e(t) {
        return (
          (e =
            "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
              ? function (e) {
                  return typeof e;
                }
              : function (e) {
                  return e &&
                    "function" == typeof Symbol &&
                    e.constructor === Symbol &&
                    e !== Symbol.prototype
                    ? "symbol"
                    : typeof e;
                }),
          e(t)
        );
      }
      function t(t) {
        var n = (function (t) {
          if ("object" != e(t) || !t) return t;
          var n = t[Symbol.toPrimitive];
          if (void 0 !== n) {
            var o = n.call(t, "string");
            if ("object" != e(o)) return o;
            throw new TypeError("@@toPrimitive must return a primitive value.");
          }
          return String(t);
        })(t);
        return "symbol" == e(n) ? n : n + "";
      }
      function o(e, n, o) {
        return (
          (n = t(n)) in e
            ? Object.defineProperty(e, n, {
                value: o,
                enumerable: !0,
                configurable: !0,
                writable: !0,
              })
            : (e[n] = o),
          e
        );
      }
      function r(e, t) {
        (null == t || t > e.length) && (t = e.length);
        for (var n = 0, o = Array(t); n < t; n++) o[n] = e[n];
        return o;
      }
      function i(e, t) {
        if (e) {
          if ("string" == typeof e) return r(e, t);
          var n = {}.toString.call(e).slice(8, -1);
          return (
            "Object" === n && e.constructor && (n = e.constructor.name),
            "Map" === n || "Set" === n
              ? Array.from(e)
              : "Arguments" === n ||
                  /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)
                ? r(e, t)
                : void 0
          );
        }
      }
      var s = window.wp.blocks,
        a = window.wp.blockEditor,
        l = window.wp.serverSideRender,
        u = n.n(l),
        c = window.wp.i18n,
        p = window.wp.element,
        d = window.wp.components;
      function f(e, t) {
        if (!(e instanceof t))
          throw new TypeError("Cannot call a class as a function");
      }
      function h(e, n) {
        for (var o = 0; o < n.length; o++) {
          var r = n[o];
          (r.enumerable = r.enumerable || !1),
            (r.configurable = !0),
            "value" in r && (r.writable = !0),
            Object.defineProperty(e, t(r.key), r);
        }
      }
      function g(e, t, n) {
        return (
          t && h(e.prototype, t),
          n && h(e, n),
          Object.defineProperty(e, "prototype", { writable: !1 }),
          e
        );
      }
      function v(t, n) {
        if (n && ("object" == e(n) || "function" == typeof n)) return n;
        if (void 0 !== n)
          throw new TypeError(
            "Derived constructors may only return object or undefined",
          );
        return (function (e) {
          if (void 0 === e)
            throw new ReferenceError(
              "this hasn't been initialised - super() hasn't been called",
            );
          return e;
        })(t);
      }
      function y(e) {
        return (
          (y = Object.setPrototypeOf
            ? Object.getPrototypeOf.bind()
            : function (e) {
                return e.__proto__ || Object.getPrototypeOf(e);
              }),
          y(e)
        );
      }
      function m(e, t) {
        return (
          (m = Object.setPrototypeOf
            ? Object.setPrototypeOf.bind()
            : function (e, t) {
                return (e.__proto__ = t), e;
              }),
          m(e, t)
        );
      }
      function b(e, t) {
        if ("function" != typeof t && null !== t)
          throw new TypeError(
            "Super expression must either be null or a function",
          );
        (e.prototype = Object.create(t && t.prototype, {
          constructor: { value: e, writable: !0, configurable: !0 },
        })),
          Object.defineProperty(e, "prototype", { writable: !1 }),
          t && m(e, t);
      }
      function w(e) {
        return (
          (function (e) {
            if (Array.isArray(e)) return r(e);
          })(e) ||
          (function (e) {
            if (
              ("undefined" != typeof Symbol && null != e[Symbol.iterator]) ||
              null != e["@@iterator"]
            )
              return Array.from(e);
          })(e) ||
          i(e) ||
          (function () {
            throw new TypeError(
              "Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.",
            );
          })()
        );
      }
      var k = window.wp.data,
        S = window.lodash,
        x = window.ReactJSXRuntime;
      function T() {
        return (0, x.jsxs)("svg", {
          xmlns: "http://www.w3.org/2000/svg",
          viewBox: "0 0 222 221.7",
          children: [
            (0, x.jsxs)("linearGradient", {
              id: "SVGID_1_111111",
              gradientUnits: "userSpaceOnUse",
              x1: "81.4946",
              y1: "2852.0237",
              x2: "188.5188",
              y2: "2660.0842",
              gradientTransform: "translate(0 -2658.8872)",
              children: [
                (0, x.jsx)("stop", { offset: "0", "stop-color": "#2ae498" }),
                (0, x.jsx)("stop", {
                  offset: ".01117462",
                  "stop-color": "#2ae299",
                }),
                (0, x.jsx)("stop", {
                  offset: ".4845",
                  "stop-color": "#359dca",
                }),
                (0, x.jsx)("stop", {
                  offset: ".8263",
                  "stop-color": "#3b72e9",
                }),
                (0, x.jsx)("stop", { offset: "1", "stop-color": "#3e62f5" }),
              ],
            }),
            (0, x.jsx)("path", {
              d: "M171.4 5c-6.1 0-11.1 5-11.1 11.1v52.1C147.4 56 130.1 48.5 111 48.5c-39.5 0-71.5 32-71.5 71.5s32 71.5 71.5 71.5c19.1 0 36.4-7.5 49.2-19.7v4.4c0 6.1 5 11.1 11.1 11.1s11.1-5 11.1-11.1V16.1c0-6.1-5-11.1-11-11.1z",
              fill: "url(#SVGID_1_111111)",
            }),
            (0, x.jsx)("path", {
              d: "M160.3 135.6v3.7c0 9.4-4 20.6-11.5 33-4 6.6-9 13.5-14.9 20.5-8.8 10.5-17.6 19.1-22.8 23.9-5.2-4.8-14-13.3-22.7-23.7-3.5-4.1-6.6-8.1-9.4-12.1-.3-.4-.6-.8-.8-1.1-3.5-4.9-6.4-9.7-8.8-14.3l-.3-.6c-4.8-9.4-7.2-17.9-7.2-25.4v-3.7c0-14.5 6-27.8 15.6-37.1C86.3 90.2 98 84.9 111 84.9s24.9 5.2 33.6 13.8c.9.9 1.8 1.9 2.7 2.9.4.3.6.7.9 1 .2.2.4.5.6.7 7.1 8.8 11.3 20.1 11.5 32.3z",
              opacity: ".12",
            }),
            (0, x.jsx)("path", {
              fill: "#fff",
              d: "M160.3 121.2v3.7c0 9.4-4 20.6-11.5 33-4 6.6-9 13.5-14.9 20.5-8.8 10.5-17.6 19.1-22.8 23.9-5.2-4.8-14-13.3-22.7-23.7-3.5-4.1-6.6-8.1-9.4-12.1-.3-.4-.6-.8-.8-1.1-3.5-4.9-6.4-9.7-8.8-14.3l-.3-.6c-4.8-9.4-7.2-17.9-7.2-25.4v-3.7c0-14.5 6-27.8 15.6-37.1C86.3 75.8 98 70.5 111 70.5s24.9 5.2 33.6 13.8c.9.9 1.8 1.9 2.7 2.9.4.3.6.7.9 1 .2.2.4.5.6.7 7.1 8.8 11.3 20.1 11.5 32.3z",
            }),
            (0, x.jsx)("path", {
              d: "M110.9 91.8c-15.6 0-28.2 12.6-28.2 28.2 0 5 1.3 9.8 3.6 13.9l-17.1 17.2c2.3 4.6 5.3 9.3 8.8 14.3l20.1-20.1c3.8 2 8.2 3.1 12.8 3.1 15.6 0 28.2-12.6 28.2-28.2s-12.6-28.4-28.2-28.4z",
              fill: "#3e62f5",
            }),
            (0, x.jsx)("path", {
              fill: "#fff",
              d: "M102.5 100.3c-3.7 1.6-6.6 4.2-8.5 7.3-.9 1.5-.1 3.6 1.6 3.9.1 0 .2 0 .3.1 1.1.2 2.1-.3 2.7-1.3 1.4-2.2 3.4-4 6-5.1 2.8-1.2 5.7-1.3 8.4-.6 1 .3 2.1 0 2.7-.9.1-.1.1-.2.2-.3 1-1.4.3-3.5-1.4-3.9-3.8-1.1-8.1-.9-12 .8z",
            }),
          ],
        });
      }
      function O(e) {
        return e.map(function (e) {
          return {
            value: e.slug,
            label: (0, S.truncate)(I(e.name), { length: 30 }),
          };
        });
      }
      function j(e) {
        return e.map(function (e) {
          return {
            value: e.id,
            label: (0, S.truncate)(I(e.title.rendered), { length: 30 }),
          };
        });
      }
      function I(e) {
        var t = document.createElement("textarea");
        return (t.innerHTML = e), t.textContent;
      }
      var C = n(633),
        P = n.n(C),
        E = window.wp.compose,
        L = window.wp.keycodes,
        _ = window.wp.isShallowEqual,
        D = n.n(_),
        A = window.wp.primitives,
        B = (0, x.jsx)(A.SVG, {
          xmlns: "http://www.w3.org/2000/svg",
          viewBox: "0 0 24 24",
          children: (0, x.jsx)(A.Path, {
            d: "M12 13.06l3.712 3.713 1.061-1.06L13.061 12l3.712-3.712-1.06-1.06L12 10.938 8.288 7.227l-1.061 1.06L10.939 12l-3.712 3.712 1.06 1.061L12 13.061z",
          }),
        });
      function V(e) {
        var t = e.value,
          n = e.label,
          o = e.status,
          r = e.title,
          i = e.displayTransform,
          s = e.isBorderless,
          a = void 0 !== s && s,
          l = e.disabled,
          u = void 0 !== l && l,
          p = e.onClickRemove,
          f = void 0 === p ? S.noop : p,
          h = e.onMouseEnter,
          g = e.onMouseLeave,
          v = e.messages,
          y = e.termPosition,
          m = e.termsCount,
          b = (0, E.useInstanceId)(V),
          w = P()("components-form-token-field__token", {
            "is-error": "error" === o,
            "is-success": "success" === o,
            "is-validating": "validating" === o,
            "is-borderless": a,
            "is-disabled": u,
          }),
          k = i(n),
          T = (0, c.sprintf)(
            /* translators: 1: term name, 2: term position in a set of terms, 3: total term set count. */ /* translators: 1: term name, 2: term position in a set of terms, 3: total term set count. */
            (0, c.__)("%1$s (%2$s of %3$s)"),
            k,
            y,
            m,
          );
        return (0, x.jsxs)("span", {
          className: w,
          onMouseEnter: h,
          onMouseLeave: g,
          title: r,
          children: [
            (0, x.jsxs)("span", {
              className: "components-form-token-field__token-text",
              id: "components-form-token-field__token-text-".concat(b),
              children: [
                (0, x.jsx)(d.VisuallyHidden, { as: "span", children: T }),
                (0, x.jsx)("span", { "aria-hidden": "true", children: k }),
              ],
            }),
            (0, x.jsx)(d.Button, {
              className: "components-form-token-field__remove-token",
              icon: B,
              onClick:
                !u &&
                function () {
                  return f({ value: t });
                },
              label: v.remove,
              "aria-describedby":
                "components-form-token-field__token-text-".concat(b),
            }),
          ],
        });
      }
      var M = [
        "value",
        "isExpanded",
        "instanceId",
        "selectedSuggestionIndex",
        "className",
      ];
      function F(e, t) {
        var n = Object.keys(e);
        if (Object.getOwnPropertySymbols) {
          var o = Object.getOwnPropertySymbols(e);
          t &&
            (o = o.filter(function (t) {
              return Object.getOwnPropertyDescriptor(e, t).enumerable;
            })),
            n.push.apply(n, o);
        }
        return n;
      }
      function R(e) {
        for (var t = 1; t < arguments.length; t++) {
          var n = null != arguments[t] ? arguments[t] : {};
          t % 2
            ? F(Object(n), !0).forEach(function (t) {
                o(e, t, n[t]);
              })
            : Object.getOwnPropertyDescriptors
              ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n))
              : F(Object(n)).forEach(function (t) {
                  Object.defineProperty(
                    e,
                    t,
                    Object.getOwnPropertyDescriptor(n, t),
                  );
                });
        }
        return e;
      }
      function N() {
        try {
          var e = !Boolean.prototype.valueOf.call(
            Reflect.construct(Boolean, [], function () {}),
          );
        } catch (e) {}
        return (N = function () {
          return !!e;
        })();
      }
      var K = (function (e) {
          function t() {
            var e, n, o, r;
            return (
              f(this, t),
              (n = this),
              (r = arguments),
              (o = y((o = t))),
              ((e = v(
                n,
                N()
                  ? Reflect.construct(o, r || [], y(n).constructor)
                  : o.apply(n, r),
              )).onChange = e.onChange.bind(e)),
              (e.bindInput = e.bindInput.bind(e)),
              e
            );
          }
          return (
            b(t, e),
            g(t, [
              {
                key: "focus",
                value: function () {
                  this.input.focus();
                },
              },
              {
                key: "hasFocus",
                value: function () {
                  return this.input === this.input.ownerDocument.activeElement;
                },
              },
              {
                key: "bindInput",
                value: function (e) {
                  this.input = e;
                },
              },
              {
                key: "onChange",
                value: function (e) {
                  this.props.onChange({ value: e.target.value });
                },
              },
              {
                key: "render",
                value: function () {
                  var e = this.props,
                    t = e.value,
                    n = e.isExpanded,
                    o = e.instanceId,
                    r = e.selectedSuggestionIndex,
                    i = e.className,
                    s = (function (e, t) {
                      if (null == e) return {};
                      var n,
                        o,
                        r = (function (e, t) {
                          if (null == e) return {};
                          var n = {};
                          for (var o in e)
                            if ({}.hasOwnProperty.call(e, o)) {
                              if (t.includes(o)) continue;
                              n[o] = e[o];
                            }
                          return n;
                        })(e, t);
                      if (Object.getOwnPropertySymbols) {
                        var i = Object.getOwnPropertySymbols(e);
                        for (o = 0; o < i.length; o++)
                          (n = i[o]),
                            t.includes(n) ||
                              ({}.propertyIsEnumerable.call(e, n) &&
                                (r[n] = e[n]));
                      }
                      return r;
                    })(e, M),
                    a = t ? t.length + 1 : 0;
                  return (0, x.jsx)(
                    "input",
                    R(
                      R(
                        {
                          ref: this.bindInput,
                          id: "components-form-token-input-".concat(o),
                          type: "text",
                        },
                        s,
                      ),
                      {},
                      {
                        value: t || "",
                        onChange: this.onChange,
                        size: a,
                        className: P()(i, "components-form-token-field__input"),
                        autoComplete: "off",
                        role: "combobox",
                        "aria-expanded": n,
                        "aria-autocomplete": "list",
                        "aria-owns": n
                          ? "components-form-token-suggestions-".concat(o)
                          : void 0,
                        "aria-activedescendant":
                          -1 !== r
                            ? "components-form-token-suggestions-"
                                .concat(o, "-")
                                .concat(r)
                            : void 0,
                        "aria-describedby":
                          "components-form-token-suggestions-howto-".concat(o),
                      },
                    ),
                  );
                },
              },
            ])
          );
        })(p.Component),
        H = K;
      function W(e) {
        return (
          (W =
            "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
              ? function (e) {
                  return typeof e;
                }
              : function (e) {
                  return e &&
                    "function" == typeof Symbol &&
                    e.constructor === Symbol &&
                    e !== Symbol.prototype
                    ? "symbol"
                    : typeof e;
                }),
          W(e)
        );
      }
      function z(e, t, n) {
        return (
          t in e
            ? Object.defineProperty(e, t, {
                value: n,
                enumerable: !0,
                configurable: !0,
                writable: !0,
              })
            : (e[t] = n),
          e
        );
      }
      function U(e, t) {
        var n = Object.keys(e);
        if (Object.getOwnPropertySymbols) {
          var o = Object.getOwnPropertySymbols(e);
          t &&
            (o = o.filter(function (t) {
              return Object.getOwnPropertyDescriptor(e, t).enumerable;
            })),
            n.push.apply(n, o);
        }
        return n;
      }
      function G(e, t) {
        var n = e["page".concat(t ? "Y" : "X", "Offset")],
          o = "scroll".concat(t ? "Top" : "Left");
        if ("number" != typeof n) {
          var r = e.document;
          "number" != typeof (n = r.documentElement[o]) && (n = r.body[o]);
        }
        return n;
      }
      function $(e) {
        return G(e);
      }
      function q(e) {
        return G(e, !0);
      }
      function J(e) {
        var t = (function (e) {
            var t,
              n,
              o,
              r = e.ownerDocument,
              i = r.body,
              s = r && r.documentElement;
            return (
              (n = (t = e.getBoundingClientRect()).left),
              (o = t.top),
              {
                left: (n -= s.clientLeft || i.clientLeft || 0),
                top: (o -= s.clientTop || i.clientTop || 0),
              }
            );
          })(e),
          n = e.ownerDocument,
          o = n.defaultView || n.parentWindow;
        return (t.left += $(o)), (t.top += q(o)), t;
      }
      var X,
        Y = new RegExp(
          "^(".concat(
            /[\-+]?(?:\d*\.|)\d+(?:[eE][\-+]?\d+|)/.source,
            ")(?!px)[a-z%]+$",
          ),
          "i",
        ),
        Q = /^(top|right|bottom|left)$/,
        Z = "currentStyle",
        ee = "runtimeStyle",
        te = "left";
      function ne(e, t) {
        for (var n = 0; n < e.length; n++) t(e[n]);
      }
      function oe(e) {
        return "border-box" === X(e, "boxSizing");
      }
      "undefined" != typeof window &&
        (X = window.getComputedStyle
          ? function (e, t, n) {
              var o = "",
                r = e.ownerDocument,
                i = n || r.defaultView.getComputedStyle(e, null);
              return i && (o = i.getPropertyValue(t) || i[t]), o;
            }
          : function (e, t) {
              var n = e[Z] && e[Z][t];
              if (Y.test(n) && !Q.test(t)) {
                var o = e.style,
                  r = o[te],
                  i = e[ee][te];
                (e[ee][te] = e[Z][te]),
                  (o[te] = "fontSize" === t ? "1em" : n || 0),
                  (n = o.pixelLeft + "px"),
                  (o[te] = r),
                  (e[ee][te] = i);
              }
              return "" === n ? "auto" : n;
            });
      var re = ["margin", "border", "padding"];
      function ie(e, t, n) {
        var o,
          r,
          i,
          s = 0;
        for (r = 0; r < t.length; r++)
          if ((o = t[r]))
            for (i = 0; i < n.length; i++) {
              var a;
              (a = "border" === o ? "".concat(o + n[i], "Width") : o + n[i]),
                (s += parseFloat(X(e, a)) || 0);
            }
        return s;
      }
      function se(e) {
        return null != e && e == e.window;
      }
      var ae = {};
      function le(e, t, n) {
        if (se(e))
          return "width" === t ? ae.viewportWidth(e) : ae.viewportHeight(e);
        if (9 === e.nodeType)
          return "width" === t ? ae.docWidth(e) : ae.docHeight(e);
        var o = "width" === t ? ["Left", "Right"] : ["Top", "Bottom"],
          r = "width" === t ? e.offsetWidth : e.offsetHeight,
          i = (X(e), oe(e)),
          s = 0;
        (null == r || r <= 0) &&
          ((r = void 0),
          (null == (s = X(e, t)) || Number(s) < 0) && (s = e.style[t] || 0),
          (s = parseFloat(s) || 0)),
          void 0 === n && (n = i ? 1 : -1);
        var a = void 0 !== r || i,
          l = r || s;
        if (-1 === n) return a ? l - ie(e, ["border", "padding"], o) : s;
        if (a) {
          var u = 2 === n ? -ie(e, ["border"], o) : ie(e, ["margin"], o);
          return l + (1 === n ? 0 : u);
        }
        return s + ie(e, re.slice(n), o);
      }
      ne(["Width", "Height"], function (e) {
        (ae["doc".concat(e)] = function (t) {
          var n = t.document;
          return Math.max(
            n.documentElement["scroll".concat(e)],
            n.body["scroll".concat(e)],
            ae["viewport".concat(e)](n),
          );
        }),
          (ae["viewport".concat(e)] = function (t) {
            var n = "client".concat(e),
              o = t.document,
              r = o.body,
              i = o.documentElement[n];
            return ("CSS1Compat" === o.compatMode && i) || (r && r[n]) || i;
          });
      });
      var ue = { position: "absolute", visibility: "hidden", display: "block" };
      function ce(e) {
        var t,
          n = arguments;
        return (
          0 !== e.offsetWidth
            ? (t = le.apply(void 0, n))
            : (function (e, o) {
                var r,
                  i = {},
                  s = e.style;
                for (r in o)
                  o.hasOwnProperty(r) && ((i[r] = s[r]), (s[r] = o[r]));
                for (r in (function () {
                  t = le.apply(void 0, n);
                }.call(e),
                o))
                  o.hasOwnProperty(r) && (s[r] = i[r]);
              })(e, ue),
          t
        );
      }
      function pe(e, t, n) {
        var o = n;
        if ("object" !== W(t))
          return void 0 !== o
            ? ("number" == typeof o && (o += "px"), void (e.style[t] = o))
            : X(e, t);
        for (var r in t) t.hasOwnProperty(r) && pe(e, r, t[r]);
      }
      ne(["width", "height"], function (e) {
        var t = e.charAt(0).toUpperCase() + e.slice(1);
        ae["outer".concat(t)] = function (t, n) {
          return t && ce(t, e, n ? 0 : 1);
        };
        var n = "width" === e ? ["Left", "Right"] : ["Top", "Bottom"];
        ae[e] = function (t, o) {
          return void 0 === o
            ? t && ce(t, e, -1)
            : t
              ? (X(t),
                oe(t) && (o += ie(t, ["padding", "border"], n)),
                pe(t, e, o))
              : void 0;
        };
      });
      var de = (function (e) {
        for (var t = 1; t < arguments.length; t++) {
          var n = null != arguments[t] ? arguments[t] : {};
          t % 2
            ? U(n, !0).forEach(function (t) {
                z(e, t, n[t]);
              })
            : Object.getOwnPropertyDescriptors
              ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n))
              : U(n).forEach(function (t) {
                  Object.defineProperty(
                    e,
                    t,
                    Object.getOwnPropertyDescriptor(n, t),
                  );
                });
        }
        return e;
      })(
        {
          getWindow: function (e) {
            var t = e.ownerDocument || e;
            return t.defaultView || t.parentWindow;
          },
          offset: function (e, t) {
            if (void 0 === t) return J(e);
            !(function (e, t) {
              "static" === pe(e, "position") && (e.style.position = "relative");
              var n,
                o,
                r = J(e),
                i = {};
              for (o in t)
                t.hasOwnProperty(o) &&
                  ((n = parseFloat(pe(e, o)) || 0), (i[o] = n + t[o] - r[o]));
              pe(e, i);
            })(e, t);
          },
          isWindow: se,
          each: ne,
          css: pe,
          clone: function (e) {
            var t = {};
            for (var n in e) e.hasOwnProperty(n) && (t[n] = e[n]);
            if (e.overflow)
              for (var o in e)
                e.hasOwnProperty(o) && (t.overflow[o] = e.overflow[o]);
            return t;
          },
          scrollLeft: function (e, t) {
            if (se(e)) {
              if (void 0 === t) return $(e);
              window.scrollTo(t, q(e));
            } else {
              if (void 0 === t) return e.scrollLeft;
              e.scrollLeft = t;
            }
          },
          scrollTop: function (e, t) {
            if (se(e)) {
              if (void 0 === t) return q(e);
              window.scrollTo($(e), t);
            } else {
              if (void 0 === t) return e.scrollTop;
              e.scrollTop = t;
            }
          },
          viewportWidth: 0,
          viewportHeight: 0,
        },
        ae,
      );
      function fe() {
        try {
          var e = !Boolean.prototype.valueOf.call(
            Reflect.construct(Boolean, [], function () {}),
          );
        } catch (e) {}
        return (fe = function () {
          return !!e;
        })();
      }
      var he = (function (e) {
        function t() {
          var e, n, o, r;
          return (
            f(this, t),
            (n = this),
            (r = arguments),
            (o = y((o = t))),
            ((e = v(
              n,
              fe()
                ? Reflect.construct(o, r || [], y(n).constructor)
                : o.apply(n, r),
            )).handleMouseDown = e.handleMouseDown.bind(e)),
            (e.bindList = e.bindList.bind(e)),
            e
          );
        }
        return (
          b(t, e),
          g(t, [
            {
              key: "componentDidUpdate",
              value: function () {
                var e = this;
                this.props.selectedIndex > -1 &&
                  this.props.scrollIntoView &&
                  ((this.scrollingIntoView = !0),
                  (function (e, t, n) {
                    (n = n || {}), 9 === t.nodeType && (t = de.getWindow(t));
                    var o = n.allowHorizontalScroll,
                      r = n.onlyScrollIfNeeded,
                      i = n.alignWithTop,
                      s = n.alignWithLeft,
                      a = n.offsetTop || 0,
                      l = n.offsetLeft || 0,
                      u = n.offsetBottom || 0,
                      c = n.offsetRight || 0;
                    o = void 0 === o || o;
                    var p,
                      d,
                      f,
                      h,
                      g,
                      v,
                      y,
                      m,
                      b,
                      w,
                      k = de.isWindow(t),
                      S = de.offset(e),
                      x = de.outerHeight(e),
                      T = de.outerWidth(e);
                    k
                      ? ((y = t),
                        (w = de.height(y)),
                        (b = de.width(y)),
                        (m = { left: de.scrollLeft(y), top: de.scrollTop(y) }),
                        (g = {
                          left: S.left - m.left - l,
                          top: S.top - m.top - a,
                        }),
                        (v = {
                          left: S.left + T - (m.left + b) + c,
                          top: S.top + x - (m.top + w) + u,
                        }),
                        (h = m))
                      : ((p = de.offset(t)),
                        (d = t.clientHeight),
                        (f = t.clientWidth),
                        (h = { left: t.scrollLeft, top: t.scrollTop }),
                        (g = {
                          left:
                            S.left -
                            (p.left +
                              (parseFloat(de.css(t, "borderLeftWidth")) || 0)) -
                            l,
                          top:
                            S.top -
                            (p.top +
                              (parseFloat(de.css(t, "borderTopWidth")) || 0)) -
                            a,
                        }),
                        (v = {
                          left:
                            S.left +
                            T -
                            (p.left +
                              f +
                              (parseFloat(de.css(t, "borderRightWidth")) ||
                                0)) +
                            c,
                          top:
                            S.top +
                            x -
                            (p.top +
                              d +
                              (parseFloat(de.css(t, "borderBottomWidth")) ||
                                0)) +
                            u,
                        })),
                      g.top < 0 || v.top > 0
                        ? !0 === i
                          ? de.scrollTop(t, h.top + g.top)
                          : !1 === i
                            ? de.scrollTop(t, h.top + v.top)
                            : g.top < 0
                              ? de.scrollTop(t, h.top + g.top)
                              : de.scrollTop(t, h.top + v.top)
                        : r ||
                          ((i = void 0 === i || !!i)
                            ? de.scrollTop(t, h.top + g.top)
                            : de.scrollTop(t, h.top + v.top)),
                      o &&
                        (g.left < 0 || v.left > 0
                          ? !0 === s
                            ? de.scrollLeft(t, h.left + g.left)
                            : !1 === s
                              ? de.scrollLeft(t, h.left + v.left)
                              : g.left < 0
                                ? de.scrollLeft(t, h.left + g.left)
                                : de.scrollLeft(t, h.left + v.left)
                          : r ||
                            ((s = void 0 === s || !!s)
                              ? de.scrollLeft(t, h.left + g.left)
                              : de.scrollLeft(t, h.left + v.left)));
                  })(this.list.children[this.props.selectedIndex], this.list, {
                    onlyScrollIfNeeded: !0,
                  }),
                  this.props.setTimeout(function () {
                    e.scrollingIntoView = !1;
                  }, 100));
              },
            },
            {
              key: "bindList",
              value: function (e) {
                this.list = e;
              },
            },
            {
              key: "handleHover",
              value: function (e) {
                var t = this;
                return function () {
                  t.scrollingIntoView || t.props.onHover(e);
                };
              },
            },
            {
              key: "handleClick",
              value: function (e) {
                var t = this;
                return function () {
                  t.props.onSelect(e);
                };
              },
            },
            {
              key: "handleMouseDown",
              value: function (e) {
                e.preventDefault();
              },
            },
            {
              key: "computeSuggestionMatch",
              value: function (e) {
                var t = this.props
                  .displayTransform(this.props.match || "")
                  .toLocaleLowerCase();
                if (0 === t.length) return null;
                var n = (e = this.props.displayTransform(e))
                  .toLocaleLowerCase()
                  .indexOf(t);
                return {
                  suggestionBeforeMatch: e.substring(0, n),
                  suggestionMatch: e.substring(n, n + t.length),
                  suggestionAfterMatch: e.substring(n + t.length),
                };
              },
            },
            {
              key: "render",
              value: function () {
                var e = this;
                return (0, x.jsx)("ul", {
                  ref: this.bindList,
                  className: "components-form-token-field__suggestions-list",
                  id: "components-form-token-suggestions-".concat(
                    this.props.instanceId,
                  ),
                  role: "listbox",
                  children: (0, S.map)(this.props.suggestions, function (t, n) {
                    var o = e.computeSuggestionMatch(t),
                      r = P()("components-form-token-field__suggestion", {
                        "is-selected": n === e.props.selectedIndex,
                      });
                    return (0, x.jsx)(
                      "li",
                      {
                        id: "components-form-token-suggestions-"
                          .concat(e.props.instanceId, "-")
                          .concat(n),
                        role: "option",
                        className: r,
                        onMouseDown: e.handleMouseDown,
                        onClick: e.handleClick(t),
                        onMouseEnter: e.handleHover(t),
                        "aria-selected": n === e.props.selectedIndex,
                        children: o
                          ? (0, x.jsxs)("span", {
                              "aria-label": e.props.displayTransform(t),
                              children: [
                                o.suggestionBeforeMatch,
                                (0, x.jsx)("strong", {
                                  className:
                                    "components-form-token-field__suggestion-match",
                                  children: o.suggestionMatch,
                                }),
                                o.suggestionAfterMatch,
                              ],
                            })
                          : e.props.displayTransform(t),
                      },
                      e.props.displayTransform(t),
                    );
                  }),
                });
              },
            },
          ])
        );
      })(p.Component);
      he.defaultProps = {
        match: "",
        onHover: function () {},
        onSelect: function () {},
        suggestions: Object.freeze([]),
      };
      var ge = (0, E.withSafeTimeout)(he);
      function ve(e, t) {
        var n = Object.keys(e);
        if (Object.getOwnPropertySymbols) {
          var o = Object.getOwnPropertySymbols(e);
          t &&
            (o = o.filter(function (t) {
              return Object.getOwnPropertyDescriptor(e, t).enumerable;
            })),
            n.push.apply(n, o);
        }
        return n;
      }
      function ye(e) {
        for (var t = 1; t < arguments.length; t++) {
          var n = null != arguments[t] ? arguments[t] : {};
          t % 2
            ? ve(Object(n), !0).forEach(function (t) {
                o(e, t, n[t]);
              })
            : Object.getOwnPropertyDescriptors
              ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n))
              : ve(Object(n)).forEach(function (t) {
                  Object.defineProperty(
                    e,
                    t,
                    Object.getOwnPropertyDescriptor(n, t),
                  );
                });
        }
        return e;
      }
      function me() {
        try {
          var e = !Boolean.prototype.valueOf.call(
            Reflect.construct(Boolean, [], function () {}),
          );
        } catch (e) {}
        return (me = function () {
          return !!e;
        })();
      }
      var be = {
          incompleteTokenValue: "",
          inputOffsetFromEnd: 0,
          isActive: !1,
          isExpanded: !1,
          selectedSuggestionIndex: -1,
          selectedSuggestionScroll: !1,
        },
        we = (function (e) {
          function t() {
            var e, n, o, r;
            return (
              f(this, t),
              (n = this),
              (r = arguments),
              (o = y((o = t))),
              ((e = v(
                n,
                me()
                  ? Reflect.construct(o, r || [], y(n).constructor)
                  : o.apply(n, r),
              )).state = be),
              (e.onKeyDown = e.onKeyDown.bind(e)),
              (e.onKeyPress = e.onKeyPress.bind(e)),
              (e.onFocus = e.onFocus.bind(e)),
              (e.onClick = e.onClick.bind(e)),
              (e.onBlur = e.onBlur.bind(e)),
              (e.deleteTokenBeforeInput = e.deleteTokenBeforeInput.bind(e)),
              (e.deleteTokenAfterInput = e.deleteTokenAfterInput.bind(e)),
              (e.addCurrentToken = e.addCurrentToken.bind(e)),
              (e.onContainerTouched = e.onContainerTouched.bind(e)),
              (e.renderToken = e.renderToken.bind(e)),
              (e.onTokenClickRemove = e.onTokenClickRemove.bind(e)),
              (e.onSuggestionHovered = e.onSuggestionHovered.bind(e)),
              (e.onSuggestionSelected = e.onSuggestionSelected.bind(e)),
              (e.onInputChange = e.onInputChange.bind(e)),
              (e.bindInput = e.bindInput.bind(e)),
              (e.bindTokensAndInput = e.bindTokensAndInput.bind(e)),
              (e.updateSuggestions = e.updateSuggestions.bind(e)),
              (e.addNewTokens = e.addNewTokens.bind(e)),
              (e.getValueFromLabel = e.getValueFromLabel.bind(e)),
              (e.getLabelFromValue = e.getLabelFromValue.bind(e)),
              e
            );
          }
          return (
            b(t, e),
            g(
              t,
              [
                {
                  key: "componentDidUpdate",
                  value: function (e) {
                    this.state.isActive &&
                      !this.input.hasFocus() &&
                      this.input.focus();
                    var t = this.props,
                      n = t.options,
                      o = t.value,
                      r = !D()(n, e.options);
                    (r || o !== e.value) && this.updateSuggestions(r);
                  },
                },
                {
                  key: "bindInput",
                  value: function (e) {
                    this.input = e;
                  },
                },
                {
                  key: "bindTokensAndInput",
                  value: function (e) {
                    this.tokensAndInput = e;
                  },
                },
                {
                  key: "onFocus",
                  value: function (e) {
                    this.input.hasFocus() || e.target === this.tokensAndInput
                      ? this.setState({ isActive: !0 })
                      : this.setState({ isActive: !1 }),
                      "function" == typeof this.props.onFocus &&
                        this.props.onFocus(e);
                  },
                },
                {
                  key: "onClick",
                  value: function (e) {
                    e.target.classList.contains(
                      "components-form-token-field__suggestion",
                    ) || this.setState({ isExpanded: !0, isActive: !0 });
                  },
                },
                {
                  key: "onBlur",
                  value: function () {
                    this.inputHasValidToken()
                      ? this.setState({ isActive: !1, isExpanded: !1 })
                      : this.setState(be);
                  },
                },
                {
                  key: "onKeyDown",
                  value: function (e) {
                    var t = !1;
                    switch (e.keyCode) {
                      case L.BACKSPACE:
                        t = this.handleDeleteKey(this.deleteTokenBeforeInput);
                        break;
                      case L.ENTER:
                        t = this.addCurrentToken();
                        break;
                      case L.LEFT:
                        t = this.handleLeftArrowKey();
                        break;
                      case L.UP:
                        t = this.handleUpArrowKey();
                        break;
                      case L.RIGHT:
                        t = this.handleRightArrowKey();
                        break;
                      case L.DOWN:
                        t = this.handleDownArrowKey();
                        break;
                      case L.DELETE:
                        t = this.handleDeleteKey(this.deleteTokenAfterInput);
                        break;
                      case L.SPACE:
                        this.props.tokenizeOnSpace &&
                          (t = this.addCurrentToken());
                        break;
                      case L.ESCAPE:
                        (t = this.handleEscapeKey(e)), e.stopPropagation();
                    }
                    t && e.preventDefault();
                  },
                },
                {
                  key: "onKeyPress",
                  value: function (e) {
                    this.state.isExpanded || this.setState({ isExpanded: !0 });
                  },
                },
                {
                  key: "onContainerTouched",
                  value: function (e) {
                    e.target === this.tokensAndInput &&
                      this.state.isActive &&
                      e.preventDefault();
                  },
                },
                {
                  key: "onTokenClickRemove",
                  value: function (e) {
                    this.deleteToken(e.value), this.input.focus();
                  },
                },
                {
                  key: "onSuggestionHovered",
                  value: function (e) {
                    var t = this.getMatchingSuggestions().indexOf(e);
                    t >= 0 &&
                      this.setState({
                        selectedSuggestionIndex: t,
                        selectedSuggestionScroll: !1,
                      });
                  },
                },
                {
                  key: "onSuggestionSelected",
                  value: function (e) {
                    this.addNewToken(e);
                  },
                },
                {
                  key: "onInputChange",
                  value: function (e) {
                    var t = e.value;
                    this.setState(
                      { incompleteTokenValue: t },
                      this.updateSuggestions,
                    ),
                      this.props.onInputChange(t);
                  },
                },
                {
                  key: "handleDeleteKey",
                  value: function (e) {
                    var t = !1;
                    return (
                      this.input.hasFocus() &&
                        this.isInputEmpty() &&
                        (e(), (t = !0)),
                      t
                    );
                  },
                },
                {
                  key: "handleLeftArrowKey",
                  value: function () {
                    var e = !1;
                    return (
                      this.isInputEmpty() &&
                        (this.moveInputBeforePreviousToken(), (e = !0)),
                      e
                    );
                  },
                },
                {
                  key: "handleRightArrowKey",
                  value: function () {
                    var e = !1;
                    return (
                      this.isInputEmpty() &&
                        (this.moveInputAfterNextToken(), (e = !0)),
                      e
                    );
                  },
                },
                {
                  key: "getOptionsLabels",
                  value: function (e) {
                    return e.map(function (e) {
                      return e.label;
                    });
                  },
                },
                {
                  key: "getValueFromLabel",
                  value: function (e) {
                    var t = this.props.options.find(function (t) {
                      return (
                        t.label.toLocaleLowerCase() === e.toLocaleLowerCase()
                      );
                    });
                    return t ? t.value : null;
                  },
                },
                {
                  key: "getLabelFromValue",
                  value: function (e) {
                    var t = this.props.options.find(function (t) {
                      return t.value === e;
                    });
                    return t ? t.label : null;
                  },
                },
                {
                  key: "getOptionsValues",
                  value: function (e) {
                    return e.map(function (e) {
                      return e.value;
                    });
                  },
                },
                {
                  key: "handleUpArrowKey",
                  value: function () {
                    var e = this;
                    return (
                      this.setState(function (t, n) {
                        return {
                          selectedSuggestionIndex:
                            (0 === t.selectedSuggestionIndex
                              ? e.getMatchingSuggestions(
                                  t.incompleteTokenValue,
                                  e.getOptionsLabels(n.options),
                                  n.value,
                                  n.maxSuggestions,
                                  n.saveTransform,
                                ).length
                              : t.selectedSuggestionIndex) - 1,
                          selectedSuggestionScroll: !0,
                        };
                      }),
                      !0
                    );
                  },
                },
                {
                  key: "handleDownArrowKey",
                  value: function () {
                    var e = this;
                    return (
                      this.setState(function (t, n) {
                        return {
                          selectedSuggestionIndex:
                            (t.selectedSuggestionIndex + 1) %
                            e.getMatchingSuggestions(
                              t.incompleteTokenValue,
                              e.getOptionsLabels(n.options),
                              n.value,
                              n.maxSuggestions,
                              n.saveTransform,
                            ).length,
                          selectedSuggestionScroll: !0,
                          isExpanded: !0,
                        };
                      }),
                      !0
                    );
                  },
                },
                {
                  key: "handleEscapeKey",
                  value: function (e) {
                    return (
                      this.setState({
                        incompleteTokenValue: e.target.value,
                        isExpanded: !1,
                        selectedSuggestionIndex: -1,
                        selectedSuggestionScroll: !1,
                      }),
                      !0
                    );
                  },
                },
                {
                  key: "moveInputToIndex",
                  value: function (e) {
                    this.setState(function (t, n) {
                      return {
                        inputOffsetFromEnd:
                          n.value.length - Math.max(e, -1) - 1,
                      };
                    });
                  },
                },
                {
                  key: "moveInputBeforePreviousToken",
                  value: function () {
                    this.setState(function (e, t) {
                      return {
                        inputOffsetFromEnd: Math.min(
                          e.inputOffsetFromEnd + 1,
                          t.value.length,
                        ),
                      };
                    });
                  },
                },
                {
                  key: "moveInputAfterNextToken",
                  value: function () {
                    this.setState(function (e) {
                      return {
                        inputOffsetFromEnd: Math.max(
                          e.inputOffsetFromEnd - 1,
                          0,
                        ),
                      };
                    });
                  },
                },
                {
                  key: "deleteTokenBeforeInput",
                  value: function () {
                    var e = this.getIndexOfInput() - 1;
                    e > -1 && this.deleteToken(this.props.value[e]);
                  },
                },
                {
                  key: "deleteTokenAfterInput",
                  value: function () {
                    var e = this.getIndexOfInput();
                    e < this.props.value.length &&
                      (this.deleteToken(this.props.value[e]),
                      this.moveInputToIndex(e));
                  },
                },
                {
                  key: "addCurrentToken",
                  value: function () {
                    var e = !1,
                      t = this.getSelectedSuggestion();
                    return (
                      t
                        ? (this.addNewToken(t), (e = !0))
                        : this.inputHasValidToken() &&
                          (this.addNewToken(this.state.incompleteTokenValue),
                          (e = !0)),
                      e
                    );
                  },
                },
                {
                  key: "addNewTokens",
                  value: function (e) {
                    var t = this,
                      n = (0, S.uniq)(
                        e
                          .map(this.props.saveTransform)
                          .filter(Boolean)
                          .filter(function (e) {
                            return !t.valueContainsToken(e);
                          }),
                      );
                    if (n.length > 0) {
                      var o = n.map(function (e) {
                          return t.getValueFromLabel(e);
                        }),
                        r = (0, S.clone)(this.props.value);
                      r.splice.apply(r, [this.getIndexOfInput(), 0].concat(o)),
                        (r = w(new Set(r))),
                        this.props.onChange(r);
                    }
                  },
                },
                {
                  key: "addNewToken",
                  value: function (e) {
                    this.addNewTokens([e]),
                      this.props.speak(this.props.messages.added, "assertive"),
                      this.setState({
                        incompleteTokenValue: "",
                        selectedSuggestionIndex: -1,
                        selectedSuggestionScroll: !1,
                        isExpanded: !1,
                      }),
                      this.state.isActive && this.input.focus();
                  },
                },
                {
                  key: "deleteToken",
                  value: function (e) {
                    var t = this,
                      n = this.props.value.filter(function (n) {
                        return t.getTokenValue(n) !== t.getTokenValue(e);
                      });
                    this.props.onChange(n),
                      this.props.speak(
                        this.props.messages.removed,
                        "assertive",
                      );
                  },
                },
                {
                  key: "getTokenValue",
                  value: function (e) {
                    return e && e.value ? e.value : e;
                  },
                },
                {
                  key: "getMatchingSuggestions",
                  value: function () {
                    var e = this,
                      t =
                        arguments.length > 0 && void 0 !== arguments[0]
                          ? arguments[0]
                          : this.state.incompleteTokenValue,
                      n =
                        arguments.length > 1 && void 0 !== arguments[1]
                          ? arguments[1]
                          : this.getOptionsLabels(this.props.options),
                      o =
                        arguments.length > 2 && void 0 !== arguments[2]
                          ? arguments[2]
                          : this.props.value,
                      r =
                        arguments.length > 3 && void 0 !== arguments[3]
                          ? arguments[3]
                          : this.props.maxSuggestions,
                      i = (
                        arguments.length > 4 && void 0 !== arguments[4]
                          ? arguments[4]
                          : this.props.saveTransform
                      )(t),
                      s = [],
                      a = [],
                      l = o.map(function (t) {
                        return e.getLabelFromValue(t);
                      });
                    return (
                      i.length > 0 &&
                        ((i = i.toLocaleLowerCase()),
                        (0, S.each)(n, function (e) {
                          var t = e.toLocaleLowerCase().indexOf(i);
                          -1 === o.indexOf(e) &&
                            (0 === t ? s.push(e) : t > 0 && a.push(e));
                        }),
                        (n = s.concat(a))),
                      (n = (0, S.difference)(n, l)),
                      (0, S.take)(n, r)
                    );
                  },
                },
                {
                  key: "getSelectedSuggestion",
                  value: function () {
                    if (-1 !== this.state.selectedSuggestionIndex)
                      return this.getMatchingSuggestions()[
                        this.state.selectedSuggestionIndex
                      ];
                  },
                },
                {
                  key: "valueContainsToken",
                  value: function (e) {
                    var t = this;
                    return (0, S.some)(this.props.value, function (n) {
                      return t.getTokenValue(e) === t.getTokenValue(n);
                    });
                  },
                },
                {
                  key: "getIndexOfInput",
                  value: function () {
                    return (
                      this.props.value.length - this.state.inputOffsetFromEnd
                    );
                  },
                },
                {
                  key: "isInputEmpty",
                  value: function () {
                    return 0 === this.state.incompleteTokenValue.length;
                  },
                },
                {
                  key: "inputHasValidToken",
                  value: function () {
                    var e = this.state.incompleteTokenValue,
                      t = !1;
                    return (
                      e &&
                        e.length > 0 &&
                        this.props.options.forEach(function (n) {
                          n.label.trim().toLocaleLowerCase() ===
                            e.trim().toLocaleLowerCase() && (t = !0);
                        }),
                      t
                    );
                  },
                },
                {
                  key: "updateSuggestions",
                  value: function () {
                    var e =
                        !(arguments.length > 0 && void 0 !== arguments[0]) ||
                        arguments[0],
                      t = this.state.incompleteTokenValue,
                      n = this.getMatchingSuggestions(t),
                      o = n.length > 0,
                      r = {};
                    e &&
                      ((r.selectedSuggestionIndex = -1),
                      (r.selectedSuggestionScroll = !1)),
                      this.setState(r),
                      (0, this.props.debouncedSpeak)(
                        o
                          ? (0, c.sprintf)(
                              /* translators: %d: number of results. */ /* translators: %d: number of results. */
                              (0, c._n)(
                                "%d result found, use up and down arrow keys to navigate.",
                                "%d results found, use up and down arrow keys to navigate.",
                                n.length,
                              ),
                              n.length,
                            )
                          : (0, c.__)("No results."),
                        "assertive",
                      );
                  },
                },
                {
                  key: "renderTokensAndInput",
                  value: function () {
                    var e = (0, S.map)(this.props.value, this.renderToken);
                    return (
                      e.splice(this.getIndexOfInput(), 0, this.renderInput()), e
                    );
                  },
                },
                {
                  key: "renderToken",
                  value: function (e, t, n) {
                    var o = this.getTokenValue(e),
                      r = this.getLabelFromValue(o),
                      i = e.status ? e.status : void 0,
                      s = t + 1,
                      a = n.length;
                    return (0, x.jsx)(
                      V,
                      {
                        value: o,
                        label: r,
                        status: i,
                        title: e.title,
                        displayTransform: this.props.displayTransform,
                        onClickRemove: this.onTokenClickRemove,
                        isBorderless: e.isBorderless || this.props.isBorderless,
                        onMouseEnter: e.onMouseEnter,
                        onMouseLeave: e.onMouseLeave,
                        disabled: "error" !== i && this.props.disabled,
                        messages: this.props.messages,
                        termsCount: a,
                        termPosition: s,
                      },
                      "token-" + o,
                    );
                  },
                },
                {
                  key: "renderInput",
                  value: function () {
                    var e = this.props,
                      t = e.autoCapitalize,
                      n = e.autoComplete,
                      o = e.maxLength,
                      r = e.value,
                      i = {
                        instanceId: e.instanceId,
                        autoCapitalize: t,
                        autoComplete: n,
                        ref: this.bindInput,
                        key: "input",
                        disabled: this.props.disabled,
                        value: this.state.incompleteTokenValue,
                        onBlur: this.onBlur,
                        isExpanded: this.state.isExpanded,
                        selectedSuggestionIndex:
                          this.state.selectedSuggestionIndex,
                      };
                    return (
                      (o && r.length >= o) ||
                        (i = ye(
                          ye({}, i),
                          {},
                          { onChange: this.onInputChange },
                        )),
                      (0, x.jsx)(H, ye({}, i))
                    );
                  },
                },
                {
                  key: "render",
                  value: function () {
                    var e = this.props,
                      t = e.disabled,
                      n = e.label,
                      o = void 0 === n ? (0, c.__)("Add item") : n,
                      r = e.instanceId,
                      i = e.className,
                      s = this.state.isExpanded,
                      a = P()(
                        i,
                        "components-form-token-field__input-container",
                        { "is-active": this.state.isActive, "is-disabled": t },
                      ),
                      l = {
                        className:
                          "components-form-token-field directorist-gb-multiselect",
                        tabIndex: "-1",
                      },
                      u = this.getMatchingSuggestions();
                    return (
                      t ||
                        (l = Object.assign({}, l, {
                          onKeyDown: this.onKeyDown,
                          onKeyPress: this.onKeyPress,
                          onFocus: this.onFocus,
                          onClick: this.onClick,
                        })),
                      (0, x.jsxs)(
                        "div",
                        ye(
                          ye({}, l),
                          {},
                          {
                            children: [
                              (0, x.jsx)("label", {
                                htmlFor: "components-form-token-input-".concat(
                                  r,
                                ),
                                className: "components-form-token-field__label",
                                style: { fontSize: "13px" },
                                children: o,
                              }),
                              (0, x.jsxs)("div", {
                                ref: this.bindTokensAndInput,
                                className: a,
                                tabIndex: "-1",
                                onMouseDown: this.onContainerTouched,
                                onTouchStart: this.onContainerTouched,
                                children: [
                                  this.renderTokensAndInput(),
                                  s &&
                                    (0, x.jsx)(ge, {
                                      instanceId: r,
                                      match: this.props.saveTransform(
                                        this.state.incompleteTokenValue,
                                      ),
                                      displayTransform:
                                        this.props.displayTransform,
                                      suggestions: u,
                                      selectedIndex:
                                        this.state.selectedSuggestionIndex,
                                      scrollIntoView:
                                        this.state.selectedSuggestionScroll,
                                      onHover: this.onSuggestionHovered,
                                      onSelect: this.onSuggestionSelected,
                                    }),
                                ],
                              }),
                            ],
                          },
                        ),
                      )
                    );
                  },
                },
              ],
              [
                {
                  key: "getDerivedStateFromProps",
                  value: function (e, t) {
                    return e.disabled && t.isActive
                      ? { isActive: !1, incompleteTokenValue: "" }
                      : null;
                  },
                },
              ],
            )
          );
        })(p.Component);
      we.defaultProps = {
        options: Object.freeze([]),
        maxSuggestions: 100,
        value: Object.freeze([]),
        displayTransform: S.identity,
        saveTransform: function (e) {
          return e ? e.trim() : "";
        },
        onChange: function () {},
        onInputChange: function () {},
        isBorderless: !1,
        disabled: !1,
        tokenizeOnSpace: !1,
        messages: {
          added: (0, c.__)("Item added."),
          removed: (0, c.__)("Item removed."),
          remove: (0, c.__)("Remove item"),
        },
      };
      var ke = (0, d.withSpokenMessages)((0, E.withInstanceId)(we)),
        Se = window.wp.apiFetch,
        xe = n.n(Se);
      function Te(e, t, n) {
        return (
          (t = y(t)),
          v(
            e,
            Oe()
              ? Reflect.construct(t, n || [], y(e).constructor)
              : t.apply(e, n),
          )
        );
      }
      function Oe() {
        try {
          var e = !Boolean.prototype.valueOf.call(
            Reflect.construct(Boolean, [], function () {}),
          );
        } catch (e) {}
        return (Oe = function () {
          return !!e;
        })();
      }
      var je = directoristBlockConfig,
        Ie =
          (je.categoryTax, je.locationTax, je.postType, je.tagTax, je.typeTax),
        Ce = (0, k.withSelect)(function (e) {
          return {
            items: e("core").getEntityRecords("taxonomy", Ie, {
              per_page: -1,
              order: "asc",
              orderby: "name",
            }),
          };
        })(function (e) {
          var t = [],
            n = [];
          return (
            e.items
              ? ((t = (
                  e.shouldRender
                    ? (function () {
                        var e =
                            arguments.length > 0 && void 0 !== arguments[0]
                              ? arguments[0]
                              : [],
                          t =
                            arguments.length > 1 && void 0 !== arguments[1]
                              ? arguments[1]
                              : [],
                          n =
                            arguments.length > 2 && void 0 !== arguments[2]
                              ? arguments[2]
                              : "id",
                          o = function (e) {
                            return t.includes(e[n]);
                          };
                        return (
                          e.sort(function (e, t) {
                            var n = o(e),
                              r = o(t);
                            return n === r ? 0 : n && !r ? -1 : !n && r ? 1 : 0;
                          }),
                          e
                        );
                      })(e.items, e.selected, "slug")
                    : e.items
                ).map(function (t) {
                  return (0, x.jsx)(
                    "li",
                    {
                      children: (0, x.jsx)(d.CheckboxControl, {
                        label: (0, S.truncate)(I(t.name), { length: 30 }),
                        checked: e.selected.includes(t.slug),
                        onChange: function (n) {
                          var o = n
                            ? [].concat(w(e.selected), [t.slug])
                            : (0, S.without)(e.selected, t.slug);
                          e.onChange(o);
                        },
                      }),
                    },
                    t.id,
                  );
                })),
                e.showDefault &&
                  (n = (
                    e.selected.length > 0
                      ? e.items.filter(function (t) {
                          return e.selected.includes(t.slug);
                        })
                      : e.items
                  ).map(function (e) {
                    return {
                      label: (0, S.truncate)(I(e.name), { length: 30 }),
                      value: e.slug,
                    };
                  })))
              : (t = [
                  (0, x.jsx)("li", { children: (0, x.jsx)(d.Spinner, {}) }),
                ]),
            (0, x.jsxs)(p.Fragment, {
              children: [
                (0, x.jsx)(d.BaseControl, {
                  label: (0, c.__)("Directory Types", "directorist"),
                  className: "directorist-gb-cb-list-control",
                  children: (0, x.jsx)("ul", {
                    className:
                      "editor-post-taxonomies__hierarchical-terms-list",
                    children: t,
                  }),
                }),
                n.length && e.showDefault
                  ? (0, x.jsx)(d.RadioControl, {
                      label: (0, c.__)(
                        "Select Default Directory",
                        "directorist",
                      ),
                      selected: e.defaultType
                        ? e.defaultType
                        : window.directorist.default_directory_type,
                      options: n,
                      onChange: e.onDefaultChange,
                    })
                  : "",
              ],
            })
          );
        }),
        Pe = (function (e) {
          function t(e) {
            var n;
            return (
              f(this, t),
              ((n = Te(this, t, [e])).state = {
                options: [],
                value: n.props.value,
                isLoading: !0,
              }),
              n
            );
          }
          return (
            b(t, e),
            g(
              t,
              [
                {
                  key: "render",
                  value: function () {
                    var e = this;
                    return this.state.isLoading
                      ? (0, x.jsx)(d.BaseControl, {
                          label: this.props.label,
                          children: (0, x.jsx)(d.Spinner, {}),
                        })
                      : (0, x.jsx)(ke, {
                          maxSuggestions: 10,
                          label: this.props.label,
                          value: this.state.value,
                          options: this.state.options,
                          onChange: function (t) {
                            e.setState({ value: t, isLoading: !1 }),
                              e.props.onChange(t);
                          },
                          onInputChange: function (t) {
                            xe()({
                              path: "wp/v2/"
                                .concat(
                                  e.props.taxonomy,
                                  "?per_page=10&search=",
                                )
                                .concat(t),
                            }).then(function (t) {
                              var n = O(t);
                              e.setState({ options: n });
                            });
                          },
                        });
                  },
                },
              ],
              [
                {
                  key: "getDerivedStateFromProps",
                  value: function (e, t) {
                    return (0, S.isEmpty)(e.options) &&
                      (0, S.isEmpty)(t.options)
                      ? null
                      : {
                          options: (0, S.uniqBy)(
                            t.options.concat(e.options),
                            "value",
                          ),
                          isLoading: !1,
                        };
                  },
                },
              ],
            )
          );
        })(p.Component),
        Ee =
          ((0, k.withSelect)(function (e, t) {
            var n = { per_page: 10, order: "asc", orderby: "name" };
            (0, S.isEmpty)(t.value) ||
              ((n.slug = t.value),
              (n.orderby = "include_slugs"),
              (n.per_page = t.value.length));
            var o = e("core").getEntityRecords("taxonomy", t.taxonomy, n);
            return { options: (0, S.isEmpty)(o) ? [] : O(o) };
          })(Pe),
          (function (e) {
            function t(e) {
              var n;
              return (
                f(this, t),
                ((n = Te(this, t, [e])).state = {
                  options: [],
                  value: n.props.value,
                  isLoading: !0,
                }),
                n
              );
            }
            return (
              b(t, e),
              g(
                t,
                [
                  {
                    key: "render",
                    value: function () {
                      var e = this;
                      return this.state.isLoading
                        ? (0, x.jsx)(d.BaseControl, {
                            label: this.props.label,
                            children: (0, x.jsx)(d.Spinner, {}),
                          })
                        : (0, x.jsx)(ke, {
                            maxSuggestions: 10,
                            label: this.props.label,
                            value: this.state.value,
                            options: this.state.options,
                            onChange: function (t) {
                              e.setState({ value: t, isLoading: !1 }),
                                e.props.onChange(t);
                            },
                            onInputChange: function (t) {
                              xe()({
                                path: "wp/v2/"
                                  .concat(
                                    e.props.postType,
                                    "?per_page=10&search=",
                                  )
                                  .concat(t),
                              }).then(function (t) {
                                var n = j(t);
                                e.setState({ options: n });
                              });
                            },
                          });
                    },
                  },
                ],
                [
                  {
                    key: "getDerivedStateFromProps",
                    value: function (e, t) {
                      return (0, S.isEmpty)(e.options) &&
                        (0, S.isEmpty)(t.options)
                        ? null
                        : {
                            options: (0, S.uniqBy)(
                              t.options.concat(e.options),
                              "value",
                            ),
                            isLoading: !1,
                          };
                    },
                  },
                ],
              )
            );
          })(p.Component)),
        Le =
          ((0, k.withSelect)(function (e, t) {
            var n = { per_page: 10, order: "desc", orderby: "date" };
            (0, S.isEmpty)(t.value) ||
              ((n.include = t.value),
              (n.orderby = "include"),
              (n.per_page = t.value.length));
            var o = e("core").getEntityRecords("postType", t.postType, n);
            return { options: (0, S.isEmpty)(o) ? [] : j(o) };
          })(Ee),
          JSON.parse('{"UU":"directorist/add-listing"}'));
      function _e(e, t) {
        var n = Object.keys(e);
        if (Object.getOwnPropertySymbols) {
          var o = Object.getOwnPropertySymbols(e);
          t &&
            (o = o.filter(function (t) {
              return Object.getOwnPropertyDescriptor(e, t).enumerable;
            })),
            n.push.apply(n, o);
        }
        return n;
      }
      function De(e) {
        for (var t = 1; t < arguments.length; t++) {
          var n = null != arguments[t] ? arguments[t] : {};
          t % 2
            ? _e(Object(n), !0).forEach(function (t) {
                o(e, t, n[t]);
              })
            : Object.getOwnPropertyDescriptors
              ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n))
              : _e(Object(n)).forEach(function (t) {
                  Object.defineProperty(
                    e,
                    t,
                    Object.getOwnPropertyDescriptor(n, t),
                  );
                });
        }
        return e;
      }
      var Ae = function () {
        return (function (e) {
          var t =
            arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
          return (0, x.jsx)("div", {
            className: "directorist-container",
            children: t
              ? T()
              : (0, x.jsx)("img", {
                  style: { display: "block", width: "100%", height: "auto" },
                  className: "directorist-block-preview",
                  src: ""
                    .concat(directoristBlockConfig.previewUrl, "preview/")
                    .concat(e, ".svg"),
                  alt: "Placeholder for ".concat(e),
                }),
          });
        })("add-listing");
      };
      (0, s.registerBlockType)(Le.UU, {
        icon: T(),
        transforms: {
          from: [
            {
              type: "shortcode",
              tag: "directorist_add_listing",
              attributes: {},
            },
          ],
        },
        edit: function (e) {
          var t,
            n,
            o = e.attributes,
            r = e.setAttributes,
            s =
              ((t = (0, p.useState)(!0)),
              (n = 2),
              (function (e) {
                if (Array.isArray(e)) return e;
              })(t) ||
                (function (e, t) {
                  var n =
                    null == e
                      ? null
                      : ("undefined" != typeof Symbol && e[Symbol.iterator]) ||
                        e["@@iterator"];
                  if (null != n) {
                    var o,
                      r,
                      i,
                      s,
                      a = [],
                      l = !0,
                      u = !1;
                    try {
                      if (((i = (n = n.call(e)).next), 0 === t)) {
                        if (Object(n) !== n) return;
                        l = !1;
                      } else
                        for (
                          ;
                          !(l = (o = i.call(n)).done) &&
                          (a.push(o.value), a.length !== t);
                          l = !0
                        );
                    } catch (e) {
                      (u = !0), (r = e);
                    } finally {
                      try {
                        if (
                          !l &&
                          null != n.return &&
                          ((s = n.return()), Object(s) !== s)
                        )
                          return;
                      } finally {
                        if (u) throw r;
                      }
                    }
                    return a;
                  }
                })(t, n) ||
                i(t, n) ||
                (function () {
                  throw new TypeError(
                    "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.",
                  );
                })()),
            l = s[0],
            f = s[1],
            h = o.directory_type ? o.directory_type.split(",") : [];
          return (0, x.jsxs)(p.Fragment, {
            children: [
              !!directoristBlockConfig.multiDirectoryEnabled &&
                (0, x.jsx)(a.InspectorControls, {
                  children: (0, x.jsx)(d.PanelBody, {
                    title: (0, c.__)("General", "directorist"),
                    initialOpen: !0,
                    children: (0, x.jsx)(Ce, {
                      shouldRender: l,
                      selected: h,
                      showDefault: !1,
                      onChange: function (e) {
                        r({ directory_type: e.join(",") }), f(!1);
                      },
                    }),
                  }),
                }),
              (0, x.jsx)(
                "div",
                De(
                  De(
                    {},
                    (0, a.useBlockProps)({
                      className: "directorist-content-active directorist-w-100",
                    }),
                  ),
                  {},
                  {
                    children: (0, x.jsx)(u(), {
                      block: Le.UU,
                      attributes: o,
                      LoadingResponsePlaceholder: Ae,
                    }),
                  },
                ),
              ),
            ],
          });
        },
      });
    })();
})();
