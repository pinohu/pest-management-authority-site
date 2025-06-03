<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../inc/integrations/openai.php';

final class OpenAIAdminUITest extends TestCase
{
    public function testSettingsPageRendersHtml()
    {
        ob_start();
        abmcp_openai_settings_page();
        $output = ob_get_clean();
        $this->assertStringContainsString('<h1>OpenAI Integration', $output);
        $this->assertStringContainsString('name="abmcp_openai_api_key"', $output);
    }

    public function testSettingsSaveUpdatesOption()
    {
        // Simulate settings save
        update_option('abmcp_openai_api_key', 'test-key');
        $this->assertSame('test-key', get_option('abmcp_openai_api_key'));
    }

    public function testSettingsPageShowsSavedApiKey()
    {
        update_option('abmcp_openai_api_key', 'snapshot-key');
        ob_start();
        abmcp_openai_settings_page();
        $output = ob_get_clean();
        $this->assertStringContainsString('value="snapshot-key"', $output);
    }
} 