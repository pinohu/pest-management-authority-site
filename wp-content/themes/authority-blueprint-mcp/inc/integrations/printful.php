<?php
// Printful integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('Printful Integration', 'abmcp'),
        __('Printful', 'abmcp'),
        'manage_options',
        'abmcp_printful',
        'abmcp_printful_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_printful', 'abmcp_printful_api_key');
});

function abmcp_printful_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Printful Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_printful'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Printful API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_printful_api_key" value="<?php echo esc_attr(get_option('abmcp_printful_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_Printful_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://api.printful.com/', $api_key);
    }
    public function get_products() {
        return $this->request('products');
    }
    // Add more Printful API methods as needed
}

// Example: Sync WooCommerce products with Printful
add_action('init', function() {
    if (!class_exists('WooCommerce')) return;
    $api_key = get_option('abmcp_printful_api_key');
    if (!$api_key) return;
    $client = new ABMCP_Printful_Client($api_key);
    $products = $client->get_products();
    if (is_array($products)) {
        ABMCP_Integration_Logger::log('Fetched ' . count($products) . ' products from Printful.');
        // Optionally, sync with WooCommerce here
    }
}); 