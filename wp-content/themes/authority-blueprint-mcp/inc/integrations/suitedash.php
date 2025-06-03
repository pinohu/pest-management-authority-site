<?php
// SuiteDash integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('SuiteDash Integration', 'abmcp'),
        __('SuiteDash', 'abmcp'),
        'manage_options',
        'abmcp_suitedash',
        'abmcp_suitedash_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_suitedash', 'abmcp_suitedash_api_key');
});

function abmcp_suitedash_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('SuiteDash Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_suitedash'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('SuiteDash API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_suitedash_api_key" value="<?php echo esc_attr(get_option('abmcp_suitedash_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_SuiteDash_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://app.suitedash.com/api/v1/', $api_key);
    }
    public function get_contacts() {
        return $this->request('contacts');
    }
    // Add more SuiteDash API methods as needed
}

// Example: Fetch SuiteDash contacts on admin_init
add_action('admin_init', function() {
    $api_key = get_option('abmcp_suitedash_api_key');
    if (!$api_key) return;
    $client = new ABMCP_SuiteDash_Client($api_key);
    $contacts = $client->get_contacts();
    if (is_array($contacts)) {
        ABMCP_Integration_Logger::log('Fetched ' . count($contacts) . ' contacts from SuiteDash.');
        // Optionally, display or sync contacts here
    }
}); 