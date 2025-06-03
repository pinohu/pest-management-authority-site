<?php
// Certopus integration: generate/send certificate
function ab_certopus_generate_certificate($recipient, $template_id, $fields = []) {
    $api_key = get_option('ab_certopus_api_key') ?: getenv('AB_CERTOPUS_API_KEY');
    if (!$api_key || !$recipient || !$template_id) return false;
    $response = wp_remote_post('https://api.certopus.com/v1/certificates', [
        'headers' => [
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type'  => 'application/json',
        ],
        'body' => wp_json_encode([
            'template_id' => $template_id,
            'recipient' => $recipient,
            'fields' => $fields,
        ]),
        'timeout' => 20,
    ]);
    if (is_wp_error($response)) return false;
    $body = json_decode(wp_remote_retrieve_body($response), true);
    return !empty($body['certificate_id']);
}
// TODO: Add admin tool for certificate management

// Shortcode: [certopus-certificate]
add_shortcode('certopus-certificate', function() {
    ob_start();
    echo '<section class="certopus-certificate" role="region" aria-label="Certopus Certificate Request">';
    echo '<h2>' . esc_html__('Certificate Request (Certopus)', 'authority-blueprint-mcp') . '</h2>';
    echo '<form class="certopus-certificate-form" method="post" action="#" autocomplete="off">';
    echo '<input type="text" name="certopus_name" placeholder="' . esc_attr__('Your Name', 'authority-blueprint-mcp') . '" required style="max-width:200px;"> ';
    echo '<input type="email" name="certopus_email" placeholder="' . esc_attr__('Your Email', 'authority-blueprint-mcp') . '" required style="max-width:200px; margin-left:1rem;"> ';
    echo '<button type="submit" class="btn btn-primary" style="margin-left:1rem;">' . esc_html__('Request Certificate', 'authority-blueprint-mcp') . '</button>';
    echo '</form>';
    echo '<div class="certopus-certificate-result" style="margin-top:1rem;"></div>';
    echo '</section>';
    return ob_get_clean();
});

// REST endpoint for AJAX certificate request
add_action('rest_api_init', function() {
    register_rest_route('ab-mcp/v1', '/certopus-request', [
        'methods' => 'POST',
        'callback' => function($request) {
            $params = $request->get_json_params();
            $name = isset($params['name']) ? sanitize_text_field($params['name']) : '';
            $email = isset($params['email']) ? sanitize_email($params['email']) : '';
            if (!$name || !$email || !is_email($email)) {
                return new WP_REST_Response(['success' => false, 'error' => 'Name and valid email required.'], 400);
            }
            $success = ab_certopus_generate_certificate($email, '', ['name' => $name]);
            return new WP_REST_Response(['success' => $success], 200);
        },
        'permission_callback' => '__return_true',
    ]);
}); 