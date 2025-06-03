<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../wp-content/themes/authority-blueprint-mcp/inc/integrations/backup-sheep.php';

final class BackupSheepClientTest extends TestCase
{
    public function testGetBackupsReturnsExpectedStructure()
    {
        $client = $this->getMockBuilder(ABMCP_BackupSheep_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->with('backups')
            ->willReturn(['backups' => [['id' => 1, 'name' => 'Daily Backup']]]);
        $result = $client->get_backups();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('backups', $result);
        $this->assertSame('Daily Backup', $result['backups'][0]['name']);
    }

    public function testGetBackupsHandlesApiError()
    {
        $client = $this->getMockBuilder(ABMCP_BackupSheep_Client::class)
            ->setConstructorArgs(['dummy-key'])
            ->onlyMethods(['request'])
            ->getMock();
        $client->expects($this->once())
            ->method('request')
            ->willReturn(false);
        $result = $client->get_backups();
        $this->assertFalse($result);
    }

    public function testExtensibilityWithCustomMethod()
    {
        $client = new class('dummy-key') extends ABMCP_BackupSheep_Client {
            public function custom_method() { return 'custom'; }
        };
        $this->assertSame('custom', $client->custom_method());
    }
} 