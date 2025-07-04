/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {
  // Site title and description.
  wp.customize("blogname", function (value) {
    value.bind(function (to) {
      $(".site-title a").text(to);
    });
  });
  wp.customize("blogdescription", function (value) {
    value.bind(function (to) {
      $(".site-tagline").text(to);
    });
  });

  // Hero section customizations
  wp.customize("hero_title", function (value) {
    value.bind(function (to) {
      $(".hero-title").text(to);
    });
  });

  wp.customize("hero_description", function (value) {
    value.bind(function (to) {
      $(".hero-description").text(to);
    });
  });

  // Header text color.
  wp.customize("header_textcolor", function (value) {
    value.bind(function (to) {
      if ("blank" === to) {
        $(".site-title, .site-description").css({
          clip: "rect(1px, 1px, 1px, 1px)",
          position: "absolute",
        });
      } else {
        $(".site-title, .site-description").css({
          clip: "auto",
          position: "relative",
        });
        $(".site-title a, .site-description").css({
          color: to,
        });
      }
    });
  });

  // Primary color customization
  wp.customize("primary_color", function (value) {
    value.bind(function (to) {
      var style =
        '<style id="customizer-primary-color">:root { --color-primary: ' +
        to +
        "; }</style>";
      $("#customizer-primary-color").remove();
      $("head").append(style);
    });
  });

  // Secondary color customization
  wp.customize("secondary_color", function (value) {
    value.bind(function (to) {
      var style =
        '<style id="customizer-secondary-color">:root { --color-secondary: ' +
        to +
        "; }</style>";
      $("#customizer-secondary-color").remove();
      $("head").append(style);
    });
  });
})(jQuery);
