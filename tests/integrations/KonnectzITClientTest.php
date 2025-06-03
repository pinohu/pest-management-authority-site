<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../wp-content/themes/authority-blueprint-mcp/inc/integrations/konnectzit.php';

final class KonnectzITClientTest extends TestCase
{
    public function testGetWorkflowsReturnsExpectedStructure()
    {
        $client = $this->getMockBuilder(ABMCP_KonnectzIT_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->with('workflows')
            ->willReturn(['workflows' => [['id' => 1, 'name' => 'Main Workflow']]]);
        $result = $client->get_workflows();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('workflows', $result);
        $this->assertSame('Main Workflow', $result['workflows'][0]['name']);
    }

    public function testGetWorkflowsHandlesApiError()
    {
        $client = $this->getMockBuilder(ABMCP_KonnectzIT_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn(false);
        $result = $client->get_workflows();
        $this->assertFalse($result);
    }

    public function testExtensibilityWithCustomMethod()
    {
        $client = new class('dummy-key') extends ABMCP_KonnectzIT_Client {
            public function custom_method() { return 'custom'; }
        };
        $this->assertSame('custom', $client->custom_method());
    }
} 