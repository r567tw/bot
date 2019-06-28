<?php
namespace App\Services;

use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class LineBotService
{
    private $token = '';
    private $secret = '';

    private $lineBot;
    private $lineUserId;

    public function __construct($lineUserId)
    {
        $this->token = env('LINEBOT_TOKEN');
        $this->secret = env('LINEBOT_SECRET');
        // $this->lineUserId = $lineUserId;
        $this->lineUserId = $lineUserId;
        $this->httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->token);

        $this->lineBot = new \LINE\LINEBot($this->httpClient, ['channelSecret' => $this->secret]);
    }

    public function fake()
    {
    }


    public function pushMessage($content)
    {
        if (is_string($content)) {
            $content = new TextMessageBuilder($content);
        }
        return $this->lineBot->pushMessage($this->lineUserId, $content);
    }
}
