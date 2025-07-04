!(function () {
  "use strict";
  var t = {};
  function e(t) {
    return (
      (e =
        "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
          ? function (t) {
              return typeof t;
            }
          : function (t) {
              return t &&
                "function" == typeof Symbol &&
                t.constructor === Symbol &&
                t !== Symbol.prototype
                ? "symbol"
                : typeof t;
            }),
      e(t)
    );
  }
  function r(t, r, n) {
    return (
      (r = (function (t) {
        var r = (function (t) {
          if ("object" != e(t) || !t) return t;
          var r = t[Symbol.toPrimitive];
          if (void 0 !== r) {
            var n = r.call(t, "string");
            if ("object" != e(n)) return n;
            throw new TypeError("@@toPrimitive must return a primitive value.");
          }
          return String(t);
        })(t);
        return "symbol" == e(r) ? r : r + "";
      })(r)) in t
        ? Object.defineProperty(t, r, {
            value: n,
            enumerable: !0,
            configurable: !0,
            writable: !0,
          })
        : (t[r] = n),
      t
    );
  }
  (t.n = function (e) {
    var r =
      e && e.__esModule
        ? function () {
            return e.default;
          }
        : function () {
            return e;
          };
    return t.d(r, { a: r }), r;
  }),
    (t.d = function (e, r) {
      for (var n in r)
        t.o(r, n) &&
          !t.o(e, n) &&
          Object.defineProperty(e, n, { enumerable: !0, get: r[n] });
    }),
    (t.o = function (t, e) {
      return Object.prototype.hasOwnProperty.call(t, e);
    });
  var n = window.wp.blocks,
    o = window.wp.serverSideRender,
    i = t.n(o),
    c = window.wp.element,
    l = window.wp.i18n,
    s = window.wp.blockEditor,
    a = window.wp.components;
  function u(t, e) {
    (null == e || e > t.length) && (e = t.length);
    for (var r = 0, n = Array(e); r < e; r++) n[r] = t[r];
    return n;
  }
  window.lodash;
  var f = window.ReactJSXRuntime;
  function p() {
    return (0, f.jsxs)("svg", {
      xmlns: "http://www.w3.org/2000/svg",
      viewBox: "0 0 222 221.7",
      children: [
        (0, f.jsxs)("linearGradient", {
          id: "SVGID_1_111111",
          gradientUnits: "userSpaceOnUse",
          x1: "81.4946",
          y1: "2852.0237",
          x2: "188.5188",
          y2: "2660.0842",
          gradientTransform: "translate(0 -2658.8872)",
          children: [
            (0, f.jsx)("stop", { offset: "0", "stop-color": "#2ae498" }),
            (0, f.jsx)("stop", {
              offset: ".01117462",
              "stop-color": "#2ae299",
            }),
            (0, f.jsx)("stop", { offset: ".4845", "stop-color": "#359dca" }),
            (0, f.jsx)("stop", { offset: ".8263", "stop-color": "#3b72e9" }),
            (0, f.jsx)("stop", { offset: "1", "stop-color": "#3e62f5" }),
          ],
        }),
        (0, f.jsx)("path", {
          d: "M171.4 5c-6.1 0-11.1 5-11.1 11.1v52.1C147.4 56 130.1 48.5 111 48.5c-39.5 0-71.5 32-71.5 71.5s32 71.5 71.5 71.5c19.1 0 36.4-7.5 49.2-19.7v4.4c0 6.1 5 11.1 11.1 11.1s11.1-5 11.1-11.1V16.1c0-6.1-5-11.1-11-11.1z",
          fill: "url(#SVGID_1_111111)",
        }),
        (0, f.jsx)("path", {
          d: "M160.3 135.6v3.7c0 9.4-4 20.6-11.5 33-4 6.6-9 13.5-14.9 20.5-8.8 10.5-17.6 19.1-22.8 23.9-5.2-4.8-14-13.3-22.7-23.7-3.5-4.1-6.6-8.1-9.4-12.1-.3-.4-.6-.8-.8-1.1-3.5-4.9-6.4-9.7-8.8-14.3l-.3-.6c-4.8-9.4-7.2-17.9-7.2-25.4v-3.7c0-14.5 6-27.8 15.6-37.1C86.3 90.2 98 84.9 111 84.9s24.9 5.2 33.6 13.8c.9.9 1.8 1.9 2.7 2.9.4.3.6.7.9 1 .2.2.4.5.6.7 7.1 8.8 11.3 20.1 11.5 32.3z",
          opacity: ".12",
        }),
        (0, f.jsx)("path", {
          fill: "#fff",
          d: "M160.3 121.2v3.7c0 9.4-4 20.6-11.5 33-4 6.6-9 13.5-14.9 20.5-8.8 10.5-17.6 19.1-22.8 23.9-5.2-4.8-14-13.3-22.7-23.7-3.5-4.1-6.6-8.1-9.4-12.1-.3-.4-.6-.8-.8-1.1-3.5-4.9-6.4-9.7-8.8-14.3l-.3-.6c-4.8-9.4-7.2-17.9-7.2-25.4v-3.7c0-14.5 6-27.8 15.6-37.1C86.3 75.8 98 70.5 111 70.5s24.9 5.2 33.6 13.8c.9.9 1.8 1.9 2.7 2.9.4.3.6.7.9 1 .2.2.4.5.6.7 7.1 8.8 11.3 20.1 11.5 32.3z",
        }),
        (0, f.jsx)("path", {
          d: "M110.9 91.8c-15.6 0-28.2 12.6-28.2 28.2 0 5 1.3 9.8 3.6 13.9l-17.1 17.2c2.3 4.6 5.3 9.3 8.8 14.3l20.1-20.1c3.8 2 8.2 3.1 12.8 3.1 15.6 0 28.2-12.6 28.2-28.2s-12.6-28.4-28.2-28.4z",
          fill: "#3e62f5",
        }),
        (0, f.jsx)("path", {
          fill: "#fff",
          d: "M102.5 100.3c-3.7 1.6-6.6 4.2-8.5 7.3-.9 1.5-.1 3.6 1.6 3.9.1 0 .2 0 .3.1 1.1.2 2.1-.3 2.7-1.3 1.4-2.2 3.4-4 6-5.1 2.8-1.2 5.7-1.3 8.4-.6 1 .3 2.1 0 2.7-.9.1-.1.1-.2.2-.3 1-1.4.3-3.5-1.4-3.9-3.8-1.1-8.1-.9-12 .8z",
        }),
      ],
    });
  }
  var d = JSON.parse(
    '{"UU":"directorist/author-profile","uK":{"logged_in_user_only":{"type":"boolean","default":false}}}',
  );
  function y(t, e) {
    var r = Object.keys(t);
    if (Object.getOwnPropertySymbols) {
      var n = Object.getOwnPropertySymbols(t);
      e &&
        (n = n.filter(function (e) {
          return Object.getOwnPropertyDescriptor(t, e).enumerable;
        })),
        r.push.apply(r, n);
    }
    return r;
  }
  function b(t) {
    for (var e = 1; e < arguments.length; e++) {
      var n = null != arguments[e] ? arguments[e] : {};
      e % 2
        ? y(Object(n), !0).forEach(function (e) {
            r(t, e, n[e]);
          })
        : Object.getOwnPropertyDescriptors
          ? Object.defineProperties(t, Object.getOwnPropertyDescriptors(n))
          : y(Object(n)).forEach(function (e) {
              Object.defineProperty(
                t,
                e,
                Object.getOwnPropertyDescriptor(n, e),
              );
            });
    }
    return t;
  }
  var v = function () {
    return (function (t) {
      var e = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
      return (0, f.jsx)("div", {
        className: "directorist-container",
        children: e
          ? p()
          : (0, f.jsx)("img", {
              style: { display: "block", width: "100%", height: "auto" },
              className: "directorist-block-preview",
              src: ""
                .concat(directoristBlockConfig.previewUrl, "preview/")
                .concat(t, ".svg"),
              alt: "Placeholder for ".concat(t),
            }),
      });
    })("author-profile");
  };
  (0, n.registerBlockType)(d.UU, {
    icon: p(),
    transforms: {
      from: [
        {
          type: "shortcode",
          tag: "directorist_author_profile",
          attributes: (function () {
            for (
              var t =
                  arguments.length > 0 && void 0 !== arguments[0]
                    ? arguments[0]
                    : {},
                e = {},
                r = function () {
                  var t,
                    r,
                    i =
                      ((t = o[n]),
                      (r = 2),
                      (function (t) {
                        if (Array.isArray(t)) return t;
                      })(t) ||
                        (function (t, e) {
                          var r =
                            null == t
                              ? null
                              : ("undefined" != typeof Symbol &&
                                  t[Symbol.iterator]) ||
                                t["@@iterator"];
                          if (null != r) {
                            var n,
                              o,
                              i,
                              c,
                              l = [],
                              s = !0,
                              a = !1;
                            try {
                              if (((i = (r = r.call(t)).next), 0 === e)) {
                                if (Object(r) !== r) return;
                                s = !1;
                              } else
                                for (
                                  ;
                                  !(s = (n = i.call(r)).done) &&
                                  (l.push(n.value), l.length !== e);
                                  s = !0
                                );
                            } catch (t) {
                              (a = !0), (o = t);
                            } finally {
                              try {
                                if (
                                  !s &&
                                  null != r.return &&
                                  ((c = r.return()), Object(c) !== c)
                                )
                                  return;
                              } finally {
                                if (a) throw o;
                              }
                            }
                            return l;
                          }
                        })(t, r) ||
                        (function (t, e) {
                          if (t) {
                            if ("string" == typeof t) return u(t, e);
                            var r = {}.toString.call(t).slice(8, -1);
                            return (
                              "Object" === r &&
                                t.constructor &&
                                (r = t.constructor.name),
                              "Map" === r || "Set" === r
                                ? Array.from(t)
                                : "Arguments" === r ||
                                    /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(
                                      r,
                                    )
                                  ? u(t, e)
                                  : void 0
                            );
                          }
                        })(t, r) ||
                        (function () {
                          throw new TypeError(
                            "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.",
                          );
                        })()),
                    c = i[0],
                    l = i[1];
                  e[c] = {
                    type: l.type,
                    shortcode: function (t) {
                      var e = t.named;
                      return void 0 === e[c]
                        ? l.default
                        : "string" === l.type
                          ? String(e[c])
                          : "number" === l.type
                            ? Number(e[c])
                            : "boolen" === l.type
                              ? Boolean(e[c])
                              : void 0;
                    },
                  };
                },
                n = 0,
                o = Object.entries(t);
              n < o.length;
              n++
            )
              r();
            return e;
          })(d.uK),
        },
      ],
    },
    edit: function (t) {
      var e = t.attributes,
        r = t.setAttributes,
        n = e.logged_in_user_only;
      return (0, f.jsxs)(c.Fragment, {
        children: [
          (0, f.jsx)(s.InspectorControls, {
            children: (0, f.jsx)(a.PanelBody, {
              title: (0, l.__)("Settings", "directorist"),
              initialOpen: !0,
              children: (0, f.jsx)(a.ToggleControl, {
                label: (0, l.__)("Logged In User Can View Only", "directorist"),
                checked: n,
                onChange: function (t) {
                  return r({ logged_in_user_only: t });
                },
              }),
            }),
          }),
          (0, f.jsx)(
            "div",
            b(
              b(
                {},
                (0, s.useBlockProps)({
                  className: "directorist-content-active directorist-w-100",
                }),
              ),
              {},
              {
                children: (0, f.jsx)(i(), {
                  block: d.UU,
                  attributes: e,
                  LoadingResponsePlaceholder: v,
                }),
              },
            ),
          ),
        ],
      });
    },
  });
})();
