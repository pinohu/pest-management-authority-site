<?php
// MCP API Keys Settings Page
add_action('admin_menu', function() {
    add_options_page(
        __('MCP API Keys', 'authority-blueprint-mcp'),
        __('MCP API Keys', 'authority-blueprint-mcp'),
        'manage_options',
        'ab-mcp-api-keys',
        'ab_mcp_api_keys_page'
    );
});

function ab_mcp_api_keys_page() {
    if (!current_user_can('manage_options')) return;
    if (isset($_POST['ab_mcp_api_keys_nonce']) && wp_verify_nonce($_POST['ab_mcp_api_keys_nonce'], 'ab_mcp_api_keys_save')) {
        update_option('ab_mcp_alttext_api_key', sanitize_text_field($_POST['ab_mcp_alttext_api_key']));
        update_option('ab_mcp_neuronwriter_api_key', sanitize_text_field($_POST['ab_mcp_neuronwriter_api_key']));
        update_option('ab_mcp_insighto_api_key', sanitize_text_field($_POST['ab_mcp_insighto_api_key']));
        update_option('ab_mcp_pulsetic_api_key', sanitize_text_field($_POST['ab_mcp_pulsetic_api_key']));
        update_option('ab_mcp_a11y_api_key', sanitize_text_field($_POST['ab_mcp_a11y_api_key']));
        echo '<div class="updated"><p>' . esc_html__('API keys updated.', 'authority-blueprint-mcp') . '</p></div>';
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('MCP API Keys', 'authority-blueprint-mcp'); ?></h1>
        <form method="post">
            <?php wp_nonce_field('ab_mcp_api_keys_save', 'ab_mcp_api_keys_nonce'); ?>
            <table class="form-table">
                <tr><th><label for="ab_mcp_alttext_api_key">AltText.ai API Key</label></th>
                    <td><input type="text" id="ab_mcp_alttext_api_key" name="ab_mcp_alttext_api_key" value="<?php echo esc_attr(get_option('ab_mcp_alttext_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_mcp_neuronwriter_api_key">NEURONWriter API Key</label></th>
                    <td><input type="text" id="ab_mcp_neuronwriter_api_key" name="ab_mcp_neuronwriter_api_key" value="<?php echo esc_attr(get_option('ab_mcp_neuronwriter_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_mcp_insighto_api_key">Insighto.ai API Key</label></th>
                    <td><input type="text" id="ab_mcp_insighto_api_key" name="ab_mcp_insighto_api_key" value="<?php echo esc_attr(get_option('ab_mcp_insighto_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_mcp_pulsetic_api_key">Pulsetic API Key</label></th>
                    <td><input type="text" id="ab_mcp_pulsetic_api_key" name="ab_mcp_pulsetic_api_key" value="<?php echo esc_attr(get_option('ab_mcp_pulsetic_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_mcp_a11y_api_key">a11y MCP API Key</label></th>
                    <td><input type="text" id="ab_mcp_a11y_api_key" name="ab_mcp_a11y_api_key" value="<?php echo esc_attr(get_option('ab_mcp_a11y_api_key')); ?>" class="regular-text" /></td></tr>
            </table>
            <?php submit_button(__('Save API Keys', 'authority-blueprint-mcp')); ?>
        </form>
    </div>
    <?php
} 