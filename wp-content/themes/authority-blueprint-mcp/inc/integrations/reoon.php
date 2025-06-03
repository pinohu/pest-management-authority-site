<?php
// Reoon integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('Reoon Integration', 'abmcp'),
        __('Reoon', 'abmcp'),
        'manage_options',
        'abmcp_reoon',
        'abmcp_reoon_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_reoon', 'abmcp_reoon_api_key');
});

function abmcp_reoon_settings_page() {
    abmcp_integrations_tabs('reoon');
    ?>
    <div class="wrap">
        <h1><?php _e('Reoon Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_reoon'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Reoon API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_reoon_api_key" value="<?php echo esc_attr(get_option('abmcp_reoon_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_Reoon_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://api.reoon.com/v1/', $api_key);
    }
    public function verify_email($email) {
        return $this->request('email/verify', ['email' => $email], 'POST');
    }
    // Add more Reoon API methods as needed
}

// === Workflow Automation Example ===
abmcp_register_integration_asset_hook('abmcp_after_post_publish', function($post_id) {
    $api_key = get_option('ab_reoon_api_key');
    if (!$api_key) return;
    // Example: Validate emails in post meta or content
    // $client = new ABMCP_Reoon_Client($api_key);
    // $client->validate_emails_in_post($post_id);
});
// === End Workflow Automation Example === 