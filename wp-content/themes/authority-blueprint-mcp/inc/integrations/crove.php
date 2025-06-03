<?php
// Crove integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('Crove Integration', 'abmcp'),
        __('Crove', 'abmcp'),
        'manage_options',
        'abmcp_crove',
        'abmcp_crove_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_crove', 'abmcp_crove_api_key');
});

function abmcp_crove_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Crove Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_crove'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Crove API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_crove_api_key" value="<?php echo esc_attr(get_option('abmcp_crove_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_Crove_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://api.crove.app/v1/', $api_key);
    }
    public function generate_document($template_id, $data = []) {
        return $this->request('documents/generate', array_merge(['template_id' => $template_id], $data), 'POST');
    }
    // Add more Crove API methods as needed
}

// Example: Add a manual document generation trigger in admin bar
add_action('admin_bar_menu', function($wp_admin_bar) {
    $wp_admin_bar->add_node([
        'id' => 'abmcp_crove_trigger',
        'title' => __('Generate Crove Document', 'abmcp'),
        'href' => '#',
        'meta' => [
            'onclick' => 'alert("Document generation not implemented in UI. Use API.")',
        ],
    ]);
}, 100); 