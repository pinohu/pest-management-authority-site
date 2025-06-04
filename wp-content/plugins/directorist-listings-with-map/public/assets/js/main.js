(function ($) {
  jQuery(document).ready(function ($) {
    /*$.each($("input[name='view_as']:checked"), function(){
            view_as = $(this).val();
        });*/
    var nonce_get = $("#directorist-search-area").attr("data-nonce");
    var view_columns = $("#directorist").attr("data-view-columns");
    var text_field = $(".search-text").attr("data-text");
    var category_field = $(".search-category").attr("data-cat");
    var location_field = $(".search-location").attr("data-loc");
    var address_field = $(".search-address").attr("data-address");
    var price_field = $(".range_single").attr("data-price");
    var price_range_field = $(".price-frequency").attr("data-price-range");
    var rating_field = $(".search-rating").attr("data-rating");
    var radius_field = $(".search-radius").attr("data-radius");
    var open_field = $(".search-open").attr("data-open");
    var tag_field = $(".ads-filter-tags").attr("data-tag");
    var custom_search_field = $(".atbdp-custom-fields-search").attr(
      "data-custom-search-field",
    );
    var website_field = $(".search-website").attr("data-website");
    var email_field = $(".search-email").attr("data-email");
    var phone_field = $(".search-phone").attr("data-phone");
    var fax_field = $(".search-fax").attr("data-fax");
    var zip_field = $(".search-zip").attr("data-zip");
    var reset_filters = $(".reset-filters").attr("data-reset");
    var apply_filter = $(".ajax-search").attr("data-apply");
    var directory_type = $("#directory_type").val();
    var map_zoom_level = $("#map_zoom_level").val();

    let mapWrapper = $(".directorist-map-wrapper");
    let moreFiltrContents = () =>
      $(
        ".dlm-filter-slide.dlm-filter-slide-wrapper .directorist-more-filter-contents",
      );
    let colTwoMapSearch = $(
      ".directorist-map-columns-two .directorist-map-search",
    );
    let directoristMap = $(".directorist-map");
    let directoristListings = $(".directorist-listing");
    let mapColThree = $(".directorist-map-columns-three");
    let mapColTwoAdSearch = $(
      ".directorist-map-columns-two .directorist-ad-search",
    );
    let mapColTwoMSListings = $(
      ".directorist-map-columns-two .directorist-map-search .directorist-listing",
    );

    moreFiltrContents().hide();
    $(".directorist-ajax-search-result").hide();
    // function for select2 initialization
    function select2Initialize() {
      // Category
      $("#cat-type").select2({
        placeholder: directorist.i18n_text.category_selection,
        allowClear: true,
        templateResult: function (data) {
          // We only really care if there is an element to pull classes from
          if (!data.element) {
            return data.text;
          }
          var $element = $(data.element);
          var $wrapper = $("<span></span>");
          $wrapper.addClass($element[0].className);
          $wrapper.text(data.text);
          return $wrapper;
        },
      });

      //location
      $("#loc-type").select2({
        placeholder: directorist.i18n_text.location_selection,
        allowClear: true,
        templateResult: function (data) {
          // We only really care if there is an element to pull classes from
          if (!data.element) {
            return data.text;
          }
          var $element = $(data.element);
          var $wrapper = $("<span></span>");
          $wrapper.addClass($element[0].className);
          $wrapper.text(data.text);
          return $wrapper;
        },
      });
    }

    //initialize range slider
    var directorist_range_slider = (selector, obj) => {
      var isDraging = false,
        max = obj.maxValue,
        min = obj.minValue,
        down = "mousedown",
        up = "mouseup",
        move = "mousemove",
        div = `
                    <div class="directorist-range-slider1" draggable="true"></div>
                    <input type='hidden' class="directorist-range-slider-minimum" name="minimum" value=${min} />
                    <div class="directorist-range-slider-child"></div>
                `;

      var touch = "ontouchstart" in document.documentElement;
      if (touch) {
        down = "touchstart";
        up = "touchend";
        move = "touchmove";
      }

      //RTL
      var isRTL = directorist.rtl === "true";
      var direction;
      if (isRTL) {
        direction = "right";
      } else {
        direction = "left";
      }

      var slider = document.querySelectorAll(selector);
      slider.forEach((id, index) => {
        var sliderDataMin = min;
        var sliderDataUnit = id.getAttribute("data-slider-unit");
        id.setAttribute(
          "style",
          `max-width: ${obj.maxWidth}; border: ${obj.barBorder}; width: 100%; height: 4px; background: ${obj.barColor}; position: relative; border-radius: 2px;`,
        );
        id.innerHTML = div;
        let slide1 = id.querySelector(".directorist-range-slider1"),
          width = id.clientWidth;

        slide1.style.background = obj.pointerColor;
        slide1.style.border = obj.pointerBorder;
        id
          .closest(".directorist-range-slider-wrap")
          .querySelector(".directorist-range-slider-current-value").innerHTML =
          `<span>${min}</span> ${sliderDataUnit}`;

        var x = null,
          count = 0,
          slid1_val = 0,
          slid1_val2 = sliderDataMin,
          count2 = width;

        if (window.outerWidth < 600) {
          id.classList.add("m-device");
          slide1.classList.add("m-device2");
        }
        slide1.addEventListener(down, (event) => {
          if (!touch) {
            event.preventDefault();
            event.stopPropagation();
          }
          x = event.clientX;
          if (touch) {
            x = event.touches[0].clientX;
          }
          isDraging = true;
          event.target.classList.add("directorist-rs-active");
        });
        document.body.addEventListener(up, (event2) => {
          if (!touch) {
            event2.preventDefault();
            event2.stopPropagation();
          }
          isDraging = false;
          slid1_val2 = slid1_val;
          slide1.classList.remove("directorist-rs-active");
        });

        slide1.classList.add("directorist-rs-active1");
        count = width / max;
        if (slide1.classList.contains("directorist-rs-active1")) {
          var onLoadValue = count * min;
          id
            .closest(".directorist-range-slider-wrap")
            .querySelector(
              ".directorist-range-slider-current-value span",
            ).innerHTML = sliderDataMin;
          id.querySelector(".directorist-range-slider-minimum").value =
            sliderDataMin;
          id.querySelector(".directorist-rs-active1").style[direction] =
            onLoadValue <= 0 ? 0 : onLoadValue + "px";
          id.querySelector(".directorist-range-slider-child").style.width =
            onLoadValue <= 0 ? 0 : onLoadValue + "px";
        }

        document.body.addEventListener(move, (e) => {
          if (isDraging) {
            count = !isRTL
              ? e.clientX + (slid1_val2 * width) / max - x
              : -e.clientX + (slid1_val2 * width) / max + x;
            if (touch) {
              count = !isRTL
                ? e.touches[0].clientX + (slid1_val2 * width) / max - x
                : -e.touches[0].clientX + (slid1_val2 * width) / max + x;
            }
            if (count < 0) {
              count = 0;
            } else if (count > count2 - 18) {
              count = count2 - 18;
            }
          }
          if (slide1.classList.contains("directorist-rs-active")) {
            slid1_val = Math.floor((max / (width - 18)) * count);
            id
              .closest(".directorist-range-slider-wrap")
              .querySelector(
                ".directorist-range-slider-current-value",
              ).innerHTML = `<span>${slid1_val}</span> ${sliderDataUnit}`;
            id.querySelector(".directorist-range-slider-minimum").value =
              slid1_val;
            id
              .closest(".directorist-range-slider-wrap")
              .querySelector(".directorist-range-slider-value").value =
              slid1_val;
            id.querySelector(".directorist-rs-active").style[direction] =
              count + "px";
            id.querySelector(".directorist-range-slider-child").style.width =
              count + "px";
          }
        });
      });
    };

    function directorist_callingSlider() {
      const minValueWrapper = document.querySelector(
        ".directorist-custom-range-slider__range",
      );
      var default_args = {
        maxValue: 1000,
        minValue: parseInt(minValueWrapper && minValueWrapper.value),
        maxWidth: "100%",
        barColor: "#d4d5d9",
        barBorder: "none",
        pointerColor: "#fff",
        pointerBorder: "4px solid #444752",
      };

      var config =
        directorist.slider_config &&
        typeof directorist.slider_config === "object"
          ? Object.assign(default_args, directorist.slider_config)
          : default_args;

      directorist_range_slider(".directorist-range-slider", config);
    }

    //ajax search
    $("body").on("submit", "#directorist-search-area-form", function (e) {
      e.preventDefault();
      var miles = parseInt($(".directorist-range-slider-minimum").val());
      var default_args = {
        maxValue: 1000,
        minValue: miles,
        maxWidth: "100%",
        barColor: "#d4d5d9",
        barBorder: "none",
        pointerColor: "#fff",
        pointerBorder: "4px solid #444752",
      };

      var config = default_args;
      var display_header = $("#display_header").val();
      var header_title = $("#header_title").val();
      var show_pagination = $("#show_pagination").val();
      var listings_per_page = $("#listings_per_page").val();
      var location_slug = $("#location_slug").val();
      var category_slug = $("#category_slug").val();
      var tag_slug = $("#tag_slug").val();
      var key = $('.directorist-map-search input[name="q"]').val();
      var location = $(".bdas-category-location").val();
      var category = $(".bdas-category-search").val();
      var open_now = [];
      var price = [];
      var custom_field = {};
      var website = $('input[name="website"]').val();
      var phone = $('input[name="phone"]').val();
      var address = $('input[name="address"]').val();
      var zip_code = $('input[name="zip"]').val();
      var fax_field = $('input[name="fax"]').val();
      var email = $('input[name="email"]').val();
      var cityLat = $("#cityLat").val();
      var cityLng = $("#cityLng").val();
      var tag = "";
      var search_by_rating = $('[name="search_by_rating"]').val();
      var view_as = "";
      if ($(".map-view-grid").hasClass("active")) {
        view_as = "grid";
      } else if ($(".map-view-list").hasClass("active")) {
        view_as = "list";
      }
      var sort_by = "";
      if ($(".sort-title-asc").hasClass("active")) {
        sort_by = "title-asc";
      } else if ($(".sort-title-desc").hasClass("active")) {
        sort_by = "title-desc";
      } else if ($(".sort-date-desc").hasClass("active")) {
        sort_by = "date-desc";
      } else if ($(".sort-date-asc").hasClass("active")) {
        sort_by = "date-asc";
      } else if ($(".sort-price-asc").hasClass("active")) {
        sort_by = "price-asc";
      } else if ($(".sort-price-desc").hasClass("active")) {
        sort_by = "price-desc";
      } else if ($(".sort-rand").hasClass("active")) {
        sort_by = "rand";
      }
      mapWrapper.addClass("directorist-lwm-loading");
      $('input[name^="price["]').each(function (index, el) {
        price.push($(el).val());
      });
      var checkValue = [];
      $('[name^="custom_field"]').each(function (index, el) {
        var test = $(el).attr("name");
        var type = $(el).attr("type");
        var post_id = test.replace(/(custom_field\[)/, "").replace(/\]/, "");
        if ("radio" === type) {
          $.each(
            $("input[name='custom_field[" + post_id + "]']:checked"),
            function () {
              value = $(this).val();
              custom_field[post_id] = value;
            },
          );
        } else if ("checkbox" === type) {
          post_id = post_id.split("[]")[0];
          $.each(
            $("input[name='custom_field[" + post_id + "][]']:checked"),
            function () {
              value = $(this).val();
              checkValue.push(value);
              custom_field[post_id] = checkValue;
            },
          );
        } else {
          var value = $(el).val();
          custom_field[post_id] = value;
        }
      });
      $.each($("input[name='open_now']:checked"), function () {
        open_now.push($(this).val());
      });
      $.each($("input[name='in_tag[]']:checked"), function () {
        tag = $(this).val();
      });
      /* $.each($("input[name='search_by_rating']:checked"), function () {
                search_by_rating = $(this).val();
            }); */
      mapColTwoMSListings.fadeOut(1000);
      $.ajax({
        url: bdrr_submit.ajax_url,
        type: "POST",
        data: {
          action: "ajax_search_listing",
          map_height: $("#map_height").val(),
          listings_with_map_columns: $("#listings_with_map_columns").val(),
          display_header: display_header,
          header_title: header_title,
          show_pagination: show_pagination,
          listings_per_page: listings_per_page,
          location_slug: location_slug,
          category_slug: category_slug,
          tag_slug: tag_slug,
          key: key,
          location: location,
          category: category,
          price: price,
          open_now: open_now,
          website: website,
          phone: phone,
          address: address,
          zip_code: zip_code,
          email: email,
          miles: miles,
          cityLat: cityLat,
          cityLng: cityLng,
          tag: tag,
          search_by_rating: search_by_rating,
          view_as: view_as,
          sort_by: sort_by,
          custom_field: custom_field,
          nonce_get: nonce_get,
          view_columns: view_columns,
          text_field: text_field,
          category_field: category_field,
          location_field: location_field,
          address_field: address_field,
          price_field: price_field,
          price_range_field: price_range_field,
          rating_field: rating_field,
          radius_field: radius_field,
          open_field: open_field,
          tag_field: tag_field,
          custom_search_field: custom_search_field,
          email_field: email_field,
          phone_field: phone_field,
          fax: fax_field,
          zip_field: zip_field,
          reset_filters: reset_filters,
          apply_filter: apply_filter,
          directory_type: $("#directory_type").val(),
          map_zoom_level: map_zoom_level,
        },
        success: function (html) {
          mapWrapper.removeClass("directorist-lwm-loading");
          if (html.no_listing !== "no_listing") {
            if (html.search) {
              $(".directorist-map-search")
                .empty()
                .html(
                  `<div class="directorist-map-search-content">${html.search}</div>`,
                );
              // select2Initialize();
            } else {
              $(".directorist-map-search").html("<div></div>");
              //select2Initialize();
            }
            $(".directorist-listing").html("");
            $(".directorist-map-listing").remove();
            $(".directorist-ajax-search-result").show();
            $(".directorist-ajax-search-result").empty();
            $(".directorist-ajax-search-result").append(html.listings);
            var _listing = $(
              ".directorist-map-columns-two .directorist-listing ",
            );
            colTwoMapSearch.append(_listing);
            window.dispatchEvent(
              new CustomEvent("directorist-reload-listings-map-archive"),
            );
            if ($(window).width() <= 1199) {
              $("#js-dlm-map").click();
              directoristMap.css("visibility", "hidden");
              mapColThree.addClass("directorist-lwm-loading");
              setTimeout(() => {
                $("#js-dlm-listings").click();
                directoristMap.css("visibility", "visible");
                mapColThree.removeClass("directorist-lwm-loading");
              }, 1000);
            }
          } else {
            let iconURL =
              directorist.assets_url +
              "icons/line-awesome/svgs/frown-open-solid.svg";
            let iconHTML = directorist.icon_markup
              .replace("##URL##", iconURL)
              .replace("##CLASS##", "");
            $(".directorist-listing").html(
              '<div class="atbd-ajax-404error">\n' +
                "                    " +
                iconHTML +
                "\n" +
                "                    <h3>" +
                bdrr_submit.nothing_found_text +
                "</h3>\n" +
                "                    <p>" +
                bdrr_submit.search_changing_text +
                "</p>\n" +
                "                </div>",
            );
            directoristMap.html(html.listings);
            directoristListings.addClass("bdmv-nolisting");

            window.dispatchEvent(
              new CustomEvent("directorist-reload-listings-map-archive"),
            );
            select2Initialize();
          }

          $("body").on(
            "click",
            ".dlm-filter-slide .dlm_filter-btn",
            function () {
              directorist_range_slider(".directorist-range-slider", config);
            },
          );

          $('input[name="q"]').val(key);
          $('input[name="address"]').val(address);
          $('input[name="zip"]').val(zip_code);
          if (category !== "") {
            $(".bdas-category-search option[value=" + category + "]").attr(
              "selected",
              true,
            );
          }
          if (location !== "") {
            $(".bdas-category-location option[value=" + location + "]").attr(
              "selected",
              true,
            );
          }
          select2Initialize();

          moreFiltrContents().slideUp();
          $(".directorist-map-columns-two .directorist-ad-search").css(
            "height",
            "auto",
          );

          document.body.dispatchEvent(
            new CustomEvent("directorist-reload-map-api-field"),
          );

          let events = [
            new CustomEvent("directorist-search-form-nav-tab-reloaded"),
            new CustomEvent("directorist-reload-select2-fields"),
            new CustomEvent("directorist-reload-map-api-field"),
            new CustomEvent("triggerSlice"),
          ];

          events.forEach((event) => {
            document.body.dispatchEvent(event);
            window.dispatchEvent(event);
          });
        },
      });
    });

    //ajax pagination
    $("body").on(
      "click",
      ".directorist-filter-pagination-ajx a.haspaglink",
      function () {
        var $this = jQuery(this);
        var skeyword = $this.data("skeyword");
        var pageno = $(this).data("pageurl");
        var display_header = $("#display_header").val();
        var header_title = $("#header_title").val();
        var show_pagination = $("#show_pagination").val();
        var listings_per_page = $("#listings_per_page").val();
        var location_slug = $("#location_slug").val();
        var category_slug = $("#category_slug").val();
        var tag_slug = $("#tag_slug").val();
        var key = $('input[name="q"]').val();
        var location = $(".bdas-category-location").val();
        var category = $(".bdas-category-search").val();
        var open_now = [];
        var price = [];
        var custom_field = {};
        var website = $('input[name="website"]').val();
        var phone = $('input[name="phone"]').val();
        var address = $('input[name="address"]').val();
        var zip_code = $('input[name="zip"]').val();
        var email = $('input[name="email"]').val();
        var miles = $(".atbdrs-value").val();
        var cityLat = $("#cityLat").val();
        var cityLng = $("#cityLng").val();
        var tag = "";
        var search_by_rating = $('select[name="search_by_rating"]').val();
        var view_as = "";
        if ($(".directorist-viewas__item--grid").hasClass("active")) {
          view_as = "grid";
        } else if ($(".directorist-viewas__item--list").hasClass("active")) {
          view_as = "list";
        }
        var sort_by = "";
        if ($(".sort-title-asc").hasClass("active")) {
          sort_by = "title-asc";
        } else if ($(".sort-title-desc").hasClass("active")) {
          sort_by = "title-desc";
        } else if ($(".sort-date-desc").hasClass("active")) {
          sort_by = "date-desc";
        } else if ($(".sort-date-asc").hasClass("active")) {
          sort_by = "date-asc";
        } else if ($(".sort-price-asc").hasClass("active")) {
          sort_by = "price-asc";
        } else if ($(".sort-price-desc").hasClass("active")) {
          sort_by = "price-desc";
        } else if ($(".sort-rand").hasClass("active")) {
          sort_by = "rand";
        }
        mapWrapper.addClass("directorist-lwm-loading");
        $('input[name^="price["]').each(function (index, el) {
          price.push($(el).val());
        });
        $.each($("input[name='open_now']:checked"), function () {
          open_now.push($(this).val());
        });
        $.each($("input[name='in_tag[]']:checked"), function () {
          tag = $(this).val();
        });
        /* $.each($("input[name='search_by_rating']:checked"), function () {
                search_by_rating = $(this).val();
            }); */
        $('[name^="custom_field"]').each(function (index, el) {
          var test = $(el).attr("name");
          var type = $(el).attr("type");
          var post_id = test.replace(/(custom_field\[)/, "").replace(/\]/, "");
          if ("radio" === type) {
            $.each(
              $("input[name='custom_field[" + post_id + "]']:checked"),
              function () {
                value = $(this).val();
                custom_field[post_id] = value;
              },
            );
          } else if ("checkbox" === type) {
            post_id = post_id.split("[]")[0];
            $.each(
              $("input[name='custom_field[" + post_id + "][]']:checked"),
              function () {
                var checkValue = [];
                value = $(this).val();
                checkValue.push(value);
                custom_field[post_id] = checkValue;
              },
            );
          } else {
            var value = $(el).val();
            custom_field[post_id] = value;
          }
        });
        mapColTwoMSListings.fadeOut(1000);
        $.ajax({
          url: bdrr_submit.ajax_url,
          type: "POST",
          data: {
            action: "ajax_search_listing",
            map_height: $("#map_height").val(),
            listings_with_map_columns: $("#listings_with_map_columns").val(),
            view_as: view_as,
            display_header: display_header,
            header_title: header_title,
            show_pagination: show_pagination,
            listings_per_page: listings_per_page,
            location_slug: location_slug,
            category_slug: category_slug,
            tag_slug: tag_slug,
            key: key,
            location: location,
            category: category,
            custom_field: custom_field,
            price: price,
            open_now: open_now,
            website: website,
            phone: phone,
            address: address,
            zip_code: zip_code,
            email: email,
            miles: miles,
            cityLat: cityLat,
            cityLng: cityLng,
            tag: tag,
            search_by_rating: search_by_rating,
            sort_by: sort_by,
            skeyword: skeyword,
            pageno: pageno,
            nonce_get: nonce_get,
            view_columns: view_columns,
            text_field: text_field,
            category_field: category_field,
            location_field: location_field,
            address_field: address_field,
            price_field: price_field,
            price_range_field: price_range_field,
            rating_field: rating_field,
            radius_field: radius_field,
            open_field: open_field,
            tag_field: tag_field,
            custom_search_field: custom_search_field,
            website_field: website_field,
            email_field: email_field,
            phone_field: phone_field,
            fax_field: fax_field,
            zip_field: zip_field,
            reset_filters: reset_filters,
            apply_filter: apply_filter,
            directory_type: $("#directory_type").val(),
            map_zoom_level: map_zoom_level,
          },
          success: function (html) {
            if ($(window).width() > 1199) {
              $(".directorist-map-wrapper").removeClass(
                "directorist-lwm-loading",
              );
            }
            if (html.search) {
              $(".directorist-map-search").empty().html(html.search);
            } else {
              $(".directorist-map-search").html("<div></div>");
            }
            if (html.no_listing !== "no_listing") {
              directoristListings.html("");
              $(".directorist-map-listing").remove();
              $(".directorist-ajax-search-result").show();
              $(".directorist-ajax-search-result").empty();
              $(".directorist-ajax-search-result").append(html.listings);
              var _listing = $(
                ".directorist-map-columns-two .directorist-listing ",
              );
              colTwoMapSearch.append(_listing);
              window.dispatchEvent(
                new CustomEvent("directorist-reload-listings-map-archive"),
              );

              //Tweaks: OpensStreet map loading on smaller devices
              if ($(window).width() <= 1199) {
                $("#js-dlm-map").click();
                $(".directorist-map").css("visibility", "hidden");
                setTimeout(() => {
                  $("#js-dlm-listings").click();
                  $(".directorist-map").css("visibility", "visible");
                  $(".directorist-map-wrapper").removeClass(
                    "directorist-lwm-loading",
                  );
                }, 1000);
              }
            } else {
              let iconURL =
                directorist.assets_url +
                "icons/line-awesome/svgs/frown-open-solid.svg";
              let iconHTML = directorist.icon_markup
                .replace("##URL##", iconURL)
                .replace("##CLASS##", "");
              $(".directorist-map-wrapper").removeClass(
                "directorist-lwm-loading",
              );
              directoristListings.html(
                '<div class="atbd-ajax-404error">\n' +
                  "                    " +
                  iconHTML +
                  "\n" +
                  "                    <h3>" +
                  bdrr_submit.nothing_found_text +
                  "</h3>\n" +
                  "                    <p>" +
                  bdrr_submit.search_changing_text +
                  "</p>\n" +
                  "                </div>",
              );
              directoristMap.html(html.listings);
              directoristListings.addClass("bdmv-nolisting");

              window.dispatchEvent(
                new CustomEvent("directorist-reload-listings-map-archive"),
              );
            }
            $('input[name="q"]').val(key);
            $('input[name="address"]').val(address);
            $('input[name="zip"]').val(zip_code);
            if (category !== "") {
              $(".bdas-category-search option[value=" + category + "]").attr(
                "selected",
                true,
              );
            }
            if (location !== "") {
              $(".bdas-category-location option[value=" + location + "]").attr(
                "selected",
                true,
              );
            }
            setTimeout(() => {
              moreFiltrContents().slideUp();
              $(".directorist-map-columns-two .directorist-ad-search").css(
                "height",
                "auto",
              );
            }, 0);

            select2Initialize();

            document.body.dispatchEvent(
              new CustomEvent("directorist-reload-map-api-field"),
            );

            let events = [
              new CustomEvent("directorist-search-form-nav-tab-reloaded"),
              new CustomEvent("directorist-reload-select2-fields"),
              new CustomEvent("directorist-reload-map-api-field"),
              new CustomEvent("triggerSlice"),
            ];

            events.forEach((event) => {
              document.body.dispatchEvent(event);
              window.dispatchEvent(event);
            });
          },
          error: function (err) {
            select2Initialize();
          },
        });
      },
    );

    $(".directorist-map-columns-two .directorist-listing").appendTo(
      ".directorist-map-columns-two .directorist-map-search",
    );

    //All listing with map: filter search style(Slide / dropdown)
    $("body").on("click", ".dlm-filter-slide .dlm_filter-btn", function () {
      $(this).toggleClass("active");
      moreFiltrContents().slideToggle();
      $(".directorist-map-columns-two .directorist-ad-search").css(
        "height",
        "auto",
      );
    });
    $("body").on(
      "click",
      ".dlm-filter-slide .ajax-search-filter, .directorist-advanced-filter__action button",
      function () {
        $(".dlm-filter-slide .dlm_filter-btn").removeClass("active");
        moreFiltrContents().slideUp();
      },
    );

    $(".dlm-filter-dropdown .ajax-search-filter").on("click", function () {
      setTimeout(function () {
        $(
          ".dlm-filter-dropdown .directorist-more-filter-contents, .dlm-filter-dropdown .dlm_filter-btn",
        ).removeClass("active");
        //$(".directorist-map-columns-two .directorist-listing ").removeClass("dlm-filter-overlay");
      }, 1000);
    });

    //responsive fix
    $(".directorist-res-btn").on("click", function (e) {
      e.preventDefault();
      $(this).addClass("active");
      $(this).siblings().removeClass("active");
      if ($(".directorist-map-columns-two #js-dlm-search").hasClass("active")) {
        $(".directorist-listing, .directorist-map-listing").hide();
        $(".directorist-map-search-content, .directorist-map-search").show();
        $(".directorist-map-columns-two .directorist-ad-search").show();
      } else if (
        $(".directorist-map-columns-two #js-dlm-listings").hasClass("active")
      ) {
        $(
          ".directorist-map-search-content, .directorist-map-listing, .directorist-ajax-search-result",
        ).hide();
        $("#directorist-search-area").hide();
        $(".directorist-listing, .directorist-map-search").show();
        if ($(".directorist-map-search .directorist-listing ").length === 2) {
          $(".directorist-map-search-content + .directorist-listing ").hide();
        }
      } else if (
        $(".directorist-map-columns-two #js-dlm-map").hasClass("active")
      ) {
        $(
          ".directorist-map-search-content, .directorist-listing , .directorist-map-search",
        ).hide();
        $(".directorist-map-listing, .directorist-ajax-search-result").show();
        $(".directorist-map-listing").removeClass("directorist-map-hide");
        $(
          ".directorist-map-columns-two .directorist-ajax-search-result .directorist-map",
        ).show();
        if ($(".directorist-ajax-search-result").is(":empty")) {
          $(".directorist-ajax-search-result").hide();
        }

        // three column
      } else if (
        $(".directorist-map-columns-three #js-dlm-search").hasClass("active")
      ) {
        $(".directorist-map-listing, .directorist-ajax-search-result").hide();
        $(".directorist-map-search").show();
      } else if (
        $(".directorist-map-columns-three #js-dlm-listings").hasClass("active")
      ) {
        $(
          ".directorist-map-search, .directorist-map, .directorist-ajax-search-result .directorist-map",
        ).hide();
        $(
          ".directorist-map-listing, .directorist-listing , .directorist-ajax-search-result, .directorist-ajax-search-result .directorist-listing ",
        ).show();
        if ($(".directorist-ajax-search-result").is(":empty")) {
          $(
            ".directorist-ajax-search-result, .directorist-ajax-search-result .directorist-listing ",
          ).hide();
        }
      } else if (
        $(".directorist-map-columns-three #js-dlm-map").hasClass("active")
      ) {
        $(".directorist-map-search, .directorist-listing ").hide();
        $(
          ".directorist-map-listing, .directorist-map, .directorist-ajax-search-result, .directorist-ajax-search-result .directorist-map",
        ).show();
        $(".directorist-map").removeClass("directorist-map-hide");
        if ($(".directorist-ajax-search-result").is(":empty")) {
          $(
            ".directorist-ajax-search-result, .directorist-ajax-search-result .directorist-map",
          ).hide();
        }
      }
      if ($(".atbdp-range-slider").length > 0) {
        directorist_callingSlider();
      }
    });
    if ($(window).width() <= 1199) {
      if (
        $(".directorist-map-columns-two #js-dlm-listings").hasClass("active")
      ) {
        $(".directorist-map-search-content").hide();
        $(".directorist-map-listing").addClass("directorist-map-hide");
      }
      if (
        $(".directorist-map-columns-three #js-dlm-listings").hasClass("active")
      ) {
        $(".directorist-map-search").hide();
        $(".directorist-map").addClass("directorist-map-hide");
      }
    }

    /* advanced search form reset */
    function adsFormReset(searchForm) {
      searchForm.querySelectorAll("input[type='text']").forEach(function (el) {
        el.value = "";

        if (
          el.parentElement.classList.contains("input-has-value") ||
          el.parentElement.classList.contains("input-is-focused")
        ) {
          el.parentElement.classList.remove(
            "input-has-value",
            "input-is-focused",
          );
        }
      });
      searchForm.querySelectorAll("input[type='date']").forEach(function (el) {
        el.value = "";
      });
      searchForm.querySelectorAll("input[type='time']").forEach(function (el) {
        el.value = "";
      });
      searchForm.querySelectorAll("input[type='url']").forEach(function (el) {
        el.value = "";

        if (
          el.parentElement.classList.contains("input-has-value") ||
          el.parentElement.classList.contains("input-is-focused")
        ) {
          el.parentElement.classList.remove(
            "input-has-value",
            "input-is-focused",
          );
        }
      });
      searchForm
        .querySelectorAll("input[type='number']")
        .forEach(function (el) {
          el.value = "";

          if (
            el.parentElement.classList.contains("input-has-value") ||
            el.parentElement.classList.contains("input-is-focused")
          ) {
            el.parentElement.classList.remove(
              "input-has-value",
              "input-is-focused",
            );
          }
        });
      searchForm.querySelectorAll("input[type='radio']").forEach(function (el) {
        el.checked = false;
      });
      searchForm
        .querySelectorAll("input[type='checkbox']")
        .forEach(function (el) {
          el.checked = false;
        });
      searchForm.querySelectorAll("select").forEach(function (el) {
        el.selectedIndex = 0;
        $(".directorist-select2-dropdown-close").click();
        $(el).val("").trigger("change");

        let parentElem = el.closest(".directorist-search-field");

        if (
          parentElem.classList.contains("input-has-value") ||
          parentElem.classList.contains("input-is-focused")
        ) {
          setTimeout(function () {
            parentElem.classList.remove("input-has-value", "input-is-focused");
          }, 100);
        }
      });

      const irisPicker = searchForm.querySelector("input.wp-picker-clear");
      if (irisPicker !== null) {
        irisPicker.click();
      }

      searchForm
        .querySelectorAll("input[type='hidden']:not(.listing_type)")
        .forEach(function (el) {
          if (el.getAttribute("name") === "directory_type") return;
          if (el.getAttribute("name") === "miles") {
            const radiusDefaultValue = searchForm.querySelector(
              ".directorist-range-slider",
            ).dataset.defaultRadius;
            el.value = radiusDefaultValue;
            return;
          }
          el.value = "";
        });

      const rangeValue = searchForm.querySelector(
        ".directorist-range-slider-current-value span",
      );
      if (rangeValue !== null) {
        rangeValue.innerHTML = "0";
      }
    }
    $("body").on("click", ".directorist-btn-reset-js", function (e) {
      e.preventDefault();
      if (this.closest("#directorist-search-area")) {
        const searchForm = this.closest(
          "#directorist-search-area",
        ).querySelector("#directorist-search-area-form");
        if (searchForm) {
          adsFormReset(searchForm);
        }

        let searchFormWrapper = this.closest(".directorist-map-wrapper");
        let searchFormFilter =
          searchFormWrapper &&
          searchFormWrapper.querySelector("#directorist-search-area-form");
        if (searchFormFilter) {
          adsFormReset(searchFormFilter);
        }
      }
    });
  });

  $(document).bind("click", function (e) {
    let clickedDom = $(e.target);
    if (!clickedDom.parents().hasClass("directorist-dropdown-js"))
      $(".directorist-dropdown__links-js").hide();
  });

  $(".directorist-type-nav--listings-map .directorist-type-nav__link").on(
    "click",
    function () {
      $(this)
        .parent(".bdmv-directorist-type")
        .siblings()
        .removeClass("current");
      $(this).parent(".bdmv-directorist-type").addClass("current");
      $(".directorist-map").css({ height: "100%" });
    },
  );

  if (
    $(".directorist-content-active").find(".directorist-type-nav--listings-map")
      .length
  ) {
    $(".directorist-map-wrapper").addClass("directorist-multi-directory");
  } else {
    $(".directorist-map-wrapper").removeClass("directorist-multi-directory");
  }
})(jQuery);
