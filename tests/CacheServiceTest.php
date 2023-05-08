<?php

namespace App\Tests;

use App\Command\ImportCommand;
use App\Entity\Image;
use App\Service\ActorBuilderInterface;
use App\Service\CacheService;
use App\Service\ImageImportService;
use App\Service\ImageImportServiceInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Tester\CommandTester;

class CacheServiceTest extends TestCase
{
    private $cacheService;

    private $imge;

    protected function setUp(): void
    {
        $redis = RedisAdapter::createConnection('redis://localhost');
        $cache = new RedisAdapter($redis);
        $this->cacheService = new CacheService($cache);
        $this->image = new Image();

    }
    public function testGetNewCachedImage()
    {
     $this->image->setImageUrls(json_encode(["https://di.phncdn.com/pics/pornstars/000/000/002/(m=lciuhScOb_c)(mh=5Lb6oqzf58Pdh9Wc)thumb_22561.jpg"]));
     $imageData = $this->cacheService->getCachedImage($this->image);

     $this->assertIsString( $imageData);
    }
}