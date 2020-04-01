<?php

namespace App\Services\Features;

use GuzzleHttp\Client;
use Carbon\Carbon;

class Cov19Service
{

    private $client;
    private $area = ["台東縣"=> 0,"宜蘭縣"=> 0,"花蓮縣"=> 0,"澎湖縣"=> 0,"金門縣"=> 0,"連江縣"=> 0,"台北市"=> 0,"新北市"=> 0,"桃園市"=> 0,"台中市"=> 0,"台南市"=> 0,"高雄市"=> 0,"基隆市"=> 0,"新竹縣"=> 0,"新竹市"=> 0,"苗栗縣"=> 0,"彰化縣"=> 0,"南投縣"=> 0,"雲林縣"=> 0,"嘉義縣"=>0,"嘉義市"=> 0,"屏東縣"=> 0];

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

    public function getCov19Data()
    {
        $url = 'https://od.cdc.gov.tw/eic/Weekly_Age_County_Gender_19CoV.json';

        $response = $this->client->request('GET', $url);
        $content = json_decode($response->getBody()->getContents());

        $data = collect($content)->groupBy('縣市')->map(function($item){
             return $item->sum('確定病例數');
        });
        $data = collect($this->area)->merge($data)->sort()->reverse();

        $result = "新冠肺炎疫情全台狀況\n";
        foreach ($data as $key => $value) {
            $result .= $key.'有'.$value."人確診\n";
        }
        return $result;
    }

}
