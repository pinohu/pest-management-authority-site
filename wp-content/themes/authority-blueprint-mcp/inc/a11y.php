<?php
// a11y MCP (context7) integration for automated accessibility testing
add_action('save_post', function($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    $url = get_permalink($post_id);
    if (!$url) return;
    $api_key = get_option('ab_mcp_a11y_api_key');
    if (!$api_key) return;
    $response = wp_remote_post('https://a11y.mcp/api/audit', [
        'headers' => [
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type'  => 'application/json',
        ],
        'body' => wp_json_encode(['url' => $url]),
        'timeout' => 20,
    ]);
    if (is_wp_error($response)) return;
    $body = json_decode(wp_remote_retrieve_body($response), true);
    if (!empty($body['issues'])) {
        update_post_meta($post_id, '_a11y_issues', $body['issues']);
    } else {
        delete_post_meta($post_id, '_a11y_issues');
    }
}, 20, 1);

add_action('admin_notices', function() {
    global $post;
    if (!isset($post)) return;
    $issues = get_post_meta($post->ID, '_a11y_issues', true);
    if (!empty($issues)) {
        echo '<div class="notice notice-error"><p>';
        echo esc_html__('Accessibility issues detected on this page:', 'authority-blueprint-mcp');
        echo '<ul>';
        foreach ($issues as $issue) {
            echo '<li>' . esc_html($issue) . '</li>';
        }
        echo '</ul></p></div>';
    }
}); 