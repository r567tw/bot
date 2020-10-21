<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class LineController extends Controller
{
    public function notify()
    {
        $token = env('LINE_NOTIFY_TOKEN');

        $response = Http::withToken($token)->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->asForm()->post('https://notify-api.line.me/api/notify', [
            'message' => request()->get('message', '測試訊息'),
        ]);

        return response()->json(['data' => $response->body()]);
    }
}
