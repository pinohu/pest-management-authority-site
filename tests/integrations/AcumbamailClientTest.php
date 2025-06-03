<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../wp-content/themes/authority-blueprint-mcp/inc/integrations/acumbamail.php';

final class AcumbamailClientTest extends TestCase
{
    public function testGetListsReturnsExpectedStructure()
    {
        $client = $this->getMockBuilder(ABMCP_Acumbamail_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->with('lists')
            ->willReturn(['lists' => [['id' => 1, 'name' => 'Newsletter']]]);
        $result = $client->get_lists();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('lists', $result);
        $this->assertSame('Newsletter', $result['lists'][0]['name']);
    }

    public function testGetListsHandlesApiError()
    {
        $client = $this->getMockBuilder(ABMCP_Acumbamail_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn(false);
        $result = $client->get_lists();
        $this->assertFalse($result);
    }

    public function testExtensibilityWithCustomMethod()
    {
        $client = new class('dummy-key') extends ABMCP_Acumbamail_Client {
            public function custom_method() { return 'custom'; }
        };
        $this->assertSame('custom', $client->custom_method());
    }
} 