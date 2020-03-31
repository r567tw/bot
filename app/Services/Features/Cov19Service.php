<?php

namespace App\Services\Features;

use GuzzleHttp\Client;
use Carbon\Carbon;

class Cov19Service
{

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getApiData()
    {
        $url = 'https://od.cdc.gov.tw/eic/Weekly_Age_County_Gender_19CoV.json';

        $response = $this->client->request('GET', $url);
        $content = json_decode($response->getBody()->getContents());

        return $content;
    }


}
