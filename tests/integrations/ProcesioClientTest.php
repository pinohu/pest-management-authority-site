<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../wp-content/themes/authority-blueprint-mcp/inc/integrations/procesio.php';

final class ProcesioClientTest extends TestCase
{
    public function testGetProcessesReturnsExpectedStructure()
    {
        $client = $this->getMockBuilder(ABMCP_Procesio_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->with('processes')
            ->willReturn(['processes' => [['id' => 1, 'name' => 'Main Process']]]);
        $result = $client->get_processes();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('processes', $result);
        $this->assertSame('Main Process', $result['processes'][0]['name']);
    }

    public function testGetProcessesHandlesApiError()
    {
        $client = $this->getMockBuilder(ABMCP_Procesio_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn(false);
        $result = $client->get_processes();
        $this->assertFalse($result);
    }

    public function testExtensibilityWithCustomMethod()
    {
        $client = new class('dummy-key') extends ABMCP_Procesio_Client {
            public function custom_method() { return 'custom'; }
        };
        $this->assertSame('custom', $client->custom_method());
    }
} 