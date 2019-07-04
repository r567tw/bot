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
}
