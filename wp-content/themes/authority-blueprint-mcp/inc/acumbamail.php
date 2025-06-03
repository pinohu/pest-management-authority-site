<?php
// Acumbamail integration: subscribe email
function ab_acumbamail_subscribe($email) {
    $api_key = get_option('ab_acumbamail_api_key') ?: getenv('AB_ACUMBAMAIL_API_KEY');
    if (!$api_key || !$email) return false;
    $response = wp_remote_post('https://acumbamail.com/api/1/list/subscribe/', [
        'body' => [
            'api_key' => $api_key,
            'email' => $email,
        ],
        'timeout' => 10,
    ]);
    if (is_wp_error($response)) return false;
    $body = json_decode(wp_remote_retrieve_body($response), true);
    return !empty($body['success']);
}
// TODO: Add block/shortcode for newsletter signup 

// Shortcode: [acumbamail-newsletter]
add_shortcode('acumbamail-newsletter', function() {
    ob_start();
    echo '<section class="acumbamail-newsletter" role="region" aria-label="Acumbamail Newsletter Signup">';
    echo '<h2>' . esc_html__('Newsletter Signup (Acumbamail)', 'authority-blueprint-mcp') . '</h2>';
    echo '<form class="acumbamail-newsletter-form" method="post" action="#" autocomplete="off">';
    echo '<input type="email" name="acumbamail_email" placeholder="' . esc_attr__('Enter your email', 'authority-blueprint-mcp') . '" required style="max-width:300px;">';
    echo '<button type="submit" class="btn btn-primary" style="margin-left:1rem;">' . esc_html__('Subscribe', 'authority-blueprint-mcp') . '</button>';
    echo '</form>';
    echo '<div class="acumbamail-newsletter-result" style="margin-top:1rem;"></div>';
    echo '</section>';
    return ob_get_clean();
}); 

// REST endpoint for AJAX newsletter subscription
add_action('rest_api_init', function() {
    register_rest_route('ab-mcp/v1', '/acumbamail-subscribe', [
        'methods' => 'POST',
        'callback' => function($request) {
            $params = $request->get_json_params();
            $email = isset($params['email']) ? sanitize_email($params['email']) : '';
            if (!$email || !is_email($email)) {
                return new WP_REST_Response(['success' => false, 'error' => 'Invalid email.'], 400);
            }
            $success = ab_acumbamail_subscribe($email);
            return new WP_REST_Response(['success' => $success], 200);
        },
        'permission_callback' => '__return_true',
    ]);
}); 