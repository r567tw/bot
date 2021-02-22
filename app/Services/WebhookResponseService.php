<?php

namespace App\Services;

use App\Services\Features\AstroService;
use App\Services\Features\WeatherService;
use App\Services\Features\ExchangeService;
use App\Services\Features\CoVid19Service;
use Illuminate\Support\Str;

class WebhookResponseService
{
    private $astro;
    private $weather;

    public function __construct(
        AstroService $astro,
        WeatherService $weather,
        ExchangeService $exchange,
        CoVid19Service $covid19
    ) {
        $this->astro = $astro;
        $this->weather = $weather;
        $this->exchange = $exchange;
        $this->Covid19 = $covid19;
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
            case Str::startsWith($message, '換外匯'):
                return $this->exchange->exchange($message);
            case Str::startsWith($message, '武漢肺炎'):
                return $this->Covid19->getCov19Data();
            case Str::startsWith($message, 'CoVid19'):
                return $this->Covid19->getCov19Data();
            default:
                return '[Playground]目前我無法處理此訊息～之後將開發更多新功能，盡請期待！';
        }
    }
}
