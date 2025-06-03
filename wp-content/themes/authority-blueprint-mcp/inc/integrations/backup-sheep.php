<?php
// BackupSheep integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('BackupSheep Integration', 'abmcp'),
        __('BackupSheep', 'abmcp'),
        'manage_options',
        'abmcp_backup_sheep',
        'abmcp_backup_sheep_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_backup_sheep', 'abmcp_backup_sheep_api_key');
});

function abmcp_backup_sheep_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('BackupSheep Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_backup_sheep'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('BackupSheep API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_backup_sheep_api_key" value="<?php echo esc_attr(get_option('abmcp_backup_sheep_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_BackupSheep_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://api.backupsheep.com/v1/', $api_key);
    }
    public function trigger_backup($resource_id) {
        return $this->request('backups', ['resource_id' => $resource_id], 'POST');
    }
    // Add more BackupSheep API methods as needed
}

// Example: Add a manual backup trigger in admin bar
add_action('admin_bar_menu', function($wp_admin_bar) {
    $wp_admin_bar->add_node([
        'id' => 'abmcp_backup_sheep_trigger',
        'title' => __('Trigger BackupSheep Backup', 'abmcp'),
        'href' => '#',
        'meta' => [
            'onclick' => 'alert("Backup trigger not implemented in UI. Use API.")',
        ],
    ]);
}, 100);

// === Workflow Automation Example ===
abmcp_register_integration_asset_hook('abmcp_after_post_publish', function($post_id) {
    $api_key = get_option('abmcp_backup_sheep_api_key');
    if (!$api_key) return;
    $client = new ABMCP_BackupSheep_Client($api_key);
    $resource_id = get_option('abmcp_backup_sheep_resource_id'); // Set this in settings
    if ($resource_id) {
        $client->trigger_backup($resource_id);
    }
});
// === End Workflow Automation Example === 