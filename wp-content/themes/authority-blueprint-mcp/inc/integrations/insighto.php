<?php
// Insighto integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('Insighto Integration', 'abmcp'),
        __('Insighto', 'abmcp'),
        'manage_options',
        'abmcp_insighto',
        'abmcp_insighto_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_insighto', 'abmcp_insighto_api_key');
});

function abmcp_insighto_settings_page() {
    abmcp_integrations_tabs('insighto');
    ?>
    <div class="wrap">
        <h1><?php _e('Insighto Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_insighto'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Insighto API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_insighto_api_key" value="<?php echo esc_attr(get_option('abmcp_insighto_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_Insighto_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://api.insighto.ai/v1/', $api_key);
    }
    public function moderate_comment($comment) {
        return $this->request('moderate', ['comment' => $comment], 'POST');
    }
    // Add more Insighto API methods as needed
} 