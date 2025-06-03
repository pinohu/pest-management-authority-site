<?php
// Acumbamail integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('Acumbamail Integration', 'abmcp'),
        __('Acumbamail', 'abmcp'),
        'manage_options',
        'abmcp_acumbamail',
        'abmcp_acumbamail_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_acumbamail', 'abmcp_acumbamail_api_key');
});

function abmcp_acumbamail_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Acumbamail Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_acumbamail'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Acumbamail API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_acumbamail_api_key" value="<?php echo esc_attr(get_option('abmcp_acumbamail_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_Acumbamail_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://acumbamail.com/api/1/', $api_key);
    }
    public function get_campaigns() {
        return $this->request('campaign/list');
    }
    // Add more Acumbamail API methods as needed
}

// Example: Fetch Acumbamail campaigns on admin_init
add_action('admin_init', function() {
    $api_key = get_option('abmcp_acumbamail_api_key');
    if (!$api_key) return;
    $client = new ABMCP_Acumbamail_Client($api_key);
    $campaigns = $client->get_campaigns();
    if (is_array($campaigns)) {
        ABMCP_Integration_Logger::log('Fetched ' . count($campaigns) . ' campaigns from Acumbamail.');
        // Optionally, display or sync campaigns here
    }
});

// === Workflow Automation Example ===
abmcp_register_integration_asset_hook('abmcp_after_post_publish', function($post_id) {
    $api_key = get_option('ab_acumbamail_api_key');
    if (!$api_key) return;
    // Example: Trigger Acumbamail newsletter automation
    // $client = new ABMCP_Acumbamail_Client($api_key);
    // $client->send_newsletter($post_id);
});
// === End Workflow Automation Example === 