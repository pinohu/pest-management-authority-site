<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../wp-content/themes/authority-blueprint-mcp/inc/integrations/crove.php';

final class CroveClientTest extends TestCase
{
    public function testGetDocumentsReturnsExpectedStructure()
    {
        $client = $this->getMockBuilder(ABMCP_Crove_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->with('documents')
            ->willReturn(['documents' => [['id' => 1, 'name' => 'Contract']]]);
        $result = $client->get_documents();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('documents', $result);
        $this->assertSame('Contract', $result['documents'][0]['name']);
    }

    public function testGetDocumentsHandlesApiError()
    {
        $client = $this->getMockBuilder(ABMCP_Crove_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn(false);
        $result = $client->get_documents();
        $this->assertFalse($result);
    }

    public function testExtensibilityWithCustomMethod()
    {
        $client = new class('dummy-key') extends ABMCP_Crove_Client {
            public function custom_method() { return 'custom'; }
        };
        $this->assertSame('custom', $client->custom_method());
    }
} 