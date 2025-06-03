<?php
// Pulsetic (context7) integration for performance/uptime monitoring
add_action('wp_dashboard_setup', function() {
    wp_add_dashboard_widget('pulsetic_monitoring', __('Site Monitoring', 'authority-blueprint-mcp'), 'ab_mcp_pulsetic_widget');
});

function ab_mcp_pulsetic_widget() {
    $api_key = get_option('ab_mcp_pulsetic_api_key') ?: getenv('AB_MCP_PULSETIC_API_KEY');
    if (!$api_key) {
        echo esc_html__('Pulsetic API key not set.', 'authority-blueprint-mcp');
        return;
    }
    $response = wp_remote_get('https://api.context7.com/pulsetic/status', [
        'headers' => [
            'Authorization' => 'Bearer ' . $api_key,
            'Accept' => 'application/json',
        ],
        'timeout' => 15,
    ]);
    if (is_wp_error($response)) {
        echo esc_html__('API error: ', 'authority-blueprint-mcp') . esc_html($response->get_error_message());
        return;
    }
    $body = json_decode(wp_remote_retrieve_body($response), true);
    if (!empty($body['status'])) {
        echo '<strong>Status:</strong> ' . esc_html($body['status']) . '<br />';
        if (!empty($body['metrics'])) {
            echo '<ul>';
            foreach ($body['metrics'] as $k => $v) {
                echo '<li>' . esc_html($k) . ': ' . esc_html($v) . '</li>';
            }
            echo '</ul>';
        }
    } else {
        echo esc_html__('No status data returned.', 'authority-blueprint-mcp');
    }
} 