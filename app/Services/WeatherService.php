<?php

namespace App\Services;

use GuzzleHttp\Client;

class WeatherService
{

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getApiData()
    {
        $url = 'https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-C0032-001';

        $options = [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100',
            ],
            'query' => [
                'Authorization' => 'CWB-8617C293-566E-4A6E-BDBB-59443A4134C1',
                'format' => 'JSON',
                'locationName' => '臺北市'
            ]
        ];

        $response = $this->client->request('GET', $url, $options);
        $content = json_decode($response->getBody()->getContents());
        dd($content->records);
        return $content;
    }
}
