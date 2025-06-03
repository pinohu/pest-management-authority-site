<?php
// AltText.ai integration for Authority Blueprint MCP theme
if (!defined('ABSPATH')) exit;
require_once __DIR__ . '/common.php';

add_action('admin_menu', function() {
    add_submenu_page(
        'abmcp_integrations',
        __('AltText.ai Integration', 'abmcp'),
        __('AltText.ai', 'abmcp'),
        'manage_options',
        'abmcp_alttext_ai',
        'abmcp_alttext_ai_settings_page'
    );
});

add_action('admin_init', function() {
    register_setting('abmcp_alttext_ai', 'abmcp_alttext_ai_api_key');
});

function abmcp_alttext_ai_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('AltText.ai Integration', 'abmcp'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('abmcp_alttext_ai'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('AltText.ai API Key', 'abmcp'); ?></th>
                    <td><input type="text" name="abmcp_alttext_ai_api_key" value="<?php echo esc_attr(get_option('abmcp_alttext_ai_api_key')); ?>" size="50" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

class ABMCP_AltTextAI_Client extends ABMCP_Integration_API_Client {
    public function __construct($api_key) {
        parent::__construct('https://api.alttext.ai/v1/', $api_key);
    }
    public function generate_alt_text($image_url) {
        return $this->request('generate', ['image_url' => $image_url], 'POST');
    }
    // Add more AltText.ai API methods as needed
}

// Example: Auto-generate alt text on image upload
add_filter('wp_generate_attachment_metadata', function($metadata, $attachment_id) {
    $api_key = get_option('abmcp_alttext_ai_api_key');
    if (!$api_key) return $metadata;
    $image_url = wp_get_attachment_url($attachment_id);
    if (!$image_url) return $metadata;
    $client = new ABMCP_AltTextAI_Client($api_key);
    $result = $client->generate_alt_text($image_url);
    if (is_array($result) && !empty($result['alt_text'])) {
        update_post_meta($attachment_id, '_wp_attachment_image_alt', sanitize_text_field($result['alt_text']));
        ABMCP_Integration_Logger::log('Alt text generated for attachment ' . $attachment_id);
    }
    return $metadata;
}, 10, 2); 