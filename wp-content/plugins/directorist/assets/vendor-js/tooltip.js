(function (global, factory) {
  typeof exports === "object" && typeof module !== "undefined"
    ? (module.exports = factory(require("jquery")))
    : typeof define === "function" && define.amd
      ? define(["jquery"], factory)
      : (global.Util = factory(global.jQuery));
})(this, function ($) {
  "use strict";

  $ = $ && $.hasOwnProperty("default") ? $["default"] : $;

  /**
   * --------------------------------------------------------------------------
   * Bootstrap (v4.1.3): util.js
   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
   * --------------------------------------------------------------------------
   */

  var Util = (function ($$$1) {
    /**
     * ------------------------------------------------------------------------
     * Private TransitionEnd Helpers
     * ------------------------------------------------------------------------
     */
    var TRANSITION_END = "transitionend";
    var MAX_UID = 1000000;
    var MILLISECONDS_MULTIPLIER = 1000; // Shoutout AngusCroll (https://goo.gl/pxwQGp)

    function toType(obj) {
      return {}.toString
        .call(obj)
        .match(/\s([a-z]+)/i)[1]
        .toLowerCase();
    }

    function getSpecialTransitionEndEvent() {
      return {
        bindType: TRANSITION_END,
        delegateType: TRANSITION_END,
        handle: function handle(event) {
          if ($$$1(event.target).is(this)) {
            return event.handleObj.handler.apply(this, arguments);
          }

          return undefined;
        },
      };
    }

    function transitionEndEmulator(duration) {
      var _this = this;

      var called = false;
      $$$1(this).one(Util.TRANSITION_END, function () {
        called = true;
      });
      setTimeout(function () {
        if (!called) {
          Util.triggerTransitionEnd(_this);
        }
      }, duration);
      return this;
    }

    function setTransitionEndSupport() {
      $$$1.fn.emulateTransitionEnd = transitionEndEmulator;
      $$$1.event.special[Util.TRANSITION_END] = getSpecialTransitionEndEvent();
    }
    /**
     * --------------------------------------------------------------------------
     * Public Util Api
     * --------------------------------------------------------------------------
     */

    var Util = {
      TRANSITION_END: "bsTransitionEnd",
      getUID: function getUID(prefix) {
        do {
          prefix += ~~(Math.random() * MAX_UID); // "~~" acts like a faster Math.floor() here
        } while (document.getElementById(prefix));

        return prefix;
      },
      getSelectorFromElement: function getSelectorFromElement(element) {
        var selector = element.getAttribute("data-target");

        if (!selector || selector === "#") {
          selector = element.getAttribute("href") || "";
        }

        try {
          return document.querySelector(selector) ? selector : null;
        } catch (err) {
          return null;
        }
      },
      getTransitionDurationFromElement:
        function getTransitionDurationFromElement(element) {
          if (!element) {
            return 0;
          } // Get transition-duration of the element

          var transitionDuration = $$$1(element).css("transition-duration");
          var floatTransitionDuration = parseFloat(transitionDuration); // Return 0 if element or transition duration is not found

          if (!floatTransitionDuration) {
            return 0;
          } // If multiple durations are defined, take the first

          transitionDuration = transitionDuration.split(",")[0];
          return parseFloat(transitionDuration) * MILLISECONDS_MULTIPLIER;
        },
      reflow: function reflow(element) {
        return element.offsetHeight;
      },
      triggerTransitionEnd: function triggerTransitionEnd(element) {
        $$$1(element).trigger(TRANSITION_END);
      },
      // TODO: Remove in v5
      supportsTransitionEnd: function supportsTransitionEnd() {
        return Boolean(TRANSITION_END);
      },
      isElement: function isElement(obj) {
        return (obj[0] || obj).nodeType;
      },
      typeCheckConfig: function typeCheckConfig(
        componentName,
        config,
        configTypes,
      ) {
        for (var property in configTypes) {
          if (Object.prototype.hasOwnProperty.call(configTypes, property)) {
            var expectedTypes = configTypes[property];
            var value = config[property];
            var valueType =
              value && Util.isElement(value) ? "element" : toType(value);

            if (!new RegExp(expectedTypes).test(valueType)) {
              throw new Error(
                componentName.toUpperCase() +
                  ": " +
                  ('Option "' +
                    property +
                    '" provided type "' +
                    valueType +
                    '" ') +
                  ('but expected type "' + expectedTypes + '".'),
              );
            }
          }
        }
      },
    };
    setTransitionEndSupport();
    return Util;
  })($);

  return Util;
});

(function (global, factory) {
  typeof exports === "object" && typeof module !== "undefined"
    ? (module.exports = factory(
        require("jquery"),
        require("popper.js"),
        require("./util.js"),
      ))
    : typeof define === "function" && define.amd
      ? define(["jquery", "popper.js", "./util.js"], factory)
      : (global.Tooltip = factory(global.jQuery, global.Popper, global.Util));
})(this, function ($, Popper, Util) {
  "use strict";

  $ = $ && $.hasOwnProperty("default") ? $["default"] : $;
  Popper =
    Popper && Popper.hasOwnProperty("default") ? Popper["default"] : Popper;
  Util = Util && Util.hasOwnProperty("default") ? Util["default"] : Util;

  function _defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];
      descriptor.enumerable = descriptor.enumerable || false;
      descriptor.configurable = true;
      if ("value" in descriptor) descriptor.writable = true;
      Object.defineProperty(target, descriptor.key, descriptor);
    }
  }

  function _createClass(Constructor, protoProps, staticProps) {
    if (protoProps) _defineProperties(Constructor.prototype, protoProps);
    if (staticProps) _defineProperties(Constructor, staticProps);
    return Constructor;
  }

  function _defineProperty(obj, key, value) {
    if (key in obj) {
      Object.defineProperty(obj, key, {
        value: value,
        enumerable: true,
        configurable: true,
        writable: true,
      });
    } else {
      obj[key] = value;
    }

    return obj;
  }

  function _objectSpread(target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i] != null ? arguments[i] : {};
      var ownKeys = Object.keys(source);

      if (typeof Object.getOwnPropertySymbols === "function") {
        ownKeys = ownKeys.concat(
          Object.getOwnPropertySymbols(source).filter(function (sym) {
            return Object.getOwnPropertyDescriptor(source, sym).enumerable;
          }),
        );
      }

      ownKeys.forEach(function (key) {
        _defineProperty(target, key, source[key]);
      });
    }

    return target;
  }

  /**
   * --------------------------------------------------------------------------
   * Bootstrap (v4.1.3): tooltip.js
   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
   * --------------------------------------------------------------------------
   */

  var Tooltip = (function ($$$1) {
    /**
     * ------------------------------------------------------------------------
     * Constants
     * ------------------------------------------------------------------------
     */
    var NAME = "tooltip";
    var VERSION = "4.1.3";
    var DATA_KEY = "bs.tooltip";
    var EVENT_KEY = "." + DATA_KEY;
    var JQUERY_NO_CONFLICT = $$$1.fn[NAME];
    var CLASS_PREFIX = "bs-tooltip";
    var BSCLS_PREFIX_REGEX = new RegExp("(^|\\s)" + CLASS_PREFIX + "\\S+", "g");
    var DefaultType = {
      animation: "boolean",
      template: "string",
      title: "(string|element|function)",
      trigger: "string",
      delay: "(number|object)",
      html: "boolean",
      selector: "(string|boolean)",
      placement: "(string|function)",
      offset: "(number|string)",
      container: "(string|element|boolean)",
      fallbackPlacement: "(string|array)",
      boundary: "(string|element)",
    };
    var AttachmentMap = {
      AUTO: "auto",
      TOP: "top",
      RIGHT: "right",
      BOTTOM: "bottom",
      LEFT: "left",
    };
    var Default = {
      animation: true,
      template:
        '<div class="tooltip" role="tooltip">' +
        '<div class="arrow"></div>' +
        '<div class="tooltip-inner"></div></div>',
      trigger: "hover focus",
      title: "",
      delay: 0,
      html: false,
      selector: false,
      placement: "top",
      offset: 0,
      container: false,
      fallbackPlacement: "flip",
      boundary: "scrollParent",
    };
    var HoverState = {
      SHOW: "show",
      OUT: "out",
    };
    var Event = {
      HIDE: "hide" + EVENT_KEY,
      HIDDEN: "hidden" + EVENT_KEY,
      SHOW: "show" + EVENT_KEY,
      SHOWN: "shown" + EVENT_KEY,
      INSERTED: "inserted" + EVENT_KEY,
      CLICK: "click" + EVENT_KEY,
      FOCUSIN: "focusin" + EVENT_KEY,
      FOCUSOUT: "focusout" + EVENT_KEY,
      MOUSEENTER: "mouseenter" + EVENT_KEY,
      MOUSELEAVE: "mouseleave" + EVENT_KEY,
    };
    var ClassName = {
      FADE: "fade",
      SHOW: "show",
    };
    var Selector = {
      TOOLTIP: ".tooltip",
      TOOLTIP_INNER: ".tooltip-inner",
      ARROW: ".arrow",
    };
    var Trigger = {
      HOVER: "hover",
      FOCUS: "focus",
      CLICK: "click",
      MANUAL: "manual",
      /**
       * ------------------------------------------------------------------------
       * Class Definition
       * ------------------------------------------------------------------------
       */
    };

    var Tooltip =
      /*#__PURE__*/
      (function () {
        function Tooltip(element, config) {
          /**
           * Check for Popper dependency
           * Popper - https://popper.js.org
           */
          if (typeof Popper === "undefined") {
            throw new TypeError(
              "Bootstrap tooltips require Popper.js (https://popper.js.org)",
            );
          } // private

          this._isEnabled = true;
          this._timeout = 0;
          this._hoverState = "";
          this._activeTrigger = {};
          this._popper = null; // Protected

          this.element = element;
          this.config = this._getConfig(config);
          this.tip = null;

          this._setListeners();
        } // Getters

        var _proto = Tooltip.prototype;

        // Public
        _proto.enable = function enable() {
          this._isEnabled = true;
        };

        _proto.disable = function disable() {
          this._isEnabled = false;
        };

        _proto.toggleEnabled = function toggleEnabled() {
          this._isEnabled = !this._isEnabled;
        };

        _proto.toggle = function toggle(event) {
          if (!this._isEnabled) {
            return;
          }

          if (event) {
            var dataKey = this.constructor.DATA_KEY;
            var context = $$$1(event.currentTarget).data(dataKey);

            if (!context) {
              context = new this.constructor(
                event.currentTarget,
                this._getDelegateConfig(),
              );
              $$$1(event.currentTarget).data(dataKey, context);
            }

            context._activeTrigger.click = !context._activeTrigger.click;

            if (context._isWithActiveTrigger()) {
              context._enter(null, context);
            } else {
              context._leave(null, context);
            }
          } else {
            if ($$$1(this.getTipElement()).hasClass(ClassName.SHOW)) {
              this._leave(null, this);

              return;
            }

            this._enter(null, this);
          }
        };

        _proto.dispose = function dispose() {
          clearTimeout(this._timeout);
          $$$1.removeData(this.element, this.constructor.DATA_KEY);
          $$$1(this.element).off(this.constructor.EVENT_KEY);
          $$$1(this.element).closest(".modal").off("hide.bs.modal");

          if (this.tip) {
            $$$1(this.tip).remove();
          }

          this._isEnabled = null;
          this._timeout = null;
          this._hoverState = null;
          this._activeTrigger = null;

          if (this._popper !== null) {
            this._popper.destroy();
          }

          this._popper = null;
          this.element = null;
          this.config = null;
          this.tip = null;
        };

        _proto.show = function show() {
          var _this = this;

          if ($$$1(this.element).css("display") === "none") {
            throw new Error("Please use show on visible elements");
          }

          var showEvent = $$$1.Event(this.constructor.Event.SHOW);

          if (this.isWithContent() && this._isEnabled) {
            $$$1(this.element).trigger(showEvent);
            var isInTheDom = $$$1.contains(
              this.element.ownerDocument.documentElement,
              this.element,
            );

            if (showEvent.isDefaultPrevented() || !isInTheDom) {
              return;
            }

            var tip = this.getTipElement();
            var tipId = Util.getUID(this.constructor.NAME);
            tip.setAttribute("id", tipId);
            this.element.setAttribute("aria-describedby", tipId);
            this.setContent();

            if (this.config.animation) {
              $$$1(tip).addClass(ClassName.FADE);
            }

            var placement =
              typeof this.config.placement === "function"
                ? this.config.placement.call(this, tip, this.element)
                : this.config.placement;

            var attachment = this._getAttachment(placement);

            this.addAttachmentClass(attachment);
            var container =
              this.config.container === false
                ? document.body
                : $$$1(document).find(this.config.container);
            $$$1(tip).data(this.constructor.DATA_KEY, this);

            if (
              !$$$1.contains(
                this.element.ownerDocument.documentElement,
                this.tip,
              )
            ) {
              $$$1(tip).appendTo(container);
            }

            $$$1(this.element).trigger(this.constructor.Event.INSERTED);
            this._popper = new Popper(this.element, tip, {
              placement: attachment,
              modifiers: {
                offset: {
                  offset: this.config.offset,
                },
                flip: {
                  behavior: this.config.fallbackPlacement,
                },
                arrow: {
                  element: Selector.ARROW,
                },
                preventOverflow: {
                  boundariesElement: this.config.boundary,
                },
              },
              onCreate: function onCreate(data) {
                if (data.originalPlacement !== data.placement) {
                  _this._handlePopperPlacementChange(data);
                }
              },
              onUpdate: function onUpdate(data) {
                _this._handlePopperPlacementChange(data);
              },
            });
            $$$1(tip).addClass(ClassName.SHOW); // If this is a touch-enabled device we add extra
            // empty mouseover listeners to the body's immediate children;
            // only needed because of broken event delegation on iOS
            // https://www.quirksmode.org/blog/archives/2014/02/mouse_event_bub.html

            if ("ontouchstart" in document.documentElement) {
              $$$1(document.body).children().on("mouseover", null, $$$1.noop);
            }

            var complete = function complete() {
              if (_this.config.animation) {
                _this._fixTransition();
              }

              var prevHoverState = _this._hoverState;
              _this._hoverState = null;
              $$$1(_this.element).trigger(_this.constructor.Event.SHOWN);

              if (prevHoverState === HoverState.OUT) {
                _this._leave(null, _this);
              }
            };

            if ($$$1(this.tip).hasClass(ClassName.FADE)) {
              var transitionDuration = Util.getTransitionDurationFromElement(
                this.tip,
              );
              $$$1(this.tip)
                .one(Util.TRANSITION_END, complete)
                .emulateTransitionEnd(transitionDuration);
            } else {
              complete();
            }
          }
        };

        _proto.hide = function hide(callback) {
          var _this2 = this;

          var tip = this.getTipElement();
          var hideEvent = $$$1.Event(this.constructor.Event.HIDE);

          var complete = function complete() {
            if (_this2._hoverState !== HoverState.SHOW && tip.parentNode) {
              tip.parentNode.removeChild(tip);
            }

            _this2._cleanTipClass();

            _this2.element.removeAttribute("aria-describedby");

            $$$1(_this2.element).trigger(_this2.constructor.Event.HIDDEN);

            if (_this2._popper !== null) {
              _this2._popper.destroy();
            }

            if (callback) {
              callback();
            }
          };

          $$$1(this.element).trigger(hideEvent);

          if (hideEvent.isDefaultPrevented()) {
            return;
          }

          $$$1(tip).removeClass(ClassName.SHOW); // If this is a touch-enabled device we remove the extra
          // empty mouseover listeners we added for iOS support

          if ("ontouchstart" in document.documentElement) {
            $$$1(document.body).children().off("mouseover", null, $$$1.noop);
          }

          this._activeTrigger[Trigger.CLICK] = false;
          this._activeTrigger[Trigger.FOCUS] = false;
          this._activeTrigger[Trigger.HOVER] = false;

          if ($$$1(this.tip).hasClass(ClassName.FADE)) {
            var transitionDuration = Util.getTransitionDurationFromElement(tip);
            $$$1(tip)
              .one(Util.TRANSITION_END, complete)
              .emulateTransitionEnd(transitionDuration);
          } else {
            complete();
          }

          this._hoverState = "";
        };

        _proto.update = function update() {
          if (this._popper !== null) {
            this._popper.scheduleUpdate();
          }
        }; // Protected

        _proto.isWithContent = function isWithContent() {
          return Boolean(this.getTitle());
        };

        _proto.addAttachmentClass = function addAttachmentClass(attachment) {
          $$$1(this.getTipElement()).addClass(CLASS_PREFIX + "-" + attachment);
        };

        _proto.getTipElement = function getTipElement() {
          this.tip = this.tip || $$$1(this.config.template)[0];
          return this.tip;
        };

        _proto.setContent = function setContent() {
          var tip = this.getTipElement();
          this.setElementContent(
            $$$1(tip.querySelectorAll(Selector.TOOLTIP_INNER)),
            this.getTitle(),
          );
          $$$1(tip).removeClass(ClassName.FADE + " " + ClassName.SHOW);
        };

        _proto.setElementContent = function setElementContent(
          $element,
          content,
        ) {
          var html = this.config.html;

          if (
            typeof content === "object" &&
            (content.nodeType || content.jquery)
          ) {
            // Content is a DOM node or a jQuery
            if (html) {
              if (!$$$1(content).parent().is($element)) {
                $element.empty().append(content);
              }
            } else {
              $element.text($$$1(content).text());
            }
          } else {
            $element[html ? "html" : "text"](content);
          }
        };

        _proto.getTitle = function getTitle() {
          var title = this.element.getAttribute("data-original-title");

          if (!title) {
            title =
              typeof this.config.title === "function"
                ? this.config.title.call(this.element)
                : this.config.title;
          }

          return title;
        }; // Private

        _proto._getAttachment = function _getAttachment(placement) {
          return AttachmentMap[placement.toUpperCase()];
        };

        _proto._setListeners = function _setListeners() {
          var _this3 = this;

          var triggers = this.config.trigger.split(" ");
          triggers.forEach(function (trigger) {
            if (trigger === "click") {
              $$$1(_this3.element).on(
                _this3.constructor.Event.CLICK,
                _this3.config.selector,
                function (event) {
                  return _this3.toggle(event);
                },
              );
            } else if (trigger !== Trigger.MANUAL) {
              var eventIn =
                trigger === Trigger.HOVER
                  ? _this3.constructor.Event.MOUSEENTER
                  : _this3.constructor.Event.FOCUSIN;
              var eventOut =
                trigger === Trigger.HOVER
                  ? _this3.constructor.Event.MOUSELEAVE
                  : _this3.constructor.Event.FOCUSOUT;
              $$$1(_this3.element)
                .on(eventIn, _this3.config.selector, function (event) {
                  return _this3._enter(event);
                })
                .on(eventOut, _this3.config.selector, function (event) {
                  return _this3._leave(event);
                });
            }

            $$$1(_this3.element)
              .closest(".modal")
              .on("hide.bs.modal", function () {
                return _this3.hide();
              });
          });

          if (this.config.selector) {
            this.config = _objectSpread({}, this.config, {
              trigger: "manual",
              selector: "",
            });
          } else {
            this._fixTitle();
          }
        };

        _proto._fixTitle = function _fixTitle() {
          var titleType = typeof this.element.getAttribute(
            "data-original-title",
          );

          if (this.element.getAttribute("title") || titleType !== "string") {
            this.element.setAttribute(
              "data-original-title",
              this.element.getAttribute("title") || "",
            );
            this.element.setAttribute("title", "");
          }
        };

        _proto._enter = function _enter(event, context) {
          var dataKey = this.constructor.DATA_KEY;
          context = context || $$$1(event.currentTarget).data(dataKey);

          if (!context) {
            context = new this.constructor(
              event.currentTarget,
              this._getDelegateConfig(),
            );
            $$$1(event.currentTarget).data(dataKey, context);
          }

          if (event) {
            context._activeTrigger[
              event.type === "focusin" ? Trigger.FOCUS : Trigger.HOVER
            ] = true;
          }

          if (
            $$$1(context.getTipElement()).hasClass(ClassName.SHOW) ||
            context._hoverState === HoverState.SHOW
          ) {
            context._hoverState = HoverState.SHOW;
            return;
          }

          clearTimeout(context._timeout);
          context._hoverState = HoverState.SHOW;

          if (!context.config.delay || !context.config.delay.show) {
            context.show();
            return;
          }

          context._timeout = setTimeout(function () {
            if (context._hoverState === HoverState.SHOW) {
              context.show();
            }
          }, context.config.delay.show);
        };

        _proto._leave = function _leave(event, context) {
          var dataKey = this.constructor.DATA_KEY;
          context = context || $$$1(event.currentTarget).data(dataKey);

          if (!context) {
            context = new this.constructor(
              event.currentTarget,
              this._getDelegateConfig(),
            );
            $$$1(event.currentTarget).data(dataKey, context);
          }

          if (event) {
            context._activeTrigger[
              event.type === "focusout" ? Trigger.FOCUS : Trigger.HOVER
            ] = false;
          }

          if (context._isWithActiveTrigger()) {
            return;
          }

          clearTimeout(context._timeout);
          context._hoverState = HoverState.OUT;

          if (!context.config.delay || !context.config.delay.hide) {
            context.hide();
            return;
          }

          context._timeout = setTimeout(function () {
            if (context._hoverState === HoverState.OUT) {
              context.hide();
            }
          }, context.config.delay.hide);
        };

        _proto._isWithActiveTrigger = function _isWithActiveTrigger() {
          for (var trigger in this._activeTrigger) {
            if (this._activeTrigger[trigger]) {
              return true;
            }
          }

          return false;
        };

        _proto._getConfig = function _getConfig(config) {
          config = _objectSpread(
            {},
            this.constructor.Default,
            $$$1(this.element).data(),
            typeof config === "object" && config ? config : {},
          );

          if (typeof config.delay === "number") {
            config.delay = {
              show: config.delay,
              hide: config.delay,
            };
          }

          if (typeof config.title === "number") {
            config.title = config.title.toString();
          }

          if (typeof config.content === "number") {
            config.content = config.content.toString();
          }

          Util.typeCheckConfig(NAME, config, this.constructor.DefaultType);
          return config;
        };

        _proto._getDelegateConfig = function _getDelegateConfig() {
          var config = {};

          if (this.config) {
            for (var key in this.config) {
              if (this.constructor.Default[key] !== this.config[key]) {
                config[key] = this.config[key];
              }
            }
          }

          return config;
        };

        _proto._cleanTipClass = function _cleanTipClass() {
          var $tip = $$$1(this.getTipElement());
          var tabClass = $tip.attr("class").match(BSCLS_PREFIX_REGEX);

          if (tabClass !== null && tabClass.length) {
            $tip.removeClass(tabClass.join(""));
          }
        };

        _proto._handlePopperPlacementChange =
          function _handlePopperPlacementChange(popperData) {
            var popperInstance = popperData.instance;
            this.tip = popperInstance.popper;

            this._cleanTipClass();

            this.addAttachmentClass(this._getAttachment(popperData.placement));
          };

        _proto._fixTransition = function _fixTransition() {
          var tip = this.getTipElement();
          var initConfigAnimation = this.config.animation;

          if (tip.getAttribute("x-placement") !== null) {
            return;
          }

          $$$1(tip).removeClass(ClassName.FADE);
          this.config.animation = false;
          this.hide();
          this.show();
          this.config.animation = initConfigAnimation;
        }; // Static

        Tooltip._jQueryInterface = function _jQueryInterface(config) {
          return this.each(function () {
            var data = $$$1(this).data(DATA_KEY);

            var _config = typeof config === "object" && config;

            if (!data && /dispose|hide/.test(config)) {
              return;
            }

            if (!data) {
              data = new Tooltip(this, _config);
              $$$1(this).data(DATA_KEY, data);
            }

            if (typeof config === "string") {
              if (typeof data[config] === "undefined") {
                throw new TypeError('No method named "' + config + '"');
              }

              data[config]();
            }
          });
        };

        _createClass(Tooltip, null, [
          {
            key: "VERSION",
            get: function get() {
              return VERSION;
            },
          },
          {
            key: "Default",
            get: function get() {
              return Default;
            },
          },
          {
            key: "NAME",
            get: function get() {
              return NAME;
            },
          },
          {
            key: "DATA_KEY",
            get: function get() {
              return DATA_KEY;
            },
          },
          {
            key: "Event",
            get: function get() {
              return Event;
            },
          },
          {
            key: "EVENT_KEY",
            get: function get() {
              return EVENT_KEY;
            },
          },
          {
            key: "DefaultType",
            get: function get() {
              return DefaultType;
            },
          },
        ]);

        return Tooltip;
      })();
    /**
     * ------------------------------------------------------------------------
     * jQuery
     * ------------------------------------------------------------------------
     */

    $$$1.fn[NAME] = Tooltip._jQueryInterface;
    $$$1.fn[NAME].Constructor = Tooltip;

    $$$1.fn[NAME].noConflict = function () {
      $$$1.fn[NAME] = JQUERY_NO_CONFLICT;
      return Tooltip._jQueryInterface;
    };

    return Tooltip;
  })($, Popper);

  return Tooltip;
});
