<?php

namespace App\Services\Features;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Carbon\Carbon;

class ExchangeService
{
    /** @var Client  */
    private $client;
    /** @var Crawler */
    private $crawler;

    public function __construct(Client $client, Crawler $crawler)
    {
        $this->client = $client;
        $this->crawler = $crawler;
    }

    public function exchange($message)
    {
        $number = $this->transforToNumber($message);
        $from = $this->transforToFrom($message);
        $to = $this->transforToTo($message);

        $access_key = env('FIXER_ACCESS_KEY','f6dfba2a7214bf6896ebb7f527e11a19');
        $url = "http://data.fixer.io/api/latest?access_key=$access_key&symbols=$from,$to";

        $response = $this->client->request('GET', $url);
        $content = json_decode($response->getBody()->getContents());
        $rates = (array) $content->rates;
        // start to calculate
        $result = ($number/$rates[$from])*$rates[$to];
        $result = "$result $to";
        return $result;
    }

    private function transforToNumber($message)
    {
        // example: exchange:30,twd,krw
        $query = explode(':', $message);

        $number = explode(',',$query[1]);
        return (float) $number[0];
    }

    private function transforToFrom($message)
    {
        $query = explode(':', $message);
        $content = explode(',',$query[1]);

        if (count($content)>=2){
            $from = $content[1];
            return strtoupper($from);
        }else{
            return 'TWD';
        }
    }

    private function transforToTo($message)
    {
        $query = explode(':', $message);
        $content = explode(',',$query[1]);
        if (count($content)>=3){
            $to = $content[2];
            return strtoupper($to);
        }else{
            return 'USD';
        }
    }

}
