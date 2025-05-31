(function ($) {
    // Update the payment button on init
    
    var selected_gateway = $( "input[name='payment_gateway']:checked").val();
    update_payment_button( selected_gateway );

    // Update the payment button on payment method change
    $( "input[name='payment_gateway']" ).on( 'change', function() {
        update_payment_button( this.value );
    });

    // update_payment_button
    function update_payment_button( selected_gateway ) {
        // Display stripe cc form if default gateway = stripe
        if ( selected_gateway === 'stripe_gateway' ) {
            setup_stripe_payment_button();
        } else {
            reset_payment_button();
        }
    }

    // setup_stripe_payment_button
    function setup_stripe_payment_button() {
        var apiKey = atbdp_commonObj.publish_key;
        var submitBtn = $( '#atbdp_checkout_submit_btn' );
        submitBtn.val( atbdp_commonObj.processNow );
        if ( ! apiKey ) { submitBtn.attr( "disabled", true ); return; }
    }

    // reset_payment_button
    function reset_payment_button() {
        var submitBtn = $( '#atbdp_checkout_submit_btn' );
        var submitBtnLabel = $( '#atbdp_checkout_submit_btn_label' ).val();

        submitBtn.val( submitBtnLabel );
        submitBtn.attr( "disabled", false );
    }

})(jQuery);