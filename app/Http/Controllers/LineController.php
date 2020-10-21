<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class LineController extends Controller
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function notify()
    {
        $token = env('LINE_NOTIFY_TOKEN');

        $options = [
            'headers' => [
                'Authorization' => "Bearer {$token}",
            ],
            'form_params' => [
                'message' => '測試通知成功！',
            ],
        ];

        $url = 'https://notify-api.line.me/api/notify';

        $response = $this->client->post($url, $options);

        // $response = Http::withHeaders([
        //     'Content-Type' => 'multipart/form-data',
        //     'Authorization' => "Bearer {$token}",
        // ])->post('https://notify-api.line.me/api/notify', [
        //     'message' => '測試通知！',
        // ]);

        return response()->json(['message' => 'success']);
    }
}
