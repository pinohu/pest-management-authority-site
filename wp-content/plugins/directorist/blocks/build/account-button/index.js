!(function () {
  "use strict";
  var e,
    t = {
      552: function () {
        var e = window.wp.blocks,
          t = window.wp.i18n;
        function r(e, t) {
          (null == t || t > e.length) && (t = e.length);
          for (var r = 0, n = Array(t); r < t; r++) n[r] = e[r];
          return n;
        }
        function n(e) {
          return (
            (n =
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
            n(e)
          );
        }
        function o(e, t, r) {
          return (
            (t = (function (e) {
              var t = (function (e) {
                if ("object" != n(e) || !e) return e;
                var t = e[Symbol.toPrimitive];
                if (void 0 !== t) {
                  var r = t.call(e, "string");
                  if ("object" != n(r)) return r;
                  throw new TypeError(
                    "@@toPrimitive must return a primitive value.",
                  );
                }
                return String(e);
              })(e);
              return "symbol" == n(t) ? t : t + "";
            })(t)) in e
              ? Object.defineProperty(e, t, {
                  value: r,
                  enumerable: !0,
                  configurable: !0,
                  writable: !0,
                })
              : (e[t] = r),
            e
          );
        }
        function i(e) {
          var t,
            r,
            n = "";
          if ("string" == typeof e || "number" == typeof e) n += e;
          else if ("object" == typeof e)
            if (Array.isArray(e)) {
              var o = e.length;
              for (t = 0; t < o; t++)
                e[t] && (r = i(e[t])) && (n && (n += " "), (n += r));
            } else for (r in e) e[r] && (n && (n += " "), (n += r));
          return n;
        }
        var l = function () {
            for (var e, t, r = 0, n = "", o = arguments.length; r < o; r++)
              (e = arguments[r]) && (t = i(e)) && (n && (n += " "), (n += t));
            return n;
          },
          s = window.wp.element,
          c = window.wp.components,
          a = window.wp.blockEditor,
          u = window.wp.keycodes,
          f = window.wp.compose,
          p = window.wp.data,
          d = window.ReactJSXRuntime;
        function y(e, t) {
          var r = Object.keys(e);
          if (Object.getOwnPropertySymbols) {
            var n = Object.getOwnPropertySymbols(e);
            t &&
              (n = n.filter(function (t) {
                return Object.getOwnPropertyDescriptor(e, t).enumerable;
              })),
              r.push.apply(r, n);
          }
          return r;
        }
        function b(e) {
          for (var t = 1; t < arguments.length; t++) {
            var r = null != arguments[t] ? arguments[t] : {};
            t % 2
              ? y(Object(r), !0).forEach(function (t) {
                  o(e, t, r[t]);
                })
              : Object.getOwnPropertyDescriptors
                ? Object.defineProperties(
                    e,
                    Object.getOwnPropertyDescriptors(r),
                  )
                : y(Object(r)).forEach(function (t) {
                    Object.defineProperty(
                      e,
                      t,
                      Object.getOwnPropertyDescriptor(r, t),
                    );
                  });
          }
          return e;
        }
        function v(e) {
          return e.toString().replace(/<\/?a[^>]*>/g, "");
        }
        function h(e) {
          var r = e.selectedWidth,
            n = e.setAttributes;
          return (0, d.jsx)(c.ButtonGroup, {
            "aria-label": (0, t.__)("Button width"),
            children: [25, 50, 75, 100].map(function (e) {
              return (0, d.jsxs)(
                c.Button,
                {
                  size: "small",
                  variant: e === r ? "primary" : void 0,
                  onClick: function () {
                    var t;
                    n({ width: r === (t = e) ? void 0 : t });
                  },
                  children: [e, "%"],
                },
                e,
              );
            }),
          });
        }
        function m(e, t) {
          var r = Object.keys(e);
          if (Object.getOwnPropertySymbols) {
            var n = Object.getOwnPropertySymbols(e);
            t &&
              (n = n.filter(function (t) {
                return Object.getOwnPropertyDescriptor(e, t).enumerable;
              })),
              r.push.apply(r, n);
          }
          return r;
        }
        function w(e) {
          for (var t = 1; t < arguments.length; t++) {
            var r = null != arguments[t] ? arguments[t] : {};
            t % 2
              ? m(Object(r), !0).forEach(function (t) {
                  o(e, t, r[t]);
                })
              : Object.getOwnPropertyDescriptors
                ? Object.defineProperties(
                    e,
                    Object.getOwnPropertyDescriptors(r),
                  )
                : m(Object(r)).forEach(function (t) {
                    Object.defineProperty(
                      e,
                      t,
                      Object.getOwnPropertyDescriptor(r, t),
                    );
                  });
          }
          return e;
        }
        var g = JSON.parse('{"UU":"directorist/account-button"}');
        (0, e.registerBlockType)(g.UU, {
          icon: (0, d.jsxs)("svg", {
            xmlns: "http://www.w3.org/2000/svg",
            viewBox: "0 0 222 221.7",
            children: [
              (0, d.jsxs)("linearGradient", {
                id: "SVGID_1_111111",
                gradientUnits: "userSpaceOnUse",
                x1: "81.4946",
                y1: "2852.0237",
                x2: "188.5188",
                y2: "2660.0842",
                gradientTransform: "translate(0 -2658.8872)",
                children: [
                  (0, d.jsx)("stop", { offset: "0", "stop-color": "#2ae498" }),
                  (0, d.jsx)("stop", {
                    offset: ".01117462",
                    "stop-color": "#2ae299",
                  }),
                  (0, d.jsx)("stop", {
                    offset: ".4845",
                    "stop-color": "#359dca",
                  }),
                  (0, d.jsx)("stop", {
                    offset: ".8263",
                    "stop-color": "#3b72e9",
                  }),
                  (0, d.jsx)("stop", { offset: "1", "stop-color": "#3e62f5" }),
                ],
              }),
              (0, d.jsx)("path", {
                d: "M171.4 5c-6.1 0-11.1 5-11.1 11.1v52.1C147.4 56 130.1 48.5 111 48.5c-39.5 0-71.5 32-71.5 71.5s32 71.5 71.5 71.5c19.1 0 36.4-7.5 49.2-19.7v4.4c0 6.1 5 11.1 11.1 11.1s11.1-5 11.1-11.1V16.1c0-6.1-5-11.1-11-11.1z",
                fill: "url(#SVGID_1_111111)",
              }),
              (0, d.jsx)("path", {
                d: "M160.3 135.6v3.7c0 9.4-4 20.6-11.5 33-4 6.6-9 13.5-14.9 20.5-8.8 10.5-17.6 19.1-22.8 23.9-5.2-4.8-14-13.3-22.7-23.7-3.5-4.1-6.6-8.1-9.4-12.1-.3-.4-.6-.8-.8-1.1-3.5-4.9-6.4-9.7-8.8-14.3l-.3-.6c-4.8-9.4-7.2-17.9-7.2-25.4v-3.7c0-14.5 6-27.8 15.6-37.1C86.3 90.2 98 84.9 111 84.9s24.9 5.2 33.6 13.8c.9.9 1.8 1.9 2.7 2.9.4.3.6.7.9 1 .2.2.4.5.6.7 7.1 8.8 11.3 20.1 11.5 32.3z",
                opacity: ".12",
              }),
              (0, d.jsx)("path", {
                fill: "#fff",
                d: "M160.3 121.2v3.7c0 9.4-4 20.6-11.5 33-4 6.6-9 13.5-14.9 20.5-8.8 10.5-17.6 19.1-22.8 23.9-5.2-4.8-14-13.3-22.7-23.7-3.5-4.1-6.6-8.1-9.4-12.1-.3-.4-.6-.8-.8-1.1-3.5-4.9-6.4-9.7-8.8-14.3l-.3-.6c-4.8-9.4-7.2-17.9-7.2-25.4v-3.7c0-14.5 6-27.8 15.6-37.1C86.3 75.8 98 70.5 111 70.5s24.9 5.2 33.6 13.8c.9.9 1.8 1.9 2.7 2.9.4.3.6.7.9 1 .2.2.4.5.6.7 7.1 8.8 11.3 20.1 11.5 32.3z",
              }),
              (0, d.jsx)("path", {
                d: "M110.9 91.8c-15.6 0-28.2 12.6-28.2 28.2 0 5 1.3 9.8 3.6 13.9l-17.1 17.2c2.3 4.6 5.3 9.3 8.8 14.3l20.1-20.1c3.8 2 8.2 3.1 12.8 3.1 15.6 0 28.2-12.6 28.2-28.2s-12.6-28.4-28.2-28.4z",
                fill: "#3e62f5",
              }),
              (0, d.jsx)("path", {
                fill: "#fff",
                d: "M102.5 100.3c-3.7 1.6-6.6 4.2-8.5 7.3-.9 1.5-.1 3.6 1.6 3.9.1 0 .2 0 .3.1 1.1.2 2.1-.3 2.7-1.3 1.4-2.2 3.4-4 6-5.1 2.8-1.2 5.7-1.3 8.4-.6 1 .3 2.1 0 2.7-.9.1-.1.1-.2.2-.3 1-1.4.3-3.5-1.4-3.9-3.8-1.1-8.1-.9-12 .8z",
              }),
            ],
          }),
          edit: function (n) {
            var i,
              y = n.attributes,
              m = n.setAttributes,
              w = n.className,
              g = n.onReplace,
              j = n.mergeBlocks,
              x = n.clientId,
              O = y.textAlign,
              _ = y.placeholder,
              k = y.style,
              S = y.text,
              C = y.width,
              B = y.showDashboardMenu,
              P = (function (e, t) {
                return (
                  (function (e) {
                    if (Array.isArray(e)) return e;
                  })(e) ||
                  (function (e, t) {
                    var r =
                      null == e
                        ? null
                        : ("undefined" != typeof Symbol &&
                            e[Symbol.iterator]) ||
                          e["@@iterator"];
                    if (null != r) {
                      var n,
                        o,
                        i,
                        l,
                        s = [],
                        c = !0,
                        a = !1;
                      try {
                        if (((i = (r = r.call(e)).next), 0 === t)) {
                          if (Object(r) !== r) return;
                          c = !1;
                        } else
                          for (
                            ;
                            !(c = (n = i.call(r)).done) &&
                            (s.push(n.value), s.length !== t);
                            c = !0
                          );
                      } catch (e) {
                        (a = !0), (o = e);
                      } finally {
                        try {
                          if (
                            !c &&
                            null != r.return &&
                            ((l = r.return()), Object(l) !== l)
                          )
                            return;
                        } finally {
                          if (a) throw o;
                        }
                      }
                      return s;
                    }
                  })(e, t) ||
                  (function (e, t) {
                    if (e) {
                      if ("string" == typeof e) return r(e, t);
                      var n = {}.toString.call(e).slice(8, -1);
                      return (
                        "Object" === n &&
                          e.constructor &&
                          (n = e.constructor.name),
                        "Map" === n || "Set" === n
                          ? Array.from(e)
                          : "Arguments" === n ||
                              /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)
                            ? r(e, t)
                            : void 0
                      );
                    }
                  })(e, t) ||
                  (function () {
                    throw new TypeError(
                      "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.",
                    );
                  })()
                );
              })((0, s.useState)(null), 2),
              A = (P[0], P[1]),
              E = (0, a.__experimentalUseBorderProps)(y),
              N = (0, a.__experimentalUseColorProps)(y),
              D = (0, a.__experimentalGetSpacingClassesAndStyles)(y),
              I = (0, a.__experimentalGetShadowClassesAndStyles)(y),
              R = (0, s.useRef)(),
              G = (0, s.useRef)(),
              M = (0, a.useBlockProps)({
                ref: (0, f.useMergeRefs)([A, R]),
                onKeyDown: function (e) {
                  if (u.isKeyboardEvent.primary(e, "k"))
                    !(function (e) {
                      e.preventDefault();
                    })(e);
                  else if (u.isKeyboardEvent.primaryShift(e, "k")) {
                    var t;
                    m({ url: void 0, linkTarget: void 0, rel: void 0 }),
                      null === (t = G.current) || void 0 === t || t.focus();
                  }
                },
              }),
              z = (0, a.useBlockEditingMode)(),
              T = (function (t) {
                var r = (0, p.useDispatch)(a.store),
                  n = r.replaceBlocks,
                  o = r.selectionChange,
                  i = (0, p.useSelect)(a.store),
                  l = i.getBlock,
                  c = i.getBlockRootClientId,
                  d = i.getBlockIndex,
                  y = (0, s.useRef)(t);
                return (
                  (y.current = t),
                  (0, f.useRefEffect)(function (t) {
                    function r(t) {
                      if (!t.defaultPrevented && t.keyCode === u.ENTER) {
                        var r = y.current,
                          i = r.content,
                          s = r.clientId;
                        if (!i.length) {
                          t.preventDefault();
                          var a = l(c(s)),
                            f = d(s),
                            p = (0, e.cloneBlock)(
                              b(
                                b({}, a),
                                {},
                                { innerBlocks: a.innerBlocks.slice(0, f) },
                              ),
                            ),
                            v = (0, e.createBlock)(
                              (0, e.getDefaultBlockName)(),
                            ),
                            h = a.innerBlocks.slice(f + 1),
                            m = h.length
                              ? [
                                  (0, e.cloneBlock)(
                                    b(b({}, a), {}, { innerBlocks: h }),
                                  ),
                                ]
                              : [];
                          n(a.clientId, [p, v].concat(m), 1), o(v.clientId);
                        }
                      }
                    }
                    return (
                      t.addEventListener("keydown", r),
                      function () {
                        t.removeEventListener("keydown", r);
                      }
                    );
                  }, [])
                );
              })({ content: S, clientId: x }),
              U = (0, f.useMergeRefs)([T, G]);
            return (0, d.jsxs)(d.Fragment, {
              children: [
                (0, d.jsx)(
                  "div",
                  b(
                    b({}, M),
                    {},
                    {
                      className: l(
                        M.className,
                        o(
                          o(
                            {},
                            "has-custom-width wp-block-button__width-".concat(
                              C,
                            ),
                            C,
                          ),
                          "has-custom-font-size",
                          M.style.fontSize,
                        ),
                      ),
                      children: (0, d.jsx)(a.RichText, {
                        ref: U,
                        "aria-label": (0, t.__)("Button text"),
                        placeholder: _ || (0, t.__)("Add text…"),
                        value: S,
                        onChange: function (e) {
                          return m({ text: v(e) });
                        },
                        withoutInteractiveFormatting: !0,
                        className: l(
                          w,
                          "wp-block-button__link",
                          N.className,
                          E.className,
                          o(
                            o({}, "has-text-align-".concat(O), O),
                            "no-border-radius",
                            0 ===
                              (null == k ||
                              null === (i = k.border) ||
                              void 0 === i
                                ? void 0
                                : i.radius),
                          ),
                          (0, a.__experimentalGetElementClassName)("button"),
                        ),
                        style: b(
                          b(b(b({}, E.style), N.style), D.style),
                          I.style,
                        ),
                        onReplace: g,
                        onMerge: j,
                        identifier: "text",
                      }),
                    },
                  ),
                ),
                (0, d.jsx)(a.BlockControls, {
                  group: "block",
                  children:
                    "default" === z &&
                    (0, d.jsx)(a.AlignmentControl, {
                      value: O,
                      onChange: function (e) {
                        m({ textAlign: e });
                      },
                    }),
                }),
                (0, d.jsx)(a.InspectorControls, {
                  children: (0, d.jsxs)(c.PanelBody, {
                    title: (0, t.__)("Settings"),
                    children: [
                      (0, d.jsx)(c.ToggleControl, {
                        checked: B,
                        label: (0, t.__)(
                          "Enable dropdown menu",
                          "directorist-account-block",
                        ),
                        onChange: function () {
                          return m({ showDashboardMenu: !B });
                        },
                      }),
                      (0, d.jsx)(h, { selectedWidth: C, setAttributes: m }),
                    ],
                  }),
                }),
              ],
            });
          },
          save: function (e) {
            var t,
              r,
              n = e.attributes,
              i = e.className,
              s = n.tagName,
              c = n.type,
              u = n.textAlign,
              f = n.fontSize,
              p = n.style,
              y = n.text,
              b = n.title,
              v = n.width,
              h = s || "button",
              m = "button" === h,
              g = c || "button",
              j = (0, a.__experimentalGetBorderClassesAndStyles)(n),
              x = (0, a.__experimentalGetColorClassesAndStyles)(n),
              O = (0, a.__experimentalGetSpacingClassesAndStyles)(n),
              _ = (0, a.__experimentalGetShadowClassesAndStyles)(n),
              k = l(
                "wp-block-button__link",
                x.className,
                j.className,
                o(
                  o({}, "has-text-align-".concat(u), u),
                  "no-border-radius",
                  0 ===
                    (null == p || null === (t = p.border) || void 0 === t
                      ? void 0
                      : t.radius),
                ),
                (0, a.__experimentalGetElementClassName)("button"),
              ),
              S = w(w(w(w({}, j.style), x.style), O.style), _.style),
              C = l(
                i,
                o(
                  o(
                    {},
                    "has-custom-width wp-block-button__width-".concat(v),
                    v,
                  ),
                  "has-custom-font-size",
                  f ||
                    (null == p || null === (r = p.typography) || void 0 === r
                      ? void 0
                      : r.fontSize),
                ),
              );
            return (0, d.jsx)(
              "div",
              w(
                w({}, a.useBlockProps.save({ className: C })),
                {},
                {
                  children: (0, d.jsx)(a.RichText.Content, {
                    tagName: h,
                    type: m ? g : null,
                    className: k,
                    title: b,
                    style: S,
                    value: y,
                  }),
                },
              ),
            );
          },
        });
      },
    },
    r = {};
  function n(e) {
    var o = r[e];
    if (void 0 !== o) return o.exports;
    var i = (r[e] = { exports: {} });
    return t[e](i, i.exports, n), i.exports;
  }
  (n.m = t),
    (e = []),
    (n.O = function (t, r, o, i) {
      if (!r) {
        var l = 1 / 0;
        for (u = 0; u < e.length; u++) {
          (r = e[u][0]), (o = e[u][1]), (i = e[u][2]);
          for (var s = !0, c = 0; c < r.length; c++)
            (!1 & i || l >= i) &&
            Object.keys(n.O).every(function (e) {
              return n.O[e](r[c]);
            })
              ? r.splice(c--, 1)
              : ((s = !1), i < l && (l = i));
          if (s) {
            e.splice(u--, 1);
            var a = o();
            void 0 !== a && (t = a);
          }
        }
        return t;
      }
      i = i || 0;
      for (var u = e.length; u > 0 && e[u - 1][2] > i; u--) e[u] = e[u - 1];
      e[u] = [r, o, i];
    }),
    (n.o = function (e, t) {
      return Object.prototype.hasOwnProperty.call(e, t);
    }),
    (function () {
      var e = { 592: 0, 144: 0 };
      n.O.j = function (t) {
        return 0 === e[t];
      };
      var t = function (t, r) {
          var o,
            i,
            l = r[0],
            s = r[1],
            c = r[2],
            a = 0;
          if (
            l.some(function (t) {
              return 0 !== e[t];
            })
          ) {
            for (o in s) n.o(s, o) && (n.m[o] = s[o]);
            if (c) var u = c(n);
          }
          for (t && t(r); a < l.length; a++)
            (i = l[a]), n.o(e, i) && e[i] && e[i][0](), (e[i] = 0);
          return n.O(u);
        },
        r = (self.webpackChunk_directorist_search_popup_block =
          self.webpackChunk_directorist_search_popup_block || []);
      r.forEach(t.bind(null, 0)), (r.push = t.bind(null, r.push.bind(r)));
    })();
  var o = n.O(void 0, [144], function () {
    return n(552);
  });
  o = n.O(o);
})();
