<?php
// Reoon Email Verifier integration
function ab_reoon_validate_email($email) {
    $api_key = get_option('ab_reoon_api_key') ?: getenv('AB_REOON_API_KEY');
    if (!$api_key || !$email) return false;
    $response = wp_remote_get('https://api.reoon.com/email-verifier/v1?email=' . urlencode($email) . '&key=' . $api_key, [
        'timeout' => 10,
    ]);
    if (is_wp_error($response)) return false;
    $body = json_decode(wp_remote_retrieve_body($response), true);
    return !empty($body['deliverable']);
}
// TODO: Add hooks for registration, directory, and contact form validation 

// Shortcode: [reoon-email-validator]
add_shortcode('reoon-email-validator', function() {
    ob_start();
    echo '<section class="reoon-email-validator" role="region" aria-label="Reoon Email Validator">';
    echo '<h2>' . esc_html__('Email Validator (Reoon)', 'authority-blueprint-mcp') . '</h2>';
    echo '<form class="reoon-email-form" method="post" action="#" autocomplete="off">';
    echo '<input type="email" name="reoon_email" placeholder="' . esc_attr__('Enter email to validate', 'authority-blueprint-mcp') . '" required style="max-width:300px;">';
    echo '<button type="submit" class="btn btn-primary" style="margin-left:1rem;">' . esc_html__('Validate', 'authority-blueprint-mcp') . '</button>';
    echo '</form>';
    echo '<div class="reoon-email-result" style="margin-top:1rem;"></div>';
    echo '</section>';
    return ob_get_clean();
}); 

// REST endpoint for AJAX email validation
add_action('rest_api_init', function() {
    register_rest_route('ab-mcp/v1', '/reoon-validate', [
        'methods' => 'POST',
        'callback' => function($request) {
            $params = $request->get_json_params();
            $email = isset($params['email']) ? sanitize_email($params['email']) : '';
            if (!$email || !is_email($email)) {
                return new WP_REST_Response(['valid' => false, 'error' => 'Invalid email.'], 400);
            }
            $valid = ab_reoon_validate_email($email);
            return new WP_REST_Response(['valid' => $valid], 200);
        },
        'permission_callback' => '__return_true',
    ]);
}); 