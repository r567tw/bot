<?php

namespace Tests\Feature\Services;

use App\Services\Features\AstroService;
use Tests\TestCase;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class AstroServiceTest extends TestCase
{

    public function testServiceGetDailyAstro()
    {
        $service = new AstroService(new Client(), new Crawler());
        $result = $service->getDailyAstro('本日運勢');
        $this->assertStringContainsString('今日射手座解析', $result);
    }

    public function testServiceGetWeeklyAstro()
    {
        $service = new AstroService(new Client(), new Crawler());
        $result = $service->getDailyAstro('本周運勢');
        $this->assertStringContainsString('今日射手座解析', $result);
    }
}
