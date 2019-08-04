<?php
namespace App\Services;

use GuzzleHttp\Client;
use App\Services\CrawlerService;

class WebhookResponseService
{
    private $client;

    public function __construct(
        CrawlerService $service
    )
    {
        $this->service = $service;
        $this->client = new Client();

    }


    public function returnResponse($request)
    {
        if ($request['type'] == 'text'){
            return $this->processTextMessage($request['text']);
        }

        return '[Playground]目前我暫時還學不會這些話，請多給我一點時間吧！';
    }

    private function processTextMessage($message){

        switch ($message) {
            case '本日運勢':
                $url = config('services.url.astro');
                $originalData = $this->service->getOriginalData($url);
                return $this->service->getNewAstroFromYahoo($originalData);

            default:
                return '[Playground]目前我無法處理此訊息～之後將開發更多新功能，盡請期待！';
        }
    }

}
