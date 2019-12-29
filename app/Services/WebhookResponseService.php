<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Services\CrawlerService;
use App\Services\Features\AstroService;
use App\Services\Features\WeatherService;
use App\Services\Features\ExchangeService;
use Carbon\Carbon;
use Illuminate\Support\Str;

class WebhookResponseService
{
    private $client;
    private $astro;
    private $weather;

    public function __construct(
        AstroService $astro,
        WeatherService $weather,
        ExchangeService $exchange
    ) {
        $this->astro = $astro;
        $this->weather = $weather;
        $this->exchange = $exchange;
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
            case Str::startsWith($message, '今日運勢'):
                return $this->astro->getDailyAstro($message);
            case Str::startsWith($message, '本周運勢'):
                return $this->astro->getWeeklyAstro($message);
            case Str::startsWith($message, '今日天氣'):
                return $this->weather->getApiData($message);
            case Str::startsWith($message, 'exchange'):
                return $this->exchange->exchange($message);
            default:
                return '[Playground]目前我無法處理此訊息～之後將開發更多新功能，盡請期待！';
        }
    }
}
