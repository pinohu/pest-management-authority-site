<?php
// RTILA integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('RTILA Integration', 'abmcp'),
        __('RTILA', 'abmcp'),
        'manage_options',
        'abmcp_rtila',
        'abmcp_rtila_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_rtila', 'abmcp_rtila_api_key');
});

function abmcp_rtila_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('RTILA Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_rtila'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('RTILA API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_rtila_api_key" value="<?php echo esc_attr(get_option('abmcp_rtila_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_RTILA_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://api.rtila.com/v1/', $api_key);
    }
    public function run_bot($bot_id, $data = []) {
        return $this->request('bots/' . $bot_id . '/run', $data, 'POST');
    }
    // Add more RTILA API methods as needed
}

// Example: Add a manual bot run trigger in admin bar
add_action('admin_bar_menu', function($wp_admin_bar) {
    $wp_admin_bar->add_node([
        'id' => 'abmcp_rtila_trigger',
        'title' => __('Run RTILA Bot', 'abmcp'),
        'href' => '#',
        'meta' => [
            'onclick' => 'alert("Bot run trigger not implemented in UI. Use API.")',
        ],
    ]);
}, 100); 