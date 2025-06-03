<?php
// AITable integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('AITable Integration', 'abmcp'),
        __('AITable', 'abmcp'),
        'manage_options',
        'abmcp_aitable',
        'abmcp_aitable_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_aitable', 'abmcp_aitable_api_key');
});

function abmcp_aitable_settings_page() {
    abmcp_integrations_tabs('aitable');
    ?>
    <div class="wrap">
        <h1><?php _e('AITable Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_aitable'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('AITable API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_aitable_api_key" value="<?php echo esc_attr(get_option('abmcp_aitable_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_AITable_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://api.aitable.ai/v1/', $api_key);
    }
    public function get_tables() {
        return $this->request('tables');
    }
    // Add more AITable API methods as needed
}

// === Workflow Automation Example ===
abmcp_register_integration_asset_hook('abmcp_after_cpt_create', function($post_id, $post_type, $update) {
    $api_key = get_option('ab_aitable_api_key');
    if (!$api_key) return;
    // Example: Sync AiTable data here
    // $client = new ABMCP_AiTable_Client($api_key);
    // $client->sync_data($post_id, $post_type);
});
// === End Workflow Automation Example === 