<?php
// NeuronWriter integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('NeuronWriter Integration', 'abmcp'),
        __('NeuronWriter', 'abmcp'),
        'manage_options',
        'abmcp_neuronwriter',
        'abmcp_neuronwriter_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_neuronwriter', 'abmcp_neuronwriter_api_key');
});

function abmcp_neuronwriter_settings_page() {
    abmcp_integrations_tabs('neuronwriter');
    ?>
    <div class="wrap">
        <h1><?php _e('NeuronWriter Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_neuronwriter'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('NeuronWriter API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_neuronwriter_api_key" value="<?php echo esc_attr(get_option('abmcp_neuronwriter_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_NeuronWriter_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://api.neuronwriter.com/v1/', $api_key);
    }
    public function get_suggestions($content) {
        return $this->request('suggestions', ['content' => $content], 'POST');
    }
    // Add more NeuronWriter API methods as needed
} 