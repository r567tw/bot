<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Services\CrawlerService;
use Carbon\Carbon;

class WebhookResponseService
{
    private $client;
    private $service;
    private $weather;

    public function __construct(
        CrawlerService $service,
        WeatherService $weather
    ) {
        $this->service = $service;
        $this->weather = $weather;
        $this->client = new Client();
    }


    public function returnResponse($request)
    {
        if ($request['type'] == 'text') {
            return $this->processTextMessage($request['text']);
        }

        return '[Playground]目前我暫時還學不會這些話，請多給我一點時間吧！';
    }

    private function processTextMessage($message)
    {

        switch ($message) {
            case '本日運勢':
                $url = config('services.url.astro');
                $originalData = $this->service->getOriginalData($url);
                return $this->service->getNewAstroFromYahoo($originalData);
            case '本周運勢':
                $weekday = Carbon::now('Asia/Taipei')->weekday();
                $startOfWeek = Carbon::now('Asia/Taipei')->startofWeek();
                $content = "本周運勢:\r\n";
                for ($i = $weekday; $i < 8; $i++) {
                    $day = Carbon::now('Asia/Taipei')->addDay($i - $weekday);
                    $date = $day->format('Y-m-d');
                    $url = config('services.url.astro') . '&iAcDay=' . $date;
                    $originalData = $this->service->getOriginalData($url);
                    $content .= $this->service->getWeeklyAstroFromYahoo($originalData, $date);
                }
                return $content;
            case '今日天氣':
                return $this->weather->getApiData();

            default:
                return '[Playground]目前我無法處理此訊息～之後將開發更多新功能，盡請期待！';
        }
    }
}
