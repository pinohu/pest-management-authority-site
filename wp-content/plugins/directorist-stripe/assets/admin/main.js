(function ($) {
    $(document).ready(function () {
        // activate license and set up updated
        $('#stripe_activated input[name="stripe_activated"]').on('change', function (event) {
            event.preventDefault();
            var form_data = new FormData();
            var stripe_license = $('#stripe_license input[name="stripe_license"]').val();
            form_data.append('action', 'atbdp_stripe_license_activation');
            form_data.append('stripe_license', stripe_license);
            $.ajax({
                method: 'POST',
                processData: false,
                contentType: false,
                url: stripe_js_obj.ajaxurl,
                data: form_data,
                success: function (response) {
                    if (response.status === true) {
                        $('#success_msg').remove();
                        $('#stripe_activated').after('<p id="success_msg">' + response.msg + '</p>');
                        location.reload();
                    } else {
                        $('#error_msg').remove();
                        $('#stripe_activated').after('<p id="error_msg">' + response.msg + '</p>');
                    }
                },
                error: function (error) {
                    // console.log(error);
                }
            });
        });
        // deactivate license
        $('#stripe_deactivated input[name="stripe_deactivated"]').on('change', function (event) {
            event.preventDefault();
            var form_data = new FormData();
            var stripe_license = $('#stripe_license input[name="stripe_license"]').val();
            form_data.append('action', 'atbdp_stripe_license_deactivation');
            form_data.append('stripe_license', stripe_license);
            $.ajax({
                method: 'POST',
                processData: false,
                contentType: false,
                url: stripe_js_obj.ajaxurl,
                data: form_data,
                success: function (response) {
                    if (response.status === true) {
                        $('#success_msg').remove();
                        $('#stripe_deactivated').after('<p id="success_msg">' + response.msg + '</p>');
                        location.reload();
                    } else {
                        $('#error_msg').remove();
                        $('#stripe_deactivated').after('<p id="error_msg">' + response.msg + '</p>');
                    }
                },
                error: function (error) {
                    // console.log(error);
                }
            });
        });
    })

})(jQuery);

