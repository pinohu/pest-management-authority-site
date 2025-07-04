<?php
// OpenAI integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('OpenAI Integration', 'abmcp'),
        __('OpenAI', 'abmcp'),
        'manage_options',
        'abmcp_openai',
        'abmcp_openai_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_openai', 'abmcp_openai_api_key');
});

function abmcp_openai_settings_page() {
    abmcp_integrations_tabs('openai');
    ?>
    <div class="wrap">
        <h1><?php _e('OpenAI Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_openai'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('OpenAI API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_openai_api_key" value="<?php echo esc_attr(get_option('abmcp_openai_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_OpenAI_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://api.openai.com/v1/', $api_key);
    }
    public function generate_content($prompt) {
        return $this->request('completions', [
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            'max_tokens' => 256,
        ], 'POST');
    }
    // Add more OpenAI API methods as needed
} 