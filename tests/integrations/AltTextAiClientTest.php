<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../wp-content/themes/authority-blueprint-mcp/inc/integrations/alttext-ai.php';

final class AltTextAiClientTest extends TestCase
{
    public function testGenerateAltTextReturnsExpectedStructure()
    {
        $client = $this->getMockBuilder(ABMCP_AltTextAi_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->with('generate', ['image_url' => 'https://example.com/image.jpg'], 'POST')
            ->willReturn(['alt_text' => 'A sample image']);
        $result = $client->generate_alt_text('https://example.com/image.jpg');
        $this->assertIsArray($result);
        $this->assertArrayHasKey('alt_text', $result);
        $this->assertSame('A sample image', $result['alt_text']);
    }

    public function testGenerateAltTextHandlesApiError()
    {
        $client = $this->getMockBuilder(ABMCP_AltTextAi_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn(false);
        $result = $client->generate_alt_text('https://example.com/image.jpg');
        $this->assertFalse($result);
    }

    public function testExtensibilityWithCustomMethod()
    {
        $client = new class('dummy-key') extends ABMCP_AltTextAi_Client {
            public function custom_method() { return 'custom'; }
        };
        $this->assertSame('custom', $client->custom_method());
    }
} 