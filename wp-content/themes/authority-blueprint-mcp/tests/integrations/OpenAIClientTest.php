<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../inc/integrations/openai.php';

final class OpenAIClientTest extends TestCase
{
    public function testGenerateContentReturnsExpectedStructure()
    {
        $client = $this->getMockBuilder(ABMCP_OpenAI_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->with(
                $this->equalTo('completions'),
                $this->arrayHasKey('prompt'),
                $this->equalTo('POST')
            )
            ->willReturn(['choices' => [['text' => 'Hello world']]]);
        $result = $client->generate_content('Say hello');
        $this->assertIsArray($result);
        $this->assertArrayHasKey('choices', $result);
        $this->assertSame('Hello world', $result['choices'][0]['text']);
    }

    public function testGenerateContentHandlesApiError()
    {
        $client = $this->getMockBuilder(ABMCP_OpenAI_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn(false);
        $result = $client->generate_content('Say hello');
        $this->assertFalse($result);
    }

    public function testExtensibilityWithCustomMethod()
    {
        $client = new class('dummy-key') extends ABMCP_OpenAI_Client {
            public function custom_method() { return 'custom'; }
        };
        $this->assertSame('custom', $client->custom_method());
    }
} 