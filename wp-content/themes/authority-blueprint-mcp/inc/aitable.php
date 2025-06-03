<?php
// AiTable integration: fetch records, sync to CPT, and block/shortcode display
function ab_aitable_get_records($table_id) {
    $api_key = get_option('ab_aitable_api_key') ?: getenv('AB_AITABLE_API_KEY');
    if (!$api_key || !$table_id) return [];
    $response = wp_remote_get('https://api.aitable.ai/v1/' . $table_id . '/records', [
        'headers' => [
            'Authorization' => 'Bearer ' . $api_key,
            'Accept' => 'application/json',
        ],
        'timeout' => 20,
    ]);
    if (is_wp_error($response)) return [];
    $body = json_decode(wp_remote_retrieve_body($response), true);
    return $body['records'] ?? [];
}
// TODO: Add sync to CPT and Gutenberg block/shortcode display 

// Shortcode: [aitable-directory]
add_shortcode('aitable-directory', function($atts) {
    $atts = shortcode_atts([
        'table_id' => '',
    ], $atts);
    $table_id = $atts['table_id'];
    ob_start();
    echo '<section class="aitable-directory" role="region" aria-label="AiTable Directory">';
    echo '<h2>' . esc_html__('Directory (AiTable Sync)', 'authority-blueprint-mcp') . '</h2>';
    if (!$table_id) {
        echo '<div class="error-summary" role="alert">' . esc_html__('No table ID provided.', 'authority-blueprint-mcp') . '</div>';
    } else {
        $records = ab_aitable_get_records($table_id);
        if (empty($records)) {
            echo '<div class="error-summary" role="alert">' . esc_html__('No records found or API error.', 'authority-blueprint-mcp') . '</div>';
        } else {
            echo '<ul class="aitable-directory-list">';
            foreach ($records as $rec) {
                $name = isset($rec['fields']['name']) ? esc_html($rec['fields']['name']) : esc_html__('(No Name)', 'authority-blueprint-mcp');
                $desc = isset($rec['fields']['description']) ? esc_html($rec['fields']['description']) : '';
                echo '<li><strong>' . $name . '</strong><br>' . $desc . '</li>';
            }
            echo '</ul>';
        }
    }
    echo '</section>';
    return ob_get_clean();
}); 