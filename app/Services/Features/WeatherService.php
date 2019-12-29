<?php

namespace App\Services\Features;

use GuzzleHttp\Client;
use Carbon\Carbon;

class WeatherService
{

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getApiData($message)
    {
        $location = $this->transforToLocation($message);

        $url = 'https://opendata.cwb.gov.tw/api/v1/rest/datastore/F-C0032-001';

        $options = [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100',
            ],
            'query' => [
                'Authorization' => 'CWB-8617C293-566E-4A6E-BDBB-59443A4134C1',
                'format' => 'JSON',
                'locationName' => $location
            ]
        ];

        $response = $this->client->request('GET', $url, $options);
        $content = json_decode($response->getBody()->getContents());

        $localcationName = $content->records->location[0]->locationName;

        $reports = [];
        $weatherElements = $content->records->location[0]->weatherElement;

        $reports['天氣現象'] = $this->writeWxResult($weatherElements[0]);
        $reports['降雨機率'] = $this->writePoPResult($weatherElements[1]);
        $reports['溫度範圍'] = $this->writeTResult($weatherElements[2], $weatherElements[4]);
        $reports['舒適度'] = $this->writeCIResult($weatherElements[3]);

        $result = "今日天氣:\n";
        // $result .= "時間範圍:天氣現象/降雨機率/最低溫度～最高溫度/舒適度\n";
        // $result .= "";
        foreach ($reports as $key => $report) {
            $result .= "\n{$localcationName}未來二十四小時{$key}\n";
            $result .= $report;
        }

        return $result;
    }

    private function transforToLocation($message)
    {
        $query = explode(':', $message);
        if (count($query) >= 2) {
            return $query[1];
        } else {
            return '臺北市';
        }
    }

    private function getTimeClock(String $time)
    {
        $_time = Carbon::parse($time);
        return $_time->format('H:s');
    }

    private function writeWxResult($data)
    {
        $report = '';

        for ($i = 0; $i < 2; $i++) {
            $report .= $this->getTimeClock($data->time[$i]->startTime);
            $report .= "-{$this->getTimeClock($data->time[$i]->endTime)}: ";
            $report .= "{$data->time[$i]->parameter->parameterName}\n";
        }

        return $report;
    }

    private function writePoPResult($data)
    {
        $report = '';

        for ($i = 0; $i < 2; $i++) {
            $report .= $this->getTimeClock($data->time[$i]->startTime);
            $report .= "-{$this->getTimeClock($data->time[$i]->endTime)}: ";
            $report .= "{$data->time[$i]->parameter->parameterName}%\n";
        }

        return $report;
    }

    private function writeTResult($minTData, $maxTData)
    {
        $report = '';

        for ($i = 0; $i < 2; $i++) {
            $report .= $this->getTimeClock($minTData->time[$i]->startTime);
            $report .= "-{$this->getTimeClock($minTData->time[$i]->endTime)}: ";
            $MinUnit = trim($minTData->time[$i]->parameter->parameterUnit);
            $report .= "{$minTData->time[$i]->parameter->parameterName}°{$MinUnit}";
            $MaxUnit = trim($minTData->time[$i]->parameter->parameterUnit);
            $report .= " ~ {$maxTData->time[$i]->parameter->parameterName}°{$MaxUnit}\n";
        }

        return $report;
    }

    private function writeCIResult($data)
    {
        $report = '';

        for ($i = 0; $i < 2; $i++) {
            $report .= $this->getTimeClock($data->time[$i]->startTime);
            $report .= "-{$this->getTimeClock($data->time[$i]->endTime)}: ";
            $report .= "{$data->time[$i]->parameter->parameterName}\n";
        }

        return $report;
    }
}
