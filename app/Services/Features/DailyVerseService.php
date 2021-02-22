<?php
namespace App\Services\Features;

use GuzzleHttp\Client;

class DailyVerseService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function getDailyVerse()
    {
        $url = 'https://www.taiwanbible.com/blog/dailyverse.jsp';

        $response = $this->client->get($url);
        $scripture = (string) trim($response->getBody());

        return $scripture;
    }

}
