<?php
// Common utilities for all integrations
if (!defined('ABSPATH')) exit;

class ABMCP_Integration_API_Client {
    protected $base_url;
    protected $api_key;
    public function __construct($base_url, $api_key) {
        $this->base_url = $base_url;
        $this->api_key = $api_key;
    }
    protected function request($endpoint, $args = [], $method = 'GET') {
        $url = trailingslashit($this->base_url) . ltrim($endpoint, '/');
        $headers = [ 'Authorization' => 'Bearer ' . $this->api_key ];
        $response = wp_remote_request($url, [
            'method' => $method,
            'headers' => $headers,
            'body' => $args,
            'timeout' => 20,
        ]);
        if (is_wp_error($response)) {
            ABMCP_Integration_Logger::log('API error: ' . $response->get_error_message());
            return false;
        }
        $body = wp_remote_retrieve_body($response);
        return json_decode($body, true);
    }
}

class ABMCP_Integration_Logger {
    public static function log($message) {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('[ABMCP Integration] ' . $message);
        }
    }
}

function abmcp_integration_handle_error($message) {
    ABMCP_Integration_Logger::log('Error: ' . $message);
    // Optionally, add admin notice or other error handling here
}

// Register unified Integrations parent menu if not already present
add_action('admin_menu', function() {
    global $menu;
    $slug = 'abmcp_integrations';
    foreach ($menu as $item) {
        if (!empty($item[2]) && $item[2] === $slug) return;
    }
    add_menu_page(
        __('Integrations', 'abmcp'),
        __('Integrations', 'abmcp'),
        'manage_options',
        $slug,
        'abmcp_integrations_overview_page',
        'dashicons-admin-generic',
        59
    );
});

function abmcp_integrations_overview_page() {
    echo '<div class="wrap"><h1>' . esc_html__('Integrations Overview', 'abmcp') . '</h1>';
    echo '<p>' . esc_html__('Manage all API integrations from the tabs below.', 'abmcp') . '</p></div>';
}

function abmcp_integrations_tabs($current = '') {
    $integrations = [
        'directorist' => __('Directorist', 'abmcp'),
        'openai' => __('OpenAI', 'abmcp'),
        'aitable' => __('AITable', 'abmcp'),
        'reoon' => __('Reoon', 'abmcp'),
        'insighto' => __('Insighto', 'abmcp'),
        'neuronwriter' => __('NeuronWriter', 'abmcp'),
        'acumbamail' => __('Acumbamail', 'abmcp'),
        'certopus' => __('Certopus', 'abmcp'),
        'printful' => __('Printful', 'abmcp'),
        'suitedash' => __('SuiteDash', 'abmcp'),
        'alttext_ai' => __('AltText.ai', 'abmcp'),
        'pulsetic' => __('Pulsetic', 'abmcp'),
        'backup_sheep' => __('BackupSheep', 'abmcp'),
        'crove' => __('Crove', 'abmcp'),
        'konnectzit' => __('KonnectzIT', 'abmcp'),
        'procesio' => __('PROCESIO', 'abmcp'),
        'stackby' => __('Stackby', 'abmcp'),
        'rtila' => __('RTILA', 'abmcp'),
    ];
    echo '<h2 class="nav-tab-wrapper">';
    foreach ($integrations as $slug => $label) {
        $url = admin_url('admin.php?page=abmcp_' . $slug);
        $class = ($current === $slug) ? ' nav-tab-active' : '';
        echo '<a href="' . esc_url($url) . '" class="nav-tab' . $class . '">' . esc_html($label) . '</a>';
    }
    echo '</h2>';
}

// === Integration Asset Utilization Helper ===
function abmcp_register_integration_asset_hook($hook, $callback, $priority = 10, $accepted_args = 1) {
    add_action($hook, $callback, $priority, $accepted_args);
}
// Usage: abmcp_register_integration_asset_hook('abmcp_after_post_publish', 'my_integration_callback');
// === End Integration Asset Utilization Helper === 