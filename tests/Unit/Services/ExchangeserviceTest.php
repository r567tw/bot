<?php

namespace Tests\Feature\Services;

use App\Services\Features\ExchangeService;
use Tests\TestCase;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class ExchangeServiceTest extends TestCase
{

    public function testServiceGetExchange()
    {
        $service = new ExchangeService(new Client(), new Crawler());
        $result = $service->exchange(30,'twd','krw');
        $this->assertStringContainsString('KRW', $result);
    }


}
