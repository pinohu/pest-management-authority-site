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
  function r(t, r, o) {
    return (
      (r = (function (t) {
        var r = (function (t) {
          if ("object" != e(t) || !t) return t;
          var r = t[Symbol.toPrimitive];
          if (void 0 !== r) {
            var o = r.call(t, "string");
            if ("object" != e(o)) return o;
            throw new TypeError("@@toPrimitive must return a primitive value.");
          }
          return String(t);
        })(t);
        return "symbol" == e(r) ? r : r + "";
      })(r)) in t
        ? Object.defineProperty(t, r, {
            value: o,
            enumerable: !0,
            configurable: !0,
            writable: !0,
          })
        : (t[r] = o),
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
      for (var o in r)
        t.o(r, o) &&
          !t.o(e, o) &&
          Object.defineProperty(e, o, { enumerable: !0, get: r[o] });
    }),
    (t.o = function (t, e) {
      return Object.prototype.hasOwnProperty.call(t, e);
    });
  var o = window.wp.blocks,
    n = window.wp.blockEditor,
    c = window.wp.serverSideRender,
    i = t.n(c),
    s = (window.wp.i18n, window.lodash, window.ReactJSXRuntime);
  function l() {
    return (0, s.jsxs)("svg", {
      xmlns: "http://www.w3.org/2000/svg",
      viewBox: "0 0 222 221.7",
      children: [
        (0, s.jsxs)("linearGradient", {
          id: "SVGID_1_111111",
          gradientUnits: "userSpaceOnUse",
          x1: "81.4946",
          y1: "2852.0237",
          x2: "188.5188",
          y2: "2660.0842",
          gradientTransform: "translate(0 -2658.8872)",
          children: [
            (0, s.jsx)("stop", { offset: "0", "stop-color": "#2ae498" }),
            (0, s.jsx)("stop", {
              offset: ".01117462",
              "stop-color": "#2ae299",
            }),
            (0, s.jsx)("stop", { offset: ".4845", "stop-color": "#359dca" }),
            (0, s.jsx)("stop", { offset: ".8263", "stop-color": "#3b72e9" }),
            (0, s.jsx)("stop", { offset: "1", "stop-color": "#3e62f5" }),
          ],
        }),
        (0, s.jsx)("path", {
          d: "M171.4 5c-6.1 0-11.1 5-11.1 11.1v52.1C147.4 56 130.1 48.5 111 48.5c-39.5 0-71.5 32-71.5 71.5s32 71.5 71.5 71.5c19.1 0 36.4-7.5 49.2-19.7v4.4c0 6.1 5 11.1 11.1 11.1s11.1-5 11.1-11.1V16.1c0-6.1-5-11.1-11-11.1z",
          fill: "url(#SVGID_1_111111)",
        }),
        (0, s.jsx)("path", {
          d: "M160.3 135.6v3.7c0 9.4-4 20.6-11.5 33-4 6.6-9 13.5-14.9 20.5-8.8 10.5-17.6 19.1-22.8 23.9-5.2-4.8-14-13.3-22.7-23.7-3.5-4.1-6.6-8.1-9.4-12.1-.3-.4-.6-.8-.8-1.1-3.5-4.9-6.4-9.7-8.8-14.3l-.3-.6c-4.8-9.4-7.2-17.9-7.2-25.4v-3.7c0-14.5 6-27.8 15.6-37.1C86.3 90.2 98 84.9 111 84.9s24.9 5.2 33.6 13.8c.9.9 1.8 1.9 2.7 2.9.4.3.6.7.9 1 .2.2.4.5.6.7 7.1 8.8 11.3 20.1 11.5 32.3z",
          opacity: ".12",
        }),
        (0, s.jsx)("path", {
          fill: "#fff",
          d: "M160.3 121.2v3.7c0 9.4-4 20.6-11.5 33-4 6.6-9 13.5-14.9 20.5-8.8 10.5-17.6 19.1-22.8 23.9-5.2-4.8-14-13.3-22.7-23.7-3.5-4.1-6.6-8.1-9.4-12.1-.3-.4-.6-.8-.8-1.1-3.5-4.9-6.4-9.7-8.8-14.3l-.3-.6c-4.8-9.4-7.2-17.9-7.2-25.4v-3.7c0-14.5 6-27.8 15.6-37.1C86.3 75.8 98 70.5 111 70.5s24.9 5.2 33.6 13.8c.9.9 1.8 1.9 2.7 2.9.4.3.6.7.9 1 .2.2.4.5.6.7 7.1 8.8 11.3 20.1 11.5 32.3z",
        }),
        (0, s.jsx)("path", {
          d: "M110.9 91.8c-15.6 0-28.2 12.6-28.2 28.2 0 5 1.3 9.8 3.6 13.9l-17.1 17.2c2.3 4.6 5.3 9.3 8.8 14.3l20.1-20.1c3.8 2 8.2 3.1 12.8 3.1 15.6 0 28.2-12.6 28.2-28.2s-12.6-28.4-28.2-28.4z",
          fill: "#3e62f5",
        }),
        (0, s.jsx)("path", {
          fill: "#fff",
          d: "M102.5 100.3c-3.7 1.6-6.6 4.2-8.5 7.3-.9 1.5-.1 3.6 1.6 3.9.1 0 .2 0 .3.1 1.1.2 2.1-.3 2.7-1.3 1.4-2.2 3.4-4 6-5.1 2.8-1.2 5.7-1.3 8.4-.6 1 .3 2.1 0 2.7-.9.1-.1.1-.2.2-.3 1-1.4.3-3.5-1.4-3.9-3.8-1.1-8.1-.9-12 .8z",
        }),
      ],
    });
  }
  var a = JSON.parse('{"UU":"directorist/checkout"}');
  function f(t, e) {
    var r = Object.keys(t);
    if (Object.getOwnPropertySymbols) {
      var o = Object.getOwnPropertySymbols(t);
      e &&
        (o = o.filter(function (e) {
          return Object.getOwnPropertyDescriptor(t, e).enumerable;
        })),
        r.push.apply(r, o);
    }
    return r;
  }
  function u(t) {
    for (var e = 1; e < arguments.length; e++) {
      var o = null != arguments[e] ? arguments[e] : {};
      e % 2
        ? f(Object(o), !0).forEach(function (e) {
            r(t, e, o[e]);
          })
        : Object.getOwnPropertyDescriptors
          ? Object.defineProperties(t, Object.getOwnPropertyDescriptors(o))
          : f(Object(o)).forEach(function (e) {
              Object.defineProperty(
                t,
                e,
                Object.getOwnPropertyDescriptor(o, e),
              );
            });
    }
    return t;
  }
  var p = function () {
    return (function (t) {
      var e = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
      return (0, s.jsx)("div", {
        className: "directorist-container",
        children: e
          ? l()
          : (0, s.jsx)("img", {
              style: { display: "block", width: "100%", height: "auto" },
              className: "directorist-block-preview",
              src: ""
                .concat(directoristBlockConfig.previewUrl, "preview/")
                .concat(t, ".svg"),
              alt: "Placeholder for ".concat(t),
            }),
      });
    })("checkout");
  };
  (0, o.registerBlockType)(a.UU, {
    icon: l(),
    transforms: {
      from: [
        { type: "shortcode", tag: "directorist_checkout", attributes: {} },
      ],
    },
    edit: function (t) {
      var e = t.attributes;
      return (0, s.jsx)(
        "div",
        u(
          u(
            {},
            (0, n.useBlockProps)({ className: "directorist-content-active" }),
          ),
          {},
          {
            children: (0, s.jsx)(i(), {
              block: a.UU,
              attributes: e,
              LoadingResponsePlaceholder: p,
            }),
          },
        ),
      );
    },
  });
})();
