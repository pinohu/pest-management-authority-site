/**
 * @output wp-includes/js/customize-loader.js
 */

/* global _wpCustomizeLoaderSettings */

/**
 * Expose a public API that allows the customizer to be
 * loaded on any page.
 *
 * @namespace wp
 */
window.wp = window.wp || {};

(function (exports, $) {
  var api = wp.customize,
    Loader;

  $.extend($.support, {
    history: !!(window.history && history.pushState),
    hashchange:
      "onhashchange" in window &&
      (document.documentMode === undefined || document.documentMode > 7),
  });

  /**
   * Allows the Customizer to be overlaid on any page.
   *
   * By default, any element in the body with the load-customize class will open
   * an iframe overlay with the URL specified.
   *
   *     e.g. <a class="load-customize" href="<?php echo wp_customize_url(); ?>">Open Customizer</a>
   *
   * @memberOf wp.customize
   *
   * @class
   * @augments wp.customize.Events
   */
  Loader = $.extend(
    {},
    api.Events,
    /** @lends wp.customize.Loader.prototype */ {
      /**
       * Setup the Loader; triggered on document#ready.
       */
      initialize: function () {
        this.body = $(document.body);

        // Ensure the loader is supported.
        // Check for settings, postMessage support, and whether we require CORS support.
        if (
          !Loader.settings ||
          !$.support.postMessage ||
          (!$.support.cors && Loader.settings.isCrossDomain)
        ) {
          return;
        }

        this.window = $(window);
        this.element = $('<div id="customize-container" />').appendTo(
          this.body,
        );

        // Bind events for opening and closing the overlay.
        this.bind("open", this.overlay.show);
        this.bind("close", this.overlay.hide);

        // Any element in the body with the `load-customize` class opens
        // the Customizer.
        $("#wpbody").on("click", ".load-customize", function (event) {
          event.preventDefault();

          // Store a reference to the link that opened the Customizer.
          Loader.link = $(this);
          // Load the theme.
          Loader.open(Loader.link.attr("href"));
        });

        // Add navigation listeners.
        if ($.support.history) {
          this.window.on("popstate", Loader.popstate);
        }

        if ($.support.hashchange) {
          this.window.on("hashchange", Loader.hashchange);
          this.window.triggerHandler("hashchange");
        }
      },

      popstate: function (e) {
        var state = e.originalEvent.state;
        if (state && state.customize) {
          Loader.open(state.customize);
        } else if (Loader.active) {
          Loader.close();
        }
      },

      hashchange: function () {
        var hash = window.location.toString().split("#")[1];

        if (hash && 0 === hash.indexOf("wp_customize=on")) {
          Loader.open(Loader.settings.url + "?" + hash);
        }

        if (!hash && !$.support.history) {
          Loader.close();
        }
      },

      beforeunload: function () {
        if (!Loader.saved()) {
          return Loader.settings.l10n.saveAlert;
        }
      },

      /**
       * Open the Customizer overlay for a specific URL.
       *
       * @param string src URL to load in the Customizer.
       */
      open: function (src) {
        if (this.active) {
          return;
        }

        // Load the full page on mobile devices.
        if (Loader.settings.browser.mobile) {
          return (window.location = src);
        }

        // Store the document title prior to opening the Live Preview.
        this.originalDocumentTitle = document.title;

        this.active = true;
        this.body.addClass("customize-loading");

        /*
         * Track the dirtiness state (whether the drafted changes have been published)
         * of the Customizer in the iframe. This is used to decide whether to display
         * an AYS alert if the user tries to close the window before saving changes.
         */
        this.saved = new api.Value(true);

        this.iframe = $("<iframe />", {
          src: src,
          title: Loader.settings.l10n.mainIframeTitle,
        }).appendTo(this.element);
        this.iframe.one("load", this.loaded);

        // Create a postMessage connection with the iframe.
        this.messenger = new api.Messenger({
          url: src,
          channel: "loader",
          targetWindow: this.iframe[0].contentWindow,
        });

        // Expose the changeset UUID on the parent window's URL so that the customized state can survive a refresh.
        if (history.replaceState) {
          this.messenger.bind("changeset-uuid", function (changesetUuid) {
            var urlParser = document.createElement("a");
            urlParser.href = location.href;
            urlParser.search = $.param(
              _.extend(api.utils.parseQueryString(urlParser.search.substr(1)), {
                changeset_uuid: changesetUuid,
              }),
            );
            history.replaceState(
              { customize: urlParser.href },
              "",
              urlParser.href,
            );
          });
        }

        // Wait for the connection from the iframe before sending any postMessage events.
        this.messenger.bind("ready", function () {
          Loader.messenger.send("back");
        });

        this.messenger.bind("close", function () {
          if ($.support.history) {
            history.back();
          } else if ($.support.hashchange) {
            window.location.hash = "";
          } else {
            Loader.close();
          }
        });

        // Prompt AYS dialog when navigating away.
        $(window).on("beforeunload", this.beforeunload);

        this.messenger.bind("saved", function () {
          Loader.saved(true);
        });
        this.messenger.bind("change", function () {
          Loader.saved(false);
        });

        this.messenger.bind("title", function (newTitle) {
          window.document.title = newTitle;
        });

        this.pushState(src);

        this.trigger("open");
      },

      pushState: function (src) {
        var hash = src.split("?")[1];

        // Ensure we don't call pushState if the user hit the forward button.
        if ($.support.history && window.location.href !== src) {
          history.pushState({ customize: src }, "", src);
        } else if (!$.support.history && $.support.hashchange && hash) {
          window.location.hash = "wp_customize=on&" + hash;
        }

        this.trigger("open");
      },

      /**
       * Callback after the Customizer has been opened.
       */
      opened: function () {
        Loader.body
          .addClass("customize-active full-overlay-active")
          .attr("aria-busy", "true");
      },

      /**
       * Close the Customizer overlay.
       */
      close: function () {
        var self = this,
          onConfirmClose;
        if (!self.active) {
          return;
        }

        onConfirmClose = function (confirmed) {
          if (confirmed) {
            self.active = false;
            self.trigger("close");

            // Restore document title prior to opening the Live Preview.
            if (self.originalDocumentTitle) {
              document.title = self.originalDocumentTitle;
            }
          } else {
            // Go forward since Customizer is exited by history.back().
            history.forward();
          }
          self.messenger.unbind("confirmed-close", onConfirmClose);
        };
        self.messenger.bind("confirmed-close", onConfirmClose);

        Loader.messenger.send("confirm-close");
      },

      /**
       * Callback after the Customizer has been closed.
       */
      closed: function () {
        Loader.iframe.remove();
        Loader.messenger.destroy();
        Loader.iframe = null;
        Loader.messenger = null;
        Loader.saved = null;
        Loader.body
          .removeClass("customize-active full-overlay-active")
          .removeClass("customize-loading");
        $(window).off("beforeunload", Loader.beforeunload);
        /*
         * Return focus to the link that opened the Customizer overlay after
         * the body element visibility is restored.
         */
        if (Loader.link) {
          Loader.link.focus();
        }
      },

      /**
       * Callback for the `load` event on the Customizer iframe.
       */
      loaded: function () {
        Loader.body.removeClass("customize-loading").attr("aria-busy", "false");
      },

      /**
       * Overlay hide/show utility methods.
       */
      overlay: {
        show: function () {
          this.element.fadeIn(200, Loader.opened);
        },

        hide: function () {
          this.element.fadeOut(200, Loader.closed);
        },
      },
    },
  );

  // Bootstrap the Loader on document#ready.
  $(function () {
    Loader.settings = _wpCustomizeLoaderSettings;
    Loader.initialize();
  });

  // Expose the API publicly on window.wp.customize.Loader.
  api.Loader = Loader;
})(wp, jQuery);
