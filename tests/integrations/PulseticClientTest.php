<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../wp-content/themes/authority-blueprint-mcp/inc/integrations/pulsetic.php';

final class PulseticClientTest extends TestCase
{
    public function testGetStatusReturnsExpectedStructure()
    {
        $client = $this->getMockBuilder(ABMCP_Pulsetic_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->with('status')
            ->willReturn(['status' => 'ok']);
        $result = $client->get_status();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('status', $result);
        $this->assertSame('ok', $result['status']);
    }

    public function testGetStatusHandlesApiError()
    {
        $client = $this->getMockBuilder(ABMCP_Pulsetic_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn(false);
        $result = $client->get_status();
        $this->assertFalse($result);
    }

    public function testExtensibilityWithCustomMethod()
    {
        $client = new class('dummy-key') extends ABMCP_Pulsetic_Client {
            public function custom_method() { return 'custom'; }
        };
        $this->assertSame('custom', $client->custom_method());
    }
} 