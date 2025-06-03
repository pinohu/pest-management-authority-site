<?php
// Real AltText.ai integration for image alt text generation
add_filter('wp_generate_attachment_metadata', function($metadata, $attachment_id) {
    $api_key = get_option('ab_mcp_alttext_api_key');
    if (!$api_key) return $metadata;
    $mime = get_post_mime_type($attachment_id);
    if (strpos($mime, 'image/') !== 0) return $metadata;
    $image_url = wp_get_attachment_url($attachment_id);
    if (!$image_url) return $metadata;
    $response = wp_remote_post('https://api.alttext.ai/v1/generate', [
        'headers' => [
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type'  => 'application/json',
        ],
        'body' => wp_json_encode(['image_url' => $image_url]),
        'timeout' => 15,
    ]);
    if (is_wp_error($response)) {
        error_log('AltText.ai error: ' . $response->get_error_message());
        return $metadata;
    }
    $body = json_decode(wp_remote_retrieve_body($response), true);
    if (!empty($body['alt_text'])) {
        update_post_meta($attachment_id, '_wp_attachment_image_alt', sanitize_text_field($body['alt_text']));
    } else {
        error_log('AltText.ai: No alt text returned for image ' . $image_url);
    }
    return $metadata;
}, 20, 2); 