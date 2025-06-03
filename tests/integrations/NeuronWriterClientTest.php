<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../wp-content/themes/authority-blueprint-mcp/inc/integrations/neuronwriter.php';

final class NeuronWriterClientTest extends TestCase
{
    public function testGetSuggestionsReturnsExpectedStructure()
    {
        $client = $this->getMockBuilder(ABMCP_NeuronWriter_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->with('suggestions', ['content' => 'Test content'], 'POST')
            ->willReturn(['suggestions' => ['Improve SEO', 'Add keywords']]);
        $result = $client->get_suggestions('Test content');
        $this->assertIsArray($result);
        $this->assertArrayHasKey('suggestions', $result);
        $this->assertContains('Improve SEO', $result['suggestions']);
    }

    public function testGetSuggestionsHandlesApiError()
    {
        $client = $this->getMockBuilder(ABMCP_NeuronWriter_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn(false);
        $result = $client->get_suggestions('Test content');
        $this->assertFalse($result);
    }

    public function testExtensibilityWithCustomMethod()
    {
        $client = new class('dummy-key') extends ABMCP_NeuronWriter_Client {
            public function custom_method() { return 'custom'; }
        };
        $this->assertSame('custom', $client->custom_method());
    }
} 