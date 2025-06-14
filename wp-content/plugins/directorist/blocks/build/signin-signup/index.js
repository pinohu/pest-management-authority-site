!(function () {
  "use strict";
  var e = {};
  function t(e) {
    return (
      (t =
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
      t(e)
    );
  }
  function r(e, r, n) {
    return (
      (r = (function (e) {
        var r = (function (e) {
          if ("object" != t(e) || !e) return e;
          var r = e[Symbol.toPrimitive];
          if (void 0 !== r) {
            var n = r.call(e, "string");
            if ("object" != t(n)) return n;
            throw new TypeError("@@toPrimitive must return a primitive value.");
          }
          return String(e);
        })(e);
        return "symbol" == t(r) ? r : r + "";
      })(r)) in e
        ? Object.defineProperty(e, r, {
            value: n,
            enumerable: !0,
            configurable: !0,
            writable: !0,
          })
        : (e[r] = n),
      e
    );
  }
  (e.n = function (t) {
    var r =
      t && t.__esModule
        ? function () {
            return t.default;
          }
        : function () {
            return t;
          };
    return e.d(r, { a: r }), r;
  }),
    (e.d = function (t, r) {
      for (var n in r)
        e.o(r, n) &&
          !e.o(t, n) &&
          Object.defineProperty(t, n, { enumerable: !0, get: r[n] });
    }),
    (e.o = function (e, t) {
      return Object.prototype.hasOwnProperty.call(e, t);
    });
  var n = window.wp.blocks,
    o = window.wp.blockEditor,
    i = window.wp.serverSideRender,
    l = e.n(i),
    s = window.wp.i18n,
    a = window.wp.element,
    c = window.wp.components,
    u = (window.lodash, window.ReactJSXRuntime);
  function _() {
    return (0, u.jsxs)("svg", {
      xmlns: "http://www.w3.org/2000/svg",
      viewBox: "0 0 222 221.7",
      children: [
        (0, u.jsxs)("linearGradient", {
          id: "SVGID_1_111111",
          gradientUnits: "userSpaceOnUse",
          x1: "81.4946",
          y1: "2852.0237",
          x2: "188.5188",
          y2: "2660.0842",
          gradientTransform: "translate(0 -2658.8872)",
          children: [
            (0, u.jsx)("stop", { offset: "0", "stop-color": "#2ae498" }),
            (0, u.jsx)("stop", {
              offset: ".01117462",
              "stop-color": "#2ae299",
            }),
            (0, u.jsx)("stop", { offset: ".4845", "stop-color": "#359dca" }),
            (0, u.jsx)("stop", { offset: ".8263", "stop-color": "#3b72e9" }),
            (0, u.jsx)("stop", { offset: "1", "stop-color": "#3e62f5" }),
          ],
        }),
        (0, u.jsx)("path", {
          d: "M171.4 5c-6.1 0-11.1 5-11.1 11.1v52.1C147.4 56 130.1 48.5 111 48.5c-39.5 0-71.5 32-71.5 71.5s32 71.5 71.5 71.5c19.1 0 36.4-7.5 49.2-19.7v4.4c0 6.1 5 11.1 11.1 11.1s11.1-5 11.1-11.1V16.1c0-6.1-5-11.1-11-11.1z",
          fill: "url(#SVGID_1_111111)",
        }),
        (0, u.jsx)("path", {
          d: "M160.3 135.6v3.7c0 9.4-4 20.6-11.5 33-4 6.6-9 13.5-14.9 20.5-8.8 10.5-17.6 19.1-22.8 23.9-5.2-4.8-14-13.3-22.7-23.7-3.5-4.1-6.6-8.1-9.4-12.1-.3-.4-.6-.8-.8-1.1-3.5-4.9-6.4-9.7-8.8-14.3l-.3-.6c-4.8-9.4-7.2-17.9-7.2-25.4v-3.7c0-14.5 6-27.8 15.6-37.1C86.3 90.2 98 84.9 111 84.9s24.9 5.2 33.6 13.8c.9.9 1.8 1.9 2.7 2.9.4.3.6.7.9 1 .2.2.4.5.6.7 7.1 8.8 11.3 20.1 11.5 32.3z",
          opacity: ".12",
        }),
        (0, u.jsx)("path", {
          fill: "#fff",
          d: "M160.3 121.2v3.7c0 9.4-4 20.6-11.5 33-4 6.6-9 13.5-14.9 20.5-8.8 10.5-17.6 19.1-22.8 23.9-5.2-4.8-14-13.3-22.7-23.7-3.5-4.1-6.6-8.1-9.4-12.1-.3-.4-.6-.8-.8-1.1-3.5-4.9-6.4-9.7-8.8-14.3l-.3-.6c-4.8-9.4-7.2-17.9-7.2-25.4v-3.7c0-14.5 6-27.8 15.6-37.1C86.3 75.8 98 70.5 111 70.5s24.9 5.2 33.6 13.8c.9.9 1.8 1.9 2.7 2.9.4.3.6.7.9 1 .2.2.4.5.6.7 7.1 8.8 11.3 20.1 11.5 32.3z",
        }),
        (0, u.jsx)("path", {
          d: "M110.9 91.8c-15.6 0-28.2 12.6-28.2 28.2 0 5 1.3 9.8 3.6 13.9l-17.1 17.2c2.3 4.6 5.3 9.3 8.8 14.3l20.1-20.1c3.8 2 8.2 3.1 12.8 3.1 15.6 0 28.2-12.6 28.2-28.2s-12.6-28.4-28.2-28.4z",
          fill: "#3e62f5",
        }),
        (0, u.jsx)("path", {
          fill: "#fff",
          d: "M102.5 100.3c-3.7 1.6-6.6 4.2-8.5 7.3-.9 1.5-.1 3.6 1.6 3.9.1 0 .2 0 .3.1 1.1.2 2.1-.3 2.7-1.3 1.4-2.2 3.4-4 6-5.1 2.8-1.2 5.7-1.3 8.4-.6 1 .3 2.1 0 2.7-.9.1-.1.1-.2.2-.3 1-1.4.3-3.5-1.4-3.9-3.8-1.1-8.1-.9-12 .8z",
        }),
      ],
    });
  }
  var d = JSON.parse('{"UU":"directorist/signin-signup"}');
  function g(e, t) {
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
      var n = null != arguments[t] ? arguments[t] : {};
      t % 2
        ? g(Object(n), !0).forEach(function (t) {
            r(e, t, n[t]);
          })
        : Object.getOwnPropertyDescriptors
          ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(n))
          : g(Object(n)).forEach(function (t) {
              Object.defineProperty(
                e,
                t,
                Object.getOwnPropertyDescriptor(n, t),
              );
            });
    }
    return e;
  }
  var f = function () {
    return (function (e) {
      var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1];
      return (0, u.jsx)("div", {
        className: "directorist-container",
        children: t
          ? _()
          : (0, u.jsx)("img", {
              style: { display: "block", width: "100%", height: "auto" },
              className: "directorist-block-preview",
              src: ""
                .concat(directoristBlockConfig.previewUrl, "preview/")
                .concat(e, ".svg"),
              alt: "Placeholder for ".concat(e),
            }),
      });
    })("signin");
  };
  (0, n.registerBlockType)(d.UU, {
    icon: _(),
    transforms: {
      from: [
        { type: "shortcode", tag: "directorist_user_login", attributes: {} },
        {
          type: "shortcode",
          tag: "directorist_custom_registration",
          attributes: {},
        },
      ],
    },
    edit: function (e) {
      var t = e.attributes,
        r = e.setAttributes;
      return (0, u.jsxs)(a.Fragment, {
        children: [
          (0, u.jsxs)(o.InspectorControls, {
            children: [
              (0, u.jsxs)(c.PanelBody, {
                title: (0, s.__)("Sign-In Settings", "directorist"),
                children: [
                  (0, u.jsx)(c.TextControl, {
                    label: (0, s.__)("Username Label", "directorist"),
                    value: t.signin_username_label,
                    onChange: function (e) {
                      return r({ signin_username_label: e });
                    },
                  }),
                  (0, u.jsx)(c.TextControl, {
                    label: (0, s.__)("Password Label", "directorist"),
                    value: t.password_label,
                    onChange: function (e) {
                      return r({ password_label: e });
                    },
                  }),
                  (0, u.jsx)(c.TextControl, {
                    label: (0, s.__)("Button Label", "directorist"),
                    value: t.signin_button_label,
                    onChange: function (e) {
                      return r({ signin_button_label: e });
                    },
                  }),
                  (0, u.jsx)(c.TextControl, {
                    label: (0, s.__)("Sign Up Linking Text", "directorist"),
                    value: t.signup_linking_text,
                    onChange: function (e) {
                      return r({ signup_linking_text: e });
                    },
                  }),
                  (0, u.jsx)(c.TextControl, {
                    label: (0, s.__)("Recovery Password Label", "directorist"),
                    value: t.recovery_password_label,
                    onChange: function (e) {
                      return r({ recovery_password_label: e });
                    },
                  }),
                ],
              }),
              (0, u.jsxs)(c.PanelBody, {
                isOpen: !1,
                title: (0, s.__)("Sign-Up Settings", "directorist"),
                children: [
                  (0, u.jsx)(c.ToggleControl, {
                    label: (0, s.__)("Enable Sign-Up", "directorist"),
                    checked: t.registration,
                    onChange: function (e) {
                      return r({ registration: e });
                    },
                  }),
                  t.registration
                    ? (0, u.jsxs)(a.Fragment, {
                        children: [
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)("Username Label", "directorist"),
                            value: t.username_label,
                            onChange: function (e) {
                              return r({ username_label: e });
                            },
                          }),
                          (0, u.jsx)(c.ToggleControl, {
                            label: (0, s.__)(
                              "Show Password Field",
                              "directorist",
                            ),
                            checked: t.password,
                            onChange: function (e) {
                              return r({ password: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)("Password Label", "directorist"),
                            value: t.password_label,
                            onChange: function (e) {
                              return r({ password_label: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)("Email Label", "directorist"),
                            value: t.email_label,
                            onChange: function (e) {
                              return r({ email_label: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)("Button Label", "directorist"),
                            value: t.signup_button_label,
                            onChange: function (e) {
                              return r({ signup_button_label: e });
                            },
                          }),
                          (0, u.jsx)(c.ToggleControl, {
                            label: (0, s.__)(
                              "Auto Sign In After Sign Up",
                              "directorist",
                            ),
                            checked: t.signin_after_signup,
                            onChange: function (e) {
                              return r({ signin_after_signup: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)(
                              "Sign Up Redirect URL",
                              "directorist",
                            ),
                            value: t.signup_redirect_url,
                            onChange: function (e) {
                              return r({ signup_redirect_url: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)("Sign Up Label", "directorist"),
                            value: t.signup_label,
                            onChange: function (e) {
                              return r({ signup_label: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)("Sign In Message", "directorist"),
                            value: t.signin_message,
                            onChange: function (e) {
                              return r({ signin_message: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)(
                              "Sign In Linking Text",
                              "directorist",
                            ),
                            value: t.signin_linking_text,
                            onChange: function (e) {
                              return r({ signin_linking_text: e });
                            },
                          }),
                        ],
                      })
                    : null,
                ],
              }),
              t.registration
                ? (0, u.jsxs)(a.Fragment, {
                    children: [
                      (0, u.jsxs)(c.PanelBody, {
                        title: (0, s.__)("User Role Settings", "directorist"),
                        children: [
                          (0, u.jsx)(c.ToggleControl, {
                            label: (0, s.__)("User Role", "directorist"),
                            checked: t.user_role,
                            onChange: function (e) {
                              return r({ user_role: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)(
                              "Author Role Label",
                              "directorist",
                            ),
                            value: t.author_role_label,
                            onChange: function (e) {
                              return r({ author_role_label: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)("User Role Label", "directorist"),
                            value: t.user_role_label,
                            onChange: function (e) {
                              return r({ user_role_label: e });
                            },
                          }),
                        ],
                      }),
                      (0, u.jsxs)(c.PanelBody, {
                        title: (0, s.__)("Website Settings", "directorist"),
                        children: [
                          (0, u.jsx)(c.ToggleControl, {
                            label: (0, s.__)(
                              "Show Website Field",
                              "directorist",
                            ),
                            checked: t.website,
                            onChange: function (e) {
                              return r({ website: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)("Website Label", "directorist"),
                            value: t.website_label,
                            onChange: function (e) {
                              return r({ website_label: e });
                            },
                          }),
                          (0, u.jsx)(c.ToggleControl, {
                            label: (0, s.__)("Require Website", "directorist"),
                            checked: t.website_required,
                            onChange: function (e) {
                              return r({ website_required: e });
                            },
                          }),
                        ],
                      }),
                      (0, u.jsxs)(c.PanelBody, {
                        title: (0, s.__)("Name Fields", "directorist"),
                        children: [
                          (0, u.jsx)(c.ToggleControl, {
                            label: (0, s.__)(
                              "Show First Name Field",
                              "directorist",
                            ),
                            checked: t.firstname,
                            onChange: function (e) {
                              return r({ firstname: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)("First Name Label", "directorist"),
                            value: t.firstname_label,
                            onChange: function (e) {
                              return r({ firstname_label: e });
                            },
                          }),
                          (0, u.jsx)(c.ToggleControl, {
                            label: (0, s.__)(
                              "Require First Name",
                              "directorist",
                            ),
                            checked: t.firstname_required,
                            onChange: function (e) {
                              return r({ firstname_required: e });
                            },
                          }),
                          (0, u.jsx)(c.ToggleControl, {
                            label: (0, s.__)(
                              "Show Last Name Field",
                              "directorist",
                            ),
                            checked: t.lastname,
                            onChange: function (e) {
                              return r({ lastname: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)("Last Name Label", "directorist"),
                            value: t.lastname_label,
                            onChange: function (e) {
                              return r({ lastname_label: e });
                            },
                          }),
                          (0, u.jsx)(c.ToggleControl, {
                            label: (0, s.__)(
                              "Require Last Name",
                              "directorist",
                            ),
                            checked: t.lastname_required,
                            onChange: function (e) {
                              return r({ lastname_required: e });
                            },
                          }),
                        ],
                      }),
                      (0, u.jsxs)(c.PanelBody, {
                        title: (0, s.__)("Bio Settings", "directorist"),
                        children: [
                          (0, u.jsx)(c.ToggleControl, {
                            label: (0, s.__)("Show Bio Field", "directorist"),
                            checked: t.bio,
                            onChange: function (e) {
                              return r({ bio: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)("Bio Label", "directorist"),
                            value: t.bio_label,
                            onChange: function (e) {
                              return r({ bio_label: e });
                            },
                          }),
                          (0, u.jsx)(c.ToggleControl, {
                            label: (0, s.__)("Require Bio", "directorist"),
                            checked: t.bio_required,
                            onChange: function (e) {
                              return r({ bio_required: e });
                            },
                          }),
                        ],
                      }),
                      (0, u.jsxs)(c.PanelBody, {
                        title: (0, s.__)("Privacy & Terms", "directorist"),
                        children: [
                          (0, u.jsx)(c.ToggleControl, {
                            label: (0, s.__)(
                              "Enable Privacy Agreement",
                              "directorist",
                            ),
                            checked: t.privacy,
                            onChange: function (e) {
                              return r({ privacy: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)("Privacy Label", "directorist"),
                            value: t.privacy_label,
                            onChange: function (e) {
                              return r({ privacy_label: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)(
                              "Privacy Linking Text",
                              "directorist",
                            ),
                            value: t.privacy_linking_text,
                            onChange: function (e) {
                              return r({ privacy_linking_text: e });
                            },
                          }),
                          (0, u.jsx)(c.ToggleControl, {
                            label: (0, s.__)(
                              "Enable Terms Agreement",
                              "directorist",
                            ),
                            checked: t.terms,
                            onChange: function (e) {
                              return r({ terms: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)("Terms Label", "directorist"),
                            value: t.terms_label,
                            onChange: function (e) {
                              return r({ terms_label: e });
                            },
                          }),
                          (0, u.jsx)(c.TextControl, {
                            label: (0, s.__)(
                              "Terms Linking Text",
                              "directorist",
                            ),
                            value: t.terms_linking_text,
                            onChange: function (e) {
                              return r({ terms_linking_text: e });
                            },
                          }),
                        ],
                      }),
                    ],
                  })
                : null,
              (0, u.jsx)(c.PanelBody, {
                title: (0, s.__)("Recovery Password Settings", "directorist"),
                children: (0, u.jsx)(c.TextControl, {
                  label: (0, s.__)(
                    "Recovery Password Linking Text",
                    "directorist",
                  ),
                  value: t.recovery_password_linking_text,
                  onChange: function (e) {
                    return r({ recovery_password_linking_text: e });
                  },
                }),
              }),
            ],
          }),
          (0, u.jsx)(
            "div",
            b(
              b(
                {},
                (0, o.useBlockProps)({
                  className: "directorist-content-active directorist-w-100",
                }),
              ),
              {},
              {
                children: (0, u.jsx)(l(), {
                  block: d.UU,
                  attributes: t,
                  LoadingResponsePlaceholder: f,
                }),
              },
            ),
          ),
        ],
      });
    },
  });
})();
