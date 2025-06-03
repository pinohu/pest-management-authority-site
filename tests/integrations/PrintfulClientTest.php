<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../wp-content/themes/authority-blueprint-mcp/inc/integrations/printful.php';

final class PrintfulClientTest extends TestCase
{
    public function testGetProductsReturnsExpectedStructure()
    {
        $client = $this->getMockBuilder(ABMCP_Printful_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->with('products')
            ->willReturn(['result' => [['id' => 1, 'name' => 'T-Shirt']]]);
        $result = $client->get_products();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('result', $result);
        $this->assertSame('T-Shirt', $result['result'][0]['name']);
    }

    public function testGetProductsHandlesApiError()
    {
        $client = $this->getMockBuilder(ABMCP_Printful_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn(false);
        $result = $client->get_products();
        $this->assertFalse($result);
    }

    public function testExtensibilityWithCustomMethod()
    {
        $client = new class('dummy-key') extends ABMCP_Printful_Client {
            public function custom_method() { return 'custom'; }
        };
        $this->assertSame('custom', $client->custom_method());
    }
} 