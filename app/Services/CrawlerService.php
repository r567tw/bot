<?php
namespace App\Services;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerService
{
    /** @var Client  */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $path
     * @return Crawler
     */
    public function getOriginalData(string $path)
    {
        $content = $this->client->get($path)->getBody()->getContents();
        $crawler = new Crawler();

        $crawler->addHtmlContent($content);

        return $crawler;
    }
}
