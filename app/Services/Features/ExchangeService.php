<?php

namespace App\Services\Features;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Carbon\Carbon;

class ExchangeService
{
    /** @var Client  */
    private $client;
    /** @var Crawler */
    private $crawler;

    public function __construct(Client $client, Crawler $crawler)
    {
        $this->client = $client;
        $this->crawler = $crawler;
    }


}
