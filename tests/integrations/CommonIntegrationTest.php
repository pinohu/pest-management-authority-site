<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../wp-content/themes/authority-blueprint-mcp/inc/integrations/common.php';

final class CommonIntegrationTest extends TestCase
{
    public function testApiUrlBuilder()
    {
        $url = abmcp_build_api_url('https://api.example.com', 'endpoint', ['foo' => 'bar']);
        $this->assertStringContainsString('endpoint', $url);
        $this->assertStringContainsString('foo=bar', $url);
    }

    public function testApiKeySanitization()
    {
        $key = abmcp_sanitize_api_key('  test-key  ');
        $this->assertSame('test-key', $key);
    }

    public function testExtensibilityWithCustomFunction()
    {
        if (!function_exists('abmcp_custom_helper')) {
            function abmcp_custom_helper() { return 'custom'; }
        }
        $this->assertSame('custom', abmcp_custom_helper());
    }
} 