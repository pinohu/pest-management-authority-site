<?php
// Pulsetic integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('Pulsetic Integration', 'abmcp'),
        __('Pulsetic', 'abmcp'),
        'manage_options',
        'abmcp_pulsetic',
        'abmcp_pulsetic_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_pulsetic', 'abmcp_pulsetic_api_key');
});

function abmcp_pulsetic_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Pulsetic Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_pulsetic'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Pulsetic API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_pulsetic_api_key" value="<?php echo esc_attr(get_option('abmcp_pulsetic_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_Pulsetic_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://api.pulsetic.com/v1/', $api_key);
    }
    public function get_status() {
        return $this->request('status');
    }
    // Add more Pulsetic API methods as needed
}

// Example: Fetch Pulsetic status on admin dashboard
add_action('wp_dashboard_setup', function() {
    wp_add_dashboard_widget('abmcp_pulsetic_status', __('Pulsetic Uptime Status', 'abmcp'), function() {
        $api_key = get_option('abmcp_pulsetic_api_key');
        if (!$api_key) { echo __('No API key set.', 'abmcp'); return; }
        $client = new ABMCP_Pulsetic_Client($api_key);
        $status = $client->get_status();
        if (is_array($status)) {
            echo '<pre>' . esc_html(print_r($status, true)) . '</pre>';
            ABMCP_Integration_Logger::log('Pulsetic status fetched.');
        } else {
            echo __('Failed to fetch Pulsetic status.', 'abmcp');
        }
    });
}); 