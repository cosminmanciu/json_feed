<?php

namespace App\Tests;


use App\Command\ImportCommand;
use App\Service\ImageImportServiceInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ImportCommandTest extends TestCase
{
    public function testExecute()
    {
        $importServiceMock = $this->createMock(ImageImportServiceInterface::class);
        $importServiceMock
            ->expects($this->once())
            ->method('import')
            ->with('https://www.pornhub.com/files/json_feed_pornstars.json');

        $command = new ImportCommand($importServiceMock);
        $tester = new CommandTester($command);

        $tester->execute([]);

        $this->assertStringContainsString(0, $tester->getStatusCode());
    }
}