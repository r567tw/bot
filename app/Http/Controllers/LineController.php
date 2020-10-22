<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LineController extends Controller
{
    private function notify($token, $message = '測試訊息')
    {
        // $token = env('LINE_NOTIFY_TOKEN');

        $response = Http::withToken($token)->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->asForm()->post('https://notify-api.line.me/api/notify', [
            'message' => $message,
        ]);

        return response()->json(['data' => $response->body()]);
    }

    public function notifyUserData(Request $data)
    {
        $user = Auth()->user();

        $url = 'https://notify-bot.line.me/oauth/authorize?';

        $params = [
            'response_type' => 'code',
            'client_id' => env('LINE_CLIENT_ID'),
            'redirect_uri' => 'https://r567tw-devplayground.herokuapp.com/line_notify/user',
            'scope' => 'notify',
            'state' => $user->id,
        ];

        $url = $url . http_build_query($params);
        return redirect()->away($url);
    }

    public function notifyUser(Request $request)
    {
        $code = $request->get('code');
        $id = $request->get('state');

        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->asForm()->post('https://notify-bot.line.me/oauth/token', [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'state' => $id,
            'redirect_uri' => 'https: //r567tw-devplayground.herokuapp.com/line_notify/user',
            'client_id' => env('LINE_CLIENT_ID'),
            'client_secret' => env('LINE_CLIENT_SECRET'),
        ]);

        if ($response->status() != '200') {
            return response()->json(['error' => $response->throw()]);
        }

        $user = User::find($id);
        $user->access_token = collect($response->json())->get('access_token');
        $user->save();

        $this->notify($user->access_token, '系統連結成功！');
        return redirect('/');
    }
}
