<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot\Constant\HTTPHeader;

class WebhookController extends Controller
{

    private $token = '';
    private $secret = '';


    public function __construct()
    {
        $this->token = env('LINEBOT_TOKEN');
        $this->secret = env('LINEBOT_SECRET');

        $this->httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->token);

        $this->bot = new \LINE\LINEBot($this->httpClient, ['channelSecret' => $this->secret]);
    }

    public function index(Request $request)
    {
        $events = $request['events'];

        foreach ($events as $event) {
            // Log::info($event['replyToken']);
            $resp = $this->bot->replyText($event['replyToken'], 'Hello start Sub-Bot');
        }
        return '';
    }
}
