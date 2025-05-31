(function ($) {
    // A reference to Stripe.js initialized with a fake API key.
    // Sign in to see examples pre-filled with your key.
    
    var stripe = Stripe( atbdp_paMentObj.publish_key );
    stripe
        .redirectToCheckout({
            sessionId: atbdp_paMentObj.session_id
        })
        .then(function( result ) {
            console.log( { result } );
        });

    return;
})(jQuery);