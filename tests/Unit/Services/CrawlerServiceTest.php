<?php
namespace Tests\Feature\Services;

use App\Services\CrawlerService;
use Tests\TestCase;

class CrawlerServiceTest extends TestCase
{

    public function testGetOriginalData()
    {
        $service = new CrawlerService();
        $crawler = $service->getOriginalData('https://ani.gamer.com.tw/');
        //dd($crawler->html());
        $this->assertNotEmpty($crawler->html());
    }

    public function testGetNewAnimationFromBaHa()
    {
        $service = new CrawlerService();
        $crawler = $service->getOriginalData('https://ani.gamer.com.tw/');
        $target = $service->getNewAnimationFromBaHa($crawler);

        $this->assertArrayHasKey('date', $target[0]);
        $this->assertArrayHasKey('directUri', $target[0]);
        $this->assertArrayHasKey('imagePath', $target[0]);
        $this->assertArrayHasKey('label', $target[0]);
    }
}
