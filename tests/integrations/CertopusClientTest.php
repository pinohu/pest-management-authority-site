<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../wp-content/themes/authority-blueprint-mcp/inc/integrations/certopus.php';

final class CertopusClientTest extends TestCase
{
    public function testGetCertificatesReturnsExpectedStructure()
    {
        $client = $this->getMockBuilder(ABMCP_Certopus_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->with('certificates')
            ->willReturn(['certificates' => [['id' => 1, 'name' => 'Course Completion']]]);
        $result = $client->get_certificates();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('certificates', $result);
        $this->assertSame('Course Completion', $result['certificates'][0]['name']);
    }

    public function testGetCertificatesHandlesApiError()
    {
        $client = $this->getMockBuilder(ABMCP_Certopus_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn(false);
        $result = $client->get_certificates();
        $this->assertFalse($result);
    }

    public function testExtensibilityWithCustomMethod()
    {
        $client = new class('dummy-key') extends ABMCP_Certopus_Client {
            public function custom_method() { return 'custom'; }
        };
        $this->assertSame('custom', $client->custom_method());
    }
} 