<?php
/*
Plugin Name: Authority Utilities
Description: Custom utilities for Authority Blueprint theme (shortcodes, blocks, admin enhancements).
Version: 1.0
Author: Your Name
*/

// Example: Register a simple shortcode
function authority_hello_shortcode() {
    return '<div class="authority-hello">Hello from Authority Utilities!</div>';
}
add_shortcode('authority_hello', 'authority_hello_shortcode');

// --- Unified Admin Settings Page ---
add_action('admin_menu', function() {
    add_options_page(
        'Authority Utilities Settings',
        'Authority Utilities',
        'manage_options',
        'authority-utilities-settings',
        'authority_utilities_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('authority_utilities', 'authority_utilities_settings');
    add_settings_section('authority_utilities_main', 'API Keys & Utilities', null, 'authority-utilities-settings');
    add_settings_field('alttext_api_key', 'AltText.ai API Key', 'authority_utilities_field_alttext', 'authority-utilities-settings', 'authority_utilities_main');
    add_settings_field('insighto_api_key', 'Insighto.ai API Key', 'authority_utilities_field_insighto', 'authority-utilities-settings', 'authority_utilities_main');
    add_settings_field('enabled_plugins', 'Enable/Disable Utilities', 'authority_utilities_field_plugins', 'authority-utilities-settings', 'authority_utilities_main');
});

function authority_utilities_field_alttext() {
    $options = get_option('authority_utilities_settings');
    echo '<input type="text" name="authority_utilities_settings[alttext_api_key]" value="' . esc_attr($options['alttext_api_key'] ?? '') . '" class="regular-text">';
}
function authority_utilities_field_insighto() {
    $options = get_option('authority_utilities_settings');
    echo '<input type="text" name="authority_utilities_settings[insighto_api_key]" value="' . esc_attr($options['insighto_api_key'] ?? '') . '" class="regular-text">';
}
function authority_utilities_field_plugins() {
    $options = get_option('authority_utilities_settings');
    $plugins = [
        'auto_alt_text' => 'Auto Alt Text',
        'ai_comment_moderation' => 'AI Comment Moderation',
        'schema_automation' => 'Schema Automation',
        'internal_linking' => 'Internal Linking',
        'image_optimization' => 'Image Optimization',
        'social_sharing_cards' => 'Social Sharing Cards',
        'content_freshness' => 'Content Freshness',
        'backup_scheduler' => 'Backup Scheduler',
    ];
    foreach ($plugins as $key => $label) {
        $checked = !isset($options['enabled_plugins'][$key]) || $options['enabled_plugins'][$key] ? 'checked' : '';
        echo '<label><input type="checkbox" name="authority_utilities_settings[enabled_plugins][' . esc_attr($key) . ']" value="1" ' . $checked . '> ' . esc_html($label) . '</label><br>';
    }
}

function authority_utilities_settings_page() {
    echo '<div class="wrap"><h1>Authority Utilities Settings</h1>';
    echo '<form method="post" action="options.php">';
    settings_fields('authority_utilities');
    do_settings_sections('authority-utilities-settings');
    submit_button();
    echo '</form></div>';
}

// --- Admin Notices for Missing API Keys ---
add_action('admin_notices', function() {
    $screen = get_current_screen();
    if ($screen && $screen->id !== 'settings_page_authority-utilities-settings') return;
    $options = get_option('authority_utilities_settings');
    if (empty($options['alttext_api_key'])) {
        echo '<div class="notice notice-warning"><p><strong>Authority Utilities:</strong> AltText.ai API key is missing. Auto Alt Text will not function until set.</p></div>';
    }
    if (empty($options['insighto_api_key'])) {
        echo '<div class="notice notice-warning"><p><strong>Authority Utilities:</strong> Insighto.ai API key is missing. AI Comment Moderation will not function until set.</p></div>';
    }
}); 