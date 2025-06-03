<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../wp-content/themes/authority-blueprint-mcp/inc/integrations/suitedash.php';

final class SuiteDashClientTest extends TestCase
{
    public function testGetWorkspacesReturnsExpectedStructure()
    {
        $client = $this->getMockBuilder(ABMCP_SuiteDash_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->with('workspaces')
            ->willReturn(['workspaces' => [['id' => 1, 'name' => 'Main']]]);
        $result = $client->get_workspaces();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('workspaces', $result);
        $this->assertSame('Main', $result['workspaces'][0]['name']);
    }

    public function testGetWorkspacesHandlesApiError()
    {
        $client = $this->getMockBuilder(ABMCP_SuiteDash_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn(false);
        $result = $client->get_workspaces();
        $this->assertFalse($result);
    }

    public function testExtensibilityWithCustomMethod()
    {
        $client = new class('dummy-key') extends ABMCP_SuiteDash_Client {
            public function custom_method() { return 'custom'; }
        };
        $this->assertSame('custom', $client->custom_method());
    }
} 