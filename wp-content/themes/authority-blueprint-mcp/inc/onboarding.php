<?php
// Modular onboarding and starter kit import for Authority Blueprint MCP
add_action('admin_menu', function() {
    add_theme_page(
        __('Get Started / Import Starter Kit', 'authority-blueprint-mcp'),
        __('Get Started / Import Starter Kit', 'authority-blueprint-mcp'),
        'manage_options',
        'ab-mcp-onboarding',
        'ab_mcp_onboarding_page'
    );
});

function ab_mcp_onboarding_page() {
    $packs = glob(get_template_directory() . '/inc/niche-packs/*.php');
    echo '<div class="wrap"><h1>' . esc_html__('Get Started: Import Industry Starter Kit', 'authority-blueprint-mcp') . '</h1>';
    echo '<p>' . esc_html__('Choose a starter kit to import demo content, directory types, and settings for your industry. All content is modular and can be reset at any time.', 'authority-blueprint-mcp') . '</p>';
    echo '<ul class="ab-mcp-niche-packs">';
    foreach ($packs as $pack) {
        $slug = basename($pack, '.php');
        $meta = ab_mcp_niche_pack_meta($pack);
        echo '<li style="margin-bottom:2em;"><strong>' . esc_html($meta['name']) . '</strong><br>';
        echo esc_html($meta['description']) . '<br>';
        echo '<button class="button ab-mcp-import-pack" data-pack="' . esc_attr($slug) . '">' . esc_html__('Import', 'authority-blueprint-mcp') . '</button>';
        echo '</li>';
    }
    echo '</ul>';
    echo '<div id="ab-mcp-import-result"></div>';
    echo '</div>';
    echo '<script>jQuery(document).ready(function($){$(".ab-mcp-import-pack").click(function(){var pack=$(this).data("pack");$("#ab-mcp-import-result").html("' + esc_js(__('Importing...', 'authority-blueprint-mcp')) + '");$.post(ajaxurl,{action:"ab_mcp_import_pack",pack:pack},function(r){$("#ab-mcp-import-result").html(r.data);});});});</script>';
}

function ab_mcp_niche_pack_meta($file) {
    $meta = [
        'name' => ucwords(str_replace('-', ' ', basename($file, '.php'))),
        'description' => __('No description provided.', 'authority-blueprint-mcp'),
    ];
    $lines = file($file);
    foreach ($lines as $line) {
        if (strpos($line, '@name') !== false) $meta['name'] = trim(str_replace('@name', '', $line));
        if (strpos($line, '@description') !== false) $meta['description'] = trim(str_replace('@description', '', $line));
    }
    return $meta;
}

add_action('wp_ajax_ab_mcp_import_pack', function() {
    if (!current_user_can('manage_options')) wp_send_json_error('Permission denied');
    $pack = isset($_POST['pack']) ? sanitize_text_field($_POST['pack']) : '';
    $file = get_template_directory() . '/inc/niche-packs/' . $pack . '.php';
    if (!file_exists($file)) wp_send_json_error('Pack not found');
    include_once $file;
    $func = 'ab_mcp_import_' . str_replace('-', '_', $pack) . '_pack';
    if (function_exists($func)) {
        $func();
    }
    do_action('ab_mcp_after_import_pack', $pack);
    wp_send_json_success(__('Starter kit imported. You can now customize your site.', 'authority-blueprint-mcp'));
});

// Hook for third-party packs: do_action('ab_mcp_after_import_pack', $pack_slug); 