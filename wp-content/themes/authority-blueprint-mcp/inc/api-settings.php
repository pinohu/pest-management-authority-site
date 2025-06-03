<?php
// API Keys Settings Page for all integrations
add_action('admin_menu', function() {
    add_options_page(
        __('API Integrations', 'authority-blueprint-mcp'),
        __('API Integrations', 'authority-blueprint-mcp'),
        'manage_options',
        'ab-api-integrations',
        'ab_api_integrations_page'
    );
});

function ab_api_integrations_page() {
    if (!current_user_can('manage_options')) return;
    if (isset($_POST['ab_api_integrations_nonce']) && wp_verify_nonce($_POST['ab_api_integrations_nonce'], 'ab_api_integrations_save')) {
        $fields = [
            'ab_aitable_api_key', 'ab_reoon_api_key', 'ab_acumbamail_api_key', 'ab_openai_api_key',
            'ab_certopus_api_key', 'ab_printful_api_key', 'ab_logically_api_key', 'ab_exa_api_key',
            'ab_flowlu_api_key', 'ab_agiled_api_key', 'ab_suitedash_api_key', 'ab_brilliant_directory_api_key',
            'ab_gemini_api_key', 'ab_deepseek_api_key', 'ab_apixdrive_api_key', 'ab_activepieces_api_key',
            'ab_albato_api_key', 'ab_konnectzit_api_key', 'ab_procesio_api_key', 'ab_stackby_api_key',
            'ab_backupsheep_api_key'
        ];
        foreach ($fields as $field) {
            update_option($field, sanitize_text_field($_POST[$field] ?? ''));
        }
        echo '<div class="updated"><p>' . esc_html__('API keys updated.', 'authority-blueprint-mcp') . '</p></div>';
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('API Integrations', 'authority-blueprint-mcp'); ?></h1>
        <form method="post">
            <?php wp_nonce_field('ab_api_integrations_save', 'ab_api_integrations_nonce'); ?>
            <table class="form-table">
                <tr><th><label for="ab_aitable_api_key">AiTable API Key</label></th>
                    <td><input type="text" id="ab_aitable_api_key" name="ab_aitable_api_key" value="<?php echo esc_attr(get_option('ab_aitable_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_reoon_api_key">Reoon Email Verifier API Key</label></th>
                    <td><input type="text" id="ab_reoon_api_key" name="ab_reoon_api_key" value="<?php echo esc_attr(get_option('ab_reoon_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_acumbamail_api_key">Acumbamail API Key</label></th>
                    <td><input type="text" id="ab_acumbamail_api_key" name="ab_acumbamail_api_key" value="<?php echo esc_attr(get_option('ab_acumbamail_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_openai_api_key">OpenAI API Key</label></th>
                    <td><input type="text" id="ab_openai_api_key" name="ab_openai_api_key" value="<?php echo esc_attr(get_option('ab_openai_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_certopus_api_key">Certopus API Key</label></th>
                    <td><input type="text" id="ab_certopus_api_key" name="ab_certopus_api_key" value="<?php echo esc_attr(get_option('ab_certopus_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_printful_api_key">Printful API Key</label></th>
                    <td><input type="text" id="ab_printful_api_key" name="ab_printful_api_key" value="<?php echo esc_attr(get_option('ab_printful_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_logically_api_key">Logically (Afforai) API Key</label></th>
                    <td><input type="text" id="ab_logically_api_key" name="ab_logically_api_key" value="<?php echo esc_attr(get_option('ab_logically_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_exa_api_key">exa.ai API Key</label></th>
                    <td><input type="text" id="ab_exa_api_key" name="ab_exa_api_key" value="<?php echo esc_attr(get_option('ab_exa_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_flowlu_api_key">Flowlu API Key</label></th>
                    <td><input type="text" id="ab_flowlu_api_key" name="ab_flowlu_api_key" value="<?php echo esc_attr(get_option('ab_flowlu_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_agiled_api_key">Agiled API Key</label></th>
                    <td><input type="text" id="ab_agiled_api_key" name="ab_agiled_api_key" value="<?php echo esc_attr(get_option('ab_agiled_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_suitedash_api_key">SuiteDash API Key</label></th>
                    <td><input type="text" id="ab_suitedash_api_key" name="ab_suitedash_api_key" value="<?php echo esc_attr(get_option('ab_suitedash_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_brilliant_directory_api_key">Brilliant Directory API Key</label></th>
                    <td><input type="text" id="ab_brilliant_directory_api_key" name="ab_brilliant_directory_api_key" value="<?php echo esc_attr(get_option('ab_brilliant_directory_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_gemini_api_key">Gemini API Key</label></th>
                    <td><input type="text" id="ab_gemini_api_key" name="ab_gemini_api_key" value="<?php echo esc_attr(get_option('ab_gemini_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_deepseek_api_key">DeepSeek API Key</label></th>
                    <td><input type="text" id="ab_deepseek_api_key" name="ab_deepseek_api_key" value="<?php echo esc_attr(get_option('ab_deepseek_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_apixdrive_api_key">ApiX-Drive API Key</label></th>
                    <td><input type="text" id="ab_apixdrive_api_key" name="ab_apixdrive_api_key" value="<?php echo esc_attr(get_option('ab_apixdrive_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_activepieces_api_key">Activepieces API Key</label></th>
                    <td><input type="text" id="ab_activepieces_api_key" name="ab_activepieces_api_key" value="<?php echo esc_attr(get_option('ab_activepieces_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_albato_api_key">Albato API Key</label></th>
                    <td><input type="text" id="ab_albato_api_key" name="ab_albato_api_key" value="<?php echo esc_attr(get_option('ab_albato_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_konnectzit_api_key">KonnectzIT API Key</label></th>
                    <td><input type="text" id="ab_konnectzit_api_key" name="ab_konnectzit_api_key" value="<?php echo esc_attr(get_option('ab_konnectzit_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_procesio_api_key">PROCESIO API Key</label></th>
                    <td><input type="text" id="ab_procesio_api_key" name="ab_procesio_api_key" value="<?php echo esc_attr(get_option('ab_procesio_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_stackby_api_key">Stackby API Key</label></th>
                    <td><input type="text" id="ab_stackby_api_key" name="ab_stackby_api_key" value="<?php echo esc_attr(get_option('ab_stackby_api_key')); ?>" class="regular-text" /></td></tr>
                <tr><th><label for="ab_backupsheep_api_key">BackupSheep API Key</label></th>
                    <td><input type="text" id="ab_backupsheep_api_key" name="ab_backupsheep_api_key" value="<?php echo esc_attr(get_option('ab_backupsheep_api_key')); ?>" class="regular-text" /></td></tr>
            </table>
            <?php submit_button(__('Save API Keys', 'authority-blueprint-mcp')); ?>
        </form>
        <p><strong>OpenAI:</strong> ' . esc_html__('Used for AI content generation (see front page demo). Set your API key here for the /wp-json/ab-mcp/v1/openai-generate endpoint.', 'authority-blueprint-mcp') . '</p>';
        echo '<hr><h3>' . esc_html__('Default Feature Scaffolds', 'authority-blueprint-mcp') . '</h3>';
        echo '<ul>';
        echo '<li><strong>AiTable:</strong> Directory/resource sync (UI block/shortcode planned)</li>';
        echo '<li><strong>Reoon:</strong> Email validation (UI widget planned)</li>';
        echo '<li><strong>Acumbamail:</strong> Newsletter signup/campaigns (UI block/shortcode planned)</li>';
        echo '<li><strong>Certopus:</strong> Certificate automation (UI block/shortcode planned)</li>';
        echo '<li><strong>Printful:</strong> Merchandise shop (UI block/shortcode planned)</li>';
        echo '<li><strong>Logically/Afforai:</strong> AI search/Q&A (UI block/shortcode planned)</li>';
        echo '<li><strong>exa.ai:</strong> AI recommendations (UI block/shortcode planned)</li>';
        echo '<li><strong>Flowlu, Agiled, SuiteDash, Brilliant Directory:</strong> Business/CRM automation (UI widget/shortcode planned)</li>';
        echo '</ul>';
        echo '<p>' . esc_html__('See README for details and usage.', 'authority-blueprint-mcp') . '</p>';
    </div>
    <?php
} 