<?php
// Stackby integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('Stackby Integration', 'abmcp'),
        __('Stackby', 'abmcp'),
        'manage_options',
        'abmcp_stackby',
        'abmcp_stackby_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_stackby', 'abmcp_stackby_api_key');
});

function abmcp_stackby_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Stackby Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_stackby'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Stackby API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_stackby_api_key" value="<?php echo esc_attr(get_option('abmcp_stackby_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_Stackby_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://api.stackby.com/v1/', $api_key);
    }
    public function get_tables() {
        return $this->request('tables');
    }
    // Add more Stackby API methods as needed
}

// Example: Fetch Stackby tables on admin_init
add_action('admin_init', function() {
    $api_key = get_option('abmcp_stackby_api_key');
    if (!$api_key) return;
    $client = new ABMCP_Stackby_Client($api_key);
    $tables = $client->get_tables();
    if (is_array($tables)) {
        ABMCP_Integration_Logger::log('Fetched ' . count($tables) . ' tables from Stackby.');
        // Optionally, display or sync tables here
    }
});

// === Workflow Automation Example ===
abmcp_register_integration_asset_hook('abmcp_after_cpt_create', function($post_id, $post_type, $update) {
    $api_key = get_option('abmcp_stackby_api_key');
    if (!$api_key) return;
    $client = new ABMCP_Stackby_Client($api_key);
    $tables = $client->get_tables();
    if (is_array($tables)) {
        ABMCP_Integration_Logger::log('Synced Stackby tables after CPT create: ' . $post_type);
    }
});
// === End Workflow Automation Example === 