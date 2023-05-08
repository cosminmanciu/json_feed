<?php

// src/Command/CreateUserCommand.php
namespace App\Command;

use App\Service\ImageImportService;
use App\Service\ImageImportServiceInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:showcase-import')]
class ImportCommand extends Command
{
    public ImageImportServiceInterface $importService;

    public function __construct(ImageImportServiceInterface $importService)
    {
        $this->importService =  $importService;
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->importService->import('https://www.pornhub.com/files/json_feed_pornstars.json', 10);
        return Command::SUCCESS;


    }
}