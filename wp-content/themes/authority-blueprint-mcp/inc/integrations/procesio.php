<?php
// PROCESIO integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('PROCESIO Integration', 'abmcp'),
        __('PROCESIO', 'abmcp'),
        'manage_options',
        'abmcp_procesio',
        'abmcp_procesio_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_procesio', 'abmcp_procesio_api_key');
});

function abmcp_procesio_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('PROCESIO Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_procesio'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('PROCESIO API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_procesio_api_key" value="<?php echo esc_attr(get_option('abmcp_procesio_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_PROCESIO_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://api.procesio.com/v1/', $api_key);
    }
    public function trigger_workflow($workflow_id, $data = []) {
        return $this->request('workflows/' . $workflow_id . '/run', $data, 'POST');
    }
    // Add more PROCESIO API methods as needed
}

// Example: Add a manual workflow trigger in admin bar
add_action('admin_bar_menu', function($wp_admin_bar) {
    $wp_admin_bar->add_node([
        'id' => 'abmcp_procesio_trigger',
        'title' => __('Trigger PROCESIO Workflow', 'abmcp'),
        'href' => '#',
        'meta' => [
            'onclick' => 'alert("Workflow trigger not implemented in UI. Use API.")',
        ],
    ]);
}, 100);

// === Workflow Automation Example ===
abmcp_register_integration_asset_hook('abmcp_after_post_publish', function($post_id) {
    $api_key = get_option('abmcp_procesio_api_key');
    if (!$api_key) return;
    $client = new ABMCP_PROCESIO_Client($api_key);
    $workflow_id = get_option('abmcp_procesio_default_workflow_id'); // Set this in settings
    if ($workflow_id) {
        $data = ['post_id' => $post_id, 'title' => get_the_title($post_id)];
        $client->trigger_workflow($workflow_id, $data);
    }
});
// === End Workflow Automation Example === 