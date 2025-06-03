<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../wp-content/themes/authority-blueprint-mcp/inc/integrations/insighto.php';

final class InsightoClientTest extends TestCase
{
    public function testModerateCommentReturnsExpectedStructure()
    {
        $client = $this->getMockBuilder(ABMCP_Insighto_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->with('moderate', ['comment' => 'Test comment'], 'POST')
            ->willReturn(['result' => 'not_spam']);
        $result = $client->moderate_comment('Test comment');
        $this->assertIsArray($result);
        $this->assertArrayHasKey('result', $result);
        $this->assertSame('not_spam', $result['result']);
    }

    public function testModerateCommentHandlesApiError()
    {
        $client = $this->getMockBuilder(ABMCP_Insighto_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn(false);
        $result = $client->moderate_comment('Test comment');
        $this->assertFalse($result);
    }

    public function testExtensibilityWithCustomMethod()
    {
        $client = new class('dummy-key') extends ABMCP_Insighto_Client {
            public function custom_method() { return 'custom'; }
        };
        $this->assertSame('custom', $client->custom_method());
    }
} 