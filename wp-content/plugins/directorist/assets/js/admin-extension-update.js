/******/ (function () {
  // webpackBootstrap
  /*!*************************************************!*\
  !*** ./assets/src/js/admin/extension-update.js ***!
  \*************************************************/
  window.addEventListener("load", function () {
    jQuery(function ($) {
      // update extension
      $("body").on("click", ".atbdp-update-extension", function (e) {
        e.preventDefault();
        var data = $(this).attr("data-update-info");
        $.get(
          "https://directorist.com/wp-json/directorist/extension/" + data,
          function (data, status, request) {
            window.location.href = data;
          },
        );
      });
    });
  });
  /******/
})();
//# sourceMappingURL=admin-extension-update.js.map
