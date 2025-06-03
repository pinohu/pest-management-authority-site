<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../wp-content/themes/authority-blueprint-mcp/inc/integrations/stackby.php';

final class StackbyClientTest extends TestCase
{
    public function testGetTablesReturnsExpectedStructure()
    {
        $client = $this->getMockBuilder(ABMCP_Stackby_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->with('tables')
            ->willReturn(['tables' => [['id' => 1, 'name' => 'Stack Table']]]);
        $result = $client->get_tables();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('tables', $result);
        $this->assertSame('Stack Table', $result['tables'][0]['name']);
    }

    public function testGetTablesHandlesApiError()
    {
        $client = $this->getMockBuilder(ABMCP_Stackby_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn(false);
        $result = $client->get_tables();
        $this->assertFalse($result);
    }

    public function testExtensibilityWithCustomMethod()
    {
        $client = new class('dummy-key') extends ABMCP_Stackby_Client {
            public function custom_method() { return 'custom'; }
        };
        $this->assertSame('custom', $client->custom_method());
    }
} 