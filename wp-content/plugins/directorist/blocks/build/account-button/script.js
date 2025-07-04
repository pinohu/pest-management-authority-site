!(function () {
  "use strict";
  document.addEventListener("DOMContentLoaded", function () {
    var t = document.querySelectorAll(
      ".directorist-account-block-logged-mode .avatar",
    );
    Object.values(t).some(function (t) {
      return !t;
    }) ||
      t.forEach(function (t) {
        var e = t.closest(".directorist-account-block-logged-mode"),
          o = e.querySelector(
            ".directorist-account-block-logged-mode__overlay",
          ),
          c = e.querySelector(
            ".directorist-account-block-logged-mode__navigation",
          );
        o ||
          (((o = document.createElement("div")).className =
            "directorist-account-block-logged-mode__overlay"),
          e.appendChild(o)),
          t &&
            o &&
            (t.addEventListener("click", function () {
              c &&
                o &&
                (c.classList.toggle("show"), o.classList.toggle("show"));
            }),
            o.addEventListener("click", function () {
              c &&
                o &&
                (c.classList.remove("show"), o.classList.remove("show"));
            }));
      });
  }),
    document.addEventListener("DOMContentLoaded", function () {
      var t = {
        clickBtns: document.querySelectorAll(
          ".directorist-account-block-logout-mode .wp-block-button__link",
        ),
        loginInBtn: document.querySelector(".directory_regi_btn button"),
        popup: document.getElementById("directorist-account-block-login-modal"),
        closeBtn: document.querySelector(
          "#directorist-account-block-login-modal .directorist-account-block-close",
        ),
      };
      if (
        !Object.values(t).some(function (t) {
          return !t;
        })
      ) {
        var e = function (t) {
            t && (t.style.display = "block");
          },
          o = function (t) {
            t && (t.style.display = "none");
          };
        t.clickBtns.forEach(function (o, c) {
          o.addEventListener("click", function () {
            return e(t.popup);
          });
        }),
          t.closeBtn &&
            t.closeBtn.addEventListener("click", function () {
              return o(t.popup);
            }),
          t.popup &&
            t.popup.addEventListener("click", function (e) {
              e.target === t.popup && o(t.popup);
            }),
          t.loginInBtn &&
            t.loginInBtn.addEventListener("click", function (c) {
              var n, i;
              c.preventDefault(),
                (n = t.signupPopup),
                (i = t.popup),
                o(n),
                e(i);
            });
      }
    });
})();
