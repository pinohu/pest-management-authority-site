jQuery(document).ready(function ($) {
    function to_top(top) {
        $([document.documentElement, document.body]).animate({
            scrollTop: $(top).offset().top
        }, 1000);
    }

    $('.at-modal').on('click', function( e ) {
        if ( e.currentTarget === e.target) {
            reset_form();
        }
    });

    $('.at-modal-close').on('click', function(){
        reset_form();
    });

    const qs = (function (a) {
        if (a == '') return {};
        const b = {};
        for (let i = 0; i < a.length; ++i) {
            const p = a[i].split('=', 2);
            if (p.length == 1) b[p[0]] = '';
            else b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, ' '));
        }
        return b;
    })(window.location.search.substr(1).split('&'));

    function reset_form() {
        var inputs = $('.at-modal input');

        for ( var i = 0; i < inputs.length; i++ ) {
            var inp = inputs[i];
            var input_type = inp.type;

            if ( 'radio' === input_type ) {
                inp.checked = false;
            }
        }

        $('#directorist-allowances').html('');
    }




    $('.listing_submit_btn').on('click', function () {
        $('.atpp_required').css({ display: "none" });
        var error_messege = '<span class="atpp_required atbdp_make_str_red"><i class="fa fa-exclamation-triangle"></i> '+plan_validator.crossLimit+'</span>';

        //Price
        var pynPrice = $("input[name='price']");
        var price_limit = plan_validator.price_limit;
        price_limit = parseFloat(price_limit);
        if (pynPrice.length>0){
            var price = pynPrice.val();
            price = parseFloat(price);
            if (price > price_limit) {
                pynPrice.after(error_messege);
                to_top(pynPrice);
                return false;
            }
        }

        //tag
        var tag = $("#at_biz_dir-tags").val();
        var tag_number = $(tag).length;
        var tag_limit = plan_validator.tag_limit;
        if (tag_number > tag_limit) {
            $('.atbd_tagvalidate_note').css({ display: "none" });
            $("#atbdp_tags").after(error_messege);
            to_top('#atbdp_tags');
            return false;
        }

    });


    if( ! plan_validator.is_admin ){
        //show plan allowance
        $('#directorist-allowances').hide();
        $('body').on('change' , 'input[name="new_plan"]' , function(e){
            e.preventDefault();
            e.stopPropagation();
            $('.dcl_pricing_plan_name').addClass('dcl-loading');
            $('.atbd_modal_btn').addClass("directorist-pricing-disabled");
            $('.atbd_modal_btn').attr("disabled", "true");
            var data = {
                'action': 'plan_allowances',
                'plan_id': $(this).val(),
                'post_id': $('#change_listing_id').val(),
            };
            $.post(plan_validator.ajaxurl, data, function (response) {
                $('.dcl_pricing_plan_name').removeClass('dcl-loading');
                if (response.html){
                    $('#directorist-allowances').show();
                    $('#directorist-allowances').html(response.html);
                }else{
                    $('#directorist-allowances').html(' ');
                }

                $('.atbd_modal_btn').removeClass("directorist-pricing-disabled");
                $('.atbd_modal_btn').removeAttr("disabled");

            });
        });
    }


    //staff to change the plan
    $('body').on('click', '.atpp_change_plan', function () {
        document.getElementById("atpp-change-plan-form").reset();

        var listingID = $(this).attr('data-listing_id');
        $('#change_listing_id').val( listingID );

        var data = {
            'action': 'atpp_changing_plan',
            'listingID': listingID,
        };

        $.post(plan_validator.ajaxurl, data, function (response) {
            if( response.template ){
                $(".dcl_pricing_plan").empty().append( response.template );
            }
        }, 'json');

    });

    $('body').on('submit', '#atpp-change-plan-form', function (e) {
        e.preventDefault();
        var active_elm = $( '.dpp-order-select-dropdown ul' ).find( '.active' );

        var data = {
            'action': 'atpp_submit_changing_plan',
            'post_id': $('#change_listing_id').val(),
            'plan_id' : $("input[name='new_plan']:checked").val(),
            'order_id' : active_elm.length ? active_elm.attr('data-value') : $("input[name='new_plan']:checked").attr('data-order_id'),
            'listing_type' : $("input[name='listing_type']:checked").val(),
        };

        $.post(plan_validator.ajaxurl, data, function (response) {
            $('.atbd_modal_btn').removeClass("dcl-loading");
            if(response.validation_error){
                $('#directorist-claim-warning-notification').addClass('text-warning').html(response.validation_error);
            }else{

                if (response.take_payment === 'plan') {
                    window.location.href = response.checkout_url;
                } else {
                    $('#directorist-claim-submit-notification').addClass('text-success').html(response.message);
                    location.reload();
                }
            }

        }, 'json');
    });

    $('.atbdp_renew_with_plan').on('click',function () {
        var listingID = $(this).attr('data-listing_id');
        $('#change_listing_id').val(listingID);
    });

    $('.at-modal-close').on('click',function () {
        $('#atpp-change-plan-form').children('input').val('');
        $('#directorist-claim-submit-notification').html('');
    });

    $('body').on('click','.dpp-order-select-dropdown ul li a', function(){
        $(this).parent('li').siblings().children().removeClass('active');
        $(this).addClass('active');
        var form_data   = new FormData();
        var order_id    = $( this ).attr('data-value');
        var general_label = $(this).closest('.dpp-order-select-dropdown').attr('data-general_label');
        var featured_label = $(this).closest('.dpp-order-select-dropdown').attr('data-featured_label');
        var label = $(this).closest('.dpp-order-select-dropdown').attr('data-label');
        var plan    = $("input[name='new_plan']:checked").val();
        var plan_id     = qs.plan ? qs.plan : plan;
        form_data.append('action', 'select_active_order');
        form_data.append('order_id', order_id);
        form_data.append('general_label', general_label);
        form_data.append('featured_label', featured_label);
        form_data.append('label', label);
        form_data.append('plan_id', plan_id);
        $('.atbd_modal_btn').addClass("directorist-pricing-disabled");
        $('.atbd_modal_btn').attr("disabled", "true");
        $.ajax({
            method: 'POST',
            processData: false,
            contentType: false,
            url: plan_validator.ajaxurl,
            data: form_data,
            success: function (response) {
                let content_area = $( '.dpp-order-select-wrapper' );
                $( '.directorist-listing-type' ).remove();
                $( content_area ).after( response );
                $('.dpp-selected-order-listing-type .atbdp_make_str_green, .dpp-selected-order-listing-type .atbdp_make_str_red').addClass('dpp-selected-order-listing-type--highlight');
                $('.atbd_modal_btn').removeClass("directorist-pricing-disabled");
                $('.atbd_modal_btn').removeAttr("disabled");
                setTimeout(() => {
                    $('.dpp-selected-order-listing-type .atbdp_make_str_green, .dpp-selected-order-listing-type .atbdp_make_str_red').removeClass('dpp-selected-order-listing-type--highlight');
                }, 2300);
            },
            error: function (error) {
                console.log(error);
            },
        });
    });


    $( 'body' ).on( 'click', '.directorist_required_login', function( e ){
        e.preventDefault();
        let _this = $(this);
        $('.dpp-email-warning').remove();
        _this.closest('.directorist-pricing__action').append('<span class="dpp-email-warning">' + plan_validator.login_alert + '</span>');
        return;
    });

    let guestInput = '<div style="margin-bottom: 10px;" class="directorist-form-group directorist_plan_guest_email"><input type="email" name="guest_customer_email" class="directorist-form-element guest_customer_email" placeholder="'+ plan_validator.email_placeholder +'" required /></div>';
    $( 'body' ).on( 'click', '.directorist_required_email', function( e ){
        e.preventDefault();
        let _this = $(this);
        $('.directorist_plan_guest_email').remove();
        $(this).closest('.directorist-pricing__action').before(guestInput);
        return;
    });

    $( 'body' ).on( 'keyup', '.guest_customer_email', function( e ){        
        $('.directorist-pricing__action--btn').removeClass('directorist_required_email');
    });

        //console.log(plan_validator.guest_customer);
        if( plan_validator.guest_customer ){
            $( 'body' ).on( 'click', '.directorist-pricing__action--btn', function( e ){


                if( ! $('.guest_customer_email').val() ) {
                    return;
                }
                
                e.preventDefault();
                let _this = $(this);
                let email       = $('.guest_customer_email').val();
                let url         = $(this).attr( 'href' );
                var form_data   = new FormData();

                form_data.append('action', 'guest_customer');
                form_data.append('email', email);

                $.ajax({
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    url: plan_validator.ajaxurl,
                    data: form_data,
                    success: function (response) {
                        if( response.error ){
                            _this.closest('.directorist-pricing__action').append('<span class="dpp-email-warning">' + response.error_msg + '</span>');
                        }else{
                            window.location.href = url;
                        }
                        $(_this).removeClass('directorist-pricing__action--btn-loading');
                    },
                    error: function (error) {
                        console.log(error);
                    },
                    complete: function () {
                        $('#directorist-type-preloader').hide();
                        $(_this).removeClass('directorist-pricing__action--btn-loading');
                    }
                });
            });
        }

});