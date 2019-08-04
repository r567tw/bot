<?php
namespace App\Services;

use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;

class LineBotService
{
    private $token = '';
    private $secret = '';

    private $lineBot;

    public function __construct()
    {
        $this->token = env('LINEBOT_TOKEN');
        $this->secret = env('LINEBOT_SECRET');

        $this->httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->token);

        $this->lineBot = new \LINE\LINEBot($this->httpClient, ['channelSecret' => $this->secret]);
    }

    public function buildImagesMessageBuilder(array $data, string $notificationText = 'Hello 這是今日的金句!')
    {
        $imageCarouselColumnTemplateBuilders = array_map(function ($d) {
            return $this->buildImageCarouselColumnTemplateBuilder(
                $d['imagePath'],
                $d['directUri'],
                $d['label']
            );
        }, $data);

        $tempChunk = array_chunk($imageCarouselColumnTemplateBuilders, 5);

        return array_map(function ($data) use ($notificationText) {
            return new TemplateMessageBuilder(
                $notificationText,
                new ImageCarouselTemplateBuilder($data)
            );
        }, $tempChunk);
    }

    private function buildImageCarouselColumnTemplateBuilder(string $imagePath, string $directUri, string $label){
        return new ImageCarouselColumnTemplateBuilder(
            $imagePath,
            new UriTemplateActionBuilder($label, $directUri)
        );
    }

    public function pushMessage($lineUserId,$content)
    {
        if (is_string($content)) {
            $content = new TextMessageBuilder($content);
        }
        return $this->lineBot->pushMessage($lineUserId, $content);
    }
}
