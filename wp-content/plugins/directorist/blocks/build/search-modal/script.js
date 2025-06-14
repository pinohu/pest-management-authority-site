!(function () {
  "use strict";
  document.addEventListener("DOMContentLoaded", function () {
    var e = document.querySelectorAll(
        ".directorist-search-popup-block__button",
      ),
      o = document.querySelector(".directorist-search-popup-block__overlay"),
      t = document.querySelector(".directorist-search-popup-block__popup"),
      c = document.querySelector(".directorist-search-popup-block__form-close"),
      r = document.querySelectorAll(
        ".directorist-search-popup-block .directorist-search-form-action__modal .directorist-modal-btn",
      ),
      s = document.querySelectorAll(
        ".directorist-search-popup-block .directorist-search-modal__overlay",
      ),
      i = document.querySelector(
        ".directorist-search-popup-block .directorist-search-modal__contents__btn--close",
      );
    function d(e) {
      e.preventDefault(),
        t.classList.toggle("show"),
        o.classList.toggle("show"),
        document.body.classList.toggle("directorist-search-popup-block-hidden");
    }
    function n() {
      t.classList.remove("show"),
        o.classList.remove("show"),
        document.body.classList.remove("directorist-search-popup-block-hidden");
    }
    function l() {
      t.classList.toggle("responsive-true"),
        o.classList.remove("show"),
        document.body.classList.remove("directorist-search-popup-block-hidden");
    }
    function a() {
      o.classList.add("show"),
        t.classList.remove("responsive-true"),
        document.body.classList.add("directorist-search-popup-block-hidden");
    }
    o ||
      (((o = document.createElement("div")).className =
        "directorist-search-popup-block__overlay"),
      document.body.appendChild(o)),
      e.forEach(function (e) {
        return e.addEventListener("click", d);
      }),
      o &&
        c &&
        (o.addEventListener("click", n), c.addEventListener("click", n)),
      r.forEach(function (e) {
        return e.addEventListener("click", l);
      }),
      s.forEach(function (e) {
        return e.addEventListener("click", a);
      }),
      i && i.addEventListener("click", a);
  });
})();
