<?php
// Certopus integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('Certopus Integration', 'abmcp'),
        __('Certopus', 'abmcp'),
        'manage_options',
        'abmcp_certopus',
        'abmcp_certopus_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_certopus', 'abmcp_certopus_api_key');
});

function abmcp_certopus_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Certopus Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_certopus'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Certopus API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_certopus_api_key" value="<?php echo esc_attr(get_option('abmcp_certopus_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_Certopus_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://api.certopus.com/v1/', $api_key);
    }
    public function generate_certificate($template_id, $data = []) {
        return $this->request('certificates/generate', array_merge(['template_id' => $template_id], $data), 'POST');
    }
    // Add more Certopus API methods as needed
}

// Example: Add a manual certificate generation trigger in admin bar
add_action('admin_bar_menu', function($wp_admin_bar) {
    $wp_admin_bar->add_node([
        'id' => 'abmcp_certopus_trigger',
        'title' => __('Generate Certopus Certificate', 'abmcp'),
        'href' => '#',
        'meta' => [
            'onclick' => 'alert("Certificate generation not implemented in UI. Use API.")',
        ],
    ]);
}, 100); 