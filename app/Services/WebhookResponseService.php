<?php
namespace App\Services;

use GuzzleHttp\Client;
use App\Services\CrawlerService;
use Carbon\Carbon;

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
            case '本周運勢':
                // $today = Carbon::now('Asia/Taipei')->format('Y-m-d');
                $startOfWeek = Carbon::now('Asia/Taipei')->startofWeek();
                $content = "本周運勢:\r\n";
                for($i=0; $i<7; $i++){
                    $day = $startOfWeek->addDay();
                    $url = config('services.url.astro').'&iAcDay='.$day->format('Y-m-d');
                    $originalData = $this->service->getOriginalData($url);
                    $content .= $this->service->getWeeklyAstroFromYahoo($originalData,$day->format('Y-m-d'));
                }
                return $content;
            default:
                return '[Playground]目前我無法處理此訊息～之後將開發更多新功能，盡請期待！';
        }
    }

}
