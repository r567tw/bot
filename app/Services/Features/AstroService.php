<?php

namespace App\Services\Features;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use Carbon\Carbon;

class AstroService
{
    /** @var Client  */
    private $client;
    private $crawler;

    public function __construct(Client $client, Crawler $crawler)
    {
        $this->client = $client;
        $this->crawler = $crawler;
    }

    public function getDailyAstro($message)
    {
        $astro = $this->transferAstro($message);

        $url = config('services.url.astro') . $astro['key'];

        $content = $this->client->get($url)->getBody()->getContents();
        $this->crawler->addHtmlContent($content);

        $target = $this->crawler->filterXPath('//div[contains(@class, "TODAY_CONTENT")]');
        $today = Carbon::today()->toDateString();

        // process string content!
        $result = str_replace(' ', '', $target->text());
        $result = str_replace("\r\n今日{$astro['value']}解析", "今日{$astro['value']}解析", $result);
        $result = str_replace('：', "：\r\n", $result);
        $result = str_replace('整體運勢', "\r\n整體運勢", $result);
        $result = str_replace('愛情運勢', "\r\n愛情運勢", $result);
        $result = str_replace('財運運勢', "\r\n財運運勢", $result);

        return $result;
    }

    public function getWeeklyAstro($message)
    {
        $astro = $this->transferAstro($message);

        $weekday = Carbon::now('Asia/Taipei')->weekday();

        $response = "本周運勢:\r\n";
        for ($i = $weekday; $i < 8; $i++) {
            $day = Carbon::now('Asia/Taipei')->addDay($i - $weekday);
            $date = $day->format('Y-m-d');

            $url = config('services.url.astro') . $astro['key'] . '&iAcDay=' . $date;
            $content = $this->client->get($url)->getBody()->getContents();

            $crawler = new Crawler();
            $crawler->addHtmlContent($content);
            $target = $crawler->filterXPath('//div[contains(@class, "TODAY_CONTENT")]');

            // process string content!
            $result = str_replace(' ', '', $target->text());
            $result = str_replace("\r\n今日{$astro['value']}解析", "{$astro['value']} {$date}解析", $result);
            $result = str_replace('：', "：\r\n", $result);
            $result = str_replace('整體運勢', "\r\n整體運勢", $result);
            $result = str_replace('愛情運勢', "\r\n愛情運勢", $result);
            $result = str_replace('財運運勢', "\r\n財運運勢", $result);
            $response .= $result;
        }
        return $response;
    }

    private function transferAstro($message)
    {
        $astro_index = [
            '牡羊座', '金牛座', '雙子座', '巨蟹座',
            '獅子座', '處女座', '天秤座', '天蠍座',
            '射手座', '摩羯座', '水瓶座', '雙魚座'
        ];

        $query = explode(':', $message);
        if (count($query) >= 2) {
            return [
                'key' => array_search($query[1], $astro_index),
                'value' => $query[1]
            ];
        } else {
            return ['key' => '8', 'value' => '射手座'];
        }
    }
}
