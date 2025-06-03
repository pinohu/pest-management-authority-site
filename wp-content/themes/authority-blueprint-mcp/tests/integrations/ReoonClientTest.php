<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../inc/integrations/reoon.php';

final class ReoonClientTest extends TestCase
{
    public function testVerifyEmailReturnsExpectedStructure()
    {
        $client = $this->getMockBuilder(ABMCP_Reoon_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->with('email/verify', ['email' => 'test@example.com'], 'POST')
            ->willReturn(['result' => 'valid']);
        $result = $client->verify_email('test@example.com');
        $this->assertIsArray($result);
        $this->assertArrayHasKey('result', $result);
        $this->assertSame('valid', $result['result']);
    }

    public function testVerifyEmailHandlesApiError()
    {
        $client = $this->getMockBuilder(ABMCP_Reoon_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn(false);
        $result = $client->verify_email('test@example.com');
        $this->assertFalse($result);
    }

    public function testExtensibilityWithCustomMethod()
    {
        $client = new class('dummy-key') extends ABMCP_Reoon_Client {
            public function custom_method() { return 'custom'; }
        };
        $this->assertSame('custom', $client->custom_method());
    }
} 